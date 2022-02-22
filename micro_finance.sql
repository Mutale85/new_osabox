-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 17, 2021 at 11:52 AM
-- Server version: 8.0.26-0ubuntu0.20.04.2
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `micro_finance`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int NOT NULL,
  `firstname` text,
  `lastname` text,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `country` int DEFAULT NULL,
  `email` text,
  `password` varchar(300) DEFAULT NULL,
  `pass_w` text,
  `phone` text,
  `photo` text,
  `user_role` text,
  `parent_id` int DEFAULT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP,
  `active` enum('0','1') NOT NULL,
  `token` varchar(100) DEFAULT NULL,
  `branch` text,
  `address` text,
  `allowed_branches` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `firstname`, `lastname`, `gender`, `country`, `email`, `password`, `pass_w`, `phone`, `photo`, `user_role`, `parent_id`, `date_added`, `active`, `token`, `branch`, `address`, `allowed_branches`) VALUES
(1, 'George Mutale', 'Mulenga', NULL, NULL, 'mulengamuls85@gmail.com', '$2y$10$NS4M94YM8Xf.FJvDI553ZO9X3dCjw2R44pQLK0El7S0l7mPcUrXPW', NULL, NULL, NULL, 'Admin', 1, '2021-08-27 15:16:05', '1', NULL, NULL, NULL, NULL),
(2, 'Francis ', 'Mbewe', 'Male', 265, 'francismbewe75@gmail.com', '$2y$10$OBJXsFtYxt0FMs5VuKB9Ee6PxHg1b9ksmqW3DsoxUskrfxRFecQ72', NULL, '', '52596065_10216523514554053_7830121917758570496_o-removebg-preview.png', 'Admin', 2, '2021-08-27 15:52:41', '1', NULL, '2, 3, 4, 5', 'Chipata', '2, 3, 4, 5'),
(6, 'Carol', 'Muchima', 'Female', 265, 'muchimbarita@gmail.com', '$2y$10$/BXJEur7BVFZmQDQjBmU4eb/xRTTYHAfMivH..fVDI1irjrXsZTNK', '5adxQezfA', '+260950692709', '224141353_1283390035391102_7917920269911792599_n.jpg', 'IT Manager', 1, '2021-09-01 13:57:27', '1', NULL, '1', 'Lusaka', '1'),
(8, 'Charles', 'Sakala', 'Male', 265, 'charlessakalahcs@gmail.com', '$2y$10$704Qh7actiyPG68GrxhX3.dDDjpYAp6HxKbNAxQQwaBlgtFYBMz.C', 'Sji0k1Pz9', '+260976944665', 'WhatsApp_Image_2021-09-01_at_1.47.43_PM-removebg-preview (1).png', 'Area Manager-Chipata District', 2, '2021-09-01 15:38:21', '1', NULL, '2', 'Chipata', '2'),
(9, 'Hector', 'Chiseula', 'Male', 265, 'chiseulahector@gmail.com', '$2y$10$XrDcXngSyMeFh1Bh/BYhS.A5TwsTMyA.nQFOoHsvi94ww9YDn5rQ2', 'I0iC1hcJP', '+260963529262', 'WhatsApp_Image_2021-08-31_at_1.13.31_PM-removebg-preview.png', 'Area Manager- Petauke District', 2, '2021-09-02 08:16:23', '1', NULL, '3', 'Petauke', '3'),
(10, 'Josias', 'Banda', 'Male', 265, 'josiasbanda9@gmail.com', '$2y$10$6A0gKdZpRSVw9lR7Zo0KhuZCEgesjk4VQlwlVJuYhZogm0GDgI2K6', 'p9OWs9Lyk', '+260975564879', 'WhatsApp_Image_2021-09-01_at_7.49.19_AM-removebg-preview.png', 'Area Manager-Lundazi District', 2, '2021-09-02 08:19:50', '1', NULL, '4', 'Lundazi', '4'),
(11, 'Tilimboyi', 'Mwiinga', 'Male', 265, 'tilimboyimwiinga21@gmail.com', '$2y$10$loOD4t.9NdR6A7w1vIvsheWZq.rpIZy/sUXdCZKlomMMVVTtaHcoK', '5y691nMjq', '', 'WhatsApp_Image_2021-09-06_at_11.09.41_AM__1_-removebg-preview.png', 'Area Manager-Katete District', 2, '2021-09-06 11:53:21', '1', NULL, '5', 'Katete', '5');

-- --------------------------------------------------------

--
-- Table structure for table `allowed_branches`
--

