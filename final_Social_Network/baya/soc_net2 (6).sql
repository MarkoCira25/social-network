-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2019 at 11:25 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `soc_net2`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `name`, `message`, `date`) VALUES
(32, 'mare123', 'idemooo', '2019-04-04 08:13:21'),
(33, 'mare123', 'idemooo', '2019-04-04 08:13:21'),
(34, 'mare123', 'idemooo', '2019-04-04 08:13:21'),
(35, 'mare123', 'idemooo', '2019-04-04 08:13:21'),
(36, 'mare123', 'miki kralju', '2019-04-04 08:13:21'),
(37, 'ivona123', 'mare kralju', '2019-04-04 08:13:21'),
(38, 'mare123', 'primer 45', '2019-04-04 08:13:21'),
(39, 'ivona123', 'primer od ivone', '2019-04-04 08:13:21'),
(40, 'ivona123', 'ehej', '2019-04-04 08:14:33'),
(41, 'mare123', 'idemooo', '2019-04-04 08:14:47'),
(42, 'ivona123', 'ehej', '2019-04-04 08:14:58'),
(43, 'mare123', 'miki kralju', '2019-04-04 08:15:26'),
(44, 'mare123', 'primer 45', '2019-04-04 08:26:46'),
(45, 'mare123', 'primer 45', '2019-04-04 08:27:34'),
(46, 'mare123', 'primer 45', '2019-04-04 08:27:59'),
(47, 'mare123', 'primer 45', '2019-04-04 08:28:21'),
(48, 'mare123', 'boban', '2019-04-04 09:26:21'),
(49, 'mare123', 'milice pomagaj', '2019-04-04 10:25:54'),
(50, 'ivona123', 'mare', '2019-04-04 11:19:09'),
(51, 'ivona123', 'ehej', '2019-04-04 11:19:47'),
(52, 'ivona123', 'juhu', '2019-04-04 11:21:13'),
(53, 'ivona123', '1', '2019-04-04 11:21:51'),
(54, 'ivona123', '2', '2019-04-04 11:29:11'),
(55, 'mare123', '3', '2019-04-04 11:32:56');

-- --------------------------------------------------------

--
-- Table structure for table `chat1`
--

CREATE TABLE `chat1` (
  `id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `to` varchar(255) NOT NULL,
  `from` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat1`
--

INSERT INTO `chat1` (`id`, `message`, `to`, `from`) VALUES
(6, 'cao', 'ivona123', 'mare123');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_body` text NOT NULL,
  `posted_by` varchar(50) NOT NULL,
  `posted_to` varchar(50) NOT NULL,
  `image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_body`, `posted_by`, `posted_to`, `image`) VALUES
(21, 'aaaaaaaaa12324567', '24', '23', '1'),
(22, 'aaaaaaaaa12324567', '24', '23', '1'),
(24, 'idempo', '24', '23', '1'),
(31, 'lalala', '24', '24', '1'),
(32, 'lalala', '24', '24', '1'),
(33, 'lalala', '24', '24', '1'),
(34, 'neki komentar', '2', '1', '1'),
(35, 'neki komentar 2', '2', '1', '1'),
(36, 'neki komentar 3', '2', '1', '1'),
(37, 'koment 4', '2', '1', '1'),
(38, 'komentar', '24', '216', '1'),
(39, 'gfdf', '24', '217', '1'),
(40, 'ehej', '2', '250', '1'),
(41, '1', '2', '257', '1'),
(42, '2', '2', '257', '1'),
(43, '3', '2', '257', '1');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `body` varchar(250) NOT NULL,
  `date` varchar(20) NOT NULL,
  `userId` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `privateStatus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `body`, `date`, `userId`, `image`, `privateStatus`) VALUES
