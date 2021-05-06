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
-- Indexes for table `software_user`
--
ALTER TABLE `software_user`
  ADD PRIMARY KEY (`su_id`),
  ADD KEY `FK_su_soft_user` (`user_id`),
  ADD KEY `FK_su_soft_id` (`soft_id`);

--
-- AUTO_INCREMENT for table `software_user`
--
ALTER TABLE `software_user`
  MODIFY `su_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- Constraints for table `software_user`
--
ALTER TABLE `software_user`
  ADD CONSTRAINT `FK_su_soft_id` FOREIGN KEY (`soft_id`) REFERENCES `software` (`soft_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_su_soft_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
