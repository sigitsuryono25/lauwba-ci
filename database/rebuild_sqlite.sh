#!/usr/bin/env bash
# Rebuild database/lauwbaco_versi22_latest.sqlite from the MySQL dump + schema patch.
set -e
cd "$(dirname "$0")"
rm -f lauwbaco_versi22_latest.sqlite
python3 mysql2sqlite.py lauwbaco_versi22_latest.sql lauwbaco_versi22_latest.sqlite
sqlite3 lauwbaco_versi22_latest.sqlite < sqlite_patch.sql
sqlite3 lauwbaco_versi22_latest.sqlite "VACUUM;"
sqlite3 lauwbaco_accounting.sqlite < sqlite_accounting.sql
echo "OK: lauwbaco_versi22_latest.sqlite + lauwbaco_accounting.sqlite"
