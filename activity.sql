-- Adminer 4.6.1 MySQL dump

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
  `activity_name` char(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `teacher` text COLLATE utf8_unicode_ci NOT NULL,
  `day_start` date NOT NULL,
  `day_end` date NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `term_year` int(11) NOT NULL,
  `sector` int(11) NOT NULL,
  `location` text COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci,
  `student` text COLLATE utf8_unicode_ci,
  `created_at` datetime NOT NULL,
  `created_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `activity` (`id`, `activity_name`, `description`, `teacher`, `day_start`, `day_end`, `time_start`, `time_end`, `term_year`, `sector`, `location`, `image`, `student`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(46,	'swe test',	'นำอุปกรณ์มาด้วย',	'[\"8\",\"11\"]',	'2019-01-29',	'2019-01-29',	'10:00:00',	'18:00:00',	3,	2562,	'ตึกนวัตกรรม',	'assets/upload/image/11825220_867411680001867_6321219218084251301_n.jpg',	'[\"1\",\"2\",\"3\",\"4\"]',	'2019-01-29 11:50:40',	'',	'2019-02-05 15:06:50',	''),
(47,	'ค่าย4ชั้นปี',	'',	'[\"9\",\"12\",\"13\"]',	'2019-02-11',	'2019-02-12',	'09:00:00',	'16:00:00',	2,	2561,	'อาคารนวัตกรรม',	NULL,	'[\"1\",\"2\",\"3\",\"4\",\"5\"]',	'2019-02-05 15:11:08',	'',	'2019-02-05 15:19:02',	'');

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


DROP TABLE IF EXISTS `checking`;
CREATE TABLE `checking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activityID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `checking` (`id`, `activityID`, `userID`, `status`) VALUES
(2,	42,	1,	1);

DROP TABLE IF EXISTS `participation`;
CREATE TABLE `participation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activityID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


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

DROP TABLE IF EXISTS `responsible`;
CREATE TABLE `responsible` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activityID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


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
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `students` (`id`, `user_id`, `prefix`, `firstname`, `lastname`, `image`, `year`, `tel`, `email`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(11123456,	63,	'นางสาว',	'ฟาร์',	'sud',	NULL,	'2559',	NULL,	NULL,	'2019-02-05 15:24:28',	NULL,	'2019-02-05 15:25:27',	NULL),
(58112418,	34,	'นาย',	'ฉลองราช',	'ประสิทธิวงศ์',	NULL,	'2558',	NULL,	NULL,	'2019-01-20 03:08:25',	NULL,	'2019-01-26 18:54:31',	NULL),
(58112970,	22,	'นางสาว',	'ชิดชนก',	'ยีสมัน',	NULL,	'2558',	NULL,	NULL,	'2019-01-20 02:47:47',	NULL,	'2019-01-27 20:03:05',	NULL),
(58113341,	23,	'นางสาว',	'ฏอฮีเราะฮ์',	'ฮูซัยนี',	NULL,	'2558',	NULL,	NULL,	'2019-01-20 02:49:34',	NULL,	'2019-01-27 20:10:07',	NULL),
(58120379,	27,	'นาย',	'วุฒิชัย',	'เพ็ชร์ทอง',	NULL,	'2558',	NULL,	NULL,	'2019-01-20 02:54:22',	NULL,	'2019-01-27 20:03:45',	NULL),
(58122516,	11,	'นาย',	'หฤษฎ์',	'คงทอง',	NULL,	'2558',	NULL,	NULL,	'2019-01-19 23:08:31',	NULL,	'2019-01-27 20:04:30',	NULL),
(58123472,	64,	'นาย',	'ชิด',	'วว',	NULL,	'2555',	NULL,	NULL,	'2019-02-06 16:03:04',	NULL,	'2019-02-06 16:03:04',	NULL),
(58140500,	24,	'นาย',	'กิตปกรณ์',	'ทองเงิน',	NULL,	'2560',	NULL,	NULL,	'2019-01-20 02:50:33',	NULL,	'2019-01-27 20:10:17',	NULL),
(58141623,	25,	'นาย',	'ทัศวัฒน์',	'รัตนพันธ์',	NULL,	'2558',	NULL,	NULL,	'2019-01-20 02:51:15',	NULL,	'2019-01-27 20:10:24',	NULL),
(58142753,	35,	'นางสาว',	'ประภาพร',	'มั่งมี',	NULL,	'2558',	NULL,	NULL,	'2019-01-20 03:09:18',	NULL,	'2019-01-27 20:10:33',	NULL),
(58143033,	32,	'นาย',	'พงศธร',	'จันด้วง',	NULL,	'2558',	NULL,	NULL,	'2019-01-20 03:02:54',	NULL,	'2019-01-27 20:10:47',	NULL),
(58145236,	31,	'นางสาว',	'สุดารัตน์',	'ผิวอ่อน',	NULL,	'2558',	NULL,	NULL,	'2019-01-20 03:01:20',	NULL,	'2019-01-27 20:12:54',	NULL),
(58148602,	33,	'นางสาว',	'สิริพร',	'พุทธวิริยะ',	NULL,	'2559',	NULL,	NULL,	'2019-01-20 03:03:39',	NULL,	'2019-01-27 20:13:04',	NULL),
(59131121,	61,	'นางสาว',	'สวย',	'สุุด',	NULL,	'2559',	NULL,	NULL,	'2019-01-29 12:02:13',	NULL,	'2019-01-29 12:02:13',	NULL);

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
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `position_id` (`position_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `teachers_ibfk_2` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`),
  CONSTRAINT `teachers_ibfk_3` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `teachers` (`id`, `user_id`, `position_id`, `role_id`, `prefix`, `firstname`, `lastname`, `image`, `tel`, `email`, `room`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(8,	55,	2,	2,	'ผู้ช่วยศาสตราจารย์ ดร.',	'ฐิมาพร',	'เพชรแก้ว',	NULL,	'2275456461',	'pthimapo@wu.ac.th',	'c3',	'2019-01-27 22:34:34',	0,	'2019-02-05 12:51:16',	0),
(9,	56,	3,	3,	'อาจารย์ ดร.',	'กรัณรัตน์',	'ธรรมรักษ์',	NULL,	'0899999999',	'kanchan.th@wu.ac.th',	'อาคารวิชาการ3',	'2019-01-27 22:36:34',	0,	'2019-02-05 12:49:48',	0),
(10,	57,	1,	1,	'นาย',	'ประทีป',	'คงกล้า',	NULL,	'',	'pra@wu.ac.th',	'ตึกนวัตรกรรม',	'2019-01-27 22:37:37',	0,	'2019-02-06 00:06:35',	0),
(11,	58,	2,	2,	'ผู้ช่วยศาสตราจารย์',	'อุหมาด',	'หมัดอาด้ำ',	NULL,	'0899909099',	'muhamard@wu.ac.th',	'อาคารวิชาการ3',	'2019-01-27 22:41:14',	0,	'2019-02-05 12:46:46',	0),
(12,	59,	2,	2,	'อาจารย์ ดร.',	'พุทธิพร',	'ธนธรรมเมธี',	NULL,	'0800000000',	'putthiporn.th@wu.ac.th',	'อาคารวิชาการ3',	'2019-01-27 22:43:19',	0,	'2019-02-05 15:27:41',	0),
(13,	60,	2,	2,	'ผู้ช่วยศาสตราจารย์',	'เยาวเรศ',	'ศิริสถิตย์กุล',	NULL,	'',	'syaowara@wu.ac.th',	'อาคารวิชาการ3',	'2019-01-27 22:44:52',	0,	'2019-02-05 12:45:12',	0);

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
(2560,	2),
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
(55,	'pthimapo@wu.ac.th',	'$2y$10$LSA1n/xcA4JVRfAuwv9aa.mOtXzTY.rLH9tdqpMSSGXBEe61K6QcS',	NULL,	'2019-02-05 12:51:15',	'',	'2019-02-05 12:51:15',	NULL),
(56,	'kanchan.th@wu.ac.th',	'$2y$10$hcmyFbQ0MOqD9/37bpSREOAYNeWmttQsF770Qp633Z86T6d5WpDWK',	NULL,	'2019-02-05 12:49:48',	'',	'2019-02-05 12:49:48',	NULL),
(57,	'pra@wu.ac.th',	'$2y$10$A.lILFswamQywIkyiVhEn.eUOH4UkFdOs2MOe2NEN8UkMd78akSey',	'L5Ti1II0rNSscqFfBTXI8xXmbvWRdYqAPqWSj1liG7bZz6boVlvhTO8PGzR9',	'2019-02-06 16:47:37',	'',	'2019-02-06 16:47:37',	NULL),
(58,	'muhamard@wu.ac.th',	'$2y$10$cjlExpqXoFsdtfqfO8oRxOzGAvxW6VBRhDf1haWT0JvW3i1qH8K0.',	NULL,	'2019-02-05 12:46:46',	'',	'2019-02-05 12:46:46',	NULL),
(59,	'putthiporn.th@wu.ac.th',	'$2y$10$4iixfs8x4vmUj22ktXQMLe22s59bFZZSycs2EJc7XT0m9JXYu51a.',	NULL,	'2019-02-05 12:43:17',	'',	'2019-02-05 12:43:17',	NULL),
(60,	'syaowara@wu.ac.th',	'$2y$10$EE5FpFUInqFHI4JbMxffi.ciyNbmFOifx8G/uwfl7ia9TpvCv3lU2',	NULL,	'2019-02-05 12:45:12',	'',	'2019-02-05 12:45:12',	NULL),
(61,	'59131121',	'$2y$10$cY.rnGcJfh2wOScG2FcWiej0nUA1jnXDEx5hKDKU6aaS29JAjbf4C',	NULL,	'2019-01-29 12:02:13',	'',	'2019-01-29 12:02:13',	NULL),
(63,	'11123456',	'$2y$10$iOjKXeywg3J/EvQvOqqtTeIZ5sYWRubDoP7IV9iVdfkVtTNY71mMC',	NULL,	'2019-02-05 15:24:27',	'',	'2019-02-05 15:24:27',	NULL),
(64,	'58123472',	'$2y$10$XLAt9Uwuy1SMv2eW8HeNz.MkExPT0VSH3Pz..gnLcOWhB4c8iL4/6',	NULL,	'2019-02-06 16:03:04',	'',	'2019-02-06 16:03:04',	NULL);

-- 2019-03-04 09:10:11
