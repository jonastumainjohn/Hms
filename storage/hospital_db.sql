-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2024 at 10:19 AM
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
-- Database: `hospital_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `appointment_date` datetime NOT NULL,
  `status` enum('pending','confirmed','canceled') NOT NULL DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
-- Table structure for table `diagnoses`
--

CREATE TABLE `diagnoses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `diagnosis` varchar(255) NOT NULL,
  `symptoms` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `medical_history` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diagnoses`
--

INSERT INTO `diagnoses` (`id`, `patient_id`, `diagnosis`, `symptoms`, `created_at`, `updated_at`, `medical_history`) VALUES
(1, 12, 'Done successffully', 'Malaria Sugu', '2024-11-20 17:14:08', '2024-11-20 17:14:08', NULL),
(2, 12, 'Done successffully', 'Malaria Sugu', '2024-11-20 17:14:38', '2024-11-20 17:14:38', NULL),
(3, 12, 'Am testing', 'Malaria', '2024-11-20 17:36:59', '2024-11-20 17:36:59', NULL),
(4, 19, 'Am testing', 'Am testing', '2024-11-24 14:18:05', '2024-11-24 14:18:05', 'Am testing'),
(5, 20, 'Macho tu', 'Kichwa tu', '2024-11-25 15:23:38', '2024-11-25 15:23:38', 'Try it now'),
(7, 25, 'nothing', 'humu tu', '2024-11-26 06:41:40', '2024-11-26 06:41:40', 'heee'),
(8, 26, 'jiyudqwfdwkdwyifutr', 'y23fey2podyw2', '2024-11-26 15:40:47', '2024-11-26 15:40:47', 'hhtgcwsjk'),
(9, 27, 'testing', 'testing', '2024-12-06 12:44:13', '2024-12-06 12:44:13', 'none');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `specialization` varchar(255) NOT NULL,
  `availability` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `user_id`, `specialization`, `availability`, `created_at`, `updated_at`) VALUES
(1, 4, 'Dentist', 'Always be happy this life is simple', '2024-11-17 13:05:18', '2024-11-17 18:22:05'),
(2, 3, 'Heart', 'AM available always', '2024-11-17 13:08:19', '2024-11-17 18:17:09'),
(55, 85, 'Dentist', 'm -  TT', '2024-11-26 15:16:23', '2024-11-26 15:16:46'),
(56, 84, 'Dentist', 'now', '2024-12-06 12:32:51', '2024-12-06 12:32:51');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_title` varchar(255) DEFAULT NULL,
  `site_email` varchar(255) DEFAULT NULL,
  `site_phone` varchar(255) DEFAULT NULL,
  `site_meta_keywords` varchar(255) DEFAULT NULL,
  `site_meta_description` varchar(255) DEFAULT NULL,
  `site_logo` varchar(255) DEFAULT NULL,
  `site_favicon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `site_title`, `site_email`, `site_phone`, `site_meta_keywords`, `site_meta_description`, `site_logo`, `site_favicon`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, 'logo_6745d78a298c9.png', 'favicon_674477601a960.png', NULL, '2024-11-26 11:13:30');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medicals`
--

