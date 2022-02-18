-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2020 a las 17:52:19
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hotelespalace`
--
/*
CREATE DATABASE IF NOT EXISTS `hotelespalace` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `hotelespalace`;
*/
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destinos`
--

CREATE TABLE `destinos` (
  `IdDestino` int(11) NOT NULL,
  `nombre` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `destinos`
--

INSERT INTO `destinos` (`IdDestino`, `nombre`) VALUES
(1, 'Malaga,ES'),
(2, 'Roma,IT'),
(3, 'Atenas,GR'),
(4, 'Paris,FR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion`
--

CREATE TABLE `habitacion` (
  `IdHabitacion` int(11) NOT NULL,
  `IdDestino` int(11) NOT NULL,
  `Tipo` varchar(64) NOT NULL,
  `Regimen` varchar(64) NOT NULL,
  `Precio` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `habitacion`
--

INSERT INTO `habitacion` (`IdHabitacion`, `IdDestino`, `Tipo`, `Regimen`, `Precio`) VALUES
(1, 1, 'simple', 'desayuno', '50'),
(2, 1, 'simple', 'media', '80'),
(3, 1, 'doble', 'desayuno', '120'),
(4, 1, 'doble', 'media', '180'),
(5, 2, 'simple', 'desayuno', '60'),
(6, 2, 'simple', 'media', '90'),
(7, 2, 'doble', 'desayuno', '130'),
(8, 2, 'doble', 'media', '190'),
(9, 3, 'simple', 'desayuno', '55'),
(10, 3, 'simple', 'media', '85'),
(11, 3, 'doble', 'desayuno', '125'),
(12, 3, 'doble', 'media', '185'),
(13, 4, 'simple', 'desayuno', '65'),
(14, 4, 'simple', 'media', '95'),
(15, 4, 'doble', 'desayuno', '135'),
(16, 4, 'doble', 'media', '195');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `IdReserva` int(11) NOT NULL,
  `usuario` varchar(64) NOT NULL,
  `IdHabitacion` int(11) NOT NULL,
  `fecha_entrada` date NOT NULL,
  `fecha_salida` date NOT NULL,
  `num_adultos` int(11) NOT NULL,
  `PrecioDef` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`IdReserva`, `usuario`, `IdHabitacion`, `fecha_entrada`, `fecha_salida`, `num_adultos`, `PrecioDef`) VALUES
(66, 'Javier', 3, '2020-05-29', '2020-05-31', 2, '240');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario` varchar(64) NOT NULL,
  `nombre` varchar(64) NOT NULL,
  `apellidos` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(64) NOT NULL,
  `telefono` varchar(32) NOT NULL,
  `publicidad` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario`, `nombre`, `apellidos`, `password`, `email`, `telefono`, `publicidad`) VALUES
('Javier', 'Javier', 'Rivera Bellet', '$2y$10$cRExWjh91jkbudqJYXhhLe3LxXs9JkJjemx6wi8P/wUjim/TgdLbi', 'javi@prueba.com', '600000000', 'si');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `destinos`
--
ALTER TABLE `destinos`
  ADD PRIMARY KEY (`IdDestino`);

--
-- Indices de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD PRIMARY KEY (`IdHabitacion`),
  ADD KEY `IdDestino` (`IdDestino`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`IdReserva`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `IdHabitacion` (`IdHabitacion`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `destinos`
--
ALTER TABLE `destinos`
  MODIFY `IdDestino` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  MODIFY `IdHabitacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `IdReserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD CONSTRAINT `habitacion_ibfk_1` FOREIGN KEY (`IdDestino`) REFERENCES `destinos` (`IdDestino`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`IdHabitacion`) REFERENCES `habitacion` (`IdHabitacion`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
