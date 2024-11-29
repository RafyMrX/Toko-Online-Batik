-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2020 at 11:04 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbpw192_18410100054`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$AIy0X1Ep6alaHDTofiChGeqq7k/d1Kc8vKQf1JZo0mKrzkkj6M626');

-- --------------------------------------------------------

--
-- Table structure for table `bom_produk`
--

CREATE TABLE `bom_produk` (
  `kode_bom` varchar(100) NOT NULL,
  `kode_bk` varchar(100) NOT NULL,
  `kode_produk` varchar(100) NOT NULL,
  `nama_produk` varchar(200) NOT NULL,
  `kebutuhan` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `kode_customer` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `telp` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`kode_customer`, `nama`, `email`, `username`, `password`, `telp`) VALUES
('C0002', 'Rafi Akbar', 'a.rafy@gmail.com', 'rafi', '$2y$10$/UjGYbisTPJhr8MgmT37qOXo1o/HJn3dhafPoSYbOlSN1E7olHIb.', '0856748564'),
('C0003', 'holi', 'izuddinkhubi@gmail.com', 'holi', '$2y$10$PYm57GT4NRw5BwElvUrmfu6xR9KB2xIWp8OqgLJ1iih4eSxDYBawG', '2323'),
('C0004', 'Kain', 'izuddinkhubi@gmail.com', 'kain', '$2y$10$0mJr/adDSREVRt23iBYkfe4mspCHeZBpCq9hL8MXw567fJd.FCZsi', '12344'),
('C0005', 'Kusuma', 'izuddinkhubi@gmail.com', 'kusuma', '$2y$10$q9LiONu7RQSgAJJSFfTedOrmiHUMbMTaTi04sfvOSA1omsRhHULjK', '7878787'),
('C0006', 'Rafi', 'Rafy@gmail.com', 'rafymrx', '$2y$10$dOlBFaimo9eDptB/cpvU1.8qWN2MmMK5DDZacbZgKAxwEHb5LWbtm', '087804616097');
('C0007', 'test', 'test@test', 'test', '$2y$10$s.Yx34.WGRWyo.to6zt.yeK0HcTTTiJodSLxKZx2/ViwfsemhArfy', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `kode_bk` varchar(100) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `qty` varchar(200) NOT NULL,
  `satuan` varchar(200) NOT NULL,
  `harga` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`kode_bk`, `nama`, `qty`, `satuan`, `harga`, `tanggal`) VALUES
('M0001', 'Kain', '96', 'Kodi', 8000, '2020-10-05'),
('M0002', 'Pewarna', '500', 'ml', 200, '2020-10-04');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `kode_customer` varchar(100) NOT NULL,
  `kode_produk` varchar(100) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `berat` varchar(200) NOT NULL,
  `ukuran` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `kode_produk` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `image` text NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` varchar(255) NOT NULL,
  `ukuran` varchar(255) NOT NULL,
  `berat` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`kode_produk`, `nama`, `image`, `deskripsi`, `harga`, `ukuran`, `berat`) VALUES
('P0001', 'Mega Mendung', '5f8271f209bee.jpg', 'Mega Mendung\r\n									', '20000,30000', 'm,l', '500'),
('P0002', 'Batik Sarimbit ', '5f83a163d58a7.jpg', 'Batik Sarimbit dengan motif bagus\r\n			', '15000,18000,20000,30000,50000', 's,m,l,xl,xxl', '100'),
('P0003', 'Batik Sarimbit Kuning', '5f83a1b5616e3.jpg', 'Batik sarimbit kuning dengan motif bagus\r\n			', '20000,30000,50000', 's,l,m', '100');
('P0004', 'test', '66921987859a6.png', '				test\r\n						', '1000,2000,3000', 's,m,l', '200');

-- --------------------------------------------------------

--
-- Table structure for table `produksi`
--

