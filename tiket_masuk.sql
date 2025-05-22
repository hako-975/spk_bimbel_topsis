-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Bulan Mei 2025 pada 20.15
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tiket_masuk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna_tiket`
--

CREATE TABLE `pengguna_tiket` (
  `id_pengguna_tiket` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `posisi` varchar(100) NOT NULL,
  `divisi` varchar(100) NOT NULL,
  `qr_code_file` text NOT NULL,
  `token` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengguna_tiket`
--

INSERT INTO `pengguna_tiket` (`id_pengguna_tiket`, `nik`, `nama_lengkap`, `posisi`, `divisi`, `qr_code_file`, `token`, `created_at`) VALUES
(1, '3674072901021001', 'Andri Firman Saputra', 'Manager IT', 'IT', 'qr/3674072901021001.png', '58baf532a55075f3a78d0fbd77e649d70ada8908a157a736bb2d2a4e0784478b', '2025-05-23 00:25:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'admin', '$2y$10$wBiDB.NZfqPowQCPZTDqjOb3Yng.tLsXpX85FJ7cmiqWYphBhmqZm', 'Administrator');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pengguna_tiket`
--
ALTER TABLE `pengguna_tiket`
  ADD PRIMARY KEY (`id_pengguna_tiket`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pengguna_tiket`
--
ALTER TABLE `pengguna_tiket`
  MODIFY `id_pengguna_tiket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
