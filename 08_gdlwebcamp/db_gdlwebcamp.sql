-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-06-2022 a las 11:17:12
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
-- Base de datos: `gdlwebcamp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admins`
--

CREATE TABLE `admins` (
  `id_admin` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  `editado` datetime DEFAULT NULL,
  `nivel` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `admins`
--

INSERT INTO `admins` (`id_admin`, `usuario`, `nombre`, `password`, `editado`, `nivel`) VALUES
(1, 'admin', 'Juan Pablo', '$2y$12$AfmC63Y59hmzf.4wBAR1f.ibLpFdlesDE.VKyahQGdg0IVu5yzX2O', '2022-05-28 08:58:38', 1),
(2, 'admin2', 'Karen Perez', '$2y$12$gpMi/OdYG.4xCTRk6sC80.K3xJENz59lFLKp9yXU51I410VjF1C4q', NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_evento`
--

CREATE TABLE `categoria_evento` (
  `id_categoria` tinyint(10) NOT NULL,
  `cat_evento` varchar(50) NOT NULL,
  `icono` varchar(15) NOT NULL,
  `editado` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria_evento`
--

INSERT INTO `categoria_evento` (`id_categoria`, `cat_evento`, `icono`, `editado`) VALUES
(1, 'Seminario', 'fa-university', NULL),
(2, 'Conferencias', 'fa-comment', NULL),
(3, 'Talleres', 'fa-code', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `evento_id` tinyint(10) NOT NULL,
  `nombre_evento` varchar(60) NOT NULL,
  `fecha_evento` date NOT NULL,
  `hora_evento` time NOT NULL,
  `id_cat_evento` tinyint(10) NOT NULL,
  `id_inv` tinyint(4) NOT NULL,
  `clave` varchar(10) NOT NULL,
  `editado` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`evento_id`, `nombre_evento`, `fecha_evento`, `hora_evento`, `id_cat_evento`, `id_inv`, `clave`, `editado`) VALUES
(1, 'Responsive Web Design', '2016-12-09', '10:00:00', 3, 1, 'taller_01', NULL),
(2, 'Flexbox', '2016-12-09', '12:00:00', 3, 2, 'taller_02', NULL),
(3, 'HTML5 y CSS3', '2016-12-09', '14:00:00', 3, 3, 'taller_03', NULL),
(4, 'Drupal', '2016-12-09', '17:00:00', 3, 4, 'taller_04', NULL),
(5, 'WordPress', '2016-12-09', '19:00:00', 3, 5, 'taller_05', NULL),
(6, 'Como ser freelancer', '2016-12-09', '10:00:00', 2, 6, 'conf_01', NULL),
(7, 'Tecnologías del Futuro', '2016-12-09', '17:00:00', 2, 1, 'conf_02', NULL),
(8, 'Seguridad en la Web', '2016-12-09', '19:00:00', 2, 2, 'conf_03', NULL),
(9, 'Diseño UI y UX para móviles', '2016-12-09', '10:00:00', 1, 6, 'sem_01', NULL),
(10, 'AngularJS', '2016-12-10', '10:00:00', 3, 1, 'taller_06', NULL),
(11, 'PHP y MySQL', '2016-12-10', '12:00:00', 3, 2, 'taller_07', NULL),
(12, 'JavaScript Avanzado', '2016-12-10', '14:00:00', 3, 3, 'taller_08', NULL),
(13, 'SEO en Google', '2016-12-10', '17:00:00', 3, 4, 'taller_09', NULL),
(14, 'De Photoshop a HTML5 y CSS3', '2016-12-10', '19:00:00', 3, 5, 'taller_10', NULL),
(15, 'PHP Intermedio y Avanzado', '2016-12-10', '21:00:00', 3, 6, 'taller_11', NULL),
(16, 'Como crear una tienda online que venda millones en pocos día', '2016-12-10', '10:00:00', 2, 6, 'conf_04', NULL),
(17, 'Los mejores lugares para encontrar trabajo', '2016-12-10', '17:00:00', 2, 1, 'conf_05', NULL),
(18, 'Pasos para crear un negocio rentable ', '2016-12-10', '19:00:00', 2, 2, 'conf_06', NULL),
(19, 'Aprende a Programar en una mañana', '2016-12-10', '10:00:00', 1, 3, 'sem_02', NULL),
(20, 'Diseño UI y UX para móviles', '2016-12-10', '17:00:00', 1, 5, 'sem_03', NULL),
(21, 'Laravel', '2016-12-11', '10:00:00', 3, 1, 'taller_12', NULL),
(22, 'Crea tu propia API', '2016-12-11', '12:00:00', 3, 2, 'taller_13', NULL),
(23, 'JavaScript y jQuery', '2016-12-11', '14:00:00', 3, 3, 'taller_14', NULL),
(24, 'Creando Plantillas para WordPress', '2016-12-11', '17:00:00', 3, 4, 'taller_15', NULL),
(25, 'Tiendas Virtuales en Magento', '2016-12-11', '19:00:00', 3, 5, 'taller_16', NULL),
(26, 'Como hacer Marketing en línea', '2016-12-11', '10:00:00', 2, 6, 'conf_07', NULL),
(27, '¿Con que lenguaje debo empezar?', '2016-12-11', '17:00:00', 2, 2, 'conf_08', NULL),
(28, 'Frameworks y librerias Open Source', '2016-12-11', '19:00:00', 2, 3, 'conf_09', NULL),
(29, 'Creando una App en Android en una mañana', '2016-12-11', '10:00:00', 1, 4, 'sem_04', NULL),
(30, 'Creando una App en iOS en una tarde', '2016-12-11', '17:00:00', 1, 1, 'sem_05', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invitados`
--

CREATE TABLE `invitados` (
  `invitado_id` tinyint(4) NOT NULL,
  `nombre_invitado` varchar(30) NOT NULL,
  `apellido_invitado` varchar(30) NOT NULL,
  `descripcion` text NOT NULL,
  `url_imagen` varchar(50) NOT NULL,
  `editado` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `invitados`
--

INSERT INTO `invitados` (`invitado_id`, `nombre_invitado`, `apellido_invitado`, `descripcion`, `url_imagen`, `editado`) VALUES
(1, 'Rafael', 'Bautista', 'Eaque earum dolores, aliquam aspernatur ipsum iure ad reiciendis cupiditate perspiciatis doloribus mollitia! Suscipit deleniti dignissimos nemo, sapiente numquam magni consectetur sunt!', 'invitado1.jpg', '2022-05-31 04:27:44'),
(2, 'Shari', 'Herrera', 'Ex praesentium ea voluptate modi autem amet eos vero architecto, laudantium tempora deleniti maiores fuga. Nihil odio rem at veritatis ducimus vitae?', 'invitado2.jpg', '2022-05-31 04:28:02'),
(3, 'Gregorio', 'Sanchez', 'Vitae debitis consequatur in! Unde dolorum velit eius assumenda. Eaque magni, velit magnam atque doloribus sint consequuntur dolore, ad consequatur similique earum?', 'invitado3.jpg', '2022-05-31 04:28:21'),
(4, 'Susana', 'Rivera', 'Minus repellat, temporibus quod nemo alias accusamus ab quae eaque vero voluptatem laudantium voluptatibus in consectetur id dicta dolor molestiae sunt corrupti.                                  ', 'invitado4.jpg', '2022-05-31 04:28:37'),
(5, 'Harold', 'García', 'Autem sapiente beatae quo officia, quis repellendus laboriosam quae alias incidunt repellat doloremque possimus explicabo labore eveniet soluta veniam. Veritatis, facilis sunt.', 'invitado5.jpg', '2022-05-31 04:28:50'),
(6, 'Susan', 'Sanchez', 'Praesentium distinctio voluptatem numquam provident quisquam tempore autem laudantium officia molestiae? Soluta nulla facilis earum porro ad ipsum aliquam eaque eos esse!', 'invitado6.jpg', '2022-05-31 04:29:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regalos`
--

CREATE TABLE `regalos` (
  `ID_regalo` int(11) NOT NULL,
  `nombre_regalo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `regalos`
--

INSERT INTO `regalos` (`ID_regalo`, `nombre_regalo`) VALUES
(1, 'Pulsera'),
(2, 'Etiquetas'),
(3, 'Plumas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registrados`
--

CREATE TABLE `registrados` (
  `ID_registrado` bigint(20) NOT NULL,
  `nombre_registrado` varchar(50) NOT NULL,
  `apellido_registrado` varchar(50) NOT NULL,
  `email_registrado` varchar(100) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `pases_articulos` longtext NOT NULL,
  `talleres_registrados` longtext NOT NULL,
  `regalo` int(11) NOT NULL,
  `total_pagado` varchar(50) NOT NULL,
  `payment_id` varchar(50) DEFAULT NULL,
  `payer_id` varchar(50) DEFAULT NULL,
  `payment_status` varchar(50) NOT NULL DEFAULT 'no pagado',
  `editado` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `registrados`
--

INSERT INTO `registrados` (`ID_registrado`, `nombre_registrado`, `apellido_registrado`, `email_registrado`, `fecha_registro`, `pases_articulos`, `talleres_registrados`, `regalo`, `total_pagado`, `payment_id`, `payer_id`, `payment_status`, `editado`) VALUES
(1, 'Juan', 'De la torre', 'juan@correo.com', '2022-05-25 22:59:23', '{\"un_dia\":1,\"pase_completo\":1,\"pase_2dias\":1,\"camisas\":1,\"etiquetas\":2}', '{\"eventos\":[\"taller_01\"]}', 2, '43.3', 'PAYID-MKHJRLQ9BS54460YW349911N', 'APQ436KWQ9SY2', 'approved', NULL),
(2, 'Karen', 'Perez', 'karen@correo.com', '2022-05-26 23:01:40', '{\"un_dia\":1,\"pase_completo\":1,\"pase_2dias\":1,\"camisas\":2}', '{\"eventos\":[\"conf_05\"]}', 3, '118.6', 'PAYID-MKHJSNQ0E870113SE9129113', 'APQ436KWQ9SY2', 'approved', NULL),
(3, 'Jose', 'Gomez', 'jose@correo.com', '2022-05-26 23:09:38', '{\"un_dia\":1,\"pase_completo\":1,\"pase_2dias\":1}', '{\"eventos\":[\"conf_01\",\"conf_02\",\"conf_03\"]}', 1, '30', NULL, NULL, 'no pagado', NULL),
(4, 'Pablo', 'Lopez', 'pablo@correo.com', '2022-05-31 23:10:14', '{\"un_dia\":1,\"pase_completo\":1,\"pase_2dias\":1}', '{\"eventos\":[\"conf_01\",\"conf_02\",\"conf_03\"]}', 2, '30', 'PAYID-MKHJWNY7C030343A6178804M', 'APQ436KWQ9SY2', 'approved', NULL),
(5, 'Hugo', 'Flores', 'hugo@correo.com', '2022-05-31 23:14:15', '{\"un_dia\":1,\"pase_completo\":1,\"pase_2dias\":1,\"camisas\":1,\"etiquetas\":2}', '{\"eventos\":[\"conf_03\",\"sem_01\"]}', 2, '113.3', 'PAYID-MKHJYKA8EK927670W036431M', 'APQ436KWQ9SY2', 'approved', NULL),
(6, 'Karen', 'Lopez', 'karenlopez@correo.com', '2022-06-01 12:31:18', '{\"un_dia\":1,\"pase_completo\":1,\"pase_2dias\":1,\"camisas\":3,\"etiquetas\":2}', '{\"eventos\":[\"9\",\"7\",\"3\"]}', 1, '61.900000000000006', NULL, NULL, 'no pagado', NULL),
(7, 'Karen', 'Lopez', 'karenlopez@correo.com', '2022-06-01 12:32:56', '{\"un_dia\":1,\"pase_completo\":1,\"pase_2dias\":1,\"camisas\":1,\"etiquetas\":2}', '{\"eventos\":[\"9\",\"7\",\"3\"]}', 1, '43.3', NULL, NULL, 'no pagado', NULL),
(8, 'Karen', 'Lopez', 'karenlopez@correo.com', '2022-06-01 12:33:34', '{\"un_dia\":1,\"pase_completo\":1,\"pase_2dias\":1,\"camisas\":1,\"etiquetas\":2}', '{\"eventos\":[\"9\",\"7\",\"3\"]}', 1, '43.3', 'PAYID-MKLUA7Y3C84031430674331A', 'APQ436KWQ9SY2', 'approved', NULL),
(9, 'Bergara', 'Leuman', 'prueba@correo.com', '2022-06-01 12:35:26', '{\"un_dia\":1,\"pase_completo\":1,\"pase_2dias\":1,\"camisas\":2,\"etiquetas\":2}', '{\"eventos\":[\"9\"]}', 1, '52.6', 'PAYID-MKLUB3Y1ED45586LS111404T', 'APQ436KWQ9SY2', 'approved', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Indices de la tabla `categoria_evento`
--
ALTER TABLE `categoria_evento`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`evento_id`),
  ADD KEY `id_cat_evento` (`id_cat_evento`),
  ADD KEY `id_inv` (`id_inv`);

--
-- Indices de la tabla `invitados`
--
ALTER TABLE `invitados`
  ADD PRIMARY KEY (`invitado_id`);

--
-- Indices de la tabla `regalos`
--
ALTER TABLE `regalos`
  ADD PRIMARY KEY (`ID_regalo`);

--
-- Indices de la tabla `registrados`
--
ALTER TABLE `registrados`
  ADD PRIMARY KEY (`ID_registrado`),
  ADD KEY `registrados_ibfk_1` (`regalo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admins`
--
ALTER TABLE `admins`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `categoria_evento`
--
ALTER TABLE `categoria_evento`
  MODIFY `id_categoria` tinyint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `evento_id` tinyint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `invitados`
--
ALTER TABLE `invitados`
  MODIFY `invitado_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `regalos`
--
ALTER TABLE `regalos`
  MODIFY `ID_regalo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `registrados`
--
ALTER TABLE `registrados`
  MODIFY `ID_registrado` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`id_cat_evento`) REFERENCES `categoria_evento` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `eventos_ibfk_2` FOREIGN KEY (`id_inv`) REFERENCES `invitados` (`invitado_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `registrados`
--
ALTER TABLE `registrados`
  ADD CONSTRAINT `registrados_ibfk_1` FOREIGN KEY (`regalo`) REFERENCES `regalos` (`ID_regalo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
