CREATE DATABASE  IF NOT EXISTS `productivore_db` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `productivore_db`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: productivore_db
-- ------------------------------------------------------
-- Server version	5.6.12-log

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

--
-- Table structure for table `applings`
--

DROP TABLE IF EXISTS `applings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `applings` (
  `appling_id` int(11) NOT NULL AUTO_INCREMENT,
  `appling_name` varchar(32) NOT NULL,
  `appling_url` varchar(16) NOT NULL,
  `appling_message` varchar(128) DEFAULT NULL,
  `appling_image` varchar(16) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `createdon` datetime NOT NULL,
  PRIMARY KEY (`appling_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applings`
--

LOCK TABLES `applings` WRITE;
/*!40000 ALTER TABLE `applings` DISABLE KEYS */;
INSERT INTO `applings` VALUES (0,'Sidebar','site',NULL,NULL,'The sidebar','2014-04-25 10:05:52'),(1,'Task List','tasks','[FIELD] completed today.','tasks','Manage your to-do.','2014-04-17 20:33:44'),(2,'Event Planner','events','You have [FIELD] events this week.','calendar','Organize your life.','2014-04-17 20:33:44'),(3,'Budget Tracker','budget','You\'ve spent [FIELD] so far today.','money','Know how your money flows.','2014-04-17 20:33:44'),(4,'You','you',NULL,'trophy','It\'s all about you.','2014-04-17 20:33:44');
/*!40000 ALTER TABLE `applings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(64) NOT NULL,
  `menu_url` varchar(32) NOT NULL,
  `appling_id` int(11) DEFAULT NULL,
  `parent_menu_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`menu_id`),
  KEY `menus_appling_id_fk_idx` (`appling_id`),
  KEY `menus_menu_id_fk_idx` (`parent_menu_id`),
  CONSTRAINT `menus_appling_id_fk` FOREIGN KEY (`appling_id`) REFERENCES `applings` (`appling_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `menus_menu_id_fk` FOREIGN KEY (`parent_menu_id`) REFERENCES `menus` (`menu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='Those stuff in the navbar.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'Notifications','index',0,NULL),(2,'Appling Manager','applings',0,NULL),(3,'Achievements','achievements',4,NULL),(4,'Anticipate','anticipate',4,NULL),(5,'Lessons','lessons',4,NULL),(6,'My Profile','selfdiscovery',4,NULL);
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setting_field_setting_value_maps`
--

DROP TABLE IF EXISTS `setting_field_setting_value_maps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setting_field_setting_value_maps` (
  `setting_field_setting_value_map_id` int(11) NOT NULL AUTO_INCREMENT,
  `appling_id` int(11) DEFAULT NULL,
  `setting_field_id` int(11) DEFAULT NULL,
  `setting_value_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`setting_field_setting_value_map_id`),
  KEY `setting_field_setting_value_map_appling_id_fk_idx` (`appling_id`),
  KEY `setting_field_setting_value_map_setting_field_id_fk_idx` (`setting_field_id`),
  KEY `setting_field_setting_value_map_setting_value_id_fk_idx` (`setting_value_id`),
  CONSTRAINT `setting_field_setting_value_map_appling_id_fk` FOREIGN KEY (`appling_id`) REFERENCES `applings` (`appling_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `setting_field_setting_value_map_setting_field_id_fk` FOREIGN KEY (`setting_field_id`) REFERENCES `setting_fields` (`setting_field_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `setting_field_setting_value_map_setting_value_id_fk` FOREIGN KEY (`setting_value_id`) REFERENCES `setting_values` (`setting_value_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setting_field_setting_value_maps`
--

LOCK TABLES `setting_field_setting_value_maps` WRITE;
/*!40000 ALTER TABLE `setting_field_setting_value_maps` DISABLE KEYS */;
INSERT INTO `setting_field_setting_value_maps` VALUES (1,0,1,1),(2,0,1,2),(3,0,1,3),(4,0,2,4),(5,0,2,5),(6,0,1,6);
/*!40000 ALTER TABLE `setting_field_setting_value_maps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setting_fields`
--

DROP TABLE IF EXISTS `setting_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setting_fields` (
  `setting_field_id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_field_name` varchar(128) NOT NULL,
  PRIMARY KEY (`setting_field_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setting_fields`
--

LOCK TABLES `setting_fields` WRITE;
/*!40000 ALTER TABLE `setting_fields` DISABLE KEYS */;
INSERT INTO `setting_fields` VALUES (1,'Order by'),(2,'View by');
/*!40000 ALTER TABLE `setting_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setting_values`
--

DROP TABLE IF EXISTS `setting_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setting_values` (
  `setting_value_id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_value_name` varchar(128) NOT NULL,
  PRIMARY KEY (`setting_value_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setting_values`
--

LOCK TABLES `setting_values` WRITE;
/*!40000 ALTER TABLE `setting_values` DISABLE KEYS */;
INSERT INTO `setting_values` VALUES (1,'Alphabetical'),(2,'Most Used'),(3,'Least Used'),(4,'List View'),(5,'Grid View'),(6,'Favorites');
/*!40000 ALTER TABLE `setting_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_appling_map_id` int(11) DEFAULT NULL,
  `setting_field_setting_value_map_id` int(11) DEFAULT NULL,
  `setting_field_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`setting_id`),
  KEY `settings_user_appling_map_id_fk_idx` (`user_appling_map_id`),
  KEY `settings_setting_field_setting_value_id_fk_idx` (`setting_field_setting_value_map_id`),
  KEY `settings_setting_field_id_fk_idx` (`setting_field_id`),
  CONSTRAINT `settings_setting_field_id_fk` FOREIGN KEY (`setting_field_id`) REFERENCES `setting_fields` (`setting_field_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `settings_setting_field_setting_value_id_fk` FOREIGN KEY (`setting_field_setting_value_map_id`) REFERENCES `setting_field_setting_value_maps` (`setting_field_setting_value_map_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `settings_user_appling_map_id_fk` FOREIGN KEY (`user_appling_map_id`) REFERENCES `user_appling_maps` (`user_appling_map_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,5,6,1),(2,5,5,2);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test` (
  `test_id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`test_id`),
  KEY `test_fk_idx` (`setting_id`),
  CONSTRAINT `test_fk` FOREIGN KEY (`setting_id`) REFERENCES `settings` (`setting_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test`
--

LOCK TABLES `test` WRITE;
/*!40000 ALTER TABLE `test` DISABLE KEYS */;
/*!40000 ALTER TABLE `test` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_appling_maps`
--

DROP TABLE IF EXISTS `user_appling_maps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_appling_maps` (
  `user_appling_map_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `appling_id` int(11) DEFAULT NULL,
  `notification_count` int(10) unsigned DEFAULT '0',
  `access_count` int(10) unsigned DEFAULT '0',
  `is_favorite` bit(1) DEFAULT b'0',
  PRIMARY KEY (`user_appling_map_id`),
  KEY `user_appling_maps_user_id_fk_idx` (`user_id`),
  KEY `user_appling_maps_appling_id_fk_idx` (`appling_id`),
  CONSTRAINT `user_appling_maps_appling_id_fk` FOREIGN KEY (`appling_id`) REFERENCES `applings` (`appling_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `user_appling_maps_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_appling_maps`
--

LOCK TABLES `user_appling_maps` WRITE;
/*!40000 ALTER TABLE `user_appling_maps` DISABLE KEYS */;
INSERT INTO `user_appling_maps` VALUES (1,1,1,0,4,'\0'),(2,1,2,0,3,'\0'),(3,1,3,0,2,'\0'),(4,1,4,0,1,''),(5,1,0,0,0,'\0');
/*!40000 ALTER TABLE `user_appling_maps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(32) NOT NULL,
  `user_email` varchar(64) NOT NULL,
  `user_password` varchar(32) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name_UNIQUE` (`user_name`),
  UNIQUE KEY `user_email_UNIQUE` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'crentagon','crentagon@gmail.com','f5a287da5aa52f63d24abda025b5e49d'),(2,'awesomenite','ask.awesomenite.dragonite@gmail.com','f5a287da5aa52f63d24abda025b5e49d');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-04-28 17:52:21
