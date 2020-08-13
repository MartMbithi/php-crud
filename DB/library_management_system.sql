-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 13, 2020 at 09:16 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `admin_id` int(20) NOT NULL,
  `admin_username` varchar(200) NOT NULL,
  `admin_number` varchar(200) NOT NULL,
  `admin_email` varchar(200) NOT NULL,
  `admin_profile_pic` varchar(200) NOT NULL,
  `admin_bio` varchar(200) NOT NULL,
  `admin_phone_number` varchar(200) NOT NULL,
  `admin_login_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(20) NOT NULL,
  `book_category_id` int(20) NOT NULL,
  `book_title` varchar(200) NOT NULL,
  `book_author` varchar(200) NOT NULL,
  `book_isbn_no` varchar(200) NOT NULL,
  `book_publisher` varchar(200) NOT NULL,
  `book_coverimage` varchar(200) NOT NULL,
  `book_status` varchar(200) NOT NULL,
  `book_summary` longtext NOT NULL,
  `book_copies` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `book_categories`
--

CREATE TABLE `book_categories` (
  `category_id` int(20) NOT NULL,
  `category_code` varchar(200) NOT NULL,
  `category_name` varchar(200) NOT NULL,
  `category_description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `charges`
--

CREATE TABLE `charges` (
  `charge_id` int(20) NOT NULL,
  `charge_name` varchar(200) NOT NULL,
  `charge_desc` longtext NOT NULL,
  `charge_amount` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `librarians`
--

CREATE TABLE `librarians` (
  `librarian_id` int(20) NOT NULL,
  `librarian_name` varchar(200) NOT NULL,
  `librarian_number` varchar(200) NOT NULL,
  `librarian_email` varchar(200) NOT NULL,
  `librarian_phone_number` varchar(200) NOT NULL,
  `librarian_address` longtext NOT NULL,
  `librarian_profile_picture` varchar(200) NOT NULL,
  `librarian_account_status` varchar(200) NOT NULL,
  `librarian_login_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `library_operations`
--

CREATE TABLE `library_operations` (
  `operation_id` int(20) NOT NULL,
  `operation_number` varchar(200) NOT NULL,
  `operation_checksum` varchar(200) NOT NULL,
  `operation_type` varchar(200) NOT NULL,
  `operation_desc` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` int(20) NOT NULL,
  `login_user_name` varchar(200) NOT NULL,
  `login_password` varchar(200) NOT NULL,
  `login_user_permission` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `operation_charges`
--

CREATE TABLE `operation_charges` (
  `operation_charge_id` int(11) NOT NULL,
  `operation_charge_charge_id` int(11) NOT NULL,
  `operation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(20) NOT NULL,
  `student_name` varchar(200) NOT NULL,
  `student_reg_number` varchar(200) NOT NULL,
  `student_email` varchar(200) NOT NULL,
  `student_gender` varchar(200) NOT NULL,
  `student_phone_number` varchar(200) NOT NULL,
  `student_bio` varchar(200) NOT NULL,
  `student_address` varchar(200) NOT NULL,
  `student_profile_picture` varchar(200) NOT NULL,
  `student_account_status` varchar(200) NOT NULL,
  `student_login_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_operations`
--

CREATE TABLE `student_operations` (
  `student_operation_id` int(20) NOT NULL,
  `student_operation_student_id` int(20) NOT NULL,
  `student_operation_librarian_id` int(20) NOT NULL,
  `student_operation_book_id` int(20) NOT NULL,
  `student_operation_operation_id` int(20) NOT NULL,
  `student_operation_start_date` varchar(200) NOT NULL,
  `student_operation_end_date` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `book_category_id` (`book_category_id`);

--
-- Indexes for table `book_categories`
--
ALTER TABLE `book_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `charges`
--
ALTER TABLE `charges`
  ADD PRIMARY KEY (`charge_id`);

--
-- Indexes for table `librarians`
--
ALTER TABLE `librarians`
  ADD PRIMARY KEY (`librarian_id`);

--
-- Indexes for table `library_operations`
--
ALTER TABLE `library_operations`
  ADD PRIMARY KEY (`operation_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `operation_charges`
--
ALTER TABLE `operation_charges`
  ADD PRIMARY KEY (`operation_charge_id`),
  ADD KEY `operation_charge_charge_id` (`operation_charge_charge_id`,`operation`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `student_operations`
--
ALTER TABLE `student_operations`
  ADD PRIMARY KEY (`student_operation_id`),
  ADD KEY `student_operation_student_id` (`student_operation_student_id`),
  ADD KEY `student_operation_librarian_id` (`student_operation_librarian_id`),
  ADD KEY `student_operation_book_id` (`student_operation_book_id`),
  ADD KEY `student_operation_operation_id` (`student_operation_operation_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `admin_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `book_categories`
--
ALTER TABLE `book_categories`
  MODIFY `category_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `charges`
--
ALTER TABLE `charges`
  MODIFY `charge_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `librarians`
--
ALTER TABLE `librarians`
  MODIFY `librarian_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `library_operations`
--
ALTER TABLE `library_operations`
  MODIFY `operation_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `operation_charges`
--
ALTER TABLE `operation_charges`
  MODIFY `operation_charge_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_operations`
--
ALTER TABLE `student_operations`
  MODIFY `student_operation_id` int(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
