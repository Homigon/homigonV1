-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2023 at 07:35 AM
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
(1, 'Admin', '1234', '09012786344', 'support@homigon.com');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Buy'),
(3, 'Rent'),
(4, 'Lease');

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
(7, '64cead010d549', '64ccb4e83feaf', 'Rent', 'Studio Apartment', '3 Bedroom Flat', 'Eneka Road', 'Furnunised', 'Igwuruta Roundabout', '3', '[\"Good access road\",\"Security\",\"Light\"]', '4', '5000000', '3', 'None', '[\"64ceace64dfb5.png\",\"64ceacf1c224e.png\",\"64ceacfca70b4.png\",\"64d0a375ea52d.png\",\"64d0a37ec1d36.png\"]', 'Inactive', '1691266305', '05-08-23', 'Aug,05,2023 10:11 PM'),
(8, '64ceada67fae0', '64ccb4e83feaf', 'Buy', 'Studio Apartment', 'Music Studio Apartment', 'Lekki', 'Unfurnished', 'Olu Junction', '4', '[\"Security\",\"Light\",\"Swimming Pool\"]', '3', '3000000', '3', 'Buyers are needed urgently', '[\"64cead977bf7a.png\",\"64ceada3b18f6.png\"]', 'Active', '1691266470', '05-08-23', 'Aug,05,2023 10:14 PM'),
(10, '64ceb27485cac', '64ccb4e83feaf', 'Rent', 'Flat', '5 Room Duplex', 'Eneka Road', 'Furnunised', 'Genesis', '5', '[\"Good access road\",\"Security\"]', '4', '5000000', '5', 'Empty', '[\"64ceb271d88ca.png\"]', 'Active', '1691267700', '05-08-23', 'Aug,05,2023 10:35 PM');

-- --------------------------------------------------------

--
-- Table structure for table `password_recovery_keys`
--

CREATE TABLE `password_recovery_keys` (
  `id` int(11) NOT NULL,
  `user_id` varchar(500) NOT NULL,
  `key_id` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `password_recovery_keys`
--

INSERT INTO `password_recovery_keys` (`id`, `user_id`, `key_id`) VALUES
(1, '64ccb4e83feaf', '64d50f2ecd843');

-- --------------------------------------------------------

--
-- Table structure for table `saved_items`
--

CREATE TABLE `saved_items` (
  `id` int(11) NOT NULL,
  `item_id` varchar(500) NOT NULL,
  `user_id` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `saved_items`
--

INSERT INTO `saved_items` (`id`, `item_id`, `user_id`) VALUES
(9, '64cead010d549', '64ccb536adbf6'),
(15, '64ceada67fae0', '64ccb4e83feaf'),
(17, '64ceb27485cac', '64ccb4e83feaf'),
(19, '64ceb27485cac', '64d5a19cd71fa');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `name`) VALUES
(1, 'Flat'),
(3, 'Studio Apartment'),
(4, 'Boys Quarter');

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
  `verification_status` varchar(500) NOT NULL,
  `time` varchar(500) NOT NULL,
  `date` varchar(500) NOT NULL,
  `time_created` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `user_type`, `firstname`, `lastname`, `email`, `phone`, `password`, `image`, `is_owner_or_agent`, `status`, `verification_status`, `time`, `date`, `time_created`) VALUES
(5, '64ccb4e83feaf', 'Agent', 'John', 'Doe', 'john@gmail.com', '08023782363', '$2y$10$jZcdz.Pam/4PzsvB6EnYXuXsOYTbNLI9jpcZL.HwzTR/HEOZ.P75i', 'default.svg', 'Owner', 'Active', 'Verified', '1691137256', '04-08-23', 'Aug,04,2023 10:20 AM'),
(7, '64d5a0b13e658', 'Individual', 'Mary', 'Lanes', 'mary@gmail.com', '09038784758', '$2y$10$0HkgwxHmG/4aGDO09r32AuA36yzfwbnNuoSfGUsy9AoyL2K7MI0bS', 'default.svg', 'Empty', 'Active', 'Not Verified', '1691721907', '11-08-23', 'Aug,11,2023 04:45 AM'),
(8, '64d5a19cd71fa', 'Agent', 'James', 'Cowell', 'james@gmail.com', '08023782363', '$2y$10$yNh/pJghKSKgUQvQT/20cehj3BP3eeixz6rj5pf32SpLQCrFgrzJS', 'default.svg', 'Owner', 'Active', 'Not Verified', '1691722141', '11-08-23', 'Aug,11,2023 04:49 AM');

-- --------------------------------------------------------

--
-- Table structure for table `verifications`
--

CREATE TABLE `verifications` (
  `id` int(11) NOT NULL,
  `verification_id` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `firstname` varchar(500) NOT NULL,
  `lastname` varchar(500) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `date_of_birth` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(500) NOT NULL,
  `country` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `lga` varchar(500) NOT NULL,
  `residential_area` varchar(500) NOT NULL,
  `means_of_identification` varchar(500) NOT NULL,
  `identification_number` varchar(500) NOT NULL,
  `images` varchar(500) NOT NULL,
  `status` varchar(500) NOT NULL,
  `time` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `time_created` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `verifications`
--

INSERT INTO `verifications` (`id`, `verification_id`, `user_id`, `firstname`, `lastname`, `gender`, `date_of_birth`, `phone`, `email`, `country`, `state`, `lga`, `residential_area`, `means_of_identification`, `identification_number`, `images`, `status`, `time`, `date`, `time_created`) VALUES
(3, '64d4815a02112', '64ccb4e83feaf', 'John', 'Doe', 'male', '10_August_1973', '08023782363', 'john@gmail.com', 'Nigeria', 'Cross River', 'Cross', 'GRA', 'National Identification Card', '83474364343', '[\"64d4814bbfd6c.png\",\"64d48154d874f.png\"]', 'Verified', '1691648346', '10-08-23', 'Aug,10,2023 08:19 AM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_recovery_keys`
--
ALTER TABLE `password_recovery_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saved_items`
--
ALTER TABLE `saved_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verifications`
--
ALTER TABLE `verifications`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `password_recovery_keys`
--
ALTER TABLE `password_recovery_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `saved_items`
--
ALTER TABLE `saved_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `verifications`
--
ALTER TABLE `verifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
