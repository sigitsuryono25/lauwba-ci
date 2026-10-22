-- Patch schema/data dump 2019 agar cocok dengan kode aplikasi.
-- Urutan pemakaian:
--   1. python3 mysql2sqlite.py lauwbaco_versi22_latest.sql lauwbaco_versi22_latest.sqlite
--   2. sqlite3 lauwbaco_versi22_latest.sqlite < sqlite_patch.sql

-- ---------------------------------------------------------------------------
-- Kolom baru pada tabel lama
-- ---------------------------------------------------------------------------
ALTER TABLE kategori1 ADD COLUMN seq INTEGER NOT NULL DEFAULT 0;
ALTER TABLE kategori1 ADD COLUMN img TEXT NOT NULL DEFAULT '';
UPDATE kategori1 SET seq = id_kategori;

ALTER TABLE jenis ADD COLUMN seq INTEGER NOT NULL DEFAULT 0;
ALTER TABLE jenis ADD COLUMN image_srcset TEXT NOT NULL DEFAULT '';
ALTER TABLE jenis ADD COLUMN hrg_coret INTEGER NOT NULL DEFAULT 0;
ALTER TABLE jenis ADD COLUMN biaya_in_house_per_person TEXT NOT NULL DEFAULT '';
UPDATE jenis SET seq = id_jenis, hrg_coret = hrg;

ALTER TABLE gallery ADD COLUMN seq INTEGER NOT NULL DEFAULT 0;
UPDATE gallery SET seq = id_gallery;

ALTER TABLE kelas ADD COLUMN seq INTEGER NOT NULL DEFAULT 0;
ALTER TABLE kelas ADD COLUMN biaya_inhouse INTEGER NOT NULL DEFAULT 0;
ALTER TABLE kelas ADD COLUMN biaya_inhouse_coret INTEGER NOT NULL DEFAULT 0;
ALTER TABLE kelas ADD COLUMN biaya_private INTEGER NOT NULL DEFAULT 0;
ALTER TABLE kelas ADD COLUMN biaya_private_coret INTEGER NOT NULL DEFAULT 0;
ALTER TABLE kelas ADD COLUMN biaya_private_online INTEGER NOT NULL DEFAULT 0;
ALTER TABLE kelas ADD COLUMN biaya_private_online_coret INTEGER NOT NULL DEFAULT 0;
ALTER TABLE kelas ADD COLUMN biaya_private_off_luar_kota INTEGER NOT NULL DEFAULT 0;
ALTER TABLE kelas ADD COLUMN biaya_private_off_luar_kota_coret INTEGER NOT NULL DEFAULT 0;
ALTER TABLE kelas ADD COLUMN biaya_incubator INTEGER NOT NULL DEFAULT 0;
ALTER TABLE kelas ADD COLUMN biaya_incubator_coret INTEGER NOT NULL DEFAULT 0;
ALTER TABLE kelas ADD COLUMN biaya_luar_kota INTEGER NOT NULL DEFAULT 0;
ALTER TABLE kelas ADD COLUMN biaya_reg_online INTEGER NOT NULL DEFAULT 0;
ALTER TABLE kelas ADD COLUMN biaya_reg_online_coret INTEGER NOT NULL DEFAULT 0;
ALTER TABLE kelas ADD COLUMN biaya_in_house_per_person TEXT NOT NULL DEFAULT '';
UPDATE kelas SET
  seq = id_kelas,
  biaya_inhouse = biaya,
  biaya_inhouse_coret = biaya_coret,
  biaya_private = biaya,
  biaya_private_coret = biaya_coret,
  biaya_private_online = biaya,
  biaya_private_online_coret = biaya_coret,
  biaya_private_off_luar_kota = biaya,
  biaya_private_off_luar_kota_coret = biaya_coret,
  biaya_incubator = biaya,
  biaya_incubator_coret = biaya_coret,
  biaya_luar_kota = biaya,
  biaya_reg_online = biaya,
  biaya_reg_online_coret = biaya_coret,
  biaya_in_house_per_person = '{"biaya_1_2":' || biaya || ',"biaya_3_5":' || biaya || ',"biaya_lebih_6":' || biaya || '}';

