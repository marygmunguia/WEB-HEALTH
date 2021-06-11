-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         5.7.24 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para proyectocitasmedicas
CREATE DATABASE IF NOT EXISTS `proyectocitasmedicas` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci */;
USE `proyectocitasmedicas`;

-- Volcando estructura para tabla proyectocitasmedicas.administrador
CREATE TABLE IF NOT EXISTS `administrador` (
  `ID_ADMINISTRADOR` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CODIGO DEL ADMINISTRADOR',
  `CODIGO_PERSONA` int(11) NOT NULL COMMENT 'CODIGO DE LOS DATOS PERSONALES',
  `ID_USUARIO` int(11) NOT NULL COMMENT 'CODIGO DE LOS DATOS DE ACCESO',
  PRIMARY KEY (`ID_ADMINISTRADOR`),
  KEY `FK_ADMIN_USUARIO` (`ID_USUARIO`),
  KEY `FK_CODIGO_PERSONA` (`CODIGO_PERSONA`) USING BTREE,
  CONSTRAINT `FK_ADMIN_USUARIO` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuarios` (`ID_USUARIO`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_PERSONA_ADMIN` FOREIGN KEY (`CODIGO_PERSONA`) REFERENCES `persona` (`CODIGO_PERSONA`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla proyectocitasmedicas.administrador: ~11 rows (aproximadamente)
/*!40000 ALTER TABLE `administrador` DISABLE KEYS */;
INSERT IGNORE INTO `administrador` (`ID_ADMINISTRADOR`, `CODIGO_PERSONA`, `ID_USUARIO`) VALUES
	(1, 1, 1),
	(2, 2, 2),
	(3, 4, 4),
	(4, 14, 5),
	(5, 15, 6),
	(8, 18, 9),
	(11, 22, 12),
	(12, 23, 13),
	(13, 45, 34),
	(14, 49, 35),
	(15, 52, 36),
	(16, 59, 43),
	(17, 60, 44);
/*!40000 ALTER TABLE `administrador` ENABLE KEYS */;

-- Volcando estructura para vista proyectocitasmedicas.citas_pendientes
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `citas_pendientes` (
	`ID_CITA_MEDICA` INT(11) NOT NULL COMMENT 'CODIGO UNICO DE LA CITA',
	`ID_CLIENTE` INT(11) NOT NULL COMMENT 'ID DEL CLIENTE',
	`ID_MEDICO` INT(11) NOT NULL COMMENT 'ID DEL MEDICO',
	`ID_ESPECIALIDAD` INT(11) NOT NULL COMMENT 'ID DE LA ESPECIALIDAD',
	`FECHA_CITA` DATE NOT NULL COMMENT 'FECHA DE LA CITA',
	`HORA_INICIO` TIME NOT NULL COMMENT 'HORA DE INICIO',
	`ID_ESTADO_CITA` INT(11) NOT NULL COMMENT 'ID DEL ESTADO DE LA CITA'
) ENGINE=MyISAM;

-- Volcando estructura para vista proyectocitasmedicas.cita_diagnostico
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `cita_diagnostico` (
	`ID_CITA_MEDICA` INT(11) NOT NULL COMMENT 'CODIGO UNICO DE LA CITA',
	`ID_CLIENTE` INT(11) NOT NULL COMMENT 'ID DEL CLIENTE',
	`NUM_EXPEDIENTE` INT(11) NOT NULL,
	`NOMBRE` VARCHAR(75) NOT NULL COMMENT 'PRIMER Y SEGUNDO NOMBRE DE LA PERSONA' COLLATE 'utf8_spanish2_ci',
	`APELLIDO` VARCHAR(75) NOT NULL COMMENT 'PRIMER Y SEGUNDO APELLIDO DE LA PERSONA' COLLATE 'utf8_spanish2_ci',
	`ID_MEDICO` INT(11) NOT NULL COMMENT 'ID DEL MEDICO',
	`ID_ESPECIALIDAD` INT(11) NOT NULL COMMENT 'ID DE LA ESPECIALIDAD',
	`FECHA_CITA` DATE NOT NULL COMMENT 'FECHA DE LA CITA',
	`HORA_INICIO` TIME NOT NULL COMMENT 'HORA DE INICIO',
	`ALTURA` VARCHAR(50) NULL COMMENT 'ALTURA DEL PACIENTE EN LA CITA' COLLATE 'utf8_spanish2_ci',
	`PESO` VARCHAR(50) NULL COMMENT 'PESO DEL PACIENTE EN LA CITA' COLLATE 'utf8_spanish2_ci',
	`TEMPERATURA` VARCHAR(50) NULL COMMENT 'TEMPERATURA DEL PACIENTE EN LA CITA' COLLATE 'utf8_spanish2_ci',
	`DIAGNOSTICO_MEDICO` VARCHAR(255) NULL COMMENT 'DIAGNOSTICO DEL MEDICO' COLLATE 'utf8_spanish2_ci',
	`RECETA_MEDICA` VARCHAR(255) NULL COMMENT 'RECETA PARA EL CLIENTE' COLLATE 'utf8_spanish2_ci'
) ENGINE=MyISAM;

-- Volcando estructura para tabla proyectocitasmedicas.cita_medica
CREATE TABLE IF NOT EXISTS `cita_medica` (
  `ID_CITA_MEDICA` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CODIGO UNICO DE LA CITA',
  `ID_CLIENTE` int(11) NOT NULL COMMENT 'ID DEL CLIENTE',
  `ID_MEDICO` int(11) NOT NULL COMMENT 'ID DEL MEDICO',
  `ID_ESPECIALIDAD` int(11) NOT NULL COMMENT 'ID DE LA ESPECIALIDAD',
  `FECHA_CITA` date NOT NULL COMMENT 'FECHA DE LA CITA',
  `HORA_INICIO` time NOT NULL COMMENT 'HORA DE INICIO',
  `ID_ESTADO_CITA` int(11) NOT NULL COMMENT 'ID DEL ESTADO DE LA CITA',
  PRIMARY KEY (`ID_CITA_MEDICA`),
  KEY `FK_CITA_CLIENTE` (`ID_CLIENTE`),
  KEY `FK_CITA_MEDICO` (`ID_MEDICO`),
  KEY `FK_CITA_ESPECIALIDAD` (`ID_ESPECIALIDAD`),
  KEY `FK_CITA_ESTADO` (`ID_ESTADO_CITA`),
  CONSTRAINT `FK_CITA_CLIENTE` FOREIGN KEY (`ID_CLIENTE`) REFERENCES `cliente` (`ID_CLIENTE`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_CITA_ESPECIALIDAD` FOREIGN KEY (`ID_ESPECIALIDAD`) REFERENCES `especialidad` (`ID_ESPECIALIDAD`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_CITA_ESTADO` FOREIGN KEY (`ID_ESTADO_CITA`) REFERENCES `estado_cita` (`ID_ESTADO_CITA`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_CITA_MEDICO` FOREIGN KEY (`ID_MEDICO`) REFERENCES `medico` (`ID_MEDICO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla proyectocitasmedicas.cita_medica: ~31 rows (aproximadamente)
/*!40000 ALTER TABLE `cita_medica` DISABLE KEYS */;
INSERT IGNORE INTO `cita_medica` (`ID_CITA_MEDICA`, `ID_CLIENTE`, `ID_MEDICO`, `ID_ESPECIALIDAD`, `FECHA_CITA`, `HORA_INICIO`, `ID_ESTADO_CITA`) VALUES
	(1, 10, 1, 1, '2021-04-22', '08:00:00', 2),
	(2, 19, 1, 1, '2021-04-25', '08:00:00', 2),
	(3, 10, 2, 7, '2021-04-29', '08:00:00', 1),
	(4, 10, 2, 7, '2021-04-29', '11:00:00', 4),
	(5, 10, 2, 7, '2021-04-22', '11:00:00', 2),
	(6, 10, 2, 7, '2021-07-29', '11:00:00', 1),
	(7, 10, 2, 7, '2021-04-26', '11:00:00', 4),
	(8, 8, 2, 7, '2021-04-25', '10:00:00', 1),
	(9, 10, 3, 13, '2021-04-28', '13:30:00', 4),
	(10, 10, 2, 7, '2021-04-25', '19:30:00', 4),
	(11, 10, 4, 16, '2021-04-28', '19:25:00', 2),
	(12, 10, 5, 18, '2021-04-28', '14:00:00', 4),
	(13, 10, 2, 7, '2021-04-26', '12:00:00', 2),
	(14, 10, 6, 17, '2021-04-26', '13:15:00', 2),
	(15, 10, 3, 13, '2021-04-26', '13:30:00', 4),
	(16, 10, 3, 13, '2021-04-30', '16:00:00', 1),
	(17, 20, 6, 17, '2021-04-27', '15:30:00', 1),
	(18, 20, 2, 7, '2021-04-27', '12:30:00', 1),
	(19, 20, 6, 17, '2021-04-26', '14:45:00', 2),
	(23, 10, 1, 1, '2021-04-30', '08:30:00', 1),
	(25, 10, 1, 1, '2021-06-05', '10:45:00', 1),
	(26, 10, 1, 1, '2021-04-27', '09:15:00', 1),
	(27, 10, 4, 16, '2021-06-16', '17:05:00', 1),
	(28, 10, 6, 17, '2021-04-29', '14:00:00', 1),
	(29, 10, 6, 17, '2021-04-27', '13:15:00', 1),
	(30, 20, 5, 18, '2021-04-28', '14:00:00', 4),
	(31, 20, 4, 16, '2021-04-27', '19:25:00', 1),
	(32, 20, 6, 17, '2021-05-08', '12:30:00', 1),
	(33, 10, 6, 17, '2021-04-30', '12:30:00', 1),
	(34, 20, 3, 13, '2021-04-28', '08:00:00', 1),
	(35, 20, 3, 13, '2021-04-28', '12:00:00', 1),
	(36, 20, 3, 13, '2021-04-28', '14:00:00', 1);
/*!40000 ALTER TABLE `cita_medica` ENABLE KEYS */;

-- Volcando estructura para tabla proyectocitasmedicas.cliente
CREATE TABLE IF NOT EXISTS `cliente` (
  `ID_CLIENTE` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CODIGO DEL CLIENTE',
  `CODIGO_PERSONA` int(11) NOT NULL COMMENT 'CODIGO DE LOS DATOS PERSONALES',
  `ID_USUARIO` int(11) NOT NULL COMMENT 'CODIGO DE LOS DATOS DE ACCESO',
  PRIMARY KEY (`ID_CLIENTE`),
  KEY `FK_CLIENTE_USUARIO` (`ID_USUARIO`),
  KEY `FK_CODIGO_PERSONA` (`CODIGO_PERSONA`) USING BTREE,
  CONSTRAINT `FK_CLIENTE_USUARIO` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuarios` (`ID_USUARIO`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_PERSONA_CLIENTE` FOREIGN KEY (`CODIGO_PERSONA`) REFERENCES `persona` (`CODIGO_PERSONA`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla proyectocitasmedicas.cliente: ~18 rows (aproximadamente)
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT IGNORE INTO `cliente` (`ID_CLIENTE`, `CODIGO_PERSONA`, `ID_USUARIO`) VALUES
	(1, 24, 14),
	(3, 29, 18),
	(4, 30, 19),
	(5, 31, 20),
	(6, 32, 21),
	(7, 33, 22),
	(8, 34, 23),
	(9, 35, 24),
	(10, 36, 25),
	(11, 37, 26),
	(12, 38, 27),
	(13, 39, 28),
	(14, 40, 29),
	(15, 41, 30),
	(16, 42, 31),
	(17, 43, 32),
	(18, 53, 37),
	(19, 54, 38),
	(20, 58, 42);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;

-- Volcando estructura para vista proyectocitasmedicas.consultar_citas
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `consultar_citas` (
	`ID_ESPECIALIDAD` INT(11) NOT NULL COMMENT 'CODIGO UNICO DE LA ESPECIALIDAD',
	`NOMBRE_ESPECIALIDAD` VARCHAR(45) NOT NULL COMMENT 'NOMBRE DE LA ESPECIALIDAD' COLLATE 'utf8_spanish2_ci',
	`ID_MEDICO` INT(11) NOT NULL COMMENT 'CODIGO UNICO DEL MEDICO',
	`NOMBRE` VARCHAR(75) NOT NULL COMMENT 'PRIMER Y SEGUNDO NOMBRE DE LA PERSONA' COLLATE 'utf8_spanish2_ci',
	`APELLIDO` VARCHAR(75) NOT NULL COMMENT 'PRIMER Y SEGUNDO APELLIDO DE LA PERSONA' COLLATE 'utf8_spanish2_ci',
	`ID_SALA_MEDICA` INT(11) NOT NULL COMMENT 'CODIGO UNICO DE LA SALA MEDICA',
	`NUMERO` INT(11) NOT NULL COMMENT 'NUMERO DE LA SALA MEDICA',
	`EDIFICIO` VARCHAR(25) NULL COMMENT 'NUMERO O NOMBRE DEL EDIFICIO' COLLATE 'utf8_spanish2_ci',
	`DETALLE_UBICACION` VARCHAR(255) NULL COMMENT 'DESCRIPCION DETALLADA DE LA UBICACION' COLLATE 'utf8_spanish2_ci'
) ENGINE=MyISAM;

-- Volcando estructura para vista proyectocitasmedicas.consultar_enfermedad
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `consultar_enfermedad` (
	`NUM_EXPEDIENTE` INT(11) NOT NULL COMMENT 'NUMERO DEL EXPEDIENTE',
	`NOMBRE_ENFERMEDAD_BASE` VARCHAR(50) NOT NULL COMMENT 'NOMBRE DEL LA ENFERMEDAD' COLLATE 'utf8_spanish2_ci'
) ENGINE=MyISAM;

-- Volcando estructura para vista proyectocitasmedicas.consulta_especialidad_cita
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `consulta_especialidad_cita` (
	`ID_ESPECIALIDAD` INT(11) NOT NULL COMMENT 'CODIGO UNICO DE LA ESPECIALIDAD',
	`NOMBRE_ESPECIALIDAD` VARCHAR(45) NOT NULL COMMENT 'NOMBRE DE LA ESPECIALIDAD' COLLATE 'utf8_spanish2_ci'
) ENGINE=MyISAM;

-- Volcando estructura para vista proyectocitasmedicas.consulta_perfil
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `consulta_perfil` (
	`CODIGO_PERSONA` INT(11) NOT NULL COMMENT 'CODIGO UNICO DE LOS DATOS PERSONALES',
	`NOMBRE` VARCHAR(75) NOT NULL COMMENT 'PRIMER Y SEGUNDO NOMBRE DE LA PERSONA' COLLATE 'utf8_spanish2_ci',
	`APELLIDO` VARCHAR(75) NOT NULL COMMENT 'PRIMER Y SEGUNDO APELLIDO DE LA PERSONA' COLLATE 'utf8_spanish2_ci',
	`TIPO_DOCUMENTO` INT(11) NULL COMMENT 'CODIGO DEL TIPO DE DOCUMENTO',
	`NO_DOCUMENTO` VARCHAR(25) NULL COMMENT 'NUMERO DEL DOCUMENTO' COLLATE 'utf8_spanish2_ci',
	`PAIS` INT(11) NULL COMMENT 'CODIGO DEL PAIS AL QUE PERTENECE',
	`FECHA_NACIMIENTO` DATE NULL COMMENT 'FECHA DE NACIMIENTO DE LA PERSONA',
	`SEXO` VARCHAR(1) NULL COMMENT 'SEXO DE LA PERSONA' COLLATE 'utf8_spanish2_ci',
	`DOMICILIO` VARCHAR(255) NULL COMMENT 'DOMICILIO COMPLETO DE LA PERSONA' COLLATE 'utf8_spanish2_ci',
	`TELEFONO` VARCHAR(15) NULL COMMENT 'NUMERO DE TELEFONO FIJO (CASA)' COLLATE 'utf8_spanish2_ci',
	`CELULAR` VARCHAR(15) NULL COMMENT 'NUMERO DE TELEFONO MOVIL (CELULAR)' COLLATE 'utf8_spanish2_ci',
	`EMAIL` VARCHAR(50) NULL COMMENT 'CORREO ELECTRONICO ACTIVO' COLLATE 'utf8_spanish2_ci',
	`TIPO_SANGRE` INT(11) NULL COMMENT 'CODIGO DEL TIPO DE SANGRE DE LA PERSONA',
	`ID_USUARIO` INT(11) NOT NULL COMMENT 'NUMERO UNICO DE IDENTIFICACION DE USUARIO',
	`NOMBRE_USUARIO` VARCHAR(45) NULL COMMENT 'NOMBRE DE USUARIO UNICO' COLLATE 'utf8_spanish2_ci',
	`CLAVE_ACCESO` VARCHAR(100) NOT NULL COMMENT 'CLAVE PARA ACCEDER AL SISTEMA' COLLATE 'utf8_spanish2_ci',
	`ESTADO` INT(1) NOT NULL COMMENT 'ESTADO ACTUAL DEL USUARIO',
	`ID_ROL` INT(11) NOT NULL COMMENT 'ID DEL ROL EN EL SISTEMA',
	`FECHA_REGISTRO` DATE NOT NULL COMMENT 'FECHA DE REGISTRO',
	`IMG_PERFIL` VARCHAR(100) NULL COMMENT 'IAMGEN DEL PERFIL DEL USUARIO' COLLATE 'utf8_spanish2_ci'
) ENGINE=MyISAM;

-- Volcando estructura para tabla proyectocitasmedicas.detalle_consulta
CREATE TABLE IF NOT EXISTS `detalle_consulta` (
  `ID_DETALLE_CONSULTA` int(11) NOT NULL AUTO_INCREMENT COMMENT 'IDENTIFICADOR DEL DETALLE DE LA CONSULTA',
  `ID_CITA_MEDICA` int(11) NOT NULL COMMENT 'CODIGO DE LA CITA MEDICA',
  `SINTOMAS_EXPECIFICOS` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL COMMENT 'SINTOMAS EXPECIFICOS DEL PACIENTE',
  `ALTURA` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL COMMENT 'ALTURA DEL PACIENTE EN LA CITA',
  `PESO` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL COMMENT 'PESO DEL PACIENTE EN LA CITA',
  `TEMPERATURA` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL COMMENT 'TEMPERATURA DEL PACIENTE EN LA CITA',
  `DIAGNOSTICO_MEDICO` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL COMMENT 'DIAGNOSTICO DEL MEDICO',
  `RECETA_MEDICA` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL COMMENT 'RECETA PARA EL CLIENTE',
  PRIMARY KEY (`ID_DETALLE_CONSULTA`),
  KEY `FK_CITA_CONSULTA` (`ID_CITA_MEDICA`),
  CONSTRAINT `FK_CITA_CONSULTA` FOREIGN KEY (`ID_CITA_MEDICA`) REFERENCES `cita_medica` (`ID_CITA_MEDICA`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla proyectocitasmedicas.detalle_consulta: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `detalle_consulta` DISABLE KEYS */;
INSERT IGNORE INTO `detalle_consulta` (`ID_DETALLE_CONSULTA`, `ID_CITA_MEDICA`, `SINTOMAS_EXPECIFICOS`, `ALTURA`, `PESO`, `TEMPERATURA`, `DIAGNOSTICO_MEDICO`, `RECETA_MEDICA`) VALUES
	(4, 7, 'VOMITO.', '1,6', '120', '39', 'GRIPE ESTACIONARIA', 'ACETAMINOFEN EN TABLETAS, 1 TABLETA CADA 6 HORAS'),
	(5, 13, 'VOMITO, CONGESTION NASAL', '1,76', '126', '39', 'GRIPE ESTACIONAL', 'JARABE K0O2, 1 CUCHARADITA CADA 7 HORAS'),
	(6, 14, '...', '1,7', '145', '38', 'NINGUNO', 'NINGUNA'),
	(7, 19, 'VOMITO, CONGESTIÓN NASAL', '1,6', '140', '36', 'GRIPE ESTACIONARIA AGURA', '3 TABLETAS RT5 CADA DÍA, UNA ANTES DE CADA COMIDA.');
/*!40000 ALTER TABLE `detalle_consulta` ENABLE KEYS */;

-- Volcando estructura para tabla proyectocitasmedicas.enfermedades_base
CREATE TABLE IF NOT EXISTS `enfermedades_base` (
  `CODIGO_ENFERMEDAD_BASE` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CODIGO UNICO PARA CADA UNA DE LAS ENFERMEDAD_BASE',
  `NOMBRE_ENFERMEDAD_BASE` varchar(50) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'NOMBRE DEL LA ENFERMEDAD',
  `OBS` varchar(255) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'OBSERVACIONES',
  PRIMARY KEY (`CODIGO_ENFERMEDAD_BASE`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla proyectocitasmedicas.enfermedades_base: ~11 rows (aproximadamente)
/*!40000 ALTER TABLE `enfermedades_base` DISABLE KEYS */;
INSERT IGNORE INTO `enfermedades_base` (`CODIGO_ENFERMEDAD_BASE`, `NOMBRE_ENFERMEDAD_BASE`, `OBS`) VALUES
	(2, 'DIABETES', 'La diabetes es una enfermedad que se caracteriza por niveles elevados de azúcar en la sangre.'),
	(3, 'ANEMIA', ' '),
	(4, 'CANCER', ' '),
	(5, 'ASMA', ' '),
	(6, 'MAL DE ALZHEIMER', ''),
	(7, 'ARTRITIS', ''),
	(8, 'VIH/SIDA', ''),
	(9, 'EPILEPSIA', ''),
	(10, 'XP', ' '),
	(11, 'ENFERMEDAD DE CROHN', ''),
	(12, 'BIPOLARIDAD', ''),
	(13, 'DEPRESIÓN', '');
/*!40000 ALTER TABLE `enfermedades_base` ENABLE KEYS */;

-- Volcando estructura para tabla proyectocitasmedicas.enfermedad_paciente
CREATE TABLE IF NOT EXISTS `enfermedad_paciente` (
  `CODIGO` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CODIGO UNICO DEL REGISTRO',
  `NUM_EXPEDIENTE` int(11) NOT NULL COMMENT 'NUMERO DEL EXPEDIENTE',
  `CODIGO_ENFERMEDAD_BASE` int(11) NOT NULL COMMENT 'CODIGO DE LA ENFERMEDAD BASE',
  PRIMARY KEY (`CODIGO`),
  KEY `FK_EXPEDIENTE_ENFERMEDAD` (`NUM_EXPEDIENTE`),
  KEY `FK_ENFERMEDAD_EXPEDIENTE` (`CODIGO_ENFERMEDAD_BASE`),
  CONSTRAINT `FK_ENFERMEDAD_EXPEDIENTE` FOREIGN KEY (`CODIGO_ENFERMEDAD_BASE`) REFERENCES `enfermedades_base` (`CODIGO_ENFERMEDAD_BASE`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_EXPEDIENTE_ENFERMEDAD` FOREIGN KEY (`NUM_EXPEDIENTE`) REFERENCES `expediente` (`NUM_EXPEDIENTE`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla proyectocitasmedicas.enfermedad_paciente: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `enfermedad_paciente` DISABLE KEYS */;
INSERT IGNORE INTO `enfermedad_paciente` (`CODIGO`, `NUM_EXPEDIENTE`, `CODIGO_ENFERMEDAD_BASE`) VALUES
	(11, 9, 2),
	(13, 9, 4),
	(14, 9, 5),
	(15, 10, 3);
/*!40000 ALTER TABLE `enfermedad_paciente` ENABLE KEYS */;

-- Volcando estructura para tabla proyectocitasmedicas.especialidad
CREATE TABLE IF NOT EXISTS `especialidad` (
  `ID_ESPECIALIDAD` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CODIGO UNICO DE LA ESPECIALIDAD',
  `NOMBRE_ESPECIALIDAD` varchar(45) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'NOMBRE DE LA ESPECIALIDAD',
  `DESCRIPCION` varchar(350) COLLATE utf8_spanish2_ci DEFAULT NULL COMMENT 'DESCRIPCION DE LA ESPECIALIDAD',
  `DURACION_CITA` int(11) NOT NULL COMMENT 'DURACION DE LA CITA EN MINUTOS',
  `PRECIO_CITA` decimal(7,2) NOT NULL COMMENT 'PRECIO POR CADA CITA EN LA ESPECIALIDAD',
  PRIMARY KEY (`ID_ESPECIALIDAD`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla proyectocitasmedicas.especialidad: ~13 rows (aproximadamente)
/*!40000 ALTER TABLE `especialidad` DISABLE KEYS */;
INSERT IGNORE INTO `especialidad` (`ID_ESPECIALIDAD`, `NOMBRE_ESPECIALIDAD`, `DESCRIPCION`, `DURACION_CITA`, `PRECIO_CITA`) VALUES
	(1, 'CARDIOLOGÍA', 'Especialidad que se encarga del estudio, diagnóstico y tratamiento de las enfermedades del corazón y del sistema circulatorio. Es médica, pero no quirúrgica', 45, 650.00),
	(2, 'GINECOLOGIA', 'Especialidad médica y quirúrgica que estudia el sistema reproductor femenino.', 30, 500.00),
	(5, 'PEDRIATRIA', 'Especialidad médica que estudia al niño y sus enfermedades. ', 30, 700.00),
	(7, 'ODONTOLOGÍA', 'Especialidad que se encarga del diagnóstico, tratamiento y prevención de las enfermedades del aparato estomatognático, el cual incluye además de los dientes, las encías, el tejido periodontal, el maxilar superior, el maxilar inferior y la articulación temporomandibular. ', 30, 1000.00),
	(9, 'ONCOLOGÍA', 'La oncología es la rama de la medicina que estudia y trata las neoplasias, con especial atención a los tumores malignos o cáncer.', 60, 1000.00),
	(12, 'NEOROLOGÍA', 'Es la especialidad médica que trata los trastornos del sistema nervioso.', 30, 700.00),
	(13, 'MÉDICINA GENERAL', 'Es el primer nivel de atención médica. La consulta está orientada al abordaje integral del paciente en su aspecto físico, mental y social.', 30, 300.00),
	(15, 'MÉDICINA INTERNA', 'Especialidad médica que se dedica a la atención integral del adulto enfermo, enfocada al diagnóstico y el tratamiento no quirúrgico de las enfermedades que afectan a sus órganos y sistemas internos, y a su prevención', 40, 650.00),
	(16, 'ANESTESIOLOGÍA', 'La especialidad médica recibe el nombre de anestesiología y reanimación, dado que abarca el tratamiento del paciente crítico en distintas áreas como lo son la recuperación postoperatoria y la emergencia, así como el cuidado del paciente crítico en las unidades de cuidados intensivos o de reanimación postoperatoria.', 35, 300.00),
	(17, 'CARDIOLOGÍA INTERVENCIONISTA', 'La cardiología intervencionista es una rama de la cardiología que se ocupa específicamente del tratamiento con catéter de las enfermedades cardíacas estructurales.', 45, 700.00),
	(18, 'CIRUGÍA PEDIÁTRICA', 'La cirugía pediátrica es una especialidad de la cirugía dedicada al diagnóstico, manejo preoperatorio, operación y cuidado postoperatorio de los problemas que presentan el feto, lactante, escolar, adolescente y joven adulto. ', 60, 1000.00),
	(21, 'GASTROTEROLOGÍA', ' Estudia al sistema digestivo, conformado por esófago, estómago, hígado, vía biliares, páncreas, los intestinos, colon y recto.\r\n\r\nAlgunos de los procedimientos que se llevan a cabo dentro de esta rama médica son las colonoscopias, endoscopias y biopsias del hígado.', 45, 1200.00);
/*!40000 ALTER TABLE `especialidad` ENABLE KEYS */;

-- Volcando estructura para tabla proyectocitasmedicas.estado_cita
CREATE TABLE IF NOT EXISTS `estado_cita` (
  `ID_ESTADO_CITA` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CODIGO UNICO DEL REGISTRO DEL ESTADO DE LA CITA',
  `NOMBRE` varchar(30) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'NOMBRE DEL ESTADO (COMPLETA, REPROGRAMADA, CANCELADA)',
  PRIMARY KEY (`ID_ESTADO_CITA`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla proyectocitasmedicas.estado_cita: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `estado_cita` DISABLE KEYS */;
INSERT IGNORE INTO `estado_cita` (`ID_ESTADO_CITA`, `NOMBRE`) VALUES
	(1, 'Pendiente'),
	(2, 'Completa'),
	(3, 'Reprogramada'),
	(4, 'Cancelada');
/*!40000 ALTER TABLE `estado_cita` ENABLE KEYS */;

-- Volcando estructura para tabla proyectocitasmedicas.expediente
CREATE TABLE IF NOT EXISTS `expediente` (
  `NUM_EXPEDIENTE` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CLIENTE` int(11) NOT NULL,
  PRIMARY KEY (`NUM_EXPEDIENTE`),
  KEY `FK_EXPEDIENTE_CLIENTE` (`ID_CLIENTE`),
  CONSTRAINT `FK_EXPEDIENTE_CLIENTE` FOREIGN KEY (`ID_CLIENTE`) REFERENCES `cliente` (`ID_CLIENTE`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla proyectocitasmedicas.expediente: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `expediente` DISABLE KEYS */;
INSERT IGNORE INTO `expediente` (`NUM_EXPEDIENTE`, `ID_CLIENTE`) VALUES
	(9, 10),
	(10, 20);
/*!40000 ALTER TABLE `expediente` ENABLE KEYS */;

-- Volcando estructura para vista proyectocitasmedicas.fecha_citas
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `fecha_citas` (
	`FECHA` DATE NOT NULL COMMENT 'FECHA DE LA CITA',
	`TOTAL` BIGINT(21) NOT NULL
) ENGINE=MyISAM;

-- Volcando estructura para vista proyectocitasmedicas.ganancia_especialidad
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `ganancia_especialidad` (
	`ID` INT(11) NOT NULL COMMENT 'ID DE LA ESPECIALIDAD',
	`NOMBRE` VARCHAR(45) NOT NULL COMMENT 'NOMBRE DE LA ESPECIALIDAD' COLLATE 'utf8_spanish2_ci',
	`TOTAL` DECIMAL(29,2) NULL
) ENGINE=MyISAM;

-- Volcando estructura para vista proyectocitasmedicas.historial_citas_medicas
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `historial_citas_medicas` (
	`ID_CITA_MEDICA` INT(11) NOT NULL COMMENT 'CODIGO UNICO DE LA CITA',
	`ID_CLIENTE` INT(11) NOT NULL COMMENT 'ID DEL CLIENTE',
	`ID_MEDICO` INT(11) NOT NULL COMMENT 'ID DEL MEDICO',
	`ID_ESPECIALIDAD` INT(11) NOT NULL COMMENT 'ID DE LA ESPECIALIDAD',
	`FECHA_CITA` DATE NOT NULL COMMENT 'FECHA DE LA CITA',
	`HORA_INICIO` TIME NOT NULL COMMENT 'HORA DE INICIO',
	`ID_ESTADO_CITA` INT(11) NOT NULL COMMENT 'ID DEL ESTADO DE LA CITA'
) ENGINE=MyISAM;

-- Volcando estructura para tabla proyectocitasmedicas.horario
CREATE TABLE IF NOT EXISTS `horario` (
  `ID_HORARIO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_MEDICO` int(11) NOT NULL,
  `HORA_ENTRADA` time NOT NULL,
  `HORA_SALIDA` time NOT NULL,
  PRIMARY KEY (`ID_HORARIO`),
  KEY `ID_MEDICO` (`ID_MEDICO`),
  CONSTRAINT `ID_HORARIO_MEDICO` FOREIGN KEY (`ID_MEDICO`) REFERENCES `medico` (`ID_MEDICO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla proyectocitasmedicas.horario: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `horario` DISABLE KEYS */;
INSERT IGNORE INTO `horario` (`ID_HORARIO`, `ID_MEDICO`, `HORA_ENTRADA`, `HORA_SALIDA`) VALUES
	(1, 3, '07:00:00', '17:00:00'),
	(2, 2, '09:00:00', '20:00:00'),
	(5, 1, '07:00:00', '22:00:00'),
	(6, 4, '13:00:00', '20:00:00'),
	(7, 5, '09:00:00', '20:00:00'),
	(8, 6, '08:00:00', '16:00:00');
/*!40000 ALTER TABLE `horario` ENABLE KEYS */;

-- Volcando estructura para vista proyectocitasmedicas.horario_medico
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `horario_medico` (
	`ID_ESPECIALIDAD` INT(11) NOT NULL COMMENT 'CODIGO UNICO DE LA ESPECIALIDAD',
	`NOMBRE_ESPECIALIDAD` VARCHAR(45) NOT NULL COMMENT 'NOMBRE DE LA ESPECIALIDAD' COLLATE 'utf8_spanish2_ci',
	`DURACION_CITA` INT(11) NOT NULL COMMENT 'DURACION DE LA CITA EN MINUTOS',
	`PRECIO_CITA` DECIMAL(7,2) NOT NULL COMMENT 'PRECIO POR CADA CITA EN LA ESPECIALIDAD',
	`ID_MEDICO` INT(11) NOT NULL COMMENT 'CODIGO UNICO DEL MEDICO',
	`NOMBRE` VARCHAR(75) NOT NULL COMMENT 'PRIMER Y SEGUNDO NOMBRE DE LA PERSONA' COLLATE 'utf8_spanish2_ci',
	`APELLIDO` VARCHAR(75) NOT NULL COMMENT 'PRIMER Y SEGUNDO APELLIDO DE LA PERSONA' COLLATE 'utf8_spanish2_ci',
	`ID_SALA_MEDICA` INT(11) NOT NULL COMMENT 'CODIGO UNICO DE LA SALA MEDICA',
	`NUMERO` INT(11) NOT NULL COMMENT 'NUMERO DE LA SALA MEDICA',
	`EDIFICIO` VARCHAR(25) NULL COMMENT 'NUMERO O NOMBRE DEL EDIFICIO' COLLATE 'utf8_spanish2_ci',
	`DETALLE_UBICACION` VARCHAR(255) NULL COMMENT 'DESCRIPCION DETALLADA DE LA UBICACION' COLLATE 'utf8_spanish2_ci',
	`HORA_ENTRADA` TIME NOT NULL,
	`HORA_SALIDA` TIME NOT NULL
) ENGINE=MyISAM;

-- Volcando estructura para vista proyectocitasmedicas.inicio_especialidad
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `inicio_especialidad` (
	`ID_ESPECIALIDAD` INT(11) NOT NULL COMMENT 'CODIGO UNICO DE LA ESPECIALIDAD',
	`NOMBRE_ESPECIALIDAD` VARCHAR(45) NOT NULL COMMENT 'NOMBRE DE LA ESPECIALIDAD' COLLATE 'utf8_spanish2_ci',
	`DESCRIPCION` VARCHAR(350) NULL COMMENT 'DESCRIPCION DE LA ESPECIALIDAD' COLLATE 'utf8_spanish2_ci'
) ENGINE=MyISAM;

-- Volcando estructura para vista proyectocitasmedicas.login_usuarios
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `login_usuarios` (
	`CODIGO_PERSONA` INT(11) NOT NULL COMMENT 'CODIGO UNICO DE LOS DATOS PERSONALES',
	`NOMBRE` VARCHAR(75) NOT NULL COMMENT 'PRIMER Y SEGUNDO NOMBRE DE LA PERSONA' COLLATE 'utf8_spanish2_ci',
	`APELLIDO` VARCHAR(75) NOT NULL COMMENT 'PRIMER Y SEGUNDO APELLIDO DE LA PERSONA' COLLATE 'utf8_spanish2_ci',
	`EMAIL` VARCHAR(50) NULL COMMENT 'CORREO ELECTRONICO ACTIVO' COLLATE 'utf8_spanish2_ci',
	`ID_USUARIO` INT(11) NOT NULL COMMENT 'NUMERO UNICO DE IDENTIFICACION DE USUARIO',
	`NOMBRE_USUARIO` VARCHAR(45) NULL COMMENT 'NOMBRE DE USUARIO UNICO' COLLATE 'utf8_spanish2_ci',
	`CLAVE_ACCESO` VARCHAR(100) NOT NULL COMMENT 'CLAVE PARA ACCEDER AL SISTEMA' COLLATE 'utf8_spanish2_ci',
	`ESTADO` INT(1) NOT NULL COMMENT 'ESTADO ACTUAL DEL USUARIO',
	`ID_ROL` INT(11) NOT NULL COMMENT 'ID DEL ROL EN EL SISTEMA',
	`IMG_PERFIL` VARCHAR(100) NULL COMMENT 'IAMGEN DEL PERFIL DEL USUARIO' COLLATE 'utf8_spanish2_ci'
) ENGINE=MyISAM;

-- Volcando estructura para tabla proyectocitasmedicas.medico
CREATE TABLE IF NOT EXISTS `medico` (
  `ID_MEDICO` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CODIGO UNICO DEL MEDICO',
  `ID_PERSONA` int(11) NOT NULL COMMENT 'CODIGO DE LOS DATOS PERSONALES',
  `ID_USUARIO` int(11) NOT NULL COMMENT 'CODIGO DE LOS DATOS DE ACCESO A SISTEMA',
  `ID_ESPECIALIDAD` int(11) NOT NULL COMMENT 'CODIGO DE LA ESPECIALIDAD',
  `ID_SALA_MEDICA` int(11) NOT NULL COMMENT 'CODIGO DE LA SALA MEDICA',
  PRIMARY KEY (`ID_MEDICO`),
  KEY `FK_USUARIO_MEDICO` (`ID_USUARIO`),
  KEY `FK_ESPECIALIDAD_MEDICO` (`ID_ESPECIALIDAD`),
  KEY `FK_SALA_MEDICO` (`ID_SALA_MEDICA`),
  KEY `FK_COD_PERSONA` (`ID_PERSONA`) USING BTREE,
  CONSTRAINT `FK_ESPECIALIDAD_MEDICO` FOREIGN KEY (`ID_ESPECIALIDAD`) REFERENCES `especialidad` (`ID_ESPECIALIDAD`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_MD_PERSONA` FOREIGN KEY (`ID_PERSONA`) REFERENCES `persona` (`CODIGO_PERSONA`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_SALA_MEDICO` FOREIGN KEY (`ID_SALA_MEDICA`) REFERENCES `salas` (`ID_SALA_MEDICA`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_USUARIO_MEDICO` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuarios` (`ID_USUARIO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla proyectocitasmedicas.medico: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `medico` DISABLE KEYS */;
INSERT IGNORE INTO `medico` (`ID_MEDICO`, `ID_PERSONA`, `ID_USUARIO`, `ID_ESPECIALIDAD`, `ID_SALA_MEDICA`) VALUES
	(1, 2, 2, 1, 1),
	(2, 25, 15, 7, 2),
	(3, 44, 33, 13, 9),
	(4, 55, 39, 16, 10),
	(5, 56, 40, 18, 21),
	(6, 57, 41, 17, 21);
/*!40000 ALTER TABLE `medico` ENABLE KEYS */;

-- Volcando estructura para vista proyectocitasmedicas.medico_registrado
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `medico_registrado` (
	`ID_MEDICO` INT(11) NOT NULL COMMENT 'CODIGO UNICO DEL MEDICO',
	`ID_USUARIO` INT(11) NOT NULL COMMENT 'CODIGO DE LOS DATOS DE ACCESO A SISTEMA',
	`ID_PERSONA` INT(11) NOT NULL COMMENT 'CODIGO DE LOS DATOS PERSONALES',
	`ID_ESPECIALIDAD` INT(11) NOT NULL COMMENT 'CODIGO DE LA ESPECIALIDAD',
	`ID_SALA_MEDICA` INT(11) NOT NULL COMMENT 'CODIGO DE LA SALA MEDICA',
	`CODIGO_PERSONA` INT(11) NOT NULL COMMENT 'CODIGO UNICO DE LOS DATOS PERSONALES',
	`NOMBRE` VARCHAR(75) NOT NULL COMMENT 'PRIMER Y SEGUNDO NOMBRE DE LA PERSONA' COLLATE 'utf8_spanish2_ci',
	`APELLIDO` VARCHAR(75) NOT NULL COMMENT 'PRIMER Y SEGUNDO APELLIDO DE LA PERSONA' COLLATE 'utf8_spanish2_ci',
	`TIPO_DOCUMENTO` INT(11) NULL COMMENT 'CODIGO DEL TIPO DE DOCUMENTO',
	`NO_DOCUMENTO` VARCHAR(25) NULL COMMENT 'NUMERO DEL DOCUMENTO' COLLATE 'utf8_spanish2_ci',
	`PAIS` INT(11) NULL COMMENT 'CODIGO DEL PAIS AL QUE PERTENECE',
	`FECHA_NACIMIENTO` DATE NULL COMMENT 'FECHA DE NACIMIENTO DE LA PERSONA',
	`SEXO` VARCHAR(1) NULL COMMENT 'SEXO DE LA PERSONA' COLLATE 'utf8_spanish2_ci',
	`DOMICILIO` VARCHAR(255) NULL COMMENT 'DOMICILIO COMPLETO DE LA PERSONA' COLLATE 'utf8_spanish2_ci',
	`TELEFONO` VARCHAR(15) NULL COMMENT 'NUMERO DE TELEFONO FIJO (CASA)' COLLATE 'utf8_spanish2_ci',
	`CELULAR` VARCHAR(15) NULL COMMENT 'NUMERO DE TELEFONO MOVIL (CELULAR)' COLLATE 'utf8_spanish2_ci',
	`EMAIL` VARCHAR(50) NULL COMMENT 'CORREO ELECTRONICO ACTIVO' COLLATE 'utf8_spanish2_ci',
	`TIPO_SANGRE` INT(11) NULL COMMENT 'CODIGO DEL TIPO DE SANGRE DE LA PERSONA',
	`ID_ROL` INT(11) NOT NULL COMMENT 'ID DEL ROL EN EL SISTEMA',
	`IMG_PERFIL` VARCHAR(100) NULL COMMENT 'IAMGEN DEL PERFIL DEL USUARIO' COLLATE 'utf8_spanish2_ci',
	`FECHA_REGISTRO` DATE NOT NULL COMMENT 'FECHA DE REGISTRO'
) ENGINE=MyISAM;

-- Volcando estructura para vista proyectocitasmedicas.numero_citas_especialidad
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `numero_citas_especialidad` (
	`ID` INT(11) NOT NULL COMMENT 'ID DE LA ESPECIALIDAD',
	`NOMBRE` VARCHAR(45) NOT NULL COMMENT 'NOMBRE DE LA ESPECIALIDAD' COLLATE 'utf8_spanish2_ci',
	`TOTAL` BIGINT(21) NOT NULL
) ENGINE=MyISAM;

-- Volcando estructura para tabla proyectocitasmedicas.paises
CREATE TABLE IF NOT EXISTS `paises` (
  `CODIGO_PAIS` int(11) NOT NULL COMMENT 'CODIGO INTERNECIONAL ASIGNADO AL PAIS',
  `NOMBRE_OFICIAL` varchar(50) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'NOMBRE OFICIAL DEL PAIS',
  PRIMARY KEY (`CODIGO_PAIS`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla proyectocitasmedicas.paises: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `paises` DISABLE KEYS */;
INSERT IGNORE INTO `paises` (`CODIGO_PAIS`, `NOMBRE_OFICIAL`) VALUES
	(1, 'Estados Unidos'),
	(504, 'Honduras'),
	(505, 'Nicaragua ');
/*!40000 ALTER TABLE `paises` ENABLE KEYS */;

-- Volcando estructura para vista proyectocitasmedicas.perdidas_por_cancelacion
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `perdidas_por_cancelacion` (
	`ID` INT(11) NOT NULL COMMENT 'ID DE LA ESPECIALIDAD',
	`NOMBRE` VARCHAR(45) NOT NULL COMMENT 'NOMBRE DE LA ESPECIALIDAD' COLLATE 'utf8_spanish2_ci',
	`TOTAL` DECIMAL(29,2) NULL
) ENGINE=MyISAM;

-- Volcando estructura para tabla proyectocitasmedicas.persona
CREATE TABLE IF NOT EXISTS `persona` (
  `CODIGO_PERSONA` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CODIGO UNICO DE LOS DATOS PERSONALES',
  `NOMBRE` varchar(75) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'PRIMER Y SEGUNDO NOMBRE DE LA PERSONA',
  `APELLIDO` varchar(75) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'PRIMER Y SEGUNDO APELLIDO DE LA PERSONA',
  `TIPO_DOCUMENTO` int(11) DEFAULT NULL COMMENT 'CODIGO DEL TIPO DE DOCUMENTO',
  `NO_DOCUMENTO` varchar(25) COLLATE utf8_spanish2_ci DEFAULT NULL COMMENT 'NUMERO DEL DOCUMENTO',
  `PAIS` int(11) DEFAULT NULL COMMENT 'CODIGO DEL PAIS AL QUE PERTENECE',
  `FECHA_NACIMIENTO` date DEFAULT NULL COMMENT 'FECHA DE NACIMIENTO DE LA PERSONA',
  `SEXO` varchar(1) COLLATE utf8_spanish2_ci DEFAULT NULL COMMENT 'SEXO DE LA PERSONA',
  `DOMICILIO` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL COMMENT 'DOMICILIO COMPLETO DE LA PERSONA',
  `TELEFONO` varchar(15) COLLATE utf8_spanish2_ci DEFAULT NULL COMMENT 'NUMERO DE TELEFONO FIJO (CASA)',
  `CELULAR` varchar(15) COLLATE utf8_spanish2_ci DEFAULT NULL COMMENT 'NUMERO DE TELEFONO MOVIL (CELULAR)',
  `EMAIL` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL COMMENT 'CORREO ELECTRONICO ACTIVO',
  `TIPO_SANGRE` int(11) DEFAULT NULL COMMENT 'CODIGO DEL TIPO DE SANGRE DE LA PERSONA',
  PRIMARY KEY (`CODIGO_PERSONA`),
  KEY `FK_TIPO_DOCUMENTO_PERSONA` (`TIPO_DOCUMENTO`),
  KEY `FK_PAIS_PERSONA` (`PAIS`),
  KEY `FK_SEXO_PERSONA` (`SEXO`),
  KEY `FK_TIPO_SANGRE_PERSONA` (`TIPO_SANGRE`),
  CONSTRAINT `FK_PAIS_PERSONA` FOREIGN KEY (`PAIS`) REFERENCES `paises` (`CODIGO_PAIS`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_SEXO_PERSONA` FOREIGN KEY (`SEXO`) REFERENCES `sexo` (`CODIGO`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_TIPO_DOCUMENTO_PERSONA` FOREIGN KEY (`TIPO_DOCUMENTO`) REFERENCES `tipo_documento` (`ID_TIPO_DOCUMENTO`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_TIPO_SANGRE_PERSONA` FOREIGN KEY (`TIPO_SANGRE`) REFERENCES `tipo_sangre` (`ID_TIPO_SANGRE`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla proyectocitasmedicas.persona: ~33 rows (aproximadamente)
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT IGNORE INTO `persona` (`CODIGO_PERSONA`, `NOMBRE`, `APELLIDO`, `TIPO_DOCUMENTO`, `NO_DOCUMENTO`, `PAIS`, `FECHA_NACIMIENTO`, `SEXO`, `DOMICILIO`, `TELEFONO`, `CELULAR`, `EMAIL`, `TIPO_SANGRE`) VALUES
	(1, 'Juana Lorena', 'Posas Melendéz', 1, '1807200000756', 504, '1990-01-24', 'F', NULL, NULL, '88900767', 'lorenamelendez@gmail.com', 1),
	(2, 'Hanna', 'Martínez', 1, '1807200000778', 504, '1996-03-02', 'F', NULL, NULL, '88096889', 'hannamartinez@gmail.com', 2),
	(4, 'Maria', 'Garcia', 1, '1807200000876', 504, '2000-01-24', 'F', 'COL. 15 DE SEPTIEMBRE', '2446-9809', '9908-4532', 'mariajhosegarcia@gmail.com', 1),
	(14, 'Sandra', 'Munguía', NULL, NULL, 504, '2000-01-24', 'F', '', '', '', 'sandrapatricia@gmail.com', 1),
	(15, 'Andrés', 'Rivas', NULL, NULL, 504, '0000-00-00', 'M', '', '', '', 'andrezrivas@gmail.com', 1),
	(16, 'Mónica ', 'Ramírez ', NULL, NULL, 504, '0000-00-00', 'F', '', '', '', '', 1),
	(18, 'Lucia', 'Opera', NULL, NULL, 504, '0000-00-00', 'F', '', '', '', 'luciaopera12@gmail.com', 1),
	(22, 'Juan', 'Salas', NULL, NULL, 1, '1998-01-12', 'M', '', '24469809', '99084532', 'juan.salas@gmail.com', 1),
	(23, 'León', 'Posas', NULL, NULL, 505, '0000-00-00', 'M', '', '24469809', '99084532', 'leon@gmail.com', 2),
	(24, 'Diana', 'Gonzales', NULL, NULL, NULL, NULL, 'F', NULL, NULL, NULL, 'diana@gmail.com', NULL),
	(25, 'Karla', 'Garcia', 1, '1807199500856', 504, '1992-06-18', 'F', '', '', '90234323', 'karla@gmail.com', 1),
	(26, 'Pamela Ricarda', 'Ponce Carcamo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(29, 'Juana Pamela ', 'Ponce Carcamo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'juana@gmail.com', NULL),
	(30, 'Patricia Mariela', 'Posas Carcamo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'patricia@gmail.com', NULL),
	(31, 'Pamela Ricarda', 'Murillo Soto', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ricarda@gmail.com', NULL),
	(32, 'Andrés Ricardo', 'Oliva Posas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ricardo@gmail.com', NULL),
	(33, 'Mónica Patricia', 'Ponce Carcamo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'monica@gmail.com', NULL),
	(34, 'Lucia Mariana', 'Posas Munguía', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'luciamariela@gmail.com', NULL),
	(35, 'Patricia Tatiana', 'Sandoval', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tati@gmail.com', NULL),
	(36, 'Luciana Maria', 'Manrique', 1, '1807200000732', 504, '2000-04-08', 'F', 'COL. EL BIBLICO', '24469083', '98433456', 'maria@gmail.com', 2),
	(37, 'Pamela Ricarda', 'Ramírez ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pamelaricarda@gmail.com', NULL),
	(38, 'Lucia Mariana ', 'Posas Carvajal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'luciamariana@gmail.com', NULL),
	(39, 'Lucia', 'Ponce Carcamo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'lucia123@gmail.com', NULL),
	(40, 'Camila', 'Posas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'camila@gmail.com', NULL),
	(41, 'Pamela Ricarda', 'Munguía', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pamela1234@gmail.com', NULL),
	(42, 'Maria', 'Ponce Carcamo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'maria12@gmail.com', NULL),
	(43, 'Carolina Maria', 'Zuniga', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'zunigac@gmail.com', NULL),
	(44, 'Juana Maritza', 'Ponce Posas', NULL, NULL, 504, '2000-05-10', 'F', 'COL. PONCE HERRERA', '24467894', '97123460', 'poncejuana@gmail.com', 1),
	(45, 'Sandra', 'Posas Posas', NULL, NULL, 504, '1983-02-03', 'F', 'Col. 1234', '12345678', '12345698', 'sandrapp@gmail.com', 1),
	(49, 'Pola', 'Posas Posas', NULL, NULL, 504, '0000-00-00', 'F', '', '', '', 'pola@gmail.com', 1),
	(52, 'Martina', 'Alcantara', 1, '123454321', 505, '0000-00-00', 'F', 'Col. Mapola', '24467234', '98763218', 'martinaalcantara@gmail.com', 1),
	(53, 'Gabriela', 'Suaréz', 1, '1807199834562', 504, '1998-01-24', 'F', 'Col. Munguia', '24469834', '98124323', 'gabisuarez@gmail.com', NULL),
	(54, 'Maria Jhosé', 'Munguía', 1, '1807199820345', 504, '1998-01-24', 'F', '', '', '89074356', 'munguiagarcia@gmail.com', NULL),
	(55, 'Juana Olivia', 'Posas Reyes', 1, '1807199545921', 504, '1995-04-06', 'F', '', '', '88409092', 'juanareyes@gmail.com', 2),
	(56, 'Olga Vanessa', 'Jueréz Ponce', 2, '1247749242', 1, '2021-04-07', 'F', '', '', '87951223', 'olga@gmail.com', 2),
	(57, 'Pedro ', 'Perez', 2, '473589620592', 504, '1994-04-08', 'M', '', '', '87645345', 'pedro@gmail.com', 2),
	(58, 'Karla Marcela', 'Wolf Overto', 1, '1807200000645', 504, '2000-07-16', 'F', '', '24469889', '88409192', 'marcela@gmail.com', 2),
	(59, 'Maritza Larissa', 'Rubio Ponlance', 2, '1846362742', 504, '2021-04-16', 'F', '', '', '88409092', 'rubiop@webhealth.com', 1),
	(60, 'MARIA', 'GARCIA', 1, '123456789', 504, '1992-03-04', 'F', '', '', '', 'mariagarciacrea@gmail.com', 2);
/*!40000 ALTER TABLE `persona` ENABLE KEYS */;

-- Volcando estructura para vista proyectocitasmedicas.persona_usuario
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `persona_usuario` (
	`CODIGO_PERSONA` INT(11) NOT NULL COMMENT 'CODIGO UNICO DE LOS DATOS PERSONALES',
	`ID_USUARIO` INT(11) NOT NULL COMMENT 'NUMERO UNICO DE IDENTIFICACION DE USUARIO',
	`EMAIL` VARCHAR(50) NULL COMMENT 'CORREO ELECTRONICO ACTIVO' COLLATE 'utf8_spanish2_ci'
) ENGINE=MyISAM;

-- Volcando estructura para vista proyectocitasmedicas.reporte_cliente_registro
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `reporte_cliente_registro` (
	`ID_CLIENTE` INT(11) NOT NULL COMMENT 'CODIGO DEL CLIENTE',
	`NOMBRE` VARCHAR(75) NOT NULL COMMENT 'PRIMER Y SEGUNDO NOMBRE DE LA PERSONA' COLLATE 'utf8_spanish2_ci',
	`APELLIDO` VARCHAR(75) NOT NULL COMMENT 'PRIMER Y SEGUNDO APELLIDO DE LA PERSONA' COLLATE 'utf8_spanish2_ci',
	`email` VARCHAR(50) NULL COMMENT 'CORREO ELECTRONICO ACTIVO' COLLATE 'utf8_spanish2_ci',
	`FECHA_REGISTRO` DATE NOT NULL COMMENT 'FECHA DE REGISTRO'
) ENGINE=MyISAM;

-- Volcando estructura para vista proyectocitasmedicas.reporte_medico_especialidad
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `reporte_medico_especialidad` (
	`ID_MEDICO` INT(11) NOT NULL COMMENT 'CODIGO UNICO DEL MEDICO',
	`NOMBRE` VARCHAR(75) NOT NULL COMMENT 'PRIMER Y SEGUNDO NOMBRE DE LA PERSONA' COLLATE 'utf8_spanish2_ci',
	`APELLIDO` VARCHAR(75) NOT NULL COMMENT 'PRIMER Y SEGUNDO APELLIDO DE LA PERSONA' COLLATE 'utf8_spanish2_ci',
	`NOMBRE_ESPECIALIDAD` VARCHAR(45) NOT NULL COMMENT 'NOMBRE DE LA ESPECIALIDAD' COLLATE 'utf8_spanish2_ci'
) ENGINE=MyISAM;

-- Volcando estructura para tabla proyectocitasmedicas.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `CODIGO_ROL` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CODIGO UNICO PARA CADA ROL DEL SISTEMA',
  `NOMBRE_ROL` varchar(50) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'NOMBRE DEL ROL',
  `OBS` varchar(255) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'OBSERVACIONES',
  PRIMARY KEY (`CODIGO_ROL`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla proyectocitasmedicas.roles: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT IGNORE INTO `roles` (`CODIGO_ROL`, `NOMBRE_ROL`, `OBS`) VALUES
	(1, 'ADMINISTRADOR', ''),
	(2, 'MEDICO', ''),
	(3, 'PACIENTE', '');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Volcando estructura para tabla proyectocitasmedicas.salas
CREATE TABLE IF NOT EXISTS `salas` (
  `ID_SALA_MEDICA` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CODIGO UNICO DE LA SALA MEDICA',
  `NUMERO` int(11) NOT NULL COMMENT 'NUMERO DE LA SALA MEDICA',
  `EDIFICIO` varchar(25) COLLATE utf8_spanish2_ci DEFAULT NULL COMMENT 'NUMERO O NOMBRE DEL EDIFICIO',
  `DETALLE_UBICACION` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL COMMENT 'DESCRIPCION DETALLADA DE LA UBICACION',
  PRIMARY KEY (`ID_SALA_MEDICA`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla proyectocitasmedicas.salas: ~17 rows (aproximadamente)
/*!40000 ALTER TABLE `salas` DISABLE KEYS */;
INSERT IGNORE INTO `salas` (`ID_SALA_MEDICA`, `NUMERO`, `EDIFICIO`, `DETALLE_UBICACION`) VALUES
	(1, 101, 'E', 'PRIMER PISO, PASILLO 1, PRIMERA PUERTA A LADO DERECHO'),
	(2, 102, 'A', ' PRIMER PISO, PASILLO 1, PRIMERA PUERTA A LADO IZQUIERDO\r\n'),
	(3, 103, 'A', ' PRIMER PISO, PASILLO 1, SEGUNDA PUERTA A LADO DERECHO	'),
	(4, 104, 'A', ' PRIMER PISO, PASILLO 1, SEGUNDA PUERTA A LADO IZQUIERDO	\r\n'),
	(5, 101, 'B', ' PRIMER PISO, PASILLO 1, PRIMERA PUERTA A LADO IZQUIERDO	'),
	(9, 104, 'B', ' PRIMER PISO, PASILLO 1, SEGUNDA PUERTA A LADO IZQUIERDO'),
	(10, 104, 'C', 'PRIMER PISO, PASILLO 1, PRIMERA PUERTA A LADO DERECHO'),
	(11, 104, 'C', 'PRIMER PISO, PASILLO 1, PRIMERA PUERTA A LADO DERECHO'),
	(12, 201, 'C', ' SEGUNDO PISO, PASILLO 1, PRIMERA PUERTA A LADO DERECHO'),
	(13, 202, 'C', ' SEGUNDO PISO, PASILLO 1, PRIMERA PUERTA A LADO IZQUIERDA'),
	(14, 211, 'C', 'SEGUNDO PISO, PASILLO 2, PRIMERA PUERTA MANO IZQUIERDA'),
	(15, 211, 'C', 'SEGUNDO PISO, PASILLO 2, PRIMERA PUERTA MANO IZQUIERDA'),
	(16, 101, 'D', 'PRIMER PISO, PASILLO 1, PRIMERA PUERTA A LADO DERECHO'),
	(17, 101, 'D', 'PRIMER PISO, PASILLO 1, PRIMERA PUERTA A LADO DERECHO'),
	(19, 101, 'G', ' PRIMER PISO, PASILLO 1, PRIMERA PUERTA A LADO DERECHO'),
	(20, 301, 'A', 'TERCER PISO, PASILLO 1, PRIMERA PUERTA A LADO IZQUIERDO '),
	(21, 302, 'A', '  TERCER PISO, PASILLO 1, PRIMERA PUERTA A LADO DERECHO');
/*!40000 ALTER TABLE `salas` ENABLE KEYS */;

-- Volcando estructura para vista proyectocitasmedicas.salas_medico
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `salas_medico` (
	`ID_MEDICO` INT(11) NOT NULL COMMENT 'CODIGO UNICO DEL MEDICO',
	`ID_SALA_MEDICA` INT(11) NOT NULL COMMENT 'CODIGO UNICO DE LA SALA MEDICA',
	`NUMERO` INT(11) NOT NULL COMMENT 'NUMERO DE LA SALA MEDICA',
	`EDIFICIO` VARCHAR(25) NULL COMMENT 'NUMERO O NOMBRE DEL EDIFICIO' COLLATE 'utf8_spanish2_ci',
	`DETALLE_UBICACION` VARCHAR(255) NULL COMMENT 'DESCRIPCION DETALLADA DE LA UBICACION' COLLATE 'utf8_spanish2_ci'
) ENGINE=MyISAM;

-- Volcando estructura para tabla proyectocitasmedicas.sexo
CREATE TABLE IF NOT EXISTS `sexo` (
  `CODIGO` varchar(1) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'CODIGO UNICO DEL REGISTRO',
  `NOMBRE` varchar(25) COLLATE utf8_spanish2_ci DEFAULT NULL COMMENT 'NOMBRE DEL SEXO',
  PRIMARY KEY (`CODIGO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla proyectocitasmedicas.sexo: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `sexo` DISABLE KEYS */;
INSERT IGNORE INTO `sexo` (`CODIGO`, `NOMBRE`) VALUES
	('F', 'Femenino'),
	('M', 'Masculino');
/*!40000 ALTER TABLE `sexo` ENABLE KEYS */;

-- Volcando estructura para tabla proyectocitasmedicas.sintomas_comunes
CREATE TABLE IF NOT EXISTS `sintomas_comunes` (
  `CODIGO_SINTOMA_COMUN` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CODIGO UNICO PARA CADA SINTOMA_COMUN EN EL SISTEMA',
  `NOMBRE_SINTOMA_COMUN` varchar(50) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'NOMBRE DEL SINTOMA',
  `OBS` varchar(255) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'OBSERVACIONES',
  PRIMARY KEY (`CODIGO_SINTOMA_COMUN`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla proyectocitasmedicas.sintomas_comunes: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `sintomas_comunes` DISABLE KEYS */;
INSERT IGNORE INTO `sintomas_comunes` (`CODIGO_SINTOMA_COMUN`, `NOMBRE_SINTOMA_COMUN`, `OBS`) VALUES
	(1, 'GRIPE', ''),
	(2, 'TOS SECA', ''),
	(3, 'TOS CON FLEMA', ' '),
	(4, 'ESTORNUDOS', ' '),
	(7, 'DOLOR DE CABEZA', ''),
	(8, 'MIGRAÑA', ' '),
	(9, 'CONGESTIÓN NASAL', ' '),
	(10, 'VOMITO', ' '),
	(11, 'DIARREA', ' '),
	(12, 'DOLOR ESTOMACAL', ' '),
	(13, 'DIFICULTAD PARA RESPIRAR', ' ');
/*!40000 ALTER TABLE `sintomas_comunes` ENABLE KEYS */;

-- Volcando estructura para tabla proyectocitasmedicas.sintomas_pacientes
CREATE TABLE IF NOT EXISTS `sintomas_pacientes` (
  `ID_SINTOMA_PACIENTE` int(11) NOT NULL AUTO_INCREMENT COMMENT 'IDENTIFICADOR UNICO DEL REGISTRO',
  `ID_SINTOMA_COMUN` int(11) NOT NULL COMMENT 'ID DEL SINTOMA COMUN QUE PADECE EL PACIENTE',
  `ID_SINTOMA_CONSULTA` int(11) NOT NULL COMMENT 'ID DE LA CONSULTA',
  PRIMARY KEY (`ID_SINTOMA_PACIENTE`),
  KEY `FK_SINTOMA_PACIENTE` (`ID_SINTOMA_COMUN`),
  KEY `FK_CONSULTA_SINTOMA` (`ID_SINTOMA_CONSULTA`),
  CONSTRAINT `FK_CONSULTA_SINTOMA` FOREIGN KEY (`ID_SINTOMA_CONSULTA`) REFERENCES `cita_medica` (`ID_CITA_MEDICA`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_SINTOMA_PACIENTE` FOREIGN KEY (`ID_SINTOMA_COMUN`) REFERENCES `sintomas_comunes` (`CODIGO_SINTOMA_COMUN`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla proyectocitasmedicas.sintomas_pacientes: ~14 rows (aproximadamente)
/*!40000 ALTER TABLE `sintomas_pacientes` DISABLE KEYS */;
INSERT IGNORE INTO `sintomas_pacientes` (`ID_SINTOMA_PACIENTE`, `ID_SINTOMA_COMUN`, `ID_SINTOMA_CONSULTA`) VALUES
	(4, 1, 7),
	(5, 2, 7),
	(6, 3, 7),
	(7, 4, 7),
	(8, 7, 7),
	(9, 1, 13),
	(10, 3, 13),
	(11, 4, 13),
	(12, 1, 14),
	(13, 3, 14),
	(14, 7, 14),
	(15, 1, 19),
	(16, 2, 19),
	(17, 7, 19);
/*!40000 ALTER TABLE `sintomas_pacientes` ENABLE KEYS */;

-- Volcando estructura para tabla proyectocitasmedicas.tipo_documento
CREATE TABLE IF NOT EXISTS `tipo_documento` (
  `ID_TIPO_DOCUMENTO` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CODIGO UNICO DE REGISTRO',
  `NOMBRE` varchar(40) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'NOMBRE OFICIAL DEL DOCUMENTO',
  `OBS` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL COMMENT 'OBSERVACIONES RELACIONADAS CON DICHO DOCUMENTO',
  PRIMARY KEY (`ID_TIPO_DOCUMENTO`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla proyectocitasmedicas.tipo_documento: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `tipo_documento` DISABLE KEYS */;
INSERT IGNORE INTO `tipo_documento` (`ID_TIPO_DOCUMENTO`, `NOMBRE`, `OBS`) VALUES
	(1, 'Tarjeta de identidad', NULL),
	(2, 'Pasaporte', NULL),
	(3, 'Acta de nacimiento', NULL);
/*!40000 ALTER TABLE `tipo_documento` ENABLE KEYS */;

-- Volcando estructura para tabla proyectocitasmedicas.tipo_sangre
CREATE TABLE IF NOT EXISTS `tipo_sangre` (
  `ID_TIPO_SANGRE` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CODIGO UNICO DE REGISTRO',
  `NOMBBRE_TIPO_SANGRE` varchar(20) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'NOMBRE DEL TIPO DE SANGRE',
  `OBS` varchar(255) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'OBSERVACIONES DEL REGISTRO',
  PRIMARY KEY (`ID_TIPO_SANGRE`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla proyectocitasmedicas.tipo_sangre: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `tipo_sangre` DISABLE KEYS */;
INSERT IGNORE INTO `tipo_sangre` (`ID_TIPO_SANGRE`, `NOMBBRE_TIPO_SANGRE`, `OBS`) VALUES
	(1, 'A+', 'A positivo'),
	(2, 'A-', 'A negativo');
/*!40000 ALTER TABLE `tipo_sangre` ENABLE KEYS */;

-- Volcando estructura para vista proyectocitasmedicas.total_citas_canceladas
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `total_citas_canceladas` (
	`CANCELADAS` BIGINT(21) NOT NULL
) ENGINE=MyISAM;

-- Volcando estructura para vista proyectocitasmedicas.total_clientes
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `total_clientes` (
	`TOTAL REGISTRADOS` BIGINT(21) NOT NULL
) ENGINE=MyISAM;

-- Volcando estructura para vista proyectocitasmedicas.total_perdida_cancelacion
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `total_perdida_cancelacion` (
	`TOTAL` DECIMAL(29,2) NULL
) ENGINE=MyISAM;

-- Volcando estructura para tabla proyectocitasmedicas.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `ID_USUARIO` int(11) NOT NULL AUTO_INCREMENT COMMENT 'NUMERO UNICO DE IDENTIFICACION DE USUARIO',
  `NOMBRE_USUARIO` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL COMMENT 'NOMBRE DE USUARIO UNICO',
  `CLAVE_ACCESO` varchar(100) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'CLAVE PARA ACCEDER AL SISTEMA',
  `ESTADO` int(1) NOT NULL COMMENT 'ESTADO ACTUAL DEL USUARIO',
  `ID_ROL` int(11) NOT NULL COMMENT 'ID DEL ROL EN EL SISTEMA',
  `FECHA_REGISTRO` date NOT NULL COMMENT 'FECHA DE REGISTRO',
  `IMG_PERFIL` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL COMMENT 'IAMGEN DEL PERFIL DEL USUARIO',
  PRIMARY KEY (`ID_USUARIO`),
  KEY `FK_USUARIOS_ROLES` (`ID_ROL`),
  CONSTRAINT `FK_USUARIOS_ROLES` FOREIGN KEY (`ID_ROL`) REFERENCES `roles` (`CODIGO_ROL`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla proyectocitasmedicas.usuarios: ~32 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT IGNORE INTO `usuarios` (`ID_USUARIO`, `NOMBRE_USUARIO`, `CLAVE_ACCESO`, `ESTADO`, `ID_ROL`, `FECHA_REGISTRO`, `IMG_PERFIL`) VALUES
	(1, 'lorenamelendez@gmail.com', '$2a$07$asxx54ahjppf45sd87a5audXfkHtDC4DhKPBsh2YrYWZX9jzpxg3e', 1, 1, '2021-03-20', 'views/img/1_596.png'),
	(2, 'hannamartinez@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auyrjblhzd9yy5NwB3It78w0BiAd7Crpa', 1, 2, '2021-03-21', 'views/img/2_811.jpg'),
	(4, 'mariajhosegarcia@gmail.com', '$2a$07$asxx54ahjppf45sd87a5au/styESZTpqxpFPzgJF99YaIo877LNdy', 1, 1, '2021-03-23', 'views/img/4_366.jpg'),
	(5, 'sandrapatricia@gmail.com', '$2a$07$asxx54ahjppf45sd87a5aub7LdtrTXnn.ZQdALsthndsluPeTbv.a', 1, 1, '2021-03-23', 'views/img/boxed-bg.jpg'),
	(6, 'andrezrivas@gmail.com', '$2a$07$asxx54ahjppf45sd87a5aumGrJhtGzdkOZndvh0TGU8FPe1.wQA3i', 1, 1, '2021-03-23', 'views/img/boxed-bg.jpg'),
	(9, 'luciaopera12@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auIwnQIoClpfPthOT1UehGSf4JJBlbm4y', 1, 1, '2021-03-23', 'views/img/boxed-bg.jpg'),
	(12, 'juan.salas@gmail.com', '$2a$07$asxx54ahjppf45sd87a5aua5EodiZFcJaOO1YpHjPwjEfCdXHEk6C', 0, 1, '2021-03-23', 'views/img/boxed-bg.jpg'),
	(13, 'leon@gmail.com', '$2a$07$asxx54ahjppf45sd87a5aua5EodiZFcJaOO1YpHjPwjEfCdXHEk6C', 1, 1, '2021-03-23', 'views/img/13_801.jpg'),
	(14, 'diana@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auC3pb4ToxZjdNYgW63UxMggr4pYKb.QK', 1, 3, '2021-03-23', 'views/img/boxed-bg.jpg'),
	(15, 'karla@gmail.com', '$2a$07$asxx54ahjppf45sd87a5au7h1SYmZx5dn51nPghKV7g9XuPyG01yC', 1, 2, '2021-03-23', 'views/img/15_512.jpg'),
	(17, 'pamela@gmail.com', '$2a$07$asxx54ahjppf45sd87a5aumPec5pk6nmd/suogR4DzgU/VVtg3VN.', 1, 3, '2021-03-24', 'views/img/boxed-bg.jpg'),
	(18, 'juana@gmail.com', '$2a$07$asxx54ahjppf45sd87a5audLvCTPs.RY4X5apSSFurhImbWj/ei36', 1, 3, '2021-03-24', 'views/img/boxed-bg.jpg'),
	(19, 'patricia@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auHCMlxkCdocZR/OZFzLdPr4XnlwS0B/y', 1, 3, '2021-03-24', 'views/img/boxed-bg.jpg'),
	(20, 'ricarda@gmail.com', '$2a$07$asxx54ahjppf45sd87a5au.Wad69Kkz4gW.E.qwncvh69wf786gka', 1, 3, '2021-03-24', 'views/img/boxed-bg.jpg'),
	(21, 'ricardo@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auEFXdYEANZek7lHFF2aRSp2kKfADSWUO', 1, 3, '2021-03-24', 'views/img/boxed-bg.jpg'),
	(22, 'monica@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auXHzNUn78B1ETK0REQ5Cg0W4cS/Hi6Om', 1, 3, '2021-03-24', 'views/img/boxed-bg.jpg'),
	(23, 'luciamariela@gmail.com', '$2a$07$asxx54ahjppf45sd87a5au0W1AJfTvRM81c0au0n4ymIViwY4UbOK', 1, 3, '2021-03-24', 'views/img/boxed-bg.jpg'),
	(24, 'tati@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auPJMk20hn/XSlICjU/L6KFaHEImiYYhO', 1, 3, '2021-03-24', 'views/img/user3-128x128.jpg'),
	(25, 'maria@gmail.com', '$2a$07$asxx54ahjppf45sd87a5au/styESZTpqxpFPzgJF99YaIo877LNdy', 1, 3, '2021-03-24', 'views/img/25_731.jpg'),
	(26, 'pamelaricarda@gmail.com', '$2a$07$asxx54ahjppf45sd87a5aumPec5pk6nmd/suogR4DzgU/VVtg3VN.', 1, 3, '2021-03-24', 'views/img/boxed-bg.jpg'),
	(27, 'luciamariana@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auu/OFjB9yXQrd.8XPXdnPIy9tbm/VjVS', 1, 3, '2021-03-24', 'views/img/boxed-bg.jpg'),
	(28, 'lucia123@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auGZEtGHuyZwm.Ur.FJvWLCql3nmsMbXy', 1, 3, '2021-03-25', 'views/img/boxed-bg.jpg'),
	(29, 'camila@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auSG63quiaQ92z8zKcfYdeJqIET11WbFO', 1, 3, '2021-03-25', 'views/img/boxed-bg.jpg'),
	(30, 'pamela1234@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auJRR6foEJ7ynpjisKtbiKJbvJsoQ8VPS', 1, 3, '2021-03-25', 'views/img/boxed-bg.jpg'),
	(31, 'maria12@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auMUUAXh.i.spmFAUev5D1d5IsEQMCmzm', 1, 3, '2021-03-25', 'views/img/boxed-bg.jpg'),
	(32, 'zunigac@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auKXKyZvAKM/PdVH.lg.8xMhZZSTXRwNe', 1, 3, '2021-03-25', 'views/img/boxed-bg.jpg'),
	(33, 'poncejuana@gmail.com', '$2a$07$asxx54ahjppf45sd87a5au.XCGyKqf895sqM/DdJrr3WkHSr7SIQ.', 1, 2, '2021-04-06', 'views/img/avatar5.png'),
	(34, 'sandrapp@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auC3pb4ToxZjdNYgW63UxMggr4pYKb.QK', 1, 1, '2021-04-11', 'views/img/boxed-bg.jpg'),
	(35, 'pola@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auvKj83U2q4zk4pg9muZH21T1z8XqHAKS', 1, 1, '2021-04-11', 'views/img/boxed-bg.jpg'),
	(36, 'martinaalcantara@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auYz4nfVJ7SBB/QwjOGXmwnCJm.qUo9S6', 1, 1, '2021-04-11', 'views/img/boxed-bg.jpg'),
	(37, 'gabisuarez@gmail.com', '$2a$07$asxx54ahjppf45sd87a5au3xWi.uYDA9rplziiI0TF8OU7cFIWLvi', 1, 3, '2021-04-12', 'views/img/avatar5.png'),
	(38, 'munguiagarcia@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auNMqO.cTC6d/djTasXuwdC7ixvR067OO', 1, 3, '2021-04-14', 'views/img/avatar5.png'),
	(39, 'juanareyes@gmail.com', '$2a$07$asxx54ahjppf45sd87a5audLvCTPs.RY4X5apSSFurhImbWj/ei36', 1, 2, '2021-04-24', 'views/img/avatar5.png'),
	(40, 'olga@gmail.com', '$2a$07$asxx54ahjppf45sd87a5au3smJr8cRlcTXVPjvMps3zTmjRGaUlLi', 1, 2, '2021-04-25', 'views/img/40_586.jpg'),
	(41, 'pedro@gmail.com', '$2a$07$asxx54ahjppf45sd87a5austaEoHG6c2Nsqiq7.UaM8US5nKVJ/IC', 1, 2, '2021-04-26', 'views/img/41_403.jpg'),
	(42, 'marcela@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auA6MjOEBXc8tRw24b086BFviDu6IcDpy', 1, 3, '2021-04-26', 'views/img/42_134.jpg'),
	(43, 'rubiop@webhealth.com', '$2a$07$asxx54ahjppf45sd87a5auaUbPe8OxtjYYnoM766PXIg4Od5Bhjmy', 1, 1, '2021-04-26', 'views/img/43_933.jpg'),
	(44, 'mariagarciacrea@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auC3pb4ToxZjdNYgW63UxMggr4pYKb.QK', 1, 1, '2021-04-27', 'views/img/44_103.png');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

-- Volcando estructura para vista proyectocitasmedicas.utilidad_total
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `utilidad_total` (
	`TOTAL` DECIMAL(29,2) NULL
) ENGINE=MyISAM;

-- Volcando estructura para vista proyectocitasmedicas.citas_pendientes
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `citas_pendientes`;
CREATE ALGORITHM=UNDEFINED DEFINER=`majo`@`localhost` SQL SECURITY DEFINER VIEW `citas_pendientes` AS select `proyectocitasmedicas`.`cita_medica`.`ID_CITA_MEDICA` AS `ID_CITA_MEDICA`,`proyectocitasmedicas`.`cita_medica`.`ID_CLIENTE` AS `ID_CLIENTE`,`proyectocitasmedicas`.`cita_medica`.`ID_MEDICO` AS `ID_MEDICO`,`proyectocitasmedicas`.`cita_medica`.`ID_ESPECIALIDAD` AS `ID_ESPECIALIDAD`,`proyectocitasmedicas`.`cita_medica`.`FECHA_CITA` AS `FECHA_CITA`,`proyectocitasmedicas`.`cita_medica`.`HORA_INICIO` AS `HORA_INICIO`,`proyectocitasmedicas`.`cita_medica`.`ID_ESTADO_CITA` AS `ID_ESTADO_CITA` from `proyectocitasmedicas`.`cita_medica` where ((`proyectocitasmedicas`.`cita_medica`.`ID_ESTADO_CITA` = '1') or (`proyectocitasmedicas`.`cita_medica`.`ID_ESTADO_CITA` = '3')) ;

-- Volcando estructura para vista proyectocitasmedicas.cita_diagnostico
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `cita_diagnostico`;
CREATE ALGORITHM=UNDEFINED DEFINER=`majo`@`localhost` SQL SECURITY DEFINER VIEW `cita_diagnostico` AS select `proyectocitasmedicas`.`cita_medica`.`ID_CITA_MEDICA` AS `ID_CITA_MEDICA`,`proyectocitasmedicas`.`cita_medica`.`ID_CLIENTE` AS `ID_CLIENTE`,`proyectocitasmedicas`.`expediente`.`NUM_EXPEDIENTE` AS `NUM_EXPEDIENTE`, persona.NOMBRE, persona.APELLIDO, `proyectocitasmedicas`.`cita_medica`.`ID_MEDICO` AS `ID_MEDICO`,`proyectocitasmedicas`.`cita_medica`.`ID_ESPECIALIDAD` AS `ID_ESPECIALIDAD`,`proyectocitasmedicas`.`cita_medica`.`FECHA_CITA` AS `FECHA_CITA`,`proyectocitasmedicas`.`cita_medica`.`HORA_INICIO` AS `HORA_INICIO`,`proyectocitasmedicas`.`detalle_consulta`.`ALTURA` AS `ALTURA`,`proyectocitasmedicas`.`detalle_consulta`.`PESO` AS `PESO`,`proyectocitasmedicas`.`detalle_consulta`.`TEMPERATURA` AS `TEMPERATURA`,`proyectocitasmedicas`.`detalle_consulta`.`DIAGNOSTICO_MEDICO` AS `DIAGNOSTICO_MEDICO`,`proyectocitasmedicas`.`detalle_consulta`.`RECETA_MEDICA` AS `RECETA_MEDICA` from `proyectocitasmedicas`.`cita_medica` join `proyectocitasmedicas`.`detalle_consulta` join `proyectocitasmedicas`.`expediente`, persona, cliente where ((`proyectocitasmedicas`.`cita_medica`.`ID_CITA_MEDICA` = `proyectocitasmedicas`.`detalle_consulta`.`ID_CITA_MEDICA`) and (`proyectocitasmedicas`.`cita_medica`.`ID_CLIENTE` = `proyectocitasmedicas`.`expediente`.`ID_CLIENTE`) and (`proyectocitasmedicas`.`cita_medica`.`ID_ESTADO_CITA` = '2') AND cliente.ID_CLIENTE = cita_medica.ID_CLIENTE AND persona.CODIGO_PERSONA = cliente.CODIGO_PERSONA) ;

-- Volcando estructura para vista proyectocitasmedicas.consultar_citas
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `consultar_citas`;
CREATE ALGORITHM=UNDEFINED DEFINER=`majo`@`localhost` SQL SECURITY DEFINER VIEW `consultar_citas` AS SELECT `especialidad`.`ID_ESPECIALIDAD` AS `ID_ESPECIALIDAD`, `especialidad`.`NOMBRE_ESPECIALIDAD` AS `NOMBRE_ESPECIALIDAD`, `medico`.`ID_MEDICO` AS `ID_MEDICO`, `persona`.`NOMBRE` AS `NOMBRE`, `persona`.`APELLIDO` AS `APELLIDO`, `salas`.`ID_SALA_MEDICA` AS `ID_SALA_MEDICA`, `salas`.`NUMERO` AS `NUMERO`, `salas`.`EDIFICIO` AS `EDIFICIO`, `salas`.`DETALLE_UBICACION` AS `DETALLE_UBICACION` FROM ((((`especialidad` join `persona`) join `medico`) join `usuarios`) join `salas`) WHERE ((`especialidad`.`ID_ESPECIALIDAD` = `medico`.`ID_ESPECIALIDAD`) AND (`medico`.`ID_PERSONA` = `persona`.`CODIGO_PERSONA`) AND (`medico`.`ID_USUARIO` = `usuarios`.`ID_USUARIO`) AND (`medico`.`ID_SALA_MEDICA` = `salas`.`ID_SALA_MEDICA`)) ;

-- Volcando estructura para vista proyectocitasmedicas.consultar_enfermedad
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `consultar_enfermedad`;
CREATE ALGORITHM=UNDEFINED DEFINER=`majo`@`localhost` SQL SECURITY DEFINER VIEW `consultar_enfermedad` AS SELECT enfermedad_paciente.NUM_EXPEDIENTE, enfermedades_base.NOMBRE_ENFERMEDAD_BASE FROM enfermedad_paciente, enfermedades_base 
WHERE enfermedad_paciente.CODIGO_ENFERMEDAD_BASE = enfermedades_base.CODIGO_ENFERMEDAD_BASE ;

-- Volcando estructura para vista proyectocitasmedicas.consulta_especialidad_cita
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `consulta_especialidad_cita`;
CREATE ALGORITHM=UNDEFINED DEFINER=`majo`@`localhost` SQL SECURITY DEFINER VIEW `consulta_especialidad_cita` AS select distinct `proyectocitasmedicas`.`especialidad`.`ID_ESPECIALIDAD` AS `ID_ESPECIALIDAD`,`proyectocitasmedicas`.`especialidad`.`NOMBRE_ESPECIALIDAD` AS `NOMBRE_ESPECIALIDAD` from `proyectocitasmedicas`.`especialidad` join `proyectocitasmedicas`.`medico` join `proyectocitasmedicas`.`persona` join `proyectocitasmedicas`.`salas` join `proyectocitasmedicas`.`horario` where ((`proyectocitasmedicas`.`especialidad`.`ID_ESPECIALIDAD` = `proyectocitasmedicas`.`medico`.`ID_ESPECIALIDAD`) and (`proyectocitasmedicas`.`persona`.`CODIGO_PERSONA` = `proyectocitasmedicas`.`medico`.`ID_PERSONA`) and (`proyectocitasmedicas`.`medico`.`ID_SALA_MEDICA` = `proyectocitasmedicas`.`salas`.`ID_SALA_MEDICA`) and (`proyectocitasmedicas`.`horario`.`ID_MEDICO` = `proyectocitasmedicas`.`medico`.`ID_MEDICO`)) ;

-- Volcando estructura para vista proyectocitasmedicas.consulta_perfil
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `consulta_perfil`;
CREATE ALGORITHM=UNDEFINED DEFINER=`majo`@`localhost` SQL SECURITY DEFINER VIEW `consulta_perfil` AS SELECT `persona`.`CODIGO_PERSONA` AS `CODIGO_PERSONA`, `persona`.`NOMBRE` AS `NOMBRE`, `persona`.`APELLIDO` AS `APELLIDO`, `persona`.`TIPO_DOCUMENTO` AS `TIPO_DOCUMENTO`, `persona`.`NO_DOCUMENTO` AS `NO_DOCUMENTO`, `persona`.`PAIS` AS `PAIS`, `persona`.`FECHA_NACIMIENTO` AS `FECHA_NACIMIENTO`, `persona`.`SEXO` AS `SEXO`, `persona`.`DOMICILIO` AS `DOMICILIO`, `persona`.`TELEFONO` AS `TELEFONO`, `persona`.`CELULAR` AS `CELULAR`, `persona`.`EMAIL` AS `EMAIL`, `persona`.`TIPO_SANGRE` AS `TIPO_SANGRE`, `usuarios`.`ID_USUARIO` AS `ID_USUARIO`, `usuarios`.`NOMBRE_USUARIO` AS `NOMBRE_USUARIO`, `usuarios`.`CLAVE_ACCESO` AS `CLAVE_ACCESO`, `usuarios`.`ESTADO` AS `ESTADO`, `usuarios`.`ID_ROL` AS `ID_ROL`, `usuarios`.`FECHA_REGISTRO` AS `FECHA_REGISTRO`, `usuarios`.`IMG_PERFIL` AS `IMG_PERFIL` FROM (`persona` join `usuarios`) WHERE (`persona`.`EMAIL` = `usuarios`.`NOMBRE_USUARIO`) ;

-- Volcando estructura para vista proyectocitasmedicas.fecha_citas
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `fecha_citas`;
CREATE ALGORITHM=UNDEFINED DEFINER=`majo`@`localhost` SQL SECURITY DEFINER VIEW `fecha_citas` AS select cita_medica.FECHA_CITA AS "FECHA", COUNT(`proyectocitasmedicas`.`especialidad`.`PRECIO_CITA`) AS `TOTAL` from `proyectocitasmedicas`.`especialidad` join `proyectocitasmedicas`.`cita_medica` where ((`proyectocitasmedicas`.`especialidad`.`ID_ESPECIALIDAD` = `proyectocitasmedicas`.`cita_medica`.`ID_ESPECIALIDAD`) and (`proyectocitasmedicas`.`cita_medica`.`ID_ESTADO_CITA` = '2')) group by cita_medica.FECHA_CITA order by sum(`proyectocitasmedicas`.`especialidad`.`PRECIO_CITA`) desc ;

-- Volcando estructura para vista proyectocitasmedicas.ganancia_especialidad
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `ganancia_especialidad`;
CREATE ALGORITHM=UNDEFINED DEFINER=`majo`@`localhost` SQL SECURITY DEFINER VIEW `ganancia_especialidad` AS SELECT cita_medica.ID_ESPECIALIDAD AS "ID", especialidad.NOMBRE_ESPECIALIDAD AS "NOMBRE" , SUM(especialidad.PRECIO_CITA) AS "TOTAL" FROM especialidad, cita_medica WHERE especialidad.ID_ESPECIALIDAD = cita_medica.ID_ESPECIALIDAD AND cita_medica.ID_ESTADO_CITA = "2" GROUP BY especialidad.ID_ESPECIALIDAD, especialidad.NOMBRE_ESPECIALIDAD ORDER BY 3 DESC ;

-- Volcando estructura para vista proyectocitasmedicas.historial_citas_medicas
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `historial_citas_medicas`;
CREATE ALGORITHM=UNDEFINED DEFINER=`majo`@`localhost` SQL SECURITY DEFINER VIEW `historial_citas_medicas` AS SELECT DISTINCT
    cita_medica.ID_CITA_MEDICA,
    cita_medica.ID_CLIENTE,
    cita_medica.ID_MEDICO,
    cita_medica.ID_ESPECIALIDAD,
    cita_medica.FECHA_CITA,
    cita_medica.HORA_INICIO,
    cita_medica.ID_ESTADO_CITA
FROM
    cita_medica
WHERE
cita_medica.ID_ESTADO_CITA = '2' OR cita_medica.ID_ESTADO_CITA = '4' ;

-- Volcando estructura para vista proyectocitasmedicas.horario_medico
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `horario_medico`;
CREATE ALGORITHM=UNDEFINED DEFINER=`majo`@`localhost` SQL SECURITY DEFINER VIEW `horario_medico` AS SELECT especialidad.ID_ESPECIALIDAD, especialidad.NOMBRE_ESPECIALIDAD, especialidad.DURACION_CITA, especialidad.PRECIO_CITA, medico.ID_MEDICO, persona.NOMBRE, persona.APELLIDO, salas.ID_SALA_MEDICA, salas.NUMERO, salas.EDIFICIO, salas.DETALLE_UBICACION, horario.HORA_ENTRADA, horario.HORA_SALIDA FROM especialidad, medico, persona, salas, horario WHERE especialidad.ID_ESPECIALIDAD = medico.ID_ESPECIALIDAD AND
persona.CODIGO_PERSONA = medico.ID_PERSONA AND medico.ID_SALA_MEDICA = salas.ID_SALA_MEDICA AND horario.ID_MEDICO = medico.ID_MEDICO ;

-- Volcando estructura para vista proyectocitasmedicas.inicio_especialidad
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `inicio_especialidad`;
CREATE ALGORITHM=UNDEFINED DEFINER=`majo`@`localhost` SQL SECURITY DEFINER VIEW `inicio_especialidad` AS SELECT especialidad.ID_ESPECIALIDAD, especialidad.NOMBRE_ESPECIALIDAD, especialidad.DESCRIPCION FROM consulta_especialidad_cita, especialidad WHERE
especialidad.DESCRIPCION <> "" AND especialidad.ID_ESPECIALIDAD = consulta_especialidad_cita.ID_ESPECIALIDAD ;

-- Volcando estructura para vista proyectocitasmedicas.login_usuarios
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `login_usuarios`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `login_usuarios` AS SELECT `persona`.`CODIGO_PERSONA` AS `CODIGO_PERSONA`, `persona`.`NOMBRE` AS `NOMBRE`, `persona`.`APELLIDO` AS `APELLIDO`, `persona`.`EMAIL` AS `EMAIL`, `usuarios`.`ID_USUARIO` AS `ID_USUARIO`, `usuarios`.`NOMBRE_USUARIO` AS `NOMBRE_USUARIO`, `usuarios`.`CLAVE_ACCESO` AS `CLAVE_ACCESO`, `usuarios`.`ESTADO` AS `ESTADO`, `usuarios`.`ID_ROL` AS `ID_ROL`, `usuarios`.`IMG_PERFIL` AS `IMG_PERFIL` FROM (`persona` join `usuarios`) WHERE (`persona`.`EMAIL` = `usuarios`.`NOMBRE_USUARIO`) ;

-- Volcando estructura para vista proyectocitasmedicas.medico_registrado
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `medico_registrado`;
CREATE ALGORITHM=UNDEFINED DEFINER=`majo`@`localhost` SQL SECURITY DEFINER VIEW `medico_registrado` AS SELECT `medico`.`ID_MEDICO` AS `ID_MEDICO`, `medico`.`ID_USUARIO` AS `ID_USUARIO`, `medico`.`ID_PERSONA` AS `ID_PERSONA`, `medico`.`ID_ESPECIALIDAD` AS `ID_ESPECIALIDAD`, `medico`.`ID_SALA_MEDICA` AS `ID_SALA_MEDICA`, `persona`.`CODIGO_PERSONA` AS `CODIGO_PERSONA`, `persona`.`NOMBRE` AS `NOMBRE`, `persona`.`APELLIDO` AS `APELLIDO`, `persona`.`TIPO_DOCUMENTO` AS `TIPO_DOCUMENTO`, `persona`.`NO_DOCUMENTO` AS `NO_DOCUMENTO`, `persona`.`PAIS` AS `PAIS`, `persona`.`FECHA_NACIMIENTO` AS `FECHA_NACIMIENTO`, `persona`.`SEXO` AS `SEXO`, `persona`.`DOMICILIO` AS `DOMICILIO`, `persona`.`TELEFONO` AS `TELEFONO`, `persona`.`CELULAR` AS `CELULAR`, `persona`.`EMAIL` AS `EMAIL`, `persona`.`TIPO_SANGRE` AS `TIPO_SANGRE`, `usuarios`.`ID_ROL` AS `ID_ROL`, `usuarios`.`IMG_PERFIL` AS `IMG_PERFIL`, `usuarios`.`FECHA_REGISTRO` AS `FECHA_REGISTRO` FROM ((`persona` join `usuarios`) join `medico`) WHERE ((`persona`.`CODIGO_PERSONA` = `medico`.`ID_PERSONA`) AND (`usuarios`.`ID_USUARIO` = `medico`.`ID_USUARIO`)) ;

-- Volcando estructura para vista proyectocitasmedicas.numero_citas_especialidad
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `numero_citas_especialidad`;
CREATE ALGORITHM=UNDEFINED DEFINER=`majo`@`localhost` SQL SECURITY DEFINER VIEW `numero_citas_especialidad` AS select `proyectocitasmedicas`.`cita_medica`.`ID_ESPECIALIDAD` AS `ID`,`proyectocitasmedicas`.`especialidad`.`NOMBRE_ESPECIALIDAD` AS `NOMBRE`,COUNT(`proyectocitasmedicas`.`especialidad`.`PRECIO_CITA`) AS `TOTAL` from `proyectocitasmedicas`.`especialidad` join `proyectocitasmedicas`.`cita_medica` where ((`proyectocitasmedicas`.`especialidad`.`ID_ESPECIALIDAD` = `proyectocitasmedicas`.`cita_medica`.`ID_ESPECIALIDAD`) and (`proyectocitasmedicas`.`cita_medica`.`ID_ESTADO_CITA` = '2')) group by `proyectocitasmedicas`.`especialidad`.`ID_ESPECIALIDAD`,`proyectocitasmedicas`.`especialidad`.`NOMBRE_ESPECIALIDAD` order by sum(`proyectocitasmedicas`.`especialidad`.`PRECIO_CITA`) desc ;

-- Volcando estructura para vista proyectocitasmedicas.perdidas_por_cancelacion
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `perdidas_por_cancelacion`;
CREATE ALGORITHM=UNDEFINED DEFINER=`majo`@`localhost` SQL SECURITY DEFINER VIEW `perdidas_por_cancelacion` AS select `proyectocitasmedicas`.`cita_medica`.`ID_ESPECIALIDAD` AS `ID`,`proyectocitasmedicas`.`especialidad`.`NOMBRE_ESPECIALIDAD` AS `NOMBRE`,sum(`proyectocitasmedicas`.`especialidad`.`PRECIO_CITA`) AS `TOTAL` from `proyectocitasmedicas`.`especialidad` join `proyectocitasmedicas`.`cita_medica` where ((`proyectocitasmedicas`.`especialidad`.`ID_ESPECIALIDAD` = `proyectocitasmedicas`.`cita_medica`.`ID_ESPECIALIDAD`) and (`proyectocitasmedicas`.`cita_medica`.`ID_ESTADO_CITA` = '4')) group by `proyectocitasmedicas`.`especialidad`.`ID_ESPECIALIDAD`,`proyectocitasmedicas`.`especialidad`.`NOMBRE_ESPECIALIDAD` order by sum(`proyectocitasmedicas`.`especialidad`.`PRECIO_CITA`) desc ;

-- Volcando estructura para vista proyectocitasmedicas.persona_usuario
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `persona_usuario`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `persona_usuario` AS SELECT `persona`.`CODIGO_PERSONA` AS `CODIGO_PERSONA`, `usuarios`.`ID_USUARIO` AS `ID_USUARIO`, `persona`.`EMAIL` AS `EMAIL` FROM (`persona` join `usuarios`) WHERE (`persona`.`EMAIL` = `usuarios`.`NOMBRE_USUARIO`) ;

-- Volcando estructura para vista proyectocitasmedicas.reporte_cliente_registro
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `reporte_cliente_registro`;
CREATE ALGORITHM=UNDEFINED DEFINER=`majo`@`localhost` SQL SECURITY DEFINER VIEW `reporte_cliente_registro` AS SELECT cliente.ID_CLIENTE, persona.NOMBRE, persona.APELLIDO, persona.email, usuarios.FECHA_REGISTRO FROM persona, usuarios, cliente WHERE cliente.CODIGO_PERSONA = persona.CODIGO_PERSONA AND cliente.ID_USUARIO = usuarios.ID_USUARIO AND persona.EMAIL = usuarios.NOMBRE_USUARIO AND usuarios.ESTADO = 1 ;

-- Volcando estructura para vista proyectocitasmedicas.reporte_medico_especialidad
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `reporte_medico_especialidad`;
CREATE ALGORITHM=UNDEFINED DEFINER=`majo`@`localhost` SQL SECURITY DEFINER VIEW `reporte_medico_especialidad` AS SELECT medico.ID_MEDICO, persona.NOMBRE, persona.APELLIDO, especialidad.NOMBRE_ESPECIALIDAD FROM medico, especialidad, persona WHERE medico.ID_ESPECIALIDAD = especialidad.ID_ESPECIALIDAD AND medico.ID_PERSONA = persona.CODIGO_PERSONA ;

-- Volcando estructura para vista proyectocitasmedicas.salas_medico
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `salas_medico`;
CREATE ALGORITHM=UNDEFINED DEFINER=`majo`@`localhost` SQL SECURITY DEFINER VIEW `salas_medico` AS SELECT medico.ID_MEDICO, salas.ID_SALA_MEDICA, salas.NUMERO, salas.EDIFICIO, salas.DETALLE_UBICACION FROM medico, salas WHERE salas.ID_SALA_MEDICA = medico.ID_SALA_MEDICA ;

-- Volcando estructura para vista proyectocitasmedicas.total_citas_canceladas
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `total_citas_canceladas`;
CREATE ALGORITHM=UNDEFINED DEFINER=`majo`@`localhost` SQL SECURITY DEFINER VIEW `total_citas_canceladas` AS SELECT COUNT(cita_medica.ID_CITA_MEDICA) AS "CANCELADAS" FROM cita_medica WHERE cita_medica.ID_ESTADO_CITA = '4' ;

-- Volcando estructura para vista proyectocitasmedicas.total_clientes
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `total_clientes`;
CREATE ALGORITHM=UNDEFINED DEFINER=`majo`@`localhost` SQL SECURITY DEFINER VIEW `total_clientes` AS SELECT COUNT(cliente.ID_CLIENTE) AS "TOTAL REGISTRADOS" FROM cliente, usuarios WHERE cliente.ID_USUARIO = usuarios.ID_USUARIO AND usuarios.ESTADO = 1 ;

-- Volcando estructura para vista proyectocitasmedicas.total_perdida_cancelacion
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `total_perdida_cancelacion`;
CREATE ALGORITHM=UNDEFINED DEFINER=`majo`@`localhost` SQL SECURITY DEFINER VIEW `total_perdida_cancelacion` AS select sum(`proyectocitasmedicas`.`especialidad`.`PRECIO_CITA`) AS `TOTAL` from `proyectocitasmedicas`.`especialidad` join `proyectocitasmedicas`.`cita_medica` join `proyectocitasmedicas`.`medico` where ((`proyectocitasmedicas`.`cita_medica`.`ID_MEDICO` = `proyectocitasmedicas`.`medico`.`ID_MEDICO`) and (`proyectocitasmedicas`.`medico`.`ID_ESPECIALIDAD` = `proyectocitasmedicas`.`especialidad`.`ID_ESPECIALIDAD`) and (`proyectocitasmedicas`.`cita_medica`.`ID_ESTADO_CITA` = '4')) ;

-- Volcando estructura para vista proyectocitasmedicas.utilidad_total
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `utilidad_total`;
CREATE ALGORITHM=UNDEFINED DEFINER=`majo`@`localhost` SQL SECURITY DEFINER VIEW `utilidad_total` AS SELECT SUM(especialidad.PRECIO_CITA) AS "TOTAL" FROM especialidad, cita_medica, medico WHERE cita_medica.ID_MEDICO = medico.ID_MEDICO AND medico.ID_ESPECIALIDAD = especialidad.ID_ESPECIALIDAD AND cita_medica.ID_ESTADO_CITA = "2" ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
