-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- daw2.2-IvanRodriguez: localhost
-- Tiempo de generación: 29-10-2020 a las 13:21:58
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `agenda`
--
CREATE DATABASE IF NOT EXISTS `agenda` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `agenda`;

-- --------------------------------------------------------

<<<<<<< HEAD
=======
--
-- Estructura de tabla para la tabla `categoria`
--

DROP TABLE IF EXISTS Categoria;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
>>>>>>> main

--
-- Estructura de tabla para la tabla categoria
--

<<<<<<< HEAD
DROP TABLE IF EXISTS categoria;
CREATE TABLE IF NOT EXISTS categoria (
                                         id int(11) NOT NULL AUTO_INCREMENT,
                                         nombre varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
                                         PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

=======
TRUNCATE TABLE Categoria;
>>>>>>> main
--
-- Volcado de datos para la tabla categoria
--

<<<<<<< HEAD
INSERT INTO categoria (id, nombre) VALUES
=======
INSERT INTO Categoria (`id`, `nombre`) VALUES
>>>>>>> main
(1, 'Familiares'),
(2, 'Amigos'),
(3, 'Trabajo'),
(4, 'Otros'),
(8, 'Estudios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

DROP TABLE IF EXISTS Persona;
CREATE TABLE IF NOT EXISTS `persona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(80) DEFAULT NULL,
  `telefono` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `categoriaId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_categoriaIdIdx` (`categoriaId`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Truncar tablas antes de insertar `persona`
--

TRUNCATE TABLE Persona;
--
-- Volcado de datos para la tabla `persona`
--

<<<<<<< HEAD
INSERT INTO `persona` (`id`, `nombre`,`apellidos`, `telefono`, `categoriaId`) VALUES
(1, 'Pepe', 'Muñoz', '600111222', 3),
(2, 'Mario', 'Palacios', '688444222', 1),
(3, 'Jose','García', '611222333', 1),
(4, 'Cristina','González', '644999444', 8),
(5, 'Laura','Pardo', '666777888', 2),
(6, 'Menganito','Cantor', '699888777', 3),
=======
INSERT INTO Persona (`id`, `nombre`, `telefono`, `categoriaId`) VALUES
(1, 'Pepe', '600111222', 3),
(2, 'Mario', '688444222', 1),
(3, 'Jose', '611222333', 1),
(4, 'Cristina', '644999444', 8),
(5, 'Laura', '666777888', 2),
(6, 'Menganito', '699888777', 3),
>>>>>>> main
(11, 'Menganito', 'Fulánez', 4);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `persona`
--
ALTER TABLE Persona
  ADD CONSTRAINT `fk_categoriaId` FOREIGN KEY (`categoriaId`) REFERENCES Categoria (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;