ALTER TABLE video ADD COLUMN kategori INTEGER NOT NULL DEFAULT 0;
ALTER TABLE video ADD COLUMN thumbnail TEXT NOT NULL DEFAULT '';

ALTER TABLE tutor ADD COLUMN descriptions TEXT NOT NULL DEFAULT '';
ALTER TABLE tutor ADD COLUMN jabatan TEXT NOT NULL DEFAULT '';
ALTER TABLE tutor ADD COLUMN nomor_urut INTEGER NOT NULL DEFAULT 0;
ALTER TABLE tutor ADD COLUMN is_active TEXT NOT NULL DEFAULT 'Y';
ALTER TABLE tutor ADD COLUMN seq INTEGER NOT NULL DEFAULT 0;
UPDATE tutor SET seq = id_tutor;

-- ---------------------------------------------------------------------------
-- Tabel baru
-- ---------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS kategori_video (
  id_kategori INTEGER PRIMARY KEY AUTOINCREMENT,
  nama_kategori TEXT NOT NULL DEFAULT '',
  slug TEXT NOT NULL DEFAULT '',
  seq INTEGER NOT NULL DEFAULT 0
);

CREATE TABLE IF NOT EXISTS alamat (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  daerah TEXT NOT NULL DEFAULT '',
  alamat TEXT NOT NULL DEFAULT ''
);

CREATE TABLE IF NOT EXISTS jadwal (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  id_jadwal INTEGER NOT NULL DEFAULT 0,
  id_jenis INTEGER NOT NULL DEFAULT 0,
  id_kelas INTEGER NOT NULL DEFAULT 0,
  tanggal TEXT NOT NULL DEFAULT '',
  bulan TEXT NOT NULL DEFAULT '',
  tahun TEXT NOT NULL DEFAULT '',
  kota_pelaksanaan TEXT NOT NULL DEFAULT '',
  keterangan TEXT NOT NULL DEFAULT '',
  jam_mulai TEXT NOT NULL DEFAULT '',
  jam_selesai TEXT NOT NULL DEFAULT '',
  durasi TEXT NOT NULL DEFAULT '',
  tempat TEXT NOT NULL DEFAULT '',
  active TEXT NOT NULL DEFAULT 'Y',
  deleted INTEGER NOT NULL DEFAULT 0
);

CREATE TABLE IF NOT EXISTS tb_voucher (
  _id INTEGER PRIMARY KEY AUTOINCREMENT,
  kode_voucher TEXT NOT NULL DEFAULT '',
  nama_voucher TEXT NOT NULL DEFAULT '',
  deskripsi TEXT NOT NULL DEFAULT '',
  syarat TEXT NOT NULL DEFAULT '',
  slug TEXT NOT NULL DEFAULT '',
  gambar TEXT NOT NULL DEFAULT '',
  berlaku TEXT NOT NULL DEFAULT '',
  nominal INTEGER NOT NULL DEFAULT 0,
  is_highlight TEXT NOT NULL DEFAULT 'N',
  tampil_di_promo TEXT NOT NULL DEFAULT 'N',
  deleted INTEGER NOT NULL DEFAULT 0
);

CREATE TABLE IF NOT EXISTS popup_image (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  url TEXT NOT NULL DEFAULT '',
  foto TEXT NOT NULL DEFAULT '',
  forwho TEXT NOT NULL DEFAULT '',
  is_active TEXT NOT NULL DEFAULT 'N',
  deleted INTEGER NOT NULL DEFAULT 0
);

CREATE TABLE IF NOT EXISTS tb_faq (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  pertanyaan TEXT NOT NULL DEFAULT '',
  jawaban TEXT NOT NULL DEFAULT '',
  seq INTEGER NOT NULL DEFAULT 0
);

