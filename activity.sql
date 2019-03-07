-- Adminer 4.6.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `activity`;
CREATE DATABASE `activity` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `activity`;

DROP TABLE IF EXISTS `activity`;
CREATE TABLE `activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  CONSTRAINT `activity_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `activity_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `activity` (`id`, `name`, `description`, `image`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(47,	'ค่าย4ชั้นปี',	'',	NULL,	'2019-02-05 15:11:08',	57,	'2019-02-05 15:19:02',	57),
(49,	'test',	'<p><strong>test </strong>a</p>',	NULL,	'2019-03-01 05:03:59',	57,	'2019-03-01 05:03:59',	57),
(50,	'สุดจัดปลัดบอก',	'<p>ขนาดปลัดลาออกยังบอกว่าสุด<u>จัด</u></p><p>ฟห</p><p>ปผแ</p><p>ผปแผ</p><p>ปแผ</p><p>ปแ</p><p>ผปแ</p><p>ผปแ</p><p>ผปแ</p><p>ผปแ</p><p>ผปแ</p><p>ผป</p><p>แผ</p><p>ปแผป</p><p>แผป</p><p>แผ</p><p>ปแผ</p><p>ปแผป</p><p>แผป</p><p>แผ</p><ul><li>ปแ</li></ul><p>ผปแผปแ</p><p>ผปแ</p><p>ปผแ</p><p>ผปแ</p><p>ปผแ</p><ul><li>ปผแ</li></ul><p>ผป</p><p>แ</p>',	NULL,	'2019-03-01 05:07:15',	57,	'2019-03-01 05:07:15',	57),
(51,	'ไปเที่ยว 3 way',	'<p>ออกกทางปปปปป<u>ปปปปป</u></p><p><br></p><p><a href=\"https://www.facebook.com/\" target=\"_blank\">facebook</a></p><p><br></p><ul><li>asdsdasdsa</li></ul>',	NULL,	'2019-03-03 19:37:40',	57,	'2019-03-03 19:37:40',	57),
(54,	'ทดสอบ',	'<p>ไม่มี</p>',	NULL,	'2019-03-04 14:34:00',	56,	'2019-03-04 14:34:00',	56),
(55,	'เทส',	'<p>ททท</p>',	NULL,	'2019-03-04 14:42:29',	56,	'2019-03-04 14:42:29',	56),
(56,	'test',	'<p>wdwd</p>',	NULL,	'2019-03-04 16:59:28',	57,	'2019-03-04 16:59:28',	57),
(57,	'test',	'<p>test</p>',	'assets/upload/image/49844038_415622985645433_2333908456846896217_n.jpg',	'2019-03-04 21:19:44',	57,	'2019-03-04 21:21:15',	57);

DROP TABLE IF EXISTS `activity_details`;
CREATE TABLE `activity_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_id` int(11) NOT NULL,
  `day_start` date NOT NULL,
  `day_end` date NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `term_year` int(11) NOT NULL,
  `term_sector` int(11) NOT NULL,
  `location` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `term_year` (`term_year`,`term_sector`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `activity_id` (`activity_id`),
  CONSTRAINT `activity_details_ibfk_1` FOREIGN KEY (`term_year`, `term_sector`) REFERENCES `terms` (`year`, `sector`),
  CONSTRAINT `activity_details_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `activity_details_ibfk_4` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`),
  CONSTRAINT `activity_details_ibfk_5` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `activity_details` (`id`, `activity_id`, `day_start`, `day_end`, `time_start`, `time_end`, `term_year`, `term_sector`, `location`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(56,	51,	'2019-03-04',	'2019-03-04',	'08:00:00',	'16:00:00',	2561,	1,	'1',	'2019-03-04 16:22:01',	57,	'2019-03-04 16:22:01',	57),
(57,	56,	'2019-03-05',	'2019-03-06',	'08:00:00',	'16:00:00',	2561,	1,	'sadas',	'2019-03-04 17:00:23',	57,	'2019-03-04 17:00:23',	57),
(58,	57,	'2019-03-08',	'2019-03-09',	'08:00:00',	'16:00:00',	2561,	1,	'11',	'2019-03-04 22:22:47',	57,	'2019-03-04 22:22:47',	57);

DROP TABLE IF EXISTS `albumactivity`;
CREATE TABLE `albumactivity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activityID` int(11) DEFAULT NULL,
  `albumName` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `albumactivitydetail`;
CREATE TABLE `albumactivitydetail` (
  `id` int(11) NOT NULL,
  `albumID` int(11) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `name_file` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `participations`;
CREATE TABLE `participations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_detail_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`),
  KEY `activity_detail_id` (`activity_detail_id`),
  CONSTRAINT `participations_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  CONSTRAINT `participations_ibfk_4` FOREIGN KEY (`activity_detail_id`) REFERENCES `activity_details` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `participations` (`id`, `activity_detail_id`, `student_id`) VALUES
