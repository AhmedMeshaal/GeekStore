-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2018 at 06:45 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `product_list`
--

CREATE TABLE `product_list` (
  `product_id` int(4) NOT NULL,
  `product_name` varchar(55) NOT NULL,
  `original_price` int(20) NOT NULL,
  `sale_price` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_list`
--

INSERT INTO `product_list` (`product_id`, `product_name`, `original_price`, `sale_price`) VALUES
(101, 'Super Mario Villain Figure', 100, 100),
(105, 'Executive Knight Pen Holder	', 500, 300),
(108, 'Playstation 4 1T', 850, 1350),
(109, 'Playstation 4 500Gb', 700, 1050),
(110, 'Playstation 4 PRO 1T ', 1000, 1600),
(111, 'Playstation 4 PRO 500Gb', 900, 1400),
(112, 'Iphone 6s 32GB', 1300, 1750),
(113, 'Iphone 6s 64GB', 1500, 1900),
(114, 'Toshiba Laptop', 1200, 1500),
(115, 'HP Laptop', 1300, 1600),
(116, 'MSI Laptop', 1500, 2000),
(117, 'Lenovo Laptop', 2000, 2500),
(118, 'DELL Laptop', 2300, 2700),
(119, 'Acer Laptop', 2500, 2000),
(120, 'HTC Desire 10 PRO', 1000, 900),
(121, 'Samsung s7 16GB', 1500, 1300),
(122, 'Samsung s8 16GB', 1600, 1500),
(123, 'MAC Pro', 6000, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `registered_geeks`
--

CREATE TABLE `registered_geeks` (
  `user_name` varchar(55) NOT NULL,
  `date_registered` date NOT NULL,
  `email` varchar(55) NOT NULL,
  `first_name` varchar(55) NOT NULL,
  `last_name` varchar(55) NOT NULL,
  `address` varchar(55) NOT NULL,
  `city` varchar(55) NOT NULL,
  `country` varchar(55) NOT NULL,
  `postal_code` int(10) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `registered_geeks`
--

INSERT INTO `registered_geeks` (`user_name`, `date_registered`, `email`, `first_name`, `last_name`, `address`, `city`, `country`, `postal_code`, `user_id`) VALUES
('Ali', '2018-01-15', 'Ali@gmail.com', 'ali', 'qasim', 'pesalvinia', 'losangelos', 'usa', 1234, 1),
('hadieste', '2018-01-25', 'hadi4@hotmail.com', 'hadi', 'ayman', 'trables', 'trables', 'libya', 7889, 2),
('3mar', '2018-01-11', 'ushi43@gmail.com', 'amaar', 'hussein', 'north', 'madrid', 'spain', 45, 3),
('ahd', '2018-01-06', 'ahd@gmail.com', 'ahmed', 'Salman', 'andalus', 'almubarras', 'KSA', 1234, 4),
('khaled', '2018-02-19', 'khaled@gmail.com', 'Khaled', 'mohammed', 'andalus', 'almubarras', 'KSA', 98987, 5),
('mohammed123', '2018-01-13', 'mhd@gmail.com', 'mohammed', 'hafiz', 'andalus', 'almubarras', 'KSA', 986, 6);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `order_id` int(10) NOT NULL,
  `user_name` varchar(55) NOT NULL,
  `item_id` int(4) NOT NULL,
  `quantity` int(10) NOT NULL,
  `total_sales` float NOT NULL,
  `order_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`order_id`, `user_name`, `item_id`, `quantity`, `total_sales`, `order_date`) VALUES
(11, 'hadiesta', 101, 4, 400, '2018-11-25'),
(12, 'hadieste', 105, 2, 600, '2018-10-25'),
(13, 'Ali', 101, 3, 300, '2018-09-25'),
(16, 'mohammed123', 111, 2, 2800, '2018-01-05'),
(17, 'khaled', 116, 1, 2000, '2018-01-05'),
(18, 'khaled', 120, 1, 900, '2018-01-05'),
(19, 'khaled', 109, 1, 1050, '2018-03-03'),
(20, 'ahd', 105, 2, 600, '2018-05-03'),
(21, 'ahd', 116, 1, 2000, '2018-01-03'),
(22, '3mar', 123, 1, 5000, '2018-01-01'),
(23, '3mar', 113, 2, 3800, '2018-01-03'),
(24, '3mar', 108, 1, 1350, '2018-01-01'),
(25, '3mar', 105, 2, 600, '2018-01-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product_list`
--
ALTER TABLE `product_list`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `registered_geeks`
--
ALTER TABLE `registered_geeks`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `salepr` (`item_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product_list`
--
ALTER TABLE `product_list`
  MODIFY `product_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `registered_geeks`
--
ALTER TABLE `registered_geeks`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `salepr` FOREIGN KEY (`item_id`) REFERENCES `product_list` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
