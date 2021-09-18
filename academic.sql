-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 13, 2021 at 05:52 AM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `academic`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE IF NOT EXISTS `assignment` (
  `asid` int(5) NOT NULL,
  `did` int(11) NOT NULL COMMENT 'FOREIGN KEY',
  `subject` text NOT NULL,
  `title` text NOT NULL,
  `course` text NOT NULL,
  `sem` int(5) NOT NULL,
  `batch` varchar(11) NOT NULL,
  `duedate` date NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`asid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`asid`, `did`, `subject`, `title`, `course`, `sem`, `batch`, `duedate`, `date`) VALUES
(3, 2, 'Entrepreneurship and Innovations', 'Entrepreneur', 'BACHELOR OF COMPUTER APPLICATIONS', 6, '2018-2021', '2021-07-30', '2021-07-11 20:00:54'),
(1, 2, 'Introduction to Programming', 'Why C programming?', 'BACHELOR OF COMPUTER APPLICATIONS', 1, '2021-2024', '2021-08-31', '2021-07-11 19:40:28'),
(2, 2, 'Entrepreneurship and Innovations', 'Successfull Entrepreneures in India', 'BACHELOR OF COMPUTER APPLICATIONS', 6, '2018-2021', '2021-07-31', '2021-07-11 19:43:07');

-- --------------------------------------------------------

--
-- Table structure for table `assignmentmark`
--

CREATE TABLE IF NOT EXISTS `assignmentmark` (
  `amid` int(5) NOT NULL,
  `asid` int(5) NOT NULL COMMENT 'FOREIGN KEY',
  `sdate` date NOT NULL,
  `stid` bigint(20) NOT NULL COMMENT 'FOREIGN KEY',
  `mark` int(10) DEFAULT NULL,
  PRIMARY KEY (`amid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignmentmark`
--

INSERT INTO `assignmentmark` (`amid`, `asid`, `sdate`, `stid`, `mark`) VALUES
(1, 2, '2021-07-11', 33218814001, 8);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
  `atid` int(11) NOT NULL AUTO_INCREMENT,
  `did` int(11) NOT NULL COMMENT 'FOREIGN KEY',
  `description` text NOT NULL,
  `cid` int(11) NOT NULL COMMENT 'FOREIGN KEY',
  `sem` int(5) NOT NULL,
  `batch` varchar(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`atid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`atid`, `did`, `description`, `cid`, `sem`, `batch`, `date`) VALUES
(1, 5, 'February-March', 1, 6, '2018-2021', '2021-07-13 10:32:55');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `cname` text NOT NULL,
  `cdesc` text NOT NULL,
  `eligibility` text NOT NULL,
  `duration` text NOT NULL,
  `semester` int(5) NOT NULL,
  `fees` int(10) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`cid`, `cname`, `cdesc`, `eligibility`, `duration`, `semester`, `fees`) VALUES