(377,	56,	58112418),
(378,	56,	58112970),
(379,	56,	58113341),
(380,	56,	58120379),
(381,	56,	58122516),
(382,	56,	58122526),
(383,	56,	58123472),
(384,	56,	58140500),
(385,	56,	58141623),
(386,	56,	58142753),
(387,	56,	58143033),
(388,	56,	58145236),
(389,	56,	58148602),
(390,	57,	58112418),
(391,	57,	58112970),
(392,	57,	58113341),
(393,	57,	58122516),
(394,	57,	58141623),
(395,	57,	58142753),
(396,	57,	58143033),
(397,	57,	58145236),
(398,	58,	58112418),
(399,	58,	58112970),
(400,	58,	58113341),
(401,	58,	58122516),
(402,	58,	58141623),
(403,	58,	58142753),
(404,	58,	58143033),
(405,	58,	58145236);

DROP TABLE IF EXISTS `positions`;
CREATE TABLE `positions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `positions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1,	'นักวิชาการ',	'2019-01-09 23:04:35',	'2019-01-24 19:45:47'),
(2,	'อาจารย์',	'2019-01-24 19:45:32',	'2019-01-24 19:45:32'),
(3,	'ประธานหลักสูตร',	'2019-01-09 23:05:16',	'2019-01-09 23:05:20');

DROP TABLE IF EXISTS `rank_checks`;
CREATE TABLE `rank_checks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `participation_id` int(11) NOT NULL,
  `date_check` date NOT NULL,
  `time` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `participation_id` (`participation_id`),
  CONSTRAINT `rank_checks_ibfk_3` FOREIGN KEY (`participation_id`) REFERENCES `participations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `rank_checks` (`id`, `participation_id`, `date_check`, `time`, `status`) VALUES
