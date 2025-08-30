-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2025 at 05:31 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apksawsmanli`
--

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL,
  `kode_kriteria` varchar(100) NOT NULL,
  `nama_kriteria` varchar(100) NOT NULL,
  `tipe_kriteria` varchar(20) NOT NULL,
  `bobot_kriteria` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id`, `kode_kriteria`, `nama_kriteria`, `tipe_kriteria`, `bobot_kriteria`) VALUES
(1, 'C01', 'Nilai Rapor', 'benefit', 0.3),
(2, 'C02', 'Kehadiran', 'benefit', 0.22),
(3, 'C03', 'Sikap', 'benefit', 0.3),
(4, 'C04', 'Prestasi', 'benefit', 0.18);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_alternatif`
--

CREATE TABLE `nilai_alternatif` (
  `id` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_subkriteria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilai_alternatif`
--

INSERT INTO `nilai_alternatif` (`id`, `id_siswa`, `id_kriteria`, `id_subkriteria`) VALUES
(16, 7, 1, 1),
(17, 7, 2, 3),
(18, 7, 3, 11),
(19, 7, 4, 16),
(20, 8, 1, 2),
(21, 8, 2, 3),
(22, 8, 3, 11),
(23, 8, 4, 16),
(24, 9, 1, 2),
(25, 9, 2, 4),
(26, 9, 3, 13),
(27, 9, 4, 19);

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan_kriteria`
--

CREATE TABLE `pengaturan_kriteria` (
  `id` int(11) NOT NULL,
  `kelas_siswa` varchar(100) NOT NULL,
  `tahun_ajaran_siswa` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengaturan_kriteria`
--

INSERT INTO `pengaturan_kriteria` (`id`, `kelas_siswa`, `tahun_ajaran_siswa`) VALUES
(1, 'XII A', '2025/2026'),
(3, 'XII B', '2025/2026');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `nama_siswa` varchar(255) NOT NULL,
  `NIS_siswa` int(11) NOT NULL,
  `kelas_siswa` varchar(100) NOT NULL,
  `jenis_kelamin_siswa` varchar(10) NOT NULL,
  `tahun_ajaran_siswa` varchar(100) NOT NULL,
  `is_valid` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nama_siswa`, `NIS_siswa`, `kelas_siswa`, `jenis_kelamin_siswa`, `tahun_ajaran_siswa`, `is_valid`) VALUES
(7, 'Udin', 123, 'XII A', 'L', '2025/2026', 0),
(8, 'Nia', 124, 'XII B', 'P', '2025/2026', 0),
(9, 'Bani', 125, 'XII A', 'L', '2025/2026', 0);

-- --------------------------------------------------------

--
-- Table structure for table `subkriteria`
--

CREATE TABLE `subkriteria` (
  `id` int(11) NOT NULL,
  `nama_subkriteria` varchar(255) NOT NULL,
  `nilai_subkriteria` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subkriteria`
--

INSERT INTO `subkriteria` (`id`, `nama_subkriteria`, `nilai_subkriteria`, `id_kriteria`) VALUES
(1, '96-100 (Sangat Tinggi)', 5, 1),
(2, '91-95 (Tinggi)', 4, 1),
(3, 'Sangat Baik', 5, 2),
(4, 'Baik', 4, 2),
(5, 'Cukup', 3, 2),
(6, 'Kurang', 2, 2),
(7, 'Sangat Buruk', 1, 2),
(8, '86-90 (Cukup)', 3, 1),
(9, '81-85 (Kurang)', 2, 1),
(10, '<80 (Perlu Ditingkatkan)', 1, 1),
(11, 'Sangat Baik', 5, 3),
(12, 'Baik', 4, 3),
(13, 'Cukup', 3, 3),
(14, 'Kurang', 2, 3),
(15, 'Sangat Buruk', 1, 3),
(16, 'Sangat Unggul', 5, 4),
(17, 'Unggul', 4, 4),
(18, 'Cukup', 3, 4),
(19, 'Kurang Memadai', 2, 4),
(20, 'Belum Memadai', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(15) NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'admin@gmail.com', 'admin', '$2y$10$wyjuVbjAn6bMrigkIS8H7el3l.iJ1t7b/niaazUefrB2mTYSzNDCi', 'admin', '2025-07-01 14:03:38'),
(2, 'user@gmail.com', 'user', '$2y$10$lRaXFENpsiqxs4LRExCcwun/AFjuh22Hy3zmObBGI4p3kGPW0LlPq', 'user', '2025-07-04 13:17:28'),
(3, 'aldo@gmail.com', 'aldo', '$2y$10$y0LjG6mdy33wziNB/M3s3e1MwCZtusbCd8IJQRtkVdST/eEzx1/w.', 'user', '2025-07-04 15:06:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_kriteria` (`kode_kriteria`);

--
-- Indexes for table `nilai_alternatif`
--
ALTER TABLE `nilai_alternatif`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nilai_alternatif_siswa_id_foreign` (`id_siswa`),
  ADD KEY `nilai_alternatif_kriteria_id_foreign` (`id_kriteria`),
  ADD KEY `nilai_alternatif_subkriteria_id_foreign` (`id_subkriteria`);

--
-- Indexes for table `pengaturan_kriteria`
--
ALTER TABLE `pengaturan_kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `NIS_siswa` (`NIS_siswa`);

--
-- Indexes for table `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subkriteria_kriteria_id_foreign` (`id_kriteria`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nilai_alternatif`
--
ALTER TABLE `nilai_alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `pengaturan_kriteria`
--
ALTER TABLE `pengaturan_kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `subkriteria`
--
ALTER TABLE `subkriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `nilai_alternatif`
--
ALTER TABLE `nilai_alternatif`
  ADD CONSTRAINT `nilai_alternatif_kriteria_id_foreign` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_alternatif_siswa_id_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_alternatif_subkriteria_id_foreign` FOREIGN KEY (`id_subkriteria`) REFERENCES `subkriteria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD CONSTRAINT `subkriteria_kriteria_id_foreign` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
