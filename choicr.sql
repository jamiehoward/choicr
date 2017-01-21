-- phpMyAdmin SQL Dump
-- version 4.1.14.8
-- http://www.phpmyadmin.net
--
-- Host: db2923.perfora.net
-- Generation Time: Jan 27, 2016 at 02:58 PM
-- Server version: 5.1.73-log
-- PHP Version: 5.4.45-0+deb7u2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db364419295`
--

-- --------------------------------------------------------

--
-- Table structure for table `Activity`
--

CREATE TABLE IF NOT EXISTS `Activity` (
  `dbActivityCnt` int(10) NOT NULL AUTO_INCREMENT,
  `dbUsrCnt` mediumint(7) NOT NULL,
  `dbActivityType` tinyint(3) NOT NULL,
  `dbActivityID` mediumint(7) NOT NULL,
  `dbActivityDetail` varchar(140) COLLATE latin1_general_ci DEFAULT NULL,
  `dbActivityDate` datetime NOT NULL,
  PRIMARY KEY (`dbActivityCnt`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `Activity`
--

INSERT INTO `Activity` (`dbActivityCnt`, `dbUsrCnt`, `dbActivityType`, `dbActivityID`, `dbActivityDetail`, `dbActivityDate`) VALUES
(1, 1, 1, 9, NULL, '2011-11-04 22:10:19'),
(2, 1, 1, 10, NULL, '2011-11-11 13:28:03'),
(3, 1, 1, 11, NULL, '2011-11-21 20:48:48');

-- --------------------------------------------------------

--
-- Table structure for table `BadgeDetail`
--

CREATE TABLE IF NOT EXISTS `BadgeDetail` (
  `dbBadgeCnt` tinyint(3) NOT NULL AUTO_INCREMENT,
  `dbBadgeTitle` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `dbBadgeDesc` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `dbBadgeImg` varchar(50) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`dbBadgeCnt`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Badges`
--

