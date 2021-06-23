-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-06-2021 a las 05:22:18
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ligas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `puntos` int(3) NOT NULL,
  `dg` int(2) NOT NULL,
  `ligaId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`id`, `nombre`, `puntos`, `dg`, `ligaId`) VALUES
(1, 'Atlético de Madrid', 85, 42, 1),
(2, 'Real Madrid', 84, 39, 1),
(3, 'Barcelona', 79, 47, 1),
(4, 'Sevilla', 77, 20, 1),
(5, 'Real Sociedad', 62, 21, 1),
(6, 'Betis', 59, 0, 1),
(7, 'Manchester City', 84, 51, 2),
(8, 'Manchester United', 74, 29, 2),
(9, 'Liverpool', 69, 26, 2),
(10, 'Chelsea', 67, 22, 2),
(11, 'Leicester', 66, 18, 2),
(12, 'West Ham ', 65, 15, 2),
(13, 'Inter de Milán', 91, 54, 3),
(14, 'Milán', 79, 33, 3),
(15, 'Atalanta', 78, 43, 3),
(16, 'Juventus', 78, 39, 3),
(17, 'Napoli', 77, 45, 3),
(18, 'Lazio', 68, 6, 3),
(19, 'Bayern Munich', 78, 55, 4),
(20, 'RB Leizpig', 65, 28, 4),
(21, 'Borussia Dortmund', 64, 29, 4),
(22, 'Wolfsburgo', 61, 24, 4),
(23, 'Eintracht', 60, 16, 4),
(24, 'Leverkusen', 52, 14, 4),
(25, 'Lille', 83, 41, 5),
(26, 'PSG', 82, 58, 5),
(27, 'Mónaco', 78, 34, 5),
(28, 'Lyon', 76, 38, 5),
(29, 'Marsella', 60, 7, 5),
(30, 'Villareal', 57, 16, 1),
(31, 'Celta de Vigo', 53, -2, 1),
(32, 'Granada', 46, -18, 1),
(33, 'Athletic Club', 46, 4, 1),
(34, 'Osasuna', 44, -9, 1),
(35, 'Cádiz', 44, -22, 1),
(36, 'Valencia', 43, -3, 1),
(37, 'Levante', 41, -11, 1),
(38, 'Getafe', 38, -15, 1),
(39, 'Alavés', 38, -21, 1),
(40, 'Elche', 36, -21, 1),
(41, 'Huesca', 35, -19, 1),
(42, 'Valladolid', 31, -23, 1),
(43, 'Eibar', 30, -23, 1),
(44, 'Tottenham', 64, 23, 2),
(45, 'Arsenal', 61, 16, 2),
(46, 'Leeds', 59, 8, 2),
(47, 'Everton', 59, -1, 2),
(48, 'Aston Villa', 55, 9, 2),
(49, 'Newcastle', 45, -16, 2),
(50, 'Wolves', 45, -16, 2),
(51, 'Crystal Palace', 44, -25, 2),
(52, 'Southampton', 43, -21, 2),
(53, 'Brighton', 41, -6, 2),
(54, 'Burnley', 39, -22, 2),
(55, 'Fulham', 28, -26, 2),
(56, 'West Brom', 26, -39, 2),
(57, 'Sheffield Utd', 23, -43, 2),
(58, 'Roma', 62, 10, 3),
(59, 'Sassuolo', 62, 8, 3),
(60, 'Sampdoria', 52, -2, 3),
(61, 'Verona', 45, -2, 3),
(62, 'Genoa', 42, -9, 3),
(63, 'Bolonia', 41, -14, 3),
(64, 'Fiorentina', 40, -22, 3),
(65, 'Udinese', 40, -16, 3),
(66, 'Spezia', 39, -20, 3),
(67, 'Cagliari', 37, -16, 3),
(68, 'Torino', 37, -19, 3),
(69, 'Benevento', 33, -35, 3),
(70, 'Crotone', 23, -47, 3),
(71, 'Parma', 20, -44, 3),
(72, 'Unión Berlín', 50, 7, 4),
(73, 'Borussia Mgladbach', 49, 8, 4),
(74, 'Stuttgart', 45, 1, 4),
(75, 'Friburgo', 45, 0, 4),
(76, 'Hoffenheim', 43, -2, 4),
(77, 'Mainz', 39, -17, 4),
(78, 'Augsburgo', 36, -18, 4),
(79, 'Hertha', 35, -9, 4),
(80, 'Arminia', 35, -26, 4),
(81, 'Colonia', 33, -16, 4),
(82, 'Werder Bremen', 31, -21, 4),
(83, 'Schalke', 16, -61, 4),
(84, 'Lens', 57, 1, 5),
(85, 'Montpellier', 54, -2, 5),
(86, 'Niza', 52, -3, 5),
(87, 'Metz', 47, -4, 5),
(88, 'Saint-Etienne', 46, -8, 5),
(89, 'Girondins', 45, -14, 5),
(90, 'Angers', 44, -18, 5),
(91, 'Reims', 42, -8, 5),
(92, 'Estrasburgo', 42, -9, 5),
(93, 'Lorient', 42, -18, 5),
(94, 'Brest', 41, -16, 5),
(95, 'Nantes', 40, -8, 5),
(96, 'Nimes', 35, -31, 5),
(97, 'Dijon', 21, -48, 5),
(98, 'Stade Rennais', 58, 12, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `liga`
--

CREATE TABLE `liga` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `liga`
--

INSERT INTO `liga` (`id`, `nombre`) VALUES
(1, 'España'),
(2, 'Inglaterra'),
(3, 'Italia'),
(4, 'Alemania'),
(5, 'Francia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `usuario` varchar(40) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `contrasenna` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `usuario`, `nombre`, `apellidos`, `contrasenna`) VALUES
(0, 'jlopez', 'Jose', 'Lopez', 'j'),
(2, 'irod', 'Iván', 'Rodríguez', 'i');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ligaIdIdx` (`ligaId`);

--
-- Indices de la tabla `liga`
--
ALTER TABLE `liga`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT de la tabla `liga`
--
ALTER TABLE `liga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD CONSTRAINT `fk_ligaId` FOREIGN KEY (`ligaId`) REFERENCES `liga` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
