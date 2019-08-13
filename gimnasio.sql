# Host: localhost  (Version 5.5.5-10.1.32-MariaDB)
# Date: 2019-08-13 15:08:56
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "clientes"
#

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `persona_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

#
# Data for table "clientes"
#

INSERT INTO `clientes` VALUES (9,14),(10,15),(11,16),(12,17),(13,18),(14,19),(15,20),(16,21);

#
# Structure for table "empleados"
#

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `persona_id` int(11) NOT NULL,
  `turno_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

#
# Data for table "empleados"
#

INSERT INTO `empleados` VALUES (2,7,1),(4,9,2),(5,10,4);

#
# Structure for table "estado_nutricional"
#

CREATE TABLE `estado_nutricional` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "estado_nutricional"
#

INSERT INTO `estado_nutricional` VALUES (1,'malo');

#
# Structure for table "ficha_medica"
#

CREATE TABLE `ficha_medica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) DEFAULT NULL,
  `estado_nutricional_id` int(11) DEFAULT NULL,
  `peso` float(3,0) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `estado_nutricional_id` (`estado_nutricional_id`),
  CONSTRAINT `ficha_medica_ibfk_1` FOREIGN KEY (`estado_nutricional_id`) REFERENCES `estado_nutricional` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "ficha_medica"
#

INSERT INTO `ficha_medica` VALUES (1,9,1,50,'2018-10-26 19:06:04');

#
# Structure for table "ingresos"
#

CREATE TABLE `ingresos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empleado_id` int(11) NOT NULL,
  `turno_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

#
# Data for table "ingresos"
#

INSERT INTO `ingresos` VALUES (1,1,2,'2018-10-16 10:46:19'),(2,5,4,'2018-10-25 18:43:19'),(3,2,1,'2018-10-26 16:54:24'),(4,2,1,'2018-10-26 20:43:06'),(5,2,1,'2018-11-29 20:23:11'),(6,2,1,'2019-08-02 19:41:38');

#
# Structure for table "inscripciones"
#

CREATE TABLE `inscripciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `rutina_id` int(11) NOT NULL,
  `empleado_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

#
# Data for table "inscripciones"
#

INSERT INTO `inscripciones` VALUES (7,12,2,9,4,'2018-10-26 17:03:43'),(8,13,2,5,5,'2018-10-26 17:06:09'),(10,15,1,7,2,'2018-10-26 19:05:48'),(11,16,2,7,4,'2018-10-26 20:32:20');

#
# Structure for table "maquinas"
#

CREATE TABLE `maquinas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

#
# Data for table "maquinas"
#

INSERT INTO `maquinas` VALUES (3,'Barra Olimpica','disponible'),(4,'Bancos','deposito'),(5,'Banco Hyper Extension','disponible'),(6,'Banco Predicador','disponible'),(7,'Banco Abdominal','disponible'),(8,'Barra Fija','disponible'),(10,'Bicicleta','disponible'),(11,'Cinta','disponible'),(12,'Maquina Extension','disponible'),(13,'Maquina de Femoral','deposito'),(14,'Maquina Abductor','reparacion'),(15,'Maquina Lat Pulldown','disponible'),(16,'Maquina PEC Deck','disponible'),(17,'Poleas','disponible'),(18,'Prensas','deposito'),(19,'Prensa Pantorrilla','disponible'),(20,'Prensa Pierna','disponible'),(21,'Hack Squat','disponible'),(22,'Spinning','deposito'),(23,'Stepper','reparacion'),(24,'Simulador Remo','disponible');

#
# Structure for table "pagos"
#

CREATE TABLE `pagos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) NOT NULL,
  `empleado_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `monto` decimal(8,2) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

#
# Data for table "pagos"
#

INSERT INTO `pagos` VALUES (17,13,2,2,500.00,'2018-10-26 19:06:40'),(18,16,4,2,500.00,'2018-10-26 20:32:56'),(19,12,5,2,500.00,'2018-10-26 20:42:48'),(20,15,5,1,450.00,'2018-11-29 22:19:15'),(21,12,2,2,500.00,'2019-07-05 22:01:34'),(22,15,2,1,450.00,'2019-07-07 21:56:10'),(23,12,2,2,500.00,'2019-07-07 21:56:18'),(24,12,2,2,500.00,'2019-07-07 21:56:18'),(25,12,2,2,500.00,'2019-07-14 20:20:08'),(26,13,4,2,500.00,'2019-07-14 22:55:13'),(27,13,2,2,500.00,'2019-07-14 22:55:14'),(28,13,2,2,500.00,'2019-07-14 22:55:15'),(29,13,2,2,500.00,'2019-07-14 22:55:16'),(30,13,5,2,500.00,'2019-07-14 22:55:18');

#
# Structure for table "personas"
#

CREATE TABLE `personas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `apellido_nombre` varchar(255) NOT NULL,
  `dni` varchar(64) NOT NULL,
  `domicilio` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

#
# Data for table "personas"
#

INSERT INTO `personas` VALUES (2,'luis rodriguez','7687687','mitre 333'),(3,'luis rodriguez','567876','mitre 555'),(4,'rosa vera','8978676','maipu 6544'),(5,'maria','456745678','mitre 666'),(6,'luis rodriguez','40876234','pringles 653'),(7,'Esteban Nuñez','37652398','Napoleón 547'),(8,'Esteban Nuñez','37652398','Napoleón 547'),(9,'Liliana Rodrigues','38625397','Maipu 1396'),(10,'Matias Vergara','35976245','San Martín 776'),(14,'Rosa Paredes','45676547','mitre 665'),(15,'Martin Herrera','456788765','Napoleon 1300'),(16,'Luis Gonzalez','345678765','Pringles 764'),(17,'Laura Martinez','98765678','Yunkaa 1243'),(18,'Federico Ayala','45676587','San martin 700'),(19,'Tajan Guido','40123635','B Nueva Formosa'),(20,'Tajan Guido','40123635','Nueva Formosa'),(21,'maria','35576554','eva peron 6544');

#
# Structure for table "planes"
#

CREATE TABLE `planes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  `precio` decimal(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

#
# Data for table "planes"
#

INSERT INTO `planes` VALUES (1,'Lunes, Miércoles y Viernes',450.00),(2,'Todos los días',500.00),(3,'2 personas',400.00),(4,'Anual',4000.00);

#
# Structure for table "rutina_maquinas"
#

CREATE TABLE `rutina_maquinas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rutina_id` int(11) NOT NULL,
  `maquina_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

#
# Data for table "rutina_maquinas"
#

INSERT INTO `rutina_maquinas` VALUES (1,1,2),(2,1,1),(3,2,2),(5,11,24),(7,6,17),(14,11,23),(15,10,23),(16,11,22),(17,9,22),(18,9,21),(19,9,20),(21,7,16),(22,6,15),(23,10,14),(24,9,14),(39,8,24),(42,7,24),(43,8,16),(46,5,17),(50,11,10),(51,5,8),(52,5,3);

#
# Structure for table "rutinas"
#

CREATE TABLE `rutinas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

#
# Data for table "rutinas"
#

INSERT INTO `rutinas` VALUES (5,'Brazos'),(6,'Espalda'),(7,'Hombros'),(8,'Pecho'),(9,'Piernas'),(10,'Gluteos'),(11,'Adelgazar'),(12,'Abdominales');

#
# Structure for table "turnos"
#

CREATE TABLE `turnos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

#
# Data for table "turnos"
#

INSERT INTO `turnos` VALUES (1,'Mañana'),(2,'Tarde'),(4,'Noche');