CREATE TABLE `produksi` (
  `id_order` int(11) NOT NULL,
  `invoice` varchar(200) NOT NULL,
  `kode_customer` varchar(200) NOT NULL,
  `kode_produk` varchar(200) NOT NULL,
  `nama_produk` varchar(200) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `ukuran` varchar(255) NOT NULL,
  `status` varchar(200) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `provinsi` varchar(200) NOT NULL,
  `kota` varchar(200) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `kode_pos` varchar(200) NOT NULL,
  `ekspedisi` varchar(255) NOT NULL,
  `paket_ekspedisi` varchar(200) NOT NULL,
  `ongkir` int(11) NOT NULL,
  `etd_ekspedisi` varchar(200) NOT NULL,
  `terima` varchar(200) NOT NULL,
  `tolak` varchar(200) NOT NULL,
  `cek` int(11) NOT NULL,
  `grand_total` int(11) NOT NULL,
  `timess` varchar(255) NOT NULL,
  `images` text NOT NULL,
  `tgl` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produksi`
--

INSERT INTO `produksi` (`id_order`, `invoice`, `kode_customer`, `kode_produk`, `nama_produk`, `qty`, `harga`, `ukuran`, `status`, `tanggal`, `provinsi`, `kota`, `alamat`, `kode_pos`, `ekspedisi`, `paket_ekspedisi`, `ongkir`, `etd_ekspedisi`, `terima`, `tolak`, `cek`, `grand_total`, `timess`, `images`, `tgl`) VALUES
(39, 'INV0001', 'C0005', 'P0001', 'Mega Mendung', 2, 20000, 'm', '0', 'Oct 12, 2020 02:33:09', 'Papua Barat', 'Teluk Wondama', 'Jl Tanah Merah Indah 1 No 10 C', '60129', 'jne', 'OKE 179,000 5-9 Hari', 179000, '5-9', '1', '0', 0, 40006, '01:33:09', '5f83533300a31.jpg', '2020-10-12'),
(40, 'INV0002', 'C0005', 'P0001', 'Mega Mendung', 1, 20000, 'm', '0', 'Oct 12, 2020 02:53:28', 'Jawa Timur', 'Surabaya', 'Jl Tanah Merah Indah 1 No 10 C', '60129', 'jne', 'REG 7,000 2-3 Hari', 7000, '2-3', '1', '0', 0, 20003, '01:53:28', '5f835ea041f26.jpg', '2020-10-12'),
(41, 'INV0003', 'C0006', 'P0001', 'Mega Mendung', 2, 20000, 'm', '0', 'Oct 12, 2020 08:26:53', 'Jawa Timur', 'Surabaya', 'Jl Tanah Merah Indah 1 No 10 C', '60129', 'jne', 'REG 7,000 2-3 Hari', 7000, '2-3', '1', '0', 0, 100009, '07:26:53', '5f83a34f0d970.jpg', '2020-10-12'),
(42, 'INV0003', 'C0006', 'P0003', 'Batik Sarimbit Kuning', 1, 30000, 'l', '0', 'Oct 12, 2020 08:26:53', 'Jawa Timur', 'Surabaya', 'Jl Tanah Merah Indah 1 No 10 C', '60129', 'jne', 'REG 7,000 2-3 Hari', 7000, '2-3', '1', '0', 0, 100009, '07:26:53', '5f83a34f0d970.jpg', '2020-10-12'),
(43, 'INV0003', 'C0006', 'P0002', 'Batik Sarimbit ', 1, 30000, 'xl', '0', 'Oct 12, 2020 08:26:53', 'Jawa Timur', 'Surabaya', 'Jl Tanah Merah Indah 1 No 10 C', '60129', 'jne', 'REG 7,000 2-3 Hari', 7000, '2-3', '1', '0', 0, 100009, '07:26:53', '5f83a34f0d970.jpg', '2020-10-12'),
(47, 'INV0004', 'C0006', 'P0001', 'Mega Mendung', 1, 20000, 'm', 'Pesanan Baru', 'Oct 12, 2020 09:50:17', 'Jawa Timur', 'Surabaya', 'Jl Tanah Merah Indah 1 No 10 C', '60129', 'jne', 'REG 7,000 2-3 Hari', 7000, '2-3', '0', '0', 0, 20009, '08:50:17', '5f83b6a1f19c8.jpg', '2020-10-12'),
(48, 'INV0005', 'C0006', 'P0003', 'Batik Sarimbit Kuning', 1, 30000, 'l', 'Pesanan Baru', 'Oct 13, 2020 10:26:03', 'Jawa Timur', 'Surabaya', 'Jl Tanah Merah Indah 1 No 10 C', '60129', 'jne', 'REG 7,000 2-3 Hari', 7000, '2-3', '0', '0', 0, 30005, '09:26:03', '', '2020-10-13');
(72, 'INV0006', 'C0007', 'P0002', 'Batik Sarimbit ', 1, 50000, 'xxl', 'Pesanan Baru', '2024-07-13 12:03:31', '', '', 'zxz', 'zxz', '', '', 0, '', '0', '0', 0, 0, '2024-07-13', '', '2024-07-13'),
(73, 'INV0007', 'C0007', 'P0002', 'Batik Sarimbit ', 1, 0, 'xxl', 'Pesanan Baru', 'Jul 13, 2024 13:05:03', '', '', 'dwd', 'da', '', '', 0, '', '0', '0', 0, 6, '12:05:03', '', '2424-07-13'),
(74, 'INV0008', 'C0007', 'P0003', 'Batik Sarimbit Kuning', 1, 30000, 'l', 'Pesanan Baru', '2024-07-13 12:07:19', '', '', 'dada', 'adad', '', '', 0, '', '0', '0', 0, 0, '2024-07-13', '669251dc9338a.png', '2024-07-13'),
(75, 'INV0008', 'C0007', 'P0003', 'Batik Sarimbit Kuning', 1, 50000, 'm', 'Pesanan Baru', '2024-07-13 12:07:19', '', '', 'dada', 'adad', '', '', 0, '', '0', '0', 0, 0, '2024-07-13', '669251dc9338a.png', '2024-07-13'),
(76, 'INV0008', 'C0007', 'P0003', 'Batik Sarimbit Kuning', 1, 20000, 's', 'Pesanan Baru', '2024-07-13 12:07:19', '', '', 'dada', 'adad', '', '', 0, '', '0', '0', 0, 0, '2024-07-13', '669251dc9338a.png', '2024-07-13'),
(77, 'INV0009', 'C0007', 'P0004', 'test', 1, 3000, 'l', 'Pesanan Baru', '2024-07-13 12:18:11', '', '', 'rrgr', 'grgrgr', '', '', 0, '', '0', '0', 0, 0, '2024-07-13', '', '2024-07-13'),
(78, 'INV0010', 'C0007', 'P0002', 'Batik Sarimbit ', 6, 50000, 'xxl', 'Pesanan Baru', '2024-07-13 12:22:21', '', '', 'dada', 'add', '', '', 0, '', '0', '0', 0, 0, '2024-07-13', '66925570130e4.png', '2024-07-13');

-- --------------------------------------------------------

--
-- Table structure for table `report_cancel`
--

CREATE TABLE `report_cancel` (
  `id_report_cancel` int(11) NOT NULL,
  `id_order` varchar(100) NOT NULL,
  `kode_produk` varchar(100) NOT NULL,
  `jumlah` varchar(100) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `report_inventory`
--

CREATE TABLE `report_inventory` (
  `id_report_inv` int(11) NOT NULL,
  `kode_bk` varchar(100) NOT NULL,
  `nama_bahanbaku` varchar(100) NOT NULL,
  `jml_stok_bk` int(11) NOT NULL,
  `tanggal` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `report_omset`
--

CREATE TABLE `report_omset` (
  `id_report_omset` int(11) NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_omset` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `report _penjualan`
--

CREATE TABLE `report _penjualan` (
  `id_report_sell` int(11) NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `kode_produk` varchar(100) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `jumlah_terjual` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `report_produksi`
--

CREATE TABLE `report_produksi` (
  `id_report_prd` int(11) NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `kode_produk` varchar(100) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `report_profit`
--

CREATE TABLE `report_profit` (
  `id_report_profit` int(11) NOT NULL,
  `kode_bom` varchar(100) NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `kode_produk` varchar(100) NOT NULL,
  `jumlah` varchar(11) NOT NULL,
  `total_profit` varchar(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`kode_customer`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`kode_bk`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indexes for table `produksi`
--
ALTER TABLE `produksi`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `report_cancel`
--
ALTER TABLE `report_cancel`
  ADD PRIMARY KEY (`id_report_cancel`);

--
-- Indexes for table `report_inventory`
--
ALTER TABLE `report_inventory`
  ADD PRIMARY KEY (`id_report_inv`);

--
-- Indexes for table `report_omset`
--
ALTER TABLE `report_omset`
  ADD PRIMARY KEY (`id_report_omset`);

--
-- Indexes for table `report _penjualan`
--
ALTER TABLE `report _penjualan`
  ADD PRIMARY KEY (`id_report_sell`);

--
-- Indexes for table `report_produksi`
--
ALTER TABLE `report_produksi`
  ADD PRIMARY KEY (`id_report_prd`);

--
-- Indexes for table `report_profit`
--
ALTER TABLE `report_profit`
  ADD PRIMARY KEY (`id_report_profit`),
  ADD UNIQUE KEY `kode_bom` (`kode_bom`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `produksi`
--
ALTER TABLE `produksi`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `report_cancel`
--
ALTER TABLE `report_cancel`
  MODIFY `id_report_cancel` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_inventory`
--
ALTER TABLE `report_inventory`
  MODIFY `id_report_inv` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_omset`
--
ALTER TABLE `report_omset`
  MODIFY `id_report_omset` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_produksi`
--
ALTER TABLE `report_produksi`
  MODIFY `id_report_prd` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_profit`
--
ALTER TABLE `report_profit`
  MODIFY `id_report_profit` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