(883,	377,	'2019-03-04',	'เช้า',	0),
(884,	377,	'2019-03-04',	'บ่าย',	0),
(885,	378,	'2019-03-04',	'เช้า',	0),
(886,	378,	'2019-03-04',	'บ่าย',	0),
(887,	379,	'2019-03-04',	'เช้า',	0),
(888,	379,	'2019-03-04',	'บ่าย',	0),
(889,	380,	'2019-03-04',	'เช้า',	0),
(890,	380,	'2019-03-04',	'บ่าย',	0),
(891,	381,	'2019-03-04',	'เช้า',	0),
(892,	381,	'2019-03-04',	'บ่าย',	0),
(893,	382,	'2019-03-04',	'เช้า',	0),
(894,	382,	'2019-03-04',	'บ่าย',	0),
(895,	383,	'2019-03-04',	'เช้า',	0),
(896,	383,	'2019-03-04',	'บ่าย',	0),
(897,	384,	'2019-03-04',	'เช้า',	0),
(898,	384,	'2019-03-04',	'บ่าย',	0),
(899,	385,	'2019-03-04',	'เช้า',	0),
(900,	385,	'2019-03-04',	'บ่าย',	0),
(901,	386,	'2019-03-04',	'เช้า',	0),
(902,	386,	'2019-03-04',	'บ่าย',	0),
(903,	387,	'2019-03-04',	'เช้า',	0),
(904,	387,	'2019-03-04',	'บ่าย',	0),
(905,	388,	'2019-03-04',	'เช้า',	0),
(906,	388,	'2019-03-04',	'บ่าย',	0),
(907,	389,	'2019-03-04',	'เช้า',	0),
(908,	389,	'2019-03-04',	'บ่าย',	0),
(909,	390,	'2019-03-05',	'เช้า',	0),
(910,	390,	'2019-03-05',	'บ่าย',	0),
(911,	390,	'2019-03-06',	'เช้า',	0),
(912,	390,	'2019-03-06',	'บ่าย',	0),
(913,	391,	'2019-03-05',	'เช้า',	0),
(914,	391,	'2019-03-05',	'บ่าย',	0),
(915,	391,	'2019-03-06',	'เช้า',	0),
(916,	391,	'2019-03-06',	'บ่าย',	0),
(917,	392,	'2019-03-05',	'เช้า',	0),
(918,	392,	'2019-03-05',	'บ่าย',	0),
(919,	392,	'2019-03-06',	'เช้า',	0),
(920,	392,	'2019-03-06',	'บ่าย',	0),
(921,	393,	'2019-03-05',	'เช้า',	0),
(922,	393,	'2019-03-05',	'บ่าย',	0),
(923,	393,	'2019-03-06',	'เช้า',	0),
(924,	393,	'2019-03-06',	'บ่าย',	0),
(925,	394,	'2019-03-05',	'เช้า',	0),
(926,	394,	'2019-03-05',	'บ่าย',	0),
(927,	394,	'2019-03-06',	'เช้า',	0),
(928,	394,	'2019-03-06',	'บ่าย',	0),
(929,	395,	'2019-03-05',	'เช้า',	0),
(930,	395,	'2019-03-05',	'บ่าย',	0),
(931,	395,	'2019-03-06',	'เช้า',	0),
(932,	395,	'2019-03-06',	'บ่าย',	0),
(933,	396,	'2019-03-05',	'เช้า',	0),
(934,	396,	'2019-03-05',	'บ่าย',	0),
(935,	396,	'2019-03-06',	'เช้า',	0),
(936,	396,	'2019-03-06',	'บ่าย',	0),
(937,	397,	'2019-03-05',	'เช้า',	0),
(938,	397,	'2019-03-05',	'บ่าย',	0),
(939,	397,	'2019-03-06',	'เช้า',	0),
(940,	397,	'2019-03-06',	'บ่าย',	0),
(941,	398,	'2019-03-08',	'เช้า',	0),
(942,	398,	'2019-03-08',	'บ่าย',	0),
(943,	398,	'2019-03-09',	'เช้า',	0),
(944,	398,	'2019-03-09',	'บ่าย',	0),
(945,	399,	'2019-03-08',	'เช้า',	0),
(946,	399,	'2019-03-08',	'บ่าย',	0),
(947,	399,	'2019-03-09',	'เช้า',	0),
(948,	399,	'2019-03-09',	'บ่าย',	0),
(949,	400,	'2019-03-08',	'เช้า',	0),
(950,	400,	'2019-03-08',	'บ่าย',	0),
(951,	400,	'2019-03-09',	'เช้า',	0),
(952,	400,	'2019-03-09',	'บ่าย',	0),
(953,	401,	'2019-03-08',	'เช้า',	0),
(954,	401,	'2019-03-08',	'บ่าย',	0),
(955,	401,	'2019-03-09',	'เช้า',	0),
(956,	401,	'2019-03-09',	'บ่าย',	0),
(957,	402,	'2019-03-08',	'เช้า',	0),
(958,	402,	'2019-03-08',	'บ่าย',	0),
(959,	402,	'2019-03-09',	'เช้า',	0),
(960,	402,	'2019-03-09',	'บ่าย',	0),
(961,	403,	'2019-03-08',	'เช้า',	0),
(962,	403,	'2019-03-08',	'บ่าย',	0),
(963,	403,	'2019-03-09',	'เช้า',	0),
(964,	403,	'2019-03-09',	'บ่าย',	0),
(965,	404,	'2019-03-08',	'เช้า',	0),
(966,	404,	'2019-03-08',	'บ่าย',	0),
(967,	404,	'2019-03-09',	'เช้า',	0),
(968,	404,	'2019-03-09',	'บ่าย',	0),
(969,	405,	'2019-03-08',	'เช้า',	0),
(970,	405,	'2019-03-08',	'บ่าย',	0),
(971,	405,	'2019-03-09',	'เช้า',	0),
(972,	405,	'2019-03-09',	'บ่าย',	0);

