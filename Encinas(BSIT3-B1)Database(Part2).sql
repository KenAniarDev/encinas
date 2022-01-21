-- MySQL dump 10.13  Distrib 8.0.26, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: mydb
-- ------------------------------------------------------
-- Server version	8.0.26

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `CatID` varchar(10) NOT NULL,
  `Name` char(30) NOT NULL,
  `Weight` varchar(5) NOT NULL,
  `Remarks` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`CatID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invclerks`
--

DROP TABLE IF EXISTS `invclerks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invclerks` (
  `ICId` varchar(10) NOT NULL,
  `FirstName` char(45) NOT NULL,
  `LastName` char(25) NOT NULL,
  `ContactNo` int NOT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `Supervisors_SupvId` varchar(10) NOT NULL,
  PRIMARY KEY (`ICId`,`Supervisors_SupvId`),
  KEY `fk_InvClerks_Supervisors1_idx` (`Supervisors_SupvId`),
  CONSTRAINT `fk_InvClerks_Supervisors1` FOREIGN KEY (`Supervisors_SupvId`) REFERENCES `supervisors` (`SupvId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invclerks`
--

LOCK TABLES `invclerks` WRITE;
/*!40000 ALTER TABLE `invclerks` DISABLE KEYS */;
/*!40000 ALTER TABLE `invclerks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inventory` (
  `InvID` varchar(45) NOT NULL,
  `DateRcvd` date NOT NULL,
  `NoItemsRcvd` int NOT NULL,
  `Status` varchar(70) NOT NULL,
  PRIMARY KEY (`InvID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory`
--

LOCK TABLES `inventory` WRITE;
/*!40000 ALTER TABLE `inventory` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `items` (
  `StockNo.` varchar(10) NOT NULL,
  `Description` varchar(45) NOT NULL,
  `Classification` char(10) NOT NULL,
  `Remarks` varchar(45) DEFAULT NULL,
  `InvClerks_ICId` varchar(10) NOT NULL,
  `Categories_CatID` varchar(10) NOT NULL,
  `Inventory_InvID` varchar(45) NOT NULL,
  `InvClerks_ICId1` varchar(10) NOT NULL,
  `InvClerks_Supervisors_SupvId` varchar(10) NOT NULL,
  PRIMARY KEY (`StockNo.`,`InvClerks_ICId`,`Categories_CatID`,`Inventory_InvID`,`InvClerks_ICId1`,`InvClerks_Supervisors_SupvId`),
  KEY `fk_Items_Categories1_idx` (`Categories_CatID`),
  KEY `fk_Items_Inventory1_idx` (`Inventory_InvID`),
  KEY `fk_Items_InvClerks1_idx` (`InvClerks_ICId1`,`InvClerks_Supervisors_SupvId`),
  CONSTRAINT `fk_Items_Categories1` FOREIGN KEY (`Categories_CatID`) REFERENCES `categories` (`CatID`),
  CONSTRAINT `fk_Items_InvClerks1` FOREIGN KEY (`InvClerks_ICId1`, `InvClerks_Supervisors_SupvId`) REFERENCES `invclerks` (`ICId`, `Supervisors_SupvId`),
  CONSTRAINT `fk_Items_Inventory1` FOREIGN KEY (`Inventory_InvID`) REFERENCES `inventory` (`InvID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `status` (
  `StatusID` varchar(10) NOT NULL,
  `Date` date NOT NULL,
  `NoSoldOut` int NOT NULL,
  `NoItemsLeft` int NOT NULL,
  `Inventory_InvID` varchar(45) NOT NULL,
  PRIMARY KEY (`StatusID`,`Inventory_InvID`),
  KEY `fk_Status_Inventory1_idx` (`Inventory_InvID`),
  CONSTRAINT `fk_Status_Inventory1` FOREIGN KEY (`Inventory_InvID`) REFERENCES `inventory` (`InvID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supervisors`
--

DROP TABLE IF EXISTS `supervisors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `supervisors` (
  `SupvId` varchar(10) NOT NULL,
  `FirstName` char(45) NOT NULL,
  `LastName` char(25) NOT NULL,
  `ContactNo.` int NOT NULL,
  `Email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`SupvId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supervisors`
--

LOCK TABLES `supervisors` WRITE;
/*!40000 ALTER TABLE `supervisors` DISABLE KEYS */;
/*!40000 ALTER TABLE `supervisors` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-11-22 14:05:43
