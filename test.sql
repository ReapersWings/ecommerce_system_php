-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2024-03-22 09:52:22
-- 服务器版本： 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- 表的结构 `add_cart`
--

CREATE TABLE `add_cart` (
  `ac_id` int(11) NOT NULL,
  `buyer_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `add_cart`
--

INSERT INTO `add_cart` (`ac_id`, `buyer_id`, `product_id`, `status`) VALUES
(1, 1, 13, 'order'),
(2, 1, 14, 'order'),
(4, 1, 13, 'order'),
(5, 1, 13, 'order'),
(6, 1, 13, 'order'),
(7, 1, 14, 'order'),
(8, 1, 13, 'order'),
(9, 1, 14, 'delete'),
(10, 1, 14, 'order'),
(11, 1, 13, 'order'),
(12, 1, 14, 'order'),
(13, 1, 13, 'delete'),
(14, 1, 13, 'order'),
(15, 1, 13, 'order'),
(16, 1, 13, 'order'),
(17, 1, 13, 'order'),
(18, 1, 13, 'delete'),
(19, 1, 15, 'order'),
(20, 1, 13, 'delete'),
(21, 1, 13, 'order'),
(22, 1, 15, 'order'),
(23, 1, 13, 'order'),
(24, 1, 14, 'order');

-- --------------------------------------------------------

--
-- 表的结构 `buyer`
--

CREATE TABLE `buyer` (
  `s_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- 转存表中的数据 `buyer`
--

INSERT INTO `buyer` (`s_id`, `username`, `password`, `email`, `first_name`, `last_name`, `phone_number`) VALUES
(1, '1', '$2y$10$vwLlriAvk06gYg1qdrVU6uX8BdShWknJ9yos36Bizoer6koet0Bie', '1@gmail.com', '1', '23', '011-1111111'),
(2, '2', '$2y$10$koY33DbUIj6vT9MnJuGAjObeKWhsGJm3wHOmUP/vxGqPx4T8/Bs5e', '2@gmail.com', '2', '34', '022-22222222');

-- --------------------------------------------------------

--
-- 表的结构 `category`
--

CREATE TABLE `category` (
  `c_id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `category`
--

INSERT INTO `category` (`c_id`, `category`) VALUES
(1, 'sample'),
(3, 'example'),
(4, 'f'),
(5, '31241'),
(6, '141245');

-- --------------------------------------------------------

--
-- 表的结构 `order_list`
--

CREATE TABLE `order_list` (
  `ol_id` int(11) NOT NULL,
  `seller_id` int(255) NOT NULL,
  `buyer_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `order_quantity` int(255) NOT NULL,
  `total_price` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `order_list`
--

INSERT INTO `order_list` (`ol_id`, `seller_id`, `buyer_id`, `product_id`, `order_quantity`, `total_price`, `status`) VALUES
(5, 1, 1, 13, 10, '550.00', 'complete'),
(6, 1, 1, 13, 1, '55.00', 'complete'),
(7, 1, 1, 13, 4, '220.00', 'complete'),
(8, 1, 1, 13, 10, '550.00', 'complete'),
(9, 1, 1, 13, 30, '1650.00', 'complete'),
(10, 1, 1, 14, 5, '275.00', 'complete'),
(11, 1, 1, 13, 6, '330.00', 'complete'),
(12, 1, 1, 14, 10, '550.00', 'complete'),
(13, 1, 1, 13, 7, '385.00', 'complete'),
(14, 1, 1, 14, 10, '550.00', 'on_the_way'),
(15, 1, 1, 13, 12, '660.00', 'complete'),
(16, 1, 1, 13, 1, '55.00', 'order'),
(17, 1, 1, 13, 5, '275.00', 'order'),
(18, 1, 1, 13, 10, '550.00', 'order'),
(19, 1, 1, 13, 10, '550.00', 'order'),
(20, 1, 1, 13, 5, '275.00', 'order'),
(21, 2, 1, 15, 12, '30', 'order'),
(22, 1, 1, 13, 1, '55', 'order'),
(23, 1, 1, 13, 6, '330', 'order'),
(24, 1, 1, 13, 6, '330', 'order'),
(25, 1, 1, 13, 4, '220', 'order'),
(26, 1, 1, 13, 5, '275', 'order'),
(27, 2, 1, 15, 20, '50', 'order'),
(28, 1, 1, 14, 10, '550', 'order'),
(29, 1, 1, 13, 10, '550', 'order');

-- --------------------------------------------------------

--
-- 表的结构 `product`
--

CREATE TABLE `product` (
  `p_id` int(11) NOT NULL,
  `product_img` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `category_id` int(255) NOT NULL,
  `seller_id` int(255) NOT NULL,
  `price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `product`
--

INSERT INTO `product` (`p_id`, `product_img`, `product_name`, `quantity`, `category_id`, `seller_id`, `price`) VALUES
(13, 'Capture9.PNG', 'example', 40, 1, 1, '55'),
(14, 'Capture.PNG', '1', 0, 3, 1, '55'),
(15, 'Capture5.PNG', '2', 80, 3, 2, '2.5');

-- --------------------------------------------------------

--
-- 表的结构 `seller`
--

CREATE TABLE `seller` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `shope_name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `seller`
--

INSERT INTO `seller` (`id`, `username`, `password`, `email`, `shope_name`, `phone_number`) VALUES
(1, '1', '$2y$10$uyW2CdItvRxwlHzaT/no5.YuCe1A2yBqKs62LDTaz3qeAT4RdO2eC', '1@gmail.com', '11', '011-1111111'),
(2, '2', '$2y$10$KGZlIobD4y8WJm09zzi9nOLy5NwilSgGkN5PR1kGbINIznnvrxO1.', '2@gmail.com', '22', '022-22222222');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_cart`
--
ALTER TABLE `add_cart`
  ADD PRIMARY KEY (`ac_id`);

--
-- Indexes for table `buyer`
--
ALTER TABLE `buyer`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`ol_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `add_cart`
--
ALTER TABLE `add_cart`
  MODIFY `ac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- 使用表AUTO_INCREMENT `buyer`
--
ALTER TABLE `buyer`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `category`
--
ALTER TABLE `category`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `order_list`
--
ALTER TABLE `order_list`
  MODIFY `ol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- 使用表AUTO_INCREMENT `product`
--
ALTER TABLE `product`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- 使用表AUTO_INCREMENT `seller`
--
ALTER TABLE `seller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