CREATE TABLE `medicals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `medicals`
--

INSERT INTO `medicals` (`id`, `name`, `price`, `created_at`, `updated_at`) VALUES
(3, 'Blood Test', 1000344.00, '2024-11-21 17:58:39', '2024-11-26 16:56:00'),
(4, 'Urine Test', 25000.00, '2024-11-21 17:59:24', '2024-11-26 16:58:55'),
(5, 'X-Ray', 30000.00, '2024-11-21 17:59:48', '2024-11-26 16:59:28');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_10_10_144653_create_general_settings_table', 1),
(5, '2024_11_16_165537_create_patients_table', 1),
(6, '2024_11_16_170319_create_doctors_table', 1),
(7, '2024_11_16_170659_create_appointments_table', 1),
(8, '2024_11_16_172416_create_diagnoses_table', 1),
(9, '2024_11_16_172517_create_prescriptions_table', 1),
(10, '2024_11_16_173109_create_payments_table', 1),
(11, '2024_11_18_073819_create_receptionists_table', 2),
(12, '2024_11_18_194824_add_mrn_number_to_patients_table', 3),
(13, '2024_11_18_204518_create_registration_fees_table', 4),
(14, '2024_11_19_113945_alter_patients_table', 5),
(15, '2024_11_19_164122_add_registration_fee_to_patients_table', 6),
(17, '2024_11_19_173745_add_gender_to_patients_table', 7),
(18, '2024_11_20_055154_create_vists_table', 8),
(19, '2024_11_20_163337_create_diagnoses_table', 8),
(20, '2024_11_20_184624_create_diagnoses_table', 9),
(21, '2024_11_21_074649_create_notifications_table', 10),
(22, '2024_11_21_074649_create_notification_table', 11),
(23, '2024_11_21_200911_create_medicals_table', 12),
(24, '2024_11_22_132144_create_prescriptions_table', 13),
(25, '2024_11_22_132206_create_prescription_items_table', 14),
(26, '2024_11_22_162209_add_appointment_date_to_prescriptions_table', 14),
(27, '2024_11_24_161839_add_status_to_prescriptions_table', 15),
(28, '2024_11_24_171140_update_diagnosis_table_remove_medication_add_medical_history', 16),
(29, '2024_12_08_105016_create_products_table', 17),
(32, '2024_12_08_123634_add_slug_to_products_table', 18);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `type`, `message`, `read`, `created_at`, `updated_at`, `patient_id`) VALUES
(1, 3, 'New Patient Registration', 'A new patient, Gee John, has been registered.', 1, '2024-11-21 06:14:56', '2024-11-21 06:14:56', 0),
(2, 4, 'New Patient Registration', 'A new patient, Gee John, has been registered.', 1, '2024-11-21 06:14:56', '2024-11-21 06:14:56', 0),
(53, 84, 'New Patient Registration', 'A new patient, Gee John, has been registered.', 0, '2024-11-21 06:14:59', '2024-11-21 06:14:59', 0),
(165, 84, 'New Patient Registration', 'A new patient, William John, has been registered.', 0, '2024-11-23 05:35:41', '2024-11-23 05:35:41', 0),
(178, 3, 'New Patient Registration', 'A new patient, gamondi michael, has been registered.', 1, '2024-11-26 06:32:31', '2024-11-26 06:42:24', 25),
(179, 4, 'New Patient Registration', 'A new patient, gamondi michael, has been registered.', 0, '2024-11-26 06:32:31', '2024-11-26 06:32:31', 25),
(180, 84, 'New Patient Registration', 'A new patient, gamondi michael, has been registered.', 0, '2024-11-26 06:32:31', '2024-11-26 06:32:31', 25),
(181, 3, 'New Patient Registration', 'A new patient, Mwanawima John, has been registered.', 0, '2024-11-26 15:37:33', '2024-11-26 15:37:33', 26),
(182, 4, 'New Patient Registration', 'A new patient, Mwanawima John, has been registered.', 0, '2024-11-26 15:37:34', '2024-11-26 15:37:34', 26),
(183, 84, 'New Patient Registration', 'A new patient, Mwanawima John, has been registered.', 0, '2024-11-26 15:37:34', '2024-11-26 15:37:34', 26),
(184, 85, 'New Patient Registration', 'A new patient, Mwanawima John, has been registered.', 0, '2024-11-26 15:37:34', '2024-11-26 15:37:34', 26),
(185, 3, 'New Patient Registration', 'A new patient, William John, has been registered.', 1, '2024-12-06 12:39:24', '2024-12-06 12:45:30', 27),
(186, 4, 'New Patient Registration', 'A new patient, William John, has been registered.', 0, '2024-12-06 12:39:25', '2024-12-06 12:39:25', 27),
(187, 84, 'New Patient Registration', 'A new patient, William John, has been registered.', 0, '2024-12-06 12:39:25', '2024-12-06 12:39:25', 27),
(188, 85, 'New Patient Registration', 'A new patient, William John, has been registered.', 0, '2024-12-06 12:39:25', '2024-12-06 12:39:25', 27);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('jonastumain6@gmail.com', 'N05UcGhpQ2JuOGhnRW1TdzljQUZSOEdyMVZTYWVRQjB2eXpRckNkeWV3RjBzMzVuaktHWXc0ZVpFVFBmbjN2TQ==', '2024-11-17 11:10:38');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `receptionist_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `mrn_number` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `medical_history` text DEFAULT NULL,
  `registration_fee` decimal(8,2) NOT NULL DEFAULT 0.00,
  `payment_method` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `receptionist_id`, `first_name`, `middle_name`, `last_name`, `email`, `age`, `gender`, `phone_number`, `mrn_number`, `address`, `medical_history`, `registration_fee`, `payment_method`, `created_at`, `updated_at`) VALUES
