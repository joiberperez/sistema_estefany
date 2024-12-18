-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2024 a las 13:24:02
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_estefany`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `descripcion`, `fecha_creacion`, `fecha_actualizacion`) VALUES
(1, 'Chocolatess', 'Variedad de chocolates y bombones', '2024-10-26 20:30:04', '2024-11-19 02:16:55'),
(2, 'Galletas', 'Galletas de diferentes sabores y tamaos', '2024-10-26 20:30:04', '2024-11-14 02:34:44'),
(3, 'Dulces', 'Dulces y caramelos variados', '2024-10-26 20:30:04', '2024-10-26 20:30:04'),
(4, 'Pasteles', 'Pasteles y tortas para ocasiones especiales', '2024-10-26 20:30:04', '2024-10-26 20:30:04'),
(5, 'Postres', 'Postres individuales y porciones', '2024-10-26 20:30:04', '2024-11-14 02:31:25'),
(7, 'Snacks', 'Snacks salados y aperitivos', '2024-10-26 20:30:04', '2024-10-26 20:30:04'),
(8, 'Frutas Confitadas', 'Frutas en almíbar o cubiertas de chocolate', '2024-10-26 20:30:04', '2024-10-26 20:30:04'),
(9, 'Helados', 'Helados y sorbetes de diversos sabores', '2024-10-26 20:30:04', '2024-10-26 20:30:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombre_cliente` varchar(100) NOT NULL,
  `apellido_cliente` varchar(100) NOT NULL,
  `cedula_cliente` varchar(20) NOT NULL,
  `telefono_cliente` varchar(15) DEFAULT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre_cliente`, `apellido_cliente`, `cedula_cliente`, `telefono_cliente`, `fecha_registro`) VALUES
(21, 'Juan', 'Perez', '12345678', '04121234567', '2024-10-26 00:00:00'),
(22, 'María', 'González', '23456789', '04142345678', '2024-10-26 00:00:00'),
(23, 'Luis', 'Rodríguez', '34567890', '04243456789', '2024-10-26 00:00:00'),
(24, 'Anita', 'Torres', '45678901', '04164567890', '2024-10-26 00:00:00'),
(25, 'Carlos', 'Sánchez', '56789012', '04245678901', '2024-10-26 00:00:00'),
(26, 'Laura', 'Martínez', '67890123', '04126789012', '2024-10-26 00:00:00'),
(27, 'Javier', 'Romero', '78901234', '04147890123', '2024-10-26 00:00:00'),
(28, 'Sofía', 'Castro', '89012345', '04248901234', '2024-10-26 00:00:00'),
(29, 'Diego', 'Hernández', '90123456', '04169012345', '2024-10-26 00:00:00'),
(30, 'Gabriela', 'López', '12345677', '04241234567', '2024-10-26 00:00:00'),
(31, 'Andrés', 'Jiménez', '23456788', '04122345678', '2024-10-26 00:00:00'),
(32, 'Patricia', 'Ruiz', '34567899', '04143456789', '2024-10-26 00:00:00'),
(33, 'Fernando', 'Díaz', '45678910', '04244567890', '2024-10-26 00:00:00'),
(34, 'Verónica', 'Silva', '56789011', '04165678901', '2024-10-26 00:00:00'),
(35, 'Rafael', 'Morales', '67890122', '04246789012', '2024-10-26 00:00:00'),
(36, 'Claudia', 'Ríos', '78901233', '04127890123', '2024-10-26 00:00:00'),
(37, 'Eduardo', 'Medina', '89012344', '04148901234', '2024-10-26 00:00:00'),
(38, 'Camila', 'Fernández', '90123455', '04249012345', '2024-10-26 00:00:00'),
(41, 'joiber', 'perez', '31911228', '04247013239', '2024-10-26 00:00:00'),
(128, 'alexis', 'perez', '13364648', '04125055655', '2024-10-26 00:00:00'),
(130, 'edilama', 'osorio', '84401577', '04247013239', '2024-10-26 00:00:00'),
(148, 'eddy', 'perez', '12345674', '04125055655', '2024-10-26 00:00:00'),
(150, 'francis', 'perez', '31777222', '04247014532', '2024-10-26 00:00:00'),
(152, 'alexa', 'perez', '87654321', '04247014532', '2024-10-26 00:00:00'),
(210, 'Marcos', 'Alvarado', '11223344', '04123456789', '2024-10-28 00:00:00'),
(211, 'Isabel', 'Cordero', '22334455', '04134567890', '2024-10-28 00:00:00'),
(212, 'Esteban', 'Paniagua', '33445566', '04145678901', '2024-10-28 00:00:00'),
(213, 'Camila', 'Salazar', '44556677', '04156789012', '2024-10-28 00:00:00'),
(214, 'Ricardo', 'Núñez', '55667788', '04167890123', '2024-10-28 00:00:00'),
(215, 'Natalia', 'Mendoza', '66778899', '04178901234', '2024-10-28 00:00:00'),
(216, 'Fernando', 'Quintero', '77889900', '04189012345', '2024-10-28 00:00:00'),
(217, 'Valentina', 'Rojas', '88990011', '04190123456', '2024-10-28 00:00:00'),
(218, 'Santiago', 'Castillo', '99001122', '04101234567', '2024-10-28 00:00:00'),
(219, 'Ana', 'Bermúdez', '00112233', '04112345678', '2024-10-28 00:00:00'),
(220, 'Lucía', 'Márquez', '33445588', '04123456780', '2024-10-28 00:00:00'),
(221, 'Julio', 'Cruz', '44556699', '04134567891', '2024-10-28 00:00:00'),
(222, 'Pablo', 'Rivas', '55667700', '04145678902', '2024-10-28 00:00:00'),
(223, 'Teresa', 'Valdez', '66778811', '04156789013', '2024-10-28 00:00:00'),
(224, 'Diego', 'Ceballos', '77889922', '04167890124', '2024-10-28 00:00:00'),
(225, 'Rosa', 'Hernández', '88990033', '04178901235', '2024-10-28 00:00:00'),
(226, 'Salvador', 'Santos', '99001144', '04189012346', '2024-10-28 00:00:00'),
(227, 'Verónica', 'López', '00112255', '04190123457', '2024-10-28 00:00:00'),
(228, 'Nicolás', 'Salas', '11223366', '04101234568', '2024-10-28 00:00:00'),
(229, 'Miriam', 'Figueroa', '22334477', '04112345679', '2024-10-28 00:00:00'),
(230, 'Fernando', 'Córdoba', '33447788', '04123456781', '2024-10-28 00:00:00'),
(231, 'Alejandra', 'Gutiérrez', '44558899', '04134567892', '2024-10-28 00:00:00'),
(232, 'Samuel', 'Ortega', '55669900', '04145678903', '2024-10-28 00:00:00'),
(233, 'Gabriela', 'Villanueva', '66770011', '04156789014', '2024-10-28 00:00:00'),
(234, 'Cristian', 'Mendoza', '77881122', '04167890125', '2024-10-28 00:00:00'),
(235, 'Carolina', 'Pérez', '88992233', '04178901236', '2024-10-28 00:00:00'),
(236, 'Álvaro', 'Jaramillo', '99003344', '04189012347', '2024-10-28 00:00:00'),
(237, 'Estefanía', 'Cifuentes', '00114455', '04190123458', '2024-10-28 00:00:00'),
(238, 'Arturo', 'González', '11225566', '04101234569', '2024-10-28 00:00:00'),
(240, 'francisco', 'ortega', '21234571', '0426398287', '2024-11-16 11:49:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_producto`
--

