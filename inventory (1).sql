-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2022 at 11:57 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `musak` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `title`, `name`, `address`, `phone`, `bin`, `musak`, `discount`, `created_at`, `updated_at`) VALUES
(1, 'Head Office', 'Head Office', 'Dhaka', '01234567890', '', '', '', NULL, NULL),
(2, 'North Tower', 'North Tower', 'Address', '45435435', '87890274489023', '6.2', '0', '2022-09-17 01:40:17', '2022-09-17 01:40:17');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `br_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `br_code`, `created_at`, `updated_at`) VALUES
(1, 'Mens wear', '11', '2022-09-17 01:41:25', '2022-09-17 01:41:25');

-- --------------------------------------------------------

--
-- Table structure for table `configs`
--

CREATE TABLE `configs` (
  `id` int(11) NOT NULL DEFAULT 1,
  `business_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'My Company',
  `owner_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Md Masud',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Dhaka, Bangladersh',
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0088 0123456789',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin@business.com',
  `slogan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'company slogan here',
  `return_policy` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Return Policy Change Here',
  `memo_header` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '..',
  `default_tax` double(8,2) NOT NULL DEFAULT 1.00,
  `default_tax_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'VAT',
  `branch_qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '3',
  `autobarcode` tinyint(4) NOT NULL DEFAULT 0,
  `br_line` tinyint(4) NOT NULL DEFAULT 0,
  `ecommerce` tinyint(4) NOT NULL DEFAULT 0,
  `logo` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'logo.png',
  `mono` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'mono.png',
  `support` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'MaxDigital.live',
  `support_link` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'http://maxdigital.live',
  `support_contact` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '01763036764',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `configs`
--

INSERT INTO `configs` (`id`, `business_name`, `owner_name`, `address`, `contact`, `email`, `slogan`, `return_policy`, `memo_header`, `default_tax`, `default_tax_name`, `branch_qty`, `autobarcode`, `br_line`, `ecommerce`, `logo`, `mono`, `support`, `support_link`, `support_contact`, `created_at`, `updated_at`) VALUES
(1, 'My Company', 'Md Masud', 'Dhaka, Bangladersh', '0088 0123456789', 'admin@business.com', 'company slogan here', '<p>Return Policy</p><p> Change Here</p><p>Hi&nbsp;</p><p>Hola&nbsp;</p>', '<p>Return Policy</p><p>Change Here</p><p>Hi&nbsp;</p><p>Hola&nbsp;</p>', 1.00, 'VAT', '3', 0, 4, 0, 'logo.png', 'mono.png', 'MaxDigital.live', 'http://maxdigital.live', '01763036764', NULL, '2022-10-18 01:44:09');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_salary` double(4,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `expensetype_id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `amount` double(8,2) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addby` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `expensetype_id`, `branch_id`, `amount`, `description`, `addby`, `created_at`, `updated_at`) VALUES
(5, 1, 2, 34.00, '', 'Sales', '2022-09-17 23:07:44', '2022-09-17 23:07:44'),
(6, 1, 1, 3440.00, 'fddg', 'admin', '2022-09-17 23:09:30', '2022-09-18 01:58:55'),
(7, 1, 2, 7500.00, 'Morning', 'Sales', '2022-09-18 02:38:51', '2022-09-18 02:40:48');

-- --------------------------------------------------------

--
-- Table structure for table `expensetypes`
--

CREATE TABLE `expensetypes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `typename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expensetypes`
--

