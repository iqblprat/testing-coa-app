-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2024 at 05:00 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_testing_iqbal`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2024_10_16_114850_create_category_coa', 1),
(5, '2024_10_16_114949_create_chart_of_account', 1),
(6, '2024_10_16_120239_create_transaksi', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_chart_of_account`
--

CREATE TABLE `tb_chart_of_account` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_chart_of_account`
--

INSERT INTO `tb_chart_of_account` (`id`, `kode`, `nama`, `kategori_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '401', 'Gaji Karyawan', 1, 1, '2024-10-19 14:51:06', '2024-10-19 14:51:06', NULL),
(2, '402', 'Gaji Ketua MPR', 1, 1, '2024-10-19 14:51:06', '2024-10-19 14:51:06', NULL),
(3, '403', 'Profit Trading', 2, 1, '2024-10-19 14:51:06', '2024-10-19 14:51:06', NULL),
(4, '601', 'Biaya Sekolah', 3, 1, '2024-10-19 14:51:06', '2024-10-19 14:51:06', NULL),
(5, '602', 'Bensin', 4, 1, '2024-10-19 14:51:06', '2024-10-19 14:51:06', NULL),
(6, '603', 'Parkir', 4, 1, '2024-10-19 14:51:06', '2024-10-19 14:51:06', NULL),
(7, '604', 'Makan Siang', 5, 1, '2024-10-19 14:51:06', '2024-10-19 14:51:06', NULL),
(8, '605', 'Makanan Pokok Bulanan', 5, 1, '2024-10-19 14:51:06', '2024-10-19 14:51:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_coa`
--

CREATE TABLE `tb_kategori_coa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_kategori_coa`
--

INSERT INTO `tb_kategori_coa` (`id`, `nama`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Salary', 1, '2024-10-19 14:51:06', '2024-10-19 14:51:06', NULL),
(2, 'Other Income', 1, '2024-10-19 14:51:06', '2024-10-19 14:51:06', NULL),
(3, 'Family Expense', 1, '2024-10-19 14:51:06', '2024-10-19 14:51:06', NULL),
(4, 'Transport Expense', 1, '2024-10-19 14:51:06', '2024-10-19 14:51:06', NULL),
(5, 'Meal Expense', 1, '2024-10-19 14:51:06', '2024-10-19 14:51:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `coa_id` bigint(20) UNSIGNED NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `debit` decimal(15,2) DEFAULT NULL,
  `credit` decimal(15,2) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id`, `tanggal`, `coa_id`, `deskripsi`, `debit`, `credit`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2024-10-25', 1, 'Gaji', 0.00, 5000000.00, 1, '2024-10-19 14:51:14', '2024-10-19 14:51:19', '2024-10-19 14:51:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', 'admin@example.com', '$2y$10$0kHoiNcalIu51wgLHjrMjeLxRk8tF3WknVPP0AGTers8z0F5IOPwC', '2024-10-19 14:51:06', '2024-10-19 14:51:06');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tb_chart_of_account`
--
ALTER TABLE `tb_chart_of_account`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_chart_of_account_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `tb_kategori_coa`
--
ALTER TABLE `tb_kategori_coa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_transaksi_coa_id_foreign` (`coa_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_chart_of_account`
--
ALTER TABLE `tb_chart_of_account`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_kategori_coa`
--
ALTER TABLE `tb_kategori_coa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_chart_of_account`
--
ALTER TABLE `tb_chart_of_account`
  ADD CONSTRAINT `tb_chart_of_account_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `tb_kategori_coa` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD CONSTRAINT `tb_transaksi_coa_id_foreign` FOREIGN KEY (`coa_id`) REFERENCES `tb_chart_of_account` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
