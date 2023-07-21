-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para pt_viajes_para_ti
CREATE DATABASE IF NOT EXISTS `pt_viajes_para_ti` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `pt_viajes_para_ti`;

-- Volcando estructura para tabla pt_viajes_para_ti.doctrine_migration_versions
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Volcando datos para la tabla pt_viajes_para_ti.doctrine_migration_versions: ~1 rows (aproximadamente)
DELETE FROM `doctrine_migration_versions`;
INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
	('DoctrineMigrations\\Version20230719205901', '2023-07-21 13:50:21', 22),
	('DoctrineMigrations\\Version20230721134108', '2023-07-21 13:50:21', 5);

-- Volcando estructura para tabla pt_viajes_para_ti.supplier
CREATE TABLE IF NOT EXISTS `supplier` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla pt_viajes_para_ti.supplier: ~20 rows (aproximadamente)
DELETE FROM `supplier`;
INSERT INTO `supplier` (`id`, `name`, `email`, `phone_number`, `supplier_type`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'Frances Mills Jr.', 'jamie69@hotmail.com', '629.399.3228', 'complemento', 0, '2014-12-02 22:47:59', NULL),
	(2, 'Mrs. Astrid Funk III', 'delphia.corwin@gmail.com', '530.357.1251', 'complemento', 1, '2017-08-27 07:18:57', NULL),
	(3, 'Javon Littel DVM', 'kiel.rath@nicolas.com', '1-775-665-2148', 'complemento', 0, '1981-10-11 12:31:34', NULL),
	(4, 'Cassidy Hackett', 'kayden62@wisozk.com', '+1 (585) 841-3649', 'complemento', 0, '1980-09-28 00:08:40', NULL),
	(13, 'Miss Catharine Ernser Sr.', 'runolfsdottir.francisca@hotmail.com', '248-258-9979', 'complemento', 1, '2010-04-28 22:04:19', NULL),
	(31, 'Valentin Hagenes', 'hayes.francisca@hills.info', '619-390-2254', 'complemento', 0, '1996-10-15 13:18:49', NULL),
	(32, 'Ardith Kulas', 'odessa.metz@gmail.com', '754.487.1624', 'hotel', 0, '2013-04-05 22:54:19', NULL),
	(61, 'Amya Langworth', 'karolann.schoen@hotmail.com', '1-208-521-0699', 'complemento', 0, '2017-07-08 09:52:37', NULL),
	(62, 'Gudrun Roob', 'lowe.emilie@ondricka.biz', '614.667.1120', 'pista', 1, '1975-09-18 04:12:25', NULL),
	(63, 'Deven Reichel', 'stan.emmerich@mcclure.net', '+1 (313) 530-8684', 'hotel', 1, '2002-10-06 11:11:08', NULL),
	(81, 'Dr. Sydni Hoeger', 'ozella35@schinner.info', '463-675-2093', 'pista', 0, '1979-06-30 03:02:27', NULL),
	(82, 'Otha Williamson', 'floyd02@schumm.com', '+1-662-866-0782', 'hotel', 1, '1993-08-07 16:22:54', NULL),
	(83, 'Mekhi Ryan', 'muller.anissa@grant.com', '+1-725-952-6499', 'complemento', 1, '1996-12-01 14:20:05', NULL),
	(84, 'Otilia Collier', 'ochristiansen@yahoo.com', '+1 (954) 513-0018', 'hotel', 0, '1980-09-12 05:53:04', NULL),
	(85, 'Dr. Koby Kunde Jr.', 'ogrant@nienow.com', '928.454.7194', 'complemento', 0, '2002-10-13 22:27:47', NULL),
	(86, 'Arvid Mraz', 'julie47@walker.com', '930.286.7588', 'hotel', 0, '1981-01-07 05:35:30', NULL),
	(87, 'Montana Eichmann', 'walker.aurelie@gmail.com', '747-402-5346', 'pista', 0, '1998-11-27 06:08:05', NULL),
	(88, 'Murphy Donnelly', 'udeckow@hotmail.com', '+1.325.226.8159', 'complemento', 1, '2016-04-13 15:01:47', NULL),
	(89, 'Tiffany Lindgren', 'august.ortiz@mayer.org', '607.635.3205', 'complemento', 0, '1998-01-26 10:24:32', NULL),
	(90, 'Dennis Keeling V', 'jace.williamson@hotmail.com', '+1.240.863.5327', 'complemento', 1, '2018-11-25 04:12:00', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
