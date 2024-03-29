/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.4.19-MariaDB : Database - perpustakaan_skripsi
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`perpustakaan_skripsi` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `perpustakaan_skripsi`;

/*Table structure for table `anggotas` */

DROP TABLE IF EXISTS `anggotas`;

CREATE TABLE `anggotas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nisn` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kelas` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `anggotas_nisn_unique` (`nisn`),
  KEY `anggotas_user_id_foreign` (`user_id`),
  CONSTRAINT `anggotas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `anggotas` */

insert  into `anggotas`(`id`,`nisn`,`nama`,`jk`,`no_hp`,`alamat`,`user_id`,`created_at`,`updated_at`,`kelas`) values (1,'1122334455','ANTO','P','0894','Est magna maxime pa',1,'2023-05-09 07:37:57','2023-05-09 08:48:27','7B'),(7,'01731471841','Ucok','L','098765432','A saepe molestiae id',8,'2023-05-10 03:32:06','2023-05-13 13:45:35','7C'),(8,'0101010101','bo bo boy','L','235252352','Jl.Binjai',9,'2023-05-31 14:31:15','2023-05-31 14:31:15','8A'),(9,'235235325325','Intan Herma','P','034683468783','Jl.sghsgs',11,'2023-06-10 08:03:56','2023-06-10 08:03:56','9A'),(10,'124112412','Marion','L','082752','Jl.adada',10,'2023-07-12 11:00:22','2023-07-12 11:00:22','8B'),(11,'2424424242','Marion Putra','L','08173131378','Jl.Permata Harbaindo',12,'2023-07-12 14:54:10','2023-07-12 14:54:10','7A');

/*Table structure for table `books` */

DROP TABLE IF EXISTS `books`;

CREATE TABLE `books` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `jenis_buku_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul_buku` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_isbn` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_terbit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerbit_buku` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengarang_buku` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rak_buku_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_buku` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `books` */

insert  into `books`(`id`,`jenis_buku_id`,`judul_buku`,`no_isbn`,`tahun_terbit`,`penerbit_buku`,`pengarang_buku`,`rak_buku_id`,`jumlah_buku`,`gambar`,`created_at`,`updated_at`) values (2,'2','Laskar Pelangi','979-3062-79-7','2005','Yogyakarta','Andrea Hirata','7','166','wTFRKIpwxiIT0WNUWZNt9sjB4x5VUV6UwlW9ulj3.jpg','2023-05-08 10:04:35','2023-07-13 00:37:57'),(3,'3','Hujan','978-602-03-2478-4','2016','Jakarta PT. Gramedia Pustaka Utama','Tere Liye','7','86','Upvzyw0zvXUJgHlSx8Yd8U5GPBVjoX1T2A9yy3aW.jpg','2023-05-10 06:56:03','2023-07-13 00:12:07'),(4,'2','Marmut merah jambu','602-8066-64-8','2010','Jakarta','Raditya Dika','7','101','7LUI18k7c6Sj7NzEsy9noMHCBIWAlV3wjmhGTj5z.jpg','2023-05-13 12:35:09','2023-07-13 00:15:07'),(5,'4','Kancil dan Buaya','ISBN-012124242','2016','Bestari Buana Murni','Rahimidin Zahari & Jaatar Taib','7','98','g78gE1YL0oSipBQK72JwEyf6AbJb1v9ccIuBtAqh.jpg','2023-06-10 08:02:39','2023-07-13 00:19:27');

/*Table structure for table `detail_peminjaman` */

DROP TABLE IF EXISTS `detail_peminjaman`;

CREATE TABLE `detail_peminjaman` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_peminjaman` int(11) NOT NULL,
  `id_buku_pinjam` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isbn_buku` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul_buku` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_buku` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `detail_peminjaman` */

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `jenis_bukus` */

DROP TABLE IF EXISTS `jenis_bukus`;

