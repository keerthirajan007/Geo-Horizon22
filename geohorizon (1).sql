-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 06, 2022 at 08:43 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `geohorizon`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `s_no` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `user_name` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_pass` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `user_mail` varchar(130) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `user_phone` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_type` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  `user_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `token` text CHARACTER SET utf8 COLLATE utf8_bin,
  `events` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `status` varchar(70) NOT NULL DEFAULT 'not-paid',
  `amt_required` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `amt_paid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`s_no`,`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `user_mail` (`user_mail`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`s_no`, `user_id`, `user_name`, `user_pass`, `user_mail`, `user_phone`, `user_type`, `user_time`, `token`, `events`, `status`, `amt_required`, `amt_paid`) VALUES
(2, '1ba88cfb-264f-48d4-89c6-519122d99450', 'Ragul', '202cb962ac59075b964b07152d234b70', 'capkeerthi@gmail.com', '+918220199731', 'user', '2022-01-08 06:35:24', '', 'e49fb26a-95b5-48af-9428-96e6f2ce1b0e, da0bac9d-0644-42d1-adad-11fe66ae4d99, 0c6f67f6-579c-415d-ad5a-eba821892a16, c6bea9e8-e464-465f-aee8-b9da20281066, ', 'not-paid', 50, 0),
(3, '808688c2-3a18-4683-b397-52f32ac3b098', 'Admin', '02741b0009c596be71a2fbeda099af97', 'geohorizon22@gmail.com', '+91 8220199731', 'admin', '2022-01-21 13:42:11', '', '', 'not-paid', 0, 0),
(4, '03740bee-1486-4651-8e57-21462e0e82e9', 'Sylash', '202cb962ac59075b964b07152d234b70', 'capkeerth@gmail.com', '+91 8220199731', 'user', '2022-02-07 08:48:49', NULL, 'da0bac9d-0644-42d1-adad-11fe66ae4d99, e49fb26a-95b5-48af-9428-96e6f2ce1b0e, ', 'not-paid', 0, 0),
(5, 'ec8effb6-b4e8-4f20-af5d-98b05fdbfc1b', 'Meha', '202cb962ac59075b964b07152d234b70', 'meha@gmail.com', '+91 1234567890', 'user', '2022-02-10 10:08:09', NULL, 'e49fb26a-95b5-48af-9428-96e6f2ce1b0e, ', 'not-paid', 0, 0),
(6, '73835f10-af91-4695-88c7-90f16d43f183', 'Raj Thilak', '65a1223dae83b8092c4edba0823a793c', 'rjthilak2k@gmail.com', '+91 9629072003', 'user', '2022-03-02 02:27:07', NULL, '', 'not-paid', 0, 0),
(7, 'e5ff384f-e145-4192-a796-94b6286935d1', 'Lalith_K', '202cb962ac59075b964b07152d234b70', 'lalithstark@gmail.com', '+91 08220199731', 'user', '2022-05-05 19:44:23', NULL, 'e49fb26a-95b5-48af-9428-96e6f2ce1b0e, da0bac9d-0644-42d1-adad-11fe66ae4d99, c6bea9e8-e464-465f-aee8-b9da20281066, 9c15355f-b4c1-47b2-9969-0e54bf02a42e, 0c6f67f6-579c-415d-ad5a-eba821892a16, 3732709e-cf51-4987-97f8-2b93576ab100, ', 'not-paid', 50, 50);

-- --------------------------------------------------------

--
-- Table structure for table `candidate_list`
--

DROP TABLE IF EXISTS `candidate_list`;
CREATE TABLE IF NOT EXISTS `candidate_list` (
  `s_no` int(20) NOT NULL AUTO_INCREMENT,
  `reg_id` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `user_id` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `event_id` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `payment_id` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `token` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yellow',
  `remark` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Not Set',
  `date_time` datetime NOT NULL,
  PRIMARY KEY (`s_no`),
  UNIQUE KEY `reg_id` (`reg_id`),
  UNIQUE KEY `payment_id` (`payment_id`),
  UNIQUE KEY `token` (`token`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `candidate_list`
--

INSERT INTO `candidate_list` (`s_no`, `reg_id`, `user_id`, `event_id`, `payment_id`, `token`, `status`, `remark`, `date_time`) VALUES
(8, 'f3e45921-dbc0-41fb-9a62-c2da7b7c29c1', '03740bee-1486-4651-8e57-21462e0e82e9', 'e49fb26a-95b5-48af-9428-96e6f2ce1b0e', '79cceb77-adc5-4a49-b4cf-896d4222e6c3', 'bac4369e-7bb3-42df-8883-472d06fc4261', 'yellow', 'Not set', '2022-02-10 05:54:06'),
(7, '92ba2a0c-074a-423f-b1b3-df597fb12612', '03740bee-1486-4651-8e57-21462e0e82e9', 'da0bac9d-0644-42d1-adad-11fe66ae4d99', '375b1b73-2c44-4e68-abde-63089e553e14', 'fa522612-f00f-4399-9728-1668ace21afe', 'yellow', 'Not set', '2022-02-10 05:52:54'),
(6, '8ab68b0e-a86b-454e-8012-3175dabbbbc0', '1ba88cfb-264f-48d4-89c6-519122d99450', 'da0bac9d-0644-42d1-adad-11fe66ae4d99', '9f0b0b68-ba96-4863-8328-e8f4d110af15', '8ae90a93-a04d-428e-bcef-5423c844108a', 'yellow', 'Pending', '2022-02-10 05:48:23'),
(5, '332b8229-b0cd-4b07-92ef-37482346626f', '1ba88cfb-264f-48d4-89c6-519122d99450', 'e49fb26a-95b5-48af-9428-96e6f2ce1b0e', 'f8df4cd7-1f55-4d79-b547-790c2b8de601', '1e5f6e2f-b3b3-4fdb-9633-542fa016ff82', 'yellow', 'Not Set', '2022-02-10 05:36:19'),
(9, 'e2883c21-5287-47dc-a71c-47c3bfef170e', 'ec8effb6-b4e8-4f20-af5d-98b05fdbfc1b', 'e49fb26a-95b5-48af-9428-96e6f2ce1b0e', '7f6c7a9a-14f9-4a98-b3ba-567bba14daae', '2f5e527b-9dda-4371-b76a-bfff9101cc1c', 'yellow', 'Not Set', '2022-02-10 15:25:28'),
(10, '4986b848-43b7-4baf-acb2-0b2e141f47b3', 'e5ff384f-e145-4192-a796-94b6286935d1', 'e49fb26a-95b5-48af-9428-96e6f2ce1b0e', 'fe270fd0-9ce8-4327-9bae-92e9d56ec606', '5350db38-fc24-4fd9-9178-8dacb4219c39', 'yellow', 'Not Set', '2022-05-05 21:14:37'),
(11, '1ac65c86-d77e-4237-9cad-5bced843fffc', 'e5ff384f-e145-4192-a796-94b6286935d1', 'da0bac9d-0644-42d1-adad-11fe66ae4d99', '78cd4598-0968-4507-aa78-80b4e5bd555f', '5c3fe14b-079b-47c3-9a3f-ebe8ad50ab6b', 'yellow', 'Not Set', '2022-05-05 21:21:28'),
(12, 'cdde35cc-4892-4bc4-8776-a17c1278fa0e', '1ba88cfb-264f-48d4-89c6-519122d99450', '0c6f67f6-579c-415d-ad5a-eba821892a16', 'c72884e1-5d1a-48c6-8b8c-bc03e5c90fbe', 'b0ff07a0-ceab-46dd-9fe8-41e613155230', 'yellow', 'Pending', '2022-05-05 21:23:36'),
(13, 'a86cea55-9b53-4360-83c1-1ef4f9036401', 'e5ff384f-e145-4192-a796-94b6286935d1', 'c6bea9e8-e464-465f-aee8-b9da20281066', 'cdf53bbd-eb94-4716-81a3-3bf510c08a57', '1a5694ae-81ff-414a-9801-91702124aea4', 'yellow', 'Not Set', '2022-05-05 21:24:05'),
(14, '3d664c71-57e2-48f7-8db1-f29151974427', 'e5ff384f-e145-4192-a796-94b6286935d1', '9c15355f-b4c1-47b2-9969-0e54bf02a42e', '3e7f6c8f-d2d0-4654-a0f7-8101292e747c', '03adb5cd-5ad5-4637-a485-a175ac134985', 'yellow', 'Not Set', '2022-05-05 21:32:07'),
(15, 'b0d6a3de-e1e2-4c19-b456-c413e5b8cd55', 'e5ff384f-e145-4192-a796-94b6286935d1', '0c6f67f6-579c-415d-ad5a-eba821892a16', 'dc48e4c6-ab49-47bf-9bc4-a4f062bb63fd', '2a778769-a8d5-44a6-9c43-64dfd010f48c', 'green', 'Selected', '2022-05-06 05:14:32'),
(16, '990ba3fe-5e06-44a2-85a4-b8c899bb511c', 'e5ff384f-e145-4192-a796-94b6286935d1', '3732709e-cf51-4987-97f8-2b93576ab100', '8fdf3008-00c0-4687-a445-d76991b10636', 'a48c6510-abe5-4dd9-8b49-d002e63bdd63', 'yellow', 'Not Set', '2022-05-06 05:32:42'),
(17, '2eba35ba-c758-44e0-b6d2-9807435a45a1', '1ba88cfb-264f-48d4-89c6-519122d99450', 'c6bea9e8-e464-465f-aee8-b9da20281066', 'b60135ca-7bff-4c4c-b875-2142c5f7e44a', '19f4d9de-b51c-40b7-9e01-dabc43cae8e4', 'yellow', 'Pending', '2022-05-06 05:56:24');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `s_no` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `contact_id` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(130) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `phone` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `profession` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `department` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `college` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `about` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `profile_path` text COLLATE utf8_unicode_ci NOT NULL,
  `event_id` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`s_no`),
  UNIQUE KEY `contact_id` (`contact_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `s_no` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `event_id` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `short` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `date_time` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `venue` text COLLATE utf8_unicode_ci NOT NULL,
  `amount` float(10,2) NOT NULL,
  `organizer` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `image_path` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `icon_class` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `event_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'event',
  PRIMARY KEY (`s_no`),
  UNIQUE KEY `event_id` (`event_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`s_no`, `event_id`, `name`, `short`, `description`, `date_time`, `venue`, `amount`, `organizer`, `image_path`, `icon_class`, `event_type`) VALUES
