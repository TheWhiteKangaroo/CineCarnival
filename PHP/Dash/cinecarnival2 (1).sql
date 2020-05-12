-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2020 at 06:15 AM
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
-- Database: `cinecarnival2`
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
(1, 'male', '@shohag', 'koushikur islam', 'shohag', 'koushikur.aiub@gmail.com', 1798452091, 'E-295, Holy Lane, Shyamoli, Adabor, Dhaka', '$2y$10$l7gMfQwrXOzzB5gfe7hwFOMMzcHp.GOewfcXh3wH1Bak.jL2ZaPJa', 'Regular', 0, '2020-04-17', 3);

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
(1, '@shohag', 'koushikur.aiub@gmail.com', '$2y$10$l7gMfQwrXOzzB5gfe7hwFOMMzcHp.GOewfcXh3wH1Bak.jL2ZaPJa', NULL, 3);

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
  `cover_pic` longblob NOT NULL,
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
(1, 'Black Widow', 'Florence Pugh, Robert Downey Jr., Scarlett Johansson', 'Cate Shortland', '2020-11-06', 'Action, Sci-Fi', 'https://www.youtube.com/embed/ybji16u608U', 0x2e2e5c696d616765732f706f737465722f426c61636b5769646f772e6a7067, '00:02:45', 'A film about Natasha Romanoff in her quests between the films Civil War and Infinity War.', 'English', '3D', 'Coming Soon'),
(2, 'Thor-Love and Thunder', 'Chris Hemsworth, Taika Waititi, Tessa Thompson ', 'Taika Waititi', '2022-02-18', 'Action, Adventure, Fantasy', 'https://www.youtube.com/embed/mqKAhsp-QqQ', 0x2e2e5c696d616765732f706f737465722f54686f724c6f7665416e645468756e6465722e6a7067, '00:02:35', 'The sequel to Thor: Ragnarok and the fourth movie in the Thor saga.', 'English', '3D', 'Coming Soon'),
(3, 'F9', ' Amber Sienna, Charlize Theron, Vin Diesel', ' Justin Lin', '2021-04-02', ' Action, Adventure, Crime', 'https://www.youtube.com/embed/aSiDu3Ywi8E', 0x2e2e5c696d616765732f706f737465722f46392e6a7067, '00:02:15', 'Cypher enlists the help of Jakob, Doms younger brother to take revenge on Dom and his team.', 'English', '2D', 'Coming Soon'),
(4, 'John Wick: Chapter 3', 'Keanu Reeves, Halle Berry, Ian McShane', ' Chad Stahelski', '2019-05-17', 'Action, Crime, Thriller', 'https://www.youtube.com/embed/pU8-7BX9uxs', 0x2e2e5c696d616765732f706f737465722f4a6f686e5769636b332e6a7067, '00:02:25', 'John Wick is on the run after killing a member of the international assassins guild, and with a $14 million price tag on his head, he is the target of hit men and women everywhere.', 'English', '2D', 'Now Showing'),
(5, 'Joker', 'Joaquin Phoenix, Robert De Niro, Zazie Beetz', 'Todd Phillips', '2019-10-04', 'Crime, Drama, Thriller', 'https://www.youtube.com/embed/zAGVQLHvwOY', 0x2e2e5c696d616765732f706f737465722f4a6f6b65722e6a7067, '00:02:15', 'In Gotham City, mentally troubled comedian Arthur Fleck is disregarded and mistreated by society. He then embarks on a downward spiral of revolution and bloody crime. This path brings him face-to-face with his alter-ego: the Joker.', 'English', '3D', 'Now Showing'),
(6, 'Avengers: Endgame', 'Robert Downey Jr., Chris Evans, Mark Ruffalo', 'Anthony Russo, Joe Russo', '2019-04-26', 'Action, Adventure, Sci-Fi', 'https://www.youtube.com/embed/TcMBFSGVi1c', 0x2e2e5c696d616765732f506f737465722f456e6447616d652e6a7067, '00:02:40', 'After the devastating events of Avengers: Infinity War (2018), the universe is in ruins. With the help of remaining allies, the Avengers assemble once more in order to reverse Thanos actions and restore balance to the universe.', 'English', '3D', 'Now Showing'),
(7, 'Avengers: Infinity War', 'Robert Downey Jr., Chris Hemsworth, Mark Ruffalo', 'Anthony Russo, Joe Russo', '2018-04-27', 'Action, Adventure, Sci-Fi', 'https://www.youtube.com/embed/6ZfuNTqbHE8', 0x2e2e5c696d616765732f506f737465722f496e66696e6974795761722e6a7067, '00:02:45', 'The Avengers and their allies must be willing to sacrifice all in an attempt to defeat the powerful Thanos before his blitz of devastation and ruin puts an end to the universe.', 'English', '3D', 'Now Showing'),
(8, '\r\nNo Time to Die', ' Ana de Armas, Daniel Craig, Léa Seydoux', 'Cary Joji Fukunaga', '2020-11-25', 'Action, Adventure, Thriller', 'https://www.youtube.com/embed/BIhNsAtPbPI', 0x2e2e5c696d616765732f506f737465722f4e6f54696d65546f446965436f7665722e6a7067, '00:02:35', 'James Bond has left active service. His peace is short-lived when Felix Leiter, an old friend from the CIA, turns up asking for help, leading Bond onto the trail of a mysterious villain armed with dangerous new technology.', 'English', '3D', 'Coming Soon'),
(9, 'দিন-The Day', 'Ananta Jalil', 'Mustafa Ottash Zamzam', '2020-11-25', 'Action,Thriller', 'https://www.youtube.com/embed/-DX1T_sJ-bs', 0x2e2e5c696d616765732f506f737465722f44696e5468654461792e6a7067, '00:02:30', 'Din: The Day’ is an action-thriller film which is about the peaceful teachings of Islam. The film will be a protest against the negative propaganda demonizing Islam and inciting terrorism thats plaguing our world today.', 'Bangla', '3D', 'Coming Soon'),
(10, 'Khoj, the Search', ' Ananta Jalil, Eamin Haque Bobby, Borsha', 'Iftakar Chowdhury', '2020-04-16', 'Action,Thriller', 'https://www.youtube.com/embed/2qapQ5Rrzrc', 0x2e2e5c696d616765732f506f737465722f4b686f6a5468655365617263682e6a7067, '00:02:45', 'The film features Major Mahmud Starred by Ananta (M A Jalil. Major Mahmud is a secret service agent who works for Bangladesh Counter Intelligence (BCI). BCI is a fictional agency (from the Masud Rana series by Qazi Anwar Hussain). With the help of Captain Boby, Major Mahmud thwarts an international arms syndicate headed by the notorious Nino. And in this journey he falls in love with Elisa.', 'Bangla', '2D', 'Now Showing'),
(11, 'কাল্লু মামা', 'Dipjol,Kobita,Amin Khan,Purnima', 'Iftakar Chowdhury', '2020-02-15', 'Action,Crime,Thriller', 'https://www.youtube.com/embed/oeCM3w6EKb8', 0x2e2e5c696d616765732f506f737465722f4b616c6c754d616d612e6a7067, '00:02:45', '', 'Bangla', '2D', 'Now Showing'),
(12, 'No Dorai', 'Sayed Babu, Sunerah Binte Kamal, Josefine Lindegaard', 'Taneem Rahman Angshu', '2019-11-29', 'Drama', 'https://www.youtube.com/embed/EUnQZTofMo0', 0x2e2e5c696d616765732f706f737465722f4e6f446f7261692e6a7067, '00:02:30', 'In a small beach town in Bangladesh, fearless Ayesha confronts social prohibition and violent opposition from her poverty-ridden family to surf. Like few other youngsters, she and her best friend Sohel are trained by self-made Bangladeshi surfer, Amir. As this unusual surfing enthusiasm gets international attention from surfing community and documentary film makers, fund money generates jealousy, squabbles, and power tussles. While surfing brings newfound fame and glory to Sohel, it is the prohibited love for surfing that brings forced marriage and a life of misery for Ayesha. After seeking an extravagant, reckless lifestyle in the capital city, derailed Sohel returns back to Coxs Bazar, where their passion for surfing reunites them and unleashes a new hope for surfing in the small beach town.', 'Bangla', '2D', 'Now Showing'),
(13, 'Bloodshot', 'Vin Diesel, Eiza González, Sam Heughan', 'Dave Wilson', '2020-03-13', ' Action, Drama, Sci-Fi', 'https://www.youtube.com/embed/vOUVVDWdXbo', 0x37383038353732305f323536383133333035363631383736325f3830393138303838333736373532353337365f6f2e6a7067, '00:01:50', ' Ray Garrison, a slain soldier, is re-animated with superpowers. ', 'English', '3D', 'Running'),
(14, 'witcher 2', 'Robert bruce', 'ww', '2020-05-05', 'wwww', 'No trailer currently', 0x3232383439372e6a7067, '00:00:00', ' No plot currently... ', 'English', '2D', 'Running');

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
(1, 'Stay Safe During COVID-19.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea earum, officiis culpa tenetur sequi beatae aliquam. Laboriosam, exercitationem maxime ea expedita molestias illum officiis aliquam quo recusandae iusto, esse sed.', 'https://www.who.int/bangladesh/emergencies/coronavirus-disease-(covid-19)-update', '..\\images/Covid19.jpg', '2030-05-02');

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
(1, 'Which movie you want to see at CineCarnival?', 'Blood Shot', 'Thor', 'End Game', 'Iron Man');

