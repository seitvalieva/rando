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


-- Listage de la structure de la base pour mes_randos
CREATE DATABASE IF NOT EXISTS `mes_randos` /*!40100 DEFAULT CHARACTER SET latin1 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `mes_randos`;

-- Listage de la structure de table mes_randos. image
CREATE TABLE IF NOT EXISTS `image` (
  `id_image` int NOT NULL AUTO_INCREMENT,
  `fileName` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `fileCreationTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rando_id` int NOT NULL,
  PRIMARY KEY (`id_image`),
  UNIQUE KEY `fileName` (`fileName`),
  KEY `rando_id` (`rando_id`),
  CONSTRAINT `FK_image_rando` FOREIGN KEY (`rando_id`) REFERENCES `rando` (`id_rando`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=latin1;

-- Listage des données de la table mes_randos.image : ~15 rows (environ)
INSERT INTO `image` (`id_image`, `fileName`, `fileCreationTime`, `rando_id`) VALUES
	(98, 'forest.jpg', '2024-11-19 00:18:14', 100),
	(99, 'blue-sky.jpg', '2024-11-19 00:18:14', 100),
	(100, 'oservation-desk.jpg', '2024-11-19 00:18:14', 100),
	(101, 'coffee-with-the-view.jpg', '2024-11-19 00:18:14', 100),
	(102, 'cascade-du-nideck.jpg', '2024-11-19 00:18:14', 100),
	(103, 'porte de pierre.jpg', '2024-11-19 00:24:13', 101),
	(104, 'forest-55979a4efaf96ff1.jpg', '2024-11-19 00:24:13', 101),
	(105, 'balise.jpg', '2024-11-19 00:24:13', 101),
	(106, 'bright-blue-sky-over-mountains.jpg', '2024-11-19 00:24:13', 101),
	(111, 'view-on-the-mountains-5a6271d9b982d21f.jpg', '2024-12-04 20:41:15', 105),
	(112, 'view-on-the-mountains2-a910e351999ca928.jpg', '2024-12-04 20:41:15', 105),
	(113, 'view-on-the-mountains1-372c850eb280345f.jpg', '2024-12-04 20:41:15', 105),
	(114, 'green-moss-around-brook-9d042d905160d8bb.jpg', '2024-12-04 20:41:15', 105),
	(115, 'view-on-the-forest-mountains-lak-531381f8bf184962.jpg', '2024-12-04 20:41:15', 105),
	(116, 'rando-mobile-capture_optimized_1000.webp', '2024-12-04 20:51:32', 106),
	(117, 'IMG_20240803_124149_optimized_1000.webp', '2024-12-04 20:51:32', 106),
	(118, 'IMG_20240803_162158_optimized_1000.webp', '2024-12-04 20:51:32', 106);

-- Listage de la structure de table mes_randos. rando
CREATE TABLE IF NOT EXISTS `rando` (
  `id_rando` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `subtitle` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `dateRando` date NOT NULL,
  `timeRando` time NOT NULL,
  `durationDays` int DEFAULT NULL,
  `durationHours` float DEFAULT NULL,
  `distance` float NOT NULL DEFAULT '0',
  `postDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `departure` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `destination` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `image` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id_rando`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `FK_rando_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=latin1;

-- Listage des données de la table mes_randos.rando : ~6 rows (environ)
INSERT INTO `rando` (`id_rando`, `title`, `subtitle`, `dateRando`, `timeRando`, `durationDays`, `durationHours`, `distance`, `postDate`, `description`, `departure`, `destination`, `image`, `user_id`) VALUES
	(98, 'Rando en Alsace', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam sed sem dui. Ut dui ante, varius sit amet iaculis a, imperdiet quis eros. Aliquam non nisl a nisi elementum lacinia. Nulla eu arcu vitae sapien hendrerit tristique in a lectus. Mauris nisi ve', '2024-11-15', '11:52:00', 1, 0, 1, '2024-11-15 11:52:57', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ullamcorper est nec nisi molestie commodo. Integer ornare est eu mi varius ultricies vitae eu velit. Nullam interdum, mi vitae ornare posuere, magna nulla feugiat sapien, non consequat leo sapien vehicula nisl. Praesent non convallis odio. Aenean consectetur, libero non tristique fringilla, felis risus finibus augue, sit amet finibus elit urna ut metus. Nam vitae feugiat nulla, at luctus magna. Aliquam tincidunt risus eget nunc faucibus dapibus. Nulla hendrerit mattis eros in commodo. Praesent in velit et nisi tempus interdum.&#13;&#10;&#13;&#10;Mauris sit amet est nec elit dapibus sodales vitae nec nulla. Aliquam mattis diam quam, vitae congue sem porttitor nec. Sed convallis odio ut mattis volutpat. Nulla laoreet at lectus at sagittis. Nunc magna massa, porttitor sed porta a, facilisis nec nisi. Nam gravida maximus leo, id bibendum tortor accumsan eu. Donec sit amet magna id turpis aliquam molestie. Pellentesque ac quam vitae leo ullamcorper fermentum. Nullam ut nisi et orci dapibus faucibus et vel mauris. Donec eget tortor arcu. Aenean efficitur diam tellus, a mollis diam hendrerit vel.', 'Strasbourg', 'Molsheim', NULL, 29),
	(100, 'Cascade du Nideck', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis in viverra mi, id fringilla ipsum. In tempor, tellus ut faucibus.', '2025-05-17', '09:00:00', 1, 6, 18.5, '2024-11-19 00:18:14', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ullamcorper est nec nisi molestie commodo. Integer ornare est eu mi varius ultricies vitae eu velit. Nullam interdum, mi vitae ornare posuere, magna nulla feugiat sapien, non consequat leo sapien vehicula nisl. Praesent non convallis odio. Aenean consectetur, libero non tristique fringilla, felis risus finibus augue, sit amet finibus elit urna ut metus. Nam vitae feugiat nulla, at luctus magna. Aliquam tincidunt risus eget nunc faucibus dapibus. Nulla hendrerit mattis eros in commodo. Praesent in velit et nisi tempus interdum.&#13;&#10;&#13;&#10;Mauris sit amet est nec elit dapibus sodales vitae nec nulla. Aliquam mattis diam quam, vitae congue sem porttitor nec. Sed convallis odio ut mattis volutpat. Nulla laoreet at lectus at sagittis. Nunc magna massa, porttitor sed porta a, facilisis nec nisi. Nam gravida maximus leo, id bibendum tortor accumsan eu. Donec sit amet magna id turpis aliquam molestie. Pellentesque ac quam vitae leo ullamcorper fermentum. Nullam ut nisi et orci dapibus faucibus et vel mauris. Donec eget tortor arcu. Aenean efficitur diam tellus, a mollis diam hendrerit vel.', 'Molsheim', 'Cascade du Nideck', 'cascade-du-nideck.jpg', 54),
	(101, 'Porte de pierre', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis in viverra mi, id fringilla ipsum. In tempor, tellus ut faucibus.', '2024-12-19', '10:00:00', 1, 4, 8, '2024-11-19 00:24:13', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ullamcorper est nec nisi molestie commodo. Integer ornare est eu mi varius ultricies vitae eu velit. Nullam interdum, mi vitae ornare posuere, magna nulla feugiat sapien, non consequat leo sapien vehicula nisl. Praesent non convallis odio. Aenean consectetur, libero non tristique fringilla, felis risus finibus augue, sit amet finibus elit urna ut metus. Nam vitae feugiat nulla, at luctus magna. Aliquam tincidunt risus eget nunc faucibus dapibus. Nulla hendrerit mattis eros in commodo. Praesent in velit et nisi tempus interdum.&#13;&#10;&#13;&#10;Mauris sit amet est nec elit dapibus sodales vitae nec nulla. Aliquam mattis diam quam, vitae congue sem porttitor nec. Sed convallis odio ut mattis volutpat. Nulla laoreet at lectus at sagittis. Nunc magna massa, porttitor sed porta a, facilisis nec nisi. Nam gravida maximus leo, id bibendum tortor accumsan eu. Donec sit amet magna id turpis aliquam molestie. Pellentesque ac quam vitae leo ullamcorper fermentum. Nullam ut nisi et orci dapibus faucibus et vel mauris. Donec eget tortor arcu. Aenean efficitur diam tellus, a mollis diam hendrerit vel.', 'Urmatt', 'Porte de pierre', 'bright-blue-sky-over-mountains.jpg', 54),
	(104, 'Le Tour du Ballon d&#39;Alsace', 'Pour ceux qui n&#39;ont pas froid aux yeux, une randonnée sportive pour découvrir les secrets du Ballon d&#39;Alsace.', '2024-12-25', '21:07:00', 1, 0, 18, '2024-12-04 19:09:44', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ullamcorper est nec nisi molestie commodo. Integer ornare est eu mi varius ultricies vitae eu velit. Nullam interdum, mi vitae ornare posuere, magna nulla feugiat sapien, non consequat leo sapien vehicula nisl. Praesent non convallis odio. Aenean consectetur, libero non tristique fringilla, felis risus finibus augue, sit amet finibus elit urna ut metus. Nam vitae feugiat nulla, at luctus magna. Aliquam tincidunt risus eget nunc faucibus dapibus. Nulla hendrerit mattis eros in commodo. Praesent in velit et nisi tempus interdum. Mauris sit amet est nec elit dapibus sodales vitae nec nulla. Aliquam mattis diam quam, vitae congue sem porttitor nec. Sed convallis odio ut mattis volutpat. Nulla laoreet at lectus at sagittis. Nunc magna massa, porttitor sed porta a, facilisis nec nisi. Nam gravida maximus leo, id bibendum tortor accumsan eu. Donec sit amet magna id turpis aliquam molestie. Pellentesque ac quam vitae leo ullamcorper fermentum. Nullam ut nisi et orci dapibus faucibus et vel mauris. Donec eget tortor arcu. Aenean efficitur diam tellus, a mollis diam hendrerit vel.', 'Niedernai', 'Ballon d&#39;Alsace', 'coffee_with_the_view_Ballon_d\'Alsace.webp', 54),
	(105, 'Col de la Schlucht', 'Le col de la Schlucht est l&#39;un des principaux cols du massif des Vosges', '2024-12-18', '08:30:00', 1, 0, 14, '2024-12-04 20:41:15', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ullamcorper est nec nisi molestie commodo. Integer ornare est eu mi varius ultricies vitae eu velit. Nullam interdum, mi vitae ornare posuere, magna nulla feugiat sapien, non consequat leo sapien vehicula nisl. Praesent non convallis odio. Aenean consectetur, libero non tristique fringilla, felis risus finibus augue, sit amet finibus elit urna ut metus. Nam vitae feugiat nulla, at luctus magna. Aliquam tincidunt risus eget nunc faucibus dapibus. Nulla hendrerit mattis eros in commodo. Praesent in velit et nisi tempus interdum. Mauris sit amet est nec elit dapibus sodales vitae nec nulla. Aliquam mattis diam quam, vitae congue sem porttitor nec. Sed convallis odio ut mattis volutpat. Nulla laoreet at lectus at sagittis. Nunc magna massa, porttitor sed porta a, facilisis nec nisi. Nam gravida maximus leo, id bibendum tortor accumsan eu. Donec sit amet magna id turpis aliquam molestie. Pellentesque ac quam vitae leo ullamcorper fermentum. Nullam ut nisi et orci dapibus faucibus et vel mauris. Donec eget tortor arcu. Aenean efficitur diam tellus, a mollis diam hendrerit vel.', 'Strasbourg', 'Col de la Schlucht', 'view-on-the-forest-mountains-lak-531381f8bf184962.jpg', 54),
	(106, 'Sentier des Roches', 'Le sentier le plus emblématique des Hautes Vosges.  Un must qui exige un pied sûr et une main ferme.', '2024-12-18', '09:00:00', 1, 0, 10, '2024-12-04 20:51:32', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ullamcorper est nec nisi molestie commodo. Integer ornare est eu mi varius ultricies vitae eu velit. Nullam interdum, mi vitae ornare posuere, magna nulla feugiat sapien, non consequat leo sapien vehicula nisl. Praesent non convallis odio. Aenean consectetur, libero non tristique fringilla, felis risus finibus augue, sit amet finibus elit urna ut metus. Nam vitae feugiat nulla, at luctus magna. Aliquam tincidunt risus eget nunc faucibus dapibus. Nulla hendrerit mattis eros in commodo. Praesent in velit et nisi tempus interdum. Mauris sit amet est nec elit dapibus sodales vitae nec nulla. Aliquam mattis diam quam, vitae congue sem porttitor nec. Sed convallis odio ut mattis volutpat. Nulla laoreet at lectus at sagittis. Nunc magna massa, porttitor sed porta a, facilisis nec nisi. Nam gravida maximus leo, id bibendum tortor accumsan eu. Donec sit amet magna id turpis aliquam molestie. Pellentesque ac quam vitae leo ullamcorper fermentum. Nullam ut nisi et orci dapibus faucibus et vel mauris. Donec eget tortor arcu. Aenean efficitur diam tellus, a mollis diam hendrerit vel.', 'Lac Blanc', 'Sentier des Roches', 'IMG_20240803_162158_optimized_1000.webp', 54),
	(107, 'Le Petit Ballon ', 'Le Petit Ballon est le belvédère par excellence, qui offre par temps clair un panorama exce', '2024-12-13', '12:32:00', 1, 0, 1, '2024-12-06 12:32:59', 'Avant de partir :&#13;&#10;&#13;&#10;Se renseigner sur la météo générale et locale en s’assurant de l’absence de précipitations.&#13;&#10;&#13;&#10;S&#39;informer sur la marche d’approche, hauteur de l’itinéraire, temps de parcours, réchappe possible (carte IGN, GPS, topo-guide, etc…)&#13;&#10;&#13;&#10;Evaluer les risques possibles en se renseignant auprès de professionnels de montagne, refuge, gîtes&#13;&#10;&#13;&#10;S&#39;informer un proche de votre objectif et le recontacter en cas de changement : horaires départ et retour, nombre de participants avec le numéro de téléphone de chacun, véhicule(s), parking&#13;&#10;&#13;&#10;Eviter de partir seul, utiliser un matériel conforme à la pratique de l’activité, réglé et en bon état, lampe frontale, trousse de secours complète, couverture de survie, etc…&#13;&#10;&#13;&#10;En cas de problème :&#13;&#10;', 'Molsheim', 'Petit Ballon', NULL, 54);

-- Listage de la structure de table mes_randos. subscription
CREATE TABLE IF NOT EXISTS `subscription` (
  `id_subscription` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `rando_id` int NOT NULL,
  PRIMARY KEY (`id_subscription`),
  KEY `user_id` (`user_id`),
  KEY `rando_id` (`rando_id`),
  CONSTRAINT `FK_subscription_rando` FOREIGN KEY (`rando_id`) REFERENCES `rando` (`id_rando`) ON DELETE CASCADE,
  CONSTRAINT `FK_subscription_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=latin1;

-- Listage des données de la table mes_randos.subscription : ~6 rows (environ)
INSERT INTO `subscription` (`id_subscription`, `user_id`, `rando_id`) VALUES
	(94, 29, 98),
	(96, 29, 100),
	(97, 29, 101),
	(100, 54, 104),
	(101, 29, 104),
	(102, 54, 105),
	(103, 54, 106),
	(104, 54, 107);

-- Listage de la structure de table mes_randos. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL DEFAULT '0',
  `registrationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `resetTokenHash` varchar(64) DEFAULT NULL,
  `tokenExpiresAt` datetime DEFAULT NULL,
  `role` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'ROLE_USER',
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `resetTokenHash` (`resetTokenHash`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

-- Listage des données de la table mes_randos.user : ~11 rows (environ)
INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `registrationDate`, `resetTokenHash`, `tokenExpiresAt`, `role`) VALUES
	(3, 'test2', 'test2@example.com', '$2y$10$dhq9Uyb6s6SgYxCePhgrs.0nCyF0N9aOzc/L28e10d.hm.ezT2196', '2024-08-19 16:18:14', NULL, NULL, 'null'),
	(4, 'test3', 'test3@example.com', '$2y$10$.W0jHXFFPYzLde4MxwyMu.9L2jvm344ot/KFqbQZ/VlUZAiNRArRu', '2024-08-20 16:07:15', NULL, NULL, 'null'),
	(5, 'test4', 'test4@example.com', '$2y$10$Jq9L5LpGQzgAv6N/NOu9FevnXT2tttoQKwLMFyZmDWV9HG6YwNeNO', '2024-08-21 00:36:13', NULL, NULL, 'null'),
	(27, 'test1109', 'test1109@example.com', '$2y$10$OolBSD4jOIv1m.vVO0yvg.DA7iGC8.P8700WsgxWe5r9A048fRJji', '2024-09-11 11:32:46', 'bd6b2f9cf8edc6e5461bf8e9f4bc57ae156a90ae91f72c00a178e8e9a9b6adaf', '2024-09-11 14:42:46', 'null'),
	(29, 'sev', 'sevile4ka2010@gmail.com', '$2y$10$7FcrkV..Q3uLyse.3wXRguP0hJGUylO3m.33yvQ5d9QSkazJ4/eS2', '2024-09-11 13:47:38', 'bb4a7ac6ae242938dcdc5718e51ab55c826111b857a3fd3b032cdf15a789531b', '2024-12-04 16:54:11', 'ROLE_USER'),
	(30, 'sev.fr', 'sev.francaise@gmail.com', '$2y$10$fowNzCeJfuCc98g0QiTN4O1TFxanM7Csg.GUpdNhnTkjPkLvgaI.a', '2024-09-11 16:34:28', '4ac3f5389cb90ad5643d7528840f934e14c73977c356c2bc52c4ad79e85a3331', '2024-09-12 08:01:19', 'ROLE_USER'),
	(52, 'test27', 'test27@ex.com', '$2y$10$vOYXBeevtbRv/IsajNTnie/z8exeSeKjGbNTIE6kfPtBBJOwxsCJq', '2024-10-28 13:45:13', NULL, NULL, 'ROLE_USER'),
	(54, 'admin_s', 'sseitvalieva@gmail.com', '$2y$10$Q1ZxtT0O0zQ1OLtsvP8sWOBkzrOAWP6HNbCmHGF17Ud.HjLXpcutO', '2024-10-28 14:31:08', NULL, NULL, 'ROLE_ADMIN'),
	(55, 'sevile4ka', 'sevile4ka@gmail.com', '$2y$10$UGO/fD4mC.IvIFrE05MN.O.nywxt88lX5.tEqj6Nxcaxrix8yBnPq', '2024-11-14 10:33:02', NULL, NULL, 'ROLE_USER'),
	(56, 'sevil', 'sevil@ex.com', '$2y$10$88WegA.BjyuLp6vIAgJ8SuDdgnmu5Ue2YOoknrV2ejnuDpZ3vgUUq', '2024-11-14 11:43:17', NULL, NULL, 'ROLE_USER'),
	(57, 'test', 'test@ex.com', '$2y$10$zIw6hpig5qpYqdDGgHdZtua8cMz8TCswnc9jY5uvn45Cm9mw.2jLK', '2024-11-15 09:41:23', NULL, NULL, 'ROLE_USER');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
