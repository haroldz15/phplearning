-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2017 at 11:01 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app_php`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
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
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `address`, `city`, `state`, `zipcode`, `email`, `phones`) VALUES
(1, 'Wong Painting & Remodeling ', '8635 Centerton Lane', 'Manassas', 'VA', '20111', 'wongpainting@gmail.com', '703-926-5657 / 571-275-3541'),
(2, 'Fairfax Perfect Maids', '11441 Olde Kend Rd', 'Centreville', 'Va', '20120', 'fairfaxperfectmaids@gmail.com', '571-275-3541');

-- --------------------------------------------------------

--
-- Table structure for table `document_body`
--

CREATE TABLE `document_body` (
  `id` int(11) NOT NULL,
  `quantity` int(5) NOT NULL,
  `product` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_header`
--

CREATE TABLE `invoice_header` (
  `id` int(11) NOT NULL,
  `company` int(2) NOT NULL,
  `client_to` varchar(100) NOT NULL,
  `client_address` text NOT NULL,
  `date_due` date NOT NULL,
  `observations` text NOT NULL,
  `subtotal` decimal(19,4) NOT NULL,
  `tax` decimal(19,4) NOT NULL,
  `taxAmount` decimal(19,4) NOT NULL,
  `total` decimal(19,4) NOT NULL,
  `date` date NOT NULL,
  `user` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_header`
--

INSERT INTO `invoice_header` (`id`, `company`, `client_to`, `client_address`, `date_due`, `observations`, `subtotal`, `tax`, `taxAmount`, `total`, `date`, `user`, `status`) VALUES
(1, 1, 'a', 'a', '0000-00-00', 'text  ', '10.0000', '10.0000', '1.0000', '11.0000', '0000-00-00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL,
  `time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `time`) VALUES
(3, '1506392847'),
(1, '1506394123'),
(1, '1506394716');

-- --------------------------------------------------------

--
-- Table structure for table `options`
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
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `name`, `action`, `flags`, `icon`, `status`) VALUES
(1, 'Admin Tools', 'index', 'DEBUG', 'fa-cogs', 1),
(3, 'Invoices', 'invoices', 'DEBUG', 'fa-file-excel-o', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `lastname`, `email`, `password`, `flags`, `salt`) VALUES
(1, 'Harold', 'Harold', 'Zuniga', 'haroldzuniga15@gmail.com', '5ebfbb0ad9c19888896f969fa1fb38125fb471ce4202062095f2dfbfd1c59bfcc60d6c8ae982d765ec4e5e6056a7dda9c00a65e287fa528f98eac6e87f18939b', 'DEBUG', 'ba9c19e1668129ab3913ee834f9bfc159bada7d64fd18ddd7b801b6ee3f7b31441a34da1e80a02be1633164268d9a8755141f52102b892f0ebd9d9a3ed9ebe01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document_body`
--
ALTER TABLE `document_body`
  ADD KEY `id` (`id`);

--
-- Indexes for table `invoice_header`
--
ALTER TABLE `invoice_header`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company` (`company`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD KEY `id` (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `invoice_header`
--
ALTER TABLE `invoice_header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `document_body`
--
ALTER TABLE `document_body`
  ADD CONSTRAINT `document_body_ibfk_1` FOREIGN KEY (`id`) REFERENCES `invoice_header` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `invoice_header`
--
ALTER TABLE `invoice_header`
  ADD CONSTRAINT `invoice_header_ibfk_1` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `invoice_header_ibfk_2` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id`) REFERENCES `login_attempts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
