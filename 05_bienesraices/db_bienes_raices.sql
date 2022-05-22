-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-05-2022 a las 21:31:57
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bienes_raices`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedades`
--

CREATE TABLE `propiedades` (
  `id` int(11) NOT NULL,
  `titulo` varchar(60) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `descripcion` longtext NOT NULL,
  `habitaciones` int(1) NOT NULL,
  `wc` int(1) NOT NULL,
  `estacionamiento` int(1) NOT NULL,
  `creado` date NOT NULL,
  `vendedorId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `propiedades`
--

INSERT INTO `propiedades` (`id`, `titulo`, `precio`, `imagen`, `descripcion`, `habitaciones`, `wc`, `estacionamiento`, `creado`, `vendedorId`) VALUES
(1, 'Casa de Lujo en el Lago', '3500000.00', '80f51d5b7a609bbf67aa90b0e253a074.jpg', 'Casa en el lago con excelente vista, acabados de lujo a un excelente precio', 4, 3, 3, '2022-05-21', 1),
(2, 'Casa terminados de lujo', '2500000.00', 'd4074655659e895dcdd1f3b3552b26d5.jpg', 'Casa en el lago con excelente vista, acabados de lujo a un excelente precio', 3, 4, 3, '2022-05-21', 1),
(3, 'Casa con alberca', '3000000.00', '36e093f9a6d76c4b9619e97782405165.jpg', 'Casa en el lago con excelente vista, acabados de lujo a un excelente precio', 3, 3, 4, '2022-05-21', 1),
(4, 'Casa de Lujo en el Lago', '3500000.00', 'fc076a468bdb3f98725807bed2b6f3b9.jpg', 'Casa en el lago con excelente vista, acabados de lujo a un excelente precio', 3, 4, 3, '2022-05-21', 1),
(5, 'Casa terminados de lujo', '2500000.00', '9f6774ecef3f241a620d058ed76eb347.jpg', 'Casa en el lago con excelente vista, acabados de lujo a un excelente precio', 3, 3, 4, '2022-05-21', 1),
(6, 'Casa con alberca', '3000000.00', 'de3e79cbe98007895e04232021fb018c.jpg', 'Casa en el lago con excelente vista, acabados de lujo a un excelente precio', 4, 3, 3, '2022-05-21', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(1) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `password`) VALUES
(1, 'correo@correo.com', '$2y$10$pL/JPLf9Wh2hGOVukLHzAu5Jqx8LOY/0mPLpuoj9W6R3qxrBD1Jvq');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedores`
--

CREATE TABLE `vendedores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `telefono` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `vendedores`
--

INSERT INTO `vendedores` (`id`, `nombre`, `apellido`, `telefono`) VALUES
(1, 'Juan', 'De la torre', '1234567890'),
(2, 'Karen', 'Perez', '2345678901');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `propiedades_ibfk_1` (`vendedorId`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vendedores`
--
ALTER TABLE `vendedores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `vendedores`
--
ALTER TABLE `vendedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `propiedades`
--
ALTER TABLE `propiedades`
  ADD CONSTRAINT `propiedades_ibfk_1` FOREIGN KEY (`vendedorId`) REFERENCES `vendedores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
