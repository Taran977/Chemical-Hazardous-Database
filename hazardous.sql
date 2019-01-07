-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2018 at 06:11 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hazardous`
--

-- --------------------------------------------------------

--
-- Table structure for table `chemicals`
--

CREATE TABLE `chemicals` (
  `chem_id` int(10) NOT NULL,
  `chem_name` varchar(255) NOT NULL,
  `chem_formula` varchar(255) NOT NULL,
  `chem_cas` varchar(255) NOT NULL,
  `chem_supplier` varchar(255) NOT NULL,
  `chem_date_received` datetime NOT NULL,
  `chem_date_expiry` datetime NOT NULL,
  `chem_hazard_type` varchar(15) NOT NULL,
  `chem_location` varchar(255) NOT NULL,
  `chem_location_details` varchar(255) NOT NULL,
  `chem_state` varchar(255) NOT NULL,
  `chem_tare_mass` varchar(255) NOT NULL,
  `chem_mass` varchar(255) NOT NULL,
  `chem_description` text NOT NULL,
  `chem_safety_url` text NOT NULL,
  `chem_department_id` int(10) NOT NULL,
  `chem_owner_id` int(10) NOT NULL,
  `chem_user_added_id` int(10) NOT NULL,
  `chem_added_date` datetime NOT NULL,
  `chem_modify_date` datetime NOT NULL,
  `chem_status` int(2) NOT NULL,
  `chem_ip_address` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chemicals`
--

