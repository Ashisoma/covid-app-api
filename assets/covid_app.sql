-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.14-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table covid_app.contacts
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL DEFAULT '',
  `middleName` varchar(50) NOT NULL DEFAULT '',
  `surname` varchar(50) NOT NULL DEFAULT '',
  `phoneNumber` varchar(10) NOT NULL DEFAULT '',
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_contacts_patients` (`patient_id`),
  CONSTRAINT `FK_contacts_patients` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table covid_app.contacts: ~5 rows (approximately)
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT IGNORE INTO `contacts` (`id`, `patient_id`, `firstName`, `middleName`, `surname`, `phoneNumber`, `active`, `created_at`, `updated_at`) VALUES
	(1, 2, 'John', ' Kamau', '', '0712345234', 1, '2021-08-17 15:15:12', '2021-08-17 15:15:12'),
	(2, 2, 'Jack ', 'Mwende', '', '0789212123', 1, '2021-08-17 16:42:19', '2021-08-17 16:42:19'),
	(3, 1, 'James', ' Opiyo', '', '0789678456', 1, '2021-08-31 09:19:31', '2021-08-31 09:19:31'),
	(4, 1, 'Jack', ' Maundu', '', '0789213423', 1, '2021-08-31 10:31:40', '2021-08-31 10:31:40'),
	(5, 1, 'James', 'Opiyo', 'Susi', '0789678453', 1, '2021-09-15 14:56:09', '2021-09-15 14:58:04');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;

-- Dumping structure for table covid_app.contact_tracing
CREATE TABLE IF NOT EXISTS `contact_tracing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) NOT NULL,
  `reported_by` int(11) NOT NULL,
  `county` int(11) NOT NULL DEFAULT 0,
  `subcounty` int(11) NOT NULL DEFAULT 0,
  `contactTraced` enum('Yes','No','') NOT NULL DEFAULT '',
  `tracingDate` date NOT NULL,
  `tracerName` varchar(191) NOT NULL,
  `contactTested` enum('Yes','No','') NOT NULL DEFAULT '',
  `testingDate` date DEFAULT NULL,
  `testOutcome` enum('Positive','Negative','') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table covid_app.contact_tracing: ~1 rows (approximately)
/*!40000 ALTER TABLE `contact_tracing` DISABLE KEYS */;
INSERT IGNORE INTO `contact_tracing` (`id`, `contact_id`, `reported_by`, `county`, `subcounty`, `contactTraced`, `tracingDate`, `tracerName`, `contactTested`, `testingDate`, `testOutcome`, `created_at`, `updated_at`) VALUES
	(1, 0, 1, 30, 1, 'Yes', '2021-08-10', 'Jackline', 'Yes', '2021-08-11', 'Negative', '2021-08-12 13:11:00', '2021-08-12 13:11:00'),
	(3, 1, 0, 22, 84, 'Yes', '2021-08-17', 'John Kamau', 'Yes', '2021-08-17', 'Positive', '2021-08-18 08:56:35', '2021-08-18 08:56:35'),
	(4, 5, 1, 2, 126, 'Yes', '2021-09-01', 'John Kamau', 'Yes', '2021-09-02', 'Positive', '2021-09-15 14:59:10', '2021-09-15 15:10:25');
/*!40000 ALTER TABLE `contact_tracing` ENABLE KEYS */;

