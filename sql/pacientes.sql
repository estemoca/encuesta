-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 26-09-2016 a las 07:16:40
-- Versión del servidor: 5.5.34
-- Versión de PHP: 5.3.10-1ubuntu3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `pacientes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE IF NOT EXISTS `departamentos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id`, `nombre`) VALUES
(1, 'tolima'),
(2, 'cundinamarca');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eps`
--

CREATE TABLE IF NOT EXISTS `eps` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `eps`
--

INSERT INTO `eps` (`id`, `nombre`) VALUES
(1, 'cafesalud'),
(2, 'saludcoop');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE IF NOT EXISTS `municipios` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `id_departamento` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`id`, `nombre`, `id_departamento`) VALUES
(1, 'ibague', 1),
(2, 'bogota', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE IF NOT EXISTS `pacientes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `celular` int(10) NOT NULL,
  `telefono` int(10) NOT NULL,
  `id_municipio` int(10) NOT NULL,
  `id_eps` int(10) NOT NULL,
  `fecha_creacion` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id`, `nombre`, `apellido`, `direccion`, `celular`, `telefono`, `id_municipio`, `id_eps`, `fecha_creacion`) VALUES
(2, 'esteban', 'morales', 'mza 30 casa 7 topacio', 3212, 131, 2, 1, '2016-09-25'),
(5, 'asdf', 'asdf', 'asdf', 1234123, 123, 2, 1, '2016-09-25'),
(6, 'asd', 'asdf', 'asdf', 1234123, 1234, 2, 1, '2016-09-25'),
(9, 'asdfasd', 'qwe', 'qwer', 516515, 66651, 2, 1, '2016-09-25'),
(11, 'asd', 'asdf', '11234', 1234, 11234, 2, 1, '2016-09-25'),
(12, 'asd', 'asdf', '11234', 1234, 11234, 2, 1, '2016-09-25'),
(13, 'asdf', 'sadf', 'asdfasd', 12341234, 123423, 2, 1, '2016-09-25'),
(14, 'asdestebanesteban', 'asdf', 'asdf', 1234123, 1234, 2, 1, '2016-09-25'),
(15, 'asdesteba', 'asdf', 'asdf', 1234123, 1234, 2, 1, '2016-09-25'),
(16, 'esteban', 'morales', 'mza 30 casa 7 topacio', 3212, 131, 1, 1, '2016-09-25');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
