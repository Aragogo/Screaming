-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2017 at 04:51 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stablo`
--

-- --------------------------------------------------------

--
-- Table structure for table `profesor_profesoru`
--

CREATE TABLE `profesor_profesoru` (
  `ID` int(11) NOT NULL,
  `Vrijeme` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Poruka` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profesor_profesoru`
--

INSERT INTO `profesor_profesoru` (`ID`, `Vrijeme`, `Poruka`) VALUES
(1, '2017-05-25 16:51:30', 'Bravo kolega!'),
(2, '2017-05-25 16:52:23', 'Bravo kolega!'),
(3, '2017-05-25 18:53:31', 'Lijepe poruke posvuda');

-- --------------------------------------------------------

--
-- Table structure for table `profesor_studentu`
--

CREATE TABLE `profesor_studentu` (
  `ID` int(11) NOT NULL,
  `Vrijeme` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Poruka` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profesor_studentu`
--

INSERT INTO `profesor_studentu` (`ID`, `Vrijeme`, `Poruka`) VALUES
(1, '2017-05-25 18:52:36', 'Neka lijepa poruka, hehe');

-- --------------------------------------------------------

--
-- Table structure for table `student_profesoru`
--

CREATE TABLE `student_profesoru` (
  `ID` int(11) NOT NULL,
  `Vrijeme` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Poruka` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_profesoru`
--

INSERT INTO `student_profesoru` (`ID`, `Vrijeme`, `Poruka`) VALUES
(1, '2017-05-25 16:56:07', 'Bravo profesore!'),
(2, '2017-05-26 02:50:47', 'Moja poruka je najljepÅ¡a');

-- --------------------------------------------------------

--
-- Table structure for table `student_studentu`
--

CREATE TABLE `student_studentu` (
  `ID` int(11) NOT NULL,
  `Vrijeme` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Poruka` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_studentu`
--

INSERT INTO `student_studentu` (`ID`, `Vrijeme`, `Poruka`) VALUES
(2, '2017-05-25 16:45:13', 'Moja poruka je lijepa'),
(3, '2017-05-25 17:28:00', 'Lijepa poruka');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `profesor_profesoru`
--
ALTER TABLE `profesor_profesoru`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `profesor_studentu`
--
ALTER TABLE `profesor_studentu`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `student_profesoru`
--
ALTER TABLE `student_profesoru`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `student_studentu`
--
ALTER TABLE `student_studentu`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `profesor_profesoru`
--
ALTER TABLE `profesor_profesoru`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `profesor_studentu`
--
ALTER TABLE `profesor_studentu`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `student_profesoru`
--
ALTER TABLE `student_profesoru`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `student_studentu`
--
ALTER TABLE `student_studentu`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
