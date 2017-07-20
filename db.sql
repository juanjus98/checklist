/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.7.13-log : Database - db_checklist
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `web_checklist` */

DROP TABLE IF EXISTS `web_checklist`;

CREATE TABLE `web_checklist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `checklist_nombre` varchar(255) NOT NULL,
  `descripcion` longtext NOT NULL,
  `imagen_cabecera` varchar(255) NOT NULL DEFAULT 'no-imagen.jpg',
  `imagen_pie` varchar(255) NOT NULL DEFAULT 'no-imagen.jpg',
  `ultima_numeracion` int(11) NOT NULL DEFAULT '0' COMMENT 'último número usado',
  `publicado` int(11) NOT NULL DEFAULT '0' COMMENT '1:publicado, 0:no publicado',
  `usuario_id` int(11) NOT NULL,
  `agregar` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editar` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `eliminar` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `estado` int(11) NOT NULL DEFAULT '1' COMMENT '0:eliminado',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `web_checklist` */

insert  into `web_checklist`(`id`,`checklist_nombre`,`descripcion`,`imagen_cabecera`,`imagen_pie`,`ultima_numeracion`,`publicado`,`usuario_id`,`agregar`,`editar`,`eliminar`,`estado`) values (49,'Check list 2','Una descripción sobre el checklist','no-imagen.jpg','no-imagen.jpg',23,0,0,'2017-07-15 07:23:06','0000-00-00 00:00:00','2017-07-19 03:55:30',1),(50,'Check list 1 sobro el traslado de carga pesada','Demo de checklist','no-imagen.jpg','no-imagen.jpg',1,1,0,'2017-07-18 22:34:37','0000-00-00 00:00:00','0000-00-00 00:00:00',1),(51,'Tets','test','no-imagen.jpg','no-imagen.jpg',2,1,0,'2017-07-18 22:56:17','0000-00-00 00:00:00','0000-00-00 00:00:00',1),(52,'test 2','test 2','no-imagen.jpg','no-imagen.jpg',4,0,0,'2017-07-18 22:56:38','0000-00-00 00:00:00','0000-00-00 00:00:00',1);

/*Table structure for table `web_checklist_categoria` */

DROP TABLE IF EXISTS `web_checklist_categoria`;

CREATE TABLE `web_checklist_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `checklist_id` int(11) NOT NULL DEFAULT '0',
  `nombre_categoria` varchar(255) NOT NULL,
  `titulo_obs` varchar(10) NOT NULL DEFAULT 'OBS' COMMENT 'OBS, VENCE',
  `descripcion` longtext,
  `orden` int(11) NOT NULL DEFAULT '99',
  `usuario_id` int(11) NOT NULL,
  `agregar` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editar` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `eliminar` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `estado` int(11) NOT NULL DEFAULT '1' COMMENT '0:Eliminado, 1:Activo ',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `web_checklist_categoria` */

insert  into `web_checklist_categoria`(`id`,`checklist_id`,`nombre_categoria`,`titulo_obs`,`descripcion`,`orden`,`usuario_id`,`agregar`,`editar`,`eliminar`,`estado`) values (1,50,'Ctaegoria demo','VENCE','Desc test',1,0,'2017-07-19 00:16:35','0000-00-00 00:00:00','0000-00-00 00:00:00',1),(2,50,'Ctaegoria demo 2 edit','EDIT','desc EDIT',2,0,'2017-07-19 00:16:52','0000-00-00 00:00:00','0000-00-00 00:00:00',1),(3,50,'ASDASD','OBS','SSA',99,0,'2017-07-19 00:19:20','0000-00-00 00:00:00','2017-07-19 05:20:21',0);

/*Table structure for table `web_checklist_data` */

DROP TABLE IF EXISTS `web_checklist_data`;

CREATE TABLE `web_checklist_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `checklist_id` int(11) NOT NULL,
  `numeracion` varchar(255) NOT NULL,
  `placa_tracto` varchar(255) NOT NULL,
  `conductor` varchar(255) NOT NULL,
  `kilometraje` varchar(255) NOT NULL,
  `fecha` datetime NOT NULL,
  `placa_plat_cama` varchar(255) NOT NULL,
  `origen` varchar(255) NOT NULL,
  `destino` varchar(255) NOT NULL,
  `tipo_carga` varchar(255) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `agregar` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editar` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `eliminar` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `estado` int(11) NOT NULL DEFAULT '1' COMMENT '0:eliminado',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `web_checklist_data` */