(1, 'BACHELOR OF COMPUTER APPLICATIONS', 'Bachelors in Computer Application is a undergraduate degree course for Computer languages. One of the most popular options to get started with a career in Information Technology, the course gives you an insight into the world of computers and its applications. \r\n\r\nA BCA degree is considered to be at par with a BTech/BE degree in Computer Science or Information Technology. The degree helps interested students in setting up a sound academic base for an advanced career in Computer Applications.', 'A Pass in Higher Secondary Examination of \r\nthe State or an Examination accepted by the \r\nUniversity as equivalent thereto with \r\nMathematics as one of the optional subject.', '3 years', 6, 19500),
(2, 'BSC BOTANY AND BIOTECHNOLOGY', 'The B.Sc Botany - Biotechnology Graduate programme is designed as an biological, physical and chemical sciences. The department offers B.Sc Botany and Biotechnology dual core programme designed to develop a scientific attitude and an interest towards the modern areas of biotechnology in particular and life science in general. It is aimed to get an aptitude in Biotechnology without losing the importance of basic science such as botany. The courses are designed to impart the essential basics in Botany, Zoology, Biochemistry and Biotechnology.', 'A Pass in Higher Secondary Examination of \r\nthe state or an Examination accepted by the \r\nUniversity as equivalent thereto with Biology \r\nas one of the subjects.', '3 years', 6, 15600),
(3, 'BCOM WITH COMPUTER APPLICATIONS', 'BCom Computer Applications is a degree that specializes in Commerce as well as in Computer Applications. Under this program, the students would be taught the basics of Commerce like accountancy, macroeconomics along with the basics of computer language, computer applications in business, etc.', 'A Pass in Higher Secondary Examination of \r\nthe State or an Examination accepted by the \r\nUniversity as equivalent thereto provided \r\ncandidates coming from Non-Commerce \r\ngroup should have at least 45% of the \r\naggregate marks.', '3 years', 6, 16500),
(4, 'BACHELOR OF SCIENCE CHEMISTRY', 'B.Sc in Chemistry is an undergraduate three-year programme that is divided into six semesters. The programme focuses on topics like Inorganic and Organic Chemistry, Physical Chemistry and more. The science of matter is also concerned with physics. However, chemistry is a more specialised subject. After pursuing B.Sc in Chemistry, candidates can get a number of opportunities including Chemical Engineering Associate, Lab Chemist, Production Chemist, Analytical Chemist, etc. Chemistry graduates can also go for further studies like MSc in Chemistry. ', 'A Pass in Higher Secondary Examination of the \r\nstate or an Examination accepted by the \r\nUniversity as equivalent thereto with Chemistry \r\nas one of the subjects under science group.', '3 years', 6, 12500),
(5, 'BACHELOR OF SCIENCE ZOOLOGY', 'B.Sc Zoology or Bachelor of Science in Zoology is a postgraduate Zoology course. Students who aspire to study animal biology can benefit from Bachelor of Science in Zoology. The three-year imparts education on the diversity of animal life and development as well as their genetic structure. Students who pursue this course can pursue career paths in the field of wildlife conservation, environmental management, ecosystem monitoring, animal welfare and as well. It is esteemed and opens up global opportunities for students who want to work for IFAW and RSPCA.', 'A Pass in Higher Secondary Examination of the \r\nstate or an Examination accepted by the \r\nUniversity as equivalent thereto with Biology as \r\none of the subjects under science group.\r\n', '3 years', 6, 16500),
(6, 'BACHELOR OF SCIENCE BIOCHEMISTRY', 'B.Sc in Biochemistry is designed to study the biology and chemistry of plants, animals and humans. This program is designed to prepare a new generation of professional scientists to work in the many industries in need of their skills. The work done in the classroom gives students the foundation necessary to participate in todays global scientific community. The coursework also allows students to spend invaluable time in laboratory settings where they will gain experience using the skills and techniques they have studied in class.', 'A Pass in Higher Secondary Examination of the \r\nstate or an Examination accepted by the \r\nUniversity as equivalent thereto with Chemistry \r\nand Biology as one of the subjects.', '3 Years', 6, 15600),
(7, 'BACHELOR OF SCIENCE PHYSICS', 'BSc Physics is a undergraduate course, which deals with the nuances of Physics and its various properties. This course aims to provide the aspirants with the foundation knowledge possible for a Science-based career. The program is split into six semesters. It deals with advanced scientific fields of physics, mathematics, and chemistry. B.Sc Physics can provide job opportunities in academic schools, power generation companies, hospitals, pyrotechnics manufacturers, and government research agencies.', 'A Pass in Higher Secondary Examination of the \r\nstate or an Examination accepted by the \r\nUniversity as equivalent thereto with Physics as \r\none of the subjects under science group.', '3 years', 6, 20500),
(8, 'BACHELOR OF SCIENCE MATHEMATICS', 'BSc in Mathematics is an undergraduate degree programme that comes under the Science stream.  The 3 years B.Sc. degree programme is one of the popular courses that is chosen by students who have an interest in Mathematics subjects. It is an interesting course which is designed to focus on the in-depth topics related to Mathematics. Students who choose B.Sc. Mathematics has good career options. ', 'A Pass in Higher Secondary Examination of the \r\nstate or an Examination accepted by the \r\nUniversity as equivalent thereto with \r\nMathematics as one of the subjects under science \r\ngroup.', '3 years', 6, 14500),
(9, 'MASTER OF SCIENCE ZOOLOGY', 'M.Sc Zoology or Master of Science in Zoology is a postgraduate Zoology course. This course deals with zoology which is a branch of biology which deals with the structure and function of animal bodies. The job scope for M.Sc Zoology course is high in demand in the field of wildlife conservation and research. Zoology is both descriptive and analytical as the subject can either be as basic as applied science.', 'Course with not less than 5.5 \r\nCCPA(S) * out of 10/ B.Sc. \r\nIndustrial Fish and Fisheries \r\n(Vocational)/ B.Sc. Biological \r\nTechniques and Specimen \r\nPreparation (Vocational)/B.Sc. \r\nClinical Nutrition and Dietetics ( \r\nIf Zoology is one of the Core \r\nCourse)/ B.Sc. Industrial \r\nMicrobiology (Vocational)(If \r\nZoology is one of the Core \r\nCourse)/B.Sc. Biotechnology \r\n(Vocational) (If Zoology is one of \r\nthe Core Course).', '2 years', 6, 34568),
(10, 'MASTER OF SCIENCE BOTANY', 'M.Sc Botany is the branch of biology that deals with the advanced study of plant life. It is a postgraduate degree programme that can be completed in 2 years. The course covers the structure, metabolism, reproduction, evolution and development and the relationship of the plant kingdom with the environment. Candidates who study M.Sc Botany also a chance to study the medicinal properties of plants and identify the plants that are poisonous to use. It is the scientific study of about a variety of plant specifies and their features.', 'B.Sc. with Botany as Core \r\nCourse with not less than 5.5 \r\nCCPA(S)* out of 10. B.Sc. \r\nClinical Nutrition and Dietetics \r\n(Vocational) (If Botany is one of \r\nthe Core Course)/B.Sc. Industrial \r\nMicrobiology (Vocational) (If \r\nBotany is one of the Core \r\nCourse)/B.Sc. Biotechnology \r\n(Vocational) (If Botany is one \r\nof the Core Course)/ B.Sc. \r\nBotany and Biotechnology (Career \r\nrelated/restructured). B.Sc. \r\nVocational course with the \r\nsubject combinations \r\nBiotechnology, Chemistry, \r\nZoology/Botany are also eligible. ', '2 years', 4, 30500),
(11, 'MASTER OF COMPUTER APPLICATIONS', 'Master in Computer Application is a postgraduate degree course for Computer languages.  The post graduate program is designed to meet the growing demand for qualified professionals in the field of Information Technology. The MCA program is inclined more toward Application Development and thus has more emphasis on latest programming language and tools to develop better and faster applications. MCA is a course exclusively designed to meet the requirements for IT trained students for various organizations. This course significantly emphasizes planning, designing and building of complex commercial application software and system software. The course also places equal importance on functional knowledge in various areas. A two year full-time MCA course is not just a postgraduate course; it is also a complete professional grooming for students for a successful career in the IT Industry.', 'Applicants should possess a BCA/Bachelor Degree in Computer Science Engineering or equivalent Degree from any recognized university or institution. Applicants must possess a B.Sc./B.Com/BA degree from any recognized university or institution and must have studied Mathematics at the 10+2 level or Mathematical Sciences at the graduation level. Applicants must have secured at least 50% overall aggregate score in their respective previous qualifying degree examinations. Applicants from the reserved category can apply with an overall aggregate score of 45%', '2 years', 4, 50500),
(12, 'MASTER OF SCIENCE MATHEMATICS', 'MSc in Mathematics is an postgraduate degree programme that comes under the Science stream. This degree has been awarded to those who complete the program. In this degree, candidates get a deeper knowledge of advanced mathematics through a vast preference of subjects such as geometry, calculus, algebra, number theory, dynamical systems, differential equations, etc. The students become more skilled and specialized in a particular subject after the master degree program. In this course, students learn to collect big data and analyse them with the help of different tools and methods. ', 'B.Sc. with Mathematics or \r\nStatistics as Core Course \r\nsecuring not less than 5.5 \r\nCCPA(S) * out of 10 / B.Sc. \r\nOptical Instrumentation \r\n(Vocational), Instrumentation \r\n(Vocational), Industrial Chemistry \r\n(Vocational) / Electrical \r\nEquipment Maintenance \r\n(Vocational), Computer \r\nApplications (Career \r\nRelated/Vocational ). \r\n (A quota not exceeding 10% of the \r\ntotal seats may be filled up from \r\nstudents of Career \r\nRelated/Vocational stream). \r\nB.Sc. Physics & Optical \r\nInstrumentation (Restructured)/ \r\nB.Sc. Physics & Computer \r\nApplications (Career \r\nRelated/Restructured) ', '2 years', 4, 35649);

