-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2023 at 05:02 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_barangay`
--

-- --------------------------------------------------------

--
-- Table structure for table `brgy_purok`
--

CREATE TABLE `brgy_purok` (
  `purok_id` int(11) NOT NULL,
  `purok_name` varchar(50) DEFAULT NULL,
  `p_leader` varchar(50) DEFAULT NULL,
  `resident_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `brgy_purok`
--

INSERT INTO `brgy_purok` (`purok_id`, `purok_name`, `p_leader`, `resident_number`) VALUES
(1, 'Purok 1-A', 'Ricardo D. Suribas', '0950-463-4886'),
(2, 'Purok 1-B', 'Ruben Simblante', '0938-139-4274'),
(3, 'Purok 1-B Graceland', 'Nenita Dela Pe?a', '0906-137-3645'),
(4, 'Purok 1-C', 'Imperatriz L. Lozada', ' 0932-972-2584'),
(5, 'Purok 2-A', ' Edna F. Cayanong', '0920-352-2189'),
(6, 'Purok 2-B', 'Nelia Quindao', '0951-353-3790'),
(7, 'Purok 3-A', 'Mario Jastia', '0950-341-1036'),
(8, 'Purok 3-B', 'Amado Partosa', '0999-189-4483'),
(9, 'Purok 4-A', 'Jerry Dumalauron', '0991-431-2295'),
(10, 'Purok 4-B', 'Marcelita Labor', '0965-756-2507'),
(11, 'Purok 5-A', 'Bernie Baldesco', '0946-593-5416'),
(12, 'Purok 5-B', 'Roger Malmis, Sr.', '0935-7113-327'),
(13, 'Purok 6-A', 'Jess Barrette', '0998-486-9726'),
(14, 'Purok 6-A1', 'Jose Hermilo Millama', '0975-536-8817'),
(15, 'Purok 6-A2', 'Rodolfo Gamorot', '0909-694-7461'),
(16, 'Purok 6-A3', 'Mary Grace Sandugan', '0935-305-1214'),
(17, 'Purok 6-A4', 'Alberto Corimo', '0930-804-9366'),
(18, 'Purok 6-A5', 'Ranilo Ferdinand ', '0910-045-3923'),
(19, 'Purok 6-B1', 'Danilo Gonzaga', '0946-545-6940'),
(20, 'Purok 6-B2', 'Elizalde A. Dimpo', '0950-863-1661'),
(21, 'Purok 6-B3', 'Esteban Siong', '0949-164-4692'),
(22, 'Purok 6-B3-A', 'Peter Villacura', ' 0907-784-6381'),
(23, 'Purok 6-B4', 'Viviano Bucog ', '0926-488-8524'),
(24, 'Purok 6-B5', 'Jerry Lozong', '0930-591-9756'),
(25, 'Purok 6-B6', 'Rosalie Edar', '0955-702-4197'),
(26, 'Purok 6-B6-A', 'Emelina Neri', '0932-407-9196'),
(27, 'Purok 6-B7', ' Geto Santamina', '0912-182-4614'),
(28, 'Purok 6-B8', 'Brenda Gayo', ' 0910-574-4330'),
(29, 'Purok 6-C', 'Candelario Simborio', '0948-892-1645'),
(30, 'Purok 6-D', 'Nympha Salem', '0930-6169-286'),
(31, 'Purok 7', 'Wilmer Armada', '0951-407-4719'),
(32, 'Purok 8-A', 'Juanita A. Alipaopao', '0955-4460-555'),
(33, 'Purok 8-B', 'Jenilyn Deala', '0963-288-2160'),
(34, 'Purok 9', 'Judith Laurel', '0935-485-4925'),
(35, 'Purok 10-A', 'Carlito Campugan', '0910-469-9838'),
(36, 'Purok 10-B', 'Wilson Magbanua', '0909-231-6602'),
(37, 'Purok 11', 'Mary Jean Iran', '0951-400-3634'),
(38, 'Purok 11-A', 'Marvin Domingo', '0943-363-8640'),
(39, 'Purok 12', 'Maria Timbing Borres', '0936-485-7811');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `complaint_id` int(11) NOT NULL,
  `resident_id` int(11) NOT NULL,
  `complainant` varchar(255) NOT NULL,
  `against` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `complain_description` text NOT NULL,
  `response` text DEFAULT NULL,
  `status` enum('pending','acknowledged','settled','dismissed') DEFAULT 'pending',
  `new_schedule` varchar(255) NOT NULL,
  `old_schedule` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `form_type`
--