INSERT INTO `chemicals` (`chem_id`, `chem_name`, `chem_formula`, `chem_cas`, `chem_supplier`, `chem_date_received`, `chem_date_expiry`, `chem_hazard_type`, `chem_location`, `chem_location_details`, `chem_state`, `chem_tare_mass`, `chem_mass`, `chem_description`, `chem_safety_url`, `chem_department_id`, `chem_owner_id`, `chem_user_added_id`, `chem_added_date`, `chem_modify_date`, `chem_status`, `chem_ip_address`) VALUES
(2, 'dfgdfg', 'dfgdfg', 'dfgfdg', 'dfgdfg', '2018-10-27 00:00:00', '2018-10-26 00:00:00', 'B', 'fgdfgdfg', 'fgdfgdg', 'Solid', 'dfgdfg', 'dfgdfg', 'gffdg', 'dgfdfg', 1, 9, 1, '2018-10-27 12:55:06', '0000-00-00 00:00:00', 1, '::1'),
(3, 'dfgdfg', 'dfgdfg', 'dfgfdg', 'dfgdfg', '2018-10-27 00:00:00', '2018-10-26 00:00:00', 'B', 'fgdfgdfg', 'fgdfgdg', 'Solid', 'dfgdfg', 'dfgdfg', 'gffdg', 'dgfdfg', 1, 9, 1, '2018-10-27 12:57:24', '0000-00-00 00:00:00', 1, '::1'),
(4, 'dfgdfg', 'dfgdfg', 'dfgfdg', 'dfgdfg', '2018-10-27 00:00:00', '2018-10-26 00:00:00', 'B', 'fgdfgdfg', 'fgdfgdg', 'Solid', 'dfgdfg', 'dfgdfg', 'gffdg', 'dgfdfg', 1, 9, 1, '2018-10-27 12:57:27', '0000-00-00 00:00:00', 1, '::1'),
(5, 'dfgdfg', 'dfgdfg', 'dfgfdg', 'dfgdfg', '2018-10-27 00:00:00', '2018-10-26 00:00:00', 'B', 'fgdfgdfg', 'fgdfgdg', 'Solid', 'dfgdfg', 'dfgdfg', 'gffdg', 'dgfdfg', 1, 9, 1, '2018-10-27 13:23:33', '0000-00-00 00:00:00', 1, '::1'),
(6, 'dfgdfg', 'dfgdfg', 'dfgfdg', 'dfgdfg', '2018-10-27 00:00:00', '2018-10-26 00:00:00', 'B', 'fgdfgdfg', 'fgdfgdg', 'Solid', 'dfgdfg', 'dfgdfg', 'gffdg', 'dgfdfg', 1, 9, 1, '2018-10-27 13:23:42', '0000-00-00 00:00:00', 1, '::1'),
(7, 'dfgdfg', 'dfgdfg', 'dfgfdg', 'dfgdfg', '2018-10-27 00:00:00', '2018-10-26 00:00:00', 'B', 'fgdfgdfg', 'fgdfgdg', 'Solid', 'dfgdfg', 'dfgdfg', 'gffdg', 'dgfdfg', 1, 9, 1, '2018-10-27 13:23:53', '0000-00-00 00:00:00', 1, '::1'),
(8, 'dfgdfg', 'dfgdfg', 'dfgfdg', 'dfgdfg', '2018-10-27 00:00:00', '2018-10-26 00:00:00', 'B', 'fgdfgdfg', 'fgdfgdg', 'Solid', 'dfgdfg', 'dfgdfg', 'gffdg', 'dgfdfg', 1, 9, 1, '2018-10-27 13:24:26', '0000-00-00 00:00:00', 1, '::1'),
(9, 'dfgdfg', 'dfgdfg', 'dfgfdg', 'dfgdfg', '2018-10-27 00:00:00', '2018-10-26 00:00:00', 'B', 'fgdfgdfg', 'fgdfgdg', 'Solid', 'dfgdfg', 'dfgdfg', 'gffdg', 'dgfdfg', 1, 9, 1, '2018-10-27 13:24:36', '0000-00-00 00:00:00', 1, '::1'),
(10, 'dfgdfg', 'dfgdfg', 'dfgfdg', 'dfgdfg', '2018-10-27 00:00:00', '2018-10-26 00:00:00', 'B', 'fgdfgdfg', 'fgdfgdg', 'Solid', 'dfgdfg', 'dfgdfg', 'gffdg', 'dgfdfg', 1, 9, 1, '2018-10-27 13:27:30', '0000-00-00 00:00:00', 1, '::1'),
(11, 'dfgdfg', 'dfgdfg', 'dfgfdg', 'dfgdfg', '2018-10-27 00:00:00', '2018-10-26 00:00:00', 'B', 'fgdfgdfg', 'fgdfgdg', 'Solid', 'dfgdfg', 'dfgdfg', 'gffdg', 'dgfdfg', 1, 9, 1, '2018-10-27 13:27:55', '0000-00-00 00:00:00', 1, '::1'),
(12, 'dfgdfg', 'dfgdfg', 'dfgfdg', 'dfgdfg', '2018-10-27 00:00:00', '2018-10-26 00:00:00', 'B', 'fgdfgdfg', 'fgdfgdg', 'Solid', 'dfgdfg', 'dfgdfg', 'gffdg', 'dgfdfg', 1, 9, 1, '2018-10-27 13:46:28', '0000-00-00 00:00:00', 1, '::1'),
(13, 'dfgdfg', 'dfgdfg', 'dfgfdg', 'dfgdfg', '2018-10-27 00:00:00', '2018-10-26 00:00:00', 'B', 'fgdfgdfg', 'fgdfgdg', 'Solid', 'dfgdfg', 'dfgdfg', 'gffdg', 'dgfdfg', 1, 9, 1, '2018-10-27 13:46:54', '0000-00-00 00:00:00', 1, '::1'),
(14, 'dfgdfg', 'dfgdfg', 'dfgfdg', 'dfgdfg', '2018-10-27 00:00:00', '2018-10-26 00:00:00', 'B', 'fgdfgdfg', 'fgdfgdg', 'Solid', 'dfgdfg', 'dfgdfg', 'gffdg', 'dgfdfg', 1, 9, 1, '2018-10-27 13:47:08', '0000-00-00 00:00:00', 1, '::1'),
(15, 'dfgdfg', 'dfgdfg', 'dfgfdg', 'dfgdfg', '2018-10-27 00:00:00', '2018-10-26 00:00:00', 'B', 'fgdfgdfg', 'fgdfgdg', 'Solid', 'dfgdfg', 'dfgdfg', 'gffdg', 'dgfdfg', 1, 9, 1, '2018-10-27 13:47:14', '0000-00-00 00:00:00', 1, '::1'),
(16, 'dfgdfg', 'dfgdfg', 'dfgfdg', 'dfgdfg', '2018-10-27 00:00:00', '2018-10-26 00:00:00', 'B', 'fgdfgdfg', 'fgdfgdg', 'Solid', 'dfgdfg', 'dfgdfg', 'gffdg', 'dgfdfg', 1, 9, 1, '2018-10-27 13:47:24', '0000-00-00 00:00:00', 1, '::1'),
(17, 'dfgdfg', 'dfgdfg', 'dfgfdg', 'dfgdfg', '2018-10-27 00:00:00', '2018-10-26 00:00:00', 'B', 'fgdfgdfg', 'fgdfgdg', 'Solid', 'dfgdfg', 'dfgdfg', 'gffdg', 'dgfdfg', 1, 9, 1, '2018-10-27 13:47:45', '0000-00-00 00:00:00', 1, '::1'),
(18, 'dfgdfg', 'dfgdfg', 'dfgfdg', 'dfgdfg', '2018-10-27 00:00:00', '2018-10-26 00:00:00', 'B', 'fgdfgdfg', 'fgdfgdg', 'Solid', 'dfgdfg', 'dfgdfg', 'gffdg', 'dgfdfg', 1, 9, 1, '2018-10-27 13:48:03', '0000-00-00 00:00:00', 1, '::1'),
(19, 'dfgdfg', 'dfgdfg', 'dfgfdg', 'dfgdfg', '2018-10-27 00:00:00', '2018-10-26 00:00:00', 'B', 'fgdfgdfg', 'fgdfgdg', 'Solid', 'dfgdfg', 'dfgdfg', 'gffdg', 'dgfdfg', 1, 9, 1, '2018-10-27 13:48:14', '0000-00-00 00:00:00', 1, '::1'),
(20, 'dfgdfg', 'dfgdfg', 'dfgfdg', 'dfgdfg', '2018-10-27 00:00:00', '2018-10-26 00:00:00', 'B', 'fgdfgdfg', 'fgdfgdg', 'Solid', 'dfgdfg', 'dfgdfg', 'gffdg', 'dgfdfg', 1, 9, 1, '2018-10-27 13:53:23', '0000-00-00 00:00:00', 1, '::1'),
(21, 'dfgdfg', 'dfgdfg', 'dfgfdg', 'dfgdfg', '2018-10-27 00:00:00', '2018-10-26 00:00:00', 'B', 'fgdfgdfg', 'fgdfgdg', 'Solid', 'dfgdfg', 'dfgdfg', 'gffdg', 'dgfdfg', 1, 9, 1, '2018-10-27 13:53:30', '0000-00-00 00:00:00', 1, '::1'),
(22, 'dfgdfg', 'dfgdfg', 'dfgfdg', 'dfgdfg', '2018-10-27 00:00:00', '2018-10-26 00:00:00', 'B', 'fgdfgdfg', 'fgdfgdg', 'Solid', 'dfgdfg', 'dfgdfg', 'gffdg', 'dgfdfg', 1, 9, 1, '2018-10-27 13:54:07', '0000-00-00 00:00:00', 1, '::1'),
(23, 'dfgdfg', 'dfgdfg', 'dfgfdg', 'dfgdfg', '2018-10-27 00:00:00', '2018-10-26 00:00:00', 'B', 'fgdfgdfg', 'fgdfgdg', 'Solid', 'dfgdfg', 'dfgdfg', 'gffdg', 'dgfdfg', 1, 9, 1, '2018-10-27 13:54:36', '0000-00-00 00:00:00', 1, '::1'),
(24, 'dfgdfg', 'dfgdfg', 'dfgfdg', 'dfgdfg', '2018-10-27 00:00:00', '2018-10-26 00:00:00', 'B', 'fgdfgdfg', 'fgdfgdg', 'Solid', 'dfgdfg', 'dfgdfg', 'gffdg', 'dgfdfg', 1, 9, 1, '2018-10-27 13:55:04', '0000-00-00 00:00:00', 1, '::1'),
(25, 'dfgdfg', 'dfgdfg', 'dfgfdg', 'dfgdfg', '2018-10-27 00:00:00', '2018-10-26 00:00:00', 'B', 'fgdfgdfg', 'fgdfgdg', 'Solid', 'dfgdfg', 'dfgdfg', 'gffdg', 'dgfdfg', 1, 9, 1, '2018-10-27 13:55:19', '0000-00-00 00:00:00', 1, '::1'),
(26, 'dfgdfg', 'dfgdfg', 'dfgfdg', 'dfgdfg', '2018-10-27 00:00:00', '2018-10-26 00:00:00', 'B', 'fgdfgdfg', 'fgdfgdg', 'Solid', 'dfgdfg', 'dfgdfg', 'gffdg', 'dgfdfg', 1, 9, 1, '2018-10-27 13:55:50', '0000-00-00 00:00:00', 1, '::1'),
(27, 'dfgdfg', 'dfgdfg', 'dfgfdg', 'dfgdfg', '2018-10-27 00:00:00', '2018-10-26 00:00:00', 'B', 'fgdfgdfg', 'fgdfgdg', 'Solid', 'dfgdfg', 'dfgdfg', 'gffdg', 'dgfdfg', 1, 9, 1, '2018-10-27 13:56:51', '0000-00-00 00:00:00', 1, '::1'),
(28, 'dfgdfg', 'dfgdfg', 'dfgfdg', 'dfgdfg', '2018-10-27 00:00:00', '2018-10-26 00:00:00', 'B', 'fgdfgdfg', 'fgdfgdg', 'Solid', 'dfgdfg', 'dfgdfg', 'gffdg', 'dgfdfg', 1, 9, 1, '2018-10-27 13:56:59', '0000-00-00 00:00:00', 1, '::1'),
(29, 'dfgdfg', 'dfgdfg', 'dfgfdg', 'dfgdfg', '2018-10-27 00:00:00', '2018-10-26 00:00:00', 'B', 'fgdfgdfg', 'fgdfgdg', 'Solid', 'dfgdfg', 'dfgdfg', 'gffdg', 'dgfdfg', 1, 9, 1, '2018-10-27 13:57:01', '0000-00-00 00:00:00', 1, '::1'),
(30, 'dfgdfg', 'dfgdfg', 'dfgfdg', 'dfgdfg', '2018-10-27 00:00:00', '2018-10-26 00:00:00', 'B', 'fgdfgdfg', 'fgdfgdg', 'Solid', 'dfgdfg', 'dfgdfg', 'gffdg', 'dgfdfg', 1, 9, 1, '2018-10-27 13:57:28', '0000-00-00 00:00:00', 1, '::1'),
(31, 'dfgdfg', 'dfgdfg', 'dfgfdg', 'dfgdfg', '2018-10-27 00:00:00', '2018-10-26 00:00:00', 'B', 'fgdfgdfg', 'fgdfgdg', 'Solid', 'dfgdfg', 'dfgdfg', 'gffdg', 'dgfdfg', 1, 9, 1, '2018-10-27 13:57:47', '0000-00-00 00:00:00', 1, '::1'),
(32, 'dfgdfg', 'dfgdfg', 'dfgfdg', 'dfgdfg', '2018-10-27 00:00:00', '2018-10-26 00:00:00', 'B', 'fgdfgdfg', 'fgdfgdg', 'Solid', 'dfgdfg', 'dfgdfg', 'gffdg', 'dgfdfg', 1, 9, 1, '2018-10-27 13:58:00', '0000-00-00 00:00:00', 1, '::1'),
(33, 'dfgdfg', 'dfgdfg', 'dfgfdg', 'dfgdfg', '2018-10-27 00:00:00', '2018-10-26 00:00:00', 'B', 'fgdfgdfg', 'fgdfgdg', 'Solid', 'dfgdfg', 'dfgdfg', 'gffdg', 'dgfdfg', 1, 9, 1, '2018-10-27 13:58:23', '0000-00-00 00:00:00', 1, '::1'),
(34, 'dfgdfg', 'dfgdfg', 'dfgfdg', 'dfgdfg', '2018-10-27 00:00:00', '2018-10-26 00:00:00', 'B', 'fgdfgdfg', 'fgdfgdg', 'Solid', 'dfgdfg', '500', 'gffdg', 'dgfdfg', 1, 9, 1, '2018-10-27 13:58:36', '0000-00-00 00:00:00', 1, '::1'),
(35, 'dsfsdfsf', 'dfgdfg', 'dfgfdg', 'dfgdfg', '2018-10-27 00:00:00', '2018-10-26 00:00:00', 'C', 'CSF', 'fgdfgdg', 'Solid', 'dfgdfg', '500', 'gffdg', 'dgfdfg', 1, 1, 1, '2018-10-27 19:59:52', '0000-00-00 00:00:00', 1, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) NOT NULL,
  `dept_name` varchar(255) NOT NULL,
  `dept_short_name` varchar(50) NOT NULL,
  `dept_place` varchar(255) NOT NULL,
  `dept_desc` text NOT NULL,
  `added_date` datetime NOT NULL,
  `status` tinyint(2) NOT NULL,
  `ip_address` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `dept_name`, `dept_short_name`, `dept_place`, `dept_desc`, `added_date`, `status`, `ip_address`) VALUES