-- --------------------------------------------------------

--
-- Table structure for table `departmentreg`
--

CREATE TABLE IF NOT EXISTS `departmentreg` (
  `did` int(11) NOT NULL,
  `f_name` text NOT NULL,
  `l_name` text NOT NULL,
  `userid` varchar(30) NOT NULL COMMENT 'FOREIGN KEY',
  `housename` text NOT NULL,
  `street` text NOT NULL,
  `district` text NOT NULL,
  `state` text NOT NULL,
  `pincode` bigint(10) NOT NULL,
  `phone` bigint(15) NOT NULL,
  `qualification` text NOT NULL,
  `yoexperience` int(10) NOT NULL,
  `ppublished` text,
  `course` text NOT NULL,
  `batch` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`did`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departmentreg`
--

INSERT INTO `departmentreg` (`did`, `f_name`, `l_name`, `userid`, `housename`, `street`, `district`, `state`, `pincode`, `phone`, `qualification`, `yoexperience`, `ppublished`, `course`, `batch`) VALUES
(7, 'Sobha', 'S', 'sobha@gmail.com', 'Sobham', 'Kadakkavoor', 'Thiruvananthapuram', 'Kerala', 678908, 7988787878, 'Mcom', 10, 'no', 'BCOM WITH COMPUTER APPLICATIONS', '2018-2021'),
(5, 'Smitha', 'S', 'smitha@gmail.com', 'Smitham', 'Nedungolam', 'Kollam', 'Kerala', 690678, 7856789670, 'MTECH', 10, 'no', 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(6, 'Neeraj', 'M', 'neeraj123@gmail.com', 'Neerajam', '123abhiath', 'Kollam', 'Kerala', 678223, 7856475678, 'MSC MATHEMATICS', 10, 'NO', 'BACHELOR OF SCIENCE CHEMISTRY', '2018-2021'),
(4, 'Samir', 's', 'samir@gmail.com', 'Samiraum', 'Sathirath', 'Kollam', 'Kerala', 678567, 7890678978, 'MCOM', 10, 'NO', 'BCOM WITH COMPUTER APPLICATIONS', 'NULL'),
(3, 'Indu', 'Sreekumar', 'indu@gmail.com', 'Sreelayam', 'Palayam', 'Thiruvananthapuram', 'Kerala', 691578, 9744227340, 'MSC CHEMISTRY', 10, 'no', 'BACHELOR OF SCIENCE CHEMISTRY', 'NULL'),
(1, 'Greeshma', 'Rajeevan', 'greeshma123@gmail.com', 'Greeshmam', 'Pallikkal', 'Kollam', 'Kerala', 691578, 8978675645, 'MA ENGLISH', 10, 'No', 'BSC BOTANY AND BIOTECHNOLOGY', 'NULL'),
(2, 'Sangeeth', 'Shivan', 'sangeeth@gmail.com', 'Sangeetham', 'Dhalavapuram', 'Thiruvananthapuram', 'Kerala', 691509, 7902585890, 'MCA', 10, 'NO', 'BACHELOR OF COMPUTER APPLICATIONS', 'NULL'),
(8, 'Remani', 'S', 'remani@gmail.com', 'Remaniyam', 'Pampuram', 'Kollam', 'Kerala', 691578, 9578686850, 'MCA', 10, 'no', 'BACHELOR OF COMPUTER APPLICATIONS', 'NULL'),
(9, 'Sujith', 'P', 'sujith@gmail.com', 'Sujitham', 'Pampuram', 'Kollam', 'Kerala', 691345, 7989990978, 'MSC PHYSICS', 10, 'NO', 'BACHELOR OF SCIENCE CHEMISTRY', 'NULL'),
(10, 'Prabhakaran', 'P', 'prabhakaran@gmail.com', 'Prabhus', 'Ochira', 'Kollam', 'Kerala', 678907, 9868788956, 'MCOM', 10, 'NO', 'BCOM WITH COMPUTER APPLICATIONS', 'NULL');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE IF NOT EXISTS `exam` (
  `eid` int(11) NOT NULL,
  `did` int(11) NOT NULL COMMENT 'FOREIGN KEY',
  `description` text NOT NULL,
  `cid` int(11) NOT NULL COMMENT 'FOREIGN KEY',
  `sem` int(5) NOT NULL,
  `batch` varchar(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`eid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`eid`, `did`, `description`, `cid`, `sem`, `batch`, `date`) VALUES
