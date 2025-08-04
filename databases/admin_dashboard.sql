-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2024 at 06:00 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_dashboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `Recordid` int(11) NOT NULL,
  `Tittle` varchar(255) NOT NULL,
  `Classs` varchar(255) NOT NULL,
  `Subject` varchar(225) NOT NULL,
  `Teachername` varchar(250) NOT NULL,
  `Questions` longtext NOT NULL,
  `Choice` longtext NOT NULL,
  `Answer` longtext NOT NULL,
  `Quesnum` int(255) NOT NULL,
  `Pointpernum` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`Recordid`, `Tittle`, `Classs`, `Subject`, `Teachername`, `Questions`, `Choice`, `Answer`, `Quesnum`, `Pointpernum`) VALUES
(1, 'sample 1', 'BSBA 1-A', 'MKTG P102 BACC - 401', 'Shaina Lou Quiambao', 'Question 1: y || Question 2: u || ', 'y || y || y || y || u || u || u || u || ', 'b || c || ', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `class_name` varchar(100) NOT NULL,
  `department` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `class_name`, `department`) VALUES
(1, 'BSIT 1-A', 'College of Computing Studies'),
(2, 'BEED 1-A', 'College of Education'),
(3, 'BSBA 1-A', 'College of Business Studies'),
(4, 'BSSW 1-A', 'College of Social Science and Philisophy');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `department_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`, `description`) VALUES
(1, 'College of Computing Studies', 'BSIT'),
(2, 'College of Education', 'BEED'),
(3, 'College of Business Studies', 'BSBA'),
(4, 'College of Social Science and Philisophy', 'BSSW');

-- --------------------------------------------------------

--
-- Table structure for table `facultys`
--

CREATE TABLE `facultys` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `code` int(11) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `contact_no` bigint(11) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `qualification` varchar(100) NOT NULL,
  `emergency_person` varchar(50) DEFAULT NULL,
  `emergency_num` bigint(11) DEFAULT NULL,
  `department` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `picture` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facultys`
--

INSERT INTO `facultys` (`id`, `employee_id`, `password`, `fullname`, `code`, `address`, `contact_no`, `gender`, `qualification`, `emergency_person`, `emergency_num`, `department`, `class`, `subject`, `picture`) VALUES
(1, '2020789', '11111', 'John Paul Baluyut', 99987755, 'Porac, Pampangahbrhrgg', 9785632032, 'Male', 'Bachelor Holder', 'Hernan Pillone2', 9785632145, 'College of Computing Studies', 'BSIT 1-A,BEED 1-A', 'TECH ELEM 123,CC 113(A)', '9af5132028f1e051ce127d074056ff77.jpg'),
(2, '2024894', 'dhvsuporac@instructor111', 'Emman Tubera', 0, 'Pio Highway, Porac, Pampanga', 9785412589, 'Male', 'Licensed Teacher', 'Yaoshar Buhian', 9785412563, 'College of Education', 'BEED 1-A,BSBA 1-A', 'TECH ELEM 123', '8888e60cc1f0db083bf5841286c9771b.jpg'),
(3, '2024945', 'dhvsuporac@instructor111', 'Shaina Lou Quiambao', NULL, 'Carencita, Floridablanca, Pampanga', 9780507850, 'Female', 'Bachelor Degree Holder', 'Marivic Solares', 9785412563, 'College of Business Studies', 'BSBA 1-A', 'MKTG P102 BACC - 401', ''),
(4, '20237896', 'dhvsuporac@instructor111', 'Katrisha Augusto', NULL, 'Palmayo, FLoridablanca, Pampanga', 9785263102, 'Female', 'Bachelor Degree Holder', 'Andrean Lumanlan', 9785412563, 'College of Social Science and Philisophy', 'BSSW 1-A', 'SW C14', '');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `filename` varchar(200) NOT NULL,
  `filesize` int(11) NOT NULL,
  `filetype` varchar(100) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `code` varchar(50) NOT NULL,
  `class_name` varchar(50) NOT NULL,
  `teachername` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `filename`, `filesize`, `filetype`, `upload_date`, `code`, `class_name`, `teachername`) VALUES
(82, 'Marivic Solares (1) (2).pdf', 17724, 'application/pdf', '2024-05-04 03:49:54', 'BEED 1-A dhvsu@111', 'BEED 1-A', ''),
(84, 'Marivic Solares (1) (2) (1).pdf', 17724, 'application/pdf', '2024-05-04 04:30:04', 'BEED 1-A dhvsu@111', 'BEED 1-A', ''),
(85, 'Marivic Solares (1) (2).pdf', 17724, 'application/pdf', '2024-05-04 04:40:42', 'BSBA 1-A dhvsu@111', 'BSBA 1-A', ''),
(86, 'Marivic Solares (1) (2).pdf', 17724, 'application/pdf', '2024-05-04 04:40:56', 'BSSW 1-A dhvsu@111', 'BSSW 1-A', ''),
(87, 'Marivic Solares (1) (2).pdf', 17724, 'application/pdf', '2024-05-04 05:51:57', 'BSIT 1-A dhvsu@111', 'BSIT 1-A', ''),
(88, 'LearningManagementSystemLMSSuccess (1).pdf', 457267, 'application/pdf', '2024-05-05 03:41:39', 'BSBA 1-A dhvsu@111', 'BSBA 1-A', ''),
(89, 'documentations.pdf', 160025, 'application/pdf', '2024-05-05 03:42:04', 'BEED 1-A dhvsu@111', 'BEED 1-A', ''),
(90, 'ERD-2.pdf', 561774, 'application/pdf', '2024-05-09 13:10:03', 'BSIT 1-A dhvsu@111', 'BSIT 1-A', 'John Paul Baluyut');

-- --------------------------------------------------------

--
-- Table structure for table `major`
--

CREATE TABLE `major` (
  `recordid` int(11) NOT NULL,
  `tittle` varchar(255) NOT NULL,
  `classs` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `teachername` varchar(255) NOT NULL,
  `questions` longtext NOT NULL,
  `choice` longtext NOT NULL,
  `answer` longtext NOT NULL,
  `quesnum` int(255) NOT NULL,
  `pointpernum` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `major`
--

INSERT INTO `major` (`recordid`, `tittle`, `classs`, `subject`, `teachername`, `questions`, `choice`, `answer`, `quesnum`, `pointpernum`) VALUES
(4, 'sample1', 'BSBA 1-A', 'MKTG P102 BACC - 401', 'Shaina Lou Quiambao', 'Question 1: w || Question 2: w || ', 'w || w || w || w || w || w || w || w || ', 'a || b || ', 2, 1),
(5, 'sample2', 'BSBA 1-A', 'MKTG P102 BACC - 401', 'Shaina Lou Quiambao', 'Question 1: t || Question 2: t || Question 3: t || ', 't || t || t || t || t || t || t || t || t || t || t || t || ', 'b || c || d || ', 3, 1),
(6, 'sample5', 'BSBA 1-A', 'MKTG P102 BACC - 401', 'Shaina Lou Quiambao', 'Question 1: p || Question 2: p || ', 'p || p || p || p || p || p || p || p || ', 'b || a || ', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `Student_id` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_no` bigint(11) NOT NULL,
  `classs` varchar(20) NOT NULL,
  `department` varchar(100) NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `contact_num` bigint(11) NOT NULL,
  `contact_address` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `examscores` longtext NOT NULL,
  `quizscores` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `full_name`, `Student_id`, `password`, `code`, `address`, `contact_no`, `classs`, `department`, `contact_person`, `contact_num`, `contact_address`, `picture`, `examscores`, `quizscores`) VALUES
