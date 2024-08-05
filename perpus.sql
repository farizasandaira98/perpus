-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 04, 2024 at 05:33 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` bigint(255) NOT NULL,
  `kode_buku` varchar(255) NOT NULL,
  `sinopsis` varchar(255) NOT NULL,
  `nama_buku` varchar(255) NOT NULL,
  `nama_pengarang` varchar(255) NOT NULL,
  `nama_penerbit` varchar(255) NOT NULL,
  `tahun_terbit` varchar(255) NOT NULL,
  `jumlah_buku` int(255) NOT NULL,
  `id_klasifikasi` bigint(255) UNSIGNED NOT NULL,
  `foto` varchar(255) NOT NULL,
  `search_count` bigint(255) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `klasifikasi_buku`
--

CREATE TABLE `klasifikasi_buku` (
  `id` bigint(255) UNSIGNED NOT NULL,
  `nama_klasifikasi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` bigint(255) NOT NULL,
  `id_role` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `nomor_telepon` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `id_role`, `username`, `password`, `nama`, `pekerjaan`, `nomor_telepon`, `alamat`, `email`, `created_at`, `updated_at`) VALUES
(3, 1, 'admin', '$2y$10$qaNpwBzGqMhKKaI8MIELs.gU.43sQAssUrCV55CVX5KEPML34gENe', 'Admin', 'Admin', '0853979867210', 'Jl.Pakualaman', 'Syafrie2015@gmail.com', '2024-01-10', '2024-05-27'),
(11, 2, 'Ujicoba', '$2y$10$TKaHr/07jGbikWFo9AmKseaVGyhFxM8tvUTr/3orc.c4HPiIenSGS', 'Ujicoba', 'Ujicoba', '08980022680', 'Jl.Ujicoba', 'ujicoba@gmail.com', '2024-07-18', '2024-07-26'),
(12, 2, 'user', '$2y$10$CTkPqWO3jy/4ZrEJtCwIse38zwFi/dRHMenHqtO2bzeQSLB1hmBXa', 'User', 'Test', '082222222222', 'Test', 'user@user.com', '2024-08-03', '2024-08-03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_klasifikasi` (`id_klasifikasi`);

--
-- Indexes for table `klasifikasi_buku`
--
ALTER TABLE `klasifikasi_buku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `password` (`password`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=540;

--
-- AUTO_INCREMENT for table `klasifikasi_buku`
--
ALTER TABLE `klasifikasi_buku`
  MODIFY `id` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_klasifikasi`) REFERENCES `klasifikasi_buku` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