(1, 2, 'Sixth Semester University Exam ', 1, 6, '2018-2021', '2021-07-12 21:43:10');

-- --------------------------------------------------------

--
-- Table structure for table `exammark`
--

CREATE TABLE IF NOT EXISTS `exammark` (
  `emid` int(5) NOT NULL,
  `did` int(11) NOT NULL COMMENT 'FOREIGN KEY',
  `rlno` bigint(20) NOT NULL COMMENT 'FOREIGN KEY',
  `mark` int(10) NOT NULL,
  `outof` int(11) NOT NULL,
  `type` text NOT NULL,
  `batch` varchar(10) NOT NULL,
  `subject` text NOT NULL,
  `course` text NOT NULL,
  `sem` int(5) NOT NULL,
  `date` date NOT NULL,
  `status` int(5) NOT NULL,
  PRIMARY KEY (`emid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exammark`
--


-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `userid` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `type` text NOT NULL,
  `status` text NOT NULL,
  `login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `logout` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`userid`, `password`, `type`, `status`, `login`, `logout`) VALUES
('admin@gmail.com', '0e7517141fb53f21ee439b355b5a1d0a', 'admin', '1', '2021-07-12 17:25:47', '2021-07-12 17:41:15'),
('greeshma123@gmail.com', '5299054d4272bedfe01e7ba1010bd89f', 'hod', '1', '2021-07-11 10:33:36', '2021-07-11 10:33:57'),
('sangeeth@gmail.com', '23cd6ab8b11be0f036e3f84b4c58c386', 'hod', '1', '2021-07-13 11:10:14', '2021-07-13 11:11:01'),
('indu@gmail.com', '149f222f9fc65fdec6ca9d97fd2d7cf6', 'hod', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('samir@gmail.com', 'b284919af3d2bd9e984ad6109b8af329', 'hod', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('smitha@gmail.com', '41e76a8116a1d762164272df90cb58d6', 'advisor', '1', '2021-07-13 11:11:14', '2021-07-13 11:15:18'),
('neeraj123@gmail.com', 'cfffcb27b571a181a1ff30f23037d7c5', 'advisor', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('sobha@gmail.com', 'e2ba117885515f3892f24a718bb528ae', 'advisor', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('remani@gmail.com', 'bc76c474a597510be1a51eca0ec2fcf6', 'faculty', '1', '2021-07-13 11:15:29', '2021-07-13 11:19:51'),
('sujith@gmail.com', '093aada6d1d9f8510b71ef25946ec0d3', 'faculty', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('prabhakaran@gmail.com', '4f1e24799c31d015cb83cebe6cc24591', 'faculty', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('sindhu@gmail.com', 'efd1c8b220aa1d907b2217c91a67e565', 'staff', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('binu@gmail.com', '2e67dc54e70f679a51b317c115d3fe6b', 'staff', '1', '2021-07-12 20:32:40', '2021-07-12 20:38:12'),
('abhijith@gmail.com', 'd37d0666734db565b989b095e82815e1', 'student', '1', '2021-07-13 11:20:06', '2021-07-13 11:20:41'),
('abhiramj@gmail.com', '460fcaae506d882ea3e8535bebb06817', 'student', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('sajeevs@gmail.com', '6828fe982b79e24c8a116a8ed9e33216', 'parent', '1', '2021-07-12 22:15:21', '2021-07-12 22:15:54'),
('jayarams@gmail.com', '2a475aeac1242e725425770146534784', 'parent', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `maskviolations`
--

CREATE TABLE IF NOT EXISTS `maskviolations` (
  `mid` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `img` varchar(50) NOT NULL,
  `desc` text NOT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `maskviolations`
--

INSERT INTO `maskviolations` (`mid`, `date`, `img`, `desc`) VALUES
(1, '2021-07-12 18:22:05', '60ec3af24ded7.png', 'mask'),
(2, '2021-07-12 18:22:52', '60ec3b213559a.png', 'noface'),
(3, '2021-07-12 18:23:20', '60ec3b3dba613.png', 'nomask');

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE IF NOT EXISTS `materials` (
  `mtid` int(5) NOT NULL,
  `did` int(11) DEFAULT NULL COMMENT 'FOREIGN KEY',
  `mtsub` text NOT NULL,
  `mtsem` int(5) NOT NULL,
  `mtcourse` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`mtid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`mtid`, `did`, `mtsub`, `mtsem`, `mtcourse`, `date`) VALUES
(3, 5, 'Mathematics 2', 5, 'BSC BOTANY AND BIOTECHNOLOGY', '2021-07-13 10:36:50'),
(2, 5, 'Multimedia Systems', 6, 'BACHELOR OF COMPUTER APPLICATIONS', '2021-07-13 10:35:44'),
(1, 2, 'Entrepreneurship and Innovations', 6, 'BACHELOR OF COMPUTER APPLICATIONS', '2021-07-12 21:51:38');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `mgid` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `to` varchar(20) NOT NULL,
  `sdate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `from` varchar(20) NOT NULL,
  `reply` text NOT NULL,
  `rdate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` int(11) NOT NULL,
  PRIMARY KEY (`mgid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`mgid`, `message`, `to`, `sdate`, `from`, `reply`, `rdate`, `status`) VALUES
