-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2018 at 10:58 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_lending`
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
  `encoded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
(105, 'Philippine National Bank', 'ADDU Jacinto, San Pedro, Agdao, Victoria, Lanang, NCCC Uyanguren', '', '2018-05-23 22:23:39', 0);

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
  `encoded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `capital`
--

INSERT INTO `capital` (`capital_id`, `date`, `amount`, `total`, `remarks`, `encoded`) VALUES
(10001, '2018-04-15', '23360.00', '23360.00', 'Initial total capital amount upon application creation', '2018-04-15 03:00:46'),
(10002, '2018-05-29', '3700.00', '27060.00', 'Additonal capital from ATI salary withdrawal', '2018-05-29 21:40:04'),
(10003, '2018-06-03', '2940.00', '30000.00', 'Additional capital to close 30,000 total mark', '2018-06-03 22:17:01');

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
  `pic1` varchar(45) NOT NULL,
  `pic2` varchar(45) NOT NULL,
  `pic3` varchar(45) NOT NULL,
  `encoded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `removed` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `comp_id`, `atm_id`, `atm_type`, `lname`, `fname`, `contact`, `pin`, `sex`, `job`, `salary`, `address`, `remarks`, `pic1`, `pic2`, `pic3`, `encoded`, `removed`) VALUES
