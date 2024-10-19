-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2024 at 01:34 PM
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
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2024_10_16_114850_create_category_coa', 1),
(3, '2024_10_16_114949_create_chart_of_account', 1),
(4, '2024_10_16_120239_create_transaksi', 1);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_chart_of_account`
--

INSERT INTO `tb_chart_of_account` (`id`, `kode`, `nama`, `kategori_id`, `created_at`, `updated_at`) VALUES
(14, '401', 'Gaji Karyawan', 1, '2024-10-18 05:46:05', '2024-10-18 05:46:05'),
(15, '402', 'Gaji Ketua MPR', 1, '2024-10-18 05:46:19', '2024-10-18 05:46:19'),
(16, '403', 'Profit Trading', 2, '2024-10-18 05:46:39', '2024-10-18 05:46:39'),
(17, '601', 'Biaya Sekolah', 3, '2024-10-18 05:46:54', '2024-10-18 05:46:54'),
(18, '602', 'Bensin', 4, '2024-10-18 05:47:05', '2024-10-18 05:47:05'),
(19, '603', 'Parkir', 4, '2024-10-18 05:47:23', '2024-10-18 05:47:23'),
(20, '604', 'Makan Siang', 11, '2024-10-18 05:47:37', '2024-10-18 05:47:37'),
(21, '605', 'Makanan Pokok Bulanan', 11, '2024-10-18 05:47:57', '2024-10-18 05:47:57');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_coa`
--

CREATE TABLE `tb_kategori_coa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_kategori_coa`
--

INSERT INTO `tb_kategori_coa` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Salary', NULL, '2024-10-17 05:18:19'),
(2, 'Other Income', NULL, NULL),
(3, 'Family Expense', NULL, '2024-10-17 16:35:36'),
(4, 'Transport Expense', NULL, NULL),
(11, 'Meal Expenses', '2024-10-17 03:05:30', '2024-10-17 05:18:30'),
(13, 'Other Expense', '2024-10-17 16:35:43', '2024-10-18 05:44:58');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id`, `tanggal`, `coa_id`, `deskripsi`, `debit`, `credit`, `created_at`, `updated_at`) VALUES
(11, '2022-01-01', 14, 'Gaji di Perusahaan A', 0.00, 5000000.00, '2024-10-18 05:48:36', '2024-10-18 05:48:36'),
(12, '2022-01-02', 15, 'Gaji Ketum', 0.00, 7000000.00, '2024-10-18 05:49:12', '2024-10-18 05:49:12'),
(13, '2022-01-10', 18, 'Bensin Anak', 25000.00, 0.00, '2024-10-18 05:49:49', '2024-10-18 05:49:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_chart_of_account`
--
ALTER TABLE `tb_chart_of_account`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tb_kategori_coa`
--
ALTER TABLE `tb_kategori_coa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