CREATE TABLE `compra_producto` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_compra` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `compra_producto`
--

INSERT INTO `compra_producto` (`id`, `producto_id`, `proveedor_id`, `cantidad`, `fecha_compra`) VALUES
(2, 32, 2, 200, '2024-10-26 20:34:35'),
(3, 33, 2, 150, '2024-10-26 20:34:35'),
(4, 34, 2, 50, '2024-10-26 20:34:35'),
(5, 35, 2, 75, '2024-10-26 20:34:35'),
(7, 37, 2, 120, '2024-10-26 20:34:35'),
(8, 38, 2, 60, '2024-10-26 20:34:35'),
(81, 32, 2, 15, '2024-10-29 20:13:24'),
(82, 32, 2, 15, '2024-10-29 20:13:24'),
(83, 32, 2, 15, '2024-10-29 20:13:24'),
(84, 32, 2, 15, '2024-10-29 20:13:24'),
(85, 32, 2, 15, '2024-10-29 20:13:24'),
(86, 32, 2, 15, '2024-10-29 20:13:24'),
(87, 32, 2, 15, '2024-10-29 20:13:24'),
(88, 32, 2, 15, '2024-10-29 20:13:24'),
(89, 32, 2, 15, '2024-10-29 20:13:24'),
(90, 32, 2, 15, '2024-10-29 20:13:24'),
(91, 38, 2, 10, '2024-10-29 20:32:52'),
(92, 38, 2, 15, '2024-10-29 20:32:52'),
(93, 38, 2, 20, '2024-10-29 20:32:52'),
(94, 38, 2, 25, '2024-10-29 20:32:52'),
(95, 38, 2, 30, '2024-10-29 20:32:52'),
(96, 37, 3, 5, '2024-10-29 21:42:05'),
(97, 41, 3, 2, '2024-10-30 02:00:29'),
(98, 41, 3, 2, '2024-10-30 02:00:43'),
(99, 41, 3, 2, '2024-10-30 02:02:44'),
(100, 41, 2, 10, '2024-10-30 02:10:15'),
(101, 42, 3, 5, '2024-10-30 02:38:15'),
(102, 42, 2, 1, '2024-10-30 02:59:26'),
(103, 42, 3, 2, '2024-10-30 03:07:45'),
(104, 42, 2, 3, '2024-11-01 18:39:12'),
(105, 42, 2, 5, '2024-11-04 17:30:35'),
(106, 35, 2, 7, '2024-11-10 19:06:44'),
(107, 35, 2, 5, '2024-11-10 19:07:16'),
(108, 42, 3, 5, '2024-11-11 10:11:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dolar`
--