(1, 'Andrean Lumanlan', '2022456378', '789', 123456, 'Hacienda, Porac, Pampanga', 9785632145, 'BSSW 1-A', 'College of Social Science and Philisophy', 'Emman Tubera', 9785632145, 'Pio Highway, Porac, Pampanga', '', '', ''),
(2, 'Marivic Solares', '2022301646', 'mrvcslrs24', 924003, 'Consuelo, Floridablanca, Pampanga', 9874523601, 'BSBA 1-A', 'College of Business Studies', 'Homer Solares', 9547825631, 'Consuelo, Floridablanca, Pampanga', 'img20230130_20163617.jpg', '0002 sample1 - MKTG P102 BACC - 401 || 0002 sample2 - MKTG P102 BACC - 401 || 0001 sample5 - MKTG P102 BACC - 401 || ', '0001 sample 1 - MKTG P102 BACC - 401 || '),
(3, 'Evangelion Bueno', '2022458695', 'dhvsu111', 0, 'Babo Sacan, Porac, Pampanga', 9785412563, 'BEED 1-A', 'College of Education', 'Andrean Lumanlan', 9785412563, 'Hacienda, Porac, Pampanga', '', '', ''),
(4, 'Kristine Ramos', '2022457896', 'dhvsu111', 0, 'Palmayo, Floridablanca, Pampanga', 9785632145, 'BSIT 1-A', 'College of Computing Studies', 'Evangelion Bueno', 9856321458, 'Babo Sacan, Porac, Pampanga', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subject_code` varchar(150) NOT NULL,
  `description` varchar(150) NOT NULL,
  `department_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_code`, `description`, `department_name`) VALUES
(1, 'TECH ELEM 123', 'COLLEGE OF EDUCATION', 'Teaching Music in the Elementary Grades'),
(2, 'CC 113(A)', 'COLLEGE OF COMPUTING STUDIES', 'Introduction to Computing'),
(3, 'SW C14', 'COLLEGE OF SOCIAL SCIENCES AND PHILOSOPHY', 'Fields of Social Work'),
(4, 'MKTG P102 BACC - 401', 'COLLEGE OF BUSINESS STUDIES', 'Human Resources Management');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_events`
--

CREATE TABLE `tbl_events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `start` date NOT NULL,
  `end` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_events`
--

INSERT INTO `tbl_events` (`id`, `title`, `start`, `end`) VALUES
(5, 'g', '2024-05-05', '2024-05-06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `code` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `code`) VALUES
(1, 'admin', 'pass321', 924003);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`Recordid`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facultys`
--
ALTER TABLE `facultys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `major`
--
ALTER TABLE `major`
  ADD PRIMARY KEY (`recordid`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_events`
--
ALTER TABLE `tbl_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `Recordid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `facultys`
--
ALTER TABLE `facultys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `major`
--
ALTER TABLE `major`
  MODIFY `recordid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_events`
--
ALTER TABLE `tbl_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
