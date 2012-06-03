-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 03, 2012 at 12:18 PM
-- Server version: 5.0.95
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jshultz_jshultzdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `idcategories` int(10) NOT NULL auto_increment,
  `catname` varchar(50) NOT NULL,
  `catdescription` text NOT NULL,
  `userid` int(10) NOT NULL,
  KEY `idcategories` (`idcategories`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=143618705 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`idcategories`, `catname`, `catdescription`, `userid`) VALUES
(143618704, 'Main Category', 'Main Category Description', 1);

-- --------------------------------------------------------

--
-- Table structure for table `faq_answers_table`
--

CREATE TABLE IF NOT EXISTS `faq_answers_table` (
  `idfaq_answers_table` int(10) NOT NULL auto_increment,
  `answers` text NOT NULL,
  PRIMARY KEY  (`idfaq_answers_table`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `faq_questions_table`
--

CREATE TABLE IF NOT EXISTS `faq_questions_table` (
  `idfaq_questions_table` int(10) NOT NULL auto_increment,
  `question` text NOT NULL,
  PRIMARY KEY  (`idfaq_questions_table`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `faq_table`
--

CREATE TABLE IF NOT EXISTS `faq_table` (
  `idfaq_table` int(10) NOT NULL auto_increment,
  `questionid` int(10) NOT NULL,
  `answerid` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY  (`idfaq_table`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `pageid` int(10) NOT NULL auto_increment,
  `page_name` varchar(50) NOT NULL,
  `page_headline` varchar(100) NOT NULL,
  `page_intro` text NOT NULL,
  `page_content` text NOT NULL,
  `parentid` int(10) NOT NULL,
  `templateid` int(10) NOT NULL,
  UNIQUE KEY `pageid` (`pageid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Page Database' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `photo_id` bigint(20) NOT NULL auto_increment,
  `photoname` varchar(75) NOT NULL,
  `thumb` varchar(250) NOT NULL,
  `fullsize` varchar(250) NOT NULL,
  `busid` bigint(20) NOT NULL,
  `userid` bigint(20) NOT NULL,
  PRIMARY KEY  (`photo_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=59 ;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`photo_id`, `photoname`, `thumb`, `fullsize`, `busid`, `userid`) VALUES
(55, '', 'http://welcometojerome.com/assets/images/gallery/thumbs/317481_303238606366522_296282823728767_1147741_693948318_n1.jpg', 'http://welcometojerome.com/assets/images/gallery/317481_303238606366522_296282823728767_1147741_693948318_n1.jpg', 16, 9),
(53, '', 'http://WelcomeToJerome.com/assets/images/gallery/thumbs/gloria-rothrock-art.jpg', 'http://WelcomeToJerome.com/assets/images/gallery/gloria-rothrock-art.jpg', 9, 1),
(52, '', 'http://WelcomeToJerome.com/assets/images/gallery/thumbs/purelysedona-large1.jpg', 'http://WelcomeToJerome.com/assets/images/gallery/purelysedona-large1.jpg', 9, 1),
(51, '', 'http://WelcomeToJerome.com/assets/images/gallery/thumbs/TeenAndParentSupport.jpg', 'http://WelcomeToJerome.com/assets/images/gallery/TeenAndParentSupport.jpg', 9, 1),
(50, '', 'http://WelcomeToJerome.com/assets/images/gallery/thumbs/thewickhome-large.jpg', 'http://WelcomeToJerome.com/assets/images/gallery/thewickhome-large.jpg', 9, 1),
(48, '', 'http://WelcomeToJerome.com/assets/images/gallery/thumbs/verdebuilder-large.jpg', 'http://WelcomeToJerome.com/assets/images/gallery/verdebuilder-large.jpg', 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE IF NOT EXISTS `templates` (
  `templateid` int(10) NOT NULL auto_increment,
  `filename` varchar(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY  (`templateid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `ip_address` int(10) unsigned NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(40) default NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) default NULL,
  `forgotten_password_code` varchar(40) default NULL,
  `forgotten_password_time` int(11) unsigned default NULL,
  `remember_code` varchar(40) default NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned default NULL,
  `active` tinyint(1) unsigned default NULL,
  `first_name` varchar(50) default NULL,
  `last_name` varchar(50) default NULL,
  `company` varchar(100) default NULL,
  `phone` varchar(20) default NULL,
  `street` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(15) NOT NULL,
  `zip` varchar(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `street`, `city`, `state`, `zip`) VALUES
(1, 2130706433, 'administrator', '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4', '9462e8eee0', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1335732440, 1, 'Admin', 'istrator', 'ADMIN', '0', '48 W Market St', 'Salt Lake City', 'UT', '84101');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
