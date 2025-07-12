-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306:3306
-- Generation Time: Jul 12, 2025 at 07:38 PM
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
-- Database: `capgrid`
--

-- --------------------------------------------------------

--
-- Table structure for table `captions`
--

CREATE TABLE `captions` (
  `id` int(11) NOT NULL,
  `cap_content` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `captions`
--

INSERT INTO `captions` (`id`, `cap_content`, `author`, `created_at`, `updated_at`) VALUES
(1, 'Freelance content creator with a love for slow mornings, strong coffee, and stories that make people feel seen. I write lifestyle blogs, wellness guides, and anything that helps you breathe a little deeper.', '1', '2025-07-12 23:37:36', '2025-07-12 23:37:36'),
(2, 'Freelance content writer with a track record of helping startups and agencies create high-performing web and social copy. Whether it’s a SaaS landing page or an Instagram caption, I write to spark connection and action.', '1', '2025-07-12 23:37:56', '2025-07-12 23:37:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `thumbnail`, `bio`, `created_at`, `updated_at`) VALUES
(1, 'Shuvro Deb Roy', 'shuvro@gmail.com', '$2y$10$1zDUFjz9XzT08VooJqTQgOrB/afddKZmBqs12oIeGEk3M4UXar356', 'avatar_1752341818_5897.png', 'Full-Stack Developer with expertise in both front-end finesse and back-end muscle. From designing sleek user interfaces to engineering scalable APIs, I build web solutions that are fast, functional, and future-ready.  Passionate about turning complex problems into clean code and intuitive experiences. I bridge the gap between ideas and execution across JavaScript, Node.js, React, and databases like MySQL and MongoDB.', '2025-07-12 23:33:06', '2025-07-12 23:36:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `captions`
--
ALTER TABLE `captions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `captions`
--
ALTER TABLE `captions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
