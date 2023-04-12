-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 13, 2023 at 12:39 AM
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
-- Database: `eahoqynn_portal_ahosan`
--

--
-- Dumping data for table `physical_healths`
--

INSERT INTO `physical_healths` (`id`, `created_at`, `updated_at`, `question`, `age_group`, `question_group`) VALUES
(13, '2023-04-12 14:49:59', '2023-04-12 20:46:22', 'I can take 390 steps walking within 6mins', 'OLD', 'endurance'),
(14, '2023-04-12 14:50:30', '2023-04-12 14:50:30', 'I can run the distance I walked in question (1), within 5 minutes', 'OLD', 'endurance'),
(15, '2023-04-12 14:50:48', '2023-04-12 14:50:48', 'I can go up and down on a step with one foot 20 times in one minute', 'OLD', 'endurance'),
(16, '2023-04-12 14:51:08', '2023-04-12 20:46:13', 'I can hold my breath for 30 seconds continuously', 'OLD', 'endurance'),
(17, '2023-04-12 14:51:22', '2023-04-12 14:51:22', 'I can lift a 5kg bag of rice with both arms stretched out and hold it for 1.5 mins without dropping it.', 'OLD', 'endurance'),
(18, '2023-04-12 14:58:40', '2023-04-12 14:58:40', 'I can stand up from sitting position without holding the handle of the seat or assistance', 'OLD', 'mobility and balance'),
(19, '2023-04-12 14:59:06', '2023-04-12 14:59:06', 'I can climb up four steps/stairs without assistance', 'OLD', 'mobility and balance'),
(20, '2023-04-12 14:59:16', '2023-04-12 14:59:16', 'I can stand on one leg for more than 15sec without losing my balance', 'OLD', 'mobility and balance'),
(21, '2023-04-12 14:59:26', '2023-04-12 14:59:26', 'I can get in and out of a car or bed without assistance', 'OLD', 'mobility and balance'),
(22, '2023-04-12 14:59:36', '2023-04-12 20:46:39', 'I can walk for a period of more than 5min without losing balances', 'OLD', 'mobility and balance'),
(23, '2023-04-12 14:59:52', '2023-04-12 14:59:52', 'I can do medium* household chores/task', 'OLD', 'mobility and balance'),
(24, '2023-04-12 15:15:17', '2023-04-12 15:15:17', 'I can take 500 steps walking within 6min', 'YOUNG', 'endurance'),
(25, '2023-04-12 15:15:45', '2023-04-12 15:15:45', 'I can run the distance I walked in question (1), in 2 and a half minutes', 'YOUNG', 'endurance'),
(26, '2023-04-12 15:15:59', '2023-04-12 15:15:59', 'I can go up and down on a step with one foot 50 times in a minute', 'YOUNG', 'endurance'),
(27, '2023-04-12 15:16:09', '2023-04-12 15:16:09', 'I can hold my breath for 1min continuous', 'YOUNG', 'endurance'),
(28, '2023-04-12 15:16:17', '2023-04-12 15:16:17', 'I can lift a 5kg bag of rice with both arms stretched out and hold it for 3mins without dropping it.', 'YOUNG', 'endurance');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
