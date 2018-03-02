-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `categoryid` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `category` (`id`, `name`, `categoryid`) VALUES
(1,	'ノートパソコン',	'note_pc'),
(2,	'スマートフォン',	'smartphone'),
(3,	'タブレット',	'tablet'),
(4,	'ペンタブレット',	'pen_tablet'),
(5,	'プロジェクター',	'projector'),
(6,	'モバイルWi-Fi',	'wifi');

DROP TABLE IF EXISTS `class`;
CREATE TABLE `class` (
  `id` int(3) NOT NULL,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `class` (`id`, `name`) VALUES
(100,	'診療放射線学科'),
(101,	'臨床工学科'),
(102,	'臨床検査学科'),
(200,	'ウェブ・メディア科'),
(201,	'情報処理科'),
(202,	'情報処理科3年制'),
(203,	'高度情報システム科'),
(204,	'セキュリティ・ネットワーク科'),
(300,	'電子技術科'),
(301,	'電気工学科');

DROP TABLE IF EXISTS `item`;
CREATE TABLE `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `category` int(3) DEFAULT NULL,
  `lending` tinyint(1) NOT NULL DEFAULT '1',
  `month` int(2) DEFAULT NULL,
  `week` int(1) DEFAULT NULL,
  `day` int(1) DEFAULT NULL,
  `path` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `item` (`id`, `name`, `category`, `lending`, `month`, `week`, `day`, `path`) VALUES
(1,	'ノートパソコンWM-S001',	1,	0,	6,	NULL,	NULL,	'IMG_20170904_093201.jpg'),
(2,	'ノートパソコンWM-S002',	1,	1,	6,	NULL,	NULL,	'IMG_20170904_093201.jpg'),
(3,	'ノートパソコンWM-S003',	1,	1,	6,	NULL,	NULL,	'IMG_20170904_093201.jpg'),
(4,	'ノートパソコンWM-S004',	1,	1,	6,	NULL,	NULL,	'IMG_20170904_093201.jpg'),
(5,	'ノートパソコンWM-S005',	1,	1,	6,	NULL,	NULL,	'IMG_20170904_093201.jpg'),
(6,	'ノートパソコンWM-S006',	1,	1,	6,	NULL,	NULL,	'IMG_20170904_093201.jpg'),
(7,	'ノートパソコンWM-S007',	1,	1,	6,	NULL,	NULL,	'IMG_20170904_093201.jpg'),
(8,	'ノートパソコンWM-S008',	1,	1,	6,	NULL,	NULL,	'IMG_20170904_093201.jpg'),
(9,	'ノートパソコンWM-S009',	1,	1,	6,	NULL,	NULL,	'IMG_20170904_093201.jpg'),
(10,	'ノートパソコンWM-S010',	1,	1,	6,	NULL,	NULL,	'IMG_20170904_093201.jpg'),
(11,	'Nexus4 01',	2,	1,	NULL,	1,	NULL,	NULL),
(12,	'Nexus4 02',	2,	1,	NULL,	1,	NULL,	NULL),
(13,	'iPhone6 01',	2,	1,	NULL,	1,	NULL,	NULL),
(14,	'iPhone6 02',	2,	1,	NULL,	1,	NULL,	NULL),
(15,	'Xperia Touch',	2,	1,	NULL,	NULL,	1,	NULL),
(16,	'iPad mini4 01',	3,	1,	NULL,	1,	NULL,	NULL),
(17,	'iPad mini4 02',	3,	1,	NULL,	1,	NULL,	NULL),
(18,	'iPad mini4 03',	3,	1,	NULL,	1,	NULL,	NULL),
(19,	'iPad mini4 04',	3,	1,	NULL,	1,	NULL,	NULL),
(20,	'Wacom Bamboo 01',	4,	1,	3,	NULL,	NULL,	NULL),
(21,	'Wacom Bamboo 02',	4,	1,	3,	NULL,	NULL,	NULL),
(22,	'Wacom Bamboo 03',	4,	1,	3,	NULL,	NULL,	NULL),
(23,	'Wacom Bamboo 04',	4,	1,	3,	NULL,	NULL,	NULL),
(25,	'EPSON プロジェクター 01',	5,	1,	NULL,	NULL,	1,	NULL),
(26,	'EPSON プロジェクター 02',	5,	1,	NULL,	NULL,	1,	NULL),
(27,	'EPSON プロジェクター 03',	5,	1,	NULL,	NULL,	1,	NULL),
(28,	'EPSON プロジェクター 04',	5,	1,	NULL,	NULL,	1,	NULL),
(29,	'WX03 01',	6,	1,	NULL,	NULL,	1,	NULL),
(30,	'WX03 02',	6,	1,	NULL,	NULL,	1,	NULL),
(31,	'WX03 03',	6,	1,	NULL,	NULL,	1,	NULL),
(32,	'Pepper',	NULL,	1,	NULL,	NULL,	1,	NULL),
(33,	'Oculus Rift',	NULL,	1,	NULL,	NULL,	1,	NULL),
(80,	'test',	3,	1,	NULL,	2,	NULL,	NULL),
(101,	'2017/09/16',	NULL,	1,	NULL,	NULL,	18,	NULL),
(103,	'test',	NULL,	1,	NULL,	2,	NULL,	NULL),
(107,	'test',	NULL,	1,	NULL,	NULL,	17,	NULL),
(108,	'tst',	NULL,	1,	NULL,	NULL,	17,	NULL),
(109,	'test',	NULL,	1,	NULL,	NULL,	18,	NULL);

DROP TABLE IF EXISTS `lending`;
CREATE TABLE `lending` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `item` int(11) NOT NULL,
  `period` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `lending` (`id`, `code`, `timestamp`, `item`, `period`) VALUES
(88,	2,	'2017-09-19 22:55:38',	1,	'2017-09-19 00:00:00');

DROP TABLE IF EXISTS `lending_log`;
CREATE TABLE `lending_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `item` int(11) NOT NULL,
  `period` datetime NOT NULL,
  `return_item` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item` (`item`),
  CONSTRAINT `lending_log_ibfk_1` FOREIGN KEY (`item`) REFERENCES `item` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `lending_log` (`id`, `code`, `timestamp`, `item`, `period`, `return_item`) VALUES
(45,	2,	'2017-09-19 22:34:52',	6,	'2017-09-19 00:00:00',	'2017-09-19 22:39:05'),
(46,	2,	'2017-09-19 22:34:52',	4,	'2017-09-19 00:00:00',	'2017-09-19 22:39:05'),
(47,	2,	'2017-09-19 22:34:45',	2,	'2017-09-19 00:00:00',	'2017-09-19 22:39:05'),
(48,	2,	'2017-09-19 22:35:02',	9,	'2017-09-19 00:00:00',	'2017-09-19 22:39:06'),
(49,	2,	'2017-09-19 22:35:01',	7,	'2017-09-19 00:00:00',	'2017-09-19 22:39:06'),
(50,	2,	'2017-09-19 22:34:52',	5,	'2017-09-19 00:00:00',	'2017-09-19 22:39:06'),
(51,	2,	'2017-09-19 22:34:45',	3,	'2017-09-19 00:00:00',	'2017-09-19 22:39:06'),
(52,	2,	'2017-09-19 22:34:45',	1,	'2017-09-19 00:00:00',	'2017-09-19 22:39:06'),
(53,	2,	'2017-09-19 22:35:34',	15,	'2017-09-19 00:00:00',	'2017-09-19 22:39:06'),
(54,	2,	'2017-09-19 22:35:24',	11,	'2017-09-19 00:00:00',	'2017-09-19 22:39:06'),
(55,	2,	'2017-09-19 22:35:23',	13,	'2017-09-19 00:00:00',	'2017-09-19 22:39:07'),
(56,	2,	'2017-09-19 22:35:34',	12,	'2017-09-19 00:00:00',	'2017-09-19 22:39:07'),
(57,	2,	'2017-09-19 22:35:02',	8,	'2017-09-19 00:00:00',	'2017-09-19 22:39:16'),
(58,	2,	'2017-09-19 22:35:07',	10,	'2017-09-19 00:00:00',	'2017-09-19 22:39:16'),
(59,	2,	'2017-09-19 22:36:04',	10,	'2017-09-19 00:00:00',	'2017-09-19 22:39:16'),
(61,	2,	'2017-09-19 22:35:24',	14,	'2017-09-19 00:00:00',	'2017-09-19 22:39:23'),
(62,	2,	'2017-09-19 22:35:54',	17,	'2017-09-19 00:00:00',	'2017-09-19 22:39:23'),
(63,	2,	'2017-09-19 22:36:04',	80,	'2017-09-19 00:00:00',	'2017-09-19 22:39:23'),
(64,	2,	'2017-09-19 22:35:54',	18,	'2017-09-19 00:00:00',	'2017-09-19 22:39:23'),
(65,	2,	'2017-09-19 22:35:34',	16,	'2017-09-19 00:00:00',	'2017-09-19 22:39:23'),
(66,	2,	'2017-09-19 22:35:54',	19,	'2017-09-19 00:00:00',	'2017-09-19 22:39:23'),
(67,	2,	'2017-09-19 22:36:04',	20,	'2017-09-19 00:00:00',	'2017-09-19 22:39:23');

DROP TABLE IF EXISTS `master`;
CREATE TABLE `master` (
  `code` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `administrator` tinyint(1) NOT NULL DEFAULT '0',
  `mail` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `master` (`code`, `id`, `name`, `pass`, `administrator`, `mail`) VALUES
(1,	'16AA0000',	'master',	'81dc9bdb52d04dc20036dbd8313ed055',	1,	'test@test.com'),
(2,	'16ZZ9999',	'権限が有る先生',	'81dc9bdb52d04dc20036dbd8313ed055',	1,	'test@test.com'),
(3,	'15ZZ9999',	'権限が無い先生',	'81dc9bdb52d04dc20036dbd8313ed055',	0,	'test@test.com');

DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `code` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `class` int(3) NOT NULL,
  `rejection` tinyint(1) NOT NULL DEFAULT '1',
  `mail` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `student` (`code`, `id`, `name`, `pass`, `class`, `rejection`, `mail`) VALUES
(1000,	'16AB0016',	'加藤友樹',	'd41d8cd98f00b204e9800998ecf8427e',	200,	1,	'test@test.com'),
(1001,	'16AB0014',	'富田龍',	'81dc9bdb52d04dc20036dbd8313ed055',	200,	1,	'test@test.com'),
(1002,	'﻿15AB1101',	'桑原',	'81dc9bdb52d04dc20036dbd8313ed055',	200,	1,	'test@test.com'),
(1003,	'﻿16AB0022',	'山口拓海',	'81dc9bdb52d04dc20036dbd8313ed055',	200,	1,	'test@test.com'),
(1008,	'﻿16AB0024',	'浅井雄太',	'161ebd7d45089b3446ee4e0d86dbcf92',	200,	0,	'asai.web.tec@gmail.com');

-- 2017-09-19 15:36:58
