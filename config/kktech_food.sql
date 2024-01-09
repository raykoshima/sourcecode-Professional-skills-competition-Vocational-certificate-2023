-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2024 at 01:59 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kktech_food`
--

-- --------------------------------------------------------

--
-- Table structure for table `foodlist`
--

CREATE TABLE `foodlist` (
  `fl_id` int(20) NOT NULL,
  `fl_name` varchar(200) NOT NULL,
  `fl_price` int(7) NOT NULL,
  `fl_image` varchar(200) NOT NULL,
  `fl_soldout` int(1) NOT NULL,
  `fl_category` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `foodlist`
--

INSERT INTO `foodlist` (`fl_id`, `fl_name`, `fl_price`, `fl_image`, `fl_soldout`, `fl_category`) VALUES
(6, 'อุด้ง', 50, '6582b20d9b1cc6.97993810.jpg', 0, 7),
(7, 'ข้าวผัดหมูแซ่บๆ', 45, '6582b89ddec4e4.75124515.jpg', 0, 2),
(8, 'ต้มยำกุ้ง', 120, '6582b8b7753439.73475894.png', 0, 1),
(9, 'แกงไก่', 40, '6582b8e05b9505.96183050.jpg', 0, 3),
(10, 'ไก่ทอดโค้ก (ต่อชิ้น)', 12, '6582b8feb1a329.13300107.jpg', 0, 4),
(11, 'ไก่ทอดหาดใหญ่ (ต่อชิ้น)', 15, '6582b912f2adb8.01950348.jpg', 0, 4),
(12, 'กุ้งดอง', 100, '6582b93cc0c759.78948615.jpg', 0, 5),
(13, 'ปูม้าดองน้ำปลา', 120, '6582b96b3441e9.61254412.jpg', 0, 5),
(14, 'Green tea', 25, '6582b996574ae7.99393993.jpg', 0, 7),
(15, 'ส้มตำ', 40, '6582ba20d1c170.11078841.jpg', 0, 8),
(16, 'ตำข้าวโพด', 50, '6582ba3e79ce44.65449227.jpg', 0, 8);

-- --------------------------------------------------------

--
-- Table structure for table `food_category`
--

CREATE TABLE `food_category` (
  `fc_id` int(20) NOT NULL,
  `fc_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food_category`
--

INSERT INTO `food_category` (`fc_id`, `fc_name`) VALUES
(1, 'ต้ม'),
(2, 'ผัด'),
(3, 'แกง'),
(4, 'ทอด'),
(5, 'ดอง'),
(7, 'ญี่ปุ่น'),
(8, 'อีสาน');

-- --------------------------------------------------------

--
-- Table structure for table `food_review`
--

CREATE TABLE `food_review` (
  `fr_id` int(20) NOT NULL,
  `fr_writer_u_id` int(20) NOT NULL,
  `fr_score` int(5) NOT NULL,
  `fr_review` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` int(20) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `role` varchar(10) NOT NULL,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `avatar` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `username`, `password`, `role`, `first_name`, `last_name`, `avatar`) VALUES
(1, 'admin', '123', '54', 'Supakorn', 'Navamavad', '658277be906a60.38106590.gif'),
(2, 'rayko', '123', '1', 'rayko', 'maru', 'avatar.png'),
(3, 'pasin', '123', '1', 'Pasin', 'Karunkiea', '6582b846802996.78246358.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_buy_history`
--

CREATE TABLE `user_buy_history` (
  `uh_id` int(20) NOT NULL,
  `uh_order_id` int(20) NOT NULL,
  `uh_paid_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_order`
--

CREATE TABLE `user_order` (
  `order_id` int(20) NOT NULL,
  `order_fl_id` int(20) NOT NULL,
  `order_amout` int(10) NOT NULL,
  `order_ispaid` int(1) NOT NULL,
  `order_owner_u_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_order`
--

INSERT INTO `user_order` (`order_id`, `order_fl_id`, `order_amout`, `order_ispaid`, `order_owner_u_id`) VALUES
(5, 5, 4, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `webconfig`
--

CREATE TABLE `webconfig` (
  `title` varchar(200) NOT NULL,
  `icon` varchar(200) NOT NULL,
  `brand` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `webconfig`
--

INSERT INTO `webconfig` (`title`, `icon`, `brand`) VALUES
('KKTECH ONLINE FOOD ORDER SYSTEM', '/upload/web/fast-food.png', 'Ozshop');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `foodlist`
--
ALTER TABLE `foodlist`
  ADD PRIMARY KEY (`fl_id`);

--
-- Indexes for table `food_category`
--
ALTER TABLE `food_category`
  ADD PRIMARY KEY (`fc_id`);

--
-- Indexes for table `food_review`
--
ALTER TABLE `food_review`
  ADD PRIMARY KEY (`fr_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `user_buy_history`
--
ALTER TABLE `user_buy_history`
  ADD PRIMARY KEY (`uh_id`);

--
-- Indexes for table `user_order`
--
ALTER TABLE `user_order`
  ADD PRIMARY KEY (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `foodlist`
--
ALTER TABLE `foodlist`
  MODIFY `fl_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `food_category`
--
ALTER TABLE `food_category`
  MODIFY `fc_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `food_review`
--
ALTER TABLE `food_review`
  MODIFY `fr_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_buy_history`
--
ALTER TABLE `user_buy_history`
  MODIFY `uh_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_order`
--
ALTER TABLE `user_order`
  MODIFY `order_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
