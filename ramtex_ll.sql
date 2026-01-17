-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 17, 2026 at 05:17 AM
-- Server version: 5.7.44-48
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ramtex_ll`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbm_category`
--

CREATE TABLE `tbm_category` (
  `id` int(11) NOT NULL,
  `title` varchar(1000) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `body` text,
  `active` varchar(1000) DEFAULT NULL,
  `datedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbm_category`
--

INSERT INTO `tbm_category` (`id`, `title`, `body`, `active`, `datedate`) VALUES
(1, 'FACIAL TISSUE', '', 'True', '2024-11-01'),
(2, 'TOILET PAPER', NULL, 'True', '2024-11-01'),
(3, 'TRASH BAGS', NULL, 'True', '2024-11-01'),
(5, 'INTERFOLD', 'HAND TOWEL ', 'True', '2024-11-01'),
(6, 'NAPKIN ', NULL, 'True', '2024-11-01'),
(8, 'MEDICAL CONSUMABLE', NULL, 'True', '2024-11-01'),
(9, 'CENTREPULL', NULL, 'True', '2024-11-01'),
(10, 'MEGA ROLL', NULL, 'True', '2024-11-01'),
(17, 'ALUMINUM FOIL & CLING FILM', NULL, 'True', '2024-11-01'),
(18, 'DISPENSERS', NULL, 'True', '2024-11-01'),
(19, 'LIQUID SOAP', NULL, 'True', '2024-11-01'),
(22, 'SHAMPOO & CONDITIONER', NULL, 'True', '2024-11-01'),
(23, 'HOUSEHOLD CLEANING SUPPLIES', NULL, 'True', '2024-11-01'),
(24, 'SANITARY PADS', NULL, 'True', '2024-11-01'),
(25, 'BEAUTY & PERSONAL CARE', NULL, 'True', '2024-11-01'),
(26, 'APPAREL & ACCESSORIES', '', 'False', '2024-11-01'),
(29, 'SILVER', '', 'False', '2024-11-01'),
(30, 'ARCHITECTURAL & GARDEN', '', 'False', '2024-11-01'),
(31, 'SANITARY WOMEN PADS', 'WOMEN PADS ALL SIZES', 'True', '2025-03-27');

-- --------------------------------------------------------

--
-- Table structure for table `tbm_client`
--

CREATE TABLE `tbm_client` (
  `id` bigint(20) NOT NULL,
  `gender_id` int(11) DEFAULT NULL,
  `fullname` varchar(1000) DEFAULT NULL,
  `job_id` int(11) DEFAULT NULL,
  `companyname` varchar(1000) DEFAULT NULL,
  `pobox` varchar(1000) DEFAULT NULL,
  `country_id` varchar(1000) DEFAULT NULL,
  `address` text,
  `district` varchar(1000) DEFAULT NULL,
  `city` varchar(1000) DEFAULT NULL,
  `phone` varchar(1000) DEFAULT NULL,
  `fax` varchar(1000) DEFAULT NULL,
  `email` varchar(1000) DEFAULT NULL,
  `bankdetails` varchar(1000) DEFAULT NULL,
  `financialno` varchar(1000) DEFAULT NULL,
  `datedate` date DEFAULT NULL,
  `otherphone` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbm_client`
--

INSERT INTO `tbm_client` (`id`, `gender_id`, `fullname`, `job_id`, `companyname`, `pobox`, `country_id`, `address`, `district`, `city`, `phone`, `fax`, `email`, `bankdetails`, `financialno`, `datedate`, `otherphone`) VALUES
(1, 4, 'TONY KALLAB', 1, 'RAMTEX GROUP SAL', '', '1', '178 18TH STREET N.', '', 'HOSRAYEL, JBEIL', '03893022', '', 'ramtex@gmail.com', '', '', '2024-11-25', ''),
(101, 4, 'Zeina Lebanon', 0, '', '', '0', '', '', '', '', '', '', '', '', '2024-11-25', ''),
(201, 4, 'ABDO SAKR', 0, 'SAKR AUDIT', '', '1', 'JBEIL CENTER MAR BOUTROS & BOULOS', '', 'JBEIL', '9613285829', '', 'SAKRABDO099@YAHOO.COM', '', '', '2024-11-27', ''),
(301, 1, 'OSCAR HAGE', 17, 'HAGE SUPERSTORE', '', '1', 'JBEIL MAIN STREET', 'JBEIL', 'JBEIL', '03711227', '', '', '', '', '2025-01-08', '09546000'),
(401, 1, 'KHODER ', 17, 'LE CAP RESTAURANT', '', '1', 'AMCHIT AL MINA', '', 'AMCHIT', '03316360', '', '', '', '', '2025-01-23', ''),
(501, 4, 'ELIE HOSRI', 0, 'HOSRI', '', '1', 'NAHR IBRAHIM', '', 'NAHR IBRAHIM', '9613328175', '', '', '', '', '2025-01-27', ''),
(601, 2, 'MAGUY OBEID', 14, '', '', '1', 'BATROUN', '', 'THOUM', '70791371', '', '', '', '', '2025-01-28', ''),
(701, 2, 'PAULA ABDENNOUR', 1, 'Hospital saint Michell ', '', '1', 'AMCHIT NEXT TO FRERES MARIST', '', 'AMCHIT', '03521847', '', '', '', '', '2025-01-29', ''),
(801, 4, 'MILED NOURA', 17, 'MEDICAP', '', '1', 'DAWRA', '', '', '03615447', '', '', '', '', '2025-02-17', ''),
(901, 1, 'JOSEPH MORKOS', 10, 'JBEIL SUPERMARKET', '', '1', 'JBEIL HIGHWAY ', 'JBEIL KESERWAN', 'JBEIL', '76534037', '', '', '', '', '2025-03-18', '03706739'),
(1001, 1, 'GEORGE ABOU KHALIL', 14, 'HAWA CHIKEN', '74 ANTELIAS LEBANON', '1', 'SAFRA', 'KESERWAN', 'SAFRA', '09851257', '09851265', 'CARMENELHAWA@HAWACHIKENLB.COM', '', '', '2025-03-27', '81742141'),
(1101, 4, 'MARITIME HOSPITAL', 13, 'MARITIME HOSPITAL', '', '1', 'JBEIL HIGHWAY', 'JBEIL KESERWAN', 'JBEIL', '09540017', '', '', '', '', '2025-04-02', ''),
(1201, 4, 'BALDO RESTAURANT', 14, 'BALDO', '', '1', 'JBEIL', 'JBEIL KESERWAN', 'JBEIL', '76356234', '', '', '', '', '2025-04-02', ''),
(1301, 2, 'BIOMAS SAL', 19, 'BIOMAS SAL', '', '1', 'JDIEDEH MATEN', 'MATEN', 'JDIEDEH', '03868882', '', '', '', '', '2025-04-08', ''),
(1401, 4, 'ALFARROUJ AL ABIAD', 14, 'ALFARROUJ AL ABIAD', '', '1', 'AMCHIT', 'JBEIL', 'AMCHIT', '03568952', '', '', '', '', '2025-04-08', ''),
(1501, 4, 'Nehmeh International Group ', 18, 'Nehmeh International Group', '', '1', 'Nahr Ibrahim', 'Kesserwan', 'Nahr Ibrahim', '03889762', '', '', '', '', '2025-04-25', ''),
(1601, 4, 'ELIE RICHA', 4, 'SYNC SARL', '', '1', 'JBEIL BEHIND WOODEN BAKERY', 'JBEIL', 'JBEIL', '03375918', '', '', '', '2496047-601', '2025-05-28', ''),
(1701, 4, 'GEORGE HARFOUCH', 4, 'AL MASHREK INSURANCE ', '', '1', 'AL MASHREK BUILDING', 'METN', 'ANTELIAS', '03721102', '', '', '', '', '2025-05-29', '04408666'),
(1801, 4, 'MILED NOURA [Cancel]', 17, 'MEDICAP [Cancel]', '', '1', 'DAWRA NEXT TO GARGOUR', 'METN', 'DAWRA', '03619178', '', '', '', '', '2025-05-30', ''),
(1901, 4, 'MOUJAMAA ASKARI JOUNIEH', 14, 'MOUJAMAA ASKARI JOUNIEH', '', '1', 'JOUNIEH BEACH BOULEVARD', 'KESERWAN', 'JOUNIEH', '', '', '', '', '', '2025-06-23', ''),
(2001, 4, 'ELIO FARHAT', 17, 'RESTAURANT AMINE SIGNATURE', '', '1', 'LEHFED MAFRAQ SAKI RESHMAYA', 'JBEIL', 'LEHFED', '', '', '', '', '', '2025-07-02', ''),
(2101, 4, 'NAJA KHOURY', 0, '', '', '1', 'AMCHIT HILLS ', '', '', '71769313', '', '', '', '', '2025-09-05', ''),
(2201, 4, 'Abou samir', 1, 'Shop abou samir', '', '1', 'MAIN ROAD KARTABA', 'KESERWAN', 'ADONIS', '03676818', '', '', '', '', '2025-10-07', ''),
(2301, 3, 'LAUREDES ABBOUD', 17, 'LYCEE AMCHIT', '', '1', 'AMCHIT', 'JBEIL', 'AMCHIT', '70605459', '', '', '', '', '2025-10-08', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbm_invoice`
--

CREATE TABLE `tbm_invoice` (
  `id` int(11) NOT NULL,
  `sales_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `client_id` bigint(20) DEFAULT NULL,
  `datedate` date DEFAULT NULL,
  `notes` text,
  `warrantee` text,
  `invoicevalidity` text,
  `paymentterms` text,
  `currency_id` int(11) DEFAULT NULL,
  `currencyvalue` varchar(1000) DEFAULT NULL,
  `totalprice` varchar(1000) DEFAULT NULL,
  `discountprice1` varchar(1000) DEFAULT NULL,
  `discountprice2` varchar(1000) DEFAULT NULL,
  `totalnet` varchar(1000) DEFAULT NULL,
  `deliverylocations` text,
  `vat` varchar(100) DEFAULT NULL,
  `po_number` varchar(100) DEFAULT NULL,
  `paid` varchar(100) DEFAULT 'False',
  `do_number` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbm_invoice`
--

INSERT INTO `tbm_invoice` (`id`, `sales_id`, `status_id`, `client_id`, `datedate`, `notes`, `warrantee`, `invoicevalidity`, `paymentterms`, `currency_id`, `currencyvalue`, `totalprice`, `discountprice1`, `discountprice2`, `totalnet`, `deliverylocations`, `vat`, `po_number`, `paid`, `do_number`) VALUES
(4, 1, 1, 301, '2025-01-08', '', 'All RAMTEX products are warranted against any manufacturing defects for a period of two years from the date of shipping.\r\nUniquely backed by ISO 9001 Quality certificate.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '190', '0.00', '0.00', '210.9', 'JBEIL MAIN STREET - JBEIL - JBEIL - Lebanon', '11.00', '', 'False', 0),
(6, 1, 1, 701, '2025-01-29', '', 'All RAMTEX products are warranted against any manufacturing defects for a period of two years from the date of shipping.\r\nUniquely backed by ISO 9001 Quality certificate.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '340.01', '0.00', '0.00', '340.01', 'AMCHIT NEXT TO FRERES MARIST - AMCHIT - Lebanon', '0.00', '', 'False', 0),
(7, 1, 1, 601, '2025-02-04', '', 'All RAMTEX products are warranted against any manufacturing defects for a period of two years from the date of shipping.\r\nUniquely backed by ISO 9001 Quality certificate.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '244.22', '0.00', '0.00', '244.22', 'BATROUN - THOUM - Lebanon', '0.00', '', 'False', 0),
(8, 1, 1, 601, '2025-02-04', '', 'All RAMTEX products are warranted against any manufacturing defects for a period of two years from the date of shipping.\r\nUniquely backed by ISO 9001 Quality certificate.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '246.05', '0.00', '0.00', '246.05', 'BATROUN - THOUM - Lebanon', '0.00', '', 'False', 0),
(9, 1, 1, 801, '2025-02-17', '', 'All RAMTEX products are warranted against any manufacturing defects for a period of two years from the date of shipping.\r\nUniquely backed by ISO 9001 Quality certificate.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '660', '0.00', '0.00', '732.6', 'DAWRA - Lebanon', '11.00', '', 'False', 0),
(10, 1, 1, 801, '2025-02-17', '', 'All RAMTEX products are warranted against any manufacturing defects for a period of two years from the date of shipping.\r\nUniquely backed by ISO 9001 Quality certificate.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '2880', '0.00', '0.00', '3196.8', 'DAWRA - Lebanon', '11.00', '', 'False', 0),
(11, 1, 1, 901, '2025-03-18', '', 'All RAMTEX products are warranted against any manufacturing defects ', '2 weeks from invoice date.\r\n2 weeks from Order confirmation date.', '', 1, '1', '1823.26', '0.00', '0.00', '2023.82', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(12, 1, 1, 901, '2025-03-25', '', 'All RAMTEX products are warranted against any manufacturing defects ', '4 weeks from invoice date.\r\n', '', 1, '1', '1375.54', '0.00', '0.00', '1526.85', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(13, 1, 1, 901, '2025-03-25', '', 'All RAMTEX products are warranted against any manufacturing defects ', '', '', 1, '1', '172.5', '0.00', '0.00', '191.48', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(14, 1, 1, 901, '2025-03-27', 'THIS IS FOR A PROMOTION BUY ONE GET ONE FREE', 'All RAMTEX products are warranted against any manufacturing defects', 'TYU', 'YYU', 1, '1', '0', '100.00', 'NaN', '0', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '0.00', '', 'True', 0),
(15, 1, 1, 1101, '2025-04-02', '', 'All RAMTEX products are warranted against any manufacturing defects ', '', '', 1, '1', '1375.5', '0.00', '0.00', '1526.8', 'JBEIL HIGHWAY - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(16, 1, 1, 1201, '2025-04-02', '', 'All RAMTEX products are warranted against any manufacturing defects', '', '', 1, '1', '61', '0.00', '0.00', '67.71', 'JBEIL - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(17, 1, 1, 901, '2025-04-03', '', 'All RAMTEX products are warranted against any manufacturing defects ', '', '', 1, '1', '720.08', '0.00', '0.00', '799.29', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(18, 1, 1, 1101, '2025-04-04', '', 'All RAMTEX products are warranted against any manufacturing defects ', '', '', 1, '1', '1809.6', '0.00', '0.00', '2008.66', 'JBEIL HIGHWAY - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(19, 1, 1, 1301, '2025-04-08', '', 'All RAMTEX products are warranted against any manufacturing defects ', '', '', 1, '1', '150', '0.00', '0.00', '166.5', 'JDIEDEH MATEN - MATEN - JDIEDEH - Lebanon', '11.00', '', 'False', 0),
(20, 1, 1, 1001, '2025-04-08', '', 'All RAMTEX products are warranted against any manufacturing defects ', '', '', 1, '1', '490', '0.00', '0.00', '543.9', 'SAFRA - KESERWAN - SAFRA - Lebanon', '11.00', '', 'False', 0),
(21, 1, 1, 301, '2025-04-09', '', 'All RAMTEX products are warranted against any manufacturing defects ', '', '', 1, '1', '359', '0.00', '0.00', '398.49', 'JBEIL MAIN STREET - JBEIL - JBEIL - Lebanon', '11.00', '', 'False', 0),
(22, 1, 1, 901, '2025-04-09', '', 'All RAMTEX products are warranted against any manufacturing defects ', '', '', 1, '1', '610.86', '0.00', '0.00', '678.05', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(23, 1, 1, 1201, '2025-04-10', '', 'All RAMTEX products are warranted against any manufacturing defects ', '', '', 1, '1', '76.5', '0.00', '0.00', '84.92', 'JBEIL - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(24, 1, 1, 901, '2025-04-11', '', 'All RAMTEX products are warranted against any manufacturing defects ', '', '', 1, '1', '1057.91', '0.00', '0.00', '1174.28', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(25, 1, 1, 901, '2025-04-17', '', 'All RAMTEX products are warranted against any manufacturing defects ', '', '', 1, '1', '1301.1', '0.00', '0.00', '1444.22', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(26, 1, 1, 301, '2025-04-17', '', 'All RAMTEX products are warranted against any manufacturing defects ', '', '', 1, '1', '1375', '0.00', '0.00', '1526.25', 'JBEIL MAIN STREET - JBEIL - JBEIL - Lebanon', '11.00', '', 'False', 0),
(27, 1, 1, 1101, '2025-04-22', '', 'All RAMTEX products are warranted against any manufacturing defects ', '', '', 1, '1', '1081.6', '0.00', '0.00', '1200.58', 'JBEIL HIGHWAY - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(28, 2, 1, 1501, '2025-04-25', '', 'All RAMTEX products are warranted against any manufacturing defects ', '', '', 1, '1', '157.5', '0.00', '0.00', '174.82', 'Nahr Ibrahim - Kesserwan - Nahr Ibrahim - Lebanon', '11.00', '', 'False', 0),
(29, 1, 1, 1101, '2025-04-25', '', 'All RAMTEX products are warranted against any manufacturing defects ', '', '', 1, '1', '2256.72', '0.00', '0.00', '2504.96', 'JBEIL HIGHWAY - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(30, 2, 1, 701, '2025-05-02', '', 'All RAMTEX products are warranted against any manufacturing defects ', '', '', 1, '1', '510', '0.00', '0.00', '566.1', 'AMCHIT NEXT TO FRERES MARIST - AMCHIT - Lebanon', '11.00', '', 'False', 0),
(31, 1, 1, 901, '2025-05-03', '', 'All RAMTEX products are warranted against any manufacturing defects ', '', '', 1, '1', '560', '0.00', '0.00', '621.6', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(32, 1, 1, 901, '2025-05-06', '', 'All RAMTEX products are warranted against any manufacturing defects ', '', '', 1, '1', '172.5', '0.00', '0.00', '191.48', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(33, 1, 1, 1001, '2025-05-12', '', 'All RAMTEX products are warranted against any manufacturing defects ', '', '', 1, '1', '554', '0.00', '0.00', '614.94', 'SAFRA - KESERWAN - SAFRA - Lebanon', '11.00', '', 'False', 0),
(34, 1, 1, 1201, '2025-05-15', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '', '', 1, '1', '45.5', '0.00', '0.00', '50.5', 'JBEIL - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(35, 1, 1, 1201, '2025-05-15', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '', '', 1, '1', '178.5', '0.00', '0.00', '198.14', 'JBEIL - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(36, 1, 1, 901, '2025-05-16', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '', '', 1, '1', '2189.14', '0.00', '0.00', '2429.95', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(37, 1, 1, 901, '2025-05-17', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '288', '0.00', '0.00', '319.68', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(38, 1, 1, 1301, '2025-05-19', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '', '', 1, '1', '150', '0.00', '0.00', '166.5', 'JDIEDEH MATEN - MATEN - JDIEDEH - Lebanon', '11.00', '', 'False', 0),
(39, 1, 1, 1101, '2025-05-21', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '', '', 1, '1', '466', '0.00', '0.00', '517.26', 'JBEIL HIGHWAY - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(40, 1, 1, 301, '2025-05-22', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '715', '0.00', '0.00', '793.65', 'JBEIL MAIN STREET - JBEIL - JBEIL - Lebanon', '11.00', '', 'False', 0),
(41, 1, 1, 1501, '2025-05-22', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '207.5', '0.00', '0.00', '230.32', 'Nahr Ibrahim - Kesserwan - Nahr Ibrahim - Lebanon', '11.00', '', 'False', 0),
(42, 1, 1, 901, '2025-05-27', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '', '', 1, '1', '2065.98', '0.00', '0.00', '2293.24', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(43, 1, 1, 301, '2025-05-28', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '', '', 1, '1', '957', '0.00', '0.00', '1062.27', 'JBEIL MAIN STREET - JBEIL - JBEIL - Lebanon', '11.00', '', 'False', 0),
(44, 1, 1, 1601, '2025-05-28', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '46.8', '0.00', '0.00', '51.95', 'JBEIL BEHIND WOODEN BAKERY - JBEIL - JBEIL - Lebanon', '11.00', '', 'False', 0),
(45, 1, 1, 1701, '2025-05-29', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '1044', '0.00', '0.00', '1158.84', 'AL MASHREK BUILDING - METN - ANTELIAS - Lebanon', '11.00', '', 'False', 0),
(46, 2, 1, 801, '2025-05-30', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '2649.92', '0.00', '0.00', '2941.41', 'DAWRA NEXT TO GARGOUR - METN - DAWRA - Lebanon', '11.00', '', 'False', 0),
(47, 1, 1, 1101, '2025-06-03', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '1079.8', '0.00', '0.00', '1198.58', 'JBEIL HIGHWAY - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(48, 1, 1, 301, '2025-06-03', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '875', '0.00', '0.00', '971.25', 'JBEIL MAIN STREET - JBEIL - JBEIL - Lebanon', '11.00', '', 'False', 0),
(49, 1, 1, 1501, '2025-06-04', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '262.5', '0.00', '0.00', '291.38', 'Nahr Ibrahim - Kesserwan - Nahr Ibrahim - Lebanon', '11.00', '', 'False', 0),
(50, 1, 1, 301, '2025-06-13', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '662.25', '0.00', '0.00', '735.1', 'JBEIL MAIN STREET - JBEIL - JBEIL - Lebanon', '11.00', '', 'False', 0),
(51, 1, 1, 901, '2025-06-13', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '1785.54', '0.00', '0.00', '1981.95', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(52, 1, 1, 1901, '2025-06-23', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '75', '0.00', '0.00', '83.25', 'JOUNIEH BEACH BOULEVARD - KESERWAN - JOUNIEH - Lebanon', '11.00', '', 'False', 0),
(53, 1, 1, 1301, '2025-06-24', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '150', '0.00', '0.00', '166.5', 'JDIEDEH MATEN - MATEN - JDIEDEH - Lebanon', '11.00', '', 'False', 0),
(54, 1, 1, 901, '2025-06-25', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '2127.89', '0.00', '0.00', '2361.96', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(55, 1, 1, 1101, '2025-06-30', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '2340.1', '0.00', '0.00', '2597.51', 'JBEIL HIGHWAY - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(56, 1, 1, 1501, '2025-07-01', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '294', '0.00', '0.00', '326.34', 'Nahr Ibrahim - Kesserwan - Nahr Ibrahim - Lebanon', '11.00', '', 'False', 0),
(57, 1, 1, 2001, '2025-07-02', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '499.5', '0.00', '0.00', '554.45', 'LEHFED MAFRAQ SAKI RESHMAYA - JBEIL - LEHFED - Lebanon', '11.00', '', 'False', 0),
(58, 1, 1, 1201, '2025-07-03', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '148.9', '0.00', '0.00', '165.28', 'JBEIL - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(59, 2, 1, 1001, '2025-07-09', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '540', '0.00', '0.00', '599.4', 'SAFRA - KESERWAN - SAFRA - Lebanon', '11.00', '', 'False', 0),
(60, 1, 1, 901, '2025-07-09', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '1635.34', '0.00', '0.00', '1815.23', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(61, 1, 1, 901, '2025-07-11', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '1237.8', '0.00', '0.00', '1373.96', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(62, 2, 1, 1701, '2025-07-11', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '848', '0.00', '0.00', '941.28', 'AL MASHREK BUILDING - METN - ANTELIAS - Lebanon', '11.00', '', 'False', 0),
(63, 1, 1, 901, '2025-07-18', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '639.9', '0.00', '0.00', '710.29', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(64, 1, 1, 1201, '2025-07-18', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '76', '0.00', '0.00', '84.36', 'JBEIL - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(65, 1, 1, 901, '2025-07-24', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '2248', '0.00', '0.00', '2495.28', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(66, 1, 1, 1101, '2025-07-25', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '750', '0.00', '0.00', '832.5', 'JBEIL HIGHWAY - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(67, 1, 1, 1201, '2025-07-26', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '43.75', '0.00', '0.00', '48.56', 'JBEIL - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(68, 1, 1, 301, '2025-07-31', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '170', '0.00', '0.00', '188.7', 'JBEIL MAIN STREET - JBEIL - JBEIL - Lebanon', '11.00', '', 'False', 0),
(69, 1, 1, 1101, '2025-08-01', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '1631.6', '0.00', '0.00', '1811.08', 'JBEIL HIGHWAY - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(70, 1, 1, 901, '2025-08-01', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '360', '0.00', '0.00', '399.6', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(71, 1, 1, 1601, '2025-08-06', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '50.4', '0.00', '0.00', '55.94', 'JBEIL BEHIND WOODEN BAKERY - JBEIL - JBEIL - Lebanon', '11.00', '', 'False', 0),
(72, 1, 1, 901, '2025-08-07', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '1151.81', '0.00', '0.00', '1278.51', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(73, 1, 1, 301, '2025-08-08', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '1134.75', '0.00', '0.00', '1259.57', 'JBEIL MAIN STREET - JBEIL - JBEIL - Lebanon', '11.00', '', 'False', 0),
(74, 1, 1, 301, '2025-08-08', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '671.5', '0.00', '0.00', '745.36', 'JBEIL MAIN STREET - JBEIL - JBEIL - Lebanon', '11.00', '', 'False', 0),
(75, 1, 1, 1101, '2025-08-08', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '277.5', '0.00', '0.00', '308.02', 'JBEIL HIGHWAY - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(76, 1, 1, 1501, '2025-08-08', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '336.25', '0.00', '0.00', '373.24', 'Nahr Ibrahim - Kesserwan - Nahr Ibrahim - Lebanon', '11.00', '', 'False', 0),
(77, 1, 1, 901, '2025-08-08', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '416.4', '0.00', '0.00', '462.2', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(78, 1, 1, 901, '2025-08-13', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '1245.4', '0.00', '0.00', '1382.39', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(79, 1, 1, 1001, '2025-08-13', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '452', '0.00', '0.00', '501.72', 'SAFRA - KESERWAN - SAFRA - Lebanon', '11.00', '', 'False', 0),
(80, 1, 1, 1201, '2025-08-18', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '60', '0.00', '0.00', '66.6', 'JBEIL - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(81, 1, 1, 901, '2025-08-19', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '1781.02', '0.00', '0.00', '1976.93', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(82, 1, 1, 901, '2025-08-19', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '75', '0.00', '0.00', '83.25', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(83, 1, 1, 1701, '2025-08-20', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '4034.8', '0.00', '0.00', '4478.63', 'AL MASHREK BUILDING - METN - ANTELIAS - Lebanon', '11.00', '', 'False', 0),
(84, 1, 1, 1101, '2025-08-20', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '875', '0.00', '0.00', '971.25', 'JBEIL HIGHWAY - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(85, 1, 1, 901, '2025-08-20', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '125', '0.00', '0.00', '138.75', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(86, 1, 1, 1301, '2025-08-22', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '150', '0.00', '0.00', '166.5', 'JDIEDEH MATEN - MATEN - JDIEDEH - Lebanon', '11.00', '', 'False', 0),
(87, 1, 1, 301, '2025-08-22', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '156', '0.00', '0.00', '173.16', 'JBEIL MAIN STREET - JBEIL - JBEIL - Lebanon', '11.00', '', 'False', 0),
(88, 1, 1, 901, '2025-08-22', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '496.8', '0.00', '0.00', '551.45', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(89, 1, 1, 1201, '2025-08-25', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '95', '0.00', '0.00', '105.45', 'JBEIL - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(90, 1, 1, 901, '2025-08-27', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '1260.92', '0.00', '0.00', '1399.62', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(91, 1, 1, 901, '2025-09-04', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '945.85', '0.00', '0.00', '1049.89', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(92, 1, 1, 301, '2025-09-05', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '1552', '0.00', '0.00', '1722.72', 'JBEIL MAIN STREET - JBEIL - JBEIL - Lebanon', '11.00', '', 'False', 0),
(93, 1, 1, 1101, '2025-09-05', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '495', '0.00', '0.00', '549.45', 'JBEIL HIGHWAY - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(94, 1, 1, 2101, '2025-09-05', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '11.75', '0.00', '0.00', '13.04', 'AMCHIT HILLS  - Lebanon', '11.00', '', 'False', 0),
(95, 1, 1, 301, '2025-09-16', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '201.61', '0.00', '0.00', '201.61', 'JBEIL MAIN STREET - JBEIL - JBEIL - Lebanon', '0.00', '', 'False', 0),
(96, 1, 1, 901, '2025-09-19', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '1430.28', '0.00', '0.00', '1587.61', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(97, 1, 1, 901, '2025-09-23', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '751.29', '0.00', '0.00', '833.93', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(98, 1, 1, 1201, '2025-10-02', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '43.75', '0.00', '0.00', '48.56', 'JBEIL - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(99, 1, 1, 901, '2025-10-06', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '2234.1', '0.00', '0.00', '2479.85', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(100, 1, 1, 1001, '2025-10-07', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '485', '0.00', '0.00', '538.35', 'SAFRA - KESERWAN - SAFRA - Lebanon', '11.00', '', 'False', 0),
(101, 1, 1, 301, '2025-10-07', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '1612.87', '0.00', '0.00', '1612.87', 'JBEIL MAIN STREET - JBEIL - JBEIL - Lebanon', '0.00', '', 'False', 0),
(102, 1, 1, 2201, '2025-10-07', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '201.61', '0.00', '0.00', '201.61', 'MAIN ROAD KARTABA - KESERWAN - ADONIS - Lebanon', '0.00', '', 'False', 0),
(103, 1, 1, 2301, '2025-10-08', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '42', '0.00', '0.00', '46.62', 'AMCHIT - JBEIL - AMCHIT - Lebanon', '11.00', '', 'False', 0),
(104, 2, 1, 901, '2025-10-21', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '2194.62', '0.00', '0.00', '2436.03', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(105, 1, 1, 1301, '2025-10-21', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '150', '0.00', '0.00', '166.5', 'JDIEDEH MATEN - MATEN - JDIEDEH - Lebanon', '11.00', '', 'False', 0),
(106, 1, 1, 901, '2025-10-24', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '216', '0.00', '0.00', '239.76', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(107, 1, 1, 901, '2025-11-03', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '187.5', '0.00', '0.00', '208.12', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(108, 1, 1, 1001, '2025-11-11', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '439', '0.00', '0.00', '487.29', 'SAFRA - KESERWAN - SAFRA - Lebanon', '11.00', '', 'False', 0),
(109, 1, 1, 901, '2025-11-13', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '2301.14', '0.00', '0.00', '2554.27', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(110, 1, 1, 901, '2025-11-18', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '432', '0.00', '0.00', '479.52', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(111, 2, 1, 1201, '2025-11-06', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '277.5', '0.00', '0.00', '308.02', 'JBEIL - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(112, 2, 1, 901, '2025-11-26', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '100', '0.00', '0.00', '111', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(113, 2, 1, 901, '2025-11-26', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '1963.12', '0.00', '0.00', '2179.06', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(114, 1, 1, 1301, '2025-11-28', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '150', '0.00', '0.00', '166.5', 'JDIEDEH MATEN - MATEN - JDIEDEH - Lebanon', '11.00', '', 'False', 0),
(115, 1, 1, 901, '2025-12-08', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '1440', '0.00', '0.00', '1598.4', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(116, 1, 1, 901, '2025-12-12', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '1752.97', '0.00', '0.00', '1945.8', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(117, 1, 1, 901, '2025-12-24', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '2141.42', '0.00', '0.00', '2376.98', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(118, 2, 1, 1201, '2025-12-29', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '148.9', '0.00', '0.00', '165.28', 'JBEIL - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(119, 1, 1, 901, '2025-12-30', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '187.5', '0.00', '0.00', '208.12', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(120, 1, 1, 901, '2026-01-08', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '1467.88', '0.00', '0.00', '1629.35', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0),
(121, 1, 1, 1701, '2026-01-12', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '4496.3', '0.00', '0.00', '4990.89', 'AL MASHREK BUILDING - METN - ANTELIAS - Lebanon', '11.00', '', 'False', 0),
(122, 1, 1, 1001, '2026-01-14', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '460.01', '0.00', '0.00', '510.61', 'SAFRA - KESERWAN - SAFRA - Lebanon', '11.00', '', 'False', 0),
(123, 1, 1, 901, '2026-01-16', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from invoice date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '1491', '0.00', '0.00', '1655.01', 'JBEIL HIGHWAY  - JBEIL KESERWAN - JBEIL - Lebanon', '11.00', '', 'False', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbm_invoice_det`
--

CREATE TABLE `tbm_invoice_det` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `default_price` float DEFAULT NULL,
  `products_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `show_discount` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbm_invoice_det`
--

INSERT INTO `tbm_invoice_det` (`id`, `invoice_id`, `default_price`, `products_id`, `qty`, `discount`, `show_discount`) VALUES
(7, 4, 19, 63, 10, 0, 'True'),
(13, 6, 16, 32, 24, 85.31, 'True'),
(14, 6, 10, 25, 36, 49, 'True'),
(15, 6, 10, 38, 10, 0, 'True'),
(35, 7, 10, 36, 10, 0, 'True'),
(36, 7, 19, 63, 5, 0, 'True'),
(37, 7, 8.61, 22, 2, 0, 'True'),
(38, 7, 19, 18, 2, 15.79, ''),
(44, 8, 10, 36, 10, 0, 'True'),
(45, 8, 17, 63, 5, 10.53, 'True'),
(46, 8, 19, 18, 2, 15.79, 'True'),
(47, 8, 9, 22, 2, 0, 'True'),
(48, 8, 5, 20, 4, 0, 'True'),
(49, 9, 11, 35, 60, 0, 'True'),
(50, 10, 16, 34, 180, 0, 'True'),
(57, 11, 4.11, 64, 50, 0, 'True'),
(58, 11, 6.94, 65, 50, 0, 'True'),
(59, 11, 2.78, 66, 162, 0, 'True'),
(60, 11, 7.2, 23, 30, 0, 'True'),
(61, 11, 4.28, 67, 100, 0, 'True'),
(62, 11, 5.88, 68, 30, 0, 'True'),
(63, 12, 4.11, 64, 50, 0, 'True'),
(64, 12, 6.94, 65, 50, 0, 'True'),
(65, 12, 4.28, 67, 100, 0, 'True'),
(66, 12, 5.88, 68, 28, 0, 'True'),
(67, 12, 7.2, 23, 32, 0, 'True'),
(68, 13, 11.5, 42, 15, 0, 'True'),
(69, 14, 0.55, 70, 108, 0, 'True'),
(70, 14, 0.6, 71, 108, 0, 'True'),
(71, 15, 5.55, 7, 18, 0, 'True'),
(72, 15, 8.75, 23, 60, 0, 'True'),
(73, 15, 8.86, 40, 60, 0, 'True'),
(74, 15, 2.9, 36, 30, 0, 'True'),
(75, 15, 15, 22, 6, 0, 'True'),
(76, 15, 7, 20, 6, 0, 'True'),
(77, 16, 19, 72, 1, 0, 'True'),
(78, 16, 6, 25, 7, 0, 'True'),
(79, 17, 4.11, 64, 50, 0, 'True'),
(80, 17, 2.78, 66, 45, 0, 'True'),
(81, 17, 4.28, 67, 91, 0, 'True'),
(82, 18, 2.9, 36, 624, 0, 'True'),
(83, 19, 1.5, 73, 100, 0, 'True'),
(84, 20, 11, 37, 30, 0, 'True'),
(85, 20, 3.2, 26, 50, 0, 'True'),
(86, 21, 27, 28, 2, 0, 'True'),
(87, 21, 6.5, 24, 20, 0, 'True'),
(88, 21, 8.75, 23, 20, 0, 'True'),
(101, 22, 7.2, 74, 50, 0, 'True'),
(102, 22, 4.11, 64, 26, 0, 'True'),
(103, 22, 2.88, 69, 50, 0, 'True'),
(104, 23, 19, 72, 1, 0, 'True'),
(105, 23, 11.5, 42, 5, 0, 'True'),
(109, 24, 4.11, 64, 33, 0, 'True'),
(110, 24, 2.78, 66, 162, 0, 'True'),
(111, 24, 6.94, 65, 68, 0, 'True'),
(117, 26, 10, 76, 50, 0, 'True'),
(118, 26, 4, 77, 100, 0, 'True'),
(119, 26, 4.75, 75, 100, 0, 'True'),
(120, 25, 4.11, 64, 50, 0, 'True'),
(121, 25, 7.2, 74, 20, 0, 'True'),
(122, 25, 2.88, 69, 50, 0, 'True'),
(123, 25, 4.28, 67, 120, 0, 'True'),
(124, 25, 5.88, 68, 50, 0, 'True'),
(125, 27, 6.5, 24, 60, 0, 'True'),
(126, 27, 8, 3, 20, 0, 'True'),
(127, 27, 8.86, 40, 60, 0, 'True'),
(128, 28, 9, 2, 10, 0, 'True'),
(129, 28, 6.75, 3, 10, 0, 'True'),
(130, 29, 2.9, 36, 600, 0, 'True'),
(131, 29, 8.86, 40, 27, 0, 'True'),
(132, 29, 5.55, 7, 50, 0, 'True'),
(133, 30, 3, 33, 60, 0, 'True'),
(134, 30, 11, 78, 30, 0, 'True'),
(135, 31, 4.11, 64, 28, 0, 'True'),
(136, 31, 2.88, 69, 46, 0, 'True'),
(137, 31, 4.28, 67, 73, 0, 'True'),
(138, 32, 11.5, 42, 15, 0, 'True'),
(139, 33, 3.2, 26, 70, 0, 'True'),
(140, 33, 11, 37, 30, 0, 'True'),
(145, 34, 6.5, 24, 7, 0, 'True'),
(146, 35, 6.5, 24, 7, 0, 'True'),
(147, 35, 19, 72, 7, 0, 'True'),
(148, 36, 4.11, 64, 100, 0, 'True'),
(149, 36, 6.94, 65, 66, 0, 'True'),
(150, 36, 2.78, 66, 175, 0, 'True'),
(151, 36, 4.28, 67, 100, 0, 'True'),
(152, 36, 2.88, 69, 100, 0, 'True'),
(153, 36, 5.88, 68, 20, 0, 'True'),
(154, 37, 7.2, 74, 40, 0, 'True'),
(155, 38, 1.5, 73, 100, 0, 'True'),
(156, 39, 5.55, 7, 60, 0, 'True'),
(157, 39, 19, 72, 7, 0, 'True'),
(158, 40, 4.75, 75, 100, 0, 'True'),
(159, 40, 6.5, 24, 10, 0, 'True'),
(160, 40, 8.75, 23, 20, 0, 'True'),
(161, 41, 9, 2, 10, 0, 'True'),
(162, 41, 6.75, 3, 10, 0, 'True'),
(163, 41, 5, 79, 10, 0, 'True'),
(164, 42, 2.78, 66, 166, 0, 'True'),
(165, 42, 4.28, 67, 200, 0, 'True'),
(166, 42, 2.88, 69, 100, 0, 'True'),
(167, 42, 7.2, 74, 40, 0, 'True'),
(168, 42, 11.5, 42, 15, 0, 'True'),
(169, 43, 4, 77, 100, 0, 'True'),
(170, 43, 10, 76, 50, 0, 'True'),
(171, 43, 4.75, 75, 12, 0, 'True'),
(172, 44, 8.75, 23, 4, 0, 'True'),
(173, 44, 6.25, 11, 1, 0, 'True'),
(174, 44, 5.55, 7, 1, 0, 'True'),
(175, 45, 2.9, 36, 360, 0, 'True'),
(177, 46, 3.38, 33, 784, 0, 'True'),
(181, 47, 12.5, 42, 50, 0, 'True'),
(182, 47, 12, 51, 6, 0, 'True'),
(183, 47, 2.9, 36, 132, 0, 'True'),
(184, 48, 8.75, 23, 100, 0, 'True'),
(185, 49, 5.25, 44, 50, 0, 'True'),
(186, 50, 4.2, 26, 100, 0, 'True'),
(187, 50, 4.75, 75, 51, 0, 'True'),
(188, 51, 7.2, 74, 50, 0, 'True'),
(189, 51, 4.11, 64, 32, 0, 'True'),
(190, 51, 6.94, 65, 51, 0, 'True'),
(191, 51, 2.88, 69, 50, 0, 'True'),
(192, 51, 4.28, 67, 186, 0, 'True'),
(193, 52, 1.5, 73, 50, 0, 'True'),
(194, 53, 1.5, 73, 100, 0, 'True'),
(195, 54, 6.94, 65, 50, 0, 'True'),
(196, 54, 2.78, 66, 129, 0, 'True'),
(197, 54, 4.28, 67, 100, 0, 'True'),
(198, 54, 2.88, 69, 150, 0, 'True'),
(199, 54, 5.88, 68, 27, 0, 'True'),
(200, 54, 7.2, 74, 30, 0, 'True'),
(201, 54, 7.2, 74, 16, 99.99, ''),
(202, 54, 12.5, 42, 15, 0, 'True'),
(203, 55, 5.55, 7, 42, 0, 'True'),
(204, 55, 12.5, 42, 50, 0, 'True'),
(205, 55, 2.9, 36, 330, 0, 'True'),
(206, 55, 8.75, 23, 60, 0, 'True'),
(207, 56, 7.2, 74, 20, 0, 'True'),
(208, 56, 5, 79, 30, 0, 'True'),
(209, 57, 10, 30, 10, 0, 'True'),
(210, 57, 4.2, 26, 10, 0, 'True'),
(211, 57, 2.9, 36, 30, 13.79, 'True'),
(212, 57, 6.5, 24, 15, 23.08, 'True'),
(213, 57, 12.5, 42, 5, 0, 'True'),
(214, 57, 1.5, 73, 30, 0, 'True'),
(215, 57, 15, 22, 10, 33.33, 'True'),
(216, 58, 7.2, 74, 12, 0, 'True'),
(217, 58, 12.5, 42, 5, 0, 'True'),
(228, 59, 11, 37, 20, 0, 'True'),
(229, 59, 3.2, 26, 100, 0, 'True'),
(230, 60, 6.94, 65, 67, 0, 'True'),
(231, 60, 2.78, 66, 162, 0, 'True'),
(232, 60, 7.2, 74, 100, 0, 'True'),
(233, 61, 4.11, 64, 60, 0, 'True'),
(234, 61, 2.88, 69, 60, 0, 'True'),
(235, 61, 4.28, 67, 150, 0, 'True'),
(236, 61, 5.88, 68, 30, 0, 'True'),
(241, 62, 2.9, 36, 120, 0, 'True'),
(242, 62, 12.5, 42, 40, 0, 'True'),
(243, 63, 7.2, 74, 40, 0, 'True'),
(244, 63, 12.5, 42, 15, 0, 'True'),
(245, 63, 4.11, 64, 40, 0, 'True'),
(246, 64, 19, 72, 4, 0, 'True'),
(247, 65, 6.94, 65, 64, 0, 'True'),
(248, 65, 2.78, 66, 162, 0, 'True'),
(249, 65, 5.88, 68, 25, 0, 'True'),
(250, 65, 2.88, 69, 196, 0, 'True'),
(251, 65, 4.28, 67, 150, 0, 'True'),
(252, 66, 12.5, 42, 60, 0, 'True'),
(253, 67, 8.75, 23, 5, 0, 'True'),
(254, 68, 17, 63, 10, 0, 'True'),
(255, 69, 2.9, 36, 504, 0, 'True'),
(256, 69, 17, 63, 10, 0, 'True'),
(257, 70, 7.2, 74, 50, 0, 'True'),
(258, 71, 7.2, 74, 4, 0, 'True'),
(259, 71, 5.25, 44, 2, 0, 'True'),
(260, 71, 5.55, 7, 2, 0, 'True'),
(261, 72, 4.28, 67, 151, 0, 'True'),
(262, 72, 4.11, 64, 123, 0, 'True'),
(263, 73, 4, 77, 18, 0, 'True'),
(264, 73, 10, 76, 52, 0, 'True'),
(265, 73, 4, 80, 30, 0, 'True'),
(266, 73, 4.75, 75, 89, 0, 'True'),
(274, 74, 7.2, 74, 15, 0, 'True'),
(275, 74, 17, 63, 10, 0, 'True'),
(276, 74, 19, 18, 10, 15.79, ''),
(277, 74, 15, 22, 10, 33.33, ''),
(278, 74, 7, 20, 3, 0, 'True'),
(279, 74, 9, 2, 5, 0, 'True'),
(280, 74, 6.75, 3, 10, 0, 'True'),
(281, 75, 5.55, 7, 50, 0, 'True'),
(282, 76, 6.5, 24, 20, 23.08, 'True'),
(283, 76, 5.25, 44, 30, 0, 'True'),
(284, 76, 6.75, 3, 5, 0, 'True'),
(285, 76, 9, 2, 5, 0, 'True'),
(286, 77, 6.94, 65, 60, 0, 'True'),
(287, 78, 5.88, 68, 50, 0, 'True'),
(288, 78, 4.28, 67, 155, 0, 'True'),
(289, 78, 7.2, 74, 40, 0, 'True'),
(292, 79, 3.2, 26, 100, 0, 'True'),
(293, 79, 11, 37, 12, 0, 'True'),
(294, 80, 6, 25, 10, 0, 'True'),
(295, 81, 7.2, 74, 60, 0, 'True'),
(296, 81, 6.94, 65, 67, 0, 'True'),
(297, 81, 2.78, 66, 318, 0, 'True'),
(298, 82, 12.5, 42, 6, 0, 'True'),
(299, 83, 2.9, 36, 1092, 0, 'True'),
(300, 83, 12.5, 42, 100, 30.56, 'True'),
(301, 84, 12.5, 42, 70, 0, 'True'),
(302, 85, 12.5, 42, 10, 0, 'True'),
(303, 86, 1.5, 73, 100, 0, 'True'),
(304, 87, 6, 25, 26, 0, 'True'),
(305, 88, 7.2, 74, 69, 0, 'True'),
(306, 89, 19, 72, 5, 0, 'True'),
(307, 90, 4.28, 67, 193, 0, 'True'),
(308, 90, 2.88, 69, 151, 0, 'True'),
(309, 91, 4.11, 64, 117, 0, 'True'),
(310, 91, 6.94, 65, 67, 0, 'True'),
(311, 92, 4.2, 26, 100, 0, 'True'),
(312, 92, 6.5, 24, 20, 0, 'True'),
(313, 92, 4, 77, 128, 0, 'True'),
(314, 92, 10, 76, 49, 0, 'True'),
(317, 94, 5.25, 44, 1, 0, 'True'),
(318, 94, 6.5, 24, 1, 0, 'True'),
(319, 93, 7.5, 25, 29, 0, 'True'),
(320, 93, 5.55, 7, 50, 0, 'True'),
(321, 95, 0.55, 70, 252, 27.27, 'True'),
(322, 95, 0.6, 71, 252, 33.33, 'True'),
(323, 96, 2.88, 69, 49, 0, 'True'),
(324, 96, 4.28, 67, 100, 0, 'True'),
(325, 96, 6.94, 65, 64, 0, 'True'),
(326, 96, 2.78, 66, 150, 0, 'True'),
(327, 97, 4.11, 64, 125, 0, 'True'),
(328, 97, 2.78, 66, 18, 0, 'True'),
(329, 97, 12.5, 42, 15, 0, 'True'),
(330, 98, 8.75, 23, 5, 0, 'True'),
(331, 99, 6.94, 65, 69, 0, 'True'),
(332, 99, 2.78, 66, 166, 0, 'True'),
(333, 99, 2.88, 69, 152, 0, 'True'),
(334, 99, 4.28, 67, 200, 0, 'True'),
(337, 100, 4.2, 26, 70, 28.57, 'True'),
(338, 100, 11, 37, 25, 0, 'True'),
(339, 101, 0.55, 70, 2016, 27.27, 'True'),
(340, 101, 0.6, 71, 2016, 33.33, 'True'),
(341, 102, 0.55, 70, 252, 27.27, 'True'),
(342, 102, 0.6, 71, 252, 33.33, 'True'),
(343, 103, 4.2, 26, 10, 0, 'True'),
(344, 104, 4.28, 67, 295, 0, 'True'),
(345, 104, 6.94, 65, 67, 0, 'True'),
(346, 104, 2.78, 66, 168, 0, 'True'),
(347, 105, 1.5, 73, 100, 0, 'True'),
(348, 106, 7.2, 74, 30, 0, 'True'),
(349, 107, 12.5, 42, 15, 0, 'True'),
(350, 108, 4.2, 26, 60, 0, 'True'),
(351, 108, 11, 78, 17, 0, 'True'),
(352, 109, 2.88, 69, 100, 0, 'True'),
(353, 109, 4.28, 67, 102, 0, 'True'),
(354, 109, 4.11, 64, 146, 0, 'True'),
(355, 109, 6.94, 65, 65, 0, 'True'),
(356, 109, 2.78, 66, 189, 0, 'True'),
(357, 110, 7.2, 74, 60, 0, 'True'),
(358, 111, 8.75, 23, 10, 0, 'True'),
(359, 111, 19, 72, 10, 0, 'True'),
(360, 112, 12.5, 42, 8, 0, 'True'),
(361, 113, 6.94, 65, 64, 0, 'True'),
(362, 113, 2.78, 66, 164, 0, 'True'),
(363, 113, 2.88, 69, 60, 0, 'True'),
(364, 113, 4.28, 67, 208, 0, 'True'),
(365, 114, 1.5, 73, 100, 0, 'True'),
(366, 115, 7.2, 74, 200, 0, 'True'),
(367, 116, 2.88, 69, 60, 0, 'True'),
(368, 116, 4.28, 67, 100, 0, 'True'),
(369, 116, 4.11, 64, 61, 0, 'True'),
(370, 116, 6.94, 65, 65, 0, 'True'),
(371, 116, 2.78, 66, 162, 0, 'True'),
(372, 117, 2.88, 69, 100, 0, 'True'),
(373, 117, 4.28, 67, 100, 0, 'True'),
(374, 117, 4.11, 64, 118, 0, 'True'),
(375, 117, 6.94, 65, 30, 0, 'True'),
(376, 117, 2.78, 66, 108, 0, 'True'),
(377, 117, 7.2, 74, 60, 0, 'True'),
(378, 118, 12.5, 42, 5, 0, 'True'),
(379, 118, 7.2, 74, 12, 0, 'True'),
(380, 119, 12.5, 42, 15, 0, 'True'),
(381, 120, 5.88, 68, 20, 0, 'True'),
(382, 120, 4.28, 67, 100, 0, 'True'),
(383, 120, 2.78, 66, 162, 0, 'True'),
(384, 120, 6.94, 65, 68, 0, 'True'),
(385, 121, 2.9, 36, 822, 0, 'True'),
(386, 121, 12.5, 42, 169, 0, 'True'),
(389, 122, 11, 37, 25, 0, 'True'),
(390, 122, 4.2, 26, 50, 11.9, 'True'),
(391, 123, 6.94, 65, 50, 0, 'True'),
(392, 123, 2.88, 69, 100, 0, 'True'),
(393, 123, 4.28, 67, 200, 0, 'True');

-- --------------------------------------------------------

--
-- Table structure for table `tbm_offers`
--

CREATE TABLE `tbm_offers` (
  `id` int(11) NOT NULL,
  `sales_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `client_id` bigint(20) DEFAULT NULL,
  `datedate` date DEFAULT NULL,
  `notes` text,
  `warrantee` text,
  `offervalidity` text,
  `paymentterms` text,
  `currency_id` int(11) DEFAULT NULL,
  `currencyvalue` varchar(1000) DEFAULT NULL,
  `totalprice` varchar(1000) DEFAULT NULL,
  `discountprice1` varchar(1000) DEFAULT NULL,
  `discountprice2` varchar(1000) DEFAULT NULL,
  `totalnet` varchar(1000) DEFAULT NULL,
  `deliverylocations` text,
  `vat` varchar(100) DEFAULT NULL,
  `po_number` varchar(1000) DEFAULT NULL,
  `do_number` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbm_offers`
--

INSERT INTO `tbm_offers` (`id`, `sales_id`, `status_id`, `client_id`, `datedate`, `notes`, `warrantee`, `offervalidity`, `paymentterms`, `currency_id`, `currencyvalue`, `totalprice`, `discountprice1`, `discountprice2`, `totalnet`, `deliverylocations`, `vat`, `po_number`, `do_number`) VALUES
(1, 1, 1, 1, '2024-11-25', '', 'All SUNDRAY products are warranted against any manufacturing defects for a period of two years from the date of shipping.\r\nUniquely backed by ISO 9001 Quality certificate.', '6 weeks from offer date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '225', '0.00', '0.00', '249.75', 'Lebanon', '11.00', '', 0),
(2, 1, 1, 201, '2025-05-12', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from offer date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '14', '0.00', '0.00', '15.54', 'JBEIL CENTER MAR BOUTROS & BOULOS - JBEIL - Lebanon', '11.00', '', 0),
(3, 1, 1, 1001, '2026-01-15', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from offer date.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '4.2', '0.00', '0.00', '4.66', 'SAFRA - KESERWAN - SAFRA - Lebanon', '11.00', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbm_offers_det`
--

CREATE TABLE `tbm_offers_det` (
  `id` int(11) NOT NULL,
  `offers_id` int(11) DEFAULT NULL,
  `default_price` float DEFAULT NULL,
  `products_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `show_discount` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbm_offers_det`
--

INSERT INTO `tbm_offers_det` (`id`, `offers_id`, `default_price`, `products_id`, `qty`, `discount`, `show_discount`) VALUES
(1, 1, 25, 45, 4, 0, 'True'),
(2, 1, 25, 43, 5, 0, 'True'),
(10, 2, 9, 2, 2, 22.22, ''),
(11, 2, 8, 49, 1, 99.99, ''),
(12, 3, 4.2, 26, 1, 0, 'True');

-- --------------------------------------------------------

--
-- Table structure for table `tbm_payment`
--

CREATE TABLE `tbm_payment` (
  `id` int(11) NOT NULL,
  `datedate` varchar(1000) DEFAULT NULL,
  `amount` varchar(1000) DEFAULT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `currencyvalue` varchar(1000) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `client_id` bigint(20) DEFAULT NULL,
  `sales_id` int(11) DEFAULT NULL,
  `memo` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbm_payment`
--

INSERT INTO `tbm_payment` (`id`, `datedate`, `amount`, `address`, `note`, `supplier_id`, `currencyvalue`, `currency_id`, `client_id`, `sales_id`, `memo`) VALUES
(1, '2025-03-14', '0', '', '', 5, '1', 1, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbm_products`
--

CREATE TABLE `tbm_products` (
  `id` int(11) NOT NULL,
  `itemcode` varchar(1000) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `title` varchar(1000) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `active` varchar(1000) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `default_price` varchar(1000) DEFAULT NULL,
  `stocks_notifications` varchar(1000) DEFAULT NULL,
  `datedate` date DEFAULT NULL,
  `title_ar` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `mof_price` varchar(1000) DEFAULT NULL,
  `barcode` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbm_products`
--

INSERT INTO `tbm_products` (`id`, `itemcode`, `title`, `active`, `photo`, `category_id`, `default_price`, `stocks_notifications`, `datedate`, `title_ar`, `mof_price`, `barcode`) VALUES
(1, 'FC300', 'CLASS 300', 'True', NULL, 1, '10.95', '100', '2024-11-25', NULL, '0', NULL),
(2, 'FF300', 'FUNTEX 300', 'True', NULL, 1, '9.00', '100', '2024-11-25', '', '9.00', '52850006509'),
(3, 'FF200', 'FUNTEX 200', 'True', '4952websitefuntex-200.jpg', 1, '6.75', '100', '2024-11-25', '', '6.75', 'FUNTEX 200'),
(4, 'FS300', 'SUMBA 300', 'True', NULL, 1, '8', '100', '2024-11-25', NULL, '0', NULL),
(5, 'FS200', 'FACIAL TISSUE SUMBA 200 SHEET 10 PACK', 'True', NULL, 1, '4.92', '100', '2024-11-25', NULL, '0', NULL),
(6, 'FPLUM', 'FACIAL TISSUE PLUME 10 PACK', 'True', NULL, 1, '4.5', '100', '2024-11-25', NULL, '0', NULL),
(7, 'FPD', 'PANDA 130', 'True', NULL, 1, '5.55', '100', '2024-11-25', '', '5.55', ''),
(8, 'FR76 CIGAR', 'FACIAL TISSUE RAMTEX 76 SHEET 48 PACK', 'True', NULL, 1, '25', '100', '2024-11-25', NULL, '0', NULL),
(9, 'FR150', 'FACIAL TISSUE RAMTEX 150 SHEETS SOFT 24 PACK', 'True', NULL, 1, '23', '100', '2024-11-25', NULL, '0', NULL),
(10, 'TECO', 'TOILET PAPER ECONOMY 12 ROLL', 'True', NULL, 2, '2.49', '100', '2024-11-25', '', '0', 'TOILET PAPER ECONOMY 12 ROLL'),
(11, 'TRAM', 'TOILET PAPER RAMTEX 24 ROLLS 6 PACKS', 'True', NULL, 2, '6.25', '100', '2024-11-25', '', '0', ''),
(12, 'TS32N', 'TOILET PAPER SUMBA 32 ROLL', 'True', NULL, 2, '4.63', '100', '2024-11-25', NULL, '0', NULL),
(13, 'TS18', 'SUMBA 18 ROLL', 'True', NULL, 2, '3.35', '100', '2024-11-25', NULL, '0', NULL),
(14, 'TS900', 'SUMBA 9 ROLL', 'True', NULL, 2, '1.65', '100', '2024-11-25', NULL, '0', NULL),
(15, 'TS700', 'SUMBA 24 ROLL (6X4 PACKS)', 'True', NULL, 2, '5', '100', '2024-11-25', NULL, '0', NULL),
(16, 'TJOY10', 'JOYTEX 10 ROLL', 'True', NULL, 2, '2.19', '100', '2024-11-25', NULL, '0', NULL),
(17, 'TJOY18', 'JOYTEX 18 ROLL', 'True', NULL, 2, '3.3', '100', '2024-11-25', NULL, '0', NULL),
(18, 'STBL', 'SUMBA TRASH BAGS LARGE (12 ROLL* 30 BAGS) ', 'True', NULL, 3, '19.0', '100', '2024-11-25', '', '0', 'SUMBA TRASH BAGS LARGE (12 ROLL* 30 BAGS) '),
(19, 'TBMB', 'RAMTEX MEDIUM (12 ROLL* 30 BAGS) BLACK', 'True', NULL, 3, '12.70', '100', '2024-11-25', NULL, '0', NULL),
(20, 'STBSW', 'SUMBA TRASH BAGSSMALL (12*30) WHITE', 'True', '9593websiteBNHH3494.JPG', 3, '7', '100', '2024-11-25', '', '7', 'SUMBA TRASH BAGSSMALL (12*30) WHITE'),
(21, 'TTBL', 'RAMTEX LARGE (12 ROLL* 15 BAGS) BLUE', 'True', NULL, 3, '11.65', '100', '2024-11-25', NULL, '0', NULL),
(22, 'STBM', 'SUMBA TRASH BAGS MEDIUM BLACK', 'True', NULL, 3, '15', '100', '2024-11-25', '', '15', 'SUMBA TRASH BAGS MEDIUM BLACK'),
(23, 'NTFW200N', 'HAND TOWEL 200 SHEETS WHITE 10 PACK', 'True', NULL, 5, '8.75', '100', '2024-11-25', '', '8.75', ''),
(24, 'NTFW200G', 'HAND TOWEL 200 GRS WHITE 1X10', 'True', NULL, 5, '6.5', '10000', '2024-11-25', '', '6.5', ''),
(25, 'NTFR200N', 'CLEAR REG 200 SHTS  (1X10 PACK)', 'True', NULL, 5, '7.5', '100', '2024-11-25', NULL, '7.5', NULL),
(26, 'NTFC200G', 'INTERFOLD COM 2PLY 200 GRS NYLON (1X10)', 'True', NULL, 5, '4.2', '100', '2024-11-25', NULL, '4.2', NULL),
(27, 'INCHEF', 'INTERFOLD LE CHEF 2 PLY 200 SHEET 10 PACK', 'True', NULL, 5, '10', '100', '2024-11-25', NULL, '0', NULL),
(28, 'NAP LC 50', 'NAPKIN LE CHEF 33 X 33 2 PLY  50 SHEET X 40 PACK', 'True', NULL, 6, '27', '100', '2024-11-25', NULL, '27', NULL),
(29, 'NAPK1 ', 'NAPKIN (1 P) 33 3000 SHEET N 375 ST 8 PACK', 'True', NULL, 6, '10', '100', '2024-11-25', NULL, '0', NULL),
(30, 'MNBARN', 'MINIBAR 1PLY 3600SHT NYLON (180SHTX20 PKT)', 'True', NULL, 7, '10', '100', '2024-11-25', NULL, '0', NULL),
(31, 'MNBAR2N', 'MINI BAR (2 P) N 2400 SHEET (120SHTX20 PKT)', 'True', NULL, 7, '10', '100', '2024-11-25', NULL, '0', NULL),
(32, 'CLS50', 'CLINIC SHEET 50 M (1X6)', 'True', NULL, 8, '16', '100', '2024-11-25', NULL, '0', NULL),
(33, 'CLS85', 'CLINIC SHEET 85 M (1X4)', 'True', NULL, 8, '3.38', '100', '2024-11-25', '', '3.38', ''),
(34, 'CLS85', 'CLINIC SHEET 85 M (1X2)', 'True', NULL, 8, '16', '100', '2024-11-25', NULL, '0', NULL),
(35, 'CLS100', 'CLINIC SHEET 100 M (1X2)', 'True', NULL, 8, '11', '100', '2024-11-25', NULL, '0', NULL),
(36, 'ACUT100', 'AUTO CUT 100M (1X6 ROLL) 1 PLY', 'True', NULL, 9, '2.9', '100', '2024-11-25', NULL, '2.9', NULL),
(37, 'MDROL', 'MIDI ROLL WHITE (1X6 ROLL) 2 PLY', 'True', NULL, 9, '11', '100', '2024-11-25', '', '11', ''),
(38, 'MDCK', 'MIDI ROLL COM (1X6 ROLL) 2 PLY', 'True', NULL, 9, '10', '100', '2024-11-25', NULL, '0', NULL),
(39, 'MD1C6', 'MIDI ROLL COM (1X6 ROLL) 1 PLY', 'True', NULL, 9, '14', '100', '2024-11-25', NULL, '0', NULL),
(40, 'MROLLW', 'MEGA ROLL  (1X12 ROLL) ', 'True', NULL, 10, '8.86', '100', '2024-11-25', '', '0', ''),
(41, 'TL3000G', 'TOILET 3 KG WHITE 12 ROLL (1X12)', 'True', NULL, 10, '8.5', '100', '2024-11-25', NULL, '0', NULL),
(42, 'MROLR128', 'MEGA ROLL .5 KGS (1X12 ROLL)', 'True', NULL, 10, '12.5', '100', '2024-11-25', '', '0', ''),
(43, 'FR76', 'RAMTEX EXPRESSIONS TISSUES 76 SHEET', 'True', NULL, 1, '25', '100', '2024-11-25', NULL, '0', NULL),
(44, 'TRAM20', 'TOILET PAPER RAMTEX 20 ROLL', 'True', '5016websitetram20.jpg', 2, '5.25', '100', '2024-11-25', '', '0', 'TOILET PAPER RAMTEX 20 ROLL'),
(45, 'FR 150 BLUE', 'RAMTEX 150 SHEETS SOFT 24 PACK BLUE', 'True', NULL, 1, '25', '100', '2024-11-25', NULL, '0', NULL),
(46, 'TFUN', 'T. FUNTEX 24 ROLL', 'True', NULL, 2, '3.31', '100', '2024-11-25', NULL, '0', NULL),
(47, 'INTDISP', 'INTERFOLD DISPENSER', 'True', NULL, 18, '10', '100', '2024-11-25', NULL, '0', NULL),
(48, '48', 'SOAP DISPENSER', 'True', NULL, 18, '8', '100', '2024-11-25', NULL, '0', NULL),
(49, '49', 'AMERICAN NAPKIN DISPENSER', 'True', NULL, 18, '8', '100', '2024-11-25', NULL, '0', NULL),
(50, '50', 'CENTER PULL DISPENSER', 'True', NULL, 18, '20', '100', '2024-11-25', NULL, '0', NULL),
(51, '51', 'MEGAROLL DISPENSER', 'True', NULL, 18, '12', '100', '2024-11-25', NULL, '0', NULL),
(52, '52', 'MINIBAR DISPENSER', 'True', NULL, 18, '10', '100', '2024-11-25', NULL, '0', NULL),
(53, 'LS4', 'LIQUID SOAP', 'True', NULL, 19, '4', '100', '2024-11-25', NULL, '0', NULL),
(54, 'AF25', 'ALUMINUM FOIL 30 CM', 'True', NULL, 17, '23', '100', '2024-11-25', NULL, '0', NULL),
(55, 'AF37', 'ALUMINUM FOIL 45 CM', 'True', NULL, 17, '28', '100', '2024-11-25', NULL, '0', NULL),
(56, 'AF12', 'ALUMINUM FOIL 12 CM', 'True', NULL, 17, '53', '100', '2024-11-25', NULL, '0', NULL),
(57, '57', 'CLING FILM 30 CM', 'True', NULL, 17, '10', '100', '2024-11-25', NULL, '0', NULL),
(58, '58', 'MP4 GREEN TEA AND LEMON SHOWER GEL 750ML', 'True', NULL, 20, '12', '100', '2024-11-25', NULL, '0', NULL),
(59, '59', 'MP4 BODYMILK COCOA BUTTER 650ML', 'True', NULL, 20, '11', '100', '2024-11-25', NULL, '0', NULL),
(60, '60', 'MP4 LIQUID SOAP KIDS SAVANA 500ML', 'True', NULL, 21, '13', '100', '2024-11-25', NULL, '0', NULL),
(61, '61', 'Hair shampoo avocado', 'True', NULL, 22, '12', '100', '2024-11-25', NULL, '0', NULL),
(62, 'FPLUM', 'PLUME', 'True', NULL, 1, '8', '100', '2024-12-02', '', '9', 'PLUME'),
(63, 'STBXL', 'SUMBA TRASH BAGS XL', 'True', NULL, 3, '17', '100', '2025-01-08', '', '17', 'SUMBA TRASH BAGS XL'),
(64, 'FPURE170', 'FACIAL PURE 170 GRS', 'True', NULL, 1, '4.11', '100', '2025-01-27', '', '4.11', '2222200213242'),
(65, 'FPURE300', 'FACIAL PURE 300 GRS', 'True', '2066websiteOWZB5892.JPG', 1, '6.94', '100', '2025-03-18', '', '6.94', '2222200213341'),
(66, 'FPURE4', 'FACIAL PURE 300 GRS X 4 PACKS', 'True', NULL, 1, '2.78', '100', '2025-03-18', '', '2.78', '222220021914'),
(67, 'TPURE20', 'TOILET PURE 20 ROLL', 'True', NULL, 2, '4.28', '100', '2025-03-18', '', '4.28', '2222200213266'),
(68, 'TPURE4', 'TOILET PURE 24 ROLL', 'True', NULL, 2, '5.88', '100', '2025-03-18', '', '5.88', '222220021720'),
(69, 'TPURE12', 'TOILET PURE 12 ROLL', 'True', NULL, 2, '2.88', '100', '2025-03-18', '', '2.88', '222220022178'),
(70, 'WPP240', 'PURE 240', 'True', NULL, 31, '0.55', '10000000', '2025-03-27', '', '0.55', '52885000652472'),
(71, 'WPP290', 'PURE PADS 290', 'True', '1997websiteJRJQ0422.JPG', 31, '0.6', '10000000', '2025-03-27', '', '0.6', '5285000652465'),
(72, 'NAPK2AM', 'NAPKIN AMERICAN 2 PLY', 'True', NULL, 6, '19', '100', '2025-04-02', '', '19', ''),
(73, 'TBXXL', 'TRASH BAGS XXL', 'True', NULL, 3, '1.5', '1000', '2025-04-08', '', '1.5', ''),
(74, 'NTFW200N-JS', 'INTERFOLD WHITE 200 SHEETS JS', 'True', NULL, 5, '7.2', '100000', '2025-04-09', '', '7.2', '528500065113'),
(75, 'TH20', 'HAGE TOILET PAPER 20 ROLL', 'True', NULL, 2, '4.75', '1000', '2025-04-17', '', '4.75', ''),
(76, 'FH300', 'FACIAL TISSUE HAGE 300', 'True', NULL, 1, '10', '1000', '2025-04-17', '', '10', ''),
(77, 'FH170', 'FACIAL TISSUE HAGE 170GRS', 'True', NULL, 1, '4', '1000', '2025-04-17', '', '4', ''),
(78, 'CPR5', 'CENTER PULL REGULAR ', 'True', NULL, 9, '11', '10000', '2025-05-02', '', '11', ''),
(79, 'NTFWC200G', 'INTERFOLD CLASS 200 GRS', 'True', '', 5, '5', '10000000', '2025-05-22', '', '5', ''),
(80, 'TH18', 'Hage 18 roll', 'True', '', 2, '4', '2000', '2025-08-08', '', '4', ''),
(81, 'KR350', 'KITCHEN ROLL WHITE 1X8 ', 'True', '', 9, '7', '20', '2025-10-31', '', '7', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbm_products_client`
--

CREATE TABLE `tbm_products_client` (
  `id` int(11) NOT NULL,
  `products_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `price` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbm_products_client`
--

INSERT INTO `tbm_products_client` (`id`, `products_id`, `client_id`, `price`) VALUES
(547, 1, 1501, '0'),
(548, 3, 1501, '6.75'),
(549, 2, 1501, '9.00'),
(550, 77, 1501, '4'),
(551, 76, 1501, '10'),
(552, 7, 1501, '5.55'),
(553, 62, 1501, '8'),
(554, 6, 1501, '4.5'),
(555, 64, 1501, '4.11'),
(556, 65, 1501, '6.94'),
(557, 66, 1501, '2.78'),
(558, 45, 1501, '25'),
(559, 9, 1501, '23'),
(560, 43, 1501, '25'),
(561, 8, 1501, '25'),
(562, 5, 1501, '4.92'),
(563, 4, 1501, '8'),
(564, 10, 1501, '2.49'),
(565, 46, 1501, '3.31'),
(566, 75, 1501, '4.75'),
(567, 16, 1501, '2.19'),
(568, 17, 1501, '3.3'),
(569, 69, 1501, '2.88'),
(570, 67, 1501, '4.28'),
(571, 68, 1501, '5.88'),
(572, 11, 1501, '6.25'),
(573, 44, 1501, '5.25'),
(574, 13, 1501, '3.35'),
(575, 12, 1501, '4.63'),
(576, 15, 1501, '5'),
(577, 14, 1501, '1.65'),
(578, 18, 1501, '19.0'),
(579, 22, 1501, '15'),
(580, 20, 1501, '7'),
(581, 63, 1501, '17'),
(582, 19, 1501, '12.70'),
(583, 73, 1501, '1.5'),
(584, 21, 1501, '11.65'),
(585, 27, 1501, '10'),
(586, 26, 1501, '3.2'),
(587, 25, 1501, '6'),
(588, 24, 1501, '6.5'),
(589, 23, 1501, '8.75'),
(590, 74, 1501, '7.2'),
(591, 79, 1501, '5'),
(592, 28, 1501, '27'),
(593, 29, 1501, '10'),
(594, 72, 1501, '19'),
(595, 31, 1501, '10'),
(596, 30, 1501, '10'),
(597, 35, 1501, '11'),
(598, 32, 1501, '16'),
(599, 33, 1501, '3'),
(600, 34, 1501, '16'),
(601, 36, 1501, '2.9'),
(602, 78, 1501, '11'),
(603, 39, 1501, '14'),
(604, 38, 1501, '10'),
(605, 37, 1501, '11'),
(606, 40, 1501, '8.86'),
(607, 42, 1501, '11.5'),
(608, 41, 1501, '8.5'),
(609, 57, 1501, '10'),
(610, 56, 1501, '53'),
(611, 54, 1501, '23'),
(612, 55, 1501, '28'),
(613, 48, 1501, '8'),
(614, 49, 1501, '8'),
(615, 50, 1501, '20'),
(616, 51, 1501, '12'),
(617, 52, 1501, '10'),
(618, 47, 1501, '10'),
(619, 53, 1501, '4'),
(620, 58, 1501, '12'),
(621, 59, 1501, '11'),
(622, 60, 1501, '13'),
(623, 61, 1501, '12'),
(624, 70, 1501, '0.55'),
(625, 71, 1501, '0.6'),
(626, 1, 1601, '10.95'),
(627, 3, 1601, '6.75'),
(628, 2, 1601, '9.00'),
(629, 77, 1601, '4'),
(630, 76, 1601, '10'),
(631, 7, 1601, '5'),
(632, 62, 1601, '8'),
(633, 6, 1601, '4.5'),
(634, 64, 1601, '4.11'),
(635, 65, 1601, '6.94'),
(636, 66, 1601, '2.78'),
(637, 45, 1601, '25'),
(638, 9, 1601, '23'),
(639, 43, 1601, '25'),
(640, 8, 1601, '25'),
(641, 5, 1601, '4.92'),
(642, 4, 1601, '8'),
(643, 10, 1601, '2.49'),
(644, 46, 1601, '3.31'),
(645, 75, 1601, '4.75'),
(646, 16, 1601, '2.19'),
(647, 17, 1601, '3.3'),
(648, 69, 1601, '2.88'),
(649, 67, 1601, '4.28'),
(650, 68, 1601, '5.88'),
(651, 11, 1601, '6'),
(652, 44, 1601, '5.25'),
(653, 13, 1601, '3.35'),
(654, 12, 1601, '4.63'),
(655, 15, 1601, '5'),
(656, 14, 1601, '1.65'),
(657, 18, 1601, '19.0'),
(658, 22, 1601, '15'),
(659, 20, 1601, '7'),
(660, 63, 1601, '17'),
(661, 19, 1601, '12.70'),
(662, 73, 1601, '1.5'),
(663, 21, 1601, '11.65'),
(664, 27, 1601, '10'),
(665, 26, 1601, '3.2'),
(666, 25, 1601, '6'),
(667, 24, 1601, '6.5'),
(668, 23, 1601, '8'),
(669, 74, 1601, '7.2'),
(670, 79, 1601, '5'),
(671, 28, 1601, '27'),
(672, 29, 1601, '10'),
(673, 72, 1601, '19'),
(674, 31, 1601, '10'),
(675, 30, 1601, '10'),
(676, 35, 1601, '11'),
(677, 32, 1601, '16'),
(678, 33, 1601, '3'),
(679, 34, 1601, '16'),
(680, 36, 1601, '2.9'),
(681, 78, 1601, '11'),
(682, 39, 1601, '14'),
(683, 38, 1601, '10'),
(684, 37, 1601, '11'),
(685, 40, 1601, '8.86'),
(686, 42, 1601, '11.5'),
(687, 41, 1601, '8.5'),
(688, 57, 1601, '10'),
(689, 56, 1601, '53'),
(690, 54, 1601, '23'),
(691, 55, 1601, '28'),
(692, 48, 1601, '8'),
(693, 49, 1601, '8'),
(694, 50, 1601, '20'),
(695, 51, 1601, '12'),
(696, 52, 1601, '10'),
(697, 47, 1601, '10'),
(698, 53, 1601, '4'),
(699, 58, 1601, '12'),
(700, 59, 1601, '11'),
(701, 60, 1601, '13'),
(702, 61, 1601, '12'),
(703, 70, 1601, '0.55'),
(704, 71, 1601, '0.6'),
(705, 1, 1701, '10.95'),
(706, 3, 1701, '6.75'),
(707, 2, 1701, '9.00'),
(708, 77, 1701, '4'),
(709, 76, 1701, '10'),
(710, 7, 1701, '5.55'),
(711, 62, 1701, '8'),
(712, 6, 1701, '4.5'),
(713, 64, 1701, '4.11'),
(714, 65, 1701, '6.94'),
(715, 66, 1701, '2.78'),
(716, 45, 1701, '25'),
(717, 9, 1701, '23'),
(718, 43, 1701, '25'),
(719, 8, 1701, '25'),
(720, 5, 1701, '4.92'),
(721, 4, 1701, '8'),
(722, 10, 1701, '2.49'),
(723, 46, 1701, '3.31'),
(724, 75, 1701, '4.75'),
(725, 16, 1701, '2.19'),
(726, 17, 1701, '3.3'),
(727, 69, 1701, '2.88'),
(728, 67, 1701, '4.28'),
(729, 68, 1701, '5.88'),
(730, 11, 1701, '6.25'),
(731, 44, 1701, '5.25'),
(732, 13, 1701, '3.35'),
(733, 12, 1701, '4.63'),
(734, 15, 1701, '5'),
(735, 14, 1701, '1.65'),
(736, 18, 1701, '19.0'),
(737, 22, 1701, '15'),
(738, 20, 1701, '7'),
(739, 63, 1701, '17'),
(740, 19, 1701, '12.70'),
(741, 73, 1701, '1.5'),
(742, 21, 1701, '11.65'),
(743, 27, 1701, '10'),
(744, 26, 1701, '3.2'),
(745, 25, 1701, '6'),
(746, 24, 1701, '6.5'),
(747, 23, 1701, '8.75'),
(748, 74, 1701, '7.2'),
(749, 79, 1701, '5'),
(750, 28, 1701, '27'),
(751, 29, 1701, '10'),
(752, 72, 1701, '19'),
(753, 31, 1701, '10'),
(754, 30, 1701, '10'),
(755, 35, 1701, '11'),
(756, 32, 1701, '16'),
(757, 33, 1701, '3'),
(758, 34, 1701, '16'),
(759, 36, 1701, '3'),
(760, 78, 1701, '11'),
(761, 39, 1701, '14'),
(762, 38, 1701, '10'),
(763, 37, 1701, '11'),
(764, 40, 1701, '8.86'),
(765, 42, 1701, '18'),
(766, 41, 1701, '8.5'),
(767, 57, 1701, '10'),
(768, 56, 1701, '53'),
(769, 54, 1701, '23'),
(770, 55, 1701, '28'),
(771, 48, 1701, '8'),
(772, 49, 1701, '8'),
(773, 50, 1701, '20'),
(774, 51, 1701, '12'),
(775, 52, 1701, '10'),
(776, 47, 1701, '10'),
(777, 53, 1701, '4'),
(778, 58, 1701, '12'),
(779, 59, 1701, '11'),
(780, 60, 1701, '13'),
(781, 61, 1701, '12'),
(782, 70, 1701, '0.55'),
(783, 71, 1701, '0.6'),
(784, 1, 1801, '10.95'),
(785, 3, 1801, '6.75'),
(786, 2, 1801, '9.00'),
(787, 77, 1801, '4'),
(788, 76, 1801, '10'),
(789, 7, 1801, '5.55'),
(790, 62, 1801, '8'),
(791, 6, 1801, '4.5'),
(792, 64, 1801, '4.11'),
(793, 65, 1801, '6.94'),
(794, 66, 1801, '2.78'),
(795, 45, 1801, '25'),
(796, 9, 1801, '23'),
(797, 43, 1801, '25'),
(798, 8, 1801, '25'),
(799, 5, 1801, '4.92'),
(800, 4, 1801, '8'),
(801, 10, 1801, '2.49'),
(802, 46, 1801, '3.31'),
(803, 75, 1801, '4.75'),
(804, 16, 1801, '2.19'),
(805, 17, 1801, '3.3'),
(806, 69, 1801, '2.88'),
(807, 67, 1801, '4.28'),
(808, 68, 1801, '5.88'),
(809, 11, 1801, '6.25'),
(810, 44, 1801, '5.25'),
(811, 13, 1801, '3.35'),
(812, 12, 1801, '4.63'),
(813, 15, 1801, '5'),
(814, 14, 1801, '1.65'),
(815, 18, 1801, '19.0'),
(816, 22, 1801, '15'),
(817, 20, 1801, '7'),
(818, 63, 1801, '17'),
(819, 19, 1801, '12.70'),
(820, 73, 1801, '1.5'),
(821, 21, 1801, '11.65'),
(822, 27, 1801, '10'),
(823, 26, 1801, '3.2'),
(824, 25, 1801, '6'),
(825, 24, 1801, '6.5'),
(826, 23, 1801, '8.75'),
(827, 74, 1801, '7.2'),
(828, 79, 1801, '5'),
(829, 28, 1801, '27'),
(830, 29, 1801, '10'),
(831, 72, 1801, '19'),
(832, 31, 1801, '10'),
(833, 30, 1801, '10'),
(834, 35, 1801, '11'),
(835, 32, 1801, '16'),
(836, 33, 1801, '3.38'),
(837, 34, 1801, '16'),
(838, 36, 1801, '2.9'),
(839, 78, 1801, '11'),
(840, 39, 1801, '14'),
(841, 38, 1801, '10'),
(842, 37, 1801, '11'),
(843, 40, 1801, '8.86'),
(844, 42, 1801, '11.5'),
(845, 41, 1801, '8.5'),
(846, 57, 1801, '10'),
(847, 56, 1801, '53'),
(848, 54, 1801, '23'),
(849, 55, 1801, '28'),
(850, 48, 1801, '8'),
(851, 49, 1801, '8'),
(852, 50, 1801, '20'),
(853, 51, 1801, '12'),
(854, 52, 1801, '10'),
(855, 47, 1801, '10'),
(856, 53, 1801, '4'),
(857, 58, 1801, '12'),
(858, 59, 1801, '11'),
(859, 60, 1801, '13'),
(860, 61, 1801, '12'),
(861, 70, 1801, '0.55'),
(862, 71, 1801, '0.6'),
(863, 1, 801, '10.95'),
(864, 3, 801, '6.75'),
(865, 2, 801, '9.00'),
(866, 77, 801, '4'),
(867, 76, 801, '10'),
(868, 7, 801, '5.55'),
(869, 62, 801, '8'),
(870, 6, 801, '4.5'),
(871, 64, 801, '4.11'),
(872, 65, 801, '6.94'),
(873, 66, 801, '2.78'),
(874, 45, 801, '25'),
(875, 9, 801, '23'),
(876, 43, 801, '25'),
(877, 8, 801, '25'),
(878, 5, 801, '4.92'),
(879, 4, 801, '8'),
(880, 10, 801, '2.49'),
(881, 46, 801, '3.31'),
(882, 75, 801, '4.75'),
(883, 16, 801, '2.19'),
(884, 17, 801, '3.3'),
(885, 69, 801, '2.88'),
(886, 67, 801, '4.28'),
(887, 68, 801, '5.88'),
(888, 11, 801, '6.25'),
(889, 44, 801, '5.25'),
(890, 13, 801, '3.35'),
(891, 12, 801, '4.63'),
(892, 15, 801, '5'),
(893, 14, 801, '1.65'),
(894, 18, 801, '19.0'),
(895, 22, 801, '15'),
(896, 20, 801, '7'),
(897, 63, 801, '17'),
(898, 19, 801, '12.70'),
(899, 73, 801, '1.5'),
(900, 21, 801, '11.65'),
(901, 27, 801, '10'),
(902, 26, 801, '3.2'),
(903, 25, 801, '6'),
(904, 24, 801, '6.5'),
(905, 23, 801, '8.75'),
(906, 74, 801, '7.2'),
(907, 79, 801, '5'),
(908, 28, 801, '27'),
(909, 29, 801, '10'),
(910, 72, 801, '19'),
(911, 31, 801, '10'),
(912, 30, 801, '10'),
(913, 35, 801, '11'),
(914, 32, 801, '16'),
(915, 33, 801, '3.38'),
(916, 34, 801, '16'),
(917, 36, 801, '2.9'),
(918, 78, 801, '11'),
(919, 39, 801, '14'),
(920, 38, 801, '10'),
(921, 37, 801, '11'),
(922, 40, 801, '8.86'),
(923, 42, 801, '11.5'),
(924, 41, 801, '8.5'),
(925, 57, 801, '10'),
(926, 56, 801, '53'),
(927, 54, 801, '23'),
(928, 55, 801, '28'),
(929, 48, 801, '8'),
(930, 49, 801, '8'),
(931, 50, 801, '20'),
(932, 51, 801, '12'),
(933, 52, 801, '10'),
(934, 47, 801, '10'),
(935, 53, 801, '4'),
(936, 58, 801, '12'),
(937, 59, 801, '11'),
(938, 60, 801, '13'),
(939, 61, 801, '12'),
(940, 70, 801, '0.55'),
(941, 71, 801, '0.6'),
(1021, 1, 1101, '10.95'),
(1022, 3, 1101, '6.75'),
(1023, 2, 1101, '9.00'),
(1024, 77, 1101, '4'),
(1025, 76, 1101, '10'),
(1026, 7, 1101, '5.55'),
(1027, 62, 1101, '8'),
(1028, 6, 1101, '4.5'),
(1029, 64, 1101, '4.11'),
(1030, 65, 1101, '6.94'),
(1031, 66, 1101, '2.78'),
(1032, 45, 1101, '25'),
(1033, 9, 1101, '23'),
(1034, 43, 1101, '25'),
(1035, 8, 1101, '25'),
(1036, 5, 1101, '4.92'),
(1037, 4, 1101, '8'),
(1038, 10, 1101, '2.49'),
(1039, 46, 1101, '3.31'),
(1040, 75, 1101, '4.75'),
(1041, 16, 1101, '2.19'),
(1042, 17, 1101, '3.3'),
(1043, 69, 1101, '2.88'),
(1044, 67, 1101, '4.28'),
(1045, 68, 1101, '5.88'),
(1046, 11, 1101, '6.25'),
(1047, 44, 1101, '5.25'),
(1048, 13, 1101, '3.35'),
(1049, 12, 1101, '4.63'),
(1050, 15, 1101, '5'),
(1051, 14, 1101, '1.65'),
(1052, 18, 1101, '19.0'),
(1053, 22, 1101, '15'),
(1054, 20, 1101, '7'),
(1055, 63, 1101, '17'),
(1056, 19, 1101, '12.70'),
(1057, 73, 1101, '1.5'),
(1058, 21, 1101, '11.65'),
(1059, 27, 1101, '10'),
(1060, 26, 1101, '3.2'),
(1061, 25, 1101, '6'),
(1062, 24, 1101, '6.5'),
(1063, 23, 1101, '8.75'),
(1064, 74, 1101, '7.2'),
(1065, 79, 1101, '5'),
(1066, 28, 1101, '27'),
(1067, 29, 1101, '10'),
(1068, 72, 1101, '19'),
(1069, 31, 1101, '10'),
(1070, 30, 1101, '10'),
(1071, 35, 1101, '11'),
(1072, 32, 1101, '16'),
(1073, 34, 1101, '16'),
(1074, 33, 1101, '3.38'),
(1075, 36, 1101, '2.9'),
(1076, 78, 1101, '11'),
(1077, 39, 1101, '14'),
(1078, 38, 1101, '10'),
(1079, 37, 1101, '11'),
(1080, 40, 1101, '8.86'),
(1081, 42, 1101, '12.5'),
(1082, 41, 1101, '8.5'),
(1083, 57, 1101, '10'),
(1084, 56, 1101, '53'),
(1085, 54, 1101, '23'),
(1086, 55, 1101, '28'),
(1087, 48, 1101, '8'),
(1088, 49, 1101, '8'),
(1089, 50, 1101, '20'),
(1090, 51, 1101, '12'),
(1091, 52, 1101, '10'),
(1092, 47, 1101, '10'),
(1093, 53, 1101, '4'),
(1094, 58, 1101, '12'),
(1095, 59, 1101, '11'),
(1096, 60, 1101, '13'),
(1097, 61, 1101, '12'),
(1098, 70, 1101, '0.55'),
(1099, 71, 1101, '0.6'),
(1100, 1, 301, '10.95'),
(1101, 3, 301, '6.75'),
(1102, 2, 301, '9.00'),
(1103, 77, 301, '4'),
(1104, 76, 301, '10'),
(1105, 7, 301, '5.55'),
(1106, 62, 301, '8'),
(1107, 6, 301, '4.5'),
(1108, 64, 301, '4.11'),
(1109, 65, 301, '6.94'),
(1110, 66, 301, '2.78'),
(1111, 45, 301, '25'),
(1112, 9, 301, '23'),
(1113, 43, 301, '25'),
(1114, 8, 301, '25'),
(1115, 5, 301, '4.92'),
(1116, 4, 301, '8'),
(1117, 10, 301, '2.49'),
(1118, 46, 301, '3.31'),
(1119, 75, 301, '4.75'),
(1120, 16, 301, '2.19'),
(1121, 17, 301, '3.3'),
(1122, 69, 301, '2.88'),
(1123, 67, 301, '4.28'),
(1124, 68, 301, '5.88'),
(1125, 11, 301, '6.25'),
(1126, 44, 301, '5.25'),
(1127, 13, 301, '3.35'),
(1128, 12, 301, '4.63'),
(1129, 15, 301, '5'),
(1130, 14, 301, '1.65'),
(1131, 18, 301, '19.0'),
(1132, 22, 301, '15'),
(1133, 20, 301, '7'),
(1134, 63, 301, '17'),
(1135, 19, 301, '12.70'),
(1136, 73, 301, '1.5'),
(1137, 21, 301, '11.65'),
(1138, 27, 301, '10'),
(1139, 26, 301, '4.2'),
(1140, 25, 301, '6'),
(1141, 24, 301, '6.5'),
(1142, 23, 301, '9.84'),
(1143, 74, 301, '7.2'),
(1144, 79, 301, '5'),
(1145, 28, 301, '27'),
(1146, 29, 301, '10'),
(1147, 72, 301, '19'),
(1148, 31, 301, '10'),
(1149, 30, 301, '10'),
(1150, 35, 301, '11'),
(1151, 32, 301, '16'),
(1152, 34, 301, '16'),
(1153, 33, 301, '3'),
(1154, 36, 301, '2.9'),
(1155, 78, 301, '11'),
(1156, 39, 301, '14'),
(1157, 38, 301, '10'),
(1158, 37, 301, '11'),
(1159, 40, 301, '8.86'),
(1160, 42, 301, '11.5'),
(1161, 41, 301, '8.5'),
(1162, 57, 301, '10'),
(1163, 56, 301, '53'),
(1164, 54, 301, '23'),
(1165, 55, 301, '28'),
(1166, 48, 301, '8'),
(1167, 49, 301, '8'),
(1168, 50, 301, '20'),
(1169, 51, 301, '12'),
(1170, 52, 301, '10'),
(1171, 47, 301, '10'),
(1172, 53, 301, '4'),
(1173, 58, 301, '12'),
(1174, 59, 301, '11'),
(1175, 60, 301, '13'),
(1176, 61, 301, '12'),
(1177, 70, 301, '0.55'),
(1178, 71, 301, '0.6'),
(1179, 1, 901, '10.95'),
(1180, 3, 901, '6.75'),
(1181, 2, 901, '9.00'),
(1182, 77, 901, '4'),
(1183, 76, 901, '10'),
(1184, 7, 901, '5.55'),
(1185, 62, 901, '8'),
(1186, 6, 901, '4.5'),
(1187, 64, 901, '4.11'),
(1188, 65, 901, '6.94'),
(1189, 66, 901, '2.78'),
(1190, 45, 901, '25'),
(1191, 9, 901, '23'),
(1192, 43, 901, '25'),
(1193, 8, 901, '25'),
(1194, 5, 901, '4.92'),
(1195, 4, 901, '8'),
(1196, 10, 901, '2.49'),
(1197, 46, 901, '3.31'),
(1198, 75, 901, '4.75'),
(1199, 16, 901, '2.19'),
(1200, 17, 901, '3.3'),
(1201, 69, 901, '2.88'),
(1202, 67, 901, '4.28'),
(1203, 68, 901, '5.88'),
(1204, 11, 901, '6.25'),
(1205, 44, 901, '5.25'),
(1206, 13, 901, '3.35'),
(1207, 12, 901, '4.63'),
(1208, 15, 901, '5'),
(1209, 14, 901, '1.65'),
(1210, 18, 901, '19.0'),
(1211, 22, 901, '15'),
(1212, 20, 901, '7'),
(1213, 63, 901, '17'),
(1214, 19, 901, '12.70'),
(1215, 73, 901, '1.5'),
(1216, 21, 901, '11.65'),
(1217, 27, 901, '10'),
(1218, 26, 901, '4.2'),
(1219, 25, 901, '6'),
(1220, 24, 901, '6.5'),
(1221, 23, 901, '8.75'),
(1222, 74, 901, '7.2'),
(1223, 79, 901, '5'),
(1224, 28, 901, '27'),
(1225, 29, 901, '10'),
(1226, 72, 901, '19'),
(1227, 31, 901, '10'),
(1228, 30, 901, '10'),
(1229, 35, 901, '11'),
(1230, 32, 901, '16'),
(1231, 34, 901, '16'),
(1232, 33, 901, '3.38'),
(1233, 36, 901, '2.9'),
(1234, 78, 901, '11'),
(1235, 39, 901, '14'),
(1236, 38, 901, '10'),
(1237, 37, 901, '11'),
(1238, 40, 901, '8.86'),
(1239, 42, 901, '11.5'),
(1240, 41, 901, '8.5'),
(1241, 57, 901, '10'),
(1242, 56, 901, '53'),
(1243, 54, 901, '23'),
(1244, 55, 901, '28'),
(1245, 48, 901, '8'),
(1246, 49, 901, '8'),
(1247, 50, 901, '20'),
(1248, 51, 901, '12'),
(1249, 52, 901, '10'),
(1250, 47, 901, '10'),
(1251, 53, 901, '4'),
(1252, 58, 901, '12'),
(1253, 59, 901, '11'),
(1254, 60, 901, '13'),
(1255, 61, 901, '12'),
(1256, 70, 901, '0.55'),
(1257, 71, 901, '0.6'),
(1337, 1, 1001, '10.95'),
(1338, 3, 1001, '6.75'),
(1339, 2, 1001, '9.00'),
(1340, 77, 1001, '4'),
(1341, 76, 1001, '10'),
(1342, 7, 1001, '5.55'),
(1343, 62, 1001, '8'),
(1344, 6, 1001, '4.5'),
(1345, 64, 1001, '4.11'),
(1346, 65, 1001, '6.94'),
(1347, 66, 1001, '2.78'),
(1348, 45, 1001, '25'),
(1349, 9, 1001, '23'),
(1350, 43, 1001, '25'),
(1351, 8, 1001, '25'),
(1352, 5, 1001, '4.92'),
(1353, 4, 1001, '8'),
(1354, 10, 1001, '2.49'),
(1355, 46, 1001, '3.31'),
(1356, 80, 1001, '4'),
(1357, 75, 1001, '4.75'),
(1358, 16, 1001, '2.19'),
(1359, 17, 1001, '3.3'),
(1360, 69, 1001, '2.88'),
(1361, 67, 1001, '4.28'),
(1362, 68, 1001, '5.88'),
(1363, 11, 1001, '6.25'),
(1364, 44, 1001, '5.25'),
(1365, 13, 1001, '3.35'),
(1366, 12, 1001, '4.63'),
(1367, 15, 1001, '5'),
(1368, 14, 1001, '1.65'),
(1369, 18, 1001, '19.0'),
(1370, 22, 1001, '15'),
(1371, 20, 1001, '7'),
(1372, 63, 1001, '17'),
(1373, 19, 1001, '12.70'),
(1374, 73, 1001, '1.5'),
(1375, 21, 1001, '11.65'),
(1376, 27, 1001, '10'),
(1377, 26, 1001, '3.7'),
(1378, 25, 1001, '6'),
(1379, 24, 1001, '6.5'),
(1380, 23, 1001, '8.75'),
(1381, 74, 1001, '7.2'),
(1382, 79, 1001, '5'),
(1383, 28, 1001, '27'),
(1384, 29, 1001, '10'),
(1385, 72, 1001, '19'),
(1386, 31, 1001, '10'),
(1387, 30, 1001, '10'),
(1388, 35, 1001, '11'),
(1389, 32, 1001, '16'),
(1390, 34, 1001, '16'),
(1391, 33, 1001, '3.38'),
(1392, 36, 1001, '2.9'),
(1393, 78, 1001, '11'),
(1394, 81, 1001, '7'),
(1395, 39, 1001, '14'),
(1396, 38, 1001, '10'),
(1397, 37, 1001, '11'),
(1398, 40, 1001, '8.86'),
(1399, 42, 1001, '12.5'),
(1400, 41, 1001, '8.5'),
(1401, 57, 1001, '10'),
(1402, 56, 1001, '53'),
(1403, 54, 1001, '23'),
(1404, 55, 1001, '28'),
(1405, 48, 1001, '8'),
(1406, 49, 1001, '8'),
(1407, 50, 1001, '20'),
(1408, 51, 1001, '12'),
(1409, 52, 1001, '10'),
(1410, 47, 1001, '10'),
(1411, 53, 1001, '4'),
(1412, 58, 1001, '12'),
(1413, 59, 1001, '11'),
(1414, 60, 1001, '13'),
(1415, 61, 1001, '12'),
(1416, 70, 1001, '0.55'),
(1417, 71, 1001, '0.6');

-- --------------------------------------------------------

--
-- Table structure for table `tbm_receipt`
--

CREATE TABLE `tbm_receipt` (
  `id` int(11) NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `note` text,
  `currency_id` int(11) DEFAULT NULL,
  `currencyvalue` varchar(100) DEFAULT NULL,
  `client_id` bigint(20) DEFAULT NULL,
  `datedate` date DEFAULT NULL,
  `amount` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbm_receipt`
--

INSERT INTO `tbm_receipt` (`id`, `type_id`, `note`, `currency_id`, `currencyvalue`, `client_id`, `datedate`, `amount`) VALUES
(1, 1, '', 1, '1', 601, '2025-01-28', '100'),
(2, 1, '', 1, '1', 701, '2025-01-29', '306.87'),
(3, 1, '', 1, '1', 601, '2025-02-04', '200'),
(4, 1, '', 1, '1', 1001, '2025-04-23', '543.90'),
(5, 1, '', 1, '1.1295172203113686', 1101, '2025-04-24', '3993.25'),
(6, 1, '', 1, '1', 1201, '2025-05-15', '152.63'),
(7, 1, '', 1, '1', 1001, '2025-05-20', '614.94'),
(8, 1, '', 1, '1', 901, '2025-05-26', '172'),
(9, 1, '', 3, '89476.38603696099', 901, '2025-05-26', '1743000'),
(10, 1, '', 1, '1', 901, '2025-05-26', '1375'),
(11, 1, '', 3, '89500', 901, '2025-05-26', '13591000'),
(12, 1, '', 1, '1', 901, '2025-05-26', '2543'),
(13, 1, '', 3, '89500', 901, '2025-05-26', '17973000'),
(14, 1, '', 1, '1', 901, '2025-05-26', '610'),
(15, 1, '', 3, '89500', 901, '2025-05-26', '6090000'),
(16, 1, '', 1, '1', 901, '2025-05-26', '1050'),
(17, 1, '', 3, '89500', 901, '2025-05-26', '11122000'),
(18, 1, '', 1, '1', 901, '2025-05-26', '1300'),
(19, 1, '', 3, '89500', 901, '2025-05-26', '12907000'),
(20, 1, '', 1, '1', 1101, '2025-05-26', '3705.54'),
(21, 1, '', 1, '1', 301, '2025-06-03', '1000'),
(22, 1, '', 1, '1', 1601, '2025-06-11', '51.95'),
(23, 1, '#331507\r\n', 1, '1', 301, '2025-06-11', '924.74'),
(24, 1, '#331508', 1, '1', 1501, '2025-06-11', '405.16'),
(25, 1, '', 1, '1', 1301, '2025-06-24', '166.5'),
(26, 1, '', 1, '1', 1301, '2025-06-24', '333'),
(27, 1, '', 1, '1', 1101, '2025-07-03', '1715.84'),
(28, 1, '', 1, '1', 301, '2025-07-03', '793.65'),
(29, 1, '', 1, '1', 1201, '2025-07-03', '248.64'),
(30, 1, '', 1, '1', 901, '2025-07-10', '2293.24'),
(31, 1, '', 1, '1', 1701, '2025-07-10', '1159'),
(32, 1, '', 1, '1', 901, '2025-07-10', '2749.63'),
(33, 1, '', 1, '1', 901, '2025-07-10', '621.60'),
(34, 1, '', 1, '1', 901, '2025-07-10', '191.48'),
(35, 1, '', 1, '1', 1801, '2025-07-10', '2941.41'),
(36, 1, '', 1, '1', 701, '2025-07-10', '599.24'),
(37, 1, '', 1, '1', 801, '2025-07-10', '3929.4'),
(38, 1, '', 1, '1', 2001, '2025-07-10', '554.45'),
(39, 1, '', 1, '1', 1201, '2025-07-22', '250'),
(40, 1, '', 1, '1', 1001, '2025-07-22', '599.4'),
(41, 1, '', 1, '1', 901, '2025-07-22', '1981.95'),
(42, 1, '', 1, '1', 1101, '2025-07-22', '2597.51'),
(43, 1, '', 1, '1', 301, '2025-07-22', '1062.27'),
(44, 1, '', 1, '1', 301, '2025-07-31', '1062.27'),
(45, 1, '', 1, '1', 901, '2025-08-01', '2361.96'),
(46, 1, '', 1, '1', 1701, '2025-08-08', '941.2'),
(47, 2, '', 1, '1', 1101, '2025-08-11', '2643.6'),
(48, 1, '', 1, '1', 901, '2025-08-13', '1815.23'),
(49, 1, '', 1, '1', 901, '2025-08-14', '1373.56'),
(50, 1, '', 1, '1', 1201, '2025-08-20', '115'),
(51, 1, '', 1, '1', 1301, '2025-08-22', '166.5'),
(52, 1, '', 1, '1', 901, '2025-08-22', '710.29'),
(53, 1, '', 1, '1', 901, '2025-08-27', '2495.28'),
(54, 1, '', 1, '1', 1001, '2025-08-29', '501.72'),
(55, 1, '', 1, '1', 301, '2025-09-01', '735.1'),
(56, 1, '', 1, '1', 901, '2025-09-02', '399.6'),
(57, 1, '', 1, '1', 2101, '2025-09-05', '13.04'),
(58, 1, '', 1, '1', 1101, '2025-09-09', '1275.28'),
(59, 1, '', 1, '1', 301, '2025-09-19', '500'),
(60, 1, '', 1, '1', 901, '2025-09-19', '1278.51'),
(61, 1, '', 1, '1', 901, '2025-09-19', '462.1'),
(62, 1, '', 1, '1', 901, '2025-09-19', '1382.39'),
(63, 1, '', 1, '1', 301, '2025-09-23', '759.57'),
(64, 1, '', 1, '1', 901, '2025-09-29', '551.45'),
(65, 1, '', 1, '1', 901, '2025-09-29', '222.8'),
(66, 1, '', 1, '1', 901, '2025-09-29', '1976.93'),
(67, 1, '', 1, '1', 1501, '2025-10-06', '258'),
(68, 1, '', 1, '1', 301, '2025-10-06', '500'),
(69, 1, '', 1, '1', 1201, '2025-10-08', '154'),
(70, 1, '', 1, '1', 2201, '2025-10-08', '201'),
(71, 1, '', 1, '1', 901, '2025-10-08', '1049.89'),
(72, 1, '', 1, '1', 1001, '2025-10-16', '538.39'),
(73, 1, '', 1, '1', 1101, '2025-10-16', '549.45'),
(74, 1, '', 1, '1', 301, '2025-10-16', '522.7'),
(75, 1, '', 1, '1', 901, '2025-10-21', '1399.62'),
(76, 1, '', 1, '1', 1301, '2025-10-21', '166.5'),
(77, 1, '', 1, '1', 901, '2025-10-31', '1581.61'),
(78, 1, '', 1, '1', 301, '2025-10-31', '500'),
(79, 1, '', 1, '1', 1701, '2025-10-31', '4478.55'),
(80, 1, '', 1, '1', 2201, '2025-10-31', '0.61'),
(81, 1, '', 1, '1', 2301, '2025-10-31', '46.62'),
(82, 1, '', 1, '1', 1501, '2025-10-31', '0.06'),
(83, 1, '', 1, '1', 1601, '2025-10-31', '55.94'),
(84, 1, '', 1, '1', 1101, '2025-10-31', '4.07'),
(85, 1, '', 1, '1', 301, '2025-11-13', '500'),
(86, 1, '', 1, '1', 901, '2025-11-13', '833.93'),
(87, 1, '', 1, '1', 901, '2025-11-26', '239.76'),
(88, 1, '', 1, '1', 1001, '2025-11-26', '487'),
(89, 1, '', 1, '1', 901, '2025-11-26', '2436.03'),
(90, 1, '', 1, '1', 901, '2025-11-26', '2479.85'),
(91, 1, '', 1, '1', 1201, '2025-11-28', '307.83'),
(92, 1, '', 1, '1', 1301, '2025-11-28', '166.5'),
(93, 1, '', 1, '1', 901, '2025-12-08', '208.12'),
(94, 1, '', 1, '1', 301, '2025-12-08', '500'),
(95, 1, '', 1, '1', 901, '2025-12-24', '1598'),
(96, 1, '', 1, '1', 901, '2025-12-24', '4124.86'),
(97, 1, '', 1, '1', 901, '2025-12-24', '465'),
(98, 1, '', 1, '1', 901, '2025-12-24', '111'),
(99, 1, '', 1, '1', 901, '2025-12-24', '2554.27'),
(100, 1, 'Credit note ', 1, '1', 901, '2025-12-24', '99.93');

-- --------------------------------------------------------

--
-- Table structure for table `tbm_return`
--

CREATE TABLE `tbm_return` (
  `id` int(11) NOT NULL,
  `sales_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `client_id` bigint(20) DEFAULT NULL,
  `datedate` date DEFAULT NULL,
  `notes` text,
  `warrantee` text,
  `returnvalidity` text,
  `paymentterms` text,
  `currency_id` int(11) DEFAULT NULL,
  `currencyvalue` varchar(1000) DEFAULT NULL,
  `totalprice` varchar(1000) DEFAULT NULL,
  `discountprice1` varchar(1000) DEFAULT NULL,
  `discountprice2` varchar(1000) DEFAULT NULL,
  `totalnet` varchar(1000) DEFAULT NULL,
  `deliverylocations` text,
  `vat` varchar(100) DEFAULT NULL,
  `ro_number` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbm_return`
--

INSERT INTO `tbm_return` (`id`, `sales_id`, `status_id`, `client_id`, `datedate`, `notes`, `warrantee`, `returnvalidity`, `paymentterms`, `currency_id`, `currencyvalue`, `totalprice`, `discountprice1`, `discountprice2`, `totalnet`, `deliverylocations`, `vat`, `ro_number`) VALUES
(2, 1, 1, 1901, '2025-07-09', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from Return Validity.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '75', '0.00', '0.00', '83.25', 'JOUNIEH BEACH BOULEVARD - KESERWAN - JOUNIEH - Lebanon', '11.00', ''),
(3, 1, 1, 1501, '2025-07-11', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from Return Validity.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '294', '0.00', '0.00', '326.34', 'Nahr Ibrahim - Kesserwan - Nahr Ibrahim - Lebanon', '11.00', ''),
(4, 1, 1, 301, '2025-06-03', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from Return Validity.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '389.03', '0.00', '0.00', '431.82', 'JBEIL MAIN STREET - JBEIL - JBEIL - Lebanon', '11.00', ''),
(5, 1, 1, 1501, '2025-08-08', '', 'All RAMTEX Group sal products are warranted against any manufacturing defects.', '6 weeks from Return Validity.\r\n12 weeks from Order confirmation date.', '50% Cleared Funds with order Confirmation\r\n50% Prior to shipping', 1, '1', '366.25', '0.00', '0.00', '406.54', 'Nahr Ibrahim - Kesserwan - Nahr Ibrahim - Lebanon', '11.00', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbm_return_det`
--

CREATE TABLE `tbm_return_det` (
  `id` int(11) NOT NULL,
  `return_id` int(11) DEFAULT NULL,
  `default_price` float DEFAULT NULL,
  `products_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `show_discount` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbm_return_det`
--

INSERT INTO `tbm_return_det` (`id`, `return_id`, `default_price`, `products_id`, `qty`, `discount`, `show_discount`) VALUES
(2, 2, 1.5, 73, 50, 0, 'True'),
(3, 3, 7.2, 74, 20, 0, 'True'),
(4, 3, 5, 79, 30, 0, 'True'),
(5, 4, 8.75, 23, 50, 11.08, ''),
(6, 5, 6.5, 24, 20, 0, 'True'),
(7, 5, 5.25, 44, 30, 0, 'True'),
(8, 5, 6.75, 3, 5, 0, 'True'),
(9, 5, 9, 2, 5, 0, 'True');

-- --------------------------------------------------------

--
-- Table structure for table `tbm_sales`
--

CREATE TABLE `tbm_sales` (
  `id` int(11) NOT NULL,
  `gender_id` int(11) DEFAULT NULL,
  `fullname` varchar(1000) DEFAULT NULL,
  `job_id` int(11) DEFAULT NULL,
  `salary` varchar(1000) DEFAULT NULL,
  `pobox` varchar(1000) DEFAULT NULL,
  `country_id` varchar(1000) DEFAULT NULL,
  `address` text,
  `district` varchar(1000) DEFAULT NULL,
  `city` varchar(1000) DEFAULT NULL,
  `phone` varchar(1000) DEFAULT NULL,
  `fax` varchar(1000) DEFAULT NULL,
  `email` varchar(1000) DEFAULT NULL,
  `bankdetails` varchar(1000) DEFAULT NULL,
  `socialsecurityno` varchar(1000) DEFAULT NULL,
  `datedate` date DEFAULT NULL,
  `active` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbm_sales`
--

INSERT INTO `tbm_sales` (`id`, `gender_id`, `fullname`, `job_id`, `salary`, `pobox`, `country_id`, `address`, `district`, `city`, `phone`, `fax`, `email`, `bankdetails`, `socialsecurityno`, `datedate`, `active`) VALUES
(1, 4, 'Marwan Said', 17, '0', '', '1', '178 18th Street Hosrayel ,Jbeil Lebanon.', 'Jbeil', 'Hosray', '961.81.861.017', '961.81.861.017', 'sundray@sundray.com', '', '', '2017-01-02', 'True'),
(2, 4, 'CORPORATE', 18, '0', '', '1', '178 18TH STREET N.', '', 'HOSRAYEL, JBEIL', '09799555', '', 'INFO@RAMTEX.INFO', '', '', '2025-04-03', 'True'),
(3, 2, 'VICKIE TANNOUS', 18, '0', '', '1', '178 18TH STREET N.', '', 'HOSRAYEL, JBEIL', '03517416', '', 'VICKIE@RAMTEX.INFO', '', '', '2025-04-03', 'True');

-- --------------------------------------------------------

--
-- Table structure for table `tbm_statement`
--

CREATE TABLE `tbm_statement` (
  `id` int(11) NOT NULL,
  `datedate` date DEFAULT NULL,
  `incoming_price` varchar(100) DEFAULT NULL,
  `outgoing_price` varchar(100) DEFAULT NULL,
  `invoice_id` int(11) DEFAULT '0',
  `receipt_id` int(11) DEFAULT '0',
  `client_id` bigint(20) DEFAULT '0',
  `supplier_id` int(11) DEFAULT '0',
  `note` varchar(100) DEFAULT NULL,
  `currency_id` int(11) DEFAULT '0',
  `currencyvalue` varchar(100) DEFAULT NULL,
  `return_id` int(11) DEFAULT '0',
  `sales_id` int(11) DEFAULT '0',
  `payment_id` int(11) DEFAULT '0',
  `me` varchar(100) DEFAULT 'False'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbm_statement`
--

INSERT INTO `tbm_statement` (`id`, `datedate`, `incoming_price`, `outgoing_price`, `invoice_id`, `receipt_id`, `client_id`, `supplier_id`, `note`, `currency_id`, `currencyvalue`, `return_id`, `sales_id`, `payment_id`, `me`) VALUES
(4, '2025-01-08', '210.9', '0', 4, 0, 301, 0, '', 1, '1', 0, 0, 0, 'False'),
(6, '2025-01-28', '0', '100', 0, 1, 601, 0, '', 1, '1', 0, 0, 0, 'False'),
(8, '2025-01-29', '0', '306.87', 0, 2, 701, 0, '', 1, '1', 0, 0, 0, 'False'),
(9, '2025-01-29', '340.01', '0', 6, 0, 701, 0, '', 1, '1', 0, 0, 0, 'False'),
(14, '2025-02-04', '244.22', '0', 7, 0, 601, 0, '', 1, '1', 0, 0, 0, 'False'),
(16, '2025-02-04', '246.05', '0', 8, 0, 601, 0, '', 1, '1', 0, 0, 0, 'False'),
(17, '2025-02-04', '0', '200', 0, 3, 601, 0, '', 1, '1', 0, 0, 0, 'False'),
(18, '2025-02-17', '732.6', '0', 9, 0, 801, 0, '', 1, '1', 0, 0, 0, 'False'),
(19, '2025-02-17', '3196.8', '0', 10, 0, 801, 0, '', 1, '1', 0, 0, 0, 'False'),
(20, '2025-03-14', '0', '0', 0, 0, 0, 5, '', 1, '1', 0, 0, 1, 'False'),
(22, '2025-03-18', '2023.82', '0', 11, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(23, '2025-03-25', '1526.85', '0', 12, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(24, '2025-03-25', '191.48', '0', 13, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(25, '2025-03-27', '0', '0', 14, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(26, '2025-03-27', '0', '0', 14, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(27, '2025-04-02', '1526.8', '0', 15, 0, 1101, 0, '', 1, '1', 0, 0, 0, 'False'),
(28, '2025-04-02', '67.71', '0', 16, 0, 1201, 0, '', 1, '1', 0, 0, 0, 'False'),
(29, '2025-04-03', '799.29', '0', 17, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(30, '2025-04-04', '2008.66', '0', 18, 0, 1101, 0, '', 1, '1', 0, 0, 0, 'False'),
(31, '2025-04-08', '166.5', '0', 19, 0, 1301, 0, '', 1, '1', 0, 0, 0, 'False'),
(32, '2025-04-08', '543.9', '0', 20, 0, 1001, 0, '', 1, '1', 0, 0, 0, 'False'),
(33, '2025-04-09', '398.49', '0', 21, 0, 301, 0, '', 1, '1', 0, 0, 0, 'False'),
(38, '2025-04-09', '678.05', '0', 22, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(39, '2025-04-10', '84.92', '0', 23, 0, 1201, 0, '', 1, '1', 0, 0, 0, 'False'),
(41, '2025-04-11', '1174.28', '0', 24, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(43, '2025-04-17', '1526.25', '0', 26, 0, 301, 0, '', 1, '1', 0, 0, 0, 'False'),
(44, '2025-04-17', '1444.22', '0', 25, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(45, '2025-04-22', '1200.58', '0', 27, 0, 1101, 0, '', 1, '1', 0, 0, 0, 'False'),
(46, '2025-04-23', '0', '543.90', 0, 4, 1001, 0, '', 1, '1', 0, 0, 0, 'False'),
(48, '2025-04-24', '0', '3993.25', 0, 5, 1101, 0, '', 1, '1.1295172203113686', 0, 0, 0, 'False'),
(49, '2025-04-25', '174.82', '0', 28, 0, 1501, 0, '', 1, '1', 0, 0, 0, 'False'),
(50, '2025-04-25', '2504.96', '0', 29, 0, 1101, 0, '', 1, '1', 0, 0, 0, 'False'),
(51, '2025-05-02', '566.1', '0', 30, 0, 701, 0, '', 1, '1', 0, 0, 0, 'False'),
(52, '2025-05-03', '621.6', '0', 31, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(53, '2025-05-06', '191.48', '0', 32, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(54, '2025-05-12', '614.94', '0', 33, 0, 1001, 0, '', 1, '1', 0, 0, 0, 'False'),
(62, '2025-05-15', '50.5', '0', 34, 0, 1201, 0, '', 1, '1', 0, 0, 0, 'False'),
(63, '2025-05-15', '198.14', '0', 35, 0, 1201, 0, '', 1, '1', 0, 0, 0, 'False'),
(64, '2025-05-15', '0', '152.63', 0, 6, 1201, 0, '', 1, '1', 0, 0, 0, 'False'),
(65, '2025-05-16', '2429.95', '0', 36, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(66, '2025-05-17', '319.68', '0', 37, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(67, '2025-05-19', '166.5', '0', 38, 0, 1301, 0, '', 1, '1', 0, 0, 0, 'False'),
(68, '2025-05-20', '0', '614.94', 0, 7, 1001, 0, '', 1, '1', 0, 0, 0, 'False'),
(69, '2025-05-21', '517.26', '0', 39, 0, 1101, 0, '', 1, '1', 0, 0, 0, 'False'),
(70, '2025-05-22', '793.65', '0', 40, 0, 301, 0, '', 1, '1', 0, 0, 0, 'False'),
(71, '2025-05-22', '230.32', '0', 41, 0, 1501, 0, '', 1, '1', 0, 0, 0, 'False'),
(72, '2025-04-17', '0', '172', 0, 8, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(73, '2025-04-17', '0', '1743000', 0, 9, 901, 0, '', 3, '89476.38603696099', 0, 0, 0, 'False'),
(74, '2025-04-28', '0', '1375', 0, 10, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(75, '2025-04-28', '0', '13591000', 0, 11, 901, 0, '', 3, '89500', 0, 0, 0, 'False'),
(76, '2025-05-06', '0', '2543', 0, 12, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(77, '2025-05-06', '0', '17973000', 0, 13, 901, 0, '', 3, '89500', 0, 0, 0, 'False'),
(78, '2025-05-15', '0', '610', 0, 14, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(79, '2025-05-15', '0', '6090000', 0, 15, 901, 0, '', 3, '89500', 0, 0, 0, 'False'),
(80, '2025-05-15', '0', '1050', 0, 16, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(81, '2025-05-15', '0', '11122000', 0, 17, 901, 0, '', 3, '89500', 0, 0, 0, 'False'),
(82, '2025-05-20', '0', '1300', 0, 18, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(83, '2025-05-20', '0', '12907000', 0, 19, 901, 0, '', 3, '89500', 0, 0, 0, 'False'),
(84, '2025-05-26', '0', '3705.54', 0, 20, 1101, 0, '', 1, '1', 0, 0, 0, 'False'),
(85, '2025-05-27', '2293.24', '0', 42, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(86, '2025-05-28', '1062.27', '0', 43, 0, 301, 0, '', 1, '1', 0, 0, 0, 'False'),
(87, '2025-05-28', '51.95', '0', 44, 0, 1601, 0, '', 1, '1', 0, 0, 0, 'False'),
(88, '2025-05-29', '1158.84', '0', 45, 0, 1701, 0, '', 1, '1', 0, 0, 0, 'False'),
(90, '2025-05-30', '2941.41', '0', 46, 0, 801, 0, '', 1, '1', 0, 0, 0, 'False'),
(92, '2025-06-03', '1198.58', '0', 47, 0, 1101, 0, '', 1, '1', 0, 0, 0, 'False'),
(93, '2025-06-03', '0', '1000', 0, 21, 301, 0, '', 1, '1', 0, 0, 0, 'False'),
(94, '2025-06-03', '971.25', '0', 48, 0, 301, 0, '', 1, '1', 0, 0, 0, 'False'),
(95, '2025-06-04', '291.38', '0', 49, 0, 1501, 0, '', 1, '1', 0, 0, 0, 'False'),
(96, '2025-06-11', '0', '51.95', 0, 22, 1601, 0, '', 1, '1', 0, 0, 0, 'False'),
(97, '2025-06-11', '0', '924.74', 0, 23, 301, 0, '', 1, '1', 0, 0, 0, 'False'),
(98, '2025-06-11', '0', '405.16', 0, 24, 1501, 0, '', 1, '1', 0, 0, 0, 'False'),
(99, '2025-06-13', '735.1', '0', 50, 0, 301, 0, '', 1, '1', 0, 0, 0, 'False'),
(100, '2025-06-13', '1981.95', '0', 51, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(101, '2025-06-23', '83.25', '0', 52, 0, 1901, 0, '', 1, '1', 0, 0, 0, 'False'),
(103, '2025-06-24', '166.5', '0', 53, 0, 1301, 0, '', 1, '1', 0, 0, 0, 'False'),
(104, '2025-06-24', '0', '166.5', 0, 25, 1301, 0, '', 1, '1', 0, 0, 0, 'False'),
(105, '2025-06-24', '0', '333', 0, 26, 1301, 0, '', 1, '1', 0, 0, 0, 'False'),
(106, '2025-06-25', '2361.96', '0', 54, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(107, '2025-06-30', '2597.51', '0', 55, 0, 1101, 0, '', 1, '1', 0, 0, 0, 'False'),
(108, '2025-07-01', '326.34', '0', 56, 0, 1501, 0, '', 1, '1', 0, 0, 0, 'False'),
(109, '2025-07-02', '554.45', '0', 57, 0, 2001, 0, '', 1, '1', 0, 0, 0, 'False'),
(110, '2025-07-03', '0', '1715.84', 0, 27, 1101, 0, '', 1, '1', 0, 0, 0, 'False'),
(111, '2025-07-03', '0', '793.65', 0, 28, 301, 0, '', 1, '1', 0, 0, 0, 'False'),
(112, '2025-07-03', '0', '248.64', 0, 29, 1201, 0, '', 1, '1', 0, 0, 0, 'False'),
(113, '2025-07-03', '165.28', '0', 58, 0, 1201, 0, '', 1, '1', 0, 0, 0, 'False'),
(120, '2025-07-09', '599.4', '0', 59, 0, 1001, 0, '', 1, '1', 0, 0, 0, 'False'),
(121, '2025-07-09', '0', '83.25', 0, 0, 1901, 0, '', 1, '1', 2, 0, 0, 'False'),
(122, '2025-07-09', '1815.23', '0', 60, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(123, '2025-07-10', '0', '2293.24', 0, 30, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(124, '2025-07-10', '0', '1159', 0, 31, 1701, 0, '', 1, '1', 0, 0, 0, 'False'),
(125, '2025-07-10', '0', '2749.63', 0, 32, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(126, '2025-07-10', '0', '621.60', 0, 33, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(127, '2025-07-10', '0', '191.48', 0, 34, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(128, '2025-07-10', '0', '2941.41', 0, 35, 801, 0, '', 1, '1', 0, 0, 0, 'False'),
(129, '2025-07-10', '0', '599.24', 0, 36, 701, 0, '', 1, '1', 0, 0, 0, 'False'),
(130, '2025-07-10', '0', '3929.4', 0, 37, 801, 0, '', 1, '1', 0, 0, 0, 'False'),
(131, '2025-07-10', '0', '554.45', 0, 38, 2001, 0, '', 1, '1', 0, 0, 0, 'False'),
(132, '2025-07-11', '1373.96', '0', 61, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(135, '2025-07-11', '941.28', '0', 62, 0, 1701, 0, '', 1, '1', 0, 0, 0, 'False'),
(136, '2025-07-11', '0', '326.34', 0, 0, 1501, 0, '', 1, '1', 3, 0, 0, 'False'),
(137, '2025-07-11', '0', '431.82', 0, 0, 301, 0, '', 1, '1', 4, 0, 0, 'False'),
(138, '2025-07-18', '710.29', '0', 63, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(139, '2025-07-18', '84.36', '0', 64, 0, 1201, 0, '', 1, '1', 0, 0, 0, 'False'),
(140, '2025-07-22', '0', '250', 0, 39, 1201, 0, '', 1, '1', 0, 0, 0, 'False'),
(141, '2025-07-22', '0', '599.4', 0, 40, 1001, 0, '', 1, '1', 0, 0, 0, 'False'),
(142, '2025-07-22', '0', '1981.95', 0, 41, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(143, '2025-07-22', '0', '2597.51', 0, 42, 1101, 0, '', 1, '1', 0, 0, 0, 'False'),
(144, '2025-07-22', '0', '1062.27', 0, 43, 301, 0, '', 1, '1', 0, 0, 0, 'False'),
(147, '2025-07-24', '2495.28', '0', 65, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(148, '2025-07-25', '832.5', '0', 66, 0, 1101, 0, '', 1, '1', 0, 0, 0, 'False'),
(149, '2025-07-26', '48.56', '0', 67, 0, 1201, 0, '', 1, '1', 0, 0, 0, 'False'),
(150, '2025-07-31', '188.7', '0', 68, 0, 301, 0, '', 1, '1', 0, 0, 0, 'False'),
(151, '2025-07-31', '0', '1062.27', 0, 44, 301, 0, '', 1, '1', 0, 0, 0, 'False'),
(152, '2025-08-01', '1811.08', '0', 69, 0, 1101, 0, '', 1, '1', 0, 0, 0, 'False'),
(153, '2025-08-01', '0', '2361.96', 0, 45, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(154, '2025-08-01', '399.6', '0', 70, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(155, '2025-08-06', '55.94', '0', 71, 0, 1601, 0, '', 1, '1', 0, 0, 0, 'False'),
(156, '2025-08-07', '1278.51', '0', 72, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(157, '2025-08-08', '0', '941.2', 0, 46, 1701, 0, '', 1, '1', 0, 0, 0, 'False'),
(158, '2025-08-08', '1259.57', '0', 73, 0, 301, 0, '', 1, '1', 0, 0, 0, 'False'),
(160, '2025-08-08', '745.36', '0', 74, 0, 301, 0, '', 1, '1', 0, 0, 0, 'False'),
(161, '2025-08-08', '308.02', '0', 75, 0, 1101, 0, '', 1, '1', 0, 0, 0, 'False'),
(162, '2025-08-08', '373.24', '0', 76, 0, 1501, 0, '', 1, '1', 0, 0, 0, 'False'),
(163, '2025-08-08', '462.2', '0', 77, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(164, '2025-08-11', '0', '2643.6', 0, 47, 1101, 0, '', 1, '1', 0, 0, 0, 'False'),
(165, '2025-08-13', '0', '1815.23', 0, 48, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(166, '2025-08-13', '1382.39', '0', 78, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(168, '2025-08-14', '0', '1373.56', 0, 49, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(169, '2025-08-13', '501.72', '0', 79, 0, 1001, 0, '', 1, '1', 0, 0, 0, 'False'),
(170, '2025-08-18', '66.6', '0', 80, 0, 1201, 0, '', 1, '1', 0, 0, 0, 'False'),
(171, '2025-08-19', '1976.93', '0', 81, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(172, '2025-08-19', '83.25', '0', 82, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(173, '2025-08-20', '0', '115', 0, 50, 1201, 0, '', 1, '1', 0, 0, 0, 'False'),
(174, '2025-08-20', '4478.63', '0', 83, 0, 1701, 0, '', 1, '1', 0, 0, 0, 'False'),
(175, '2025-08-20', '971.25', '0', 84, 0, 1101, 0, '', 1, '1', 0, 0, 0, 'False'),
(176, '2025-08-20', '138.75', '0', 85, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(177, '2025-08-22', '166.5', '0', 86, 0, 1301, 0, '', 1, '1', 0, 0, 0, 'False'),
(178, '2025-08-22', '0', '166.5', 0, 51, 1301, 0, '', 1, '1', 0, 0, 0, 'False'),
(179, '2025-08-22', '0', '710.29', 0, 52, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(180, '2025-08-22', '173.16', '0', 87, 0, 301, 0, '', 1, '1', 0, 0, 0, 'False'),
(181, '2025-08-22', '551.45', '0', 88, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(182, '2025-08-25', '105.45', '0', 89, 0, 1201, 0, '', 1, '1', 0, 0, 0, 'False'),
(183, '2025-08-27', '0', '2495.28', 0, 53, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(184, '2025-08-27', '1399.62', '0', 90, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(185, '2025-08-29', '0', '501.72', 0, 54, 1001, 0, '', 1, '1', 0, 0, 0, 'False'),
(186, '2025-09-01', '0', '735.1', 0, 55, 301, 0, '', 1, '1', 0, 0, 0, 'False'),
(187, '2025-09-02', '0', '399.6', 0, 56, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(188, '2025-09-04', '1049.89', '0', 91, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(189, '2025-09-05', '1722.72', '0', 92, 0, 301, 0, '', 1, '1', 0, 0, 0, 'False'),
(191, '2025-09-05', '13.04', '0', 94, 0, 2101, 0, '', 1, '1', 0, 0, 0, 'False'),
(192, '2025-09-05', '549.45', '0', 93, 0, 1101, 0, '', 1, '1', 0, 0, 0, 'False'),
(193, '2025-09-05', '0', '13.04', 0, 57, 2101, 0, '', 1, '1', 0, 0, 0, 'False'),
(194, '2025-09-09', '0', '1275.28', 0, 58, 1101, 0, '', 1, '1', 0, 0, 0, 'False'),
(195, '2025-09-16', '201.61', '0', 95, 0, 301, 0, '', 1, '1', 0, 0, 0, 'False'),
(196, '2025-09-12', '0', '500', 0, 59, 301, 0, '', 1, '1', 0, 0, 0, 'False'),
(197, '2025-09-11', '0', '1278.51', 0, 60, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(198, '2025-09-12', '0', '462.1', 0, 61, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(199, '2025-09-16', '0', '1382.39', 0, 62, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(200, '2025-09-19', '1587.61', '0', 96, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(201, '2025-09-22', '0', '759.57', 0, 63, 301, 0, '', 1, '1', 0, 0, 0, 'False'),
(202, '2025-09-23', '833.93', '0', 97, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(203, '2025-09-29', '0', '551.45', 0, 64, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(204, '2025-09-29', '0', '222.8', 0, 65, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(205, '2025-09-25', '0', '1976.93', 0, 66, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(206, '2025-09-29', '0', '406.54', 0, 0, 1501, 0, '', 1, '1', 5, 0, 0, 'False'),
(207, '2025-10-02', '48.56', '0', 98, 0, 1201, 0, '', 1, '1', 0, 0, 0, 'False'),
(208, '2025-10-06', '0', '258', 0, 67, 1501, 0, '', 1, '1', 0, 0, 0, 'False'),
(209, '2025-10-06', '0', '500', 0, 68, 301, 0, '', 1, '1', 0, 0, 0, 'False'),
(210, '2025-10-06', '2479.85', '0', 99, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(212, '2025-10-07', '538.35', '0', 100, 0, 1001, 0, '', 1, '1', 0, 0, 0, 'False'),
(213, '2025-10-07', '1612.87', '0', 101, 0, 301, 0, '', 1, '1', 0, 0, 0, 'False'),
(214, '2025-10-07', '201.61', '0', 102, 0, 2201, 0, '', 1, '1', 0, 0, 0, 'False'),
(215, '2025-10-08', '0', '154', 0, 69, 1201, 0, '', 1, '1', 0, 0, 0, 'False'),
(216, '2025-10-08', '0', '201', 0, 70, 2201, 0, '', 1, '1', 0, 0, 0, 'False'),
(217, '2025-10-08', '0', '1049.89', 0, 71, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(218, '2025-10-08', '46.62', '0', 103, 0, 2301, 0, '', 1, '1', 0, 0, 0, 'False'),
(219, '2025-10-16', '0', '538.39', 0, 72, 1001, 0, '', 1, '1', 0, 0, 0, 'False'),
(220, '2025-10-16', '0', '549.45', 0, 73, 1101, 0, '', 1, '1', 0, 0, 0, 'False'),
(221, '2025-10-16', '0', '522.7', 0, 74, 301, 0, '', 1, '1', 0, 0, 0, 'False'),
(222, '2025-10-02', '0', '1399.62', 0, 75, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(223, '2025-10-21', '2436.03', '0', 104, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(224, '2025-10-21', '166.5', '0', 105, 0, 1301, 0, '', 1, '1', 0, 0, 0, 'False'),
(225, '2025-10-21', '0', '166.5', 0, 76, 1301, 0, '', 1, '1', 0, 0, 0, 'False'),
(226, '2025-10-24', '239.76', '0', 106, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(227, '2025-10-27', '0', '1581.61', 0, 77, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(228, '2025-10-29', '0', '500', 0, 78, 301, 0, '', 1, '1', 0, 0, 0, 'False'),
(229, '2025-10-31', '0', '4478.55', 0, 79, 1701, 0, '', 1, '1', 0, 0, 0, 'False'),
(230, '2025-10-31', '0', '0.61', 0, 80, 2201, 0, '', 1, '1', 0, 0, 0, 'False'),
(231, '2025-10-31', '0', '46.62', 0, 81, 2301, 0, '', 1, '1', 0, 0, 0, 'False'),
(232, '2025-10-31', '0', '0.06', 0, 82, 1501, 0, '', 1, '1', 0, 0, 0, 'False'),
(233, '2025-10-31', '0', '55.94', 0, 83, 1601, 0, '', 1, '1', 0, 0, 0, 'False'),
(234, '2025-10-31', '0', '4.07', 0, 84, 1101, 0, '', 1, '1', 0, 0, 0, 'False'),
(235, '2025-11-03', '208.12', '0', 107, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(236, '2025-11-11', '487.29', '0', 108, 0, 1001, 0, '', 1, '1', 0, 0, 0, 'False'),
(237, '2025-11-13', '0', '500', 0, 85, 301, 0, '', 1, '1', 0, 0, 0, 'False'),
(238, '2025-11-06', '0', '833.93', 0, 86, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(239, '2025-11-13', '2554.27', '0', 109, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(240, '2025-11-18', '479.52', '0', 110, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(241, '2025-11-26', '308.02', '0', 111, 0, 1201, 0, '', 1, '1', 0, 0, 0, 'False'),
(242, '2025-11-25', '0', '239.76', 0, 87, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(243, '2025-11-20', '0', '487', 0, 88, 1001, 0, '', 1, '1', 0, 0, 0, 'False'),
(244, '2025-11-20', '0', '2436.03', 0, 89, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(245, '2025-11-20', '0', '2479.85', 0, 90, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(246, '2025-11-26', '111', '0', 112, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(247, '2025-11-26', '2179.06', '0', 113, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(248, '2025-11-28', '0', '307.83', 0, 91, 1201, 0, '', 1, '1', 0, 0, 0, 'False'),
(249, '2025-11-28', '166.5', '0', 114, 0, 1301, 0, '', 1, '1', 0, 0, 0, 'False'),
(250, '2025-11-28', '0', '166.5', 0, 92, 1301, 0, '', 1, '1', 0, 0, 0, 'False'),
(251, '2025-12-05', '0', '208.12', 0, 93, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(252, '2025-12-08', '1598.4', '0', 115, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(253, '2025-12-05', '0', '500', 0, 94, 301, 0, '', 1, '1', 0, 0, 0, 'False'),
(254, '2025-12-12', '1945.8', '0', 116, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(255, '2025-12-22', '0', '1598', 0, 95, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(256, '2025-12-22', '0', '4124.86', 0, 96, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(257, '2025-12-22', '0', '465', 0, 97, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(258, '2025-12-22', '0', '111', 0, 98, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(259, '2025-12-22', '0', '2554.27', 0, 99, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(260, '2025-12-24', '0', '99.93', 0, 100, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(261, '2025-12-24', '2376.98', '0', 117, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(262, '2025-12-29', '165.28', '0', 118, 0, 1201, 0, '', 1, '1', 0, 0, 0, 'False'),
(263, '2025-12-30', '208.12', '0', 119, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(264, '2026-01-08', '1629.35', '0', 120, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False'),
(265, '2026-01-12', '4990.89', '0', 121, 0, 1701, 0, '', 1, '1', 0, 0, 0, 'False'),
(267, '2026-01-14', '510.61', '0', 122, 0, 1001, 0, '', 1, '1', 0, 0, 0, 'False'),
(268, '2026-01-16', '1655.01', '0', 123, 0, 901, 0, '', 1, '1', 0, 0, 0, 'False');

-- --------------------------------------------------------

--
-- Table structure for table `tbm_stocks`
--

CREATE TABLE `tbm_stocks` (
  `id` int(11) NOT NULL,
  `products_id` int(11) DEFAULT NULL,
  `incoming_qty` int(11) DEFAULT NULL,
  `outgoing_qty` int(11) DEFAULT NULL,
  `datedate` date DEFAULT NULL,
  `note` text,
  `invoice_id` int(11) DEFAULT '0',
  `return_id` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbm_stocks`
--

INSERT INTO `tbm_stocks` (`id`, `products_id`, `incoming_qty`, `outgoing_qty`, `datedate`, `note`, `invoice_id`, `return_id`) VALUES
(6, 2, 100, 0, '2024-12-12', '', 0, 0),
(7, 2, 100, 0, '2024-12-12', '', 1234, 0),
(9, 63, 0, 10, '2025-01-08', 'Submit Invoice', 4, 0),
(10, 44, 100, 0, '2025-01-23', '', 0, 0),
(11, 2, 0, 180, '2025-01-27', '', 0, 0),
(12, 44, 0, 100, '2025-01-27', '', 0, 0),
(13, 3, 10, 0, '2025-01-27', '', 0, 0),
(14, 7, 34, 0, '2025-01-27', '', 0, 0),
(20, 32, 0, 24, '2025-01-29', 'Update Invoice', 6, 0),
(21, 25, 0, 36, '2025-01-29', 'Update Invoice', 6, 0),
(22, 38, 0, 10, '2025-01-29', 'Update Invoice', 6, 0),
(42, 36, 0, 10, '2025-02-04', 'Update Invoice', 7, 0),
(43, 63, 0, 5, '2025-02-04', 'Update Invoice', 7, 0),
(44, 22, 0, 2, '2025-02-04', 'Update Invoice', 7, 0),
(45, 18, 0, 2, '2025-02-04', 'Update Invoice', 7, 0),
(51, 36, 0, 10, '2025-02-04', 'Update Invoice', 8, 0),
(52, 63, 0, 5, '2025-02-04', 'Update Invoice', 8, 0),
(53, 18, 0, 2, '2025-02-04', 'Update Invoice', 8, 0),
(54, 22, 0, 2, '2025-02-04', 'Update Invoice', 8, 0),
(55, 20, 0, 4, '2025-02-04', 'Update Invoice', 8, 0),
(56, 35, 0, 60, '2025-02-17', 'Submit Invoice', 9, 0),
(57, 34, 0, 180, '2025-02-17', 'Submit Invoice', 10, 0),
(58, 1, 1000, 0, '2025-03-14', 'By tony', 23, 0),
(65, 64, 0, 50, '2025-03-18', 'Update Invoice', 11, 0),
(66, 65, 0, 50, '2025-03-18', 'Update Invoice', 11, 0),
(67, 66, 0, 162, '2025-03-18', 'Update Invoice', 11, 0),
(68, 23, 0, 30, '2025-03-18', 'Update Invoice', 11, 0),
(69, 67, 0, 100, '2025-03-18', 'Update Invoice', 11, 0),
(70, 68, 0, 30, '2025-03-18', 'Update Invoice', 11, 0),
(71, 64, 0, 50, '2025-03-25', 'Submit Invoice', 12, 0),
(72, 65, 0, 50, '2025-03-25', 'Submit Invoice', 12, 0),
(73, 67, 0, 100, '2025-03-25', 'Submit Invoice', 12, 0),
(74, 68, 0, 28, '2025-03-25', 'Submit Invoice', 12, 0),
(75, 23, 0, 32, '2025-03-25', 'Submit Invoice', 12, 0),
(76, 42, 0, 15, '2025-03-25', 'Submit Invoice', 13, 0),
(77, 70, 0, 108, '2025-03-27', 'Submit Invoice', 14, 0),
(78, 71, 0, 108, '2025-03-27', 'Submit Invoice', 14, 0),
(79, 7, 0, 18, '2025-04-02', 'Submit Invoice', 15, 0),
(80, 23, 0, 60, '2025-04-02', 'Submit Invoice', 15, 0),
(81, 40, 0, 60, '2025-04-02', 'Submit Invoice', 15, 0),
(82, 36, 0, 30, '2025-04-02', 'Submit Invoice', 15, 0),
(83, 22, 0, 6, '2025-04-02', 'Submit Invoice', 15, 0),
(84, 20, 0, 6, '2025-04-02', 'Submit Invoice', 15, 0),
(85, 72, 0, 1, '2025-04-02', 'Submit Invoice', 16, 0),
(86, 25, 0, 7, '2025-04-02', 'Submit Invoice', 16, 0),
(87, 64, 0, 50, '2025-04-03', 'Submit Invoice', 17, 0),
(88, 66, 0, 45, '2025-04-03', 'Submit Invoice', 17, 0),
(89, 67, 0, 91, '2025-04-03', 'Submit Invoice', 17, 0),
(90, 36, 0, 624, '2025-04-04', 'Submit Invoice', 18, 0),
(91, 73, 0, 100, '2025-04-08', 'Submit Invoice', 19, 0),
(92, 37, 0, 30, '2025-04-08', 'Submit Invoice', 20, 0),
(93, 26, 0, 50, '2025-04-08', 'Submit Invoice', 20, 0),
(94, 28, 0, 2, '2025-04-09', 'Submit Invoice', 21, 0),
(95, 24, 0, 20, '2025-04-09', 'Submit Invoice', 21, 0),
(96, 23, 0, 20, '2025-04-09', 'Submit Invoice', 21, 0),
(109, 74, 0, 50, '2025-04-09', 'Update Invoice', 22, 0),
(110, 64, 0, 26, '2025-04-09', 'Update Invoice', 22, 0),
(111, 69, 0, 50, '2025-04-09', 'Update Invoice', 22, 0),
(112, 72, 0, 1, '2025-04-10', 'Submit Invoice', 23, 0),
(113, 42, 0, 5, '2025-04-10', 'Submit Invoice', 23, 0),
(117, 64, 0, 33, '2025-04-11', 'Update Invoice', 24, 0),
(118, 66, 0, 162, '2025-04-11', 'Update Invoice', 24, 0),
(119, 65, 0, 68, '2025-04-11', 'Update Invoice', 24, 0),
(125, 76, 0, 50, '2025-04-17', 'Submit Invoice', 26, 0),
(126, 77, 0, 100, '2025-04-17', 'Submit Invoice', 26, 0),
(127, 75, 0, 100, '2025-04-17', 'Submit Invoice', 26, 0),
(128, 64, 0, 50, '2025-04-17', 'Update Invoice', 25, 0),
(129, 74, 0, 20, '2025-04-17', 'Update Invoice', 25, 0),
(130, 69, 0, 50, '2025-04-17', 'Update Invoice', 25, 0),
(131, 67, 0, 120, '2025-04-17', 'Update Invoice', 25, 0),
(132, 68, 0, 50, '2025-04-17', 'Update Invoice', 25, 0),
(133, 24, 0, 60, '2025-04-22', 'Submit Invoice', 27, 0),
(134, 3, 0, 20, '2025-04-22', 'Submit Invoice', 27, 0),
(135, 40, 0, 60, '2025-04-22', 'Submit Invoice', 27, 0),
(137, 2, 0, 10, '2025-04-25', 'Submit Invoice', 28, 0),
(138, 3, 0, 10, '2025-04-25', 'Submit Invoice', 28, 0),
(139, 36, 0, 600, '2025-04-25', 'Submit Invoice', 29, 0),
(140, 40, 0, 27, '2025-04-25', 'Submit Invoice', 29, 0),
(141, 7, 0, 50, '2025-04-25', 'Submit Invoice', 29, 0),
(142, 33, 0, 60, '2025-05-02', 'Submit Invoice', 30, 0),
(143, 78, 0, 30, '2025-05-02', 'Submit Invoice', 30, 0),
(144, 64, 0, 28, '2025-05-03', 'Submit Invoice', 31, 0),
(145, 69, 0, 46, '2025-05-03', 'Submit Invoice', 31, 0),
(146, 67, 0, 73, '2025-05-03', 'Submit Invoice', 31, 0),
(147, 42, 0, 15, '2025-05-06', 'Submit Invoice', 32, 0),
(148, 26, 0, 70, '2025-05-12', 'Submit Invoice', 33, 0),
(149, 37, 0, 30, '2025-05-12', 'Submit Invoice', 33, 0),
(154, 24, 0, 7, '2025-05-15', 'Submit Invoice', 34, 0),
(155, 24, 0, 7, '2025-05-15', 'Submit Invoice', 35, 0),
(156, 72, 0, 7, '2025-05-15', 'Submit Invoice', 35, 0),
(157, 64, 0, 100, '2025-05-16', 'Submit Invoice', 36, 0),
(158, 65, 0, 66, '2025-05-16', 'Submit Invoice', 36, 0),
(159, 66, 0, 175, '2025-05-16', 'Submit Invoice', 36, 0),
(160, 67, 0, 100, '2025-05-16', 'Submit Invoice', 36, 0),
(161, 69, 0, 100, '2025-05-16', 'Submit Invoice', 36, 0),
(162, 68, 0, 20, '2025-05-16', 'Submit Invoice', 36, 0),
(163, 74, 0, 40, '2025-05-17', 'Submit Invoice', 37, 0),
(164, 73, 0, 100, '2025-05-19', 'Submit Invoice', 38, 0),
(165, 7, 0, 60, '2025-05-21', 'Submit Invoice', 39, 0),
(166, 72, 0, 7, '2025-05-21', 'Submit Invoice', 39, 0),
(167, 75, 0, 100, '2025-05-22', 'Submit Invoice', 40, 0),
(168, 24, 0, 10, '2025-05-22', 'Submit Invoice', 40, 0),
(169, 23, 0, 20, '2025-05-22', 'Submit Invoice', 40, 0),
(170, 2, 0, 10, '2025-05-22', 'Submit Invoice', 41, 0),
(171, 3, 0, 10, '2025-05-22', 'Submit Invoice', 41, 0),
(172, 79, 0, 10, '2025-05-22', 'Submit Invoice', 41, 0),
(173, 66, 0, 166, '2025-05-27', 'Submit Invoice', 42, 0),
(174, 67, 0, 200, '2025-05-27', 'Submit Invoice', 42, 0),
(175, 69, 0, 100, '2025-05-27', 'Submit Invoice', 42, 0),
(176, 74, 0, 40, '2025-05-27', 'Submit Invoice', 42, 0),
(177, 42, 0, 15, '2025-05-27', 'Submit Invoice', 42, 0),
(178, 77, 0, 100, '2025-05-28', 'Submit Invoice', 43, 0),
(179, 76, 0, 50, '2025-05-28', 'Submit Invoice', 43, 0),
(180, 75, 0, 12, '2025-05-28', 'Submit Invoice', 43, 0),
(181, 23, 0, 4, '2025-05-28', 'Submit Invoice', 44, 0),
(182, 11, 0, 1, '2025-05-28', 'Submit Invoice', 44, 0),
(183, 7, 0, 1, '2025-05-28', 'Submit Invoice', 44, 0),
(184, 36, 0, 360, '2025-05-29', 'Submit Invoice', 45, 0),
(186, 33, 0, 784, '2025-05-30', 'Update Invoice', 46, 0),
(190, 42, 0, 50, '2025-06-03', 'Update Invoice', 47, 0),
(191, 51, 0, 6, '2025-06-03', 'Update Invoice', 47, 0),
(192, 36, 0, 132, '2025-06-03', 'Update Invoice', 47, 0),
(193, 23, 0, 100, '2025-06-03', 'Submit Invoice', 48, 0),
(194, 44, 0, 50, '2025-06-04', 'Submit Invoice', 49, 0),
(195, 26, 0, 100, '2025-06-13', 'Submit Invoice', 50, 0),
(196, 75, 0, 51, '2025-06-13', 'Submit Invoice', 50, 0),
(197, 74, 0, 50, '2025-06-13', 'Submit Invoice', 51, 0),
(198, 64, 0, 32, '2025-06-13', 'Submit Invoice', 51, 0),
(199, 65, 0, 51, '2025-06-13', 'Submit Invoice', 51, 0),
(200, 69, 0, 50, '2025-06-13', 'Submit Invoice', 51, 0),
(201, 67, 0, 186, '2025-06-13', 'Submit Invoice', 51, 0),
(202, 73, 0, 50, '2025-06-23', 'Submit Invoice', 52, 0),
(203, 73, 0, 100, '2025-06-24', 'Submit Invoice', 53, 0),
(204, 65, 0, 50, '2025-06-25', 'Submit Invoice', 54, 0),
(205, 66, 0, 129, '2025-06-25', 'Submit Invoice', 54, 0),
(206, 67, 0, 100, '2025-06-25', 'Submit Invoice', 54, 0),
(207, 69, 0, 150, '2025-06-25', 'Submit Invoice', 54, 0),
(208, 68, 0, 27, '2025-06-25', 'Submit Invoice', 54, 0),
(209, 74, 0, 30, '2025-06-25', 'Submit Invoice', 54, 0),
(210, 74, 0, 16, '2025-06-25', 'Submit Invoice', 54, 0),
(211, 42, 0, 15, '2025-06-25', 'Submit Invoice', 54, 0),
(212, 7, 0, 42, '2025-06-30', 'Submit Invoice', 55, 0),
(213, 42, 0, 50, '2025-06-30', 'Submit Invoice', 55, 0),
(214, 36, 0, 330, '2025-06-30', 'Submit Invoice', 55, 0),
(215, 23, 0, 60, '2025-06-30', 'Submit Invoice', 55, 0),
(216, 74, 0, 20, '2025-07-01', 'Submit Invoice', 56, 0),
(217, 79, 0, 30, '2025-07-01', 'Submit Invoice', 56, 0),
(218, 30, 0, 10, '2025-07-02', 'Submit Invoice', 57, 0),
(219, 26, 0, 10, '2025-07-02', 'Submit Invoice', 57, 0),
(220, 36, 0, 30, '2025-07-02', 'Submit Invoice', 57, 0),
(221, 24, 0, 15, '2025-07-02', 'Submit Invoice', 57, 0),
(222, 42, 0, 5, '2025-07-02', 'Submit Invoice', 57, 0),
(223, 73, 0, 30, '2025-07-02', 'Submit Invoice', 57, 0),
(224, 22, 0, 10, '2025-07-02', 'Submit Invoice', 57, 0),
(225, 74, 0, 12, '2025-07-03', 'Submit Invoice', 58, 0),
(226, 42, 0, 5, '2025-07-03', 'Submit Invoice', 58, 0),
(237, 37, 0, 20, '2025-07-09', 'Update Invoice', 59, 0),
(238, 26, 0, 100, '2025-07-09', 'Update Invoice', 59, 0),
(239, 73, 50, 0, '2025-07-09', 'Submit Return', 0, 2),
(240, 65, 0, 67, '2025-07-09', 'Submit Invoice', 60, 0),
(241, 66, 0, 162, '2025-07-09', 'Submit Invoice', 60, 0),
(242, 74, 0, 100, '2025-07-09', 'Submit Invoice', 60, 0),
(243, 64, 0, 60, '2025-07-11', 'Submit Invoice', 61, 0),
(244, 69, 0, 60, '2025-07-11', 'Submit Invoice', 61, 0),
(245, 67, 0, 150, '2025-07-11', 'Submit Invoice', 61, 0),
(246, 68, 0, 30, '2025-07-11', 'Submit Invoice', 61, 0),
(251, 36, 0, 120, '2025-07-11', 'Update Invoice', 62, 0),
(252, 42, 0, 40, '2025-07-11', 'Update Invoice', 62, 0),
(253, 74, 20, 0, '2025-07-11', 'Submit Return', 0, 3),
(254, 79, 30, 0, '2025-07-11', 'Submit Return', 0, 3),
(255, 23, 50, 0, '2025-07-11', 'Submit Return', 0, 4),
(256, 74, 0, 40, '2025-07-18', 'Submit Invoice', 63, 0),
(257, 42, 0, 15, '2025-07-18', 'Submit Invoice', 63, 0),
(258, 64, 0, 40, '2025-07-18', 'Submit Invoice', 63, 0),
(259, 72, 0, 4, '2025-07-18', 'Submit Invoice', 64, 0),
(260, 65, 0, 64, '2025-07-24', 'Submit Invoice', 65, 0),
(261, 66, 0, 162, '2025-07-24', 'Submit Invoice', 65, 0),
(262, 68, 0, 25, '2025-07-24', 'Submit Invoice', 65, 0),
(263, 69, 0, 196, '2025-07-24', 'Submit Invoice', 65, 0),
(264, 67, 0, 150, '2025-07-24', 'Submit Invoice', 65, 0),
(265, 42, 0, 60, '2025-07-25', 'Submit Invoice', 66, 0),
(266, 23, 0, 5, '2025-07-26', 'Submit Invoice', 67, 0),
(267, 63, 0, 10, '2025-07-31', 'Submit Invoice', 68, 0),
(268, 36, 0, 504, '2025-08-01', 'Submit Invoice', 69, 0),
(269, 63, 0, 10, '2025-08-01', 'Submit Invoice', 69, 0),
(270, 74, 0, 50, '2025-08-01', 'Submit Invoice', 70, 0),
(271, 74, 0, 4, '2025-08-06', 'Submit Invoice', 71, 0),
(272, 44, 0, 2, '2025-08-06', 'Submit Invoice', 71, 0),
(273, 7, 0, 2, '2025-08-06', 'Submit Invoice', 71, 0),
(274, 67, 0, 151, '2025-08-07', 'Submit Invoice', 72, 0),
(275, 64, 0, 123, '2025-08-07', 'Submit Invoice', 72, 0),
(276, 77, 0, 18, '2025-08-08', 'Submit Invoice', 73, 0),
(277, 76, 0, 52, '2025-08-08', 'Submit Invoice', 73, 0),
(278, 80, 0, 30, '2025-08-08', 'Submit Invoice', 73, 0),
(279, 75, 0, 89, '2025-08-08', 'Submit Invoice', 73, 0),
(287, 74, 0, 15, '2025-08-08', 'Update Invoice', 74, 0),
(288, 63, 0, 10, '2025-08-08', 'Update Invoice', 74, 0),
(289, 18, 0, 10, '2025-08-08', 'Update Invoice', 74, 0),
(290, 22, 0, 10, '2025-08-08', 'Update Invoice', 74, 0),
(291, 20, 0, 3, '2025-08-08', 'Update Invoice', 74, 0),
(292, 2, 0, 5, '2025-08-08', 'Update Invoice', 74, 0),
(293, 3, 0, 10, '2025-08-08', 'Update Invoice', 74, 0),
(294, 7, 0, 50, '2025-08-08', 'Submit Invoice', 75, 0),
(295, 24, 0, 20, '2025-08-08', 'Submit Invoice', 76, 0),
(296, 44, 0, 30, '2025-08-08', 'Submit Invoice', 76, 0),
(297, 3, 0, 5, '2025-08-08', 'Submit Invoice', 76, 0),
(298, 2, 0, 5, '2025-08-08', 'Submit Invoice', 76, 0),
(299, 65, 0, 60, '2025-08-08', 'Submit Invoice', 77, 0),
(300, 68, 0, 50, '2025-08-13', 'Submit Invoice', 78, 0),
(301, 67, 0, 155, '2025-08-13', 'Submit Invoice', 78, 0),
(302, 74, 0, 40, '2025-08-13', 'Submit Invoice', 78, 0),
(305, 26, 0, 100, '2025-08-14', 'Update Invoice', 79, 0),
(306, 37, 0, 12, '2025-08-14', 'Update Invoice', 79, 0),
(307, 25, 0, 10, '2025-08-18', 'Submit Invoice', 80, 0),
(308, 74, 0, 60, '2025-08-19', 'Submit Invoice', 81, 0),
(309, 65, 0, 67, '2025-08-19', 'Submit Invoice', 81, 0),
(310, 66, 0, 318, '2025-08-19', 'Submit Invoice', 81, 0),
(311, 42, 0, 6, '2025-08-19', 'Submit Invoice', 82, 0),
(312, 36, 0, 1092, '2025-08-20', 'Submit Invoice', 83, 0),
(313, 42, 0, 100, '2025-08-20', 'Submit Invoice', 83, 0),
(314, 42, 0, 70, '2025-08-20', 'Submit Invoice', 84, 0),
(315, 42, 0, 10, '2025-08-20', 'Submit Invoice', 85, 0),
(316, 73, 0, 100, '2025-08-22', 'Submit Invoice', 86, 0),
(317, 25, 0, 26, '2025-08-22', 'Submit Invoice', 87, 0),
(318, 74, 0, 69, '2025-08-22', 'Submit Invoice', 88, 0),
(319, 72, 0, 5, '2025-08-25', 'Submit Invoice', 89, 0),
(320, 67, 0, 193, '2025-08-27', 'Submit Invoice', 90, 0),
(321, 69, 0, 151, '2025-08-27', 'Submit Invoice', 90, 0),
(322, 64, 0, 117, '2025-09-04', 'Submit Invoice', 91, 0),
(323, 65, 0, 67, '2025-09-04', 'Submit Invoice', 91, 0),
(324, 26, 0, 100, '2025-09-05', 'Submit Invoice', 92, 0),
(325, 24, 0, 20, '2025-09-05', 'Submit Invoice', 92, 0),
(326, 77, 0, 128, '2025-09-05', 'Submit Invoice', 92, 0),
(327, 76, 0, 49, '2025-09-05', 'Submit Invoice', 92, 0),
(330, 44, 0, 1, '2025-09-05', 'Submit Invoice', 94, 0),
(331, 24, 0, 1, '2025-09-05', 'Submit Invoice', 94, 0),
(332, 25, 0, 29, '2025-09-05', 'Update Invoice', 93, 0),
(333, 7, 0, 50, '2025-09-05', 'Update Invoice', 93, 0),
(334, 70, 0, 252, '2025-09-16', 'Submit Invoice', 95, 0),
(335, 71, 0, 252, '2025-09-16', 'Submit Invoice', 95, 0),
(336, 69, 0, 49, '2025-09-19', 'Submit Invoice', 96, 0),
(337, 67, 0, 100, '2025-09-19', 'Submit Invoice', 96, 0),
(338, 65, 0, 64, '2025-09-19', 'Submit Invoice', 96, 0),
(339, 66, 0, 150, '2025-09-19', 'Submit Invoice', 96, 0),
(340, 64, 0, 125, '2025-09-23', 'Submit Invoice', 97, 0),
(341, 66, 0, 18, '2025-09-23', 'Submit Invoice', 97, 0),
(342, 42, 0, 15, '2025-09-23', 'Submit Invoice', 97, 0),
(343, 24, 20, 0, '2025-09-29', 'Submit Return', 0, 5),
(344, 44, 30, 0, '2025-09-29', 'Submit Return', 0, 5),
(345, 3, 5, 0, '2025-09-29', 'Submit Return', 0, 5),
(346, 2, 5, 0, '2025-09-29', 'Submit Return', 0, 5),
(347, 23, 0, 5, '2025-10-02', 'Submit Invoice', 98, 0),
(348, 65, 0, 69, '2025-10-06', 'Submit Invoice', 99, 0),
(349, 66, 0, 166, '2025-10-06', 'Submit Invoice', 99, 0),
(350, 69, 0, 152, '2025-10-06', 'Submit Invoice', 99, 0),
(351, 67, 0, 200, '2025-10-06', 'Submit Invoice', 99, 0),
(354, 26, 0, 70, '2025-10-07', 'Update Invoice', 100, 0),
(355, 37, 0, 25, '2025-10-07', 'Update Invoice', 100, 0),
(356, 70, 0, 2016, '2025-10-07', 'Submit Invoice', 101, 0),
(357, 71, 0, 2016, '2025-10-07', 'Submit Invoice', 101, 0),
(358, 70, 0, 252, '2025-10-07', 'Submit Invoice', 102, 0),
(359, 71, 0, 252, '2025-10-07', 'Submit Invoice', 102, 0),
(360, 26, 0, 10, '2025-10-08', 'Submit Invoice', 103, 0),
(361, 67, 0, 295, '2025-10-21', 'Submit Invoice', 104, 0),
(362, 65, 0, 67, '2025-10-21', 'Submit Invoice', 104, 0),
(363, 66, 0, 168, '2025-10-21', 'Submit Invoice', 104, 0),
(364, 73, 0, 100, '2025-10-21', 'Submit Invoice', 105, 0),
(365, 74, 0, 30, '2025-10-24', 'Submit Invoice', 106, 0),
(366, 73, 115, 0, '2025-10-31', '', 0, 0),
(367, 73, 605, 0, '2025-10-31', '', 0, 0),
(368, 9, 25, 0, '2025-10-31', '', 0, 0),
(369, 81, 91, 0, '2025-10-31', '', 0, 0),
(370, 42, 0, 15, '2025-11-03', 'Submit Invoice', 107, 0),
(371, 26, 0, 60, '2025-11-11', 'Submit Invoice', 108, 0),
(372, 78, 0, 17, '2025-11-11', 'Submit Invoice', 108, 0),
(373, 69, 0, 100, '2025-11-13', 'Submit Invoice', 109, 0),
(374, 67, 0, 102, '2025-11-13', 'Submit Invoice', 109, 0),
(375, 64, 0, 146, '2025-11-13', 'Submit Invoice', 109, 0),
(376, 65, 0, 65, '2025-11-13', 'Submit Invoice', 109, 0),
(377, 66, 0, 189, '2025-11-13', 'Submit Invoice', 109, 0),
(378, 74, 0, 60, '2025-11-18', 'Submit Invoice', 110, 0),
(379, 23, 0, 10, '2025-11-26', 'Submit Invoice', 111, 0),
(380, 72, 0, 10, '2025-11-26', 'Submit Invoice', 111, 0),
(381, 42, 0, 8, '2025-11-26', 'Submit Invoice', 112, 0),
(382, 65, 0, 64, '2025-11-26', 'Submit Invoice', 113, 0),
(383, 66, 0, 164, '2025-11-26', 'Submit Invoice', 113, 0),
(384, 69, 0, 60, '2025-11-26', 'Submit Invoice', 113, 0),
(385, 67, 0, 208, '2025-11-26', 'Submit Invoice', 113, 0),
(386, 73, 0, 100, '2025-11-28', 'Submit Invoice', 114, 0),
(387, 74, 0, 200, '2025-12-08', 'Submit Invoice', 115, 0),
(388, 69, 0, 60, '2025-12-12', 'Submit Invoice', 116, 0),
(389, 67, 0, 100, '2025-12-12', 'Submit Invoice', 116, 0),
(390, 64, 0, 61, '2025-12-12', 'Submit Invoice', 116, 0),
(391, 65, 0, 65, '2025-12-12', 'Submit Invoice', 116, 0),
(392, 66, 0, 162, '2025-12-12', 'Submit Invoice', 116, 0),
(393, 69, 0, 100, '2025-12-24', 'Submit Invoice', 117, 0),
(394, 67, 0, 100, '2025-12-24', 'Submit Invoice', 117, 0),
(395, 64, 0, 118, '2025-12-24', 'Submit Invoice', 117, 0),
(396, 65, 0, 30, '2025-12-24', 'Submit Invoice', 117, 0),
(397, 66, 0, 108, '2025-12-24', 'Submit Invoice', 117, 0),
(398, 74, 0, 60, '2025-12-24', 'Submit Invoice', 117, 0),
(399, 42, 0, 5, '2025-12-29', 'Submit Invoice', 118, 0),
(400, 74, 0, 12, '2025-12-29', 'Submit Invoice', 118, 0),
(401, 42, 0, 15, '2025-12-30', 'Submit Invoice', 119, 0),
(402, 68, 0, 20, '2026-01-08', 'Submit Invoice', 120, 0),
(403, 67, 0, 100, '2026-01-08', 'Submit Invoice', 120, 0),
(404, 66, 0, 162, '2026-01-08', 'Submit Invoice', 120, 0),
(405, 65, 0, 68, '2026-01-08', 'Submit Invoice', 120, 0),
(406, 36, 0, 822, '2026-01-12', 'Submit Invoice', 121, 0),
(407, 42, 0, 169, '2026-01-12', 'Submit Invoice', 121, 0),
(410, 37, 0, 25, '2026-01-14', 'Update Invoice', 122, 0),
(411, 26, 0, 50, '2026-01-14', 'Update Invoice', 122, 0),
(412, 65, 0, 50, '2026-01-16', 'Submit Invoice', 123, 0),
(413, 69, 0, 100, '2026-01-16', 'Submit Invoice', 123, 0),
(414, 67, 0, 200, '2026-01-16', 'Submit Invoice', 123, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbm_supplier`
--

CREATE TABLE `tbm_supplier` (
  `id` int(11) NOT NULL,
  `gender_id` int(11) DEFAULT NULL,
  `fullname` varchar(1000) DEFAULT NULL,
  `job_id` int(11) DEFAULT NULL,
  `companyname` varchar(1000) DEFAULT NULL,
  `pobox` varchar(1000) DEFAULT NULL,
  `country_id` varchar(1000) DEFAULT NULL,
  `address` text,
  `district` varchar(1000) DEFAULT NULL,
  `city` varchar(1000) DEFAULT NULL,
  `phone` varchar(1000) DEFAULT NULL,
  `fax` varchar(1000) DEFAULT NULL,
  `email` varchar(1000) DEFAULT NULL,
  `bankdetails` varchar(1000) DEFAULT NULL,
  `financialno` varchar(1000) DEFAULT NULL,
  `datedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbm_supplier`
--

INSERT INTO `tbm_supplier` (`id`, `gender_id`, `fullname`, `job_id`, `companyname`, `pobox`, `country_id`, `address`, `district`, `city`, `phone`, `fax`, `email`, `bankdetails`, `financialno`, `datedate`) VALUES
(1, 1, 'Elie Ferekh', 0, '', '', '0', 'Sayfi', '', '', '03291069', '', 'aboukarim17@hotmail.com', '', '', '2017-01-19'),
(2, 4, NULL, 0, 'Kamaco S.A.L .', '', '0', 'Antelias', 'Met', '', '04402329', '', 'kamacosal@kamacosal.com', '', '2248', '2017-02-09'),
(3, 4, 'Maroun Helou', 0, '', '', '1', 'Road Saint Charbel', 'Matn', 'Sfeila', '96170172780', '', 'marounhelou@yahoo.com', '', '', '2017-02-09'),
(4, 4, 'TONY KALLAB', 0, 'RAMTEX SAL', '', '1', '178 18TH STREET N.', '', 'HOSRAYEL, JBEIL', '9619791555', '9619791556', 'ramtex@gmail.com', '', '', '2024-12-11'),
(5, 4, 'RICHARD ABI SAAB', 1, 'TISSUE MILL', '', '1', 'HALAT', '', 'JBEIL', '9619478479', '', 'RICHARD@gmail.com', '', '', '2024-12-11');

-- --------------------------------------------------------

--
-- Table structure for table `tbs_country`
--

CREATE TABLE `tbs_country` (
  `id` int(11) NOT NULL,
  `title` varchar(1000) DEFAULT NULL,
  `active` varchar(1000) DEFAULT NULL,
  `datedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbs_country`
--

INSERT INTO `tbs_country` (`id`, `title`, `active`, `datedate`) VALUES
(1, 'Lebanon', 'True', '2016-11-13');

-- --------------------------------------------------------

--
-- Table structure for table `tbs_currency`
--

CREATE TABLE `tbs_currency` (
  `id` int(11) NOT NULL,
  `title` varchar(1000) DEFAULT NULL,
  `active` varchar(1000) DEFAULT NULL,
  `datedate` date DEFAULT NULL,
  `sign` varchar(100) DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL,
  `divided` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbs_currency`
--

INSERT INTO `tbs_currency` (`id`, `title`, `active`, `datedate`, `sign`, `value`, `divided`) VALUES
(1, 'US Dollar', 'True', '2018-06-19', '$', '1', 'Cent'),
(2, 'United Arab Emirates Dirham', 'True', '2018-06-19', 'AED', '4.5365', 'Fils'),
(3, 'Lebanese Pound', 'True', '2024-12-02', 'LL', '89500', 'Piastre'),
(4, 'Euro', 'True', '2024-12-04', '€', '1.05', 'Cent');

-- --------------------------------------------------------

--
-- Table structure for table `tbs_currency_history`
--

CREATE TABLE `tbs_currency_history` (
  `id` int(11) NOT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL,
  `datedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbs_currency_history`
--

INSERT INTO `tbs_currency_history` (`id`, `currency_id`, `value`, `datedate`) VALUES
(1, 3, '89500', '2024-12-02'),
(2, 4, '1.05', '2024-12-04');

-- --------------------------------------------------------

--
-- Table structure for table `tbs_gender`
--

CREATE TABLE `tbs_gender` (
  `id` int(11) NOT NULL,
  `title` varchar(1000) DEFAULT NULL,
  `active` varchar(1000) DEFAULT NULL,
  `datedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbs_gender`
--

INSERT INTO `tbs_gender` (`id`, `title`, `active`, `datedate`) VALUES
(1, 'Mr.', 'True', '2016-11-13'),
(2, 'Miss.', 'True', '2016-11-13'),
(3, 'Mrs.', 'True', '2016-11-13'),
(4, 'M.', 'True', '2016-11-13');

-- --------------------------------------------------------

--
-- Table structure for table `tbs_job`
--

CREATE TABLE `tbs_job` (
  `id` int(11) NOT NULL,
  `title` varchar(1000) DEFAULT NULL,
  `active` varchar(1000) DEFAULT NULL,
  `datedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbs_job`
--

INSERT INTO `tbs_job` (`id`, `title`, `active`, `datedate`) VALUES
(1, 'Accountant/Auditor', 'True', '2016-11-13'),
(2, 'Bank/Financial Institution Manager', 'True', '2016-11-13'),
(3, 'Bank/Financial Institution Officer', 'True', '2016-11-13'),
(4, 'Company Manager', 'True', '2016-11-13'),
(5, 'Company Officer', 'True', '2016-11-13'),
(6, 'Engineer', 'True', '2016-11-13'),
(7, 'Entrepreneur', 'True', '2016-11-13'),
(8, 'Financial Analyst', 'True', '2016-11-13'),
(9, 'Financial Consultant', 'True', '2016-11-13'),
(10, 'Financial Manager', 'True', '2016-11-13'),
(11, 'Lawyer', 'True', '2016-11-13'),
(12, 'Management Consultant', 'True', '2016-11-13'),
(13, 'Medical Doctor', 'True', '2016-11-13'),
(14, 'Other', 'True', '2016-11-13'),
(15, 'Public Sector Manager', 'True', '2016-11-13'),
(16, 'Public Sector Officer', 'True', '2016-11-13'),
(17, 'Owner', 'True', '2016-11-13'),
(18, 'SALES', 'True', '2025-04-03'),
(19, 'DIRECT CLIENT', 'True', '2025-04-03');

-- --------------------------------------------------------

--
-- Table structure for table `tbs_note`
--

CREATE TABLE `tbs_note` (
  `id` int(11) NOT NULL,
  `title` varchar(1000) DEFAULT NULL,
  `active` varchar(1000) DEFAULT NULL,
  `datedate` date DEFAULT NULL,
  `body` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbs_status`
--

CREATE TABLE `tbs_status` (
  `id` int(11) NOT NULL,
  `title` varchar(1000) DEFAULT NULL,
  `active` varchar(1000) DEFAULT NULL,
  `datedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbs_status`
--

INSERT INTO `tbs_status` (`id`, `title`, `active`, `datedate`) VALUES
(1, 'New', 'True', '2016-11-13'),
(2, 'Pending', 'True', '2016-11-13'),
(3, 'In Progress', 'True', '2016-11-13'),
(4, 'Follow up', 'True', '2016-11-13');

-- --------------------------------------------------------

--
-- Table structure for table `tbs_type`
--

CREATE TABLE `tbs_type` (
  `id` int(11) NOT NULL,
  `title` varchar(1000) DEFAULT NULL,
  `active` varchar(1000) DEFAULT NULL,
  `datedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbs_type`
--

INSERT INTO `tbs_type` (`id`, `title`, `active`, `datedate`) VALUES
(1, 'Cash', 'True', '2016-11-24'),
(2, 'Check', 'True', '2016-11-24'),
(20, 'Money Transfer', 'True', '2016-11-25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `md5_id` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `full_name` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `user_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_email` varchar(220) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `user_level` tinyint(4) NOT NULL DEFAULT '1',
  `pwd` varchar(220) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `lastlogin1` datetime DEFAULT NULL,
  `lastlogin2` datetime DEFAULT NULL,
  `pin` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `datedate` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `md5_id`, `full_name`, `user_name`, `user_email`, `user_level`, `pwd`, `lastlogin1`, `lastlogin2`, `pin`, `datedate`) VALUES
(56, '9f61408e3afb633e50cdf1b20de6f466', 'admin', 'admin', 'sundray@sundray.com', 1, 'c244bd53c0aa9ddded6d5af3f9749cf1', '2026-01-15 09:29:30', '2026-01-16 12:15:17', '2024', '2017-02-22'),
(146, '', 'Maroun Helou', 'maroun', 'marounhelou@yahoo.com', 2, '07dec5b8ddc1b13a45dbba58b7fdbe99', '2017-05-03 15:29:11', '2017-05-08 11:10:06', NULL, '2017-03-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbm_category`
--
ALTER TABLE `tbm_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbm_client`
--
ALTER TABLE `tbm_client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbm_invoice`
--
ALTER TABLE `tbm_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbm_invoice_det`
--
ALTER TABLE `tbm_invoice_det`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbm_offers`
--
ALTER TABLE `tbm_offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbm_offers_det`
--
ALTER TABLE `tbm_offers_det`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbm_payment`
--
ALTER TABLE `tbm_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbm_products`
--
ALTER TABLE `tbm_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbm_products_client`
--
ALTER TABLE `tbm_products_client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbm_receipt`
--
ALTER TABLE `tbm_receipt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbm_return`
--
ALTER TABLE `tbm_return`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbm_return_det`
--
ALTER TABLE `tbm_return_det`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbm_sales`
--
ALTER TABLE `tbm_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbm_statement`
--
ALTER TABLE `tbm_statement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbm_stocks`
--
ALTER TABLE `tbm_stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbm_supplier`
--
ALTER TABLE `tbm_supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbs_country`
--
ALTER TABLE `tbs_country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbs_currency`
--
ALTER TABLE `tbs_currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbs_currency_history`
--
ALTER TABLE `tbs_currency_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbs_gender`
--
ALTER TABLE `tbs_gender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbs_job`
--
ALTER TABLE `tbs_job`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbs_note`
--
ALTER TABLE `tbs_note`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbs_status`
--
ALTER TABLE `tbs_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbs_type`
--
ALTER TABLE `tbs_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_email` (`user_email`);
ALTER TABLE `users` ADD FULLTEXT KEY `idx_search` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbm_category`
--
ALTER TABLE `tbm_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tbm_invoice`
--
ALTER TABLE `tbm_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `tbm_invoice_det`
--
ALTER TABLE `tbm_invoice_det`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=394;

--
-- AUTO_INCREMENT for table `tbm_offers`
--
ALTER TABLE `tbm_offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbm_offers_det`
--
ALTER TABLE `tbm_offers_det`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbm_payment`
--
ALTER TABLE `tbm_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbm_products`
--
ALTER TABLE `tbm_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `tbm_products_client`
--
ALTER TABLE `tbm_products_client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1418;

--
-- AUTO_INCREMENT for table `tbm_receipt`
--
ALTER TABLE `tbm_receipt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `tbm_return`
--
ALTER TABLE `tbm_return`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbm_return_det`
--
ALTER TABLE `tbm_return_det`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbm_sales`
--
ALTER TABLE `tbm_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbm_statement`
--
ALTER TABLE `tbm_statement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=269;

--
-- AUTO_INCREMENT for table `tbm_stocks`
--
ALTER TABLE `tbm_stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=415;

--
-- AUTO_INCREMENT for table `tbm_supplier`
--
ALTER TABLE `tbm_supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbs_country`
--
ALTER TABLE `tbs_country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbs_currency`
--
ALTER TABLE `tbs_currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbs_currency_history`
--
ALTER TABLE `tbs_currency_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbs_gender`
--
ALTER TABLE `tbs_gender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbs_job`
--
ALTER TABLE `tbs_job`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbs_note`
--
ALTER TABLE `tbs_note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbs_status`
--
ALTER TABLE `tbs_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbs_type`
--
ALTER TABLE `tbs_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