CREATE TABLE `jenis_bukus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `jenis_bukus` */

insert  into `jenis_bukus`(`id`,`name`,`slug`,`created_at`,`updated_at`) values (2,'Comic','comic','2023-05-07 14:16:51','2023-05-07 14:16:51'),(3,'Comedy','comedy','2023-05-08 02:22:38','2023-05-08 02:22:38'),(4,'Cerita Anak','cerita-anak','2023-07-13 00:18:23','2023-07-13 00:18:23');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (7,'2014_10_12_000000_create_users_table',1),(8,'2014_10_12_100000_create_password_resets_table',1),(9,'2019_08_19_000000_create_failed_jobs_table',1),(10,'2019_12_14_000001_create_personal_access_tokens_table',1),(11,'2023_05_07_075646_create_jenis_bukus_table',1),(12,'2023_05_07_132923_add_role_to_users_table',1),(13,'2023_05_08_042037_create_rak_bukus_table',2),(14,'2023_05_08_071557_create_books_table',3),(15,'2023_05_09_071344_create_anggotas_table',4),(16,'2023_05_09_095331_create_peminjaman_table',5),(17,'2023_05_09_095628_create_peminjaman_temp_table',5),(18,'2023_05_09_095703_create_detail_peminjaman_table',5),(19,'2023_05_11_040142_add_status_to_detail_peminjaman',6),(20,'2023_05_11_043314_create_pengembalians_table',7),(21,'2023_05_11_082129_add_tanggal_pengembalian_to_pengembalians',8),(22,'2023_05_13_121917_add_status_to_detail_peminjaman',9),(23,'2023_05_14_044852_add_tanggal_pengembalian_to_pengembalians',10),(24,'2023_05_20_030151_add_jumlah_hari_terlambat_to_pengembalians',11);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `peminjaman` */

DROP TABLE IF EXISTS `peminjaman`;

CREATE TABLE `peminjaman` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_peminjaman` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `id_anggota_peminjaman` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `peminjaman` */

/*Table structure for table `peminjaman_temp` */

DROP TABLE IF EXISTS `peminjaman_temp`;

CREATE TABLE `peminjaman_temp` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `isbn` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `peminjaman_temp` */

/*Table structure for table `pengembalians` */

DROP TABLE IF EXISTS `pengembalians`;

CREATE TABLE `pengembalians` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_anggota` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_buku` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pengembalian` date DEFAULT NULL,
  `jumlah_hari_terlambat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `denda` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pengembalians` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `rak_bukus` */

DROP TABLE IF EXISTS `rak_bukus`;

CREATE TABLE `rak_bukus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `no_rak` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_rak` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kapasitas_rak` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `rak_bukus` */

insert  into `rak_bukus`(`id`,`no_rak`,`nama_rak`,`kapasitas_rak`,`created_at`,`updated_at`) values (7,'12','Mawar','100','2023-05-08 05:16:56','2023-05-08 05:18:29');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`role`,`remember_token`,`created_at`,`updated_at`) values (1,'Anggota','anggota@gmail.com',NULL,'$2y$10$R7MdWvCNtCAHMjft7zemXOVMxUuWDz85GKdPoLZjGezExWdfp.gvW',0,NULL,'2023-05-07 14:00:22','2023-05-08 04:02:28'),(2,'Admin','admin@gmail.com',NULL,'$2y$10$ZExBzWKFxgYXeeOEs5a.uuTWqZQ92.9JPxdMTMLX2nm7VxdoZQtkq',1,NULL,'2023-05-07 14:00:22','2023-05-07 14:00:22'),(3,'Pimpinan','pimpinan@gmail.com',NULL,'$2y$10$iVebGrxIPYYz0ktI7zpPGOdmQYBVM3FokSQj30PhfOxmVSskZhf2S',2,NULL,'2023-05-07 14:00:22','2023-05-07 14:00:22'),(8,'Echo Tate','bulix@mailinator.com',NULL,'$2y$10$9p6BK9OV06UiKAJC.omxUO62upBgzy2H5sSXXKBImzB4wWTpPpTx6',0,NULL,'2023-05-09 07:41:58','2023-05-18 10:28:16'),(9,'ucok','ucok@gmail.com',NULL,'$2y$10$ZExBzWKFxgYXeeOEs5a.uuTWqZQ92.9JPxdMTMLX2nm7VxdoZQtkq',0,NULL,'2023-05-31 14:07:56','2023-05-31 14:07:56'),(10,'Abbot Bonner','a@gmail.com',NULL,'$2y$10$fyrHmqy6qnUR9RYaSfPR2eX9jklk0y.T9L0w7i.diqIbV8WyEbsm2',0,NULL,'2023-05-31 14:11:38','2023-05-31 14:11:38'),(11,'intan','intan@gmail.com',NULL,'$2y$10$u4uPiPqsBHVw2hPUb36/GeEtDgObs/gAKSSMd0C5BBny7d63.FFze',0,NULL,'2023-06-10 08:03:16','2023-06-10 08:03:16'),(12,'tivulocako','ab@gmail.com',NULL,'$2y$10$ngAbe0uuavmlrkObMXCJq.jNoITtONStvQvjXRExfzIe2lU8kNuIq',0,NULL,'2023-07-12 14:54:10','2023-07-12 14:54:10');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
