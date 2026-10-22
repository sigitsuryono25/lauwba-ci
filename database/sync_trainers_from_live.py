#!/usr/bin/env python3
"""Sync active trainers from the live Lauwba team endpoint into the SQLite DB.

The 2019 MySQL dump used to build the local database did not have an
`is_active` column, so the SQLite patch defaulted every trainer to active.
This script mirrors the current active team from the main website instead.

Usage:
    python3 database/sync_trainers_from_live.py
"""

from __future__ import annotations

import base64
import json
import re
import sqlite3
import sys
import urllib.request
from pathlib import Path

ROOT = Path(__file__).resolve().parent.parent
DB = ROOT / "database" / "lauwbaco_versi22_latest.sqlite"
IMAGE_DIR = ROOT / "foto_banner"
SOURCE = "https://lauwba.com/webservices/get_team"


def slugify(value: str) -> str:
    value = value.lower()
    value = re.sub(r"[^a-z0-9]+", "-", value)
    return value.strip("-")


def normalized(value: str) -> str:
    return re.sub(r"[^a-z0-9]", "", value.lower())


def first_token(value: str) -> str:
    return re.split(r"[^a-z0-9]+", value.lower())[0]


def has_image_file(value: str) -> bool:
    if not value or value.startswith(("http://", "https://", "data:")):
        return False
    return (IMAGE_DIR / value).exists()


def save_image(name: str, data_uri: str) -> str | None:
    match = re.match(r"data:image/([a-zA-Z0-9.+-]+);base64,(.*)", data_uri, re.S)
    if not match:
        return None

    ext = "jpg" if match.group(1) in {"jpeg", "jpg"} else match.group(1).replace("+", "")
    filename = f"{slugify(name)}.{ext}"
    IMAGE_DIR.mkdir(exist_ok=True)
    (IMAGE_DIR / filename).write_bytes(base64.b64decode(match.group(2)))

    return filename


def main() -> int:
    print(f"Fetching {SOURCE} ...")
    request = urllib.request.Request(SOURCE, headers={"User-Agent": "Mozilla/5.0"})
    with urllib.request.urlopen(request, timeout=30) as response:
        trainers = json.load(response)

    active = [t for t in trainers if str(t.get("is_active", "")).upper() == "Y"]
    print(f"Active trainers on live site: {len(active)}")

    conn = sqlite3.connect(DB)
    conn.row_factory = sqlite3.Row

    rows = conn.execute("SELECT * FROM tutor").fetchall()
    by_name = {normalized(row["nama"]): row for row in rows}
    by_id = {int(row["id_tutor"]): row for row in rows}

    matched_ids: set[int] = set()
    next_id = max(by_id, default=0) + 1

    for trainer in active:
        name = (trainer.get("nama") or "").strip()
        if not name:
            continue

        local = by_name.get(normalized(name))

        # Some records were renamed (credentials added/removed) but kept the
        # same tutor id. Match those by id when the first name still matches.
        if local is None:
            candidate = by_id.get(int(trainer.get("id_tutor") or 0))
            if candidate is not None and first_token(candidate["nama"]) == first_token(name):
                local = candidate

        image = (trainer.get("gambar") or "").strip()
        if image.startswith("data:image/"):
            saved = save_image(name, image)
            if saved:
                image = saved

        about = (trainer.get("tentang") or "").strip()
        description = (trainer.get("descriptions") or "").strip()
        order = int(trainer.get("nomor_urut") or 0)

        if local is not None and int(local["id_tutor"]) not in matched_ids:
            tutor_id = int(local["id_tutor"])
            conn.execute(
                "UPDATE tutor SET nama=?, tentang=?, gambar=?, descriptions=?, nomor_urut=?, is_active='Y', seq=? WHERE id_tutor=?",
                (name, about, image, description, order, tutor_id, tutor_id),
            )
        else:
            tutor_id = int(trainer.get("id_tutor") or 0)
            if tutor_id == 0 or tutor_id in by_id:
                tutor_id = next_id
                next_id += 1

            conn.execute(
                "INSERT INTO tutor (id_tutor, nama, tentang, gambar, descriptions, jabatan, nomor_urut, is_active, seq) VALUES (?, ?, ?, ?, ?, '', ?, 'Y', ?)",
                (tutor_id, name, about, image, description, order, tutor_id),
            )
            by_id[tutor_id] = conn.execute("SELECT * FROM tutor WHERE id_tutor=?", (tutor_id,)).fetchone()

        matched_ids.add(tutor_id)
        print(f"  active: {tutor_id} {name}")

    # Everything not in the live active list is inactive.
    if matched_ids:
        placeholders = ",".join("?" for _ in matched_ids)
        conn.execute(
            f"UPDATE tutor SET is_active='N' WHERE id_tutor NOT IN ({placeholders})",
            tuple(matched_ids),
        )

    conn.commit()

    active_count = conn.execute("SELECT COUNT(*) FROM tutor WHERE is_active='Y'").fetchone()[0]
    total_count = conn.execute("SELECT COUNT(*) FROM tutor").fetchone()[0]
    conn.close()

    print(f"Done. Local DB: {active_count} active / {total_count} total trainers.")
    return 0


if __name__ == "__main__":
    sys.exit(main())
