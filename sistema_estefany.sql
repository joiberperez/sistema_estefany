/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.5.2-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: sistema_estefany
-- ------------------------------------------------------
-- Server version	11.5.2-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES
(1,'Chocolates','Variedad de chocolates y bombones','2024-10-26 20:30:04','2024-10-26 20:30:04'),
(2,'Galletas','Galletas de diferentes sabores y tamaños','2024-10-26 20:30:04','2024-10-26 20:30:04'),
(3,'Dulces','Dulces y caramelos variados','2024-10-26 20:30:04','2024-10-26 20:30:04'),
(4,'Pasteles','Pasteles y tortas para ocasiones especiales','2024-10-26 20:30:04','2024-10-26 20:30:04'),
(5,'Postres','Postres individuales y porciones','2024-10-26 20:30:04','2024-10-26 20:30:04'),
(6,'Bebidas','Bebidas frías y calientes, como jugos y cafés','2024-10-26 20:30:04','2024-10-26 20:30:04'),
(7,'Snacks','Snacks salados y aperitivos','2024-10-26 20:30:04','2024-10-26 20:30:04'),
(8,'Frutas Confitadas','Frutas en almíbar o cubiertas de chocolate','2024-10-26 20:30:04','2024-10-26 20:30:04'),
(9,'Helados','Helados y sorbetes de diversos sabores','2024-10-26 20:30:04','2024-10-26 20:30:04'),
(10,'Decoraciones de Pastelería','Artículos para decorar pasteles y postres','2024-10-26 20:34:33','2024-10-26 20:34:33');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_cliente` varchar(100) NOT NULL,
  `apellido_cliente` varchar(100) NOT NULL,
  `cedula_cliente` varchar(20) NOT NULL,
  `telefono_cliente` varchar(15) DEFAULT NULL,
  `fecha_registro` date NOT NULL DEFAULT curdate(),
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `cedula_cliente` (`cedula_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=240 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES
(21,'Juan','Perez','12345678','04121234567','2024-10-26'),
(22,'María','González','23456789','04142345678','2024-10-26'),
(23,'Luis','Rodríguez','34567890','04243456789','2024-10-26'),
(24,'Anita','Torres','45678901','04164567890','2024-10-26'),
(25,'Carlos','Sánchez','56789012','04245678901','2024-10-26'),
(26,'Laura','Martínez','67890123','04126789012','2024-10-26'),
(27,'Javier','Romero','78901234','04147890123','2024-10-26'),
(28,'Sofía','Castro','89012345','04248901234','2024-10-26'),
(29,'Diego','Hernández','90123456','04169012345','2024-10-26'),
(30,'Gabriela','López','12345677','04241234567','2024-10-26'),
(31,'Andrés','Jiménez','23456788','04122345678','2024-10-26'),
(32,'Patricia','Ruiz','34567899','04143456789','2024-10-26'),
(33,'Fernando','Díaz','45678910','04244567890','2024-10-26'),
(34,'Verónica','Silva','56789011','04165678901','2024-10-26'),
(35,'Rafael','Morales','67890122','04246789012','2024-10-26'),
(36,'Claudia','Ríos','78901233','04127890123','2024-10-26'),
(37,'Eduardo','Medina','89012344','04148901234','2024-10-26'),
(38,'Camila','Fernández','90123455','04249012345','2024-10-26'),
(41,'joiber','perez','31911228','04247013239','2024-10-26'),
(128,'alexis','perez','13364648','04125055655','2024-10-26'),
(130,'edilama','osorio','84401577','04247013239','2024-10-26'),
(148,'eddy','perez','12345674','04125055655','2024-10-26'),
(150,'francis','perez','31777222','04247014532','2024-10-26'),
(152,'alexa','perez','87654321','04247014532','2024-10-26'),
(210,'Marcos','Alvarado','11223344','04123456789','2024-10-28'),
(211,'Isabel','Cordero','22334455','04134567890','2024-10-28'),
(212,'Esteban','Paniagua','33445566','04145678901','2024-10-28'),
(213,'Camila','Salazar','44556677','04156789012','2024-10-28'),
(214,'Ricardo','Núñez','55667788','04167890123','2024-10-28'),
(215,'Natalia','Mendoza','66778899','04178901234','2024-10-28'),
(216,'Fernando','Quintero','77889900','04189012345','2024-10-28'),
(217,'Valentina','Rojas','88990011','04190123456','2024-10-28'),
(218,'Santiago','Castillo','99001122','04101234567','2024-10-28'),
(219,'Ana','Bermúdez','00112233','04112345678','2024-10-28'),
(220,'Lucía','Márquez','33445588','04123456780','2024-10-28'),
(221,'Julio','Cruz','44556699','04134567891','2024-10-28'),
(222,'Pablo','Rivas','55667700','04145678902','2024-10-28'),
(223,'Teresa','Valdez','66778811','04156789013','2024-10-28'),
(224,'Diego','Ceballos','77889922','04167890124','2024-10-28'),
(225,'Rosa','Hernández','88990033','04178901235','2024-10-28'),
(226,'Salvador','Santos','99001144','04189012346','2024-10-28'),
(227,'Verónica','López','00112255','04190123457','2024-10-28'),
(228,'Nicolás','Salas','11223366','04101234568','2024-10-28'),
(229,'Miriam','Figueroa','22334477','04112345679','2024-10-28'),
(230,'Fernando','Córdoba','33447788','04123456781','2024-10-28'),
(231,'Alejandra','Gutiérrez','44558899','04134567892','2024-10-28'),
(232,'Samuel','Ortega','55669900','04145678903','2024-10-28'),
(233,'Gabriela','Villanueva','66770011','04156789014','2024-10-28'),
(234,'Cristian','Mendoza','77881122','04167890125','2024-10-28'),
(235,'Carolina','Pérez','88992233','04178901236','2024-10-28'),
(236,'Álvaro','Jaramillo','99003344','04189012347','2024-10-28'),
(237,'Estefanía','Cifuentes','00114455','04190123458','2024-10-28'),
(238,'Arturo','González','11225566','04101234569','2024-10-28'),
(239,'Silvia','Alonso','22336677','04112345680','2024-10-28');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compra_producto`
--

DROP TABLE IF EXISTS `compra_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compra_producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_compra` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `proveedor_id` (`proveedor_id`),
  KEY `compra_producto_ibfk_1` (`producto_id`),
  CONSTRAINT `compra_producto_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE,
  CONSTRAINT `compra_producto_ibfk_2` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compra_producto`
--

LOCK TABLES `compra_producto` WRITE;
/*!40000 ALTER TABLE `compra_producto` DISABLE KEYS */;
INSERT INTO `compra_producto` VALUES
(2,32,2,200,'2024-10-26 20:34:35'),
(3,33,2,150,'2024-10-26 20:34:35'),
(4,34,2,50,'2024-10-26 20:34:35'),
(5,35,2,75,'2024-10-26 20:34:35'),
(6,36,2,80,'2024-10-26 20:34:35'),
(7,37,2,120,'2024-10-26 20:34:35'),
(8,38,2,60,'2024-10-26 20:34:35'),
(81,32,2,15,'2024-10-29 20:13:24'),
(82,32,2,15,'2024-10-29 20:13:24'),
(83,32,2,15,'2024-10-29 20:13:24'),
(84,32,2,15,'2024-10-29 20:13:24'),
(85,32,2,15,'2024-10-29 20:13:24'),
(86,32,2,15,'2024-10-29 20:13:24'),
(87,32,2,15,'2024-10-29 20:13:24'),
(88,32,2,15,'2024-10-29 20:13:24'),
(89,32,2,15,'2024-10-29 20:13:24'),
(90,32,2,15,'2024-10-29 20:13:24'),
(91,38,2,10,'2024-10-29 20:32:52'),
(92,38,2,15,'2024-10-29 20:32:52'),
(93,38,2,20,'2024-10-29 20:32:52'),
(94,38,2,25,'2024-10-29 20:32:52'),
(95,38,2,30,'2024-10-29 20:32:52'),
(96,37,3,5,'2024-10-29 21:42:05'),
(97,41,3,2,'2024-10-30 02:00:29'),
(98,41,3,2,'2024-10-30 02:00:43'),
(99,41,3,2,'2024-10-30 02:02:44'),
(100,41,2,10,'2024-10-30 02:10:15'),
(101,42,3,5,'2024-10-30 02:38:15'),
(102,42,2,1,'2024-10-30 02:59:26'),
(103,42,3,2,'2024-10-30 03:07:45'),
(104,42,2,3,'2024-11-01 18:39:12'),
(105,42,2,5,'2024-11-04 17:30:35');
/*!40000 ALTER TABLE `compra_producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dolar`
--

DROP TABLE IF EXISTS `dolar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dolar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` decimal(10,2) NOT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dolar`
--

