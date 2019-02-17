-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-06-2018 a las 03:41:58
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `consorcio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `IdActividad` int(11) NOT NULL,
  `IdCronograma` int(11) NOT NULL,
  `Actividad` longtext COLLATE utf8_unicode_ci NOT NULL,
  `Fecha_Ejecucion` date NOT NULL,
  `Estatus` int(11) NOT NULL,
  `Nota` varchar(750) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`IdActividad`, `IdCronograma`, `Actividad`, `Fecha_Ejecucion`, `Estatus`, `Nota`) VALUES
(1, 1, 'prueba3', '2018-11-22', 2, 'prueba'),
(2, 1, 'prueba 4', '2018-04-12', 1, 'editada'),
(3, 2, 'Prueba actividad1', '2018-03-07', 1, 'prueba'),
(4, 2, 'Prueba actividad 2', '2018-03-09', 2, 'prueba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cronograma`
--

CREATE TABLE `cronograma` (
  `IdCronograma` int(11) NOT NULL,
  `IdObra` int(11) NOT NULL,
  `Descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `Fecha_Inicio` date NOT NULL,
  `Fecha_Final` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `cronograma`
--

INSERT INTO `cronograma` (`IdCronograma`, `IdObra`, `Descripcion`, `Fecha_Inicio`, `Fecha_Final`) VALUES
(1, 2, '', '2018-03-01', '2018-03-08'),
(2, 1, 'Prueba de cronograma', '2018-03-05', '2018-03-09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `desempenos`
--

CREATE TABLE `desempenos` (
  `IdDesempeno` int(11) NOT NULL,
  `Desempeno` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `desempenos`
--

INSERT INTO `desempenos` (`IdDesempeno`, `Desempeno`) VALUES
(1, 'Albañil'),
(2, 'Chofer'),
(3, 'Obrero'),
(4, 'Pintor'),
(5, 'Operador'),
(6, 'Jefe de Obra'),
(7, 'Dept Construcción'),
(8, 'Director'),
(9, 'Pasante'),
(10, 'Jefe de choferes'),
(11, 'Jefe de maquinaria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus`
--

CREATE TABLE `estatus` (
  `IdEstatus` int(11) NOT NULL,
  `Descripcion` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `estatus`
--

INSERT INTO `estatus` (`IdEstatus`, `Descripcion`) VALUES
(1, 'Pendiente'),
(2, 'Desarrollo'),
(3, 'Realizado'),
(4, 'Cancelado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidades`
--

CREATE TABLE `localidades` (
  `IdLocalidades` int(11) NOT NULL,
  `Latitud` float(10,6) NOT NULL,
  `Longitud` float(10,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `localidades`
--

INSERT INTO `localidades` (`IdLocalidades`, `Latitud`, `Longitud`) VALUES
(0, 0.000000, 0.000000),
(1, 10.262679, -67.956032),
(2, 10.282041, -67.886612),
(3, 10.267408, -67.966461),
(4, 10.281744, -67.966461),
(5, 10.214746, -67.930618),
(8, 10.202244, -67.936371),
(9, 10.202476, -67.933006),
(10, 10.214429, -67.927650),
(11, 10.212951, -68.023926);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maquinaria`
--

CREATE TABLE `maquinaria` (
  `IdMaquinaria` int(11) NOT NULL,
  `IdMaqui` int(11) NOT NULL,
  `IdOperador` int(11) NOT NULL,
  `IdObra` int(11) NOT NULL,
  `Fecha_Desde` date NOT NULL,
  `Fecha_Hasta` date DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `maquinaria`
--

INSERT INTO `maquinaria` (`IdMaquinaria`, `IdMaqui`, `IdOperador`, `IdObra`, `Fecha_Desde`, `Fecha_Hasta`) VALUES
(1, 5, 3, 1, '2018-05-30', '2018-06-11'),
(2, 3, 5, 2, '2018-05-07', '2018-05-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maquinas`
--

CREATE TABLE `maquinas` (
  `IdMaquina` int(11) NOT NULL,
  `Maquina` text COLLATE utf8_unicode_ci NOT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `maquinas`
--

INSERT INTO `maquinas` (`IdMaquina`, `Maquina`, `Estado`) VALUES
(1, 'Pala cargadora', 0),
(2, 'Tratores sobre orugas', 0),
(3, 'Cargadoras oruga', 1),
(4, 'Grúas', 0),
(5, 'Excavadoras', 1),
(6, 'Retro excavadora', 0),
(7, 'Mini cargadores', 0),
(8, 'Motoniveladoras', 0),
(9, 'Compactadora', 0),
(10, 'Equipo de pavimentar', 0),
(11, 'Camiones roqueros', 0),
(12, 'Montacargas', 0),
(13, 'Elevadores', 0),
(14, 'Zanjadoras', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obras`
--

CREATE TABLE `obras` (
  `IdObras` int(11) NOT NULL,
  `Nombre_Obra` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Cedula_Encargado` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Correo_Obra` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Fecha_Inicio` date NOT NULL,
  `Fecha_Culminacion` date DEFAULT NULL,
  `Direccion_Obra` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `Idlocalidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `obras`
--

INSERT INTO `obras` (`IdObras`, `Nombre_Obra`, `Cedula_Encargado`, `Correo_Obra`, `Fecha_Inicio`, `Fecha_Culminacion`, `Direccion_Obra`, `Idlocalidad`) VALUES
(1, 'Brisas del toco', '13547512', 'hfreddy@gmail.com', '2013-02-19', '2018-06-11', 'Acentamiento ampesino zona norte lote2, guacara', 2),
(2, 'Conjunto residencial San Ignacio', '13547512', 'hfreddy@gmail.com', '2013-10-16', '2018-05-28', ' Av principal san vicente sector montecerino San Diego', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutachoferes`
--

CREATE TABLE `rutachoferes` (
  `IdRutachoferes` int(11) NOT NULL,
  `Chofer` int(11) NOT NULL,
  `Actividad` longtext COLLATE utf8_unicode_ci NOT NULL,
  `Fecha_Ejecucion` date NOT NULL,
  `Estatus` int(11) NOT NULL,
  `Idloc1` int(11) NOT NULL DEFAULT '0',
  `Idloc2` int(11) NOT NULL DEFAULT '0',
  `Idloc3` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `rutachoferes`
--

INSERT INTO `rutachoferes` (`IdRutachoferes`, `Chofer`, `Actividad`, `Fecha_Ejecucion`, `Estatus`, `Idloc1`, `Idloc2`, `Idloc3`) VALUES
(1, 6, ' Llevar 20 sacos de cemento a san ignacio y 30 sacos de cemento a brisas del toco', '2018-05-31', 1, 1, 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajadores`
--

CREATE TABLE `trabajadores` (
  `IdTrabajador` int(11) NOT NULL,
  `Apellido` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Nombre` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Cedula` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Telefono` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Desempeno` int(30) NOT NULL,
  `Fecha_Ingreso` date NOT NULL,
  `Fecha_Salida` date DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `trabajadores`
--

INSERT INTO `trabajadores` (`IdTrabajador`, `Apellido`, `Nombre`, `Cedula`, `Telefono`, `Desempeno`, `Fecha_Ingreso`, `Fecha_Salida`) VALUES
(1, 'Cimino', 'Franco', '81171600', '04144122031', 8, '2003-01-13', '0000-00-00'),
(2, 'Natera Borrero de irigoyen', 'Ana Carylu', '19301133', '0414-8899343', 9, '2017-03-01', '2018-03-02'),
(3, 'Ojeda', 'Jesus ', '18628042', '04244100346', 5, '2008-08-11', '0000-00-00'),
(4, 'Hurtado', 'Freddy', '13547512', '04145796338', 6, '2005-08-20', '0000-00-00'),
(5, 'Rodriguez', 'Johana', '18062890', '04145805953', 10, '2015-05-23', '0000-00-00'),
(6, 'Rodriguez', 'Williams', '7074683', '04144600202', 2, '2012-07-15', '0000-00-00'),
(7, 'Ortega', 'Ronild', '7139479', '04144335225', 11, '2009-05-15', '0000-00-00'),
(8, 'Veleiro', 'Jesus', '20081837', '04144318071', 6, '2007-01-20', '0000-00-00'),
(9, 'Irigoyen', 'prueba', '19911701', '04148890947', 6, '2018-05-10', '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Id` int(11) NOT NULL,
  `Cedula` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Correo` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `Clave` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Id`, `Cedula`, `Correo`, `Clave`, `Estado`) VALUES
(1, '19301133', 'ana.carylu@gmail.com', 'panda', 1),
(2, '81171600', 'ciminofc@yahoo.com ', 'cimino', 1),
(3, '20081837', 'jesusveleiro@gmail.com', 'veleiro', 0),
(4, '18628042', ' jesusmojedam@gmail.com', 'ojeda', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`IdActividad`),
  ADD KEY `cascade_act` (`IdCronograma`),
  ADD KEY `Estatus` (`Estatus`);

--
-- Indices de la tabla `cronograma`
--
ALTER TABLE `cronograma`
  ADD PRIMARY KEY (`IdCronograma`),
  ADD KEY `cascade_crono` (`IdObra`);

--
-- Indices de la tabla `desempenos`
--
ALTER TABLE `desempenos`
  ADD PRIMARY KEY (`IdDesempeno`);

--
-- Indices de la tabla `estatus`
--
ALTER TABLE `estatus`
  ADD PRIMARY KEY (`IdEstatus`);

--
-- Indices de la tabla `localidades`
--
ALTER TABLE `localidades`
  ADD PRIMARY KEY (`IdLocalidades`);

--
-- Indices de la tabla `maquinaria`
--
ALTER TABLE `maquinaria`
  ADD PRIMARY KEY (`IdMaquinaria`),
  ADD KEY `cascade_operador` (`IdOperador`),
  ADD KEY `cascade_maquina` (`IdMaqui`);

--
-- Indices de la tabla `maquinas`
--
ALTER TABLE `maquinas`
  ADD PRIMARY KEY (`IdMaquina`);

--
-- Indices de la tabla `obras`
--
ALTER TABLE `obras`
  ADD PRIMARY KEY (`IdObras`),
  ADD KEY `Cedula_Encargado` (`Cedula_Encargado`),
  ADD KEY `Idlocalidad` (`Idlocalidad`);

--
-- Indices de la tabla `rutachoferes`
--
ALTER TABLE `rutachoferes`
  ADD PRIMARY KEY (`IdRutachoferes`),
  ADD KEY `cascade_chofer` (`Chofer`),
  ADD KEY `Estatus` (`Estatus`) USING BTREE,
  ADD KEY `Idloc1` (`Idloc1`),
  ADD KEY `Idloc2` (`Idloc2`),
  ADD KEY `Idloc3` (`Idloc3`);

--
-- Indices de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  ADD PRIMARY KEY (`IdTrabajador`),
  ADD UNIQUE KEY `Cedula` (`Cedula`),
  ADD KEY `Relacion desempeno` (`Desempeno`),
  ADD KEY `Cedula_2` (`Cedula`),
  ADD KEY `Cedula_3` (`Cedula`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Cedula` (`Cedula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `IdActividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `cronograma`
--
ALTER TABLE `cronograma`
  MODIFY `IdCronograma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `desempenos`
--
ALTER TABLE `desempenos`
  MODIFY `IdDesempeno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `estatus`
--
ALTER TABLE `estatus`
  MODIFY `IdEstatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `localidades`
--
ALTER TABLE `localidades`
  MODIFY `IdLocalidades` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `maquinaria`
--
ALTER TABLE `maquinaria`
  MODIFY `IdMaquinaria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `obras`
--
ALTER TABLE `obras`
  MODIFY `IdObras` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `rutachoferes`
--
ALTER TABLE `rutachoferes`
  MODIFY `IdRutachoferes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  MODIFY `IdTrabajador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD CONSTRAINT `cascade_act` FOREIGN KEY (`IdCronograma`) REFERENCES `cronograma` (`IdCronograma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cascade_estatusact` FOREIGN KEY (`Estatus`) REFERENCES `estatus` (`IdEstatus`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cronograma`
--
ALTER TABLE `cronograma`
  ADD CONSTRAINT `cascade_crono` FOREIGN KEY (`IdObra`) REFERENCES `obras` (`IdObras`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `maquinaria`
--
ALTER TABLE `maquinaria`
  ADD CONSTRAINT `cascade_maquina` FOREIGN KEY (`IdMaqui`) REFERENCES `maquinas` (`IdMaquina`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cascade_operador` FOREIGN KEY (`IdOperador`) REFERENCES `trabajadores` (`IdTrabajador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `obras`
--
ALTER TABLE `obras`
  ADD CONSTRAINT `cascade_encargado` FOREIGN KEY (`Cedula_Encargado`) REFERENCES `trabajadores` (`Cedula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cascade_localidad` FOREIGN KEY (`Idlocalidad`) REFERENCES `localidades` (`IdLocalidades`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rutachoferes`
--
ALTER TABLE `rutachoferes`
  ADD CONSTRAINT `cascade_chofer` FOREIGN KEY (`Chofer`) REFERENCES `trabajadores` (`IdTrabajador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cascade_estatuschof` FOREIGN KEY (`Estatus`) REFERENCES `estatus` (`IdEstatus`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cascade_loc1` FOREIGN KEY (`Idloc1`) REFERENCES `localidades` (`IdLocalidades`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cascade_loc2` FOREIGN KEY (`Idloc2`) REFERENCES `localidades` (`IdLocalidades`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cascade_loc3` FOREIGN KEY (`Idloc3`) REFERENCES `localidades` (`IdLocalidades`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  ADD CONSTRAINT `Relacion desempeno` FOREIGN KEY (`Desempeno`) REFERENCES `desempenos` (`IdDesempeno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `Relacion Cedula` FOREIGN KEY (`Cedula`) REFERENCES `trabajadores` (`Cedula`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
