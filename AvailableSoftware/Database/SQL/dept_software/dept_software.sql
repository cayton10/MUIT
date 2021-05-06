
CREATE TABLE `dept_software` (
  `dept_soft_id` int NOT NULL,
  `dept_id` int NOT NULL,
  `soft_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


--
-- Indexes for table `dept_software`
--
ALTER TABLE `dept_software`
  ADD PRIMARY KEY (`dept_soft_id`),
  ADD KEY `FK_ds_dept_id` (`dept_id`),
  ADD KEY `FK_ds_soft_id` (`soft_id`);


--
-- AUTO_INCREMENT for table `dept_software`
--
ALTER TABLE `dept_software`
  MODIFY `dept_soft_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;


--
-- Constraints for table `dept_software`
--
ALTER TABLE `dept_software`
  ADD CONSTRAINT `FK_ds_soft_id` FOREIGN KEY (`soft_id`) REFERENCES `software` (`soft_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
