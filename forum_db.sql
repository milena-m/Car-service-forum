-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 
-- Версия на сървъра: 5.6.25
-- PHP Version: 5.5.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum_db`
--

-- --------------------------------------------------------

--
-- Структура на таблица `forum_posts`
--

CREATE TABLE IF NOT EXISTS `forum_posts` (
  `post_id` int(11) NOT NULL,
  `post_text` varchar(1000) NOT NULL,
  `post_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `topic_id` int(11) NOT NULL,
  `post_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `forum_posts`
--

INSERT INTO `forum_posts` (`post_id`, `post_text`, `post_date`, `topic_id`, `post_by`) VALUES
(28, 'Please, follow the forum rules:\r\n1. ...\r\n2. ...\r\n3. ...', '2016-09-16 06:20:32', 13, 1),
(29, 'Hey, I am Mimi. I am new here.', '2016-09-16 06:22:10', 14, 24),
(30, 'Welcome, Mimi!', '2016-09-16 06:22:32', 14, 25),
(31, 'Hey guys, what are your favourite book genres? Mine are historical fiction, crime and classics.', '2016-09-16 06:56:58', 15, 26),
(32, 'Hi, Ani! I like fantasy and sci-fi.', '2016-09-16 06:57:49', 15, 25),
(33, 'Hi!', '2016-09-18 16:43:07', 14, 27),
(34, 'Hey guys, I like to read horror and thriller books.', '2016-09-18 16:44:10', 15, 27),
(35, 'Hey, guys! What are your favourite book genres? Mine are drama, historical fiction and crime novels.', '2016-09-18 20:13:52', 16, 28),
(36, 'Hi, ani! I like fantasy and sci-fi.', '2016-09-18 20:21:31', 16, 31),
(38, 'Hello! What type of music do you like? I prefer classical music.', '2016-09-18 20:24:44', 17, 29),
(39, 'Hey, joro! I like rock music.', '2016-09-18 20:32:01', 17, 30),
(40, 'I like listening to pop music.', '2016-09-18 20:32:42', 17, 28);

-- --------------------------------------------------------

--
-- Структура на таблица `forum_topics`
--

CREATE TABLE IF NOT EXISTS `forum_topics` (
  `topic_id` int(11) NOT NULL,
  `topic_name` varchar(200) NOT NULL,
  `topic_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `topic_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `forum_topics`
--

INSERT INTO `forum_topics` (`topic_id`, `topic_name`, `topic_date`, `topic_by`) VALUES
(13, 'Forum rules', '2016-09-16 06:20:32', 1),
(14, 'Hello', '2016-09-16 06:22:10', 24),
(15, 'Favourite book genres', '2016-09-16 06:56:58', 26),
(16, 'Favourite book genres', '2016-09-18 20:13:52', 28),
(17, 'Music preferences', '2016-09-18 20:24:43', 29);

-- --------------------------------------------------------

--
-- Структура на таблица `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `town` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `username`, `password`, `town`, `email`, `role`) VALUES
(1, '', '', 'admin', 'pass', 'Sofia', 'admin@forum.com', 'admin'),
(28, 'Anna', 'Ivanova', 'ani', '3333', 'Plovdiv', 'ani@abv.bg', 'user'),
(29, 'Georgi', 'Mihaylov', 'joro', '2222', 'Stara Zagora', 'georgi@yahoo.com', 'user'),
(30, 'Maria', 'Yordanova', 'mimi', '1111', 'Plovdiv', 'mimi@gmail.com', 'user'),
(31, 'Petar', 'Petrov', 'pesho', 'pesho', 'Sofia', 'pesho@gmail.com', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `forum_posts`
--
ALTER TABLE `forum_posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `topic_id` (`topic_id`),
  ADD KEY `post_by` (`post_by`);

--
-- Indexes for table `forum_topics`
--
ALTER TABLE `forum_topics`
  ADD PRIMARY KEY (`topic_id`),
  ADD KEY `topic_by` (`topic_by`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forum_posts`
--
ALTER TABLE `forum_posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `forum_topics`
--
ALTER TABLE `forum_topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
