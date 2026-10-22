-- Tabel kontak untuk website utama Lauwba.
-- Jalankan sekali di server MySQL:
--   mysql -u USER -p NAMA_DATABASE < database/add_kontak_table.sql
--
-- Data awal diambil dari halaman kontak website lama. Kalau baris id=1 sudah
-- ada, INSERT IGNORE tidak akan menimpa data yang sudah diubah di server.

CREATE TABLE IF NOT EXISTS `kontak` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(150) NOT NULL DEFAULT '',
  `telepon` varchar(50) NOT NULL DEFAULT '',
  `whatsapp` varchar(50) NOT NULL DEFAULT '',
  `whatsapp_pesan` varchar(255) NOT NULL DEFAULT '',
  `facebook_label` varchar(100) NOT NULL DEFAULT '',
  `facebook_url` varchar(255) NOT NULL DEFAULT '',
  `twitter_label` varchar(100) NOT NULL DEFAULT '',
  `twitter_url` varchar(255) NOT NULL DEFAULT '',
  `instagram_label` varchar(100) NOT NULL DEFAULT '',
  `instagram_url` varchar(255) NOT NULL DEFAULT '',
  `maps_embed` text,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT IGNORE INTO `kontak` (
  `id`,
  `email`,
  `telepon`,
  `whatsapp`,
  `whatsapp_pesan`,
  `facebook_label`,
  `facebook_url`,
  `twitter_label`,
  `twitter_url`,
  `instagram_label`,
  `instagram_url`,
  `maps_embed`
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
