-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 04, 2025 at 10:43 PM
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
-- Database: `user`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `a_id` int(150) NOT NULL,
  `a_first_name` varchar(150) NOT NULL,
  `a_last_name` varchar(150) NOT NULL,
  `a_phone` varchar(150) NOT NULL,
  `a_email` varchar(150) NOT NULL,
  `a_password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`, `a_first_name`, `a_last_name`, `a_phone`, `a_email`, `a_password`) VALUES
(4, 'Fahim', 'Khan', '0175252334266', 'fahim@gmail.com', 'soburmessi'),
(5, 'Shuvo', 'Hasan', '01952353656277', 'shuvo@gmail.com', 'soburmessi');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `c_id` int(150) NOT NULL,
  `c_first_name` varchar(150) NOT NULL,
  `c_last_name` varchar(150) NOT NULL,
  `c_phone` varchar(150) NOT NULL,
  `c_email` varchar(150) NOT NULL,
  `c_password` varchar(150) NOT NULL,
  `c_street` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_id`, `c_first_name`, `c_last_name`, `c_phone`, `c_email`, `c_password`, `c_street`) VALUES
(1, 'Nafis', 'Nirvik', '0175423465467', 'nafisnirvik@gmail.com', 'soburmessi', 'Bashundhara, Block-D, Road-4'),
(2, 'Rifat', 'Fami', '0165525266774', 'rifatfami@gmail.com', 'soburmessi', 'Bashundhara, Block-D, Road-4'),
(3, 'Eren', 'Yeager', '016262646545754', 'ereh@gmail.com', 'soburmessi', 'Shiganshina'),
(4, 'Levi', 'Ackermann', '0192354326326', 'leviackermann@gmail.com', 'soburmessi', 'Unknown'),
(6, 'Satoru', 'Gojo', '0155335445454', 'satorugojo@gmail.com', 'soburmessi', 'Jujutsu High'),
(7, 'Ryomen', 'Sukuna', '017324632634', 'ryomensukuna@gmail.com', 'soburmessi', 'Hien Era');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `e_id` int(150) NOT NULL,
  `e_name` varchar(150) NOT NULL,
  `e_phone` varchar(150) NOT NULL,
  `e_email` varchar(150) NOT NULL,
  `e_password` varchar(150) NOT NULL,
  `e_position` varchar(150) NOT NULL,
  `e_address` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`e_id`, `e_name`, `e_phone`, `e_email`, `e_password`, `e_position`, `e_address`) VALUES
(1, 'Srijon Biswas', '01855256266737', 'srijonbiswas@gmail.com', 'soburmessi', 'Manager', 'Kishoreganj'),
(3, 'Monjurul Haque', '01935643632636', 'monjurulhaque@gmail.com', 'soburmessi', 'Manager', 'Kishoreganj'),
(4, 'Shanto Saha', '017523563643462', 'shantosaha@gmail.com', 'soburmessi', 'Manager', 'Dhaka'),
(6, 'Rafiul Hasan', '016235626356', 'efti@gmail.com', 'soburmessi', 'Manager', 'Kishoreganj'),
(7, 'Shairav Dadu', '01855256266737', 'dadu@gmail.com', 'soburmessi', 'Computer Operator', 'Khulna');

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

CREATE TABLE `order_table` (
  `o_id` int(150) NOT NULL,
  `c_id` int(150) NOT NULL,
  `pr_id` int(150) NOT NULL,
  `order_date` varchar(150) NOT NULL,
  `quantity` int(150) NOT NULL,
  `status` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `p_id` int(150) NOT NULL,
  `o_id` int(150) NOT NULL,
  `amount` int(150) NOT NULL,
  `payment_date` varchar(150) NOT NULL,
  `payment_method` varchar(150) NOT NULL,
  `payment_status` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pr_id` int(150) NOT NULL,
  `s_id` int(150) NOT NULL,
  `p_name` varchar(150) NOT NULL,
  `p_price` varchar(150) NOT NULL,
  `p_category` varchar(150) NOT NULL,
  `p_model` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pr_id`, `s_id`, `p_name`, `p_price`, `p_category`, `p_model`) VALUES
(1, 1, 'Rolls Royce Ghost', '354750', 'Sports Car', 'Ghost'),
(2, 3, 'Bugatti', '400300', 'Sports Car', 'GT3'),
(3, 1, 'Mercedes Benz', '300120', 'Classic', 'Mercedes Benz 23'),
(4, 3, 'Maxza', '250000', 'Sports Car', 'Maxza MX5'),
(6, 4, 'BMW', '300000', 'Sports Car', 'BMW 3'),
(7, 5, 'Masaratti', '500000', 'Sports Car', 'V3');

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `s_id` int(150) NOT NULL,
  `s_name` varchar(150) NOT NULL,
  `s_email` varchar(150) NOT NULL,
  `s_phone` varchar(150) NOT NULL,
  `s_address` varchar(150) NOT NULL,
  `s_password` varchar(150) NOT NULL,
  `s_bank_account_no` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`s_id`, `s_name`, `s_email`, `s_phone`, `s_address`, `s_password`, `s_bank_account_no`) VALUES
(1, 'Elon Musk', 'elonmusk@gmail.com', '01723523554', 'USA', '$2y$10$ykGiboFgemYm19axV90iweAkSIvvVDWHo4vQdh/sBYRoilUy4D.4m', '100002534252346236'),
(3, 'Bill Gates', 'billgates@gmail.com', '017235274746', 'USA', '$2y$10$RXW75VO9dX8rVs/rQny32.jbaLn5FxWQYIvd9aHEzZlQGJN6esIby', '1000003453262366'),
(4, 'Lionel Messi', 'messi@gmail.com', '019234623666', 'Rosario, Argentina', '$2y$10$oCpwKdw9L8eCf1RtpPTgUOoCYjUafNwfp.xOcfpUxr0Q9BKWTOnPO', '100000025332662662'),
(5, 'Angel Di Maria', 'dimaria@gmail.com', '017235273553', 'Argentina', '$2y$10$Ad59RwvB82dyI2eHoJgyJ.ascN2zxlZWUwPclaz/JVngOEzVvISmW', '100000032363636'),
(6, 'Ananda Paul Arko', 'arko@gmail.com', '017235223535', 'Kishoreganj', '$2y$10$8u5nJm38MpIDlQa9RjMxpeaZRzhAhJh6RQU.8d4Rwcwa85ixuTpai', '10000034532252');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `order_table`
--
ALTER TABLE `order_table`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pr_id`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`s_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `a_id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `c_id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `e_id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_table`
--
ALTER TABLE `order_table`
  MODIFY `o_id` int(150) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `p_id` int(150) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pr_id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `s_id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
