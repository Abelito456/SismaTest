-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-08-2023 a las 23:32:52
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `testsisma1`
--
CREATE DATABASE IF NOT EXISTS `testsisma1` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `testsisma1`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasks`
--
-- Creación: 30-08-2023 a las 21:14:26
-- Última actualización: 30-08-2023 a las 21:15:23
--

CREATE TABLE `tasks` (
  `ID` int(11) NOT NULL,
  `Tarea` varchar(2000) NOT NULL,
  `Completada` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tasks`
--

INSERT INTO `tasks` (`ID`, `Tarea`, `Completada`) VALUES
(1, 'Bañar al perro', '1'),
(2, 'Hacer Tareas', '0'),
(3, 'Limpiar el baño', '0'),
(4, 'Salir a trotar', '1'),
(5, 'Limpiar la cocina', '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tasks`
--
ALTER TABLE `tasks`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
