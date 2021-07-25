CREATE DATABASE  IF NOT EXISTS `sp_dnr` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */;
USE `sp_dnr`;
-- MySQL dump 10.13  Distrib 8.0.15, for Win64 (x86_64)
--
-- Host: localhost    Database: sp_dnr
-- ------------------------------------------------------
-- Server version	8.0.14

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `class_proto`
--

DROP TABLE IF EXISTS `class_proto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `class_proto` (
  `idClassProto` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) DEFAULT NULL,
  `Description` text,
  PRIMARY KEY (`idClassProto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class_proto`
--

LOCK TABLES `class_proto` WRITE;
/*!40000 ALTER TABLE `class_proto` DISABLE KEYS */;
/*!40000 ALTER TABLE `class_proto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group`
--

DROP TABLE IF EXISTS `group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `group` (
  `idGroup` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idGroup`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group`
--

LOCK TABLES `group` WRITE;
/*!40000 ALTER TABLE `group` DISABLE KEYS */;
/*!40000 ALTER TABLE `group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proto_questions`
--

DROP TABLE IF EXISTS `proto_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `proto_questions` (
  `idQuesion` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `Text` text,
  `Answer` text,
  `idProtoText` int(11) NOT NULL,
  `Attachments` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idQuesion`),
  KEY `idQuest_User_FK_idx` (`idUser`),
  KEY `idProtoQuest_Text_FK_idx` (`idProtoText`),
  CONSTRAINT `idProtoQuest_Text_FK` FOREIGN KEY (`idProtoText`) REFERENCES `proto_text` (`idProtoText`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `idProtoQuest_User_FK` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proto_questions`
--

LOCK TABLES `proto_questions` WRITE;
/*!40000 ALTER TABLE `proto_questions` DISABLE KEYS */;
/*!40000 ALTER TABLE `proto_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proto_text`
--

DROP TABLE IF EXISTS `proto_text`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `proto_text` (
  `idProtoText` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `Text` text,
  `Short_text` varchar(45) DEFAULT NULL,
  `idProto` int(11) NOT NULL,
  `Attachments` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idProtoText`),
  KEY `idProtoText_User_FK_idx` (`idUser`),
  KEY `idProtoText_Proto_FK_idx` (`idProto`),
  CONSTRAINT `idProtoText_Proto_FK` FOREIGN KEY (`idProto`) REFERENCES `protocol` (`idProtocol`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `idProtoText_User_FK` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proto_text`
--

LOCK TABLES `proto_text` WRITE;
/*!40000 ALTER TABLE `proto_text` DISABLE KEYS */;
/*!40000 ALTER TABLE `proto_text` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `protocol`
--

DROP TABLE IF EXISTS `protocol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `protocol` (
  `idProtocol` int(11) NOT NULL,
  `idClassProto` int(11) NOT NULL COMMENT 'Тип протокола',
  `idUser` int(11) NOT NULL COMMENT 'lead user(председатель)',
  `Public` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Приватно\nЧастично(для группы)\nПублично',
  PRIMARY KEY (`idProtocol`),
  KEY `idProtoClassProto_FK_idx` (`idClassProto`),
  KEY `idProtoUser_FK_idx` (`idUser`),
  CONSTRAINT `idProtoClassProto_FK` FOREIGN KEY (`idClassProto`) REFERENCES `class_proto` (`idClassProto`) ON UPDATE CASCADE,
  CONSTRAINT `idProtoUser_FK` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `protocol`
--

LOCK TABLES `protocol` WRITE;
/*!40000 ALTER TABLE `protocol` DISABLE KEYS */;
/*!40000 ALTER TABLE `protocol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `session_type`
--

DROP TABLE IF EXISTS `session_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `session_type` (
  `idSessionType` int(11) NOT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `idGroup` int(11) NOT NULL,
  `idProto` int(11) NOT NULL,
  PRIMARY KEY (`idSessionType`),
  KEY `idSession_Group_FK_idx` (`idGroup`),
  KEY `idSession_Proto_FK_idx` (`idProto`),
  CONSTRAINT `idSession_Group_FK` FOREIGN KEY (`idGroup`) REFERENCES `group` (`idGroup`) ON UPDATE CASCADE,
  CONSTRAINT `idSession_Proto_FK` FOREIGN KEY (`idProto`) REFERENCES `protocol` (`idProtocol`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `session_type`
--

LOCK TABLES `session_type` WRITE;
/*!40000 ALTER TABLE `session_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `session_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `user` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `FName` varchar(45) DEFAULT NULL,
  `LName` varchar(45) DEFAULT NULL,
  `MName` varchar(45) DEFAULT NULL,
  `Date_Of_Birth` datetime DEFAULT NULL,
  `Text` longtext,
  `Archive` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `user_BEFORE_DELETE` BEFORE DELETE ON `user` FOR EACH ROW BEGIN
	update `user` set Archive = 1;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `user-group`
--

DROP TABLE IF EXISTS `user-group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `user-group` (
  `idGroup` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `Archive` tinyint(1) NOT NULL DEFAULT '0',
  KEY `idUserGroup_Group_FK_idx` (`idGroup`),
  KEY `idUserGroup_User_FK_idx` (`idUser`),
  CONSTRAINT `idUserGroup_Group_FK` FOREIGN KEY (`idGroup`) REFERENCES `group` (`idGroup`) ON UPDATE CASCADE,
  CONSTRAINT `idUserGroup_User_FK` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user-group`
--

LOCK TABLES `user-group` WRITE;
/*!40000 ALTER TABLE `user-group` DISABLE KEYS */;
/*!40000 ALTER TABLE `user-group` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `user-status_BEFORE_DELETE` BEFORE DELETE ON `user-group` FOR EACH ROW BEGIN
	update `user-status` set Archive = 1;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Dumping routines for database 'sp_dnr'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-21 23:00:00
