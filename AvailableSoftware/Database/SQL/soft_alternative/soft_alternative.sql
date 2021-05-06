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
-- Indexes for table `soft_alternative`
--
ALTER TABLE `soft_alternative`
  ADD PRIMARY KEY (`alt_id`),
  ADD KEY `FK_alternative` (`soft_id`);

--
-- AUTO_INCREMENT for table `soft_alternative`
--
ALTER TABLE `soft_alternative`
  MODIFY `alt_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- Constraints for table `soft_alternative`
--
ALTER TABLE `soft_alternative`
  ADD CONSTRAINT `FK_alternative` FOREIGN KEY (`soft_id`) REFERENCES `software` (`soft_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
