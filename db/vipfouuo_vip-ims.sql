-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2020 at 06:52 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vipfouuo_vip-ims`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `member_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `refID` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`member_id`, `name`, `refID`, `address`, `created_by`, `created_at`) VALUES
(1, 'JOFFPASCUAL@GMAIL.CO', 'JOFF', 'CAVITE', 'ADMIN', '2020-01-26');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `info` varchar(500) NOT NULL,
  `info2` varchar(500) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `info`, `info2`, `created_at`) VALUES
(1, 'ADMIN added new member', 'Details: JOFFPASCUAL@GMAIL.CO, JOFF', '2020-01-26 13:49:34'),
(2, 'ADMIN added new warehouse', 'Details: WH1', '2020-01-26 13:49:47'),
(3, 'ADMIN added new product_model', 'Details: MODEL1, MODA', '2020-01-26 13:50:04'),
(4, 'ADMIN added new product_model', 'Details: MODEL2, MODB', '2020-01-26 13:50:19'),
(5, 'ADMIN added new stock', 'Details: MODEL2, 100pcs', '2020-01-26 13:50:30'),
(6, 'ADMIN added new stock', 'Details: MODEL1, 100pcs', '2020-01-26 13:50:42'),
(7, 'ADMIN added new package', 'Details: SUPER TWINS, 3', '2020-01-26 13:50:58');

-- --------------------------------------------------------

--
-- Table structure for table `obdatatb`
--

