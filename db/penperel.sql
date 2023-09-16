-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 16, 2023 at 08:16 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penperel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `idadmin` int(11) NOT NULL,
  `kata` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`idadmin`, `kata`) VALUES
(1, '$2y$10$2D1xKoHiE8RQFF.RrzHj7.N2MDxb7DueV0sZn2RHk7Imryh6yl8we');

-- --------------------------------------------------------

--
-- Table structure for table `pelajar`
--

CREATE TABLE `pelajar` (
  `idpelajar` int(11) NOT NULL,
  `warden` int(11) NOT NULL,
  `namapelajar` varchar(250) NOT NULL,
  `nokppelajar` varchar(12) NOT NULL,
  `kata` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelajar`
--

INSERT INTO `pelajar` (`idpelajar`, `warden`, `namapelajar`, `nokppelajar`, `kata`) VALUES
(5, 1, 'aishah', '012345678912', '$2y$10$xZOgrwEOI8mvjE8KxDlHOeKCct4k2EhFISM1of/ykboVlBIstVMkm'),
(7, 3, 'akid', '012020021561', '$2y$10$kZS3v090Ypj6Pc9LQJWOCOKA46TZjYARw6qcLSDYWd2Uth1o6w5DS'),
(8, 3, 'ayan', '031203025421', '$2y$10$00Cp2QdWNayHZgvnIw1T3OrWDhh6w8Ky38RMIttg81pn0u9jxQYH.'),
(9, 3, 'aliya', '061114064587', '$2y$10$n41o1RVfsmqC0l2xQH8Wd.cuBkIoAjPqZhdMxlOjNteIkJfrXd1mO');

-- --------------------------------------------------------

--
-- Table structure for table `peralatan`
--

CREATE TABLE `peralatan` (
  `idperalatan` int(11) NOT NULL,
  `pelajar` int(11) NOT NULL,
  `jenisperalatan` varchar(255) NOT NULL,
  `jenama` varchar(255) NOT NULL,
  `nosiri` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peralatan`
--

INSERT INTO `peralatan` (`idperalatan`, `pelajar`, `jenisperalatan`, `jenama`, `nosiri`) VALUES
(2, 7, 'Lampu Bilik', 'Panasonic', '123'),
(3, 5, 'Rice Cooker', 'panasonic', '456'),
(4, 9, 'meja', 'Norberg', '154'),
(5, 9, 'lampu', 'lg', 'L098'),
(6, 9, 'lampu', 'lg', 'l23');

-- --------------------------------------------------------

--
-- Table structure for table `warden`
--

CREATE TABLE `warden` (
  `idwarden` int(11) NOT NULL,
  `namawarden` varchar(250) NOT NULL,
  `nokpwarden` int(11) NOT NULL,
  `kata` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warden`
--

INSERT INTO `warden` (`idwarden`, `namawarden`, `nokpwarden`, `kata`) VALUES
(1, 'zati', 1035, '$2y$10$nSd.3l8ubtt52jz625web.XowWaj8VOiuso80iAnNCuVQiVxabUSa'),
(3, 'qur', 7890, '$2y$10$4W3VHyc/ZKHeH3q9rBNO7uHKPfzw/L9XXm9/ZyRiEyBRm7d7jWNee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idadmin`);

--
-- Indexes for table `pelajar`
--
ALTER TABLE `pelajar`
  ADD PRIMARY KEY (`idpelajar`),
  ADD KEY `test` (`warden`);

--
-- Indexes for table `peralatan`
--
ALTER TABLE `peralatan`
  ADD PRIMARY KEY (`idperalatan`),
  ADD KEY `test2` (`pelajar`);

--
-- Indexes for table `warden`
--
ALTER TABLE `warden`
  ADD PRIMARY KEY (`idwarden`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `idadmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pelajar`
--
ALTER TABLE `pelajar`
  MODIFY `idpelajar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `peralatan`
--
ALTER TABLE `peralatan`
  MODIFY `idperalatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `warden`
--
ALTER TABLE `warden`
  MODIFY `idwarden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pelajar`
--
ALTER TABLE `pelajar`
  ADD CONSTRAINT `test` FOREIGN KEY (`warden`) REFERENCES `warden` (`idwarden`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `peralatan`
--
ALTER TABLE `peralatan`
  ADD CONSTRAINT `test2` FOREIGN KEY (`pelajar`) REFERENCES `pelajar` (`idpelajar`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
