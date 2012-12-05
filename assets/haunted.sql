-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 23, 2012 at 09:00 PM
-- Server version: 5.5.24
-- PHP Version: 5.3.10-1ubuntu3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `haunted`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `idcategories` int(10) NOT NULL AUTO_INCREMENT,
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
  `idfaq_answers_table` bigint(30) NOT NULL AUTO_INCREMENT,
  `answers` text NOT NULL,
  `idfaq_table` bigint(30) NOT NULL,
  PRIMARY KEY (`idfaq_answers_table`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19057357665072 ;

--
-- Dumping data for table `faq_answers_table`
--

INSERT INTO `faq_answers_table` (`idfaq_answers_table`, `answers`, `idfaq_table`) VALUES
(19057357665071, 'test a 3', 4500026805071),
(14058621595071, 'test a', 19279361995071);

-- --------------------------------------------------------

--
-- Table structure for table `faq_questions_table`
--

CREATE TABLE IF NOT EXISTS `faq_questions_table` (
  `idfaq_questions_table` bigint(30) NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `idfaq_table` bigint(30) NOT NULL,
  PRIMARY KEY (`idfaq_questions_table`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11135388375072 ;

--
-- Dumping data for table `faq_questions_table`
--

INSERT INTO `faq_questions_table` (`idfaq_questions_table`, `question`, `idfaq_table`) VALUES
(1774060595071, 'test q 2', 4500026805071),
(9942406675071, 'test q', 19279361995071);

-- --------------------------------------------------------

--
-- Table structure for table `faq_table`
--

CREATE TABLE IF NOT EXISTS `faq_table` (
  `idfaq_table` bigint(30) NOT NULL AUTO_INCREMENT,
  `questionid` bigint(30) NOT NULL,
  `answerid` bigint(30) NOT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`idfaq_table`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19279361995072 ;

--
-- Dumping data for table `faq_table`
--

INSERT INTO `faq_table` (`idfaq_table`, `questionid`, `answerid`, `user_id`) VALUES
(2147483647, 2147483647, 2147483647, 1),
(4500026805071, 1774060595071, 19057357665071, 1),
(19279361995071, 9942406675071, 14058621595071, 1);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `idlocation` bigint(30) NOT NULL,
  `location_name` varchar(50) NOT NULL,
  `location_street` varchar(30) NOT NULL,
  `location_city` varchar(20) NOT NULL,
  `location_state` varchar(20) NOT NULL,
  `location_zip` int(5) NOT NULL,
  `lat` varchar(20) NOT NULL,
  `lng` varchar(20) NOT NULL,
  `tags` mediumtext NOT NULL,
  `created` datetime NOT NULL,
  `description` longtext NOT NULL,
  `userid` mediumint(8) NOT NULL,
  PRIMARY KEY (`idlocation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`idlocation`, `location_name`, `location_street`, `location_city`, `location_state`, `location_zip`, `lat`, `lng`, `tags`, `created`, `description`, `userid`) VALUES
(1905990365079, 'Axis41', '48 West Market St', 'Salt Lake City', 'Utah', 84101, '40.76182', '-111.8916222', 'ghost,grave,voices,apparitions', '0000-00-00 00:00:00', '<p>\n test 1</p>\n', 1),
(7050301085079, 'the Apple', '1 Infinite Loop', 'Cuppertino', 'California', 95014, '37.3320132', '-122.0289113', 'ghost,voices,apparitions', '0000-00-00 00:00:00', '<p>\n test 5 </p>\n', 1),
(12235944725079, 'the Google', '1600 Amphitheatre Parkway', 'Mountain View', 'California', 94043, '37.4218498', '-122.0842005', 'voices,apparitions', '0000-00-00 00:00:00', '<p>\n test 3</p>\n', 1),
(13191794545079, 'LDS Church', '50 West Temple', 'Salt Lake City', 'Utah', 0, '40.7682425', '-111.8939490', 'apparitions', '0000-00-00 00:00:00', '<p>\n test test</p>\n', 1),
(13806834925079, 'AZLocation', '106 E Aspen ST', 'Cottonwood', 'AZ', 86326, '34.736607', '-112.0262109', 'ghost,grave,voices,apparitions', '0000-00-00 00:00:00', '<p>\n test 2</p>\n', 1),
(19184575285079, 'My House', '960 S 550 E', 'Clearfield', 'Utah', 84015, '41.100324', '-112.01565', 'ghost,grave,apparitions', '0000-00-00 00:00:00', '<p>\n my house</p>\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `meta_content`
--

CREATE TABLE IF NOT EXISTS `meta_content` (
  `idmeta_content` int(11) NOT NULL,
  `keywords` longtext,
  `description` longtext,
  `domainuid` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`idmeta_content`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meta_content`
--

INSERT INTO `meta_content` (`idmeta_content`, `keywords`, `description`, `domainuid`) VALUES
(0, 'jerome, arizona, shopping, community, Advertising, Antiques, Automotive,   Construction, Education,   Family Entertainment, Financial, Fitness, Party Services, Pets, Real Estate,   Restaurants, Retail,', 'Welcome to Jerome Arizona. This is your guide to shopping, antiques, and more in the Historic Ghost Town of Jerome.', '4556602514ec4a0885a5fa');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `pageid` int(10) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(50) NOT NULL,
  `page_headline` varchar(100) NOT NULL,
  `page_intro` text NOT NULL,
  `page_content` text NOT NULL,
  `parentid` int(10) NOT NULL,
  `templateid` int(10) NOT NULL,
  `sectionid` int(10) NOT NULL,
  `userid` int(20) NOT NULL,
  `siteid` varchar(32) NOT NULL,
  `rank` int(11) NOT NULL,
  UNIQUE KEY `pageid` (`pageid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Page Database' AUTO_INCREMENT=14 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`pageid`, `page_name`, `page_headline`, `page_intro`, `page_content`, `parentid`, `templateid`, `sectionid`, `userid`, `siteid`, `rank`) VALUES
(1, 'index', 'Welcome to My Page', '', '<p>\n Here&#39;s some page content.</p>', 0, 0, 1, 1, '4556602514ec4a0885a5fa', 0),
(6, 'addlocation', 'Add A Haunted Location', '', '<p>\n Insert Page Content Here</p>\n', 0, 0, 1, 1, '4556602514ec4a0885a5fa', 2),
(7, 'About', 'About Haunted Location Finder', '', '<p>\n This service helps you to find.</p>\n', 0, 0, 1, 1, '4556602514ec4a0885a5fa', 1),
(13, 'small-about', 'Small About us page', '', '<p>\n Insert Page Content Here</p>\n', 7, 0, 1, 1, '4556602514ec4a0885a5fa', 0),
(5, 'locations', 'Find a Haunted Location', '', '<p>\n Find Haunted Locations from your phone!</p>\n', 0, 0, 1, 1, '4556602514ec4a0885a5fa', 3);

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `photo_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `photoname` varchar(75) NOT NULL,
  `thumb` varchar(250) NOT NULL,
  `fullsize` varchar(250) NOT NULL,
  `busid` bigint(20) NOT NULL,
  `userid` bigint(20) NOT NULL,
  PRIMARY KEY (`photo_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`photo_id`, `photoname`, `thumb`, `fullsize`, `busid`, `userid`) VALUES
(59, 'bef8f5e5_201229.jpg', 'http://jshultz.co/assets/images/gallery/thumbs/bef8f5e5_201229.jpg', 'http://jshultz.co/assets/images/gallery/bef8f5e5_201229.jpg', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

CREATE TABLE IF NOT EXISTS `sites` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `url` varchar(200) NOT NULL,
  `uid` varchar(32) NOT NULL,
  `site_title` varchar(60) DEFAULT NULL,
  `meta_desc` varchar(250) NOT NULL,
  `meta_keywords` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`id`, `url`, `uid`, `site_title`, `meta_desc`, `meta_keywords`) VALUES
(2, 'haunted.local', '4556602514ec4a0885a5fa', 'Haunted Location Finder', 'something, something else', '0'),
(7, 'www.haunted.local', '4556602514ec4a0885a5fa', 'Haunted Location Finder', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE IF NOT EXISTS `templates` (
  `templateid` int(10) NOT NULL AUTO_INCREMENT,
  `filename` varchar(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`templateid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` int(10) unsigned NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `street` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(15) NOT NULL,
  `zip` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `street`, `city`, `state`, `zip`) VALUES
(1, 2130706433, 'administrator', '2886f0974559106e113db7490cb1c97c7812271e', '9462e8eee0', 'admin@admin.com', '', NULL, 1338759307, '9d2e1e746f731a35675bbdd3c4bca5a89c303d54', 1268889823, 1350832489, 1, 'Admin', 'istrator', 'ADMIN', '0', '48 W Market St', 'Salt Lake City', 'UT', '84101');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
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
