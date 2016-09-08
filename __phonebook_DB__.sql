-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 08-09-2016 a las 13:02:43
-- Versión del servidor: 5.1.44
-- Versión de PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `phonebook`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(7) unsigned NOT NULL AUTO_INCREMENT,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `phoneNumber` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Volcar la base de datos para la tabla `contacts`
--

INSERT INTO `contacts` (`id`, `firstName`, `lastName`, `phoneNumber`) VALUES
(1, 'Jose', 'Rosales', '3310930209'),
(2, 'Joseee', 'Rosalesee', '331093020911'),
(19, 'Lisa', 'ejjeej', '92938348'),
(18, 'otto', 'nutzer', '222929'),
(16, 'otto', 'garcia', '39811818'),
(6, 'jose', 'paris', 'rosales'),
(7, '1991919', '9999', '999'),
(8, 'Lisa ', 'Dehmel1', '29933'),
(20, 'kjei', 'otto', '458574748');
