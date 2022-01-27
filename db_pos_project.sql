-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 27 Jan 2022 pada 14.25
-- Versi server: 5.7.24
-- Versi PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pos_project`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'KASIR', 'Group For Kasir User'),
(2, 'GUDANG', 'Group For Gudang User'),
(3, 'SUPER ADMIN', 'Group For Super Admin User'),
(4, 'ATASAN', 'Group For Atasan User'),
(5, 'PURCHASING', 'Group For Purchasing User'),
(6, 'MARKETING', 'Group For Marketing User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`id`, `group_id`, `user_id`) VALUES
(10, 1, 10),
(7, 2, 7),
(12, 2, 12),
(3, 3, 3),
(8, 3, 8),
(4, 4, 4),
(11, 5, 11),
(9, 6, 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'super.admin@ganatech.id', 3, '2021-10-19 16:37:33', 1),
(2, '::1', 'super.admin@ganatech.id', 3, '2021-10-21 11:45:58', 1),
(3, '180.249.118.66', 'super.admin@ganatech.id', 3, '2021-10-22 14:19:08', 1),
(4, '180.249.118.66', 'super.admin@ganatech.id', 3, '2021-10-22 18:23:26', 1),
(5, '180.249.118.66', 'super.admin@ganatech.id', 3, '2021-10-22 18:23:26', 1),
(6, '180.249.118.66', 'headit.dintara@gmail.com', NULL, '2021-10-25 18:00:56', 0),
(7, '180.249.118.66', 'super.admin@ganatech.id', 3, '2021-10-25 18:01:07', 1),
(8, '180.249.118.66', 'super.admin@ganatech.id', 3, '2021-10-28 11:49:59', 1),
(9, '180.249.118.66', 'ekawiratha@gmail.com', 8, '2021-10-28 12:04:03', 1),
(10, '180.249.118.66', 'purchasing@dintarakitchen.com', 11, '2021-10-28 12:05:21', 1),
(11, '180.249.118.66', 'storedintara@gmail.com', 7, '2021-10-28 12:06:21', 1),
(12, '180.249.118.66', 'purchasing@dintarakitchen.com', 11, '2021-10-28 12:08:47', 1),
(13, '180.249.118.66', 'marketing@dintarakitchen.com', 10, '2021-10-28 12:20:20', 1),
(14, '180.249.119.59', 'storedintara@gmail.com', 7, '2021-10-28 16:04:37', 1),
(15, '36.83.146.124', 'storedintara@gmail.com', 7, '2021-10-29 08:33:47', 1),
(16, '36.83.146.124', 'ekawiratha@gmail.com', 8, '2021-10-29 09:31:44', 1),
(17, '36.83.146.124', 'penyimpananit.dnt1@gmail.com', 12, '2021-10-29 09:46:26', 1),
(18, '36.83.146.124', 'ekawiratha@gmail.com', NULL, '2021-10-29 10:06:34', 0),
(19, '36.83.146.124', 'ekawiratha@gmail.com', 8, '2021-10-29 10:06:52', 1),
(20, '36.83.146.124', 'ekawiratha@gmail.com', 8, '2021-10-29 13:00:57', 1),
(21, '36.83.146.124', 'storedintara@gmail.com', 7, '2021-10-29 13:33:22', 1),
(22, '36.83.146.124', 'dintarakitchen@gmail.com', 9, '2021-10-29 16:04:57', 1),
(23, '36.83.146.124', 'storedintara@gmail.com', 7, '2021-10-29 16:44:46', 1),
(24, '36.83.146.124', 'penyimpananit.dnt1@gmail.com', 12, '2021-10-30 09:49:18', 1),
(25, '36.83.146.124', 'storedintara@gmail.com', 7, '2021-10-30 16:15:52', 1),
(26, '36.83.146.124', 'marketing@dintarakitchen.com', 10, '2021-10-30 17:03:05', 1),
(27, '36.83.146.124', 'marketing@dintarakitchen.com', 10, '2021-10-30 17:03:35', 1),
(28, '36.83.146.124', 'ekawiratha@gmail.com', 8, '2021-11-04 09:39:07', 1),
(29, '180.249.117.4', 'storedintara@gmail.com', 7, '2021-11-04 15:37:44', 1),
(30, '36.83.146.124', 'storedintara@gmail.com', 7, '2021-11-05 10:33:06', 1),
(31, '180.249.186.23', 'ekawiratha@gmail.com', 8, '2021-11-06 06:56:42', 1),
(32, '180.254.224.74', 'ekawiratha@gmail.com', 8, '2021-11-12 09:49:36', 1),
(33, '180.249.185.20', 'ekawiratha@gmail.com', 8, '2021-11-15 23:14:43', 1),
(34, '180.254.224.176', 'purchasing@dintarakitchen.com', 11, '2021-11-16 14:50:02', 1),
(35, '180.254.224.176', 'purchasing@dintarakitchen.com', 11, '2021-11-16 14:51:47', 1),
(36, '180.254.224.176', 'marketing@dintarakitchen.com', 10, '2021-11-16 14:55:13', 1),
(37, '180.254.224.176', 'purchasing@dintarakitchen.com', 11, '2021-11-16 15:02:42', 1),
(38, '180.254.224.176', 'dintara@gmail.com', NULL, '2021-11-16 15:17:22', 0),
(39, '180.254.224.176', 'dintara.kitchen@gmail.com', NULL, '2021-11-16 15:17:44', 0),
(40, '180.254.224.176', 'dintara.kitchen@gmail.com', NULL, '2021-11-16 15:18:04', 0),
(41, '180.254.224.176', 'dintara@gmail.com', NULL, '2021-11-16 15:18:27', 0),
(42, '180.254.224.176', 'ekawiratha@gmail.com', 8, '2021-11-16 15:18:46', 1),
(43, '125.162.134.118', 'ekawiratha@gmail.com', NULL, '2021-12-02 09:50:42', 0),
(44, '125.162.134.118', 'ekawiratha@gmail.com', 8, '2021-12-02 09:51:03', 1),
(45, '180.249.127.93', 'ekawiratha@gmail.com', 8, '2021-12-13 17:26:43', 1),
(46, '180.249.127.93', 'storedintara@gmail.com', 7, '2021-12-14 16:02:08', 1),
(47, '36.83.149.147', 'storedintara@gmail.com', 7, '2021-12-15 09:03:40', 1),
(48, '36.83.149.147', 'storedintara@gmail.com', 7, '2021-12-15 09:32:59', 1),
(49, '36.83.149.147', 'ekawiratha@gmail.com', NULL, '2021-12-15 13:55:56', 0),
(50, '36.83.149.147', 'ekawiratha@gmail.com', 8, '2021-12-15 13:56:12', 1),
(51, '114.79.22.1', 'ekawiratha@gmail.com', 8, '2021-12-15 17:42:48', 1),
(52, '110.139.178.114', 'storedintara@gmail.com', 7, '2021-12-17 10:38:37', 1),
(53, '110.139.178.114', 'storedintara@gmail.com', 7, '2021-12-18 09:46:44', 1),
(54, '110.139.178.114', 'storedintara@gmail.com', 7, '2021-12-18 15:00:06', 1),
(55, '110.139.178.114', 'storedintara@gmail.com', 7, '2021-12-18 15:15:12', 1),
(56, '110.139.178.114', 'storedintara@gmail.com', 7, '2021-12-20 17:09:18', 1),
(57, '180.249.131.174', 'storedintara@gmail.com', NULL, '2021-12-21 14:29:33', 0),
(58, '180.249.131.174', 'storedintara@gmail.com', 7, '2021-12-21 14:44:02', 1),
(59, '180.254.224.100', 'storedintara@gmail.com', 7, '2021-12-27 11:55:48', 1),
(60, '180.254.224.100', 'storedintara@gmail.com', NULL, '2021-12-27 11:56:53', 0),
(61, '180.254.224.100', 'storedintara@gmail.com', 7, '2021-12-27 11:59:09', 1),
(62, '180.254.224.100', 'storedintara@gmail.com', 7, '2021-12-27 12:15:15', 1),
(63, '180.254.224.100', 'storedintara@gmail.com', 7, '2021-12-27 12:15:58', 1),
(64, '180.254.224.100', 'storedintara@gmail.com', 7, '2021-12-27 12:18:50', 1),
(65, '180.254.224.100', 'storedintara@gmail.com', NULL, '2021-12-27 13:48:07', 0),
(66, '180.254.224.100', 'storedintara@gmail.com', 7, '2021-12-27 13:48:22', 1),
(67, '180.254.224.100', 'ekawiratha@gmail.com', NULL, '2021-12-28 10:02:25', 0),
(68, '180.254.224.100', 'ekawiratha@gmail.com', 8, '2021-12-28 10:02:35', 1),
(69, '180.254.224.100', 'storedintara@gmail.com', 7, '2021-12-28 10:29:46', 1),
(70, '180.254.224.100', 'ekawiratha@gmail.com', 8, '2021-12-28 17:05:36', 1),
(71, '36.85.185.77', 'storedintara@gmail.com', 7, '2022-01-04 10:26:14', 1),
(72, '36.85.185.77', 'storedintara@gmail.com', 7, '2022-01-04 10:58:30', 1),
(73, '36.85.185.77', 'storedintara@gmail.com', 7, '2022-01-04 11:10:04', 1),
(74, '36.85.185.77', 'storedintara@gmail.com', NULL, '2022-01-04 16:28:04', 0),
(75, '36.85.185.77', 'storedintara@gmail.com', NULL, '2022-01-04 16:28:12', 0),
(76, '36.85.185.77', 'storedintara@gmail.com', 7, '2022-01-04 16:28:27', 1),
(77, '36.85.185.77', 'storedintara@gmail.com', 7, '2022-01-06 11:00:47', 1),
(78, '36.85.185.77', 'storedintara@gmail.com', NULL, '2022-01-06 12:16:53', 0),
(79, '36.85.185.77', 'storedintara@gmail.com', 7, '2022-01-06 12:17:29', 1),
(80, '36.85.197.126', 'marketing@dintarakitchen.com', 10, '2022-01-07 11:26:12', 1),
(81, '36.85.197.126', 'dintara@gmail.com', NULL, '2022-01-07 11:29:04', 0),
(82, '36.85.197.126', 'Dintara@gmail.com', NULL, '2022-01-07 11:29:29', 0),
(83, '36.85.197.126', 'dintarakitchen@gmail.com', 9, '2022-01-07 11:29:58', 1),
(84, '36.85.197.126', 'purchasing@gmail.com', NULL, '2022-01-07 11:33:52', 0),
(85, '36.85.197.126', 'purchasing@dintarakitchen.com', 11, '2022-01-07 11:34:15', 1),
(86, '36.85.197.126', 'storedintara@gmail.com', 7, '2022-01-07 11:58:44', 1),
(87, '36.85.197.126', 'marketing@dintarakitchen.com', 10, '2022-01-07 12:30:31', 1),
(88, '36.85.197.126', 'marketing@dintarakitchen.com', 10, '2022-01-07 13:58:18', 1),
(89, '36.85.197.126', 'purchasing@dintarakitchen.com', NULL, '2022-01-07 14:19:54', 0),
(90, '36.85.197.126', 'purchasing@dintarakitchen.com', NULL, '2022-01-07 14:20:07', 0),
(91, '36.85.197.126', 'purchasing@dintarakitchen.com', NULL, '2022-01-07 14:20:23', 0),
(92, '36.85.197.126', 'purchasing@dintarakitchen.com', NULL, '2022-01-07 14:20:49', 0),
(93, '36.85.197.126', 'purchasing@dintarakitchen.com', 11, '2022-01-07 14:37:36', 1),
(94, '36.85.185.77', 'ekawiratha@gmail.com', 8, '2022-01-07 14:57:07', 1),
(95, '36.85.197.126', 'storedintara@gmail.com', 7, '2022-01-07 15:03:38', 1),
(96, '36.85.185.77', 'marketing@dintarakitchen.com', 10, '2022-01-07 16:36:19', 1),
(97, '36.85.185.77', 'purchasing@dintarakitchen.com', NULL, '2022-01-08 11:08:41', 0),
(98, '36.85.185.77', 'purchasing@dintarakitchen.com', 11, '2022-01-08 11:09:15', 1),
(99, '36.85.185.77', 'storedintara@gmail.com', 7, '2022-01-08 11:16:11', 1),
(100, '36.85.185.77', 'dintarakitchen@gmail.com', 9, '2022-01-08 11:16:13', 1),
(101, '36.85.185.77', 'dintarakitchen@gmail.com', NULL, '2022-01-12 10:23:29', 0),
(102, '36.85.185.77', 'dintarakitchen@gmail.com', 9, '2022-01-12 10:23:46', 1),
(103, '36.85.185.77', 'storedintara@gmail.com', 7, '2022-01-12 16:31:17', 1),
(104, '36.85.185.77', 'storedintara@gmail.com', 7, '2022-01-12 16:39:48', 1),
(105, '36.85.185.77', 'ekawiratha@gmail.com', 8, '2022-01-12 16:41:13', 1),
(106, '::1', 'super.admin@ganatech.id', 3, '2022-01-26 20:14:22', 1),
(107, '::1', 'super.admin@ganatech.id', 3, '2022-01-27 14:53:16', 1),
(108, '::1', 'super.admin@ganatech.id', 3, '2022-01-27 19:59:38', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `auth_tokens`
--

INSERT INTO `auth_tokens` (`id`, `selector`, `hashedValidator`, `user_id`, `expires`) VALUES
(1, '306d8ea11ef280e9bb1ba103', '0a26a5e6656fd905dc72e5824338e283786c794414a037cbd9778eb6734c46ce', 10, '2022-02-06 13:58:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice_settings`
--

