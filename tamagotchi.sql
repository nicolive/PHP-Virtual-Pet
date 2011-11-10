-- MySQL dump 10.11
--
-- Host: localhost    Database: tamagotchi
-- ------------------------------------------------------
-- Server version	5.0.51a-24+lenny5-log

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
-- Table structure for table `tamagotchis`
--

DROP TABLE IF EXISTS `tamagotchis`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `tamagotchis` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) collate latin1_general_ci NOT NULL default '',
  `pet_name` varchar(50) collate latin1_general_ci NOT NULL,
  `created` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `lastfed` timestamp NOT NULL default '0000-00-00 00:00:00',
  `lastwashed` timestamp NOT NULL default '0000-00-00 00:00:00',
  `lastplayed` timestamp NOT NULL default '0000-00-00 00:00:00',
  `lastdoc` timestamp NOT NULL default '0000-00-00 00:00:00',
  `fullness` tinyint(4) NOT NULL default '100',
  `cleanliness` tinyint(4) NOT NULL default '100',
  `mood` tinyint(4) NOT NULL default '100',
  `health` tinyint(4) NOT NULL default '100',
  `dead` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `tamagotchis`
--

LOCK TABLES `tamagotchis` WRITE;
/*!40000 ALTER TABLE `tamagotchis` DISABLE KEYS */;
INSERT INTO `tamagotchis` VALUES (1,'schlobi','','2009-02-19 15:40:16','2009-02-21 16:00:11','2009-02-21 12:18:33','2009-02-21 12:18:59','2009-02-21 12:19:02',0,0,0,0,'0000-00-00 00:00:00'),(2,'marctier','','2009-02-20 14:51:07','2009-03-02 14:25:55','2009-03-02 14:25:40','2009-03-02 14:25:22','2009-03-02 14:25:51',0,0,0,0,'0000-00-00 00:00:00'),(3,'janinetier','','2009-02-20 14:55:16','2009-02-21 09:50:55','2009-02-21 09:51:06','2009-02-21 09:50:46','2009-02-21 09:51:09',0,0,0,0,'0000-00-00 00:00:00'),(7,'marcttier','','2009-02-21 09:51:23','2009-02-21 09:51:23','2009-02-21 09:51:23','2009-02-21 09:51:23','2009-02-21 09:51:23',98,100,100,100,'0000-00-00 00:00:00'),(8,'nico','','2009-03-13 13:48:45','2009-03-22 14:41:56','2009-03-22 14:42:00','2009-03-22 14:41:54','2009-03-22 14:41:58',95,99,100,34,'0000-00-00 00:00:00'),(6,'Claudi','','2009-02-20 15:41:19','2009-03-20 22:02:51','2009-03-20 22:02:55','2009-03-20 22:01:57','2009-03-20 22:02:12',97,100,100,0,'0000-00-00 00:00:00'),(9,'misterschnappes','','2009-03-16 19:49:40','2009-03-16 21:10:50','2009-03-16 21:10:48','2009-03-16 19:57:10','2009-03-16 21:00:45',95,100,100,98,'0000-00-00 00:00:00'),(10,'honksponk','','2009-03-19 09:36:36','2009-03-19 10:25:08','2009-03-19 10:25:06','2009-03-19 09:36:36','2009-03-19 10:25:07',65,95,100,89,'0000-00-00 00:00:00'),(11,'nixxx','','2009-03-22 14:44:04','2009-03-24 19:51:40','2009-03-24 19:18:52','2009-03-24 18:52:10','2009-03-24 18:52:04',81,95,78,70,'0000-00-00 00:00:00'),(12,'janinitier','','2009-03-23 16:44:16','2009-03-23 21:31:04','2009-03-23 20:13:11','2009-03-23 22:11:31','2009-03-23 20:13:27',0,71,26,33,'0000-00-00 00:00:00'),(13,'nicotier','','2009-03-23 22:15:11','2009-03-23 22:15:11','2009-03-23 22:15:11','2009-03-23 22:15:11','2009-03-23 22:15:11',100,100,100,100,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `tamagotchis` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-11-10  9:44:30
