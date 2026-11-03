-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2026 at 01:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bnyan`
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

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `action`, `entity`, `entity_id`, `summary`, `ip`, `created_at`) VALUES
(1, 'update', 'content', NULL, 'تحديث محتوى صفحة: صفحة التبرع (قسم: hero)', '127.0.0.1', '2026-10-01 20:34:45'),
(2, 'update', 'content', NULL, 'تحديث محتوى صفحة: صفحة التبرع (قسم: hero)', '127.0.0.1', '2026-10-01 20:46:37'),
(3, 'create', 'project', 7, 'إضافة مشروع جديد: karim mohamady', '127.0.0.1', '2026-10-01 22:02:50'),
(4, 'update', 'project', 7, 'تعديل بيانات المشروع: karim mohamady', '127.0.0.1', '2026-10-01 22:07:05'),
(5, 'update', 'project', 7, 'تعديل بيانات المشروع: karim mohamady', '127.0.0.1', '2026-10-01 22:08:22'),
(6, 'delete', 'project', 7, 'حذف مشروع (نقل إلى المهملات): karim mohamady', '127.0.0.1', '2026-10-01 22:10:52');

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

--
-- Dumping data for table `annual_reports`
--

INSERT INTO `annual_reports` (`id`, `year`, `title`, `summary`, `pages`, `status`, `file_path`, `sort_order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2026', 'التقرير السنوي لعام ٢٠٢٦م', 'تقرير شامل عن أنشطة صيانة المساجد والمبادرات المجتمعية للعام ٢٠٢٦م.', '٤٢', 'معتمد', NULL, 1, '2026-10-01 18:39:34', '2026-10-01 18:39:34', NULL),
(2, '2025', 'التقرير السنوي لعام ٢٠٢٥م', 'ملخص إنجازات الجمعية وبرامجها ومشاريعها خلال العام المالي ٢٠٢٥م.', '٤٨', 'معتمد', NULL, 2, '2026-10-01 18:39:34', '2026-10-01 18:39:34', NULL),
(3, '2025', 'التقرير السنوي لعام ٢٠٢٥م — التأسيس التشغيلي', 'عرض لأهم المشاريع المنجزة والشراكات الاستراتيجية خلال عام التأسيس التشغيلي.', '٣٦', 'معتمد', NULL, 3, '2026-10-01 18:39:35', '2026-10-01 18:39:35', NULL);

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

--
-- Dumping data for table `assembly_members`
--

INSERT INTO `assembly_members` (`id`, `name`, `role`, `city`, `sort_order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'محمد بن حمد بن سليمان النوشان', 'رئيس مجلس الإدارة', 'الخبراء', 1, '2026-10-01 18:39:34', '2026-10-01 18:39:34', NULL),
(2, 'إبراهيم بن حمود بن عبدالعزيز السويح', 'نائب رئيس مجلس الإدارة', 'الخبراء', 2, '2026-10-01 18:39:34', '2026-10-01 18:39:34', NULL),
(3, 'صالح بن عبدالرحمن بن صالح المرشد', 'عضو مجلس الإدارة', 'الخبراء', 3, '2026-10-01 18:39:34', '2026-10-01 18:39:34', NULL),
(4, 'نايف بن إبراهيم بن عبدالله الحسيني', 'عضو مجلس الإدارة', 'الخبراء', 4, '2026-10-01 18:39:34', '2026-10-01 18:39:34', NULL),
(5, 'ريان بن علي بن عبدالله الميمان', 'عضو مجلس الإدارة', 'الخبراء', 5, '2026-10-01 18:39:34', '2026-10-01 18:39:34', NULL);

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

--
-- Dumping data for table `assembly_minutes`
--

INSERT INTO `assembly_minutes` (`id`, `date_text`, `title`, `decisions`, `attendees`, `file_path`, `sort_order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '٢٠ / ٠٢ / ١٤٤٦ هـ', 'محضر الاجتماع العادي للجمعية العمومية', 'اعتماد خطة المشاريع السنوية ومراجعة أداء مجلس الإدارة.', '٣١', NULL, 3, '2026-10-01 18:39:35', '2026-10-01 18:39:36', NULL),
(2, '١٠ / ٠٩ / ١٤٤٦ هـ', 'محضر اجتماع استثنائي للجمعية العمومية', 'مناقشة الخطة التشغيلية وتحديث بعض بنود اللوائح الداخلية.', '٢٤', NULL, 2, '2026-10-01 18:39:35', '2026-10-01 18:39:35', NULL);

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

--
-- Dumping data for table `board_members`
--

INSERT INTO `board_members` (`id`, `role`, `role_label`, `name`, `description`, `is_featured`, `sort_order`, `is_published`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'president', 'رئيس مجلس الإدارة', 'محمد بن حمد بن سليمان النوشان', 'الإشراف العام وتوجيه السياسات الاستراتيجية للجمعية بمجلس الإدارة', 1, 1, 1, '2026-10-01 18:39:33', '2026-10-01 18:39:33', NULL),
(2, 'vice-president', 'نائب رئيس مجلس الإدارة', 'إبراهيم بن حمود بن عبدالعزيز السويح', 'متابعة الأداء الإداري والتشغيلي لجميع برامج ومشاريع الصيانة الميدانية', 0, 2, 1, '2026-10-01 18:39:33', '2026-10-01 18:39:33', NULL),
(3, 'member', 'عضو مجلس الإدارة', 'صالح بن عبدالرحمن بن صالح المرشد', 'الإشراف المالي والتدقيق والاستدامة التمويلية للجمعية ومواردها', 0, 3, 1, '2026-10-01 18:39:33', '2026-10-01 18:39:33', NULL),
(4, 'member', 'عضو مجلس الإدارة', 'نايف بن إبراهيم بن عبدالله الحسيني', 'إدارة الموارد البشرية وعلاقات المتطوعين وتنسيق الفرص التطوعية', 0, 4, 1, '2026-10-01 18:39:34', '2026-10-01 18:39:34', NULL),
(5, 'member', 'عضو مجلس الإدارة', 'ريان بن علي بن عبدالله الميمان', 'تطوير الشراكات الاستراتيجية وخدمة قطاع المانحين والمساهمين', 0, 5, 1, '2026-10-01 18:39:34', '2026-10-01 18:39:34', NULL);

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
('bnyan_cache_5c785c036466adea360111aa28563bfd556b5fba', 'i:1;', 1790905264),
('bnyan_cache_5c785c036466adea360111aa28563bfd556b5fba:timer', 'i:1790905264;', 1790905264),
('bnyan_cache_api_projects', 'a:2:{s:10:\"categories\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:7:{i:0;O:26:\"App\\Models\\ProjectCategory\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:18:\"project_categories\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:3:\"key\";s:3:\"all\";s:5:\"label\";s:8:\"الكل\";}s:11:\"\0*\0original\";a:2:{s:3:\"key\";s:3:\"all\";s:5:\"label\";s:8:\"الكل\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:3:{i:0;s:3:\"key\";i:1;s:5:\"label\";i:2;s:10:\"sort_order\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:26:\"App\\Models\\ProjectCategory\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:18:\"project_categories\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:3:\"key\";s:11:\"maintenance\";s:5:\"label\";s:25:\"صيانة المساجد\";}s:11:\"\0*\0original\";a:2:{s:3:\"key\";s:11:\"maintenance\";s:5:\"label\";s:25:\"صيانة المساجد\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:3:{i:0;s:3:\"key\";i:1;s:5:\"label\";i:2;s:10:\"sort_order\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:2;O:26:\"App\\Models\\ProjectCategory\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:18:\"project_categories\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:3:\"key\";s:10:\"renovation\";s:5:\"label\";s:31:\"الترميم والتأهيل\";}s:11:\"\0*\0original\";a:2:{s:3:\"key\";s:10:\"renovation\";s:5:\"label\";s:31:\"الترميم والتأهيل\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:3:{i:0;s:3:\"key\";i:1;s:5:\"label\";i:2;s:10:\"sort_order\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:3;O:26:\"App\\Models\\ProjectCategory\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:18:\"project_categories\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:3:\"key\";s:8:\"cleaning\";s:5:\"label\";s:25:\"نظافة المساجد\";}s:11:\"\0*\0original\";a:2:{s:3:\"key\";s:8:\"cleaning\";s:5:\"label\";s:25:\"نظافة المساجد\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:3:{i:0;s:3:\"key\";i:1;s:5:\"label\";i:2;s:10:\"sort_order\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:4;O:26:\"App\\Models\\ProjectCategory\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:18:\"project_categories\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:3:\"key\";s:8:\"lighting\";s:5:\"label\";s:25:\"تعطير المساجد\";}s:11:\"\0*\0original\";a:2:{s:3:\"key\";s:8:\"lighting\";s:5:\"label\";s:25:\"تعطير المساجد\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:3:{i:0;s:3:\"key\";i:1;s:5:\"label\";i:2;s:10:\"sort_order\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:5;O:26:\"App\\Models\\ProjectCategory\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:18:\"project_categories\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:3:\"key\";s:5:\"water\";s:5:\"label\";s:21:\"سُقيا الماء\";}s:11:\"\0*\0original\";a:2:{s:3:\"key\";s:5:\"water\";s:5:\"label\";s:21:\"سُقيا الماء\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:3:{i:0;s:3:\"key\";i:1;s:5:\"label\";i:2;s:10:\"sort_order\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:6;O:26:\"App\\Models\\ProjectCategory\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:18:\"project_categories\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:3:\"key\";s:8:\"building\";s:5:\"label\";s:23:\"بناء المساجد\";}s:11:\"\0*\0original\";a:2:{s:3:\"key\";s:8:\"building\";s:5:\"label\";s:23:\"بناء المساجد\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:3:{i:0;s:3:\"key\";i:1;s:5:\"label\";i:2;s:10:\"sort_order\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:4:\"data\";a:6:{i:0;a:16:{s:2:\"id\";i:1;s:4:\"name\";s:51:\"مشروع صيانة المساجد الشاملة\";s:4:\"desc\";s:140:\"صيانة الإنارة والسباكة وأنظمة التكييف وفلاتر المياه وتجديد الفرش عند الحاجة\";s:8:\"longDesc\";s:649:\"يهدف هذا المشروع إلى توفير خدمات صيانة شاملة ودورية لمساجد المحافظة، تشمل: صيانة أنظمة الإنارة الكهربائية، وإصلاح شبكات السباكة ومياه الشرب، وصيانة وحدات التكييف والتبريد، وتغيير فلاتر مياه التحلية، وتجديد الفرش والسجاد عند الحاجة. يشمل المشروع فرق متخصصة تعمل بصفة دورية ومنتظمة لضمان استمرارية الخدمة وتوفير بيئة صلاة لائقة ومريحة للمصلين طوال العام.\";s:3:\"cat\";s:11:\"maintenance\";s:4:\"done\";b:0;s:3:\"req\";i:500000;s:3:\"rem\";i:350000;s:3:\"pct\";i:30;s:5:\"color\";s:4:\"moss\";s:3:\"tag\";s:10:\"صيانة\";s:8:\"tagClass\";s:5:\"green\";s:6:\"target\";s:11:\"20 مسجد\";s:10:\"isFeatured\";b:1;s:6:\"images\";a:5:{i:0;s:70:\"https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-267.jpeg\";i:1;s:70:\"https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-269.jpeg\";i:2;s:69:\"https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-26.jpeg\";i:3;s:70:\"https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-263.jpeg\";i:4;s:70:\"https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-186.jpeg\";}s:6:\"videos\";a:3:{i:0;s:68:\"https://res.cloudinary.com/kivbbrnl/video/upload/pasted-movie-28.mp4\";i:1;s:68:\"https://res.cloudinary.com/kivbbrnl/video/upload/pasted-movie-31.mp4\";i:2;s:68:\"https://res.cloudinary.com/kivbbrnl/video/upload/pasted-movie-34.mp4\";}}i:1;a:16:{s:2:\"id\";i:2;s:4:\"name\";s:49:\"مشروع ترميم وتأهيل المساجد\";s:4:\"desc\";s:149:\"دهان، بلاط أرضيات، أبواب ونوافذ، حماية الأسقف، ترميم دورات المياه وتأهيل المداخل\";s:8:\"longDesc\";s:757:\"يستهدف مشروع الترميم والتأهيل إعادة المساجد إلى أفضل حالاتها من خلال أعمال ترميم شاملة تشمل: إعادة دهان الجدران الداخلية والخارجية، وتبديل البلاط وأرضيات دورات المياه، وصيانة وإصلاح الأبواب والنوافذ والمداخل، وحماية الأسقف من الرطوبة والتشققات، وترميم دورات المياه وتحديث تجهيزاتها، وتأهيل المداخل الرئيسية وتهيئة أماكن انتظار المصلين. يُعدّ هذا المشروع من أكثر المشاريع أثراً في تحسين المظهر الحضاري للمساجد.\";s:3:\"cat\";s:10:\"renovation\";s:4:\"done\";b:0;s:3:\"req\";i:1500000;s:3:\"rem\";i:1200000;s:3:\"pct\";i:20;s:5:\"color\";s:5:\"earth\";s:3:\"tag\";s:10:\"ترميم\";s:8:\"tagClass\";s:4:\"gold\";s:6:\"target\";s:12:\"3 مساجد\";s:10:\"isFeatured\";b:1;s:6:\"images\";a:5:{i:0;s:70:\"https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-172.jpeg\";i:1;s:70:\"https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-291.jpeg\";i:2;s:70:\"https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-220.jpeg\";i:3;s:70:\"https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-285.jpeg\";i:4;s:70:\"https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-140.jpeg\";}s:6:\"videos\";a:2:{i:0;s:68:\"https://res.cloudinary.com/kivbbrnl/video/upload/pasted-movie-35.mp4\";i:1;s:68:\"https://res.cloudinary.com/kivbbrnl/video/upload/pasted-movie-37.mp4\";}}i:2;a:16:{s:2:\"id\";i:3;s:4:\"name\";s:36:\"مشروع نظافة المساجد\";s:4:\"desc\";s:121:\"غسيل وتعقيم المساجد وفرشها وتوفير مستلزمات النظافة على مدار العام\";s:8:\"longDesc\";s:708:\"يضمن مشروع نظافة المساجد الحفاظ على نظافة وطهارة بيوت الله على مدار العام، وذلك من خلال فرق متخصصة تقوم بـ: الغسيل الدوري الشامل للأرضيات والجدران، وتعقيم الفرش والسجاد وتنظيفه بمعدات احترافية، وتوفير مستلزمات النظافة اليومية من مطهرات ومعقمات وأدوات نظافة، والاهتمام الخاص بنظافة دورات المياه ونظافتها وتجهيزها بشكل دائم. يستهدف المشروع ضمان بيئة طاهرة ومريحة لجميع المصلين في كل وقت.\";s:3:\"cat\";s:8:\"cleaning\";s:4:\"done\";b:0;s:3:\"req\";i:150000;s:3:\"rem\";i:90000;s:3:\"pct\";i:40;s:5:\"color\";s:4:\"sage\";s:3:\"tag\";s:10:\"نظافة\";s:8:\"tagClass\";s:4:\"blue\";s:6:\"target\";s:11:\"90 مسجد\";s:10:\"isFeatured\";b:1;s:6:\"images\";a:5:{i:0;s:69:\"https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-68.jpeg\";i:1;s:70:\"https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-109.jpeg\";i:2;s:69:\"https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-69.jpeg\";i:3;s:69:\"https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-58.jpeg\";i:4;s:69:\"https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-57.jpeg\";}s:6:\"videos\";a:2:{i:0;s:68:\"https://res.cloudinary.com/kivbbrnl/video/upload/pasted-movie-38.mp4\";i:1;s:68:\"https://res.cloudinary.com/kivbbrnl/video/upload/pasted-movie-39.mp4\";}}i:3;a:16:{s:2:\"id\";i:4;s:4:\"name\";s:36:\"مشروع تعطير المساجد\";s:4:\"desc\";s:123:\"توفير وتوزيع معطرات الجو والبخور لتهيئة أجواء إيمانية داخل المساجد\";s:8:\"longDesc\";s:761:\"يسعى مشروع تعطير المساجد إلى تهيئة أجواء روحانية وإيمانية داخل بيوت الله، عبر توفير وتوزيع أجود أنواع معطرات الجو والبخور المختارة بعناية على مساجد المحافظة. تتضمن خدمات المشروع: توزيعاً منتظماً لمعطرات الجو عالية الجودة، وتوفير البخور والمبخرات، وصيانة أجهزة البخور الكهربائية الموجودة في المساجد، والحرص على استمرارية هذه الخدمة في جميع أوقات الصلوات. ترتبط هذه الخدمة بتعزيز التجربة الروحية للمصلي داخل المسجد.\";s:3:\"cat\";s:8:\"lighting\";s:4:\"done\";b:0;s:3:\"req\";i:45000;s:3:\"rem\";i:25000;s:3:\"pct\";i:44;s:5:\"color\";s:4:\"moss\";s:3:\"tag\";s:10:\"تعطير\";s:8:\"tagClass\";s:5:\"green\";s:6:\"target\";s:15:\"90 مسجداً\";s:10:\"isFeatured\";b:0;s:6:\"images\";a:5:{i:0;s:55:\"https://res.cloudinary.com/kivbbrnl/image/upload/1.jpeg\";i:1;s:55:\"https://res.cloudinary.com/kivbbrnl/image/upload/2.jpeg\";i:2;s:55:\"https://res.cloudinary.com/kivbbrnl/image/upload/3.jpeg\";i:3;s:70:\"https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-165.jpeg\";i:4;s:70:\"https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-166.jpeg\";}s:6:\"videos\";a:2:{i:0;s:68:\"https://res.cloudinary.com/kivbbrnl/video/upload/pasted-movie-40.mp4\";i:1;s:68:\"https://res.cloudinary.com/kivbbrnl/video/upload/pasted-movie-41.mp4\";}}i:4;a:16:{s:2:\"id\";i:5;s:4:\"name\";s:47:\"مشروع سُقيا الماء للمساجد\";s:4:\"desc\";s:114:\"توفير قوارير مياه للمصلين وتعبئة خزانات مياه التحلية باستمرار\";s:8:\"longDesc\";s:643:\"يوفر مشروع سُقيا الماء مياهاً نقية وصحية لمصلي مساجد المحافظة على مدار العام، عبر: تركيب برادات مياه في مداخل المساجد وساحاتها، وتعبئة الخزانات بمياه التحلية بصفة منتظمة، وتوفير أكواب وزجاجات المياه للمصلين في الأوقات الحارة، وصيانة برادات الماء وضمان نظافتها الدائمة. يُعدّ هذا المشروع من أكثر المشاريع خدمةً يومية مباشرة للمصلين خاصة في فصول الصيف.\";s:3:\"cat\";s:5:\"water\";s:4:\"done\";b:0;s:3:\"req\";i:500000;s:3:\"rem\";i:320000;s:3:\"pct\";i:36;s:5:\"color\";s:4:\"sand\";s:3:\"tag\";s:19:\"سقيا الماء\";s:8:\"tagClass\";s:4:\"blue\";s:6:\"target\";s:12:\"100 مسجد\";s:10:\"isFeatured\";b:0;s:6:\"images\";a:5:{i:0;s:70:\"https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-134.jpeg\";i:1;s:70:\"https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-167.jpeg\";i:2;s:70:\"https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-169.jpeg\";i:3;s:70:\"https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-170.jpeg\";i:4;s:70:\"https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-171.jpeg\";}s:6:\"videos\";a:2:{i:0;s:68:\"https://res.cloudinary.com/kivbbrnl/video/upload/pasted-movie-42.mp4\";i:1;s:68:\"https://res.cloudinary.com/kivbbrnl/video/upload/pasted-movie-43.mp4\";}}i:5;a:16:{s:2:\"id\";i:6;s:4:\"name\";s:34:\"مشروع بناء المساجد\";s:4:\"desc\";s:145:\"الإسهام في بناء مساجد جديدة وفق الاحتياج المجتمعي وأعلى معايير الجودة الهندسية\";s:8:\"longDesc\";s:822:\"يمثّل مشروع بناء المساجد قمة العطاء الخيري، إذ يهدف إلى المساهمة في إنشاء مساجد جديدة تلبي احتياجات الأحياء المتنامية في محافظة الخبراء. يعتمد المشروع على: دراسة احتياجات المجتمع وتحديد المناطق الأكثر حاجة، وتوفير التصاميم الهندسية الملائمة، والإشراف على تنفيذ أعمال البناء وفق أعلى معايير الجودة، وتأهيل المسجد الجديد بالكامل (فرش – إنارة – دورات مياه – مكيفات). يجمع المشروع عطاء الدنيا والآخرة، إذ أن من بنى مسجداً لله بنى الله له بيتاً في الجنة.\";s:3:\"cat\";s:8:\"building\";s:4:\"done\";b:0;s:3:\"req\";i:2000000;s:3:\"rem\";i:2000000;s:3:\"pct\";i:5;s:5:\"color\";s:5:\"earth\";s:3:\"tag\";s:8:\"بناء\";s:8:\"tagClass\";s:4:\"gold\";s:6:\"target\";s:35:\"مسجد واحد حسب الدعم\";s:10:\"isFeatured\";b:0;s:6:\"images\";a:5:{i:0;s:61:\"https://res.cloudinary.com/kivbbrnl/image/upload/image-02.jpg\";i:1;s:59:\"https://res.cloudinary.com/kivbbrnl/image/upload/alryan.png\";i:2;s:70:\"https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-225.jpeg\";i:3;s:70:\"https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-250.jpeg\";i:4;s:70:\"https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-274.jpeg\";}s:6:\"videos\";a:2:{i:0;s:68:\"https://res.cloudinary.com/kivbbrnl/video/upload/pasted-movie-44.mp4\";i:1;s:68:\"https://res.cloudinary.com/kivbbrnl/video/upload/pasted-movie-45.mp4\";}}}}', 1790955632);

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

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `phone`, `subject`, `message`, `is_read`, `ip`, `user_agent`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Karim Mohamady', 'karimmohamadiy4@gmail.com', '+201017238942', 'test', 'Communication Test', 0, '127.0.0.1', 'node', '2026-10-01 22:40:05', '2026-10-01 22:40:05', NULL);

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

