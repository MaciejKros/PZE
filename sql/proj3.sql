-- MariaDB dump 10.18  Distrib 10.4.17-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: proj3
-- ------------------------------------------------------
-- Server version	10.4.17-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `proj3`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `proj3` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `proj3`;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategorie`
--

LOCK TABLES `kategorie` WRITE;
/*!40000 ALTER TABLE `kategorie` DISABLE KEYS */;
INSERT INTO `kategorie` VALUES (1,'Antywirusy'),(2,'Graficzne'),(3,'Systemy Operacyjne');
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
INSERT INTO `kategorie_produkty` VALUES (1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(2,7),(2,8),(2,9),(2,10),(3,11),(3,12),(3,13),(3,14);
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
  `staracena` decimal(7,2) DEFAULT NULL,
  `opis` text COLLATE utf8_unicode_ci NOT NULL,
  `img` text COLLATE utf8_unicode_ci NOT NULL,
  `data` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produkty`
--

LOCK TABLES `produkty` WRITE;
/*!40000 ALTER TABLE `produkty` DISABLE KEYS */;
INSERT INTO `produkty` VALUES (1,'Norton Security Standard',119.00,159.00,'Antywirus, ochrona przed oprogramowaniem destrukcyjnym, ochrona przed oprogramowaniem szpiegującym, ochrona przed wyłudzaniem danych, ochrona przeglądarki i nie tylko.','A01-0.jpg','2020-02-03 00:09:32'),(2,'Kaspersky Anti-Virus',69.00,NULL,'Nasz skuteczny antywirus dla komputera PC z systemem Windows  Blokuje najnowsze wirusy, ransomware, spyware, kryptolokery itp. Blokuje generowanie kryptowalut obniżające wydajność komputera PC','A02-0.jpg','2020-02-03 01:04:45'),(3,'McAfee® Total Protection',69.00,75.00,'Chroń siebie i całą rodzinę przed atakami najnowszych wirusów, oprogramowania szpiegującego, złośliwego i ransomware i bądź na bieżąco ze swoją prywatnością i tożsamością.','A03-0.jpg','2020-02-03 01:35:22'),(4,'Avast Premium Security',179.00,NULL,'Skup się na pracy — zabezpieczenia pozostaw nam. Nasze rozwiązania dostosowują się do specyfiki każdej firmy (obsługujemy zarówno infrastrukturę lokalną, jak i w chmurze) — bez względu na jej rozmiar, typ sieci i używane urządzenia.','A04-0.jpg','2020-02-03 01:37:31'),(5,'ESET Internet Security',170.00,219.00,'Wszechstronna ochrona dla domowego komputera - Kup teraz! Bezpiecznie korzystaj z Internetu! Zainstaluj i zapomnij. Polski support. Nr 1 na rynku. Nr 1 w Polsce.','A05-0.jpg','2020-02-03 01:52:26'),(6,'AVG Internet Security',199.00,NULL,'Jedna subskrypcja. Zawsze aktualny. Nie musisz czekać na jedno duże wydanie raz w roku. Aktualizacje są automatycznie udostępniane na bieżąco. Zrezygnowaliśmy z umieszczania roku w nazwach naszych produktów, ponieważ dzięki subskrypcji Twoja ochrona AVG jest zawsze aktualna. A nowe funkcje? Uzyskasz je automatycznie, kiedy tylko będą dostępne.','A06-0.jpg','2020-02-03 14:14:06'),(7,'Adobe Photoshop CS5 Extended',15299.00,22222.00,'Adobe Photoshop CS5 Extended - najnowsza wersja najbardziej popularnego programu do edycji grafiki rastrowej. Potężny Adobe Photoshop posiada mnóstwo opcji ułatwiających pracę z grafiką. Programem można stworzyć najbardziej zaawansowane projekty, fotomontaże które można wykorzystać w druku oraz na stronach internetowych. W tej odsłonie programu został zmodyfikowany i usprawniony interfejs oraz nawigacja, przesuwania i skalowania podglądu.','G01-0.jpg','2020-02-03 17:25:12'),(8,'Autodesk SketchBok Pro 2016',209.00,NULL,'Autodesk SketchBook Pro to idealne narzędzie do szkicowania, umożliwia artystom grafiki komputerowej na łatwe tworzenie projektów na każdym poziomie zaawansowania. Znane artystom z realnego świata narzędzia typu pędzli oraz wsparcie dla wielu tabletów graficznych czyni z tego programu wysoce intuicyjne narzędzie pracy już od pierwszego kontaktu. SketchBook Pro jest szczególnie wskazany jako potężne narzędzie do projektowania koncepcyjnego i iteracyjnego komponowania obrazów i komunikacji graficznej.','G02-0.jpg','2020-02-03 17:25:42'),(9,'Autodesk Autocad LT 2015',1499.00,NULL,'Twórz precyzyjne rysunki 2D szybciej dzięki łatwym w użyciu narzędziom kreślarskim. Łatwo identyfikuj i dokumentuj różnice graficzne między dwiema wersjami rysunku. Ciesz się szybszym zoomem i panoramowaniem, a także zmieniaj kolejność rysowania i właściwości warstw dzięki ulepszeniom graficznym 2D. Zabierz swoją pracę ze sobą dzięki nowym aplikacjom internetowym i mobilnym AutoCAD. Subskrybowanie programu AutoCAD LT oznacza, że zawsze będziesz mieć najnowsze aktualizacje funkcji, niezawodność technologii TrustedDWG i możliwość projektowania z dowolnego miejsca, w dowolnym momencie za pomocą aplikacji internetowych i mobilnych.','G03-0.jpg','2020-02-03 17:25:50'),(10,'ZWSoft ZWCAD 2020',1799.00,NULL,'Najnowszy ZWCAD jest licencją wieczystą i nigdy nie wygasa. Nowa wersja ZWCAD 2020 zawiera wiele dodatkowych, przydatnych a także oszczędzających czas funkcji których opis zamieszczamy poniżej.','G04-0.jpg','2020-02-03 17:25:59'),(11,'Microsoft Windows 10 Home',519.00,599.00,'System operacyjny Windows 10 Home oferuje wbudowane zabezpieczenia i aplikacje, takie jak Poczta, Kalendarz, Zdjęcia, Microsoft Edge i inne, aby zapewnić Ci bezpieczeństwo i produktywność. Licencjonowany dla 1 komputera PC lub MAC','S01-0.jpg','2020-02-03 17:26:05'),(12,'Microsoft Windows 10 Pro',1099.00,NULL,'Wszystkie funkcje systemu Windows 10 Home oraz funkcje dla firm, takie jak m.in. szyfrowanie, logowanie zdalne i tworzenie maszyn wirtualnych.','S02-0.jpg','2020-02-03 17:26:15'),(13,'Microsoft Windows 8.1 Pro Pack',619.00,NULL,'Za pomocą systemu Windows 8.1 możesz szybko przeglądać strony internetowe, oglądać filmy, grać w gry, dopracowywać swoje CV i tworzyć atrakcyjne prezentacje na tym samym komputerze. Nowością jest możliwość rozmieszczenia na ekranie nawet trzech aplikacji na raz','S03-0.jpg','2020-02-03 17:26:19'),(14,'Windows Server 2019 Essentials',1180.00,9999.00,'Ci, którzy chcą kupić Windows Server 2019 Essentials wybrali przyjazną dla konsumenta edycję serii od 2019 roku. Jest to szczególnie odpowiednie dla mniejszych firm, dla tych, które mają maksymalnie 25 użytkowników i 50 komputerów PC lub równoważnych Urządzenia. Tutaj zaspokojone są potrzeby zarządzanej sieci, a funkcje są łatwe w użyciu. ','S04-0.jpg','2020-02-03 17:26:31');
/*!40000 ALTER TABLE `produkty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `login` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `imie` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `nazwisko` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `adres` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `zip` char(11) COLLATE utf8_unicode_ci NOT NULL,
  `phone` int(10) NOT NULL,
  PRIMARY KEY (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('aaaaaa','aaaaaa','aa@aa.aa','aaaaaa','aaaaaa','aaa','aaa 12','12-123',123123123),('bbbbbb','bbbbbb','bb@bb.bb','bbb','bbb','bbb','bbb 12','13-123',123321321),('cccccc','cccccc','cc@cc.cc','ccc','ccc','ccc','ccc 33','33-123',444555666),('unlogged','unlogged','','','','','','',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zamowienia`
--

DROP TABLE IF EXISTS `zamowienia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zamowienia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `imie` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `nazwisko` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `city` text COLLATE utf8_unicode_ci NOT NULL,
  `adres` text COLLATE utf8_unicode_ci NOT NULL,
  `zip` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `telefon` int(11) NOT NULL,
  `status` text COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `data` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `login` (`login`),
  CONSTRAINT `zamowienia_ibfk_1` FOREIGN KEY (`login`) REFERENCES `users` (`login`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zamowienia`
--

LOCK TABLES `zamowienia` WRITE;
/*!40000 ALTER TABLE `zamowienia` DISABLE KEYS */;
INSERT INTO `zamowienia` VALUES (1,'aaaaaa','Aaaa','Eeeeee','','aaaaaaaaaaaa','','asda@aaa.aaa',123123125,'done','2020-02-03 19:59:06'),(2,'aaaaaa','Aaaa','Bbbb','miasto','aaaaaaaaa','321-12','aa@aa.aaaaa',321321321,'sent','2020-02-03 21:58:10'),(3,'bbbbbb','Rrrrrr','Ffffff','','adfsadf 222/43','','ee@ee.ee',432432423,'sent','2020-02-03 22:05:56'),(4,'bbbbbb','Aaaa','sdada','','wqeqwe522','','aa@aa.aa',323232323,'pending','2020-02-04 00:26:36'),(8,'unlogged','aaaa','aaa','aaaa','ccc 33','33-123','cc@cc.cc',134123123,'pending','2021-02-21 23:57:37'),(9,'aaaaaa','aaaaaa','aaaaaa','aaa','aaa 12','12-123','aa@aa.aa',123123123,'pending','2021-02-22 00:29:30'),(10,'unlogged','Michał','Kowalski','Warszawa','bbb 12','00-000','testowy@gmail.com',123321321,'pending','2021-02-28 13:52:02'),(11,'aaaaaa','aaaaaa','aaaaaa','aaa','aaa 12','12-123','aa@aa.aa',123123123,'pending','2021-03-03 06:52:16'),(12,'unlogged','Zbigniew','Herbert','Wałbrzych','Woronicza 15','99-999','andrzej.uda@gov.pl',345345352,'sent','2021-03-03 10:15:36');
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
INSERT INTO `zamowienia_produkty` VALUES (2,7,4),(2,13,3),(2,1,1),(2,2,1),(3,9,4),(3,13,2),(4,3,1),(4,12,1),(4,11,1),(1,1,3),(1,2,2),(1,3,4),(1,4,3),(8,12,1),(9,1,1),(10,1,1),(11,2,3),(11,8,1),(11,13,1),(12,5,1),(12,14,3),(12,12,4),(2,12,4);
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

-- Dump completed on 2021-03-03 10:24:59
