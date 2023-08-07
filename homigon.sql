-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2023 at 09:26 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `homigon`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `phone` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `phone`, `email`) VALUES
(1, 'Admin', '1234', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `item_id` varchar(500) NOT NULL,
  `user_id` varchar(500) NOT NULL,
  `category` varchar(20) NOT NULL,
  `item_type` varchar(50) NOT NULL,
  `title` varchar(500) NOT NULL,
  `location` varchar(500) NOT NULL,
  `item_condition` varchar(50) NOT NULL,
  `nearest_bustop` varchar(500) NOT NULL,
  `number_of_rooms` varchar(11) NOT NULL,
  `amenities` varchar(50) NOT NULL,
  `number_of_toilets` varchar(11) NOT NULL,
  `price` varchar(11) NOT NULL,
  `number_of_bathrooms` varchar(11) NOT NULL,
  `additional_information` varchar(500) NOT NULL,
  `images` varchar(500) NOT NULL,
  `status` varchar(500) NOT NULL,
  `time` varchar(500) NOT NULL,
  `date` varchar(500) NOT NULL,
  `time_created` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item_id`, `user_id`, `category`, `item_type`, `title`, `location`, `item_condition`, `nearest_bustop`, `number_of_rooms`, `amenities`, `number_of_toilets`, `price`, `number_of_bathrooms`, `additional_information`, `images`, `status`, `time`, `date`, `time_created`) VALUES
(7, '64cead010d549', '64ccb4e83feaf', 'Rent', 'Flat', '3 Bedroom Flat', 'Eneka Road', 'Furnunised', 'Igwuruta Roundabout', '3', '[\"Good access road\",\"Security\",\"Light\"]', '4', '5000000', '3', 'None', '[\"64ceace64dfb5.png\",\"64ceacf1c224e.png\",\"64ceacfca70b4.png\"]', 'Inactive', '1691266305', '05-08-23', 'Aug,05,2023 10:11 PM'),
(8, '64ceada67fae0', '64ccb4e83feaf', 'Buy', 'Studio Apartment', 'Music Studio Apartment', 'Lekki', 'Unfurnished', 'Olu Junction', '4', '[\"Security\",\"Light\",\"Swimming Pool\"]', '3', '3000000', '3', 'Buyers are needed urgently', '[\"64cead977bf7a.png\",\"64ceada3b18f6.png\"]', 'Inactive', '1691266470', '05-08-23', 'Aug,05,2023 10:14 PM'),
(9, '64ceb1b972cc8', '64ccb4e83feaf', 'Lease', 'Boys Quarter', '6 Rooms Boys Qauter', 'Abuja', 'Furnunised', 'Kwala', '6', '[\"Good access road\",\"Light\"]', '5', '300000', '2', 'Empty', '[\"64ceb1b6beeec.png\"]', 'Inactive', '1691267513', '05-08-23', 'Aug,05,2023 10:31 PM'),
(10, '64ceb27485cac', '64ccb4e83feaf', 'Rent', 'Flat', '5 Room Duplex', 'Eneka Road', 'Furnunised', 'Genesis', '5', '[\"Good access road\",\"Security\"]', '4', '5000000', '5', 'Empty', '[\"64ceb271d88ca.png\"]', 'Inactive', '1691267700', '05-08-23', 'Aug,05,2023 10:35 PM');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `firstname` varchar(500) NOT NULL,
  `lastname` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `phone` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `image` varchar(500) NOT NULL,
  `is_owner_or_agent` varchar(500) NOT NULL,
  `status` varchar(500) NOT NULL,
  `time` varchar(500) NOT NULL,
  `date` varchar(500) NOT NULL,
  `time_created` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `user_type`, `firstname`, `lastname`, `email`, `phone`, `password`, `image`, `is_owner_or_agent`, `status`, `time`, `date`, `time_created`) VALUES
(5, '64ccb4e83feaf', 'Agent', 'John', 'Doe', 'john@gmail.com', '08023782363', '$2y$10$lnYyiTVdQngDWmFqPThWw.fGt162Vg/VHmwcGR8CaSVWezhLHM0uW', 'default.svg', 'Owner', 'Active', '1691137256', '04-08-23', 'Aug,04,2023 10:20 AM'),
(6, '64ccb536adbf6', 'Individual', 'Mary', 'Lanes', 'mary@gmail.com', '12612561233', '$2y$10$MlkYyue/N3i7bPjJF8hATe32yacV2xvEHfJhuDOsSbfYp/eRSkJxe', 'default.svg', 'Empty', 'Active', '1691137334', '04-08-23', 'Aug,04,2023 10:22 AM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
