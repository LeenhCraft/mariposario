-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 22-06-2023 a las 23:06:47
-- Versión del servidor: 5.7.33
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_mariposario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crud_modulo`
--

CREATE TABLE `crud_modulo` (
  `idmod` int(11) NOT NULL,
  `mod_nombre` varchar(255) NOT NULL,
  `mod_descripcion` text NOT NULL,
  `mod_estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `idclase` int(11) NOT NULL,
  `idfilo` int(11) NOT NULL,
  `cla_nombre` varchar(200) NOT NULL DEFAULT 'undefined'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_configuracion`
--

CREATE TABLE `ma_configuracion` (
  `idconfig` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ma_configuracion`
--

INSERT INTO `ma_configuracion` (`idconfig`, `nombre`, `valor`, `date`) VALUES
(1, 'ruta_imagen_especies', '{ \"ruta_imagen_especies\": \"img/especies\", \"carpeta_img_entrenamiento\": \"img/entrenamiento\", \"ruta_train_delete\": \"img/eliminar/\", \"ruta_datos_entrenamiento\": \"entrenamiento\", \"nombre_datos_entrenamiento\": \"data-train\", \"nombre_modelo\": \"modelo-svm\", \"ruta_modelo\": \"modelo\", \"ruta_img_id\": \"predicciones\", \"prefix_id\": \"id\", \"prefix_data\": \"data\", \"prefix_train\": \"train\" }', '2023-05-24 00:30:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_detalle_modelo`
--

CREATE TABLE `ma_detalle_modelo` (
  `iddetallemodelo` int(11) NOT NULL,
  `idmodelo` int(11) NOT NULL,
  `identrenamiento` int(11) NOT NULL,
  `det_ruta` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `det_nombre` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `det_default` tinyint(1) NOT NULL DEFAULT '0',
  `det_tiempo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `det_inicio` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `det_fin` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `det_fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ma_detalle_modelo`
--

INSERT INTO `ma_detalle_modelo` (`iddetallemodelo`, `idmodelo`, `identrenamiento`, `det_ruta`, `det_nombre`, `det_default`, `det_tiempo`, `det_inicio`, `det_fin`, `det_fecha`) VALUES
(1, 1, 1, 'modelo/mdl-modelo-svm-20230615210943.pkl', 'mdl-modelo-svm-20230615210943.pkl', 1, '15.52116394043', '1686881368.5533', '1686881384.0745', '2023-06-15 21:09:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_entrenamiento`
--

CREATE TABLE `ma_entrenamiento` (
  `identrenamiento` int(11) NOT NULL,
  `ent_fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ent_ruta_datos_generados` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ent_nombre_datos_generados` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ent_total_imagenes` int(11) NOT NULL,
  `ent_descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ent_diccionario` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ent_tiempo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ent_inicio` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ent_fin` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ent_default` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ma_entrenamiento`
--

INSERT INTO `ma_entrenamiento` (`identrenamiento`, `ent_fecha`, `ent_ruta_datos_generados`, `ent_nombre_datos_generados`, `ent_total_imagenes`, `ent_descripcion`, `ent_diccionario`, `ent_tiempo`, `ent_inicio`, `ent_fin`, `ent_default`) VALUES
(1, '2023-06-15 21:07:09', '[\"entrenamiento\\\\label-data-train-20230615210557.npy\",\"entrenamiento\\/img-data-train-20230615210709.npy\"]', '[\"label-data-train-20230615210557.npy\",\"img-data-train-20230615210709.npy\"]', 1827, '', '{\"Lycaena Phlaeas\": 0, \"Heliconius Erato\": 1, \"Pontia Beckerii\": 2, \"Papilio Cresphontes\": 3, \"Junonia Coenia\": 4, \"Nymphalis Antiopa\": 5, \"Vanessa Atalanta\": 6, \"Pieris Rapae\": 7, \"Colias Philodice\": 8, \"Parnassius Clodius M\\u00e9n\\u00e9tri\\u00e9s\": 9, \"Lycaena Arota\": 10, \"Polyommatus Bellargus\": 11, \"Heliconius Charitonius\": 12, \"Satyrium Pruni\": 13, \"Diaethria Anna\": 14, \"Caligo Eurilochus\": 15, \"Parantica Sita\": 16, \"Danaus Plexippus\": 17, \"Papilio Crino Fabricius\": 18, \"Vanessa Cardui\": 19, \"Libytheana Carinenta\": 20}', '72.938655853271', '1686881156.8677', '1686881229.8063', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_especies`
--

CREATE TABLE `ma_especies` (
  `idespecie` int(11) NOT NULL,
  `idgenero` int(11) NOT NULL,
  `es_nombre_cientifico` varchar(255) NOT NULL,
  `es_nombre_comun` varchar(255) NOT NULL,
  `es_habitad` varchar(255) NOT NULL,
  `es_alimentacion` varchar(255) NOT NULL,
  `es_plantas_hospederas` varchar(255) NOT NULL,
  `es_tiempo_de_vida` varchar(255) NOT NULL,
  `es_imagen_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_especies_1`
--

CREATE TABLE `ma_especies_1` (
  `idespecie` int(11) NOT NULL,
  `idgenero` int(11) NOT NULL,
  `es_nombre_cientifico` varchar(255) NOT NULL,
  `es_nombre_comun` varchar(255) NOT NULL,
  `es_tamanio` varchar(255) NOT NULL,
  `es_imagen_url` varchar(255) NOT NULL,
  `es_descripcion` text NOT NULL,
  `es_slug` varchar(255) NOT NULL,
  `es_status` tinyint(1) NOT NULL DEFAULT '1',
  `es_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ma_especies_1`
--

INSERT INTO `ma_especies_1` (`idespecie`, `idgenero`, `es_nombre_cientifico`, `es_nombre_comun`, `es_tamanio`, `es_imagen_url`, `es_descripcion`, `es_slug`, `es_status`, `es_date`) VALUES
(1, 2, 'Danaus Plexippus', 'Mariposa Monarca', '', 'img/especies/mariposa-monarca.jpg', '', 'mariposa-monarca', 1, '2023-05-23 10:01:50'),
(2, 4, 'Heliconius Charitonius', 'Mariposa Alas De Cebra', '', 'img/especies/mariposa-alas-de-cebra.jpg', '<h1>Descripcion</h1> <p>La oruga es blanca con manchas negras y numerosas espinas negras a lo largo del cuerpo. El adulto es de tama&ntilde;o mediano con largas alas. La superficie dorsal de las alas es negra con bandas angostas blancas y amarillas, el dise&ntilde;o ventral es similar pero m&aacute;s claro con manchas rojas. La envergadura es de 72 a 100 mm</p> <h1>Ciclo de vida</h1> <p>La&nbsp;<a href=\"https:es.wikipedia.org/wiki/Oruga_(larva)\">oruga</a>&nbsp;se alimenta de&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Passiflora_lutea\">Passiflora lutea</a></em>,&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Passiflora_suberosa\">Passiflora suberosa</a></em>,&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Passiflora_biflora\">Passiflora biflora</a></em>,&nbsp;<em><a href=\"https:es.wikipedia.org/w/index.php?title=Tetrastylis_lobata&amp;action=edit&amp;redlink=1\">Tetrastylis lobata</a></em>&nbsp;y menos en&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Passiflora_adenopoda\">Passiflora adenopoda</a></em>. Los adultos, son inusuales entre las mariposas, ya que se alimentan de&nbsp;<a href=\"https:es.wikipedia.org/wiki/Polen\">polen</a>, as&iacute; como tambi&eacute;n liban el&nbsp;<a href=\"https:es.wikipedia.org/wiki/N%C3%A9ctar_(bot%C3%A1nica)\">n&eacute;ctar</a>. Esta capacidad contribuye a su longevidad de 3 meses en un adulto.<a href=\"https:es.wikipedia.org/wiki/Heliconius_charithonia#cite_note-5\">5</a>​ Debido a su larga vida &uacute;til y a su actividad durante todo el d&iacute;a, es una especie popular entre las mariposas. Otra caracter&iacute;stica inusual es que los adultos se posan en grupos de hasta 70 y vuelven a la misma percha cada noche.</p>', 'mariposa-alas-de-cebra', 1, '2023-05-23 10:13:32'),
(3, 4, 'Heliconius Erato', 'Heliconius Erato', '', 'img/especies/heliconius-erato.jpg', '<p><em><strong>Heliconius erato</strong></em>&nbsp;es una&nbsp;<a href=\"https:es.wikipedia.org/wiki/Especie\">especie</a>&nbsp;de&nbsp;<a href=\"https:es.wikipedia.org/wiki/Lepid%C3%B3ptero\">lepid&oacute;ptero</a>&nbsp;de la familia&nbsp;<a href=\"https:es.wikipedia.org/wiki/Nymphalidae\">Nymphalidae</a>. Es de los&nbsp;<a href=\"https:es.wikipedia.org/wiki/Neotr%C3%B3pico\">Neotr&oacute;picos</a>, desde el norte de Brasil, por Am&eacute;rica Central, hasta M&eacute;xico, ocasionalmente llega hasta Texas.<a href=\"https:es.wikipedia.org/wiki/Heliconius_erato#cite_note-1\">1</a>​<a href=\"https:es.wikipedia.org/wiki/Heliconius_erato#cite_note-2\">2</a>​ Mide 0,47 y pesa 0,003</p> <h2>Descripci&oacute;n</h2> <p>La especie es muy variable en color y forma. Dependiendo de la ubicaci&oacute;n, y sus diferentes apariencias puede ser dif&iacute;cil de distinguir de las dem&aacute;s especies de&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Heliconius\">Heliconius</a></em>&nbsp;como&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Heliconius_sara\">Heliconius sara</a></em>. Particularmente dif&iacute;cil de distinguir con el relacionado&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Heliconius_melpomene\">Heliconius melpomene</a></em>, que imita casi todas las formas de color de&nbsp;<em>Heliconius erato</em>&nbsp;, las formas de color est&aacute;n sincronizadas entre las dos a lo largo de su h&aacute;bitat com&uacute;n.<a href=\"https:es.wikipedia.org/wiki/Heliconius_erato#cite_note-3\">3</a>​ Al igual que&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Heliconius_charithonia\">Heliconius charithonia</a></em>,&nbsp;<em>H. Erato</em>&nbsp;es una de las pocas mariposas que recoge y digiere el&nbsp;<a href=\"https:es.wikipedia.org/wiki/Polen\">polen</a>, confiriendo una longevidad considerable a los adultos (varios meses). Los adultos se posan en grupos, regresando al mismo lugar cada noche.<a href=\"https:es.wikipedia.org/wiki/Heliconius_erato#cite_note-4\">4</a>​</p> <h2>Or&iacute;genes</h2> <p>Un estudio reciente, utilizando el conjunto de datos de los&nbsp;<a href=\"https:es.wikipedia.org/wiki/Polimorfismos_en_la_longitud_de_fragmentos_amplificados\">Polimorfismos en la longitud de fragmentos amplificados</a>&nbsp;(AFLP) y&nbsp;<a href=\"https:es.wikipedia.org/wiki/ADN_mitocondrial\">ADN mitocondrial</a>&nbsp;(ADNmt), sit&uacute;a los or&iacute;genes de la especie&nbsp;<em>H. Erato</em>&nbsp;en 2,8 millones de a&ntilde;os.<a href=\"https:es.wikipedia.org/wiki/Heliconius_erato#cite_note-5\">5</a>​&nbsp;<em>H. Erato</em>&nbsp;tambi&eacute;n muestra la agrupaci&oacute;n de los AFLPs por la geograf&iacute;a que revela que&nbsp;<em>H. Erato</em>&nbsp;se origin&oacute; en el oeste de&nbsp;<a href=\"https:es.wikipedia.org/wiki/Am%C3%A9rica_del_Sur\">Am&eacute;rica del Sur</a>.</p>', 'heliconius-erato', 1, '2023-05-23 10:15:05'),
(4, 5, 'Junonia Coenia', 'Junonia Coenia', '', 'img/especies/junonia-coenia.png', '<p><em><strong>Junonia coenia</strong></em>&nbsp;es una mariposa perteneciente a la familia de los&nbsp;<a href=\"https:es.wikipedia.org/wiki/Nymphalidae\">ninf&aacute;lidos</a>. Se puede encontrar en&nbsp;<a href=\"https:es.wikipedia.org/wiki/Manitoba\">Manitoba</a>,&nbsp;<a href=\"https:es.wikipedia.org/wiki/Ontario\">Ontario</a>,&nbsp;<a href=\"https:es.wikipedia.org/wiki/Quebec\">Quebec</a>&nbsp;y&nbsp;<a href=\"https:es.wikipedia.org/wiki/Nueva_Escocia\">Nueva Escocia</a>, adem&aacute;s de la gran mayor&iacute;a de los&nbsp;<a href=\"https:es.wikipedia.org/wiki/Estados_Unidos\">Estados Unidos</a>, exceptuando el noroeste,&nbsp;<a href=\"https:es.wikipedia.org/wiki/Am%C3%A9rica_Central\">Am&eacute;rica Central</a>&nbsp;y&nbsp;<a href=\"https:es.wikipedia.org/wiki/Colombia\">Colombia</a>. La subespecie&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Junonia_coenia_bergi\">Junonia coenia bergi</a></em>&nbsp;es un endemismo de las islas&nbsp;<a href=\"https:es.wikipedia.org/wiki/Bermuda\">Bermudas</a>. Sus h&aacute;bitats son &aacute;reas abiertas con vegetaci&oacute;n baja y algo de suelo descubierto.</p> <h2>Descripci&oacute;n</h2> <h3>Adulto</h3> <p>Su coloraci&oacute;n es marr&oacute;n o tambi&eacute;n azul,(si es azul sus tonalidades son del marr&oacute;n al anaranjado en cambio si es marr&oacute;n sos tonalidades que van del rojo al amarillo). La especie se caracteriza por su dise&ntilde;o de manchas que asemejan ojos y en forma de barras. Miden de 5 a 6,4 cm.</p> <h3>Huevo</h3> <p>Los huevos son esferoidales y son colocados en el&nbsp;<a href=\"https:es.wikipedia.org/wiki/Meristemo\">meristemo</a>&nbsp;de las plantas o sobre la parte inferior de la hoja.</p> <h3>Oruga</h3> <p>Las orugas son negras con manchas amarillas. Tienen espinas ramificadas a todo su largo que aparecen azules en la base. Miden hasta 3,8 cm. inches in length.<a href=\"https:es.wikipedia.org/wiki/Junonia_coenia#cite_note-:10-1\">1</a>​</p> <h3>Pupa</h3> <p>La cris&aacute;lida tiene una coloraci&oacute;n marr&oacute;n, con partes oscuras y punteadas de negro. Se suspende en un robusto&nbsp;<a href=\"https:es.wikipedia.org/wiki/Crem%C3%A1ster\">crem&aacute;ster</a>.</p> <h2>Dieta</h2> <p>Las larvas se alimentan de una variedad de plantas que incluyen miembros de la familia&nbsp;<a href=\"https:es.wikipedia.org/wiki/Scrophulariaceae\">Scrophulariaceae</a>, tambi&eacute;n&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Plantago\">Plantago</a></em>,&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Acanthus\">Acanthus</a></em>&nbsp;y&nbsp;<em><a href=\"https:es.wikipedia.org/w/index.php?title=Ruellia_nudiflora&amp;action=edit&amp;redlink=1\">Ruellia nudiflora</a></em>.</p> <p>Los individuos adultos se alimentan de n&eacute;ctar y tambi&eacute;n toman fluidos del barro y la arena h&uacute;meda. Los machos se posan sobre el suelo sin hierba o con plantas bajas, vigilando y buscando a las hembras, aunque se ha de decir que esta especie no es territorial. Los adultos se alimentan del n&eacute;ctar de estas flores:</p>', 'junonia-coenia', 1, '2023-05-23 10:17:02'),
(5, 6, 'Lycaena Phlaeas', 'Manto Bicolor', '', 'img/especies/manto-bicolor.jpg', '<p>La&nbsp;<strong>mariposa manto bicolor</strong>&nbsp;(<em><strong>Lycaena phlaeas</strong></em>) es una&nbsp;<a href=\"https:es.wikipedia.org/wiki/Mariposa\">mariposa</a>&nbsp;diurna del g&eacute;nero&nbsp;<em><a href=\"https:es.wikipedia.org/w/index.php?title=Lycaena&amp;action=edit&amp;redlink=1\">Lycaena</a></em>&nbsp;y de la familia&nbsp;<a href=\"https:es.wikipedia.org/wiki/Lycaenidae\">Lycaenidae</a>.</p> <h2>Distribuci&oacute;n y h&aacute;bitat</h2> <p>Tiene una amplia distribuci&oacute;n en las zonas templadas de&nbsp;<a href=\"https:es.wikipedia.org/wiki/Eurasia\">Eurasia</a>,&nbsp;<a href=\"https:es.wikipedia.org/wiki/%C3%81frica\">&Aacute;frica</a>&nbsp;norte&ntilde;as y al este de&nbsp;<a href=\"https:es.wikipedia.org/wiki/Norteam%C3%A9rica\">Norteam&eacute;rica</a>&nbsp;(donde es una especie introducida). Se encuentra en h&aacute;bitats variados, siendo m&aacute;s com&uacute;n en lugares de vegetaci&oacute;n baja, como prados y campos abiertos,&nbsp;<a href=\"https:es.wikipedia.org/wiki/P%C3%A1ramo_(geomorfolog%C3%ADa)\">p&aacute;ramos</a>, y a los bordes de los caminos de campo. Tambi&eacute;n aparece ocasionalmente en bosques. En la zona del Mediterr&aacute;neo los adultos de manto bicolor est&aacute;n de febrero a octubre.</p> <p>Liban las flores de&nbsp;<a href=\"https:es.wikipedia.org/wiki/Escabiosa\">escabiosa</a>&nbsp;(<em>Scabiosa columbaria</em>) una planta muy com&uacute;n en los prados. Los machos de manto bicolor son territoriales y alejan a otras mariposas, a&uacute;n m&aacute;s grandes, de su territorio.</p>', 'manto-bicolor', 1, '2023-05-23 11:14:41'),
(6, 11, 'Nymphalis Antiopa', 'Nymphalis Antiopa', '', 'img/especies/nymphalis-antiopa.jpg', '<p><em><strong>Nymphalis antiopa</strong></em>&nbsp;es una&nbsp;<a href=\"https:es.wikipedia.org/wiki/Especie\">especie</a>&nbsp;de&nbsp;<a href=\"https:es.wikipedia.org/wiki/Lepid%C3%B3ptero\">lepid&oacute;ptero</a>&nbsp;<a href=\"https:es.wikipedia.org/wiki/Ditrisio\">ditrisio</a>&nbsp;de la&nbsp;<a href=\"https:es.wikipedia.org/wiki/Familia_(biolog%C3%ADa)\">familia</a>&nbsp;<a href=\"https:es.wikipedia.org/wiki/Nymphalidae\">Nymphalidae</a>, ampliamente distribuida por&nbsp;<a href=\"https:es.wikipedia.org/wiki/Eurasia\">Eurasia</a>&nbsp;y&nbsp;<a href=\"https:es.wikipedia.org/wiki/Norteam%C3%A9rica\">Norteam&eacute;rica</a>.<a href=\"https:es.wikipedia.org/wiki/Nymphalis_antiopa#cite_note-1\">1</a>​</p> <h2>Caracter&iacute;sticas</h2> <p>Sus alas granate oscuro se caracterizan por un borde amarillo, que tiene junto a &eacute;l una banda de puntos azules iridiscentes. Vistas de cerca, las alas son iridiscentes. Tiene una envergadura de 73 a 86 mm. A veces aparece una variaci&oacute;n, cuando la pupa estuvo expuesta a temperaturas inusualmente bajas, en que la banda amarilla es m&aacute;s amplia que lo normal, y no presenta las manchas azules. Envergadura 57-101 mm.<a href=\"https:es.wikipedia.org/wiki/Nymphalis_antiopa#cite_note-diver-2\">2</a>​</p> <p>La larva llega a medir 50 mm. Tiene pelos irritantes.</p>', 'nymphalis-antiopa', 1, '2023-05-23 11:20:32'),
(7, 8, 'Papilio Cresphontes', 'Papilio Cresphontes', '', 'img/especies/papilio-cresphontes.jpeg', '<p><em><strong>Papilio cresphontes</strong></em>&nbsp;es una especie de&nbsp;<a href=\"https:es.wikipedia.org/wiki/Mariposa\">mariposa</a>&nbsp;de la familia&nbsp;<a href=\"https:es.wikipedia.org/wiki/Papilionidae\">Papilionidae</a>. Es com&uacute;n en varias partes de&nbsp;<a href=\"https:es.wikipedia.org/wiki/Norteam%C3%A9rica\">Norteam&eacute;rica</a>&nbsp;y en&nbsp;<a href=\"https:es.wikipedia.org/wiki/Sudam%C3%A9rica\">Sudam&eacute;rica</a>. En&nbsp;<a href=\"https:es.wikipedia.org/wiki/Estados_Unidos\">Estados Unidos</a>&nbsp;y&nbsp;<a href=\"https:es.wikipedia.org/wiki/Canad%C3%A1\">Canad&aacute;</a>&nbsp;se encuentran principalmente en el sur y en el este. Tienen una envergadura de alas de 10 a 16 cm de longitud,<a href=\"https:es.wikipedia.org/wiki/Papilio_cresphontes#cite_note-size-1\">1</a>​ siendo la mariposa m&aacute;s grande de Estados Unidos y Canad&aacute;.<a href=\"https:es.wikipedia.org/wiki/Papilio_cresphontes#cite_note-2\">2</a>​</p> <h2>Descripci&oacute;n<a href=\"https:es.wikipedia.org/w/index.php?title=Papilio_cresphontes&amp;action=edit&amp;section=1\">editar</a></h2> <h3>Adultos<a href=\"https:es.wikipedia.org/w/index.php?title=Papilio_cresphontes&amp;action=edit&amp;section=2\">editar</a></h3> <p>La envergadura de las alas de los adultos es de 100 a 160 mm de longitud.<a href=\"https:es.wikipedia.org/wiki/Papilio_cresphontes#cite_note-size-1\">1</a>​ El cuerpo y las alas son de color marr&oacute;n oscuro a negro con bandas amarillas. Tiene un &quot;ojo&quot; amarillo en cada cola de las alas. El abdomen tiene bandas de color amarillo junto con el ya mencionado color caf&eacute;. Los adultos son muy similares a los adultos de otra especie de&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Papilio\">Papilio</a></em>,&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Papilio_thoas\">P. thoas</a></em>.</p>', 'papilio-cresphontes', 1, '2023-05-23 11:21:32'),
(8, 9, 'Pieris Rapae', 'Blanquita De La Col', '', 'img/especies/blanquita-de-la-col.jpg', '<p>La&nbsp;<strong>blanquita de la col</strong>&nbsp;o&nbsp;<strong>mariposa de la naba</strong>&nbsp;(<em><strong>Pieris rapae</strong></em>) es una&nbsp;<a href=\"https:es.wikipedia.org/wiki/Especie\">especie</a>&nbsp;de&nbsp;<a href=\"https:es.wikipedia.org/wiki/Insecto\">insecto</a>&nbsp;<a href=\"https:es.wikipedia.org/wiki/Lepid%C3%B3ptero\">lepid&oacute;ptero</a>&nbsp;de la&nbsp;<a href=\"https:es.wikipedia.org/wiki/Familia_(biolog%C3%ADa)\">familia</a>&nbsp;<a href=\"https:es.wikipedia.org/wiki/Pieridae\">Pieridae</a>.<a href=\"https:es.wikipedia.org/wiki/Pieris_rapae#cite_note-1\">1</a>​ Debe su&nbsp;<a href=\"https:es.wikipedia.org/wiki/Nombre_com%C3%BAn\">nombre com&uacute;n</a>&nbsp;a la atracci&oacute;n que las&nbsp;<a href=\"https:es.wikipedia.org/wiki/Oruga_(larva)\">orugas</a>&nbsp;de esta especie sienten por la&nbsp;<a href=\"https:es.wikipedia.org/wiki/Brassica_oleracea\">col</a>.<a href=\"https:es.wikipedia.org/wiki/Pieris_rapae#cite_note-2\">2</a>​</p> <p>Mide de 30 a 50 mm de envergadura. La larva alcanza 35 mm de longitud. Es muy parecida a&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Pieris_brassicae\">Pieris brassicae</a></em>&nbsp;o blanca de la col, aunque de menor tama&ntilde;o. Tambi&eacute;n se diferencia de estas porque carece de una banda negra cerca de la punta del borde de las alas anteriores.<a href=\"https:es.wikipedia.org/wiki/Pieris_rapae#cite_note-3\">3</a>​</p> <h2>Distribuci&oacute;n y h&aacute;bitat<a href=\"https:es.wikipedia.org/w/index.php?title=Pieris_rapae&amp;action=edit&amp;section=1\">editar</a></h2> <p>Est&aacute; muy extendida en toda&nbsp;<a href=\"https:es.wikipedia.org/wiki/Europa\">Europa</a>,&nbsp;<a href=\"https:es.wikipedia.org/wiki/Norte_de_%C3%81frica\">norte de &Aacute;frica</a>&nbsp;y&nbsp;<a href=\"https:es.wikipedia.org/wiki/Asia\">Asia</a>.<a href=\"https:es.wikipedia.org/wiki/Pieris_rapae#cite_note-Tolman-Lewington-4\">4</a>​ Tambi&eacute;n ha sido&nbsp;<a href=\"https:es.wikipedia.org/wiki/Especie_introducida\">introducida</a>&nbsp;accidentalmente en&nbsp;<a href=\"https:es.wikipedia.org/wiki/Am%C3%A9rica_del_Norte\">Am&eacute;rica del Norte</a>,&nbsp;<a href=\"https:es.wikipedia.org/wiki/Australia\">Australia</a>&nbsp;y&nbsp;<a href=\"https:es.wikipedia.org/wiki/Nueva_Zelanda\">Nueva Zelanda</a>, donde se ha convertido en plaga en coles cultivadas y otros cultivos.</p> <p>Su&nbsp;<a href=\"https:es.wikipedia.org/wiki/H%C3%A1bitat\">h&aacute;bitat</a>&nbsp;es muy diverso, aunque prefiere espacios abiertos. Se la encuentra preferentemente casi en cualquier lugar donde haya&nbsp;<a href=\"https:es.wikipedia.org/wiki/Brassicaceae\">cruc&iacute;feras</a>, y en menor medida&nbsp;<a href=\"https:es.wikipedia.org/wiki/Capparaceae\">caparid&aacute;ceas</a>,&nbsp;<a href=\"https:es.wikipedia.org/wiki/Tropaeolaceae\">tropeol&aacute;ceas</a>,&nbsp;<a href=\"https:es.wikipedia.org/wiki/Resedaceae\">resed&aacute;ceas</a>&nbsp;y&nbsp;<a href=\"https:es.wikipedia.org/wiki/Chenopodioideae\">quenopodi&aacute;ceas</a>.<a href=\"https:es.wikipedia.org/wiki/Pieris_rapae#cite_note-Tolman-Lewington-4\">4</a>​</p> <h3>Selecci&oacute;n de planta hospedera<a href=\"https:es.wikipedia.org/w/index.php?title=Pieris_rapae&amp;action=edit&amp;section=2\">editar</a></h3> <p>Todas las plantas hospederas conocidas tienen sustancias qu&iacute;micas llamadas&nbsp;<a href=\"https:es.wikipedia.org/wiki/Glucosinolato\">glucosinolatos</a>, que son la se&ntilde;al que la hembra necesita para la postura de huevos.</p> <p>Plantas hospederas:</p> <ul> <li><a href=\"https:es.wikipedia.org/wiki/Brassicaceae\">Brassicaceae</a>:&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Arabis_glabra\">Arabis glabra</a></em>,&nbsp;<em><a href=\"https:es.wikipedia.org/w/index.php?title=Armoracia_lapthifolia&amp;action=edit&amp;redlink=1\">Armoracia lapthifolia</a></em>,&nbsp;<em><a href=\"https:es.wikipedia.org/w/index.php?title=Armoracia_aquatica&amp;action=edit&amp;redlink=1\">Armoracia aquatica</a></em>,&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Barbarea_vulgaris\">Barbarea vulgaris</a></em>,&nbsp;<em><a href=\"https:es.wikipedia.org/w/index.php?title=Barbarea_orthoceras&amp;action=edit&amp;redlink=1\">Barbarea orthoceras</a></em>,&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Barbarea_verna\">Barbarea verna</a></em>,&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Brassica_oleracea\">Brassica oleracea</a></em>,&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Brassica_rapa\">Brassica rapa</a></em>,&nbsp;<em><a href=\"https:es.wikipedia.org/w/index.php?title=Brassica_caulorapa&amp;action=edit&amp;redlink=1\">Brassica caulorapa</a></em>,&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Brassica_napus\">Brassica napus</a></em>,&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Brassica_juncea\">Brassica juncea</a></em>,&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Brassica_hirta\">Brassica hirta</a></em>,&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Brassica_nigra\">Brassica nigra</a></em>,&nbsp;<em><a href=\"https:es.wikipedia.org/w/index.php?title=Brassica_tula&amp;action=edit&amp;redlink=1\">Brassica tula</a></em>,&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Cardaria_draba\">Cardaria draba</a></em>,&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Capsella_bursa-pastoris\">Capsella bursa-pastoris</a></em>&nbsp;(la hembra deposita huevos pero las larvas no crecen),&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Dentaria_diphylla\">Dentaria diphylla</a></em>,&nbsp;<em><a href=\"https:es.wikipedia.org/w/index.php?title=Descurainia_Sophia&amp;action=edit&amp;redlink=1\">Descurainia Sophia</a></em>,&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Eruca_sativa\">Eruca sativa</a></em>,&nbsp;<em><a href=\"https:es.wikipedia.org/w/index.php?title=Erysimum_perenne&amp;action=edit&amp;redlink=1\">Erysimum perenne</a></em>,&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Lobularia_maritima\">Lobularia maritima</a></em>,&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Lunaria_annua\">Lunaria annua</a></em>&nbsp;(retarda el desarrollo larval),&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Matthiola_incana\">Matthiola incana</a></em>,&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Nasturtium_officinale\">Nasturtium officinale</a></em>,&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Raphanus_sativus\">Raphanus sativus</a></em>,&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Raphanus_raphanistrum\">Raphanus raphanistrum</a></em>,&nbsp;<em><a href=\"https:es.wikipedia.org/w/index.php?title=Rorippa_curvisiliqua&amp;action=edit&amp;redlink=1\">Rorippa curvisiliqua</a></em>,&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Rorippa_islandica\">Rorippa islandica</a></em>,&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Sisymbrium_irio\">Sisymbrium irio</a></em>,&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Sisymbrium_altissimum\">Sisymbrium altissimum</a></em>,&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Sisymbrium_officinale\">Sisymbrium officinale</a></em>&nbsp;(y var.&nbsp;<em>leicocarpum</em>),&nbsp;<em><a href=\"https:es.wikipedia.org/w/index.php?title=Streptanthus_tortuosus&amp;action=edit&amp;redlink=1\">Streptanthus tortuosus</a></em>,&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Thlaspi_arvense\">Thlaspi arvense</a></em>&nbsp;(retarda el desarrollo larval o lo impide)</li> <li><a href=\"https:es.wikipedia.org/wiki/Capparidaceae\">Capparidaceae</a>:&nbsp;<em><a href=\"https:es.wikipedia.org/w/index.php?title=Cleome_serrulata&amp;action=edit&amp;redlink=1\">Cleome serrulata</a></em>,&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Capparis_sandwichiana\">Capparis sandwichiana</a></em></li> <li><a href=\"https:es.wikipedia.org/wiki/Tropaeolaceae\">Tropaeolaceae</a>:&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Tropaeolum_majus\">Tropaeolum majus</a></em></li> <li><a href=\"https:es.wikipedia.org/wiki/Resedaceae\">Resedaceae</a>:&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Reseda_odorata\">Reseda odorata</a></em>.<a href=\"https:es.wikipedia.org/wiki/Pieris_rapae#cite_note-Scott_1986-5\">5</a>​</li> </ul> <h3>Como especie invasora<a href=\"https:es.wikipedia.org/w/index.php?title=Pieris_rapae&amp;action=edit&amp;section=3\">editar</a></h3> <p>Es considerada una plaga en los lugares en donde es una&nbsp;<a href=\"https:es.wikipedia.org/wiki/Especie_invasora\">especie invasora</a>&nbsp;que hace da&ntilde;o a los cultivos de coles y plantas relacionadas. En Norteam&eacute;rica las avispillas&nbsp;<a href=\"https:es.wikipedia.org/wiki/Parasitoide\">parasitoides</a>&nbsp;del g&eacute;nero&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Cotesia\">Cotesia</a></em>,&nbsp;<em><a href=\"https:es.wikipedia.org/w/index.php?title=Cotesia_rubecula&amp;action=edit&amp;redlink=1\">C. rubecula</a></em>&nbsp;y&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Cotesia_glomerata\">C. glomerata</a></em>, han sido introducidas desde Asia como&nbsp;<a href=\"https:es.wikipedia.org/wiki/Control_biol%C3%B3gico\">controles biol&oacute;gicos</a>&nbsp;para combatir a&nbsp;<em>P. rapae</em>.<a href=\"https:es.wikipedia.org/wiki/Pieris_rapae#cite_note-:0-6\">6</a>​</p>', 'blanquita-de-la-col', 1, '2023-05-23 11:24:50'),
(9, 10, 'Vanessa Atalanta', 'Vanessa Atalanta', '', 'img/especies/vanessa-atalanta.jpg', '<p>La&nbsp;<strong>numerada</strong>,<a href=\"https:es.wikipedia.org/wiki/Vanessa_atalanta#cite_note-waste-2\">2</a>​<a href=\"https:es.wikipedia.org/wiki/Vanessa_atalanta#cite_note-3\">3</a>​<a href=\"https:es.wikipedia.org/wiki/Vanessa_atalanta#cite_note-4\">4</a>​&nbsp;<strong>vulcana</strong>,<a href=\"https:es.wikipedia.org/wiki/Vanessa_atalanta#cite_note-waste-2\">2</a>​&nbsp;<strong>vanesa</strong>, o&nbsp;<strong>almirante rojo</strong>, conocida popularmente tambi&eacute;n como&nbsp;<strong>atalanta</strong>&nbsp;(<em><strong>Vanessa atalanta</strong></em>) es una&nbsp;<a href=\"https:es.wikipedia.org/wiki/Especie\">especie</a>&nbsp;de&nbsp;<a href=\"https:es.wikipedia.org/wiki/Lepid%C3%B3ptero\">lepid&oacute;ptero</a>&nbsp;<a href=\"https:es.wikipedia.org/wiki/Ditrisio\">ditrisio</a>&nbsp;de la&nbsp;<a href=\"https:es.wikipedia.org/wiki/Familia_(biolog%C3%ADa)\">familia</a>&nbsp;<a href=\"https:es.wikipedia.org/wiki/Nymphalidae\">Nymphalidae</a>&nbsp;propia de&nbsp;<a href=\"https:es.wikipedia.org/wiki/Europa\">Europa</a>,&nbsp;<a href=\"https:es.wikipedia.org/wiki/Asia\">Asia</a>&nbsp;y&nbsp;<a href=\"https:es.wikipedia.org/wiki/Norteam%C3%A9rica\">Norteam&eacute;rica</a>.<a href=\"https:es.wikipedia.org/wiki/Vanessa_atalanta#cite_note-:0-5\">5</a>​</p> <h2>Descripci&oacute;n</h2> <p>Se caracteriza por sus alas marr&oacute;n oscuro, rojo y negro. La&nbsp;<a href=\"https:es.wikipedia.org/wiki/Oruga_(larva)\">oruga</a>&nbsp;se alimenta de&nbsp;<a href=\"https:es.wikipedia.org/wiki/Ortiga\">ortigas</a>, y el adulto liba&nbsp;<a href=\"https:es.wikipedia.org/wiki/N%C3%A9ctar_(bot%C3%A1nica)\">n&eacute;ctar</a>&nbsp;de flores como las del g&eacute;nero&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Buddleja\">Buddleja</a></em>; tambi&eacute;n se alimenta de&nbsp;<a href=\"https:es.wikipedia.org/wiki/Fruta\">fruta</a>&nbsp;muy madura.</p> <h2>Distribuci&oacute;n</h2> <p>Se encuentra en las regiones templadas del norte de &Aacute;frica, Am&eacute;rica del norte y central, Europa, Asia y en las islas de Haw&aacute;i y del Caribe.<a href=\"https:es.wikipedia.org/wiki/Vanessa_atalanta#cite_note-:0-5\">5</a>​En el norte&nbsp;<a href=\"https:es.wikipedia.org/wiki/Europa\">Europa</a>&nbsp;es una de las &uacute;ltimas mariposas en desaparecer antes del&nbsp;<a href=\"https:es.wikipedia.org/wiki/Invierno\">invierno</a>. Los ejemplares que hibernan suelen ser de colores m&aacute;s intensos que la otra generaci&oacute;n. La mariposa tambi&eacute;n vuela durante d&iacute;as soleados de invierno, sobre todo en el sur Europa. En Norteam&eacute;rica, generalmente vuela de marzo a octubre; pasa el invierno en Texas.</p> <p><a href=\"https:es.wikipedia.org/wiki/Archivo:Vanessa_atalanta_en_el_Generalife.jpg\"><img src=\"https:upload.wikimedia.org/wikipedia/commons/thumb/f/f4/Vanessa_atalanta_en_el_Generalife.jpg/220px-Vanessa_atalanta_en_el_Generalife.jpg\" style=\"height:160px; width:220px\" /></a></p> <p>Vanessa atalanta en el Generalife</p> <h2>Migraci&oacute;n</h2> <p>En oto&ntilde;o tiene lugar una&nbsp;<a href=\"https:es.wikipedia.org/wiki/Migraci%C3%B3n_de_insectos\">migraci&oacute;n</a>&nbsp;masiva hacia el sur. A fines de oto&ntilde;o o principios de invierno se aparea. Los cardos, que son sus plantas hospederas son m&aacute;s abundantes en esa &eacute;poca. El desarrollo larvario procede durante el invierno y los adultos emergen en la primavera temprana. La nueva generaci&oacute;n emigra hacia el norte; las plantas de que se alimentan han disminuido en esa &eacute;poca.<a href=\"https:es.wikipedia.org/wiki/Vanessa_atalanta#cite_note-6\">6</a>​ Durante la migraci&oacute;n las mariposas vuelan a gran altitud donde los vientos las llevan, lo cual les ahorra energ&iacute;a.<a href=\"https:es.wikipedia.org/wiki/Vanessa_atalanta#cite_note-7\">7</a>​</p> <h2>Ciclo de vida</h2> <ul> <li> <p><a href=\"https:es.wikipedia.org/wiki/Archivo:Egg-butterfly-vulcan-oeuf-papillon-vulcain-vanessa-atalanta-2.jpg\"><img alt=\"Huevos\" src=\"https:upload.wikimedia.org/wikipedia/commons/thumb/d/d4/Egg-butterfly-vulcan-oeuf-papillon-vulcain-vanessa-atalanta-2.jpg/160px-Egg-butterfly-vulcan-oeuf-papillon-vulcain-vanessa-atalanta-2.jpg\" style=\"height:120px; width:107px\" /></a></p> <p>Huevos</p> </li> <li>&nbsp;</li> <li> <p><a href=\"https:es.wikipedia.org/wiki/Archivo:Vanessa.atalanta.caterpillars.jpg\"><img alt=\"Oruga, estadio temprano\" src=\"https:upload.wikimedia.org/wikipedia/commons/thumb/6/61/Vanessa.atalanta.caterpillars.jpg/270px-Vanessa.atalanta.caterpillars.jpg\" style=\"height:120px; width:180px\" /></a></p> <p>Oruga, estadio temprano</p> </li> <li>&nbsp;</li> <li> <p><a href=\"https:es.wikipedia.org/wiki/Archivo:Vanessa_atalanta_Raupe_(HS).jpg\"><img alt=\"Oruga, estadio tardío\" src=\"https:upload.wikimedia.org/wikipedia/commons/thumb/2/25/Vanessa_atalanta_Raupe_%28HS%29.jpg/135px-Vanessa_atalanta_Raupe_%28HS%29.jpg\" style=\"height:120px; width:90px\" /></a></p> <p>Oruga, estadio tard&iacute;o</p> </li> <li>&nbsp;</li> <li> <p><a href=\"https:es.wikipedia.org/wiki/Archivo:Chrysalis-butterfly-vulcan-chrysalide-papillon-vulcain-vanessa-atalanta-2.jpg\"><img alt=\"Crisálida\" src=\"https:upload.wikimedia.org/wikipedia/commons/thumb/d/d0/Chrysalis-butterfly-vulcan-chrysalide-papillon-vulcain-vanessa-atalanta-2.jpg/96px-Chrysalis-butterfly-vulcan-chrysalide-papillon-vulcain-vanessa-atalanta-2.jpg\" style=\"height:120px; width:64px\" /></a></p> <p>Cris&aacute;lida</p> </li> <li>&nbsp;</li> <li> <p><a href=\"https:es.wikipedia.org/wiki/Archivo:Red_Admiral_I_IMG_7045.jpg\"><img alt=\"Adulto\" src=\"https:upload.wikimedia.org/wikipedia/commons/thumb/8/8c/Red_Admiral_I_IMG_7045.jpg/201px-Red_Admiral_I_IMG_7045.jpg\" style=\"height:120px; width:134px\" /></a></p> <p>Adulto</p> </li> </ul>', 'vanessa-atalanta', 1, '2023-05-23 11:29:02'),
(10, 10, 'Vanessa Cardui', 'Vanessa De Los Cardos', '', 'img/especies/vanessa-de-los-cardos.jpg', '<p>La&nbsp;<strong>vanesa de los cardos</strong>&nbsp;(<em><strong>Vanessa cardui</strong></em>) es una&nbsp;<a href=\"https:es.wikipedia.org/wiki/Especie\">especie</a>&nbsp;de&nbsp;<a href=\"https:es.wikipedia.org/wiki/Lepid%C3%B3ptero\">lepid&oacute;ptero</a>&nbsp;<a href=\"https:es.wikipedia.org/wiki/Ditrisio\">ditrisio</a>&nbsp;de la&nbsp;<a href=\"https:es.wikipedia.org/wiki/Familia_(biolog%C3%ADa)\">familia</a>&nbsp;<a href=\"https:es.wikipedia.org/wiki/Nymphalidae\">Nymphalidae</a>. Es una de las mariposas de mayor distribuci&oacute;n geogr&aacute;fica, encontr&aacute;ndose en todos los continentes menos en la&nbsp;<a href=\"https:es.wikipedia.org/wiki/Ant%C3%A1rtida\">Ant&aacute;rtida</a>. Puede vivir en cualquier zona templada, incluyendo las monta&ntilde;as en los&nbsp;<a href=\"https:es.wikipedia.org/wiki/Tr%C3%B3pico\">tr&oacute;picos</a>. Es una especie&nbsp;<a href=\"https:es.wikipedia.org/wiki/Migraci%C3%B3n_de_insectos\">migratoria</a>, residente permanente en &aacute;reas c&aacute;lidas que llega a otras regiones parte del a&ntilde;o.</p> <p>Otras especies cercanas son&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Vanessa_kershawi\">Vanessa kershawi</a></em>&nbsp;(a veces considerada como una subespecie),&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Vanessa_virginiensis\">Vanessa virginiensis</a></em>&nbsp;y&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Vanessa_annabella\">Vanessa annabella</a></em>.</p> <h2>Descripci&oacute;n</h2> <p>La vanessa de los cardos es una mariposa grande (de 5 a 9&nbsp;<a href=\"https:es.wikipedia.org/wiki/Cent%C3%ADmetro\">cm</a>) caracterizada por sus esquinas blancas y negras en las alas principalmente naranjas con puntos negros. Los huevos tardan dos semanas en eclosionar, una vez eclosionados, la&nbsp;<a href=\"https:es.wikipedia.org/wiki/Oruga_(larva)\">oruga</a>&nbsp;toma de siete a once d&iacute;as en convertirse en una&nbsp;<a href=\"https:es.wikipedia.org/wiki/Cris%C3%A1lida\">cris&aacute;lida</a>&nbsp;y le toma a la cris&aacute;lida otros siete a once d&iacute;as en convertirse en&nbsp;<a href=\"https:es.wikipedia.org/wiki/Imago_(zoolog%C3%ADa)\">imago</a>&nbsp;o adulto.</p> <h2>Migraci&oacute;n</h2> <p>La vanesa de los cardos no se queda en un &aacute;rea espec&iacute;fica mucho tiempo, puede llegar a recorrer 1.600&nbsp;<a href=\"https:es.wikipedia.org/wiki/Km\">km</a>&nbsp;durante toda su vida. Tiene una&nbsp;<a href=\"https:es.wikipedia.org/wiki/Migraci%C3%B3n_de_insectos\">migraci&oacute;n</a>&nbsp;de 14.000 km desde Gran Breta&ntilde;a y Suecia hasta &Aacute;frica occidental que requiere hasta seis generaciones.<a href=\"https:es.wikipedia.org/wiki/Vanessa_cardui#cite_note-1\">1</a>​ Vuelan a grandes alturas, por eso sus movimientos no han sido bien observados hasta &eacute;pocas recientes.<a href=\"https:es.wikipedia.org/wiki/Vanessa_cardui#cite_note-BirdGuides-2\">2</a>​</p> <h2>Ciclo de vida</h2> <p>Depositan sus huevos donde encuentran n&eacute;ctar abundante. No parecen reconocer las plantas hospederas, como muchas otras especies. Esto puede causar alta mortalidad de los huevos que no hayan sido depositados en las plantas hospederas.<a href=\"https:es.wikipedia.org/wiki/Vanessa_cardui#cite_note-3\">3</a>​ Producen una gran cantidad de huevos; hay mayor dependencia en una progenie numerosa que en supervivencia.<a href=\"https:es.wikipedia.org/wiki/Vanessa_cardui#cite_note-4\">4</a>​</p> <h2>Plantas nutricias</h2> <p>Las orugas se alimentan de una variedad de plantas de la familia de las&nbsp;<a href=\"https:es.wikipedia.org/wiki/Asteraceae\">aster&aacute;ceas</a>, especialmente de&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Carduus_crispus\">Carduus crispus</a></em>. Tambi&eacute;n se alimentan de las&nbsp;<a href=\"https:es.wikipedia.org/wiki/Boraginaceae\">boragin&aacute;ceas</a>,&nbsp;<a href=\"https:es.wikipedia.org/wiki/Malvaceae\">malv&aacute;ceas</a>&nbsp;(especialmente&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Alcea\">Alcea</a></em>&nbsp;y&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Malva_neglecta\">Malva neglecta</a></em>). Los adultos liban n&eacute;ctar de una gran variedad de&nbsp;<a href=\"https:es.wikipedia.org/wiki/Flor_silvestre\">flores silvestres</a>&nbsp;y&nbsp;<a href=\"https:es.wikipedia.org/wiki/Cultivar\">flores cultivadas</a>. Las m&aacute;s comunes son el&nbsp;<a href=\"https:es.wikipedia.org/wiki/Cardo\">cardo</a>&nbsp;(del cual deriva su nombre),&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Buddleja\">Buddleja</a></em>,&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Aster\">Aster</a></em>,&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Bidens\">Bidens</a></em>&nbsp;y&nbsp;<em><a href=\"https:es.wikipedia.org/wiki/Zinnia\">Zinnia</a></em></p>', 'vanessa-de-los-cardos', 1, '2023-05-23 11:30:17'),
(14, 12, 'Polyommatus Bellargus', 'Adonis Blue', '', 'img/especies/adonis-blue.jpg', '<h1><strong>General</strong></h1> <p>Esta hermosa especie de mariposa es una de las m&aacute;s caracter&iacute;sticas de las tierras bajas calc&aacute;reas del sur no mejoradas, donde se la puede ver volando a baja altura sobre c&eacute;sped poco pastoreado (por lo general, laderas empinadas orientadas al sur).</p> <p>Los machos tienen alas de color azul cielo brillante, mientras que las hembras son de color marr&oacute;n chocolate y mucho menos llamativas.&nbsp;Ambos sexos tienen l&iacute;neas negras distintivas que entran o cruzan las franjas blancas de las alas.</p> <p>Los huevos blancos con forma de disco texturizado se ponen individualmente debajo de las hojas j&oacute;venes de Horseshoe Vetch sin sombrear en mayo-junio y agosto-septiembre.&nbsp;Se pueden encontrar m&aacute;s f&aacute;cilmente en septiembre, cuando la veza de herradura sin sombrear crece en c&eacute;sped corto.</p> <p>El Adonis Blue pasa el invierno como una oruga;&nbsp;es de color verde con rayas amarillas cortas, que lo camuflan mientras se alimenta de Horseshoe Vetch durante el d&iacute;a.&nbsp;Se ve m&aacute;s com&uacute;nmente durante abril y finales de julio, ya que busca hormigas para &quot;orde&ntilde;ar&quot; sus secreciones azucaradas.</p> <p>En abril-mayo y julio-agosto, la oruga se convierte en cris&aacute;lida en peque&ntilde;as grietas o huecos y luego las hormigas la entierran en c&aacute;maras de tierra conectadas al hormiguero.&nbsp;Las hormigas lo cuidan constantemente durante unas tres semanas, protegi&eacute;ndolo de los depredadores.</p> <p>Esta especie ha sufrido un importante declive en toda su &aacute;rea de distribuci&oacute;n pero, a pesar de su distribuci&oacute;n restringida, en buenos sitios se pueden ver varios cientos, ya que recientemente se ha reexpandido en algunas regiones.<br /> <br /> Las colonias var&iacute;an en tama&ntilde;o considerablemente de un a&ntilde;o a otro, dependiendo del clima.&nbsp;Se pueden ver muchos miles emergiendo hacia el final de un verano caluroso, en contraste con menos de cien de una emergencia de primavera.</p> <h1><strong>Tama&ntilde;o y Familia</strong></h1> <ul> <li>Familia: Blues</li> <li>Tama&ntilde;o: Peque&ntilde;o/Mediano</li> <li>Rango de envergadura de ala (macho a hembra): 38 mm</li> </ul> <h1><strong>Estado de conservaci&oacute;n</strong></h1> <ul> <li>UK BAP: No listado (anteriormente Prioritario)&nbsp;</li> <li>Mariposa Prioridad de conservaci&oacute;n: Media &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</li> <li>Estatus europeo: No amenazado &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</li> <li>Protegido bajo el Anexo 5 de la Ley de Vida Silvestre y Campo de 1981 (solo para la venta)</li> </ul> <h1><strong>Planta de alimentaci&oacute;n de oruga</strong></h1> <p>La &uacute;nica planta alimenticia es la veza de herradura (&nbsp;<em>Hippocrepis comosa</em>&nbsp;).</p>', 'adonis-blue', 1, '2023-05-28 16:23:59'),
(15, 13, 'Libytheana Carinenta', 'American Snout', '', 'img/especies/american-snout.jpg', '<h1>Descripci&oacute;n</h1> <p>Los hocicos americanos tienen palpos labiales (piezas bucales) muy alargados que los hacen parecer tener &quot;narices&quot; largas.&nbsp;Solo hay una especie de mariposa hocico en Am&eacute;rica del Norte.&nbsp;Las alas anteriores son alargadas con las puntas de las alas cuadradas.&nbsp;El patr&oacute;n del ala dorsal es anaranjado con amplios bordes oscuros con manchas blancas.&nbsp;Vistas desde abajo en espec&iacute;menes posados, las alas generalmente muestran solo los bordes de las alas de color marr&oacute;n moteado y gris violeta, aunque las alas anteriores se ven m&aacute;s o menos iguales en ambos lados.&nbsp;Cuando est&aacute; posada en una ramita, mostrando solo los bordes grises de las alas anteriores, una mariposa de hocico es pr&aacute;cticamente invisible.</p> <p>Las orugas son verdes con rayas amarillas a lo largo de la espalda y los lados, y numerosas motas amarillas diminutas.&nbsp;Las orugas m&aacute;s viejas son de color verde oscuro.&nbsp;La porci&oacute;n del t&oacute;rax est&aacute; agrandada, con dos tub&eacute;rculos negros (protuberancias elevadas).</p> <h1>Tama&ntilde;o</h1> <p>Envergadura: 1&ndash;2 pulgadas.</p>', 'american-snout', 1, '2023-05-28 16:32:23'),
(16, 14, 'Diaethria Anna', 'Diaethria Anna', '', 'img/especies/diaethria-anna.jpg', '<p>La mariposa 88 (Diaethria&nbsp;<em>clymena</em>&nbsp;) es una de las muchas mariposas ex&oacute;ticas y misteriosas que se consideran tesoros naturales de la selva amaz&oacute;nica subtropical.&nbsp;Son miembros de la tribu Callicorini, el g&eacute;nero Diaethria es tambi&eacute;n el tercer g&eacute;nero m&aacute;s diverso de la tribu Callicorini, bastante extensa.&nbsp;La D. clymena fue descrita por primera vez por&nbsp;<a href=\"http:en.wikipedia.org/wiki/Pieter_Cramer\">el entom&oacute;logo Pieter Cramer</a>&nbsp;en 1775. Estas mariposas a menudo se confunden con otras mariposas Diaethria como la&nbsp;<a href=\"http:www.amazon.com/Butterfly-Diaethria-Neglecta-Mounted-Display/dp/B007574QGU\" target=\"_blank\">mariposa 89, Diaethria&nbsp;<em>negligencia</em></a>.&nbsp;Los errores comunes a menudo son el resultado de detalles que se pasan por alto f&aacute;cilmente en los patrones familiares entre las especies del g&eacute;nero.&nbsp;La &uacute;nica forma de diferenciarlos es distinguir la cantidad de lectura y el espaciado en los patrones familiares, algo as&iacute; como una etapa experta para detectar la diferencia.&nbsp;Esto, debo decir, es una de las partes m&aacute;s dif&iacute;ciles de identificar mariposas a nivel de especie y de forma a&uacute;n m&aacute;s compleja.</p> <p>Como adultos (mariposas), les gustan especialmente las frutas podridas y los parches arenosos empapados de orina a lo largo de los bordes de los r&iacute;os de la vegetaci&oacute;n del bosque secundario.&nbsp;Las plantas hu&eacute;sped de las larvas son las Trema, que pertenecen a la familia de plantas con flores Ulmaceae.&nbsp;Son criaturas t&iacute;midas, que saltan de parche en parche ante las m&aacute;s m&iacute;nimas molestias.&nbsp;Cuando no est&aacute;n en lugares de agregaci&oacute;n de mariposas, se pueden encontrar en peque&ntilde;os grupos de no m&aacute;s de un pu&ntilde;ado a la vez.</p> <p>Una caracter&iacute;stica &uacute;nica que la D. clymena comparte con la mariposa Hamadrya, la mariposa Cracker recientemente discutida, es la capacidad de o&iacute;r.&nbsp;Tienen lo que se conoce como &oacute;rgano de Vogel, un instrumento auditivo basado en el t&iacute;mpano (palabra elegante para orejas) que se encuentra en la base de las alas anteriores.</p>', 'diaethria-anna', 1, '2023-05-28 16:36:52'),
(17, 8, 'Papilio Crino Fabricius', 'Papilio Crino', '', 'img/especies/papilio-crino.jpg', '<p>Esta especie se parece a&nbsp;<em><a href=\"https:en.wikipedia.org/wiki/Papilio_palinurus\">Papilio palinurus</a></em>&nbsp;, pero el macho generalmente tiene, en la parte superior de la mitad externa de las alas anteriores, rayas olfativas algodonosas o peludas similares a las de&nbsp;<em><a href=\"https:en.wikipedia.org/wiki/Papilio_polyctor\">Papilio polyctor</a></em>&nbsp;, solo que siempre falta la raya en el espacio intermedio 1.&nbsp;Otras diferencias se ven en el ala superior.&nbsp;El ala anterior tiene la banda discal transversal de color verde azulado ligeramente sinuosa, m&aacute;s angosta, m&aacute;s curva que en&nbsp;<em>P. palinurus</em>&nbsp;y m&aacute;s claramente decreciente en ancho hacia el margen costal;&nbsp;en la hembra es m&aacute;s sinuoso que en el macho.&nbsp;El ala trasera tiene la banda transversal de color verde azulado muy variable en anchura pero el margen interior es mucho m&aacute;s recto que en&nbsp;<em>P. polyctor</em>&nbsp;;&nbsp;esta banda que en&nbsp;<em>P. polyctor</em>se detiene antes de la vena 7, contin&uacute;a hasta el margen costal, sin embargo, se estrecha mucho y abruptamente por encima de la vena 7;&nbsp;tornal ocelo rojo burdeos con un gran centro negro bordeado interiormente de azul;&nbsp;la l&uacute;nula subapical de color ocr&aacute;ceo brillante de&nbsp;<em>P. polyctor</em>&nbsp;reemplazada por una mancha blanquecina opaca;&nbsp;las l&uacute;nulas verdes difusas subterminales restringidas a los espacios intermedios 2, 3 y 4;&nbsp;el &aacute;pice espatular de la cola con un peque&ntilde;o parche de escamas de color verde azulado.&nbsp;<a href=\"https:www.argentinat.org/taxa/124567-Papilio-crino#cite_note-bing-3\">3</a></p> <p>En la parte inferior de las alas, el color de fondo es de un marr&oacute;n p&aacute;lido opaco a un marr&oacute;n negruzco irrotado (salpicado) con escamas amarillentas dispersas que, sin embargo, en el ala anterior est&aacute;n ausentes de un gran parche discal triangular que se encuentra entre el dorso, la vena mediana, vena 5 y una l&iacute;nea de l&uacute;nulas blancas que cruza el ala en una curva hacia afuera desde el tercio superior de la costa hasta justo antes del&nbsp;<a href=\"https:en.wikipedia.org/wiki/Glossary_of_entomology_terms\">tornus</a>;&nbsp;estas l&uacute;nulas blancas son difusas hacia el exterior y se fusionan gradualmente con el color de fondo marr&oacute;n.&nbsp;En las alas traseras, el ocelo tornal tanto como en la parte superior;&nbsp;una banda angosta blanquecina posdiscal muy arqueada oscura y mal definida desde arriba del ocelo tornal hasta la costa, termina cerca del &aacute;pice del espacio intermedio 7 en una l&uacute;nula blanca ancha;&nbsp;m&aacute;s all&aacute; de esto, una doble fila subterminal de l&uacute;nulas de color blanco ocre algo rectas en los espacios intermedios, cada l&uacute;nula de la fila interior bordeada exteriormente con azul, este borde muy tenue en muchos espec&iacute;menes.&nbsp;Los cilios de las alas anteriores y posteriores son marrones alternados con blancos.&nbsp;Antenas, cabeza, t&oacute;rax y abdomen negro pardusco oscuro;&nbsp;la cabeza, el t&oacute;rax y el abdomen arriba con una salpicadura de escamas verdes brillantes.&nbsp;<a href=\"https:www.argentinat.org/taxa/124567-Papilio-crino#cite_note-bing-3\">3&nbsp;</a><a href=\"https:www.argentinat.org/taxa/124567-Papilio-crino#cite_note-MooreIndica-4\">4</a></p> <h3><strong>Expansi&oacute;n:</strong></h3> <p>100&ndash;116 mm</p>', 'papilio-crino', 1, '2023-05-28 16:42:07'),
(18, 15, 'Pontia Beckerii', 'Beckers White', '', 'img/especies/beckers-white.jpg', '<h1><strong>Descripci&oacute;n general</strong></h1> <hr /> <p> De Ferris y Brown 1981; Scott 1986; Opler y Wright 1999; Glassberg 2001; Pyle 2002  Avance 2.2-2.7 cm. Color base blanco. Superficie superior con parche negro cuadrado fuerte en el extremo de la celda del ala anterior, marcas negras m&aacute;s peque&ntilde;as en el tercio externo del ala anterior y el ala posterior; superficie inferior del ala anterior con gran caja negra al final de la celda con bordes amarillo-verde relativamente delgados a lo largo de las puntas de las venas, ala posterior con amplios bordes amarillo-verde a lo largo de las venas.</p> <h1><strong>Fenolog&iacute;a</strong></h1> <hr /> <p>De dos a cuatro vuelos; principalmente de abril a septiembre, de marzo a octubre en el sur de Nevada ( Scott 1986 ). Principalmente de mayo a agosto, de marzo a agosto en desiertos del suroeste ( Glassberg 2001 ). Principios de abril a octubre en Colorado ( Scott y Scott 1978; Ferris y Brown 1981 ), mediados de marzo a mediados de septiembre en Oregon y Washington ( Pyle 2002 ), finales de marzo a mediados de septiembre en Oregon ( Warren 2005 ), finales de abril a finales de septiembre en Columbia Brit&aacute;nica ( Guppy y Shepard 2001 ).</p> <p>&nbsp;</p> <h1><strong>Caracter&iacute;sticas de diagn&oacute;stico</strong></h1> <hr /> <p>Mejor determinado por el fuerte parche negro cuadrado en el extremo de la celda del ala anterior, peque&ntilde;as marcas negras en el tercio externo del ala anterior y el ala posterior, superficie del ala anterior con delgados bordes amarillo-verde a lo largo de las puntas de las venas, ala posterior con amplios bordes amarillo-verde a lo largo de las venas.</p>', 'beckers-white', 1, '2023-05-28 16:47:52'),
(19, 16, 'Satyrium Pruni', 'Black Hairstreak', '', 'img/especies/black-hairstreak.jpg', '<p>El Black Hairstreak es una de nuestras mariposas m&aacute;s raras y una de las m&aacute;s descubiertas recientemente, debido a la similitud con su primo cercano, el White-letter Hairstreak. Esta especie se descubri&oacute; por primera vez en las Islas Brit&aacute;nicas en 1828 cuando un Sr. Seaman, un comerciante entomol&oacute;gico, recolect&oacute; espec&iacute;menes de uno de los sitios m&aacute;s famosos para esta especie: Monk&#39;s Wood en&nbsp;<a href=\"https:www.ukbutterflies.co.uk/vicecounties.php\">Cambridgeshire</a>. Se pens&oacute; que eran espec&iacute;menes del Hairstreak de letra blanca hasta que Edward Newman, un entom&oacute;logo victoriano notable, los declar&oacute; Black Hairstreak.</p> <p>Esta mariposa no es un gran vagabundo y una colonia entera a menudo se limitar&aacute; a un solo &aacute;rea dentro de un bosque, a pesar de que hay un h&aacute;bitat adecuado cerca. La incapacidad de colonizar nuevas &aacute;reas a un ritmo equilibrado con la p&eacute;rdida de h&aacute;bitat puede explicar parcialmente la escasez de esta especie. Esta mariposa tiene una distribuci&oacute;n muy restringida que sigue una l&iacute;nea de arcillas entre&nbsp;<a href=\"https:www.ukbutterflies.co.uk/vicecounties.php\">Oxfordshire</a>&nbsp;en el suroeste y&nbsp;<a href=\"https:www.ukbutterflies.co.uk/vicecounties.php\">Cambridgeshire</a>&nbsp;en el noreste.</p> <h1><strong>H&aacute;bitat</strong></h1> <p>Las colonias de Black Hairstreak se encuentran t&iacute;picamente en peque&ntilde;os bosques o setos cercanos, donde crece Blackthorn, la planta de alimentos larvarios. Wild Plum tambi&eacute;n se usa ocasionalmente. Los sitios se encuentran en posiciones protegidas pero soleadas y generalmente tienen un aspecto sur.</p>', 'black-hairstreak', 1, '2023-05-28 16:53:23'),
(20, 17, 'Parantica Sita', 'Chestnut', '', 'img/especies/chestnut.JPG', '<h1><strong>Referencia</strong></h1> <p>https:www.ifoundbutterflies.org/parantica-sita</p>', 'chestnut', 1, '2023-05-28 16:59:12'),
(21, 18, 'Parnassius Clodius Ménétriés', 'Clodius Parnassian', '', 'img/especies/clodius-parnassian.jpg', '<h1><strong>Referencias</strong></h1> <ol> <li>https:www.butterfliesandmoths.org/species/Parnassius-clodius</li> <li>https:www.catalogueoflife.org/data/taxon/763CM</li> </ol>', 'clodius-parnassian', 1, '2023-05-28 17:03:38'),
(22, 19, 'Colias Philodice', 'Clouded Sulphur', '', 'img/especies/clouded-sulphur.jpg', '<h1><strong>link</strong></h1> <ol> <li>https:www.catalogueoflife.org/data/taxon/3S9M</li> </ol>', 'clouded-sulphur', 1, '2023-05-29 00:38:33'),
(23, 6, 'Lycaena Arota', 'Copper Tail', '', 'img/especies/copper-tail.jpg', '<h1><strong>Link</strong></h1> <ol> <li><a href=\"https:catalogueoflife.org/data/taxon/9CJ2Q\" target=\"_blank\">https:www.catalogueoflife.org/data/taxon/9CJ2Q</a></li> <li><a href=\"https:butterfliesandmoths.org/species/Lycaena-arota\" target=\"_blank\">https:www.butterfliesandmoths.org/species/Lycaena-arota</a></li> </ol>', 'copper-tail', 1, '2023-05-29 00:44:27'),
(24, 20, 'Caligo Eurilochus', 'Mariposa Búho', '', 'img/especies/mariposa-buho.JPG', '', 'mariposa-buho', 1, '2023-06-08 21:23:36'),
(25, 3, 'Leenh Bustamante', 'Demo', '', 'img/especies/demo-asd.jpeg', '<p>Descripcioes</p> <p>geofrafia</p> <p>cilo</p> <p>fuentos</p> <p>&nbsp;</p>', 'demo', 0, '2023-06-15 20:43:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_especies_2`
--

CREATE TABLE `ma_especies_2` (
  `idespecie` int(11) NOT NULL,
  `idgenero` int(11) NOT NULL,
  `es_nombre_cientifico` varchar(255) NOT NULL,
  `es_nombre_comun` varchar(255) NOT NULL,
  `es_tamanio` varchar(255) NOT NULL,
  `es_imagen_url` varchar(255) NOT NULL,
  `es_descripcion` text NOT NULL,
  `es_slug` varchar(255) NOT NULL,
  `es_status` tinyint(1) NOT NULL DEFAULT '1',
  `es_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_familias`
--

CREATE TABLE `ma_familias` (
  `idfamilia` int(11) NOT NULL,
  `idsuperfamilia` int(11) NOT NULL,
  `fam_nombre` varchar(255) NOT NULL DEFAULT 'undefined'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_familias_1`
--

CREATE TABLE `ma_familias_1` (
  `idfamilia` int(11) NOT NULL,
  `idorden` int(11) NOT NULL,
  `fam_nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'undefined',
  `fam_descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'undefined',
  `fam_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ma_familias_1`
--

INSERT INTO `ma_familias_1` (`idfamilia`, `idorden`, `fam_nombre`, `fam_descripcion`, `fam_date`) VALUES
(1, 1, 'Nymphalidae', 'undefined', '2023-05-21 20:20:40'),
(3, 3, 'demo familia', 'undefined', '2023-05-21 22:05:37'),
(4, 1, 'Lycaenidae', 'undefined', '2023-05-22 22:43:33'),
(5, 1, 'Papilionidae', 'undefined', '2023-05-22 22:46:14'),
(6, 1, 'Pieridae', 'undefined', '2023-05-22 22:48:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_filos`
--

CREATE TABLE `ma_filos` (
  `idfilo` int(11) NOT NULL,
  `idreino` int(11) NOT NULL,
  `fi_nombre` varchar(200) NOT NULL DEFAULT 'undefined'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_generos`
--

CREATE TABLE `ma_generos` (
  `idgenero` int(11) NOT NULL,
  `idgeneros` int(11) NOT NULL,
  `gen_nombres` varchar(255) NOT NULL DEFAULT 'undefined'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_generos_1`
--

CREATE TABLE `ma_generos_1` (
  `idgenero` int(11) NOT NULL,
  `idsubfamilia` int(11) NOT NULL,
  `gen_nombres` varchar(255) NOT NULL DEFAULT 'undefined',
  `gen_descripcion` text NOT NULL,
  `gen_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ma_generos_1`
--

INSERT INTO `ma_generos_1` (`idgenero`, `idsubfamilia`, `gen_nombres`, `gen_descripcion`, `gen_date`) VALUES
(2, 1, 'Danaus Kluk', '', '2023-05-21 22:40:34'),
(3, 2, 'demo genero', '', '2023-05-21 22:40:51'),
(4, 3, 'Heliconius Kluk', '', '2023-05-22 22:38:34'),
(5, 4, 'Junonia Hübner', '', '2023-05-22 22:41:05'),
(6, 5, 'Lycaena Fabricius', '', '2023-05-22 22:44:04'),
(7, 5, 'Nymphalis Kluk', '', '2023-05-22 22:45:05'),
(8, 6, 'Papilio', '', '2023-05-22 22:47:10'),
(9, 7, 'Pieris', '', '2023-05-22 22:49:13'),
(10, 4, 'Vanessa Fabricius', 'family: Nymphalidae >subfamily: Nymphalinae >tribe: Nymphalini >genus: Vanessa Fabricius,', '2023-05-22 22:50:57'),
(11, 4, 'Nymphalis Kluk', '', '2023-05-23 11:19:38'),
(12, 8, 'Polyommatus Latreille', '', '2023-05-28 16:21:30'),
(13, 9, 'Libytheana Michener', '', '2023-05-28 16:30:01'),
(14, 10, 'Diaethria Billberg', '', '2023-05-28 16:35:21'),
(15, 7, 'Pontia', '', '2023-05-28 16:45:21'),
(16, 11, 'Satyrium Scudder', '', '2023-05-28 16:51:31'),
(17, 1, 'Parantica Moore', '', '2023-05-28 16:56:38'),
(18, 6, 'Parnassius', '', '2023-05-28 17:02:43'),
(19, 7, 'colias', '', '2023-05-29 00:37:22'),
(20, 12, 'Caligo Hübner', '', '2023-06-08 21:22:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_historial_identificacion`
--

CREATE TABLE `ma_historial_identificacion` (
  `idhistorial` int(11) NOT NULL,
  `iddetallemodelo` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL DEFAULT '0',
  `his_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `his_tiempo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `his_inicio` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `his_fin` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `his_index` int(11) NOT NULL,
  `his_prediccion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `his_fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ma_historial_identificacion`
--

INSERT INTO `ma_historial_identificacion` (`idhistorial`, `iddetallemodelo`, `idusuario`, `his_img`, `his_tiempo`, `his_inicio`, `his_fin`, `his_index`, `his_prediccion`, `his_fecha`) VALUES
(1, 2, 1, 'predicciones/444081151607808.png', '2.7257268428802', '1686255047.1764', '1686255049.9021', 3, 'Heliconius Charitonius', '2023-06-08 15:10:49'),
(2, 2, 1, 'predicciones/444091588641792.png', '3.2157990932465', '1686257594.7907', '1686257598.0065', 3, 'Heliconius Charitonius', '2023-06-08 15:53:18'),
(3, 2, 1, 'predicciones/444091632792576.png', '3.1785469055176', '1686257605.607', '1686257608.7856', 15, 'Junonia Coenia', '2023-06-08 15:53:28'),
(4, 2, 1, 'predicciones/444092025394176.png', '2.8493869304657', '1686257701.7858', '1686257704.6351', 6, 'Heliconius Erato', '2023-06-08 15:55:04'),
(5, 2, 1, 'predicciones/444106125857792.png', '2.8630330562592', '1686261144.2677', '1686261147.1307', 4, 'Lycaena Phlaeas', '2023-06-08 16:52:27'),
(6, 2, 1, 'predicciones/444144595522560.jpg', '6.3065979480743', '1686270532.8186', '1686270539.1251', 16, 'Pontia Beckerii', '2023-06-08 19:28:59'),
(7, 2, 1, 'predicciones/444145387545600.jpg', '3.3557550907135', '1686270729.1477', '1686270732.5034', 12, 'Polyommatus Bellargus', '2023-06-08 19:32:12'),
(8, 2, 1, 'predicciones/446224542749696.jpg', '6.7905941009521', '1686778331.9385', '1686778338.7291', 15, 'Junonia Coenia', '2023-06-14 16:32:18'),
(9, 2, 1, 'predicciones/446523344819200.jpg', '5.5541718006134', '1686851282.851', '1686851288.4051', 12, 'Polyommatus Bellargus', '2023-06-15 12:48:08'),
(10, 2, 1, 'predicciones/446623538111488.png', '3.788792848587', '1686875745.9435', '1686875749.7323', 15, 'Junonia Coenia', '2023-06-15 19:35:49'),
(11, 2, 1, 'predicciones/446624719647744.jpg', '3.7328810691833', '1686876034.4598', '1686876038.1927', 2, 'Danaus Plexippus', '2023-06-15 19:40:38'),
(12, 2, 1, 'predicciones/446624796070912.png', '3.4608309268951', '1686876053.3886', '1686876056.8494', 17, 'Vanessa Atalanta', '2023-06-15 19:40:56'),
(13, 1, 1, 'predicciones/446646973785088.jpg', '4.4123468399048', '1686881466.9194', '1686881471.3318', 15, 'Caligo Eurilochus', '2023-06-15 21:11:12'),
(14, 1, 1, 'predicciones/446647223518208.jpg', '4.0244970321655', '1686881528.2768', '1686881532.3013', 18, 'Papilio Crino Fabricius', '2023-06-15 21:12:12'),
(15, 1, 0, 'predicciones/448341966537728.jpg', '12.94433093071', '1687295274.9307', '1687295287.8751', 3, 'Papilio Cresphontes', '2023-06-20 16:08:08'),
(16, 1, 1, 'predicciones/448344066360320.jpg', '3.6286358833313', '1687295796.9448', '1687295800.5734', 3, 'Papilio Cresphontes', '2023-06-20 16:16:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_modelo`
--

CREATE TABLE `ma_modelo` (
  `idmodelo` int(11) NOT NULL,
  `mo_nombre` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mo_clasificador` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mo_descriptor` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mo_default` tinyint(1) NOT NULL DEFAULT '0',
  `mo_fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ma_modelo`
--

INSERT INTO `ma_modelo` (`idmodelo`, `mo_nombre`, `mo_clasificador`, `mo_descriptor`, `mo_default`, `mo_fecha`) VALUES
(1, 'SVM', 'SVM', 'maquina de soporte vectorial', 1, '2023-05-25 17:59:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_ordenes`
--

CREATE TABLE `ma_ordenes` (
  `idorden` int(11) NOT NULL,
  `or_nombre` varchar(200) NOT NULL DEFAULT 'undefined',
  `idclase` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_ordenes_1`
--

CREATE TABLE `ma_ordenes_1` (
  `idorden` int(11) NOT NULL,
  `or_nombre` varchar(200) NOT NULL,
  `or_descripcion` varchar(200) NOT NULL,
  `or_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ma_ordenes_1`
--

INSERT INTO `ma_ordenes_1` (`idorden`, `or_nombre`, `or_descripcion`, `or_date`) VALUES
(1, 'Lepidoptera', '', '2023-04-21 18:59:34'),
(3, 'Demo orden', '', '2023-05-21 22:41:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_reinos`
--

CREATE TABLE `ma_reinos` (
  `idreino` int(11) NOT NULL,
  `re_nombre` varchar(200) NOT NULL DEFAULT 'undefined'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_subfamilias`
--

CREATE TABLE `ma_subfamilias` (
  `idsubfamilia` int(11) NOT NULL,
  `idfamilia` int(11) NOT NULL,
  `sub_nombre` varchar(255) NOT NULL DEFAULT 'undefined'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_subfamilias_1`
--

CREATE TABLE `ma_subfamilias_1` (
  `idsubfamilia` int(11) NOT NULL,
  `idfamilia` int(11) NOT NULL,
  `sub_nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'undefined',
  `sub_descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ma_subfamilias_1`
--

INSERT INTO `ma_subfamilias_1` (`idsubfamilia`, `idfamilia`, `sub_nombre`, `sub_descripcion`, `sub_date`) VALUES
(1, 1, 'Danainae', 'prueba', '2023-05-21 21:00:24'),
(2, 3, 'demo subfamilia', '', '2023-05-21 22:02:53'),
(3, 1, 'Heliconiinae', '', '2023-05-22 22:38:08'),
(4, 1, 'Nymphalinae', '', '2023-05-22 22:40:07'),
(5, 4, 'Lycaeninae', '', '2023-05-22 22:43:44'),
(6, 5, 'Papilioninae', '', '2023-05-22 22:46:29'),
(7, 6, 'pierinae', '', '2023-05-22 22:48:54'),
(8, 4, 'Polyommatinae', '', '2023-05-28 16:21:10'),
(9, 1, 'Libytheinae', '', '2023-05-28 16:29:52'),
(10, 1, 'Biblidinae', '', '2023-05-28 16:35:10'),
(11, 4, 'Theclinae', '', '2023-05-28 16:51:17'),
(12, 1, 'Satyrinae', '', '2023-06-08 21:21:36'),
(13, 4, 'demo 2', 'hshdfsdf', '2023-06-15 20:40:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_superfamilias`
--

CREATE TABLE `ma_superfamilias` (
  `idsuperfamilia` int(11) NOT NULL,
  `idorden` int(11) NOT NULL,
  `sp_nombre` varchar(255) NOT NULL DEFAULT 'undefined'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_tribus`
--

CREATE TABLE `ma_tribus` (
  `idgeneros` int(11) NOT NULL,
  `idsubfamilia` int(11) NOT NULL,
  `tri_nombres` varchar(255) NOT NULL DEFAULT 'undefined'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sis_centinela`
--

CREATE TABLE `sis_centinela` (
  `idvisita` int(11) NOT NULL,
  `vis_cod` int(11) NOT NULL,
  `idwebusuario` int(11) DEFAULT '0',
  `vis_ip` varchar(200) NOT NULL,
  `vis_agente` varchar(255) NOT NULL,
  `vis_method` varchar(10) DEFAULT NULL,
  `vis_url` text,
  `vis_fechahora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sis_imagenes`
--

CREATE TABLE `sis_imagenes` (
  `idimagen` int(11) NOT NULL,
  `idgalery` varchar(10) NOT NULL DEFAULT '0',
  `img_externo` int(11) NOT NULL DEFAULT '0',
  `img_url` varchar(200) DEFAULT NULL,
  `img_propietario` int(11) NOT NULL DEFAULT '0',
  `img_type` varchar(45) NOT NULL,
  `img_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sis_imagenes`
--

INSERT INTO `sis_imagenes` (`idimagen`, `idgalery`, `img_externo`, `img_url`, `img_propietario`, `img_type`, `img_date`) VALUES
(1, '0', 0, '/img/person/leenh-alexander-bustamante-fernandez.jpg', 1, 'USER::AVATAR', '2023-04-14 14:12:01'),
(2, '0', 0, '/img/person/naomi-bustamante.jpg', 5, 'USER::AVATAR', '2023-04-14 17:10:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sis_menus`
--

CREATE TABLE `sis_menus` (
  `idmenu` int(11) NOT NULL,
  `men_nombre` varchar(20) NOT NULL,
  `men_url` varchar(100) NOT NULL,
  `men_controlador` varchar(15) DEFAULT NULL,
  `men_icono` varchar(20) NOT NULL,
  `men_url_si` tinyint(1) NOT NULL DEFAULT '0',
  `men_orden` int(11) DEFAULT NULL,
  `men_visible` tinyint(1) NOT NULL DEFAULT '1',
  `men_fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sis_menus`
--

INSERT INTO `sis_menus` (`idmenu`, `men_nombre`, `men_url`, `men_controlador`, `men_icono`, `men_url_si`, `men_orden`, `men_visible`, `men_fecha`) VALUES
(1, 'Maestras', '#', NULL, 'bx-lock-open-alt', 0, 10, 1, '2023-03-06 12:39:09'),
(2, 'Usuarios', '#', NULL, 'bx-user-circle', 0, 5, 1, '2023-03-07 00:41:34'),
(13, 'Modelo', '#', NULL, 'bxl-codepen', 0, 1, 1, '2023-04-13 16:52:29'),
(16, 'Mariposas', '#', NULL, 'bx-library', 0, 4, 1, '2023-04-21 17:32:38'),
(17, 'Entrenamiento', '#', NULL, 'bx-unite', 0, 3, 1, '2023-05-19 16:04:03'),
(18, 'Reportes', '#', NULL, 'bxs-report', 0, 6, 1, '2023-06-08 20:14:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sis_permisos`
--

CREATE TABLE `sis_permisos` (
  `idpermisos` int(11) NOT NULL,
  `idrol` int(11) NOT NULL,
  `idsubmenu` int(11) NOT NULL,
  `perm_r` int(11) DEFAULT NULL,
  `perm_w` int(11) DEFAULT NULL,
  `perm_u` int(11) DEFAULT NULL,
  `perm_d` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(45, 1, 44, 1, 0, 0, 0),
(46, 5, 42, 1, 1, 1, 1),
(47, 5, 7, 1, 1, 1, 1),
(48, 5, 4, 1, 1, 1, 1),
(49, 5, 8, 1, 1, 1, 1),
(50, 5, 3, 1, 0, 0, 0),
(51, 5, 38, 1, 0, 0, 0),
(52, 5, 36, 1, 0, 0, 0),
(53, 5, 35, 1, 0, 0, 0),
(54, 5, 37, 1, 0, 0, 0),
(55, 5, 39, 1, 0, 1, 1),
(56, 5, 43, 1, 1, 1, 1),
(57, 5, 41, 1, 1, 1, 1),
(58, 5, 23, 1, 1, 1, 1),
(59, 5, 21, 1, 1, 1, 1),
(60, 5, 44, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sis_personal`
--

CREATE TABLE `sis_personal` (
  `idpersona` int(11) NOT NULL,
  `per_dni` int(11) NOT NULL,
  `per_nombre` varchar(200) NOT NULL,
  `per_celular` int(11) NOT NULL,
  `per_email` varchar(255) DEFAULT NULL,
  `per_direcc` varchar(200) NOT NULL,
  `per_estado` tinyint(1) NOT NULL DEFAULT '1',
  `per_fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sis_personal`
--

INSERT INTO `sis_personal` (`idpersona`, `per_dni`, `per_nombre`, `per_celular`, `per_email`, `per_direcc`, `per_estado`, `per_fecha`) VALUES
(1, 76144152, 'LEENH ALEXANDER BUSTAMANTE FERNANDEZ', 942949927, 'hackingleenh@gmail.com', 'Jr San Martin Cdr 3 Mz 55 Lt 55 Ur Nueva Cajamarca Et.1.', 1, '2022-07-22 01:09:20'),
(5, 76144151, 'Naomi', 123, 'naomi@gmail.com', 'Ad', 1, '2023-03-08 12:03:27'),
(6, 76144153, 'Maicol Culqui', 987765412, 'maicol@gmail.com', 'Por Ahi', 1, '2023-06-15 20:35:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sis_rol`
--

CREATE TABLE `sis_rol` (
  `idrol` int(11) NOT NULL,
  `rol_cod` varchar(10) DEFAULT NULL,
  `rol_nombre` varchar(255) NOT NULL,
  `rol_descripcion` varchar(255) DEFAULT NULL,
  `rol_estado` tinyint(1) NOT NULL DEFAULT '0',
  `rol_fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `idserveremail` int(11) NOT NULL,
  `em_host` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `em_usermail` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `em_pass` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `em_port` int(11) NOT NULL,
  `em_estado` tinyint(1) NOT NULL DEFAULT '1',
  `em_default` tinyint(1) DEFAULT NULL,
  `em_fupdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `em_fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `idsubmenu` int(11) NOT NULL,
  `idmenu` int(11) NOT NULL,
  `sub_nombre` varchar(200) NOT NULL,
  `sub_url` varchar(100) NOT NULL,
  `sub_controlador` varchar(50) DEFAULT NULL,
  `sub_metodo` varchar(200) DEFAULT 'index',
  `sub_icono` varchar(20) DEFAULT NULL,
  `sub_orden` int(11) DEFAULT NULL,
  `sub_visible` tinyint(1) NOT NULL DEFAULT '1',
  `sub_fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `idtarea` int(11) NOT NULL,
  `ta_name` varchar(200) NOT NULL DEFAULT 'undefined',
  `ta_description` text,
  `ta_execute` text,
  `ta_fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `idusuario` int(11) NOT NULL,
  `idrol` int(11) NOT NULL,
  `idpersona` int(11) NOT NULL,
  `usu_usuario` varchar(255) NOT NULL,
  `usu_pass` varchar(255) NOT NULL,
  `usu_token` varchar(255) DEFAULT NULL,
  `usu_activo` tinyint(1) NOT NULL DEFAULT '0',
  `usu_estado` tinyint(1) NOT NULL DEFAULT '0',
  `usu_primera` tinyint(1) NOT NULL DEFAULT '0',
  `usu_twoauth` tinyint(1) NOT NULL DEFAULT '0',
  `usu_code_twoauth` varchar(200) NOT NULL DEFAULT '0',
  `usu_fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sis_usuarios`
--

INSERT INTO `sis_usuarios` (`idusuario`, `idrol`, `idpersona`, `usu_usuario`, `usu_pass`, `usu_token`, `usu_activo`, `usu_estado`, `usu_primera`, `usu_twoauth`, `usu_code_twoauth`, `usu_fecha`) VALUES
(1, 1, 1, 'hackingleenh@gmail.com', '$2y$10$Z3rOi0RlLXg2mRRduTAmm.u6sy6CIA9iq2yuJxE1IfcKzt6pGGpW6', NULL, 1, 1, 0, 0, '', '2022-07-22 01:10:31'),
(6, 4, 5, 'leenh', '$2y$10$Z3rOi0RlLXg2mRRduTAmm.u6sy6CIA9iq2yuJxE1IfcKzt6pGGpW6', NULL, 0, 1, 0, 0, '0', '2023-03-08 13:25:32'),
(7, 5, 5, 'demo@gmail.com', '$2y$10$G7N8GbSoHunthadufkFxI.nwJOADmTEvvJmV6wXUQGSsFuCVEPwOO', NULL, 1, 1, 0, 0, '0', '2023-04-14 17:10:50'),
(8, 5, 6, 'leenh@leenhcraft.com', '$2y$10$l1EW8OgTrtSvIZ2zBYDxYeR2CiJ0VzBdDtnwGqjNXs6GBXYxbohnC', NULL, 1, 1, 0, 0, '0', '2023-06-15 20:36:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `web_carritos`
--

CREATE TABLE `web_carritos` (
  `idcarrito` int(11) NOT NULL,
  `vis_cod` varchar(20) NOT NULL,
  `idwebusuario` int(11) DEFAULT NULL,
  `idarticulo` int(11) NOT NULL,
  `codPedido` varchar(20) NOT NULL DEFAULT '0',
  `car_cantidad` int(11) NOT NULL DEFAULT '1',
  `car_anulado` tinyint(1) NOT NULL DEFAULT '0',
  `car_fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `idmenu` int(11) NOT NULL,
  `me_name` varchar(20) NOT NULL,
  `me_url` varchar(20) DEFAULT NULL,
  `me_publico` tinyint(1) NOT NULL DEFAULT '0',
  `me_status` tinyint(1) NOT NULL DEFAULT '0',
  `me_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `idsubmenu` int(11) NOT NULL,
  `idmenu` int(11) DEFAULT '0',
  `me_name` varchar(20) NOT NULL,
  `me_url` varchar(20) NOT NULL,
  `me_publico` tinyint(1) NOT NULL DEFAULT '0',
  `me_status` tinyint(1) NOT NULL DEFAULT '0',
  `me_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `idwebusuario` int(11) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `idvisita` int(11) NOT NULL,
  `vis_cod` int(11) NOT NULL,
  `idwebusuario` int(11) DEFAULT '0',
  `vis_ip` varchar(200) NOT NULL,
  `vis_agente` varchar(255) NOT NULL,
  `vis_method` varchar(10) DEFAULT NULL,
  `vis_url` varchar(200) DEFAULT NULL,
  `vis_fechahora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `web_visitas`
--

INSERT INTO `web_visitas` (`idvisita`, `vis_cod`, `idwebusuario`, `vis_ip`, `vis_agente`, `vis_method`, `vis_url`, `vis_fechahora`) VALUES
(1, 9614, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'GET', '/admin/login', '2023-06-18 20:24:43'),
(2, 9402, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'GET', '/admin/login', '2023-06-20 16:07:15'),
(3, 1678, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'GET', '/admin/login', '2023-06-21 00:09:51'),
(4, 3638, 0, ' IP: ::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'GET', '/admin/login', '2023-06-21 11:55:01');

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
  MODIFY `idmod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=390;

--
-- AUTO_INCREMENT de la tabla `ma_clases`
--
ALTER TABLE `ma_clases`
  MODIFY `idclase` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ma_configuracion`
--
ALTER TABLE `ma_configuracion`
  MODIFY `idconfig` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ma_detalle_modelo`
--
ALTER TABLE `ma_detalle_modelo`
  MODIFY `iddetallemodelo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ma_entrenamiento`
--
ALTER TABLE `ma_entrenamiento`
  MODIFY `identrenamiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ma_especies`
--
ALTER TABLE `ma_especies`
  MODIFY `idespecie` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ma_especies_1`
--
ALTER TABLE `ma_especies_1`
  MODIFY `idespecie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `ma_especies_2`
--
ALTER TABLE `ma_especies_2`
  MODIFY `idespecie` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ma_familias`
--
ALTER TABLE `ma_familias`
  MODIFY `idfamilia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ma_familias_1`
--
ALTER TABLE `ma_familias_1`
  MODIFY `idfamilia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `ma_filos`
--
ALTER TABLE `ma_filos`
  MODIFY `idfilo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ma_generos`
--
ALTER TABLE `ma_generos`
  MODIFY `idgenero` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ma_generos_1`
--
ALTER TABLE `ma_generos_1`
  MODIFY `idgenero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `ma_historial_identificacion`
--
ALTER TABLE `ma_historial_identificacion`
  MODIFY `idhistorial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `ma_modelo`
--
ALTER TABLE `ma_modelo`
  MODIFY `idmodelo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ma_ordenes`
--
ALTER TABLE `ma_ordenes`
  MODIFY `idorden` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ma_ordenes_1`
--
ALTER TABLE `ma_ordenes_1`
  MODIFY `idorden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ma_reinos`
--
ALTER TABLE `ma_reinos`
  MODIFY `idreino` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ma_subfamilias`
--
ALTER TABLE `ma_subfamilias`
  MODIFY `idsubfamilia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ma_subfamilias_1`
--
ALTER TABLE `ma_subfamilias_1`
  MODIFY `idsubfamilia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `ma_superfamilias`
--
ALTER TABLE `ma_superfamilias`
  MODIFY `idsuperfamilia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ma_tribus`
--
ALTER TABLE `ma_tribus`
  MODIFY `idgeneros` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sis_centinela`
--
ALTER TABLE `sis_centinela`
  MODIFY `idvisita` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sis_imagenes`
--
ALTER TABLE `sis_imagenes`
  MODIFY `idimagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sis_menus`
--
ALTER TABLE `sis_menus`
  MODIFY `idmenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `sis_permisos`
--
ALTER TABLE `sis_permisos`
  MODIFY `idpermisos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `sis_personal`
--
ALTER TABLE `sis_personal`
  MODIFY `idpersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `sis_rol`
--
ALTER TABLE `sis_rol`
  MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `sis_server_email`
--
ALTER TABLE `sis_server_email`
  MODIFY `idserveremail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sis_submenus`
--
ALTER TABLE `sis_submenus`
  MODIFY `idsubmenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `sis_tareas_ejecutables`
--
ALTER TABLE `sis_tareas_ejecutables`
  MODIFY `idtarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `sis_usuarios`
--
ALTER TABLE `sis_usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `web_carritos`
--
ALTER TABLE `web_carritos`
  MODIFY `idcarrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `web_menus`
--
ALTER TABLE `web_menus`
  MODIFY `idmenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `web_submenus`
--
ALTER TABLE `web_submenus`
  MODIFY `idsubmenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `web_usuarios`
--
ALTER TABLE `web_usuarios`
  MODIFY `idwebusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `web_visitas`
--
ALTER TABLE `web_visitas`
  MODIFY `idvisita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
