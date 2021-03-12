-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2019 at 05:23 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cadisdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_num` int(100) NOT NULL,
  `employee_id` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `extension` varchar(50) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `unit` varchar(100) NOT NULL,
  `usertype` enum('Admin','AA','Encoder','Claim/OR officer','Releasing officer','Encoder2') NOT NULL,
  `username` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `status` enum('Activated','Deactivated') NOT NULL,
  `image` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_num`, `employee_id`, `fname`, `mname`, `lname`, `extension`, `gender`, `unit`, `usertype`, `username`, `pass`, `status`, `image`) VALUES
(1, '2014-16619', 'Jhon Danielle', 'Lauderis', 'Umbay', '', 'Male', 'Cash Unit', 'Encoder', 'jhon', 'nohj', 'Activated', 0x70726f66696c652e6a7067),
(2, '2014-01458', 'Cherry Pearl', 'Fajardo', 'Majadas', '', 'Female', 'Cash Unit', 'Claim/OR officer', 'cherry', 'cherry', 'Activated', 0x6368652e6a7067),
(3, '2014-00088', 'Syralynn', 'Agustin', 'Espena', '', 'Female', 'Cash Unit', 'Releasing officer', 'syra', 'syra', 'Activated', 0x782e6a7067),
(4, '2014-11295', 'Jobecar', 'Pongo', 'Federe', '', 'Female', 'IT Unit', 'Admin', 'jobecar', 'jobecar', 'Activated', 0x6a6f62656361722e6a7067),
(5, '2014-12241', 'Iris', 'B.', 'Adlawan', '', 'Female', 'Engineering', 'AA', 'iris', 'iris', 'Activated', 0x697269732e6a7067),
(6, '2014-94863', 'Frietche', 'B.', 'Canete', '', 'Female', 'Cash Unit', 'Claim/OR officer', 'frietche', 'frietche', 'Activated', 0x66726965746368652e6a7067),
(7, '2014-24449', 'Hannah', 'Cake', 'Baker', '', 'Female', 'Cash Unit', 'Releasing officer', 'hannah', 'hannah', 'Activated', 0x68616e6e61682e6a7067),
(8, '2014-51931', 'Clay', 'A.', 'Jensen', 'Jr.', 'Male', 'CIU', 'AA', 'clay', 'clay', 'Activated', 0x6c6f67616e2d6c65726d616e2d31202831292e6a7067),
(9, '2014-11001', 'Chloe Kate', 'Nepomoceno', 'Flores', '', 'Female', 'Pantawid', 'AA', 'kate', 'kate', 'Activated', 0x6b6174652e6a7067),
(11, '2014-89622', 'Danica Mae', 'Lauderis', 'Umbay', '', 'Female', 'Cash Unit', 'Encoder2', 'danica', 'danica', 'Activated', '');

-- --------------------------------------------------------

--
-- Table structure for table `attempts`
--

