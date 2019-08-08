-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 08, 2019 at 07:14 AM
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
(108, 'wewie05', 'Www1980w', 'MEDIANERO', 'WIE', '', '+639194728807', 'wie@gmail.com', '115-13 PUROK 1A BOLTON ST. DAVAO CITY', '2018-02-07 14:06:29', 1, 0),
(109, 'CABARDO', '091923', 'CABARDO', 'JOHNNY', '1', '0', 'M', 'M', '2019-01-14 23:25:25', 0, 0),
(110, 'PALUGA', '072986', 'PALUGA', 'HONEYLYN', '3', '', '', '', '2019-01-14 23:26:50', 0, 0),
(111, 'FLORES', '2294', 'FLORES', 'JADE', '4', '', '', '', '2019-01-14 23:27:56', 0, 0),
(112, 'MONTES', '105601', 'MONTES', 'JEIMVERLEE', '5', '', '', '', '2019-01-14 23:28:52', 0, 0),
(113, 'PANGANORON', '0623', 'PANGANORON', 'DC', '6', '', '', '', '2019-01-14 23:28:52', 0, 0),
(114, 'ILLUSTRY', '1410', 'ILLUSTRY', 'REJINE', '7', '', '', '', '2019-01-14 23:30:14', 0, 0),
(115, 'MADAGAS', '4917', 'MADAGAS', 'SHANE STIPHANY', '8', '', '', '', '2019-01-14 23:30:14', 0, 0),
(116, 'DURANGO', '1990', 'DURANGO', 'JUNRIE', '9', '', '', '', '2019-01-14 23:35:26', 0, 0),
(117, 'PAHUYO', '0723', 'PAHUYO', 'ALVIN', '10', '', '', '', '2019-01-14 23:35:26', 0, 0),
(118, 'Ubalde', '1325', 'Ubalde', 'JHAY', '11', '0', 'J', 'N', '2019-01-14 23:36:33', 0, 0),
(119, 'LIZA', '2008', 'LIZA', 'ROSEMARIE', '12', '', '', '', '2019-01-14 23:36:33', 0, 0),
(120, 'ANGWAY', '2424', 'ANGWAY', 'IVY JANE', '13', '', '', '', '2019-01-14 23:38:05', 0, 0),
(121, 'YANO', '0808', 'YANO', 'LUCEL', '14', '', '', '', '2019-01-14 23:38:05', 0, 0),
(122, 'AMBAO', '0927', 'AMBAO	', 'ANA MARIE', '15', '0', 'A', 'A', '2019-01-14 23:39:08', 0, 0),
(123, 'UDTOHAN', '1211', 'UDTOHAN', 'DARLYN DAWN', '16', '', '', '', '2019-01-14 23:39:08', 0, 0),
(124, 'ANGELIA', '262398', 'ANGELIA', 'ROMERO', '17', '', '', '', '2019-01-14 23:40:21', 0, 0),
(125, 'PASTOR', '0920', 'PASTOR', 'MICA', '18', '', '', '', '2019-01-14 23:40:21', 0, 0),
(126, 'LUMANTAS', '00', 'LUMANTAS', 'BORGE', '19', '3', 'o', 'd', '2019-01-14 23:41:29', 0, 0),
(127, 'BAJAO', '6348', 'BAJAO', 'ARVEN JAY', '20', '', '', '', '2019-01-14 23:41:29', 0, 0),
(128, 'ABAPO', '0718', 'ABAPO', 'LOURAN MAY', '21', '', '', '', '2019-01-14 23:43:44', 0, 0),
(129, 'Gunzaga', '000', 'Gunzaga', 'Jp', '22', '', '', '', '2019-01-14 23:43:44', 0, 0),
(130, ' PAMELGAN', '1315', ' PAMELGAN', 'JHONA MAE', '23', '', '', '', '2019-01-19 13:29:25', 0, 0),
(131, 'CANETE', '0425', 'CANETE', 'CHARISSE', '24', '', '', '', '2019-01-19 13:37:43', 0, 0),
(132, 'ADINO ', '1997', 'ADINO ', 'VENCICE', '25', '', '', '', '2019-01-19 14:04:30', 0, 0),
(133, 'PEREGRINO', '1524', 'PEREGRINO', 'JELYN', '26', '', '', '', '2019-01-19 14:07:31', 0, 0),
(134, 'Seledio', '092014', 'Seledio', 'RONNIE john', '27', '00', 'M', 'M', '2019-01-19 14:09:42', 0, 0),
(135, 'ALNGOG', '4917', 'ALNGOG', 'JAY AR', '28', '', '', '', '2019-01-19 14:17:10', 0, 0),
(136, 'ALCOVER', '1890', 'ALCOVER', 'MELBEN', '29', '', '', '', '2019-01-26 20:14:06', 0, 0),
(137, 'Bante', '1297', 'Bante', 'Vergel', '30', '', '', '', '2019-01-28 22:31:10', 0, 0),
(138, 'Molina', '1997', 'Molina', 'Erwan', '31', '', '', '', '2019-01-28 22:43:18', 0, 0),
(139, 'Labalan', '0414', 'Labalan', 'Raquel', '32', '', '', '', '2019-02-01 23:10:49', 0, 0),
(140, 'Sobrecarey', '1970', 'Sobrecarey', 'John', '33', '', '', '', '2019-02-01 23:27:27', 0, 0),
(141, 'Manangan', '081209', 'Manangan', 'Glorybelle', '34', '', '', '', '2019-02-02 00:14:02', 0, 0),
(142, 'Sanchez', '1995', 'Sanchez', 'Joemarie', '35', '', '', '', '2019-02-04 21:57:36', 0, 0),
(143, 'Sefuentes', '1997', 'Sefuentes', 'Rhea joy', '36', '', '', '', '2019-02-04 22:16:29', 0, 0),
(144, 'Esguerra', '0220', 'Esguerra', 'Reza mae', '37', '', '', '', '2019-02-06 14:04:44', 0, 0),
(145, 'Lumantas ', '00', 'Lumantas ', 'Tentaw', '38', '', '', '', '2019-02-07 23:12:42', 0, 0),
(146, 'Aquisap', '010594', 'Aquisap', 'Vincent', '39', '9', 'H', 'B', '2019-02-07 23:21:53', 0, 0),
(147, 'Tawakalan', '0706', 'Tawakalan', 'Abbegille', '40', '', '', '', '2019-02-08 23:10:56', 0, 0),
(148, 'Traya', '051600', 'Traya', 'Princess kimberly', '41', 'A', 'A', 'A', '2019-02-09 22:38:44', 0, 0),
(149, 'Catajusan', '1996', 'Catajusan', 'Marvin', '42', '', '', '', '2019-02-09 22:58:11', 0, 0),
(150, 'timtim', '6188', 'timtim', 'marichu', '43', '', '', '', '2019-02-10 23:25:53', 0, 0),
(151, 'baguio', '0122', 'baguio', 'patricia', '44', '', '', '', '2019-02-15 22:22:40', 0, 0),
(152, 'udtohan', '1618', 'udtohan', 'april joy', '45', '', '', '', '2019-02-17 21:30:48', 0, 0),
(153, 'amera', '2497', 'amera', 'tawakalan', '46', '', '', '', '2019-02-17 22:12:03', 0, 0),
(154, 'Amat', '1994', 'Amat', 'Jeremy sid', '47', '', '', '', '2019-02-20 10:37:18', 0, 0),
(155, 'galon', '080593', 'galon', 'khristenne', '48', '', '', '', '2019-02-23 22:22:47', 0, 0),
(156, 'biadog', '072829', 'biadog', 'jourlyn mie', '49', '', '', '', '2019-02-23 22:49:21', 0, 0),
(157, 'catalan', '0526', 'catalan', 'joy', '50', '', '', '', '2019-02-25 23:14:41', 0, 0),
(158, 'dela cruz', '0795', 'dela cruz', 'noreen mae', '51', '', '', '', '2019-02-25 23:42:26', 0, 0),
(159, 'gonzaga', '0000', 'gonzaga', 'john fer', '52', '', '', '', '2019-02-25 23:58:29', 0, 0),
(160, 'pena', '080396', 'pena', 'vincent darryl', '53', '', '', '', '2019-02-26 00:19:53', 0, 0),
(161, 'Iniego', '8205', 'iniego', 'daniel ', '54', '0', 'H', 'H', '2019-02-26 00:50:35', 0, 0),
(162, 'jimenez', '072301', 'jimenez', 'laurennz', '55', '', '', '', '2019-02-26 00:58:45', 0, 0),
(163, 'ADORADOR', '585858', 'ADORADOR', 'CHARMINA', '56', '', '', '', '2019-02-27 22:04:50', 0, 0),
(164, 'gianne', '1', 'gianne', 'nike', '57', '', '', '', '2019-02-28 22:42:59', 0, 0),
(165, 'anticamana', '807197', 'anticamana', 'ferdinad', '58', '', '', '', '2019-03-01 20:49:57', 0, 0),
(166, 'vinaya', '0406', 'vinaya', 'arianne liz', '59', '', '', '', '2019-03-04 22:37:29', 0, 0),
(167, 'TELERON', '221335', 'TELERON', 'JOHN CARLO', '60', '', '', '', '2019-03-05 00:18:27', 0, 0),
(168, 'ALACASE', '0793', 'ALACASE', 'MARK ANTHONY', '61', '', '', '', '2019-03-05 01:05:41', 0, 0),
(169, 'viduya', '120115', 'viduya', 'lenny chris', '62', '', '', '', '2019-03-05 23:26:41', 0, 0),
(170, 'Oville', '669372', 'Oville', 'Marlin', '63', '', '', '', '2019-03-07 21:39:04', 0, 0),
(171, 'Belanda', '100118', 'Belanda', 'Jackilyn', '64', '', '', '', '2019-03-07 21:59:32', 0, 0),
(172, 'gamal', '0214', 'gamal', 'kevin', '65', '', '', '', '2019-03-10 21:30:27', 0, 0),
(173, 'navares', '8914', 'navares', 'christine', '66', '', '', '', '2019-03-10 23:27:36', 0, 0),
(174, 'palmes', '1821', 'palmes', 'marlyn', '67', '', '', '', '2019-03-10 23:54:31', 0, 0),
(175, 'Pepito', '0000', 'Pepito', 'Jorge', '68', '', '', '', '2019-03-15 13:17:19', 0, 0),
(176, 'Naro', '122192', 'Naro', 'Chalit', '69', '', '', '', '2019-03-27 00:57:21', 0, 0),
(177, 'Miralles', '029210', 'Miralles', 'Freddie', '70', '', '', '', '2019-03-30 13:20:29', 0, 0),
(178, 'Balowa', '1994', 'Balowa', 'Julieta', '71', '', '', '', '2019-03-30 13:27:06', 0, 0),
(179, 'TAALA', '8105', 'TAALA', 'ROMEL', '72', '', '', '', '2019-03-31 10:32:41', 0, 0),
(180, 'santianes', '0921', 'santianes', 'reymart', '73', '', '', '', '2019-04-01 11:35:11', 0, 0),
(181, 'julian', '301130', 'julian', 'christine', '74', '2', 'k', 'j', '2019-04-04 01:11:46', 0, 0),
(182, 'alipio', '0224', 'alipio', 'rhonel', '75', '', '', '', '2019-04-04 23:19:57', 0, 0),
(183, 'dela torre', '0419', 'dela torre', 'renan', '76', '', '', '', '2019-04-05 23:42:19', 0, 0),
(184, 'batugan', '062213', 'batugan', 'rose ann', '77', '', '', '', '2019-04-10 21:52:14', 0, 0),
(185, 'macumao', '0293', 'macumao', 'michelle', '78', '', '', '', '2019-04-10 22:10:20', 0, 0),
(186, 'aseneta', '021590', 'aseneta', 'iris joy', '79', '', '', '', '2019-04-10 22:28:45', 0, 0),
(187, 'nazareno', '171983', 'nazareno', 'ryan', '80', '', '', '', '2019-04-11 01:51:05', 0, 0),
(188, 'Tablada', '1997', 'Tablada', 'Franeis ryan tablada', '81', '', '', '', '2019-04-12 13:12:18', 0, 0),
(189, 'estapia', '202106', 'estapia', 'mery joy', '82', '', '', '', '2019-04-26 09:34:59', 0, 0),
(190, 'Maghari', '0608', 'Maghari', 'Jerine', '83', '', '', '', '2019-05-01 06:12:07', 0, 0),
(191, 'lumantass', '156', 'lumantass', 'borge', '84', '', '', '', '2019-05-10 22:46:55', 0, 1),
(192, 'dael', '224898', 'dael', 'mayeth', '85', '', '', '', '2019-05-11 22:29:46', 0, 0),
(193, 'deguia', '185414', 'deguia', 'ilyn', '86', '', '', '', '2019-05-14 06:50:44', 0, 0),
(194, 'casafranca', '120188', 'casafranca', 'queennie anne', '87', '', '', '', '2019-05-16 12:01:03', 0, 0),
(195, 'suson', '0890', 'suson', 'analie', '88', '', '', '', '2019-05-18 12:47:51', 0, 0),
(196, 'marc', '2021', 'marc', 'lara chiristian', '89', '', '', '', '2019-05-18 13:11:46', 0, 0),
(197, 'sangeban', '2992', 'sangeban', 'jared', '90', '', '', '', '2019-05-27 22:03:05', 0, 0),
(198, 'bustamante', '199101', 'bustamante', 'eleasar', '91', '', '', '', '2019-06-01 12:10:57', 0, 0),
(199, 'borgonos', '194307', 'borgonos', 'jem kelly', '92', '', '', '', '2019-06-05 22:33:24', 0, 0),
(200, 'Badon', '051993', 'Badon', 'Sarah mae', '93', '', '', '', '2019-06-06 06:22:39', 0, 0),
(201, 'Sindato', '101512', 'Sindato', 'Altany', '94', '', '', '', '2019-06-14 01:31:08', 0, 0),
(202, 'maylig', '0518', 'maylig', 'mhey ann', '95', '', '', '', '2019-06-14 22:37:14', 0, 0),
(203, 'Albores', '0620', 'Albores', 'Jason', '96', '', '', '', '2019-06-17 03:06:35', 0, 0),
(204, 'marquez', '091710', 'marquez', 'lorena', '97', '', '', '', '2019-06-21 00:04:51', 0, 0),
(205, 'Ehboy', '0000', 'Ehboy', 'Ehboy', '98', '', '', '', '2019-06-22 00:47:14', 0, 0),
(206, 'Manalo', '051695', 'Manalo', 'Mackin paul', '99', '', '', '', '2019-06-23 02:02:19', 0, 0),
(207, 'maraya', '010594', 'maraya', 'danes', '100', '', '', '', '2019-06-26 22:46:17', 0, 0),
(208, 'pastor', '3491', 'pastor', 'roldan', '101', '', '', '', '2019-06-26 22:57:26', 0, 0),
(209, 'Sumatra', '053095', 'Sumatra', 'Charlene', '102', '', '', '', '2019-06-28 03:44:09', 0, 0),
(210, 'Idong', '122818', 'Idong', 'Rodgen', '103', '', '', '', '2019-06-28 03:47:05', 0, 0),
(211, 'camaling', '060419', 'camaling', 'stephan', '104', '', '', '', '2019-06-29 23:32:16', 0, 0),
(212, 'Conales', '020202', 'Conales', 'Donard', '105', '', '', '', '2019-07-05 23:29:12', 0, 0),
(213, 'Basco', '112781', 'Basco', 'Esperidion', '106', '', '', '', '2019-07-06 02:59:22', 0, 0),
(214, 'Asparo', '1116', 'Asparo', 'Kim brian', '107', '', '', '', '2019-07-09 01:39:11', 0, 0),
(215, 'Pelantes', '121493', 'Pelantes', 'Cherry', '108', '', '', '', '2019-07-10 10:30:03', 0, 0),
(216, 'osman', '8613', 'osman', 'anwar', '109', '', '', '', '2019-07-13 23:09:37', 0, 0),
(217, 'broa', '103420', 'broa', 'desleeh jun', '110', '', '', '', '2019-07-15 03:01:44', 0, 0),
(218, 'Barrantes', '0418', 'Barrantes', 'Regie', '111', '', '', '', '2019-07-16 11:05:07', 0, 0),
(219, 'Cortes', '0918', 'Cortes', 'Marie nel', '112', '', '', '', '2019-07-16 11:13:15', 0, 0),
(220, 'rubio', '100998', 'rubio', 'raymond', '113', '', '', '', '2019-07-20 03:16:01', 0, 0),
(221, 'Amora', '3323', 'Amora', 'Gina', '114', '', '', '', '2019-07-23 05:57:49', 0, 0),
(222, 'Gabilagon', '172208', 'Gabilagon', 'Gemma', '115', '', '', '', '2019-07-24 11:32:31', 0, 0),
(223, 'dumayac', '1728', 'dumayac', 'kimberly', '116', '', '', '', '2019-07-26 00:48:48', 0, 0),
(224, 'destreza', '060885', 'destreza', 'Ryan pete', '117', '', '', '', '2019-07-26 05:25:10', 0, 0),
(225, 'Zambrano', '748547', 'Zambrano', 'Cecelito', '118', '', '', '', '2019-07-28 12:21:17', 0, 0),
(226, 'calbradilla', '2672', 'calbradilla', 'aprilyn', '119', '', '', '', '2019-08-01 01:56:16', 0, 0),
(227, 'bertumen', '899103', 'bertumen', 'celso', '120', '', '', '', '2019-08-01 23:06:16', 0, 0),
(228, 'blanco', '0820', 'blanco', 'wewie', '121', '', '', '', '2019-08-07 00:50:45', 0, 0),
(229, 'dinampo', '050164', 'dinampo', 'jovy', '122', '', '', '', '2019-08-07 01:00:24', 0, 0),
(230, 'sample', '1', 'sample', 'sample', '123', NULL, NULL, NULL, '2019-08-08 07:10:03', 0, 0);

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=231;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
