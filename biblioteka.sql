/*
SQLyog Community v13.1.9 (64 bit)
MySQL - 10.4.21-MariaDB : Database - domaci
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`domaci` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `domaci`;

/*Table structure for table `automobili` */

DROP TABLE IF EXISTS `automobili`;

CREATE TABLE `automobili` (
  `autoID` int(11) NOT NULL AUTO_INCREMENT,
  `marka` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `godinaProizvodnje` int(11) NOT NULL,
  PRIMARY KEY (`autoID`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

/*Data for the table `automobili` */

insert  into `automobili`(`autoID`,`marka`,`model`,`godinaProizvodnje`) values 
(1,'Mercedes','S klasa',2015),
(2,'BMW','8',2018),
(3,'Audi','A7',2019),
(5,'Nissan','370Z',2019),
(6,'Nissan ','GTR',2018),
(7,'Lamburghini','Aventador',2016),
(8,'Ferari','Laferari',2014),
(10,'BMW','7',2007),
(13,'Bugatti','Chiron',2015);

/*Table structure for table `vozaci` */

DROP TABLE IF EXISTS `vozaci`;

CREATE TABLE `vozaci` (
  `vozacID` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(255) NOT NULL,
  `prezime` varchar(255) NOT NULL,
  `auto` int(11) NOT NULL,
  PRIMARY KEY (`vozacID`),
  KEY `auto` (`auto`),
  CONSTRAINT `auto` FOREIGN KEY (`auto`) REFERENCES `automobili` (`autoID`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4;

/*Data for the table `vozaci` */

insert  into `vozaci`(`vozacID`,`ime`,`prezime`,`auto`) values 
(1,'Lazar','Markovic',1),
(2,'Marko','Lazarevic',2),
(3,'Petar','Petrovic',7),
(4,'Dejan','Milutinovic',6),
(5,'Sofija','Nedovic',8),
(6,'Aleksa','Petrovic',5),
(7,'Luka','Basic',3),
(8,'Milutin','Perovic',10),
(12,'Milutinac','Marknovic',13),
(34,'Marko','Jeremic',5);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
