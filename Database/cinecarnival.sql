-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2020 at 10:01 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinecarnival`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `a_id` int(6) NOT NULL,
  `full_name` varchar(30) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `phone` int(12) NOT NULL,
  `address` varchar(100) NOT NULL,
  `joining_date` date NOT NULL,
  `user_type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `c_id` int(10) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `phone` int(12) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `password` varchar(256) NOT NULL,
  `status` varchar(12) NOT NULL,
  `points` int(6) DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `user_type` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_id`, `gender`, `user_name`, `first_name`, `last_name`, `mail`, `phone`, `address`, `password`, `status`, `points`, `joining_date`, `user_type`) VALUES
(19, 'male', 'randy', 'Randy', 'Orton', 'randy.rko@gmail.com', 1798452091, 'USA.', '$2y$10$r/o5cwjP8r.Og1SO054NAuYOvwZZ5zhXyHnFHHz3grMVsnsUtS6g.', 'Regular', 0, '2020-03-21', 3),
(20, 'male', 'bond007', 'James', 'Bond', 'koushikur.aiub@gmail.com', 1798452091, 'London, England.', '$2y$10$v8cOb36RuLxdq6LRhs.oa..GlgePO1mpV7cOFKq/7qzheI.a6QkZ2', 'Regular', 0, '2020-03-21', 3),
(21, 'male', '@randy', 'Randy', 'Orton', 'randy.abc@gmail.com', 1798452091, 'Dhaka*BD^%%%', '$2y$10$Z2nGKyDP203syYBi1EoITuL7TLWpzNRwxVd1yAPUk1D1.puGFCscW', 'Regular', 0, '2020-03-21', 3);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `l_id` int(6) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `last_changed_date` date DEFAULT NULL,
  `user_type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`l_id`, `user_name`, `mail`, `password`, `last_changed_date`, `user_type`) VALUES
(11, 'randy', 'randy.rko@gmail.com', '$2y$10$r/o5cwjP8r.Og1SO054NAuYOvwZZ5zhXyHnFHHz3grMVsnsUtS6g.', NULL, 3),
(12, 'bond007', 'koushikur.aiub@gmail.com', '$2y$10$v8cOb36RuLxdq6LRhs.oa..GlgePO1mpV7cOFKq/7qzheI.a6QkZ2', '2020-03-21', 3),
(13, '@randy', 'randy.abc@gmail.com', '$2y$10$Z2nGKyDP203syYBi1EoITuL7TLWpzNRwxVd1yAPUk1D1.puGFCscW', NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `m_id` int(6) NOT NULL,
  `full_name` varchar(30) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `phone` int(12) NOT NULL,
  `address` varchar(100) NOT NULL,
  `joining_date` date NOT NULL,
  `salary` double(7,2) NOT NULL,
  `user_type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `mv_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `cast` varchar(150) NOT NULL,
  `director` varchar(30) NOT NULL,
  `release_date` date NOT NULL,
  `genre` varchar(50) NOT NULL,
  `trailer_link` varchar(300) NOT NULL,
  `cover_pic` varchar(300) NOT NULL,
  `runtime` time NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `n_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `message` varchar(255) NOT NULL,
  `links` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `poll`
--

CREATE TABLE `poll` (
  `p_id` int(11) NOT NULL,
  `movie` varchar(50) NOT NULL,
  `vote_count` int(6) NOT NULL,
  `rating` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `shows`
--

CREATE TABLE `shows` (
  `s_id` int(6) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `theatre_id` int(11) NOT NULL,
  `show_date` date NOT NULL,
  `show_time` time NOT NULL,
  `show_status` varchar(20) NOT NULL,
  `show_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `theatre`
--

CREATE TABLE `theatre` (
  `theatre_id` int(6) NOT NULL,
  `theatre_name` varchar(30) NOT NULL,
  `total_seat` int(2) NOT NULL,
  `available_seat` int(2) NOT NULL,
  `sold_seat` int(2) NOT NULL,
  `theatre_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` int(6) NOT NULL,
  `show_id` int(6) NOT NULL,
  `price` int(5) NOT NULL,
  `discount` int(5) NOT NULL,
  `sold_date_time` datetime NOT NULL,
  `payment_method` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_id`),
  ADD UNIQUE KEY `user_name` (`user_name`,`mail`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD UNIQUE KEY `user_name_2` (`user_name`,`mail`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`l_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD UNIQUE KEY `user_name_2` (`user_name`,`mail`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`m_id`),
  ADD UNIQUE KEY `user_name` (`user_name`,`mail`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`mv_id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`n_id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `poll`
--
ALTER TABLE `poll`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `shows`
--
ALTER TABLE `shows`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `theatre`
--
ALTER TABLE `theatre`
  ADD PRIMARY KEY (`theatre_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `a_id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `c_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `l_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `m_id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `mv_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `n_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `poll`
--
ALTER TABLE `poll`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shows`
--
ALTER TABLE `shows`
  MODIFY `s_id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `theatre`
--
ALTER TABLE `theatre`
  MODIFY `theatre_id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(6) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