(1, 'Biology', 'BIOL', 'Science', 'Biology Depatment', '2018-10-10 21:55:52', 1, '::1'),
(2, 'dfgdfgdfgdfg', 'dfgfdgfgd', 'dfgdfdfgfdg', 'gdfggdfgdg', '2018-11-08 07:42:29', 1, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `log_id` int(10) NOT NULL,
  `log_chem_id` int(10) NOT NULL,
  `log_new_value` varchar(100) NOT NULL,
  `log_prev_value` varchar(100) NOT NULL,
  `log_added_date` datetime NOT NULL,
  `log_type` int(2) NOT NULL COMMENT '1= checkin; 2=check out',
  `log_added_user_id` int(10) NOT NULL,
  `log_ip_address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`log_id`, `log_chem_id`, `log_new_value`, `log_prev_value`, `log_added_date`, `log_type`, `log_added_user_id`, `log_ip_address`) VALUES
(1, 35, '111', 'CSF', '2018-10-28 10:00:04', 2, 1, '::1'),
(2, 35, '111', 'CSF', '2018-10-28 10:00:19', 2, 1, '::1'),
(3, 35, '222', 'CSF', '2018-10-28 10:01:26', 2, 1, '::1'),
(4, 35, '333', 'CSF', '2018-10-28 10:02:10', 2, 1, '::1'),
(5, 35, '333', 'CSF', '2018-10-28 10:11:41', 2, 1, '::1'),
(6, 35, '555', 'CSF', '2018-10-28 10:12:12', 2, 1, '::1'),
(7, 35, '1115', 'CSF', '2018-10-28 11:03:46', 2, 1, '::1'),
(8, 35, '11152', 'CSF', '2018-10-28 11:08:50', 2, 1, '::1'),
(9, 35, '11152', 'CSF', '2018-10-28 11:10:56', 2, 1, '::1'),
(10, 2, '1', 'fgdfgdfg', '2018-10-28 11:12:10', 2, 1, '::1'),
(11, 35, '222', 'CSF', '2018-10-28 11:35:50', 1, 1, '::1'),
(12, 35, '242', 'CSF', '2018-10-28 11:36:44', 1, 1, '::1'),
(13, 2, '222', 'fgdfgdfg', '2018-10-28 12:09:59', 1, 1, '::1'),
(14, 2, '12', 'fgdfgdfg', '2018-11-08 08:13:43', 1, 1, '::1'),
(15, 2, '123', 'fgdfgdfg', '2018-12-01 17:20:14', 1, 1, '::1'),
(16, 2, '99', 'fgdfgdfg', '2018-12-01 17:34:39', 2, 1, '::1'),
(17, 2, '234', 'fgdfgdfg', '2018-12-01 17:46:59', 2, 1, '::1'),
(18, 2, '456', 'fgdfgdfg', '2018-12-01 17:56:00', 2, 1, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `role_type` tinyint(2) NOT NULL COMMENT '1 = administrator; 2 = dep admin; 3 = researcher; 4 = student',
  `department_id` tinyint(3) NOT NULL,
  `added_by` int(5) NOT NULL,
  `ip_address` varchar(150) NOT NULL,
  `added_date` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `status` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `email`, `role_type`, `department_id`, `added_by`, `ip_address`, `added_date`, `last_login`, `status`) VALUES
(1, 'Admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'harsh.gandhi01@hotmail.com', 1, 1, 0, '127.0.0.1', '2018-10-11 00:00:00', '2018-12-01 16:47:24', 1),
(7, 'Testing', 'testing', '21232f297a57a5a743894a0e4a801fc3', 'testing@testing.com', 1, 1, 0, '::1', '2018-10-10 22:11:24', '2018-11-30 17:06:27', 1),
(8, 'testinguser', 'testinguser', '21232f297a57a5a743894a0e4a801fc3', 'testinguser@gmail.com', 2, 2, 0, '::1', '2018-10-25 16:55:15', '2018-11-30 17:07:34', 1),
(9, 'testinguser', 'testinguser', '17bf5ab74b15df948dcdfe6265c82b63', 'testinguser@gmail.com', 2, 2, 0, '::1', '2018-10-25 16:55:15', '0000-00-00 00:00:00', 1),
(10, 'a', 'aa', '21232f297a57a5a743894a0e4a801fc3', 'aa@aa.com', 4, 1, 8, '::1', '2018-11-09 17:09:18', '2018-11-30 17:05:55', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chemicals`
--
ALTER TABLE `chemicals`
  ADD PRIMARY KEY (`chem_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chemicals`
--
ALTER TABLE `chemicals`
  MODIFY `chem_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `log_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
