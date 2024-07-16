-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2024 at 04:49 PM
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
-- Database: `teacher_files`
--

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `subject` varchar(50) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `subject`, `filename`) VALUES
(1, 'GEC', 'GEC-4-MMW-Weeks-1-4.-Revised-January-26.-2023.pdf'),
(2, 'Math', 'MATH-223-Advanced-Engg-Math-Wk-6-8-FINAL.pdf'),
(3, 'Programming', 'COMP232A-Prelim-Handouts.pdf'),
(5, 'Elex', 'WK1-Introduction-to-Semiconductor.pdf'),
(7, 'GEC', 'GEC-4-MMW-Weeks-6-8.-revised-Feb-10-2023.pdf'),
(8, 'GEC', 'GEC-4-MMW-Weeks-10-13.pdf'),
(9, 'Math', 'MATH-223-Advanced-Engg-Math-Wk-1-to-4-FINAL.pdf'),
(10, 'Math', 'MATH-223-Advanced-Engineering-Mathematics-W9-to-W13.pdf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
