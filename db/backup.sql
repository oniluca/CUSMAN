/*
SQLyog Ultimate v8.61 
MySQL - 5.6.15-log : Database - cusman
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cusman` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `cusman`;

/*Table structure for table `cliente_servicios` */

DROP TABLE IF EXISTS `cliente_servicios`;

CREATE TABLE `cliente_servicios` (
  `cuit_cliente` varchar(11) NOT NULL,
  `id_servicios` int(3) NOT NULL,
  `estado_servicio` int(1) DEFAULT NULL,
  PRIMARY KEY (`cuit_cliente`,`id_servicios`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `cliente_servicios` */

LOCK TABLES `cliente_servicios` WRITE;

insert  into `cliente_servicios`(`cuit_cliente`,`id_servicios`,`estado_servicio`) values ('30707098456',22,0),('30707098456',18,0),('30707098456',17,0),('30707098456',5,0),('30707098456',10,0),('30707098456',14,0),('30707098456',13,0),('30707098456',12,0),('30707098456',20,0),('30707098456',1,0),('30707098456',2,0),('30707098456',15,0),('30707098456',3,0),('30707098456',9,0),('30707098456',11,0),('30707098456',6,0),('12345678901',18,0),('12345678901',5,0),('12345678901',13,0),('12345678901',20,0),('12345678901',2,0),('12345678901',15,0),('12345678901',7,0),('12345678901',9,0),('12345678901',4,0),('12345678901',19,0),('12345678901',8,0),('12345678901',21,0),('30707098456',7,0),('30707098456',21,0),('12345678901',22,0),('30707098456',4,0),('30707098456',19,0),('30707098456',8,0),('30707098456',16,0),('12345678901',1,0),('12345678901',3,0),('',1,0),('28736487255',22,0),('28736487255',7,0),('28736487255',9,0),('28736487255',11,0),('28736487255',16,0),('28736487255',8,0),('28736487255',6,0),('28736487255',21,0),('28736487255',19,0),('28736487255',4,0);

UNLOCK TABLES;

/*Table structure for table `clientes` */

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `cuit` varchar(11) NOT NULL,
  `razon_social` varchar(30) DEFAULT NULL,
  `clave_fiscal` varchar(30) DEFAULT NULL,
  `clave_atm` varchar(30) DEFAULT NULL,
  `clave_sindicato` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `tel` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`cuit`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `clientes` */

LOCK TABLES `clientes` WRITE;

insert  into `clientes`(`cuit`,`razon_social`,`clave_fiscal`,`clave_atm`,`clave_sindicato`,`email`,`tel`) values ('12345678904','sggdfg','','','','',''),('55555555555','qqqqqqqqqqqqqqqqqqqqqqqqqqqqqq','','','','',''),('28736487255','ttttw','ifhsdqwd3d32e2','dkvnsldfvbsdils','dznfvildbsiidvblib77y','nlsiua@vlsduhvo.com','8787879879879'),('30707098456','usuario de prueba','usuariodeprueba123','usuariodeprueba123','usuariodeprueba123','usuariodeprueba@gmail.com','0261155346277'),('12345678901','pepe','eueueueueu','esurvesoershidddddd','hhhhhhhhhhhhhh','cher@vkrsulnv.com','1212121214');

UNLOCK TABLES;

/*Table structure for table `configuracion` */

DROP TABLE IF EXISTS `configuracion`;

CREATE TABLE `configuracion` (
  `id` int(2) NOT NULL,
  `inicio_mes` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `configuracion` */

LOCK TABLES `configuracion` WRITE;

insert  into `configuracion`(`id`,`inicio_mes`) values (1,1);

UNLOCK TABLES;

/*Table structure for table `estado_cuenta_cliente` */

DROP TABLE IF EXISTS `estado_cuenta_cliente`;

CREATE TABLE `estado_cuenta_cliente` (
  `id_cliente` varchar(11) NOT NULL,
  `saldo` float DEFAULT NULL,
  `iva_a_pagar` float DEFAULT NULL,
  `iva_a_favor` float DEFAULT NULL,
  `ganancias_a_pagar` float DEFAULT NULL,
  `ganancias_a_favor` float DEFAULT NULL,
  `saldo_mensual` float DEFAULT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `estado_cuenta_cliente` */

LOCK TABLES `estado_cuenta_cliente` WRITE;

insert  into `estado_cuenta_cliente`(`id_cliente`,`saldo`,`iva_a_pagar`,`iva_a_favor`,`ganancias_a_pagar`,`ganancias_a_favor`,`saldo_mensual`) values ('28736487255',4280,0,0,0,0,0),('12345678904',-344,0,0,0,0,0),('30707098456',8700,0,0,0,0,0),('12345678901',-320,0,0,0,0,0),('55555555555',0,0,0,0,0,0);

UNLOCK TABLES;

/*Table structure for table `estado_historico_cuenta_cliente` */

DROP TABLE IF EXISTS `estado_historico_cuenta_cliente`;

CREATE TABLE `estado_historico_cuenta_cliente` (
  `mes` date DEFAULT NULL,
  `monto` float DEFAULT NULL,
  `cuit` varchar(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `estado_historico_cuenta_cliente` */

LOCK TABLES `estado_historico_cuenta_cliente` WRITE;

insert  into `estado_historico_cuenta_cliente`(`mes`,`monto`,`cuit`) values ('2020-12-01',2000,'28736487255'),('2021-02-01',3900,'28736487255'),('2021-01-01',600,'28736487255'),('2021-01-01',1200,'30707098456'),('2021-01-01',1200,'12345678901'),('2021-02-01',4000,'30707098456'),('2021-02-01',500,'12345678901'),('2021-01-01',1200,'30707098456'),('2020-12-01',2400,'12345678901'),('2021-02-03',9640,'28736487255'),('2021-02-03',300,'30707098456'),('2021-02-03',0,'12345678901');

UNLOCK TABLES;

/*Table structure for table `historial_pago` */

DROP TABLE IF EXISTS `historial_pago`;

CREATE TABLE `historial_pago` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `id_cliente` varchar(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `monto` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

/*Data for the table `historial_pago` */

LOCK TABLES `historial_pago` WRITE;

insert  into `historial_pago`(`id`,`id_cliente`,`fecha`,`monto`) values (1,'12345678901','2020-12-20',1300),(2,'12345678901','2021-01-12',1000),(3,'28736487255','2020-04-07',1200),(4,'28736487255','2020-08-20',2500),(5,'28736487255','2020-09-30',560),(6,'28736487255','2020-10-15',560),(7,'28736487255','2021-02-03',300),(8,'28736487255','2021-02-03',3590),(9,'30707098456','2021-02-03',1200),(15,'30707098456','2021-02-04',6330),(14,'28736487255','2021-02-03',1100),(13,'28736487255','2021-02-03',100),(16,'28736487255','2021-02-04',420),(17,'28736487255','2021-02-04',5000),(18,'30707098456','2021-02-14',800),(20,'12345678901','2021-02-14',6000),(26,'12345678904','2021-04-20',344);

UNLOCK TABLES;

/*Table structure for table `servicios` */

DROP TABLE IF EXISTS `servicios`;

CREATE TABLE `servicios` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `servicio` varchar(25) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Data for the table `servicios` */

LOCK TABLES `servicios` WRITE;

insert  into `servicios`(`id`,`servicio`,`precio`) values (1,'Libro IVA digital',300),(2,'IVA',600),(3,'IIBB',1000),(4,'931',360),(5,'Sindicato',780),(6,'Bono',440),(7,'Ganancias',1200),(8,'Bienes personales',1200),(9,'Facturacion',2500),(10,'Recategorizacion',400),(11,'Contratos',1350),(12,'Modificacion de datos',750),(13,'Plan de pagos',600),(14,'Requerimientos',600),(15,'Intimaciones',1000),(16,'Boleta de deuda',400),(17,'Tasa cero',400),(18,'tasa diferencial ',400),(19,'Alta / Baja impuestos',690),(20,'Manifestacion de bienes',1200),(21,'Certificacion de ingresos',1500),(22,'Vencimientos',750);

UNLOCK TABLES;

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(15) NOT NULL,
  `clave` varchar(128) NOT NULL,
  `imagen` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `usuario` */

LOCK TABLES `usuario` WRITE;

insert  into `usuario`(`id`,`usuario`,`clave`,`imagen`) values (1,'administrador','^yQª@?ñmÔSçØnàÉœå1žƒc3¶º9Š IM>v9~=™èüGº|ýv\0ÔS•ŒuP\0Ì1ÎP¬Ÿž','imagenes/usuario/administrador.jpg'),(2,'user','user',NULL);

UNLOCK TABLES;

/*Table structure for table `vencimientos_anuales` */

DROP TABLE IF EXISTS `vencimientos_anuales`;

CREATE TABLE `vencimientos_anuales` (
  `fecha` varchar(10) DEFAULT NULL,
  `servicio` varchar(16) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `vencimientos_anuales` */

LOCK TABLES `vencimientos_anuales` WRITE;

insert  into `vencimientos_anuales`(`fecha`,`servicio`) values ('2021-01-20','recategorizacion'),('2021-06-30','ddjj'),('2021-07-20','recategorizacion');

UNLOCK TABLES;

/*Table structure for table `vencimientos_ddjj` */

DROP TABLE IF EXISTS `vencimientos_ddjj`;

CREATE TABLE `vencimientos_ddjj` (
  `mes` varchar(9) DEFAULT NULL,
  `0_1_2` int(2) DEFAULT NULL,
  `3_4_5` int(2) DEFAULT NULL,
  `6_7` int(2) DEFAULT NULL,
  `8_9` int(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `vencimientos_ddjj` */

LOCK TABLES `vencimientos_ddjj` WRITE;

insert  into `vencimientos_ddjj`(`mes`,`0_1_2`,`3_4_5`,`6_7`,`8_9`) values ('Enero',NULL,NULL,NULL,NULL),('Febrero',17,18,19,22),('Marzo',15,16,17,18),('Abril',15,16,19,20),('Mayo',17,18,19,20),('Junio',15,16,17,18),('Julio',15,16,19,20),('Agosto',17,18,19,20),('Septiembr',15,16,17,20),('Octubre',15,18,19,20),('Noviembre',15,16,17,18),('Diciembre',15,16,17,20);

UNLOCK TABLES;

/*Table structure for table `vencimientos_iva` */

DROP TABLE IF EXISTS `vencimientos_iva`;

CREATE TABLE `vencimientos_iva` (
  `mes` varchar(9) DEFAULT NULL,
  `0_1` int(2) DEFAULT NULL,
  `2_3` int(2) DEFAULT NULL,
  `4_5` int(2) DEFAULT NULL,
  `6_7` int(2) DEFAULT NULL,
  `8_9` int(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `vencimientos_iva` */

LOCK TABLES `vencimientos_iva` WRITE;

insert  into `vencimientos_iva`(`mes`,`0_1`,`2_3`,`4_5`,`6_7`,`8_9`) values ('Enero',18,19,20,21,22),('Febrero',18,19,22,23,24),('Marzo',18,19,22,23,25),('Abril',19,20,21,22,23),('Mayo',18,19,20,21,26),('Junio',18,22,23,24,25),('Julio',19,20,21,22,23),('Agosto',18,19,20,23,24),('Septiembr',NULL,NULL,NULL,NULL,NULL),('Octubre',18,19,20,21,22),('Noviembre',18,19,23,24,25),('Diciembre',20,21,22,23,24);

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
