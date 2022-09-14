-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Sep 2020 pada 03.20
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
-- Database: `db_mymikrotik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_client`
--

CREATE TABLE `t_client` (
  `id_client` int(11) NOT NULL,
  `nama` varchar(77) NOT NULL,
  `tgl_pasang` date NOT NULL,
  `id_jenis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_jenis`
--

CREATE TABLE `t_jenis` (
  `id_jenis` int(11) NOT NULL,
  `jenis` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_jenis`
--

INSERT INTO `t_jenis` (`id_jenis`, `jenis`) VALUES
(1, 'Kabel FO'),
(2, 'Kabel LAN'),
(3, 'PTP (Point To Point)'),
(4, 'PTMP (Point To Multi Point)');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_payment`
--

CREATE TABLE `t_payment` (
  `id_payment` int(11) NOT NULL,
  `id_client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_client`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_client` (
`id_client` int(11)
,`nama` varchar(77)
,`tgl_pasang` date
,`id_jenis` int(11)
,`jenis` varchar(55)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `view_client`
--
DROP TABLE IF EXISTS `view_client`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_client`  AS  select `t_client`.`id_client` AS `id_client`,`t_client`.`nama` AS `nama`,`t_client`.`tgl_pasang` AS `tgl_pasang`,`t_client`.`id_jenis` AS `id_jenis`,`t_jenis`.`jenis` AS `jenis` from (`t_client` join `t_jenis`) where `t_client`.`id_jenis` = `t_jenis`.`id_jenis` ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `t_client`
--
ALTER TABLE `t_client`
  ADD PRIMARY KEY (`id_client`);

--
-- Indeks untuk tabel `t_jenis`
--
ALTER TABLE `t_jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `t_payment`
--
ALTER TABLE `t_payment`
  ADD PRIMARY KEY (`id_payment`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `t_client`
--
ALTER TABLE `t_client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `t_jenis`
--
ALTER TABLE `t_jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `t_payment`
--
ALTER TABLE `t_payment`
  MODIFY `id_payment` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