CREATE TABLE IF NOT EXISTS pendaftar (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  nama_lengkap TEXT NOT NULL DEFAULT '',
  email TEXT NOT NULL DEFAULT '',
  random TEXT NOT NULL DEFAULT '',
  nomor_telepon TEXT NOT NULL DEFAULT '',
  instansi TEXT NOT NULL DEFAULT '',
  jabatan TEXT NOT NULL DEFAULT '',
  harga INTEGER NOT NULL DEFAULT 0,
  tahu_darimana TEXT NOT NULL DEFAULT '',
  motivasi TEXT NOT NULL DEFAULT '',
  keterangan TEXT NOT NULL DEFAULT '',
  voucher TEXT NOT NULL DEFAULT '',
  "from" TEXT NOT NULL DEFAULT '',
  referral_code TEXT NOT NULL DEFAULT '',
  affiliate_code TEXT NOT NULL DEFAULT '',
  kota TEXT NOT NULL DEFAULT '',
  training INTEGER NOT NULL DEFAULT 0,
  pilihan_kelas TEXT NOT NULL DEFAULT '',
  jadwal TEXT NOT NULL DEFAULT '',
  private_tanggal_mulai TEXT NOT NULL DEFAULT '',
  private_kota_pelaksanaan TEXT NOT NULL DEFAULT '',
  alamat_private_offline TEXT NOT NULL DEFAULT '',
  durasi TEXT NOT NULL DEFAULT '',
  inkubator_tanggal_mulai TEXT NOT NULL DEFAULT '',
  in_house_kota_pelaksanaan TEXT NOT NULL DEFAULT '',
  in_house_tanggal_mulai TEXT NOT NULL DEFAULT '',
  in_house_tanggal_selesai TEXT NOT NULL DEFAULT '',
  in_house_jumlah_peserta INTEGER NOT NULL DEFAULT 0,
  daftar_pada TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
  status TEXT NOT NULL DEFAULT '',
  selected_trainer INTEGER NOT NULL DEFAULT 0,
  metode_pembayaran TEXT NOT NULL DEFAULT '',
  bukti_bayar TEXT NOT NULL DEFAULT '',
  catatan TEXT NOT NULL DEFAULT '',
  expired_invoices TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
  deleted INTEGER NOT NULL DEFAULT 0
);

CREATE TABLE IF NOT EXISTS rekening (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  bank TEXT NOT NULL DEFAULT '',
  nomor_rekening TEXT NOT NULL DEFAULT '',
  atas_nama TEXT NOT NULL DEFAULT '',
  filename TEXT NOT NULL DEFAULT '',
  is_active TEXT NOT NULL DEFAULT '1',
  seq INTEGER NOT NULL DEFAULT 0
);

CREATE TABLE IF NOT EXISTS tag (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  id_kolom INTEGER NOT NULL DEFAULT 0,
  nama_tag TEXT NOT NULL DEFAULT '',
  tag TEXT NOT NULL DEFAULT '',
  seq INTEGER NOT NULL DEFAULT 0
);

CREATE TABLE IF NOT EXISTS history_trans (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  id_daftar INTEGER NOT NULL DEFAULT 0,
  id_project INTEGER NOT NULL DEFAULT 0,
  jumlah_bayar INTEGER NOT NULL DEFAULT 0,
  transaksi_pada TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
  transaksi_pajak TEXT NOT NULL DEFAULT '',
  metode_pembayaran TEXT NOT NULL DEFAULT '',
  bukti_bayar TEXT NOT NULL DEFAULT '',
  keterangan TEXT NOT NULL DEFAULT '',
  deleted INTEGER NOT NULL DEFAULT 0
);

CREATE TABLE IF NOT EXISTS akun_user (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  email TEXT NOT NULL DEFAULT '',
  nama TEXT NOT NULL DEFAULT '',
  nomor_telepon TEXT NOT NULL DEFAULT '',
  tahu_dari_mana TEXT NOT NULL DEFAULT '',
  jabatan TEXT NOT NULL DEFAULT '',
  instansi TEXT NOT NULL DEFAULT '',
  affiliate_code TEXT NOT NULL DEFAULT '',
  password TEXT NOT NULL DEFAULT ''
);

-- ---------------------------------------------------------------------------
-- Data awal (supaya halaman tidak error karena query ->row() kosong)
-- ---------------------------------------------------------------------------
INSERT INTO alamat (daerah, alamat) VALUES
  ('Yogyakarta', 'Lantai 2 IT Training Center Room Lauwba Techno, Jl. Kusumanegara No 224 Yogyakarta'),
  ('Jakarta', 'Dhaya Pesona, Jl. Bougenvile II No.2, Jombang, Ciputat, South Tangerang City, Banten 15414'),
  ('Makassar', 'Ruko Sumber Rezeki, Jl. Perintis Kemerdekaan No.4, Tamalanrea Indah, Makassar, Sulawesi Selatan 90245');

