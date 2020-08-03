-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Jul 2020 pada 14.25
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apotekk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_obat`
--

CREATE TABLE `tb_obat` (
  `obat_id` int(11) NOT NULL,
  `obat_nama` varchar(50) NOT NULL,
  `obat_stok` int(11) NOT NULL,
  `obat_beli` int(11) NOT NULL,
  `obat_jual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_obat`
--

INSERT INTO `tb_obat` (`obat_id`, `obat_nama`, `obat_stok`, `obat_beli`, `obat_jual`) VALUES
(1, 'Ethambutol', 166, 8000, 9000),
(2, 'Paracetamol', 150, 5000, 7000),
(8, 'ACNOL 10ML', -4, 9000, 10000),
(9, 'COUNTERPAIN 15 GR', 100, 20000, 22000),
(10, 'FATIGON C PLUS', 40, 4000, 5000),
(11, 'FLUTAMOL 60ML', 60, 12000, 13000),
(12, 'GRALYSIN 60 ML', 80, 10000, 12000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembelian`
--

CREATE TABLE `tb_pembelian` (
  `pembelian_id` int(11) NOT NULL,
  `pembelian_id_transaksi` char(30) NOT NULL,
  `pembelian_tanggal` date NOT NULL,
  `pembelian_supplier` varchar(50) NOT NULL,
  `pembelian_subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pembelian`
--

INSERT INTO `tb_pembelian` (`pembelian_id`, `pembelian_id_transaksi`, `pembelian_tanggal`, `pembelian_supplier`, `pembelian_subtotal`) VALUES
(10, 'PMB-20191204065008', '2019-12-04', 'PT Andi', 900000),
(11, 'PMB-20191205055358', '2019-12-05', 'PT Andi', 910000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembelian_detail`
--

CREATE TABLE `tb_pembelian_detail` (
  `detail_id` int(11) NOT NULL,
  `detail_id_transaksi` int(11) NOT NULL,
  `detail_obat` varchar(50) NOT NULL,
  `detail_jumlah` int(11) NOT NULL,
  `detail_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pembelian_detail`
--

INSERT INTO `tb_pembelian_detail` (`detail_id`, `detail_id_transaksi`, `detail_obat`, `detail_jumlah`, `detail_harga`) VALUES
(11, 10, 'Ethambutol', 50, 400000),
(12, 10, 'Paracetamol', 100, 500000),
(13, 11, 'Ethambutol', 70, 560000),
(14, 11, 'Paracetamol', 70, 350000);

--
-- Trigger `tb_pembelian_detail`
--
DELIMITER $$
CREATE TRIGGER `update_stok_beli` AFTER INSERT ON `tb_pembelian_detail` FOR EACH ROW BEGIN
UPDATE tb_obat SET obat_stok = obat_stok + NEW.detail_jumlah WHERE obat_nama = NEW.detail_obat;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembelian_temp`
--

CREATE TABLE `tb_pembelian_temp` (
  `temp_id` int(11) NOT NULL,
  `temp_nama` varchar(50) NOT NULL,
  `temp_jumlah` int(11) NOT NULL,
  `temp_totalharga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penjualan`
--

CREATE TABLE `tb_penjualan` (
  `penjualan_id` int(11) NOT NULL,
  `penjualan_id_transaksi` char(30) NOT NULL,
  `penjualan_tanggal` date NOT NULL,
  `penjualan_subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_penjualan`
--

INSERT INTO `tb_penjualan` (`penjualan_id`, `penjualan_id_transaksi`, `penjualan_tanggal`, `penjualan_subtotal`) VALUES
(1, 'PNJ-20191204104744', '2019-12-03', 230000),
(2, 'PNJ-20191204184934', '2019-12-04', 520000),
(3, 'PNJ-20191204185325', '2019-12-04', 160000),
(4, 'PNJ-20191205060004', '2019-12-05', 620000),
(5, 'PNJ-20200708164433', '2020-07-08', 576000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penjualan_detail`
--

CREATE TABLE `tb_penjualan_detail` (
  `detail_id` int(11) NOT NULL,
  `detail_id_transaksi` int(11) NOT NULL,
  `detail_obat` varchar(50) NOT NULL,
  `detail_jumlah` int(11) NOT NULL,
  `detail_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_penjualan_detail`
--

INSERT INTO `tb_penjualan_detail` (`detail_id`, `detail_id_transaksi`, `detail_obat`, `detail_jumlah`, `detail_harga`) VALUES
(1, 1, 'Ethambutol', 10, 90000),
(2, 1, 'Paracetamol', 20, 140000),
(3, 2, 'Ethambutol', 50, 450000),
(4, 2, 'Paracetamol', 10, 70000),
(5, 3, 'Ethambutol', 10, 90000),
(6, 3, 'Paracetamol', 10, 70000),
(7, 4, 'Ethambutol', 30, 270000),
(8, 4, 'Paracetamol', 50, 350000),
(9, 5, 'Ethambutol', 4, 36000),
(10, 5, 'ACNOL 10ML', 54, 540000);

--
-- Trigger `tb_penjualan_detail`
--
DELIMITER $$
CREATE TRIGGER `update_stok_jual` AFTER INSERT ON `tb_penjualan_detail` FOR EACH ROW BEGIN
UPDATE tb_obat SET obat_stok = obat_stok - NEW.detail_jumlah WHERE obat_nama = NEW.detail_obat;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penjualan_temp`
--

CREATE TABLE `tb_penjualan_temp` (
  `temp_id` int(11) NOT NULL,
  `temp_nama` varchar(50) NOT NULL,
  `temp_jumlah` int(11) NOT NULL,
  `temp_totalharga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_supplier`
--

CREATE TABLE `tb_supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_nama` varchar(50) NOT NULL,
  `supplier_alamat` text NOT NULL,
  `supplier_telp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_supplier`
--

INSERT INTO `tb_supplier` (`supplier_id`, `supplier_nama`, `supplier_alamat`, `supplier_telp`) VALUES
(1, 'PT Andi', 'Jalan Kalpataru No. 43 Malang', '085847456294'),
(3, 'PT Maju Sejahtera', 'Jalan Sumbersar No.100', '08537375735'),
(4, 'PT. Sukses Selalu', 'Jalan Patimura No.30', '085123456789');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` int(11) NOT NULL,
  `user_nama` char(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `user_nama`, `user_name`, `user_password`, `user_foto`) VALUES
(1, 'Yahya dani L', 'admin', '0192023a7bbd73250516f069df18b500', 'avatar6.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_obat`
--
ALTER TABLE `tb_obat`
  ADD PRIMARY KEY (`obat_id`);

--
-- Indeks untuk tabel `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  ADD PRIMARY KEY (`pembelian_id`);

--
-- Indeks untuk tabel `tb_pembelian_detail`
--
ALTER TABLE `tb_pembelian_detail`
  ADD PRIMARY KEY (`detail_id`);

--
-- Indeks untuk tabel `tb_pembelian_temp`
--
ALTER TABLE `tb_pembelian_temp`
  ADD PRIMARY KEY (`temp_id`);

--
-- Indeks untuk tabel `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  ADD PRIMARY KEY (`penjualan_id`);

--
-- Indeks untuk tabel `tb_penjualan_detail`
--
ALTER TABLE `tb_penjualan_detail`
  ADD PRIMARY KEY (`detail_id`);

--
-- Indeks untuk tabel `tb_penjualan_temp`
--
ALTER TABLE `tb_penjualan_temp`
  ADD PRIMARY KEY (`temp_id`);

--
-- Indeks untuk tabel `tb_supplier`
--
ALTER TABLE `tb_supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_obat`
--
ALTER TABLE `tb_obat`
  MODIFY `obat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  MODIFY `pembelian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_pembelian_detail`
--
ALTER TABLE `tb_pembelian_detail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tb_pembelian_temp`
--
ALTER TABLE `tb_pembelian_temp`
  MODIFY `temp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  MODIFY `penjualan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_penjualan_detail`
--
ALTER TABLE `tb_penjualan_detail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_penjualan_temp`
--
ALTER TABLE `tb_penjualan_temp`
  MODIFY `temp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `tb_supplier`
--
ALTER TABLE `tb_supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
