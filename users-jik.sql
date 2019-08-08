-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 08, 2019 at 07:28 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id6261771_e_lending`
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
(143, 'ALCONTIN', '0', 'ALCONTIN', 'PEARL ANGELIE', '10043', '', '', '', '2019-01-14 13:30:42', 0, 0),
(144, 'BIWANG', '1120', 'BIWANG', 'JUH', '10013', '', '', '', '2019-01-16 02:28:52', 0, 0),
(145, 'DAYOT', '0630', 'DAYOT', 'FRECY GAY', '10044', '', '', '', '2019-01-25 02:36:58', 0, 0),
(146, 'LOGONG', '5091', 'LOGONG', 'EMMIL L.', '10045', '', '', '', '2019-01-25 04:58:36', 0, 0),
(147, 'PACORE', '6014', 'PACORE', 'ELMERA R.', '10046', '', '', '', '2019-01-25 05:00:47', 0, 0),
(148, 'RABUYA', '122797', 'RABUYA', 'JIZZA MAE S.', '10047', '', '', '', '2019-01-31 07:52:09', 0, 0),
(149, 'PENAFIEL', '2015', 'PENAFIEL', 'SHIENA MAE', '10048', '', '', '', '2019-02-04 07:51:25', 0, 0),
(150, 'LENDIO', '0227', 'LENDIO', 'KENDRILLE JUNE', '10049', '', '', '', '2019-02-15 08:52:34', 0, 0),
(151, 'CAMPEON', '0820', 'CAMPEON', 'ODESSA', '10050', '0', 'none', 'none', '2019-02-18 04:53:08', 0, 0),
(152, 'SOLER', '638201', 'SOLER', 'NIKKA JEAN', '10051', '', '', '', '2019-02-18 10:06:51', 0, 0),
(153, 'BAHI-AN', '110290', 'BAHI-AN', 'DAN M. JR.', '10052', '', '', '', '2019-03-08 15:14:30', 0, 0),
(154, 'LUMOMBANG', '080292', 'LUMOMBANG', 'NEWLIFE N.', '10053', '', '', '', '2019-03-11 16:22:35', 0, 0),
(155, 'DAKAY', '052716', 'DAKAY', 'ANN SCELA LYN', '10054', '', '', '', '2019-03-12 14:04:52', 0, 0),
(156, 'DOLES', '082210', 'DOLES', 'ROXANNE', '10055', '', '', '', '2019-03-12 14:07:41', 0, 0),
(157, 'ATILLO', '053159', 'ATILLO', 'MARK ANTHONY', '10056', '', '', '', '2019-03-22 07:52:35', 0, 0),
(158, 'PADERO', '102096', 'PADERO', 'JESRIL JOHN ABALDE', '10057', '', '', '', '2019-03-22 07:56:34', 0, 0),
(159, 'ANTIGA', '122516', 'ANTIGA', 'CHARLYN M.', '10058', '', '', '', '2019-03-25 13:47:03', 0, 0),
(160, 'PLAZA', '1120', 'PLAZA', 'JUDITH D.', '10059', '', '', '', '2019-03-26 16:01:56', 0, 0),
(161, 'UY', '060159', 'UY', 'SACHIKU MAE C.', '10060', '', '', '', '2019-03-26 16:05:19', 0, 0),
(162, 'RAPER', '000000', 'RAPER', 'IAZELL CYNTHDAY', '10061', '', '', '', '2019-04-05 15:58:23', 0, 0),
(163, 'TANUTAN', '000000', 'TANUTAN', 'IRVIN', '10062', '', '', '', '2019-04-19 15:40:00', 0, 0),
(164, 'CAMPOREDONDO', '529296', 'CAMPOREDONDO', 'LOYD', '10063', '', '', '', '2019-04-25 14:55:30', 0, 0),
(165, 'DIZON', '372256', 'DIZON', 'RIEZEL M.', '10064', '', '', '', '2019-05-03 14:07:27', 0, 0),
(166, 'CARDEJON JR.', '0', 'CARDEJON JR.', 'TITO', '10065', '', '', '', '2019-05-03 14:23:53', 0, 0),
(167, 'MENDEZ', '5364', 'MENDEZ', 'MITCHELL D.', '10066', '', '', '', '2019-05-14 15:21:30', 0, 0),
(168, 'LAMAR', '534291', 'LAMAR', 'WELTER LLOYD', '10067', '', '', '', '2019-05-27 14:43:59', 0, 0),
(169, 'RETAGA', '0724', 'RETAGA', 'RONILYN', '10068', '', '', '', '2019-05-31 15:09:00', 0, 0),
(170, 'FELIZARTA', '0823', 'FELIZARTA', 'JADELEE ROBINOS', '10069', '', '', '', '2019-05-31 15:11:26', 0, 0),
(171, 'ARQUIO', '080816', 'ARQUIO', 'ANTHONY JOHN J.', '10070', '', '', '', '2019-06-14 14:14:16', 0, 0),
(172, 'ABA', '199619', 'ABA', 'ROUHAIMAY', '10071', '', '', '', '2019-06-21 16:36:52', 0, 0),
(173, 'FERNANDEZ', '071812', 'FERNANDEZ', 'JAYSAN', '10072', '', '', '', '2019-06-29 03:05:36', 0, 0),
(174, 'CASIMERO', '161692', 'CASIMERO', 'LORRAINE MAE B', '10073', '', '', '', '2019-07-02 14:51:37', 0, 0),
(175, 'LUMBAO', '0', 'LUMBAO', 'ERIC S.', '10074', '', '', '', '2019-07-02 14:53:13', 0, 0),
(176, 'SANTILLANA', '0817', 'SANTILLANA', 'EMMEE LOU', '10075', '', '', '', '2019-07-03 12:32:27', 0, 0),
(177, 'ALAGASI', '953732', 'ALAGASI', 'JASMIN', '10076', '', '', '', '2019-07-12 11:14:21', 0, 0),
(178, 'SIMPAS', '0316', 'SIMPAS', 'RAYMUND', '10077', '', '', '', '2019-07-12 11:16:08', 0, 0),
(179, 'BADON', '051993', 'BADON', 'SARAH MAE', '10078', '', '', '', '2019-07-20 14:17:19', 0, 0),
(180, 'PARCON', '120391', 'PARCON', 'JAYSON REY', '10079', '', '', '', '2019-07-23 04:41:52', 0, 0),
(181, 'LOTERONO', '111898', 'LOTERONO', 'JEFFREY', '10080', '', '', '', '2019-07-24 12:15:30', 0, 0),
(182, 'KADIL', '092318', 'KADIL', 'BABYLIN', '10081', '', '', '', '2019-07-26 14:14:48', 0, 0),
(183, 'CATADMAN', '080316', 'CATADMAN', 'CARENE', '10082', '', '', '', '2019-07-30 11:20:21', 0, 0);

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
