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
DROP DATABASE fut;
CREATE DATABASE IF NOT EXISTS fut DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE fut;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla usuario
--

DROP TABLE IF EXISTS usuario;
CREATE TABLE usuario (
  id int(11) NOT NULL,
  nombre varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  contrasenna varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  codigoCookie varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  email varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  administrador int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Truncar tablas antes de insertar usuario
--

TRUNCATE TABLE usuario;
--
-- Volcado de datos para la tabla usuario
--

INSERT INTO usuario (id, nombre, contrasenna, codigoCookie, email, administrador) VALUES
(1, 'Iván', '1234', NULL, 'i@gmail.com', 1),
(2, 'Cuillo', '1234', NULL, 'c@gmail.com', 0);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla jugador
--

DROP TABLE IF EXISTS jugador;
CREATE TABLE jugador (
  id int(11) NOT NULL,
  nombre varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  verssion varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  posicion varchar (45) NOT NULL,
  goles int(11) NOT NULL,
  asistencias int(11) NOT NULL,
  fichado int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


--
-- Truncar tablas antes de insertar jugador
--

TRUNCATE TABLE jugador;
--
-- Volcado de datos para la tabla jugador
--

INSERT INTO jugador (id, nombre, verssion, posicion, goles, asistencias, fichado) VALUES
(1, 'Nick Pope', 'Oro' , 'Portero', 0, 0, 0),
(2, 'Thibaut Courtois', 'IF', 'Portero', 0, 0, 0),
(3, 'Nemanja Vidiç', 'Icono', 'Defensa', 5, 0, 0),
(4, 'Raphael Varane', 'Oro', 'Defensa', 3, 0, 0),
(5, 'Paul Pogba', 'IF', 'Medio', 7, 8, 0),
(6, 'Ngolo Kanté', 'Oro', 'Medio', 0, 3, 0),
(7, 'Cristiano Ronaldo', 'Icono', 'Atacante', 30, 6, 0),
(8, 'Joao Félix', 'Plata', 'Atacante', 15, 20, 0);


-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla equipo
--

DROP TABLE IF EXISTS equipo;
CREATE TABLE equipo(
  id int(11) NOT NULL,
  usuario_id int(11) NOT NULL,
  nombre varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


--
-- Truncar tablas antes de insertar equipo
--

TRUNCATE TABLE equipo;

--
-- Volcado de datos para la tabla equipo
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla fichaje
--

DROP TABLE IF EXISTS fichaje;
CREATE TABLE fichaje (
  equipo_id int(11) NOT NULL,
  jugador_id int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Truncar tablas antes de insertar fichaje
--

TRUNCATE TABLE fichaje;
--
-- Volcado de datos para la tabla fichaje
--

-- --------------------------------------------------------

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla usuario
--
ALTER TABLE usuario
  ADD PRIMARY KEY (id);

--
-- Indices de la tabla jugador
--
ALTER TABLE jugador
   ADD PRIMARY KEY (id);

--
-- Indices de la tabla equipo
--
ALTER TABLE equipo
  ADD PRIMARY KEY (id);
--
-- Indices de la tabla fichaje
--
ALTER TABLE fichaje
   ADD PRIMARY KEY (equipo_id, jugador_id);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla usuario
--
ALTER TABLE usuario
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla jugador
--
ALTER TABLE jugador
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla equipo
--
ALTER TABLE equipo
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla fichaje
--
ALTER TABLE fichaje
  ADD CONSTRAINT fichaje_fk2 FOREIGN KEY (jugador_id) REFERENCES jugador (id) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT fichaje_fk3 FOREIGN KEY (equipo_id) REFERENCES equipo (id) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla equipo
--

  ALTER TABLE equipo
  ADD CONSTRAINT equipo_fk1 FOREIGN KEY (usuario_id) REFERENCES usuario (id) ON DELETE CASCADE ON UPDATE CASCADE;
  COMMIT;