DROP TABLE IF EXISTS `responsibilities`;
CREATE TABLE `responsibilities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) NOT NULL,
  `activity_detail_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `teacher_id` (`teacher_id`),
  KEY `activity_detail_id` (`activity_detail_id`),
  CONSTRAINT `responsibilities_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`),
  CONSTRAINT `responsibilities_ibfk_3` FOREIGN KEY (`activity_detail_id`) REFERENCES `activity_details` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `responsibilities` (`id`, `teacher_id`, `activity_detail_id`) VALUES
(90,	8,	56),
(91,	9,	56),
(92,	11,	56),
(93,	12,	56),
(94,	13,	56),
(95,	12,	57),
(96,	9,	58),
(97,	12,	58);

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `isAdmin` bit(1) NOT NULL,
  `isTeacher` bit(1) NOT NULL,
  `isHeadTeacher` bit(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `roles` (`id`, `name`, `isAdmin`, `isTeacher`, `isHeadTeacher`, `created_at`, `updated_at`) VALUES
(1,	'ผู้ดูแลระบบ',	CONV('1', 2, 10) + 0,	CONV('0', 2, 10) + 0,	CONV('0', 2, 10) + 0,	'2019-01-09 23:03:53',	'2019-01-09 23:03:57'),
(2,	'อาจารย์',	CONV('0', 2, 10) + 0,	CONV('1', 2, 10) + 0,	CONV('0', 2, 10) + 0,	'2019-01-09 23:04:10',	'2019-01-09 23:04:13'),
(3,	'ประธานหลักสูตร',	CONV('0', 2, 10) + 0,	CONV('0', 2, 10) + 0,	CONV('1', 2, 10) + 0,	'2019-01-24 20:24:54',	'2019-01-24 20:24:54');

DROP TABLE IF EXISTS `students`;
CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prefix` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci,
  `year` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `students` (`id`, `user_id`, `prefix`, `firstname`, `lastname`, `image`, `year`, `tel`, `email`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`) VALUES
