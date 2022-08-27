-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2022 at 07:08 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipdob`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_odp`
--

CREATE TABLE `data_odp` (
  `id_odp` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `odp_name` varchar(50) NOT NULL,
  `otp_slot` varchar(100) NOT NULL,
  `tgl_pengecekan` varchar(100) NOT NULL,
  `penginput` varchar(250) NOT NULL,
  `validasi_data` int(11) DEFAULT 0,
  `file_validasi_data` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_odp`
--

INSERT INTO `data_odp` (`id_odp`, `id_pelanggan`, `odp_name`, `otp_slot`, `tgl_pengecekan`, `penginput`, `validasi_data`, `file_validasi_data`) VALUES
(1, 0, '172.26.193.12', '7', '30/03/2022', '15', 0, NULL),
(2, 0, '172.29.121.147', '12', '29/03/2022', '15', 0, NULL),
(3, 0, 'ODP-TMU-FB/107', '12', '29/03/2022', '15', 0, NULL),
(5, 4, 'ODP-CTD-FV/90', '12', '2022-08-16', '13', 0, NULL),
(6, 5, 'ODP-LBP-FJ/039', '13', '2022-08-26', '13', 0, NULL),
(7, 6, 'ODP-LBP-FJ/039', '12', '2022-08-18', '13', 0, NULL),
(8, 2, 'ODP-CTD-FV/090', '13', '2022-08-30', '13', 0, NULL),
(9, 6, 'ODP-TMU-FB/107', '19', '2022-08-21', '13', 0, NULL),
(10, 7, 'ODP-LBP-BJI/040', '23', '2022-08-19', '13', 0, NULL),
(11, 1, 'asdhansd', 'akjsjk', '2022-08-17', '15', 0, NULL),
(12, 8, 'ODP-TTG-FBN/064', '7', '2022-08-18', '15', 0, NULL),
(13, 9, 'ODP-BJI-FFA/013', '5', '2022-08-18', '15', 0, NULL),
(14, 10, 'ODP-TTG-FD/110', '14', '2022-05-10', '15', 0, NULL),
(15, 11, 'ODP-TJM-FV/090', '14', '2022-05-10', '18', 0, 'data_odp50.xlsx'),
(16, 12, 'ODP-TTG-FBE/164', '4', '2022-08-25', '16', 1, 'data_odp49.xlsx');

-- --------------------------------------------------------

--
-- Table structure for table `data_pelanggan`
--

CREATE TABLE `data_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `ket_pelanggan` enum('A','T') NOT NULL,
  `lokasi_pelanggan` varchar(150) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `no_hp` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_pelanggan`
--

INSERT INTO `data_pelanggan` (`id_pelanggan`, `ket_pelanggan`, `lokasi_pelanggan`, `nama_pelanggan`, `no_hp`) VALUES
(1, 'A', 'medan johor', 'Putri Aprilia', '081313131414'),
(2, 'A', 'Binjai', 'Rahel cintya', '087766554433'),
(3, 'A', 'medan johor', 'Putri Cahyani', '082211223344'),
(4, 'A', 'deli serdang', 'Arya Putra', '082211223344'),
(5, 'A', 'medan area', 'Zsazsa Sabilla', '081361200079'),
(6, 'A', 'deli serdang', 'puri handayani', '081361200079'),
(7, 'A', 'Binjai', 'Sabrina Thaharah', '087766554433'),
(8, 'A', 'deli serdang', 'Diki Saputra', '087766554433'),
(9, 'A', 'Binjai', 'Riko Koko', '081361200079'),
(10, 'A', 'deli serdang', 'Rizky Nazar', '081313131414'),
(11, 'A', 'Binjai', 'Muhammad Ezsra', '087766554433'),
(12, 'A', 'BINJAI', 'RIKO', '897080');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(6, 'Team Leader', 'Pengguna'),
(7, 'Teknisi', 'Pengguna'),
(8, 'Manager', 'Pengguna');

-- --------------------------------------------------------

--
-- Table structure for table `groups_menu`
--

CREATE TABLE `groups_menu` (
  `id_groups` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups_menu`
--

INSERT INTO `groups_menu` (`id_groups`, `id_menu`) VALUES
(1, 8),
(1, 40),
(1, 95),
(5, 95),
(1, 96),
(5, 96),
(1, 100),
(5, 100),
(1, 101),
(5, 101),
(1, 102),
(5, 102),
(1, 104),
(5, 104),
(1, 105),
(5, 105),
(1, 106),
(5, 106),
(1, 107),
(5, 107),
(1, 4),
(2, 4),
(3, 4),
(5, 4),
(1, 43),
(1, 44),
(1, 1),
(6, 1),
(7, 1),
(8, 1),
(1, 3),
(6, 3),
(7, 3),
(8, 3),
(1, 92),
(6, 92),
(7, 92),
(8, 92),
(6, 110),
(7, 110),
(6, 111),
(1, 42),
(8, 112),
(8, 114),
(6, 113),
(7, 113);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `id_odp` varchar(255) NOT NULL,
  `id_pelanggan` varchar(255) NOT NULL,
  `odp_name` varchar(255) NOT NULL,
  `otp_slot` varchar(255) NOT NULL,
  `tgl_pengecekan` varchar(255) NOT NULL,
  `penginput` varchar(255) NOT NULL,
  `validasi_history` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `id_odp`, `id_pelanggan`, `odp_name`, `otp_slot`, `tgl_pengecekan`, `penginput`, `validasi_history`) VALUES
