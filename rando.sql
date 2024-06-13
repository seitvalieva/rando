-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
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


-- Listage de la structure de la base pour rando
CREATE DATABASE IF NOT EXISTS `rando` /*!40100 DEFAULT CHARACTER SET latin1 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `rando`;

-- Listage de la structure de table rando. rando
CREATE TABLE IF NOT EXISTS `rando` (
  `id_rando` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '0',
  `dateRando` datetime NOT NULL,
  `distance` float NOT NULL DEFAULT '0',
  `postDate` datetime NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `departure` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id_rando`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `FK_rando_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table rando.rando : ~0 rows (environ)

-- Listage de la structure de table rando. subscription
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

-- Listage des données de la table rando.subscription : ~0 rows (environ)

-- Listage de la structure de table rando. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL DEFAULT '0',
  `registrationDate` date NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table rando.user : ~0 rows (environ)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
