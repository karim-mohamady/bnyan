-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 08, 2026 at 09:06 PM
-- Server version: 11.8.9-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u849151988_bnyan_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(32) NOT NULL,
  `entity` varchar(64) NOT NULL,
  `entity_id` bigint(20) UNSIGNED DEFAULT NULL,
  `summary` text NOT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `annual_reports`
--

CREATE TABLE `annual_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `year` varchar(16) NOT NULL,
  `title` varchar(255) NOT NULL,
  `summary` text DEFAULT NULL,
  `pages` varchar(32) NOT NULL DEFAULT '١',
  `status` varchar(64) NOT NULL DEFAULT 'معتمد',
  `file_path` text DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assembly_members`
--

CREATE TABLE `assembly_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'عضو الجمعية العمومية',
  `city` varchar(255) NOT NULL DEFAULT 'الخبراء',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assembly_minutes`
--

CREATE TABLE `assembly_minutes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date_text` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `decisions` text DEFAULT NULL,
  `attendees` varchar(32) NOT NULL DEFAULT '١٠',
  `file_path` text DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `board_members`
--

CREATE TABLE `board_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(32) NOT NULL DEFAULT 'member',
  `role_label` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('bnyan_cache_api_board_members', 'a:0:{}', 1791493497),
('bnyan_cache_api_governance', 'a:8:{s:13:\"annualReports\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:19:\"financialStatements\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:15:\"assemblyMinutes\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:15:\"assemblyMembers\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:8:\"policies\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:12:\"policiesDocs\";r:14;s:9:\"documents\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:10:\"categories\";a:3:{i:0;a:4:{s:2:\"id\";s:8:\"official\";s:5:\"label\";s:29:\"الوثائق الرسمية\";s:8:\"subtitle\";s:63:\"شهادات التسجيل والتراخيص المعتمدة\";s:4:\"icon\";s:6:\"shield\";}i:1;a:4:{s:2:\"id\";s:5:\"plans\";s:5:\"label\";s:27:\"الخطط التنموية\";s:8:\"subtitle\";s:71:\"الخطة الاستراتيجية والتشغيلية للجمعية\";s:4:\"icon\";s:9:\"bar-chart\";}i:2;a:4:{s:2:\"id\";s:12:\"transparency\";s:5:\"label\";s:35:\"الشفافية والمساءلة\";s:8:\"subtitle\";s:67:\"التقارير المالية والسياسات والمحاضر\";s:4:\"icon\";s:12:\"check-square\";}}}', 1791493497),
('bnyan_cache_api_projects', 'a:2:{s:10:\"categories\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:4:\"data\";a:0:{}}', 1791493496),
('bnyan_cache_api_settings', 'a:26:{s:5:\"phone\";s:10:\"0533355440\";s:12:\"phoneDisplay\";s:12:\"053 335 5440\";s:8:\"phoneTel\";s:13:\"+966533355440\";s:5:\"email\";s:26:\"info@bnyan-khubaraa.org.sa\";s:12:\"addressShort\";s:31:\"القصيم — الخبراء\";s:11:\"addressFull\";s:75:\"القصيم — محافظة الخبراء — طريق الملك فهد\";s:11:\"addressLine\";s:102:\"المملكة العربية السعودية، منطقة القصيم، محافظة الخبراء\";s:12:\"workingHours\";s:54:\"الأحد — الخميس: ٨:٠٠ ص — ٤:٠٠ م\";s:9:\"licenseNo\";s:10:\"1000806000\";s:9:\"unifiedNo\";s:10:\"7051934854\";s:7:\"mapsUrl\";s:42:\"https://maps.google.com/?q=26.0667,43.5667\";s:11:\"whatsappUrl\";s:26:\"https://wa.me/966533355440\";s:4:\"bank\";a:5:{s:4:\"name\";s:23:\"مصرف الراجحي\";s:6:\"nameEn\";s:13:\"Al Rajhi Bank\";s:11:\"accountName\";s:70:\"جمعية بنيان للعناية بالمساجد بالخبراء\";s:4:\"iban\";s:24:\"SA4780000624608016421035\";s:11:\"ibanDisplay\";s:29:\"SA47 8000 0624 6080 1642 1035\";}s:9:\"instagram\";a:2:{s:6:\"handle\";s:17:\"@bnyan_al_khubara\";s:3:\"url\";s:38:\"https://instagram.com/bnyan_al_khubara\";}s:1:\"x\";a:2:{s:6:\"handle\";s:15:\"@bnyan_khubaraa\";s:3:\"url\";s:28:\"https://x.com/bnyan_khubaraa\";}s:7:\"youtube\";a:2:{s:6:\"handle\";s:15:\"@bnyan_khubaraa\";s:3:\"url\";s:35:\"https://youtube.com/@bnyan_khubaraa\";}s:4:\"logo\";s:69:\"https://res.cloudinary.com/kivbbrnl/image/upload/v1783972984/logo.png\";s:9:\"siteTitle\";s:70:\"جمعية بنيان للعناية بالمساجد بالخبراء\";s:15:\"siteDescription\";s:217:\"جمعية أهلية غير ربحية متخصصة في صيانة وترميم المساجد بمحافظة الخبراء، مرخصة من المركز الوطني لتنمية القطاع غير الربحي.\";s:15:\"associationName\";s:70:\"جمعية بنيان للعناية بالمساجد بالخبراء\";s:14:\"associationSub\";s:44:\"بالخبراء — منطقة القصيم\";s:17:\"footerDescription\";s:301:\"جمعية أهلية مرخصة من المركز الوطني لتنمية القطاع غير الربحي برقم (1000806000)، تعنى بخدمة وصيانة وترميم بيوت الله وتأمين احتياجاتها بمحافظة الخبراء والمراكز التابعة لها.\";s:20:\"volunteerPlatformUrl\";s:18:\"https://nvg.gov.sa\";s:11:\"mapEmbedUrl\";s:282:\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d115437.4589255768!2d43.486665799999995!3d26.0717281!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x157ff9841804b46b%3A0x6b8bc00e12d4d989!2z2KfZhNiu2KjYsdin2KEg2KfZhNmC2LXZitmF!5e0!3m2!1sar!2ssa!4v1700000000000!5m2!1sar!2ssa\";s:13:\"copyrightText\";s:115:\"جميع الحقوق محفوظة لجمعية بنيان للعناية بالمساجد بالخبراء © 2026\";s:6:\"social\";a:3:{i:0;a:5:{s:4:\"name\";s:19:\"إكس (تويتر)\";s:8:\"platform\";s:1:\"x\";s:6:\"handle\";s:15:\"@bnyan_khubaraa\";s:3:\"url\";s:28:\"https://x.com/bnyan_khubaraa\";s:4:\"icon\";s:7:\"brand-x\";}i:1;a:5:{s:4:\"name\";s:16:\"انستغرام\";s:8:\"platform\";s:9:\"instagram\";s:6:\"handle\";s:17:\"@bnyan_al_khubara\";s:3:\"url\";s:38:\"https://instagram.com/bnyan_al_khubara\";s:4:\"icon\";s:9:\"instagram\";}i:2;a:5:{s:4:\"name\";s:12:\"يوتيوب\";s:8:\"platform\";s:7:\"youtube\";s:6:\"handle\";s:15:\"@bnyan_khubaraa\";s:3:\"url\";s:35:\"https://youtube.com/@bnyan_khubaraa\";s:4:\"icon\";s:7:\"youtube\";}}}', 1791493510);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `ip` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `financial_statements`
--

CREATE TABLE `financial_statements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `year` varchar(16) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` varchar(64) NOT NULL DEFAULT 'قوائم سنوية',
  `auditor` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `file_path` text DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `governance_documents`
--

CREATE TABLE `governance_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(64) NOT NULL,
  `icon` varchar(64) NOT NULL DEFAULT 'file',
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `button_label` varchar(255) NOT NULL DEFAULT 'تحميل المستند',
  `tag` varchar(64) NOT NULL DEFAULT 'معتمد',
  `file_path` text DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media_library`
--

CREATE TABLE `media_library` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `disk` varchar(32) NOT NULL DEFAULT 'public',
  `path` text NOT NULL,
  `original_name` varchar(255) NOT NULL,
  `mime` varchar(128) NOT NULL,
  `size` bigint(20) UNSIGNED NOT NULL,
  `width` int(10) UNSIGNED DEFAULT NULL,
  `height` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2026_01_01_000000_create_bnyan_tables', 1),
(2, '2026_10_01_230112_create_sessions_table', 1),
(3, '2026_10_01_230332_create_cache_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `tag_style` varchar(32) NOT NULL DEFAULT 'primary',
  `icon` varchar(64) NOT NULL DEFAULT 'file',
  `day` varchar(32) DEFAULT NULL,
  `hijri_date_text` varchar(255) DEFAULT NULL,
  `context_label` varchar(255) DEFAULT NULL,
  `excerpt` text DEFAULT NULL,
  `body` longtext DEFAULT NULL,
  `cover_image` text DEFAULT NULL,
  `gallery` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`gallery`)),
  `showcase_image` text DEFAULT NULL,
  `showcase_caption` varchar(255) DEFAULT NULL,
  `press_links` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`press_links`)),
  `placement` varchar(32) NOT NULL DEFAULT 'report',
  `show_on_home` tinyint(1) NOT NULL DEFAULT 0,
  `show_on_news_page` tinyint(1) NOT NULL DEFAULT 1,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `policies`
--

CREATE TABLE `policies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `tag` varchar(64) NOT NULL DEFAULT 'لائحة',
  `file_path` text DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `long_desc` text DEFAULT NULL,
  `category` varchar(64) NOT NULL DEFAULT 'maintenance',
  `tag` varchar(255) NOT NULL DEFAULT 'صيانة',
  `tag_class` varchar(32) NOT NULL DEFAULT 'green',
  `color` varchar(32) NOT NULL DEFAULT 'moss',
  `target` varchar(255) DEFAULT NULL,
  `required_amount` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `collected_amount` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `progress_percent` int(10) UNSIGNED DEFAULT NULL,
  `is_done` tinyint(1) NOT NULL DEFAULT 0,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `featured_order` int(11) NOT NULL DEFAULT 0,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_categories`
--

CREATE TABLE `project_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(64) NOT NULL,
  `label` varchar(128) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_media`
--

CREATE TABLE `project_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(16) NOT NULL DEFAULT 'image',
  `source` varchar(16) NOT NULL DEFAULT 'url',
  `url` text NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('acYuDCFIyn4ml69aaYl8dqrDVtV1oA1fI0pZ09lD', NULL, '41.234.120.204', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM3B5T3oxcTFIZnNtclMzTmRCSU8yV0l3cDJGUUJzb0gxT0tmSDNObCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHBzOi8vYXBpLmJ1bnlhbmtoLm9yZy5zYSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1791493490);

