-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2020 at 05:35 PM
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
-- Database: `audit3`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit`
--

CREATE TABLE `audit` (
  `id` int(10) UNSIGNED NOT NULL,
  `diaudit` int(11) NOT NULL,
  `lingkup_audit` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_usaha` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tujuan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditor` int(11) NOT NULL,
  `jadwal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `jenis_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit`
--

INSERT INTO `audit` (`id`, `diaudit`, `lingkup_audit`, `jenis_usaha`, `tujuan`, `auditor`, `jadwal`, `jenis_id`, `created_at`, `updated_at`) VALUES
(3, 9, 'mnm', 'forex', 'coba audit', 7, '2020-06-13 05:19:00', 1, '2020-06-12 22:19:05', '2020-06-13 07:01:41'),
(4, 9, 'gagaga', 'Kontraktor', 'Iseng', 7, '2020-06-13 06:22:00', 1, '2020-06-12 23:22:05', '2020-06-13 07:01:51'),
(5, 9, 'mnm', 'Transportasi', 'audit lagi', 7, '2020-06-20 13:05:00', 2, '2020-06-13 06:05:38', '2020-06-13 06:05:38');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_audit`
--

CREATE TABLE `jenis_audit` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis_audit` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_audit`
--

INSERT INTO `jenis_audit` (`id`, `jenis_audit`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'WIP', 'Audit WIP', '2020-06-07 06:48:32', NULL),
(2, 'PTW', 'Audit PTW', '2020-06-07 06:48:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_soal`
--

CREATE TABLE `kategori_soal` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis_id` int(10) NOT NULL,
  `kategori_soal` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_diperiksa` int(11) DEFAULT NULL,
  `total_tdksesuai` int(11) DEFAULT NULL,
  `persentase` int(11) DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_soal`
--

INSERT INTO `kategori_soal` (`id`, `jenis_id`, `kategori_soal`, `total_diperiksa`, `total_tdksesuai`, `persentase`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kebersihan Tempat Kerja', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, 'Alat Pelindung Diri', NULL, NULL, NULL, NULL, NULL, NULL);

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_06_02_030716_create_jenis_audit_table', 1),
(4, '2020_06_02_031813_create_audit_table', 1),
(5, '2020_06_02_032633_create_kategori_soal_table', 1),
(6, '2020_06_02_033540_create_soal_table', 1);

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
  `id` int(10) UNSIGNED NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `topik` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_diperiksa` int(11) DEFAULT NULL,
  `total_tdksesuai` int(11) DEFAULT NULL,
  `persentase` int(11) DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id`, `kategori_id`, `topik`, `total_diperiksa`, `total_tdksesuai`, `persentase`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Lokasi kerja nampak rapih/ workplace is tidy and clean', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, 'Bahan/ peralatan tersimpan dengan baik/materials/equiment are well stored', NULL, NULL, NULL, NULL, NULL, NULL);

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
(7, 'admin', '081236475859', 'probolinggo', 'admin@gmail.com', 'PJB', 1, NULL, '$2y$10$kkbXPVYus3f0J49F2bfoCuKoBTCeXLVsSe3uyJMLSy49V9JA7DP6K', NULL, '6Y4GFwsNRknNReWpywDHB0lJuSx24MSK9bi3jePvVySsTYDyDXlnQa0JrKIT', '2020-06-06 23:23:24', '2020-06-06 23:23:24'),
(8, 'auditor', '081236475859', 'probolinggo', 'auditor@gmail.com', 'POMI', 2, NULL, '$2y$10$08FBGW4iTJCYyDySc2Qhi.D00ExDsNXjJN9Aqzfy1XAQj.Vuq6vNm', NULL, '$2y$10$16fVcOHA4IXRWJDg3limLev/SImxPkF/CFERgEPzl3sPbFF0JhCMe', '2020-06-06 23:23:24', '2020-06-06 23:23:24'),
(9, 'kontraktor', '081236475859', 'probolinggo', 'kontraktor@gmail.com', 'WIKA Gedung', 3, NULL, '$2y$10$IMbT5dNGqakvpmLfnZuXaOA16NQifOUYR/b.oSjLvfrH.QjWkejWq', NULL, '$2y$10$ElGPRncD3LXtazMRe2AbeuYHhiSeaFwpVXB/Nm/MX8wKqQ1x6chg2', '2020-06-06 23:23:24', '2020-06-06 23:23:24'),
(10, 'manajer', '081236475859', 'probolinggo', 'manajer@gmail.com', 'POMI', 4, NULL, '$2y$10$ptNU7RpyPt9G6sOHPjTg6.qDgDvWHDzr3tife58ZvjUnsuJ3XMFue', NULL, '$2y$10$nMQmMM.DHQSIFK6zcMe2fOvRvbufBroJYguH4pIKPjgtbzWHz1Mui', '2020-06-06 23:23:24', '2020-06-06 23:23:24'),
(11, 'supervisor', '081236475859', 'probolinggo', 'supervisor@gmail.com', 'POMI', 5, NULL, '$2y$10$uhg6kdH8leSDDz0mwmP.3ud/XGMuOZZOEVkbtxl.MM6EH.pzeSFBa', NULL, '$2y$10$hpKvLKMLsOBSc.DhXGHin.pFV1659StO72e50B5A3C3kHW4lVyFwO', '2020-06-06 23:23:24', '2020-06-06 23:23:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit`
--
ALTER TABLE `audit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_audit`
--
ALTER TABLE `jenis_audit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_soal`
--
ALTER TABLE `kategori_soal`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jenis_audit`
--
ALTER TABLE `jenis_audit`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategori_soal`
--
ALTER TABLE `kategori_soal`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
