-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2019 at 06:02 PM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adaptinventorydb_1_0_3`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

CREATE TABLE `auth` (
  `auth_id` int(11) NOT NULL,
  `auth_username` varchar(250) NOT NULL,
  `auth_password` varchar(250) NOT NULL,
  `full_name` varchar(250) NOT NULL,
  `user_type_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth`
--

INSERT INTO `auth` (`auth_id`, `auth_username`, `auth_password`, `full_name`, `user_type_id`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'Admin', 1),
(2, 'nick', 'e10adc3949ba59abbe56e057f20f883e', 'Nick Kollaja', 2),
(3, 'jhonny', 'e10adc3949ba59abbe56e057f20f883e', 'johnny russell', 3);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cus_id` int(11) NOT NULL,
  `cus_name` varchar(250) NOT NULL,
  `cus_mobile` varchar(250) NOT NULL,
  `cus_email` varchar(250) NOT NULL,
  `cus_address` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expense_orders`
--

CREATE TABLE `expense_orders` (
  `exp_order_id` int(11) NOT NULL,
  `auth_id` int(11) NOT NULL,
  `exp_order_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expense_types`
--

CREATE TABLE `expense_types` (
  `expense_type_id` int(11) NOT NULL,
  `expense_type_name` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `exp_invoices`
--

CREATE TABLE `exp_invoices` (
  `exp_invoice_number` int(11) NOT NULL,
  `exp_order_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `exp_invoice_line_items`
--

