-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 05, 2018 at 12:42 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ukk`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `id` int(11) NOT NULL,
  `id_user` varchar(40) NOT NULL,
  `type` int(1) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `id_user`, `type`, `keterangan`, `tanggal`) VALUES
(16, 'Us1487129368eR2017', 1, 'success', '2017-02-21 02:07:03'),
(17, 'Us1487129368eR2017', 2, 'mendaftarkan id_pasien = Pa1487359279sI2017eN', '2017-02-21 02:07:09'),
(18, 'Us1487128473eR2017', 1, 'success', '2017-02-21 02:07:16'),
(19, 'Us1487129349eR2017', 1, 'success', '2017-02-21 02:07:48'),
(20, 'Us1487129392eR2017', 1, 'success', '2017-02-21 02:08:03'),
(21, 'Us1487125173eR2017', 1, '2017-03-30 14:29:17', '0000-00-00 00:00:00'),
(22, 'Us1487125173eR2017', 1, 'success', '2017-03-30 07:30:48'),
(23, 'Us1487125173eR2017', 1, '2017-03-30 14:32:57', '0000-00-00 00:00:00'),
(24, 'Us1487125173eR2017', 1, 'success', '2017-04-04 11:28:43'),
(25, 'Us1487129368eR2017', 1, 'success', '2017-04-04 11:29:25'),
(26, 'Us1487129368eR2017', 2, 'mendaftarkan id_pasien = Pa1487359279sI2017eN', '2017-04-04 11:29:37'),
(27, 'Us1487128473eR2017', 1, 'success', '2017-04-04 11:29:47'),
(28, 'Us1487129349eR2017', 1, 'success', '2017-04-04 11:30:11'),
(29, 'Us1487129392eR2017', 1, 'success', '2017-04-04 11:30:22'),
(30, 'Us1487125173eR2017', 1, 'success', '2017-04-04 11:41:25'),
(31, 'Us1487125173eR2017', 1, 'success', '2017-04-11 07:02:13'),
(32, 'Us1487125173eR2017', 1, 'success', '2017-04-14 08:19:32'),
(33, 'Us1487125173eR2017', 1, 'success', '2017-04-14 08:45:39'),
(34, 'Us1487125173eR2017', 1, 'success', '2017-05-03 13:33:54'),
(35, 'Us1493818480eR2017', 1, 'success', '2017-05-03 13:34:46'),
(36, 'Us1487125173eR2017', 1, 'success', '2017-05-03 13:37:24'),
(37, 'Us1487125173eR2017', 1, 'success', '2017-05-03 13:39:25'),
(38, 'Us1487129368eR2017', 1, 'success', '2017-05-03 13:40:38'),
(39, 'Us1487129368eR2017', 2, 'mendaftarkan id_pasien = Pa1487359279sI2017eN', '2017-05-03 13:40:49'),
(40, 'Us1487128473eR2017', 1, 'success', '2017-05-03 13:40:57'),
(41, 'Us1487125173eR2017', 1, 'success', '2017-05-03 13:41:46'),
(42, 'Us1487129349eR2017', 1, 'success', '2017-05-03 13:42:03'),
(43, 'Us1487129392eR2017', 1, 'success', '2017-05-03 13:42:17'),
(44, 'Us1487125173eR2017', 1, 'success', '2017-05-03 13:43:09'),
(45, 'Us1487125173eR2017', 1, 'success', '2017-05-30 04:13:41'),
(46, 'Us1487125173eR2017', 1, 'success', '2017-08-25 14:03:55'),
(47, 'Us1487125173eR2017', 1, 'success', '2017-09-23 07:05:34'),
(48, 'Us1487125173eR2017', 1, 'success', '2017-09-25 03:55:31'),
(49, 'Us1487129368eR2017', 1, 'success', '2017-09-25 03:55:49'),
(50, 'Us1487129368eR2017', 2, 'mendaftarkan id_pasien = Pa1487359279sI2017eN', '2017-09-25 03:56:52'),
(51, 'Us1487129368eR2017', 4, 'menghapus id_pasien = pEn1506311812dAf2017taRaN dari pendaftaran', '2017-09-25 03:57:43'),
(52, 'Us1487125173eR2017', 1, 'success', '2017-10-05 17:11:00'),
(53, 'Us1487125173eR2017', 1, 'success', '2017-10-12 12:44:24'),
(54, 'Us1487128473eR2017', 1, 'success', '2017-10-12 13:00:13'),
(55, 'Us1487129368eR2017', 1, 'success', '2017-10-12 13:00:32'),
(56, 'Us1487129368eR2017', 2, 'mendaftarkan id_pasien = Pa1487359279sI2017eN', '2017-10-12 13:01:56'),
(57, 'Us1487129392eR2017', 1, 'success', '2017-10-12 13:02:14'),
(58, 'Us1487129349eR2017', 1, 'success', '2017-10-12 13:02:29'),
(59, 'Us1487129368eR2017', 1, 'success', '2017-10-12 13:02:41'),
(60, 'Us1487129368eR2017', 4, 'menghapus id_pasien = pEn1507813316dAf2017taRaN dari pendaftaran', '2017-10-12 13:02:54'),
(61, 'Us1487129368eR2017', 1, 'success', '2017-10-12 13:03:07'),
(62, 'Us1487129368eR2017', 2, 'mendaftarkan id_pasien = Pa1487359279sI2017eN', '2017-10-12 13:03:25'),
(63, 'Us1487128473eR2017', 1, 'success', '2017-10-12 13:03:35'),
(64, 'Us1487129349eR2017', 1, 'success', '2017-10-12 13:04:20'),
(65, 'Us1487129392eR2017', 1, 'success', '2017-10-12 13:04:36'),
(66, 'Us1487125173eR2017', 1, 'success', '2017-10-12 13:06:21'),
(67, 'Us1487125173eR2017', 1, 'success', '2017-10-12 13:06:59'),
(68, 'Us1487125173eR2017', 1, 'success', '2017-10-18 13:22:48'),
(69, 'Us1487129368eR2017', 1, 'success', '2017-10-18 13:25:41'),
(70, 'Us1487129368eR2017', 2, 'mendaftarkan id_pasien = Pa1487359279sI2017eN', '2017-10-18 13:25:57'),
(71, 'Us1487128473eR2017', 1, 'success', '2017-10-18 13:26:10'),
(72, 'Us1487128473eR2017', 1, 'success', '2017-10-18 13:27:59'),
(73, 'Us1487129349eR2017', 1, 'success', '2017-10-18 13:28:19'),
(74, 'Us1487129368eR2017', 1, 'success', '2017-10-18 13:28:38'),
(75, 'Us1487129392eR2017', 1, 'success', '2017-10-18 13:28:47'),
(76, 'Us1487129392eR2017', 1, 'success', '2017-10-18 13:29:38'),
(77, 'Us1487129368eR2017', 1, 'success', '2017-10-18 13:29:44'),
(78, 'Us1487125173eR2017', 1, 'success', '2017-10-18 13:30:08'),
(79, 'Us1487125173eR2017', 1, 'success', '2017-10-18 13:33:24'),
(80, 'Us1487125173eR2017', 1, 'success', '2017-10-18 13:53:41'),
(81, 'Us1487125173eR2017', 1, 'success', '2017-11-08 11:19:52'),
(82, 'Us1487125173eR2017', 1, 'success', '2018-05-19 17:39:23'),
(83, 'Us1487125173eR2017', 1, 'success', '2018-05-19 17:40:03'),
(84, 'Us1487129368eR2017', 1, 'success', '2018-05-19 17:40:12'),
(85, 'Us1487125173eR2017', 1, 'success', '2018-05-19 17:40:35'),
(86, 'Us1487129368eR2017', 1, 'success', '2018-05-19 17:41:19'),
(87, 'Us1487125173eR2017', 1, 'success', '2018-05-21 15:10:11'),
(88, 'Us1487125173eR2017', 1, 'success', '2018-07-28 13:33:30'),
(89, 'Us1487129368eR2017', 1, 'success', '2018-07-28 13:33:55'),
(90, 'Us1487125173eR2017', 1, 'success', '2018-07-28 13:34:22'),
(91, 'Us1487125173eR2017', 1, 'success', '2018-10-13 16:39:21'),
(92, 'Us1487129368eR2017', 1, 'success', '2018-10-13 16:42:38'),
(93, 'Us1487125173eR2017', 1, 'success', '2018-10-13 16:43:26'),
(94, 'Us1487129368eR2017', 1, 'success', '2018-10-13 16:45:05'),
(95, 'Us1487125173eR2017', 1, 'success', '2018-10-13 16:47:13'),
(96, 'Us1487129392eR2017', 1, 'success', '2018-10-13 16:48:09'),
(97, 'Us1508334676eR2017', 1, 'success', '2018-10-13 16:48:18'),
(98, 'Us1487129349eR2017', 1, 'success', '2018-10-13 16:48:27'),
(99, 'Us1487125173eR2017', 1, 'success', '2018-10-13 16:48:34'),
(100, 'Us1487129392eR2017', 1, 'success', '2018-10-13 16:49:53'),
(101, 'Us1487125173eR2017', 1, 'success', '2018-12-04 23:40:33'),
(102, 'Us1487125173eR2017', 1, 'success', '2018-12-04 23:41:06');

-- --------------------------------------------------------

--
-- Table structure for table `activity_obat`
--

CREATE TABLE `activity_obat` (
  `id` int(11) NOT NULL,
  `id_obat` varchar(40) DEFAULT NULL,
  `jumlah` int(2) DEFAULT NULL,
  `harga` int(2) DEFAULT NULL,
  `isi` int(1) DEFAULT NULL,
  `status` int(1) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activity_obat`
