-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2024 at 06:19 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tutorial`
--

-- --------------------------------------------------------

--
-- Table structure for table `crud`
--

CREATE TABLE `crud` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `year` varchar(100) NOT NULL,
  `section` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crud`
--

INSERT INTO `crud` (`id`, `first_name`, `last_name`, `email`, `gender`, `year`, `section`) VALUES
(1, 'Yawa', 'David', 'lilianapia@gmail.com', 'male', '2', '2'),
(2, 'Andrei', 'David', 'johnandrei@gmail.com', 'male', '1', '4'),
(5, 'Demetra', 'Welp', 'welp@gmail.com', 'female', '3', '3'),
(6, 'Rose', 'Anderson', 'rose@gmail.com', 'female', '2', '3'),
(7, 'Fiona', 'Shrek', 'fiona@gmail.com', 'female', '2', '3'),
(8, 'Jake', 'Xavier', 'jake@gmail.com', 'male', '3', '4'),
(9, 'Paul', 'Garcia', 'paul@gmail.com', 'male', '2', '3'),
(10, 'Steven', 'Heather', 'steven@gmail.com', 'male', '1', '4'),
(11, 'Rianna', 'Shelvey', 'ria@gmail.com', 'female', '1', '4'),
(12, 'Andrei', 'Welp', 'CabreraA09@gmail.com', 'female', '2', '3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crud`
--
ALTER TABLE `crud`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crud`
--
ALTER TABLE `crud`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
