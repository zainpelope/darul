-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 03, 2024 at 02:15 AM
-- Server version: 8.0.35
-- PHP Version: 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `darul_ulum`
--

-- --------------------------------------------------------

--
-- Table structure for table `aset`
--

CREATE TABLE `aset` (
  `id_aset` int NOT NULL,
  `id_kategori` int DEFAULT NULL,
  `id_lokasi` int DEFAULT NULL,
  `id_penerimaan` int DEFAULT NULL,
  `nama_aset` varchar(255) DEFAULT NULL,
  `deskripsi` text,
  `nilai_awal` decimal(15,2) DEFAULT NULL,
  `nilai_sekarang` decimal(15,2) DEFAULT NULL,
  `nomor_seri` varchar(255) DEFAULT NULL,
  `kode_qr` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Aktif',
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `aset`
--

INSERT INTO `aset` (`id_aset`, `id_kategori`, `id_lokasi`, `id_penerimaan`, `nama_aset`, `deskripsi`, `nilai_awal`, `nilai_sekarang`, `nomor_seri`, `kode_qr`, `status`, `gambar`) VALUES
(19, 3, 3, NULL, 'ewdewde', 'ewrere', 4565465.00, 0.00, '46456', 'QR-674e5b11ec67a', 'Tidak Aktif', '674e5b11ec585-2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `hak_akses`
--

CREATE TABLE `hak_akses` (
  `id_role` int NOT NULL,
  `nama_role` varchar(255) DEFAULT NULL,
  `deskripsi_role` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `hak_akses`
--

INSERT INTO `hak_akses` (`id_role`, `nama_role`, `deskripsi_role`) VALUES
(1, 'Tata Usaha', 'tu'),
(2, 'Kepala Sekolah', 'Kepala Sekolah'),
(3, 'Guru', 'Guru adalah pengajar');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_aset`
--

CREATE TABLE `kategori_aset` (
  `id_kategori` int NOT NULL,
  `nama_kategori` varchar(255) DEFAULT NULL,
  `deskripsi_kategori` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `kategori_aset`
--

INSERT INTO `kategori_aset` (`id_kategori`, `nama_kategori`, `deskripsi_kategori`) VALUES
(3, 'Komputer', 'Komputer'),
(4, 'Meja', 'Meja');

-- --------------------------------------------------------

--
-- Table structure for table `kebutuhan_aset`
--

CREATE TABLE `kebutuhan_aset` (
  `id_kebutuhan` int NOT NULL,
  `deskripsi_kebutuhan` text,
  `tanggal_dibuat` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `id_lokasi` int NOT NULL,
  `nama_lokasi` varchar(255) DEFAULT NULL,
  `deskripsi_lokasi` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`id_lokasi`, `nama_lokasi`, `deskripsi_lokasi`) VALUES
(3, 'Lapangan', 'Lapangan Upacara');

-- --------------------------------------------------------

--
-- Table structure for table `penerimaan_aset`
--

CREATE TABLE `penerimaan_aset` (
  `id_penerimaan` int NOT NULL,
  `id_pengadaan` int DEFAULT NULL,
  `id_pengguna` int DEFAULT NULL,
  `tanggal_penerimaan` date DEFAULT NULL,
  `kondisi` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `pengadaan_aset`
--

CREATE TABLE `pengadaan_aset` (
  `id_pengadaan` int NOT NULL,
  `id_kebutuhan` int DEFAULT NULL,
  `tanggal_pengadaan` date DEFAULT NULL,
  `vendor` varchar(255) DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int NOT NULL,
  `id_role` int DEFAULT NULL,
  `nama_pengguna` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `id_role`, `nama_pengguna`, `email`, `password`) VALUES
(1, 1, 'Tata Usaha', 'tu@gmail.com', 'tu'),
(2, 2, 'Kepala Sekolah', 'kepsek@gmail.com', 'kepsek\r\n'),
(3, 3, 'guruku', 'guru@gmail.com', 'guru'),
(4, 2, 'a', 'a@gmail.com', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `penghapusan_aset`
--

CREATE TABLE `penghapusan_aset` (
  `id_penghapusan` int NOT NULL,
  `id_aset` int DEFAULT NULL,
  `id_pengguna` int DEFAULT NULL,
  `tanggal_penghapusan` date DEFAULT NULL,
  `alasan_penghapusan` text,
  `nilai_penghapusan` decimal(15,2) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `penyusutan_aset`
--

CREATE TABLE `penyusutan_aset` (
  `id_penyusutan` int NOT NULL,
  `id_aset` int DEFAULT NULL,
  `tanggal_penyusutan` date DEFAULT NULL,
  `nilai_penyusutan` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `penyusutan_aset`
--

INSERT INTO `penyusutan_aset` (`id_penyusutan`, `id_aset`, `tanggal_penyusutan`, `nilai_penyusutan`) VALUES
(1, 19, '2024-12-03', 5.00);

-- --------------------------------------------------------

--
-- Table structure for table `perbaikan_aset`
--

CREATE TABLE `perbaikan_aset` (
  `id_perbaikan` int NOT NULL,
  `id_aset` int DEFAULT NULL,
  `tanggal_perbaikan` date DEFAULT NULL,
  `deksripsi_kegiatan` text,
  `biaya` decimal(15,2) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `bukti_perbaikan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aset`
--
ALTER TABLE `aset`
  ADD PRIMARY KEY (`id_aset`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_lokasi` (`id_lokasi`),
  ADD KEY `aset_ibfk_3` (`id_penerimaan`);

--
-- Indexes for table `hak_akses`
--
ALTER TABLE `hak_akses`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `kategori_aset`
--
ALTER TABLE `kategori_aset`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kebutuhan_aset`
--
ALTER TABLE `kebutuhan_aset`
  ADD PRIMARY KEY (`id_kebutuhan`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indexes for table `penerimaan_aset`
--
ALTER TABLE `penerimaan_aset`
  ADD PRIMARY KEY (`id_penerimaan`),
  ADD KEY `penerimaan_aset_ibfk_1` (`id_pengadaan`),
  ADD KEY `penerimaan_aset_ibfk_2` (`id_pengguna`);

--
-- Indexes for table `pengadaan_aset`
--
ALTER TABLE `pengadaan_aset`
  ADD PRIMARY KEY (`id_pengadaan`),
  ADD KEY `pengadaan_aset_ibfk_1` (`id_kebutuhan`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD KEY `pengguna_ibfk_1` (`id_role`);

--
-- Indexes for table `penghapusan_aset`
--
ALTER TABLE `penghapusan_aset`
  ADD PRIMARY KEY (`id_penghapusan`),
  ADD KEY `penghapusan_aset_ibfk_1` (`id_aset`),
  ADD KEY `penghapusan_aset_ibfk_2` (`id_pengguna`);

--
-- Indexes for table `penyusutan_aset`
--
ALTER TABLE `penyusutan_aset`
  ADD PRIMARY KEY (`id_penyusutan`),
  ADD KEY `penyusutan_aset_ibfk_1` (`id_aset`);

--
-- Indexes for table `perbaikan_aset`
--
ALTER TABLE `perbaikan_aset`
  ADD PRIMARY KEY (`id_perbaikan`),
  ADD KEY `perbaikan_aset_ibfk_1` (`id_aset`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aset`
--
ALTER TABLE `aset`
  MODIFY `id_aset` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `hak_akses`
--
ALTER TABLE `hak_akses`
  MODIFY `id_role` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori_aset`
--
ALTER TABLE `kategori_aset`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kebutuhan_aset`
--
ALTER TABLE `kebutuhan_aset`
  MODIFY `id_kebutuhan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id_lokasi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penerimaan_aset`
--
ALTER TABLE `penerimaan_aset`
  MODIFY `id_penerimaan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pengadaan_aset`
--
ALTER TABLE `pengadaan_aset`
  MODIFY `id_pengadaan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `penghapusan_aset`
--
ALTER TABLE `penghapusan_aset`
  MODIFY `id_penghapusan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `penyusutan_aset`
--
ALTER TABLE `penyusutan_aset`
  MODIFY `id_penyusutan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `perbaikan_aset`
--
ALTER TABLE `perbaikan_aset`
  MODIFY `id_perbaikan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aset`
--
ALTER TABLE `aset`
  ADD CONSTRAINT `aset_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_aset` (`id_kategori`),
  ADD CONSTRAINT `aset_ibfk_2` FOREIGN KEY (`id_lokasi`) REFERENCES `lokasi` (`id_lokasi`),
  ADD CONSTRAINT `aset_ibfk_3` FOREIGN KEY (`id_penerimaan`) REFERENCES `penerimaan_aset` (`id_penerimaan`) ON DELETE CASCADE;

--
-- Constraints for table `penerimaan_aset`
--
ALTER TABLE `penerimaan_aset`
  ADD CONSTRAINT `penerimaan_aset_ibfk_1` FOREIGN KEY (`id_pengadaan`) REFERENCES `pengadaan_aset` (`id_pengadaan`) ON DELETE CASCADE,
  ADD CONSTRAINT `penerimaan_aset_ibfk_2` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE;

--
-- Constraints for table `pengadaan_aset`
--
ALTER TABLE `pengadaan_aset`
  ADD CONSTRAINT `pengadaan_aset_ibfk_1` FOREIGN KEY (`id_kebutuhan`) REFERENCES `kebutuhan_aset` (`id_kebutuhan`) ON DELETE CASCADE;

--
-- Constraints for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD CONSTRAINT `pengguna_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `hak_akses` (`id_role`) ON DELETE CASCADE;

--
-- Constraints for table `penghapusan_aset`
--
ALTER TABLE `penghapusan_aset`
  ADD CONSTRAINT `penghapusan_aset_ibfk_1` FOREIGN KEY (`id_aset`) REFERENCES `aset` (`id_aset`) ON DELETE CASCADE,
  ADD CONSTRAINT `penghapusan_aset_ibfk_2` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE;

--
-- Constraints for table `penyusutan_aset`
--
ALTER TABLE `penyusutan_aset`
  ADD CONSTRAINT `penyusutan_aset_ibfk_1` FOREIGN KEY (`id_aset`) REFERENCES `aset` (`id_aset`) ON DELETE CASCADE;

--
-- Constraints for table `perbaikan_aset`
--
ALTER TABLE `perbaikan_aset`
  ADD CONSTRAINT `perbaikan_aset_ibfk_1` FOREIGN KEY (`id_aset`) REFERENCES `aset` (`id_aset`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