(1, 'e49fb26a-95b5-48af-9428-96e6f2ce1b0e', 'Paper Presentation', 'Innovation, as I understand it, is both about doing different things as well as doing things differently.â€ Hey inquisitive minds Geo Horizonâ€™22 is right here with its paper presentation event to kindle the fire in you. Come, participate and tackle real world problems through Remote Sensing and GIS!!!', 'Innovation, as I understand it, is both about doing different things as well as doing things differently.â€ Hey inquisitive minds Geo Horizonâ€™22 is right here with its paper presentation event to kindle the fire in you. Come, participate and tackle real world problems through Remote Sensing and GIS!!!', '05/17/2022 9:00 AM', 'Colin Mckenzie Auditorium, IRS', 0.00, 'Bharathi E- 8608935187, \nBabithashree S- 7010964223', 'default.png', 'far fa-clipboard', 'event-technical'),
(2, 'da0bac9d-0644-42d1-adad-11fe66ae4d99', 'Poster Presentation', 'â€œGood poster begins with honesty, asks tough questions, comes from collaboration and from trusting your intuition.â€  Geo Horizonâ€™22 is right here with its poster presentation event to array fascinating works of innovative minds on topics relating to Remote Sensing and GIS!!', 'â€œGood poster begins with honesty, asks tough questions, comes from collaboration and from trusting your intuition.â€  Geo Horizonâ€™22 is right here with its poster presentation event to array fascinating works of innovative minds on topics relating to Remote Sensing and GIS!!', '05/18/2022 9:00 AM', 'Colin Mckenzie Auditorium, IRS', 0.00, 'Bharathi E- 8608935187,\nBabithashree S- 7010964223', 'default.png', 'far fa-file', 'event-technical'),
(3, 'c6bea9e8-e464-465f-aee8-b9da20281066', 'Crack the track', 'Letâ€™s begin a smart move!! Curious about finding routes to locations?? Crack the track provides the opportunity to find routes to google map locations using a GIS software. Implementing dynamicity with traffics constraints and giving preference for routes are some of the added aspects of it. ', 'Letâ€™s begin a smart move!! Curious about finding routes to locations?? Crack the track provides the opportunity to find routes to google map locations using a GIS software. Implementing dynamicity with traffics constraints and giving preference for routes are some of the added aspects of it. ', '05/17/2022 2:30 PM', 'Room no 11, GF, IRS', 0.00, 'Gayathri S- 9150495481, \nJegan J- 6385598047', 'default.png', 'fas fa-folder', 'event-technical'),
(4, '0c6f67f6-579c-415d-ad5a-eba821892a16', 'Cyberdiction', 'Code it! Ace it! An event to entice programming brains ready to express their coding skills and creativity for  solving a real world problem..', 'Code it! Ace it! An event to entice programming brains ready to express their coding skills and creativity for  solving a real world problem..', '05/17/2022 9:30 AM', 'Room 14, GF, IRS', 0.00, 'Nithish M- 6380952876,\n Aditi R- 9557116166', 'default.png', 'fas fa-code', 'event-technical'),
(5, '9c15355f-b4c1-47b2-9969-0e54bf02a42e', 'G-KWIZ', 'We quiz therefore we areâ€. A big shout out to enthusiastic quizzers on Remote Sensing and GIS. G-KWIZ promises to offer one of the best quizzes ever through MCQs, connections, jumbled words, locating places etc.', 'We quiz therefore we areâ€. A big shout out to enthusiastic quizzers on Remote Sensing and GIS. G-KWIZ promises to offer one of the best quizzes ever through MCQs, connections, jumbled words, locating places etc.', '05/17/2022 1:30 PM', 'Room 108, FF, IRS', 0.00, 'Preethi G - 9150272901, \nMalavika B.L - 9940566609', 'default.png', 'fab fa-quora', 'event-non-technical'),
(6, '897ed4ec-1450-47c3-8cb1-37b5412bddd5', 'IPL Auction', 'Ever really yearned for creating your own IPL franchise? Or ever really thought of bringing together Kohli, Buttler and Dhoni in the same team? Well, here really is your chance to bring out that Kasi Viswanath or Kiran Kumar in you and rampage other teams without options. ', 'Ever really yearned for creating your own IPL franchise? Or ever really thought of bringing together Kohli, Buttler and Dhoni in the same team? Well, here really is your chance to bring out that Kasi Viswanath or Kiran Kumar in you and rampage other teams without options. ', '05/16/2022 1:00 PM', ' Room 11, GF, IRS', 0.00, 'Vignesh, \nSagavi', 'default.png', 'fas fa-baseball-ball', 'event-non-technical'),
(7, 'c3b9e06d-da7e-4e2e-8972-f5dba2d31444', 'à®Žà®©à¯à®© à®Ÿà®¾ à®¨à®Ÿà®•à¯à®•à¯à®¤à¯ à®‡à®™à¯à®•', 'à®‡à®©à¯à®šà¯à®µà¯ˆ à®¤à®®à®¿à®´à¯‡ à®ªà¯Šà®©à¯ à®šà®¿à®² à®¤à®°à¯à®µà¯‡', 'à®‡à®©à¯à®šà¯à®µà¯ˆ à®¤à®®à®¿à®´à¯‡ à®ªà¯Šà®©à¯ à®šà®¿à®² à®¤à®°à¯à®µà¯‡', '05/16/2022 2:30 PM', 'Room 106, FF, IRS', 0.00, 'Subiksha, Jayashri', 'default.png', 'fas fa-language', 'event-non-technical'),
(8, '3732709e-cf51-4987-97f8-2b93576ab100', 'Geosmash', 'From the backstreets of Bangkok to the beaches of Brazil, the love for those feathery projectiles never ends. SGE invites all those showstoppers who wreaks havoc with their staggering smashes and mesmerize the crowds with their breathtaking dropshots. Welcome to Geo Horizonâ€™22 Badminton Super League. ', 'From the backstreets of Bangkok to the beaches of Brazil, the love for those feathery projectiles never ends. SGE invites all those showstoppers who wreaks havoc with their staggering smashes and mesmerize the crowds with their breathtaking dropshots. Welcome to Geo Horizonâ€™22 Badminton Super League. ', '05/16/2022 9:00 AM', 'Ground, CEG, Anna University', 0.00, ' ', 'default.png', 'fas fa-table-tennis', 'event-non-technical'),
(9, '05239f9b-e368-4f00-aa92-75556feddfb2', 'Matlab', ' Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aut deserunt adipisci, eaque illum laudantium consequatur rerum totam libero harum asperiores nostrum dolor distinctio saepe amet dolores expedita, aliquam unde natus!', ' Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aut deserunt adipisci, eaque illum laudantium consequatur rerum totam libero harum asperiores nostrum dolor distinctio saepe amet dolores expedita, aliquam unde natus!', '05/17/2022 9:00 PM', 'IRS', 0.00, ' ', 'default.png', 'fab fa-maxcdn', 'workshop'),
(10, '05efbf5f-b8ad-414d-9536-0853b4872604', 'R programming', ' Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aut deserunt adipisci, eaque illum laudantium consequatur rerum totam libero harum asperiores nostrum dolor distinctio saepe amet dolores expedita, aliquam unde natus!', ' Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aut deserunt adipisci, eaque illum laudantium consequatur rerum totam libero harum asperiores nostrum dolor distinctio saepe amet dolores expedita, aliquam unde natus!', '05/17/2022 9:00 PM', 'IRS', 0.00, ' ', 'default.png', 'fas fa-registered', 'workshop');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `s_no` int(15) UNSIGNED NOT NULL AUTO_INCREMENT,
  `payment_id` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `user_id` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `event_id` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `paid_amt` float(10,2) UNSIGNED NOT NULL,
  `payment_status` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`s_no`),
  UNIQUE KEY `payment_id` (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`s_no`, `payment_id`, `user_id`, `event_id`, `paid_amt`, `payment_status`, `created`, `modified`) VALUES
