-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2024 at 12:15 PM
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
-- Table structure for table `accs`
--

CREATE TABLE `accs` (
  `idno` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `pass` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accs`
--

INSERT INTO `accs` (`idno`, `username`, `pass`) VALUES
('TUPV-22-0521', '', '123'),
('', '', 'ads'),
('', 'KoRaptedRap', 'ads');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idno` varchar(15) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `mi` varchar(5) NOT NULL,
  `birthdate` date NOT NULL,
  `year_section` varchar(15) NOT NULL,
  `role` varchar(15) NOT NULL COMMENT '0 for admin\r\n1 for student',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idno`, `lastname`, `firstname`, `mi`, `birthdate`, `year_section`, `role`, `created_at`, `updated_at`) VALUES
('TUPV-22-0521', 'Rectra', 'Ralph Emmanuel ', 'G.', '2003-09-29', 'CpE2A', 'Student', '2024-03-12 04:10:05', '2024-03-12 04:10:05'),
('', '', '', '', '0000-00-00', 'CpE1A', 'Teacher', '2024-03-12 04:10:34', '2024-03-12 04:10:34'),
('TUPV-22-0521', 'Recto', 'Ralph Emmanuel ', 'G.', '2022-02-15', 'CpE2A', 'Student', '2024-03-12 12:02:58', '2024-03-12 12:02:58');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
