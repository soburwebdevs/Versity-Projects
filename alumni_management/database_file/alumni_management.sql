-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 03, 2025 at 11:37 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alumni_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `Alumni`
--

CREATE TABLE `Alumni` (
  `Alumni_ID` int(11) NOT NULL,
  `First_Name` varchar(50) DEFAULT NULL,
  `Last_Name` varchar(50) DEFAULT NULL,
  `Date_of_Birth` date DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Phone_Number` varchar(15) DEFAULT NULL,
  `Address` varchar(200) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `State` varchar(50) DEFAULT NULL,
  `Country` varchar(50) DEFAULT NULL,
  `Graduation_Year` int(11) DEFAULT NULL,
  `Degree` varchar(50) DEFAULT NULL,
  `Department` varchar(50) DEFAULT NULL,
  `Current_Job_Title` varchar(100) DEFAULT NULL,
  `Company_Name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Alumni`
--

INSERT INTO `Alumni` (`Alumni_ID`, `First_Name`, `Last_Name`, `Date_of_Birth`, `Gender`, `Email`, `Phone_Number`, `Address`, `City`, `State`, `Country`, `Graduation_Year`, `Degree`, `Department`, `Current_Job_Title`, `Company_Name`) VALUES
(2, 'Sobur', 'Ahmed', '2000-01-01', 'Male', 'soburahmd@gmail.com', '0175252334266', 'Dhaka', 'Dhaka', 'Dhaka', 'Bangladesh', 2025, 'BSE', 'CSE', 'Software Developer', 'Fang Company'),
(3, 'Fahim', 'Misa Kotha  Koy', '2000-01-01', 'Male', 'fahim@gmail.com', '0175252334266', 'Kuril, Dhaka', 'Dhaka', 'USA', 'Argentina', 2028, 'BSC', 'CSE', 'Software Developer', 'Google');

-- --------------------------------------------------------

--
-- Table structure for table `Communication`
--

CREATE TABLE `Communication` (
  `Message_ID` int(11) NOT NULL,
  `Alumni_ID` int(11) DEFAULT NULL,
  `Message_Content` varchar(500) DEFAULT NULL,
  `Message_Date` date DEFAULT NULL,
  `Sender_Name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Donations`
--

CREATE TABLE `Donations` (
  `Donation_ID` int(11) NOT NULL,
  `Alumni_ID` int(11) DEFAULT NULL,
  `Amount` decimal(10,2) DEFAULT NULL,
  `Donation_Date` date DEFAULT NULL,
  `Purpose` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Events`
--

CREATE TABLE `Events` (
  `Event_ID` int(11) NOT NULL,
  `Event_Name` varchar(100) DEFAULT NULL,
  `Event_Date` date DEFAULT NULL,
  `Location` varchar(100) DEFAULT NULL,
  `Description` varchar(200) DEFAULT NULL,
  `Organizer_Name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Events`
--

INSERT INTO `Events` (`Event_ID`, `Event_Name`, `Event_Date`, `Location`, `Description`, `Organizer_Name`) VALUES
(1, 'Shoroshoti Puja', '2025-02-03', 'AIUB Campus', 'This is an religional event. Everyone must come and celebrate!', 'AIUB Authority'),
(2, 'Convocation', '2026-05-01', 'AIUB Play Ground', 'This is an nice event! All student\'s and ex student\'s are welcome! We will have a nice and healthy time to spent together!', 'AIUB Authority');

-- --------------------------------------------------------

--
-- Table structure for table `Feedback`
--

CREATE TABLE `Feedback` (
  `Feedback_ID` int(11) NOT NULL,
  `Alumni_ID` int(11) DEFAULT NULL,
  `Feedback_Text` varchar(500) DEFAULT NULL,
  `Feedback_Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Feedback`
--

INSERT INTO `Feedback` (`Feedback_ID`, `Alumni_ID`, `Feedback_Text`, `Feedback_Date`) VALUES
(1, 2, 'This is a nice feedback!', '2025-02-03'),
(2, 2, 'Great website!', '2025-02-03'),
(3, 3, 'This is a nice dashboard. Easy to use. Very handy!', '2025-02-03');

-- --------------------------------------------------------

--
-- Table structure for table `Institution`
--

CREATE TABLE `Institution` (
  `Institution_ID` int(11) NOT NULL,
  `Institution_Name` varchar(100) DEFAULT NULL,
  `Address` varchar(200) DEFAULT NULL,
  `Contact_Number` varchar(15) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Login`
--

CREATE TABLE `Login` (
  `User_ID` int(11) NOT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Role` enum('Admin','Alumni') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Login`
--

INSERT INTO `Login` (`User_ID`, `Username`, `Password`, `Role`) VALUES
(2, 'sobur', '$2y$10$5pe/y/lNbrmfngj9pnyQl.Oqbp4nuPaBFiSD.m70/HbgDHdTpuXPW', 'Alumni'),
(3, 'fahim', '$2y$10$cDQ2RZd/r3DmFUTkI9zz4.vIW..OAlSiuWa9A9xEQ4pVI4uI1gqBK', 'Alumni');

-- --------------------------------------------------------

--
-- Table structure for table `Membership`
--

CREATE TABLE `Membership` (
  `Membership_ID` int(11) NOT NULL,
  `Alumni_ID` int(11) DEFAULT NULL,
  `Membership_Type` varchar(20) DEFAULT NULL,
  `Start_Date` date DEFAULT NULL,
  `End_Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Membership`
--

INSERT INTO `Membership` (`Membership_ID`, `Alumni_ID`, `Membership_Type`, `Start_Date`, `End_Date`) VALUES
(1, 3, 'Subscriber', '2025-02-04', '2025-02-28'),
(2, 2, 'Gold', '2025-02-13', '2025-02-25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Alumni`
--
ALTER TABLE `Alumni`
  ADD PRIMARY KEY (`Alumni_ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `Communication`
--
ALTER TABLE `Communication`
  ADD PRIMARY KEY (`Message_ID`),
  ADD KEY `Alumni_ID` (`Alumni_ID`);

--
-- Indexes for table `Donations`
--
ALTER TABLE `Donations`
  ADD PRIMARY KEY (`Donation_ID`),
  ADD KEY `Alumni_ID` (`Alumni_ID`);

--
-- Indexes for table `Events`
--
ALTER TABLE `Events`
  ADD PRIMARY KEY (`Event_ID`);

--
-- Indexes for table `Feedback`
--
ALTER TABLE `Feedback`
  ADD PRIMARY KEY (`Feedback_ID`),
  ADD KEY `Alumni_ID` (`Alumni_ID`);

--
-- Indexes for table `Institution`
--
ALTER TABLE `Institution`
  ADD PRIMARY KEY (`Institution_ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `Login`
--
ALTER TABLE `Login`
  ADD PRIMARY KEY (`User_ID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `Membership`
--
ALTER TABLE `Membership`
  ADD PRIMARY KEY (`Membership_ID`),
  ADD KEY `Alumni_ID` (`Alumni_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Alumni`
--
ALTER TABLE `Alumni`
  MODIFY `Alumni_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Communication`
--
ALTER TABLE `Communication`
  MODIFY `Message_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Donations`
--
ALTER TABLE `Donations`
  MODIFY `Donation_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Events`
--
ALTER TABLE `Events`
  MODIFY `Event_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Feedback`
--
ALTER TABLE `Feedback`
  MODIFY `Feedback_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Institution`
--
ALTER TABLE `Institution`
  MODIFY `Institution_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Login`
--
ALTER TABLE `Login`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Membership`
--
ALTER TABLE `Membership`
  MODIFY `Membership_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Communication`
--
ALTER TABLE `Communication`
  ADD CONSTRAINT `Communication_ibfk_1` FOREIGN KEY (`Alumni_ID`) REFERENCES `Alumni` (`Alumni_ID`) ON DELETE CASCADE;

--
-- Constraints for table `Donations`
--
ALTER TABLE `Donations`
  ADD CONSTRAINT `Donations_ibfk_1` FOREIGN KEY (`Alumni_ID`) REFERENCES `Alumni` (`Alumni_ID`) ON DELETE CASCADE;

--
-- Constraints for table `Feedback`
--
ALTER TABLE `Feedback`
  ADD CONSTRAINT `Feedback_ibfk_1` FOREIGN KEY (`Alumni_ID`) REFERENCES `Alumni` (`Alumni_ID`) ON DELETE CASCADE;

--
-- Constraints for table `Membership`
--
ALTER TABLE `Membership`
  ADD CONSTRAINT `Membership_ibfk_1` FOREIGN KEY (`Alumni_ID`) REFERENCES `Alumni` (`Alumni_ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
