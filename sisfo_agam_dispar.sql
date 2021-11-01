-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Waktu pembuatan: 01 Nov 2021 pada 11.17
-- Versi server: 8.0.26
-- Versi PHP: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sisfo_agam_dispar`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akomodasi`
--

CREATE TABLE `akomodasi` (
  `id` int NOT NULL,
  `id_kategori_akomodasi` int NOT NULL,
  `nama_akomodasi` varchar(255) NOT NULL,
  `kelas` int NOT NULL,
  `tipe` varchar(255) DEFAULT NULL,
  `harga` int NOT NULL,
  `keterangan` text,
  `lat` varchar(255) NOT NULL,
  `long` varchar(255) NOT NULL,
  `slug_akomodasi` varchar(255) NOT NULL,
  `thumbnail_akomodasi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `akomodasi`
--

INSERT INTO `akomodasi` (`id`, `id_kategori_akomodasi`, `nama_akomodasi`, `kelas`, `tipe`, `harga`, `keterangan`, `lat`, `long`, `slug_akomodasi`, `thumbnail_akomodasi`, `created_at`, `updated_at`) VALUES
(1, 1, 'Hotel Pangeran Agam', 5, 'Single Room', 2000000, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla consequat molestie vehicula. Sed ligula odio, malesuada at feugiat at, eleifend sit amet nibh. Nam laoreet tincidunt condimentum. Quisque at velit non nibh pretium pharetra vel eu ante. Etiam ut euismod neque, quis imperdiet augue. Curabitur ante est, tristique ac felis scelerisque, lobortis posuere nisl. Aliquam erat volutpat.', '12345689', '789053739', 'hotel-pangeran-agam', 'hotel-1-thumbnail.jpg', '2021-10-31 11:36:27', '2021-10-31 11:36:27'),
(2, 2, 'Penginapan Agam', 0, '', 250000, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla consequat molestie vehicula. Sed ligula odio, malesuada at feugiat at, eleifend sit amet nibh. Nam laoreet tincidunt condimentum. Quisque at velit non nibh pretium pharetra vel eu ante. Etiam ut euismod neque, quis imperdiet augue. Curabitur ante est, tristique ac felis scelerisque, lobortis posuere nisl. Aliquam erat volutpat.', '12345689', '789053739', 'penginapan-agam', 'penginapan-1-thumbnail.jpg', '2021-10-31 12:30:27', '2021-10-31 12:30:27'),
(3, 1, 'Hotel Ibis Agam', 3, 'Double Room', 3000000, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla consequat molestie vehicula. Sed ligula odio, malesuada at feugiat at, eleifend sit amet nibh. Nam laoreet tincidunt condimentum. Quisque at velit non nibh pretium pharetra vel eu ante. Etiam ut euismod neque, quis imperdiet augue. Curabitur ante est, tristique ac felis scelerisque, lobortis posuere nisl. Aliquam erat volutpat.', '5555555555555', '3333333333333', 'hotel-ibis-agam', 'hotel-2-thumbnail.jpg', '2021-10-31 11:45:27', '2021-10-31 11:45:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `akomodasi_fasilitas_akomodasi`
--

CREATE TABLE `akomodasi_fasilitas_akomodasi` (
  `id` int NOT NULL,
  `id_akomodasi` int NOT NULL,
  `id_fasilitas_akomodasi` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `akomodasi_fasilitas_akomodasi`
--

INSERT INTO `akomodasi_fasilitas_akomodasi` (`id`, `id_akomodasi`, `id_fasilitas_akomodasi`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `fasilitas_akomodasi`
--

CREATE TABLE `fasilitas_akomodasi` (
  `id` int NOT NULL,
  `nama_fasilitas_akomodasi` varchar(255) NOT NULL,
  `icon_fasilitas_akomodasi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `fasilitas_akomodasi`
--

INSERT INTO `fasilitas_akomodasi` (`id`, `nama_fasilitas_akomodasi`, `icon_fasilitas_akomodasi`) VALUES
(1, 'Kamar Mandi', 'kamar-mandi-icon.jpg'),
(2, 'Wifi', 'wifi-icon.jpg'),
(3, 'Kolam Renang', 'kolam-renang.jpg'),
(4, 'Sarapan Gratis', 'sarapan.jpg'),
(5, 'Parkir', 'parkir.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_akomodasi`
--

CREATE TABLE `kategori_akomodasi` (
  `id` int NOT NULL,
  `nama_kategori_akomodasi` varchar(255) NOT NULL,
  `slug_kategori_akomodasi` varchar(255) NOT NULL,
  `icon_kategori_akomodasi` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data untuk tabel `kategori_akomodasi`
--

INSERT INTO `kategori_akomodasi` (`id`, `nama_kategori_akomodasi`, `slug_kategori_akomodasi`, `icon_kategori_akomodasi`) VALUES
(1, 'Hotel', 'hotel', 'hotel-icon.jpg'),
(2, 'Homestay', 'homestay', 'homestay-icon.jpg'),
(3, 'Villa', 'villa', 'villa-icon.jpg'),
(4, 'Wisma', 'wisma', 'wisma-icon.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akomodasi`
--
ALTER TABLE `akomodasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `akomodasi_fasilitas_akomodasi`
--
ALTER TABLE `akomodasi_fasilitas_akomodasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `fasilitas_akomodasi`
--
ALTER TABLE `fasilitas_akomodasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori_akomodasi`
--
ALTER TABLE `kategori_akomodasi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akomodasi`
--
ALTER TABLE `akomodasi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `akomodasi_fasilitas_akomodasi`
--
ALTER TABLE `akomodasi_fasilitas_akomodasi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `fasilitas_akomodasi`
--
ALTER TABLE `fasilitas_akomodasi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kategori_akomodasi`
--
ALTER TABLE `kategori_akomodasi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
