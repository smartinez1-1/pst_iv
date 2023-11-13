-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-05-2023 a las 05:41:12
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
  `estado_incripciones` tinyint(1) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_cierre` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `ano_escolar`
--

INSERT INTO `ano_escolar` (`id_ano_escolar`, `ano_escolar_nombre`, `estado_ano_escolar`, `estado_incripciones`, `fecha_inicio`, `fecha_cierre`) VALUES
(1, '1-2023', 1, 1, '2023-01-09', '2023-05-26');

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

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`id_carrera`, `nombre_carrera`, `codigo_carrera`, `estado_carrera`) VALUES
(1, 'INGENIERÍA AGROINDUSTRIAL', '1619', '1'),
(2, 'INGENIERÍA AGRONÓMICA', '2016', '1'),
(3, 'TSU EN ENFERMERÍA', '0316', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comunidad`
--

CREATE TABLE `comunidad` (
  `id_comunidad` int(11) NOT NULL,
  `nombre_comunidad` varchar(80) NOT NULL,
  `tipo_comunidad` varchar(45) NOT NULL,
  `direccion_comunidad` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `comunidad`
--

INSERT INTO `comunidad` (`id_comunidad`, `nombre_comunidad`, `tipo_comunidad`, `direccion_comunidad`) VALUES
(1, 'ESCUELA JOSE LEONARDO CHIRINOS MUNICIPIO ARAURE ESTARO PORTUGUESA', 'UNIDAD EDUCATIVA', 'BARRIO LA ARBOLEDA MUNICIO ARAURE'),
(2, 'UNIDAD EDUCATIVA LOS CORTIJOS MUNICIPIO PAEZ ESTADO PORTUGUESA', 'UNIDAD EDUCATIVA', 'URBANIZACIÓN LOS CORTIJOS, SECTOR 3, CALLE G MUNICIPIO PAEZ ESTADO PORTUGUESA.'),
(3, 'CENTRO DE MANTENIMIENTO Y REPARACIÓN DE HELICOPTEROS MULTIPROPOSITO', 'INSTITUCIóN', 'AV. PRINCIPAL LAS MESETAS  VIA EL AEROPUERTO GENERAL DE BRIGADA OSWALDO GUEVARA.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `id_estudiante` int(11) NOT NULL,
  `cedula_usuario` int(11) NOT NULL,
  `turno_estudiante` varchar(45) NOT NULL,
  `matricula_estudiante` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`id_estudiante`, `cedula_usuario`, `turno_estudiante`, `matricula_estudiante`) VALUES
(1, 29824577, 'D', '2-2020-1619D'),
(2, 30208913, 'D', '2-2020-1619D'),
(3, 20391391, 'D', '2-2016-1619D'),
(4, 28231691, 'D', '2-2020-2016D'),
(5, 28629939, 'D', '2-2020-2016D'),
(6, 28258892, 'D', '2-2020-2016D'),
(7, 28342207, 'D', '1-2020-0316D'),
(8, 28382726, 'D', '1-2019-0316D'),
(9, 28414872, 'D', '1-2019-0316D');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `id_grupo` int(11) NOT NULL,
  `nombre_grupo` varchar(30) NOT NULL,
  `id_seccion` int(11) NOT NULL,
  `estado_grupo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`id_grupo`, `nombre_grupo`, `id_seccion`, `estado_grupo`) VALUES
(1, 'AGROINDUSTRIAL UNO', 1, 1),
(2, 'AGRONOMICA UNO', 2, 1),
(3, 'ENFERMERIA UNO', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_alumno`
--

CREATE TABLE `grupo_alumno` (
  `id_grupo` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `grupo_alumno`
--

INSERT INTO `grupo_alumno` (`id_grupo`, `id_alumno`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 4),
(2, 5),
(2, 6),
(3, 7),
(3, 8),
(3, 9);

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

--
-- Volcado de datos para la tabla `inscripcion`
--

INSERT INTO `inscripcion` (`id_inscripcion`, `id_carrera`, `id_seccion`, `id_estudiante`, `id_semestre`, `id_ano_escolar`) VALUES
(1, 1, 1, 1, 4, 1),
(2, 1, 1, 2, 5, 1),
(3, 1, 1, 3, 5, 1),
(4, 2, 2, 4, 4, 1),
(5, 2, 2, 5, 5, 1),
(6, 2, 2, 6, 6, 1),
(7, 3, 3, 7, 2, 1),
(8, 3, 3, 8, 1, 1),
(9, 3, 3, 9, 2, 1);

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
  `titulo_proyecto` varchar(150) NOT NULL,
  `planteamiento_proyecto` varchar(150) NOT NULL,
  `objetivos_generales_proyecto` varchar(150) NOT NULL,
  `objetivos_especificos_proyecto` varchar(150) NOT NULL,
  `tipo_proyecto` varchar(45) NOT NULL,
  `estado_proyecto` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`id_proyecto`, `id_comunidad`, `id_grupo`, `id_ano_escolar`, `id_tutor`, `titulo_proyecto`, `planteamiento_proyecto`, `objetivos_generales_proyecto`, `objetivos_especificos_proyecto`, `tipo_proyecto`, `estado_proyecto`) VALUES
(1, 1, 1, 1, 1, 'PATIOS  PRODUCTIVOS COMO COMPLEMENTO ALIMENTI', 'N HAC HABITASSE PLATEA DICTUMST. UT VEHICULA VOLUTPAT AUGUE, DICTUM PELLENTESQUE TURPIS CONDIMENTUM AT. NAM SUSCIPIT VENENATIS HENDRERIT. FUSCE GRAVID', 'ELLENTESQUE MAGNA ENIM, ULTRICIES VITAE EX PELLENTESQUE, ORNARE ACCUMSAN MASSA. IN NON ERAT EU MASSA FAUCIBUS PULVINAR AT AT ERAT. VIVAMUS NEC LACUS S', 'ELLENTESQUE MAGNA ENIM, ULTRICIES VITAE EX PELLENTESQUE, ORNARE ACCUMSAN MASSA. IN NON ERAT EU MASSA FAUCIBUS PULVINAR AT AT ERAT. VIVAMUS NEC LACUS S', 'SOCIO-PRODUCTIVO', '0'),
(2, 2, 2, 1, 2, 'ACONDICIONAMIENTO DE PATIO PRODUCTIVO PARA EL', 'LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT. CURABITUR SUSCIPIT DIAM ID FERMENTUM RUTRUM. DONEC NEC LOREM METUS. UT COMMODO IN DUI VEL SCE', 'LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT. CURABITUR SUSCIPIT DIAM ID FERMENTUM RUTRUM. DONEC NEC LOREM METUS. UT COMMODO IN DUI VEL SCE', 'LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT. CURABITUR SUSCIPIT DIAM ID FERMENTUM RUTRUM. DONEC NEC LOREM METUS. UT COMMODO IN DUI VEL SCE', 'SOCIO-PRODUCTIVO', '0'),
(3, 3, 3, 1, 3, 'SISTEMA DE RIEGO DE AGUAS REUTILIZADAS DE CON', 'LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT. CURABITUR SUSCIPIT DIAM ID FERMENTUM RUTRUM. DONEC NEC LOREM METUS. UT COMMODO IN DUI VEL SCE', 'LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT. CURABITUR SUSCIPIT DIAM ID FERMENTUM RUTRUM. DONEC NEC LOREM METUS. UT COMMODO IN DUI VEL SCE', 'LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT. CURABITUR SUSCIPIT DIAM ID FERMENTUM RUTRUM. DONEC NEC LOREM METUS. UT COMMODO IN DUI VEL SCE', 'AMBIENTAL', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

CREATE TABLE `seccion` (
  `id_seccion` int(11) NOT NULL,
  `numero_seccion` varchar(13) NOT NULL,
  `carrera_id` int(11) NULL,
  `estado_seccion` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `seccion`
--

INSERT INTO `seccion` (`id_seccion`, `numero_seccion`, `carrera_id`, `estado_seccion`) VALUES
(1, '01S-0850-D24', 1, 1),
(2, '01S-0455-D24', 2, 1),
(3, '01S-0214-D24', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semestre`
--

CREATE TABLE `semestre` (
  `id_semestre` int(11) NOT NULL,
  `des_semestre` varchar(15) NOT NULL,
  `estado_semestre` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `semestre`
--

INSERT INTO `semestre` (`id_semestre`, `des_semestre`, `estado_semestre`) VALUES
(1, '3', 1),
(2, '4', 1),
(3, '5', 1),
(4, '6', 1),
(5, '7', 1),
(6, '8', 1),
(7, 'P', 0);

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

--
-- Volcado de datos para la tabla `tutor`
--

INSERT INTO `tutor` (`id_tutor`, `cedula_usuario`, `tipo_tutor`, `categoria_tutor`) VALUES
(1, 4409125, 'DOCENTE', 'TC'),
(2, 24020853, 'DOCENTE', 'MT'),
(3, 12263256, 'DOCENTE', 'TC');

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

--
-- Volcado de datos para la tabla `tutor_comunidad`
--

INSERT INTO `tutor_comunidad` (`id_tutor`, `nombre_tutor_comunidad`, `cedula_tutor`, `telefono_tutor`, `id_comunidad`) VALUES
(1, 'ELENA REYEZ', '9835866', '0412-851-9816', 1),
(2, 'LUIS FANFER', '15491632', '0414-555-8459', 2),
(3, 'WALTER PANZA', '10643237', '0414-157-9501', 3);

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
  `telefono_usuario` varchar(13) DEFAULT NULL,
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
(4409125, '$2y$12$8hwfRk6Rikpuw5bhcldqzuyV3jE7F1WZNBpI/10d94JEE37suQmuO', 'ANA CHIANCONE', 1, '50', 'F', '2', 'TUTOR', '0426-598-1616', 'ANA2@GMAIL.COM', '1', '1', '1', '1', '1', '1'),
(12263256, '$2y$12$X0YcHB24XCJ4KZLse1gNO.kvVHN.Nta7mJy/Z32zARhtxzHi2WiRG', 'ELIZABETH PANZA', 1, '40', 'F', '2', 'TUTOR', '0424-981-6513', 'ELIZABETH@GMAIL.COM', '1', '1', '1', '1', '1', '1'),
(20391391, '$2y$12$dYdz1HHAPAtCrzWzgtRrWuUXP4pkMLy.s6FTCLuTeEXZGZAllD/qG', 'DAYANA MENDOZA', 1, '30', 'F', '3', 'ESTUDIANTE', '0416-894-9898', 'DAYANA@YAHOO.ES', '1', '1', '1', '1', '1', '1'),
(24020853, '$2y$12$pPLSJnzUTvSG2bO1xbFgseDWT3JW3Gx9WHOdXSbwXVfwGjnGD4rxW', 'JORGE ÁLVAREZ', 1, '28', 'M', '2', 'TUTOR', '0426-521-9816', 'JORGE22@HOTMAIL.COM', '1', '1', '1', '1', '1', '1'),
(27111222, '$2y$12$JsbcpoGQWTTxlzxpe2pONObPgeKtTzwknr24KcUpRTVKKyeDiuYOu', 'administrador', 1, NULL, '', '1', 'administrador', NULL, NULL, NULL, NULL, NULL, 'N', 'N', 'N'),
(28231691, '$2y$12$LlcVYDE0akHOmPQWHblkteeoHnG9c0tc.fRpLsARs0lLnJVzCU9XK', 'JOSE CUICAS', 1, '20', 'M', '3', 'ESTUDIANTE', '0426-298-1616', 'JOSE@GMAIL.COM', '1', '1', '1', '1', '1', '1'),
(28258892, '$2y$12$Rb0xgkcg5RIZpJsCjx.YSePzHApu3pA1zxudsR/m.1lqDP0ELKK4.', 'BRANDON BUSTAMANTE', 1, '20', 'M', '3', 'ESTUDIANTE', '0424-528-4521', 'BRANDON@YAHOO.COM', '1', '1', '1', '1', '1', '1'),
(28342207, '$2y$12$nFOXJ6SKydVXs6OTQLord.VyBRGoPmRNlC2u/wbsJrobGLElxSowm', 'ROSNERIS MORILLO', 1, '20', 'F', '3', 'ESTUDIANTE', '0424-518-3859', 'ROSS@OUTLOOK.ES', '1', '1', '1', '1', '1', '1'),
(28382726, '$2y$12$LUqiBeUwdSPI6gXWpsWLUuFTvo0F9ASw7ifWWdr.az/oG5R0CsS2q', 'FRANCO ANGULO', 1, '20', 'M', '3', 'ESTUDIANTE', '0426-358-1651', 'FRANCO@OUTLOOK.COM', '1', '1', '1', '1', '1', '1'),
(28414872, '$2y$12$B.EEHqiuFaO/Bmx4YpkMbe4/jWRBwrf.bh7f3sQuNaMzKX/qe0EKK', 'DIOGENES VARGAS', 1, '20', 'M', '3', 'ESTUDIANTE', '0414-581-6513', 'DIODIO@GMAIL.COM', '1', '1', '1', '1', '1', '1'),
(28629939, '$2y$12$fr0zt6zo0YtilN1R7vhmIeDBCiXADriSDHgyENDw0.QgCRPbb75Ri', 'JUAN SUáREZ', 1, '20', 'M', '3', 'ESTUDIANTE', '0414-589-1681', 'JUAN@GMAIL.COM', '1', '1', '1', '1', '1', '1'),
(29824577, '$2y$12$HBQ.5b5sDehJZkEtP7D20eePaUV7V4eFJkkGXNTb2UoYTO5nNVEze', 'ANA CHIRINOS', 1, '20', 'F', '3', 'ESTUDIANTE', '0424-158-5621', 'ANA@GMAIL.COM', '1', '1', '1', '1', '1', '1'),
(30208913, '$2y$12$wKnI0UAcLy3CHif6/ImM7uDsZXH8QPNFE2JDo79z7mzJfRBg/TTeW', 'ELIANNY VALERA', 1, '20', 'F', '3', 'ESTUDIANTE', '0412-262-1651', 'ELIANNY@HOTMAIL.COM', '1', '1', '1', '1', '1', '1');

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
  ADD PRIMARY KEY (`id_grupo`),
  ADD KEY `id_seccion` (`id_seccion`);

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
  ADD KEY `fk_proyecto_grupo1` (`id_grupo`),
  ADD KEY `fk_proyecto_ano_escolar1` (`id_ano_escolar`),
  ADD KEY `fk_proyecto_tutor1` (`id_tutor`),
  ADD KEY `fk_proyecto_tutor_comunidad1` (`id_comunidad`);

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
  MODIFY `id_ano_escolar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `carrera`
--
ALTER TABLE `carrera`
  MODIFY `id_carrera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `comunidad`
--
ALTER TABLE `comunidad`
  MODIFY `id_comunidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  MODIFY `id_estudiante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  MODIFY `id_inscripcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `id_proyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `seccion`
--
ALTER TABLE `seccion`
  MODIFY `id_seccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `semestre`
--
ALTER TABLE `semestre`
  MODIFY `id_semestre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tutor`
--
ALTER TABLE `tutor`
  MODIFY `id_tutor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tutor_comunidad`
--
ALTER TABLE `tutor_comunidad`
  MODIFY `id_tutor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD CONSTRAINT `fk_alumno_usuario1` FOREIGN KEY (`cedula_usuario`) REFERENCES `usuario` (`cedula_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `grupo_ibfk_1` FOREIGN KEY (`id_seccion`) REFERENCES `seccion` (`id_seccion`);

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
  ADD CONSTRAINT `fk_proyecto_tutor_comunidad1` FOREIGN KEY (`id_comunidad`) REFERENCES `comunidad` (`id_comunidad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