(9, 'Extraordinary', 'admin@gmail.com', '2021-07-12 05:17:56', 'jijo27@gmail.com', '', '0000-00-00 00:00:00', 0),
(8, 'wow!!!', 'admin@gmail.com', '2021-07-12 04:37:48', 'neeraj123@gmail.com', '', '0000-00-00 00:00:00', 0),
(7, 'Thank you for the service', 'admin@gmail.com', '2021-05-19 09:34:38', 'neeraj123@gmail.com', '', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE IF NOT EXISTS `notice` (
  `nid` int(11) NOT NULL,
  `did` int(11) DEFAULT NULL COMMENT 'FOREIGN KEY',
  `sid` int(11) DEFAULT NULL COMMENT 'FOREIGN KEY',
  `description` text NOT NULL,
  `type` text NOT NULL,
  `course` text,
  `batch` varchar(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`nid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`nid`, `did`, `sid`, `description`, `type`, `course`, `batch`, `date`) VALUES
(2, 2, NULL, 'Exam registration for sixth semester(2018-2021)', 'advisor', 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021', '2021-07-12 20:35:48'),
(3, 5, NULL, 'Exam registration for sixth semester(2018-2021)', 'student', 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021', '2021-07-12 20:54:37'),
(1, NULL, 1, 'Exam registration for sixth semester(2018-2021)', 'hod', 'NULL', NULL, '2021-07-12 20:34:47');

-- --------------------------------------------------------

--
-- Table structure for table `parentreg`
--

CREATE TABLE IF NOT EXISTS `parentreg` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `pfname` text NOT NULL,
  `plname` text NOT NULL,
  `userid` varchar(30) NOT NULL COMMENT 'FOREIGN KEY',
  `phousename` text NOT NULL,
  `pstreet` text NOT NULL,
  `pdistrict` text NOT NULL,
  `pstate` text NOT NULL,
  `ppincode` bigint(15) NOT NULL,
  `pphone` bigint(15) NOT NULL,
  `stid` bigint(20) NOT NULL COMMENT 'FOREIGN KEY',
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `parentreg`
--

INSERT INTO `parentreg` (`pid`, `pfname`, `plname`, `userid`, `phousename`, `pstreet`, `pdistrict`, `pstate`, `ppincode`, `pphone`, `stid`) VALUES
(2, 'Jayaram', 'S', 'jayarams@gmail.com', 'Abhisath', 'Opariya', 'Thiruvananthapuram', 'Kerala', 691598, 7898968986, 33218814002),
(1, 'Sajeev', 'S', 'sajeevs@gmail.com', 'Abhiramam', 'Kottappuram', 'Kollam', 'Kerala', 692036, 9809059078, 33218814001);

-- --------------------------------------------------------

--
-- Table structure for table `staffreg`
--

CREATE TABLE IF NOT EXISTS `staffreg` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `sfname` text NOT NULL,
  `slname` text NOT NULL,
  `userid` varchar(30) NOT NULL COMMENT 'FOREIGN KEY',
  `shousename` text NOT NULL,
  `sstreet` text NOT NULL,
  `sdistrict` text NOT NULL,
  `sstate` text NOT NULL,
  `spincode` bigint(11) NOT NULL,
  `sphone` bigint(15) NOT NULL,
  `sposition` text NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `staffreg`
--

INSERT INTO `staffreg` (`sid`, `sfname`, `slname`, `userid`, `shousename`, `sstreet`, `sdistrict`, `sstate`, `spincode`, `sphone`, `sposition`) VALUES
(2, 'Sindhu', 'P', 'sindhu@gmail.com', 'Sindhusma', 'Rameswaram', 'Thiruvananthapuram', 'Kerala', 689834, 7097090945, 'Office Staff'),
(1, 'Binu', 'S', 'binu@gmail.com', 'Binusam', 'Indraprastham', 'Kollam', 'Kerala', 697979, 7895959590, 'Office Staff');

-- --------------------------------------------------------

--
-- Table structure for table `studentlist`
--

CREATE TABLE IF NOT EXISTS `studentlist` (
  `rlno` bigint(20) NOT NULL,
  `sfname` text NOT NULL,
  `slname` text NOT NULL,
  `course` text NOT NULL,
  `batch` varchar(11) NOT NULL,
  PRIMARY KEY (`rlno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentlist`
--

INSERT INTO `studentlist` (`rlno`, `sfname`, `slname`, `course`, `batch`) VALUES
(33218814001, 'Abhijith', 'S', 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(33218814002, 'Abhiram', 'J', 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(33218814003, 'Adith', 'P', 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(33218814004, 'Adilya', 'S', 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(33218814005, 'Ajitha', 'P', 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(33218814006, 'Aleena', 'L', 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(33218814008, 'REENA', 'P', 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(33218814007, 'FATHIMA', 'K', 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(33218814009, 'Reshmi', 'P', 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(33218814010, 'Rithwik', 'P', 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021');

-- --------------------------------------------------------

--
-- Table structure for table `studentreg`
--

CREATE TABLE IF NOT EXISTS `studentreg` (
  `stid` bigint(20) NOT NULL AUTO_INCREMENT,
  `stfname` text NOT NULL,
  `stlname` text NOT NULL,
  `userid` varchar(30) NOT NULL COMMENT 'FOREIGN KEY',
  `sthousename` text NOT NULL,
  `ststreet` text NOT NULL,
  `stdistrict` text NOT NULL,
  `ststate` text NOT NULL,
  `stpincode` int(11) NOT NULL,
  `stphone` bigint(15) NOT NULL,
  `whatsappno` bigint(15) NOT NULL,
  `fname` text NOT NULL,
  `course` text NOT NULL,
  `batch` varchar(11) NOT NULL,
  PRIMARY KEY (`stid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33218815006 ;

--
-- Dumping data for table `studentreg`
--

INSERT INTO `studentreg` (`stid`, `stfname`, `stlname`, `userid`, `sthousename`, `ststreet`, `stdistrict`, `ststate`, `stpincode`, `stphone`, `whatsappno`, `fname`, `course`, `batch`) VALUES
(33218814002, 'Abhiram', 'J', 'abhiramj@gmail.com', 'Abhisath', 'Opariya', 'Thiruvananthapuram', 'Kerala', 691598, 7898968986, 7898968986, 'Jayaram S', 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(33218814001, 'Abhijith', 'S', 'abhijith@gmail.com', 'Abhiramam', 'Kottappuram', 'Kollam', 'Kerala', 692036, 9809059078, 9809059078, 'Sajeev S', 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021');

-- --------------------------------------------------------

--
-- Table structure for table `student_complaint`
--

CREATE TABLE IF NOT EXISTS `student_complaint` (
  `stcid` int(11) NOT NULL AUTO_INCREMENT,
  `stid` bigint(20) NOT NULL COMMENT 'FOREIGN KEY',
  `did` int(11) NOT NULL COMMENT 'FOREIGN KEY',
  `desc` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(5) NOT NULL,
  PRIMARY KEY (`stcid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `student_complaint`
--

INSERT INTO `student_complaint` (`stcid`, `stid`, `did`, `desc`, `date`, `status`) VALUES
(1, 33218814001, 5, 'He is not studying well and not focusing during the class', '2021-07-12 22:15:28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `sbid` int(5) NOT NULL,
  `sbname` text NOT NULL,
  `sbsem` int(5) NOT NULL,
  `sbcourse` text NOT NULL,
  `sbbatch` varchar(11) NOT NULL,
  PRIMARY KEY (`sbid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`sbid`, `sbname`, `sbsem`, `sbcourse`, `sbbatch`) VALUES
(10, 'Environmental Studies', 2, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(9, 'Mathematics 2', 2, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(5, 'Introduction to Programming', 1, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(4, 'Digital Electronics', 1, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(2, 'Mathematics 1', 1, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(8, 'Writing and Presentation Skills', 2, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(7, 'Open Office lab', 1, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(6, 'C Programming Lab', 1, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(3, 'Computer Fundamentals and Organization', 1, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(1, 'Speaking and Listening Skills', 1, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(11, 'Object Oriented Programming', 2, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(12, 'Data Structures in C', 2, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(13, 'Object Oriented Programming Lab', 2, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(14, 'Data Structures Lab', 2, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(15, 'Value Education', 3, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(16, 'Computer Networks and Security', 3, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(17, 'Operating Systems', 3, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(18, 'Database Management Systems', 3, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(19, 'Programming in Java', 3, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(20, 'Dbms Lab', 3, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(21, 'Java Programming Lab', 3, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(22, 'Software Engineering', 4, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(23, 'Web Programming and Python', 4, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(24, 'Php and Mysql', 4, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(25, 'Data Mining and Warehousing', 4, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(26, 'Minor Project', 4, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(27, 'Php and Mysql Lab', 4, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(28, 'Web Programming and Python Lab', 4, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(29, 'Visual Programming', 5, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(30, 'Principles of Management', 5, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(31, 'Data Analytics', 5, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(32, 'System Testing', 5, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(33, 'Information Systems and Knowledge Management', 5, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(34, 'Data Analytics Lab', 5, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(35, 'Visual Programming Lab', 5, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(36, 'Entrepreneurship and Innovations', 6, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(37, 'Design and Analysis of Algorithms', 6, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(38, 'Object Oriented Analysis and Design', 6, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(39, 'Multimedia Systems', 6, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(40, 'Trends in Computing', 6, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021'),
(41, 'Main Project', 6, 'BACHELOR OF COMPUTER APPLICATIONS', '2018-2021');

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE IF NOT EXISTS `timetable` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `did` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cid` int(11) NOT NULL COMMENT 'FOREIGN KEY',
  `sem` int(5) NOT NULL,
  `status` int(5) NOT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`tid`, `did`, `date`, `cid`, `sem`, `status`) VALUES
(1, 2, '2021-07-12 21:38:37', 1, 5, 0);