--

INSERT INTO `activity_obat` (`id`, `id_obat`, `jumlah`, `harga`, `isi`, `status`, `tanggal`) VALUES
(1, 'Ob1487389841a2017t', 2, 2000, 4, 2, '2017-04-04 11:30:32'),
(2, 'Ob1487389841a2017t', 2, 2000, 4, 2, '2017-04-04 11:38:21'),
(3, 'Ob1487389841a2017t', 2, 2000, 4, 2, '2017-05-03 13:42:47'),
(4, 'Ob1487389864a2017t', 12, 2500, 4, 2, '2017-10-12 13:04:56'),
(5, 'Ob1487389841a2017t', 10, 2000, 4, 1, '2017-10-12 13:13:38'),
(6, 'Ob1487389891a2017t', 16, 2000, 4, 1, '2017-10-12 13:13:47'),
(7, 'Ob1487389891a2017t', 2, 2000, 4, 1, '2017-10-12 13:13:58'),
(8, 'Ob1487389841a2017t', 5, 2000, 4, 1, '2017-10-12 13:14:04'),
(9, 'Ob1487389841a2017t', 5, 2000, 4, 2, '2017-10-18 13:29:15'),
(10, 'Ob1487389864a2017t', 5, 2500, 4, 2, '2017-10-18 13:29:15'),
(11, 'Ob1487389891a2017t', 5, 2000, 4, 2, '2017-10-18 13:29:15');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_obat`
--

CREATE TABLE `kategori_obat` (
  `id` int(11) NOT NULL,
  `nama` varchar(65) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_obat`
