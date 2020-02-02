-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2020 at 11:12 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

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
  `status` varchar(20) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`member_id`, `name`, `refID`, `address`, `status`, `created_by`, `created_at`) VALUES
(7, 'TEST', 'FESD', 'ED', 'Inactive', 'ADMIN00', '2020-01-29'),
(8, 'MEMBER1', '1234', 'CAVITE', 'Inactive', 'ADMIN00', '2020-01-29'),
(9, 'PORCHIA', '0909', 'JKJ', 'Active', 'ADMIN00', '2020-01-29'),
(10, 'NEWBILI', '12345', 'CDO', 'Active', 'ADMIN00', '2020-01-29');

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
(7, 'ADMIN added new package', 'Details: SUPER TWINS, 3', '2020-01-26 13:50:58'),
(8, 'ADMIN00 Logged In', 'Details: ADMIN00, Admin IP:::1', '2020-01-28 11:06:18'),
(9, 'ADMIN00 added new warehouse', 'Details: WH2', '2020-01-28 11:07:33'),
(10, 'ADMIN00 added new product_model', 'Details: SASA, DASD', '2020-01-28 11:07:56'),
(11, 'ADMIN00 Logged Out', 'Details: ADMIN00, Admin IP:::1', '2020-01-28 11:12:20'),
(12, 'ADMIN00 Logged In', 'Details: ADMIN00, Admin IP:::1', '2020-01-28 12:48:11'),
(13, 'ADMIN00 added new warehouse', 'Details: DSADASD', '2020-01-28 12:52:33'),
(14, 'ADMIN00 added new warehouse', 'Details: UOHUHUH', '2020-01-28 12:56:04'),
(15, ' Logged Out', 'Details: , Admin IP:::1', '2020-01-28 17:32:35'),
(16, 'ADMIN00 Logged In', 'Details: ADMIN00, Admin IP:::1', '2020-01-28 20:17:35'),
(17, 'ADMIN00 Logged Out', 'Details: ADMIN00, Admin IP:::1', '2020-01-28 05:40:15'),
(18, 'ADMIN00 Logged In', 'Details: ADMIN00, Admin IP:::1', '2020-01-28 05:40:41'),
(19, 'ADMIN00 added new staff', 'Details: SSASA, Stock Officer', '2020-01-28 05:53:50'),
(20, 'ADMIN00 deleted staff', 'Details: STAFF0008', '2020-01-28 05:58:19'),
(21, 'ADMIN00 deleted staff', 'Details: STAFF0010', '2020-01-28 05:58:23'),
(22, 'ADMIN00 deleted staff', 'Details: ', '2020-01-28 05:58:27'),
(23, 'ADMIN00 deleted staff', 'Details: STAFF0012', '2020-01-28 05:58:52'),
(24, 'ADMIN00 deleted staff', 'Details: STAFF0009', '2020-01-28 05:58:59'),
(25, 'ADMIN00 updated customer', 'Details: JOFFPASCUAL, DAD2323E23', '2020-01-28 06:00:23'),
(26, 'ADMIN00 added new member', 'Details: DSADSA, 2', '2020-01-28 06:00:42'),
(27, 'ADMIN00 added new member', 'Details: FDFSDA, FDSAF', '2020-01-28 06:02:20'),
(28, 'ADMIN00 deleted warehouse', 'Details: 1', '2020-01-28 06:02:24'),
(29, 'ADMIN00 deleted warehouse', 'Details: 2', '2020-01-28 06:02:33'),
(30, 'ADMIN00 updated customer', 'Details: EQWEWQ, FDSAF', '2020-01-28 06:02:48'),
(31, 'ADMIN00 added new warehouse', 'Details: TEST', '2020-01-28 06:17:46'),
(32, 'ADMIN00 updated warehouse:5', 'Details: TEST', '2020-01-28 06:20:30'),
(33, 'ADMIN00 updated warehouse:5', 'Details: TEST', '2020-01-28 06:20:42'),
(34, 'ADMIN00 updated warehouse:5', 'Details: TEST1', '2020-01-28 06:21:50'),
(35, 'ADMIN00 updated warehouse:5', 'Details: TEST2', '2020-01-28 06:22:05'),
(36, 'ADMIN00 updated warehouse:5', 'Details: TEST3', '2020-01-28 06:22:20'),
(37, 'ADMIN00 updated warehouse:5', 'Address Details: TEST4', '2020-01-28 06:22:50'),
(38, 'ADMIN00 deleted warehouse', 'Details: 5', '2020-01-28 06:23:17'),
(39, 'ADMIN00 deleted warehouse', 'Details: ', '2020-01-28 06:30:25'),
(40, 'ADMIN00 deleted warehouse', 'Details: DSADASD', '2020-01-28 06:31:38'),
(41, 'ADMIN00 updated warehouse:2', 'Address Details: BALINTAWAK', '2020-01-28 06:33:53'),
(42, 'ADMIN00 updated warehouse:2', 'Address Details: BAGUIO', '2020-01-28 06:42:29'),
(43, 'ADMIN00 updated warehouse: WH2', 'Address Details: ILOCOS', '2020-01-28 06:43:37'),
(44, 'ADMIN00 deleted warehouse: WH2', 'Details: 2', '2020-01-28 06:43:53'),
(45, 'ADMIN00 added new warehouse', 'Details: WH3', '2020-01-28 06:45:03'),
(46, 'ADMIN00 updated warehouse: WH3', 'Address Details: CAVITE', '2020-01-28 06:45:18'),
(47, 'ADMIN00 deleted warehouse: WH3', 'Details: 6', '2020-01-28 06:46:09'),
(48, 'ADMIN00 added new warehouse', 'Details: ZXCZXC', '2020-01-28 06:47:13'),
(49, 'ADMIN00 deleted warehouse: ZXCZXC', 'Details: 7', '2020-01-28 06:47:20'),
(50, 'ADMIN00 deleted warehouse', 'Details: 3', '2020-01-28 06:47:31'),
(51, 'ADMIN00 added new member', 'Details: SCAS, 21', '2020-01-28 06:49:19'),
(52, 'ADMIN00 deleted warehouse', 'Details: 4', '2020-01-28 06:49:28'),
(53, 'ADMIN00 added new member', 'Details: DANNY, DANNYBOY', '2020-01-28 07:04:51'),
(54, 'ADMIN00 Logged In', 'Details: ADMIN00, Admin IP:::1', '2020-01-28 07:05:28'),
(55, 'ADMIN00 added new package', 'Details: DWADAW, 5', '2020-01-28 07:06:59'),
(56, 'ADMIN00 added new package', 'Details: DASDSA, 6', '2020-01-28 07:08:56'),
(57, 'ADMIN00 added new package', 'Details: DASDSADAS, 7', '2020-01-28 07:10:00'),
(58, 'ADMIN00 added new package', 'Details: VIP, 8', '2020-01-28 07:16:50'),
(59, 'ADMIN00 added new package', 'Details: VIP, 9', '2020-01-28 07:19:09'),
(60, 'ADMIN00 deleted Package', 'Details: 9', '2020-01-28 07:23:48'),
(61, 'ADMIN00 deleted Package', 'Details: 5', '2020-01-28 07:26:25'),
(62, 'ADMIN00 deleted Package', 'Details: DASDSA', '2020-01-28 07:27:15'),
(63, 'ADMIN00 added new package', 'Details: SUPER TWINS, 10', '2020-01-28 07:28:19'),
(64, 'ADMIN00 added new product_model', 'Details: MODEL1, DAS', '2020-01-28 07:31:37'),
(65, 'ADMIN00 deleted Product Model', 'Details: 4', '2020-01-28 07:36:26'),
(66, 'ADMIN00 deleted Product Model', 'Details: MODEL1', '2020-01-28 07:38:39'),
(67, 'ADMIN00 added new warehouse', 'Details: CEBU', '2020-01-28 07:49:01'),
(68, 'ADMIN00 added new warehouse', 'Details: TAAL', '2020-01-28 07:49:15'),
(69, 'ADMIN00 added new stock', 'Details: MODEL2, 100pcs', '2020-01-28 07:49:34'),
(70, 'ADMIN00 added new stock', 'Details: MODEL1, 100pcs', '2020-01-28 07:49:55'),
(71, 'ADMIN00 added new stock', 'Details: MODEL1, 100pcs on: TAAL', '2020-01-28 07:54:42'),
(72, 'ADMIN00  new stock replenished', 'Details: MODEL2, 100pcs on: TAAL', '2020-01-28 07:55:02'),
(73, 'ADMIN00  new stock replenished', 'Details: MODEL2, 100pcs on: TAAL', '2020-01-28 07:56:00'),
(74, 'ADMIN00 Logged Out', 'Details: ADMIN00, Admin IP:::1', '2020-01-28 08:07:08'),
(75, 'ADMIN00 Logged In', 'Details: ADMIN00, Admin IP:::1', '2020-01-28 14:43:38'),
(76, 'ADMIN00 added new package', 'Details: SUPER TWINS, 12', '2020-01-28 14:45:16'),
(77, 'ADMIN00 deleted Package', 'Details: SUPER TWINS', '2020-01-28 14:45:59'),
(78, 'ADMIN00 deleted Package', 'Details: SUPER TWINS', '2020-01-28 14:46:09'),
(79, 'ADMIN00 added new package', 'Details: DADA, 13', '2020-01-28 15:33:13'),
(80, 'ADMIN00 added new package', 'Details: PACK12, 14', '2020-01-28 15:35:59'),
(81, 'ADMIN00 added new package', 'Details: FSD, 15', '2020-01-28 15:56:18'),
(82, 'ADMIN00 added new package', 'Details: DA, 16', '2020-01-28 15:56:34'),
(83, 'ADMIN00 added new package', 'Details: DASDSA, 17', '2020-01-28 16:18:50'),
(84, 'ADMIN00 added new member', 'Details: VIN, CIN12E31', '2020-01-28 17:16:00'),
(85, 'ADMIN00 added new member', 'Details: TEST, FESD', '2020-01-28 17:28:27'),
(86, 'admin deleted warehouse', 'Details: 5', '2020-01-28 20:08:18'),
(87, 'admin added new product model', 'Details: ASD, ASD', '2020-01-28 20:14:14'),
(88, 'admin deleted Product Model', 'Details: ASD', '2020-01-28 20:15:10'),
(89, 'ADMIN00 Logged In', 'Details: ADMIN00, Admin IP:::1', '2020-01-28 20:16:39'),
(90, 'admin added new product model', 'Details: MODEL ASDADASDASD, 12312312312', '2020-01-28 20:17:49'),
(91, 'admin deleted Product Model', 'Details: MODEL ASDADASDASD', '2020-01-28 20:18:11'),
(92, 'admin deleted Package', 'Details: DASDSA', '2020-01-28 20:38:33'),
(93, 'admin deleted Package', 'Details: DA', '2020-01-28 20:38:44'),
(94, 'admin deleted Package', 'Details: FSD', '2020-01-28 20:38:49'),
(95, 'admin deleted Package', 'Details: DADA', '2020-01-28 20:39:22'),
(96, 'admin deleted Package', 'Details: DASDSADAS', '2020-01-28 20:39:33'),
(97, 'admin deleted Package', 'Details: VIP', '2020-01-28 20:39:37'),
(98, 'admin deleted Package', 'Details: PACK12', '2020-01-28 20:39:42'),
(99, 'admin Logged Out', 'Details: admin, Administrator IP:::1', '2020-01-28 20:53:49'),
(100, 'ADMIN00 Logged In', 'Details: ADMIN00, Admin IP:::1', '2020-01-28 20:53:57'),
(101, 'ADMIN00 added new product model', 'Details: ASD, ASD', '2020-01-28 21:11:28'),
(102, 'ADMIN00 deleted Product Model', 'Details: ASD', '2020-01-28 21:19:15'),
(103, 'ADMIN00 added new member', 'Details: MEMBER1, 23', '2020-01-29 00:52:08'),
(104, 'ADMIN00 updated customer', 'Details: MEMBER1, 1234', '2020-01-29 00:52:23'),
(105, 'ADMIN00 deleted warehouse', 'Details: 6', '2020-01-29 00:52:36'),
(106, 'ADMIN00 added new warehouse', 'Details: WAREHOUSE', '2020-01-29 00:53:05'),
(107, 'ADMIN00 updated warehouse: WAREHOUSE', 'Address Details: LAGUNA', '2020-01-29 00:53:24'),
(108, 'ADMIN00 deleted warehouse: TAAL', 'Details: 9', '2020-01-29 00:53:31'),
(109, 'ADMIN00 added new package', 'Details: BANYERA, 21', '2020-01-29 00:54:12'),
(110, 'ADMIN00 added new product model', 'Details: MODELO, MODO', '2020-01-29 00:56:48'),
(111, 'ADMIN00 added new stock', 'Details: MODELO, 100pcs on: CEBU', '2020-01-29 00:57:08'),
(112, 'ADMIN00  new stock replenished', 'Details: MODELO, 100pcs on: CEBU', '2020-01-29 01:07:03'),
(113, 'ADMIN00 deleted warehouse', 'Details: 8', '2020-01-29 01:26:54'),
(114, 'ADMIN00 added new member', 'Details: NEWBIE, 654564', '2020-01-29 01:29:31'),
(115, 'ADMIN00 updated customer', 'Details: NEWBIE, 0909', '2020-01-29 01:29:49'),
(116, 'ADMIN00 added new member', 'Details: NEWBILI, 123', '2020-01-29 01:58:05'),
(117, 'ADMIN00 update member', 'Details: NEWBILI, 12345', '2020-01-29 01:58:21'),
(118, 'ADMIN00 update member status', 'Details: 9', '2020-01-29 01:58:31'),
(119, 'ADMIN00 update member status', 'Details: 9', '2020-01-29 02:25:01'),
(120, 'ADMIN00 added new staff', 'Details: ABENGA, Admin', '2020-01-29 02:48:07'),
(121, ' Logged Out', 'Details: , Admin IP:::1', '2020-01-29 04:44:02'),
(122, 'ADMIN00 update member', 'Details: PORCHIA, 0909', '2020-01-31 01:10:13'),
(123, 'ADMIN00 added new warehouse', 'Details: ORIGIN', '2020-01-31 01:38:20'),
(124, 'ADMIN00 added new warehouse', 'Details: DESTINATION', '2020-01-31 01:38:35'),
(125, 'ADMIN00 added new product model', 'Details: ORIGIN PRODUCTS, ORIGIN PROD', '2020-01-31 01:39:34'),
(126, 'ADMIN00 added new product model', 'Details: DESTINATION PRODUCTS, DESTI ROD', '2020-01-31 01:39:52'),
(127, 'ADMIN00 added new stock', 'Details: ORIGIN PRODUCTS, 0pcs on: DESTINATION', '2020-01-31 01:40:17'),
(128, 'ADMIN00 added new stock', 'Details: DESTINATION PRODUCTS, 0pcs on: DESTINATION', '2020-01-31 01:40:27'),
(129, 'ADMIN00 added new stock', 'Details: ORIGIN PRODUCTS, 100pcs on: ORIGIN', '2020-01-31 01:51:20'),
(130, 'ADMIN00  new stock replenished', 'Details: ORIGIN PRODUCTS, 10pcs on: DESTINATION', '2020-01-31 03:13:03'),
(131, 'ADMIN00  new stock replenished', 'Details: ORIGIN PRODUCTS, 10pcs on: DESTINATION', '2020-01-31 03:19:17'),
(132, 'ADMIN00  new stock replenished', 'Details: ORIGIN PRODUCTS, 10pcs on: DESTINATION', '2020-01-31 03:21:08'),
(133, 'ADMIN00  new stock replenished', 'Details: ORIGIN PRODUCTS, 10pcs on: DESTINATION', '2020-01-31 03:23:43'),
(134, 'ADMIN00 Logged In', 'Details: ADMIN00, Admin IP:::1', '2020-02-01 05:27:23'),
(135, 'ADMIN00  new stock replenished', 'Details: ORIGIN PRODUCTS, 20pcs on: DESTINATION', '2020-02-01 05:59:37'),
(136, 'ADMIN00  new stock replenished', 'Details: ORIGIN PRODUCTS, 20pcs on: DESTINATION', '2020-02-01 06:02:45'),
(137, 'ADMIN00  new stock replenished', 'Details: ORIGIN PRODUCTS, 79pcs on: DESTINATION', '2020-02-01 06:05:07');

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
(1, '1', 'OBTX00000001', 'SUPER TWINS', 1),
(2, '2', 'OBTX00000002', 'MODEL1', 10),
(3, '2', 'OBTX00000002', 'MODEL2', 10),
(4, '2', 'OBTX00000002', 'SUPER TWINS', 1),
(5, '3', 'OBTX00000003', 'MODEL1', 5),
(6, '3', 'OBTX00000003', 'MODEL2', 10),
(7, '3', 'OBTX00000003', 'MODEL1', 5),
(8, '4', 'OBTX00000004', '', 12),
(9, '4', 'OBTX00000004', '', 10),
(10, '5', 'OBTX00000003', 'MODEL1', 10),
(11, '5', 'OBTX00000003', 'MODEL2', 10),
(12, '6', 'OBTX00000006', 'MODEL1', 10),
(13, '6', 'OBTX00000006', 'MODEL2', 10),
(14, '7', 'OBTX00000007', 'SUPER TWINS', 10),
(15, '7', 'OBTX00000007', 'MODEL2', 3),
(16, '7', 'OBTX00000007', 'MODEL1', 10),
(17, '8', 'OBTX00000008', 'MODEL1', 100),
(18, '9', 'OBTX00000009', 'MODEL2', 7),
(19, '10', 'OBTX00000010', 'MODEL2', 10),
(20, '10', 'OBTX00000010', 'MODEL1', 10),
(21, '11', 'OBTX00000011', 'MODEL1', 10),
(22, '11', 'OBTX00000011', 'MODELO', 10),
(23, '12', 'OBTX00000012', 'MODEL1', 10),
(24, '12', 'OBTX00000012', 'MODELO', 10);

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
(1, 'OBTX00000001', 'JOFFPASCUAL@GMAIL.CO', 'WH1', '2020-01-26', 'dsadas', 'Shipped', 'Fully Paid', 'dasdsad', 'ADMIN', '2020-01-26 13:51:25'),
(2, 'OBTX00000002', 'JOFFPASCUAL@GMAIL.CO', 'WH1', '2020-01-28', 'xsadsa', '', 'Fully Paid', 'DSADSADAS', 'ADMIN00', '2020-01-28 12:51:45'),
(5, 'OBTX00000003', 'DANNY', 'WH1', '2020-01-29', 'set1', 'Pick-up', 'Fully Paid', 'DANNY', 'ADMIN00', '2020-01-28 16:23:35'),
(6, 'OBTX00000006', 'DANNY', 'TAAL', '2020-01-29', 'set2', 'Pick-up', 'Fully Paid', 'DSD', 'ADMIN00', '2020-01-28 16:24:13'),
(7, 'OBTX00000007', 'DANNY', 'WH1', '2020-01-29', 'eses', 'Shipped', 'Fully Paid', 'SS', 'ADMIN00', '2020-01-28 17:01:29'),
(8, 'OBTX00000008', 'MEMBER1', 'WH1', '2020-01-29', 'ok', 'Shipped', 'Fully Paid', 'LBC 00000123123123', 'ADMIN00', '2020-01-29 01:23:11'),
(9, 'OBTX00000009', 'MEMBER1', 'WH1', '2020-01-29', '', 'Pick-up', 'Paid', 'ASDASDA', 'ADMIN00', '2020-01-29 01:25:20'),
(10, 'OBTX00000010', 'NEWBILI', 'WH1', '2020-01-29', 'dasdas', 'Shipped', 'Fully Paid', 'DSAD', 'ADMIN00', '2020-01-29 02:49:48'),
(11, 'OBTX00000011', 'NEWBIE', 'CEBU', '2020-01-29', 'asdas', 'Pick-up', 'Fully Paid', 'DSAD', 'ADMIN00', '2020-01-29 02:50:42'),
(12, 'OBTX00000012', 'NEWBILI', 'CEBU', '2020-01-15', 'asdasd', 'Pick-up', 'Unpaid', 'SADASD', 'ADMIN00', '2020-01-29 02:51:14');

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
(1, '3', 'MODEL1', 13),
(2, '3', 'MODEL2', 10),
(3, '5', '', 0),
(4, '6', '', 0),
(5, '7', '', 0),
(6, '8', '', 0),
(7, '9', 'MODEL1', 10),
(8, '9', 'MODEL2', 10),
(9, '9', 'MODEL1', 10),
(10, '9', 'MODEL2', 10),
(11, '10', 'MODEL1', 10),
(12, '10', 'MODEL2', 10),
(13, '12', 'MODEL1', 10),
(14, '13', '', 0),
(15, '14', '', 0),
(16, '15', '', 0),
(17, '16', '', 0),
(18, '17', '', 0),
(19, '21', 'MODEL1', 10),
(20, '21', 'MODEL2', 10);

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
(3, 'SUPER TWINS', 'PKG', 'package', 'Active', 'ADMIN', '2020-01-26'),
(21, 'BANYERA', 'PKG', 'package', 'Active', 'ADMIN00', '2020-01-29'),
(22, 'MODELO', 'MODO', 'retail', 'Active', 'ADMIN00', '2020-01-29'),
(23, 'ORIGIN PRODUCTS', 'ORIGIN PROD', 'retail', 'Active', 'ADMIN00', '2020-01-31'),
(24, 'DESTINATION PRODUCTS', 'DESTI ROD', 'retail', 'Active', 'ADMIN00', '2020-01-31');

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
(1, 'MODEL2', 'WH1', 30, 'In Stock', 'ADMIN', '2020-01-26 13:50:30'),
(2, 'MODEL1', 'WH1', 100, 'In Stock', 'ADMIN', '2020-01-26 13:50:42'),
(3, 'MODEL2', 'TAAL', 390, 'In Stock', 'ADMIN00', '2020-01-28 07:49:34'),
(4, 'MODEL1', 'CEBU', 80, 'In Stock', 'ADMIN00', '2020-01-28 07:49:55'),
(5, 'MODEL1', 'TAAL', 90, 'In Stock', 'ADMIN00', '2020-01-28 07:54:41'),
(6, 'MODELO', 'CEBU', 180, 'In Stock', 'ADMIN00', '2020-01-29 00:57:07'),
(8, 'DESTINATION PRODUCTS', 'DESTINATION', 0, 'In Stock', 'ADMIN00', '2020-01-31 01:40:27'),
(9, 'ORIGIN PRODUCTS', 'ORIGIN', 180, 'In Stock', 'ADMIN00', '2020-01-31 01:51:20');

