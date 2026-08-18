-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2025 at 07:52 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `timetable`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_name` varchar(2500) NOT NULL,
  `course_code` varchar(250) NOT NULL,
  `level` varchar(250) NOT NULL,
  `exam_type` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `course_code`, `level`, `exam_type`) VALUES
(1, 'COMPUTER PROGRAMMING', 'CMP 201', '200', 'CBT'),
(2, 'COMPUTER PROGRAMMING', 'CMP 202', '100', 'CBT'),
(3, 'PROGRAMMING', 'CMP 203', '200', 'CBT'),
(4, 'HARDWARE', 'CMP 218', '100', 'CBT');

-- --------------------------------------------------------

--
-- Table structure for table `generated_timetable`
--

CREATE TABLE `generated_timetable` (
  `id` int(11) NOT NULL,
  `timetable_id` int(11) NOT NULL,
  `course_id` varchar(250) NOT NULL,
  `venue` varchar(250) NOT NULL,
  `invigilators` varchar(250) NOT NULL,
  `date` varchar(250) NOT NULL,
  `time` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `generated_timetable`
--

INSERT INTO `generated_timetable` (`id`, `timetable_id`, `course_id`, `venue`, `invigilators`, `date`, `time`) VALUES
(14, 1145479831, '1', 'NCC', 'tambuwal profaminu abdulkarim ', '12/12/2003', ''),
(15, 1145479831, '2', 'NCC', 'tambuwal profaminu abdulkarim ', 'Not Specify', ''),
(16, 1145479831, '4', 'NCC', 'tambuwal profaminu abdulkarim ', 'Not Specify', ''),
(17, 1145479831, '3', 'NCC', 'tambuwal profaminu abdulkarim ', 'Not Specify', '');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `message` varchar(2500) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `message`, `time`) VALUES
(7, 'Timetable Updated COMPUTER PROGRAMMING(CMP 201) will take place on 12/12/2003, invigilators include: tambuwal profaminu abdulkarim ', '2025-01-13 13:17:17'),
(8, 'Timetable Updated COMPUTER PROGRAMMING(CMP 201) will take place on 12/12/2003, invigilators include: tambuwal profaminu abdulkarim ', '2025-01-13 18:03:49'),
(9, 'All UG4 Student', '2025-01-13 18:32:17');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `message` varchar(2500) NOT NULL,
  `reply` varchar(2500) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `message`, `reply`, `user_id`, `time`) VALUES
(1, 'Assalamu alaikum', 'No reply', 3, '2025-01-13 18:36:14'),
(2, 'Assalamu alaikum', 'No reply', 3, '2025-01-13 18:35:38');

-- --------------------------------------------------------

--
-- Table structure for table `timetables`
--

CREATE TABLE `timetables` (
  `id` int(11) NOT NULL,
  `timetable_id` varchar(250) NOT NULL,
  `timetable_name` varchar(2500) NOT NULL,
  `session_name` varchar(2500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `timetables`
--

INSERT INTO `timetables` (`id`, `timetable_id`, `timetable_name`, `session_name`) VALUES
(8, '1145479831', 'FIRST TERM EXAM', '2023/2024');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(2500) NOT NULL,
  `email` varchar(250) NOT NULL,
  `role` varchar(250) NOT NULL,
  `rank` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `email`, `role`, `rank`) VALUES
(1, 'admin', 'admin', '12345', 'admin@gmail.com', 'admin', ''),
(3, 'Zakiyya Ahmad', '1982727266', '12345', 'zakiyya@gmail.com', 'student', ''),
(4, 'DR ABDULKARIM', 'abdulkarim', '12345', 'abdulkarim@gmail.com', 'staff', 'Staff'),
(5, 'DR TAMBUWAL', 'tambuwal', '12345', 'tambuwal@gmail.com', 'staff', 'Exam Officer'),
(6, 'PROF AMINU MUHAMMAD', 'profaminu', '12345', 'profaminu@gmail.com', 'staff', 'DEAN'),
(7, 'DR HABIBA SANI', 'habiba', '12345', 'habiba@gmail.com', 'staff', 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE `venues` (
  `id` int(11) NOT NULL,
  `hall_name` varchar(250) NOT NULL,
  `exam_type` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `venues`
--

INSERT INTO `venues` (`id`, `hall_name`, `exam_type`, `status`) VALUES
(1, 'NCC', 'CBT', 'available');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `generated_timetable`
--
ALTER TABLE `generated_timetable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timetables`
--
ALTER TABLE `timetables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venues`
--
ALTER TABLE `venues`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `generated_timetable`
--
ALTER TABLE `generated_timetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `timetables`
--
ALTER TABLE `timetables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `venues`
--
ALTER TABLE `venues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
