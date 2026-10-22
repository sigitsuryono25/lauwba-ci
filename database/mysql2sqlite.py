#!/usr/bin/env python3
"""Convert the phpMyAdmin MySQL dump in this project to a SQLite database.

Usage: python3 mysql2sqlite.py input.sql output.sqlite
"""
import re
import sqlite3
import sys

INT_TYPES = {"tinyint", "smallint", "mediumint", "int", "integer", "bigint"}
REAL_TYPES = {"decimal", "numeric", "float", "double", "real"}


def split_top_level(body, sep=","):
    """Split on sep, ignoring separators inside quotes/parens."""
    parts, buf, depth, quote = [], [], 0, None
    i = 0
    while i < len(body):
        c = body[i]
        if quote:
            buf.append(c)
            if c == "\\" and i + 1 < len(body):
                buf.append(body[i + 1])
                i += 2
                continue
            if c == quote:
                if i + 1 < len(body) and body[i + 1] == quote:
                    buf.append(body[i + 1])
                    i += 2
                    continue
                quote = None
        else:
            if c in "'\"`":
                quote = c
            elif c == "(":
                depth += 1
            elif c == ")":
                depth -= 1
            elif c == sep and depth == 0:
                parts.append("".join(buf))
                buf = []
                i += 1
                continue
            buf.append(c)
        i += 1
    parts.append("".join(buf))
    return parts


def parse_create(name, body):
    columns = []  # (name, sqlite_def)
    for line in body.strip().splitlines():
        line = line.strip()
        if not line.startswith("`"):
            continue
        m = re.match(r"`([^`]+)`\s+([a-zA-Z]+)(\([^)]*\))?(.*)$", line)
        if not m:
            raise ValueError("unparsed column: " + line)
        col, type_name, _args, rest = m.group(1), m.group(2).lower(), m.group(3), m.group(4)
        rest = re.sub(r"\bunsigned\b|\bzerofill\b", "", rest, flags=re.I)
        rest = re.sub(r"\bCHARACTER SET\s+\w+", "", rest, flags=re.I)
        rest = re.sub(r"\bCOLLATE\s+\w+", "", rest, flags=re.I)
        rest = re.sub(r"\bAUTO_INCREMENT\b", "", rest, flags=re.I)
        rest = re.sub(r"\bON UPDATE\s+CURRENT_TIMESTAMP(\(\d*\))?", "", rest, flags=re.I)

        # DEFAULT clause (quoted, numeric, NULL or CURRENT_TIMESTAMP)
        default = None
        dm = re.search(
            r"\bDEFAULT\s+('(?:[^'\\]|\\.|'')*'|[\w.+-]+)", rest, re.I
        )
        if dm:
            raw = dm.group(1)
            if raw.startswith("'"):
                default = "'" + raw[1:-1].replace("''", "'") + "'"
            elif raw.upper() in ("NULL",):
                default = "NULL"
            elif raw.upper().startswith("CURRENT_TIMESTAMP"):
                default = "CURRENT_TIMESTAMP"
            else:
                default = raw
            rest = rest[: dm.start()] + rest[dm.end():]

        affinity = "INTEGER" if type_name in INT_TYPES else "REAL" if type_name in REAL_TYPES else "BLOB" if type_name == "blob" else "TEXT"
        definition = f'"{col}" {affinity}'
        if default is not None:
            definition += " DEFAULT " + default
        if re.search(r"\bNOT NULL\b", rest, re.I):
            definition += " NOT NULL"
        columns.append((col, definition))
    return columns