CREATE TABLE `dolar` (
  `id` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `dolar`
--

INSERT INTO `dolar` (`id`, `valor`, `fecha_actualizacion`) VALUES
(1, 46.00, '2024-11-19 02:19:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `cantidad_disponible` float(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id`, `producto_id`, `cantidad_disponible`) VALUES
(1, 32, 74.00),
(2, 33, 139.00),
(3, 34, 46.00),
(4, 35, 2.00),
(6, 37, 120.00),
(7, 38, 90.00),
(8, 41, 30.00),
(9, 42, 0.00),
(10, 43, 0.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodo_pago`
--

CREATE TABLE `metodo_pago` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `metodo_pago`
--

INSERT INTO `metodo_pago` (`id`, `nombre`) VALUES
(1, 'divisas'),
(2, 'transferencia'),
(3, 'efectivo'),
(4, 'tarjeta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `descripcion`, `precio`, `categoria_id`, `fecha_creacion`, `fecha_actualizacion`) VALUES
(32, 'Galletas de Vainilla', 'Galletas crujientes con sabor a vainilla.', 1.00, 2, '2024-10-26 20:34:35', '2024-10-26 20:34:35'),
(33, 'Dulces de Frutas', 'Caramelos de frutas variadas.', 0.75, 3, '2024-10-26 20:34:35', '2024-10-26 20:34:35'),
(34, 'Tarta de Fresa', 'Tarta de vainilla con fresas frescas.', 15.00, 4, '2024-10-26 20:34:35', '2024-10-26 20:34:35'),
(35, 'Mousse de Chocolate', 'Suave mousse de chocolate negro', 4.00, 5, '2024-10-26 20:34:35', '2024-10-30 02:33:59'),
(37, 'Papas Fritas', 'Papas fritas crujientes.', 1.50, 7, '2024-10-26 20:34:35', '2024-10-26 20:34:35'),
(38, 'Frutas Confitadas', 'Mezcla de frutas confitadas.', 3.00, 8, '2024-10-26 20:34:35', '2024-10-26 20:34:35'),
(41, 'torta de chocolate con queso', 'es una torta', 10.00, 4, '2024-10-29 15:19:09', '2024-10-29 15:31:55'),
(42, 'helado', 'heladodefresa', 5.00, 9, '2024-10-30 02:29:12', '2024-10-30 02:29:12'),
(43, 'prueba', 'descripcion', 21.00, 1, '2024-11-19 01:47:27', '2024-11-19 01:47:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id`, `nombre`, `direccion`, `telefono`, `fecha_registro`) VALUES
(2, 'Distribuidora SASA', '   tucani estado merida      ', '04247013239', '2024-10-26 15:34:21'),
(3, 'supermercado Alex', ' tucani merida ', '04247013239', '2024-10-26 15:38:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguridad`
--

CREATE TABLE `seguridad` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `rol` enum('a','u') DEFAULT 'u',
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `seguridad`
--

INSERT INTO `seguridad` (`id`, `nombre`, `apellido`, `nombre_usuario`, `contrasena`, `email`, `rol`, `fecha_creacion`) VALUES
(10, 'joiber', 'perezo', 'joiber', '$2y$10$zWyaqEgahYsDc.MUpvGelu8pCxoFEVROaUWUGE1ATAIm6tuFU9Tc6', 'perezgmailcom', 'a', '2024-11-13 02:15:43'),
(13, 'alexis', 'perez', 'alexis', '$2y$10$xq93Ob2nvMY4W0ltXQVpRujeay674J8/3FDr.q67WD1FO2WqGjOi.', 'joiberperez109@gmail.com', 'u', '2024-11-13 03:03:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_logs`
--

CREATE TABLE `user_logs` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `accion` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user_logs`
--

INSERT INTO `user_logs` (`id`, `usuario_id`, `accion`, `descripcion`, `fecha`) VALUES
(1, 10, 'login', 'El usuario inició sesión.', '2024-11-19 01:17:45'),
(2, 10, 'login', 'El usuario cerró sesión.', '2024-11-19 01:23:21'),
(3, 10, 'login', 'El usuario inició sesión.', '2024-11-19 01:26:00'),
(4, 10, 'registro de cliente', 'El usuario ha registrado un cliente.', '2024-11-19 01:26:43'),
(5, 10, 'actualizar_cliente', 'El usuario ha actualizado un cliente.', '2024-11-19 01:31:23'),
(6, 10, 'eliminar_cliente', 'El usuario ha eliminado un cliente.', '2024-11-19 01:31:38'),
(7, 10, 'registro_producto', 'El usuario ha registrado un producto.', '2024-11-19 01:47:27'),
(8, 10, 'actualizar_usuario', 'El usuario ha actualizado su contraseña.', '2024-11-19 01:58:40'),
(9, 10, 'actualizar_usuario', 'El usuario ha actualizado sus datos.', '2024-11-19 02:08:16'),
(10, 10, 'actualizar_categoria', 'El usuario ha actualizado una categoria.', '2024-11-19 02:16:55'),
(11, 10, 'actualizar_dolar', 'El usuario ha actualizado el valor del dolar.', '2024-11-19 02:19:10'),
(12, 10, 'login', 'El usuario inició sesión.', '2024-11-19 11:47:12'),
(13, 10, 'login', 'El usuario inició sesión.', '2024-11-19 21:45:31'),
(14, 10, 'login', 'El usuario inició sesión.', '2024-11-20 01:25:46'),
(15, 10, 'registro_venta', 'El usuario ha realizado una venta.', '2024-11-20 02:15:12'),
(16, 10, 'registro_venta', 'El usuario ha realizado una venta.', '2024-11-20 02:16:36'),
(17, 10, 'registro_venta', 'El usuario ha realizado una venta.', '2024-11-20 02:17:57'),
(18, 10, 'login', 'El usuario cerró sesión.', '2024-11-20 03:16:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id` int(11) NOT NULL,
  `fecha_venta` timestamp NULL DEFAULT current_timestamp(),
  `total` decimal(10,2) NOT NULL,
  `total_bs` float NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `metodo_pago_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id`, `fecha_venta`, `total`, `total_bs`, `cliente_id`, `metodo_pago_id`) VALUES
(4, '2024-11-04 03:35:42', 156.00, 0, 41, 1),
(5, '2024-11-04 03:36:12', 156.00, 0, 41, 1),
(6, '2024-11-04 03:44:48', 82.50, 0, 41, 1),
(7, '2024-11-04 03:52:25', 20.00, 0, 41, 1),
(8, '2024-11-04 03:52:58', 20.00, 0, 41, 1),
(9, '2024-11-04 03:56:00', 44.50, 0, 41, 1),
(10, '2024-11-04 03:59:09', 5.00, 0, 41, 1),
(11, '2024-11-04 04:00:03', 1.00, 0, 41, 1),
(12, '2024-11-04 04:01:07', 15.00, 0, 41, 1),
(13, '2024-11-04 17:08:30', 15.00, 0, 41, 1),
(14, '2024-11-04 17:25:25', 35.00, 0, 41, 1),
(15, '2024-11-04 17:29:04', 20.00, 0, 41, 1),
(16, '2024-11-04 17:38:45', 25.00, 0, 41, 1),
(17, '2024-11-04 17:41:47', 10.00, 0, 41, 1),
(18, '2024-11-05 02:28:46', 6.00, 0, 26, 1),
(19, '2024-11-10 19:05:22', 4.00, 0, 27, 1),
(20, '2024-11-10 19:08:21', 12.00, 0, 22, 4),
(21, '2024-11-11 10:25:53', 8.00, 0, 28, 3),
(22, '2024-11-11 10:35:38', 156.25, 0, 210, 2),
(23, '2024-11-18 02:35:32', 30.00, 0, 29, 2),
(24, '2024-11-20 02:15:12', 10.00, 10, 30, 4),
(25, '2024-11-20 02:16:36', 10.00, 10, 41, 1),
(26, '2024-11-20 02:17:57', 5.00, 230, 26, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_producto`
--

CREATE TABLE `venta_producto` (
  `id` int(11) NOT NULL,
  `venta_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `venta_producto`
--

INSERT INTO `venta_producto` (`id`, `venta_id`, `producto_id`, `cantidad`, `precio_unitario`) VALUES
(6, 4, 32, 11, 11.00),
(7, 4, 42, 5, 25.00),
(8, 4, 34, 4, 60.00),
(9, 4, 41, 6, 60.00),
(10, 5, 32, 11, 11.00),
(11, 5, 42, 5, 25.00),
(12, 5, 34, 4, 60.00),
(13, 5, 41, 6, 60.00),
(14, 6, 34, 5, 75.00),
(15, 6, 33, 10, 7.50),
(16, 7, 42, 4, 20.00),
(17, 8, 42, 4, 20.00),
(18, 9, 34, 1, 15.00),
(19, 9, 33, 10, 7.50),
(20, 9, 42, 2, 10.00),
(22, 10, 42, 1, 5.00),
(23, 11, 32, 1, 1.00),
(24, 12, 34, 1, 15.00),
(25, 13, 34, 1, 15.00),
(26, 14, 42, 7, 35.00),
(27, 15, 42, 4, 20.00),
(28, 16, 42, 5, 25.00),
(29, 17, 32, 10, 10.00),
(30, 18, 32, 6, 6.00),
(31, 19, 35, 80, 4.00),
(32, 20, 35, 3, 12.00),
(33, 21, 35, 2, 8.00),
(34, 22, 32, 10, 10.00),
(35, 22, 33, 11, 8.25),
(37, 22, 34, 2, 30.00),
(38, 22, 41, 10, 100.00),
(39, 23, 34, 2, 30.00),
(40, 24, 42, 2, 10.00),
(41, 25, 42, 2, 10.00),
(42, 26, 42, 1, 5.00);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `cedula_cliente` (`cedula_cliente`);

--
-- Indices de la tabla `compra_producto`
--
ALTER TABLE `compra_producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proveedor_id` (`proveedor_id`),
  ADD KEY `compra_producto_ibfk_1` (`producto_id`);

--
-- Indices de la tabla `dolar`
--
ALTER TABLE `dolar`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `metodo_pago`
--
ALTER TABLE `metodo_pago`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `seguridad`
--
ALTER TABLE `seguridad`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `fk_metodo_pago` (`metodo_pago_id`);

--
-- Indices de la tabla `venta_producto`
--
ALTER TABLE `venta_producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `venta_id` (`venta_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242;

--
-- AUTO_INCREMENT de la tabla `compra_producto`
--
ALTER TABLE `compra_producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT de la tabla `dolar`
--
ALTER TABLE `dolar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `metodo_pago`
--
ALTER TABLE `metodo_pago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `seguridad`
--
ALTER TABLE `seguridad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `venta_producto`
--
ALTER TABLE `venta_producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
