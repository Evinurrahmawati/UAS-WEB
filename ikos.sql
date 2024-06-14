-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2024 at 03:43 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ikos`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`) VALUES
(1, 'Putri'),
(2, 'Putra'),
(3, 'Campur');

-- --------------------------------------------------------

--
-- Table structure for table `kost`
--

CREATE TABLE `kost` (
  `id` int(11) NOT NULL,
  `nama_kost` varchar(100) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `pemilik` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `harga` varchar(100) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `nomor_whatsapp` varchar(15) DEFAULT NULL,
  `google_maps_link` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kost`
--

INSERT INTO `kost` (`id`, `nama_kost`, `kategori`, `pemilik`, `alamat`, `harga`, `gambar`, `detail`, `nomor_whatsapp`, `google_maps_link`, `status`) VALUES
(32, 'Asrama Anita', '1', 'Unila', 'Jl Lada ujung  III Gedong Meneng', '5000000', 'anita.jpg', 'Kamar mandi dalam, dapur umum, area parkir luas, lemari, meja belajar', '081273466986', 'https://maps.app.goo.gl/Y5aABk8NLk56iPsz9', 0),
(33, 'Asrama Safitri', '1', 'Ibu Misnah', 'jl. Abdul Muis gg Melati Gedong Meneng', '5000000', 'safitri.jpg', 'Kamar mandi dalam, dapur umum, lemari, meja dan kursi belajar', '082180463125', 'https://maps.app.goo.gl/VF25wbaCaTJatsTh6', 0),
(35, 'Rafani Houes', '1', 'Maura', 'Kampung Baru, Labuhan Ratu, Kec. Kedaton, Kota Bandar Lampung', '6000000', 'rafani12.jpg', 'Kamar mandi luar, dapur umum, kasur, lemari, meja belajar', '088267157685', 'https://www.google.com/maps/dir//J6PX%2B7C5,+Kp.+Baru,+Kec.+Kedaton,+Kota+Bandar+Lampung,+Lampung+35141/@-5.364254,105.1659602,12z/data=!4m8!4m7!1m0!1m5!1m1!1s0x2e40c5d0b0ae2e8d:0x3ff98e1215b7a9a2!2m2!1d105.2483586!2d-5.3642208?entry=ttu', 0),
(36, 'Aila Kost', '3', 'Ibu Misnah', 'jl. Abdul Muis gg Melati Gedong Meneng', '7000000', 'aila.jpg', 'Kamar Mandi dalam, Dapur Umum, Lemari, \r\nMeja dan Kursi belajar', '088267157685', 'https://www.google.com/maps/dir/-5.3804212,105.2311552/aila+kost/@-5.3740951,105.2230559,14.1z/data=!4m9!4m8!1m1!4e1!1m5!1m1!1s0x2e40db970e029845:0x296c4a78360b907d!2m2!1d105.2464378!2d-5.3697398?entry=ttu', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` tinyint(4) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`, `email`) VALUES
(1, 'admin', 'admin123', 1, ''),
(2, 'evi', '123', 0, ''),
(3, 'nur', 'nur', 0, ''),
(4, 'adit', 'adit', 0, ''),
(5, 'stevan', '123', 0, ''),
(6, 'akbar', '123', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kost`
--
ALTER TABLE `kost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kost`
--
ALTER TABLE `kost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
