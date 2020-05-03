-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2020 at 08:14 PM
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
(1, 'male', '@shohag', 'koushikur islam', 'shohag', 'koushikur.aiub@gmail.com', 1798452091, 'E-295, Holy Lane, Shyamoli, Adabor, Dhaka', '$2y$10$jTLxsT1GtgTfMWa4I265yuTSNvcj.VVW.nh3QSyUbguDysa/Ui15e', 'Perl', 525, '2020-04-17', 3);

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
(1, '@shohag', 'koushikur.aiub@gmail.com', '$2y$10$jTLxsT1GtgTfMWa4I265yuTSNvcj.VVW.nh3QSyUbguDysa/Ui15e', '2020-04-19', 3);

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
  `trailer_link` varchar(300) DEFAULT 'No trailer currently',
  `cover_pic` varchar(300) NOT NULL,
  `runtime` time NOT NULL,
  `plot` varchar(1500) DEFAULT 'No plot currently...',
  `language` varchar(10) DEFAULT 'English',
  `format` varchar(2) DEFAULT '2D',
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`mv_id`, `name`, `cast`, `director`, `release_date`, `genre`, `trailer_link`, `cover_pic`, `runtime`, `plot`, `language`, `format`, `status`) VALUES
(1, 'Black Widow', 'Florence Pugh, Robert Downey Jr., Scarlett Johansson', 'Cate Shortland', '2020-11-06', 'Action, Sci-Fi', 'https://www.youtube.com/embed/ybji16u608U', '..\\images/poster/BlackWidow.jpg', '00:02:45', 'A film about Natasha Romanoff in her quests between the films Civil War and Infinity War.', 'English', '3D', 'Coming Soon'),
(2, 'Thor-Love and Thunder', 'Chris Hemsworth, Taika Waititi, Tessa Thompson ', 'Taika Waititi', '2022-02-18', 'Action, Adventure, Fantasy', 'https://www.youtube.com/embed/mqKAhsp-QqQ', '..\\images/poster/ThorLoveAndThunder.jpg', '00:02:35', 'The sequel to Thor: Ragnarok and the fourth movie in the Thor saga.', 'English', '3D', 'Coming Soon'),
(3, 'F9', ' Amber Sienna, Charlize Theron, Vin Diesel', ' Justin Lin', '2021-04-02', ' Action, Adventure, Crime', 'https://www.youtube.com/embed/aSiDu3Ywi8E', '..\\images/poster/F9.jpg', '00:02:15', 'Cypher enlists the help of Jakob, Doms younger brother to take revenge on Dom and his team.', 'English', '2D', 'Coming Soon'),
(4, 'John Wick: Chapter 3', 'Keanu Reeves, Halle Berry, Ian McShane', ' Chad Stahelski', '2019-05-17', 'Action, Crime, Thriller', 'https://www.youtube.com/embed/pU8-7BX9uxs', '..\\images/poster/JohnWick3.jpg', '00:02:25', 'John Wick is on the run after killing a member of the international assassins guild, and with a $14 million price tag on his head, he is the target of hit men and women everywhere.', 'English', '2D', 'Now Showing'),
(5, 'Joker', 'Joaquin Phoenix, Robert De Niro, Zazie Beetz', 'Todd Phillips', '2019-10-04', 'Crime, Drama, Thriller', 'https://www.youtube.com/embed/zAGVQLHvwOY', '..\\images/poster/Joker.jpg', '00:02:15', 'In Gotham City, mentally troubled comedian Arthur Fleck is disregarded and mistreated by society. He then embarks on a downward spiral of revolution and bloody crime. This path brings him face-to-face with his alter-ego: the Joker.', 'English', '3D', 'Now Showing'),
(6, 'Avengers: Endgame', 'Robert Downey Jr., Chris Evans, Mark Ruffalo', 'Anthony Russo, Joe Russo', '2019-04-26', 'Action, Adventure, Sci-Fi', 'https://www.youtube.com/embed/TcMBFSGVi1c', '..\\images/Poster/EndGame.jpg', '00:02:40', 'After the devastating events of Avengers: Infinity War (2018), the universe is in ruins. With the help of remaining allies, the Avengers assemble once more in order to reverse Thanos actions and restore balance to the universe.', 'English', '3D', 'Now Showing'),
(7, 'Avengers: Infinity War', 'Robert Downey Jr., Chris Hemsworth, Mark Ruffalo', 'Anthony Russo, Joe Russo', '2018-04-27', 'Action, Adventure, Sci-Fi', 'https://www.youtube.com/embed/6ZfuNTqbHE8', '..\\images/Poster/InfinityWar.jpg', '00:02:45', 'The Avengers and their allies must be willing to sacrifice all in an attempt to defeat the powerful Thanos before his blitz of devastation and ruin puts an end to the universe.', 'English', '3D', 'Now Showing'),
(8, '\r\nNo Time to Die', ' Ana de Armas, Daniel Craig, Léa Seydoux', 'Cary Joji Fukunaga', '2020-11-25', 'Action, Adventure, Thriller', 'https://www.youtube.com/embed/BIhNsAtPbPI', '..\\images/Poster/NoTimeToDieCover.jpg', '00:02:35', 'James Bond has left active service. His peace is short-lived when Felix Leiter, an old friend from the CIA, turns up asking for help, leading Bond onto the trail of a mysterious villain armed with dangerous new technology.', 'English', '3D', 'Coming Soon'),
(12, 'No Dorai', 'Sayed Babu, Sunerah Binte Kamal, Josefine Lindegaard', 'Taneem Rahman Angshu', '2019-11-29', 'Drama', 'https://www.youtube.com/embed/EUnQZTofMo0', '..\\images/poster/NoDorai.jpg', '00:02:30', 'In a small beach town in Bangladesh, fearless Ayesha confronts social prohibition and violent opposition from her poverty-ridden family to surf. Like few other youngsters, she and her best friend Sohel are trained by self-made Bangladeshi surfer, Amir. As this unusual surfing enthusiasm gets international attention from surfing community and documentary film makers, fund money generates jealousy, squabbles, and power tussles. While surfing brings newfound fame and glory to Sohel, it is the prohibited love for surfing that brings forced marriage and a life of misery for Ayesha. After seeking an extravagant, reckless lifestyle in the capital city, derailed Sohel returns back to Coxs Bazar, where their passion for surfing reunites them and unleashes a new hope for surfing in the small beach town.', 'Bangla', '2D', 'Now Showing'),
(13, 'Bloodshot', 'Vin Diesel, Eiza González, Sam Heughan', 'Dave Wilson', '2020-03-13', ' Action, Drama, Sci-Fi', 'https://www.youtube.com/embed/vOUVVDWdXbo', '..\\images/poster/Bloodshot.jpg', '00:01:50', 'Ray Garrison, a slain soldier, is re-animated with superpowers.', 'English', 'En', '3D');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `n_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `links` varchar(255) DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `date_posted` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`n_id`, `title`, `message`, `links`, `pic`, `date_posted`) VALUES
(1, 'Stay Safe During COVID-19.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea earum, officiis culpa tenetur sequi beatae aliquam. Laboriosam, exercitationem maxime ea expedita molestias illum officiis aliquam quo recusandae iusto, esse sed.', 'https://www.who.int/bangladesh/emergencies/coronavirus-disease-(covid-19)-update', '..\\images/notice/COVID-19.png', '2030-05-02');

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE `offer` (
  `o_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `date_valid` date NOT NULL,
  `date_inserted` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offer`
--

INSERT INTO `offer` (`o_id`, `title`, `pic`, `date_valid`, `date_inserted`) VALUES
(1, 'Pay with rocket to get discount.', '..\\images/rocketOffer.jpg', '2020-05-02', '2020-05-02'),
(2, 'Get offer with payment on SCBL Cards.', '..\\images/StandardCharteredOffer.jpg', '2020-05-06', '2020-05-03'),
(3, 'Cashback or discount with bKash payment.', '..\\images/bKashOffer.jpg', '2020-05-02', '2020-05-04'),
(4, 'Pay with rocket to get discount.', '..\\images/rocketOffer.jpg', '2020-05-02', '2020-05-02'),
(5, 'Pay with rocket to get discount.', '..\\images/rocketOffer.jpg', '2020-05-02', '2020-05-02'),
(6, 'Get offer with payment on SCBL Cards.', '..\\images/StandardCharteredOffer.jpg', '2020-05-06', '2020-05-03');

-- --------------------------------------------------------

--
-- Table structure for table `poll`
--

CREATE TABLE `poll` (
  `p_id` int(11) NOT NULL,
  `poll_title` varchar(100) NOT NULL,
  `content1` varchar(50) DEFAULT NULL,
  `content2` varchar(50) DEFAULT NULL,
  `content3` varchar(50) DEFAULT NULL,
  `content4` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `poll`
--

INSERT INTO `poll` (`p_id`, `poll_title`, `content1`, `content2`, `content3`, `content4`) VALUES
(1, 'Which movie you want to see at CineCarnival?', 'Blood Shot', 'Thor', 'End Game', 'Iron Man'),
(2, 'How do you rate the movie No Time To Die', 'Excellent', 'Good', 'Average', 'Poor');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `r_id` int(11) NOT NULL,
  `movie_id` int(4) NOT NULL,
  `rating` double(3,2) NOT NULL,
  `customer` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`r_id`, `movie_id`, `rating`, `customer`) VALUES
(5, 6, 2.50, ''),
(6, 7, 5.00, '@shohag'),
(7, 8, 2.00, '@shohag'),
(8, 12, 4.00, ''),
(9, 5, 5.00, ''),
(10, 5, 4.50, '@shohag'),
(11, 5, 4.00, '@shohag'),
(12, 8, 3.50, ''),
(13, 12, 4.00, '@shohag');

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

--
-- Dumping data for table `shows`
--

INSERT INTO `shows` (`s_id`, `movie_id`, `theatre_id`, `show_date`, `show_time`, `show_status`, `show_type`) VALUES
(1, 6, 1, '2020-04-29', '10:45:00', 'Now Showing', '3D'),
(2, 4, 2, '2020-04-29', '12:30:00', 'Now Showing', '2D'),
(3, 12, 4, '2020-04-29', '17:30:00', 'Now Showing', '2D'),
(4, 8, 5, '2020-04-29', '14:45:00', 'Now Showing', '3D'),
(5, 6, 5, '2020-04-30', '12:45:00', 'Now Showing', '3D'),
(6, 3, 7, '2020-04-30', '10:15:00', 'Now Showing', '2D'),
(7, 4, 7, '2020-04-30', '18:15:00', 'Now Showing', '3D');

-- --------------------------------------------------------

--
-- Table structure for table `theatre`
--

CREATE TABLE `theatre` (
  `theatre_id` int(6) NOT NULL,
  `s_id` int(4) DEFAULT NULL,
  `theatre_name` varchar(30) NOT NULL,
  `total_seat` int(2) NOT NULL DEFAULT 50,
  `available_seat` int(2) NOT NULL DEFAULT 50,
  `sold_seat` int(2) DEFAULT 0,
  `theatre_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `theatre`
