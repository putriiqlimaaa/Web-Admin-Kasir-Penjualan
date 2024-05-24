-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2023 at 11:17 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rakab`
--

-- --------------------------------------------------------

--
-- Table structure for table `datamakanan`
--

CREATE TABLE `datamakanan` (
  `idmakanan` int(11) NOT NULL,
  `namamakanan` varchar(20) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `datamakanan`
--

INSERT INTO `datamakanan` (`idmakanan`, `namamakanan`, `harga`, `stok`) VALUES
(1200000001, 'Bakso Bakar Pedas', 3000, 100),
(1200000002, 'Sosis Bakar Pedas', 3000, 95),
(1200000003, 'Tahu Bakar Pedas', 3000, 95),
(1200000004, 'Tempe Bakar Pedas', 3000, 95),
(1200000005, 'Ayam Bakar Pedas', 15000, 28);

-- --------------------------------------------------------

--
-- Table structure for table `detailpesanan`
--

CREATE TABLE `detailpesanan` (
  `iddetailpesanan` int(11) NOT NULL,
  `idpesanan` int(11) NOT NULL,
  `idmakanan` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detailpesanan`
--

INSERT INTO `detailpesanan` (`iddetailpesanan`, `idpesanan`, `idmakanan`, `qty`, `tanggal`) VALUES
(1, 1300000001, 1200000001, 10, '2023-06-28 18:36:54'),
(6, 1300000001, 1200000002, 10, '2023-06-28 23:53:13'),
(7, 1300000001, 1200000005, 3, '2023-06-28 23:53:23'),
(8, 1300000004, 1200000001, 5, '2023-06-28 23:53:58'),
(9, 1300000004, 1200000002, 5, '2023-06-28 23:54:05'),
(10, 1300000004, 1200000003, 5, '2023-06-28 23:54:11'),
(11, 1300000004, 1200000004, 5, '2023-06-28 23:54:18'),
(12, 1300000004, 1200000005, 1, '2023-06-28 23:54:23');

-- --------------------------------------------------------

--
-- Table structure for table `masuk`
--

CREATE TABLE `masuk` (
  `idmasuk` int(11) NOT NULL,
  `idmakanan` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `tanggalmasuk` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `masuk`
--

INSERT INTO `masuk` (`idmasuk`, `idmakanan`, `qty`, `tanggalmasuk`) VALUES
(1, 1200000001, 15, '2023-06-28 18:17:36'),
(2, 1200000002, 10, '2023-06-28 18:17:44'),
(4, 1200000005, 2, '2023-06-28 23:58:47');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `idpelanggan` int(11) NOT NULL,
  `namapelanggan` varchar(30) NOT NULL,
  `notelp` varchar(15) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`idpelanggan`, `namapelanggan`, `notelp`, `alamat`) VALUES
(1100000001, 'najwa', '0812435678903', 'Blangpulo'),
(1100000002, 'sopia', '085366748921', 'Blangpulo');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `idpesanan` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `namapelanggan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`idpesanan`, `tanggal`, `namapelanggan`) VALUES
(1300000001, '2023-06-28 18:29:22', 'najwa'),
(1300000004, '2023-06-28 23:52:50', 'sopia');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `idtransaksi` int(11) NOT NULL,
  `namapelanggan` varchar(30) NOT NULL,
  `totalbelanja` int(11) NOT NULL,
  `uangbayar` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`idtransaksi`, `namapelanggan`, `totalbelanja`, `uangbayar`, `kembalian`) VALUES
(1220000001, 'najwa', 105000, 150000, 0),
(1220000004, 'sopia', 75000, 100000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`iduser`, `username`, `password`) VALUES
(1000000001, 'putri', 'putri'),
(1000000002, 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `datamakanan`
--
ALTER TABLE `datamakanan`
  ADD PRIMARY KEY (`idmakanan`);

--
-- Indexes for table `detailpesanan`
--
ALTER TABLE `detailpesanan`
  ADD PRIMARY KEY (`iddetailpesanan`);

--
-- Indexes for table `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`idmasuk`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`idpelanggan`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`idpesanan`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`idtransaksi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `datamakanan`
--
ALTER TABLE `datamakanan`
  MODIFY `idmakanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1200000007;

--
-- AUTO_INCREMENT for table `detailpesanan`
--
ALTER TABLE `detailpesanan`
  MODIFY `iddetailpesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `masuk`
--
ALTER TABLE `masuk`
  MODIFY `idmasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `idpelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1100000004;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `idpesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1300000005;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `idtransaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1220000005;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000005;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
