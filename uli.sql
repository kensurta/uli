-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 18, 2025 at 05:47 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uli`
--

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `universitas` varchar(255) NOT NULL,
  `jurusan` enum('Teknik Informatika','Sistem Informasi','Rekayasa Perangkat Lunak','Manajemen','Akuntansi','Bisnis Digital','Komunikasi Desain Visual') NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `semester` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `nama`, `universitas`, `jurusan`, `no_hp`, `alamat`, `semester`) VALUES
(2, 'Kendisa Surta Tambunan', 'Universitas Bina Insani', 'Sistem Informasi', '081586755327', 'Jakarta', 1),
(3, 'Salfa Naziha', 'Universitas Bina Insani', 'Sistem Informasi', '08984760768', 'Bekasi', 1),
(4, 'Izdihar Fazrianti', 'Universitas Bina Insani', 'Teknik Informatika', '0895332520225', 'Bogor', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tagihan`
--

CREATE TABLE `tagihan` (
  `id_tagihan` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jurusan` enum('Teknik Informatika','Sistem Informasi','Rekayasa Perangkat Lunak','Manajemen','Akuntansi','Bisnis Digital','Komunikasi Desain Visual') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `semester` int NOT NULL,
  `jumlah_tagihan` int NOT NULL,
  `metode` enum('Cash','Cicilan 6x','Cicilan 3x','') NOT NULL,
  `via` enum('Bank','E-Wallet','Merchant','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tagihan`
--

INSERT INTO `tagihan` (`id_tagihan`, `nama`, `jurusan`, `semester`, `jumlah_tagihan`, `metode`, `via`) VALUES
(3, 'Izdihar Fazrianti', 'Teknik Informatika', 1, 5100000, 'Cash', 'Bank'),
(4, 'Salfa Naziha', 'Sistem Informasi', 1, 5100000, 'Cash', 'E-Wallet'),
(5, 'Kendisa Surta Tambunan', 'Sistem Informasi', 1, 5100000, 'Cash', 'Merchant');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`),
  ADD KEY `nama` (`nama`,`jurusan`,`semester`);

--
-- Indexes for table `tagihan`
--
ALTER TABLE `tagihan`
  ADD PRIMARY KEY (`id_tagihan`),
  ADD KEY `nama` (`nama`,`jurusan`,`semester`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tagihan`
--
ALTER TABLE `tagihan`
  MODIFY `id_tagihan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