CREATE TABLE IF NOT EXISTS `Badges` (
  `dbBdgCnt` mediumint(7) NOT NULL AUTO_INCREMENT,
  `dbBdgID` tinyint(3) NOT NULL,
  `dbUsrCnt` mediumint(7) NOT NULL,
  `dbAddDate` datetime NOT NULL,
  PRIMARY KEY (`dbBdgCnt`),
  KEY `dbUsrCnt` (`dbUsrCnt`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Bad_Words`
--

CREATE TABLE IF NOT EXISTS `Bad_Words` (
  `dbBadCnt` tinyint(3) NOT NULL AUTO_INCREMENT,
  `dbBadWord` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `dbBadDisplay` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `dbUsrCnt` mediumint(7) NOT NULL,
  PRIMARY KEY (`dbBadCnt`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Beta_Requests`
--

CREATE TABLE IF NOT EXISTS `Beta_Requests` (
  `dbRequestCnt` smallint(5) NOT NULL AUTO_INCREMENT,
  `dbEmailAddress` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `dbRequestReason` text COLLATE latin1_general_ci,
  `dbRequestDate` datetime NOT NULL,
  `dbInviteDate` datetime DEFAULT NULL,
  PRIMARY KEY (`dbRequestCnt`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Categories`
--

CREATE TABLE IF NOT EXISTS `Categories` (
  `dbCatCnt` tinyint(3) NOT NULL AUTO_INCREMENT,
  `dbCatName` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `dbCatDesc` text COLLATE latin1_general_ci NOT NULL,
  `dbCatColor` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `dbAddDate` datetime NOT NULL,
  `dbModDate` datetime NOT NULL,
  PRIMARY KEY (`dbCatCnt`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `Categories`
--

INSERT INTO `Categories` (`dbCatCnt`, `dbCatName`, `dbCatDesc`, `dbCatColor`, `dbAddDate`, `dbModDate`) VALUES
(1, 'Fashion', '', '9f1f63', '2011-10-03 00:00:00', '2011-11-06 00:00:00'),
(2, 'Food', '', '551011', '2011-10-03 00:00:00', '0000-00-00 00:00:00'),
(3, 'Gaming', '', 'e76f34', '2011-10-03 00:00:00', '0000-00-00 00:00:00'),
(4, 'Lifestyle', '', '74b74a', '2011-10-03 00:00:00', '0000-00-00 00:00:00'),
(5, 'Music', '', 'bfd73b', '2011-10-03 00:00:00', '0000-00-00 00:00:00'),
(6, 'Other', '', '58b7dd', '2011-10-03 00:00:00', '0000-00-00 00:00:00'),
(7, 'Sports', '', 'ef4136', '2011-10-03 00:00:00', '0000-00-00 00:00:00'),
(8, 'Tech', '', 'd7df63', '2011-10-03 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Choices`
--

CREATE TABLE IF NOT EXISTS `Choices` (
  `dbChcCnt` mediumint(7) NOT NULL AUTO_INCREMENT,
  `dbCtrlNumber` mediumint(7) NOT NULL,
  `dbUsrCnt` mediumint(7) NOT NULL,
  `dbChcTitle` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `dbChcDesc` varchar(1000) COLLATE latin1_general_ci NOT NULL,
  `dbChcPic` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `dbAddDate` datetime NOT NULL,
  `dbModDate` datetime NOT NULL,
  PRIMARY KEY (`dbChcCnt`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `Choices`
--

INSERT INTO `Choices` (`dbChcCnt`, `dbCtrlNumber`, `dbUsrCnt`, `dbChcTitle`, `dbChcDesc`, `dbChcPic`, `dbAddDate`, `dbModDate`) VALUES
(1, 0, 1, 'Default', 'Mocha', '0', '2011-11-04 20:45:21', '0000-00-00 00:00:00'),
(2, 0, 1, 'Default', 'Latte', '0', '2011-11-04 20:45:21', '0000-00-00 00:00:00'),
(3, 1, 1, 'Default', 'dsf', '0', '2011-11-04 21:22:28', '0000-00-00 00:00:00'),
(4, 2, 1, 'Default', 'sdf', '0', '2011-11-04 21:22:28', '0000-00-00 00:00:00'),
(5, 3, 1, 'Default', 'sdfsdf', '0', '2011-11-04 21:50:16', '0000-00-00 00:00:00'),
(6, 4, 1, 'Default', 'sdfsdf', '0', '2011-11-04 21:50:16', '0000-00-00 00:00:00'),
(7, 5, 1, 'Default', 'sdfsdf', '0', '2011-11-04 21:53:24', '0000-00-00 00:00:00'),
(8, 6, 1, 'Default', 'sdfsdf', '0', '2011-11-04 21:53:24', '0000-00-00 00:00:00'),
(9, 7, 1, 'Default', 'sdfsdf', '0', '2011-11-04 22:00:40', '0000-00-00 00:00:00'),
(10, 8, 1, 'Default', 'sdfsdf', '0', '2011-11-04 22:00:40', '0000-00-00 00:00:00'),
(11, 9, 1, 'Default', 'sdfdsf', '0', '2011-11-04 22:08:05', '0000-00-00 00:00:00'),
(12, 10, 1, 'Default', 'sdfsdf', '0', '2011-11-04 22:08:05', '0000-00-00 00:00:00'),
(13, 11, 1, 'Default', 'sdfdsf', '0', '2011-11-04 22:09:10', '0000-00-00 00:00:00'),
(14, 12, 1, 'Default', 'sdfsdf', '0', '2011-11-04 22:09:10', '0000-00-00 00:00:00'),
(15, 13, 1, 'Default', 'sdfdsf', '0', '2011-11-04 22:10:19', '0000-00-00 00:00:00'),
(16, 14, 1, 'Default', 'sdfsdf', '0', '2011-11-04 22:10:19', '0000-00-00 00:00:00'),
(17, 15, 1, 'Default', 'Black Lab', '0', '2011-11-11 13:28:03', '0000-00-00 00:00:00'),
(18, 16, 1, 'Default', 'Rhodesian Ridgeback', '0', '2011-11-11 13:28:03', '0000-00-00 00:00:00'),
(19, 17, 1, 'Default', 'Coconut Mocha', '0', '2011-11-21 20:32:24', '0000-00-00 00:00:00'),
(20, 18, 1, 'Default', 'Spiced Pumpkin Latte', '0', '2011-11-21 20:32:24', '0000-00-00 00:00:00'),
(21, 19, 1, 'Default', '->escape(Coconut Mocha)', '0', '2011-11-21 20:44:29', '0000-00-00 00:00:00'),
(22, 20, 1, 'Default', '->escape(Spiced Pumpkin Latte)', '0', '2011-11-21 20:44:29', '0000-00-00 00:00:00'),
(23, 21, 1, 'Default', 'Coconut Mocha', '0', '2011-11-21 20:48:48', '0000-00-00 00:00:00'),
(24, 22, 1, 'Default', 'Spiced Pumpkin Latte', '0', '2011-11-21 20:48:48', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Comments`
--

CREATE TABLE IF NOT EXISTS `Comments` (
  `dbCommCnt` int(10) NOT NULL AUTO_INCREMENT,
  `dbIDCnt` mediumint(7) NOT NULL,
  `dbIDGroup` tinyint(3) NOT NULL,
  `dbCommTxt` text COLLATE latin1_general_ci NOT NULL,
  `dbUsrCnt` mediumint(7) NOT NULL,
  `dbAddDate` datetime NOT NULL,
  `dbBlock` tinyint(2) NOT NULL,
  PRIMARY KEY (`dbCommCnt`),
  KEY `dbIDCnt` (`dbIDCnt`),
  FULLTEXT KEY `dbCommTxt` (`dbCommTxt`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Follows`
--

CREATE TABLE IF NOT EXISTS `Follows` (
  `dbFolCnt` int(10) NOT NULL AUTO_INCREMENT,
  `dbFolType` tinyint(2) NOT NULL,
  `dbFolActive` tinyint(2) NOT NULL DEFAULT '1',
  `dbFollowerCnt` int(100) NOT NULL,
  `dbFollowedCnt` mediumint(7) NOT NULL,
  `dbAddDate` datetime NOT NULL,
  `dbBlock` tinyint(2) NOT NULL,
  `dbBlockDate` datetime DEFAULT NULL,
  PRIMARY KEY (`dbFolCnt`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Follow_up`
--

CREATE TABLE IF NOT EXISTS `Follow_up` (
  `dbPostCnt` mediumint(7) NOT NULL,
  `dbUsrCnt` mediumint(7) NOT NULL,
  `dbFolUpText` text COLLATE latin1_general_ci NOT NULL,
  `dbFolUpDate` datetime NOT NULL,
  PRIMARY KEY (`dbPostCnt`),
  KEY `dbUsrCnt` (`dbUsrCnt`),
  FULLTEXT KEY `dbFolUpText` (`dbFolUpText`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Invites`
--

CREATE TABLE IF NOT EXISTS `Invites` (
  `dbInviteCnt` mediumint(7) NOT NULL AUTO_INCREMENT,
  `dbInviterCnt` mediumint(7) NOT NULL,
  `dbInviteeEmail` varchar(60) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `dbSentDate` datetime DEFAULT NULL,
  `dbAcceptDate` datetime DEFAULT NULL,
  PRIMARY KEY (`dbInviteCnt`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Posts`
--

CREATE TABLE IF NOT EXISTS `Posts` (
  `dbPostCnt` mediumint(7) NOT NULL AUTO_INCREMENT,
  `dbUsrCnt` mediumint(7) DEFAULT NULL,
  `dbPostTitle` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `dbChc1Cnt` mediumint(7) DEFAULT NULL,
  `dbChc2Cnt` int(50) DEFAULT NULL,
  `dbChc1Votes` int(50) DEFAULT NULL,
  `dbChc2Votes` mediumint(7) DEFAULT NULL,
  `dbPostDesc` text COLLATE latin1_general_ci,
  `dbCatCnt` tinyint(3) DEFAULT NULL,
  `dbOutcome` tinyint(1) DEFAULT NULL,
  `dbAddDate` datetime DEFAULT NULL,
  `dbModDate` datetime DEFAULT NULL,
  `dbExpDate` datetime DEFAULT NULL,
  `dbPrivate` tinyint(1) NOT NULL,
  `dbFlagged` tinyint(1) DEFAULT NULL,
  `dbFlagDate` datetime DEFAULT NULL,
  `dbBlock` tinyint(1) DEFAULT NULL,
  `dbClearVotes` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`dbPostCnt`),
  KEY `dbCatCnt` (`dbCatCnt`),
  KEY `dbAddDate` (`dbAddDate`),
  KEY `dbUsrCnt` (`dbUsrCnt`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `Posts`
--

INSERT INTO `Posts` (`dbPostCnt`, `dbUsrCnt`, `dbPostTitle`, `dbChc1Cnt`, `dbChc2Cnt`, `dbChc1Votes`, `dbChc2Votes`, `dbPostDesc`, `dbCatCnt`, `dbOutcome`, `dbAddDate`, `dbModDate`, `dbExpDate`, `dbPrivate`, `dbFlagged`, `dbFlagDate`, `dbBlock`, `dbClearVotes`) VALUES
(1, 1, 'What jacket should I buy?', 1, 2, NULL, NULL, 'I got some money for Christmas, and I have no jacket--just hoodies. Please help me decide which jacket I should get.', 2, NULL, '2010-12-31 13:35:08', NULL, '2011-10-14 23:45:00', 0, NULL, NULL, 0, 1),
(3, 1, 'sdfsdf', 3, 4, NULL, NULL, 'sdfsdf', 2, NULL, '2011-11-04 21:22:28', NULL, '2011-11-08 22:30:00', 0, 0, NULL, 0, 1),
(4, 1, 'sdfsdf', 5, 6, NULL, NULL, 'sdfsdf', 7, NULL, '2011-11-04 21:50:16', NULL, '2011-11-10 23:00:00', 0, 0, NULL, 0, 1),
(5, 1, 'sdfsdf', 7, 8, NULL, NULL, 'sdfsdfsdf', 6, NULL, '2011-11-04 21:53:24', NULL, '2011-11-08 23:00:00', 0, 0, NULL, 0, 1),
(6, 1, 'sdfsdf', 9, 10, NULL, NULL, 'sdfsdfsdf', 6, NULL, '2011-11-04 22:00:40', NULL, '2011-11-08 23:00:00', 0, 0, NULL, 0, 1),
(7, 1, 'kjdfg', 11, 12, NULL, NULL, 'dlfglkdfjg', 2, NULL, '2011-11-04 22:08:05', NULL, '2011-11-10 23:15:00', 0, 0, NULL, 0, 1),
(8, 1, 'What', 13, 14, NULL, NULL, 'dlfglkdfjg', 3, NULL, '2011-11-04 22:09:10', NULL, '2011-11-18 21:15:00', 0, 0, NULL, 0, 1),
(9, 1, 'dasd', 15, 16, NULL, NULL, 'dlfglkdfjg', 7, NULL, '2011-11-04 22:10:19', NULL, '2011-11-09 23:15:00', 0, 0, NULL, 0, 1),
(10, 1, 'What kind of dog should I get?', 17, 18, NULL, NULL, 'This is a test decision. What kind of dog should I get?', 4, NULL, '2011-11-11 13:28:03', NULL, '2011-11-21 14:30:00', 0, 0, NULL, 0, 1),
(11, 1, 'What drink should I get?', 23, 24, NULL, NULL, 'I''m going to Starbucks tonight, but I''m not really a coffee guy. I heard that I should try either a coconut mocha or a spiced pumpkin latte. What do you think?', 2, NULL, '2011-11-21 20:48:48', NULL, '2011-11-30 22:00:00', 0, 0, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `dbUsrCnt` mediumint(7) NOT NULL AUTO_INCREMENT,
  `dbUsrID` mediumint(7) NOT NULL,
  `dbUsrFirstName` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `dbUsrLastName` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `dbUsrName` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `dbUsrPassword` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `dbUsrEmail` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `dbUsrPhone` varchar(25) COLLATE latin1_general_ci DEFAULT NULL,
  `dbUsrGender` tinyint(1) DEFAULT NULL,
  `dbUsrBirthday` date DEFAULT NULL,
  `dbUsrPic` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `dbUsrTimezone` tinyint(3) DEFAULT NULL,
  `dbUsrAgeGroup` tinyint(2) DEFAULT NULL,
  `dbVoteCnt1` int(20) DEFAULT NULL,
  `dbVoteCnt2` int(20) DEFAULT NULL,
  `dbVoteCnt3` int(20) DEFAULT NULL,
  `dbRightAmt` int(20) DEFAULT NULL,
  `dbLastLogin` datetime DEFAULT NULL,
  `dbAddDate` datetime DEFAULT NULL,
  `dbModDate` datetime DEFAULT NULL,
  `dbUsrBlocked` tinyint(1) NOT NULL,
  PRIMARY KEY (`dbUsrCnt`),
  KEY `dbUsrName` (`dbUsrName`),
  KEY `dbUsrEmail` (`dbUsrEmail`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`dbUsrCnt`, `dbUsrID`, `dbUsrFirstName`, `dbUsrLastName`, `dbUsrName`, `dbUsrPassword`, `dbUsrEmail`, `dbUsrPhone`, `dbUsrGender`, `dbUsrBirthday`, `dbUsrPic`, `dbUsrTimezone`, `dbUsrAgeGroup`, `dbVoteCnt1`, `dbVoteCnt2`, `dbVoteCnt3`, `dbRightAmt`, `dbLastLogin`, `dbAddDate`, `dbModDate`, `dbUsrBlocked`) VALUES
(1, 1, 'Jamie', 'Howard', 'JamieHoward', 'test123', 'jamie@blackairplane.com', '5551234567', 0, '1987-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011-12-31 14:24:41', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Votes`
--

CREATE TABLE IF NOT EXISTS `Votes` (
  `dbVoteCnt` int(10) NOT NULL AUTO_INCREMENT,
  `dbUsrCnt` mediumint(7) NOT NULL,
  `dbPostCnt` mediumint(7) NOT NULL,
  `dbChcVote` tinyint(3) NOT NULL,
  `dbVoteDate` datetime NOT NULL,
  PRIMARY KEY (`dbVoteCnt`),
  KEY `dbPostCnt` (`dbPostCnt`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
