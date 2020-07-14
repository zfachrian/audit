-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2020 at 05:32 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `audit`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit`
--

CREATE TABLE `audit` (
  `id` int(10) UNSIGNED NOT NULL,
  `diaudit` int(11) NOT NULL,
  `no_permit` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lingkup_audit` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_usaha` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tujuan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditor` int(11) NOT NULL,
  `jadwal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `jenis_id` int(11) NOT NULL,
  `manajer` int(11) DEFAULT NULL,
  `supervisor` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit`
--

INSERT INTO `audit` (`id`, `diaudit`, `no_permit`, `lingkup_audit`, `jenis_usaha`, `tujuan`, `auditor`, `jadwal`, `jenis_id`, `manajer`, `supervisor`, `created_at`, `updated_at`) VALUES
(1, 3, NULL, 'sadsa', 'forex', 'coba audit', 2, '2020-07-05 06:26:23', 1, 0, 1, '2020-06-19 05:03:19', '2020-07-14 07:31:27'),
(2, 3, '', 'gagaga', 'ssasas', 'sasasas', 1, '2020-07-30 12:11:00', 1, NULL, NULL, '2020-07-05 05:11:20', '2020-07-05 05:11:20'),
(3, 3, '', 'sdfghjk', 'sdfghjk', 'asdfdghjk', 1, '2020-07-18 10:46:00', 2, NULL, NULL, '2020-07-11 03:46:14', '2020-07-11 03:46:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit`
--
ALTER TABLE `audit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit`
--
ALTER TABLE `audit`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
