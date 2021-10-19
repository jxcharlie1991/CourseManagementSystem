-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 19, 2021 at 11:50 PM
-- Server version: 5.5.68-MariaDB
-- PHP Version: 7.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chail`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignmentavailable`
--

CREATE TABLE IF NOT EXISTS `assignmentavailable` (
  `staff_id` int(11) NOT NULL,
  `unavailable_start_date` date DEFAULT NULL,
  `unavailable_end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignmentavailable`
--

INSERT INTO `assignmentavailable` (`staff_id`, `unavailable_start_date`, `unavailable_end_date`) VALUES
(202002, '2020-05-20', '2020-05-22'),
(202011, '2020-06-11', '2020-06-13');

-- --------------------------------------------------------

--
-- Table structure for table `assignmentconsultation`
--

CREATE TABLE IF NOT EXISTS `assignmentconsultation` (
  `consultation_id` int(11) NOT NULL,
  `unit_code` varchar(32) NOT NULL,
  `start_week` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `duration` int(11) NOT NULL,
  `location` varchar(64) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignmentconsultation`
--

INSERT INTO `assignmentconsultation` (`consultation_id`, `unit_code`, `start_week`, `start_time`, `duration`, `location`) VALUES
(1, 'KIT502', 5, '15:00:00', 2, '21'),
(30, 'KIT502', 1, '00:00:00', 4, '302'),
(36, 'KIT506', 2, '12:00:00', 1, '202'),
(37, 'KIT707', 4, '14:00:00', 2, '205'),
(38, 'KIT709', 1, '10:00:00', 1, '109');

-- --------------------------------------------------------

--
-- Table structure for table `assignmentenrolment`
--

CREATE TABLE IF NOT EXISTS `assignmentenrolment` (
  `enrol_id` int(11) NOT NULL,
  `student_id` int(32) NOT NULL,
  `unit_code` varchar(64) NOT NULL,
  `timetable_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignmentenrolment`
--

INSERT INTO `assignmentenrolment` (`enrol_id`, `student_id`, `unit_code`, `timetable_id`) VALUES
(88, 100001, 'KIT707', 4),
(89, 100001, 'KIT709', 5),
(98, 100002, 'KIT502', 1),
(99, 100002, 'KIT506', 3),
(100, 100002, 'KIT707', 4),
(101, 100002, 'KIT709', 5),
(102, 100003, 'KIT502', 1),
(103, 100003, 'KIT506', 3),
(104, 100003, 'KIT707', 4),
(105, 100003, 'KIT709', 5),
(107, 100004, 'KIT506', 3),
(108, 100004, 'KIT707', 4),
(109, 100004, 'KIT709', 5),
(110, 100004, 'KIT502', 1),
(111, 100005, 'KIT502', 1),
(112, 100005, 'KIT506', 34),
(113, 100005, 'KIT707', 39),
(114, 100005, 'KIT709', 41),
(119, 100006, 'KIT502', 0),
(120, 100006, 'KIT506', 0),
(121, 100006, 'KIT707', 0),
(122, 100006, 'KIT709', 0),
(123, 100008, 'KIT502', 2),
(124, 100008, 'KIT506', 3),
(125, 100008, 'KIT707', 38),
(126, 100008, 'KIT709', 41),
(127, 100009, 'KIT502', 2),
(129, 100001, 'KIT502', 1),
(134, 123456, 'KIT502', 2),
(135, 123456, 'KIT506', 34),
(136, 123456, 'KIT707', 0),
(138, 654321, 'KIT502', 2);

-- --------------------------------------------------------

--
-- Table structure for table `assignmentimetable`
--

CREATE TABLE IF NOT EXISTS `assignmentimetable` (
  `timetable_id` int(11) NOT NULL,
  `unit_code` varchar(32) NOT NULL,
  `tutor_id` int(11) DEFAULT NULL,
  `tutor` varchar(64) NOT NULL,
  `start_week` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `duration` int(11) NOT NULL,
  `location` varchar(64) DEFAULT NULL,
  `max_student` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignmentimetable`
--

INSERT INTO `assignmentimetable` (`timetable_id`, `unit_code`, `tutor_id`, `tutor`, `start_week`, `start_time`, `duration`, `location`, `max_student`) VALUES
(1, 'KIT502', 202005, 'John', 1, '09:00:00', 2, '202', 5),
(2, 'KIT502', 202003, 'Mutaz Barika', 2, '13:00:00', 2, '109', 10),
(3, 'KIT506', 202002, 'Riseul Ryu', 2, '15:00:00', 2, '201', 15),
(4, 'KIT707', 202005, 'John', 3, '09:00:00', 1, '402', 5),
(5, 'KIT709', 202004, 'Dominic Duke', 4, '13:30:00', 1, '422', 15),
(29, 'KIT502', 202006, 'Robert', 3, '09:00:00', 1, '303', 5),
(30, 'KIT502', 202006, 'Robert', 3, '15:00:00', 1, '201', 5),
(31, 'KIT502', 202007, 'Michael', 4, '14:00:00', 1, '301', 5),
(32, 'KIT502', 202008, 'William', 5, '15:00:00', 1, '213', 5),
(33, 'KIT502', 202009, 'David', 1, '15:00:00', 1, '102', 5),
(34, 'KIT506', 202005, 'John', 4, '16:00:00', 1, '221', 5),
(35, 'KIT506', 202006, 'Robert', 1, '13:00:00', 1, '232', 5),
(36, 'KIT506', 202007, 'Michael', 2, '09:00:00', 1, '206', 10),
(37, 'KIT506', 202008, 'William', 3, '11:00:00', 1, '182', 5),
(38, 'KIT707', 202005, 'John', 4, '15:00:00', 1, '304', 5),
(39, 'KIT707', 202005, 'John', 1, '10:00:00', 1, '299', 5),
(40, 'KIT707', 202006, 'Robert', 5, '05:00:00', 1, '283', 5),
(41, 'KIT709', 202010, 'Richard', 4, '16:00:00', 1, '220', 5),
(42, 'KIT709', 202013, 'Charles', 1, '13:00:00', 1, '320', 5),
(48, 'KIT502', NULL, '', 0, '00:00:00', 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `assignmentstaff`
--

CREATE TABLE IF NOT EXISTS `assignmentstaff` (
  `staff_id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(128) NOT NULL,
  `qualification` varchar(64) NOT NULL,
  `expertise` varchar(64) NOT NULL,
  `phone` int(11) NOT NULL,
  `level` varchar(64) NOT NULL,
  `lecturer` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignmentstaff`
--

INSERT INTO `assignmentstaff` (`staff_id`, `password`, `name`, `email`, `qualification`, `expertise`, `phone`, `level`, `lecturer`) VALUES
(202001, '$1$9hSx.sTD$L4zH01ujNDEX8Oya1eI3N/', 'Kai Chiu Wong', 'Kai Chiu Wong@utas.edu.au', 'PHD', 'Information Systems', 12345678, 'DC', 0),
(202002, '$1$9hSx.sTD$L4zH01ujNDEX8Oya1eI3N/', 'Riseul Ryu', 'Riseul Ryu@utas.edu.au', 'PHD', 'Information Systems', 560051869, 'UC', 1),
(202003, '$1$9hSx.sTD$L4zH01ujNDEX8Oya1eI3N/', 'Mutaz Barika', 'Mutaz Barika@utas.edu.au', 'PHD', 'Information Systems', 442261958, 'UC', 1),
(202004, '$1$9hSx.sTD$L4zH01ujNDEX8Oya1eI3N/', 'Dominic Duke', 'Dominic Duke@utas.edu.au', 'PHD', 'Human Computer Interaction', 365843683, 'UC', 1),
(202005, '$1$9hSx.sTD$L4zH01ujNDEX8Oya1eI3N/', 'John', 'John@utas.edu.au', 'Master', 'Network Administration', 548812112, '', 1),
(202006, '$1$9hSx.sTD$L4zH01ujNDEX8Oya1eI3N/', 'Robert', 'Robert@utas.edu.au', 'Master', 'Information Systems', 789129818, '', 0),
(202007, '$1$9hSx.sTD$L4zH01ujNDEX8Oya1eI3N/', 'Michael', 'Michael@utas.edu.au', 'PHD', 'Human Computer Interaction', 330787732, '', 1),
(202008, '$1$9hSx.sTD$L4zH01ujNDEX8Oya1eI3N/', 'William', 'William@utas.edu.au', 'PHD', 'Network Administration', 689746548, '', 0),
(202009, '$1$9hSx.sTD$L4zH01ujNDEX8Oya1eI3N/', 'David', 'David@utas.edu.au', 'Master', 'Information Systems', 315301478, '', 0),
(202010, '$1$9hSx.sTD$L4zH01ujNDEX8Oya1eI3N/', 'Richard', 'Richard@utas.edu.au', 'Master', 'Human Computer Interaction', 807017407, '', 0),
(202011, '$1$9hSx.sTD$L4zH01ujNDEX8Oya1eI3N/', 'Joseph', 'Joseph@utas.edu.au', 'Bachelor', 'Network Administration', 660553530, '', 0),
(202012, '$1$9hSx.sTD$L4zH01ujNDEX8Oya1eI3N/', 'Thomas', 'Thomas@utas.edu.au', 'Bachelor', 'Information Systems', 753352783, '', 0),
(202013, '$1$9hSx.sTD$L4zH01ujNDEX8Oya1eI3N/', 'Charles', 'Charles@utas.edu.au', 'PHD', 'Human Computer Interaction', 656439276, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `assignmentstudent`
--

CREATE TABLE IF NOT EXISTS `assignmentstudent` (
  `student_id` int(6) NOT NULL,
  `password` varchar(128) NOT NULL,
  `name` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `address` varchar(128) NOT NULL,
  `birth` varchar(32) NOT NULL,
  `phone` int(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignmentstudent`
--

INSERT INTO `assignmentstudent` (`student_id`, `password`, `name`, `email`, `address`, `birth`, `phone`) VALUES
(100001, '$1$xbog6oRh$6CUSXCiUj4I0y4c6/3pgr/', 'Liam', 'Liam@utas.edu.au', 'Hobart', '1991-07-11', 889939731),
(100002, '$1$0EwMXTL4$IEE2hv22nmiGOrDSVbNgd1', 'Noah', 'Noah@utas.edu.au', 'Hobart', '1991-07-11', 661781120),
(100003, '$1$Cn1WRWYW$Kc/97gA6qY3imzRVlNOm31', 'William', 'William@utas.edu.au', 'Hobart', '1991-07-11', 528207696),
(100004, '$1$BWb4L9Y.$3kqYebKTwf3IsmuFaCvUe/', 'James', 'James@utas.edu.au', 'Hobart', '1991-07-11', 348764794),
(100005, '$1$JlWLfW3h$Uaj9RYZGUPXk7rADjDGTu.', 'Oliver', 'Oliver@utas.edu.au', 'Hobart', '1991-07-11', 754568251),
(100006, '$1$qvI0u45x$1pEgNfCJlf8ill/fGJ9x90', 'Benjamin', 'Benjamin@utas.edu.au', 'Hobart', '1991-07-11', 755155817),
(100007, '$1$Em6T5yW2$3Hnsdm8SWQESgrlxkiNDQ/', 'Elijah', 'Elijah@utas.edu.au', 'Hobart', '1991-07-11', 554886750),
(100008, '$1$Tjv58dQw$ntzwoLyIxO100MnsHIS8U1', 'Lucas', 'Lucas@utas.edu.au', 'Hobart', '1991-07-11', 603510551),
(100009, '$1$unXiDmY9$u.20T5MdYL9lgwznaU.eM.', 'Mason', 'Mason@utas.edu.au', 'Hobart', '1991-07-11', 774052402),
(100010, '$1$M/CPhkSN$3OnGAz.g7XmP9Gq1GZ5ij0', 'Logan', 'Logan@utas.edu.au', 'Hobart', '1991-07-11', 310319451),
(100011, '$1$tA.kocBX$wByAcjRww2uOZoRjJ7NEH.', 'Emma', 'Emma@utas.edu.au', 'Hobart', '1991-07-11', 609212005),
(100012, '$1$uSE/4BYC$807HB.BzoBDbzI7g4qL37/', 'Olivia', 'Olivia@utas.edu.au', 'Hobart', '1991-07-11', 830636075),
(100013, '$1$atxmLMv.$RUElq0nBY2A1SQj0AIBGY0', 'Ava', 'Ava@utas.edu.au', 'Hobart', '1991-07-11', 783436909),
(100014, '$1$4ezvHJjR$dBonqjjgCrJTidWDVArK4/', 'Isabella', 'Isabella@utas.edu.au', 'Hobart', '1991-07-11', 571287012),
(100015, '$1$6KTsH0TO$Q5dSexjo4S0wkL7eWVw251', 'Sophia', 'Sophia@utas.edu.au', 'Hobart', '1991-07-11', 532570753),
(100016, '$1$SoyIeb59$gKiR5WTaMPaWN9BmV1eUl.', 'Charlotte', 'Charlotte@utas.edu.au', 'Hobart', '1991-07-11', 736116106),
(100017, '$1$tVrmEZsN$QGojxGj.DNos.FUoOT4Bn0', 'Mia', 'Mia@utas.edu.au', 'Hobart', '1991-07-11', 316706775),
(100018, '$1$W84ZOntg$tSCUkfKNLnpUn1/CmHLis1', 'Amelia', 'Amelia@utas.edu.au', 'Hobart', '1991-07-11', 454585510),
(100019, '$1$A6L8heaM$0sHIPXuBBXUipBVDBCSZN0', 'Harper', 'Harper@utas.edu.au', 'Hobart', '1991-07-11', 677384030),
(100020, '$1$YPWxZgzy$KvhRR1jCpP8/ilOvRs7qF1', 'Evelyn', 'Evelyn@utas.edu.au', 'Hobart', '1991-07-11', 544334093),
(123456, '$1$cw1BWANs$FtZvHnAaCnRYrVWyhdH7R.', 'AA', 'chail@utas.edu.au', 'Hobart', '1992-02-11', 0),
(654321, '$1$zOoDt1JX$D.kh2jknrMDeT4Pl6wB89.', 'hello', 'hello@world.com', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `assignmentunit`
--

CREATE TABLE IF NOT EXISTS `assignmentunit` (
  `id` int(11) NOT NULL,
  `unit_code` varchar(6) NOT NULL,
  `unit_name` varchar(64) NOT NULL,
  `uc_id` int(11) DEFAULT NULL,
  `unit_coordinator` varchar(32) NOT NULL,
  `lecturer_id` int(11) DEFAULT NULL,
  `lecturer` varchar(64) NOT NULL,
  `start_week` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `duration` int(11) NOT NULL,
  `semester` varchar(32) NOT NULL,
  `campus` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignmentunit`
--

INSERT INTO `assignmentunit` (`id`, `unit_code`, `unit_name`, `uc_id`, `unit_coordinator`, `lecturer_id`, `lecturer`, `start_week`, `start_time`, `duration`, `semester`, `campus`, `description`) VALUES
(1, 'KIT502', 'Web Development', 202002, 'Riseul Ryu', 202004, 'Dominic Duke', 2, '11:30:00', 2, 'Semester 1', 'Pandora', 'This unit will explain the relationship between data, information and knowledge and introduce a number of different tools for managing, storing, securing, modelling, visualizing and analysing data.'),
(2, 'KIT506', 'Software Application Design and Implementation', 202003, 'Mutaz Barika', 202007, 'Michael', 3, '14:00:00', 2, 'Semester 2', 'Rivendell', 'This unit focuses on the nature of systems design, implementation and testing as phases within the systems development process.'),
(3, 'KIT707', 'Knowledge and Information Management', 202004, 'Dominic Duke', 202002, 'Riseul Ryu', 3, '16:00:00', 1, 'Winter School', 'Neverland', 'This unit aims to present a coherent view on the role of information and knowledge in organisations from a multidisciplinary perspective.'),
(4, 'KIT709', 'Enterprise Architecture and Systems', 202003, 'Mutaz Barika', 202003, 'Mutaz Barika', 1, '12:00:00', 2, 'Spring School', 'Pandora', 'Organizations around the world are increasingly using commercial packages instead of custom built software to support their core business processes. '),
(5, 'KIT808', 'sdcsdf', 202002, 'Riseul Ryu', NULL, '', 4, '11:00:00', 2, 'Semester 1', 'Rivendell', 'sdsd');

-- --------------------------------------------------------

--
-- Table structure for table `assignmentutor`
--

CREATE TABLE IF NOT EXISTS `assignmentutor` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `unit_code` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignmentutor`
--

INSERT INTO `assignmentutor` (`id`, `staff_id`, `unit_code`) VALUES
(4, 202002, 'KIT502'),
(5, 202002, 'KIT506'),
(7, 202002, 'KIT709'),
(8, 202003, 'KIT502'),
(10, 202003, 'KIT707'),
(15, 202004, 'KIT709'),
(18, 202005, 'KIT502'),
(19, 202005, 'KIT506'),
(20, 202005, 'KIT707'),
(21, 202005, 'KIT709'),
(22, 202003, 'KIT506'),
(23, 202003, 'KIT709'),
(24, 202004, 'KIT502'),
(26, 202004, 'KIT707'),
(27, 202006, 'KIT502'),
(28, 202006, 'KIT506'),
(29, 202006, 'KIT707'),
(30, 202006, 'KIT709'),
(31, 202007, 'KIT502'),
(32, 202007, 'KIT506'),
(33, 202007, 'KIT707'),
(34, 202007, 'KIT709'),
(35, 202008, 'KIT502'),
(36, 202008, 'KIT506'),
(38, 202008, 'KIT709'),
(39, 202009, 'KIT502'),
(41, 202009, 'KIT707'),
(42, 202009, 'KIT709'),
(46, 202010, 'KIT709'),
(47, 202011, 'KIT502'),
(48, 202011, 'KIT506'),
(49, 202011, 'KIT707'),
(50, 202011, 'KIT709'),
(51, 202012, 'KIT502'),
(52, 202012, 'KIT506'),
(53, 202012, 'KIT707'),
(54, 202012, 'KIT709'),
(61, 202013, 'KIT709'),
(62, 202013, 'KIT709'),
(64, 202002, 'KIT707'),
(67, 202004, 'KIT506'),
(68, 202013, 'KIT506'),
(70, 202013, 'KIT707'),
(71, 202008, 'KIT707'),
(72, 202009, 'KIT506'),
(73, 202010, 'KIT707'),
(74, 202010, 'KIT506'),
(75, 202010, 'KIT502'),
(76, 1, 'KIT502'),
(77, 202013, 'KIT502');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`) VALUES
('chail', '501741'),
('chail', '501741'),
('chail', '123'),
('AS', 'asd'),
('zzzzz', '123'),
('chail', '827ccb0eea8a706c4c34a16891f84e7b'),
('chail0', '$1$NuxjAWSe$5QtZaIMfEYezFzgl5otvI.'),
('chail1234', '$1$PT0v363l$auCbz/29UEy7gAQ4z7M39/');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE IF NOT EXISTS `movies` (
  `ID` int(11) NOT NULL,
  `title` varchar(128) DEFAULT NULL,
  `year` char(4) DEFAULT NULL,
  `language` varchar(128) DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `genre` varchar(128) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`ID`, `title`, `year`, `language`, `rate`, `genre`) VALUES
(1, 'The Godfather', '1972', 'English', 9.2, 'Crime'),
(2, 'Prime and Prejudice', '2005', 'English', 7.8, 'Romance'),
(3, 'Crouching Tiger, Hidden Dragon', '2000', 'Chinese', 7.8, 'Fantasy'),
(4, 'Titanic', '1997', 'English', 7.8, 'Disaster'),
(5, 'The Avengers', '2012', 'English', 8, 'Fantasy'),
(6, 'Parasite', '2019', 'Korean', 8.6, 'Mystery'),
(7, 'Green Book', '2018', 'English', 8.2, 'Comedy'),
(8, 'Gravity', '2013', 'English', 7.7, 'Science fitction'),
(10, 'Cold War', '2018', 'Polish', 8.5, 'Drama');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE IF NOT EXISTS `units` (
  `id` int(11) NOT NULL,
  `unit_code` varchar(128) NOT NULL,
  `unit_name` varchar(128) NOT NULL,
  `lecturer` varchar(128) NOT NULL,
  `semester` varchar(128) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `unit_code`, `unit_name`, `lecturer`, `semester`) VALUES
(2, 'KIT2022', 'Secure Web Programming', 'Soonja Yeom', 'Semester 1'),
(3, 'KIT102', 'Introduction to Data Science', 'Son Tran', 'Semester 2'),
(4, 'KIT112', 'CyberSecurity and Ethical Hacking', 'Mira Park', 'Semester 2'),
(5, 'KIT606', 'Data Analytics', 'Saurabh Garg', 'Spring'),
(7, 'KIT710', 'eLogistics', 'Sonia Sadeghian Esfahani', 'Semester 4');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `mobile` varchar(32) NOT NULL,
  `email` varchar(128) NOT NULL,
  `gender` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `password`, `mobile`, `email`, `gender`) VALUES
(1, 'chail', '501741', '', 'jxcharlie1991@gmail.com', ''),
(2, 'chailsdfsdfsd', '501741sdfsdf', '', 'sdfa@sdfsdfds', ''),
(3, 'chail', '501741', '0466449069', 'chail@utas.edu.au', 'male'),
(4, 'chail', '501741', '0466449069', 'chail@utas.edu.au', 'male');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignmentavailable`
--
ALTER TABLE `assignmentavailable`
  ADD PRIMARY KEY (`staff_id`),
  ADD UNIQUE KEY `staff_id` (`staff_id`);

--
-- Indexes for table `assignmentconsultation`
--
ALTER TABLE `assignmentconsultation`
  ADD UNIQUE KEY `timetable_id` (`consultation_id`),
  ADD KEY `unit_code` (`unit_code`),
  ADD KEY `unit_code_2` (`unit_code`);

--
-- Indexes for table `assignmentenrolment`
--
ALTER TABLE `assignmentenrolment`
  ADD PRIMARY KEY (`enrol_id`),
  ADD UNIQUE KEY `enrol_id` (`enrol_id`);

--
-- Indexes for table `assignmentimetable`
--
ALTER TABLE `assignmentimetable`
  ADD UNIQUE KEY `timetable_id` (`timetable_id`),
  ADD KEY `unit_code` (`unit_code`),
  ADD KEY `unit_code_2` (`unit_code`);

--
-- Indexes for table `assignmentstaff`
--
ALTER TABLE `assignmentstaff`
  ADD UNIQUE KEY `staff_id` (`staff_id`);

--
-- Indexes for table `assignmentstudent`
--
ALTER TABLE `assignmentstudent`
  ADD UNIQUE KEY `student_id` (`student_id`);

--
-- Indexes for table `assignmentunit`
--
ALTER TABLE `assignmentunit`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unit_code` (`unit_code`),
  ADD UNIQUE KEY `unit_code_2` (`unit_code`);

--
-- Indexes for table `assignmentutor`
--
ALTER TABLE `assignmentutor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignmentconsultation`
--
ALTER TABLE `assignmentconsultation`
  MODIFY `consultation_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `assignmentenrolment`
--
ALTER TABLE `assignmentenrolment`
  MODIFY `enrol_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=139;
--
-- AUTO_INCREMENT for table `assignmentimetable`
--
ALTER TABLE `assignmentimetable`
  MODIFY `timetable_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `assignmentunit`
--
ALTER TABLE `assignmentunit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `assignmentutor`
--
ALTER TABLE `assignmentutor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
