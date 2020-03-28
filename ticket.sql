-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 28, 2020 at 02:53 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ticket`
--

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `no_ticket` int(20) NOT NULL,
  `no_internet` varchar(30) DEFAULT NULL,
  `service` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`no_ticket`, `no_internet`, `service`) VALUES
(1, '161101002322', 'Internet'),
(2, '162106004794', 'IPTV'),
(3, '162623209205', 'Internet'),
(4, '161102019801', 'Internet'),
(5, '162212207046', 'Internet'),
(6, '162604303603', 'Internet'),
(7, '161101026414', 'IPTV'),
(8, '162111104938', 'Internet'),
(9, '561581340', 'VOICE');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_new`
--

CREATE TABLE `ticket_new` (
  `id` int(20) NOT NULL,
  `jenis_ont` varchar(30) DEFAULT NULL,
  `type_ont` varchar(11) DEFAULT NULL,
  `actual_solution` text DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `loker_awal` varchar(20) DEFAULT NULL,
  `resolved` varchar(20) DEFAULT NULL,
  `agent` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(30) DEFAULT NULL,
  `no_ticket` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(255) NOT NULL,
  `sub_unit` text NOT NULL,
  `nama` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `sub_unit`, `nama`, `password`) VALUES
('admin', '', '', '21232f297a57a5a743894a0e4a801fc3'),
('muhsatrio', 'asdasd', 'Satrio', 'b23cf2d0fb74b0ffa0cf4c70e6e04926');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`no_ticket`);

--
-- Indexes for table `ticket_new`
--
ALTER TABLE `ticket_new`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_ticket_new` (`no_ticket`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `no_ticket` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ticket_new`
--
ALTER TABLE `ticket_new`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ticket_new`
--
ALTER TABLE `ticket_new`
  ADD CONSTRAINT `ticket_new_ibfk_1` FOREIGN KEY (`no_ticket`) REFERENCES `ticket` (`no_ticket`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
