-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 24, 2024 at 01:23 PM
-- Server version: 8.0.34
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lost`
--

-- --------------------------------------------------------

--
-- Table structure for table `itemtypes`
--

CREATE TABLE `itemtypes` (
  `ID` int NOT NULL,
  `Name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `itemtypes`
--

INSERT INTO `itemtypes` (`ID`, `Name`) VALUES
(1, 'Phones'),
(2, 'Bags'),
(3, 'Watches'),
(4, 'Caps'),
(5, 'Pens'),
(6, 'Accessories'),
(7, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `lostitems`
--

CREATE TABLE `lostitems` (
  `ID` int NOT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Description` text,
  `Status` varchar(50) DEFAULT NULL,
  `TypeID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `lostitems`
--

INSERT INTO `lostitems` (`ID`, `Image`, `Name`, `Description`, `Status`, `TypeID`) VALUES
(2, 'uploads/t1.png', 'test2', 'test2', 'Received', 1),
(3, 'uploads/a1.jpg', 'เครื่องเล่นเทป', 'sony walkman พร้อมหูฟัง พบที่อาคาร1', 'Not Received', 7),
(4, 'uploads/a2.jpg', 'Airpods Max', 'Airpods Max silver พบที่ห้อง 1011', 'Received', 7),
(5, 'uploads/bottbag.jpg', 'กระเป๋า', 'กระเป๋าขาว', 'Received', 2),
(6, 'uploads/caps.jpg', 'หมวก', 'หมวกเขียว', 'Not Received', 4),
(7, 'uploads/flip.jpg', 'SS Flip', 'โทรศัพท์ ซัมซุง', 'Not Received', 1),
(8, 'uploads/penc.jpg', 'ปากกา', 'ปากกา', 'Received', 5),
(9, 'uploads/i15.jpg', 'ไอโฟน15', 'ไอโฟน', 'Not Received', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `itemtypes`
--
ALTER TABLE `itemtypes`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `lostitems`
--
ALTER TABLE `lostitems`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `TypeID` (`TypeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `itemtypes`
--
ALTER TABLE `itemtypes`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `lostitems`
--
ALTER TABLE `lostitems`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lostitems`
--
ALTER TABLE `lostitems`
  ADD CONSTRAINT `lostitems_ibfk_1` FOREIGN KEY (`TypeID`) REFERENCES `itemtypes` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
