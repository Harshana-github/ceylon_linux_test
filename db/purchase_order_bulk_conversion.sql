-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2022 at 04:09 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `purchase_order_bulk_conversion`
--

-- --------------------------------------------------------

--
-- Table structure for table `addpurchaseorder`
--

CREATE TABLE `addpurchaseorder` (
  `zone_name` varchar(255) NOT NULL,
  `region_name` varchar(255) NOT NULL,
  `territory_name` varchar(255) NOT NULL,
  `distributor` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `po_no` varchar(255) NOT NULL,
  `remark` varchar(12) NOT NULL,
  `time` time(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `addpurchaseorder`
--

INSERT INTO `addpurchaseorder` (`zone_name`, `region_name`, `territory_name`, `distributor`, `date`, `po_no`, `remark`, `time`) VALUES
('ZONE1', 'REGION1', 'TERRITORY2', '', '2022-06-17', 'TEP1', '', '00:00:00.000000'),
('ZONE1', 'REGION3', 'TERRITORY2', 'harshana', '2022-06-17', 'TEP2', '', '00:00:00.000000'),
('ZONE2', 'REGION3', 'TERRITORY3', 'harshana', '2022-06-17', 'TEP3', 'mark', '00:00:00.000000'),
('ZONE3', 'REGION1', 'TERRITORY4', 'harshana', '2022-06-18', 'TEP4', '4', '00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `admi`
--

CREATE TABLE `admi` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `verified` tinyint(4) NOT NULL,
  `token` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admi`
--

INSERT INTO `admi` (`id`, `username`, `email`, `verified`, `token`, `password`) VALUES
(2, 'admin', 'harshanalakmal503@gmail.com', 0, '7311c99dc579f6178905234880469a600d3d999328d0e83cbde07e910e67d0148fc5734c0f3b6085181172ddbccb3df88505', '$2y$10$VwDjTjXUWy.argMEF73JHeDB7IpgDitcgOx6WxqcdsE1OKv1BQGhG');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `sku_id` varchar(255) NOT NULL,
  `sku_code` varchar(255) NOT NULL,
  `sku_name` varchar(200) NOT NULL,
  `mrp` varchar(255) NOT NULL,
  `d_price` varchar(255) NOT NULL,
  `weight` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`sku_id`, `sku_code`, `sku_name`, `mrp`, `d_price`, `weight`) VALUES
('SKU1', 'FWC 001', 'CDC 001', '06', '100.00', '100 G'),
('SKU2', 'FWC 002', 'CDC 002', '06', '100.00', '100 G');

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE `region` (
  `region_code` varchar(255) NOT NULL,
  `region_name` varchar(255) NOT NULL,
  `zone_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`region_code`, `region_name`, `zone_code`) VALUES
('REGION1', 'REGION 1', ''),
('REGION2', 'REGION 2', ''),
('REGION3', 'REGION 3', ''),
('REGION4', 'REGION 4', 'ZONE4');

-- --------------------------------------------------------

--
-- Table structure for table `territory`
--

CREATE TABLE `territory` (
  `territory_code` varchar(255) NOT NULL,
  `territory_name` varchar(255) NOT NULL,
  `zone_code` varchar(255) NOT NULL,
  `region_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `territory`
--

INSERT INTO `territory` (`territory_code`, `territory_name`, `zone_code`, `region_name`) VALUES
('TERRITORY1', 'TERRITORY 1', '', ''),
('TERRITORY2', 'TERRITORY 2', '', ''),
('TERRITORY3', 'TERRITORY 3', '', ''),
('TERRITORY4', 'TERRITORY 4', 'ZONE1', 'REGION4');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `name` varchar(50) NOT NULL,
  `nic` varchar(12) NOT NULL,
  `address` varchar(200) NOT NULL,
  `mobile` int(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` varchar(11) NOT NULL,
  `territory` varchar(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`name`, `nic`, `address`, `mobile`, `email`, `gender`, `territory`, `username`, `password`) VALUES
('Harshana', '111111111111', 'NO - 50 , HANDAPANAGALA , WEHERAYAYA', 711434499, 'harshanalakmal503@gmail.com', 'Male', 'TERRITORY4', 'harshana', 'harshana@123');

-- --------------------------------------------------------

--
-- Table structure for table `zone`
--

CREATE TABLE `zone` (
  `zone_code` varchar(255) NOT NULL,
  `zone_long_description` varchar(100) NOT NULL,
  `zone_description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `zone`
--

INSERT INTO `zone` (`zone_code`, `zone_long_description`, `zone_description`) VALUES
('ZONE1', 'ZONE 1', 'Z01'),
('ZONE2', 'ZONE 2', 'Z02'),
('ZONE3', 'ZONE 3', 'Z03'),
('ZONE4', 'ZONE 4', 'Z04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addpurchaseorder`
--
ALTER TABLE `addpurchaseorder`
  ADD PRIMARY KEY (`po_no`);

--
-- Indexes for table `admi`
--
ALTER TABLE `admi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`sku_id`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`region_code`);

--
-- Indexes for table `territory`
--
ALTER TABLE `territory`
  ADD PRIMARY KEY (`territory_code`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`nic`);

--
-- Indexes for table `zone`
--
ALTER TABLE `zone`
  ADD PRIMARY KEY (`zone_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admi`
--
ALTER TABLE `admi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
