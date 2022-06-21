-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2022 at 02:42 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `enquiry_tbl`
--

CREATE TABLE `enquiry_tbl` (
  `sno` int(11) NOT NULL,
  `name_of_enquiry` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `enquired_on` date NOT NULL,
  `enquired_time` time NOT NULL,
  `added_by` varchar(255) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `task_tbl`
--

CREATE TABLE `task_tbl` (
  `sno` int(11) NOT NULL,
  `task_title` varchar(255) NOT NULL,
  `task_desc` longtext NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `added_by` varchar(255) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users_tbl`
--

CREATE TABLE `users_tbl` (
  `sno` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `link_password` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `can_add_user` tinyint(2) NOT NULL,
  `can_view_user` tinyint(2) NOT NULL,
  `can_update_user` tinyint(2) NOT NULL,
  `can_delete_user` tinyint(2) NOT NULL,
  `can_add_enquiry` tinyint(2) NOT NULL,
  `can_view_enquiry` tinyint(2) NOT NULL,
  `can_delete_enquiry` tinyint(2) NOT NULL,
  `can_add_task` tinyint(2) NOT NULL,
  `can_view_task` tinyint(2) NOT NULL,
  `can_update_task` tinyint(2) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` varchar(255) NOT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_tbl`
--

INSERT INTO `users_tbl` (`sno`, `username`, `email_id`, `password`, `link_password`, `contact_number`, `date_of_birth`, `gender`, `can_add_user`, `can_view_user`, `can_update_user`, `can_delete_user`, `can_add_enquiry`, `can_view_enquiry`, `can_delete_enquiry`, `can_add_task`, `can_view_task`, `can_update_task`, `status`, `added_on`, `added_by`, `updated_by`, `updated_on`) VALUES
(1, 'Admin', 'admin@admin.com', 'e6e061838856bf47e1de730719fb2609', '', '9876543210', '2022-06-21', 'Female', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2022-06-21 12:42:11', 'admin@admin.com', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `enquiry_tbl`
--
ALTER TABLE `enquiry_tbl`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `task_tbl`
--
ALTER TABLE `task_tbl`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `users_tbl`
--
ALTER TABLE `users_tbl`
  ADD PRIMARY KEY (`sno`),
  ADD UNIQUE KEY `email_id` (`email_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `enquiry_tbl`
--
ALTER TABLE `enquiry_tbl`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task_tbl`
--
ALTER TABLE `task_tbl`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_tbl`
--
ALTER TABLE `users_tbl`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
