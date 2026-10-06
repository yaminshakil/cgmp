-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: cgmp
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `announcements`
--

DROP TABLE IF EXISTS `announcements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `announcements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `message` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'info',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `starts_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `text_styles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`text_styles`)),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcements`
--

LOCK TABLES `announcements` WRITE;
/*!40000 ALTER TABLE `announcements` DISABLE KEYS */;
/*!40000 ALTER TABLE `announcements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('laravel-cache-5c785c036466adea360111aa28563bfd556b5fba','i:1;',1790867978),('laravel-cache-5c785c036466adea360111aa28563bfd556b5fba:timer','i:1790867978;',1790867978);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Clinic Updates','clinic-updates','2026-09-16 23:34:08','2026-09-16 23:34:08'),(2,'Health Advice','health-advice','2026-09-16 23:34:08','2026-09-16 23:34:08');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_messages`
--

DROP TABLE IF EXISTS `contact_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_messages`
--

LOCK TABLES `contact_messages` WRITE;
/*!40000 ALTER TABLE `contact_messages` DISABLE KEYS */;
INSERT INTO `contact_messages` VALUES (3,'yamin shakil','yaminshakil7@gmail.com','01745741710','ghjk',0,'2026-09-19 13:15:32','2026-09-19 13:15:32');
/*!40000 ALTER TABLE `contact_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctors`
--

DROP TABLE IF EXISTS `doctors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctors` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `qualifications` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `years_experience` varchar(255) DEFAULT NULL,
  `languages` varchar(255) DEFAULT NULL,
  `availability_days` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`availability_days`)),
  `healthengine_doctor_id` bigint(20) unsigned DEFAULT NULL,
  `sort_order` int(10) unsigned NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `text_styles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`text_styles`)),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctors`
--

LOCK TABLES `doctors` WRITE;
/*!40000 ALTER TABLE `doctors` DISABLE KEYS */;
INSERT INTO `doctors` VALUES (1,'Dr Homayera Noor','Practice Principal','MBBS, DCH (USyd), FRACGP','images/doctors/Dr-Homayera-Noor.jpg','Dr Homayera Noor is the Practice Principal at Cringila General Medical Practice, with special interests in women’s health, mental health, immunisations, chronic disease management, children’s health checks and medical check-ups.',NULL,'English, Bengali',NULL,118736,1,1,'2026-09-16 23:34:06','2026-09-18 23:36:39',NULL),(2,'Dr Hasina Muttaqi','General Practitioner','MBBS, FRACGP','images/doctors/Dr-Hasina-Muttaqi.jpg','Dr Hasina Muttaqi is a General Practitioner at Cringila General Medical Practice, with special interests in women’s health, immunisations, chronic disease management, children’s health checks and medical check-ups.',NULL,'English, Bengali',NULL,129147,2,1,'2026-09-16 23:34:06','2026-09-18 23:36:39',NULL),(3,'Dr Hamze Hamze','General Practitioner','Doctor of Medicine (MD)','images/doctors/Dr-Hamze-Hamze.jpg','Dr Hamze Hamze is a General Practitioner at Cringila General Medical Practice, with special interests in men’s health, women’s health, immunisations, chronic disease management, children’s health checks and medical check-ups.',NULL,'English, Arabic, Russian, French',NULL,142301,3,1,'2026-09-16 23:46:02','2026-09-18 23:36:39',NULL);
/*!40000 ALTER TABLE `doctors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faqs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `sort_order` int(10) unsigned NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `text_styles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`text_styles`)),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs`
--

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
INSERT INTO `faqs` VALUES (1,'Do you offer bulk billing?','Billing varies by consultation type. Please ask our reception team about bulk billing and Medicare rebates when you book your appointment.',1,1,'2026-09-16 23:34:07','2026-09-16 23:34:07',NULL),(2,'How do I book an appointment?','Book online using the \"Book Appointment\" button, which links to our HealthEngine booking page, or call the practice directly. Walk-ins are also welcome.',2,1,'2026-09-16 23:34:07','2026-09-16 23:34:07',NULL),(3,'What should I bring to my first appointment?','Please bring your Medicare card, photo ID, a list of current medications, and any relevant referrals or test results.',3,1,'2026-09-16 23:34:07','2026-09-16 23:34:07',NULL),(4,'Do you speak languages other than English?','Please contact reception to check current language support and interpreter availability for your appointment.',4,1,'2026-09-16 23:34:07','2026-09-16 23:34:07',NULL),(5,'What happens if I need care after hours?','For non-emergency care outside our opening hours, you can contact the National Home Doctor Service on 13 SICK (13 74 25) or visit your nearest urgent care clinic. For a medical emergency, always call 000.',5,1,'2026-09-16 23:34:07','2026-09-16 23:34:07',NULL),(6,'Can I get a referral to a specialist?','Yes. Book a standard consultation with one of our GPs, who can assess your needs and provide a referral to a specialist if clinically appropriate.',6,1,'2026-09-16 23:34:07','2026-09-16 23:34:07',NULL);
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `alt_text` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_09_01_215332_add_role_to_users_table',1),(5,'2026_09_01_215332_create_categories_table',1),(6,'2026_09_01_215333_create_tags_table',1),(7,'2026_09_01_215334_create_posts_table',1),(8,'2026_09_01_215334_z_create_post_tag_table',1),(9,'2026_09_01_215335_create_services_table',1),(10,'2026_09_01_215336_create_doctors_table',1),(11,'2026_09_01_215336_create_testimonials_table',1),(12,'2026_09_01_215337_create_announcements_table',1),(13,'2026_09_01_215338_create_faqs_table',1),(14,'2026_09_01_215338_create_pages_table',1),(15,'2026_09_01_215339_create_sections_table',1),(16,'2026_09_01_215340_create_contact_messages_table',1),(17,'2026_09_01_215340_create_settings_table',1),(18,'2026_09_01_215341_create_media_table',1),(19,'2026_09_02_174645_add_experience_fields_to_doctors_table',1),(20,'2026_09_11_181012_add_text_styles_columns',1),(21,'2026_09_21_000000_add_healthengine_doctor_id_to_doctors_table',1),(22,'2026_09_21_100000_add_gallery_to_services_table',1),(23,'2026_09_23_000000_change_users_role_default',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `body` longtext DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `text_styles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`text_styles`)),
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'Fees & Information','fees-info','<div>We believe healthcare should be accessible and easy to understand. Please speak with our reception team about billing, Medicare rebates, and any out-of-pocket costs before your appointment.</div>',NULL,NULL,'2026-09-16 23:34:08','2026-09-19 05:23:45','[]'),(2,'Privacy Policy','privacy-policy','<p>Cringila General Medical Practice (\"the Practice\", \"we\", \"us\") is committed to protecting the privacy of your personal and health information in accordance with the Privacy Act 1988 (Cth) and the Australian Privacy Principles (APPs). This policy explains what information we collect, how we use it, and how you can access or correct it.</p>\n\n<h2>Information We Collect</h2>\n<p>In the course of providing healthcare services, we may collect:</p>\n<ul>\n<li>Personal details such as your name, date of birth, address, phone number and email address.</li>\n<li>Medicare, Department of Veterans\' Affairs or private health insurance details.</li>\n<li>Health information, including your medical history, test results, medications, referrals and treatment notes.</li>\n<li>Information you provide through our website, such as contact or appointment enquiry forms.</li>\n</ul>\n\n<h2>How We Collect Information</h2>\n<p>We usually collect information directly from you, whether in person, by phone, or through our website\'s contact and booking forms. In some cases, we may also collect information from other healthcare providers, specialists, hospitals or Medicare, where necessary for your care and with your consent where required.</p>\n\n<h2>How We Use and Disclose Your Information</h2>\n<p>We use your personal and health information to provide you with medical care, manage appointments and billing, and communicate with you about your treatment. We may disclose information to:</p>\n<ul>\n<li>Other healthcare providers involved in your care, such as specialists, pathology or radiology services.</li>\n<li>Medicare, health funds or other agencies as required to process claims or payments.</li>\n<li>Government bodies where required or authorised by law.</li>\n</ul>\n<p>We do not sell or disclose your information to third parties for marketing purposes.</p>\n\n<h2>Data Security</h2>\n<p>We take reasonable steps to protect your personal and health information from misuse, interference, loss, and unauthorised access, modification or disclosure. Patient records are stored on secure systems with restricted access.</p>\n\n<h2>Website and Online Enquiries</h2>\n<p>Information submitted through our website\'s contact and appointment forms is used only to respond to your enquiry or booking request. This website is not intended for the transmission of urgent or emergency medical information &mdash; if you are experiencing a medical emergency, call <strong>000</strong> immediately.</p>\n\n<h2>Access and Correction</h2>\n<p>You have the right to request access to, or correction of, the personal and health information we hold about you. Requests can be made in writing to the Practice using the contact details below, and we will respond within a reasonable timeframe.</p>\n\n<h2>Complaints</h2>\n<p>If you have a concern about how we have handled your personal information, please contact us in the first instance using the details below. You may also lodge a complaint with the Office of the Australian Information Commissioner (OAIC) at oaic.gov.au.</p>\n\n<h2>Changes to This Policy</h2>\n<p>We may update this Privacy Policy from time to time to reflect changes in our practices or legal obligations. The most current version will always be available on this page.</p>\n\n<h2>Contact Us</h2>\n<p>For any questions about this Privacy Policy or to make a request regarding your information, please contact us at:</p>\n<p>Cringila General Medical Practice<br>\n23 Lake Avenue, Cringila NSW 2502<br>\nPhone: 02 4274 1795<br>\nEmail: reception@cgmp.com.au</p>\n',NULL,NULL,'2026-09-16 23:34:08','2026-09-17 02:47:37',NULL),(3,'Terms of Use','terms','<p>These Terms of Use govern your use of the Cringila General Medical Practice website. By accessing or using this website, you agree to these terms. If you do not agree, please do not use this website.</p>\n\n<h2>Purpose of This Website</h2>\n<p>This website provides general information about Cringila General Medical Practice, our doctors, services and how to contact or book an appointment with us. It is intended for general informational purposes only.</p>\n\n<h2>Not a Substitute for Medical Advice</h2>\n<p>Information on this website, including blog articles and service descriptions, is general in nature and is not a substitute for professional medical advice, diagnosis or treatment tailored to your individual circumstances. Always seek the advice of your doctor or another qualified health provider with any questions you may have regarding a medical condition.</p>\n<p>If you are experiencing a medical emergency, call <strong>000</strong> immediately or attend your nearest hospital emergency department. Do not use this website, its contact form, or email to seek urgent medical attention.</p>\n\n<h2>Appointments and Bookings</h2>\n<p>Appointment requests made through this website or a linked online booking service are subject to confirmation by the Practice. Submitting a booking or enquiry does not guarantee an appointment time until it has been confirmed.</p>\n\n<h2>Website Content and Accuracy</h2>\n<p>We take reasonable care to keep information on this website accurate and up to date, including doctor availability, services and opening hours. However, we do not warrant that all information is complete, current or error-free, and details such as fees, services and opening hours may change without notice. Please contact the Practice directly to confirm any information before relying on it.</p>\n\n<h2>Intellectual Property</h2>\n<p>Unless otherwise stated, the content of this website &mdash; including text, images and the Practice\'s name and logo &mdash; is owned by or licensed to Cringila General Medical Practice and is protected by copyright. You may view and print pages for your personal, non-commercial use, but may not reproduce, distribute or modify any content without our prior written permission.</p>\n\n<h2>Third-Party Links</h2>\n<p>This website may contain links to third-party websites, such as online booking platforms or health information resources. We are not responsible for the content, accuracy or privacy practices of any linked third-party websites.</p>\n\n<h2>Limitation of Liability</h2>\n<p>To the extent permitted by law, Cringila General Medical Practice will not be liable for any loss or damage arising from your use of, or inability to use, this website, including reliance on any information contained on it.</p>\n\n<h2>Governing Law</h2>\n<p>These Terms of Use are governed by the laws of New South Wales, Australia.</p>\n\n<h2>Changes to These Terms</h2>\n<p>We may update these Terms of Use from time to time. Continued use of this website after changes are posted constitutes acceptance of the revised terms.</p>\n\n<h2>Contact Us</h2>\n<p>If you have any questions about these Terms of Use, please contact us at:</p>\n<p>Cringila General Medical Practice<br>\n23 Lake Avenue, Cringila NSW 2502<br>\nPhone: 02 4274 1795<br>\nEmail: reception@cgmp.com.au</p>\n',NULL,NULL,'2026-09-16 23:34:08','2026-09-17 02:47:38',NULL);
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_tag`
--

DROP TABLE IF EXISTS `post_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_tag` (
  `post_id` bigint(20) unsigned NOT NULL,
  `tag_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`post_id`,`tag_id`),
  KEY `post_tag_tag_id_foreign` (`tag_id`),
  CONSTRAINT `post_tag_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `post_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_tag`
--

LOCK TABLES `post_tag` WRITE;
/*!40000 ALTER TABLE `post_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `post_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` bigint(20) unsigned DEFAULT NULL,
  `category_id` bigint(20) unsigned DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` text DEFAULT NULL,
  `body` longtext NOT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `featured_image_alt` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'draft',
  `published_at` timestamp NULL DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `text_styles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`text_styles`)),
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`),
  KEY `posts_author_id_foreign` (`author_id`),
  KEY `posts_category_id_foreign` (`category_id`),
  CONSTRAINT `posts_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,1,1,'Respiratory Symptoms? Please Wear a Mask When Visiting','respiratory-symptoms-mask-notice','To keep vulnerable patients safe, we kindly ask anyone with cough, cold or flu symptoms to wear a face mask while in the practice.','<p>If you are experiencing acute respiratory symptoms such as a cough, cold or flu, please wear a face mask while in the practice. Masks are available at reception.</p><p>This helps protect our vulnerable patients, including young children, elderly patients, and those with chronic health conditions.</p>','images/blog/blog-mask-notice.jpg','Doctor wearing a face mask and stethoscope','published','2026-09-07 23:34:08',NULL,NULL,'2026-09-16 23:34:08','2026-09-16 23:34:08',NULL),(2,1,2,'Diabetes Awareness: Know Your Risk','diabetes-awareness-know-your-risk','Around 1.3 million Australians live with diabetes and many more don\'t know they\'re at risk. Here\'s what to watch for and when to get checked.','<p>Diabetes is one of the most common chronic conditions in Australia. Early diagnosis and management can significantly reduce the risk of complications.</p><p>Speak to your GP about a diabetes risk assessment, especially if you have a family history, are overweight, or are over 40.</p>','images/blog/blog-diabetes-awareness.jpg','Healthcare worker holding a blood glucose meter','published','2026-08-29 23:34:08',NULL,NULL,'2026-09-16 23:34:09','2026-09-16 23:34:09',NULL),(3,1,1,'Same-Day Appointments & Walk-Ins: How Our Clinic Works','same-day-appointments-and-walk-ins','Open five days a week with same-day appointments and walk-ins welcome — here\'s how to be seen quickly at CGMP.','<p>Cringila General Medical Practice is open five days a week. We offer same-day appointments subject to availability, and walk-ins are always welcome.</p><p>For the fastest service, we recommend booking online via HealthEngine or calling ahead.</p>','images/blog/blog-same-day-appointments.jpg','Modern medical clinic reception area','published','2026-08-20 23:34:08',NULL,NULL,'2026-09-16 23:34:09','2026-09-16 23:34:09',NULL),(4,1,1,'Now Booking Online via HealthEngine','now-booking-online-via-healthengine','You can now book your appointment with us anytime, day or night, through HealthEngine — no phone call required.','<p>We\'re making it easier than ever to see your GP. Appointments can now be booked online through HealthEngine directly from our website, any time of day.</p><p>Prefer to speak to someone? Reception is still happy to book over the phone during opening hours.</p>','images/blog/blog-online-booking.jpg','Healthcare professional using a smartphone and tablet','published','2026-09-12 23:34:08',NULL,NULL,'2026-09-16 23:34:09','2026-09-16 23:34:09',NULL),(5,1,2,'Flu Vaccination Season: What You Need to Know','flu-vaccination-season','Flu season is approaching — here\'s who should get vaccinated, when, and how to book your shot at CGMP.','<p>Annual flu vaccination is recommended for everyone aged six months and older, and is especially important for young children, pregnant women, people aged 65 and over, and those with chronic health conditions.</p><p>Book an appointment with your GP to get vaccinated before flu season peaks.</p>','images/blog/blog-flu-vaccination.jpg','Doctor administering a vaccination','published','2026-09-14 23:34:08',NULL,NULL,'2026-09-16 23:34:09','2026-09-16 23:34:09',NULL);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sections` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`content`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sections_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sections`
--

LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` VALUES (1,'hero','{\"heading\":\"Personalised Support for All Your Healthcare Needs\",\"subheading\":\"Trusted, compassionate general practice in the heart of Cringila. Expert care for every member of your family \\u2014 from routine check-ups to complex health needs.\",\"badge_text\":\"Cringila General Medical Practice\",\"primary_button_text\":\"Book Appointment\",\"primary_button_link\":\"\\/book-appointment\",\"secondary_button_text\":\"Our Services\",\"secondary_button_link\":\"\\/services\",\"review_rating\":null,\"review_count\":null,\"video_url\":null,\"bg_color\":\"#d5e7fb\",\"image\":\"sections\\/TdmMNAXdD79MMB4Mwth4.jpg\",\"mobile_image\":\"sections\\/LQ1cXlCHn3RrtXbioIgB.jpg\",\"styles\":[]}','2026-09-16 23:34:04','2026-10-01 06:49:44'),(2,'about','{\"heading\":\"Caring for Cringila Since 2026\",\"subheading\":\"We are a passionate team of GPs dedicated to providing exceptional healthcare to our community.\",\"body\":\"<p>Our experienced team offers comprehensive general practice care for individuals and families at every stage of life. We are open five days a week, with same-day appointments available and walk-ins welcome.<\\/p><p>Our GPs specialise in mental health, men\'s and women\'s health, and chronic disease management.<\\/p>\",\"image\":\"sections\\/c6hWB6fPetbB9P5q05qW.jpg\",\"points\":[\"Open five days a week\",\"Same-day appointments available\",\"Walk-ins welcome\"],\"stats\":[{\"value\":2,\"suffix\":\"\",\"label\":\"GPs\"},{\"value\":5,\"suffix\":\"\",\"label\":\"Days a week\"}]}','2026-09-16 23:34:05','2026-10-01 07:07:21'),(3,'booking_strip','{\"heading\":\"Ready to see a doctor?\",\"text\":\"Book online in minutes with HealthEngine, call the practice, or simply walk in.\",\"button_text\":\"Book online with HealthEngine\"}','2026-09-16 23:34:05','2026-09-16 23:34:05'),(4,'clinic_gallery','{\"items\":[{\"image\":\"gallery\\/P5eOPJXdZQoVdA2zpS1M.jpg\",\"caption\":\"Easy to find at 23 Lake Avenue\",\"sub\":\"Step-free entrance with a ramp\",\"alt\":\"Front of Cringila General Medical Practice at 23 Lake Avenue, with the Medicare Bulk Billing sign\"},{\"image\":\"gallery\\/nGpX5aNZNMJVkgSWoqoc.jpg\",\"caption\":\"Friendly front desk\",\"sub\":\"Book in, check in or ask us anything\",\"alt\":\"Reception desk at Cringila General Medical Practice\"},{\"image\":\"gallery\\/K93iFQZHbBKHUDNOm9B5.jpg\",\"caption\":\"Comfortable waiting room\",\"sub\":\"Seating and free health information\",\"alt\":\"Waiting room with comfortable seating and a Health Updates brochure rack\"}]}','2026-10-01 07:07:01','2026-10-01 07:07:21');
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `gallery` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`gallery`)),
  `short_description` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `sort_order` int(10) unsigned NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `text_styles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`text_styles`)),
  PRIMARY KEY (`id`),
  UNIQUE KEY `services_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'General Practice','general-practice','stethoscope','services/LE8M8faGKntCvd61AZmT.jpg',NULL,'Complete healthcare for all ages, from check-ups to acute care, with same-day appointments available.','Our GPs provide comprehensive care for every stage of life — routine check-ups, acute illness, vaccinations and referrals. Same-day appointments are available and walk-ins are welcome.',1,1,'2026-09-16 23:34:05','2026-09-21 01:04:05','[]'),(2,'Mental Health Care','mental-health-care','brain','services/qR9yJmyr6vKenCMJP4Hw.jpg',NULL,'Talk to your GP if you\'re feeling low or anxious — they can assess your condition and provide treatment.','Talk to your GP if you\'re feeling low or anxious. They can assess your condition, and provide treatment.',2,1,'2026-09-16 23:34:05','2026-09-21 01:04:05',NULL),(3,'Men\'s Health','mens-health','user-round','services/vsFuPK99YdAQ8N5ueajN.jpg',NULL,'Health checks, preventive screening and management of conditions affecting men at every age.','Confidential, judgement-free care covering preventive health checks, chronic condition management, and men\'s health screening.',3,1,'2026-09-16 23:34:06','2026-09-21 04:27:38',NULL),(4,'Women\'s Health','womens-health','heart-pulse','services/4eNPWzlnq0n7cnrFBEgT.jpg',NULL,'Comprehensive care addressing reproductive health, pregnancy, menopause and preventive care.','Women\'s health focuses on the unique medical needs of women, addressing areas such as reproductive health, pregnancy, menopause, and preventive care. It encompasses a range of services, including regular check-ups, screenings, and treatment for various conditions to promote overall well-being.',4,1,'2026-09-16 23:34:06','2026-09-21 04:27:37',NULL),(5,'Chronic Disease Management','chronic-disease-management','activity','services/I9dSFqRr5n4oizyzGXHW.jpg',NULL,'Personalised, long-term GP Management Plans for chronic conditions like diabetes, hypertension and arthritis.','GP Management Plans are personalised, long-term care plans designed for chronic conditions like diabetes, hypertension, and arthritis. Our GPs will coordinate and manage your ongoing care with all your healthcare providers.',5,1,'2026-09-16 23:34:06','2026-09-21 01:04:08',NULL),(6,'Diabetes Care','diabetes-care','activity','services/bluCBbBdwwm1oaDNKnes.jpg',NULL,'Diagnosis, monitoring, medication reviews and lifestyle support for type 1 and type 2 diabetes.','Ongoing diabetes care including diagnosis, blood glucose monitoring, medication reviews, and lifestyle and dietary support.',6,1,'2026-09-16 23:34:06','2026-09-21 01:04:08',NULL),(7,'Telehealth','telehealth','video','services/QvPZeC3kWlPCEY8RJQRr.jpg',NULL,'Phone and video consultations for regular patients who are unable to travel to the practice.','If you\'re a regular patient and can\'t travel to the medical centre, telehealth services may be available at your GP\'s discretion. Contact the practice for more information.',7,1,'2026-09-16 23:46:13','2026-09-21 01:04:08',NULL),(8,'Immunisations & Vaccinations','immunisations-vaccinations','activity','services/dUZJowUSoWLCnjt9epOD.jpg',NULL,'Childhood, seasonal flu and adult vaccinations to keep you and your family protected.','We provide childhood immunisations, seasonal influenza vaccines and adult vaccinations in line with the National Immunisation Program.\nSpeak to our reception team or your GP about which vaccines are right for you and your family, and book a time that suits you.',8,1,'2026-09-21 04:16:06','2026-09-21 04:16:06',NULL),(9,'Health Assessments','health-assessments','stethoscope','services/UWKos9oMEUiHi1oLDgYF.jpg',NULL,'Regular check-ups and preventive health assessments to catch problems early.','A health assessment is a thorough check of your overall health, covering your medical history, lifestyle, risk factors and any screening that is due.\nYour GP will discuss the results with you and put a plan in place to help you stay well. Ask our team whether you are eligible for a Medicare-rebated assessment.',9,1,'2026-09-21 04:16:06','2026-09-21 04:16:06',NULL),(10,'Children\'s Health Checks','childrens-health-checks','baby',NULL,NULL,'Growth and development checks, school-entry health assessments and general wellbeing reviews for babies, kids and teens.','Our GPs provide comprehensive children\'s health checks covering growth and development milestones, school-entry and kinder health assessments, and general wellbeing reviews \\u2014 giving parents peace of mind and helping catch any concerns early.',10,1,'2026-09-22 16:58:21','2026-09-22 16:58:21',NULL);
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_last_activity_index` (`last_activity`),
  KEY `sessions_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('0DZSgTtO13hocXtm3XvL4zguSSaXqMIWbNYQBS1S',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiazNwMUdPZDVGajF3SFJrM096eWdLZzFTMnp4UFpvNEhsMU5TaXpQQiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9mZWVzLWluZm8iO3M6NToicm91dGUiO3M6MTU6InBhZ2VzLmZlZXMtaW5mbyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1790867823),('0Maq9O842H3tEoUoB2H4P3tGnSKhqI75KzusWS1v',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUzE3T0tGczFreEJSQjlOeFVUNVFod1JGTnBHNmFJaVB1cXJmZEk4dyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790868611),('18Li8IcLE3TiqRph3EXKdJ3nq68rzGXrmzwpONW1',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiV1U3VTBXVVo0bzFMTkJiVTlaeW5FaDJObHh1TTFFYmJ2ZGpDck1UOCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9zaXRlbWFwLnhtbCI7czo1OiJyb3V0ZSI7czo3OiJzaXRlbWFwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790867824),('1AzgUYgRwQ9Ex4QGLmuz4Ydf8kE7OZ4sif1wByoD',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRm5DUkh3cTR4N1BETXR4dlJuaFU0U20yS1N1Q2VzcnBiaUlHYUZUNiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790862336),('1rhhNBzT3thqJ0mmlPhvxVcsBaVQR2a40tRO8MP2',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoic2Jzd3FwbEhUWkVmcTZrQU9seXplUlA5UWc3UDlxU0dkZ3hseDhXNSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9zZXJ2aWNlcyI7czo1OiJyb3V0ZSI7czoxNDoic2VydmljZXMuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1790868087),('22QgoVmdJAKT5NX23s59WWOPBMgj9KsAamdz3GwA',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZmM1UUhPdHhmRlJaM2ZyZ0JlUm1uT0c0Vkc2blNzTGJnUDdOSVB0NiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790862651),('2cM1q7zyKWwV2Hx4F22SLvOuSOVwxB5ONAIc7LkB',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMnI1VENIM0xPMllKNmJzdld2YjBPc1VLRjViY0dFQlBkNDhKY0hrRSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790862302),('2Y2F5zwrTnMtx6ENFAVs6HOCUOyvbuLALIYIJvxd',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiOExDa3Z0cUFZb3REWjVWdTIyZVJpM0FtelRoekx6QTc4UGNFZ2F2MCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9ibG9nIjtzOjU6InJvdXRlIjtzOjEwOiJibG9nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790868088),('3U21mrQCMYcNOSjt2YdAXWjRJpR5mAWieTXWj3gK',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVVdnUjBrSGNWU1ZZTmM4Y3gyemRNSzJDWlhveFZPYTV5M1FxNVdnVCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9lbWVyZ2VuY3kiO3M6NToicm91dGUiO3M6OToiZW1lcmdlbmN5Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790867822),('52TMeOvgO95NQ0yIOrSoi2hap1aHV6J9Mtw0QNw9',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiN1pKWWhBSW9EWlZMdVRWa09SNlhMUGE0WjF0U2ROZUVzQXhETHRnOSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9hYm91dCI7czo1OiJyb3V0ZSI7czo1OiJhYm91dCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1790867818),('5aj1tuc9QEffVwGT8GXgcmtzM9GHOCDewhvw53US',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoidGZaVGpKZjhEMklTMjFtZGdOTnZYYmMyblF5aEM2Ym5ySUJ1Sm9QdSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9hYm91dCI7czo1OiJyb3V0ZSI7czo1OiJhYm91dCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1790868086),('5blNlSJVo705DgOtixUkBpI8cn7geAmovoPN1ut7',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoibjBoVFN3YkVQSTRycVhOYktxSUU5aTI0WUhCcEtIYzBTQ2dpa0R0cSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790862624),('5bVBYswukFmUUpMw1jP14zgjFFUq1252enongr3P',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiN3FSZmNJd0R1aUFnYUpIcm1wWEVhRWhpcGRJMlUzR1RBVXF1cVh3VCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790862580),('5HM3RTOBCmDBsdGh78Bf7HgiJtzP8MaUqbsNarNH',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoia3FhMk5OT1VNSm8wNGNRZkhySEVPMXhsbVNwa2xBUUhQblBHaXc0SCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790862267),('7fpLP5UiZY0JSnYfKKQYnpmmQVziieOPiUDw8ldf',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiQVRYS0FIdXQ0UXpDRzRFd204cllCUjRvcjBodTFiYUx0a0VDTTRucSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9mZWVzLWluZm8iO3M6NToicm91dGUiO3M6MTU6InBhZ2VzLmZlZXMtaW5mbyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1790868090),('7nuEtTqk3pw96HHTkHHPm6KBolwa7fyYYiIld5Lb',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ0FHUWV1NUw5ZmRoZ1BDRzZCVmR4NEtnZ2VnNlBWazFoaFVmUXJzaiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790862578),('8CQgLaVB6USEGahQJ8HVcpOB5LUodSN1D4b1DI2C',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUWdEU2FEUjAwUElhS2h6RHh2ODI1U2xLUFhlVWZ5YldDcmhlSmVVeiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790862335),('9kZIQ2lcf62OOyMZAnYDKoCP6ZM80LujLjPc6CEx',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiM3RZN2k5Rkl3M1lqWGgwM1F4dVY1Ukg2SmFNOERIZWdSTmJUeDZBViI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS90ZXJtcyI7czo1OiJyb3V0ZSI7czoxMToicGFnZXMudGVybXMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1790867824),('AbO4ZcGrxOg6NwYoqh99VSa4NLrYk5ZqydvYe7EP',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoienRzMVZhN3Y3MzMxUDNkcXpVVXlGa3c4clJrdGRGbDBTMGxTSU1UciI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790868075),('ACfzBJucDwMpL56mxolSqZ9lS3XCv0OxNHLRjhfr',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSGE3WHJtaVByOHpKZndQZnhRNFZscFc3a1V4Q3B0bDcwb010Y3g4ZiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hYm91dCI7czo1OiJyb3V0ZSI7czo1OiJhYm91dCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1790875904),('AfTvDgmScNNCYoc92x55CPDfOCzkwXEgiwEIoGnM',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoielBmajZFRUxib1JNM244aEhkaGhpOG9mUmZ6ZzN3RnRicUl5THJHciI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790865281),('aMbXciCxjmimBKXuQjYJmcbBrJYiveczdo2o9QVw',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVjNOb2JQSXlIS05sejBna3oyeHpDWG9iT0RROVZpcUpraXFvN0MydyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS90ZXJtcyI7czo1OiJyb3V0ZSI7czoxMToicGFnZXMudGVybXMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1790868091),('AOmCPUKnBMvbcyTJwMIhZnkfKzu4JEjoyj8ATBhK',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVTdEeFVUdmZiaG1IQVptMURON01IN2hrR0hFQUxYenNLVFpDdHFSTyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9ibG9nIjtzOjU6InJvdXRlIjtzOjEwOiJibG9nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790867820),('b1z8aw3Ns8vWywrl7fZ89Ru5QPwZIl6fL2EBo17f',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiOWRJQjVUTTBDRzZ1VDJuNDM1UktmaWdHNEt3U3BvOWV6dFl6WUdXdCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9ibG9nL25vcGUiO3M6NToicm91dGUiO3M6OToiYmxvZy5zaG93Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790867913),('bxTBCbdKm2toyPBI5Ln0jTAYb9zhZ0CcmzHcDpZw',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoicWNJVm5ZaWoxTnh4Q2NDdzRJOFRaUmkwN1Z1bmlVek9xR3h2OG9RayI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hYm91dCI7czo1OiJyb3V0ZSI7czo1OiJhYm91dCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1790875900),('CAldZPeJlPoJAXEeZTzizeXhzKjdeRxiYgGttTxE',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiM2R5SWJmY3dXbFdMSnFVN0QxaVBzdzlyNDdvR1FKbGhGZ2pDemliZSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790862579),('CyaIc4ikAAay7TptBGRIJROJsPPvodBppbUUuvAi',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRFBoVko4SHpQU3BsRlUwT2NXTHRINlNCcDNhbWZtR0owYnF6RENPeSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790868044),('DxPhxsUyBtZ648ETqe21ZwUynCHyQF13ONxpdLzi',NULL,'127.0.0.1','curl/8.18.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRFpxM0JxazBCRHdFS1JWZGtKbW5BNHZVRHU1Z3llbloxcFRXalBNYyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMToiaHR0cDovLzEyNy4wLjAuMTo4NzY1L2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vMTI3LjAuMC4xOjg3NjUvZGFzaGJvYXJkIjtzOjU6InJvdXRlIjtzOjk6ImRhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1790867915),('EvBbyId3V2RLWX6kiH5J9jZRx1hpPos3n9OklwSE',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSWxYVEc5VXJzejdTeWhWcGpUcUJNclpLeGxzSXA3M1ZSNjJkdDJmMCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9zaXRlbWFwLnhtbCI7czo1OiJyb3V0ZSI7czo3OiJzaXRlbWFwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790868092),('fLl6cMQMIMNQAXsDU0TxeyIGG0FJ7jKBDMiHZC2O',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoibGVVOHF1VmJvZ2VBcjEyWHVtTnBiWTNRVEQxekU0ckdnUVc4YTRSUSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9wcml2YWN5LXBvbGljeSI7czo1OiJyb3V0ZSI7czoxMzoicGFnZXMucHJpdmFjeSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1790867823),('FRwMcQUzTtplIhuiCpBRcxlR2hf0yOl0vZVCRfBS',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoick4xY3VBd3ZIVFdNcVZOSFNoZ0VzNzAxU0NzT3VxVTNTUm5NVGhCRyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790862604),('fwwfnSK8mNCxo5NcD551aCwlvROwWFfzrm1SXIKf',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoidmRMbmxuTkJqdWEwbm9MTXpEUG1ZV0pKMGNJOFo3WEV4MjJpQlZraSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790865280),('GcxrxUREHUO35nkMFwx4nVSxr71FapqNLm16XTtn',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoibTByRm5YQmdiaXc3OW9Jd3B1U2RFR1ZER0huNDM4SUp0VnlQeEUyMiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9ib29rLWFwcG9pbnRtZW50IjtzOjU6InJvdXRlIjtzOjc6ImJvb2tpbmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1790867822),('Gdv06M5awE51qVsxTrWsPzj9zc3jb0A6NQ1qfU3C',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWHM1d3EzNm1qajY3cnBneEx0WWJHUlpiNzhGTjNmc1NxWnJtNGVSViI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9hYm91dCI7czo1OiJyb3V0ZSI7czo1OiJhYm91dCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1790862195),('GRBX1p5BRjabToluLSZo1U6hMB8jQptE9TXUsTnq',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoidWJud0w3ellKZDFwWDNEOWlMa1hJYzd6eWZCVzlnQXJTNFJLT1BiaiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1790867824),('GsV3vja03J6G34kElyEpR7PX82iiI6UsfAUf6YWq',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZXFYVWVxVjgxNkk3czN6eHhDM2Y0ekNVanQyMHh4ZWJIRTJRVEQweCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9kb2N0b3JzIjtzOjU6InJvdXRlIjtzOjc6ImRvY3RvcnMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1790868087),('HTloqsweAcnW6mBOsqLiygz7nSissaJlfJ9KQhUK',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiY0JHSHhxWEZseUdodWd6Vlg5SWpaeE13UlVrS0s0VUNMZERJdk1LSCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zZXJ2aWNlcyI7czo1OiJyb3V0ZSI7czoxNDoic2VydmljZXMuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1790875903),('hWuTKxoGePoirwcCKBN2p9DYoQIIy2YfAQNcbWZe',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiS3lHb3UzdkV5UGViZFJvMVFkWG9ubkhVYmZqS1VZYlRRbVc2MGNDTSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790862624),('i8B6GR62s7D9GphUnGcyfEpG2kJl4KT7oCyPROP8',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNURFbmxoQlVnR0x0VDhsNkNYZXlXR3FURGVMeUdXN1dwT2lzQ1NLaSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9wcml2YWN5LXBvbGljeSI7czo1OiJyb3V0ZSI7czoxMzoicGFnZXMucHJpdmFjeSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1790868091),('j72pKPK9JpAH5RGdpvYHoSKSR5VQy70my8ij7CFn',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMVYxMmJiQW1jN3pKNnFNeGJ0TXhsQkFqbE9JeFpFTGlSTEM3WlhHeCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790862274),('j81hmWqYqoe33dGIaHjgJYSnILasAuYXjPwFLh3I',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVGllN0FIUkQwOUhHeFlvTzZqN3dCbE5veXR5UUllNm94TjlzbHU0WiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790867841),('JaBsZJuhPoXbnE3DiA7NBYgQRtk2WiMJR1u4fbHB',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZkppc2ZUQWd5NFk5RW81Vm1na2w4V3dlQXQzTHdEU2ZlYTJkTnNlUiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9zZXJ2aWNlcyI7czo1OiJyb3V0ZSI7czoxNDoic2VydmljZXMuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1790868045),('JBm38JFGrMfr9l5MygeivGHs7rdkJBh8l3UDoUpI',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoidktYYzJtbmE0b0ZyamI5VkdXcGNNT0YwOVhMUXdOUTNGZURlQ0cyTiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9yb2JvdHMudHh0IjtzOjU6InJvdXRlIjtzOjY6InJvYm90cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1790868014),('jCRhNNFqSyvq2UR93hPdSEy3IjJvbQe98TUZgHHY',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUzJsWlZHcWFOQVc4NnVud0xUeVdBTEt0a2JqQ0h0cEpNVE82ZktlRCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790867174),('jF2kT69NkYPsLodSummZShwO6aakoyNnJHMoGHye',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoicDVra0NQeXJxVVg4Z25uaHVVcWQ4ZER5Z2FEc1FUMWo5eDNxM21GTiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790862651),('JLlL8XmspqnRX6jRKPYQBLzEU5KjDMuqYwNXr1WK',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZmZ4OWZUc2ZIak13OGZlTGxEdUI5VWVaS3l4WDNpWWU3WHdWSW1sQSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790868016),('lb99QydQ6M0SM0QnwxQUzQV3VmHE9b2BY3VTusdU',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoibWZUOXNzeE1oenZpVTlrZTlkZ3NFb0JQRDc4VmFkWFdPTTdNRzVtNiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790862335),('mKuderWC74uuoMs5s5HJhT3vDF8WPzxygoiC5LMy',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUW0wSlgyRndiODRGUDU2RHZYWGxJaVlwaVpRY2ZVdUs5WWtTVEM1aiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9mYXEiO3M6NToicm91dGUiO3M6MzoiZmFxIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790867821),('MrwEQlePnofWxhiC5J36WB9t9ASNioOvtcrFaqW0',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNXdjS1Nha2htQzRNZUlCRnd4UVpKeTVEaGQyVGNST1pXQ3ZzVkx0bSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9jb250YWN0IjtzOjU6InJvdXRlIjtzOjc6ImNvbnRhY3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1790867919),('mUrFbcLiudAeGi4a0F8DZTSZb0189hhE8eZE99fK',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVVFyME9FaWhwQ2FYMDFUMnBsS0JjeHdMdmFsM0czYXB0QXh5ZUtPbyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790867817),('nTAn87oRhpD0leUVkFwKJfehds0jSkAEHo7eXjsV',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoib2hMS1ZxSnB2Y2R3VjYwaDFaS0FoNE5aZVVXRlFiajFOUlhqU1ozdiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9zZXJ2aWNlcyI7czo1OiJyb3V0ZSI7czoxNDoic2VydmljZXMuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1790867818),('NwVAiEzkQUAOw8DlSP192Is1A71NNbjSZaIwFwCn',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoidnhuM3AyaUtWMnVGMnNTTU5aWGJXZUJMQ2FHM2RuMEdnUHZZaEVLRCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9mYXEiO3M6NToicm91dGUiO3M6MzoiZmFxIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790868089),('OEcS3mINGFHw3FhNU6DIrY21zNCwa1GyhTJslxS6',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoibHpCVzluRGs5RjFtb0VLMHZoZEJrU0VRcnJNbFp3c1M4eWhOUVZTWCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790864618),('ot9OxVM5gchWI3cWZcxiejVXPb0TgQr0xQm1Vpoj',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNVFGc1RIUUx5RmRGZjJoOVZodXQ0S20wUmd2aGtrTGRYOEZ6cTUxYSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9yb2JvdHMudHh0IjtzOjU6InJvdXRlIjtzOjY6InJvYm90cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1790868092),('p0RNRnLY6Ioh8czi5lmQqUKzSIjTZdoxU0PUwwMz',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSkV5bWpIMzJFOG5GZk1UcnBOTDNzdXFLZVhJNU1NTkhlcEtscDZqayI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9jb250YWN0IjtzOjU6InJvdXRlIjtzOjc6ImNvbnRhY3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1790868088),('P5x0ZlrZbC7KXIPWZl06g5rT2Kt2IWs33ggVGWsz',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNjZ2WXlPUFV5ZmY1Tm12MEtHU2RPcGNRaGN4NWRSY2R2QldYVkRIUSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9lbWVyZ2VuY3kiO3M6NToicm91dGUiO3M6OToiZW1lcmdlbmN5Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790868090),('ppSzX0xyS5a9QNl9Zf4aflONVCli9TCfdMfmweAC',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiQnpwM1JwME5BY3RhRHNlazdmQ3ZGczNocko2eU5OaHg4bzhEN1NnWSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9zZXJ2aWNlcy9ub3BlIjtzOjU6InJvdXRlIjtzOjEzOiJzZXJ2aWNlcy5zaG93Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790867914),('QCuRbagJeTA7YUkrEjdtHAPLR9mZbZnDugOTE36F',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVXB2RHVXYjFUZUlCMWwzUGxPRzh1RnFadXVCN3pQb1p2ODlvNkRnVSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790868086),('qedq97Mbzj6fx7ZH5fpcQVNwAjTZJ7VysJlcBg8o',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoic2pmQ2k5b0NWWXFBOTZYaVdKdDNMZmVGVzZlaGZvSFROV0E2a1hKZSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9ub25leGlzdGVudC1wYWdlIjtzOjU6InJvdXRlIjtzOjEwOiJwYWdlcy5zaG93Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790867825),('QEtFVuv6Q6HJe2LCCbg2Gg68iVPAIaAFQiYZxUfp',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoia05BUG5DZ1MwdEVzU0VyMUVHMzRBUFFVb0xWUlRiOFZLUk94YmwxNSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790862303),('qFf9wTvgBHMtukv7dJBGpjqVWDvNQSn4LjZPa7IX',NULL,'127.0.0.1','Symfony','YTozOntzOjY6Il90b2tlbiI7czo0MDoieUk2SkJxTkpJcHQ0d0pTU0RsUVVRN3c0ZjZZZ1d3cjdaUXFwVmp0QiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTY6Imh0dHA6Ly9sb2NhbGhvc3QiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1790867826),('Qpx3tueqIzwmcW8S8NSEeTVTZnrPMNiUNCOmLMYX',1,'127.0.0.1','Symfony','YTo0OntzOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NjoiX3Rva2VuIjtzOjQwOiJySlBFcXNuQzE2RFZVVEJyT090RlEyeFlLclVya1p4WjFuOFNONUlhIjtzOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czoyMjoiaHR0cDovL2xvY2FsaG9zdC9hZG1pbiI7czo1OiJyb3V0ZSI7czoxNToiYWRtaW4uZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790867900),('R5YqkWngtVuD3K2XaAx826inGIIRWcKTGc7Dws19',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiS1dtcW5rZHd1a0MxYW5tcG11clhjS1lnZ0phVlJkMHhjdnc2b3RmeiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790862289),('rKkTCkALHNVGMRC53dLCAwS0gYgq4MCCw6bgLQ3L',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiM2RNYWV2YWhtaGt3UVFQWUFkV1N4R2NYMzQ2d3dpNTd4akxkbkpKZCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hYm91dCI7czo1OiJyb3V0ZSI7czo1OiJhYm91dCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1790875903),('RqGTfNlQUu8YJKRB0fVihUlZn7G0Rt3mNl42VrB7',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVm1NTFM1bnFKeEVLZHROS0haNW50Y2c5a2x1ODZQa0twTHhobFhBYiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790862603),('sgcXjjWVr5veBdeA5kbr17JvIyCZB4w7jqo96i4o',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTGVKaXhWbGFLMGNoOEFiREpxRXRnSUxHYW9oZjZyN2d0MktYck50cSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9ib29rLWFwcG9pbnRtZW50IjtzOjU6InJvdXRlIjtzOjc6ImJvb2tpbmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1790868089),('sLCMshZTdQnBVCIQHCOSdted51KL4BCJEvHA90zz',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZGZtbVFIbVYyWXByT0Y2OEgxSlhYNHprcmRwVlBQTnY0ZjFYU2JRUCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790865281),('slPMwmChBNxfvgQHxxfyrf6Z6FEeyRMUXi4Hw1sx',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWk9qT2ZEM1BpRTBFNTBiMVhac1FYNTlZY3NyZkFLRXMxSUY5M1hCUSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9zaXRlbWFwLnhtbCI7czo1OiJyb3V0ZSI7czo3OiJzaXRlbWFwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790867916),('snZodDBX0ihhSHFRcMzaiQD6H9rEcuqxypd1LZrR',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiM281OGVoRHdMazBkdUNvMUp1OUlzMjdienZEaU1jbEMwdmhqd1ByNCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1790868094),('STjTENCVVlCgqWMIyaehX4VX2xeIDNcL4Rgyfv7N',NULL,'127.0.0.1','Symfony','YTozOntzOjY6Il90b2tlbiI7czo0MDoidjJCWmo0ZWE5dUFuZVVvV21JdWt4d2JDb0NJd29PUk9DWTlWWjhKeCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3QvYmxvZyI7czo1OiJyb3V0ZSI7czoxMDoiYmxvZy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1790867832),('stvGR619Sr22QLtXKWImuAAIUEte510IqnKf8iY9',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSmhBVVBYZ1VQdktoaWE0cnEzZmpxR1M2SXdtdmJRVkVPZEJ5S1oweiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790862662),('SXHNygNw5XWn4m3bB48GZXg60sDMe8D2eZxYawux',NULL,'127.0.0.1','curl/8.18.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTUlYTFNtdmxId0V1eERUQVdxZnJkb0pTcDNxTG9hd0w3bkdFZm5kOSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNzoiaHR0cDovLzEyNy4wLjAuMTo4NzY1L2FkbWluIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9hZG1pbiI7czo1OiJyb3V0ZSI7czoxNToiYWRtaW4uZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790867914),('vvi68NyZUakd038yzt3gpoC145P75aR9Hfp5yo2X',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiR1VvTDJSTFlESzhuSjJlbGVaOGhWMUhBeGMwOFV2SzM0YURBQVNjNCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790862194),('vwtprCUjke9JHPoZVxNf6RVJdwrYie58rEDpvbdW',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMUhwem00S3V6MDN0Wm55eE9PUFl6V29FS3h5eWdZSGVqVFhNcjdtZSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790862605),('WuGukcZ9t51VnQoP40Oh4ZPUDFBxIZ7y2DybXgQt',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVTJwVkhQME5yRzFHUG1ROTFHR3FwS3FETFdCUXc3NEJiN25BYkY1NCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9hYm91dCI7czo1OiJyb3V0ZSI7czo1OiJhYm91dCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1790868046),('WuYQM2VJuGooZnSepVPFRfapFNAzIlEkYGsSCFQf',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMDNsUzRhdjJDY3g2aXA2cTYxbTZDYWJtdzBMV0hySlEyek9OU0hGVyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9jb250YWN0IjtzOjU6InJvdXRlIjtzOjc6ImNvbnRhY3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1790867820),('X7ONf87CezCPLLPVnttbd3vKAOdJ5sLpod7NccdM',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoib1VSTXExMFJkZUVrc29wbEJSdGJkaU53WTEzNTh2V1RIdUNzZzd4aCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790862652),('yHclecwbXdEXyMTy7dYyPBP5TtuW8WES1iBBirRi',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiYjFUemNBUEVBTWxtTFFVV2VDYmVud0tpUUlsdUdVS1ZxTTFKc1F0YSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1790867177),('yKtFX41mNvuLoGYUJeca1B431LbyPDafvas4WV8I',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ25KSDlMNDJkMkNGMWJtdHJoYmNOTDhHeENVcFRYbU1GVHFINVFqVyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790862302),('ytgKw2ro8Il0A6BCiiL9hch1OsckfF9mJJuAWz09',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUFVpNmVHZ1lpbW5VQW44Y0ZSTEx5WHFLa3BzVGZTcGh3RzJlcDRNWSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9kb2N0b3JzIjtzOjU6InJvdXRlIjtzOjc6ImRvY3RvcnMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1790867819),('Yzjg5c6LskZyZNbZNRBVqMqyRqdjbGaDbpar5qVn',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSEJkYWVISVVnQXlHd05VaGxjOUhXMFlJZWlqbEJiNFdaeWhmOWl6dSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NS9jb250YWN0IjtzOjU6InJvdXRlIjtzOjc6ImNvbnRhY3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1790868046),('zKMf6xV5K0rFRLpy0HhlKoZgD0dn1TP5432GSDdR',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiOTJZSnFEOGxGeVQ3MEZJdm1VbHQyaVQzZW9xeWs2ZlA1WDVwUDRuNCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790862623),('Zuwx1M2mw9BErvIWcY7gqOs83oLqbP5FS4PTKkE8',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoidGZCdEV3Zk45N1JBRFh0aGNqYzhKb1lNemdtbUxld2N3VFl1cXlBbyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790862271),('Zv9r88XV9PU304IQLPpmjRvYsXfhHn2YXES6wfpd',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRFZ6T3NucnZzVm1wSHlnbWlrdkU4NFJNZ3N3YmhjSXl4NVlhSXpHVyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODc2NSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1790868057);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'clinic_name','Cringila General Medical Practice','2026-09-16 23:34:02','2026-09-16 23:34:02'),(2,'tagline','Personalised support for all your healthcare needs','2026-09-16 23:34:02','2026-09-17 05:31:48'),(3,'address_line1','23 Lake Avenue','2026-09-16 23:34:03','2026-09-16 23:45:52'),(4,'address_suburb','Cringila NSW 2502','2026-09-16 23:34:03','2026-09-16 23:34:03'),(5,'phone','02 4274 1795','2026-09-16 23:34:03','2026-09-16 23:45:52'),(6,'contact_email','reception@cgmp.com.au','2026-09-16 23:34:03','2026-09-16 23:34:03'),(7,'fax','02 4276 1614','2026-09-16 23:34:03','2026-09-16 23:45:52'),(8,'opening_hours','Sunday - Friday: 8:30am - 5:30pm\r\nSaturday: Closed','2026-09-16 23:34:03','2026-09-19 04:13:50'),(9,'emergency_note','In a medical emergency, call 000 immediately.','2026-09-16 23:34:03','2026-09-16 23:34:03'),(10,'healthengine_url',NULL,'2026-09-16 23:34:03','2026-09-17 05:31:23'),(11,'facebook_url','https://web.facebook.com/profile.php?id=61566436771503','2026-09-16 23:34:03','2026-09-16 23:45:53'),(12,'instagram_url','https://www.instagram.com/cgmedicalp/','2026-09-16 23:34:03','2026-09-16 23:45:53'),(13,'google_map_embed','https://www.google.com/maps/embed?pb=!4v1789644767018!6m8!1m7!1sH09l0QgM8T76XTw7UnmJIg!2m2!1d-34.46785220472757!2d150.8722509236189!3f142.87515463917526!4f1.4110824742268022!5f0.4000000000000002','2026-09-16 23:34:04','2026-09-17 05:35:35'),(14,'footer_text','Personalised, bulk-billing healthcare for Cringila and surrounding communities. Same day appointments and walk-ins welcome.','2026-09-16 23:34:04','2026-09-19 00:48:50'),(15,'copyright_text',NULL,'2026-09-16 23:34:04','2026-09-17 05:31:23'),(16,'analytics_code',NULL,'2026-09-16 23:34:04','2026-09-17 05:31:23'),(17,'logo_path','branding/GagAw6sHEmpYLizidPsp.png','2026-09-16 23:40:05','2026-09-19 04:19:23'),(18,'healthengine_id','98588','2026-09-17 05:31:23','2026-09-20 08:41:06'),(19,'mail_password',NULL,'2026-09-19 03:42:30','2026-09-19 03:42:30'),(20,'mail_to','yaminshakil7@gmail.com','2026-09-19 04:13:50','2026-09-19 04:13:50'),(21,'mail_username',NULL,'2026-09-19 04:13:50','2026-09-19 04:13:50'),(22,'favicon_path',NULL,'2026-09-19 04:13:55','2026-10-01 09:06:10');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tags_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testimonials` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `context` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `rating` tinyint(3) unsigned NOT NULL DEFAULT 5,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `text_styles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`text_styles`)),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'CGMP Admin','admin@cgmp.local','admin','2026-09-16 23:34:02','$2y$12$4Fye8zz1ZHEW1Ya6QUK9FupDNjiwK/j0H47K6mXiWM4NsrmfYf6j.','EHufyXVJObobKVyeQ9KIiteGSH4EFAyWilzBlsFS2qikAatiVySftIqOkmK8','2026-09-16 23:34:02','2026-09-16 23:34:02'),(2,'manager','manager@cgmp.com','manager','2026-09-19 15:29:58','$2y$12$OIPSl3lj5hB9kWrezTHG5eMwpVGQDRbzFJDRKH0/dBtKirJl9gthu',NULL,'2026-09-19 15:29:58','2026-09-19 15:29:58'),(3,'CGMP Admin','admin@cgmp.com','admin',NULL,'$2y$12$8nXLTzUhviXiqqENqJ/r..k9JDFt2avvk1ZgFJQLoPUQ3ar30uvXW',NULL,'2026-10-02 00:29:47','2026-10-02 00:29:47');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'cgmp'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-10-02 12:33:53
