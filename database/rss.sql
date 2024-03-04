-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-03-2024 a las 06:07:47
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rss`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id_noticia` int(50) NOT NULL,
  `Titulo` varchar(50) NOT NULL,
  `Descripcion` varchar(50) NOT NULL,
  `Fecha` varchar(50) NOT NULL,
  `Link` varchar(50) NOT NULL,
  `id_sitio` int(50) NOT NULL,
  `id_usuario` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `palabras_clave`
--

CREATE TABLE `palabras_clave` (
  `id_palabra` int(50) NOT NULL,
  `id_noticia` int(50) NOT NULL,
  `palabra_Clave` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sitios`
--

CREATE TABLE `sitios` (
  `id_sitio` int(50) NOT NULL,
  `url_sitio` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sitios`
--

INSERT INTO `sitios` (`id_sitio`, `url_sitio`) VALUES
(1, 'https://www.yucatan.com.mx/feed'),
(7, 'https://feeds.bbci.co.uk/news/world/rss.xml');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sitiosporusuario`
--

CREATE TABLE `sitiosporusuario` (
  `id_sitoUsuario` int(50) NOT NULL,
  `id_usuario` int(50) NOT NULL,
  `id_sitio` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sitiosporusuario`
--

INSERT INTO `sitiosporusuario` (`id_sitoUsuario`, `id_usuario`, `id_sitio`) VALUES
(1, 1, 1),
(3, 1, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(50) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Apellido` varchar(50) NOT NULL,
  `Usuario` varchar(50) NOT NULL,
  `Contraseña` varchar(50) NOT NULL,
  `Correo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `Nombre`, `Apellido`, `Usuario`, `Contraseña`, `Correo`) VALUES
(1, 'D', 'D', 'D', 'D', 'D@D.D'),
(4, 'a', 'a', 'a', 'a', 'a@a');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id_noticia`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_sitio` (`id_sitio`);

--
-- Indices de la tabla `palabras_clave`
--
ALTER TABLE `palabras_clave`
  ADD PRIMARY KEY (`id_palabra`),
  ADD KEY `id_noticia` (`id_noticia`);

--
-- Indices de la tabla `sitios`
--
ALTER TABLE `sitios`
  ADD PRIMARY KEY (`id_sitio`);

--
-- Indices de la tabla `sitiosporusuario`
--
ALTER TABLE `sitiosporusuario`
  ADD PRIMARY KEY (`id_sitoUsuario`),
  ADD KEY `id_sitio` (`id_sitio`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id_noticia` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `palabras_clave`
--
ALTER TABLE `palabras_clave`
  MODIFY `id_palabra` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sitios`
--
ALTER TABLE `sitios`
  MODIFY `id_sitio` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `sitiosporusuario`
--
ALTER TABLE `sitiosporusuario`
  MODIFY `id_sitoUsuario` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `noticias_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `noticias_ibfk_2` FOREIGN KEY (`id_sitio`) REFERENCES `sitios` (`id_sitio`);

--
-- Filtros para la tabla `palabras_clave`
--
ALTER TABLE `palabras_clave`
  ADD CONSTRAINT `palabras_clave_ibfk_1` FOREIGN KEY (`id_noticia`) REFERENCES `noticias` (`id_noticia`);

--
-- Filtros para la tabla `sitiosporusuario`
--
ALTER TABLE `sitiosporusuario`
  ADD CONSTRAINT `sitiosporusuario_ibfk_1` FOREIGN KEY (`id_sitio`) REFERENCES `sitios` (`id_sitio`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sitiosporusuario_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