(5, 'f8df4cd7-1f55-4d79-b547-790c2b8de601', '1ba88cfb-264f-48d4-89c6-519122d99450', 'e49fb26a-95b5-48af-9428-96e6f2ce1b0e', 55.00, 'paid', '2022-02-10 11:06:18', '2022-02-10 11:06:18'),
(6, '9f0b0b68-ba96-4863-8328-e8f4d110af15', '1ba88cfb-264f-48d4-89c6-519122d99450', 'da0bac9d-0644-42d1-adad-11fe66ae4d99', 0.00, 'not-paid', '2022-02-10 11:18:23', '2022-02-10 11:18:23'),
(7, '375b1b73-2c44-4e68-abde-63089e553e14', '03740bee-1486-4651-8e57-21462e0e82e9', 'da0bac9d-0644-42d1-adad-11fe66ae4d99', 123123.00, 'succeeded', '2022-02-10 11:22:54', '2022-02-10 11:22:54'),
(8, '79cceb77-adc5-4a49-b4cf-896d4222e6c3', '03740bee-1486-4651-8e57-21462e0e82e9', 'e49fb26a-95b5-48af-9428-96e6f2ce1b0e', 55.00, 'paid', '2022-02-10 11:24:06', '2022-02-10 11:24:06'),
(9, '7f6c7a9a-14f9-4a98-b3ba-567bba14daae', 'ec8effb6-b4e8-4f20-af5d-98b05fdbfc1b', 'e49fb26a-95b5-48af-9428-96e6f2ce1b0e', 55.00, 'succeeded', '2022-02-10 20:55:27', '2022-02-10 20:55:27'),
(10, 'fe270fd0-9ce8-4327-9bae-92e9d56ec606', 'e5ff384f-e145-4192-a796-94b6286935d1', 'e49fb26a-95b5-48af-9428-96e6f2ce1b0e', 0.00, 'not-paid', '2022-05-06 02:44:36', '2022-05-06 02:44:36'),
(11, '78cd4598-0968-4507-aa78-80b4e5bd555f', 'e5ff384f-e145-4192-a796-94b6286935d1', 'da0bac9d-0644-42d1-adad-11fe66ae4d99', 0.00, 'not-paid', '2022-05-06 02:51:28', '2022-05-06 02:51:28'),
(12, 'c72884e1-5d1a-48c6-8b8c-bc03e5c90fbe', '1ba88cfb-264f-48d4-89c6-519122d99450', '0c6f67f6-579c-415d-ad5a-eba821892a16', 0.00, 'not-paid', '2022-05-06 02:53:36', '2022-05-06 02:53:36'),
(13, 'cdf53bbd-eb94-4716-81a3-3bf510c08a57', 'e5ff384f-e145-4192-a796-94b6286935d1', 'c6bea9e8-e464-465f-aee8-b9da20281066', 0.00, 'not-paid', '2022-05-06 02:54:05', '2022-05-06 02:54:05'),
(14, '3e7f6c8f-d2d0-4654-a0f7-8101292e747c', 'e5ff384f-e145-4192-a796-94b6286935d1', '9c15355f-b4c1-47b2-9969-0e54bf02a42e', 0.00, 'not-paid', '2022-05-06 03:02:07', '2022-05-06 03:02:07'),
(15, 'dc48e4c6-ab49-47bf-9bc4-a4f062bb63fd', 'e5ff384f-e145-4192-a796-94b6286935d1', '0c6f67f6-579c-415d-ad5a-eba821892a16', 0.00, 'not-paid', '2022-05-06 10:44:32', '2022-05-06 10:44:32'),
(16, '8fdf3008-00c0-4687-a445-d76991b10636', 'e5ff384f-e145-4192-a796-94b6286935d1', '3732709e-cf51-4987-97f8-2b93576ab100', 0.00, 'not-paid', '2022-05-06 11:02:42', '2022-05-06 11:02:42'),
(17, 'b60135ca-7bff-4c4c-b875-2142c5f7e44a', '1ba88cfb-264f-48d4-89c6-519122d99450', 'c6bea9e8-e464-465f-aee8-b9da20281066', 0.00, 'not-paid', '2022-05-06 11:26:24', '2022-05-06 11:26:24');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
