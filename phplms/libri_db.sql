-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2024 at 04:47 AM
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
-- Database: `libri_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `idno` varchar(12) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `mi` varchar(2) NOT NULL,
  `birthdate` date NOT NULL,
  `user_role` varchar(10) NOT NULL,
  `year_section` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`idno`, `lastname`, `firstname`, `mi`, `birthdate`, `user_role`, `year_section`, `created_at`, `updated_at`) VALUES
('LIBRI04', '', 'Shizuku', '', '2024-03-05', 'Teacher', 'CpE1A', '2024-03-16 00:37:57', '2024-03-16 00:37:57'),
('LIBRI03', 'Momoi', 'Airi', 'A', '2024-03-26', 'Student', 'CpE1A', '2024-03-16 00:38:35', '2024-03-16 00:38:35'),
('zzz', 'zzz', 'zzz', 'z', '2024-03-04', 'Teacher', 'CpE1A', '2024-03-23 14:40:15', '2024-03-23 14:40:15'),
('aaa', 'aaa', 'aaa', 'a', '2024-03-24', 'Student', 'CpE1A', '2024-03-23 14:41:41', '2024-03-23 14:41:41');

-- --------------------------------------------------------

--
-- Table structure for table `pdf-files`
--

CREATE TABLE `pdf-files` (
  `pdf-name` varchar(100) NOT NULL,
  `pdf-sub` varchar(30) NOT NULL,
  `pdf-code` varchar(16) NOT NULL,
  `date-uploaded` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pdf-files`
--

INSERT INTO `pdf-files` (`pdf-name`, `pdf-sub`, `pdf-code`, `date-uploaded`) VALUES
('Computer Architecture A Quantitative Approach (5th edition).pdf', 'comp', 'asd345', '2024-03-28 11:44:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idno` varchar(12) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(16) NOT NULL,
  `user_role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idno`, `username`, `password`, `user_role`) VALUES
('LIBRI04', 'nansenkai', 'watashiga', 'Teacher'),
('LIBRI03', 'asd', 'asd', 'Student'),
('zzz', 'zzz', 'zzz', 'Teacher'),
('aaa', 'aaa', 'aaa', 'Student');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
