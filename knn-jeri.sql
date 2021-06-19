-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2021 at 05:08 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `knn-jeri`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_testings`
--

CREATE TABLE `data_testings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `hari` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cuaca` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `terjual` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_trainings`
--

CREATE TABLE `data_trainings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `hari` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cuaca` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `terjual` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_trainings`
--

INSERT INTO `data_trainings` (`id`, `tanggal`, `hari`, `cuaca`, `terjual`) VALUES
(1, '2021-03-01', 'selasa', 'hujan', 12),
(2, '2021-03-01', 'selasa', 'hujan', 11),
(3, '2021-03-15', 'selasa', 'cerah', 10),
(4, '2021-03-15', 'selasa', 'cerah', 7),
(5, '2021-03-15', 'selasa', 'cerah', 5),
(6, '2021-03-30', 'selasa', 'hujan', 16),
(7, '2021-03-30', 'selasa', 'hujan', 15),
(8, '2021-03-15', 'rabu', 'hujan', 10),
(9, '2021-03-01', 'senin', 'hujan', 19),
(10, '2021-03-01', 'senin', 'hujan', 13),
(11, '2021-03-15', 'senin', 'cerah', 10),
(12, '2021-03-15', 'senin', 'cerah', 6),
(13, '2021-03-15', 'senin', 'cerah', 2),
(14, '2021-03-01', 'selasa', 'cerah', 8),
(15, '2021-03-30', 'senin', 'hujan', 13),
(16, '2021-03-30', 'senin', 'hujan', 27),
(17, '2021-03-30', 'senin', 'hujan', 27),
(18, '2021-03-01', 'rabu', 'hujan', 14),
(19, '2021-03-01', 'rabu', 'hujan', 10),
(20, '2021-03-01', 'rabu', 'hujan', 10),
(21, '2021-03-30', 'selasa', 'cerah', 11),
(22, '2021-03-15', 'rabu', 'cerah', 5),
(23, '2021-03-30', 'rabu', 'hujan', 11),
(24, '2021-03-01', 'senin', 'cerah', 7),
(25, '2021-03-30', 'rabu', 'cerah', 10),
(26, '2021-03-30', 'rabu', 'cerah', 8),
(27, '2021-03-30', 'rabu', 'cerah', 4),
(28, '2021-03-15', 'kamis', 'hujan', 19),
(29, '2021-03-01', 'kamis', 'hujan', 30),
(30, '2021-03-15', 'kamis', 'cerah', 7),
(31, '2021-03-15', 'kamis', 'cerah', 14),
(32, '2021-03-01', 'kamis', 'cerah', 4),
(33, '2021-03-01', 'kamis', 'cerah', 2),
(34, '2021-03-30', 'kamis', 'cerah', 9),
(35, '2021-03-30', 'kamis', 'cerah', 2),
(36, '2021-03-30', 'kamis', 'cerah', 2),
(37, '2021-03-15', 'jumat', 'hujan', 20),
(38, '2021-03-01', 'jumat', 'hujan', 30),
(39, '2021-03-15', 'jumat', 'cerah', 6),
(40, '2021-03-15', 'jumat', 'cerah', 9),
(41, '2021-03-01', 'jumat', 'cerah', 5),
(42, '2021-03-01', 'jumat', 'cerah', 12),
(43, '2021-03-30', 'jumat', 'cerah', 9),
(44, '2021-03-30', 'jumat', 'cerah', 3),
(45, '2021-03-30', 'jumat', 'cerah', 17),
(46, '2021-03-15', 'sabtu', 'hujan', 17),
(47, '2021-03-15', 'sabtu', 'hujan', 30),
(48, '2021-03-01', 'sabtu', 'hujan', 17),
(49, '2021-03-15', 'sabtu', 'cerah', 9),
(50, '2021-03-01', 'sabtu', 'cerah', 14),
(51, '2021-03-01', 'sabtu', 'cerah', 2),
(52, '2021-03-30', 'sabtu', 'cerah', 5),
(53, '2021-03-30', 'sabtu', 'cerah', 12),
(54, '2021-03-15', 'minggu', 'hujan', 16),
(55, '2021-03-01', 'minggu', 'hujan', 15),
(56, '2021-03-15', 'minggu', 'cerah', 1),
(57, '2021-03-15', 'minggu', 'cerah', 10),
(58, '2021-03-30', 'minggu', 'hujan', 30),
(59, '2021-03-01', 'minggu', 'cerah', 3),
(60, '2021-03-30', 'minggu', 'cerah', 16),
(61, '2021-03-30', 'minggu', 'cerah', 29);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_06_01_171043_create_data_trainings_table', 2);

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', NULL, '$2y$10$fz3uiV9IY3M/HA8XZaPG6.dM4saBhQ023l2NuAN8LkB0/CUi6tIe2', NULL, '2021-06-01 08:51:10', '2021-06-01 08:51:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_testings`
--
ALTER TABLE `data_testings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_trainings`
--
ALTER TABLE `data_trainings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_testings`
--
ALTER TABLE `data_testings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `data_trainings`
--
ALTER TABLE `data_trainings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
