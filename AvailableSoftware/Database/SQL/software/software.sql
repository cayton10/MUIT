

--
-- Table structure for table `software`
--

CREATE TABLE `software` (
  `soft_id` int NOT NULL,
  `soft_name` varchar(45) NOT NULL,
  `soft_company` varchar(45) NOT NULL,
  `soft_type` varchar(45) NOT NULL,
  `soft_price` decimal(5,2) NOT NULL,
  `soft_description` varchar(2083) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `soft_download` varchar(2083) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


--
-- Indexes for table `software`
--
ALTER TABLE `software`
  ADD PRIMARY KEY (`soft_id`);

--
-- AUTO_INCREMENT for table `software`
--
ALTER TABLE `software`
  MODIFY `soft_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