INSERT INTO tb_voucher (kode_voucher, nama_voucher, deskripsi, syarat, slug, berlaku, nominal, is_highlight, tampil_di_promo, deleted) VALUES
  ('LAUWBA', 'PROMO KURSUS', 'Dapatkan potongan harga untuk pendaftaran kursus/training di Lauwba Techno Indonesia.', 'Berlaku untuk pendaftaran kelas reguler.', 'promo-kursus', '2027-12-31', 0, 'Y', 'Y', 0);

INSERT INTO kategori_video (nama_kategori, slug, seq) VALUES
  ('Tutorial', 'tutorial', 1),
  ('Dokumentasi Training', 'dokumentasi-training', 2);

ALTER TABLE tag ADD COLUMN tag_seo TEXT NOT NULL DEFAULT '';

-- Data dump lama masih memakai id kategori yang tidak ada di tabel kategori.
UPDATE news SET id_kategori = 40, judul_seo = 'materi-html' WHERE id_news = 3;
UPDATE news SET id_kategori = 40 WHERE id_news = 2;

INSERT OR IGNORE INTO halamanstatis (id_halaman, judul, isi_halaman, tgl_posting, gambar, judul_seo) VALUES
  (40, 'Hiring Partner', 'Informasi hiring partner Lauwba Techno Indonesia.', '2026-01-01 00:00:00', '', 'hairing-partner'),
  (41, 'Careers', 'Informasi karier di Lauwba Techno Indonesia.', '2026-01-01 00:00:00', '', 'careers'),
  (42, 'Clients', 'Klien dan mitra Lauwba Techno Indonesia.', '2026-01-01 00:00:00', '', 'clients'),
  (43, 'About', 'Tentang Lauwba Techno Indonesia.', '2026-01-01 00:00:00', '', 'about'),
  (44, 'Profile Lauwba', 'Profil Lauwba Techno Indonesia.', '2026-01-01 00:00:00', '', 'profile-lauwba');

INSERT INTO tb_faq (pertanyaan, jawaban, seq) VALUES
  ('Bagaimana cara mendaftar kursus?', 'Pendaftaran dapat dilakukan melalui halaman daftar di website atau menghubungi admin via WhatsApp.', 1),
  ('Apakah tersedia kelas online?', 'Ya, tersedia kelas reguler online, private online, dan in-house training.', 2);

-- ---------------------------------------------------------------------------
-- Kontak website (dipakai API /api/contact untuk Lauwba Online Course)
-- ---------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS kontak (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  email TEXT NOT NULL DEFAULT '',
  telepon TEXT NOT NULL DEFAULT '',
  whatsapp TEXT NOT NULL DEFAULT '',
  whatsapp_pesan TEXT NOT NULL DEFAULT '',
  facebook_label TEXT NOT NULL DEFAULT '',
  facebook_url TEXT NOT NULL DEFAULT '',
  twitter_label TEXT NOT NULL DEFAULT '',
  twitter_url TEXT NOT NULL DEFAULT '',
  instagram_label TEXT NOT NULL DEFAULT '',
  instagram_url TEXT NOT NULL DEFAULT '',
  maps_embed TEXT NOT NULL DEFAULT '',
  updated_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP
);

INSERT OR IGNORE INTO kontak (
  id, email, telepon, whatsapp, whatsapp_pesan,
  facebook_label, facebook_url,
  twitter_label, twitter_url,
  instagram_label, instagram_url,
  maps_embed
) VALUES (
  1,
  'info@lauwba.com',
  '0274-4435 9440',
  '08 222 1 777 206',
  'Maaf Bu, Mau Konsultasi tentang training/kursus di Lauwba...',
  'Lauwba Techno Indonesia',
  'http://www.facebook.com/LauwbaTechno',
  '@lauwbatechno',
  'https://twitter.com/@lauwbatechno',
  '@lauwba_techno',
  'https://www.instagram.com/lauwba_techno/',
  'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31623.24957438492!2d110.3843626181536!3d-7.799755351345503!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5765d4d95351%3A0x5175f045ca1816c!2sLauwba+Techo+Indonesia+Wilayah+Yogykarta!5e0!3m2!1sid!2sid!4v1509164706236'
);