CREATE TABLE `allowed_branches` (
  `id` int NOT NULL,
  `staff_id` int NOT NULL,
  `parent_id` int NOT NULL,
  `branch_id` int NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `allowed_branches`
--

INSERT INTO `allowed_branches` (`id`, `staff_id`, `parent_id`, `branch_id`, `date_added`) VALUES
(1, 1, 1, 1, '2021-08-27 16:32:38'),
(11, 2, 2, 2, '2021-09-01 08:33:45'),
(12, 2, 2, 3, '2021-09-01 08:33:45'),
(13, 2, 2, 4, '2021-09-01 08:33:45'),
(14, 2, 2, 5, '2021-09-01 08:33:45'),
(20, 6, 1, 1, '2021-09-01 13:57:27'),
(22, 8, 2, 2, '2021-09-01 15:38:21'),
(23, 9, 2, 3, '2021-09-02 08:16:23'),
(24, 10, 2, 4, '2021-09-02 08:19:50'),
(25, 11, 2, 5, '2021-09-06 11:53:21');

-- --------------------------------------------------------

--
-- Table structure for table `basicPaySetUp`
--

CREATE TABLE `basicPaySetUp` (
  `p_id` int NOT NULL,
  `salary_scale_name` text NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currency` text NOT NULL,
  `branch_id` int NOT NULL,
  `parent_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `borrowers`
--

CREATE TABLE `borrowers` (
  `id` int NOT NULL,
  `branch_id` int NOT NULL,
  `parent_id` int NOT NULL,
  `borrower_firstname` text NOT NULL,
  `borrower_lastname` text NOT NULL,
  `borrower_business` text NOT NULL,
  `borrower_gender` text NOT NULL,
  `borrower_ID` text NOT NULL,
  `borrower_country` text NOT NULL,
  `borrower_city` text NOT NULL,
  `borrower_address` text NOT NULL,
  `borrower_email` text NOT NULL,
  `borrower_phone` text NOT NULL,
  `borrower_dateofbirth` date NOT NULL,
  `borrower_working_status` text NOT NULL,
  `borrower_borrower_photo` text NOT NULL,
  `borrower_borrower_files` text NOT NULL,
  `loan_officers` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrowers`
--

INSERT INTO `borrowers` (`id`, `branch_id`, `parent_id`, `borrower_firstname`, `borrower_lastname`, `borrower_business`, `borrower_gender`, `borrower_ID`, `borrower_country`, `borrower_city`, `borrower_address`, `borrower_email`, `borrower_phone`, `borrower_dateofbirth`, `borrower_working_status`, `borrower_borrower_photo`, `borrower_borrower_files`, `loan_officers`, `date_added`) VALUES
(1, 2, 2, 'Victoria ', 'Mambwe', '', 'female', '', '', '', ' ', '', '', '0000-00-00', '', '', '', '', '2021-09-01 15:44:26'),
(2, 4, 2, 'Farine ', 'Banda ', '', 'female', '274248/51/1', '265', 'Lundazi', ' Lundazi chinyumba compounc', '', '975269894', '2021-07-02', 'business_person', '', '', '10', '2021-09-02 11:15:23'),
(3, 4, 2, 'Jane ', 'Nkhoma', '', 'female', '480673/52/1', '265', 'Lundazi', 'Lundazi chinyumba compounc', '', '978690506', '2021-03-09', 'business_person', '', '', '10', '2021-09-02 11:17:44'),
(4, 4, 1, 'Maureen', 'Nagiye', 'OSABOX', 'female', '414166/67/1', '265', 'LUSAKA', '104 B, Pemblock Quarters, ZAF LUSAKA', 'muar@gmail.com', '260976331192', '2021-09-14', 'business_person', '224141353_1283390035391102_7917920269911792599_n.jpg', '', '', '2021-09-02 20:05:39'),
(6, 4, 2, 'Sharon', 'Nalwamba ', '', 'female', '124074/10/1', '265', 'Lundazi ', '  Chimtyulu compound ', '', '975876451', '1989-07-29', 'business_person', '', '', '', '2021-09-07 09:31:20'),
(7, 4, 0, 'Sharon', 'Nalwamba ', '', 'female', '124074/10/1', '265', 'Lundazi ', '  Chimtyulu compound ', '', '', '1989-07-29', 'business_person', '', '', '', '2021-09-07 09:48:22'),
(8, 4, 2, 'Victoria', 'Milanzi', '', 'female', '330598/51/1', '265', 'Lundazi', ' Chimtyulu compound', '', '976450766', '1986-03-10', 'business_person', '', '', '', '2021-09-07 13:49:03');

-- --------------------------------------------------------

--
-- Table structure for table `borrower_branches`
--

CREATE TABLE `borrower_branches` (
  `id` int NOT NULL,
  `borrower_id` int NOT NULL,
  `branch_id` int NOT NULL,
  `parent_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `borrower_files`
--

CREATE TABLE `borrower_files` (
  `id` int NOT NULL,
  `borrower_id` int NOT NULL,
  `parent_id` int NOT NULL,
  `branch_id` int NOT NULL,
  `borrower_id_number` varchar(100) NOT NULL,
  `file_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrower_files`
--

INSERT INTO `borrower_files` (`id`, `borrower_id`, `parent_id`, `branch_id`, `borrower_id_number`, `file_name`) VALUES
(1, 1, 2, 2, '', ''),
(2, 2, 2, 4, '274248/51/1', ''),
(3, 3, 2, 4, '480673/52/1', ''),
(4, 4, 1, 4, '414166/67/1', ''),
(6, 6, 2, 4, '124074/10/1', ''),
(7, 7, 0, 4, '124074/10/1', ''),
(8, 8, 2, 4, '330598/51/1', '');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int NOT NULL,
  `branch_unique_id` varchar(100) NOT NULL,
  `member_id` int NOT NULL,
  `branch_name` text NOT NULL,
  `open_date` date NOT NULL,
  `address` text NOT NULL,
  `city` text NOT NULL,
  `country` int NOT NULL,
  `phone_landline` text NOT NULL,
  `phone_mobile` text NOT NULL,
  `currency` varchar(100) NOT NULL,
  `min_amount` decimal(10,2) NOT NULL,
  `max_amount` decimal(10,2) NOT NULL,
  `min_interest` decimal(10,2) NOT NULL,
  `max_interest` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `branch_unique_id`, `member_id`, `branch_name`, `open_date`, `address`, `city`, `country`, `phone_landline`, `phone_mobile`, `currency`, `min_amount`, `max_amount`, `min_interest`, `max_interest`) VALUES
(1, '1000', 1, 'Weblister', '2021-08-17', '104 B, Pemblock Quarters, ZAF LUSAKA', 'LUSAKA', 265, '0976330092', '+260976330092', 'ZMW', '10000.00', '100000.00', '10.00', '29.00'),
(2, '1001', 2, 'Chipata Area Office', '2021-01-01', 'Plot 1635, Off Airport Road', 'Chipata', 1, '+260216225061', '+260953635502', 'ZMW', '500.00', '5000.00', '8.50', '35.00'),
(3, '1002', 2, 'Petauke Area Office', '2021-06-01', 'Petauke', 'Petauke', 265, '', '', 'ZMW', '500.00', '5000.00', '8.75', '35.00'),
(4, '1003', 2, 'Lundazi Area Office', '2021-06-01', 'Lundazi', 'Lundazi', 265, '', '', 'ZMW', '500.00', '5000.00', '8.75', '35.00'),
(5, '1004', 2, 'Katete Area Office', '2021-01-01', 'Plot 1640, KDC', 'Katete', 265, '', '', 'ZMW', '500.00', '5000.00', '8.75', '35.00');

-- --------------------------------------------------------

--
-- Table structure for table `clients_in_need`
--

CREATE TABLE `clients_in_need` (
  `id` int NOT NULL,
  `photo` text NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `city` text NOT NULL,
  `business_type` text NOT NULL,
  `currency` varchar(100) NOT NULL,
  `required_amount` decimal(10,2) NOT NULL,
  `details` text NOT NULL,
  `id_type` text NOT NULL,
  `id_number` text NOT NULL,
  `email` text,
  `mobile_number` text NOT NULL,
  `parent_id` int NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `collaterals`
--

CREATE TABLE `collaterals` (
  `id` int NOT NULL,
  `collateral_type` text NOT NULL,
  `branch_id` int NOT NULL,
  `parent_id` int NOT NULL,
  `loan_number` text NOT NULL,
  `borrower_id` text NOT NULL,
  `product_name` text NOT NULL,
  `register_date` date NOT NULL,
  `product_value` decimal(10,2) NOT NULL,
  `currency` varchar(20) NOT NULL,
  `product_location` text NOT NULL,
  `action_date` date DEFAULT NULL,
  `address` text NOT NULL,
  `serial_number` text,
  `model_name` text,
  `model_number` text,
  `color` text,
  `manufature_date` date DEFAULT NULL,
  `product_condition` text,
  `description` text,
  `photo` text,
  `files` text,
  `vehicle_reg_number` text,
  `millage` text,
  `vehicle_engine_num` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `collaterals_files`
--

CREATE TABLE `collaterals_files` (
  `id` int NOT NULL,
  `col_id` int NOT NULL,
  `filename` text NOT NULL,
  `loan_number` text NOT NULL,
  `borrower_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `date_sent` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int NOT NULL,
  `iso` char(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `country` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint DEFAULT NULL,
  `phonecode` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `iso`, `name`, `country`, `iso3`, `numcode`, `phonecode`) VALUES
(1, 'AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', 4, 93),
(2, 'AL', 'ALBANIA', 'Albania', 'ALB', 8, 355),
(3, 'DZ', 'ALGERIA', 'Algeria', 'DZA', 12, 213),
(4, 'AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', 16, 1684),
(5, 'AD', 'ANDORRA', 'Andorra', 'AND', 20, 376),
(6, 'AO', 'ANGOLA', 'Angola', 'AGO', 24, 244),
(7, 'AI', 'ANGUILLA', 'Anguilla', 'AIA', 660, 1264),
(8, 'AQ', 'ANTARCTICA', 'Antarctica', 'ATA', NULL, 672),
(9, 'AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', 28, 1268),
(10, 'AR', 'ARGENTINA', 'Argentina', 'ARG', 32, 54),
(11, 'AM', 'ARMENIA', 'Armenia', 'ARM', 51, 374),
(12, 'AW', 'ARUBA', 'Aruba', 'ABW', 533, 297),
(13, 'AU', 'AUSTRALIA', 'Australia', 'AUS', 36, 61),
(14, 'AT', 'AUSTRIA', 'Austria', 'AUT', 40, 43),
(15, 'AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', 31, 994),
(16, 'BS', 'BAHAMAS', 'Bahamas', 'BHS', 44, 1242),
(17, 'BH', 'BAHRAIN', 'Bahrain', 'BHR', 48, 973),
(18, 'BD', 'BANGLADESH', 'Bangladesh', 'BGD', 50, 880),
(19, 'BB', 'BARBADOS', 'Barbados', 'BRB', 52, 1246),
(20, 'BY', 'BELARUS', 'Belarus', 'BLR', 112, 375),
(21, 'BE', 'BELGIUM', 'Belgium', 'BEL', 56, 32),
(22, 'BZ', 'BELIZE', 'Belize', 'BLZ', 84, 501),
(23, 'BJ', 'BENIN', 'Benin', 'BEN', 204, 229),
(24, 'BM', 'BERMUDA', 'Bermuda', 'BMU', 60, 1441),
(25, 'BT', 'BHUTAN', 'Bhutan', 'BTN', 64, 975),
(26, 'BO', 'BOLIVIA', 'Bolivia', 'BOL', 68, 591),
(27, 'BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', 70, 387),
(28, 'BW', 'BOTSWANA', 'Botswana', 'BWA', 72, 267),
(29, 'BV', 'BOUVET ISLAND', 'Bouvet Island', 'BVT', NULL, 47),
(30, 'BR', 'BRAZIL', 'Brazil', 'BRA', 76, 55),
(31, 'IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', 'IOT', NULL, 246),
(32, 'BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', 96, 673),
(33, 'BG', 'BULGARIA', 'Bulgaria', 'BGR', 100, 359),
(34, 'BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', 854, 226),
(35, 'BI', 'BURUNDI', 'Burundi', 'BDI', 108, 257),
(36, 'KH', 'CAMBODIA', 'Cambodia', 'KHM', 116, 855),
(37, 'CM', 'CAMEROON', 'Cameroon', 'CMR', 120, 237),
(38, 'CA', 'CANADA', 'Canada', 'CAN', 124, 1),
(39, 'CV', 'CAPE VERDE', 'Cape Verde', 'CPV', 132, 238),
(40, 'KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', 136, 1345),
(41, 'CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', 140, 236),
(42, 'TD', 'CHAD', 'Chad', 'TCD', 148, 235),
(43, 'CL', 'CHILE', 'Chile', 'CHL', 152, 56),
(44, 'CN', 'CHINA', 'China', 'CHN', 156, 86),
(45, 'CX', 'CHRISTMAS ISLAND', 'Christmas Island', 'CXR', NULL, 61),
(46, 'CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', 'CCK', NULL, 672),
(47, 'CO', 'COLOMBIA', 'Colombia', 'COL', 170, 57),
(48, 'KM', 'COMOROS', 'Comoros', 'COM', 174, 269),
(49, 'CG', 'CONGO', 'Congo', 'COG', 178, 242),
(50, 'CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'COD', 180, 243),
(51, 'CK', 'COOK ISLANDS', 'Cook Islands', 'COK', 184, 682),
(52, 'CR', 'COSTA RICA', 'Costa Rica', 'CRI', 188, 506),
(53, 'CI', 'COTE D\'IVOIRE', 'Cote D\'Ivoire', 'CIV', 384, 225),
(54, 'HR', 'CROATIA', 'Croatia', 'HRV', 191, 385),
(55, 'CU', 'CUBA', 'Cuba', 'CUB', 192, 53),
(56, 'CY', 'CYPRUS', 'Cyprus', 'CYP', 196, 357),
(57, 'CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', 203, 420),
(58, 'DK', 'DENMARK', 'Denmark', 'DNK', 208, 45),
(59, 'DJ', 'DJIBOUTI', 'Djibouti', 'DJI', 262, 253),
(60, 'DM', 'DOMINICA', 'Dominica', 'DMA', 212, 1767),
(61, 'DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', 214, 1809),
(62, 'EC', 'ECUADOR', 'Ecuador', 'ECU', 218, 593),
(63, 'EG', 'EGYPT', 'Egypt', 'EGY', 818, 20),
(64, 'SV', 'EL SALVADOR', 'El Salvador', 'SLV', 222, 503),
(65, 'GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', 226, 240),
(66, 'ER', 'ERITREA', 'Eritrea', 'ERI', 232, 291),
(67, 'EE', 'ESTONIA', 'Estonia', 'EST', 233, 372),
(68, 'ET', 'ETHIOPIA', 'Ethiopia', 'ETH', 231, 251),
(69, 'FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'FLK', 238, 500),
(70, 'FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', 234, 298),
(71, 'FJ', 'FIJI', 'Fiji', 'FJI', 242, 679),
(72, 'FI', 'FINLAND', 'Finland', 'FIN', 246, 358),
(73, 'FR', 'FRANCE', 'France', 'FRA', 250, 33),
(74, 'GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', 254, 594),
(75, 'PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', 258, 689),
(76, 'TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', 'ATF', NULL, 262),
(77, 'GA', 'GABON', 'Gabon', 'GAB', 266, 241),
(78, 'GM', 'GAMBIA', 'Gambia', 'GMB', 270, 220),
(79, 'GE', 'GEORGIA', 'Georgia', 'GEO', 268, 995),
(80, 'DE', 'GERMANY', 'Germany', 'DEU', 276, 49),
(81, 'GH', 'GHANA', 'Ghana', 'GHA', 288, 233),
(82, 'GI', 'GIBRALTAR', 'Gibraltar', 'GIB', 292, 350),
(83, 'GR', 'GREECE', 'Greece', 'GRC', 300, 30),
(84, 'GL', 'GREENLAND', 'Greenland', 'GRL', 304, 299),
(85, 'GD', 'GRENADA', 'Grenada', 'GRD', 308, 1473),
(86, 'GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', 312, 590),
(87, 'GU', 'GUAM', 'Guam', 'GUM', 316, 1671),
(88, 'GT', 'GUATEMALA', 'Guatemala', 'GTM', 320, 502),
(89, 'GN', 'GUINEA', 'Guinea', 'GIN', 324, 224),
(90, 'GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', 624, 245),
(91, 'GY', 'GUYANA', 'Guyana', 'GUY', 328, 592),
(92, 'HT', 'HAITI', 'Haiti', 'HTI', 332, 509),
(93, 'HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', 'HMD', NULL, 0),
(94, 'VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', 'VAT', 336, 39),
(95, 'HN', 'HONDURAS', 'Honduras', 'HND', 340, 504),
(96, 'HK', 'HONG KONG', 'Hong Kong', 'HKG', 344, 852),
(97, 'HU', 'HUNGARY', 'Hungary', 'HUN', 348, 36),
(98, 'IS', 'ICELAND', 'Iceland', 'ISL', 352, 354),
(99, 'IN', 'INDIA', 'India', 'IND', 356, 91),
(100, 'ID', 'INDONESIA', 'Indonesia', 'IDN', 360, 62),
(101, 'IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'IRN', 364, 98),
(102, 'IQ', 'IRAQ', 'Iraq', 'IRQ', 368, 964),
(103, 'IE', 'IRELAND', 'Ireland', 'IRL', 372, 353),
(104, 'IL', 'ISRAEL', 'Israel', 'ISR', 376, 972),
(105, 'IT', 'ITALY', 'Italy', 'ITA', 380, 39),
(106, 'JM', 'JAMAICA', 'Jamaica', 'JAM', 388, 1876),
(107, 'JP', 'JAPAN', 'Japan', 'JPN', 392, 81),
(108, 'JO', 'JORDAN', 'Jordan', 'JOR', 400, 962),
(109, 'KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', 398, 7),
(110, 'KE', 'KENYA', 'Kenya', 'KEN', 404, 254),
(111, 'KI', 'KIRIBATI', 'Kiribati', 'KIR', 296, 686),
(112, 'KP', 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF', 'Korea, Democratic People\'s Republic of', 'PRK', 408, 850),
(113, 'KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', 410, 82),
(114, 'KW', 'KUWAIT', 'Kuwait', 'KWT', 414, 965),
(115, 'KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 417, 996),
(116, 'LA', 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC', 'Lao People\'s Democratic Republic', 'LAO', 418, 856),
(117, 'LV', 'LATVIA', 'Latvia', 'LVA', 428, 371),
(118, 'LB', 'LEBANON', 'Lebanon', 'LBN', 422, 961),
(119, 'LS', 'LESOTHO', 'Lesotho', 'LSO', 426, 266),
(120, 'LR', 'LIBERIA', 'Liberia', 'LBR', 430, 231),
(121, 'LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'LBY', 434, 218),
(122, 'LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', 438, 423),
(123, 'LT', 'LITHUANIA', 'Lithuania', 'LTU', 440, 370),
(124, 'LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', 442, 352),
(125, 'MO', 'MACAO', 'Macao', 'MAC', 446, 853),
(126, 'MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807, 389),
(127, 'MG', 'MADAGASCAR', 'Madagascar', 'MDG', 450, 261),
(128, 'MW', 'MALAWI', 'Malawi', 'MWI', 454, 265),
(129, 'MY', 'MALAYSIA', 'Malaysia', 'MYS', 458, 60),
(130, 'MV', 'MALDIVES', 'Maldives', 'MDV', 462, 960),
(131, 'ML', 'MALI', 'Mali', 'MLI', 466, 223),
(132, 'MT', 'MALTA', 'Malta', 'MLT', 470, 356),
(133, 'MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', 584, 692),
(134, 'MQ', 'MARTINIQUE', 'Martinique', 'MTQ', 474, 596),
(135, 'MR', 'MAURITANIA', 'Mauritania', 'MRT', 478, 222),
(136, 'MU', 'MAURITIUS', 'Mauritius', 'MUS', 480, 230),
(137, 'YT', 'MAYOTTE', 'Mayotte', 'MYT', NULL, 269),
(138, 'MX', 'MEXICO', 'Mexico', 'MEX', 484, 52),
(139, 'FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'FSM', 583, 691),
(140, 'MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'MDA', 498, 373),
(141, 'MC', 'MONACO', 'Monaco', 'MCO', 492, 377),
(142, 'MN', 'MONGOLIA', 'Mongolia', 'MNG', 496, 976),
(143, 'MS', 'MONTSERRAT', 'Montserrat', 'MSR', 500, 1664),
(144, 'MA', 'MOROCCO', 'Morocco', 'MAR', 504, 212),
(145, 'MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', 508, 258),
(146, 'MM', 'MYANMAR', 'Myanmar', 'MMR', 104, 95),
(147, 'NA', 'NAMIBIA', 'Namibia', 'NAM', 516, 264),
(148, 'NR', 'NAURU', 'Nauru', 'NRU', 520, 674),
(149, 'NP', 'NEPAL', 'Nepal', 'NPL', 524, 977),
(150, 'NL', 'NETHERLANDS', 'Netherlands', 'NLD', 528, 31),
(151, 'AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', 530, 599),
(152, 'NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', 540, 687),
(153, 'NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', 554, 64),
(154, 'NI', 'NICARAGUA', 'Nicaragua', 'NIC', 558, 505),
(155, 'NE', 'NIGER', 'Niger', 'NER', 562, 227),
(156, 'NG', 'NIGERIA', 'Nigeria', 'NGA', 566, 234),
(157, 'NU', 'NIUE', 'Niue', 'NIU', 570, 683),
(158, 'NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', 574, 672),
(159, 'MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', 580, 1670),
(160, 'NO', 'NORWAY', 'Norway', 'NOR', 578, 47),
(161, 'OM', 'OMAN', 'Oman', 'OMN', 512, 968),
(162, 'PK', 'PAKISTAN', 'Pakistan', 'PAK', 586, 92),
(163, 'PW', 'PALAU', 'Palau', 'PLW', 585, 680),
(164, 'PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', 'PSE', NULL, 970),
(165, 'PA', 'PANAMA', 'Panama', 'PAN', 591, 507),
(166, 'PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', 598, 675),
(167, 'PY', 'PARAGUAY', 'Paraguay', 'PRY', 600, 595),
(168, 'PE', 'PERU', 'Peru', 'PER', 604, 51),
(169, 'PH', 'PHILIPPINES', 'Philippines', 'PHL', 608, 63),
(170, 'PN', 'PITCAIRN', 'Pitcairn', 'PCN', 612, 64),
(171, 'PL', 'POLAND', 'Poland', 'POL', 616, 48),
(172, 'PT', 'PORTUGAL', 'Portugal', 'PRT', 620, 351),
(173, 'PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', 630, 1787),
(174, 'QA', 'QATAR', 'Qatar', 'QAT', 634, 974),
(175, 'RE', 'REUNION', 'Reunion', 'REU', 638, 262),
(176, 'RO', 'ROMANIA', 'Romania', 'ROU', 642, 40),
(177, 'RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'RUS', 643, 7),
(178, 'RW', 'RWANDA', 'Rwanda', 'RWA', 646, 250),
(179, 'SH', 'SAINT HELENA', 'Saint Helena', 'SHN', 654, 290),
(180, 'KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', 659, 1869),
(181, 'LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', 662, 1758),
(182, 'PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'SPM', 666, 508),
(183, 'VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'VCT', 670, 1784),
(184, 'WS', 'SAMOA', 'Samoa', 'WSM', 882, 684),
(185, 'SM', 'SAN MARINO', 'San Marino', 'SMR', 674, 378),
(186, 'ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', 678, 239),
(187, 'SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', 682, 966),
(188, 'SN', 'SENEGAL', 'Senegal', 'SEN', 686, 221),
(190, 'SC', 'SEYCHELLES', 'Seychelles', 'SYC', 690, 248),
(191, 'SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', 694, 232),
(192, 'SG', 'SINGAPORE', 'Singapore', 'SGP', 702, 65),
(193, 'SK', 'SLOVAKIA', 'Slovakia', 'SVK', 703, 421),
(194, 'SI', 'SLOVENIA', 'Slovenia', 'SVN', 705, 386),
(195, 'SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', 90, 677),
(196, 'SO', 'SOMALIA', 'Somalia', 'SOM', 706, 252),
(197, 'ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', 710, 27),
(198, 'GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', 'SGS', NULL, 500),
(199, 'ES', 'SPAIN', 'Spain', 'ESP', 724, 34),
(200, 'LK', 'SRI LANKA', 'Sri Lanka', 'LKA', 144, 94),
(201, 'SD', 'SUDAN', 'Sudan', 'SDN', 736, 249),
(202, 'SR', 'SURINAME', 'Suriname', 'SUR', 740, 597),
(203, 'SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'SJM', 744, 47),
(204, 'SZ', 'SWAZILAND', 'Swaziland', 'SWZ', 748, 268),
(205, 'SE', 'SWEDEN', 'Sweden', 'SWE', 752, 46),
(206, 'CH', 'SWITZERLAND', 'Switzerland', 'CHE', 756, 41),
(207, 'SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', 760, 963),
(208, 'TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', 'TWN', 158, 886),
(209, 'TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', 762, 992),
(210, 'TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'TZA', 834, 255),
(211, 'TH', 'THAILAND', 'Thailand', 'THA', 764, 66),
(212, 'TL', 'TIMOR-LESTE', 'Timor-Leste', 'TLS', NULL, 670),
(213, 'TG', 'TOGO', 'Togo', 'TGO', 768, 228),
(214, 'TK', 'TOKELAU', 'Tokelau', 'TKL', 772, 690),
(215, 'TO', 'TONGA', 'Tonga', 'TON', 776, 676),
(216, 'TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', 780, 1868),
(217, 'TN', 'TUNISIA', 'Tunisia', 'TUN', 788, 216),
(218, 'TR', 'TURKEY', 'Turkey', 'TUR', 792, 90),
(219, 'TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 795, 7370),
(220, 'TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'TCA', 796, 1649),
(221, 'TV', 'TUVALU', 'Tuvalu', 'TUV', 798, 688),
(222, 'UG', 'UGANDA', 'Uganda', 'UGA', 800, 256),
(223, 'UA', 'UKRAINE', 'Ukraine', 'UKR', 804, 380),
(224, 'AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', 784, 971),
(225, 'GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', 826, 44),
(226, 'US', 'UNITED STATES', 'United States', 'USA', 840, 1),
(227, 'UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', 'UMI', NULL, 1),
(228, 'UY', 'URUGUAY', 'Uruguay', 'URY', 858, 598),
(229, 'UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', 860, 998),
(230, 'VU', 'VANUATU', 'Vanuatu', 'VUT', 548, 678),
(231, 'VE', 'VENEZUELA', 'Venezuela', 'VEN', 862, 58),
(232, 'VN', 'VIET NAM', 'Viet Nam', 'VNM', 704, 84),
(233, 'VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', 92, 1284),
(234, 'VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', 850, 1340),
(235, 'WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', 876, 681),
(236, 'EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', 732, 212),
(237, 'YE', 'YEMEN', 'Yemen', 'YEM', 887, 967),
(238, 'ZM', 'ZAMBIA', 'Zambia', 'ZMB', 894, 260),
(239, 'ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', 716, 263),
(240, 'RS', 'SERBIA', 'Serbia', 'SRB', 688, 381),
(241, 'AP', 'ASIA PACIFIC REGION', 'Asia / Pacific Region', '0', 0, 0),
(242, 'ME', 'MONTENEGRO', 'Montenegro', 'MNE', 499, 382),
(243, 'AX', 'ALAND ISLANDS', 'Aland Islands', 'ALA', 248, 358),
(244, 'BQ', 'BONAIRE, SINT EUSTATIUS AND SABA', 'Bonaire, Sint Eustatius and Saba', 'BES', 535, 599),
(245, 'CW', 'CURACAO', 'Curacao', 'CUW', 531, 599),
(246, 'GG', 'GUERNSEY', 'Guernsey', 'GGY', 831, 44),
(247, 'IM', 'ISLE OF MAN', 'Isle of Man', 'IMN', 833, 44),
(248, 'JE', 'JERSEY', 'Jersey', 'JEY', 832, 44),
(249, 'XK', 'KOSOVO', 'Kosovo', 'XKX', 0, 383),
(250, 'BL', 'SAINT BARTHELEMY', 'Saint Barthelemy', 'BLM', 652, 590),
(251, 'MF', 'SAINT MARTIN', 'Saint Martin', 'MAF', 663, 590),
(252, 'SX', 'SINT MAARTEN', 'Sint Maarten', 'SXM', 534, 1),
(253, 'SS', 'SOUTH SUDAN', 'South Sudan', 'SSD', 728, 211);

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int NOT NULL,
  `country` varchar(100) DEFAULT NULL,
  `currency` varchar(100) DEFAULT NULL,
  `code` varchar(4) DEFAULT NULL,
  `minor_unit` smallint DEFAULT NULL,
  `symbol` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `country`, `currency`, `code`, `minor_unit`, `symbol`) VALUES
(1, 'Afghanistan', 'Afghani', 'AFN', 2, '؋'),
(2, 'Åland Islands', 'Euro', 'EUR', 2, '€'),
(3, 'Albania', 'Lek', 'ALL', 2, 'Lek'),
(4, 'Algeria', 'Algerian Dinar', 'DZD', 2, NULL),
(5, 'American Samoa', 'US Dollar', 'USD', 2, '$'),
(6, 'Andorra', 'Euro', 'EUR', 2, '€'),
(7, 'Angola', 'Kwanza', 'AOA', 2, NULL),
(8, 'Anguilla', 'East Caribbean Dollar', 'XCD', 2, NULL),
(9, 'Antigua And Barbuda', 'East Caribbean Dollar', 'XCD', 2, NULL),
(10, 'Argentina', 'Argentine Peso', 'ARS', 2, '$'),
(11, 'Armenia', 'Armenian Dram', 'AMD', 2, NULL),
(12, 'Aruba', 'Aruban Florin', 'AWG', 2, NULL),
(13, 'Australia', 'Australian Dollar', 'AUD', 2, '$'),
(14, 'Austria', 'Euro', 'EUR', 2, '€'),
(15, 'Azerbaijan', 'Azerbaijan Manat', 'AZN', 2, NULL),
(16, 'Bahamas', 'Bahamian Dollar', 'BSD', 2, '$'),
(17, 'Bahrain', 'Bahraini Dinar', 'BHD', 3, NULL),
(18, 'Bangladesh', 'Taka', 'BDT', 2, '৳'),
(19, 'Barbados', 'Barbados Dollar', 'BBD', 2, '$'),
(20, 'Belarus', 'Belarusian Ruble', 'BYN', 2, NULL),
(21, 'Belgium', 'Euro', 'EUR', 2, '€'),
(22, 'Belize', 'Belize Dollar', 'BZD', 2, 'BZ$'),
(23, 'Benin', 'CFA Franc BCEAO', 'XOF', 0, NULL),
(24, 'Bermuda', 'Bermudian Dollar', 'BMD', 2, NULL),
(25, 'Bhutan', 'Indian Rupee', 'INR', 2, '₹'),
(26, 'Bhutan', 'Ngultrum', 'BTN', 2, NULL),
(27, 'Bolivia', 'Boliviano', 'BOB', 2, NULL),
(28, 'Bolivia', 'Mvdol', 'BOV', 2, NULL),
(29, 'Bonaire, Sint Eustatius And Saba', 'US Dollar', 'USD', 2, '$'),
(30, 'Bosnia And Herzegovina', 'Convertible Mark', 'BAM', 2, NULL),
(31, 'Botswana', 'Pula', 'BWP', 2, NULL),
(32, 'Bouvet Island', 'Norwegian Krone', 'NOK', 2, NULL),
(33, 'Brazil', 'Brazilian Real', 'BRL', 2, 'R$'),
(34, 'British Indian Ocean Territory', 'US Dollar', 'USD', 2, '$'),
(35, 'Brunei Darussalam', 'Brunei Dollar', 'BND', 2, NULL),
(36, 'Bulgaria', 'Bulgarian Lev', 'BGN', 2, 'лв'),
(37, 'Burkina Faso', 'CFA Franc BCEAO', 'XOF', 0, NULL),
(38, 'Burundi', 'Burundi Franc', 'BIF', 0, NULL),
(39, 'Cabo Verde', 'Cabo Verde Escudo', 'CVE', 2, NULL),
(40, 'Cambodia', 'Riel', 'KHR', 2, '៛'),
(41, 'Cameroon', 'CFA Franc BEAC', 'XAF', 0, NULL),
(42, 'Canada', 'Canadian Dollar', 'CAD', 2, '$'),
(43, 'Cayman Islands', 'Cayman Islands Dollar', 'KYD', 2, NULL),
(44, 'Central African Republic', 'CFA Franc BEAC', 'XAF', 0, NULL),
(45, 'Chad', 'CFA Franc BEAC', 'XAF', 0, NULL),
(46, 'Chile', 'Chilean Peso', 'CLP', 0, '$'),
(47, 'Chile', 'Unidad de Fomento', 'CLF', 4, NULL),
(48, 'China', 'Yuan Renminbi', 'CNY', 2, '¥'),
(49, 'Christmas Island', 'Australian Dollar', 'AUD', 2, NULL),
(50, 'Cocos (keeling) Islands', 'Australian Dollar', 'AUD', 2, NULL),
(51, 'Colombia', 'Colombian Peso', 'COP', 2, '$'),
(52, 'Colombia', 'Unidad de Valor Real', 'COU', 2, NULL),
(53, 'Comoros', 'Comorian Franc ', 'KMF', 0, NULL),
(54, 'Congo (the Democratic Republic Of The)', 'Congolese Franc', 'CDF', 2, NULL),
(55, 'Congo', 'CFA Franc BEAC', 'XAF', 0, NULL),
(56, 'Cook Islands', 'New Zealand Dollar', 'NZD', 2, '$'),
(57, 'Costa Rica', 'Costa Rican Colon', 'CRC', 2, NULL),
(58, 'Côte D\'ivoire', 'CFA Franc BCEAO', 'XOF', 0, NULL),
(59, 'Croatia', 'Kuna', 'HRK', 2, 'kn'),
(60, 'Cuba', 'Cuban Peso', 'CUP', 2, NULL),
(61, 'Cuba', 'Peso Convertible', 'CUC', 2, NULL),
(62, 'Curaçao', 'Netherlands Antillean Guilder', 'ANG', 2, NULL),
(63, 'Cyprus', 'Euro', 'EUR', 2, '€'),
(64, 'Czechia', 'Czech Koruna', 'CZK', 2, 'Kč'),
(65, 'Denmark', 'Danish Krone', 'DKK', 2, 'kr'),
(66, 'Djibouti', 'Djibouti Franc', 'DJF', 0, NULL),
(67, 'Dominica', 'East Caribbean Dollar', 'XCD', 2, NULL),
(68, 'Dominican Republic', 'Dominican Peso', 'DOP', 2, NULL),
(69, 'Ecuador', 'US Dollar', 'USD', 2, '$'),
(70, 'Egypt', 'Egyptian Pound', 'EGP', 2, NULL),
(71, 'El Salvador', 'El Salvador Colon', 'SVC', 2, NULL),
(72, 'El Salvador', 'US Dollar', 'USD', 2, '$'),
(73, 'Equatorial Guinea', 'CFA Franc BEAC', 'XAF', 0, NULL),
(74, 'Eritrea', 'Nakfa', 'ERN', 2, NULL),
(75, 'Estonia', 'Euro', 'EUR', 2, '€'),
(76, 'Eswatini', 'Lilangeni', 'SZL', 2, NULL),
(77, 'Ethiopia', 'Ethiopian Birr', 'ETB', 2, NULL),
(78, 'European Union', 'Euro', 'EUR', 2, '€'),
(79, 'Falkland Islands [Malvinas]', 'Falkland Islands Pound', 'FKP', 2, NULL),
(80, 'Faroe Islands', 'Danish Krone', 'DKK', 2, NULL),
(81, 'Fiji', 'Fiji Dollar', 'FJD', 2, NULL),
(82, 'Finland', 'Euro', 'EUR', 2, '€'),
(83, 'France', 'Euro', 'EUR', 2, '€'),
(84, 'French Guiana', 'Euro', 'EUR', 2, '€'),
(85, 'French Polynesia', 'CFP Franc', 'XPF', 0, NULL),
(86, 'French Southern Territories', 'Euro', 'EUR', 2, '€'),
(87, 'Gabon', 'CFA Franc BEAC', 'XAF', 0, NULL),
(88, 'Gambia', 'Dalasi', 'GMD', 2, NULL),
(89, 'Georgia', 'Lari', 'GEL', 2, '₾'),
(90, 'Germany', 'Euro', 'EUR', 2, '€'),
(91, 'Ghana', 'Ghana Cedi', 'GHS', 2, NULL),
(92, 'Gibraltar', 'Gibraltar Pound', 'GIP', 2, NULL),
(93, 'Greece', 'Euro', 'EUR', 2, '€'),
(94, 'Greenland', 'Danish Krone', 'DKK', 2, NULL),
(95, 'Grenada', 'East Caribbean Dollar', 'XCD', 2, NULL),
(96, 'Guadeloupe', 'Euro', 'EUR', 2, '€'),
(97, 'Guam', 'US Dollar', 'USD', 2, '$'),
(98, 'Guatemala', 'Quetzal', 'GTQ', 2, NULL),
(99, 'Guernsey', 'Pound Sterling', 'GBP', 2, '£'),
(100, 'Guinea', 'Guinean Franc', 'GNF', 0, NULL),
(101, 'Guinea-bissau', 'CFA Franc BCEAO', 'XOF', 0, NULL),
(102, 'Guyana', 'Guyana Dollar', 'GYD', 2, NULL),
(103, 'Haiti', 'Gourde', 'HTG', 2, NULL),
(104, 'Haiti', 'US Dollar', 'USD', 2, '$'),
(105, 'Heard Island And Mcdonald Islands', 'Australian Dollar', 'AUD', 2, NULL),
(106, 'Holy See (Vatican)', 'Euro', 'EUR', 2, '€'),
(107, 'Honduras', 'Lempira', 'HNL', 2, NULL),
(108, 'Hong Kong', 'Hong Kong Dollar', 'HKD', 2, '$'),
(109, 'Hungary', 'Forint', 'HUF', 2, 'ft'),
(110, 'Iceland', 'Iceland Krona', 'ISK', 0, NULL),
(111, 'India', 'Indian Rupee', 'INR', 2, '₹'),
(112, 'Indonesia', 'Rupiah', 'IDR', 2, 'Rp'),
(113, 'International Monetary Fund (IMF)', 'SDR (Special Drawing Right)', 'XDR', 0, NULL),
(114, 'Iran', 'Iranian Rial', 'IRR', 2, NULL),
(115, 'Iraq', 'Iraqi Dinar', 'IQD', 3, NULL),
(116, 'Ireland', 'Euro', 'EUR', 2, '€'),
(117, 'Isle Of Man', 'Pound Sterling', 'GBP', 2, '£'),
(118, 'Israel', 'New Israeli Sheqel', 'ILS', 2, '₪'),
(119, 'Italy', 'Euro', 'EUR', 2, '€'),
(120, 'Jamaica', 'Jamaican Dollar', 'JMD', 2, NULL),
(121, 'Japan', 'Yen', 'JPY', 0, '¥'),
(122, 'Jersey', 'Pound Sterling', 'GBP', 2, '£'),
(123, 'Jordan', 'Jordanian Dinar', 'JOD', 3, NULL),
(124, 'Kazakhstan', 'Tenge', 'KZT', 2, NULL),
(125, 'Kenya', 'Kenyan Shilling', 'KES', 2, 'Ksh'),
(126, 'Kiribati', 'Australian Dollar', 'AUD', 2, NULL),
(127, 'Korea (the Democratic People’s Republic Of)', 'North Korean Won', 'KPW', 2, NULL),
(128, 'Korea (the Republic Of)', 'Won', 'KRW', 0, '₩'),
(129, 'Kuwait', 'Kuwaiti Dinar', 'KWD', 3, NULL),
(130, 'Kyrgyzstan', 'Som', 'KGS', 2, NULL),
(131, 'Lao People’s Democratic Republic', 'Lao Kip', 'LAK', 2, NULL),
(132, 'Latvia', 'Euro', 'EUR', 2, '€'),
(133, 'Lebanon', 'Lebanese Pound', 'LBP', 2, NULL),
(134, 'Lesotho', 'Loti', 'LSL', 2, NULL),
(135, 'Lesotho', 'Rand', 'ZAR', 2, NULL),
(136, 'Liberia', 'Liberian Dollar', 'LRD', 2, NULL),
(137, 'Libya', 'Libyan Dinar', 'LYD', 3, NULL),
(138, 'Liechtenstein', 'Swiss Franc', 'CHF', 2, NULL),
(139, 'Lithuania', 'Euro', 'EUR', 2, '€'),
(140, 'Luxembourg', 'Euro', 'EUR', 2, '€'),
(141, 'Macao', 'Pataca', 'MOP', 2, NULL),
(142, 'North Macedonia', 'Denar', 'MKD', 2, NULL),
(143, 'Madagascar', 'Malagasy Ariary', 'MGA', 2, NULL),
(144, 'Malawi', 'Malawi Kwacha', 'MWK', 2, NULL),
(145, 'Malaysia', 'Malaysian Ringgit', 'MYR', 2, 'RM'),
(146, 'Maldives', 'Rufiyaa', 'MVR', 2, NULL),
(147, 'Mali', 'CFA Franc BCEAO', 'XOF', 0, NULL),
(148, 'Malta', 'Euro', 'EUR', 2, '€'),
(149, 'Marshall Islands', 'US Dollar', 'USD', 2, '$'),
(150, 'Martinique', 'Euro', 'EUR', 2, '€'),
(151, 'Mauritania', 'Ouguiya', 'MRU', 2, NULL),
(152, 'Mauritius', 'Mauritius Rupee', 'MUR', 2, NULL),
(153, 'Mayotte', 'Euro', 'EUR', 2, '€'),
(154, 'Member Countries Of The African Development Bank Group', 'ADB Unit of Account', 'XUA', 0, NULL),
(155, 'Mexico', 'Mexican Peso', 'MXN', 2, '$'),
(156, 'Mexico', 'Mexican Unidad de Inversion (UDI)', 'MXV', 2, NULL),
(157, 'Micronesia', 'US Dollar', 'USD', 2, '$'),
(158, 'Moldova', 'Moldovan Leu', 'MDL', 2, NULL),
(159, 'Monaco', 'Euro', 'EUR', 2, '€'),
(160, 'Mongolia', 'Tugrik', 'MNT', 2, NULL),
(161, 'Montenegro', 'Euro', 'EUR', 2, '€'),
(162, 'Montserrat', 'East Caribbean Dollar', 'XCD', 2, NULL),
(163, 'Morocco', 'Moroccan Dirham', 'MAD', 2, ' .د.م '),
(164, 'Mozambique', 'Mozambique Metical', 'MZN', 2, NULL),
(165, 'Myanmar', 'Kyat', 'MMK', 2, NULL),
(166, 'Namibia', 'Namibia Dollar', 'NAD', 2, NULL),
(167, 'Namibia', 'Rand', 'ZAR', 2, NULL),
(168, 'Nauru', 'Australian Dollar', 'AUD', 2, NULL),
(169, 'Nepal', 'Nepalese Rupee', 'NPR', 2, NULL),
(170, 'Netherlands', 'Euro', 'EUR', 2, '€'),
(171, 'New Caledonia', 'CFP Franc', 'XPF', 0, NULL),
(172, 'New Zealand', 'New Zealand Dollar', 'NZD', 2, '$'),
(173, 'Nicaragua', 'Cordoba Oro', 'NIO', 2, NULL),
(174, 'Niger', 'CFA Franc BCEAO', 'XOF', 0, NULL),
(175, 'Nigeria', 'Naira', 'NGN', 2, '₦'),
(176, 'Niue', 'New Zealand Dollar', 'NZD', 2, '$'),
(177, 'Norfolk Island', 'Australian Dollar', 'AUD', 2, NULL),
(178, 'Northern Mariana Islands', 'US Dollar', 'USD', 2, '$'),
(179, 'Norway', 'Norwegian Krone', 'NOK', 2, 'kr'),
(180, 'Oman', 'Rial Omani', 'OMR', 3, NULL),
(181, 'Pakistan', 'Pakistan Rupee', 'PKR', 2, 'Rs'),
(182, 'Palau', 'US Dollar', 'USD', 2, '$'),
(183, 'Panama', 'Balboa', 'PAB', 2, NULL),
(184, 'Panama', 'US Dollar', 'USD', 2, '$'),
(185, 'Papua New Guinea', 'Kina', 'PGK', 2, NULL),
(186, 'Paraguay', 'Guarani', 'PYG', 0, NULL),
(187, 'Peru', 'Sol', 'PEN', 2, 'S'),
(188, 'Philippines', 'Philippine Peso', 'PHP', 2, '₱'),
(189, 'Pitcairn', 'New Zealand Dollar', 'NZD', 2, '$'),
(190, 'Poland', 'Zloty', 'PLN', 2, 'zł'),
(191, 'Portugal', 'Euro', 'EUR', 2, '€'),
(192, 'Puerto Rico', 'US Dollar', 'USD', 2, '$'),
(193, 'Qatar', 'Qatari Rial', 'QAR', 2, NULL),
(194, 'Réunion', 'Euro', 'EUR', 2, '€'),
(195, 'Romania', 'Romanian Leu', 'RON', 2, 'lei'),
(196, 'Russian Federation', 'Russian Ruble', 'RUB', 2, '₽'),
(197, 'Rwanda', 'Rwanda Franc', 'RWF', 0, NULL),
(198, 'Saint Barthélemy', 'Euro', 'EUR', 2, '€'),
(199, 'Saint Helena, Ascension And Tristan Da Cunha', 'Saint Helena Pound', 'SHP', 2, NULL),
(200, 'Saint Kitts And Nevis', 'East Caribbean Dollar', 'XCD', 2, NULL),
(201, 'Saint Lucia', 'East Caribbean Dollar', 'XCD', 2, NULL),
(202, 'Saint Martin (French Part)', 'Euro', 'EUR', 2, '€'),
(203, 'Saint Pierre And Miquelon', 'Euro', 'EUR', 2, '€'),
(204, 'Saint Vincent And The Grenadines', 'East Caribbean Dollar', 'XCD', 2, NULL),
(205, 'Samoa', 'Tala', 'WST', 2, NULL),
(206, 'San Marino', 'Euro', 'EUR', 2, '€'),
(207, 'Sao Tome And Principe', 'Dobra', 'STN', 2, NULL),
(208, 'Saudi Arabia', 'Saudi Riyal', 'SAR', 2, NULL),
(209, 'Senegal', 'CFA Franc BCEAO', 'XOF', 0, NULL),
(210, 'Serbia', 'Serbian Dinar', 'RSD', 2, NULL),
(211, 'Seychelles', 'Seychelles Rupee', 'SCR', 2, NULL),
(212, 'Sierra Leone', 'Leone', 'SLL', 2, NULL),
(213, 'Singapore', 'Singapore Dollar', 'SGD', 2, '$'),
(214, 'Sint Maarten (Dutch Part)', 'Netherlands Antillean Guilder', 'ANG', 2, NULL),
(215, 'Sistema Unitario De Compensacion Regional De Pagos \"sucre\"\"\"', 'Sucre', 'XSU', 0, NULL),
(216, 'Slovakia', 'Euro', 'EUR', 2, '€'),
(217, 'Slovenia', 'Euro', 'EUR', 2, '€'),
(218, 'Solomon Islands', 'Solomon Islands Dollar', 'SBD', 2, NULL),
(219, 'Somalia', 'Somali Shilling', 'SOS', 2, NULL),
(220, 'South Africa', 'Rand', 'ZAR', 2, 'R'),
(221, 'South Sudan', 'South Sudanese Pound', 'SSP', 2, NULL),
(222, 'Spain', 'Euro', 'EUR', 2, '€'),
(223, 'Sri Lanka', 'Sri Lanka Rupee', 'LKR', 2, 'Rs'),
(224, 'Sudan (the)', 'Sudanese Pound', 'SDG', 2, NULL),
(225, 'Suriname', 'Surinam Dollar', 'SRD', 2, NULL),
(226, 'Svalbard And Jan Mayen', 'Norwegian Krone', 'NOK', 2, NULL),
(227, 'Sweden', 'Swedish Krona', 'SEK', 2, 'kr'),
(228, 'Switzerland', 'Swiss Franc', 'CHF', 2, NULL),
(229, 'Switzerland', 'WIR Euro', 'CHE', 2, NULL),
(230, 'Switzerland', 'WIR Franc', 'CHW', 2, NULL),
(231, 'Syrian Arab Republic', 'Syrian Pound', 'SYP', 2, NULL),
(232, 'Taiwan', 'New Taiwan Dollar', 'TWD', 2, NULL),
(233, 'Tajikistan', 'Somoni', 'TJS', 2, NULL),
(234, 'Tanzania, United Republic Of', 'Tanzanian Shilling', 'TZS', 2, NULL),
(235, 'Thailand', 'Baht', 'THB', 2, '฿'),
(236, 'Timor-leste', 'US Dollar', 'USD', 2, '$'),
(237, 'Togo', 'CFA Franc BCEAO', 'XOF', 0, NULL),
(238, 'Tokelau', 'New Zealand Dollar', 'NZD', 2, '$'),
(239, 'Tonga', 'Pa’anga', 'TOP', 2, NULL),
(240, 'Trinidad And Tobago', 'Trinidad and Tobago Dollar', 'TTD', 2, NULL),
(241, 'Tunisia', 'Tunisian Dinar', 'TND', 3, NULL),
(242, 'Turkey', 'Turkish Lira', 'TRY', 2, '₺'),
(243, 'Turkmenistan', 'Turkmenistan New Manat', 'TMT', 2, NULL),
(244, 'Turks And Caicos Islands', 'US Dollar', 'USD', 2, '$'),
(245, 'Tuvalu', 'Australian Dollar', 'AUD', 2, NULL),
(246, 'Uganda', 'Uganda Shilling', 'UGX', 0, NULL),
(247, 'Ukraine', 'Hryvnia', 'UAH', 2, '₴'),
(248, 'United Arab Emirates', 'UAE Dirham', 'AED', 2, 'د.إ'),
(249, 'United Kingdom Of Great Britain And Northern Ireland', 'Pound Sterling', 'GBP', 2, '£'),
(250, 'United States Minor Outlying Islands', 'US Dollar', 'USD', 2, '$'),
(251, 'United States Of America', 'US Dollar', 'USD', 2, '$'),
(252, 'United States Of America', 'US Dollar (Next day)', 'USN', 2, NULL),
(253, 'Uruguay', 'Peso Uruguayo', 'UYU', 2, NULL),
(254, 'Uruguay', 'Uruguay Peso en Unidades Indexadas (UI)', 'UYI', 0, NULL),
(255, 'Uruguay', 'Unidad Previsional', 'UYW', 4, NULL),
(256, 'Uzbekistan', 'Uzbekistan Sum', 'UZS', 2, NULL),
(257, 'Vanuatu', 'Vatu', 'VUV', 0, NULL),
(258, 'Venezuela', 'Bolívar Soberano', 'VES', 2, NULL),
(259, 'Vietnam', 'Dong', 'VND', 0, '₫'),
(260, 'Virgin Islands (British)', 'US Dollar', 'USD', 2, '$'),
(261, 'Virgin Islands (U.S.)', 'US Dollar', 'USD', 2, '$'),
(262, 'Wallis And Futuna', 'CFP Franc', 'XPF', 0, NULL),
(263, 'Western Sahara', 'Moroccan Dirham', 'MAD', 2, NULL),
(264, 'Yemen', 'Yemeni Rial', 'YER', 2, NULL),
(265, 'Zambia', 'Zambian Kwacha', 'ZMW', 2, NULL),
(266, 'Zimbabwe', 'Zimbabwe Dollar', 'ZWL', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `emailSettingForm`
--

CREATE TABLE `emailSettingForm` (
  `id` int NOT NULL,
  `smtp_server` text NOT NULL,
  `smtp_port` text NOT NULL,
  `sender_email` text NOT NULL,
  `sender_password` text NOT NULL,
  `parent_id` int NOT NULL,
  `branch_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emailSettingForm`
--

INSERT INTO `emailSettingForm` (`id`, `smtp_server`, `smtp_port`, `sender_email`, `sender_password`, `parent_id`, `branch_id`) VALUES
(1, 'smtp.zoho.com', '465', 'francis@kukulamicrofinance.org', 'Francismbewe@75', 2, 2),
(2, 'smtp.zoho.com', '465', 'francis@kukulamicrofinance.org', 'Francismbewe@75', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int NOT NULL,
  `branch_id` int NOT NULL,
  `parent_id` int NOT NULL,
  `expense_date` date NOT NULL,
  `expense_name` text NOT NULL,
  `expense_amount` decimal(10,2) NOT NULL,
  `currency` varchar(20) NOT NULL,
  `receipt_no_1` text NOT NULL,
  `receipt_no_2` text NOT NULL,
  `expense_loan_linked_to` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fundraisers`
--

CREATE TABLE `fundraisers` (
  `id` int NOT NULL,
  `id_number` text NOT NULL,
  `email` text NOT NULL,
  `name` text NOT NULL,
  `phone_number` text NOT NULL,
  `currency` text NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` text NOT NULL,
  `transaction_id` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `add_to_wall` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_borrowers`
--

CREATE TABLE `group_borrowers` (
  `id` int NOT NULL,
  `branch_id` int NOT NULL,
  `parent_id` int NOT NULL,
  `group_id` varchar(200) NOT NULL,
  `group_name` text NOT NULL,
  `borrowers_id` varchar(110) NOT NULL,
  `group_leader_id` int NOT NULL,
  `collectors_name` text NOT NULL,
  `description` text NOT NULL,
  `group_photo` text NOT NULL,
  `loan_officers_id` varchar(110) NOT NULL,
  `date_added` date NOT NULL,
  `transfer_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_borrower_members`
--

CREATE TABLE `group_borrower_members` (
  `id` int NOT NULL,
  `group_id` int NOT NULL,
  `group_unique_id` varchar(50) NOT NULL,
  `borrower_id` int NOT NULL,
  `branch_id` int NOT NULL,
  `parent_id` int NOT NULL,
  `member_names` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_loan_list`
--

CREATE TABLE `group_loan_list` (
  `id` int NOT NULL,
  `branch_id` int NOT NULL,
  `parent_id` int NOT NULL,
  `ref_no` varchar(50) NOT NULL,
  `loan_type_id` int NOT NULL,
  `borrower_id` int NOT NULL,
  `purpose` text NOT NULL,
  `amount` double NOT NULL,
  `plan_id` int NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0= request, 1= confrimed,2=released,3=complteted,4=denied\r\n',
  `date_released` datetime NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_loan_officer`
--

CREATE TABLE `group_loan_officer` (
  `id` int NOT NULL,
  `group_id` int NOT NULL,
  `group_unique_id` varchar(50) NOT NULL,
  `branch_id` int NOT NULL,
  `parent_id` int NOT NULL,
  `loan_officer_id` int NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guarantors`
--

CREATE TABLE `guarantors` (
  `id` int NOT NULL,
  `borrower_id` varchar(50) NOT NULL,
  `branch_id` int NOT NULL,
  `parent_id` int NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `business` text NOT NULL,
  `gender` text NOT NULL,
  `card_id` text NOT NULL,
  `country` text NOT NULL,
  `city` text NOT NULL,
  `address` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `dateofbirth` date NOT NULL,
  `working_status` text NOT NULL,
  `photo` text NOT NULL,
  `files` text NOT NULL,
  `loan_officers` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guarantor_files`
--

CREATE TABLE `guarantor_files` (
  `id` int NOT NULL,
  `guarantor_id` int NOT NULL,
  `parent_id` int NOT NULL,
  `branch_id` int NOT NULL,
  `card_id` varchar(100) NOT NULL,
  `file_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `income_table`
--

CREATE TABLE `income_table` (
  `id` int NOT NULL,
  `branch_id` int NOT NULL,
  `parent_id` int NOT NULL,
  `income_date` date NOT NULL,
  `income_name` text NOT NULL,
  `income_amount` decimal(10,2) NOT NULL,
  `currency` varchar(20) NOT NULL,
  `receipt_no_1` text NOT NULL,
  `receipt_no_2` text NOT NULL,
  `income_loan_linked_to` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `investors`
--

CREATE TABLE `investors` (
  `id` int NOT NULL,
  `photo` text NOT NULL,
  `parent_id` int NOT NULL,
  `title` text NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `working_status` text NOT NULL,
  `id_type` text NOT NULL,
  `id_number` text NOT NULL,
  `gender` text NOT NULL,
  `investor_country` int NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `address` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` int NOT NULL,
  `branch_id` int NOT NULL,
  `parent_id` int NOT NULL,
  `loan_id` int NOT NULL,
  `borrower_id` varchar(100) NOT NULL,
  `loan_number` varchar(100) NOT NULL,
  `principle_amount` decimal(10,2) NOT NULL,
  `release_method` varchar(50) NOT NULL,
  `release_date` date NOT NULL,
  `loan_interest_method` varchar(50) NOT NULL,
  `interest_type` varchar(100) NOT NULL,
  `currency` varchar(50) NOT NULL,
  `loan_interest` varchar(50) NOT NULL,
  `loan_interest_period` text NOT NULL,
  `loan_duration` int NOT NULL,
  `loan_payment_options` text NOT NULL,
  `loan__period` text NOT NULL,
  `processing_fee_type` text NOT NULL,
  `loan_processing_fee` text NOT NULL,
  `guarantor_id` int DEFAULT NULL,
  `loan_purpose` text NOT NULL,
  `repayments` int NOT NULL,
  `annual_p_rate` varchar(10) NOT NULL,
  `total_interest_amount` decimal(10,2) NOT NULL,
  `total_payable_amount` decimal(10,2) NOT NULL,
  `recurring_amount` decimal(10,2) NOT NULL,
  `monthly_interest` decimal(10,2) NOT NULL,
  `total_monthly_repayments` decimal(10,2) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `loan_status` enum('For_Approval','Approved','Released','Rejected','Completed') NOT NULL,
  `submitted_by` int NOT NULL DEFAULT '0',
  `actioned_by` int NOT NULL DEFAULT '0',
  `repayment_start_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `branch_id`, `parent_id`, `loan_id`, `borrower_id`, `loan_number`, `principle_amount`, `release_method`, `release_date`, `loan_interest_method`, `interest_type`, `currency`, `loan_interest`, `loan_interest_period`, `loan_duration`, `loan_payment_options`, `loan__period`, `processing_fee_type`, `loan_processing_fee`, `guarantor_id`, `loan_purpose`, `repayments`, `annual_p_rate`, `total_interest_amount`, `total_payable_amount`, `recurring_amount`, `monthly_interest`, `total_monthly_repayments`, `date_added`, `loan_status`, `submitted_by`, `actioned_by`, `repayment_start_date`) VALUES
(1, 4, 2, 3, '274248/51/1', '274248_51_1', '400.00', 'Cash', '2021-09-03', 'flat_rate', 'Percentage', 'ZMW', '35', 'Month', 1, 'Daily', 'Months', ' Amount', '25', 0, 'Business loan ', 30, '10.50', '11.67', '411.67', '13.72', '0.39', '14.11', '2021-09-02 11:55:22', 'Rejected', 0, 2, '2021-09-04'),
(2, 4, 2, 3, '480673/52/1', '480673_52_1', '500.00', 'Cash', '2021-09-03', 'flat_rate', 'Percentage', 'ZMW', '35', 'Month', 1, 'Daily', 'Months', ' Amount', '25', 0, 'Business loan ', 30, '10.50', '14.58', '514.58', '17.15', '0.49', '17.64', '2021-09-02 11:58:18', 'Rejected', 0, 2, '2021-09-04'),
(3, 4, 0, 7, '274248/51/1', '1', '400.00', 'Cash', '2021-09-04', 'flat_rate', 'Percentage', 'ZMW', '35', 'Month', 1, 'Daily', 'Months', ' Amount', '25', 0, 'Business', 28, '35', '140.00', '540.00', '19.29', '5.00', '19.29', '2021-09-07 09:23:23', 'For_Approval', 0, 0, '2021-09-04'),
(4, 4, 0, 7, '480673/52/1', '1', '500.00', 'Cash', '2021-09-04', 'flat_rate', 'Percentage', 'ZMW', '35', 'Month', 1, 'Daily', 'Months', ' Amount', '25', 0, 'Business', 28, '35', '175.00', '675.00', '24.11', '6.25', '24.11', '2021-09-07 09:25:13', 'For_Approval', 0, 0, '2021-09-04'),
(5, 4, 0, 7, '124074/10/1', '3', '1500.00', 'Cash', '2021-09-06', 'flat_rate', 'Percentage', 'ZMW', '35', 'Month', 1, 'Daily', 'Months', ' Amount', '25', 0, 'Business loan', 28, '35', '525.00', '2025.00', '72.32', '18.75', '72.32', '2021-09-07 11:09:52', 'For_Approval', 0, 0, '2021-09-09'),
(6, 4, 0, 7, '330598/51/1', '2', '1500.00', 'Cash', '2021-09-07', 'flat_rate', 'Percentage', 'ZMW', '35', 'Month', 1, 'Daily', 'Months', ' Amount', '25', 0, ' Business\r\nLoan', 28, '35', '525.00', '2025.00', '72.32', '18.75', '72.32', '2021-09-07 14:04:57', 'For_Approval', 0, 0, '2021-09-09');

-- --------------------------------------------------------

--
-- Table structure for table `loanStatus`
--

CREATE TABLE `loanStatus` (
  `id` int NOT NULL,
  `loan_id` int NOT NULL,
  `branch_id` int NOT NULL,
  `parent_id` int NOT NULL,
  `loan_officer_id` int NOT NULL,
  `action_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loan_fees`
--

CREATE TABLE `loan_fees` (
  `id` int NOT NULL,
  `choice` enum('percentage_based','amount_based') NOT NULL,
  `loan_fees_name` text NOT NULL,
  `loan_fees` decimal(10,2) NOT NULL,
  `symbol` varchar(10) NOT NULL,
  `parent_id` int NOT NULL,
  `branch_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loan_list`
--

CREATE TABLE `loan_list` (
  `id` int NOT NULL,
  `branch_id` int NOT NULL,
  `parent_id` int NOT NULL,
  `ref_no` varchar(50) NOT NULL,
  `loan_type_id` int NOT NULL,
  `borrower_id` int NOT NULL,
  `purpose` text NOT NULL,
  `amount` double NOT NULL,
  `plan_id` int NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0= request, 1= confrimed,2=released,3=complteted,4=denied\r\n',
  `date_released` datetime NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loan_offciers`
--

CREATE TABLE `loan_offciers` (
  `id` int NOT NULL,
  `borrower_id` int NOT NULL,
  `parent_id` int NOT NULL,
  `branch_id` int NOT NULL,
  `borrower_id_number` varchar(100) NOT NULL,
  `loan_officer_id` int NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan_offciers`
--

INSERT INTO `loan_offciers` (`id`, `borrower_id`, `parent_id`, `branch_id`, `borrower_id_number`, `loan_officer_id`, `date_added`) VALUES
(1, 2, 2, 4, '274248/51/1', 10, '2021-09-02'),
(2, 3, 2, 4, '480673/52/1', 10, '2021-09-02');

-- --------------------------------------------------------

--
-- Table structure for table `loan_payments`
--

CREATE TABLE `loan_payments` (
  `id` int NOT NULL,
  `loan_id` int NOT NULL,
  `loan_number` varchar(50) NOT NULL,
  `borrower_id` text NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `paid_date` date NOT NULL,
  `payment_method` text NOT NULL,
  `collected_by` int NOT NULL,
  `comment` text NOT NULL,
  `branch_id` int NOT NULL,
  `parent_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loan_plans`
--

CREATE TABLE `loan_plans` (
  `id` int NOT NULL,
  `loan_type` int NOT NULL,
  `months` int NOT NULL,
  `interest_percentage` float NOT NULL,
  `penalty_rate` int NOT NULL,
  `parent_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loan_schedules`
--

CREATE TABLE `loan_schedules` (
  `id` int NOT NULL,
  `parent_id` int NOT NULL,
  `branch_id` int NOT NULL,
  `loan_id` varchar(300) NOT NULL,
  `date_due` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan_schedules`
--

INSERT INTO `loan_schedules` (`id`, `parent_id`, `branch_id`, `loan_id`, `date_due`) VALUES
(1, 2, 4, '', '2021-09-03'),
(2, 2, 4, '', '2021-09-04'),
(3, 2, 4, '', '2021-09-05'),
(4, 2, 4, '', '2021-09-06'),
(5, 2, 4, '', '2021-09-07'),
(6, 2, 4, '', '2021-09-08'),
(7, 2, 4, '', '2021-09-09'),
(8, 2, 4, '', '2021-09-10'),
(9, 2, 4, '', '2021-09-11'),
(10, 2, 4, '', '2021-09-12'),
(11, 2, 4, '', '2021-09-13'),
(12, 2, 4, '', '2021-09-14'),
(13, 2, 4, '', '2021-09-15'),
(14, 2, 4, '', '2021-09-16'),
(15, 2, 4, '', '2021-09-17'),
(16, 2, 4, '', '2021-09-18'),
(17, 2, 4, '', '2021-09-19'),
(18, 2, 4, '', '2021-09-20'),
(19, 2, 4, '', '2021-09-21'),
(20, 2, 4, '', '2021-09-22'),
(21, 2, 4, '', '2021-09-23'),
(22, 2, 4, '', '2021-09-24'),
(23, 2, 4, '', '2021-09-25'),
(24, 2, 4, '', '2021-09-26'),
(25, 2, 4, '', '2021-09-27'),
(26, 2, 4, '', '2021-09-28'),
(27, 2, 4, '', '2021-09-29'),
(28, 2, 4, '', '2021-09-30'),
(29, 2, 4, '', '2021-10-01'),
(30, 2, 4, '', '2021-10-02'),
(31, 2, 4, '', '2021-09-03'),
(32, 2, 4, '', '2021-09-04'),
(33, 2, 4, '', '2021-09-05'),
(34, 2, 4, '', '2021-09-06'),
(35, 2, 4, '', '2021-09-07'),
(36, 2, 4, '', '2021-09-08'),
(37, 2, 4, '', '2021-09-09'),
(38, 2, 4, '', '2021-09-10'),
(39, 2, 4, '', '2021-09-11'),
(40, 2, 4, '', '2021-09-12'),
(41, 2, 4, '', '2021-09-13'),
(42, 2, 4, '', '2021-09-14'),
(43, 2, 4, '', '2021-09-15'),
(44, 2, 4, '', '2021-09-16'),
(45, 2, 4, '', '2021-09-17'),
(46, 2, 4, '', '2021-09-18'),
(47, 2, 4, '', '2021-09-19'),
(48, 2, 4, '', '2021-09-20'),
(49, 2, 4, '', '2021-09-21'),
(50, 2, 4, '', '2021-09-22'),
(51, 2, 4, '', '2021-09-23'),
(52, 2, 4, '', '2021-09-24'),
(53, 2, 4, '', '2021-09-25'),
(54, 2, 4, '', '2021-09-26'),
(55, 2, 4, '', '2021-09-27'),
(56, 2, 4, '', '2021-09-28'),
(57, 2, 4, '', '2021-09-29'),
(58, 2, 4, '', '2021-09-30'),
(59, 2, 4, '', '2021-10-01'),
(60, 2, 4, '', '2021-10-02'),
(61, 0, 4, '1', '2021-09-08'),
(62, 0, 4, '1', '2021-09-09'),
(63, 0, 4, '1', '2021-09-10'),
(64, 0, 4, '1', '2021-09-11'),
(65, 0, 4, '1', '2021-09-12'),
(66, 0, 4, '1', '2021-09-13'),
(67, 0, 4, '1', '2021-09-14'),
(68, 0, 4, '1', '2021-09-15'),
(69, 0, 4, '1', '2021-09-16'),
(70, 0, 4, '1', '2021-09-17'),
(71, 0, 4, '1', '2021-09-18'),
(72, 0, 4, '1', '2021-09-19'),
(73, 0, 4, '1', '2021-09-20'),
(74, 0, 4, '1', '2021-09-21'),
(75, 0, 4, '1', '2021-09-22'),
(76, 0, 4, '1', '2021-09-23'),
(77, 0, 4, '1', '2021-09-24'),
(78, 0, 4, '1', '2021-09-25'),
(79, 0, 4, '1', '2021-09-26'),
(80, 0, 4, '1', '2021-09-27'),
(81, 0, 4, '1', '2021-09-28'),
(82, 0, 4, '1', '2021-09-29'),
(83, 0, 4, '1', '2021-09-30'),
(84, 0, 4, '1', '2021-10-01'),
(85, 0, 4, '1', '2021-10-02'),
(86, 0, 4, '1', '2021-10-03'),
(87, 0, 4, '1', '2021-10-04'),
(88, 0, 4, '1', '2021-10-05'),
(89, 0, 4, '1', '2021-09-08'),
(90, 0, 4, '1', '2021-09-09'),
(91, 0, 4, '1', '2021-09-10'),
(92, 0, 4, '1', '2021-09-11'),
(93, 0, 4, '1', '2021-09-12'),
(94, 0, 4, '1', '2021-09-13'),
(95, 0, 4, '1', '2021-09-14'),
(96, 0, 4, '1', '2021-09-15'),
(97, 0, 4, '1', '2021-09-16'),
(98, 0, 4, '1', '2021-09-17'),
(99, 0, 4, '1', '2021-09-18'),
(100, 0, 4, '1', '2021-09-19'),
(101, 0, 4, '1', '2021-09-20'),
(102, 0, 4, '1', '2021-09-21'),
(103, 0, 4, '1', '2021-09-22'),
(104, 0, 4, '1', '2021-09-23'),
(105, 0, 4, '1', '2021-09-24'),
(106, 0, 4, '1', '2021-09-25'),
(107, 0, 4, '1', '2021-09-26'),
(108, 0, 4, '1', '2021-09-27'),
(109, 0, 4, '1', '2021-09-28'),
(110, 0, 4, '1', '2021-09-29'),
(111, 0, 4, '1', '2021-09-30'),
(112, 0, 4, '1', '2021-10-01'),
(113, 0, 4, '1', '2021-10-02'),
(114, 0, 4, '1', '2021-10-03'),
(115, 0, 4, '1', '2021-10-04'),
(116, 0, 4, '1', '2021-10-05'),
(117, 0, 4, '3', '2021-09-08'),
(118, 0, 4, '3', '2021-09-09'),
(119, 0, 4, '3', '2021-09-10'),
(120, 0, 4, '3', '2021-09-11'),
(121, 0, 4, '3', '2021-09-12'),
(122, 0, 4, '3', '2021-09-13'),
(123, 0, 4, '3', '2021-09-14'),
(124, 0, 4, '3', '2021-09-15'),
(125, 0, 4, '3', '2021-09-16'),
(126, 0, 4, '3', '2021-09-17'),
(127, 0, 4, '3', '2021-09-18'),
(128, 0, 4, '3', '2021-09-19'),
(129, 0, 4, '3', '2021-09-20'),
(130, 0, 4, '3', '2021-09-21'),
(131, 0, 4, '3', '2021-09-22'),
(132, 0, 4, '3', '2021-09-23'),
(133, 0, 4, '3', '2021-09-24'),
(134, 0, 4, '3', '2021-09-25'),
(135, 0, 4, '3', '2021-09-26'),
(136, 0, 4, '3', '2021-09-27'),
(137, 0, 4, '3', '2021-09-28'),
(138, 0, 4, '3', '2021-09-29'),
(139, 0, 4, '3', '2021-09-30'),
(140, 0, 4, '3', '2021-10-01'),
(141, 0, 4, '3', '2021-10-02'),
(142, 0, 4, '3', '2021-10-03'),
(143, 0, 4, '3', '2021-10-04'),
(144, 0, 4, '3', '2021-10-05'),
(145, 0, 4, '2', '2021-09-08'),
(146, 0, 4, '2', '2021-09-09'),
(147, 0, 4, '2', '2021-09-10'),
(148, 0, 4, '2', '2021-09-11'),
(149, 0, 4, '2', '2021-09-12'),
(150, 0, 4, '2', '2021-09-13'),
(151, 0, 4, '2', '2021-09-14'),
(152, 0, 4, '2', '2021-09-15'),
(153, 0, 4, '2', '2021-09-16'),
(154, 0, 4, '2', '2021-09-17'),
(155, 0, 4, '2', '2021-09-18'),
(156, 0, 4, '2', '2021-09-19'),
(157, 0, 4, '2', '2021-09-20'),
(158, 0, 4, '2', '2021-09-21'),
(159, 0, 4, '2', '2021-09-22'),
(160, 0, 4, '2', '2021-09-23'),
(161, 0, 4, '2', '2021-09-24'),
(162, 0, 4, '2', '2021-09-25'),
(163, 0, 4, '2', '2021-09-26'),
(164, 0, 4, '2', '2021-09-27'),
(165, 0, 4, '2', '2021-09-28'),
(166, 0, 4, '2', '2021-09-29'),
(167, 0, 4, '2', '2021-09-30'),
(168, 0, 4, '2', '2021-10-01'),
(169, 0, 4, '2', '2021-10-02'),
(170, 0, 4, '2', '2021-10-03'),
(171, 0, 4, '2', '2021-10-04'),
(172, 0, 4, '2', '2021-10-05');

-- --------------------------------------------------------

--
-- Table structure for table `loan_type`
--

CREATE TABLE `loan_type` (
  `id` int NOT NULL,
  `type_name` text NOT NULL,
  `description` text NOT NULL,
  `parent_id` int NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan_type`
--

INSERT INTO `loan_type` (`id`, `type_name`, `description`, `parent_id`, `date_added`) VALUES
(3, 'Individual loan', 'Business', 2, '2021-09-02'),
(4, 'Schools Loan', 'School', 1, '2021-09-02'),
(7, 'Individual loan', 'Business loan ', 0, '2021-09-07');

-- --------------------------------------------------------

--
-- Table structure for table `login_table`
--

CREATE TABLE `login_table` (
  `id` int NOT NULL,
  `parent_id` int NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `time_login` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_ip` text NOT NULL,
  `user_country` text,
  `logout_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_table`
--

INSERT INTO `login_table` (`id`, `parent_id`, `email`, `password`, `time_login`, `user_ip`, `user_country`, `logout_time`) VALUES
(1, 1, 'mulengamuls85@gmail.com', '$2y$10$NS4M94YM8Xf.FJvDI553ZO9X3dCjw2R44pQLK0El7S0l7mPcUrXPW', '2021-08-27 15:16:42', '41.72.116.54', 'Zambia', NULL),
(2, 2, 'francismbewe75@gmail.com', '$2y$10$OBJXsFtYxt0FMs5VuKB9Ee6PxHg1b9ksmqW3DsoxUskrfxRFecQ72', '2021-08-27 15:54:10', '41.175.169.128', 'Mauritius', NULL),
(3, 1, 'mulengamuls85@gmail.com', '$2y$10$NS4M94YM8Xf.FJvDI553ZO9X3dCjw2R44pQLK0El7S0l7mPcUrXPW', '2021-08-27 16:55:25', '41.72.116.54', 'Zambia', '2021-08-27 17:19:29'),
(4, 1, 'mulengamuls85@gmail.com', '$2y$10$NS4M94YM8Xf.FJvDI553ZO9X3dCjw2R44pQLK0El7S0l7mPcUrXPW', '2021-08-27 18:12:33', '41.72.116.54', 'Zambia', '2021-08-27 18:40:06'),
(5, 2, 'francismbewe75@gmail.com', '$2y$10$OBJXsFtYxt0FMs5VuKB9Ee6PxHg1b9ksmqW3DsoxUskrfxRFecQ72', '2021-08-27 18:49:07', '41.72.116.54', 'Zambia', '2021-08-27 19:16:44'),
(6, 2, 'francismbewe75@gmail.com', '$2y$10$OBJXsFtYxt0FMs5VuKB9Ee6PxHg1b9ksmqW3DsoxUskrfxRFecQ72', '2021-08-27 18:49:50', '41.174.24.92', 'Mauritius', NULL),
(7, 2, 'francismbewe75@gmail.com', '$2y$10$OBJXsFtYxt0FMs5VuKB9Ee6PxHg1b9ksmqW3DsoxUskrfxRFecQ72', '2021-08-29 11:52:35', '41.174.24.92', 'Mauritius', NULL),
(8, 2, 'francismbewe75@gmail.com', '$2y$10$OBJXsFtYxt0FMs5VuKB9Ee6PxHg1b9ksmqW3DsoxUskrfxRFecQ72', '2021-08-30 20:27:41', '41.174.1.114', 'Mauritius', NULL),
(9, 1, 'mulengamuls85@gmail.com', '$2y$10$NS4M94YM8Xf.FJvDI553ZO9X3dCjw2R44pQLK0El7S0l7mPcUrXPW', '2021-08-30 23:49:03', '165.56.181.31', 'Zambia', '2021-08-30 23:49:54'),
(10, 2, 'francismbewe75@gmail.com', '$2y$10$OBJXsFtYxt0FMs5VuKB9Ee6PxHg1b9ksmqW3DsoxUskrfxRFecQ72', '2021-08-31 07:29:54', '41.174.1.114', 'Mauritius', '2021-08-31 07:31:16'),
(11, 2, 'francismbewe75@gmail.com', '$2y$10$OBJXsFtYxt0FMs5VuKB9Ee6PxHg1b9ksmqW3DsoxUskrfxRFecQ72', '2021-09-01 07:55:03', '41.174.10.56', 'Mauritius', '2021-09-01 08:06:12'),
(12, 2, 'francismbewe75@gmail.com', '$2y$10$OBJXsFtYxt0FMs5VuKB9Ee6PxHg1b9ksmqW3DsoxUskrfxRFecQ72', '2021-09-01 08:06:55', '41.174.10.56', 'Mauritius', '2021-09-01 08:09:13'),
(13, 2, 'francismbewe75@gmail.com', '$2y$10$OBJXsFtYxt0FMs5VuKB9Ee6PxHg1b9ksmqW3DsoxUskrfxRFecQ72', '2021-09-01 08:11:10', '41.72.116.54', 'Zambia', NULL),
(14, 2, 'francismbewe75@gmail.com', '$2y$10$OBJXsFtYxt0FMs5VuKB9Ee6PxHg1b9ksmqW3DsoxUskrfxRFecQ72', '2021-09-01 08:27:05', '41.174.10.56', 'Mauritius', '2021-09-01 08:41:56'),
(15, 2, 'francismbewe75@gmail.com', '$2y$10$OBJXsFtYxt0FMs5VuKB9Ee6PxHg1b9ksmqW3DsoxUskrfxRFecQ72', '2021-09-01 08:59:14', '41.174.10.56', 'Mauritius', '2021-09-01 09:01:31'),
(16, 2, 'francismbewe75@gmail.com', '$2y$10$OBJXsFtYxt0FMs5VuKB9Ee6PxHg1b9ksmqW3DsoxUskrfxRFecQ72', '2021-09-01 13:16:54', '41.174.10.56', 'Mauritius', '2021-09-01 14:14:55'),
(17, 2, 'francismbewe75@gmail.com', '$2y$10$OBJXsFtYxt0FMs5VuKB9Ee6PxHg1b9ksmqW3DsoxUskrfxRFecQ72', '2021-09-01 13:17:48', '41.72.116.54', 'Zambia', '2021-09-01 13:35:21'),
(18, 1, 'mulengamuls85@gmail.com', '$2y$10$NS4M94YM8Xf.FJvDI553ZO9X3dCjw2R44pQLK0El7S0l7mPcUrXPW', '2021-09-01 13:35:41', '41.72.116.54', 'Zambia', NULL),
(19, 1, 'muchimbarita@gmail.com', '$2y$10$/BXJEur7BVFZmQDQjBmU4eb/xRTTYHAfMivH..fVDI1irjrXsZTNK', '2021-09-01 13:58:59', '41.72.116.54', 'Zambia', NULL),
(20, 2, 'francismbewe75@gmail.com', '$2y$10$OBJXsFtYxt0FMs5VuKB9Ee6PxHg1b9ksmqW3DsoxUskrfxRFecQ72', '2021-09-01 14:47:48', '41.174.10.56', 'Mauritius', '2021-09-01 15:40:02'),
(21, 2, 'francismbewe75@gmail.com', '$2y$10$OBJXsFtYxt0FMs5VuKB9Ee6PxHg1b9ksmqW3DsoxUskrfxRFecQ72', '2021-09-01 15:41:32', '41.174.10.56', 'Mauritius', '2021-09-01 15:41:58'),
(22, 2, 'charlessakalahcs@gmail.com', '$2y$10$704Qh7actiyPG68GrxhX3.dDDjpYAp6HxKbNAxQQwaBlgtFYBMz.C', '2021-09-01 15:42:37', '41.174.10.56', 'Mauritius', NULL),
(23, 1, 'mulengamuls85@gmail.com', '$2y$10$NS4M94YM8Xf.FJvDI553ZO9X3dCjw2R44pQLK0El7S0l7mPcUrXPW', '2021-09-01 16:24:15', '41.72.116.54', 'Zambia', '2021-09-01 16:32:32'),
(24, 2, 'francismbewe75@gmail.com', '$2y$10$OBJXsFtYxt0FMs5VuKB9Ee6PxHg1b9ksmqW3DsoxUskrfxRFecQ72', '2021-09-01 16:32:49', '41.72.116.54', 'Zambia', '2021-09-01 17:47:24'),
(25, 2, 'francismbewe75@gmail.com', '$2y$10$OBJXsFtYxt0FMs5VuKB9Ee6PxHg1b9ksmqW3DsoxUskrfxRFecQ72', '2021-09-02 08:10:20', '41.174.10.56', 'Mauritius', '2021-09-02 08:20:22'),
(26, 2, 'francismbewe75@gmail.com', '$2y$10$OBJXsFtYxt0FMs5VuKB9Ee6PxHg1b9ksmqW3DsoxUskrfxRFecQ72', '2021-09-02 09:46:34', '41.174.10.56', 'Mauritius', NULL),
(27, 2, 'chiseulahector@gmail.com', '$2y$10$XrDcXngSyMeFh1Bh/BYhS.A5TwsTMyA.nQFOoHsvi94ww9YDn5rQ2', '2021-09-02 09:50:16', '41.223.119.43', 'Zambia', NULL),
(28, 2, 'josiasbanda9@gmail.com', '$2y$10$6A0gKdZpRSVw9lR7Zo0KhuZCEgesjk4VQlwlVJuYhZogm0GDgI2K6', '2021-09-02 10:33:19', '102.146.120.81', 'Zambia', NULL),
(29, 2, 'josiasbanda9@gmail.com', '$2y$10$6A0gKdZpRSVw9lR7Zo0KhuZCEgesjk4VQlwlVJuYhZogm0GDgI2K6', '2021-09-02 10:40:01', '102.146.120.81', 'Zambia', '2021-09-02 11:01:11'),
(30, 2, 'josiasbanda9@gmail.com', '$2y$10$6A0gKdZpRSVw9lR7Zo0KhuZCEgesjk4VQlwlVJuYhZogm0GDgI2K6', '2021-09-02 11:01:25', '102.146.120.81', 'Zambia', NULL),
(31, 2, 'josiasbanda9@gmail.com', '$2y$10$6A0gKdZpRSVw9lR7Zo0KhuZCEgesjk4VQlwlVJuYhZogm0GDgI2K6', '2021-09-02 11:08:59', '102.146.120.81', 'Zambia', NULL),
(32, 2, 'josiasbanda9@gmail.com', '$2y$10$6A0gKdZpRSVw9lR7Zo0KhuZCEgesjk4VQlwlVJuYhZogm0GDgI2K6', '2021-09-02 11:35:23', '102.146.120.81', 'Zambia', NULL),
(33, 2, 'francismbewe75@gmail.com', '$2y$10$OBJXsFtYxt0FMs5VuKB9Ee6PxHg1b9ksmqW3DsoxUskrfxRFecQ72', '2021-09-02 11:47:49', '41.174.10.56', 'Mauritius', NULL),
(34, 2, 'francismbewe75@gmail.com', '$2y$10$OBJXsFtYxt0FMs5VuKB9Ee6PxHg1b9ksmqW3DsoxUskrfxRFecQ72', '2021-09-02 19:51:35', '165.56.182.162', 'Zambia', '2021-09-02 19:58:05'),
(35, 1, 'mulengamuls85@gmail.com', '$2y$10$NS4M94YM8Xf.FJvDI553ZO9X3dCjw2R44pQLK0El7S0l7mPcUrXPW', '2021-09-02 19:58:47', '165.56.182.162', 'Zambia', '2021-09-02 20:09:19'),
(36, 2, 'francismbewe75@gmail.com', '$2y$10$OBJXsFtYxt0FMs5VuKB9Ee6PxHg1b9ksmqW3DsoxUskrfxRFecQ72', '2021-09-02 20:09:50', '165.56.182.162', 'Zambia', NULL),
(37, 2, 'francismbewe75@gmail.com', '$2y$10$OBJXsFtYxt0FMs5VuKB9Ee6PxHg1b9ksmqW3DsoxUskrfxRFecQ72', '2021-09-03 06:58:42', '165.56.182.203', 'Zambia', NULL),
(38, 2, 'francismbewe75@gmail.com', '$2y$10$OBJXsFtYxt0FMs5VuKB9Ee6PxHg1b9ksmqW3DsoxUskrfxRFecQ72', '2021-09-03 08:17:27', '41.174.40.149', 'Mauritius', '2021-09-03 09:00:56'),
(39, 2, 'josiasbanda9@gmail.com', '$2y$10$6A0gKdZpRSVw9lR7Zo0KhuZCEgesjk4VQlwlVJuYhZogm0GDgI2K6', '2021-09-03 09:20:37', '102.146.120.81', 'Zambia', NULL),
(40, 2, 'josiasbanda9@gmail.com', '$2y$10$6A0gKdZpRSVw9lR7Zo0KhuZCEgesjk4VQlwlVJuYhZogm0GDgI2K6', '2021-09-03 09:48:06', '102.146.120.81', 'Zambia', NULL),
(41, 2, 'francismbewe75@gmail.com', '$2y$10$OBJXsFtYxt0FMs5VuKB9Ee6PxHg1b9ksmqW3DsoxUskrfxRFecQ72', '2021-09-03 09:50:09', '41.174.40.149', 'Mauritius', NULL),
(42, 2, 'chiseulahector@gmail.com', '$2y$10$XrDcXngSyMeFh1Bh/BYhS.A5TwsTMyA.nQFOoHsvi94ww9YDn5rQ2', '2021-09-03 10:05:50', '41.223.119.43', 'Zambia', NULL),
(43, 2, 'francismbewe75@gmail.com', '$2y$10$OBJXsFtYxt0FMs5VuKB9Ee6PxHg1b9ksmqW3DsoxUskrfxRFecQ72', '2021-09-03 10:44:20', '165.56.182.203', 'Zambia', NULL),
(44, 2, 'francismbewe75@gmail.com', '$2y$10$OBJXsFtYxt0FMs5VuKB9Ee6PxHg1b9ksmqW3DsoxUskrfxRFecQ72', '2021-09-03 11:25:43', '165.56.181.45', 'Zambia', NULL),
(45, 2, 'francismbewe75@gmail.com', '$2y$10$OBJXsFtYxt0FMs5VuKB9Ee6PxHg1b9ksmqW3DsoxUskrfxRFecQ72', '2021-09-03 15:57:23', '165.56.181.195', 'Zambia', NULL),
(46, 2, 'francismbewe75@gmail.com', '$2y$10$OBJXsFtYxt0FMs5VuKB9Ee6PxHg1b9ksmqW3DsoxUskrfxRFecQ72', '2021-09-03 17:42:16', '165.56.181.195', 'Zambia', NULL),
(47, 2, 'chiseulahector@gmail.com', '$2y$10$XrDcXngSyMeFh1Bh/BYhS.A5TwsTMyA.nQFOoHsvi94ww9YDn5rQ2', '2021-09-03 18:43:54', '41.223.119.43', 'Zambia', NULL),
(48, 2, 'josiasbanda9@gmail.com', '$2y$10$6A0gKdZpRSVw9lR7Zo0KhuZCEgesjk4VQlwlVJuYhZogm0GDgI2K6', '2021-09-06 11:04:47', '41.223.119.37', 'Zambia', NULL),
(49, 2, 'francismbewe75@gmail.com', '$2y$10$OBJXsFtYxt0FMs5VuKB9Ee6PxHg1b9ksmqW3DsoxUskrfxRFecQ72', '2021-09-06 11:50:06', '41.174.44.181', 'Mauritius', '2021-09-06 11:54:11'),
(50, 2, 'francismbewe75@gmail.com', '$2y$10$OBJXsFtYxt0FMs5VuKB9Ee6PxHg1b9ksmqW3DsoxUskrfxRFecQ72', '2021-09-06 11:56:55', '41.174.44.181', 'Mauritius', '2021-09-06 11:59:56'),
(51, 2, 'tilimboyimwiinga21@gmail.com', '$2y$10$loOD4t.9NdR6A7w1vIvsheWZq.rpIZy/sUXdCZKlomMMVVTtaHcoK', '2021-09-06 12:14:26', '197.213.18.182', 'Zambia', NULL),
(52, 2, 'francismbewe75@gmail.com', '$2y$10$OBJXsFtYxt0FMs5VuKB9Ee6PxHg1b9ksmqW3DsoxUskrfxRFecQ72', '2021-09-06 12:16:14', '41.72.116.54', 'Zambia', NULL),
(53, 2, 'josiasbanda9@gmail.com', '$2y$10$6A0gKdZpRSVw9lR7Zo0KhuZCEgesjk4VQlwlVJuYhZogm0GDgI2K6', '2021-09-07 09:11:35', '41.223.119.44', 'Zambia', NULL),
(54, 2, 'josiasbanda9@gmail.com', '$2y$10$6A0gKdZpRSVw9lR7Zo0KhuZCEgesjk4VQlwlVJuYhZogm0GDgI2K6', '2021-09-07 09:54:23', '41.223.119.44', 'Zambia', NULL),
(55, 2, 'josiasbanda9@gmail.com', '$2y$10$6A0gKdZpRSVw9lR7Zo0KhuZCEgesjk4VQlwlVJuYhZogm0GDgI2K6', '2021-09-07 09:59:23', '41.223.119.44', 'Zambia', NULL),
(56, 2, 'francismbewe75@gmail.com', '$2y$10$OBJXsFtYxt0FMs5VuKB9Ee6PxHg1b9ksmqW3DsoxUskrfxRFecQ72', '2021-09-07 10:02:36', '41.174.49.23', 'Mauritius', NULL),
(57, 2, 'josiasbanda9@gmail.com', '$2y$10$6A0gKdZpRSVw9lR7Zo0KhuZCEgesjk4VQlwlVJuYhZogm0GDgI2K6', '2021-09-07 11:07:04', '41.223.119.44', 'Zambia', NULL),
(58, 2, 'josiasbanda9@gmail.com', '$2y$10$6A0gKdZpRSVw9lR7Zo0KhuZCEgesjk4VQlwlVJuYhZogm0GDgI2K6', '2021-09-07 11:51:06', '41.223.119.44', 'Zambia', NULL),
(59, 2, 'josiasbanda9@gmail.com', '$2y$10$6A0gKdZpRSVw9lR7Zo0KhuZCEgesjk4VQlwlVJuYhZogm0GDgI2K6', '2021-09-07 13:43:15', '41.223.119.44', 'Zambia', NULL),
(60, 2, 'francismbewe75@gmail.com', '$2y$10$OBJXsFtYxt0FMs5VuKB9Ee6PxHg1b9ksmqW3DsoxUskrfxRFecQ72', '2021-09-07 14:08:39', '41.174.49.205', 'Mauritius', NULL),
(61, 2, 'josiasbanda9@gmail.com', '$2y$10$6A0gKdZpRSVw9lR7Zo0KhuZCEgesjk4VQlwlVJuYhZogm0GDgI2K6', '2021-09-07 14:44:04', '41.223.119.44', 'Zambia', NULL),
(62, 2, 'josiasbanda9@gmail.com', '$2y$10$6A0gKdZpRSVw9lR7Zo0KhuZCEgesjk4VQlwlVJuYhZogm0GDgI2K6', '2021-09-07 17:02:17', '41.223.119.44', 'Zambia', NULL),
(63, 2, 'francismbewe75@gmail.com', '$2y$10$OBJXsFtYxt0FMs5VuKB9Ee6PxHg1b9ksmqW3DsoxUskrfxRFecQ72', '2021-09-16 00:16:51', '165.56.181.126', 'Zambia', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `organisations`
--

CREATE TABLE `organisations` (
  `id` int NOT NULL,
  `org_logo` text NOT NULL,
  `organisation_name` text NOT NULL,
  `parent_id` int NOT NULL,
  `admin_email` text NOT NULL,
  `hq_phone` text NOT NULL,
  `hq_address` text NOT NULL,
  `date_added` date NOT NULL,
  `admin_password` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organisations`
--

INSERT INTO `organisations` (`id`, `org_logo`, `organisation_name`, `parent_id`, `admin_email`, `hq_phone`, `hq_address`, `date_added`, `admin_password`) VALUES
(1, 'copy_230548916.png', 'Kukula', 2, 'francis@kukulamicrofinance.org', '+260216225062', 'Plot 1635 Off Airport Road, Motel Area\r\nPlot 1635', '2021-08-29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `id` int NOT NULL,
  `payment_type` enum('weekly','monthly') NOT NULL,
  `pay_date` date NOT NULL,
  `employee_id` int NOT NULL,
  `pay_scale` int NOT NULL,
  `salary_amount` decimal(10,2) NOT NULL,
  `the_currency` varchar(10) NOT NULL,
  `grosspay` decimal(10,2) NOT NULL,
  `total_deductions` decimal(10,2) NOT NULL,
  `net_pay` decimal(10,2) NOT NULL,
  `payment_method` text NOT NULL,
  `bank_name` text,
  `account_number` text,
  `paid_amount` decimal(10,2) NOT NULL,
  `branch_id` int NOT NULL,
  `parent_id` int NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_allowances`
--

CREATE TABLE `payroll_allowances` (
  `id` int NOT NULL,
  `payroll_id` int NOT NULL,
  `employee_id` int NOT NULL,
  `branch_id` int NOT NULL,
  `parent_id` int NOT NULL,
  `allowance_id` int NOT NULL,
  `allowance_amount` decimal(10,2) NOT NULL,
  `pay_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_deductions`
--

CREATE TABLE `payroll_deductions` (
  `id` int NOT NULL,
  `payroll_id` int NOT NULL,
  `employee_id` int NOT NULL,
  `branch_id` int NOT NULL,
  `parent_id` int NOT NULL,
  `deduction_id` int NOT NULL,
  `deduction_amount` decimal(10,2) NOT NULL,
  `pay_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int NOT NULL,
  `title` text NOT NULL,
  `parent_id` int NOT NULL,
  `permissions` enum('finance','office') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `title`, `parent_id`, `permissions`) VALUES
(4, 'Area Manager- Petauke District', 2, 'finance'),
(5, 'Chief Executive Officer', 2, 'finance'),
(6, 'Accountant', 2, 'finance'),
(7, 'Accounts Officer', 2, 'finance'),
(8, 'Area Manager-Lundazi District', 2, 'finance'),
(9, 'Area Manager-Katete District', 2, 'finance'),
(10, 'Area Manager-Chipata District', 2, 'finance'),
(11, 'IT Manager', 1, 'finance'),
(12, 'Teller', 1, 'finance');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `organization_name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salary_allowances`
--

CREATE TABLE `salary_allowances` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `branch_id` int NOT NULL,
  `parent_id` int NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salary_deductions`
--

CREATE TABLE `salary_deductions` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `branch_id` int NOT NULL,
  `parent_id` int NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sent_emails`
--

CREATE TABLE `sent_emails` (
  `id` int NOT NULL,
  `receiver` varchar(300) NOT NULL,
  `sender_id` varchar(100) NOT NULL,
  `parent_id` int NOT NULL,
  `branch_id` int NOT NULL,
  `message` text NOT NULL,
  `filename` text NOT NULL,
  `date_sent` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sms`
--

CREATE TABLE `sms` (
  `id` int NOT NULL,
  `receiver` text NOT NULL,
  `sender_id` text NOT NULL,
  `parent_id` int NOT NULL,
  `branch_id` int NOT NULL,
  `message` text NOT NULL,
  `date_sent` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `responseText` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `allowed_branches`
--
ALTER TABLE `allowed_branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `basicPaySetUp`
--
ALTER TABLE `basicPaySetUp`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `borrowers`
--
ALTER TABLE `borrowers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrower_branches`
--
ALTER TABLE `borrower_branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrower_files`
--
ALTER TABLE `borrower_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients_in_need`
--
ALTER TABLE `clients_in_need`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collaterals`
--
ALTER TABLE `collaterals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collaterals_files`
--
ALTER TABLE `collaterals_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emailSettingForm`
--
ALTER TABLE `emailSettingForm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fundraisers`
--
ALTER TABLE `fundraisers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_borrowers`
--
ALTER TABLE `group_borrowers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_borrower_members`
--
ALTER TABLE `group_borrower_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_loan_list`
--
ALTER TABLE `group_loan_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_loan_officer`
--
ALTER TABLE `group_loan_officer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guarantors`
--
ALTER TABLE `guarantors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guarantor_files`
--
ALTER TABLE `guarantor_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income_table`
--
ALTER TABLE `income_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investors`
--
ALTER TABLE `investors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loanStatus`
--
ALTER TABLE `loanStatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_fees`
--
ALTER TABLE `loan_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_list`
--
ALTER TABLE `loan_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_offciers`
--
ALTER TABLE `loan_offciers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_payments`
--
ALTER TABLE `loan_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_plans`
--
ALTER TABLE `loan_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_schedules`
--
ALTER TABLE `loan_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_type`
--
ALTER TABLE `loan_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_table`
--
ALTER TABLE `login_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organisations`
--
ALTER TABLE `organisations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payroll_allowances`
--
ALTER TABLE `payroll_allowances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payroll_deductions`
--
ALTER TABLE `payroll_deductions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary_allowances`
--
ALTER TABLE `salary_allowances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary_deductions`
--
ALTER TABLE `salary_deductions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sent_emails`
--
ALTER TABLE `sent_emails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `allowed_branches`
--
ALTER TABLE `allowed_branches`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `basicPaySetUp`
--
ALTER TABLE `basicPaySetUp`
  MODIFY `p_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `borrowers`
--
ALTER TABLE `borrowers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `borrower_branches`
--
ALTER TABLE `borrower_branches`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `borrower_files`
--
ALTER TABLE `borrower_files`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `clients_in_need`
--
ALTER TABLE `clients_in_need`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `collaterals`
--
ALTER TABLE `collaterals`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `collaterals_files`
--
ALTER TABLE `collaterals_files`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=254;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=267;

--
-- AUTO_INCREMENT for table `emailSettingForm`
--
ALTER TABLE `emailSettingForm`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fundraisers`
--
ALTER TABLE `fundraisers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_borrowers`
--
ALTER TABLE `group_borrowers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_borrower_members`
--
ALTER TABLE `group_borrower_members`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_loan_list`
--
ALTER TABLE `group_loan_list`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_loan_officer`
--
ALTER TABLE `group_loan_officer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guarantors`
--
ALTER TABLE `guarantors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guarantor_files`
--
ALTER TABLE `guarantor_files`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `income_table`
--
ALTER TABLE `income_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `investors`
--
ALTER TABLE `investors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `loanStatus`
--
ALTER TABLE `loanStatus`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_fees`
--
ALTER TABLE `loan_fees`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_list`
--
ALTER TABLE `loan_list`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_offciers`
--
ALTER TABLE `loan_offciers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `loan_payments`
--
ALTER TABLE `loan_payments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_plans`
--
ALTER TABLE `loan_plans`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_schedules`
--
ALTER TABLE `loan_schedules`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT for table `loan_type`
--
ALTER TABLE `loan_type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `login_table`
--
ALTER TABLE `login_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `organisations`
--
ALTER TABLE `organisations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payroll_allowances`
--
ALTER TABLE `payroll_allowances`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payroll_deductions`
--
ALTER TABLE `payroll_deductions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salary_allowances`
--
ALTER TABLE `salary_allowances`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salary_deductions`
--
ALTER TABLE `salary_deductions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sent_emails`
--
ALTER TABLE `sent_emails`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
