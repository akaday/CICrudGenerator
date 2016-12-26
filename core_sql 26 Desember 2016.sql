-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2016 at 03:45 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `core_sql1`
--

-- --------------------------------------------------------

--
-- Table structure for table `core`
--

CREATE TABLE `core` (
  `id_db` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `kelamin` enum('pria','wanita') NOT NULL,
  `pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `core`
--

INSERT INTO `core` (`id_db`, `nama`, `tgl_mulai`, `tgl_selesai`, `kelamin`, `pass`) VALUES
(1, 'Data 1', '2016-12-01', '2016-12-02', 'pria', '123123');

-- --------------------------------------------------------

--
-- Table structure for table `identitas`
--

CREATE TABLE `identitas` (
  `id_identitas` int(5) NOT NULL,
  `nama_website` varchar(100) NOT NULL,
  `meta_deskripsi` varchar(250) NOT NULL,
  `meta_keyword` varchar(250) NOT NULL,
  `favicon` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `identitas`
--

INSERT INTO `identitas` (`id_identitas`, `nama_website`, `meta_deskripsi`, `meta_keyword`, `favicon`, `email`) VALUES
(1, 'Cravedia', 'create website from template until system which user-friendly, easy to use, and bring ideas into reality.', 'Cravedia', 'Logo-Fix.png', 'cakra.ds@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id_db` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `level` int(11) NOT NULL,
  `status` varchar(15) NOT NULL,
  `id_session` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_db`, `username`, `password`, `nama_lengkap`, `level`, `status`, `id_session`) VALUES
(1, 'akaday', 'e10adc3949ba59abbe56e057f20f883e', 'Cakra Danu Sedayu', 0, 'aktif', 'c10b4aad4b5fe0c386e402f831708fc4002c8ac9');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id_main` int(5) NOT NULL,
  `nama_menu` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `link` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `jabatan` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `parrent` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT '0',
  `urutan` int(11) NOT NULL,
  `icon` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id_main`, `nama_menu`, `link`, `jabatan`, `parrent`, `urutan`, `icon`) VALUES
(51, 'Sistem Setting', '0', '', '0', 10, 'fa fa-gear'),
(75, 'Perusahaan', 'perusahaan', '', '51', 0, ''),
(74, 'Menu', 'module', '', '51', 3, ''),
(107, 'core', 'core', '', '0', 1, 'fa fa-coin'),
(97, 'Identitas', 'identitas', '', '51', 8, ''),
(108, 'Users', 'users', '', '0', 4, 'fa-users'),
(109, 'Jabatan', 'users_jabatan', '', '0', 5, 'fa fa-table');

-- --------------------------------------------------------

--
-- Table structure for table `module_member`
--

CREATE TABLE `module_member` (
  `id_main` int(5) NOT NULL,
  `nama_menu` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `link` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `jabatan` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `parrent` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT '0',
  `urutan` int(11) NOT NULL,
  `icon` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module_member`
--

INSERT INTO `module_member` (`id_main`, `nama_menu`, `link`, `jabatan`, `parrent`, `urutan`, `icon`) VALUES
(51, 'Setting', '0', '', '0', 20, 'fa fa-gear'),
(97, 'Withdraw', 'point_withdraw', '', '89', 2, ''),
(89, 'Finance', '', '', '0', 5, 'fa-dollar'),
(83, 'Staff', 'event_staff_eo', '', '0', 7, 'fa-users'),
(74, 'Menu Member', 'module_member', '', '51', 3, ''),
(84, 'Event', 'event_acara', '', '0', 1, 'fa-calendar'),
(81, 'Jabatan User', 'staff_jabatan', '', '51', 5, ''),
(87, 'Broadcast', 'broadcast', '', '0', 10, 'fa-arrows'),
(88, 'Map Editor', 'seat_map', '', '0', 10, 'fa fa-braille'),
(92, 'Statement', 'point_statement', '', '89', 4, 'fa-tasks'),
(96, 'Deposit', 'point_deposit', '', '89', 1, ''),
(94, 'Profile', 'event_eo', '', '0', 6, 'fa-user'),
(95, 'Laporan Tiket', 'event_acara/laporan_tiket', '', '0', 3, 'fa-briefcase');

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `id_perusahaan` int(11) NOT NULL,
  `nama_perusahaan` varchar(100) NOT NULL,
  `motto` varchar(100) NOT NULL,
  `home_text` varchar(100) NOT NULL,
  `home_text_en` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `alamat3` varchar(100) NOT NULL,
  `alamat2` varchar(100) NOT NULL,
  `koordinat` varchar(100) NOT NULL,
  `telp` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `fax` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`id_perusahaan`, `nama_perusahaan`, `motto`, `home_text`, `home_text_en`, `alamat`, `alamat3`, `alamat2`, `koordinat`, `telp`, `phone`, `fax`, `email`, `logo`) VALUES
(1, 'Cravedia', 'do ', '', '', 'Masnida Estate, No. A03', 'Medan - Sumatera Utara', 'Medan Baru (Sekitar USU)', '', '', '085722193104', '-', 'cakra.ds@gmail.com', 'aabe951ff385fc4d3408063842951020.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `pin` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `no_telp` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'user',
  `blokir` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `id_session` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `kcfinder` enum('true','false') COLLATE latin1_general_ci NOT NULL DEFAULT 'true'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `pin`, `nama_lengkap`, `email`, `no_telp`, `level`, `blokir`, `id_session`, `kcfinder`) VALUES
('admin', 'e10adc3949ba59abbe56e057f20f883e', '4297f44b13955235245b2497399d7a93', 'Administrator', 'admin@detik.com', '08238923848', '1', 'N', '7b0145112a0dcb1092a0c8e557b918c6c1d3b086', 'false'),
('akaday', '4297f44b13955235245b2497399d7a93', '', 'Cakra Danu Sedayu', 'cakra.ds@gmail.com', '085722193104', '3', 'N', '8504ae182bc7cc4cd6273d33ff3a9d5d48933a19', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `users_jabatan`
--

CREATE TABLE `users_jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(100) NOT NULL,
  `list_modul` text NOT NULL,
  `ke` varchar(100) NOT NULL,
  `modul_android` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_jabatan`
--

INSERT INTO `users_jabatan` (`id_jabatan`, `nama_jabatan`, `list_modul`, `ke`, `modul_android`) VALUES
(1, 'superadmin', '|all|', 'dashboard', 0),
(3, 'member', 'dashboard|core|perusahaan|module|identitas', 'dashboard', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `core`
--
ALTER TABLE `core`
  ADD PRIMARY KEY (`id_db`);

--
-- Indexes for table `identitas`
--
ALTER TABLE `identitas`
  ADD PRIMARY KEY (`id_identitas`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_db`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id_main`);

--
-- Indexes for table `module_member`
--
ALTER TABLE `module_member`
  ADD PRIMARY KEY (`id_main`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`id_perusahaan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `users_jabatan`
--
ALTER TABLE `users_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `core`
--
ALTER TABLE `core`
  MODIFY `id_db` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `identitas`
--
ALTER TABLE `identitas`
  MODIFY `id_identitas` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_db` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id_main` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;
--
-- AUTO_INCREMENT for table `module_member`
--
ALTER TABLE `module_member`
  MODIFY `id_main` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;
--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id_perusahaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