(1, '8', '6', 'ODP-CTD-FV/090', '11', '30/03/2022', '13', NULL),
(2, '7', '6', 'ODP-LBP-FJ/039', '12', '26/06/2021', '13', NULL),
(3, '8', '2', 'ODP-CTD-FV/090', '13', '30/03/2022', '13', NULL),
(4, '9', '6', 'ODP-TMU-FB/107', '19', '30/03/2022', '13', NULL),
(5, '5', '4', 'ODP-CTD-FV/89', '12', '29/03/2021', '13', NULL),
(6, '5', '4', 'ODP-CTD-FV/90', '12', '29/03/2021', '18', NULL),
(7, '10', '7', 'ODP-LBP-BJI/040', '23', '2022-08-19', '13', NULL),
(8, '6', '5', 'ODP-LBP-FJ/039', '13', '2022-08-26', '13', NULL),
(9, '9', '6', 'ODP-TMU-FB/107', '19', '2022-08-21', '13', NULL),
(10, '8', '2', 'ODP-CTD-FV/090', '13', '2022-08-30', '13', NULL),
(11, '5', '4', 'ODP-CTD-FV/90', '12', '2022-08-16', '13', NULL),
(12, '7', '6', 'ODP-LBP-FJ/039', '12', '2022-08-18', '13', NULL),
(13, '15', '11', 'ODP-TJM-FV/090', '14', '2022-05-10', '18', NULL),
(14, '16', '12', 'ODP-TTG-FBE/164', '4', '2022-08-25', '18', NULL),
(15, '15', '11', 'ODP-TJM-FV/090', '14', '2022-08-25', '18', NULL),
(16, '16', '12', 'ODP-TTG-FBE/164', '4', '2022-08-25', '18', 1),
(17, '15', '11', 'ODP-TJM-FV/090', '14', '2022-08-25', '18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id_laporan` int(11) NOT NULL,
  `evaluasi` varchar(250) NOT NULL,
  `tgl_evaluasi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id_laporan`, `evaluasi`, `tgl_evaluasi`) VALUES
(1, 'Data Tidak Sinkron', '2022-02-22'),
(2, 'Gambar Tidak Ada', '2022-02-23'),
(3, 'Data Tidak Sinkron', '2019-05-01'),
(4, 'Gambar Tidak Ada', '2022-02-25');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT 99,
  `level` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `icon` varchar(125) NOT NULL,
  `label` varchar(25) NOT NULL,
  `link` varchar(125) NOT NULL,
  `id` varchar(25) NOT NULL DEFAULT '#',
  `id_menu_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `sort`, `level`, `parent_id`, `icon`, `label`, `link`, `id`, `id_menu_type`) VALUES
(1, 0, 1, 0, 'empty', 'MAIN NAVIGATION', '#', '#', 1),
(3, 1, 2, 1, 'fas fa-tachometer-alt', 'Dashboard', 'dashboard', '#', 1),
(4, 12, 2, 40, 'fas fa-table', 'CRUD Generator', 'crudbuilder', '1', 1),
(8, 11, 2, 40, 'fas fa-bars', 'Menu', 'cms/menu/side-menu', 'navMenu', 1),
(40, 9, 1, 0, 'empty', 'DEV', '#', '#', 1),
(42, 6, 2, 92, 'fas fa-users-cog', 'Kelola Pengguna', '#', '1', 1),
(43, 7, 3, 42, 'fas fa-angle-double-right', 'Pengguna', 'users', '1', 1),
(44, 8, 3, 42, 'fas fa-angle-double-right', 'Hak Akses', 'groups', '2', 1),
(92, 3, 1, 0, 'empty', 'MASTER DATA', '#', 'masterdata', 1),
(107, 10, 2, 40, 'fas fa-cog', 'Setting', 'setting', 'setting', 1),
(110, 4, 2, 92, 'fas fa-air-freshener', 'Kelola Data ODP', 'Data_odp', '#', 1),
(111, 5, 2, 92, 'fas fa-user', 'Kelola Pelanggan', 'Data_pelanggan', '#', 1),
(112, 2, 2, 1, 'fab fa-accusoft', 'Kelola Laporan', 'Laporan', '#', 1),
(113, 1, 2, 1, 'fas fa-list', 'History', 'Data_odp/history', '#', 1),
(114, 1, 2, 92, 'fab fa-accessible-icon', 'Grafik', 'laporan/grafik', '#', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_type`
--