(1, 'nebrisati', '', 2, '', 'public'),
(221, '2', '01-01-2019', 24, '_mare123_1553773077.jpg', 'public'),
(222, '2', '01-01-2019', 24, '_mare123_1553773134.jpg', 'public'),
(223, 'idemo', '01-01-2019', 24, '', 'public'),
(224, 'komentar', '01-01-2019', 24, '_mare123_1553773173.jpg', 'public'),
(228, 'edit 123', '01-01-2019', 24, '', 'public'),
(243, 'https://www.youtube.com/watch?v=BnqP0XkYsKs', '01-01-2019', 24, '', 'public'),
(244, 'https://www.youtube.com/watch?v=BnqP0XkYsKs', '01-01-2019', 24, '', 'public'),
(245, 'https://www.youtube.com/watch?v=9xehHNkahiw', '01-01-2019', 24, '', 'public'),
(246, 'https://www.youtube.com/watch?v=9xehHNkahiw', '01-01-2019', 24, '', 'public'),
(247, 'post', '01-01-2019', 25, '', 'public'),
(249, 'https://www.youtube.com/watch?v=BnqP0XkYsKs', '01-01-2019', 24, '', 'public'),
(250, 'mid', '01-01-2019', 24, '', 'public'),
(254, '', '01-01-2019', 24, '_mare123_1554367321.jpg', 'public'),
(255, '', '01-01-2019', 24, '_mare123_1554367444.jpg', 'public'),
(256, '', '01-01-2019', 24, '_mare123_1554367545.jpg', 'public'),
(267, 'mid', '01-01-2019', 25, '', 'public');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(4) NOT NULL,
  `name` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `name`, `lastname`, `email`, `username`, `image`, `password`) VALUES
(2, 'Aleksandra', 'Tomic', 'alexa@aa.aa', 'Artomic', 'al.jpg', 'artomic123'),
(9, 'Petar', 'Peric', 'pera@peric.de', 'pera', '1.jpg', '$2y$10$HYfF7mpyX67oySOYrbGDP.a2Ie.qaRogyhfA41IzNc3Pf/I8TRTLG'),
(17, 'Marko', 'Markovic', 'marko@m.s', 'Marko', '1.jpg', '$2y$10$Y68F8PhF.4tjADyaxKCejOzc9RdLIwZ4u57z577KGrLfiy46nchSu'),
(18, 'Ana', 'Anicic', 'ana@ana.rs', 'Ana', '1.jpg', '$2y$10$bL7l/W/02.tFzbh9G0QWN.SaDsUfZknPjx8lv9trfcpSXgI6rsHEe'),
(20, 'Mira', 'Mirkovic', 'mira@mira.ma', 'Mirka', '1.jpg', '$2y$10$viVela7Q2ndJmFK7HW1pxeUboutGM9gnJHNC.oQUU3PxKpGfXHP16'),
(21, 'Marija', 'Markovic', 'mara@mara.ma', 'MarijaMara', '1.jpg', '$2y$10$sczqavzUvq1h.7158yxThO7FcVN4xS00ZoAQprKV14oUfKdCrORge'),
(22, 'Milos', 'Klaric', 'klaric1111@gmail.com', 'klaki', '1.jpg', '$2y$10$Y2XRPXd2dqGGZ5Ng2xibOOEwhx5aUlSnshoeSlB/Ve0eaOsEObB2K'),
(23, 'Niko', 'Nikic', 'ninko@gmail.com', 'ninko', '1.jpg', '$2y$10$nrM/NB7pZGC56Ry/1kw0/u08rDD5zkIeXw.m0FEz7DwzYZ8SMOJ.e'),
(24, 'Markoni', 'cirovic', 'dambldor@gmail.com', 'mare123', '_mare123_1554200110.jpg', '$2y$10$680P9JtaLeBeiPGkiy89v.kBbOB86z3wQ1y3nSECFS8lRBSHL0eGS'),
(25, 'ivona', 'ivona', 'ivona@gmail.com', 'ivona123', '1.jpg', '$2y$10$jjUEkzdzzzFcEP374FEYOO98uHeVdHBn2xjSDnabt9cYaVUf8eDWi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat1`
--
ALTER TABLE `chat1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `chat1`
--
ALTER TABLE `chat1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=268;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `jedan_vise_postova` FOREIGN KEY (`userId`) REFERENCES `users` (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
