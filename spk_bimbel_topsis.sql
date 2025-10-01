-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Okt 2025 pada 21.52
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
-- Database: `spk_bimbel_topsis`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bimbel`
--

CREATE TABLE `bimbel` (
  `id_bimbel` int(11) NOT NULL,
  `nama_bimbel` varchar(100) NOT NULL,
  `alamat_bimbel` text NOT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bimbel`
--

INSERT INTO `bimbel` (`id_bimbel`, `nama_bimbel`, `alamat_bimbel`, `dibuat_pada`) VALUES
(1, 'Bimbel Cabaca Abidzar Calistung', 'https://maps.app.goo.gl/EVBUqmTGe2WNNYMN7', '2025-04-09 08:32:10'),
(2, 'Bimbel Lintang', 'https://maps.app.goo.gl/uTzp9kCZuyd7P9Mk7', '2025-04-09 08:39:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_topsis`
--

CREATE TABLE `hasil_topsis` (
  `id_hasil` int(11) NOT NULL,
  `id_orangtua` int(11) NOT NULL,
  `id_bimbel` int(11) NOT NULL,
  `preferensi_tertinggi` float NOT NULL,
  `dibuat_pada` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `hasil_topsis`
--

INSERT INTO `hasil_topsis` (`id_hasil`, `id_orangtua`, `id_bimbel`, `preferensi_tertinggi`, `dibuat_pada`) VALUES
(9, 5, 2, 0.748084, '2025-10-02 02:50:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(100) NOT NULL,
  `bobot` float NOT NULL,
  `atribut` enum('Benefit','Cost') NOT NULL,
  `dibuat_pada` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `bobot`, `atribut`, `dibuat_pada`) VALUES
(1, 'Fasilitas', 0.15, 'Benefit', '2025-04-09 15:24:32'),
(2, 'Biaya', 0.2, 'Cost', '2025-04-09 15:24:47'),
(3, 'Kualitas Pengajar', 0.25, 'Benefit', '2025-04-09 15:25:04'),
(4, 'Kapasitas Tempat', 0.1, 'Benefit', '2025-04-09 15:25:17'),
(5, 'Metode Pembelajaran', 0.3, 'Benefit', '2025-04-09 15:25:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log`
--

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `isi_log` text NOT NULL,
  `tgl_log` datetime NOT NULL DEFAULT current_timestamp(),
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `log`
--

INSERT INTO `log` (`id_log`, `isi_log`, `tgl_log`, `id_user`) VALUES
(1, 'User dewi berhasil logout!', '2025-04-09 15:16:08', 1),
(2, 'User dewi berhasil login!', '2025-04-09 15:16:15', 1),
(3, 'Kriteria Fasilitas berhasil ditambahkan!', '2025-04-09 15:24:32', 1),
(4, 'Kriteria Biaya berhasil ditambahkan!', '2025-04-09 15:24:47', 1),
(5, 'Kriteria Kualitas Pengajar berhasil ditambahkan!', '2025-04-09 15:25:04', 1),
(6, 'Kriteria Kapasitas Tempat berhasil ditambahkan!', '2025-04-09 15:25:17', 1),
(7, 'Kriteria Metode Pembelajaran berhasil ditambahkan!', '2025-04-09 15:25:27', 1),
(8, 'Kriteria asd berhasil ditambahkan!', '2025-04-09 15:26:48', 1),
(9, 'Kriteria asd123 berhasil diubah!', '2025-04-09 15:26:54', 1),
(10, 'Jurusan asd123 berhasil dihapus!', '2025-04-09 15:26:57', 1),
(11, 'Bimbel Cabaca Pamulang berhasil ditambahkan!', '2025-04-09 15:32:10', 1),
(12, 'Bimbel Bimbel Cabaca Abidzar Calistung berhasil diubah!', '2025-04-09 15:34:56', 1),
(13, 'Bimbel Ganesha Operation Tangerang City berhasil ditambahkan!', '2025-04-09 15:39:34', 1),
(14, 'Bimbel asd berhasil ditambahkan!', '2025-04-09 15:40:41', 1),
(15, 'Jurusan  gagal dihapus!', '2025-04-09 15:42:44', 1),
(16, 'Bimbel asd berhasil dihapus!', '2025-04-09 15:43:03', 1),
(17, 'Bimbel asd berhasil diubah!', '2025-04-09 15:43:15', 1),
(18, 'Bimbel Ganesha Operation Tangerang City berhasil diubah!', '2025-04-09 15:43:24', 1),
(19, 'Orang Tua andri berhasil ditambahkan!', '2025-04-09 15:51:30', 1),
(20, 'Orang Tua andri123 gagal diubah!', '2025-04-09 15:53:59', 1),
(21, 'Orang Tua andri123 berhasil diubah!', '2025-04-09 15:54:27', 1),
(22, 'Orang Tua andri123 berhasil dihapus!', '2025-04-09 15:55:13', 1),
(23, 'Orang Tua Contoh Orang Tua 1 berhasil ditambahkan!', '2025-04-09 15:55:40', 1),
(24, 'User andri berhasil ditambahkan!', '2025-04-09 15:56:11', 1),
(25, 'User andri berhasil diubah!', '2025-04-09 15:56:16', 1),
(26, 'User andri berhasil diubah!', '2025-04-09 15:56:22', 1),
(27, 'User andri berhasil diubah!', '2025-04-09 15:57:02', 1),
(28, 'User andri berhasil diubah!', '2025-04-09 15:57:06', 1),
(29, 'User andri berhasil diubah!', '2025-04-09 15:57:10', 1),
(30, 'User dewi berhasil logout!', '2025-04-09 15:57:16', 1),
(31, 'User andri berhasil login!', '2025-04-09 15:57:20', 2),
(32, 'User andri berhasil logout!', '2025-04-09 15:57:23', 2),
(33, 'User dewi berhasil login!', '2025-04-09 15:57:26', 1),
(34, 'User andri berhasil dihapus!', '2025-04-09 15:57:31', 1),
(35, 'User dewi berhasil diubah!', '2025-04-09 15:57:59', 1),
(36, 'Bimbel Contoh Orang Tua 1 gagal dihitung!', '2025-04-09 16:01:02', 1),
(37, 'SPK Tempat Bimbel Contoh Orang Tua 1 Berhasil ditambahkan!', '2025-04-09 16:02:24', 1),
(38, 'SPK Tempat Bimbel Contoh Orang Tua 1 Berhasil diubah!', '2025-04-09 16:06:19', 1),
(39, 'SPK Tempat Bimbel Contoh Orang Tua 1 Berhasil diubah!', '2025-04-09 16:06:36', 1),
(40, 'Hasil Bimbel Contoh Orang Tua 1 berhasil dihapus!', '2025-04-09 16:06:55', 1),
(41, 'SPK Tempat Bimbel Contoh Orang Tua 1 Berhasil ditambahkan!', '2025-04-09 16:07:26', 1),
(42, 'User andri berhasil ditambahkan!', '2025-04-11 16:52:11', 3),
(43, 'User andri berhasil login!', '2025-04-11 16:52:15', 3),
(44, 'User andri berhasil logout!', '2025-04-11 16:57:52', 3),
(45, 'User andri berhasil login!', '2025-04-11 16:57:55', 3),
(46, 'Orangtua andri berhasil ditambahkan!', '2025-04-11 17:03:45', 3),
(47, 'SPK Tempat Bimbel  Berhasil ditambahkan!', '2025-04-11 17:05:58', 3),
(48, 'SPK Tempat Bimbel  Berhasil ditambahkan!', '2025-04-11 17:06:46', 3),
(49, 'SPK Tempat Bimbel andri Berhasil ditambahkan!', '2025-04-11 17:07:09', 3),
(50, 'User andri berhasil logout!', '2025-04-11 17:09:19', 3),
(51, 'User andri berhasil login!', '2025-04-11 17:09:24', 3),
(52, 'User andri berhasil ditambahkan!', '2025-04-11 17:10:08', 2),
(53, 'User andri berhasil login!', '2025-04-11 17:10:19', 2),
(54, 'Orangtua Andri Firman Saputra berhasil ditambahkan!', '2025-04-11 17:11:57', 2),
(55, 'User andri berhasil logout!', '2025-04-11 17:12:52', 2),
(56, 'User dewi berhasil login!', '2025-04-11 17:12:55', 1),
(57, 'Hasil Bimbel  berhasil dihapus!', '2025-04-11 17:13:00', 1),
(58, 'Hasil Bimbel  berhasil dihapus!', '2025-04-11 17:13:02', 1),
(59, 'Hasil Bimbel  berhasil dihapus!', '2025-04-11 17:13:04', 1),
(60, 'Hasil Bimbel  berhasil dihapus!', '2025-04-11 17:13:05', 1),
(61, 'Hasil Bimbel  berhasil dihapus!', '2025-04-11 17:13:06', 1),
(62, 'SPK Tempat Bimbel Andri Firman Saputra Berhasil ditambahkan!', '2025-04-11 17:13:16', 1),
(63, 'Hasil Bimbel  berhasil dihapus!', '2025-04-11 17:13:31', 1),
(64, 'Hasil Bimbel  berhasil dihapus!', '2025-04-11 17:14:21', 1),
(65, 'SPK Tempat Bimbel Andri Firman Saputra Berhasil ditambahkan!', '2025-04-11 17:14:30', 1),
(66, 'Hasil Bimbel Andri Firman Saputra berhasil dihapus!', '2025-04-11 17:14:37', 1),
(67, 'User andre berhasil ditambahkan!', '2025-04-11 17:15:07', 1),
(68, 'User andre berhasil diubah!', '2025-04-11 17:15:12', 1),
(69, 'User andre berhasil dihapus!', '2025-04-11 17:15:14', 1),
(70, 'User asd berhasil ditambahkan!', '2025-04-11 17:15:24', 1),
(71, 'Orangtua Dewi Putri Aulia berhasil ditambahkan!', '2025-04-11 17:15:32', 1),
(72, 'Orangtua Dewi Putri Aulia berhasil diubah!', '2025-04-11 17:15:36', 1),
(73, 'Orang Tua asd berhasil dihapus!', '2025-04-11 17:15:39', 1),
(74, 'User asd berhasil dihapus!', '2025-04-11 17:15:44', 1),
(75, 'SPK Tempat Bimbel Andri Firman Saputra Berhasil ditambahkan!', '2025-04-11 17:15:54', 1),
(76, 'User dewi berhasil logout!', '2025-04-11 17:16:03', 1),
(77, 'User andri berhasil login!', '2025-04-11 17:16:06', 2),
(78, 'User dewi berhasil login!', '2025-04-11 17:17:19', 1),
(79, 'User asd berhasil ditambahkan!', '2025-04-11 17:17:28', 1),
(80, 'Orangtua Dewi Putri Aulia berhasil ditambahkan!', '2025-04-11 17:17:32', 1),
(81, 'Orangtua Dewi Putri Aulia berhasil ditambahkan!', '2025-04-11 17:17:32', 1),
(82, 'SPK Tempat Bimbel Andri Firman Saputra Berhasil diubah!', '2025-04-11 17:17:37', 2),
(83, 'User andri berhasil logout!', '2025-04-11 17:17:47', 2),
(84, 'User dewi berhasil login!', '2025-04-11 17:17:53', 1),
(85, 'User asd berhasil dihapus!', '2025-04-11 17:17:56', 1),
(86, 'User dewi berhasil login!', '2025-09-24 03:35:48', 1),
(87, 'User dewi berhasil logout!', '2025-09-24 03:37:35', 1),
(88, 'User dewi berhasil login!', '2025-09-24 03:44:43', 1),
(89, 'User dewi berhasil logout!', '2025-09-24 03:44:48', 1),
(90, 'User dewi berhasil login!', '2025-09-24 03:45:12', 1),
(91, 'User dewi berhasil logout!', '2025-09-24 03:46:18', 1),
(92, 'User dewi berhasil login!', '2025-10-01 17:23:28', 1),
(93, 'User dewi berhasil logout!', '2025-10-01 17:33:11', 1),
(94, 'User andri berhasil login!', '2025-10-01 17:33:13', 2),
(95, 'User dewi berhasil login!', '2025-10-01 23:47:12', 1),
(96, 'User dewi berhasil logout!', '2025-10-02 02:15:34', 1),
(97, 'User dewi berhasil login!', '2025-10-02 02:16:57', 1),
(98, 'User dewi berhasil logout!', '2025-10-02 02:17:22', 1),
(99, 'User dewi berhasil login!', '2025-10-02 02:23:45', 1),
(100, 'User dewi berhasil logout!', '2025-10-02 02:24:22', 1),
(101, 'User dewi berhasil login!', '2025-10-02 02:27:21', 1),
(102, 'User dewi berhasil logout!', '2025-10-02 02:28:58', 1),
(103, 'User dewi berhasil login!', '2025-10-02 02:41:22', 1),
(104, 'User dewi berhasil login!', '2025-10-02 02:42:55', 1),
(105, 'Hasil Bimbel Andri Firman Saputra berhasil dihapus!', '2025-10-02 02:42:59', 1),
(106, 'Orang Tua Andri Firman Saputra berhasil dihapus!', '2025-10-02 02:43:04', 1),
(107, 'User andri berhasil dihapus!', '2025-10-02 02:43:07', 1),
(108, 'User dewi berhasil logout!', '2025-10-02 02:43:11', 1),
(109, 'User andri berhasil ditambahkan!', '2025-10-02 02:43:32', 6),
(110, 'User andri berhasil login!', '2025-10-02 02:44:18', 6),
(111, 'Orangtua Andri Firman Saputra berhasil ditambahkan!', '2025-10-02 02:44:39', 6),
(112, 'SPK Tempat Bimbel Andri Firman Saputra Berhasil ditambahkan!', '2025-10-02 02:50:29', 6),
(113, 'User andri berhasil logout!', '2025-10-02 02:52:26', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orangtua`
--

CREATE TABLE `orangtua` (
  `id_orangtua` int(11) NOT NULL,
  `no_hp_orangtua` varchar(20) NOT NULL,
  `alamat_orangtua` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `dibuat_pada` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `orangtua`
--

INSERT INTO `orangtua` (`id_orangtua`, `no_hp_orangtua`, `alamat_orangtua`, `id_user`, `dibuat_pada`) VALUES
(3, '123', 'asd', 5, '2025-04-11 17:17:32'),
(4, '123', 'asd', 5, '2025-04-11 17:17:32'),
(5, '087808675313', 'Jl. AMD Babakan Pocis No. 88 RT04/RW02, Bakti Jaya, Setu, Tangerang Selatan, Banten, Indonesia, 15315', 6, '2025-10-02 02:44:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_bimbel` int(11) NOT NULL,
  `nilai` float NOT NULL,
  `id_hasil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `id_kriteria`, `id_bimbel`, `nilai`, `id_hasil`) VALUES
(111, 2, 1, 4, 9),
(112, 1, 1, 2, 9),
(113, 4, 1, 2, 9),
(114, 3, 1, 3, 9),
(115, 5, 1, 3, 9),
(116, 2, 2, 5, 9),
(117, 1, 2, 3, 9),
(118, 4, 2, 3, 9),
(119, 3, 2, 4, 9),
(120, 5, 2, 4, 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jabatan` enum('admin','orangtua') NOT NULL,
  `nama` varchar(100) NOT NULL,
  `foto` text NOT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `jabatan`, `nama`, `foto`, `dibuat_pada`) VALUES
(1, 'dewi', '$2y$10$Gw0mG1lz..2tmUDVc0tZ6ueU.jomzE8FX22C1.PDVdohQcePD4J4y', 'admin', 'Dewi Putri Aulia', 'default.jpg', '2025-03-17 15:22:49'),
(6, 'andri', '$2y$10$2EPxOCkPIVUAlF66F4IfiuaYhmSfjnWDI6oPlWk9GTtDTAWpIGGIK', 'orangtua', 'Andri Firman Saputra', 'default.jpg', '2025-10-01 19:43:32');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bimbel`
--
ALTER TABLE `bimbel`
  ADD PRIMARY KEY (`id_bimbel`);

--
-- Indeks untuk tabel `hasil_topsis`
--
ALTER TABLE `hasil_topsis`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `id_orangtua` (`id_orangtua`),
  ADD KEY `id_bimbel` (`id_bimbel`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `orangtua`
--
ALTER TABLE `orangtua`
  ADD PRIMARY KEY (`id_orangtua`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`),
  ADD KEY `id_kriteria` (`id_kriteria`),
  ADD KEY `id_hasil` (`id_hasil`),
  ADD KEY `id_bimbel` (`id_bimbel`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bimbel`
--
ALTER TABLE `bimbel`
  MODIFY `id_bimbel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `hasil_topsis`
--
ALTER TABLE `hasil_topsis`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT untuk tabel `orangtua`
--
ALTER TABLE `orangtua`
  MODIFY `id_orangtua` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