--

INSERT INTO `theatre` (`theatre_id`, `s_id`, `theatre_name`, `total_seat`, `available_seat`, `sold_seat`, `theatre_type`) VALUES
(1, 1, 'Hall-5', 50, 26, 24, 'VIP'),
(2, 2, 'Hall-3', 50, 45, 5, 'REGULAR'),
(4, 3, 'Hall-3', 50, 47, 3, 'REGULAR'),
(5, 4, 'Hall-1', 50, 50, 0, 'PREMIUM'),
(6, 5, 'Hall-1', 50, 47, 3, 'PREMIUM'),
(7, 6, 'Hall-3', 50, 50, 0, 'REGULAR'),
(8, 7, 'Hall-5', 50, 50, 0, 'VIP');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` int(6) NOT NULL,
  `c_id` int(4) NOT NULL,
  `show_id` int(6) NOT NULL,
  `price` double(7,2) NOT NULL,
  `discount` double(7,2) DEFAULT 0.00,
  `sold_date_time` date NOT NULL,
  `seat_number` varchar(50) NOT NULL,
  `seat_count` int(2) NOT NULL DEFAULT 0,
  `payment_method` varchar(15) DEFAULT 'Cash'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `c_id`, `show_id`, `price`, `discount`, `sold_date_time`, `seat_number`, `seat_count`, `payment_method`) VALUES
(1, 1, 1, 1200.00, 0.00, '2020-04-17', 'HC-1, HC-2, ', 2, 'DBBL Payment '),
(2, 1, 1, 1800.00, 0.00, '2020-04-19', 'HC-3, HC-4, HC-5, ', 3, 'DBBL Payment '),
(3, 1, 1, 1800.00, 0.00, '2020-04-20', 'HC-6, HC-7, HC-8, ', 3, 'DBBL Payment '),
(4, 1, 5, 1350.00, 0.00, '2020-04-29', 'HC-1, HC-2, HC-3, ', 3, 'DBBL Payment '),
(5, 1, 3, 750.00, 0.00, '2020-04-29', 'HC-1, HC-2, HC-3, ', 3, 'SCB Payment '),
(6, 1, 2, 500.00, 0.00, '2020-04-29', 'HC-1, HC-2, ', 2, 'SCB Payment '),
(7, 1, 2, 750.00, 0.00, '2020-04-29', 'HC-3, HC-4, HC-5, ', 3, 'DBBL Payment '),
(8, 1, 1, 900.00, 300.00, '2020-04-29', 'HC-9, HC-10, ', 2, 'DBBL Payment '),
(9, 1, 1, 1350.00, 450.00, '2020-04-29', 'HC-11, HC-12, HC-13, ', 3, 'DBBL Payment '),
(10, 1, 1, 450.00, 150.00, '2020-04-29', 'HC-14, ', 1, 'DBBL Payment '),
(11, 1, 1, 450.00, 150.00, '2020-04-29', 'HC-15, ', 1, 'DBBL Payment '),
(12, 1, 1, 780.00, 420.00, '2020-04-29', 'HC-16, HC-17, ', 2, 'DBBL Payment '),
(13, 1, 1, 1200.00, 0.00, '2020-04-29', 'HC-18, HC-19, ', 2, 'DBBL Payment '),
(14, 1, 1, 600.00, 0.00, '2020-04-29', 'HC-20,', 1, 'DBBL Payment '),
(15, 1, 1, 1200.00, 0.00, '2020-04-29', 'HC-21, HC-22,', 2, 'DBBL Payment '),
(16, 1, 1, 900.00, 300.00, '2020-04-30', 'HC-23, HC-24,', 2, 'SCB Payment ');

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `v_id` int(11) NOT NULL,
  `p_id` int(4) NOT NULL,
  `content` int(3) DEFAULT 0,
  `customer` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vote`
