-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2014 at 10:29 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

CREATE DATABASE  IF NOT EXISTS `productivore_db` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `productivore_db`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: productivore_db
-- ------------------------------------------------------
-- Server version	5.5.25a-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `productivore_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `achievements`
--

CREATE TABLE IF NOT EXISTS `achievements` (
  `achievement_id` int(11) NOT NULL AUTO_INCREMENT,
  `achievement_name` varchar(64) DEFAULT NULL,
  `achievement_condition` varchar(256) DEFAULT NULL,
  `achievement_rewards` int(11) DEFAULT '550',
  `user_id` int(11) DEFAULT NULL,
  `is_completed` int(1) DEFAULT '0',
  `completed_on` datetime DEFAULT NULL,
  `inserted_on` datetime DEFAULT NULL,
  PRIMARY KEY (`achievement_id`),
  KEY `achievements_user_id_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `achievements`
--

INSERT INTO `achievements` (`achievement_id`, `achievement_name`, `achievement_condition`, `achievement_rewards`, `user_id`, `is_completed`, `completed_on`, `inserted_on`) VALUES
(1, 'Test', 'Test', 550, 3, 0, NULL, '2014-06-02 15:16:40');

-- --------------------------------------------------------

--
-- Table structure for table `applings`
--

CREATE TABLE IF NOT EXISTS `applings` (
  `appling_id` int(11) NOT NULL AUTO_INCREMENT,
  `appling_name` varchar(32) NOT NULL,
  `appling_url` varchar(16) NOT NULL,
  `appling_message` varchar(128) DEFAULT NULL,
  `appling_image` varchar(16) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `createdon` datetime NOT NULL,
  PRIMARY KEY (`appling_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1003 ;

--
-- Dumping data for table `applings`
--

INSERT INTO `applings` (`appling_id`, `appling_name`, `appling_url`, `appling_message`, `appling_image`, `description`, `createdon`) VALUES
(0, 'Productivore', 'site', NULL, NULL, 'The sidebar', '2014-04-25 10:05:52'),
(1, 'Task List', 'tasks', '[FIELD] tasks completed today.', 'tasks', 'Manage your to-do.', '2014-04-17 20:33:44'),
(2, 'Event Planner', 'events', 'You have [FIELD] events this week.', 'calendar', 'Organize your life.', '2014-04-17 20:33:44'),
(3, 'Budget Tracker', 'budget', 'You''ve spent [FIELD] so far today.', 'money', 'Know how your money flows.', '2014-04-17 20:33:44'),
(4, 'You', 'you', NULL, 'trophy', 'It''s all about you.', '2014-04-17 20:33:44');

--
-- Triggers `applings`
--
DROP TRIGGER IF EXISTS `applings_AINS`;
DELIMITER //
CREATE TRIGGER `applings_AINS` AFTER INSERT ON `applings`
 FOR EACH ROW BEGIN
	-- New user must have applings.
	INSERT INTO user_appling_maps (user_id, appling_id)
	SELECT user_id, NEW.appling_id FROM users;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(64) NOT NULL,
  `menu_url` varchar(32) NOT NULL,
  `appling_id` int(11) DEFAULT NULL,
  `parent_menu_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`menu_id`),
  KEY `menus_appling_id_fk_idx` (`appling_id`),
  KEY `menus_menu_id_fk_idx` (`parent_menu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Those stuff in the navbar.' AUTO_INCREMENT=7 ;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`menu_id`, `menu_name`, `menu_url`, `appling_id`, `parent_menu_id`) VALUES
(1, 'Home', 'index', 0, NULL),
(2, 'Appling Manager', 'applings', 0, NULL),
(3, 'Achievements', 'achievements', 4, NULL),
(4, 'Anticipate', 'anticipate', 4, NULL),
(5, 'Lessons', 'lessons', 4, NULL),
(6, 'My Profile', 'selfdiscovery', 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_appling_map_id` int(11) DEFAULT NULL,
  `setting_field_setting_value_map_id` int(11) DEFAULT NULL,
  `setting_field_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`setting_id`),
  KEY `settings_user_appling_map_id_fk_idx` (`user_appling_map_id`),
  KEY `settings_setting_field_setting_value_id_fk_idx` (`setting_field_setting_value_map_id`),
  KEY `settings_setting_field_id_fk_idx` (`setting_field_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`setting_id`, `user_appling_map_id`, `setting_field_setting_value_map_id`, `setting_field_id`) VALUES
(1, 1, 6, 1),
(2, 1, 5, 2),
(4, 8, 1, 1),
(5, 8, 5, 2),
(7, 15, 1, 1),
(8, 15, 4, 2),
(9, 5, 7, 3),
(10, 12, 7, 3),
(11, 19, 7, 3);

-- --------------------------------------------------------

--
-- Table structure for table `setting_fields`
--

CREATE TABLE IF NOT EXISTS `setting_fields` (
  `setting_field_id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_field_name` varchar(128) NOT NULL,
  `appling_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`setting_field_id`),
  KEY `setting_fields_appling_id_fk_idx` (`appling_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `setting_fields`
--

INSERT INTO `setting_fields` (`setting_field_id`, `setting_field_name`, `appling_id`) VALUES
(1, 'Order by', 0),
(2, 'View by', 0),
(3, 'Order by', 4);

-- --------------------------------------------------------

--
-- Table structure for table `setting_field_setting_value_maps`
--

CREATE TABLE IF NOT EXISTS `setting_field_setting_value_maps` (
  `setting_field_setting_value_map_id` int(11) NOT NULL AUTO_INCREMENT,
  `appling_id` int(11) DEFAULT NULL,
  `setting_field_id` int(11) DEFAULT NULL,
  `setting_value_id` int(11) DEFAULT NULL,
  `is_default` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`setting_field_setting_value_map_id`),
  KEY `setting_field_setting_value_map_appling_id_fk_idx` (`appling_id`),
  KEY `setting_field_setting_value_map_setting_field_id_fk_idx` (`setting_field_id`),
  KEY `setting_field_setting_value_map_setting_value_id_fk_idx` (`setting_value_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `setting_field_setting_value_maps`
--

INSERT INTO `setting_field_setting_value_maps` (`setting_field_setting_value_map_id`, `appling_id`, `setting_field_id`, `setting_value_id`, `is_default`) VALUES
(1, 0, 1, 1, 1),
(2, 0, 1, 2, 0),
(3, 0, 1, 3, 0),
(4, 0, 2, 4, 1),
(5, 0, 2, 5, 0),
(6, 0, 1, 6, 0),
(7, 4, 3, 7, 1),
(8, 4, 3, 8, 0);

--
-- Triggers `setting_field_setting_value_maps`
--
DROP TRIGGER IF EXISTS `setting_field_setting_value_maps_AINS`;
DELIMITER //
CREATE TRIGGER `setting_field_setting_value_maps_AINS` AFTER INSERT ON `setting_field_setting_value_maps`
 FOR EACH ROW BEGIN
	IF NEW.is_default = 1 THEN
		INSERT INTO settings (user_appling_map_id, setting_field_setting_value_map_id, setting_field_id)
		SELECT user_appling_map_id, NEW.setting_field_setting_value_map_id, NEW.setting_field_id
		FROM user_appling_maps
		WHERE appling_id = NEW.appling_id;
	END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `setting_values`
--

CREATE TABLE IF NOT EXISTS `setting_values` (
  `setting_value_id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_value_name` varchar(128) NOT NULL,
  PRIMARY KEY (`setting_value_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `setting_values`
--

INSERT INTO `setting_values` (`setting_value_id`, `setting_value_name`) VALUES
(1, 'Alphabetical'),
(2, 'Most Used'),
(3, 'Least Used'),
(4, 'List View'),
(5, 'Grid View'),
(6, 'Favorites'),
(7, 'Points'),
(8, 'Title');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `test_id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`test_id`),
  KEY `test_fk_idx` (`setting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(32) NOT NULL,
  `user_email` varchar(64) NOT NULL,
  `user_password` varchar(77) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name_UNIQUE` (`user_name`),
  UNIQUE KEY `user_email_UNIQUE` (`user_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(1, 'crentagon', 'crentagon@gmail.com', 'sha256:1000:yluOkCnJGP6xdMUtwT6/q5MK9Gc16d1f:LzHInQ9CP2RSS5Gw0lh8X9AGAcWXAzo4'),
(2, 'awesomenite', 'ask.awesomenite.dragonite@gmail.com', 'sha256:1000:xqfMjTeDCaB4tFa+TosuhnI2eZX+RUo2:s/DsYdlXLok5fkasZ/0WNRMzBtJVhBP2'),
(3, 'guest001', 'guest001@guest.com', 'sha256:1000:AGdiV3fHWDXw4XRM7vcb/vj9wgiMfLLe:sJzTc40kMhOzifw/7QcqddMAAuUtadej');

--
-- Triggers `users`
--
DROP TRIGGER IF EXISTS `users_AINS`;
DELIMITER //
CREATE TRIGGER `users_AINS` AFTER INSERT ON `users`
 FOR EACH ROW BEGIN
	-- New user must have applings.
	INSERT INTO user_appling_maps (user_id, appling_id)
	SELECT NEW.user_id, appling_id FROM applings;

	-- New user must have default values for settings
	INSERT INTO settings (user_appling_map_id, setting_field_setting_value_map_id, setting_field_id)
	SELECT user_appling_map_id, setting_field_setting_value_map_id, setting_field_id
	FROM setting_field_setting_value_maps
	LEFT JOIN applings USING (appling_id)
	RIGHT JOIN user_appling_maps USING (appling_id)
	WHERE user_id = NEW.user_id AND is_default = 1;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_appling_maps`
--

CREATE TABLE IF NOT EXISTS `user_appling_maps` (
  `user_appling_map_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `appling_id` int(11) DEFAULT NULL,
  `notification_count` int(10) unsigned DEFAULT '0',
  `access_count` int(10) unsigned DEFAULT '0',
  `is_favorite` bit(1) DEFAULT b'0',
  PRIMARY KEY (`user_appling_map_id`),
  KEY `user_appling_maps_user_id_fk_idx` (`user_id`),
  KEY `user_appling_maps_appling_id_fk_idx` (`appling_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `user_appling_maps`
--

INSERT INTO `user_appling_maps` (`user_appling_map_id`, `user_id`, `appling_id`, `notification_count`, `access_count`, `is_favorite`) VALUES
(1, 1, 0, 0, 0, b'0'),
(2, 1, 1, 555, 0, b'1'),
(3, 1, 2, 55, 0, b'0'),
(4, 1, 3, 5, 0, b'0'),
(5, 1, 4, 0, 0, b'1'),
(8, 2, 0, 0, 0, b'0'),
(9, 2, 1, 0, 0, b'0'),
(10, 2, 2, 0, 0, b'0'),
(11, 2, 3, 0, 0, b'0'),
(12, 2, 4, 0, 0, b'0'),
(15, 3, 0, 0, 0, b'0'),
(16, 3, 1, 0, 0, b'0'),
(17, 3, 2, 0, 0, b'0'),
(18, 3, 3, 0, 0, b'0'),
(19, 3, 4, 0, 0, b'0');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `achievements`
--
ALTER TABLE `achievements`
  ADD CONSTRAINT `achievements_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_appling_id_fk` FOREIGN KEY (`appling_id`) REFERENCES `applings` (`appling_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `menus_menu_id_fk` FOREIGN KEY (`parent_menu_id`) REFERENCES `menus` (`menu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `settings`
--
ALTER TABLE `settings`
  ADD CONSTRAINT `settings_setting_field_id_fk` FOREIGN KEY (`setting_field_id`) REFERENCES `setting_fields` (`setting_field_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `settings_setting_field_setting_value_id_fk` FOREIGN KEY (`setting_field_setting_value_map_id`) REFERENCES `setting_field_setting_value_maps` (`setting_field_setting_value_map_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `settings_user_appling_map_id_fk` FOREIGN KEY (`user_appling_map_id`) REFERENCES `user_appling_maps` (`user_appling_map_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `setting_fields`
--
ALTER TABLE `setting_fields`
  ADD CONSTRAINT `setting_fields_appling_id_fk` FOREIGN KEY (`appling_id`) REFERENCES `applings` (`appling_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `setting_field_setting_value_maps`
--
ALTER TABLE `setting_field_setting_value_maps`
  ADD CONSTRAINT `setting_field_setting_value_map_appling_id_fk` FOREIGN KEY (`appling_id`) REFERENCES `applings` (`appling_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `setting_field_setting_value_map_setting_field_id_fk` FOREIGN KEY (`setting_field_id`) REFERENCES `setting_fields` (`setting_field_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `setting_field_setting_value_map_setting_value_id_fk` FOREIGN KEY (`setting_value_id`) REFERENCES `setting_values` (`setting_value_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `test`
--
ALTER TABLE `test`
  ADD CONSTRAINT `test_fk` FOREIGN KEY (`setting_id`) REFERENCES `settings` (`setting_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_appling_maps`
--
ALTER TABLE `user_appling_maps`
  ADD CONSTRAINT `user_appling_maps_appling_id_fk` FOREIGN KEY (`appling_id`) REFERENCES `applings` (`appling_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_appling_maps_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