INSERT INTO `expensetypes` (`id`, `typename`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Electricty Bill', '1', '2022-09-17 01:36:54', '2022-09-17 01:36:54'),
(2, 'Internet Bill', '1', '2022-09-18 02:41:37', '2022-09-18 02:41:37'),
(3, 'Office Rent', '1', '2022-09-18 02:41:53', '2022-09-18 02:41:53'),
(4, 'Shop Rent', '1', '2022-09-18 02:42:02', '2022-09-18 02:42:02');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `sku` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `variation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `cost_price` double(8,2) NOT NULL,
  `unit_price` double(8,2) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `branch_id`, `item_id`, `sku`, `variation`, `qty`, `cost_price`, `unit_price`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '1111211', '[{\"vvid\":1,\"variation\":\"Size\",\"value\":\"L\"}]', 30, 600.00, 1500.00, 1, '2022-09-17 01:42:23', '2022-10-18 01:53:49'),
(2, 2, 1, '1111211', '[{\"vvid\":1,\"variation\":\"Size\",\"value\":\"L\"}]', 26, 600.00, 1500.00, 1, '2022-09-17 01:42:46', '2022-10-18 01:53:49');

-- --------------------------------------------------------

--
-- Table structure for table `invoptions`
--

CREATE TABLE `invoptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `inventory_id` bigint(20) UNSIGNED NOT NULL,
  `variation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `size_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumb_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `category_id`, `subcategory_id`, `name`, `thumb_url`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Jeans Pant Regular', NULL, 1, '2022-09-17 01:42:00', '2022-09-17 01:42:00');

-- --------------------------------------------------------

--
-- Table structure for table `journals`
--

CREATE TABLE `journals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `debit` double(8,2) NOT NULL,
  `credit` double(8,2) NOT NULL,
  `tranxtype` enum('cash','other') COLLATE utf8mb4_unicode_ci NOT NULL,
  `expensetype_id` bigint(20) UNSIGNED NOT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_11_010030_create_branches_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2021_01_23_163608_create_sessions_table', 1),
(6, '2021_01_24_005834_create_configs_table', 1),
(7, '2021_01_24_010205_create_employees_table', 1),
(8, '2021_01_24_010232_create_categories_table', 1),
(9, '2021_01_24_010509_create_subcategories_table', 1),
(10, '2021_01_24_010534_create_variations_table', 1),
(11, '2021_01_24_010548_create_variationvals_table', 1),
(12, '2021_01_24_010607_create_items_table', 1),
(13, '2021_01_24_010622_create_sizes_table', 1),
(14, '2021_01_24_010633_create_inventories_table', 1),
(15, '2021_01_24_010648_create_invoptions_table', 1),
(16, '2021_01_24_011655_create_skucounters_table', 1),
(17, '2021_01_24_011735_create_sales_table', 1),
(18, '2021_01_24_011843_create_salepayments_table', 1),
(19, '2021_01_24_011942_create_saleitems_table', 1),
(20, '2021_01_24_012053_create_saletaxes_table', 1),
(21, '2021_01_24_012134_create_trackinventories_table', 1),
(22, '2021_01_24_012207_create_transfers_table', 1),
(23, '2021_03_10_020945_create_userlogs_table', 1),
(24, '2021_04_21_165456_create_systemstatus_table', 1),
(25, '2021_05_09_130506_create_expensetypes_table', 1),
(26, '2021_05_11_001134_create_journals_table', 1),
(27, '2022_09_04_024846_create_customers_table', 1),
(28, '2022_09_15_032058_create_expenses_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `saleitems`
--

CREATE TABLE `saleitems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` bigint(20) UNSIGNED NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `sku` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `cost_price` double(8,2) NOT NULL,
  `unit_price` double(8,2) NOT NULL,
  `tax_code` double(8,2) NOT NULL,
  `tax_amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `saleitems`
--

INSERT INTO `saleitems` (`id`, `sale_id`, `inventory_id`, `item_id`, `sku`, `qty`, `cost_price`, `unit_price`, `tax_code`, `tax_amount`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, '1111211', 1, 600.00, 1500.00, 1.00, 15.00, '2022-09-17 03:55:23', '2022-09-17 03:55:23'),
(2, 2, 2, 1, '1111211', 1, 600.00, 1500.00, 1.00, 15.00, '2022-09-18 03:48:31', '2022-09-18 03:48:31'),
(3, 3, 2, 1, '1111211', 1, 600.00, 1500.00, 1.00, 15.00, '2022-09-19 20:34:34', '2022-09-19 20:34:34'),
(4, 4, 2, 1, '1111211', 1, 600.00, 1500.00, 1.00, 15.00, '2022-09-25 18:11:52', '2022-09-25 18:11:52');

-- --------------------------------------------------------

--
-- Table structure for table `salepayments`
--

CREATE TABLE `salepayments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salepayments`
--

INSERT INTO `salepayments` (`id`, `sale_id`, `type`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, 'cash', 1515.00, '2022-09-17 03:55:23', '2022-09-17 03:55:23'),
(2, 2, 'cash', 2000.00, '2022-09-18 03:48:31', '2022-09-18 03:48:31'),
(3, 3, 'cash', 1520.00, '2022-09-19 20:34:34', '2022-09-19 20:34:34'),
(4, 4, 'cash', 1600.00, '2022-09-25 18:11:52', '2022-09-25 18:11:52');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `total_item` tinyint(4) NOT NULL,
  `subtotal` double(8,2) NOT NULL,
  `total_sale` double(8,2) NOT NULL,
  `totalWTax` double(8,2) NOT NULL,
  `changeamount` double(8,2) NOT NULL,
  `total_payment` double(8,2) NOT NULL,
  `total_tax` double(8,2) NOT NULL,
  `total_discount` double(8,2) NOT NULL DEFAULT 0.00,
  `user_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `total_item`, `subtotal`, `total_sale`, `totalWTax`, `changeamount`, `total_payment`, `total_tax`, `total_discount`, `user_id`, `branch_id`, `customer_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1500.00, 1515.00, 1530.00, 0.00, 1515.00, 15.00, 0.00, 2, 2, 0, '2022-09-17 03:55:23', '2022-09-17 03:55:23'),
