-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Gen 17, 2018 alle 01:43
-- Versione del server: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `merchantstransactions`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `currencies`
--

CREATE TABLE IF NOT EXISTS `currencies` (
`id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `exchangeRate` decimal(10,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `exchangeRate`) VALUES
(1, 'USD', '1.60'),
(2, 'POUNDS', '1.00'),
(3, 'EUROS', '1.30');

-- --------------------------------------------------------

--
-- Struttura della tabella `merchants`
--

CREATE TABLE IF NOT EXISTS `merchants` (
`id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `merchants`
--

INSERT INTO `merchants` (`id`, `name`, `createdAt`, `updatedAt`) VALUES
(1, 'BOOTS', '2018-01-16 00:00:00', '2018-01-16 00:00:00'),
(2, 'ASOS', '2018-01-16 00:00:00', '2018-01-16 00:00:00'),
(3, 'ARGO', '2018-01-16 00:00:00', '2018-01-16 00:00:00'),
(4, 'MCDONALD', '2018-01-16 00:00:00', '2018-01-16 00:00:00');

-- --------------------------------------------------------

--
-- Struttura della tabella `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
`id` int(11) NOT NULL,
  `merchant_id` int(11) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `createdAt` date NOT NULL,
  `value` decimal(8,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `transactions`
--

INSERT INTO `transactions` (`id`, `merchant_id`, `currency_id`, `createdAt`, `value`) VALUES
(1, 1, 3, '2018-01-16', '60.00'),
(2, 2, 2, '2018-01-16', '55.00'),
(3, 3, 3, '2018-01-16', '20.00'),
(4, 4, 1, '2018-01-16', '56.00'),
(5, 1, 2, '2018-01-16', '80.00'),
(6, 2, 3, '2018-01-16', '90.00'),
(7, 3, 1, '2018-01-16', '95.00'),
(8, 4, 2, '2018-01-16', '35.00'),
(9, 1, 3, '2018-01-16', '67.00'),
(10, 3, 2, '2018-01-16', '87.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merchants`
--
ALTER TABLE `merchants`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_EAA81A4C6796D554` (`merchant_id`), ADD KEY `IDX_EAA81A4C38248176` (`currency_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `merchants`
--
ALTER TABLE `merchants`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `transactions`
--
ALTER TABLE `transactions`
ADD CONSTRAINT `FK_EAA81A4C38248176` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`),
ADD CONSTRAINT `FK_EAA81A4C6796D554` FOREIGN KEY (`merchant_id`) REFERENCES `merchants` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
