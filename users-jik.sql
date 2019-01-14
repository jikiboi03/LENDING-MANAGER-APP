-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 13, 2019 at 09:32 PM
-- Server version: 5.7.24-0ubuntu0.16.04.1
-- PHP Version: 7.1.25-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `client_id` varchar(11) NOT NULL,
  `contact` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `address` varchar(250) NOT NULL,
  `date_registered` datetime DEFAULT CURRENT_TIMESTAMP,
  `administrator` int(1) NOT NULL DEFAULT '0',
  `removed` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `lastname`, `firstname`, `client_id`, `contact`, `email`, `address`, `date_registered`, `administrator`, `removed`) VALUES
(101, 'super_admin', 'alphabravocharliedelta', 'n/a', 'n/a', '', 'n/a', 'n/a', 'n/a', '2017-10-10 19:34:33', 1, 0),
(108, 'um_developer', 'jiktorres', 'TORRES', 'JIK', '', '+639228031290', 'jikiboi03@gmail.com', 'Sasa, Davao City', '2018-02-07 14:06:29', 1, 0),
(115, 'ALDERITE', '0000', 'ALDERITE', 'ROSE ANN', '10003', '', '', '', '2019-01-14 13:09:56', 0, 0),
(116, 'ISRAEL', '101993', 'ISRAEL', 'LADY GRACE', '10001', '', '', '', '2019-01-14 13:09:56', 0, 0),
(117, 'ZABATE', '2330', 'ZABATE', 'KAREN JANE', '10004', '', '', '', '2019-01-14 13:12:15', 0, 0),
(118, 'ABDULLAH', '040501', 'ABDULLAH', 'FARHANA BINT', '10005', '', '', '', '2019-01-14 13:12:15', 0, 0),
(119, 'BAYANI', '682488', 'BAYANI', 'ESNEYRA', '10009', '', '', '', '2019-01-14 13:15:38', 0, 0),
(120, 'PRESENTE', '048498', 'PRESENTE', 'JAYRRAH', '10016', '', '', '', '2019-01-14 13:15:38', 0, 0),
(121, 'PADILLA', '042893', 'PADILLA', 'SHAHANA ', '10017', '', '', '', '2019-01-14 13:16:52', 0, 0),
(122, 'GABORNO', '006810', 'GABORNO', 'JESSA', '10018', '', '', '', '2019-01-14 13:16:52', 0, 0),
(123, 'CLARKSON', '170295', 'CLARKSON', 'JESSICA', '10019', '', '', '', '2019-01-14 13:18:11', 0, 0),
(124, 'CARIM', '070893', 'CARIM', 'MARY JASMIN', '10022', '', '', '', '2019-01-14 13:18:11', 0, 0),
(125, 'TORRES', '1014', 'TORRES', 'MARJORIE', '10023', '', '', '', '2019-01-14 13:19:44', 0, 0),
(126, 'SISON', '123184', 'SISON', 'BERNARD IAN', '10024', '', '', '', '2019-01-14 13:19:44', 0, 0),
(127, 'OCZON', '654321', 'OCZON', 'JORELH', '10025', '', '', '', '2019-01-14 13:21:02', 0, 0),
(128, 'LOPEZ', '1403', 'LOPEZ', 'FEJIE', '10027', '', '', '', '2019-01-14 13:21:02', 0, 0),
(129, 'NULUD', '0128', 'NULUD', 'JAN PATRICK', '10028', '', '', '', '2019-01-14 13:22:09', 0, 0),
(130, 'DE REAL', '9864', 'DE REAL', 'MAYUMI', '10029', '', '', '', '2019-01-14 13:22:09', 0, 0),
(131, 'ANG', '000000', 'ANG', 'MICO', '10030', '', '', '', '2019-01-14 13:23:37', 0, 0),
(132, 'CAGAMPANG', '120115', 'CAGAMPANG', 'MARY GRACE', '10031', '', '', '', '2019-01-14 13:23:37', 0, 0),
(133, 'ANIMA', '0613', 'ANIMA', 'CHERRYL', '10032', '', '', '', '2019-01-14 13:24:42', 0, 0),
(134, 'JIMENEZ', '062197', 'JIMENEZ', 'JAZZRIC', '10033', '', '', '', '2019-01-14 13:24:42', 0, 0),
(135, 'CALAMAAN', '753538', 'CALAMAAN', 'ANGELIKA JOYCE', '10034', '', '', '', '2019-01-14 13:26:25', 0, 0),
(136, 'TALAMERA', '1993', 'TALAMERA', 'MARIA LINEL', '10035', '', '', '', '2019-01-14 13:26:25', 0, 0),
(137, 'ATABELO', '880243', 'ATABELO', 'MA. LYNN', '10036', '', '', '', '2019-01-14 13:27:28', 0, 0),
(138, 'ESPINA', '122116', 'ESPINA', 'KRYSTYN KYNE', '10038', '', '', '', '2019-01-14 13:27:28', 0, 0),
(139, 'ANIMA', '653510', 'ANIMA', 'DARRIN', '10039', '', '', '', '2019-01-14 13:28:22', 0, 0),
(140, 'ESTILLORE', '1993', 'ESTILLORE', 'MARY JOY', '10040', '', '', '', '2019-01-14 13:28:22', 0, 0),
(141, 'LUYAHAN', '051116', 'LUYAHAN', 'ALODIA FE', '10041', '', '', '', '2019-01-14 13:29:32', 0, 0),
(142, 'SOLAIMAN', '0806', 'SOLAIMAN', 'ARNOLD II', '10042', '', '', '', '2019-01-14 13:29:32', 0, 0),
(143, 'ALCONTIN', '0', 'ALCONTIN', 'PEARL ANGELIE', '10043', '', '', '', '2019-01-14 13:30:42', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