--

INSERT INTO `kategori_obat` (`id`, `nama`) VALUES
(21, 'Obat Hamil'),
(22, 'Obat Pusing');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id` varchar(40) NOT NULL,
  `nama` varchar(65) NOT NULL,
  `jenis` int(1) NOT NULL,
  `kategori` int(1) NOT NULL,
  `harga` int(2) NOT NULL,
  `jumlah` int(1) NOT NULL,
  `isi_pemberian` int(1) NOT NULL,
  `pemakaian` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id`, `nama`, `jenis`, `kategori`, `harga`, `jumlah`, `isi_pemberian`, `pemakaian`) VALUES
('Ob1487389841a2017t', 'Bodrex', 1, 21, 2000, 15, 4, 1),
('Ob1487389864a2017t', 'Panadol', 1, 21, 2500, 15, 4, 1),
('Ob1487389891a2017t', 'Jenang', 1, 21, 2000, 15, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id` varchar(40) NOT NULL,
  `nama` varchar(65) NOT NULL,
  `umur` int(1) NOT NULL,
  `gender` int(1) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id`, `nama`, `umur`, `gender`, `alamat`, `telepon`) VALUES
('Pa1487359279sI2017eN', 'bima', 17, 1, 'sini aja', '(109) 201-972-917'),
('Pa1487359293sI2017eN', 'ardiansyah', 21, 1, 'sini aja', '(281) 982-091-291');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `id_pasien` varchar(40) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `total` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `id_pasien`, `tanggal`, `total`) VALUES
(1, 'Pa1487359279sI2017eN', '2017-04-04 11:30:32', 9000),
(2, 'Pa1487359279sI2017eN', '2017-04-04 11:38:21', 9000),
(3, 'Pa1487359279sI2017eN', '2017-05-03 13:42:47', 9000),
(4, 'Pa1487359279sI2017eN', '2017-10-12 13:04:56', 35000),
(5, 'Pa1487359279sI2017eN', '2017-10-18 13:29:15', 37500);

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `no_daftar` varchar(40) NOT NULL,
  `id_pasien` varchar(40) NOT NULL,
  `id_poli` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `biaya` int(2) NOT NULL,
  `keterangan` text NOT NULL,
  `status_pendaftaran` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`no_daftar`, `id_pasien`, `id_poli`, `tanggal`, `biaya`, `keterangan`, `status_pendaftaran`) VALUES
