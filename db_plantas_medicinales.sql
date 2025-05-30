-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 30-05-2025 a las 10:52:41
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_plantas_medicinales`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crud_modulo`
--

CREATE TABLE `crud_modulo` (
  `idmod` int NOT NULL,
  `mod_nombre` varchar(255) NOT NULL,
  `mod_descripcion` text NOT NULL,
  `mod_estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `crud_modulo`
--

INSERT INTO `crud_modulo` (`idmod`, `mod_nombre`, `mod_descripcion`, `mod_estado`) VALUES
(365, 'Subordenes', '', 1),
(366, 'Familias', '', 1),
(367, 'Generos', '', 1),
(368, 'Ordenes', '', 1),
(369, 'Ordenes', 'CREATE TABLE ma_ordenes_1 (\r\n                idorden INT AUTO_INCREMENT NOT NULL,\r\n                or_nombre VARCHAR(200) NOT NULL,\r\n                or_descripcion VARCHAR(200) NOT NULL,\r\n                or_date DATETIME DEFAULT current_timestamp() NOT NU', 1),
(370, 'Subordenes', 'CREATE TABLE ma_ordenes_1 (\r\n                idorden INT AUTO_INCREMENT NOT NULL,\r\n                or_nombre VARCHAR(200) NOT NULL,\r\n                or_descripcion VARCHAR(200) NOT NULL,\r\n                or_date DATETIME DEFAULT current_timestamp() NOT NU', 1),
(371, 'Especies', '', 1),
(372, 'Ordenes', '', 1),
(373, 'Subordenes', '', 1),
(374, 'Familias', '', 1),
(375, 'Generos', '', 1),
(376, 'Especies', '', 1),
(377, 'Subordenes', 'CREATE TABLE ma_subordenes_1 (\r\n                idsuborden INT AUTO_INCREMENT NOT NULL,\r\n                idorden INT NOT NULL,\r\n                sub_nombre VARCHAR(255) DEFAULT \'undefined\' NOT NULL,\r\n                sub_descripcion VARCHAR(255) DEFAULT \'un', 1),
(378, 'Especies', 'CREATE TABLE ma_especies_1 (\n                idespecie INT AUTO_INCREMENT NOT NULL,\n                idgenero INT NOT NULL,\n                es_nombre_cientifico VARCHAR(255) NOT NULL,\n                es_nombre_comun VARCHAR(255) NOT NULL,\n            ', 1),
(379, 'Centinela', '', 1),
(380, 'Centinela', '', 1),
(381, 'Centinela', '', 1),
(382, 'Centinela', '', 1),
(383, 'Centinela', '', 1),
(384, 'Centinela', '', 1),
(385, 'Centinela', '', 1),
(386, 'Centinela', '', 1),
(387, 'Configuracion', '', 1),
(388, 'Historial', 'CREATE TABLE ma_historial_identificacion (\r\n                idhistorial INT AUTO_INCREMENT NOT NULL,\r\n                iddetallemodelo INT NOT NULL,\r\n                his_tiempo VARCHAR(50) NOT NULL,\r\n                his_inicio VARCHAR(50) NOT NULL,\r\n                his_fin VARCHAR(50) NOT NULL,\r\n                his_fecha DATETIME DEFAULT current_timestamp() NOT NULL,\r\n                PRIMARY KEY (idhistorial)\r\n);\r\n', 1),
(389, 'Historial', 'CREATE TABLE ma_historial_identificacion (\r\n                idhistorial INT AUTO_INCREMENT NOT NULL,\r\n                iddetallemodelo INT NOT NULL,\r\n                his_tiempo VARCHAR(50) NOT NULL,\r\n                his_inicio VARCHAR(50) NOT NULL,\r\n                his_fin VARCHAR(50) NOT NULL,\r\n                his_index INT NOT NULL,\r\n                his_prediccion VARCHAR(255),\r\n                his_fecha DATETIME DEFAULT current_timestamp() NOT NULL,\r\n                PRIMARY KEY (idhistorial)\r\n);\r\n', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_clases`
--

CREATE TABLE `ma_clases` (
  `idclase` int NOT NULL,
  `idfilo` int NOT NULL,
  `cla_nombre` varchar(200) NOT NULL DEFAULT 'undefined'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_configuracion`
--

CREATE TABLE `ma_configuracion` (
  `idconfig` int NOT NULL,
  `nombre` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ma_configuracion`
--

INSERT INTO `ma_configuracion` (`idconfig`, `nombre`, `valor`, `date`) VALUES
(1, 'ruta_imagen_especies', '{ \"ruta_imagen_especies\": \"img/especies\", \"carpeta_img_entrenamiento\": \"img/entrenamiento\", \"ruta_train_delete\": \"img/eliminar/\", \"ruta_datos_entrenamiento\": \"entrenamiento\", \"nombre_datos_entrenamiento\": \"data-train\", \"nombre_modelo\": \"modelo-svm\", \"ruta_modelo\": \"modelo\", \"ruta_img_id\": \"predicciones\", \"prefix_id\": \"id\", \"prefix_data\": \"data\", \"prefix_train\": \"train\" }', '2025-05-29 23:27:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_detalle_modelo`
--

CREATE TABLE `ma_detalle_modelo` (
  `iddetallemodelo` int NOT NULL,
  `idmodelo` int NOT NULL,
  `identrenamiento` int NOT NULL,
  `det_ruta` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `det_nombre` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `det_default` tinyint(1) NOT NULL DEFAULT '0',
  `det_tiempo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `det_inicio` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `det_fin` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `det_fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_entrenamiento`
--

CREATE TABLE `ma_entrenamiento` (
  `identrenamiento` int NOT NULL,
  `ent_fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ent_ruta_datos_generados` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ent_nombre_datos_generados` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ent_total_imagenes` int NOT NULL,
  `ent_descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ent_diccionario` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ent_tiempo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ent_inicio` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ent_fin` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ent_default` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_especies`
--

CREATE TABLE `ma_especies` (
  `idespecie` int NOT NULL,
  `idgenero` int NOT NULL,
  `es_nombre_cientifico` varchar(255) NOT NULL,
  `es_nombre_comun` varchar(255) NOT NULL,
  `es_habitad` varchar(255) NOT NULL,
  `es_alimentacion` varchar(255) NOT NULL,
  `es_plantas_hospederas` varchar(255) NOT NULL,
  `es_tiempo_de_vida` varchar(255) NOT NULL,
  `es_imagen_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_especies_1`
--

CREATE TABLE `ma_especies_1` (
  `idespecie` int NOT NULL,
  `idgenero` int NOT NULL,
  `es_nombre_cientifico` varchar(255) NOT NULL,
  `es_nombre_comun` varchar(255) NOT NULL,
  `es_tamanio` varchar(255) NOT NULL,
  `es_imagen_url` varchar(255) NOT NULL,
  `es_descripcion` text NOT NULL,
  `es_slug` varchar(255) NOT NULL,
  `es_status` tinyint(1) NOT NULL DEFAULT '1',
  `es_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_especies_2`
--

CREATE TABLE `ma_especies_2` (
  `idespecie` int NOT NULL,
  `idgenero` int NOT NULL,
  `es_nombre_cientifico` varchar(255) NOT NULL,
  `es_nombre_comun` varchar(255) NOT NULL,
  `es_tamanio` varchar(255) NOT NULL,
  `es_imagen_url` varchar(255) NOT NULL,
  `es_descripcion` text NOT NULL,
  `es_slug` varchar(255) NOT NULL,
  `es_status` tinyint(1) NOT NULL DEFAULT '1',
  `es_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_familias`
--

CREATE TABLE `ma_familias` (
  `idfamilia` int NOT NULL,
  `idsuperfamilia` int NOT NULL,
  `fam_nombre` varchar(255) NOT NULL DEFAULT 'undefined'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_familias_1`
--

CREATE TABLE `ma_familias_1` (
  `idfamilia` int NOT NULL,
  `idorden` int NOT NULL,
  `fam_nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'undefined',
  `fam_descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'undefined',
  `fam_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_filos`
--

CREATE TABLE `ma_filos` (
  `idfilo` int NOT NULL,
  `idreino` int NOT NULL,
  `fi_nombre` varchar(200) NOT NULL DEFAULT 'undefined'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_generos`
--

CREATE TABLE `ma_generos` (
  `idgenero` int NOT NULL,
  `idgeneros` int NOT NULL,
  `gen_nombres` varchar(255) NOT NULL DEFAULT 'undefined'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_generos_1`
--

CREATE TABLE `ma_generos_1` (
  `idgenero` int NOT NULL,
  `idsubfamilia` int NOT NULL,
  `gen_nombres` varchar(255) NOT NULL DEFAULT 'undefined',
  `gen_descripcion` text NOT NULL,
  `gen_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_historial_identificacion`
--

CREATE TABLE `ma_historial_identificacion` (
  `idhistorial` int NOT NULL,
  `iddetallemodelo` int NOT NULL,
  `idusuario` int NOT NULL DEFAULT '0',
  `his_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `his_tiempo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `his_inicio` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `his_fin` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `his_index` int NOT NULL,
  `his_prediccion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `his_fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_modelo`
--

CREATE TABLE `ma_modelo` (
  `idmodelo` int NOT NULL,
  `mo_nombre` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mo_clasificador` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mo_descriptor` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mo_default` tinyint(1) NOT NULL DEFAULT '0',
  `mo_fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ma_modelo`
--

INSERT INTO `ma_modelo` (`idmodelo`, `mo_nombre`, `mo_clasificador`, `mo_descriptor`, `mo_default`, `mo_fecha`) VALUES
(1, 'modelo 1', 'clasificador', 'des', 1, '2025-05-29 23:26:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_ordenes`
--

CREATE TABLE `ma_ordenes` (
  `idorden` int NOT NULL,
  `or_nombre` varchar(200) NOT NULL DEFAULT 'undefined',
  `idclase` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_ordenes_1`
--

CREATE TABLE `ma_ordenes_1` (
  `idorden` int NOT NULL,
  `or_nombre` varchar(200) NOT NULL,
  `or_descripcion` varchar(200) NOT NULL,
  `or_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_reinos`
--

CREATE TABLE `ma_reinos` (
  `idreino` int NOT NULL,
  `re_nombre` varchar(200) NOT NULL DEFAULT 'undefined'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_subfamilias`
--

CREATE TABLE `ma_subfamilias` (
  `idsubfamilia` int NOT NULL,
  `idfamilia` int NOT NULL,
  `sub_nombre` varchar(255) NOT NULL DEFAULT 'undefined'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_subfamilias_1`
--

CREATE TABLE `ma_subfamilias_1` (
  `idsubfamilia` int NOT NULL,
  `idfamilia` int NOT NULL,
  `sub_nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'undefined',
  `sub_descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_superfamilias`
--

CREATE TABLE `ma_superfamilias` (
  `idsuperfamilia` int NOT NULL,
  `idorden` int NOT NULL,
  `sp_nombre` varchar(255) NOT NULL DEFAULT 'undefined'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_tribus`
--

CREATE TABLE `ma_tribus` (
  `idgeneros` int NOT NULL,
  `idsubfamilia` int NOT NULL,
  `tri_nombres` varchar(255) NOT NULL DEFAULT 'undefined'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sis_centinela`
--

CREATE TABLE `sis_centinela` (
  `idvisita` int NOT NULL,
  `vis_cod` int NOT NULL,
  `idwebusuario` int DEFAULT '0',
  `vis_ip` varchar(200) NOT NULL,
  `vis_agente` varchar(255) NOT NULL,
  `vis_method` varchar(10) DEFAULT NULL,
  `vis_url` text,
  `vis_fechahora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `sis_centinela`
--

INSERT INTO `sis_centinela` (`idvisita`, `vis_cod`, `idwebusuario`, `vis_ip`, `vis_agente`, `vis_method`, `vis_url`, `vis_fechahora`) VALUES
(488, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/database/execute', '2025-05-29 23:17:08'),
(489, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/sistem', '2025-05-29 23:17:10'),
(490, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/sistem', '2025-05-29 23:17:11'),
(491, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/permisos', '2025-05-29 23:17:16'),
(492, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/permisos', '2025-05-29 23:17:16'),
(493, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/permisos/delete', '2025-05-29 23:17:30'),
(494, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/permisos', '2025-05-29 23:17:30'),
(495, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/permisos/delete', '2025-05-29 23:17:32'),
(496, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/permisos', '2025-05-29 23:17:32'),
(497, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/permisos/delete', '2025-05-29 23:17:34'),
(498, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/permisos', '2025-05-29 23:17:34'),
(499, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/permisos/delete', '2025-05-29 23:17:35'),
(500, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/permisos', '2025-05-29 23:17:35'),
(501, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/permisos/delete', '2025-05-29 23:17:36'),
(502, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/permisos', '2025-05-29 23:17:36'),
(503, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/permisos/delete', '2025-05-29 23:17:37'),
(504, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/permisos', '2025-05-29 23:17:37'),
(505, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/permisos/delete', '2025-05-29 23:17:38'),
(506, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/permisos', '2025-05-29 23:17:38'),
(507, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/permisos/delete', '2025-05-29 23:17:39'),
(508, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/permisos', '2025-05-29 23:17:39'),
(509, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/permisos/delete', '2025-05-29 23:17:40'),
(510, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/permisos', '2025-05-29 23:17:40'),
(511, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/permisos/delete', '2025-05-29 23:17:41'),
(512, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/permisos', '2025-05-29 23:17:41'),
(513, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/permisos/delete', '2025-05-29 23:17:42'),
(514, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/permisos', '2025-05-29 23:17:42'),
(515, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/permisos/delete', '2025-05-29 23:17:44'),
(516, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/permisos', '2025-05-29 23:17:44'),
(517, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/permisos/delete', '2025-05-29 23:17:45'),
(518, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/permisos', '2025-05-29 23:17:45'),
(519, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/permisos/delete', '2025-05-29 23:17:46'),
(520, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/permisos', '2025-05-29 23:17:46'),
(521, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/permisos/delete', '2025-05-29 23:17:47'),
(522, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/permisos', '2025-05-29 23:17:47'),
(523, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/permisos', '2025-05-29 23:17:49'),
(524, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/permisos', '2025-05-29 23:17:50'),
(525, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/submenus', '2025-05-29 23:17:51'),
(526, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/submenus', '2025-05-29 23:17:52'),
(527, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/ordenes', '2025-05-29 23:18:36'),
(528, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/ordenes', '2025-05-29 23:18:36'),
(529, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/ordenes', '2025-05-29 23:19:03'),
(530, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/ordenes', '2025-05-29 23:19:03'),
(531, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/familias', '2025-05-29 23:19:05'),
(532, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/familias', '2025-05-29 23:19:05'),
(533, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies', '2025-05-29 23:19:06'),
(534, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/mariposa-buho.JPG', '2025-05-29 23:19:06'),
(535, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/copper-tail.jpg', '2025-05-29 23:19:06'),
(536, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/clouded-sulphur.jpg', '2025-05-29 23:19:06'),
(537, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/black-hairstreak.jpg', '2025-05-29 23:19:06'),
(538, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/clodius-parnassian.jpg', '2025-05-29 23:19:06'),
(539, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/chestnut.JPG', '2025-05-29 23:19:06'),
(540, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/beckers-white.jpg', '2025-05-29 23:19:06'),
(541, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/papilio-crino.jpg', '2025-05-29 23:19:06'),
(542, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/diaethria-anna.jpg', '2025-05-29 23:19:06'),
(543, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/american-snout.jpg', '2025-05-29 23:19:06'),
(544, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies/mariposa-buho', '2025-05-29 23:19:11'),
(545, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/mariposa-buho.JPG', '2025-05-29 23:19:12'),
(546, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/especies/view', '2025-05-29 23:19:15'),
(547, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/especies/delete', '2025-05-29 23:19:20'),
(548, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies/mariposa-buho', '2025-05-29 23:19:24'),
(549, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies/mariposa-buho', '2025-05-29 23:19:24'),
(550, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/favicon.ico', '2025-05-29 23:19:24'),
(551, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies', '2025-05-29 23:19:27'),
(552, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/clouded-sulphur.jpg', '2025-05-29 23:19:27'),
(553, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/copper-tail.jpg', '2025-05-29 23:19:27'),
(554, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/beckers-white.jpg', '2025-05-29 23:19:27'),
(555, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/chestnut.JPG', '2025-05-29 23:19:27'),
(556, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/black-hairstreak.jpg', '2025-05-29 23:19:27'),
(557, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/clodius-parnassian.jpg', '2025-05-29 23:19:27'),
(558, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/papilio-crino.jpg', '2025-05-29 23:19:27'),
(559, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/diaethria-anna.jpg', '2025-05-29 23:19:27'),
(560, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/adonis-blue.jpg', '2025-05-29 23:19:27'),
(561, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/american-snout.jpg', '2025-05-29 23:19:27'),
(562, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies/copper-tail', '2025-05-29 23:19:29'),
(563, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/copper-tail.jpg', '2025-05-29 23:19:29'),
(564, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/especies/delete', '2025-05-29 23:19:32'),
(565, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/adonis-blue.jpg', '2025-05-29 23:19:37'),
(566, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/clodius-parnassian.jpg', '2025-05-29 23:19:37'),
(567, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/papilio-crino.jpg', '2025-05-29 23:19:37'),
(568, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/black-hairstreak.jpg', '2025-05-29 23:19:37'),
(569, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/beckers-white.jpg', '2025-05-29 23:19:37'),
(570, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/chestnut.JPG', '2025-05-29 23:19:37'),
(571, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/copper-tail.jpg', '2025-05-29 23:19:37'),
(572, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/american-snout.jpg', '2025-05-29 23:19:37'),
(573, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/diaethria-anna.jpg', '2025-05-29 23:19:37'),
(574, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/clouded-sulphur.jpg', '2025-05-29 23:19:37'),
(575, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/copper-tail.jpg', '2025-05-29 23:19:38'),
(576, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/clodius-parnassian.jpg', '2025-05-29 23:19:38'),
(577, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/chestnut.JPG', '2025-05-29 23:19:38'),
(578, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/clouded-sulphur.jpg', '2025-05-29 23:19:38'),
(579, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/black-hairstreak.jpg', '2025-05-29 23:19:38'),
(580, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/beckers-white.jpg', '2025-05-29 23:19:38'),
(581, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/adonis-blue.jpg', '2025-05-29 23:19:38'),
(582, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/papilio-crino.jpg', '2025-05-29 23:19:38'),
(583, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/american-snout.jpg', '2025-05-29 23:19:38'),
(584, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/diaethria-anna.jpg', '2025-05-29 23:19:38'),
(585, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies/copper-tail', '2025-05-29 23:19:39'),
(586, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies/copper-tail', '2025-05-29 23:19:39'),
(587, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/especies', '2025-05-29 23:19:41'),
(588, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/copper-tail.jpg', '2025-05-29 23:19:41'),
(589, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/black-hairstreak.jpg', '2025-05-29 23:19:41'),
(590, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/clouded-sulphur.jpg', '2025-05-29 23:19:41'),
(591, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/clodius-parnassian.jpg', '2025-05-29 23:19:41'),
(592, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/chestnut.JPG', '2025-05-29 23:19:41'),
(593, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/american-snout.jpg', '2025-05-29 23:19:41'),
(594, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/adonis-blue.jpg', '2025-05-29 23:19:42'),
(595, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/diaethria-anna.jpg', '2025-05-29 23:19:42'),
(596, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/beckers-white.jpg', '2025-05-29 23:19:42'),
(597, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/papilio-crino.jpg', '2025-05-29 23:19:42'),
(598, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/vanessa-de-los-cardos.jpg', '2025-05-29 23:19:42'),
(599, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies/clouded-sulphur', '2025-05-29 23:19:43'),
(600, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/clouded-sulphur.jpg', '2025-05-29 23:19:43'),
(601, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/especies/delete', '2025-05-29 23:19:45'),
(602, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies', '2025-05-29 23:19:46'),
(603, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/clodius-parnassian.jpg', '2025-05-29 23:19:46'),
(604, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/beckers-white.jpg', '2025-05-29 23:19:46'),
(605, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/black-hairstreak.jpg', '2025-05-29 23:19:46'),
(606, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/chestnut.JPG', '2025-05-29 23:19:46'),
(607, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/papilio-crino.jpg', '2025-05-29 23:19:46'),
(608, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/diaethria-anna.jpg', '2025-05-29 23:19:46'),
(609, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/vanessa-atalanta.jpg', '2025-05-29 23:19:46'),
(610, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/american-snout.jpg', '2025-05-29 23:19:46'),
(611, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/vanessa-de-los-cardos.jpg', '2025-05-29 23:19:46'),
(612, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/adonis-blue.jpg', '2025-05-29 23:19:46'),
(613, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/especies', '2025-05-29 23:19:47'),
(614, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/black-hairstreak.jpg', '2025-05-29 23:19:47'),
(615, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/chestnut.JPG', '2025-05-29 23:19:47'),
(616, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/clodius-parnassian.jpg', '2025-05-29 23:19:47'),
(617, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/beckers-white.jpg', '2025-05-29 23:19:47'),
(618, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/papilio-crino.jpg', '2025-05-29 23:19:47'),
(619, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/diaethria-anna.jpg', '2025-05-29 23:19:47'),
(620, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/american-snout.jpg', '2025-05-29 23:19:47'),
(621, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/adonis-blue.jpg', '2025-05-29 23:19:47'),
(622, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/vanessa-de-los-cardos.jpg', '2025-05-29 23:19:47'),
(623, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/vanessa-atalanta.jpg', '2025-05-29 23:19:47'),
(624, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies/clodius-parnassian', '2025-05-29 23:19:48'),
(625, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/clodius-parnassian.jpg', '2025-05-29 23:19:48'),
(626, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/especies/delete', '2025-05-29 23:19:51'),
(627, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies', '2025-05-29 23:19:52'),
(628, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/diaethria-anna.jpg', '2025-05-29 23:19:52'),
(629, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/beckers-white.jpg', '2025-05-29 23:19:52'),
(630, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/black-hairstreak.jpg', '2025-05-29 23:19:52'),
(631, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/papilio-crino.jpg', '2025-05-29 23:19:52'),
(632, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/chestnut.JPG', '2025-05-29 23:19:52'),
(633, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/american-snout.jpg', '2025-05-29 23:19:52'),
(634, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/vanessa-atalanta.jpg', '2025-05-29 23:19:52'),
(635, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/adonis-blue.jpg', '2025-05-29 23:19:52'),
(636, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/blanquita-de-la-col.jpg', '2025-05-29 23:19:52'),
(637, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/vanessa-de-los-cardos.jpg', '2025-05-29 23:19:52'),
(638, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/especies', '2025-05-29 23:19:53'),
(639, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/diaethria-anna.jpg', '2025-05-29 23:19:53'),
(640, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/papilio-crino.jpg', '2025-05-29 23:19:53'),
(641, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/chestnut.JPG', '2025-05-29 23:19:53'),
(642, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/beckers-white.jpg', '2025-05-29 23:19:54'),
(643, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/black-hairstreak.jpg', '2025-05-29 23:19:54'),
(644, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/blanquita-de-la-col.jpg', '2025-05-29 23:19:54'),
(645, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/adonis-blue.jpg', '2025-05-29 23:19:54'),
(646, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/american-snout.jpg', '2025-05-29 23:19:54'),
(647, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/vanessa-atalanta.jpg', '2025-05-29 23:19:54'),
(648, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/vanessa-de-los-cardos.jpg', '2025-05-29 23:19:54'),
(649, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies/chestnut', '2025-05-29 23:19:54'),
(650, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/chestnut.JPG', '2025-05-29 23:19:55'),
(651, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/especies/delete', '2025-05-29 23:19:57'),
(652, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies', '2025-05-29 23:19:58'),
(653, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/diaethria-anna.jpg', '2025-05-29 23:19:58'),
(654, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/beckers-white.jpg', '2025-05-29 23:19:58'),
(655, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/adonis-blue.jpg', '2025-05-29 23:19:58'),
(656, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/black-hairstreak.jpg', '2025-05-29 23:19:58'),
(657, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/papilio-crino.jpg', '2025-05-29 23:19:58'),
(658, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/american-snout.jpg', '2025-05-29 23:19:58'),
(659, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/papilio-cresphontes.jpeg', '2025-05-29 23:19:58'),
(660, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/vanessa-de-los-cardos.jpg', '2025-05-29 23:19:58'),
(661, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/blanquita-de-la-col.jpg', '2025-05-29 23:19:59'),
(662, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/vanessa-atalanta.jpg', '2025-05-29 23:19:59'),
(663, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/especies', '2025-05-29 23:20:00'),
(664, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/beckers-white.jpg', '2025-05-29 23:20:00'),
(665, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/black-hairstreak.jpg', '2025-05-29 23:20:00'),
(666, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/papilio-crino.jpg', '2025-05-29 23:20:00'),
(667, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/diaethria-anna.jpg', '2025-05-29 23:20:00'),
(668, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/american-snout.jpg', '2025-05-29 23:20:00'),
(669, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/adonis-blue.jpg', '2025-05-29 23:20:00'),
(670, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/vanessa-atalanta.jpg', '2025-05-29 23:20:00'),
(671, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/vanessa-de-los-cardos.jpg', '2025-05-29 23:20:00'),
(672, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/blanquita-de-la-col.jpg', '2025-05-29 23:20:00'),
(673, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/papilio-cresphontes.jpeg', '2025-05-29 23:20:00'),
(674, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies/black-hairstreak', '2025-05-29 23:20:01'),
(675, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/black-hairstreak.jpg', '2025-05-29 23:20:01'),
(676, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/especies/delete', '2025-05-29 23:20:03'),
(677, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies', '2025-05-29 23:20:04'),
(678, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/american-snout.jpg', '2025-05-29 23:20:04'),
(679, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/papilio-crino.jpg', '2025-05-29 23:20:04'),
(680, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/adonis-blue.jpg', '2025-05-29 23:20:04'),
(681, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/beckers-white.jpg', '2025-05-29 23:20:04'),
(682, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/vanessa-de-los-cardos.jpg', '2025-05-29 23:20:04'),
(683, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/diaethria-anna.jpg', '2025-05-29 23:20:04'),
(684, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/nymphalis-antiopa.jpg', '2025-05-29 23:20:04'),
(685, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/vanessa-atalanta.jpg', '2025-05-29 23:20:04'),
(686, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/blanquita-de-la-col.jpg', '2025-05-29 23:20:04'),
(687, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/papilio-cresphontes.jpeg', '2025-05-29 23:20:04'),
(688, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies/beckers-white', '2025-05-29 23:20:07'),
(689, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/beckers-white.jpg', '2025-05-29 23:20:07'),
(690, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/especies/delete', '2025-05-29 23:20:09'),
(691, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/especies', '2025-05-29 23:20:14'),
(692, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/papilio-crino.jpg', '2025-05-29 23:20:14'),
(693, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/american-snout.jpg', '2025-05-29 23:20:14'),
(694, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/beckers-white.jpg', '2025-05-29 23:20:14'),
(695, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/diaethria-anna.jpg', '2025-05-29 23:20:14'),
(696, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/adonis-blue.jpg', '2025-05-29 23:20:14'),
(697, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/vanessa-atalanta.jpg', '2025-05-29 23:20:14'),
(698, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/blanquita-de-la-col.jpg', '2025-05-29 23:20:14'),
(699, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/nymphalis-antiopa.jpg', '2025-05-29 23:20:14'),
(700, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/vanessa-de-los-cardos.jpg', '2025-05-29 23:20:14'),
(701, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/papilio-cresphontes.jpeg', '2025-05-29 23:20:14'),
(702, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/manto-bicolor.jpg', '2025-05-29 23:20:14'),
(703, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies/papilio-crino', '2025-05-29 23:20:15'),
(704, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/papilio-crino.jpg', '2025-05-29 23:20:15'),
(705, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/especies/delete', '2025-05-29 23:20:17'),
(706, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies', '2025-05-29 23:20:18'),
(707, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/vanessa-atalanta.jpg', '2025-05-29 23:20:19'),
(708, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/diaethria-anna.jpg', '2025-05-29 23:20:19'),
(709, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/american-snout.jpg', '2025-05-29 23:20:19'),
(710, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/vanessa-de-los-cardos.jpg', '2025-05-29 23:20:19'),
(711, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/adonis-blue.jpg', '2025-05-29 23:20:19'),
(712, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/blanquita-de-la-col.jpg', '2025-05-29 23:20:19'),
(713, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/junonia-coenia.png', '2025-05-29 23:20:19'),
(714, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/manto-bicolor.jpg', '2025-05-29 23:20:19'),
(715, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/nymphalis-antiopa.jpg', '2025-05-29 23:20:19'),
(716, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/papilio-cresphontes.jpeg', '2025-05-29 23:20:19'),
(717, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies/diaethria-anna', '2025-05-29 23:20:20'),
(718, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/diaethria-anna.jpg', '2025-05-29 23:20:21'),
(719, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/especies/delete', '2025-05-29 23:20:23'),
(720, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies/diaethria-anna', '2025-05-29 23:20:26'),
(721, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies/diaethria-anna', '2025-05-29 23:20:26'),
(722, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies/american-snout', '2025-05-29 23:20:29'),
(723, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/american-snout.jpg', '2025-05-29 23:20:29'),
(724, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/especies/delete', '2025-05-29 23:20:31'),
(725, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/especies', '2025-05-29 23:20:34'),
(726, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/adonis-blue.jpg', '2025-05-29 23:20:34'),
(727, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/american-snout.jpg', '2025-05-29 23:20:34'),
(728, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/vanessa-de-los-cardos.jpg', '2025-05-29 23:20:34'),
(729, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/vanessa-atalanta.jpg', '2025-05-29 23:20:34'),
(730, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/diaethria-anna.jpg', '2025-05-29 23:20:34'),
(731, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/papilio-cresphontes.jpeg', '2025-05-29 23:20:34'),
(732, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/blanquita-de-la-col.jpg', '2025-05-29 23:20:34');
INSERT INTO `sis_centinela` (`idvisita`, `vis_cod`, `idwebusuario`, `vis_ip`, `vis_agente`, `vis_method`, `vis_url`, `vis_fechahora`) VALUES
(733, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/nymphalis-antiopa.jpg', '2025-05-29 23:20:34'),
(734, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/manto-bicolor.jpg', '2025-05-29 23:20:34'),
(735, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/junonia-coenia.png', '2025-05-29 23:20:34'),
(736, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/mariposa-alas-de-cebra.jpg', '2025-05-29 23:20:34'),
(737, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/heliconius-erato.jpg', '2025-05-29 23:20:34'),
(738, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies/adonis-blue', '2025-05-29 23:20:35'),
(739, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/adonis-blue.jpg', '2025-05-29 23:20:35'),
(740, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/especies/delete', '2025-05-29 23:20:38'),
(741, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies', '2025-05-29 23:20:39'),
(742, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/vanessa-de-los-cardos.jpg', '2025-05-29 23:20:39'),
(743, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/manto-bicolor.jpg', '2025-05-29 23:20:39'),
(744, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/papilio-cresphontes.jpeg', '2025-05-29 23:20:39'),
(745, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/blanquita-de-la-col.jpg', '2025-05-29 23:20:39'),
(746, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/vanessa-atalanta.jpg', '2025-05-29 23:20:39'),
(747, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/nymphalis-antiopa.jpg', '2025-05-29 23:20:39'),
(748, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/heliconius-erato.jpg', '2025-05-29 23:20:39'),
(749, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/junonia-coenia.png', '2025-05-29 23:20:39'),
(750, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/mariposa-alas-de-cebra.jpg', '2025-05-29 23:20:39'),
(751, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/mariposa-monarca.jpg', '2025-05-29 23:20:39'),
(752, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/especies', '2025-05-29 23:20:40'),
(753, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/vanessa-de-los-cardos.jpg', '2025-05-29 23:20:40'),
(754, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/vanessa-atalanta.jpg', '2025-05-29 23:20:40'),
(755, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/blanquita-de-la-col.jpg', '2025-05-29 23:20:40'),
(756, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/papilio-cresphontes.jpeg', '2025-05-29 23:20:40'),
(757, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/nymphalis-antiopa.jpg', '2025-05-29 23:20:40'),
(758, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/heliconius-erato.jpg', '2025-05-29 23:20:40'),
(759, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/manto-bicolor.jpg', '2025-05-29 23:20:40'),
(760, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/mariposa-alas-de-cebra.jpg', '2025-05-29 23:20:40'),
(761, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/mariposa-monarca.jpg', '2025-05-29 23:20:40'),
(762, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/junonia-coenia.png', '2025-05-29 23:20:40'),
(763, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies/vanessa-de-los-cardos', '2025-05-29 23:20:52'),
(764, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/vanessa-de-los-cardos.jpg', '2025-05-29 23:20:53'),
(765, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/especies/delete', '2025-05-29 23:20:55'),
(766, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies', '2025-05-29 23:20:56'),
(767, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/vanessa-atalanta.jpg', '2025-05-29 23:20:57'),
(768, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/nymphalis-antiopa.jpg', '2025-05-29 23:20:57'),
(769, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/blanquita-de-la-col.jpg', '2025-05-29 23:20:57'),
(770, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/manto-bicolor.jpg', '2025-05-29 23:20:57'),
(771, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/junonia-coenia.png', '2025-05-29 23:20:57'),
(772, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/papilio-cresphontes.jpeg', '2025-05-29 23:20:57'),
(773, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/mariposa-monarca.jpg', '2025-05-29 23:20:57'),
(774, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/heliconius-erato.jpg', '2025-05-29 23:20:57'),
(775, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/mariposa-alas-de-cebra.jpg', '2025-05-29 23:20:57'),
(776, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies/vanessa-atalanta', '2025-05-29 23:20:58'),
(777, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/vanessa-atalanta.jpg', '2025-05-29 23:20:59'),
(778, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/especies/delete', '2025-05-29 23:21:01'),
(779, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies/blanquita-de-la-col', '2025-05-29 23:21:03'),
(780, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/blanquita-de-la-col.jpg', '2025-05-29 23:21:04'),
(781, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/especies/delete', '2025-05-29 23:21:06'),
(782, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies/papilio-cresphontes', '2025-05-29 23:21:09'),
(783, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/papilio-cresphontes.jpeg', '2025-05-29 23:21:09'),
(784, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/especies/delete', '2025-05-29 23:21:11'),
(785, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/especies', '2025-05-29 23:21:14'),
(786, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/vanessa-atalanta.jpg', '2025-05-29 23:21:14'),
(787, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/papilio-cresphontes.jpeg', '2025-05-29 23:21:14'),
(788, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/manto-bicolor.jpg', '2025-05-29 23:21:14'),
(789, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/nymphalis-antiopa.jpg', '2025-05-29 23:21:14'),
(790, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/blanquita-de-la-col.jpg', '2025-05-29 23:21:14'),
(791, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/mariposa-alas-de-cebra.jpg', '2025-05-29 23:21:14'),
(792, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/heliconius-erato.jpg', '2025-05-29 23:21:14'),
(793, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/mariposa-monarca.jpg', '2025-05-29 23:21:14'),
(794, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/junonia-coenia.png', '2025-05-29 23:21:14'),
(795, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies/nymphalis-antiopa', '2025-05-29 23:21:15'),
(796, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/nymphalis-antiopa.jpg', '2025-05-29 23:21:15'),
(797, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/especies/delete', '2025-05-29 23:21:18'),
(798, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies', '2025-05-29 23:21:19'),
(799, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/junonia-coenia.png', '2025-05-29 23:21:19'),
(800, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/manto-bicolor.jpg', '2025-05-29 23:21:19'),
(801, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/heliconius-erato.jpg', '2025-05-29 23:21:19'),
(802, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/mariposa-alas-de-cebra.jpg', '2025-05-29 23:21:19'),
(803, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/mariposa-monarca.jpg', '2025-05-29 23:21:19'),
(804, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/especies', '2025-05-29 23:21:21'),
(805, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/manto-bicolor.jpg', '2025-05-29 23:21:21'),
(806, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/mariposa-alas-de-cebra.jpg', '2025-05-29 23:21:21'),
(807, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/heliconius-erato.jpg', '2025-05-29 23:21:21'),
(808, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/mariposa-monarca.jpg', '2025-05-29 23:21:21'),
(809, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/junonia-coenia.png', '2025-05-29 23:21:21'),
(810, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies/manto-bicolor', '2025-05-29 23:21:22'),
(811, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/manto-bicolor.jpg', '2025-05-29 23:21:22'),
(812, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/especies/delete', '2025-05-29 23:21:24'),
(813, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies', '2025-05-29 23:21:25'),
(814, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/heliconius-erato.jpg', '2025-05-29 23:21:26'),
(815, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/junonia-coenia.png', '2025-05-29 23:21:26'),
(816, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/mariposa-alas-de-cebra.jpg', '2025-05-29 23:21:26'),
(817, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/mariposa-monarca.jpg', '2025-05-29 23:21:26'),
(818, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/especies', '2025-05-29 23:21:28'),
(819, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/junonia-coenia.png', '2025-05-29 23:21:28'),
(820, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/mariposa-alas-de-cebra.jpg', '2025-05-29 23:21:28'),
(821, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/heliconius-erato.jpg', '2025-05-29 23:21:28'),
(822, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/mariposa-monarca.jpg', '2025-05-29 23:21:28'),
(823, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies/junonia-coenia', '2025-05-29 23:21:29'),
(824, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/junonia-coenia.png', '2025-05-29 23:21:29'),
(825, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/especies/delete', '2025-05-29 23:21:32'),
(826, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies', '2025-05-29 23:21:33'),
(827, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/heliconius-erato.jpg', '2025-05-29 23:21:33'),
(828, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/mariposa-monarca.jpg', '2025-05-29 23:21:33'),
(829, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/mariposa-alas-de-cebra.jpg', '2025-05-29 23:21:33'),
(830, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/especies', '2025-05-29 23:21:35'),
(831, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/heliconius-erato.jpg', '2025-05-29 23:21:35'),
(832, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/mariposa-alas-de-cebra.jpg', '2025-05-29 23:21:35'),
(833, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/mariposa-monarca.jpg', '2025-05-29 23:21:35'),
(834, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies/heliconius-erato', '2025-05-29 23:21:35'),
(835, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/heliconius-erato.jpg', '2025-05-29 23:21:35'),
(836, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/especies/delete', '2025-05-29 23:21:42'),
(837, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies', '2025-05-29 23:21:43'),
(838, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/mariposa-alas-de-cebra.jpg', '2025-05-29 23:21:43'),
(839, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/mariposa-monarca.jpg', '2025-05-29 23:21:43'),
(840, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies/mariposa-alas-de-cebra', '2025-05-29 23:21:45'),
(841, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/mariposa-alas-de-cebra.jpg', '2025-05-29 23:21:46'),
(842, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/especies/delete', '2025-05-29 23:21:48'),
(843, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies/mariposa-monarca', '2025-05-29 23:21:50'),
(844, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/mariposa-monarca.jpg', '2025-05-29 23:21:50'),
(845, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/especies/delete', '2025-05-29 23:21:52'),
(846, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/especies', '2025-05-29 23:21:55'),
(847, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/mariposa-monarca.jpg', '2025-05-29 23:21:55'),
(848, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/especies/mariposa-alas-de-cebra.jpg', '2025-05-29 23:21:55'),
(849, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/generos', '2025-05-29 23:21:56'),
(850, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/generos', '2025-05-29 23:21:57'),
(851, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/generos/delete', '2025-05-29 23:22:01'),
(852, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies', '2025-05-29 23:22:05'),
(853, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies', '2025-05-29 23:23:49'),
(854, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/historial', '2025-05-29 23:23:58'),
(855, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/predicciones/696901851972608.jpg', '2025-05-29 23:23:58'),
(856, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/predicciones/696871854326784.jpg', '2025-05-29 23:23:58'),
(857, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/predicciones/448344066360320.jpg', '2025-05-29 23:23:58'),
(858, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/historial', '2025-05-29 23:24:20'),
(859, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/.well-known/appspecific/com.chrome.devtools.json', '2025-05-29 23:24:27'),
(860, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/popper.min.js.map', '2025-05-29 23:24:28'),
(861, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/dropzone-min.js.map', '2025-05-29 23:24:28'),
(862, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/css/app/plugins/dropzone.css.map', '2025-05-29 23:24:28'),
(863, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/historial', '2025-05-29 23:24:34'),
(864, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/.well-known/appspecific/com.chrome.devtools.json', '2025-05-29 23:24:34'),
(865, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/css/app/plugins/dropzone.css.map', '2025-05-29 23:24:35'),
(866, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/popper.min.js.map', '2025-05-29 23:24:35'),
(867, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/dropzone-min.js.map', '2025-05-29 23:24:35'),
(868, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/entrenamiento', '2025-05-29 23:25:40'),
(869, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/.well-known/appspecific/com.chrome.devtools.json', '2025-05-29 23:25:40'),
(870, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/entrenamiento', '2025-05-29 23:25:43'),
(871, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/.well-known/appspecific/com.chrome.devtools.json', '2025-05-29 23:25:43'),
(872, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/popper.min.js.map', '2025-05-29 23:25:45'),
(873, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/dropzone-min.js.map', '2025-05-29 23:25:45'),
(874, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/css/app/plugins/dropzone.css.map', '2025-05-29 23:25:45'),
(875, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/.well-known/appspecific/com.chrome.devtools.json', '2025-05-29 23:25:45'),
(876, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/css/app/plugins/dropzone.css.map', '2025-05-29 23:25:45'),
(877, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/.well-known/appspecific/com.chrome.devtools.json', '2025-05-29 23:25:45'),
(878, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/historial', '2025-05-29 23:25:46'),
(879, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/.well-known/appspecific/com.chrome.devtools.json', '2025-05-29 23:25:46'),
(880, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/css/app/plugins/dropzone.css.map', '2025-05-29 23:25:46'),
(881, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/popper.min.js.map', '2025-05-29 23:25:46'),
(882, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/dropzone-min.js.map', '2025-05-29 23:25:46'),
(883, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/entrenamiento', '2025-05-29 23:25:49'),
(884, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/.well-known/appspecific/com.chrome.devtools.json', '2025-05-29 23:25:49'),
(885, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/entrenamiento', '2025-05-29 23:26:13'),
(886, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/.well-known/appspecific/com.chrome.devtools.json', '2025-05-29 23:26:13'),
(887, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/entrenamiento', '2025-05-29 23:26:15'),
(888, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/.well-known/appspecific/com.chrome.devtools.json', '2025-05-29 23:26:15'),
(889, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/entrenamiento', '2025-05-29 23:26:15'),
(890, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/.well-known/appspecific/com.chrome.devtools.json', '2025-05-29 23:26:15'),
(891, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/entrenamiento', '2025-05-29 23:27:29'),
(892, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/.well-known/appspecific/com.chrome.devtools.json', '2025-05-29 23:27:30'),
(893, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/css/app/plugins/dropzone.css.map', '2025-05-29 23:27:30'),
(894, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/popper.min.js.map', '2025-05-29 23:27:30'),
(895, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/dropzone-min.js.map', '2025-05-29 23:27:30'),
(896, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/entrenamiento/especies', '2025-05-29 23:27:38'),
(897, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/historial', '2025-05-29 23:27:41'),
(898, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/.well-known/appspecific/com.chrome.devtools.json', '2025-05-29 23:27:41'),
(899, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/css/app/plugins/dropzone.css.map', '2025-05-29 23:27:41'),
(900, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/popper.min.js.map', '2025-05-29 23:27:41'),
(901, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/dropzone-min.js.map', '2025-05-29 23:27:41'),
(902, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/entrenamiento', '2025-05-29 23:27:42'),
(903, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/.well-known/appspecific/com.chrome.devtools.json', '2025-05-29 23:27:43'),
(904, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/css/app/plugins/dropzone.css.map', '2025-05-29 23:27:43'),
(905, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/popper.min.js.map', '2025-05-29 23:27:43'),
(906, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/dropzone-min.js.map', '2025-05-29 23:27:43'),
(907, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/modelo', '2025-05-29 23:27:44'),
(908, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/.well-known/appspecific/com.chrome.devtools.json', '2025-05-29 23:27:44'),
(909, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/css/app/plugins/dropzone.css.map', '2025-05-29 23:27:44'),
(910, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/popper.min.js.map', '2025-05-29 23:27:44'),
(911, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/dropzone-min.js.map', '2025-05-29 23:27:44'),
(912, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/modelo/datos-de-entrenamiento', '2025-05-29 23:27:44'),
(913, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/modelo', '2025-05-29 23:27:44'),
(914, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/ia', '2025-05-29 23:27:52'),
(915, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/.well-known/appspecific/com.chrome.devtools.json', '2025-05-29 23:27:52'),
(916, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/css/app/plugins/dropzone.css.map', '2025-05-29 23:27:52'),
(917, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/popper.min.js.map', '2025-05-29 23:27:52'),
(918, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/dropzone-min.js.map', '2025-05-29 23:27:52'),
(919, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/ia', '2025-05-29 23:28:33'),
(920, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/.well-known/appspecific/com.chrome.devtools.json', '2025-05-29 23:28:33'),
(921, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/css/app/plugins/dropzone.css.map', '2025-05-29 23:28:33'),
(922, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/popper.min.js.map', '2025-05-29 23:28:33'),
(923, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/dropzone-min.js.map', '2025-05-29 23:28:33'),
(924, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/ordenes', '2025-05-29 23:28:36'),
(925, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/.well-known/appspecific/com.chrome.devtools.json', '2025-05-29 23:28:36'),
(926, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/css/app/plugins/dropzone.css.map', '2025-05-29 23:28:36'),
(927, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/popper.min.js.map', '2025-05-29 23:28:36'),
(928, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/dropzone-min.js.map', '2025-05-29 23:28:37'),
(929, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/ordenes', '2025-05-29 23:28:37'),
(930, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/especies', '2025-05-29 23:28:38'),
(931, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/.well-known/appspecific/com.chrome.devtools.json', '2025-05-29 23:28:38'),
(932, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/css/app/plugins/dropzone.css.map', '2025-05-29 23:28:38'),
(933, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/popper.min.js.map', '2025-05-29 23:28:38'),
(934, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/dropzone-min.js.map', '2025-05-29 23:28:39'),
(935, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/generos', '2025-05-29 23:28:40'),
(936, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/.well-known/appspecific/com.chrome.devtools.json', '2025-05-29 23:28:40'),
(937, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/css/app/plugins/dropzone.css.map', '2025-05-29 23:28:40'),
(938, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/popper.min.js.map', '2025-05-29 23:28:40'),
(939, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/dropzone-min.js.map', '2025-05-29 23:28:40'),
(940, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/generos', '2025-05-29 23:28:40'),
(941, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/subfamilias', '2025-05-29 23:28:41'),
(942, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/.well-known/appspecific/com.chrome.devtools.json', '2025-05-29 23:28:41'),
(943, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/css/app/plugins/dropzone.css.map', '2025-05-29 23:28:42'),
(944, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/popper.min.js.map', '2025-05-29 23:28:42'),
(945, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/dropzone-min.js.map', '2025-05-29 23:28:42'),
(946, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/subfamilias', '2025-05-29 23:28:42'),
(947, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/familias', '2025-05-29 23:28:42'),
(948, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/.well-known/appspecific/com.chrome.devtools.json', '2025-05-29 23:28:43'),
(949, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/css/app/plugins/dropzone.css.map', '2025-05-29 23:28:43'),
(950, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/popper.min.js.map', '2025-05-29 23:28:43'),
(951, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/dropzone-min.js.map', '2025-05-29 23:28:43'),
(952, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/familias', '2025-05-29 23:28:43'),
(953, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/menus', '2025-05-29 23:29:42'),
(954, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/.well-known/appspecific/com.chrome.devtools.json', '2025-05-29 23:29:42'),
(955, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/css/app/plugins/dropzone.css.map', '2025-05-29 23:29:42'),
(956, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/popper.min.js.map', '2025-05-29 23:29:42'),
(957, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/dropzone-min.js.map', '2025-05-29 23:29:42'),
(958, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/menus', '2025-05-29 23:29:43'),
(959, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/menus/search', '2025-05-29 23:29:47'),
(960, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/menus/update', '2025-05-29 23:29:54'),
(961, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/menus', '2025-05-29 23:29:54'),
(962, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/menus', '2025-05-29 23:29:56'),
(963, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/.well-known/appspecific/com.chrome.devtools.json', '2025-05-29 23:29:56'),
(964, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/css/app/plugins/dropzone.css.map', '2025-05-29 23:29:56'),
(965, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/popper.min.js.map', '2025-05-29 23:29:56'),
(966, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/dropzone-min.js.map', '2025-05-29 23:29:56'),
(967, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/menus', '2025-05-29 23:29:57'),
(968, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/menus', '2025-05-29 23:30:08'),
(969, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/menus', '2025-05-29 23:30:08'),
(970, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/permisos', '2025-05-29 23:30:11'),
(971, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/permisos', '2025-05-29 23:30:12'),
(972, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/permisos/submenus', '2025-05-29 23:30:17'),
(973, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/permisos/roles', '2025-05-29 23:30:17'),
(974, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/menus', '2025-05-29 23:30:28');
INSERT INTO `sis_centinela` (`idvisita`, `vis_cod`, `idwebusuario`, `vis_ip`, `vis_agente`, `vis_method`, `vis_url`, `vis_fechahora`) VALUES
(975, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/menus', '2025-05-29 23:30:28'),
(976, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/menus/search', '2025-05-29 23:30:32'),
(977, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/submenus', '2025-05-29 23:30:37'),
(978, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/submenus', '2025-05-29 23:30:37'),
(979, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/menus', '2025-05-29 23:30:44'),
(980, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/menus', '2025-05-29 23:30:44'),
(981, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/menus/delete', '2025-05-29 23:30:47'),
(982, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/menus', '2025-05-29 23:30:47'),
(983, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/sistem', '2025-05-29 23:30:49'),
(984, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/sistem', '2025-05-29 23:30:49'),
(985, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/sistem/search', '2025-05-29 23:30:52'),
(986, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/reportes', '2025-05-29 23:31:20'),
(987, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/person', '2025-05-29 23:31:22'),
(988, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/person', '2025-05-29 23:31:23'),
(989, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/user', '2025-05-29 23:31:26'),
(990, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/user/roles', '2025-05-29 23:31:26'),
(991, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/user/person', '2025-05-29 23:31:26'),
(992, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/user', '2025-05-29 23:31:26'),
(993, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/rol', '2025-05-29 23:31:28'),
(994, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/rol', '2025-05-29 23:31:28'),
(995, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/permisos', '2025-05-29 23:31:33'),
(996, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/permisos', '2025-05-29 23:31:33'),
(997, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/user', '2025-05-29 23:31:38'),
(998, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/user/person', '2025-05-29 23:31:38'),
(999, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/user/roles', '2025-05-29 23:31:38'),
(1000, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/user', '2025-05-29 23:31:38'),
(1001, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/user/delete', '2025-05-29 23:31:42'),
(1002, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/user', '2025-05-29 23:31:42'),
(1003, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/user/delete', '2025-05-29 23:31:45'),
(1004, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/user', '2025-05-29 23:31:45'),
(1005, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/user/delete', '2025-05-29 23:31:47'),
(1006, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/user', '2025-05-29 23:31:48'),
(1007, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/user', '2025-05-29 23:31:49'),
(1008, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/user/roles', '2025-05-29 23:31:49'),
(1009, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/user/person', '2025-05-29 23:31:49'),
(1010, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/user', '2025-05-29 23:31:49'),
(1011, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/person', '2025-05-29 23:32:04'),
(1012, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/person', '2025-05-29 23:32:04'),
(1013, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/person/delete', '2025-05-29 23:32:08'),
(1014, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/user', '2025-05-29 23:32:12'),
(1015, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/user/person', '2025-05-29 23:32:13'),
(1016, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/user/roles', '2025-05-29 23:32:13'),
(1017, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/user', '2025-05-29 23:32:13'),
(1018, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/person', '2025-05-29 23:32:14'),
(1019, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/person', '2025-05-29 23:32:14'),
(1020, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/person/delete', '2025-05-29 23:32:24'),
(1021, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/person', '2025-05-29 23:32:40'),
(1022, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/person', '2025-05-29 23:32:40'),
(1023, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/user', '2025-05-29 23:32:41'),
(1024, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/user/roles', '2025-05-29 23:32:42'),
(1025, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/user/person', '2025-05-29 23:32:42'),
(1026, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/user', '2025-05-29 23:32:42'),
(1027, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/rol', '2025-05-29 23:32:43'),
(1028, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/rol', '2025-05-29 23:32:44'),
(1029, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/rol', '2025-05-29 23:32:54'),
(1030, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/rol', '2025-05-29 23:32:55'),
(1031, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/entrenamiento', '2025-05-29 23:32:58'),
(1032, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/modelo', '2025-05-29 23:32:59'),
(1033, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/modelo/datos-de-entrenamiento', '2025-05-29 23:32:59'),
(1034, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'POST', '/admin/modelo', '2025-05-29 23:32:59'),
(1035, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/entrenamiento', '2025-05-29 23:33:01'),
(1036, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin', '2025-05-29 23:34:39'),
(1037, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin', '2025-05-29 23:36:44'),
(1038, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin', '2025-05-29 23:36:46'),
(1039, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/person/leenh-alexander-bustamante-fernandez.jpg', '2025-05-29 23:37:10'),
(1040, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/favicon.ico', '2025-05-29 23:37:11'),
(1041, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin', '2025-05-29 23:37:12'),
(1042, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/img/person/leenh-alexander-bustamante-fernandez.jpg', '2025-05-29 23:37:12'),
(1043, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/.well-known/appspecific/com.chrome.devtools.json', '2025-05-29 23:38:59'),
(1044, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/popper.min.js.map', '2025-05-29 23:38:59'),
(1045, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/dropzone-min.js.map', '2025-05-29 23:38:59'),
(1046, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/css/app/plugins/dropzone.css.map', '2025-05-29 23:38:59'),
(1047, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin', '2025-05-29 23:41:09'),
(1048, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/.well-known/appspecific/com.chrome.devtools.json', '2025-05-29 23:41:10'),
(1049, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/css/app/plugins/dropzone.css.map', '2025-05-29 23:41:10'),
(1050, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/popper.min.js.map', '2025-05-29 23:41:10'),
(1051, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/dropzone-min.js.map', '2025-05-29 23:41:10'),
(1052, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin', '2025-05-29 23:41:22'),
(1053, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/.well-known/appspecific/com.chrome.devtools.json', '2025-05-29 23:41:23'),
(1054, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/popper.min.js.map', '2025-05-29 23:41:23'),
(1055, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/css/app/plugins/dropzone.css.map', '2025-05-29 23:41:23'),
(1056, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/dropzone-min.js.map', '2025-05-29 23:41:23'),
(1057, 1790, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/logout', '2025-05-29 23:41:29'),
(1058, 3383, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/login', '2025-05-29 23:41:29'),
(1059, 3383, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/.well-known/appspecific/com.chrome.devtools.json', '2025-05-29 23:41:29'),
(1060, 3383, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/js/app/plugins/popper.min.js.map', '2025-05-29 23:41:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sis_imagenes`
--

CREATE TABLE `sis_imagenes` (
  `idimagen` int NOT NULL,
  `idgalery` varchar(10) NOT NULL DEFAULT '0',
  `img_externo` int NOT NULL DEFAULT '0',
  `img_url` varchar(200) DEFAULT NULL,
  `img_propietario` int NOT NULL DEFAULT '0',
  `img_type` varchar(45) NOT NULL,
  `img_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sis_menus`
--

CREATE TABLE `sis_menus` (
  `idmenu` int NOT NULL,
  `men_nombre` varchar(20) NOT NULL,
  `men_url` varchar(100) NOT NULL,
  `men_controlador` varchar(15) DEFAULT NULL,
  `men_icono` varchar(20) NOT NULL,
  `men_url_si` tinyint(1) NOT NULL DEFAULT '0',
  `men_orden` int DEFAULT NULL,
  `men_visible` tinyint(1) NOT NULL DEFAULT '1',
  `men_fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `sis_menus`
--

INSERT INTO `sis_menus` (`idmenu`, `men_nombre`, `men_url`, `men_controlador`, `men_icono`, `men_url_si`, `men_orden`, `men_visible`, `men_fecha`) VALUES
(1, 'Maestras', '#', NULL, 'bx-lock-open-alt', 0, 10, 1, '2023-03-06 12:39:09'),
(2, 'Usuarios', '#', NULL, 'bx-user-circle', 0, 5, 1, '2023-03-07 00:41:34'),
(13, 'Modelo', '#', NULL, 'bxl-codepen', 0, 1, 1, '2023-04-13 16:52:29'),
(16, 'Plantas', '#', NULL, 'bx-library', 0, 4, 1, '2023-04-21 17:32:38'),
(18, 'Reportes', '#', NULL, 'bxs-report', 0, 6, 1, '2023-06-08 20:14:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sis_permisos`
--

CREATE TABLE `sis_permisos` (
  `idpermisos` int NOT NULL,
  `idrol` int NOT NULL,
  `idsubmenu` int NOT NULL,
  `perm_r` int DEFAULT NULL,
  `perm_w` int DEFAULT NULL,
  `perm_u` int DEFAULT NULL,
  `perm_d` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `sis_permisos`
--

INSERT INTO `sis_permisos` (`idpermisos`, `idrol`, `idsubmenu`, `perm_r`, `perm_w`, `perm_u`, `perm_d`) VALUES
(3, 1, 2, 1, 1, 1, 1),
(4, 1, 3, 1, 1, 1, 1),
(5, 1, 1, 1, 1, 1, 1),
(6, 1, 4, 1, 1, 1, 1),
(7, 1, 7, 1, 1, 1, 1),
(8, 1, 8, 1, 1, 1, 1),
(20, 1, 19, 1, 1, 1, 1),
(22, 1, 21, 1, 1, 1, 1),
(24, 1, 23, 1, 1, 1, 1),
(35, 1, 34, 1, 1, 1, 1),
(36, 1, 35, 1, 1, 1, 1),
(37, 1, 36, 1, 1, 1, 1),
(38, 1, 37, 1, 1, 1, 1),
(39, 1, 38, 1, 1, 1, 1),
(40, 1, 39, 1, 1, 1, 1),
(41, 1, 40, 1, 1, 1, 1),
(42, 1, 41, 1, 1, 1, 1),
(43, 1, 42, 1, 1, 1, 1),
(44, 1, 43, 1, 1, 1, 1),
(45, 1, 44, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sis_personal`
--

CREATE TABLE `sis_personal` (
  `idpersona` int NOT NULL,
  `per_dni` int NOT NULL,
  `per_nombre` varchar(200) NOT NULL,
  `per_celular` int NOT NULL,
  `per_email` varchar(255) DEFAULT NULL,
  `per_direcc` varchar(200) NOT NULL,
  `per_estado` tinyint(1) NOT NULL DEFAULT '1',
  `per_fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `sis_personal`
--

INSERT INTO `sis_personal` (`idpersona`, `per_dni`, `per_nombre`, `per_celular`, `per_email`, `per_direcc`, `per_estado`, `per_fecha`) VALUES
(1, 76144152, 'Developer', 942949927, 'hackingleenh@gmail.com', 'Jr San Martin Cdr 3 Mz 55 Lt 55 Ur Nueva Cajamarca Et.1.', 1, '2022-07-22 01:09:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sis_rol`
--

CREATE TABLE `sis_rol` (
  `idrol` int NOT NULL,
  `rol_cod` varchar(10) DEFAULT NULL,
  `rol_nombre` varchar(255) NOT NULL,
  `rol_descripcion` varchar(255) DEFAULT NULL,
  `rol_estado` tinyint(1) NOT NULL DEFAULT '0',
  `rol_fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `sis_rol`
--

INSERT INTO `sis_rol` (`idrol`, `rol_cod`, `rol_nombre`, `rol_descripcion`, `rol_estado`, `rol_fecha`) VALUES
(1, '/', 'root', NULL, 1, '2022-07-22 01:09:56'),
(2, 'admin', 'admin', 'administrador del sistema', 1, '2022-07-28 00:20:50'),
(4, 'web', 'Usuario Web', '', 1, '2023-03-08 13:22:56'),
(5, 'user', 'Usuario Panel', '', 1, '2023-03-08 13:23:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sis_server_email`
--

CREATE TABLE `sis_server_email` (
  `idserveremail` int NOT NULL,
  `em_host` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `em_usermail` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `em_pass` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `em_port` int NOT NULL,
  `em_estado` tinyint(1) NOT NULL DEFAULT '1',
  `em_default` tinyint(1) DEFAULT NULL,
  `em_fupdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `em_fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `sis_server_email`
--

INSERT INTO `sis_server_email` (`idserveremail`, `em_host`, `em_usermail`, `em_pass`, `em_port`, `em_estado`, `em_default`, `em_fupdate`, `em_fecha`) VALUES
(1, 'mail.leenhcraft.com', 'servicios@leenhcraft.com', 'DJ-leenh-#1', 465, 1, 1, '2022-05-06 22:29:56', '2022-03-19 23:12:56'),
(2, 'smtp.gmail.com', '2018100486facke@gmail.com', 'bteaasmagqeaiyax', 465, 1, 0, '2022-03-19 23:25:14', '2022-03-19 23:25:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sis_submenus`
--

CREATE TABLE `sis_submenus` (
  `idsubmenu` int NOT NULL,
  `idmenu` int NOT NULL,
  `sub_nombre` varchar(200) NOT NULL,
  `sub_url` varchar(100) NOT NULL,
  `sub_controlador` varchar(50) DEFAULT NULL,
  `sub_metodo` varchar(200) DEFAULT 'index',
  `sub_icono` varchar(20) DEFAULT NULL,
  `sub_orden` int DEFAULT NULL,
  `sub_visible` tinyint(1) NOT NULL DEFAULT '1',
  `sub_fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `sis_submenus`
--

INSERT INTO `sis_submenus` (`idsubmenu`, `idmenu`, `sub_nombre`, `sub_url`, `sub_controlador`, `sub_metodo`, `sub_icono`, `sub_orden`, `sub_visible`, `sub_fecha`) VALUES
(1, 1, 'Menú', '/admin/menus', 'MenusController', 'index', 'bx-menu', 1, 1, '2023-03-06 12:41:05'),
(2, 1, 'Submenús', '/admin/submenus', 'SubmenusController', 'index', 'bx-menu-alt-right', 2, 1, '2023-03-06 12:41:44'),
(3, 1, 'Permisos', '/admin/permisos', 'PermisosController', 'index', 'bx-key', 3, 1, '2023-03-06 12:42:10'),
(4, 2, 'Usuarios', '/admin/user', 'UserController', 'index', 'bx bx-user-circle', 2, 1, '2023-03-07 00:43:11'),
(7, 2, 'Personal', '/admin/person', 'PersonController', 'index', 'bx bxs-user-circle', 1, 1, '2023-03-07 19:44:33'),
(8, 2, 'Roles', '/admin/rol', 'RolController', 'index', 'bx-ruler', 4, 1, '2023-03-07 19:44:54'),
(19, 1, 'Database', '/admin/database', 'DataBaseController', 'index', 'bx bx-data', 6, 1, '2023-03-24 09:13:38'),
(20, 2, 'Usuario web', '#', '#', '#', 'bx bxs-user-account', 3, 1, '2023-03-25 00:34:30'),
(21, 13, 'Identificar', '/admin/ia', 'IaController', 'index', 'bx-circle', 1, 1, '2023-04-13 16:57:52'),
(23, 13, 'Entrenar modelo', '/admin/modelo', 'EntrenarController', 'index', 'bx-circle', 2, 1, '2023-04-13 16:58:21'),
(34, 1, 'Crud', '/admin/crud', 'CrudController', 'index', 'bx-edit', 7, 1, '2023-04-17 11:41:50'),
(35, 16, 'Subfamilias', '/admin/subfamilias', 'SubfamiliasController', 'index', 'bx-circle', 3, 1, '2023-04-21 17:33:09'),
(36, 16, 'Familias', '/admin/familias', 'FamiliasController', 'index', 'bx-circle', 2, 1, '2023-04-21 17:40:14'),
(37, 16, 'Generos', '/admin/generos', 'GenerosController', 'index', 'bx-circle', 4, 1, '2023-04-21 17:41:30'),
(38, 16, 'Ordenes', '/admin/ordenes', 'OrdenesController', 'index', 'bx-circle', 1, 1, '2023-04-21 17:44:27'),
(39, 16, 'Especies', '/admin/especies', 'EspeciesController', 'index', 'bx-circle', 6, 1, '2023-04-21 18:06:00'),
(40, 1, 'Centinela', '/admin/centinela', 'CentinelaController', 'index', 'bx-desktop', 5, 1, '2023-04-24 09:20:07'),
(41, 13, 'Generar Datos', '/admin/entrenamiento', 'ModeloController', 'index', 'bx-circle', 4, 1, '2023-05-19 16:05:52'),
(42, 1, 'Configuracion', '/admin/sistem', 'ConfiguracionController', 'index', 'bx-circle', 4, 1, '2023-05-24 00:22:36'),
(43, 13, 'Historial ID', '/admin/historial', 'HistorialController', 'index', 'bx-circle', 8, 1, '2023-06-07 14:08:12'),
(44, 18, 'Historial', '/admin/reportes', 'ReportesController', 'index', 'bx-circle', 1, 1, '2023-06-08 20:15:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sis_tareas_ejecutables`
--

CREATE TABLE `sis_tareas_ejecutables` (
  `idtarea` int NOT NULL,
  `ta_name` varchar(200) NOT NULL DEFAULT 'undefined',
  `ta_description` text,
  `ta_execute` text,
  `ta_fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `sis_tareas_ejecutables`
--

INSERT INTO `sis_tareas_ejecutables` (`idtarea`, `ta_name`, `ta_description`, `ta_execute`, `ta_fecha`) VALUES
(5, 'Delete Centinela Y Visitas', '', 'DELETE FROM `sis_centinela`;\r\nDELETE FROM `web_visitas`;', '2023-03-24 19:30:52'),
(10, 'Delete Crud_modulo', '', 'DELETE FROM `crud_modulo`;', '2023-04-19 00:24:41'),
(11, 'Entrenamiento Y Detalle Modelo', '', 'TRUNCATE TABLE ma_entrenamiento;\r\nTRUNCATE TABLE ma_detalle_modelo;', '2023-04-21 01:53:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sis_usuarios`
--

CREATE TABLE `sis_usuarios` (
  `idusuario` int NOT NULL,
  `idrol` int NOT NULL,
  `idpersona` int NOT NULL,
  `usu_usuario` varchar(255) NOT NULL,
  `usu_pass` varchar(255) NOT NULL,
  `usu_token` varchar(255) DEFAULT NULL,
  `usu_activo` tinyint(1) NOT NULL DEFAULT '0',
  `usu_estado` tinyint(1) NOT NULL DEFAULT '0',
  `usu_primera` tinyint(1) NOT NULL DEFAULT '0',
  `usu_twoauth` tinyint(1) NOT NULL DEFAULT '0',
  `usu_code_twoauth` varchar(200) NOT NULL DEFAULT '0',
  `usu_fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `sis_usuarios`
--

INSERT INTO `sis_usuarios` (`idusuario`, `idrol`, `idpersona`, `usu_usuario`, `usu_pass`, `usu_token`, `usu_activo`, `usu_estado`, `usu_primera`, `usu_twoauth`, `usu_code_twoauth`, `usu_fecha`) VALUES
(1, 1, 1, 'developer', '$2y$10$Z3rOi0RlLXg2mRRduTAmm.u6sy6CIA9iq2yuJxE1IfcKzt6pGGpW6', NULL, 1, 1, 0, 0, '', '2022-07-22 01:10:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `web_carritos`
--

CREATE TABLE `web_carritos` (
  `idcarrito` int NOT NULL,
  `vis_cod` varchar(20) NOT NULL,
  `idwebusuario` int DEFAULT NULL,
  `idarticulo` int NOT NULL,
  `codPedido` varchar(20) NOT NULL DEFAULT '0',
  `car_cantidad` int NOT NULL DEFAULT '1',
  `car_anulado` tinyint(1) NOT NULL DEFAULT '0',
  `car_fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `web_carritos`
--

INSERT INTO `web_carritos` (`idcarrito`, `vis_cod`, `idwebusuario`, `idarticulo`, `codPedido`, `car_cantidad`, `car_anulado`, `car_fecha`) VALUES
(16, '6348', 0, 20, '0', 1, 0, '2023-04-07 01:04:36'),
(17, '6348', 0, 19, '0', 1, 0, '2023-04-07 01:05:42'),
(18, '6653', 0, 18, '0', 1, 0, '2023-04-13 16:38:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `web_menus`
--

CREATE TABLE `web_menus` (
  `idmenu` int NOT NULL,
  `me_name` varchar(20) NOT NULL,
  `me_url` varchar(20) DEFAULT NULL,
  `me_publico` tinyint(1) NOT NULL DEFAULT '0',
  `me_status` tinyint(1) NOT NULL DEFAULT '0',
  `me_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `web_menus`
--

INSERT INTO `web_menus` (`idmenu`, `me_name`, `me_url`, `me_publico`, `me_status`, `me_date`) VALUES
(1, 'Inicio', '/', 1, 1, '2023-03-03 16:50:37'),
(2, 'usuario', NULL, 1, 1, '2023-03-03 16:52:22'),
(3, 'Salir', '/logout', 1, 1, '2023-03-03 17:48:03'),
(4, 'Mi Cuenta', '/me', 1, 1, '2023-03-17 00:26:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `web_submenus`
--

CREATE TABLE `web_submenus` (
  `idsubmenu` int NOT NULL,
  `idmenu` int DEFAULT '0',
  `me_name` varchar(20) NOT NULL,
  `me_url` varchar(20) NOT NULL,
  `me_publico` tinyint(1) NOT NULL DEFAULT '0',
  `me_status` tinyint(1) NOT NULL DEFAULT '0',
  `me_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `web_submenus`
--

INSERT INTO `web_submenus` (`idsubmenu`, `idmenu`, `me_name`, `me_url`, `me_publico`, `me_status`, `me_date`) VALUES
(1, 2, 'Registrarse', '/register', 1, 1, '2023-03-03 17:46:35'),
(2, 2, 'Iniciar Sesion', '/login', 1, 1, '2023-03-03 17:47:02'),
(3, 2, 'Recuperar Contraseña', '/forgot-password', 1, 1, '2023-03-03 17:47:19'),
(4, 2, 'Intranet', '/admin/login', 1, 1, '2023-03-05 17:00:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `web_usuarios`
--

CREATE TABLE `web_usuarios` (
  `idwebusuario` int NOT NULL,
  `usu_ndoc` varchar(12) DEFAULT NULL,
  `usu_nombre` varchar(45) NOT NULL,
  `usu_cuenta` tinyint(1) NOT NULL DEFAULT '0',
  `usu_usuario` varchar(100) NOT NULL,
  `usu_pass` varchar(200) NOT NULL,
  `usu_direc` varchar(200) DEFAULT NULL,
  `usu_cel` varchar(12) DEFAULT NULL,
  `usu_foto` varchar(100) DEFAULT NULL,
  `usu_token` varchar(200) DEFAULT NULL,
  `usu_expire` varchar(20) DEFAULT NULL,
  `usu_publish` tinyint(1) NOT NULL DEFAULT '0',
  `usu_estado` tinyint(1) NOT NULL DEFAULT '1',
  `usu_activo` tinyint(1) NOT NULL DEFAULT '0',
  `usu_factivo` datetime DEFAULT NULL,
  `usu_fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `web_usuarios`
--

INSERT INTO `web_usuarios` (`idwebusuario`, `usu_ndoc`, `usu_nombre`, `usu_cuenta`, `usu_usuario`, `usu_pass`, `usu_direc`, `usu_cel`, `usu_foto`, `usu_token`, `usu_expire`, `usu_publish`, `usu_estado`, `usu_activo`, `usu_factivo`, `usu_fecha`) VALUES
(1, NULL, 'usuario general', 0, 'usuario-general', 'usuario-general', NULL, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, '2023-03-10 14:02:14'),
(3, '76144152', 'LEENH ALEXANDER BUSTAMANTE FERNANDEZ', 1, 'hackingleenh@gmail.com', '$2y$10$aCBojLCw0l4qYXbuYSFtf.rFJoKGp33j8Ul5ZZsaSGK8MIWhuO1eW', NULL, NULL, NULL, NULL, NULL, 0, 1, 1, '2023-03-17 00:23:43', '2023-03-17 00:22:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `web_visitas`
--

CREATE TABLE `web_visitas` (
  `idvisita` int NOT NULL,
  `vis_cod` int NOT NULL,
  `idwebusuario` int DEFAULT '0',
  `vis_ip` varchar(200) NOT NULL,
  `vis_agente` varchar(255) NOT NULL,
  `vis_method` varchar(10) DEFAULT NULL,
  `vis_url` varchar(200) DEFAULT NULL,
  `vis_fechahora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `web_visitas`
--

INSERT INTO `web_visitas` (`idvisita`, `vis_cod`, `idwebusuario`, `vis_ip`, `vis_agente`, `vis_method`, `vis_url`, `vis_fechahora`) VALUES
(23, 3383, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'GET', '/admin/login', '2025-05-29 23:41:29');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `crud_modulo`
--
ALTER TABLE `crud_modulo`
  ADD PRIMARY KEY (`idmod`);

--
-- Indices de la tabla `ma_clases`
--
ALTER TABLE `ma_clases`
  ADD PRIMARY KEY (`idclase`);

--
-- Indices de la tabla `ma_configuracion`
--
ALTER TABLE `ma_configuracion`
  ADD PRIMARY KEY (`idconfig`);

--
-- Indices de la tabla `ma_detalle_modelo`
--
ALTER TABLE `ma_detalle_modelo`
  ADD PRIMARY KEY (`iddetallemodelo`);

--
-- Indices de la tabla `ma_entrenamiento`
--
ALTER TABLE `ma_entrenamiento`
  ADD PRIMARY KEY (`identrenamiento`);

--
-- Indices de la tabla `ma_especies`
--
ALTER TABLE `ma_especies`
  ADD PRIMARY KEY (`idespecie`);

--
-- Indices de la tabla `ma_especies_1`
--
ALTER TABLE `ma_especies_1`
  ADD PRIMARY KEY (`idespecie`);

--
-- Indices de la tabla `ma_especies_2`
--
ALTER TABLE `ma_especies_2`
  ADD PRIMARY KEY (`idespecie`);

--
-- Indices de la tabla `ma_familias`
--
ALTER TABLE `ma_familias`
  ADD PRIMARY KEY (`idfamilia`);

--
-- Indices de la tabla `ma_familias_1`
--
ALTER TABLE `ma_familias_1`
  ADD PRIMARY KEY (`idfamilia`);

--
-- Indices de la tabla `ma_filos`
--
ALTER TABLE `ma_filos`
  ADD PRIMARY KEY (`idfilo`);

--
-- Indices de la tabla `ma_generos`
--
ALTER TABLE `ma_generos`
  ADD PRIMARY KEY (`idgenero`);

--
-- Indices de la tabla `ma_generos_1`
--
ALTER TABLE `ma_generos_1`
  ADD PRIMARY KEY (`idgenero`);

--
-- Indices de la tabla `ma_historial_identificacion`
--
ALTER TABLE `ma_historial_identificacion`
  ADD PRIMARY KEY (`idhistorial`);

--
-- Indices de la tabla `ma_modelo`
--
ALTER TABLE `ma_modelo`
  ADD PRIMARY KEY (`idmodelo`);

--
-- Indices de la tabla `ma_ordenes`
--
ALTER TABLE `ma_ordenes`
  ADD PRIMARY KEY (`idorden`);

--
-- Indices de la tabla `ma_ordenes_1`
--
ALTER TABLE `ma_ordenes_1`
  ADD PRIMARY KEY (`idorden`);

--
-- Indices de la tabla `ma_reinos`
--
ALTER TABLE `ma_reinos`
  ADD PRIMARY KEY (`idreino`);

--
-- Indices de la tabla `ma_subfamilias`
--
ALTER TABLE `ma_subfamilias`
  ADD PRIMARY KEY (`idsubfamilia`);

--
-- Indices de la tabla `ma_subfamilias_1`
--
ALTER TABLE `ma_subfamilias_1`
  ADD PRIMARY KEY (`idsubfamilia`);

--
-- Indices de la tabla `ma_superfamilias`
--
ALTER TABLE `ma_superfamilias`
  ADD PRIMARY KEY (`idsuperfamilia`);

--
-- Indices de la tabla `ma_tribus`
--
ALTER TABLE `ma_tribus`
  ADD PRIMARY KEY (`idgeneros`);

--
-- Indices de la tabla `sis_centinela`
--
ALTER TABLE `sis_centinela`
  ADD PRIMARY KEY (`idvisita`);

--
-- Indices de la tabla `sis_imagenes`
--
ALTER TABLE `sis_imagenes`
  ADD PRIMARY KEY (`idimagen`);

--
-- Indices de la tabla `sis_menus`
--
ALTER TABLE `sis_menus`
  ADD PRIMARY KEY (`idmenu`);

--
-- Indices de la tabla `sis_permisos`
--
ALTER TABLE `sis_permisos`
  ADD PRIMARY KEY (`idpermisos`),
  ADD KEY `sis_submenus_sis_permisos_fk` (`idsubmenu`),
  ADD KEY `bib_rol_bib_permisos_fk` (`idrol`);

--
-- Indices de la tabla `sis_personal`
--
ALTER TABLE `sis_personal`
  ADD PRIMARY KEY (`idpersona`);

--
-- Indices de la tabla `sis_rol`
--
ALTER TABLE `sis_rol`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `sis_server_email`
--
ALTER TABLE `sis_server_email`
  ADD PRIMARY KEY (`idserveremail`);

--
-- Indices de la tabla `sis_submenus`
--
ALTER TABLE `sis_submenus`
  ADD PRIMARY KEY (`idsubmenu`),
  ADD KEY `sis_menus_sis_submenus_fk` (`idmenu`);

--
-- Indices de la tabla `sis_tareas_ejecutables`
--
ALTER TABLE `sis_tareas_ejecutables`
  ADD PRIMARY KEY (`idtarea`);

--
-- Indices de la tabla `sis_usuarios`
--
ALTER TABLE `sis_usuarios`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `bib_personal_sis_usuarios_fk` (`idpersona`),
  ADD KEY `bib_rol_bib_usuarios_fk` (`idrol`);

--
-- Indices de la tabla `web_carritos`
--
ALTER TABLE `web_carritos`
  ADD PRIMARY KEY (`idcarrito`);

--
-- Indices de la tabla `web_menus`
--
ALTER TABLE `web_menus`
  ADD PRIMARY KEY (`idmenu`);

--
-- Indices de la tabla `web_submenus`
--
ALTER TABLE `web_submenus`
  ADD PRIMARY KEY (`idsubmenu`);

--
-- Indices de la tabla `web_usuarios`
--
ALTER TABLE `web_usuarios`
  ADD PRIMARY KEY (`idwebusuario`);

--
-- Indices de la tabla `web_visitas`
--
ALTER TABLE `web_visitas`
  ADD PRIMARY KEY (`idvisita`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `crud_modulo`
--
ALTER TABLE `crud_modulo`
  MODIFY `idmod` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=390;

--
-- AUTO_INCREMENT de la tabla `ma_clases`
--
ALTER TABLE `ma_clases`
  MODIFY `idclase` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ma_configuracion`
--
ALTER TABLE `ma_configuracion`
  MODIFY `idconfig` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ma_detalle_modelo`
--
ALTER TABLE `ma_detalle_modelo`
  MODIFY `iddetallemodelo` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ma_entrenamiento`
--
ALTER TABLE `ma_entrenamiento`
  MODIFY `identrenamiento` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ma_especies`
--
ALTER TABLE `ma_especies`
  MODIFY `idespecie` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ma_especies_1`
--
ALTER TABLE `ma_especies_1`
  MODIFY `idespecie` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ma_especies_2`
--
ALTER TABLE `ma_especies_2`
  MODIFY `idespecie` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ma_familias`
--
ALTER TABLE `ma_familias`
  MODIFY `idfamilia` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ma_familias_1`
--
ALTER TABLE `ma_familias_1`
  MODIFY `idfamilia` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ma_filos`
--
ALTER TABLE `ma_filos`
  MODIFY `idfilo` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ma_generos`
--
ALTER TABLE `ma_generos`
  MODIFY `idgenero` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ma_generos_1`
--
ALTER TABLE `ma_generos_1`
  MODIFY `idgenero` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ma_historial_identificacion`
--
ALTER TABLE `ma_historial_identificacion`
  MODIFY `idhistorial` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ma_modelo`
--
ALTER TABLE `ma_modelo`
  MODIFY `idmodelo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ma_ordenes`
--
ALTER TABLE `ma_ordenes`
  MODIFY `idorden` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ma_ordenes_1`
--
ALTER TABLE `ma_ordenes_1`
  MODIFY `idorden` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ma_reinos`
--
ALTER TABLE `ma_reinos`
  MODIFY `idreino` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ma_subfamilias`
--
ALTER TABLE `ma_subfamilias`
  MODIFY `idsubfamilia` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ma_subfamilias_1`
--
ALTER TABLE `ma_subfamilias_1`
  MODIFY `idsubfamilia` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ma_superfamilias`
--
ALTER TABLE `ma_superfamilias`
  MODIFY `idsuperfamilia` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ma_tribus`
--
ALTER TABLE `ma_tribus`
  MODIFY `idgeneros` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sis_centinela`
--
ALTER TABLE `sis_centinela`
  MODIFY `idvisita` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1061;

--
-- AUTO_INCREMENT de la tabla `sis_imagenes`
--
ALTER TABLE `sis_imagenes`
  MODIFY `idimagen` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sis_menus`
--
ALTER TABLE `sis_menus`
  MODIFY `idmenu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `sis_permisos`
--
ALTER TABLE `sis_permisos`
  MODIFY `idpermisos` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `sis_personal`
--
ALTER TABLE `sis_personal`
  MODIFY `idpersona` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `sis_rol`
--
ALTER TABLE `sis_rol`
  MODIFY `idrol` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `sis_server_email`
--
ALTER TABLE `sis_server_email`
  MODIFY `idserveremail` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sis_submenus`
--
ALTER TABLE `sis_submenus`
  MODIFY `idsubmenu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `sis_tareas_ejecutables`
--
ALTER TABLE `sis_tareas_ejecutables`
  MODIFY `idtarea` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `sis_usuarios`
--
ALTER TABLE `sis_usuarios`
  MODIFY `idusuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `web_carritos`
--
ALTER TABLE `web_carritos`
  MODIFY `idcarrito` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `web_menus`
--
ALTER TABLE `web_menus`
  MODIFY `idmenu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `web_submenus`
--
ALTER TABLE `web_submenus`
  MODIFY `idsubmenu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `web_usuarios`
--
ALTER TABLE `web_usuarios`
  MODIFY `idwebusuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `web_visitas`
--
ALTER TABLE `web_visitas`
  MODIFY `idvisita` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `sis_permisos`
--
ALTER TABLE `sis_permisos`
  ADD CONSTRAINT `bib_rol_bib_permisos_fk` FOREIGN KEY (`idrol`) REFERENCES `sis_rol` (`idrol`),
  ADD CONSTRAINT `sis_submenus_sis_permisos_fk` FOREIGN KEY (`idsubmenu`) REFERENCES `sis_submenus` (`idsubmenu`);

--
-- Filtros para la tabla `sis_submenus`
--
ALTER TABLE `sis_submenus`
  ADD CONSTRAINT `sis_menus_sis_submenus_fk` FOREIGN KEY (`idmenu`) REFERENCES `sis_menus` (`idmenu`);

--
-- Filtros para la tabla `sis_usuarios`
--
ALTER TABLE `sis_usuarios`
  ADD CONSTRAINT `bib_personal_sis_usuarios_fk` FOREIGN KEY (`idpersona`) REFERENCES `sis_personal` (`idpersona`),
  ADD CONSTRAINT `bib_rol_bib_usuarios_fk` FOREIGN KEY (`idrol`) REFERENCES `sis_rol` (`idrol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
