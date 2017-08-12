-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 11, 2017 at 06:20 PM
-- Server version: 5.7.19-0ubuntu0.16.04.1
-- PHP Version: 7.0.18-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `companies_directory`
--

-- --------------------------------------------------------

--
-- Table structure for table `businesses_views`
--

CREATE TABLE `businesses_views` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `views` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `businesses_views`
--

INSERT INTO `businesses_views` (`id`, `company_id`, `views`) VALUES
(1, 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(15, 'Architecture'),
(2, 'Brand Design'),
(9, 'Catering'),
(13, 'Computer Accessories'),
(6, 'Cyber Security'),
(10, 'Dentist'),
(8, 'Events Decorations'),
(7, 'Events Management'),
(3, 'Hospitality'),
(1, 'IT Consulting'),
(4, 'Law Firm'),
(5, 'Software Development');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `description`, `address`, `email`, `phone`, `website`) VALUES
(1, 'Events Couture', 'Corporate and Social events planning, and management', '4, majaro street, fadeyi, lAGOS', 'info@eventscouture.com', '08066553378', 'eventcouture.com\r\n'),
(4, 'iNITS', 'pastedtextttxx\r\n					\r\n				', '2, majaro street, Onike Lagos', 'info@initsng.com', '09044556677', 'http://initsng.com');

-- --------------------------------------------------------

--
-- Table structure for table `companies_categories`
--

CREATE TABLE `companies_categories` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies_categories`
--

INSERT INTO `companies_categories` (`id`, `company_id`, `category_id`) VALUES
(1, 4, 15),
(2, 4, 2),
(3, 4, 9);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`) VALUES
(1, 'admin@admin.com', 'admin', '$1$4dpJ3xtD$XUihB98IWMj7A8TzofTjm0'),
(2, '', '', '$1$p6sqqf.v$mYxqnYu1kP9CM7FCTeJrN.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `businesses_views`
--
ALTER TABLE `businesses_views`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `company_id_2` (`company_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `website` (`website`);

--
-- Indexes for table `companies_categories`
--
ALTER TABLE `companies_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comp_cat_index` (`company_id`),
  ADD KEY `cat_comp_index` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `businesses_views`
--
ALTER TABLE `businesses_views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `companies_categories`
--
ALTER TABLE `companies_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
