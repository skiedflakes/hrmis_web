-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2021 at 09:08 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrmis`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `department_id` int(255) NOT NULL,
  `department_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`department_id`, `department_name`) VALUES
(1, 'MITCS'),
(2, 'Human Resource Department');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `employee_id` int(255) NOT NULL,
  `department_id` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`employee_id`, `department_id`, `first_name`, `last_name`, `middle_name`, `date_of_birth`) VALUES
(1, '0', 'admin', '', '', '2021-09-26'),
(2, '1', 'Juan', 'Dela Cruz', 'H', '2019-10-08'),
(3, '2', 'John', 'Doe', 'L', '2021-09-06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leave_transaction_deatail`
--

CREATE TABLE `tbl_leave_transaction_deatail` (
  `leave_transaction_deatail_id` int(255) NOT NULL,
  `leave_transaction_master_id` int(255) NOT NULL,
  `date_of_leave` date NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_leave_transaction_deatail`
--

INSERT INTO `tbl_leave_transaction_deatail` (`leave_transaction_deatail_id`, `leave_transaction_master_id`, `date_of_leave`, `status`) VALUES
(1, 1, '2021-10-22', 1),
(2, 1, '2021-10-25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leave_transaction_master`
--

CREATE TABLE `tbl_leave_transaction_master` (
  `leave_transaction_master_id` int(255) NOT NULL,
  `employee_id` int(255) NOT NULL,
  `date_filled` datetime NOT NULL,
  `leave_type` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_leave_transaction_master`
--

INSERT INTO `tbl_leave_transaction_master` (`leave_transaction_master_id`, `employee_id`, `date_filled`, `leave_type`, `status`) VALUES
(1, 2, '2021-10-07 10:41:18', 'Vacation', 'P');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leave_type`
--

CREATE TABLE `tbl_leave_type` (
  `leave_type_id` int(255) NOT NULL,
  `leave_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_leave_type`
--

INSERT INTO `tbl_leave_type` (`leave_type_id`, `leave_name`) VALUES
(1, 'Sick Leave'),
(2, 'Vaccation Leave');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(255) NOT NULL,
  `employee_id` int(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_token` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `employee_id`, `firstname`, `middlename`, `lastname`, `username`, `password`, `user_token`, `role`) VALUES
(1, 1, '', '', '', 'admin', 'admin', '0', 'admin'),
(2, 2, 'Juan', 'Hinolan', 'Dela Cruz', 'user1', 'user1', '', 'AO'),
(3, 3, 'John Doe', 'Dy', 'Sanchez', 'user2', 'user2', '', 'DP');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `tbl_leave_transaction_deatail`
--
ALTER TABLE `tbl_leave_transaction_deatail`
  ADD PRIMARY KEY (`leave_transaction_deatail_id`);

--
-- Indexes for table `tbl_leave_transaction_master`
--
ALTER TABLE `tbl_leave_transaction_master`
  ADD PRIMARY KEY (`leave_transaction_master_id`);

--
-- Indexes for table `tbl_leave_type`
--
ALTER TABLE `tbl_leave_type`
  ADD PRIMARY KEY (`leave_type_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `department_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `employee_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_leave_transaction_deatail`
--
ALTER TABLE `tbl_leave_transaction_deatail`
  MODIFY `leave_transaction_deatail_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_leave_transaction_master`
--
ALTER TABLE `tbl_leave_transaction_master`
  MODIFY `leave_transaction_master_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_leave_type`
--
ALTER TABLE `tbl_leave_type`
  MODIFY `leave_type_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
