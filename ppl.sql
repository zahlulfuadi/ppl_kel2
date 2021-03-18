-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Mar 2021 pada 16.38
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ppl`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(16) UNSIGNED NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `satuan_barang` varchar(10) NOT NULL,
  `harga_pokok` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `tanggal_input` date NOT NULL,
  `tanggal_update` date NOT NULL,
  `id_kategori` int(16) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku_kas`
--

CREATE TABLE `buku_kas` (
  `id_buku_kas` int(16) UNSIGNED NOT NULL,
  `id_user` int(16) UNSIGNED NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `pemasukan` int(11) NOT NULL,
  `pengeluaran` int(11) NOT NULL,
  `saldo` int(11) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pemasukan`
--

CREATE TABLE `detail_pemasukan` (
  `id_detail_pemasukan` int(16) UNSIGNED NOT NULL,
  `id_barang` int(16) UNSIGNED NOT NULL,
  `satuan_barang` varchar(10) NOT NULL,
  `harga_pokok` int(11) UNSIGNED NOT NULL,
  `harga_jual` int(11) UNSIGNED NOT NULL,
  `jml_pemasukan` int(11) NOT NULL,
  `diskon` int(11) DEFAULT NULL,
  `total_pemasukan` int(11) NOT NULL,
  `id_pemasukan` int(16) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pengeluaran`
--

CREATE TABLE `detail_pengeluaran` (
  `id_detail_pengeluaran` int(16) UNSIGNED NOT NULL,
  `id_barang` int(16) UNSIGNED NOT NULL,
  `harga` int(11) NOT NULL,
  `jml_pengeluaran` int(11) NOT NULL,
  `total_pengeluaran` int(11) NOT NULL,
  `id_pengeluaran` int(16) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(16) UNSIGNED NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemasukan`
--

CREATE TABLE `pemasukan` (
  `id_pemasukan` int(16) UNSIGNED NOT NULL,
  `tanggal_pemasukan` date NOT NULL,
  `nominal` int(11) NOT NULL,
  `ket_pemasukan` varchar(255) DEFAULT NULL,
  `id_user` int(16) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(16) UNSIGNED NOT NULL,
  `tanggal_pengeluaran` date NOT NULL,
  `id_user` int(16) UNSIGNED NOT NULL,
  `id_supplier` int(16) UNSIGNED NOT NULL,
  `ket_pengeluaran` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(16) UNSIGNED NOT NULL,
  `nama_supplier` varchar(50) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(16) UNSIGNED NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto_profil` varchar(255) DEFAULT 'avatar',
  `level` int(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `buku_kas`
--
ALTER TABLE `buku_kas`
  ADD PRIMARY KEY (`id_buku_kas`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `detail_pemasukan`
--
ALTER TABLE `detail_pemasukan`
  ADD PRIMARY KEY (`id_detail_pemasukan`),
  ADD KEY `id_pemasukan` (`id_pemasukan`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `detail_pengeluaran`
--
ALTER TABLE `detail_pengeluaran`
  ADD PRIMARY KEY (`id_detail_pengeluaran`),
  ADD KEY `id_pengeluaran` (`id_pengeluaran`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD PRIMARY KEY (`id_pemasukan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(16) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `buku_kas`
--
ALTER TABLE `buku_kas`
  MODIFY `id_buku_kas` int(16) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_pemasukan`
--
ALTER TABLE `detail_pemasukan`
  MODIFY `id_detail_pemasukan` int(16) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_pengeluaran`
--
ALTER TABLE `detail_pengeluaran`
  MODIFY `id_detail_pengeluaran` int(16) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(16) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pemasukan`
--
ALTER TABLE `pemasukan`
  MODIFY `id_pemasukan` int(16) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(16) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(16) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(16) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);

--
-- Ketidakleluasaan untuk tabel `buku_kas`
--
ALTER TABLE `buku_kas`
  ADD CONSTRAINT `buku_kas_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `detail_pemasukan`
--
ALTER TABLE `detail_pemasukan`
  ADD CONSTRAINT `detail_pemasukan_ibfk_1` FOREIGN KEY (`id_pemasukan`) REFERENCES `pemasukan` (`id_pemasukan`),
  ADD CONSTRAINT `detail_pemasukan_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

--
-- Ketidakleluasaan untuk tabel `detail_pengeluaran`
--
ALTER TABLE `detail_pengeluaran`
  ADD CONSTRAINT `detail_pengeluaran_ibfk_1` FOREIGN KEY (`id_pengeluaran`) REFERENCES `pengeluaran` (`id_pengeluaran`),
  ADD CONSTRAINT `detail_pengeluaran_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

--
-- Ketidakleluasaan untuk tabel `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD CONSTRAINT `pemasukan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD CONSTRAINT `pengeluaran_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `pengeluaran_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
