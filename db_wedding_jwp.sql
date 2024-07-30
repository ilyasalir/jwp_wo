-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jun 2024 pada 15.48
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_wedding_jwp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_catalogues`
--

CREATE TABLE `tb_catalogues` (
  `catalogue_id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `package_name` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `status_publish` enum('Y','N') NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_catalogues`
--

INSERT INTO `tb_catalogues` (`catalogue_id`, `image`, `package_name`, `description`, `price`, `status_publish`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '20240616_805025498.jpg', 'Paket Hemat', '<p>Paket Pernikahan Sederhana dirancang untuk pasangan yang menginginkan perayaan intim dengan keluarga dan teman terdekat. Dengan paket ini, kami menyediakan semua kebutuhan dasar pernikahan Anda tanpa mengorbankan kualitas dan keindahan acara.</p><p><strong>Termasuk:</strong></p><ul><li>Dekorasi standar untuk gedung atau rumah</li><li>100 undangan</li><li>2 set busana pengantin (akad dan resepsi)</li><li>Tata rias dan rambut untuk pengantin wanita</li><li>Catering untuk 100 tamu</li><li>Dokumentasi foto dan video (5 jam)</li><li>MC dan hiburan ringan</li><li>Souvenir untuk 100 tamu</li></ul>', 80000000, 'Y', 1, '2024-06-16 06:49:22', '2024-06-16 09:01:32'),
(4, '2024EuropeBerlin16_1202663380.jpg', 'Paket Hemat', '<p>Paket Pernikahan Sederhana dirancang untuk pasangan yang menginginkan perayaan intim dengan keluarga dan teman terdekat. Dengan paket ini, kami menyediakan semua kebutuhan dasar pernikahan Anda tanpa mengorbankan kualitas dan keindahan acara.</p><p><strong>Termasuk:</strong></p><ul><li>Dekorasi standar untuk gedung atau rumah</li><li>100 undangan</li><li>2 set busana pengantin (akad dan resepsi)</li><li>Tata rias dan rambut untuk pengantin wanita</li><li>Catering untuk 100 tamu</li><li>Dokumentasi foto dan video (5 jam)</li><li>MC dan hiburan ringan</li><li>Souvenir untuk 100 tamu</li></ul>', 50000000, 'Y', 1, '2024-06-16 09:02:05', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_order`
--

CREATE TABLE `tb_order` (
  `order_id` int(11) NOT NULL,
  `catalogue_id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `email` varchar(256) NOT NULL,
  `phone_number` varchar(30) NOT NULL,
  `wedding_date` date NOT NULL,
  `status` enum('requested','approved') NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_order`
--

INSERT INTO `tb_order` (`order_id`, `catalogue_id`, `name`, `email`, `phone_number`, `wedding_date`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(5, 4, 'dewa', 'dewa@gmail.com', '09887652672', '2024-06-17', 'approved', 1, '2024-06-16 12:39:25', '2024-06-16 12:40:09'),
(6, 4, 'bagus', 'bagus@gmail.com', '0922333222', '2024-06-23', 'requested', 0, '2024-06-16 12:39:43', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_settings`
--

CREATE TABLE `tb_settings` (
  `id` int(2) NOT NULL,
  `website_name` varchar(256) NOT NULL,
  `phone_number1` varchar(15) NOT NULL,
  `phone_number2` varchar(15) NOT NULL,
  `email1` varchar(80) NOT NULL,
  `email2` varchar(80) NOT NULL,
  `address` text NOT NULL,
  `maps` text NOT NULL,
  `logo` varchar(80) NOT NULL,
  `facebook_url` varchar(256) NOT NULL,
  `instagram_url` varchar(256) NOT NULL,
  `youtube_url` varchar(256) NOT NULL,
  `header_bussines_hour` varchar(160) NOT NULL,
  `time_bussines_hour` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_settings`
--

INSERT INTO `tb_settings` (`id`, `website_name`, `phone_number1`, `phone_number2`, `email1`, `email2`, `address`, `maps`, `logo`, `facebook_url`, `instagram_url`, `youtube_url`, `header_bussines_hour`, `time_bussines_hour`, `created_at`, `updated_at`) VALUES
(1, 'JWP Wedding Organizer', '1222222', '3322344', 'jwp@gmail.com', 'jwp2@gmail.com', 'test', '<iframe class=\"w-100 rounded\"\r\n                        src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.666347494426!2d106.82458402402449!3d-6.175403010511383!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5d2e764b12d%3A0x3d2ad6e1e0e9bcc8!2sNational%20Monument!5e0!3m2!1sen!2sbd!4v1718439029394!5m2!1sen!2sbd\"\r\n                        frameborder=\"0\" style=\"height: 100%; min-height: 300px; border:0;\" allowfullscreen=\"\" aria-hidden=\"false\"\r\n                        tabindex=\"0\"></iframe>\r\n', '20240615_1673308424.png', 'test', 'test', 'test', 'test\r\n                           ', 'test                                                                                                                                                              ', '2024-06-15 07:12:02', '2024-06-15 10:12:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_users`
--

CREATE TABLE `tb_users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_users`
--

INSERT INTO `tb_users` (`user_id`, `name`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$fT00ydh4n6PDtKFbuvMifOkKF1ZTrfXFlEIWltPDAsQdvyLeHIC62', '2024-06-14 19:30:34', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_catalogues`
--
ALTER TABLE `tb_catalogues`
  ADD PRIMARY KEY (`catalogue_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `catalogue_id` (`catalogue_id`);

--
-- Indeks untuk tabel `tb_settings`
--
ALTER TABLE `tb_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_catalogues`
--
ALTER TABLE `tb_catalogues`
  MODIFY `catalogue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_settings`
--
ALTER TABLE `tb_settings`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_catalogues`
--
ALTER TABLE `tb_catalogues`
  ADD CONSTRAINT `user_id_catalogue_idx` FOREIGN KEY (`user_id`) REFERENCES `tb_users` (`user_id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_order`
--
ALTER TABLE `tb_order`
  ADD CONSTRAINT `catalogue_id_order_idx` FOREIGN KEY (`catalogue_id`) REFERENCES `tb_catalogues` (`catalogue_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
