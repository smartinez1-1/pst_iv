-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: db-mysql:3306
-- Tiempo de generación: 09-03-2024 a las 20:02:31
-- Versión del servidor: 8.1.0
-- Versión de PHP: 8.2.13

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ano_escolar`
--

CREATE TABLE `ano_escolar` (
  `id_ano_escolar` int NOT NULL,
  `ano_escolar_nombre` varchar(45) NOT NULL,
  `estado_ano_escolar` tinyint(1) NOT NULL,
  `estado_incripciones` tinyint(1) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_cierre` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE `carrera` (
  `id_carrera` int NOT NULL,
  `nombre_carrera` varchar(45) NOT NULL,
  `codigo_carrera` varchar(6) NOT NULL,
  `turno_carrera` enum('D','N') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `admite_grupos_mixtos` tinyint(1) NOT NULL,
  `estado_carrera` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_documentos`
--

CREATE TABLE `categorias_documentos` (
  `id_categoria` int NOT NULL,
  `des_categoria` varchar(30) NOT NULL,
  `estatus_categoria` tinyint(1) NOT NULL,
  `creacion_categoria` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comunidad`
--

CREATE TABLE `comunidad` (
  `id_comunidad` int NOT NULL,
  `nombre_comunidad` varchar(80) NOT NULL,
  `tipo_comunidad` varchar(45) NOT NULL,
  `direccion_comunidad` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `id_documento` int NOT NULL,
  `nombre_documento` varchar(30) NOT NULL,
  `ruta_file_documento` varchar(120) NOT NULL,
  `categoria_id_documento` int NOT NULL,
  `extension_documento` varchar(10) NOT NULL,
  `fecha_subida_documento` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estatus_documento` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id_estado` int NOT NULL,
  `estado` varchar(250) NOT NULL,
  `iso_3166-2` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `id_estudiante` int NOT NULL,
  `cedula_usuario` int NOT NULL,
  `turno_estudiante` varchar(45) NOT NULL,
  `matricula_estudiante` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `id_grupo` int NOT NULL,
  `nombre_grupo` varchar(30) NOT NULL,
  `id_seccion` int DEFAULT NULL,
  `estado_grupo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_alumno`
--

CREATE TABLE `grupo_alumno` (
  `id_grupo` int NOT NULL,
  `id_alumno` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_claves`
--

CREATE TABLE `historial_claves` (
  `id_historial_claves` int NOT NULL,
  `clave_vieja` text NOT NULL,
  `cedula_usuario` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcion`
--

CREATE TABLE `inscripcion` (
  `id_inscripcion` int NOT NULL,
  `id_carrera` int NOT NULL,
  `id_seccion` int NOT NULL,
  `id_estudiante` int NOT NULL,
  `id_semestre` int DEFAULT NULL,
  `id_ano_escolar` int NOT NULL,
  `des_semestre` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
  `id_municipio` int NOT NULL,
  `id_estado` int NOT NULL,
  `municipio` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parroquias`
--

CREATE TABLE `parroquias` (
  `id_parroquia` int NOT NULL,
  `id_municipio` int NOT NULL,
  `parroquia` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas_seguridad`
--

CREATE TABLE `preguntas_seguridad` (
  `id_pregunta` int NOT NULL,
  `des_pregunta` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `id_proyecto` int NOT NULL,
  `id_comunidad` int NOT NULL,
  `id_grupo` int NOT NULL,
  `id_ano_escolar` int NOT NULL,
  `id_tutor` int NOT NULL,
  `titulo_proyecto` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `planteamiento_proyecto` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `objetivos_generales_proyecto` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `objetivos_especificos_proyecto` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `tipo_proyecto` varchar(255) NOT NULL,
  `estado_proyecto` char(1) NOT NULL,
  `ruta_file` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

CREATE TABLE `seccion` (
  `id_seccion` int NOT NULL,
  `numero_seccion` varchar(13) NOT NULL,
  `carrera_id` int DEFAULT NULL,
  `estado_seccion` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semestre`
--

CREATE TABLE `semestre` (
  `id_semestre` int NOT NULL,
  `des_semestre` varchar(15) NOT NULL,
  `estado_semestre` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutor`
--

CREATE TABLE `tutor` (
  `id_tutor` int NOT NULL,
  `cedula_usuario` int NOT NULL,
  `tipo_tutor` varchar(45) NOT NULL,
  `categoria_tutor` varchar(45) NOT NULL,
  `parroquia_id_tutor` int NOT NULL,
  `calle_tutor` varchar(60) DEFAULT NULL,
  `avenida_tutor` varchar(60) DEFAULT NULL,
  `sector_tutor` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutor_comunidad`
--

CREATE TABLE `tutor_comunidad` (
  `id_tutor` int NOT NULL,
  `nombre_tutor_comunidad` varchar(45) NOT NULL,
  `cedula_tutor` varchar(45) NOT NULL,
  `telefono_tutor` varchar(45) DEFAULT NULL,
  `id_comunidad` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `cedula_usuario` int NOT NULL,
  `clave_usuario` varchar(120) NOT NULL,
  `nacionalidad_usuario` enum('V','E') DEFAULT NULL,
  `nombre_usuario` varchar(45) NOT NULL,
  `estatus_usuario` tinyint(1) NOT NULL,
  `edad_usuario` char(2) DEFAULT NULL,
  `genero_usuario` char(2) DEFAULT NULL,
  `permiso_usuario` varchar(45) NOT NULL,
  `tipo_usuario` varchar(45) NOT NULL,
  `telefono_usuario` varchar(13) DEFAULT NULL,
  `correo_usuario` varchar(120) DEFAULT NULL,
  `id_pregunta_1` int DEFAULT NULL,
  `id_pregunta_2` int DEFAULT NULL,
  `pregunta_3` varchar(50) DEFAULT NULL,
  `respuesta_1` varchar(50) DEFAULT NULL,
  `respuesta_2` varchar(50) DEFAULT NULL,
  `respuesta_3` varchar(50) DEFAULT NULL,
  `dias_de_caducidad_clave` int DEFAULT NULL,
  `fecha_de_caducidad_clave` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
-- Indices de la tabla `categorias_documentos`
--
ALTER TABLE `categorias_documentos`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `comunidad`
--
ALTER TABLE `comunidad`
  ADD PRIMARY KEY (`id_comunidad`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id_documento`),
  ADD KEY `categoria_documento` (`categoria_id_documento`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id_estado`);

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
-- Indices de la tabla `historial_claves`
--
ALTER TABLE `historial_claves`
  ADD PRIMARY KEY (`id_historial_claves`),
  ADD KEY `cedula_usuario` (`cedula_usuario`);

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
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`id_municipio`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indices de la tabla `parroquias`
--
ALTER TABLE `parroquias`
  ADD PRIMARY KEY (`id_parroquia`),
  ADD KEY `id_municipio` (`id_municipio`);

--
-- Indices de la tabla `preguntas_seguridad`
--
ALTER TABLE `preguntas_seguridad`
  ADD PRIMARY KEY (`id_pregunta`);

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
  ADD KEY `fk_tutor_usuario1` (`cedula_usuario`),
  ADD KEY `parroquia_id_tutor` (`parroquia_id_tutor`);

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
  ADD PRIMARY KEY (`cedula_usuario`),
  ADD KEY `id_pregunta_1` (`id_pregunta_1`),
  ADD KEY `id_pregunta_2` (`id_pregunta_2`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ano_escolar`
--
ALTER TABLE `ano_escolar`
  MODIFY `id_ano_escolar` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `carrera`
--
ALTER TABLE `carrera`
  MODIFY `id_carrera` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias_documentos`
--
ALTER TABLE `categorias_documentos`
  MODIFY `id_categoria` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comunidad`
--
ALTER TABLE `comunidad`
  MODIFY `id_comunidad` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id_documento` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id_estado` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  MODIFY `id_estudiante` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id_grupo` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial_claves`
--
ALTER TABLE `historial_claves`
  MODIFY `id_historial_claves` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  MODIFY `id_inscripcion` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `parroquias`
--
ALTER TABLE `parroquias`
  MODIFY `id_parroquia` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `preguntas_seguridad`
--
ALTER TABLE `preguntas_seguridad`
  MODIFY `id_pregunta` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `id_proyecto` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `seccion`
--
ALTER TABLE `seccion`
  MODIFY `id_seccion` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `semestre`
--
ALTER TABLE `semestre`
  MODIFY `id_semestre` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tutor`
--
ALTER TABLE `tutor`
  MODIFY `id_tutor` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tutor_comunidad`
--
ALTER TABLE `tutor_comunidad`
  MODIFY `id_tutor` int NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `documentos_ibfk_1` FOREIGN KEY (`categoria_id_documento`) REFERENCES `categorias_documentos` (`id_categoria`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD CONSTRAINT `fk_alumno_usuario1` FOREIGN KEY (`cedula_usuario`) REFERENCES `usuario` (`cedula_usuario`);

--
-- Filtros para la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `grupo_ibfk_1` FOREIGN KEY (`id_seccion`) REFERENCES `seccion` (`id_seccion`);

--
-- Filtros para la tabla `grupo_alumno`
--
ALTER TABLE `grupo_alumno`
  ADD CONSTRAINT `fk_grupo_alumno_alumno1` FOREIGN KEY (`id_alumno`) REFERENCES `estudiante` (`id_estudiante`),
  ADD CONSTRAINT `fk_grupo_alumno_grupo1` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id_grupo`);

--
-- Filtros para la tabla `historial_claves`
--
ALTER TABLE `historial_claves`
  ADD CONSTRAINT `historial_claves_ibfk_1` FOREIGN KEY (`cedula_usuario`) REFERENCES `usuario` (`cedula_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD CONSTRAINT `fk_inscripcion_alumno1` FOREIGN KEY (`id_estudiante`) REFERENCES `estudiante` (`id_estudiante`),
  ADD CONSTRAINT `fk_inscripcion_ano_escolar1` FOREIGN KEY (`id_ano_escolar`) REFERENCES `ano_escolar` (`id_ano_escolar`),
  ADD CONSTRAINT `fk_inscripcion_carrera1` FOREIGN KEY (`id_carrera`) REFERENCES `carrera` (`id_carrera`),
  ADD CONSTRAINT `fk_inscripcion_seccion1` FOREIGN KEY (`id_seccion`) REFERENCES `seccion` (`id_seccion`),
  ADD CONSTRAINT `fk_inscripcion_semestre1` FOREIGN KEY (`id_semestre`) REFERENCES `semestre` (`id_semestre`);

--
-- Filtros para la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD CONSTRAINT `municipios_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id_estado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `parroquias`
--
ALTER TABLE `parroquias`
  ADD CONSTRAINT `parroquias_ibfk_1` FOREIGN KEY (`id_municipio`) REFERENCES `municipios` (`id_municipio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD CONSTRAINT `fk_proyecto_ano_escolar1` FOREIGN KEY (`id_ano_escolar`) REFERENCES `ano_escolar` (`id_ano_escolar`),
  ADD CONSTRAINT `fk_proyecto_grupo1` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id_grupo`),
  ADD CONSTRAINT `fk_proyecto_tutor1` FOREIGN KEY (`id_tutor`) REFERENCES `tutor` (`id_tutor`),
  ADD CONSTRAINT `fk_proyecto_tutor_comunidad1` FOREIGN KEY (`id_comunidad`) REFERENCES `comunidad` (`id_comunidad`);

--
-- Filtros para la tabla `seccion`
--
ALTER TABLE `seccion`
  ADD CONSTRAINT `seccion_ibfk_1` FOREIGN KEY (`carrera_id`) REFERENCES `carrera` (`id_carrera`);

--
-- Filtros para la tabla `tutor`
--
ALTER TABLE `tutor`
  ADD CONSTRAINT `fk_tutor_usuario1` FOREIGN KEY (`cedula_usuario`) REFERENCES `usuario` (`cedula_usuario`),
  ADD CONSTRAINT `tutor_ibfk_1` FOREIGN KEY (`parroquia_id_tutor`) REFERENCES `parroquias` (`id_parroquia`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `tutor_comunidad`
--
ALTER TABLE `tutor_comunidad`
  ADD CONSTRAINT `tutor_comunidad_ibfk_1` FOREIGN KEY (`id_comunidad`) REFERENCES `comunidad` (`id_comunidad`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_pregunta_1`) REFERENCES `preguntas_seguridad` (`id_pregunta`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`id_pregunta_2`) REFERENCES `preguntas_seguridad` (`id_pregunta`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