-- Dumping structure for table covid_app.counties
CREATE TABLE IF NOT EXISTS `counties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `code` int(11) NOT NULL,
  `capital` varchar(20) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_county_code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table covid_app.counties: ~47 rows (approximately)
/*!40000 ALTER TABLE `counties` DISABLE KEYS */;
INSERT IGNORE INTO `counties` (`id`, `name`, `code`, `capital`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
	(1, 'Baringo', 30, 'Kabarnet', 0.4919, 35.743, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(2, 'Bomet', 36, 'Bomet', -0.7813, 35.3416, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(3, 'Bungoma', 39, 'Bungoma', 0.5666, 34.5666, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(4, 'Busia', 40, 'Busia', 0.4608, 34.1108, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(5, 'Elgeyo-Marakwet', 28, 'Iten', 0.6703, 35.5081, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(6, 'Embu', 14, 'Embu', -0.5333, 37.45, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(7, 'Garissa', 7, 'Garissa', -0.4569, 39.6583, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(8, 'Homa Bay', 43, 'Homa Bay', -0.5167, 34.45, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(9, 'Isiolo', 11, 'Isiolo', 0.35, 37.5833, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(10, 'Kajiado', 34, 'Kajiado', -1.85, 36.7833, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(11, 'Kakamega', 37, 'Kakamega', 0.2833, 34.75, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(12, 'Kericho', 35, 'Kericho', -0.3692, 35.2839, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(13, 'Kiambu', 22, 'Kiambu', -1.1714, 36.8356, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(14, 'Kilifi', 3, 'Kilifi', -3.21, 40.1, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(15, 'Kirinyaga', 20, 'Kerugoya/Kutus', -0.4989, 37.2803, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(16, 'Kisii', 45, 'Kisii', -0.6817, 34.7667, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(17, 'Kisumu', 42, 'Kisumu', -0.1, 34.75, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(18, 'Kitui', 15, 'Kitui', -1.3667, 38.0167, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(19, 'Kwale', 2, 'Kwale', -4.1737, 39.4521, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(20, 'Laikipia', 31, 'Rumuruti', 0.2725, 36.5381, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(21, 'Lamu', 5, 'Lamu', -2.2686, 40.9003, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(22, 'Machakos', 16, 'Machakos', -1.45, 36.9833, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(23, 'Makueni', 17, 'Wote', -1.7808, 37.6288, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(24, 'Mandera', 9, 'Mandera', 3.9167, 41.8333, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(25, 'Marsabit', 10, 'Marsabit', 2.3333, 37.9833, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(26, 'Meru', 12, 'Meru', 0.05, 37.65, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(27, 'Migori', 44, 'Migori', -1.0634, 34.4731, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(28, 'Mombasa', 1, 'Mombasa City', -4.05, 39.6667, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(29, 'Murang\'a', 21, 'Murang\'a', -0.721, 37.1526, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(30, 'Nairobi', 47, 'Nairobi City', -1.2864, 36.8172, '2021-03-26 17:08:27', '2020-12-21 12:46:55'),
	(31, 'Nakuru', 32, 'Nakuru', -0.2833, 36.0667, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(32, 'Nandi', 29, 'Kapsabet', 0.2, 35.1, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(33, 'Narok', 33, 'Narok', -1.0833, 35.8667, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(34, 'Nyamira', 46, 'Nyamira', -0.5633, 34.9358, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(35, 'Nyandarua', 18, 'Ol Kalou', -0.2643, 36.3788, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(36, 'Nyeri', 19, 'Nyeri', -0.4167, 36.95, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(37, 'Samburu', 25, 'Maralal', 1.1, 36.7, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(38, 'Siaya', 41, 'Siaya', 0.0607, 34.2881, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(39, 'Taita-Taveta', 6, 'Voi', -3.505, 38.3772, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(40, 'Tana River', 4, 'Hola', -1.5, 40.03, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(41, 'Tharaka-Nithi', 13, 'Chuka', -0.3299556442815828, 37.64416011415045, '2021-03-26 17:37:43', '2020-12-21 12:46:55'),
	(42, 'Trans-Nzoia', 26, 'Kitale', 1.0167, 35, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(43, 'Turkana', 23, 'Lodwar', 3.1167, 35.6, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(44, 'Uasin Gishu', 27, 'Eldoret', 0.5167, 35.2833, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(45, 'Vihiga', 38, 'Vihiga', 0.16970781473055777, 34.84400790057582, '2021-03-26 17:36:43', '2020-12-21 12:46:55'),
	(46, 'Wajir', 8, 'Wajir', 1.75, 40.0667, '2021-03-26 17:34:40', '2021-03-26 15:34:40'),
	(47, 'West Pokot', 24, 'Kapenguria', 1.2389, 35.1119, '2021-03-26 17:34:40', '2021-03-26 15:34:40');
/*!40000 ALTER TABLE `counties` ENABLE KEYS */;

-- Dumping structure for table covid_app.covid_vaccines
CREATE TABLE IF NOT EXISTS `covid_vaccines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Index 2` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table covid_app.covid_vaccines: ~0 rows (approximately)
/*!40000 ALTER TABLE `covid_vaccines` DISABLE KEYS */;
INSERT IGNORE INTO `covid_vaccines` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'vaccine one', '2021-09-07 13:53:31', '2021-09-07 13:53:32');
/*!40000 ALTER TABLE `covid_vaccines` ENABLE KEYS */;

-- Dumping structure for table covid_app.facilities
CREATE TABLE IF NOT EXISTS `facilities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mflCode` char(5) NOT NULL,
  `name` varchar(191) NOT NULL,
  `county` int(11) NOT NULL,
  `subCounty` int(11) NOT NULL,
  `project` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `Index 2` (`mflCode`),
  UNIQUE KEY `Index 3` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table covid_app.facilities: ~1 rows (approximately)
/*!40000 ALTER TABLE `facilities` DISABLE KEYS */;
INSERT IGNORE INTO `facilities` (`id`, `mflCode`, `name`, `county`, `subCounty`, `project`, `created_at`, `updated_at`) VALUES
	(2, '12345', 'Nyeri HC', 19, 314, 1, '2021-08-03 09:58:08', '2021-08-04 16:37:50');
/*!40000 ALTER TABLE `facilities` ENABLE KEYS */;

-- Dumping structure for table covid_app.lab_requests
CREATE TABLE IF NOT EXISTS `lab_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `specimen_collected` enum('Yes','No') NOT NULL,
  `reason_not_collected` varchar(191) NOT NULL DEFAULT '',
  `specimen_type` varchar(191) NOT NULL DEFAULT '',
  `specimen_type_other` varchar(191) NOT NULL DEFAULT '',
  `date_collected` date DEFAULT NULL,
  `date_sent_to_lab` date DEFAULT NULL,
  `test_type` varchar(50) NOT NULL DEFAULT '',
  `date_received_in_lab` date DEFAULT NULL,
  `confirming_lab` varchar(100) NOT NULL DEFAULT '',
  `assay_used` varchar(100) NOT NULL DEFAULT '',
  `lab_result` varchar(50) NOT NULL DEFAULT '',
  `sequencing_done` enum('Yes','No','') NOT NULL DEFAULT '',
  `lab_confirmation_date` date DEFAULT NULL,
  `investigator` varchar(100) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_lab_requests_patients` (`patient_id`),
  CONSTRAINT `FK_lab_requests_patients` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table covid_app.lab_requests: ~5 rows (approximately)
/*!40000 ALTER TABLE `lab_requests` DISABLE KEYS */;
INSERT IGNORE INTO `lab_requests` (`id`, `patient_id`, `specimen_collected`, `reason_not_collected`, `specimen_type`, `specimen_type_other`, `date_collected`, `date_sent_to_lab`, `test_type`, `date_received_in_lab`, `confirming_lab`, `assay_used`, `lab_result`, `sequencing_done`, `lab_confirmation_date`, `investigator`, `created_at`, `updated_at`) VALUES
	(2, 1, 'Yes', '', 'NP Swab', '', '2021-08-11', '2021-08-11', 'GeneXpert', '2021-08-18', 'Mackle Town', 'Negative', 'MTB +, RR', 'Yes', '2021-08-18', 'John Malking', '2021-08-18 09:50:20', '2021-08-18 10:48:11'),
	(7, 1, 'Yes', '', 'Aspirate', '', '2021-09-01', '2021-09-02', 'GeneXpert', '2021-09-03', 'jack', 'jack', 'MTB –', 'Yes', '2021-09-09', 'James', '2021-09-16 11:43:02', '2021-09-16 13:18:17'),
	(8, 1, 'Yes', '', 'Aspirate', '', '2021-09-01', '2021-09-02', 'Culture', NULL, '', '', '', '', NULL, '', '2021-09-16 11:43:02', '2021-09-16 11:43:02'),
	(9, 1, 'Yes', '', 'Aspirate', '', '2021-09-01', '2021-09-02', 'GeneXpert', NULL, '', '', '', '', NULL, '', '2021-09-17 10:49:15', '2021-09-17 10:49:15'),
	(10, 1, 'Yes', '', 'Urine', '', '2021-09-01', '2021-09-02', 'TB LAM', NULL, '', '', '', '', NULL, '', '2021-09-17 10:49:15', '2021-09-17 10:49:15');
/*!40000 ALTER TABLE `lab_requests` ENABLE KEYS */;

-- Dumping structure for table covid_app.number_clients
CREATE TABLE IF NOT EXISTS `number_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '0',
  `prefix` varchar(10) NOT NULL,
  `separator` varchar(1) NOT NULL DEFAULT '',
  `minLength` int(11) NOT NULL DEFAULT 5,
  `lastIndex` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Index 2` (`prefix`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table covid_app.number_clients: ~0 rows (approximately)
/*!40000 ALTER TABLE `number_clients` DISABLE KEYS */;
INSERT IGNORE INTO `number_clients` (`id`, `name`, `prefix`, `separator`, `minLength`, `lastIndex`, `created_at`, `updated_at`) VALUES
	(2, 'Nyeri HC Number client. ', '12345', '/', 5, 10, '2021-08-20 10:27:13', '2021-08-20 13:51:20');
/*!40000 ALTER TABLE `number_clients` ENABLE KEYS */;

-- Dumping structure for table covid_app.patients
CREATE TABLE IF NOT EXISTS `patients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(50) NOT NULL,
  `secondName` varchar(50) DEFAULT NULL,
  `surname` varchar(50) NOT NULL,
  `facility` char(5) NOT NULL,
  `nationalID` varchar(20) NOT NULL,
  `guardianID` varchar(20) NOT NULL,
  `guardianName` varchar(200) NOT NULL,
  `phone` char(10) NOT NULL,
  `race` varchar(50) NOT NULL,
  `citizenship` varchar(50) NOT NULL,
  `gender` enum('Male','Female','') NOT NULL DEFAULT '',
  `maritalStatus` enum('Married','Single','Divorced','Minor','') NOT NULL DEFAULT '',
  `educationLevel` enum('No formal education','Primary','Secondary','Tertiary','') NOT NULL DEFAULT '',
  `dob` date NOT NULL,
  `alive` enum('Yes','No','') NOT NULL DEFAULT 'Yes',
  `caseLocation` varchar(191) NOT NULL,
  `investigatingFacility` varchar(10) NOT NULL DEFAULT '',
  `county` int(11) NOT NULL,
  `subCounty` int(11) NOT NULL,
  `nokName` varchar(50) NOT NULL DEFAULT '',
  `nokPhone` varchar(50) NOT NULL DEFAULT '',
  `occupation` varchar(50) NOT NULL DEFAULT '',
  `source` varchar(50) NOT NULL DEFAULT '',
  `landmark` varchar(50) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table covid_app.patients: ~2 rows (approximately)