(1, 57, 'Erick', 'Mkatambo', 'Charles', 'erickvant@gmail.com', '22', 'female', '0628033522', 'MRN-001', 'Mtwara - Tandaimba', 'Heart attack problems', 15000.00, 'cash', '2024-11-01 14:46:38', '2024-11-19 14:46:38'),
(12, 57, 'Jonas', 'Tumain', 'John', 'jonastumainjohn@gmail.com', '24', 'female', '0745110044', 'MRN-002', 'Dar es salaam - Tanzania', 'Heart attack and kidny', 15000.00, 'cash', '2024-11-19 17:16:06', '2024-11-20 10:15:41'),
(15, 57, 'Gee', 'machine', 'John', 'jonastumain@gmail.com', '23', 'male', '0745110044', 'MRN-013', 'dsm', 'nothing happened', 15000.00, 'cash', '2024-11-21 06:14:56', '2024-11-21 06:14:56'),
(17, 57, 'Samsoni', 'Alfred', 'Mwanawima', 'mwanawima@gmail.com', '23', 'male', '0745110055', 'MRN-016', 'dsm', 'Heart attack and kidny', 15000.00, 'cash', '2024-11-21 07:39:54', '2024-11-21 07:39:54'),
(18, 57, 'Samsoni', 'Alfred', 'Mwanawima', 'mwana@gmail.com', '23', 'female', '0745110055', 'MRN-018', 'dsm', 'nothing happened', 15000.00, 'cash', '2024-11-21 14:52:01', '2024-11-21 14:52:01'),
(19, 57, 'William', 'Elias', 'John', 'willy@gmail.com', '24', 'female', '0628033522', 'MRN-19FJSFI', 'Morogoro - Tanzania', 'Maralia , heart pressure', 15000.00, 'cash', '2024-11-23 05:35:40', '2024-11-23 05:35:40'),
(20, 57, 'ANDERSON', 'AMOS', 'KARUMUNA', 'astumainjohn@gmail.com', '25', 'male', '0745110044', 'MRN-203U712', '193, dsm', 'Sickness', 15000.00, 'cash', '2024-11-25 15:21:25', '2024-11-25 15:21:25'),
(22, 57, 'Jenesta', 'Alinda', 'Isaka', 'jenestaisaka26@gmail.com', '21', 'male', '0745110033', 'MRN-21HSCPB', '193, dsm', 'Hellow', 15000.00, 'cash', '2024-11-25 15:45:02', '2024-11-25 15:45:02'),
(25, 57, 'gamondi', 'Master', 'michael', 'jonastum@gmail.com', '24', 'male', '0628033522', 'MRN-23JF0LV', 'Morogoro - Tanzania', 'hw', 15000.00, 'cash', '2024-11-26 06:32:31', '2024-11-26 06:32:31'),
(26, 57, 'Mwanawima', 'Tumain', 'John', 'jonastumainj@gmail.com', '23', 'male', '0628033343', 'MRN-26ZSCA6', 'Mwanza', 'nothi', 13000.00, 'cash', '2024-11-26 15:37:33', '2024-11-26 15:37:33'),
(27, 57, 'William', 'wilson', 'John', 'konde@gmail.com', '22', 'male', '0628033343', 'MRN-273XG8K', 'Mwanza', 'None', 20000.00, 'cash', '2024-12-06 12:39:24', '2024-12-06 12:39:24');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appointment_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_status` enum('paid','unpaid') NOT NULL DEFAULT 'unpaid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `appointment_date` datetime DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`id`, `patient_id`, `doctor_id`, `description`, `appointment_date`, `status`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 18, 3, 'Kunywa upozee kichwa', NULL, NULL, 25000.00, '2024-11-22 11:56:27', '2024-11-22 11:56:27'),
(2, 15, 3, 'Am waiting here', NULL, NULL, 172250.00, '2024-11-22 12:56:17', '2024-11-22 12:56:17'),
(3, 1, 3, 'am just testing', '2024-11-30 07:33:00', 'Performed', 60000.00, '2024-11-22 13:33:10', '2024-11-24 13:59:16'),
(4, 15, 3, 'Just make it welll', '2024-12-07 11:35:00', 'Performed', 55000.00, '2024-11-24 13:34:25', '2024-11-25 12:07:05'),
(5, 19, 3, 'well well', '2024-11-30 20:51:00', 'Pending', 31000.00, '2024-11-24 14:48:22', '2024-11-24 14:48:22'),
(6, 17, 3, NULL, NULL, NULL, 69250.00, '2024-11-24 16:23:08', '2024-11-24 16:23:08'),
(7, 12, 3, 'Humu tu yaan', '2024-12-07 23:05:00', 'Pending', 85000.00, '2024-11-24 17:00:47', '2024-11-24 17:00:47'),
(8, 20, 3, 'Here we go', '2024-11-30 12:24:00', 'Performed', 55000.00, '2024-11-25 15:24:28', '2024-11-26 15:52:39'),
(10, 22, 3, 'This is testing', NULL, NULL, 26000.00, '2024-11-25 15:47:14', '2024-11-25 15:47:14'),
(12, 25, 3, 'hellow', '2024-11-29 05:42:00', 'Performed', 25000.00, '2024-11-26 06:42:24', '2024-11-26 06:51:41'),
(13, 27, 3, 'testing', '2025-01-11 09:45:00', 'Pending', 1030344.00, '2024-12-06 12:45:30', '2024-12-06 12:45:30');

-- --------------------------------------------------------

--
-- Table structure for table `prescription_items`
--

CREATE TABLE `prescription_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prescription_id` bigint(20) UNSIGNED NOT NULL,
  `medical_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prescription_items`
--

INSERT INTO `prescription_items` (`id`, `prescription_id`, `medical_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 1, 25000.00, '2024-11-22 11:56:27', '2024-11-22 11:56:27'),
(2, 2, 5, 2, 60000.00, '2024-11-22 12:56:17', '2024-11-22 12:56:17'),
(3, 2, 6, 1, 43250.00, '2024-11-22 12:56:17', '2024-11-22 12:56:17'),
(4, 2, 7, 3, 69000.00, '2024-11-22 12:56:17', '2024-11-22 12:56:17'),
(5, 3, 5, 2, 60000.00, '2024-11-22 13:33:10', '2024-11-22 13:33:10'),
(6, 4, 4, 1, 25000.00, '2024-11-24 13:34:25', '2024-11-24 13:34:25'),
(7, 4, 5, 1, 30000.00, '2024-11-24 13:34:25', '2024-11-24 13:34:25'),
(8, 5, 3, 1, 1000.00, '2024-11-24 14:48:22', '2024-11-24 14:48:22'),
(9, 5, 5, 1, 30000.00, '2024-11-24 14:48:22', '2024-11-24 14:48:22'),
(10, 6, 3, 1, 1000.00, '2024-11-24 16:23:08', '2024-11-24 16:23:08'),
(11, 6, 4, 1, 25000.00, '2024-11-24 16:23:09', '2024-11-24 16:23:09'),
(12, 6, 6, 1, 43250.00, '2024-11-24 16:23:09', '2024-11-24 16:23:09'),
(13, 7, 4, 1, 25000.00, '2024-11-24 17:00:47', '2024-11-24 17:00:47'),
(14, 7, 5, 2, 60000.00, '2024-11-24 17:00:48', '2024-11-24 17:00:48'),
(15, 8, 4, 1, 25000.00, '2024-11-25 15:24:28', '2024-11-25 15:24:28'),
(16, 8, 5, 1, 30000.00, '2024-11-25 15:24:28', '2024-11-25 15:24:28'),
(17, 9, 3, 1, 1000.00, '2024-11-25 15:37:46', '2024-11-25 15:37:46'),
(18, 9, 6, 1, 43250.00, '2024-11-25 15:37:46', '2024-11-25 15:37:46'),
(19, 10, 3, 1, 1000.00, '2024-11-25 15:47:14', '2024-11-25 15:47:14'),
(20, 10, 4, 1, 25000.00, '2024-11-25 15:47:14', '2024-11-25 15:47:14'),
(21, 12, 4, 1, 25000.00, '2024-11-26 06:42:24', '2024-11-26 06:42:24'),
(22, 13, 3, 1, 1000344.00, '2024-12-06 12:45:30', '2024-12-06 12:45:30'),
(23, 13, 5, 1, 30000.00, '2024-12-06 12:45:30', '2024-12-06 12:45:30');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `status`, `price`, `quantity`, `created_at`, `updated_at`) VALUES
(3, 'Paracetamol', 'paracetamol', 'inactive', 2000.00, 5, '2024-12-08 10:34:13', '2024-12-10 05:17:27');

