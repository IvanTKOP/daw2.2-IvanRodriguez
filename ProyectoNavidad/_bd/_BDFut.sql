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
-- Base de datos: fut
--
CREATE DATABASE IF NOT EXISTS fut DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE fut;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla posicion
--

DROP TABLE IF EXISTS posicion;
CREATE TABLE IF NOT EXISTS posicion (
  id int(11) NOT NULL AUTO_INCREMENT,
  nombre varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla posicion
--

INSERT INTO posicion (id, nombre) VALUES
(1, 'Portero'),
(2, 'Defensas'),
(3, 'Medios'),
(4, 'Atacantes');

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla usuario
--

DROP TABLE IF EXISTS usuario;
CREATE TABLE IF NOT EXISTS usuario (
  id int(11) NOT NULL AUTO_INCREMENT,
  usuario varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  contrasenna varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  codigoCookie varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla usuario
--

INSERT INTO usuario (id, usuario, contrasenna, codigoCookie) VALUES
(1, 'ivan', '1234', NULL),
(2, 'cuillo', '1234', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla equipo
--

DROP TABLE IF EXISTS equipo;
CREATE TABLE IF NOT EXISTS equipo (
  id int(11) NOT NULL AUTO_INCREMENT,
  nombre varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla equipo
--

INSERT INTO equipo (id, nombre) VALUES
(1, "Fut Semana1"),
(2, "Fut Semana2");
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla jugador
--

DROP TABLE IF EXISTS jugador;
CREATE TABLE IF NOT EXISTS jugador(
  id int(11) NOT NULL AUTO_INCREMENT,
  nombre varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  verssion varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  goles int(3) NOT NULL,
  asistencias int(3) NOT NULL,
  idPosicion int(11) NOT NULL,
  idEquipo int(11) NOT NULL,
  PRIMARY KEY (id),
  KEY fk_posicionIdIdx (idPosicion)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla jugador
--

INSERT INTO jugador (id, nombre, verssion, goles, asistencias, idPosicion, idEquipo) VALUES
(1, 'Nick Pope', 'Oro' , 0, 0, 1, 1),
(2, 'Thibaut Courtois', 'IF', 0, 0, 1, 2),
(3, 'Nemanja Vidiç', 'Icono', 0, 0, 2, 1),
(4, 'Raphael Varane', 'Oro', 0, 0, 2, 2),
(5, 'Paul Pogba', 'IF Reward', 0, 0, 3, 3),
(6, 'Ngolo Kanté', 'Oro', 0, 0, 3, 2),
(7, 'Cristiano Ronaldo', 'Flashback', 0, 0, 4, 3),
(8, 'Joao Félix', 'POTM LaLiga', 0, 0, 4, 1);


ALTER TABLE jugador
    ADD CONSTRAINT fk_idPosicion FOREIGN KEY (idPosicion) REFERENCES posicion (id) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT fk_idEquipo FOREIGN KEY (idEquipo) REFERENCES equipo (id) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;