CREATE TABLE `form_type` (
  `req_id` int(11) NOT NULL,
  `request_type` varchar(50) DEFAULT NULL,
  `fee` decimal(20,6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `form_type`
--

INSERT INTO `form_type` (`req_id`, `request_type`, `fee`) VALUES
(1, 'Transportation of animal and slaughter', 50.000000),
(2, 'Birth Certificate', 10.000000),
(3, 'Live-in Certificate', 100.000000),
(4, 'Death Certificate', 200.000000),
(5, 'Indigency', 10.000000),
(6, 'Certificate of low income', 1.000000),
(7, 'Certificate of residency', 1.000000),
(8, 'Barangay Clearance', 1.000000);

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `pay_id` int(11) NOT NULL,
  `payment_type` varchar(50) DEFAULT NULL,
  `shipping_fee` double DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`pay_id`, `payment_type`, `shipping_fee`, `description`) VALUES
(1, 'COD', 40, 'Cash on Delivery'),
(2, 'GCASH', NULL, 'E-payment');

-- --------------------------------------------------------

--
-- Table structure for table `receipt_transaction`
--

CREATE TABLE `receipt_transaction` (
  `recep_id` int(11) NOT NULL,
  `req_form_information_id` int(11) DEFAULT NULL,
  `req_id` int(11) DEFAULT NULL,
  `req_form_type_id` int(11) DEFAULT NULL,
  `pay_id` int(11) DEFAULT NULL,
  `or_no` varchar(50) DEFAULT NULL,
  `contact_no` varchar(50) DEFAULT NULL,
  `total_amount` decimal(20,6) DEFAULT NULL,
  `delivery_address` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `receipt_transaction`
--

INSERT INTO `receipt_transaction` (`recep_id`, `req_form_information_id`, `req_id`, `req_form_type_id`, `pay_id`, `or_no`, `contact_no`, `total_amount`, `delivery_address`, `status`, `created_at`, `updated_at`) VALUES
(109, 76, 1, 76, 1, NULL, '', 0.000000, '', 2, '2022-10-07 19:22:42', '2022-10-07 19:22:46'),
(110, 77, 1, 77, 1, NULL, '', 0.000000, '', 2, '2022-10-07 19:28:09', '2022-10-07 19:28:12'),
(111, 78, 1, 78, 1, NULL, '', 0.000000, '', 2, '2022-10-07 19:30:35', '2022-10-07 19:30:38'),
(112, 79, 1, 79, 1, NULL, '', 0.000000, '', 2, '2022-10-07 19:37:18', '2022-10-07 19:37:20'),
(113, 80, 1, 116, 1, NULL, '', 0.000000, '', 2, '2022-10-07 19:41:36', '2022-10-07 19:41:38'),
(114, 81, 1, 81, 1, NULL, '', 0.000000, '', 2, '2022-10-07 19:44:49', '2022-10-07 19:44:50'),
(115, 82, 1, 117, 1, NULL, '', 0.000000, '', 2, '2022-10-07 19:45:29', '2022-10-07 19:45:31'),
(116, 83, 1, 83, 1, NULL, '', 0.000000, '', 2, '2022-10-07 19:50:20', '2022-10-07 19:50:21'),
(117, 84, 1, 118, 1, NULL, '', 0.000000, '', 2, '2022-10-07 19:51:01', '2022-10-07 19:51:02'),
(118, 85, 1, 85, 1, NULL, '', 0.000000, '', 2, '2022-10-07 19:51:56', '2022-10-07 19:51:57'),
(119, 86, 7, 86, 1, NULL, '', 0.000000, '', 2, '2022-10-07 19:52:34', '2022-10-07 19:52:37'),
(120, 87, 1, 119, 1, NULL, '', 0.000000, '', 2, '2022-10-07 19:53:08', '2022-10-07 19:53:09'),
(121, 88, 1, 120, 1, NULL, '', 0.000000, '', 2, '2022-10-07 19:56:33', '2022-10-07 19:56:34'),
(122, 89, 3, 121, 1, NULL, '', 0.000000, '', 2, '2022-10-07 20:48:41', '2022-10-07 20:48:45'),
(123, 90, 2, 122, 1, NULL, '', 0.000000, '', 2, '2022-10-08 09:59:54', '2022-10-08 09:59:55'),
(124, 91, 4, 123, 1, NULL, '', 0.000000, '', 2, '2022-10-08 10:00:56', '2022-10-08 10:00:58'),
(125, 92, 5, 124, 1, NULL, '', 0.000000, '', 2, '2022-10-08 10:01:29', '2022-10-08 10:01:31'),
(126, 93, 6, 125, 1, NULL, '', 0.000000, '', 2, '2022-10-08 10:01:55', '2022-10-08 10:01:56'),
(127, 94, 7, 126, 1, NULL, '', 0.000000, '', 2, '2022-10-08 10:02:24', '2022-10-08 10:02:25'),
(128, 95, 8, 127, 1, NULL, '', 0.000000, '', 2, '2022-10-08 10:02:56', '2022-10-08 10:02:57'),
(129, 96, 4, 128, 1, NULL, '', 0.000000, '', 2, '2022-10-09 20:32:57', '2022-10-09 20:33:01'),
(130, 97, 7, 129, 1, NULL, '', 0.000000, '', 2, '2022-10-10 18:22:16', '2022-10-10 18:22:17'),
(131, 98, 3, 0, 1, NULL, '', 0.000000, '', 2, '2023-03-07 02:07:54', '2023-09-22 22:56:50'),
(132, 99, 2, 0, 1, NULL, '', 0.000000, '', 2, '2023-09-22 22:21:09', '2023-09-22 22:57:00'),
(155, 110, 5, 142, 1, NULL, '', 0.000000, '', 0, '2023-10-10 02:06:43', '2023-10-10 02:06:43'),
(156, 111, 5, 143, 1, NULL, '', 0.000000, '', 0, '2023-10-10 02:07:14', '2023-10-10 02:07:14'),
(157, 112, 5, 144, 1, NULL, '', 0.000000, '', 0, '2023-10-10 02:07:33', '2023-10-10 02:07:33'),
(158, 113, 6, 145, 1, NULL, '', 0.000000, '', 0, '2023-10-10 02:09:23', '2023-10-10 02:09:23'),
(159, 114, 6, 146, 1, NULL, '', 0.000000, '', 0, '2023-10-10 02:09:24', '2023-10-10 02:09:24'),
(160, 115, 5, 147, 1, NULL, '', 0.000000, '', 2, '2023-10-10 02:14:31', '2023-10-10 02:14:39'),
(161, 116, 6, 148, 1, NULL, '', 0.000000, '', 8, '2023-10-10 02:29:33', '2023-10-10 02:29:34'),
(162, 117, 5, 149, 1, NULL, '', 0.000000, '', 2, '2023-10-10 02:29:59', '2023-10-10 02:30:01'),
(163, 121, 5, 121, 1, NULL, '', 0.000000, '', 0, '2023-10-10 03:53:29', '2023-10-10 03:53:29'),
(164, 122, 5, 122, 1, NULL, '', 0.000000, '', 0, '2023-10-10 03:57:09', '2023-10-10 03:57:09'),
(165, 123, 5, 150, 1, NULL, '', 0.000000, '', 2, '2023-10-10 04:00:09', '2023-10-10 04:00:11'),
(166, 124, 5, 151, 1, NULL, '', 0.000000, '', 2, '2023-10-10 04:00:48', '2023-10-10 04:11:11'),
(167, 125, 5, 152, 1, NULL, '', 0.000000, '', 2, '2023-10-10 04:11:27', '2023-10-10 04:11:33'),
(168, 126, 5, 153, 1, NULL, '', 0.000000, '', 0, '2023-10-10 04:25:24', '2023-10-10 04:25:24'),
(169, 127, 5, 154, 1, NULL, '', 0.000000, '', 2, '2023-10-10 04:26:42', '2023-10-10 04:26:49'),
(170, 128, 5, 155, 1, NULL, '', 0.000000, '', 0, '2023-10-10 04:27:23', '2023-10-10 04:27:23'),
(171, 129, 5, 156, 1, NULL, '', 0.000000, '', 2, '2023-10-10 04:30:54', '2023-10-10 04:30:57'),
(172, 130, 5, 157, 1, NULL, '', 0.000000, '', 2, '2023-10-10 04:45:37', '2023-10-10 04:45:41'),
(173, 131, 5, 158, 1, NULL, '', 0.000000, '', 2, '2023-10-10 04:47:10', '2023-10-10 04:47:15'),
(174, 132, 5, 159, 1, NULL, '', 0.000000, '', 2, '2023-10-10 04:48:54', '2023-10-10 04:48:56'),
(175, 133, 5, 160, 1, NULL, '', 0.000000, '', 2, '2023-10-10 04:51:36', '2023-10-10 04:51:40'),
(176, 134, 5, 161, 1, NULL, '', 0.000000, '', 2, '2023-10-10 04:54:24', '2023-10-10 04:54:26'),
(177, 136, 5, 163, 1, NULL, '', 0.000000, '', 2, '2023-10-10 04:58:02', '2023-10-10 04:58:04'),
(178, 137, 5, 164, 1, NULL, '', 0.000000, '', 8, '2023-10-10 04:58:32', '2023-10-10 05:01:28'),
(179, 138, 5, 165, 1, NULL, '', 0.000000, '', 2, '2023-10-10 05:01:49', '2023-10-10 05:01:59'),
(180, 139, 5, 166, 1, NULL, '', 0.000000, '', 0, '2023-10-10 05:02:34', '2023-10-10 05:02:34'),
(181, 140, 5, 167, 1, NULL, '', 0.000000, '', 2, '2023-10-10 05:05:05', '2023-10-10 05:05:11'),
(182, 141, 5, 168, 1, NULL, '', 0.000000, '', 0, '2023-10-10 05:07:12', '2023-10-10 05:07:12'),
(183, 142, 5, 169, 1, NULL, '', 0.000000, '', 2, '2023-10-10 05:12:55', '2023-10-10 05:12:58'),
(184, 143, 5, 170, 1, NULL, '', 0.000000, '', 2, '2023-10-10 05:18:07', '2023-10-10 05:18:09'),
(185, 144, 5, 171, 1, NULL, '', 0.000000, '', 0, '2023-10-10 22:40:57', '2023-10-10 22:40:57'),
(186, 145, 5, 172, 1, NULL, '', 0.000000, '', 0, '2023-10-10 22:41:00', '2023-10-10 22:41:00'),
(187, 146, 5, 173, 1, NULL, '', 0.000000, '', 0, '2023-10-10 22:41:15', '2023-10-10 22:41:15'),
(188, 147, 5, 174, 1, NULL, '', 0.000000, '', 0, '2023-10-10 22:43:29', '2023-10-10 22:43:29'),
(189, 148, 5, 175, 1, NULL, '', 0.000000, '', 2, '2023-10-10 22:47:53', '2023-10-10 22:47:58');

-- --------------------------------------------------------

--
-- Table structure for table `request_form_information`
--

CREATE TABLE `request_form_information` (
  `req_form_information_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `house_member_id` int(11) DEFAULT NULL,
  `address_id` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(100) NOT NULL,
  `schedule_pickup` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `request_form_information`
--

INSERT INTO `request_form_information` (`req_form_information_id`, `user_id`, `house_member_id`, `address_id`, `created_at`, `updated_at`, `status`, `schedule_pickup`) VALUES
(115, 5, 23, '17', '2023-10-10 02:14:31', '2023-10-10 22:56:58', 'Process', ''),
(116, 5, 23, '20', '2023-10-10 02:29:33', '2023-10-10 02:29:33', 'Pending', ''),
(117, 5, 23, '18', '2023-10-10 02:29:59', '2023-10-10 02:29:59', 'Pending', ''),
(118, 5, 23, '1', '2023-10-10 03:36:28', '2023-10-10 03:36:28', 'Pending', ''),
(119, 5, 23, '1', '2023-10-10 03:51:09', '2023-10-10 03:51:09', 'Pending', ''),
(120, 5, 23, '1', '2023-10-10 03:51:14', '2023-10-10 03:51:14', 'Pending', ''),
(121, 5, 23, '1', '2023-10-10 03:53:29', '2023-10-10 03:53:29', 'Pending', ''),
(122, 5, 23, '1', '2023-10-10 03:57:09', '2023-10-10 03:57:09', 'Pending', ''),
(123, 5, 23, '1', '2023-10-10 04:00:09', '2023-10-10 04:00:09', 'Pending', ''),
(124, 5, 23, '1', '2023-10-10 04:00:48', '2023-10-10 04:00:48', 'Pending', ''),
(125, 5, 23, '2', '2023-10-10 04:11:27', '2023-10-10 04:11:27', 'Pending', ''),
(126, 5, 23, '7', '2023-10-10 04:25:24', '2023-10-10 04:25:24', 'Pending', ''),
(127, 5, 23, '9', '2023-10-10 04:26:42', '2023-10-10 04:26:42', 'Pending', ''),
(128, 5, 23, '3', '2023-10-10 04:27:23', '2023-10-10 04:27:23', 'Pending', ''),
(129, 5, 23, '3', '2023-10-10 04:30:54', '2023-10-10 04:30:54', 'Pending', ''),
(130, 5, 23, '17', '2023-10-10 04:45:37', '2023-10-10 04:45:37', 'Pending', ''),
(131, 5, 23, '6', '2023-10-10 04:47:10', '2023-10-10 04:47:10', 'Pending', ''),
(132, 5, 23, '4', '2023-10-10 04:48:53', '2023-10-10 04:48:53', 'Pending', ''),
(133, 5, 23, '1', '2023-10-10 04:51:36', '2023-10-10 04:51:36', 'Pending', ''),
(134, 5, 23, '6', '2023-10-10 04:54:24', '2023-10-10 04:54:24', 'Pending', ''),
(135, 5, 23, '1', '2023-10-10 04:57:44', '2023-10-10 04:57:44', 'Pending', ''),
(136, 5, 23, '1', '2023-10-10 04:58:02', '2023-10-10 04:58:02', 'Pending', ''),
(137, 5, 23, '1', '2023-10-10 04:58:32', '2023-10-10 04:58:32', 'Pending', ''),
(138, 5, 23, '5', '2023-10-10 05:01:49', '2023-10-10 05:01:49', 'Pending', ''),
(139, 5, 23, '1', '2023-10-10 05:02:34', '2023-10-10 05:02:34', 'Pending', ''),
(140, 5, 23, '1', '2023-10-10 05:05:05', '2023-10-10 05:05:05', 'Pending', ''),
(141, 5, 23, '1', '2023-10-10 05:07:12', '2023-10-10 05:07:12', 'Pending', ''),
(142, 5, 23, '1', '2023-10-10 05:12:55', '2023-10-10 05:12:55', 'Pending', ''),
(143, 5, 23, '1', '2023-10-10 05:18:07', '2023-10-10 05:18:07', 'Pending', ''),
(144, 5, 23, '1', '2023-10-10 22:40:57', '2023-10-10 22:40:57', 'Pending', ''),
(145, 5, 23, '1', '2023-10-10 22:41:00', '2023-10-10 22:41:00', 'Pending', ''),
(146, 5, 23, '1', '2023-10-10 22:41:15', '2023-10-10 22:41:15', 'Pending', ''),
(147, 5, 23, '1', '2023-10-10 22:43:29', '2023-10-10 22:57:23', 'Process', ''),
(148, 5, 23, '1', '2023-10-10 22:47:53', '2023-10-10 22:57:05', 'Process', '');

-- --------------------------------------------------------

--
-- Table structure for table `request_form_type`
--

CREATE TABLE `request_form_type` (
  `req_form_type_id` int(11) NOT NULL,
  `req_form_information_id` int(11) DEFAULT NULL,
  `req_id` int(11) DEFAULT 0,
  `purpose` varchar(50) NOT NULL,
  `terms_of_living` varchar(50) NOT NULL,
  `cedula_number` varchar(100) NOT NULL,
  `date_deceased` varchar(100) NOT NULL,
  `place_of_death` varchar(255) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `mother_name` varchar(255) NOT NULL,
  `father_age` varchar(100) NOT NULL,
  `mother_age` varchar(100) NOT NULL,
  `animal_name` varchar(100) NOT NULL,
  `num_animal` int(11) NOT NULL,
  `sell_to` varchar(100) NOT NULL,
  `address_person` varchar(100) NOT NULL,
  `name_partner` varchar(100) NOT NULL,
  `bdate_partner` varchar(100) NOT NULL,
  `living_together` varchar(100) NOT NULL,
  `num_living_together` int(11) NOT NULL,
  `attached_photo` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_pickup` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `request_form_type`
--

INSERT INTO `request_form_type` (`req_form_type_id`, `req_form_information_id`, `req_id`, `purpose`, `terms_of_living`, `cedula_number`, `date_deceased`, `place_of_death`, `father_name`, `mother_name`, `father_age`, `mother_age`, `animal_name`, `num_animal`, `sell_to`, `address_person`, `name_partner`, `bdate_partner`, `living_together`, `num_living_together`, `attached_photo`, `created_at`, `updated_at`, `date_pickup`) VALUES
(120, 88, 1, 'CALINAN SLAUGHTER HOUSE REQUIREMENT ', '', '', 'null', '', '', '', '', '', 'Pig', 3, 'Richard Gomez', 'Mintal, Davao City', '', '', '', 0, '', '2022-10-07 19:56:33', '2022-10-08 09:28:54', ''),
(121, 89, 3, 'For us', '', '', 'null', '', '', '', '', '', '', 0, '', '', 'Juan Tamad', '2000-01-02', 'years', 3, '', '2022-10-07 20:48:41', '2022-10-07 20:48:41', ''),
(122, 90, 2, 'School Requirement', '', '', 'null', '', 'Rudy Pathon', 'Elizabeth Pathon', '50', '45', '', 0, '', '', '', '', '', 0, '', '2022-10-08 09:59:54', '2022-10-08 09:59:54', ''),
(123, 91, 4, 'N/A', '', '', '2022-10-08', 'Mintal, Davao City', '', '', '', '', '', 0, '', '', '', '', '', 0, '', '2022-10-08 10:00:56', '2022-10-08 10:00:56', ''),
(124, 92, 5, 'PCSO BILLING ASSISTANCE of JOVELY SULIBIO DIOLOLA ', '', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, '', '2022-10-08 10:01:29', '2022-10-08 10:01:29', ''),
(125, 93, 6, 'BIR REQUIREMENT', '', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, '', '2022-10-08 10:01:55', '2022-10-08 10:01:55', ''),
(126, 94, 7, 'N/A', '5', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, '', '2022-10-08 10:02:24', '2022-10-08 10:02:24', ''),
(127, 95, 8, 'EMPLOYMENT REQUIREMENT', '', '06579626', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, '', '2022-10-08 10:02:56', '2022-10-08 10:02:56', ''),
(128, 96, 4, 'N/A', '', '', '2022-10-09', 'Purok 7B7 Block 20 Lot 4, Barangay Los Amigos, Tugbok District, Davao City ', '', '', '', '', 'Cow', 0, '', '', '', '', '', 0, '', '2022-10-09 20:32:57', '2022-10-09 20:32:57', ''),
(129, 97, 7, 'For house', '3', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, '', '2022-10-10 18:22:16', '2022-10-10 18:22:16', ''),
(130, 98, 3, 'asdasdasdas', '', '', 'null', '', '', '', '', '', '', 0, '', '', 'asdasd', '2023-03-01', 'months', 6, '', '2023-03-07 02:07:54', '2023-09-22 22:57:59', ''),
(131, 99, 2, 'job', '', '', 'null', '', 'fr', 'rr', '65', '60', '', 0, '', '', '', '', '', 0, '', '2023-09-22 22:21:09', '2023-09-22 22:58:07', ''),
(142, 110, 5, 'job', '', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, '', '2023-10-10 02:06:43', '2023-10-10 02:06:43', ''),
(143, 111, 5, 'job', '', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, '', '2023-10-10 02:07:14', '2023-10-10 02:07:14', ''),
(144, 112, 5, 'sdasd', '', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, '', '2023-10-10 02:07:33', '2023-10-10 02:07:33', ''),
(145, 113, 6, 'sdasd', '', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, '', '2023-10-10 02:09:23', '2023-10-10 02:09:23', ''),
(146, 114, 6, 'sdasd', '', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, '', '2023-10-10 02:09:24', '2023-10-10 02:09:24', ''),
(147, 115, 5, 'fffffffffffff', '', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, '', '2023-10-10 02:14:31', '2023-10-10 02:14:31', ''),
(148, 116, 6, 'qqqq', '', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, '', '2023-10-10 02:29:33', '2023-10-10 02:29:33', ''),
(149, 117, 5, 'xddd', '', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, '', '2023-10-10 02:29:59', '2023-10-10 02:29:59', ''),
(150, 123, 5, 'eee', '', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, '', '2023-10-10 04:00:09', '2023-10-10 04:00:09', ''),
(151, 124, 5, 'qqq', '', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, '', '2023-10-10 04:00:48', '2023-10-10 04:00:48', ''),
(152, 125, 5, 'rrrr', '', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, '', '2023-10-10 04:11:27', '2023-10-10 04:11:27', ''),
(153, 126, 5, 'rrr', '', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, '', '2023-10-10 04:25:24', '2023-10-10 04:25:24', ''),
(154, 127, 5, '', '', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, '', '2023-10-10 04:26:42', '2023-10-10 04:26:42', ''),
(155, 128, 5, 'dddddd', '', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, '', '2023-10-10 04:27:23', '2023-10-10 04:27:23', ''),
(156, 129, 5, 'e', '', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, '', '2023-10-10 04:30:54', '2023-10-10 04:30:54', ''),
(157, 130, 5, 'ddd', '', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, 'none', '2023-10-10 04:45:37', '2023-10-10 04:45:37', ''),
(158, 131, 5, 'fff', '', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, 'none', '2023-10-10 04:47:10', '2023-10-10 04:47:10', ''),
(159, 132, 5, '', '', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, 'none', '2023-10-10 04:48:53', '2023-10-10 04:48:53', ''),
(160, 133, 5, 'edsad', '', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, 'none', '2023-10-10 04:51:36', '2023-10-10 04:51:36', ''),
(161, 134, 5, 'sss', '', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, 'none', '2023-10-10 04:54:24', '2023-10-10 04:54:24', ''),
(162, 135, 0, '', '', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, 'none', '2023-10-10 04:57:44', '2023-10-10 04:57:44', ''),
(163, 136, 5, 'saasdasd', '', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, 'none', '2023-10-10 04:58:02', '2023-10-10 04:58:02', ''),
(164, 137, 5, 'ddd', '', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, 'none', '2023-10-10 04:58:32', '2023-10-10 04:58:32', ''),
(165, 138, 5, 'ssss', '', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, 'none', '2023-10-10 05:01:49', '2023-10-10 05:01:49', ''),
(166, 139, 5, '', '', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, 'none', '2023-10-10 05:02:34', '2023-10-10 05:02:34', ''),
(167, 140, 5, 'rrr', '', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, 'none', '2023-10-10 05:05:05', '2023-10-10 05:05:05', ''),
(168, 141, 5, 'ss', '', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, 'none', '2023-10-10 05:07:12', '2023-10-10 05:07:12', ''),
(169, 142, 5, 'dd', '', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, '65246cd7a453e.png', '2023-10-10 05:12:55', '2023-10-10 05:12:55', ''),
(170, 143, 5, 'dff', '', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, '65246e0fb92a0.png', '2023-10-10 05:18:07', '2023-10-10 05:18:07', ''),
(171, 144, 5, '11111111111', '', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, '6525627980017.png', '2023-10-10 22:40:57', '2023-10-10 22:40:57', ''),
(172, 145, 5, '11111111111', '', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, '6525627c4de2c.png', '2023-10-10 22:41:00', '2023-10-10 22:41:00', ''),
(173, 146, 5, '11111111111', '', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, '6525628bedbea.png', '2023-10-10 22:41:15', '2023-10-10 22:41:15', ''),
(174, 147, 5, 'tttt', '', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, '65256311dfda0.png', '2023-10-10 22:43:29', '2023-10-10 22:43:29', ''),
(175, 148, 5, 'uuuu', '', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, '652564197a730.jpg', '2023-10-10 22:47:53', '2023-10-10 22:47:53', '');

-- --------------------------------------------------------

--
-- Table structure for table `status_type`
--

CREATE TABLE `status_type` (
  `id` int(11) NOT NULL,
  `status_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `status_type`
--

INSERT INTO `status_type` (`id`, `status_type`) VALUES
(1, 'waiting_confimation'),
(2, 'confirmed_by_resident'),
(3, 'pending_request'),
(4, 'approved'),
(5, 'disapproved'),
(6, 'processing'),
(7, 'ready to get'),
(8, 'cancel');

-- --------------------------------------------------------

--
-- Table structure for table `tblactivity`
--

CREATE TABLE `tblactivity` (
  `id` int(11) NOT NULL,
  `dateofactivity` date NOT NULL,
  `activity` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblactivity`
--

INSERT INTO `tblactivity` (`id`, `dateofactivity`, `activity`, `description`) VALUES
(1, '2022-09-09', 'dsadasdas', 'adasdasdas');

-- --------------------------------------------------------

--
-- Table structure for table `tblactivityphoto`
--

CREATE TABLE `tblactivityphoto` (
  `id` int(11) NOT NULL,
  `activityid` int(11) NOT NULL,
  `filename` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblactivityphoto`
--

INSERT INTO `tblactivityphoto` (`id`, `activityid`, `filename`) VALUES
(1, 1, '1662435755708coke.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblblotter`
--

CREATE TABLE `tblblotter` (
  `id` int(11) NOT NULL,
  `yearRecorded` varchar(4) NOT NULL,
  `dateRecorded` date NOT NULL,
  `complainant` text NOT NULL,
  `cage` int(11) NOT NULL,
  `caddress` text NOT NULL,
  `ccontact` int(11) NOT NULL,
  `personToComplain` text NOT NULL,
  `page` int(11) NOT NULL,
  `paddress` text NOT NULL,
  `pcontact` int(11) NOT NULL,
  `complaint` text NOT NULL,
  `actionTaken` varchar(50) NOT NULL,
  `sStatus` varchar(50) NOT NULL,
  `locationOfIncidence` text NOT NULL,
  `recordedby` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblclearance`
--

CREATE TABLE `tblclearance` (
  `id` int(11) NOT NULL,
  `clearanceNo` int(11) NOT NULL,
  `residentid` int(11) NOT NULL,
  `findings` text NOT NULL,
  `purpose` text NOT NULL,
  `orNo` int(11) NOT NULL,
  `samount` int(11) NOT NULL,
  `dateRecorded` date NOT NULL,
  `recordedBy` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblclearance`
--

INSERT INTO `tblclearance` (`id`, `clearanceNo`, `residentid`, `findings`, `purpose`, `orNo`, `samount`, `dateRecorded`, `recordedBy`, `status`) VALUES
(3, 2311, 2, 'ffdfd', 'example', 12312, 250, '2022-09-06', 'Fernando', 'Approved'),
(4, 0, 2, '', 'example', 0, 0, '2022-09-08', 'Fernando', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `tblhousehold`
--

CREATE TABLE `tblhousehold` (
  `id` int(11) NOT NULL,
  `householdno` int(11) NOT NULL,
  `zone` varchar(11) NOT NULL,
  `totalhouseholdmembers` int(2) NOT NULL,
  `headoffamily` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbllogs`
--

CREATE TABLE `tbllogs` (
  `id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `logdate` datetime NOT NULL,
  `action` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbllogs`
--

INSERT INTO `tbllogs` (`id`, `user`, `logdate`, `action`) VALUES
(1, 'Administrator', '2021-10-21 16:27:24', 'Added Resident named Suares, Jude Reyes'),
(2, 'Administrator', '2021-10-22 12:16:56', 'Update Resident named Suares, Jude Reyes'),
(3, 'Administrator', '2022-09-06 06:24:24', 'Added Resident named Torres, Fernando L'),
(4, 'Administrator', '2022-09-06 11:42:35', 'Added Activity dsadasdas'),
(5, 'Administrator', '2022-10-12 12:58:40', 'Added Zone number 123123'),
(6, 'Administrator', '2022-10-12 13:06:13', 'Added Zone number 123123'),
(7, 'Administrator', '2022-10-12 13:10:48', 'Update Zone number '),
(8, 'Administrator', '2022-10-12 13:10:52', 'Update Zone number '),
(9, 'Administrator', '2022-10-12 13:11:04', 'Update Zone number '),
(10, 'Administrator', '2022-10-16 21:21:52', 'Update Zone number '),
(11, 'Administrator', '2022-10-16 21:21:57', 'Update Zone number ');

-- --------------------------------------------------------

--
-- Table structure for table `tblofficial`
--

CREATE TABLE `tblofficial` (
  `id` int(11) NOT NULL,
  `sPosition` varchar(50) NOT NULL,
  `completeName` text NOT NULL,
  `pcontact` varchar(20) NOT NULL,
  `paddress` text NOT NULL,
  `termStart` date NOT NULL,
  `termEnd` date NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblofficial`
--

INSERT INTO `tblofficial` (`id`, `sPosition`, `completeName`, `pcontact`, `paddress`, `termStart`, `termEnd`, `status`) VALUES
(4, 'Captain', 'Reymar Medes', '091234567890', 'Brgy. Tan-awan. Kabankalan City', '2018-05-22', '2022-05-22', 'Ongoing Term'),
(5, 'Kagawad(Ordinance)', 'Benjie Miranda', '09234567894', 'Brgy. Tan-awan. Kabankalan City', '2018-05-21', '2022-05-23', 'Ongoing Term'),
(6, 'Kagawad(Public Safety)', 'Rhodora Molina', '09452316722', 'Brgy. Tan-awan. Kabankalan City', '2018-05-22', '2022-05-22', 'Ongoing Term'),
(7, 'Kagawad(Tourism)', 'Ronilo Boyayot', '09456732456', 'Brgy. Tan-awan. Kabankalan City', '2018-05-22', '2022-05-22', 'Ongoing Term'),
(8, 'Kagawad(Budget & Finance)', 'Dondon Laurico', '09337869045', 'Brgy. Tan-awan. Kabankalan City', '2018-05-22', '2022-05-22', 'Ongoing Term'),
(9, 'Kagawad(Agriculture)', 'Joseph Soligan', '09227865784', 'Brgy.Tan-awan, Kabankalan City', '2018-05-22', '2022-05-22', 'Ongoing Term'),
(10, 'Kagawad(Education)', 'Idol Anono', '094567892341', 'Brgy. Tan-awan. Kabankalan City', '2018-05-22', '2022-05-23', 'Ongoing Term'),
(11, 'Kagawad(Infrastracture)', 'Rolly Torres', '09386784563', 'Brgy. Tan-awan. Kabankalan City', '2018-05-22', '2022-05-22', 'Ongoing Term');

-- --------------------------------------------------------

--
-- Table structure for table `tblpermit`
--

CREATE TABLE `tblpermit` (
  `id` int(11) NOT NULL,
  `residentid` int(11) NOT NULL,
  `businessName` text NOT NULL,
  `businessAddress` text NOT NULL,
  `typeOfBusiness` varchar(50) NOT NULL,
  `orNo` int(11) NOT NULL,
  `samount` int(11) NOT NULL,
  `dateRecorded` date NOT NULL,
  `recordedBy` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpermit`
--

INSERT INTO `tblpermit` (`id`, `residentid`, `businessName`, `businessAddress`, `typeOfBusiness`, `orNo`, `samount`, `dateRecorded`, `recordedBy`, `status`) VALUES
(1, 2, 'Juan Company', 'Prk1', 'Merchandising', 0, 0, '2022-09-13', 'fj', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `tblresident`
--

CREATE TABLE `tblresident` (
  `id` int(11) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `mname` varchar(20) NOT NULL,
  `bdate` varchar(20) NOT NULL,
  `bplace` text NOT NULL,
  `age` int(11) NOT NULL,
  `barangay` varchar(120) NOT NULL,
  `zone` varchar(5) NOT NULL,
  `totalhousehold` int(5) NOT NULL,
  `differentlyabledperson` varchar(100) NOT NULL,
  `relationtohead` varchar(50) NOT NULL,
  `maritalstatus` varchar(50) NOT NULL,
  `bloodtype` varchar(10) NOT NULL,
  `civilstatus` varchar(20) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `monthlyincome` int(12) NOT NULL,
  `householdnum` int(11) NOT NULL,
  `lengthofstay` int(11) NOT NULL,
  `religion` varchar(50) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `skills` text NOT NULL,
  `igpitID` int(11) NOT NULL,
  `philhealthNo` int(12) NOT NULL,
  `highestEducationalAttainment` varchar(50) NOT NULL,
  `houseOwnershipStatus` varchar(50) NOT NULL,
  `landOwnershipStatus` varchar(20) NOT NULL,
  `dwellingtype` varchar(20) NOT NULL,
  `waterUsage` varchar(20) NOT NULL,
  `lightningFacilities` varchar(20) NOT NULL,
  `sanitaryToilet` varchar(20) NOT NULL,
  `formerAddress` text NOT NULL,
  `remarks` text NOT NULL,
  `image` text NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblresident`
--

INSERT INTO `tblresident` (`id`, `lname`, `fname`, `mname`, `bdate`, `bplace`, `age`, `barangay`, `zone`, `totalhousehold`, `differentlyabledperson`, `relationtohead`, `maritalstatus`, `bloodtype`, `civilstatus`, `occupation`, `monthlyincome`, `householdnum`, `lengthofstay`, `religion`, `nationality`, `gender`, `skills`, `igpitID`, `philhealthNo`, `highestEducationalAttainment`, `houseOwnershipStatus`, `landOwnershipStatus`, `dwellingtype`, `waterUsage`, `lightningFacilities`, `sanitaryToilet`, `formerAddress`, `remarks`, `image`, `username`, `password`) VALUES
(1, 'Suares', 'Jude', 'Reyes', '2021-10-12', 'Brgy. Mambato, Himamaylan City', 0, 'Brgy.Tan-awan', '1', 10, 'yes', 'Brother', 'single', '0+', 'Single', 'Programmer', 300000, 1, 5, 'Catholic', 'Filipino', 'Male', 'Programming', 1122, 2147483647, 'Doctorate degree', 'Live with Parents/Relatives', 'Care Taker', '2nd Option', 'Deep Well', '2147483647', 'Water-sealed', 'brgy. enlcaro', 'None', '1634804844819_[Complete] Laravel Ecommerce Project with Source Code.png', 'jude', 'jude123'),
(2, 'Tamad', 'Juan', 'L', '2022-09-14', 'dsa', 0, 'dsa', '21321', 1, 'dasds', 'dsadss', 'asd', 'asdas', 'adas', 'dsad', 123, 2323, 44, 'dasd', 'asdsa', 'Male', 'ads', 213, 4534543, 'Doctorate degree', 'Own Home', 'Owned', '1st Option', 'Faucet', 'Lamp', 'Antipolo', 'dsad', 'dasdaas', '1662416664725_das.jpg', 'resident', 'resident123');

-- --------------------------------------------------------

--
-- Table structure for table `tblstaff`
--

CREATE TABLE `tblstaff` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblstaff`
--

INSERT INTO `tblstaff` (`id`, `name`, `username`, `password`) VALUES
(1, 'Adones Evangelista', 'adones', 'adones123');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`id`, `username`, `password`, `type`) VALUES
(1, 'admin', 'admin', 'administrator'),
(2, 'zone', 'zone', 'zoneleader');

-- --------------------------------------------------------

--
-- Table structure for table `tblzone`
--

CREATE TABLE `tblzone` (
  `id` int(11) NOT NULL,
  `zone` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblzone`
--

INSERT INTO `tblzone` (`id`, `zone`, `username`, `password`) VALUES
(1, '051820', 'zone_leader', 'zone_leader123'),
(5, '123123', 'zone_leader2', 'zone_leader2'),
(6, '123123123', 'zone_leader3', 'zone_leader3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_announcement`
--

CREATE TABLE `tbl_announcement` (
  `announce_id` int(11) NOT NULL,
  `ann_title` varchar(100) NOT NULL,
  `ann_description` varchar(100) NOT NULL,
  `ann_images` varchar(300) NOT NULL,
  `ann_date_posted` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_announcement`
--

INSERT INTO `tbl_announcement` (`announce_id`, `ann_title`, `ann_description`, `ann_images`, `ann_date_posted`) VALUES
(1, 'Fiesta in our Barangay', 'Enjoy and have fun!', 'image_ann/1665204579_85.png', 'October 8, 2022 12:49pm'),
(3, 'Bagyo sa atin', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the ', 'image_ann/1665319875_13.png', 'October 9, 2022 8:50pm');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_resident_house_member`
--

CREATE TABLE `tbl_resident_house_member` (
  `household_id` int(11) NOT NULL,
  `f_name` varchar(300) NOT NULL,
  `l_name` varchar(100) NOT NULL,
  `m_name` varchar(100) NOT NULL,
  `hmemberb_date` varchar(300) NOT NULL,
  `hmember_relationship` varchar(300) NOT NULL,
  `hmember_occupation` varchar(300) NOT NULL,
  `household_uk` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_resident_house_member`
--

INSERT INTO `tbl_resident_house_member` (`household_id`, `f_name`, `l_name`, `m_name`, `hmemberb_date`, `hmember_relationship`, `hmember_occupation`, `household_uk`) VALUES
(23, 'Donalds', 'Perry', 'Bacua', '2006-12-16', 'Sister', 'Occ1', '241663324499'),
(25, 'Fj ', 'Cruz', 'Moze', '2000-09-24', 'Brother1', 'Occu2', '141663405301'),
(26, 'Justin', 'Bohannon', 'Luyao', '2000-10-01', 'Broher1', 'Programmer1', '561664595055'),
(27, 'Peter_fname2', 'Peter_lname2', 'Peter_mname2', '2000-10-01', 'Broher2', 'Programmer2', '561664595055'),
(28, 'Peter', 'Cayatano', 'Lost anges', '2000-10-01', 'Owner account', 'Software developer', '561664595055'),
(29, 'Juan', 'Dela', 'Cruz', '2022-10-08', 'Owner account', 'Programmmer', '141663405301'),
(31, 'Clays', 'Shaw', 'Luz', '1998-12-10', 'Brother', 'Seaman', '871665397706'),
(32, 'Fletcher', 'Bridges', 'Luz', '1999-12-12', 'Eldest', 'Doctor', '871665397706'),
(33, 'Denis', 'Preston', 'Luz', '2000-11-10', 'Owner account', 'Designer', '871665397706');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_resident_new`
--

CREATE TABLE `tbl_resident_new` (
  `resident_id` int(11) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `f_name` varchar(50) NOT NULL,
  `m_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fullname_hhead` varchar(50) NOT NULL,
  `bday_hhead` varchar(50) NOT NULL,
  `occu_hhead` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `fullname_spouse` varchar(50) NOT NULL,
  `bday_spouse` varchar(50) NOT NULL,
  `occu_spouse` varchar(50) NOT NULL,
  `belongings` varchar(50) NOT NULL,
  `specify_belongings` varchar(50) NOT NULL,
  `household_member_uk` varchar(300) NOT NULL,
  `residence_status` varchar(50) NOT NULL,
  `specify_resident_stat` varchar(50) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `register_voter` varchar(50) NOT NULL,
  `benificiary` varchar(50) NOT NULL,
  `specify_benificiary` varchar(50) NOT NULL,
  `pensioner` varchar(50) NOT NULL,
  `specify_pensioner` varchar(50) NOT NULL,
  `income_month` double(8,2) NOT NULL,
  `profile_photo` varchar(500) NOT NULL,
  `remarks` varchar(500) NOT NULL,
  `create_at` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_resident_new`
--

INSERT INTO `tbl_resident_new` (`resident_id`, `l_name`, `f_name`, `m_name`, `email`, `contact_no`, `address`, `username`, `password`, `fullname_hhead`, `bday_hhead`, `occu_hhead`, `status`, `fullname_spouse`, `bday_spouse`, `occu_spouse`, `belongings`, `specify_belongings`, `household_member_uk`, `residence_status`, `specify_resident_stat`, `pwd`, `register_voter`, `benificiary`, `specify_benificiary`, `pensioner`, `specify_pensioner`, `income_month`, `profile_photo`, `remarks`, `create_at`) VALUES
(5, 'Tanuron', 'Kenneth', 'Luyao', 'kenneth.tanuron@gmail.com', '09361776112', 'Philippines', 'admin', 'password', 'Juan tamad', '2022-09-16', 'Programmer', 'Married', 'Joanna Rica Adalin', '2022-09-16', 'HRs', 'Yes', 'Baptist', '241663324499', 'Visitor', 'Visitor', 'Yes', 'Yes', 'Yes', '4ps', 'Yes', 'Loan', 10000.00, '1665504984_61.png', 'Occ2occ2occ2occ2occ2occ2occ2occ2occ2occ2occ2occ2occ2occ2occ2occ2occ2occ2occ2occ2occ2occ2occ2occ2occ2occ2occ2occ2occ2occ2occ2occ2occ2occ2occ2occ2occ2occ2occ2occ2occ2occ2occ2occ2occ2occ2', 'September 16, 2022 6:35pm'),
(6, 'Dela', 'Juans', 'Cruz', 'kenneth.tanuron@gmail.com', '09361776112', 'Philippines', 'juan', '123', 'Kenneth tanuron', '2022-10-08', 'Programmmer', 'Single', 'none', 'none', 'none', 'Yes', 'Herosm', '141663405301', 'Visitor', 'Visitor', 'No', 'Yes', 'Yes', '4ps', 'Yes', 'loan', 10000.00, '1665926901_59.png', 'Awdawdawdawdawdawdawdawdawdawdawdadawdawdawdawdadadawd', 'September 17, 2022 5:01pm'),
(7, 'Cayatano', 'Peter', 'Lost anges', 'peter@gmail.com', '09361776112', 'Philippines', 'peter', '123', 'Dora explorer', '2022-10-01', 'Software developer', 'Single', 'none', 'none', 'none', 'No', 'none', '561664595055', 'Permanent / Owned', 'none', 'Yes', 'Yes', 'No', 'none', 'No', 'none', 10000.00, '1664595055_15.png', 'Awdawd', 'October 1, 2022 11:30am'),
(8, 'Preston', 'Denis', 'Luz', 'denis@gmail.com', '09123456789', 'Prk 1-a bernales', 'denis', '123', 'Kenneth tanuron', '2000-11-10', 'Designer', 'Single', 'none', 'none', 'none', 'Yes', 'Lumad', '871665397706', 'Renter', 'none', 'Yes', 'Yes', 'No', 'none', 'No', 'none', 200000.00, '1665397706_20.png', 'N/a', 'October 10, 2022 6:28pm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brgy_purok`
--
ALTER TABLE `brgy_purok`
  ADD PRIMARY KEY (`purok_id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`complaint_id`),
  ADD KEY `resident_id` (`resident_id`);

--
-- Indexes for table `receipt_transaction`
--
ALTER TABLE `receipt_transaction`
  ADD PRIMARY KEY (`recep_id`);

--
-- Indexes for table `request_form_information`
--
ALTER TABLE `request_form_information`
  ADD PRIMARY KEY (`req_form_information_id`);

--
-- Indexes for table `request_form_type`
--
ALTER TABLE `request_form_type`
  ADD PRIMARY KEY (`req_form_type_id`);

--
-- Indexes for table `tbl_resident_new`
--
ALTER TABLE `tbl_resident_new`
  ADD PRIMARY KEY (`resident_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brgy_purok`
--
ALTER TABLE `brgy_purok`
  MODIFY `purok_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `receipt_transaction`
--
ALTER TABLE `receipt_transaction`
  MODIFY `recep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT for table `request_form_information`
--
ALTER TABLE `request_form_information`
  MODIFY `req_form_information_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `request_form_type`
--
ALTER TABLE `request_form_type`
  MODIFY `req_form_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `tbl_resident_new`
--
ALTER TABLE `tbl_resident_new`
  MODIFY `resident_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `complaints_ibfk_1` FOREIGN KEY (`resident_id`) REFERENCES `tbl_resident_new` (`resident_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
