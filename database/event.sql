-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2016 at 11:56 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `event`
--

-- --------------------------------------------------------

--
-- Table structure for table `acm_configuration`
--

CREATE TABLE IF NOT EXISTS `acm_configuration` (
`id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `value` varchar(150) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `acm_configuration`
--

INSERT INTO `acm_configuration` (`id`, `name`, `value`) VALUES
(1, 'website_name', 'CodeBurst'),
(2, 'website_url', 'localhost/'),
(3, 'email', 'admin@acmvit.com'),
(4, 'activation', 'false'),
(5, 'resend_activation_threshold', '0'),
(6, 'language', 'models/languages/en.php'),
(7, 'template', 'models/site-templates/default.css');

-- --------------------------------------------------------

--
-- Table structure for table `acm_marks`
--

CREATE TABLE IF NOT EXISTS `acm_marks` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `marks_awarded` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `acm_marks`
--

INSERT INTO `acm_marks` (`id`, `user_id`, `question_id`, `marks_awarded`, `updated_by`) VALUES
(1, 1, 5, 100, 1),
(2, 1, 4, 250, 1),
(3, 1, 12, 55, 1),
(4, 1, 12, 55, 1),
(5, 1, 12, 55, 1),
(6, 1, 4, 100, 1),
(7, 1, 4, 100, 1),
(8, 1, 5, 80, 1),
(9, 1, 1, 90, 1),
(10, 1, 9, 100, 1),
(11, 1, 1, 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `acm_pages`
--

CREATE TABLE IF NOT EXISTS `acm_pages` (
`id` int(11) NOT NULL,
  `page` varchar(150) NOT NULL,
  `private` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `acm_pages`
--

INSERT INTO `acm_pages` (`id`, `page`, `private`) VALUES
(1, 'account.php', 1),
(2, 'activate-account.php', 0),
(3, 'admin_configuration.php', 1),
(4, 'admin_page.php', 1),
(5, 'admin_pages.php', 1),
(6, 'admin_permission.php', 1),
(7, 'admin_permissions.php', 1),
(8, 'admin_user.php', 1),
(9, 'admin_users.php', 1),
(10, 'forgot-password.php', 0),
(11, 'index.php', 0),
(12, 'left-nav.php', 0),
(13, 'login.php', 0),
(14, 'logout.php', 1),
(15, 'register.php', 0),
(16, 'resend-activation.php', 0),
(17, 'user_settings.php', 1),
(18, 'admin_addQuestion.php', 0),
(19, 'profile.php', 0);

-- --------------------------------------------------------

--
-- Table structure for table `acm_permissions`
--

CREATE TABLE IF NOT EXISTS `acm_permissions` (
`id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `acm_permissions`
--

INSERT INTO `acm_permissions` (`id`, `name`) VALUES
(1, 'New Member'),
(2, 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `acm_permission_page_matches`
--

CREATE TABLE IF NOT EXISTS `acm_permission_page_matches` (
`id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `acm_permission_page_matches`
--

INSERT INTO `acm_permission_page_matches` (`id`, `permission_id`, `page_id`) VALUES
(1, 1, 1),
(2, 1, 14),
(3, 1, 17),
(4, 2, 1),
(5, 2, 3),
(6, 2, 4),
(7, 2, 5),
(8, 2, 6),
(9, 2, 7),
(10, 2, 8),
(11, 2, 9),
(12, 2, 14),
(13, 2, 17);

-- --------------------------------------------------------

--
-- Table structure for table `acm_questions`
--

CREATE TABLE IF NOT EXISTS `acm_questions` (
`id` int(11) NOT NULL,
  `question_title` text NOT NULL,
  `question_description` text NOT NULL,
  `marks` int(11) NOT NULL,
  `question_type` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `acm_questions`
--

INSERT INTO `acm_questions` (`id`, `question_title`, `question_description`, `marks`, `question_type`, `user_id`) VALUES
(1, 'test', 'Test description', 5, 'Reverse coding', 0),
(2, '1', 'description 2', 1, '1', 1),
(3, '1', '1Add description here', 1, '1', 1),
(4, '1', '1Add description here', 1, '1', 1),
(5, '1', '1Add description here', 1, '1', 1),
(6, 'sdfkdsjfsklfj', 'kjkljdsklsjfklj', 10, 'Cryptography', 1),
(7, 'kdsakdfljfklj', 'kdndslfnadfd,nfdsm,nf ', 100, 'Jumble coding', 1);

-- --------------------------------------------------------

--
-- Table structure for table `acm_uploads`
--

CREATE TABLE IF NOT EXISTS `acm_uploads` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `time_uploaded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `acm_uploads`
--

INSERT INTO `acm_uploads` (`id`, `user_id`, `question_id`, `time_uploaded`) VALUES
(1, 1, 1, '2016-01-13 14:55:43'),
(2, 1, 2, '2016-01-13 14:57:29'),
(3, 1, 2, '2016-01-13 14:57:41'),
(4, 1, 2, '2016-01-13 14:57:49'),
(5, 1, 6, '2016-01-13 15:01:46'),
(6, 1, 6, '2016-01-13 15:02:08'),
(7, 1, 1, '2016-01-16 08:20:59'),
(8, 1, 2, '2016-01-16 10:51:46'),
(9, 1, 2, '2016-01-16 10:55:53');

-- --------------------------------------------------------

--
-- Table structure for table `acm_users`
--

CREATE TABLE IF NOT EXISTS `acm_users` (
`id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `display_name` varchar(50) NOT NULL,
  `password` varchar(225) NOT NULL,
  `email` varchar(150) NOT NULL,
  `activation_token` varchar(225) NOT NULL,
  `last_activation_request` int(11) NOT NULL,
  `lost_password_request` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `title` varchar(150) NOT NULL,
  `sign_up_stamp` int(11) NOT NULL,
  `last_sign_in_stamp` int(11) NOT NULL,
  `total_marks` int(11) NOT NULL DEFAULT '0',
  `questions_attempted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `acm_users`
--

INSERT INTO `acm_users` (`id`, `user_name`, `display_name`, `password`, `email`, `activation_token`, `last_activation_request`, `lost_password_request`, `active`, `title`, `sign_up_stamp`, `last_sign_in_stamp`, `total_marks`, `questions_attempted`) VALUES
(1, 'ashwini', 'Ashwini', '39352ee3107c7a833800c51867500310509d3c5e87cab3708c6258c2fe01e6dc2', 'geek.ashwini@gmail.com', 'd2210822e82b8e0c883ecc6fdf3dc466', 1452619536, 0, 1, 'New Member', 1452619536, 1452941486, 1086, 1),
(2, 'testing', 'TestTest', '72b53c5ff2cbd2343486d9db37ad03ad18982458b7192465f6b0db79d75948603', 'hello@gmail.com', 'f32fdcda6cecce85fc5e78682b8fc577', 1452619844, 0, 1, 'New Member', 1452619844, 1452627002, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `acm_user_permission_matches`
--

CREATE TABLE IF NOT EXISTS `acm_user_permission_matches` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `acm_user_permission_matches`
--

INSERT INTO `acm_user_permission_matches` (`id`, `user_id`, `permission_id`) VALUES
(1, 1, 2),
(2, 1, 1),
(3, 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acm_configuration`
--
ALTER TABLE `acm_configuration`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acm_marks`
--
ALTER TABLE `acm_marks`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acm_pages`
--
ALTER TABLE `acm_pages`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acm_permissions`
--
ALTER TABLE `acm_permissions`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acm_permission_page_matches`
--
ALTER TABLE `acm_permission_page_matches`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acm_questions`
--
ALTER TABLE `acm_questions`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acm_uploads`
--
ALTER TABLE `acm_uploads`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acm_users`
--
ALTER TABLE `acm_users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acm_user_permission_matches`
--
ALTER TABLE `acm_user_permission_matches`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acm_configuration`
--
ALTER TABLE `acm_configuration`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `acm_marks`
--
ALTER TABLE `acm_marks`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `acm_pages`
--
ALTER TABLE `acm_pages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `acm_permissions`
--
ALTER TABLE `acm_permissions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `acm_permission_page_matches`
--
ALTER TABLE `acm_permission_page_matches`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `acm_questions`
--
ALTER TABLE `acm_questions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `acm_uploads`
--
ALTER TABLE `acm_uploads`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `acm_users`
--
ALTER TABLE `acm_users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `acm_user_permission_matches`
--
ALTER TABLE `acm_user_permission_matches`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
