-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 27-07-2024 a las 20:36:32
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
-- Base de datos: `dbd_money`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `i001t_usuario`
--

CREATE TABLE `i001t_usuario` (
  `id` int(11) NOT NULL,
  `tx_nombre_usuario` varchar(255) NOT NULL,
  `tx_apellido_usuario` varchar(255) NOT NULL,
  `tx_alias_usuario` varchar(255) NOT NULL,
  `tx_clave_usuario` varchar(255) NOT NULL,
  `in_tipo_usuario` int(11) NOT NULL,
  `tx_saldo_usuario` float(10,2) NOT NULL,
  `fecha_add` datetime NOT NULL,
  `in_estatus` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Volcado de datos para la tabla `i001t_usuario`
--

INSERT INTO `i001t_usuario` (`id`, `tx_nombre_usuario`, `tx_apellido_usuario`, `tx_alias_usuario`, `tx_clave_usuario`, `in_tipo_usuario`, `tx_saldo_usuario`, `fecha_add`, `in_estatus`) VALUES
(5, 'Admin', 'Sistem', 'admin', '$2y$10$WFTpmZ4MpNfOUNVKzFxMr.aVF2QiBjpFSRNiR1eXg6J/x/Sj9kHpq', 1, 210.00, '2024-07-24 17:46:43', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `i002t_solicitud`
--

CREATE TABLE `i002t_solicitud` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `tx_solicitud` varchar(255) NOT NULL,
  `tx_cantidad` float(10,2) NOT NULL,
  `fecha_add` datetime NOT NULL,
  `in_estatus` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `i001t_usuario`
--
ALTER TABLE `i001t_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `i002t_solicitud`
--
ALTER TABLE `i002t_solicitud`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `i001t_usuario`
--
ALTER TABLE `i001t_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `i002t_solicitud`
--
ALTER TABLE `i002t_solicitud`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
