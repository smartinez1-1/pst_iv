-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-04-2023 a las 03:40:29
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
-- Base de datos: `bd_pst`
--
CREATE DATABASE IF NOT EXISTS `bd_pst` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bd_pst`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ano_escolar`
--

CREATE TABLE `ano_escolar` (
  `id_ano_escolar` int(11) NOT NULL,
  `ano_escolar_nombre` varchar(45) NOT NULL,
  `estado_ano_escolar` tinyint(1) NOT NULL,
  `estado_incripciones` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE `carrera` (
  `id_carrera` int(11) NOT NULL,
  `nombre_carrera` varchar(45) NOT NULL,
  `codigo_carrera` varchar(6) NOT NULL,
  `estado_carrera` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comunidad`
--

CREATE TABLE `comunidad` (
  `id_comunidad` int(11) NOT NULL,
  `nombre_comunidad` varchar(45) NOT NULL,
  `tipo_comunidad` varchar(45) NOT NULL,
  `direccion_comunidad` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `id_estudiante` int(11) NOT NULL,
  `cedula_usuario` int(11) NOT NULL,
  `turno_estudiante` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `id_grupo` int(11) NOT NULL,
  `nombre_grupo` varchar(30) NOT NULL,
  `estado_grupo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_alumno`
--

CREATE TABLE `grupo_alumno` (
  `id_grupo` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcion`
--

CREATE TABLE `inscripcion` (
  `id_inscripcion` int(11) NOT NULL,
  `id_carrera` int(11) NOT NULL,
  `id_seccion` int(11) NOT NULL,
  `id_estudiante` int(11) NOT NULL,
  `id_semestre` int(11) NOT NULL,
  `id_ano_escolar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `id_proyecto` int(11) NOT NULL,
  `id_comunidad` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `id_ano_escolar` int(11) NOT NULL,
  `id_tutor` int(11) NOT NULL,
  `titulo_proyecto` varchar(45) NOT NULL,
  `plantamiento_proyecto` varchar(45) NOT NULL,
  `objetivos_generales_proyecto` varchar(45) NOT NULL,
  `objetivos_espesificos_proyecto` varchar(45) NOT NULL,
  `tipo_proyecto` varchar(45) NOT NULL,
  `estado_proyecto` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

CREATE TABLE `seccion` (
  `id_seccion` int(11) NOT NULL,
  `numero_seccion` varchar(5) NOT NULL,
  `carrera_id` int(11) NOT NULL,
  `estado_seccion` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semestre`
--

CREATE TABLE `semestre` (
  `id_semestre` int(11) NOT NULL,
  `des_semestre` varchar(15) NOT NULL,
  `fecha_inicio_semestre` date NOT NULL,
  `fecha_cierre_semestre` date NOT NULL,
  `estado_semestre` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutor`
--

CREATE TABLE `tutor` (
  `id_tutor` int(11) NOT NULL,
  `cedula_usuario` int(11) NOT NULL,
  `tipo_tutor` varchar(45) NOT NULL,
  `categoria_tutor` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutor_comunidad`
--

CREATE TABLE `tutor_comunidad` (
  `id_tutor` int(11) NOT NULL,
  `nombre_tutor_comunidad` varchar(45) NOT NULL,
  `cedula_tutor` varchar(45) NOT NULL,
  `telefono_tutor` varchar(45) DEFAULT NULL,
  `id_comunidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `cedula_usuario` int(11) NOT NULL,
  `clave_usuario` varchar(120) NOT NULL,
  `nombre_usuario` varchar(45) NOT NULL,
  `estatus_usuario` tinyint(1) NOT NULL,
  `edad_usuario` char(2) DEFAULT NULL,
  `genero_usuario` char(2) DEFAULT NULL,
  `permiso_usuario` varchar(45) NOT NULL,
  `tipo_usuario` varchar(45) NOT NULL,
  `telefono_usuario` varchar(11) DEFAULT NULL,
  `correo_usuario` varchar(120) DEFAULT NULL,
  `pregunta_1` varchar(50) DEFAULT NULL,
  `pregunta_2` varchar(50) DEFAULT NULL,
  `pregunta_3` varchar(50) DEFAULT NULL,
  `respuesta_1` varchar(50) DEFAULT NULL,
  `respuesta_2` varchar(50) DEFAULT NULL,
  `respuesta_3` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`cedula_usuario`, `clave_usuario`, `nombre_usuario`, `estatus_usuario`, `edad_usuario`, `genero_usuario`, `permiso_usuario`, `tipo_usuario`, `telefono_usuario`, `correo_usuario`, `pregunta_1`, `pregunta_2`, `pregunta_3`, `respuesta_1`, `respuesta_2`, `respuesta_3`) VALUES
(0, '$2y$12$drodwFHKs/pabezUp6zrO.oOb.vV/eikgP4Z2IC0jFjc3n/iCZKMu', '', 1, '', '', '', '', '', '', '', '', '', '', '', ''),
(14558985, '$2y$12$vlOaahB.ESH2K.DYCS1m9.1rvPcTss2ZykEKF8o5lJoiRUtDu5/He', 'JOSEEE MORALES', 1, '29', 'M', '2', 'TUTOR', '04245111111', 'CORREOEEEE@GMAIL.COM', 'FASDFASDF', 'FSFSD', 'FGSFSFD', 'FSADFSD', 'FDSFSFD', 'FGSDFSFSD'),
(24654564, '$2y$12$7fJjTzr3GlA7O/4MZHNbLOa1BHtIGKlhBzQlBMduSCglh/HWlGW1K', 'FREDY', 1, '20', 'M', '2', 'TUTOR', '04650456406', 'GSDGSDFGDF@GMAIL.COM', 'KHKJHJ', 'KJHJK', 'JKHJKH', 'JKHJKH', 'HKJHJK', 'JKHJK'),
(27111222, '$2y$12$GkY9DcPH6AmaDl5zN/ySweXlDxpj21mQQXQ3vwZo7alW4UC9awL.m', 'administrador', 1, NULL, '', '1', 'administrador', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(27132642, 'FASDFASDFASDF', 'JESUS MORALES', 1, '20', 'M', '3', 'ESTUDIANTE', '04245198398', 'FASDFASDFASDF@GMAIL.COM', 'FASDFASDF', 'FSADFSADF', 'DFSAFSDF', 'FGASDFSADF', 'FSFSDF', 'FSFASDFASD');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ano_escolar`
--
ALTER TABLE `ano_escolar`
  ADD PRIMARY KEY (`id_ano_escolar`);

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`id_carrera`),
  ADD UNIQUE KEY `codigo_carrera` (`codigo_carrera`);

--
-- Indices de la tabla `comunidad`
--
ALTER TABLE `comunidad`
  ADD PRIMARY KEY (`id_comunidad`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`id_estudiante`),
  ADD KEY `fk_alumno_usuario1` (`cedula_usuario`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indices de la tabla `grupo_alumno`
--
ALTER TABLE `grupo_alumno`
  ADD KEY `fk_grupo_alumno_grupo1` (`id_grupo`),
  ADD KEY `fk_grupo_alumno_alumno1` (`id_alumno`);

--
-- Indices de la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD PRIMARY KEY (`id_inscripcion`),
  ADD KEY `fk_inscripcion_carrera1` (`id_carrera`),
  ADD KEY `fk_inscripcion_seccion1` (`id_seccion`),
  ADD KEY `fk_inscripcion_alumno1` (`id_estudiante`),
  ADD KEY `fk_inscripcion_semestre1` (`id_semestre`),
  ADD KEY `fk_inscripcion_ano_escolar1` (`id_ano_escolar`);

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`id_proyecto`),
  ADD KEY `fk_proyecto_tutor_comunidad1` (`id_comunidad`),
  ADD KEY `fk_proyecto_grupo1` (`id_grupo`),
  ADD KEY `fk_proyecto_ano_escolar1` (`id_ano_escolar`),
  ADD KEY `fk_proyecto_tutor1` (`id_tutor`);

--
-- Indices de la tabla `seccion`
--
ALTER TABLE `seccion`
  ADD PRIMARY KEY (`id_seccion`),
  ADD KEY `carrera_id` (`carrera_id`);

--
-- Indices de la tabla `semestre`
--
ALTER TABLE `semestre`
  ADD PRIMARY KEY (`id_semestre`);

--
-- Indices de la tabla `tutor`
--
ALTER TABLE `tutor`
  ADD PRIMARY KEY (`id_tutor`),
  ADD KEY `fk_tutor_usuario1` (`cedula_usuario`);

--
-- Indices de la tabla `tutor_comunidad`
--
ALTER TABLE `tutor_comunidad`
  ADD PRIMARY KEY (`id_tutor`),
  ADD KEY `id_comunidad` (`id_comunidad`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`cedula_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ano_escolar`
--
ALTER TABLE `ano_escolar`
  MODIFY `id_ano_escolar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `carrera`
--
ALTER TABLE `carrera`
  MODIFY `id_carrera` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comunidad`
--
ALTER TABLE `comunidad`
  MODIFY `id_comunidad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  MODIFY `id_estudiante` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  MODIFY `id_inscripcion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `id_proyecto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `seccion`
--
ALTER TABLE `seccion`
  MODIFY `id_seccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `semestre`
--
ALTER TABLE `semestre`
  MODIFY `id_semestre` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tutor`
--
ALTER TABLE `tutor`
  MODIFY `id_tutor` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD CONSTRAINT `fk_alumno_usuario1` FOREIGN KEY (`cedula_usuario`) REFERENCES `usuario` (`cedula_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `grupo_alumno`
--
ALTER TABLE `grupo_alumno`
  ADD CONSTRAINT `fk_grupo_alumno_alumno1` FOREIGN KEY (`id_alumno`) REFERENCES `estudiante` (`id_estudiante`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_grupo_alumno_grupo1` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id_grupo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD CONSTRAINT `fk_inscripcion_alumno1` FOREIGN KEY (`id_estudiante`) REFERENCES `estudiante` (`id_estudiante`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inscripcion_ano_escolar1` FOREIGN KEY (`id_ano_escolar`) REFERENCES `ano_escolar` (`id_ano_escolar`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inscripcion_carrera1` FOREIGN KEY (`id_carrera`) REFERENCES `carrera` (`id_carrera`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inscripcion_seccion1` FOREIGN KEY (`id_seccion`) REFERENCES `seccion` (`id_seccion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inscripcion_semestre1` FOREIGN KEY (`id_semestre`) REFERENCES `semestre` (`id_semestre`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD CONSTRAINT `fk_proyecto_ano_escolar1` FOREIGN KEY (`id_ano_escolar`) REFERENCES `ano_escolar` (`id_ano_escolar`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_proyecto_grupo1` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id_grupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_proyecto_tutor1` FOREIGN KEY (`id_tutor`) REFERENCES `tutor` (`id_tutor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_proyecto_tutor_comunidad1` FOREIGN KEY (`id_comunidad`) REFERENCES `tutor_comunidad` (`id_tutor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `seccion`
--
ALTER TABLE `seccion`
  ADD CONSTRAINT `seccion_ibfk_1` FOREIGN KEY (`carrera_id`) REFERENCES `carrera` (`id_carrera`);

--
-- Filtros para la tabla `tutor`
--
ALTER TABLE `tutor`
  ADD CONSTRAINT `fk_tutor_usuario1` FOREIGN KEY (`cedula_usuario`) REFERENCES `usuario` (`cedula_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tutor_comunidad`
--
ALTER TABLE `tutor_comunidad`
  ADD CONSTRAINT `tutor_comunidad_ibfk_1` FOREIGN KEY (`id_comunidad`) REFERENCES `comunidad` (`id_comunidad`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
