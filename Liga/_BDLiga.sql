-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 20-11-2020 a las 12:42:54
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de datos: liga
--
CREATE DATABASE IF NOT EXISTS liga DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE liga;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla categoria
--

DROP TABLE IF EXISTS categoria;
CREATE TABLE IF NOT EXISTS categoria (
                                         id int(11) NOT NULL AUTO_INCREMENT,
                                         nombre varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
                                         PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla categoria
--

INSERT INTO categoria (id, nombre) VALUES
(1, 'Primera División'),
(2, 'Segunda División'),
(3, 'Tercera División'),
(4, 'Regional'),
(5, 'Preferente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla equipo
--

DROP TABLE IF EXISTS equipo;
CREATE TABLE IF NOT EXISTS equipo (
                                       id int(11) NOT NULL AUTO_INCREMENT,
                                       nombre varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
                                       entrenador varchar(80) DEFAULT NULL,
                                       redsocial varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
                                       estrella tinyint(1) NOT NULL DEFAULT 0,
                                       categoriaId int(11) NOT NULL,
                                       PRIMARY KEY (id),
                                       KEY fk_categoriaIdIdx (categoriaId)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla equipo
--

INSERT INTO equipo (id, nombre, entrenador, redsocial, estrella, categoriaId) VALUES
(1, 'Getafe', 'J.Bordalás', '@getafesad', 1, 1),
(2, 'Real Madrid', 'Z.Zidane', '@realmadrid', 1, 1),
(3, 'Rayo Vallecano', 'A.Iraola', '@rayovallecano', 0, 2),
(4, 'Fuenlabrada', 'J.Sandoval', '@fuenla', 0, 2),
(5, 'DUX', 'A.Santaelena', '@DUXmadrid', 0, 3),
(6, 'PSGetafe', 'I.Rodríguez', '@psgetafe', 1, 5);
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla equipo
--
ALTER TABLE equipo
    ADD CONSTRAINT fk_categoriaId FOREIGN KEY (categoriaId) REFERENCES categoria (id) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
