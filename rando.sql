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


-- Dumping database structure for rando
CREATE DATABASE IF NOT EXISTS `rando` /*!40100 DEFAULT CHARACTER SET latin1 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `rando`;

-- Dumping structure for table rando.image
CREATE TABLE IF NOT EXISTS `image` (
  `id_image` int NOT NULL AUTO_INCREMENT,
  `fileName` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `fileCreationTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rando_id` int NOT NULL,
  PRIMARY KEY (`id_image`),
  KEY `rando_id` (`rando_id`),
  CONSTRAINT `FK_image_rando` FOREIGN KEY (`rando_id`) REFERENCES `rando` (`id_rando`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- Dumping data for table rando.image: ~8 rows (approximately)
INSERT INTO `image` (`id_image`, `fileName`, `fileCreationTime`, `rando_id`) VALUES
	(16, '2151129769.jpg', '2024-09-23 14:46:29', 24),
	(17, 'logo-compass.jpg', '2024-09-23 14:48:05', 25),
	(18, 'sky-background.png', '2024-09-23 14:48:05', 25),
	(19, 'sky-background-1727159955.png', '2024-09-24 08:39:15', 26),
	(20, 'forest-340x180.png', '2024-09-24 08:39:15', 26),
	(21, 'sun-background.png', '2024-09-24 08:39:15', 26),
	(22, 'sky-background-1727179266.png', '2024-09-24 14:01:06', 27),
	(23, 'forest-340x180-1727187369.png', '2024-09-24 16:16:09', 28),
	(24, 'sun-background-1727187369.png', '2024-09-24 16:16:09', 28);

-- Dumping structure for table rando.rando
CREATE TABLE IF NOT EXISTS `rando` (
  `id_rando` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `subtitle` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `dateRando` date NOT NULL,
  `timeRando` time NOT NULL,
  `durationDays` int NOT NULL DEFAULT '0',
  `durationHours` float NOT NULL DEFAULT '0',
  `distance` float NOT NULL DEFAULT '0',
  `postDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` text NOT NULL,
  `departure` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `image` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id_rando`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `FK_rando_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- Dumping data for table rando.rando: ~10 rows (approximately)
INSERT INTO `rando` (`id_rando`, `title`, `subtitle`, `dateRando`, `timeRando`, `durationDays`, `durationHours`, `distance`, `postDate`, `description`, `departure`, `destination`, `image`, `user_id`) VALUES
	(1, 'Les deux Donons', '', '2024-06-13', '00:00:00', 0, 0, 11.25, '2024-05-21 09:42:07', 'test', 'Schirmek', 'Temple Donon', NULL, 2),
	(3, 'Le Tour du Ballon d’Alsace', 'Pour ceux qui n\'ont pas froid aux yeux, une randonnée sportive pour découvrir les secrets du Ballon d\'Alsace.', '2024-06-13', '00:00:00', 0, 0, 17.25, '2024-05-21 09:42:07', 'Attention, tracé Très difficile.\r\nLe Ballon d\'Alsace est accessible depuis plusieurs points. Son sommet est accessible depuis la route. Les plus sportifs pourront tenter cette boucle au départ de Sewen, qui présente quelques curiosités, en particulier le Lac d\'Alfeld. Le retour se fait en grande partie sur les crêtes, pour des vues qui vont parfois jusqu\'aux premiers sommets alpins quand le temps le permet. De nombreux raccourcis sont présents et permettent de réduire la boucle.', 'Sewen', 'Lac Blanc, Ballon d’Alsace', NULL, 4),
	(4, 'Grand Ballon', '', '2024-10-21', '00:00:00', 0, 0, 18, '2024-08-21 16:55:08', 'rando4', 'Colmar', 'Grand Ballon', NULL, 5),
	(7, 'Test', 'intro', '2024-09-03', '10:10:00', 1, 1, 0.1, '2024-09-03 10:10:56', 'description', 'gare', 'test', NULL, 6),
	(23, 'RandoTest14', 'Introduction RandoTest14', '2024-09-24', '15:32:00', 1, 1, 0.1, '2024-09-23 14:34:01', 'Description RandoTest14', 'Strasbourg', 'Molsheim', NULL, 29),
	(24, 'RandoTest15', 'Introduction RandoTest15', '2024-09-24', '13:44:00', 1, 1, 0.1, '2024-09-23 14:46:29', 'Description RandoTest15', 'Strasbourg', 'Molsheim', NULL, 29),
	(25, 'RandoTest16 with 2 pictures', 'Introduction RandoTest16 ', '2024-09-24', '13:46:00', 1, 1, 0.1, '2024-09-23 14:48:05', 'Description RandoTest16 ', 'Strasbourg', 'Molsheim', NULL, 29),
	(26, 'RandoTest17', 'Introduction  RandoTest17', '2024-09-25', '09:37:00', 1, 1, 0.1, '2024-09-24 08:39:15', 'Description RandoTest17', 'Strasbourg', 'Molsheim', NULL, 29),
	(27, 'RandoTest27', 'Introduction RandoTest27', '2024-09-25', '15:01:00', 1, 1, 0.1, '2024-09-24 14:01:06', 'Description RandoTest27', 'Strasbourg', 'Molsheim', NULL, 29),
	(28, 'RandoTest28', 'Introduction RandoTest28', '2024-09-25', '17:15:00', 1, 1, 0.1, '2024-09-24 16:16:09', 'Description RandoTest28', 'Strasbourg', 'Molsheim', 'sun-background-1727187369.png', 29),
	(29, 'RandoTest29', 'Introduction RandoTest29', '2024-09-26', '15:44:00', 1, 1, 0.1, '2024-09-25 15:45:18', 'Description RandoTest29', 'Strasbourg', 'Molsheim', NULL, 29),
	(30, 'RandoTest30', 'Introduction RandoTest30', '2024-09-25', '15:48:00', 1, 1, 0.1, '2024-09-25 15:49:16', 'Description RandoTest30', 'Strasbourg', 'Molsheim', NULL, 29);

-- Dumping structure for table rando.subscription
CREATE TABLE IF NOT EXISTS `subscription` (
  `id_subscription` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `rando_id` int NOT NULL,
  PRIMARY KEY (`id_subscription`),
  KEY `user_id` (`user_id`),
  KEY `rando_id` (`rando_id`),
  CONSTRAINT `FK_subscription_rando` FOREIGN KEY (`rando_id`) REFERENCES `rando` (`id_rando`),
  CONSTRAINT `FK_subscription_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table rando.subscription: ~0 rows (approximately)
INSERT INTO `subscription` (`id_subscription`, `user_id`, `rando_id`) VALUES
	(1, 29, 30),
	(2, 29, 28),
	(12, 29, 1);

-- Dumping structure for table rando.user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL DEFAULT '0',
  `registrationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `resetTokenHash` varchar(64) DEFAULT NULL,
  `tokenExpiresAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `resetTokenHash` (`resetTokenHash`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

-- Dumping data for table rando.user: ~11 rows (approximately)
INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `registrationDate`, `resetTokenHash`, `tokenExpiresAt`) VALUES
	(1, 'user', 'user@example.com', '$2y$10$tLL49R1sK7Hzd6MnXsjoUudk3TlwZd5gJ.xG.monx.DFXhWP3OEOu', '2024-08-19 15:54:26', NULL, NULL),
	(2, 'test', 'test@example.com', '$2y$10$jjY2NfMn7kcR7uGfZCVT5eMIDHElw3rdf9Or6Poklq5draahDOG4a', '2024-08-19 16:16:37', NULL, NULL),
	(3, 'test2', 'test2@example.com', '$2y$10$dhq9Uyb6s6SgYxCePhgrs.0nCyF0N9aOzc/L28e10d.hm.ezT2196', '2024-08-19 16:18:14', NULL, NULL),
	(4, 'test3', 'test3@example.com', '$2y$10$.W0jHXFFPYzLde4MxwyMu.9L2jvm344ot/KFqbQZ/VlUZAiNRArRu', '2024-08-20 16:07:15', NULL, NULL),
	(5, 'test4', 'test4@example.com', '$2y$10$Jq9L5LpGQzgAv6N/NOu9FevnXT2tttoQKwLMFyZmDWV9HG6YwNeNO', '2024-08-21 00:36:13', NULL, NULL),
	(6, 'test5', 'test5@example.com', '$2y$10$oSoEAEnJ/B3GuLLkt9/tsuekHWV3h2xme2CjZYgKFGdI4o77Amwr2', '2024-08-21 09:39:36', NULL, NULL),
	(27, 'test1109', 'test1109@example.com', '$2y$10$OolBSD4jOIv1m.vVO0yvg.DA7iGC8.P8700WsgxWe5r9A048fRJji', '2024-09-11 11:32:46', 'bd6b2f9cf8edc6e5461bf8e9f4bc57ae156a90ae91f72c00a178e8e9a9b6adaf', '2024-09-11 14:42:46'),
	(29, 'sev', 'sevile4ka2010@gmail.com', '$2y$10$7FcrkV..Q3uLyse.3wXRguP0hJGUylO3m.33yvQ5d9QSkazJ4/eS2', '2024-09-11 13:47:38', 'd3fd74248981cef72c70c307f384d6050f0223532600a57f201b7bedba223ce9', '2024-09-17 12:10:27'),
	(30, 'sev.fr', 'sev.francaise@gmail.com', '$2y$10$fowNzCeJfuCc98g0QiTN4O1TFxanM7Csg.GUpdNhnTkjPkLvgaI.a', '2024-09-11 16:34:28', '4ac3f5389cb90ad5643d7528840f934e14c73977c356c2bc52c4ad79e85a3331', '2024-09-12 08:01:19'),
	(31, 'pass_test', 'pass_test@example.com', '$2y$10$1c/ky44RlHwl.YmPKC6EseY3FhYABSzDn20H2t3cYuz1dvvtU3Bn.', '2024-09-13 14:00:02', NULL, NULL),
	(32, 'checkbox', 'checkbox@ex.com', '$2y$10$mGwFzdRpH/eOXvCi0XqszOHXB/Cg6ZC5NuqZgPctc/hWht0NfYE1K', '2024-09-13 16:45:13', NULL, NULL),
	(33, 'sevilia', 'sevile@ex.com', '$2y$10$I.vZpTBvv9AeyFgO6t/I8.WR5P/GViVBzCE/DoWmkKzbtam3EM4OG', '2024-09-17 09:16:05', NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