-- --------------------------------------------------------

--
-- Table structure for table `receptionists`
--

CREATE TABLE `receptionists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date_of_birth` date NOT NULL,
  `shift` varchar(255) NOT NULL DEFAULT 'day',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `receptionists`
--

INSERT INTO `receptionists` (`id`, `user_id`, `date_of_birth`, `shift`, `created_at`, `updated_at`) VALUES
(1, 57, '2000-05-08', 'night', '2024-11-18 07:35:02', '2024-11-18 12:48:17'),
(4, 60, '2008-08-06', 'night', '2024-11-18 12:58:24', '2024-11-18 12:58:24'),
(5, 61, '2008-04-04', 'full time', '2024-11-18 12:58:24', '2024-11-18 12:58:24'),
(6, 62, '2000-11-29', 'night', '2024-11-18 12:58:24', '2024-11-18 12:58:24'),
(7, 63, '1992-11-05', 'day', '2024-11-18 12:58:24', '2024-11-18 12:58:24'),
(8, 64, '1977-02-05', 'night', '2024-11-18 12:58:24', '2024-11-18 12:58:24'),
(9, 65, '1988-01-12', 'day', '2024-11-18 12:58:24', '2024-11-18 12:58:24'),
(10, 66, '2004-10-20', 'night', '2024-11-18 12:58:24', '2024-11-18 12:58:24'),
(11, 67, '1990-08-06', 'day', '2024-11-18 12:58:25', '2024-11-18 12:58:25'),
(12, 68, '2008-06-10', 'day', '2024-11-18 12:58:25', '2024-11-18 12:58:25'),
(13, 69, '1982-03-16', 'full time', '2024-11-18 12:58:25', '2024-11-18 12:58:25'),
(14, 70, '1973-12-02', 'day', '2024-11-18 12:58:25', '2024-11-18 12:58:25'),
(15, 71, '1972-12-29', 'full time', '2024-11-18 12:58:25', '2024-11-18 12:58:25'),
(16, 72, '1999-09-02', 'night', '2024-11-18 12:58:25', '2024-11-18 12:58:25'),
(17, 73, '1997-11-09', 'full time', '2024-11-18 12:58:25', '2024-11-18 12:58:25'),
(18, 74, '2003-12-08', 'full time', '2024-11-18 12:58:25', '2024-11-18 12:58:25'),
(19, 75, '1972-02-24', 'full time', '2024-11-18 12:58:25', '2024-11-18 12:58:25'),
(20, 76, '1995-11-28', 'day', '2024-11-18 12:58:25', '2024-11-18 12:58:25'),
(21, 77, '1981-08-05', 'day', '2024-11-18 12:58:25', '2024-11-18 12:58:25'),
(22, 78, '1996-10-10', 'night', '2024-11-18 12:58:25', '2024-11-18 12:58:25'),
(23, 79, '2005-09-07', 'day', '2024-11-18 12:58:25', '2024-11-18 12:58:25'),
(24, 80, '1994-01-24', 'day', '2024-11-18 12:58:25', '2024-11-18 12:58:25'),
(25, 81, '1978-01-04', 'day', '2024-11-18 12:58:25', '2024-11-18 12:58:25'),
(26, 82, '2004-12-18', 'full time', '2024-11-18 12:58:25', '2024-11-18 12:58:25'),
(27, 83, '1989-06-17', 'night', '2024-11-18 12:58:25', '2024-11-18 12:58:25'),
(28, 58, '2001-06-13', 'night', '2024-11-26 15:18:23', '2024-11-26 15:18:44');

