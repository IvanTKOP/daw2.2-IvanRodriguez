-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 20-11-2020 a las 12:42:54
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de datos: fut
--
CREATE DATABASE IF NOT EXISTS fut DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE fut;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla usuario
--

DROP TABLE IF EXISTS usuario;
CREATE TABLE IF NOT EXISTS usuario (
  id int(11) NOT NULL AUTO_INCREMENT ,
  usuario varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  contrasenna varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  codigoCookie varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  email varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Truncar tablas antes de insertar usuario
--

TRUNCATE TABLE usuario;
--
-- Volcado de datos para la tabla usuario
--

INSERT INTO usuario (id, usuario, contrasenna, codigoCookie, email) VALUES
(1, 'ivan', '1234', NULL, 'i@gmail.com'),
(2, 'cuillo', '1234', NULL, 'c@gmail.com');

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla jugador
--

DROP TABLE IF EXISTS jugador;
CREATE TABLE IF NOT EXISTS jugador(
  id int(11) NOT NULL AUTO_INCREMENT,
  nombre varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  verssion varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  posicion varchar (45) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


--
-- Truncar tablas antes de insertar jugador
--

TRUNCATE TABLE jugador;
--
-- Volcado de datos para la tabla jugador
--

INSERT INTO jugador (id, nombre, verssion, posicion) VALUES
(1, 'Nick Pope', 'Oro' , 'Portero'),
(2, 'Thibaut Courtois', 'IF', 'Portero'),
(3, 'Nemanja Vidiç', 'Icono', 'Defensa'),
(4, 'Raphael Varane', 'Oro', 'Defensa'),
(5, 'Paul Pogba', 'IF Reward', 'Medio'),
(6, 'Ngolo Kanté', 'Oro', 'Medio'),
(7, 'Cristiano Ronaldo', 'Flashback', 'Atacante'),
(8, 'Joao Félix', 'POTM LaLiga', 'Atacante');


-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla equipo
--

DROP TABLE IF EXISTS equipo;
CREATE TABLE IF NOT EXISTS equipo(
  id int(11) NOT NULL AUTO_INCREMENT,
  usuario_id int(11) NOT NULL,
  nombre varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL, 
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


--
-- Truncar tablas antes de insertar jugador
--

TRUNCATE TABLE equipo;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO equipo (id, usuario_id, nombre) VALUES
(1, 1, 'FutSemana1'),
(2, 2, 'FutSemana2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla fichaje
--

DROP TABLE IF EXISTS fichaje;
CREATE TABLE fichaje (
  equipo_id int(11) NOT NULL,
  jugador_id int(11) NOT NULL,
  goles int(11) NOT NULL,
  asistencias  int(11) NOT NULL,
  PRIMARY KEY (equipo_id, jugador_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Truncar tablas antes de insertar fichaje
--

TRUNCATE TABLE fichaje;
--
-- Volcado de datos para la tabla fichaje
--

INSERT INTO fichaje (equipo_id, jugador_id, goles, asistencias) VALUES
(1, 1, 0, 0),
(1, 2, 0, 0),
(1, 3, 0, 0),
(2, 4, 0, 0),
(2, 5, 0, 0),
(2, 6, 0, 0);


-- --------------------------------------------------------

ALTER TABLE fichaje
  ADD CONSTRAINT fichaje_fk2 FOREIGN KEY (jugador_id) REFERENCES jugador (id) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT fichaje_fk3 FOREIGN KEY (equipo_id) REFERENCES equipo (id) ON DELETE CASCADE ON UPDATE CASCADE;


  ALTER TABLE equipo
  ADD CONSTRAINT equipo_fk1 FOREIGN KEY (usuario_id) REFERENCES usuario (id) ON DELETE CASCADE ON UPDATE CASCADE;
  COMMIT;