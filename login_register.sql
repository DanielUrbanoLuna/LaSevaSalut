-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-04-2024 a las 10:46:00
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `login_register`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alertas`
--

CREATE TABLE `alertas` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `mensaje` text DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `alertas`
--

INSERT INTO `alertas` (`id`, `id_usuario`, `mensaje`, `fecha`) VALUES
(1, 8, 'Recuerda, el día 7654-05-01 tu mascota tiene una visita de tipo lesión física.', '2024-03-23'),
(2, 11, 'Recuerda, el día 2222-03-04 tu mascota tiene una visita de tipo geriátría.', '2024-03-23'),
(3, 11, 'Recuerda, el día 2222-02-02 tu mascota tiene una visita de tipo chequeos_generales.', '2024-03-23'),
(4, 9, 'Recuerda, el día 2025-11-23 tu mascota tiene una visita de tipo chequeos_generales.', '2024-04-08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amigos`
--

CREATE TABLE `amigos` (
  `id_amistad` int(11) NOT NULL,
  `id_usuario1` int(11) DEFAULT NULL,
  `id_usuario2` int(11) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `amigos`
--

INSERT INTO `amigos` (`id_amistad`, `id_usuario1`, `id_usuario2`, `estado`) VALUES
(93, 9, 11, 'pendiente'),
(94, 9, 11, 'aceptada'),
(95, 11, 9, 'aceptada'),
(96, 11, 10, 'pendiente'),
(97, 11, 10, 'aceptada'),
(98, 10, 11, 'aceptada'),
(99, 8, 10, 'pendiente'),
(100, 8, 10, 'aceptada'),
(101, 10, 8, 'aceptada'),
(102, 9, 10, 'pendiente'),
(103, 9, 10, 'aceptada'),
(104, 10, 9, 'aceptada'),
(105, 12, 9, 'pendiente'),
(106, 12, 9, 'aceptada'),
(107, 9, 12, 'aceptada'),
(108, 9, 8, 'pendiente'),
(109, 9, 8, 'aceptada'),
(110, 8, 9, 'aceptada'),
(112, 14, 10, 'pendiente'),
(113, 14, 10, 'aceptada'),
(114, 10, 14, 'aceptada'),
(115, 15, 8, 'pendiente'),
(116, 15, 8, 'aceptada'),
(117, 8, 15, 'aceptada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_chat`
--

CREATE TABLE `historial_chat` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_amigo` int(11) DEFAULT NULL,
  `mensaje` text DEFAULT NULL,
  `fecha_envio` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `historial_chat`
--

INSERT INTO `historial_chat` (`id`, `id_usuario`, `id_amigo`, `mensaje`, `fecha_envio`) VALUES
(5, 9, 11, 'hola mama', '2024-04-04 10:31:04'),
(6, 9, 11, 'que tal?', '2024-04-04 10:35:41'),
(7, 11, 9, 'muy bien, y tu que tal estas hija?', '2024-04-04 10:48:56'),
(8, 10, 8, 'tu me amas?? ;(', '2024-04-04 10:53:18'),
(9, 8, 10, 'más que tu a mi', '2024-04-04 10:53:48'),
(10, 10, 10, 'amor?', '2024-04-04 10:54:46'),
(11, 8, 10, 'amoooor???', '2024-04-04 10:56:22'),
(12, 8, 10, 'luego vamos al abc', '2024-04-04 10:56:45'),
(13, 10, 8, 'jaaaaaa(LLL)', '2024-04-04 10:57:13'),
(14, 10, 11, 'me hubiera gustado conocerte ', '2024-04-04 10:58:17'),
(15, 10, 8, 'holaaa', '2024-04-04 10:59:10'),
(16, 10, 8, 'hola', '2024-04-04 11:04:31'),
(17, 10, 8, 'hoy', '2024-04-04 11:11:11'),
(18, 9, 12, 'hola', '2024-04-08 12:35:13'),
(19, 9, 11, 'hola?', '2024-04-08 13:00:17'),
(20, 9, 12, 'hola', '2024-04-08 13:00:37'),
(21, 8, 9, 'hola madre', '2024-04-08 13:32:16'),
(22, 8, 15, 'hola frank:D', '2024-04-10 15:03:05'),
(23, 15, 8, '¡Hola Dani!', '2024-04-10 15:03:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascotas`
--

CREATE TABLE `mascotas` (
  `id_mascota` int(11) NOT NULL,
  `nombre_mascota` varchar(100) NOT NULL,
  `tipo_mascota` varchar(50) NOT NULL,
  `genero` varchar(10) NOT NULL,
  `edad` int(11) NOT NULL,
  `raza` varchar(100) DEFAULT NULL,
  `peso` decimal(5,2) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `correo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `mascotas`
--

INSERT INTO `mascotas` (`id_mascota`, `nombre_mascota`, `tipo_mascota`, `genero`, `edad`, `raza`, `peso`, `id_usuario`, `correo`) VALUES
(7, 'ligero', 'Perro', 'Macho', 6, 'milleches', 25.00, 9, ''),
(8, 'lucero', 'Perro', 'Macho', 6, 'milleches', 27.00, 11, ''),
(9, 'gfde', 'Perro', 'Macho', 6, 'milleches', 26.00, 11, ''),
(10, 'ljfhjkl', 'Gato', 'Hembra', 12, 'comun', 4.00, 11, ''),
(11, 'yhgfik', 'Perro', 'Macho', 6, 'milleches', 2.00, 11, ''),
(12, 'EWFWDEFW', 'Perro', 'Macho', 2, 'milleches', 4.00, 11, ''),
(13, 'floki', 'Gato', 'Macho', 2, 'ragdoll', 5.00, 8, ''),
(14, 'kenji', 'Gato', 'Macho', 2, 'ragdoll', 6.00, 8, ''),
(15, 'wefgb', 'Perro', 'Macho', 4, 'milleches', 6.00, 8, 'urbanobdn@gmail.com'),
(16, 'gthfjnb', 'Perro', 'Macho', 2, 'milleches', 6.00, 8, 'urbanobdn@gmail.com'),
(17, 'qwert', 'Perro', 'Macho', 2, 'milleches', 8.00, 8, 'urbanobdn@gmail.com'),
(18, 'Dezzy', 'Perro', 'Hembra', 6, 'Pastor Blanco', 120.00, 15, 'fastfrank.iphone@gmail.com'),
(19, 'Quinky', 'Gato', 'Macho', 4, 'Blanco Negro', 5.00, 15, 'fastfrank.iphone@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_mascota`
--

CREATE TABLE `perfil_mascota` (
  `id_perfil_mascota` int(11) NOT NULL,
  `id_mascota` int(11) DEFAULT NULL,
  `visita_veterinaria` varchar(255) DEFAULT NULL,
  `vacunas` varchar(255) DEFAULT NULL,
  `historial_clinico` text DEFAULT NULL,
  `nombre_mascota` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `perfil_mascota`
--

INSERT INTO `perfil_mascota` (`id_perfil_mascota`, `id_mascota`, `visita_veterinaria`, `vacunas`, `historial_clinico`, `nombre_mascota`) VALUES
(1, 7, NULL, 'rabia,tos de las perreras', NULL, 'ligero'),
(2, 8, NULL, 'rabia,moquillo', NULL, 'lucero'),
(3, 9, NULL, 'rabia', NULL, 'gfde'),
(4, 10, NULL, NULL, NULL, 'ljfhjkl'),
(5, 11, NULL, NULL, NULL, 'yhgfik'),
(6, 12, NULL, 'rabia,moquillo', NULL, 'EWFWDEFW'),
(7, 13, NULL, 'rabia,herpervirus felino', NULL, 'floki'),
(8, 14, NULL, NULL, NULL, 'kenji'),
(9, 15, NULL, NULL, NULL, 'wefgb'),
(10, 16, NULL, 'rabia', NULL, 'gthfjnb'),
(11, 17, NULL, NULL, NULL, 'qwert'),
(12, 18, NULL, NULL, NULL, 'Dezzy'),
(13, 19, NULL, NULL, NULL, 'Quinky');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes_amistad`
--

CREATE TABLE `solicitudes_amistad` (
  `id` int(11) NOT NULL,
  `id_usuario_envia` int(11) DEFAULT NULL,
  `id_usuario_recibe` int(11) DEFAULT NULL,
  `fecha_envio` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` enum('pendiente','aceptada','rechazada') DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `solicitudes_amistad`
--

INSERT INTO `solicitudes_amistad` (`id`, `id_usuario_envia`, `id_usuario_recibe`, `fecha_envio`, `estado`) VALUES
(36, 9, 11, '2024-04-04 08:38:40', 'aceptada'),
(37, 11, 10, '2024-04-04 09:47:55', 'aceptada'),
(38, 8, 10, '2024-04-04 10:52:41', 'aceptada'),
(39, 9, 10, '2024-04-05 15:53:12', 'aceptada'),
(40, 12, 9, '2024-04-08 12:34:38', 'aceptada'),
(41, 9, 8, '2024-04-08 13:31:41', 'aceptada'),
(42, 13, 9, '2024-04-08 14:08:05', 'rechazada'),
(43, 14, 10, '2024-04-09 10:14:49', 'aceptada'),
(44, 15, 8, '2024-04-10 15:01:44', 'aceptada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `usuario`, `contrasena`) VALUES
(8, 'dani', 'urbanobdn@gmail.com', 'dani', '1234'),
(9, 'juani', 'juani_', 'juani', '1234'),
(10, 'elize', 'elizevdv', 'elize', '1234'),
(11, 'eleuteria', 'eleuteria_', 'eleuteria', '1234'),
(12, 'perico', 'perico_', 'perico', '1234'),
(13, 'monse', 'monse_', 'monse', '1234'),
(14, 'mitch', 'mitch_', 'mitch', '1234'),
(15, 'Frank', 'fastfrank.iphone@gmail.com', 'FastFrank', 'FF1234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitas`
--

CREATE TABLE `visitas` (
  `id_visita` int(11) NOT NULL,
  `id_mascota` int(11) DEFAULT NULL,
  `tipo_visita` varchar(255) DEFAULT NULL,
  `fecha_visita` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `visitas`
--

INSERT INTO `visitas` (`id_visita`, `id_mascota`, `tipo_visita`, `fecha_visita`) VALUES
(3, 8, 'chequeos_generales', '2024-09-02'),
(4, 16, 'chequeos_generales', '2024-03-29'),
(5, 17, 'chequeos_generales', '2024-03-23'),
(6, 15, 'chequeos_generales', '2024-03-23'),
(7, 15, 'chequeos_generales', '2024-03-26'),
(8, 8, 'lesión física', '2024-06-26'),
(9, 8, 'lesión física', '2024-07-09'),
(10, 12, 'chequeos_generales', '2024-04-03'),
(11, 13, 'chequeos_generales', '2025-01-01'),
(12, 16, 'chequeos_generales', '2024-02-01'),
(13, 13, 'chequeos_generales', '0033-03-03'),
(14, 13, 'lesión física', '7654-05-01'),
(15, 8, 'geriátría', '2222-03-04'),
(16, 9, 'chequeos_generales', '2222-02-02'),
(17, 7, 'chequeos_generales', '2025-11-23');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alertas`
--
ALTER TABLE `alertas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `amigos`
--
ALTER TABLE `amigos`
  ADD PRIMARY KEY (`id_amistad`),
  ADD KEY `id_usuario1` (`id_usuario1`),
  ADD KEY `id_usuario2` (`id_usuario2`);

--
-- Indices de la tabla `historial_chat`
--
ALTER TABLE `historial_chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_amigo` (`id_amigo`);

--
-- Indices de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  ADD PRIMARY KEY (`id_mascota`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `perfil_mascota`
--
ALTER TABLE `perfil_mascota`
  ADD PRIMARY KEY (`id_perfil_mascota`),
  ADD KEY `id_mascota` (`id_mascota`);

--
-- Indices de la tabla `solicitudes_amistad`
--
ALTER TABLE `solicitudes_amistad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `visitas`
--
ALTER TABLE `visitas`
  ADD PRIMARY KEY (`id_visita`),
  ADD KEY `id_mascota` (`id_mascota`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alertas`
--
ALTER TABLE `alertas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `amigos`
--
ALTER TABLE `amigos`
  MODIFY `id_amistad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT de la tabla `historial_chat`
--
ALTER TABLE `historial_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  MODIFY `id_mascota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `perfil_mascota`
--
ALTER TABLE `perfil_mascota`
  MODIFY `id_perfil_mascota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `solicitudes_amistad`
--
ALTER TABLE `solicitudes_amistad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `visitas`
--
ALTER TABLE `visitas`
  MODIFY `id_visita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alertas`
--
ALTER TABLE `alertas`
  ADD CONSTRAINT `alertas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `amigos`
--
ALTER TABLE `amigos`
  ADD CONSTRAINT `amigos_ibfk_1` FOREIGN KEY (`id_usuario1`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `amigos_ibfk_2` FOREIGN KEY (`id_usuario2`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `historial_chat`
--
ALTER TABLE `historial_chat`
  ADD CONSTRAINT `historial_chat_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `historial_chat_ibfk_2` FOREIGN KEY (`id_amigo`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `mascotas`
--
ALTER TABLE `mascotas`
  ADD CONSTRAINT `mascotas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `perfil_mascota`
--
ALTER TABLE `perfil_mascota`
  ADD CONSTRAINT `perfil_mascota_ibfk_1` FOREIGN KEY (`id_mascota`) REFERENCES `mascotas` (`id_mascota`);

--
-- Filtros para la tabla `visitas`
--
ALTER TABLE `visitas`
  ADD CONSTRAINT `visitas_ibfk_1` FOREIGN KEY (`id_mascota`) REFERENCES `mascotas` (`id_mascota`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
