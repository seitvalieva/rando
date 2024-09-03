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

-- Dumping structure for table rando.rando
CREATE TABLE IF NOT EXISTS `rando` (
  `id_rando` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `subtitle` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `dateRando` date NOT NULL,
  `timeRando` time NOT NULL,
  `durationDays` varchar(50) NOT NULL DEFAULT '0',
  `durationHours` varchar(50) NOT NULL DEFAULT '0',
  `distance` varchar(50) NOT NULL DEFAULT '0',
  `postDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` text NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `departure` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id_rando`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `FK_rando_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table rando.rando: ~7 rows (approximately)
INSERT INTO `rando` (`id_rando`, `title`, `subtitle`, `dateRando`, `timeRando`, `durationDays`, `durationHours`, `distance`, `postDate`, `description`, `image`, `departure`, `destination`, `user_id`) VALUES
	(1, 'Les deux Donons', '', '2024-06-13', '00:00:00', '0', '0', '11.25', '2024-05-21 09:42:07', 'test', NULL, 'Schirmek', 'Temple Donon', 2),
	(2, 'rando3', '', '2024-08-21', '00:00:00', '0', '0', '10', '2024-08-21 09:43:07', 'rando3', NULL, 'ville', 'rando3', 3),
	(3, 'Le Tour du Ballon d’Alsace', 'Pour ceux qui n\'ont pas froid aux yeux, une randonnée sportive pour découvrir les secrets du Ballon d\'Alsace.', '2024-06-13', '00:00:00', '0', '0', '17.25', '2024-05-21 09:42:07', 'Attention, tracé Très difficile.\r\nLe Ballon d\'Alsace est accessible depuis plusieurs points. Son sommet est accessible depuis la route. Les plus sportifs pourront tenter cette boucle au départ de Sewen, qui présente quelques curiosités, en particulier le Lac d\'Alfeld. Le retour se fait en grande partie sur les crêtes, pour des vues qui vont parfois jusqu\'aux premiers sommets alpins quand le temps le permet. De nombreux raccourcis sont présents et permettent de réduire la boucle.', NULL, 'Sewen', 'Lac Blanc, Ballon d’Alsace', 4),
	(4, 'Grand Ballon', '', '2024-10-21', '00:00:00', '0', '0', '18', '2024-08-21 16:55:08', 'rando4', NULL, 'Colmar', 'Grand Ballon', 5),
	(5, 'fbfbfb', 'bbvbvc', '2024-08-31', '16:07:00', '1', '5', '20', '2024-08-30 14:08:16', 'vcxvcx', NULL, 'dvdv', 'vcxvcx', 6),
	(6, 'dfgdgdagffd', 'gfdggfdgfdag', '2024-09-03', '09:45:00', '1', '5', '10', '2024-09-03 10:05:47', 'vcvcvcxvv', '', 'vdvcvcxv', 'GGG', 6),
	(7, 'Test', 'intro', '2024-09-03', '10:10:00', '1', '1', '0.1', '2024-09-03 10:10:56', 'description', NULL, 'gare', 'test', 6);

-- Dumping structure for table rando.subscription
CREATE TABLE IF NOT EXISTS `subscription` (
  `id_subscription` int NOT NULL,
  `numberPeople` int NOT NULL,
  `user_id` int NOT NULL,
  `rando_id` int NOT NULL,
  PRIMARY KEY (`id_subscription`),
  KEY `user_id` (`user_id`),
  KEY `rando_id` (`rando_id`),
  CONSTRAINT `FK_subscription_rando` FOREIGN KEY (`rando_id`) REFERENCES `rando` (`id_rando`),
  CONSTRAINT `FK_subscription_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table rando.subscription: ~0 rows (approximately)

-- Dumping structure for table rando.user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL DEFAULT '0',
  `registrationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table rando.user: ~2 rows (approximately)
INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `registrationDate`) VALUES
	(1, 'user', 'user@example.com', '$2y$10$tLL49R1sK7Hzd6MnXsjoUudk3TlwZd5gJ.xG.monx.DFXhWP3OEOu', '2024-08-19 15:54:26'),
	(2, 'test', 'test@example.com', '$2y$10$jjY2NfMn7kcR7uGfZCVT5eMIDHElw3rdf9Or6Poklq5draahDOG4a', '2024-08-19 16:16:37'),
	(3, 'test2', 'test2@example.com', '$2y$10$dhq9Uyb6s6SgYxCePhgrs.0nCyF0N9aOzc/L28e10d.hm.ezT2196', '2024-08-19 16:18:14'),
	(4, 'test3', 'test3@example.com', '$2y$10$.W0jHXFFPYzLde4MxwyMu.9L2jvm344ot/KFqbQZ/VlUZAiNRArRu', '2024-08-20 16:07:15'),
	(5, 'test4', 'test4@example.com', '$2y$10$Jq9L5LpGQzgAv6N/NOu9FevnXT2tttoQKwLMFyZmDWV9HG6YwNeNO', '2024-08-21 00:36:13'),
	(6, 'test5', 'test5@example.com', '$2y$10$oSoEAEnJ/B3GuLLkt9/tsuekHWV3h2xme2CjZYgKFGdI4o77Amwr2', '2024-08-21 09:39:36');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
