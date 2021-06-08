-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 17-12-2020 a las 14:18:12
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de datos: `Agenda`
--
CREATE DATABASE IF NOT EXISTS `Ligas` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `Ligas`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Liga`
--

CREATE TABLE `Liga` (
                             `id` int(11) NOT NULL,
                             `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Liga`
--

INSERT INTO `Liga` (`id`, `nombre`) VALUES
(1, 'España'),
(2, 'Inglaterra'),
(3, 'Italia'),
(4, 'Alemania'),
(5, 'Francia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Equipo`
--

CREATE TABLE `Equipo` (
                           `id` int(11) NOT NULL,
                           `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
                           `puntos` int(3) NOT NULL DEFAULT 0,
                           `ligaId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Equipo`
--

INSERT INTO `Equipo` (`id`, `nombre`, `puntos`, `ligaId`) VALUES
(1, 'Atlético de Madrid', 86, 1),
(2, 'Real Madrid', 84, 1),
(3, 'Barcelona', 79, 1),
(4, 'Sevilla', 77, 1),
(5, 'Real Sociedad', 62, 1),
(6, 'Betis', 61, 1),
(7, 'Manchester City', 86, 2),
(8, 'Manchester United', 74, 2),
(9, 'Liverpool', 69, 2),
(10, 'Chelsea', 67, 2),
(11, 'Leicester', 66, 2),
(12, 'West Ham ', 65, 2),
(13, 'Inter de Milán', 91, 3),
(14, 'Milán', 79, 3),
(15, 'Atalanta', 78, 3),
(16, 'Juventus', 78, 3),
(17, 'Napoli', 77, 3),
(18, 'Lazio', 68, 3),
(19, 'Bayern Munich', 78, 4),
(20, 'RB Leizpig', 65, 4),
(21, 'Borussia Dortmund', 64, 4),
(22, 'Wolfsburgo', 61, 4),
(23, 'Eintracht', 60, 4),
(24, 'Leverkusen', 52, 4),
(25, 'Lille', 83, 5),
(26, 'PSG', 82, 5),
(27, 'Mónaco', 78, 5),
(28, 'Lyon', 76, 5),
(29, 'Marsella', 60, 5);


--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Liga`
--
ALTER TABLE `Liga`
    ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Equipo`
--
ALTER TABLE `Equipo`
    ADD PRIMARY KEY (`id`),
    ADD KEY `fk_ligaIdIdx` (`ligaId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Liga`
--
ALTER TABLE `Liga`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `Equipo`
--
ALTER TABLE `Equipo`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Equipo`
--
ALTER TABLE `Equipo`
    ADD CONSTRAINT `fk_ligaId` FOREIGN KEY (`ligaId`) REFERENCES `Liga` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;