-- --------------------------------------------------------

--
-- Table structure for table `registration_fees`
--

CREATE TABLE `registration_fees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fee_amount` decimal(10,2) NOT NULL,
  `currency` varchar(5) NOT NULL,
  `valid_from` date NOT NULL,
  `valid_until` date NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `registration_fees`
--

INSERT INTO `registration_fees` (`id`, `fee_amount`, `currency`, `valid_from`, `valid_until`, `description`, `created_at`, `updated_at`) VALUES
(1, 20000.00, 'TZS', '2024-11-19', '2025-10-14', 'This is Registration fee', '2024-11-19 08:18:23', '2024-12-06 12:36:37');

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
('F3jOIJUi7khbqALPeuEmPmceY3cnAjeGVc7e872i', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieGxWc0FLblVPakRSOFZxTG5uSXhxNG5ERlVuWjZFWm9MZWphMmJ6ZCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9sb2dpbiI7fX0=', 1733822335);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'doctor',
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `email_verified_at`, `password`, `picture`, `type`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Jonas Tumain John', 'jonastumain6@gmail.com', 'Jonascoder', NULL, '$2y$12$jM8xMkx6cb8JwuaqbDNWMe7N9SQcPGoyEiOfiZ4P0nTp/x46zaYpG', 'IMG_6739a0494ddcf.png', 'superAdmin', 'active', NULL, '2024-11-16 15:01:14', '2024-11-25 13:15:00'),
(3, 'Gabriel kazinja ', 'gee6real@gmail.com', 'gee6real@gmail.com', NULL, '$2y$12$ogrnt32PbEfEbPCnRVnAiu/rSoA4SrOmZ7quGmvOw56Fqs2dTiLxK', 'IMG_673f2216dbf28.png', 'doctor', 'active', NULL, '2024-11-17 05:59:10', '2024-11-21 09:05:43'),
(4, 'Samsoni Mwanawima', 'jonas@gmail.com', 'samboy', NULL, '$2y$12$pr/D3q4kfysi2VkNEWTwDe.FJUbObenudXqEBVMKe3AO6vvAJ9HHm', NULL, 'doctor', 'active', NULL, '2024-11-17 06:01:00', '2024-11-17 09:09:10'),
(57, 'ZOmbie Zombie', 'recept@gmai.com', 'Hilali', NULL, '$2y$12$csHee0mIWNGhupWP3BulcOsHd5p0XhRmH29rpANUhzLhKED/Sc00y', 'IMG_674471b381578.png', 'receptionist', 'active', NULL, '2024-11-18 06:35:19', '2024-11-26 04:40:56'),
(58, 'Charity Lyeee', 'charity@gmail.com', 'charity', NULL, '$2y$12$eNMt7vT/rGoZoRs5niRvRuQYSbkPst0T3wWWN2jg0elPFbsOMReUm', NULL, 'receptionist', 'active', NULL, '2024-11-18 06:38:00', '2024-11-18 06:38:00'),
(59, 'Prof. Mack Cronin', 'kessler.chyna@example.org', 'wrutherford', NULL, '$2y$12$kzgrCh8n/0a8McYzDIpMQuarWoYCPSoJHykC6fwZ6c1b1Kj0k52N6', NULL, 'receptionist', 'active', NULL, '2024-11-18 12:58:22', '2024-11-18 12:58:22'),
(60, 'Marcia Stehr', 'sbecker@example.com', 'omer.hand', NULL, '$2y$12$V9Xt/lyLBEzGcG24PXjmlORqExF.EsqUuZdysVxXH7hP1cpAusUr.', NULL, 'receptionist', 'active', NULL, '2024-11-18 12:58:22', '2024-11-18 12:58:22'),
(61, 'Eugenia Grimes', 'mitchell.monte@example.net', 'rosamond.bogan', NULL, '$2y$12$Yav57Bh6qJqkdp3yrIWtY.Gvr7hbdxSqh2z8uEPF5CPyuSMaXSEMi', NULL, 'receptionist', 'active', NULL, '2024-11-18 12:58:22', '2024-11-18 12:58:22'),
(62, 'Dayna Hettinger', 'cordelia01@example.net', 'tanya.davis', NULL, '$2y$12$GZ3Ig8faumbQdGAfsrZAQuI9LpESZRhsIREV6t.45G813WC8jAOx2', NULL, 'receptionist', 'active', NULL, '2024-11-18 12:58:23', '2024-11-18 12:58:23'),
(63, 'Dr. Maria Beier V', 'anderson.eileen@example.com', 'helen10', NULL, '$2y$12$sAkKQ1B9julEEd4afMWBfeG4K4d0Bgikv8xf.3yyWrCbDJEDDOIfq', NULL, 'receptionist', 'active', NULL, '2024-11-18 12:58:23', '2024-11-18 12:58:23'),
(64, 'Aniya Shields', 'towne.kirk@example.net', 'devan41', NULL, '$2y$12$SQGkOl6AGgV/WXXJhJbG6eZ6LBxTKIw31jGZ3lwswiDzepPSka6ba', NULL, 'receptionist', 'active', NULL, '2024-11-18 12:58:23', '2024-11-18 12:58:23'),
(65, 'Prof. Guy Medhurst', 'zspencer@example.net', 'witting.gerhard', NULL, '$2y$12$o1B3E6sjTLNYbYJwFFLp.uoHjp2I5GzRK1e1QStvmhMr5expjG9hy', NULL, 'receptionist', 'active', NULL, '2024-11-18 12:58:23', '2024-11-18 12:58:23'),
(66, 'Miss Mollie Lebsack', 'clinton.pagac@example.com', 'torrance10', NULL, '$2y$12$iGGVE6zacSrG/gFyf35zref2Z6qQdLZaEA8HEphlosKqEPn0YfJFC', NULL, 'receptionist', 'active', NULL, '2024-11-18 12:58:23', '2024-11-18 12:58:23'),
(67, 'Noemi Vandervort', 'johnson.tia@example.org', 'ahaag', NULL, '$2y$12$.Adu4XoxXLP85ifYCzMNhOSEy0dCkLTjnrDMSlI.aeo80J9VprahC', NULL, 'receptionist', 'active', NULL, '2024-11-18 12:58:23', '2024-11-18 12:58:23'),
(68, 'Lonie Konopelski III', 'antonietta51@example.org', 'johns.myriam', NULL, '$2y$12$cVBBUhD.Vh81fMYEXc6Gz.HtQ.mafIY.HoBk1X5l4piqIeaS89kWm', NULL, 'receptionist', 'active', NULL, '2024-11-18 12:58:23', '2024-11-18 12:58:23'),
(69, 'Dr. Giuseppe Smith', 'grutherford@example.net', 'schroeder.ron', NULL, '$2y$12$INPTUFxy6LSmsLG15zH9PuDRZKAD82NoosDHVRQTFWrrfpzkI.RbW', NULL, 'receptionist', 'active', NULL, '2024-11-18 12:58:23', '2024-11-18 12:58:23'),
(70, 'Eliane Breitenberg', 'mborer@example.org', 'lindgren.ava', NULL, '$2y$12$OPNY0l.KpUjaMCiqYVchlOOW2W6fQGNufkgr9SYDBBJ6t.mOmJoM2', NULL, 'receptionist', 'active', NULL, '2024-11-18 12:58:23', '2024-11-18 12:58:23'),
(71, 'Alaina Rippin', 'laila.kihn@example.net', 'ferry.stephanie', NULL, '$2y$12$IpCgCICnQADXOK6uuNSEbuxCreVJah76snx3Fnbd7kx2jrjyHZqvW', NULL, 'receptionist', 'active', NULL, '2024-11-18 12:58:23', '2024-11-18 12:58:23'),
(72, 'Prof. Darion Hagenes DDS', 'chet.boyer@example.net', 'monahan.winnifred', NULL, '$2y$12$JVm5av4joODuF7s8sCVjruJlAIzRjREn0dxbNLjxF45LmtJcEqdLG', NULL, 'receptionist', 'active', NULL, '2024-11-18 12:58:23', '2024-11-18 12:58:23'),
(73, 'Ramona Ruecker', 'jkautzer@example.org', 'emmie.rippin', NULL, '$2y$12$k8lbBzExcwwIL2z6EaHruOyeWpkIF0JmInmdO9jUEcAf7SXcE3oUW', NULL, 'receptionist', 'active', NULL, '2024-11-18 12:58:23', '2024-11-18 12:58:23'),
(74, 'Olaf Quitzon', 'melba.wuckert@example.net', 'alberto48', NULL, '$2y$12$L01TDXR7CHe54HjbNhztr.ih9zLUOvGtVRl.1LlN0SHbcsN1qSsHS', NULL, 'receptionist', 'active', NULL, '2024-11-18 12:58:24', '2024-11-18 12:58:24'),
(75, 'Clifton Kerluke', 'domingo80@example.com', 'keeley12', NULL, '$2y$12$YaYTOKEHZ3hCgKIdy45yZ.DjV3/gUcY/fr6pGs5sWF5Edmpx317b2', NULL, 'receptionist', 'active', NULL, '2024-11-18 12:58:24', '2024-11-18 12:58:24'),
(76, 'Violet McClure', 'devonte.schinner@example.net', 'emely89', NULL, '$2y$12$1HKPrtqYqumfSi66Kpp7J./mna02502AVykbaP5zKnF44891K3GX.', NULL, 'receptionist', 'active', NULL, '2024-11-18 12:58:24', '2024-11-18 12:58:24'),
(77, 'Prof. Rory Rodriguez Jr.', 'mason.romaguera@example.net', 'lind.rhoda', NULL, '$2y$12$XJI/54XdKl6.egjaednCIeBOHizOjN2/ruVrhFjHJfFfS65rv6eP6', NULL, 'receptionist', 'active', NULL, '2024-11-18 12:58:24', '2024-11-18 12:58:24'),
(78, 'Mrs. Jude Abernathy', 'genesis.nikolaus@example.net', 'jpurdy', NULL, '$2y$12$nIfEeM6EiKFd1Id0Pla8POtKSiIBrf6UcMghLebFEtYJQbgB5wLXu', NULL, 'receptionist', 'active', NULL, '2024-11-18 12:58:24', '2024-11-18 12:58:24'),
(79, 'Ms. Nelda Hirthe', 'elouise21@example.org', 'kiel43', NULL, '$2y$12$JkHbkWPda5Ns/MYODIwtd.APchiW5RILpLygLhMUSx4gbRYma3bHK', NULL, 'receptionist', 'active', NULL, '2024-11-18 12:58:24', '2024-11-18 12:58:24'),
(80, 'Rodrick Hane', 'braxton55@example.org', 'frami.anahi', NULL, '$2y$12$On7ZNTeHAI/jQXgxvHKvn.xYbt01TS7bAlHimDWcH3no4ZIAf10Mq', NULL, 'receptionist', 'active', NULL, '2024-11-18 12:58:24', '2024-11-18 12:58:24'),
(81, 'Dayana Wiza', 'moses36@example.net', 'luther.oconner', NULL, '$2y$12$tF3Jx3h8ujf1e40gxO5RMeruVJ0kGU122Y8Ech.WuwQWDu.mTOvK.', NULL, 'receptionist', 'active', NULL, '2024-11-18 12:58:24', '2024-11-18 12:58:24'),
(82, 'Kianna Conn', 'lemuel.weimann@example.net', 'ywindler', NULL, '$2y$12$qtQkwCWp6yNIYOnLre/kbOP8PeKg4kjvb01dDa4PFa2JPNvEpyD7e', NULL, 'receptionist', 'active', NULL, '2024-11-18 12:58:24', '2024-11-18 12:58:24'),
(83, 'Claudine Moore', 'gay65@example.com', 'claudie69', NULL, '$2y$12$UM9RB/vldZuMaW.VaR.BDupsldTQiCbGt1k57rlDWh/zUh/Lrn0gq', NULL, 'receptionist', 'active', NULL, '2024-11-18 12:58:24', '2024-11-18 12:58:24'),
(84, 'Jonas Tumain John', 'jonas1@gmail.com', 'jonas1@gmail.com', NULL, '$2y$12$1BTwCJEXTiJnlHkgxEwf4.tRM9egVbmlpcNGsSy.xPC5jzMZ8Rrwe', NULL, 'doctor', 'active', NULL, '2024-11-18 13:22:44', '2024-11-18 13:22:44'),
(85, 'G machine', 'geereal@gmail.com', 'gee machine', NULL, '$2y$12$cCpCgMRTDe9KBereeuZPjuW29Fz92g9WMHXUlTsum4BS6LeRrMOji', NULL, 'doctor', 'active', NULL, '2024-11-26 15:14:47', '2024-11-26 15:15:24');

-- --------------------------------------------------------

--
-- Table structure for table `vists`
--

CREATE TABLE `vists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `service_type` varchar(255) NOT NULL,
  `service_fee` decimal(10,2) NOT NULL,
  `vist_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointments_patient_id_foreign` (`patient_id`),
  ADD KEY `appointments_doctor_id_foreign` (`doctor_id`);

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
-- Indexes for table `diagnoses`
--
ALTER TABLE `diagnoses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `diagnoses_patient_id_foreign` (`patient_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctors_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicals`
--
ALTER TABLE `medicals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notification_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `patients_mrn_number_unique` (`mrn_number`),
  ADD KEY `patients_receptionist_id_foreign` (`receptionist_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_appointment_id_foreign` (`appointment_id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prescription_patient_id_foreign` (`patient_id`),
  ADD KEY `prescription_doctor_id_foreign` (`doctor_id`);

--
-- Indexes for table `prescription_items`
--
ALTER TABLE `prescription_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`);

--
-- Indexes for table `receptionists`
--
ALTER TABLE `receptionists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receptionists_user_id_foreign` (`user_id`);

--
-- Indexes for table `registration_fees`
--
ALTER TABLE `registration_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `vists`
--
ALTER TABLE `vists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vists_patient_id_foreign` (`patient_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `diagnoses`
--
ALTER TABLE `diagnoses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medicals`
--
ALTER TABLE `medicals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `prescription_items`
--
ALTER TABLE `prescription_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `receptionists`
--
ALTER TABLE `receptionists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `registration_fees`
--
ALTER TABLE `registration_fees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `vists`
--
ALTER TABLE `vists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `diagnoses`
--
ALTER TABLE `diagnoses`
  ADD CONSTRAINT `diagnoses_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notification_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_receptionist_id_foreign` FOREIGN KEY (`receptionist_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_appointment_id_foreign` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `prescription_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `prescription_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `receptionists`
--
ALTER TABLE `receptionists`
  ADD CONSTRAINT `receptionists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vists`
--
ALTER TABLE `vists`
  ADD CONSTRAINT `vists_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