(10001, 105, 103, 'Savings', 'ISRAEL', 'LADY GRACE', 'N/A', '0000', 'Female', 'Data Encoder', '8500.00', 'Bangkal, Davao City', 'Unknown ATM pin, DENR contract finished', '10001.jpg', '', '', '2018-04-08 23:00:46', 0),
(10002, 105, 103, 'Savings', 'N/A', 'ZANDRO', 'n/a', '0000', 'Male', 'Data Encoder', '8500.00', 'n/a', 'Unknown Last name, ATM pin, DENR contract finished', '', '', '', '2018-04-08 23:22:14', 0),
(10003, 104, 102, 'Savings', 'ALDERITE', 'ROSE ANN', '+639506619197', '0000', 'Female', 'Associate', '17000.00', 'Mandug / Calinan, Davao City', '', '10003.jpg', '', '', '2018-04-09 02:57:21', 0),
(10004, 104, 102, 'Savings', 'ZABATE', 'KAREN JANE', '+639198677806', '2330', 'Female', 'Associate', '17000.00', 'Central Park Bangkal, Davao City', '', '10004.jpg', '', '', '2018-04-09 16:44:58', 0),
(10005, 102, 101, 'Savings', 'ABDULLAH', 'FARHANA BINT', 'n/a', '040501', 'Female', 'Associate', '15000.00', 'Jacinto Blvd, Davao City', 'No ATM card surrendered, unknown card type and pin, ', '10005.jpg', '10005.jpg', '', '2018-04-09 16:56:42', 0),
(10006, 104, 102, 'Savings', 'ANGELES', 'RUBY', '+639321356019', '0000', 'Female', 'Associate', '17000.00', 'Brgy. 37 Bucana Trading Blvd, Davao City', 'Currently not connected to VXI', '', '', '', '2018-04-09 18:05:50', 0),
(10007, 104, 102, 'Savings', 'ABUNDA', 'ERIKA ANNE', '+639567134705', '0331', 'Female', 'Associate', '17000.00', 'Buhangin, Davao City', '', '10007.jpg', '', '', '2018-04-09 18:21:50', 0),
(10008, 104, 102, 'Savings', 'GESTA', 'JOEY MICHAEL', 'n/a', '2468', 'Male', 'Associate', '17000.00', 'n/a', 'No ATM surrendered, unknown basic details.', '', '10008.jpg', '', '2018-04-09 18:29:56', 0),
(10009, 103, 101, 'Savings', 'BAYANI', 'ESNEYRA', 'n/a', '682488', 'Female', 'Associate', '16000.00', 'Jacinto Piapi Blvd, Davao City', 'No ATM card surrendered', '10009.jpg', '10009.jpg', '', '2018-04-09 18:37:37', 0),
(10010, 104, 102, 'Savings', 'CABANG', 'REYSEL', '+639777674728', '2471', 'Female', 'Associate', '17000.00', 'NHA Bangkal, Davao City', '', '', '', '', '2018-04-09 18:44:46', 0),
(10011, 104, 102, 'Savings', 'CABANG', 'RUSSEL', '+639339235027', '0726', 'Male', 'Associate', '17000.00', 'NHA Bangkal, Davao City', 'Son of Reysel \"Mami Reysel\" Cabang', '10011.jpg', '', '', '2018-04-09 18:51:04', 0),
(10012, 101, 101, 'Savings', 'TORRES', 'JESSA MAE', 'n/a', '0000', 'Female', 'n/a', '0.00', 'n/a', 'Owner\'s sister', '', '', '', '2018-04-16 18:13:06', 0),
(10013, 104, 102, 'Savings', 'BIWANG', 'JUHAIRY', '+639479367787', '1120', 'Female', 'Associate', '17000.00', 'Bankahan St. Brgt Gravahan, New Matina, Davao City', 'New customer referred by Brox.', '10013.jpg', '10013.jpg', '', '2018-04-20 01:09:33', 0),
(10014, 104, 101, 'Savings', 'DIENDO', 'SHERLYN', 'n/a', '0000', 'Female', 'Associate', '17000.00', 'n/a', 'Friend of Brox. No complete details and ATM surrendered', '', '', '', '2018-05-14 01:43:20', 0),
(10015, 101, 105, 'Cash Card', 'CHAVEZ', 'JOMAR', 'n/a', '0863', 'Male', 'n/a', '0.00', 'n/a', 'ATM source is thru pension. Close friend of Alshameer', '', '10015.jpg', '', '2018-05-23 22:27:14', 0),
(10016, 103, 104, 'Savings', 'PRESENTE', 'JAYRRAH PRAISE A.', '09076147056', '048498', 'Female', 'Associate', '16000.00', 'Deca Mulig Toril or Emily homes, Cabantian, Davao City', 'Referred by Esneyra Bayani. Workmate in IBEX with same account', '10016.jpg', '', '', '2018-05-29 12:03:38', 0);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `comp_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `address` varchar(200) NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `encoded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `removed` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`comp_id`, `name`, `address`, `remarks`, `encoded`, `removed`) VALUES
(101, 'No Company', 'n/a', '', '2018-04-08 22:40:32', 0),
(102, 'Sutherland Global Services Inc.', 'Quirino, Davao City', 'BPO Company', '2018-04-08 22:41:30', 0),
(103, 'IBEX Global', 'SM Lanang Premiere, Davao City', 'BPO Company', '2018-04-08 22:43:29', 0),
(104, 'VXI Global Solutions, LLC - SM Ecoland', 'SM Ecoland, Davao City', 'BPO Company', '2018-04-08 22:44:29', 0),
(105, 'DENR LMS XI', 'Bangkal, Davao City', 'Government Agency', '2018-04-08 22:50:10', 0);

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
  `encoded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`loan_id`, `client_id`, `amount`, `interest`, `total`, `status`, `date_start`, `date_end`, `paid`, `balance`, `remarks`, `encoded`) VALUES
(10001, 10001, '5000.00', '250.00', '5250.00', 3, '2017-09-28', '2017-11-27', '6000.00', '0.00', '1st lending transaction', '2018-04-09 01:19:07'),
(10002, 10001, '5000.00', '250.00', '5250.00', 3, '2017-12-08', '2018-01-06', '5250.00', '0.00', '121', '2018-04-09 01:27:15'),
(10003, 10002, '2500.00', '125.00', '2625.00', 3, '2017-10-27', '2017-11-24', '2625.00', '0.00', '', '2018-04-09 02:22:06'),
(10004, 10003, '2000.00', '140.00', '2140.00', 3, '2017-11-14', '2017-11-17', '2140.00', '0.00', '', '2018-04-09 02:58:10'),
(10005, 10003, '2000.00', '140.00', '2140.00', 3, '2017-11-21', '2017-11-30', '4140.00', '0.00', '', '2018-04-09 02:59:46'),
(10006, 10003, '3000.00', '210.00', '3210.00', 3, '2017-12-15', '2017-12-29', '5350.00', '0.00', '', '2018-04-09 03:02:34'),
(10007, 10003, '5000.00', '350.00', '5350.00', 3, '2018-02-15', '2018-03-08', '5350.00', '0.00', '', '2018-04-09 03:06:52'),
(10008, 10003, '7000.00', '490.00', '7490.00', 3, '2018-03-08', '2018-03-22', '7490.00', '0.00', '', '2018-04-09 03:09:22'),
(10009, 10003, '10000.00', '700.00', '10700.00', 3, '2018-03-22', '2018-05-17', '13650.00', '0.00', '', '2018-04-09 03:11:11'),
(10010, 10004, '3000.00', '210.00', '3210.00', 3, '2017-11-17', '2017-11-08', '3210.00', '0.00', '', '2018-04-09 16:45:26'),
(10011, 10004, '5000.00', '350.00', '5350.00', 3, '2017-12-23', '2018-01-25', '5470.00', '0.00', '', '2018-04-09 16:47:45'),
(10012, 10004, '5000.00', '350.00', '5350.00', 3, '2018-01-31', '2018-02-22', '5350.00', '0.00', '', '2018-04-09 16:50:59'),
(10013, 10004, '10000.00', '700.00', '10700.00', 3, '2018-02-28', '2018-04-19', '11050.00', '0.00', '', '2018-04-09 16:52:58'),
(10014, 10005, '2000.00', '140.00', '2140.00', 3, '2017-12-04', '2018-01-04', '2140.00', '0.00', '', '2018-04-09 16:59:05'),
(10015, 10005, '3000.00', '210.00', '3210.00', 3, '2018-01-21', '2018-02-20', '3210.00', '0.00', '', '2018-04-09 17:05:21'),
(10016, 10005, '3000.00', '210.00', '3210.00', 3, '2018-03-04', '2018-03-28', '3210.00', '0.00', '', '2018-04-09 17:14:01'),
(10017, 10005, '5000.00', '350.00', '5350.00', 3, '2018-03-28', '2018-05-11', '5720.00', '0.00', '', '2018-04-09 17:16:09'),
(10018, 10006, '5000.00', '350.00', '5350.00', 3, '2017-12-23', '2018-01-25', '5530.00', '0.00', '', '2018-04-09 18:06:15'),
(10019, 10007, '3000.00', '210.00', '3210.00', 3, '2018-02-01', '2018-02-23', '3210.00', '0.00', '', '2018-04-09 18:23:52'),
(10020, 10008, '2000.00', '140.00', '2140.00', 3, '2018-02-20', '2018-03-09', '2140.00', '0.00', '', '2018-04-09 18:30:48'),
(10021, 10008, '1000.00', '70.00', '1070.00', 3, '2018-03-13', '2018-03-22', '1070.00', '0.00', '', '2018-04-09 18:33:04'),
(10022, 10009, '2000.00', '140.00', '2140.00', 3, '2018-02-26', '2018-03-23', '2140.00', '0.00', '', '2018-04-09 18:38:07'),
(10023, 10009, '5000.00', '350.00', '5350.00', 3, '2018-03-23', '2018-05-10', '5410.00', '0.00', '', '2018-04-09 18:40:40'),
(10024, 10010, '5000.00', '350.00', '5350.00', 3, '2018-03-03', '2018-04-12', '5500.00', '0.00', '', '2018-04-09 18:45:10'),
(10025, 10011, '5000.00', '350.00', '5350.00', 3, '2018-03-13', '2018-03-28', '5350.00', '0.00', '', '2018-04-09 18:51:44'),
(10026, 10010, '5000.00', '350.00', '5350.00', 3, '2018-04-12', '2018-05-12', '5350.00', '0.00', '', '2018-04-12 22:18:17'),
(10027, 10012, '1000.00', '0.00', '1000.00', 3, '2018-04-16', '2018-04-28', '1100.00', '0.00', 'No interest since family member', '2018-04-16 18:27:31'),
(10028, 10009, '1000.00', '70.00', '1070.00', 3, '2018-04-20', '2018-05-10', '1070.00', '0.00', 'Additional loan posted as new transaction. last balance is 2850 so 3850 all in all.', '2018-04-20 00:46:40'),
(10029, 10013, '5000.00', '350.00', '5350.00', 3, '2018-04-19', '2018-04-26', '5350.00', '0.00', '1st loan. Meet up at  BDO SM Eco Annex', '2018-04-20 01:10:44'),
(10030, 10004, '10000.00', '700.00', '10700.00', 2, '2018-04-26', 'n/a', '8300.00', '2750.00', '', '2018-04-27 01:33:58'),
(10031, 10013, '10000.00', '700.00', '10700.00', 3, '2018-04-26', '2018-05-31', '11130.00', '0.00', 'New loan after payment of last loan 5350. added 4650 to come up with 10,000', '2018-04-27 01:40:09'),
(10032, 10005, '5000.00', '350.00', '5350.00', 2, '2018-05-11', 'n/a', '1000.00', '4350.00', 'ATM is to be followed', '2018-05-11 23:24:11'),
(10033, 10007, '2000.00', '140.00', '2140.00', 3, '2018-05-12', '2018-05-31', '2140.00', '0.00', 'New loan after a long time', '2018-05-12 10:21:53'),
(10034, 10014, '2000.00', '140.00', '2140.00', 3, '2018-05-12', '2018-05-18', '2140.00', '0.00', 'No ATM surrendered. Co-make by brox', '2018-05-14 01:46:21'),
(10035, 10009, '3000.00', '210.00', '3210.00', 3, '2018-05-16', '2018-05-25', '3210.00', '0.00', '', '2018-05-16 21:53:56'),
(10036, 10003, '10000.00', '700.00', '10700.00', 2, '2018-05-17', 'n/a', '2800.00', '8700.00', 'loan after full payment of last loan 5350', '2018-05-17 21:09:02'),
(10037, 10015, '2500.00', '175.00', '2675.00', 3, '2018-05-23', '2018-06-05', '2675.00', '0.00', 'Payment source is thru pension via PNB ATM card', '2018-05-23 23:21:16'),
(10038, 10008, '2000.00', '140.00', '2140.00', 2, '2018-05-25', 'n/a', '1100.00', '1040.00', 'New trans after a long time', '2018-05-25 22:06:16'),
(10039, 10016, '8000.00', '560.00', '8560.00', 1, '2018-05-29', 'n/a', '0.00', '8560.00', 'According to her, for her mother\'s hospital finances', '2018-05-29 21:10:12'),
(10040, 10013, '15000.00', '1050.00', '16050.00', 1, '2018-05-31', 'n/a', '0.00', '16050.00', 'New loan right away after last loan paid', '2018-05-31 23:03:12');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `log_id` int(11) NOT NULL,
  `user_fullname` varchar(45) NOT NULL,
  `log_type` varchar(45) NOT NULL,
  `details` varchar(250) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`log_id`, `user_fullname`, `log_type`, `details`, `date_time`) VALUES
(1000001, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-04-08 22:37:59'),
(1000002, 'TORRES, JIK', 'Add', 'New%20company%20added:%20DENR%20LMS%20XI', '2018-04-08 22:40:33'),
(1000003, 'TORRES, JIK', 'Add', 'New%20company%20added:%20Sutherland%20Global%20Services%20Inc.', '2018-04-08 22:41:30'),
(1000004, 'TORRES, JIK', 'Add', 'New%20company%20added:%20IBEX%20Global', '2018-04-08 22:43:29'),
(1000005, 'TORRES, JIK', 'Add', 'New%20company%20added:%20VXI%20Global%20Solutions%20LLC%20-%20SM%20Ecoland', '2018-04-08 22:44:30'),
(1000006, 'TORRES, JIK', 'Update', 'Company%20updated%20J101:%20DENR%20LMS%20XI%20to%20No%20Company', '2018-04-08 22:49:42'),
(1000007, 'TORRES, JIK', 'Add', 'New%20company%20added:%20DENR%20LMS%20XI', '2018-04-08 22:50:11'),
(1000008, 'TORRES, JIK', 'Update', 'ATM%20Bank%20updated%20A101:%20Land%20bank%20of%20the%20Philippines%20to%20No%20ATM%20Bank', '2018-04-08 22:51:03'),
(1000009, 'TORRES, JIK', 'Add', 'New%20ATM%20bank%20added:%20Land%20bank%20of%20the%20Philippines', '2018-04-08 22:51:29'),
(1000010, 'TORRES, JIK', 'Update', 'ATM%20Bank%20updated%20A103:%20Land%20bank%20of%20the%20Philippines%20to%20Land%20bank%20of%20the%20Philippines', '2018-04-08 22:51:49'),
(1000011, 'TORRES, JIK', 'Add', 'New%20client%20record%20added:%20ISRAEL%20LADY%20GRACE', '2018-04-08 23:00:47'),
(1000012, 'TORRES, JIK', 'Add', 'New%20client%20record%20added:%20N', '2018-04-08 23:22:15'),
(1000013, 'TORRES, JIK', 'Update', 'Client%20updated%20C10001:%20ISRAEL%20LADY%20GRACE', '2018-04-08 23:22:31'),
(1000014, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10002:%20N', '2018-04-08 23:50:44'),
(1000015, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L12%20of%20Client:%20N', '2018-04-09 00:08:02'),
(1000016, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10001:%20ISRAEL%20LADY%20GRACE', '2018-04-09 00:11:02'),
(1000017, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L13%20of%20Client:%20ISRAEL%20LADY%20GRACE', '2018-04-09 00:11:42'),
(1000018, 'TORRES, JIK', 'Add', 'New%20interest%20added%20to%20Loan%20ID:%20L13%20of%20Client:%20ISRAEL%20LADY%20GRACE', '2018-04-09 00:24:44'),
(1000019, 'TORRES, JIK', 'Update', 'New%20loan%20adjustment%20to%20Loan%20ID:%20L13%20of%20Client:%20ISRAEL%20LADY%20GRACE', '2018-04-09 00:30:32'),
(1000020, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L13%20of%20Client:%20ISRAEL%20LADY%20GRACE', '2018-04-09 00:37:41'),
(1000021, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10001:%20ISRAEL%20LADY%20GRACE', '2018-04-09 01:19:07'),
(1000022, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10001%20of%20Client:%20ISRAEL%20LADY%20GRACE', '2018-04-09 01:19:54'),
(1000023, 'TORRES, JIK', 'Add', 'New%20interest%20added%20to%20Loan%20ID:%20L10001%20of%20Client:%20ISRAEL%20LADY%20GRACE', '2018-04-09 01:21:54'),
(1000024, 'TORRES, JIK', 'Update', 'New%20loan%20adjustment%20to%20Loan%20ID:%20L10001%20of%20Client:%20ISRAEL%20LADY%20GRACE', '2018-04-09 01:23:58'),
(1000025, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10001%20of%20Client:%20ISRAEL%20LADY%20GRACE', '2018-04-09 01:25:23'),
(1000026, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10001:%20ISRAEL%20LADY%20GRACE', '2018-04-09 01:27:16'),
(1000027, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10002%20of%20Client:%20ISRAEL%20LADY%20GRACE', '2018-04-09 01:28:25'),
(1000028, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10002:%20N', '2018-04-09 02:22:06'),
(1000029, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10003%20of%20Client:%20N', '2018-04-09 02:51:28'),
(1000030, 'TORRES, JIK', 'Add', 'New%20client%20record%20added:%20ALDERITE%20ROSE%20ANN', '2018-04-09 02:57:22'),
(1000031, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10003:%20ALDERITE%20ROSE%20ANN', '2018-04-09 02:58:11'),
(1000032, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10004%20of%20Client:%20ALDERITE%20ROSE%20ANN', '2018-04-09 02:58:56'),
(1000033, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10003:%20ALDERITE%20ROSE%20ANN', '2018-04-09 02:59:47'),
(1000034, 'TORRES, JIK', 'Update', 'New%20loan%20adjustment%20to%20Loan%20ID:%20L10005%20of%20Client:%20ALDERITE%20ROSE%20ANN', '2018-04-09 03:00:49'),
(1000035, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10005%20of%20Client:%20ALDERITE%20ROSE%20ANN', '2018-04-09 03:01:54'),
(1000036, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10003:%20ALDERITE%20ROSE%20ANN', '2018-04-09 03:02:35'),
(1000037, 'TORRES, JIK', 'Update', 'New%20loan%20adjustment%20to%20Loan%20ID:%20L10006%20of%20Client:%20ALDERITE%20ROSE%20ANN', '2018-04-09 03:04:06'),
(1000038, 'TORRES, JIK', 'Add', 'New%20interest%20added%20to%20Loan%20ID:%20L10006%20of%20Client:%20ALDERITE%20ROSE%20ANN', '2018-04-09 03:05:09'),
(1000039, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10006%20of%20Client:%20ALDERITE%20ROSE%20ANN', '2018-04-09 03:05:46'),
(1000040, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10003:%20ALDERITE%20ROSE%20ANN', '2018-04-09 03:06:53'),
(1000041, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10007%20of%20Client:%20ALDERITE%20ROSE%20ANN', '2018-04-09 03:07:24'),
(1000042, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10007%20of%20Client:%20ALDERITE%20ROSE%20ANN', '2018-04-09 03:07:56'),
(1000043, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10003:%20ALDERITE%20ROSE%20ANN', '2018-04-09 03:09:22'),
(1000044, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10008%20of%20Client:%20ALDERITE%20ROSE%20ANN', '2018-04-09 03:09:45'),
(1000045, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10003:%20ALDERITE%20ROSE%20ANN', '2018-04-09 03:11:11'),
(1000046, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10009%20of%20Client:%20ALDERITE%20ROSE%20ANN', '2018-04-09 03:13:51'),
(1000047, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-04-09 16:38:43'),
(1000048, 'TORRES, JIK', 'Add', 'New%20client%20record%20added:%20ZABATE%20KAREN%20JANE', '2018-04-09 16:44:59'),
(1000049, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10004:%20ZABATE%20KAREN%20JANE', '2018-04-09 16:45:27'),
(1000050, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10010%20of%20Client:%20ZABATE%20KAREN%20JANE', '2018-04-09 16:45:54'),
(1000051, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10010%20of%20Client:%20ZABATE%20KAREN%20JANE', '2018-04-09 16:46:43'),
(1000052, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10004:%20ZABATE%20KAREN%20JANE', '2018-04-09 16:47:45'),
(1000053, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10011%20of%20Client:%20ZABATE%20KAREN%20JANE', '2018-04-09 16:48:19'),
(1000054, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10011%20of%20Client:%20ZABATE%20KAREN%20JANE', '2018-04-09 16:48:59'),
(1000055, 'TORRES, JIK', 'Add', 'New%20interest%20added%20to%20Loan%20ID:%20L10011%20of%20Client:%20ZABATE%20KAREN%20JANE', '2018-04-09 16:49:43'),
(1000056, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10011%20of%20Client:%20ZABATE%20KAREN%20JANE', '2018-04-09 16:50:06'),
(1000057, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10004:%20ZABATE%20KAREN%20JANE', '2018-04-09 16:50:59'),
(1000058, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10012%20of%20Client:%20ZABATE%20KAREN%20JANE', '2018-04-09 16:51:18'),
(1000059, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10012%20of%20Client:%20ZABATE%20KAREN%20JANE', '2018-04-09 16:51:33'),
(1000060, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10004:%20ZABATE%20KAREN%20JANE', '2018-04-09 16:52:58'),
(1000061, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10013%20of%20Client:%20ZABATE%20KAREN%20JANE', '2018-04-09 16:53:28'),
(1000062, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10013%20of%20Client:%20ZABATE%20KAREN%20JANE', '2018-04-09 16:53:45'),
(1000063, 'TORRES, JIK', 'Add', 'New%20interest%20added%20to%20Loan%20ID:%20L10013%20of%20Client:%20ZABATE%20KAREN%20JANE', '2018-04-09 16:54:06'),
(1000064, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10013%20of%20Client:%20ZABATE%20KAREN%20JANE', '2018-04-09 16:54:35'),
(1000065, 'TORRES, JIK', 'Add', 'New%20client%20record%20added:%20ABDULLAH%20FARHANA%20BINT', '2018-04-09 16:56:42'),
(1000066, 'TORRES, JIK', 'Update', 'Client%20updated%20C10005:%20ABDULLAH%20FARHANA%20BINT', '2018-04-09 16:58:38'),
(1000067, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10005:%20ABDULLAH%20FARHANA%20BINT', '2018-04-09 16:59:06'),
(1000068, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10014%20of%20Client:%20ABDULLAH%20FARHANA%20BINT', '2018-04-09 17:03:16'),
(1000069, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10014%20of%20Client:%20ABDULLAH%20FARHANA%20BINT', '2018-04-09 17:04:02'),
(1000070, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10005:%20ABDULLAH%20FARHANA%20BINT', '2018-04-09 17:05:22'),
(1000071, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10015%20of%20Client:%20ABDULLAH%20FARHANA%20BINT', '2018-04-09 17:05:54'),
(1000072, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10015%20of%20Client:%20ABDULLAH%20FARHANA%20BINT', '2018-04-09 17:06:17'),
(1000073, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10005:%20ABDULLAH%20FARHANA%20BINT', '2018-04-09 17:14:01'),
(1000074, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10016%20of%20Client:%20ABDULLAH%20FARHANA%20BINT', '2018-04-09 17:14:51'),
(1000075, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10005:%20ABDULLAH%20FARHANA%20BINT', '2018-04-09 17:16:09'),
(1000076, 'TORRES, JIK', 'Add', 'New%20client%20record%20added:%20ANGELES%20RUBY', '2018-04-09 18:05:50'),
(1000077, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10006:%20ANGELES%20RUBY', '2018-04-09 18:06:16'),
(1000078, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10018%20of%20Client:%20ANGELES%20RUBY', '2018-04-09 18:06:33'),
(1000079, 'TORRES, JIK', 'Add', 'New%20interest%20added%20to%20Loan%20ID:%20L10018%20of%20Client:%20ANGELES%20RUBY', '2018-04-09 18:07:05'),
(1000080, 'TORRES, JIK', 'Update', 'New%20loan%20adjustment%20to%20Loan%20ID:%20L10018%20of%20Client:%20ANGELES%20RUBY', '2018-04-09 18:07:46'),
(1000081, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10018%20of%20Client:%20ANGELES%20RUBY', '2018-04-09 18:08:00'),
(1000082, 'TORRES, JIK', 'Add', 'New%20client%20record%20added:%20ABUNDA%20ERIKA%20ANNE', '2018-04-09 18:21:50'),
(1000083, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10007:%20ABUNDA%20ERIKA%20ANNE', '2018-04-09 18:23:53'),
(1000084, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10019%20of%20Client:%20ABUNDA%20ERIKA%20ANNE', '2018-04-09 18:24:18'),
(1000085, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10019%20of%20Client:%20ABUNDA%20ERIKA%20ANNE', '2018-04-09 18:24:37'),
(1000086, 'TORRES, JIK', 'Add', 'New%20client%20record%20added:%20N', '2018-04-09 18:29:56'),
(1000087, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10008:%20N', '2018-04-09 18:30:48'),
(1000088, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10020%20of%20Client:%20N', '2018-04-09 18:32:24'),
(1000089, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10020%20of%20Client:%20N', '2018-04-09 18:32:38'),
(1000090, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10008:%20N', '2018-04-09 18:33:05'),
(1000091, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10021%20of%20Client:%20N', '2018-04-09 18:33:33'),
(1000092, 'TORRES, JIK', 'Add', 'New%20client%20record%20added:%20BAYANI%20ESNAYRA', '2018-04-09 18:37:37'),
(1000093, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10009:%20BAYANI%20ESNAYRA', '2018-04-09 18:38:07'),
(1000094, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10022%20of%20Client:%20BAYANI%20ESNAYRA', '2018-04-09 18:39:04'),
(1000095, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10022%20of%20Client:%20BAYANI%20ESNAYRA', '2018-04-09 18:39:20'),
(1000096, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10009:%20BAYANI%20ESNAYRA', '2018-04-09 18:40:40'),
(1000097, 'TORRES, JIK', 'Add', 'New%20client%20record%20added:%20CABANG%20REYSEL', '2018-04-09 18:44:46'),
(1000098, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10010:%20CABANG%20REYSEL', '2018-04-09 18:45:11'),
(1000099, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10024%20of%20Client:%20CABANG%20REYSEL', '2018-04-09 18:45:35'),
(1000100, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10024%20of%20Client:%20CABANG%20REYSEL', '2018-04-09 18:45:49'),
(1000101, 'TORRES, JIK', 'Add', 'New%20interest%20added%20to%20Loan%20ID:%20L10024%20of%20Client:%20CABANG%20REYSEL', '2018-04-09 18:46:22'),
(1000102, 'TORRES, JIK', 'Update', 'New%20loan%20adjustment%20to%20Loan%20ID:%20L10024%20of%20Client:%20CABANG%20REYSEL', '2018-04-09 18:46:55'),
(1000103, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10024%20of%20Client:%20CABANG%20REYSEL', '2018-04-09 18:47:20'),
(1000104, 'TORRES, JIK', 'Add', 'New%20client%20record%20added:%20CABANG%20RUSSEL', '2018-04-09 18:51:05'),
(1000105, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10011:%20CABANG%20RUSSEL', '2018-04-09 18:51:44'),
(1000106, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10025%20of%20Client:%20CABANG%20RUSSEL', '2018-04-09 18:52:07'),
(1000107, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10025%20of%20Client:%20CABANG%20RUSSEL', '2018-04-09 18:52:21'),
(1000108, 'TORRES, JIK', 'Update', 'Transaction%20updated%20T%20of%20Client:%20CABANG%20RUSSEL', '2018-04-09 21:03:58'),
(1000109, 'TORRES, JIK', 'Update', 'Transaction%20updated%20T%20of%20Client:%20CABANG%20RUSSEL', '2018-04-09 21:04:16'),
(1000110, 'TORRES, JIK', 'Update', 'Transaction%20updated%20T%20of%20Client:%20CABANG%20RUSSEL', '2018-04-09 21:04:44'),
(1000111, 'TORRES, JIK', 'Update', 'Transaction%20updated%20T%20of%20Client:%20CABANG%20RUSSEL', '2018-04-09 21:04:44'),
(1000112, 'TORRES, JIK', 'Update', 'Transaction%20updated%20T%20of%20Client:%20CABANG%20RUSSEL', '2018-04-09 21:04:44'),
(1000113, 'TORRES, JIK', 'Update', 'Transaction%20updated%20T%20of%20Client:%20CABANG%20RUSSEL', '2018-04-09 21:04:46'),
(1000114, 'TORRES, JIK', 'Update', 'Transaction%20updated%20T%20of%20Client:%20CABANG%20RUSSEL', '2018-04-09 21:05:46'),
(1000115, 'TORRES, JIK', 'Update', 'Transaction%20updated%20T%20of%20Client:%20CABANG%20RUSSEL', '2018-04-09 21:07:13'),
(1000116, 'TORRES, JIK', 'Update', 'Transaction%20updated%20T%20of%20Client:%20CABANG%20RUSSEL', '2018-04-09 21:07:25'),
(1000117, 'TORRES, JIK', 'Update', 'Transaction%20updated%20T%20of%20Client:%20CABANG%20RUSSEL', '2018-04-09 21:09:56'),
(1000118, 'TORRES, JIK', 'Update', 'Transaction%20updated%20T100074%20of%20Client:%20CABANG%20RUSSEL', '2018-04-09 21:15:16'),
(1000119, 'TORRES, JIK', 'Update', 'Transaction%20updated%20T100074%20of%20Client:%20CABANG%20RUSSEL', '2018-04-09 21:15:28'),
(1000120, 'TORRES, JIK', 'Update', 'Transaction%20updated%20T100074%20of%20Client:%20CABANG%20RUSSEL', '2018-04-09 21:16:16'),
(1000121, 'TORRES, JIK', 'Update', 'Transaction%20updated%20T100076%20of%20Client:%20CABANG%20RUSSEL', '2018-04-09 21:16:26'),
(1000122, 'TORRES, JIK', 'Update', 'Transaction%20updated%20T100076%20of%20Client:%20CABANG%20RUSSEL', '2018-04-09 21:16:34'),
(1000123, 'TORRES, JIK', 'Update', 'Transaction%20updated%20T100076%20of%20Client:%20CABANG%20RUSSEL', '2018-04-09 21:16:43'),
(1000124, 'TORRES, JIK', 'Update', 'Transaction%20updated%20T100076%20of%20Client:%20CABANG%20RUSSEL', '2018-04-09 21:16:53'),
(1000125, 'TORRES, JIK', 'Update', 'Loan%20updated%20to:%20C10001:%20ISRAEL%20LADY%20GRACE', '2018-04-09 21:33:48'),
(1000126, 'TORRES, JIK', 'Update', 'Loan%20updated%20to:%20C10001:%20ISRAEL%20LADY%20GRACE', '2018-04-09 21:34:04'),
(1000127, 'TORRES, JIK', 'Update', 'Loan%20updated%20to:%20C10001:%20ISRAEL%20LADY%20GRACE', '2018-04-09 21:34:14'),
(1000128, 'TORRES, JIK', 'Update', 'Loan%20updated%20to:%20C10001:%20ISRAEL%20LADY%20GRACE', '2018-04-09 21:34:39'),
(1000129, 'TORRES, JIK', 'Update', 'Loan%20updated%20to:%20C10001:%20ISRAEL%20LADY%20GRACE', '2018-04-09 21:36:27'),
(1000130, 'TORRES, JIK', 'Update', 'Loan%20updated%20to:%20C10001:%20ISRAEL%20LADY%20GRACE', '2018-04-09 21:36:36'),
(1000131, 'TORRES, JIK', 'Update', 'Transaction%20updated%20T100006%20of%20Client:%20ISRAEL%20LADY%20GRACE', '2018-04-09 21:40:20'),
(1000132, 'TORRES, JIK', 'Update', 'Transaction%20updated%20T100001%20of%20Client:%20ISRAEL%20LADY%20GRACE', '2018-04-09 21:41:09'),
(1000133, 'TORRES, JIK', 'Update', 'Transaction%20updated%20T100002%20of%20Client:%20ISRAEL%20LADY%20GRACE', '2018-04-09 21:44:36'),
(1000134, 'TORRES, JIK', 'Update', 'Transaction%20updated%20T100003%20of%20Client:%20ISRAEL%20LADY%20GRACE', '2018-04-09 21:44:49'),
(1000135, 'TORRES, JIK', 'Update', 'Transaction%20updated%20T100004%20of%20Client:%20ISRAEL%20LADY%20GRACE', '2018-04-09 21:45:00'),
(1000136, 'TORRES, JIK', 'Update', 'Transaction%20updated%20T100005%20of%20Client:%20ISRAEL%20LADY%20GRACE', '2018-04-09 21:45:10'),
(1000137, 'TORRES, JIK', 'Update', 'Loan%20updated%20to:%20C10001:%20ISRAEL%20LADY%20GRACE', '2018-04-09 21:45:37'),
(1000138, 'TORRES, JIK', 'Update', 'Loan%20updated%20to:%20C10001:%20ISRAEL%20LADY%20GRACE', '2018-04-09 21:46:44'),
(1000139, 'TORRES, JIK', 'Update', 'Transaction%20updated%20T100007%20of%20Client:%20ISRAEL%20LADY%20GRACE', '2018-04-09 21:47:05'),
(1000140, 'TORRES, JIK', 'Update', 'Transaction%20updated%20T100005%20of%20Client:%20ISRAEL%20LADY%20GRACE', '2018-04-09 21:58:59'),
(1000141, 'TORRES, JIK', 'Update', 'Transaction%20updated%20T100005%20of%20Client:%20ISRAEL%20LADY%20GRACE', '2018-04-09 21:59:39'),
(1000142, 'TORRES, JIK', 'Update', 'Transaction%20updated%20T100025%20of%20Client:%20ALDERITE%20ROSE%20ANN', '2018-04-09 22:00:53'),
(1000143, 'TORRES, JIK', 'Update', 'Transaction%20updated%20T100025%20of%20Client:%20ALDERITE%20ROSE%20ANN', '2018-04-09 22:01:15'),
(1000144, 'TORRES, JIK', 'Update', 'Loan%20updated%20to:%20C10003:%20ALDERITE%20ROSE%20ANN', '2018-04-09 22:03:26'),
(1000145, 'TORRES, JIK', 'Update', 'Transaction%20updated%20T100021%20of%20Client:%20ALDERITE%20ROSE%20ANN', '2018-04-09 22:05:41'),
(1000146, 'TORRES, JIK', 'Update', 'Loan%20updated%20to:%20C10003:%20ALDERITE%20ROSE%20ANN', '2018-04-09 22:07:09'),
(1000147, 'TORRES, JIK', 'Update', 'Loan%20updated%20to:%20C10003:%20ALDERITE%20ROSE%20ANN', '2018-04-09 22:09:17'),
(1000148, 'TORRES, JIK', 'Update', 'Loan%20updated%20to:%20C10003:%20ALDERITE%20ROSE%20ANN', '2018-04-09 22:09:50'),
(1000149, 'TORRES, JIK', 'Update', 'Client%20updated%20C10009:%20BAYANI%20ESNEYRA', '2018-04-09 22:52:04'),
(1000150, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-04-10 19:33:42'),
(1000151, 'TORRES, JIK', 'Logout', 'System user logout as Administrator', '2018-04-10 19:33:48'),
(1000152, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-04-10 19:34:14'),
(1000153, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-04-12 01:30:05'),
(1000154, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10023%20of%20Client:%20BAYANI%20ESNEYRA', '2018-04-12 02:11:31'),
(1000155, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-04-12 22:08:56'),
(1000156, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10024%20of%20Client:%20CABANG%20REYSEL', '2018-04-12 22:13:29'),
(1000157, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10010:%20CABANG%20REYSEL', '2018-04-12 22:18:17'),
(1000158, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-04-13 22:01:34'),
(1000159, 'TORRES, JIK', 'Add', 'New%20schedule%20added:%20VXI%20-%20SM%20Ecoland%20Payday', '2018-04-14 01:33:28'),
(1000160, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-04-14 21:43:53'),
(1000161, 'TORRES, JIK', 'Update', 'Capital%20adjustment%20updated%20P1', '2018-04-15 02:53:03'),
(1000162, 'TORRES, JIK', 'Update', 'Capital%20adjustment%20updated%20P4', '2018-04-15 02:54:16'),
(1000163, 'TORRES, JIK', 'Update', 'Capital%20adjustment%20updated%20P4', '2018-04-15 02:54:30'),
(1000164, 'TORRES, JIK', 'Update', 'Capital%20adjustment%20updated%20P4', '2018-04-15 02:54:40'),
(1000165, 'TORRES, JIK', 'Update', 'Capital%20adjustment%20updated%20P4', '2018-04-15 02:54:50'),
(1000166, 'TORRES, JIK', 'Update', 'New%20capital%20adjustment', '2018-04-15 02:55:16'),
(1000167, 'TORRES, JIK', 'Update', 'New%20capital%20adjustment', '2018-04-15 02:56:37'),
(1000168, 'TORRES, JIK', 'Delete', 'User%20record%20deleted', '2018-04-15 02:58:45'),
(1000169, 'TORRES, JIK', 'Delete', 'User%20record%20deleted', '2018-04-15 02:58:49'),
(1000170, 'TORRES, JIK', 'Update', 'New%20capital%20adjustment', '2018-04-15 03:00:47'),
(1000171, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-04-15 16:11:15'),
(1000172, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-04-16 16:58:33'),
(1000173, 'TORRES, JIK', 'Add', 'New%20client%20record%20added:%20Torres%20Jessa%20Mae', '2018-04-16 18:13:07'),
(1000174, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10012:%20Torres%20Jessa%20Mae', '2018-04-16 18:27:32'),
(1000175, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-04-16 22:23:29'),
(1000176, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-04-16 23:40:52'),
(1000177, 'TORRES, JIK', 'Update', 'Client%20updated%20C10012:%20TORRES%20JESSA%20MAEs', '2018-04-16 23:58:42'),
(1000178, 'TORRES, JIK', 'Update', 'Client%20updated%20C10012:%20TORRES%20JESSA%20MAE', '2018-04-16 23:58:51'),
(1000179, 'TORRES, JIK', 'Logout', 'System user logout as Administrator', '2018-04-17 01:28:59'),
(1000180, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-04-17 17:37:50'),
(1000181, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-04-18 01:22:21'),
(1000182, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-04-19 16:36:00'),
(1000183, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-04-20 00:07:43'),
(1000184, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10026%20of%20Client:%20CABANG%20REYSEL', '2018-04-20 00:37:29'),
(1000185, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10013%20of%20Client:%20ZABATE%20KAREN%20JANE', '2018-04-20 00:39:39'),
(1000186, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10009%20of%20Client:%20ALDERITE%20ROSE%20ANN', '2018-04-20 00:42:29'),
(1000187, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10009:%20BAYANI%20ESNEYRA', '2018-04-20 00:46:40'),
(1000188, 'TORRES, JIK', 'Add', 'New%20client%20record%20added:%20BIWANG%20JUHAIRY', '2018-04-20 01:09:33'),
(1000189, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10013:%20BIWANG%20JUHAIRY', '2018-04-20 01:10:44'),
(1000190, 'TORRES, JIK', 'Add', 'New%20schedule%20added:%20VXI%20-%20SM%20Ecoland%20Payday', '2018-04-20 02:02:55'),
(1000191, 'TORRES, JIK', 'Update', 'Schedule%20updated%20S2:%20VXI%20-%20SM%20Ecoland%20Payday', '2018-04-20 02:03:21'),
(1000192, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-04-20 14:54:41'),
(1000193, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-04-20 17:09:51'),
(1000194, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-04-25 19:22:12'),
(1000195, 'TORRES, JIK', 'Add', 'New%20schedule%20added:%20Karen%20and%20Juh%20loan', '2018-04-25 19:23:55'),
(1000196, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-04-25 22:40:51'),
(1000197, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10023%20of%20Client:%20BAYANI%20ESNEYRA', '2018-04-25 22:41:45'),
(1000198, 'TORRES, JIK', 'Add', 'New%20interest%20added%20to%20Loan%20ID:%20L10023%20of%20Client:%20BAYANI%20ESNEYRA', '2018-04-25 22:43:30'),
(1000199, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-04-27 00:57:33'),
(1000200, 'TORRES, JIK', 'Update', 'New%20loan%20adjustment%20to%20Loan%20ID:%20L10027%20of%20Client:%20TORRES%20JESSA%20MAE', '2018-04-27 01:32:34'),
(1000201, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10004:%20ZABATE%20KAREN%20JANE', '2018-04-27 01:33:58'),
(1000202, 'TORRES, JIK', 'Add', 'New%20interest%20added%20to%20Loan%20ID:%20L10017%20of%20Client:%20ABDULLAH%20FARHANA%20BINT', '2018-04-27 01:36:50'),
(1000203, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10029%20of%20Client:%20BIWANG%20JUHAIRY', '2018-04-27 01:39:08'),
(1000204, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10013:%20BIWANG%20JUHAIRY', '2018-04-27 01:40:10'),
(1000205, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-04-27 14:52:27'),
(1000206, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-04-27 17:41:13'),
(1000207, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-04-28 01:35:50'),
(1000208, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-01 10:18:15'),
(1000209, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10027%20of%20Client:%20TORRES%20JESSA%20MAE', '2018-05-01 10:19:19'),
(1000210, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-01 22:09:28'),
(1000211, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-02 22:44:21'),
(1000212, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-03 22:46:01'),
(1000213, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10030%20of%20Client:%20ZABATE%20KAREN%20JANE', '2018-05-03 22:54:27'),
(1000214, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10031%20of%20Client:%20BIWANG%20JUHAIRY', '2018-05-03 23:00:19'),
(1000215, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10026%20of%20Client:%20CABANG%20REYSEL', '2018-05-03 23:07:25'),
(1000216, 'TORRES, JIK', 'Update', 'New%20loan%20adjustment%20to%20Loan%20ID:%20L10009%20of%20Client:%20ALDERITE%20ROSE%20ANN', '2018-05-03 23:15:51'),
(1000217, 'TORRES, JIK', 'Update', 'Transaction%20updated%20T100097%20of%20Client:%20ALDERITE%20ROSE%20ANN', '2018-05-03 23:16:36'),
(1000218, 'TORRES, JIK', 'Add', 'New%20interest%20added%20to%20Loan%20ID:%20L10009%20of%20Client:%20ALDERITE%20ROSE%20ANN', '2018-05-03 23:17:26'),
(1000219, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-05 22:21:08'),
(1000220, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-08 10:02:16'),
(1000221, 'TORRES, JIK', 'Add', 'New%20schedule%20added:%20Bint%20partial%20payment', '2018-05-08 10:11:09'),
(1000222, 'TORRES, JIK', 'Add', 'New%20schedule%20added:%20VXI%20-%20SM%20Ecoland%20Payday', '2018-05-08 10:12:12'),
(1000223, 'TORRES, JIK', 'Add', 'New%20schedule%20added:%20Yanny%20payment', '2018-05-08 10:15:22'),
(1000224, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-08 17:21:52'),
(1000225, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-09 09:00:34'),
(1000226, 'TORRES, JIK', 'Logout', 'System user logout as Administrator', '2018-05-09 10:57:51'),
(1000227, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-09 11:51:17'),
(1000228, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-10 09:06:00'),
(1000229, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-10 16:45:56'),
(1000230, 'Lastdmin, Admin', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10028%20of%20Client:%20BAYANI%20ESNEYRA', '2018-05-10 17:34:48'),
(1000231, 'Lastdmin, Admin', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10023%20of%20Client:%20BAYANI%20ESNEYRA', '2018-05-10 17:35:46'),
(1000232, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-11 09:10:13'),
(1000233, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-11 23:22:34'),
(1000234, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10017%20of%20Client:%20ABDULLAH%20FARHANA%20BINT', '2018-05-11 23:23:29'),
(1000235, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10005:%20ABDULLAH%20FARHANA%20BINT', '2018-05-11 23:24:11'),
(1000236, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-12 10:20:54'),
(1000237, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10007:%20ABUNDA%20ERIKA%20ANNE', '2018-05-12 10:21:53'),
(1000238, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-12 10:46:45'),
(1000239, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-14 01:31:10'),
(1000240, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10026%20of%20Client:%20CABANG%20REYSEL', '2018-05-14 01:40:59'),
(1000241, 'TORRES, JIK', 'Add', 'New%20client%20record%20added:%20Diendo%20Sherlyn', '2018-05-14 01:43:20'),
(1000242, 'TORRES, JIK', 'Update', 'Client%20updated%20C10014:%20DIENDOS%20SHERLYN', '2018-05-14 01:45:19'),
(1000243, 'TORRES, JIK', 'Update', 'Client%20updated%20C10014:%20DIENDO%20SHERLYN', '2018-05-14 01:45:24'),
(1000244, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10014:%20DIENDO%20SHERLYN', '2018-05-14 01:46:21'),
(1000245, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-15 20:27:25'),
(1000246, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-16 21:36:43'),
(1000247, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10009:%20BAYANI%20ESNEYRA', '2018-05-16 21:54:01'),
(1000248, 'TORRES, JIK', 'Update', 'Schedule%20updated%20S6:%20IBEX%20pay%20day', '2018-05-16 22:51:42'),
(1000249, 'TORRES, JIK', 'Update', 'Schedule%20updated%20S5:%20VXI%20-%20SM%20Ecoland%20Payday', '2018-05-16 22:53:54'),
(1000250, 'TORRES, JIK', 'Update', 'Schedule%20updated%20S6:%20IBEX%20pay%20day', '2018-05-16 22:54:03'),
(1000251, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-17 09:28:17'),
(1000252, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-17 09:58:27'),
(1000253, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-17 12:26:24'),
(1000254, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-17 20:43:40'),
(1000255, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-17 20:47:46'),
(1000256, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10031%20of%20Client:%20BIWANG%20JUHAIRY', '2018-05-17 20:48:52'),
(1000257, 'TORRES, JIK', 'Add', 'New%20interest%20added%20to%20Loan%20ID:%20L10031%20of%20Client:%20BIWANG%20JUHAIRY', '2018-05-17 20:52:52'),
(1000258, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10030%20of%20Client:%20ZABATE%20KAREN%20JANE', '2018-05-17 20:58:51'),
(1000259, 'TORRES, JIK', 'Add', 'New%20interest%20added%20to%20Loan%20ID:%20L10030%20of%20Client:%20ZABATE%20KAREN%20JANE', '2018-05-17 20:59:24'),
(1000260, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10009%20of%20Client:%20ALDERITE%20ROSE%20ANN', '2018-05-17 21:06:41'),
(1000261, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10003:%20ALDERITE%20ROSE%20ANN', '2018-05-17 21:09:02'),
(1000262, 'TORRES, JIK', 'Update', 'Client%20updated%20C10009:%20BAYANI%20ESNEYRA', '2018-05-17 21:29:03'),
(1000263, 'TORRES, JIK', 'Add', 'New%20schedule%20added:%20VXI%20-%20SM%20Ecoland%20Payday', '2018-05-17 21:31:27'),
(1000264, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-18 09:21:02'),
(1000265, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10034%20of%20Client:%20DIENDO%20SHERLYN', '2018-05-18 09:36:22'),
(1000266, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-18 22:54:23'),
(1000267, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-20 21:19:44'),
(1000268, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10033%20of%20Client:%20ABUNDA%20ERIKA%20ANNE', '2018-05-20 21:20:50'),
(1000269, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-21 08:56:37'),
(1000270, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-21 15:41:38'),
(1000271, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-21 22:01:44'),
(1000272, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-22 11:12:22'),
(1000273, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-22 11:13:16'),
(1000274, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-22 11:26:29'),
(1000275, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-22 21:59:40'),
(1000276, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-22 22:20:42'),
(1000277, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-22 22:22:20'),
(1000278, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-23 09:21:03'),
(1000279, 'TORRES, JIK', 'Add', 'New%20schedule%20added:%20IBEX%20pay%20day', '2018-05-23 09:25:10'),
(1000280, 'TORRES, JIK', 'Logout', 'System user logout as Administrator', '2018-05-23 09:28:46'),
(1000281, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-23 09:29:03'),
(1000282, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-23 14:31:16'),
(1000283, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-23 22:02:43'),
(1000284, 'TORRES, JIK', 'Add', 'New%20ATM%20bank%20added:%20Union%20Bank%20of%20the%20Philippines', '2018-05-23 22:19:31'),
(1000285, 'TORRES, JIK', 'Add', 'New%20ATM%20bank%20added:%20Philippine%20National%20Bank', '2018-05-23 22:23:40'),
(1000286, 'TORRES, JIK', 'Add', 'New%20client%20record%20added:%20Chavez%20Jomar', '2018-05-23 22:27:14'),
(1000287, 'TORRES, JIK', 'Update', 'Client%20updated%20C10015:%20Chavez%20Jomar', '2018-05-23 22:35:55'),
(1000288, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10015:%20Chavez%20Jomar', '2018-05-23 23:21:16'),
(1000289, 'TORRES, JIK', 'Update', 'Client%20updated%20C10015:%20CHAVEZZ%20JOMAR', '2018-05-23 23:30:13'),
(1000290, 'TORRES, JIK', 'Update', 'Client%20updated%20C10015:%20CHAVEZ%20JOMAR', '2018-05-23 23:30:20'),
(1000291, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-24 09:25:08'),
(1000292, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-24 21:53:05'),
(1000293, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-25 10:47:23'),
(1000294, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-25 21:30:13'),
(1000295, 'TORRES, JIK', 'Update', 'ATM%20Bank%20updated%20A105:%20Philippine%20National%20Bank%20to%20Philippine%20National%20Bank', '2018-05-25 21:37:50'),
(1000296, 'TORRES, JIK', 'Update', 'ATM%20Bank%20updated%20A105:%20Philippine%20National%20Bank%20to%20Philippine%20National%20Bank', '2018-05-25 21:38:12'),
(1000297, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10032%20of%20Client:%20ABDULLAH%20FARHANA%20BINT', '2018-05-25 21:55:32'),
(1000298, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10035%20of%20Client:%20BAYANI%20ESNEYRA', '2018-05-25 21:59:10'),
(1000299, 'TORRES, JIK', 'Add', 'New%20schedule%20added:%20Jomar%20Chavez%20pension%20day', '2018-05-25 22:05:26'),
(1000300, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10008:%20N', '2018-05-25 22:06:16'),
(1000301, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-28 10:11:27'),
(1000302, 'TORRES, JIK', 'Update', 'Client%20updated%20C10008:%20GESTA%20JOEY%20MICHAEL', '2018-05-28 17:27:25'),
(1000303, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-29 09:14:13'),
(1000304, 'TORRES, JIK', 'Add', 'New%20client%20record%20added:%20PRESENTE%20JAYRRAH%20PRAISE%20A.', '2018-05-29 12:03:39'),
(1000305, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-29 20:40:22'),
(1000306, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10016:%20PRESENTE%20JAYRRAH%20PRAISE%20A.', '2018-05-29 21:10:13'),
(1000307, 'TORRES, JIK', 'Update', 'New%20capital%20adjustment', '2018-05-29 21:40:04'),
(1000308, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-30 09:37:43'),
(1000309, 'TORRES, JIK', 'Update', 'Client%20updated%20C10008:%20GESTA%20JOEY%20MICHAEL', '2018-05-30 13:17:05'),
(1000310, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-31 09:07:27'),
(1000311, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-05-31 22:07:00'),
(1000312, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10036%20of%20Client:%20ALDERITE%20ROSE%20ANN', '2018-05-31 22:37:59'),
(1000313, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10030%20of%20Client:%20ZABATE%20KAREN%20JANE', '2018-05-31 22:39:17'),
(1000314, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10033%20of%20Client:%20ABUNDA%20ERIKA%20ANNE', '2018-05-31 22:40:32'),
(1000315, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10038%20of%20Client:%20GESTA%20JOEY%20MICHAEL', '2018-05-31 22:46:33'),
(1000316, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10031%20of%20Client:%20BIWANG%20JUHAIRY', '2018-05-31 22:59:47'),
(1000317, 'TORRES, JIK', 'Add', 'New%20loan%20added%20to:%20C10013:%20BIWANG%20JUHAIRY', '2018-05-31 23:03:13'),
(1000318, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-06-01 09:03:30'),
(1000319, 'TORRES, JIK', 'Update', 'New%20loan%20adjustment%20to%20Loan%20ID:%20L10036%20of%20Client:%20ALDERITE%20ROSE%20ANN', '2018-06-01 09:13:37'),
(1000320, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-06-03 22:01:47'),
(1000321, 'TORRES, JIK', 'Add', 'New%20schedule%20added:%20VXI%20-%20SM%20Ecoland%20Payday', '2018-06-03 22:05:02'),
(1000322, 'TORRES, JIK', 'Update', 'Schedule%20updated%20S8:%20IBEX%20pay%20day', '2018-06-03 22:06:22'),
(1000323, 'TORRES, JIK', 'Update', 'New%20capital%20adjustment', '2018-06-03 22:17:01'),
(1000324, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-06-04 09:38:10'),
(1000325, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-06-04 22:09:59'),
(1000326, 'TORRES, JIK', 'Update', 'Client%20updated%20C10005:%20ABDULLAH%20FARHANA%20BINT', '2018-06-04 22:18:54'),
(1000327, 'TORRES, JIK', 'Login', 'System user login as Administrator', '2018-06-05 20:14:58'),
(1000328, 'TORRES, JIK', 'Add', 'New%20payment%20added%20to%20Loan%20ID:%20L10037%20of%20Client:%20CHAVEZ%20JOMAR', '2018-06-05 20:19:33');

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
  `encoded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`sched_id`, `title`, `date`, `time`, `remarks`, `username`, `encoded`) VALUES
