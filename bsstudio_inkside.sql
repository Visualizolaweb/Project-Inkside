-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 11-04-2017 a las 12:31:06
-- Versión del servidor: 5.5.54-cll
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `bsstudio_inkside`
--
CREATE DATABASE IF NOT EXISTS `bsstudio_inkside` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `bsstudio_inkside`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inkside_acceso`
--

CREATE TABLE IF NOT EXISTS `inkside_acceso` (
  `acc_token` varchar(255) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Token generado y encriptado. este token se debe guardar en los equipos locales a traves de sessionStorage o localStorage y se debe comparar en cada conexion. ',
  `poet_codigo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `acc_password` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `acc_session` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `acc_intento_fallido` varchar(1) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Se le debe contabilizar maximo 3 intentos\n',
  `acc_estado` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Estados: Conectado, Desconectado',
  `acc_primera_vez` varchar(2) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Si ingresa la primera vez se realiza un demo tour\n',
  `acc_pregunta_1` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Respuesta de seguridad\n',
  `acc_pregunta_2` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Respuesta de seguridad\n',
  `acc_pregunta_3` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Respuesta de seguridad\n',
  `acc_pregunta_4` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Respuesta de seguridad\n',
  `acc_ultima_conexion` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`acc_token`),
  KEY `fk_inkside_acceso_inkside_poetas1_idx` (`poet_codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `inkside_acceso`
--

INSERT INTO `inkside_acceso` (`acc_token`, `poet_codigo`, `acc_password`, `acc_session`, `acc_intento_fallido`, `acc_estado`, `acc_primera_vez`, `acc_pregunta_1`, `acc_pregunta_2`, `acc_pregunta_3`, `acc_pregunta_4`, `acc_ultima_conexion`) VALUES
('206120164', '556803063', '$2y$10$lVnGgQrqekFkgpGNBktnxu02H518AwWQC6roRnNnsRGgXeaqp33Nm', '108.162.210.236', '5', 'Activo', 'Si', NULL, NULL, NULL, NULL, '00:54:40'),
('23842956', '366373250', '$2y$10$Gb8a1EjZ1XesC//hzVAAxOLa/pgD9O4nf5IEJljLcd4vktca.jBpi', '108.162.210.236', '1', 'Activo', 'Si', NULL, NULL, NULL, NULL, '2016-03-12 04:07:13'),
('31193396', '646598312', '$2y$10$jMnlca/H6dD47WpapYG3v.hI2Fa2iejQouSy5ynAVN4rB17.o6/Lq', '108.162.237.164', '0', 'Activo', 'Si', NULL, NULL, NULL, NULL, '2016-03-12 04:07:13'),
('625783980', '511827948', '$2y$10$tPz76gZ7wHx1oCIORs5c6e/ClAoFqQHowq29iYH9YuqLFZnMxTPby', '108.162.210.236', '5', 'Activo', 'Si', NULL, NULL, NULL, NULL, '01:00:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inkside_categoriaPublicacion`
--

CREATE TABLE IF NOT EXISTS `inkside_categoriaPublicacion` (
  `catePub_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `catePub_nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `catePub_imagen` longtext COLLATE utf8_spanish_ci,
  `catePub_descripcion` longtext COLLATE utf8_spanish_ci,
  PRIMARY KEY (`catePub_codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Esta tabla muestra las categorias relacionadas a: POETAS, ARTICULOS, NOTICIAS Y EVENTOS' AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `inkside_categoriaPublicacion`
--

INSERT INTO `inkside_categoriaPublicacion` (`catePub_codigo`, `catePub_nombre`, `catePub_imagen`, `catePub_descripcion`) VALUES
(1, 'Nombre categoria', '../view/assets/images/perfil/img_default.png', 'No Aplica'),
(2, 'prueba', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inkside_ciudad`
--

CREATE TABLE IF NOT EXISTS `inkside_ciudad` (
  `ciu_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `ciu_nombre` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `dep_codigo` int(11) NOT NULL,
  PRIMARY KEY (`ciu_codigo`),
  KEY `fk_inkside_ciudad_inkside_departamento1_idx` (`dep_codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `inkside_ciudad`
--

INSERT INTO `inkside_ciudad` (`ciu_codigo`, `ciu_nombre`, `dep_codigo`) VALUES
(1, 'Riohacha', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inkside_departamento`
--

CREATE TABLE IF NOT EXISTS `inkside_departamento` (
  `dep_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `dep_nombre` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `pais_codigo` int(11) NOT NULL,
  PRIMARY KEY (`dep_codigo`),
  KEY `fk_inkside_departamento_inkside_pais1_idx` (`pais_codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `inkside_departamento`
--

INSERT INTO `inkside_departamento` (`dep_codigo`, `dep_nombre`, `pais_codigo`) VALUES
(2, 'Quindio', 1),
(3, 'Guajira', 1),
(4, 'data', 2),
(5, 'gtgtgt', 3),
(6, 'erer', 1),
(7, 'No se', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inkside_etiquetas`
--

CREATE TABLE IF NOT EXISTS `inkside_etiquetas` (
  `etiq_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `etiq_nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `etiq_color` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`etiq_codigo`),
  UNIQUE KEY `etiq_nombre_UNIQUE` (`etiq_nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inkside_intereses`
--

CREATE TABLE IF NOT EXISTS `inkside_intereses` (
  `inte_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `poet_codigo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `catePub_codigo` int(11) NOT NULL,
  PRIMARY KEY (`inte_codigo`),
  KEY `fk_inkside_preferencias_inkside_poetas_idx` (`poet_codigo`),
  KEY `fk_inkside_preferencias_inkside_categoriaPoemas1_idx` (`catePub_codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='La tabla preferencias es donde se almacenan los gustos del poeta basado en las categorias de los poetas que el sigue. ' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inkside_pagina`
--

CREATE TABLE IF NOT EXISTS `inkside_pagina` (
  `pag_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `pag_nombre` varchar(105) COLLATE utf8_spanish_ci NOT NULL COMMENT 'El titulo del modulo',
  `pag_menu` varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Este campo muestra el nombre que va a parecer en el menu del sistema',
  `pag_icon` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pag_seccion` varchar(105) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'main' COMMENT 'Si la pagina hace parte de alguna seccion como submenu, de lo contrario la seccion principal seria main',
  PRIMARY KEY (`pag_codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inkside_pais`
--

CREATE TABLE IF NOT EXISTS `inkside_pais` (
  `pais_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `pais_prefijo` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pais_nombre` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `pais_idioma` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pais_indicativo` int(11) DEFAULT NULL,
  PRIMARY KEY (`pais_codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `inkside_pais`
--

INSERT INTO `inkside_pais` (`pais_codigo`, `pais_prefijo`, `pais_nombre`, `pais_idioma`, `pais_indicativo`) VALUES
(1, 'CO', 'COLOMBIA', NULL, NULL),
(2, '3', 'sdf', 'dfg', 456),
(3, '0', 'Colombia', 'Español', 57);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inkside_poetas`
--

CREATE TABLE IF NOT EXISTS `inkside_poetas` (
  `poet_codigo` varchar(255) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Todos los codigos deben ser generados por el sistema (no deben ser autoincremental). ',
  `poet_nombre` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `poet_apellido` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `poet_nick` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `poet_email` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `poet_foto` longtext COLLATE utf8_spanish_ci,
  `poet_fecha_nac` date DEFAULT NULL,
  `poet_sexo` varchar(2) COLLATE utf8_spanish_ci DEFAULT NULL,
  `poet_celular` int(11) DEFAULT NULL,
  `poet_descripcion` longblob,
  `poet_estado` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `poet_fecha_creacion` date DEFAULT NULL,
  `ciu_codigo` int(11) NOT NULL,
  `rol_codigo` int(11) NOT NULL,
  PRIMARY KEY (`poet_codigo`),
  UNIQUE KEY `poet_nick_UNIQUE` (`poet_nick`),
  KEY `fk_inkside_poetas_inkside_ciudad1_idx` (`ciu_codigo`),
  KEY `fk_inkside_poetas_inskide_roles1_idx` (`rol_codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `inkside_poetas`
--

INSERT INTO `inkside_poetas` (`poet_codigo`, `poet_nombre`, `poet_apellido`, `poet_nick`, `poet_email`, `poet_foto`, `poet_fecha_nac`, `poet_sexo`, `poet_celular`, `poet_descripcion`, `poet_estado`, `poet_fecha_creacion`, `ciu_codigo`, `rol_codigo`) VALUES
('110143486', 'Jhon', 'Taborda', 'Bernardo', 'bernardp@gmail', 'img_default.png', '2017-04-01', '2', 2147483647, 0x4e6f2041706c696361, 'Espera', '2017-04-08', 1, 1),
('118322754', 'a', 'a', 'adddd', 'a', 'img_default.png', '1998-06-05', '2', 234567, 0x647266746779, 'Espera', '2017-02-27', 1, 1),
('130078125', 'Andrea', 'V', 'Andrea.user', 'andrea@gmail.com', 'imagen_20170404-18131011518.jpg', '2017-04-01', '2', 2147483647, 0x4e6f2041706c696361, 'Espera', '2017-04-04', 1, 1),
('14650853', 'Jhon', 'Taborda', 'jhon_userwewewe', 'jf29@misena.edu.co', 'img_default.png', '2017-04-01', '2', 2147483647, 0x4e6f2041706c696361, 'Activo', '2017-04-08', 1, 1),
('161334228', 'Gloria', 'Ramirez', 'gloriaa_user', 'gloria@gmail', 'img_default.png', '2017-04-01', '2', 2147483647, 0x4e6f2041706c696361, 'Activo', '2017-04-08', 1, 1),
('227938843', 'SENA', 'Colombia', 'sena_user', 'sena@sena.edu.co', 'imagen_20170328-22245916481.jpg', '0000-00-00', '2', 2147483647, 0x4e6f2041706c696361, 'Espera', '2017-03-28', 1, 7),
('27134254', 'Jhon', 'Taborda', 'fredyy_userr', 'jf29@misena.edu.co', 'img_default.png', '2017-04-01', '2', 2147483647, 0x4e6f2041706c696361, 'Activo', '2017-04-08', 1, 1),
('273257446', 'Jhon', 'Taborda', 'kikiggggg', 'kiki', 'img_default.png', '2017-04-01', '1', 2147483647, 0x4e6f2041706c696361, 'Espera', '2017-04-08', 1, 1),
('27548217', 'Fernando', 'Usuga', 'fernanouser', 'fernando@misena.edu.co', 'imagen_20170404-1807134065.jpg', '0000-00-00', '2', 2147483647, 0x4e6f2041706c696361, 'Espera', '2017-04-04', 1, 1),
('277412855', 'uxcode', 'valen', 'uxcode', 'guivalen@gmail.com', 'img_default.png', '2017-04-20', '2', 2147483647, 0x7361646164617364, 'Espera', '2017-04-08', 1, 1),
('277899170', 'Monica', 'Herrera', 'monica_user', 'monica@gmail.com', 'imagen_20170328-22354826740.jpg', '0000-00-00', '1', 2147483647, 0x4e6f2041706c696361, 'Activo', '2017-03-28', 1, 7),
('302536011', 'Jhon', 'Taborda', 'jhon_usereeee', 'fdvdvd@drgvdrgv', 'Imagen::default()', '2017-04-11', '2', 23456, 0x4e6f2041706c696361, 'Espera', '2017-04-08', 1, 1),
('3350830', 'Fredy', 'Gomez', 'gomez_user', 'fredy@gmail.com', 'img_default.png', '1998-07-03', '2', 234567, 0x4e6f20686179, 'Espera', '2017-02-27', 1, 1),
('349122830', 'Jhon', 'Taborda', 'jhon_userererer', 'drgb@dtg', 'img_default.png', '2017-04-01', '2', 2147483647, 0x4e6f2041706c696361, 'Espera', '2017-04-08', 1, 1),
('366373250', 'Javier', 'Areiza', 'javier_user', 'jf29@misena.edu.co', 'img_default.png', '2017-04-01', '2', 2147483647, 0x4e6f2041706c696361, 'Activo', '2017-04-08', 1, 1),
('387872314', 'Hernan', 'H', 'hernan_user', 'hernan@gmail', 'img_default.png', '2017-04-01', '2', 2147483647, 0x4e6f2041706c696361, 'Activo', '2017-04-08', 1, 1),
('421828839', 'Guillermo', 'Valencia', 'UX-Code', 'glvalencia51@misena.edu.co', 'img_default.png', '2017-04-25', '2', 2147483647, 0x73646673667366736466, 'Activo', '2017-04-08', 1, 1),
('441138939', 'Alfredo', 'A', 'alfredo_u', 'jf29@misena.edu.co', 'img_default.png', '2017-04-01', '2', 234567, 0x4e6f2041706c696361, 'Espera', '2017-04-08', 1, 1),
('445343574', 'Jhon', 'Taborda', 'fredyy_user', 'jf29@misena.edu.co', 'img_default.png', '2017-04-01', '2', 2147483647, 0x4e6f2041706c696361, 'Espera', '2017-04-08', 1, 1),
('448806110', 'Jhon', 'Arrollave', 'jhon_userioio', 'jf29@misena.edu.co', 'img_default.png', '2017-04-01', '2', 2147483647, 0x4e6f2041706c696361, 'Activo', '2017-04-08', 1, 1),
('497708130', 'Jhon', 'Taborda', 'hyhyhy', 'fdvdvd@drgvdrgv', 'Imagen::default()', '2017-04-11', '2', 23456, 0x4e6f2041706c696361, 'Espera', '2017-04-08', 1, 1),
('511827948', 'Jaider', 'T', 'jaider_userr', 'jf29@misena.edu.co', 'img_default.png', '2017-04-08', '2', 234567, 0x4e6f2041706c696361, 'Bloqueado', '2017-04-11', 1, 1),
('556803063', 'Jaime', 'Barrientos', 'jaimeb_user', 'jf29@misena.edu.co', 'img_default.png', '2017-04-01', '2', 2147483647, 0x4e6f2041706c696361, 'Bloqueado', '2017-04-08', 1, 1),
('646598312', 'Claudia ', 'Giraldo', 'claom', 'gvalenciam@sena.edu.co', 'img_default.png', '2017-04-19', '1', 23344, 0x4e6f2041706c696361, 'Activo', '2017-04-09', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inkside_publicaciones`
--

CREATE TABLE IF NOT EXISTS `inkside_publicaciones` (
  `pub_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `poet_codigo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `pub_fechaPublicacion` date NOT NULL,
  `pub_imgPortada` longtext COLLATE utf8_spanish_ci,
  `pub_titulo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `pub_contenido` text COLLATE utf8_spanish_ci NOT NULL,
  `pub_audio` longtext COLLATE utf8_spanish_ci,
  `pub_estadoRevision` varchar(100) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Por Revisar' COMMENT 'Si la publicacion esta aprobada o rechazada',
  `pub_estado` varchar(45) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Borrador' COMMENT 'Si la publicacion esta publicada, suspendida o en borrador\n',
  `catePub_codigo` int(11) NOT NULL,
  PRIMARY KEY (`pub_codigo`),
  KEY `fk_inkside_publicaciones_inkside_categoriaPublicacion1_idx` (`catePub_codigo`),
  KEY `fk_inkside_publicaciones_inkside_poetas1_idx` (`poet_codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `inkside_publicaciones`
--

INSERT INTO `inkside_publicaciones` (`pub_codigo`, `poet_codigo`, `pub_fechaPublicacion`, `pub_imgPortada`, `pub_titulo`, `pub_contenido`, `pub_audio`, `pub_estadoRevision`, `pub_estado`, `catePub_codigo`) VALUES
(1, '3350830', '2017-03-13', '../view/assets/images/perfil/img_default.png', '1', '1', '', '', '', 1),
(2, '3350830', '2017-03-13', '../view/assets/images/perfil/img_default.png', 'Uno', 'Todooooooooooooooo', '', '', '', 1),
(3, '118322754', '2017-03-13', '../view/assets/images/perfil/img_default.png', 'trtr', '<p>dede</p>\r\n', '', '', '', 1),
(4, '3350830', '2017-04-03', '../view/assets/images/perfil/img_default.png', 'PruebaP', '<p>No aplica</p>\r\n', '', '', '', 2),
(5, '118322754', '2017-04-04', '../view/assets/images/perfil/img_default.png', '', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inkside_tagsPublicacion`
--

CREATE TABLE IF NOT EXISTS `inkside_tagsPublicacion` (
  `etiq_codigo` int(11) NOT NULL,
  `pub_codigo` int(11) NOT NULL,
  PRIMARY KEY (`etiq_codigo`,`pub_codigo`),
  KEY `fk_inkside_tagsPublicacion_inkside_publicaciones1_idx` (`pub_codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inskide_roles`
--

CREATE TABLE IF NOT EXISTS `inskide_roles` (
  `rol_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `rol_nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `rol_descripcion` longtext COLLATE utf8_spanish_ci,
  `rol_fecha_creacion` date DEFAULT NULL,
  PRIMARY KEY (`rol_codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `inskide_roles`
--

INSERT INTO `inskide_roles` (`rol_codigo`, `rol_nombre`, `rol_descripcion`, `rol_fecha_creacion`) VALUES
(1, 'admin', 'nada', '0000-00-00'),
(2, 'admin', 'nada', '0000-00-00'),
(3, 'segundo', 'no hay', '0000-00-00'),
(4, 'Usuario', 'dos', '0000-00-00'),
(5, 'Tercero', 'tres', NULL),
(6, 'Cuarto', 'no', '2017-02-26'),
(7, 'Administrador', 'Puede hacer todo', '2017-03-02');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `inkside_acceso`
--
ALTER TABLE `inkside_acceso`
  ADD CONSTRAINT `fk_inkside_acceso_inkside_poetas1` FOREIGN KEY (`poet_codigo`) REFERENCES `inkside_poetas` (`poet_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `inkside_ciudad`
--
ALTER TABLE `inkside_ciudad`
  ADD CONSTRAINT `fk_inkside_ciudad_inkside_departamento1` FOREIGN KEY (`dep_codigo`) REFERENCES `inkside_departamento` (`dep_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `inkside_departamento`
--
ALTER TABLE `inkside_departamento`
  ADD CONSTRAINT `fk_inkside_departamento_inkside_pais1` FOREIGN KEY (`pais_codigo`) REFERENCES `inkside_pais` (`pais_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `inkside_intereses`
--
ALTER TABLE `inkside_intereses`
  ADD CONSTRAINT `fk_inkside_preferencias_inkside_categoriaPoemas1` FOREIGN KEY (`catePub_codigo`) REFERENCES `inkside_categoriaPublicacion` (`catePub_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inkside_preferencias_inkside_poetas` FOREIGN KEY (`poet_codigo`) REFERENCES `inkside_poetas` (`poet_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `inkside_poetas`
--
ALTER TABLE `inkside_poetas`
  ADD CONSTRAINT `fk_inkside_poetas_inkside_ciudad1` FOREIGN KEY (`ciu_codigo`) REFERENCES `inkside_ciudad` (`ciu_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inkside_poetas_inskide_roles1` FOREIGN KEY (`rol_codigo`) REFERENCES `inskide_roles` (`rol_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `inkside_publicaciones`
--
ALTER TABLE `inkside_publicaciones`
  ADD CONSTRAINT `fk_inkside_publicaciones_inkside_categoriaPublicacion1` FOREIGN KEY (`catePub_codigo`) REFERENCES `inkside_categoriaPublicacion` (`catePub_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inkside_publicaciones_inkside_poetas1` FOREIGN KEY (`poet_codigo`) REFERENCES `inkside_poetas` (`poet_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `inkside_tagsPublicacion`
--
ALTER TABLE `inkside_tagsPublicacion`
  ADD CONSTRAINT `fk_inkside_tagsPublicacion_inkside_etiquetas1` FOREIGN KEY (`etiq_codigo`) REFERENCES `inkside_etiquetas` (`etiq_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inkside_tagsPublicacion_inkside_publicaciones1` FOREIGN KEY (`pub_codigo`) REFERENCES `inkside_publicaciones` (`pub_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
