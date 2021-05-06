

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

--
-- Indexes for table `search_terms`
--
ALTER TABLE `search_terms`
  ADD PRIMARY KEY (`search_id`),
  ADD KEY `FK_st_soft_id` (`soft_id`);


--
-- AUTO_INCREMENT for table `search_terms`
--
ALTER TABLE `search_terms`
  MODIFY `search_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;


--
-- Constraints for table `search_terms`
--
ALTER TABLE `search_terms`
  ADD CONSTRAINT `FK_st_soft_id` FOREIGN KEY (`soft_id`) REFERENCES `software` (`soft_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
