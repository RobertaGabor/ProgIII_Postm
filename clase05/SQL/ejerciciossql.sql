-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-04-2021 a las 06:43:54
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ejerciciossql`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `Codigo` int(6) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `tipo` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `precio` float NOT NULL,
  `fecha_de_creacion` date NOT NULL,
  `ultimamodificacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `Codigo`, `nombre`, `tipo`, `stock`, `precio`, `fecha_de_creacion`, `ultimamodificacion`) VALUES
(1, 77900361, 'Westmacott', 'liquido', 33, 15.87, '2020-09-26', '2021-02-09'),
(2, 77900362, 'Spirit', 'solido', 45, 66.6, '2020-04-14', '2020-09-18'),
(3, 77900363, 'Newgrosh', 'polvo', 0, 68.19, '2021-02-11', '2020-11-29'),
(4, 77900364, 'McNickle', 'polvo', 0, 53.51, '2020-04-17', '2020-11-28'),
(5, 77900365, 'Hudd', 'solido', 68, 66.6, '2020-06-19', '2020-12-19'),
(6, 77900366, 'Schrader', 'polvo', 0, 96.54, '2020-04-18', '2020-08-02'),
(7, 77900367, 'Bachellier', 'solido', 59, 66.6, '2020-06-07', '2021-01-30'),
(8, 77900368, 'Fleming', 'solido', 38, 66.6, '2020-10-03', '2020-10-26'),
(9, 77900369, 'Hurry', 'solido', 44, 66.6, '2020-05-30', '2020-07-04'),
(21, 77900973, 'Chocolate', 'Solido', 0, 66.6, '2021-04-20', '2021-04-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `clave` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Fechaderegistro` date NOT NULL,
  `localidad` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `clave`, `email`, `Fechaderegistro`, `localidad`) VALUES
(1, 'Mariano', 'Kautor', '123456', 'dkantor0@example.com', '2021-07-01', 'Quilmes'),
(2, 'German', 'Gerram', '123456', 'ggerram1@hud.gov', '2020-05-08', 'Berazategui'),
(3, 'Deloris', 'Fosis', '123456', 'bsharpe2@wisc.edu', '2020-11-28', 'Avellaneda'),
(4, 'Brok', 'Neiner', '123456', 'bblazic3@desdev.cn', '2020-12-08', 'Quilmes'),
(5, 'Garrick', 'Brent', '123456', 'gbrent4@theguardian.com', '2020-12-17', 'Moron'),
(6, 'Bili', 'Baus', '123456', 'bhoff5@addthis.com', '2020-11-27', 'Moreno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_de_venta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id`, `id_producto`, `id_usuario`, `cantidad`, `fecha_de_venta`) VALUES
(1, 1, 1, 2, '2020-07-19'),
(2, 8, 2, 3, '2020-08-16'),
(3, 7, 2, 4, '2021-01-24'),
(4, 6, 3, 5, '2021-01-14'),
(5, 3, 4, 6, '2021-03-20'),
(6, 5, 5, 7, '2021-02-22'),
(7, 3, 4, 6, '2020-12-02'),
(8, 3, 6, 6, '2020-06-10'),
(9, 2, 6, 6, '2021-02-04'),
(10, 1, 6, 1, '2020-05-17');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
