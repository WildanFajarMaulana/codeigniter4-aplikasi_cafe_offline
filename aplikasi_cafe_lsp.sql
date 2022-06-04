-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2022 at 10:07 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aplikasi_cafe_lsp`
--

-- --------------------------------------------------------

--
-- Table structure for table `tambahkeranjangtranksaksi`
--

CREATE TABLE `tambahkeranjangtranksaksi` (
  `id_tambah` int(11) NOT NULL,
  `id_tranksaksi` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `jumlah_tambah` int(11) NOT NULL,
  `total_harga_tambah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_keranjang`
--

CREATE TABLE `tb_keranjang` (
  `id` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_tranksaksi` int(11) NOT NULL,
  `nama_menu` varchar(70) NOT NULL,
  `gambar_menu` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_keranjang`
--

INSERT INTO `tb_keranjang` (`id`, `id_menu`, `id_tranksaksi`, `nama_menu`, `gambar_menu`, `jumlah`, `harga`, `total_harga`) VALUES
(19, 10, 19, 'boba', '1652786364_6b00448569b9917d00e0.jpeg', 1, 10000, 10000),
(20, 12, 19, 'ayam bakar', '1652845836_3ca5b10d26f34a745b58.jpg', 2, 20000, 40000),
(21, 8, 20, 'nasgor ', '1652774320_4f19ed11378eace1830e.jpeg', 2, 10000, 20000),
(24, 8, 21, 'nasgor ', '1652774320_4f19ed11378eace1830e.jpeg', 2, 10000, 20000),
(25, 12, 21, 'ayam bakar', '1652845836_3ca5b10d26f34a745b58.jpg', 2, 20000, 40000),
(26, 10, 21, 'boba', '1652786364_6b00448569b9917d00e0.jpeg', 1, 10000, 10000),
(30, 8, 22, 'nasgor ', '1652774320_4f19ed11378eace1830e.jpeg', 3, 10000, 30000),
(31, 12, 22, 'ayam bakar', '1652845836_3ca5b10d26f34a745b58.jpg', 2, 20000, 40000),
(32, 13, 22, 'soto', '1652846896_65d90cbe2769456be1a9.jpg', 1, 8000, 8000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_login`
--

CREATE TABLE `tb_login` (
  `id_login` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_login`
--

INSERT INTO `tb_login` (`id_login`, `nama`, `username`, `password`, `role`) VALUES
(1, 'admin utama', 'admin', 'admin', 'admin'),
(5, 'wildan', 'wildan', '$2y$10$4XAGXM7eKCbypvQt4f8U3OPg3IMq3q65i4m4XeRDjlH3DrhbsK4/e', 'manager'),
(6, 'kasir_1', 'kasir_1', '$2y$10$ChOOnb0u5M7fWrdX2.oN2Om0OHLhWtFsmLZLiYIZkU5KhjtfuCUb.', 'kasir'),
(7, 'kasir_2', 'anjayani', '$2y$10$gvvrbd4dWMw3qrgqBVFRi.fFYWKLKeFcAi7F8TxepCFvbV0j6nVAy', 'kasir');

-- --------------------------------------------------------

--
-- Table structure for table `tb_logpegawai`
--

CREATE TABLE `tb_logpegawai` (
  `id` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_logpegawai`
--

INSERT INTO `tb_logpegawai` (`id`, `id_pegawai`, `deskripsi`) VALUES
(2, 5, 'Menambahkan Menuayam bakar'),
(3, 5, 'Menambahkan Menusoto'),
(4, 6, 'Melakukan Tranksaksi 19'),
(5, 6, 'Melakukan Tranksaksi 20'),
(6, 6, 'Melakukan Tranksaksi 21'),
(7, 5, 'Menambahkan Menu kopi hitam'),
(8, 5, 'Menambahkan Menu kopi susu'),
(9, 6, 'Melakukan Tranksaksi 22');

-- --------------------------------------------------------

--
-- Table structure for table `tb_meja`
--

CREATE TABLE `tb_meja` (
  `id` int(11) NOT NULL,
  `kode_meja` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_meja`
--

INSERT INTO `tb_meja` (`id`, `kode_meja`, `status`) VALUES
(2, '2b', 0),
(3, '2c', 0),
(4, '2d', 0),
(5, '2e', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_menu`
--

CREATE TABLE `tb_menu` (
  `id` int(11) NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `gambar_menu` varchar(255) NOT NULL,
  `stok` int(11) DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_menu`
--

INSERT INTO `tb_menu` (`id`, `nama_menu`, `gambar_menu`, `stok`, `harga`, `kategori`) VALUES
(8, 'nasgor ', '1652774320_4f19ed11378eace1830e.jpeg', 33, 10000, 'makanan'),
(10, 'boba', '1652786364_6b00448569b9917d00e0.jpeg', 0, 10000, 'minuman'),
(12, 'ayam bakar', '1652845836_3ca5b10d26f34a745b58.jpg', 8, 20000, 'makanan'),
(13, 'soto', '1652846896_65d90cbe2769456be1a9.jpg', 19, 8000, 'makanan'),
(14, 'kopi hitam', '1653033228_72e5677cc0761e349a04.jpeg', 50, 4000, 'minuman'),
(15, 'kopi susu', '1653033255_0d1a42e7a66cae518716.jpeg', 50, 4000, 'minuman');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tranksaksi`
--

CREATE TABLE `tb_tranksaksi` (
  `id` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `nama_pembeli` varchar(50) NOT NULL,
  `total_pembayaran` int(11) NOT NULL,
  `status` varchar(70) NOT NULL,
  `kode_meja` varchar(100) NOT NULL,
  `tanggal_tertentu` varchar(100) NOT NULL,
  `hari` int(11) NOT NULL,
  `bulan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_tranksaksi`
--

INSERT INTO `tb_tranksaksi` (`id`, `id_pegawai`, `nama_pembeli`, `total_pembayaran`, `status`, `kode_meja`, `tanggal_tertentu`, `hari`, `bulan`) VALUES
(19, 6, 'bagus', 50000, 'selesai', '2c', '2022-05-18', 18, 5),
(20, 6, 'adam', 20000, 'selesai', '2c', '2022-05-19', 19, 5),
(21, 6, 'fajar', 70000, 'selesai', '2b', '2022-05-20', 20, 5),
(22, 6, 'adam', 78000, 'selesai', '2b', '2022-05-20', 20, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tambahkeranjangtranksaksi`
--
ALTER TABLE `tambahkeranjangtranksaksi`
  ADD PRIMARY KEY (`id_tambah`);

--
-- Indexes for table `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `tb_logpegawai`
--
ALTER TABLE `tb_logpegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_meja`
--
ALTER TABLE `tb_meja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_menu`
--
ALTER TABLE `tb_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_tranksaksi`
--
ALTER TABLE `tb_tranksaksi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tambahkeranjangtranksaksi`
--
ALTER TABLE `tambahkeranjangtranksaksi`
  MODIFY `id_tambah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tb_login`
--
ALTER TABLE `tb_login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_logpegawai`
--
ALTER TABLE `tb_logpegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_meja`
--
ALTER TABLE `tb_meja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_menu`
--
ALTER TABLE `tb_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_tranksaksi`
--
ALTER TABLE `tb_tranksaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
