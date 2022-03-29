-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 20, 2015 at 11:25 PM
-- Server version: 5.6.24-0ubuntu2
-- PHP Version: 5.6.4-4ubuntu6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rv_tour`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_permissions`
--

CREATE TABLE IF NOT EXISTS `admin_permissions` (
`ape_id` int(10) unsigned NOT NULL,
  `ape_user_id` int(11) NOT NULL,
  `ape_permissions` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin_permissions`
--

INSERT INTO `admin_permissions` (`ape_id`, `ape_user_id`, `ape_permissions`) VALUES
(6, 1, '{"admin.access":1,"product.manager":1,"setting.view":1,"users.view":1,"users.fake_login":1,"users.add":1,"users.edit":1,"users.delete":1,"categories.view":1,"categories.add":1,"categories.edit":1,"categories.delete":1,"pages.view":1,"pages.add":1,"pages.edit":1,"pages.delete":1,"posts.view":1,"posts.add":1,"posts.edit":1,"posts.delete":1,"feedbacks.view":1,"feedbacks.edit":1,"feedbacks.delete":1,"subscribers.view":1,"subscribers.edit":1,"subscribers.delete":1,"testimonials.view":1,"testimonials.add":1,"testimonials.edit":1,"testimonials.delete":1}');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
`id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `has_parent` tinyint(4) DEFAULT '0',
  `has_child` tinyint(4) DEFAULT NULL,
  `cat_icon` varchar(255) DEFAULT NULL,
  `cat_background` varchar(255) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  `order` tinyint(2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parents` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=165 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
`cit_id` int(11) NOT NULL,
  `cit_name` varchar(255) DEFAULT NULL,
  `cit_parent` int(11) DEFAULT '0',
  `cit_active` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=769 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`cit_id`, `cit_name`, `cit_parent`, `cit_active`) VALUES
(2, 'Hà Nội', 0, 1),
(3, 'Hồ Chí Minh', 0, 1),
(4, 'An Giang', 0, 1),
(5, 'Bà Rịa - Vũng Tàu', 0, 1),
(6, 'Bắc Ninh', 0, 1),
(7, 'Bắc Giang', 0, 1),
(8, 'Bình Dương', 0, 1),
(9, 'Bình Định', 0, 1),
(10, 'Bình Phước', 0, 1),
(11, 'Bình Thuận', 0, 1),
(13, 'Bến Tre', 0, 1),
(14, 'Bắc Cạn', 0, 1),
(15, 'Cần Thơ', 0, 1),
(17, 'Khánh Hòa', 0, 1),
(19, 'Thừa Thiên Huế', 0, 1),
(20, 'Lào Cai', 0, 1),
(21, 'Quảng Ninh', 0, 1),
(22, 'Đồng Nai', 0, 1),
(23, 'Nam Định', 0, 1),
(24, 'Cà Mau', 0, 1),
(25, 'Cao Bằng', 0, 1),
(26, 'Gia Lai', 0, 1),
(27, 'Hà Giang', 0, 1),
(28, 'Hà Nam', 0, 1),
(30, 'Hà Tĩnh', 0, 1),
(31, 'Hải Dương', 0, 1),
(32, 'Hải Phòng', 0, 1),
(33, 'Hoà Bình', 0, 1),
(34, 'Hưng Yên', 0, 1),
(35, 'Kiên Giang', 0, 1),
(36, 'Kon Tum', 0, 1),
(37, 'Lai Châu', 0, 1),
(38, 'Lâm Đồng', 0, 1),
(39, 'Lạng Sơn', 0, 1),
(40, 'Long An', 0, 1),
(41, 'Nghệ An', 0, 1),
(42, 'Ninh Bình', 0, 1),
(43, 'Ninh Thuận', 0, 1),
(44, 'Phú Thọ', 0, 1),
(45, 'Phú Yên', 0, 1),
(46, 'Quảng Bình', 0, 1),
(47, 'Quảng Nam', 0, 1),
(48, 'Quảng Ngãi', 0, 1),
(49, 'Quảng Trị', 0, 1),
(50, 'Sóc Trăng', 0, 1),
(51, 'Sơn La', 0, 1),
(52, 'Tây Ninh', 0, 1),
(53, 'Thái Bình', 0, 1),
(54, 'Thái Nguyên', 0, 1),
(55, 'Thanh Hoá', 0, 1),
(56, 'Tiền Giang', 0, 1),
(57, 'Trà Vinh', 0, 1),
(58, 'Tuyên Quang', 0, 1),
(59, 'Vĩnh Long', 0, 1),
(60, 'Vĩnh Phúc', 0, 1),
(61, 'Yên Bái', 0, 1),
(62, 'Đắc Lắc', 0, 1),
(64, 'Đồng Tháp', 0, 1),
(65, 'Đà Nẵng', 0, 1),
(66, 'Buôn Mê Thuột', 0, 1),
(67, 'Đắc Nông', 0, 1),
(68, 'Hậu Giang', 0, 1),
(70, 'Bạc Liêu', 0, 1),
(71, 'Điện Biên', 0, 1),
(72, 'Quận Hoàng Mai', 2, 1),
(73, 'Quận Ba Đình', 2, 1),
(74, 'Quận Long Biên', 2, 1),
(75, 'Quận Cầu Giấy', 2, 1),
(76, 'Quận Đống Đa', 2, 1),
(77, 'Quận Hai Bà Trưng', 2, 1),
(78, 'Quận Hoàn Kiếm', 2, 1),
(79, 'Quận Tây Hồ', 2, 1),
(80, 'Quận Thanh Xuân', 2, 1),
(81, 'Huyện Ba Vì', 2, 1),
(82, 'Huyện Chương Mỹ', 2, 1),
(83, 'Huyện Đan Phượng', 2, 1),
(84, 'Quận 1', 3, 1),
(85, 'Quận 2', 3, 1),
(86, 'Huyện Gia Lâm', 2, 1),
(87, 'Huyện Hoài Đức', 2, 1),
(88, 'Huyện Mê Linh', 2, 1),
(89, 'Huyện Mỹ Đức', 2, 1),
(90, 'Huyện Phú Xuyên', 2, 1),
(91, 'Huyện Phúc Thọ', 2, 1),
(92, 'Huyện Quốc Oai', 2, 1),
(93, 'Huyện Sóc Sơn', 2, 1),
(94, 'Huyện Thạch Thất', 2, 1),
(95, 'Huyện Thanh Oai', 2, 1),
(96, 'Huyện Thanh Trì', 2, 1),
(97, 'Huyện Thường Tín', 2, 1),
(98, 'Huyện Từ Liêm', 2, 1),
(99, 'Huyện Ứng Hòa', 2, 1),
(100, 'Quận 3', 3, 1),
(101, 'Quận 4', 3, 1),
(102, 'Quận 5', 3, 1),
(103, 'Quận 6', 3, 1),
(104, 'Quận 7', 3, 1),
(105, 'Quận 8', 3, 1),
(106, 'Quận 9', 3, 1),
(107, 'Quận 10', 3, 1),
(108, 'Quận 11', 3, 1),
(109, 'Quận 12', 3, 1),
(110, 'Quận Tân Bình', 3, 1),
(111, 'Quận Tân Phú', 3, 1),
(112, 'Quận Bình Tân', 3, 1),
(113, 'Quận Phú Nhuận', 3, 1),
(114, 'Quận Gò Vấp', 3, 1),
(115, 'Quận Bình Thạnh', 3, 1),
(116, 'Quận Thủ Đức', 3, 1),
(117, 'Quận Hồng Bàng', 32, 1),
(118, 'Quận Ngô Quyền', 32, 1),
(119, 'Quận Lê Chân', 32, 1),
(120, 'Quận Kiến An', 32, 1),
(121, 'Quận Hải An', 32, 1),
(122, 'Quận Dương Kinh', 32, 1),
(123, 'Quận Đồ Sơn', 32, 1),
(124, 'Huyện Sơn Trà', 65, 1),
(125, 'Quận Hải Châu', 65, 1),
(126, 'Quận Thanh Khê', 65, 1),
(127, 'Quận Ngũ Hành Sơn', 65, 1),
(128, 'Quận Liên Chiểu', 65, 1),
(129, 'Quận Cẩm Lệ', 65, 1),
(130, 'Quận Ninh Kiều', 15, 1),
(131, 'Quận Bình Thủy', 15, 1),
(132, 'Quận Cái Răng', 15, 1),
(133, 'Quận Thốt Nốt', 15, 1),
(134, 'Quận Hà Đông', 2, 1),
(135, 'Quận Ô môn', 15, 1),
(136, 'Huyện A Lưới', 19, 1),
(137, 'Huyện Đông Hải ', 70, 1),
(138, 'Huyện Nam Đông ', 19, 1),
(139, 'Huyện Phong Điền', 19, 1),
(140, 'Huyện Phú Lộc', 19, 1),
(141, 'Huyện Phú Vang', 19, 1),
(142, 'Huyện Quảng Điền', 19, 1),
(143, 'Thị xã Hương Thủy', 19, 1),
(144, 'Huyện Châu Đức', 5, 1),
(145, 'Huyện Côn Đảo', 5, 1),
(146, 'Huyện Đất Đỏ', 5, 1),
(147, 'Huyện Long Điền', 5, 1),
(148, 'Huyện Tân Thành', 5, 1),
(149, 'Thị xã Bà Rịa', 5, 1),
(150, 'Thành phố Vũng Tàu', 5, 1),
(151, 'Huyện Xuyên Mộc', 5, 1),
(152, 'Huyện An Phú', 4, 1),
(153, 'Huyện Châu Phú', 4, 1),
(154, 'Thị xã Châu Đốc', 4, 1),
(155, 'Huyện Châu Thành', 4, 1),
(156, 'Huyện Chợ Mới', 4, 1),
(157, 'Thành phố Long Xuyên ', 4, 1),
(158, 'Thị xã Tân Châu', 4, 1),
(159, 'Huyện Thoại Sơn', 4, 1),
(160, 'Huyện Tịnh Biên', 4, 1),
(161, 'Huyện Tri Tôn ', 4, 1),
(162, 'Thành phố Bạc Liêu', 70, 1),
(163, 'Huyện Giá Rai ', 70, 1),
(164, 'Huyện Hoà Bình ', 70, 1),
(165, 'Huyện Hồng Dân ', 70, 1),
(166, 'Huyện Phước Long ', 70, 1),
(167, 'Huyện Vĩnh Lợi ', 70, 1),
(168, 'Thành phố Bắc Giang ', 7, 1),
(169, 'Huyện Lục Nam', 7, 1),
(170, 'Huyện Lục Ngạn ', 7, 1),
(171, 'Huyện Sơn Động ', 7, 1),
(172, 'Huyện Tân Yên ', 7, 1),
(173, 'Huyện Yên Dũng ', 7, 1),
(174, 'Huyện Yên Thế ', 7, 1),
(175, 'Thị xã Bắc Kạn ', 14, 1),
(176, 'Huyện Chợ Mới ', 14, 1),
(177, 'Huyện Na Rì ', 14, 1),
(178, 'Huyện Ngân Sơn ', 14, 1),
(179, 'Thành phố Bắc Ninh ', 6, 1),
(180, 'Huyện Gia Bình ', 6, 1),
(181, 'Huyện Quế Võ ', 6, 1),
(182, 'Huyện Thuận Thành ', 6, 1),
(183, 'Huyện Tiên Du ', 6, 1),
(184, 'Thị xã Từ Sơn', 6, 1),
(185, 'Huyện Yên Phong ', 6, 1),
(186, 'Huyện Ba Tri ', 13, 1),
(187, 'Thành phố Bến Tre', 13, 1),
(188, 'Huyện Bình Đại ', 13, 1),
(189, 'Huyện Châu Thành ', 13, 1),
(190, 'Huyện Chợ Lách ', 13, 1),
(191, 'Huyện Giồng Trôm ', 13, 1),
(192, 'Huyện Mỏ Cày Nam ', 13, 1),
(193, 'Huyện Thạnh Phú ', 13, 1),
(194, 'Huyện Bến Cát ', 8, 1),
(195, 'Huyện Dầu Tiếng ', 8, 1),
(196, 'Thị xã Dĩ An ', 8, 1),
(197, 'Huyện Phú Giáo ', 8, 1),
(198, 'Huyện Tân Uyên ', 8, 1),
(199, 'Thị xã Thủ Dầu Một ', 8, 1),
(200, 'Thị xã Thuận An ', 8, 1),
(201, 'Huyện An Lão ', 9, 1),
(202, 'Huyện An Nhơn ', 9, 1),
(203, 'Huyện Hoài Nhơn ', 9, 1),
(204, 'Huyện Phù Cát ', 9, 1),
(205, 'Huyện Phù Mỹ ', 9, 1),
(206, 'Thành phố Qui Nhơn', 9, 1),
(207, 'Huyện Tây Sơn ', 9, 1),
(208, 'Huyện Tuy Phước ', 9, 1),
(209, 'Huyện Vân Canh ', 9, 1),
(210, 'Huyện Vĩnh Thạnh ', 9, 1),
(211, 'Thị xã Bình Long ', 10, 1),
(212, 'Huyện Bù Đăng ', 10, 1),
(213, 'Thị xã Đồng Xoài ', 10, 1),
(214, 'Huyện Lộc Ninh ', 10, 1),
(215, 'Thị xã Phước Long ', 10, 1),
(216, 'Huyện Bù Gia Mập ', 10, 1),
(217, 'Huyện Hàm Tân ', 11, 1),
(218, 'Thị xã La Gi', 11, 1),
(219, 'Thành phố Phan Thiết ', 11, 1),
(220, 'Huyện Tuy Phong ', 11, 1),
(221, 'Thành phố Cà Mau ', 24, 1),
(222, 'Huyện Cái Nước ', 24, 1),
(223, 'Huyện Đầm Dơi ', 24, 1),
(224, 'Huyện Năm Căn ', 24, 1),
(225, 'Huyện Ngọc Hiển ', 24, 1),
(226, 'Huyện Phú Tân ', 24, 1),
(227, 'Huyện Thới Bình ', 24, 1),
(228, 'Huyện Trần Văn Thời ', 24, 1),
(229, 'Huyện U Minh ', 24, 1),
(230, 'Huyện Bảo Lạc ', 25, 1),
(231, 'Huyện Bảo Lâm ', 25, 1),
(232, 'Thị xã Cao Bằng ', 25, 1),
(233, 'Huyện Nguyên Bình ', 25, 1),
(234, 'Huyện Quảng Uyên ', 25, 1),
(235, 'Huyện Thông Nông ', 25, 1),
(236, 'Huyện Trà Lĩnh ', 25, 1),
(237, 'Huyện Trùng Khánh ', 25, 1),
(238, 'Huyện Cờ Đỏ ', 15, 1),
(239, 'Huyện Phong Điền ', 15, 1),
(240, 'Huyện Vĩnh Thạnh ', 15, 1),
(241, 'Huyện Buôn Đôn ', 62, 1),
(242, 'Huyện đảo Hoàng Sa ', 65, 1),
(243, 'Thành phố Buôn Ma Thuột ', 62, 1),
(244, 'Huyện Cư Kuin ', 62, 1),
(245, 'Huyện Ea Hleo ', 62, 1),
(246, 'Huyện Ea Kar ', 62, 1),
(247, 'Huyện Ea Súp ', 62, 1),
(248, 'Huyện Krông Ana ', 62, 1),
(249, 'Huyện Krông Bông ', 62, 1),
(250, 'Huyện Krông Búk ', 62, 1),
(251, 'Huyện Krông Năng ', 62, 1),
(252, 'Huyện Krông Pắk ', 62, 1),
(253, 'Huyện MĐrăk ', 62, 1),
(254, 'Thị xã Buôn Hồ ', 62, 1),
(255, 'Huyện Đăk Glong ', 67, 1),
(256, 'Huyện Đăk Mil ', 67, 1),
(257, 'Huyện Đăk RLấp ', 67, 1),
(258, 'Huyện Đăk Song ', 67, 1),
(259, 'Thị xã Gia Nghĩa ', 67, 1),
(260, 'Huyện Tuy Đức ', 67, 1),
(261, 'Thành phố Biên Hòa ', 22, 1),
(262, 'Huyện Cẩm Mỹ ', 22, 1),
(263, 'Huyện Định Quán ', 22, 1),
(264, 'Thị xã Long Khánh ', 22, 1),
(265, 'Huyện Long Thành ', 22, 1),
(266, 'Huyện Nhơn Trạch ', 22, 1),
(267, 'Huyện Thống Nhất ', 22, 1),
(268, 'Huyện Trảng Bom ', 22, 1),
(269, 'Huyện Vĩnh Cửu ', 22, 1),
(270, 'Huyện Xuân Lộc ', 22, 1),
(271, 'Huyện Tân Phú ', 22, 1),
(272, 'Thành phố Cao Lãnh ', 64, 1),
(273, 'Huyện Cao Lãnh ', 64, 1),
(274, 'Huyện Châu Thành ', 64, 1),
(275, 'Thị xã Hồng Ngự ', 64, 1),
(276, 'Huyện Lai Vung ', 64, 1),
(277, 'Huyện Hồng Ngự ', 64, 1),
(278, 'Huyện Lấp Vò ', 64, 1),
(279, 'Thị xã Sa Đéc ', 64, 1),
(280, 'Huyện Tam Nông ', 64, 1),
(281, 'Huyện Tân Hồng ', 64, 1),
(282, 'Huyện Thanh Bình ', 64, 1),
(283, 'Huyện Tháp Mười ', 64, 1),
(284, 'Thị xã An Khê ', 26, 1),
(285, 'Thị xã Ayun Pa ', 26, 1),
(286, 'Huyện Chư Prông ', 26, 1),
(287, 'Huyện Chư Sê ', 26, 1),
(288, 'Huyện Đăk Đoa ', 26, 1),
(289, 'Huyện Đức Cơ ', 26, 1),
(290, 'Huyện KBang ', 26, 1),
(291, 'Huyện Kông Chro ', 26, 1),
(292, 'Huyện Krông Pa ', 26, 1),
(293, 'Huyện Mang Yang ', 26, 1),
(294, 'Huyện Phú Thiện ', 26, 1),
(295, 'Thành phố Pleiku ', 26, 1),
(296, 'Huyện Chư Pưh ', 26, 1),
(297, 'Huyện Đồng Văn ', 27, 1),
(298, 'Thành phố Hà Giang ', 27, 1),
(299, 'Huyện Mèo Vạc ', 27, 1),
(300, 'Huyện Quản Bạ ', 27, 1),
(301, 'Huyện Vị Xuyên', 27, 1),
(302, 'Huyện Xín Mần ', 27, 1),
(303, 'Huyện Yên Minh ', 27, 1),
(304, 'Huyện Bình Lục', 28, 1),
(305, 'Huyện Duy Tiên ', 28, 1),
(306, 'Huyện Kim Bảng ', 28, 1),
(307, 'Huyện Lý Nhân ', 28, 1),
(308, 'Thành phố Phủ Lý ', 28, 1),
(309, 'Huyện Can Lộc ', 30, 1),
(310, 'Huyện Cẩm Xuyên ', 30, 1),
(311, 'Huyện Đức Thọ ', 30, 1),
(312, 'Thành phố Hà Tĩnh ', 30, 1),
(313, 'Thị xã Hồng Lĩnh ', 30, 1),
(314, 'Huyện Hương Khê ', 30, 1),
(315, 'Huyện Hương Sơn ', 30, 1),
(316, 'Huyện Kỳ Anh ', 30, 1),
(317, 'Huyện Vũ Quang ', 30, 1),
(318, 'Huyện Thạch Hà ', 30, 1),
(319, 'Huyện Nghi Xuân ', 30, 1),
(320, 'Huyện Bình Giang ', 31, 1),
(321, 'Huyện Cẩm Giàng ', 31, 1),
(322, 'Thị xã Chí Linh ', 31, 1),
(323, 'Huyện Gia Lộc ', 31, 1),
(324, 'Thành phố Hải Dương ', 31, 1),
(325, 'Huyện Kim Thành ', 31, 1),
(326, 'Huyện Kinh Môn ', 31, 1),
(327, 'Huyện Nam Sách ', 31, 1),
(328, 'Huyện Ninh Giang ', 31, 1),
(329, 'Huyện Thanh Hà ', 31, 1),
(330, 'Huyện Thanh Miện ', 31, 1),
(331, 'Huyện Tứ Kỳ ', 31, 1),
(332, 'Huyện An Dương ', 32, 1),
(333, 'Huyện đảo Cát Hải ', 32, 1),
(334, 'Huyện Kiến Thụy ', 32, 1),
(335, 'Huyện Tiên Lãng ', 32, 1),
(336, 'Huyện Vĩnh Bảo ', 32, 1),
(337, 'Huyện Châu Thành', 68, 1),
(338, 'Huyện Châu Thành A ', 68, 1),
(339, 'Huyện Long Mỹ ', 68, 1),
(340, 'Huyện Phụng Hiệp ', 68, 1),
(341, 'Thị xã Ngã Bảy (Tân Hiệp cũ) ', 68, 1),
(342, 'Thành phố Vị Thanh ', 68, 1),
(343, 'Huyện Vị Thủy ', 68, 1),
(344, 'Huyện Cao Phong ', 33, 1),
(345, 'Huyện Đà Bắc ', 33, 1),
(346, 'Thành phố Hoà Bình ', 33, 1),
(347, 'Huyện Kim Bôi ', 33, 1),
(348, 'Huyện Lạc Sơn ', 33, 1),
(349, 'Huyện Lạc Thủy ', 33, 1),
(350, 'Huyện Lương Sơn ', 33, 1),
(351, 'Huyện Mai Châu ', 33, 1),
(352, 'Huyện Yên Thủy ', 33, 1),
(353, 'Huyện Ân Thi ', 34, 1),
(354, 'Thành phố Hưng Yên ', 34, 1),
(355, 'Huyện Khoái Châu ', 34, 1),
(356, 'Huyện Mỹ Hào ', 34, 1),
(357, 'Huyện Văn Giang ', 34, 1),
(358, 'Huyện Văn Lâm ', 34, 1),
(359, 'Huyện Yên Mỹ ', 34, 1),
(360, 'Huyện An Biên ', 35, 1),
(361, 'Huyện An Minh ', 35, 1),
(362, 'Huyện Châu Thành ', 35, 1),
(363, 'Huyện Giồng Riềng ', 35, 1),
(364, 'Huyện Gò Quao ', 35, 1),
(365, 'Thị xã Hà Tiên ', 35, 1),
(366, 'Huyện Hòn Đất', 35, 1),
(367, 'Huyện Kiên Lương ', 35, 1),
(368, 'Huyện đảo Phú Quốc ', 35, 1),
(369, 'Thành phố Rạch Giá ', 35, 1),
(370, 'Huyện Tân Hiệp ', 35, 1),
(371, 'Huyện U Minh Thượng ', 35, 1),
(372, 'Huyện Vĩnh Thuận ', 35, 1),
(373, 'Huyện Đắk Glei ', 36, 1),
(374, 'Huyện Đắk Hà ', 36, 1),
(375, 'Huyện Đăk Tô ', 36, 1),
(376, 'Huyện Kon Plông ', 36, 1),
(377, 'Huyện Kon Rẫy ', 36, 1),
(378, 'Huyện Sa Thầy ', 36, 1),
(379, 'Huyện Tu Mơ Rông ', 36, 1),
(380, 'Thành phố Cam Ranh ', 17, 1),
(381, 'Huyện Diên Khánh ', 17, 1),
(382, 'Huyện Khánh Sơn ', 17, 1),
(383, 'Huyện Khánh Vĩnh ', 17, 1),
(384, 'Thành phố Nha Trang ', 17, 1),
(385, 'Thị xã Ninh Hòa ', 17, 1),
(386, 'Huyện Vạn Ninh ', 17, 1),
(387, 'Thị xã Lai Châu ', 37, 1),
(388, 'Huyện Phong Thổ ', 37, 1),
(389, 'Huyện Sìn Hồ ', 37, 1),
(390, 'Huyện Tam Đường ', 37, 1),
(391, 'Huyện Than Uyên ', 37, 1),
(392, 'Huyện Mường Tè ', 37, 1),
(393, 'Huyện Bắc Sơn ', 39, 1),
(394, 'Huyện Bình Gia ', 39, 1),
(395, 'Huyện Chi Lăng ', 39, 1),
(396, 'Huyện Đình Lập ', 39, 1),
(397, 'Huyện Hữu Lũng', 39, 1),
(398, 'Thành phố Lạng Sơn ', 39, 1),
(399, 'Huyện Lộc Bình ', 39, 1),
(400, 'Huyện Văn Quan ', 39, 1),
(401, 'Huyện Bát Xát ', 20, 1),
(402, 'Huyện Bắc Hà ', 20, 1),
(403, 'Thành phố Lào Cai ', 20, 1),
(404, 'Huyện Mường Khương ', 20, 1),
(405, 'Huyện Sa Pa ', 20, 1),
(406, 'Huyện Si Ma Cai ', 20, 1),
(407, 'Huyện Văn Bàn ', 20, 1),
(408, 'Huyện Bảo Lâm ', 38, 1),
(409, 'Thành phố Bảo Lộc ', 38, 1),
(410, 'Huyện Di Linh ', 38, 1),
(411, 'Thành phố Đà Lạt ', 38, 1),
(412, 'Huyện Đạ Tẻh ', 38, 1),
(413, 'Huyện Lạc Dương ', 38, 1),
(414, 'Huyện Lâm Hà ', 38, 1),
(415, 'Huyện Bến Lức ', 40, 1),
(416, 'Huyện Cần Đước ', 40, 1),
(417, 'Huyện Cần Giuộc ', 40, 1),
(418, 'Huyện Châu Thành ', 40, 1),
(419, 'Huyện Đức Hòa ', 40, 1),
(420, 'Huyện Đức Huệ ', 40, 1),
(421, 'Huyện Mộc Hóa ', 40, 1),
(422, 'Thành phố Tân An ', 40, 1),
(423, 'Huyện Tân Hưng ', 40, 1),
(424, 'Huyện Tân Thạnh ', 40, 1),
(425, 'Huyện Tân Trụ ', 40, 1),
(426, 'Huyện Thạnh Hóa ', 40, 1),
(427, 'Huyện Thủ Thừa ', 40, 1),
(428, 'Huyện Vĩnh Hưng ', 40, 1),
(429, 'Huyện Giao Thủy ', 23, 1),
(430, 'Huyện Hải Hậu ', 23, 1),
(431, 'Huyện Mỹ Lộc ', 23, 1),
(432, 'Thành phố Nam Định ', 23, 1),
(433, 'Huyện Nam Trực ', 23, 1),
(434, 'Huyện Nghĩa Hưng ', 23, 1),
(435, 'Huyện Trực Ninh ', 23, 1),
(436, 'Huyện Vụ Bản ', 23, 1),
(437, 'Huyện Xuân Trường ', 23, 1),
(438, 'Huyện Ý Yên ', 23, 1),
(439, 'Huyện Gia Viễn ', 42, 1),
(440, 'Huyện Kim Sơn ', 42, 1),
(441, 'Huyện Nho Quan', 42, 1),
(442, 'Thành phố Ninh Bình ', 42, 1),
(443, 'Thị xã Tam Điệp ', 42, 1),
(444, 'Huyện Ninh Sơn ', 43, 1),
(445, 'Thành phố Phan Rang-Tháp Chàm ', 43, 1),
(446, 'Huyện Anh Sơn ', 41, 1),
(447, 'Huyện Con Cuông ', 41, 1),
(448, 'Thị xã Cửa Lò ', 41, 1),
(449, 'Huyện Diễn Châu ', 41, 1),
(450, 'Huyện Đô Lương ', 41, 1),
(451, 'Huyện Hưng Nguyên ', 41, 1),
(452, 'Huyện Kỳ Sơn ', 41, 1),
(453, 'Huyện Nam Đàn ', 41, 1),
(454, 'Huyện Nghi Lộc ', 41, 1),
(455, 'Huyện Quỳ Hợp ', 41, 1),
(456, 'Huyện Quỳnh Lưu ', 41, 1),
(457, 'Huyện Tân Kỳ ', 41, 1),
(458, 'Thị xã Thái Hòa ', 41, 1),
(459, 'Huyện Thanh Chương ', 41, 1),
(460, 'Thành phố Vinh ', 41, 1),
(461, 'Huyện Yên Thành ', 41, 1),
(462, 'Huyện Đoan Hùng ', 44, 1),
(463, 'Huyện Hạ Hòa ', 44, 1),
(464, 'Huyện Lâm Thao ', 44, 1),
(465, 'Thị xã Phú Thọ', 44, 1),
(466, 'Huyện Thanh Ba ', 44, 1),
(467, 'Huyện Thanh Sơn ', 44, 1),
(468, 'Huyện Thanh Thủy ', 44, 1),
(469, 'Thành phố Việt Trì ', 44, 1),
(470, 'Huyện Yên Lập ', 44, 1),
(471, 'Thị xã Sông Cầu ', 45, 1),
(472, 'Huyện Tuy An ', 45, 1),
(473, 'Thành phố Tuy Hòa ', 45, 1),
(474, 'Huyện Bố Trạch ', 46, 1),
(475, 'Thành phố Đồng Hới ', 46, 1),
(476, 'Huyện Lệ Thủy ', 46, 1),
(477, 'Huyện Điện Bàn ', 47, 1),
(478, 'Thành phố Hội An ', 47, 1),
(479, 'Huyện Núi Thành ', 47, 1),
(480, 'Huyện Phú Ninh ', 47, 1),
(481, 'Thành phố Tam Kỳ ', 47, 1),
(482, 'Huyện Thăng Bình ', 47, 1),
(483, 'Huyện Tiên Phước ', 47, 1),
(484, 'Huyện Ba Chẽ ', 21, 1),
(485, 'Huyện Bình Liêu ', 21, 1),
(486, 'Thị xã Cẩm Phả ', 21, 1),
(487, 'Huyện đảo Cô Tô ', 21, 1),
(488, 'Huyện Đầm Hà ', 21, 1),
(489, 'Huyện Đông Triều ', 21, 1),
(490, 'Thành phố Hạ Long ', 21, 1),
(491, 'Huyện Hoành Bồ ', 21, 1),
(492, 'Thành phố Móng Cái ', 21, 1),
(493, 'Huyện Tiên Yên ', 21, 1),
(494, 'Thành phố Uông Bí ', 21, 1),
(495, 'Huyện Yên Hưng ', 21, 1),
(496, 'Huyện Ba Tơ ', 48, 1),
(497, 'Huyện Đức Phổ ', 48, 1),
(498, 'Huyện đảo Lý Sơn ', 48, 1),
(499, 'Huyện Minh Long ', 48, 1),
(500, 'Huyện Mộ Đức ', 48, 1),
(501, 'Thành phố Quảng Ngãi ', 48, 1),
(502, 'Huyện Sơn Hà ', 48, 1),
(503, 'Huyện Sơn Tịnh ', 48, 1),
(504, 'Huyện Trà Bồng ', 48, 1),
(505, 'Huyện Cam Lộ ', 49, 1),
(506, 'Huyện đảo Cồn Cỏ ', 49, 1),
(507, 'Huyện Đa Krông ', 49, 1),
(508, 'Thành phố Đông Hà ', 49, 1),
(509, 'Huyện Gio Linh ', 49, 1),
(510, 'Huyện Hải Lăng ', 49, 1),
(511, 'Thị xã Quảng Trị ', 49, 1),
(512, 'Huyện Vĩnh Linh ', 49, 1),
(513, 'Huyện Cù Lao Dung ', 50, 1),
(514, 'Huyện Kế Sách ', 50, 1),
(515, 'Huyện Long Phú ', 50, 1),
(516, 'Huyện Mỹ Tú ', 50, 1),
(517, 'Huyện Mỹ Xuyên ', 50, 1),
(518, 'Huyện Ngã Năm ', 50, 1),
(519, 'Thành phố Sóc Trăng ', 50, 1),
(520, 'Huyện Thạnh Trị ', 50, 1),
(521, 'Huyện Vĩnh Châu ', 50, 1),
(522, 'Huyện Châu Thành ', 50, 1),
(523, 'Huyện Bắc Yên ', 51, 1),
(524, 'Huyện Mộc Châu ', 51, 1),
(525, 'Huyện Phù Yên ', 51, 1),
(526, 'Huyện Quỳnh Nhai ', 51, 1),
(527, 'Huyện Sông Mã ', 51, 1),
(528, 'Huyện Sốp Cộp ', 51, 1),
(529, 'Thành phố Sơn La ', 51, 1),
(530, 'Huyện Thuận Châu ', 51, 1),
(531, 'Huyện Yên Châu ', 51, 1),
(532, 'Huyện Bến Cầu ', 52, 1),
(533, 'Huyện Châu Thành ', 52, 1),
(534, 'Huyện Dương Minh Châu ', 52, 1),
(535, 'Huyện Gò Dầu ', 52, 1),
(536, 'Huyện Hòa Thành ', 52, 1),
(537, 'Huyện Tân Biên ', 52, 1),
(538, 'Huyện Tân Châu ', 52, 1),
(539, 'Thị xã Tây Ninh ', 52, 1),
(540, 'Huyện Trảng Bàng ', 52, 1),
(541, 'Huyện Cai Lậy ', 56, 1),
(542, 'Huyện Cái Bè ', 56, 1),
(543, 'Huyện Chợ Gạo ', 56, 1),
(544, 'Thị xã Gò Công ', 56, 1),
(545, 'Thành phố Mỹ Tho ', 56, 1),
(546, 'Huyện Tân Phước ', 56, 1),
(547, 'Huyện Chiêm Hóa ', 58, 1),
(548, 'Huyện Hàm Yên ', 58, 1),
(549, 'Huyện Na Hang ', 58, 1),
(550, 'Huyện Sơn Dương ', 58, 1),
(551, 'Thành phố Tuyên Quang ', 58, 1),
(552, 'Huyện Yên Sơn ', 58, 1),
(553, 'Huyện Đông Hưng ', 53, 1),
(554, 'Huyện Hưng Hà ', 53, 1),
(555, 'Huyện Kiến Xương ', 53, 1),
(556, 'Huyện Quỳnh Phụ ', 53, 1),
(557, 'Thành phố Thái Bình ', 53, 1),
(558, 'Huyện Thái Thụy ', 53, 1),
(559, 'Huyện Tiền Hải ', 53, 1),
(560, 'Huyện Vũ Thư ', 53, 1),
(561, 'Huyện Đại Từ ', 54, 1),
(562, 'Huyện Đồng Hỷ ', 54, 1),
(563, 'Thị xã Sông Công ', 54, 1),
(564, 'Thành phố Thái Nguyên ', 54, 1),
(565, 'Huyện Bá Thước ', 55, 1),
(566, 'Thị xã Bỉm Sơn', 55, 1),
(567, 'Huyện Cẩm Thủy ', 55, 1),
(568, 'Huyện Hà Trung ', 55, 1),
(569, 'Huyện Hậu Lộc ', 55, 1),
(570, 'Huyện Hoằng Hóa ', 55, 1),
(571, 'Huyện Lang Chánh ', 55, 1),
(572, 'Huyện Mường Lát ', 55, 1),
(573, 'Huyện Nga Sơn ', 55, 1),
(574, 'Huyện Ngọc Lặc ', 55, 1),
(575, 'Huyện Nông Cống ', 55, 1),
(576, 'Huyện Quan Hóa ', 55, 1),
(577, 'Huyện Quan Sơn ', 55, 1),
(578, 'Huyện Quảng Xương ', 55, 1),
(579, 'Thị xã Sầm Sơn ', 55, 1),
(580, 'Huyện Thạch Thành ', 55, 1),
(581, 'Thành phố Thanh Hóa ', 55, 1),
(582, 'Huyện Thiệu Hóa ', 55, 1),
(583, 'Huyện Thọ Xuân ', 55, 1),
(584, 'Huyện Thường Xuân ', 55, 1),
(585, 'Huyện Tĩnh Gia ', 55, 1),
(586, 'Huyện Triệu Sơn ', 55, 1),
(587, 'Huyện Vĩnh Lộc ', 55, 1),
(588, 'Huyện Yên Định ', 55, 1),
(589, 'Huyện Càng Long ', 57, 1),
(590, 'Huyện Cầu Kè ', 57, 1),
(591, 'Huyện Cầu Ngang ', 57, 1),
(592, 'Huyện Châu Thành ', 57, 1),
(593, 'Huyện Duyên Hải ', 57, 1),
(594, 'Huyện Tiểu Cần ', 57, 1),
(595, 'Huyện Trà Cú ', 57, 1),
(596, 'Thành phố Trà Vinh ', 57, 1),
(597, 'Huyện Bình Minh ', 59, 1),
(598, 'Huyện Bình Tân ', 59, 1),
(599, 'Huyện Long Hồ ', 59, 1),
(600, 'Huyện Mang Thít ', 59, 1),
(601, 'Huyện Tam Bình ', 59, 1),
(602, 'Huyện Trà Ôn ', 59, 1),
(603, 'Thành phố Vĩnh Long ', 59, 1),
(604, 'Huyện Vũng Liêm ', 59, 1),
(605, 'Huyện Bình Xuyên ', 60, 1),
(606, 'Huyện Lập Thạch ', 60, 1),
(607, 'Thị xã Phúc Yên ', 60, 1),
(608, 'Huyện Vĩnh Tường ', 60, 1),
(609, 'Thành phố Vĩnh Yên ', 60, 1),
(610, 'Huyện Yên Lạc ', 60, 1),
(611, 'Huyện Tam Đảo ', 60, 1),
(612, 'Huyện Mù Căng Chải ', 61, 1),
(613, 'Thị xã Nghĩa Lộ ', 61, 1),
(614, 'Huyện Trạm Tấu ', 61, 1),
(615, 'Thành phố Yên Bái ', 61, 1),
(616, 'Huyện Yên Bình ', 61, 1),
(617, 'Huyện Điện Biên ', 71, 1),
(618, 'Huyện Điện Biên Đông ', 71, 1),
(619, 'Thành phố Điện Biên Phủ ', 71, 1),
(620, 'Huyện Mường Ảng ', 71, 1),
(621, 'Huyện Mường Chà ', 71, 1),
(622, 'Thị xã Mường Lay ', 71, 1),
(623, 'Huyện Mường Nhé ', 71, 1),
(624, 'Huyện Tủa Chùa ', 71, 1),
(625, 'Huyện Tuần Giáo ', 71, 1),
(626, 'Huyện Đông Anh', 2, 1),
(627, 'Thành phố Huế', 19, 1),
(628, 'Huyện Cần Giờ', 3, 1),
(629, 'Huyện Củ Chi', 3, 1),
(630, 'Huyện Vân Đồn', 21, 1),
(631, 'Huyện Hiệp Hòa', 7, 1),
(632, 'Huyện Lạng Giang', 7, 1),
(633, 'Huyện Việt Yên', 7, 1),
(634, 'Huyện Ba Bể', 14, 1),
(635, 'Huyện Bạch Thông ', 14, 1),
(636, 'Huyện Chợ Đồn', 14, 1),
(637, 'Huyện Pác Nặm ', 14, 1),
(638, 'Huyện Lương Tài', 6, 1),
(639, 'Huyện Mỏ Cày Bắc ', 13, 1),
(640, 'Huyện Hoài Ân ', 9, 1),
(641, 'Huyện Bù Đốp ', 10, 1),
(642, 'Huyện Chơn Thành', 10, 1),
(643, 'Huyện Đồng Phú ', 10, 1),
(644, 'Huyện Hớn Quản', 10, 1),
(645, 'Huyện Bắc Bình ', 11, 1),
(646, 'Huyện Đức Linh', 11, 1),
(647, 'Huyện Hàm Thuận Bắc', 11, 1),
(648, 'Huyện Hàm Thuận Nam', 11, 1),
(649, 'Huyện đảo Phú Quý', 11, 1),
(650, 'Huyện Tánh Linh', 11, 1),
(651, 'Huyện Thới Lai ', 15, 1),
(652, 'Huyện Hà Quảng', 25, 1),
(653, 'Huyện Hạ Lang ', 25, 1),
(654, 'Huyện Hòa An', 25, 1),
(655, 'Huyện Phục Hòa', 25, 1),
(656, 'Huyện Thạch An', 25, 1),
(657, 'Huyện Hòa Vang', 65, 1),
(658, 'Huyện Cư Mgar ', 62, 1),
(659, 'Huyện Lăk', 62, 1),
(660, 'Huyện Cư Jút ', 67, 1),
(661, 'Huyện Krông Nô', 67, 1),
(662, 'Huyện Chư Păh', 26, 1),
(663, 'Huyện Đắk Pơ', 26, 1),
(664, 'Huyện Ia Grai ', 26, 1),
(665, 'Huyện Ia Pa ', 26, 1),
(666, 'Huyện Bắc Mê ', 27, 1),
(667, 'Huyện Bắc Quang ', 27, 1),
(668, 'Huyện Hoàng Su Phì ', 27, 1),
(669, 'Huyện Quang Bình', 27, 1),
(670, 'Huyện Thanh Liêm ', 28, 1),
(671, 'Huyện Lộc Hà ', 30, 1),
(672, 'Huyện An Lão ', 32, 1),
(673, 'Huyện đảo Bạch Long Vĩ', 32, 1),
(674, 'Huyện Thuỷ Nguyên ', 32, 1),
(675, 'Huyện Kỳ Sơn ', 33, 1),
(676, 'Huyện Kim Động ', 34, 1),
(677, 'Huyện Phù Cừ ', 34, 1),
(678, 'Huyện Tiên Lữ ', 34, 1),
(679, 'Huyện đảo Trường Sa', 17, 1),
(680, 'Huyện Cam Lâm ', 17, 1),
(681, 'Huyện đảo Kiên Hải ', 35, 1),
(682, 'Huyện Giang Thành', 35, 1),
(683, 'Thành phố Kon Tum', 36, 1),
(684, 'Huyện Ngọc Hồi', 36, 1),
(685, 'Huyện Tân Uyên', 37, 1),
(686, 'Huyện Cát Tiên ', 38, 1),
(687, 'Huyện Đạ Huoai ', 38, 1),
(688, 'Huyện Đam Rông ', 38, 1),
(689, 'huyện Đơn Dương ', 38, 1),
(690, 'Huyện Đức Trọng ', 38, 1),
(691, 'Huyện Cao Lộc', 39, 1),
(692, 'huyện Tràng Định ', 39, 1),
(693, 'Huyện Văn Lãng', 39, 1),
(694, 'Huyện Bảo Thắng ', 20, 1),
(695, 'Huyện Bảo Yên', 20, 1),
(696, 'Huyện Nghĩa Đàn ', 41, 1),
(697, 'Huyện Quế Phong ', 41, 1),
(698, 'Huyện Quỳ Châu ', 41, 1),
(699, 'Huyện Tương Dương ', 41, 1),
(700, 'Huyện Hoa Lư ', 42, 1),
(701, 'Huyện Yên Khánh ', 42, 1),
(702, 'Huyện Yên Mô ', 42, 1),
(703, 'Huyện Bác Ái ', 43, 1),
(704, 'Huyện Ninh Hải', 43, 1),
(705, 'Huyện Ninh Phước ', 43, 1),
(706, 'Huyện Thuận Bắc', 43, 1),
(707, 'Huyện Thuận Nam ', 43, 1),
(708, 'Huyện Phù Ninh ', 44, 1),
(709, 'Huyện Tam Nông', 44, 1),
(710, 'Huyện Tân Sơn', 44, 1),
(711, 'Huyện Cẩm Khê', 44, 1),
(712, 'Huyện Đông Hòa ', 45, 1),
(713, 'Huyện Đồng Xuân', 45, 1),
(714, 'Huyện Phú Hòa', 45, 1),
(715, 'Huyện Sông Hinh', 45, 1),
(716, 'Huyện Sơn Hòa', 45, 1),
(717, 'Huyện Tây Hòa', 45, 1),
(718, 'Huyện Minh Hóa ', 46, 1),
(719, 'Huyện Quảng Ninh', 46, 1),
(720, 'Huyện Quảng Trạch ', 46, 1),
(721, 'Huyện Tuyên Hóa', 46, 1),
(722, 'Huyện Nam Trà My ', 47, 1),
(723, 'Huyện Bắc Trà My ', 47, 1),
(724, 'Huyện Duy Xuyên', 47, 1),
(725, 'Huyện Đại Lộc', 47, 1),
(726, 'Huyện Đông Giang', 47, 1),
(727, 'Huyện Hiệp Đức ', 47, 1),
(728, 'Huyện Nam Giang ', 47, 1),
(729, 'Huyện Phước Sơn', 47, 1),
(730, 'Huyện Quế Sơn', 47, 1),
(731, 'Huyện Tây Giang', 47, 1),
(732, 'Huyện Nông Sơn', 47, 1),
(733, 'Huyện Bình Sơn ', 48, 1),
(734, 'Huyện Nghĩa Hành', 48, 1),
(735, 'Huyện Sơn Tây ', 48, 1),
(736, 'Huyện Tây Trà ', 48, 1),
(737, 'Huyện Tư Nghĩa ', 21, 1),
(738, 'Huyện Hải Hà ', 21, 1),
(739, 'Huyện Hướng Hóa ', 49, 1),
(740, 'Huyện Triệu Phong', 49, 1),
(741, 'Huyện Trần Đề', 50, 1),
(742, 'Huyện Mai Sơn', 51, 1),
(743, 'Huyện Mường La', 51, 1),
(744, 'Huyện Định Hóa', 54, 1),
(745, 'Huyện Phổ Yên ', 54, 1),
(746, 'Huyện Phú Bình', 54, 1),
(747, 'Huyện Phú Lương ', 54, 1),
(748, 'Huyện Võ Nhai', 54, 1),
(749, 'Huyện Đông Sơn ', 55, 1),
(750, 'Huyện Như Thanh', 55, 1),
(751, 'Huyện Như Xuân ', 55, 1),
(752, 'Huyện Châu Thành ', 56, 1),
(753, 'Huyện Gò Công Đông', 56, 1),
(754, 'Huyện Gò Công Tây', 56, 1),
(755, 'Huyện Tân Phú Đông', 56, 1),
(756, 'Huyện Bình Chánh ', 3, 1),
(757, 'Huyện Cần Giờ ', 3, 1),
(758, 'Huyện Cụ Chi', 3, 1),
(759, 'Huyện Hóc Môn ', 3, 1),
(760, 'Huyện Nhà Bè ', 3, 1),
(761, 'Huyện Lâm Bình', 58, 1),
(762, 'Huyện Sông Lô', 60, 1),
(763, 'Huyện Tam Dương', 60, 1),
(764, 'Huyện Lục Yên', 61, 1),
(765, 'Huyện Trấn Yên', 61, 1),
(766, 'Huyện Văn Chấn', 61, 1),
(767, 'Huyện Văn Yên ', 61, 1),
(768, 'Thị xã Sơn Tây', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
`con_id` bigint(20) unsigned NOT NULL,
  `con_merchant_id` bigint(20) NOT NULL,
  `con_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `con_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `con_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `con_content` text COLLATE utf8_unicode_ci NOT NULL,
  `con_create_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE IF NOT EXISTS `feedbacks` (
`feed_id` int(10) unsigned NOT NULL,
  `feed_fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `feed_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `feed_message` text COLLATE utf8_unicode_ci NOT NULL,
  `feed_time` int(11) NOT NULL,
  `feed_status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time_create` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
`pag_id` int(11) NOT NULL,
  `pag_title` varchar(255) DEFAULT NULL,
  `pag_teaser` varchar(255) DEFAULT NULL,
  `pag_content` text,
  `pag_create_time` int(11) DEFAULT NULL,
  `pag_update_time` int(11) DEFAULT NULL,
  `pag_domain_id` int(11) NOT NULL,
  `pag_type` tinyint(4) NOT NULL DEFAULT '0',
  `pag_active` tinyint(1) NOT NULL DEFAULT '0',
  `pag_position` tinyint(4) NOT NULL DEFAULT '0',
  `pag_parent` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`pos_id` int(11) NOT NULL,
  `pos_merchant_id` int(11) NOT NULL,
  `pos_creator_id` int(11) DEFAULT NULL,
  `pos_category_id` int(11) NOT NULL DEFAULT '0',
  `pos_image` varchar(50) DEFAULT NULL,
  `pos_title` varchar(255) DEFAULT NULL,
  `pos_teaser` varchar(255) DEFAULT NULL,
  `pos_content` text,
  `pos_create_time` int(11) DEFAULT NULL,
  `pos_update_time` int(11) DEFAULT NULL,
  `pos_type` tinyint(4) NOT NULL DEFAULT '0',
  `pos_active` tinyint(1) NOT NULL DEFAULT '0',
  `pos_hot` tinyint(1) NOT NULL,
  `pos_icon` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
`id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `skype` varchar(255) DEFAULT NULL,
  `yahoo` varchar(45) DEFAULT NULL,
  `about` text,
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `domain_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `owner` text NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `gplus` varchar(255) NOT NULL,
  `ga_code` varchar(500) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE IF NOT EXISTS `subscribers` (
`sub_id` int(10) unsigned NOT NULL,
  `sub_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sub_time_created` int(11) NOT NULL,
  `sub_time_updated` int(11) NOT NULL,
  `sub_active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE IF NOT EXISTS `testimonials` (
`tes_id` bigint(20) unsigned NOT NULL,
  `tes_merchant_id` int(11) NOT NULL,
  `tes_creator_id` int(11) NOT NULL,
  `tes_fullname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tes_store` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tes_content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `tes_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tes_type` tinyint(1) NOT NULL DEFAULT '0',
  `tes_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) unsigned NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `gender` tinyint(1) DEFAULT '0',
  `birthday` int(11) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `fax` varchar(25) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `activated` tinyint(1) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `fullname`, `password`, `gender`, `birthday`, `phone`, `fax`, `address`, `activated`, `avatar`, `created_at`, `updated_at`, `deleted_at`, `remember_token`) VALUES
(1, 'admin@developervn.com', 'Justin Luong', '$2y$10$fqjLE9lsmJCDUe4ipLPdV.1GF6a3MguzGc928jEgVAdpjJV6sLZY6', 1, NULL, '841694132368', NULL, NULL, 1, NULL, '2015-05-20 09:21:45', '2015-05-20 09:21:45', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_permissions`
--
ALTER TABLE `admin_permissions`
 ADD PRIMARY KEY (`ape_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
 ADD PRIMARY KEY (`cit_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
 ADD PRIMARY KEY (`con_id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
 ADD PRIMARY KEY (`feed_id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
 ADD PRIMARY KEY (`pag_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`pos_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
 ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
 ADD PRIMARY KEY (`tes_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_permissions`
--
ALTER TABLE `admin_permissions`
MODIFY `ape_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=165;
--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
MODIFY `cit_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=769;
--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
MODIFY `con_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
MODIFY `feed_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
MODIFY `pag_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `pos_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
MODIFY `sub_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
MODIFY `tes_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
