-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-01-2022 a las 00:59:37
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `alimentos`
--
CREATE DATABASE IF NOT EXISTS `dws_mvc_instituto` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `dws_mvc_instituto`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `nia` int(8) NOT NULL,
  `email` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `cPostal` int(5) NOT NULL,
  `localidad` varchar(255) DEFAULT NULL,
  `fNacimiento` date DEFAULT NULL,
  `fPerfil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `nombre`, `nia`, `email`, `direccion`, `cPostal`, `localidad`, `fNacimiento`, `fPerfil`) VALUES
(1, 'Nuria Ramírez Pons', 85429874, 'nuria@gmail.com', 'Montesa 28-3', 46020, 'Valencia', '1999-05-28', '85429874/nuria_ramirez_pons.jpg'),
(2, 'Alfonso Ruiz Mendez', 59863214, 'alfonso@gmail.com', 'Bolivia 12-1', 46018, 'Valencia', '1991-03-12', '59863214/alfonso_ruiz_mendez.jpg'),
(3, 'Marta Fonseca Yuste', 56211486, 'marta@gmail.com', 'Picapedreros 89-19', 46019, 'Valencia', '1999-05-14', '56211486/marta_fonseca_yuste.jpg'),
(4, 'Liliana Vergara Alarcon', 23567458, 'liliana@gmail.com', 'Misionero Vicente Caña 1-25', 46950, 'Valencia', '2008-08-29', '23567458/liliana_vergara_alarcon.jpg'),
(5, 'Adam Montoro Torre', 33698455, 'adam@gmail.com', 'Mestre Palau 90-3', 46930, 'Valencia', '2003-12-02', '33698455/adam_montoro_torre.jpg'),
(6, 'Eulalia Vilchez Saenz', 96657112, 'eulalia@gmail.com', 'Mayor 11-3', 46920, 'Valencia', '2000-04-17', '96657112/eulalia_vilchez_saenz.jpg'),
(7, 'Fernando Benavides Carrera', 85547133, 'fernando@gmail.com', 'Doctor Enrique López 7-8', 46018, 'Valencia', '1985-01-25', '85547133/fernando_benavides_carrera.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaturas`
--

CREATE TABLE `asignaturas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `profesor` varchar(150) NOT NULL,
  `horasTotales` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asignaturas`
--

INSERT INTO `asignaturas` (`id`, `nombre`, `profesor`, `horasTotales`) VALUES
(1, 'DIW', 'Pedro Jose Palacios', 220),
(2, 'DWC', 'Ines Perera', 300),
(3, 'DWS', 'Belen Vila', 350),
(4, 'DAM', 'Monica Riera', 120),
(5, 'EIE', 'Xavi Pedraza', 80);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

CREATE TABLE `clases` (
  `id` int(11) NOT NULL,
  `idAlumno` int(3) NOT NULL,
  `idAsignatura` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clases`
--

INSERT INTO `clases` (`id`, `idAlumno`, `idAsignatura`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 4),
(4, 1, 5),
(5, 2, 2),
(6, 2, 3),
(7, 2, 5),
(8, 3, 2),
(9, 3, 4),
(10, 3, 5),
(11, 4, 1),
(12, 4, 2),
(13, 4, 4),
(14, 4, 5),
(15, 5, 3),
(16, 5, 4),
(17, 5, 5),
(18, 6, 1),
(19, 6, 2),
(20, 6, 3),
(21, 6, 3),
(22, 6, 4),
(23, 6, 5),
(24, 7, 1),
(25, 7, 4),
(26, 7, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `user` varchar(30) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `nivel` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fPerfil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `user`, `pass`, `nivel`, `email`, `fPerfil`) VALUES
(1, 'miguel', 'miguel', 1, 'magallart58@gmail.com', 'miguel/miguel.jpg'),
(2, 'admin', 'admin', 2, 'admin@server.com', 'admin/admin.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nia` (`nia`);

--
-- Indices de la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `clases`
--
ALTER TABLE `clases`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `idAlumno` (`idAlumno`),
  ADD KEY `idAsignatura` (`idAsignatura`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_user` (`user`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clases`
--
ALTER TABLE `clases`
  ADD CONSTRAINT `clases_ibfk_1` FOREIGN KEY (`idAlumno`) REFERENCES `alumnos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `clases_ibfk_2` FOREIGN KEY (`idAsignatura`) REFERENCES `asignaturas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
