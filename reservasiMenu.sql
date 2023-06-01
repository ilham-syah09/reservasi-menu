-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Apr 2023 pada 15.20
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reservasimenu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `gambar`
--

CREATE TABLE `gambar` (
  `id` int(11) NOT NULL,
  `idMenu` int(11) NOT NULL,
  `gambar` text NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `gambar`
--

INSERT INTO `gambar` (`id`, `idMenu`, `gambar`, `createdAt`, `updatedAt`) VALUES
(1, 5, '9111a378c6e417cc409f5500e7b90a56.jpeg', '2023-03-26 14:07:20', '2023-03-26 14:07:49'),
(2, 5, '0711a47bec01597af64333f749f20508.jpeg', '2023-03-26 14:31:12', NULL),
(3, 6, '3bf839aef6e1551ebb77ec8cdbadc63c.jpeg', '2023-03-26 14:32:46', NULL),
(4, 6, '297f9d74706b757ddb346ddb424b4b38.jpeg', '2023-03-26 14:33:39', NULL),
(6, 7, 'cadf0ee612c95814d625c1f678c8e1b8.jpeg', '2023-03-26 14:35:15', NULL),
(7, 7, 'ec2cf44fc60941b3df5736ea2d0948f3.jpeg', '2023-03-26 14:35:42', NULL),
(8, 8, 'ecdc8dd6e697dc34d0b454a90b6f3e21.jpeg', '2023-03-26 14:37:17', NULL),
(9, 8, 'fcebadcd607d1004527df65094ce5834.jpeg', '2023-03-26 14:38:43', NULL),
(10, 9, 'd72d48358b0b900f48b9bd33c1ebc636.jpeg', '2023-03-26 14:39:07', NULL),
(11, 10, '6bcc3d2a910a5540f6f5a44b78c2660d.jpeg', '2023-03-26 14:39:23', '2023-03-28 02:35:35'),
(12, 9, '4933d7465afd10f9f06d45eab583de4e.jpeg', '2023-03-26 14:41:24', NULL),
(13, 9, 'c0ff2d0bdc1069f9528f623579a832d5.jpeg', '2023-03-26 14:41:40', NULL),
(14, 10, 'a019c4e1eba45ba50f92ab0f0001b21d.jpeg', '2023-03-26 14:42:03', '2023-03-28 02:35:38'),
(15, 11, 'af6214ff42b2bab57c1ff7390d146a91.jpeg', '2023-03-28 07:57:43', NULL),
(16, 11, '7e395bade6df9f3ebd3e2f8d33ee084d.jpeg', '2023-03-28 07:57:59', NULL),
(17, 12, 'd21b20fd719ceed30bab2f65c42076b5.jpeg', '2023-03-28 07:59:35', NULL),
(18, 12, '66320fb36d466a8cde5fcc21c8e8b8bb.jpeg', '2023-03-28 07:59:46', NULL),
(19, 12, '6a7597c7592071fdc5b9dd42fe0f5c8a.jpeg', '2023-03-28 08:00:04', NULL),
(20, 13, '3b10b3363829c6defc323aed7b8cc313.jpeg', '2023-03-28 08:01:09', NULL),
(21, 13, 'd5ea094c9e79567b668538094a26fe4d.jpeg', '2023-03-28 08:01:45', NULL),
(24, 15, '20fe4a3d74350188031a328e9d66c8a1.jpeg', '2023-03-28 08:48:40', NULL),
(25, 15, '487c4f11ad5a8c34db95cacb9426984c.jpeg', '2023-03-28 08:49:11', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `gambar` text DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `kategori`, `gambar`, `createdAt`, `updatedAt`) VALUES
(2, 'Dessert', '8cc37edccc4833fbef3b974fd47cd2a1.jpeg', '2023-03-20 08:33:38', '2023-03-29 03:21:17'),
(4, 'Snack', '975e7ce5b88c00577a02e08ce8693882.jpeg', '2023-03-20 08:33:38', '2023-03-26 13:32:11'),
(5, 'Makanan Berat', '47d62b923cf6d6aa32d6dabe34e4c74b.jpeg', '2023-03-20 08:52:45', '2023-03-26 13:33:24'),
(6, 'Minuman', '27ed08ceece02af81462610184d847fa.jpeg', '2023-03-21 13:42:29', '2023-03-26 13:33:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idMenu` int(11) NOT NULL,
  `total` int(3) NOT NULL DEFAULT 1,
  `status` int(1) NOT NULL DEFAULT 0,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `keranjang`
--

INSERT INTO `keranjang` (`id`, `idUser`, `idMenu`, `total`, `status`, `createdAt`, `updatedAt`) VALUES
(1, 6, 8, 2, 1, '2023-03-21 13:49:41', '2023-03-29 03:49:19'),
(2, 6, 9, 2, 1, '2023-03-21 13:50:07', '2023-03-29 03:49:22'),
(3, 5, 8, 3, 1, '2023-03-24 03:00:24', '2023-03-24 05:41:31'),
(4, 5, 9, 4, 1, '2023-03-24 03:00:28', '2023-03-24 05:41:34'),
(5, 5, 6, 1, 1, '2023-03-24 03:00:24', '2023-03-24 05:41:31'),
(6, 5, 10, 1, 1, '2023-03-24 03:00:28', '2023-03-24 05:41:34'),
(8, 3, 8, 2, 1, '2023-03-29 05:31:07', '2023-03-30 03:05:35'),
(12, 3, 10, 4, 1, '2023-03-29 05:44:02', '2023-03-30 03:05:35'),
(14, 3, 8, 1, 0, '2023-03-31 02:08:41', '2023-03-31 03:09:26'),
(15, 3, 13, 2, 0, '2023-03-31 02:14:05', '2023-03-31 03:09:32'),
(16, 7, 6, 1, 1, '2023-04-10 13:10:11', '2023-04-10 13:10:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(7) NOT NULL DEFAULT 0,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id`, `kategori_id`, `nama_menu`, `deskripsi`, `harga`, `stok`, `createdAt`, `updatedAt`) VALUES
(5, 5, 'Bento box Hoka', 'Bento (弁当 bentō)[1] atau o-bentō adalah istilah bahasa Jepang untuk makanan bekal berupa nasi berikut lauk-pauk dalam kemasan praktis yang bisa dibawa-bawa dan dimakan di tempat lain. Seperti halnya nasi bungkus, bentō bisa dimakan sebagai makan siang, makan malam, atau bekal piknik.', 42000, 25, '2023-03-20 08:34:30', '2023-03-29 02:02:11'),
(6, 2, 'Pancake Manis', 'Salah satu makanan yang sangat lembut saat digigit pertama kali. Panekuk atau lebih sering dikenal sebagai pancake merupakan makanan yang terbuat daru beberapa bahan terigu, telur, gula, serta susu.', 19000, 35, '2023-03-20 08:34:30', '2023-03-29 02:02:03'),
(7, 2, 'Lemper', 'Makanan tradisional khas Masyarakat Jawa yang terbuat dari beras ketan, biasanya berisi abon atau cincangan daging ayam dan dibungkus dengan daun pisang.', 1000, 135, '2023-03-20 08:34:30', '2023-03-29 03:21:50'),
(8, 5, 'Nasi Goreng', 'Sajian nasi yang digoreng dalam sebuah wajan atau penggorengan yang menghasilkan cita rasa berbeda karena dicampur dengan bumbu-bumbu seperti garam, bawang putih, bawang merah, merica, rempah-rempah tertentu dan kecap manis. Selain itu, ditambahkan bahan-bahan pelengkap seperti telur, sayur-sayuran, makanan laut, atau daging.', 26000, 40, '2023-03-20 08:57:03', '2023-03-29 02:01:55'),
(9, 6, 'Teh Manis', 'Minuman yang terbuat dari larutan teh yang biasanya diberi gula tebu atau pemanis, sebelum minuman ini siap disajikan.', 5000, 100, '2023-03-21 13:47:29', '2023-04-10 16:15:27'),
(10, 6, 'Ice Cream', 'Sebuah makanan beku yang dibuat dari produk susu seperti krim, lalu dicampur dengan perasa dan pemanis buatan ataupun alami.', 12000, 56, '2023-03-21 13:47:56', '2023-03-26 14:48:33'),
(11, 2, 'Roti Panggang', 'Roti panggang yang enak dengan baluran coklat keju yang melimpah', 45000, 14, '2023-03-28 07:56:10', '2023-03-29 02:01:42'),
(12, 5, 'Steak Barbeque', 'Steak panggang mantap', 98000, 12, '2023-03-28 07:58:59', '2023-04-10 15:56:20'),
(13, 6, 'Coffe', 'Coffe robusta', 54000, 200, '2023-03-28 08:00:42', '2023-04-10 13:24:53'),
(15, 4, 'Waffle', 'Waffle coklat rasanya mantap', 73000, 70, '2023-03-28 08:48:04', '2023-04-10 15:56:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idKeranjang` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `catatan` text NOT NULL,
  `metodePembayaran` int(1) NOT NULL,
  `statusPembayaran` int(1) NOT NULL DEFAULT 0,
  `buktiPembayaran` text DEFAULT NULL,
  `idKhusus` varchar(29) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `idUser`, `idKeranjang`, `alamat`, `catatan`, `metodePembayaran`, `statusPembayaran`, `buktiPembayaran`, `idKhusus`, `createdAt`, `updatedAt`) VALUES
(1, 6, 1, 'Tegal umahe ilham', 'Jangan pake lama mas.. laper', 2, 1, 'sample-tf.png', '3-20230321205212', '2023-03-21 13:52:15', '2023-03-30 02:05:16'),
(2, 6, 2, 'Tegal umahe ilham', 'Jangan pake lama mas.. laper', 2, 1, 'sample-tf.png', '3-20230321205212', '2023-03-21 13:52:15', '2023-03-30 02:05:18'),
(3, 5, 3, 'Nang umah', 'Jangan pake lama mas.. laper', 2, 0, NULL, '5-20230324102011', '2023-03-24 03:01:18', '2023-03-30 02:05:20'),
(4, 5, 4, 'Nang umah', 'Jangan pake lama mas.. laper', 2, 0, NULL, '5-20230324102011', '2023-03-24 03:02:55', '2023-03-30 02:05:21'),
(5, 3, 8, 'Kartini, Jl. Code Solution No. 1, Kota Tegal', 'Nasi goreng pedas 1, sedang 1', 1, 1, 'fbe81ae609fbafab66adfae7e3042ab0.png', '3-20230330100535', '2023-03-30 03:05:35', '2023-03-30 07:56:06'),
(6, 3, 12, 'Kartini, Jl. Code Solution No. 1, Kota Tegal', 'Nasi goreng pedas 1, sedang 1', 1, 1, 'fbe81ae609fbafab66adfae7e3042ab0.png', '3-20230330100535', '2023-03-30 03:05:35', '2023-03-30 07:56:06'),
(7, 7, 16, 'Jalan tanjung pinggire rel', 'gapake lama', 2, 1, '7edf5a0f52ccd3a6b1d91e192779a18c.jpg', '7-20230410201049', '2023-04-10 13:10:49', '2023-04-10 13:16:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesan`
--

CREATE TABLE `pesan` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pesan`
--

INSERT INTO `pesan` (`id`, `name`, `email`, `subject`, `message`, `createdAt`) VALUES
(1, 'il', 'il@gmail.com', 'kjg', 'll', '2023-04-10 02:30:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `progres`
--

CREATE TABLE `progres` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idKhusus` varchar(29) NOT NULL,
  `status` varchar(100) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `progres`
--

INSERT INTO `progres` (`id`, `idUser`, `idKhusus`, `status`, `createdAt`, `updatedAt`) VALUES
(1, 6, '3-20230321205212', 'Sedang diproses', '2023-03-24 03:50:29', '2023-03-29 03:49:33'),
(3, 6, '3-20230321205212', 'Sedang diantar', '2023-03-24 04:44:39', '2023-03-29 03:49:36'),
(4, 3, '3-20230330100535', 'Sedang diproses', '2023-03-30 07:56:06', NULL),
(5, 7, '7-20230410201049', 'Sedang diproses', '2023-04-10 13:16:33', NULL),
(6, 7, '7-20230410201049', 'Sedang diantar', '2023-04-10 13:17:03', NULL),
(7, 7, '7-20230410201049', 'Sudah diterima pembeli', '2023-04-10 13:17:24', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idMenu` int(11) NOT NULL,
  `rating` int(1) NOT NULL,
  `review` text NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `review`
--

INSERT INTO `review` (`id`, `idUser`, `idMenu`, `rating`, `review`, `createdAt`) VALUES
(1, 3, 10, 4, 'Enak bgt rasanya, ga bikin eneg', '2023-04-10 03:51:08'),
(4, 7, 6, 5, 'Enak nemen yakin sung', '2023-04-10 13:21:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `noHp` varchar(14) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL DEFAULT 'default.jpg',
  `role` int(1) NOT NULL,
  `is_active` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `noHp`, `password`, `image`, `role`, `is_active`, `created_at`) VALUES
(1, 'superadmin', 'superadmin@gmail.com', NULL, '$2y$10$7pyTCt1Y3lkAo4duy7Y8YekrA2.lkYPVVfNMgsEv7HQ3DEMyyiyde', 'default.jpg', 1, 1, '2023-03-07 04:17:36'),
(7, 'ilham', 'codesolution404@gmail.com', NULL, '$2y$10$atl9EuveVSLtScXs1b/UeevafixtmX2/k8AEekH4ade/HeHt04.Lm', 'default.jpg', 2, 1, '2023-04-10 13:07:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `gambar`
--
ALTER TABLE `gambar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `progres`
--
ALTER TABLE `progres`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `gambar`
--
ALTER TABLE `gambar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `progres`
--
ALTER TABLE `progres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