--

INSERT INTO `vote` (`v_id`, `p_id`, `content`, `customer`) VALUES
(7, 1, 2, '0'),
(8, 1, 4, '0'),
(9, 1, 3, '0'),
(10, 1, 4, '0'),
(11, 1, 3, '0'),
(12, 1, 1, '0'),
(13, 1, 1, '0'),
(14, 1, 1, '0'),
(15, 1, 4, '0'),
(16, 1, 1, '0'),
(17, 1, 1, '0'),
(18, 1, 1, '0'),
(19, 1, 1, '0'),
(20, 1, 1, '0'),
(21, 1, 2, '0'),
(22, 1, 3, '0'),
(23, 1, 2, '0'),
(24, 1, 1, '0'),
(25, 1, 3, '0'),
(26, 1, 1, '0'),
(27, 1, 3, '@shohag'),
(28, 1, 2, ''),
(29, 1, 2, '@shohag'),
(30, 1, 3, '@shohag'),
(31, 1, 4, ''),
(32, 1, 3, '@shohag'),
(33, 1, 4, '@shohag'),
(34, 1, 1, ''),
(35, 1, 3, '@shohag'),
(36, 1, 2, ''),
(37, 2, 1, ''),
(38, 2, 3, '');

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
-- Indexes for table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `poll`
--
ALTER TABLE `poll`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`r_id`);

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
-- Indexes for table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`v_id`);

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
  MODIFY `c_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `l_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `m_id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `mv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `n_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `poll`
--
ALTER TABLE `poll`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `shows`
--
ALTER TABLE `shows`
  MODIFY `s_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `theatre`
--
ALTER TABLE `theatre`
  MODIFY `theatre_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
