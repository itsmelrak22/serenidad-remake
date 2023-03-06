-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 06, 2023 at 09:18 AM
-- Server version: 8.0.32
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_hor`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `name` varchar(30) NOT NULL,
  `username` varchar(24) NOT NULL,
  `password` varchar(191) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `restriction` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `password`, `restriction`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'Admin', 'admin', 'admin', NULL, '2022-12-01 10:16:37'),
(6, 'Admin 2', 'Admin2', 'admin2', 'admin', '2022-12-01 10:01:49', '2022-12-01 10:16:28'),
(9, 'test', 'test', 'test', 'user', '2022-12-02 14:39:34', '2022-12-02 14:39:34');

-- --------------------------------------------------------

--
-- Table structure for table `chatbot`
--

CREATE TABLE `chatbot` (
  `id` int NOT NULL,
  `messages` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `response` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chatbot`
--

INSERT INTO `chatbot` (`id`, `messages`, `response`) VALUES
(2, 'Hello', 'Hey There, How can I help you?'),
(3, 'Hi/Hello/Hy/Hey There', 'Good Day how can we help you?'),
(5, 'location / where is your location / where is the location / where / location? / where is your location? / where is the location? / where?', 'We are located @ Lian, Batangas, Calabarzon, Philippines'),
(6, 'cancel / cancel reservation / reservation cancel / how to cancel reservation', 'Cancellation: 3-4 days before check in'),
(7, 'How much? / How Much/ how much? / rate / rates / rate? / rates / amount / amount? / estimate / estimates? / estimates / estimate ? / How much is the rate / how much is the rate? /how much rate / how much rate? ', 'Serenidad Suites @Matabungkay Beach, Aquino suite. 2500/day (22 hours of stay)\r\n\r\n<hr>\r\n\r\nSerenidad Suites @Matabungkay Beach, Enrique Kubo 2000/day (22 hours of stay)'),
(8, 'help / Help! / HELP / Help', 'you can chat this basic commands, \r\n\r\nHello, Hi,Hey There - Greetings. <hr>\r\nLocation - Hotel Location. <hr>\r\nRate, How much - Hotel Rates.  <hr>\r\nPayment method - Available Payment Methods. <hr>\r\ncancel - Know our cancelation rules.'),
(9, 'payment methods / Payment Method / payment methods? / payment method?', 'Currently our available payment methods are paypal accounts.');

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `id` int NOT NULL,
  `uuid` varchar(255) DEFAULT NULL,
  `firstname` varchar(50) NOT NULL,
  `username` varchar(191) DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `middlename` varchar(30) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `address` varchar(191) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `contactno` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`id`, `uuid`, `firstname`, `username`, `password`, `middlename`, `lastname`, `address`, `contactno`, `created_at`, `updated_at`) VALUES
(1, '3f944dd6-8416-4bf9-91ad-58b329e14abc', 'client', 'client', 'client', 'client', 'client', NULL, '2312321312', '2023-01-28 22:50:44', '2023-01-28 22:50:44'),
(2, 'dc4f6a5c-8d3e-472d-9a9b-626efba99123', 'client2', 'client2', 'client2', 'client2', 'client2', NULL, '2312321312', '2023-01-28 22:59:42', '2023-01-28 22:59:42'),
(3, '83d8b765-4d05-4597-939f-ae5dac444f08', 'rer', 'rer', 'rer', 'wrwr', 'ewrwe', NULL, '09312312341', '2023-01-30 10:21:26', '2023-01-30 10:21:26'),
(4, '784ca956-5c11-433e-a92b-6ea63bc27b92', 'qwerty', 'qwerty', 'qwerty', 'qwerty', 'qwerty', NULL, '12345678902', '2023-01-30 10:22:54', '2023-01-30 10:22:54'),
(5, 'f19a57ac-93a7-4db8-809c-02b92c1d8ed7', 'client', 'client', 'client', 'client', 'client', NULL, '12345678901', '2023-01-30 10:28:08', '2023-01-30 10:28:08'),
(6, 'ad16b5bb-f535-4707-adef-0fbcabf65559', 'karl', 'karl', 'karl', 'karl', 'karl', NULL, '12345678901', '2023-02-19 10:23:20', '2023-02-19 10:23:20'),
(7, 'fcbaf137-66bb-49f5-adfe-75a8c34120dd', 'karl2', 'karl2', 'karl2', 'karl2', 'karl2', NULL, '12345678901', '2023-02-19 12:45:47', '2023-02-19 12:45:47'),
(8, '85e65947-4fa8-4a1e-942e-294d7ff1073e', 'test3', 'test3', 'test3', 'test3', 'test3', NULL, '12345678901', '2023-02-19 14:25:45', '2023-02-19 14:25:45');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int NOT NULL,
  `room_type` varchar(50) NOT NULL,
  `price` varchar(11) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `description` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `room_type`, `price`, `photo`, `description`, `created_at`, `updated_at`) VALUES