-- --------------------------------------------------------

--
-- Table structure for table `shows`
--

CREATE TABLE `shows` (
  `s_id` int(6) NOT NULL,
  `s_name` varchar(256) NOT NULL,
  `movie_name` varchar(256) NOT NULL,
  `theatre_name` varchar(80) NOT NULL,
  `show_date` date NOT NULL,
  `show_status` varchar(20) NOT NULL,
  `show_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shows`
--

INSERT INTO `shows` (`s_id`, `s_name`, `movie_name`, `theatre_name`, `show_date`, `show_status`, `show_type`) VALUES
(1, 'evening 1', 'F9', 'Hall-3', '2020-04-17', 'Now Showing', '3D'),
(4, 'evening 1', 'F9', 'Hall-3', '2020-05-11', 'Now Showing', '2D'),
(5, 'morning 1', 'Thor-Love and Thunder', 'hall 66', '2020-05-11', 'Now Showing', '2D'),
(6, 'evening 2', 'John Wick: Chapter 3', 'Hall-3', '2020-05-19', 'Now Showing', '2D'),
(7, 'morning 1', 'Khoj, the Search', 'hall 66', '2020-05-04', 'Coming later', '2D');

-- --------------------------------------------------------

--
-- Table structure for table `theatre`
--

CREATE TABLE `theatre` (
  `theatre_id` int(6) NOT NULL,
  `theatre_name` varchar(30) NOT NULL,
  `total_seat` int(2) NOT NULL DEFAULT 50,
  `available_seat` int(2) NOT NULL DEFAULT 50,
  `sold_seat` int(2) DEFAULT 0,
  `theatre_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `theatre`
--

INSERT INTO `theatre` (`theatre_id`, `theatre_name`, `total_seat`, `available_seat`, `sold_seat`, `theatre_type`) VALUES
(1, 'Hall-5', 50, 48, 2, 'VIP'),
(2, 'Hall-3', 50, 50, 0, 'REGULAR'),
(4, 'Hall-3', 50, 50, 0, 'REGULAR'),
(5, 'abc', 131, 131, 0, 'VIP'),
(6, 'hall 66', 131, 9, 122, 'Regular');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` int(6) NOT NULL,
  `c_id` int(4) NOT NULL,
  `show_id` int(6) NOT NULL,
  `price` int(5) NOT NULL,
  `discount` int(5) DEFAULT 0,
  `sold_date_time` date NOT NULL,
  `seat_number` varchar(50) NOT NULL,
  `seat_count` int(2) NOT NULL DEFAULT 0,
  `payment_method` varchar(15) DEFAULT 'Cash'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `c_id`, `show_id`, `price`, `discount`, `sold_date_time`, `seat_number`, `seat_count`, `payment_method`) VALUES
(1, 1, 1, 1200, 0, '2020-04-17', 'HC-1, HC-2, ', 2, 'DBBL Payment ');

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `v_id` int(11) NOT NULL,
  `p_id` int(4) NOT NULL,
  `content` int(3) DEFAULT 0,
  `c_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vote`
--

INSERT INTO `vote` (`v_id`, `p_id`, `content`, `c_id`) VALUES
(1, 1, 1, 0);

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
  MODIFY `mv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `ticket_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
