-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2020 at 05:09 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ftp`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_data_customer`
--

CREATE TABLE `tb_data_customer` (
  `id` int(5) NOT NULL,
  `nama_file` varchar(125) NOT NULL,
  `deskripsi` varchar(125) NOT NULL,
  `cabang` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_data_customer`
--

INSERT INTO `tb_data_customer` (`id`, `nama_file`, `deskripsi`, `cabang`) VALUES
(1, 'File Latihan 1', 'File Latihan 1 Cabang Bandung', 'Bandung'),
(2, 'File Latihan 2', 'File Latihan 2 Cabang Bekasi', 'Bekasi');

-- --------------------------------------------------------

--
-- Table structure for table `tb_log_download`
--

CREATE TABLE `tb_log_download` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `waktu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_log_login`
--

CREATE TABLE `tb_log_login` (
  `id` int(5) NOT NULL,
  `username` varchar(255) NOT NULL,
  `waktu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_log_login`
--

INSERT INTO `tb_log_login` (`id`, `username`, `waktu`) VALUES
(2, 'BDG-admin01', '08/27/2020 04:44:18 am'),
(3, 'BDG-001', '08/27/2020 04:47:57 am'),
(4, 'BDG-admin01', '08/27/2020 04:49:41 am'),
(5, 'BDG-admin01', '08/27/2020 04:51:37 am'),
(6, 'BDG-admin01', '08/27/2020 09:54:51 am');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(4) NOT NULL,
  `nama_akun` varchar(255) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `level` varchar(10) NOT NULL,
  `cabang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama_akun`, `username`, `password`, `level`, `cabang`) VALUES
(1, 'Bangun Satria ependi', 'BDG-001', 'qwerty123', 'user', 'Bandung'),
(2, 'Julio Gerhana', 'BKS-001', 'qwerty123', 'user', 'Bekasi'),
(3, 'Admin Cabang Bandung', 'BDG-admin01', 'admin', 'admin', 'Bandung');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_data_customer`
--
ALTER TABLE `tb_data_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_log_login`
--
ALTER TABLE `tb_log_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_data_customer`
--
ALTER TABLE `tb_data_customer`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_log_login`
--
ALTER TABLE `tb_log_login`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