CREATE TABLE `menu_type` (
  `id_menu_type` int(11) NOT NULL,
  `type` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu_type`
--

INSERT INTO `menu_type` (`id_menu_type`, `type`) VALUES
(1, 'Side menu');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_user` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` enum('A','T') NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rekap_data_odp`
--

CREATE TABLE `rekap_data_odp` (
  `id_rekap_data` int(11) NOT NULL,
  `gambar` varchar(25) NOT NULL,
  `ket_pelanggan` enum('A','T') NOT NULL,
  `lokasi_pelanggan` varchar(150) NOT NULL,
  `odp_name` int(11) NOT NULL,
  `tgl_pengecekan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nilai` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `kode`, `nama`, `nilai`) VALUES
(1, 'logo.jpg', 'SIPDOB', 'www.sabill.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `image` varchar(128) NOT NULL DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `password`, `email`, `active`, `first_name`, `last_name`, `phone`, `image`) VALUES
(12, '$2y$08$GQ5sZWpnPkFNfRmIze8HsOItyoZVOcqZ4CwZOD3zPrE5/o5jo6lDK', 'affan@gmail.com', 1, 'Affan', 'Azhari', '081361200079', 'default.jpg'),
(13, '$2y$08$PIHN/7n5Y8p4sgmJpC8nEOa9/fsXIQb4UKWPaO.9M3RvjsEcOzG3y', 'sandi@gmail.com', 1, 'Sandi', 'Setiawan', '081361200079', 'logo1.jpg'),
(14, '$2y$08$cvHiOQguZJERFhI7i2N6U.BIJGBXheHdzfXsAwbdF7RraOTudEBLe', 'sunedy@gmail.com', 1, 'Sunedy', 'Abdillah', '081361200079', 'logo.jpg'),
(15, '$2y$08$ArwQdTJhZg1YaTFoUQN48eOIEXK4OnkMLXXGoUIPvbAjrHNQEchmq', 'yoyo@gmail.com', 1, 'Yoyo', 'Prasetyo', '081361200079', 'logo2.jpg'),
(16, '$2y$08$N72SY7sbeHdGAH..PzbUzeJnHLOvaFlJE3z9tc3iEL.dKfG1trtwG', 'fajar@gmail.com', 1, 'Fajar', 'Somantri', '081361200079', 'logo3.jpg'),
(17, '$2y$08$u6L1dhCTVwuGNdc8iHKks.aSLNvdY7Vsc4sC/GTHNgTuJw7EHu9Qm', 'prayoga@gmail.com', 1, 'prayoga', 'Prasetyo', NULL, 'default.jpg'),
(18, '$2y$08$WnV7IBcIqfgy3j4nCs9ITuAQzfsCpxRZu33NRR3ygl4fI8FN9vEpC', 'adji@gmail.com', 1, 'Adji', 'Pribadi', NULL, 'default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(36, 12, 1),
(37, 13, 6),
(39, 14, 8),
(40, 15, 7),
(41, 16, 7),
(42, 17, 7),
(44, 18, 6);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_odp`
-- (See below for the actual view)
--
CREATE TABLE `v_odp` (
`id_odp` int(11)
,`odp_name` varchar(50)
,`olt_slot` varchar(100)
,`id_pelanggan` int(11)
,`nama_pelanggan` varchar(100)
,`lokasi_pelanggan` varchar(150)
);

-- --------------------------------------------------------

--
-- Structure for view `v_odp`
--
DROP TABLE IF EXISTS `v_odp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_odp`  AS  select `odp`.`id_odp` AS `id_odp`,`odp`.`odp_name` AS `odp_name`,`odp`.`otp_slot` AS `olt_slot`,`dp`.`id_pelanggan` AS `id_pelanggan`,`dp`.`nama_pelanggan` AS `nama_pelanggan`,`dp`.`lokasi_pelanggan` AS `lokasi_pelanggan` from (`data_odp` `odp` join `data_pelanggan` `dp` on(`odp`.`id_pelanggan` = `dp`.`id_pelanggan`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_odp`
--
ALTER TABLE `data_odp`
  ADD PRIMARY KEY (`id_odp`);

--
-- Indexes for table `data_pelanggan`
--
ALTER TABLE `data_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `menu_type`
--
ALTER TABLE `menu_type`
  ADD PRIMARY KEY (`id_menu_type`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `rekap_data_odp`
--
ALTER TABLE `rekap_data_odp`
  ADD PRIMARY KEY (`id_rekap_data`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_odp`
--
ALTER TABLE `data_odp`
  MODIFY `id_odp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `data_pelanggan`
--
ALTER TABLE `data_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `menu_type`
--
ALTER TABLE `menu_type`
  MODIFY `id_menu_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rekap_data_odp`
--
ALTER TABLE `rekap_data_odp`
  MODIFY `id_rekap_data` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
