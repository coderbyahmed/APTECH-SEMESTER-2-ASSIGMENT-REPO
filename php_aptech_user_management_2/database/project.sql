-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2026 at 03:05 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `profession` varchar(50) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `image`, `fullName`, `email`, `password`, `profession`, `createdAt`) VALUES
(13, 'IMG_6a48f1c311b154.92755053.jpeg', 'ahmed', 'ahmedazizkhan405@gmail.com', '$2y$10$Yjm4D23L9IgRtepzFHF8te1qxjZtEjpON67FlQK380rXFQRT82cHm', 'Developer', '2026-07-04 11:42:59'),
(14, 'IMG_6a48f20abfcf19.89416542.jpeg', 'hamza', 'hamza@gmail.com', '$2y$10$MxaGBMcEXuFFow0I.ge0seCKy0lyqnXZe5XnOHh235ftG9CcR1kva', 'Developer', '2026-07-04 11:44:10'),
(15, 'IMG_6a48f3cfdb1d85.63851962.png', 'hammad', 'hammadazizkhan405@gmail.com', '$2y$10$tGVo20LaK1bPyRcC8v/KrOX/09hUUgqNMq0rLNCuVuq8WMpNNQeK.', 'Student', '2026-07-04 11:51:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;