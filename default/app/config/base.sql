-- phpMyAdmin SQL Dump
-- version 3.3.7deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 28, 2010 at 05:27 PM
-- Server version: 5.1.49
-- PHP Version: 5.3.3-1ubuntu9.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `plc`
--

-- --------------------------------------------------------

--
-- Table structure for table `controllers`
--

CREATE TABLE IF NOT EXISTS `controllers` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `menus_id` int(4) NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `perfiles_id` int(4) NOT NULL,
  `status` char(1) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `url` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `sistema` int(1) NOT NULL DEFAULT '1',
  `orden` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `controllers`
--

INSERT INTO `controllers` (`id`, `menus_id`, `nombre`, `perfiles_id`, `status`, `url`, `sistema`, `orden`) VALUES
(1, 1, 'Usuarios', 1, 'A', '.', 1, NULL),
(3, 1, 'Menus', 1, 'A', '.', 1, 1),
(4, 1, 'Conexiones', 1, 'A', 'utils/logs', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `usuarios_id` int(4) DEFAULT NULL,
  `fecha_at` datetime DEFAULT NULL,
  `fecha_in` datetime DEFAULT NULL,
  `ip` varchar(16) CHARACTER SET latin1 DEFAULT NULL,
  `url` varchar(200) NOT NULL,
  `perfiles_id` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `usuarios_id`, `fecha_at`, `fecha_in`, `ip`, `url`, `perfiles_id`) VALUES
(1, 2, '2010-11-28 17:10:15', '2010-11-28 17:11:14', '::1', '/usuarios/create', 1),
(2, 2, '2010-11-28 17:11:08', '2010-11-28 17:21:29', '::1', '/utils/logs', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `orden` int(3) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `orden`, `nombre`) VALUES
(1, 1, 'Sistema');

-- --------------------------------------------------------

--
-- Table structure for table `perfiles`
--

CREATE TABLE IF NOT EXISTS `perfiles` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `perfiles`
--

INSERT INTO `perfiles` (`id`, `nombre`) VALUES
(1, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `sesiones`
--

CREATE TABLE IF NOT EXISTS `sesiones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `k` varchar(50) DEFAULT NULL,
  `v` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `sesiones`
--

INSERT INTO `sesiones` (`id`, `username`, `k`, `v`) VALUES
(1, '74972fa2f2bb63e21ac3429a9468b7ad', 'usuarios_id', '2'),
(2, '74972fa2f2bb63e21ac3429a9468b7ad', 'perfiles_nombre', 'admin'),
(3, '74972fa2f2bb63e21ac3429a9468b7ad', 'usuarios_nombre', 'Administrador Del Sistema'),
(4, '74972fa2f2bb63e21ac3429a9468b7ad', 'perfiles_id', '1'),
(5, '74972fa2f2bb63e21ac3429a9468b7ad', 'empresas_id', '0'),
(6, '74972fa2f2bb63e21ac3429a9468b7ad', 'logs_id', '1'),
(7, 'b5f55faeb2656f7f3c30a374c9c324ed', 'usuarios_id', '2'),
(8, 'b5f55faeb2656f7f3c30a374c9c324ed', 'perfiles_nombre', 'admin'),
(9, 'b5f55faeb2656f7f3c30a374c9c324ed', 'usuarios_nombre', 'Administrador Del Sistema'),
(10, 'b5f55faeb2656f7f3c30a374c9c324ed', 'perfiles_id', '1'),
(11, 'b5f55faeb2656f7f3c30a374c9c324ed', 'empresas_id', '0'),
(12, 'b5f55faeb2656f7f3c30a374c9c324ed', 'logs_id', '2');

-- --------------------------------------------------------

--
-- Table structure for table `sub_menus`
--

CREATE TABLE IF NOT EXISTS `sub_menus` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `controllers_id` int(4) NOT NULL,
  `url` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `orden` int(6) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `sub_menus`
--

INSERT INTO `sub_menus` (`id`, `controllers_id`, `url`, `nombre`, `orden`, `estado`) VALUES
(1, 3, 'menus/createMain', 'MenÃº Principal', 0, 'A'),
(2, 3, 'menus/create', 'MenÃº Flotante', 1, 'A'),
(3, 3, 'menus/createSubMenu', 'Sub MenÃº', 2, 'A'),
(4, 1, 'usuarios', 'Usuarios', 1, 'A'),
(5, 1, 'perfiles', 'Perfiles', 0, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `apellidos` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `usuario` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `entradas` int(4) DEFAULT NULL,
  `mail` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `fecha_at` datetime DEFAULT NULL,
  `perfiles_id` int(4) NOT NULL,
  `status` char(1) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `firma` varchar(100) DEFAULT NULL,
  `online` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_perfiles_1` (`perfiles_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `usuario`, `password`, `entradas`, `mail`, `fecha_at`, `perfiles_id`, `status`, `firma`, `online`) VALUES
(2, 'Administrador', 'Del Sistema', 'admin', '89e495e7941cf9e40e6980d14a16bf023ccd4c91', 2, NULL, NULL, 1, 'A', NULL, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_perfiles_1` FOREIGN KEY (`perfiles_id`) REFERENCES `perfiles` (`id`);
