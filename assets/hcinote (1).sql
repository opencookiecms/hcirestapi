-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 19, 2019 at 05:29 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hcinote`
--

-- --------------------------------------------------------

--
-- Table structure for table `hci_followers`
--

CREATE TABLE `hci_followers` (
  `hci_fid` int(11) NOT NULL,
  `hci_following` varchar(255) DEFAULT NULL,
  `hci_follower` varchar(255) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hci_followers`
--

INSERT INTO `hci_followers` (`hci_fid`, `hci_following`, `hci_follower`, `status`) VALUES
(11, 'awangs', 'fatimah', 'ok');

-- --------------------------------------------------------

--
-- Table structure for table `hci_note`
--

CREATE TABLE `hci_note` (
  `note_id` int(11) NOT NULL,
  `note_title` varchar(255) DEFAULT NULL,
  `note_content` text,
  `note_link` varchar(255) DEFAULT NULL,
  `note_type` varchar(10) DEFAULT NULL,
  `note_username` varchar(255) DEFAULT NULL,
  `note_reg` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hci_note`
--

INSERT INTO `hci_note` (`note_id`, `note_title`, `note_content`, `note_link`, `note_type`, `note_username`, `note_reg`) VALUES
(55, 'file ', 'this is file', 'Screenshot_20190313-225824_Hci1.jpg', '.jpg', 'awang', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hci_users`
--

CREATE TABLE `hci_users` (
  `user_id` int(11) NOT NULL,
  `user_firstname` varchar(255) DEFAULT NULL,
  `user_lastname` varchar(255) DEFAULT NULL,
  `user_username` varchar(10) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_email` varchar(150) DEFAULT NULL,
  `user_collage` varchar(255) DEFAULT NULL,
  `user_posititon` varchar(150) DEFAULT NULL,
  `user_pic` text,
  `user_caption` text,
  `user_reg` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hci_users`
--

INSERT INTO `hci_users` (`user_id`, `user_firstname`, `user_lastname`, `user_username`, `user_password`, `user_email`, `user_collage`, `user_posititon`, `user_pic`, `user_caption`, `user_reg`) VALUES
(1, 'Abu', 'Awang', 'awang', '1234', 'awang@gmail.com', 'UITM', 'Student', NULL, NULL, '2019-03-09 16:00:00'),
(2, 'K', 'Keon', 'keon', '1234', 'keon@gmail.com', 'UITM', 'Student', NULL, 'nothing', NULL),
(3, 'Siti', 'Fatimah', 'fatimah', '1234', 'fatimah@gmail.com', 'UTM', 'Lecture', NULL, 'nothing', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hci_followers`
--
ALTER TABLE `hci_followers`
  ADD PRIMARY KEY (`hci_fid`);

--
-- Indexes for table `hci_note`
--
ALTER TABLE `hci_note`
  ADD PRIMARY KEY (`note_id`);

--
-- Indexes for table `hci_users`
--
ALTER TABLE `hci_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hci_followers`
--
ALTER TABLE `hci_followers`
  MODIFY `hci_fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `hci_note`
--
ALTER TABLE `hci_note`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `hci_users`
--
ALTER TABLE `hci_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
