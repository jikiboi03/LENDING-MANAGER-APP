-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 05, 2019 at 07:02 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id8376423_e_lending`
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
(108, 'wewie05', 'Www1980w', 'MEDIANERO', 'WIE', '', '+639194728807', 'wie@gmail.com', '115-13 PUROK 1A BOLTON ST. DAVAO CITY', '2018-02-07 14:06:29', 1, 0),
(109, 'CABARD', '091923', 'CABARD', 'JOHNNY', '1', '', '', '', '2019-01-14 23:25:25', 0, 0),
(110, 'PALUGA', '072986', 'PALUGA', 'HONEYLYN', '3', '', '', '', '2019-01-14 23:26:50', 0, 0),
(111, 'FLORES', '2294', 'FLORES', 'JADE', '4', '', '', '', '2019-01-14 23:27:56', 0, 0),
(112, 'MONTES', '105601', 'MONTES', 'JEIMVERLEE', '5', '', '', '', '2019-01-14 23:28:52', 0, 0),
(113, 'PANGANORON', '0623', 'PANGANORON', 'DC', '6', '', '', '', '2019-01-14 23:28:52', 0, 0),
(114, 'ILLUSTRY', '1410', 'ILLUSTRY', 'REJINE', '7', '', '', '', '2019-01-14 23:30:14', 0, 0),
(115, 'MADAGAS', '4917', 'MADAGAS', 'SHANE STIPHANY', '8', '', '', '', '2019-01-14 23:30:14', 0, 0),
(116, 'DURANGO', '1990', 'DURANGO', 'JUNRIE', '9', '', '', '', '2019-01-14 23:35:26', 0, 0),
(117, 'PAHUYO', '0723', 'PAHUYO', 'ALVIN', '10', '', '', '', '2019-01-14 23:35:26', 0, 0),
(118, 'UBAL', '2025', 'UBAL', 'JHAY', '11', '', '', '', '2019-01-14 23:36:33', 0, 0),
(119, 'LIZA', '2008', 'LIZA', 'ROSEMARIE', '12', '', '', '', '2019-01-14 23:36:33', 0, 0),
(120, 'ANGWAY', '2424', 'ANGWAY', 'IVY JANE', '13', '', '', '', '2019-01-14 23:38:05', 0, 0),
(121, 'YANO', '0808', 'YANO', 'LUCEL', '14', '', '', '', '2019-01-14 23:38:05', 0, 0),
(122, 'AMBAO', '0927', 'AMBAO	', 'ANA MARIE', '15', '0', 'A', 'A', '2019-01-14 23:39:08', 0, 0),
(123, 'UDTOHAN', '1211', 'UDTOHAN', 'DARLYN DAWN', '16', '', '', '', '2019-01-14 23:39:08', 0, 0),
(124, 'ANGELIA', '262398', 'ANGELIA', 'ROMERO', '17', '', '', '', '2019-01-14 23:40:21', 0, 0),
(125, 'PASTOR', '0920', 'PASTOR', 'MICA', '18', '', '', '', '2019-01-14 23:40:21', 0, 0),
(126, 'LUMANTAS', '00', 'LUMANTAS', 'BORGE', '19', '', '', '', '2019-01-14 23:41:29', 0, 0),
(127, 'BAJAO', '6348', 'BAJAO', 'ARVEN JAY', '20', '', '', '', '2019-01-14 23:41:29', 0, 0),
(128, 'ABAPO', '0718', 'ABAPO', 'LOURAN MAY', '21', '', '', '', '2019-01-14 23:43:44', 0, 0),
(129, 'Gunzaga', '000', 'Gunzaga', 'Jp', '22', '', '', '', '2019-01-14 23:43:44', 0, 0),
(130, ' PAMELGAN', '1315', ' PAMELGAN', 'JHONA MAE', '23', '', '', '', '2019-01-19 13:29:25', 0, 0),
(131, 'CANETE', '0425', 'CANETE', 'CHARISSE', '24', '', '', '', '2019-01-19 13:37:43', 0, 0),
(132, 'ADINO ', '1997', 'ADINO ', 'VENCICE', '25', '', '', '', '2019-01-19 14:04:30', 0, 0),
(133, 'PEREGRINO', '1524', 'PEREGRINO', 'JELYN', '26', '', '', '', '2019-01-19 14:07:31', 0, 0),
(134, 'JHON JEI', '092014', 'JHON JEI', 'RONNIE', '27', '', '', '', '2019-01-19 14:09:42', 0, 0),
(135, 'ALNGOG', '4917', 'ALNGOG', 'JAY AR', '28', '', '', '', '2019-01-19 14:17:10', 0, 0),
(136, 'ALCOVER', '1890', 'ALCOVER', 'MELBEN', '29', '', '', '', '2019-01-26 20:14:06', 0, 0),
(137, 'Bante', '1297', 'Bante', 'Vergel', '30', '', '', '', '2019-01-28 22:31:10', 0, 0),
(138, 'Molina', '1997', 'Molina', 'Erwan', '31', '', '', '', '2019-01-28 22:43:18', 0, 0),
(139, 'Labalan', '0414', 'Labalan', 'Raquel', '32', '', '', '', '2019-02-01 23:10:49', 0, 0),
(140, 'Sobrecarey', '1970', 'Sobrecarey', 'John', '33', '', '', '', '2019-02-01 23:27:27', 0, 0),
(141, 'Manangan', '081209', 'Manangan', 'Glorybelle', '34', '', '', '', '2019-02-02 00:14:02', 0, 0),
(142, 'Sanchez', '1995', 'Sanchez', 'Joemarie', '35', '', '', '', '2019-02-04 21:57:36', 0, 0),
(143, 'Sefuentes', '1997', 'Sefuentes', 'Rhea joy', '36', '', '', '', '2019-02-04 22:16:29', 0, 0);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
