# ************************************************************
# Sequel Pro SQL dump
# Version 5224
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 8.0.12)
# Database: challenge2
# Generation Time: 2018-10-21 14:10:12 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table merchandises
# ------------------------------------------------------------

DROP TABLE IF EXISTS `merchandises`;

CREATE TABLE `merchandises` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `merchandises` WRITE;
/*!40000 ALTER TABLE `merchandises` DISABLE KEYS */;

INSERT INTO `merchandises` (`id`, `shop_id`, `name`, `price`, `created_at`, `updated_at`)
VALUES
	(1,1,'古製滷大排飯',79,'2018-10-21 22:08:03','2018-10-21 09:55:42'),
	(2,1,'白斬雞飯',79,'2018-10-21 22:08:03','2018-10-21 09:56:44'),
	(3,1,'招牌咖哩雞飯',79,'2018-10-21 22:08:03','2018-10-21 14:37:24'),
	(4,1,'香酥炸雞腿飯',79,'2018-10-21 22:08:03','2018-10-21 22:08:03'),
	(5,1,'特製鮮魚飯',79,'2018-10-21 22:08:03','2018-10-21 22:08:03'),
	(6,1,'秘醬烤雞腿飯',79,'2018-10-21 22:08:03','2018-10-21 22:08:03'),
	(7,1,'紐奧良辣雞飯',79,'2018-10-21 22:08:03','2018-10-21 22:08:03'),
	(8,1,'黃金炸豬排飯',79,'2018-10-21 22:08:03','2018-10-21 22:08:03'),
	(9,1,'蜜汁雞排飯',79,'2018-10-21 22:08:03','2018-10-21 22:08:03'),
	(10,1,'家鄉三杯雞飯',79,'2018-10-21 22:08:03','2018-10-21 22:08:03');

/*!40000 ALTER TABLE `merchandises` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(1,'2014_10_12_000000_create_users_table',1),
	(2,'2014_10_12_100000_create_password_resets_table',1),
	(3,'2018_10_16_124515_create_shops_table',1),
	(4,'2018_10_16_124532_create_orders_table',1),
	(5,'2018_10_16_124548_create_merchandises_table',1);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table orders
# ------------------------------------------------------------

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `merchandise` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `count` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table shops
# ------------------------------------------------------------

DROP TABLE IF EXISTS `shops`;

CREATE TABLE `shops` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `shops_address_unique` (`address`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `shops` WRITE;
/*!40000 ALTER TABLE `shops` DISABLE KEYS */;

INSERT INTO `shops` (`id`, `name`, `address`, `telephone`, `created_at`, `updated_at`)
VALUES
	(1,'拾參招自助食堂','臺南市永康區中華路682-1號','063029103','2018-10-21 22:01:36','2018-10-21 22:01:47');

/*!40000 ALTER TABLE `shops` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_Admin` tinyint(1) NOT NULL DEFAULT '0',
  `api_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `is_Admin`, `api_token`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(1,'Kao','kao@gmail.com',NULL,'$2y$10$KXhPPiOXd0grGp7.dhOUIen0pIVwXvpfXqUCl2qwHD/n8wjRmqR1.',1,'TmA3Ks9zzhQEywOrPQEEeXJ6oQv92DxA',NULL,'2018-10-21 01:52:41','2018-10-21 09:25:42'),
	(2,'SoJ','SoJ@gmail.com',NULL,'$2y$10$qwP9C8GqDxzAC5NHVDBmNOyG8g3HjYxH4koO.EaBT31Wa326TkGkG',0,'44tZvCZamyfTtcr5EGvHQxiWQTVi5rAZ',NULL,'2018-10-21 02:34:42','2018-10-21 09:25:30');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
