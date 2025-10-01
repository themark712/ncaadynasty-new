-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2024 at 10:45 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `1576537_mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `dynarticles`
--

CREATE TABLE `dynarticles` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `seasonid` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `week` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dynarticles`
--

INSERT INTO `dynarticles` (`id`, `seasonid`, `created`, `title`, `content`, `week`) VALUES
(2, 4, '2024-07-25 14:20:46', 'Hilltoppers To Face James Madison in 2024 Opener', '<p>Western Kentucky will kick off the 2024 football season at home against James Madison University out of the Sun Belt.</p><p>This is the first meeting between the two schools.</p>', 1),
(4, 15, '2024-08-13 10:51:20', 'Hens Set For FBS Debut Against Herd', '<p>The Delaware Fightin\' Blue Hens, one of the nation\'s newest FBS programs, will make their FBS debut against the Marshall Thundering Herd this Saturday in Newark.<br></p>', 0),
(5, 15, '2024-08-13 10:53:33', 'Hens Give Up Late Lead, Fall To Marshall', '<p>The Delaware defense needs just one more stop in the final minutes of the 2024 season opener against Marshal to log their first victory as a first-year FBS program. They came up just short.</p>', 1),
(6, 15, '2024-08-13 10:54:52', 'Hens Look to Rebound Against Army', '<p>Delaware will take on Army.</p>', 2),
(10, 4, '2024-08-13 14:42:41', 'Topper Edge Past Dukes With Late TD', '<p>With the offense rolling, but having trouble finding the end zone, Western Kentucky needed a touchdown pass with1:03 remaining to hold off James Madison, 21-17, in both teams\' 2024 season opener.</p><p>The Hilltopper defense set the pace in the first half, holding the Dukes to just 3 first downs for the half, 0 in the first quarter.</p><p>JMU was able to keep pace, however, holding the Hilltoppers scoreless in critical points, and took a 17-14 lead with 1:40 left in the game.</p><p>WKU was able to move the ball throughout the game, but stalled mostly due to pressure from the Dukes\' front 4 and 3 failed 4th down attempts.</p>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dynasty`
--

CREATE TABLE `dynasty` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `name` varchar(75) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `type` varchar(5) DEFAULT NULL,
  `createdteams` bit(1) NOT NULL DEFAULT b'0',
  `customconferences` bit(1) NOT NULL DEFAULT b'0',
  `activeseason` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dynasty`
--

INSERT INTO `dynasty` (`id`, `name`, `userid`, `type`, `createdteams`, `customconferences`, `activeseason`) VALUES
(2, 'Mark WKU', 1, NULL, b'0', b'1', 4),
(21, 'Mark Delaware', 1, NULL, b'1', b'1', 15);

-- --------------------------------------------------------

--
-- Table structure for table `dynconf`
--

CREATE TABLE `dynconf` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `name` varchar(75) DEFAULT NULL,
  `abbr` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dynconf`
--

INSERT INTO `dynconf` (`id`, `name`, `abbr`) VALUES
(1, 'Atlantic Coast Conference', 'ACC'),
(4, 'American Athletic Conference', 'AAC'),
(6, 'Big 12 Conference', 'BIG12'),
(11, 'Big Ten Conference', 'B1G'),
(14, 'Conference USA', 'CUSA'),
(18, 'Independents', 'IND'),
(22, 'Mid-American Conference', 'MAC'),
(25, 'Mountain West Conference', 'MWC'),
(28, 'PAC-12 Conference', 'PAC12'),
(30, 'Southeastern Conference', 'SEC'),
(35, 'Sun Belt Conference', 'SBC');

-- --------------------------------------------------------

--
-- Table structure for table `dyncustomconf`
--

CREATE TABLE `dyncustomconf` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `newteamid` int(11) NOT NULL,
  `confid` int(11) DEFAULT NULL,
  `seasonid` int(11) DEFAULT NULL,
  `replacedteamid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dyncustomconf`
--

INSERT INTO `dyncustomconf` (`id`, `newteamid`, `confid`, `seasonid`, `replacedteamid`) VALUES
(5, 50, 14, 4, 352),
(27, 352, 4, 4, 50),
(36, 177, 4, 4, 311),
(37, 311, 14, 4, 177);

-- --------------------------------------------------------

--
-- Table structure for table `dyngamestats`
--

CREATE TABLE `dyngamestats` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `schid` int(11) NOT NULL,
  `teamid` int(11) NOT NULL,
  `category` varchar(25) NOT NULL,
  `name` varchar(25) NOT NULL,
  `value` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dyngamestats`
--

INSERT INTO `dyngamestats` (`id`, `schid`, `teamid`, `category`, `name`, `value`) VALUES
(1, 2, 132, '', 'First Downs', '17'),
(2, 2, 132, '', 'Rush Yards', '47'),
(3, 2, 132, '', 'Pass Yards', '264'),
(4, 2, 132, '', 'Pass Completions', '25'),
(5, 2, 132, '', 'Pass Attempts', '33'),
(6, 2, 132, '', '3rd Down Attempts', '1'),
(7, 2, 132, '', '3rd Down Conversions', '4'),
(8, 2, 132, '', 'Time of Possession', '11:36'),
(9, 2, 352, '', 'First Downs', '18'),
(10, 2, 352, '', 'Rush Yards', '25'),
(11, 2, 352, '', 'Pass Yards', '420'),
(12, 2, 352, '', 'Pass Completions', '26'),
(13, 2, 352, '', 'Pass Attempts', '40'),
(14, 2, 352, '', '3rd Down Attempts', '12'),
(15, 2, 352, '', '3rd Down Conversions', '5'),
(16, 2, 352, '', 'Time of Possession', '16:24'),
(17, 4, 177, '', '3rd Down Attempts', '16'),
(18, 4, 177, '', '3rd Down Conversions', '4'),
(19, 4, 177, '', 'Pass Attempts', '33'),
(20, 4, 177, '', 'Pass Completions', '17'),
(21, 4, 177, '', 'First Downs', '8'),
(22, 4, 177, '', 'Pass Yards', '239'),
(23, 4, 177, '', 'Rush Yards', '53'),
(24, 4, 177, '', 'Time of Possession', '11:30'),
(25, 4, 352, '', '3rd Down Attempts', '12'),
(26, 4, 352, '', '3rd Down Conversions', '7'),
(27, 4, 352, '', 'Pass Attempts', '24'),
(28, 4, 352, '', 'Pass Completions', '16'),
(29, 4, 352, '', 'First Downs', '15'),
(30, 4, 352, '', 'Pass Yards', '244'),
(31, 4, 352, '', 'Rush Yards', '119'),
(32, 4, 352, '', 'Time of Possession', '12:30'),
(33, 2, 177, '', 'Rush Attempts', '19'),
(34, 2, 352, '', 'Rush Attempts', '18'),
(35, 2, 277, '', '4th Down Attempts', '3'),
(36, 2, 352, '', '4th Down Attempts', '3'),
(37, 2, 177, '', '4th Down Conversions', '2'),
(38, 2, 352, '', '4th Down Conversions', '0'),
(39, 2, 352, '', 'Rush TDs', '0'),
(40, 2, 177, '', 'Rush TDs', '5'),
(41, 2, 177, '', 'Pass TDs', '2'),
(42, 2, 352, '', 'Pass TDs', '3'),
(43, 2, 177, '', '2pt Attempts', '0'),
(44, 2, 177, '', '2pt Conversions', '0'),
(45, 2, 352, '', '2pt Attempts', '0'),
(46, 2, 352, '', '2pt Conversions', '0'),
(47, 4, 352, '', '2pt Attempts', '0'),
(48, 4, 177, '', '2pt Attempts', '0'),
(49, 4, 352, '', '2pt Conversions', '0'),
(50, 4, 177, '', '2pt Conversions', '0'),
(51, 4, 352, '', '4th Down Attempts', '1'),
(52, 4, 177, '', '4th Down Attempts', '4'),
(53, 4, 352, '', '4th Down Conversions', '1'),
(54, 4, 177, '', '4th Down Conversions', '2'),
(55, 4, 352, '', 'Pass TDs', '2'),
(56, 4, 177, '', 'Pass TDs', '0'),
(57, 4, 352, '', 'Rush Attempts', '23'),
(58, 4, 177, '', 'Rush Attempts', '14'),
(59, 4, 352, '', 'Rush TDs', '3'),
(60, 4, 177, '', 'Rush TDs', '0'),
(61, 2, 132, '', '2pt Attempts', '0'),
(62, 2, 132, '', '2pt Conversions', '0'),
(63, 2, 132, '', '4th Down Attempts', '1'),
(64, 2, 132, '', '4th Down Conversions', '1'),
(65, 2, 132, '', 'Pass TDs', '2'),
(66, 2, 132, '', 'Rush Attempts', '24'),
(67, 2, 132, '', 'Rush TDs', '0'),
(68, 19, 163, '', '2pt Attempts', '0'),
(69, 19, 352, '', '2pt Attempts', '1'),
(70, 19, 163, '', '2pt Conversions', '0'),
(71, 19, 352, '', '2pt Conversions', '0'),
(72, 19, 163, '', '3rd Down Attempts', '9'),
(73, 19, 352, '', '3rd Down Attempts', '11'),
(74, 19, 163, '', '3rd Down Conversions', '6'),
(75, 19, 352, '', '3rd Down Conversions', '5'),
(76, 19, 163, '', '4th Down Attempts', '1'),
(77, 19, 352, '', '4th Down Attempts', '2'),
(78, 19, 163, '', '4th Down Conversions', '1'),
(79, 19, 352, '', '4th Down Conversions', '0'),
(80, 19, 163, '', 'First Downs', '15'),
(81, 19, 352, '', 'First Downs', '12'),
(82, 19, 163, '', 'Pass Attempts', '25'),
(83, 19, 352, '', 'Pass Attempts', '19'),
(84, 19, 163, '', 'Pass Completions', '16'),
(85, 19, 352, '', 'Pass Completions', '10'),
(86, 19, 163, '', 'Pass Yards', '167'),
(88, 19, 163, '', 'Pass TDs', '1'),
(89, 19, 352, '', 'Pass TDs', '1'),
(90, 19, 163, '', 'Rush Attempts', '16'),
(92, 19, 163, '', 'Rush Yards', '97'),
(94, 19, 163, '', 'Rush TDs', '2'),
(96, 19, 163, '', 'Time of Possession', '13:42');

-- --------------------------------------------------------

--
-- Table structure for table `dynmessages`
--

CREATE TABLE `dynmessages` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `fromuser` int(11) NOT NULL,
  `touser` int(11) NOT NULL,
  `message` text NOT NULL,
  `datesent` datetime NOT NULL,
  `isread` bit(1) NOT NULL,
  `mtype` varchar(10) DEFAULT NULL,
  `warnings` int(11) DEFAULT 0,
  `email` varchar(100) DEFAULT NULL,
  `subject` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dynmessages`
--

INSERT INTO `dynmessages` (`id`, `fromuser`, `touser`, `message`, `datesent`, `isread`, `mtype`, `warnings`, `email`, `subject`) VALUES
(39, 1, 1, 'test', '2024-08-01 18:00:00', b'0', NULL, 0, 'themark712@gmail.com', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `dynpstatsdefense`
--

CREATE TABLE `dynpstatsdefense` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `schid` int(11) NOT NULL,
  `playerid` int(11) NOT NULL,
  `tackles` int(11) DEFAULT 0,
  `tfl` int(11) DEFAULT 0,
  `sacks` int(11) DEFAULT 0,
  `forcedfumbles` int(11) DEFAULT 0,
  `fumblerecoveries` int(11) DEFAULT 0,
  `tds` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dynpstatsdefense`
--

INSERT INTO `dynpstatsdefense` (`id`, `schid`, `playerid`, `tackles`, `tfl`, `sacks`, `forcedfumbles`, `fumblerecoveries`, `tds`) VALUES
(1, 4, 1011, 12, 1, 0, 0, 0, 0),
(2, 2, 1041, 8, 0, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `dynpstatspassing`
--

CREATE TABLE `dynpstatspassing` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `schid` int(11) NOT NULL,
  `playerid` int(11) NOT NULL,
  `attempts` int(11) DEFAULT 0,
  `completions` int(11) DEFAULT 0,
  `yards` int(11) DEFAULT 0,
  `tds` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dynpstatspassing`
--

INSERT INTO `dynpstatspassing` (`id`, `schid`, `playerid`, `attempts`, `completions`, `yards`, `tds`) VALUES
(5, 4, 950, 31, 17, 220, 2),
(12, 2, 1381, 18, 12, 189, 3),
(13, 2, 950, 40, 26, 420, 3),
(17, 19, 1382, 25, 18, 188, 2),
(18, 19, 1383, 17, 8, 122, 0);

-- --------------------------------------------------------

--
-- Table structure for table `dynpstatsreceiving`
--

CREATE TABLE `dynpstatsreceiving` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `schid` int(11) NOT NULL,
  `playerid` int(11) NOT NULL,
  `receptions` int(11) DEFAULT 0,
  `yards` int(11) DEFAULT 0,
  `tds` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dynpstatsreceiving`
--

INSERT INTO `dynpstatsreceiving` (`id`, `schid`, `playerid`, `receptions`, `yards`, `tds`) VALUES
(1, 2, 978, 4, 45, 0);

-- --------------------------------------------------------

--
-- Table structure for table `dynpstatsrushing`
--

CREATE TABLE `dynpstatsrushing` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `schid` int(11) NOT NULL,
  `playerid` int(11) NOT NULL,
  `rush` int(11) DEFAULT 0,
  `yards` int(11) DEFAULT 0,
  `tds` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dynpstatsrushing`
--

INSERT INTO `dynpstatsrushing` (`id`, `schid`, `playerid`, `rush`, `yards`, `tds`) VALUES
(5, 4, 962, 14, 87, 1),
(18, 4, 961, 7, 37, 0),
(33, 4, 956, 2, 15, 0),
(35, 2, 962, 12, 42, 0),
(38, 2, 961, 6, 8, 0),
(45, 19, 1384, 12, 67, 1),
(46, 19, 1385, 12, 88, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dynpstatsturnovers`
--

CREATE TABLE `dynpstatsturnovers` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `schid` int(11) NOT NULL,
  `playerid` int(11) NOT NULL,
  `interceptions` int(11) DEFAULT 0,
  `fumbles` int(11) DEFAULT 0,
  `fumbleslost` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dynpstatsturnovers`
--

INSERT INTO `dynpstatsturnovers` (`id`, `schid`, `playerid`, `interceptions`, `fumbles`, `fumbleslost`) VALUES
(1, 2, 950, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dynroster`
--

CREATE TABLE `dynroster` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `teamid` int(11) NOT NULL,
  `fname` varchar(25) NOT NULL,
  `lname` varchar(25) NOT NULL,
  `number` int(11) DEFAULT NULL,
  `position` varchar(10) DEFAULT NULL,
  `year` varchar(5) DEFAULT NULL,
  `isredshirt` bit(1) DEFAULT NULL,
  `seasonid` int(11) DEFAULT NULL,
  `ht` varchar(5) DEFAULT '0',
  `wt` int(11) DEFAULT 0,
  `hometown` varchar(50) DEFAULT NULL,
  `ovr` int(11) DEFAULT 0,
  `spd` int(11) DEFAULT 0,
  `str` int(11) DEFAULT 0,
  `agi` int(11) DEFAULT 0,
  `acc` int(11) DEFAULT 0,
  `awr` int(11) DEFAULT 0,
  `btk` int(11) DEFAULT 0,
  `trk` int(11) DEFAULT 0,
  `cod` int(11) DEFAULT 0,
  `bcv` int(11) DEFAULT 0,
  `sfa` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dynroster`
--

INSERT INTO `dynroster` (`id`, `teamid`, `fname`, `lname`, `number`, `position`, `year`, `isredshirt`, `seasonid`, `ht`, `wt`, `hometown`, `ovr`, `spd`, `str`, `agi`, `acc`, `awr`, `btk`, `trk`, `cod`, `bcv`, `sfa`) VALUES
(950, 352, 'TJ', 'Finley', 16, 'QB', 'Jr', NULL, 4, '6-7', 249, 'Ponchatoula, LA', 80, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(951, 352, 'Turner', 'Helton', 12, 'QB', 'SO', NULL, 4, '6-2', 180, 'Palos Verdes Estates, CA', 61, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(952, 352, 'Tucker', 'Parks', 11, 'QB', 'FR', NULL, 4, '6-1', 193, 'Spring, TX', 66, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(953, 352, 'Rodney', 'Tisdale Jr.', 16, 'QB', 'FR', NULL, 4, '6-2', 183, 'Jacksonville, FL', 65, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(954, 352, 'Caden', 'Veltkamp', 10, 'QB', 'SO', NULL, 4, '6-6', 235, 'Bowling Green, KY', 80, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(956, 352, 'George', 'Hart III', 32, 'HB', 'JR', NULL, 4, '5-11', 209, 'Baton Rouge, LA', 68, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(958, 352, 'Corey', 'Landers', 27, 'HB', 'SO', NULL, 4, '5-8', 185, 'Montgomery, AL', 63, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(961, 352, 'L.T.', 'Sanders', 7, 'HB', 'JR', NULL, 4, '5-8', 195, 'Gardendale, AL', 69, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(962, 352, 'Elijah', 'Young', 3, 'HB', 'SR', NULL, 4, '5-9', 190, 'Knoxville, TN', 78, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(963, 352, 'Denzil', 'Alleyne', 82, 'WR', 'Sr', NULL, 4, '6-2', 212, 'Lakeland, FL', 70, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(964, 352, 'Dalton', 'Bates', 37, 'WR', 'FR', NULL, 4, '6-2', 190, 'Dacula, GA', 60, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(965, 352, 'Sergio', 'McCallum', 29, 'S', 'FR', NULL, 4, '6-0', 186, 'Murfreesboro, TN', 67, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(966, 352, 'Javy', 'Bunton', 19, 'WR', 'Jr', NULL, 4, '6-0', 205, 'Bowling Green, KY', 57, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(967, 352, 'Bryce', 'Childress', 19, 'WR', 'Sr', NULL, 4, '5-9', 179, 'St. Louis, MO', 73, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(968, 352, 'Keith', 'Pippen', 82, 'WR', 'SO', NULL, 4, '6-3', 200, 'Scottsville, KY', 64, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(969, 352, 'Cameron', 'Flowers', 80, 'WR', 'FR', NULL, 4, '5-11', 169, 'Warner Robins, GA', 58, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(970, 352, 'Jaylen', 'Hampton', 83, 'WR', 'FR', NULL, 4, '6-1', 197, 'Atlanta, GA', 59, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(971, 352, 'Jarvis', 'Hayes', 26, 'WR', 'FR', NULL, 4, '6-1', 180, 'Waycross, GA', 67, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(972, 352, 'K.D.', 'Hutchinson', 15, 'WR', 'SO', NULL, 4, '5-8', 180, 'Valley, AL', 73, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(973, 352, 'Damari', 'Jefferson', 24, 'WR', 'FR', NULL, 4, '5-9', 173, 'Hattiesburg, MS', 54, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(974, 352, 'Kisean', 'Johnson', 13, 'WR', 'Sr', NULL, 4, '6-0', 216, 'Birmingham, AL', 72, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(975, 352, 'Michael', 'Mathison', 4, 'WR', 'Sr', NULL, 4, '5-10', 180, 'Covington, GA', 77, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(976, 352, 'Easton', 'Messer', 8, 'WR', 'SO', NULL, 4, '5-9', 195, 'Louisville, KY', 78, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(977, 352, 'Marvin', 'Sims', 21, 'WR', 'Jr', NULL, 4, '5-10', 180, 'Miami, FL', 67, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(978, 352, 'Dalvin', 'Smith', 17, 'WR', 'Sr', NULL, 4, '6-3', 188, 'Glasgow, KY', 81, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(982, 352, 'Trevor', 'Borland', 86, 'TE', 'Sr', NULL, 4, '6-3', 255, 'Bolingbrook, IL', 69, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(983, 352, 'Elvin', 'Fofanah', 84, 'TE', 'Sr', NULL, 4, '6-3', 240, 'Bowling Green, KY', 55, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(984, 352, 'River', 'Helms', 87, 'TE', 'Jr', NULL, 4, '6-4', 242, 'Lester, AL', 83, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(985, 352, 'C.J.', 'Kiss', 89, 'TE', 'Jr', NULL, 4, '6-4', 239, 'Gahanna, OH', 59, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(988, 352, 'Max', 'Locke', 50, 'DT', 'SO', NULL, 4, '6-6', 319, 'Merritt Island, FL', 67, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(989, 352, 'Dalton', 'Baker', 52, 'DE', 'FR', NULL, 4, '6-4', 293, 'Johnson City, TN', 60, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(990, 352, 'Colten', 'Cable', 72, 'OL', 'Sr', NULL, 4, '6-4', 298, 'Tulsa, OK', 71, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(991, 352, 'Antwan', 'Alexander', 2, 'CB', 'FR', NULL, 4, '6-5', 272, 'London, KY', 64, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(992, 352, 'Melvin', 'Collins Jr.', 77, 'OL', 'Jr', NULL, 4, '6-4', 328, 'Terry, MS', 67, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(993, 352, 'Wesley', 'Horton', 50, 'OL', 'Jr', NULL, 4, '6-3', 303, 'Atlanta, GA', 76, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(994, 352, 'Marshall', 'Jackson', 53, 'OL', 'Jr', NULL, 4, '6-6', 299, 'Brandenburg, KY', 75, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(997, 352, 'Quantavious', 'Leslie', 78, 'OL', 'Sr', NULL, 4, '6-3', 318, 'Rome, GA', 85, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(998, 352, 'Michael', 'Moment', 62, 'OL', 'Sr', NULL, 4, '6-3', 297, 'Tampa, FL', 56, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(999, 352, 'Rodney', 'Newsom Jr.', 65, 'OL', 'SO', NULL, 4, '6-3', 295, 'Eads, TN', 68, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1000, 352, 'Michael', 'Ondelacy', 74, 'OL', 'Sr', NULL, 4, '6-7', 320, 'North Richland Hills, TX', 67, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1003, 352, 'Evan', 'Wibberley', 58, 'OL', 'SO', NULL, 4, '6-5', 300, 'Edgewood, KY', 71, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1004, 352, 'Stacey', 'Wilkins', 71, 'OL', 'Sr', NULL, 4, '6-6', 306, 'Camden, AR', 75, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1005, 352, 'Parker', 'Parrish', 43, 'HB', 'FR', NULL, 4, '6-1', 255, 'Starkville, MS', 62, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1006, 352, 'Harper', 'Holloman', 44, 'DE', 'FR', NULL, 4, '6-2', 244, 'Atlanta, GA', 65, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1007, 352, 'Reid', 'Jamerson', 40, 'DE', 'SO', NULL, 4, '5-11', 228, 'Whitefish Bay, WI', 55, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1008, 352, 'Deante', 'McCray', 95, 'DE', 'SO', NULL, 4, '6-4', 268, 'Jacksonville, FL', 75, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1010, 352, 'Terrion', 'Thompson', 13, 'DT', 'Sr', NULL, 4, '6-0', 292, 'Bowling Green, KY', 75, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1011, 352, 'Hosea', 'Wheeler', 98, 'DT', 'Jr', NULL, 4, '6-3', 298, 'Elk Grove, CA', 77, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1014, 352, 'Jayden', 'Loving', 94, 'DL', 'Jr', NULL, 4, '6-3', 302, 'Hamilton, AL', 74, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1015, 352, 'Chukwunedu', 'Okeke', 90, 'DL', 'FR', NULL, 4, '6-3', 284, 'Mableton, GA', 67, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1016, 352, 'Jalil', 'Rivera-Harvey', 99, 'DL', 'Sr', NULL, 4, '6-2', 322, 'Buffalo, NY', 78, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1018, 352, 'Dallas', 'Walker', 35, 'DL', 'Jr', NULL, 4, '6-4', 312, 'Nashville, TN', 74, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1019, 352, 'C.J.', 'Cage', 55, 'DT', 'JR', NULL, 4, '6-0', 228, 'Interlachen, FL', 69, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1020, 352, 'Sebastian', 'Benjamin', 59, 'LB', 'Sr', NULL, 4, '6-2', 240, 'Philadelphia, PA', 79, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1021, 352, 'Anthony', 'Brackenridge', 31, 'LB', 'Jr', NULL, 4, '6-2', 224, 'Jacksonville, FL', 72, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1022, 352, 'Gerald', 'Savage', 45, 'LB', 'JR', NULL, 4, '6-0', 212, 'Houston, TX', 68, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1024, 352, 'Kylan', 'Guidry', 5, 'LB', 'Sr', NULL, 4, '6-4', 232, 'Opelousas, LA', 78, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1025, 352, 'Koron', 'Hayward', 34, 'LB', 'SO', NULL, 4, '6-5', 235, 'Jacksonville, FL', 68, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1026, 352, 'Lofton', 'Howard', 16, 'LB', 'SO', NULL, 4, '6-4', 225, 'Bowling Green, KY', 63, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1028, 352, 'Devon', 'Lynch', 51, 'LB', 'Sr', NULL, 4, '6-1', 231, 'Springfield, VA', 76, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1029, 352, 'Miller', 'Malone', 46, 'LB', 'FR', NULL, 4, '6-1', 196, 'Mont Belvieu, TX', 59, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1030, 352, 'Chandler', 'Matthews', 12, 'LB', 'Sr', NULL, 4, '6-1', 224, 'Dillon, SC', 74, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1031, 352, 'Zsacari', 'Minnis', 48, 'LB', 'FR', NULL, 4, '6-3', 218, 'Eustis, FL', 54, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1032, 352, 'Darius', 'Thomas', 22, 'LB', 'Jr', NULL, 4, '6-2', 210, 'Miramar, FL', 70, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1034, 352, 'Jai', 'Eugene Jr.', 26, 'CB', 'FR', NULL, 4, '6-0', 188, 'Destrehan, LA', 70, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1039, 352, 'Ely', 'George', 28, 'DB', 'Jr', NULL, 4, '5-11', 205, 'Fort Lee, NJ', 71, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1041, 352, 'Anthony', 'Johnson Jr.', 4, 'DB', 'Sr', NULL, 4, '5-10', 180, 'Miami, FL', 88, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1042, 352, 'Virgil', 'Marshall', 19, 'DB', 'Jr', NULL, 4, '6-0', 205, 'Cocoa, FL', 79, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1045, 352, 'Upton', 'Stout', 21, 'DB', 'Jr', NULL, 4, '5-9', 185, 'Houston, TX', 86, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1046, 352, 'Nazir', 'Ward', 27, 'DB', 'SO', NULL, 4, '6-0', 170, 'Miami, FL', 69, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1047, 352, 'Demarko', 'Williams', 15, 'DB', 'Jr', NULL, 4, '5-10', 175, 'Atlanta, GA', 78, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1049, 352, 'Devonte\'', 'Mathews', 14, 'S', 'Sr', NULL, 4, '5-10', 196, 'Phenix City, AL', 73, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1050, 352, 'Kent', 'Robinson', 11, 'S', 'Jr', NULL, 4, '5-10', 165, 'Grand Prairie, TX', 76, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1051, 352, 'Keyshawn', 'Swanson', 18, 'S', 'Sr', NULL, 4, '5-11', 185, 'Pensacola, FL', 75, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1052, 352, 'Tate', 'Titshaw', 20, 'S', 'FR', NULL, 4, '5-11', 195, 'Bogart, GA', 64, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1053, 352, 'Seth', 'Westbrook', 2, 'WR', 'JR', NULL, 4, '5-11', 163, 'Mooresville, NC', 65, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1054, 352, 'Lucas', 'Carneiro', 17, 'K', 'SO', NULL, 4, '5-11', 175, 'Cornelius, NC', 67, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1056, 352, 'Jackson', 'Smith', 43, 'K', 'SO', NULL, 4, '5-11', 204, 'Danville, KY', 71, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1058, 352, 'Cole', 'Maynard', 18, 'P', 'Jr', NULL, 4, '6-1', 180, 'Mooresville, NC', 72, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1060, 352, 'Rex', 'Robich', 55, 'LS', 'Jr', NULL, 4, '6-3', 225, 'Palm Coast, FL', 50, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1061, 352, 'Jalen', 'Hampton', 30, 'HB', 'JR', NULL, 4, '0', 0, NULL, 75, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1062, 352, 'Jeremiah', 'Duncan', 56, 'DT', 'SO', NULL, 4, '0', 0, NULL, 68, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1063, 352, 'Enrique', 'Smith-Diaz', 76, 'DT', 'FR', NULL, 4, '0', 0, NULL, 61, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1064, 352, 'Darrell', 'Johnson Jr', 70, 'DT', 'SR', NULL, 4, '0', 0, NULL, 56, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1065, 352, 'Marcus', 'Patterson', 92, 'DE', 'SO', NULL, 4, '0', 0, NULL, 56, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1066, 91, 'Hezekiah', 'Masses', 12, 'CB', 'JR', NULL, 4, '0', 0, NULL, 84, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1067, 91, 'Kejon', 'Owens', 5, 'HB', 'JR', NULL, 4, '0', 0, NULL, 81, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1068, 91, 'Reggie', 'Peterson', 0, 'LB', 'SR', NULL, 4, '0', 0, NULL, 79, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1069, 91, 'Jamal', 'Potts', 7, 'S', 'SR', NULL, 4, '0', 0, NULL, 79, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1070, 91, 'Josiah', 'Miamen', 88, 'TE', 'SR', NULL, 4, '0', 0, NULL, 79, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1071, 91, 'Brian', 'Blades II', 2, 'CB', 'JR', NULL, 4, '0', 0, NULL, 79, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1072, 91, 'Lexington', 'Joseph', 8, 'HB', 'SR', NULL, 4, '0', 0, NULL, 79, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1073, 91, 'Jeramy', 'Passmore', 8, 'DE', 'SR', NULL, 4, '0', 0, NULL, 79, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1074, 91, 'Shomari', 'Lawrence', 0, 'HB', 'JR', NULL, 4, '0', 0, NULL, 79, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1075, 91, 'JoJo', 'Evans', 36, 'S', 'SO', NULL, 4, '0', 0, NULL, 78, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1076, 91, 'Elijah', 'Anderson-Taylor', 1, 'LB', 'SR', NULL, 4, '0', 0, NULL, 78, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1077, 91, 'Keyone', 'Jenkins', 1, 'QB', 'SO', NULL, 4, '0', 0, NULL, 78, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1078, 91, 'Eric', 'Rivers', 3, 'WR', 'JR', NULL, 4, '0', 0, NULL, 76, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1079, 91, 'Giovanni', 'Davis', 41, 'DE', 'SR', NULL, 4, '0', 0, NULL, 76, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1080, 91, 'Cole', 'Gustafson', 50, 'DT', 'SO', NULL, 4, '0', 0, NULL, 75, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1081, 91, 'Keegan', 'Davis', 44, 'DE', 'JR', NULL, 4, '0', 0, NULL, 75, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1082, 91, 'Jaleel', 'Davis', 78, 'DT', 'SO', NULL, 4, '0', 0, NULL, 75, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1083, 91, 'Chayden', 'Peery', 12, 'QB', 'JR', NULL, 4, '0', 0, NULL, 75, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1084, 91, 'Naeer', 'Jackson', 50, 'LG', 'SO', NULL, 4, '0', 0, NULL, 75, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1085, 91, 'CJ', 'Christian', 4, 'FS', 'SR', NULL, 4, '0', 0, NULL, 75, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1086, 91, 'Dean', 'Patterson', 11, 'WR', 'JR', NULL, 4, '0', 0, NULL, 75, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1087, 91, 'Quaylen', 'Hill', 95, 'DT', 'JR', NULL, 4, '0', 0, NULL, 74, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1088, 91, 'Chase', 'Gabriel', 37, 'K', 'SR', NULL, 4, '0', 0, NULL, 74, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1089, 91, 'Ming', 'Tjon', 69, 'C', 'JR', NULL, 4, '0', 0, NULL, 73, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1090, 91, 'Rocky', 'Beers', 89, 'TE', 'JR', NULL, 4, '0', 0, NULL, 73, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1091, 91, 'John', 'Bock II', 62, 'C', 'JR', NULL, 4, '0', 0, NULL, 73, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1092, 91, 'Steven', 'Shannon', 5, 'LE', 'SO', NULL, 4, '0', 0, NULL, 73, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1093, 91, 'Claude', 'Larkins', 17, 'RE', 'SO', NULL, 4, '0', 0, NULL, 73, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1094, 91, 'Marquez', 'Tatum', 94, 'DT', 'JR', NULL, 4, '0', 0, NULL, 73, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1095, 91, 'Jaheim', 'Buchanon', 59, 'C', 'FR', NULL, 4, '0', 0, NULL, 73, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1096, 91, 'Eddie', 'Walls II', 34, 'LOLB', 'JR', NULL, 4, '0', 0, NULL, 72, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1097, 91, 'Nazeviah', 'Burris', 14, 'WR', 'SR', NULL, 4, '0', 0, NULL, 72, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1098, 91, 'Wyatt', 'Lawson', 55, 'RG', 'JR', NULL, 4, '0', 0, NULL, 72, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1099, 91, 'Travis', 'Burke', 77, 'LT', 'JR', NULL, 4, '0', 0, NULL, 72, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1100, 91, 'Haden', 'Carlson', 4, 'QB', 'JR', NULL, 4, '0', 0, NULL, 72, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1101, 91, 'Lamar', 'Duval', 39, 'CB', 'JR', NULL, 4, '0', 0, NULL, 71, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1102, 91, 'Ben', 'Shellenback', 72, 'LT', 'SR', NULL, 4, '0', 0, NULL, 70, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1103, 91, 'JuJu', 'Lewis', 13, 'WR', 'SO', NULL, 4, '0', 0, NULL, 70, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1104, 91, 'Amari', 'Jones', 2, 'QB', 'SO', NULL, 4, '0', 0, NULL, 70, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1105, 91, 'Demario', 'Hines', 54, 'MLB', 'SO', NULL, 4, '0', 0, NULL, 70, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1106, 91, 'Jadarious', 'Lee', 56, 'RT', 'SO', NULL, 4, '0', 0, NULL, 69, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1107, 91, 'Antonio', 'Patterson', 6, 'HB', 'SO', NULL, 4, '0', 0, NULL, 69, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1108, 91, 'Daton', 'Montiel', 25, 'P', 'SR', NULL, 4, '0', 0, NULL, 68, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1109, 91, 'Ross', 'Fournet', 19, 'WR', 'JR', NULL, 4, '0', 0, NULL, 68, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1110, 91, 'Kian', 'McGee', 63, 'RT', 'SO', NULL, 4, '0', 0, NULL, 68, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1111, 91, 'Jamari', 'Holliman', 21, 'CB', 'FR', NULL, 4, '0', 0, NULL, 68, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1112, 91, 'Mykeal', 'Rabess', 70, 'RT', 'FR', NULL, 4, '0', 0, NULL, 68, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1113, 91, 'Mister', 'Clark', 27, 'CB', 'FR', NULL, 4, '0', 0, NULL, 68, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1114, 91, 'Landon', 'Hale', 3, 'SS', 'SO', NULL, 4, '0', 0, NULL, 67, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1115, 91, 'Kyle', 'McNeal', 83, 'WR', 'FR', NULL, 4, '0', 0, NULL, 67, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1116, 91, 'Clayton', 'Dees', 10, 'QB', 'FR', NULL, 4, '0', 0, NULL, 67, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1117, 91, 'Bobby', 'Salla Jr', 32, 'SS', 'JR', NULL, 4, '0', 0, NULL, 67, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1118, 91, 'DJ', 'Aiken', 13, 'LE', 'SO', NULL, 4, '0', 0, NULL, 67, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1119, 91, 'Ashton', 'Levells', 24, 'FS', 'JR', NULL, 4, '0', 0, NULL, 66, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1120, 91, 'Dwight', 'Nunoo', 30, 'ROLB', 'JR', NULL, 4, '0', 0, NULL, 66, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1121, 91, 'Preston', 'Thompson', 29, 'CB', 'FR', NULL, 4, '0', 0, NULL, 66, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1122, 91, 'Tyler', 'Seawright', 18, 'SS', 'FR', NULL, 4, '0', 0, NULL, 66, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1123, 91, 'Victor', 'Evans III', 26, 'CB', 'FR', NULL, 4, '0', 0, NULL, 66, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1124, 91, 'Daniel', 'Michel', 53, 'LG', 'FR', NULL, 4, '0', 0, NULL, 65, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1125, 91, 'Sean', 'Watford', 64, 'RG', 'JR', NULL, 4, '0', 0, NULL, 65, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1126, 91, 'Jaden', 'Williams', 31, 'SS', 'FR', NULL, 4, '0', 0, NULL, 65, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1127, 91, 'Toddrick', 'Brewton', 45, 'LOLB', 'SO', NULL, 4, '0', 0, NULL, 64, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1128, 91, 'Quincey', 'Howard', 76, 'DT', 'FR', NULL, 4, '0', 0, NULL, 64, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1129, 91, 'Phillip', 'McIntosh', 48, 'TE', 'FR', NULL, 4, '0', 0, NULL, 64, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1130, 91, 'Roderick', 'Clayborn', 85, 'LE', 'FR', NULL, 4, '0', 0, NULL, 64, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1131, 91, 'Nigel', 'Jackson', 84, 'WR', 'SO', NULL, 4, '0', 0, NULL, 64, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1132, 91, 'Shamir', 'Sterlin', 22, 'FS', 'FR', NULL, 4, '0', 0, NULL, 63, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1133, 91, 'Germaine', 'Carter', 99, 'RE', 'FR', NULL, 4, '0', 0, NULL, 63, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1134, 91, 'Josiah', 'Taylor', 35, 'ROLB', 'FR', NULL, 4, '0', 0, NULL, 63, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1135, 91, 'Mike', 'Jackson', 7, 'WR', 'SO', NULL, 4, '0', 0, NULL, 63, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1136, 91, 'Daxton', 'Lamont', 10, 'HB', 'FR', NULL, 4, '0', 0, NULL, 63, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1137, 91, 'Raheim', 'Sexil', 33, 'CB', 'FR', NULL, 4, '0', 0, NULL, 62, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1138, 91, 'Atavious', 'Weaver', 46, 'ROLB', 'FR', NULL, 4, '0', 0, NULL, 62, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1139, 91, 'Luby', 'Maurice Jr.', 81, 'WR', 'FR', NULL, 4, '0', 0, NULL, 61, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1140, 91, 'Tyler', 'Simon', 66, 'LT', 'SO', NULL, 4, '0', 0, NULL, 61, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1141, 91, 'Jonathan', 'Alexis', 36, 'WR', 'FR', NULL, 4, '0', 0, NULL, 60, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1142, 91, 'Travis', 'Smallwood', 24, 'WR', 'FR', NULL, 4, '0', 0, NULL, 59, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1143, 91, 'Jett', 'Law', 82, 'WR', 'SO', NULL, 4, '0', 0, NULL, 58, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1144, 91, 'Jonathan', 'McBride', 15, 'WR', 'FR', NULL, 4, '0', 0, NULL, 58, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1145, 91, 'Jackson', 'Lee', 86, 'TE', 'JR', NULL, 4, '0', 0, NULL, 57, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1146, 91, 'Jamarrion', 'Soloman', 51, 'DT', 'SO', NULL, 4, '0', 0, NULL, 57, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1147, 91, 'Mathias', 'Adjingbaruk', 61, 'LG', 'JR', NULL, 4, '0', 0, NULL, 56, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1148, 91, 'Percy', 'Courtney Jr.', 23, 'MLB', 'SO', NULL, 4, '0', 0, NULL, 53, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1149, 91, 'Denzel', 'Dorn', 75, 'RT', 'FR', NULL, 4, '0', 0, NULL, 51, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1150, 91, 'Noah', 'Fernandez', 60, 'RT', 'FR', NULL, 4, '0', 0, NULL, 51, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1151, 131, 'Clay', 'Webb', 74, 'LG', 'SR', NULL, 4, '0', 0, NULL, 92, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1152, 131, 'Sean', 'Brown', 17, 'TE', 'SR', NULL, 4, '0', 0, NULL, 86, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1153, 131, 'J-Rock', 'Swain', 30, 'LE', 'SR', NULL, 4, '0', 0, NULL, 81, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1154, 131, 'Laletia', 'Hale', 16, 'MLB', 'SR', NULL, 4, '0', 0, NULL, 81, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1155, 131, 'Anwar', 'Lewis', 25, 'HB', 'SR', NULL, 4, '0', 0, NULL, 78, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1156, 131, 'Andrew', 'Paul', 3, 'HB', 'SO', NULL, 4, '0', 0, NULL, 78, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1157, 131, 'Derek', 'Carter', 13, 'CB', 'JR', NULL, 4, '0', 0, NULL, 78, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1158, 131, 'Curley', 'Young Jr.', 41, 'RE', 'SR', NULL, 4, '0', 0, NULL, 77, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1159, 131, 'Brock', 'Robey', 78, 'C', 'SR', NULL, 4, '0', 0, NULL, 77, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1160, 131, 'Jack', 'Dawson', 87, 'P', 'SR', NULL, 4, '0', 0, NULL, 76, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1161, 131, 'Jabari', 'Mack', 4, 'CB', 'JR', NULL, 4, '0', 0, NULL, 76, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1162, 131, 'Geimere', 'Latimer', 8, 'CB', 'SO', NULL, 4, '0', 0, NULL, 76, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1163, 131, 'Zion', 'Turner', 11, 'QB', 'SO', NULL, 4, '0', 0, NULL, 76, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1164, 131, 'Morven', 'Joseph Jr.', 19, 'RE', 'JR', NULL, 4, '0', 0, NULL, 75, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1165, 131, 'Marco', 'Baker', 2, 'CB', 'SR', NULL, 4, '0', 0, NULL, 75, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1166, 131, 'Fred', 'Perry', 6, 'FS', 'JR', NULL, 4, '0', 0, NULL, 75, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1167, 131, 'Ky\'Won', 'McCray', 21, 'SS', 'SR', NULL, 4, '0', 0, NULL, 75, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1168, 131, 'Will', 'O\'Steen', 73, 'LT', 'JR', NULL, 4, '0', 0, NULL, 75, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1169, 131, 'Jibreel', 'Al-Amin', 15, 'ROLB', 'SO', NULL, 4, '0', 0, NULL, 74, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1170, 131, 'Brannon', 'Spector', 14, 'WR', 'SR', NULL, 4, '0', 0, NULL, 74, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1171, 131, 'Demarcus', 'Lacey', 20, 'WR', 'JR', NULL, 4, '0', 0, NULL, 74, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1172, 131, 'Cam', 'Jones', 69, 'RT', 'SR', NULL, 4, '0', 0, NULL, 74, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1173, 131, 'K.D.', 'Arnold', 71, 'RT', 'SO', NULL, 4, '0', 0, NULL, 73, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1174, 131, 'Logan', 'Smothers', 7, 'QB', 'SR', NULL, 4, '0', 0, NULL, 73, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1175, 131, 'James', 'Ziglor', 14, 'SS', 'JR', NULL, 4, '0', 0, NULL, 73, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1176, 131, 'Michael', 'Pettway', 2, 'WR', 'JR', NULL, 4, '0', 0, NULL, 73, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1177, 131, 'Darrell', 'Prater', 96, 'DT', 'SO', NULL, 4, '0', 0, NULL, 72, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1178, 131, 'Te\'Sean', 'Smoot', 8, 'QB', 'SO', NULL, 4, '0', 0, NULL, 72, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1179, 131, 'Reginald', 'Hughes', 5, 'ROLB', 'JR', NULL, 4, '0', 0, NULL, 72, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1180, 131, 'Jake', 'Fitzgibbons', 47, 'SS', 'SR', NULL, 4, '0', 0, NULL, 72, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1181, 131, 'Ricky', 'Samuel', 97, 'DT', 'SR', NULL, 4, '0', 0, NULL, 71, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1182, 131, 'Jacob', 'Barrick', 81, 'TE', 'JR', NULL, 4, '0', 0, NULL, 69, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1183, 131, 'Austin', 'Ambush', 27, 'SS', 'JR', NULL, 4, '0', 0, NULL, 69, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1184, 131, 'Jordan', 'McCants', 88, 'WR', 'SR', NULL, 4, '0', 0, NULL, 69, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1185, 131, 'P.J.', 'Wells', 13, 'WR', 'SR', NULL, 4, '0', 0, NULL, 69, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1186, 131, 'Cameron', 'Griffin', 60, 'RG', 'SO', NULL, 4, '0', 0, NULL, 68, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1187, 131, 'Samario', 'Rudolph', 24, 'WR', 'SR', NULL, 4, '0', 0, NULL, 68, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1188, 131, 'Matthew', 'Lantz', 28, 'FS', 'SO', NULL, 4, '0', 0, NULL, 68, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1189, 131, 'Daveion', 'Harley', 54, 'RG', 'SO', NULL, 4, '0', 0, NULL, 68, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1190, 131, 'Griffin', 'Brewster', 16, 'QB', 'SR', NULL, 4, '0', 0, NULL, 67, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1191, 131, 'Dallan', 'Wright', 16, 'WR', 'JR', NULL, 4, '0', 0, NULL, 67, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1192, 131, 'Demarkus', 'Barr', 1, 'CB', 'JR', NULL, 4, '0', 0, NULL, 67, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1193, 131, 'Keyton', 'Clark', 95, 'LE', 'SO', NULL, 4, '0', 0, NULL, 66, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1194, 131, 'Jarod', 'Bowie', 9, 'WR', 'JR', NULL, 4, '0', 0, NULL, 66, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1195, 131, 'Garrison', 'Rippa', 37, 'K', 'FR', NULL, 4, '0', 0, NULL, 66, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1196, 131, 'Cade', 'Backe', 29, 'P', 'JR', NULL, 4, '0', 0, NULL, 66, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1197, 131, 'Justus', 'Savage', 29, 'HB', 'FR', NULL, 4, '0', 0, NULL, 66, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1198, 131, 'Tyler', 'Huff', 1, 'QB', 'SR', NULL, 4, '0', 0, NULL, 66, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1199, 131, 'Clint', 'Goris', 10, 'QB', 'FR', NULL, 4, '0', 0, NULL, 66, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1200, 131, 'Everett', 'Polk', 38, 'TE', 'FR', NULL, 4, '0', 0, NULL, 66, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1201, 131, 'Dajwon', 'Deloach', 34, 'MLB', 'SO', NULL, 4, '0', 0, NULL, 66, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1202, 131, 'A.J.', 'Watkins', 36, 'FS', 'FR', NULL, 4, '0', 0, NULL, 65, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1203, 131, 'Amare', 'Grayson', 68, 'C', 'FR', NULL, 4, '0', 0, NULL, 65, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1204, 131, 'Marc', 'Woods', 42, 'SS', 'FR', NULL, 4, '0', 0, NULL, 65, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1205, 131, 'Will', 'Huber', 26, 'WR', 'SO', NULL, 4, '0', 0, NULL, 65, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1206, 131, 'Cai', 'Mayowa', 17, 'SS', 'SO', NULL, 4, '0', 0, NULL, 64, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1207, 131, 'Pearson', 'Baldwin', 19, 'TE', 'SO', NULL, 4, '0', 0, NULL, 64, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1208, 131, 'Andre', 'Devine', 10, 'HB', 'FR', NULL, 4, '0', 0, NULL, 64, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1209, 131, 'Walter', 'Reddick', 92, 'LE', 'FR', NULL, 4, '0', 0, NULL, 64, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1210, 131, 'Vincent', 'Henderson Jr.', 44, 'FS', 'FR', NULL, 4, '0', 0, NULL, 64, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1211, 131, 'Nick', 'Igbeare', 90, 'LE', 'FR', NULL, 4, '0', 0, NULL, 63, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1212, 131, 'Khristian', 'Lando', 6, 'HB', 'FR', NULL, 4, '0', 0, NULL, 63, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1213, 131, 'Jawaun', 'Campbell', 55, 'DT', 'FR', NULL, 4, '0', 0, NULL, 63, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1214, 131, 'Zechariah', 'Poyser', 18, 'FS', 'FR', NULL, 4, '0', 0, NULL, 62, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1215, 131, 'Daylan', 'Martin', 58, 'LG', 'FR', NULL, 4, '0', 0, NULL, 62, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1216, 131, 'Marvin', 'Lee', 76, 'LT', 'FR', NULL, 4, '0', 0, NULL, 62, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1217, 131, 'Zedric', 'Washington', 49, 'RE', 'FR', NULL, 4, '0', 0, NULL, 62, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1218, 131, 'Brock', 'Rechsteiner', 89, 'WR', 'JR', NULL, 4, '0', 0, NULL, 62, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1219, 131, 'Collin', 'Westfelt', 36, 'TE', 'JR', NULL, 4, '0', 0, NULL, 60, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1220, 131, 'Jamal', 'Siler', 56, 'LG', 'FR', NULL, 4, '0', 0, NULL, 60, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1221, 131, 'Jaleel', 'Birdsong', 48, 'LOLB', 'SO', NULL, 4, '0', 0, NULL, 60, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1222, 131, 'Cam', 'Vaughn', 18, 'WR', 'FR', NULL, 4, '0', 0, NULL, 60, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1223, 131, 'Aghogho', 'Eyafe', 87, 'WR', 'JR', NULL, 4, '0', 0, NULL, 59, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1224, 131, 'Ryland', 'Bragg', 51, 'C', 'FR', NULL, 4, '0', 0, NULL, 58, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1225, 131, 'Talan', 'Carter', 99, 'DT', 'FR', NULL, 4, '0', 0, NULL, 58, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1226, 131, 'Jeremiah', 'Colbert', 86, 'WR', 'FR', NULL, 4, '0', 0, NULL, 58, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1227, 131, 'Wyatt', 'Sonderman', 84, 'WR', 'FR', NULL, 4, '0', 0, NULL, 58, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1228, 131, 'Jaedon', 'Hill', 62, 'LT', 'FR', NULL, 4, '0', 0, NULL, 55, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1229, 131, 'Kam', 'Snell', 12, 'FS', 'SR', NULL, 4, '0', 0, NULL, 55, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1230, 131, 'Caden', 'Creel', 12, 'QB', 'FR', NULL, 4, '0', 0, NULL, 53, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1231, 131, 'Micah', 'McCarroll', 32, 'CB', 'FR', NULL, 4, '0', 0, NULL, 51, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1232, 131, 'Judson', 'Billings', 59, 'RG', 'FR', NULL, 4, '0', 0, NULL, 51, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1233, 131, 'Aidan', 'Thompson', 35, 'MLB', 'FR', NULL, 4, '0', 0, NULL, 51, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1234, 131, 'Travis', 'Franklin Jr.', 20, 'FS', 'SO', NULL, 4, '0', 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1235, 131, 'Nate', 'Smith', 72, 'RT', 'FR', NULL, 4, '0', 0, NULL, 50, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1236, 361, 'Donovan', 'Westmoreland', 96, 'LE', 'SO', NULL, 4, '0', 0, NULL, 79, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1237, 361, 'Donelius', 'Johnson', 48, 'MLB', 'SO', NULL, 4, '0', 0, NULL, 79, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1238, 361, 'Gabriel', 'Benyard', 1, 'HB', 'JR', NULL, 4, '0', 0, NULL, 78, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1239, 361, 'Baron', 'Hopson', 44, 'ROLB', 'JR', NULL, 4, '0', 0, NULL, 78, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1240, 361, 'Michael', 'Benefield', 0, 'HB', 'SR', NULL, 4, '0', 0, NULL, 78, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1241, 361, 'Jerico', 'Washington Jr.', 28, 'CB', 'FR', NULL, 4, '0', 0, NULL, 78, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1242, 361, 'Adam', 'Watkins', 97, 'DT', 'JR', NULL, 4, '0', 0, NULL, 77, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1243, 361, 'Joshua', 'Huiet', 90, 'P', 'JR', NULL, 4, '0', 0, NULL, 76, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1244, 361, 'Sidney', 'Porter', 11, 'FS', 'JR', NULL, 4, '0', 0, NULL, 76, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1245, 361, 'Christian', 'Moss', 6, 'WR', 'JR', NULL, 4, '0', 0, NULL, 76, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1246, 361, 'Nate', 'Wright', 71, 'LG', 'SO', NULL, 4, '0', 0, NULL, 75, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1247, 361, 'Jordan', 'Miles', 94, 'RE', 'JR', NULL, 4, '0', 0, NULL, 74, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1248, 361, 'Tyler', 'Hallum', 20, 'CB', 'JR', NULL, 4, '0', 0, NULL, 74, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1249, 361, 'Jamar', 'Rucks', 93, 'RE', 'JR', NULL, 4, '0', 0, NULL, 73, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1250, 361, 'Tylon', 'Dunlap', 50, 'LE', 'JR', NULL, 4, '0', 0, NULL, 73, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1251, 361, 'Isaac', 'Paul', 31, 'FS', 'FR', NULL, 4, '0', 0, NULL, 72, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1252, 361, 'Ethan', 'Newman', 72, 'LG', 'FR', NULL, 4, '0', 0, NULL, 71, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1253, 361, 'Carson', 'Kent', 86, 'TE', 'SO', NULL, 4, '0', 0, NULL, 71, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1254, 361, 'Jam', 'Warren', 36, 'SS', 'JR', NULL, 4, '0', 0, NULL, 70, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1255, 361, 'Blake', 'Bohannon', 5, 'WR', 'JR', NULL, 4, '0', 0, NULL, 70, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1256, 361, 'J.T.', 'Pennington', 65, 'LT', 'JR', NULL, 4, '0', 0, NULL, 70, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1257, 361, 'Zacchaeus', 'Williams', 60, 'RG', 'JR', NULL, 4, '0', 0, NULL, 70, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1258, 361, 'Brian', 'Habeck', 76, 'C', 'SO', NULL, 4, '0', 0, NULL, 70, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1259, 361, 'Kalari', 'Gordon', 70, 'RG', 'FR', NULL, 4, '0', 0, NULL, 70, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1260, 361, 'Garland', 'Benyard', 7, 'ROLB', 'JR', NULL, 4, '0', 0, NULL, 70, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1261, 361, 'Jacob', 'Kettles', 57, 'RT', 'SR', NULL, 4, '0', 0, NULL, 70, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1262, 361, 'Jalen', 'Barnum', 14, 'MLB', 'SR', NULL, 4, '0', 0, NULL, 69, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1263, 361, 'D.J.', 'Scott', 32, 'HB', 'FR', NULL, 4, '0', 0, NULL, 69, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1264, 361, 'Thomarius', 'Walker', 99, 'DT', 'JR', NULL, 4, '0', 0, NULL, 69, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1265, 361, 'Connor', 'Finer', 80, 'WR', 'JR', NULL, 4, '0', 0, NULL, 69, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1266, 361, 'Qua', 'Ashley', 30, 'HB', 'SO', NULL, 4, '0', 0, NULL, 69, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1267, 361, 'Dodge', 'Sauser', 75, 'LT', 'JR', NULL, 4, '0', 0, NULL, 69, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1268, 361, 'Tykeem', 'Wallace', 8, 'WR', 'JR', NULL, 4, '0', 0, NULL, 69, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1269, 361, 'Preston', 'Daniels', 2, 'TE', 'SR', NULL, 4, '0', 0, NULL, 68, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1270, 361, 'Cyrus', 'Dansby', 6, 'FS', 'JR', NULL, 4, '0', 0, NULL, 68, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1271, 361, 'Bryce', 'Dopson', 81, 'WR', 'FR', NULL, 4, '0', 0, NULL, 67, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1272, 361, 'Trey', 'Butts', 64, 'LT', 'SO', NULL, 4, '0', 0, NULL, 67, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1273, 361, 'Nick', 'Sawyer', 18, 'CB', 'SO', NULL, 4, '0', 0, NULL, 67, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1274, 361, 'Christopher', 'Cain', 62, 'RT', 'SO', NULL, 4, '0', 0, NULL, 67, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1275, 361, 'Ethan', 'O\'Leary', 17, 'FS', 'SO', NULL, 4, '0', 0, NULL, 66, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1276, 361, 'Terrence', 'Curtis', 39, 'CB', 'FR', NULL, 4, '0', 0, NULL, 65, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1277, 361, 'Juandarion', 'Silas', 49, 'LOLB', 'SO', NULL, 4, '0', 0, NULL, 65, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1278, 361, 'Javon', 'Rogers', 33, 'CB', 'FR', NULL, 4, '0', 0, NULL, 65, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1279, 361, 'Devin', 'Ross', 22, 'CB', 'FR', NULL, 4, '0', 0, NULL, 65, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1280, 361, 'Jaxon', 'Colvin', 43, 'LE', 'FR', NULL, 4, '0', 0, NULL, 65, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1281, 361, 'Rowan', 'Darnell', 85, 'TE', 'SO', NULL, 4, '0', 0, NULL, 65, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1282, 361, 'Britton', 'Williams', 78, 'K', 'JR', NULL, 4, '0', 0, NULL, 64, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1283, 361, 'Yesian', 'Clemons', 24, 'HB', 'SR', NULL, 4, '0', 0, NULL, 64, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1284, 361, 'Jarvis', 'Adams', 50, 'LG', 'FR', NULL, 4, '0', 0, NULL, 64, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1285, 361, 'Davis', 'Bryson', 9, 'QB', 'SO', NULL, 4, '0', 0, NULL, 63, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1286, 361, 'Jaiden', 'Kimble', 24, 'ROLB', 'FR', NULL, 4, '0', 0, NULL, 63, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1287, 361, 'Isaac', 'Cannizzaro', 59, 'C', 'FR', NULL, 4, '0', 0, NULL, 62, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1288, 361, 'Braden', 'Bohannon', 19, 'QB', 'SO', NULL, 4, '0', 0, NULL, 62, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1289, 361, 'Erik', 'Calvillo', 93, 'K', 'FR', NULL, 4, '0', 0, NULL, 62, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1290, 361, 'Jaiden', 'Grimes', 78, 'DT', 'FR', NULL, 4, '0', 0, NULL, 60, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1291, 361, 'Lucas', 'Scheerhorn', 3, 'QB', 'FR', NULL, 4, '0', 0, NULL, 60, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1292, 361, 'Isaiah', 'Williams', 89, 'TE', 'FR', NULL, 4, '0', 0, NULL, 60, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1293, 361, 'Havik', 'Pettigrew', 74, 'RG', 'SO', NULL, 4, '0', 0, NULL, 60, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1294, 144, 'Kaidon', 'Salter', 7, 'QB', 'JR', NULL, 4, '0', 0, NULL, 90, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1295, 144, 'Quinton', 'Cooley', 20, 'HB', 'SR', NULL, 4, '0', 0, NULL, 90, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1296, 144, 'Brylan', 'Green', 15, 'FS', 'JR', NULL, 4, '0', 0, NULL, 84, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1297, 144, 'Jordan', 'White', 53, 'LG', 'JR', NULL, 4, '0', 0, NULL, 83, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1298, 144, 'Bentley', 'Hanshaw', 15, 'TE', 'SR', NULL, 4, '0', 0, NULL, 82, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1299, 144, 'C.J.', 'Bazile Jr.', 11, 'RE', 'JR', NULL, 4, '0', 0, NULL, 82, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1300, 144, 'Treon', 'Sibley', 21, 'WR', 'SR', NULL, 4, '0', 0, NULL, 82, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1301, 144, 'T.J.', 'Bush', 3, 'LE', 'SO', NULL, 4, '0', 0, NULL, 81, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1302, 144, 'Quinton', 'Reese', 16, 'SS', 'SR', NULL, 4, '0', 0, NULL, 81, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1303, 144, 'Dominick', 'Hill', 13, 'CB', 'SR', NULL, 4, '0', 0, NULL, 80, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1304, 144, 'Billy', 'Lucas', 0, 'HB', 'SR', NULL, 4, '0', 0, NULL, 78, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1305, 144, 'Austin', 'Henderson', 83, 'TE', 'JR', NULL, 4, '0', 0, NULL, 78, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1306, 144, 'Amarian', 'Williams', 26, 'CB', 'JR', NULL, 4, '0', 0, NULL, 78, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1307, 144, 'Jerome', 'Jolly Jr.', 0, 'ROLB', 'SR', NULL, 4, '0', 0, NULL, 77, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1308, 144, 'Jacob', 'Jenkins', 84, 'TE', 'JR', NULL, 4, '0', 0, NULL, 77, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1309, 144, 'Bryce', 'Dixon', 99, 'DT', 'JR', NULL, 4, '0', 0, NULL, 77, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1310, 144, 'Tyson', 'Mobley', 8, 'WR', 'JR', NULL, 4, '0', 0, NULL, 76, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1311, 144, 'Jahmar', 'Brown', 9, 'ROLB', 'SR', NULL, 4, '0', 0, NULL, 76, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1312, 144, 'Jay', 'Hardy', 4, 'DT', 'SR', NULL, 4, '0', 0, NULL, 76, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1313, 144, 'Teylor', 'Jackson', 6, 'MLB', 'SR', NULL, 4, '0', 0, NULL, 76, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1314, 144, 'Chris', 'Boti', 92, 'DT', 'JR', NULL, 4, '0', 0, NULL, 76, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1315, 144, 'Eldric', 'Griffin', 2, 'SS', 'JR', NULL, 4, '0', 0, NULL, 75, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1316, 144, 'James', 'Jointer Jr.', 3, 'HB', 'SO', NULL, 4, '0', 0, NULL, 75, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1317, 144, 'Xavior', 'Gray', 63, 'RT', 'JR', NULL, 4, '0', 0, NULL, 75, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1318, 144, 'Nick', 'Brown', 42, 'K', 'JR', NULL, 4, '0', 0, NULL, 75, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1319, 144, 'Donte', 'Lee Jr.', 9, 'WR', 'SO', NULL, 4, '0', 0, NULL, 75, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1320, 144, 'Joshua', 'Wiggins', 8, 'CB', 'SO', NULL, 4, '0', 0, NULL, 74, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1321, 144, 'Reese', 'Smith', 6, 'WR', 'JR', NULL, 4, '0', 0, NULL, 74, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1322, 144, 'Brenton', 'Williams', 28, 'LOLB', 'FR', NULL, 4, '0', 0, NULL, 74, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1323, 144, 'Rod', 'Daniels', 18, 'LE', 'JR', NULL, 4, '0', 0, NULL, 74, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1324, 144, 'Vaughn', 'Blue', 24, 'HB', 'FR', NULL, 4, '0', 0, NULL, 74, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1325, 144, 'Aidan', 'Vaughan', 33, 'MLB', 'SO', NULL, 4, '0', 0, NULL, 74, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1326, 144, 'Bryson', 'Jennings', 17, 'RE', 'SO', NULL, 4, '0', 0, NULL, 74, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1327, 144, 'Dexter', 'Ricks Jr.', 20, 'CB', 'SO', NULL, 4, '0', 0, NULL, 74, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1328, 144, 'Joseph', 'Carter', 25, 'MLB', 'JR', NULL, 4, '0', 0, NULL, 73, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1329, 144, 'A\'Khori', 'Jones', 29, 'SS', 'JR', NULL, 4, '0', 0, NULL, 73, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1330, 144, 'Ethan', 'Crisp', 44, 'LOLB', 'SO', NULL, 4, '0', 0, NULL, 73, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1331, 144, 'Julian', 'Gray', 10, 'WR', 'JR', NULL, 4, '0', 0, NULL, 73, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1332, 144, 'Eli', 'Hall', 93, 'DT', 'SO', NULL, 4, '0', 0, NULL, 73, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1333, 144, 'Harrison', 'Hayes', 51, 'RG', 'JR', NULL, 4, '0', 0, NULL, 72, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1334, 144, 'Aaron', 'Fenimore', 61, 'C', 'FR', NULL, 4, '0', 0, NULL, 72, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1335, 144, 'Brian', 'Hannibal', 78, 'LG', 'JR', NULL, 4, '0', 0, NULL, 72, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1336, 144, 'Jack', 'Tucker', 75, 'LT', 'JR', NULL, 4, '0', 0, NULL, 71, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1337, 144, 'Marquis', 'Bell', 21, 'CB', 'JR', NULL, 4, '0', 0, NULL, 71, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1338, 144, 'Ryan', 'Burger', 18, 'QB', 'SO', NULL, 4, '0', 0, NULL, 70, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1339, 144, 'Victor', 'Jones Jr.', 13, 'WR', 'SO', NULL, 4, '0', 0, NULL, 70, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1340, 144, 'Elijah', 'Hopkins', 5, 'CB', 'SO', NULL, 4, '0', 0, NULL, 70, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1341, 144, 'Jamal', 'Miles', 19, 'CB', 'FR', NULL, 4, '0', 0, NULL, 70, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1342, 144, 'Kylen', 'Austin', 14, 'WR', 'JR', NULL, 4, '0', 0, NULL, 70, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1343, 144, 'Christian', 'Bodnar', 31, 'FS', 'FR', NULL, 4, '0', 0, NULL, 70, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1344, 144, 'Victor', 'Venn', 2, 'HB', 'SO', NULL, 4, '0', 0, NULL, 70, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1345, 144, 'Max', 'Morgan', 37, 'P', 'JR', NULL, 4, '0', 0, NULL, 70, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1346, 144, 'Markel', 'Fortenberry', 81, 'WR', 'SO', NULL, 4, '0', 0, NULL, 69, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1347, 144, 'Bryce', 'Cobb', 90, 'RE', 'JR', NULL, 4, '0', 0, NULL, 69, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1348, 144, 'Grey', 'Carroll', 49, 'LE', 'JR', NULL, 4, '0', 0, NULL, 69, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1349, 144, 'Andrew', 'Johnson', 77, 'C', 'JR', NULL, 4, '0', 0, NULL, 69, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1350, 144, 'Jayden', 'Bradford', 16, 'QB', 'FR', NULL, 4, '0', 0, NULL, 68, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1351, 144, 'Cal', 'Grubbs', 54, 'C', 'FR', NULL, 4, '0', 0, NULL, 68, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1352, 144, 'Larry', 'Jones III', 1, 'LE', 'SO', NULL, 4, '0', 0, NULL, 67, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1353, 144, 'Jayden', 'Sweeny', 22, 'SS', 'SO', NULL, 4, '0', 0, NULL, 67, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1354, 144, 'Jarron', 'Flowers', 38, 'LOLB', 'FR', NULL, 4, '0', 0, NULL, 67, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1355, 144, 'Alex', 'Oliver', 35, 'CB', 'SR', NULL, 4, '0', 0, NULL, 67, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1356, 144, 'Charles', 'Yates Jr.', 23, 'CB', 'SR', NULL, 4, '0', 0, NULL, 67, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1357, 144, 'Kaidon', 'Whidby', 24, 'MLB', 'FR', NULL, 4, '0', 0, NULL, 66, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1358, 144, 'Nick', 'Gonzalez', 71, 'RG', 'SO', NULL, 4, '0', 0, NULL, 66, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1359, 144, 'Bo', 'Burkow', 17, 'TE', 'FR', NULL, 4, '0', 0, NULL, 66, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1360, 144, 'Ronald', 'More', 10, 'CB', 'FR', NULL, 4, '0', 0, NULL, 65, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1361, 144, 'Izaiah', 'Taylor', 79, 'RT', 'FR', NULL, 4, '0', 0, NULL, 65, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1362, 144, 'Josh', 'Gatewodd', 64, 'LG', 'FR', NULL, 4, '0', 0, NULL, 65, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1363, 144, 'Colin', 'Karhu', 98, 'K', 'SR', NULL, 4, '0', 0, NULL, 65, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1364, 144, 'Blake', 'Heckmann', 50, 'LT', 'FR', NULL, 4, '0', 0, NULL, 65, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1365, 144, 'Devin', 'Henderson', 7, 'SS', 'FR', NULL, 4, '0', 0, NULL, 65, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1366, 144, 'Austin', 'Anderson', 70, 'RT', 'FR', NULL, 4, '0', 0, NULL, 65, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1367, 144, 'Kristyane', 'Gregory', 53, 'DT', 'FR', NULL, 4, '0', 0, NULL, 64, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1368, 144, 'Caden', 'Williams', 23, 'HB', 'FR', NULL, 4, '0', 0, NULL, 64, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1369, 144, 'Connie', 'Hewitt II', 84, 'TE', 'FR', NULL, 4, '0', 0, NULL, 64, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1370, 144, 'Eli', 'Sisson', 19, 'TE', 'FR', NULL, 4, '0', 0, NULL, 64, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1371, 144, 'Rex', 'Lahr', 52, 'LG', 'FR', NULL, 4, '0', 0, NULL, 62, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1372, 144, 'Mack', 'Johnston', 20, 'WR', 'SO', NULL, 4, '0', 0, NULL, 62, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1373, 144, 'Donovan', 'Dozier', 55, 'LE', 'FR', NULL, 4, '0', 0, NULL, 62, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1374, 144, 'Elijah', 'Auguste', 14, 'FS', 'JR', NULL, 4, '0', 0, NULL, 59, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1375, 144, 'Seneca', 'Moore', 35, 'LOLB', 'FR', NULL, 4, '0', 0, NULL, 58, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1376, 144, 'Austin', 'Turner', 44, 'TE', 'JR', NULL, 4, '0', 0, NULL, 58, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1377, 144, 'Jeremy', 'Browning', 87, 'WR', 'FR', NULL, 4, '0', 0, NULL, 57, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1378, 144, 'Brandon', 'Payne', 86, 'WR', 'FR', NULL, 4, '0', 0, NULL, 56, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1381, 4, 'Jalen', 'Milroe', NULL, NULL, NULL, NULL, 4, '0', 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1382, 163, 'Braylon', 'Braxton', NULL, NULL, NULL, NULL, 15, '0', 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1383, 996957, 'Zach', 'Marker', NULL, NULL, NULL, NULL, 15, '0', 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1384, 996957, 'Kaelin', 'Costello', NULL, NULL, NULL, NULL, 15, '0', 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(1385, 163, 'Jordan', 'Houston', NULL, NULL, NULL, NULL, 15, '0', 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `dynsch`
--

CREATE TABLE `dynsch` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `seasonid` int(11) NOT NULL,
  `ishome` int(11) NOT NULL,
  `oppid` int(11) NOT NULL,
  `myscore` int(11) NOT NULL,
  `oppscore` int(11) NOT NULL,
  `location` varchar(50) DEFAULT NULL,
  `gamedate` datetime DEFAULT NULL,
  `week` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dynsch`
--

INSERT INTO `dynsch` (`id`, `seasonid`, `ishome`, `oppid`, `myscore`, `oppscore`, `location`, `gamedate`, `week`) VALUES
(2, 4, 1, 132, 21, 17, 'Bowling Green, KY', '2024-08-31 18:00:00', 0),
(4, 4, 1, 278, 0, 0, 'Bowling Green, KY', '2024-09-14 18:00:00', 2),
(9, 4, 1, 170, 0, 0, 'Bowling Green, KY', '2024-09-07 17:00:00', 1),
(10, 4, 0, 16, 0, 0, 'West Point, NY', '2024-09-21 15:30:00', 3),
(11, 4, 0, 316, 0, 0, 'New Orleans, LA', '2024-09-28 15:30:00', 4),
(12, 4, 0, 318, 0, 0, 'Birmingham, AL', '2024-10-05 15:30:00', 5),
(13, 4, 1, 89, 0, 0, 'Bowling Green, KY', '2024-10-12 15:30:00', 6),
(14, 4, 1, 317, 0, 0, 'Bowling Green, KY', '2024-10-19 15:30:00', 7),
(15, 4, 1, 77, 0, 0, 'Bowling Green, KY', '2024-11-02 15:30:00', 9),
(16, 4, 1, 138, 0, 0, 'Bowling Green, KY', '2024-11-09 11:00:00', 11),
(17, 4, 1, 173, 0, 0, 'Miami, FL', '2024-11-16 11:00:00', 12),
(18, 4, 1, 144, 0, 0, 'Bowling Green, KY', '2024-11-23 11:00:00', 13),
(19, 15, 1, 163, 0, 0, 'Newark, DE', '2024-08-31 18:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dynseasons`
--

CREATE TABLE `dynseasons` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `dynastyid` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `teamid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dynseasons`
--

INSERT INTO `dynseasons` (`id`, `dynastyid`, `year`, `teamid`) VALUES
(4, 2, 2024, 352),
(15, 21, 2024, 996957);

-- --------------------------------------------------------

--
-- Table structure for table `dynstandings`
--

CREATE TABLE `dynstandings` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `seasonid` int(11) NOT NULL,
  `confid` int(11) NOT NULL,
  `teamid` int(11) NOT NULL,
  `win` int(11) DEFAULT 0,
  `loss` int(11) DEFAULT 0,
  `confwin` int(11) DEFAULT 0,
  `confloss` int(11) DEFAULT 0,
  `week` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dynstandings`
--

INSERT INTO `dynstandings` (`id`, `seasonid`, `confid`, `teamid`, `win`, `loss`, `confwin`, `confloss`, `week`) VALUES
(57, 4, 4, 77, 0, 0, 0, 0, 1),
(58, 4, 4, 89, 0, 0, 0, 0, 1),
(59, 4, 4, 170, 0, 0, 0, 0, 1),
(60, 4, 4, 191, 0, 0, 0, 0, 1),
(61, 4, 4, 210, 0, 0, 0, 0, 1),
(62, 4, 4, 249, 0, 0, 0, 0, 1),
(63, 4, 4, 271, 0, 0, 0, 0, 1),
(64, 4, 4, 278, 0, 0, 0, 0, 1),
(65, 4, 4, 298, 0, 0, 0, 0, 1),
(66, 4, 4, 316, 0, 0, 0, 0, 1),
(67, 4, 4, 317, 0, 0, 0, 0, 1),
(68, 4, 4, 318, 0, 0, 0, 0, 1),
(69, 4, 4, 352, 1, 0, 0, 0, 1),
(70, 4, 4, 177, 0, 0, 0, 0, 1),
(71, 15, 35, 10, 0, 0, 0, 0, 1),
(72, 15, 35, 14, 0, 0, 0, 0, 1),
(73, 15, 35, 56, 0, 0, 0, 0, 1),
(74, 15, 35, 101, 0, 0, 0, 0, 1),
(75, 15, 35, 102, 0, 0, 0, 0, 1),
(76, 15, 35, 132, 0, 0, 0, 0, 1),
(77, 15, 35, 151, 0, 0, 0, 0, 1),
(78, 15, 35, 153, 0, 0, 0, 0, 1),
(79, 15, 35, 163, 0, 0, 0, 0, 1),
(80, 15, 35, 226, 0, 0, 0, 0, 1),
(81, 15, 35, 272, 0, 0, 0, 0, 1),
(82, 15, 35, 284, 0, 0, 0, 0, 1),
(83, 15, 35, 308, 0, 0, 0, 0, 1),
(84, 15, 35, 315, 0, 0, 0, 0, 1),
(85, 15, 35, 996957, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dynteams`
--

CREATE TABLE `dynteams` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `name` varchar(75) DEFAULT NULL,
  `mascot` varchar(75) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `color` varchar(8) DEFAULT NULL,
  `confid` int(11) DEFAULT NULL,
  `logo` int(11) DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  `dynastyid` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dynteams`
--

INSERT INTO `dynteams` (`id`, `name`, `mascot`, `location`, `color`, `confid`, `logo`, `rank`, `dynastyid`) VALUES
(2, 'Air Force', 'Falcons', 'Colorado Springs, CO', '0033a0', 25, 21423, 0, 0),
(3, 'Akron', 'Zips', 'Akron, OH', '041e42', 22, 21264, 0, 0),
(4, 'Alabama', 'Crimson Tide', 'Tuscaloosa, AL', 'a60c31', 30, 21352, 5, 0),
(10, 'Appalachian State', 'Mountaineers', 'Boone, NC', '222222', 35, 21364, 0, 0),
(11, 'Arizona', 'Wildcats', 'Phoenix, AZ', '002147', 28, 21335, 0, 0),
(12, 'Arizona State', 'Sun Devils', 'Tempe, AZ', '3e0c3a', 28, 21336, 0, 0),
(13, 'Arkansas', 'Razorbacks', 'Fayetteville, AK', '9d2235', 30, 21353, 0, 0),
(14, 'Arkansas State', 'Red Wolves', 'Jonesboro, AK', 'cc092f', 35, 21398, 0, 0),
(16, 'Army', 'Black Knights', 'West Point, NY', 'd4bf91', 15, 21345, 0, 0),
(17, 'Auburn', 'Tigers', 'Auburn, AL', '03244d', 30, 21354, 0, 0),
(19, 'Ball State', 'Cardinals', 'Muncie, IN', 'ba0c2f', 22, 21265, 0, 0),
(20, 'Baylor', 'Bears', 'Waco, TX', '1c3c34', 6, 21201, 0, 0),
(25, 'Boise State', 'Broncos', 'Boise, ID', '0033a0', 25, 21213, 0, 0),
(27, 'Boston College', 'Eagles', 'Boston, MA', '98002E', 1, 21160, 0, 0),
(28, 'Bowling Green', 'Falcons', 'Bowling Green, OH', '4f2c1d', 22, 21266, 0, 0),
(33, 'Buffalo', 'Bulls', 'Buffalo, NY', '005bbb', 22, 21267, 0, 0),
(35, 'BYU', 'Cougars', 'Provo, UT', '002255', 6, 21424, 0, 0),
(40, 'California', 'Golden Bears', 'Berkley, CA', '041e42', 28, 21337, 0, 0),
(46, 'Central Florida', 'Golden Knights', 'Orlando, FL', 'b7a369', 6, 21406, 0, 0),
(47, 'Central Michigan', 'Chippewas', 'Mount Pleasant, MI', '6a0032', 22, 21268, 0, 0),
(50, 'Charlotte', '49ers', 'Charlotte, NC', '046A38', 4, 21241, 0, 0),
(53, 'Cincinnati', 'Bearcats', 'Cincinnati, OH', 'e00122', 6, 21235, 0, 0),
(54, 'Clemson', 'Tigers', 'Clemson, SC', 'F66733', 1, 21129, 0, 0),
(56, 'Coastal Carolina', 'Chanticleers', 'Conway, SC', '006f71', 35, 21183, 0, 0),
(58, 'Colorado', 'Buffaloes', 'Boulder, CO', '000000', 28, 21202, 0, 0),
(59, 'Colorado State', 'Rams', 'Fort Collins, CO', '1e4d2b', 25, 21425, 0, 0),
(61, 'Connecticut', 'Huskies', 'Storrs, CT', '000e2f', 15, 21161, 0, 0),
(75, 'Duke', 'Blue Devils', 'Durham, NC', '001A57', 1, 21130, 0, 0),
(77, 'East Carolina', 'Pirates', 'Greenville, NC', '592A8A', 4, 21226, 0, 0),
(81, 'Eastern Michigan', 'Eagles', 'Ypsilanti, MI', '046a38', 22, 21269, 0, 0),
(87, 'Florida', 'Gators', 'Gainesville, FL', '003087', 30, 21355, 0, 0),
(89, 'Florida Atlantic', 'Owls', 'Boca Raton, FL', '003366', 4, 21407, 0, 0),
(91, 'Florida International', 'Golden Panthers', 'Miami, FL', '081E3F', 14, 21399, 0, 0),
(92, 'Florida State', 'Seminoles', 'Tallahassee, FL', '782F40', 1, 21131, 0, 0),
(94, 'Fresno State', 'Bulldogs', 'Fresno, CA', '00235d', 25, 21426, 0, 0),
(100, 'Georgia', 'Bulldogs', 'Athens, GA', 'ba0c2f', 30, 21356, 4, 0),
(101, 'Georgia Southern', 'Eagles', 'Statesboro, GA', '011e41', 35, 21371, 0, 0),
(102, 'Georgia State', 'Panthers', 'Atlanta, GA', '0039a6', 35, 21408, 0, 0),
(103, 'Georgia Tech', 'Yellow Jackets', 'Atlanta, GA', 'EEB211', 1, 21132, 0, 0),
(110, 'Hawaii', 'Rainbow Warriors', 'Honolulu, HI', '00BB00', 25, 21427, 0, 0),
(114, 'Houston', 'Cougars', 'Houston, TX', 'c92a39', 6, 21237, 0, 0),
(119, 'Illinois', 'Fighting Illini', 'Champaign, IL', 'e84a27', 11, 21190, 0, 0),
(123, 'Indiana', 'Hoosiers', 'Bloomington, IN', '990000', 11, 21191, 0, 0),
(126, 'Iowa', 'Hawkeyes', 'Iowa City, IA', '000000', 11, 21192, 0, 0),
(127, 'Iowa State', 'Cyclones', 'Aimes, IA', '822433', 6, 21203, 0, 0),
(131, 'Jacksonville State', 'Gamecocks', 'Jacksonville, AL', 'CC0000', 14, 21409, 0, 0),
(132, 'James Madison', 'Dukes', 'Harrisonburg, VA', '450084', 35, 21228, 0, 0),
(133, 'Kansas', 'Jayhawks', 'Lawrence, KS', '0051ba', 6, 21204, 0, 0),
(135, 'Kansas State', 'Wildcats', 'Manhattan, KS', '512888', 6, 21205, 0, 0),
(137, 'Kent State', 'Golden Flashes', 'Kent, OH', '003875', 22, 21270, 0, 0),
(138, 'Kentucky', 'Wildcats', 'Lexington, KY', '0033a0', 30, 21357, 0, 0),
(144, 'Liberty', 'Flames', 'Lynchburg, VA', '002D62', 14, 21184, 0, 0),
(151, 'Louisiana', 'Ragin Cajuns', 'Lafayette, LA', 'd11c2e', 35, 21402, 0, 0),
(152, 'Louisiana Tech', 'Bulldogs', 'Ruston, LA', 'E31B23', 14, 21400, 0, 0),
(153, 'Louisiana-Monroe', 'Warhawks', 'Monroe, LA', '', 35, 21378, 0, 0),
(154, 'Louisville', 'Cardinals', 'Louisville, KY', 'AD0000', 1, 21238, 0, 0),
(158, 'LSU', 'Tigers', 'Baton Rogue, LA', '461d7c', 30, 21358, 0, 0),
(163, 'Marshall', 'Thundering Herd', 'Huntington, WV', '00b140', 35, 21272, 0, 0),
(164, 'Maryland', 'Terrapins', 'College Park, MD', 'cf102d', 11, 21133, 0, 0),
(170, 'Memphis', 'Tigers', 'Memphis, TN', '003087', 4, 21240, 0, 0),
(173, 'Miami', 'Hurricanes', 'Miami, FL', 'F47321', 1, 21163, 0, 0),
(174, 'Miami (OH)', 'Redhawks', 'Miami, OH', 'b61e2e', 22, 21271, 0, 0),
(175, 'Michigan', 'Wolverines', 'Ann Arbor, MI', '00274c', 11, 21193, 1, 0),
(176, 'Michigan State', 'Spartans', 'East Lansing, MI', '18453b', 11, 21194, 0, 0),
(177, 'Middle Tennessee St', 'Blue Raiders', 'Murfreesboro, TN', '006DB6', 14, 21328, 0, 0),
(179, 'Minnesota', 'Golden Gophers', 'Minneapolis, MN', '862334', 11, 21195, 0, 0),
(180, 'Mississippi State', 'Bulldogs', 'Starkville, MI', '660000', 30, 21360, 0, 0),
(182, 'Missouri', 'Tigers', 'Columbia, MO', 'c69214', 30, 21206, 0, 0),
(191, 'Navy', 'Midshipmen', 'Annapolis, MD', '00205B', 4, 21351, 0, 0),
(192, 'Nebraska', 'Cornhuskers', 'Lincoln, NE', 'e41c38', 11, 21207, 0, 0),
(193, 'Nevada', 'Wolf Pack', 'Reno, NV', '011e41', 25, 21219, 0, 0),
(196, 'New Mexico', 'Lobos', 'Albuquerque, NM', 'ba0c2f', 25, 21429, 0, 0),
(197, 'New Mexico State', 'Aggies', 'Las Cruces, NM', '861F41', 14, 21220, 0, 0),
(203, 'North Carolina', 'Tarheels', 'Chapel Hill, NC', '4B9CD3', 1, 21134, 0, 0),
(206, 'North Carolina State', 'Wolfpack', 'Raleigh, NC', 'CC0000', 1, 21135, 0, 0),
(210, 'North Texas', 'Mean Green', 'Denton, TX', '00853E', 4, 21221, 0, 0),
(214, 'Northern Illinois', 'Huskies', 'Dekalb, IL', 'ba0c2f', 22, 21273, 0, 0),
(217, 'Northwestern', 'Wildcats', 'Chicago, IL', '492f92', 11, 21196, 0, 0),
(219, 'Notre Dame', 'Fighting Irish', 'South Bend, IN', '001441', 15, 21164, 0, 0),
(221, 'Ohio', 'Bobcats', 'Athens, OH', '00694e', 22, 21274, 0, 0),
(223, 'Ohio State', 'Buckeyes', 'Columbus, OH', 'C20F2F', 11, 21197, 0, 0),
(224, 'Oklahoma', 'Sooners', 'Norman, OK', '841617', 6, 21208, 0, 0),
(225, 'Oklahoma State', 'Cowboys', 'Oklahoma City, OK', 'ff6600', 6, 21209, 0, 0),
(226, 'Old Dominion', 'Monarchs', 'Richmond, VA', '00325b', 35, 21230, 0, 0),
(227, 'Ole Miss', 'Rebels', 'Oxford, MI', '14213d', 30, 21359, 0, 0),
(230, 'Oregon', 'Ducks', 'Eugene, OR', '008000', 28, 21338, 0, 0),
(231, 'Oregon State', 'Beavers', 'Corvallis, OR', 'dc4405', 28, 21339, 0, 0),
(233, 'Penn State', 'Nittany Lions', 'University Park, PA', '002D62', 11, 21198, 0, 0),
(236, 'Pittsburgh', 'Panthers', 'Pittsburgh, PA', '003594', 1, 21165, 0, 0),
(243, 'Purdue', 'Boilermakers', 'West Lafayette, IN', '9d968d', 11, 21199, 0, 0),
(249, 'Rice', 'Owls', 'Houston, TX', '00205B', 4, 21430, 0, 0),
(253, 'Rutgers', 'Scarlet Knights', 'Pascataway, NJ', 'cf102d', 11, 21167, 0, 0),
(260, 'Sam Houston State', 'Bearkats', 'Houston, TX', 'FE5100', 14, 21381, 0, 0),
(263, 'San Diego State', 'Aztecs', 'San Diego, CA', 'c41230', 25, 21431, 0, 0),
(265, 'San Jose State', 'Spartans', 'San Jose, CA', '4d90cd', 25, 21432, 0, 0),
(271, 'SMU', 'Mustangs', 'Dallas, TX', '0033A0', 4, 21433, 0, 0),
(272, 'South Alabama', 'Jaguars', 'Mobile, AL', 'bf0d3e', 35, 21401, 0, 0),
(273, 'South Carolina', 'Gamecocks', 'Columbia, SC', '73000a', 30, 21361, 0, 0),
(278, 'South Florida', 'Bulls', 'Tampa, FL', '006747', 4, 21243, 0, 0),
(284, 'Southern Mississippi', 'Golden Eagles', 'Hattisburg, MI', '000000', 35, 21242, 0, 0),
(290, 'Stanford', 'Cardinal', 'Palo Alto, CA', '8c1515', 28, 21340, 0, 0),
(295, 'Syracuse', 'Orange', 'Syracuse, NY', 'D44500', 1, 21170, 0, 0),
(297, 'TCU', 'Horned Frogs', 'Fort Worth, TX', '4d1979', 6, 21434, 0, 0),
(298, 'Temple', 'Owls', 'Philadelphia, PA', '9D2235', 4, 21147, 0, 0),
(299, 'Tennessee', 'Volunteers', 'Knoxville, TN', 'ff8200', 30, 21362, 0, 0),
(303, 'Texas', 'Longhorns', 'Austin, TX', 'bf5700', 6, 21210, 3, 0),
(304, 'Texas A&M', 'Aggies', 'College Station, TX', '500000', 30, 21211, 0, 0),
(308, 'Texas State', 'Bobcats', 'San Marcos, TX', '501214', 35, 21384, 0, 0),
(309, 'Texas Tech', 'Red Raiders', 'Lubbock, TX', 'cc0000', 6, 21212, 0, 0),
(310, 'Texas-El Paso', 'Miners', 'El Paso, TX', 'FF8200', 14, 21435, 0, 0),
(311, 'Texas-San Antonio', 'Roadrunners', 'San Antonio, TX', 'F15A22', 4, 21385, 0, 0),
(313, 'Toledo', 'Rockets', 'Toledo, OH', '15397f', 22, 21275, 0, 0),
(315, 'Troy', 'Trojans', 'Troy, AL', '6d0017', 35, 21414, 0, 0),
(316, 'Tulane', 'Green Wave', 'Tulane, LA', '006747', 4, 21245, 0, 0),
(317, 'Tulsa', 'Golden Hurricane', 'Tulsa, OK', '002D72', 4, 21436, 0, 0),
(318, 'UAB', 'Blazers', 'Birmingham, AL', '006341', 4, 21234, 0, 0),
(324, 'UCLA', 'Bruins', 'Pasadena, CA', '2d68c4', 28, 21341, 0, 0),
(328, 'UNLV', 'Runnin Rebels', 'Las Vegas, NV', 'cf0a2c', 25, 21428, 0, 0),
(329, 'USC', 'Trojans', 'Los Angeles, CA', '9d2235', 28, 21342, 0, 0),
(332, 'Utah', 'Utes', 'Salt Lake City, UT', 'cc0000', 28, 21437, 0, 0),
(333, 'Utah State', 'Aggies', 'Provo, UT', '002a42', 25, 21224, 0, 0),
(337, 'Vanderbilt', 'Commodores', 'Nashville, TN', 'a8996e', 30, 21363, 0, 0),
(340, 'Virginia', 'Cavaliers', 'Charlottesville, VA', '232D4B', 1, 21136, 0, 0),
(342, 'Virginia Tech', 'Hokies', 'Lynchburg, VA', '08A1E4', 1, 21148, 0, 0),
(345, 'Wake Forest', 'Demon Deacons', 'Winston-Salem, NC', 'A67F31', 1, 21137, 0, 0),
(346, 'Washington', 'Huskies', 'Seattle, WA', '4b0082', 28, 21343, 2, 0),
(347, 'Washington State', 'Cougars', 'Pulman, WA', '981e32', 28, 21344, 0, 0),
(349, 'West Virginia', 'Mountaineers', 'Charleston, WV', '002855', 6, 21172, 0, 0),
(352, 'Western Kentucky', 'Hilltoppers', 'Bowling Green, KY', 'C60C30', 14, 21403, 0, 0),
(353, 'Western Michigan', 'Broncos', 'Kalamazoo, MI', '231f20', 22, 21276, 0, 0),
(357, 'Wisconsin', 'Badgers', 'Madison, WI', 'c4012f', 11, 21200, 0, 0),
(360, 'Wyoming', 'Cowboys', 'Laramie, WY', '492f24', 25, 21438, 0, 0),
(361, 'Kennesaw State', 'Owls', 'Kennesaw, GA', 'FDBB30', 14, 160937, 0, 0),
(996957, 'Delaware', 'Blue Hens', 'Newark, DE', '009DDB', 35, 996957, NULL, 21);

-- --------------------------------------------------------

--
-- Table structure for table `dynuser`
--

CREATE TABLE `dynuser` (
  `id` int(11) NOT NULL COMMENT 'user id',
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(25) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `image` varchar(50) DEFAULT 'blank',
  `isadmin` bit(1) DEFAULT NULL,
  `ispremium` bit(1) DEFAULT b'0',
  `created` datetime DEFAULT NULL COMMENT 'Create Time'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dynuser`
--

INSERT INTO `dynuser` (`id`, `username`, `password`, `email`, `phone`, `image`, `isadmin`, `ispremium`, `created`) VALUES
(1, 'markus73', 'Hilltopper#95', 'themark712@gmail.com', NULL, 'blank', b'1', b'1', '2024-07-19 12:01:35'),
(2, 'prince', 'prince', 'prince@gmail.com', NULL, 'blank', NULL, b'0', '2024-07-23 09:21:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dynarticles`
--
ALTER TABLE `dynarticles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dynasty`
--
ALTER TABLE `dynasty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dynconf`
--
ALTER TABLE `dynconf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dyncustomconf`
--
ALTER TABLE `dyncustomconf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dyngamestats`
--
ALTER TABLE `dyngamestats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dynmessages`
--
ALTER TABLE `dynmessages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dynpstatsdefense`
--
ALTER TABLE `dynpstatsdefense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dynpstatspassing`
--
ALTER TABLE `dynpstatspassing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dynpstatsreceiving`
--
ALTER TABLE `dynpstatsreceiving`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dynpstatsrushing`
--
ALTER TABLE `dynpstatsrushing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dynpstatsturnovers`
--
ALTER TABLE `dynpstatsturnovers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dynroster`
--
ALTER TABLE `dynroster`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dynsch`
--
ALTER TABLE `dynsch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dynseasons`
--
ALTER TABLE `dynseasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dynstandings`
--
ALTER TABLE `dynstandings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dynteams`
--
ALTER TABLE `dynteams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dynuser`
--
ALTER TABLE `dynuser`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dynarticles`
--
ALTER TABLE `dynarticles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `dynasty`
--
ALTER TABLE `dynasty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `dynconf`
--
ALTER TABLE `dynconf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `dyncustomconf`
--
ALTER TABLE `dyncustomconf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `dyngamestats`
--
ALTER TABLE `dyngamestats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `dynmessages`
--
ALTER TABLE `dynmessages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `dynpstatsdefense`
--
ALTER TABLE `dynpstatsdefense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dynpstatspassing`
--
ALTER TABLE `dynpstatspassing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `dynpstatsreceiving`
--
ALTER TABLE `dynpstatsreceiving`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dynpstatsrushing`
--
ALTER TABLE `dynpstatsrushing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `dynpstatsturnovers`
--
ALTER TABLE `dynpstatsturnovers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dynroster`
--
ALTER TABLE `dynroster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=1386;

--
-- AUTO_INCREMENT for table `dynsch`
--
ALTER TABLE `dynsch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `dynseasons`
--
ALTER TABLE `dynseasons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `dynstandings`
--
ALTER TABLE `dynstandings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `dynteams`
--
ALTER TABLE `dynteams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=996958;

--
-- AUTO_INCREMENT for table `dynuser`
--
ALTER TABLE `dynuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'user id', AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
