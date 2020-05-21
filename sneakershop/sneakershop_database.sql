-- MySQL dump 10.13  Distrib 8.0.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: sneakershop
-- ------------------------------------------------------
-- Server version	8.0.17

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
-- Table structure for table `brand`
--

DROP TABLE IF EXISTS `brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `brand_name_uindex` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brand`
--

LOCK TABLES `brand` WRITE;
/*!40000 ALTER TABLE `brand` DISABLE KEYS */;
INSERT INTO `brand` (`id`, `name`) VALUES (9,'adidas'),(10,'nike'),(11,'puma'),(12,'reebook');
/*!40000 ALTER TABLE `brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` (`id`, `username`, `email`, `phone`) VALUES (1,'Карим','shkar2001@mail.ru','89320'),(2,'Карим','shkar2001@mail.ru','89320'),(3,'Карим','shkar2001@mail.ru','89320'),(4,'Карим','shkar2001@mail.ru','89320'),(5,'Карим','shkar2001@mail.ru','89320'),(6,'Карим','shkar8@mail.ru','89969521554'),(7,'Карим','shkar8@mail.ru','89969521554'),(8,'Карим','shkar2001@mail.ru','89969521554'),(9,'Карим','shkar2001@mail.ru','89969521554'),(10,'Карим','shkar2001@mail.ru','89969521554'),(11,'Карим','alphadoggy@yandex.ru','+79969521554'),(12,'Карим','alphadoggy@yandex.ru','+79969521554'),(13,'Карим','alphadoggy@yandex.ru','+79969521554'),(14,'Карим','alphadoggy@yandex.ru','+79969521554'),(15,'Карим','alphadoggy@yandex.ru','+79969521554'),(16,'Карим','alphadoggy@yandex.ru','+79969521554'),(17,'Карим','alphadoggy@yandex.ru','+79969521554'),(18,'Карим','alphadoggy@yandex.ru','+79969521554'),(19,'Карим','alphadoggy@yandex.ru','+79969521554'),(20,'Карим','alphadoggy@yandex.ru','+79969521554'),(21,'Карим','alphadoggy@yandex.ru','+79969521554'),(22,'Карим','alphadoggy@yandex.ru','+79969521554'),(23,'Карим','alphadoggy@yandex.ru','+79969521554'),(24,'Карим','alphadoggy@yandex.ru','+79969521554');
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_model`
--

DROP TABLE IF EXISTS `order_model`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_model` (
  `order_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `size` varchar(5) DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_model`
--

LOCK TABLES `order_model` WRITE;
/*!40000 ALTER TABLE `order_model` DISABLE KEYS */;
INSERT INTO `order_model` (`order_id`, `model_id`, `size`, `quantity`) VALUES (18,35,NULL,1),(19,36,NULL,1),(20,36,NULL,3),(21,39,NULL,1),(21,37,NULL,1),(22,36,'42',1),(23,35,'41',1),(24,35,'41',2);
/*!40000 ALTER TABLE `order_model` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(45) DEFAULT NULL,
  `brand` varchar(45) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `img` varchar(45) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  KEY `product___fk_brand_name` (`brand`),
  CONSTRAINT `product___fk_brand_name` FOREIGN KEY (`brand`) REFERENCES `brand` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` (`id`, `model`, `brand`, `price`, `img`, `description`) VALUES (35,'adidas hamburg','adidas',7900,'hamburg.jpg','Кроссовки adidas Originals Hamburg, ставшие частью легендарной «городской» серии, вышедшей в 1980-е годы, выполнены в новом цвете индиго. Верх изготовле...'),(36,'nike air max 97','nike',14490,'97.jpg','Нет ни одного человека, который не знает компанию Nike, названную в честь древнегреческой богини победы Ники. Компания была основана в 1964 году студентом Филом Найтом, бегуном на средние дистанции в команде Орегонского университета, и его тренером Биллом Бауэрманом. Первоначальное название Blue Ribbon Sports было изменено на современное лишь в 1978 году, а знаменитый логотип марки «свуш» был разработан студенткой-дизайнером Портлендского университета Кэролин Дэвидсон в 1971 году, за что она получила гонорар в $35.'),(37,'nike air max 95','nike',14490,'95.jpg','Кроссовки Nike Air Max 95 SP, дизайн которых вдохновлен строением человеческого тела, сочетают невероятный комфорт и беговые традиции. Культовые боковые вставки символизируют мышцы, а вставка Nike Air в области пятки и передней части стопы амортизирует каждый шаг.'),(38,'adidas FYW 98','adidas',9990,'fyw.jpg','Мощный шаг в 90-е. Эти кроссовки adidas FYW 98 — переиздание версии 1998 года. Привлекающий внимание дизайн с уникальной текстурной подошвой превратил их в легенду прошлого поколения. Пора им заработать культовый статус и в настоящем.'),(39,'PUMA RS-X3 Mix','puma',9490,'rs-x3.jpg','Компания Puma была основана Рудольфом Дасслером, братом знаменитого Адольфа Дасслера – создателя adidas, в 1948 году. Изначально компания называлась RuDa от сокращения имени и фамилии основателя, но позже была переименована в Puma. Знаменитый логотип появился в 1960 году и со временем претерпел небольшие изменения: он изображает силуэт грациозной пумы в прыжке, как символ постоянного стремления вперёд. На сегодняшний день Puma – это не только одна из лидирующих компаний по производству спортивной одежды и обуви, но и крайне интересный, творческий бренд, открытый для сотрудничества и новых идей, что доказывают многочисленные совместные работы с ведущими современными дизайнерами и марками.'),(40,'Reebook Instapump Fury OG NM','reebook',12690,'instapump.jpg','Компания Reebok начинает свою историю в далеком 1895 году в маленьком английском городе Болтон, когда ее основатель Джозеф Уильям Фостер изготовил первую шипованную пару обуви для бега. Тогда компания называлась J. \'W. Foster & Sons, а нынешнее имя получила лишь в 1958 году в честь быстроногой антилопы. Но прославились Reebok в 80-х, как производители спортивной обуви, которые впервые обратила внимание на обувь для фитнеса и занятий в зале. Но начинали англичане, как и многие, с беговой обуви. ');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shoe_size`
--

DROP TABLE IF EXISTS `shoe_size`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shoe_size` (
  `size` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shoe_size`
--

LOCK TABLES `shoe_size` WRITE;
/*!40000 ALTER TABLE `shoe_size` DISABLE KEYS */;
INSERT INTO `shoe_size` (`size`) VALUES ('40'),('37,5'),('42');
/*!40000 ALTER TABLE `shoe_size` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sizes_of_models`
--

DROP TABLE IF EXISTS `sizes_of_models`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sizes_of_models` (
  `model_id` int(11) NOT NULL,
  `size` varchar(5) NOT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sizes_of_models`
--

LOCK TABLES `sizes_of_models` WRITE;
/*!40000 ALTER TABLE `sizes_of_models` DISABLE KEYS */;
INSERT INTO `sizes_of_models` (`model_id`, `size`, `quantity`) VALUES (35,'42',3),(35,'37,5',2),(36,'40',2),(36,'42',1),(37,'42',3),(37,'40',2),(38,'37,5',1),(38,'42',3),(39,'41',3),(39,'37,5',4),(40,'42',2),(40,'40',3),(35,'41',3),(39,'42',0);
/*!40000 ALTER TABLE `sizes_of_models` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-18  1:43:28