CREATE TABLE `invoice_settings` (
  `id` int(11) NOT NULL,
  `key` varchar(100) NOT NULL,
  `value` text,
  `position` varchar(100) DEFAULT NULL,
  `header` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `invoice_settings`
--

INSERT INTO `invoice_settings` (`id`, `key`, `value`, `position`, `header`, `created_at`, `updated_at`) VALUES
(1, 'kiri', 'FORRIN JAGOMITRA', 'Spv. Adm. Marketing & Sales	', 'Hormat Kami,', '2022-01-27 07:30:11', '2022-01-27 21:37:13'),
(2, 'tengah', 'PETRUS M. TANGKILISAN', 'General Manager', 'Mengetahui,', '2022-01-27 07:30:11', '2022-01-27 22:12:36'),
(3, 'kanan', 'GASPAR TEMING', '	Head of Marketing & Sales', 'Approval Customer,', '2022-01-27 07:30:11', '2022-01-27 22:12:04'),
(4, 'bawah', '(.......................................)', NULL, 'Approval Customer,', '2022-01-27 20:01:25', '2022-01-27 22:12:15'),
(5, 'note', 'Barang Ini Dapat Dikembalikan, Mohon Simpan Bukti Invoice Ini', '', NULL, '2022-01-27 20:01:22', '2022-01-27 20:49:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `items`
--

CREATE TABLE `items` (
  `id` int(11) UNSIGNED NOT NULL,
  `item_image` varchar(255) DEFAULT NULL,
  `item_code` varchar(50) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `item_merk` varchar(255) DEFAULT NULL,
  `item_type` varchar(50) DEFAULT NULL,
  `item_weight` float DEFAULT NULL,
  `item_length` float DEFAULT NULL,
  `item_width` float DEFAULT NULL,
  `item_height` float DEFAULT NULL,
  `item_hpp` float DEFAULT NULL,
  `item_before_sale` float DEFAULT NULL,
  `item_discount` float DEFAULT NULL,
  `item_sale` float DEFAULT NULL,
  `item_profit` float DEFAULT NULL,
  `item_description` varchar(255) DEFAULT NULL,
  `item_warehouse_a` int(11) DEFAULT '0',
  `item_warehouse_b` int(11) DEFAULT '0',
  `item_warehouse_c` int(11) DEFAULT '0',
  `item_warehouse_d` int(11) DEFAULT '0',
  `item_stock` int(11) DEFAULT NULL,
  `category_id` int(11) UNSIGNED DEFAULT NULL,
  `supplier_id` int(11) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `items`
--

INSERT INTO `items` (`id`, `item_image`, `item_code`, `item_name`, `item_merk`, `item_type`, `item_weight`, `item_length`, `item_width`, `item_height`, `item_hpp`, `item_before_sale`, `item_discount`, `item_sale`, `item_profit`, `item_description`, `item_warehouse_a`, `item_warehouse_b`, `item_warehouse_c`, `item_warehouse_d`, `item_stock`, `category_id`, `supplier_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, '1635472854_31ff9613fe04610cf158.png', 'E0071', 'MAGICLOTUS 60', 'LOTUS', 'F13-64ET', 52, 40, 40, 90, 9000000, 10000000, 0, 10000000, 1000000, '', 6, 0, 0, 0, 0, 3, 1, '2021-10-29 10:00:54', '2022-01-27 22:20:14', NULL),
(5, '1635473042_20a11e73de547797d23f.png', 'E0072', 'MAGICLOTUS 60', 'LOTUS', 'FTLT-64G', 47, 60, 60, 28, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 3, 1, '2021-10-29 10:04:02', '2021-12-14 16:10:30', NULL),
(6, '1635473326_a7a17c808f076ce664ba.png', 'E0073', 'MAGICLOTUS 60', 'LOTUS', 'FTLT-64ET', 49, 60, 40, 28, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 3, 1, '2021-10-29 10:08:46', '2021-10-29 10:08:46', NULL),
(7, '1635473438_3139a410dc5a4f2aa245.png', 'E0074', 'MAGICLOTUS 60', 'LOTUS', 'CF6-712GPV', 106, 60, 100, 90, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 3, 1, '2021-10-29 10:10:38', '2021-10-29 10:11:54', NULL),
(8, '1635473594_d7c9c5104a1b592e443d.png', 'E0075', 'MAGICLOTUS 60', 'LOTUS', 'PCT-66G', 31, 600, 600, 280, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 3, 1, '2021-10-29 10:13:14', '2021-10-29 10:13:14', NULL),
(9, '1635473703_a37bca3187f3ea605804.png', 'E0076', 'MAGICLOTUS 60', 'LOTUS', 'CF4-68GEM', 97, 60, 80, 90, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 3, 1, '2021-10-29 10:15:03', '2021-10-29 10:15:03', NULL),
(10, '1635473909_51e814c162339d445e28.png', 'E0077', 'MAGICLOTUS 60', 'LOTUS', 'CPT-64ET', 27, 60, 40, 28, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 3, 1, '2021-10-29 10:18:29', '2021-10-29 10:18:29', NULL),
(11, '1635473967_8ac28643dafad1b63851.png', 'E0078', 'MAGICLOTUS 60', 'LOTUS', 'CWT-64ET', 36, 60, 60, 28, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 3, 1, '2021-10-29 10:19:27', '2021-12-14 16:12:34', NULL),
(12, '1635474014_bb30336aae353e0bb74d.png', 'E0079', 'MAGICLOTUS 60', 'LOTUS', 'CWT-64G', 41, 60, 60, 28, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 3, 1, '2021-10-29 10:20:14', '2021-12-14 16:11:22', NULL),
(13, '1635474260_39967c3cb9c04e044304.png', 'E00710', 'MAGICLOTUS 70', 'LOTUS', 'BR50-78G', 135, 70.5, 70.5, 90, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 3, 1, '2021-10-29 10:24:20', '2021-12-14 16:12:05', NULL),
(14, '1635474329_e844d16bd889a67edc64.png', 'E00711', 'MAGICLOTUS 70', 'LOTUS', 'PCT-78GP', 73, 70.5, 80, 28, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 3, 1, '2021-10-29 10:25:29', '2021-10-29 10:25:29', NULL),
(15, '1635474390_124828d5ccbbb6cf17ab.png', 'E00712', 'MAGICLOTUS 70', 'LOTUS', 'PCT-712GP', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 3, 1, '2021-10-29 10:26:30', '2021-10-29 10:26:30', NULL),
(16, '1635474555_4c3dfb792f62fabadae1.png', 'E00713', 'MAGICLOTUS 70', 'LOTUS', 'PI50-78ET', 120, 70.5, 80, 90, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 3, 1, '2021-10-29 10:29:15', '2021-10-29 10:29:15', NULL),
(17, '1635474679_88e5aab8a1df381b1e6b.png', 'E00714', 'MAGICLOTUS 70', 'LOTUS', 'CWT-78G', 97, 70.5, 80, 28, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 3, 1, '2021-10-29 10:31:19', '2021-10-29 10:31:19', NULL),
(18, '1635474749_99f11d21c06b24b39e8a.png', 'E00715', 'MAGICLOTUS 70', 'LOTUS', 'CW-78G', 104, 70.5, 80, 90, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 3, 1, '2021-10-29 10:32:29', '2021-10-29 10:32:29', NULL),
(19, '1635474973_b78847ee4fb61054b37f.png', 'E00716', 'MAGICLOTUS 70', 'LOTUS', 'TP4-712GP', 178, 70.5, 120, 90, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 3, 1, '2021-10-29 10:36:13', '2021-10-29 10:36:13', NULL),
(20, '1635475127_0ec865ddb08b7b3ffa7d.png', 'E00717', 'MAGICLOTUS 70', 'LOTUS', 'CF4-78GP', 138, 70.5, 80, 90, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 3, 1, '2021-10-29 10:38:47', '2021-10-29 10:38:47', NULL),
(21, '1635475197_7ea4ff889662ac415970.png', 'E00718', 'MAGICLOTUS 70', 'LOTUS', 'CP-74G', 61, 70.5, 40, 90, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 3, 1, '2021-10-29 10:39:57', '2021-10-29 10:39:57', NULL),
(22, '1635475288_17a870efe2249c4489b6.png', 'E00719', 'MAGICLOTUS 70', 'LOTUS', 'F13-74G', 61, 70.5, 40, 90, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 3, 1, '2021-10-29 10:41:28', '2021-10-29 10:41:28', NULL),
(23, '1635475470_4c645842f651523bcf82.png', 'E00720', 'MAGICLOTUS 70', 'LOTUS', 'F2/8-74G', 59, 70.5, 40, 90, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 3, 1, '2021-10-29 10:44:30', '2021-10-29 10:44:30', NULL),
(24, '1635475534_1e6f982416d6c24ed29a.png', 'E00721', 'MAGICLOTUS 70', 'LOTUS', 'F2/13-78G', 102, 70.5, 80, 90, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 3, 1, '2021-10-29 10:45:34', '2021-10-29 10:45:34', NULL),
(25, '1635475637_99945f24527db5760544.png', 'E00722', 'MAGICLOTUS 70', 'LOTUS', 'FTLT-76G', 68, 70.5, 60, 28, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 3, 1, '2021-10-29 10:47:17', '2021-10-29 10:47:17', NULL),
(26, '1635475688_5c8f4084219208f14d78.png', 'E00723', 'MAGICLOTUS 70', 'LOTUS', 'SE-70M', 50, 370, 875, 380, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 3, 1, '2021-10-29 10:48:08', '2021-10-29 10:48:08', NULL),
(27, '1635476194_ca236ec9af526ae9bacb.png', 'E0081', 'DISHWASHER CHARCOAL OVEN DONER GRILL', 'OZTI', 'OBY 500 DS', 0, 595, 595, 830, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-10-29 10:56:34', '2021-10-29 10:57:32', NULL),
(28, '1635476369_68438cb30e9a8c1a579d.png', 'E0082', 'DISHWASHER CHARCOAL OVEN DONER GRILL', 'OZTI', 'OBY 35 PDT', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-10-29 10:59:29', '2021-10-29 10:59:29', NULL),
(29, '1635476502_7a5388d46df60fb02b5d.png', 'E0083', 'DISHWASHER CHARCOAL OVEN DONER GRILL', 'OZTI', 'OBM 1080 S', 0, 670, 785, 1420, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-10-29 11:01:42', '2021-10-29 11:01:42', NULL),
(30, '1635476609_2095333dcf1dbfad4919.png', 'E0084', 'DISHWASHER CHARCOAL OVEN DONER GRILL', 'OZTI', 'OBK 1500', 207, 800, 800, 1880, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-10-29 11:03:29', '2021-10-29 11:07:42', NULL),
(31, '1635476725_b8b5b601c19ed16c8c8b.png', 'E0085', 'DISHWASHER CHARCOAL OVEN DONER GRILL', 'OZTI', 'OBK 2000', 274, 800, 800, 1880, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-10-29 11:05:25', '2021-10-29 11:07:21', NULL),
(32, '1635476931_fabf9fd512cea503b529.png', 'E0086', 'DISHWASHER CHARCOAL OVEN DONER GRILL', 'OZTI', 'KYK 001', 240, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-10-29 11:08:51', '2021-10-29 11:08:51', NULL),
(33, '1635477055_48c0ed561abae0a36534.png', 'E0087', 'DISHWASHER CHARCOAL OVEN DONER GRILL', 'OZTI', '3 GUD W', 27, 650, 530, 780, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-10-29 11:10:55', '2021-10-29 11:10:55', NULL),
(34, '1635477277_138841e68fc9e8d352bb.png', 'E0088', 'CONVEYOR TOASTER GAS FRYERS', 'OZTI', 'OEK 425', 19, 470, 400, 340, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-10-29 11:14:37', '2021-10-29 11:14:37', NULL),
(35, '1635477485_c9a597bf657daf48f617.png', 'E0089', 'CONVEYOR TOASTER GAS FRYERS', 'OZTI', 'OFG 4065', 0, 400, 650, 300, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-10-29 11:18:05', '2021-10-29 11:18:05', NULL),
(36, '1635477557_c871a2e3b7c4718e98c6.png', 'E00810', 'CONVEYOR TOASTER GAS FRYERS', 'OZTI', 'OFG 7065', 0, 800, 650, 300, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-10-29 11:19:17', '2021-10-29 11:19:17', NULL),
(37, '1635477594_b8378dd9244d336697a5.png', 'E00811', 'CONVEYOR TOASTER GAS FRYERS', 'OZTI', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-10-29 11:19:54', '2021-10-29 11:19:54', NULL),
(38, '1635477620_6c1e1f67e68aeb0c6583.png', 'E00812', 'CONVEYOR TOASTER GAS FRYERS', 'OZTI', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-10-29 11:20:20', '2021-10-29 11:20:20', NULL),
(39, '1635477822_6319e75f32b21e605655.png', 'E00813', 'OZTI BANQUET TROLEY', 'OZTI', 'GNB 500 NMV (COLD)', 125, 910, 850, 1872, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-10-29 11:23:42', '2021-10-29 11:23:42', NULL),
(40, '1635478146_040de16f91680aba4932.png', 'E00814', 'OZTI |BANQUET TROLEY', 'OZTI', 'ONBA 70182(NORT)', 108, 910, 827, 1816, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-10-29 11:29:06', '2021-10-29 11:29:06', NULL),
(41, '1635478280_a3d38ed7a57e9e4fec14.png', 'E00815', 'OZTI BANQUET TROLEY', 'OZTI', 'OBA 14018(HOT)', 208, 910, 1517, 1816, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-10-29 11:31:20', '2021-10-29 11:31:20', NULL),
(42, '1635478375_9d6c3d0d123528928d19.png', 'E00816', 'OZTI BANQUET TROLEY', 'OZTI', 'ONBA 7013 (NORT)', 86, 910, 827, 1160, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-10-29 11:32:55', '2021-10-29 11:32:55', NULL),
(43, '1635478527_ba745b6199af088ff813.png', 'E00817', 'GRILL TOASTER FLOUR TROLLEY', 'OZTI', 'OTM 2530', 0, 360, 410, 280, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-10-29 11:35:27', '2021-10-29 11:35:27', NULL),
(44, '1635478638_a9928468b8ee03cf3c85.png', 'E00818', 'GRILL TOASTER FLOUR TROLLEY', 'OZTI', 'OTM 5530', 0, 560, 370, 260, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-10-29 11:37:18', '2021-10-29 11:37:18', NULL),
(45, '1635478703_c312a77f14afd287af73.png', 'E00819', 'GRILL TOASTER FLOUR TROLLEY', 'OZTI', 'Ce-1008 12', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-10-29 11:38:23', '2021-10-29 11:38:23', NULL),
(46, '1635478827_a1dfa54c14a9d299f288.png', 'E00820', 'GRILL TOASTER FLOUR TROLLEY', 'OZTI', '\'737064436.8', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-10-29 11:40:27', '2021-10-29 11:40:27', NULL),
(47, '1635478892_9a32f8128d5557b9bf4a.png', 'E00821', 'GRILL TOASTER FLOUR TROLLEY', 'OZTI', '8913.IBS27.148', 0, 750, 420, 170, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-10-29 11:41:32', '2021-10-29 11:41:32', NULL),
(48, '1635479633_98123a7eb5bd968758de.png', 'E0091', 'ALTO SHAAM| HOT BANQUET TROOLEY|HALO HEAT TRIPLE', 'ALTO SHAAM', 'ALTO SHAAM TYPE 1000 BQ2-192', 0, 1744, 1744, 1714, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 5, 1, '2021-10-29 11:53:53', '2021-10-29 11:56:43', NULL),
(49, '1635479759_5eda61f212c6a273d464.png', 'E0092', 'ALTO SHAAM| HOT BANQUET TROOLEY|HALO HEAT TRIPLE', 'ALTO SHAAM', 'ALTO SHAAM TYPE 1000 BQ2-96', 0, 954, 773, 1714, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 5, 1, '2021-10-29 11:55:59', '2021-10-29 11:55:59', NULL),
(50, '1635479876_c7ac0c6be25e6ccdb77c.png', 'E0093', 'ALTO SHAAM HOT BANQUET TROOLEY HALO HEAT TRIPLE', 'ALTO SHAAM', 'ALTO SHAAM 500-3D', 0, 664, 624, 657, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 5, 1, '2021-10-29 11:57:56', '2021-10-29 11:57:56', NULL),
(51, '1635480252_575211fa858a16c6c770.png', 'E0101', 'ICE HOLLOW', 'ICE MATIC', 'E21 NANO A', 5, 545, 545, 620, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 6, 1, '2021-10-29 12:03:44', '2021-10-29 12:04:12', NULL),
(52, '1635480463_2f8808e64dbe4d95387b.png', 'E0102', 'ICE HOLLOW', 'ICE MATIC', 'E21 A', 7, 545, 340, 690, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 6, 1, '2021-10-29 12:07:43', '2021-10-29 12:07:43', NULL),
(53, '1635480528_5bcf15208fe82e982cfd.png', 'E0103', 'ICE HOLLOW', 'ICE MATIC', 'E25 A', 10, 545, 400, 690, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 6, 1, '2021-10-29 12:08:48', '2021-10-29 12:08:48', NULL),
(54, '1635480599_f47a739eebda09fcb2f3.png', 'E0104', 'ICE HOLLOW', 'ICE MATIC', 'E30 A', 10, 545, 400, 690, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 6, 1, '2021-10-29 12:09:59', '2021-10-29 12:09:59', NULL),
(55, '1635480667_897a0566078e37c32580.png', 'E0105', 'ICE HOLLOW', 'ICE MATIC', 'E35 A', 12, 545, 450, 690, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 6, 1, '2021-10-29 12:11:07', '2021-10-29 12:11:07', NULL),
(56, '1635486056_ec433296d0ef21e56037.png', 'E0106', 'ICE HOLLOW', 'ICE MATIC', 'E35 A', 12, 545, 545, 690, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 6, 1, '2021-10-29 12:11:08', '2021-10-29 13:40:56', NULL),
(57, '1635486081_f98360896db018b87bfb.png', 'E0107', 'ICE HOLLOW', 'ICE MATIC', 'E45A', 16, 600, 600, 693, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 6, 1, '2021-10-29 12:12:16', '2021-10-29 13:41:21', NULL),
(58, '1635486316_4fc25d729e745fdabdf4.png', 'E0108', 'ICE HOLLOW', 'ICE MATIC', 'E60 A', 52, 585, 600, 956, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 6, 1, '2021-10-29 13:45:16', '2021-10-29 13:45:16', NULL),
(59, '1635486367_1d7a14a11e7397b1a037.png', 'E0109', 'ICE HOLLOW', 'ICE MATIC', 'E75 A', 55, 585, 700, 956, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 6, 1, '2021-10-29 13:46:07', '2021-10-29 13:46:07', NULL),
(60, '1635486450_ab79b7d80ea29f744b58.png', 'E01010', 'ICE HOLLOW', 'ICE MATIC', 'E85 A', 55, 585, 700, 956, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 6, 1, '2021-10-29 13:47:30', '2021-10-29 13:47:30', NULL),
(61, '1635486524_c117405c482b89345bbe.png', 'E01011', 'ICE HOLLOW', 'ICE MATIC', 'E90 A', 68, 585, 800, 956, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 6, 1, '2021-10-29 13:48:44', '2021-10-29 13:48:44', NULL),
(62, '1635486710_f5f3303df3d08a3096aa.png', 'E01012', 'ICE CUBE MACHINE', 'ICE MATIC', 'M132 A', 53, 620, 560, 575, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 6, 1, '2021-10-29 13:51:50', '2021-10-29 13:51:50', NULL),
(63, '1635486940_3e93247e2e6463931142.png', 'E0111', 'UNDER COUNTER WAREWASHER & GLASSWASHER', 'WINTERHALTER', 'U50', 66, 600, 600, 822, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 7, 1, '2021-10-29 13:55:40', '2021-10-29 13:55:40', NULL),
(64, '1635487169_8e558aa977c0eee6b923.png', 'E0112', 'UNDER COUNTER WAREWASHER & GLASSWASHER', 'WINTERHALTER', 'UC -S', 59, 654, 460, 715, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 7, 1, '2021-10-29 13:59:29', '2021-10-29 13:59:29', NULL),
(65, '1635487380_8fd2b369d3b472cda5a2.png', 'E0113', 'DISHWASHING MACHINE', 'WINTERHALTER', 'PT- 500', 103, 750, 750, 850, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 7, 1, '2021-10-29 14:01:16', '2021-10-29 14:03:00', NULL),
(66, '1635487436_f269f5ae2d3b6e480c38.png', 'E0114', 'DISHWASHING MACHINE', 'WINTERHALTER', 'P50', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 7, 1, '2021-10-29 14:03:56', '2021-10-29 14:03:56', NULL),
(67, '1635487541_5fac4f83f581f204b8e3.png', 'E0115', 'DISHWASHING MACHINE', 'WINTERHALTER', 'C50 SINGLE TANK', 207, 800, 1300, 1420, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 7, 1, '2021-10-29 14:05:41', '2021-10-29 14:05:41', NULL),
(68, '1635487623_035c58a274351cfc1f7e.png', 'E0116', 'DISHWASHING MACHINE', 'WINTERHALTER', 'C50 DOUBLE TANK', 274, 1472, 1300, 1420, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 7, 1, '2021-10-29 14:07:03', '2021-10-29 14:07:03', NULL),
(69, '1635487793_f5eb117aca2b221c8cf3.png', 'E0121', 'OVEN COMBI STEAMER|SELF COOKING CENTER', 'RATIONAL', 'SCC WE 61 E', 110, 771, 847, 782, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 8, 1, '2021-10-29 14:09:53', '2021-10-29 14:09:53', NULL),
(70, '1635487910_00bdba0278eb3ea29c93.png', 'E0122', 'OVEN COMBI STEAMER|SELF COOKING CENTER', 'RATIONAL', 'SCC WE 62 E', 142.5, 971, 1069, 782, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 8, 1, '2021-10-29 14:11:50', '2021-10-29 14:11:50', NULL),
(71, '1635488019_39bb522e9335a91da547.png', 'E0123', 'OVEN COMBI STEAMER|SELF COOKING CENTER', 'RATIONAL', 'SCC WE 101 E', 135.5, 771, 847, 1042, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 8, 1, '2021-10-29 14:13:39', '2021-10-29 14:13:39', NULL),
(72, '1635488139_ab830df78c711bd72a9c.png', 'E0124', 'OVEN COMBI STEAMER|SELF COOKING CENTER', 'RATIONAL', 'SCC WE 102 E', 182, 971, 1069, 1042, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 8, 1, '2021-10-29 14:15:39', '2021-10-29 14:15:39', NULL),
(73, '1635488265_4ded4678cdd6dc994334.png', 'E0125', 'OVEN COMBI STEAMER|SELF COOKING CENTER', 'RATIONAL', 'SCC WE 201 E', 258, 791, 879, 1782, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 8, 1, '2021-10-29 14:17:45', '2021-10-29 14:17:45', NULL),
(74, '1635488409_feeaad72621b58c082ab.png', 'E0126', 'OVEN COMBI STEAMER|SELF COOKING CENTER', 'RATIONAL', 'SCC WE 202 E', 332, 996, 1084, 1782, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 8, 1, '2021-10-29 14:20:09', '2021-10-29 14:20:09', NULL),
(75, '1635488493_3409a200a4f243626fff.png', 'E0127', 'OVEN COMBI STEAMER|SELF COOKING CENTER', 'RATIONAL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 8, 1, '2021-10-29 14:21:33', '2021-10-29 14:21:33', NULL),
(76, '1635488702_af9dd3c2814a5fc0070c.png', 'E0128', 'OVEN COMBI STEAMER COMBI MASTER PLUS', 'RATIONAL', 'CMP 61 E', 110, 771, 847, 782, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 8, 1, '2021-10-29 14:25:02', '2021-10-29 14:25:02', NULL),
(77, '1635489001_c11efc322f6d0e265c27.png', 'E0129', 'OVEN COMBI STEAMER|COMBI MASTER PLUS', 'RATIONAL', 'CMP 62 E', 142.5, 971, 1069, 782, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 8, 1, '2021-10-29 14:30:01', '2021-10-29 14:30:01', NULL),
(78, '1635489268_630da3b58d81b62ee5f6.png', 'E01210', 'OVEN COMBI STEAMER COMBI MASTER PLUS', 'RATIONAL', 'CMP 101 E', 135.5, 771, 847, 1042, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 8, 1, '2021-10-29 14:34:28', '2021-10-29 14:34:28', NULL),
(79, '1635489418_6f4eb4937c6d89288f34.png', 'E01211', 'OVEN COMBI STEAMER COMBI MASTER PLUS', 'RATIONAL', 'CMP 102 E', 182, 971, 1069, 1042, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 8, 1, '2021-10-29 14:36:59', '2021-10-29 14:36:59', NULL),
(80, '1635489650_91c61bca633157a6772e.png', 'E01212', 'OVEN COMBI STEAMER COMBI MASTER PLUS', 'RATIONAL', 'CMP 201 E', 258, 791, 879, 1782, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 8, 1, '2021-10-29 14:40:50', '2021-10-29 14:40:50', NULL),
(81, '1635489710_b5a7acbb94bc198746e7.png', 'E01213', 'OVEN COMBI STEAMER COMBI MASTER PLUS', 'RATIONAL', 'CMP 202 E', 332, 996, 1084, 1782, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 8, 1, '2021-10-29 14:41:50', '2021-10-29 14:41:50', NULL),
(82, '1635490351_ff39633862e74164297d.png', 'E0131', 'CHEFTOP MIND . MAPS COMBI OVEN GN 11 PLUS', 'UNOX', 'XECC - 2011 EPR', 90, 862, 535, 984, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 14:52:31', '2021-10-29 14:52:31', NULL),
(83, '1635490413_9611db0698a533981eb7.png', 'E0132', 'CHEFTOP MIND . MAPS COMBI OVEN GN 11 PLUS', 'UNOX', 'XECC - 0513 EPR', 65, 862, 535, 649, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 14:53:33', '2021-10-29 14:53:33', NULL),
(84, '1635490474_b7e6211d62b998c6b0f7.png', 'E0133', 'CHEFTOP MIND . MAPS COMBI OVEN GN 11 PLUS', 'UNOX', 'XECC - 0523 EPR', 55, 862, 535, 649, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 14:54:34', '2021-10-29 14:54:34', NULL),
(85, '1635490641_9b41b49404926a20dc82.png', 'E0134', 'CHEFTOP MIND . MAPS COMBI OVEN GN 2/1 PLUS', 'UNOX', 'XEVC-2021-EPR', 0, 1207, 882, 1866, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 14:57:21', '2021-10-29 14:57:21', NULL),
(86, '1635490722_49b00ecdcd04ed0a8898.png', 'E0135', 'CHEFTOP MIND . MAPS COMBI OVEN GN 2/1 PLUS', 'UNOX', 'XEVC-1021-EPR', 0, 1120, 860, 1163, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 14:58:42', '2021-10-29 14:58:42', NULL),
(87, '1635491259_f53308bcf3f600f28f69.png', 'E0136', 'CHEFTOP MIND - MAPS COMBI OVEN GN 1/1 PLUS & ONE', 'UNOX', 'XEVC-2011-EPR', 0, 1043, 882, 1866, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 15:07:39', '2021-10-29 15:07:39', NULL),
(88, '1635491342_724fea93ea7be895f7e6.png', 'E0137', 'CHEFTOP MIND - MAPS COMBI OVEN GN 1/1 PLUS & ONE', 'UNOX', 'XEVC-1011-EPR', 0, 773, 750, 1010, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 15:09:02', '2021-10-29 15:09:02', NULL),
(89, '1635491447_24aba7c5bcb8e83db8b7.png', 'E0138', 'CHEFTOP MIND - MAPS COMBI OVEN GN 1/1 PLUS & ONE', 'UNOX', 'XEVC-0711-EPR', 0, 773, 750, 1010, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 15:10:47', '2021-10-29 15:10:47', NULL),
(90, '1635491505_1fd500a075a8a3c49729.png', 'E0139', 'CHEFTOP MIND - MAPS COMBI OVEN GN 1/1 PLUS & ONE', 'UNOX', 'XEVC-0511-EPR', 0, 776, 750, 1010, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 15:11:45', '2021-10-29 15:11:45', NULL),
(91, '1635491583_289c7ed46c19cc6aaa74.png', 'E01310', 'CHEFTOP MIND - MAPS COMBI OVEN GN 1/1 PLUS & ONE', 'UNOX', 'XEVC-0311-EPR', 0, 773, 750, 1010, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 15:13:03', '2021-10-29 15:13:03', NULL),
(92, '1635491664_39747a6268401d86e656.png', 'E01311', 'BAKERTOP - MAPS COMBI ACCESSORIES', 'UNOX', 'XEAQC-00E2-E', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 15:14:24', '2021-10-29 15:14:24', NULL),
(93, '1635492050_ccd4e70b545848065da5.png', 'E01312', 'BAKERTOP - MAPS COMBI ACCESSORIES', 'UNOX', 'XEVTC-2021', 72, 783, 743, 1717, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 15:15:16', '2021-10-29 15:20:50', NULL),
(94, '1635491745_ce30ffdfea24556c3d8a.png', 'E01312', 'BAKERTOP - MAPS COMBI ACCESSORIES', 'UNOX', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 15:15:45', '2021-12-14 16:05:42', NULL),
(95, '1635491936_94d61bc691833a9352c0.png', 'E01313', 'BAKERTOP - MAPS COMBI ACCESSORIES', 'UNOX', 'XEVC-0311-E1R', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 15:17:20', '2021-12-14 16:13:00', NULL),
(96, '1635492394_62df70ba833ce3d76d8f.png', 'E01314', 'CHEFLUX OVEN', 'UNOX', 'XV4093', 0, 1237, 1237, 1863, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 15:26:35', '2021-12-14 16:20:09', NULL),
(97, '1635492465_45a83df812bf8d9cd899.png', 'E01315', 'CHEFLUX OVEN', 'UNOX', 'XV1093', 0, 1237, 866, 1863, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 15:27:45', '2021-10-29 15:27:45', NULL),
(98, '1635492740_b30cd48e5bf2f29a3c38.png', 'E01316', 'CHEFLUX OVEN', 'UNOX', 'XV593', 0, 882, 860, 930, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 15:32:20', '2021-10-29 15:32:20', NULL),
(99, '1635492815_be198c9d609288edb198.png', 'E01317', 'CHEFLUX OVEN', 'UNOX', 'XV393', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 15:33:35', '2021-10-29 15:33:35', NULL),
(100, '1635492870_22910153d5604a93aa44.png', 'E01318', 'CHEFLUX OVEN', 'UNOX', 'XEVTC-102P', 65, 724, 743, 1711, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 15:34:30', '2021-10-29 15:34:30', NULL),
(101, '1635493098_1549a2bbe9b9b963e954.png', 'E01319', 'BAKERTOP MIND - MAPS COMBI OVENS', 'UNOX', 'XEBC-16EU-EPR', 0, 1043, 882, 1866, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 15:38:18', '2021-10-29 15:38:18', NULL),
(102, '1635493190_f7db39baf3662eb13bef.png', 'E01320', 'BAKERTOP MIND - MAPS COMBI OVENS', 'UNOX', 'XEBC-10EU-EPR', 130, 957, 860, 1163, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 15:39:50', '2021-10-29 15:39:50', NULL),
(103, '1635493253_edd0ab7233898bdfad49.png', 'E01321', 'BAKERTOP MIND - MAPS COMBI OVENS', 'UNOX', 'XEBC-06EU-EPR', 110, 957, 860, 843, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 15:40:53', '2021-10-29 15:40:53', NULL),
(104, '1635493341_598cdd51b19bfb64a6eb.png', 'E01322', 'BAKERTOP MIND - MAPS COMBI OVENS', 'UNOX', 'XEBC-04EU-EPR', 85, 957, 860, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 15:42:21', '2021-10-29 15:42:21', NULL),
(105, '1635493386_41d809d07c608db69e6f.png', 'E01323', 'BAKERTOP MIND - MAPS COMBI OVENS', 'UNOX', 'XEEC-1011-EPR', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 15:43:06', '2021-10-29 15:43:06', NULL),
(106, '1635493424_7bd9c859b03c76e1ee0e.png', 'E01324', 'BAKERTOP MIND - MAPS COMBI OVENS', 'UNOX', 'XEVQC-0011-E', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 15:43:44', '2021-10-29 15:43:44', NULL),
(107, '1635493467_144eead4a86efd9d4563.png', 'E01325', 'BAKERTOP MIND - MAPS COMBI OVENS', 'UNOX', 'XEERC-0811-H', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 15:44:27', '2021-10-29 15:44:27', NULL),
(108, '1635493865_485180b8090e972e8606.png', 'E01326', 'BAKERLUX OVEN', 'UNOX', 'XB 895', 112, 880, 860, 1250, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 15:51:05', '2021-10-29 15:51:05', NULL),
(109, '1635493942_3a2778e49ff6ba52e29b.png', 'E01327', 'BAKERLUX OVEN', 'UNOX', 'XB 695', 80, 882, 860, 930, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 15:52:22', '2021-10-29 15:52:22', NULL),
(110, '1635494009_7a108c6962bbfa59a5a5.png', 'E01328', 'BAKERLUX OVEN', 'UNOX', 'XB 1083', 177, 997, 866, 1863, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 15:53:29', '2021-10-29 15:53:29', NULL),
(111, '1635494187_0fc7ea41e5eb3d400fc9.png', 'E01329', 'BAKERLUX OVEN', 'UNOX', 'XB 893', 112, 882, 860, 1250, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 15:56:27', '2021-10-29 15:56:27', NULL),
(112, '1635494255_99022ab8be5bc2e032bf.png', 'E01330', 'BAKERLUX OVEN', 'UNOX', 'XB 693', 80, 957, 860, 675, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 15:57:35', '2021-10-29 15:57:35', NULL),
(113, '1635494456_f0d934a5e28ff5a62a92.png', 'E01331', 'BAKERLUX SHOPPRO | CAMILLA & VICTORIA ', 'UNOX', 'XEFT-10EU-EMRV ', 96, 829, 800, 952, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 16:00:56', '2021-10-29 16:00:56', NULL),
(114, '1635494542_201cbadde5b49633f12d.png', 'E01332', 'BAKERLUX SHOPPRO | CAMILLA & VICTORIA ', 'UNOX', 'XEFT-10EU-ETRV-MT', 96, 957, 860, 853, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 16:02:22', '2021-10-29 16:02:22', NULL),
(115, '1635494613_30fe8e025686d351bea4.png', 'E01333', 'BAKERLUX SHOPPRO | CAMILLA & VICTORIA ', 'UNOX', 'XEFT-06EU-EMRV ', 72, 829, 800, 682, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 16:03:33', '2021-10-29 16:03:33', NULL),
(116, '1635494675_920cc892afcaf26908ad.png', 'E01334', 'BAKERLUX SHOPPRO | CAMILLA & VICTORIA ', 'UNOX', 'XEFT-06EU-ETRV-MT', 72, 829, 800, 682, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 16:04:36', '2021-10-29 16:04:36', NULL),
(117, '1635494921_151f37423a19bb7174ff.png', 'E01335', 'ROSSELLA & ELENA ', 'UNOX', 'XEFT-04EU-EMRV ', 57, 811, 800, 502, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 16:08:41', '2021-10-29 16:08:41', NULL),
(118, '1635495015_6b01c6c0b49e892a5612.png', 'E01336', 'ROSSELLA & ELENA ', 'UNOX', 'XEFT-04EU-ETRV', 57, 811, 800, 500, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 16:10:15', '2021-10-29 16:10:15', NULL),
(119, '1635495107_df15a90abdb0e4b6238b.png', 'E01337', 'ROSSELLA & ELENA ', 'UNOX', 'XEFT-03EU-EMRV ', 46, 811, 800, 427, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 16:11:47', '2021-10-29 16:11:47', NULL),
(120, '1635495169_28c51d0058f85e9c55bc.png', 'E01338', 'ROSSELLA & ELENA ', 'UNOX', 'XEFT-03EU-ETRV', 46, 811, 800, 500, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 16:12:49', '2021-10-29 16:12:49', NULL),
(121, '1635495417_823edb621ba7fd49db04.png', 'E01339', 'ARIANNA & STEFANIA ', 'UNOX', 'XEFT-04HS-EMRV ', 39, 669, 600, 502, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 16:16:57', '2021-10-29 16:16:57', NULL),
(122, '1635495480_4278a031bb465173017c.png', 'E01340', 'ARIANNA & STEFANIA ', 'UNOX', 'XEFT-04HS-ETDV', 39, 669, 600, 500, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 16:18:00', '2021-10-29 16:18:00', NULL),
(123, '1635495550_6c0bc8684fc0c6b088cb.png', 'E01341', 'ARIANNA & STEFANIA ', 'UNOX', 'XEFT-03HS-EMRV ', 36, 669, 600, 427, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 16:19:10', '2021-10-29 16:19:10', NULL),
(124, '1635495608_1c8f899467c7022c3fba.png', 'E01342', 'ARIANNA & STEFANIA ', 'UNOX', 'XEFT-03HS-ETRV', 36, 669, 600, 425, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 16:20:08', '2021-10-29 16:20:08', NULL),
(125, '1635495750_483320be6dadbc518c23.png', 'E01343', 'CHEFTOP MIND MAPS & BAKERTOP ACCESSORIES', 'UNOX', 'XUC-001', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 16:22:30', '2021-10-29 16:22:30', NULL),
(126, '1635496185_43f4168604df6f6befea.png', 'E01344', 'UNOX ACCESSORIES', 'UNOX', 'XEBDC-10EU-D', 100, 1150, 860, 400, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 16:29:45', '2021-10-29 16:29:45', NULL),
(127, '1635496273_64cf15c051059ad298c9.png', 'E01345', 'PANINI GRILL/SPIDO COOK', 'UNOX', 'XP 010 PR MANUAL', 10, 456, 331, 176, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 16:31:13', '2021-10-29 16:31:13', NULL),
(128, '1635496331_7a76f8f89b73fac1b12b.png', 'E01346', 'PANINI GRILL/SPIDO COOK', 'UNOX', 'XEBDC-02EU-D', 100, 1150, 860, 400, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 16:32:11', '2021-10-29 16:32:11', NULL),
(129, '1635496404_36412c4c45e5e0cd895a.png', 'E01347', 'PANINI GRILL/SPIDO COOK', 'UNOX', 'XEBDC-12EU-C', 45, 890, 862, 762, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 16:33:24', '2021-10-29 16:33:24', NULL),
(130, '1635496466_a0ef171bc7e894d799df.png', 'E01348', 'PANINI GRILL/SPIDO COOK', 'UNOX', 'XEKPT-10EU-C', 42, 729, 800, 886, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 16:34:26', '2021-10-29 16:34:26', NULL),
(131, '1635496536_f6c8ee4f7dfa172e18de.png', 'E01349', 'PANINI GRILL/SPIDO COOK', 'UNOX', 'XL 415', 38, 890, 86, 805, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 16:35:36', '2021-10-29 16:35:36', NULL),
(132, '1635496609_10636af48cf657763528.png', 'E01350', 'PANINI GRILL/SPIDO COOK', 'UNOX', 'XL 413', 38, 890, 862, 805, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 16:36:49', '2021-10-29 16:36:49', NULL),
(133, '1635496723_1c1175538d0cf3c72959.png', 'E01351', 'PANINI GRILL/SPIDO COOK', 'UNOX', 'XC 595', 0, 1028, 860, 297, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 16:38:43', '2021-10-29 16:38:43', NULL),
(134, '1635496775_f744fb10057f7a2c7b0c.png', 'E01352', 'PANINI GRILL/SPIDO COOK', 'UNOX', 'XEBHC-HCEU', 0, 1145, 860, 240, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-10-29 16:39:35', '2021-10-29 16:39:35', NULL),
(135, '1635497080_894e51f1c03eed912771.png', 'E0151', 'GENERAL  PLANETARY MIXER', 'GENERAL', 'GEM130', 450, 620, 700, 1200, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 10, 1, '2021-10-29 16:44:40', '2021-10-29 16:44:40', NULL),
(136, '1635497143_be7455f5e39b934f925f.png', 'E0152', 'GENERAL  PLANETARY MIXER', 'GENERAL', 'GEM120', 227, 700, 680, 780, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 10, 1, '2021-10-29 16:45:43', '2021-10-29 16:45:43', NULL),
(137, '1635497204_744472214a7e49bb591e.png', 'E0153', 'GENERAL  PLANETARY MIXER', 'GENERAL', 'GEM 110', 166, 250, 160, 190, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 10, 1, '2021-10-29 16:46:44', '2021-10-29 16:46:44', NULL),
(138, '1635498214_8de5e29026c93b946838.png', 'E0141', 'SPIRAL MIXER | VEGETABLE CUTTER | PLANETARY MIXER', 'FIMAR', '7/SN', 0, 280, 560, 570, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 11, 1, '2021-10-29 17:03:34', '2021-10-29 17:03:34', NULL),
(139, '1635558913_01d024520cfcaa982aab.png', 'E0142', 'SPIRAL MIXER VEGETABLE CUTTER PLANETARY MIXER', 'FIMAR', '12/CNS', 0, 350, 650, 620, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 11, 1, '2021-10-30 09:55:13', '2021-10-30 09:55:13', NULL),
(140, '1635558993_cd0d8b25df22163dfdf8.png', 'E0143', 'SPIRAL MIXER VEGETABLE CUTTER PLANETARY MIXER', 'FIMAR', '18/CNS', 0, 390, 670, 620, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 11, 1, '2021-10-30 09:56:33', '2021-10-30 09:56:33', NULL),
(141, '1635559234_ae2ffba93c18d02910cb.png', 'E0144', 'SPIRAL MIXER VEGETABLE CUTTER PLANETARY MIXER', 'FIMAR', '38/CNS', 0, 480, 800, 730, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 11, 1, '2021-10-30 09:57:38', '2021-10-30 10:00:34', NULL),
(142, '1635559313_29c0709ff78424d402fa.png', 'E0145', 'SPIRAL MIXER VEGETABLE CUTTER PLANETARY MIXER', 'FIMAR', '50/SN', 0, 530, 920, 920, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 11, 1, '2021-10-30 10:01:53', '2021-10-30 10:01:53', NULL),
(143, '1635559383_b25c7970940b904d48fa.png', 'E0146', 'SPIRAL MIXER VEGETABLE CUTTER PLANETARY MIXER', 'FIMAR', '4000  \'\'L\'ORTOLANA', 0, 630, 280, 550, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 11, 1, '2021-10-30 10:03:03', '2021-10-30 10:03:03', NULL),
(144, '1635559518_7e5ab80c2bcc7e955ea1.png', 'E0147', 'SPIRAL MIXER VEGETABLE CUTTER PLANETARY MIXER', 'FIMAR', '4000  \'\'L\'ORTOLANA\"', 0, 630, 280, 550, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 11, 1, '2021-10-30 10:05:18', '2021-10-30 10:05:18', NULL),
(145, '1635559599_58e04ae60611c66074d7.png', 'E0148', 'SPIRAL MIXER VEGETABLE CUTTER PLANETARY MIXER', 'FIMAR', '2000R \'LA ROMAGNOLA\"', 0, 610, 220, 520, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 11, 1, '2021-10-30 10:06:39', '2021-10-30 10:06:39', NULL),
(146, '1635559671_f505accf09e2f26bbf2d.png', 'E0149', 'SPIRAL MIXER VEGETABLE CUTTER PLANETARY MIXER', 'FIMAR', '2000R \'LA ROMAGNOLA\"', 0, 610, 220, 520, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 11, 1, '2021-10-30 10:07:51', '2021-10-30 10:07:51', NULL),
(147, '1635559747_fde74aa322ce81c325e8.png', 'E01410', 'SPIRAL MIXER VEGETABLE CUTTER PLANETARY MIXER', 'FIMAR', 'LT7OR', 0, 400, 1200, 400, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 11, 1, '2021-10-30 10:09:07', '2021-10-30 10:09:07', NULL),
(148, '1635559828_d5040bdf22eeb81136ed.png', 'E01411', 'SPIRAL MIXER VEGETABLE CUTTER PLANETARY MIXER', 'FIMAR', 'LT14OR', 0, 450, 1550, 450, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 11, 1, '2021-10-30 10:10:28', '2021-10-30 10:10:28', NULL),
(149, '1635559914_8446e7353fb9d0c86238.png', 'E01412', 'SPIRAL MIXER VEGETABLE CUTTER PLANETARY MIXER', 'FIMAR', 'LT7VE', 0, 450, 400, 1050, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 11, 1, '2021-10-30 10:11:54', '2021-10-30 10:11:54', NULL),
(150, '1635559983_71d5c421e2843311ec84.png', 'E01413', 'SPIRAL MIXER VEGETABLE CUTTER PLANETARY MIXER', 'FIMAR', 'LT14VE', 0, 450, 450, 1400, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 11, 1, '2021-10-30 10:13:03', '2021-10-30 10:13:03', NULL),
(151, '1635560056_c141d6633d3bf8794d1a.png', 'E01414', 'SPIRAL MIXER VEGETABLE CUTTER PLANETARY MIXER', 'FIMAR', 'PLN20BV', 0, 400, 550, 640, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 11, 1, '2021-10-30 10:14:16', '2021-10-30 10:14:16', NULL),
(152, '1635560123_83e37e6906df76d61005.png', 'E01415', 'SPIRAL MIXER VEGETABLE CUTTER PLANETARY MIXER', 'FIMAR', 'PLN 80V', 0, 680, 1000, 1600, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 11, 1, '2021-10-30 10:15:24', '2021-10-30 10:15:24', NULL),
(153, '1635560255_0f96c2e23b30908b4c99.png', 'E01416', 'SPIRAL MIXER VEGETABLE CUTTER PLANETARY MIXER', 'FIMAR', 'RH50', 0, 150, 240, 390, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 11, 1, '2021-10-30 10:17:35', '2021-10-30 10:17:35', NULL),
(154, '1635560390_75514f03876e86a504d9.png', 'E01417', 'SPIRAL MIXER VEGETABLE CUTTER PLANETARY MIXER', 'FIMAR', 'SE1550 ', 0, 400, 530, 850, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 11, 1, '2021-10-30 10:19:50', '2021-10-30 10:19:50', NULL),
(155, '1635560443_46ec8b76bdfdd8363a06.png', 'E01418', 'SPIRAL MIXER VEGETABLE CUTTER PLANETARY MIXER', 'FIMAR', 'SE1550 ', 0, 400, 530, 850, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 11, 1, '2021-10-30 10:20:43', '2021-10-30 10:20:43', NULL),
(156, '1635560504_f2491014fea1e8faa841.png', 'E01419', 'SPIRAL MIXER VEGETABLE CUTTER PLANETARY MIXER', 'FIMAR', 'SV25 ', 0, 350, 640, 330, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 11, 1, '2021-10-30 10:21:44', '2021-10-30 10:21:44', NULL),
(157, '1635560579_5301f7f08a294a2339ad.png', 'E01420', 'SPIRAL MIXER VEGETABLE CUTTER PLANETARY MIXER', 'FIMAR', 'PPN10M ', 0, 770, 400, 860, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 11, 1, '2021-10-30 10:22:59', '2021-10-30 10:22:59', NULL),
(158, '1635560924_ef4e884dd8cf4aae5df3.png', 'E0161', 'HATCO', 'HATCO', 'GRAH 36', 22, 153, 914, 64, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 12, 1, '2021-10-30 10:28:44', '2021-10-30 10:28:44', NULL),
(159, '1635560973_efbfaa1727dc5e58034f.png', 'E0162', 'HATCO', 'HATCO', 'GRAH 24', 22, 153, 914, 64, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 12, 1, '2021-10-30 10:29:33', '2021-10-30 10:29:33', NULL),
(160, '1635561029_b2705937c0ffb43088b6.png', 'E0163', 'HATCO', 'HATCO', 'TPT 230-4', 67, 359, 343, 235, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 12, 1, '2021-10-30 10:30:29', '2021-10-30 10:30:29', NULL),
(161, '1635561100_e47c13e19d499a058fc3.png', 'E0164', 'HATCO', 'HATCO', 'TM 10 H', 22.5, 416, 368, 387, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 12, 1, '2021-10-30 10:31:40', '2021-10-30 10:31:40', NULL),
(162, '1635561313_c534ce0582a60d102a3f.png', 'E0181', 'DECK RICE COOKER ', 'PRAIM', 'PMRCE-150P/N', 0, 755, 715, 905, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 13, 1, '2021-10-30 10:35:13', '2021-10-30 10:35:13', NULL),
(163, '1635561403_23b5b61918d00a9b1e54.png', 'E0182', 'DECK RICE COOKER ', 'PRAIM', 'PMRCE-100P/N', 0, 755, 715, 1.27, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 13, 1, '2021-10-30 10:36:43', '2021-10-30 10:36:43', NULL),
(164, '1635561856_19948242b5c67a7e1643.png', 'E0191', 'IRONING TABLES', 'ROTONDI', 'PVT 38', 0, 590, 1500, 900, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 14, 1, '2021-10-30 10:44:16', '2021-10-30 10:44:16', NULL),
(165, '1635561921_257bc3dd2b5ee8840d71.png', 'E0192', 'FROM FINISHER', 'ROTONDI', 'QAD2', 0, 1200, 800, 1900, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 14, 1, '2021-10-30 10:45:21', '2021-10-30 10:45:21', NULL),
(166, '1635561985_84412e7d64f391adde29.png', 'E0193', 'AIR OPERATED PRESS BL-DRY CLEANING PRESSES SERIES', 'ROTONDI', 'BL CO-90', 0, 1300, 1400, 1200, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 14, 1, '2021-10-30 10:46:25', '2021-10-30 10:46:25', NULL),
(167, '1635562039_c9737f0cba171aaa24f6.png', 'E0194', 'SPOTTING BOARD', 'ROTONDI', 'EC 76-C', 0, 420, 1200, 900, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 14, 1, '2021-10-30 10:47:19', '2021-10-30 10:47:19', NULL),
(168, '1635562097_ab15035a136b01acf1dc.png', 'E0195', 'GARMENT CONVEYOR', 'ROTONDI', 'I-220CONV', 0, 1400, 3685, 2100, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 14, 1, '2021-10-30 10:48:17', '2021-10-30 10:48:17', NULL),
(169, '1635562292_d3351b2d1a7717559a61.png', 'E0211', 'HAND SINK', 'HAN SINK', 'Ss304', 0, 500, 450, 520, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 15, 1, '2021-10-30 10:51:32', '2021-10-30 10:51:32', NULL),
(170, '1635562712_1776f99b0d466252ae2c.png', 'E0221', 'CONDENSING UNIT & AIR COOLER', 'ESSA', '02NJSGY', 0, 83, 68, 601, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 16, 1, '2021-10-30 10:58:32', '2021-10-30 10:58:32', NULL),
(171, '1635562778_36c07a5ff4de50720f8c.png', 'E0222', 'CONDENSING UNIT & AIR COOLER', 'ESSA', 'EST-4.9JS', 0, 288, 41, 3412, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 16, 1, '2021-10-30 10:59:38', '2021-10-30 10:59:38', NULL),
(172, '1635563297_62aac09da5a3a4cc036b.png', 'E0171', 'ROYAL | COFEE MACHINE ', 'ROYAL', 'DIADEMA', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 17, 1, '2021-10-30 11:08:17', '2021-10-30 11:08:17', NULL),
(173, '1635563341_ebed6c97f9f7623c3d12.png', 'E0172', 'ROYAL | COFEE MACHINE ', 'ROYAL', 'SYNCHRO SB', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 17, 1, '2021-10-30 11:09:01', '2021-10-30 11:09:01', NULL),
(174, '1635563388_a77d60e58c200a79e9d1.png', 'E0173', 'ROYAL | COFEE MACHINE ', 'ROYAL', 'SYNCHRO', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 17, 1, '2021-10-30 11:09:48', '2021-10-30 11:09:48', NULL),
(175, '1635563430_d766c5875126d883fa02.png', 'E0174', 'ROYAL | COFEE MACHINE ', 'ROYAL', 'VALLELUNGA', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 17, 1, '2021-10-30 11:10:30', '2021-10-30 11:10:30', NULL),
(176, '1635563702_0785cc3f53be307412a2.png', 'E0201', 'GELATO SHOWCASE', 'MEHEN', 'MC 10', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 18, 1, '2021-10-30 11:15:02', '2021-10-30 11:15:02', NULL),
(177, '1635563780_f92fcdcbf45bdd024d79.png', 'E0202', 'GELATO SHOWCASE', 'MEHEN', 'MC 12', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 18, 1, '2021-10-30 11:16:20', '2021-10-30 11:16:20', NULL),
(178, '1635563836_48d7b9fd542b10e61d9e.png', 'E0203', 'ICE MACHINE', 'MEHEN', 'MS 118', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 18, 1, '2021-10-30 11:17:16', '2021-10-30 11:17:16', NULL),
(179, '1635563921_4dbd04a6c9570580bd38.png', 'E0204', 'ICE MACHINE', 'MEHEN', 'MS 336C', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 18, 1, '2021-10-30 11:18:41', '2021-10-30 11:18:41', NULL),
(180, '1635563966_1a53ce056e708117924a.png', 'E0205', 'ICE MACHINE', 'MEHEN', 'MS 336CA', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 18, 1, '2021-10-30 11:19:26', '2021-10-30 11:19:26', NULL),
(181, '1635564302_ceb8af66ceff12550386.png', 'E0021', 'UPRIGHT', 'ATM COOL', 'CHILLER AR-2', 73, 760, 660, 1965, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 11:25:02', '2021-10-30 11:25:02', NULL),
(182, '1635564379_4d3b1477ebef4c557bdb.png', 'E0022', 'UPRIGHT', 'ATM COOL', 'Freezer AF2', 75, 760, 660, 1965, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 11:26:19', '2021-10-30 11:26:19', NULL),
(183, '1635564465_a7c184dcd7521496180d.png', 'E0023', 'UPRIGHT', 'ATM COOL', 'Chiller Freezer RF2', 75, 760, 660, 1965, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 11:27:45', '2021-10-30 11:27:45', NULL),
(184, '1635564662_13dcff49d6e5eedf406e.png', 'E0024', 'UPRIGHT', 'ATM COOL', 'CHILLER AR-4', 135, 760, 1220, 1965, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 11:31:02', '2021-10-30 11:31:02', NULL),
(185, '1635564752_033054fc2fadd414e799.png', 'E0025', 'UPRIGHT', 'ATM COOL', 'Freezer AF-4', 135, 760, 1220, 1965, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 11:32:32', '2021-10-30 11:32:32', NULL),
(186, '1635564825_504e654a335ea2bd1731.png', 'E0026', 'UPRIGHT', 'ATM COOL', 'Chiller Freezer ARF4', 122, 760, 1220, 1965, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 11:33:45', '2021-10-30 11:33:45', NULL),
(187, '1635564972_8a40663828758ec1620b.png', 'E0027', 'UPRIGHT', 'ATM COOL', 'CHILLER AR-18', 165, 760, 1837, 1965, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 11:36:12', '2021-10-30 11:36:12', NULL),
(188, '1635565042_541960c701615727195d.png', 'E0028', 'UPRIGHT', 'ATM COOL', 'Freezer AF18', 165, 760, 1837, 1965, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 11:37:22', '2021-10-30 11:37:22', NULL),
(189, '1635565122_2b7ad3f6808cb1daa4a0.png', 'E0029', 'UPRIGHT', 'ATM COOL', 'Chiller Freezer ARF18', 157, 760, 1837, 1965, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 11:38:42', '2021-10-30 11:38:42', NULL),
(190, '1635565370_cb7063d1a759231cfd75.png', 'E00230', 'UNDERCOUNTER', 'ATM COOL', 'Chiller AWR12', 65, 750, 1200, 850, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 11:42:50', '2021-10-30 11:42:50', NULL),
(191, '1635565471_d211dbdd7975048247d2.png', 'E00231', 'UNDERCOUNTER', 'ATM COOL', 'Freezer AWF12', 60, 750, 1200, 850, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 11:44:31', '2021-10-30 11:44:31', NULL),
(192, '1635565545_81a5b17dd18a34be845c.png', 'E00232', 'UNDERCOUNTER', 'ATM COOL', 'Chiller AWR15', 70, 750, 1500, 850, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 11:45:45', '2021-10-30 11:45:45', NULL),
(193, '1635565630_c3445859c3554c2a32e5.png', 'E00233', 'UNDERCOUNTER', 'ATM COOL', 'Chiller AWR15T60', 70, 600, 1500, 850, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 11:47:10', '2021-10-30 11:47:10', NULL),
(194, '1635565699_cf8eb65029d9fb80987b.png', 'E00234', 'UNDERCOUNTER', 'ATM COOL', 'Freezer AWF15', 70, 750, 1500, 850, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 11:48:19', '2021-10-30 11:48:19', NULL),
(195, '1635565902_48ec28f369a1bb5121ec.png', 'E00235', 'UNDERCOUNTER', 'ATM COOL', 'Chiller AWR18', 80, 750, 1800, 850, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 11:51:42', '2021-10-30 11:51:42', NULL),
(196, '1635565971_9863b52382d58127454b.png', 'E00236', 'UNDERCOUNTER', 'ATM COOL', 'Freezer AWF18', 80, 750, 1800, 850, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 11:52:51', '2021-10-30 11:52:51', NULL),
(197, '1635566028_26191d9f72304ecccd43.png', 'E00237', 'UNDERCOUNTER', 'ATM COOL', 'AWR18G', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 11:53:48', '2021-10-30 11:53:48', NULL),
(198, '1635566107_ae803b4701caeaadfc03.png', 'E00238', 'UNDERCOUNTER', 'ATM COOL', 'Chiller AWR2000', 80, 750, 2025, 850, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 11:55:07', '2021-10-30 11:55:07', NULL),
(199, '1635566163_6f8408186cf3072dd49a.png', 'E00239', 'UNDERCOUNTER', 'ATM COOL', 'Freezer AWF2000', 80, 800, 2025, 850, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 11:56:03', '2021-10-30 11:56:03', NULL),
(200, '1635566293_31ff1f910d42b34a0105.png', 'E00240', 'UNDERCOUNTER', 'ATM COOL', 'Chiller Glass Door 150 CG', 70, 750, 1500, 850, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 11:58:13', '2021-10-30 11:58:13', NULL),
(201, '1635566426_9f34bf212cfbad55e1fc.png', 'E00241', 'UNDERCOUNTER', 'ATM COOL', 'Chiller Glass Door 1800CG', 80, 750, 1800, 850, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 12:00:26', '2021-10-30 12:00:26', NULL),
(202, '1635566484_2e8c23ba52664fa45529.png', 'E00242', 'UNDERCOUNTER', 'ATM COOL', 'Chiller 200CG', 100, 800, 2025, 850, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 12:01:24', '2021-10-30 12:01:24', NULL),
(203, '1635571868_17213f0112838157dd73.png', 'E00243', 'UNDERCOUNTER CHILLER DRAWER PASSTHROUGHT & SALADETE', 'ATM COOL', 'ATM - AWR15 -D4', 70, 750, 1500, 850, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 13:31:08', '2021-10-30 13:31:08', NULL),
(204, '1635571950_9cb37f5bc50bf9bb7e85.png', 'E00244', 'UNDERCOUNTER CHILLER DRAWER PASSTHROUGHT & SALADETE', 'ATM COOL', 'ATM AWR 135 D4', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 13:32:30', '2021-10-30 13:32:30', NULL),
(205, '1635572044_d419f46a5876bf52cb0b.png', 'E00245', 'UNDERCOUNTER CHILLER DRAWER PASSTHROUGHT & SALADETE', 'ATM COOL', 'ATM - AWR18 -D6', 30, 750, 1800, 850, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 13:34:04', '2021-10-30 13:34:04', NULL),
(206, '1635572115_62de6bfe971cfafc1efa.png', 'E00246', 'UNDERCOUNTER CHILLER DRAWER PASSTHROUGHT & SALADETE', 'ATM COOL', 'ATM - 150R-P', 70, 800, 1500, 850, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 13:35:15', '2021-10-30 13:35:15', NULL),
(207, '1635572166_86fb758cf2c6b024532a.png', 'E00247', 'UNDERCOUNTER CHILLER DRAWER PASSTHROUGHT & SALADETE', 'ATM COOL', 'ATM - 150R-P GD', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 13:36:06', '2021-10-30 13:36:06', NULL),
(208, '1635572235_72dd5752d0cc98f01571.png', 'E00248', 'UNDERCOUNTER CHILLER DRAWER PASSTHROUGHT & SALADETE', 'ATM COOL', 'ATM-R-PS900', 120, 750, 900, 1075, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 13:37:15', '2021-10-30 13:37:15', NULL),
(209, '1635572385_4866b021227c73a78a76.png', 'E00249', 'UNDERCOUNTER PIZZA RANGE', 'ATM COOL', 'ATM - 1500 PH', 0, 800, 1500, 1070, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 13:39:45', '2021-10-30 13:39:45', NULL),
(210, '1635572440_31128619cb41a2c70ad4.png', 'E00250', 'UNDERCOUNTER PIZZA RANGE', 'ATM COOL', 'ATM - 2025PH', 0, 800, 2025, 1070, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 13:40:40', '2021-10-30 13:40:40', NULL),
(211, '1635572642_380748330be715d73160.png', 'E00251', 'COUNTER TOP PIZZA W/GN PAN', 'ATM COOL', 'ATM-VRX1500GN 1/3x6', 65, 395, 1500, 430, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 13:44:02', '2021-10-30 13:44:02', NULL),
(212, '1635572736_ce4ffb89c7f9633e82c2.png', 'E00252', 'COUNTER TOP PIZZA W/GN PAN', 'ATM COOL', 'ATM-VRX1500GN 1/4x7', 65, 395, 2500, 430, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 13:45:36', '2021-10-30 13:45:36', NULL),
(213, '1635572896_f009f4a27dd68d08dce5.png', 'E00253', 'DISPLAY FREEZER FOR ICE CREAM (-25˚C)', 'ATM COOL', 'ATM - 550 R', 0, 820, 686, 2050, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 13:48:16', '2021-10-30 13:48:16', NULL),
(214, '1635572967_edb9a86d6ff8dccc9678.png', 'E00254', 'DISPLAY FREEZER FOR ICE CREAM (-25˚C)', 'ATM COOL', 'ATM - 550 F', 0, 820, 686, 2050, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 13:49:27', '2021-10-30 13:49:27', NULL),
(215, '1635573274_8990af298eebc1f90a92.png', 'E00255', 'DISPLAY COOLER', 'ATM COOL', 'ATM LC 278', 0, 510, 590, 1780, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 13:54:34', '2021-10-30 13:54:34', NULL),
(216, '1635573328_93c113584c2b4332bdc6.png', 'E00256', 'DISPLAY COOLER', 'ATM COOL', 'ATM LC 318', 0, 510, 590, 1980, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 13:55:28', '2021-10-30 13:55:28', NULL);
INSERT INTO `items` (`id`, `item_image`, `item_code`, `item_name`, `item_merk`, `item_type`, `item_weight`, `item_length`, `item_width`, `item_height`, `item_hpp`, `item_before_sale`, `item_discount`, `item_sale`, `item_profit`, `item_description`, `item_warehouse_a`, `item_warehouse_b`, `item_warehouse_c`, `item_warehouse_d`, `item_stock`, `category_id`, `supplier_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(217, '1635573394_fccd3efc73367936f131.png', 'E00257', 'DISPLAY COOLER', 'ATM COOL', 'ATM LC 668', 0, 510, 1000, 1850, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 13:56:34', '2021-10-30 13:56:34', NULL),
(218, '1635573474_1a8188f3faaaff8d3eee.png', 'E00258', 'DISPLAY COOLER', 'ATM COOL', 'ATM LC  768', 0, 620, 1200, 2040, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 13:57:54', '2021-10-30 13:57:54', NULL),
(219, '1635573537_f371ab9dcfa57997602e.png', 'E00259', 'DISPLAY COOLER', 'ATM COOL', 'LC-968', 0, 620, 1500, 2040, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 13:58:57', '2021-10-30 13:58:57', NULL),
(220, '1635573601_d771cf49eba351f13255.png', 'E00260', 'DISPLAY COOLER', 'ATM COOL', 'LC-1268', 0, 620, 1800, 2040, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 14:00:01', '2021-10-30 14:00:01', NULL),
(221, '1635573670_6d45ed3ba1e13e637853.png', 'E00261', 'DISPLAY COOLER', 'ATM COOL', 'LS-718FJ', 0, 630, 1130, 1980, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 14:01:10', '2021-10-30 14:01:10', NULL),
(222, '1635573732_b60b9f596ed6f24e83dc.png', 'E00262', 'DISPLAY COOLER', 'ATM COOL', 'LS-1098FJ', 0, 630, 1830, 1980, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 14:02:12', '2021-10-30 14:02:12', NULL),
(223, '1635574050_21f14b377771c3ba9020.png', 'E00263', 'ICE MACHINE', 'ATM COOL', 'ATM-AC-80X', 0, 580, 400, 700, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 14:07:30', '2021-10-30 14:07:30', NULL),
(224, '1635574124_c7c31e7e7b37130be8c9.png', 'E00264', 'ICE MACHINE', 'ATM COOL', 'ATM-AC-120X', 580, 400, 700, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 14:08:44', '2021-10-30 14:08:44', NULL),
(225, '1635574188_aa20c8558944b8887692.png', 'E00265', 'ICE MACHINE', 'ATM COOL', 'ATM-AC-150X', 0, 650, 700, 700, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 14:09:48', '2021-10-30 14:09:48', NULL),
(226, '1635574264_494e93b9f9a41496d577.png', 'E00266', 'ICE MACHINE', 'ATM COOL', 'ATM-AC-270X', 0, 750, 900, 700, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 14:11:04', '2021-10-30 14:11:04', NULL),
(227, '1635574338_6255b0e995896da6d288.png', 'E00267', 'ICE MACHINE', 'ATM COOL', 'ATM-AC-120', 0, 570, 530, 790, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 14:12:18', '2021-10-30 14:12:18', NULL),
(228, '1635574402_854259b11de8d738ffbf.png', 'E00268', 'ICE MACHINE', 'ATM COOL', 'ATM-AM-250', 0, 608, 340, 708, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 14:13:22', '2021-10-30 14:13:22', NULL),
(229, '1635574482_5f9023f28d4630b15436.png', 'E00269', 'ICE MACHINE', 'ATM COOL', 'ATM-AC-700', 0, 860, 760, 660, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 14:14:42', '2021-10-30 14:14:42', NULL),
(230, '1635574665_9a08b095904402114762.png', 'E00270', 'ICE MACHINE', 'ATM COOL', 'ATM-AC-700', 0, 860, 860, 660, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 14:14:43', '2021-10-30 14:17:45', NULL),
(231, '1635574714_30a64b84fa33445d3761.png', 'E00271', 'ICE MACHINE', 'ATM COOL', 'ATM-SC-500', 0, 860, 860, 660, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 14:15:32', '2021-10-30 14:18:34', NULL),
(233, '1635575134_ac74afd685b56f21dfdc.png', 'E00272', 'CURVE GLASS CAKE SHOW CASE', 'ATM COOL', 'ATM1-90', 0, 660, 900, 1200, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 14:25:34', '2021-10-30 14:25:34', NULL),
(234, '1635575221_332d59704715d1d7ae86.png', 'E00273', 'CURVE GLASS CAKE SHOW CASE', 'ATM COOL', 'ATM1-120', 660, 900, 1200, 1200, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 14:27:01', '2021-10-30 14:27:01', NULL),
(235, '1635575288_4765d676811e33bcc650.png', 'E00274', 'CURVE GLASS CAKE SHOW CASE', 'ATM COOL', 'ATM1-150', 0, 660, 1500, 1200, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 14:28:08', '2021-10-30 14:28:08', NULL),
(236, '1635575352_281681c50cbc6e1ee53a.png', 'E00275', 'CURVE GLASS CAKE SHOW CASE', 'ATM COOL', 'ATM1-180', 0, 660, 1800, 1200, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 14:29:12', '2021-10-30 14:29:12', NULL),
(237, '1635575569_05f92527bbbae37cd2ae.png', 'E00276', 'RECTANGULAR CAKE SHOWCASE', 'ATM COOL', 'ATM2-90', 0, 660, 900, 1200, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 14:32:49', '2021-10-30 14:32:49', NULL),
(238, '1635575620_5f1b0c80f1f3d2b65fa8.png', 'E00277', 'RECTANGULAR CAKE SHOWCASE', 'ATM COOL', 'ATM2-120', 0, 660, 1200, 1200, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 14:33:40', '2021-10-30 14:33:40', NULL),
(239, '1635575687_fbb082ed04aac81b4ab8.png', 'E00278', 'RECTANGULAR CAKE SHOWCASE', 'ATM COOL', 'ATM2-150', 0, 660, 1500, 1200, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 14:34:47', '2021-10-30 14:34:47', NULL),
(240, '1635575737_1bda5d43b5e83ee49948.png', 'E00279', 'RECTANGULAR CAKE SHOWCASE', 'ATM COOL', 'ATM2-180', 0, 660, 1800, 1200, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 14:35:37', '2021-10-30 14:35:37', NULL),
(241, '1635576063_6628010c1ee761372d5b.png', 'E00280', 'DISPLAY COOLER', 'ATM COOL', 'ATM LC 290', 0, 500, 600, 1920, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 14:41:03', '2021-10-30 14:41:03', NULL),
(242, '1635576131_449a83371925c1ec8b14.png', 'E00281', 'DISPLAY COOLER', 'ATM COOL', 'ATM LC 660', 0, 550, 1200, 2000, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 14:42:11', '2021-10-30 14:42:11', NULL),
(243, '1635576189_7aa8b7b1d6be20e635ef.png', 'E00282', 'DISPLAY COOLER', 'ATM COOL', 'ATM LC 1010', 0, 550, 1800, 2000, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 14:43:09', '2021-10-30 14:43:09', NULL),
(244, '1635576432_85c4e75b248f43fdfb6c.png', 'E00283', 'DEEP FREEZER ( STORAGE BASKET )', 'ATM COOL', 'ATM BD 398', 0, 700, 1130, 850, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 14:47:12', '2021-10-30 14:47:12', NULL),
(245, '1635576495_930a7ea64d7cc518bcfd.png', 'E00284', 'DEEP FREEZER ( STORAGE BASKET )', 'ATM COOL', 'ATM BD 598', 0, 700, 1720, 850, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 14:48:15', '2021-10-30 14:48:15', NULL),
(246, '1635576546_b6d778faded2d2d552c5.png', 'E00285', 'DEEP FREEZER ( STORAGE BASKET )', 'ATM COOL', 'ATM BD 698', 0, 700, 1960, 850, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 14:49:06', '2021-10-30 14:49:06', NULL),
(247, '1635576672_fc2e78eb502250d28cdf.png', 'E00286', 'Open Showcase', 'ATM COOL', 'ATM LC1500 A', 0, 1000, 1000, 2000, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 14:51:12', '2021-12-14 16:20:55', NULL),
(248, '1635576732_76f78f978ce249b001d2.png', 'E00287', 'Open Showcase', 'ATM COOL', 'ATM LC2500 A', 0, 1000, 2500, 2000, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 14:52:12', '2021-10-30 14:52:12', NULL),
(249, '1635576848_e16275c628f4f0df5568.png', 'E00288', 'FRESH MEAT CABINET', 'ATM COOL', 'ATM F1500', 0, 1050, 1500, 1200, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 14:54:08', '2021-10-30 14:54:08', NULL),
(250, '1635576968_afcb19eac3e1b3e6f295.png', 'E00289', 'BASKETS', 'ATM COOL', 'ATM-545', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 14:56:08', '2021-10-30 14:56:08', NULL),
(251, '1635577006_5444eea1bc96e04937ac.png', 'E00290', 'BASKETS', 'ATM COOL', 'USF-725', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 14:56:46', '2021-10-30 14:56:46', NULL),
(252, '1635577062_1a896a448fc901dfc3da.png', 'E00291', 'BASKETS', 'ATM COOL', 'A1-328L', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 14:57:42', '2021-10-30 14:57:42', NULL),
(253, '1635577211_881d382b819682cca491.png', 'E00292', 'CURVE GLASS CAKE SHOW CASE', 'ATM COOL', 'ATM A1', 0, 660, 1200, 1190, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 15:00:12', '2021-10-30 15:00:12', NULL),
(254, '1635577291_2758c1cf94ba5d180f78.png', 'E00293', 'CURVE GLASS CAKE SHOW CASE', 'ATM COOL', 'ATM A1', 0, 660, 1500, 1190, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 15:01:31', '2021-10-30 15:01:31', NULL),
(255, '1635577391_1c86f93d057ba456d6d7.png', 'E00294', 'RECTANGULAR CAKE SHOWCASE', 'ATM COOL', 'ATM A2', 0, 660, 900, 1130, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 15:03:11', '2021-10-30 15:03:11', NULL),
(256, '1635577441_0cd94bc7fb936e136338.png', 'E00295', 'RECTANGULAR CAKE SHOWCASE', 'ATM COOL', 'ATM A2', 0, 660, 1200, 1130, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-10-30 15:04:01', '2021-10-30 15:04:01', NULL),
(258, '1639709992_6a0c2d333b5b9044c80c.jpg', 'E0231', 'CAKE SHOWCASE', 'RSA', 'S-950A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 1, 0, 1, 20, 1, '2021-12-17 10:53:05', '2021-12-17 10:59:52', NULL),
(259, '1639710177_5cfaed3fe1aebb34e324.jpg', 'E0232', 'PASTRY WARMER', 'RSA', 'S-950H', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 20, 1, '2021-12-17 11:02:57', '2021-12-17 11:02:57', NULL),
(260, '1639710341_6e8f287bc80b8921e126.jpg', 'E0233', 'BEER COOLER ', 'RSA', 'EXPO - 280BC', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 1, 0, 0, 1, 20, 1, '2021-12-17 11:05:41', '2021-12-17 11:05:41', NULL),
(261, '1639710480_0fb0829e8d5400d57168.png', 'E0234', 'TURBO 3 DECK STEAMER ', 'RSA', '3DGF-9082', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 1, 0, 1, 20, 1, '2021-12-17 11:08:01', '2021-12-17 11:08:01', NULL),
(262, '1639710591_4e7c67090c9b975c6802.jpg', 'E0235', 'GAS GRIDDLE', 'RSA', 'RPD-4', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 1, 0, 0, 1, 20, 1, '2021-12-17 11:09:51', '2021-12-17 11:09:51', NULL),
(263, '1639710754_026dc6c1f5086765a8f9.jpg', 'E0236', 'GAS CONVECTION OVEN', 'RSA', 'NFC 3D', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 1, 0, 1, 20, 1, '2021-12-17 11:12:34', '2021-12-17 11:12:34', NULL),
(264, '1639710997_0dbe06472a3000991f8f.jpg', 'E0237', 'GASW CHOING FEN BLOWER STEAMER ', 'RSA', 'CS-1211', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 1, 0, 1, 20, 1, '2021-12-17 11:15:59', '2021-12-17 11:16:37', NULL),
(265, '1639711176_d520005b52485fe9e407.jpg', 'E0238', 'UPRIGHT FREEZER 4 DOORS', 'RSA', 'GEA URF1200-4D', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 1, 0, 0, 1, 20, 1, '2021-12-17 11:18:15', '2021-12-17 11:19:36', NULL),
(266, '1639711257_ecef63c60e627e79d479.jpg', 'E0239', 'UNDERCOUNTER CHILLER 2 GLASS', 'RSA', 'UCC1800', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 1, 0, 0, 1, 20, 1, '2021-12-17 11:20:57', '2021-12-17 11:20:57', NULL),
(267, '1639711392_f35927bb9acbe7d4bbb8.jpg', 'E02310', 'ARTUGO CHEST FREEZER', 'RSA', 'CF 201', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 20, 1, '2021-12-17 11:23:12', '2021-12-17 11:23:12', NULL),
(268, '1639711504_40a9e3750ea4f62296a5.png', 'E02311', 'ARTUGO DISPLAY COOLER ', 'RSA', 'SH 100 A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 20, 1, '2021-12-17 11:25:04', '2021-12-17 11:25:04', NULL),
(269, '1639711721_890d4e0835e179d3e0d7.jpg', 'E02312', 'SLIDING GLASS FLAT FREEZER', 'RSA', 'SD 186', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 1, 0, 0, 1, 20, 1, '2021-12-17 11:27:54', '2021-12-17 11:28:41', NULL),
(270, '1639711804_e1976079462cc7ce410c.jpg', 'E02313', 'WINE COOLER', 'RSA', 'XW 85', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 20, 1, '2021-12-17 11:30:04', '2021-12-17 11:30:04', NULL),
(271, '1639711956_4da8fdc27b852c657b8d.jpg', 'E02314', 'RSA', 'RSA', 'SD 256', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 1, 0, 0, 1, 20, 1, '2021-12-17 11:31:49', '2021-12-17 11:32:36', NULL),
(272, '1639712057_e8867f8e856b2227885c.jpg', 'E02315', 'UPRIGHT CHILLER 2 DOORS', 'RSA', 'URC-550-2D', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 20, 1, '2021-12-17 11:34:17', '2021-12-17 11:34:17', NULL),
(273, '1639712151_4820e9bf2bfbe5a67646.png', 'E02316', 'ELECTRIC DEEP FRYER', 'RSA', 'EF 81', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 1, 0, 1, 20, 1, '2021-12-17 11:35:51', '2021-12-17 11:35:51', NULL),
(274, '1639712391_963661a2b66ba7c155d0.jpg', 'E02317', 'CAKE SHOWCASE', 'RSA', 'MM 750 V', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 1, 0, 1, 20, 1, '2021-12-17 11:39:51', '2021-12-17 11:39:51', NULL),
(275, '1639712452_d3842ff813f475fb89db.jpg', 'E02318', 'HOT BOX RENTAL', 'RSA', 'GETRA', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 3, 0, 0, 3, 20, 1, '2021-12-17 11:40:52', '2021-12-17 11:40:52', NULL),
(276, '1639712489_67c438075ea75081ce08.jpg', 'E02319', 'SUSHI SHOWCASE (G-180LA)', 'RSA', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 1, 0, 1, 20, 1, '2021-12-17 11:41:29', '2021-12-17 11:41:29', NULL),
(277, '1639712544_5bbb9d1182d6c9ae8e2f.jpg', 'E02320', 'BTU : 163.000 Blower : 220V/250W', 'RSA', 'SE-CS1095', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 1, 0, 0, 0, 1, 20, 1, '2021-12-17 11:42:24', '2021-12-17 11:42:24', NULL),
(278, '1639712636_7e816928dd448838a02e.jpg', 'E02321', 'BTU : 2 X 163,000 Blower : 220V/250W', 'RSA', 'SE-CS1995DX', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 20, 1, '2021-12-17 11:43:56', '2021-12-17 11:43:56', NULL),
(279, '1639712763_523c61edd04a51c94205.jpg', 'E02322', 'BTU : 2 X 163,000 Blower : 220V/250W', 'RSA', 'SE-DBR48/96ADX', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 1, 0, 0, 1, 20, 1, '2021-12-17 11:46:03', '2021-12-17 11:46:03', NULL),
(280, '1639712816_8e016193d8b0d6694387.jpg', 'E02323', 'GAS RICE COOKER', 'RSA', 'GETRA', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 20, 1, '2021-12-17 11:46:56', '2021-12-17 11:46:56', NULL),
(281, '1639712896_7487814c5433014f3eac.png', 'E02324', 'FOOD DEHIDRATOR', 'RSA', 'ST-01', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 20, 1, '2021-12-17 11:48:17', '2021-12-17 11:48:17', NULL),
(282, '1639712947_a1208fea8321fa5a6122.png', 'E02325', 'SLIDING FLAT GLASS FREEZER', 'RSA', 'SD 132 P', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 20, 1, '2021-12-17 11:49:08', '2021-12-17 11:49:08', NULL),
(283, '1639712999_2b5d0a4f601e675062e9.png', 'E02326', 'SLIDING FLATT FREEZER', 'RSA', 'SD 100', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 20, 1, '2021-12-17 11:49:59', '2021-12-17 11:49:59', NULL),
(284, '1639713048_182c5eaff760b76254eb.png', 'E02327', 'LIFT UP GLASS FREEZER', 'RSA', 'SD 100 F', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 1, 0, 0, 1, 20, 1, '2021-12-17 11:50:48', '2021-12-17 11:50:48', NULL),
(285, '1639713105_0ccfadd77d338d9e25f6.png', 'E02328', 'CAKE SHOWCASE', 'RSA', 'A 530 V', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 20, 1, '2021-12-17 11:51:45', '2021-12-17 11:51:45', NULL),
(286, '1639713140_b3ba115072000a7da752.png', 'E02329', 'CHEST FREEZER', 'RSA', 'AB 396 TX', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 20, 1, '2021-12-17 11:52:21', '2021-12-17 11:52:21', NULL),
(287, '1639713188_e771219683765ccf6577.png', 'E02330', 'DISPLAY COOLER 2 PINTU', 'RSA', 'EXPO 600 AH', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 20, 1, '2021-12-17 11:53:08', '2021-12-17 11:53:08', NULL),
(288, '1639713382_95ca5357b34cd3eef390.jpg', 'E02331', 'MESIN SERUT BAWANG', 'MESIN SERUT BAWANG', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 1, 0, 1, 20, 1, '2021-12-17 11:55:42', '2021-12-17 11:56:22', NULL),
(289, '1639713479_8447eccdd447306c55ab.jpg', 'E02332', 'UNDERCOUNTER CHILLER 3 DOORS', 'ROYALEDDY', 'PA3100 TN', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 1, 0, 0, 1, 20, 1, '2021-12-17 11:57:59', '2021-12-17 11:57:59', NULL),
(290, '1639713584_fa2f9040cd4e54f65db7.png', 'E02333', 'ICE MACHINE CAP 200 KG', 'ROYALEDDY', 'AC 215', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 20, 1, '2021-12-17 11:59:09', '2021-12-17 11:59:45', NULL),
(291, '1639713682_8dba994c0ec2bb399c86.png', 'E02334', 'GAS SUPER GRILL W/ADJUSTABLE GRILL', 'NAYATI', 'NGSG 8-75 1W', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 1, 0, 1, 20, 1, '2021-12-17 12:01:22', '2021-12-17 12:01:22', NULL),
(292, '1639713800_c9bbec4d37fd8991232e.jpg', 'E02335', 'DISHWASHING MACHINE HOOD TYPE', 'GTEX', 'GT-DIM EC/RP', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 1, 0, 1, 20, 1, '2021-12-17 12:03:20', '2021-12-17 12:03:20', NULL),
(293, '1639713896_730e419bccbccec65b15.jpg', 'E02336', 'DOUGH ROUND & DIVIDER', 'SINMAG', 'SM 330', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 20, 1, '2021-12-17 12:04:56', '2021-12-17 12:04:56', NULL),
(294, '1639713983_9748240bef943765c7b9.jpg', 'E02337', 'CERAMIC INDUCTION ELECTRIC', 'OLIS', '72/10TVTC', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 1, 0, 0, 0, 1, 20, 1, '2021-12-17 12:06:23', '2021-12-17 12:06:23', NULL),
(295, '1639714171_adad628d890bdeb9ded0.jpg', 'E02338', 'ELECTRIC EXHAUST HOOD & FLEXIBLE DUKTING', 'ELECTRIC EXHAUST HOOD & FLEXIBLE DUKTING', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 1, 0, 1, 20, 1, '2021-12-17 12:09:31', '2021-12-17 12:09:31', NULL),
(296, '1639714251_e4fff896613d5f36cbfa.png', 'E02339', 'GLASSTENDER CUSTOM', 'ELECTRIC EXHAUST HOOD & FLEXIBLE DUKTING', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 1, 0, 0, 0, 1, 20, 1, '2021-12-17 12:10:51', '2021-12-17 12:10:51', NULL),
(297, '1639714331_dfacf453f59f7490a6e5.png', 'E02340', 'PASTA COOKER', 'BRENDAN', 'MAAG80PC-16', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 2, 0, 0, 2, 20, 1, '2021-12-17 12:12:11', '2021-12-17 12:12:11', NULL),
(298, '1639714503_37c4418442b7d1a4155b.png', 'E02341', 'UPRIGHT COMBI 4 DOOR', 'BRENDAN ', 'Q1000', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 20, 1, '2021-12-17 12:15:03', '2021-12-17 12:15:03', NULL),
(299, '1639714552_ec86ed71ac954d35abdf.png', 'E02342', 'UPRIGHT CHILLER 4 DOOR', 'BRENDAN', 'G1000', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 20, 1, '2021-12-17 12:15:53', '2021-12-17 12:15:53', NULL),
(300, '1639714663_80f50595243f81e0b764.png', 'E02343', 'UPRIGHT FREZER 4 DOOR', 'BRENDAN', 'D1000', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 20, 1, '2021-12-17 12:16:58', '2021-12-17 12:17:43', NULL),
(301, '1639714728_107a615ede4626c28c69.png', 'E02344', 'PLANETARY MIXER CAP 20LT', 'BRENDAN', 'B20', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 20, 1, '2021-12-17 12:18:49', '2021-12-17 12:18:49', NULL),
(302, '1639714788_15419ef20d265e4e8c3b.png', 'E02345', 'CHEST FREEZER ', 'BRENDAN', 'BD-350', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 20, 1, '2021-12-17 12:19:49', '2021-12-17 12:19:49', NULL),
(303, '1639714845_cfb3ba4c1427bdea8c7d.png', 'E02346', 'DISPLAY COOLER ', 'BRENDAN', 'SRM PT330', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 1, 0, 0, 1, 20, 1, '2021-12-17 12:20:45', '2021-12-17 12:20:45', NULL),
(304, '1639714901_450588152b3a97918713.png', 'E02347', 'WINE COOLER', 'BRENDAN', 'SBC-P245K', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 20, 1, '2021-12-17 12:21:41', '2021-12-17 12:21:41', NULL),
(305, '1639715000_64ec73859cdd2ee379c7.png', 'E02348', 'WINE COOLER', 'BRENDAN', 'SBC-P729K', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 1, 0, 0, 1, 20, 1, '2021-12-17 12:22:52', '2021-12-17 12:23:20', NULL),
(306, '1639715246_50684173d31e213fe678.jpg', 'E02349', '10Lt PLANETARY MIXER CAP 10LT', 'BRENDAN', 'QM 10L', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 20, 1, '2021-12-17 12:25:20', '2021-12-17 12:27:26', NULL),
(307, '1639715175_16885c1966b23c7a4e5b.jpg', 'E02350', 'PROFER 15 TRAY', 'BRENDAN', 'FSL-15B', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 1, 0, 0, 1, 20, 1, '2021-12-17 12:26:15', '2021-12-17 12:26:15', NULL),
(308, '1639793261_34fa74dde5d8cb84d872.png', 'S1011', 'TOP GRILL', 'SUN EAST ', 'G15', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 21, 1, '2021-12-18 10:07:41', '2021-12-18 10:07:41', NULL),
(309, '1639793338_30198606db976e3e0797.png', 'S1O12', 'TOP GRILL', 'SUN EAST ', 'G42(Y-007)', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 21, 1, '2021-12-18 10:08:58', '2021-12-18 10:08:58', NULL),
(310, '1639793382_75a431cb3277a387dfaa.png', 'S1013', 'TOP GRILL', 'SUN EAST ', 'G50', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 21, 1, '2021-12-18 10:09:42', '2021-12-18 10:09:42', NULL),
(311, '1639793946_3bfa19579c34ebf36d03.png', 's1014', 'BURNER LOW FOR STOCK POT', 'SUN EAST ', 'B002D', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 21, 1, '2021-12-18 10:12:56', '2021-12-18 10:19:06', NULL),
(312, '1639793628_5221b96031d6159a4604.png', 's1015', 'TUNGKU FOR STOCK POT', 'SUN EAST ', 'G38', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 21, 1, '2021-12-18 10:13:48', '2021-12-18 10:13:48', NULL),
(313, '1639793897_20b66f6418abf1a20b24.png', 'S1016', 'TUNGKU FOR STOVE', 'SUN EAST ', 'G41', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 21, 1, '2021-12-18 10:18:17', '2021-12-18 10:18:17', NULL),
(314, '1639794006_42815eccd067a63ca35c.png', 'S1017', 'GRILL GROOVE', 'SUN EAST ', 'G45', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 21, 1, '2021-12-18 10:20:06', '2021-12-18 10:20:06', NULL),
(315, '1639794078_f09c01778233c5dc9300.png', 'S1018', 'TUNGKU FOR STOVE', 'SUN EAST ', 'G43 (Y-004)', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 21, 1, '2021-12-18 10:21:18', '2021-12-18 10:21:18', NULL),
(316, '1639794144_8cd018b67958997e5945.png', 'S1019', 'BURNER FRONT FOR STOVE', 'SUN EAST ', 'B007A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 21, 1, '2021-12-18 10:22:24', '2021-12-18 10:22:24', NULL),
(317, '1639794638_2ecc099e4b749311fcba.png', 'S10110', 'BURNER REAR FOR STOVE', 'SUN EAST ', 'B007B', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 21, 1, '2021-12-18 10:30:38', '2021-12-18 10:30:38', NULL),
(318, '1639794706_ee722188d7e2aedae8f5.png', 'S10111', 'BURNER I  FOR OVEN ', 'SUN EAST ', 'A20', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 21, 1, '2021-12-18 10:31:46', '2021-12-18 10:31:46', NULL),
(319, '1639794800_5fca5541a0a8bc3dbf3b.png', 'S10112', 'BURNER W FOR GRILL, GRIDDLE AND OVEN', 'SUN EAST ', 'A21', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 21, 1, '2021-12-18 10:33:20', '2021-12-18 10:33:20', NULL),
(320, '1639794849_f2ff1c9ac2b9bdba8319.png', 'S10113', 'GREASE FILTER', 'SUN EAST ', 'FA1-495*495', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 21, 1, '2021-12-18 10:34:09', '2021-12-18 10:34:09', NULL),
(321, '1639794887_acb11902c7e4bbb53961.png', 'S10114', 'GREASE FILTER', 'SUN EAST ', 'FS1-495*495', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 21, 1, '2021-12-18 10:34:47', '2021-12-18 10:34:47', NULL),
(322, '1639794925_71a7c57343cede1e9bc2.png', 'S10115', 'GREASE FILTER', 'SUN EAST ', 'F45-495*495', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 21, 1, '2021-12-18 10:35:25', '2021-12-18 10:35:25', NULL),
(323, '1639794966_003d05a97e4ad4a32d29.png', 'S10116', 'FEET ', '09131510-70', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 21, 1, '2021-12-18 10:36:06', '2021-12-18 10:36:06', NULL),
(324, '1639795790_d89b97e72a6e133fb7ea.jpg', 'S1021', 'COMPRESSOR FFI  8,5 HBK ', 'ATM COOL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-12-18 10:44:13', '2021-12-18 10:49:50', NULL),
(325, '1639795923_a2acce32f682ed9dc4af.jpg', 'S1022', 'COMPRESSOR FFI 12HBK', 'ATM COOL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-12-18 10:46:09', '2021-12-18 10:52:03', NULL),
(326, '1639795978_dcc05493ab3b755fd64c.jpg', 'S1023', 'COMPRESSOR  NEK2168GK', 'ATM COOL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-12-18 10:46:41', '2021-12-18 10:52:58', NULL),
(327, '1639796027_db3047da3934381a9190.jpg', 'S1024', 'COMPRESSOR  NEU2178GK ', 'ATM COOL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-12-18 10:47:24', '2021-12-18 10:53:47', NULL),
(331, '1639811980_fae1c051313dfaa20700.jpg', 'S1025', 'CONDENSOR A4 4', 'ATM COOL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-12-18 15:19:40', '2021-12-18 15:19:40', NULL),
(332, '1639812082_0a0fcbeca7c6c97b4c83.jpg', 'S1026', 'CONDENSOR AF2/AF6/AWF15', 'ATM COOL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-12-18 15:21:22', '2021-12-18 15:21:22', NULL),
(333, '1639812161_34219dd74b84eebea153.jpg', 'S1027', 'CONDENSOR AR6/2 AWR15/18', 'ATM COOL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-12-18 15:22:41', '2021-12-18 15:22:41', NULL),
(334, '1639812204_c8216f1606f3eebf04bd.jpg', 'S1028', 'CONDENSOR AR 4', 'ATM COOL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-12-18 15:23:24', '2021-12-18 15:23:24', NULL),
(335, '1639812256_540b4245fd8e7f898e76.jpg', 'S1029', 'DIGITAL THERMOSTAT CHILLER', 'ATM COOL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-12-18 15:24:16', '2021-12-18 15:24:16', NULL),
(336, '1639812300_e59fed08f39d1780d74f.jpg', 'S10210', 'DIGITAL THERMOSTAT  FREEZER', 'ATM COOL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-12-18 15:25:00', '2021-12-18 15:25:00', NULL),
(337, '1639812420_495ff17cc6874c0169ad.jpg', 'S10211', 'STEROVOM EVEB UPRIGHT ', 'ATM COOL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-12-18 15:27:00', '2021-12-18 15:27:00', NULL),
(338, '1639812470_92c394c1c8eacc7ca3b1.jpg', 'S10212', 'EVAPORATOR UCC', 'ATM COOL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-12-18 15:27:50', '2021-12-18 15:27:50', NULL),
(339, '1639812577_7fcf106da0fbcd7c6825.jpg', 'S10213', 'EVAPORATOR UCF ', 'ATM COOL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-12-18 15:28:37', '2021-12-18 15:29:37', NULL),
(340, '1639812630_6b53f725047f5ce61271.jpg', 'S10214', 'EVAPORATOR AR2/AR6', 'ATM COOL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-12-18 15:30:30', '2021-12-18 15:30:30', NULL),
(341, '1639812667_b690ba1933fe7627fae2.jpg', 'S10215', 'EVAPORATOR AWF 15', 'ATM COOL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-12-18 15:31:07', '2021-12-18 15:31:07', NULL),
(342, '1639812725_005bf6bd9464676cbe71.jpg', 'S10216', 'Door Switch', 'ATM COOL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-12-18 15:32:05', '2021-12-18 15:32:05', NULL),
(343, '1639812761_1b150dd0fae05527435a.jpg', 'S10217', 'FAN BLOWER ', 'ATM COOL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-12-18 15:32:41', '2021-12-18 15:32:41', NULL),
(344, '1639812816_20ccbf536208cf173305.jpg', 'S10218', 'KARET PINTU UCC 69X55', 'ATM COOL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-12-18 15:33:36', '2021-12-18 15:33:36', NULL),
(345, '1639812900_246b84892919a34d6c52.jpg', 'S10219', 'KARET PINTU UCC 55X53', 'ATM COOL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-12-18 15:34:24', '2021-12-18 15:35:00', NULL),
(346, '1639812935_d56c5ccc6cd012c59cb3.jpg', 'S10220', 'COMPRESSOR FR 8.5 G', 'ATM COOL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-12-18 15:35:35', '2021-12-18 15:35:35', NULL),
(347, '1639812991_f7b4f3f8d06a4e5944ff.jpg', 'S10221', 'COMPRESSOR AE 8036 BR', 'ATM COOL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-12-18 15:36:31', '2021-12-18 15:36:31', NULL),
(348, '1639813022_f2ae69eaecff26a48741.jpg', 'S10222', 'FAN CONDENSOR 16 KW', 'ATM COOL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-12-18 15:37:02', '2021-12-18 15:37:02', NULL),
(349, '1639813084_a69980e6658c8f77126f.jpg', 'S10223', 'COMPRESOR TFH 24802', 'ATM COOL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 19, 1, '2021-12-18 15:38:05', '2021-12-18 15:38:05', NULL),
(350, '1639813632_00a5a5855fc6f0830682.jpg', 'S1081', 'HEATING ELEMENT 1500 W 230 V 750&80-100', 'OZTI', '6246.0002.00', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 15:47:12', '2021-12-18 15:47:12', NULL),
(351, '1639813719_d0dffc24f14344811fb4.jpg', 'S1082', 'SAFETY THERMOSTAT 365 C', 'OZTI', '6234.0001.26', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 4, 0, 0, 0, 4, 4, 1, '2021-12-18 15:48:39', '2022-01-07 12:00:17', NULL),
(352, '1639813788_c7392c72aec5b1af226b.jpg', 'S1083', 'ENERGY REGULATOR ', 'OZTI', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 15:49:48', '2021-12-18 15:49:48', NULL),
(353, '1639813872_7ec3e8b22c40ee3ac1d7.jpg', 'S1084', 'THERMOSTAT 50-300 C MONOPHASE', 'OZTI', '6234.0001.05', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 15:51:12', '2021-12-18 15:51:12', NULL),
(354, '1639814017_b96caec9a312db4330bd.jpg', 'S1085', 'LIMIT SWITCH FOR PAN OF BRATT PANS', 'OZTI', '6232.00007.02', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 15:53:37', '2021-12-18 15:53:37', NULL),
(355, '1639814074_28f1e3f5195c6c3a2034.jpg', 'S1086', 'SIGNAL LAMP BLACK BODY GREEN LENS NEON', 'OZTI', '6251.00004.31', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 15:54:35', '2021-12-18 15:54:35', NULL),
(356, '1639814130_3810a6e480f2bc616c29.jpg', 'S1087', 'SIGNAL LAMP BLACK BODY RED LENS NEON', 'OZTI', '6251.00004.30', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 15:55:30', '2021-12-18 15:55:30', NULL),
(357, '1639814202_564d05a3e65770dc4c05.jpg', 'S1088', 'CONTACTOR', 'OZTI', '6230.00014.06', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 15:56:42', '2021-12-18 15:56:42', NULL),
(358, '1639814292_8fb9f5506cf3d0a910ce.jpg', 'S1089', 'DEPO RESISTANCE 2000W ', 'OZTI', '9099.01000.00 / 6246.0012.110', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 15:58:12', '2021-12-18 15:58:12', NULL),
(359, '1639814352_fb332291a5397a8fe287.jpg', 'S10810', 'WASHING NAVEL', 'OZTI', '2710.F0024.03', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 15:59:12', '2021-12-18 15:59:12', NULL),
(360, '1639814407_b2c180abbb2e571a44e6.jpg', 'S10811', 'PLASTIC SEAL-BLACK ( EXT DIM 69 / DIM IN ', 'OZTI', '6226.00004.040', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:00:07', '2021-12-18 16:00:07', NULL),
(361, '1639814563_4cf2eaa35d0ca865fb4e.jpg', 'S10812', 'DRAIN PIPE ', 'OZTI', '626200028000', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:01:38', '2021-12-18 16:02:43', NULL),
(362, '1639814621_63ca5e83221b0a5a5349.jpg', 'S10813', 'WATER DISCHARGE HOSE 30X250 CM DOUBLE SIDED', 'OZTI', '6262.00021.13', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:03:41', '2021-12-18 16:03:41', NULL),
(363, '1639814673_225bf0d4a0fbdefb112a.jpg', 'S10814', 'HEATING ELEMENT 9000 W IRCA INCOLAY 800', 'OZTI', '9099.01000.06', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:04:33', '2021-12-18 16:04:33', NULL),
(364, '1639814732_7696a02ce9add2e1c56a.jpg', 'S10815', 'RINSE AID CONNECTION CHECK VALVE ', 'OZTI', '6262.30666.013', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:05:32', '2021-12-18 16:05:32', NULL),
(365, '1639814807_0b488dbbc1639d8c1670.jpg', 'S10815', 'Y HOSE FOR RINSING OBM ( HALF TANK )', 'OZTI', '6262.00021.65', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:06:47', '2021-12-18 16:06:47', NULL),
(366, '1639814924_3b6ccf612ee54486702a.jpg', 'S10816', '3/4 PLASTIC VALVE ', 'OZTI', '6262.00008.00', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:08:11', '2021-12-18 16:08:44', NULL),
(367, '1639814972_5af218a31dca29c92fff.jpg', 'S10817', 'COVER SWITCH ', 'OZTI', '6232.00005.10', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:09:32', '2021-12-18 16:09:32', NULL),
(368, '1639815027_6675f1a68382a743d795.jpg', 'S10818', 'NAVEL AXLES', 'OZTI', '6262.00041.03', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:10:27', '2021-12-18 16:10:27', NULL),
(369, '1639815088_001a5ae069b8b179c04f.jpg', 'S10819', 'WASHING & RINSING ARM ( COMPLETELT ) PLST', 'OZTI', '6262.00033.33', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:11:28', '2021-12-18 16:11:28', NULL),
(370, '1639815152_61994d6886dd57c36af6.jpg', 'S10820', 'WATER LEVEL SWITCH ', 'OZTI', '6262.00007.00', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:12:32', '2021-12-18 16:12:32', NULL),
(371, '1639815250_ed85d2d48c6d19b1f290.jpg', 'S10821', 'PRESSURE SWITCH CONNECTION HOSE Q8*4M', 'OZTI', '6262.00021.07', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:14:10', '2021-12-18 16:14:10', NULL),
(372, '1639815289_28bbef5e66c44d73f158.jpg', 'S10822', 'BUTTON LAS1-AWY-11ZT BLUE 220V IP65', 'OZTI', '6232.00011.41', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:14:49', '2021-12-18 16:14:49', NULL),
(373, '1639815342_09117211c6a8b26f40f9.jpg', 'S10823', 'BUTTON BLUE 220 V ', 'OZTI', '6232.00011.42', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:15:42', '2021-12-18 16:15:42', NULL),
(374, '1639815400_5a7750624a2ad7b396be.jpg', 'S10824', 'THERMOSTAT  30-120 OC EGO ', 'OZTI', '6234.00001.19', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:16:40', '2021-12-18 16:16:40', NULL),
(375, '1639815442_eaa0ec0156c913dce77c.jpg', 'S10825', 'THERMOSTAT  LIMIT 170 OC EGO ', 'OZTI', '6234.00001.68', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:17:22', '2021-12-18 16:17:22', NULL),
(376, '1639815495_23b44582b2b422830e67.jpg', 'S10826', 'TIME  RELAY RR-WT5B', 'OZTI', '6231.00019.22', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:18:15', '2021-12-18 16:18:15', NULL),
(377, '1639815541_da37f8505399501c8ba3.jpg', 'S10821', 'AIR TRAP', 'OZTI', '6262.00026.00', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:19:01', '2021-12-18 16:19:01', NULL),
(378, '1639815591_fd4c36074fb4e38c04a4.jpg', 'S10828', 'HEATING ELEMENT 2000W 230V L 27CM', 'OZTI', '6246.00012.23', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:19:51', '2021-12-18 16:19:51', NULL),
(379, '1639815633_a90275666adb0666ff82.jpg', 'S10829', 'DRAIN PIPE ', 'OZTI', '6262.00028.001', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:20:33', '2021-12-18 16:20:33', NULL),
(380, '1639815674_8cfe0d9a4fef23ae2c77.jpg', 'S10830', 'WASHING NAVEL', 'OZTI', '2710.F0024.02', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:21:14', '2021-12-18 16:21:14', NULL),
(381, '1639815742_dc0caedb5a0481f27cfb.jpg', 'S10831', 'Y HOSE FOR RINSING 500 T/S 180 CM ', 'OZTI', '6262.00021.22', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:22:22', '2021-12-18 16:22:22', NULL),
(382, '1639815783_daf02bc8c89573317e59.jpg', 'S10832', 'BOILER RESISTANCE 5 KW', 'OZTI', '9099.01000.05', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:23:03', '2021-12-18 16:23:03', NULL),
(383, '1639815831_ae7e646e4032d3795428.jpg', 'S10833', 'PCB FOR POWER CIRCUIT 120.02.072', 'OZTI', '6262.00043.02', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:23:51', '2021-12-18 16:23:51', NULL),
(384, '1639815905_655881067eea0c5d369e.jpg', 'S10834', 'DIGITAL SCREEN 120.02.065', 'OZTI', '6262.00043.03', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:25:05', '2021-12-18 16:25:05', NULL),
(385, '1639815954_ae552548689bf3fe7ceb.jpg', 'S10835', 'DATA CABLE 120.02.066', 'OZTI', '6262.00043.04', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:25:54', '2021-12-18 16:25:54', NULL),
(386, '1639816017_783e0231bb8a10e161b5.jpg', 'S10836', 'BOILER PROBE 120.02.067', 'OZTI', '6262.00043.05', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:26:57', '2021-12-18 16:26:57', NULL),
(387, '1639816057_d24e765a8f61d4659dbc.jpg', 'S10837', 'TANK PROBE 120.02.068', 'OZTI', '6262.00043.06', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:27:37', '2021-12-18 16:27:37', NULL),
(388, '1639816107_871c2b18bada15dd91a6.jpg', 'S10838', 'PIC MAGNETIC SENSOR ', 'OZTI', '6232.00005.16', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:28:27', '2021-12-18 16:28:27', NULL),
(389, '1639816197_2cffc6a75ae81b83a999.jpg', 'S10839', 'CABLE FOR COVER SENSOR 120.02.070', 'OZTI', '6262.00045.0818', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:29:57', '2021-12-18 16:29:57', NULL),
(390, '1639816244_702a98a78b02cfd3df98.jpg', 'S10840', 'CABLE FOR WATER LEVEL SENSOR 120.02.07', 'OZTI', '6262000450819', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:30:44', '2021-12-18 16:30:44', NULL),
(391, '1639816283_5c46da995f4eba28b61e.jpg', 'S10841', 'PRESSURE SWITCH 45-20 ', 'OZTI', '6262.00007.01', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:31:23', '2021-12-18 16:31:23', NULL),
(392, '1639816343_0be73c6e2837ca2a0ffb.jpg', 'S10842', '3/4\" WATER INLET HOSE', 'OZTI', '6262.00021.12', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:32:23', '2021-12-18 16:32:23', NULL),
(393, '1639816416_72e89b740ee134e61a19.jpg', 'S10843', 'CONTROLLER DIGITAL EVCO EV3B22N7 2 OUT', 'OZTI', '6234.00009.49', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:33:36', '2021-12-18 16:33:36', NULL),
(394, '1639816474_e418eb68d9b94af8ed19.jpg', 'S10844', 'DIGITAL SENSOR EVCO NTC PROP EVTPN615', 'OZTI', '6234.00009.08', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:34:34', '2021-12-18 16:34:34', NULL),
(395, '1639816516_7324780cebbf418f8ed6.jpg', 'S10845', 'MAGNETIC SEAL 573*1358MM', 'OZTI', '6268.00012.22', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:35:16', '2021-12-18 16:35:16', NULL),
(396, '1639816567_736729a77f5faeb154c8.jpg', 'S10846', 'THERMOSTAT 30-90', 'OZTI', '6234.00001.36 / 6234.00001.42', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:36:07', '2021-12-18 16:36:07', NULL),
(397, '1639816623_d397694d538a3718056f.jpg', 'S10847', 'FAN MOTOR 38W 99MM', 'OZTI', '6252.00072.10', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:37:03', '2021-12-18 16:37:03', NULL),
(398, '1639816688_e8b6a12eb955b7c1fbb1.jpg', 'S10848', 'MAGNETIC JOINT 1229*574MM', 'OZTI', '6268.00012.28', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:38:08', '2021-12-18 16:38:08', NULL),
(399, '1639816823_77a148c365f1685a99b7.jpg', 'S10849', 'FAN MOTOR EBM 5 W M4Q045-BD-O1-A57', 'OZTI', '6268.00008.24', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:39:03', '2021-12-18 16:40:23', NULL),
(400, '1639816857_c7e9e73164df4995e36a.jpg', 'S10850', 'LOWER MOTOR FOR DONER MACHINER', 'OZTI', '2859.D30.GR014.01', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:39:45', '2021-12-18 16:40:57', NULL),
(401, '1639816892_6e857eafd14619855979.jpg', 'S10851', 'ON OFF SWITCH ', 'OZTI', '6232.00001.02', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:41:32', '2021-12-18 16:41:32', NULL),
(402, '1639816960_017aec6da0dc60a8631a.jpg', 'S10852', 'THERMOSTAT 30-90 OC', 'OZTI', '6234.00001.01 / 6234.00001.42', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:42:40', '2021-12-18 16:42:40', NULL),
(403, '1639817017_71dbca8ff5aba7f082f4.jpg', 'S10853', 'GAS TAP KNOB', 'OZTI', '6802.00001.29', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:43:37', '2021-12-18 16:43:37', NULL),
(404, '1639817071_d8186d4fbccf5a543d9e.jpg', 'S10854', 'DONER GAS VALVE (703882149)', 'OZTI', '6267.00005.09', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:44:31', '2021-12-18 16:44:31', NULL),
(405, '1639817118_e7afc392485f62d14e05.jpg', 'S10855', 'DONER THERMOELEMENT M8*1 PIPE (TE.144.', 'OZTI', '6267.00005.110', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:45:18', '2021-12-18 16:45:18', NULL),
(406, '1639817171_3e3c2f1f324edc403907.jpg', 'S10856', 'DONER BURNER ', 'OZTI', '626700005110', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:46:11', '2021-12-18 16:46:11', NULL),
(407, '1639817213_3f34d20a8a74a7e6ef09.jpg', 'S10857', 'SUCTION FILTER COMPLETE', 'OZTI', '6262.00027.000', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:46:53', '2021-12-18 16:46:53', NULL),
(408, '1639817251_ad2321e88482425f85c9.jpg', 'S10858', 'PUMP ZF650 SXL9', 'OZTI', '9099.ZF650.00', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:47:31', '2021-12-18 16:47:31', NULL),
(409, '1639817299_80dff3903c397044a9f7.jpg', 'S10859', 'RESISTANCE 2000+2500W', 'OZTI', '9099.01000.03', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:48:19', '2021-12-18 16:48:19', NULL),
(410, '1639817347_a57f8e5b0c4820b662ff.jpg', 'S10860', 'RESISTANCE 2000W', 'OZTI', '9099.01000.04', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:49:07', '2021-12-18 16:49:07', NULL),
(411, '1639817404_f5028e0f2713cd2d1e66.jpg', 'S10861', '250 OHM 25 WATT RHEOSTATS', 'OZTI', '6229.00034.08', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:50:04', '2021-12-18 16:50:04', NULL),
(412, '1639817460_f6677acbc3cf749698f1.jpg', 'S10862', 'REX MOTOR 5078 CD8R6', 'OZTI', '9099.CD8R6.00', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:51:00', '2021-12-18 16:51:00', NULL),
(413, '1639817501_d8f73b2ee745d41bfe0c.jpg', 'S10863', 'KNOB FOR OEK 425', 'OZTI', '6262.00071.20', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:51:41', '2021-12-18 16:51:41', NULL),
(414, '1639817559_3e9eacd04aef02ef1fab.jpg', 'S10864', 'SWICTH 1-0 WITHOUT LED', 'OZTI', '6232.00019.07', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:52:39', '2021-12-18 16:52:39', NULL),
(415, '1639817607_d2376ec45edf349cf9b8.jpg', 'S10865', 'HEATING ELEMENT 900W 230V L 270MM', 'OZTI', '6246.00022.167', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:53:27', '2021-12-18 16:53:27', NULL),
(416, '1639817667_fc559326188adb959f4c.jpg', 'S10866', 'DOOR SEAL MAGNETIC JOINT 573*677 MM', 'OZTI', '6268.00012.23', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:54:27', '2021-12-18 16:54:27', NULL),
(417, '1639817722_0efede2dd33aaad9d4da.jpg', 'S10867', 'SAFETY THERMOSTAT 230 C MONOPHASE', 'OZTI', '6234.00001.16', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:55:22', '2021-12-18 16:55:22', NULL),
(418, '1639817779_362f50aaca26b46eda66.jpg', 'S10868', 'PILOT BURNER ASSEMBLY 3 WAY FOR GAS FRYER ', 'OZTI', '6267.00023.07', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:56:19', '2021-12-18 16:56:19', NULL),
(419, '1639817834_550f442841ce4c5483fc.jpg', 'S10869', 'PILOT BURNER FLME DIVIDER FOR FRYER', 'OZTI', '6267.00023.09', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:57:14', '2021-12-18 16:57:14', NULL),
(420, '1639817878_25b2f5db3687a1b1a333.jpg', 'S10870', 'SOCKER FOR THERMOCOUPLE BETWEEN SAFETY THERMOSTAT', 'OZTI', '6267.00024.08', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:57:58', '2021-12-18 16:57:58', NULL),
(421, '1639817918_8d540812b726209f4c2e.jpg', 'S10871', 'PLOT INJECTOR 0,25', 'OZTI', '6267.00023.11', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:58:38', '2021-12-18 16:58:38', NULL),
(422, '1639817964_73ee351726a0c34dc8e1.jpg', 'S10872', 'PLOT BURNER INJECTOR Q 035 NG', 'OZTI', '6267.00028.00', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 16:59:24', '2021-12-18 16:59:24', NULL),
(423, '1639818080_1565043a96ef76d0ba76.jpg', 's10873', 'THERMOSTATIC GAS VALVE', 'OZTI', '6267.00029.05', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 17:00:36', '2021-12-18 17:01:20', NULL),
(424, '1639818158_31ae91f32d2e13c26b4b.jpg', 'S10874', 'FRYER BASKET( 27*26.5*11 ) 750 ELECTRIC GAS 650', 'OZTI', '6260.00072.31', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 17:02:38', '2021-12-18 17:02:38', NULL),
(425, '1639818231_a4dbcba01cf9a8d15001.jpg', 'S10875', 'FRYER BURNER 100 MM DIAMETER ', 'OZTI', '6267.00020.22', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 4, 1, '2021-12-18 17:03:51', '2021-12-18 17:03:51', NULL),
(426, '1639818623_5c586c0246c6cf27a0bf.jpg', 'S1061', 'REAR VENTURI ', 'THERMATEK', '82001', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 22, 1, '2021-12-18 17:10:23', '2021-12-18 17:10:23', NULL),
(427, '1639818664_596d18bc0ee604f450c1.jpg', 'S1062', 'BURNER VENTURI', 'THERMATEK', '82000', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 22, 1, '2021-12-18 17:11:04', '2021-12-18 17:11:04', NULL),
(428, '1639818723_83e2ea5aa4014b7b09f8.jpg', 'S1063', 'KNOP ', 'THERMATEK', '80000', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 22, 1, '2021-12-18 17:12:03', '2021-12-18 17:12:03', NULL),
(429, '1639818767_8d2dd8867337c2d51356.jpg', 'S1064', 'TS 11 SAFETY VALVE ', 'THERMATEK', '80018', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 22, 1, '2021-12-18 17:12:47', '2021-12-18 17:12:47', NULL),
(430, '1639818821_1cb08929fdc1b2a5ada9.jpg', 'S1065', 'BURNER DEEP FRYER', 'THERMATEK', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 22, 1, '2021-12-18 17:13:41', '2021-12-18 17:13:41', NULL),
(431, '1640578046_6e48aa7f8b36d2a5591c.jpg', 'S1067', 'BURNER H LEHER PENDEK', 'THERMATEK', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 23, 1, '2021-12-18 17:14:30', '2021-12-27 12:07:26', NULL),
(432, '1640577975_ee9d749211df5b13adf7.jpg', 'S1066', 'BURNER H LEHER PANJANG', 'THERMATEK', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 22, 1, '2021-12-18 17:15:12', '2021-12-27 12:06:15', NULL),
(433, '1640071559_957c9c5172857e5da256.jpg', 'CP-R36', 'GAS STOVE 6 BURNER WITH OVEN', 'Suneast', 'Oven', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 10, 1, 0, 11, 21, 1, '2021-12-21 15:25:59', '2022-01-06 12:20:35', NULL),
(436, '1640586680_49d422678218d712c792.png', 'S1131', 'DET & RINSE  CHEMICAL ( Dalam Satuan Btl)', 'UNOX', 'DB1015A0', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 14:31:20', '2021-12-27 14:31:20', NULL),
(437, '1640587343_1255d2649aca03099641.png', 'S1132', 'SPRAY & RINSE  12*750 ML (dalam Satuan Btl)', 'UNOX', 'DB 1044AO', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 14:42:23', '2021-12-27 14:42:23', NULL),
(438, '1640587416_015451fded13f5cb2746.jpg', 'S1133', '300 SERIES DOOR GASKET KIT ', 'UNOX', 'KGN1389C', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 14:43:36', '2021-12-27 14:43:36', NULL),
(439, '1640587618_2603dc81840ff7993f5e.jpg', 'S1134', '0511 DOOR GASKET KIT  ', 'UNOX', 'KGN1563A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 14:46:58', '2021-12-27 14:46:58', NULL),
(440, '1640587794_e186943257619242398f.jpg', 'S1135', '0711 DOOR GASKET KIT', 'UNOX', 'KGN1564A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 14:49:54', '2021-12-27 14:49:54', NULL),
(441, '1640587867_9b772de89474cee05db0.jpg', 'S1136', '1011 DOOR GASKET KIT ', 'UNOX', 'KGN1565A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 14:51:07', '2021-12-27 14:51:07', NULL),
(442, '1640587945_8451c71278a0d4a2593e.jpg', 'S1137', 'XEBC-06XX DOOR GASKET KIT', 'UNOX', 'KGN1567A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 14:52:25', '2021-12-27 14:52:25', NULL),
(443, '1640588087_51c39712f36ed644c612.jpg', 'S1138', 'XEBC-10EU/FS/21 DOOR GASKET KIT', 'UNOX', 'KGN1568A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 14:54:47', '2021-12-27 14:54:47', NULL),
(444, '1640588191_8bf0f97cf243551f5aa6.jpg', 'S1139', 'DOOR GASKET', 'UNOX', 'KGN1630A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 14:56:31', '2021-12-27 14:56:31', NULL),
(445, '1640588255_bfe16925310acec5e01a.jpg', 'S11310', 'DOOR GASKET', 'UNOX', 'KGN 1629 A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 14:57:35', '2021-12-27 14:57:35', NULL);
INSERT INTO `items` (`id`, `item_image`, `item_code`, `item_name`, `item_merk`, `item_type`, `item_weight`, `item_length`, `item_width`, `item_height`, `item_hpp`, `item_before_sale`, `item_discount`, `item_sale`, `item_profit`, `item_description`, `item_warehouse_a`, `item_warehouse_b`, `item_warehouse_c`, `item_warehouse_d`, `item_stock`, `category_id`, `supplier_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(446, '1640588343_e75724be5d6027cf11b4.jpg', 'S11311', '1011 DOOR GASKET KIT ', 'UNOX', 'KGN1631 A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 14:59:03', '2021-12-27 14:59:03', NULL),
(447, '1640588540_514499a0e6c55a9e3634.jpg', 'S11312', 'DOOR GASKET KIT EU6', 'UNOX', 'KGN1659A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 15:00:02', '2021-12-27 15:02:20', NULL),
(448, '1640588620_7fab59d91e2f8c10e7d3.jpg', 'S11313', '10EU-FS/1021 DOOR GASKET KIT ', 'UNOX', 'KGN 1660A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 15:03:40', '2021-12-27 15:03:40', NULL),
(449, '1640588768_cf3d2b4f6aa5f71911f2.png', 'S11314', 'MIND MAPS DOUBLE IGNITER RETROFIT KIT', 'UNOX', 'XRF011', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 15:06:08', '2021-12-27 15:06:08', NULL),
(450, '1640588899_7399336a92cce206c235.jpg', 'S11315', 'PT 100 L1000 TEMPERATURE PROBE KIT( SENSOR RUANGAN )', 'UNOX', 'KTR1105A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 15:08:19', '2021-12-27 15:08:19', NULL),
(451, '1640588977_25f11099b499141d2cb2.png', 'S11316', 'MM PLUS CA[ACITIVE CONTROL BOARD KIT', 'UNOX', 'KPE 1057 A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 15:09:38', '2021-12-27 15:09:38', NULL),
(452, '1640589073_edfb52188cd23f51cd44.jpg', 'S11317', 'MIND MAPS PLUS CONTROL BOARD KIT', 'UNOX', 'KPE2044A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 15:11:13', '2021-12-27 15:11:13', NULL),
(453, '1640589162_a61383fdb99e0abb7d09.jpg', 'S11318', 'MIND MAPS GAS PREMIX POWER BOARD KIT', 'UNOX', 'KPE2021B', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 15:12:42', '2021-12-27 15:12:42', NULL),
(454, '1640589221_fba60cdb0e52c2156f8b.png', 's11319', 'MM USB RESET SUPPORT KIT', 'UNOX', 'KPE 1059A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 15:13:41', '2021-12-27 15:13:41', NULL),
(455, '1640589371_bc8d2ba8975875e00ed3.jpg', 'S11320', 'HEATING ELEMENT KIT', 'UNOX', 'KRS1130A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 15:16:11', '2021-12-27 15:16:11', NULL),
(456, '1640589438_a72a75fa05e9dde77e81.png', 'S11321', 'EUR ROTOR ARM PLUS CLEANING SYSTEM KIT', 'UNOX', 'KVL1101A  M', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 15:17:18', '2021-12-27 15:17:18', NULL),
(457, '1640589482_75bf400e9cb568bf1ed9.png', 'S11322', '1/4 MNO CIL PRESSURE SWITCH ', 'UNOX', 'KVL 1065A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 15:18:02', '2021-12-27 15:18:02', NULL),
(458, '1640589629_2c9eebfeb1e2dbbc2f47.jpg', 'S11323', 'EL2 JG D8-D10 1 WAY SOLENOID VALVE KIT ', 'UNOX', 'KEL 1252A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 15:20:29', '2021-12-27 15:20:29', NULL),
(459, '1640589700_fda1d33d072068be8e25.jpg', 'S11324', 'EG1 JG D8-D6 SOLENOID VAVE KIT ', 'UNOX', 'KEL 1424B', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 15:21:40', '2021-12-27 15:21:40', NULL),
(460, '1640589808_d162e025777665d860ed.jpg', 'S11325', 'D8 CONNECTION D6 SOLENOID VALVE KIT ', 'UNOX', 'KEL 1436B', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 15:23:28', '2021-12-27 15:23:28', NULL),
(461, '1640589970_278a90a17c131709f4a9.jpg', 'S11326', 'D8-D10 STEAM SOLENOID VALVE KIT ', 'UNOX', 'KEL1361A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 15:26:10', '2021-12-27 15:26:10', NULL),
(462, '1640590072_c2b9c32009dbb95a9362.jpg', 'S11327', '9+38 STEAM SOLENOID VALVE KIT ', 'UNOX', 'KEL1431A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 15:27:52', '2021-12-27 15:27:52', NULL),
(463, '1640590193_897f1ad72c8760c5ca25.jpg', 'S11328', '5+21 BARBED 6 DUAL SOLENOID VALVE KIT ', 'UNOX', 'KEL1430B', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 15:29:53', '2021-12-27 15:29:53', NULL),
(464, '1640590271_ea8b48b73ea873e0c761.png', 'S11329', 'SELF CLEANING WATER VALVE KIT ', 'UNOX', 'KEL 1440A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 15:31:11', '2021-12-27 15:31:11', NULL),
(465, '1640590401_b04b253ff8a872765304.png', 'S11330', '1 ROTOR ARM PLUS CLEANING SYSTEM KIT ', 'UNOX', 'KVL1183A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 15:33:22', '2021-12-27 15:33:22', NULL),
(466, '1640590489_f1e0a86bd2adad6e8565.jpg', 'S11331', 'DETERGENT FILTER + NRV KIT', 'UNOX', 'KVL1102A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 15:34:49', '2021-12-27 15:34:49', NULL),
(467, '1640590615_2c67a05273cc4f11cf60.png', 'S11332', 'MM GAS EU POWER BOARD KIT', 'UNOX', 'KPE 2021C', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 15:36:55', '2021-12-27 15:36:55', NULL),
(468, '1640590727_b0deb51852fac9944687.jpg', 's11333', 'SAFETY THERMOSTAT KIT', 'UNOX', 'KTR1136A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 15:38:47', '2021-12-27 15:38:47', NULL),
(469, '1640590830_9f9a36df35f6d556b7b2.jpg', 's11334', 'MULTI POINT CORE PROBE KIT', 'UNOX', 'KSN1002A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 15:40:30', '2021-12-27 15:40:30', NULL),
(470, '1640590946_0c1b8ecca2ffe339a799.jpg', 's11335', 'IGNATION BOX KIT/ KIT FLAME CONTROL HLL 220-240V 50/6H', 'UNOX', 'KVE1055A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 15:42:26', '2021-12-27 15:42:26', NULL),
(471, '1640591070_d93c4ddc4ec5fa5d563e.jpg', 'S11336', 'MULTIPOINT CORE PROBE KIT L2050', 'UNOX', 'KSN1020B ', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 15:44:30', '2021-12-27 15:44:30', NULL),
(472, '1640591193_35a6aa2afce90e045d24.jpg', 's11337', 'MIND MAPS L2000 CHAMBER TEMP PROBE KIT', 'UNOX', 'KTR1106B', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 15:46:33', '2021-12-27 15:46:33', NULL),
(473, '1640591286_f5ec7cfea8472d6aba8c.png', 'S11338', 'CT BT TEMPERATURE PROBE COVER KIT ', 'UNOX', 'KVM 1464A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 15:48:07', '2021-12-27 15:48:07', NULL),
(474, '1640591405_0110cfc59c060949ce13.png', 'S11339', 'LM600 DYNAMIC COMPLETE CONTROL BOARD KIT ', 'UNOX', 'KVM 2185B', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 15:49:10', '2021-12-27 15:50:05', NULL),
(475, '1640591508_cbb15330c057856eb2df.jpg', 'S11340', 'WASHING SYSTEM ROTOR KIT ', 'UNOX', 'KVL1037A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 15:51:48', '2021-12-27 15:51:48', NULL),
(476, '1640591597_704b6091c1fdaafe173b.jpg', 'S11341', 'S.5E ADVANCE/ MM 230V COOLING DOWN FAN KIT ', 'UNOX', 'KVN1165A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 15:53:17', '2021-12-27 15:53:17', NULL),
(477, '1640591822_9df8c90daba1cec9e81f.png', 's11342', 'S.5E/SE 12VDC COLLING DOWN FAN KIT', 'UNOX', 'KVN1164A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 15:57:03', '2021-12-27 15:57:03', NULL),
(478, '1640591930_05a8744705453d253091.jpg', 's11343', 'MIND MAPS YBS RESET SUPORT KIT ', 'UNOX', 'KPE2046A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 15:58:50', '2021-12-27 15:58:50', NULL),
(479, '1640592040_2314d0c4d144dffde5fc.jpg', 's11344', 'CONTROL BOARD COLLING FAN KIT ', 'UNOX', 'KVN1179A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 16:00:40', '2021-12-27 16:00:40', NULL),
(480, '1640592126_04935b9e0e8d2317f904.png', 's11345', 'PANEL COOLING FAN SUPPORT ', 'UNOX', 'KVM2518A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 16:02:06', '2021-12-27 16:02:06', NULL),
(481, '1640592233_77cf8aaa8c9d5c601684.jpg', 's11346', 'T-SHAPED FIT D6-D10 HOLD 2 MAGNETS KIT', 'UNOX', 'KVL1096A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 16:03:53', '2021-12-27 16:03:53', NULL),
(482, '1640592320_a29c7ae359df7646f0f4.jpg', 's11347', '6.3 UF MOTOR CAPASITOR KIT  ', 'UNOX', 'KCN1003A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 16:05:20', '2021-12-27 16:05:20', NULL),
(483, '1640592483_8bf3ccd6114eb2fa7dd3.jpg', 's11348', 'STRAIGHT CONNECT-HOLDER D7-D10 10PCS KIT', 'UNOX', 'KVL1095O', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 16:08:03', '2021-12-27 16:08:03', NULL),
(484, '1640592591_8c3b7eec9ab4384dd5ff.jpg', 's11349', 'GAS MULTIFLAME CONTROL EV SIGNAL CABLE', 'UNOX', 'KCE1046AO', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 16:09:51', '2021-12-27 16:09:51', NULL),
(485, '1640592686_0d8b47c0ee5268fe3c09.jpg', 's11350', 'S5E CHEFTOP - BAKERTOP POWER BOAR KIT', 'UNOX', 'KPE1725D', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 16:11:26', '2021-12-27 16:11:26', NULL),
(486, '1640592956_5b9d39bda6c41b3a0965.jpg', 's11351', '240V 50/60HZ MULTIFLAME IGNITION BOX KIT', 'UNOX', 'KVE1636A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 16:15:56', '2021-12-27 16:15:56', NULL),
(487, '1640593055_6c0cc350781c4463353f.jpg', 'S11352', '240V 50/60HZ MULTIFLAME IGNITION BOX KIT', 'UNOX', 'KVE1636 B', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 16:17:35', '2021-12-27 16:17:35', NULL),
(488, '1640593145_c36e1444600498aa539d.png', 'S11353', 'INSULATION TRANSFORMER 230-220/40VA', 'UNOX', 'KVE 1648A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 16:19:06', '2021-12-27 16:19:06', NULL),
(489, '1640593212_abfd1c55b8dcae6067fa.png', 'S11354', '230-21-12 VAC 90 VA TRANSFORMER  KIT', 'UNOX', 'KVE1026A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 16:20:12', '2021-12-27 16:20:12', NULL),
(490, '1640593278_27de99fe70669c98ab07.png', 'S11355', 'MIND MAPS 330W 230V MOTOR KIT', 'UNOX', 'KMT 1012A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 16:21:18', '2021-12-27 16:21:18', NULL),
(491, '1640593353_c7b18a3785af23997602.png', 'S11356', 'MIND MAPS SERIES HANDLE KIT M', 'UNOX', 'KMG 1099A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 16:22:33', '2021-12-27 16:22:33', NULL),
(492, '1640593412_fe29551345e74ce5b00e.png', 'S11357', '230 35 KW MAX VENTURI-PREMIX BLOWER KIT ', 'UNOX', 'KVG1014B', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 16:23:32', '2021-12-27 16:23:32', NULL),
(493, '1640593523_87c1f21695954536174c.png', 'S11358', 'PREMIX BURNER STSRT UP PLUG 6 PCS KIT', 'UNOX', 'KBR 1340A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 16:25:24', '2021-12-27 16:25:24', NULL),
(494, '1640593593_f615ddfba7627bc03187.jpg', 'S11359', 'WASHING PUMP REPLACING KIT', 'UNOX', 'KVL0009A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2021-12-27 16:26:33', '2021-12-27 16:26:33', NULL),
(495, '1640663432_153f9793ed01c3086678.jpg', 'S1241', 'PLAT', 'PLAT & PIPA', 'PLAT 304 0.8 MM', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 24, 1, '2021-12-28 10:37:25', '2021-12-28 11:50:32', NULL),
(496, '1640663673_5579ef04f672ca480453.jpg', 'S1242', 'PLAT', 'PLAT & PIPA', 'PLAT 304 1 MM', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 24, 1, '2021-12-28 10:38:38', '2021-12-28 11:54:33', NULL),
(497, '1640663746_46372a98977eedb2138a.jpg', 'S1243', 'PLAT', 'PLAT & PIPA', 'PLAT 304 1.2 MM', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 24, 1, '2021-12-28 10:40:46', '2021-12-28 11:55:46', NULL),
(498, '1640663810_e0a737e1df73127cfda2.jpg', 'S1244', 'PLAT', 'PLAT & PIPA', 'PLAT 304 1.5 MM', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 24, 1, '2021-12-28 10:41:40', '2021-12-28 11:56:50', NULL),
(499, '1640659354_e100d98325bdc03e4e63.jpg', 'S1245', 'PLAT', 'PLAT 201 0.8 MM', 'PLAT & PIPA', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 24, 1, '2021-12-28 10:42:34', '2021-12-28 10:42:34', NULL),
(500, '1640659408_b049c02e3f54d6540e9b.jpg', 'S1246', 'PLAT', 'PLAT 201 1 MM', 'PLAT & PIPA', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 24, 1, '2021-12-28 10:43:28', '2021-12-28 10:43:28', NULL),
(501, '1640659472_a2674f15d9c6bd881b51.jpg', 'S1247', 'PLAT', 'PLAT 201 1.2 MM', 'PLAT & PIPA', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 24, 1, '2021-12-28 10:44:32', '2021-12-28 10:44:32', NULL),
(502, '1640659527_efe241a7306426ed1912.jpg', 'S1248', 'PLAT', 'PLAT 201 1.5 MM', 'PLAT & PIPA', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 24, 1, '2021-12-28 10:45:27', '2021-12-28 10:45:27', NULL),
(503, '1640659644_f6d3eecd9833f9617e04.jpg', 'S1249', 'PIPA BULAT', 'PIPA BULAT 304 1\" X 1.2MM', 'PLAT & PIPA', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 24, 1, '2021-12-28 10:47:24', '2021-12-28 10:47:24', NULL),
(504, '1640659722_3485b20b0a8f79d82ec4.jpg', 'S12410', 'PIPA BULAT', 'PIPA BULAT 304 1 1/4\" X 1.2MM', 'PLAT & PIPA', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 24, 1, '2021-12-28 10:48:42', '2021-12-28 10:48:42', NULL),
(505, '1640659784_728a1fcbe9fdc371efe1.jpg', 'S12411', 'PIPA BULAT', 'PIPA BULAT 304 1 1/2\" X 1.2MM', 'PLAT & PIPA', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 24, 1, '2021-12-28 10:49:44', '2021-12-28 10:49:44', NULL),
(506, '1640659845_ef5cad23873b0d4a8371.jpg', 'S12412', 'PIPA BULAT', 'PIPA BULAT 304 2\" X 1.2MM', 'PLAT & PIPA', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 24, 1, '2021-12-28 10:50:45', '2021-12-28 10:50:45', NULL),
(507, '1640659893_55100d496ac7b47287fe.jpg', 'S12413', 'PIPA BULAT', 'PIPA BULAT 201 5/8\" X 1.2MM', 'PLAT & PIPA', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 24, 1, '2021-12-28 10:51:33', '2021-12-28 10:51:33', NULL),
(508, '1640659982_94c494d5ff2207556ceb.jpg', 'S12414', 'PIPA BULAT', 'PIPA BULAT 201 1\" X 1.2MM', 'PLAT & PIPA', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 24, 1, '2021-12-28 10:53:02', '2021-12-28 10:53:02', NULL),
(509, '1640660040_ecb7544dce8654d41669.jpg', 'S12415', 'PIPA BULAT', 'PIPA BULAT 201 1 1/4\" X 1.2MM', 'PLAT & PIPA', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 24, 1, '2021-12-28 10:54:00', '2021-12-28 10:54:00', NULL),
(510, '1640660125_01b46d3c66ddf24fbdc5.jpg', 'S12416', 'PIPA BULAT', 'PIPA BULAT 201 1 1/2\" X 1.2MM', 'PLAT & PIPA', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 24, 1, '2021-12-28 10:55:25', '2021-12-28 10:55:25', NULL),
(511, '1640660192_c170bcac13f0707eb43d.jpg', 'S12417', 'PIPA BULAT', 'PIPA BULAT 201 2\" X MM', 'PLAT & PIPA', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 24, 1, '2021-12-28 10:56:32', '2021-12-28 10:56:32', NULL),
(512, '1640660251_e1328cf8d38ecb06bce7.jpg', 'S12418', 'PIPA BULAT', 'PIPA KOTAK 201 2 X 2 X 1.2MM', 'PLAT & PIPA', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 24, 1, '2021-12-28 10:57:31', '2021-12-28 10:57:31', NULL),
(513, '1640660359_1a3324f1ca7c71dd87e4.jpg', 'S12419', 'PIPA KOTAK', 'PIPA KOTAK 201 3 X 3 X 1.2MM', 'PLAT & PIPA', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 24, 1, '2021-12-28 10:59:19', '2021-12-28 10:59:19', NULL),
(514, '1640660429_d002bc836a11c6f181a6.jpg', 'S12420', 'PIPA KOTAK', 'PIPA KOTAK 201 4 X 2 X 1.2MM', 'PLAT & PIPA', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 24, 1, '2021-12-28 11:00:29', '2021-12-28 11:00:29', NULL),
(515, '1640660480_8e9106a42b3d66e3e8d6.jpg', 'S12421', 'PIPA KOTAK', 'PIPA KOTAK 201 4 X 4 X 1.2MM', 'PLAT & PIPA', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 24, 1, '2021-12-28 11:01:20', '2021-12-28 11:01:20', NULL),
(516, '1640660527_d9fab2aaafd40201728e.jpg', 'S12422', 'PIPA KOTAK', 'PIPA KOTAK 304 2 X 2 X 1.2MM', 'PLAT & PIPA', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 24, 1, '2021-12-28 11:02:07', '2021-12-28 11:02:07', NULL),
(517, '1640660595_1f4ff380b4d0811f7f63.jpg', 'S12423', 'PIPA KOTAK', 'PIPA KOTAK 304 4 X 4 X 1.2MM', 'PLAT & PIPA', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 24, 1, '2021-12-28 11:03:15', '2021-12-28 11:03:15', NULL),
(518, '1640660658_a44d4abd28bb911184d8.jpg', 'S12424', 'PIPA KOTAK', 'PIPA KOTAK 304 3 X 3 X 1.2MM', 'PLAT & PIPA', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 24, 1, '2021-12-28 11:04:18', '2021-12-28 11:04:18', NULL),
(519, '1640660812_a80bd3bc71dab3a8ca4f.jpg', 'S12425', 'PLAT LUBANG', 'PLAT LUBANG 201 1MM DIA 3MM', 'PLAT & PIPA', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 24, 1, '2021-12-28 11:06:00', '2021-12-28 11:06:52', NULL),
(520, '1640661082_0db885dbe1aa65e95574.png', 'S1011', 'TOP GRILL ', 'G15', 'SUN EAST', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 21, 1, '2021-12-28 11:11:22', '2021-12-28 11:11:22', NULL),
(521, '1640661151_ca274032e41b8526f598.png', 'S1012', 'TOP GRILL ', 'G42 (Y-007)', 'SUN EAST', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 21, 1, '2021-12-28 11:12:31', '2021-12-28 11:12:31', NULL),
(522, '1640661223_2114081891d17b328d3f.png', 'S1013', 'TOP GRILL ', 'G50', 'SUN EAST', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 21, 1, '2021-12-28 11:13:43', '2021-12-28 11:13:43', NULL),
(523, '1640661311_9ac0c6374661dd8fd105.png', 'S1014', 'BURNER LOW FOR STOCK POT', 'B002D', 'SUN EAST', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 21, 1, '2021-12-28 11:15:11', '2021-12-28 11:15:11', NULL),
(524, '1640663534_2ddcb95d04268908badb.jpg', 'S1251', 'Button', 'SOPPAS', 'SP001', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 25, 1, '2021-12-28 11:22:06', '2021-12-28 11:52:14', NULL),
(525, '1640663593_bd03c14e3fb6fba2bccb.jpg', 'S1252', 'Control Box System', 'SOPPAS', 'SP002', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 25, 1, '2021-12-28 11:23:28', '2021-12-28 11:53:13', NULL),
(526, '1640661902_0e2e54f67df328e3368f.jpg', 'S1253', 'Ignation Pin  For Blower  ', 'SP003', 'SOPPAS', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 25, 1, '2021-12-28 11:25:02', '2021-12-28 11:25:02', NULL),
(527, '1640662001_5b30ef8a8d5d092344dd.jpg', 'S1254', 'Switch  For Blower ', 'SP004', 'SOPPAS', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 25, 1, '2021-12-28 11:26:41', '2021-12-28 11:26:41', NULL),
(528, '1640662540_6433998916ceea191263.jpg', 'S1255', 'Tripple Ignation  Pin ', 'SP005', 'SOPPAS', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 25, 1, '2021-12-28 11:35:40', '2021-12-28 11:35:40', NULL),
(529, '1640662632_33a53863398f938192c9.jpg', 'S1256', 'Wind Pressure Switch    ', 'SP006', 'SOPPAS', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 25, 1, '2021-12-28 11:37:12', '2021-12-28 11:37:12', NULL),
(530, '1640662688_774575418e07ce02a614.jpg', 'S1257', 'Control Box System For Steamer', 'SP007', 'SOPPAS', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 25, 1, '2021-12-28 11:38:08', '2021-12-28 11:38:08', NULL),
(531, '1640662747_e43f18d4a50f324ca7bf.jpg', 'S1258', 'High Powered Fan For Steamer  ', 'SP008', 'SOPPAS', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 25, 1, '2021-12-28 11:39:07', '2021-12-28 11:39:07', NULL),
(532, '1640662807_57d2607e845ac41b38f5.jpg', 'S1259', 'Capasitor   For Steamer ', 'SP009', 'SOPPAS', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 25, 1, '2021-12-28 11:40:07', '2021-12-28 11:40:07', NULL),
(533, '1640662975_de5841761e474c427b7c.jpg', 'S1271', 'BATU POTONG RESIBON 25X50X6', 'NIPPON', 'MATERIAL', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 11:42:55', '2021-12-28 11:42:55', NULL),
(534, '1640663043_a81da10da5c0f2a46cc9.jpg', 'S1272', 'AMPLAS AIR #180 ', 'KINIK ', 'MATERIAL', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 11:44:03', '2021-12-28 11:44:03', NULL),
(535, '1640663109_c36c26e7f4ae0f43943f.jpg', 'S1273', 'AMPLAS AIR #180', 'EAGLE', 'MATERIAL', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 11:45:09', '2021-12-28 11:45:09', NULL),
(536, '1640663188_12137581e6bca95a51bf.jpg', 'S1274', 'VSM 4\" #80', 'P 80', 'MATERIAL', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 11:46:28', '2021-12-28 11:46:28', NULL),
(537, '1640663309_2ce67c5b569afd9ba4a9.jpg', 's1275', 'TUNGSTEN', 'Material', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 11:48:29', '2021-12-28 11:48:29', NULL),
(538, '1640663928_a9a501b206ce7ae30c74.jpg', 'S1276', 'WA 60  BEST TOUCH', 'MATERIAL', 'NIPPON', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 11:58:48', '2021-12-28 11:58:48', NULL),
(539, '1640664007_9e36e8dcfe153caf11d8.jpg', 'S1277', 'KAWAT LAS RB 26  @5KG', 'MATERIAL', 'KOBE ', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 12:00:07', '2021-12-28 12:00:07', NULL),
(540, '1640664072_40449e4f65f9ad33e1cf.jpg', 'S1278', 'SILENT  65/ CLEAR ', 'MATERIAL', 'SILENT', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 25, 1, '2021-12-28 12:01:12', '2021-12-28 12:01:12', NULL),
(541, '1640668230_3c12d2121c569a339b18.jpg', 'S1278', 'SILENT  65/ CLEAR ', 'MATERIAL', 'SILENT', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 13:10:30', '2021-12-28 13:10:30', NULL),
(542, '1640668290_dd967714bca26b75a31d.jpg', 'S1279', 'BATU HIJAU  ', 'MATERIAL', 'LANGSOL', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 13:11:30', '2021-12-28 13:11:30', NULL),
(543, '1640668350_db92b6396428f852d0aa.jpg', 'S12710', 'RESIBON ', 'MATERIAL', 'NIPPON ', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 13:12:30', '2021-12-28 13:12:30', NULL),
(544, '1640668408_65957b1dbdc1d05bc823.jpg', 'S1211', 'SCOTE BRIDE / HAND PAD', 'MATERIAL', '3M', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 13:13:28', '2021-12-28 13:13:28', NULL),
(545, '1640668456_5dfe8e43ba766a2935f2.jpg', 'S12712', 'SCOTE BRIDE / HAND PAD', 'MATERIAL', 'WIPRO ', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 13:14:16', '2021-12-28 13:14:16', NULL),
(546, '1640668514_52d2d0b014468b74f27a.jpg', 'S12713', 'BATU POTONG 4\" X 1MM  / CUTTING WHELL', 'MATERIAL', 'WIPRO ', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 13:15:14', '2021-12-28 13:15:14', NULL),
(547, '1640668568_7c222da1aaaac8ddd5d3.jpg', 'S12714', 'NON WOVEN  / CLEANER  6\"', 'MATERIAL', 'WIPRO ', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 13:16:08', '2021-12-28 13:16:08', NULL),
(548, '1640668627_b611c7a1f958cce24776.jpg', 'S12715', 'CUTTING WHEEL ', 'MATERIAL', 'KOK PRIME', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 13:17:07', '2021-12-28 13:17:07', NULL),
(549, '1640668680_11140e9515e3403e4090.jpg', 'S12716', 'LONG DRAT M8', 'MATERIAL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 13:18:00', '2021-12-28 13:18:00', NULL),
(550, '1640668734_eef3d4d5f72691a8fc8f.jpg', 'S12717', 'LONG NUT M8', 'MATERIAL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 13:18:54', '2021-12-28 13:18:54', NULL),
(551, '1640668778_83fb0592ed532a86289d.jpg', 'S12718', 'MUR AS DRAT M8', 'MATERIAL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 13:19:38', '2021-12-28 13:19:38', NULL),
(552, '1640668828_0bbd0d019d7119bb2c19.jpg', 'S12719', 'FLEXIBLE AIR 50', 'MATERIAL', '1/2\"', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 13:20:28', '2021-12-28 13:20:28', NULL),
(553, '1640668878_6a563eac4feaf29a9245.jpg', 'S12720', 'AFUR ', 'MATERIAL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 13:21:18', '2021-12-28 13:21:18', NULL),
(554, '1640668931_c2eaab65d5048d4e09b7.jpg', 'S12721', 'SELANG GAS 3/8\'', 'MATERIAL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 13:22:11', '2021-12-28 13:22:11', NULL),
(555, '1640668983_583346a1f40866e62077.jpg', 'S12722', 'COOLING FAN  ', 'MATERIAL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 13:23:03', '2021-12-28 13:23:03', NULL),
(556, '1640669027_847bb8d3c48025d5c88a.jpg', 'S12723', 'PLATIK CURTAIN ', 'MATERIAL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 13:23:47', '2021-12-28 13:23:47', NULL),
(557, '1640669074_5bf4fc568e501ff35213.jpg', 'S12724', 'SCRAPE HOLE ', 'MATERIAL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 13:24:34', '2021-12-28 13:24:34', NULL),
(558, '1640669129_8bd1b2e7d129f5f8a8a0.jpg', 'S12725', 'U BOLT 1 1/4', 'MATERIAL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 13:25:29', '2021-12-28 13:25:29', NULL),
(559, '1640669180_a78170774854fc334b3c.jpg', 'S12726', 'U BOLT 3/4', 'MATERIAL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 13:26:20', '2021-12-28 13:26:20', NULL),
(560, '1640669228_3373c718606bf6221441.jpg', 'S12727', 'U BOLT 1 1/2', 'MATERIAL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 13:27:08', '2021-12-28 13:27:08', NULL),
(561, '1640669301_233a0df4b92bdd11c5a2.jpg', 'S12728', 'U BOLT 1', 'MATERIAL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 13:28:21', '2021-12-28 13:28:21', NULL),
(562, '1640669383_d4c7b12054f14125058b.jpg', 'S12729', 'JARUM KERAS', 'MATERIAL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 13:29:43', '2021-12-28 13:29:43', NULL),
(563, '1640669430_64363425bace1fbd6cd2.jpg', 'S12730', 'MATA AYAM', 'MATERIAL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 13:30:30', '2021-12-28 13:30:30', NULL),
(564, '1640669475_a2f38aeb5fe4692298b8.jpg', 'S12731', 'SEGEL DRAT', 'MATERIAL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 13:31:15', '2021-12-28 13:31:15', NULL),
(565, '1640669522_ce1a514c6b2576e41469.jpg', 'S12732', 'BAUT KUNCIAN 5 Cm', 'MATERIAL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 13:32:02', '2021-12-28 13:32:02', NULL),
(566, '1640669630_a8f8fb35bcce042edcc6.jpg', 'S12733', 'BAUT KUNCIAN 2 Cm', 'MATERIAL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 13:33:50', '2021-12-28 13:33:50', NULL),
(567, '1640669677_26315934f466e8d7eb79.jpg', 'S12734', 'BAUT KUNCIAN 10', 'MATERIAL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 13:34:37', '2021-12-28 13:34:37', NULL),
(568, '1640669739_02672a8c38f84903f988.jpg', 'S12735', 'VERLOP RING', 'MATERIAL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 13:35:39', '2021-12-28 13:35:39', NULL),
(569, '1640669792_5669c410ca81ecc847d7.jpg', 'S12736', 'DINABOLT M 10 X 65MM', 'MATERIAL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 13:36:32', '2021-12-28 13:36:32', NULL),
(570, '1640669840_f9d99ab796840488ebf8.jpg', 'S12737', 'CAT KUNING', 'MATERIAL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 13:37:20', '2021-12-28 13:37:20', NULL),
(571, '1640669891_41e2287178fb1935bd23.jpg', 'S12738', 'TINER', 'MATERIAL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 13:38:11', '2021-12-28 13:38:11', NULL),
(572, '1640669949_2026e957fb848ee8be32.jpg', 'S12739', 'PRIMER / ZINGCROMATE', 'MATERIAL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 13:39:09', '2021-12-28 13:39:09', NULL),
(573, '1640669994_b2e28cd11ddad809e617.jpg', 'S12740', 'SEALTIPE ONDA', 'MATERIAL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 13:39:54', '2021-12-28 13:39:54', NULL),
(574, '1640670073_571444dbdfbedb6bdedd.png', 'S12741', 'DUM KWALIERANGE', 'MATERIAL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 13:41:13', '2021-12-28 13:41:13', NULL),
(575, '1640670236_09f774be065a5c11d409.png', 'S12742', 'HANDLE TANAM OVAL', 'MATERIAL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 26, 1, '2021-12-28 13:43:56', '2021-12-28 13:43:56', NULL),
(576, '1640670477_c984948b82244d2fbd6e.jpg', 'S1291', 'CARE TABLET  ( BIRU )', 'CHEMICAL', '56.00.562', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 27, 1, '2021-12-28 13:47:57', '2021-12-28 13:47:57', NULL),
(577, '1640670554_ca147b49ec18eaf6d129.jpg', 'S1292', 'CLEANING TABLET ( MERAH )', 'CHEMICAL', '56.00.210', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 27, 1, '2021-12-28 13:49:14', '2021-12-28 13:49:14', NULL),
(578, '1640670605_a79e90c9ee24dfc38736.jpg', 'S1293', 'DOOR GASKET 6 TRAY', 'CHEMICAL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 27, 1, '2021-12-28 13:50:05', '2021-12-28 13:50:05', NULL),
(579, '1640670658_d627183f305d174d8296.jpg', 'S1294', 'DOOR GASKET 6 TRAY', 'CHEMICAL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 27, 1, '2021-12-28 13:50:58', '2021-12-28 13:50:58', NULL),
(580, '1640670736_7fec6ec9c250f23952bd.png', 'S1295', 'THERMOSTAT', 'CHEMICAL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 27, 1, '2021-12-28 13:52:16', '2021-12-28 13:52:16', NULL),
(581, '1640670782_e7b18279640d5d823ef8.jpg', 'S1296', 'DESCALER  5 L', 'CHEMICAL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 27, 1, '2021-12-28 13:53:02', '2021-12-28 13:53:02', NULL),
(582, '1640670872_cc00d7e775be55880621.png', 'S1297', 'UNIVERSAL WAREWASHING DETERGENT ', 'CHEMICAL', 'F2/5', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 27, 1, '2021-12-28 13:54:32', '2021-12-28 13:54:32', NULL),
(583, '1640670959_1750efb8b331c08d14a4.png', 'S1298', 'UNIVERSAL NEUTRAL RINSE AID', 'CHEMICAL', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 27, 1, '2021-12-28 13:55:59', '2021-12-28 13:55:59', NULL),
(584, '1640671162_2f73623102983363ece6.jpg', 'S1301', 'Speed Control Knob /WSB50-70', 'WARRING', '\'032650', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 28, 1, '2021-12-28 13:59:22', '2021-12-28 13:59:22', NULL),
(585, '1640671606_5f829ff3290a7a348997.jpg', 'S1302', 'Coupling', 'WARRING', '\'032453', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 28, 1, '2021-12-28 14:06:46', '2021-12-28 14:06:46', NULL),
(586, '1640671676_e01b2ef44a858f29f507.jpg', 'S1303', 'Blending Assy.', 'WARRING', '503408', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 28, 1, '2021-12-28 14:07:56', '2021-12-28 14:07:56', NULL),
(587, '1640671768_bfa711da2971a3aad144.jpg', 'S1304', 'Jar Seal /BB180, BB185', 'WARRING', '026284', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 28, 1, '2021-12-28 14:09:28', '2021-12-28 14:09:28', NULL),
(588, '1640671938_5f068bb11f7609000d9b.jpg', 'S1305', 'Blade Assembly', 'WARRING', '503444', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 28, 1, '2021-12-28 14:12:18', '2021-12-28 14:12:18', NULL),
(589, '1640672027_41b7c0bf7d18acb93395.jpg', 'S1306', 'Blade /WSB33E/K', 'WARRING', '\'026139', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 28, 1, '2021-12-28 14:13:47', '2021-12-28 14:13:47', NULL),
(590, '1640672105_dc80498f2dcb7ef5f373.jpg', 'S1307', 'Motor Coupling  /WSG60', 'WARRING', '035135', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 28, 1, '2021-12-28 14:15:05', '2021-12-28 14:15:05', NULL),
(591, '1640672175_32003078b879d96f9835.jpg', 'S1308', 'Knob With Insert /WW180E-K', 'WARRING', '032745', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 28, 1, '2021-12-28 14:16:15', '2021-12-28 14:16:15', NULL),
(592, '1640672242_a07d818716b7d970d2b1.jpg', 'S1309', 'Thermostat /WW180-200', 'WARRING', '\'032358', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 28, 1, '2021-12-28 14:17:22', '2021-12-28 14:17:22', NULL),
(593, '1640672316_f611434cefd87422aa8a.jpg', 'S13010', 'Darkness Control Board With Short Lead Tape', 'WARRING', '035316', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 28, 1, '2021-12-28 14:18:36', '2021-12-28 14:18:36', NULL),
(594, '1640672417_a5b13279bd794eb8445e.jpg', 'S13011', 'PCB & Power Board Assy. /WW200E-K', 'WARRING', '\'032763', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 28, 1, '2021-12-28 14:20:17', '2021-12-28 14:20:17', NULL),
(595, '1640672483_9cdc815c4115a1fef964.jpg', 'S13012', 'PCB Board /WWCM180K', 'WARRING', '035344', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 28, 1, '2021-12-28 14:21:23', '2021-12-28 14:21:23', NULL),
(596, '1640672550_d92d2f15b2acb51f71d8.jpg', 'S13013', 'Blade Assy.', 'WARRING', '503397', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 28, 1, '2021-12-28 14:22:30', '2021-12-28 14:22:30', NULL),
(597, '1640672631_603a43b5bd1e1f8552fe.jpg', 'S13014', 'Center Element /WCT708E - WCT708K', 'WARRING', '026990', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 28, 1, '2021-12-28 14:23:51', '2021-12-28 14:23:51', NULL),
(598, '1640672690_dd48ae11e1115c07bf1b.jpg', 'S13015', 'Outer Element /WCT708E - WCT708K', 'WARRING', '026991', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 28, 1, '2021-12-28 14:24:50', '2021-12-28 14:24:50', NULL),
(599, '1640672760_c1372872bf623e491b09.jpg', 'S13016', 'Browning Control Knob /WCT708', 'WARRING', '026774', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 28, 1, '2021-12-28 14:26:00', '2021-12-28 14:26:00', NULL),
(600, '1640672900_5d57b20a4d1bd687b060.jpg', 'S13017', 'Carriage Control Lever Knob/WCT708', 'WARRING', '026775', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 28, 1, '2021-12-28 14:26:57', '2021-12-28 14:28:20', NULL),
(601, '1640673059_87f3a05d174905fe4296.jpg', 'S13018', 'Blending Assy. With O Ring & Nut /TBB', 'WARRING', '\'035465', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 28, 1, '2021-12-28 14:30:59', '2021-12-28 14:30:59', NULL),
(602, '1640673350_d09f91683441ad79452b.png', 'S1321', 'FAN MICROWAVE', 'MIDEA', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 29, 1, '2021-12-28 14:35:50', '2021-12-28 14:35:50', NULL),
(603, '1640673433_8c0a02108a7837715442.png', 'S1011', 'ELEMEN TOASTER', 'SUN EAST', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 21, 1, '2021-12-28 14:37:13', '2021-12-28 14:37:13', NULL),
(604, '1641266829_837c4e1f01f05c50b2ca.png', 's11360', 'CHEFTOP MIND MAPS', 'UNOX', 'XECQC-0013-E', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2022-01-04 11:25:59', '2022-01-04 11:27:09', NULL),
(605, '1641266944_f9158101633bd2dd5d6f.png', 's11361', 'CHEFLUX', 'UNOX', 'XHC002', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2022-01-04 11:29:04', '2022-01-04 11:29:04', NULL),
(606, '1641267075_ba49ffa94f8b9fc03a5c.png', 's11362', 'BAKERTOP ACCESSORIES', 'UNOX', 'XHC003', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2022-01-04 11:31:15', '2022-01-04 11:31:15', NULL),
(607, '1641267147_d878ffc3719bed1e27c4.png', 's11363', ' BAKERTOP ACCESSORIES', 'UNOX', 'XHC004', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2022-01-04 11:32:27', '2022-01-04 11:32:27', NULL),
(608, '1641267309_30b338adc0a9bc7413ae.png', 's11364', 'POLLO.BLACK - 600X400', 'UNOX', 'GPR 430', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2022-01-04 11:35:09', '2022-01-04 11:35:09', NULL),
(609, '1641267382_2e51bfc3ec0c069bde66.png', 's11365', 'POLLO GRID', 'UNOX', 'GPR 425', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2022-01-04 11:36:23', '2022-01-04 11:36:23', NULL),
(610, '1641267498_5efe54d7b88d41e93784.png', 's11366', 'ALUMINIUM PAN', 'UNOX', 'TG 405', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2022-01-04 11:38:18', '2022-01-04 11:38:18', NULL),
(611, '1641267625_7800be5d088b109ac94c.png', 's11367', 'FLAT CHROMIUM PLATED WIRE GRID', 'UNOX', 'GPR 405', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2022-01-04 11:40:25', '2022-01-04 11:40:25', NULL),
(612, '1641267725_4573fe67ffc590c7184f.png', 's11368', 'PERFORATED ALUMINIUM PAN', 'UNOX', 'TG 410', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2022-01-04 11:42:05', '2022-01-04 11:42:05', NULL),
(613, '1641268042_e2b3b874bb73d6e2b926.png', 's11369', 'FORO.BLACK - 600x400', 'UNOX', 'TG 430', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2022-01-04 11:47:22', '2022-01-04 11:47:22', NULL),
(614, '1641268112_a7424abfe6fc41d148e4.png', 's11370', 'FAKIRO™ - 600x400', 'UNOX', 'TG 440', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2022-01-04 11:48:32', '2022-01-04 11:48:32', NULL),
(615, '1641268266_2460f164e5641aee31e1.png', 's11371', 'BAGUETTE.GRID - 600X400', 'UNOX', 'GPR 410', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2022-01-04 11:51:06', '2022-01-04 11:51:06', NULL),
(616, '1641268325_fadf2e5f052f6310a213.png', 's11372', 'FORO.BAGUETTE.BLAK - 600x400', 'UNOX', 'TG 435', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2022-01-04 11:52:05', '2022-01-04 11:52:05', NULL),
(617, '1641268420_955b21481946945e3608.png', 's11373', 'FORO.BAGUETTE - 600x400', 'UNOX', 'TG 445', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2022-01-04 11:53:40', '2022-01-04 11:53:40', NULL),
(618, '1641268602_77721bcdd3551b8d52fe.png', 's11374', 'FAKIRO™ - GN 1/1', 'UNOX', 'TG 875', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2022-01-04 11:56:42', '2022-01-04 11:56:42', NULL),
(619, '1641268672_b1bd5157d6f13fefd6d5.png', 's11375', 'STEAM&FRY - GN 1/1', 'UNOX', 'GPR 815', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2022-01-04 11:57:52', '2022-01-04 11:57:52', NULL),
(620, '1641268745_d1b3e51a62d6cccf2c4e.png', 's11376', 'POLLO.BLACK - GN 1/1', 'UNOX', 'GPR 825', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2022-01-04 11:59:05', '2022-01-04 11:59:05', NULL),
(621, '1641268828_2dbc58dbc0dafd42ab95.png', 's11377', 'POLLO.GRILL - GN 1/1', 'UNOX', 'GPR 840', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2022-01-04 12:00:29', '2022-01-04 12:00:29', NULL),
(622, '1641268967_0cc069a6ae46ef29523a.png', 's11378', 'COOKING ESSENTIALS START-UP KIT FOR GN 1/1 OVENS', 'UNOX', 'XUC 018', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2022-01-04 12:02:47', '2022-01-04 12:02:47', NULL),
(623, '1641269048_e90b9dc5d5e16b92a264.png', 's11379', 'COOKING ESSENTIALS START-UP KIT FOR GN 1/1 OVENS', 'UNOX', 'XUC 004', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2022-01-04 12:04:09', '2022-01-04 12:04:09', NULL),
(624, '1641269121_3a34e9c78c625ba31f47.png', 's11380', 'GRILL - GN 1/1', 'UNOX', 'TG 885', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2022-01-04 12:05:21', '2022-01-04 12:05:21', NULL),
(625, '1641269234_4df837b745236c62706b.png', 's11381', 'FAKIRO.GRILL - GN1/1', 'UNOX', 'TG 870', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2022-01-04 12:07:14', '2022-01-04 12:07:14', NULL),
(626, '1641269514_8f4ab0279991519cb178.png', 's11382', 'EGGS 6X2 - GN 1/1', 'UNOX', 'TG 935', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2022-01-04 12:11:54', '2022-01-04 12:11:54', NULL),
(627, '1641269583_114c64b2f1b28dd4c42c.png', 's11383', 'PAN.FRY - GN 1/1', 'UNOX', 'TG 905', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2022-01-04 12:13:03', '2022-01-04 12:13:03', NULL),
(628, '1641269657_b519c058690b0307d851.png', 's11384', 'BLACK.20 - GN 1/1', 'UNOX', 'TG 895', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2022-01-04 12:14:17', '2022-01-04 12:14:17', NULL),
(629, '1641269766_135416c225fb59e06d69.png', 's11385', 'BLACK.20 - GN 1/1', 'UNOX', 'TG 895', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2022-01-04 12:16:06', '2022-01-04 12:16:06', NULL),
(630, '1641269846_64020d256222ebdb383f.png', 's11386', 'BLACK.40 - GN 1/1', 'UNOX', 'TG 900', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2022-01-04 12:17:26', '2022-01-04 12:17:26', NULL),
(631, '1641269912_b150ee11d3f6475ca3db.png', 's11387', 'FAKIRO™ - GN 2/3', 'UNOX', 'TG 715', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2022-01-04 12:18:32', '2022-01-04 12:18:32', NULL),
(632, '1641269913_47a900ac7a8f0113f896.png', 's11387', 'FAKIRO™ - GN 2/3', 'UNOX', 'TG 715', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2022-01-04 12:18:33', '2022-01-04 12:18:33', NULL),
(633, '1641269980_8ffb095e30c3071aecb7.png', 's11388', 'STEAM&FRY - GN 2/3', 'UNOX', 'GPR 710', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2022-01-04 12:19:40', '2022-01-04 12:19:40', NULL),
(634, '1641270032_1f4e9c9de242c1e96de4.png', 's11389', 'POLLO - GN 2/3', 'UNOX', 'GPR 715', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2022-01-04 12:20:32', '2022-01-04 12:20:32', NULL),
(635, '1641270092_a47c0a402a81f1d0c093.png', 's11390', 'GRILL - GN 2/3', 'UNOX', 'TG 720', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2022-01-04 12:21:32', '2022-01-04 12:21:32', NULL),
(636, '1641270160_72a4e898d1fda9d39fed.png', 's11391', 'PAN.FRY - GN 2/3', 'UNOX', 'TG 735', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2022-01-04 12:22:40', '2022-01-04 12:22:40', NULL),
(637, '1641270223_c7a9eb31a18a81a684f8.png', 's11392', 'FORO.BLACK - GN 2/3', 'UNOX', 'TG 730', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 9, 1, '2022-01-04 12:23:43', '2022-01-04 12:23:43', NULL),
(638, '1641276039_363cfde33f3ba6156613.png', 'S1311', 'DECK MOUNTED PRE RINSE- HOT & COOL WATER', 'PRERINSE', 'BXF-A7-1', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 30, 1, '2022-01-04 14:00:39', '2022-01-04 14:00:39', NULL),
(639, '1641276102_e4cdfe5a50114d5ef6aa.png', 'S1312', 'Twist Level Drain', 'PRERINSE', 'BXF-Q5', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 30, 1, '2022-01-04 14:01:42', '2022-01-04 14:01:42', NULL),
(640, '1641276103_b42bae3b85823e462fdf.png', 'S1312', 'Twist Level Drain', 'PRERINSE', 'BXF-Q5', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 30, 1, '2022-01-04 14:01:43', '2022-01-04 14:01:43', NULL),
(641, '1641276166_e8137a60b14dc3efc101.png', 'S1313', 'SINGLE VALVE DECK-MOUNTED FAUCET', 'PRERINSE', 'BXF-LN3G', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 30, 1, '2022-01-04 14:02:46', '2022-01-04 14:02:46', NULL),
(642, '1641276220_4b852b9eff3b51406645.png', 'S1314', 'STANDART DUTY DECK MOUNTED FAUCET', 'PRERINSE', 'BXF-H12', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 30, 1, '2022-01-04 14:03:40', '2022-01-04 14:03:40', NULL),
(645, '1641276516_04aad6f309e6afbc8172.png', 'S1317', 'FAUCET SENSOR ', 'PRERINSE', 'FAUCET SENSOR ', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 30, 1, '2022-01-04 14:08:36', '2022-01-04 14:08:36', NULL),
(646, '1641276610_32479c5f579414d07d49.png', 'S1318', 'FAUCET SENSOR ', 'PRERINSE', 'BXF-EF21', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 30, 1, '2022-01-04 14:10:10', '2022-01-04 14:10:10', NULL),
(647, '1641276681_38b35640f5bd5926dccc.png', 'S1319', 'SOAP DISPENSER', 'PRERINSE', 'BX-SO29', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 30, 1, '2022-01-04 14:11:21', '2022-01-04 14:11:21', NULL),
(648, '1641276739_66d15e2ddb333c444b06.png', 'S13110', 'CAST DOUBLE KNEE VALVE', 'PRERINSE', 'BXF-N4', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 30, 1, '2022-01-04 14:12:19', '2022-01-04 14:12:19', NULL),
(649, '1641277234_7b1e232ac291fe2644ee.png', 'S13111', 'CAST DOUBLE FOOT VALVE', 'PRERINSE', 'BXF-N1', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 30, 1, '2022-01-04 14:20:34', '2022-01-04 14:20:34', NULL),
(650, '1641277309_8da94f6f958b5ca3fc8b.png', 'S13112', 'DECK SPOUT', 'PRERINSE', 'BXF-N8', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 30, 1, '2022-01-04 14:21:49', '2022-01-04 14:21:49', NULL),
(651, '1641277529_21b4826d013e9d045b26.png', 'S13113', 'DECK SPOUT', 'PRERINSE', 'BXF-LN6', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 30, 1, '2022-01-04 14:25:30', '2022-01-04 14:25:30', NULL),
(652, '1641277796_6b67088f7bc391729309.png', 'Horse reel ', 'S13114', 'PRERINSE', 'BXF-HR001', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 30, 1, '2022-01-04 14:29:56', '2022-01-04 14:29:56', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `item_categories`
--

CREATE TABLE `item_categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `item_categories`
--

INSERT INTO `item_categories` (`id`, `category_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'Lotus', '2021-10-29 09:47:43', '2021-10-29 09:47:43', NULL),
(4, 'Ozti', '2021-10-29 09:48:00', '2021-10-29 09:48:00', NULL),
(5, 'ALTO SHAAM', '2021-10-29 11:52:35', '2021-10-29 11:52:35', NULL),
(6, 'ICE MATIC', '2021-10-29 12:02:24', '2021-10-29 12:02:24', NULL),
(7, 'WINTERHALTER', '2021-10-29 13:54:07', '2021-10-29 13:54:07', NULL),
(8, 'RATIONAL', '2021-10-29 14:08:28', '2021-10-29 14:08:28', NULL),
(9, 'UNOX', '2021-10-29 14:50:48', '2021-10-29 14:50:48', NULL),
(10, 'GENERAL', '2021-10-29 16:43:37', '2021-10-29 16:43:37', NULL),
(11, 'FIMAR', '2021-10-29 16:47:26', '2021-10-29 16:47:26', NULL),
(12, 'HATCO', '2021-10-30 10:27:25', '2021-10-30 10:27:25', NULL),
(13, 'PRAIM', '2021-10-30 10:34:04', '2021-10-30 10:34:04', NULL),
(14, 'ROTONDI', '2021-10-30 10:42:40', '2021-10-30 10:42:40', NULL),
(15, 'HAN SINK', '2021-10-30 10:50:12', '2021-10-30 10:50:12', NULL),
(16, 'ESSA', '2021-10-30 10:57:10', '2021-10-30 10:57:10', NULL),
(17, 'ROYAL', '2021-10-30 11:07:26', '2021-10-30 11:07:26', NULL),
(18, 'MEHEN', '2021-10-30 11:14:11', '2021-10-30 11:14:11', NULL),
(19, 'ATM COOL', '2021-10-30 11:21:06', '2021-10-30 11:21:06', NULL),
(20, 'MIX BRAND ', '2021-12-17 10:51:20', '2021-12-17 10:51:20', NULL),
(21, 'SUN EAST', '2021-12-18 10:06:16', '2021-12-18 10:06:16', NULL),
(22, 'THERMATEK', '2021-12-18 17:07:56', '2021-12-18 17:07:56', NULL),
(23, 'THERMATEK', '2021-12-18 17:09:23', '2021-12-18 17:09:23', NULL),
(24, 'PLAT & PIPA', '2021-12-28 10:34:38', '2021-12-28 10:34:38', NULL),
(25, 'SOPPAS', '2021-12-28 11:20:37', '2021-12-28 11:20:37', NULL),
(26, 'MATERIAL', '2021-12-28 11:41:42', '2021-12-28 11:41:42', NULL),
(27, 'CHEMICAL', '2021-12-28 13:46:30', '2021-12-28 13:46:30', NULL),
(28, 'WARRING', '2021-12-28 13:57:42', '2021-12-28 13:57:42', NULL),
(29, 'MIDEA', '2021-12-28 14:34:24', '2021-12-28 14:34:24', NULL),
(30, 'PRERINSE', '2022-01-04 13:57:49', '2022-01-04 13:57:49', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `members`
--

CREATE TABLE `members` (
  `id` int(11) UNSIGNED NOT NULL,
  `member_code` varchar(50) NOT NULL,
  `member_name` varchar(255) NOT NULL,
  `member_contact` bigint(20) NOT NULL,
  `member_description` longtext,
  `member_company` varchar(255) DEFAULT NULL,
  `member_job` varchar(255) DEFAULT NULL,
  `member_discount` float DEFAULT NULL,
  `member_email` varchar(255) DEFAULT NULL,
  `member_status` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `members`
--

INSERT INTO `members` (`id`, `member_code`, `member_name`, `member_contact`, `member_description`, `member_company`, `member_job`, `member_discount`, `member_email`, `member_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '20211019163554', 'General User', 81915656865, NULL, NULL, NULL, 0, 'general@gmail.com', 1, '2021-10-19 16:35:54', '2021-10-19 16:35:54', NULL),
(3, '2022012091', 'Pak Mahmud', 81222111333, '', 'maju mundur asik', 'pengedar narkoba', 5, 'mahmud@gmail.com', 0, '2022-01-07 12:31:32', '2022-01-26 13:10:45', NULL),
(4, '2022013647', 'Abc', 88888, '', NULL, NULL, 0, 'jeis@gmail.com', 0, '2022-01-07 15:00:33', '2022-01-07 15:00:33', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'App\\Database\\Migrations\\CreateAuthTables', 'default', 'App', 1634632528, 1),
(2, '2021-06-14-053853', 'App\\Database\\Migrations\\CreateRequiredDatabaseTable', 'default', 'App', 1634632530, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) UNSIGNED NOT NULL,
  `order_code` varchar(50) NOT NULL,
  `order_total_quantity` int(11) NOT NULL,
  `order_total_item` int(11) NOT NULL,
  `order_status` int(11) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `supplier_id` int(11) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `order_code`, `order_total_quantity`, `order_total_item`, `order_status`, `user_id`, `supplier_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 'HYM0G39R7V', 1, 4, 8, 11, 1, '2022-01-07 11:47:32', '2022-01-07 12:00:17', NULL),
(6, '0MNRS8BKV1', 1, 2, 6, 11, 1, '2022-01-07 14:39:18', '2022-01-07 14:43:18', NULL),
(7, 'KR5G31B296', 1, 4, 8, 11, 1, '2022-01-07 15:07:17', '2022-01-07 15:09:38', NULL),
(8, 'STW37PXZNH', 2, 2, 6, 11, 1, '2022-01-08 11:23:12', '2022-01-08 11:34:44', NULL),
(9, '4TKNS1HZ2C', 1, 23, 1, 3, 1, '2022-01-26 12:07:54', '2022-01-26 13:24:21', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) UNSIGNED NOT NULL,
  `detail_quantity` int(11) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `order_id` int(11) UNSIGNED NOT NULL,
  `item_id` int(11) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `order_details`
--

INSERT INTO `order_details` (`id`, `detail_quantity`, `user_id`, `order_id`, `item_id`, `created_at`, `updated_at`) VALUES
(3, 4, 11, 5, 351, '2022-01-07 11:51:03', '2022-01-07 11:51:14'),
(4, 2, 11, 6, 62, '2022-01-07 14:39:47', '2022-01-07 14:39:47'),
(5, 4, 11, 7, 4, '2022-01-07 15:07:32', '2022-01-07 15:07:32'),
(6, 1, 11, 8, 4, '2022-01-08 11:24:53', '2022-01-08 11:24:53'),
(7, 1, 11, 8, 13, '2022-01-08 11:25:25', '2022-01-08 11:25:25'),
(8, 23, 3, 9, 346, '2022-01-26 13:21:18', '2022-01-26 13:24:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pphs`
--

CREATE TABLE `pphs` (
  `id` int(11) UNSIGNED NOT NULL,
  `pph_value` float NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `pphs`
--

INSERT INTO `pphs` (`id`, `pph_value`, `created_at`, `updated_at`) VALUES
(1, 10, '2021-10-19 16:35:54', '2022-01-27 15:11:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `request_orders`
--

CREATE TABLE `request_orders` (
  `id` int(11) UNSIGNED NOT NULL,
  `request_description` text NOT NULL,
  `request_total` int(11) NOT NULL,
  `request_status` int(11) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `item_id` int(11) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `request_orders`
--

INSERT INTO `request_orders` (`id`, `request_description`, `request_total`, `request_status`, `user_id`, `item_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Perlu 7 Untuk Pullman', 7, 1, 8, 4, '2021-11-16 15:19:10', '2021-11-16 15:20:08', NULL),
(2, 'Untuk Pullman ', 4, 1, 9, 468, '2022-01-07 11:32:25', '2022-01-07 11:46:39', NULL),
(3, 'Harus Include S/s Bin', 2, 1, 9, 62, '2022-01-07 14:35:56', '2022-01-07 14:38:51', NULL),
(4, 'Untuk Proyek Suka Espresso (harus Include Apa Yah)', 3, 1, 9, 425, '2022-01-08 11:17:03', '2022-01-08 11:18:42', NULL),
(5, 'Test', 5, 0, 3, 181, '2022-01-26 13:16:06', '2022-01-26 13:16:06', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sales`
--

CREATE TABLE `sales` (
  `id` int(11) UNSIGNED NOT NULL,
  `sale_code` varchar(50) NOT NULL,
  `sale_handling` float DEFAULT NULL,
  `sale_total` float NOT NULL,
  `sale_pay` float NOT NULL,
  `sale_discount` float NOT NULL,
  `sale_profit` float NOT NULL,
  `sale_status` int(11) NOT NULL,
  `sale_ket` varchar(50) DEFAULT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `member_id` int(11) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `sales`
--

INSERT INTO `sales` (`id`, `sale_code`, `sale_handling`, `sale_total`, `sale_pay`, `sale_discount`, `sale_profit`, `sale_status`, `sale_ket`, `user_id`, `member_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, 'WB416DXHFZ', NULL, 0, 0, 0, 0, 0, 'General', 8, 1, '2021-12-15 14:08:49', '2021-12-15 14:08:49', NULL),
(9, '5RYQ7JKHMX', 250000, 11250000, 112500000, 0, 1000000, 0, 'General', 10, 1, '2022-01-07 11:26:58', '2022-01-26 23:57:13', NULL),
(11, 'S3P4DGYMCK', NULL, 0, 0, 5, 0, 0, 'Project', 10, 3, '2022-01-07 12:31:46', '2022-01-07 12:31:46', NULL),
(14, '6BQ7891JD0', NULL, 10500000, 10500000, 5, 500000, 1, 'Project', 10, 3, '2022-01-07 15:30:47', '2022-01-27 22:19:15', NULL),
(16, '2WLXV683BP', 500000, 11000000, 12000000, 5, 500000, 0, 'Project', 8, 3, '2022-01-07 15:55:46', '2022-01-26 23:53:13', NULL),
(17, 'MVS62LJ3Y5', NULL, 0, 0, 5, 0, 0, 'Project', 10, 3, '2022-01-07 16:44:22', '2022-01-07 16:44:22', NULL),
(18, 'BZPX7K23NY', 25000, 10525000, 10600000, 5, 500000, 0, 'Project', 8, 3, '2022-01-12 16:43:46', '2022-01-26 23:32:14', NULL),
(21, 'GHLK4R0Y21', 200000, 11200000, 11500000, 0, 1000000, 0, 'General', 3, 1, '2022-01-26 13:25:44', '2022-01-26 23:38:48', NULL),
(22, '67Z8LP59BT', 200000, 22200000, 22200000, 0, 2000000, 0, 'Project', 3, 4, '2022-01-26 23:45:52', '2022-01-26 23:53:41', NULL),
(23, '2F3JXDMTCN', 200000, 11200000, 11200000, 0, 1000000, 1, 'General', 3, 1, '2022-01-26 23:54:01', '2022-01-26 23:59:54', NULL),
(24, 'R961JY7QKB', 50000, 11050000, 0, 0, 1000000, 0, 'General', 3, 1, '2022-01-27 00:00:03', '2022-01-27 00:02:27', NULL),
(25, 'S84RY76JDV', NULL, 22000000, 0, 0, 2000000, 0, 'Project', 3, 4, '2022-01-27 20:59:55', '2022-01-27 21:00:03', NULL),
(26, 'MF5794XWTY', 25000, 11025000, 11050000, 0, 1000000, 1, 'Project', 3, 4, '2022-01-27 22:20:08', '2022-01-27 22:24:22', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sale_details`
--

CREATE TABLE `sale_details` (
  `id` int(11) UNSIGNED NOT NULL,
  `detail_total` float NOT NULL,
  `detail_quantity` int(11) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `item_id` int(11) UNSIGNED NOT NULL,
  `sale_id` int(11) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `sale_details`
--

INSERT INTO `sale_details` (`id`, `detail_total`, `detail_quantity`, `user_id`, `item_id`, `sale_id`, `created_at`, `updated_at`) VALUES
(9, 10000000, 1, 10, 4, 14, '2022-01-07 15:30:52', '2022-01-07 15:30:52'),
(11, 10000000, 1, 8, 4, 16, '2022-01-07 15:55:58', '2022-01-07 15:55:58'),
(13, 10000000, 1, 3, 4, 21, '2022-01-26 13:37:48', '2022-01-26 13:37:48'),
(14, 10000000, 1, 3, 4, 18, '2022-01-26 20:17:45', '2022-01-26 20:17:45'),
(15, 20000000, 2, 3, 4, 22, '2022-01-26 23:51:44', '2022-01-26 23:51:44'),
(16, 10000000, 1, 3, 4, 23, '2022-01-26 23:56:24', '2022-01-26 23:56:24'),
(17, 10000000, 1, 3, 4, 9, '2022-01-26 23:57:01', '2022-01-26 23:57:01'),
(18, 10000000, 1, 3, 4, 24, '2022-01-27 00:00:08', '2022-01-27 00:00:08'),
(19, 20000000, 2, 3, 4, 25, '2022-01-27 21:00:03', '2022-01-27 21:00:03'),
(20, 10000000, 1, 3, 4, 26, '2022-01-27 22:20:14', '2022-01-27 22:20:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) UNSIGNED NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `supplier_contact` bigint(20) NOT NULL,
  `supplier_email` varchar(255) NOT NULL,
  `supplier_address` text NOT NULL,
  `supplier_description` longtext NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier_name`, `supplier_contact`, `supplier_email`, `supplier_address`, `supplier_description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Eka', 87861695138, 'ekawiratha@gmail.com', 'Jl.ssls', 'Dwee', '2021-10-19 16:42:25', '2021-10-19 16:42:25', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `user_image` longtext,
  `user_number` varchar(15) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `user_image`, `user_number`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'super.admin@ganatech.id', 'Super Admin User', NULL, NULL, '$2y$10$eWVIWut.Fqv35WkdtGSVauZxFKMo/Xq8fYycwZvvfs30B1VAyWaOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-10-19 16:35:53', '2021-10-19 16:35:53', NULL),
(4, 'atasan@ganatech.id', 'Atasan User', NULL, NULL, '$2y$10$eWVIWut.Fqv35WkdtGSVauZxFKMo/Xq8fYycwZvvfs30B1VAyWaOS', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-10-19 16:35:53', '2021-10-19 16:35:53', NULL),
(7, 'storedintara@gmail.com', 'Indra', NULL, '', '$2y$10$GOQHFVzUUYD6M5dQBrgtAuJtqJd10f1Vhqt3xOHvWD0.T32l3vfZa', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-10-28 11:55:00', '2021-10-28 11:55:00', NULL),
(8, 'ekawiratha@gmail.com', 'Eka IT', NULL, '', '$2y$10$VWh5SeI8CmIllsA7Lk50F.tfdw4jLxIzQCWbhvOiREO2Xk3Xv4hwy', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-10-28 11:57:06', '2021-10-28 11:57:06', NULL),
(9, 'dintarakitchen@gmail.com', 'Forrin', NULL, '', '$2y$10$93tbcd3ZNT9c7OopZmOAAulS2ejTlN7dH3bi1.Z.BRuS.UHK1/Z6y', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-10-28 11:59:37', '2021-10-28 11:59:37', NULL),
(10, 'marketing@dintarakitchen.com', 'Jeanny', NULL, '', '$2y$10$uIIunfkUOd324K18J5mGquznLxlfFyACOmeu0RgS1E6Gis6/Q5PVq', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-10-28 12:01:26', '2021-10-28 12:01:26', NULL),
(11, 'purchasing@dintarakitchen.com', 'Oka', NULL, '', '$2y$10$nJjM8fJ/xuYUJH9d6CNWMe9BCHT33vKxyDs1b4lvvu/rLciKG0MmK', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-10-28 12:03:13', '2021-10-28 12:03:13', NULL),
(12, 'penyimpananit.dnt1@gmail.com', 'Mahasiswa', NULL, '', '$2y$10$7C0naYWApHef2bGxAj.q.uoUtpNxkQkMEwwthWCh3.QmpM90oUIBK', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-10-29 09:45:57', '2021-10-29 09:45:57', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indeks untuk tabel `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indeks untuk tabel `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indeks untuk tabel `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indeks untuk tabel `invoice_settings`
--
ALTER TABLE `invoice_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_supplier_id_foreign` (`supplier_id`),
  ADD KEY `category_id_supplier_id` (`category_id`,`supplier_id`);

--
-- Indeks untuk tabel `item_categories`
--
ALTER TABLE `item_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_supplier_id_foreign` (`supplier_id`),
  ADD KEY `user_id_supplier_id` (`user_id`,`supplier_id`);

--
-- Indeks untuk tabel `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_item_id_foreign` (`item_id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `user_id_item_id` (`user_id`,`item_id`);

--
-- Indeks untuk tabel `pphs`
--
ALTER TABLE `pphs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `request_orders`
--
ALTER TABLE `request_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_orders_item_id_foreign` (`item_id`),
  ADD KEY `user_id_item_id` (`user_id`,`item_id`);

--
-- Indeks untuk tabel `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_member_id_foreign` (`member_id`),
  ADD KEY `user_id_member_id` (`user_id`,`member_id`);

--
-- Indeks untuk tabel `sale_details`
--
ALTER TABLE `sale_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_details_item_id_foreign` (`item_id`),
  ADD KEY `sale_details_sale_id_foreign` (`sale_id`),
  ADD KEY `user_id_item_id_sale_id` (`user_id`,`item_id`,`sale_id`);

--
-- Indeks untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT untuk tabel `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `invoice_settings`
--
ALTER TABLE `invoice_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=653;

--
-- AUTO_INCREMENT untuk tabel `item_categories`
--
ALTER TABLE `item_categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pphs`
--
ALTER TABLE `pphs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `request_orders`
--
ALTER TABLE `request_orders`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `sale_details`
--
ALTER TABLE `sale_details`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `item_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `items_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `request_orders`
--
ALTER TABLE `request_orders`
  ADD CONSTRAINT `request_orders_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `request_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sale_details`
--
ALTER TABLE `sale_details`
  ADD CONSTRAINT `sale_details_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sale_details_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sale_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
