-- Database accounting (MySQL) tidak punya dump di repo ini.
-- Aplikasi hanya memakai tb_logo dari database ini (lihat views/module_client.php),
-- jadi cukup dibuatkan tabelnya agar koneksi SQLite tidak error.
CREATE TABLE IF NOT EXISTS tb_logo (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  logo_name TEXT NOT NULL DEFAULT '',
  file TEXT NOT NULL DEFAULT '',
  sequence INTEGER NOT NULL DEFAULT 0,
  deleted INTEGER NOT NULL DEFAULT 0
);
