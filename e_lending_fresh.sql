-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2020 at 03:19 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_lending_fresh`
--

-- --------------------------------------------------------

--
-- Table structure for table `atm_banks`
--

CREATE TABLE `atm_banks` (
  `atm_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `branch` varchar(200) NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `encoded` datetime NOT NULL DEFAULT current_timestamp(),
  `removed` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `atm_banks`
--

INSERT INTO `atm_banks` (`atm_id`, `name`, `branch`, `remarks`, `encoded`, `removed`) VALUES
(101, 'No ATM Bank', 'n/a', '', '2018-04-08 22:31:20', 0),
(102, 'Security Bank', 'Lanang, Claveria. Ecoland', '', '2018-04-08 22:32:26', 0),
(103, 'Land bank of the Philippines', 'Lanang, Bajada, Matina', 'Government Owned', '2018-04-08 22:51:29', 0),
(104, 'Union Bank of the Philippines', 'Victoria, ADDU Jacinto, Bankerohan', '', '2018-05-23 22:19:31', 0),
(105, 'Philippine National Bank', 'ADDU Jacinto, San Pedro, Agdao, Victoria, Lanang, NCCC Uyanguren', '', '2018-05-23 22:23:39', 0),
(106, 'CTBC Bank', 'Bancnet ATM Machines', '', '2018-07-01 08:40:52', 0),
(107, 'Metrobank', 'Victoria, Abreeza, Insular, SM Malls', '', '2018-10-29 06:02:29', 0),
(108, 'BDO', 'All over Davao', '', '2018-12-07 09:22:40', 0),
(109, 'Sterling Bank of Asia', 'DLPC, Landco, Sta. Ana', '', '2019-01-25 04:55:40', 0),
(110, 'BPI', 'Lanang, R. Castillo, Abreeza', '', '2019-02-18 05:05:14', 0);

-- --------------------------------------------------------

--
-- Table structure for table `capital`
--

CREATE TABLE `capital` (
  `capital_id` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `encoded` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `atm_id` int(11) NOT NULL,
  `atm_type` varchar(45) NOT NULL COMMENT 'savings, checking, cash-card',
  `lname` varchar(45) NOT NULL,
  `fname` varchar(45) NOT NULL,
  `contact` varchar(45) NOT NULL,
  `pin` varchar(20) NOT NULL,
  `sex` varchar(20) NOT NULL,
  `job` varchar(45) NOT NULL,
  `salary` decimal(10,2) NOT NULL,
  `address` varchar(200) NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `pic1` varchar(45) DEFAULT NULL,
  `pic2` varchar(45) DEFAULT NULL,
  `pic3` varchar(45) DEFAULT NULL,
  `encoded` datetime NOT NULL DEFAULT current_timestamp(),
  `removed` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `comp_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `address` varchar(200) NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `encoded` datetime NOT NULL DEFAULT current_timestamp(),
  `removed` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`comp_id`, `name`, `address`, `remarks`, `encoded`, `removed`) VALUES
(101, 'No Company', 'n/a', '', '2018-04-08 22:40:32', 0),
(119, '13-28 BDO Unibank', 'Monteverde Narra', 'Bank', '2019-07-01 12:55:24', 0);

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `loan_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `interest` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1-New, 2-Ongoing, 3-Cleared',
  `date_start` varchar(20) NOT NULL,
  `date_end` varchar(20) NOT NULL,
  `paid` decimal(10,2) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `remarks` varchar(400) NOT NULL,
  `encoded` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `log_id` int(11) NOT NULL,
  `user_fullname` varchar(45) NOT NULL,
  `log_type` varchar(45) NOT NULL,
  `details` varchar(250) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `sched_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `date` varchar(20) NOT NULL,
  `time` varchar(45) NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `username` varchar(45) NOT NULL,
  `encoded` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `trans_id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `type` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `interest` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `remarks` varchar(45) NOT NULL,
  `encoded` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `client_id` varchar(11) DEFAULT NULL,
  `contact` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `date_registered` datetime DEFAULT current_timestamp(),
  `administrator` int(1) NOT NULL DEFAULT 0,
  `removed` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `lastname`, `firstname`, `client_id`, `contact`, `email`, `address`, `date_registered`, `administrator`, `removed`) VALUES
(101, 'super_admin', 'alphabravocharliedelta', 'n/a', 'n/a', '', 'n/a', 'n/a', 'n/a', '2017-10-10 19:34:33', 1, 0),
(108, 'mere', 'mere', 'ABAS', 'MERE', '', 'n/a', 'n/a', 'Damosa, Davao City', '2018-02-07 14:06:29', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atm_banks`
--
ALTER TABLE `atm_banks`
  ADD PRIMARY KEY (`atm_id`);

--
-- Indexes for table `capital`
--
ALTER TABLE `capital`
  ADD PRIMARY KEY (`capital_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`comp_id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`loan_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`sched_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`trans_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atm_banks`
--
ALTER TABLE `atm_banks`
  MODIFY `atm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `capital`
--
ALTER TABLE `capital`
  MODIFY `capital_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10001;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1001;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `comp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `loan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10001;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000001;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `sched_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100001;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