(1, 'VXI - SM Ecoland Payday', '2018-04-19', '18:00', 'Reysel Cabang, Rose Alderite, Karen Zabate, Jawee', 'um_developer', '2018-04-14 01:33:27'),
(2, 'VXI - SM Ecoland Payday', '2018-05-03', '18:00', 'Reysel Cabang, Rose Alderite, Karen Zabate, Juhairy - SM Eco Meetup', 'um_developer', '2018-04-20 02:02:55'),
(3, 'Karen and Juh loan', '2018-04-26', '6-7pm', 'loan 10000 each', 'um_developer', '2018-04-25 19:23:55'),
(4, 'Bint partial payment', '2018-05-10', '12:00', 'Half amount payment', 'um_developer', '2018-05-08 10:11:08'),
(5, 'VXI - SM Ecoland Payday', '2018-05-17', '6:00', 'Sherlyn, Erika, Rose, Karen, Juh payments', 'um_developer', '2018-05-08 10:12:12'),
(6, 'IBEX pay day', '2018-05-25', '12:00', 'Yanny, Bint', 'um_developer', '2018-05-08 10:15:21'),
(7, 'VXI - SM Ecoland Payday', '2018-05-31', '18:00', 'Rose, Karen, Juh payments', 'um_developer', '2018-05-17 21:31:27'),
(8, 'IBEX pay day', '2018-06-11', '18:00', 'Bint, Yanny, Jayrrah', 'um_developer', '2018-05-23 09:25:09'),
(9, 'Jomar Chavez pension day', '2018-06-05', '18:00', 'Jomar Chavez payment. PNB ADDU Jacinto bank', 'um_developer', '2018-05-25 22:05:25'),
(10, 'VXI - SM Ecoland Payday', '2018-06-14', '18:00', 'Karen, Rose, Juh, Joey', 'um_developer', '2018-06-03 22:05:02');

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
  `encoded` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`trans_id`, `loan_id`, `date`, `type`, `amount`, `interest`, `total`, `remarks`, `encoded`) VALUES
