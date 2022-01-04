-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Nov 2021 pada 13.11
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kelasku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absen`
--

CREATE TABLE `absen` (
  `id` int(11) NOT NULL,
  `kode_absen` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `dibuat` datetime NOT NULL,
  `batas_absen` datetime NOT NULL,
  `kode_kelas` varchar(255) NOT NULL,
  `kunci_rahasia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `aktivitas_user`
--

CREATE TABLE `aktivitas_user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_baru` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `status` enum('aktivasi','ubah password','ubah email','ubah username','blokir') NOT NULL,
  `tanggal_aktivitas` varchar(255) NOT NULL,
  `kode_aktivitas` varchar(255) NOT NULL,
  `kunci_rahasia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota_absen`
--

CREATE TABLE `anggota_absen` (
  `id` int(11) NOT NULL,
  `status` enum('hadir','izin') NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `tanggal_absen` varchar(255) NOT NULL,
  `kode_absen` varchar(255) NOT NULL,
  `kode_kelas` varchar(255) NOT NULL,
  `kunci_rahasia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota_kelas`
--

CREATE TABLE `anggota_kelas` (
  `id` int(11) NOT NULL,
  `tanggal_gabung` varchar(255) NOT NULL,
  `kode_kelas` varchar(255) NOT NULL,
  `role` enum('ketua kelas','anggota') NOT NULL,
  `status` enum('blokir','proses','aktif') NOT NULL,
  `kunci_rahasia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota_tugas`
--

CREATE TABLE `anggota_tugas` (
  `id` int(11) NOT NULL,
  `tanggal_mengumpulkan` varchar(255) NOT NULL,
  `kode_tugas` varchar(255) NOT NULL,
  `kode_kelas` varchar(255) NOT NULL,
  `kunci_rahasia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `avatar`
--

CREATE TABLE `avatar` (
  `id` int(11) NOT NULL,
  `kode_avatar` varchar(255) NOT NULL,
  `nama_avatar` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `avatar`
--

INSERT INTO `avatar` (`id`, `kode_avatar`, `nama_avatar`, `url`) VALUES
(1, 'KAV16365409614318', 'avatar male', 'default_male.png'),
(2, 'KAV16365409759218', 'avatar female', 'default_female.png'),
(3, 'KAV16366689842827', 'iron man', '117-ironman.png'),
(4, 'KAV16366717786174', 'gym guy', '101-gym-guy.png'),
(5, 'KAV16367999112752', 'freelancer', '105-freelancer.png'),
(6, 'KAV16367999254065', 'italy', '106-italy.png'),
(7, 'KAV16367999397981', 'sega', '110-sega-megdrive.png'),
(8, 'KAV16367999613751', 'owl', 'day22-owl.png'),
(9, 'KAV16367999845152', 'frankenstein', 'day32-frankenstein.png'),
(10, 'KAV16368000868979', 'whale', 'day51-whale.png'),
(11, 'KAV16368001063928', 'angler fish', 'day49-angler-fish.png'),
(12, 'KAV16368001301476', 'pumpkin', 'day33-pumpkin.png'),
(13, 'KAV16368001577922', 'my robot', 'day27-my-robot.png'),
(14, 'KAV16368001789920', 'rocket', 'day20-rocket.png'),
(15, 'KAV16368011436351', 'programming', 'day93-programing.png'),
(16, 'KAV16368011612513', 'burger', 'day82-burger.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `id` int(11) NOT NULL,
  `kode_guru` varchar(255) NOT NULL,
  `nama_guru` varchar(255) NOT NULL,
  `mata_pelajaran` varchar(255) NOT NULL,
  `dibuat` varchar(255) NOT NULL,
  `kode_kelas` varchar(255) NOT NULL,
  `kunci_rahasia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id` int(11) NOT NULL,
  `kode_jadwal` varchar(255) NOT NULL,
  `kode_guru` varchar(255) NOT NULL,
  `hari` varchar(255) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `kode_kelas` varchar(255) NOT NULL,
  `kunci_rahasia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `kode_kelas` varchar(255) NOT NULL,
  `nama_kelas` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `kode_tema` varchar(255) NOT NULL,
  `tanggal_buat` varchar(255) NOT NULL,
  `pembuat_kelas` varchar(255) NOT NULL,
  `kunci_rahasia` varchar(255) NOT NULL,
  `aktif` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_user`
--

CREATE TABLE `kelas_user` (
  `id` int(11) NOT NULL,
  `kelas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelas_user`
--

INSERT INTO `kelas_user` (`id`, `kelas`) VALUES
(1, '1'),
(2, '2'),
(3, '3'),
(4, '4'),
(5, '5'),
(6, '6'),
(7, '7'),
(8, '8'),
(9, '9'),
(10, '10'),
(11, '11'),
(12, '12'),
(13, 'Universitas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan`
--

CREATE TABLE `laporan` (
  `id` int(11) NOT NULL,
  `kode_laporan` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pesan` varchar(255) NOT NULL,
  `lihat` enum('0','1') NOT NULL,
  `tanggal_pesan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tema`
--

CREATE TABLE `tema` (
  `id` int(11) NOT NULL,
  `kode_tema` varchar(255) NOT NULL,
  `nama_tema` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tema`
--

INSERT INTO `tema` (`id`, `kode_tema`, `nama_tema`, `url`) VALUES
(1, 'KTM16365920859103', 'tema 1', 'tema1.png'),
(2, 'KTM16366726688624', 'tema 2', 'tema2.png'),
(3, 'KTM16367209399216', 'Tema 3', 'tema3.png'),
(4, 'KTM16367209585441', 'Tema 4', 'tema4.png'),
(5, 'KTM16367975367666', 'Tema 5', 'tema5.png'),
(6, 'KTM16367975501396', 'Tema 6', 'tema6.png'),
(7, 'KTM16367975662551', 'Tema 7', 'tema7.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tugas`
--

CREATE TABLE `tugas` (
  `id` int(11) NOT NULL,
  `kode_tugas` varchar(255) NOT NULL,
  `nama_tugas` varchar(255) NOT NULL,
  `kode_guru` varchar(255) NOT NULL,
  `deskripsi_tugas` varchar(255) NOT NULL,
  `tanggal_buat` varchar(255) NOT NULL,
  `batas_pengumpulan` datetime NOT NULL,
  `link_pengumpulan` varchar(255) NOT NULL,
  `kode_kelas` varchar(255) NOT NULL,
  `kunci_rahasia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Pria','Wanita') NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `bio` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `aktif` enum('0','1') NOT NULL,
  `salah_password` int(2) NOT NULL,
  `blokir` enum('0','1') NOT NULL,
  `tanggal_buat` varchar(255) NOT NULL,
  `aktivitas_login` varchar(255) NOT NULL,
  `aktivitas_email` varchar(255) NOT NULL,
  `online` enum('0','1') NOT NULL,
  `kunci_rahasia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_absen` (`kode_absen`);

--
-- Indeks untuk tabel `aktivitas_user`
--
ALTER TABLE `aktivitas_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`);

--
-- Indeks untuk tabel `anggota_absen`
--
ALTER TABLE `anggota_absen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `anggota_kelas`
--
ALTER TABLE `anggota_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `anggota_tugas`
--
ALTER TABLE `anggota_tugas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `avatar`
--
ALTER TABLE `avatar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_avatar` (`kode_avatar`);

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_guru` (`kode_guru`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_jadwal` (`kode_jadwal`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_kelas` (`kode_kelas`);

--
-- Indeks untuk tabel `kelas_user`
--
ALTER TABLE `kelas_user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_laporan` (`kode_laporan`);

--
-- Indeks untuk tabel `tema`
--
ALTER TABLE `tema`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_tema` (`kode_tema`);

--
-- Indeks untuk tabel `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_tugas` (`kode_tugas`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kunci_rahasia` (`kunci_rahasia`),
  ADD UNIQUE KEY `username` (`username`,`email`,`telepon`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absen`
--
ALTER TABLE `absen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `aktivitas_user`
--
ALTER TABLE `aktivitas_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `anggota_absen`
--
ALTER TABLE `anggota_absen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `anggota_kelas`
--
ALTER TABLE `anggota_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `anggota_tugas`
--
ALTER TABLE `anggota_tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `avatar`
--
ALTER TABLE `avatar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kelas_user`
--
ALTER TABLE `kelas_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tema`
--
ALTER TABLE `tema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
