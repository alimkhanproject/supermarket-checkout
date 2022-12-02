-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 02, 2022 at 01:57 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `supermarket_checkout`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_offer_price`
--

CREATE TABLE `tbl_offer_price` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL DEFAULT '0',
  `minimum_quantity` int(11) NOT NULL DEFAULT '0',
  `offer_price` float NOT NULL DEFAULT '0',
  `mandatory_product_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_offer_price`
--

INSERT INTO `tbl_offer_price` (`id`, `product_id`, `minimum_quantity`, `offer_price`, `mandatory_product_id`) VALUES
(1, 1, 3, 130, 0),
(2, 2, 2, 45, 0),
(3, 3, 2, 38, 0),
(4, 3, 3, 50, 0),
(5, 4, 1, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `unit_price` double NOT NULL DEFAULT '0',
  `description` text CHARACTER SET utf8,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=active, 0 = inactive',
  `is_delete` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=deleted',
  `created_datetime` datetime DEFAULT NULL,
  `modified_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `name`, `unit_price`, `description`, `status`, `is_delete`, `created_datetime`, `modified_datetime`) VALUES
(1, 'A', 50, NULL, 1, 0, NULL, NULL),
(2, 'B', 30, NULL, 1, 0, NULL, NULL),
(3, 'C', 20, NULL, 1, 0, NULL, NULL),
(4, 'D', 15, NULL, 1, 0, NULL, NULL),
(5, 'E', 5, NULL, 1, 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_offer_price`
--
ALTER TABLE `tbl_offer_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_offer_price`
--
ALTER TABLE `tbl_offer_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
