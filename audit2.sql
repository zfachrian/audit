-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2020 at 03:08 PM
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
-- Database: `audit2`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit`
--

CREATE TABLE `audit` (
  `ID` int(10) NOT NULL,
  `JENIS_ID` int(10) NOT NULL,
  `ID_JADWAL` varchar(11) NOT NULL,
  `AUDITOR` varchar(11) DEFAULT NULL,
  `KONTRAKTOR` varchar(11) DEFAULT NULL,
  `MANAJER` varchar(11) DEFAULT NULL,
  `SUPERVISOR` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `ID` int(10) NOT NULL,
  `JADWAL` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_audit`
--

CREATE TABLE `jenis_audit` (
  `ID_JENIS` int(10) NOT NULL,
  `AUDIT` varchar(100) DEFAULT NULL,
  `KETERANGAN` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_soal`
--

CREATE TABLE `kategori_soal` (
  `ID_KATEGORI` int(10) NOT NULL,
  `ID_JENIS` int(10) DEFAULT NULL,
  `KATEGORI` varchar(100) DEFAULT NULL,
  `KETERANGAN_KATEGORI` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `ID` int(10) NOT NULL,
  `ID_KATEGORI` int(10) NOT NULL,
  `SOAL` varchar(255) NOT NULL,
  `DIPERIKSA` int(11) DEFAULT NULL,
  `TDK_SESUAI` int(11) DEFAULT NULL,
  `KEPATUHAN` int(11) DEFAULT NULL,
  `NOTE` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_id` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `state`, `email`, `company_name`, `role`, `email_verified_at`, `password`, `status_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '081236475859', 'probolinggo', 'admin@gmail.com', 'PJB', 1, NULL, '$2y$10$G/YsmPhN1gCgkr.HYkNj5uvyKXc1lbNizmTSHN0dA.CsgR5A9bmIa', NULL, '$2y$10$kLwNjnATlPHcdSJ1eJuLtOHY/PrDLTsqQH0VHAv99fuLEVZ3ZUSFK', '2020-05-31 21:48:07', '2020-05-31 21:48:07'),
(2, 'auditor', '081236475859', 'probolinggo', 'auditor@gmail.com', 'POMI', 2, NULL, '$2y$10$mCF6KGtD0g6p38lUZhgRd.SgLO0LI2ZKkyFSpxts9sGWNPte2W4L2', NULL, '$2y$10$pWkU0vwBEwvH2SGkPL0yb.Oj7pQuzjExs4YPIRxD4TaVnfEHgYF2a', '2020-05-31 21:48:07', '2020-05-31 21:48:07'),
(3, 'kontraktor', '081236475859', 'probolinggo', 'kontraktor@gmail.com', 'WIKA Gedung', 3, NULL, '$2y$10$cDQ.bEZgNAFaLolQK.pJ.eXRYIIgWpHBWT8fkEAv6rVXnFW0OXgfW', NULL, '$2y$10$xWO0A/XvvWVM/g77NwwT3uemAY3I/L7sJ3OFeCqVxxdtQrmLV7XOO', '2020-05-31 21:48:08', '2020-05-31 21:48:08'),
(4, 'manajer', '081236475859', 'probolinggo', 'manajer@gmail.com', 'POMI', 4, NULL, '$2y$10$jLIs2mwZQlLhB7gFGoLQzOI/UcF2ziFKML5NDOrwh3wlJ88ZfiNRe', NULL, '$2y$10$8uaK.jhxmcpP2yMqyf8LT.Ljk3QZ2NcNeZScEiKg5NVHetEkM6GlC', '2020-05-31 21:48:08', '2020-05-31 21:48:08'),
(5, 'supervisor', '081236475859', 'probolinggo', 'supervisor@gmail.com', 'POMI', 5, NULL, '$2y$10$L3qjIrtbLLiBN1ntfYLrq.lAFtFsRRBXQNuZ14nXmUxnpDPZsgKj.', NULL, '$2y$10$vrpAOdnQKKjUq68OArTwEuODKHp1xCprPR2v.4H9n5xHgONAiTcWm', '2020-05-31 21:48:08', '2020-05-31 21:48:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit`
--
ALTER TABLE `audit`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `JENIS_ID` (`JENIS_ID`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `jenis_audit`
--
ALTER TABLE `jenis_audit`
  ADD PRIMARY KEY (`ID_JENIS`);

--
-- Indexes for table `kategori_soal`
--
ALTER TABLE `kategori_soal`
  ADD PRIMARY KEY (`ID_KATEGORI`),
  ADD KEY `FK_RELATIONSHIP_3` (`ID_JENIS`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `KATEGORI_ID` (`ID_KATEGORI`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit`
--
ALTER TABLE `audit`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori_soal`
--
ALTER TABLE `kategori_soal`
  MODIFY `ID_KATEGORI` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audit`
--
ALTER TABLE `audit`
  ADD CONSTRAINT `JENIS_ID` FOREIGN KEY (`JENIS_ID`) REFERENCES `jenis_audit` (`ID_JENIS`);

--
-- Constraints for table `kategori_soal`
--
ALTER TABLE `kategori_soal`
  ADD CONSTRAINT `FK_RELATIONSHIP_3` FOREIGN KEY (`ID_JENIS`) REFERENCES `jenis_audit` (`ID_JENIS`);

--
-- Constraints for table `soal`
--
ALTER TABLE `soal`
  ADD CONSTRAINT `KATEGORI_ID` FOREIGN KEY (`ID_KATEGORI`) REFERENCES `kategori_soal` (`ID_KATEGORI`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
