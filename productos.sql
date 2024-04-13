-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 12-04-2024 a las 20:02:15
-- Versión del servidor: 8.2.0
-- Versión de PHP: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `productos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familias`
--

DROP TABLE IF EXISTS `familias`;
CREATE TABLE IF NOT EXISTS `familias` (
  `cod` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `familias`
--

INSERT INTO `familias` (`cod`, `nombre`) VALUES
('CAMARA', 'Cámaras digitales'),
('CONSOL', 'Consolas'),
('EBOOK', 'Libros electrónicos'),
('IMPRES', 'Impresoras'),
('MEMFLA', 'Memorias flash'),
('MP3', 'Reproductores MP3'),
('MULTIF', 'Equipos multifunción'),
('NETBOK', 'Netbooks'),
('ORDENA', 'Ordenadores'),
('PORTAT', 'Ordenadores portátiles'),
('ROUTER', 'Routers'),
('SAI', 'Sistemas de alimentación ininterrumpida'),
('SOFTWA', 'Software'),
('TV', 'Televisores'),
('VIDEOC', 'Videocámaras');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre_corto` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pvp` decimal(10,2) DEFAULT NULL,
  `familia` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `familia` (`familia`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `nombre_corto`, `descripcion`, `pvp`, `familia`) VALUES
(1, 'Nintendo 3DS ', 'NinRo', 'características: \r\n jugar en 3D, gracias al regulador 3D.\r\nColor Rojo\r\n&lt;script&gt;alert(&#039;XSS&#039;)&lt;/script&gt;\r\n', 420.00, 'Consol'),
(2, 'Acer AX3950 I5-650 4GB 1TB W7HP', 'ACERAX3950', 'Características:\r\n\r\nSistema Operativo : Windows® 7 Home Premium Original\r\n\r\nProcesador / Chipset\r\nNúmero de Ranuras PCI: 1\r\nFabricante de Procesador: Intel\r\nTipo de Procesador: Core i5\r\nModelo de Procesador: i5-650\r\nNúcleo de Procesador: Dual-core\r\nVeloci', 416.00, 'Libros'),
(37, 'iPadPlus', 'iPadP', 'Lenovo, Android', 380.00, 'EBOOK'),
(32, 'Nintendo 3DS blanco', 'Nin24B', 'Nintendo Blanco', 520.00, 'CONSOL'),
(33, 'Nintendo 3DS blanco-2', 'Nin24B-2', 'Nintendo Blanco', 520.00, 'CONSOL'),
(4, 'Sony Bravia 32IN FULLHD KDL-32BX400', 'BRAVIA2BX400', 'Características:\r\n\r\nFull HD: Vea deportes películas y juegos con magníficos detalles en alta resolución gracias a la resolución 1920x1080.\r\n\r\nHDMI®: 4 entradas (3 en la parte posterior, 1 en el lateral)\r\n\r\nUSB Media Player: Disfrute de películas, fotos y ', 356.90, 'TV'),
(5, 'Asus EEEPC 1005PXD N455 1 250 BL', 'EEEPC1005PXD', 'Características:\r\nProcesador: 1660 MHz, N455, Intel Atom, 0.5 MB. \r\nMemoria: 1024 MB, 2 GB, DDR3, SO-DIMM, 1 x 1024 MB. \r\nAccionamiento de disco: 2.5 \", 250 GB, 5400 RPM, \r\nSerial ATA, Serial ATA II, 250 GB. \r\nMedios de almacenaje: MMC, SD, SDHC. \r\nExhibi', 245.40, 'NETBOK'),
(6, 'HP Mini 110-3120 10.1LED N455 1GB 250GB W7S negro', 'HPMIN1103120', 'Características:\r\nSistema operativo instalado \r\nWindows® 7 Starter original 32 bits \r\n\r\nProcesador \r\nProcesador Intel® Atom N4551,66 GHz, Cache de nivel 2, 512 KB \r\n\r\nChipset NM10 Intel® + ICH8m \r\n\r\nMemoria \r\nDDR2 de 1 GB (1 x 1024 MB) \r\nMemoria máxima \r\n', 270.00, 'NETBOK'),
(7, 'Canon Ixus 115HS azul', 'IXUS115HSAZ', 'Características:\r\nHS System (12,1 MP) \r\nZoom 4x, 28 mm. IS Óptico \r\nCuerpo metálico estilizado \r\nPantalla LCD PureColor II G de 7,6 cm (3,0\") \r\nFull HD. IS Dinámico. HDMI \r\nModo Smart Auto (32 escenas) ', 196.70, 'CAMARA'),
(8, 'Kingston DataTraveler 16GB DT101G2 USB2.0 negro', 'KSTDT101G2', 'Características:\r\nCapacidades  16GB\r\nDimensiones  2.19\" x 0.68\" x 0.36\" (55.65mm x 17.3mm x 9.05mm)\r\nTemperatura de Operación  0° hasta 60° C / 32° hasta 140° F\r\nTemperatura de Almacenamiento  -20° hasta 85° C / -4° hasta 185° F\r\nSimple  Solo debe conecta', 19.20, 'MEMFLA'),
(9, 'Kingston DataTraveler G3 32GB rojo', 'KSTDTG332GBR', 'Características:\r\n\r\nTipo de producto Unidad flash USB\r\nCapacidad almacenamiento32GB\r\nAnchura 58.3 mm\r\nProfundidad 23.6 mm\r\nAltura 9.0 mm\r\nPeso 12 g\r\nColor incluido RED\r\nTipo de interfaz USB', 40.00, 'MEMFLA'),
(10, 'Kingston MicroSDHC 8GB', 'KSTMSDHC8GB', 'Kingston tarjeta de memoria flash 8 GB microSDHC\r\nÍndice de velocidad    Class 4\r\nCapacidad almacenamiento    8 GB\r\nFactor de forma  MicroSDHC\r\nAdaptador de memoria incluido   Adaptador microSDHC a SD\r\nGarantía del fabricante   Garantía limitada de por vi', 10.20, 'MEMFLA'),
(11, 'Canon Legria FS306 plata', 'LEGRIAFS306', 'Características:\r\n\r\nGrabación en tarjeta de memoria SD/SDHC \r\nLa cámara de vídeo digital de Canon más pequeña nunca vista \r\nInstantánea de Vídeo (Video Snapshot) \r\nZoom Avanzado de 41x \r\nGrabación Dual (Dual Shot) \r\nEstabilizador de la Imagen con Modo Din', 175.00, 'VIDEOC'),
(12, 'LG TDT HD 23 M237WDP-PC FULL HD', 'LGM237WDP', 'Características:\r\n\r\nGeneral\r\nTamaño (pulgadas): 23\r\nPantalla LCD: Sí\r\nFormato: 16:9\r\nResolución: 1920 x 1080\r\nFull HD: Sí\r\nBrillo (cd/m2): 300\r\nRatio Contraste: 50.000:1\r\nTiempo Respuesta (ms): 5\r\nÁngulo Visión (°): 170\r\nNúmero Colores (Millones): 16.7\r\n\r', 186.00, 'TV'),
(13, 'HP Laserjet Pro Wifi P1102W', 'LJPROP1102W', 'Impesora laserjet P1102W es facil de instalar y usar, ademas de que te ayudara a ahorrar energia y recursos. \r\nOlviadte de los cables y disfura de la libertad que te proporcina su tecnologia WIFI, imprime facilmente desdes cualquier de tu oficina. \r\n\r\nFor', 99.90, 'IMPRES'),
(14, 'Pentax Optio LS1100', 'OPTIOLS1100', 'La LS1100 con funda de transporte y tarjeta de memoria de 2GB incluidas \r\nes la compacta digital que te llevarás a todas partes. \r\nEsta cámara diseñada por Pentax incorpora un sensor CCD de 14,1 megapíxeles y un objetivo gran angular de 28 mm.\r\n', 104.80, 'CAMARA'),
(15, 'Lector ebooks Papyre6 con SD2GB + 500 ebooks', 'PAPYRE62GB', 'Marca Papyre \r\nModelo Papyre 6.1 \r\nUso Lector de libros electrónicos \r\nTecnología e-ink (tinta electrónica, Vizplez) \r\nCPU Samsung Am9 200MHz \r\nMemoria - Interna: 512MB \r\n- Externa: SD/SDHC (hasta 32GB) \r\nFormatos PDF, RTF, TXT, DOC, HTML, MP3, CHM, ZIP, ', 205.50, 'EBOOK'),
(16, 'Packard Bell I8103 23 I3-550 4G 640GB NVIDIAG210', 'PBELLI810323', 'Características:\r\n\r\nCPU CHIPSET\r\n\r\nProcesador : Ci3-550\r\nNorthBridge : Intel H57\r\n\r\nMEMORIA\r\nMemoria Rma : Ddr3 4096 MB\r\n\r\nDISPOSITIVOS DE ALMACENAMIENTO\r\nDisco Duro: 640Gb 7200 rpm\r\nÓptico : Slot Load siper multi Dvdrw\r\nLector de Tarjetas: 4 in 1 (XD, SD', 761.80, 'ORDENA'),
(41, 'Consola - Sony PlayStation 5 Slim', 'SonyPlayS', 'Consola - Sony PlayStation 5 Slim Digital Edition, 1 TB SSD, 4K, 1 mando, Chasis D, Blanco\r\n<script>alert(\'XSS persistente\')</script>', 449.00, 'CONSOL'),
(39, 'iPadPlus3', 'iPadPl', 'iPadPlus13, En tres colores: Azul, Verde, Blanco', 480.00, 'EBOOK'),
(28, 'Nintendo 3DS rojo', 'Nin', 'Nintendo 2023', 500.00, 'CONSOL'),
(29, 'Nintendo 3DS color Verde', 'Nin24', 'Nintendo Ultima generación 2024, color verde', 530.00, 'CONSOL'),
(18, 'Canon Pixma MP252', 'PIXMAMP252', 'Características:\r\n\r\nFunciones: Impresora, Escáner , Copiadora\r\nConexión: USB 2.0\r\nDimensiones:444 x 331 x 155 mm\r\nPeso: 5,8 Kg\r\n\r\nIMPRESORA\r\nResolución máxima: 4800 x 1200 ppp\r\nVelocidad de impresión:\r\nNegro/color: 7,0 ipm / 4,8 ipm\r\nTamaño máximo papel: ', 41.60, 'MULTIF'),
(19, 'PS3 con disco duro de 320GB', 'PS3320GB', 'Este Pack Incluye:\r\n- La consola Playstation 3 Slim Negra 320GB\r\n- El juego Killzone 3\r\n', 380.00, 'CONSOL'),
(20, 'Canon Powershot A3100 plata', 'PWSHTA3100PT', 'La cámara PowerShot A3100 IS, inteligente y compacta, presenta la calidad de imagen de Canon en un cuerpo\r\ncompacto y ligero para capturar fotografías sin esfuerzo; es tan fácil como apuntar y disparar.\r\nCaracterísticas:\r\n12,1 MP \r\nZoom óptico 4x con IS \r', 101.40, 'CAMARA'),
(21, 'Samsung CLX3175', 'SMSGCLX3175', 'Características:\r\n\r\nFunción: Impresión color, copiadora, escáner\r\nImpresión \r\nVelocidad (Mono)Hasta 16 ppm en A4 (17 ppm en Carta)\r\nVelocidad (Color)Hasta 4 ppm en A4 (4 ppm en Carta)\r\nSalida de la Primer Página (Mono)Menos de 14 segundos (Desde el Modo L', 190.00, 'MULTIF'),
(22, 'Samsung N150 10.1LED N450 1GB 250GB BAT6 BT W7 R', 'SMSN150101LD', 'Características:\r\n\r\nSistema Operativo Genuine Windows® 7 Starter \r\n\r\nProcesador Intel® ATOM Processor N450 (1.66GHz, 667MHz, 512KB) \r\n\r\nChipset Intel® NM10\r\n\r\nMemoria del Sistema 1GB (DDR2 / 1GB x 1) Ranura de Memoria 1 x SODIMM \r\n\r\nPantalla LCD 10.1\" WSV', 260.60, 'NETBOK'),
(23, 'Samsung SMX-C200PB EDC ZOOM 10X', 'SMSSMXC200PB', 'Características:\r\n\r\nSensor de Imagen Tipo 1 / 6 800K pixel CCD\r\n\r\nLente Zoom Óptico 10 x optico\r\n\r\nCaracterísticas Grabación Vídeo Estabilizador de Imagen Hiper estabilizador de imagen digital\r\n\r\nInterfaz Tarjeta de Memoria Ranura de Tarjeta SDHC / SD', 127.20, 'VIDEOC'),
(24, 'Epson Stylus SX515W', 'STYLUSSX515W', 'Características:\r\n\r\nResolución máxima5760 x 1440 DPI\r\nVelocidad de la impresión\r\nVelocidad de impresión (negro, calidad normal, A4)36 ppm\r\nVelocidad de impresión (color, calidad normal, A4)36 ppm\r\n\r\nTecnología de la impresión\r\nTecnología de impresión inye', 77.50, 'MULTIF'),
(25, 'Toshiba SD16GB Class10 Jewel Case', 'TSSD16GBC10J', 'Características:\r\n\r\nDensidad: 16 GB\r\nPINs de conexión: 9 pins\r\nInterfaz: Tarjeta de memoria SD standard compatible\r\nVelocidad de Escritura: 20 MBytes/s* \r\nVelocidad de Lectura: 20 MBytes/s*\r\nDimensiones: 32.0 mm (L) × 24.0 mm (W) × 2.1 mm (H)\r\nPeso: 2g\r\nT', 32.60, 'MEMFLA'),
(26, 'Creative Zen MP4 8GB Style 300', 'ZENMP48GB300', 'Características:\r\n\r\n8 GB de capacidad\r\nAutonomía: 32 horas con archivos MP3 a 128 kbps\r\nPantalla TFT de 1,8 pulgadas y 64.000 colores\r\nFormatos de audio compatibles: MP3, WMA (DRM9), formato Audible 4\r\nFormatos de foto compatibles: JPEG (BMP, TIFF, GIF y ', 58.90, 'MP3'),
(42, 'Consola - Sony PlayStation 5 Slim', 'SonyPlayS', 'Consola - Sony PlayStation 5 Slim Digital Edition, 1 TB SSD, 4K, 1 mando, Chasis D, Blanco\r\n&lt;script&gt;alert(&#039;XSS persistente&#039;)&lt;/script&gt;', 449.00, 'CONSOL'),
(43, '', '', '', 0.00, 'CAMARA'),
(44, '', '', '', 0.00, 'CAMARA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stocks`
--

DROP TABLE IF EXISTS `stocks`;
CREATE TABLE IF NOT EXISTS `stocks` (
  `id_producto` int NOT NULL,
  `id_tienda` int NOT NULL,
  `cantidad` int DEFAULT NULL,
  PRIMARY KEY (`id_producto`,`id_tienda`),
  KEY `id_tienda` (`id_tienda`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `stocks`
--

INSERT INTO `stocks` (`id_producto`, `id_tienda`, `cantidad`) VALUES
(1, 1, 2),
(1, 2, 1),
(2, 1, 1),
(3, 2, 1),
(3, 3, 2),
(4, 3, 1),
(5, 1, 2),
(5, 2, 1),
(6, 2, 1),
(6, 3, 2),
(7, 2, 2),
(8, 3, 1),
(9, 1, 1),
(9, 2, 2),
(10, 2, 2),
(10, 3, 2),
(11, 2, 1),
(12, 1, 1),
(13, 2, 2),
(14, 1, 3),
(14, 2, 1),
(15, 1, 2),
(15, 3, 1),
(16, 2, 1),
(17, 2, 1),
(17, 3, 2),
(18, 2, 1),
(19, 1, 1),
(20, 2, 2),
(20, 3, 2),
(21, 2, 1),
(22, 3, 1),
(23, 2, 1),
(24, 1, 1),
(25, 3, 2),
(26, 1, 3),
(26, 2, 2),
(26, 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiendas`
--

DROP TABLE IF EXISTS `tiendas`;
CREATE TABLE IF NOT EXISTS `tiendas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tiendas`
--

INSERT INTO `tiendas` (`id`, `nombre`, `telefono`) VALUES
(1, 'CENTRAL', '600100100'),
(2, 'SUCURSAL1', '600100200'),
(3, 'SUCURSAL2', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contrasena` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `intentos_fallidos` int NOT NULL,
  `bloqueo_temporal` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_usuario`, `contrasena`, `intentos_fallidos`, `bloqueo_temporal`) VALUES
(1, 'imane', '$2y$10$6zxE1UGRqjj/a6rYBQNjkeDSfltNedaNLehCvGtBp822wGpgQmk0e', 0, '0000-00-00 00:00:00'),
(2, 'Ana', '$2y$10$MnSjEf/gQoqDQI/Q4YW2levsRWE8KTD7ciYzqWcB6mr4J/QagBdom', 0, '0000-00-00 00:00:00'),
(3, 'Samuel', '$2y$10$pOx1o8GvoAeTaLmMDZusNule54xF8zruooI4Wvsk3seUMajPmj6ze', 0, '0000-00-00 00:00:00'),
(4, 'admin', '$2y$10$7VUu1FB8ASw8DCjh1QMLH.tep8RZhIF8DmYlvZn1C1L2QhE6.kh4K', 0, '0000-00-00 00:00:00'),
(5, 'Imane25/', '$2y$10$dGzC2tBTy9ilaUoxSKZXr.8aMTLw.p6IkAhCifbimTV8an9TlbK7a', 0, '0000-00-00 00:00:00'),
(6, 'user', '$2y$10$.dwG90X1GwJ.HHFFiwuxk.lfkSDQkx6fNZamQcoWvCzEoqOm60nZS', 2, '2024-04-12 18:11:58');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