insert  into `web_checklist_data`(`id`,`checklist_id`,`numeracion`,`placa_tracto`,`conductor`,`kilometraje`,`fecha`,`placa_plat_cama`,`origen`,`destino`,`tipo_carga`,`usuario_id`,`agregar`,`editar`,`eliminar`,`estado`) values (49,0,'','Check list 2','Una descripción sobre el checklist','no-imagen.jpg','0000-00-00 00:00:00','','','','',0,'2017-07-15 07:23:06','0000-00-00 00:00:00','2017-07-19 03:55:30',1),(50,0,'','Check list 1','Demo de checklist','no-imagen.jpg','0000-00-00 00:00:00','','','','',0,'2017-07-18 22:34:37','0000-00-00 00:00:00','0000-00-00 00:00:00',1),(51,0,'','Tets','test','no-imagen.jpg','0000-00-00 00:00:00','','','','',0,'2017-07-18 22:56:17','0000-00-00 00:00:00','0000-00-00 00:00:00',1),(52,0,'','test 2','test 2','no-imagen.jpg','0000-00-00 00:00:00','','','','',0,'2017-07-18 22:56:38','0000-00-00 00:00:00','0000-00-00 00:00:00',1);

/*Table structure for table `web_checklist_pregunta` */

DROP TABLE IF EXISTS `web_checklist_pregunta`;

CREATE TABLE `web_checklist_pregunta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `checklist_id` int(11) NOT NULL DEFAULT '0',
  `checklist_categoria_id` int(11) NOT NULL,
  `pregunta` varchar(255) NOT NULL,
  `orden` int(11) NOT NULL DEFAULT '99',
  `usuario_id` int(11) NOT NULL,
  `agregar` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editar` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `eliminar` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `estado` int(11) NOT NULL DEFAULT '1' COMMENT '0:Eliminado, 1:Activo ',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `web_checklist_pregunta` */

insert  into `web_checklist_pregunta`(`id`,`checklist_id`,`checklist_categoria_id`,`pregunta`,`orden`,`usuario_id`,`agregar`,`editar`,`eliminar`,`estado`) values (1,50,0,'Ctaegoria demo',1,0,'2017-07-19 00:16:35','0000-00-00 00:00:00','0000-00-00 00:00:00',1),(2,51,0,'Ctaegoria demo 2 edit',2,0,'2017-07-19 00:16:52','0000-00-00 00:00:00','0000-00-00 00:00:00',1),(3,50,0,'ASDASD',99,0,'2017-07-19 00:19:20','0000-00-00 00:00:00','2017-07-19 05:20:21',0),(4,50,1,'Pregunta número 01',99,0,'2017-07-19 21:29:23','0000-00-00 00:00:00','0000-00-00 00:00:00',1),(5,50,1,'Pregunta número 02',1,0,'2017-07-19 21:29:40','0000-00-00 00:00:00','0000-00-00 00:00:00',1),(6,50,1,'Pregunta número 03',2,0,'2017-07-19 21:46:02','0000-00-00 00:00:00','0000-00-00 00:00:00',1),(7,50,2,'Pregunta número 04',12,0,'2017-07-19 21:50:26','0000-00-00 00:00:00','0000-00-00 00:00:00',1);

/*Table structure for table `web_checklist_pregunta_data` */

DROP TABLE IF EXISTS `web_checklist_pregunta_data`;

CREATE TABLE `web_checklist_pregunta_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `checklist_data_id` int(11) NOT NULL,
  `checklist_pregunta_id` int(11) NOT NULL,
  `respuesta` varchar(2) DEFAULT NULL COMMENT 'SI, NO',
  `observacion` longtext,
  `agregar` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editar` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `eliminar` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `estado` int(11) NOT NULL DEFAULT '1' COMMENT '0:Eliminado, 1:Activo ',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `web_checklist_pregunta_data` */

insert  into `web_checklist_pregunta_data`(`id`,`checklist_data_id`,`checklist_pregunta_id`,`respuesta`,`observacion`,`agregar`,`editar`,`eliminar`,`estado`) values (1,0,0,'Ct',NULL,'2017-07-19 00:16:35','0000-00-00 00:00:00','0000-00-00 00:00:00',1),(2,0,0,'Ct',NULL,'2017-07-19 00:16:52','0000-00-00 00:00:00','0000-00-00 00:00:00',1),(3,0,0,'AS',NULL,'2017-07-19 00:19:20','0000-00-00 00:00:00','2017-07-19 05:20:21',0),(4,0,1,'Pr',NULL,'2017-07-19 21:29:23','0000-00-00 00:00:00','0000-00-00 00:00:00',1),(5,0,1,'Pr',NULL,'2017-07-19 21:29:40','0000-00-00 00:00:00','0000-00-00 00:00:00',1),(6,0,1,'Pr',NULL,'2017-07-19 21:46:02','0000-00-00 00:00:00','0000-00-00 00:00:00',1),(7,0,2,'Pr',NULL,'2017-07-19 21:50:26','0000-00-00 00:00:00','0000-00-00 00:00:00',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
