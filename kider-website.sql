-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2024 at 03:33 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kider-website`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `classname` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `capacity` int(11) NOT NULL,
  `age1` int(11) NOT NULL,
  `age2` int(11) NOT NULL,
  `time1` time NOT NULL,
  `time2` time NOT NULL,
  `published` enum('Yes','No') NOT NULL,
  `image` varchar(50) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `RegDate`, `classname`, `price`, `capacity`, `age1`, `age2`, `time1`, `time2`, `published`, `image`, `teacher_id`) VALUES
(1, '2024-06-09 11:56:16', 'Art&Drawing', 500, 10, 10, 15, '10:00:00', '11:00:00', 'Yes', 'classes-1.jpg', 1),
(2, '2024-06-09 12:02:38', 'Color Management', 20, 20, 10, 15, '05:00:00', '06:00:00', 'Yes', 'classes-2.jpg', 2),
(12, '2024-06-09 16:58:00', 'Athletic&Dance', 50, 20, 10, 12, '07:00:00', '08:00:00', 'Yes', 'classes-3.jpg', 3),
(14, '2024-06-09 19:34:16', 'Language&speaking', 500, 20, 15, 20, '09:00:00', '10:00:00', 'Yes', 'classes-4.jpg', 1),
(15, '2024-06-21 13:50:14', 'Religion&History', 300, 10, 7, 10, '11:00:00', '12:00:00', 'Yes', 'classes-5.jpg', 2),
(16, '2024-06-21 13:52:26', 'General Knowledge', 400, 15, 10, 12, '20:00:00', '21:00:00', 'Yes', 'classes-6.jpg', 3),
(18, '2024-06-22 12:25:15', 'Arabic', 200, 10, 5, 10, '04:24:00', '05:24:00', 'No', 'classes-1.jpg', 2),
(19, '2024-06-22 12:33:04', 'Math', 100, 5, 8, 10, '20:32:00', '21:32:00', 'No', 'classes-2.jpg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `fullname` varchar(50) NOT NULL,
  `jobtitle` varchar(50) NOT NULL,
  `published` enum('Yes','No') NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `RegDate`, `fullname`, `jobtitle`, `published`, `image`) VALUES
(1, '2024-06-07 22:21:50', 'ahmed ', ' teacher', 'Yes', 'team-2.jpg'),
(2, '2024-06-08 12:00:26', 'nada', 'artist', 'Yes', 'team-1.jpg'),
(3, '2024-06-08 12:02:47', 'nour ', 'coach', 'Yes', 'team-3.jpg'),
(19, '2024-06-22 12:37:58', 'aser', 'teacher', 'No', 'team-1.jpg'),
(20, '2024-06-22 12:38:40', 'selim', 'teacher', 'No', 'team-2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `fullname` varchar(50) NOT NULL,
  `jobtitle` varchar(50) NOT NULL,
  `comment` text NOT NULL,
  `published` enum('Yes','No') NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `RegDate`, `fullname`, `jobtitle`, `comment`, `published`, `image`) VALUES
(1, '2024-06-10 12:32:07', 'amgad ', 'teacher', 'Tempor stet labore dolor clita stet diam amet ipsum dolor duo ipsum rebum stet dolor amet diam stet. Est stet ea lorem amet est kasd kasd erat eos', 'Yes', 'testimonial-2.jpg'),
(2, '2024-06-10 12:32:13', 'Mark Henry', 'Content creator', 'Tempor stet labore dolor clita stet diam amet ipsum dolor duo ipsum rebum stet dolor amet diam stet. Est stet ea lorem amet est kasd kasd erat eos', 'Yes', 'testimonial-3.jpg'),
(7, '2024-06-10 13:24:04', 'nermen ', 'contant creator', 'Tempor stet labore dolor clita stet diam amet ipsum dolor duo ipsum rebum stet dolor amet diam stet. Est stet ea lorem amet est kasd kasd erat eos', 'Yes', 'testimonial-1.jpg'),
(11, '2024-06-22 12:39:50', 'yahia', 'engineer', 'lorem ', 'No', 'testimonial-1.jpg'),
(12, '2024-06-22 12:40:32', 'mazen', 'teacher', 'Tempor stet labore dolor clita stet diam amet ipsum dolor duo ipsum rebum stet dolor amet diam stet. Est stet ea lorem amet est kasd kasd erat eos', 'No', 'testimonial-2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `fullname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `active` enum('Yes','No') NOT NULL COMMENT 'active:1 , blocked=0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `RegDate`, `fullname`, `username`, `email`, `password`, `phone`, `active`) VALUES
(2, '2024-06-07 15:08:09', 'nermen ibrahim ', 'nermen', 'nermenibrahim051@gmail.com', '$2y$10$eY41PCpF8n3wi4npTmCbVOT0WRy7i6WTSNLzZeKZC558CNFIEp5ZW', '010022337660', 'Yes'),
(4, '2024-06-07 15:54:47', 'nour ibrahim', 'nour1999', 'nour@email.com', '$2y$10$McppAv3ZuI1/1WAkjzKos.dHsg9xXvXwOFwYV8Ij6Tnn4ikIWT2/C', '01065566044', 'No'),
(26, '2024-06-09 13:31:20', 'nancy ahmed', 'nancy', 'ahmed@yahoo.com', '$2y$10$RHyouD5SOrYfiPebnw6PBOWDOQyTlSpQmdO5skihyevz4R.A5WzAy', '01022205353', 'Yes'),
(27, '2024-06-21 21:09:57', 'anas mohamed', 'anas', 'anas@email.com', '$2y$10$qh0s2kT7kEZMc94DJZteSOe0Oy2F6BjnYXByocj5qTDLY0i/edn0C', '01004433766', 'No'),
(29, '2024-06-22 13:31:54', 'anas mohamed', 'anas', 'anas@email.com', '$2y$10$jfIfNdxPQLtdU4RJ/DEj1uaXoj.9Wz4JGpQGS4iHhUaVqGzssv8Mm', '01004433766', 'Yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