--
-- Dumping data for table `financial_statements`
--

INSERT INTO `financial_statements` (`id`, `year`, `title`, `type`, `auditor`, `notes`, `file_path`, `sort_order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2026', 'القوائم المالية لعام ٢٠٢٦م', 'مدقّقة', 'مكتب محاسبة مستقل معتمد', 'قوائم مالية معتمدة من مجلس الإدارة والجمعية العمومية.', NULL, 1, '2026-10-01 18:39:35', '2026-10-01 18:39:35', NULL),
(2, '2025', 'القوائم المالية لعام ٢٠٢٥م', 'مدقّقة', 'مكتب محاسبة مستقل معتمد', 'تشمل قائمة المركز المالي وقائمة الأنشطة والتدفقات النقدية.', NULL, 2, '2026-10-01 18:39:35', '2026-10-01 18:39:35', NULL),
(3, '2025', 'القوائم المالية لعام ٢٠٢٥م — السنة المالية', 'مدقّقة', 'مكتب محاسبة مستقل معتمد', 'بيانات إيرادات ومصروفات الجمعية للسنة المالية المنتهية.', NULL, 3, '2026-10-01 18:39:35', '2026-10-01 18:39:35', NULL);

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

--
-- Dumping data for table `governance_documents`
--

INSERT INTO `governance_documents` (`id`, `category`, `icon`, `title`, `description`, `button_label`, `tag`, `file_path`, `sort_order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'official', 'file', 'شهادة التسجيل', 'شهادة تسجيل الجمعية لدى المركز الوطني لتنمية القطاع غير الربحي', 'تحميل المستند', 'رسمي', NULL, 1, '2026-10-01 18:39:36', '2026-10-01 18:39:36', NULL),
(2, 'official', 'shield', 'الترخيص الرسمي', 'ترخيص الجمعية من وزارة الموارد البشرية والتنمية الاجتماعية', 'تحميل الترخيص', 'مرخّص', NULL, 2, '2026-10-01 18:39:37', '2026-10-01 18:39:37', NULL),
(3, 'plans', 'bar-chart', 'الخطة الاستراتيجية ٢٠٢٦-٢٠٣٠م', 'خارطة الطريق المؤسسية والتنموية للجمعية على مدى خمس سنوات قادمة', 'تحميل الخطة', 'استراتيجية', NULL, 3, '2026-10-01 18:39:37', '2026-10-01 18:39:37', NULL),
(4, 'plans', 'calendar', 'الخطة التشغيلية السنوية ٢٠٢٦م', 'البرامج والمشاريع التشغيلية المعتمدة لعام ٢٠٢٦م وميزانياتها المقررة', 'تحميل الخطة', 'تشغيلية', NULL, 4, '2026-10-01 18:39:37', '2026-10-01 18:39:37', NULL),
(5, 'transparency', 'briefcase', 'القوائم المالية', 'القوائم المالية السنوية المعتمدة والمدققة من جهات محاسبية مستقلة', 'تحميل القوائم', 'مالي', NULL, 5, '2026-10-01 18:39:37', '2026-10-01 18:39:37', NULL),
(6, 'transparency', 'book', 'السياسات واللوائح', 'اللوائح التنظيمية والسياسات الداخلية المعتمدة لضمان جودة الأداء المؤسسي', 'تحميل اللوائح', 'سياسات', NULL, 6, '2026-10-01 18:39:37', '2026-10-01 18:39:37', NULL),
(7, 'transparency', 'users', 'محاضر مجلس الإدارة', 'قرارات ومحاضر اجتماعات مجلس إدارة الجمعية للعام الحالي', 'تحميل المحاضر', 'مجلس', NULL, 7, '2026-10-01 18:39:37', '2026-10-01 18:39:37', NULL);

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
(2, '2026_10_01_230112_create_sessions_table', 2),
(3, '2026_10_01_230332_create_cache_table', 3);

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

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `tag`, `tag_style`, `icon`, `day`, `hijri_date_text`, `context_label`, `excerpt`, `body`, `cover_image`, `gallery`, `showcase_image`, `showcase_caption`, `press_links`, `placement`, `show_on_home`, `show_on_news_page`, `is_published`, `sort_order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'افتتاح مسجد البر بعد ترميم شامل', 'افتتاح', 'primary', 'home', '١٢', 'شوال ١٤٤٦هـ', NULL, 'بحضور أهالي الحي ومسؤولي الجمعية، تم افتتاح مسجد البر بعد عملية ترميم استمرت ثلاثة أشهر، ضمن جهود الجمعية لإعادة البهاء لبيوت الله في محافظة الخبراء.', 'بحضور أهالي الحي ومسؤولي الجمعية، تم افتتاح مسجد البر بعد عملية ترميم استمرت ثلاثة أشهر، ضمن جهود الجمعية لإعادة البهاء لبيوت الله في محافظة الخبراء.', NULL, '[]', NULL, NULL, '[]', 'report', 1, 0, 1, 0, '2026-10-01 18:39:33', '2026-10-01 18:39:33', NULL),
(2, 'توزيع مصاحف على ٣٠ مسجدًا في الخبراء', 'مبادرة', 'primary', 'book', '٢٨', 'رمضان ١٤٤٦هـ', NULL, 'ضمن مبادرة بنيان الرمضانية، تم توزيع أكثر من ٢٬٠٠٠ مصحف على مساجد المحافظة، إسهامًا في تهيئة بيئة إيمانية متكاملة للمصلين.', 'ضمن مبادرة بنيان الرمضانية، تم توزيع أكثر من ٢٬٠٠٠ مصحف على مساجد المحافظة، إسهامًا في تهيئة بيئة إيمانية متكاملة للمصلين.', NULL, '[]', NULL, NULL, '[]', 'report', 1, 0, 1, 1, '2026-10-01 18:39:33', '2026-10-01 18:39:33', NULL),
(3, 'إطلاق برنامج الصيانة الدورية الموسمي', 'صيانة', 'primary', 'check-square', '٥', 'شعبان ١٤٤٦هـ', NULL, 'أطلقت الجمعية برنامجها السنوي للصيانة الوقائية الذي يستهدف ٥٠ مسجدًا في الخبراء والمراكز، للحفاظ على جاهزية المرافق على مدار العام.', 'أطلقت الجمعية برنامجها السنوي للصيانة الوقائية الذي يستهدف ٥٠ مسجدًا في الخبراء والمراكز، للحفاظ على جاهزية المرافق على مدار العام.', NULL, '[]', NULL, NULL, '[]', 'report', 1, 0, 1, 2, '2026-10-01 18:39:33', '2026-10-01 18:39:33', NULL),
(4, 'جمعية بنيان للعناية بالمساجد تفتتح فرعها بمركز الخبراء', 'افتتاح رسمي', 'primary', 'shield', '14', '14 ربيع الآخر 1447هـ', 'الخبر الأبرز', 'بحضور رئيس مركز الخبراء الأستاذ خالد بن محمد الصقر، ورئيس بلدية مركز الخبراء المهندس سفر بن غالب الغبيوي، ومدير شرطة مركز الخبراء المقدم ناصر بن سليم الحربي، افتتحت الجمعية مقرها بحي المرقب بالخبراء.', 'بحضور رئيس مركز الخبراء الأستاذ خالد بن محمد الصقر، ورئيس بلدية مركز الخبراء المهندس سفر بن غالب الغبيوي، ومدير شرطة مركز الخبراء المقدم ناصر بن سليم الحربي، افتتحت الجمعية مقرها بحي المرقب بالخبراء. بدأ برنامج الافتتاح بتلاوة القرآن الكريم، تلتها كلمة لرئيس مجلس إدارة الجمعية الأستاذ محمد بن حمد النوشان رحّب فيها بالحضور وأكد أن افتتاح المقر يمثل خطوة مهمة في انطلاق مسيرة الجمعية، وثمرة لتضافر جهود الجهات الرسمية وأهالي الخبراء والداعمين.\n\nوأشار إلى أن الجمعية تسعى من خلال هذا المقر إلى تطوير أعمالها التنظيمية وتعزيز برامجها للعناية بالمساجد وصيانتها، والارتقاء بمستوى خدماتها بما يحقق رسالتها في خدمة بيوت الله. وفي ختام الزيارة، اطلع رئيس المركز والحضور على مكونات مقر الجمعية وتجهيزاته، وعرضت الجمعية بعض خططها القادمة.', 'https://res.cloudinary.com/kivbbrnl/image/upload/image-01.jpg', '[{\"url\":\"https:\\/\\/res.cloudinary.com\\/kivbbrnl\\/image\\/upload\\/image-01.jpg\",\"alt\":\"\\u0627\\u0641\\u062a\\u062a\\u0627\\u062d \\u0645\\u0642\\u0631 \\u062c\\u0645\\u0639\\u064a\\u0629 \\u0628\\u0646\\u064a\\u0627\\u0646 \\u0628\\u0627\\u0644\\u062e\\u0628\\u0631\\u0627\\u0621\"},{\"url\":\"https:\\/\\/res.cloudinary.com\\/kivbbrnl\\/image\\/upload\\/image-04.jpg\",\"alt\":\"\\u0636\\u064a\\u0648\\u0641 \\u0627\\u0644\\u0627\\u0641\\u062a\\u062a\\u0627\\u062d\"},{\"url\":\"https:\\/\\/res.cloudinary.com\\/kivbbrnl\\/image\\/upload\\/image-05.jpg\",\"alt\":\"\\u062c\\u0648\\u0644\\u0629 \\u0627\\u0644\\u0645\\u0633\\u0624\\u0648\\u0644\\u064a\\u0646 \\u0641\\u064a \\u0627\\u0644\\u0645\\u0642\\u0631\"}]', NULL, NULL, '[{\"label\":\"\\u062c\\u0645\\u0639\\u064a\\u0629 \\u0627\\u0644\\u0635\\u062d\\u0627\\u0641\\u0629 \\u0648\\u0627\\u0644\\u0646\\u0634\\u0631 \\u0627\\u0644\\u0631\\u0642\\u0645\\u064a\",\"url\":\"https:\\/\\/shafaq-e.sa\\/458610.html\",\"widget_title\":\"\\u0634\\u0628\\u0643\\u0629 \\u0634\\u0641\\u0642 \\u0627\\u0644\\u0625\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a\\u0629\",\"widget_subtitle\":\"\\u0627\\u0641\\u062a\\u062a\\u0627\\u062d \\u0645\\u0642\\u0631 \\u0641\\u0631\\u0639 \\u0627\\u0644\\u062c\\u0645\\u0639\\u064a\\u0629 \\u0628\\u0627\\u0644\\u062e\\u0628\\u0631\\u0627\\u0621\"},{\"label\":\"\\u0635\\u062d\\u064a\\u0641\\u0629 \\u0627\\u0644\\u0631\\u064a\\u0627\\u0636\",\"url\":\"https:\\/\\/www.alriyadh.com\\/2177761\",\"widget_title\":\"\\u0635\\u062d\\u064a\\u0641\\u0629 \\u0627\\u0644\\u0631\\u064a\\u0627\\u0636 \\u0627\\u0644\\u0631\\u0633\\u0645\\u064a\\u0629\",\"widget_subtitle\":\"\\u0627\\u0644\\u062c\\u0645\\u0639\\u064a\\u0629 \\u062a\\u0637\\u0644\\u0642 \\u0645\\u0642\\u0631\\u0647\\u0627 \\u0644\\u0631\\u0639\\u0627\\u064a\\u0629 \\u0645\\u0633\\u0627\\u062c\\u062f \\u0627\\u0644\\u062e\\u0628\\u0631\\u0627\\u0621\"}]', 'featured', 0, 1, 1, 1, '2026-10-01 18:39:33', '2026-10-01 18:39:33', NULL),
(5, 'رئيس مجلس الإدارة يتابع ميدانياً أعمال صيانة التكييف في المساجد', 'زيارة ميدانية', 'primary', 'home', '2026', 'خطة عام 2026م', 'التقارير وأعمال الصيانة', 'حرص الأستاذ محمد بن حمد النوشان، رئيس مجلس إدارة جمعية بنيان للعناية بالمساجد بالخبراء، على متابعة سير أعمال مشروع صيانة المساجد ميدانياً.', 'حرص الأستاذ محمد بن حمد النوشان، رئيس مجلس إدارة جمعية بنيان للعناية بالمساجد بالخبراء، على متابعة سير أعمال مشروع صيانة المساجد ميدانياً، حيث وقف بنفسه على تركيب وحدات تكييف جديدة لأحد المساجد المستفيدة ضمن خطة الصيانة الشاملة المعتمدة لعام 2026م. وأكّد رئيس مجلس الإدارة أن المتابعة الميدانية المباشرة تأتي ضمن حرص الجمعية على ضمان جاهزية المساجد وتحقيق أعلى معايير الجودة في تنفيذ المشاريع التشغيلية، بما يعزز راحة المصلين ويرفع من مستوى الخدمات المقدمة لبيوت الله.', 'https://res.cloudinary.com/kivbbrnl/image/upload/image-06.jpg', '[{\"url\":\"https:\\/\\/res.cloudinary.com\\/kivbbrnl\\/image\\/upload\\/image-06.jpg\",\"alt\":\"\\u0645\\u062a\\u0627\\u0628\\u0639\\u0629 \\u0623\\u0639\\u0645\\u0627\\u0644 \\u0635\\u064a\\u0627\\u0646\\u0629 \\u0627\\u0644\\u062a\\u0643\\u064a\\u064a\\u0641\"},{\"url\":\"https:\\/\\/res.cloudinary.com\\/kivbbrnl\\/image\\/upload\\/image-07.jpg\",\"alt\":\"\\u062a\\u0631\\u0643\\u064a\\u0628 \\u0648\\u062d\\u062f\\u0629 \\u062a\\u0643\\u064a\\u064a\\u0641\"},{\"url\":\"https:\\/\\/res.cloudinary.com\\/kivbbrnl\\/image\\/upload\\/image-08.jpg\",\"alt\":\"\\u0635\\u064a\\u0627\\u0646\\u0629 \\u0627\\u0644\\u0648\\u062d\\u062f\\u0629 \\u0627\\u0644\\u062e\\u0627\\u0631\\u062c\\u064a\\u0629\"}]', 'https://res.cloudinary.com/kivbbrnl/image/upload/image-09.jpg', 'المركبات المخصصة لخدمات بناء وصيانة المساجد التابعة للجمعية', '[]', 'report', 0, 1, 1, 2, '2026-10-01 18:39:33', '2026-10-01 18:39:33', NULL),
(6, 'جولة على أعمال الصيانة الشاملة الجارية في مساجد الخبراء', 'صيانة شاملة', 'primary', 'check-square', 'دوري', 'التقرير الدوري الجاري', 'التقارير وأعمال الصيانة', 'تتابع فرق جمعية بنيان الفنية تنفيذ برنامج الصيانة الشاملة للمساجد، والذي يغطي مختلف الجوانب الفنية والتشغيلية.', 'تتابع فرق جمعية بنيان الفنية تنفيذ برنامج الصيانة الشاملة للمساجد، والذي يغطي مختلف الجوانب الفنية والتشغيلية: من صيانة وحدات التكييف الداخلية والخارجية، وغسيل وجلي السجاد بالمعدات المتخصصة، إلى تنظيف الثريات والإنارة، وتلميع المكتبات والأثاث الخشبي، وصيانة الأجهزة الكهربائية. وتحرص الجمعية على تجهيز فرق العمل بالمعدات والمركبات المخصصة لضمان تنفيذ الأعمال بجودة عالية وفي أسرع وقت ممكن، خدمةً للمصلين وحفاظاً على بيوت الله.', 'https://res.cloudinary.com/kivbbrnl/image/upload/image-11.jpg', '[{\"url\":\"https:\\/\\/res.cloudinary.com\\/kivbbrnl\\/image\\/upload\\/image-11.jpg\",\"alt\":\"\\u0623\\u0639\\u0645\\u0627\\u0644 \\u0627\\u0644\\u0635\\u064a\\u0627\\u0646\\u0629 \\u0627\\u0644\\u0634\\u0627\\u0645\\u0644\\u0629\"},{\"url\":\"https:\\/\\/res.cloudinary.com\\/kivbbrnl\\/image\\/upload\\/image-12.jpg\",\"alt\":\"\\u063a\\u0633\\u064a\\u0644 \\u0648\\u062c\\u0644\\u064a \\u0627\\u0644\\u0633\\u062c\\u0627\\u062f\"},{\"url\":\"https:\\/\\/res.cloudinary.com\\/kivbbrnl\\/image\\/upload\\/image-13.jpg\",\"alt\":\"\\u062a\\u0646\\u0638\\u064a\\u0641 \\u0627\\u0644\\u062b\\u0631\\u064a\\u0627\\u062a\"}]', 'https://res.cloudinary.com/kivbbrnl/image/upload/image-17.jpg', 'أسطول المركبات والمعدات المجهزة لصيانة ورعاية بيوت الله', '[]', 'report', 0, 1, 1, 3, '2026-10-01 18:39:33', '2026-10-01 18:39:33', NULL),
(7, 'صدى واسع لافتتاح المقر في الصحف والمواقع المحلية', 'تغطية صحفية', 'gold', 'book', '14', '14 ربيع الآخر 1447هـ', 'الصدى الإعلامي والصحفي', 'تناولت عدة منصات إخبارية محلية بمنطقة القصيم خبر افتتاح مقر الجمعية الجديد بحي المرقب، وتسليط الضوء على دور الجمعية المرتقب في صيانة مساجد محافظة الخبراء.', 'تناولت عدة منصات إخبارية محلية بمنطقة القصيم خبر افتتاح مقر الجمعية الجديد بحي المرقب، وتسليط الضوء على دور الجمعية المرتقب في صيانة مساجد محافظة الخبراء.', 'https://res.cloudinary.com/kivbbrnl/image/upload/image-10.jpg', '[{\"url\":\"https:\\/\\/res.cloudinary.com\\/kivbbrnl\\/image\\/upload\\/image-10.jpg\",\"alt\":\"\\u0636\\u064a\\u0648\\u0641 \\u0627\\u0644\\u062d\\u0641\\u0644\"}]', NULL, NULL, '[{\"label\":\"\\u062c\\u0645\\u0639\\u064a\\u0629 \\u0627\\u0644\\u0635\\u062d\\u0627\\u0641\\u0629 \\u0648\\u0627\\u0644\\u0646\\u0634\\u0631 \\u0627\\u0644\\u0631\\u0642\\u0645\\u064a\",\"url\":\"https:\\/\\/shafaq-e.sa\\/458610.html\",\"widget_title\":\"\\u0634\\u0628\\u0643\\u0629 \\u0634\\u0641\\u0642 \\u0627\\u0644\\u0625\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a\\u0629\",\"widget_subtitle\":\"\\u0627\\u0641\\u062a\\u062a\\u0627\\u062d \\u0645\\u0642\\u0631 \\u0641\\u0631\\u0639 \\u0627\\u0644\\u062c\\u0645\\u0639\\u064a\\u0629 \\u0628\\u0627\\u0644\\u062e\\u0628\\u0631\\u0627\\u0621\"},{\"label\":\"\\u0635\\u062d\\u064a\\u0641\\u0629 \\u0627\\u0644\\u0631\\u064a\\u0627\\u0636\",\"url\":\"https:\\/\\/www.alriyadh.com\\/2177761\",\"widget_title\":\"\\u0635\\u062d\\u064a\\u0641\\u0629 \\u0627\\u0644\\u0631\\u064a\\u0627\\u0636 \\u0627\\u0644\\u0631\\u0633\\u0645\\u064a\\u0629\",\"widget_subtitle\":\"\\u0627\\u0644\\u062c\\u0645\\u0639\\u064a\\u0629 \\u062a\\u0637\\u0644\\u0642 \\u0645\\u0642\\u0631\\u0647\\u0627 \\u0644\\u0631\\u0639\\u0627\\u064a\\u0629 \\u0645\\u0633\\u0627\\u062c\\u062f \\u0627\\u0644\\u062e\\u0628\\u0631\\u0627\\u0621\"}]', 'press', 0, 1, 1, 4, '2026-10-01 18:39:33', '2026-10-01 18:39:33', NULL);

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

--
-- Dumping data for table `policies`
--

INSERT INTO `policies` (`id`, `title`, `description`, `tag`, `file_path`, `sort_order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'اللائحة الأساسية للجمعية', 'الإطار النظامي الحاكم لعمل الجمعية وأهدافها واختصاصاتها.', 'أساسية', NULL, 1, '2026-10-01 18:39:36', '2026-10-01 18:39:36', NULL),
(2, 'سياسة الحوكمة والشفافية', 'ضوابط الإفصاح والمساءلة ونشر التقارير والوثائق الرسمية.', 'حوكمة', NULL, 2, '2026-10-01 18:39:36', '2026-10-01 18:39:36', NULL),
(3, 'سياسة تعارض المصالح', 'آلية الإفصاح عن المصالح ومنع تضاربها في قرارات الجمعية.', 'امتثال', NULL, 3, '2026-10-01 18:39:36', '2026-10-01 18:39:36', NULL),
(4, 'سياسة الموارد البشرية', 'لوائح التوظيف والتطوع والتدريب وتقييم الأداء.', 'موارد بشرية', NULL, 4, '2026-10-01 18:39:36', '2026-10-01 18:39:36', NULL),
(5, 'سياسة المشتريات والمخزون', 'إجراءات الشراء والتعاقد وإدارة المخزون وفق معايير النزاهة.', 'مالية', NULL, 5, '2026-10-01 18:39:36', '2026-10-01 18:39:36', NULL),
(6, 'سياسة حماية البيانات', 'ضوابط جمع وحفظ واستخدام بيانات المستفيدين والمتطوعين.', 'خصوصية', NULL, 6, '2026-10-01 18:39:36', '2026-10-01 18:39:36', NULL);

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

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `desc`, `long_desc`, `category`, `tag`, `tag_class`, `color`, `target`, `required_amount`, `collected_amount`, `progress_percent`, `is_done`, `is_published`, `is_featured`, `featured_order`, `sort_order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'مشروع صيانة المساجد الشاملة', 'صيانة الإنارة والسباكة وأنظمة التكييف وفلاتر المياه وتجديد الفرش عند الحاجة', 'يهدف هذا المشروع إلى توفير خدمات صيانة شاملة ودورية لمساجد المحافظة، تشمل: صيانة أنظمة الإنارة الكهربائية، وإصلاح شبكات السباكة ومياه الشرب، وصيانة وحدات التكييف والتبريد، وتغيير فلاتر مياه التحلية، وتجديد الفرش والسجاد عند الحاجة. يشمل المشروع فرق متخصصة تعمل بصفة دورية ومنتظمة لضمان استمرارية الخدمة وتوفير بيئة صلاة لائقة ومريحة للمصلين طوال العام.', 'maintenance', 'صيانة', 'green', 'moss', '20 مسجد', 500000, 150000, 30, 0, 1, 1, 1, 1, '2026-10-01 18:39:29', '2026-10-01 18:39:29', NULL),
(2, 'مشروع ترميم وتأهيل المساجد', 'دهان، بلاط أرضيات، أبواب ونوافذ، حماية الأسقف، ترميم دورات المياه وتأهيل المداخل', 'يستهدف مشروع الترميم والتأهيل إعادة المساجد إلى أفضل حالاتها من خلال أعمال ترميم شاملة تشمل: إعادة دهان الجدران الداخلية والخارجية، وتبديل البلاط وأرضيات دورات المياه، وصيانة وإصلاح الأبواب والنوافذ والمداخل، وحماية الأسقف من الرطوبة والتشققات، وترميم دورات المياه وتحديث تجهيزاتها، وتأهيل المداخل الرئيسية وتهيئة أماكن انتظار المصلين. يُعدّ هذا المشروع من أكثر المشاريع أثراً في تحسين المظهر الحضاري للمساجد.', 'renovation', 'ترميم', 'gold', 'earth', '3 مساجد', 1500000, 300000, 20, 0, 1, 1, 2, 2, '2026-10-01 18:39:30', '2026-10-01 18:39:30', NULL),
(3, 'مشروع نظافة المساجد', 'غسيل وتعقيم المساجد وفرشها وتوفير مستلزمات النظافة على مدار العام', 'يضمن مشروع نظافة المساجد الحفاظ على نظافة وطهارة بيوت الله على مدار العام، وذلك من خلال فرق متخصصة تقوم بـ: الغسيل الدوري الشامل للأرضيات والجدران، وتعقيم الفرش والسجاد وتنظيفه بمعدات احترافية، وتوفير مستلزمات النظافة اليومية من مطهرات ومعقمات وأدوات نظافة، والاهتمام الخاص بنظافة دورات المياه ونظافتها وتجهيزها بشكل دائم. يستهدف المشروع ضمان بيئة طاهرة ومريحة لجميع المصلين في كل وقت.', 'cleaning', 'نظافة', 'blue', 'sage', '90 مسجد', 150000, 60000, 40, 0, 1, 1, 3, 3, '2026-10-01 18:39:30', '2026-10-01 18:39:30', NULL),
(4, 'مشروع تعطير المساجد', 'توفير وتوزيع معطرات الجو والبخور لتهيئة أجواء إيمانية داخل المساجد', 'يسعى مشروع تعطير المساجد إلى تهيئة أجواء روحانية وإيمانية داخل بيوت الله، عبر توفير وتوزيع أجود أنواع معطرات الجو والبخور المختارة بعناية على مساجد المحافظة. تتضمن خدمات المشروع: توزيعاً منتظماً لمعطرات الجو عالية الجودة، وتوفير البخور والمبخرات، وصيانة أجهزة البخور الكهربائية الموجودة في المساجد، والحرص على استمرارية هذه الخدمة في جميع أوقات الصلوات. ترتبط هذه الخدمة بتعزيز التجربة الروحية للمصلي داخل المسجد.', 'lighting', 'تعطير', 'green', 'moss', '90 مسجداً', 45000, 20000, 44, 0, 1, 0, 0, 4, '2026-10-01 18:39:31', '2026-10-01 18:39:31', NULL),
(5, 'مشروع سُقيا الماء للمساجد', 'توفير قوارير مياه للمصلين وتعبئة خزانات مياه التحلية باستمرار', 'يوفر مشروع سُقيا الماء مياهاً نقية وصحية لمصلي مساجد المحافظة على مدار العام، عبر: تركيب برادات مياه في مداخل المساجد وساحاتها، وتعبئة الخزانات بمياه التحلية بصفة منتظمة، وتوفير أكواب وزجاجات المياه للمصلين في الأوقات الحارة، وصيانة برادات الماء وضمان نظافتها الدائمة. يُعدّ هذا المشروع من أكثر المشاريع خدمةً يومية مباشرة للمصلين خاصة في فصول الصيف.', 'water', 'سقيا الماء', 'blue', 'sand', '100 مسجد', 500000, 180000, 36, 0, 1, 0, 0, 5, '2026-10-01 18:39:31', '2026-10-01 18:39:31', NULL),
(6, 'مشروع بناء المساجد', 'الإسهام في بناء مساجد جديدة وفق الاحتياج المجتمعي وأعلى معايير الجودة الهندسية', 'يمثّل مشروع بناء المساجد قمة العطاء الخيري، إذ يهدف إلى المساهمة في إنشاء مساجد جديدة تلبي احتياجات الأحياء المتنامية في محافظة الخبراء. يعتمد المشروع على: دراسة احتياجات المجتمع وتحديد المناطق الأكثر حاجة، وتوفير التصاميم الهندسية الملائمة، والإشراف على تنفيذ أعمال البناء وفق أعلى معايير الجودة، وتأهيل المسجد الجديد بالكامل (فرش – إنارة – دورات مياه – مكيفات). يجمع المشروع عطاء الدنيا والآخرة، إذ أن من بنى مسجداً لله بنى الله له بيتاً في الجنة.', 'building', 'بناء', 'gold', 'earth', 'مسجد واحد حسب الدعم', 2000000, 0, 5, 0, 1, 0, 0, 6, '2026-10-01 18:39:32', '2026-10-01 18:39:32', NULL);

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

--
-- Dumping data for table `project_categories`
--

INSERT INTO `project_categories` (`id`, `key`, `label`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'all', 'الكل', 1, '2026-10-01 18:39:29', '2026-10-01 18:39:29'),
(2, 'maintenance', 'صيانة المساجد', 2, '2026-10-01 18:39:29', '2026-10-01 18:39:29'),
(3, 'renovation', 'الترميم والتأهيل', 3, '2026-10-01 18:39:29', '2026-10-01 18:39:29'),
(4, 'cleaning', 'نظافة المساجد', 4, '2026-10-01 18:39:29', '2026-10-01 18:39:29'),
(5, 'lighting', 'تعطير المساجد', 5, '2026-10-01 18:39:29', '2026-10-01 18:39:29'),
(6, 'water', 'سُقيا الماء', 6, '2026-10-01 18:39:29', '2026-10-01 18:39:29'),
(7, 'building', 'بناء المساجد', 7, '2026-10-01 18:39:29', '2026-10-01 18:39:29');

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

--
-- Dumping data for table `project_media`
--

INSERT INTO `project_media` (`id`, `project_id`, `type`, `source`, `url`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'image', 'url', 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-267.jpeg', 1, '2026-10-01 18:39:29', '2026-10-01 18:39:29'),
(2, 1, 'image', 'url', 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-269.jpeg', 2, '2026-10-01 18:39:29', '2026-10-01 18:39:29'),
(3, 1, 'image', 'url', 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-26.jpeg', 3, '2026-10-01 18:39:29', '2026-10-01 18:39:29'),
(4, 1, 'image', 'url', 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-263.jpeg', 4, '2026-10-01 18:39:29', '2026-10-01 18:39:29'),
(5, 1, 'image', 'url', 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-186.jpeg', 5, '2026-10-01 18:39:29', '2026-10-01 18:39:29'),
(6, 1, 'video', 'url', 'https://res.cloudinary.com/kivbbrnl/video/upload/pasted-movie-28.mp4', 1, '2026-10-01 18:39:29', '2026-10-01 18:39:29'),
(7, 1, 'video', 'url', 'https://res.cloudinary.com/kivbbrnl/video/upload/pasted-movie-31.mp4', 2, '2026-10-01 18:39:29', '2026-10-01 18:39:29'),
(8, 1, 'video', 'url', 'https://res.cloudinary.com/kivbbrnl/video/upload/pasted-movie-34.mp4', 3, '2026-10-01 18:39:29', '2026-10-01 18:39:29'),
(9, 2, 'image', 'url', 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-172.jpeg', 1, '2026-10-01 18:39:30', '2026-10-01 18:39:30'),
(10, 2, 'image', 'url', 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-291.jpeg', 2, '2026-10-01 18:39:30', '2026-10-01 18:39:30'),
(11, 2, 'image', 'url', 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-220.jpeg', 3, '2026-10-01 18:39:30', '2026-10-01 18:39:30'),
(12, 2, 'image', 'url', 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-285.jpeg', 4, '2026-10-01 18:39:30', '2026-10-01 18:39:30'),
(13, 2, 'image', 'url', 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-140.jpeg', 5, '2026-10-01 18:39:30', '2026-10-01 18:39:30'),
(14, 2, 'video', 'url', 'https://res.cloudinary.com/kivbbrnl/video/upload/pasted-movie-35.mp4', 1, '2026-10-01 18:39:30', '2026-10-01 18:39:30'),
(15, 2, 'video', 'url', 'https://res.cloudinary.com/kivbbrnl/video/upload/pasted-movie-37.mp4', 2, '2026-10-01 18:39:30', '2026-10-01 18:39:30'),
(16, 3, 'image', 'url', 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-68.jpeg', 1, '2026-10-01 18:39:31', '2026-10-01 18:39:31'),
(17, 3, 'image', 'url', 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-109.jpeg', 2, '2026-10-01 18:39:31', '2026-10-01 18:39:31'),
(18, 3, 'image', 'url', 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-69.jpeg', 3, '2026-10-01 18:39:31', '2026-10-01 18:39:31'),
(19, 3, 'image', 'url', 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-58.jpeg', 4, '2026-10-01 18:39:31', '2026-10-01 18:39:31'),
(20, 3, 'image', 'url', 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-57.jpeg', 5, '2026-10-01 18:39:31', '2026-10-01 18:39:31'),
(21, 3, 'video', 'url', 'https://res.cloudinary.com/kivbbrnl/video/upload/pasted-movie-38.mp4', 1, '2026-10-01 18:39:31', '2026-10-01 18:39:31'),
(22, 3, 'video', 'url', 'https://res.cloudinary.com/kivbbrnl/video/upload/pasted-movie-39.mp4', 2, '2026-10-01 18:39:31', '2026-10-01 18:39:31'),
(23, 4, 'image', 'url', 'https://res.cloudinary.com/kivbbrnl/image/upload/1.jpeg', 1, '2026-10-01 18:39:31', '2026-10-01 18:39:31'),
(24, 4, 'image', 'url', 'https://res.cloudinary.com/kivbbrnl/image/upload/2.jpeg', 2, '2026-10-01 18:39:31', '2026-10-01 18:39:31'),
(25, 4, 'image', 'url', 'https://res.cloudinary.com/kivbbrnl/image/upload/3.jpeg', 3, '2026-10-01 18:39:31', '2026-10-01 18:39:31'),
(26, 4, 'image', 'url', 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-165.jpeg', 4, '2026-10-01 18:39:31', '2026-10-01 18:39:31'),
(27, 4, 'image', 'url', 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-166.jpeg', 5, '2026-10-01 18:39:31', '2026-10-01 18:39:31'),
(28, 4, 'video', 'url', 'https://res.cloudinary.com/kivbbrnl/video/upload/pasted-movie-40.mp4', 1, '2026-10-01 18:39:31', '2026-10-01 18:39:31'),
(29, 4, 'video', 'url', 'https://res.cloudinary.com/kivbbrnl/video/upload/pasted-movie-41.mp4', 2, '2026-10-01 18:39:31', '2026-10-01 18:39:31'),
(30, 5, 'image', 'url', 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-134.jpeg', 1, '2026-10-01 18:39:31', '2026-10-01 18:39:31'),
(31, 5, 'image', 'url', 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-167.jpeg', 2, '2026-10-01 18:39:31', '2026-10-01 18:39:31'),
(32, 5, 'image', 'url', 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-169.jpeg', 3, '2026-10-01 18:39:32', '2026-10-01 18:39:32'),
(33, 5, 'image', 'url', 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-170.jpeg', 4, '2026-10-01 18:39:32', '2026-10-01 18:39:32'),
(34, 5, 'image', 'url', 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-171.jpeg', 5, '2026-10-01 18:39:32', '2026-10-01 18:39:32'),
(35, 5, 'video', 'url', 'https://res.cloudinary.com/kivbbrnl/video/upload/pasted-movie-42.mp4', 1, '2026-10-01 18:39:32', '2026-10-01 18:39:32'),
(36, 5, 'video', 'url', 'https://res.cloudinary.com/kivbbrnl/video/upload/pasted-movie-43.mp4', 2, '2026-10-01 18:39:32', '2026-10-01 18:39:32'),
(37, 6, 'image', 'url', 'https://res.cloudinary.com/kivbbrnl/image/upload/image-02.jpg', 1, '2026-10-01 18:39:32', '2026-10-01 18:39:32'),
(38, 6, 'image', 'url', 'https://res.cloudinary.com/kivbbrnl/image/upload/alryan.png', 2, '2026-10-01 18:39:32', '2026-10-01 18:39:32'),
(39, 6, 'image', 'url', 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-225.jpeg', 3, '2026-10-01 18:39:32', '2026-10-01 18:39:32'),
(40, 6, 'image', 'url', 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-250.jpeg', 4, '2026-10-01 18:39:32', '2026-10-01 18:39:32'),
(41, 6, 'image', 'url', 'https://res.cloudinary.com/kivbbrnl/image/upload/pasted-image-274.jpeg', 5, '2026-10-01 18:39:32', '2026-10-01 18:39:32'),
(42, 6, 'video', 'url', 'https://res.cloudinary.com/kivbbrnl/video/upload/pasted-movie-44.mp4', 1, '2026-10-01 18:39:32', '2026-10-01 18:39:32'),
(43, 6, 'video', 'url', 'https://res.cloudinary.com/kivbbrnl/video/upload/pasted-movie-45.mp4', 2, '2026-10-01 18:39:32', '2026-10-01 18:39:32');

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
('1fsZfAbWHsu2U3RLK1DWpqvDi4m8LTuYQUYv0L6R', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSVpYcENhR0I3Vnd0bUliUlRDZzh6RjhaSVA0T1B0RTZrQXdmZkdaTiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wYW5lbC04ZjNrMng5ZHE3Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1790905273),
('s8xqcLJh84S4w1BweZtEXLuzJNjNHZPVT5GNQL7t', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR1dwS25BWHFDT00xOVJGa2F3VE1YZkRTbGRzeTJ0ZVFyRkg5VTlHcyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wYW5lbC04ZjNrMng5ZHE3Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1790897377),
('wa295ATenJpeYaaWQZvKHVSpAvcDppC8B1WnU2OH', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT3F3SnhWQnJKNnlhRmVXWkFyTGhFY0ZCbXVWS1ZaODFCYjBsbTZlbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wYW5lbC04ZjNrMng5ZHE3L3RyYXNoIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1790957946);

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
-- Dumping data for table `site_contents`
--

INSERT INTO `site_contents` (`id`, `page`, `key`, `value`, `updated_at`) VALUES
(1, 'settings', 'associationName', '\"\\u062c\\u0645\\u0639\\u064a\\u0629 \\u0628\\u0646\\u064a\\u0627\\u0646 \\u0644\\u0644\\u0639\\u0646\\u0627\\u064a\\u0629 \\u0628\\u0627\\u0644\\u0645\\u0633\\u0627\\u062c\\u062f \\u0628\\u0627\\u0644\\u062e\\u0628\\u0631\\u0627\\u0621\"', '2026-10-01 18:39:13'),
(2, 'settings', 'phone', '\"0536502143\"', '2026-10-01 18:39:13'),
(3, 'settings', 'phoneDisplay', '\"+966 53 650 2143\"', '2026-10-01 18:39:14'),
(4, 'settings', 'phoneTel', '\"+966536502143\"', '2026-10-01 18:39:14'),
(5, 'settings', 'email', '\"bunyan355@gmail.com\"', '2026-10-01 18:39:14'),
(6, 'settings', 'addressShort', '\"\\u0627\\u0644\\u0642\\u0635\\u064a\\u0645 \\u00b7 \\u0627\\u0644\\u062e\\u0628\\u0631\\u0627\\u0621 \\u00b7 \\u0637\\u0631\\u064a\\u0642 \\u0627\\u0644\\u0645\\u0644\\u0643 \\u0641\\u0647\\u062f\"', '2026-10-01 18:39:14'),
(7, 'settings', 'addressFull', '\"\\u062d\\u064a \\u0627\\u0644\\u0645\\u0631\\u0642\\u0628\\u060c \\u0627\\u0644\\u062e\\u0628\\u0631\\u0627\\u0621\\u060c \\u0645\\u0646\\u0637\\u0642\\u0629 \\u0627\\u0644\\u0642\\u0635\\u064a\\u0645\\u060c \\u0627\\u0644\\u0645\\u0645\\u0644\\u0643\\u0629 \\u0627\\u0644\\u0639\\u0631\\u0628\\u064a\\u0629 \\u0627\\u0644\\u0633\\u0639\\u0648\\u062f\\u064a\\u0629\"', '2026-10-01 18:39:14'),
(8, 'settings', 'addressLine', '\"\\u0627\\u0644\\u0642\\u0635\\u064a\\u0645 - \\u0627\\u0644\\u062e\\u0628\\u0631\\u0627\\u0621 - \\u0637\\u0631\\u064a\\u0642 \\u0627\\u0644\\u0645\\u0644\\u0643 \\u0641\\u0647\\u062f\"', '2026-10-01 18:39:14'),
(9, 'settings', 'workingHours', '\"\\u0645\\u0646 \\u0627\\u0644\\u0623\\u062d\\u062f \\u0625\\u0644\\u0649 \\u0627\\u0644\\u062e\\u0645\\u064a\\u0633: 8 \\u0635 - 4 \\u0645\"', '2026-10-01 18:39:14'),
(10, 'settings', 'licenseNo', '\"1000806000\"', '2026-10-01 18:39:14'),
(11, 'settings', 'unifiedNo', '\"7051934854\"', '2026-10-01 18:39:14'),
(12, 'settings', 'mapsUrl', '\"https:\\/\\/maps.app.goo.gl\\/tB3aC7VvD9nF6WbA9\"', '2026-10-01 18:39:14'),
(13, 'settings', 'whatsappUrl', '\"https:\\/\\/wa.me\\/966536502143\"', '2026-10-01 18:39:14'),
(14, 'settings', 'bankName', '\"\\u0645\\u0635\\u0631\\u0641 \\u0627\\u0644\\u0631\\u0627\\u062c\\u062d\\u064a\"', '2026-10-01 18:39:14'),
(15, 'settings', 'bankNameEn', '\"Al Rajhi Bank\"', '2026-10-01 18:39:15'),
(16, 'settings', 'accountName', '\"\\u062c\\u0645\\u0639\\u064a\\u0629 \\u0628\\u0646\\u064a\\u0627\\u0646 \\u0644\\u0644\\u0639\\u0646\\u0627\\u064a\\u0629 \\u0628\\u0627\\u0644\\u0645\\u0633\\u0627\\u062c\\u062f \\u0628\\u0627\\u0644\\u062e\\u0628\\u0631\\u0627\\u0621\"', '2026-10-01 18:39:15'),
(17, 'settings', 'iban', '\"SA8680000265608010979797\"', '2026-10-01 18:39:15'),
(18, 'settings', 'ibanDisplay', '\"SA86 8000 0265 6080 1097 9797\"', '2026-10-01 18:39:15'),
(19, 'settings', 'instagramHandle', '\"@Bunyan355\"', '2026-10-01 18:39:15'),
(20, 'settings', 'instagramUrl', '\"https:\\/\\/instagram.com\\/Bunyan355\"', '2026-10-01 18:39:15'),
(21, 'settings', 'xHandle', '\"@Bunyan355Bunyan\"', '2026-10-01 18:39:15'),
(22, 'settings', 'xUrl', '\"https:\\/\\/x.com\\/Bunyan355Bunyan\"', '2026-10-01 18:39:15'),
(23, 'settings', 'youtubeHandle', '\"\\u062c\\u0645\\u0639\\u064a\\u0629 \\u0628\\u0646\\u064a\\u0627\\u0646\"', '2026-10-01 18:39:15'),
(24, 'settings', 'youtubeUrl', '\"https:\\/\\/www.youtube.com\\/@Bunyan355\"', '2026-10-01 18:39:15'),
(25, 'settings', 'socialPlatforms', '[{\"id\":\"whatsapp\",\"icon\":\"whatsapp\",\"title\":\"\\u0648\\u0627\\u062a\\u0633\\u0627\\u0628\",\"handle\":\"0536502143\",\"desc\":\"\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0645\\u0639\\u0646\\u0627 \\u0645\\u0628\\u0627\\u0634\\u0631\\u0629 \\u0639\\u0628\\u0631 \\u0648\\u0627\\u062a\\u0633\\u0627\\u0628 \\u0644\\u0644\\u0627\\u0633\\u062a\\u0641\\u0633\\u0627\\u0631\\u0627\\u062a \\u0648\\u0627\\u0644\\u0631\\u062f \\u0627\\u0644\\u0633\\u0631\\u064a\\u0639\",\"btnLabel\":\"\\u0645\\u0631\\u0627\\u0633\\u0644\\u0629 \\u0648\\u0627\\u062a\\u0633\\u0627\\u0628\",\"href\":\"https:\\/\\/wa.me\\/966536502143\",\"className\":\"whatsapp\"},{\"id\":\"instagram\",\"icon\":\"instagram\",\"title\":\"\\u062d\\u0633\\u0627\\u0628 \\u0625\\u0646\\u0633\\u062a\\u063a\\u0631\\u0627\\u0645\",\"handle\":\"@Bunyan355\",\"desc\":\"\\u0634\\u0627\\u0647\\u062f \\u0627\\u0644\\u062a\\u063a\\u0637\\u064a\\u0627\\u062a \\u0627\\u0644\\u0645\\u0635\\u0648\\u0631\\u0629 \\u0648\\u0627\\u0644\\u0642\\u0635\\u0635 \\u0627\\u0644\\u064a\\u0648\\u0645\\u064a\\u0629 \\u0644\\u0623\\u0639\\u0645\\u0627\\u0644 \\u0627\\u0644\\u0635\\u064a\\u0627\\u0646\\u0629 \\u0627\\u0644\\u0645\\u064a\\u062f\\u0627\\u0646\\u064a\\u0629 \\u0644\\u0644\\u0645\\u0633\\u0627\\u062c\\u062f\",\"btnLabel\":\"\\u0632\\u064a\\u0627\\u0631\\u0629 \\u0627\\u0644\\u062d\\u0633\\u0627\\u0628\",\"href\":\"https:\\/\\/instagram.com\\/Bunyan355\",\"className\":\"instagram\"},{\"id\":\"x\",\"icon\":\"brand-x\",\"title\":\"\\u0645\\u0646\\u0635\\u0629 \\u0625\\u0643\\u0633 (\\u062a\\u0648\\u064a\\u062a\\u0631)\",\"handle\":\"@Bunyan355Bunyan\",\"desc\":\"\\u062a\\u0627\\u0628\\u0639 \\u0622\\u062e\\u0631 \\u062a\\u063a\\u0637\\u064a\\u0627\\u062a\\u0646\\u0627 \\u0627\\u0644\\u064a\\u0648\\u0645\\u064a\\u0629 \\u0648\\u0625\\u0639\\u0644\\u0627\\u0646\\u0627\\u062a \\u062a\\u062f\\u0634\\u064a\\u0646 \\u0645\\u0634\\u0627\\u0631\\u064a\\u0639 \\u0627\\u0644\\u0645\\u0633\\u0627\\u062c\\u062f \\u0648\\u0635\\u064a\\u0627\\u0646\\u062a\\u0647\\u0627 \\u0623\\u0648\\u0644\\u0627\\u064b \\u0628\\u0623\\u0648\\u0644\",\"btnLabel\":\"\\u0632\\u064a\\u0627\\u0631\\u0629 \\u0627\\u0644\\u062d\\u0633\\u0627\\u0628\",\"href\":\"https:\\/\\/x.com\\/Bunyan355Bunyan\",\"className\":\"twitter\"},{\"id\":\"email\",\"icon\":\"mail\",\"title\":\"\\u0627\\u0644\\u0628\\u0631\\u064a\\u062f \\u0627\\u0644\\u0625\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a\",\"handle\":\"bunyan355@gmail.com\",\"desc\":\"\\u0623\\u0631\\u0633\\u0644 \\u0645\\u0642\\u062a\\u0631\\u062d\\u0627\\u062a\\u0643 \\u0648\\u0627\\u0633\\u062a\\u0641\\u0633\\u0627\\u0631\\u0627\\u062a\\u0643 \\u0648\\u0633\\u0646\\u0642\\u0648\\u0645 \\u0628\\u0627\\u0644\\u0631\\u062f \\u0639\\u0644\\u064a\\u0647\\u0627 \\u062e\\u0644\\u0627\\u0644 \\u0662\\u0664 \\u0633\\u0627\\u0639\\u0629 \\u0639\\u0645\\u0644\",\"btnLabel\":\"\\u0625\\u0631\\u0633\\u0627\\u0644 \\u0628\\u0631\\u064a\\u062f\",\"href\":\"mailto:bunyan355@gmail.com\",\"className\":\"email\"}]', '2026-10-01 18:39:15'),
(26, 'home', 'eyebrow', '\"\\u062c\\u0645\\u0639\\u064a\\u0629 \\u0628\\u0646\\u064a\\u0627\\u0646 \\u00b7 \\u0627\\u0644\\u062e\\u0628\\u0631\\u0627\\u0621\"', '2026-10-01 18:39:15'),
(27, 'home', 'titleLine1', '\"\\u0628\\u0625\\u062a\\u0642\\u0627\\u0646\\u064d \\u0646\\u0631\\u0639\\u0649 \\u0628\\u064a\\u0648\\u062a \\u0627\\u0644\\u0644\\u0647\\u060c\"', '2026-10-01 18:39:15'),
(28, 'home', 'titleLine2', '\"\\u0648\\u0628\\u0625\\u062d\\u0633\\u0627\\u0646\\u064d \\u0646\\u062e\\u062f\\u0645\\u0647\\u0627.\"', '2026-10-01 18:39:16'),
(29, 'home', 'description', '\"\\u0646\\u0639\\u0645\\u0644 \\u0628\\u0625\\u062e\\u0644\\u0627\\u0635 \\u0644\\u0635\\u064a\\u0627\\u0646\\u0629 \\u0648\\u062a\\u0631\\u0645\\u064a\\u0645 \\u0648\\u062a\\u062c\\u0647\\u064a\\u0632 \\u0645\\u0633\\u0627\\u062c\\u062f\\u0646\\u0627 \\u0641\\u064a \\u0645\\u062d\\u0627\\u0641\\u0638\\u0629 \\u0627\\u0644\\u062e\\u0628\\u0631\\u0627\\u0621\\u060c \\u0644\\u062a\\u0628\\u0642\\u0649 \\u0639\\u0627\\u0645\\u0631\\u0629 \\u0628\\u0630\\u0643\\u0631 \\u0627\\u0644\\u0644\\u0647 \\u0648\\u0645\\u062d\\u0628\\u0629 \\u0627\\u0644\\u0645\\u062c\\u062a\\u0645\\u0639.\"', '2026-10-01 18:39:16'),
(30, 'home', 'btnDonateText', '\"\\u062a\\u0628\\u0631\\u0651\\u0639 \\u0627\\u0644\\u0622\\u0646\"', '2026-10-01 18:39:16'),
(31, 'home', 'btnProjectsText', '\"\\u0627\\u0633\\u062a\\u0639\\u0631\\u0636 \\u0627\\u0644\\u0645\\u0634\\u0627\\u0631\\u064a\\u0639\"', '2026-10-01 18:39:17'),
(32, 'home', 'heroBg', '\"https:\\/\\/res.cloudinary.com\\/kivbbrnl\\/image\\/upload\\/image-01.jpg\"', '2026-10-01 18:39:17'),
(33, 'home', 'heroVideoPoster', '\"https:\\/\\/res.cloudinary.com\\/kivbbrnl\\/image\\/upload\\/image-01.jpg\"', '2026-10-01 18:39:17'),
(34, 'home', 'heroVideo', '\"https:\\/\\/res.cloudinary.com\\/kivbbrnl\\/video\\/upload\\/v1783970958\\/hero.mp4\"', '2026-10-01 18:39:17'),
(35, 'home', 'tag', '\"\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0633\\u0631\\u064a\\u0639\"', '2026-10-01 18:39:18'),
(36, 'home', 'title', '\"\\u0646\\u062d\\u0646 \\u0647\\u0646\\u0627 \\u0644\\u062e\\u062f\\u0645\\u062a\\u0643 \\u0648\\u0625\\u062c\\u0627\\u0628\\u0629 \\u0627\\u0633\\u062a\\u0641\\u0633\\u0627\\u0631\\u0627\\u062a\\u0643\"', '2026-10-01 18:39:19'),
(37, 'home', 'p1', '\"\\u062c\\u0645\\u0639\\u064a\\u0629 \\u0623\\u0647\\u0644\\u064a\\u0629 \\u063a\\u064a\\u0631 \\u0631\\u0628\\u062d\\u064a\\u0629 \\u062a\\u064f\\u0639\\u0646\\u0649 \\u0628\\u0635\\u064a\\u0627\\u0646\\u0629 \\u0627\\u0644\\u0645\\u0633\\u0627\\u062c\\u062f \\u0648\\u062a\\u062c\\u0647\\u064a\\u0632\\u0647\\u0627 \\u0648\\u0645\\u062a\\u0627\\u0628\\u0639\\u0629 \\u0627\\u062d\\u062a\\u064a\\u0627\\u062c\\u0627\\u062a\\u0647\\u0627 \\u0641\\u064a \\u0645\\u062f\\u064a\\u0646\\u0629 \\u0627\\u0644\\u062e\\u0628\\u0631\\u0627\\u0621\\u060c \\u0648\\u062a\\u0633\\u0639\\u0649 \\u0625\\u0644\\u0649 \\u062a\\u0647\\u064a\\u0626\\u0629 \\u0628\\u064a\\u0626\\u0629 \\u0625\\u064a\\u0645\\u0627\\u0646\\u064a\\u0629 \\u0622\\u0645\\u0646\\u0629 \\u0648\\u0646\\u0638\\u064a\\u0641\\u0629 \\u0648\\u0645\\u062a\\u0643\\u0627\\u0645\\u0644\\u0629 \\u0644\\u0644\\u0645\\u0635\\u0644\\u064a\\u0646\\u060c \\u0628\\u0645\\u0627 \\u064a\\u0639\\u0632\\u0632 \\u062f\\u0648\\u0631 \\u0627\\u0644\\u0645\\u0633\\u062c\\u062f \\u0627\\u0644\\u062f\\u064a\\u0646\\u064a \\u0648\\u0627\\u0644\\u0627\\u062c\\u062a\\u0645\\u0627\\u0639\\u064a.\"', '2026-10-01 18:39:17'),
(38, 'home', 'p2', '\"\\u0645\\u0631\\u062e\\u0635\\u0629 \\u0645\\u0646 \\u0627\\u0644\\u0645\\u0631\\u0643\\u0632 \\u0627\\u0644\\u0648\\u0637\\u0646\\u064a \\u0644\\u062a\\u0646\\u0645\\u064a\\u0629 \\u0627\\u0644\\u0642\\u0637\\u0627\\u0639 \\u063a\\u064a\\u0631 \\u0627\\u0644\\u0631\\u0628\\u062d\\u064a\\u060c \\u0648\\u062a\\u0639\\u0645\\u0644 \\u0648\\u0641\\u0642 \\u062e\\u0637\\u0629 \\u0627\\u0633\\u062a\\u0631\\u0627\\u062a\\u064a\\u062c\\u064a\\u0629 \\u0648\\u062e\\u0637\\u0629 \\u062a\\u0634\\u063a\\u064a\\u0644\\u064a\\u0629 \\u0633\\u0646\\u0648\\u064a\\u0629 \\u0645\\u0639\\u062a\\u0645\\u062f\\u0629.\"', '2026-10-01 18:39:17'),
(39, 'home', 'image1', '\"https:\\/\\/res.cloudinary.com\\/kivbbrnl\\/image\\/upload\\/image-06.jpg\"', '2026-10-01 18:39:17'),
(40, 'home', 'image2', '\"https:\\/\\/res.cloudinary.com\\/kivbbrnl\\/image\\/upload\\/image-08.jpg\"', '2026-10-01 18:39:17'),
(41, 'home', 'estYear', '\"\\u0661\\u0664\\u0664\\u0666\"', '2026-10-01 18:39:17'),
(42, 'home', 'licenseTitle', '\"\\u062c\\u0647\\u0629 \\u0645\\u0639\\u062a\\u0645\\u062f\\u0629 \\u0631\\u0633\\u0645\\u064a\\u0627\\u064b\"', '2026-10-01 18:39:17'),
(43, 'home', 'licenseDesc', '\"\\u0645\\u0631\\u062e\\u0635\\u0629 \\u0645\\u0646 \\u0627\\u0644\\u0645\\u0631\\u0643\\u0632 \\u0627\\u0644\\u0648\\u0637\\u0646\\u064a \\u0644\\u062a\\u0646\\u0645\\u064a\\u0629 \\u0627\\u0644\\u0642\\u0637\\u0627\\u0639 \\u063a\\u064a\\u0631 \\u0627\\u0644\\u0631\\u0628\\u062d\\u064a\"', '2026-10-01 18:39:17'),
(44, 'home', 'ctaTitle', '\"\\u0634\\u0627\\u0631\\u0643\\u0646\\u0627 \\u0625\\u0639\\u0645\\u0627\\u0631 \\u0628\\u064a\\u0648\\u062a \\u0627\\u0644\\u0644\\u0647\"', '2026-10-01 18:39:17'),
(45, 'home', 'ctaDesc', '\"\\u0627\\u0633\\u062a\\u0639\\u0631\\u0636 \\u062c\\u0645\\u064a\\u0639 \\u0645\\u0634\\u0627\\u0631\\u064a\\u0639 \\u0627\\u0644\\u062c\\u0645\\u0639\\u064a\\u0629 \\u0627\\u0644\\u062c\\u0627\\u0631\\u064a\\u0629 \\u0648\\u0627\\u062e\\u062a\\u0631 \\u0645\\u0627 \\u064a\\u0646\\u0627\\u0633\\u0628\\u0643 \\u0644\\u0644\\u0645\\u0633\\u0627\\u0647\\u0645\\u0629 \\u0641\\u064a \\u0635\\u0646\\u0627\\u0639\\u0629 \\u0623\\u062b\\u0631 \\u0628\\u0627\\u0642\\u064d.\"', '2026-10-01 18:39:17'),
(46, 'home', 'ctaBtnText', '\"\\u0627\\u0633\\u062a\\u0639\\u0631\\u0636 \\u0627\\u0644\\u0645\\u0634\\u0627\\u0631\\u064a\\u0639\"', '2026-10-01 18:39:17'),
(47, 'home', 'scrollHint', '\"\\u0627\\u0633\\u062d\\u0628 \\u0644\\u0627\\u0633\\u062a\\u0639\\u0631\\u0627\\u0636 \\u0627\\u0644\\u0645\\u0634\\u0627\\u0631\\u064a\\u0639\"', '2026-10-01 18:39:17'),
(48, 'home', 'subtitle', '\"\\u0646\\u0633\\u0639\\u0649 \\u0641\\u064a \\u062c\\u0645\\u0639\\u064a\\u0629 \\u0628\\u0646\\u064a\\u0627\\u0646 \\u0644\\u0644\\u0639\\u0646\\u0627\\u064a\\u0629 \\u0628\\u0627\\u0644\\u0645\\u0633\\u0627\\u062c\\u062f \\u0625\\u0644\\u0649 \\u062a\\u062d\\u0642\\u064a\\u0642 \\u0623\\u062b\\u0631 \\u0645\\u0644\\u0645\\u0648\\u0633 \\u0648\\u0645\\u0633\\u062a\\u062f\\u0627\\u0645 \\u0641\\u064a \\u062e\\u062f\\u0645\\u0629 \\u0627\\u0644\\u0645\\u0633\\u0627\\u062c\\u062f \\u0648\\u062a\\u0623\\u0647\\u064a\\u0644\\u0647\\u0627\\u060c \\u0645\\u0646 \\u062e\\u0644\\u0627\\u0644 \\u0628\\u0631\\u0627\\u0645\\u062c \\u0646\\u0648\\u0639\\u064a\\u0629 \\u0648\\u0645\\u0634\\u0627\\u0631\\u064a\\u0639 \\u0645\\u062a\\u0643\\u0627\\u0645\\u0644\\u0629 \\u062a\\u0633\\u062a\\u0647\\u062f\\u0641 \\u0631\\u0639\\u0627\\u064a\\u0629 \\u0627\\u0644\\u0645\\u0635\\u0644\\u064a\\u0646 \\u0648\\u0625\\u0639\\u0645\\u0627\\u0631 \\u0628\\u064a\\u0648\\u062a \\u0627\\u0644\\u0644\\u0647.\"', '2026-10-01 18:39:18'),
(49, 'home', 'btnText', '\"\\u0635\\u0641\\u062d\\u0629 \\u0627\\u0644\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0627\\u0644\\u0643\\u0627\\u0645\\u0644\\u0629\"', '2026-10-01 18:39:19'),
(50, 'home', 'items', '[{\"icon\":\"carpet\",\"value\":12500,\"unit\":\"\\u0645\\u00b2\",\"label\":\"\\u0633\\u062c\\u0627\\u062f \\u0645\\u0633\\u0627\\u062c\\u062f \\u062a\\u0645 \\u063a\\u0633\\u0644\\u0647 \\u0648\\u062a\\u0646\\u0638\\u064a\\u0641\\u0647\"},{\"icon\":\"ac\",\"value\":84,\"unit\":\"\",\"label\":\"\\u0648\\u062d\\u062f\\u0629 \\u062a\\u0643\\u064a\\u064a\\u0641 \\u062a\\u0645\\u062a \\u0635\\u064a\\u0627\\u0646\\u062a\\u0647\\u0627 \\u0648\\u062a\\u0646\\u0638\\u064a\\u0641\\u0647\\u0627\"},{\"icon\":\"bottle\",\"value\":45000,\"unit\":\"\",\"label\":\"\\u0639\\u0628\\u0648\\u0629 \\u0645\\u064a\\u0627\\u0647 \\u0648\\u064f\\u0632\\u0651\\u0639\\u062a \\u0639\\u0644\\u0649 \\u0631\\u0648\\u0627\\u062f \\u0627\\u0644\\u0645\\u0633\\u0627\\u062c\\u062f\"},{\"icon\":\"users\",\"value\":12000,\"unit\":\"\",\"label\":\"\\u0645\\u0633\\u062a\\u0641\\u064a\\u062f \\u0645\\u0646 \\u0628\\u0631\\u0627\\u0645\\u062c \\u0648\\u0623\\u0646\\u0634\\u0637\\u0629 \\u0627\\u0644\\u062c\\u0645\\u0639\\u064a\\u0629\"}]', '2026-10-01 18:39:18'),
(51, 'home', 'desc', '\"\\u064a\\u0633\\u0639\\u062f\\u0646\\u0627 \\u0627\\u0644\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0645\\u0639\\u0643\\u0645 \\u0648\\u0627\\u0644\\u0625\\u062c\\u0627\\u0628\\u0629 \\u0639\\u0644\\u0649 \\u0643\\u0627\\u0641\\u0629 \\u0627\\u0633\\u062a\\u0641\\u0633\\u0627\\u0631\\u0627\\u062a\\u0643\\u0645 \\u0628\\u062e\\u0635\\u0648\\u0635 \\u0645\\u0634\\u0627\\u0631\\u064a\\u0639 \\u0627\\u0644\\u062c\\u0645\\u0639\\u064a\\u0629 \\u0648\\u0628\\u0631\\u0627\\u0645\\u062c \\u0627\\u0644\\u0639\\u0646\\u0627\\u064a\\u0629 \\u0628\\u0628\\u064a\\u0648\\u062a \\u0627\\u0644\\u0644\\u0647 \\u0641\\u064a \\u0645\\u0646\\u0637\\u0642\\u0629 \\u0627\\u0644\\u0642\\u0635\\u064a\\u0645.\"', '2026-10-01 18:39:19'),
(52, 'home', 'btnPrimaryText', '\"\\u0633\\u062c\\u0651\\u0644 \\u0643\\u0645\\u062a\\u0637\\u0648\\u0639\"', '2026-10-01 18:39:18'),
(53, 'home', 'btnSecondaryText', '\"\\u062a\\u0639\\u0631\\u0651\\u0641 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u0641\\u0631\\u0635\"', '2026-10-01 18:39:18'),
(54, 'home', 'image', '\"https:\\/\\/res.cloudinary.com\\/kivbbrnl\\/image\\/upload\\/pasted-image-267.jpeg\"', '2026-10-01 18:39:18'),
(55, 'about', 'tag', '\"\\u0627\\u0644\\u062c\\u0645\\u0639\\u064a\\u0629 \\u0641\\u064a \\u0635\\u0648\\u0631\"', '2026-10-01 18:39:21'),
(56, 'about', 'title', '\"\\u062a\\u0639\\u0631\\u0641 \\u0639\\u0644\\u064a\\u0646\\u0627 \\u0639\\u0646 \\u0642\\u0631\\u0628\"', '2026-10-01 18:39:21'),
(57, 'about', 'subtitle', '\"\\u0628\\u0631\\u0627\\u0645\\u062c \\u0648\\u0645\\u0628\\u0627\\u062f\\u0631\\u0627\\u062a \\u062a\\u0634\\u063a\\u064a\\u0644\\u064a\\u0629 \\u0633\\u0646\\u0648\\u064a\\u0629 \\u062a\\u062a\\u0631\\u062c\\u0645 \\u0627\\u0644\\u0623\\u0647\\u062f\\u0627\\u0641 \\u0627\\u0644\\u0627\\u0633\\u062a\\u0631\\u0627\\u062a\\u064a\\u062c\\u064a\\u0629 \\u0625\\u0644\\u0649 \\u0623\\u062b\\u0631 \\u0645\\u0644\\u0645\\u0648\\u0633 \\u0639\\u0644\\u0649 \\u0623\\u0631\\u0636 \\u0627\\u0644\\u0648\\u0627\\u0642\\u0639\"', '2026-10-01 18:39:20'),
(58, 'about', 'bodyText', '\"\\u062a\\u0623\\u0633\\u0633\\u062a \\u0627\\u0644\\u062c\\u0645\\u0639\\u064a\\u0629 \\u0644\\u062a\\u0644\\u0628\\u064a\\u0629 \\u0627\\u0644\\u062d\\u0627\\u062c\\u0629 \\u0627\\u0644\\u0645\\u0627\\u0633\\u0629 \\u0625\\u0644\\u0649 \\u062c\\u0647\\u0629 \\u0645\\u062a\\u062e\\u0635\\u0635\\u0629 \\u062a\\u0631\\u0639\\u0649 \\u0628\\u064a\\u0648\\u062a \\u0627\\u0644\\u0644\\u0647 \\u0648\\u062a\\u062d\\u0627\\u0641\\u0638 \\u0639\\u0644\\u064a\\u0647\\u0627. \\u0648\\u0646\\u062d\\u0646 \\u0646\\u0639\\u0645\\u0644 \\u0628\\u0641\\u0636\\u0644 \\u0627\\u0644\\u0644\\u0647 \\u062b\\u0645 \\u0628\\u062f\\u0639\\u0645\\u0643\\u0645 \\u0627\\u0644\\u0633\\u062e\\u064a \\u0639\\u0644\\u0649 \\u062a\\u0648\\u0641\\u064a\\u0631 \\u0628\\u064a\\u0626\\u0629 \\u0625\\u064a\\u0645\\u0627\\u0646\\u064a\\u0629\\u060c \\u0645\\u0631\\u064a\\u062d\\u0629\\u060c \\u0648\\u0646\\u0638\\u064a\\u0641\\u0629 \\u0644\\u0644\\u0645\\u0635\\u0644\\u064a\\u0646 \\u0641\\u064a \\u0645\\u062d\\u0627\\u0641\\u0638\\u0629 \\u0627\\u0644\\u062e\\u0628\\u0631\\u0627\\u0621 \\u0648\\u0627\\u0644\\u0645\\u0631\\u0627\\u0643\\u0632 \\u0648\\u0627\\u0644\\u0642\\u0631\\u0649 \\u0627\\u0644\\u062a\\u0627\\u0628\\u0639\\u0629 \\u0644\\u0647\\u0627 \\u0648\\u0641\\u0642 \\u0645\\u0645\\u0627\\u0631\\u0633\\u0627\\u062a \\u0645\\u0624\\u0633\\u0633\\u064a\\u0629 \\u0648\\u062d\\u0648\\u0643\\u0645\\u0629 \\u0634\\u0641\\u0627\\u0641\\u0629.\"', '2026-10-01 18:39:19'),
(59, 'about', 'pillar1Title', '\"\\u062a\\u0631\\u062e\\u064a\\u0635 \\u0631\\u0633\\u0645\\u064a \\u0645\\u0639\\u062a\\u0645\\u062f\"', '2026-10-01 18:39:19'),
(60, 'about', 'pillar1Desc', '\"\\u0645\\u0633\\u062c\\u0644\\u064a\\u0646 \\u0631\\u0633\\u0645\\u064a\\u0627\\u064b \\u0628\\u0627\\u0644\\u0645\\u0631\\u0643\\u0632 \\u0627\\u0644\\u0648\\u0637\\u0646\\u064a \\u0644\\u062a\\u0646\\u0645\\u064a\\u0629 \\u0627\\u0644\\u0642\\u0637\\u0627\\u0639 \\u063a\\u064a\\u0631 \\u0627\\u0644\\u0631\\u0628\\u062d\\u064a\"', '2026-10-01 18:39:20'),
(61, 'about', 'pillar2Title', '\"\\u062a\\u063a\\u0637\\u064a\\u0629 \\u062c\\u063a\\u0631\\u0627\\u0641\\u064a\\u0629 \\u0643\\u0627\\u0645\\u0644\\u0629\"', '2026-10-01 18:39:20'),
(62, 'about', 'pillar2Desc', '\"\\u0635\\u064a\\u0627\\u0646\\u0629 \\u0648\\u062a\\u0623\\u0647\\u064a\\u0644 \\u0627\\u0644\\u0645\\u0633\\u0627\\u062c\\u062f \\u0641\\u064a \\u0627\\u0644\\u062e\\u0628\\u0631\\u0627\\u0621 \\u0648\\u0627\\u0644\\u0642\\u0631\\u0649 \\u0648\\u0627\\u0644\\u0645\\u0631\\u0627\\u0643\\u0632 \\u0627\\u0644\\u0645\\u062c\\u0627\\u0648\\u0631\\u0629\"', '2026-10-01 18:39:20'),
(63, 'about', 'videoUrl', '\"https:\\/\\/res.cloudinary.com\\/kivbbrnl\\/video\\/upload\\/v1783971405\\/about-us.mp4\"', '2026-10-01 18:39:20'),
(64, 'about', 'videoPoster', '\"https:\\/\\/res.cloudinary.com\\/kivbbrnl\\/image\\/upload\\/image-02.jpg\"', '2026-10-01 18:39:20'),
(65, 'about', 'visionText', '\"\\u0627\\u0644\\u0631\\u064a\\u0627\\u062f\\u0629 in \\u0627\\u0644\\u0639\\u0646\\u0627\\u064a\\u0629 \\u0628\\u0627\\u0644\\u0645\\u0633\\u0627\\u062c\\u062f \\u0648\\u062a\\u062d\\u0642\\u064a\\u0642 \\u0623\\u0639\\u0644\\u0649 \\u0645\\u0639\\u0627\\u064a\\u064a\\u0631 \\u0627\\u0644\\u062c\\u0648\\u062f\\u0629 \\u0648\\u0627\\u0644\\u062c\\u0645\\u0627\\u0644 \\u0641\\u064a \\u0625\\u0639\\u0645\\u0627\\u0631 \\u0628\\u064a\\u0648\\u062a \\u0627\\u0644\\u0644\\u0647.\"', '2026-10-01 18:39:20'),
(66, 'about', 'missionText', '\"\\u062a\\u0642\\u062f\\u064a\\u0645 \\u062e\\u062f\\u0645\\u0627\\u062a \\u0645\\u062a\\u0643\\u0627\\u0645\\u0644\\u0629 \\u0648\\u0645\\u0633\\u062a\\u062f\\u0627\\u0645\\u0629 \\u0644\\u0635\\u064a\\u0627\\u0646\\u0629 \\u0648\\u062a\\u062c\\u0647\\u064a\\u0632 \\u0627\\u0644\\u0645\\u0633\\u0627\\u062c\\u062f \\u0648\\u062a\\u0637\\u0648\\u064a\\u0631 \\u0645\\u0631\\u0627\\u0641\\u0642\\u0647\\u0627\\u060c \\u0648\\u062a\\u0639\\u0632\\u064a\\u0632 \\u062f\\u0648\\u0631\\u0647\\u0627 \\u0627\\u0644\\u0625\\u064a\\u0645\\u0627\\u0646\\u064a \\u0648\\u0627\\u0644\\u0645\\u062c\\u062a\\u0645\\u0639\\u064a.\"', '2026-10-01 18:39:20'),
(67, 'about', 'goals', '[{\"title\":\"\\u0628\\u0631\\u0646\\u0627\\u0645\\u062c \\u0627\\u0644\\u0635\\u064a\\u0627\\u0646\\u0629 \\u0627\\u0644\\u062f\\u0648\\u0631\\u064a\\u0629\",\"desc\":\"\\u062a\\u0646\\u0641\\u064a\\u0630 \\u062c\\u0648\\u0644\\u0627\\u062a \\u0635\\u064a\\u0627\\u0646\\u0629 \\u062f\\u0648\\u0631\\u064a\\u0629 \\u062a\\u063a\\u0637\\u064a 20 \\u0645\\u0633\\u062c\\u062f\\u0627\\u064b \\u0633\\u0646\\u0648\\u064a\\u0627\\u064b \\u062a\\u0634\\u0645\\u0644 \\u0627\\u0644\\u0625\\u0646\\u0627\\u0631\\u0629 \\u0648\\u0627\\u0644\\u0633\\u0628\\u0627\\u0643\\u0629 \\u0648\\u0627\\u0644\\u062a\\u0643\\u064a\\u064a\\u0641.\"},{\"title\":\"\\u062d\\u0645\\u0644\\u0627\\u062a \\u0646\\u0638\\u0627\\u0641\\u0629 \\u0627\\u0644\\u0645\\u0633\\u0627\\u062c\\u062f\",\"desc\":\"\\u062a\\u0646\\u0641\\u064a\\u0630 \\u062d\\u0645\\u0644\\u0627\\u062a \\u0646\\u0638\\u0627\\u0641\\u0629 \\u0634\\u0627\\u0645\\u0644\\u0629 \\u0644\\u063a\\u0633\\u0644 \\u0627\\u0644\\u0633\\u062c\\u0627\\u062f \\u0648\\u062a\\u0646\\u0638\\u064a\\u0641 \\u062f\\u0648\\u0631\\u0627\\u062a \\u0627\\u0644\\u0645\\u064a\\u0627\\u0647 \\u0648\\u0627\\u0644\\u0645\\u0631\\u0627\\u0641\\u0642 \\u0627\\u0644\\u062e\\u062f\\u0645\\u064a\\u0629.\"},{\"title\":\"\\u062a\\u0648\\u0632\\u064a\\u0639 \\u0627\\u0644\\u0645\\u064a\\u0627\\u0647 \\u0648\\u0627\\u0644\\u0645\\u0639\\u0637\\u0631\\u0627\\u062a\",\"desc\":\"\\u062a\\u0648\\u0641\\u064a\\u0631 \\u0639\\u0628\\u0648\\u0627\\u062a \\u0627\\u0644\\u0645\\u064a\\u0627\\u0647 \\u0648\\u0645\\u0639\\u0637\\u0631\\u0627\\u062a \\u0627\\u0644\\u062c\\u0648 \\u0644\\u0644\\u0645\\u0633\\u0627\\u062c\\u062f \\u0627\\u0644\\u0645\\u0633\\u062a\\u0647\\u062f\\u0641\\u0629 \\u062e\\u0644\\u0627\\u0644 \\u0645\\u0648\\u0627\\u0633\\u0645 \\u0627\\u0644\\u0630\\u0631\\u0648\\u0629 \\u0648\\u0627\\u0644\\u0623\\u0639\\u064a\\u0627\\u062f.\"},{\"title\":\"\\u0635\\u064a\\u0627\\u0646\\u0629 \\u0648\\u062d\\u062f\\u0627\\u062a \\u0627\\u0644\\u062a\\u0643\\u064a\\u064a\\u0641\",\"desc\":\"\\u0641\\u062d\\u0635 \\u0648\\u062a\\u0646\\u0638\\u064a\\u0641 \\u0648\\u0635\\u064a\\u0627\\u0646\\u0629 \\u0648\\u062d\\u062f\\u0627\\u062a \\u0627\\u0644\\u062a\\u0643\\u064a\\u064a\\u0641 \\u0644\\u0636\\u0645\\u0627\\u0646 \\u062c\\u0627\\u0647\\u0632\\u064a\\u062a\\u0647\\u0627 \\u0642\\u0628\\u0644 \\u0645\\u0648\\u0633\\u0645 \\u0627\\u0644\\u0635\\u064a\\u0641.\"},{\"title\":\"\\u062a\\u0641\\u0639\\u064a\\u0644 \\u0627\\u0644\\u0641\\u0631\\u0642 \\u0627\\u0644\\u062a\\u0637\\u0648\\u0639\\u064a\\u0629\",\"desc\":\"\\u062a\\u062f\\u0631\\u064a\\u0628 \\u0648\\u062a\\u0634\\u063a\\u064a\\u0644 \\u0641\\u0631\\u0642 \\u062a\\u0637\\u0648\\u0639\\u064a\\u0629 \\u0645\\u064a\\u062f\\u0627\\u0646\\u064a\\u0629 \\u0628\\u062d\\u062f \\u0623\\u062f\\u0646\\u0649 50 \\u0645\\u062a\\u0637\\u0648\\u0639\\u0627\\u064b \\u062e\\u0644\\u0627\\u0644 \\u0627\\u0644\\u0639\\u0627\\u0645 \\u0627\\u0644\\u062a\\u0634\\u063a\\u064a\\u0644\\u064a.\"},{\"title\":\"\\u0645\\u062a\\u0627\\u0628\\u0639\\u0629 \\u0627\\u0644\\u0645\\u0634\\u0627\\u0631\\u064a\\u0639 \\u0627\\u0644\\u0645\\u064a\\u062f\\u0627\\u0646\\u064a\\u0629\",\"desc\":\"\\u0632\\u064a\\u0627\\u0631\\u0627\\u062a \\u0625\\u0634\\u0631\\u0627\\u0641\\u064a\\u0629 \\u062f\\u0648\\u0631\\u064a\\u0629 \\u0644\\u0645\\u0648\\u0627\\u0642\\u0639 \\u0627\\u0644\\u0645\\u0634\\u0627\\u0631\\u064a\\u0639 \\u0644\\u0636\\u0645\\u0627\\u0646 \\u062c\\u0648\\u062f\\u0629 \\u0627\\u0644\\u062a\\u0646\\u0641\\u064a\\u0630 \\u0648\\u0633\\u0631\\u0639\\u0629 \\u0627\\u0644\\u0625\\u0646\\u062c\\u0627\\u0632.\"},{\"title\":\"\\u0627\\u0644\\u062a\\u0648\\u062b\\u064a\\u0642 \\u0648\\u0627\\u0644\\u062a\\u0642\\u0627\\u0631\\u064a\\u0631\",\"desc\":\"\\u0625\\u0635\\u062f\\u0627\\u0631 \\u062a\\u0642\\u0627\\u0631\\u064a\\u0631 \\u0625\\u0646\\u062c\\u0627\\u0632 \\u0631\\u0628\\u0639 \\u0633\\u0646\\u0648\\u064a\\u0629 \\u0645\\u0648\\u062b\\u0642\\u0629 \\u0628\\u0627\\u0644\\u0635\\u0648\\u0631 \\u0648\\u0627\\u0644\\u0623\\u0631\\u0642\\u0627\\u0645 \\u0648\\u0631\\u0641\\u0639\\u0647\\u0627 \\u0644\\u0644\\u062c\\u0647\\u0627\\u062a \\u0630\\u0627\\u062a \\u0627\\u0644\\u0639\\u0644\\u0627\\u0642\\u0629.\"},{\"title\":\"\\u062e\\u062f\\u0645\\u0629 \\u0627\\u0644\\u0645\\u0633\\u062a\\u0641\\u064a\\u062f\\u064a\\u0646\",\"desc\":\"\\u0627\\u0633\\u062a\\u0642\\u0628\\u0627\\u0644 \\u0628\\u0644\\u0627\\u063a\\u0627\\u062a \\u0627\\u0644\\u0645\\u0633\\u0627\\u062c\\u062f \\u0648\\u0645\\u062a\\u0627\\u0628\\u0639\\u0629 \\u0645\\u0639\\u0627\\u0644\\u062c\\u062a\\u0647\\u0627 \\u062e\\u0644\\u0627\\u0644 \\u0645\\u062f\\u0629 \\u0632\\u0645\\u0646\\u064a\\u0629 \\u0645\\u062d\\u062f\\u062f\\u0629 \\u0648\\u0641\\u0642 \\u0622\\u0644\\u064a\\u0629 \\u062a\\u0634\\u063a\\u064a\\u0644\\u064a\\u0629 \\u0648\\u0627\\u0636\\u062d\\u0629.\"}]', '2026-10-01 18:39:21'),
(68, 'about', 'values', '[{\"title\":\"\\u0627\\u0644\\u0625\\u062e\\u0644\\u0627\\u0635\",\"desc\":\"\\u0646\\u0639\\u0645\\u0644 \\u0628\\u0642\\u0644\\u0648\\u0628 \\u0645\\u062e\\u0644\\u0635\\u0629 \\u0644\\u0648\\u062c\\u0647 \\u0627\\u0644\\u0644\\u0647 \\u062a\\u0639\\u0627\\u0644\\u0649 \\u0645\\u062a\\u0641\\u0627\\u0646\\u064a\\u0646 \\u0641\\u064a \\u062e\\u062f\\u0645\\u0629 \\u0628\\u064a\\u0648\\u062a\\u0647 \\u0648\\u0631\\u0639\\u0627\\u064a\\u062a\\u0647\\u0627.\",\"icon\":\"fa-solid fa-heart\"},{\"title\":\"\\u0627\\u0644\\u0634\\u0641\\u0627\\u0641\\u064a\\u0629\",\"desc\":\"\\u0646\\u0644\\u062a\\u0632\\u0645 \\u0628\\u0627\\u0644\\u0648\\u0636\\u0648\\u062d \\u0648\\u0627\\u0644\\u0625\\u0639\\u0644\\u0627\\u0646 \\u0627\\u0644\\u0643\\u0627\\u0645\\u0644 \\u0644\\u0643\\u0627\\u0641\\u0629 \\u0627\\u0644\\u0645\\u0645\\u0627\\u0631\\u0633\\u0627\\u062a \\u0627\\u0644\\u0645\\u0627\\u0644\\u064a\\u0629 \\u0648\\u0627\\u0644\\u062a\\u0634\\u063a\\u064a\\u0644\\u064a\\u0629.\",\"icon\":\"fa-solid fa-eye\"},{\"title\":\"\\u0627\\u0644\\u0627\\u062d\\u062a\\u0631\\u0627\\u0641\\u064a\\u0629\",\"desc\":\"\\u0646\\u0637\\u0628\\u0642 \\u0623\\u0641\\u0636\\u0644 \\u0627\\u0644\\u0645\\u0639\\u0627\\u064a\\u064a\\u0631 \\u0627\\u0644\\u0647\\u0646\\u062f\\u0633\\u064a\\u0629 \\u0648\\u0627\\u0644\\u0625\\u062f\\u0627\\u0631\\u064a\\u0629 \\u0644\\u0636\\u0645\\u0627\\u0646 \\u0643\\u0641\\u0627\\u0621\\u0629 \\u0627\\u0644\\u0628\\u0646\\u0627\\u0621 \\u0648\\u0627\\u0644\\u0635\\u064a\\u0627\\u0646\\u0629.\",\"icon\":\"fa-solid fa-award\"},{\"title\":\"\\u0627\\u0644\\u0645\\u0633\\u0624\\u0648\\u0644\\u064a\\u0629\",\"desc\":\"\\u0646\\u062a\\u062d\\u0645\\u0644 \\u0627\\u0644\\u0623\\u0645\\u0627\\u0646\\u0629 \\u0628\\u0645\\u0633\\u0624\\u0648\\u0644\\u064a\\u0629 \\u062a\\u0627\\u0645\\u0629 \\u0648\\u0645\\u062d\\u0627\\u0633\\u0628\\u064a\\u0629 \\u062a\\u062c\\u0627\\u0647 \\u0627\\u0644\\u0645\\u0633\\u0627\\u062c\\u062f \\u0648\\u0627\\u0644\\u062f\\u0627\\u0639\\u0645\\u064a\\u0646 \\u0648\\u0627\\u0644\\u0645\\u062c\\u062a\\u0645\\u0639.\",\"icon\":\"fa-solid fa-shield-halved\"},{\"title\":\"\\u0627\\u0644\\u0627\\u0633\\u062a\\u062f\\u0627\\u0645\\u0629\",\"desc\":\"\\u0646\\u0635\\u0645\\u0645 \\u0645\\u0634\\u0627\\u0631\\u064a\\u0639 \\u062a\\u0636\\u0645\\u0646 \\u0623\\u062b\\u0631\\u0627\\u064b \\u0645\\u0645\\u062a\\u062f\\u0627\\u064b \\u0648\\u062d\\u0644\\u0648\\u0644 \\u0635\\u064a\\u0627\\u0646\\u0629 \\u0645\\u0633\\u062a\\u0645\\u0631\\u0629 \\u062a\\u062d\\u0627\\u0641\\u0638 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u0623\\u0635\\u0648\\u0644.\",\"icon\":\"fa-solid fa-leaf\"}]', '2026-10-01 18:39:21'),
(69, 'about', 'cardTitle', '\"\\u062c\\u0645\\u0639\\u064a\\u0629 \\u0628\\u0646\\u064a\\u0627\\u0646 \\u0644\\u0644\\u0639\\u0646\\u0627\\u064a\\u0629 \\u0628\\u0627\\u0644\\u0645\\u0633\\u0627\\u062c\\u062f \\u0628\\u0645\\u062d\\u0627\\u0641\\u0638\\u0629 \\u0627\\u0644\\u062e\\u0628\\u0631\\u0627\\u0621\"', '2026-10-01 18:39:21'),
(70, 'about', 'licenseLabel', '\"\\u0645\\u0633\\u062c\\u0644\\u0629 \\u0645\\u0631\\u062e\\u0635\\u0629 \\u0631\\u0633\\u0645\\u064a\\u0627\\u064b \\u062a\\u062d\\u062a \\u0627\\u0644\\u0631\\u0642\\u0645:\"', '2026-10-01 18:39:21'),
(71, 'about', 'authorityText', '\"\\u0644\\u062f\\u0649 \\u0627\\u0644\\u0645\\u0631\\u0643\\u0632 \\u0627\\u0644\\u0648\\u0637\\u0646\\u064a \\u0644\\u062a\\u0646\\u0645\\u064a\\u0629 \\u0627\\u0644\\u0642\\u0637\\u0627\\u0639 \\u063a\\u064a\\u0631 \\u0627\\u0644\\u0631\\u0628\\u062d\\u064a\"', '2026-10-01 18:39:21'),
(72, 'about', 'badgeText', '\"\\u062c\\u0647\\u0629 \\u062e\\u064a\\u0631\\u064a\\u0629 \\u0645\\u0639\\u062a\\u0645\\u062f\\u0629 \\u0648\\u0645\\u0648\\u062b\\u0648\\u0642\\u0629\"', '2026-10-01 18:39:21'),
(73, 'projects', 'title', '\"\\u0627\\u0644\\u0645\\u0634\\u0627\\u0631\\u064a\\u0639\"', '2026-10-01 18:39:22'),
(74, 'projects', 'subtitle', '\"\\u062a\\u0635\\u0641\\u062d \\u0645\\u0634\\u0627\\u0631\\u064a\\u0639 \\u0635\\u064a\\u0627\\u0646\\u0629 \\u0648\\u062a\\u0631\\u0645\\u064a\\u0645 \\u0627\\u0644\\u0645\\u0633\\u0627\\u062c\\u062f\"', '2026-10-01 18:39:22'),
(75, 'projects', 'collectedLabel', '\"\\u0627\\u0644\\u0645\\u064a\\u0632\\u0627\\u0646\\u064a\\u0629 \\u0627\\u0644\\u062a\\u0642\\u062f\\u064a\\u0631\\u064a\\u0629\"', '2026-10-01 18:39:22'),
(76, 'projects', 'remainingLabel', '\"\\u0646\\u0633\\u0628\\u0629 \\u0627\\u0644\\u0625\\u0646\\u062c\\u0627\\u0632\"', '2026-10-01 18:39:22'),
(77, 'projects', 'donateCardTitle', '\"\\u0633\\u0627\\u0647\\u0645 \\u0627\\u0644\\u0622\\u0646\"', '2026-10-01 18:39:22'),
(78, 'projects', 'donateCardDesc', '\"\\u0627\\u0633\\u062a\\u0639\\u0631\\u0636 \\u062c\\u0645\\u064a\\u0639 \\u0645\\u0634\\u0627\\u0631\\u064a\\u0639 \\u0627\\u0644\\u062c\\u0645\\u0639\\u064a\\u0629 \\u0627\\u0644\\u062c\\u0627\\u0631\\u064a\\u0629 \\u0648\\u0627\\u062e\\u062a\\u0631 \\u0645\\u0627 \\u064a\\u0646\\u0627\\u0633\\u0628\\u0643 \\u0644\\u0644\\u0645\\u0633\\u0627\\u0647\\u0645\\u0629 \\u0641\\u064a \\u0635\\u0646\\u0627\\u0639\\u0629 \\u0623\\u062b\\u0631 \\u0628\\u0627\\u0642\\u064d.\"', '2026-10-01 18:39:22'),
(79, 'projects', 'securityNote', '\"\\u062a\\u0628\\u0631\\u0639 \\u0622\\u0645\\u0646 \\u0648\\u0645\\u0636\\u0645\\u0648\\u0646 \\u0661\\u0660\\u0660\\u066a\"', '2026-10-01 18:39:22'),
(80, 'projects', 'licenseNote', '\"\\u062c\\u0645\\u0639\\u064a\\u0629 \\u0645\\u0631\\u062e\\u0635\\u0629 \\u0631\\u0633\\u0645\\u064a\\u0627\\u064b\"', '2026-10-01 18:39:22'),
(81, 'news', 'title', '\"\\u0627\\u0644\\u0645\\u0631\\u0643\\u0632 \\u0627\\u0644\\u0625\\u0639\\u0644\\u0627\\u0645\\u064a\"', '2026-10-01 18:39:22'),
(82, 'news', 'subtitle', '\"\\u062a\\u0627\\u0628\\u0639 \\u0622\\u062e\\u0631 \\u0623\\u062e\\u0628\\u0627\\u0631 \\u0627\\u0644\\u062c\\u0645\\u0639\\u064a\\u0629\\u060c \\u062a\\u0642\\u0627\\u0631\\u064a\\u0631 \\u0635\\u064a\\u0627\\u0646\\u0629 \\u0627\\u0644\\u0645\\u0633\\u0627\\u062c\\u062f\\u060c \\u0648\\u0627\\u0644\\u062a\\u063a\\u0637\\u064a\\u0627\\u062a \\u0627\\u0644\\u0635\\u062d\\u0641\\u064a\\u0629 \\u0627\\u0644\\u0645\\u064a\\u062f\\u0627\\u0646\\u064a\\u0629 \\u0628\\u0627\\u0644\\u062e\\u0628\\u0631\\u0627\\u0621\"', '2026-10-01 18:39:22'),
(83, 'news', 'featuredBadge', '\"\\u0627\\u0644\\u062e\\u0628\\u0631 \\u0627\\u0644\\u0623\\u0628\\u0631\\u0632\"', '2026-10-01 18:39:23'),
(84, 'news', 'reportsTitle', '\"\\u0627\\u0644\\u062a\\u0642\\u0627\\u0631\\u064a\\u0631 \\u0648\\u0623\\u0639\\u0645\\u0627\\u0644 \\u0627\\u0644\\u0635\\u064a\\u0627\\u0646\\u0629\"', '2026-10-01 18:39:23'),
(85, 'news', 'pressTitle', '\"\\u0627\\u0644\\u0635\\u062f\\u0649 \\u0627\\u0644\\u0625\\u0639\\u0644\\u0627\\u0645\\u064a \\u0648\\u0627\\u0644\\u0635\\u062d\\u0641\\u064a\"', '2026-10-01 18:39:23'),
(86, 'board', 'title', '\"\\u0645\\u062c\\u0644\\u0633 \\u0627\\u0644\\u0625\\u062f\\u0627\\u0631\\u0629\"', '2026-10-01 18:39:23'),
(87, 'board', 'subtitle', '\"\\u0623\\u0639\\u0636\\u0627\\u0621 \\u0645\\u062c\\u0644\\u0633 \\u0625\\u062f\\u0627\\u0631\\u0629 \\u0627\\u0644\\u062c\\u0645\\u0639\\u064a\\u0629 \\u0648\\u0627\\u0644\\u0642\\u064a\\u0627\\u062f\\u0629 \\u0627\\u0644\\u0625\\u062f\\u0627\\u0631\\u064a\\u0629 \\u0627\\u0644\\u0645\\u0633\\u0624\\u0648\\u0644\\u0629 \\u0639\\u0646 \\u0631\\u0639\\u0627\\u064a\\u0629 \\u0648\\u0635\\u064a\\u0627\\u0646\\u0629 \\u0628\\u064a\\u0648\\u062a \\u0627\\u0644\\u0644\\u0647\"', '2026-10-01 18:39:23'),
(88, 'board', 'chip1', '\"\\u0645\\u0639\\u062a\\u0645\\u062f \\u0631\\u0633\\u0645\\u064a\\u0627\\u064b\"', '2026-10-01 18:39:23'),
(89, 'board', 'chip2', '\"\\u0631\\u0642\\u0627\\u0628\\u0629 \\u0648\\u062d\\u0648\\u0643\\u0645\\u0629\"', '2026-10-01 18:39:23'),
(90, 'board', 'chip3', '\"\\u0625\\u062f\\u0627\\u0631\\u0629 \\u062a\\u0637\\u0648\\u0639\\u064a\\u0629\"', '2026-10-01 18:39:23'),
(91, 'board', 'introText', '\"\\u064a\\u0642\\u0648\\u062f \\u0627\\u0644\\u062c\\u0645\\u0639\\u064a\\u0629 \\u0646\\u062e\\u0628\\u0629 \\u0645\\u0646 \\u0623\\u0628\\u0646\\u0627\\u0621 \\u0645\\u062d\\u0627\\u0641\\u0638\\u0629 \\u0627\\u0644\\u062e\\u0628\\u0631\\u0627\\u0621 \\u0627\\u0644\\u0645\\u062a\\u0645\\u064a\\u0632\\u064a\\u0646\\u060c \\u0648\\u0627\\u0636\\u0639\\u064a\\u0646 \\u0646\\u0635\\u0628 \\u0623\\u0639\\u064a\\u0646\\u0647\\u0645 \\u062e\\u062f\\u0645\\u0629 \\u0628\\u064a\\u0648\\u062a \\u0627\\u0644\\u0644\\u0647 \\u0648\\u0641\\u0642 \\u062a\\u0637\\u0644\\u0639\\u0627\\u062a \\u0631\\u0624\\u064a\\u0629 \\u0627\\u0644\\u0645\\u0645\\u0644\\u0643\\u0629 \\u0641\\u064a \\u062a\\u0639\\u0632\\u064a\\u0632 \\u062d\\u0648\\u0643\\u0645\\u0629 \\u0648\\u0646\\u0645\\u0648 \\u0627\\u0644\\u0642\\u0637\\u0627\\u0639 \\u063a\\u064a\\u0631 \\u0627\\u0644\\u0631\\u0628\\u062d\\u064a \\u0628\\u0623\\u0639\\u0644\\u0649 \\u0643\\u0641\\u0627\\u0621\\u0629 \\u0648\\u0623\\u0645\\u0627\\u0646\\u0629.\"', '2026-10-01 18:39:23'),
(92, 'board', 'roleTitlePresident', '\"\\u0631\\u0626\\u064a\\u0633 \\u0645\\u062c\\u0644\\u0633 \\u0627\\u0644\\u0625\\u062f\\u0627\\u0631\\u0629\"', '2026-10-01 18:39:23'),
(93, 'board', 'roleTitleVice', '\"\\u0646\\u0627\\u0626\\u0628 \\u0631\\u0626\\u064a\\u0633 \\u0645\\u062c\\u0644\\u0633 \\u0627\\u0644\\u0625\\u062f\\u0627\\u0631\\u0629\"', '2026-10-01 18:39:23'),
(94, 'board', 'roleTitleMember', '\"\\u0639\\u0636\\u0648 \\u0645\\u062c\\u0644\\u0633 \\u0627\\u0644\\u0625\\u062f\\u0627\\u0631\\u0629\"', '2026-10-01 18:39:23'),
(95, 'governance', 'eyebrow', '\"\\u062c\\u0645\\u0639\\u064a\\u0629 \\u0628\\u0646\\u064a\\u0627\\u0646 \\u00b7 \\u0627\\u0644\\u062e\\u0628\\u0631\\u0627\\u0621\"', '2026-10-01 18:39:24'),
(96, 'governance', 'title', '\"\\u0627\\u0644\\u062d\\u0648\\u0643\\u0645\\u0629 \\u0648\\u0627\\u0644\\u0634\\u0641\\u0627\\u0641\\u064a\\u0629\"', '2026-10-01 18:39:24'),
(97, 'governance', 'subtitle', '\"\\u0646\\u0644\\u062a\\u0632\\u0645 \\u0628\\u0623\\u0639\\u0644\\u0649 \\u0645\\u0639\\u0627\\u064a\\u064a\\u0631 \\u0627\\u0644\\u0634\\u0641\\u0627\\u0641\\u064a\\u0629 \\u0648\\u0627\\u0644\\u0645\\u0633\\u0627\\u0621\\u0644\\u0629 \\u0627\\u0644\\u0625\\u062f\\u0627\\u0631\\u064a\\u0629 \\u0648\\u0627\\u0644\\u0645\\u0627\\u0644\\u064a\\u0629 \\u0641\\u064a \\u0631\\u0639\\u0627\\u064a\\u0629 \\u0628\\u064a\\u0648\\u062a \\u0627\\u0644\\u0644\\u0647\"', '2026-10-01 18:39:24'),
(98, 'governance', 'chip1', '\"\\u0645\\u0639\\u0627\\u064a\\u064a\\u0631 \\u062d\\u0648\\u0643\\u0645\\u0629\"', '2026-10-01 18:39:24'),
(99, 'governance', 'chip2', '\"\\u0634\\u0641\\u0627\\u0641\\u064a\\u0629 \\u0645\\u0627\\u0644\\u064a\\u0629\"', '2026-10-01 18:39:24'),
(100, 'governance', 'chip3', '\"\\u0648\\u062b\\u0627\\u0626\\u0642 \\u0645\\u0639\\u062a\\u0645\\u062f\\u0629\"', '2026-10-01 18:39:24'),
(101, 'governance', 'principles', '[{\"icon\":\"check-square\",\"title\":\"\\u0627\\u0644\\u0645\\u0633\\u0627\\u0621\\u0644\\u0629\",\"desc\":\"\\u0646\\u062e\\u0636\\u0639 \\u0644\\u0631\\u0642\\u0627\\u0628\\u0629 \\u0645\\u0624\\u0633\\u0633\\u064a\\u0629 \\u062f\\u0648\\u0631\\u064a\\u0629 \\u0648\\u0646\\u0646\\u0634\\u0631 \\u062a\\u0642\\u0627\\u0631\\u064a\\u0631\\u0646\\u0627 \\u0627\\u0644\\u0645\\u0627\\u0644\\u064a\\u0629 \\u0648\\u0645\\u062d\\u0627\\u0636\\u0631 \\u0627\\u062c\\u062a\\u0645\\u0627\\u0639\\u0627\\u062a\\u0646\\u0627 \\u0628\\u0634\\u0643\\u0644 \\u0645\\u0646\\u062a\\u0638\\u0645.\"},{\"icon\":\"shield\",\"title\":\"\\u0627\\u0644\\u0627\\u0645\\u062a\\u062b\\u0627\\u0644\",\"desc\":\"\\u0646\\u0644\\u062a\\u0632\\u0645 \\u0628\\u0644\\u0648\\u0627\\u0626\\u062d \\u0627\\u0644\\u0645\\u0631\\u0643\\u0632 \\u0627\\u0644\\u0648\\u0637\\u0646\\u064a \\u0644\\u062a\\u0646\\u0645\\u064a\\u0629 \\u0627\\u0644\\u0642\\u0637\\u0627\\u0639 \\u063a\\u064a\\u0631 \\u0627\\u0644\\u0631\\u0628\\u062d\\u064a \\u0648\\u0645\\u062a\\u0637\\u0644\\u0628\\u0627\\u062a \\u0627\\u0644\\u062a\\u0631\\u062e\\u064a\\u0635 \\u0627\\u0644\\u0631\\u0633\\u0645\\u064a.\"},{\"icon\":\"users\",\"title\":\"\\u0627\\u0644\\u062b\\u0642\\u0629\",\"desc\":\"\\u0646\\u0628\\u0646\\u064a \\u0639\\u0644\\u0627\\u0642\\u0629 \\u0634\\u0641\\u0627\\u0641\\u0629 \\u0648\\u0645\\u0633\\u062a\\u062f\\u0627\\u0645\\u0629 \\u0645\\u0639 \\u0627\\u0644\\u0645\\u062c\\u062a\\u0645\\u0639 \\u0648\\u0627\\u0644\\u0645\\u0627\\u0646\\u062d\\u064a\\u0646 \\u0645\\u0646 \\u062e\\u0644\\u0627\\u0644 \\u0627\\u0644\\u0625\\u0641\\u0635\\u0627\\u062d \\u0648\\u0646\\u0634\\u0631 \\u0627\\u0644\\u0648\\u062b\\u0627\\u0626\\u0642 \\u0627\\u0644\\u0631\\u0633\\u0645\\u064a\\u0629.\"}]', '2026-10-01 18:39:25'),
(102, 'governance', 'cat1Title', '\"\\u0627\\u0644\\u0648\\u062b\\u0627\\u0626\\u0642 \\u0627\\u0644\\u0631\\u0633\\u0645\\u064a\\u0629\"', '2026-10-01 18:39:25'),
(103, 'governance', 'cat1Desc', '\"\\u0634\\u0647\\u0627\\u062f\\u0627\\u062a \\u0627\\u0644\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0648\\u0627\\u0644\\u062a\\u0631\\u0627\\u062e\\u064a\\u0635 \\u0627\\u0644\\u0645\\u0639\\u062a\\u0645\\u062f\\u0629\"', '2026-10-01 18:39:25'),
(104, 'governance', 'cat2Title', '\"\\u0627\\u0644\\u062e\\u0637\\u0637 \\u0627\\u0644\\u062a\\u0646\\u0645\\u0648\\u064a\\u0629\"', '2026-10-01 18:39:25'),
(105, 'governance', 'cat2Desc', '\"\\u0627\\u0644\\u062e\\u0637\\u0629 \\u0627\\u0644\\u0627\\u0633\\u062a\\u0631\\u0627\\u062a\\u064a\\u062c\\u064a\\u0629 \\u0648\\u0627\\u0644\\u062a\\u0634\\u063a\\u064a\\u0644\\u064a\\u0629 \\u0644\\u0644\\u062c\\u0645\\u0639\\u064a\\u0629\"', '2026-10-01 18:39:25'),
(106, 'governance', 'cat3Title', '\"\\u0627\\u0644\\u0634\\u0641\\u0627\\u0641\\u064a\\u0629 \\u0648\\u0627\\u0644\\u0645\\u0633\\u0627\\u0621\\u0644\\u0629\"', '2026-10-01 18:39:25'),
(107, 'governance', 'cat3Desc', '\"\\u0627\\u0644\\u062a\\u0642\\u0627\\u0631\\u064a\\u0631 \\u0627\\u0644\\u0645\\u0627\\u0644\\u064a\\u0629 \\u0648\\u0627\\u0644\\u0633\\u064a\\u0627\\u0633\\u0627\\u062a \\u0648\\u0627\\u0644\\u0645\\u062d\\u0627\\u0636\\u0631\"', '2026-10-01 18:39:25'),
(108, 'volunteer', 'eyebrow', '\"\\u0627\\u0644\\u0645\\u0646\\u0635\\u0629 \\u0627\\u0644\\u0648\\u0637\\u0646\\u064a\\u0629 \\u0644\\u0644\\u0639\\u0645\\u0644 \\u0627\\u0644\\u062a\\u0637\\u0648\\u0639\\u064a\"', '2026-10-01 18:39:26'),
(109, 'volunteer', 'title', '\"\\u0633\\u062c\\u0651\\u0644 \\u062a\\u0637\\u0648\\u0639\\u0643 \\u0639\\u0628\\u0631 \\u0627\\u0644\\u0645\\u0646\\u0635\\u0629 \\u0627\\u0644\\u0631\\u0633\\u0645\\u064a\\u0629\"', '2026-10-01 18:39:26'),
(110, 'volunteer', 'desc', '\"\\u062c\\u0645\\u064a\\u0639 \\u0641\\u0631\\u0635 \\u0627\\u0644\\u062a\\u0637\\u0648\\u0639 \\u0645\\u0639 \\u062c\\u0645\\u0639\\u064a\\u0629 \\u0628\\u0646\\u064a\\u0627\\u0646 \\u062a\\u064f\\u062f\\u0627\\u0631 \\u0639\\u0628\\u0631 \\u0627\\u0644\\u0645\\u0646\\u0635\\u0629 \\u0627\\u0644\\u0648\\u0637\\u0646\\u064a\\u0629 \\u0644\\u0644\\u0639\\u0645\\u0644 \\u0627\\u0644\\u062a\\u0637\\u0648\\u0639\\u064a. \\u0627\\u0636\\u063a\\u0637 \\u0623\\u062f\\u0646\\u0627\\u0647 \\u0644\\u0644\\u0627\\u0646\\u062a\\u0642\\u0627\\u0644 \\u0648\\u0627\\u0644\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0645\\u0628\\u0627\\u0634\\u0631\\u0629.\"', '2026-10-01 18:39:27'),
(111, 'volunteer', 'chip1', '\"\\u0641\\u0631\\u0635 \\u0645\\u064a\\u062f\\u0627\\u0646\\u064a\\u0629\"', '2026-10-01 18:39:25'),
(112, 'volunteer', 'chip2', '\"\\u0628\\u0631\\u0627\\u0645\\u062c \\u0645\\u0646\\u0638\\u0645\\u0629\"', '2026-10-01 18:39:25'),
(113, 'volunteer', 'chip3', '\"\\u062e\\u062f\\u0645\\u0629 \\u0627\\u0644\\u0645\\u062c\\u062a\\u0645\\u0639\"', '2026-10-01 18:39:25'),
(114, 'volunteer', 'btnText', '\"\\u0627\\u0644\\u0627\\u0646\\u062a\\u0642\\u0627\\u0644 \\u0625\\u0644\\u0649 \\u0645\\u0646\\u0635\\u0629 \\u0627\\u0644\\u062a\\u0637\\u0648\\u0639\"', '2026-10-01 18:39:27'),
(115, 'volunteer', 'subtitle', '\"\\u0641\\u0631\\u0635 \\u0645\\u062a\\u0646\\u0648\\u0639\\u0629 \\u062a\\u0646\\u0627\\u0633\\u0628 \\u0645\\u062e\\u062a\\u0644\\u0641 \\u0627\\u0644\\u0645\\u0647\\u0627\\u0631\\u0627\\u062a \\u0648\\u0627\\u0644\\u0623\\u0648\\u0642\\u0627\\u062a \\u0627\\u0644\\u0645\\u062a\\u0627\\u062d\\u0629.\"', '2026-10-01 18:39:26'),
(116, 'volunteer', 'tag', '\"\\u0643\\u064a\\u0641 \\u062a\\u0646\\u0636\\u0645\\u061f\"', '2026-10-01 18:39:26'),
(117, 'volunteer', 'items', '[{\"icon\":\"layout\",\"title\":\"\\u0635\\u064a\\u0627\\u0646\\u0629 \\u0648\\u062a\\u0623\\u0647\\u064a\\u0644 \\u0627\\u0644\\u0645\\u0633\\u0627\\u062c\\u062f\",\"desc\":\"\\u0627\\u0644\\u0645\\u0634\\u0627\\u0631\\u0643\\u0629 \\u0641\\u064a \\u0623\\u0639\\u0645\\u0627\\u0644 \\u0627\\u0644\\u0635\\u064a\\u0627\\u0646\\u0629 \\u0627\\u0644\\u0628\\u0633\\u064a\\u0637\\u0629\\u060c \\u0627\\u0644\\u062f\\u0647\\u0627\\u0646\\u060c \\u0648\\u062a\\u0631\\u0645\\u064a\\u0645 \\u0627\\u0644\\u0645\\u0631\\u0627\\u0641\\u0642 \\u062f\\u0627\\u062e\\u0644 \\u0627\\u0644\\u0645\\u0633\\u0627\\u062c\\u062f.\"},{\"icon\":\"droplet\",\"title\":\"\\u0646\\u0638\\u0627\\u0641\\u0629 \\u0648\\u062e\\u062f\\u0645\\u0627\\u062a \\u0645\\u064a\\u062f\\u0627\\u0646\\u064a\\u0629\",\"desc\":\"\\u062d\\u0645\\u0644\\u0627\\u062a \\u062a\\u0646\\u0638\\u064a\\u0641 \\u062f\\u0648\\u0631\\u0627\\u062a \\u0627\\u0644\\u0645\\u064a\\u0627\\u0647\\u060c \\u063a\\u0633\\u0644 \\u0627\\u0644\\u0633\\u062c\\u0627\\u062f\\u060c \\u0648\\u062a\\u062c\\u0647\\u064a\\u0632 \\u0627\\u0644\\u0645\\u0633\\u0627\\u062c\\u062f \\u0642\\u0628\\u0644 \\u0627\\u0644\\u0635\\u0644\\u0627\\u0629.\"},{\"icon\":\"users\",\"title\":\"\\u062d\\u0645\\u0644\\u0627\\u062a \\u062a\\u0637\\u0648\\u0639\\u064a\\u0629 \\u062c\\u0645\\u0627\\u0639\\u064a\\u0629\",\"desc\":\"\\u0627\\u0644\\u0645\\u0634\\u0627\\u0631\\u0643\\u0629 \\u0641\\u064a \\u0627\\u0644\\u0641\\u0631\\u0642 \\u0627\\u0644\\u0645\\u064a\\u062f\\u0627\\u0646\\u064a\\u0629 \\u062e\\u0644\\u0627\\u0644 \\u0627\\u0644\\u062d\\u0645\\u0644\\u0627\\u062a \\u0627\\u0644\\u0645\\u0648\\u0633\\u0645\\u064a\\u0629 \\u0648\\u0627\\u0644\\u0628\\u0631\\u0627\\u0645\\u062c \\u0627\\u0644\\u062e\\u0627\\u0635\\u0629.\"},{\"icon\":\"briefcase\",\"title\":\"\\u062f\\u0639\\u0645 \\u0625\\u062f\\u0627\\u0631\\u064a \\u0648\\u062a\\u0646\\u0638\\u064a\\u0645\\u064a\",\"desc\":\"\\u0627\\u0644\\u0645\\u0633\\u0627\\u0647\\u0645\\u0629 \\u0641\\u064a \\u0627\\u0644\\u062a\\u0646\\u0633\\u064a\\u0642\\u060c \\u0627\\u0644\\u062a\\u0648\\u062b\\u064a\\u0642\\u060c \\u0648\\u0625\\u062f\\u0627\\u0631\\u0629 \\u0627\\u0644\\u0641\\u0631\\u0635 \\u0627\\u0644\\u062a\\u0637\\u0648\\u0639\\u064a\\u0629 \\u062f\\u0627\\u062e\\u0644 \\u0627\\u0644\\u062c\\u0645\\u0639\\u064a\\u0629.\"}]', '2026-10-01 18:39:26'),
(118, 'volunteer', 'steps', '[{\"title\":\"\\u0627\\u062f\\u062e\\u0644 \\u0627\\u0644\\u0645\\u0646\\u0635\\u0629\",\"desc\":\"\\u0627\\u0646\\u062a\\u0642\\u0644 \\u0625\\u0644\\u0649 \\u0627\\u0644\\u0645\\u0646\\u0635\\u0629 \\u0627\\u0644\\u0648\\u0637\\u0646\\u064a\\u0629 \\u0644\\u0644\\u0639\\u0645\\u0644 \\u0627\\u0644\\u062a\\u0637\\u0648\\u0639\\u064a \\u0639\\u0628\\u0631 \\u0627\\u0644\\u0632\\u0631 \\u0623\\u062f\\u0646\\u0627\\u0647.\"},{\"title\":\"\\u0633\\u062c\\u0651\\u0644 \\u0623\\u0648 \\u0633\\u062c\\u0651\\u0644 \\u062f\\u062e\\u0648\\u0644\\u0643\",\"desc\":\"\\u0623\\u0646\\u0634\\u0626 \\u062d\\u0633\\u0627\\u0628\\u0627\\u064b \\u0623\\u0648 \\u0633\\u062c\\u0651\\u0644 \\u062f\\u062e\\u0648\\u0644\\u0643 \\u0641\\u064a \\u0627\\u0644\\u0645\\u0646\\u0635\\u0629 \\u0627\\u0644\\u0631\\u0633\\u0645\\u064a\\u0629.\"},{\"title\":\"\\u0627\\u0646\\u0636\\u0645 \\u0644\\u0641\\u0631\\u0635 \\u0628\\u0646\\u064a\\u0627\\u0646\",\"desc\":\"\\u0627\\u0628\\u062d\\u062b \\u0639\\u0646 \\u0641\\u0631\\u0635 \\u062c\\u0645\\u0639\\u064a\\u0629 \\u0628\\u0646\\u064a\\u0627\\u0646 \\u0648\\u0642\\u062f\\u0651\\u0645 \\u0637\\u0644\\u0628 \\u0627\\u0644\\u062a\\u0637\\u0648\\u0639 \\u0645\\u0628\\u0627\\u0634\\u0631\\u0629.\"}]', '2026-10-01 18:39:26'),
(119, 'donate', 'badge', '\"\\u0628\\u0648\\u0627\\u0628\\u0629 \\u0627\\u0644\\u0639\\u0646\\u0627\\u064a\\u0629 \\u0628\\u0628\\u064a\\u0648\\u062a \\u0627\\u0644\\u0644\\u0647\"', '2026-10-01 18:39:27'),
(120, 'donate', 'title', '\"\\u0634\\u0643\\u0631 \\u0627\\u0644\\u0644\\u0647 \\u0644\\u0643\\u0645 \\u0648\\u0633\\u0639\\u0643\\u0645 \\u0648\\u062c\\u0639\\u0644\\u0647 \\u0641\\u064a \\u0645\\u064a\\u0632\\u0627\\u0646 \\u062d\\u0633\\u0646\\u0627\\u062a\\u0643\\u0645\"', '2026-10-01 20:46:37'),
(121, 'donate', 'desc', '\"\\u062a\\u0645 \\u0627\\u0633\\u062a\\u0644\\u0627\\u0645 \\u0646\\u064a\\u062a\\u0643\\u0645 \\u0644\\u0644\\u062a\\u0628\\u0631\\u0639 \\u0628\\u0646\\u062c\\u0627\\u062d. \\u064a\\u0631\\u062c\\u0649 \\u0625\\u062a\\u0645\\u0627\\u0645 \\u0627\\u0644\\u062a\\u062d\\u0648\\u064a\\u0644 \\u0627\\u0644\\u0628\\u0646\\u0643\\u064a \\u0644\\u0644\\u0645\\u0628\\u0644\\u063a \\u0627\\u0644\\u0645\\u062d\\u062f\\u062f \\u0625\\u0644\\u0649 \\u062d\\u0633\\u0627\\u0628 \\u0627\\u0644\\u062c\\u0645\\u0639\\u064a\\u0629 \\u0627\\u0644\\u0631\\u0633\\u0645\\u064a \\u0623\\u062f\\u0646\\u0627\\u0647 \\u0644\\u0625\\u0646\\u0647\\u0627\\u0621 \\u0627\\u0644\\u0645\\u0633\\u0627\\u0647\\u0645\\u0629 \\u0648\\u062a\\u0623\\u0647\\u064a\\u0644 \\u0628\\u064a\\u0648\\u062a \\u0627\\u0644\\u0644\\u0647.\"', '2026-10-01 18:39:28'),
(122, 'donate', 'floatingBadge1', '\"\\u062a\\u0628\\u0631\\u0639 \\u0622\\u0645\\u0646 \\u0648\\u0645\\u0636\\u0645\\u0648\\u0646 \\u0661\\u0660\\u0660\\u066a\"', '2026-10-01 18:39:27'),
(123, 'donate', 'floatingBadge2', '\"\\u062c\\u0645\\u0639\\u064a\\u0629 \\u0645\\u0631\\u062e\\u0635\\u0629 \\u0631\\u0633\\u0645\\u064a\\u0627\\u064b\"', '2026-10-01 18:39:27'),
(124, 'donate', 'eyebrow', '\"\\u0631\\u062d\\u0644\\u0629 \\u0645\\u0633\\u0627\\u0647\\u0645\\u062a\\u0643\"', '2026-10-01 18:39:27'),
(125, 'donate', 'subtitle', '\"n\\u062a\\u0627\\u0628\\u0639 \\u0645\\u0633\\u0627\\u0631 \\u0643\\u0644 \\u0631\\u064a\\u0627\\u0644 \\u0644\\u0636\\u0645\\u0627\\u0646 \\u0627\\u0633\\u062a\\u062b\\u0645\\u0627\\u0631\\u0647 \\u0641\\u064a \\u0631\\u0639\\u0627\\u064a\\u0629 \\u0627\\u0644\\u0645\\u0633\\u0627\\u062c\\u062f \\u0648\\u0636\\u0645\\u0627\\u0646 \\u0631\\u0627\\u062d\\u0629 \\u0627\\u0644\\u0645\\u0635\\u0644\\u064a\\u0646.\"', '2026-10-01 18:39:27');
INSERT INTO `site_contents` (`id`, `page`, `key`, `value`, `updated_at`) VALUES
(126, 'donate', 'steps', '[{\"title\":\"\\u062a\\u0642\\u062f\\u064a\\u0645 \\u0627\\u0644\\u062a\\u0628\\u0631\\u0639\",\"desc\":\"\\u062a\\u0635\\u0644 \\u0645\\u0633\\u0627\\u0647\\u0645\\u062a\\u0643 \\u0628\\u0634\\u0643\\u0644 \\u0631\\u0633\\u0645\\u064a \\u0648\\u0645\\u0642\\u064a\\u062f \\u0644\\u0635\\u0627\\u0644\\u062d \\u0627\\u0644\\u0645\\u0634\\u0631\\u0648\\u0639 \\u0627\\u0644\\u0645\\u062e\\u062a\\u0627\\u0631.\"},{\"title\":\"\\u062a\\u062e\\u0635\\u064a\\u0635 \\u0627\\u0644\\u0645\\u0648\\u0627\\u0631\\u062f\",\"desc\":\"\\u064a\\u062a\\u0645 \\u062a\\u0648\\u062c\\u064a\\u0647 \\u0641\\u0631\\u0642 \\u0627\\u0644\\u0635\\u064a\\u0627\\u0646\\u0629 \\u0627\\u0644\\u0645\\u062a\\u062e\\u0635\\u0635\\u0629 \\u0623\\u0648 \\u062a\\u0648\\u0641\\u064a\\u0631 \\u0627\\u0644\\u0645\\u0646\\u0638\\u0641\\u0627\\u062a \\u0648\\u0627\\u0644\\u0645\\u0639\\u062f\\u0627\\u062a \\u0641\\u0648\\u0631\\u0627\\u064b.\"},{\"title\":\"\\u0631\\u0639\\u0627\\u064a\\u0629 \\u0628\\u064a\\u0648\\u062a \\u0627\\u0644\\u0644\\u0647\",\"desc\":\"\\u062a\\u0646\\u0641\\u064a\\u0630 \\u0623\\u0639\\u0645\\u0627\\u0644 \\u0627\\u0644\\u0635\\u064a\\u0627\\u0646\\u0629\\u060c \\u0627\\u0644\\u062a\\u0639\\u0642\\u064a\\u0645\\u060c \\u0623\\u0648 \\u0627\\u0644\\u0633\\u0642\\u064a\\u0627 \\u0628\\u0623\\u0639\\u0644\\u0649 \\u0645\\u0642\\u0627\\u064a\\u064a\\u0633 \\u0627\\u0644\\u062c\\u0648\\u062f\\u0629.\"},{\"title\":\"\\u0631\\u0627\\u062d\\u0629 \\u0627\\u0644\\u0645\\u0635\\u0644\\u064a\\u0646\",\"desc\":\"\\u064a\\u0624\\u062f\\u064a \\u0636\\u064a\\u0648\\u0641 \\u0627\\u0644\\u0631\\u062d\\u0645\\u0646 \\u0639\\u0628\\u0627\\u062f\\u0627\\u062a\\u0647\\u0645 \\u0628\\u062e\\u0634\\u0648\\u0639 \\u0648\\u0637\\u0645\\u0623\\u0646\\u064a\\u0646\\u0629 \\u0648\\u064a\\u0633\\u0631.\"},{\"title\":\"\\u0627\\u0644\\u0623\\u062c\\u0631 \\u0627\\u0644\\u0645\\u0633\\u062a\\u0645\\u0631\",\"desc\":\"\\u062a\\u0643\\u062a\\u0628 \\u0644\\u0643 \\u0635\\u062f\\u0642\\u0629 \\u062c\\u0627\\u0631\\u064a\\u0629 \\u0645\\u0633\\u062a\\u0645\\u0631\\u0629 \\u0645\\u0639 \\u0643\\u0644 \\u0631\\u0627\\u0643\\u0639 \\u0648\\u0633\\u0627\\u062c\\u062f \\u0648\\u0639\\u0627\\u0628\\u0631 \\u0633\\u0628\\u064a\\u0644.\"}]', '2026-10-01 18:39:27'),
(127, 'donate', 'btnText', '\"\\u0627\\u0628\\u062f\\u0623 \\u0645\\u0633\\u0627\\u0647\\u0645\\u062a\\u0643 \\u0627\\u0644\\u0622\\u0646\"', '2026-10-01 18:39:27'),
(128, 'donate', 'btnResetText', '\"\\u062a\\u0628\\u0631\\u0639 \\u062c\\u062f\\u064a\\u062f\"', '2026-10-01 18:39:28'),
(129, 'contact', 'title', '\"\\u0627\\u0644\\u0623\\u0633\\u0626\\u0644\\u0629 \\u0627\\u0644\\u0634\\u0627\\u0626\\u0639\\u0629 \\u0648\\u0627\\u0644\\u0625\\u062c\\u0627\\u0628\\u0627\\u062a \\u0627\\u0644\\u0633\\u0631\\u064a\\u0639\\u0629\"', '2026-10-01 18:39:28'),
(130, 'contact', 'subtitle', '\"\\u0646\\u0633\\u0639\\u062f \\u0628\\u062a\\u0648\\u0627\\u0635\\u0644\\u0643\\u0645 \\u0648\\u0627\\u0633\\u062a\\u0641\\u0633\\u0627\\u0631\\u0627\\u062a\\u0643\\u0645\\u060c \\u0648\\u0646\\u062c\\u064a\\u0628 \\u0639\\u0646 \\u0643\\u0627\\u0641\\u0629 \\u0627\\u0644\\u0623\\u0633\\u0626\\u0644\\u0629 \\u0627\\u0644\\u0645\\u062a\\u0639\\u0644\\u0642\\u0629 \\u0628\\u0628\\u0631\\u0627\\u0645\\u062c \\u0631\\u0639\\u0627\\u064a\\u0629 \\u0648\\u0635\\u064a\\u0627\\u0646\\u0629 \\u0628\\u064a\\u0648\\u062a \\u0627\\u0644\\u0644\\u0647\"', '2026-10-01 18:39:28'),
(131, 'contact', 'chip1', '\"\\u0633\\u0631\\u0639\\u0629 \\u0627\\u0644\\u0631\\u062f\"', '2026-10-01 18:39:28'),
(132, 'contact', 'chip2', '\"\\u0645\\u062a\\u0627\\u062d\\u0648\\u0646 \\u0644\\u062e\\u062f\\u0645\\u062a\\u0643\\u0645\"', '2026-10-01 18:39:28'),
(133, 'contact', 'chip3', '\"\\u062f\\u0639\\u0645 \\u0645\\u0633\\u062a\\u0645\\u0631\"', '2026-10-01 18:39:28'),
(134, 'contact', 'desc', '\"\\u0625\\u0644\\u064a\\u0643 \\u0625\\u062c\\u0627\\u0628\\u0627\\u062a \\u0644\\u0623\\u0628\\u0631\\u0632 \\u0627\\u0644\\u0627\\u0633\\u062a\\u0641\\u0633\\u0627\\u0631\\u0627\\u062a \\u0627\\u0644\\u0645\\u062a\\u0643\\u0631\\u0631\\u0629 \\u062d\\u0648\\u0644 \\u062e\\u062f\\u0645\\u0627\\u062a\\u0646\\u0627\"', '2026-10-01 18:39:28'),
(135, 'contact', 'btnText', '\"\\u0625\\u0631\\u0633\\u0627\\u0644 \\u0627\\u0644\\u0631\\u0633\\u0627\\u0644\\u0629\"', '2026-10-01 18:39:28'),
(136, 'contact', 'successMsg', '\"\\u2713 \\u062a\\u0645 \\u0625\\u0631\\u0633\\u0627\\u0644 \\u0631\\u0633\\u0627\\u0644\\u062a\\u0643 \\u0628\\u0646\\u062c\\u0627\\u062d! \\u0633\\u0646\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0645\\u0639\\u0643 \\u0642\\u0631\\u064a\\u0628\\u0627\\u064b.\"', '2026-10-01 18:39:28'),
(137, 'contact', 'items', '[{\"q\":\"\\u0645\\u062a\\u0649 \\u064a\\u062a\\u0645 \\u0627\\u0644\\u0631\\u062f \\u0639\\u0644\\u0649 \\u0627\\u0633\\u062a\\u0641\\u0633\\u0627\\u0631\\u064a\\u061f\",\"a\":\"\\u0646\\u0644\\u062a\\u0632\\u0645 \\u0628\\u0627\\u0644\\u0631\\u062f \\u0639\\u0644\\u0649 \\u062c\\u0645\\u064a\\u0639 \\u0627\\u0644\\u0631\\u0633\\u0627\\u0626\\u0644 \\u0648\\u0627\\u0644\\u0627\\u062a\\u0635\\u0627\\u0644\\u0627\\u062a \\u0627\\u0644\\u0648\\u0627\\u0631\\u062f\\u0629 \\u0639\\u0628\\u0631 \\u0646\\u0645\\u0648\\u0630\\u062c \\u0627\\u0644\\u0627\\u062a\\u0635\\u0627\\u0644 \\u0623\\u0648 \\u0627\\u0644\\u0628\\u0631\\u064a\\u062f \\u0627\\u0644\\u0625\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a \\u062e\\u0644\\u0627\\u0644 \\u0662\\u0664 \\u0633\\u0627\\u0639\\u0629 \\u0639\\u0645\\u0644 \\u0643\\u062d\\u062f \\u0623\\u0642\\u0635\\u0649 \\u0645\\u0646 \\u0627\\u0633\\u062a\\u0642\\u0628\\u0627\\u0644\\u0647\\u0627.\"},{\"q\":\"\\u0643\\u064a\\u0641 \\u064a\\u0645\\u0643\\u0646\\u0646\\u064a \\u0627\\u0644\\u062a\\u0628\\u0631\\u0639 \\u0644\\u0644\\u0645\\u0634\\u0627\\u0631\\u064a\\u0639\\u061f\",\"a\":\"\\u064a\\u0645\\u0643\\u0646\\u0643 \\u0627\\u0644\\u062a\\u0628\\u0631\\u0639 \\u0639\\u0628\\u0631 \\u0635\\u0641\\u062d\\u0629 \\\"\\u062a\\u0628\\u0631\\u0639 \\u0627\\u0644\\u0622\\u0646\\\" \\u0623\\u0648 \\u0628\\u0627\\u0644\\u062a\\u062d\\u0648\\u064a\\u0644 \\u0627\\u0644\\u0645\\u0628\\u0627\\u0634\\u0631 \\u0625\\u0644\\u0649 \\u062d\\u0633\\u0627\\u0628 \\u0627\\u0644\\u062c\\u0645\\u0639\\u064a\\u0629 \\u0641\\u064a \\u0645\\u0635\\u0631\\u0641 \\u0627\\u0644\\u0631\\u0627\\u062c\\u062d\\u064a \\u2014 \\u0627\\u0644\\u0622\\u064a\\u0628\\u0627\\u0646: SA86 8000 0265 6080 1097 9797 (\\u0627\\u0636\\u063a\\u0637 \\u0644\\u0646\\u0633\\u062e\\u0647 \\u0645\\u0646 \\u0635\\u0641\\u062d\\u0629 \\u0627\\u0644\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0623\\u0648 \\u0627\\u0644\\u062a\\u0628\\u0631\\u0639 \\u0623\\u0648 \\u062a\\u0630\\u064a\\u064a\\u0644 \\u0627\\u0644\\u0645\\u0648\\u0642\\u0639).\"},{\"q\":\"\\u0643\\u064a\\u0641 \\u0623\\u062a\\u0637\\u0648\\u0639 \\u0645\\u0639 \\u062c\\u0645\\u0639\\u064a\\u0629 \\u0628\\u0646\\u064a\\u0627\\u0646\\u061f\",\"a\":\"\\u0646\\u0631\\u062d\\u0628 \\u0628\\u0643\\u0644 \\u0627\\u0644\\u0645\\u062a\\u0637\\u0648\\u0639\\u064a\\u0646 \\u0641\\u064a \\u0645\\u062c\\u0627\\u0644\\u0627\\u062a \\u0635\\u064a\\u0627\\u0646\\u0629 \\u0648\\u0631\\u0639\\u0627\\u064a\\u0629 \\u0628\\u064a\\u0648\\u062a \\u0627\\u0644\\u0644\\u0647! \\u064a\\u0645\\u0643\\u0646\\u0643 \\u0627\\u0644\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0639\\u0628\\u0631 \\u0635\\u0641\\u062d\\u0629 \\u0627\\u0644\\u062a\\u0637\\u0648\\u0639 \\u0648\\u0627\\u0644\\u0627\\u0646\\u062a\\u0642\\u0627\\u0644 \\u0625\\u0644\\u0649 \\u0627\\u0644\\u0645\\u0646\\u0635\\u0629 \\u0627\\u0644\\u0648\\u0637\\u0646\\u064a\\u0629 \\u0644\\u0644\\u0639\\u0645\\u0644 \\u0627\\u0644\\u062a\\u0637\\u0648\\u0639\\u064a \\u0644\\u0644\\u0627\\u0646\\u0636\\u0645\\u0627\\u0645 \\u0644\\u0641\\u0631\\u0635 \\u062c\\u0645\\u0639\\u064a\\u0629 \\u0628\\u0646\\u064a\\u0627\\u0646.\"},{\"q\":\"\\u0643\\u064a\\u0641 \\u0623\\u0642\\u062f\\u0645 \\u0627\\u0642\\u062a\\u0631\\u0627\\u062d\\u0627\\u064b \\u0623\\u0648 \\u0634\\u0643\\u0648\\u0649\\u061f\",\"a\":\"\\u0645\\u0644\\u0627\\u062d\\u0638\\u0627\\u062a\\u0643\\u0645 \\u0648\\u0645\\u0642\\u062a\\u0631\\u062d\\u0627\\u062a\\u0643\\u0645 \\u062a\\u062b\\u0631\\u064a \\u0623\\u0639\\u0645\\u0627\\u0644\\u0646\\u0627\\u061b \\u064a\\u0631\\u062c\\u0649 \\u0645\\u0644\\u0621 \\u0646\\u0645\\u0648\\u0630\\u062c \\u0627\\u0644\\u0627\\u062a\\u0635\\u0627\\u0644 \\u0648\\u0643\\u062a\\u0627\\u0628\\u0629 \\u062a\\u0641\\u0627\\u0635\\u064a\\u0644 \\u0627\\u0644\\u0627\\u0642\\u062a\\u0631\\u0627\\u062d \\u0623\\u0648 \\u0627\\u0644\\u0634\\u0643\\u0648\\u0649 \\u0628\\u0648\\u0636\\u0648\\u0639 \\u0648\\u0633\\u064a\\u062d\\u0627\\u0644 \\u0627\\u0644\\u0645\\u0648\\u0636\\u0648\\u0639 \\u0644\\u0644\\u0642\\u0633\\u0645 \\u0627\\u0644\\u0625\\u062f\\u0627\\u0631\\u064a \\u0627\\u0644\\u0645\\u062e\\u062a\\u0635 \\u0644\\u0645\\u062a\\u0627\\u0628\\u0639\\u062a\\u0647 \\u0648\\u0627\\u0644\\u062a\\u0648\\u0627\\u0635\\u0644 \\u0645\\u0639\\u0643.\"}]', '2026-10-01 18:39:28');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `annual_reports`
--
ALTER TABLE `annual_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `assembly_members`
--
ALTER TABLE `assembly_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `assembly_minutes`
--
ALTER TABLE `assembly_minutes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `board_members`
--
ALTER TABLE `board_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `financial_statements`
--
ALTER TABLE `financial_statements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `governance_documents`
--
ALTER TABLE `governance_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `policies`
--
ALTER TABLE `policies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `project_categories`
--
ALTER TABLE `project_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `project_media`
--
ALTER TABLE `project_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `site_contents`
--
ALTER TABLE `site_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

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
