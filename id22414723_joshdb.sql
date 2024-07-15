-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 15, 2024 at 10:21 AM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id22414723_joshdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `email` varchar(20) NOT NULL,
  `serialno` int(25) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`firstname`, `lastname`, `email`, `serialno`, `password`) VALUES
('Josphat', 'Gola', 'josphatbaraka3@gmail', 2345678, '1234567890');

-- --------------------------------------------------------

--
-- Table structure for table `atributes`
--

CREATE TABLE `atributes` (
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `comment` text NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `atributes`
--

INSERT INTO `atributes` (`firstname`, `lastname`, `comment`, `email`, `password`) VALUES
('Baraka', 'baraka@gmail.com', 'This is what we do dayly', 'baraka@gmail.com', ''),
('Chapa ', 'Ilale', 'What', 'chapailale@gmail.com', '1234567890'),
('Ferre', 'Gola', 'we do our best', 'ferregola@gmail.com', ''),
('Hati', 'More', 'What we do', 'hati@gmail.com', ''),
('Josphatt', 'Mrambaa', 'Hii nayo', 'josphatbaraka35@gmail.com', '555555555555555555'),
('Josphat', 'Baraka', 'we gatch', 'josphatbaraka3@gmail.com', ''),
('Mbule', 'Brown', 'weee', 'mbulebrown@gmail.com', '1234567890'),
('Kirisho', 'Mera', 'I love women than my life', 'mera@gmail.com', ''),
('Baraka', 'Mramba', 'Pole sana baba', 'mramba@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(25) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `subject` varchar(25) NOT NULL,
  `messages` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `subject`, `messages`) VALUES
(1, 'Beka Boy', 'josphatbaraka3@gmail', 'bag', 'bag'),
(2, 'Farao Mwara', 'faraomwara@gmail.com', 'Reporting Bug', 'It hangs several tim'),
(3, 'Josphat Baraka Mramb', 'mbele@gmail.com', 'The system is very low', 'Work on that issue f');

-- --------------------------------------------------------

--
-- Table structure for table `survey_responses`
--

CREATE TABLE `survey_responses` (
  `id` int(25) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(25) NOT NULL,
  `experience` varchar(200) NOT NULL,
  `improvements` text NOT NULL,
  `recommend` varchar(25) NOT NULL,
  `submitted_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `survey_responses`
--

INSERT INTO `survey_responses` (`id`, `firstname`, `lastname`, `email`, `experience`, `improvements`, `recommend`, `submitted_at`) VALUES
(1, 'Josphat', 'Baraka', 'josphatbaraka3@gmail.com', 'good', 'We can do this', 'yes', '2024-07-06 08:12:17.680055'),
(2, 'Ferre', 'Gola', 'ferregola@gmail.com', 'excellent', 'I am expert of this', 'yes', '2024-07-06 08:27:57.211536'),
(3, 'Ferre', 'Gola', 'ferregola@gmail.com', 'excellent', 'I am expert of this', 'yes', '2024-07-06 08:38:51.676120'),
(4, 'Josphat', 'Baraka', 'josphatbaraka3@gmail.com', 'good', 'We can do this', 'yes', '2024-07-06 08:40:56.183442'),
(5, 'Dida', 'John', 'didajohn@gmail.com', 'poor', 'I gatch you', 'yes', '2024-07-06 08:41:45.213072'),
(6, 'Kuchu', 'Lix', 'kuchulix@gmail.com', 'good', 'whi', 'no', '2024-07-06 08:45:27.412860'),
(7, 'Dida', 'John', 'didajohn@gmail.com', 'poor', 'I gatch you', 'yes', '2024-07-06 08:47:37.152691'),
(8, 'Loki', 'Maa', 'lokimaa@gmail.com', 'excellent', 'Suuu', 'no', '2024-07-06 08:48:19.913862'),
(9, 'Foro', 'Kwao', 'forokwao@gmail.com', 'average', 'Guru Max', 'yes', '2024-07-06 08:51:17.299420'),
(10, 'Papa', 'Wemba', 'papawemba@gmail.com', 'average', 'Freaking', 'yes', '2024-07-06 08:58:54.484649'),
(11, 'Sugar', 'Boy', 'sugarboy@gmail.com', 'excellent', 'Whaat', 'yes', '2024-07-06 09:02:36.467761'),
(12, 'Bullion', 'Van', 'bullionvan@gmail.om', 'average', 'I Its good keep going', 'yes', '2024-07-06 09:06:31.683929'),
(14, 'Hapo', 'Sasa', 'haposasa@gmail.com', 'good', 'RELATIVE', 'yes', '2024-07-07 05:46:08.245205'),
(16, 'Josphat', 'Mramba', 'josphatbaraka3@gmail.com', 'excellent', 'Keep going ', 'yes', '2024-07-12 04:21:52.353801');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`serialno`);

--
-- Indexes for table `atributes`
--
ALTER TABLE `atributes`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_responses`
--
ALTER TABLE `survey_responses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `survey_responses`
--
ALTER TABLE `survey_responses`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
