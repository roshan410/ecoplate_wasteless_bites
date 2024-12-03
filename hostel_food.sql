-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2024 at 07:03 AM
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
-- Database: `hostel_food`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `uname` varchar(10) NOT NULL,
  `psw` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`uname`, `psw`) VALUES
('admin', '11');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `rollno` varchar(50) NOT NULL,
  `feedback` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `noti`
--

CREATE TABLE `noti` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `notification` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `rollno` varchar(50) NOT NULL,
  `day_order` varchar(20) NOT NULL,
  `meal_type` varchar(50) NOT NULL,
  `month` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `food_items` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `order_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `date1` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `dep` varchar(100) NOT NULL,
  `year` varchar(100) NOT NULL,
  `rollno` varchar(50) NOT NULL,
  `roomno` varchar(20) NOT NULL,
  `guard` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `weekly_menu`
--

CREATE TABLE `weekly_menu` (
  `id` int(11) NOT NULL,
  `day_of_week` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
  `meal_type` enum('Breakfast','Lunch','Snacks','Dinner') NOT NULL,
  `food_item` varchar(50) NOT NULL,
  `price` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `weekly_menu`
--

INSERT INTO `weekly_menu` (`id`, `day_of_week`, `meal_type`, `food_item`, `price`) VALUES
(1, 'Monday', 'Breakfast', 'Idli with Coconut Chutney', '50.00'),
(2, 'Monday', 'Lunch', 'Dal Makhani with Rice', '150.00'),
(3, 'Monday', 'Snacks', 'Samosa', '30.00'),
(4, 'Monday', 'Dinner', 'Paneer Butter Masala with Naan', '180.00'),
(5, 'Tuesday', 'Breakfast', 'Aloo Paratha with Curd', '60.00'),
(6, 'Tuesday', 'Lunch', 'Vegetable Biryani', '140.00'),
(7, 'Tuesday', 'Snacks', 'Pakora', '25.00'),
(8, 'Tuesday', 'Dinner', 'Chole Bhature', '160.00'),
(9, 'Wednesday', 'Breakfast', 'Poha with Sev', '40.00'),
(10, 'Wednesday', 'Lunch', 'Rajma Chawal', '130.00'),
(11, 'Wednesday', 'Snacks', 'Vada Pav', '20.00'),
(12, 'Wednesday', 'Dinner', 'Masala Dosa with Sambar', '150.00'),
(13, 'Thursday', 'Breakfast', 'Masala Uttapam', '55.00'),
(14, 'Thursday', 'Lunch', 'Aloo Gobhi with Roti', '120.00'),
(15, 'Thursday', 'Snacks', 'Bhel Puri', '25.00'),
(16, 'Thursday', 'Dinner', 'Chicken Curry with Rice', '180.00'),
(17, 'Friday', 'Breakfast', 'Puri Bhaji', '50.00'),
(18, 'Friday', 'Lunch', 'Butter Chicken with Naan', '200.00'),
(19, 'Friday', 'Snacks', 'Kachori', '35.00'),
(20, 'Friday', 'Dinner', 'Fish Curry with Rice', '190.00'),
(21, 'Saturday', 'Breakfast', 'Dhokla', '45.00'),
(22, 'Saturday', 'Lunch', 'Vegetable Thali', '150.00'),
(23, 'Saturday', 'Snacks', 'Chaat', '40.00'),
(24, 'Saturday', 'Dinner', 'Egg Curry with Rice', '170.00'),
(25, 'Sunday', 'Breakfast', 'Chole Kulche', '60.00'),
(26, 'Sunday', 'Lunch', 'Mutton Biryani', '220.00'),
(27, 'Sunday', 'Snacks', 'Pani Puri', '30.00'),
(28, 'Sunday', 'Dinner', 'Dal Tadka with Roti', '140.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `noti`
--
ALTER TABLE `noti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weekly_menu`
--
ALTER TABLE `weekly_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `noti`
--
ALTER TABLE `noti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `weekly_menu`
--
ALTER TABLE `weekly_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
