-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 31, 2017 at 05:28 PM
-- Server version: 5.5.52-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bloodbank`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE IF NOT EXISTS `bank` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `name`, `address`) VALUES
(1, 'TTK', 'CV Raman Nagar'),
(2, 'SDK', 'KR Puram');

-- --------------------------------------------------------

--
-- Table structure for table `blood_group`
--

CREATE TABLE IF NOT EXISTS `blood_group` (
  `id` int(11) NOT NULL,
  `blood_grp` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blood_group`
--

INSERT INTO `blood_group` (`id`, `blood_grp`) VALUES
(1, 'O+');

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE IF NOT EXISTS `hospital` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`id`, `name`, `address`) VALUES
(1, 'CMH Hospital', '100 feet road'),
(2, 'Manipal', 'Indira Nagar');

-- --------------------------------------------------------

--
-- Table structure for table `medical_history`
--

CREATE TABLE IF NOT EXISTS `medical_history` (
  `id` int(11) NOT NULL,
  `personid` int(11) NOT NULL,
  `preliminary_test` varchar(255) NOT NULL,
  `final_test` varchar(255) NOT NULL,
  `date_of_donation` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medical_history`
--

INSERT INTO `medical_history` (`id`, `personid`, `preliminary_test`, `final_test`, `date_of_donation`) VALUES
(1, 1, 'pass', 'pass', '2017-10-03');

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `bloodgrpid` int(11) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `address` text,
  `email` varchar(255) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`id`, `userid`, `bloodgrpid`, `fname`, `mname`, `lname`, `address`, `email`, `phone`) VALUES
(1, 1, 1, 'arushi', 'g', 'g', '', NULL, NULL),
(2, 2, 1, 'kavita', 's', 's', '', NULL, NULL),
(5, 15, 1, 'f_test', 'm_test', 'l_test', 'test address', 'test@test', 0),
(6, 19, 1, 'john', '', 'prince', 'C 34/14, DRDO Qtrs', 'johnprince@gmail.com', 2147483647),
(7, 20, 1, 'Sanjeev', '', 'Gupta', 'asdfasdf  asjladsfasdf', 'asdfaf@asddas.com', 548358836);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL,
  `rolename` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `rolename`) VALUES
(1, 'donor'),
(2, 'recepient'),
(3, 'bank'),
(4, 'hospital');

-- --------------------------------------------------------

--
-- Table structure for table `rolemapping`
--

CREATE TABLE IF NOT EXISTS `rolemapping` (
  `id` int(11) NOT NULL,
  `roleid` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rolemapping`
--

INSERT INTO `rolemapping` (`id`, `roleid`, `userid`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 4, 1),
(5, 3, 2),
(6, 1, 20);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `hospitalid` int(11) DEFAULT NULL,
  `bankid` int(11) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `hospitalid`, `bankid`, `username`, `pwd`) VALUES
(1, 1, NULL, 'arushi', 'e95f77c464f303a7a830b98c145a0711'),
(2, NULL, NULL, 'kavita', '686569379343cd3df1eabd9b967a14b2'),
(15, NULL, NULL, 'test', '098f6bcd4621d373cade4e832627b4f6'),
(19, NULL, NULL, 'johnprince', '55add3d845bfcd87a9b0949b0da49c0a'),
(20, NULL, NULL, 'sanjeev', '9f5a44a734ac9e43b5968d0f3b71d69b');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blood_group`
--
ALTER TABLE `blood_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medical_history`
--
ALTER TABLE `medical_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personid` (`personid`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `bloodgrpid` (`bloodgrpid`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rolemapping`
--
ALTER TABLE `rolemapping`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roleid` (`roleid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hospitalid` (`hospitalid`),
  ADD KEY `bankid` (`bankid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `blood_group`
--
ALTER TABLE `blood_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `hospital`
--
ALTER TABLE `hospital`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `medical_history`
--
ALTER TABLE `medical_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `rolemapping`
--
ALTER TABLE `rolemapping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `medical_history`
--
ALTER TABLE `medical_history`
  ADD CONSTRAINT `medical_history_ibfk_1` FOREIGN KEY (`personid`) REFERENCES `person` (`id`);

--
-- Constraints for table `person`
--
ALTER TABLE `person`
  ADD CONSTRAINT `person_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `person_ibfk_2` FOREIGN KEY (`bloodgrpid`) REFERENCES `blood_group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rolemapping`
--
ALTER TABLE `rolemapping`
  ADD CONSTRAINT `rolemapping_ibfk_1` FOREIGN KEY (`roleid`) REFERENCES `role` (`id`),
  ADD CONSTRAINT `rolemapping_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`hospitalid`) REFERENCES `hospital` (`id`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`bankid`) REFERENCES `bank` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
