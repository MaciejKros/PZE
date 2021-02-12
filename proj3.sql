-- MySQL dump 10.16  Distrib 10.1.29-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: proj3
-- ------------------------------------------------------
-- Server version	10.1.29-MariaDB

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `login` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES ('admin','56fc9aed1026cd5023c0a3c85b769b64','admin@pseudosklep.pl','Fe5hpRFziy866mBZgc5a');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategorie`
--

DROP TABLE IF EXISTS `kategorie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kategorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategorie`
--

LOCK TABLES `kategorie` WRITE;
/*!40000 ALTER TABLE `kategorie` DISABLE KEYS */;
INSERT INTO `kategorie` VALUES (1,'Kategoria1'),(2,'Kategoria2'),(3,'Kategoria3'),(4,'Kategoria4');
/*!40000 ALTER TABLE `kategorie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategorie_produkty`
--

DROP TABLE IF EXISTS `kategorie_produkty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kategorie_produkty` (
  `kat_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  KEY `kat_id` (`kat_id`),
  KEY `prod_id` (`prod_id`),
  CONSTRAINT `kategorie_produkty_ibfk_1` FOREIGN KEY (`kat_id`) REFERENCES `kategorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kategorie_produkty_ibfk_2` FOREIGN KEY (`prod_id`) REFERENCES `produkty` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategorie_produkty`
--

LOCK TABLES `kategorie_produkty` WRITE;
/*!40000 ALTER TABLE `kategorie_produkty` DISABLE KEYS */;
INSERT INTO `kategorie_produkty` VALUES (1,2),(1,3),(2,6),(2,7),(2,8),(2,9),(2,10),(3,11),(3,12),(3,13),(3,14),(3,15),(4,16),(4,17),(4,18),(4,19),(4,1),(1,1),(1,5),(1,16),(1,4),(4,20);
/*!40000 ALTER TABLE `kategorie_produkty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produkty`
--

DROP TABLE IF EXISTS `produkty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produkty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cena` decimal(7,2) NOT NULL,
  `opis` text COLLATE utf8_unicode_ci NOT NULL,
  `img` text COLLATE utf8_unicode_ci NOT NULL,
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produkty`
--

LOCK TABLES `produkty` WRITE;
/*!40000 ALTER TABLE `produkty` DISABLE KEYS */;
INSERT INTO `produkty` VALUES (1,'Produkt1234',9.00,'','rower.jpg','2020-02-03 00:09:32'),(2,'Produkt6666',11.99,'Epicko','Samochodoptak.jpg','2020-02-03 01:04:45'),(3,'Ccccc',22.00,'','','2020-02-03 01:35:22'),(4,'Ddddd',11.00,'','','2020-02-03 01:37:31'),(5,'Bbbbbb',10.99,'ĘĄ','','2020-02-03 01:52:26'),(6,'Eeeeee',88.01,'QwA','Klapki.jpg','2020-02-03 14:14:06'),(7,'Niewolnik',0.99,'Najlepszy pracownik','Niewolnik.jpg','2020-02-03 17:25:12'),(8,'asdasd',123.02,'','','2020-02-03 17:25:42'),(9,'wwwww',1111.00,'','','2020-02-03 17:25:50'),(10,'qereq',1.00,'','','2020-02-03 17:25:59'),(11,'tre',3.00,'','','2020-02-03 17:26:05'),(12,'qweq',2.00,'','','2020-02-03 17:26:15'),(13,'qweqew',34.00,'','','2020-02-03 17:26:19'),(14,'azda',0.10,'','','2020-02-03 17:26:31'),(15,'hhhh',222.00,'','','2020-02-03 17:26:43'),(16,'kkkk',5555.00,'','','2020-02-03 17:26:47'),(17,'iiii',66.00,'','','2020-02-03 17:26:52'),(18,'rrrrr',23.00,'','','2020-02-03 22:31:25'),(19,'qerqrrrrr',21.99,'','','2020-02-03 22:53:06'),(20,'sdasd',222.00,'','','2020-02-06 01:41:53');
/*!40000 ALTER TABLE `produkty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zamowienia`
--

DROP TABLE IF EXISTS `zamowienia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zamowienia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imie` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `nazwisko` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `adres` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `telefon` int(11) NOT NULL,
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zamowienia`
--

LOCK TABLES `zamowienia` WRITE;
/*!40000 ALTER TABLE `zamowienia` DISABLE KEYS */;
INSERT INTO `zamowienia` VALUES (1,'Aaaa','Eeeeee','aaaaaaaaaaaa','asda@aaa.aaa',123123125,'2020-02-03 19:59:06'),(2,'Aaaa','Bbbb','aaaaaaaaaaaa','aa@aa.aaaaa',321321321,'2020-02-03 21:58:10'),(3,'Rrrrrr','Ffffff','adfsadf 222/43','ee@ee.ee',432432423,'2020-02-03 22:05:56'),(4,'Aaaa','sdada','wqeqwe522','aa@aa.aa',323232323,'2020-02-04 00:26:36');
/*!40000 ALTER TABLE `zamowienia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zamowienia_produkty`
--

DROP TABLE IF EXISTS `zamowienia_produkty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zamowienia_produkty` (
  `zam_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `ilosc_prod` int(11) NOT NULL,
  KEY `zam_id` (`zam_id`),
  KEY `prod_id` (`prod_id`),
  CONSTRAINT `zamowienia_produkty_ibfk_1` FOREIGN KEY (`zam_id`) REFERENCES `zamowienia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `zamowienia_produkty_ibfk_2` FOREIGN KEY (`prod_id`) REFERENCES `produkty` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zamowienia_produkty`
--

LOCK TABLES `zamowienia_produkty` WRITE;
/*!40000 ALTER TABLE `zamowienia_produkty` DISABLE KEYS */;
INSERT INTO `zamowienia_produkty` VALUES (2,7,4),(2,13,3),(2,1,1),(2,2,1),(3,9,4),(3,17,2),(4,3,1),(4,17,1),(4,19,1),(1,1,3),(1,2,2),(1,3,4),(1,4,3);
/*!40000 ALTER TABLE `zamowienia_produkty` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-02-06 11:01:01
