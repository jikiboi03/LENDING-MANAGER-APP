-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 06, 2019 at 11:42 PM
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
  `date_registered` varchar(20) NOT NULL,
  `administrator` int(1) NOT NULL DEFAULT '0',
  `removed` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `lastname`, `firstname`, `client_id`, `contact`, `email`, `address`, `date_registered`, `administrator`, `removed`) VALUES
(101, 'super_admin', 'alphabravocharliedelta', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', '2017-10-10 19:34:33', 1, 0),
(102, 'nelda', 'kallay1975', 'NELDA', 'PAGSAC', 'BAGUIOHANON', '2969754', 'celinemariepagsac@gmail.com', 'Bl. 27, Lot 4, Gallera de Oro, Bago, Davao City', '2017-10-10 19:38:54', 1, 1),
(103, 'jiktorres', 'jiktorres', 'Torres', 'Jiki', 'Zyrus', '09228031290', 'jiki@gmail.com', 'Sasa, Davao City', '2017-10-10 19:40:32', 0, 1),
(104, 'ladysheen', 'ladysheen', 'GIlbang', 'Lady Sheen', 'Acolentaba', '09888787878', 'lsg@gmail.com', 'Catalunan Grande, Davao City', '2017-10-10 19:41:30', 0, 1),
(105, 'ivyybi', 'ivyybi', 'Ybiernas', 'Ivy', 'Villegas', '0909898897', 'ybi@gmail.com', 'Mawab, Compostela Valley', '2017-10-10 19:52:08', 0, 1),
(106, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', '2018-02-04 02:31:33', 0, 1),
(107, 'srmafel_inting', 'fsilgc', 'Inting', 'Ma. Felina ', 'Saban', '09232838367', 'srmafel_inting@yahoo.com', 'JS Francisco Village, Talomo , Davao City', '2018-02-06 16:19:07', 1, 1),
(108, 'um_developer', 'jiktorres', 'TORRES', 'JIK', 'ABAS', '+639228031290', 'jikiboi03@gmail.com', 'Sasa, Davao City', '2018-02-07 14:06:29', 1, 0),
(109, 'xanderford', 'xanderford', 'Fordss', 'Xanderss', 'Marlou', '09989898988', 'xander@gmail.com', 'Brgy Barrio Patay, Davao City', '2018-03-12 23:23:04', 0, 0);

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
