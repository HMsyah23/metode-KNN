-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2021 at 07:22 PM
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
  `terjual` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_testings`
--

INSERT INTO `data_testings` (`id`, `tanggal`, `hari`, `cuaca`, `terjual`) VALUES
(57, '2021-06-22', '2', '2', 16),
(60, '2021-06-10', '4', '2', 19),
(61, '2021-06-14', '1', '2', 27),
(66, '2021-06-15', '2', '2', 7),
(76, '2021-06-22', '2', '2', 15);

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
(1, '2021-03-01', 'senin', 'cerah', 7),
(2, '2021-03-02', 'selasa', 'cerah', 8),
(3, '2021-03-03', 'rabu', 'hujan', 14),
(4, '2021-03-04', 'kamis', 'cerah', 4),
(5, '2021-03-05', 'jumat', 'cerah', 5),
(6, '2021-03-06', 'sabtu', 'hujan', 17),
(7, '2021-03-07', 'minggu', 'hujan', 15),
(8, '2021-03-08', 'senin', 'hujan', 19),
(9, '2021-03-09', 'selasa', 'hujan', 12),
(10, '2021-03-10', 'rabu', 'hujan', 10),
(11, '2021-03-11', 'kamis', 'hujan', 19),
(12, '2021-03-12', 'jumat', 'hujan', 20),
(13, '2021-03-13', 'sabtu', 'hujan', 17),
(14, '2021-03-14', 'minggu', 'hujan', 16),
(15, '2021-03-15', 'senin', 'cerah', 10),
(16, '2021-03-16', 'selasa', 'cerah', 10),
(17, '2021-03-17', 'rabu', 'cerah', 5),
(18, '2021-03-18', 'kamis', 'cerah', 7),
(19, '2021-03-19', 'jumat', 'cerah', 6),
(20, '2021-03-20', 'sabtu', 'cerah', 9),
(21, '2021-03-21', 'minggu', 'cerah', 16),
(22, '2021-03-22', 'senin', 'hujan', 13),
(23, '2021-03-23', 'selasa', 'hujan', 16),
(24, '2021-03-24', 'rabu', 'hujan', 11),
(25, '2021-03-25', 'kamis', 'cerah', 9),
(26, '2021-03-26', 'jumat', 'cerah', 9),
(27, '2021-03-27', 'sabtu', 'cerah', 5),
(28, '2021-03-28', 'minggu', 'hujan', 30),
(29, '2021-03-29', 'senin', 'hujan', 27),
(30, '2021-03-30', 'selasa', 'cerah', 11),
(31, '2021-03-31', 'rabu', 'cerah', 10),
(32, '2021-04-01', 'kamis', 'hujan', 30),
(33, '2021-04-02', 'jumat', 'cerah', 12),
(34, '2021-04-03', 'sabtu', 'cerah', 14),
(35, '2021-04-04', 'minggu', 'cerah', 3),
(36, '2021-04-05', 'senin', 'hujan', 13),
(37, '2021-04-06', 'selasa', 'hujan', 11),
(38, '2021-04-07', 'rabu', 'hujan', 10),
(39, '2021-04-08', 'kamis', 'cerah', 2),
(40, '2021-04-09', 'jumat', 'hujan', 30),
(41, '2021-04-10', 'sabtu', 'cerah', 2),
(42, '2021-04-11', 'minggu', 'cerah', 1),
(43, '2021-04-12', 'senin', 'cerah', 6),
(44, '2021-04-13', 'selasa', 'cerah', 7),
(45, '2021-04-14', 'rabu', 'hujan', 10),
(46, '2021-04-15', 'kamis', 'cerah', 14),
(47, '2021-04-16', 'jumat', 'cerah', 9),
(48, '2021-04-17', 'sabtu', 'hujan', 30),
(49, '2021-04-18', 'minggu', 'cerah', 10),
(50, '2021-04-19', 'senin', 'cerah', 2),
(51, '2021-04-20', 'selasa', 'cerah', 5),
(52, '2021-04-21', 'rabu', 'cerah', 8),
(53, '2021-04-22', 'kamis', 'cerah', 2),
(54, '2021-04-23', 'jumat', 'cerah', 3),
(55, '2021-04-24', 'sabtu', 'cerah', 12),
(56, '2021-04-25', 'minggu', 'cerah', 29),
(57, '2021-04-26', 'senin', 'hujan', 27),
(58, '2021-04-27', 'selasa', 'hujan', 15),
(59, '2021-04-28', 'rabu', 'cerah', 4),
(60, '2021-04-29', 'kamis', 'cerah', 2),
(61, '2021-04-30', 'jumat', 'cerah', 17);

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
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', '$2y$10$fz3uiV9IY3M/HA8XZaPG6.dM4saBhQ023l2NuAN8LkB0/CUi6tIe2', '2021-06-01 08:51:10', '2021-06-01 08:51:10');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `data_trainings`
--
ALTER TABLE `data_trainings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

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