/*!40000 ALTER TABLE `patients` DISABLE KEYS */;
INSERT IGNORE INTO `patients` (`id`, `firstName`, `secondName`, `surname`, `facility`, `nationalID`, `guardianID`, `guardianName`, `phone`, `race`, `citizenship`, `gender`, `maritalStatus`, `educationLevel`, `dob`, `alive`, `caseLocation`, `investigatingFacility`, `county`, `subCounty`, `nokName`, `nokPhone`, `occupation`, `source`, `landmark`, `created_at`, `updated_at`) VALUES
	(1, 'Jemimah', 'Wambui', 'Kinyua', '12345', '123', '123', 'Mister', '0733845063', '', 'Lao', 'Female', 'Married', 'Primary', '1995-01-04', 'Yes', '', '', 31, 129, 'joseph', '123123', 'Programmer', 'CCC', 'Martineri', '2021-08-04 16:11:32', '2021-09-17 14:18:34'),
	(2, 'Test', 'Patient', 'Patient', '12345', '34453422', '', 'Jack Mwen', '0733845064', '', 'Kenyan', 'Male', 'Divorced', 'No formal education', '2002-01-02', 'Yes', 'Household', '', 20, 101, 'Joseph Kamau', '0789212121', 'Programmer', '', '', '2021-08-04 16:51:06', '2021-08-04 16:51:06');
/*!40000 ALTER TABLE `patients` ENABLE KEYS */;

-- Dumping structure for table covid_app.patient_histories
CREATE TABLE IF NOT EXISTS `patient_histories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL DEFAULT 0,
  `date_taken` date NOT NULL,
  `taken_by` int(11) NOT NULL DEFAULT 0,
  `travelled` char(20) NOT NULL DEFAULT '',
  `places_travelled` varchar(191) NOT NULL DEFAULT '',
  `contact_with_infected` varchar(191) NOT NULL DEFAULT '',
  `contact_setting` varchar(191) NOT NULL DEFAULT '',
  `vaccinated` varchar(10) NOT NULL DEFAULT '',
  `first_dose` int(11) DEFAULT NULL,
  `first_dose_date` date DEFAULT NULL,
  `second_dose` int(11) DEFAULT NULL,
  `second_dose_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index 2` (`patient_id`),
  CONSTRAINT `FK_patient_histories_patients` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table covid_app.patient_histories: ~0 rows (approximately)
/*!40000 ALTER TABLE `patient_histories` DISABLE KEYS */;
INSERT IGNORE INTO `patient_histories` (`id`, `patient_id`, `date_taken`, `taken_by`, `travelled`, `places_travelled`, `contact_with_infected`, `contact_setting`, `vaccinated`, `first_dose`, `first_dose_date`, `second_dose`, `second_dose_date`, `created_at`, `updated_at`) VALUES
	(1, 1, '2021-09-07', 0, 'Yes', 'e3rer', 'Yes', 'na', 'Yes', 1, '2021-06-10', 0, NULL, '2021-09-07 13:15:04', '2021-09-07 13:15:04');
/*!40000 ALTER TABLE `patient_histories` ENABLE KEYS */;

-- Dumping structure for table covid_app.patient_management
CREATE TABLE IF NOT EXISTS `patient_management` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL DEFAULT 0,
  `symptoms_onset_date` date DEFAULT NULL,
  `admitted_to_hospital` varchar(50) DEFAULT NULL,
  `date_admitted` date DEFAULT NULL,
  `facility_code` varchar(50) NOT NULL DEFAULT '',
  `isolated` varchar(50) NOT NULL DEFAULT '',
  `date_isolated` date DEFAULT NULL,
  `admitted_to_icu` varchar(50) NOT NULL DEFAULT '',
  `ventilated` varchar(50) NOT NULL DEFAULT '',
  `health_status` varchar(50) NOT NULL DEFAULT '',
  `outcome` varchar(50) NOT NULL DEFAULT '',
  `outcome_date` date DEFAULT NULL,
  `symptoms_resolved` varchar(50) NOT NULL DEFAULT '',
  `date_resolved` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_patient_management_patients` (`patient_id`),
  CONSTRAINT `FK_patient_management_patients` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table covid_app.patient_management: ~2 rows (approximately)
