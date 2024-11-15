CREATE DATABASE  IF NOT EXISTS `ebillsystem3` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `ebillsystem3`;
-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: ebillsystem
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `id` int(14) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `pass` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'Admin1','admin@gmail.com','Password'),(2,'Admin2','electricitybilling37@gmail.com','admin2');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bill`
--

DROP TABLE IF EXISTS `bill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bill` (
  `id` int(14) NOT NULL AUTO_INCREMENT,
  `aid` int(14) NOT NULL,
  `uid` int(14) NOT NULL,
  `previous_unit` int(10) unsigned NOT NULL,
  `current_unit` int(10) unsigned NOT NULL,
  `units` int(10) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` varchar(10) NOT NULL,
  `bdate` date NOT NULL,
  `ddate` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`),
  KEY `uid` (`uid`),
  CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`aid`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bill_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bill`
--

LOCK TABLES `bill` WRITE;
/*!40000 ALTER TABLE `bill` DISABLE KEYS */;
INSERT INTO `bill` VALUES (62,1,35,0,101,101,5050.00,'PROCESSED','2024-02-18','2024-03-19'),(63,1,35,0,301,301,15050.00,'PENDING','2024-02-19','2024-03-20'),(64,1,35,0,501,501,25050.00,'PROCESSED','2024-02-20','2024-03-21'),(67,1,35,501,701,200,10000.00,'PROCESSED','2024-02-17','2024-03-18'),(68,1,73,0,124,124,6200.00,'PENDING','2024-02-22','2024-03-23'),(69,1,92,0,500,500,25000.00,'PROCESSED','2024-02-24','2024-03-25'),(71,2,35,701,800,99,4950.00,'PENDING','2024-02-25','2024-03-26'),(72,2,92,500,1000,500,25000.00,'PROCESSED','2024-02-25','2024-03-26'),(73,2,92,1000,1648,648,32400.00,'PROCESSED','2024-02-26','2024-03-27');
/*!40000 ALTER TABLE `bill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `complaint`
--

DROP TABLE IF EXISTS `complaint`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `complaint` (
  `id` int(14) NOT NULL AUTO_INCREMENT,
  `uid` int(14) NOT NULL,
  `aid` int(14) NOT NULL,
  `complaint` varchar(140) NOT NULL,
  `status` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`),
  KEY `uid` (`uid`),
  CONSTRAINT `complaint_ibfk_1` FOREIGN KEY (`aid`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `complaint_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `complaint`
--

LOCK TABLES `complaint` WRITE;
/*!40000 ALTER TABLE `complaint` DISABLE KEYS */;
INSERT INTO `complaint` VALUES (19,73,2,'Transaction Not Processed','PROCESSED'),(20,92,2,'Transaction Not Processed','PROCESSED'),(21,92,2,'Bill Not Correct','PROCESSED'),(22,92,1,'Bill Not Correct','PROCESSED'),(23,92,1,'Previous Complaint Not Processed','NOT PROCESSED');
/*!40000 ALTER TABLE `complaint` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transaction` (
  `id` int(14) NOT NULL AUTO_INCREMENT,
  `bid` int(14) NOT NULL,
  `payable` decimal(10,2) NOT NULL,
  `pdate` date DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bid` (`bid`),
  CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`bid`) REFERENCES `bill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction`
--

LOCK TABLES `transaction` WRITE;
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
INSERT INTO `transaction` VALUES (60,62,5050.00,'2024-02-18','PROCESSED'),(61,63,15050.00,NULL,'PENDING'),(62,64,25050.00,'2024-02-17','PROCESSED'),(65,67,10000.00,'2024-02-18','PROCESSED'),(66,68,6200.00,NULL,'PENDING'),(67,69,25000.00,'2024-02-25','PROCESSED'),(69,71,4950.00,NULL,'PENDING'),(70,72,25000.00,'2024-02-25','PROCESSED'),(71,73,32400.00,'2024-02-26','PROCESSED');
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unitsrate`
--

DROP TABLE IF EXISTS `unitsrate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `unitsrate` (
  `sno` int(1) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unitsrate`
--

LOCK TABLES `unitsrate` WRITE;
/*!40000 ALTER TABLE `unitsrate` DISABLE KEYS */;
INSERT INTO `unitsrate` VALUES (1,50.00);
/*!40000 ALTER TABLE `unitsrate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int(14) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `verify` int(1) unsigned zerofill DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (35,'Zaw Khant Win','zawkhantwin134@gmail.com','09677034331','zaw','UCSM',1,NULL),(92,'Soe Thurein','reinblahblah@gmail.com','09123456789','123456soe','wuntho',1,NULL),(109,'Aung Aung','aungaung699901@gmail.com','09123456781','12345678','ucsm',1,NULL),(122,'Dee D','jockydeedeekit80@gmail.com','09400478343','zawkhantwin','ucsm',NULL,'2024-02-26'),(123,'Dee D','jockydeedeekit80@gmail.com','09400478343','zawkhantwin','ucsm',1,'2024-02-26'),(124,'zaw','zawkhantwin132004@gmail.com','09757085072','mmmmmmmm','UCSM',NULL,'2024-02-27');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

CREATE PROCEDURE unitstoamount( IN units INT(14) , OUT result INT(14))
BEGIN
   
    DECLARE a INT(14) DEFAULT 0;
    

    SELECT rate FROM unitsRate INTO a ;
    

        SELECT a*units INTO result;
    

END
//
delimiter ;
-- CALL UNITSTOAMOUNT BY : CALL unitstoamount(700,@x)// 

-- FUNCTION TO GET CURRENT DATE(1ST OF MONTH)

delimiter //
DROP FUNCTION IF EXISTS `curdate1`;
CREATE FUNCTION curdate1()
returns int
BEGIN
    DECLARE x INT;
    SET x = DAYOFMONTH(CURDATE());
    IF (x=1)
    THEN
        RETURN 1;
    ELSE
        RETURN 0;
    END IF;
END
//
delimiter ;


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-02-26 14:46:28