def parse_insert(text, i):
    """Parse VALUES tuples starting at i. Return (rows, new_index)."""
    rows = []
    while True:
        while i < len(text) and text[i] in " \t\r\n,":
            i += 1
        if i >= len(text) or text[i] == ";":
            return rows, i + 1
        if text[i] != "(":
            raise ValueError("expected '(' at " + repr(text[i : i + 40]))
        i += 1
        row = []
        while True:
            while i < len(text) and text[i] in " \t\r\n":
                i += 1
            if text[i] == "'":
                i += 1
                buf = []
                while True:
                    c = text[i]
                    if c == "\\":
                        n = text[i + 1]
                        buf.append(
                            {"0": "", "b": "\b", "n": "\n", "r": "\r", "t": "\t", "Z": "\x1a"}.get(n, n)
                        )
                        i += 2
                    elif c == "'":
                        if i + 1 < len(text) and text[i + 1] == "'":
                            buf.append("'")
                            i += 2
                        else:
                            i += 1
                            break
                    else:
                        buf.append(c)
                        i += 1
                value = "".join(buf).replace("\x00", "").replace("'", "''")
                row.append("'" + value + "'")
            else:
                start = i
                while i < len(text) and text[i] not in ",)":
                    i += 1
                token = text[start:i].strip()
                row.append("NULL" if token.upper() == "NULL" else token)
            while i < len(text) and text[i] in " \t\r\n":
                i += 1
            if text[i] == ",":
                i += 1
                continue
            if text[i] == ")":
                i += 1
                break
            raise ValueError("unexpected char " + repr(text[i]))
        rows.append(row)


def main():
    src, dst = sys.argv[1], sys.argv[2]
    text = open(src, encoding="latin-1").read()

    creates = {}
    for m in re.finditer(r"CREATE TABLE `([^`]+)` \((.*?)\n\) ENGINE=[^;]*;", text, re.S):
        creates[m.group(1)] = parse_create(m.group(1), m.group(2))
    if not creates:
        sys.exit("no CREATE TABLE found")

    primary_keys = {}
    for m in re.finditer(r"ALTER TABLE `([^`]+)`\s+ADD PRIMARY KEY \(([^)]*)\);", text):
        primary_keys[m.group(1)] = [c.strip().strip("`") for c in m.group(2).split(",")]

    auto_increment = {}  # table -> (column, next value)
    for m in re.finditer(
        r"ALTER TABLE `([^`]+)`\s+MODIFY `([^`]+)`[^;]*AUTO_INCREMENT(?:=(\d+))?;",
        text,
        re.I | re.S,
    ):
        auto_increment[m.group(1)] = (m.group(2), int(m.group(3) or 0))

    inserts = {}  # table -> list of rows
    for m in re.finditer(r"INSERT INTO `([^`]+)`\s*\(([^)]*)\)\s*VALUES", text, re.I):
        table = m.group(1)
        cols = [c.strip().strip("`") for c in m.group(2).split(",")]
        rows, _ = parse_insert(text, m.end())
        inserts.setdefault(table, [])
        inserts[table].append((cols, rows))

    con = sqlite3.connect(dst)
    cur = con.cursor()
    cur.execute("PRAGMA foreign_keys=OFF")
    for table, columns in creates.items():
        pk = primary_keys.get(table, [])
        ai = auto_increment.get(table)
        defs = []
        inline_pk_added = False
        for col, definition in columns:
            if ai and ai[0] == col and col in pk:
                # INTEGER PRIMARY KEY is the SQLite rowid alias
                defs.append(f'"{col}" INTEGER PRIMARY KEY AUTOINCREMENT')
                inline_pk_added = True
            else:
                defs.append(definition)
        if pk and not inline_pk_added:
            defs.append("PRIMARY KEY (" + ", ".join(f'"{c}"' for c in pk) + ")")
        cur.execute(f'CREATE TABLE "{table}" (\n  ' + ",\n  ".join(defs) + "\n)")

        total = 0
        for cols, rows in inserts.get(table, []):
            placeholders = ", ".join("?" * len(cols))
            statement = (
                f'INSERT INTO "{table}" (' + ", ".join(f'"{c}"' for c in cols) + f") VALUES ({placeholders})"
            )
            # Reuse our literal encoder by parsing the generated row strings back.
            for row in rows:
                values = []
                for literal in row:
                    if literal.upper() == "NULL":
                        values.append(None)
                    elif literal.startswith("'"):
                        values.append(literal[1:-1].replace("''", "'"))
                    else:
                        values.append(literal)
                cur.execute(statement, values)
                total += 1
        print(f"{table}: {total} rows")

    if auto_increment:
        for table, (_col, next_value) in auto_increment.items():
            if next_value:
                cur.execute("UPDATE sqlite_sequence SET seq = ? WHERE name = ?", (next_value - 1, table))
                if cur.rowcount == 0:
                    cur.execute("INSERT INTO sqlite_sequence(name, seq) VALUES (?, ?)", (table, next_value - 1))

    con.commit()
    con.close()
    print("written:", dst)


if __name__ == "__main__":
    main()