(58112418,	34,	'นาย',	'ฉลองราช',	'ประสิทธิวงศ์',	NULL,	'2558',	NULL,	NULL,	'2019-01-20 03:08:25',	NULL,	'2019-03-07 12:36:09',	NULL,	NULL),
(58112970,	22,	'นางสาว',	'ชิดชนก',	'ยีสมัน',	NULL,	'2558',	NULL,	NULL,	'2019-01-20 02:47:47',	NULL,	'2019-03-07 12:36:10',	NULL,	NULL),
(58113341,	23,	'นางสาว',	'ฏอฮีเราะฮ์',	'ฮูซัยนี',	NULL,	'2558',	NULL,	NULL,	'2019-01-20 02:49:34',	NULL,	'2019-03-07 12:36:11',	NULL,	NULL),
(58120379,	27,	'นาย',	'วุฒิชัย',	'เพ็ชร์ทอง',	NULL,	'2558',	NULL,	NULL,	'2019-01-20 02:54:22',	NULL,	'2019-03-07 12:36:12',	NULL,	NULL),
(58122516,	11,	'นาย',	'หฤษฎ์',	'คงทอง',	NULL,	'2558',	NULL,	NULL,	'2019-01-19 23:08:31',	NULL,	'2019-03-07 12:36:13',	NULL,	NULL),
(58122526,	65,	'นาย',	'หฤษฎ์',	'หฤษฎ์',	NULL,	'2558',	NULL,	NULL,	'2019-03-03 04:31:01',	NULL,	'2019-03-07 12:37:14',	NULL,	'2019-03-07 12:37:14'),
(58123472,	64,	'นาย',	'ชิด',	'วว',	NULL,	'2558',	NULL,	NULL,	'2019-02-06 16:03:04',	NULL,	'2019-03-07 12:36:58',	NULL,	'2019-03-07 12:36:58'),
(58140500,	24,	'นาย',	'กิตปกรณ์',	'ทองเงิน',	NULL,	'2558',	NULL,	NULL,	'2019-01-20 02:50:33',	NULL,	'2019-03-07 12:36:40',	NULL,	'2019-03-07 12:36:40'),
(58141623,	25,	'นาย',	'ทัศวัฒน์',	'รัตนพันธ์',	NULL,	'2558',	NULL,	NULL,	'2019-01-20 02:51:15',	NULL,	'2019-03-07 12:36:16',	NULL,	NULL),
(58142753,	35,	'นางสาว',	'ประภาพร',	'มั่งมี',	NULL,	'2558',	NULL,	NULL,	'2019-01-20 03:09:18',	NULL,	'2019-03-07 12:36:18',	NULL,	NULL),
(58143033,	32,	'นาย',	'พงศธร',	'จันด้วง',	NULL,	'2558',	NULL,	NULL,	'2019-01-20 03:02:54',	NULL,	'2019-03-07 12:36:19',	NULL,	NULL),
(58145236,	31,	'นางสาว',	'สุดารัตน์',	'ผิวอ่อน',	NULL,	'2558',	NULL,	NULL,	'2019-01-20 03:01:20',	NULL,	'2019-03-07 12:36:20',	NULL,	NULL),
(58148602,	33,	'นางสาว',	'สิริพร',	'พุทธวิริยะ',	NULL,	'2558',	NULL,	NULL,	'2019-01-20 03:03:39',	NULL,	'2019-03-07 12:36:31',	NULL,	'2019-03-07 12:36:31'),
(61122516,	66,	'นาย',	'หฤษฎ์',	'คงทอง',	NULL,	'2561',	NULL,	NULL,	'2019-03-07 12:13:28',	NULL,	'2019-03-07 12:36:22',	NULL,	NULL);

DROP TABLE IF EXISTS `teachers`;
CREATE TABLE `teachers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `prefix` text COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci,
  `tel` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `room` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `position_id` (`position_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `teachers_ibfk_2` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`),
  CONSTRAINT `teachers_ibfk_3` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `teachers` (`id`, `user_id`, `position_id`, `role_id`, `prefix`, `firstname`, `lastname`, `image`, `tel`, `email`, `room`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`) VALUES
(8,	55,	2,	2,	'ผู้ช่วยศาสตราจารย์ ดร.',	'ฐิมาพร',	'เพชรแก้ว',	NULL,	'2275456461',	'pthimapo2@wu.ac.th',	'c3',	'2019-01-27 22:34:34',	0,	'2019-03-07 15:49:05',	0,	NULL),
(9,	56,	3,	3,	'อาจารย์ ดร.',	'กรัณรัตน์',	'ธรรมรักษ์',	NULL,	'0899999999',	'kanchan.th@wu.ac.th',	'อาคารวิชาการ3',	'2019-01-27 22:36:34',	0,	'2019-03-07 15:08:18',	0,	NULL),
(10,	57,	1,	1,	'นาย',	'ประทีป',	'คงกล้า',	NULL,	'',	'pra@wu.ac.th',	'ตึกนวัตรกรรม',	'2019-01-27 22:37:37',	0,	'2019-03-07 15:04:14',	0,	NULL),
(11,	58,	2,	2,	'ผู้ช่วยศาสตราจารย์',	'อุหมาด',	'หมัดอาด้ำ',	NULL,	'0899909099',	'muhamard@wu.ac.th',	'อาคารวิชาการ3',	'2019-01-27 22:41:14',	0,	'2019-03-07 15:08:19',	0,	NULL),
(12,	59,	2,	2,	'อาจารย์ ดร.',	'พุทธิพร',	'ธนธรรมเมธี',	NULL,	'0800000000',	'putthiporn.th@wu.ac.th',	'อาคารวิชาการ3',	'2019-01-27 22:43:19',	0,	'2019-03-07 15:08:20',	0,	NULL),
(13,	60,	2,	2,	'ผู้ช่วยศาสตราจารย์',	'เยาวเรศ',	'ศิริสถิตย์กุล',	NULL,	'',	'syaowara@wu.ac.th',	'อาคารวิชาการ3',	'2019-01-27 22:44:52',	0,	'2019-03-07 15:08:21',	0,	NULL);

