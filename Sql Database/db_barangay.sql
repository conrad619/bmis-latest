-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2023 at 06:36 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

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
-- Dumping database structure for db_barangay
DROP DATABASE IF EXISTS `db_barangay`;
CREATE DATABASE IF NOT EXISTS `db_barangay` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_barangay`;

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
(1, 'Transportation of animal and slaughter', '50.000000'),
(2, 'Birth Certificate', '10.000000'),
(3, 'Live-in Certificate', '100.000000'),
(4, 'Death Certificate', '200.000000'),
(5, 'Indigency', '10.000000'),
(6, 'Certificate of low income', '1.000000'),
(7, 'Certificate of residency', '1.000000'),
(8, 'Barangay Clearance', '1.000000');

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
(109, 76, 1, 76, 1, NULL, '', '0.000000', '', 2, '2022-10-07 19:22:42', '2022-10-07 19:22:46'),
(110, 77, 1, 77, 1, NULL, '', '0.000000', '', 2, '2022-10-07 19:28:09', '2022-10-07 19:28:12'),
(111, 78, 1, 78, 1, NULL, '', '0.000000', '', 2, '2022-10-07 19:30:35', '2022-10-07 19:30:38'),
(112, 79, 1, 79, 1, NULL, '', '0.000000', '', 2, '2022-10-07 19:37:18', '2022-10-07 19:37:20'),
(113, 80, 1, 116, 1, NULL, '', '0.000000', '', 2, '2022-10-07 19:41:36', '2022-10-07 19:41:38'),
(114, 81, 1, 81, 1, NULL, '', '0.000000', '', 2, '2022-10-07 19:44:49', '2022-10-07 19:44:50'),
(115, 82, 1, 117, 1, NULL, '', '0.000000', '', 2, '2022-10-07 19:45:29', '2022-10-07 19:45:31'),
(116, 83, 1, 83, 1, NULL, '', '0.000000', '', 2, '2022-10-07 19:50:20', '2022-10-07 19:50:21'),
(117, 84, 1, 118, 1, NULL, '', '0.000000', '', 2, '2022-10-07 19:51:01', '2022-10-07 19:51:02'),
(118, 85, 1, 85, 1, NULL, '', '0.000000', '', 2, '2022-10-07 19:51:56', '2022-10-07 19:51:57'),
(119, 86, 7, 86, 1, NULL, '', '0.000000', '', 2, '2022-10-07 19:52:34', '2022-10-07 19:52:37'),
(120, 87, 1, 119, 1, NULL, '', '0.000000', '', 2, '2022-10-07 19:53:08', '2022-10-07 19:53:09'),
(121, 88, 1, 120, 1, NULL, '', '0.000000', '', 2, '2022-10-07 19:56:33', '2022-10-07 19:56:34'),
(122, 89, 3, 121, 1, NULL, '', '0.000000', '', 2, '2022-10-07 20:48:41', '2022-10-07 20:48:45'),
(123, 90, 2, 122, 1, NULL, '', '0.000000', '', 2, '2022-10-08 09:59:54', '2022-10-08 09:59:55'),
(124, 91, 4, 123, 1, NULL, '', '0.000000', '', 2, '2022-10-08 10:00:56', '2022-10-08 10:00:58'),
(125, 92, 5, 124, 1, NULL, '', '0.000000', '', 2, '2022-10-08 10:01:29', '2022-10-08 10:01:31'),
(126, 93, 6, 125, 1, NULL, '', '0.000000', '', 2, '2022-10-08 10:01:55', '2022-10-08 10:01:56'),
(127, 94, 7, 126, 1, NULL, '', '0.000000', '', 2, '2022-10-08 10:02:24', '2022-10-08 10:02:25'),
(128, 95, 8, 127, 1, NULL, '', '0.000000', '', 2, '2022-10-08 10:02:56', '2022-10-08 10:02:57'),
(129, 96, 4, 128, 1, NULL, '', '0.000000', '', 2, '2022-10-09 20:32:57', '2022-10-09 20:33:01'),
(130, 97, 7, 129, 1, NULL, '', '0.000000', '', 2, '2022-10-10 18:22:16', '2022-10-10 18:22:17'),
(0, 0, 3, 0, 1, NULL, '', '0.000000', '', 2, '2023-03-07 02:07:54', '2023-03-07 02:07:55');

-- --------------------------------------------------------

--
-- Table structure for table `request_form_information`
--

CREATE TABLE `request_form_information` (
  `req_form_information_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `house_member_id` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(100) NOT NULL,
  `schedule_pickup` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `request_form_information`
--