(100001, 10001, '2017-09-28', 1, '5000.00', '250.00', '5250.00', '1st lending transaction', '2018-04-09 01:19:07'),
(100002, 10001, '2017-10-24', 2, '-3000.00', '0.00', '2250.00', '', '2018-04-09 01:19:53'),
(100003, 10001, '2017-10-28', 4, '0.00', '250.00', '2500.00', '', '2018-04-09 01:21:54'),
(100004, 10001, '2017-11-21', 5, '500.00', '0.00', '3000.00', '', '2018-04-09 01:23:58'),
(100005, 10001, '2017-11-27', 3, '-3000.00', '0.00', '0.00', '', '2018-04-09 01:25:23'),
(100006, 10002, '2017-12-08', 1, '5000.00', '250.00', '5250.00', '121', '2018-04-09 01:27:15'),
(100007, 10002, '2018-01-06', 3, '-5250.00', '0.00', '0.00', '', '2018-04-09 01:28:24'),
(100008, 10003, '2017-10-27', 1, '2500.00', '125.00', '2625.00', '', '2018-04-09 02:22:06'),
(100009, 10003, '2017-11-24', 3, '-2625.00', '0.00', '0.00', '', '2018-04-09 02:51:28'),
(100010, 10004, '2017-11-14', 1, '2000.00', '140.00', '2140.00', '', '2018-04-09 02:58:11'),
(100011, 10004, '2017-11-17', 3, '-2140.00', '0.00', '0.00', '', '2018-04-09 02:58:55'),
(100012, 10005, '2017-11-21', 1, '2000.00', '140.00', '2140.00', '', '2018-04-09 02:59:46'),
(100013, 10005, '2017-11-24', 5, '2000.00', '0.00', '4140.00', 'Additional loan 2000', '2018-04-09 03:00:49'),
(100014, 10005, '2017-11-30', 3, '-4140.00', '0.00', '0.00', '', '2018-04-09 03:01:54'),
(100015, 10006, '2017-12-15', 1, '3000.00', '210.00', '3210.00', '', '2018-04-09 03:02:34'),
(100016, 10006, '2017-12-19', 5, '2000.00', '0.00', '5210.00', 'Additional loan 2000', '2018-04-09 03:04:06'),
(100017, 10006, '2017-12-19', 4, '0.00', '140.00', '5350.00', 'Additional interest due to added loan 2000', '2018-04-09 03:05:08'),
(100018, 10006, '2017-12-29', 3, '-5350.00', '0.00', '0.00', '', '2018-04-09 03:05:45'),
(100019, 10007, '2018-02-15', 1, '5000.00', '350.00', '5350.00', '', '2018-04-09 03:06:52'),
(100020, 10007, '2018-02-22', 2, '-1500.00', '0.00', '3850.00', '', '2018-04-09 03:07:23'),
(100021, 10007, '2018-03-08', 3, '-3850.00', '0.00', '0.00', '', '2018-04-09 03:07:56'),
(100022, 10008, '2018-03-08', 1, '7000.00', '490.00', '7490.00', '', '2018-04-09 03:09:22'),
(100023, 10008, '2018-03-22', 3, '-7490.00', '0.00', '0.00', '', '2018-04-09 03:09:45'),
(100024, 10009, '2018-03-22', 1, '10000.00', '700.00', '10700.00', '', '2018-04-09 03:11:11'),
(100025, 10009, '2018-04-06', 2, '-2000.00', '0.00', '8700.00', 'Next payment is May 3, 2018', '2018-04-09 03:13:50'),
(100026, 10010, '2017-11-17', 1, '3000.00', '210.00', '3210.00', '', '2018-04-09 16:45:26'),
(100027, 10010, '2017-11-30', 2, '-1600.00', '0.00', '1610.00', '', '2018-04-09 16:45:54'),
(100028, 10010, '2017-11-08', 3, '-1610.00', '0.00', '0.00', '', '2018-04-09 16:46:43'),
(100029, 10011, '2017-12-23', 1, '5000.00', '350.00', '5350.00', '', '2018-04-09 16:47:45'),
(100030, 10011, '2017-12-29', 2, '-1800.00', '0.00', '3550.00', '', '2018-04-09 16:48:19'),
(100031, 10011, '2018-01-12', 2, '-1800.00', '0.00', '1750.00', '', '2018-04-09 16:48:58'),
(100032, 10011, '2018-01-23', 4, '0.00', '120.00', '1870.00', '', '2018-04-09 16:49:43'),
(100033, 10011, '2018-01-25', 3, '-1870.00', '0.00', '0.00', '', '2018-04-09 16:50:06'),
(100034, 10012, '2018-01-31', 1, '5000.00', '350.00', '5350.00', '', '2018-04-09 16:50:59'),
(100035, 10012, '2018-02-08', 2, '-2650.00', '0.00', '2700.00', '', '2018-04-09 16:51:18'),
(100036, 10012, '2018-02-22', 3, '-2700.00', '0.00', '0.00', '', '2018-04-09 16:51:33'),
(100037, 10013, '2018-02-28', 1, '10000.00', '700.00', '10700.00', '', '2018-04-09 16:52:58'),
(100038, 10013, '2018-03-08', 2, '-2850.00', '0.00', '7850.00', '', '2018-04-09 16:53:28'),
(100039, 10013, '2018-03-22', 2, '-2850.00', '0.00', '5000.00', '', '2018-04-09 16:53:45'),
(100040, 10013, '2018-03-28', 4, '0.00', '350.00', '5350.00', '', '2018-04-09 16:54:05'),
(100041, 10013, '2018-04-05', 2, '-2850.00', '0.00', '2500.00', '', '2018-04-09 16:54:35'),
(100042, 10014, '2017-12-04', 1, '2000.00', '140.00', '2140.00', '', '2018-04-09 16:59:05'),
(100043, 10014, '2017-12-08', 2, '-1000.00', '0.00', '1140.00', '', '2018-04-09 17:03:16'),
(100044, 10014, '2018-01-04', 3, '-1140.00', '0.00', '0.00', '', '2018-04-09 17:04:02'),
(100045, 10015, '2018-01-21', 1, '3000.00', '210.00', '3210.00', '', '2018-04-09 17:05:21'),
(100046, 10015, '2018-01-21', 2, '-1500.00', '0.00', '1710.00', '', '2018-04-09 17:05:54'),
(100047, 10015, '2018-02-20', 3, '-1710.00', '0.00', '0.00', '', '2018-04-09 17:06:16'),
(100048, 10016, '2018-03-04', 1, '3000.00', '210.00', '3210.00', '', '2018-04-09 17:14:01'),
(100049, 10016, '2018-03-28', 3, '-3210.00', '0.00', '0.00', '', '2018-04-09 17:14:50'),
(100050, 10017, '2018-03-28', 1, '5000.00', '350.00', '5350.00', '', '2018-04-09 17:16:09'),
(100051, 10018, '2017-12-23', 1, '5000.00', '350.00', '5350.00', '', '2018-04-09 18:06:15'),
(100052, 10018, '2018-01-12', 2, '-2700.00', '0.00', '2650.00', '', '2018-04-09 18:06:33'),
(100053, 10018, '2018-01-24', 4, '0.00', '185.00', '2835.00', '', '2018-04-09 18:07:04'),
(100054, 10018, '2018-01-25', 6, '-5.00', '0.00', '2830.00', '', '2018-04-09 18:07:45'),
(100055, 10018, '2018-01-25', 3, '-2830.00', '0.00', '0.00', '', '2018-04-09 18:08:00'),
(100056, 10019, '2018-02-01', 1, '3000.00', '210.00', '3210.00', '', '2018-04-09 18:23:53'),
(100057, 10019, '2018-02-15', 2, '-1500.00', '0.00', '1710.00', '', '2018-04-09 18:24:18'),
(100058, 10019, '2018-02-23', 3, '-1710.00', '0.00', '0.00', '', '2018-04-09 18:24:37'),
(100059, 10020, '2018-02-20', 1, '2000.00', '140.00', '2140.00', '', '2018-04-09 18:30:48'),
(100060, 10020, '2018-02-23', 2, '-1000.00', '0.00', '1140.00', '', '2018-04-09 18:32:24'),
(100061, 10020, '2018-03-09', 3, '-1140.00', '0.00', '0.00', '', '2018-04-09 18:32:37'),
(100062, 10021, '2018-03-13', 1, '1000.00', '70.00', '1070.00', '', '2018-04-09 18:33:04'),
(100063, 10021, '2018-03-22', 3, '-1070.00', '0.00', '0.00', '', '2018-04-09 18:33:33'),
(100064, 10022, '2018-02-26', 1, '2000.00', '140.00', '2140.00', '', '2018-04-09 18:38:07'),
(100065, 10022, '2018-03-11', 2, '-1070.00', '0.00', '1070.00', '', '2018-04-09 18:39:04'),
(100066, 10022, '2018-03-23', 3, '-1070.00', '0.00', '0.00', '', '2018-04-09 18:39:19'),
(100067, 10023, '2018-03-23', 1, '5000.00', '350.00', '5350.00', '', '2018-04-09 18:40:40'),
(100068, 10024, '2018-03-03', 1, '5000.00', '350.00', '5350.00', '', '2018-04-09 18:45:11'),
(100069, 10024, '2018-03-09', 2, '-1500.00', '0.00', '3850.00', '', '2018-04-09 18:45:34'),
(100070, 10024, '2018-03-22', 2, '-1500.00', '0.00', '2350.00', '', '2018-04-09 18:45:49'),
(100071, 10024, '2018-04-03', 4, '0.00', '160.00', '2510.00', '', '2018-04-09 18:46:22'),
(100072, 10024, '2018-04-03', 6, '-10.00', '0.00', '2500.00', '', '2018-04-09 18:46:55'),
(100073, 10024, '2018-04-05', 2, '-1250.00', '0.00', '1250.00', '', '2018-04-09 18:47:19'),
(100074, 10025, '2018-03-13', 1, '5000.00', '350.00', '5350.00', '', '2018-04-09 18:51:44'),
(100075, 10025, '2018-03-22', 2, '-1500.00', '0.00', '3850.00', '', '2018-04-09 18:52:07'),
(100076, 10025, '2018-03-28', 3, '-3850.00', '0.00', '0.00', '', '2018-04-09 18:52:21'),
(100077, 10023, '2018-04-11', 2, '-2500.00', '0.00', '2850.00', '', '2018-04-12 02:11:24'),
(100078, 10024, '2018-04-12', 3, '-1250.00', '0.00', '0.00', 'full payment to renew another 5000 loan', '2018-04-12 22:13:28'),
(100079, 10026, '2018-04-12', 1, '5000.00', '350.00', '5350.00', '', '2018-04-12 22:18:17'),
(100080, 10027, '2018-04-16', 1, '1000.00', '0.00', '1000.00', 'No interest since family member', '2018-04-16 18:27:31'),
(100081, 10026, '2018-04-19', 2, '-1500.00', '0.00', '3850.00', '', '2018-04-20 00:37:28'),
(100082, 10013, '2018-04-19', 3, '-2500.00', '0.00', '0.00', '', '2018-04-20 00:39:38'),
(100083, 10009, '2018-04-19', 2, '-6300.00', '0.00', '2400.00', 'Next payment is May 17. Add int for remaining', '2018-04-20 00:42:29'),
(100084, 10028, '2018-04-20', 1, '1000.00', '70.00', '1070.00', 'Additional loan posted as new transaction. la', '2018-04-20 00:46:40'),
(100085, 10029, '2018-04-19', 1, '5000.00', '350.00', '5350.00', '1st loan. Meet up at  BDO SM Eco Annex', '2018-04-20 01:10:44'),
(100086, 10023, '2018-04-25', 2, '-2000.00', '0.00', '850.00', '', '2018-04-25 22:41:45'),
(100087, 10023, '2018-04-25', 4, '0.00', '60.00', '910.00', 'Add interest for overdued loan', '2018-04-25 22:43:29'),
(100088, 10027, '2018-04-26', 5, '100.00', '0.00', '1100.00', 'add loan 100', '2018-04-27 01:32:34'),
(100089, 10030, '2018-04-26', 1, '10000.00', '700.00', '10700.00', '', '2018-04-27 01:33:58'),
(100090, 10017, '2018-04-28', 4, '0.00', '370.00', '5720.00', 'Add interest for overdue loan', '2018-04-27 01:36:50'),
(100091, 10029, '2018-04-26', 3, '-5350.00', '0.00', '0.00', '', '2018-04-27 01:39:08'),
(100092, 10031, '2018-04-26', 1, '10000.00', '700.00', '10700.00', 'New loan after payment of last loan 5350. add', '2018-04-27 01:40:09'),
(100093, 10027, '2018-04-28', 3, '-1100.00', '0.00', '0.00', '', '2018-05-01 10:19:18'),
(100094, 10030, '2018-05-03', 2, '-2900.00', '0.00', '7800.00', '', '2018-05-03 22:54:27'),
(100095, 10031, '2018-05-03', 2, '-1500.00', '0.00', '9200.00', '', '2018-05-03 23:00:19'),
(100096, 10026, '2018-05-03', 2, '-1500.00', '0.00', '2350.00', '', '2018-05-03 23:07:25'),
(100097, 10009, '2018-05-03', 5, '2600.00', '0.00', '5000.00', 'Additional loan to come up with 5000 total ba', '2018-05-03 23:15:51'),
(100098, 10009, '2018-05-03', 4, '0.00', '350.00', '5350.00', 'Added interest due to new total balance amoun', '2018-05-03 23:17:25'),
(100099, 10028, '2018-05-10', 3, '-1070.00', '0.00', '0.00', '', '2018-05-10 17:34:47'),
(100100, 10023, '2018-05-10', 3, '-910.00', '0.00', '0.00', '', '2018-05-10 17:35:46'),
(100101, 10017, '2018-05-11', 3, '-5720.00', '0.00', '0.00', '', '2018-05-11 23:23:29'),
(100102, 10032, '2018-05-11', 1, '5000.00', '350.00', '5350.00', 'ATM is to be followed', '2018-05-11 23:24:11'),
(100103, 10033, '2018-05-12', 1, '2000.00', '140.00', '2140.00', 'New loan after a long time', '2018-05-12 10:21:53'),
(100104, 10026, '2018-05-12', 3, '-2350.00', '0.00', '0.00', '', '2018-05-14 01:40:57'),
(100105, 10034, '2018-05-12', 1, '2000.00', '140.00', '2140.00', 'No ATM surrendered. Co-make by brox', '2018-05-14 01:46:21'),
(100106, 10035, '2018-05-16', 1, '3000.00', '210.00', '3210.00', '', '2018-05-16 21:53:57'),
(100107, 10031, '2018-05-17', 2, '-3000.00', '0.00', '6200.00', '', '2018-05-17 20:48:51'),
(100108, 10031, '2018-05-27', 4, '0.00', '430.00', '6630.00', 'Add interest for 2nd month', '2018-05-17 20:52:52'),
(100109, 10030, '2018-05-17', 2, '-2800.00', '0.00', '5000.00', '', '2018-05-17 20:58:51'),
(100110, 10030, '2018-05-27', 4, '0.00', '350.00', '5350.00', 'Add interest for 2nd month', '2018-05-17 20:59:23'),
(100111, 10009, '2018-05-17', 3, '-5350.00', '0.00', '0.00', 'full payment to renew another loan 10,000', '2018-05-17 21:06:40'),
(100112, 10036, '2018-05-17', 1, '10000.00', '700.00', '10700.00', 'loan after full payment of last loan 5350', '2018-05-17 21:09:02'),
(100113, 10034, '2018-05-18', 3, '-2140.00', '0.00', '0.00', '', '2018-05-18 09:36:22'),
(100114, 10033, '2018-05-18', 2, '-1000.00', '0.00', '1140.00', '', '2018-05-20 21:20:50'),
(100115, 10037, '2018-05-23', 1, '2500.00', '175.00', '2675.00', 'Payment source is thru pension via PNB ATM ca', '2018-05-23 23:21:16'),
(100116, 10032, '2018-05-25', 2, '-1000.00', '0.00', '4350.00', '', '2018-05-25 21:55:31'),
(100117, 10035, '2018-05-25', 3, '-3210.00', '0.00', '0.00', '1st payment via ATM', '2018-05-25 21:59:10'),
(100118, 10038, '2018-05-25', 1, '2000.00', '140.00', '2140.00', 'New trans after a long time', '2018-05-25 22:06:16'),
(100119, 10039, '2018-05-29', 1, '8000.00', '560.00', '8560.00', 'According to her, for her mother\'s hospital f', '2018-05-29 21:10:12'),
(100120, 10036, '2018-05-31', 2, '-2800.00', '0.00', '7900.00', '', '2018-05-31 22:37:58'),
(100121, 10030, '2018-05-31', 2, '-2600.00', '0.00', '2750.00', '', '2018-05-31 22:39:17'),
(100122, 10033, '2018-05-31', 3, '-1140.00', '0.00', '0.00', '', '2018-05-31 22:40:32'),
(100123, 10038, '2018-05-31', 2, '-1100.00', '0.00', '1040.00', '', '2018-05-31 22:46:33'),
(100124, 10031, '2018-05-31', 3, '-6630.00', '0.00', '0.00', 'Paid full for reloan 15,000', '2018-05-31 22:59:47'),
(100125, 10040, '2018-05-31', 1, '15000.00', '1050.00', '16050.00', 'New loan right away after last loan paid', '2018-05-31 23:03:12'),
(100126, 10036, '2018-06-01', 5, '800.00', '0.00', '8700.00', 'Returned 800 due to plead for lesser partial ', '2018-06-01 09:13:37'),
(100127, 10037, '2018-06-05', 3, '-2675.00', '0.00', '0.00', '', '2018-06-05 20:19:33');

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
  `middlename` varchar(45) NOT NULL,
  `contact` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `address` varchar(250) NOT NULL,
  `date_registered` varchar(20) NOT NULL,
  `administrator` int(1) NOT NULL DEFAULT '0',
  `cashier` int(1) NOT NULL DEFAULT '0',
  `inventory` int(1) NOT NULL DEFAULT '0',
  `supplier` int(1) NOT NULL DEFAULT '0',
  `customer` int(1) NOT NULL DEFAULT '0',
  `user` int(1) NOT NULL DEFAULT '0',
  `report` int(1) NOT NULL DEFAULT '0',
  `removed` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `lastname`, `firstname`, `middlename`, `contact`, `email`, `address`, `date_registered`, `administrator`, `cashier`, `inventory`, `supplier`, `customer`, `user`, `report`, `removed`) VALUES
