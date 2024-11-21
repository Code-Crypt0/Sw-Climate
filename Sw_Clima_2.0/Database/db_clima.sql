-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-11-2024 a las 21:23:32
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_clima`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pronostico`
--

CREATE TABLE `tbl_pronostico` (
  `Pk_id_pronostico` int(3) NOT NULL,
  `Temperatura` int(11) DEFAULT NULL,
  `Humedad` float DEFAULT NULL,
  `Presion` float DEFAULT NULL,
  `Velocidad` float NOT NULL,
  `Precipitacion` float DEFAULT NULL,
  `Pronostico` varchar(150) DEFAULT NULL,
  `Fecha_hora` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_pronostico`
--

INSERT INTO `tbl_pronostico` (`Pk_id_pronostico`, `Temperatura`, `Humedad`, `Presion`, `Velocidad`, `Precipitacion`, `Pronostico`, `Fecha_hora`) VALUES
(1, 25, 60, 1015, 15, 0, 'Soleado', '2024-11-18 17:48:10'),
(2, 22, 70, 1013, 10, 0, 'Soleado', '2024-11-18 17:48:10'),
(3, 28, 55, 1018, 20, 5, 'Parcialmente Nublado', '2024-11-18 17:48:10'),
(4, 30, 50, 1017, 25, 0, 'Soleado', '2024-11-18 17:48:10'),
(5, 18, 80, 1012, 5, 10, 'Lluvia Ligera', '2024-11-18 17:48:10'),
(6, 15, 90, 1008, 8, 20, 'Lluvia Moderada', '2024-11-18 17:48:10'),
(7, 20, 85, 1010, 12, 15, 'Lluvia Ligera', '2024-11-18 17:48:10'),
(8, 24, 65, 1014, 18, 0, 'Soleado', '2024-11-18 17:48:10'),
(9, 29, 45, 1016, 30, 0, 'Soleado', '2024-11-18 17:48:10'),
(10, 25, 70, 1011, 22, 5, 'Parcialmente Nublado', '2024-11-18 17:48:10'),
(11, 17, 95, 1009, 10, 25, 'Lluvia Fuerte', '2024-11-18 17:48:10'),
(12, 19, 87, 1013, 6, 12, 'Lluvia Ligera', '2024-11-18 17:48:10'),
(13, 22, 78, 1012, 14, 8, 'Parcialmente Nublado', '2024-11-18 17:48:10'),
(14, 26, 63, 1014, 20, 2, 'Soleado', '2024-11-18 17:48:10'),
(15, 31, 40, 1017, 35, 0, 'Soleado', '2024-11-18 17:48:10'),
(16, 28, 55, 1016, 25, 0, 'Soleado', '2024-11-18 17:48:10'),
(17, 16, 88, 1010, 8, 18, 'Lluvia Moderada', '2024-11-18 17:48:10'),
(18, 18, 80, 1007, 5, 30, 'Lluvia Fuerte', '2024-11-18 17:48:10'),
(19, 21, 75, 1011, 10, 5, 'Parcialmente Nublado', '2024-11-18 17:48:10'),
(20, 27, 60, 1015, 18, 0, 'Soleado', '2024-11-18 17:48:10'),
(21, 23, 65, 1014, 12, 0, 'Soleado', '2024-11-18 17:51:37'),
(22, 20, 72, 1012, 15, 0, 'Parcialmente Nublado', '2024-11-18 17:51:37'),
(23, 27, 58, 1016, 18, 3, 'Lluvia Ligera', '2024-11-18 17:51:37'),
(24, 30, 48, 1018, 20, 0, 'Soleado', '2024-11-18 17:51:37'),
(25, 17, 85, 1011, 5, 12, 'Lluvia Ligera', '2024-11-18 17:51:37'),
(26, 19, 80, 1010, 8, 25, 'Lluvia Moderada', '2024-11-18 17:51:37'),
(27, 22, 75, 1013, 10, 5, 'Parcialmente Nublado', '2024-11-18 17:51:37'),
(28, 25, 68, 1014, 14, 0, 'Soleado', '2024-11-18 17:51:37'),
(29, 29, 50, 1017, 22, 0, 'Soleado', '2024-11-18 17:51:37'),
(30, 16, 90, 1009, 6, 20, 'Lluvia Fuerte', '2024-11-18 17:51:37'),
(31, 18, 88, 1010, 8, 30, 'Lluvia Fuerte', '2024-11-18 17:51:37'),
(32, 21, 70, 1012, 12, 10, 'Lluvia Ligera', '2024-11-18 17:51:37'),
(33, 26, 62, 1014, 16, 0, 'Soleado', '2024-11-18 17:51:37'),
(34, 31, 42, 1018, 25, 0, 'Soleado', '2024-11-18 17:51:37'),
(35, 28, 55, 1015, 20, 3, 'Parcialmente Nublado', '2024-11-18 17:51:37'),
(36, 24, 67, 1014, 18, 0, 'Soleado', '2024-11-18 17:51:37'),
(37, 20, 78, 1011, 15, 8, 'Lluvia Ligera', '2024-11-18 17:51:37'),
(38, 18, 85, 1010, 10, 18, 'Lluvia Moderada', '2024-11-18 17:51:37'),
(39, 27, 60, 1016, 20, 0, 'Parcialmente Nublado', '2024-11-18 17:51:37'),
(40, 30, 50, 1017, 25, 0, 'Soleado', '2024-11-18 17:51:37'),
(41, 24, 65, 1014, 10, 0, 'Soleado', '2024-11-18 17:52:57'),
(42, 19, 80, 1011, 6, 15, 'Lluvia Ligera', '2024-11-18 17:52:57'),
(43, 22, 75, 1012, 12, 5, 'Parcialmente Nublado', '2024-11-18 17:52:57'),
(44, 30, 45, 1017, 18, 0, 'Soleado', '2024-11-18 17:52:57'),
(45, 17, 90, 1010, 8, 25, 'Lluvia Moderada', '2024-11-18 17:52:57'),
(46, 15, 92, 1008, 5, 30, 'Lluvia Fuerte', '2024-11-18 17:52:57'),
(47, 28, 60, 1015, 14, 0, 'Soleado', '2024-11-18 17:52:57'),
(48, 26, 70, 1014, 12, 2, 'Parcialmente Nublado', '2024-11-18 17:52:57'),
(49, 20, 85, 1011, 8, 10, 'Lluvia Ligera', '2024-11-18 17:52:57'),
(50, 23, 68, 1013, 16, 0, 'Soleado', '2024-11-18 17:52:57'),
(51, 21, 75, 1012, 10, 5, 'Parcialmente Nublado', '2024-11-18 17:52:57'),
(52, 29, 50, 1016, 20, 0, 'Soleado', '2024-11-18 17:52:57'),
(53, 25, 58, 1014, 18, 3, 'Parcialmente Nublado', '2024-11-18 17:52:57'),
(54, 18, 87, 1010, 6, 18, 'Lluvia Moderada', '2024-11-18 17:52:57'),
(55, 16, 92, 1009, 4, 25, 'Lluvia Fuerte', '2024-11-18 17:52:57'),
(56, 31, 42, 1018, 22, 0, 'Soleado', '2024-11-18 17:52:57'),
(57, 27, 65, 1015, 16, 0, 'Soleado', '2024-11-18 17:52:57'),
(58, 19, 82, 1010, 8, 12, 'Lluvia Ligera', '2024-11-18 17:52:57'),
(59, 23, 70, 1013, 14, 0, 'Parcialmente Nublado', '2024-11-18 17:52:57'),
(60, 20, 78, 1011, 10, 8, 'Lluvia Ligera', '2024-11-18 17:52:57'),
(61, 22, 75, 1013, 12, 0, 'Parcialmente Nublado', '2024-11-18 17:54:10'),
(62, 25, 65, 1014, 14, 0, 'Soleado', '2024-11-18 17:54:10'),
(63, 28, 60, 1016, 18, 3, 'Parcialmente Nublado', '2024-11-18 17:54:10'),
(64, 30, 45, 1017, 20, 0, 'Soleado', '2024-11-18 17:54:10'),
(65, 19, 85, 1011, 6, 15, 'Lluvia Ligera', '2024-11-18 17:54:10'),
(66, 16, 90, 1009, 4, 20, 'Lluvia Moderada', '2024-11-18 17:54:10'),
(67, 23, 70, 1013, 10, 0, 'Parcialmente Nublado', '2024-11-18 17:54:10'),
(68, 20, 80, 1010, 8, 8, 'Lluvia Ligera', '2024-11-18 17:54:10'),
(69, 18, 92, 1008, 5, 30, 'Lluvia Fuerte', '2024-11-18 17:54:10'),
(70, 29, 50, 1017, 22, 0, 'Soleado', '2024-11-18 17:54:10'),
(71, 24, 68, 1014, 16, 2, 'Parcialmente Nublado', '2024-11-18 17:54:10'),
(72, 26, 62, 1015, 18, 0, 'Soleado', '2024-11-18 17:54:10'),
(73, 19, 88, 1011, 8, 10, 'Lluvia Ligera', '2024-11-18 17:54:10'),
(74, 17, 95, 1010, 6, 25, 'Lluvia Fuerte', '2024-11-18 17:54:10'),
(75, 22, 78, 1013, 12, 5, 'Parcialmente Nublado', '2024-11-18 17:54:10'),
(76, 27, 58, 1016, 14, 0, 'Soleado', '2024-11-18 17:54:10'),
(77, 15, 90, 1009, 5, 20, 'Lluvia Moderada', '2024-11-18 17:54:10'),
(78, 31, 42, 1018, 25, 0, 'Soleado', '2024-11-18 17:54:10'),
(79, 21, 75, 1012, 10, 8, 'Lluvia Ligera', '2024-11-18 17:54:10'),
(80, 23, 70, 1014, 14, 0, 'Parcialmente Nublado', '2024-11-18 17:54:10'),
(81, 24, 70, 1013, 14, 0, 'Soleado', '2024-11-18 17:56:31'),
(82, 21, 78, 1012, 12, 5, 'Parcialmente Nublado', '2024-11-18 17:56:31'),
(83, 19, 85, 1011, 8, 15, 'Lluvia Ligera', '2024-11-18 17:56:31'),
(84, 17, 92, 1009, 6, 25, 'Lluvia Moderada', '2024-11-18 17:56:31'),
(85, 30, 50, 1016, 20, 0, 'Soleado', '2024-11-18 17:56:31'),
(86, 28, 60, 1015, 18, 0, 'Soleado', '2024-11-18 17:56:31'),
(87, 25, 68, 1014, 16, 2, 'Parcialmente Nublado', '2024-11-18 17:56:31'),
(88, 22, 75, 1013, 12, 8, 'Lluvia Ligera', '2024-11-18 17:56:31'),
(89, 18, 88, 1010, 6, 20, 'Lluvia Moderada', '2024-11-18 17:56:31'),
(90, 15, 95, 1008, 4, 30, 'Lluvia Fuerte', '2024-11-18 17:56:31'),
(91, 31, 45, 1017, 25, 0, 'Soleado', '2024-11-18 17:56:31'),
(92, 26, 62, 1015, 18, 3, 'Parcialmente Nublado', '2024-11-18 17:56:31'),
(93, 23, 70, 1014, 14, 0, 'Parcialmente Nublado', '2024-11-18 17:56:31'),
(94, 20, 78, 1012, 10, 10, 'Lluvia Ligera', '2024-11-18 17:56:31'),
(95, 29, 55, 1016, 22, 0, 'Soleado', '2024-11-18 17:56:31'),
(96, 27, 63, 1015, 20, 0, 'Soleado', '2024-11-18 17:56:31'),
(97, 19, 82, 1010, 8, 15, 'Lluvia Ligera', '2024-11-18 17:56:31'),
(98, 16, 90, 1009, 5, 25, 'Lluvia Moderada', '2024-11-18 17:56:31'),
(99, 22, 80, 1013, 12, 5, 'Parcialmente Nublado', '2024-11-18 17:56:31'),
(100, 30, 48, 1017, 20, 0, 'Soleado', '2024-11-18 17:56:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuarios`
--

CREATE TABLE `tbl_usuarios` (
  `Pk_id_usuario` int(3) NOT NULL,
  `Nombre` char(20) DEFAULT NULL,
  `App` char(20) DEFAULT NULL,
  `Apm` char(20) DEFAULT NULL,
  `Nombre_usuario` varchar(30) DEFAULT NULL,
  `Contraseña` int(11) DEFAULT NULL,
  `Tipo_usuario` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_usuarios`
--

INSERT INTO `tbl_usuarios` (`Pk_id_usuario`, `Nombre`, `App`, `Apm`, `Nombre_usuario`, `Contraseña`, `Tipo_usuario`) VALUES
(1, 'Aldo Osmar', 'Embarcadero', 'Urdanivia', 'EUAO', 1234, 'Admin'),
(2, 'Luis Alberto', 'Cruz', 'Rojas', 'CRLA', 5678, 'Admin'),
(3, 'Vianey', 'Ruiz', 'Villegas', 'RVV', 1234, 'Admin'),
(4, 'Juan Pablo', 'Castillo', 'Trejo', 'CTJP', 5678, 'Admin'),
(5, 'Fernando', 'Gonzalez', 'Lemus', 'GLF', 1234, 'Cliente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_pronostico`
--
ALTER TABLE `tbl_pronostico`
  ADD PRIMARY KEY (`Pk_id_pronostico`);

--
-- Indices de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  ADD PRIMARY KEY (`Pk_id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_pronostico`
--
ALTER TABLE `tbl_pronostico`
  MODIFY `Pk_id_pronostico` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  MODIFY `Pk_id_usuario` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
