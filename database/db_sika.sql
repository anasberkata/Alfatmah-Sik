-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 28, 2023 at 09:23 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sika`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id_guru` int(11) NOT NULL,
  `nama_guru` varchar(255) NOT NULL,
  `mapel` varchar(255) NOT NULL,
  `date_created` date NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `nama_guru`, `mapel`, `date_created`, `is_active`) VALUES
(1, 'Sukijan', 'Bahasa Dinosaurus', '2023-04-27', 1),
(2, 'Sumijan', 'Bahasa Komodo', '2023-04-27', 1),
(4, 'Sukimin', 'Bahasa Gorila', '2023-04-27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pembayaran`
--

CREATE TABLE `jenis_pembayaran` (
  `id_jenis_pembayaran` int(11) NOT NULL,
  `jenis_pembayaran` varchar(255) NOT NULL,
  `nominal` int(11) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_pembayaran`
--

INSERT INTO `jenis_pembayaran` (`id_jenis_pembayaran`, `jenis_pembayaran`, `nominal`, `deskripsi`) VALUES
(1, 'BPP', 900000, '(Biaya Pengembangan Pendidikan)'),
(2, 'BBP', 90000, '(Biaya Bulanan Pendidikan)');

-- --------------------------------------------------------

--
-- Table structure for table `kwitansi`
--

CREATE TABLE `kwitansi` (
  `logo` varchar(255) NOT NULL,
  `yayasan` varchar(255) NOT NULL,
  `sekolah` varchar(255) NOT NULL,
  `id_bendahara` int(11) NOT NULL,
  `ttd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kwitansi`
--

INSERT INTO `kwitansi` (`logo`, `yayasan`, `sekolah`, `id_bendahara`, `ttd`) VALUES
('644bd8df2351a.png', 'YAYASAN PONDOK PASANTREN AL-FATMAH', 'SMK AL-FATMAH CIANJUR', 3, '644bd8eded95b.png');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_jenis_pembayaran` int(11) NOT NULL,
  `bbp_bulan` date NOT NULL,
  `nominal` int(11) NOT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `bukti` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rombel`
--

CREATE TABLE `rombel` (
  `id_rombel` int(11) NOT NULL,
  `rombel` varchar(255) NOT NULL,
  `id_guru` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rombel`
--

INSERT INTO `rombel` (`id_rombel`, `rombel`, `id_guru`) VALUES
(1, 'X PB 1', 1),
(3, 'X PB 2', 2),
(4, 'X PB 3', 4);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nis` int(11) NOT NULL,
  `nisn` int(11) NOT NULL,
  `nama_siswa` varchar(255) NOT NULL,
  `id_rombel` int(11) NOT NULL,
  `jk` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `date_created` date NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nis`, `nisn`, `nama_siswa`, `id_rombel`, `jk`, `alamat`, `phone`, `username`, `password`, `gambar`, `date_created`, `is_active`) VALUES
(1, 123456, 123456, 'Udin Petot', 1, 'Laki-Laki', 'Perumahan Permata Indehoy', '080000000', 'siswa01', 'siswa01', 'default.jpg', '2023-04-27', 1),
(2, 654321, 654321, 'Petot Marwati', 1, 'Perempuan', 'Kampung Monyet Cacat', '08176175283', 'siswa02', 'siswa02', 'default.jpg', '2023-04-27', 1),
(4, 203762265, 203762265, 'Itih Suritih', 3, 'Perempuan', 'Cicicuit', '092897986374', 'siswa03', 'siswa03', 'default.jpg', '2023-04-28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `username`, `email`, `password`, `image`, `role_id`, `date_created`, `is_active`) VALUES
(1, 'Indra Lesmana', 'admin', 'indralesmana@gmail.com', 'admin', 'default.jpg', 1, '2023-04-26', 1),
(3, 'Bendahara Alfatmah', 'bendahara', 'bendahara@gmail.com', 'bendahara', 'default.jpg', 2, '2023-04-26', 1),
(5, 'Bendahara Alfatmah 2', 'bendahara02', 'bendahara02@gmail.com', 'bendahara02', 'default.jpg', 2, '2023-04-28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_role`
--

CREATE TABLE `users_role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_role`
--

INSERT INTO `users_role` (`id_role`, `role`) VALUES
(1, 'Admin'),
(2, 'Bendahara'),
(3, 'Siswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `jenis_pembayaran`
--
ALTER TABLE `jenis_pembayaran`
  ADD PRIMARY KEY (`id_jenis_pembayaran`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `rombel`
--
ALTER TABLE `rombel`
  ADD PRIMARY KEY (`id_rombel`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `users_role`
--
ALTER TABLE `users_role`
  ADD PRIMARY KEY (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jenis_pembayaran`
--
ALTER TABLE `jenis_pembayaran`
  MODIFY `id_jenis_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rombel`
--
ALTER TABLE `rombel`
  MODIFY `id_rombel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users_role`
--
ALTER TABLE `users_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