CREATE TABLE `obdatatb` (
  `obdataID` int(11) NOT NULL,
  `outbound_ID` varchar(11) NOT NULL,
  `ob_tx_id` varchar(100) NOT NULL,
  `obdata_products` varchar(100) NOT NULL,
  `obdata_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `obdatatb`
--

INSERT INTO `obdatatb` (`obdataID`, `outbound_ID`, `ob_tx_id`, `obdata_products`, `obdata_qty`) VALUES
(1, '1', 'OBTX00000001', 'SUPER TWINS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `outboundtb`
--

CREATE TABLE `outboundtb` (
  `id` int(11) NOT NULL,
  `ob_tx_id` varchar(100) NOT NULL,
  `ob_custName` varchar(100) NOT NULL,
  `ob_warehouse` varchar(100) NOT NULL,
  `ob_date` varchar(100) NOT NULL,
  `ob_remarks` text NOT NULL,
  `ob_mot` varchar(100) NOT NULL,
  `ob_status` varchar(100) NOT NULL,
  `ob_received_by` varchar(100) NOT NULL,
  `ob_created_by` varchar(100) NOT NULL,
  `ob_created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `outboundtb`
--

INSERT INTO `outboundtb` (`id`, `ob_tx_id`, `ob_custName`, `ob_warehouse`, `ob_date`, `ob_remarks`, `ob_mot`, `ob_status`, `ob_received_by`, `ob_created_by`, `ob_created_at`) VALUES
(1, 'OBTX00000001', 'JOFFPASCUAL@GMAIL.CO', 'WH1', '2020-01-26', 'dsadas', 'Shipped', 'Fully Paid', 'dasdsad', 'ADMIN', '2020-01-26 13:51:25');

-- --------------------------------------------------------

--
-- Table structure for table `package_list`
--

CREATE TABLE `package_list` (
  `pack_list_id` int(11) NOT NULL,
  `model_id` varchar(100) NOT NULL,
  `pack_list_model` varchar(150) NOT NULL,
  `pack_list_qty` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `package_list`
--

INSERT INTO `package_list` (`pack_list_id`, `model_id`, `pack_list_model`, `pack_list_qty`) VALUES
(1, '3', 'MODEL1', 10),
(2, '3', 'MODEL2', 10);

-- --------------------------------------------------------

--
-- Table structure for table `product_model`
--

CREATE TABLE `product_model` (
  `model_id` int(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_model`
--

INSERT INTO `product_model` (`model_id`, `model`, `sku`, `type`, `status`, `created_by`, `created_at`) VALUES
(1, 'MODEL1', 'MODA', 'retail', 'Active', 'ADMIN', '2020-01-26'),
(2, 'MODEL2', 'MODB', 'retail', 'Active', 'ADMIN', '2020-01-26'),
(3, 'SUPER TWINS', 'PKG', 'package', 'Active', 'ADMIN', '2020-01-26');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `stock_id` int(255) NOT NULL,
  `product` varchar(255) NOT NULL,
  `warehouse` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`stock_id`, `product`, `warehouse`, `quantity`, `status`, `created_by`, `created_at`) VALUES
(1, 'MODEL2', 'WH1', 100, 'In Stock', 'ADMIN', '2020-01-26 13:50:30'),
(2, 'MODEL1', 'WH1', 100, 'In Stock', 'ADMIN', '2020-01-26 13:50:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `custID` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `custID`, `username`, `password`, `usertype`, `created_by`, `created_at`) VALUES
(1, '', 'admin', '123456', 'admin', '', '2019-12-22 14:01:49'),
(2, '', 'admin', '123456', 'admin', '', '2019-12-22 14:01:52'),
(3, 'STAFF1222190003', 'VINCE', 'VINCE', 'Admin', '', '2019-12-22 16:39:20'),
(6, 'STAFF0004', 'VINCENT', '123456', 'Admin', '', '2019-12-23 09:37:15'),
(7, 'STAFF0007', 'ABENG', 'ABENG123', 'Stock Officer', '', '2019-12-23 09:38:11'),
(8, 'STAFF0008', 'RENECE', '1234567890', 'Stock Officer', '', '2019-12-23 09:39:46'),
(9, 'STAFF0009', 'GNFDE', '44242', 'Admin', '', '2019-12-24 14:11:58'),
(10, 'STAFF0010', '131R4TRG', '6UYHRTER', 'Admin', '', '2019-12-24 14:12:21'),
(11, 'STAFF0011', 'FDVSEQE', '4342424', 'Admin', '', '2019-12-27 21:18:58'),
(12, 'STAFF0012', 'JOFF', 'NHJKETNHEJKT', 'Admin', '', '2019-12-27 21:22:25'),
(13, 'STAFF0013', 'HELLOWORLD', '62452423', 'Stock Officer', '', '2019-12-27 21:28:23'),
(14, 'STAFF0014', 'OGHRGJRWG', 'OIFJVOEFNG', 'Stock Officer', '', '2019-12-27 21:30:50'),
(15, 'STAFF0015', 'ADMIN00', '$2y$10$ztwyuBLZ9D1EceVz/1.7zen.ljn/Z4tOid8VZEPZUwx6qv0nvNz76', 'Admin', 'Admin', '2019-12-30 16:40:12'),
(17, 'STAFF0016', 'ADMIN01', '$2y$10$ixXHcejpim9KgC8IUQvtkOTcjBd.w40poOEGEcD7VOVJWNuj5hSJa', 'Admin', 'ADMIN00', '2020-01-01 22:48:51'),
(18, 'STAFF0018', 'L', '$2y$10$fE5CiSBspI6vVmQbxgt4Y.gG46PXDTQOQov.zOBsI8q7.nudkrza6', 'Admin', 'ADMIN000', '2020-01-11 12:03:53');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `warehouse_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`warehouse_id`, `name`, `address`, `created_by`, `created_at`) VALUES
(1, 'WH1', 'CAVITE', 'ADMIN', '2020-01-26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obdatatb`
--
ALTER TABLE `obdatatb`
  ADD PRIMARY KEY (`obdataID`);

--
-- Indexes for table `outboundtb`
--
ALTER TABLE `outboundtb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_list`
--
ALTER TABLE `package_list`
  ADD PRIMARY KEY (`pack_list_id`);

--
-- Indexes for table `product_model`
--
ALTER TABLE `product_model`
  ADD PRIMARY KEY (`model_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`warehouse_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `member_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `obdatatb`
--
ALTER TABLE `obdatatb`
  MODIFY `obdataID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `outboundtb`
--
ALTER TABLE `outboundtb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `package_list`
--
ALTER TABLE `package_list`
  MODIFY `pack_list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_model`
--
ALTER TABLE `product_model`
  MODIFY `model_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `stock_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `warehouse_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
