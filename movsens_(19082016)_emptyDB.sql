# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.1.13-MariaDB)
# Database: movsens
# Generation Time: 2016-08-19 15:38:59 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table AuthAssignment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `AuthAssignment`;

CREATE TABLE `AuthAssignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` mediumtext,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`),
  CONSTRAINT `authassignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table AuthItem
# ------------------------------------------------------------

DROP TABLE IF EXISTS `AuthItem`;

CREATE TABLE `AuthItem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` mediumtext,
  `bizrule` mediumtext,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `AuthItem` WRITE;
/*!40000 ALTER TABLE `AuthItem` DISABLE KEYS */;

INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`)
VALUES
	('create',0,'create a post',NULL,'N;'),
	('createCepa',2,'',NULL,'N;'),
	('createClientes',2,'',NULL,'N;'),
	('createEspecie',2,'',NULL,'N;'),
	('createEstacion',2,'',NULL,'N;'),
	('createGranja',2,NULL,NULL,'N;'),
	('createPersonal',2,'',NULL,'N;'),
	('createRoles',2,'',NULL,'N;'),
	('createSiembra',2,NULL,NULL,'N;'),
	('createSolicitudes',2,'',NULL,'N;'),
	('createUsuarios',2,'',NULL,'N;'),
	('createViajes',2,'',NULL,'N;'),
	('delete',0,'delete a post',NULL,'N;'),
	('deleteCepa',2,'',NULL,'N;'),
	('deleteClientes',2,'',NULL,'N;'),
	('deleteEspecie',2,'',NULL,'N;'),
	('deleteEstacion',2,'',NULL,'N;'),
	('deleteGranja',2,NULL,NULL,'N;'),
	('deletePersonal',2,'',NULL,'N;'),
	('deleteRoles',2,'',NULL,'N;'),
	('deleteSiembra',2,NULL,NULL,'N;'),
	('deleteSolicitudes',2,'',NULL,'N;'),
	('deleteUsuarios',2,'',NULL,'N;'),
	('deleteViajes',2,'',NULL,'N;'),
	('read',0,'read a post',NULL,'N;'),
	('readCepa',2,'',NULL,'N;'),
	('readClientes',2,'',NULL,'N;'),
	('readEspecie',2,'',NULL,'N;'),
	('readEstacion',2,'',NULL,'N;'),
	('readGranja',2,NULL,NULL,'N;'),
	('readPersonal',2,'',NULL,'N;'),
	('readRoles',2,'',NULL,'N;'),
	('readSiembra',2,NULL,NULL,'N;'),
	('readSolicitudes',2,'',NULL,'N;'),
	('readUsuarios',2,'',NULL,'N;'),
	('readViajes',2,'',NULL,'N;'),
	('update',0,'update a post',NULL,'N;'),
	('updateCepa',2,'',NULL,'N;'),
	('updateClientes',2,'',NULL,'N;'),
	('updateEspecie',2,'',NULL,'N;'),
	('updateEstacion',2,'',NULL,'N;'),
	('updateGranja',2,NULL,NULL,'N;'),
	('updatePersonal',2,'',NULL,'N;'),
	('updateRoles',2,'',NULL,'N;'),
	('updateSiembra',2,NULL,NULL,'N;'),
	('updateSolicitudes',2,'',NULL,'N;'),
	('updateUsuarios',2,'',NULL,'N;'),
	('updateViajes',2,'',NULL,'N;');

/*!40000 ALTER TABLE `AuthItem` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table AuthItemChild
# ------------------------------------------------------------

DROP TABLE IF EXISTS `AuthItemChild`;

CREATE TABLE `AuthItemChild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `authitemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `authitem` (`name`) ON DELETE CASCADE,
  CONSTRAINT `authitemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `authitem` (`name`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `AuthItemChild` WRITE;
/*!40000 ALTER TABLE `AuthItemChild` DISABLE KEYS */;

INSERT INTO `AuthItemChild` (`parent`, `child`)
VALUES
	('createCepa','create'),
	('createClientes','create'),
	('createEspecie','create'),
	('createEstacion','create'),
	('createGranja','create'),
	('createPersonal','create'),
	('createRoles','create'),
	('createSiembra','create'),
	('createSolicitudes','create'),
	('createUsuarios','create'),
	('createViajes','create'),
	('deleteCepa','delete'),
	('deleteClientes','delete'),
	('deleteEspecie','delete'),
	('deleteEstacion','delete'),
	('deleteGranja','delete'),
	('deletePersonal','delete'),
	('deleteRoles','delete'),
	('deleteSiembra','delete'),
	('deleteSolicitudes','delete'),
	('deleteUsuarios','delete'),
	('deleteViajes','delete'),
	('readCepa','read'),
	('readClientes','read'),
	('readEspecie','read'),
	('readEstacion','read'),
	('readGranja','read'),
	('readPersonal','read'),
	('readRoles','read'),
	('readSiembra','read'),
	('readSolicitudes','read'),
	('readUsuarios','read'),
	('readViajes','read'),
	('updateCepa','update'),
	('updateClientes','update'),
	('updateEspecie','update'),
	('updateEstacion','update'),
	('updateGranja','update'),
	('updatePersonal','update'),
	('updateRoles','update'),
	('updateSiembra','update'),
	('updateSolicitudes','update'),
	('updateUsuarios','update'),
	('updateViajes','update');

/*!40000 ALTER TABLE `AuthItemChild` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table camp_sensado
# ------------------------------------------------------------

DROP TABLE IF EXISTS `camp_sensado`;

CREATE TABLE `camp_sensado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_responsable` int(11) NOT NULL,
  `id_estacion` int(11) NOT NULL,
  `nombre_camp` varchar(45) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1 = En proceso , 2 = Finalizado',
  `activo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_camp_sensado_personal1_idx` (`id_responsable`),
  KEY `fk_camp_sensado_estacion1_idx` (`id_estacion`),
  CONSTRAINT `fk_camp_sensado_estacion1` FOREIGN KEY (`id_estacion`) REFERENCES `estacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_camp_sensado_personal1` FOREIGN KEY (`id_responsable`) REFERENCES `personal` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table camp_tanque
# ------------------------------------------------------------

DROP TABLE IF EXISTS `camp_tanque`;

CREATE TABLE `camp_tanque` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tanque` int(11) NOT NULL,
  `id_camp_sensado` int(11) NOT NULL,
  `id_cepa` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL COMMENT 'cantidad de cepas a contar',
  PRIMARY KEY (`id`),
  KEY `fk_camp_tanque_tanque1_idx` (`id_tanque`),
  KEY `fk_camp_tanque_camp_sensado1_idx` (`id_camp_sensado`),
  KEY `fk_camp_tanque_cepa1_idx` (`id_cepa`),
  CONSTRAINT `fk_camp_tanque_camp_sensado1` FOREIGN KEY (`id_camp_sensado`) REFERENCES `camp_sensado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_camp_tanque_cepa1` FOREIGN KEY (`id_cepa`) REFERENCES `cepa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_camp_tanque_tanque1` FOREIGN KEY (`id_tanque`) REFERENCES `tanque` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table cepa
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cepa`;

CREATE TABLE `cepa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_especie` int(11) NOT NULL,
  `nombre_cepa` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `temp_min` float(5,2) NOT NULL DEFAULT '0.00',
  `temp_max` float(5,2) NOT NULL DEFAULT '0.00',
  `ph_min` float(5,2) NOT NULL DEFAULT '0.00',
  `ph_max` float(5,2) NOT NULL DEFAULT '0.00',
  `ox_min` float(5,2) NOT NULL DEFAULT '0.00',
  `ox_max` float(5,2) NOT NULL DEFAULT '0.00',
  `cond_min` float(5,2) NOT NULL DEFAULT '0.00',
  `cond_max` float(5,2) NOT NULL DEFAULT '0.00',
  `orp_min` float(5,2) NOT NULL,
  `orp_max` float(5,2) NOT NULL,
  `activo` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_especie` (`id_especie`),
  KEY `id_especie_2` (`id_especie`),
  CONSTRAINT `cepa_ibfk_1` FOREIGN KEY (`id_especie`) REFERENCES `especie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table clientes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_empresa` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_contacto` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `apellido_contacto` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `correo` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `rfc` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `tel` varchar(14) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `ext` varchar(4) NOT NULL,
  `activo` int(1) NOT NULL DEFAULT '1',
  `cel` varchar(17) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table clientes_domicilio
# ------------------------------------------------------------

DROP TABLE IF EXISTS `clientes_domicilio`;

CREATE TABLE `clientes_domicilio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `domicilio` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `ubicacion_mapa` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_cliente_2` (`id_cliente`),
  CONSTRAINT `clientes_domicilio_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;



# Dump of table escalon_viaje_ubicacion
# ------------------------------------------------------------

DROP TABLE IF EXISTS `escalon_viaje_ubicacion`;

CREATE TABLE `escalon_viaje_ubicacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_viaje` int(11) NOT NULL,
  `ubicacion` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_viaje` (`id_viaje`),
  CONSTRAINT `escalon_viaje_ubicacion_ibfk_2` FOREIGN KEY (`id_viaje`) REFERENCES `viajes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table especie
# ------------------------------------------------------------

DROP TABLE IF EXISTS `especie`;

CREATE TABLE `especie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `activo` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table estacion
# ------------------------------------------------------------

DROP TABLE IF EXISTS `estacion`;

CREATE TABLE `estacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_granja` int(11) DEFAULT NULL,
  `tipo` tinyint(1) NOT NULL,
  `identificador` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `no_personal` int(2) DEFAULT NULL,
  `marca` text COLLATE utf8_spanish2_ci NOT NULL,
  `color` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `ubicacion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `disponible` tinyint(1) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;



# Dump of table granjas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `granjas`;

CREATE TABLE `granjas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `responsable` varchar(100) NOT NULL,
  `activo` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table pedidos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pedidos`;

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_solicitud` int(11) NOT NULL,
  `id_especie` int(11) NOT NULL,
  `id_cepa` int(11) NOT NULL,
  `id_direccion` int(11) NOT NULL,
  `tanques` int(1) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table personal
# ------------------------------------------------------------

DROP TABLE IF EXISTS `personal`;

CREATE TABLE `personal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `apellido` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `tel` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `rfc` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `domicilio` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `id_rol` int(11) NOT NULL,
  `correo` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `puesto` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `activo` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_rol` (`id_rol`),
  CONSTRAINT `personal_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table registro
# ------------------------------------------------------------

DROP TABLE IF EXISTS `registro`;

CREATE TABLE `registro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tanque` int(11) NOT NULL,
  `id_viaje` int(11) NOT NULL,
  `id_estacion` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `temp` float(5,2) NOT NULL,
  `ph` float(5,2) NOT NULL,
  `ox` float(5,2) NOT NULL,
  `cond` float(5,2) NOT NULL,
  `orp` float(5,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tanque` (`id_tanque`),
  KEY `id_viaje` (`id_viaje`),
  KEY `id_estacion` (`id_estacion`),
  CONSTRAINT `registro_ibfk_1` FOREIGN KEY (`id_tanque`) REFERENCES `tanque` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;



# Dump of table registro_camp
# ------------------------------------------------------------

DROP TABLE IF EXISTS `registro_camp`;

CREATE TABLE `registro_camp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tanque` int(11) NOT NULL,
  `id_camp_sensado` int(11) NOT NULL,
  `id_estacion` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `temp` float(5,2) NOT NULL,
  `ph` float(5,2) NOT NULL,
  `ox` float(5,2) NOT NULL,
  `cond` float(5,2) NOT NULL,
  `orp` float(5,2) NOT NULL,
  `ct` int(11) NOT NULL,
  `alerta` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tanque` (`id_tanque`),
  KEY `fk_registro_camp_estacion1_idx` (`id_estacion`),
  KEY `fk_registro_camp_camp_sensado1_idx` (`id_camp_sensado`),
  CONSTRAINT `fk_registro_camp_camp_sensado1` FOREIGN KEY (`id_camp_sensado`) REFERENCES `camp_sensado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_registro_camp_estacion1` FOREIGN KEY (`id_estacion`) REFERENCES `estacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `registro_ibfk_10` FOREIGN KEY (`id_tanque`) REFERENCES `tanque` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;



# Dump of table roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table roles_permisos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles_permisos`;

CREATE TABLE `roles_permisos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_rol` int(11) NOT NULL,
  `seccion` int(11) NOT NULL,
  `alta` tinyint(1) NOT NULL,
  `baja` tinyint(1) NOT NULL,
  `consulta` tinyint(1) NOT NULL,
  `edicion` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_rol` (`id_rol`),
  CONSTRAINT `roles_permisos_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table solicitud_tanques
# ------------------------------------------------------------

DROP TABLE IF EXISTS `solicitud_tanques`;

CREATE TABLE `solicitud_tanques` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_solicitud` int(11) NOT NULL,
  `id_tanque` int(11) NOT NULL,
  `id_domicilio` int(11) NOT NULL,
  `id_cepas` int(11) NOT NULL,
  `cantidad_cepas` int(8) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_solicitud` (`id_solicitud`),
  KEY `id_tanque` (`id_tanque`),
  KEY `id_domicilio` (`id_domicilio`),
  KEY `id_cepas` (`id_cepas`),
  CONSTRAINT `solicitud_tanques_ibfk_1` FOREIGN KEY (`id_solicitud`) REFERENCES `solicitudes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `solicitud_tanques_ibfk_2` FOREIGN KEY (`id_tanque`) REFERENCES `tanque` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `solicitud_tanques_ibfk_3` FOREIGN KEY (`id_domicilio`) REFERENCES `clientes_domicilio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `solicitud_tanques_ibfk_4` FOREIGN KEY (`id_cepas`) REFERENCES `cepa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;



# Dump of table solicitudes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `solicitudes`;

CREATE TABLE `solicitudes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_clientes` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `fecha_alta` date DEFAULT NULL,
  `hora_alta` time DEFAULT NULL,
  `fecha_estimada` date DEFAULT NULL,
  `hora_estimada` time DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `hora_entrega` time DEFAULT NULL,
  `notas` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_clientes` (`id_clientes`),
  CONSTRAINT `solicitudes_ibfk_1` FOREIGN KEY (`id_clientes`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table solicitudes_viaje
# ------------------------------------------------------------

DROP TABLE IF EXISTS `solicitudes_viaje`;

CREATE TABLE `solicitudes_viaje` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_personal` int(11) NOT NULL,
  `id_viaje` int(11) NOT NULL,
  `id_solicitud` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_personal` (`id_personal`),
  KEY `id_viaje` (`id_viaje`),
  KEY `id_solicitud` (`id_solicitud`),
  CONSTRAINT `solicitudes_viaje_ibfk_2` FOREIGN KEY (`id_viaje`) REFERENCES `viajes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `solicitudes_viaje_ibfk_3` FOREIGN KEY (`id_solicitud`) REFERENCES `solicitudes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table tanque
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tanque`;

CREATE TABLE `tanque` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_estacion` int(11) NOT NULL,
  `capacidad` int(11) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_estacion` (`id_estacion`),
  CONSTRAINT `tanque_ibfk_1` FOREIGN KEY (`id_estacion`) REFERENCES `estacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table uploadtemp
# ------------------------------------------------------------

DROP TABLE IF EXISTS `uploadtemp`;

CREATE TABLE `uploadtemp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tanque` int(11) NOT NULL,
  `id_escalon_viaje_ubicacion` int(11) NOT NULL,
  `ct` int(2) NOT NULL DEFAULT '0',
  `ox` float NOT NULL DEFAULT '0',
  `ph` float NOT NULL DEFAULT '0',
  `temp` float NOT NULL DEFAULT '0',
  `cond` float NOT NULL DEFAULT '0',
  `orp` float NOT NULL DEFAULT '0',
  `alerta` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_tanque` (`id_tanque`),
  KEY `id_escalon_viaje_ubicacion` (`id_escalon_viaje_ubicacion`),
  CONSTRAINT `uploadtemp_ibfk_1` FOREIGN KEY (`id_tanque`) REFERENCES `tanque` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `uploadtemp_ibfk_2` FOREIGN KEY (`id_escalon_viaje_ubicacion`) REFERENCES `escalon_viaje_ubicacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table usuarios
# ------------------------------------------------------------

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `pwd` varchar(35) NOT NULL,
  `tipo_usr` tinyint(1) NOT NULL,
  `id_usr` int(11) NOT NULL,
  `activo` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_usr` (`id_usr`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table viajes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `viajes`;

CREATE TABLE `viajes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_solicitudes` int(11) NOT NULL,
  `id_responsable` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `fecha_salida` date DEFAULT NULL,
  `hora_salida` time NOT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `hora_entrega` time DEFAULT NULL,
  `id_estacion` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_clientes` (`id_solicitudes`),
  KEY `id_responsable` (`id_responsable`),
  KEY `id_estacion` (`id_estacion`),
  CONSTRAINT `viajes_ibfk_1` FOREIGN KEY (`id_solicitudes`) REFERENCES `solicitudes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `viajes_ibfk_2` FOREIGN KEY (`id_responsable`) REFERENCES `personal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
