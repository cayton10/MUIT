--
-- Table structure for table `software_platform`
--

CREATE TABLE `software_platform` (
  `soft_plat_id` int NOT NULL,
  `os_id` int NOT NULL,
  `soft_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


--
-- Indexes for table `software_platform`
--
ALTER TABLE `software_platform`
  ADD PRIMARY KEY (`soft_plat_id`),
  ADD KEY `FK_sp_os_id` (`os_id`),
  ADD KEY `FK_sp_soft_id` (`soft_id`);

--
-- AUTO_INCREMENT for table `software_platform`
--
ALTER TABLE `software_platform`
  MODIFY `soft_plat_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;

--
-- Constraints for table `software_platform`
--
ALTER TABLE `software_platform`
  ADD CONSTRAINT `FK_sp_os_id` FOREIGN KEY (`os_id`) REFERENCES `operating_system` (`os_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_sp_soft_id` FOREIGN KEY (`soft_id`) REFERENCES `software` (`soft_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
