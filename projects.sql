-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-01-2021 a las 19:29:41
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `projects`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `pk_area` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`pk_area`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Arquitectura', '2021-01-15 08:35:20', '2021-01-15 08:36:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `pk_cliente` int(11) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `identificacion` varchar(25) DEFAULT NULL,
  `telefono` varchar(25) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(300) DEFAULT NULL,
  `cliente_id` varchar(300) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`pk_cliente`, `nombres`, `apellidos`, `identificacion`, `telefono`, `email`, `password`, `cliente_id`, `is_active`, `created_at`, `updated_at`, `image`) VALUES
(1, 'Kevin Arnold', 'Huamani', '70051354', '942971175', 'elmanhpt@gmail.com', 'aasdasda', NULL, 0, NULL, NULL, 'https://scontent.flim9-1.fna.fbcdn.net/v/t1.0-9/22228160_1647957255277036_6397210627391144871_n.jpg?_nc_cat=108&ccb=2&_nc_sid=09cbfe&_nc_eui2=AeHs35VJxtHayFjIFNKB8XhzxL1JH3AoHJPEvUkfcCgckxMgLGc16Km2LNnFh90uNkRB_3UO935Zj4VtMCH9JOqJ&_nc_ohc=w2AAY1WCmIYAX-2gLB6&_nc_ht=scontent.flim9-1.fna&oh=c3989f3d4c0b0cacc9ef738ae751fc30&oe=602C6B15'),
(5, '123123123', 'asdasd', '', '', '123123@asdasd', '$2y$10$jxJ9peoG32G1mJOrlkHeYe8yGhDkUDtxoEyDgXKfhgdIv.cImzH/u', '', 0, '2021-01-23 09:05:20', '2021-01-23 09:05:20', 'http://192.168.1.29/projects/res/perfiles/default.gif');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conexion_cliente`
--

CREATE TABLE `conexion_cliente` (
  `pk_conexion_cliente` int(11) NOT NULL,
  `fk_cliente` int(11) DEFAULT NULL,
  `ipv4` varchar(15) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conexion_usuario`
--

