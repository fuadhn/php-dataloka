-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table php_dataloka.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table php_dataloka.m_kyc_pelanggan
CREATE TABLE IF NOT EXISTS `m_kyc_pelanggan` (
  `ID_KYC` bigint unsigned NOT NULL AUTO_INCREMENT,
  `KYC` json NOT NULL,
  `TGL_MULAI_AKTIF` date NOT NULL,
  `STATUS_AKTIF` enum('Y','T') COLLATE utf8mb4_unicode_ci NOT NULL,
  `DELETED` tinyint NOT NULL,
  `CREATED_BY` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CREATED_AT` datetime NOT NULL,
  `UPDATED_BY` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `UPDATED_AT` datetime NOT NULL,
  PRIMARY KEY (`ID_KYC`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table php_dataloka.m_paket_produk
CREATE TABLE IF NOT EXISTS `m_paket_produk` (
  `ID_PAKET_PRODUK` bigint unsigned NOT NULL AUTO_INCREMENT,
  `GRANULARITY_ID` int NOT NULL,
  `ID_DELIVERY` int NOT NULL,
  `ID_JENIS_PAKET_PRODUK` int NOT NULL,
  `NAMA_PRODUK` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DESKRIPSI_PRODUK` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `JURNAL_PRODUK_ID` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `GAMBAR` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `HARGA` int NOT NULL,
  `TNC` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `URL_SAMPLE_API` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `STATUS_TAMPIL` enum('Y','T') COLLATE utf8mb4_unicode_ci NOT NULL,
  `STATUS_AKTIF` enum('Y','T') COLLATE utf8mb4_unicode_ci NOT NULL,
  `STATUS_B2B` enum('Y','T') COLLATE utf8mb4_unicode_ci NOT NULL,
  `DELETED` tinyint NOT NULL,
  `CREATED_BY` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CREATED_AT` datetime NOT NULL,
  `UPDATED_BY` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `UPDATED_AT` datetime NOT NULL,
  PRIMARY KEY (`ID_PAKET_PRODUK`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table php_dataloka.m_payment_gateway
CREATE TABLE IF NOT EXISTS `m_payment_gateway` (
  `ID_PAYMENT_GATEWAY` bigint unsigned NOT NULL AUTO_INCREMENT,
  `METODE_PEMBAYARAN` enum('Bank Transfer','GoPay','OVO','Dana','ShopeePay') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`ID_PAYMENT_GATEWAY`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table php_dataloka.m_pelanggan
CREATE TABLE IF NOT EXISTS `m_pelanggan` (
  `ID_PELANGGAN` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ID_KYC` bigint unsigned NOT NULL,
  `ID_PERUSAHAAN` bigint unsigned NOT NULL,
  `USERNAME` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PASSWORD` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NAMA_PELANGGAN` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TEMPAT_LAHIR` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TANGGAL_LAHIR` date NOT NULL,
  `GENDER` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `ALAMAT_KTP` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ALAMAT_DOMISILI` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KOTA_DOMISILI` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PROVINSI_DOMISILI` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `EMAIL` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NO_HP` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `FB` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PROFILE_PHOTO` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KYC` json NOT NULL,
  `JABATAN` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SKOR_KUESIONER` int NOT NULL,
  `STATUS_PELANGGAN` enum('b2b','b2c') COLLATE utf8mb4_unicode_ci NOT NULL,
  `STATUS_AKUN` enum('aktif','delete','suspend') COLLATE utf8mb4_unicode_ci NOT NULL,
  `ROLE_PELANGGAN` enum('admin','anggota') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `STATUS_MITRA` enum('mitra','pelanggan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `DELETED` tinyint NOT NULL,
  `CREATED_BY` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CREATED_AT` datetime NOT NULL,
  `UPDATED_BY` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `UPDATED_AT` datetime NOT NULL,
  PRIMARY KEY (`ID_PELANGGAN`),
  KEY `m_pelanggan_id_kyc_foreign` (`ID_KYC`),
  KEY `m_pelanggan_id_perusahaan_foreign` (`ID_PERUSAHAAN`),
  CONSTRAINT `m_pelanggan_id_kyc_foreign` FOREIGN KEY (`ID_KYC`) REFERENCES `m_kyc_pelanggan` (`ID_KYC`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `m_pelanggan_id_perusahaan_foreign` FOREIGN KEY (`ID_PERUSAHAAN`) REFERENCES `m_perusahaan_b2b` (`ID_PERUSAHAAN`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table php_dataloka.m_perusahaan_b2b
CREATE TABLE IF NOT EXISTS `m_perusahaan_b2b` (
  `ID_PERUSAHAAN` bigint unsigned NOT NULL AUTO_INCREMENT,
  `NAMA_PERUSAHAAN` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ALAMAT_PERUSAHAAN` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NO_TELP_PERUSAHAAN` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NPWP_PERUSAHAAN` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DELETED` tinyint NOT NULL,
  `CREATED_BY` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CREATED_AT` datetime NOT NULL,
  `UPDATED_BY` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `UPDATED_AT` datetime NOT NULL,
  PRIMARY KEY (`ID_PERUSAHAAN`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table php_dataloka.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table php_dataloka.t_berlangganan_produk
CREATE TABLE IF NOT EXISTS `t_berlangganan_produk` (
  `ID_BERLANGGANAN` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ID_PELANGGAN` bigint unsigned NOT NULL,
  `BER_ID_BERLANGGANAN` bigint unsigned DEFAULT NULL,
  `ID_PAKET_PRODUK` bigint unsigned NOT NULL,
  `TANGGAL_MULAI` date NOT NULL,
  `TANGGAL_AKHIR` date NOT NULL,
  `BIAYA` int NOT NULL,
  `STATUS` enum('Aktif','Tidak Aktif','Ditolak') COLLATE utf8mb4_unicode_ci NOT NULL,
  `KUOTA_SURAT_RISET` int NOT NULL,
  `SISA_KUOTA_SURAT_RISET` int NOT NULL,
  `KUOTA_DOWNLOAD` int NOT NULL,
  `SISA_KUOTA_DOWNLOAD` int NOT NULL,
  `FREE_TRIAL_STATUS` enum('Y','T') COLLATE utf8mb4_unicode_ci NOT NULL,
  `DELETED` tinyint NOT NULL,
  `CREATED_BY` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CREATED_AT` datetime NOT NULL,
  `UPDATED_BY` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `UPDATED_AT` datetime NOT NULL,
  PRIMARY KEY (`ID_BERLANGGANAN`),
  KEY `t_berlangganan_produk_id_pelanggan_foreign` (`ID_PELANGGAN`),
  KEY `t_berlangganan_produk_ber_id_berlangganan_foreign` (`BER_ID_BERLANGGANAN`),
  KEY `t_berlangganan_produk_id_paket_produk_foreign` (`ID_PAKET_PRODUK`),
  CONSTRAINT `t_berlangganan_produk_ber_id_berlangganan_foreign` FOREIGN KEY (`BER_ID_BERLANGGANAN`) REFERENCES `t_berlangganan_produk` (`ID_BERLANGGANAN`) ON UPDATE CASCADE,
  CONSTRAINT `t_berlangganan_produk_id_paket_produk_foreign` FOREIGN KEY (`ID_PAKET_PRODUK`) REFERENCES `m_paket_produk` (`ID_PAKET_PRODUK`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `t_berlangganan_produk_id_pelanggan_foreign` FOREIGN KEY (`ID_PELANGGAN`) REFERENCES `m_pelanggan` (`ID_PELANGGAN`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table php_dataloka.t_detail_tagihan
CREATE TABLE IF NOT EXISTS `t_detail_tagihan` (
  `ID_DETAIL_TAGIHAN` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ID_TAGIHAN` bigint unsigned NOT NULL,
  `ID_BERLANGGANAN` bigint unsigned NOT NULL,
  `JUMLAH` int NOT NULL,
  `HARGA_SATUAN` int NOT NULL,
  `DELETED` tinyint NOT NULL,
  `CREATED_BY` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CREATED_AT` datetime NOT NULL,
  `UPDATED_BY` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `UPDATED_AT` datetime NOT NULL,
  PRIMARY KEY (`ID_DETAIL_TAGIHAN`),
  KEY `t_detail_tagihan_id_tagihan_foreign` (`ID_TAGIHAN`),
  KEY `t_detail_tagihan_id_berlangganan_foreign` (`ID_BERLANGGANAN`),
  CONSTRAINT `t_detail_tagihan_id_berlangganan_foreign` FOREIGN KEY (`ID_BERLANGGANAN`) REFERENCES `t_berlangganan_produk` (`ID_BERLANGGANAN`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `t_detail_tagihan_id_tagihan_foreign` FOREIGN KEY (`ID_TAGIHAN`) REFERENCES `t_tagihan_produk` (`ID_TAGIHAN`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table php_dataloka.t_pembayaran
CREATE TABLE IF NOT EXISTS `t_pembayaran` (
  `ID_PEMBAYARAN` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ID_TAGIHAN` bigint unsigned NOT NULL,
  `ID_PAYMENT_GATEWAY` bigint unsigned NOT NULL,
  `ID_PROMOSI` int NOT NULL,
  `ID_VOUCHER` int NOT NULL,
  `ID_TERMIN_B2B` int NOT NULL,
  `TANGGAL_BAYAR` date NOT NULL,
  `JUMLAH_BAYAR` int NOT NULL,
  `UANG_MUKA` int NOT NULL,
  `DISKON` int NOT NULL,
  `KODE_MITRA` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `FILE_FAKTUR` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `STATUS_BAYAR` enum('BERHASIL','GAGAL') COLLATE utf8mb4_unicode_ci NOT NULL,
  `UPLOAD_BUKTI_BAYAR` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `APPROVE_BUKTI_BAYAR` enum('DISETUJUI','DITOLAK') COLLATE utf8mb4_unicode_ci NOT NULL,
  `DELETED` tinyint NOT NULL,
  `CREATED_BY` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CREATED_AT` datetime NOT NULL,
  `UPDATED_BY` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `UPDATED_AT` datetime NOT NULL,
  PRIMARY KEY (`ID_PEMBAYARAN`),
  KEY `t_pembayaran_id_tagihan_foreign` (`ID_TAGIHAN`),
  KEY `t_pembayaran_id_payment_gateway_foreign` (`ID_PAYMENT_GATEWAY`),
  CONSTRAINT `t_pembayaran_id_payment_gateway_foreign` FOREIGN KEY (`ID_PAYMENT_GATEWAY`) REFERENCES `m_payment_gateway` (`ID_PAYMENT_GATEWAY`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `t_pembayaran_id_tagihan_foreign` FOREIGN KEY (`ID_TAGIHAN`) REFERENCES `t_tagihan_produk` (`ID_TAGIHAN`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table php_dataloka.t_tagihan_produk
CREATE TABLE IF NOT EXISTS `t_tagihan_produk` (
  `ID_TAGIHAN` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ID_JENIS_PAJAK` int NOT NULL,
  `JUMLAH_TAGIHAN` int NOT NULL,
  `TANGGAL_TAGIHAN` date NOT NULL,
  `TANGGAL_JATUH_TEMPO` date NOT NULL,
  `TOTAL_ITEM` int NOT NULL,
  `STATUS_TAGIHAN` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DISKON` int NOT NULL,
  `NOMOR_TAGIHAN` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `BESAR_PAJAK` int NOT NULL,
  `STATUS_TERMIN_B2B` enum('Y','T') COLLATE utf8mb4_unicode_ci NOT NULL,
  `DELETED` tinyint NOT NULL,
  `CREATED_BY` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CREATED_AT` datetime NOT NULL,
  `UPDATED_BY` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `UPDATED_AT` datetime NOT NULL,
  PRIMARY KEY (`ID_TAGIHAN`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
