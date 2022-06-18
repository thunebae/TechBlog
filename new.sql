-- MySQL dump 10.13  Distrib 8.0.29, for Linux (x86_64)
--
-- Host: localhost    Database: new
-- ------------------------------------------------------
-- Server version	8.0.29-0ubuntu0.20.04.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cmts`
--

DROP TABLE IF EXISTS `cmts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cmts` (
  `cmt_id` int unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int unsigned DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `cmt_body` text,
  `cmt_created` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cmt_id`),
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `cmts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `cmts_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmts`
--

LOCK TABLES `cmts` WRITE;
/*!40000 ALTER TABLE `cmts` DISABLE KEYS */;
INSERT INTO `cmts` VALUES (7,54,6,'sddssd','2022-05-21 18:13:20'),(9,54,6,'ssd','2022-05-21 18:32:37'),(11,54,4,'fddf','2022-05-21 18:42:50'),(12,54,4,'aasdjhd','2022-05-21 18:42:57'),(13,55,4,'zxzxzx','2022-05-21 18:46:43'),(14,54,6,'dsds','2022-05-21 19:00:09'),(15,55,4,'dfdf','2022-05-21 19:56:23'),(16,57,8,'sddsds','2022-05-21 20:39:43'),(17,57,4,'fddf','2022-05-21 20:44:27'),(18,57,4,'cxxc','2022-05-21 21:46:30'),(19,57,4,'fdd','2022-05-21 22:58:20'),(20,55,4,'dffd','2022-05-21 23:00:48'),(21,66,6,'dsds','2022-05-21 23:22:19');
/*!40000 ALTER TABLE `cmts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `post_id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned DEFAULT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_category` varchar(255) DEFAULT NULL,
  `post_descript` varchar(255) DEFAULT NULL,
  `post_body` text NOT NULL,
  `post_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `post_photo` varchar(255) DEFAULT NULL,
  `views` int unsigned DEFAULT '0',
  PRIMARY KEY (`post_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (54,4,'fddddd','dff','fdfddf','fddfdff','2022-05-21 09:51:14','../../app/uploads/post/326155128_star-wars.jpg',93),(55,4,'dfdf','dfdffd','dfdfdf','fddfdffddf','2022-05-21 10:50:45','../../app/uploads/post/1891650314_407cae559fa8ccebe22392b86a226098.jpg',41),(56,8,'sddsdds','dsdsds','dsdsds','ddsds','2022-05-21 13:31:03','../../app/uploads/post/960116378_407cae559fa8ccebe22392b86a226098.jpg',1),(57,8,'dfdf','dfdf','dffd','dfdfdfdf','2022-05-21 13:38:10','../../app/uploads/post/2000958357_407cae559fa8ccebe22392b86a226098.jpg',22),(58,4,'Top 10 phone applications and 2017 mobile design awards','GADGETS','Aenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.','Aenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.\r\nAenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.\r\nAenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.Aenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.','2022-05-21 16:02:28','../../app/uploads/post/1294692022_dung-2.png',0),(59,4,'A device you can use both headphones and usb','TECHNOLOGY','Aenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.','Aenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.\r\nAenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.Aenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.\r\n\r\nAenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.','2022-05-21 16:03:01','../../app/uploads/post/2015374294_star-wars.jpg',0),(60,4,'Two brand new laptop models from ABC computer','DEVELOPMENT','Aenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.','Aenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.\r\n\r\nAenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.\r\n\r\nAenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.','2022-05-21 16:03:45','../../app/uploads/post/1350228994_407cae559fa8ccebe22392b86a226098.jpg',0),(61,6,'Applications for taking photos of nature in your mobile phones','DESIGN','Aenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.','Aenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.\r\nAenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.\r\nAenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.','2022-05-21 16:04:58','../../app/uploads/post/1742526541_407cae559fa8ccebe22392b86a226098.jpg',0),(62,6,'Say hello to colored strap models in smart hours','MATERIALS','Aenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.','Aenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.\r\nAenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.\r\nAenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.\r\nAenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.','2022-05-21 16:05:22','../../app/uploads/post/1991641972_407cae559fa8ccebe22392b86a226098.jpg',0),(63,8,'How about evaluating your old mobile phones in different ways?','GADGETS','Aenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.','Aenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.\r\n\r\n\r\nAenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.\r\n\r\nAenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.','2022-05-21 16:06:00','../../app/uploads/post/30711980_star-wars.jpg',0),(64,8,'Drinking coffee at the computer rests the spirit','TECHNOLOGY','Aenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.','Aenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.\r\nAenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.\r\nAenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.\r\nAenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.','2022-05-21 16:06:27','../../app/uploads/post/318338426_star-wars.jpg',1),(65,6,'If you are considering buying a new safe for your mobile phone, be sure to read this article','REVIEWS','Aenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.','Aenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.\r\nAenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.\r\nAenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.\r\nAenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.','2022-05-21 16:07:24','../../app/uploads/post/350461006_star-wars.jpg',0),(66,6,'Enjoy a summer with a colorful headset','TECHNOLOGY','Aenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.','Aenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.\r\nAenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.\r\nAenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.\r\nAenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.\r\nAenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus ac felis nec, maximus tempor odio.','2022-05-21 16:07:55','../../app/uploads/post/1858373836_407cae559fa8ccebe22392b86a226098.jpg',2);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `user_id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_fullname` varchar(255) DEFAULT NULL,
  `user_birthday` date DEFAULT NULL,
  `user_address` varchar(255) DEFAULT NULL,
  `user_phone` varchar(255) DEFAULT NULL,
  `user_descript` text,
  `user_photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'thune','c06b417930478ce2f552e5ea6cc4ce9de596e7bce3f536f0ebec3d74329c9986','thune@gmail.com','Nguyen Thi Thu','2022-05-05','fggfgfgf','65656556','Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa eiusmod Pinterest in do umami readymade swag. Selfies iPhone Kickstarter, drinking vinegar jean.','..\\..\\app\\uploads\\259330717407cae559fa8ccebe22392b86a226098.jpg'),(2,'thuneabc','c06b417930478ce2f552e5ea6cc4ce9de596e7bce3f536f0ebec3d74329c9986','fdf@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL),(3,'lala','c06b417930478ce2f552e5ea6cc4ce9de596e7bce3f536f0ebec3d74329c9986','lala@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL),(4,'datnlq','af28298b452b5b501b57ddd2c8c56a88f49e981798f132ddd627d6c702a6c467','datnlq@gmail.com','Nguyen Le Quoc Datdffd','1990-05-18','vcvcssfsds','46767765675','vcvcvc','../../app/uploads/1706004707dung-2.png'),(5,'datnlq','ec97304549790fba3cb5ec30122bc4d56255c7e403d71155bd13173497333fb4','datnlq@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL),(6,'thune123','caede8778cefab9775d07ea45c58ab8883f677077d956046b8927c24b61d033b','thuthssaau@gmail.com','Nguyen Thi Thu','2001-02-19','dfdffdfddsdssdds/;','012345678954','fdfddddddddddddddddddddddssd','../../app/uploads/1205546611407cae559fa8ccebe22392b86a226098.jpg'),(8,'layla','b12d95a8dd8e668681eb8af301da038cffe2979f4170ef844a9ba767ee637a2b','layla@gmail.com',NULL,NULL,NULL,NULL,NULL,'../../app/uploads/511996591407cae559fa8ccebe22392b86a226098.jpg');
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

-- Dump completed on 2022-05-21 23:30:59
