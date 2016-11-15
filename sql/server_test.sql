-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 15, 2016 at 02:36 PM
-- Server version: 5.6.33-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hctf2016`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_qwe`
--

CREATE TABLE IF NOT EXISTS `admin_qwe` (
  `user` VARCHAR(40) NOT NULL,
  `pass` VARCHAR(40) NOT NULL,
  `key`  VARCHAR(40) NOT NULL,
  PRIMARY KEY (`user`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

--
-- Dumping data for table `admin_qwe`
--

INSERT INTO `admin_qwe` (`user`, `pass`, `key`) VALUES
  ('admin', '0cc175b9c0f1b6a831c399e269772661', '123');

-- --------------------------------------------------------

--
-- Table structure for table `bulletin`
--

CREATE TABLE IF NOT EXISTS `bulletin` (
  `bulletin_id`      INT(11)      NOT NULL AUTO_INCREMENT,
  `bulletin_message` VARCHAR(200) NOT NULL,
  `create_time`      TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time`      TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`bulletin_id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 3;

--
-- Dumping data for table `bulletin`
--

INSERT INTO `bulletin` (`bulletin_id`, `bulletin_message`, `create_time`, `update_time`) VALUES
  (1, 'fdsa', '2016-11-08 09:35:30', '2016-11-08 09:35:30'),
  (2, 'bbbb', '2016-11-08 09:35:33', '2016-11-08 09:35:33');

-- --------------------------------------------------------

--
-- Table structure for table `card_info`
--

CREATE TABLE IF NOT EXISTS `card_info` (
  `card_id`    INT(11)     NOT NULL AUTO_INCREMENT,
  `team_token` VARCHAR(40) NOT NULL,
  PRIMARY KEY (`card_id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 3;

-- --------------------------------------------------------

--
-- Table structure for table `challenge_info`
--

CREATE TABLE IF NOT EXISTS `challenge_info` (
  `challenge_id`          INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `challenge_name`        VARCHAR(40)      NOT NULL,
  `challenge_type`        VARCHAR(20)      NOT NULL,
  `challenge_score`       INT(10) UNSIGNED NOT NULL,
  `challenge_description` VARCHAR(300)     NOT NULL,
  `challenge_hit`         VARCHAR(100)              DEFAULT NULL,
  `challenge_level`       INT(10) UNSIGNED NOT NULL,
  `challenge_solves`      INT(10) UNSIGNED          DEFAULT '0',
  `challenge_api`         VARCHAR(40)               DEFAULT NULL,
  `challenge_threshold`   INT(12) UNSIGNED NOT NULL,
  PRIMARY KEY (`challenge_id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 7;

--
-- Dumping data for table `challenge_info`
--

INSERT INTO `challenge_info` (`challenge_id`, `challenge_name`, `challenge_type`, `challenge_score`, `challenge_description`, `challenge_hit`, `challenge_level`, `challenge_solves`, `challenge_api`, `challenge_threshold`)
VALUES
  (3, 't1', 'web', 550, 'ttt', '', 1, 2, NULL, 0),
  (4, 't2', 'pwn', 600, '11', '321', 1, 1, NULL, 0),
  (5, 'tt', 'qwb', 600, '321', '', 1, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `dynamic_notify`
--

CREATE TABLE IF NOT EXISTS `dynamic_notify` (
  `notify_id`             INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `team_token`            VARCHAR(40)      NOT NULL,
  `challenge_id`          INT(10) UNSIGNED NOT NULL,
  `challenge_open_time`   INT(11)          NOT NULL,
  `challenge_solved_time` INT(11)                   DEFAULT NULL,
  `challenge_flag`        VARCHAR(50)               DEFAULT NULL,
  PRIMARY KEY (`notify_id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 38;

--
-- Dumping data for table `dynamic_notify`
--

INSERT INTO `dynamic_notify` (`notify_id`, `team_token`, `challenge_id`, `challenge_open_time`, `challenge_solved_time`, `challenge_flag`)
VALUES
  (6, '3a36204c9c0f65dc01c843117803aa59', 3, 1478780129, NULL, '1478780129'),
  (7, '3a36204c9c0f65dc01c843117803aa59', 4, 1478780129, NULL, '1478780129'),
  (8, '273d28b6511cb69ac2c89eddf41cb260', 3, 1478786701, NULL, '1478786701'),
  (9, '273d28b6511cb69ac2c89eddf41cb260', 4, 1478786701, NULL, '1478786701'),
  (10, '273d28b6511cb69ac2c89eddf41cb260', 5, 1478786701, NULL, '1478786701'),
  (11, '85909cb3817f010c3e498740d2e35ee0', 3, 1478876834, NULL, '1478876834'),
  (12, '85909cb3817f010c3e498740d2e35ee0', 4, 1478876834, NULL, '1478876834'),
  (13, '85909cb3817f010c3e498740d2e35ee0', 5, 1478876834, NULL, '1478876834'),
  (14, 'ca309cfbda8476ed38dce1bf7a16e340', 3, 1478932001, NULL, '1478932001'),
  (15, 'ca309cfbda8476ed38dce1bf7a16e340', 4, 1478932001, NULL, '1478932001'),
  (16, 'ca309cfbda8476ed38dce1bf7a16e340', 5, 1478932001, NULL, '1478932001'),
  (17, '4f6eea2e0365c530ab5a65f272b10692', 3, 1479185751, NULL, '1479185751'),
  (18, '4f6eea2e0365c530ab5a65f272b10692', 4, 1479185751, NULL, '1479185751'),
  (19, '4f6eea2e0365c530ab5a65f272b10692', 5, 1479185751, NULL, '1479185751'),
  (20, '3db9ba5015ed7ab4c827ad2dba619f3e', 3, 1479185849, NULL, '1479185849'),
  (21, '3db9ba5015ed7ab4c827ad2dba619f3e', 4, 1479185849, NULL, '1479185849'),
  (22, '3db9ba5015ed7ab4c827ad2dba619f3e', 5, 1479185849, NULL, '1479185849'),
  (23, '1ba7d4c4cc9725d9df6e3855401ff8c5', 3, 1479186054, NULL, '1479186054'),
  (24, '1ba7d4c4cc9725d9df6e3855401ff8c5', 4, 1479186054, NULL, '1479186054'),
  (25, '1ba7d4c4cc9725d9df6e3855401ff8c5', 5, 1479186054, NULL, '1479186054'),
  (26, '00b9c50d31b2961d6dc4e16ffd5b469f', 3, 1479186082, NULL, '1479186082'),
  (27, '00b9c50d31b2961d6dc4e16ffd5b469f', 4, 1479186082, NULL, '1479186082'),
  (28, '00b9c50d31b2961d6dc4e16ffd5b469f', 5, 1479186082, NULL, '1479186082'),
  (29, '5ae820a9498fa024845d47069bb37b39', 3, 1479186092, NULL, '1479186092'),
  (30, '5ae820a9498fa024845d47069bb37b39', 4, 1479186092, NULL, '1479186092'),
  (31, '5ae820a9498fa024845d47069bb37b39', 5, 1479186092, NULL, '1479186092'),
  (32, '35735c18128b30ae79bc9ebc9c38524d', 3, 1479186561, 1479189935, '1479186561'),
  (33, '35735c18128b30ae79bc9ebc9c38524d', 4, 1479186561, NULL, '1479186561'),
  (34, '35735c18128b30ae79bc9ebc9c38524d', 5, 1479186561, NULL, '1479186561'),
  (35, '67429588d082a5b541153b009e268a4e', 3, 1479188898, NULL, '1479188898'),
  (36, '67429588d082a5b541153b009e268a4e', 4, 1479188898, NULL, '1479188898'),
  (37, '67429588d082a5b541153b009e268a4e', 5, 1479188898, NULL, '1479188898');

-- --------------------------------------------------------

--
-- Table structure for table `score_record`
--

CREATE TABLE hctf2016.score_record (
  team_name   VARCHAR(40) NOT NULL,
  team_token  VARCHAR(40) NOT NULL,
  score_a     INT         NOT NULL DEFAULT 0,
  score_b     INT         NOT NULL DEFAULT 0,
  score_c     INT         NOT NULL DEFAULT 0,
  score_d     INT         NOT NULL DEFAULT 0,
  score_e     INT         NOT NULL DEFAULT 0,
  total_score INT         NOT NULL DEFAULT 0
)
  CHARACTER SET = utf8;

-- --------------------------------------------------------

--
-- Table structure for table `team_info`
--

CREATE TABLE IF NOT EXISTS `team_info` (
  `team_id`      INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `team_email`   VARCHAR(40)      NOT NULL,
  `team_name`    VARCHAR(40)      NOT NULL,
  `team_pass`    VARCHAR(40)      NOT NULL,
  `team_school`  VARCHAR(20)      NOT NULL,
  `team_phone`   VARCHAR(15)      NOT NULL,
  `team_token`   VARCHAR(40)      NOT NULL,
  `is_expand`    TINYINT(1)       NOT NULL DEFAULT '0',
  `total_score`  INT(11)          NOT NULL DEFAULT '0',
  `compet_level` INT(10) UNSIGNED NOT NULL DEFAULT '0',
  `is_cheat`     TINYINT(1)       NOT NULL DEFAULT '0',
  `basic_score`  INT(11)          NOT NULL DEFAULT '0',
  `score_update` INT(11)          NOT NULL,
  PRIMARY KEY (`team_id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 24;

--
-- Dumping data for table `team_info`
--

INSERT INTO `team_info` (`team_id`, `team_email`, `team_name`, `team_pass`, `team_school`, `team_phone`, `team_token`, `is_expand`, `total_score`, `compet_level`, `is_cheat`, `basic_score`, `score_update`)
VALUES
  (13, 'test22@a.a', 'test2', '90256bdb83326851e828d351875b4671', 'sc', '4294967295',
       '273d28b6511cb69ac2c89eddf41cb260', 0, 0, 1, 0, 0, 0),
  (14, 'qwe@q.c', 'test', '90256bdb83326851e828d351875b4671', 'school', '1236764357',
       '85909cb3817f010c3e498740d2e35ee0', 0, 0, 1, 0, 0, 0),
  (15, 'test@qq.com', 'test3', '1408a51cd2cd9cea6293536db9544932', 'test', '4294967295',
       'ca309cfbda8476ed38dce1bf7a16e340', 0, 0, 1, 0, 0, 0),
  (17, 'aaaaaa@qq.com', 'evilddog', '73e6b7b85f23db4caa7858c9e86ed3d7', 'xxx', '4294967295',
       '4f6eea2e0365c530ab5a65f272b10692', 0, 0, 1, 0, 0, 0),
  (18, 'e13467211@163.com', 'ddog', '082b00e423dc4ac9a363d278ef08983f', 'HDU', '4294967295',
       '3db9ba5015ed7ab4c827ad2dba619f3e', 0, 0, 1, 0, 0, 0),
  (19, 'hongsinerke@gmail.com', 'Gorilla', 'cdb615d7917fe23ca2158dc7bd59061f', 'HDU', '111111111',
       '1ba7d4c4cc9725d9df6e3855401ff8c5', 0, 0, 1, 0, 0, 0),
  (20, 'a@girigiri.love', '绯色の日照', '2dfd4431a2c524bfc3bbedd42c579414', 'HDU', '4294967295',
       '00b9c50d31b2961d6dc4e16ffd5b469f', 0, 0, 1, 0, 0, 0),
  (21, '85645231@qq.com', '1231', '589fb151dd73cb3d0583b53dc30246c5', '123', '4294967295',
       '5ae820a9498fa024845d47069bb37b39', 0, 0, 1, 0, 0, 0),
  (22, 'j123jtx@126.com', 'test4', '90256bdb83326851e828d351875b4671', 'school', '4294967295',
       '35735c18128b30ae79bc9ebc9c38524d', 0, 550, 1, 0, 50, 1479189935),
  (23, '779041017@qq.com', 'qwertest', 'b968892001cafd24b498e05e7f84d8a2', 'none', '4294967295',
       '67429588d082a5b541153b009e268a4e', 0, 0, 1, 0, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