CREATE TABLE `exp_invoice_line_items` (
  `exp_invoice_items_id` int(11) NOT NULL,
  `exp_order_id` int(11) NOT NULL,
  `exp_invoice_id` int(11) NOT NULL,
  `exp_product_name` varchar(250) NOT NULL,
  `exp_product_quantity` int(11) NOT NULL,
  `exp_product_rate` int(11) NOT NULL,
  `exp_total_price` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `exp_invoice_payment_detail`
--

CREATE TABLE `exp_invoice_payment_detail` (
  `exp_invoice_payment_id` int(11) NOT NULL,
  `auth_id` int(11) NOT NULL,
  `exp_order_id` int(11) NOT NULL,
  `expense_type_id` int(11) NOT NULL,
  `exp_invoice_id` int(11) NOT NULL,
  `exp_grand_total_price` int(11) NOT NULL,
  `exp_paid_amount` int(11) NOT NULL,
  `exp_due_amount` int(11) NOT NULL,
  `exp_payment_detail_date` date NOT NULL,
  `exp_payment_detail_status` tinyint(1) NOT NULL,
  `exp_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `invoice_number` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_line_items`
--

CREATE TABLE `invoice_line_items` (
  `order_items_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `invoice_no_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_rate` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `total_price` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_payment_detail`
--

CREATE TABLE `invoice_payment_detail` (
  `invoice_payment_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `invoice_no_id` int(11) NOT NULL,
  `total_discount` int(11) NOT NULL,
  `grand_total_price` int(11) NOT NULL,
  `paid_amount` int(11) NOT NULL,
  `due_amount` int(11) NOT NULL,
  `payment_detail_date` date NOT NULL,
  `auth_id` int(11) NOT NULL,
  `payment_detail_status` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lang`
--

CREATE TABLE `lang` (
  `lang_id` int(11) NOT NULL,
  `lang` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lang`
--

INSERT INTO `lang` (`lang_id`, `lang`) VALUES
(1, 'en');

-- --------------------------------------------------------

--
-- Table structure for table `loan_contract`
--

CREATE TABLE `loan_contract` (
  `loan_contract_id` int(11) NOT NULL,
  `loaner_id` int(11) NOT NULL,
  `date_contract_start` date NOT NULL,
  `date_contract_end` date NOT NULL,
  `loan_amount` int(11) NOT NULL,
  `terms_and_conditions` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loan_needer`
--

CREATE TABLE `loan_needer` (
  `loaner_id` int(11) NOT NULL,
  `loaner_name` varchar(250) NOT NULL,
  `loaner_mobile` varchar(250) NOT NULL,
  `loaner_address` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loan_payments`
--

CREATE TABLE `loan_payments` (
  `payment_id` int(11) NOT NULL,
  `loan_contract_id` int(11) NOT NULL,
  `date_of_payment` date NOT NULL,
  `amount_of_payment` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `loan_status` varchar(250) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `auth_id` int(11) NOT NULL,
  `date_order_placed` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `product_model` varchar(250) NOT NULL,
  `product_sku` varchar(250) NOT NULL,
  `product_image` varchar(250) NOT NULL,
  `product_detail` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_detail`
--

CREATE TABLE `product_detail` (
  `productdetail_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `w_id` int(11) NOT NULL,
  `datepicker_mfg_date` date NOT NULL,
  `datepicker_exp_date` date NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_sell_price` int(11) NOT NULL,
  `product_supplier_price` int(11) NOT NULL,
  `dead_stock` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `setting_id` int(11) NOT NULL,
  `setting_name` varchar(250) NOT NULL,
  `setting_logo` varchar(250) NOT NULL,
  `setting_address` varchar(250) NOT NULL,
  `setting_city` varchar(250) NOT NULL,
  `setting_country` varchar(250) NOT NULL,
  `setting_phone` varchar(250) NOT NULL,
  `setting_fax` varchar(250) NOT NULL,
  `setting_web` varchar(250) NOT NULL,
  `setting_currency` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`setting_id`, `setting_name`, `setting_logo`, `setting_address`, `setting_city`, `setting_country`, `setting_phone`, `setting_fax`, `setting_web`, `setting_currency`) VALUES
(1, 'Adapt Inventory Management', 'adaptinventory-png.png', '1 Infinite Loop', '95014 Cuperino, CA', 'United States', '800-692-7753', '800-692-7753', 'www.adaptinventory.com', 'â‚¬');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(250) NOT NULL,
  `supplier_contact_name` varchar(250) NOT NULL,
  `supplier_email` varchar(250) NOT NULL,
  `supplier_phone` varchar(250) NOT NULL,
  `supplier_address` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers_orders`
--

CREATE TABLE `suppliers_orders` (
  `exp_order_id` int(11) NOT NULL,
  `auth_id` int(11) NOT NULL,
  `exp_order_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sup_invoices`
--

CREATE TABLE `sup_invoices` (
  `exp_invoice_number` int(11) NOT NULL,
  `exp_order_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sup_invoice_line_items`
--

CREATE TABLE `sup_invoice_line_items` (
  `exp_invoice_items_id` int(11) NOT NULL,
  `exp_order_id` int(11) NOT NULL,
  `exp_invoice_id` int(11) NOT NULL,
  `exp_product_name` varchar(250) NOT NULL,
  `exp_product_quantity` int(11) NOT NULL,
  `exp_product_rate` int(11) NOT NULL,
  `exp_total_price` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sup_invoice_payment_detail`
--

CREATE TABLE `sup_invoice_payment_detail` (
  `exp_invoice_payment_id` int(11) NOT NULL,
  `auth_id` int(11) NOT NULL,
  `exp_order_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `exp_invoice_id` int(11) NOT NULL,
  `exp_grand_total_price` int(11) NOT NULL,
  `exp_paid_amount` int(11) NOT NULL,
  `exp_due_amount` int(11) NOT NULL,
  `sup_invoice_image` varchar(250) NOT NULL,
  `exp_payment_detail_date` date NOT NULL,
  `exp_payment_detail_status` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_type`
--

CREATE TABLE `users_type` (
  `user_type_id` int(11) NOT NULL,
  `user_type` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_type`
--

INSERT INTO `users_type` (`user_type_id`, `user_type`) VALUES
(1, 'Super Admin'),
(2, 'Salesman'),
(3, 'Accountant');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `war_id` int(11) NOT NULL,
  `war_name` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`auth_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `expense_orders`
--
ALTER TABLE `expense_orders`
  ADD PRIMARY KEY (`exp_order_id`);

--
-- Indexes for table `expense_types`
--
ALTER TABLE `expense_types`
  ADD PRIMARY KEY (`expense_type_id`);

--
-- Indexes for table `exp_invoices`
--
ALTER TABLE `exp_invoices`
  ADD PRIMARY KEY (`exp_invoice_number`);

--
-- Indexes for table `exp_invoice_line_items`
--
ALTER TABLE `exp_invoice_line_items`
  ADD PRIMARY KEY (`exp_invoice_items_id`);

--
-- Indexes for table `exp_invoice_payment_detail`
--
ALTER TABLE `exp_invoice_payment_detail`
  ADD PRIMARY KEY (`exp_invoice_payment_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`invoice_number`);

--
-- Indexes for table `invoice_line_items`
--
ALTER TABLE `invoice_line_items`
  ADD PRIMARY KEY (`order_items_id`);

--
-- Indexes for table `invoice_payment_detail`
--
ALTER TABLE `invoice_payment_detail`
  ADD PRIMARY KEY (`invoice_payment_id`);

--
-- Indexes for table `lang`
--
ALTER TABLE `lang`
  ADD PRIMARY KEY (`lang_id`);

--
-- Indexes for table `loan_contract`
--
ALTER TABLE `loan_contract`
  ADD PRIMARY KEY (`loan_contract_id`);

--
-- Indexes for table `loan_needer`
--
ALTER TABLE `loan_needer`
  ADD PRIMARY KEY (`loaner_id`);

--
-- Indexes for table `loan_payments`
--
ALTER TABLE `loan_payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_detail`
--
ALTER TABLE `product_detail`
  ADD PRIMARY KEY (`productdetail_id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `suppliers_orders`
--
ALTER TABLE `suppliers_orders`
  ADD PRIMARY KEY (`exp_order_id`);

--
-- Indexes for table `sup_invoices`
--
ALTER TABLE `sup_invoices`
  ADD PRIMARY KEY (`exp_invoice_number`);

--
-- Indexes for table `sup_invoice_line_items`
--
ALTER TABLE `sup_invoice_line_items`
  ADD PRIMARY KEY (`exp_invoice_items_id`);

--
-- Indexes for table `sup_invoice_payment_detail`
--
ALTER TABLE `sup_invoice_payment_detail`
  ADD PRIMARY KEY (`exp_invoice_payment_id`);

--
-- Indexes for table `users_type`
--
ALTER TABLE `users_type`
  ADD PRIMARY KEY (`user_type_id`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`war_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth`
--
ALTER TABLE `auth`
  MODIFY `auth_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `expense_orders`
--
ALTER TABLE `expense_orders`
  MODIFY `exp_order_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `expense_types`
--
ALTER TABLE `expense_types`
  MODIFY `expense_type_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `exp_invoices`
--
ALTER TABLE `exp_invoices`
  MODIFY `exp_invoice_number` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `exp_invoice_line_items`
--
ALTER TABLE `exp_invoice_line_items`
  MODIFY `exp_invoice_items_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `exp_invoice_payment_detail`
--
ALTER TABLE `exp_invoice_payment_detail`
  MODIFY `exp_invoice_payment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `invoice_number` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invoice_line_items`
--
ALTER TABLE `invoice_line_items`
  MODIFY `order_items_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invoice_payment_detail`
--
ALTER TABLE `invoice_payment_detail`
  MODIFY `invoice_payment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lang`
--
ALTER TABLE `lang`
  MODIFY `lang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `loan_contract`
--
ALTER TABLE `loan_contract`
  MODIFY `loan_contract_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `loan_needer`
--
ALTER TABLE `loan_needer`
  MODIFY `loaner_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `loan_payments`
--
ALTER TABLE `loan_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_detail`
--
ALTER TABLE `product_detail`
  MODIFY `productdetail_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `suppliers_orders`
--
ALTER TABLE `suppliers_orders`
  MODIFY `exp_order_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sup_invoices`
--
ALTER TABLE `sup_invoices`
  MODIFY `exp_invoice_number` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sup_invoice_line_items`
--
ALTER TABLE `sup_invoice_line_items`
  MODIFY `exp_invoice_items_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sup_invoice_payment_detail`
--
ALTER TABLE `sup_invoice_payment_detail`
  MODIFY `exp_invoice_payment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_type`
--
ALTER TABLE `users_type`
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `war_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