CREATE TABLE `attempts` (
  `a_id` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notif_num` int(255) NOT NULL,
  `payee` varchar(50) NOT NULL,
  `notif_detail` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `reference` varchar(100) NOT NULL,
  `recipient` varchar(100) NOT NULL,
  `status` int(50) NOT NULL,
  `days_left` int(11) NOT NULL,
  `expire_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notif_num`, `payee`, `notif_detail`, `created_at`, `reference`, `recipient`, `status`, `days_left`, `expire_date`) VALUES
(1, 'BIR', 'No receipt', '2018-09-12 16:40:16', '252622', '2', 1, 0, '0000-00-00'),
(2, 'BIR', 'No receipt', '2018-09-28 10:00:36', '252622', '6', 1, 0, '0000-00-00'),
(3, 'BIR', 'No receipt', '2018-09-12 16:40:39', '252622', '7', 1, 0, '0000-00-00'),
(4, 'BIR', 'No receipt', '2018-09-12 16:40:52', '252622', '1', 1, 0, '0000-00-00'),
(5, 'BIR', 'No receipt', '2018-09-17 13:24:32', '252622', '3', 1, 0, '0000-00-00'),
(6, 'DSWD KALAHI CIDSS NCDDP PAGSABANGAN - Syra', 'Stale cheque', '2018-09-12 16:41:19', '472472', '2', 1, 0, '2018-08-20'),
(7, 'DSWD KALAHI CIDSS NCDDP PAGSABANGAN - Syra', 'Stale cheque', '2018-09-28 10:00:36', '472472', '6', 1, 0, '2018-08-20'),
(8, 'DSWD KALAHI CIDSS NCDDP PAGSABANGAN - Syra', 'Stale cheque', '2018-09-12 16:41:38', '472472', '7', 1, 0, '2018-08-20'),
(9, 'DSWD KALAHI CIDSS NCDDP PAGSABANGAN - Syra', 'Stale cheque', '2018-09-12 16:41:46', '472472', '1', 1, 0, '2018-08-20'),
(10, 'DSWD KALAHI CIDSS NCDDP PAGSABANGAN - Syra', 'Stale cheque', '2018-09-17 13:24:32', '472472', '3', 1, 0, '2018-08-20'),
(11, 'DSWD KALAHI CIDSS NCDDP PAGSABANGAN - Cherry', 'Stale cheque', '2018-09-12 16:42:07', '345662', '2', 1, 0, '2018-08-20'),
(12, 'DSWD KALAHI CIDSS NCDDP PAGSABANGAN - Cherry', 'Stale cheque', '2018-09-28 10:00:36', '345662', '6', 1, 0, '2018-08-20'),
(13, 'DSWD KALAHI CIDSS NCDDP PAGSABANGAN - Cherry', 'Stale cheque', '2018-09-12 16:42:31', '345662', '7', 1, 0, '2018-08-20'),
(14, 'DSWD KALAHI CIDSS NCDDP PAGSABANGAN - Cherry', 'Stale cheque', '2018-09-12 16:42:36', '345662', '1', 1, 0, '2018-08-20'),
(15, 'DSWD KALAHI CIDSS NCDDP PAGSABANGAN - Cherry', 'Stale cheque', '2018-09-17 13:24:32', '345662', '3', 1, 0, '2018-08-20'),
(16, 'FAO Various Employees - Iris', 'No receipt', '2018-09-19 13:40:30', '674533', '2', 1, 0, '0000-00-00'),
(17, 'FAO Various Employees - Iris', 'No receipt', '2018-09-28 10:00:36', '674533', '6', 1, 0, '0000-00-00'),
(18, 'FAO Various Employees - Iris', 'No receipt', '2018-09-24 11:31:38', '674533', '7', 1, 0, '0000-00-00'),
(19, 'FAO Various Employees - Iris', 'No receipt', '2018-09-17 08:55:31', '674533', '1', 1, 0, '0000-00-00'),
(20, 'FAO Various Employees - Iris', 'No receipt', '2018-09-17 13:24:32', '674533', '3', 1, 0, '0000-00-00'),
(21, 'FAO Various Employees _ Frietche', 'No receipt', '2018-09-19 13:40:30', '563433', '2', 1, 0, '0000-00-00'),
(22, 'FAO Various Employees _ Frietche', 'No receipt', '2018-09-28 10:00:36', '563433', '6', 1, 0, '0000-00-00'),
(23, 'FAO Various Employees _ Frietche', 'No receipt', '2018-09-24 11:31:38', '563433', '7', 1, 0, '0000-00-00'),
(24, 'FAO Various Employees _ Frietche', 'No receipt', '2018-09-17 08:55:31', '563433', '1', 1, 0, '0000-00-00'),
(25, 'FAO Various Employees _ Frietche', 'No receipt', '2018-09-17 13:24:32', '563433', '3', 1, 0, '0000-00-00'),
(26, 'Rosend P. Rosello', 'No receipt', '2018-10-03 10:32:29', '152262', '2', 1, 0, '0000-00-00'),
(27, 'Rosend P. Rosello', 'No receipt', '2018-09-28 16:25:07', '152262', '11', 1, 0, '0000-00-00'),
(28, 'Rosend P. Rosello', 'No receipt', '2018-09-28 11:02:31', '152262', '6', 0, 0, '0000-00-00'),
(29, 'Rosend P. Rosello', 'No receipt', '2018-10-03 10:34:21', '152262', '7', 1, 0, '0000-00-00'),
(30, 'Rosend P. Rosello', 'No receipt', '2018-09-28 11:05:44', '152262', '1', 1, 0, '0000-00-00'),
(31, 'Rosend P. Rosello', 'No receipt', '2018-10-01 09:50:55', '152262', '3', 1, 0, '0000-00-00'),
(32, 'Sheryl Ruth D. Monredondo', 'No receipt', '2018-10-03 10:32:29', '123456', '2', 1, 0, '0000-00-00'),
(33, 'Sheryl Ruth D. Monredondo', 'No receipt', '2018-09-28 16:25:07', '123456', '11', 1, 0, '0000-00-00'),
(34, 'Sheryl Ruth D. Monredondo', 'No receipt', '2018-09-28 11:03:30', '123456', '6', 0, 0, '0000-00-00'),
(35, 'Sheryl Ruth D. Monredondo', 'No receipt', '2018-10-03 10:34:21', '123456', '7', 1, 0, '0000-00-00'),
(36, 'Sheryl Ruth D. Monredondo', 'No receipt', '2018-09-28 11:05:44', '123456', '1', 1, 0, '0000-00-00'),
(37, 'Sheryl Ruth D. Monredondo', 'No receipt', '2018-10-01 09:50:55', '123456', '3', 1, 0, '0000-00-00'),
(38, 'example2', 'Near expiry date', '2018-11-19 14:36:27', '345353', '2', 0, 14, '2018-12-02'),
(39, 'example2', 'Near expiry date', '2018-11-19 14:36:27', '345353', '11', 0, 14, '2018-12-02'),
(40, 'example2', 'Near expiry date', '2018-11-23 13:45:24', '345353', '6', 0, 9, '2018-12-02'),
(41, 'example2', 'Near expiry date', '2018-11-19 14:36:27', '345353', '7', 0, 14, '2018-12-02'),
(42, 'example2', 'Near expiry date', '2018-11-26 09:31:32', '345353', '1', 0, 6, '2018-12-02'),
(43, 'example2', 'Near expiry date', '2018-11-19 14:36:27', '345353', '3', 0, 14, '2018-12-02'),
(44, 'example2', 'Stale cheque', '2019-01-17 10:51:31', '345353', '2', 0, 0, '2018-12-02'),
(45, 'example2', 'Stale cheque', '2019-01-17 10:51:31', '345353', '11', 0, 0, '2018-12-02'),
(46, 'example2', 'Stale cheque', '2019-01-17 10:51:31', '345353', '6', 0, 0, '2018-12-02'),
(47, 'example2', 'Stale cheque', '2019-01-17 10:51:32', '345353', '7', 0, 0, '2018-12-02'),
(48, 'example2', 'Stale cheque', '2019-01-17 10:51:32', '345353', '1', 0, 0, '2018-12-02'),
(49, 'example2', 'Stale cheque', '2019-01-17 10:51:32', '345353', '3', 0, 0, '2018-12-02'),
(50, 'San Pedro Hospital of Davao City, Inc. 1', 'Stale cheque', '2019-01-17 10:51:32', '872167', '2', 0, 0, '2019-01-12'),
(51, 'San Pedro Hospital of Davao City, Inc. 1', 'Stale cheque', '2019-01-17 10:51:32', '872167', '11', 0, 0, '2019-01-12'),
(52, 'San Pedro Hospital of Davao City, Inc. 1', 'Stale cheque', '2019-01-17 10:51:32', '872167', '6', 0, 0, '2019-01-12'),
(53, 'San Pedro Hospital of Davao City, Inc. 1', 'Stale cheque', '2019-01-17 10:51:32', '872167', '7', 0, 0, '2019-01-12'),
(54, 'San Pedro Hospital of Davao City, Inc. 1', 'Stale cheque', '2019-01-17 10:51:32', '872167', '1', 0, 0, '2019-01-12'),
(55, 'San Pedro Hospital of Davao City, Inc. 1', 'Stale cheque', '2019-01-17 10:51:32', '872167', '3', 0, 0, '2019-01-12'),
(56, 'Fatima Nur Catering Services', 'Stale cheque', '2019-01-17 10:51:32', '123873', '2', 0, 0, '2018-12-28'),
(57, 'Fatima Nur Catering Services', 'Stale cheque', '2019-01-17 10:51:32', '123873', '11', 0, 0, '2018-12-28'),
(58, 'Fatima Nur Catering Services', 'Stale cheque', '2019-01-17 10:51:32', '123873', '6', 0, 0, '2018-12-28'),
(59, 'Fatima Nur Catering Services', 'Stale cheque', '2019-01-17 10:51:32', '123873', '7', 0, 0, '2018-12-28'),
(60, 'Fatima Nur Catering Services', 'Stale cheque', '2019-01-17 10:51:32', '123873', '1', 0, 0, '2018-12-28'),
(61, 'Fatima Nur Catering Services', 'Stale cheque', '2019-01-17 10:51:32', '123873', '3', 0, 0, '2018-12-28'),
(62, 'Jeanelle Umbay', 'Stale cheque', '2019-01-17 10:51:32', '124511', '2', 0, 0, '2018-12-26'),
(63, 'Jeanelle Umbay', 'Stale cheque', '2019-01-17 10:51:32', '124511', '11', 0, 0, '2018-12-26'),
(64, 'Jeanelle Umbay', 'Stale cheque', '2019-01-17 10:51:32', '124511', '6', 0, 0, '2018-12-26'),
(65, 'Jeanelle Umbay', 'Stale cheque', '2019-01-17 10:51:32', '124511', '7', 0, 0, '2018-12-26'),
(66, 'Jeanelle Umbay', 'Stale cheque', '2019-01-17 10:51:32', '124511', '1', 0, 0, '2018-12-26'),
(67, 'Jeanelle Umbay', 'Stale cheque', '2019-01-17 10:51:32', '124511', '3', 0, 0, '2018-12-26'),
(68, 'Pretty Umbay', 'Stale cheque', '2019-01-17 10:51:32', '124', '2', 0, 0, '2018-12-26'),
(69, 'Pretty Umbay', 'Stale cheque', '2019-01-17 10:51:32', '124', '11', 0, 0, '2018-12-26'),
(70, 'Pretty Umbay', 'Stale cheque', '2019-01-17 10:51:32', '124', '6', 0, 0, '2018-12-26'),
(71, 'Pretty Umbay', 'Stale cheque', '2019-01-17 10:51:32', '124', '7', 0, 0, '2018-12-26'),
(72, 'Pretty Umbay', 'Stale cheque', '2019-01-17 10:51:32', '124', '1', 0, 0, '2018-12-26'),
(73, 'Pretty Umbay', 'Stale cheque', '2019-01-17 10:51:32', '124', '3', 0, 0, '2018-12-26'),
(74, 'Neil Jay Umbay', 'Stale cheque', '2019-01-17 10:51:33', '132444', '2', 0, 0, '2018-12-26'),
(75, 'Neil Jay Umbay', 'Stale cheque', '2019-01-17 10:51:33', '132444', '11', 0, 0, '2018-12-26'),
(76, 'Neil Jay Umbay', 'Stale cheque', '2019-01-17 10:51:33', '132444', '6', 0, 0, '2018-12-26'),
(77, 'Neil Jay Umbay', 'Stale cheque', '2019-01-17 10:51:33', '132444', '7', 0, 0, '2018-12-26'),
(78, 'Neil Jay Umbay', 'Stale cheque', '2019-01-17 10:51:33', '132444', '1', 0, 0, '2018-12-26'),
(79, 'Neil Jay Umbay', 'Stale cheque', '2019-01-17 10:51:33', '132444', '3', 0, 0, '2018-12-26'),
(80, 'San Pedro Hospital of Davao City, Inc.', 'Stale cheque', '2019-01-17 10:51:33', '326462', '2', 0, 0, '2018-12-12'),
(81, 'San Pedro Hospital of Davao City, Inc.', 'Stale cheque', '2019-01-17 10:51:33', '326462', '11', 0, 0, '2018-12-12'),
(82, 'San Pedro Hospital of Davao City, Inc.', 'Stale cheque', '2019-01-17 10:51:33', '326462', '6', 0, 0, '2018-12-12'),
(83, 'San Pedro Hospital of Davao City, Inc.', 'Stale cheque', '2019-01-17 10:51:33', '326462', '7', 0, 0, '2018-12-12'),
(84, 'San Pedro Hospital of Davao City, Inc.', 'Stale cheque', '2019-01-17 10:51:33', '326462', '1', 0, 0, '2018-12-12'),
(85, 'San Pedro Hospital of Davao City, Inc.', 'Stale cheque', '2019-01-17 10:51:33', '326462', '3', 0, 0, '2018-12-12'),
(86, 'KC NCDDP BSPMC POCALEEL', 'Stale cheque', '2019-01-17 10:51:33', '125215', '2', 0, 0, '2018-12-12'),
(87, 'KC NCDDP BSPMC POCALEEL', 'Stale cheque', '2019-01-17 10:51:33', '125215', '11', 0, 0, '2018-12-12'),
(88, 'KC NCDDP BSPMC POCALEEL', 'Stale cheque', '2019-01-17 10:51:33', '125215', '6', 0, 0, '2018-12-12'),
(89, 'KC NCDDP BSPMC POCALEEL', 'Stale cheque', '2019-01-17 10:51:33', '125215', '7', 0, 0, '2018-12-12'),
(90, 'KC NCDDP BSPMC POCALEEL', 'Stale cheque', '2019-01-17 10:51:33', '125215', '1', 0, 0, '2018-12-12'),
(91, 'KC NCDDP BSPMC POCALEEL', 'Stale cheque', '2019-01-17 10:51:33', '125215', '3', 0, 0, '2018-12-12'),
(92, 'Marvin S. Gil', 'Stale cheque', '2019-01-17 10:51:33', '564646', '2', 0, 0, '2018-12-12'),
(93, 'Marvin S. Gil', 'Stale cheque', '2019-01-17 10:51:33', '564646', '11', 0, 0, '2018-12-12'),
(94, 'Marvin S. Gil', 'Stale cheque', '2019-01-17 10:51:33', '564646', '6', 0, 0, '2018-12-12'),
(95, 'Marvin S. Gil', 'Stale cheque', '2019-01-17 10:51:33', '564646', '7', 0, 0, '2018-12-12'),
(96, 'Marvin S. Gil', 'Stale cheque', '2019-01-17 10:51:33', '564646', '1', 0, 0, '2018-12-12'),
(97, 'Marvin S. Gil', 'Stale cheque', '2019-01-17 10:51:33', '564646', '3', 0, 0, '2018-12-12'),
(98, 'Apo View Hotel', 'Stale cheque', '2019-01-17 10:51:33', '866456', '2', 0, 0, '2018-12-12'),
(99, 'Apo View Hotel', 'Stale cheque', '2019-01-17 10:51:33', '866456', '11', 0, 0, '2018-12-12'),
(100, 'Apo View Hotel', 'Stale cheque', '2019-01-17 10:51:33', '866456', '6', 0, 0, '2018-12-12'),
(101, 'Apo View Hotel', 'Stale cheque', '2019-01-17 10:51:33', '866456', '7', 0, 0, '2018-12-12'),
(102, 'Apo View Hotel', 'Stale cheque', '2019-01-17 10:51:33', '866456', '1', 0, 0, '2018-12-12'),
(103, 'Apo View Hotel', 'Stale cheque', '2019-01-17 10:51:33', '866456', '3', 0, 0, '2018-12-12'),
(104, 'Nabunturan Sanitary Restaurant', 'Stale cheque', '2019-01-17 10:51:33', '1234567', '2', 0, 0, '2018-12-24'),
(105, 'Nabunturan Sanitary Restaurant', 'Stale cheque', '2019-01-17 10:51:33', '1234567', '11', 0, 0, '2018-12-24'),
(106, 'Nabunturan Sanitary Restaurant', 'Stale cheque', '2019-01-17 10:51:33', '1234567', '6', 0, 0, '2018-12-24'),
(107, 'Nabunturan Sanitary Restaurant', 'Stale cheque', '2019-01-17 10:51:33', '1234567', '7', 0, 0, '2018-12-24'),
(108, 'Nabunturan Sanitary Restaurant', 'Stale cheque', '2019-01-17 10:51:33', '1234567', '1', 0, 0, '2018-12-24'),
(109, 'Nabunturan Sanitary Restaurant', 'Stale cheque', '2019-01-17 10:51:33', '1234567', '3', 0, 0, '2018-12-24'),
(110, 'PLDT Inc.', 'Stale cheque', '2019-01-17 10:51:33', '2345678', '2', 0, 0, '2018-12-24'),
(111, 'PLDT Inc.', 'Stale cheque', '2019-01-17 10:51:33', '2345678', '11', 0, 0, '2018-12-24'),
(112, 'PLDT Inc.', 'Stale cheque', '2019-01-17 10:51:33', '2345678', '6', 0, 0, '2018-12-24'),
(113, 'PLDT Inc.', 'Stale cheque', '2019-01-17 10:51:33', '2345678', '7', 0, 0, '2018-12-24'),
(114, 'PLDT Inc.', 'Stale cheque', '2019-01-17 10:51:33', '2345678', '1', 0, 0, '2018-12-24'),
(115, 'PLDT Inc.', 'Stale cheque', '2019-01-17 10:51:33', '2345678', '3', 0, 0, '2018-12-24'),
(116, 'Atty. Emmanuel P. Galicia Jr.', 'Stale cheque', '2019-01-17 10:51:33', '764653', '2', 0, 0, '2018-12-24'),
(117, 'Atty. Emmanuel P. Galicia Jr.', 'Stale cheque', '2019-01-17 10:51:33', '764653', '11', 0, 0, '2018-12-24'),
(118, 'Atty. Emmanuel P. Galicia Jr.', 'Stale cheque', '2019-01-17 10:51:33', '764653', '6', 0, 0, '2018-12-24'),
(119, 'Atty. Emmanuel P. Galicia Jr.', 'Stale cheque', '2019-01-17 10:51:33', '764653', '7', 0, 0, '2018-12-24'),
(120, 'Atty. Emmanuel P. Galicia Jr.', 'Stale cheque', '2019-01-17 10:51:33', '764653', '1', 0, 0, '2018-12-24'),
(121, 'Atty. Emmanuel P. Galicia Jr.', 'Stale cheque', '2019-01-17 10:51:33', '764653', '3', 0, 0, '2018-12-24');

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `v_num` int(250) NOT NULL,
  `date_encoded` date NOT NULL,
  `time_encoded` time NOT NULL,
  `payee` varchar(100) NOT NULL,
  `particular` varchar(100) NOT NULL,
  `period_from` date NOT NULL,
  `period_to` date NOT NULL,
  `et_al` varchar(100) NOT NULL,
  `ob_num` varchar(100) NOT NULL,
  `gross` double NOT NULL,
  `net` double NOT NULL,
  `fund` enum('101','102','171','101-184') NOT NULL,
  `program` enum('BANG-UN','CBB','CENTENARIAN','CENTER','CENTER BASED','COMMUNITY BASED','COMPREHENSIVE','DRRP PROPER/CC','GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)','ICTMS','KALAHI-NCDDP ADB','KALAHI-NCDDP GOP','KALAHI-NCDDP WB','KC-PAMANA','NEW TRUST FUND','NHTSPR','PANTAWID','PDPB','PRPTP','PSF ADOPTION','PSP-AICS CURRENT CMF','PWD/DP','REGULAR TRUST FUND','SB','SFP','SLP (DR)','SOCTECH','SP (DR)','TARA','UCT VALIDATION','UWATO') NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `status` enum('for_issuance','for_claim/for_or','claimed','cancelled','expired') NOT NULL,
  `payment_type` enum('ADA','cheque') NOT NULL,
  `payee_type` enum('creditor','employee') NOT NULL,
  `warrant_num` varchar(100) NOT NULL,
  `date_released` date NOT NULL,
  `date_claimed` date NOT NULL,
  `claimed_by` varchar(100) NOT NULL,
  `released_tagger` varchar(100) NOT NULL,
  `claimed_tagger` varchar(100) NOT NULL,
  `cancelled_tagger` varchar(100) NOT NULL,
  `or_num` varchar(100) NOT NULL,
  `date_issue` date NOT NULL,
  `date_expire` date NOT NULL,
  `notif_reference` int(100) NOT NULL,
  `date_cancelled` date NOT NULL,
  `re_issued_by` varchar(50) NOT NULL,
  `date_re_issued` date NOT NULL,
  `cancel_remarks` varchar(50) NOT NULL,
  `encoded_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vouchers`
--

INSERT INTO `vouchers` (`v_num`, `date_encoded`, `time_encoded`, `payee`, `particular`, `period_from`, `period_to`, `et_al`, `ob_num`, `gross`, `net`, `fund`, `program`, `remarks`, `status`, `payment_type`, `payee_type`, `warrant_num`, `date_released`, `date_claimed`, `claimed_by`, `released_tagger`, `claimed_tagger`, `cancelled_tagger`, `or_num`, `date_issue`, `date_expire`, `notif_reference`, `date_cancelled`, `re_issued_by`, `date_re_issued`, `cancel_remarks`, `encoded_by`) VALUES
(71, '2018-09-11', '09:30:05', 'Marco Polo Davao', 'To payment of food and accommodation during the conduct of Capability Building on the Assessment Dis', '0000-00-00', '0000-00-00', '', '01-0001', 182812.5, 182812.5, '101', 'REGULAR TRUST FUND', 'RJJWC-Trust Fund', 'claimed', 'cheque', 'creditor', '414153', '2018-09-12', '2018-09-12', 'Georgina Cruz', 'Jhon Danielle Lauderis Umbay ', 'Jhon Danielle Lauderis Umbay ', '', '875755', '2018-09-12', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', ''),
(73, '2018-09-11', '09:32:32', 'Globo Asiatico Enterprises Inc.', 'To payment of purchase medicines for LSM clients', '2017-10-13', '2017-11-13', '', '01-0003', 100000, 94642.33, '101', 'BANG-UN', 'Lingap Sa Masa-Trust Fund', 'cancelled', 'cheque', 'creditor', '', '0000-00-00', '0000-00-00', '', '', '', 'Jhon Danielle Lauderis Umbay ', '', '0000-00-00', '0000-00-00', 0, '2018-11-14', 'Jhon Danielle Lauderis Umbay ', '2018-10-03', 'remarks', ''),
(74, '2018-09-11', '09:33:55', 'Technobio Marketing', 'To payment of purchase medicines for CIU clients', '2017-11-09', '2017-11-17', '', '01-0004', 101847, 96390.86, '101', 'PANTAWID', '', 'cancelled', 'cheque', 'creditor', '', '0000-00-00', '0000-00-00', '', '', '', 'Jhon Danielle Lauderis Umbay ', '', '0000-00-00', '0000-00-00', 0, '2018-11-14', '', '0000-00-00', 'remarks', ''),
(75, '2018-09-11', '09:35:12', 'DASURECO', 'To payment for the electric bill ', '2017-09-01', '2017-11-01', '', '01-0005', 7499.64, 7499.64, '101', 'PANTAWID', 'AP # 207', 'cancelled', 'cheque', 'creditor', '', '0000-00-00', '0000-00-00', '', '', '', 'Jhon Danielle Lauderis Umbay ', '', '0000-00-00', '0000-00-00', 0, '2018-11-14', 'Jhon Danielle Lauderis Umbay ', '2018-11-14', 'remarks', ''),
(76, '2018-09-09', '09:36:08', 'BIR', 'To payment of BIR remittances charged under New Trust Fund', '2017-12-01', '2017-12-31', '', '01-0006', 3991.17, 3991.17, '101', 'BANG-UN', '', 'claimed', 'ADA', 'creditor', '252622', '2018-09-09', '2018-09-14', 'Kokoy Mendoza', 'Jhon Danielle Lauderis Umbay ', 'Jhon Danielle Lauderis Umbay ', '', '893658', '2018-09-14', '0000-00-00', 1, '0000-00-00', '', '0000-00-00', '', ''),
(77, '2018-09-11', '09:37:15', 'Atty. Emmanuel P. Galicia Jr.', 'To payment as Honorarium as CWSG member during the conduct of Regional Matching Conference held at C', '2017-12-29', '2017-12-29', '', '12-9385', 3000, 3000, '101', 'COMMUNITY BASED', 'AP# 204', 'expired', 'cheque', 'employee', '764653', '2018-09-24', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', 'Jhon Danielle Lauderis Umbay ', '', '0000-00-00', '2018-12-24', 0, '2018-11-14', 'Jhon Danielle Lauderis Umbay ', '2018-11-14', 'remarks', ''),
(78, '2018-09-11', '09:38:32', 'DCWD', 'To payment of water bill', '2017-11-05', '2017-12-27', '', '12-793', 1207.3, 1207.3, '102', 'KALAHI-NCDDP WB', 'AP# 14', 'cancelled', 'cheque', 'creditor', '', '0000-00-00', '0000-00-00', '', '', '', 'Jhon Danielle Lauderis Umbay ', '', '0000-00-00', '0000-00-00', 0, '2018-11-14', 'Danica Mae Lauderis Umbay ', '2018-10-03', 'remarks', ''),
(79, '2018-09-11', '09:39:09', 'Rosend P. Rosello', 'For payment of services rendered for Malawakang Kumustahan Project Fund MOA', '2017-12-06', '2017-12-31', '', '11-1465', 2781.39, 2781.39, '101', 'PANTAWID', 'DOE 135', 'claimed', 'ADA', 'employee', '152262', '2018-09-25', '2018-09-27', '', 'Jhon Danielle Lauderis Umbay ', '', '', '', '0000-00-00', '0000-00-00', 1, '0000-00-00', '', '0000-00-00', '', ''),
(80, '2018-09-11', '09:41:48', 'Jovelyn Maton', 'To payment for service provider of KC-Tier II MOA', '2017-12-01', '2017-12-15', '', '12-800', 17591.35, 15304.47, '102', 'KALAHI-NCDDP ADB', 'DOE 16', 'cancelled', 'cheque', 'creditor', '', '0000-00-00', '0000-00-00', '', '', '', 'Jhon Danielle Lauderis Umbay ', '', '0000-00-00', '0000-00-00', 0, '2018-11-14', '', '0000-00-00', 'remarks', ''),
(81, '2018-09-11', '09:45:34', 'Fatima Nur Catering Services', 'To payment for catering services during the conduct of BARR', '2017-11-25', '2017-11-29', 'sydrikk', '02-25', 30000, 28500, '102', 'KALAHI-NCDDP WB', 'AP# 2', 'for_claim/for_or', 'cheque', 'creditor', '', '2018-09-28', '0000-00-00', '', 'Danica Mae Lauderis Umbay ', '', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', ''),
(82, '2018-09-11', '09:46:00', 'San Pedro Hospital of Davao City, Inc.', 'Medical Assistance', '0000-00-00', '0000-00-00', 'Marianne Grace B. Aguiling et. Al.', '12-8803', 133000, 133000, '101', 'COMPREHENSIVE', 'AICS-CF (CMF)', 'for_claim/for_or', 'cheque', 'creditor', '', '2018-09-12', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', '', '', '0000-00-00', '0000-00-00', 1, '0000-00-00', '', '0000-00-00', '', ''),
(83, '2018-09-11', '09:47:24', 'FAO Various Employees', 'Reimbursement of travel expenses of SLP', '2017-09-01', '2017-10-31', 'Jhovanie M. Casallas et. Al.', '12-9372', 62928, 62928, '101', 'SLP (DR)', 'DOE 322', 'for_claim/for_or', 'ADA', 'creditor', '', '2018-09-14', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', ''),
(84, '2018-09-11', '09:47:54', 'FAO Various Employees', 'To reimburse travelling expenses incurred by KC-NCDDP MOA', '2017-11-01', '2017-11-30', 'Fatima A. Guerena et. Al.', '12-761', 106990, 106990, '102', 'KALAHI-NCDDP WB', 'DOE 11', 'for_claim/for_or', 'cheque', 'creditor', '', '2018-09-12', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', ''),
(85, '2018-09-11', '09:48:41', 'Sheryl Ruth D. Monredondo', 'Reimursement of TEV', '2017-12-01', '0000-00-00', '', '12-9137', 2078, 2078, '101', 'COMPREHENSIVE', 'DOE 339', 'claimed', 'ADA', 'employee', '123456', '2018-09-25', '2018-09-27', '', 'Jhon Danielle Lauderis Umbay ', '', '', '', '0000-00-00', '0000-00-00', 1, '0000-00-00', '', '0000-00-00', '', ''),
(86, '2018-09-11', '09:50:00', 'Southeastern Mindanao Institute of Technology (SMIT), Inc.', 'To refund of performance security for the provision community-based technical and vocation training ', '0000-00-00', '0000-00-00', '', '01-0007', 425102.04, 425102.04, '101', 'PSF ADOPTION', '', 'cancelled', 'cheque', 'creditor', '112311', '2018-09-26', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', 'Jhon Danielle Lauderis Umbay ', '', '0000-00-00', '0000-00-00', 0, '2018-11-14', 'Jhon Danielle Lauderis Umbay ', '2018-11-14', 'remarks', ''),
(87, '2018-09-11', '09:50:48', 'PLDT Inc.', 'To payment of telephone bill with tel. number 224-2643', '2017-12-01', '2017-12-31', '', '12-854', 1109.93, 1040.56, '102', 'KALAHI-NCDDP WB', 'AP# 66', 'expired', 'cheque', 'creditor', '2345678', '2018-09-24', '0000-00-00', '', 'Cherry Pearl Fajardo Majadas ', '', '', '', '0000-00-00', '2018-12-24', 0, '0000-00-00', '', '0000-00-00', '', ''),
(89, '2018-09-11', '09:52:40', 'Nabunturan Sanitary Restaurant', 'To payment of catering services during conduct of Mun. Fiduciary Workshop ', '2017-10-20', '2017-11-08', '', '09-506', 15750, 14765.63, '102', 'KALAHI-NCDDP ADB', 'AP # 24', 'expired', 'cheque', 'creditor', '1234567', '2018-09-24', '0000-00-00', '', 'Cherry Pearl Fajardo Majadas ', '', '', '', '0000-00-00', '2018-12-24', 0, '0000-00-00', '', '0000-00-00', '', ''),
(90, '2018-09-11', '09:54:13', 'KC NCDDP BSPMC POCALEEL', 'Concreting of 465 Linear Meter Brgy. Road', '0000-00-00', '0000-00-00', 'Kiblawan, Davao del Sur', '05-287', 568173, 568173, '102', 'KALAHI-NCDDP WB', '', 'for_claim/for_or', 'cheque', 'creditor', '', '2018-09-12', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', ''),
(91, '2018-09-11', '09:56:10', 'DSWD KALAHI CIDSS NCDDP PAGSABANGAN', 'Upgrading of 408 L.I.M. Community Access Road', '0000-00-00', '0000-00-00', 'New Bataan Compostela Valley', '2016-07-501', 697612.2, 697612.2, '102', 'KALAHI-NCDDP ADB', '', 'for_claim/for_or', 'cheque', 'creditor', '', '2018-09-12', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', ''),
(92, '2018-09-11', '09:58:45', 'Apo View Hotel', 'To payment of food and accommodation for Mid Year LGU Forum', '2017-07-27', '2017-07-29', '', '02-120', 109500, 102656.25, '102', 'KALAHI-NCDDP ADB', 'AP# 30', 'expired', 'cheque', 'creditor', '866456', '2018-09-12', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', '', '', '0000-00-00', '2018-12-12', 0, '0000-00-00', '', '0000-00-00', '', ''),
(93, '2018-09-11', '10:00:48', 'Marvin S. Gil', 'To payment for service provider of KC-Tier II MOA ', '2017-12-16', '2017-12-31', '', '12-817', 23810.85, 20715.44, '102', 'KALAHI-NCDDP ADB', 'DOE 121', 'expired', 'cheque', 'creditor', '564646', '2018-09-12', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', '', '', '0000-00-00', '2018-12-12', 0, '0000-00-00', '', '0000-00-00', '', ''),
(94, '2018-05-20', '09:56:10', 'DSWD KALAHI CIDSS NCDDP PAGSABANGAN - Cherry', 'Upgrading of 408 L.I.M. Community Access Road', '0000-00-00', '0000-00-00', 'New Bataan Compostela Valley', '2016-07-501', 300000, 300000, '102', 'KALAHI-NCDDP ADB', '', 'expired', 'cheque', 'creditor', '345662', '2018-05-20', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', '', '', '0000-00-00', '2018-08-20', 0, '0000-00-00', '', '0000-00-00', '', ''),
(95, '2018-05-20', '09:56:10', 'DSWD KALAHI CIDSS NCDDP PAGSABANGAN - Syra', 'Upgrading of 408 L.I.M. Community Access Road', '0000-00-00', '0000-00-00', 'New Bataan Compostela Valley', '2016-07-501', 397612.2, 397612.2, '102', 'KALAHI-NCDDP ADB', '', 'expired', 'cheque', 'creditor', '472472', '2018-05-20', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', '', '', '0000-00-00', '2018-08-20', 0, '0000-00-00', '', '0000-00-00', '', ''),
(97, '2018-09-11', '09:54:13', 'KC NCDDP BSPMC POCALEEL', 'Concreting of 465 Linear Meter Brgy. Road', '0000-00-00', '0000-00-00', '', '05-287', 468173, 468173, '102', 'KALAHI-NCDDP WB', '', 'cancelled', 'cheque', 'creditor', '235321', '2018-09-12', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', 'Jhon Danielle Lauderis Umbay ', '', '0000-00-00', '0000-00-00', 0, '2018-11-14', 'Jhon Danielle Lauderis Umbay ', '2018-11-14', 'remarks', ''),
(98, '2018-09-11', '09:54:13', 'KC NCDDP BSPMC POCALEEL', 'Concreting of 465 Linear Meter Brgy. Road', '0000-00-00', '0000-00-00', '', '05-287', 100000, 100000, '102', 'KALAHI-NCDDP WB', '', 'expired', 'cheque', 'creditor', '125215', '2018-09-12', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', 'Jhon Danielle Lauderis Umbay ', '', '0000-00-00', '2018-12-12', 0, '2018-11-14', 'Jhon Danielle Lauderis Umbay ', '2018-11-14', 'remarks', ''),
(99, '2018-09-11', '09:46:00', 'San Pedro Hospital of Davao City, Inc.', 'Medical Assistance', '0000-00-00', '0000-00-00', '', '12-8803', 33000, 33000, '101', 'COMPREHENSIVE', 'AICS-CF (CMF)', 'claimed', 'cheque', 'creditor', '435225', '2018-09-12', '2018-09-24', 'cherry pearl', 'Jhon Danielle Lauderis Umbay ', 'Hannah Cake Baker ', '', '290100', '2018-09-24', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', ''),
(100, '2018-09-11', '09:46:00', 'San Pedro Hospital of Davao City, Inc.', 'Medical Assistance', '0000-00-00', '0000-00-00', '', '12-8803', 100000, 100000, '101', 'COMPREHENSIVE', 'AICS-CF (CMF)', 'expired', 'cheque', 'creditor', '326462', '2018-09-12', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', 'Jhon Danielle Lauderis Umbay ', '', '0000-00-00', '2018-12-12', 0, '2018-11-14', 'Jhon Danielle Lauderis Umbay ', '2018-11-14', 'remarks', ''),
(101, '2018-09-11', '09:47:54', 'FAO Various Employees - cherry', 'To reimburse travelling expenses incurred by KC-NCDDP MOA', '2017-11-01', '2017-11-30', '', '12-761', 51121, 51121, '102', 'KALAHI-NCDDP WB', 'DOE 11', 'claimed', 'cheque', 'creditor', '352535', '2018-09-12', '2018-09-14', 'Harry Fox', 'Jhon Danielle Lauderis Umbay ', 'Jhon Danielle Lauderis Umbay ', '', '456272', '2018-09-14', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', ''),
(102, '2018-09-11', '09:47:54', 'FAO Various Employees -  syra', 'To reimburse travelling expenses incurred by KC-NCDDP MOA', '2017-11-01', '2017-11-30', '', '12-761', 20000, 20000, '102', 'KALAHI-NCDDP WB', 'DOE 11', 'claimed', 'cheque', 'creditor', '462366', '2018-09-12', '2018-09-24', 'David Gomez', 'Jhon Danielle Lauderis Umbay ', 'Jhon Danielle Lauderis Umbay ', '', '866688', '2018-09-24', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', ''),
(103, '2018-09-11', '09:47:24', 'FAO Various Employees - Iris', 'Reimbursement of travel expenses of SLP', '2017-09-01', '2017-10-31', '', '12-9372', 32938, 32938, '101', 'SLP (DR)', 'DOE 322', 'claimed', 'ADA', 'creditor', '674533', '2018-09-14', '2018-09-28', 'Iris', 'Jhon Danielle Lauderis Umbay ', 'Jhon Danielle Lauderis Umbay ', '', '532522', '2018-09-28', '0000-00-00', 1, '0000-00-00', '', '0000-00-00', '', ''),
(104, '2018-09-11', '09:47:24', 'FAO Various Employees _ Frietche', 'Reimbursement of travel expenses of SLP', '2017-09-01', '2017-10-31', '', '12-9372', 29990, 29990, '101', 'SLP (DR)', 'DOE 322', 'claimed', 'ADA', 'creditor', '563433', '2018-09-14', '2018-09-21', 'Francis Moreno', 'Jhon Danielle Lauderis Umbay ', 'Danica Mae Lauderis Umbay ', '', '823641', '2018-09-21', '0000-00-00', 1, '0000-00-00', '', '0000-00-00', '', ''),
(105, '2018-09-19', '08:44:52', 'Fao Various Employees', 'To reimburse travelling expenses incurred by KC-MOA(NCDDP) workers', '2018-08-01', '2018-09-30', 'Nick Elvi Digol et. Al.', '12-864', 19115, 19000, '102', 'BANG-UN', 'DOE-AP 11', 'cancelled', 'cheque', 'employee', '', '0000-00-00', '0000-00-00', '', '', '', 'Jhon Danielle Lauderis Umbay ', '', '0000-00-00', '0000-00-00', 0, '2018-11-14', 'Jhon Danielle Lauderis Umbay ', '2018-10-03', 'remarks', ''),
(106, '2018-09-24', '09:20:21', 'Teddy Adlawan', 'To payment for the electric bill ', '0000-00-00', '0000-00-00', 'Pipo Villaluna et al.', '12-232343', 50900, 50500, '171', 'NHTSPR', '', 'for_claim/for_or', 'cheque', 'employee', '', '2018-09-24', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', ''),
(107, '2018-09-24', '09:20:21', 'Teddy Adlawan', 'To payment for the electric bill ', '0000-00-00', '0000-00-00', '', '12-232343', 30000, 30000, '171', 'NHTSPR', '', 'cancelled', 'cheque', 'creditor', '345432', '2018-09-24', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', 'Jhon Danielle Lauderis Umbay ', '', '0000-00-00', '0000-00-00', 0, '2018-11-14', '', '0000-00-00', 'remarks', ''),
(108, '2018-09-24', '09:20:21', 'Pipo Villaluna', 'To payment for the electric bill ', '0000-00-00', '0000-00-00', '', '12-232343', 20900, 20900, '171', 'NHTSPR', '', 'cancelled', 'cheque', 'creditor', '345322', '2018-09-24', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', 'Jhon Danielle Lauderis Umbay ', '', '0000-00-00', '0000-00-00', 0, '2018-10-03', '', '0000-00-00', '', ''),
(109, '2018-09-24', '10:43:50', 'Red Ribbon', 'To payment of food for Interns', '0000-00-00', '0000-00-00', 'Henry et al.', '12-8181', 20000, 20000, '101-184', 'KALAHI-NCDDP ADB', '', 'for_claim/for_or', 'cheque', 'employee', '', '2018-09-27', '0000-00-00', '', 'Cherry Pearl Fajardo Majadas ', '', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', ''),
(110, '2018-09-26', '03:25:47', 'Neil Jay Umbay', 'To payment for food and accomodation', '0000-00-00', '0000-00-00', 'Kyle Umbay', '01-2991', 10000, 10000, '101-184', 'KALAHI-NCDDP ADB', 'AP# 616', 'for_claim/for_or', 'cheque', 'creditor', '', '2018-09-26', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', ''),
(111, '2018-09-26', '03:25:47', 'Neil Jay Umbay', 'To payment for food and accomodation', '0000-00-00', '0000-00-00', '', '01-2991', 5000, 5000, '101-184', 'KALAHI-NCDDP ADB', 'AP# 616', 'expired', 'cheque', 'creditor', '132444', '2018-09-26', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', '', '', '0000-00-00', '2018-12-26', 0, '0000-00-00', '', '0000-00-00', '', ''),
(112, '2018-09-26', '03:25:47', 'Kyle Umbay', 'To payment for food and accomodation', '0000-00-00', '0000-00-00', '', '01-2991', 5000, 5000, '101-184', 'KALAHI-NCDDP ADB', 'AP# 616', 'cancelled', 'cheque', 'creditor', '341113', '2018-09-26', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', 'Jhon Danielle Lauderis Umbay ', '', '0000-00-00', '0000-00-00', 0, '2018-11-14', 'Jhon Danielle Lauderis Umbay ', '2018-11-14', 'remarks', ''),
(113, '2018-09-26', '10:59:00', 'Chloe Kate Fajardo', 'To payment of water bill', '0000-00-00', '0000-00-00', 'Marjun Et al.', '02-1291', 10000, 10000, '171', 'NHTSPR', '', 'for_claim/for_or', 'cheque', 'creditor', '', '2018-09-26', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', ''),
(118, '2018-09-26', '11:40:30', 'Chloe Umbay', 'To payment of food and accommodation during the conduct of Capability Building on the Assessment Dis', '0000-00-00', '0000-00-00', 'Jeanelle Et al.', '01-1939', 10000, 10000, '171', 'CBB', '', 'for_claim/for_or', 'cheque', 'creditor', '', '2018-09-26', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', ''),
(119, '2018-09-26', '11:40:30', 'Chloe Umbay', 'To payment of food and accommodation during the conduct of Capability Building on the Assessment Dis', '0000-00-00', '0000-00-00', '', '01-1939', 5000, 5000, '171', 'CBB', '', 'cancelled', 'cheque', 'creditor', '278588', '2018-09-26', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', 'Jhon Danielle Lauderis Umbay ', '', '0000-00-00', '0000-00-00', 0, '2018-11-14', '', '0000-00-00', 'remarks', ''),
(120, '2018-09-26', '11:40:30', 'Pretty Umbay', 'To payment of food and accommodation during the conduct of Capability Building on the Assessment Dis', '0000-00-00', '0000-00-00', '', '01-1939', 2500, 2500, '171', 'CBB', '', 'expired', 'cheque', 'creditor', '124', '2018-09-26', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', 'Jhon Danielle Lauderis Umbay ', '', '0000-00-00', '2018-12-26', 0, '2018-11-14', 'Jhon Danielle Lauderis Umbay ', '2018-11-14', 'remarks', ''),
(121, '2018-09-26', '11:40:30', 'Jeanelle Umbay', 'To payment of food and accommodation during the conduct of Capability Building on the Assessment Dis', '0000-00-00', '0000-00-00', '', '01-1939', 2500, 2500, '171', 'CBB', '', 'expired', 'cheque', 'creditor', '124511', '2018-09-26', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', 'Jhon Danielle Lauderis Umbay ', '', '0000-00-00', '2018-12-26', 0, '2018-11-14', 'Jhon Danielle Lauderis Umbay ', '2018-11-14', 'remarks', ''),
(122, '2018-09-26', '11:40:30', 'Chloe Umbay', 'To payment of food and accommodation during the conduct of Capability Building on the Assessment Dis', '0000-00-00', '0000-00-00', '', '01-1939', 5000, 5000, '171', 'CBB', '', 'cancelled', 'cheque', 'creditor', '274322', '2018-09-26', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', 'Jhon Danielle Lauderis Umbay ', '', '0000-00-00', '0000-00-00', 0, '2018-11-14', '', '0000-00-00', 'remarks', ''),
(123, '2018-09-26', '11:40:30', 'Pretty Umbay', 'To payment of food and accommodation during the conduct of Capability Building on the Assessment Dis', '0000-00-00', '0000-00-00', '', '01-1939', 2500, 2500, '171', 'CBB', '', 'cancelled', 'cheque', 'creditor', '124133', '2018-09-26', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', 'Jhon Danielle Lauderis Umbay ', '', '0000-00-00', '0000-00-00', 0, '2018-11-14', '', '0000-00-00', 'remarks', ''),
(124, '2018-09-26', '11:40:30', 'Jeanelle Umbay', 'To payment of food and accommodation during the conduct of Capability Building on the Assessment Dis', '0000-00-00', '0000-00-00', '', '01-1939', 2500, 2500, '171', 'CBB', '', 'cancelled', 'cheque', 'creditor', '124122', '2018-09-26', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', 'Jhon Danielle Lauderis Umbay ', '', '0000-00-00', '0000-00-00', 0, '2018-11-14', '', '0000-00-00', 'remarks', ''),
(133, '2018-09-26', '10:59:00', 'Chloe Kate Fajardo', 'To payment of water bill', '0000-00-00', '0000-00-00', '', '02-1291', 5000, 5000, '171', 'NHTSPR', '', 'cancelled', 'cheque', 'creditor', '187322', '2018-09-26', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', 'Jhon Danielle Lauderis Umbay ', '', '0000-00-00', '0000-00-00', 0, '2018-11-14', '', '0000-00-00', 'remarks', ''),
(134, '2018-09-26', '10:59:00', 'Lebron Fajardo', 'To payment of water bill', '0000-00-00', '0000-00-00', '', '02-1291', 2500, 2500, '171', 'NHTSPR', '', 'cancelled', 'cheque', 'creditor', '223429', '2018-09-26', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', 'Jhon Danielle Lauderis Umbay ', '', '0000-00-00', '0000-00-00', 0, '2018-11-14', '', '0000-00-00', 'remarks', ''),
(135, '2018-09-26', '10:59:00', 'Stephen Fajardo', 'To payment of water bill', '0000-00-00', '0000-00-00', '', '02-1291', 2500, 2500, '171', 'NHTSPR', '', 'claimed', 'cheque', 'creditor', '309234', '2018-09-26', '2018-09-28', 'Inday Tanini', 'Jhon Danielle Lauderis Umbay ', 'Cherry Pearl Fajardo Majadas ', '', '12002', '2018-09-28', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', ''),
(136, '2018-09-26', '04:01:26', 'University of Southeaster Philippines', 'To payment for educational assistance', '0000-00-00', '0000-00-00', 'Perfecto Alibin et al', '121123', 29000, 29000, '171', 'ICTMS', '', 'for_claim/for_or', 'cheque', 'creditor', '', '2018-09-26', '0000-00-00', '', 'Cherry Pearl Fajardo Majadas ', '', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', ''),
(137, '2018-09-26', '04:01:26', 'University of Southeaster Philippines', 'To payment for educational assistance', '0000-00-00', '0000-00-00', '', '121123', 8000, 8000, '171', 'ICTMS', '', 'claimed', 'cheque', 'creditor', '123', '2018-09-26', '2018-09-28', 'Yaya Ozawa', 'Cherry Pearl Fajardo Majadas ', 'Cherry Pearl Fajardo Majadas ', '', '9829', '2018-09-28', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', ''),
(138, '2018-09-26', '04:01:26', 'umbay', 'To payment for educational assistance', '0000-00-00', '0000-00-00', '', '121123', 21000, 21000, '171', 'ICTMS', '', 'claimed', 'cheque', 'creditor', '1234', '2018-09-26', '2018-09-28', 'Coco Martin', 'Cherry Pearl Fajardo Majadas ', 'Cherry Pearl Fajardo Majadas ', '', '128763', '2018-09-28', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', ''),
(139, '2018-09-24', '10:43:50', 'Red Ribbon', 'To payment of food for Interns', '0000-00-00', '0000-00-00', '', '12-8181', 10000, 10000, '101-184', 'KALAHI-NCDDP ADB', '', 'claimed', 'cheque', 'creditor', '762', '2018-09-27', '2018-09-26', 'cherrypearl', 'Cherry Pearl Fajardo Majadas ', 'Jhon Danielle Lauderis Umbay ', '', '121233333', '2018-09-26', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', ''),
(140, '2018-09-24', '10:43:50', 'Red Ribbon12', 'To payment of food for Interns', '0000-00-00', '0000-00-00', '', '12-8181', 10000, 10000, '101-184', 'KALAHI-NCDDP ADB', '', 'claimed', 'cheque', 'creditor', '7621', '2018-09-27', '2018-09-26', 'syralynn', 'Cherry Pearl Fajardo Majadas ', 'Jhon Danielle Lauderis Umbay ', '', '11111', '2018-09-26', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', ''),
(141, '2018-09-28', '01:07:07', 'Shan Ethan', 'Reimbursement of travel expenses of SLP', '0000-00-00', '0000-00-00', 'shan ethan et al.', '122568', 8900, 8900, '171', 'BANG-UN', 'no remarks!!', 'for_claim/for_or', 'cheque', 'creditor', '', '2018-09-28', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', ''),
(142, '2018-09-28', '01:07:07', 'Shan Ethan', 'Reimbursement of travel expenses of SLP', '0000-00-00', '0000-00-00', '', '122568', 7800, 7800, '171', 'BANG-UN', 'no remarks!!', 'cancelled', 'cheque', 'creditor', '7622', '2018-09-28', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', 'Jhon Danielle Lauderis Umbay ', '', '0000-00-00', '0000-00-00', 0, '2018-11-14', '', '0000-00-00', 'remarks', ''),
(143, '2018-09-28', '01:07:07', 'Ethan Troy', 'Reimbursement of travel expenses of SLP', '0000-00-00', '0000-00-00', '', '122568', 1100, 1100, '171', 'BANG-UN', 'no remarks!!', 'cancelled', 'cheque', 'creditor', '7620', '2018-09-28', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', 'Jhon Danielle Lauderis Umbay ', '', '0000-00-00', '0000-00-00', 0, '2018-11-14', '', '0000-00-00', 'remarks', ''),
(144, '2018-09-28', '01:11:04', 'Syra Lynn', 'To payment of food and accommodation during the conduct of Capability Building on the Assessment Dis', '0000-00-00', '0000-00-00', 'syra lynn et al.', '898989', 9000, 7899, '101-184', 'BANG-UN', '', 'for_claim/for_or', 'cheque', 'creditor', '', '2018-09-28', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', ''),
(161, '2018-09-28', '01:11:04', 'Syra Lynn', 'To payment of food and accommodation during the conduct of Capability Building on the Assessment Dis', '0000-00-00', '0000-00-00', '', '898989', 4500, 4500, '101-184', 'BANG-UN', '', 'cancelled', 'cheque', 'creditor', '121341', '2018-09-28', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', 'Jhon Danielle Lauderis Umbay ', '', '0000-00-00', '0000-00-00', 0, '2018-10-03', '', '0000-00-00', '', ''),
(162, '2018-09-28', '01:11:04', 'Syra Lynn Pinya', 'To payment of food and accommodation during the conduct of Capability Building on the Assessment Dis', '0000-00-00', '0000-00-00', '', '898989', 4500, 4500, '101-184', 'BANG-UN', '', 'cancelled', 'cheque', 'creditor', '123411', '2018-09-28', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', 'Jhon Danielle Lauderis Umbay ', '', '0000-00-00', '0000-00-00', 0, '2018-11-14', '', '0000-00-00', 'remarks', ''),
(163, '2018-09-11', '09:45:34', 'Fatima Nur Catering Services', 'To payment for catering services during the conduct of BARR', '2017-11-25', '2017-11-29', '', '02-25', 20000, 19000, '102', 'KALAHI-NCDDP WB', 'AP# 2', 'expired', 'cheque', 'creditor', '123873', '2018-09-28', '0000-00-00', '', 'Danica Mae Lauderis Umbay ', '', 'Jhon Danielle Lauderis Umbay ', '', '0000-00-00', '2018-12-28', 0, '2018-11-14', 'Jhon Danielle Lauderis Umbay ', '2018-11-14', 'remarks', ''),
(164, '2018-09-11', '09:45:34', 'sydrikkk', 'To payment for catering services during the conduct of BARR', '2017-11-25', '2017-11-29', '', '02-25', 10000, 10000, '102', 'KALAHI-NCDDP WB', 'AP# 2', 'cancelled', 'cheque', 'creditor', '12378', '2018-09-28', '0000-00-00', '', 'Danica Mae Lauderis Umbay ', '', 'Jhon Danielle Lauderis Umbay ', '', '0000-00-00', '0000-00-00', 0, '2018-11-14', '', '0000-00-00', 'remarks', ''),
(165, '2018-09-28', '03:28:19', 'Cherry Lynn', 'To payment of burial', '0000-00-00', '0000-00-00', 'Pearl ', '19-1919', 20000, 20000, '171', 'NHTSPR', '', 'for_claim/for_or', 'cheque', 'creditor', '', '2018-09-28', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', ''),
(166, '2018-09-28', '03:28:19', 'Cherry Lynn', 'To payment of burial', '0000-00-00', '0000-00-00', '', '19-1919', 4000, 4000, '171', 'NHTSPR', '', 'cancelled', 'cheque', 'creditor', '325125', '2018-09-28', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', 'Jhon Danielle Lauderis Umbay ', '', '0000-00-00', '0000-00-00', 0, '2018-11-14', 'Jhon Danielle Lauderis Umbay ', '2018-11-14', 'remarks', ''),
(167, '2018-09-28', '03:28:19', 'Cherry Lynn 2', 'To payment of burial', '0000-00-00', '0000-00-00', '', '19-1919', 4000, 4000, '171', 'NHTSPR', '', 'cancelled', 'cheque', 'creditor', '132512', '2018-09-28', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', 'Jhon Danielle Lauderis Umbay ', '', '0000-00-00', '0000-00-00', 0, '2018-11-14', 'Jhon Danielle Lauderis Umbay ', '2018-10-01', 'remarks', ''),
(168, '2018-09-28', '03:28:19', 'Cherry Lynn 3', 'To payment of burial', '0000-00-00', '0000-00-00', '', '19-1919', 12000, 12000, '171', 'NHTSPR', '', 'claimed', 'cheque', 'creditor', '132511', '2018-09-28', '2018-09-28', 'Cherry Lynn 3', 'Jhon Danielle Lauderis Umbay ', 'Jhon Danielle Lauderis Umbay ', '', '456222', '2018-09-28', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', ''),
(169, '2018-10-01', '09:53:31', 'Jhon Danielle L. Umbay', 'To payment of purchase medicines for CIU clients', '0000-00-00', '0000-00-00', '', '12900', 5600, 5600, '171', 'BANG-UN', '', 'cancelled', 'cheque', 'employee', '', '0000-00-00', '0000-00-00', '', '', '', 'Jhon Danielle Lauderis Umbay ', '', '0000-00-00', '0000-00-00', 0, '2018-10-03', 'Danica Mae Lauderis Umbay ', '2018-10-03', '', ''),
(170, '2018-10-01', '01:32:11', 'University of Southeaster Philippines', 'To payment for food and accomodation', '0000-00-00', '0000-00-00', '', '7899', 45500, 45000, '171', 'BANG-UN', '', 'cancelled', 'cheque', 'creditor', '341551', '2018-10-01', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', 'Jhon Danielle Lauderis Umbay ', '', '0000-00-00', '0000-00-00', 0, '2018-11-14', 'Danica Mae Lauderis Umbay ', '2018-10-03', 'remarks', ''),
(171, '2018-10-01', '14:20:09', 'Institute of Computing', 'to payment of purchase Apple iMac for BS Computer Science students', '0000-00-00', '0000-00-00', '', '123791', 890000, 885000, '101-184', 'BANG-UN', '', 'cancelled', 'cheque', 'creditor', '241999', '2018-10-01', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', 'Jhon Danielle Lauderis Umbay ', '', '0000-00-00', '0000-00-00', 0, '2018-11-14', 'Jhon Danielle Lauderis Umbay ', '2018-11-14', 'remarks', ''),
(172, '2018-10-01', '14:28:20', 'USeP-College of Engineering', 'to payment of cements, stones, metal, machine, and electricity for Engineering students', '0000-00-00', '0000-00-00', 'USeP-College of Technology', '172839', 230990, 230975, '101-184', 'BANG-UN', '', 'for_claim/for_or', 'cheque', 'creditor', '', '2018-10-01', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', ''),
(173, '2018-10-01', '14:28:20', 'USeP-College of Engineering 1', 'to payment of cements, stones, metal, machine, and electricity for Engineering students', '0000-00-00', '0000-00-00', '', '172839', 130900.5, 130900.5, '101-184', 'BANG-UN', '', 'cancelled', 'cheque', 'creditor', '235423', '2018-10-01', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', 'Jhon Danielle Lauderis Umbay ', '', '0000-00-00', '0000-00-00', 0, '2018-11-14', '', '0000-00-00', 'remarks', ''),
(174, '2018-10-01', '14:28:20', 'USeP-College of Engineering 2', 'to payment of cements, stones, metal, machine, and electricity for Engineering students', '0000-00-00', '0000-00-00', '', '172839', 100089.5, 100089.5, '101-184', 'BANG-UN', '', 'claimed', 'cheque', 'creditor', '235252', '2018-10-01', '2018-10-04', 'Perfecto Alibin', 'Jhon Danielle Lauderis Umbay ', 'Jhon Danielle Lauderis Umbay ', '', '890980', '2018-10-04', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', ''),
(175, '2018-10-01', '15:40:05', 'School of Applied Economics', 'To payment of food and accommodation during the conduct of Capability Building on the Assessment Dis', '0000-00-00', '0000-00-00', '', '909010', 56788, 49000, '171', 'BANG-UN', '', 'cancelled', 'cheque', 'creditor', '', '0000-00-00', '0000-00-00', '', '', '', 'Jhon Danielle Lauderis Umbay ', '', '0000-00-00', '0000-00-00', 0, '2018-11-14', '', '0000-00-00', 'remarks', ''),
(177, '2018-10-01', '15:45:01', 'College of Arts and Science', 'To payment of BIR remittances charged under New Trust Fund', '0000-00-00', '0000-00-00', 'CBA', '347890', 8900, 8876.87, '171', 'BANG-UN', '', 'for_issuance', 'cheque', 'creditor', '', '0000-00-00', '0000-00-00', '', '', '', 'Jhon Danielle Lauderis Umbay ', '', '0000-00-00', '0000-00-00', 0, '2018-11-14', 'Jhon Danielle Lauderis Umbay ', '2018-11-14', 'remarks', ''),
(178, '2018-10-03', '08:28:50', 'Jobecar Jumanji', 'To payment as Honorarium as CWSG member during the conduct of Regional Matching Conference held at C', '0000-00-00', '0000-00-00', 'Frietche Mawszkie', '2748199', 9670, 9480, '171', 'BANG-UN', '', 'for_claim/for_or', 'cheque', 'employee', '', '2018-10-03', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', ''),
(179, '2018-10-03', '08:28:50', 'Jobecar Jumanji', 'To payment as Honorarium as CWSG member during the conduct of Regional Matching Conference held at C', '0000-00-00', '0000-00-00', '', '2748199', 5240, 5240, '171', 'BANG-UN', '', 'cancelled', 'cheque', 'creditor', '892990', '2018-10-03', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', 'Jhon Danielle Lauderis Umbay ', '', '0000-00-00', '0000-00-00', 0, '2018-11-14', 'Jhon Danielle Lauderis Umbay ', '2018-11-14', 'remarks', ''),
(180, '2018-10-03', '08:28:50', 'Frietche Mawszkie', 'To payment as Honorarium as CWSG member during the conduct of Regional Matching Conference held at C', '0000-00-00', '0000-00-00', '', '2748199', 4240, 4000, '171', 'BANG-UN', '', 'claimed', 'cheque', 'creditor', '893521', '2018-10-04', '2018-10-04', '', 'Jhon Danielle Lauderis Umbay ', 'Jhon Danielle Lauderis Umbay ', '', '765543', '2018-10-03', '0000-00-00', 0, '0000-00-00', 'Jhon Danielle Lauderis Umbay ', '2018-10-03', '', ''),
(181, '2018-10-12', '17:03:29', 'SPMC', 'Medical Assistance', '0000-00-00', '0000-00-00', '', '12-1212', 20000, 20000, '101', 'COMMUNITY BASED', '', 'claimed', 'cheque', 'creditor', '324244', '2018-10-12', '2018-10-12', '', 'Jhon Danielle Lauderis Umbay ', 'Jhon Danielle Lauderis Umbay ', '', '421141', '2018-10-12', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', ''),
(182, '2018-10-12', '17:12:29', 'San Pedro Hospital of Davao City, Inc.', 'To payment of purchase medicines for LSM clients', '0000-00-00', '0000-00-00', 'Juan dela Cruz et. al.', '12-8191', 50000, 50000, '101-184', 'PANTAWID', '', 'for_claim/for_or', 'cheque', 'creditor', '', '2018-10-12', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', ''),
(183, '2018-10-12', '17:12:29', 'San Pedro Hospital of Davao City, Inc. 1', 'To payment of purchase medicines for LSM clients', '0000-00-00', '0000-00-00', '', '12-8191', 30000, 30000, '101-184', 'PANTAWID', '', 'expired', 'cheque', 'creditor', '872167', '2018-10-12', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', 'Jhon Danielle Lauderis Umbay ', '', '0000-00-00', '2019-01-12', 0, '2018-11-14', 'Jhon Danielle Lauderis Umbay ', '2018-11-14', 'remarks', ''),
(184, '2018-10-12', '17:12:29', 'San Pedro Hospital of Davao City, Inc. 2', 'To payment of purchase medicines for LSM clients', '0000-00-00', '0000-00-00', '', '12-8191', 20000, 20000, '101-184', 'PANTAWID', '', 'claimed', 'cheque', 'creditor', '325252', '2018-10-12', '2018-10-12', '', 'Jhon Danielle Lauderis Umbay ', 'Jhon Danielle Lauderis Umbay ', '', '124141', '2018-10-12', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', ''),
(185, '2018-09-03', '09:56:10', 'example', 'to payment', '0000-00-00', '0000-00-00', '', '12-1231', 10000, 10000, '101', 'COMPREHENSIVE', '', 'for_issuance', 'cheque', 'creditor', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', ''),
(186, '2018-08-13', '11:14:18', 'example2', 'payment', '0000-00-00', '0000-00-00', '', '11-1211', 1000, 1000, '102', 'BANG-UN', '', 'expired', 'cheque', 'creditor', '345353', '2018-09-02', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', '', '', '0000-00-00', '2018-12-02', 1, '0000-00-00', '', '0000-00-00', '', ''),
(187, '2018-11-21', '11:56:09', 'SPMC', 'To payment of purchase medicines for LSM clients', '0000-00-00', '0000-00-00', 'Marjun Et al.', '18-1977', 20000, 20000, '102', 'NEW TRUST FUND', '', 'for_claim/for_or', 'cheque', 'creditor', '', '2018-11-23', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay '),
(188, '2018-11-23', '13:48:16', 'Mercury Drug', 'To payment of medicine', '0000-00-00', '0000-00-00', 'Benedict Sanchez et. Al.', '21-3297', 20000, 20000, '101', '', '', 'for_claim/for_or', 'ADA', 'creditor', '', '2018-11-23', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay '),
(189, '2018-11-23', '13:48:16', 'Mercury Drug', 'To payment of medicine', '0000-00-00', '0000-00-00', '', '21-3297', 20000, 20000, '101', '', '', 'claimed', 'ADA', 'creditor', '9834687', '2018-11-23', '2018-11-25', '', 'Jhon Danielle Lauderis Umbay ', '', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', ''),
(190, '2018-11-23', '13:56:00', 'Mercury Drug', 'payment of medicine', '0000-00-00', '0000-00-00', 'Leonarda Guibone', '07-4050', 100000, 100000, '101', '', '', 'for_claim/for_or', 'ADA', 'creditor', '', '2018-11-23', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay '),
(191, '2018-11-23', '13:56:00', 'Mercury Drug sasa', 'payment of medicine', '0000-00-00', '0000-00-00', '', '07-4050', 100000, 100000, '101', '', '', 'claimed', 'ADA', 'creditor', '8964387', '2018-11-23', '2018-11-25', '', 'Jhon Danielle Lauderis Umbay ', '', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', ''),
(192, '2018-11-23', '13:58:10', 'Botica Yonica', 'To payment of medicine', '0000-00-00', '0000-00-00', 'Sarah Mari C. Adlao et. Al.', '982-2987', 30000, 30000, '101', '', '', 'for_claim/for_or', 'cheque', 'creditor', '', '2018-11-23', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay '),
(193, '2018-11-23', '13:58:10', 'Botica Yonica', 'To payment of medicine', '0000-00-00', '0000-00-00', '', '982-2987', 30000, 30000, '101', '', '', 'for_claim/for_or', 'cheque', 'creditor', '87487878', '2018-11-23', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', ''),
(194, '2018-11-21', '11:56:09', 'SPMC', 'To payment of purchase medicines for LSM clients', '0000-00-00', '0000-00-00', '', '18-1977', 20000, 20000, '102', 'NEW TRUST FUND', '', 'for_claim/for_or', 'cheque', 'creditor', '873647', '2018-11-23', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', ''),
(195, '2018-11-23', '14:16:44', 'Davao Doc', 'Medical assistance', '0000-00-00', '0000-00-00', 'Revince Aries Pepaña', '892-2378', 20000, 20000, '101', '', '', 'for_claim/for_or', 'ADA', 'creditor', '', '2018-11-23', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay ', '', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', 'Jhon Danielle Lauderis Umbay '),
(196, '2018-11-23', '14:16:44', 'Davao Doc', 'Medical assistance', '0000-00-00', '0000-00-00', '', '892-2378', 20000, 20000, '101', '', '', 'claimed', 'ADA', 'creditor', '76876867', '2018-11-23', '2018-11-25', '', 'Jhon Danielle Lauderis Umbay ', '', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '', '0000-00-00', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_num`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notif_num`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`v_num`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_num` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notif_num` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `v_num` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