(101, 'super_admin', 'alphabravocharliedelta', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', '2017-10-10 19:34:33', 1, 0, 0, 0, 0, 0, 0, 0),
(102, 'nelda', 'kallay1975', 'NELDA', 'PAGSAC', 'BAGUIOHANON', '2969754', 'celinemariepagsac@gmail.com', 'Bl. 27, Lot 4, Gallera de Oro, Bago, Davao City', '2017-10-10 19:38:54', 1, 0, 0, 0, 0, 0, 0, 1),
(103, 'jiktorres', 'jiktorres', 'Torres', 'Jiki', 'Zyrus', '09228031290', 'jiki@gmail.com', 'Sasa, Davao City', '2017-10-10 19:40:32', 0, 0, 0, 0, 0, 0, 0, 1),
(104, 'ladysheen', 'ladysheen', 'GIlbang', 'Lady Sheen', 'Acolentaba', '09888787878', 'lsg@gmail.com', 'Catalunan Grande, Davao City', '2017-10-10 19:41:30', 0, 0, 0, 0, 0, 0, 0, 1),
(105, 'ivyybi', 'ivyybi', 'Ybiernas', 'Ivy', 'Villegas', '0909898897', 'ybi@gmail.com', 'Mawab, Compostela Valley', '2017-10-10 19:52:08', 0, 0, 0, 0, 0, 0, 0, 1),
(106, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', '2018-02-04 02:31:33', 0, 0, 0, 0, 0, 0, 0, 1),
(107, 'srmafel_inting', 'fsilgc', 'Inting', 'Ma. Felina ', 'Saban', '09232838367', 'srmafel_inting@yahoo.com', 'JS Francisco Village, Talomo , Davao City', '2018-02-06 16:19:07', 1, 0, 0, 0, 0, 0, 0, 1),
(108, 'um_developer', 'jiktorres', 'TORRES', 'JIK', 'ABAS', '+639228031290', 'jikiboi03@gmail.com', 'Sasa, Davao City', '2018-02-07 14:06:29', 1, 0, 0, 0, 0, 0, 0, 0),
(109, 'xanderford', 'xanderford', 'Ford', 'Xander', 'Marlou', '09989898988', 'xander@gmail.com', 'Brgy Barrio Patay, Davao City', '2018-03-12 23:23:04', 0, 0, 0, 0, 0, 0, 0, 0);

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
  MODIFY `atm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
--
-- AUTO_INCREMENT for table `capital`
--
ALTER TABLE `capital`
  MODIFY `capital_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10004;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10017;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `comp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `loan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10041;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000329;
--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `sched_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100128;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
