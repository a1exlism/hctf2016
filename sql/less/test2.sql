-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 08, 2016 at 05:46 PM
-- Server version: 5.7.16-0ubuntu0.16.04.1-log
-- PHP Version: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hctf2016`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_qwe`
--

CREATE TABLE `admin_qwe` (
  `user` varchar(40) NOT NULL,
  `pass` varchar(40) NOT NULL,
  `key` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bulletin`
--

CREATE TABLE `bulletin` (
  `bulletin_id` int(11) NOT NULL,
  `bulletin_message` varchar(200) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bulletin`
--

INSERT INTO `bulletin` (`bulletin_id`, `bulletin_message`, `create_time`, `update_time`) VALUES
(1, 'bulletin_1', '2016-10-26 05:22:46', '2016-10-26 05:22:46'),
(2, 'bulletin_2', '2016-10-26 05:22:46', '2016-10-26 05:22:46'),
(3, 'bulletin_1', '2016-10-26 05:22:49', '2016-10-26 05:22:49'),
(4, 'bulletin_2', '2016-10-26 05:22:49', '2016-10-26 05:22:49'),
(5, 'bulletin_3', '2016-10-26 05:23:04', '2016-10-26 05:23:04'),
(6, 'bulletin_4', '2016-10-26 05:23:04', '2016-10-26 05:23:04'),
(7, 'bulletin_3', '2016-10-26 05:23:06', '2016-10-26 05:23:06'),
(8, 'bulletin_4', '2016-10-26 05:23:06', '2016-10-26 05:23:06'),
(9, 'bulletin_5', '2016-10-26 05:23:20', '2016-10-26 05:23:20'),
(10, 'bulletin_6', '2016-10-26 05:23:20', '2016-10-26 05:23:20'),
(11, 'bulletin_7', '2016-10-26 05:23:20', '2016-10-26 05:23:20'),
(12, 'bulletin_5', '2016-10-26 05:23:24', '2016-10-26 05:23:24'),
(13, 'bulletin_6', '2016-10-26 05:23:24', '2016-10-26 05:23:24'),
(14, 'bulletin_7', '2016-10-26 05:23:24', '2016-10-26 05:23:24');

-- --------------------------------------------------------

--
-- Table structure for table `card_info`
--

CREATE TABLE `card_info` (
  `card_id` int(11) NOT NULL,
  `team_token` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `challenge_info`
--

CREATE TABLE `challenge_info` (
  `challenge_id` int(10) UNSIGNED NOT NULL,
  `challenge_name` varchar(40) NOT NULL,
  `challenge_type` varchar(20) NOT NULL,
  `challenge_score` int(10) UNSIGNED NOT NULL,
  `challenge_description` varchar(200) NOT NULL,
  `challenge_hit` varchar(100) DEFAULT NULL,
  `challenge_level` int(10) UNSIGNED NOT NULL,
  `challenge_solves` int(10) UNSIGNED DEFAULT '0',
  `challenge_api` varchar(40) DEFAULT NULL,
  `challenge_threshold` int(12) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `challenge_info`
--

INSERT INTO `challenge_info` (`challenge_id`, `challenge_name`, `challenge_type`, `challenge_score`, `challenge_description`, `challenge_hit`, `challenge_level`, `challenge_solves`, `challenge_api`, `challenge_threshold`) VALUES
(1, 'welcome', 'reverse', 100, 'challenge_1', 'hit1', 1, 0, 'api', 1),
(2, 'hello', 'web', 200, 'challenge_2', 'hit2', 2, 0, 'api2', 1),
(3, 'copy', 'misc', 100, 'challenge_1', 'hit1', 1, 0, 'api', 1),
(4, 'getMe', 'pwn', 200, 'challenge_2', 'hit2', 3, 0, 'api2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dynamic_notify`
--

CREATE TABLE `dynamic_notify` (
  `notify_id` int(10) UNSIGNED NOT NULL,
  `team_token` varchar(40) NOT NULL,
  `challenge_id` int(10) UNSIGNED NOT NULL,
  `challenge_open_time` int(11) NOT NULL,
  `challenge_solved_time` int(11) DEFAULT NULL,
  `challenge_flag` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dynamic_notify`
--

INSERT INTO `dynamic_notify` (`notify_id`, `team_token`, `challenge_id`, `challenge_open_time`, `challenge_solved_time`, `challenge_flag`) VALUES
(1, '6d052931f952bca7a195b417c4871f0a', 1, 1477532142, 1477532166, '{hctf:wlecome}'),
(2, '6d052931f952bca7a195b417c4871f0a', 2, 1477532000, 1477532144, '{hctf:prob2}'),
(3, '', 3, 1477532088, NULL, '{hctf:prob3}');

-- --------------------------------------------------------

--
-- Table structure for table `score_record`
--

CREATE TABLE `score_record` (
  `team_name` varchar(40) NOT NULL,
  `team_token` varchar(40) NOT NULL,
  `score_a` int(11) NOT NULL DEFAULT '0',
  `score_b` int(11) NOT NULL DEFAULT '0',
  `score_c` int(11) NOT NULL DEFAULT '0',
  `score_d` int(11) NOT NULL DEFAULT '0',
  `score_e` int(11) NOT NULL DEFAULT '0',
  `total_score` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `score_record`
--

INSERT INTO `score_record` (`team_name`, `team_token`, `score_a`, `score_b`, `score_c`, `score_d`, `score_e`, `total_score`) VALUES
('team', '6d052931f952bca7a195b417c4871f0a', 0, 50, 100, 200, 300, 600),
('PPP', 'c9c3d446625390fa20a54d99237c403b', 0, 100, 200, 500, 800, 1300),
('LC↯BC', '909f3ce9daaffabfa7da39991f517640', 0, 150, 200, 400, 800, 1200),
('Cykorkinesis', 'cbea5c320302bff7a6e0fa5301602e07', 0, 250, 400, 600, 900, 1100);

-- --------------------------------------------------------

--
-- Table structure for table `team_info`
--

CREATE TABLE `team_info` (
  `team_id` int(10) UNSIGNED NOT NULL,
  `team_email` varchar(40) CHARACTER SET latin1 NOT NULL,
  `team_name` varchar(40) CHARACTER SET latin1 NOT NULL,
  `team_pass` varchar(40) CHARACTER SET latin1 NOT NULL,
  `team_school` varchar(20) CHARACTER SET latin1 NOT NULL,
  `team_phone` int(12) UNSIGNED NOT NULL,
  `team_token` varchar(40) CHARACTER SET latin1 NOT NULL,
  `is_expand` tinyint(1) NOT NULL DEFAULT '0',
  `total_score` int(11) NOT NULL DEFAULT '0',
  `compet_level` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `is_cheat` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `team_info`
--

INSERT INTO `team_info` (`team_id`, `team_email`, `team_name`, `team_pass`, `team_school`, `team_phone`, `team_token`, `is_expand`, `total_score`, `compet_level`, `is_cheat`) VALUES
(6, 'a1exlism@vidar.club', 'team', '589fb151dd73cb3d0583b53dc30246c5', 'hdu', 4294967295, '6d052931f952bca7a195b417c4871f0a', 0, 500, 2, 1),
(7, 'test@test.com', 't2', '589fb151dd73cb3d0583b53dc30246c5', 's2', 4294967295, '3a3ae7627a3baa45aeface889c6c0c63', 0, 200, 1, 0),
(8, 'test@test.test', 't3', '589fb151dd73cb3d0583b53dc30246c5', 's3', 4294967295, 'b8003a70c61bbad8037571402a7bc3d6', 0, 100, 1, 0),
(9, 'a@b.c', 'LC&#x21af;BC', 'b4f0997165ee69ae40a5219da844abf6', 's', 4294967295, '909f3ce9daaffabfa7da39991f517640', 0, 999, 4, 0),
(10, 'a@b.d', 'TokyoWesterns', 'b4f0997165ee69ae40a5219da844abf6', 's', 4294967295, 'c9c3d446625390fa20a54d99237c403b', 0, 400, 2, 0),
(11, 'a@b.e', 't5', 'b4f0997165ee69ae40a5219da844abf6', 's', 4294967295, '307bcd0cc4619daba79719c7a6340fed', 0, 50, 1, 0),
(12, 'a@b.f', 'CLGT', 'b4f0997165ee69ae40a5219da844abf6', 's', 4294967295, '6b7383df5003909e8c46add99715f10a', 0, 300, 2, 0),
(13, 'a@b.h', 'Shellphish', '589fb151dd73cb3d0583b53dc30246c5', 's', 4294967295, '49f6a9c66a9a700e34053eaf70ce202c', 0, 600, 3, 0),
(14, 'a@b.i', 't8', '589fb151dd73cb3d0583b53dc30246c5', 's', 4294967295, '9b03e521f8b8cde19b0f6738f9405d40', 0, 233, 1, 0),
(15, 'a@b.j', 'Cykorkinesis', '589fb151dd73cb3d0583b53dc30246c5', 's', 4294967295, 'cbea5c320302bff7a6e0fa5301602e07', 0, 666, 3, 0),
(16, 'a@b.k', 't10', '589fb151dd73cb3d0583b53dc30246c5', 's', 4294967295, '0b3ed9da47aa0e020ff98ff616b23b52', 0, 188, 1, 0),
(17, 'a@b.d', ' PPP', 'b4f0997165ee69ae40a5219da844abf6', 's', 4294967295, 'c9c3d446625390fa20a54d99237c403b', 0, 1200, 4, 0),
(18, 'a@b.z', 'tt', '819bb22b40d4196c23240c8583c2b042', '123', 4294967295, '7bacc4be0250542ee7524581c56ad49d', 0, 0, 1, 0),
(19, 'x@x.x', '123', 'da11ed20b873109144435b6604624081', '123', 4294967295, 'c009be6c8c7856aac0fe596a7b0554f3', 0, 0, 1, 0),
(20, 'a@a.c', 'aaa', '589fb151dd73cb3d0583b53dc30246c5', 'bbb', 4294967295, '15e7b938aee97b795a7b1e19d2c5ee14', 0, 0, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_qwe`
--
ALTER TABLE `admin_qwe`
  ADD PRIMARY KEY (`user`);

--
-- Indexes for table `bulletin`
--
ALTER TABLE `bulletin`
  ADD PRIMARY KEY (`bulletin_id`);

--
-- Indexes for table `card_info`
--
ALTER TABLE `card_info`
  ADD PRIMARY KEY (`card_id`);

--
-- Indexes for table `challenge_info`
--
ALTER TABLE `challenge_info`
  ADD PRIMARY KEY (`challenge_id`);

--
-- Indexes for table `dynamic_notify`
--
ALTER TABLE `dynamic_notify`
  ADD PRIMARY KEY (`notify_id`);

--
-- Indexes for table `team_info`
--
ALTER TABLE `team_info`
  ADD PRIMARY KEY (`team_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bulletin`
--
ALTER TABLE `bulletin`
  MODIFY `bulletin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `card_info`
--
ALTER TABLE `card_info`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `challenge_info`
--
ALTER TABLE `challenge_info`
  MODIFY `challenge_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `dynamic_notify`
--
ALTER TABLE `dynamic_notify`
  MODIFY `notify_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `team_info`
--
ALTER TABLE `team_info`
  MODIFY `team_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