('pEn1487642829dAf2017taRaN', 'Pa1487359279sI2017eN', 3, '2017-02-21 02:07:09', 5000, 'sa', 3),
('pEn1491305377dAf2017taRaN', 'Pa1487359279sI2017eN', 3, '2017-04-04 11:29:37', 5000, 'udunen\r\n', 4),
('pEn1493818849dAf2017taRaN', 'Pa1487359279sI2017eN', 3, '2017-05-03 13:40:49', 5000, 'mencret', 4),
('pEn1507813405dAf2017taRaN', 'Pa1487359279sI2017eN', 3, '2017-10-12 13:03:25', 5000, 'silite mbledos\r\n', 4),
('pEn1508333157dAf2017taRaN', 'Pa1487359279sI2017eN', 3, '2017-10-18 13:25:57', 5000, 'kudisan', 4);

-- --------------------------------------------------------

--
-- Table structure for table `poli`
--

CREATE TABLE `poli` (
  `id` int(11) NOT NULL,
  `id_dokter` varchar(40) NOT NULL,
  `nama` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `poli`
--

INSERT INTO `poli` (`id`, `id_dokter`, `nama`) VALUES
(6, 'Us1508334676eR2017', 'Poli Anak');

-- --------------------------------------------------------

--
-- Table structure for table `resep`
--

CREATE TABLE `resep` (
  `id` varchar(40) NOT NULL,
  `id_pendaftaran` varchar(40) NOT NULL,
  `id_obat` varchar(40) DEFAULT NULL,
  `jumlah` int(1) DEFAULT NULL,
  `dosis` int(1) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total` int(11) DEFAULT NULL,
  `status_obat` int(1) DEFAULT NULL,
  `status_resep` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resep`
--

INSERT INTO `resep` (`id`, `id_pendaftaran`, `id_obat`, `jumlah`, `dosis`, `tanggal`, `total`, `status_obat`, `status_resep`) VALUES
('Re1487642829sE2017p', 'pEn1487642829dAf2017taRaN', 'Ob1487389841a2017t', 2, 3, '2017-02-21 02:07:29', 4000, 1, 0),
('Re1487642829sE2017p', 'pEn1487642829dAf2017taRaN', 'Ob1487389864a2017t', 2, 5, '2017-02-21 02:07:40', 5000, 1, 0),
('Re1491305377sE2017p', 'pEn1491305377dAf2017taRaN', 'Ob1487389841a2017t', 2, 3, '2017-04-04 11:29:58', 4000, 1, 1),
('Re1493818849sE2017p', 'pEn1493818849dAf2017taRaN', 'Ob1487389841a2017t', 2, 2, '2017-05-03 13:41:28', 4000, 1, 1),
('Re1507813405sE2017p', 'pEn1507813405dAf2017taRaN', 'Ob1487389864a2017t', 12, 5, '2017-10-12 13:04:12', 30000, 1, 1),
('Re1508333157sE2017p', 'pEn1508333157dAf2017taRaN', 'Ob1487389841a2017t', 5, 6, '2017-10-18 13:26:43', 10000, 1, 1),
('Re1508333157sE2017p', 'pEn1508333157dAf2017taRaN', 'Ob1487389864a2017t', 5, 6, '2017-10-18 13:27:01', 12500, 1, 1),
('Re1508333157sE2017p', 'pEn1508333157dAf2017taRaN', 'Ob1487389891a2017t', 5, 6, '2017-10-18 13:27:33', 10000, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` varchar(40) NOT NULL,
  `nama` varchar(65) NOT NULL,
  `username` varchar(65) NOT NULL,
  `password` varchar(40) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `telepon`, `alamat`, `status`) VALUES
('Us1487125173eR2017', 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', '(219) 219-219-212', 'sini aja', 0),
('Us1487129349eR2017', 'paijo', 'paijo', '44529fdc8afb86d58c6c02cd00c02e43', '(138) 138-123-120', 'sini aja', 2),
('Us1487129368eR2017', 'pujo', 'pujo', 'ddb68b0c20803080618a0b4a10d18e86', '(123) 891-023-812', 'sini aja', 3),
('Us1487129392eR2017', 'puji', 'puji', 'f5e4b33c633b204ea454d36543559011', '(133) 232-323-232', 'sini aaja', 4),
('Us1508334676eR2017', 'Drs Waloyo', 'waloyo', '3a6b13145c491c5ff26498f3410659ac', '(129) 371-923-192', 'sini aja', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity_obat`
--
ALTER TABLE `activity_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_obat`
--
ALTER TABLE `kategori_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`no_daftar`);

--
-- Indexes for table `poli`
--
ALTER TABLE `poli`
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
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `activity_obat`
--
ALTER TABLE `activity_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kategori_obat`
--
ALTER TABLE `kategori_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `poli`
--
ALTER TABLE `poli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