LOCK TABLES `dolar` WRITE;
/*!40000 ALTER TABLE `dolar` DISABLE KEYS */;
INSERT INTO `dolar` VALUES
(1,222.00,'2024-11-08 02:03:11');
/*!40000 ALTER TABLE `dolar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventario`
--

DROP TABLE IF EXISTS `inventario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) DEFAULT NULL,
  `cantidad_disponible` float(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `producto_id` (`producto_id`),
  CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventario`
--

LOCK TABLES `inventario` WRITE;
/*!40000 ALTER TABLE `inventario` DISABLE KEYS */;
INSERT INTO `inventario` VALUES
(1,32,84.00),
(2,33,150.00),
(3,34,50.00),
(4,35,75.00),
(5,36,200.00),
(6,37,120.00),
(7,38,90.00),
(8,41,40.00),
(9,42,0.00);
/*!40000 ALTER TABLE `inventario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `metodo_pago`
--

DROP TABLE IF EXISTS `metodo_pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `metodo_pago` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `metodo_pago`
--

LOCK TABLES `metodo_pago` WRITE;
/*!40000 ALTER TABLE `metodo_pago` DISABLE KEYS */;
INSERT INTO `metodo_pago` VALUES
(1,'divisas'),
(2,'transferencia'),
(3,'efectivo'),
(4,'tarjeta');
/*!40000 ALTER TABLE `metodo_pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `categoria_id` (`categoria_id`),
  CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES
(32,'Galletas de Vainilla','Galletas crujientes con sabor a vainilla.',1.00,2,'2024-10-26 20:34:35','2024-10-26 20:34:35'),
(33,'Dulces de Frutas','Caramelos de frutas variadas.',0.75,3,'2024-10-26 20:34:35','2024-10-26 20:34:35'),
(34,'Tarta de Fresa','Tarta de vainilla con fresas frescas.',15.00,4,'2024-10-26 20:34:35','2024-10-26 20:34:35'),
(35,'Mousse de Chocolate','Suave mousse de chocolate negro',4.00,5,'2024-10-26 20:34:35','2024-10-30 02:33:59'),
(36,'Café Espresso','Café espresso recién hecho.',2.00,6,'2024-10-26 20:34:35','2024-10-26 20:34:35'),
(37,'Papas Fritas','Papas fritas crujientes.',1.50,7,'2024-10-26 20:34:35','2024-10-26 20:34:35'),
(38,'Frutas Confitadas','Mezcla de frutas confitadas.',3.00,8,'2024-10-26 20:34:35','2024-10-26 20:34:35'),
(41,'torta de chocolate con queso','es una torta',10.00,4,'2024-10-29 15:19:09','2024-10-29 15:31:55'),
(42,'helado','heladodefresa',5.00,9,'2024-10-30 02:29:12','2024-10-30 02:29:12');
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedor`
--

DROP TABLE IF EXISTS `proveedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proveedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedor`
--

LOCK TABLES `proveedor` WRITE;
/*!40000 ALTER TABLE `proveedor` DISABLE KEYS */;
INSERT INTO `proveedor` VALUES
(2,'Distribuidora SASA',' tucani estado merida    ','04247013239','2024-10-26 15:34:21'),
(3,'supermercado Alex',' tucani merida ','04247013239','2024-10-26 15:38:35');
/*!40000 ALTER TABLE `proveedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seguridad`
--

DROP TABLE IF EXISTS `seguridad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seguridad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `rol` enum('a','u') DEFAULT 'u',
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_usuario` (`nombre_usuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seguridad`
--

LOCK TABLES `seguridad` WRITE;
/*!40000 ALTER TABLE `seguridad` DISABLE KEYS */;
INSERT INTO `seguridad` VALUES
(1,'estefany','contreras','estefany','$2a$12$.KTl3niVoymrN9aMjTkcqufkd9XBdpXdZToPmu4NgBeVSljf33Za.','estefanycontreras@gmail.com','a','2024-11-08 01:58:10');
/*!40000 ALTER TABLE `seguridad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta`
--

DROP TABLE IF EXISTS `venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_venta` timestamp NULL DEFAULT current_timestamp(),
  `total` decimal(10,2) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `metodo_pago_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cliente_id` (`cliente_id`),
  KEY `fk_metodo_pago` (`metodo_pago_id`),
  CONSTRAINT `fk_metodo_pago` FOREIGN KEY (`metodo_pago_id`) REFERENCES `metodo_pago` (`id`),
  CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta`
--

LOCK TABLES `venta` WRITE;
/*!40000 ALTER TABLE `venta` DISABLE KEYS */;
INSERT INTO `venta` VALUES
(4,'2024-11-04 03:35:42',156.00,41,1),
(5,'2024-11-04 03:36:12',156.00,41,1),
(6,'2024-11-04 03:44:48',82.50,41,1),
(7,'2024-11-04 03:52:25',20.00,41,1),
(8,'2024-11-04 03:52:58',20.00,41,1),
(9,'2024-11-04 03:56:00',44.50,41,1),
(10,'2024-11-04 03:59:09',5.00,41,1),
(11,'2024-11-04 04:00:03',1.00,41,1),
(12,'2024-11-04 04:01:07',15.00,41,1),
(13,'2024-11-04 17:08:30',15.00,41,1),
(14,'2024-11-04 17:25:25',35.00,41,1),
(15,'2024-11-04 17:29:04',20.00,41,1),
(16,'2024-11-04 17:38:45',25.00,41,1),
(17,'2024-11-04 17:41:47',10.00,41,1),
(18,'2024-11-05 02:28:46',6.00,26,1);
/*!40000 ALTER TABLE `venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta_producto`
--

DROP TABLE IF EXISTS `venta_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `venta_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `venta_id` (`venta_id`),
  KEY `producto_id` (`producto_id`),
  CONSTRAINT `venta_producto_ibfk_1` FOREIGN KEY (`venta_id`) REFERENCES `venta` (`id`),
  CONSTRAINT `venta_producto_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_producto`
--

LOCK TABLES `venta_producto` WRITE;
/*!40000 ALTER TABLE `venta_producto` DISABLE KEYS */;
INSERT INTO `venta_producto` VALUES
(6,4,32,11,11.00),
(7,4,42,5,25.00),
(8,4,34,4,60.00),
(9,4,41,6,60.00),
(10,5,32,11,11.00),
(11,5,42,5,25.00),
(12,5,34,4,60.00),
(13,5,41,6,60.00),
(14,6,34,5,75.00),
(15,6,33,10,7.50),
(16,7,42,4,20.00),
(17,8,42,4,20.00),
(18,9,34,1,15.00),
(19,9,33,10,7.50),
(20,9,42,2,10.00),
(21,9,36,6,12.00),
(22,10,42,1,5.00),
(23,11,32,1,1.00),
(24,12,34,1,15.00),
(25,13,34,1,15.00),
(26,14,42,7,35.00),
(27,15,42,4,20.00),
(28,16,42,5,25.00),
(29,17,32,10,10.00),
(30,18,32,6,6.00);
/*!40000 ALTER TABLE `venta_producto` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2024-11-08  7:59:16