DROP TABLE IF EXISTS `terms`;
CREATE TABLE `terms` (
  `year` int(4) NOT NULL,
  `sector` int(1) NOT NULL,
  PRIMARY KEY (`year`,`sector`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `terms` (`year`, `sector`) VALUES
(2558,	1),
(2558,	2),
(2558,	3),
(2559,	1),
(2559,	2),
(2559,	3),
(2560,	1),
(2560,	3),
(2561,	1),
(2561,	2),
(2561,	3);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` text COLLATE utf8_unicode_ci,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `users` (`id`, `username`, `password`, `remember_token`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(11,	'58122516',	'$2y$10$YS4BlqPJwGcxmGaJktXbket6kvqc87VLe/2hrZ692ApMtZmghH34a',	NULL,	'2019-01-27 22:26:38',	'',	'2019-01-27 22:26:38',	NULL),
(22,	'58112970',	'$2y$10$z1jgJaJYCyASdYwYQwaTY.rE1WnAaKtgamrY5lGB13eZzKwHbh4Oq',	NULL,	'2019-01-27 22:26:08',	'',	'2019-01-27 22:26:08',	NULL),
(23,	'58113341',	'$2y$10$YQj0OYHm.KkkuskDVOdSfOAvU7YNCayQpDRw1n3brVozK01MsrezW',	NULL,	'2019-01-27 22:26:27',	'',	'2019-01-27 22:26:27',	NULL),
(24,	'58140500',	'$2y$10$U9Qn.66XD4i2Q8bxejBrce/sCl2wvt3pSpLW5eUvwlpdl90M9Fdqa',	NULL,	'2019-01-27 22:26:46',	'',	'2019-01-27 22:26:46',	NULL),
(25,	'58141623',	'$2y$10$hc2GQPUXjYR8E6eqzHbN6O7QEOoSizFtA2d8iEuzK7NhYYB.iZ8oi',	NULL,	'2019-01-27 22:27:08',	'',	'2019-01-27 22:27:08',	NULL),
(27,	'58120379',	'$2y$10$7hCHW00i.fghuhEuHOz39efvHSKQWEIn3TBrZvyjDRU75dsjwvqXO',	NULL,	'2019-01-27 22:26:33',	'',	'2019-01-27 22:26:33',	NULL),
(31,	'58145236',	'$2y$10$XoIwwT0UnvxWA5ssUf283eSgxWYz3VSMNBLZFwd9poaJZ5O.vg7Iy',	'2bnfdDADgNt4ImwqPPiurpTqOrSngqQOVGeZAfXCxP4PoDkGg2ClVZkTRZAo',	'2019-02-13 20:21:37',	'',	'2019-02-13 20:21:37',	NULL),
(32,	'58143033',	'$2y$10$bAUoKVrgiN2nIr/6FZINOub7zFin7j1qWeXgFn7II0hA0RM1oyoWa',	NULL,	'2019-01-27 22:27:01',	'',	'2019-01-27 22:27:01',	NULL),
(33,	'58148602',	'$2y$10$aMjdrrG5.P.SDwnXLyBAT.TRTnexVrIxyL3MJ8t1py1jwJj7Ixbji',	'wcyQtO3KTqX6mzVoM9pdkIfFmvaAYQ4JMRrgwBM4eQMjHeZ96AhYQBheGxNe',	'2019-01-27 22:27:42',	'',	'2019-01-27 22:27:42',	NULL),
(34,	'58112418',	'$2y$10$ZczyhQGcf4tEeObppttkKO9FwnifNshwE0u1FFJvEltO33EpBqRyK',	NULL,	'2019-01-27 22:26:13',	'',	'2019-01-27 22:26:13',	NULL),
(35,	'58142753',	'$2y$10$gv8/9kUY0bPziyuxp5Q18eC3dXCptrPGaNJURei0LuDOy.JDE1mMe',	NULL,	'2019-01-27 22:27:04',	'',	'2019-01-27 22:27:04',	NULL),
(55,	'pthimapo2@wu.ac.th',	'$2y$10$LSA1n/xcA4JVRfAuwv9aa.mOtXzTY.rLH9tdqpMSSGXBEe61K6QcS',	NULL,	'2019-03-07 15:49:05',	'',	'2019-03-07 15:49:05',	NULL),
(56,	'kanchan.th@wu.ac.th',	'$2y$10$hcmyFbQ0MOqD9/37bpSREOAYNeWmttQsF770Qp633Z86T6d5WpDWK',	'N93lJFVKTo4USV2YDJvUVxJm27nH4u98pryikYu4Bfqy2v698hyvet4CWWuS',	'2019-03-04 17:10:38',	'',	'2019-03-04 17:10:38',	NULL),
(57,	'pra@wu.ac.th',	'$2y$10$A.lILFswamQywIkyiVhEn.eUOH4UkFdOs2MOe2NEN8UkMd78akSey',	'tUMumYYU6Lz7TxlBTEDq3S5bP03LZkXAMLq17qRnThCsxizuXixK4mBRfVvd',	'2019-03-04 17:04:55',	'',	'2019-03-04 17:04:55',	NULL),
(58,	'muhamard@wu.ac.th',	'$2y$10$cjlExpqXoFsdtfqfO8oRxOzGAvxW6VBRhDf1haWT0JvW3i1qH8K0.',	NULL,	'2019-02-05 12:46:46',	'',	'2019-02-05 12:46:46',	NULL),
(59,	'putthiporn.th@wu.ac.th',	'$2y$10$4iixfs8x4vmUj22ktXQMLe22s59bFZZSycs2EJc7XT0m9JXYu51a.',	NULL,	'2019-02-05 12:43:17',	'',	'2019-02-05 12:43:17',	NULL),
(60,	'syaowara@wu.ac.th',	'$2y$10$EE5FpFUInqFHI4JbMxffi.ciyNbmFOifx8G/uwfl7ia9TpvCv3lU2',	NULL,	'2019-02-05 12:45:12',	'',	'2019-02-05 12:45:12',	NULL),
(61,	'59131121',	'$2y$10$cY.rnGcJfh2wOScG2FcWiej0nUA1jnXDEx5hKDKU6aaS29JAjbf4C',	NULL,	'2019-01-29 12:02:13',	'',	'2019-01-29 12:02:13',	NULL),
(64,	'58123472',	'$2y$10$XLAt9Uwuy1SMv2eW8HeNz.MkExPT0VSH3Pz..gnLcOWhB4c8iL4/6',	NULL,	'2019-02-06 16:03:04',	'',	'2019-02-06 16:03:04',	NULL),
(65,	'58122526',	'$2y$10$OR3IPEfCe3x9vxmWD401KOfLRASzgF59X8e43txzGC6Bd0zZuPuqq',	NULL,	'2019-03-03 04:31:01',	'',	'2019-03-03 04:31:01',	NULL),
(66,	'61122516',	'$2y$10$qiPifv6D/9pgAAKN.v17UOs5MeH1nVh5DoJdft/l.6BNiv.GqDwJK',	NULL,	'2019-03-07 12:13:28',	'',	'2019-03-07 12:13:28',	NULL);

-- 2019-03-07 10:41:35
-- 2019-03-04 09:10:11