(9, 'Corazon Aquino Suite', '2500', 'img/rooms/1.jpg', 'Has 2 beds and 2 extra sofa beds good for a maximum of 6 pax Additional P350/exceeding pax', '2023-01-28 21:49:55', '2023-01-28 21:49:55'),
(10, 'Enrique kubo Suite', '2000', 'img/rooms/kubo.jpg', 'Has 1 double deck bed (upper Single, lower Double) good for a maximum of 4 pax Additional P350/exceeding pax', '2023-01-28 21:50:35', '2023-01-28 21:50:35');

-- --------------------------------------------------------

--
-- Table structure for table `room_other_images`
--

CREATE TABLE `room_other_images` (
  `id` int NOT NULL,
  `room_id` int NOT NULL,
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_other_images`
--

INSERT INTO `room_other_images` (`id`, `room_id`, `path`) VALUES
(25, 9, 'img/rooms/cas1.jpg'),
(26, 10, 'img/rooms/kubo2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int NOT NULL,
  `guest_id` int NOT NULL,
  `room_id` int NOT NULL,
  `room_no` int DEFAULT NULL,
  `extra_bed` tinyint NOT NULL DEFAULT '0',
  `extra_pax` int DEFAULT NULL,
  `status` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `days` int DEFAULT NULL,
  `checkin` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkin_time` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkout` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkout_time` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` int NOT NULL DEFAULT '0',
  `payment` int NOT NULL DEFAULT '0',
  `is_payment_full` tinyint NOT NULL DEFAULT '0',
  `payment_at` datetime DEFAULT NULL,
  `valid_until` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_unread` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `remarks` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `guest_id`, `room_id`, `room_no`, `extra_bed`, `extra_pax`, `status`, `days`, `checkin`, `checkin_time`, `checkout`, `checkout_time`, `bill`, `balance`, `payment`, `is_payment_full`, `payment_at`, `valid_until`, `is_unread`, `created_at`, `updated_at`, `remarks`) VALUES
(12, 1, 9, NULL, 2, 2, 'Expired', 2, '01/30/2023', NULL, '02/01/2023', NULL, '6700', 0, 0, 0, NULL, '2023-01-29 12:54:31', 0, '2023-01-29 11:54:31', '2023-01-29 11:54:31', NULL),
(13, 3, 10, NULL, 2, 2, 'Expired', 1, '01/31/2023', NULL, '02/01/2023', NULL, '3700', 0, 0, 0, NULL, '2023-01-30 11:21:26', 0, '2023-01-30 10:21:26', '2023-01-30 10:21:26', NULL),
(14, 4, 9, NULL, 3, 3, 'Check In', 1, '01/30/2023', NULL, '01/31/2023', NULL, '5050', 2450, 2600, 0, '2023-01-30 14:43:07', '2023-01-30 11:22:54', 0, '2023-01-30 10:22:54', '2023-02-19 14:11:43', NULL),
(15, 5, 9, NULL, 3, 3, 'Check Out', 1, '02/01/2023', NULL, '02/02/2023', NULL, '5050', 0, 3999, 0, '2023-02-19 12:44:40', '2023-12-30 11:28:08', 0, '2023-01-30 10:28:08', '2023-02-19 14:24:35', NULL),
(16, 3, 9, NULL, 2, 2, 'Expired', 1, '02/03/2023', NULL, '02/04/2023', NULL, '4200', 0, 0, 0, NULL, '2023-01-30 11:42:04', 0, '2023-01-30 10:42:04', '2023-01-30 10:42:04', NULL),
(17, 6, 9, NULL, 2, 2, 'Expired', 1, '02/20/2023', NULL, '02/21/2023', NULL, '4200', 0, 0, 0, NULL, '2023-02-19 11:23:20', 0, '2023-02-19 10:23:20', '2023-02-19 10:23:20', NULL),
(18, 7, 10, NULL, 3, 3, 'Reserved', 2, '02/21/2023', NULL, '02/23/2023', NULL, '6550', 3050, 3500, 0, '2023-02-19 12:46:01', '2023-02-19 13:45:47', 0, '2023-02-19 12:45:47', '2023-02-19 12:46:01', NULL),
(19, 8, 9, NULL, 3, 3, 'Cancelled', 5, '03/02/2023', NULL, '03/07/2023', NULL, '12500', 5050, 10000, 0, '2023-02-19 14:35:03', '2023-02-19 15:25:45', 0, '2023-02-19 14:25:45', '2023-02-19 14:45:52', 'test'),
(20, 1, 9, NULL, 2, 2, 'Reserved', 1, '03/06/2023', NULL, '03/07/2023', NULL, '4200', 1900, 2300, 0, '2023-03-06 15:13:43', '2023-03-06 15:55:31', 1, '2023-03-06 14:55:31', '2023-03-06 15:13:43', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chatbot`
--
ALTER TABLE `chatbot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_other_images`
--
ALTER TABLE `room_other_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `chatbot`
--
ALTER TABLE `chatbot`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `room_other_images`
--
ALTER TABLE `room_other_images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