-- --------------------------------------------------------

--
-- Table structure for table `site_contents`
--

CREATE TABLE `site_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page` varchar(64) NOT NULL,
  `key` varchar(128) NOT NULL,
  `value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`value`)),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `annual_reports`
--
ALTER TABLE `annual_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assembly_members`
--
ALTER TABLE `assembly_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assembly_minutes`
--
ALTER TABLE `assembly_minutes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `board_members`
--
ALTER TABLE `board_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `financial_statements`
--
ALTER TABLE `financial_statements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `governance_documents`
--
ALTER TABLE `governance_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media_library`
--
ALTER TABLE `media_library`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `policies`
--
ALTER TABLE `policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_categories`
--
ALTER TABLE `project_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `project_categories_key_unique` (`key`);

--
-- Indexes for table `project_media`
--
ALTER TABLE `project_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_media_project_id_foreign` (`project_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `site_contents`
--
ALTER TABLE `site_contents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `site_contents_page_key_unique` (`page`,`key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `annual_reports`
--
ALTER TABLE `annual_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assembly_members`
--
ALTER TABLE `assembly_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assembly_minutes`
--
ALTER TABLE `assembly_minutes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `board_members`
--
ALTER TABLE `board_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `financial_statements`
--
ALTER TABLE `financial_statements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `governance_documents`
--
ALTER TABLE `governance_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media_library`
--
ALTER TABLE `media_library`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `policies`
--
ALTER TABLE `policies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_categories`
--
ALTER TABLE `project_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_media`
--
ALTER TABLE `project_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_contents`
--
ALTER TABLE `site_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `project_media`
--
ALTER TABLE `project_media`
  ADD CONSTRAINT `project_media_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