-- --------------------------------------------------------

--
-- Table structure for table `transfertb`
--

CREATE TABLE `transfertb` (
  `transferId` int(11) NOT NULL,
  `trans_Id` varchar(200) NOT NULL,
  `warehouse_origin` varchar(150) NOT NULL,
  `warehouse_dest` varchar(150) NOT NULL,
  `product` varchar(150) NOT NULL,
  `quantity` int(11) NOT NULL,
  `trans_date` varchar(10) NOT NULL,
  `refNum` varchar(150) NOT NULL,
  `remarks` varchar(150) NOT NULL,
  `created_by` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transfertb`
--

INSERT INTO `transfertb` (`transferId`, `trans_Id`, `warehouse_origin`, `warehouse_dest`, `product`, `quantity`, `trans_date`, `refNum`, `remarks`, `created_by`, `created_at`) VALUES
(1, '', 'ORIGIN', 'DESTINATION', 'ORIGIN PRODUCTS', 20, '2020-02-01', 'dfgchvj6534', 'gdfxhfhcg45634w', 'ADMIN00', '2020-02-01 05:59:37'),
(2, 'TRANX00000001', 'ORIGIN', 'DESTINATION', 'ORIGIN PRODUCTS', 20, '2020-02-02', 'wdfrgfhg75645', 'dfszdgxfcnhgv564534', 'ADMIN00', '2020-02-01 06:02:44'),
(3, 'TRANX00000001', 'ORIGIN', 'DESTINATION', 'ORIGIN PRODUCTS', 79, '2020-02-01', 'fggh4634', 'fgdhfg654', 'ADMIN00', '2020-02-01 06:05:07'),
(4, 'TRANX00000001', 'ORIGIN', 'DESTINATION', 'ORIGIN PRODUCTS', 80, '2020-02-01', 'gn57645', 'fdfg3543', 'ADMIN00', '2020-02-01 06:07:04'),
(5, 'TRANX00000001', 'ORIGIN', 'DESTINATION', 'ORIGIN PRODUCTS', 80, '2020-02-01', 'fgnfhg43', 'fgdhf453r', 'ADMIN00', '2020-02-01 06:09:21'),
(6, '', 'ORIGIN', 'DESTINATION', 'ORIGIN PRODUCTS', 80, '2020-02-01', 'dfsd6453', 'vdbgfnh23', 'ADMIN00', '2020-02-01 06:10:32');

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
(3, 'STAFF1222190003', 'VINCE', 'VINCE', 'Admin', '', '2019-12-22 16:39:20'),
(6, 'STAFF0004', 'VINCENT', '123456', 'Admin', '', '2019-12-23 09:37:15'),
(7, 'STAFF0007', 'ABENGA', '$2y$10$1OyNxBIrNKQ5hf.0Ye2cIeEIhfU.9SeGCWItfBAdU9UOMzpjxnqyK', 'Admin', '', '2019-12-23 09:38:11'),
(11, 'STAFF0011', 'FDVSEQE', '4342424', 'Admin', '', '2019-12-27 21:18:58'),
(13, 'STAFF0013', 'HELLOWORLD', '62452423', 'Stock Officer', '', '2019-12-27 21:28:23'),
(14, 'STAFF0014', 'OGHRGJRWG', 'OIFJVOEFNG', 'Stock Officer', '', '2019-12-27 21:30:50'),
(15, 'STAFF0015', 'ADMIN00', '$2y$10$ztwyuBLZ9D1EceVz/1.7zen.ljn/Z4tOid8VZEPZUwx6qv0nvNz76', 'Admin', 'Admin', '2019-12-30 16:40:12'),
(17, 'STAFF0016', 'ADMIN01', '$2y$10$ixXHcejpim9KgC8IUQvtkOTcjBd.w40poOEGEcD7VOVJWNuj5hSJa', 'Admin', 'ADMIN00', '2020-01-01 22:48:51'),
(18, 'STAFF0018', 'L', '$2y$10$fE5CiSBspI6vVmQbxgt4Y.gG46PXDTQOQov.zOBsI8q7.nudkrza6', 'Admin', 'ADMIN000', '2020-01-11 12:03:53'),
(19, 'STAFF0019', 'SSASA', '$2y$10$IwPqe87H4Q6kmPc.vtHcmuwCUQDhUqrrl3qkEfQ6TFmYL5XHS/wEK', 'Stock Officer', 'ADMIN00', '2020-01-28 05:53:50');

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
(1, 'WH1', 'CAVITE', 'ADMIN', '2020-01-26'),
(8, 'CEBU', 'DSAD', 'ADMIN00', '2020-01-03'),
(10, 'WAREHOUSE', 'LAGUNA', 'ADMIN00', '2020-01-29'),
(11, 'ORIGIN', 'CAVITE', 'ADMIN00', '2020-01-31'),
(12, 'DESTINATION', 'LAS PINAS', 'ADMIN00', '2020-01-31');

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
-- Indexes for table `transfertb`
--
ALTER TABLE `transfertb`
  ADD PRIMARY KEY (`transferId`);

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
  MODIFY `member_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `obdatatb`
--
ALTER TABLE `obdatatb`
  MODIFY `obdataID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `outboundtb`
--
ALTER TABLE `outboundtb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `package_list`
--
ALTER TABLE `package_list`
  MODIFY `pack_list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `product_model`
--
ALTER TABLE `product_model`
  MODIFY `model_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `stock_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transfertb`
--
ALTER TABLE `transfertb`
  MODIFY `transferId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `warehouse_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