(2, 1, 1500.00, 1515.00, 1530.00, -485.00, 2000.00, 15.00, 0.00, 2, 2, 0, '2022-09-18 03:48:31', '2022-09-18 03:48:31'),
(3, 1, 1500.00, 1515.00, 1530.00, -5.00, 1520.00, 15.00, 0.00, 2, 2, 0, '2022-09-19 20:34:34', '2022-09-19 20:34:34'),
(4, 1, 1500.00, 1515.00, 1530.00, -85.00, 1600.00, 15.00, 0.00, 2, 2, 0, '2022-09-25 18:11:52', '2022-09-25 18:11:52');

-- --------------------------------------------------------

--
-- Table structure for table `saletaxes`
--

CREATE TABLE `saletaxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` bigint(20) UNSIGNED NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `tax_code` double(8,2) NOT NULL,
  `tax_amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('4JbTvAhP3caquziM0JNvEsTZaZGJ4m4KybzVqV5G', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36 Edg/105.0.1343.53', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiR3ZkWUtvQ2JsZ2l1MUptbWU0aEJEbnJhN3ZjMTMxMFY4cFk2bUNCcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9pbnZlbnRvcmllcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1666034171),
('LfKHbaaOV8JJZRbvzvV9QO6zhwy0RZKmgoXSmAeo', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiS09mcVRFV3VvalFpb3ZRSUN0dFBmZ2pxdDFVSmRld2xtcnFzd0RUNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3QvaW52ZW50b3J5L2ludmVudG9yaWVzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1666040041),
('OBMseDAbcIOHwOgADANPV3QEG5BU3ldrjUNKStAq', 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36 Edg/105.0.1343.53', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoid0xNRFpDVkRvbjd3ZEZNRkl4eFVhVEpxQlJmT3JmUm5aZE1LVHpyZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3QvaW52ZW50b3J5L3NhbGVzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1666035532);

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `measure` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `skucounters`
--

CREATE TABLE `skucounters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `skus` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skucounters`
--

INSERT INTO `skucounters` (`id`, `skus`, `created_at`, `updated_at`) VALUES
(1, '11', '2022-09-17 01:42:23', '2022-09-17 01:42:23');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `br_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `name`, `br_code`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pant', '112', '2022-09-17 01:41:39', '2022-09-17 01:41:39');

-- --------------------------------------------------------

--
-- Table structure for table `systemstatus`
--

CREATE TABLE `systemstatus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('on','off') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `systemstatus`
--

INSERT INTO `systemstatus` (`id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'on', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trackinventories`
--

CREATE TABLE `trackinventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `sku` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trackinventories`
--

INSERT INTO `trackinventories` (`id`, `inventory_id`, `item_id`, `user_id`, `branch_id`, `sku`, `qty`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, '1111211', 60, 'Manual Add', '2022-09-17 01:42:23', '2022-09-17 01:42:23'),
(2, 2, 1, 1, 2, '1111211', 30, 'Transfer-Add', '2022-09-17 01:42:46', '2022-09-17 01:42:46'),
(3, 1, 1, 1, 1, '1111211', 30, 'Transfer-To', '2022-09-17 01:42:46', '2022-09-17 01:42:46'),
(4, 2, 1, 2, 2, '1111211', -1, 'POS-1', '2022-09-17 03:55:23', '2022-09-17 03:55:23'),
(5, 2, 1, 2, 2, '1111211', -1, 'POS-2', '2022-09-18 03:48:31', '2022-09-18 03:48:31'),
(6, 2, 1, 2, 2, '1111211', -1, 'POS-3', '2022-09-19 20:34:34', '2022-09-19 20:34:34'),
(7, 2, 1, 2, 2, '1111211', -1, 'POS-4', '2022-09-25 18:11:52', '2022-09-25 18:11:52');

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sku` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_branch` int(11) NOT NULL,
  `to_branch` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transfers`
