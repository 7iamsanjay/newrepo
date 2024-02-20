-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2022 at 11:47 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `labman`
--

-- --------------------------------------------------------

--
-- Table structure for table `4anil`
--

CREATE TABLE `4anil` (
  `id` int(11) NOT NULL,
  `listid` int(11) NOT NULL,
  `lid` int(11) DEFAULT NULL,
  `listname` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(20) NOT NULL,
  `work` varchar(20) NOT NULL,
  `count` int(11) NOT NULL,
  `amt` float NOT NULL,
  `status` varchar(11) NOT NULL,
  `pdate` date DEFAULT NULL,
  `ldate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `4anil`
--

INSERT INTO `4anil` (`id`, `listid`, `lid`, `listname`, `name`, `location`, `work`, `count`, `amt`, `status`, `pdate`, `ldate`) VALUES
(6, 1, 6, 'list-1', 'Im labour', 'at farm', 'kapas', 2, 230, 'PAID', '2022-02-28', '2022-02-28'),
(7, 1, 7, 'list-1', 'ms. labour', 'at farm', 'kapas', 1, 230, 'PENDDING', NULL, '2022-02-28'),
(8, 1, 8, 'list-1', 'knok knok', 'at farm', 'kapas', 1, 230, 'PENDDING', NULL, '2022-02-28'),
(9, 1, 23, 'list-1', 'new lab', 'at farm', 'kapas', 2, 230, 'PENDDING', NULL, '2022-02-28');

-- --------------------------------------------------------

--
-- Table structure for table `22an7874`
--

CREATE TABLE `22an7874` (
  `id` int(11) NOT NULL,
  `listid` int(11) NOT NULL,
  `lid` int(11) NOT NULL,
  `listname` varchar(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `location` varchar(20) NOT NULL,
  `work` varchar(20) NOT NULL,
  `count` int(5) NOT NULL,
  `amt` float NOT NULL,
  `status` varchar(11) NOT NULL,
  `pdate` date DEFAULT NULL,
  `ldate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `23an7874`
--

CREATE TABLE `23an7874` (
  `id` int(11) NOT NULL,
  `listid` int(11) NOT NULL,
  `lid` int(11) NOT NULL,
  `listname` varchar(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `location` varchar(20) NOT NULL,
  `work` varchar(20) NOT NULL,
  `count` int(5) NOT NULL,
  `amt` float NOT NULL,
  `status` varchar(11) NOT NULL,
  `pdate` date DEFAULT NULL,
  `ldate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `24an8849`
--

CREATE TABLE `24an8849` (
  `id` int(11) NOT NULL,
  `listid` int(11) NOT NULL,
  `lid` int(11) NOT NULL,
  `listname` varchar(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `location` varchar(20) NOT NULL,
  `work` varchar(20) NOT NULL,
  `count` int(5) NOT NULL,
  `amt` float NOT NULL,
  `status` varchar(11) NOT NULL,
  `pdate` date DEFAULT NULL,
  `ldate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `25ha7359`
--

CREATE TABLE `25ha7359` (
  `id` int(11) NOT NULL,
  `listid` int(11) NOT NULL,
  `lid` int(11) NOT NULL,
  `listname` varchar(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `location` varchar(20) NOT NULL,
  `work` varchar(20) NOT NULL,
  `count` int(5) NOT NULL,
  `amt` float NOT NULL,
  `status` varchar(11) NOT NULL,
  `pdate` date DEFAULT NULL,
  `ldate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `25ha7359`
--

INSERT INTO `25ha7359` (`id`, `listid`, `lid`, `listname`, `name`, `location`, `work`, `count`, `amt`, `status`, `pdate`, `ldate`) VALUES
(1, 1, 25, 'list1', 'rushi', 'lab', 'php', 3, 80, 'PAID', '2022-02-23', '2022-02-23');

-- --------------------------------------------------------

--
-- Table structure for table `an217874`
--

CREATE TABLE `an217874` (
  `id` int(11) NOT NULL,
  `listid` int(11) NOT NULL,
  `lid` int(11) NOT NULL,
  `listname` varchar(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `location` varchar(20) NOT NULL,
  `work` varchar(20) NOT NULL,
  `count` int(5) NOT NULL,
  `amt` float NOT NULL,
  `status` varchar(11) NOT NULL,
  `pdate` date DEFAULT NULL,
  `ldate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `labours`
--

CREATE TABLE `labours` (
  `lid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `userdb` varchar(200) NOT NULL,
  `name` varchar(20) NOT NULL,
  `address` varchar(30) NOT NULL,
  `location` varchar(20) NOT NULL,
  `number` varchar(12) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `rdate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `labours`
--

INSERT INTO `labours` (`lid`, `uid`, `userdb`, `name`, `address`, `location`, `number`, `gender`, `rdate`) VALUES
(6, 4, '4anil', 'Im labour', 'dudhala', 'mahuva', '8849456821', 'male', '2022-01-20 19:06:39'),
(7, 4, '4anil', 'ms. labour', 'dudhala', 'dudhala', '8989899090', 'female', '2022-01-20 21:14:29'),
(8, 4, '4anil', 'knok knok', 'dudhala', 'mahuva', '0099009900', 'male', '2022-01-20 21:28:16'),
(23, 4, '4anil', 'new lab', 'io', 'mh', '9090909090', 'male', '2022-02-17 20:33:42'),
(25, 25, '25HA7359', 'rushi', 'ghare', 'rakhdto', '9090909090', 'female', '2022-02-23 09:42:46');

-- --------------------------------------------------------

--
-- Table structure for table `msg`
--

CREATE TABLE `msg` (
  `id` int(11) NOT NULL,
  `reciver` varchar(100) NOT NULL,
  `msg` varchar(150) NOT NULL,
  `title` text NOT NULL,
  `sender` varchar(30) NOT NULL,
  `status` varchar(6) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `msg`
--

INSERT INTO `msg` (`id`, `reciver`, `msg`, `title`, `sender`, `status`, `date`) VALUES
(1, 'labman', 'Hiiii Happy to see you.. visit <a href=\"https://niljadav.com\">www.niljadav.com</a>', 'Well-Come...', 'labman', 'ap', '2022-02-01'),
(15, 'labman', 'test ', 'heyy ', '4anil', 'unseen', '2022-02-25');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `tid` int(11) NOT NULL,
  `dbname` varchar(10) NOT NULL,
  `lid` int(11) NOT NULL,
  `listid` int(11) NOT NULL,
  `listname` varchar(20) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `amt` float NOT NULL,
  `rid` int(11) NOT NULL,
  `tdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`tid`, `dbname`, `lid`, `listid`, `listname`, `lname`, `amt`, `rid`, `tdate`) VALUES
(1, '4anil', 6, 1, 'list-1', 'Anil Jadav', 280, 1, '2022-01-11'),
(2, '4anil', 7, 1, 'list-1', 'ms. labour', 420, 2, '2022-02-27'),
(4, '4anil', 8, 1, 'list-1', 'knok knok', 280, 3, '2021-12-08'),
(6, '4anil', 23, 1, 'list-1', 'new lab', 280, 4, '2022-02-27'),
(7, '4anil', 8, 1, 'list-1', 'knok knok', 140, 5, '2022-02-27'),
(8, '4anil', 6, 1, 'list-1', 'Anil Jadav', 460, 6, '2022-02-28');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(200) NOT NULL,
  `type` char(1) NOT NULL,
  `img` varchar(500) DEFAULT NULL,
  `address` varchar(300) NOT NULL,
  `reg_date` datetime NOT NULL DEFAULT current_timestamp(),
  `last_login` datetime NOT NULL DEFAULT current_timestamp(),
  `dbname` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `phone`, `password`, `name`, `type`, `img`, `address`, `reg_date`, `last_login`, `dbname`) VALUES
(1, '8849456821', 'Anil@Admin', 'Anil Jadav', 'a', NULL, 'mahuva', '2022-02-24 20:12:35', '2022-02-24 20:12:35', 'labman'),
(4, '7874490999', '123456', 'anil ', 'A', '', 'dudhala ', '2022-01-20 18:57:02', '2022-03-03 16:17:52', '4anil'),
(21, '7874492990', '123', 'anil', 'A', NULL, 'mjh', '2022-02-19 16:07:40', '2022-02-19 16:08:08', 'an217874'),
(22, '7874492991', '123', 'anil', 'A', NULL, 'mh', '2022-02-19 16:09:06', '2022-02-19 16:10:06', '22an7874'),
(23, '7874492992', '123', 'anil', 'A', NULL, 'mh', '2022-02-19 16:12:58', '2022-02-19 16:12:58', '23an7874'),
(24, '8849456824', '123', 'anil', 'A', NULL, '123', '2022-02-19 16:13:31', '2022-02-24 21:55:53', '24an8849'),
(25, '7359208120', '123', 'HARSH', 'A', NULL, 'ma', '2022-02-23 09:41:28', '2022-02-23 09:41:43', '25HA7359');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `4anil`
--
ALTER TABLE `4anil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `22an7874`
--
ALTER TABLE `22an7874`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `23an7874`
--
ALTER TABLE `23an7874`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `24an8849`
--
ALTER TABLE `24an8849`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `25ha7359`
--
ALTER TABLE `25ha7359`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `an217874`
--
ALTER TABLE `an217874`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `labours`
--
ALTER TABLE `labours`
  ADD PRIMARY KEY (`lid`),
  ADD KEY `frklab` (`uid`);

--
-- Indexes for table `msg`
--
ALTER TABLE `msg`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usedb` (`reciver`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`tid`),
  ADD KEY `trdb` (`dbname`),
  ADD KEY `trlid` (`lid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gmail_uni` (`phone`),
  ADD UNIQUE KEY `dbname` (`dbname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `4anil`
--
ALTER TABLE `4anil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `22an7874`
--
ALTER TABLE `22an7874`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `23an7874`
--
ALTER TABLE `23an7874`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `24an8849`
--
ALTER TABLE `24an8849`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `25ha7359`
--
ALTER TABLE `25ha7359`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `an217874`
--
ALTER TABLE `an217874`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `labours`
--
ALTER TABLE `labours`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `msg`
--
ALTER TABLE `msg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `labours`
--
ALTER TABLE `labours`
  ADD CONSTRAINT `frklab` FOREIGN KEY (`uid`) REFERENCES `user` (`id`);

--
-- Constraints for table `msg`
--
ALTER TABLE `msg`
  ADD CONSTRAINT `usedb` FOREIGN KEY (`reciver`) REFERENCES `user` (`dbname`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `trdb` FOREIGN KEY (`dbname`) REFERENCES `user` (`dbname`),
  ADD CONSTRAINT `trlid` FOREIGN KEY (`lid`) REFERENCES `labours` (`lid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
