-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Jul 2020 pada 02.23
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
  `obat_stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_obat`
--

INSERT INTO `tb_obat` (`obat_id`, `obat_nama`, `obat_stok`) VALUES
(1, 'Ethambutol', 0),
(2, 'Paracetamol', 0),
(8, 'ACNOL 10ML', 0),
(9, 'COUNTERPAIN 15 GR', 0),
(10, 'FATIGON C PLUS', 0),
(11, 'FLUTAMOL 60ML', 0),
(12, 'GRALYSIN 60 ML', 0),
(13, 'coba', 0),
(14, 'coba', 0),
(15, 'coba', 0),
(17, 'Amoxcilin', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembelian`
--

CREATE TABLE `tb_pembelian` (
  `pembelian_id` int(11) NOT NULL,
  `pembelian_faktur` varchar(255) NOT NULL DEFAULT '0',
  `pembelian_tanggal_faktur` date NOT NULL,
  `pembelian_tanggal_masuk` date NOT NULL,
  `pembelian_id_transaksi` char(30) NOT NULL,
  `pembelian_tanggal` date NOT NULL,
  `pembelian_id_supplier` int(50) NOT NULL,
  `pembelian_subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembelian_detail`
--

CREATE TABLE `tb_pembelian_detail` (
  `detail_id` int(11) NOT NULL,
  `detail_id_transaksi` int(11) NOT NULL,
  `detail_obat_id` double NOT NULL,
  `detail_satuan_beli` varchar(255) NOT NULL DEFAULT 'tes',
  `detail_harga_jual` double NOT NULL DEFAULT 0,
  `detail_harga_beli` double DEFAULT 0,
  `detail_diskon` int(11) NOT NULL DEFAULT 0,
  `detail_expired` datetime NOT NULL DEFAULT current_timestamp(),
  `detail_tanggal_terima` datetime NOT NULL DEFAULT current_timestamp(),
  `detail_jumlah` int(11) NOT NULL,
  `detail_harga` int(11) NOT NULL,
  `jml_update` int(36) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Trigger `tb_pembelian_detail`
--
DELIMITER $$
CREATE TRIGGER `update_stok_beli` AFTER INSERT ON `tb_pembelian_detail` FOR EACH ROW BEGIN
UPDATE tb_obat SET obat_stok = obat_stok + NEW.detail_jumlah WHERE obat_id = NEW.detail_obat_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_stok_obat_global` AFTER UPDATE ON `tb_pembelian_detail` FOR EACH ROW BEGIN
UPDATE tb_obat SET obat_stok = obat_stok - NEW.jml_update WHERE obat_id = NEW.detail_obat_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembelian_temp`
--

CREATE TABLE `tb_pembelian_temp` (
  `temp_id` int(11) NOT NULL,
  `temp_faktur` varchar(255) NOT NULL,
  `temp_obat_id` varchar(255) NOT NULL,
  `temp_satuan_beli` varchar(255) NOT NULL,
  `temp_harga_beli` double NOT NULL,
  `temp_harga_jual` double NOT NULL DEFAULT 0,
  `temp_diskon` int(11) NOT NULL DEFAULT 0,
  `temp_expired` datetime NOT NULL DEFAULT current_timestamp(),
  `temp_tanggal_terima` datetime NOT NULL DEFAULT current_timestamp(),
  `temp_jumlah` int(11) NOT NULL,
  `temp_totalharga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengaturan`
--

CREATE TABLE `tb_pengaturan` (
  `id_pengaturan` int(36) NOT NULL,
  `nama_apotek` varchar(255) NOT NULL,
  `alamat_apotek` text NOT NULL,
  `notifikasi_expired` varchar(255) NOT NULL,
  `stok_minimal` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pengaturan`
--

INSERT INTO `tb_pengaturan` (`id_pengaturan`, `nama_apotek`, `alamat_apotek`, `notifikasi_expired`, `stok_minimal`) VALUES
(1, 'Kadede Farma', 'purwokerto', '10', 30);

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
(15, 'PNJ-20200729014742', '2020-07-29', 0),
(16, 'PNJ-20200729014752', '2020-07-29', 0),
(17, 'PNJ-20200729014804', '2020-07-29', 67345),
(18, 'PNJ-20200729014837', '2020-07-29', 0),
(19, 'PNJ-20200729014841', '2020-07-29', 67345),
(20, 'PNJ-20200729015211', '2020-07-29', 0),
(21, 'PNJ-20200729015233', '2020-07-29', 0),
(22, 'PNJ-20200729015709', '2020-07-29', 0),
(23, 'PNJ-20200729020001', '2020-07-29', 0),
(24, 'PNJ-20200729020606', '2020-07-29', 0),
(25, 'PNJ-20200729020632', '2020-07-29', 0),
(26, 'PNJ-20200729022024', '2020-07-29', 0),
(27, 'PNJ-20200729022050', '2020-07-29', 0),
(28, 'PNJ-20200729022111', '2020-07-29', 0),
(29, 'PNJ-20200729025631', '2020-07-29', 0),
(30, 'PNJ-20200729025736', '2020-07-29', 0),
(31, 'PNJ-20200729025915', '2020-07-29', 0),
(32, 'PNJ-20200729030130', '2020-07-29', 0),
(33, 'PNJ-20200729030438', '2020-07-29', 0),
(34, 'PNJ-20200729030605', '2020-07-29', 0),
(35, 'PNJ-20200729041726', '2020-07-29', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penjualan_detail`
--

CREATE TABLE `tb_penjualan_detail` (
  `detail_id` int(11) NOT NULL,
  `detail_id_transaksi` int(11) NOT NULL,
  `detail_id_stok` int(36) NOT NULL DEFAULT 0,
  `detail_jumlah` int(11) NOT NULL,
  `detail_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Trigger `tb_penjualan_detail`
--
DELIMITER $$
CREATE TRIGGER `update_stok_jual` AFTER INSERT ON `tb_penjualan_detail` FOR EACH ROW BEGIN
UPDATE tb_pembelian_detail SET detail_jumlah = detail_jumlah - NEW.detail_jumlah,jml_update = NEW.detail_jumlah WHERE detail_id = NEW.detail_id_stok;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penjualan_temp`
--

CREATE TABLE `tb_penjualan_temp` (
  `temp_id` int(11) NOT NULL,
  `temp_id_stok` int(36) NOT NULL,
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
(1, 'Yahya dani Li', 'admin', '0192023a7bbd73250516f069df18b500', 'avatar6.jpg');

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
-- Indeks untuk tabel `tb_pengaturan`
--
ALTER TABLE `tb_pengaturan`
  ADD PRIMARY KEY (`id_pengaturan`);

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
  MODIFY `obat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  MODIFY `pembelian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `tb_pembelian_detail`
--
ALTER TABLE `tb_pembelian_detail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `tb_pembelian_temp`
--
ALTER TABLE `tb_pembelian_temp`
  MODIFY `temp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT untuk tabel `tb_pengaturan`
--
ALTER TABLE `tb_pengaturan`
  MODIFY `id_pengaturan` int(36) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  MODIFY `penjualan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `tb_penjualan_detail`
--
ALTER TABLE `tb_penjualan_detail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `tb_penjualan_temp`
--
ALTER TABLE `tb_penjualan_temp`
  MODIFY `temp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

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
