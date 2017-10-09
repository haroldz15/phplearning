-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-10-2017 a las 03:59:49
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `app_php`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(150) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(3) NOT NULL,
  `zipcode` varchar(7) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phones` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `companies`
--

INSERT INTO `companies` (`id`, `name`, `address`, `city`, `state`, `zipcode`, `email`, `phones`) VALUES
(1, 'Wong Painting & Remodeling ', '8635 Centerton Lane', 'Manassas', 'VA', '20111', 'wongpainting@gmail.com', '703-926-5657 / 571-275-3541');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `document_body`
--

CREATE TABLE `document_body` (
  `id` int(11) NOT NULL,
  `quantity` int(5) NOT NULL,
  `product` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `observations` text NOT NULL,
  `subtotal` decimal(19,4) NOT NULL,
  `tax` decimal(19,4) NOT NULL,
  `total` decimal(19,4) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoice_header`
--

CREATE TABLE `invoice_header` (
  `id` int(11) NOT NULL,
  `company` int(2) NOT NULL,
  `client_to` int(11) NOT NULL,
  `client_address` text NOT NULL,
  `date_due` date NOT NULL,
  `date` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL,
  `time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `time`) VALUES
(3, '1506392847'),
(1, '1506394123'),
(1, '1506394716');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `action` varchar(50) NOT NULL,
  `flags` varchar(250) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `options`
--

INSERT INTO `options` (`id`, `name`, `action`, `flags`, `icon`, `status`) VALUES
(1, 'Admin Tools', 'index', 'DEBUG', 'fa-cogs', 1),
(3, 'Invoices', 'invoices', 'DEBUG', 'fa-file-excel-o', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(128) NOT NULL,
  `flags` varchar(250) NOT NULL,
  `salt` char(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `lastname`, `email`, `password`, `flags`, `salt`) VALUES
(1, 'Harold', 'Harold', 'Zuniga', 'haroldzuniga15@gmail.com', '5ebfbb0ad9c19888896f969fa1fb38125fb471ce4202062095f2dfbfd1c59bfcc60d6c8ae982d765ec4e5e6056a7dda9c00a65e287fa528f98eac6e87f18939b', 'DEBUG', 'ba9c19e1668129ab3913ee834f9bfc159bada7d64fd18ddd7b801b6ee3f7b31441a34da1e80a02be1633164268d9a8755141f52102b892f0ebd9d9a3ed9ebe01');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `invoice_header`
--
ALTER TABLE `invoice_header`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `invoice_header`
--
ALTER TABLE `invoice_header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