--

INSERT INTO `transfers` (`id`, `sku`, `from_branch`, `to_branch`, `qty`, `user_id`, `comment`, `created_at`, `updated_at`) VALUES
(1, '1111211', 1, 2, 30, 1, 'Single-Transfer', '2022-09-17 01:42:46', '2022-09-17 01:42:46');

-- --------------------------------------------------------

--
-- Table structure for table `userlogs`
--

CREATE TABLE `userlogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `userlogs`
--

INSERT INTO `userlogs` (`id`, `ip`, `username`, `branch`, `role`, `agent`, `created_at`, `updated_at`) VALUES
(1, '127.0.0.1', 'admin', '1', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', NULL, NULL),
(2, '127.0.0.1', 'admin', '1', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', NULL, NULL),
(3, '127.0.0.1', 'sales', '2', 'staff', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', NULL, NULL),
(4, '127.0.0.1', 'admin', '1', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', NULL, NULL),
(5, '127.0.0.1', 'sales', '2', 'staff', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', NULL, NULL),
(6, '127.0.0.1', 'admin', '1', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.134 Safari/537.36 Edg/103.0.1264.77', NULL, NULL),
(7, '127.0.0.1', 'admin', '1', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.134 Safari/537.36 Edg/103.0.1264.77', NULL, NULL),
(8, '127.0.0.1', 'admin', '1', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.134 Safari/537.36 Edg/103.0.1264.77', NULL, NULL),
(9, '127.0.0.1', 'admin', '1', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.134 Safari/537.36 Edg/103.0.1264.77', NULL, NULL),
(10, '127.0.0.1', 'admin', '1', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.134 Safari/537.36 Edg/103.0.1264.77', NULL, NULL),
(11, '127.0.0.1', 'admin', '1', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.134 Safari/537.36 Edg/103.0.1264.77', NULL, NULL),
(12, '127.0.0.1', 'sales', '2', 'staff', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', NULL, NULL),
(13, '127.0.0.1', 'admin', '1', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.134 Safari/537.36 Edg/103.0.1264.77', NULL, NULL),
(14, '127.0.0.1', 'sales', '2', 'staff', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', NULL, NULL),
(15, '127.0.0.1', 'admin', '1', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', NULL, NULL),
(16, '127.0.0.1', 'sales', '2', 'staff', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', NULL, NULL),
(17, '127.0.0.1', 'admin', '1', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', NULL, NULL),
(18, '127.0.0.1', 'sales', '2', 'staff', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', NULL, NULL),
(19, '127.0.0.1', 'admin', '1', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36 Edg/105.0.1343.53', NULL, NULL),
(20, '127.0.0.1', 'admin', '1', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36 Edg/105.0.1343.53', NULL, NULL),
(21, '127.0.0.1', 'admin', '1', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36 Edg/105.0.1343.53', NULL, NULL),
(22, '::1', 'admin', '1', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36', NULL, NULL),
(23, '127.0.0.1', 'admin', '1', 'admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36 Edg/105.0.1343.53', NULL, NULL),
(24, '::1', 'sales', '2', 'staff', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36 Edg/105.0.1343.53', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'staff',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` tinyint(4) NOT NULL DEFAULT 1,
  `unit_salary` double(4,2) DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0123456789',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `canTransfer` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `current_team_id`, `profile_photo_path`, `branch_id`, `unit_salary`, `phone`, `status`, `canTransfer`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', NULL, NULL, '$2y$10$ig5bSiY/kMlgalHkRyKJF.3WP4/HXL80mohlfPZtQDNDmuLbX3Zme', 'admin', NULL, NULL, NULL, 1, NULL, '0123456789', 1, 0, NULL, NULL),
(2, 'Sales', 'sales', NULL, NULL, '$2y$10$2.ofuCWTGpz2Xyxop6VEROhvc09XOn8Oqd8hM66hTWke7CqQmxGeC', 'staff', NULL, NULL, NULL, 2, NULL, '43534534', 1, 0, '2022-09-17 01:40:51', '2022-09-17 01:40:51');

-- --------------------------------------------------------

--
-- Table structure for table `variations`
--