INSERT INTO `request_form_information` (`req_form_information_id`, `user_id`, `house_member_id`, `address`, `created_at`, `updated_at`, `status`, `schedule_pickup`) VALUES
(88, 7, 26, 'Prk1-A', '2022-10-07 19:56:33', '2022-10-08 11:56:19', 'completed', 'October 30, 2022 9:30am'),
(89, 7, 27, 'Prk1-B', '2022-10-07 20:48:41', '2022-10-09 20:42:01', 'completed', 'October 31, 2022 10:00am'),
(90, 7, 26, 'Prk1-A', '2022-10-08 09:59:54', '2022-10-08 10:03:16', 'ready_pick_up', 'October 8, 2022 10:03am'),
(91, 7, 26, 'Prk1-A', '2022-10-08 10:00:56', '2022-10-08 10:03:25', 'ready_pick_up', 'October 8, 2022 10:03pm'),
(92, 7, 26, 'Prk1-A', '2022-10-08 10:01:29', '2022-10-08 10:03:34', 'ready_pick_up', 'October 8, 2022 10:03pm'),
(93, 7, 26, 'Prk1-A', '2022-10-08 10:01:55', '2022-10-08 10:03:51', 'ready_pick_up', 'October 8, 2022 10:03pm'),
(94, 7, 26, 'Prk1-A', '2022-10-08 10:02:24', '2022-10-08 10:04:04', 'ready_pick_up', 'October 8, 2022 10:04am'),
(95, 7, 26, 'Prk1-A', '2022-10-08 10:02:56', '2022-10-08 10:04:14', 'ready_pick_up', 'October 8, 2022 10:04pm'),
(96, 6, 25, 'Prk1-B', '2022-10-09 20:32:57', '2022-10-09 20:37:12', 'completed', 'October 31, 2022 9:00am'),
(97, 5, 30, 'Prk1-A', '2022-10-10 18:22:16', '2022-10-10 18:29:48', 'Process', ''),
(0, 5, 23, 'prk1', '2023-03-07 02:07:54', '2023-03-07 02:27:42', 'Process', '');

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
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_pickup` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `request_form_type`
--

INSERT INTO `request_form_type` (`req_form_type_id`, `req_form_information_id`, `req_id`, `purpose`, `terms_of_living`, `cedula_number`, `date_deceased`, `place_of_death`, `father_name`, `mother_name`, `father_age`, `mother_age`, `animal_name`, `num_animal`, `sell_to`, `address_person`, `name_partner`, `bdate_partner`, `living_together`, `num_living_together`, `created_at`, `updated_at`, `date_pickup`) VALUES
(120, 88, 1, 'CALINAN SLAUGHTER HOUSE REQUIREMENT ', '', '', 'null', '', '', '', '', '', 'Pig', 3, 'Richard Gomez', 'Mintal, Davao City', '', '', '', 0, '2022-10-07 19:56:33', '2022-10-08 09:28:54', ''),
(121, 89, 3, 'For us', '', '', 'null', '', '', '', '', '', '', 0, '', '', 'Juan Tamad', '2000-01-02', 'years', 3, '2022-10-07 20:48:41', '2022-10-07 20:48:41', ''),
(122, 90, 2, 'School Requirement', '', '', 'null', '', 'Rudy Pathon', 'Elizabeth Pathon', '50', '45', '', 0, '', '', '', '', '', 0, '2022-10-08 09:59:54', '2022-10-08 09:59:54', ''),
(123, 91, 4, 'N/A', '', '', '2022-10-08', 'Mintal, Davao City', '', '', '', '', '', 0, '', '', '', '', '', 0, '2022-10-08 10:00:56', '2022-10-08 10:00:56', ''),
(124, 92, 5, 'PCSO BILLING ASSISTANCE of JOVELY SULIBIO DIOLOLA ', '', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, '2022-10-08 10:01:29', '2022-10-08 10:01:29', ''),
(125, 93, 6, 'BIR REQUIREMENT', '', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, '2022-10-08 10:01:55', '2022-10-08 10:01:55', ''),
(126, 94, 7, 'N/A', '5', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, '2022-10-08 10:02:24', '2022-10-08 10:02:24', ''),
(127, 95, 8, 'EMPLOYMENT REQUIREMENT', '', '06579626', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, '2022-10-08 10:02:56', '2022-10-08 10:02:56', ''),
(128, 96, 4, 'N/A', '', '', '2022-10-09', 'Purok 7B7 Block 20 Lot 4, Barangay Los Amigos, Tugbok District, Davao City ', '', '', '', '', 'Cow', 0, '', '', '', '', '', 0, '2022-10-09 20:32:57', '2022-10-09 20:32:57', ''),
(129, 97, 7, 'For house', '3', '', 'null', '', '', '', '', '', '', 0, '', '', '', '', '', 0, '2022-10-10 18:22:16', '2022-10-10 18:22:16', ''),
(0, 0, 3, 'asdasdasdas', '', '', 'null', '', '', '', '', '', '', 0, '', '', 'asdasd', '2023-03-01', 'months', 6, '2023-03-07 02:07:54', '2023-03-07 02:07:54', '');

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
  `resident_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `create_at` varchar(500) NOT NULL,
  PRIMARY KEY (`resident_id`)
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
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`complaint_id`),
  ADD KEY `resident_id` (`resident_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