/*!40000 ALTER TABLE `patient_management` DISABLE KEYS */;
INSERT IGNORE INTO `patient_management` (`id`, `patient_id`, `symptoms_onset_date`, `admitted_to_hospital`, `date_admitted`, `facility_code`, `isolated`, `date_isolated`, `admitted_to_icu`, `ventilated`, `health_status`, `outcome`, `outcome_date`, `symptoms_resolved`, `date_resolved`, `created_at`, `updated_at`) VALUES
	(1, 1, '2021-08-29', 'No', '0000-00-00', '', 'Yes', '2021-08-31', 'Yes', 'No', 'Stable', 'Discharged', '2021-09-01', 'No', '0000-00-00', '2021-09-01 12:57:16', '2021-09-01 12:57:16'),
	(2, 1, '2021-08-02', 'No', '0000-00-00', '', 'Yes', '2021-08-29', 'Yes', 'Yes', 'Stable', 'Discharged', '2021-08-31', 'No', '0000-00-00', '2021-09-01 13:13:34', '2021-09-01 13:13:34');
/*!40000 ALTER TABLE `patient_management` ENABLE KEYS */;

-- Dumping structure for table covid_app.patient_screening
CREATE TABLE IF NOT EXISTS `patient_screening` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL DEFAULT 0,
  `screened_by` int(11) DEFAULT 0,
  `date_screened` date DEFAULT NULL,
  `fever_history` enum('Yes','No','') NOT NULL DEFAULT '',
  `general_weakness` enum('Yes','No','') NOT NULL DEFAULT '',
  `cough` enum('Yes','No','') NOT NULL DEFAULT '',
  `sore_throat` enum('Yes','No','') NOT NULL DEFAULT '',
  `runny_nose` enum('Yes','No','') NOT NULL DEFAULT '',
  `weight_loss` enum('Yes','No','') NOT NULL DEFAULT '',
  `night_sweats` enum('Yes','No','') NOT NULL DEFAULT '',
  `loss_of_taste` enum('Yes','No','') NOT NULL DEFAULT '',
  `loss_of_smell` enum('Yes','No','') NOT NULL DEFAULT '',
  `breathing_difficulty` enum('Yes','No','') NOT NULL DEFAULT '',
  `diarrhoea` enum('Yes','No','') NOT NULL DEFAULT '',
  `headache` enum('Yes','No','') NOT NULL DEFAULT '',
  `irritability` enum('Yes','No','') NOT NULL DEFAULT '',
  `nausea` enum('Yes','No','') NOT NULL DEFAULT '',
  `shortness_of_breath` enum('Yes','No','') NOT NULL DEFAULT '',
  `pain` enum('Yes','No','') NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_patient_screening_patients` (`patient_id`),
  KEY `FK_patient_screening_users` (`screened_by`),
  CONSTRAINT `FK_patient_screening_patients` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_patient_screening_users` FOREIGN KEY (`screened_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table covid_app.patient_screening: ~0 rows (approximately)
/*!40000 ALTER TABLE `patient_screening` DISABLE KEYS */;
INSERT IGNORE INTO `patient_screening` (`id`, `patient_id`, `screened_by`, `date_screened`, `fever_history`, `general_weakness`, `cough`, `sore_throat`, `runny_nose`, `weight_loss`, `night_sweats`, `loss_of_taste`, `loss_of_smell`, `breathing_difficulty`, `diarrhoea`, `headache`, `irritability`, `nausea`, `shortness_of_breath`, `pain`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, '2021-08-10', 'Yes', 'No', 'Yes', 'No', 'Yes', 'No', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'No', 'No', 'Yes', 'Yes', '2021-08-10 09:39:14', '2021-08-10 09:39:14'),
	(2, 2, 1, '2021-08-17', 'No', 'No', 'No', 'No', 'No', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', '2021-08-17 13:53:58', '2021-08-17 13:53:58');
/*!40000 ALTER TABLE `patient_screening` ENABLE KEYS */;

-- Dumping structure for table covid_app.patient_triage
CREATE TABLE IF NOT EXISTS `patient_triage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL DEFAULT 0,
  `filled_by` int(11) NOT NULL DEFAULT 0,
  `triage_time` timestamp NULL DEFAULT NULL,
  `temperature` double NOT NULL DEFAULT 0,
  `weight` double NOT NULL DEFAULT 0,
  `height` double NOT NULL DEFAULT 0,
  `spo2` double NOT NULL DEFAULT 0,
  `zscore` double NOT NULL DEFAULT 0,
  `cough` char(50) NOT NULL DEFAULT '',
  `difficulty_in_breathing` char(50) NOT NULL DEFAULT '',
  `weight_loss` char(50) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__patients` (`patient_id`),
  KEY `FK__users` (`filled_by`),
  CONSTRAINT `FK__patients` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK__users` FOREIGN KEY (`filled_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table covid_app.patient_triage: ~4 rows (approximately)
/*!40000 ALTER TABLE `patient_triage` DISABLE KEYS */;
INSERT IGNORE INTO `patient_triage` (`id`, `patient_id`, `filled_by`, `triage_time`, `temperature`, `weight`, `height`, `spo2`, `zscore`, `cough`, `difficulty_in_breathing`, `weight_loss`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, '2021-08-05 17:41:35', 37.5, 45.6, 123, 12, 23, '', '', '', '2021-08-05 16:41:35', '2021-08-05 16:41:35'),
	(2, 1, 1, '2021-08-06 10:56:34', 37, 45, 156, 34, 2, '', '', '', '2021-08-06 09:56:34', '2021-08-06 09:56:34'),
	(3, 1, 1, '2021-09-15 15:36:25', 34.5, 45, 134, 2, 12, 'Yes', 'Yes', 'Yes', '2021-09-15 14:36:25', '2021-09-15 14:36:25'),
	(4, 1, 1, '2021-09-17 11:47:15', 35.6, 45, 135, 60, 2, 'No', 'No', 'No', '2021-09-17 10:47:16', '2021-09-17 10:47:16');
/*!40000 ALTER TABLE `patient_triage` ENABLE KEYS */;

-- Dumping structure for table covid_app.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `group_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table covid_app.permissions: ~7 rows (approximately)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT IGNORE INTO `permissions` (`id`, `name`, `group_id`, `created_at`, `updated_at`) VALUES
	(1, 'Add Users', 0, '2021-08-02 15:28:21', '2021-08-02 15:28:22'),
	(2, 'Register new patients', 0, '2021-08-02 15:30:40', '2021-08-02 15:30:41'),
	(3, 'Access Triage Module', 0, '2021-08-02 15:30:42', '2021-08-02 15:30:43'),
	(4, 'Access Laboratory Module', 0, '2021-08-02 15:32:36', '2021-08-02 15:32:38'),
	(5, 'Access Radiology Module', 0, '2021-08-02 15:33:16', '2021-08-02 15:33:17'),
	(6, 'Contact Tracing Module', 0, '2021-08-02 15:33:46', '2021-08-02 15:33:47'),
	(7, 'Access Reports Modules', 0, '2021-08-02 15:36:06', '2021-08-02 15:36:07'),
	(8, 'Access app', 0, '2021-08-03 09:26:51', '2021-08-03 15:27:43');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Dumping structure for table covid_app.projects
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table covid_app.projects: ~4 rows (approximately)
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT IGNORE INTO `projects` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'GoK', '2021-08-02 18:24:43', '2021-08-02 18:24:45'),
	(2, 'CHS Naishi', '2021-08-02 18:25:05', '2021-08-02 18:25:06'),
	(3, 'CHS Tegemeza Plus', '2021-08-02 18:25:36', '2021-08-02 18:25:37'),
	(4, 'CHS Shinda', '2021-08-02 18:25:59', '2021-08-02 18:26:00');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;

-- Dumping structure for table covid_app.radiology_requests
CREATE TABLE IF NOT EXISTS `radiology_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL DEFAULT 0,
  `date_requested` date DEFAULT NULL,
  `date_done` date DEFAULT NULL,
  `test_type` char(50) NOT NULL DEFAULT '',
  `results` varchar(50) NOT NULL DEFAULT '',
  `files` varchar(191) NOT NULL DEFAULT '',
  `comments` varchar(500) NOT NULL DEFAULT '',
  `submitted_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table covid_app.radiology_requests: ~6 rows (approximately)
/*!40000 ALTER TABLE `radiology_requests` DISABLE KEYS */;
INSERT IGNORE INTO `radiology_requests` (`id`, `patient_id`, `date_requested`, `date_done`, `test_type`, `results`, `files`, `comments`, `submitted_by`, `created_at`, `updated_at`) VALUES
	(1, 1, '2021-09-01', '2021-09-02', 'Chest', 'Abnormal Other', '', 'Bgat', 0, '2021-09-16 15:13:22', '2021-09-16 15:13:22'),
	(2, 1, '2021-09-01', '2021-09-03', 'Chest', 'Abnormal Suggestive TB', '', 'trtr', 0, '2021-09-16 16:09:13', '2021-09-16 16:09:13'),
	(3, 1, '2021-09-01', '2021-09-10', 'Chest', 'Abnormal Suggestive TB', 'final_splash_1631867148.png,application_Structure2_1631867148.png', 'None', 0, '2021-09-17 10:25:48', '2021-09-17 10:25:48'),
	(4, 1, '2021-09-01', '2021-09-10', 'Chest', 'Abnormal Other', 'Makueni_Strategic_1631874312.pdf,Matuu_Trip_Report_May_2021_1631874312.pdf,test_1631874312.pdf,KIMANIJOSEPH_passenger_name_1631874312.pdf', 'Nitht', 0, '2021-09-17 12:25:12', '2021-09-17 12:25:12'),
	(5, 1, '2021-09-01', '2021-09-01', 'Chest', 'Normal', 'application_Structure_1631874411.png,SplashscreenLook_1631874411.png', 'Kings', 0, '2021-09-17 12:26:51', '2021-09-17 12:26:51'),
	(6, 1, '2021-09-01', '2021-09-03', 'Chest', 'Abnormal Other', 'JOB_VACANCIES_ADVERTISEMENT_1631879308.pdf,20210913194318004_1631879308.pdf', 'Comments', 1, '2021-09-17 13:48:28', '2021-09-17 13:48:28');
/*!40000 ALTER TABLE `radiology_requests` ENABLE KEYS */;

-- Dumping structure for table covid_app.session_manager
CREATE TABLE IF NOT EXISTS `session_manager` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `jwt` varchar(500) NOT NULL,
  `issuedat` bigint(50) NOT NULL,
  `expires_at` bigint(50) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table covid_app.session_manager: ~4 rows (approximately)
/*!40000 ALTER TABLE `session_manager` DISABLE KEYS */;
INSERT IGNORE INTO `session_manager` (`id`, `userID`, `jwt`, `issuedat`, `expires_at`, `active`, `created_at`, `updated_at`) VALUES
	(1, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpc3MiOiJUaWJhLXRla2VsZXppIiwiaWF0IjoxNjMwMzkzOTU0LCJleHAiOjE2MzAzOTU3NTQsImRhdGEiOnsiaWQiOjF9fQ.LwjABdSUNMMRk7zVqfx_WgMP-64r27WNQSr1CwoZ0QveJgRHYqrN4UzVFk8_QHa0zZRp4tv11nMfGvv4EQWoRdN6YDJe3au6F4FVFO2ZyQZyYbDIRFpRUl6FrUjLL3xmh0GkMNwljrUDpg5H9kpwhXfP7co6T-Kk104LWwMLlcTqXh7Xr2wQoVZ5zgC8WQsD-pMdxEJPLG2hE1XoreZR9JMFtG_OJ6-HwLFevNHS6YhdMd4Cqco8Fra_Ii8w8HSZl1Fd3J_njspV1PwgcDf3ZDl9ckFaUvsJSGmrsM3nFRBIHRobsPE7ADsj1qjbu4ct6Sha4sK4tXj5lJ9l73Kf9Q', 1630393954, 1630395754, 0, '2021-08-31 09:12:34', '2021-08-31 09:51:16'),
	(2, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpc3MiOiJUaWJhLXRla2VsZXppIiwiaWF0IjoxNjMwMzkzOTk0LCJleHAiOjE2MzAzOTU3OTQsImRhdGEiOnsiaWQiOjF9fQ.ks2LWxSogadB4bguFxQ8-b5e9PMQH9Fm8RUuGcu4k0D0B0LOB86nioxbvmfWAPPKAJd3FqfogRmSL6MDWz_BGBuwkdGVwrXgrDoCwP1dbryC36r78f9ipMgD_kZQvBMAIu2pQuGat21HOVLPqHz4iZyf0qUzRXntRCWI5tuVwWpwpNoZk-BWniFEayTGtSYlKvNFD1fY-Va2_wM4Ndb80hifn9lxAb6hSS7BYq8s-fejWYiUndQczFjN_1SpZZcOqvNnO1kw2aCe_CvYO4kQEDyCgsCmVWnwwNq65UV9AZTf3UcizvrvpFp92gz1z0GCiqnUdOBZQnQDXzfeaFy2Cw', 1630393994, 1630395794, 0, '2021-08-31 09:13:15', '2021-08-31 09:51:16'),
	(3, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpc3MiOiJUaWJhLXRla2VsZXppIiwiaWF0IjoxNjMwMzk1NDIzLCJleHAiOjE2MzAzOTcyMjMsImRhdGEiOnsiaWQiOjF9fQ.icWz4hvERQF0ZPQ1RC7euBpNiuHy1B8qEiaG9xDQ-5-at5-igHGBXHou4JVzZxQUTUbjvK3_VhKDNRYSm8zElu-MBClSGbYflni6nUTXbHN_mGvSDHohKlKy26Edehf08CDhBWv6twu6hmZd6kMKXpd6tIlwy4VWslZo97MyW08CE_T1WlXcvbe-qTN13Oz77jwdbaQxT1R2TC9zcDv2uS015RjbPB09kOxFLlSp4bxCusOfGedt2QEVNXJrDsEYpbzQ7KShlMet1XJDLTNuhDS_f-iCt8gQE-DJYq_hsoMrP8JSa7lvaZGrhxN5DhLzUxiEnx50dC-UEfLX36vuQw', 1630395423, 1630397223, 0, '2021-08-31 09:37:03', '2021-08-31 09:51:16'),
	(4, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpc3MiOiJUaWJhLXRla2VsZXppIiwiaWF0IjoxNjMwMzk2Mjc2LCJleHAiOjE2MzAzOTgwNzYsImRhdGEiOnsiaWQiOjF9fQ.JV5yNt24XDFjqssdYYWRaaHQ_3HCiAzTJFOrpieEnn1kmwLxNKEO8xV2wLsqLGyLeh7ofq_iCvYckrdEGZ357He5vAf2B8DQhXeSSFUkpiEuRDITmDmi3bAUXG9r_JYbICNW7nxihFY3NNtxbdaW8plyScBJXDndXHqmsx3vCJJdc5S_a3mO-yRGPg7V5AaDbVk1d5Ku6doIO1aTFx6bZhmp3sHMxTOLBVrMfSoTIZM0RkfJDXtZDYuvycb93nwzVNUdbw1DKZDHFD8dz4RpCkI1rPCjHavqxJJnkPdF725bYK63-KX56Et3WprqomFCYr2aUy_GQuKDpNIrxpHiEA', 1630396276, 1630398076, 1, '2021-08-31 09:51:16', '2021-08-31 09:51:16');
/*!40000 ALTER TABLE `session_manager` ENABLE KEYS */;

-- Dumping structure for table covid_app.sub_counties
CREATE TABLE IF NOT EXISTS `sub_counties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `county_code` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `county_code` (`county_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table covid_app.sub_counties: ~314 rows (approximately)
/*!40000 ALTER TABLE `sub_counties` DISABLE KEYS */;
INSERT IGNORE INTO `sub_counties` (`id`, `name`, `county_code`, `created_at`, `updated_at`) VALUES
	(1, 'Baringo central', 30, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(2, 'Baringo north', 30, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(3, 'Baringo south', 30, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(4, 'Eldama ravine', 30, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(5, 'Mogotio', 30, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(6, 'Tiaty', 30, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(7, 'Bomet central', 36, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(8, 'Bomet east', 36, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(9, 'Chepalungu', 36, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(10, 'Konoin', 36, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(11, 'Sotik', 36, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(12, 'Bumula', 39, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(13, 'Kabuchai', 39, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(14, 'Kanduyi', 39, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(15, 'Kimilil', 39, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(16, 'Mt Elgon', 39, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(17, 'Sirisia', 39, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(18, 'Tongaren', 39, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(19, 'Webuye east', 39, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(20, 'Webuye west', 39, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(21, 'Budalangi', 40, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(22, 'Butula', 40, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(23, 'Funyula', 40, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(24, 'Nambele', 40, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(25, 'Teso North', 40, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(26, 'Teso South', 40, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(27, 'Keiyo north', 28, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(28, 'Keiyo south', 28, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(29, 'Marakwet east', 28, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(30, 'Marakwet west', 28, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(31, 'Manyatta', 14, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(32, 'Mbeere north', 14, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(33, 'Mbeere south', 14, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(34, 'Runyenjes', 14, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(35, 'Daadab', 7, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(36, 'Fafi', 7, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(37, 'Garissa', 7, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(38, 'Hulugho', 7, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(39, 'Ijara', 7, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(40, 'Lagdera balambala', 7, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(41, 'Homabay town', 43, '2021-02-22 11:02:16', '2021-02-22 11:02:16'),
	(42, 'Kabondo', 43, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(43, 'Karachwonyo', 43, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(44, 'Kasipul', 43, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(45, 'Mbita', 43, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(46, 'Ndhiwa', 43, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(47, 'Rangwe', 43, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(48, 'Suba', 43, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(49, 'Central', 11, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(50, 'Garba tula', 11, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(51, 'Kina', 11, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(52, 'Merit', 11, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(53, 'Oldonyiro', 11, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(54, 'Sericho', 11, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(55, 'Isinya.', 34, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(56, 'Kajiado Central.', 34, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(57, 'Kajiado North.', 34, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(58, 'Loitokitok.', 34, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(59, 'Mashuuru.', 34, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(60, 'Butere', 37, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(61, 'Kakamega central', 37, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(62, 'Kakamega east', 37, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(63, 'Kakamega north', 37, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(64, 'Kakamega south', 37, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(65, 'Khwisero', 37, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(66, 'Lugari', 37, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(67, 'Lukuyani', 37, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(68, 'Lurambi', 37, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(69, 'Matete', 37, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(70, 'Mumias', 37, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(71, 'Mutungu', 37, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(72, 'Navakholo', 37, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(73, 'Ainamoi', 35, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(74, 'Belgut', 35, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(75, 'Bureti', 35, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(76, 'Kipkelion east', 35, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(77, 'Kipkelion west', 35, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(78, 'Soin sigowet', 35, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(79, 'Gatundu north', 22, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(80, 'Gatundu south', 22, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(81, 'Githunguri', 22, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(82, 'Juja', 22, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(83, 'Kabete', 22, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(84, 'Kiambaa', 22, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(85, 'Kiambu', 22, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(86, 'Kikuyu', 22, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(87, 'Limuru', 22, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(88, 'Ruiru', 22, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(89, 'Thika town', 22, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(90, 'lari', 22, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(91, 'Genzw', 3, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(92, 'Kaloleni', 3, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(93, 'Kilifi north', 3, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(94, 'Kilifi south', 3, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(95, 'Magarini', 3, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(96, 'Malindi', 3, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(97, 'Rabai', 3, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(98, 'Kirinyaga central', 20, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(99, 'Kirinyaga east', 20, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(100, 'Kirinyaga west', 20, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(101, 'Mwea east', 20, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(102, 'Mwea west', 20, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(103, 'Kisumu central', 42, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(104, 'Kisumu east ', 42, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(105, 'Kisumu west', 42, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(106, 'Mohoroni', 42, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(107, 'Nyakach', 42, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(108, 'Nyando', 42, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(109, 'Seme', 42, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(110, 'Ikutha', 15, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(111, 'Katulani', 15, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(112, 'Kisasi', 15, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(113, 'Kitui central', 15, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(114, 'Kitui west ', 15, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(115, 'Lower yatta', 15, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(116, 'Matiyani', 15, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(117, 'Migwani', 15, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(118, 'Mutitu', 15, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(119, 'Mutomo', 15, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(120, 'Muumonikyusu', 15, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(121, 'Mwingi central', 15, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(122, 'Mwingi east', 15, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(123, 'Nzambani', 15, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(124, 'Tseikuru', 15, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(125, 'Kinango', 2, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(126, 'Lungalunga', 2, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(127, 'Msambweni', 2, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(128, 'Mutuga', 2, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(129, 'Laikipia central', 31, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(130, 'Laikipia east', 31, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(131, 'Laikipia north', 31, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(132, 'Laikipia west ', 31, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(133, 'Nyahururu', 31, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(134, 'Lamu East', 5, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(135, 'Lamu West', 5, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(136, 'Kathiani', 16, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(137, 'Machakos town', 16, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(138, 'Masinga', 16, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(139, 'Matungulu', 16, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(140, 'Mavoko', 16, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(141, 'Mwala', 16, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(142, 'Yatta', 16, '2021-02-22 11:02:17', '2021-02-22 11:02:17'),
	(143, 'Kaiti', 17, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(144, 'Kibwezi west', 17, '2021-02-22 11:02:18', '2021-03-08 10:39:30'),
	(145, 'Kibwezi east', 17, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(146, 'Kilome', 17, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(147, 'Makueni', 17, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(148, 'Mbooni', 17, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(149, 'Banissa', 9, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(150, 'Lafey', 9, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(151, 'Mandera East', 9, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(152, 'Mandera North', 9, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(153, 'Mandera South', 9, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(154, 'Mandera West', 9, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(155, 'Laisamis', 10, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(156, 'Moyale', 10, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(157, 'North hor', 10, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(158, 'Saku', 10, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(159, 'Buuri', 12, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(160, 'Igembe central', 12, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(161, 'Igembe north', 12, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(162, 'Igembe south', 12, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(163, 'Imenti central', 12, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(164, 'Imenti north', 12, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(165, 'Imenti south', 12, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(166, 'Tigania east', 12, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(167, 'Tigania west', 12, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(168, 'Awendo', 44, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(169, 'Kuria east', 44, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(170, 'Kuria west', 44, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(171, 'Nyatike', 44, '2021-02-22 11:02:18', '2021-04-14 16:37:15'),
	(172, 'Ntimaru', 44, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(173, 'Rongo', 44, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(174, 'Suna east', 44, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(175, 'Suna west', 44, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(176, 'Uriri', 44, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(177, 'Changamwe', 1, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(178, 'Jomvu', 1, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(179, 'Kisauni', 1, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(180, 'Likoni', 1, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(181, 'Mvita', 1, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(182, 'Nyali', 1, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(183, 'Gatanga', 21, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(184, 'Kahuro', 21, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(185, 'Kandara', 21, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(186, 'Kangema', 21, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(187, 'Kigumo', 21, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(188, 'Kiharu', 21, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(189, 'Mathioya', 21, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(190, 'Murang\'a South', 21, '2021-02-22 11:02:18', '2021-03-29 17:09:21'),
	(191, 'Dagoretti North Sub County', 47, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(192, 'Dagoretti South Sub County ', 47, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(193, 'Embakasi Central Sub County', 47, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(194, 'Embakasi East Sub County', 47, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(195, 'Embakasi North Sub County ', 47, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(196, 'Embakasi South Sub County', 47, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(197, 'Embakasi West Sub County', 47, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(198, 'Kamukunji Sub County', 47, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(199, 'Kasarani Sub County ', 47, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(200, 'Kibra Sub County ', 47, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(201, 'Lang\'ata Sub County ', 47, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(202, 'Makadara Sub County', 47, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(203, 'Mathare Sub County ', 47, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(204, 'Roysambu Sub County ', 47, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(205, 'Ruaraka Sub County ', 47, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(206, 'Starehe Sub County ', 47, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(207, 'Westlands Sub County ', 47, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(208, 'Bahati', 32, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(209, 'Gilgil', 32, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(210, 'Kuresoi north', 32, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(211, 'Kuresoi south', 32, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(212, 'Molo', 32, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(213, 'Naivasha', 32, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(214, 'Nakuru town east', 32, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(215, 'Nakuru town west', 32, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(216, 'Njoro', 32, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(217, 'Rongai', 32, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(218, 'Subukia', 32, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(219, 'Aldai', 29, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(220, 'Chesumei', 29, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(221, 'Emgwen', 29, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(222, 'Mosop', 29, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(223, 'Namdi hills', 29, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(224, 'Tindiret', 29, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(225, 'Narok east', 33, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(226, 'Narok north', 33, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(227, 'Narok south', 33, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(228, 'Narok west', 33, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(229, 'Transmara east', 33, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(230, 'Transmara west', 33, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(231, 'Borabu', 46, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(232, 'Manga', 46, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(233, 'Masaba north', 46, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(234, 'Nyamira north', 46, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(235, 'Nyamira south', 46, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(236, 'Kinangop', 18, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(237, 'Kipipiri', 18, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(238, 'Ndaragwa', 18, '2021-02-22 11:02:18', '2021-02-22 11:02:18'),
	(239, 'Olkalou', 18, '2021-02-22 11:02:18', '2021-03-29 16:43:16'),
	(240, 'Oljororok', 18, '2021-02-22 11:02:18', '2021-03-29 16:43:09'),
	(241, 'Kieni East', 19, '2021-02-22 11:02:18', '2021-03-29 16:54:04'),
	(242, 'Kieni West', 19, '2021-02-22 11:02:18', '2021-03-29 16:54:09'),
	(243, 'Mathira East', 19, '2021-02-22 11:02:18', '2021-03-29 16:54:15'),
	(244, 'Mathira West', 19, '2021-02-22 11:02:18', '2021-03-29 16:54:19'),
	(245, 'Mukurweini', 19, '2021-02-22 11:02:18', '2021-03-29 16:34:02'),
	(246, 'Nyeri Town', 19, '2021-02-22 11:02:19', '2021-03-29 16:54:24'),
	(247, 'Othaya', 19, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(248, 'Tetu', 19, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(249, 'Samburu east', 25, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(250, 'Samburu north', 25, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(251, 'Samburu west', 25, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(252, 'Alego usonga', 41, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(253, 'Bondo', 41, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(254, 'Gem', 41, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(255, 'Rarieda', 41, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(256, 'Ugenya', 41, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(257, 'Ugunja', 41, '2021-02-22 11:02:19', '2021-04-08 14:31:08'),
	(258, 'Mwatate', 6, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(259, 'Taveta', 6, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(260, 'Voi', 6, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(261, 'Wundanyi', 6, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(262, 'Bura', 4, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(263, 'Galole', 4, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(264, 'Garsen', 4, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(265, 'Chuka', 13, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(266, 'Igambangobe', 13, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(267, 'Maara', 13, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(268, 'Muthambi', 13, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(269, 'Tharak north', 13, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(270, 'Tharaka south', 13, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(271, 'Cherangany', 26, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(272, 'Endebess', 26, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(273, 'Kiminini', 26, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(274, 'Kwanza', 26, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(275, 'Saboti', 26, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(276, 'Loima', 23, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(277, 'Turkana central', 23, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(278, 'Turkana east', 23, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(279, 'Turkana north', 23, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(280, 'Turkana south', 23, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(281, 'Ainabkoi', 27, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(282, 'Kapseret', 27, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(283, 'Kesses', 27, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(284, 'Moiben', 27, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(285, 'Soy', 27, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(286, 'Turbo', 27, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(287, 'Emuhaya', 38, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(288, 'Hamisi', 38, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(289, 'Luanda', 38, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(290, 'Sabatia', 38, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(291, 'vihiga', 38, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(292, 'Eldas', 8, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(293, 'Tarbaj', 8, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(294, 'Wajir East', 8, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(295, 'Wajir North', 8, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(296, 'Wajir South', 8, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(297, 'Wajir West', 8, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(298, 'Central Pokot', 24, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(299, 'North Pokot', 24, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(300, 'Pokot South', 24, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(301, 'West Pokot', 24, '2021-02-22 11:02:19', '2021-02-22 11:02:19'),
	(302, 'Kalama', 16, '2021-02-25 09:29:30', NULL),
	(303, 'Kangundo', 16, '2021-02-25 09:29:30', NULL),
	(304, 'Bonchari', 45, '2021-03-04 11:17:48', NULL),
	(305, 'Kitutu Chache North', 45, '2021-03-04 11:17:48', NULL),
	(306, 'Kitutu Chache South', 45, '2021-03-04 11:18:14', NULL),
	(307, 'South Mugirango', 45, '2021-03-04 11:18:14', NULL),
	(308, 'Bobasi', 45, '2021-03-04 11:18:34', NULL),
	(309, 'Bomachoge Borabu', 45, '2021-03-04 11:18:34', NULL),
	(310, 'Bomachoge Chache', 45, '2021-03-04 11:19:04', NULL),
	(311, 'Nyaribari Chache', 45, '2021-03-04 11:19:04', NULL),
	(312, 'Nyaribari Masaba', 45, '2021-03-04 11:19:14', NULL),
	(313, 'Nyeri South', 19, '2021-03-29 16:35:12', NULL),
	(314, 'Nyeri Central', 19, '2021-03-29 16:35:12', NULL);
/*!40000 ALTER TABLE `sub_counties` ENABLE KEYS */;

-- Dumping structure for table covid_app.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `names` varchar(200) NOT NULL,
  `gender` enum('Male','Female') NOT NULL DEFAULT 'Male',
  `phone` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `project` int(11) NOT NULL,
  `facility` int(11) NOT NULL DEFAULT 0,
  `category` int(11) NOT NULL DEFAULT 0,
  `password` varchar(191) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 0,
  `last_login` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `Index 2` (`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table covid_app.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT IGNORE INTO `users` (`id`, `names`, `gender`, `phone`, `email`, `project`, `facility`, `category`, `password`, `active`, `last_login`, `created_at`, `updated_at`) VALUES
	(1, 'Joseph Kimani', 'Male', '0717845485', 'jkimani@chskenya.org', 2, 0, 7, '$2y$10$/HWYIIyBfLij5.97eZVdmeRyZLjFcgtCoO8nzyqpq26913gvv1lOi', 1, '2021-09-17 01:47:13', '2021-08-03 06:32:08', '2021-09-17 13:47:13'),
	(2, 'Kevin Kamenwa', 'Male', '0721218922', 'kkamenwa@chskenya.org', 2, 0, 8, '$2y$10$4mAgfDuEWYeOUnXH6jJu4O9.O1cZIL559XMzKTF4XQ1ThyN0mQ.7G', 1, '2021-08-04 04:34:51', '2021-08-04 16:33:18', '2021-08-04 16:34:51');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table covid_app.user_categories
CREATE TABLE IF NOT EXISTS `user_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `access_level` enum('project','county','subcounty','facility') NOT NULL DEFAULT 'facility',
  `permissions` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table covid_app.user_categories: ~2 rows (approximately)
/*!40000 ALTER TABLE `user_categories` DISABLE KEYS */;
INSERT IGNORE INTO `user_categories` (`id`, `name`, `description`, `access_level`, `permissions`, `created_at`, `updated_at`) VALUES
	(7, 'Teat', 'Tester', 'facility', '["5","7","8"]', '2021-08-02 16:41:14', '2021-08-02 20:52:58'),
	(8, 'Category 2', 'This is category 2', 'county', '["2","6","7"]', '2021-08-02 20:51:35', '2021-08-03 11:38:10'),
	(9, 'Lab Clinician', 'A default user category for lab access', 'facility', '["4"]', '2021-08-18 13:14:38', '2021-08-18 13:14:38');
/*!40000 ALTER TABLE `user_categories` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
