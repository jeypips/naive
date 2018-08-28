-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 28, 2018 at 01:07 PM
-- Server version: 5.7.11
-- PHP Version: 7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `naive`
--

-- --------------------------------------------------------

--
-- Table structure for table `cmci`
--

CREATE TABLE `cmci` (
  `id` int(11) NOT NULL,
  `lgu_id` int(11) DEFAULT NULL,
  `period_covered` varchar(50) DEFAULT NULL,
  `system_log` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_log` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cmci`
--

INSERT INTO `cmci` (`id`, `lgu_id`, `period_covered`, `system_log`, `update_log`) VALUES
(1, 125, '2018', '2018-08-28 12:32:30', '2018-08-28 12:32:30');

-- --------------------------------------------------------

--
-- Table structure for table `economy`
--

CREATE TABLE `economy` (
  `id` int(11) NOT NULL,
  `cmci_id` int(11) DEFAULT NULL,
  `local_economy_size` text,
  `local_economy_growth` text,
  `local_economy_structure` text,
  `safety_compliant_business` text,
  `increase_in_employment` text,
  `cost_of_living` text,
  `cost_of_doing_business` text,
  `financial_deepening` text,
  `productivity` text,
  `presence_of_business_and_professional` text,
  `system_log` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_log` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `economy`
--

INSERT INTO `economy` (`id`, `cmci_id`, `local_economy_size`, `local_economy_growth`, `local_economy_structure`, `safety_compliant_business`, `increase_in_employment`, `cost_of_living`, `cost_of_doing_business`, `financial_deepening`, `productivity`, `presence_of_business_and_professional`, `system_log`, `update_log`) VALUES
(1, 1, '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '2018-08-28 12:32:30', '2018-08-28 12:32:30');

-- --------------------------------------------------------

--
-- Table structure for table `government_efficiency`
--

CREATE TABLE `government_efficiency` (
  `id` int(11) NOT NULL,
  `cmci_id` int(11) DEFAULT NULL,
  `compliance_to_national_directives` text,
  `investment_promotion_unit` text,
  `registration_efficiency` text,
  `generate_local_resource` text,
  `capacity_of_health_services` text,
  `capacity_of_school_services` text,
  `recognition_of_performance` text,
  `business_permits_and_licensing` text,
  `peace_and_order` text,
  `social_protection` text,
  `system_log` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_log` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `government_efficiency`
--

INSERT INTO `government_efficiency` (`id`, `cmci_id`, `compliance_to_national_directives`, `investment_promotion_unit`, `registration_efficiency`, `generate_local_resource`, `capacity_of_health_services`, `capacity_of_school_services`, `recognition_of_performance`, `business_permits_and_licensing`, `peace_and_order`, `social_protection`, `system_log`, `update_log`) VALUES
(1, 1, '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '2018-08-28 12:32:31', '2018-08-28 12:32:31');

-- --------------------------------------------------------

--
-- Table structure for table `infrastructure`
--

CREATE TABLE `infrastructure` (
  `id` int(11) NOT NULL,
  `cmci_id` int(11) DEFAULT NULL,
  `road_network` text,
  `distance_to_ports` text,
  `availability_of_basic_utilities` text,
  `transportation_vehicles` text,
  `education` text,
  `health` text,
  `lgu_investment` text,
  `accommodation_capacity` text,
  `information_technology_capacity` text,
  `financial_technology_capacity` text,
  `system_log` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_log` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `infrastructure`
--

INSERT INTO `infrastructure` (`id`, `cmci_id`, `road_network`, `distance_to_ports`, `availability_of_basic_utilities`, `transportation_vehicles`, `education`, `health`, `lgu_investment`, `accommodation_capacity`, `information_technology_capacity`, `financial_technology_capacity`, `system_log`, `update_log`) VALUES
(1, 1, '4', '4', '4', '4', '4', '4', '4', '4', '4', '4', '2018-08-28 12:32:31', '2018-08-28 12:32:31');

-- --------------------------------------------------------

--
-- Table structure for table `lgus`
--

CREATE TABLE `lgus` (
  `id` int(11) NOT NULL,
  `lgu_no` int(11) DEFAULT NULL,
  `municipality` int(11) DEFAULT NULL,
  `province` int(11) DEFAULT NULL,
  `classification` varchar(50) DEFAULT NULL,
  `system_log` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_log` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lgus`
--

INSERT INTO `lgus` (`id`, `lgu_no`, `municipality`, `province`, `classification`, `system_log`, `update_log`) VALUES
(1, 1, 35, 2, '1', '2018-08-28 10:50:45', '2018-08-28 10:50:45'),
(2, 2, 120, 4, '1', '2018-08-28 11:26:19', '2018-08-28 11:26:19'),
(3, 3, 59, 3, '1', '2018-08-28 11:26:36', '2018-08-28 11:26:36'),
(4, 4, 134, 4, '1', '2018-08-28 11:26:59', '2018-08-28 11:26:59'),
(5, 5, 90, 4, '1', '2018-08-28 11:27:11', '2018-08-28 11:27:11'),
(6, 6, 42, 2, '1', '2018-08-28 11:27:30', '2018-08-28 11:27:30'),
(7, 7, 87, 3, '1', '2018-08-28 11:27:47', '2018-08-28 11:27:47'),
(8, 8, 9, 1, '1', '2018-08-28 11:28:00', '2018-08-28 11:28:00'),
(9, 9, 105, 4, '1', '2018-08-28 11:28:13', '2018-08-28 11:28:13'),
(10, 10, 16, 1, '2', '2018-08-28 11:28:29', '2018-08-28 11:28:29'),
(11, 11, 104, 4, '2', '2018-08-28 11:28:46', '2018-08-28 11:28:46'),
(12, 12, 114, 4, '2', '2018-08-28 11:29:02', '2018-08-28 11:29:02'),
(13, 13, 86, 3, '2', '2018-08-28 11:29:15', '2018-08-28 11:29:15'),
(14, 14, 10, 1, '2', '2018-08-28 11:29:33', '2018-08-28 11:29:33'),
(15, 15, 98, 4, '2', '2018-08-28 11:29:48', '2018-08-28 11:29:48'),
(16, 16, 110, 4, '2', '2018-08-28 11:30:01', '2018-08-28 11:30:01'),
(17, 17, 11, 1, '2', '2018-08-28 11:30:30', '2018-08-28 11:30:30'),
(18, 18, 67, 3, '2', '2018-08-28 11:30:46', '2018-08-28 11:30:46'),
(19, 19, 77, 3, '2', '2018-08-28 11:31:03', '2018-08-28 11:31:03'),
(20, 20, 50, 2, '2', '2018-08-28 11:31:19', '2018-08-28 11:31:19'),
(21, 21, 8, 1, '2', '2018-08-28 11:31:32', '2018-08-28 11:31:32'),
(22, 22, 3, 1, '2', '2018-08-28 11:31:43', '2018-08-28 11:31:43'),
(23, 23, 20, 1, '2', '2018-08-28 11:31:58', '2018-08-28 11:31:58'),
(24, 24, 124, 4, '2', '2018-08-28 11:32:14', '2018-08-28 11:32:14'),
(25, 25, 791, 4, '2', '2018-08-28 11:32:43', '2018-08-28 11:32:43'),
(26, 26, 102, 4, '2', '2018-08-28 11:33:37', '2018-08-28 11:33:37'),
(27, 27, 58, 3, '2', '2018-08-28 11:34:01', '2018-08-28 11:34:01'),
(28, 28, 135, 4, '2', '2018-08-28 11:34:21', '2018-08-28 11:34:21'),
(29, 29, 15, 1, '2', '2018-08-28 11:34:42', '2018-08-28 11:34:42'),
(30, 30, 118, 4, '2', '2018-08-28 11:34:59', '2018-08-28 11:34:59'),
(31, 31, 119, 4, '2', '2018-08-28 11:35:15', '2018-08-28 11:35:15'),
(32, 32, 130, 4, '2', '2018-08-28 11:35:29', '2018-08-28 11:35:29'),
(33, 33, 7, 1, '2', '2018-08-28 11:35:43', '2018-08-28 11:35:43'),
(34, 34, 99, 4, '2', '2018-08-28 11:36:00', '2018-08-28 11:36:00'),
(35, 35, 53, 2, '2', '2018-08-28 11:39:47', '2018-08-28 11:39:47'),
(36, 36, 112, 4, '2', '2018-08-28 11:40:20', '2018-08-28 11:40:20'),
(37, 37, 115, 4, '2', '2018-08-28 11:40:36', '2018-08-28 11:40:36'),
(38, 38, 121, 4, '2', '2018-08-28 11:40:55', '2018-08-28 11:40:55'),
(39, 39, 132, 4, '2', '2018-08-28 11:41:06', '2018-08-28 11:41:06'),
(40, 40, 39, 2, '2', '2018-08-28 11:41:47', '2018-08-28 11:41:47'),
(41, 41, 101, 4, '2', '2018-08-28 11:42:09', '2018-08-28 11:42:09'),
(42, 42, 95, 4, '2', '2018-08-28 11:42:25', '2018-08-28 11:42:25'),
(43, 43, 93, 4, '2', '2018-08-28 11:42:39', '2018-08-28 11:42:39'),
(44, 44, 113, 4, '2', '2018-08-28 11:42:55', '2018-08-28 11:42:55'),
(45, 45, 100, 4, '2', '2018-08-28 11:43:33', '2018-08-28 11:43:33'),
(46, 46, 126, 4, '2', '2018-08-28 11:43:48', '2018-08-28 11:43:48'),
(47, 47, 131, 4, '3', '2018-08-28 11:44:41', '2018-08-28 11:44:41'),
(48, 48, 78, 3, '3', '2018-08-28 11:45:05', '2018-08-28 11:45:05'),
(49, 49, 129, 4, '3', '2018-08-28 11:45:21', '2018-08-28 11:45:21'),
(50, 50, 19, 1, '3', '2018-08-28 11:45:33', '2018-08-28 11:45:33'),
(51, 51, 32, 2, '3', '2018-08-28 11:45:50', '2018-08-28 11:45:50'),
(52, 52, 106, 4, '3', '2018-08-28 11:46:25', '2018-08-28 11:46:25'),
(53, 53, 89, 4, '3', '2018-08-28 11:46:52', '2018-08-28 11:46:52'),
(54, 54, 81, 3, '3', '2018-08-28 11:47:08', '2018-08-28 11:47:08'),
(55, 55, 109, 4, '3', '2018-08-28 11:47:30', '2018-08-28 11:47:30'),
(56, 56, 56, 3, '3', '2018-08-28 11:47:49', '2018-08-28 11:47:49'),
(57, 57, 75, 3, '3', '2018-08-28 11:48:29', '2018-08-28 11:48:29'),
(58, 58, 97, 4, '3', '2018-08-28 11:48:44', '2018-08-28 11:48:44'),
(59, 59, 125, 4, '3', '2018-08-28 11:49:01', '2018-08-28 11:49:01'),
(60, 60, 73, 3, '3', '2018-08-28 11:49:27', '2018-08-28 11:49:27'),
(61, 61, 80, 3, '3', '2018-08-28 11:49:42', '2018-08-28 11:49:42'),
(62, 62, 72, 3, '3', '2018-08-28 11:50:19', '2018-08-28 11:50:19'),
(63, 63, 83, 3, '3', '2018-08-28 11:50:45', '2018-08-28 11:50:45'),
(64, 64, 64, 3, '3', '2018-08-28 11:51:06', '2018-08-28 11:51:06'),
(65, 65, 79, 3, '3', '2018-08-28 11:51:55', '2018-08-28 11:51:55'),
(66, 66, 127, 4, '3', '2018-08-28 11:52:25', '2018-08-28 11:52:25'),
(67, 67, 74, 3, '3', '2018-08-28 11:52:42', '2018-08-28 11:52:42'),
(68, 68, 17, 1, '3', '2018-08-28 11:52:59', '2018-08-28 11:52:59'),
(69, 69, 60, 3, '3', '2018-08-28 11:53:13', '2018-08-28 11:53:13'),
(70, 70, 1, 1, '3', '2018-08-28 11:53:35', '2018-08-28 11:53:35'),
(71, 71, 61, 3, '3', '2018-08-28 11:53:48', '2018-08-28 11:53:48'),
(72, 72, 54, 3, '3', '2018-08-28 11:54:01', '2018-08-28 11:54:01'),
(73, 73, 117, 4, '3', '2018-08-28 11:54:21', '2018-08-28 11:54:21'),
(74, 74, 52, 2, '3', '2018-08-28 11:56:57', '2018-08-28 11:56:57'),
(75, 75, 33, 2, '3', '2018-08-28 11:57:07', '2018-08-28 11:57:07'),
(76, 76, 47, 2, '3', '2018-08-28 11:57:26', '2018-08-28 11:57:26'),
(77, 77, 69, 3, '3', '2018-08-28 11:57:50', '2018-08-28 11:57:50'),
(78, 78, 46, 2, '3', '2018-08-28 11:58:05', '2018-08-28 11:58:05'),
(79, 79, 55, 3, '3', '2018-08-28 11:58:27', '2018-08-28 11:58:27'),
(80, 80, 76, 3, '3', '2018-08-28 11:58:52', '2018-08-28 11:58:52'),
(81, 81, 103, 4, '3', '2018-08-28 11:59:08', '2018-08-28 11:59:08'),
(82, 82, 71, 3, '3', '2018-08-28 11:59:21', '2018-08-28 11:59:21'),
(83, 83, 5, 1, '3', '2018-08-28 11:59:42', '2018-08-28 11:59:42'),
(84, 84, 45, 2, '3', '2018-08-28 11:59:55', '2018-08-28 11:59:55'),
(85, 85, 70, 3, '3', '2018-08-28 12:00:06', '2018-08-28 12:00:06'),
(86, 86, 51, 2, '3', '2018-08-28 12:00:19', '2018-08-28 12:00:19'),
(87, 87, 111, 4, '3', '2018-08-28 12:00:39', '2018-08-28 12:00:39'),
(88, 88, 34, 2, '3', '2018-08-28 12:01:04', '2018-08-28 12:01:04'),
(89, 89, 38, 2, '3', '2018-08-28 12:01:17', '2018-08-28 12:01:17'),
(90, 90, 96, 4, '3', '2018-08-28 12:01:37', '2018-08-28 12:01:37'),
(91, 91, 88, 4, '3', '2018-08-28 12:01:48', '2018-08-28 12:01:48'),
(92, 92, 6, 1, '3', '2018-08-28 12:02:05', '2018-08-28 12:02:05'),
(93, 93, 18, 1, '3', '2018-08-28 12:02:17', '2018-08-28 12:02:17'),
(94, 94, 133, 4, '3', '2018-08-28 12:02:36', '2018-08-28 12:02:36'),
(95, 95, 84, 3, '3', '2018-08-28 12:02:52', '2018-08-28 12:02:52'),
(96, 96, 870, 2, '3', '2018-08-28 12:08:35', '2018-08-28 12:08:35'),
(97, 97, 2, 1, '3', '2018-08-28 12:08:56', '2018-08-28 12:08:56'),
(98, 98, 108, 4, '3', '2018-08-28 12:09:06', '2018-08-28 12:09:06'),
(99, 99, 14, 1, '3', '2018-08-28 12:09:17', '2018-08-28 12:09:17'),
(100, 100, 107, 4, '3', '2018-08-28 12:09:32', '2018-08-28 12:09:32'),
(101, 101, 66, 3, '3', '2018-08-28 12:09:51', '2018-08-28 12:09:51'),
(102, 102, 49, 2, '3', '2018-08-28 12:10:06', '2018-08-28 12:10:06'),
(103, 103, 68, 3, '3', '2018-08-28 12:10:22', '2018-08-28 12:10:22'),
(104, 104, 57, 3, '3', '2018-08-28 12:10:37', '2018-08-28 12:10:37'),
(105, 105, 48, 2, '3', '2018-08-28 12:11:10', '2018-08-28 12:11:10'),
(106, 106, 85, 3, '3', '2018-08-28 12:11:24', '2018-08-28 12:11:24'),
(107, 107, 62, 3, '3', '2018-08-28 12:11:39', '2018-08-28 12:11:39'),
(108, 108, 13, 1, '3', '2018-08-28 12:11:56', '2018-08-28 12:11:56'),
(109, 109, 128, 4, '3', '2018-08-28 12:12:12', '2018-08-28 12:12:12'),
(110, 110, 94, 4, '3', '2018-08-28 12:12:32', '2018-08-28 12:12:32'),
(111, 111, 91, 4, '3', '2018-08-28 12:12:52', '2018-08-28 12:12:52'),
(112, 112, 12, 1, '3', '2018-08-28 12:13:05', '2018-08-28 12:13:05'),
(113, 113, 31, 2, '3', '2018-08-28 12:13:19', '2018-08-28 12:13:19'),
(114, 114, 63, 3, '3', '2018-08-28 12:13:32', '2018-08-28 12:13:32'),
(115, 115, 37, 2, '3', '2018-08-28 12:13:46', '2018-08-28 12:13:46'),
(116, 116, 40, 2, '3', '2018-08-28 12:14:11', '2018-08-28 12:14:11'),
(117, 117, 44, 2, '3', '2018-08-28 12:14:28', '2018-08-28 12:14:28'),
(118, 118, 43, 2, '3', '2018-08-28 12:14:43', '2018-08-28 12:14:43'),
(119, 119, 82, 3, '3', '2018-08-28 12:29:42', '2018-08-28 12:29:42'),
(120, 120, 4, 1, '3', '2018-08-28 12:29:58', '2018-08-28 12:29:58'),
(121, 121, 65, 3, '3', '2018-08-28 12:30:10', '2018-08-28 12:30:10'),
(122, 122, 92, 4, '3', '2018-08-28 12:30:24', '2018-08-28 12:30:24'),
(123, 123, 116, 4, '3', '2018-08-28 12:30:38', '2018-08-28 12:30:38'),
(124, 124, 36, 2, '3', '2018-08-28 12:30:58', '2018-08-28 12:30:58'),
(125, 125, 122, 4, '3', '2018-08-28 12:31:07', '2018-08-28 12:31:07');

-- --------------------------------------------------------

--
-- Table structure for table `municipalities`
--

CREATE TABLE `municipalities` (
  `municipality_id` int(10) NOT NULL,
  `municipality_province` int(10) DEFAULT NULL,
  `municipality_code` varchar(10) DEFAULT NULL,
  `municipality_description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `municipalities`
--

INSERT INTO `municipalities` (`municipality_id`, `municipality_province`, `municipality_code`, `municipality_description`) VALUES
(1, 1, '1A', 'SUDIPEN'),
(2, 1, '1B', 'BANGAR'),
(3, 1, '1C', 'BALAOAN'),
(4, 1, '1D', 'LUNA'),
(5, 1, '1E', 'SANTOL'),
(6, 1, '1F', 'SAN GABRIEL'),
(7, 1, '1G', 'BACNOTAN'),
(8, 1, '1H', 'SAN JUAN'),
(9, 1, 'CT1', 'SAN FERNANDO CITY'),
(10, 1, '2A', 'BAUANG'),
(11, 1, '2B', 'NAGUILIAN'),
(12, 1, '2C', 'BURGOS'),
(13, 1, '2D', 'BAGULIN'),
(14, 1, '2E', 'CABA'),
(15, 1, '2F', 'ARINGAY'),
(16, 1, '2G', 'AGOO'),
(17, 1, '2H', 'TUBAO'),
(18, 1, '2I', 'PUGO'),
(19, 1, '2J', 'SANTO TOMAS'),
(20, 1, '2K', 'ROSARIO'),
(21, 13, '129', 'UGONG NORTE 1110'),
(22, 13, '130', 'UNANG SIGAW 1106'),
(23, 13, '131', 'U.P. CAMPUS 1101'),
(24, 13, '132', 'U.P. VILLAGE 1101'),
(25, 13, '133', 'VALENCIA 1112'),
(26, 13, '134', 'VASRA 1100'),
(27, 13, '135', 'VETERANS VILLAGES 1105'),
(28, 13, '136', 'VILLA MARIA CLARA 1109'),
(29, 13, '167', 'WEST TRIANGLE 1104'),
(30, 13, '166', 'WHITE PLAINS 1110'),
(31, 2, 'A1', 'ADAMS'),
(32, 2, 'A2', 'BACARRA'),
(33, 2, 'A3', 'BADOC'),
(34, 2, 'A4', 'BANGUI'),
(35, 2, 'A5', 'BATAC'),
(36, 2, 'A6', 'BURGOS'),
(37, 2, 'A7', 'CARASI'),
(38, 2, 'A8', 'CURRIMAO'),
(39, 2, 'A9', 'DINGRAS'),
(40, 2, 'A10', 'DUMALENG'),
(41, 2, 'A11', 'ESPIRITU'),
(42, 2, 'A12', 'LAOAG CITY'),
(43, 2, 'A13', 'MARCOS'),
(44, 2, 'A14', 'NUEVA ERA'),
(45, 2, 'A15', 'PAGUDPUD'),
(46, 2, 'A16', 'PAOAY'),
(47, 2, 'A17', 'PASUQUIN'),
(48, 2, 'A18', 'PIDDIG'),
(49, 2, 'A19', 'PINILI'),
(50, 2, 'A20', 'SAN NICOLAS'),
(51, 2, 'A21', 'SARRAT'),
(52, 2, 'A22', 'SOLSONA'),
(53, 2, 'A23', 'VINTAR'),
(54, 3, 'B1', 'ALILEM'),
(55, 3, 'B2', 'BANAYOYO'),
(56, 3, 'B3', 'BANTAY'),
(57, 3, 'B4', 'BURGOS'),
(58, 3, 'B5', 'CABUGAO'),
(59, 3, 'B6', 'CANDON'),
(60, 3, 'B7', 'CAOAYAN'),
(61, 3, 'B8', 'CERVANTES'),
(62, 3, 'B9', 'GALIMUYOD'),
(63, 3, 'B10', 'GREGORIO DEL PILAR'),
(64, 3, 'B11', 'LIDLIDDA'),
(65, 3, 'B12', 'MAGSINGAL'),
(66, 3, 'B13', 'NAGBUKEL'),
(67, 3, 'B14', 'NARVACAN'),
(68, 3, 'B15', 'QUIRINO'),
(69, 3, 'B16', 'SALCEDO'),
(70, 3, 'B17', 'SAN EMILIO'),
(71, 3, 'B18', 'SAN ESTEBAN'),
(72, 3, 'B19', 'SAN ILDEFONSO'),
(73, 3, 'B20', 'SAN JUAN'),
(74, 3, 'B21', 'SAN VICENTE'),
(75, 3, 'B22', 'SANTA'),
(76, 3, 'B23', 'SANTA CATALINA'),
(77, 3, 'B24', 'SANTA CRUZ'),
(78, 3, 'B25', 'SANTA LUCIA'),
(79, 3, 'B26', 'SANTA MARIA'),
(80, 3, 'B27', 'SANTIAGO'),
(81, 3, 'B28', 'SANTO DOMINGO'),
(82, 3, 'B29', 'SIGAY'),
(83, 3, 'B30', 'SINAIT'),
(84, 3, 'B31', 'SUGPON'),
(85, 3, 'B32', 'SUYO'),
(86, 3, 'B33', 'TAGUDIN'),
(87, 3, 'B35', 'VIGAN'),
(88, 4, 'C1', 'AGNO'),
(89, 4, 'C2', 'AGUILAR'),
(90, 4, 'C3', 'ALAMINOS'),
(91, 4, 'C4', 'ALCALA'),
(92, 4, 'C5', 'ANDA'),
(93, 4, 'C6', 'ASINGAN'),
(94, 4, 'C7', 'BALUNGAO'),
(95, 4, 'C8', 'BANI'),
(96, 4, 'C9', 'BASISTA'),
(97, 4, 'C10', 'BAUTISTA'),
(98, 4, 'C11', 'BAYAMBANG'),
(99, 4, 'C12', 'BINALONAN'),
(100, 4, 'C13', 'BINMALEY'),
(101, 4, 'C14', 'BOLINAO'),
(102, 4, 'C15', 'BUGALLON'),
(103, 4, 'C16', 'BURGOS'),
(104, 4, 'C17', 'CALASIAO'),
(105, 4, 'C18', 'DAGUPAN CITY'),
(106, 4, 'C19', 'DASOL'),
(107, 4, 'C20', 'INFANTA'),
(108, 4, 'C21', 'LABRADOR'),
(109, 4, 'C22', 'LAOAC'),
(110, 4, 'C23', 'LINGAYEN'),
(111, 4, 'C24', 'MABINI'),
(112, 4, 'C25', 'MALASIQUI'),
(113, 4, 'C26', 'MANAOAG'),
(114, 4, 'C27', 'MANGALDAN'),
(115, 4, 'C28', 'MANGATAREM'),
(116, 4, 'C29', 'MAPANDAN'),
(117, 4, 'C30', 'NATIVIDAD'),
(118, 4, 'C31', 'POZORRUBIO'),
(119, 4, 'C32', 'ROSALES'),
(120, 4, 'C33', 'SAN CARLOS CITY'),
(121, 4, 'C34', 'SAN FABIAN'),
(122, 4, 'C35', 'SAN JACINTO'),
(123, 4, 'C36', 'SAN MIGUEL'),
(124, 4, 'C37', 'SAN NICOLAS'),
(125, 4, 'C38', 'SAN QUINTIN'),
(126, 4, 'C39', 'SANTA BARBARA'),
(127, 4, 'C40', 'SANTA MARIA'),
(128, 4, 'C41', 'SANTO TOMAS'),
(129, 4, 'C42', 'SISON'),
(130, 4, 'C43', 'SUAL'),
(131, 4, 'C44', 'TAYUG'),
(132, 4, 'C45', 'UMINGAN'),
(133, 4, 'C46', 'URBIZTONDO'),
(134, 4, 'C47', 'URDANETA CITY'),
(135, 4, 'C48', 'VILLASIS'),
(136, 5, 'D1', 'BANGUED 2800'),
(137, 5, 'D2', 'BOLINEY 2815'),
(138, 5, 'D3', 'BUCAY 2805'),
(139, 5, 'D4', 'BUCLOC 2817'),
(140, 5, 'D5', 'DAGUIOMAN 2816'),
(141, 5, 'D6', 'DANGLAS 2825'),
(142, 5, 'D7', 'DOLORES 2801'),
(143, 5, 'D12', 'LA PAZ 2826'),
(144, 5, 'D8', 'LACUB 2821'),
(145, 5, 'D9', 'LAGANGILANG 2802'),
(146, 5, 'D10', 'LAGAYAN 2824'),
(147, 5, 'D11', 'LANGIDEN 2807'),
(148, 5, 'D13', 'LICUAN (BAAY) 2819'),
(149, 5, 'D15', 'LUBA 2813'),
(150, 5, 'D14', 'LUBA 2813'),
(151, 5, 'D16', 'MALIBCONG 2820'),
(152, 5, 'D17', 'MANABO 2810'),
(153, 5, 'D18', 'PE?ARUBIA 2804'),
(154, 5, 'D19', 'PIDIGAN 2806'),
(155, 5, 'D20', 'PILAR 2812'),
(156, 5, 'D21', 'SALLAPADAN 2818'),
(157, 5, 'D22', 'SAN ISIDRO 2809'),
(158, 5, 'D23', 'SAN JUAN 2823'),
(159, 5, 'D24', 'SAN QUINTIN 2808'),
(160, 5, 'D25', 'TAYUM 2803'),
(161, 5, 'D26', 'TINEG 2822'),
(162, 5, 'D27', 'TUBO 2814'),
(163, 5, 'D28', 'VILLAVICIOSA 2811'),
(164, 6, 'E1', 'ANAO 2310'),
(165, 6, 'E2', 'BAMBAN 2317'),
(166, 6, 'E3', 'CAMILING 2306'),
(167, 6, 'E4', 'CAPAS 2315'),
(168, 6, 'E5', 'CONCEPCION 2316'),
(169, 6, 'E6', 'GERONA 2302'),
(170, 6, 'E7', 'LA PAZ 2314'),
(171, 6, 'E8', 'MAYANTOC 2304'),
(172, 6, 'E9', 'MONCADA 2308'),
(173, 6, 'E10', 'PANIQUI 2307'),
(174, 6, 'E11', 'PURA 2312'),
(175, 6, 'E12', 'RAMOS 2311'),
(176, 6, 'E14', 'SAM MANUEL 2309'),
(177, 6, 'E13', 'SAN CLEMENTE 2305'),
(178, 6, 'E15', 'SAN MIGUEL 2301'),
(179, 6, 'E16', 'STA. IGNACIA 2303'),
(180, 6, 'E17', 'TARLAC CITY 2300'),
(181, 6, 'E18', 'VICTORIA 2313'),
(182, 7, 'F1', 'ANGELES CITY 2009'),
(183, 7, 'F2', 'APALIT 2016'),
(184, 7, 'F3', 'ARAYAT 2012'),
(185, 7, 'F4', 'BACOLOR 2001'),
(186, 7, 'F5', 'BASA AIRBASE 2007'),
(187, 7, 'F6', 'CANDABA 2013'),
(188, 7, 'F7', 'FLORIDABLANCA 2006'),
(189, 7, 'F8', 'GUAGUA 2003'),
(190, 7, 'F9', 'LUBAO 2005'),
(191, 7, 'F10', 'MABALACAT 2010'),
(192, 7, 'F11', 'MACABEBE 2018'),
(193, 7, 'F12', 'MAGALANG 2011'),
(194, 7, 'F13', 'MASANTOL 2017'),
(195, 7, 'F14', 'MEXICO 2021'),
(196, 7, 'F15', 'MINALIN 2019'),
(197, 7, 'F16', 'PORAC 2008'),
(198, 7, 'F17', 'SAN FERNANDO 2000'),
(199, 7, 'F18', 'SAN LUIS 2014'),
(200, 7, 'F19', 'SAN SIMON 2015'),
(201, 7, 'F20', 'SANTA ANA 2022'),
(202, 7, 'F21', 'SANTA RITA 2002'),
(203, 7, 'F22', 'SANTO TOMAS 2020'),
(204, 7, 'F23', 'SASMOAN 2004'),
(205, 8, 'G10', 'AKSIBU 3703'),
(206, 8, 'G1', 'ALFONSO CASTA?EDA 3714'),
(207, 8, 'G2', 'AMBAGUIO 3701'),
(208, 8, 'G3', 'ARITAO 3704'),
(209, 8, 'G4', 'BAGABAG 3711'),
(210, 8, 'G5', 'BAMBANG 3702'),
(211, 8, 'G6', 'BAYOMBONG 3700'),
(212, 8, 'G7', 'DIADI 3712'),
(213, 8, 'G8', 'DUPAX DEL NORTE 3712'),
(214, 8, 'G9', 'DUPAX DEL SUR 3707'),
(215, 8, 'G11', 'KAYAPA 3708'),
(216, 8, 'G12', 'QUEZON 3713'),
(217, 8, 'G13', 'SOLANO 3709'),
(218, 8, 'G14', 'STA. FE (IMUGAN) 3705'),
(219, 8, 'G15', 'VILLA VERDE (IBUNG) 3710'),
(220, 9, 'H1', 'ALIAGA 3111'),
(221, 9, 'H2', 'BONGABONG 3128'),
(222, 9, 'H3', 'CABANATUAN CITY 3100'),
(223, 9, 'H4', 'CABIAO 3107'),
(224, 9, 'H5', 'CARRANGLAN 3123'),
(225, 9, 'H6', 'CENTRAL LUZON STATE UNIVERSITY (CLSU) 3120'),
(226, 9, 'H7', 'CUYAPO 3117'),
(227, 9, 'H8', 'FT. MAGSAYSAY 3130'),
(228, 9, 'H9', 'GABALDON 3131'),
(229, 9, 'H10', 'GAPAN 3105'),
(230, 9, 'H12', 'GEN TINIO 3104'),
(231, 9, 'H11', 'GEN. NATIVIDAD 3125'),
(232, 9, 'H13', 'GUIMBA 3115'),
(233, 9, 'H14', 'JAEN 3109'),
(234, 9, 'H15', 'LAUR 3129'),
(235, 9, 'H16', 'LICAB 3112'),
(236, 9, 'H17', 'LLANERA 3126'),
(237, 9, 'H18', 'LUPAO 3122'),
(238, 9, 'H19', 'MU?OZ 3119'),
(239, 9, 'H20', 'NAMPICUAN 3116'),
(240, 9, 'H21', 'PALAYAN CITY 3132'),
(241, 9, 'H22', 'PANTABANGAN 3124'),
(242, 9, 'H23', 'PE?ARANDA 3103'),
(243, 9, 'H24', 'QUEZON 3113'),
(244, 9, 'H25', 'RIZAL 3127'),
(245, 9, 'H26', 'SAN ANTONIO 3108'),
(246, 9, 'H27', 'SAN ISIDRO 3106'),
(247, 9, 'H28', 'SAN JOSE CITY 3121'),
(248, 9, 'H29', 'SAN LEONARDO 3102'),
(249, 9, 'H30', 'SANTA ROSA 3101'),
(250, 9, 'H31', 'SANTO DOMINGO 3133'),
(251, 9, 'H32', 'TALAVERA 3114'),
(252, 9, 'H33', 'TALUGTOG 3118'),
(253, 9, 'H34', 'ZARAGOSA 3110'),
(254, 10, 'I1', 'ALICIA 3306'),
(255, 10, 'I2', 'ANGADANAN 3307'),
(256, 10, 'I3', 'AURORA 3316'),
(257, 10, 'I4', 'BENITO SOLIVEN 3331'),
(258, 10, 'I5', 'BURGOS 3322'),
(259, 10, 'I6', 'CABAGAN 3328'),
(260, 10, 'I7', 'CABATUAN 3315'),
(261, 10, 'I8', 'CAUAYAN 3305'),
(262, 10, 'I9', 'CORDON 3312'),
(263, 10, 'I10', 'DELFIN ALBANO 3326'),
(264, 10, 'I11', 'DINAPIGUI 3336'),
(265, 10, 'I12', 'DIVILACAN 3335'),
(266, 10, 'I13', 'ECHAGUE 3309'),
(267, 10, 'I14', 'GAMU 3301'),
(268, 10, 'I15', 'ILAGAN 3300'),
(269, 10, 'I16', 'JONES 3313'),
(270, 10, 'I17', 'LUNA 3304'),
(271, 10, 'I18', 'MACONACON 3333'),
(272, 10, 'I19', 'MALLIG 3323'),
(273, 10, 'I20', 'NAGUILLAN 3302'),
(274, 10, 'I21', 'PALANA 3334'),
(275, 10, 'I22', 'QUEZON 3324'),
(276, 10, 'I23', 'QUIRINO 3321'),
(277, 10, 'I24', 'RAMON 3319'),
(278, 10, 'I25', 'REINA MERCEDES 3303'),
(279, 10, 'I26', 'ROXAS 3320'),
(280, 10, 'I27', 'SAN AGUSTIN 3314'),
(281, 10, 'I28', 'SAN GUILLERMO 3308'),
(282, 10, 'I29', 'SAN ISIDRO 3310'),
(283, 10, 'I30', 'SAN MANUEL (CALLANG) 3317'),
(284, 10, 'I31', 'SAN MARIANO 3332'),
(285, 10, 'I32', 'SAN MATEO 3318'),
(286, 10, 'I33', 'SAN PABLO 3329'),
(287, 10, 'I34', 'SANTA MARIA 3330'),
(288, 10, 'I35', 'SANTIAGO 3311'),
(289, 10, 'I36', 'SANTO TOMAS 3327'),
(290, 10, 'I37', 'TUMAUINI 3325'),
(291, 11, 'J1', 'ATOK 2612'),
(292, 11, 'J2', 'BAGUIO CITY 2600'),
(293, 11, 'J3', 'BAKUN 2610'),
(294, 11, 'J4', 'BOKOD 2605'),
(295, 11, 'J5', 'BUGUIAS 2607'),
(296, 11, 'J6', 'ITOGON 2604'),
(297, 11, 'J7', 'KABAYAN 2606'),
(298, 11, 'J8', 'KAPANGAN 2613'),
(299, 11, 'J9', 'KIBUNGAN 2611'),
(300, 11, 'J10', 'LA TRINIDAD 2601'),
(301, 11, 'J11', 'LEPANTO 2609'),
(303, 11, 'J13', 'PHILIPPINE MILITARY ACADEMY (PMA) 2602'),
(304, 11, 'J14', 'SABLAN 2614'),
(305, 11, 'J15', 'TUBA 2603'),
(306, 11, 'J16', 'TUBLAY 2615'),
(307, 12, 'K1', 'BOTOLAN 2202'),
(308, 12, 'K2', 'CABANGAN 2203'),
(309, 12, 'K3', 'CANDELARIA 2212'),
(310, 12, 'K4', 'CASTOLLEJOS 2208'),
(311, 12, 'K5', 'IBA 2201'),
(312, 12, 'K6', 'MASINLOC 2211'),
(313, 12, 'K7', 'OLONGAPO CITY 2200'),
(314, 12, 'K8', 'PALAUIG 2210'),
(315, 12, 'K9', 'SAN ANTONIO 2206'),
(316, 12, 'K10', 'SAN FELIPE 2204'),
(317, 12, 'K11', 'SAN MARCELINO 2207'),
(318, 12, 'K12', 'SAN NARCISO 2205'),
(319, 12, 'K13', 'STA. CRUZ 2213'),
(320, 12, 'K14', 'SUBIC 2209'),
(321, 13, 'L1', 'ALICIA 1105'),
(322, 13, 'L2', 'AMIHAN 1102'),
(323, 13, 'L3', 'APOLONIO SAMSON 1106'),
(324, 13, 'L4', 'BAESA 1106'),
(325, 13, 'L5', 'BAGBAG 1116'),
(326, 13, 'L6', 'BAGONG BUHAY 1109'),
(327, 13, 'L7', 'BAGONG LIPUNAN 1111'),
(328, 13, 'L8', 'BAGONG PAGASA 1105'),
(329, 13, 'L9', 'BAGONG SILANGAN 1119'),
(330, 13, 'L10', 'BAGUMBAYAN 1110'),
(331, 13, 'L11', 'BAHAY TORO 1106'),
(332, 13, 'L12', 'BALINGASA 1115'),
(333, 13, 'L13', 'BALINTAWAK 1106'),
(334, 13, 'L14', 'BALUMBATO 1106'),
(335, 13, 'L15', 'BAYANIHAN 1109'),
(336, 13, 'L16', 'BLUE RIDGE 1109'),
(337, 13, 'L17', 'BOTOCAN 1101'),
(338, 13, 'L18', 'BUNGAD 1105'),
(339, 13, 'L19', 'CAMP AGUINALDO 1110'),
(340, 13, 'L20', 'CAPRI 1117'),
(341, 13, 'L21', 'CENTRAL 1100'),
(342, 13, 'L22', 'CLARO 1102'),
(343, 13, 'L23', 'COMMONWEALTH 1119'),
(344, 13, 'L24', 'CRAME 1111'),
(345, 13, 'L25', 'CUBAO 1109'),
(346, 13, 'L26', 'CULIAT 1107'),
(347, 13, 'L27', 'DAMAR 1115'),
(348, 13, 'L28', 'DAMAYAN 1104'),
(349, 13, 'L29', 'DAMAYANG LAGI 1112'),
(350, 13, 'L30', 'DEL MONTE 1105'),
(351, 13, 'L31', 'DILIMAN 1104'),
(352, 13, 'L32', 'DIOQUINO ZOBEL 1109'),
(353, 13, 'L33', 'DON MANUEL 1113'),
(354, 13, 'L34', 'DO?A AURORA 1113'),
(355, 13, 'L35', 'DO?A IMELDA 1113'),
(356, 13, 'L36', 'DO?A JOSEFA 1113'),
(357, 13, 'L37', 'DUYAN-DUYAN 1102'),
(358, 13, 'L39', 'E. RODRIGUEZ 1102'),
(359, 13, 'L38', 'ESCOPA 1109'),
(360, 13, 'L40', 'FAIRVIEW 1118'),
(361, 13, 'L41', 'GINTONG SILAHIS 1114'),
(362, 13, 'L42', 'GULOD 1117'),
(363, 13, 'L43', 'HORSESHOE 1112'),
(364, 13, 'L44', 'IMMACULATE CONCEPCION 1111'),
(365, 13, 'L45', 'KALIGAYAHAN 1118'),
(366, 13, 'L46', 'KALUSUGAN 1112'),
(367, 13, 'L47', 'KAMIAS 1102'),
(368, 13, 'L48', 'KAMUNING 1103'),
(369, 13, 'L49', 'KATIPUNAN 1105'),
(370, 13, 'L50', 'KAUNLARAN 1111'),
(371, 13, 'L51', 'KRISTONG HARI 1112'),
(372, 13, 'L52', 'KRUS NA LIGAS 1101'),
(373, 13, 'L54', 'LA LOMA 1114'),
(374, 13, 'L53', 'LAGING HANDA 1103'),
(375, 13, 'L55', 'LIBIS 1110'),
(376, 13, 'L56', 'LOURDES 1114'),
(377, 13, 'L57', 'LOYOLA HEIGHTS 1108'),
(378, 13, 'L58', 'MAHARLIKA 1114'),
(379, 13, 'L59', 'MALAYA 1101'),
(380, 13, 'L61', 'MAN REZA 1115'),
(381, 13, 'L60', 'MANGGA 1109'),
(382, 13, 'L62', 'MARIANA 1112'),
(383, 13, 'L63', 'MARIBLO 1104'),
(384, 13, 'L64', 'MARILAG 1109'),
(385, 13, 'L65', 'MASAGANA 1109'),
(386, 13, 'L66', 'MASAMBONG 1115'),
(387, 13, 'L67', 'MATALAHIB 1114'),
(388, 13, 'L68', 'MATANDANG BALARA 1119'),
(389, 13, 'L69', 'MILAGROSA 1109'),
(390, 13, 'L70', 'NAGKAISANG NAYON 1117'),
(391, 13, 'L71', 'NAYONG KAUNLARAN 1104'),
(392, 13, 'L72', 'NEW ERA 1107'),
(393, 13, 'L73', 'NOVALICHES PROPER 1117'),
(394, 13, 'L74', 'OBRERO 1103'),
(395, 13, 'L75', 'OLD CAPITOL SITE 1101'),
(396, 13, 'L76', 'PAANG BUNDOK 1114'),
(397, 13, 'L77', 'PAGIBIG SA NAYON 1115'),
(398, 13, 'L78', 'PALIGSAHAN 1103'),
(399, 13, 'L79', 'PALTOK 1105'),
(400, 13, 'L80', 'PANSOL 1108'),
(401, 13, 'L81', 'PARAISO 1104'),
(402, 13, 'L82', 'PASONG PUTIK 1118'),
(403, 13, 'L83', 'PASONG TAMO 1107'),
(404, 13, 'L84', 'PAYATAS 1119'),
(405, 13, 'L85', 'PHIL-AM 1104'),
(406, 13, 'L86', 'PINAGKAISAHAN 1111'),
(407, 13, 'L87', 'PI?AHAN 1100'),
(408, 13, 'L88', 'PROJECT 4 1109'),
(409, 13, 'L89', 'PROJECT 6 1100'),
(410, 13, 'L90', 'PROJECT 7 1105'),
(411, 13, 'L91', 'PROJECT 8 1106'),
(412, 13, 'L92', 'QUIRINO DISTRICT (PROJ. 2 & 3) 1102'),
(413, 13, 'L93', 'R. MAGSAYSAY 1105'),
(414, 13, 'L94', 'ROXAS DISTRICT 1103'),
(415, 13, 'L95', 'SACRED HEART 1103'),
(416, 13, 'L97', 'SAINT IGNACIUS 1110'),
(417, 13, 'L98', 'SAINT PETER 1114'),
(418, 13, 'L99', 'SALVACION 1114'),
(419, 13, 'L00', 'SAN AGUSTIN 1117'),
(420, 13, 'L01', 'SAN ANTONIO 1105'),
(421, 13, 'L02', 'SAN BARTOLOME 1116'),
(422, 13, 'L04', 'SAN ISIDRO 1113'),
(423, 13, 'L05', 'SAN ISIDRO LABRADOR 1114'),
(424, 13, 'L06', 'SAN JOSE 1115'),
(425, 13, 'L07', 'SAN ROQUE 1109'),
(426, 13, 'L08', 'SAN VICENTE 1101'),
(427, 13, 'L03', 'SANGANDAAN 1116'),
(428, 13, 'L09', 'SANTA CRUZ 1104'),
(429, 13, 'LL0', 'SANTA LUCIA 1116'),
(430, 13, 'LL2', 'SANTA MONICA 1117'),
(431, 13, 'LL3', 'SANTA TERESITA 1114'),
(432, 13, 'LL5', 'SANTO CRISTO 1105'),
(433, 13, 'LL6', 'SANTO NI?O 1113'),
(434, 13, 'LL4', 'SANTOLAN 1113'),
(435, 13, 'LL7', 'SAUYO 1116'),
(436, 13, 'LL8', 'SIENNA 1114'),
(437, 13, 'LL9', 'SIKATUNA VILLAGE 1101'),
(438, 13, '1L0', 'SILANGAN 1102'),
(439, 13, '1L1', 'SOCORRO 1109'),
(440, 13, '1L2', 'SOUTH TRIANGLE 1103'),
(441, 13, 'L96', 'ST. MARTIN DE PORRES 1111'),
(442, 13, '1L3', 'TAGUMPAY 1109'),
(443, 13, '1L4', 'TALAYAN 1104'),
(444, 13, '1L5', 'TALIPAPA 1116'),
(445, 13, '1L6', 'TANDANG SORA 1107'),
(446, 13, '1L7', 'TATALON 1113'),
(447, 13, '1L8', 'TEACHER\'S VILLAGE 1101'),
(448, 14, 'M1', 'BINONDO 1006'),
(449, 14, 'M2', 'ERMITA 1000'),
(450, 14, 'M4', 'INTRAMUROS 1002'),
(451, 14, 'M5', 'MALATE 1004'),
(452, 14, 'M3', 'P.O. BOXES MANILA CPO 1099'),
(453, 14, 'M6', 'PACO 1007'),
(454, 14, 'M7', 'PANDACAN 1011'),
(455, 14, 'M8', 'PORT AREA (SOUTH) 1002'),
(456, 14, 'M9', 'QUIAPO 1001'),
(457, 14, 'M10', 'SAMPALOC 1008'),
(458, 14, 'M11', 'SAN ANDRES BUKID 1013'),
(459, 14, 'M12', 'SAN MIGUEL 1005'),
(460, 14, 'M13', 'SAN NICOLAS 1010'),
(461, 14, 'M14', 'SANTA ANA 1009'),
(462, 14, 'M15', 'SANTA CRUZ 1003'),
(463, 14, 'M16', 'SANTA MESA 1008'),
(464, 14, 'M17', 'TONDO 1012'),
(465, 15, 'N1', 'BAESA, KALOOKAN CITY 1401'),
(466, 15, 'N2', 'FORT BONIFACIO 1201'),
(467, 15, 'N3', 'FT. BN. NAVAL STN.  1202'),
(468, 15, 'N4', 'GREENHILLS 1502'),
(469, 15, 'N5', 'KALOOKAN CITY 1400'),
(470, 15, 'N6', 'LAS PI?AS 1701'),
(471, 15, 'N7', 'MAKATI 1200'),
(472, 15, 'N8', 'MAKATI P.O. BAXES 1299'),
(473, 15, 'N9', 'MALABON 1404'),
(474, 15, 'N10', 'MANDALUYONG 1501'),
(475, 15, 'N11', 'MARIKINA 1800'),
(476, 15, 'N12', 'MERALCO, PASIG 1602'),
(477, 15, 'N13', 'MUNTINLUPA 1702'),
(478, 15, 'N14', 'NAVOTAS 1403'),
(479, 15, 'N15', 'NEW BILIBID PRISON 1703'),
(480, 15, 'N16', 'NICHOLS AIRBASE 1301'),
(481, 15, 'N19', 'P.O. BOXES PCPO 1399'),
(482, 15, 'N17', 'PARA?AQUE 1700'),
(483, 15, 'N18', 'PASAY CITY 1300'),
(484, 15, 'N20', 'PASIG 1600'),
(485, 15, 'N21', 'PASIG CAPITOL 1601'),
(486, 15, 'N23', 'PATEROS 1603'),
(487, 15, 'N22', 'POLO, VALENZUELA 1406'),
(488, 15, 'N24', 'SAN JUAN 1500'),
(489, 15, 'N25', 'TAGUIG 1604'),
(490, 15, 'N26', 'TALA LEPROSARIUM 1402'),
(491, 15, 'N27', 'VALENZUELA 1405'),
(492, 16, 'O1', 'AGBANGAN 4304'),
(493, 16, 'O2', 'ALABAT 4333'),
(494, 16, 'O3', 'ATIMONAN 4331'),
(495, 16, 'O4', 'BUENAVISTA 4320'),
(496, 16, 'O5', 'BURDEOS 4340'),
(497, 16, 'O6', 'CALAUAG 4318'),
(498, 16, 'O7', 'CANDELARIA 4323'),
(499, 16, 'O8', 'CATANAUAN 4311'),
(500, 16, 'O9', 'DOLORES 4326'),
(501, 16, 'O10', 'GENERAL LUNA 4310'),
(502, 16, 'O11', 'GENERAL NAKAR 4338'),
(503, 16, 'O12', 'GUINAYANGAN 4319'),
(504, 16, 'O13', 'GUMACA 4307'),
(505, 16, 'O14', 'HONDAGUA 4317'),
(506, 16, 'O15', 'INFANTA 4336'),
(507, 16, 'O16', 'JOMALIG 4342'),
(508, 16, 'O17', 'LOPEZ 4316'),
(509, 16, 'O18', 'LUCBAN  4301'),
(510, 16, 'O19', 'LUCENA CITY 4301'),
(511, 16, 'O20', 'MACALELON 4309'),
(512, 16, 'O21', 'MAUBAN 4330'),
(513, 16, 'O22', 'MULANAY 4312'),
(514, 16, 'O23', 'PADRE BURGOS 4303'),
(515, 16, 'O24', 'PAGBILAO 4302'),
(516, 16, 'O25', 'PANUKULA 4337'),
(517, 16, 'O26', 'PATNANONGAN 4341'),
(518, 16, 'O27', 'PEREZ 4334'),
(519, 16, 'O28', 'PITOGO 4308'),
(520, 16, 'O29', 'PLARIDEL 4306'),
(521, 16, 'O30', 'POLILIO 4339'),
(522, 16, 'O31', 'QUEZON 4332'),
(523, 16, 'O32', 'QUEZON CAPITOL 4300'),
(524, 16, 'O33', 'REAL 4335'),
(525, 16, 'O34', 'SAMPALOC 4329'),
(526, 16, 'O35', 'SAN ANDRES 4314'),
(527, 16, 'O36', 'SAN ANTONIO 4324'),
(528, 16, 'O37', 'SAN FRANCISCO 4315'),
(529, 16, 'O38', 'SAN NARCISO 4313'),
(530, 16, 'O39', 'SARIAYA 4322'),
(531, 16, 'O40', 'TAGKAWAYAN 4321'),
(532, 16, 'O41', 'TAYABAS 4327'),
(533, 16, 'O42', 'TIAONG 4325'),
(534, 16, 'O43', 'UNISAN 4305'),
(535, 17, 'P1', 'ANGONO 1902'),
(536, 17, 'P2', 'ANTIPOLO 1906'),
(537, 17, 'P3', 'BARAS 1908'),
(538, 17, 'P4', 'BINANGONAN 1903'),
(539, 17, 'P5', 'CAINTA 1900'),
(540, 17, 'P6', 'CORDONA 1904'),
(541, 17, 'P7', 'JALA-JALA 1911'),
(542, 17, 'P8', 'MONTALBAN (RODRIGUEZ) 1802'),
(543, 17, 'P9', 'MORON 1905'),
(544, 17, 'P10', 'PILILIA 1910'),
(545, 17, 'P11', 'SAN MATEO 1801'),
(546, 17, 'P12', 'TANAY 1909'),
(547, 17, 'P13', 'TAYTAY 1901'),
(548, 17, 'P14', 'TERESA 1907'),
(549, 18, 'Q1', 'ABULOG 3517'),
(550, 18, 'Q2', 'ALCALA 3507'),
(551, 18, 'Q3', 'ALLACAPAN 3523'),
(552, 18, 'Q4', 'AMULONG 3505'),
(553, 18, 'Q5', 'APARRI 3515'),
(554, 18, 'Q6', 'BAGGAO 3506'),
(555, 18, 'Q7', 'BALLESTEROS 3516'),
(556, 18, 'Q8', 'BUGUEY 3511'),
(557, 18, 'Q9', 'CALAYAN 3520'),
(558, 18, 'Q10', 'CAMALINIUGAN 3510'),
(559, 18, 'Q11', 'CLAVERIA 3519'),
(560, 18, 'Q12', 'ENRILE 3501'),
(561, 18, 'Q13', 'GATTARAN 3508'),
(562, 18, 'Q14', 'GONZAGA 3513'),
(563, 18, 'Q15', 'IGUIG 3504'),
(564, 18, 'Q16', 'LAL-LO 3509'),
(565, 18, 'Q17', 'LASAM 3524'),
(566, 18, 'Q18', 'PAMPLONA 3522'),
(567, 18, 'Q19', 'PE?ABLANCA 3502'),
(568, 18, 'Q20', 'PIAT 3527'),
(569, 18, 'Q21', 'RIZAL 3526'),
(570, 18, 'Q22', 'SANCHES MIRA 3518'),
(571, 18, 'Q23', 'SANTA ANA 3514'),
(572, 18, 'Q24', 'SANTA PRAXEDEZ 3521'),
(573, 18, 'Q25', 'SANTA TERESITA 3512'),
(574, 18, 'Q26', 'SANTO NI?O 3525'),
(575, 18, 'Q27', 'SOLANA 3503'),
(576, 18, 'Q28', 'TUAO 3528'),
(577, 18, 'Q29', 'TUGUEGARAO 3500'),
(578, 19, 'R1', 'AGUINALDO 3606'),
(579, 19, 'R2', 'BANAUE 3601'),
(580, 19, 'R3', 'HINGYON 3607'),
(581, 19, 'R4', 'HUNGDUAN 3603'),
(582, 19, 'R5', 'KIANGAN 3604'),
(583, 19, 'R6', 'LAGAWE 3600'),
(584, 19, 'R7', 'LAMUT 3605'),
(585, 19, 'R8', 'MAYOYAO 3602'),
(586, 19, 'R9', 'POTIA 3608'),
(587, 19, 'R10', 'TINOC 3609'),
(588, 20, 'S1', 'ALABEL 9501'),
(589, 20, 'S2', 'BANGA 9511'),
(590, 20, 'S4', 'GEN. SANTOS CITY 9500'),
(591, 20, 'S3', 'GLAN 9517'),
(592, 20, 'S5', 'KIAMBA 9517'),
(593, 20, 'S6', 'KORONADAL 9506'),
(594, 20, 'S7', 'MAASIM 9502'),
(595, 20, 'S8', 'MAITUM 9515'),
(596, 20, 'S9', 'MALAPATAN 9516'),
(597, 20, 'S10', 'MALUNGON 9503'),
(598, 20, 'S11', 'NORALA 9508'),
(599, 20, 'S12', 'POLOMOLOK 9504'),
(600, 20, 'S13', 'STO. NI?O 9509'),
(601, 20, 'S14', 'SURALLAH 9512'),
(602, 20, 'S15', 'TAMPACAN 9507'),
(603, 20, 'S16', 'TANTANGAN 9510'),
(604, 20, 'S17', 'T\'BOLI 9513'),
(605, 20, 'S18', 'TUPI 9505'),
(606, 21, 'T1', 'ALAMADA 9413'),
(607, 21, 'T2', 'ALEOSAN 9415'),
(608, 21, 'T3', 'ANTIPAS 9414'),
(609, 21, 'T4', 'BANISILAN 9416'),
(610, 21, 'T5', 'CARMEN 9408'),
(611, 21, 'T6', 'KABACAN 9407'),
(612, 21, 'T7', 'KIDAPAWAN 9400'),
(613, 21, 'T8', 'LIBUNGAN 9411'),
(614, 21, 'T9', 'MAGPET 9404'),
(615, 21, 'T10', 'MAKILALA 9401'),
(616, 21, 'T12', 'MATALAM 9406'),
(617, 21, 'T11', 'MATALAM 9406'),
(618, 21, 'T13', 'MIDSAYAP 9410'),
(619, 21, 'T14', 'M\'LANG 9402'),
(620, 21, 'T15', 'PIGKAWAYAN 9412'),
(621, 21, 'T16', 'PIKIT 9409'),
(622, 21, 'T17', 'PRES. ROXAS 9405'),
(623, 21, 'T18', 'TULUNAN 9403'),
(624, 22, 'U1', 'ALICIA 7040'),
(625, 22, 'U2', 'AURORA 7020'),
(626, 22, 'U3', 'BAYOG 7011'),
(627, 22, 'U4', 'BUUG 7009'),
(628, 22, 'U5', 'DIMATALING 7032'),
(629, 22, 'U6', 'DINAS 7030'),
(630, 22, 'U7', 'DIPLAHAN 7039'),
(631, 22, 'U8', 'DOM MARIANO MARCOS 7022'),
(632, 22, 'U9', 'DUMALINAO 7015'),
(633, 22, 'U10', 'DUMINGAG 7028'),
(634, 22, 'U11', 'IMELDA 7007'),
(635, 22, 'U12', 'IPIL 7001'),
(636, 22, 'U13', 'JOSEFINA 7027'),
(637, 22, 'U14', 'KABASALAN 7005'),
(638, 22, 'U15', 'KUMALARANG 7013'),
(639, 22, 'U16', 'LABANGAN 7017'),
(640, 22, 'U17', 'LAKEWOOD 7014'),
(641, 22, 'U18', 'LAPUYAN 7037'),
(642, 22, 'U19', 'MABUHAY 7010'),
(643, 22, 'U20', 'MAHAYAG 7026'),
(644, 22, 'U21', 'MALANGAS 7038'),
(645, 22, 'U22', 'MARGO SA TUBIG 7035'),
(646, 22, 'U23', 'MIDSALIP 7021'),
(647, 22, 'U24', 'MOLAVE 7023'),
(648, 22, 'U25', 'NAGA CITY 7004'),
(649, 22, 'U26', 'OLUTANGA 7041'),
(650, 22, 'U27', 'PAGADIAN CITY 7016'),
(651, 22, 'U28', 'PAYAO 7008'),
(652, 22, 'U29', 'PITOGO 7033'),
(653, 22, 'U30', 'RAMON MAGSAYSAY 7024'),
(654, 22, 'U31', 'ROSELLER LIM 7002'),
(655, 22, 'U32', 'SAN MIGUEL 7029'),
(656, 22, 'U33', 'SAN PABLO 7031'),
(657, 22, 'U34', 'SIAY 7006'),
(658, 22, 'U35', 'TABINA 7034'),
(659, 22, 'U36', 'TALUSAN 7012'),
(660, 22, 'U37', 'TAMBULIG 7025'),
(661, 22, 'U38', 'TITAY 7003'),
(662, 22, 'U39', 'TUKURAN 7019'),
(663, 22, 'U40', 'TUNGAWAN 7018'),
(664, 22, 'U41', 'VICENCIO SAGUN 7036'),
(665, 22, 'U42', 'ZAMBOANGA CITY 7000'),
(666, 23, 'V1', 'BALIGUAN 7123'),
(667, 23, 'V2', 'DAPITAN CITY 7101'),
(668, 23, 'V3', 'DIPOLOG CITY 7100'),
(669, 23, 'V4', 'GUTALAC 7118'),
(670, 23, 'V5', 'JOSE DALMAN (PONOT) 7111'),
(671, 23, 'V6', 'KATIPUNAN 7109'),
(672, 23, 'V8', 'LA LIBERTAD 7119'),
(673, 23, 'V7', 'LABASON 7117'),
(674, 23, 'V9', 'LILOY 7115'),
(675, 23, 'V10', 'MANUKAN 7110'),
(676, 23, 'V11', 'MUTIA 7107'),
(677, 23, 'V12', 'PINAN 7105'),
(678, 23, 'V13', 'POLANCO 7106'),
(679, 23, 'V14', 'RIZAL 7104'),
(680, 23, 'V15', 'ROXAS 7102'),
(681, 23, 'V16', 'SALUG 7114'),
(682, 23, 'V17', 'SERGIO OSME?A 7108'),
(683, 23, 'V18', 'SIAYAN 7113'),
(684, 23, 'V19', 'SIBUCO 7122'),
(685, 23, 'V20', 'SIBUTAD 7103'),
(686, 23, 'V21', 'SINDANGAN 7112'),
(687, 23, 'V22', 'SIOCON 7120'),
(688, 23, 'V23', 'SIRAWAY 7121'),
(689, 23, 'V24', 'TAMPILISAN 7116'),
(690, 24, 'W1', 'BALBALAN 3801'),
(691, 24, 'W2', 'CALANASAN 3814'),
(692, 24, 'W3', 'CONNER 3807'),
(693, 24, 'W4', 'FLORA 3810'),
(694, 24, 'W5', 'KABUGAO 3809'),
(695, 24, 'W6', 'LIWAN (RIZAL) 3808'),
(696, 24, 'W7', 'LUBUAGAN 3802'),
(697, 24, 'W8', 'LUNA 3813'),
(698, 24, 'W9', 'PASIL 3803'),
(699, 24, 'W10', 'PINUKPOK 3806'),
(700, 24, 'W11', 'PUDTOL 3812'),
(701, 24, 'W12', 'SANTA MARCELA 3811'),
(702, 24, 'W13', 'TABUK 3800'),
(703, 24, 'W14', 'TANUDAN 3805'),
(704, 24, 'W15', 'TANUDAN 3805'),
(705, 24, 'W16', 'TINGLAYAN 3804'),
(706, 25, 'X1', 'BARLIG 2623'),
(707, 25, 'X2', 'BAUKO 2621'),
(708, 25, 'X3', 'BESAO 2618'),
(709, 25, 'X4', 'BONTOC 2616'),
(710, 25, 'X5', 'NATONIN 2624'),
(711, 24, 'X6', 'PARACELES 2625'),
(712, 25, 'X7', 'SABANGAN 2622'),
(713, 25, 'X8', 'SADANGA 2617'),
(714, 25, 'X9', 'SAGADA 2619'),
(715, 25, 'X10', 'TADIAN 2620'),
(716, 26, 'Y1', 'CEBU CITY 6000'),
(717, 27, 'Z1', 'LEON 5026'),
(718, 28, '1ZY', 'BALER 3200'),
(719, 28, '2ZY', 'CASIGURAN 3204'),
(720, 28, '3ZY', 'DISALAG 3205'),
(721, 28, '4ZY', 'DINALUNGAN 3206'),
(722, 28, '5ZY', 'DINGALAN 3207'),
(723, 28, '6ZY', 'DIPACULAO 3203'),
(724, 28, '7ZY', 'MARIA AURORA 3202'),
(725, 28, '8ZY', 'SAN LUIS 3201'),
(726, 27, 'Z2', 'ILOILO CITY 5000'),
(727, 29, '1ZX', 'ROMBLON 5500'),
(728, 30, '1ZW', 'LOS BA?OS 4030'),
(729, 31, '1ZV', 'PANDAN 4809'),
(730, 32, '1ZU', 'MALOLOS 3000'),
(731, 33, '1ZS', 'CARAMOAN 4429'),
(732, 33, '2ZS', 'PAMPLONA 4416'),
(733, 34, '1ZR', 'SAPIAN 5806'),
(734, 35, '1ZQ', 'ESCALANTE 6124'),
(735, 36, '1ZP', 'ALEGRIA 8425'),
(736, 36, '2ZP', 'BACUAG 8408'),
(737, 36, '3ZP', 'BASILISA (RIZAL) 8413'),
(738, 36, '4ZP', 'BURGOS 8424'),
(739, 36, '5ZP', 'CAGDIANAO 8411'),
(740, 36, '6ZP', 'CLAVER 8410'),
(741, 36, '7ZP', 'DAPA 8417'),
(742, 36, '8ZP', 'DEL CARMEN 8418'),
(743, 36, '9ZP', 'DINAGAT 8412'),
(744, 36, '01Z', 'GEN. LUNA 8419'),
(745, 36, '02Z', 'GIGAQUIT 8409'),
(746, 36, '03Z', 'LIBJO (ALBOR) 8414'),
(747, 36, '04Z', 'LORETO 8415'),
(748, 36, '05Z', 'MAINIT 8407'),
(749, 36, '06Z', 'MALIMANO 8402'),
(750, 36, '07Z', 'PILAR 8420'),
(751, 36, '08Z', 'PLACER 8405'),
(752, 36, '09Z', 'SAN BENITO 8423'),
(753, 36, 'Z01', 'SAN FRANCISCO 8401'),
(754, 36, 'Z02', 'SAN ISIDRO 8421'),
(755, 36, 'Z03', 'SANTA MONICA 8422'),
(756, 36, 'Z04', 'SISON 8404'),
(757, 36, 'Z05', 'SOCORRO 8416'),
(758, 36, 'Z06', 'SURIGAO CITY 8400'),
(759, 36, 'Z07', 'TAGANA-AN 8403'),
(760, 36, 'Z08', 'TUBAJON 8426'),
(761, 36, 'Z09', 'TUBOD 8406'),
(762, 27, 'Z10', 'DUMANGAS'),
(763, 13, '168', 'MURPHY'),
(764, 29, 'E69', 'ODIONGAN'),
(765, 37, '1ZZ', 'GUIHOLNGAN'),
(766, 21, 'T19', 'TUNGGOL'),
(767, 33, '987', 'PILI'),
(768, 35, '00Z', 'SILAY CITY'),
(769, 27, '152', 'CARLES'),
(770, 32, '564', 'MEYCAUYAN'),
(771, 35, 'ZER', 'MANAPLA'),
(772, 30, '75', '5555323'),
(773, 14, 'J20', 'N/A'),
(774, 32, 'Z99', 'BUSTOS'),
(775, 41, '8ZX', 'KADUNA STATE'),
(776, 13, '889', 'ST. LUKES HOSP.'),
(777, 40, '99X', 'BACOOR'),
(778, 42, '534', 'JARO'),
(779, 43, '9XX', 'STO. NI?O'),
(780, 44, '457', 'ALITAGTAG'),
(781, 16, '643', 'ANTIMONAN'),
(782, 30, 'Z3Z', 'MAJAYJAY'),
(783, 30, '687', 'CALAUAN'),
(784, 33, '783', 'OCAMPO'),
(785, 15, '897', 'CALOOCAN CITY'),
(786, 3, '693', 'STA. MARIA'),
(787, 42, '846', 'BAYBAY'),
(788, 45, '30A', 'CALAPAN'),
(789, 35, '99E', 'BAGO CITY'),
(790, 46, '236', 'NASIPIT'),
(791, 4, '399', 'SAN MANUEL'),
(792, 47, '716', 'BATAN'),
(793, 32, '459', 'OBANDO'),
(794, 35, '567', 'HIMAMAYLAN'),
(795, 35, '676', 'CADIZ CITY'),
(796, 42, '265', 'ALANGALANG'),
(797, 48, '8X8', 'STA. MARCELA'),
(798, 49, '529', 'LIMAY'),
(799, 40, '544', 'IMUS'),
(800, 45, '12F', 'VICTORIA'),
(801, 50, '434', 'PALANAS'),
(802, 14, '053', 'QUEZON CITY'),
(803, 51, '13S', 'CABARROGUIS'),
(804, 1, '232', 'DAMORTIS'),
(805, 27, '46S', 'ESTANCIA'),
(806, 52, '58A', 'BOAC'),
(807, 27, '654', 'MIAGAO'),
(808, 53, '045', 'TACURONG CITY'),
(809, 44, '15f', 'BAUAN'),
(810, 8, '321', 'BELANCE'),
(811, 54, '32A', 'SAGAY'),
(812, 51, '11s', 'MADDELA'),
(813, 34, '654', 'IUSAN'),
(814, 19, '55a', 'ALFONSO LISTA'),
(815, 27, '54o', 'CONCEPCION'),
(816, 56, '12A', 'ARAS-ASAN'),
(817, 42, 'dfa', 'VILLABA'),
(818, 57, '466', 'PADADA'),
(819, 56, '2sa', 'TANDAG'),
(820, 58, '654', 'IRUHIN WEST'),
(821, 7, 'w65', 'SAN FERNANDO'),
(822, 37, '654', 'TANJAY'),
(823, 35, 'as5', 'BACOLOD CITY'),
(824, 59, '54s', 'FLORIDA'),
(825, 44, '23S', 'BALIBAGO'),
(826, 14, '654', 'DAPITAN'),
(827, 60, 'a45', 'JEDDAH'),
(828, 27, '46W', 'CALINOG'),
(829, 32, '65s', 'CALUMPIT'),
(830, 61, '464', 'PETERBOROUGH'),
(831, 62, '654', 'MARANDING LALA'),
(832, 35, '54a', 'SIPALAY'),
(833, 32, '5as', 'SAN JOSE DEL MONTE'),
(834, 57, 'd89', 'BANSALAN'),
(835, 63, 'D5F', 'LEGAZPI CITY'),
(836, 64, '5a5', 'GRAZ'),
(837, 44, '21s', 'BALAYAN'),
(838, 44, 'as8', 'LIPA'),
(839, 30, '21l', 'SANTA CRUZ'),
(840, 14, 'asd', ''),
(841, 65, '556', 'LANTAPAN'),
(842, 32, '646', 'STA. MARIA'),
(843, 66, '9YT', 'SAN FRANCISCO'),
(844, 30, '21a', 'BI?AN'),
(845, 11, '4as', 'ABATAN'),
(846, 57, '12s', 'N/A'),
(847, 43, '23s', 'GUIUAN'),
(848, 31, '4aw', 'VIGA'),
(849, 42, '2as', 'ISABEL'),
(850, 43, '2s6', 'CAPAYSAGAN'),
(851, 35, '56a', 'LA CARLOTA'),
(852, 68, '655', 'KABAGAN'),
(853, 46, 'k2l', 'BUTUAN CITY'),
(854, 30, '1ZX', 'SAN PABLO CITY 4000'),
(855, 30, '1z0', 'SAN PABLO'),
(856, 32, '26x', 'ANGAT'),
(857, 30, '4a4', 'CANLUBANG'),
(858, 30, '8as', 'LANDAYAN'),
(859, 34, '56U', 'PANAY'),
(860, 32, '544', 'BULACAN'),
(861, 47, '8a6', 'KALIBO'),
(862, 71, 'XXX', 'TORIL'),
(863, 45, '30b', 'NAUJAN'),
(864, 54, '8as', 'MEDINA'),
(865, 42, 'AS1', 'TACLOBAN'),
(866, 35, '7a4', 'BINALBAGAN'),
(867, 73, 'af5', 'ORDANETA CITY'),
(868, 40, '242', 'TRECE MARTIRES'),
(869, 30, '123', 'PILA'),
(870, 2, '8K9', 'BANNA');

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `province_id` int(11) NOT NULL,
  `province_description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`province_id`, `province_description`) VALUES
(1, 'LA UNION'),
(2, 'ILOCOS NORTE'),
(3, 'ILOCOS SUR'),
(4, 'PANGASINAN');

-- --------------------------------------------------------

--
-- Table structure for table `resiliency`
--

CREATE TABLE `resiliency` (
  `id` int(11) NOT NULL,
  `cmci_id` int(11) DEFAULT NULL,
  `land_use_plan` text,
  `disaster_risk_reduction_plan` text,
  `annual_disaster_drill` text,
  `early_warning_system` text,
  `budget_for_drrmp` text,
  `local_risk_assessments` text,
  `emergency_infrastructure` text,
  `utilities` text,
  `employed_population` text,
  `sanitary_system` text,
  `system_log` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_log` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resiliency`
--

INSERT INTO `resiliency` (`id`, `cmci_id`, `land_use_plan`, `disaster_risk_reduction_plan`, `annual_disaster_drill`, `early_warning_system`, `budget_for_drrmp`, `local_risk_assessments`, `emergency_infrastructure`, `utilities`, `employed_population`, `sanitary_system`, `system_log`, `update_log`) VALUES
(1, 1, '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '2018-08-28 12:32:31', '2018-08-28 12:32:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`) VALUES
(1, 'John Paul Balanon', 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cmci`
--
ALTER TABLE `cmci`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lgu_id` (`lgu_id`);

--
-- Indexes for table `economy`
--
ALTER TABLE `economy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cmci_id` (`cmci_id`);

--
-- Indexes for table `government_efficiency`
--
ALTER TABLE `government_efficiency`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cmci_id` (`cmci_id`);

--
-- Indexes for table `infrastructure`
--
ALTER TABLE `infrastructure`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cmci_id` (`cmci_id`);

--
-- Indexes for table `lgus`
--
ALTER TABLE `lgus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `municipalities`
--
ALTER TABLE `municipalities`
  ADD PRIMARY KEY (`municipality_id`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`province_id`);

--
-- Indexes for table `resiliency`
--
ALTER TABLE `resiliency`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cmci_id` (`cmci_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cmci`
--
ALTER TABLE `cmci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `economy`
--
ALTER TABLE `economy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `government_efficiency`
--
ALTER TABLE `government_efficiency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `infrastructure`
--
ALTER TABLE `infrastructure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `lgus`
--
ALTER TABLE `lgus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;
--
-- AUTO_INCREMENT for table `municipalities`
--
ALTER TABLE `municipalities`
  MODIFY `municipality_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=871;
--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `province_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `resiliency`
--
ALTER TABLE `resiliency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cmci`
--
ALTER TABLE `cmci`
  ADD CONSTRAINT `cmci_ibfk_1` FOREIGN KEY (`lgu_id`) REFERENCES `lgus` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `economy`
--
ALTER TABLE `economy`
  ADD CONSTRAINT `economy_ibfk_1` FOREIGN KEY (`cmci_id`) REFERENCES `cmci` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `government_efficiency`
--
ALTER TABLE `government_efficiency`
  ADD CONSTRAINT `government_efficiency_ibfk_1` FOREIGN KEY (`cmci_id`) REFERENCES `cmci` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `infrastructure`
--
ALTER TABLE `infrastructure`
  ADD CONSTRAINT `infrastructure_ibfk_1` FOREIGN KEY (`cmci_id`) REFERENCES `cmci` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `resiliency`
--
ALTER TABLE `resiliency`
  ADD CONSTRAINT `resiliency_ibfk_1` FOREIGN KEY (`cmci_id`) REFERENCES `cmci` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
