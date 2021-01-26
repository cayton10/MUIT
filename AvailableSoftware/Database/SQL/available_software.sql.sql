-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Jan 26, 2021 at 05:42 PM
-- Server version: 8.0.22
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `available_software`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` int NOT NULL,
  `dept_name` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_name`) VALUES
(1, 'ALL'),
(2, 'College of Science'),
(3, 'Information Technology');

-- --------------------------------------------------------

--
-- Table structure for table `dept_software`
--

CREATE TABLE `dept_software` (
  `despt_soft_id` int NOT NULL,
  `dept_id` int NOT NULL,
  `soft_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `dept_software`
--

INSERT INTO `dept_software` (`despt_soft_id`, `dept_id`, `soft_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `operating_system`
--

CREATE TABLE `operating_system` (
  `os_id` int NOT NULL,
  `os_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `operating_system`
--

INSERT INTO `operating_system` (`os_id`, `os_name`) VALUES
(2, 'Windows 10'),
(3, 'MacOSX'),
(4, 'Linux'),
(5, 'iOS'),
(8, 'Android');

-- --------------------------------------------------------

--
-- Table structure for table `search_terms`
--

CREATE TABLE `search_terms` (
  `search_id` int NOT NULL,
  `search_term` varchar(18) NOT NULL,
  `soft_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `search_terms`
--

INSERT INTO `search_terms` (`search_id`, `search_term`, `soft_id`) VALUES
(1, 'antivirus', 1),
(2, 'anti virus', 1);

-- --------------------------------------------------------

--
-- Table structure for table `software`
--

CREATE TABLE `software` (
  `soft_id` int NOT NULL,
  `soft_name` varchar(45) NOT NULL,
  `soft_company` varchar(45) NOT NULL,
  `soft_type` varchar(45) NOT NULL,
  `soft_price` decimal(5,2) NOT NULL,
  `soft_description` text NOT NULL,
  `soft_download` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `software`
--

INSERT INTO `software` (`soft_id`, `soft_name`, `soft_company`, `soft_type`, `soft_price`, `soft_description`, `soft_download`) VALUES
(1, 'Defender Antivirus', 'Microsoft', 'Antivirus Application', '0.00', 'Formerly known as Windows Defender, Microsoft Defender Antivirus still delivers the comprehensive, ongoing, and real-time protection you expect against software threats like viruses, malware, and spyware across email, apps, the cloud, and the web.', 'On-Campus');

-- --------------------------------------------------------

--
-- Table structure for table `software_platform`
--

CREATE TABLE `software_platform` (
  `soft_plat_id` int NOT NULL,
  `os_id` int NOT NULL,
  `soft_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `software_platform`
--

INSERT INTO `software_platform` (`soft_plat_id`, `os_id`, `soft_id`) VALUES
(1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `software_user`
--

CREATE TABLE `software_user` (
  `su_id` int NOT NULL,
  `su_eligible` tinyint(1) NOT NULL,
  `soft_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `software_user`
--

INSERT INTO `software_user` (`su_id`, `su_eligible`, `soft_id`, `user_id`) VALUES
(1, 1, 1, 2),
(2, 1, 1, 3),
(4, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `soft_alternative`
--

CREATE TABLE `soft_alternative` (
  `alt_id` int NOT NULL,
  `alt_name` varchar(45) NOT NULL,
  `soft_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `soft_alternative`
--

INSERT INTO `soft_alternative` (`alt_id`, `alt_name`, `soft_id`) VALUES
(1, 'WebRoot', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int NOT NULL,
  `user_type` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_type`) VALUES
(1, 'student'),
(2, 'faculty'),
(3, 'staff'),
(4, 'all');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `dept_software`
--
ALTER TABLE `dept_software`
  ADD PRIMARY KEY (`despt_soft_id`),
  ADD KEY `FK_ds_dept_id` (`dept_id`),
  ADD KEY `FK_ds_soft_id` (`soft_id`);

--
-- Indexes for table `operating_system`
--
ALTER TABLE `operating_system`
  ADD PRIMARY KEY (`os_id`);

--
-- Indexes for table `search_terms`
--
ALTER TABLE `search_terms`
  ADD PRIMARY KEY (`search_id`),
  ADD KEY `FK_st_soft_id` (`soft_id`);

--
-- Indexes for table `software`
--
ALTER TABLE `software`
  ADD PRIMARY KEY (`soft_id`);

--
-- Indexes for table `software_platform`
--
ALTER TABLE `software_platform`
  ADD PRIMARY KEY (`soft_plat_id`),
  ADD KEY `FK_sp_os_id` (`os_id`),
  ADD KEY `FK_sp_soft_id` (`soft_id`);

--
-- Indexes for table `software_user`
--
ALTER TABLE `software_user`
  ADD PRIMARY KEY (`su_id`),
  ADD KEY `FK_su_soft_user` (`user_id`),
  ADD KEY `FK_su_soft_id` (`soft_id`);

--
-- Indexes for table `soft_alternative`
--
ALTER TABLE `soft_alternative`
  ADD PRIMARY KEY (`alt_id`),
  ADD KEY `FK_alternative` (`soft_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dept_software`
--
ALTER TABLE `dept_software`
  MODIFY `despt_soft_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `operating_system`
--
ALTER TABLE `operating_system`
  MODIFY `os_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `search_terms`
--
ALTER TABLE `search_terms`
  MODIFY `search_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `software`
--
ALTER TABLE `software`
  MODIFY `soft_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `software_platform`
--
ALTER TABLE `software_platform`
  MODIFY `soft_plat_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `software_user`
--
ALTER TABLE `software_user`
  MODIFY `su_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `soft_alternative`
--
ALTER TABLE `soft_alternative`
  MODIFY `alt_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dept_software`
--
ALTER TABLE `dept_software`
  ADD CONSTRAINT `FK_ds_dept_id` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ds_soft_id` FOREIGN KEY (`soft_id`) REFERENCES `software` (`soft_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `search_terms`
--
ALTER TABLE `search_terms`
  ADD CONSTRAINT `FK_st_soft_id` FOREIGN KEY (`soft_id`) REFERENCES `software` (`soft_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `software_platform`
--
ALTER TABLE `software_platform`
  ADD CONSTRAINT `FK_sp_os_id` FOREIGN KEY (`os_id`) REFERENCES `operating_system` (`os_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_sp_soft_id` FOREIGN KEY (`soft_id`) REFERENCES `software` (`soft_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `software_user`
--
ALTER TABLE `software_user`
  ADD CONSTRAINT `FK_su_soft_id` FOREIGN KEY (`soft_id`) REFERENCES `software` (`soft_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_su_soft_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `soft_alternative`
--
ALTER TABLE `soft_alternative`
  ADD CONSTRAINT `FK_alternative` FOREIGN KEY (`soft_id`) REFERENCES `software` (`soft_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;