CREATE TABLE `variations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `variations`
--

INSERT INTO `variations` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Size', '2022-09-17 01:41:07', '2022-09-17 01:41:07');

-- --------------------------------------------------------

--
-- Table structure for table `variationvals`
--

CREATE TABLE `variationvals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `variation_id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `variationvals`
--

INSERT INTO `variationvals` (`id`, `variation_id`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 'L', '2022-09-17 01:41:15', '2022-09-17 01:41:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employees_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_expensetype_id_foreign` (`expensetype_id`),
  ADD KEY `expenses_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `expensetypes`
--
ALTER TABLE `expensetypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventories_branch_id_foreign` (`branch_id`),
  ADD KEY `inventories_item_id_foreign` (`item_id`),
  ADD KEY `inventories_sku_index` (`sku`);

--
-- Indexes for table `invoptions`
--
ALTER TABLE `invoptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoptions_item_id_foreign` (`item_id`),
  ADD KEY `invoptions_branch_id_foreign` (`branch_id`),
  ADD KEY `invoptions_inventory_id_foreign` (`inventory_id`),
  ADD KEY `invoptions_size_id_foreign` (`size_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_category_id_foreign` (`category_id`),
  ADD KEY `items_subcategory_id_foreign` (`subcategory_id`);

--
-- Indexes for table `journals`
--
ALTER TABLE `journals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `journals_branch_id_foreign` (`branch_id`),
  ADD KEY `journals_expensetype_id_foreign` (`expensetype_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `saleitems`
--
ALTER TABLE `saleitems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `saleitems_sale_id_foreign` (`sale_id`);

--
-- Indexes for table `salepayments`
--
ALTER TABLE `salepayments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salepayments_sale_id_foreign` (`sale_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saletaxes`
--
ALTER TABLE `saletaxes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `saletaxes_sale_id_foreign` (`sale_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skucounters`
--
ALTER TABLE `skucounters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subcategories_category_id_foreign` (`category_id`);

--
-- Indexes for table `systemstatus`
--
ALTER TABLE `systemstatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trackinventories`
--
ALTER TABLE `trackinventories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transfers_sku_index` (`sku`);

--
-- Indexes for table `userlogs`
--
ALTER TABLE `userlogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `variations`
--
ALTER TABLE `variations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `variationvals`
--
ALTER TABLE `variationvals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `variationvals_variation_id_foreign` (`variation_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `expensetypes`
--
ALTER TABLE `expensetypes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoptions`
--
ALTER TABLE `invoptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `journals`
--
ALTER TABLE `journals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `saleitems`
--
ALTER TABLE `saleitems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `salepayments`
--
ALTER TABLE `salepayments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `saletaxes`
--
ALTER TABLE `saletaxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `skucounters`
--
ALTER TABLE `skucounters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `systemstatus`
--
ALTER TABLE `systemstatus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trackinventories`
--
ALTER TABLE `trackinventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `userlogs`
--
ALTER TABLE `userlogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `variations`
--
ALTER TABLE `variations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `variationvals`
--
ALTER TABLE `variationvals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`);

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  ADD CONSTRAINT `expenses_expensetype_id_foreign` FOREIGN KEY (`expensetype_id`) REFERENCES `expensetypes` (`id`);

--
-- Constraints for table `inventories`
--
ALTER TABLE `inventories`
  ADD CONSTRAINT `inventories_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  ADD CONSTRAINT `inventories_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`);

--
-- Constraints for table `invoptions`
--
ALTER TABLE `invoptions`
  ADD CONSTRAINT `invoptions_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  ADD CONSTRAINT `invoptions_inventory_id_foreign` FOREIGN KEY (`inventory_id`) REFERENCES `inventories` (`id`),
  ADD CONSTRAINT `invoptions_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `invoptions_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`);

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `items_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`);

--
-- Constraints for table `journals`
--
ALTER TABLE `journals`
  ADD CONSTRAINT `journals_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  ADD CONSTRAINT `journals_expensetype_id_foreign` FOREIGN KEY (`expensetype_id`) REFERENCES `expensetypes` (`id`);

--
-- Constraints for table `saleitems`
--
ALTER TABLE `saleitems`
  ADD CONSTRAINT `saleitems_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`);

--
-- Constraints for table `salepayments`
--
ALTER TABLE `salepayments`
  ADD CONSTRAINT `salepayments_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`);

--
-- Constraints for table `saletaxes`
--
ALTER TABLE `saletaxes`
  ADD CONSTRAINT `saletaxes_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`);

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `variationvals`
--
ALTER TABLE `variationvals`
  ADD CONSTRAINT `variationvals_variation_id_foreign` FOREIGN KEY (`variation_id`) REFERENCES `variations` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
