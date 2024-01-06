-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2021 at 05:53 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental_mobil`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_mobil`
--

CREATE TABLE `tb_mobil` (
  `id_mobil` int(11) NOT NULL,
  `no_polisi` varchar(50) NOT NULL,
  `merk` varchar(50) NOT NULL,
  `tahun` int(11) NOT NULL,
  `hrg_mobil` int(11) NOT NULL,
  `status_mobil` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_mobil`
--

INSERT INTO `tb_mobil` (`id_mobil`, `no_polisi`, `merk`, `tahun`, `hrg_mobil`, `status_mobil`) VALUES
(2, 'BM 2234 DE', 'Toyota Avanja', 2010, 500000, 'Sewa'),
(3, '98757685998', 'Jazz 2008', 2008, 700000, 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `id_order` int(11) NOT NULL,
  `id_mobil` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_order` varchar(50) NOT NULL,
  `ktp` varchar(50) NOT NULL,
  `jk_order` enum('L','P') NOT NULL,
  `alamat` text NOT NULL,
  `telp_order` int(11) NOT NULL,
  `tujuan` varchar(50) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `lama` int(11) NOT NULL,
  `hrg_total` double NOT NULL,
  `status_order` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`id_order`, `id_mobil`, `id_user`, `nama_order`, `ktp`, `jk_order`, `alamat`, `telp_order`, `tujuan`, `tgl_pinjam`, `tgl_kembali`, `lama`, `hrg_total`, `status_order`) VALUES
(4, 2, 2, 'Ridho Surya', '1324123', 'L', 'asd', 1235134, 'Pariaman', '2020-08-02', '2020-08-06', 4, 2000000, 'Pinjam');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(256) NOT NULL,
  `jk_user` enum('L','P') NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_user`, `username`, `password`, `jk_user`, `level`) VALUES
(2, 'ridho surya', 'ridho', '$2y$10$5SsPtgFlLvJfcgHgWSlvleKVZj6CIkK7OgxoMTMOfJTO.yluyahPi', 'L', '1'),
(3, 'marini alsa khairana', 'rana@gmail.com', '$2y$10$P2hPYfUtNWa3Dt1b7qrQj.p9dHpQjzzjy1aa7PcFMIWU4bm6b6nrW', 'P', '2'),
(7, 'harun saputra', 'harun', '$2y$10$8zGzm/jq35sNwUhJdbPJB.U4R/dHgyqXnACnX2eH2QuPw2fDtQjLO', 'L', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_mobil`
--
ALTER TABLE `tb_mobil`
  ADD PRIMARY KEY (`id_mobil`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_mobil`
--
ALTER TABLE `tb_mobil`
  MODIFY `id_mobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