CREATE TABLE `conexion_usuario` (
  `pk_conexion_usuario` int(11) NOT NULL,
  `fk_usuario` int(11) DEFAULT NULL,
  `ipv4` varchar(15) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencias`
--

CREATE TABLE `incidencias` (
  `pk_incidencias` int(11) NOT NULL,
  `fk_usuario` int(11) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `incidencias`
--

INSERT INTO `incidencias` (`pk_incidencias`, `fk_usuario`, `name`, `created_at`, `is_active`) VALUES
(5, 0, 'Exception: Error in C:\\xampp\\htdocs\\projects\\action\\registro\\index.php:8\nStack trace:\n#0 C:\\xampp\\htdocs\\projects\\action\\registro\\index.php(37): {closure}(8, \'Undefined index...\', \'C:\\\\xampp\\\\htdocs...\', 37, Array)\n#1 C:\\xampp\\htdocs\\projects\\action\\registro\\index.php(71): insert()\n#2 C:\\xampp\\htdocs\\projects\\process.php(32): include(\'C:\\\\xampp\\\\htdocs...\')\n#3 {main}', '2021-01-14 12:46:08', 1),
(6, 0, 'Exception: Error in C:\\xampp\\htdocs\\projects\\action\\registro\\index.php:8\nStack trace:\n#0 C:\\xampp\\htdocs\\projects\\action\\registro\\index.php(25): {closure}(8, \'Undefined index...\', \'C:\\\\xampp\\\\htdocs...\', 25, Array)\n#1 C:\\xampp\\htdocs\\projects\\action\\registro\\index.php(65): insert()\n#2 C:\\xampp\\htdocs\\projects\\process.php(32): include(\'C:\\\\xampp\\\\htdocs...\')\n#3 {main}', '2021-01-14 12:49:07', 1),
(7, 0, 'Exception in C:\\xampp\\htdocs\\projects\\action\\registro\\index.php:8\nStack trace:\n#0 C:\\xampp\\htdocs\\projects\\action\\registro\\index.php(25): {closure}(8, \'Undefined index...\', \'C:\\\\xampp\\\\htdocs...\', 25, Array)\n#1 C:\\xampp\\htdocs\\projects\\action\\registro\\index.php(65): insert()\n#2 C:\\xampp\\htdocs\\projects\\process.php(32): include(\'C:\\\\xampp\\\\htdocs...\')\n#3 {main}', '2021-01-14 12:51:00', 1),
(8, 0, 'Exception: Error in C:\\xampp\\htdocs\\projects\\action\\registro\\index.php:8\nStack trace:\n#0 C:\\xampp\\htdocs\\projects\\action\\registro\\index.php(25): {closure}(8, \'Undefined index...\', \'C:\\\\xampp\\\\htdocs...\', 25, Array)\n#1 C:\\xampp\\htdocs\\projects\\action\\registro\\index.php(65): insert()\n#2 C:\\xampp\\htdocs\\projects\\process.php(32): include(\'C:\\\\xampp\\\\htdocs...\')\n#3 {main}', '2021-01-14 12:54:22', 1),
(9, 0, 'Exception: Error in C:\\xampp\\htdocs\\projects\\action\\login\\index.php:8\nStack trace:\n#0 C:\\xampp\\htdocs\\projects\\action\\login\\index.php(13): {closure}(8, \'Undefined index...\', \'C:\\\\xampp\\\\htdocs...\', 13, Array)\n#1 C:\\xampp\\htdocs\\projects\\process.php(46): include(\'C:\\\\xampp\\\\htdocs...\')\n#2 {main}', '2021-01-14 15:06:44', 1),
(10, 0, 'Exception: Error in C:\\xampp\\htdocs\\projects\\action\\login\\index.php:8\nStack trace:\n#0 C:\\xampp\\htdocs\\projects\\action\\login\\index.php(13): {closure}(8, \'Undefined index...\', \'C:\\\\xampp\\\\htdocs...\', 13, Array)\n#1 C:\\xampp\\htdocs\\projects\\process.php(46): include(\'C:\\\\xampp\\\\htdocs...\')\n#2 {main}', '2021-01-14 15:06:48', 1),
(11, 0, 'Exception: Error in C:\\xampp\\htdocs\\projects\\action\\login\\index.php:8\nStack trace:\n#0 C:\\xampp\\htdocs\\projects\\action\\login\\index.php(13): {closure}(8, \'Undefined index...\', \'C:\\\\xampp\\\\htdocs...\', 13, Array)\n#1 C:\\xampp\\htdocs\\projects\\process.php(41): include(\'C:\\\\xampp\\\\htdocs...\')\n#2 {main}', '2021-01-14 15:11:25', 1),
(12, 0, 'Exception: Error in C:\\xampp\\htdocs\\projects\\action\\registro\\index.php:8\nStack trace:\n#0 C:\\xampp\\htdocs\\projects\\action\\registro\\index.php(25): {closure}(8, \'Undefined index...\', \'C:\\\\xampp\\\\htdocs...\', 25, Array)\n#1 C:\\xampp\\htdocs\\projects\\action\\registro\\index.php(67): insert()\n#2 C:\\xampp\\htdocs\\projects\\process.php(46): include(\'C:\\\\xampp\\\\htdocs...\')\n#3 {main}', '2021-01-14 15:18:09', 1),
(13, 0, 'Exception: Error in C:\\xampp\\htdocs\\projects\\action\\notification\\clear.php:8\nStack trace:\n#0 [internal function]: {closure}(2, \'mysqli::real_es...\', \'C:\\\\xampp\\\\htdocs...\', 29, Array)\n#1 C:\\xampp\\htdocs\\projects\\model\\notification\\notification.class.php(29): mysqli->real_escape_string(Object(Session))\n#2 C:\\xampp\\htdocs\\projects\\action\\notification\\clear.php(17): notification->setfkusuario(Object(Session))\n#3 C:\\xampp\\htdocs\\projects\\process.php(53): include(\'C:\\\\xampp\\\\htdocs...\')\n#4 {main}', '2021-01-14 15:46:09', 1),
(14, 0, 'Exception: Error in C:\\xampp\\htdocs\\projects\\action\\notification\\clear.php:8\nStack trace:\n#0 [internal function]: {closure}(2, \'mysqli::real_es...\', \'C:\\\\xampp\\\\htdocs...\', 29, Array)\n#1 C:\\xampp\\htdocs\\projects\\model\\notification\\notification.class.php(29): mysqli->real_escape_string(Object(Session))\n#2 C:\\xampp\\htdocs\\projects\\action\\notification\\clear.php(17): notification->setfkusuario(Object(Session))\n#3 C:\\xampp\\htdocs\\projects\\process.php(53): include(\'C:\\\\xampp\\\\htdocs...\')\n#4 {main}', '2021-01-14 15:46:32', 1),
(15, 0, 'Exception: Error in C:\\xampp\\htdocs\\projects\\action\\notification\\clear.php:8\nStack trace:\n#0 [internal function]: {closure}(2, \'mysqli::real_es...\', \'C:\\\\xampp\\\\htdocs...\', 29, Array)\n#1 C:\\xampp\\htdocs\\projects\\model\\notification\\notification.class.php(29): mysqli->real_escape_string(Object(Session))\n#2 C:\\xampp\\htdocs\\projects\\action\\notification\\clear.php(17): notification->setfkusuario(Object(Session))\n#3 C:\\xampp\\htdocs\\projects\\process.php(53): include(\'C:\\\\xampp\\\\htdocs...\')\n#4 {main}', '2021-01-14 15:47:42', 1),
(16, 0, 'Exception: Error in C:\\xampp\\htdocs\\projects\\action\\usuarios\\insert.php:8\nStack trace:\n#0 C:\\xampp\\htdocs\\projects\\action\\usuarios\\insert.php(30): {closure}(8, \'Undefined index...\', \'C:\\\\xampp\\\\htdocs...\', 30, Array)\n#1 C:\\xampp\\htdocs\\projects\\process.php(53): include(\'C:\\\\xampp\\\\htdocs...\')\n#2 {main}', '2021-01-15 12:29:23', 1),
(17, 0, 'Exception: Error in C:\\xampp\\htdocs\\projects\\action\\usuarios\\insert.php:8\nStack trace:\n#0 C:\\xampp\\htdocs\\projects\\action\\usuarios\\insert.php(39): {closure}(8, \'Undefined index...\', \'C:\\\\xampp\\\\htdocs...\', 39, Array)\n#1 C:\\xampp\\htdocs\\projects\\process.php(53): include(\'C:\\\\xampp\\\\htdocs...\')\n#2 {main}', '2021-01-15 12:32:02', 1),
(18, 0, 'Exception: Error in C:\\xampp\\htdocs\\projects\\action\\usuarios\\insert.php:8\nStack trace:\n#0 C:\\xampp\\htdocs\\projects\\action\\usuarios\\insert.php(39): {closure}(8, \'Undefined index...\', \'C:\\\\xampp\\\\htdocs...\', 39, Array)\n#1 C:\\xampp\\htdocs\\projects\\process.php(53): include(\'C:\\\\xampp\\\\htdocs...\')\n#2 {main}', '2021-01-15 12:32:35', 1),
(19, 0, 'Exception: Error in C:\\xampp\\htdocs\\projects\\action\\notification\\index.php:8\nStack trace:\n#0 C:\\xampp\\htdocs\\projects\\action\\notification\\index.php(32): {closure}(2, \'count(): Parame...\', \'C:\\\\xampp\\\\htdocs...\', 32, Array)\n#1 C:\\xampp\\htdocs\\projects\\process.php(49): include(\'C:\\\\xampp\\\\htdocs...\')\n#2 {main}', '2021-01-19 09:41:51', 1),
(20, 0, 'Exception: Error in C:\\xampp\\htdocs\\projects\\action\\notification\\index.php:8\nStack trace:\n#0 C:\\xampp\\htdocs\\projects\\action\\notification\\index.php(32): {closure}(2, \'count(): Parame...\', \'C:\\\\xampp\\\\htdocs...\', 32, Array)\n#1 C:\\xampp\\htdocs\\projects\\process.php(49): include(\'C:\\\\xampp\\\\htdocs...\')\n#2 {main}', '2021-01-19 09:42:19', 1),
(21, 0, 'Exception: Error in C:\\xampp\\htdocs\\projects\\action\\notification\\index.php:8\nStack trace:\n#0 C:\\xampp\\htdocs\\projects\\action\\notification\\index.php(32): {closure}(2, \'count(): Parame...\', \'C:\\\\xampp\\\\htdocs...\', 32, Array)\n#1 C:\\xampp\\htdocs\\projects\\process.php(49): include(\'C:\\\\xampp\\\\htdocs...\')\n#2 {main}', '2021-01-19 09:42:26', 1),
(22, 0, 'Exception: Error in C:\\xampp\\htdocs\\projects\\action\\notification\\index.php:8\nStack trace:\n#0 C:\\xampp\\htdocs\\projects\\action\\notification\\index.php(32): {closure}(2, \'count(): Parame...\', \'C:\\\\xampp\\\\htdocs...\', 32, Array)\n#1 C:\\xampp\\htdocs\\projects\\process.php(49): include(\'C:\\\\xampp\\\\htdocs...\')\n#2 {main}', '2021-01-19 09:43:07', 1),
(23, 0, 'Exception: Error in C:\\xampp\\htdocs\\projects\\action\\notification\\index.php:8\nStack trace:\n#0 C:\\xampp\\htdocs\\projects\\action\\notification\\index.php(32): {closure}(2, \'count(): Parame...\', \'C:\\\\xampp\\\\htdocs...\', 32, Array)\n#1 C:\\xampp\\htdocs\\projects\\process.php(49): include(\'C:\\\\xampp\\\\htdocs...\')\n#2 {main}', '2021-01-19 09:43:08', 1),
(24, 0, 'Exception: Error in C:\\xampp\\htdocs\\projects\\action\\notification\\index.php:8\nStack trace:\n#0 C:\\xampp\\htdocs\\projects\\action\\notification\\index.php(32): {closure}(2, \'count(): Parame...\', \'C:\\\\xampp\\\\htdocs...\', 32, Array)\n#1 C:\\xampp\\htdocs\\projects\\process.php(49): include(\'C:\\\\xampp\\\\htdocs...\')\n#2 {main}', '2021-01-19 09:43:08', 1),
(25, 0, 'Exception: Error in C:\\xampp\\htdocs\\projects\\action\\notification\\index.php:8\nStack trace:\n#0 C:\\xampp\\htdocs\\projects\\action\\notification\\index.php(32): {closure}(2, \'count(): Parame...\', \'C:\\\\xampp\\\\htdocs...\', 32, Array)\n#1 C:\\xampp\\htdocs\\projects\\process.php(49): include(\'C:\\\\xampp\\\\htdocs...\')\n#2 {main}', '2021-01-19 09:43:09', 1),
(26, 0, 'Exception: Error in C:\\xampp\\htdocs\\projects\\action\\notification\\index.php:8\nStack trace:\n#0 C:\\xampp\\htdocs\\projects\\action\\notification\\index.php(32): {closure}(2, \'count(): Parame...\', \'C:\\\\xampp\\\\htdocs...\', 32, Array)\n#1 C:\\xampp\\htdocs\\projects\\process.php(49): include(\'C:\\\\xampp\\\\htdocs...\')\n#2 {main}', '2021-01-19 09:43:09', 1),
(27, 0, 'Exception: Error in C:\\xampp\\htdocs\\projects\\action\\notification\\index.php:8\nStack trace:\n#0 C:\\xampp\\htdocs\\projects\\action\\notification\\index.php(32): {closure}(2, \'count(): Parame...\', \'C:\\\\xampp\\\\htdocs...\', 32, Array)\n#1 C:\\xampp\\htdocs\\projects\\process.php(49): include(\'C:\\\\xampp\\\\htdocs...\')\n#2 {main}', '2021-01-19 09:43:09', 1),
(28, 0, 'Exception: Error in C:\\xampp\\htdocs\\projects\\action\\notification\\index.php:8\nStack trace:\n#0 C:\\xampp\\htdocs\\projects\\action\\notification\\index.php(32): {closure}(2, \'count(): Parame...\', \'C:\\\\xampp\\\\htdocs...\', 32, Array)\n#1 C:\\xampp\\htdocs\\projects\\process.php(49): include(\'C:\\\\xampp\\\\htdocs...\')\n#2 {main}', '2021-01-19 09:43:24', 1),
(29, 0, 'Exception: Error in C:\\xampp\\htdocs\\projects\\action\\notification\\index.php:8\nStack trace:\n#0 C:\\xampp\\htdocs\\projects\\action\\notification\\index.php(32): {closure}(2, \'count(): Parame...\', \'C:\\\\xampp\\\\htdocs...\', 32, Array)\n#1 C:\\xampp\\htdocs\\projects\\process.php(49): include(\'C:\\\\xampp\\\\htdocs...\')\n#2 {main}', '2021-01-19 09:43:25', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job`
--

CREATE TABLE `job` (
  `pk_job` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `job`
--

INSERT INTO `job` (`pk_job`, `name`, `created_at`, `updated_at`) VALUES
(2, 'sistemas2', '2021-01-19 12:48:52', '2021-01-19 12:48:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notification`
--

CREATE TABLE `notification` (
  `pk_notification` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `is_active` text DEFAULT 'all',
  `link` text DEFAULT NULL,
  `fk_rol_name` varchar(25) DEFAULT NULL,
  `fk_usuario` int(11) DEFAULT NULL,
  `is_view` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `notification`
--

INSERT INTO `notification` (`pk_notification`, `name`, `created_at`, `is_active`, `link`, `fk_rol_name`, `fk_usuario`, `is_view`) VALUES
(7, '<span class=\"noti-title\">Kevin Arnold Zorem  </span><span class=\"noti-title\">se ha registrado</span>', '2021-01-14 15:20:27', 'all', 'perfil/9', 'admin', 9, '[\"1\"]'),
(8, '<span class=\"noti-title\">Kevin Arnold Zorem  </span><span class=\"noti-title\">se ha registrado un nuevo cliente</span>', '2021-01-20 15:04:55', 'all', 'clientes/perfil/2', '', 1, '[\"1\"]'),
(9, '<span class=\"noti-title\">Kevin Arnold Zorem  </span><span class=\"noti-title\">ha registrado un nuevo cliente</span>', '2021-01-20 15:23:51', 'all', 'clientes/perfil/3', '', 1, '[\"1\"]'),
(10, '<span class=\"noti-title\">Kevin Arnold Zorem  </span><span class=\"noti-title\">ha registrado un nuevo cliente</span>', '2021-01-22 11:02:42', 'all', 'clientes/perfil/4', '', 1, '[\"1\",\"14\"]'),
(11, '<span class=\"noti-title\">Kevin Arnold Zorem  </span><span class=\"noti-title\">se ha registrado</span>', '2021-01-22 12:05:02', 'all', 'perfil/13', '', 13, '[\"14\",\"1\"]'),
(12, '<span class=\"noti-title\">juan  </span><span class=\"noti-title\">se ha registrado</span>', '2021-01-22 16:01:28', 'all', 'perfil/14', '', 14, '[\"14\",\"1\"]'),
(13, '<span class=\"noti-title\">Kevin Arnold Zorem  </span><span class=\"noti-title\">ha registrado un nuevo cliente</span>', '2021-01-23 09:05:20', 'all', 'clientes/perfil/5', '', 1, '[\"1\"]'),
(14, '<span class=\"noti-title\">Kevin Arnold Zorem  </span><span class=\"noti-title\">ha registrado un nuevo proyecto</span>', '2021-01-23 11:13:44', 'all', 'proyectos/view/9', '', 1, '[\"1\"]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `pk_proyecto` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `presupuesto` double DEFAULT NULL,
  `archivos` text DEFAULT NULL,
  `estado` varchar(20) DEFAULT 'cotizacion',
  `progress` double(18,2) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `priority` enum('low','medium','high') DEFAULT NULL,
  `fk_cliente` int(11) DEFAULT NULL,
  `fk_usuario_lider` text DEFAULT '[]',
  `fk_usuario` text DEFAULT '[]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`pk_proyecto`, `name`, `descripcion`, `fecha_entrega`, `presupuesto`, `archivos`, `estado`, `progress`, `start_date`, `duration`, `created_at`, `updated_at`, `priority`, `fk_cliente`, `fk_usuario_lider`, `fk_usuario`) VALUES
(5, 'Proyecto 02', '<p>esto es un descripcion</p>', '0000-00-00', 0, '[\"res\\/proyectos\\/5\\/74382774_125376575544775_6926046484659961856_n.png\",\"res\\/proyectos\\/5\\/127526571_825847931544431_5733249339537435135_n.jpg\",\"res\\/proyectos\\/5\\/136662348_10164463970145425_4549499798949158048_n.jpg\",\"res\\/proyectos\\/5\\/137570744_278261393721551_6722768434447361968_o.jpg\"]', 'creado', 0.00, '2021-01-21', 1, '2021-01-21 13:43:54', '2021-01-21 13:43:54', 'low', 3, '{\"0\":\"13\",\"2\":\"1\",\"3\":\"14\"}', '[\"9\",\"1\"]'),
(6, 'Proyecto 03', '<p>esto es un descripcion</p>', '0000-00-00', 0, '[\"res\\/proyectos\\/6\\/74382774_125376575544775_6926046484659961856_n.png\",\"res\\/proyectos\\/6\\/127526571_825847931544431_5733249339537435135_n.jpg\",\"res\\/proyectos\\/6\\/136662348_10164463970145425_4549499798949158048_n.jpg\",\"res\\/proyectos\\/6\\/137570744_278261393721551_6722768434447361968_o.jpg\"]', 'creado', 0.00, '2021-01-21', 1, '2021-01-21 13:45:39', '2021-01-21 13:45:39', 'low', 3, '[]', '[]'),
(8, 'Proyecto prueba', '', '0000-00-00', 1500, '[\"res\\/proyectos\\/8\\/74382774_125376575544775_6926046484659961856_n.png\"]', 'creado', 0.00, '2021-01-12', 17, '2021-01-23 11:01:52', '2021-01-23 11:01:52', 'low', 5, '[]', '[]'),
(9, 'Proyecto prueba 2', 'asdasdasdasdasd', '0000-00-00', 12312, '[\"res\\/proyectos\\/9\\/74382774_125376575544775_6926046484659961856_n.png\"]', 'creado', 0.00, '2021-01-13', 15, '2021-01-23 11:13:44', '2021-01-23 11:13:44', 'high', 1, '[]', '[]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `pk_rol` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`pk_rol`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2021-01-14 17:03:33', '2021-01-14 17:36:52'),
(3, 'tarea1', '2021-01-22 11:39:32', '2021-01-22 11:39:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_vista`
--

CREATE TABLE `rol_vista` (
  `id` int(11) NOT NULL,
  `fk_rol` int(11) NOT NULL,
  `fk_vista` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol_vista`
--

INSERT INTO `rol_vista` (`id`, `fk_rol`, `fk_vista`) VALUES
(1, 1, 9),
(3, 1, 5),
(4, 1, 1),
(5, 1, 21),
(6, 1, 8),
(7, 3, 22),
(8, 3, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `task`
--

CREATE TABLE `task` (
  `pk_task` int(11) NOT NULL,
  `duration` int(11) DEFAULT NULL,
  `progress` double(8,2) DEFAULT 0.00,
  `start_date` date DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `sortorder` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `fk_proyecto` int(11) NOT NULL,
  `fk_area` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `task`
--

INSERT INTO `task` (`pk_task`, `duration`, `progress`, `start_date`, `parent`, `created_at`, `updated_at`, `sortorder`, `name`, `descripcion`, `fk_proyecto`, `fk_area`) VALUES
(5, 5, 0.00, '2021-01-13', 1, '2021-01-21 15:06:06', '2021-01-21 15:06:06', NULL, '123123', NULL, 0, 0),
(9, 1, 0.00, '2021-01-22', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Nueva Tarea', 'Esto es una nueva tarea', 5, 1),
(10, 5, 0.00, '2021-01-22', 9, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Nueva Tarea 2', 'asdasdasd', 0, 1),
(11, 4, 0.00, '2021-01-22', 9, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Nueva Tarea 23', 'asdadasd', 0, 1),
(12, 8, 0.00, '2021-01-22', 0, '2021-01-22 15:29:14', '2021-01-23 12:25:08', 0, 'Nueva Tarea 24', 'asdasd', 6, 1),
(13, 5, 0.00, '2021-01-22', 12, '2021-01-22 15:29:23', '2021-01-22 15:29:23', 0, 'Nueva Tarea 2', 'asdadasd', 0, 1),
(15, 6, 0.00, '2021-01-22', 14, '2021-01-22 15:35:00', '2021-01-22 15:35:00', 0, 'Nueva Tarea 2', '', 0, 1),
(16, 6, 0.00, '2021-01-22', 15, '2021-01-22 15:35:09', '2021-01-22 15:35:09', 0, 'Nueva Tarea 23', '', 0, 1),
(17, 0, 0.00, '0000-00-00', 0, '2021-01-23 09:58:50', '2021-01-23 09:58:50', 0, '', '', 0, 1),
(18, 0, 0.00, '0000-00-00', 0, '2021-01-23 10:52:06', '2021-01-23 10:52:06', 0, '', '', 0, 1),
(19, 0, 0.00, '0000-00-00', 0, '2021-01-23 10:54:49', '2021-01-23 10:54:49', 0, '', '', 0, 1),
(20, 0, 0.00, '0000-00-00', 0, '2021-01-23 11:53:13', '2021-01-23 11:53:13', 0, '', '', 0, 1),
(21, 2, 0.00, '2021-01-28', 12, '2021-01-23 11:56:11', '2021-01-23 12:25:17', 0, 'tarea 2', 'asdasd', 0, 1),
(22, 2, 0.00, '2021-01-28', 12, '2021-01-23 11:56:50', '2021-01-23 12:22:56', 0, 'tarea 31', 'asdasd', 0, 0),
(23, 0, 0.00, '0000-00-00', 0, '2021-01-23 12:04:17', '2021-01-23 12:04:17', 0, '', '', 0, 1),
(24, 0, 0.00, '0000-00-00', 0, '2021-01-23 12:06:10', '2021-01-23 12:06:10', 0, '', '', 0, 1),
(25, 0, 0.00, '0000-00-00', 0, '2021-01-23 12:08:36', '2021-01-23 12:08:36', 0, '', '', 0, 1),
(26, 0, 0.00, '0000-00-00', 0, '2021-01-23 12:22:27', '2021-01-23 12:22:27', 0, '', '', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `pk_usuario` int(11) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `dni` varchar(15) DEFAULT NULL,
  `telefono` varchar(25) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(300) NOT NULL,
  `image` text DEFAULT NULL,
  `fk_area` int(11) DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 0,
  `fk_job` int(11) DEFAULT 0,
  `parent` int(11) DEFAULT 0,
  `fk_rol` int(11) DEFAULT 0,
  `birth_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`pk_usuario`, `nombres`, `dni`, `telefono`, `email`, `password`, `image`, `fk_area`, `created_at`, `updated_at`, `is_active`, `fk_job`, `parent`, `fk_rol`, `birth_date`) VALUES
(1, 'Kevin Arnold Zorem', '70051354', '942971175', 'elmanhpt@gmail.com', '$2y$10$6hep7oy6vhZUjoMK7mYnHO0GaSJgfuAvpRlhZJ0AyrsFhIwbsOMOC', 'http://192.168.1.29/projects/res/perfiles/74382774_125376575544775_6926046484659961856_n.png', 1, '2021-01-12 15:02:12', '0000-00-00 00:00:00', 0, 2, 9, 1, '2021-01-19'),
(9, 'Kevin Arnold Arias Figueroa', '123123', '', 'zorem@gmail.com', '$2y$10$fbSFhEXZsvCAYVuE5pZ2KejOcPZBfySqhxR/H82EYNW4oYP63R/gG', 'http://localhost/projects/res/perfiles/default.gif', 0, '2021-01-14 15:20:27', '2021-01-14 15:20:27', 0, 0, 0, 1, NULL),
(10, 'asdasdasd', '1212323123', '123123', 'algo@gmail.com', '$2y$10$qv4r37K3/fnSnVQocX6bbebz33tWn3SRl934.czkV8Kw3fK1bFj46', 'http://localhost/projects/res/perfiles/default.gif', 1, '2021-01-15 12:33:55', '2021-01-15 12:33:55', 0, 0, 1, 1, '0000-00-00'),
(11, 'asdasdasd', '1212323123', '123123', 'salgo@gmail.com', '$2y$10$MYtwlbZ6uUweswRVzhujT.85/E/CphC0fsP8uq4zLYCphVyx7FLKO', 'http://localhost/projects/res/perfiles/default.gif', 1, '2021-01-15 12:37:24', '2021-01-15 12:37:24', 0, 0, 1, 1, '0000-00-00'),
(13, 'Kevin Arnold Zorem', '', '', 'adm22in@gmail.com', '$2y$10$GP9McYcV4YtJVcZLCdH5NOVRsIk3U.1xvgdoVFtSlg4CVP1MzZ2nm', 'http://localhost/projects/res/perfiles/default.gif', 0, '2021-01-22 12:05:02', '2021-01-22 12:05:02', 0, 0, 0, 0, '0000-00-00'),
(14, 'juan', '', '', 'juan@juan.com', '$2y$10$8s1s8S7/YpZLYmSJdMLMfOqvEGIqRGoJ44uri1b6JimhrPs6.2CAe', 'http://192.168.1.29/projects/res/perfiles/default.gif', 0, '2021-01-22 16:01:28', '2021-01-22 16:01:28', 0, 0, 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vista`
--

CREATE TABLE `vista` (
  `pk_vista` int(11) NOT NULL,
  `vista` text DEFAULT NULL,
  `tipo` enum('vista','proceso') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `vista`
--

INSERT INTO `vista` (`pk_vista`, `vista`, `tipo`) VALUES
(1, 'view/roles/', 'vista'),
(3, 'view/areas/', 'vista'),
(4, 'view/usuarios/', 'vista'),
(5, 'view/404/', 'vista'),
(8, 'action/job/delete', 'proceso'),
(9, 'view/roles/permisos/', 'vista'),
(10, 'action/roles/permisos/insert', 'proceso'),
(11, 'action/roles/permisos/delete', 'proceso'),
(13, 'view/job/', 'vista'),
(14, 'view/home/', 'vista'),
(15, 'view/proyectos/', 'vista'),
(16, 'view/proyectos/lista/', 'vista'),
(17, 'view/clientes/', 'vista'),
(18, 'view/clientes/lista/', 'vista'),
(19, 'view/clientes/perfil/', 'vista'),
(20, 'view/perfil/', 'vista'),
(21, 'action/clientes/insert', 'proceso'),
(22, 'view/notificaciones/', 'vista'),
(23, 'action/notification/', 'proceso'),
(24, 'action/proyectos/insert', 'proceso'),
(25, 'view/proyectos/view/', 'vista'),
(26, 'action/proyectos/view/addtask', 'proceso'),
(27, 'action/proyectos/view/download', 'proceso'),
(28, 'action/roles/insert', 'proceso'),
(29, 'action/login/logout', 'proceso'),
(30, 'view/login/', 'vista'),
(31, 'view/registro/', 'vista'),
(32, 'action/registro/', 'proceso'),
(33, 'action/login/', 'proceso'),
(34, 'view/proyectos/tarea/', 'vista'),
(35, 'action/proyectos/tarea/insert', 'proceso'),
(36, 'action/proyectos/tarea/delete', 'proceso'),
(37, 'view/proyectos/tarea/child/', 'vista'),
(38, 'action/proyectos/tarea/child/insert', 'proceso'),
(39, 'action/proyectos/delete', 'proceso'),
(40, 'action/clientes/delete', 'proceso'),
(41, 'action/proyectos/view/', 'proceso'),
(42, 'action/proyectos/view/addliders', 'proceso'),
(43, 'action/proyectos/tarea/', 'proceso'),
(44, 'action/proyectos/tarea/getAllById', 'proceso'),
(45, 'action/proyectos/view/addusers', 'proceso'),
(46, 'action/proyectos/view/deleteusers', 'proceso'),
(47, 'action/perfil/update', 'proceso'),
(48, 'action/proyectos/tarea/update', 'proceso'),
(49, 'action/proyectos/listar', 'proceso');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`pk_area`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`pk_cliente`);

--
-- Indices de la tabla `conexion_cliente`
--
ALTER TABLE `conexion_cliente`
  ADD PRIMARY KEY (`pk_conexion_cliente`);

--
-- Indices de la tabla `conexion_usuario`
--
ALTER TABLE `conexion_usuario`
  ADD PRIMARY KEY (`pk_conexion_usuario`);

--
-- Indices de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD PRIMARY KEY (`pk_incidencias`);

--
-- Indices de la tabla `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`pk_job`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`pk_notification`);

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`pk_proyecto`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`pk_rol`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `rol_vista`
--
ALTER TABLE `rol_vista`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`pk_task`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`pk_usuario`);

--
-- Indices de la tabla `vista`
--
ALTER TABLE `vista`
  ADD PRIMARY KEY (`pk_vista`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `area`
--
ALTER TABLE `area`
  MODIFY `pk_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `pk_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `conexion_cliente`
--
ALTER TABLE `conexion_cliente`
  MODIFY `pk_conexion_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `conexion_usuario`
--
ALTER TABLE `conexion_usuario`
  MODIFY `pk_conexion_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  MODIFY `pk_incidencias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `job`
--
ALTER TABLE `job`
  MODIFY `pk_job` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `notification`
--
ALTER TABLE `notification`
  MODIFY `pk_notification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `pk_proyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `pk_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `rol_vista`
--
ALTER TABLE `rol_vista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `task`
--
ALTER TABLE `task`
  MODIFY `pk_task` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `pk_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `vista`
--
ALTER TABLE `vista`
  MODIFY `pk_vista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
