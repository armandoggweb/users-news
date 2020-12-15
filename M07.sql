-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 13-12-2020 a las 21:40:09
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `M07`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Noticias`
--

CREATE TABLE `Noticias` (
  `ID` int(11) NOT NULL,
  `Titulo` varchar(30) NOT NULL,
  `Contenido` text NOT NULL,
  `Autor` varchar(20) NOT NULL,
  `Hora_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `Likes` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Noticias`
--

INSERT INTO `Noticias` (`ID`, `Titulo`, `Contenido`, `Autor`, `Hora_creacion`, `Likes`) VALUES
(1, 'Prueba_1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin feugiat luctus nunc in efficitur. Praesent eget placerat enim, in fringilla augue.', 'Autor_1', '2020-12-13 18:32:38', 0),
(2, 'Prueba_2', 'Fusce gravida, massa vitae pellentesque sagittis, est orci facilisis metus, a condimentum ante lorem ac metus.', 'Autor_2', '2020-12-13 18:32:38', 0),
(3, 'Prueba_3', ' Aenean vehicula sit amet neque in tristique.', 'Autor_3', '2020-12-13 18:35:55', 1),
(4, 'Prueba_4', 'Donec sed magna turpis. Nullam lorem nisl, porta eu ligula quis, gravida placerat ex. Integer rhoncus arcu quis lacus eleifend lobortis.\r\n\r\n', 'Autor_4', '2020-12-13 18:35:55', 0),
(5, 'Prueba_5', 'Morbi metus turpis, tempus sed tincidunt in, luctus a tellus. ', 'Autor_5', '2020-12-13 18:35:55', 0),
(6, 'Prueba_6', 'Phasellus eu blandit sem. Nulla consequat iaculis purus, id placerat metus tristique id.', 'Autor_6', '2020-12-13 18:35:55', 0),
(7, 'Prueba_7', 'Donec dolor justo, volutpat venenatis mollis at, auctor quis nisi. ', 'Autor_7', '2020-12-13 18:46:59', 5),
(8, 'Prueba_8', 'Vivamus dapibus est erat, non varius ipsum auctor non. Sed hendrerit neque id enim egestas, vitae pharetra massa euismod.', 'Autor_8', '2020-12-13 18:46:59', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuarios`
--

CREATE TABLE `Usuarios` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Contraseña` varchar(15) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `Edad` tinyint(3) UNSIGNED NOT NULL,
  `Fecha_nacimiento` date NOT NULL,
  `Direccion` varchar(30) NOT NULL,
  `Codigo_postal` char(5) NOT NULL,
  `Provincia` varchar(15) NOT NULL,
  `Genero` set('Hombre','Mujer') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Usuarios`
--

INSERT INTO `Usuarios` (`ID`, `Nombre`, `Contraseña`, `Email`, `Edad`, `Fecha_nacimiento`, `Direccion`, `Codigo_postal`, `Provincia`, `Genero`) VALUES
(1, 'Armando', 'qwerty', 'armando@mail.com', 27, '1993-06-18', 'Canarias', '35555', 'Canarias', 'Hombre'),
(2, 'Juan', 'qwerty', 'juan@mailcom', 23, '1997-06-17', 'Lugar', '33333', 'Lugar', 'Hombre'),
(3, 'María', 'qwerty', 'maria@mail.com', 27, '1993-10-12', 'Sitio', '22222', 'Provin', 'Mujer');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Noticias`
--
ALTER TABLE `Noticias`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Nombre` (`Nombre`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
