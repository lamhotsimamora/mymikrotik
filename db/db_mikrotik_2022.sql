-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2023 at 03:14 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mikrotik_2022`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_bandwith`
--

CREATE TABLE `t_bandwith` (
  `id_bandwith` int(11) NOT NULL,
  `bandwith` int(11) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_bandwith`
--

INSERT INTO `t_bandwith` (`id_bandwith`, `bandwith`, `price`) VALUES
(1, 10, 500000);

-- --------------------------------------------------------

--
-- Table structure for table `t_client`
--

CREATE TABLE `t_client` (
  `id_client` int(11) NOT NULL,
  `nama` varchar(77) NOT NULL,
  `tgl_pasang` date NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `id_bandwith` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_client`
--

INSERT INTO `t_client` (`id_client`, `nama`, `tgl_pasang`, `id_jenis`, `id_bandwith`) VALUES
(7, 'lamhot simamora', '2023-08-15', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_jenis`
--

CREATE TABLE `t_jenis` (
  `id_jenis` int(11) NOT NULL,
  `jenis` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_jenis`
--

INSERT INTO `t_jenis` (`id_jenis`, `jenis`) VALUES
(1, 'Kabel FO'),
(2, 'Kabel LAN'),
(3, 'PTP (Point To Point)'),
(4, 'PTMP (Point To Multi Point)');

-- --------------------------------------------------------

--
-- Table structure for table `t_payment`
--

CREATE TABLE `t_payment` (
  `id_payment` int(11) NOT NULL,
  `id_client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_client`
-- (See below for the actual view)
--
CREATE TABLE `view_client` (
`id_client` int(11)
,`nama` varchar(77)
,`tgl_pasang` date
,`id_jenis` int(11)
,`id_bandwith` int(11)
,`jenis` varchar(55)
,`price` double
,`bandwith` int(11)
);

-- --------------------------------------------------------

--
-- Structure for view `view_client`
--
DROP TABLE IF EXISTS `view_client`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_client`  AS SELECT `t_client`.`id_client` AS `id_client`, `t_client`.`nama` AS `nama`, `t_client`.`tgl_pasang` AS `tgl_pasang`, `t_client`.`id_jenis` AS `id_jenis`, `t_client`.`id_bandwith` AS `id_bandwith`, `t_jenis`.`jenis` AS `jenis`, `t_bandwith`.`price` AS `price`, `t_bandwith`.`bandwith` AS `bandwith` FROM ((`t_client` join `t_jenis`) join `t_bandwith`) WHERE `t_client`.`id_jenis` = `t_jenis`.`id_jenis` AND `t_bandwith`.`id_bandwith` <> 00  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_bandwith`
--
ALTER TABLE `t_bandwith`
  ADD PRIMARY KEY (`id_bandwith`);

--
-- Indexes for table `t_client`
--
ALTER TABLE `t_client`
  ADD PRIMARY KEY (`id_client`);

--
-- Indexes for table `t_jenis`
--
ALTER TABLE `t_jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `t_payment`
--
ALTER TABLE `t_payment`
  ADD PRIMARY KEY (`id_payment`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_bandwith`
--
ALTER TABLE `t_bandwith`
  MODIFY `id_bandwith` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_client`
--
ALTER TABLE `t_client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `t_jenis`
--
ALTER TABLE `t_jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_payment`
--
ALTER TABLE `t_payment`
  MODIFY `id_payment` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
