-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 27, 2015 at 01:41 PM
-- Server version: 5.5.44
-- PHP Version: 5.3.10-1ubuntu3.19

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `workspharma`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `admin_name` varchar(64) CHARACTER SET utf8 NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 NOT NULL,
  `hashkey` varchar(32) NOT NULL,
  `email` varchar(128) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `role_id`, `admin_name`, `password`, `hashkey`, `email`, `avatar`, `is_deleted`) VALUES
(3, 1, 'admin', 'd138768d3b5eca407f0dd579c5ca3767', '7aLrG', 'admin@gmail.com', 'locked_1408411338.jpg', 0),
(8, 4, 'admin1231', 'e8cc61d06e8c8cd8ceed01820f460cd3', 'CEYvf', 'duythieu@gmail.com', '', 1),
(9, 1, 'admin11', '4297f44b13955235245b2497399d7a93', 'pux6s', 'duythieu123@gmail.com', 'Untitled_1408356531.png', 0),
(10, 1, 'hieuld', 'c378a29f02dcc3cd45a17649f9016fd0', 'cRu9a', 'hieuld@gmail.com', '', 0),
(11, 1, 'phuong.pham', '2c7db5d079f6a4167859b5a13ee06980', 'bZ6cY', 'phuong.pham@applancer.net', '', 0),
(12, 1, 'ngoc.do', '7d385190b972747164c827a22b9203c3', 'CPO1b', 'ngoc.do@applancer.net', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin_privilege`
--

CREATE TABLE IF NOT EXISTS `admin_privilege` (
  `privilege_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL,
  PRIMARY KEY (`privilege_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1367 ;

--
-- Dumping data for table `admin_privilege`
--

INSERT INTO `admin_privilege` (`privilege_id`, `role_id`, `resource_id`) VALUES
(26, 5, 1),
(27, 5, 2),
(28, 5, 3),
(1276, 1, 1),
(1277, 1, 2),
(1278, 1, 3),
(1279, 1, 22),
(1280, 1, 75),
(1281, 1, 4),
(1282, 1, 5),
(1283, 1, 6),
(1284, 1, 18),
(1285, 1, 21),
(1286, 1, 78),
(1287, 1, 7),
(1288, 1, 89),
(1289, 1, 8),
(1290, 1, 9),
(1291, 1, 10),
(1292, 1, 11),
(1293, 1, 60),
(1294, 1, 79),
(1295, 1, 86),
(1296, 1, 87),
(1297, 1, 88),
(1298, 1, 94),
(1299, 1, 12),
(1300, 1, 13),
(1301, 1, 14),
(1302, 1, 15),
(1303, 1, 16),
(1304, 1, 77),
(1305, 1, 23),
(1306, 1, 24),
(1307, 1, 25),
(1308, 1, 26),
(1309, 1, 76),
(1310, 1, 27),
(1311, 1, 28),
(1312, 1, 29),
(1313, 1, 30),
(1314, 1, 31),
(1315, 1, 32),
(1316, 1, 33),
(1317, 1, 34),
(1318, 1, 35),
(1319, 1, 36),
(1320, 1, 37),
(1321, 1, 38),
(1322, 1, 39),
(1323, 1, 40),
(1324, 1, 41),
(1325, 1, 42),
(1326, 1, 43),
(1327, 1, 44),
(1328, 1, 45),
(1329, 1, 46),
(1330, 1, 47),
(1331, 1, 48),
(1332, 1, 49),
(1333, 1, 50),
(1334, 1, 51),
(1335, 1, 52),
(1336, 1, 53),
(1337, 1, 54),
(1338, 1, 55),
(1339, 1, 56),
(1340, 1, 57),
(1341, 1, 58),
(1342, 1, 59),
(1343, 1, 61),
(1344, 1, 62),
(1345, 1, 63),
(1346, 1, 64),
(1347, 1, 65),
(1348, 1, 66),
(1349, 1, 67),
(1350, 1, 73),
(1351, 1, 68),
(1352, 1, 69),
(1353, 1, 70),
(1354, 1, 71),
(1355, 1, 72),
(1356, 1, 74),
(1357, 1, 80),
(1358, 1, 81),
(1359, 1, 82),
(1360, 1, 83),
(1361, 1, 84),
(1362, 1, 85),
(1363, 1, 90),
(1364, 1, 91),
(1365, 1, 92),
(1366, 1, 93);

-- --------------------------------------------------------

--
-- Table structure for table `admin_resource`
--

CREATE TABLE IF NOT EXISTS `admin_resource` (
  `resource_id` int(11) NOT NULL AUTO_INCREMENT,
  `resource_name` varchar(128) NOT NULL,
  `controller` varchar(128) CHARACTER SET latin1 NOT NULL,
  `action` varchar(128) CHARACTER SET latin1 NOT NULL,
  `detail` varchar(128) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`resource_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=95 ;

--
-- Dumping data for table `admin_resource`
--

INSERT INTO `admin_resource` (`resource_id`, `resource_name`, `controller`, `action`, `detail`, `is_deleted`) VALUES
(1, 'View Projects', 'skills', 'viewProjects', 'Projects', 0),
(2, 'Edit Projects', 'skills', 'editProject', 'Projects', 0),
(3, 'Delete Projects', 'skills', 'deleteProjects', 'Projects', 0),
(4, 'View Categories', 'skills', 'viewCategories', 'Categories', 0),
(5, 'Edit Categories', 'skills', 'editCategory', 'Categories', 0),
(6, 'Delete Categories', 'skills', 'deleteCategory', 'Categories', 0),
(7, 'Restore Resource', 'users', 'restoreAdminResource', 'Resource', 0),
(8, 'view user admin', 'users', 'viewAdmin', 'Admin', 0),
(9, 'Edit user admin', 'users', 'manageAdmin', 'Admin', 0),
(10, 'Delete user admin', 'users', 'deleteAdmin', 'Admin', 0),
(11, 'Restore user admin', 'users', 'restoreAdmin', 'Admin', 0),
(12, 'View groups', 'skills', 'viewGroups', 'Groups', 0),
(13, 'Edit groups', 'skills', 'editGroup', 'Groups', 0),
(14, 'Add groups', 'skills', 'addGroup', 'Groups', 0),
(15, 'Delete groups', 'skills', 'deleteGroup', 'Groups', 0),
(16, 'Restore groups', 'skills', 'restoreGroup', 'Groups', 0),
(18, 'Add category', 'skills', 'addCategory', 'Categories', 0),
(21, 'Restore category', 'skills', 'restoreCategory', 'Categories', 0),
(22, 'Restore projects', 'skills', 'restoreProjects', 'Projects', 0),
(23, 'View bids', 'skills', 'viewBids', 'Bids', 0),
(24, 'Edit bids', 'skills', 'editBids', 'Bids', 0),
(25, 'Restore bids', 'skills', 'restoreBids', 'Bids', 0),
(26, 'Delete bids', 'skills', 'deleteBids', 'Bids', 0),
(27, 'View users', 'users', 'viewUsers', 'Users', 0),
(28, 'Add user', 'users', 'addUsers', 'Users', 0),
(29, 'Edit user', 'users', 'editUser', 'Users', 0),
(30, 'Delete user', 'users', 'deleteUser', 'Users', 0),
(31, 'Restore user', 'users', 'restoreUser', 'Users', 0),
(32, 'View bans', 'users', 'viewBans', 'Bans', 0),
(33, 'Add bans', 'users', 'addBans', 'Bans', 0),
(34, 'Edit bans', 'users', 'editBans', 'Bans', 0),
(35, 'Delete bans', 'users', 'deleteBans', 'Bans', 0),
(36, 'Restore bans', 'users', 'restoreBans', 'Bans', 0),
(37, 'View suspend', 'users', 'viewSuspend', 'Suspend', 0),
(38, 'Add suspend', 'users', 'addSuspend', 'Suspend', 0),
(39, 'Edit suspend', 'users', 'editSuspend', 'Suspend', 0),
(40, 'Delete suspend', 'users', 'deleteSuspend', 'Suspend', 0),
(41, 'Restore suspend', 'users', 'restoreSuspend', 'Suspend', 0),
(42, 'View email setting', 'emailSettings', 'index', 'emailSettings', 0),
(43, 'Add email setting', 'emailSettings', 'addemailSettings', 'emailSettings', 0),
(44, 'Edit email setting', 'emailSettings', 'edit', 'emailSettings', 0),
(45, 'Delete email setting', 'emailSettings', 'delete', 'emailSettings', 0),
(46, 'Restore email setting', 'emailSettings', 'restore', 'emailSettings', 0),
(47, 'Edit site settings', 'siteSettings', 'index', 'siteSettings', 0),
(48, 'Payment settings', 'paymentSettings', 'index', 'payments', 0),
(49, 'View support', 'support', 'viewSupport', 'Supports', 0),
(50, 'View faq', 'faq', 'viewFaqs', 'Faqs', 0),
(51, 'Add faq', 'faq', 'addFaq', 'Faqs', 0),
(52, 'Edit faq', 'faq', 'editFaq', 'Faqs', 0),
(53, 'Delete faq', 'faq', 'deleteFaq', 'Faqs', 0),
(54, 'Restore faq', 'faq', 'restoreFaq', 'Faqs', 0),
(55, 'View faq categories', 'faq', 'viewFaqCategories', 'Faq categories', 0),
(56, 'Add faq category', 'faq', 'addFaqCategory', 'Faq categories', 0),
(57, 'Edit faq category', 'faq', 'editFaqCategory', 'Faq categories', 0),
(58, 'Delete faq category', 'faq', 'deleteFaqCategory', 'Faq categories', 0),
(59, 'Restore faq category', 'faq', 'restoreFaqCategory', 'Faq categories', 0),
(60, 'Edit user admin', 'users', 'editAdmin', 'Admin', 0),
(61, 'View list objects', 'listObjects', 'viewListObjects', 'ListObjects', 0),
(62, 'Add list object', 'listObjects', 'addListObject', 'ListObjects', 0),
(63, 'View milestone categories', 'milestones', 'viewMilestoneCategories', 'Milestone categories', 0),
(64, 'Add milestone categories', 'milestones', 'addMilestoneCategories', 'Milestone categories', 0),
(65, 'Edit milestone categories', 'milestones', 'editMilestoneCategories', 'Milestone categories', 0),
(66, 'Delete milestone categories', 'milestones', 'deleteMilestoneCategories', 'Milestone categories', 0),
(67, 'Restore milestone categories', 'milestones', 'restoreMilestoneCategories', 'Milestone categories', 0),
(68, 'View milestones', 'milestones', 'viewMilestones', 'Milestones', 0),
(69, 'Add milestone', 'milestones', 'addMilestone', 'Milestones', 0),
(70, 'Edit milestone', 'milestones', 'editMilestone', 'Milestones', 0),
(71, 'Delete milestone', 'milestones', 'deleteMilestone', 'Milestones', 0),
(72, 'Restore milestone', 'milestones', 'restoreMilestone', 'Milestones', 0),
(73, 'Trash milestone categories', 'milestones', 'trashMilestoneCategories', 'Milestone categories', 0),
(74, 'Trash milestones', 'milestones', 'trashMilestones', 'Milestones', 0),
(75, 'Trash projects', 'skills', 'trashProjects', 'Projects', 0),
(76, 'Trash bids', 'skills', 'trashBids', 'Bids', 0),
(77, 'Trash groups', 'skills', 'trashGroups', 'Groups', 0),
(78, 'Trash categories', 'skills', 'trashCategories', 'Categories', 0),
(79, 'Trash admin', 'users', 'trashAdmin', 'Admin', 0),
(80, 'View device', 'skills', 'viewDevices', 'Devices', 0),
(81, 'Add device', 'skills', 'addDevice', 'Devices', 0),
(82, 'Edit device', 'skills', 'editDevice', 'Devices', 0),
(83, 'Delete device', 'skills', 'deleteDevice', 'Devices', 0),
(84, 'Restore device', 'skills', 'restoreDevice', 'Devices', 0),
(85, 'Trash device', 'skills', 'trashDevice', 'Devices', 0),
(86, 'View admin role', 'users', 'viewAdminRoles', 'Admin', 0),
(87, 'view admin resource', 'users', 'viewAdminResource', 'Admin', 0),
(88, 'edit admin role', 'users', 'editAdminRole', 'Admin', 0),
(89, 'add users resource', 'users', 'addAdminResource', 'Resource', 0),
(90, 'view transaction', 'payments', 'viewTransaction', 'payment', 0),
(91, 'get payments', 'payments', 'getPayments', 'payment', 0),
(92, 'view sub categories', 'skills', 'viewSubGroups', 'Sub categories', 0),
(93, 'Edit sub categories', 'skills', 'editSubGroup', 'Sub categories', 0),
(94, 'Add user admin', 'users', 'addAdmin', 'Admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin_roles`
--

CREATE TABLE IF NOT EXISTS `admin_roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `admin_roles`
--

INSERT INTO `admin_roles` (`role_id`, `role_name`, `is_deleted`) VALUES
(1, 'admin', 0),
(4, 'User', 0),
(5, 'user', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `category_en_name` varchar(255) NOT NULL,
  `parent_id` int(11) unsigned NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `page_title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `meta_keywords` text CHARACTER SET utf8 NOT NULL,
  `meta_description` text CHARACTER SET utf8 NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `view_search` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_en_name`, `parent_id`, `description`, `page_title`, `meta_keywords`, `meta_description`, `is_active`, `created`, `modified`, `is_deleted`, `view_search`) VALUES
(1, 'DƯỢC PHẨM/ TTB Y TẾ', 'PHARMACEUTICAL / MEDICAL TTB', 0, 'DƯỢC PHẨM/ TTB Y TẾ', 'DƯỢC PHẨM/ TTB Y TẾ', 'DƯỢC PHẨM/ TTB Y TẾ', 'DƯỢC PHẨM/ TTB Y TẾ', 1, 1255432752, 1446060499, 0, 6),
(2, 'Y TẾ/ CHĂM SÓC SK/ THẨM MỸ', 'HEALTH / CARE SK / BEAUTY', 0, 'Y TẾ/ CHĂM SÓC SK/ THẨM MỸ', 'Y TẾ/ CHĂM SÓC SK/ THẨM MỸ', 'Y TẾ/ CHĂM SÓC SK/ THẨM MỸ', 'Y TẾ/ CHĂM SÓC SK/ THẨM MỸ', 1, 1407904300, 1442891297, 0, 10),
(3, 'CÔNG NGHỆ SINH HỌC', 'BIOTECHNOLOGY', 0, 'CÔNG NGHỆ SINH HỌC', 'CÔNG NGHỆ SINH HỌC', 'CÔNG NGHỆ SINH HỌC', 'CÔNG NGHỆ SINH HỌC', 1, 1255432752, 1442891628, 0, 38),
(4, 'HÓA HỌC', 'CHEMISTRY', 0, 'HÓA HỌC', 'HÓA HỌC', 'HÓA HỌC', 'HÓA HỌC', 1, 1255432752, 1442891578, 0, 2),
(5, 'KHỐI HỖ TRỢ/ GIÁN TIẾP', 'BLOCK SUPPORT / INDIRECT', 0, 'KHỐI HỖ TRỢ/ GIÁN TIẾP', 'KHỐI HỖ TRỢ/ GIÁN TIẾP', 'KHỐI HỖ TRỢ/ GIÁN TIẾP', 'KHỐI HỖ TRỢ/ GIÁN TIẾP', 1, 1412892725, 1442891547, 0, 10),
(6, 'SẢN XUẤT', 'PRODUCE', 0, 'SẢN XUẤT', 'SẢN XUẤT', 'SẢN XUẤT', 'SẢN XUẤT', 1, 1255432752, 1442891806, 0, 3),
(7, 'THỰC TẬP SINH', 'INTERNS', 0, 'THỰC TẬP SINH', 'THỰC TẬP SINH', 'THỰC TẬP SINH', 'THỰC TẬP SINH', 1, 1412894365, 1442891779, 0, 16),
(8, 'THEO ĐỐI TƯỢNG', 'BY SUBJECT', 0, 'THEO ĐỐI TƯỢNG', 'THEO ĐỐI TƯỢNG', 'THEO ĐỐI TƯỢNG', 'THEO ĐỐI TƯỢNG', 1, 1255432752, 1442891739, 0, 6),
(9, 'KHÁC', 'OTHER', 0, 'KHÁC', 'KHÁC', 'KHÁC', 'KHÁC', 1, 1412894339, 1442894956, 0, 3),
(10, 'Trình dược viên', 'Pharmaceutical representatives', 1, 'Trình dược viên', 'Trình dược viên', 'Trình dược viên', 'Trình dược viên', 1, 0, 1447876724, 0, NULL),
(11, 'Chuyên viên/ QL Sản phẩm (PS/ PM)', 'Professional / Management Products (PS / PM)', 1, 'Chuyên viên/ QL Sản phẩm (PS/ PM)', 'Chuyên viên/ QL Sản phẩm (PS/ PM)', 'Chuyên viên/ QL Sản phẩm (PS/ PM)', 'Chuyên viên/ QL Sản phẩm (PS/ PM)', 1, 0, 1447876746, 0, NULL),
(12, 'Dược Sĩ', 'Pharmacist', 1, 'Dược Sĩ', 'Dược Sĩ', 'Dược Sĩ', 'Dược Sĩ', 1, 0, 1447876756, 0, NULL),
(13, 'Cố vấn Y khoa/ Tư vấn Sản phẩm', 'Medical Advisory / Consulting Products', 1, 'Cố vấn Y khoa/ Tư vấn Sản phẩm', 'Cố vấn Y khoa/ Tư vấn Sản phẩm', 'Cố vấn Y khoa/ Tư vấn Sản phẩm', 'Cố vấn Y khoa/ Tư vấn Sản phẩm', 1, 0, 1447876768, 0, NULL),
(14, 'Quản lý Khu vực/ Giám sát Kinh doanh', 'Regional Manager / Supervisor Sales', 1, 'Quản lý Khu vực/ Giám sát Kinh doanh', 'Quản lý Khu vực/ Giám sát Kinh doanh', 'Quản lý Khu vực/ Giám sát Kinh doanh', 'Quản lý Khu vực/ Giám sát Kinh doanh', 1, 0, 1447876779, 0, NULL),
(15, 'NV Bán thuốc/ Quầy dược', 'Employee Sell drug / pharmacy desk', 1, 'NV Bán thuốc/ Quầy dược', 'NV Bán thuốc/ Quầy dược', 'NV Bán thuốc/ Quầy dược', 'NV Bán thuốc/ Quầy dược', 1, 0, 1447876806, 0, NULL),
(16, 'Regulatory Affairs', 'Regulatory Affairs', 1, 'Regulatory Affairs', 'Regulatory Affairs', 'Regulatory Affairs', 'Regulatory Affairs', 1, 0, 1447876877, 0, NULL),
(17, 'Trang thiết bị Y tế', 'Medical Equipment', 1, 'Trang thiết bị Y tế', 'Trang thiết bị Y tế', 'Trang thiết bị Y tế', 'Trang thiết bị Y tế', 1, 0, 1447876888, 0, NULL),
(18, 'Thú Y', 'Veterinary', 1, 'Thú Y', 'Thú Y', 'Thú Y', 'Thú Y', 1, 0, 1447876898, 0, NULL),
(19, 'Bảo vệ Thực vật & Nông nghiệp/ Thủy sản', 'Protecting Plants & Agriculture / Fisheries', 1, 'Bảo vệ Thực vật & Nông nghiệp/ Thủy sản', 'Bảo vệ Thực vật & Nông nghiệp/ Thủy sản', 'Bảo vệ Thực vật & Nông nghiệp/ Thủy sản', 'Bảo vệ Thực vật & Nông nghiệp/ Thủy sản', 1, 0, 1447876908, 0, NULL),
(20, 'Dược Phẩm', 'Medicine', 1, 'Dược Phẩm', 'Dược Phẩm', 'Dược Phẩm', 'Dược Phẩm', 1, 0, 1447876917, 0, NULL),
(21, 'Bác sĩ/ Điều dưỡng/ Hộ sinh', 'Doctors / Nurses / Midwives', 2, 'Bác sĩ/ Điều dưỡng/ Hộ sinh', 'Bác sĩ/ Điều dưỡng/ Hộ sinh', 'Bác sĩ/ Điều dưỡng/ Hộ sinh', 'Bác sĩ/ Điều dưỡng/ Hộ sinh', 1, 0, 1442891360, 0, NULL),
(22, 'Nha Sĩ', 'Dentist', 2, 'Nha Sĩ', 'Nha Sĩ', 'Nha Sĩ', 'Nha Sĩ', 1, 0, 1442891372, 0, NULL),
(23, 'Kỹ thuật viên', 'Technicians', 2, 'Kỹ thuật viên', 'Kỹ thuật viên', 'Kỹ thuật viên', 'Kỹ thuật viên', 1, 0, 1442891453, 0, NULL),
(24, 'Trưởng/ Phó khoa', 'Head / Vice-Dean', 2, 'Trưởng/ Phó khoa', 'Trưởng/ Phó khoa', 'Trưởng/ Phó khoa', 'Trưởng/ Phó khoa', 1, 0, 1442891443, 0, NULL),
(25, 'Medical Affairs', 'Medical Affairs', 2, 'Medical Affairs', 'Medical Affairs', 'Medical Affairs', 'Medical Affairs', 1, 0, 1442891430, 0, NULL),
(26, 'Vật lý Trị liệu', 'Physical therapy', 2, 'Vật lý Trị liệu', 'Vật lý Trị liệu', 'Vật lý Trị liệu', 'Vật lý Trị liệu', 1, 0, 1442891410, 0, NULL),
(27, 'Thẩm Mỹ', 'Beauty', 2, 'Thẩm Mỹ', 'Thẩm Mỹ', 'Thẩm Mỹ', 'Thẩm Mỹ', 1, 0, 1442891400, 0, NULL),
(28, 'Y Tế/ Chăm sóc SK/ Dinh dưỡng', 'Health / Care SK / Nutrition', 2, 'Y Tế/ Chăm sóc SK/ Dinh dưỡng', 'Y Tế/ Chăm sóc SK/ Dinh dưỡng', 'Y Tế/ Chăm sóc SK/ Dinh dưỡng', 'Y Tế/ Chăm sóc SK/ Dinh dưỡng', 1, 0, 1442891390, 0, NULL),
(29, 'CNSH Nông - Lâm – Ngư/ Môi trường', 'Biotechnology and Agriculture - Forestry - Fisheries / Environment', 3, 'CNSH Nông - Lâm – Ngư/ Môi trường', 'CNSH Nông - Lâm – Ngư/ Môi trường', 'CNSH Nông - Lâm – Ngư/ Môi trường', 'CNSH Nông - Lâm – Ngư/ Môi trường', 1, 0, 1442891616, 0, NULL),
(30, 'CNSH Công nghiệp/ Thực phẩm', 'Biotechnology Industry / Food', 3, 'CNSH Công nghiệp/ Thực phẩm', 'CNSH Công nghiệp/ Thực phẩm', 'CNSH Công nghiệp/ Thực phẩm', 'CNSH Công nghiệp/ Thực phẩm', 1, 0, 1442891601, 0, NULL),
(31, 'CNSH Y dược/ Tin sinh học', 'Medical Biotechnology / Bioinformatics', 3, 'CNSH Y dược/ Tin sinh học', 'CNSH Y dược/ Tin sinh học', 'CNSH Y dược/ Tin sinh học', 'CNSH Y dược/ Tin sinh học', 1, 0, 1442891591, 0, NULL),
(32, 'Kỹ sư Hóa', 'Chemical Engineer', 4, 'Kỹ sư Hóa', 'Kỹ sư Hóa', 'Kỹ sư Hóa', 'Kỹ sư Hóa', 1, 0, 1442891568, 0, NULL),
(33, 'Kiểm nghiệm viên/ NV P. Thí Nghiệm', 'Test User / NV P. Laboratory', 4, 'Kiểm nghiệm viên/ NV P. Thí Nghiệm', 'Kiểm nghiệm viên/ NV P. Thí Nghiệm', 'Kiểm nghiệm viên/ NV P. Thí Nghiệm', 'Kiểm nghiệm viên/ NV P. Thí Nghiệm', 1, 0, 1442891557, 0, NULL),
(34, 'Bán hàng/ Kinh doanh', 'Sales / Business Development', 5, 'Bán hàng/ Kinh doanh', 'Bán hàng/ Kinh doanh', 'Bán hàng/ Kinh doanh', 'Bán hàng/ Kinh doanh', 1, 0, 1442891528, 0, NULL),
(35, 'Kế toán/ Tài chính/ Kiểm toán', 'Accounting / Finance / Audit', 5, 'Kế toán/ Tài chính/ Kiểm toán', 'Kế toán/ Tài chính/ Kiểm toán', 'Kế toán/ Tài chính/ Kiểm toán', 'Kế toán/ Tài chính/ Kiểm toán', 1, 0, 1442891517, 0, NULL),
(36, 'Nhân sự/ Luật', 'HR / Law', 5, 'Nhân sự/ Luật', 'Nhân sự/ Luật', 'Nhân sự/ Luật', 'Nhân sự/ Luật', 1, 0, 1442891507, 0, NULL),
(37, 'Hành chính/ Thư ký/ Hồ sơ thầu', 'Administrative / Clerical / Tender', 5, 'Hành chính/ Thư ký/ Hồ sơ thầu', 'Hành chính/ Thư ký/ Hồ sơ thầu', 'Hành chính/ Thư ký/ Hồ sơ thầu', 'Hành chính/ Thư ký/ Hồ sơ thầu', 1, 0, 1442891496, 0, NULL),
(38, 'Dịch vụ khách hàng/ Sales admin', 'Customer Service / Sales admin', 5, 'Dịch vụ khách hàng/ Sales admin', 'Dịch vụ khách hàng/ Sales admin', 'Dịch vụ khách hàng/ Sales admin', 'Dịch vụ khách hàng/ Sales admin', 1, 0, 1442891486, 0, NULL),
(39, 'Marketing/ Digital/ Design/ PR', 'Marketing/ Digital/ Design/ PR', 5, 'Marketing/ Digital/ Design/ PR', 'Marketing/ Digital/ Design/ PR', 'Marketing/ Digital/ Design/ PR', 'Marketing/ Digital/ Design/ PR', 1, 0, 1442891476, 0, NULL),
(40, 'Quản lý chất lượng (QA/ QC)', 'Quality Control (QA / QC)', 5, 'Quản lý chất lượng (QA/ QC)', 'Quản lý chất lượng (QA/ QC)', 'Quản lý chất lượng (QA/ QC)', 'Quản lý chất lượng (QA/ QC)', 1, 0, 1442891891, 0, NULL),
(41, 'Quản trị mạng/ Lập trình viên', 'Network Administrator / Programmer', 5, 'Quản trị mạng/ Lập trình viên', 'Quản trị mạng/ Lập trình viên', 'Quản trị mạng/ Lập trình viên', 'Quản trị mạng/ Lập trình viên', 1, 0, 1442891881, 0, NULL),
(42, 'Xuất nhập khẩu/ Kinh doanh quốc tế', 'Export / International Business', 5, 'Xuất nhập khẩu/ Kinh doanh quốc tế', 'Xuất nhập khẩu/ Kinh doanh quốc tế', 'Xuất nhập khẩu/ Kinh doanh quốc tế', 'Xuất nhập khẩu/ Kinh doanh quốc tế', 1, 0, 1442891870, 0, NULL),
(43, 'Biên phiên dịch', 'Interpreter', 5, 'Biên phiên dịch', 'Biên phiên dịch', 'Biên phiên dịch', 'Biên phiên dịch', 1, 0, 1442891858, 0, NULL),
(44, 'Cung ứng/ Mua hàng', 'Supply / Purchase', 5, 'Cung ứng/ Mua hàng', 'Cung ứng/ Mua hàng', 'Cung ứng/ Mua hàng', 'Cung ứng/ Mua hàng', 1, 0, 1442891847, 0, NULL),
(45, 'Bảo trì/ Kỹ thuật hạ tầng', 'Maintenance / Engineering Infrastructure', 5, 'Bảo trì/ Kỹ thuật hạ tầng', 'Bảo trì/ Kỹ thuật hạ tầng', 'Bảo trì/ Kỹ thuật hạ tầng', 'Bảo trì/ Kỹ thuật hạ tầng', 1, 0, 1442891836, 0, NULL),
(46, 'Tài xế/ Giao hàng', 'Drivers / Delivery', 5, 'Tài xế/ Giao hàng', 'Tài xế/ Giao hàng', 'Tài xế/ Giao hàng', 'Tài xế/ Giao hàng', 1, 0, 1442891826, 0, NULL),
(47, 'Kho vận/ Vật tư', 'Warehouse / Logistics', 5, 'Kho vận/ Vật tư', 'Kho vận/ Vật tư', 'Kho vận/ Vật tư', 'Kho vận/ Vật tư', 1, 0, 1442891815, 0, NULL),
(48, 'R&D', 'R&D', 6, 'R&D', 'R&D', 'R&D', 'R&D', 1, 0, 1442891796, 0, NULL),
(49, 'Sản xuất/ Vận hành sản xuất', 'Production / Operations', 6, 'Sản xuất/ Vận hành sản xuất', 'Sản xuất/ Vận hành sản xuất', 'Sản xuất/ Vận hành sản xuất', 'Sản xuất/ Vận hành sản xuất', 1, 0, 1442891790, 0, NULL),
(50, 'Thực tập ngành Y', 'Practicing Medicine', 7, 'Thực tập ngành Y', 'Thực tập ngành Y', 'Thực tập ngành Y', 'Thực tập ngành Y', 1, 0, 1442891769, 0, NULL),
(51, 'Thực tập ngành Dược', 'Practicing the pharmaceutical industry', 7, 'Thực tập ngành Dược', 'Thực tập ngành Dược', 'Thực tập ngành Dược', 'Thực tập ngành Dược', 1, 0, 1442891759, 0, NULL),
(52, 'Thực tập sinh', 'Interns', 7, 'Thực tập sinh', 'Thực tập sinh', 'Thực tập sinh', 'Thực tập sinh', 1, 0, 1442891749, 0, NULL),
(53, 'Mới tốt nghiệp', 'Just have graduated', 8, 'Mới tốt nghiệp', 'Mới tốt nghiệp', 'Mới tốt nghiệp', 'Mới tốt nghiệp', 1, 0, 1442891728, 0, NULL),
(54, 'Bán thời gian', 'Part time', 8, 'Bán thời gian', 'Bán thời gian', 'Bán thời gian', 'Bán thời gian', 1, 0, 1442891717, 0, NULL),
(55, 'Hợp tác/ Freelance', 'Cooperation / Freelance', 8, 'Hợp tác/ Freelance', 'Hợp tác/ Freelance', 'Hợp tác/ Freelance', 'Hợp tác/ Freelance', 1, 0, 1442891704, 0, NULL),
(56, 'Thời vụ/ Dự án', 'Temporary / Project', 8, 'Thời vụ/ Dự án', 'Thời vụ/ Dự án', 'Thời vụ/ Dự án', 'Thời vụ/ Dự án', 1, 0, 1442891693, 0, NULL),
(57, 'Quản lý điều hành', 'Executive management', 8, 'Quản lý điều hành', 'Quản lý điều hành', 'Quản lý điều hành', 'Quản lý điều hành', 1, 0, 1442891682, 0, NULL),
(58, 'Người nước ngoài/ Việt kiều', 'Foreigner / Vietnamese overseas', 8, 'Người nước ngoài/ Việt kiều', 'Người nước ngoài/ Việt kiều', 'Người nước ngoài/ Việt kiều', 'Người nước ngoài/ Việt kiều', 1, 0, 1442891671, 0, NULL),
(59, 'Khác', '', 10, 'Khác', 'Khác', 'Khác', 'Khác', 1, 0, 0, 0, NULL),
(67, 'Hóa học', 'Chemistry', 4, '', 'Hóa học', 'Hóa học', 'Hóa học', 1, 1446064725, 1446064725, 0, NULL),
(68, 'Thực tập ngành CNSH', 'Internships biotech sector', 7, '', 'Thực tập ngành CNSH', 'Thực tập ngành CNSH', 'Thực tập ngành CNSH', 1, 1446064792, 1446064792, 0, NULL),
(69, 'Thực tập ngành Hóa', 'Internships Chemistry', 7, '', 'Thực tập ngành Hóa', 'Thực tập ngành Hóa', 'Thực tập ngành Hóa', 1, 1446064820, 1446064820, 0, NULL),
(70, 'Khác', 'Other', 9, '', 'Khác', 'Khác', 'Khác', 1, 1447876685, 1447876685, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `lang_code` char(2) NOT NULL,
  `country_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ucs2 AUTO_INCREMENT=154 ;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `city_name`, `date_created`, `date_updated`, `is_deleted`, `lang_code`, `country_id`) VALUES
(27, 'Hà Nội', '2014-10-29 17:11:24', '0000-00-00 00:00:00', 0, 'vi', 231),
(28, 'Hồ Chí Minh', '2014-10-29 17:12:08', '0000-00-00 00:00:00', 0, 'vi', 231),
(30, 'Cần Thơ', '2014-10-29 18:45:57', '0000-00-00 00:00:00', 0, 'vi', 231),
(31, 'Đà Nẵng', '2014-10-29 18:52:13', '0000-00-00 00:00:00', 0, 'vi', 231),
(32, 'Đồng Bằng Sông Cửu Long', '2015-05-06 23:03:42', '0000-00-00 00:00:00', 0, 'vi', 231),
(34, 'KV Bắc Trung Bộ', '2015-10-29 09:05:50', '0000-00-00 00:00:00', 0, '', 0),
(35, 'KV Đông Nam Bộ', '2015-10-29 09:06:30', '0000-00-00 00:00:00', 0, '', 0),
(36, 'KV Nam Trung Bộ', '2015-10-29 09:06:30', '0000-00-00 00:00:00', 0, '', 0),
(37, 'KV Tây Nguyên', '2015-10-29 09:08:41', '0000-00-00 00:00:00', 0, '', 0),
(38, 'An Giang', '2015-10-29 09:08:41', '0000-00-00 00:00:00', 0, '', 0),
(39, 'Bà Rịa – Vũng Tàu', '2015-10-29 09:08:51', '0000-00-00 00:00:00', 0, '', 0),
(40, 'Bạc Liêu', '2015-10-29 09:08:51', '0000-00-00 00:00:00', 0, '', 0),
(41, 'Bắc Cạn', '2015-10-29 09:09:03', '0000-00-00 00:00:00', 0, '', 0),
(42, 'Bắc Giang', '2015-10-29 09:09:03', '0000-00-00 00:00:00', 0, '', 0),
(43, 'Bắc Ninh', '2015-10-29 09:09:17', '0000-00-00 00:00:00', 0, '', 0),
(44, 'Bến Tre', '2015-10-29 09:09:17', '0000-00-00 00:00:00', 0, '', 0),
(45, 'Bình Dương', '2015-10-29 09:09:30', '0000-00-00 00:00:00', 0, '', 0),
(46, 'Bình Định', '2015-10-29 09:09:30', '0000-00-00 00:00:00', 0, '', 0),
(47, 'Bình Phước', '2015-10-29 09:09:43', '0000-00-00 00:00:00', 0, '', 0),
(48, 'Bình Thuận', '2015-10-29 09:09:43', '0000-00-00 00:00:00', 0, '', 0),
(49, 'Cà Mau', '2015-10-29 09:10:14', '0000-00-00 00:00:00', 0, '', 0),
(50, 'Cao Bằng', '2015-10-29 09:10:14', '0000-00-00 00:00:00', 0, '', 0),
(51, 'Dak Lak', '2015-10-29 09:10:27', '0000-00-00 00:00:00', 0, '', 0),
(52, 'Dak Nông', '2015-10-29 09:10:27', '0000-00-00 00:00:00', 0, '', 0),
(53, 'Điện Biên', '2015-10-29 09:10:40', '0000-00-00 00:00:00', 0, '', 0),
(54, 'Đồng Nai', '2015-10-29 09:10:40', '0000-00-00 00:00:00', 0, '', 0),
(55, 'Đồng Tháp', '2015-10-29 09:10:51', '0000-00-00 00:00:00', 0, '', 0),
(56, 'Gia Lai', '2015-10-29 09:10:51', '0000-00-00 00:00:00', 0, '', 0),
(57, 'Hà Giang', '2015-10-29 09:11:03', '0000-00-00 00:00:00', 0, '', 0),
(58, 'Hà Nam', '2015-10-29 09:11:03', '0000-00-00 00:00:00', 0, '', 0),
(59, 'Hà Tây', '2015-10-29 09:11:14', '0000-00-00 00:00:00', 0, '', 0),
(60, 'Hà Tĩnh', '2015-10-29 09:11:14', '0000-00-00 00:00:00', 0, '', 0),
(61, 'Hải Dương', '2015-10-29 09:11:25', '0000-00-00 00:00:00', 0, '', 0),
(62, 'Hải Phòng', '2015-10-29 09:11:25', '0000-00-00 00:00:00', 0, '', 0),
(63, 'Hậu Giang', '2015-10-29 09:11:36', '0000-00-00 00:00:00', 0, '', 0),
(64, 'Hòa Bình', '2015-10-29 09:11:36', '0000-00-00 00:00:00', 0, '', 0),
(65, 'Hưng Yên', '2015-10-29 09:11:51', '0000-00-00 00:00:00', 0, '', 0),
(66, 'Khánh Hòa', '2015-10-29 09:11:51', '0000-00-00 00:00:00', 0, '', 0),
(67, 'Kiên Giang', '2015-10-29 09:12:01', '0000-00-00 00:00:00', 0, '', 0),
(68, 'Kontum', '2015-10-29 09:12:01', '0000-00-00 00:00:00', 0, '', 0),
(69, 'Lai Châu', '2015-10-29 09:12:15', '0000-00-00 00:00:00', 0, '', 0),
(70, 'Lạng Sơn', '2015-10-29 09:12:15', '0000-00-00 00:00:00', 0, '', 0),
(71, 'Lào Cai', '2015-10-29 09:12:27', '0000-00-00 00:00:00', 0, '', 0),
(72, 'Lâm Đồng', '2015-10-29 09:12:27', '0000-00-00 00:00:00', 0, '', 0),
(73, 'Long An', '2015-10-29 09:12:41', '0000-00-00 00:00:00', 0, '', 0),
(74, 'Nam Định', '2015-10-29 09:12:41', '0000-00-00 00:00:00', 0, '', 0),
(75, 'Nghệ An', '2015-10-29 09:12:52', '0000-00-00 00:00:00', 0, '', 0),
(76, 'Ninh Bình', '2015-10-29 09:12:52', '0000-00-00 00:00:00', 0, '', 0),
(77, 'Ninh Thuận', '2015-10-29 09:13:04', '0000-00-00 00:00:00', 0, '', 0),
(78, 'Phú Thọ', '2015-10-29 09:13:04', '0000-00-00 00:00:00', 0, '', 0),
(79, 'Phú Yên', '2015-10-29 09:13:13', '0000-00-00 00:00:00', 0, '', 0),
(80, 'Quảng Bình', '2015-10-29 09:13:13', '0000-00-00 00:00:00', 0, '', 0),
(81, 'Quảng Nam', '2015-10-29 09:13:25', '0000-00-00 00:00:00', 0, '', 0),
(82, 'Quảng Ngãi', '2015-10-29 09:13:25', '0000-00-00 00:00:00', 0, '', 0),
(83, 'Quảng Ninh', '2015-10-29 09:13:36', '0000-00-00 00:00:00', 0, '', 0),
(84, 'Quảng Trị', '2015-10-29 09:13:36', '0000-00-00 00:00:00', 0, '', 0),
(85, 'Sóc Trăng', '2015-10-29 09:13:56', '0000-00-00 00:00:00', 0, '', 0),
(86, 'Sơn La', '2015-10-29 09:13:56', '0000-00-00 00:00:00', 0, '', 0),
(87, 'Tây Ninh', '2015-10-29 09:14:07', '0000-00-00 00:00:00', 0, '', 0),
(88, 'Thái Bình', '2015-10-29 09:14:07', '0000-00-00 00:00:00', 0, '', 0),
(89, 'Thái Nguyên', '2015-10-29 09:14:19', '0000-00-00 00:00:00', 0, '', 0),
(90, 'Thanh Hóa', '2015-10-29 09:14:19', '0000-00-00 00:00:00', 0, '', 0),
(91, 'Thừa Thiên – Huế', '2015-10-29 09:15:27', '0000-00-00 00:00:00', 0, '', 0),
(92, 'Tiền Giang', '2015-10-29 09:15:27', '0000-00-00 00:00:00', 0, '', 0),
(93, 'Trà Vinh', '2015-10-29 09:15:40', '0000-00-00 00:00:00', 0, '', 0),
(94, 'Tuyên Quang', '2015-10-29 09:15:40', '0000-00-00 00:00:00', 0, '', 0),
(95, 'Vĩnh Long', '2015-10-29 09:15:50', '0000-00-00 00:00:00', 0, '', 0),
(96, 'Vĩnh Phúc', '2015-10-29 09:15:50', '0000-00-00 00:00:00', 0, '', 0),
(97, 'Yên Bái', '2015-10-29 09:16:01', '0000-00-00 00:00:00', 0, '', 0),
(98, 'Toàn Quốc', '2015-10-29 09:16:01', '0000-00-00 00:00:00', 0, '', 0),
(99, 'Anh', '2015-11-21 15:20:05', '0000-00-00 00:00:00', 0, '', 0),
(100, 'Angeri', '2015-11-21 15:20:12', '0000-00-00 00:00:00', 0, '', 0),
(101, 'Angola', '2015-11-21 15:20:17', '0000-00-00 00:00:00', 0, '', 0),
(102, 'Ả Rập Saudi', '2015-11-21 15:20:24', '0000-00-00 00:00:00', 0, '', 0),
(103, 'Ấn Độ', '2015-11-21 15:20:34', '0000-00-00 00:00:00', 0, '', 0),
(104, 'Bahrain', '2015-11-21 15:20:38', '0000-00-00 00:00:00', 0, '', 0),
(105, 'Brunei', '2015-11-21 15:20:42', '0000-00-00 00:00:00', 0, '', 0),
(106, 'Bungari', '2015-11-21 15:20:47', '0000-00-00 00:00:00', 0, '', 0),
(107, 'Bangladesh', '2015-11-21 15:20:51', '0000-00-00 00:00:00', 0, '', 0),
(108, 'Campuchia', '2015-11-21 15:20:57', '0000-00-00 00:00:00', 0, '', 0),
(109, 'Canada', '2015-11-21 15:21:01', '0000-00-00 00:00:00', 0, '', 0),
(110, 'CH Séc', '2015-11-21 15:21:41', '0000-00-00 00:00:00', 0, '', 0),
(111, 'Congo', '2015-11-21 15:21:45', '0000-00-00 00:00:00', 0, '', 0),
(112, 'Đài Loan', '2015-11-21 15:21:50', '0000-00-00 00:00:00', 0, '', 0),
(113, 'Đức', '2015-11-21 15:21:55', '0000-00-00 00:00:00', 0, '', 0),
(114, 'Đông Timor', '2015-11-21 15:22:01', '0000-00-00 00:00:00', 0, '', 0),
(115, 'Hàn Quốc', '2015-11-21 15:22:07', '0000-00-00 00:00:00', 0, '', 0),
(116, 'Hồng Kông', '2015-11-21 15:22:13', '0000-00-00 00:00:00', 0, '', 0),
(117, 'Hungary', '2015-11-21 15:22:17', '0000-00-00 00:00:00', 0, '', 0),
(118, 'Indonesia', '2015-11-21 15:22:21', '0000-00-00 00:00:00', 0, '', 0),
(119, 'Iran', '2015-11-21 15:22:25', '0000-00-00 00:00:00', 0, '', 0),
(120, 'I rắc', '2015-11-21 15:22:31', '0000-00-00 00:00:00', 0, '', 0),
(121, 'Kenya', '2015-11-21 15:22:36', '0000-00-00 00:00:00', 0, '', 0),
(122, 'Kuwait', '2015-11-21 15:22:40', '0000-00-00 00:00:00', 0, '', 0),
(123, 'Lào', '2015-11-21 15:22:47', '0000-00-00 00:00:00', 0, '', 0),
(124, 'Lybia', '2015-11-21 15:22:51', '0000-00-00 00:00:00', 0, '', 0),
(125, 'Ma Cau', '2015-11-21 15:22:57', '0000-00-00 00:00:00', 0, '', 0),
(126, 'Malaysia', '2015-11-21 15:23:00', '0000-00-00 00:00:00', 0, '', 0),
(127, 'Myanmar', '2015-11-21 15:23:05', '0000-00-00 00:00:00', 0, '', 0),
(128, 'Mỹ', '2015-11-21 15:23:09', '0000-00-00 00:00:00', 0, '', 0),
(129, 'Mozambique', '2015-11-21 15:23:14', '0000-00-00 00:00:00', 0, '', 0),
(130, 'Nepal', '2015-11-21 15:23:18', '0000-00-00 00:00:00', 0, '', 0),
(131, 'New Zealand', '2015-11-21 15:23:23', '0000-00-00 00:00:00', 0, '', 0),
(132, 'Nhật Bản', '2015-11-21 15:23:29', '0000-00-00 00:00:00', 0, '', 0),
(133, 'Nga', '2015-11-21 15:23:33', '0000-00-00 00:00:00', 0, '', 0),
(134, 'Nigeria', '2015-11-21 15:23:38', '0000-00-00 00:00:00', 0, '', 0),
(135, 'Oman', '2015-11-21 15:23:41', '0000-00-00 00:00:00', 0, '', 0),
(136, 'Peru', '2015-11-21 15:23:45', '0000-00-00 00:00:00', 0, '', 0),
(137, 'Pháp', '2015-11-21 15:23:50', '0000-00-00 00:00:00', 0, '', 0),
(138, 'Philippines', '2015-11-21 15:23:54', '0000-00-00 00:00:00', 0, '', 0),
(139, 'Pakistan', '2015-11-21 15:24:00', '0000-00-00 00:00:00', 0, '', 0),
(140, 'Phần Lan', '2015-11-21 15:24:07', '0000-00-00 00:00:00', 0, '', 0),
(141, 'Qatar', '2015-11-21 15:24:11', '0000-00-00 00:00:00', 0, '', 0),
(142, 'Quốc Tế', '2015-11-21 15:24:16', '0000-00-00 00:00:00', 0, '', 0),
(143, 'Singapore', '2015-11-21 15:25:26', '0000-00-00 00:00:00', 0, '', 0),
(144, 'Sri Lanka', '2015-11-21 15:25:34', '0000-00-00 00:00:00', 0, '', 0),
(145, 'Thái Lan', '2015-11-21 15:25:42', '0000-00-00 00:00:00', 0, '', 0),
(146, 'Triều Tiên', '2015-11-21 15:25:48', '0000-00-00 00:00:00', 0, '', 0),
(147, 'Trung Quốc', '2015-11-21 15:25:55', '0000-00-00 00:00:00', 0, '', 0),
(148, 'Thổ Nhĩ Kỳ', '2015-11-21 15:26:01', '0000-00-00 00:00:00', 0, '', 0),
(149, 'Úc', '2015-11-21 15:26:05', '0000-00-00 00:00:00', 0, '', 0),
(150, 'UAE', '2015-11-21 15:26:09', '0000-00-00 00:00:00', 0, '', 0),
(151, 'Venezuela', '2015-11-21 15:26:13', '0000-00-00 00:00:00', 0, '', 0),
(152, 'Ý', '2015-11-21 15:26:18', '0000-00-00 00:00:00', 0, '', 0),
(153, 'Khác', '2015-11-21 15:26:22', '0000-00-00 00:00:00', 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ci_captcha`
--

CREATE TABLE IF NOT EXISTS `ci_captcha` (
  `captcha_id` bigint(13) unsigned NOT NULL AUTO_INCREMENT,
  `captcha_time` int(10) unsigned NOT NULL,
  `ip_address` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `word` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`captcha_id`),
  KEY `word` (`word`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=505 ;

--
-- Dumping data for table `ci_captcha`
--

INSERT INTO `ci_captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES
(498, 1432002425, '118.69.153.50', 'rC5Hl19X'),
(499, 1432002512, '118.69.153.50', 'RJ0QCxED'),
(500, 1432004150, '118.69.153.50', 'BT7AWSuv'),
(501, 1432004210, '118.69.153.50', 'Lps77goA'),
(502, 1432004250, '118.69.153.50', '7lsOG56h'),
(503, 1432004418, '118.69.153.50', 'u3yfSkR0'),
(504, 1432005086, '118.69.153.50', '1aWiIMed');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('1e7a8a5454f0e79b4bad5c1418f98289', '118.69.153.50', 'Mozilla/5.0 (iPhone; CPU iPhone OS 7_0 like Mac OS', 1434539388, 'a:4:{s:12:"timeout_hits";s:10:"1434539147";s:7:"user_id";s:2:"14";s:9:"logged_in";s:1:"1";s:7:"role_id";s:1:"2";}'),
('327aadbf981268ea27a0163b3cfed240', '118.69.153.50', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36', 1434539481, ''),
('354b61b4756e57b46522f18edb68fdd2', '118.69.153.50', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36', 1434537512, 'a:3:{s:7:"user_id";s:2:"14";s:9:"logged_in";s:1:"1";s:7:"role_id";s:1:"2";}'),
('3fdba7b5b77d67800826c55cf5a4e28c', '118.69.153.50', 'Mozilla/5.0 (iPhone; CPU iPhone OS 7_0 like Mac OS', 1434540351, ''),
('4078605a336be80720b089592dad7894', '118.69.153.50', 'Mozilla/5.0 (iPhone; U; CPU iPhone OS 4_2_1 like M', 1434539668, ''),
('57d4514d67aacc1d98cf7427dfefaadc', '118.69.153.50', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36', 1434535611, 'a:4:{s:12:"timeout_hits";s:10:"1434532744";s:7:"user_id";s:5:"49694";s:9:"logged_in";s:1:"1";s:7:"role_id";s:1:"1";}'),
('5ae7b280978f5953afebf76a87e059a6', '118.69.153.50', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS', 1434539653, ''),
('638ebd322433e41b7ec7cbf71e2258ab', '118.69.153.50', 'Mozilla/5.0 (iPhone; CPU iPhone OS 7_0 like Mac OS', 1434539999, ''),
('8b73387363c351b6523f22d2053fd0c6', '118.69.153.50', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36', 1434539757, ''),
('9da55ab0a61a87c7bc81bf31e86c870c', '118.69.153.50', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36', 1434540194, ''),
('a02ae87592bfa75c42cf52198862acb0', '118.69.153.50', 'Mozilla/5.0 (iPhone; U; CPU iPhone OS 4_2_1 like M', 1434540015, ''),
('aca7c802de8047dd206305ab0f9c6378', '118.69.153.50', 'Mozilla/5.0 (iPhone; U; CPU iPhone OS 4_2_1 like M', 1434540199, ''),
('b4af44e695eb85c3bc4d817fcfaab9d9', '118.69.153.50', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) Ap', 1434536332, 'a:3:{s:7:"user_id";s:5:"49805";s:9:"logged_in";s:1:"1";s:7:"role_id";s:1:"2";}'),
('bd13fa6907abd9e3df4c552c15473d41', '118.69.153.50', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36', 1434536095, 'a:4:{s:7:"user_id";s:2:"14";s:9:"logged_in";s:1:"1";s:7:"role_id";s:1:"2";s:13:"cart_contents";a:5:{s:32:"4ce611a8b76e52cfacebfd9870e87478";a:7:{s:5:"rowid";s:32:"4ce611a8b76e52cfacebfd9870e87478";s:2:"id";s:1:"1";s:4:"name";s:30:"30 ngày đăng tuyển dụng";s:5:"price";i:0;s:3:"qty";s:2:"10";s:7:"options";a:1:{s:5:"items";s:126:"[{"qty":1,"promotion":0},{"qty":2,"promotion":10},{"qty":3,"promotion":15},{"qty":5,"promotion":20},{"qty":10,"promotion":25}]";}s:8:"subtotal";i:0;}s:32:"eccbc87e4b5ce2fe28308fd9f2a7baf3";a:7:{s:5:"rowid";s:32:"eccbc87e4b5ce2fe28308fd9f2a7baf3";s:2:"id";s:1:"3";s:4:"name";s:44:"Hiển thị tin tuyển dụng tại TopDev";s:5:"price";i:0;s:3:"qty";s:2:"10";s:7:"options";a:1:{s:5:"items";N;}s:8:"subtotal";i:0;}s:32:"a87ff679a2f3e71d9181a67b7542122c";a:7:{s:5:"rowid";s:32:"a87ff679a2f3e71d9181a67b7542122c";s:2:"id";s:1:"4";s:4:"name";s:41:"Theo dõi lượt xem tin tuyển dụng\r";s:5:"price";i:0;s:3:"qty";s:2:"10";s:7:"options";a:1:{s:5:"items";N;}s:8:"subtotal";i:0;}s:11:"total_items";s:2:"30";s:10:"cart_total";s:1:"0";}}'),
('c1e866d1ae93e194f4e771ad59509da9', '118.69.153.50', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1434534312, ''),
('cee7672f1f217735852afbdd68016ad1', '118.69.153.50', 'Mozilla/5.0 (iPhone; U; CPU iPhone OS 4_2_1 like M', 1434539766, ''),
('e01d81b8299f0cf3edcda1fbd427bcac', '118.69.153.50', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36', 1434539481, 'a:3:{s:7:"user_id";s:2:"14";s:9:"logged_in";s:1:"1";s:7:"role_id";s:1:"2";}'),
('e1cc38ac322798b92910e01e2d637a3f', '118.69.153.50', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36', 1434536095, 'a:3:{s:7:"user_id";s:2:"14";s:9:"logged_in";s:1:"1";s:7:"role_id";s:1:"2";}'),
('fd13dd4898c39060f7514d6761e14660', '118.69.153.50', 'Mozilla/5.0 (iPhone; CPU iPhone OS 7_0 like Mac OS', 1434539502, '');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL,
  `subject_contact` text NOT NULL,
  `content_contact` text NOT NULL,
  `preson_contact` text NOT NULL,
  `phone_contact` text NOT NULL,
  `email_contact` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `country_symbol` varchar(3) CHARACTER SET utf8 NOT NULL,
  `country_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `order` int(10) NOT NULL DEFAULT '999',
  `set_default` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=245 ;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `country_symbol`, `country_name`, `order`, `set_default`) VALUES
(1, 'US', 'Anh', 999, 0),
(4, 'DZ', 'Algeria', 999, 0),
(7, 'AO', 'Angola', 999, 0),
(13, 'AU', 'Ả Rập Saudi', 999, 0),
(14, 'AT', 'Ấn Độ', 999, 0),
(17, 'BH', 'Bahrain', 999, 0),
(33, 'BN', 'Brunei', 999, 0),
(34, 'BG', 'Bulgaria', 999, 0),
(35, 'BF', 'Bangladesh', 999, 0),
(36, 'BI', 'Burundi', 999, 0),
(37, 'KH', 'Campuchia', 999, 0),
(39, 'CA', 'Canada', 999, 0),
(40, 'CV', 'CH Séc', 999, 0),
(50, 'CG', 'Congo', 999, 0),
(58, 'DK', 'Đài Loan', 999, 0),
(59, 'DJ', 'Đức', 999, 0),
(60, 'DM', 'Đông Timor', 999, 0),
(61, 'DO', 'Hàn Quốc', 999, 0),
(62, 'TP', 'Hồng Kông', 999, 0),
(99, 'HU', 'Hungary', 999, 0),
(102, 'ID', 'Indonesia', 999, 0),
(103, 'IR', 'Iran', 999, 0),
(104, 'IQ', 'Iraq', 999, 0),
(112, 'KE', 'Kenya', 999, 0),
(113, 'KI', 'Kiribati', 999, 0),
(114, 'KW', 'Kuwait', 999, 0),
(116, 'LA', 'Laos', 999, 0),
(121, 'LY', 'Libya', 999, 0),
(125, 'MO', 'Macau', 999, 0),
(129, 'MY', 'Malaysia', 3, 0),
(145, 'MZ', 'Mozambique', 999, 0),
(146, 'MM', 'Myanmar', 999, 0),
(149, 'NP', 'Nepal', 999, 0),
(153, 'NZ', 'New Zealand', 999, 0),
(155, 'NE', 'Nhật bản', 999, 0),
(156, 'NG', 'Nga', 999, 0),
(162, 'OM', 'Nigeria', 999, 0),
(163, 'PK', 'Oman', 999, 0),
(167, 'PY', 'Peru', 999, 0),
(168, 'PE', 'Pháp', 999, 0),
(169, 'PH', 'Philippines', 999, 0),
(170, 'PN', 'Pakistan', 999, 0),
(171, 'PL', 'Phần Lan', 999, 0),
(172, 'PT', 'Qatar', 999, 0),
(173, 'PR', 'Singapore', 999, 0),
(174, 'QA', 'Sri Lanka', 999, 0),
(175, 'RE', 'Thái Lan', 999, 0),
(176, 'RO', 'Triều Tiên', 999, 0),
(177, 'RU', 'Trung Quốc', 999, 0),
(178, 'RW', 'Thổ Nhĩ Kỳ', 999, 0),
(179, 'KN', 'Úc', 999, 0),
(180, 'LC', 'UAE', 999, 0),
(181, 'VC', 'Venezuela', 999, 0),
(182, 'WS', 'Việt Nam', 999, 1),
(243, '', 'Ý', 999, 0),
(244, '', 'Khác', 999, 0);

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE IF NOT EXISTS `currencies` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lang_code` char(2) NOT NULL,
  `currency_code` varchar(10) NOT NULL DEFAULT '',
  `currency_name` varchar(100) NOT NULL,
  `after` tinyint(1) NOT NULL DEFAULT '0',
  `symbol` varchar(30) NOT NULL DEFAULT '',
  `coefficient` double(12,0) NOT NULL DEFAULT '1',
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `weight` smallint(5) NOT NULL,
  `decimals_separator` char(1) NOT NULL DEFAULT '.',
  `thousands_separator` char(1) NOT NULL DEFAULT ',',
  `decimals` smallint(5) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `currency_code` (`currency_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE IF NOT EXISTS `district` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_code` char(2) NOT NULL,
  `city_id` int(11) NOT NULL,
  `district_name` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ucs2 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `lang_code`, `city_id`, `district_name`, `date_created`, `date_updated`, `is_deleted`) VALUES
(33, '', 27, 'Quận 1', '2015-06-03 04:51:01', '2015-06-03 11:51:01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE IF NOT EXISTS `email_templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(64) CHARACTER SET utf8 NOT NULL,
  `title` text CHARACTER SET utf8 NOT NULL,
  `mail_subject` text CHARACTER SET utf8 NOT NULL,
  `mail_body` text CHARACTER SET utf8 NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `priority` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=108 ;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `type`, `title`, `mail_subject`, `mail_body`, `is_deleted`, `priority`) VALUES
(1, 'active_account', 'Active account', 'Confirm E-mail for !site_title', 'Dear !username,\r\n<br/><br/>\r\nBạn vừa chọn !email để tạo một tài khoản trên Workspharma<br/><br/>\r\nĐể kích hoạt tài khoản, bạn vui lòng nhấp vào đường dẫn bên dưới hoặc copy vào trình duyệt.<br/>\r\n!activation_url\r\n<br/><br/>\r\nTại sao bạn lại nhân mail này?\r\nWorkspharma yêu cầu bạn xác nhận để chắc chắn rằng email này là của bạn. <br/>Tài khoản Workspharma sẽ không kích hoạt một số chức năng chính cho tới khi bạn xác nhận.\r\n<br/><br/>\r\nYou recently selected !email as your new Workspharma account.<br/><br/>\r\nTo verify this email address belongs to you, \r\nclick the link below and then sign in using your username and password.<br/>\r\n!activation_url\r\n<br/><br/>\r\nWhy you received this email?\r\nWorkspharma requests verification whenever an email address is selected as an\r\nWorkspharma Account. <br/>Your Applancer Account cannot be used until you verify it.\r\n<br/><br/>\r\nThanks,<br/>\r\nWorkspharma Support Team.', 0, 0),
(11, 'forgot_password', 'Forgot Password', 'Workspharma Team: New Password for Login', 'Hi !username,\r\n<br/><br/>\r\nWorkspharma recently received a request for a forgotten password.\r\n<br/><br/>\r\nTo change your Workspharma account password, please click the link below: !forgot_url\r\n<br/><br/>\r\nIf you did not request this change, you do not need to do anything.\r\n<br/><br/>\r\nThis link will expire in 24 hour. \r\n\r\n<br/><br/>\r\nThanks,<br/>\r\nWorkspharma Support Team.', 0, 0),
(106, 'send_resume_alert', 'Gửi thư thông báo ứng tuyển', '!title', '!content\r\n<br/><br/>\r\nThanks,<br/>\r\nWorkspharma Support Team.', 0, 0),
(83, 'email_marketing', 'Email marketing', '!subject', '<p>Dear !user_name,</p>\r\n\r\n<p>!content</p>\r\n\r\n<p>Thanks,<br />\r\nApplancer support.</p>\r\n\r\n<p><a href="!unsubscribe_link">Unsubscribe.</a></p>', 0, 0),
(84, 'email_schedules', 'Email schedules', 'Email schedules', '<p>Dear !user_name,</p>\n\n<p>!link_schedules</p>\n\n<p>&nbsp;</p>\n\n<p>Thanks you,<br />\nApplancer support.</p>', 0, 0),
(95, 'job_post', 'Email gửi thông báo cho người post job', 'Tin tuyển dụng của bạn đã được đăng trên workspharma', '<p>Ch&agrave;o</p>\r\n\r\n<p>Bạn mới đăng tin tuyển dụng tr&ecirc;n trang workspharma.</p>\r\n\r\n<p><strong><a href="!link">Click v&agrave;o đ&acirc;y</a></strong> để theo d&otilde;i th&ocirc;ng tin tuyển dụng.</p>\r\n\r\n<p>Tr&acirc;n trọng,<br />\r\nworkspharma team.</p>', 0, 0),
(97, 'job_apply', 'Email thông báo user apply', 'Một developer đã apply tin tuyển dụng của bạn', '<p>Ch&agrave;o !user_name,</p>\r\n\r\n<p>!user_apply đ&atilde; apply tin tuyển dụng của bạn.</p>\r\n\r\n<p><strong><a href="!link">Click v&agrave;o đ&acirc;y</a></strong> để biết th&ocirc;ng tin chi tiết.</p>\r\n\r\n<p>Tr&acirc;n trọng,<br />\r\nTopdev team.</p>', 0, 0),
(103, 'share_job', 'gửi mail share job', 'Bạn được giới thiệu ứng tuyển vào việc làm !jobtitle', '<table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:#ffffff;border-top:0;border-bottom:0;margin:0 auto">\r\n        <tbody>\r\n            <tr>\r\n                <td>\r\n                    <div style="font-family:Arial,sans-serif;padding:0px;background:#eee">\r\n                        <table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background:#eee;margin:0 auto" width="100%">\r\n                            <tbody>\r\n                                <tr>\r\n                                    <td>\r\n                                        &nbsp;</td>\r\n                                    <td align="center" style="padding:10px">\r\n                                        <a href="!url_home" style="border:none;outline:none" target="_blank"> <img alt="Workspharma Logo" src="!images" style="border:none;outline:none" width="220" class="CToWUd"> </a>\r\n                                    </td>\r\n                                </tr>\r\n                            </tbody>\r\n                        </table>\r\n                        <table align="center" border="0" cellpadding="0" cellspacing="0" style="background:#fff;border-collapse:collapse;margin:0 auto" width="100%">\r\n                            <tbody>\r\n                                <tr>\r\n                                    <td style="background:#00b9f2;height:5px;line-height:5px;width:33%">\r\n                                    </td>\r\n                                    <td style="background:#f7941d;height:5px;line-height:5px;width:33%">\r\n                                        </td>\r\n                                    <td style="background:#5cb85c;height:5px;line-height:5px;width:33%">\r\n                                        </td>\r\n                                </tr>\r\n                            </tbody>\r\n                        </table>\r\n                    </div>\r\n                    <table style="max-width:650px">\r\n                        <tbody>\r\n                            <tr>\r\n                                <td style="font-family:Arial,sans-serif;padding:30px;margin:0 auto">\r\n                                    <div>\r\n                                        \r\n                                        <p style="font-size:13px;line-height:25px;color:#555">\r\n                                            Chào <strong></strong>,</p>\r\n                                        <p style="font-size:13px;line-height:25px;color:#555">\r\n                                            \r\nBạn được giới thiệu ứng tuyển vào việc làm !jobtitle, nếu cảm thấy thích hợp bạn hãy tạo CV và ứng tuyển ngay với công cụ trực tuyến của workspharma. Xem chi tiết công việc tại:!url</p>\r\n                                        \r\n                                        <p style="font-size:13px;line-height:25px;padding:10px 0">\r\n                                            Phòng Dịch Vụ Khách Hàng\r\n                                            <br>\r\n                                            <span class="il">Workspharma Team</span></p>\r\n                                        <div style="font-size:11px;text-align:center;background:#eee;line-height:20px;min-height:20px;padding:5px">\r\n                                            <em>Đây là email tự động, vui lòng không trả lời email này.</em></div>\r\n                                        \r\n                                    </div>\r\n                                </td>\r\n                            </tr>\r\n                        </tbody>\r\n                    </table>\r\n                </td>\r\n            </tr>\r\n        </tbody>\r\n    </table>\r\n', 0, 0),
(105, 'worker_apply', 'worker apply', 'Bạn vừa ứng tuyển vào !company', '<table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:#ffffff;border-top:0;border-bottom:0;margin:0 auto">\r\n        <tbody>\r\n            <tr>\r\n                <td>\r\n                    <div style="font-family:Arial,sans-serif;padding:0px;background:#eee">\r\n                        <table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background:#eee;margin:0 auto" width="100%">\r\n                            <tbody>\r\n                                <tr>\r\n                                    <td>\r\n                                        &nbsp;</td>\r\n                                    <td align="center" style="padding:10px">\r\n                                        <a href="!url_home" style="border:none;outline:none" target="_blank"> <img alt="Workspharma Logo" src="!images" style="border:none;outline:none" width="220" class="CToWUd"> </a>\r\n                                    </td>\r\n                                </tr>\r\n                            </tbody>\r\n                        </table>\r\n                        <table align="center" border="0" cellpadding="0" cellspacing="0" style="background:#fff;border-collapse:collapse;margin:0 auto" width="100%">\r\n                            <tbody>\r\n                                <tr>\r\n                                    <td style="background:#00b9f2;height:5px;line-height:5px;width:33%">\r\n                                    </td>\r\n                                    <td style="background:#f7941d;height:5px;line-height:5px;width:33%">\r\n                                        </td>\r\n                                    <td style="background:#5cb85c;height:5px;line-height:5px;width:33%">\r\n                                        </td>\r\n                                </tr>\r\n                            </tbody>\r\n                        </table>\r\n                    </div>\r\n                    <table style="max-width:650px">\r\n                        <tbody>\r\n                            <tr>\r\n                                <td style="font-family:Arial,sans-serif;padding:30px;margin:0 auto">\r\n                                    <div>\r\n                                        <h1 style="font-size:30px;padding:10px 0;text-align:center;font-weight:normal">\r\n    																!company đã nhận được hồ sơ ứng tuyển của bạn<br>\r\n    																<strong><a style="color:#666;text-decoration:none">!title</a></strong></h1>\r\n                                        <p style="font-size:13px;line-height:25px;color:#555">\r\n                                            Chào <strong>!user_name</strong>,</p>\r\n                                        <p style="font-size:13px;line-height:25px;color:#555">\r\n                                            Nhà Tuyển Dụng sẽ cân nhắc và liên hệ với bạn trong thời gian sớm nhất nếu hồ sơ của bạn đáp ứng yêu cầu tuyển dụng.\r\n                                            <br>\r\n                                            <em>Tips: Lưu lại bản mô tả công việc này trên máy tính để chuẩn bị tốt cho buổi phỏng vấn.</em></p>\r\n                                        <table cellpadding="0" cellspacing="0" style="border-collapse:collapse" width="100%">\r\n                                            <tbody>\r\n                                                !listMatchingCategories\r\n                                            </tbody>\r\n                                        </table>\r\n                                        <p style="font-size:13px;line-height:25px">\r\n                                            Chúc bạn thăng tiến trong công việc và cuộc sống!</p>\r\n                                        <p style="font-size:13px;line-height:25px;padding:10px 0">\r\n                                            Phòng Dịch Vụ Khách Hàng\r\n                                            <br>\r\n                                            <span class="il">Workspharma Team</span></p>\r\n                                        <div style="font-size:11px;text-align:center;background:#eee;line-height:20px;min-height:20px;padding:5px">\r\n                                            <em>Đây là email tự động, vui lòng không trả lời email này.</em></div>\r\n                                        \r\n                                    </div>\r\n                                </td>\r\n                            </tr>\r\n                        </tbody>\r\n                    </table>\r\n                </td>\r\n            </tr>\r\n        </tbody>\r\n    </table>', 0, 0),
(107, 'contact', 'Contact from Customer', 'Contact from Customer', '!person\r\n<br>\r\n!phone\r\n<br>\r\n!body', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `employer_files`
--

CREATE TABLE IF NOT EXISTS `employer_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `checkstamp` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file_size` int(128) NOT NULL,
  `file_type` varchar(128) CHARACTER SET utf8 NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=204 ;

--
-- Dumping data for table `employer_files`
--

INSERT INTO `employer_files` (`id`, `user_id`, `checkstamp`, `name`, `path`, `file_size`, `file_type`, `date_created`, `is_deleted`) VALUES
(1, 49823, NULL, '', 'files/employers/2015/06/15/SoPCbt6EpWbGhmlh8tLa.jpg', 0, '', '2015-06-15 08:44:36', 0),
(2, 49823, NULL, '', 'files/employers/2015/06/15/1CVHLXB1arBiKxnbyrgX.jpg', 0, '', '2015-06-15 08:44:36', 0),
(3, 49823, NULL, '', 'files/employers/2015/06/15/1WggorXKWHYydGky6onJ.JPG', 0, '', '2015-06-15 08:44:37', 0),
(4, 49824, NULL, '', 'files/employers/2015/06/15/DdFMj2BopneV7Q7v3DAT.jpg', 0, '', '2015-06-15 08:44:38', 0),
(5, 49826, NULL, '', 'files/employers/2015/06/15/uRG3ysOzDtjWhCHvNcqG.jpg', 0, '', '2015-06-15 08:44:40', 0),
(6, 49826, NULL, '', 'files/employers/2015/06/15/Gay8FwRROsOUiL41Pg2L.jpg', 0, '', '2015-06-15 08:44:40', 0),
(7, 49826, NULL, '', 'files/employers/2015/06/15/SlDI1fZy01goJK9vhVzg.jpg', 0, '', '2015-06-15 08:44:40', 0),
(8, 49828, NULL, '', 'files/employers/2015/06/15/1nRr1guuqAsXPfcA8Pca.jpg', 0, '', '2015-06-15 08:44:42', 0),
(9, 49828, NULL, '', 'files/employers/2015/06/15/4Gzb4S06dzlqM8uZfGuK.jpg', 0, '', '2015-06-15 08:44:43', 0),
(10, 49828, NULL, '', 'files/employers/2015/06/15/CeVNib5i6R5m3ox89R3U.jpg', 0, '', '2015-06-15 08:44:43', 0),
(11, 49830, NULL, '', 'files/employers/2015/06/15/P6pcDJm7KYG1lzIrIQJa.JPG', 0, '', '2015-06-15 08:44:46', 0),
(12, 49830, NULL, '', 'files/employers/2015/06/15/cgXKNXi01caNrhYXzgXC.JPG', 0, '', '2015-06-15 08:44:46', 0),
(13, 49830, NULL, '', 'files/employers/2015/06/15/j53X31cAZtF5prbUsYlz.jpg', 0, '', '2015-06-15 08:44:46', 0),
(14, 49831, NULL, '', 'files/employers/2015/06/15/TlNcTvId08ePPXMa21mM.png', 0, '', '2015-06-15 08:44:47', 0),
(15, 49831, NULL, '', 'files/employers/2015/06/15/Z2za9tVMpmRhaQehN00O.jpg', 0, '', '2015-06-15 08:44:48', 0),
(16, 49831, NULL, '', 'files/employers/2015/06/15/IkSOJeGOdUhmnTJcvOP4.jpg', 0, '', '2015-06-15 08:44:48', 0),
(17, 49832, NULL, '', 'files/employers/2015/06/15/u3ntIoR9wUZqrHiriSV0.jpg', 0, '', '2015-06-15 08:44:49', 0),
(18, 49832, NULL, '', 'files/employers/2015/06/15/cgwxlaEEOAIUxkQU6s2C.jpg', 0, '', '2015-06-15 08:44:49', 0),
(19, 49832, NULL, '', 'files/employers/2015/06/15/dvxbZuhfEGeoApuLcpIE.jpg', 0, '', '2015-06-15 08:44:49', 0),
(20, 49833, NULL, '', 'files/employers/2015/06/15/RhC5AM4VBM8xfKN2vxJR.jpg', 0, '', '2015-06-15 08:44:51', 0),
(21, 49833, NULL, '', 'files/employers/2015/06/15/4vIwUMTavVsitmnGVHdJ.jpg', 0, '', '2015-06-15 08:44:51', 0),
(22, 49833, NULL, '', 'files/employers/2015/06/15/rAmfhDibR7pVPzwBbn9F.jpg', 0, '', '2015-06-15 08:44:51', 0),
(23, 49834, NULL, '', 'files/employers/2015/06/15/lx5OncCJTMLrogZK0JGZ.JPG', 0, '', '2015-06-15 08:44:53', 0),
(24, 49834, NULL, '', 'files/employers/2015/06/15/aVwFk1C9kwr8Txillv7C.JPG', 0, '', '2015-06-15 08:44:53', 0),
(25, 49834, NULL, '', 'files/employers/2015/06/15/6RpWr5Jydc1CKDIiUbla.JPG', 0, '', '2015-06-15 08:44:53', 0),
(26, 49835, NULL, '', 'files/employers/2015/06/15/PD5vJgnMiOcVDaSMwjP7.jpg', 0, '', '2015-06-15 08:44:54', 0),
(27, 49835, NULL, '', 'files/employers/2015/06/15/jyyVsCXlSUmcOMc91bEc.jpg', 0, '', '2015-06-15 08:44:55', 0),
(28, 49835, NULL, '', 'files/employers/2015/06/15/xL5bVka9bco4zsEYd6zQ.jpg', 0, '', '2015-06-15 08:44:55', 0),
(29, 49836, NULL, '', 'files/employers/2015/06/15/0JSfd0GqnLcb9Kfbr9ut.jpg', 0, '', '2015-06-15 08:44:56', 0),
(30, 49836, NULL, '', 'files/employers/2015/06/15/kSblrNhgFcKviMr4BZv9.jpg', 0, '', '2015-06-15 08:44:56', 0),
(31, 49836, NULL, '', 'files/employers/2015/06/15/F7pV3ReYdUNDT8eizdDt.jpg', 0, '', '2015-06-15 08:44:56', 0),
(32, 49838, NULL, '', 'files/employers/2015/06/15/YEB24dO3sqbEMTkTE3UJ.jpg', 0, '', '2015-06-15 08:44:58', 0),
(33, 49838, NULL, '', 'files/employers/2015/06/15/oIlulgczn2WAf43534BI.jpg', 0, '', '2015-06-15 08:44:59', 0),
(34, 49838, NULL, '', 'files/employers/2015/06/15/VMxvzWAWBjV76tEPbK8Z.jpg', 0, '', '2015-06-15 08:44:59', 0),
(35, 49839, NULL, '', 'files/employers/2015/06/15/lohRaCFyqn3FdmP166re.jpg', 0, '', '2015-06-15 08:45:00', 0),
(36, 49839, NULL, '', 'files/employers/2015/06/15/NGVwuHH1q1QmyVGEzqoJ.jpg', 0, '', '2015-06-15 08:45:00', 0),
(37, 49839, NULL, '', 'files/employers/2015/06/15/CHVEx9az6IlDnL596qd1.jpg', 0, '', '2015-06-15 08:45:01', 0),
(38, 49840, NULL, '', 'files/employers/2015/06/15/rvHyyAIySKUgRHzHoPS0.jpg', 0, '', '2015-06-15 08:45:02', 0),
(39, 49840, NULL, '', 'files/employers/2015/06/15/LsIdYhsnP9izE6SP7T3o.jpg', 0, '', '2015-06-15 08:45:02', 0),
(40, 49840, NULL, '', 'files/employers/2015/06/15/gjLYSfQvDjSUPRVki4eG.jpg', 0, '', '2015-06-15 08:45:02', 0),
(41, 49841, NULL, '', 'files/employers/2015/06/15/IDZi7EHRb0iorPGMrJR9.jpg', 0, '', '2015-06-15 08:45:04', 0),
(42, 49841, NULL, '', 'files/employers/2015/06/15/Cv7B4c5iCmuJmIJJ9lEx.jpg', 0, '', '2015-06-15 08:45:04', 0),
(43, 49841, NULL, '', 'files/employers/2015/06/15/upH5T1TYKi3rEHvQmtrx.jpg', 0, '', '2015-06-15 08:45:04', 0),
(44, 49842, NULL, '', 'files/employers/2015/06/15/GYXsEq3uVLSHXa6Sp2kQ.jpg', 0, '', '2015-06-15 09:23:08', 0),
(45, 49842, NULL, '', 'files/employers/2015/06/15/XoFn9EoOPFdkgfImPiUM.jpg', 0, '', '2015-06-15 09:23:08', 0),
(46, 49842, NULL, '', 'files/employers/2015/06/15/UiWxrJ3MspiKp91Fc7Xh.jpg', 0, '', '2015-06-15 09:23:09', 0),
(47, 49843, NULL, '', 'files/employers/2015/06/15/PFHlZZRxielBF62JdwJM.jpg', 0, '', '2015-06-15 09:23:10', 0),
(48, 49843, NULL, '', 'files/employers/2015/06/15/k0UE3wGC06oTUsCYXM6u.jpg', 0, '', '2015-06-15 09:23:10', 0),
(49, 49843, NULL, '', 'files/employers/2015/06/15/MVoDjmhxemGN6ZTmfmmv.jpg', 0, '', '2015-06-15 09:23:10', 0),
(50, 49845, NULL, '', 'files/employers/2015/06/15/xoEnusZ3GajJa5WYa1GL.jpg', 0, '', '2015-06-15 09:23:13', 0),
(51, 49845, NULL, '', 'files/employers/2015/06/15/9UiXysWZsAt0qaBlhdgt.jpg', 0, '', '2015-06-15 09:23:13', 0),
(52, 49845, NULL, '', 'files/employers/2015/06/15/Uohp0VcF7Xy3oDpae7Ce.jpg', 0, '', '2015-06-15 09:23:14', 0),
(53, 49847, NULL, '', 'files/employers/2015/06/15/lYeypCG7nTCXkP1PD9Qr.jpg', 0, '', '2015-06-15 09:23:16', 0),
(54, 49847, NULL, '', 'files/employers/2015/06/15/ZQEBfY3T85Y9bBAnvgSy.jpg', 0, '', '2015-06-15 09:23:16', 0),
(55, 49847, NULL, '', 'files/employers/2015/06/15/kZAUCDMEQFj4LtnlngUy.jpg', 0, '', '2015-06-15 09:23:16', 0),
(56, 49848, NULL, '', 'files/employers/2015/06/15/8oLnTfmHKEmfIhOnhgEg.jpg', 0, '', '2015-06-15 09:23:19', 0),
(57, 49848, NULL, '', 'files/employers/2015/06/15/seX983JgRVcFCPQm9nwr.jpg', 0, '', '2015-06-15 09:23:20', 0),
(58, 49848, NULL, '', 'files/employers/2015/06/15/3W1cPVp0ypNLiPsbGQWs.jpg', 0, '', '2015-06-15 09:23:20', 0),
(59, 49849, NULL, '', 'files/employers/2015/06/15/NQWqnXdfUW1CzrBHLl84.jpg', 0, '', '2015-06-15 09:23:21', 0),
(60, 49849, NULL, '', 'files/employers/2015/06/15/hLSmWPMamff7jvcAf7X5.jpg', 0, '', '2015-06-15 09:23:21', 0),
(61, 49849, NULL, '', 'files/employers/2015/06/15/VHU0GDulTNu67m0uxeRD.jpg', 0, '', '2015-06-15 09:23:21', 0),
(62, 49852, NULL, '', 'files/employers/2015/06/15/7UkhhM3EW7owfla7maej.jpg', 0, '', '2015-06-15 09:23:27', 0),
(63, 49852, NULL, '', 'files/employers/2015/06/15/t6MehNgPcH8JatLkGYQy.JPG', 0, '', '2015-06-15 09:23:27', 0),
(64, 49852, NULL, '', 'files/employers/2015/06/15/2EA5YtSnHunGqo4mBK4w.JPG', 0, '', '2015-06-15 09:23:27', 0),
(65, 49853, NULL, '', 'files/employers/2015/06/15/XbujY3Wt8IP9XILrz50v.JPG', 0, '', '2015-06-15 09:23:29', 0),
(66, 49853, NULL, '', 'files/employers/2015/06/15/61NyYI6mvzQk4b8iNsIA.jpg', 0, '', '2015-06-15 09:23:29', 0),
(67, 49853, NULL, '', 'files/employers/2015/06/15/PruCy7ce80oXjY0Q7tJl.jpg', 0, '', '2015-06-15 09:23:29', 0),
(68, 49854, NULL, '', 'files/employers/2015/06/15/mUi98TwQGeCFt9W7OsAb.jpg', 0, '', '2015-06-15 09:24:59', 0),
(69, 49854, NULL, '', 'files/employers/2015/06/15/luQX3u9bGo3sgVontqfh.jpg', 0, '', '2015-06-15 09:24:59', 0),
(70, 49854, NULL, '', 'files/employers/2015/06/15/RuXcREQzn7cg8Ky2ARDf.jpg', 0, '', '2015-06-15 09:24:59', 0),
(71, 49855, NULL, '', 'files/employers/2015/06/15/IYxpLrLTXqL1CPxAQyeD.JPG', 0, '', '2015-06-15 09:25:01', 0),
(72, 49855, NULL, '', 'files/employers/2015/06/15/RypKdyliqiBiBjPzd6Po.JPG', 0, '', '2015-06-15 09:25:01', 0),
(73, 49855, NULL, '', 'files/employers/2015/06/15/mVh9Xqi1jNdZmN4B4AD6.jpg', 0, '', '2015-06-15 09:25:01', 0),
(74, 49856, NULL, '', 'files/employers/2015/06/15/ExrAe2EzUzUgrToodVV5.png', 0, '', '2015-06-15 09:25:03', 0),
(75, 49856, NULL, '', 'files/employers/2015/06/15/PTj5fGhu6ywrUXJ5xnHd.jpg', 0, '', '2015-06-15 09:25:03', 0),
(76, 49856, NULL, '', 'files/employers/2015/06/15/9RHrMMFq49UxobulJOEz.jpg', 0, '', '2015-06-15 09:25:03', 0),
(77, 49857, NULL, '', 'files/employers/2015/06/15/KqXpqf7YhRVSEtYt8ZU5.jpg', 0, '', '2015-06-15 09:25:05', 0),
(78, 49857, NULL, '', 'files/employers/2015/06/15/1U8GshNpJYyCpOp6tB1O.jpg', 0, '', '2015-06-15 09:25:06', 0),
(79, 49857, NULL, '', 'files/employers/2015/06/15/4rhu1nkkuMo0XGpgSpzY.jpg', 0, '', '2015-06-15 09:25:06', 0),
(80, 49858, NULL, '', 'files/employers/2015/06/15/uc9lFjDdpBgKV86gbjzo.JPG', 0, '', '2015-06-15 09:25:08', 0),
(81, 49858, NULL, '', 'files/employers/2015/06/15/D3uzz8JUuWJe9yew7COX.jpg', 0, '', '2015-06-15 09:25:09', 0),
(82, 49858, NULL, '', 'files/employers/2015/06/15/LUvew7c1GW93IimOAR0w.png', 0, '', '2015-06-15 09:25:09', 0),
(83, 49859, NULL, '', 'files/employers/2015/06/15/yrFfc5G7yEpir1YGLQeu.jpg', 0, '', '2015-06-15 09:25:13', 0),
(84, 49859, NULL, '', 'files/employers/2015/06/15/MiGMIG7Gj05Yjx05U7lO.jpg', 0, '', '2015-06-15 09:25:14', 0),
(85, 49859, NULL, '', 'files/employers/2015/06/15/kT2K0SJhGwPWwbUZZr1D.jpg', 0, '', '2015-06-15 09:25:14', 0),
(86, 49861, NULL, '', 'files/employers/2015/06/15/oEIyW5cPeKpoK3PeW5pc.png', 0, '', '2015-06-15 09:25:16', 0),
(87, 49861, NULL, '', 'files/employers/2015/06/15/1BW59GVTXt6JfDF1TZgE.png', 0, '', '2015-06-15 09:25:17', 0),
(88, 49862, NULL, '', 'files/employers/2015/06/15/N3B9kGtnXhOH23O68M9P.jpg', 0, '', '2015-06-15 09:25:18', 0),
(89, 49862, NULL, '', 'files/employers/2015/06/15/oCOMMLiKcPQV5GqLBxcv.jpg', 0, '', '2015-06-15 09:25:19', 0),
(90, 49862, NULL, '', 'files/employers/2015/06/15/s4tuokoZdQfeM1tf9zC5.JPG', 0, '', '2015-06-15 09:25:19', 0),
(91, 49863, NULL, '', 'files/employers/2015/06/15/SPRXhQWtcX2vBsHlRQmw.JPG', 0, '', '2015-06-15 09:25:22', 0),
(92, 49863, NULL, '', 'files/employers/2015/06/15/WDEXMusFgOsCH6da4AOi.JPG', 0, '', '2015-06-15 09:25:22', 0),
(93, 49863, NULL, '', 'files/employers/2015/06/15/axkjAwI0nJVt48pYmRrq.JPG', 0, '', '2015-06-15 09:25:22', 0),
(94, 49866, NULL, '', 'files/employers/2015/06/15/qS41xWGVhol95Yelg9pA.jpg', 0, '', '2015-06-15 09:28:28', 0),
(95, 49866, NULL, '', 'files/employers/2015/06/15/dIJ0y5YfhGoP6xJa8yzd.JPG', 0, '', '2015-06-15 09:28:28', 0),
(96, 49866, NULL, '', 'files/employers/2015/06/15/bHClamo7takMHGEiSW80.jpg', 0, '', '2015-06-15 09:28:28', 0),
(97, 49868, NULL, '', 'files/employers/2015/06/15/ZxnZOqVFgEfUx2c67ofn.jpg', 0, '', '2015-06-15 09:29:59', 0),
(98, 49868, NULL, '', 'files/employers/2015/06/15/qO3Ck9LgEksm6Fl6zlgT.jpg', 0, '', '2015-06-15 09:29:59', 0),
(99, 49868, NULL, '', 'files/employers/2015/06/15/oIp7QHKW1YfTCw3LzUFO.jpg', 0, '', '2015-06-15 09:29:59', 0),
(100, 49870, NULL, '', 'files/employers/2015/06/15/U0lcqxH2oPnGote6bQOc.jpg', 0, '', '2015-06-15 09:30:03', 0),
(101, 49870, NULL, '', 'files/employers/2015/06/15/6D3GmU0RI1JpFhxBGxMB.JPG', 0, '', '2015-06-15 09:30:04', 0),
(102, 49870, NULL, '', 'files/employers/2015/06/15/vLmVD9Jrv6dzfuyy3PHb.jpg', 0, '', '2015-06-15 09:30:04', 0),
(103, 49871, NULL, '', 'files/employers/2015/06/15/Flk28vizJ86KXVDs2ep5.JPG', 0, '', '2015-06-15 09:30:08', 0),
(104, 49871, NULL, '', 'files/employers/2015/06/15/FEp1QQ7UMXw8IJBfEjPL.JPG', 0, '', '2015-06-15 09:30:08', 0),
(105, 49871, NULL, '', 'files/employers/2015/06/15/AMTDiETfYzwTIxYx8hUb.JPG', 0, '', '2015-06-15 09:30:09', 0),
(106, 49874, NULL, '', 'files/employers/2015/06/15/kwHGNnZ1uyJM444e998A.JPG', 0, '', '2015-06-15 09:30:14', 0),
(107, 49874, NULL, '', 'files/employers/2015/06/15/UTD8KSd3XjnaoqDpzNVP.jpg', 0, '', '2015-06-15 09:30:15', 0),
(108, 49874, NULL, '', 'files/employers/2015/06/15/o2dDjBmI9RAeQXNbIh8N.JPG', 0, '', '2015-06-15 09:30:15', 0),
(109, 49875, NULL, '', 'files/employers/2015/06/15/BrShRSUHL9Vk8neDkkqB.jpg', 0, '', '2015-06-15 09:30:16', 0),
(110, 49875, NULL, '', 'files/employers/2015/06/15/Jx0IBtXIy1RnNRfz5Jch.jpg', 0, '', '2015-06-15 09:30:16', 0),
(111, 49875, NULL, '', 'files/employers/2015/06/15/QyWufQ3Va20E7TwuUBnJ.jpg', 0, '', '2015-06-15 09:30:17', 0),
(112, 49876, NULL, '', 'files/employers/2015/06/15/Yvp4pky78L45QH2TQsLc.jpg', 0, '', '2015-06-15 09:30:18', 0),
(113, 49876, NULL, '', 'files/employers/2015/06/15/9jl1fKoYXHLV7fTxjyrV.jpg', 0, '', '2015-06-15 09:30:18', 0),
(114, 49876, NULL, '', 'files/employers/2015/06/15/S2ggKtMiGNopvuE0VKGT.jpg', 0, '', '2015-06-15 09:30:18', 0),
(115, 49881, NULL, '', 'files/employers/2015/06/15/vmZ5mtyWc3ApHaJzVqIo.jpg', 0, '', '2015-06-15 09:40:57', 0),
(116, 49881, NULL, '', 'files/employers/2015/06/15/x8bhXbLBebZKtUFhDPok.jpg', 0, '', '2015-06-15 09:40:57', 0),
(117, 49881, NULL, '', 'files/employers/2015/06/15/0slFR3a6mbiXVBX68acG.jpg', 0, '', '2015-06-15 09:40:57', 0),
(118, 49882, NULL, '', 'files/employers/2015/06/15/DiaEgFadysQc3Njtve85.jpg', 0, '', '2015-06-15 09:40:58', 0),
(119, 49882, NULL, '', 'files/employers/2015/06/15/RN9cdMcES0nqCsi2oVjd.jpg', 0, '', '2015-06-15 09:40:59', 0),
(120, 49882, NULL, '', 'files/employers/2015/06/15/9PpZldVRu5dEba2KIlJr.jpg', 0, '', '2015-06-15 09:40:59', 0),
(121, 49883, NULL, '', 'files/employers/2015/06/15/xJV8hkpJGG1E4kmCVXf5.JPG', 0, '', '2015-06-15 09:41:00', 0),
(122, 49883, NULL, '', 'files/employers/2015/06/15/xZACksv4XV1R6Di50o9z.jpg', 0, '', '2015-06-15 09:41:01', 0),
(123, 49883, NULL, '', 'files/employers/2015/06/15/qowHToJr9pxbNdnNNaSn.JPG', 0, '', '2015-06-15 09:41:01', 0),
(124, 49886, NULL, '', 'files/employers/2015/06/15/Yd8N2a7Zc9FjD1YsmxCZ.jpg', 0, '', '2015-06-15 09:41:08', 0),
(125, 49886, NULL, '', 'files/employers/2015/06/15/eS7okZCD7IF2fk8Gg7QP.JPG', 0, '', '2015-06-15 09:41:08', 0),
(126, 49886, NULL, '', 'files/employers/2015/06/15/WA8ZrONa5RACVGkcjM6D.JPG', 0, '', '2015-06-15 09:41:09', 0),
(127, 49889, NULL, '', 'files/employers/2015/06/15/TmxucypOyrNX7ce6qEjN.jpg', 0, '', '2015-06-15 09:41:11', 0),
(128, 49889, NULL, '', 'files/employers/2015/06/15/SxTyr714FuJka3bnSQQO.jpg', 0, '', '2015-06-15 09:41:12', 0),
(129, 49889, NULL, '', 'files/employers/2015/06/15/u6gsi5wC1Vzy2AHBCJTR.jpg', 0, '', '2015-06-15 09:41:12', 0),
(130, 49890, NULL, '', 'files/employers/2015/06/15/4dOwZEwKAtkQ34aGQIXB.jpg', 0, '', '2015-06-15 09:41:13', 0),
(131, 49890, NULL, '', 'files/employers/2015/06/15/7Q1IB1PXVUIzW7jumNbn.jpg', 0, '', '2015-06-15 09:41:13', 0),
(132, 49890, NULL, '', 'files/employers/2015/06/15/BUMg21NhQVJ0w1lnGJcn.jpg', 0, '', '2015-06-15 09:41:13', 0),
(133, 49891, NULL, '', 'files/employers/2015/06/15/JykvJ7kjlM6nyQxo1P1O.jpg', 0, '', '2015-06-15 09:41:14', 0),
(134, 49891, NULL, '', 'files/employers/2015/06/15/jKak5fRwYYMo9ovACx3R.jpg', 0, '', '2015-06-15 09:41:15', 0),
(135, 49891, NULL, '', 'files/employers/2015/06/15/LrAOsDwyGwqVqX5YAYKS.JPG', 0, '', '2015-06-15 09:41:15', 0),
(136, 49892, NULL, '', 'files/employers/2015/06/15/BGg55HjGvyNPthThqEAX.jpg', 0, '', '2015-06-15 09:41:36', 0),
(137, 49892, NULL, '', 'files/employers/2015/06/15/Etnpb1xsslqS8A4wztfM.jpg', 0, '', '2015-06-15 09:41:36', 0),
(138, 49892, NULL, '', 'files/employers/2015/06/15/epNuR6shUIPEDChNlcBo.jpg', 0, '', '2015-06-15 09:41:37', 0),
(139, 49893, NULL, '', 'files/employers/2015/06/15/xTyTqpCjSJN6av9fPefo.png', 0, '', '2015-06-15 09:41:41', 0),
(140, 49893, NULL, '', 'files/employers/2015/06/15/ULsIN5dgUowThAYHwETi.jpg', 0, '', '2015-06-15 09:41:41', 0),
(141, 49893, NULL, '', 'files/employers/2015/06/15/J7dGABO8gMT73nI2zp55.jpg', 0, '', '2015-06-15 09:41:41', 0),
(142, 49894, NULL, '', 'files/employers/2015/06/15/LTa6v7v4JpGPGm2aZ4mA.jpg', 0, '', '2015-06-15 09:41:46', 0),
(143, 49894, NULL, '', 'files/employers/2015/06/15/jCjNBIphkyH4koEaOcSK.jpg', 0, '', '2015-06-15 09:41:46', 0),
(144, 49894, NULL, '', 'files/employers/2015/06/15/8thflMpgaLdawj0pEa9V.jpg', 0, '', '2015-06-15 09:41:46', 0),
(145, 49897, NULL, '', 'files/employers/2015/06/15/6K5mJGzVizFJHC4H2l9k.jpg', 0, '', '2015-06-15 09:41:50', 0),
(146, 49897, NULL, '', 'files/employers/2015/06/15/r4L24PCXNRdU8HnuzrLV.jpg', 0, '', '2015-06-15 09:41:50', 0),
(147, 49897, NULL, '', 'files/employers/2015/06/15/tsDZayN7qPwkN1okZEp2.jpg', 0, '', '2015-06-15 09:41:50', 0),
(148, 49899, NULL, '', 'files/employers/2015/06/15/kg8ArMvj6zyNNgW6NiYo.png', 0, '', '2015-06-15 09:42:38', 0),
(149, 49899, NULL, '', 'files/employers/2015/06/15/ZMD1t51ZXddBeBsV60ts.png', 0, '', '2015-06-15 09:42:38', 0),
(150, 49899, NULL, '', 'files/employers/2015/06/15/aDoU1NqtZryzmwUzcMxH.png', 0, '', '2015-06-15 09:42:39', 0),
(151, 49900, NULL, '', 'files/employers/2015/06/15/qmchsxC9B4hkrFQzwP19.jpg', 0, '', '2015-06-15 09:42:40', 0),
(152, 49900, NULL, '', 'files/employers/2015/06/15/dBThsG35BPeWEs3pAgZH.jpg', 0, '', '2015-06-15 09:42:40', 0),
(153, 49900, NULL, '', 'files/employers/2015/06/15/QE8o8dZ9oczbQS6DF8E8.jpg', 0, '', '2015-06-15 09:42:40', 0),
(154, 49901, NULL, '', 'files/employers/2015/06/15/gyyjqSia5s03yKpyUP6v.jpg', 0, '', '2015-06-15 09:42:42', 0),
(155, 49901, NULL, '', 'files/employers/2015/06/15/Y4Xa4HsSli630dtFN3Ap.jpg', 0, '', '2015-06-15 09:42:43', 0),
(156, 49901, NULL, '', 'files/employers/2015/06/15/0Tcq3UxaC7c2gynBDUU8.jpg', 0, '', '2015-06-15 09:42:43', 0),
(157, 49902, NULL, '', 'files/employers/2015/06/15/Nr15LHddlwLg1lQ1bzkU.png', 0, '', '2015-06-15 09:42:45', 0),
(158, 49902, NULL, '', 'files/employers/2015/06/15/kLeYXaX5YFuG408DDibi.jpg', 0, '', '2015-06-15 09:42:45', 0),
(159, 49902, NULL, '', 'files/employers/2015/06/15/FrStx82tMhahWxNZgClG.jpg', 0, '', '2015-06-15 09:42:46', 0),
(160, 49903, NULL, '', 'files/employers/2015/06/15/1mJOPZyNPyYL6yXsCs5P.jpg', 0, '', '2015-06-15 09:42:47', 0),
(161, 49903, NULL, '', 'files/employers/2015/06/15/G0FUm0vKG42tRQyVwoCO.JPG', 0, '', '2015-06-15 09:42:47', 0),
(162, 49903, NULL, '', 'files/employers/2015/06/15/lYpqoVOHnfm78IrxDWD8.JPG', 0, '', '2015-06-15 09:42:47', 0),
(163, 49907, NULL, '', 'files/employers/2015/06/15/kFDAOeSCx12vukd2J1aQ.jpg', 0, '', '2015-06-15 09:43:48', 0),
(164, 49907, NULL, '', 'files/employers/2015/06/15/dGeVSdLfY2m3D96nksCy.jpg', 0, '', '2015-06-15 09:43:48', 0),
(165, 49907, NULL, '', 'files/employers/2015/06/15/xn0WIy3LHOkk2w8TA4GQ.jpg', 0, '', '2015-06-15 09:43:49', 0),
(166, 49908, NULL, '', 'files/employers/2015/06/15/BuqzxAZaRDb0ga9bjtuV.jpg', 0, '', '2015-06-15 09:43:50', 0),
(167, 49908, NULL, '', 'files/employers/2015/06/15/iyEQTFw7DtyPTl82wCXI.jpg', 0, '', '2015-06-15 09:43:50', 0),
(168, 49908, NULL, '', 'files/employers/2015/06/15/ssLiRqJb0VW16n8TrncV.jpg', 0, '', '2015-06-15 09:43:50', 0),
(169, 49911, NULL, '', 'files/employers/2015/06/15/kkKA861iZLWzlbOLKMcH.png', 0, '', '2015-06-15 09:43:56', 0),
(170, 49911, NULL, '', 'files/employers/2015/06/15/tcOC43nowPmSJtiCPF0H.png', 0, '', '2015-06-15 09:43:56', 0),
(171, 49911, NULL, '', 'files/employers/2015/06/15/gJT2rsUauDfTOBAr6L22.png', 0, '', '2015-06-15 09:43:56', 0),
(172, 49916, NULL, '', 'files/employers/2015/06/15/GfdhQKz2pMiR2JARoj0u.jpg', 0, '', '2015-06-15 09:44:49', 0),
(173, 49916, NULL, '', 'files/employers/2015/06/15/qcVh5I65NV94X5E0W3PD.jpg', 0, '', '2015-06-15 09:44:49', 0),
(174, 49916, NULL, '', 'files/employers/2015/06/15/tcjB0RMXiei2HTpyiX6c.jpg', 0, '', '2015-06-15 09:44:49', 0),
(175, 49917, NULL, '', 'files/employers/2015/06/15/EchIkdsqB04Iw2MeYjB6.jpg', 0, '', '2015-06-15 09:44:51', 0),
(176, 49917, NULL, '', 'files/employers/2015/06/15/nW2ISlo0ZjdZxncEtJzE.jpg', 0, '', '2015-06-15 09:44:51', 0),
(177, 49919, NULL, '', 'files/employers/2015/06/15/ECrHXmQWu3MwSzrsgo2S.jpg', 0, '', '2015-06-15 09:45:22', 0),
(178, 49919, NULL, '', 'files/employers/2015/06/15/wmVB40Kn0HWv2POxdLkA.jpg', 0, '', '2015-06-15 09:45:22', 0),
(179, 49919, NULL, '', 'files/employers/2015/06/15/zBjnahlmbz6lQAw69DIe.jpg', 0, '', '2015-06-15 09:45:22', 0),
(180, 49920, NULL, '', 'files/employers/2015/06/15/y5Lhg3NF6z60b8n7wgem.JPG', 0, '', '2015-06-15 09:45:24', 0),
(181, 49920, NULL, '', 'files/employers/2015/06/15/aCZTzeYhP4WCQ64zyy0C.JPG', 0, '', '2015-06-15 09:45:24', 0),
(182, 49920, NULL, '', 'files/employers/2015/06/15/QnOcwJYI8EeJXoUgELV1.JPG', 0, '', '2015-06-15 09:45:24', 0),
(183, 49921, NULL, '', 'files/employers/2015/06/15/ogOHISQ4EAGiUTGWYgFk.jpg', 0, '', '2015-06-15 09:45:26', 0),
(184, 49921, NULL, '', 'files/employers/2015/06/15/UJfTPLB6SijHwyLiiUA9.jpg', 0, '', '2015-06-15 09:45:26', 0),
(185, 49921, NULL, '', 'files/employers/2015/06/15/ccMNJb4ilVkZ0F3LywPM.jpg', 0, '', '2015-06-15 09:45:26', 0),
(186, 49922, NULL, '', 'files/employers/2015/06/15/NE3bO2LJ830TsowY3FQq.png', 0, '', '2015-06-15 09:45:47', 0),
(187, 49922, NULL, '', 'files/employers/2015/06/15/CxdOEuzOd8TN2tFiYCvJ.png', 0, '', '2015-06-15 09:45:48', 0),
(188, 49922, NULL, '', 'files/employers/2015/06/15/mjmUIHBSTfnK83nPfZv1.png', 0, '', '2015-06-15 09:45:48', 0),
(189, 49923, NULL, '', 'files/employers/2015/06/15/7HffiLj6nlGxPXkPfUFk.JPG', 0, '', '2015-06-15 09:45:56', 0),
(190, 49923, NULL, '', 'files/employers/2015/06/15/vo7qONSTAGel8A51Bkxy.JPG', 0, '', '2015-06-15 09:45:56', 0),
(191, 49923, NULL, '', 'files/employers/2015/06/15/1VtPJi6pOsZGnH4ZAwii.JPG', 0, '', '2015-06-15 09:45:57', 0),
(192, 49924, NULL, '', 'files/employers/2015/06/15/IMrUaktHjLWB26hpYk3i.jpg', 0, '', '2015-06-15 09:46:33', 0),
(193, 49924, NULL, '', 'files/employers/2015/06/15/PynFyJjNcOdGwPem8P7E.jpg', 0, '', '2015-06-15 09:46:33', 0),
(194, 49924, NULL, '', 'files/employers/2015/06/15/IjRzpbKZucyjKg54Xr8t.jpg', 0, '', '2015-06-15 09:46:33', 0),
(195, 49925, NULL, '', 'files/employers/2015/06/15/ENN3IVxgFpIaZCs7Oand.jpg', 0, '', '2015-06-15 09:46:35', 0),
(196, 49925, NULL, '', 'files/employers/2015/06/15/qcUBm0U192vVeZLi9i4e.JPG', 0, '', '2015-06-15 09:46:36', 0),
(197, 49925, NULL, '', 'files/employers/2015/06/15/vJpCNTNStLBFyjhG1SEV.JPG', 0, '', '2015-06-15 09:46:36', 0),
(198, 49805, NULL, 'IMG_2533_copy.JPG', 'files/employers/2015/06/16/IMG_2533_copy.JPG', 2027, 'image/jpeg', '2015-06-16 04:54:31', 1),
(199, 49805, NULL, '180.jpg', 'files/employers/2015/06/16/180.jpg', 13, 'image/jpeg', '2015-06-16 04:54:53', 1),
(200, 49805, NULL, '1024.jpg', 'files/employers/2015/06/16/1024.jpg', 61, 'image/jpeg', '2015-06-16 04:55:11', 0),
(201, 14, NULL, 'bg_ux_tool.png', 'files/employers/2015/06/16/bg_ux_tool.png', 288, 'image/png', '2015-06-16 06:42:37', 1),
(202, 14, NULL, 'bg_ux_tool.png', 'files/employers/2015/06/16/bg_ux_tool.png', 288, 'image/png', '2015-06-16 06:44:57', 1),
(203, 14, NULL, 'bg_ux_tool.png', 'files/employers/2015/06/16/bg_ux_tool.png', 288, 'image/png', '2015-06-16 06:45:27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `to_id` int(10) NOT NULL DEFAULT '0',
  `location` varchar(128) CHARACTER SET utf8 NOT NULL,
  `created` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `key` varchar(128) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file_size` int(128) NOT NULL,
  `file_type` varchar(128) CHARACTER SET utf8 NOT NULL,
  `original_name` varchar(128) CHARACTER SET utf8 NOT NULL,
  `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `descritpion` text CHARACTER SET utf8,
  `created` int(11) DEFAULT NULL,
  `modified` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `total` decimal(12,0) NOT NULL DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `payment_id` int(11) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=116 ;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `user_id`, `total`, `status`, `payment_id`, `fullname`, `company`, `phone`, `address`, `city_id`, `created_at`, `update_at`) VALUES
(26, 14, 15806714, 0, 2, NULL, NULL, NULL, NULL, NULL, '2015-05-08 14:35:17', '2015-05-08 07:35:17'),
(37, 14, 49091724, 0, 1, NULL, NULL, NULL, NULL, NULL, '2015-05-13 08:58:14', '2015-05-13 01:58:14'),
(38, 14, 2629880, 1, 2, NULL, NULL, NULL, NULL, NULL, '2015-05-14 16:48:19', '2015-05-14 09:49:46'),
(39, 14, 6811200, 0, 2, NULL, NULL, NULL, NULL, NULL, '2015-05-18 17:30:12', '2015-05-18 10:30:12'),
(40, 14, 0, 0, 2, NULL, NULL, NULL, NULL, NULL, '2015-05-18 17:30:30', '2015-05-18 10:30:30'),
(41, 14, 4420400, 0, 2, NULL, NULL, NULL, NULL, NULL, '2015-05-18 17:30:46', '2015-05-18 10:30:46'),
(42, 14, 0, 0, 2, NULL, NULL, NULL, NULL, NULL, '2015-05-18 17:35:16', '2015-05-18 10:35:16'),
(43, 14, 0, 0, 2, NULL, NULL, NULL, NULL, NULL, '2015-05-18 17:35:20', '2015-05-18 10:35:20'),
(44, 14, 0, 0, 2, NULL, NULL, NULL, NULL, NULL, '2015-05-18 17:36:53', '2015-05-18 10:36:53'),
(45, 14, 4420400, 0, 2, NULL, NULL, NULL, NULL, NULL, '2015-05-18 17:44:55', '2015-05-18 10:44:55'),
(46, 14, 4420400, 1, 2, NULL, NULL, NULL, NULL, NULL, '2015-05-18 17:52:44', '2015-05-18 10:53:30'),
(47, 14, 1358800, 1, 2, NULL, NULL, NULL, NULL, NULL, '2015-05-19 09:59:35', '2015-05-19 03:00:08'),
(101, 14, 1494680, 0, 2, NULL, NULL, NULL, NULL, NULL, '2015-06-10 17:05:04', '2015-06-10 10:05:04'),
(102, 14, 1494680, 0, 2, NULL, NULL, NULL, NULL, NULL, '2015-06-10 17:06:16', '2015-06-10 10:06:16'),
(103, 14, 1494680, 0, 2, NULL, NULL, NULL, NULL, NULL, '2015-06-10 17:06:38', '2015-06-10 10:06:38'),
(104, 14, 1494680, 0, 2, NULL, NULL, NULL, NULL, NULL, '2015-06-10 17:08:38', '2015-06-10 10:08:38'),
(105, 14, 1494680, 0, 2, NULL, NULL, NULL, NULL, NULL, '2015-06-10 17:08:50', '2015-06-10 10:08:50'),
(106, 14, 1494680, 0, 2, NULL, NULL, NULL, NULL, NULL, '2015-06-10 17:09:06', '2015-06-10 10:09:06'),
(107, 14, 1494680, 0, 2, NULL, NULL, NULL, NULL, NULL, '2015-06-10 17:09:29', '2015-06-10 10:09:29'),
(108, 14, 1494680, 1, 2, NULL, NULL, NULL, NULL, NULL, '2015-06-10 17:14:20', '2015-06-10 10:14:50'),
(109, 14, 2200000, 0, 2, NULL, NULL, NULL, NULL, NULL, '2015-06-11 15:21:25', '2015-06-11 08:21:25'),
(110, 49805, 2200000, 0, 2, NULL, NULL, NULL, NULL, NULL, '2015-06-17 14:40:38', '2015-06-17 07:40:38'),
(111, 49805, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, '2015-06-17 14:40:39', '2015-06-17 07:40:39'),
(112, 49805, 0, 0, 2, NULL, NULL, NULL, NULL, NULL, '2015-06-17 14:40:49', '2015-06-17 07:40:49'),
(113, 49805, 2200000, 0, 2, NULL, NULL, NULL, NULL, NULL, '2015-06-17 14:42:52', '2015-06-17 07:42:52'),
(114, 49805, 2200000, 0, 2, NULL, NULL, NULL, NULL, NULL, '2015-06-17 14:43:18', '2015-06-17 07:43:18'),
(115, 14, 0, 0, 2, NULL, NULL, NULL, NULL, NULL, '2015-06-17 17:19:04', '2015-06-17 10:19:04');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE IF NOT EXISTS `invoice_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_service_id` int(11) NOT NULL,
  `invoice_id` int(20) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `price` double NOT NULL DEFAULT '0',
  `fee` double DEFAULT NULL,
  `countdown` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `expired_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=228 ;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `job_service_id`, `invoice_id`, `quantity`, `price`, `fee`, `countdown`, `status`, `expired_at`, `created_at`, `update_at`) VALUES
(78, 1, 26, 1, 1358800, 135880, 0, 0, '2015-06-07 14:35:17', '2015-05-08 14:35:17', '2015-05-23 04:43:11'),
(79, 2, 26, 1, 670800, 67080, 0, 0, '2015-06-07 14:35:17', '2015-05-08 14:35:17', '2015-05-23 04:43:11'),
(106, 1, 37, 10, 1019100, 101910, 6, 0, '2015-06-12 08:58:14', '2015-05-13 08:58:14', '2015-06-09 09:33:19'),
(107, 2, 37, 10, 503100, 50310, 6, 0, '2015-06-12 08:58:14', '2015-05-13 08:58:14', '2015-06-09 09:33:19'),
(108, 3, 37, 10, 1793100, 179310, 5, 0, '2015-06-12 08:58:14', '2015-05-13 08:58:14', '2015-06-09 09:33:19'),
(109, 20, 37, 6, 1912640, 191264, 6, 0, '2015-11-09 08:58:14', '2015-05-13 08:58:14', '2015-05-14 08:42:22'),
(110, 20, 38, 1, 2390800, 239080, 1, 0, '2015-06-13 16:48:19', '2015-05-14 16:48:19', '2015-05-14 09:48:19'),
(111, 1, 39, 1, 1358800, 0, 1, 0, '2015-05-18 17:30:13', '2015-05-18 17:30:13', '2015-05-18 10:30:13'),
(112, 2, 39, 1, 670800, 0, 1, 0, '2015-05-18 17:30:13', '2015-05-18 17:30:13', '2015-05-18 10:30:13'),
(113, 3, 39, 1, 2390800, 0, 1, 0, '2015-05-18 17:30:13', '2015-05-18 17:30:13', '2015-05-18 10:30:13'),
(114, 7, 39, 1, 2390800, 0, 1, 0, '2015-05-18 17:30:13', '2015-05-18 17:30:13', '2015-05-18 10:30:13'),
(115, 1, 41, 1, 1358800, 0, 1, 0, '2015-05-18 17:30:46', '2015-05-18 17:30:46', '2015-05-18 10:30:46'),
(116, 2, 41, 1, 670800, 0, 1, 0, '2015-05-18 17:30:46', '2015-05-18 17:30:46', '2015-05-18 10:30:46'),
(117, 3, 41, 1, 2390800, 0, 1, 0, '2015-05-18 17:30:46', '2015-05-18 17:30:46', '2015-05-18 10:30:46'),
(118, 1, 45, 1, 1358800, 0, 1, 0, '2015-05-18 17:44:55', '2015-05-18 17:44:55', '2015-05-18 10:44:55'),
(119, 2, 45, 1, 670800, 0, 1, 0, '2015-05-18 17:44:55', '2015-05-18 17:44:55', '2015-05-18 10:44:55'),
(120, 3, 45, 1, 2390800, 0, 1, 0, '2015-05-18 17:44:55', '2015-05-18 17:44:55', '2015-05-18 10:44:55'),
(121, 1, 46, 1, 1358800, 0, 1, 0, '2015-05-18 17:52:44', '2015-05-18 17:52:44', '2015-05-18 10:52:44'),
(122, 2, 46, 1, 670800, 0, 1, 0, '2015-05-18 17:52:44', '2015-05-18 17:52:44', '2015-05-18 10:52:44'),
(123, 3, 46, 1, 2390800, 0, 1, 0, '2015-05-18 17:52:44', '2015-05-18 17:52:44', '2015-05-18 10:52:44'),
(124, 1, 47, 1, 1358800, 0, 0, 0, '2015-06-18 09:59:35', '2015-05-19 09:59:35', '2015-05-19 03:32:17'),
(195, 1, 101, 1, 1358800, 135880, 1, 0, '2015-07-10 17:05:05', '2015-06-10 17:05:05', '2015-06-10 10:05:05'),
(196, 1, 102, 1, 1358800, 135880, 1, 0, '2015-07-10 17:06:16', '2015-06-10 17:06:16', '2015-06-10 10:06:16'),
(197, 1, 103, 1, 1358800, 135880, 1, 0, '2015-07-10 17:06:38', '2015-06-10 17:06:38', '2015-06-10 10:06:38'),
(198, 1, 104, 1, 1358800, 135880, 1, 0, '2015-07-10 17:08:38', '2015-06-10 17:08:38', '2015-06-10 10:08:38'),
(199, 1, 105, 1, 1358800, 135880, 1, 0, '2015-07-10 17:08:50', '2015-06-10 17:08:50', '2015-06-10 10:08:50'),
(200, 1, 106, 1, 1358800, 135880, 1, 0, '2015-07-10 17:09:06', '2015-06-10 17:09:06', '2015-06-10 10:09:06'),
(201, 1, 107, 1, 1358800, 135880, 1, 0, '2015-07-10 17:09:29', '2015-06-10 17:09:29', '2015-06-10 10:09:29'),
(202, 1, 108, 1, 1358800, 135880, 0, 0, '2015-07-10 17:14:20', '2015-06-10 17:14:20', '2015-06-10 10:14:52'),
(203, 1, 109, 1, 0, 0, 1, 0, '2015-07-11 15:21:25', '2015-06-11 15:21:25', '2015-06-11 08:21:25'),
(204, 3, 109, 1, 0, 0, 1, 0, '2015-07-11 15:21:25', '2015-06-11 15:21:25', '2015-06-11 08:21:25'),
(205, 4, 109, 1, 0, 0, 1, 0, '2015-07-11 15:21:25', '2015-06-11 15:21:25', '2015-06-11 08:21:25'),
(206, 5, 109, 1, 500000, 50000, 1, 0, '2015-07-11 15:21:25', '2015-06-11 15:21:25', '2015-06-11 08:21:25'),
(207, 6, 109, 1, 500000, 50000, 1, 0, '2015-07-11 15:21:25', '2015-06-11 15:21:25', '2015-06-11 08:21:25'),
(208, 7, 109, 1, 1000000, 100000, 1, 0, '2015-07-11 15:21:25', '2015-06-11 15:21:25', '2015-06-11 08:21:25'),
(210, 1, 110, 1, 0, 0, 1, 0, '2015-07-17 14:40:38', '2015-06-17 14:40:38', '2015-06-17 07:40:38'),
(211, 3, 110, 1, 0, 0, 1, 0, '2015-07-17 14:40:38', '2015-06-17 14:40:38', '2015-06-17 07:40:38'),
(212, 4, 110, 1, 0, 0, 1, 0, '2015-07-17 14:40:38', '2015-06-17 14:40:38', '2015-06-17 07:40:38'),
(213, 5, 110, 1, 500000, 50000, 1, 0, '2015-07-17 14:40:38', '2015-06-17 14:40:38', '2015-06-17 07:40:38'),
(214, 6, 110, 1, 500000, 50000, 1, 0, '2015-07-17 14:40:39', '2015-06-17 14:40:39', '2015-06-17 07:40:39'),
(215, 7, 110, 1, 1000000, 100000, 1, 0, '2015-07-17 14:40:39', '2015-06-17 14:40:39', '2015-06-17 07:40:39'),
(216, 1, 113, 1, 0, 0, 1, 0, '2015-07-17 14:42:52', '2015-06-17 14:42:52', '2015-06-17 07:42:52'),
(217, 3, 113, 1, 0, 0, 1, 0, '2015-07-17 14:42:52', '2015-06-17 14:42:52', '2015-06-17 07:42:52'),
(218, 4, 113, 1, 0, 0, 1, 0, '2015-07-17 14:42:52', '2015-06-17 14:42:52', '2015-06-17 07:42:52'),
(219, 5, 113, 1, 500000, 50000, 1, 0, '2015-07-17 14:42:52', '2015-06-17 14:42:52', '2015-06-17 07:42:52'),
(220, 6, 113, 1, 500000, 50000, 1, 0, '2015-07-17 14:42:52', '2015-06-17 14:42:52', '2015-06-17 07:42:52'),
(221, 7, 113, 1, 1000000, 100000, 1, 0, '2015-07-17 14:42:52', '2015-06-17 14:42:52', '2015-06-17 07:42:52'),
(222, 1, 114, 1, 0, 0, 1, 0, '2015-07-17 14:43:18', '2015-06-17 14:43:18', '2015-06-17 07:43:18'),
(223, 3, 114, 1, 0, 0, 1, 0, '2015-07-17 14:43:18', '2015-06-17 14:43:18', '2015-06-17 07:43:18'),
(224, 4, 114, 1, 0, 0, 1, 0, '2015-07-17 14:43:19', '2015-06-17 14:43:19', '2015-06-17 07:43:19'),
(225, 5, 114, 1, 500000, 50000, 1, 0, '2015-07-17 14:43:19', '2015-06-17 14:43:19', '2015-06-17 07:43:19'),
(226, 6, 114, 1, 500000, 50000, 1, 0, '2015-07-17 14:43:19', '2015-06-17 14:43:19', '2015-06-17 07:43:19'),
(227, 7, 114, 1, 1000000, 100000, 1, 0, '2015-07-17 14:43:19', '2015-06-17 14:43:19', '2015-06-17 07:43:19');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category_ids` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city_ids` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `education_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` tinyint(1) NOT NULL DEFAULT '0',
  `fromage` int(4) NOT NULL,
  `toage` int(11) NOT NULL,
  `year_exp` int(255) NOT NULL,
  `qty` int(5) NOT NULL,
  `salary` int(11) NOT NULL,
  `salary_min` double NOT NULL,
  `salary_max` double NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `experience_skill` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) DEFAULT '0' COMMENT '1;open; 0: inprocess; 2: close;',
  `date_expiration` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `favourites` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `idJobOther` int(11) NOT NULL,
  `type_contact` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `email_contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `people_contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_contact` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `language_contact` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1 : craw',
  `hide_infomation` int(11) NOT NULL COMMENT '0: show, 1:hide',
  `submission` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `user_id`, `category_ids`, `city_ids`, `education_id`, `type_id`, `level_id`, `country_id`, `title`, `alias`, `gender`, `fromage`, `toage`, `year_exp`, `qty`, `salary`, `salary_min`, `salary_max`, `description`, `experience_skill`, `status`, `date_expiration`, `date_created`, `update_at`, `favourites`, `views`, `idJobOther`, `type_contact`, `email_contact`, `name_contact`, `address_contact`, `people_contact`, `phone_contact`, `language_contact`, `is_deleted`, `type`, `hide_infomation`, `submission`) VALUES
(1, 55, '1,21,22', '27,28,30,31', 3, 1, 2, 0, 'Nhân Viên Kinh Doanh ( Tuyển Gấp )', 'Nhan-Vien-Kinh-Doanh--Tuyen-Gap', 1, 26, 0, 5, 4, 5, 0, 0, '<p>- T&igrave;m kiếm v&agrave; ph&aacute;t triển th&ocirc;ng tin về c&aacute;c đối tượng kh&aacute;ch h&agrave;ng mục ti&ecirc;u.</p><p>- Tư vấn, gặp gỡ . thuyết phục kh&aacute;ch h&agrave;ng sử dụng c&aacute;c sản phẩm, dịch vụ của c&ocirc;ng ty.</p><p>- Ph&aacute;t triển c&aacute;c &yacute; tưởng v&agrave; phương &aacute;n kinh doanh, chăm s&oacute;c, tạo mối quan hệ bền vững với kh&aacute;ch h&agrave;ng.</p><p>- Ho&agrave;n th&agrave;nh chỉ ti&ecirc;u kinh doanh</p><p>- Theo d&otilde;i c&aacute;c xu hướng của thị trường v&agrave; th&ocirc;ng tin về đối thủ cạnh tranh.</p><p>- X&acirc;y dựng cơ sở dữ liệu kh&aacute;ch h&agrave;ng, cập nhật v&agrave; lưu trữ.</p><p>- Phối hợp c&ugrave;ng trưởng nh&oacute;m kinh doanh v&agrave; đội ngũ kỹ thuật.</p><p><strong>* Quyền lợi:</strong></p><p>- Mức lương+ hoa hồng ph&ugrave; hợp theo năng lực ( kh&ocirc;ng giới hạn)</p><p>- Chế độ ph&uacute;c lợi x&atilde; hội theo quy định</p><p>- C&aacute;c chế độ thưởng v&agrave; trợ cấp kh&aacute;c theo quy định của c&ocirc;ng ty</p><p>- L&agrave;m việc trong m&ocirc;i trường năng động v&agrave; khả năng thăng tiến cao</p>', '<p><strong>- Ưu ti&ecirc;n Nữ</strong></p><p>- Ưu ti&ecirc;n ứng vi&ecirc;n đ&atilde; c&oacute; kinh nghiệm l&agrave;m việc li&ecirc;n quan đến kinh doanh b&aacute;n h&agrave;ng</p><p>- Tốt nghiệp Cao đẳng/ Đại học c&aacute;c khối Kinh tế kỹ thuật</p><p>- Năng động, nhiệt t&igrave;nh trong c&ocirc;ng việc</p><p>- Y&ecirc;u th&iacute;ch v&agrave; đam m&ecirc; c&ocirc;ng việc Kinh doanh</p><p>- Kỹ năng l&agrave;m việc độc lập v&agrave; l&agrave;m việc nh&oacute;m tốt</p><p>- Kỹ năng thuyết phục, đ&agrave;m ph&aacute;n cao</p>', 1, '2015-11-04 21:05:28', '2015-10-05 21:05:28', '2015-11-22 14:45:12', 0, 60, 0, '1', 'ithtan559@gmail.com', 'Huynh Thai An', '180-192 Nguyễn Công Trứ, Phường Nguyễn Thái Bình , Quận 1 , Lầu 10 Toà Nhà Maritime Bank', '0', '0916624099', 3, 0, 0, 1, ''),
(2, 55, '1,21,22', '27,28,30,31', 3, 1, 2, 0, 'Nhân Viên Kinh Doanh ( Tuyển Gấp ) Copy', 'Nhan-Vien-Kinh-Doanh--Tuyen-Gap-copy', 1, 26, 0, 5, 4, 5, 0, 0, '<p>- T&igrave;m kiếm v&agrave; ph&aacute;t triển th&ocirc;ng tin về c&aacute;c đối tượng kh&aacute;ch h&agrave;ng mục ti&ecirc;u.</p><p>- Tư vấn, gặp gỡ . thuyết phục kh&aacute;ch h&agrave;ng sử dụng c&aacute;c sản phẩm, dịch vụ của c&ocirc;ng ty.</p><p>- Ph&aacute;t triển c&aacute;c &yacute; tưởng v&agrave; phương &aacute;n kinh doanh, chăm s&oacute;c, tạo mối quan hệ bền vững với kh&aacute;ch h&agrave;ng.</p><p>- Ho&agrave;n th&agrave;nh chỉ ti&ecirc;u kinh doanh</p><p>- Theo d&otilde;i c&aacute;c xu hướng của thị trường v&agrave; th&ocirc;ng tin về đối thủ cạnh tranh.</p><p>- X&acirc;y dựng cơ sở dữ liệu kh&aacute;ch h&agrave;ng, cập nhật v&agrave; lưu trữ.</p><p>- Phối hợp c&ugrave;ng trưởng nh&oacute;m kinh doanh v&agrave; đội ngũ kỹ thuật.</p><p><strong>* Quyền lợi:</strong></p><p>- Mức lương+ hoa hồng ph&ugrave; hợp theo năng lực ( kh&ocirc;ng giới hạn)</p><p>- Chế độ ph&uacute;c lợi x&atilde; hội theo quy định</p><p>- C&aacute;c chế độ thưởng v&agrave; trợ cấp kh&aacute;c theo quy định của c&ocirc;ng ty</p><p>- L&agrave;m việc trong m&ocirc;i trường năng động v&agrave; khả năng thăng tiến cao</p>', '<p><strong>- Ưu ti&ecirc;n Nữ</strong></p><p>- Ưu ti&ecirc;n ứng vi&ecirc;n đ&atilde; c&oacute; kinh nghiệm l&agrave;m việc li&ecirc;n quan đến kinh doanh b&aacute;n h&agrave;ng</p><p>- Tốt nghiệp Cao đẳng/ Đại học c&aacute;c khối Kinh tế kỹ thuật</p><p>- Năng động, nhiệt t&igrave;nh trong c&ocirc;ng việc</p><p>- Y&ecirc;u th&iacute;ch v&agrave; đam m&ecirc; c&ocirc;ng việc Kinh doanh</p><p>- Kỹ năng l&agrave;m việc độc lập v&agrave; l&agrave;m việc nh&oacute;m tốt</p><p>- Kỹ năng thuyết phục, đ&agrave;m ph&aacute;n cao</p>', 1, '2015-11-04 21:05:28', '2015-10-05 21:05:28', '2015-11-04 17:33:46', 0, 39, 0, '1', 'ithtan559@gmail.com', 'Huynh Thai An', '180-192 Nguyễn Công Trứ, Phường Nguyễn Thái Bình , Quận 1 , Lầu 10 Toà Nhà Maritime Bank', '0', '0916624099', 3, 0, 0, 1, ''),
(3, 55, '10,11,12,13', '27,28,30', 3, 3, 3, 0, 'Nhân Viên Hỗ Trợ Kinh Doanh - Toàn Quốc', 'Nhan-Vien-Ho-Tro-Kinh-Doanh---Toan-Quoc', 3, 24, 27, 1, 1, 7, 0, 0, '<p>- Chủ động tiếp x&uacute;c kh&aacute;ch h&agrave;ng, giới thiệu sản phẩm t&agrave;i ch&iacute;nh của Home Credit đến cho kh&aacute;ch h&agrave;ng v&agrave; đại l&yacute;.<br />- Hướng dẫn kh&aacute;ch h&agrave;ng ho&agrave;n tất hồ sơ về sản phẩm t&agrave;i ch&iacute;nh ti&ecirc;u d&ugrave;ng.<br />- Phối hợp với c&aacute;c bộ phận để giải quyết khiếu nại của kh&aacute;ch h&agrave;ng một c&aacute;ch nhanh ch&oacute;ng.<br />- Theo d&otilde;i b&aacute;o c&aacute;o c&ocirc;ng nợ, tổng hợp v&agrave; b&aacute;o c&aacute;o kết quả thực hiện h&agrave;ng ng&agrave;y của c&aacute; nh&acirc;n cho Quản l&yacute; Kinh Doanh Khu vực.<br />- Ho&agrave;n th&agrave;nh chỉ ti&ecirc;u kinh doanh tối thiểu theo y&ecirc;u cầu của C&ocirc;ng ty tại từng thời điểm.<br />- Thực hiện v&agrave; ho&agrave;n th&agrave;nh tốt c&aacute;c c&ocirc;ng việc được giao kh&aacute;c theo y&ecirc;u cầu của ph&ograve;ng kinh doanh v&agrave; c&aacute;c cấp quản l&yacute;.</p>', '<p>- Tốt nghiệp Trung học phổ th&ocirc;ng trở l&ecirc;n<br />- Ưu ti&ecirc;n nam/nữ ngoại h&igrave;nh dễ nh&igrave;n<br />- C&oacute; kiến thức về b&aacute;n h&agrave;ng v&agrave; chăm s&oacute;c kh&aacute;ch h&agrave;ng<br />- Tự tin, năng động, th&iacute;ch giao tiếp, có khả năng l&agrave;m việc nh&oacute;m.<br />- Y&ecirc;u th&iacute;ch c&ocirc;ng việc kinh doanh, c&oacute; định hướng ph&aacute;t triển thu nhập<br />- Kỹ năng vi t&iacute;nh cơ bản</p>', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1, 0, '1', 'ithtan558@gmail.com', 'Huynh Thai An', '180-192 Nguyễn Công Trứ, Phường Nguyễn Thái Bình , Quận 1 , Lầu 10 Toà Nhà Maritime Bank', '0', '0916624099', 3, 0, 0, 0, ''),
(4, 55, '10,11,12', '27,28,30', 6, 5, 4, 0, 'Nhân Viên Kinh Doanh Xe Đạp Điện- Đi Làm Ngay', 'Nhan-Vien-Kinh-Doanh-Xe-Dap-Dien--Di-Lam-Ngay', 3, 33, 36, 3, 4, 4, 0, 0, '<p>- T&igrave;m kiếm, tiếp cận kh&aacute;ch h&agrave;ng mới, chăm s&oacute;c kh&aacute;ch h&agrave;ng cũ<br />- Quản l&yacute; h&agrave;ng h&oacute;a hệ thống đại l&yacute; của c&ocirc;ng ty<br />- Hỗ trợ việc b&aacute;n h&agrave;ng online của c&ocirc;ng ty<br />- Chi tiết sẽ trao đổi th&ecirc;m khi phỏng vấn</p>', '<p>- T&igrave;m kiếm, tiếp cận kh&aacute;ch h&agrave;ng mới, chăm s&oacute;c kh&aacute;ch h&agrave;ng cũ<br />- Quản l&yacute; h&agrave;ng h&oacute;a hệ thống đại l&yacute; của c&ocirc;ng ty<br />- Hỗ trợ việc b&aacute;n h&agrave;ng online của c&ocirc;ng ty<br />- Chi tiết sẽ trao đổi th&ecirc;m khi phỏng vấn</p>', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1, 0, '1', 'ithtan558@gmail.com', 'Huynh Thai An', '180-192 Nguyễn Công Trứ, Phường Nguyễn Thái Bình , Quận 1 , Lầu 10 Toà Nhà Maritime Bank', '0', '0916624099', 3, 0, 0, 0, '<p>- T&igrave;m kiếm, tiếp cận kh&aacute;ch h&agrave;ng mới, chăm s&oacute;c kh&aacute;ch h&agrave;ng cũ<br />- Quản l&yacute; h&agrave;ng h&oacute;a hệ thống đại l&yacute; của c&ocirc;ng ty<br />- Hỗ trợ việc b&aacute;n h&agrave;ng online của c&ocirc;ng ty<br />- Chi tiết sẽ trao đổi th&ecirc;m khi phỏng vấn</p>'),
(5, 55, '12', '27,28,30', 6, 5, 4, 182, 'Nhân Viên Kinh Doanh Xe Đạp Điện- Đi Làm Ngay1', 'Nhan-Vien-Kinh-Doanh-Xe-Dap-Dien--Di-Lam-Ngay1', 3, 33, 36, 3, 4, 4, 0, 0, '<p>- T&igrave;m kiếm, tiếp cận kh&aacute;ch h&agrave;ng mới, chăm s&oacute;c kh&aacute;ch h&agrave;ng cũ<br />- Quản l&yacute; h&agrave;ng h&oacute;a hệ thống đại l&yacute; của c&ocirc;ng ty<br />- Hỗ trợ việc b&aacute;n h&agrave;ng online của c&ocirc;ng ty<br />- Chi tiết sẽ trao đổi th&ecirc;m khi phỏng vấn</p>', '<p>- T&igrave;m kiếm, tiếp cận kh&aacute;ch h&agrave;ng mới, chăm s&oacute;c kh&aacute;ch h&agrave;ng cũ<br />- Quản l&yacute; h&agrave;ng h&oacute;a hệ thống đại l&yacute; của c&ocirc;ng ty<br />- Hỗ trợ việc b&aacute;n h&agrave;ng online của c&ocirc;ng ty<br />- Chi tiết sẽ trao đổi th&ecirc;m khi phỏng vấn</p>', 1, '2015-12-12 16:53:50', '2015-11-12 16:53:50', '2015-11-12 09:53:50', 0, 1, 0, '1', 'ithtan558@gmail.com', 'Huynh Thai An', '180-192 Nguyễn Công Trứ, Phường Nguyễn Thái Bình , Quận 1 , Lầu 10 Toà Nhà Maritime Bank', '0', '0916624099', 3, 0, 0, 0, '<p>- T&igrave;m kiếm, tiếp cận kh&aacute;ch h&agrave;ng mới, chăm s&oacute;c kh&aacute;ch h&agrave;ng cũ<br />- Quản l&yacute; h&agrave;ng h&oacute;a hệ thống đại l&yacute; của c&ocirc;ng ty<br />- Hỗ trợ việc b&aacute;n h&agrave;ng online của c&ocirc;ng ty<br />- Chi tiết sẽ trao đổi th&ecirc;m khi phỏng vấn1</p>'),
(6, 55, '10,11,12', '27,28,30', 6, 5, 4, 0, 'Nhân Viên Kinh Doanh Xe Đạp Điện- Đi Làm Ngay', 'Nhan-Vien-Kinh-Doanh-Xe-Dap-Dien--Di-Lam-Ngay', 3, 33, 36, 3, 4, 4, 0, 0, '<p>- T&igrave;m kiếm, tiếp cận kh&aacute;ch h&agrave;ng mới, chăm s&oacute;c kh&aacute;ch h&agrave;ng cũ<br />- Quản l&yacute; h&agrave;ng h&oacute;a hệ thống đại l&yacute; của c&ocirc;ng ty<br />- Hỗ trợ việc b&aacute;n h&agrave;ng online của c&ocirc;ng ty<br />- Chi tiết sẽ trao đổi th&ecirc;m khi phỏng vấn</p>', '<p>- T&igrave;m kiếm, tiếp cận kh&aacute;ch h&agrave;ng mới, chăm s&oacute;c kh&aacute;ch h&agrave;ng cũ<br />- Quản l&yacute; h&agrave;ng h&oacute;a hệ thống đại l&yacute; của c&ocirc;ng ty<br />- Hỗ trợ việc b&aacute;n h&agrave;ng online của c&ocirc;ng ty<br />- Chi tiết sẽ trao đổi th&ecirc;m khi phỏng vấn</p>', 1, '2015-12-08 19:57:38', '2015-11-08 19:57:38', '2015-11-08 12:57:38', 0, 1, 0, '1', 'ithtan558@gmail.com', 'Huynh Thai An', '180-192 Nguyễn Công Trứ, Phường Nguyễn Thái Bình , Quận 1 , Lầu 10 Toà Nhà Maritime Bank', '0', '0916624099', 3, 0, 0, 0, '<p>- T&igrave;m kiếm, tiếp cận kh&aacute;ch h&agrave;ng mới, chăm s&oacute;c kh&aacute;ch h&agrave;ng cũ<br />- Quản l&yacute; h&agrave;ng h&oacute;a hệ thống đại l&yacute; của c&ocirc;ng ty<br />- Hỗ trợ việc b&aacute;n h&agrave;ng online của c&ocirc;ng ty<br />- Chi tiết sẽ trao đổi th&ecirc;m khi phỏng vấn</p>'),
(7, 55, '10,11', '27,28', 4, 6, 3, 0, 'Nhân Viên Hỗ Trợ Kinh Doanh - Toàn Quốc', 'Nhan-Vien-Ho-Tro-Kinh-Doanh---Toan-Quoc', 1, 22, 26, 0, 1, 9, 0, 0, '<p>dfafdsafdsa dsafdsafds a</p>', '<p>fdsa fdsafd</p>', 1, '2015-12-08 20:00:05', '2015-11-08 20:00:05', '2015-11-08 13:03:36', 0, 2, 0, '2', '312', '213', '2', '0', '321', 3, 0, 0, 0, ''),
(8, 55, '10,11', '27,28,30', 4, 3, 2, 0, 'Node.js and MongoDB are a pair made for each other', 'Nodejs-and-MongoDB-are-a-pair-made-for-each-other', 3, 21, 28, 4, 123, 2, 0, 0, '<p>dsafdsaf safd safdsa fdsaf dsa</p>', '<p>fdsafdsafds afds afdsa</p>', 1, '2015-12-09 17:25:04', '2015-11-09 17:25:04', '2015-11-22 14:47:36', 0, 2, 0, '2', 'fdsa', 'fds', 'fdsa', '0', 'dsafdsa', 3, 0, 0, 0, '<p>&nbsp;fdsaf dsaf dsa fdsa fdsaf dsafsda fdsa fds</p>'),
(9, 55, '10,11', '27,28,30', 4, 3, 2, 0, 'Node.js and MongoDB are a pair made for each other', 'Nodejs-and-MongoDB-are-a-pair-made-for-each-other', 3, 21, 28, 4, 123, 2, 0, 0, '<p>dsafdsaf safd safdsa fdsaf dsa</p>', '<p>fdsafdsafds afds afdsa</p>', 1, '2015-12-09 17:27:21', '2015-11-09 17:27:21', '2015-11-09 10:27:21', 0, 1, 0, '2', 'fdsa', 'fds', 'fdsa', '0', 'dsafdsa', 3, 0, 0, 0, '<p>&nbsp;fdsaf dsaf dsa fdsa fdsaf dsafsda fdsa fds</p>'),
(10, 55, '10,11', '27,28,30', 4, 3, 2, 0, 'Node.js and MongoDB are a pair made for each other', 'Nodejs-and-MongoDB-are-a-pair-made-for-each-other', 3, 21, 28, 4, 123, 2, 0, 0, '<p>dsafdsaf safd safdsa fdsaf dsa</p>', '<p>fdsafdsafds afds afdsa</p>', 1, '2015-12-09 17:27:54', '2015-11-09 17:27:54', '2015-11-09 10:27:54', 0, 1, 0, '2', 'fdsa', 'fds', 'fdsa', '0', 'dsafdsa', 3, 0, 0, 0, '<p>&nbsp;fdsaf dsaf dsa fdsa fdsaf dsafsda fdsa fds</p>'),
(11, 55, '10,11', '27,28,30', 4, 3, 2, 0, 'Node.js and MongoDB are a pair made for each other', 'Nodejs-and-MongoDB-are-a-pair-made-for-each-other', 3, 21, 28, 4, 123, 2, 0, 0, '<p>dsafdsaf safd safdsa fdsaf dsa</p>', '<p>fdsafdsafds afds afdsa</p>', 1, '2015-12-09 17:29:25', '2015-11-09 17:29:25', '2015-11-09 10:29:25', 0, 1, 0, '2', 'fdsa', 'fds', 'fdsa', '0', 'dsafdsa', 3, 0, 0, 0, '<p>&nbsp;fdsaf dsaf dsa fdsa fdsaf dsafsda fdsa fds</p>'),
(12, 55, '10,11', '27,28,30', 4, 3, 2, 0, 'Node.js and MongoDB are a pair made for each other', 'Nodejs-and-MongoDB-are-a-pair-made-for-each-other', 3, 21, 28, 4, 123, 2, 0, 0, '<p>dsafdsaf safd safdsa fdsaf dsa</p>', '<p>fdsafdsafds afds afdsa</p>', 1, '2015-12-09 17:29:51', '2015-11-09 17:29:51', '2015-11-09 10:29:51', 0, 1, 0, '2', 'fdsa', 'fds', 'fdsa', '0', 'dsafdsa', 3, 0, 0, 0, '<p>&nbsp;fdsaf dsaf dsa fdsa fdsaf dsafsda fdsa fds</p>'),
(13, 55, '10,11', '27,28,30', 4, 3, 2, 0, 'Node.js and MongoDB are a pair made for each other', 'Nodejs-and-MongoDB-are-a-pair-made-for-each-other', 3, 21, 28, 4, 123, 2, 0, 0, '<p>dsafdsaf safd safdsa fdsaf dsa</p>', '<p>fdsafdsafds afds afdsa</p>', 1, '2015-12-09 17:30:28', '2015-11-09 17:30:28', '2015-11-09 10:30:28', 0, 1, 0, '2', 'fdsa', 'fds', 'fdsa', '0', 'dsafdsa', 3, 0, 0, 0, '<p>&nbsp;fdsaf dsaf dsa fdsa fdsaf dsafsda fdsa fds</p>'),
(14, 55, '10,11', '27,28,30', 4, 3, 2, 0, 'Node.js and MongoDB are a pair made for each other', 'Nodejs-and-MongoDB-are-a-pair-made-for-each-other', 3, 21, 28, 4, 123, 2, 0, 0, '<p>dsafdsaf safd safdsa fdsaf dsa</p>', '<p>fdsafdsafds afds afdsa</p>', 1, '2015-12-09 17:30:48', '2015-11-09 17:30:48', '2015-11-09 10:30:48', 0, 1, 0, '2', 'fdsa', 'fds', 'fdsa', '0', 'dsafdsa', 3, 0, 0, 0, '<p>&nbsp;fdsaf dsaf dsa fdsa fdsaf dsafsda fdsa fds</p>'),
(15, 55, '10,11', '27,28,30', 4, 3, 2, 0, 'Node.js and MongoDB are a pair made for each other', 'Nodejs-and-MongoDB-are-a-pair-made-for-each-other', 3, 21, 28, 4, 123, 2, 0, 0, '<p>dsafdsaf safd safdsa fdsaf dsa</p>', '<p>fdsafdsafds afds afdsa</p>', 1, '2015-12-09 17:31:00', '2015-11-09 17:31:00', '2015-11-09 10:31:00', 0, 1, 0, '2', 'fdsa', 'fds', 'fdsa', '0', 'dsafdsa', 3, 0, 0, 0, '<p>&nbsp;fdsaf dsaf dsa fdsa fdsaf dsafsda fdsa fds</p>'),
(16, 55, '10,11', '27,28,30', 4, 3, 2, 0, 'Node.js and MongoDB are a pair made for each other', 'Nodejs-and-MongoDB-are-a-pair-made-for-each-other', 3, 21, 28, 4, 123, 2, 0, 0, '<p>dsafdsaf safd safdsa fdsaf dsa</p>', '<p>fdsafdsafds afds afdsa</p>', 1, '2015-12-09 17:32:09', '2015-11-09 17:32:09', '2015-11-09 10:32:09', 0, 1, 0, '2', 'fdsa', 'fds', 'fdsa', '0', 'dsafdsa', 3, 0, 0, 0, '<p>&nbsp;fdsaf dsaf dsa fdsa fdsaf dsafsda fdsa fds</p>'),
(17, 55, '10,11', '27,28,30', 4, 3, 2, 0, 'Node.js and MongoDB are a pair made for each other', 'Nodejs-and-MongoDB-are-a-pair-made-for-each-other', 3, 21, 28, 4, 123, 2, 0, 0, '<p>dsafdsaf safd safdsa fdsaf dsa</p>', '<p>fdsafdsafds afds afdsa</p>', 1, '2015-12-09 17:32:33', '2015-11-09 17:32:33', '2015-11-10 08:34:09', 0, 2, 0, '2', 'fdsa', 'fds', 'fdsa', '0', 'dsafdsa', 3, 0, 0, 0, '<p>&nbsp;fdsaf dsaf dsa fdsa fdsaf dsafsda fdsa fds</p>'),
(18, 55, '10,11', '27,28,30', 4, 3, 2, 0, 'Node.js and MongoDB are a pair made for each other', 'Nodejs-and-MongoDB-are-a-pair-made-for-each-other', 3, 21, 28, 4, 123, 2, 0, 0, '<p>dsafdsaf safd safdsa fdsaf dsa</p>', '<p>fdsafdsafds afds afdsa</p>', 1, '2015-12-09 17:35:24', '2015-11-09 17:35:24', '2015-11-23 10:10:37', 0, 20, 0, '2', 'fdsa', 'fds', 'fdsa', '0', 'dsafdsa', 3, 0, 0, 0, '<p>&nbsp;fdsaf dsaf dsa fdsa fdsaf dsafsda fdsa fds</p>');

-- --------------------------------------------------------

--
-- Table structure for table `job_apply`
--

CREATE TABLE IF NOT EXISTS `job_apply` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `worker_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `cv` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_resume` int(11) DEFAULT NULL COMMENT '1:onlineCV, 2:uploadCV',
  `resume_id` int(11) DEFAULT NULL,
  `introtext` text COLLATE utf8_unicode_ci,
  `app_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `app_company` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `app_location` int(11) DEFAULT NULL,
  `app_phone` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0' COMMENT '0: apply; 1: accept; 2: deny',
  `date_created` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `job_favourites`
--

CREATE TABLE IF NOT EXISTS `job_favourites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `values` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `job_feed`
--

CREATE TABLE IF NOT EXISTS `job_feed` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `job_id` int(10) NOT NULL DEFAULT '0',
  `job_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `job_alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `job_categories` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `job_categories_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `salary_min` int(11) NOT NULL DEFAULT '0',
  `salary_max` int(10) NOT NULL DEFAULT '0',
  `user_id` int(10) NOT NULL DEFAULT '0',
  `created` int(13) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `is_sendmail` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `job_feed`
--

INSERT INTO `job_feed` (`id`, `job_id`, `job_name`, `job_alias`, `job_categories`, `job_categories_name`, `salary_min`, `salary_max`, `user_id`, `created`, `status`, `is_sendmail`) VALUES
(1, 91, 'Web & SEO Developer test', 'Web--SEO-Developer-test', '12,13,14', 'Agile, CSS, ', 0, 0, 49694, 1433842399, 1, 0),
(2, 92, 'PHP Developer test', 'PHP-Developer-test', '13,16', 'CSS, HTML5', 0, 0, 49694, 1433931292, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `job_languages`
--

CREATE TABLE IF NOT EXISTS `job_languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `language_level_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `job_languages`
--

INSERT INTO `job_languages` (`id`, `job_id`, `language_id`, `language_level_id`, `status`, `date_created`) VALUES
(1, 309, 3, 5, 0, 0),
(2, 310, 3, 5, 0, 0),
(3, 311, 3, 5, 0, 0),
(4, 312, 3, 5, 0, 0),
(5, 313, 3, 6, 0, 0),
(6, 313, 4, 7, 0, 0),
(7, 1, 3, 5, 0, 0),
(8, 1, 4, 7, 0, 0),
(9, 1, 5, 5, 0, 0),
(10, 3, 4, 5, 0, 0),
(11, 4, 16, 6, 0, 0),
(13, 6, 16, 6, 0, 0),
(14, 7, 6, 7, 0, 0),
(15, 8, 11, 6, 0, 0),
(16, 9, 11, 6, 0, 0),
(17, 10, 11, 6, 0, 0),
(18, 11, 11, 6, 0, 0),
(19, 12, 11, 6, 0, 0),
(20, 13, 11, 6, 0, 0),
(21, 14, 11, 6, 0, 0),
(22, 15, 11, 6, 0, 0),
(23, 16, 11, 6, 0, 0),
(24, 17, 11, 6, 0, 0),
(25, 18, 11, 6, 0, 0),
(29, 5, 16, 6, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `job_packages`
--

CREATE TABLE IF NOT EXISTS `job_packages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `package_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `status` tinyint(1) DEFAULT '0',
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `job_packages`
--

INSERT INTO `job_packages` (`id`, `package_name`, `description`, `status`, `date_created`) VALUES
(1, 'FREE', 'Đăng tuyển trên web tuyển dụng số #1 tại Việt Nam', 0, '2015-06-11 03:32:36'),
(2, 'BASIC', 'Gia Tăng Tô Đậm & Đỏ để thu hút sự chú ý của ứng viên', 0, '2015-06-11 03:32:52'),
(3, 'MAXIMUM REACH', 'Gợi ý developer sẵn sàng nhận việc và Gia Tăng Tô Đậm & Đỏ giúp tạo sự khác biệt khi hiển thị tại đầu trang kết quả tìm kiếm.', 0, '2015-06-11 03:33:23');

-- --------------------------------------------------------

--
-- Table structure for table `job_services`
--

CREATE TABLE IF NOT EXISTS `job_services` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `package_ids` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `items` text,
  `description` varchar(255) DEFAULT NULL,
  `type` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `job_services`
--

INSERT INTO `job_services` (`id`, `parent_id`, `package_ids`, `title`, `price`, `items`, `description`, `type`, `status`, `date_created`) VALUES
(1, 0, '1,2,3', '30 ngày đăng tuyển dụng', 0, '[{"qty":1,"promotion":0},{"qty":2,"promotion":10},{"qty":3,"promotion":15},{"qty":5,"promotion":20},{"qty":10,"promotion":30}]', NULL, 0, 0, '2015-06-17 08:38:42'),
(3, 1, '1,2,3', 'Hiển thị tin tuyển dụng tại TopDev', 0, NULL, NULL, 0, 0, '2015-06-11 04:31:15'),
(4, 1, '1,2,3', 'Theo dõi lượt xem tin tuyển dụng\r', 0, NULL, NULL, 0, 0, '2015-06-11 04:31:14'),
(5, 1, '2,3', 'Gia Tăng Tô Đậm & Đỏ tại TopDev\r', 500000, NULL, NULL, 0, 0, '2015-06-11 04:12:36'),
(6, 1, '2,3', 'Gợi ý devloper sẵn sàng nhận việc.', 500000, NULL, NULL, 0, 0, '2015-06-11 04:12:37'),
(7, 1, '2,3', 'Hiển thị tin đăng tuyển trên các partner. \r\n\r\n', 1000000, NULL, NULL, 0, 0, '2015-06-11 04:12:43'),
(8, 1, '3', 'Gia Tăng Tô Đậm & Đỏ tại partner.', 1000000, NULL, NULL, 0, 0, '2015-06-11 04:12:46'),
(9, 1, '3', 'Email, SMS, Push Notification tin tuyển dụng đến tất cả ứng viên phù hợp. ', 1000000, NULL, NULL, 0, 0, '2015-06-11 04:12:48'),
(10, 1, NULL, 'Làm Mới Thông Tin Đăng Tuyển', 1000000, NULL, 'sẽ đặt công việc của bạn trở lên đầu trang, nơi thu hút các ứng viên một cách dễ dàng.', 2, 0, '2015-06-11 04:12:53'),
(11, 1, NULL, 'Nhân Đôi Làm Mới Tin Tuyển Dụng ', 1000000, NULL, 'sẽ tự động làm mới tin tuyển dụng của bạn HAI LẦN, nhằm tối đa hóa việc thu hút các ứng viên tốt nhất.', 2, 0, '2015-06-11 04:12:55'),
(20, 0, NULL, 'Xem Hồ Sơ', 1500000, '[{"qty":1,"promotion":0},{"qty":3,"promotion":15},{"qty":6,"promotion":20},{"qty":12,"promotion":30}]', NULL, 1, 0, '2015-06-17 08:32:31');

-- --------------------------------------------------------

--
-- Table structure for table `job_service_extension`
--

CREATE TABLE IF NOT EXISTS `job_service_extension` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `job_id` int(11) NOT NULL DEFAULT '0',
  `service_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `expired_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `job_service_extension`
--

INSERT INTO `job_service_extension` (`id`, `job_id`, `service_id`, `status`, `expired_at`, `created_at`) VALUES
(1, 23, 2, 0, '2015-05-23 10:42:37', '2015-05-22 03:57:32'),
(2, 24, 3, 0, '2015-05-23 10:42:37', '2015-05-22 03:57:42'),
(39, 39, 1, 0, '2015-06-22 11:43:11', '2015-05-23 04:43:11'),
(40, 39, 2, 0, '2015-06-22 11:43:11', '2015-05-23 04:43:11'),
(41, 39, 3, 0, '2015-06-22 11:43:11', '2015-05-23 04:43:11'),
(42, 44, 1, 0, '2015-07-05 15:46:25', '2015-06-05 08:46:25'),
(43, 44, 2, 0, '2015-07-05 15:46:25', '2015-06-05 08:46:25'),
(44, 44, 3, 0, '2015-07-05 15:46:25', '2015-06-05 08:46:25'),
(45, 45, 1, 0, '2015-07-05 15:55:54', '2015-06-05 08:55:55'),
(46, 45, 2, 0, '2015-07-05 15:55:54', '2015-06-05 08:55:55'),
(47, 45, 3, 0, '2015-07-05 15:55:54', '2015-06-05 08:55:55'),
(48, 46, 1, 0, '2015-07-08 11:27:27', '2015-06-08 04:27:27'),
(49, 46, 2, 0, '2015-07-08 11:27:27', '2015-06-08 04:27:27'),
(50, 46, 3, 0, '2015-07-08 11:27:27', '2015-06-08 04:27:27'),
(51, 91, 1, 0, '2015-07-09 16:33:19', '2015-06-09 09:33:19'),
(52, 91, 6, 0, '2015-07-09 16:33:19', '2015-06-17 07:39:06'),
(53, 91, 3, 0, '2015-07-09 16:33:19', '2015-06-09 09:33:19'),
(54, 92, 1, 0, '2015-07-10 17:14:52', '2015-06-10 10:14:52');

-- --------------------------------------------------------

--
-- Table structure for table `job_wishlist`
--

CREATE TABLE IF NOT EXISTS `job_wishlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_languages` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name_languages`, `status`, `date_created`) VALUES
(3, 'Tiếng Việt', 1, 0),
(4, 'Tiếng Anh', 1, 0),
(5, 'Tiếng Trung', 1, 0),
(6, 'Tiếng Nhật', 0, 0),
(7, 'Tiếng Pháp', 0, 0),
(8, 'Tiếng Đức', 0, 0),
(9, 'Tiếng Nga', 0, 0),
(10, 'Tiếng Hàn', 0, 0),
(11, 'Tiếng Khmer', 0, 0),
(12, 'Tiếng Thái', 0, 0),
(13, 'Tiếng Lào', 0, 0),
(14, 'Tiếng Myanmar', 0, 0),
(15, 'Tiếng Indonesia', 0, 0),
(16, 'Tiếng Malaysia', 0, 0),
(17, 'Tiếng Đài Loan', 0, 0),
(18, 'Tiếng Ấn Độ', 0, 0),
(19, 'Tiếng Ả Rập', 0, 0),
(20, 'Tiếng Ba Lan', 0, 0),
(21, 'Tiếng Đan Mạch', 0, 0),
(22, 'Tiếng Hà Lan', 0, 0),
(23, 'Tiếng Hy Lạp', 0, 0),
(24, 'Tiếng Pakistan', 0, 0),
(25, 'Tiếng Thổ Nhĩ Kỳ', 0, 0),
(26, 'Tiếng Tây Ban Nha', 0, 0),
(27, 'Tiếng Thụy Điển', 0, 0),
(28, 'Tiếng Ý', 0, 0),
(29, 'Khác', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `language_level`
--

CREATE TABLE IF NOT EXISTS `language_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_language_level` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `language_level`
--

INSERT INTO `language_level` (`id`, `name_language_level`, `status`, `date_created`) VALUES
(5, 'Sơ cấp', 1, 0),
(6, 'Trung cấp', 1, 0),
(7, 'Cao cấp', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `location_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `location_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `log_amount`
--

CREATE TABLE IF NOT EXISTS `log_amount` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL DEFAULT '0',
  `user_receive` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `iddetailorder` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1: tăng,2: giảm',
  `balance` double(12,2) NOT NULL DEFAULT '0.00',
  `score` double(12,2) NOT NULL DEFAULT '0.00',
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `portal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_release` tinyint(1) NOT NULL DEFAULT '0',
  `created` date NOT NULL,
  `created_time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `log_bonus`
--

CREATE TABLE IF NOT EXISTS `log_bonus` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1: tăng,2: giảm',
  `score` double(12,2) NOT NULL DEFAULT '0.00',
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `balance` double(12,2) NOT NULL DEFAULT '0.00',
  `created` date NOT NULL,
  `created_time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1994 ;

--
-- Dumping data for table `log_bonus`
--

INSERT INTO `log_bonus` (`id`, `user_id`, `status`, `score`, `description`, `balance`, `created`, `created_time`) VALUES
(1991, 49701, 1, 5.00, '', 0.00, '2015-06-01', '11:06:28'),
(1992, 49712, 1, 5.00, '', 0.00, '2015-06-02', '10:06:34'),
(1993, 49736, 1, 5.00, '', 0.00, '2015-06-03', '11:06:23');

-- --------------------------------------------------------

--
-- Table structure for table `log_experience`
--

CREATE TABLE IF NOT EXISTS `log_experience` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1: tăng,2: giảm',
  `balance` double(12,2) NOT NULL DEFAULT '0.00',
  `score` double(12,2) NOT NULL DEFAULT '0.00',
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` date NOT NULL,
  `created_time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2019 ;

--
-- Dumping data for table `log_experience`
--

INSERT INTO `log_experience` (`id`, `user_id`, `status`, `balance`, `score`, `description`, `created`, `created_time`) VALUES
(2016, 49701, 1, 0.00, 10.00, '', '2015-06-01', '11:06:28'),
(2017, 49712, 1, 0.00, 10.00, '', '2015-06-02', '10:06:34'),
(2018, 49736, 1, 0.00, 10.00, '', '2015-06-03', '11:06:23');

-- --------------------------------------------------------

--
-- Table structure for table `log_frozen`
--

CREATE TABLE IF NOT EXISTS `log_frozen` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL DEFAULT '0',
  `user_receive` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1: tăng,2: giảm',
  `balance` double(12,2) NOT NULL DEFAULT '0.00',
  `score` double(12,2) NOT NULL DEFAULT '0.00',
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `portal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_release` tinyint(1) NOT NULL DEFAULT '0',
  `is_complete` tinyint(1) DEFAULT NULL,
  `iddetailorder` int(11) NOT NULL,
  `created` date NOT NULL,
  `created_time` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mail_queue`
--

CREATE TABLE IF NOT EXISTS `mail_queue` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `subject` text CHARACTER SET utf8 NOT NULL,
  `body` text CHARACTER SET utf8 NOT NULL,
  `from` varchar(100) CHARACTER SET utf8 NOT NULL,
  `to` varchar(100) CHARACTER SET utf8 NOT NULL,
  `cc` varchar(100) CHARACTER SET utf8 NOT NULL,
  `bc` varchar(100) CHARACTER SET utf8 NOT NULL,
  `status` tinyint(5) NOT NULL,
  `priority` tinyint(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21843 ;

--
-- Dumping data for table `mail_queue`
--

INSERT INTO `mail_queue` (`id`, `subject`, `body`, `from`, `to`, `cc`, `bc`, `status`, `priority`) VALUES
(21825, 'Applancer: New Password for Login', 'Hi ithtan558,\n<br/><br/>\nApplancer recently received a request for a forgotten password.\n<br/><br/>\nTo change your Applancer password, please click the link below: http://topdev.vn/users/resetPassword/ithtan558/cfa8bce13cb16f88e5bf89f5642afdbe\n<br/><br/>\nIf you did not request this change, you do not need to do anything.\n<br/><br/>\nThis link will expire in 24 hour. \n\n<br/><br/>\nThanks,<br/>\nApplancer Support.', 'donotreply@applancer.net', 'ithtan558@gmail.com', '', '', 1, 0),
(21826, 'Applancer: New Password for Login', 'Hi ithtan558,\n<br/><br/>\nApplancer recently received a request for a forgotten password.\n<br/><br/>\nTo change your Applancer password, please click the link below: http://topdev.vn/users/resetPassword/ithtan558/66dc6bb756f9928ed0bea59560facc2c\n<br/><br/>\nIf you did not request this change, you do not need to do anything.\n<br/><br/>\nThis link will expire in 24 hour. \n\n<br/><br/>\nThanks,<br/>\nApplancer Support.', 'donotreply@applancer.net', 'ithtan558@gmail.com', '', '', 1, 0),
(21827, 'Topdev Team: New Password for Login', 'Hi ithtan559,\r\n<br/><br/>\r\nTopdev Team recently received a request for a forgotten password.\r\n<br/><br/>\r\nTo change your Topdev Team password, please click the link below: http://topdev.vn/users/resetPassword/ithtan559/9c1ae6830d8df0c0f74addec4df906be\r\n<br/><br/>\r\nIf you did not request this change, you do not need to do anything.\r\n<br/><br/>\r\nThis link will expire in 24 hour. \r\n\r\n<br/><br/>\r\nThanks,<br/>\r\nTopdev Team Support.', 'donotreply@applancer.net', 'ithtan559@gmail.com', '', '', 1, 0),
(21828, 'Topdev Team: New Password for Login', 'Hi ,\r\n<br/><br/>\r\nTopdev Team recently received a request for a forgotten password.\r\n<br/><br/>\r\nTo change your Topdev Team password, please click the link below: http://topdev.vn/users/resetPassword//617651467182e976f51bacf2d78d76ba\r\n<br/><br/>\r\nIf you did not request this change, you do not need to do anything.\r\n<br/><br/>\r\nThis link will expire in 24 hour. \r\n\r\n<br/><br/>\r\nThanks,<br/>\r\nTopdev Team Support.', 'donotreply@applancer.net', 'ithtan559@gmail.com', '', '', 1, 0),
(21829, 'Topdev Team: New Password for Login', 'Hi ,\r\n<br/><br/>\r\nTopdev recently received a request for a forgotten password.\r\n<br/><br/>\r\nTo change your Topdev account password, please click the link below: http://workspharma.dev/users/resetPassword//be030dd7f2cea8f965941853e911a1a8\r\n<br/><br/>\r\nIf you did not request this change, you do not need to do anything.\r\n<br/><br/>\r\nThis link will expire in 24 hour. \r\n\r\n<br/><br/>\r\nThanks,<br/>\r\nTopdev Support Team.', 'ithtan558@gmail.com', 'ithtan558@gmail.com', '', '', 0, 0),
(21830, 'Topdev Team: New Password for Login', 'Hi ,\r\n<br/><br/>\r\nTopdev recently received a request for a forgotten password.\r\n<br/><br/>\r\nTo change your Topdev account password, please click the link below: http://workspharma.dev/users/resetPassword//6c16174e92c99e0fddb0c05707de2b8a\r\n<br/><br/>\r\nIf you did not request this change, you do not need to do anything.\r\n<br/><br/>\r\nThis link will expire in 24 hour. \r\n\r\n<br/><br/>\r\nThanks,<br/>\r\nTopdev Support Team.', 'ithtan558@gmail.com', 'ithtan660@gmail.com', '', '', 0, 0),
(21831, 'Workspharma Team: New Password for Login', 'Hi ,\r\n<br/><br/>\r\nWorkspharma recently received a request for a forgotten password.\r\n<br/><br/>\r\nTo change your Workspharma account password, please click the link below: http://workspharma.dev/users/resetPassword//07efce5589adb56b20622d4cb617974f\r\n<br/><br/>\r\nIf you did not request this change, you do not need to do anything.\r\n<br/><br/>\r\nThis link will expire in 24 hour. \r\n\r\n<br/><br/>\r\nThanks,<br/>\r\nWorkspharma Support Team.', 'ithtan558@gmail.com', 'ithtan660@gmail.com', '', '', 0, 0),
(21832, 'Workspharma Team: New Password for Login', 'Hi ,\r\n<br/><br/>\r\nWorkspharma recently received a request for a forgotten password.\r\n<br/><br/>\r\nTo change your Workspharma account password, please click the link below: http://workspharma.dev/users/resetPassword/ithtan660/gmail.com/641c68374ffeb7ee38f7752149d7d591\r\n<br/><br/>\r\nIf you did not request this change, you do not need to do anything.\r\n<br/><br/>\r\nThis link will expire in 24 hour. \r\n\r\n<br/><br/>\r\nThanks,<br/>\r\nWorkspharma Support Team.', 'ithtan558@gmail.com', 'ithtan660@gmail.com', '', '', 0, 0),
(21833, 'Workspharma Team: New Password for Login', 'Hi ,\r\n<br/><br/>\r\nWorkspharma recently received a request for a forgotten password.\r\n<br/><br/>\r\nTo change your Workspharma account password, please click the link below: http://workspharma.dev/users/resetPassword/ithtan660/gmail.com/1ac6f7e7b916f9d9c78c0765d62d5a9e\r\n<br/><br/>\r\nIf you did not request this change, you do not need to do anything.\r\n<br/><br/>\r\nThis link will expire in 24 hour. \r\n\r\n<br/><br/>\r\nThanks,<br/>\r\nWorkspharma Support Team.', 'ithtan558@gmail.com', 'ithtan660@gmail.com', '', '', 0, 0),
(21834, 'Workspharma Team: New Password for Login', 'Hi ,\r\n<br/><br/>\r\nWorkspharma recently received a request for a forgotten password.\r\n<br/><br/>\r\nTo change your Workspharma account password, please click the link below: http://workspharma.dev/users/resetPassword/ithtan558/gmail.com/57b239d81891eae74a6c36ceba733504\r\n<br/><br/>\r\nIf you did not request this change, you do not need to do anything.\r\n<br/><br/>\r\nThis link will expire in 24 hour. \r\n\r\n<br/><br/>\r\nThanks,<br/>\r\nWorkspharma Support Team.', 'ithtan558@gmail.com', 'ithtan558@gmail.com', '', '', 0, 0),
(21835, 'Workspharma Team: New Password for Login', 'Hi ,\r\n<br/><br/>\r\nWorkspharma recently received a request for a forgotten password.\r\n<br/><br/>\r\nTo change your Workspharma account password, please click the link below: http://workspharma.dev/users/resetPassword/ithtan559/gmail.com/22961b64260d0ce85129f27718715203\r\n<br/><br/>\r\nIf you did not request this change, you do not need to do anything.\r\n<br/><br/>\r\nThis link will expire in 24 hour. \r\n\r\n<br/><br/>\r\nThanks,<br/>\r\nWorkspharma Support Team.', 'ithtan558@gmail.com', 'ithtan559@gmail.com', '', '', 0, 0),
(21836, 'Workspharma Team: New Password for Login', 'Hi ,\r\n<br/><br/>\r\nWorkspharma recently received a request for a forgotten password.\r\n<br/><br/>\r\nTo change your Workspharma account password, please click the link below: http://workspharma.dev/users/resetPassword/ithtan559/gmail.com/ed460b7a82ce62b57c1709f2f14f14bf\r\n<br/><br/>\r\nIf you did not request this change, you do not need to do anything.\r\n<br/><br/>\r\nThis link will expire in 24 hour. \r\n\r\n<br/><br/>\r\nThanks,<br/>\r\nWorkspharma Support Team.', 'ithtan558@gmail.com', 'ithtan559@gmail.com', '', '', 0, 0),
(21837, 'Workspharma Team: New Password for Login', 'Hi ,\r\n<br/><br/>\r\nWorkspharma recently received a request for a forgotten password.\r\n<br/><br/>\r\nTo change your Workspharma account password, please click the link below: http://workspharma.dev/users/resetPassword/ithtan559/gmail.com/2e9a0f66dd5352f9e527b1820a0983d3\r\n<br/><br/>\r\nIf you did not request this change, you do not need to do anything.\r\n<br/><br/>\r\nThis link will expire in 24 hour. \r\n\r\n<br/><br/>\r\nThanks,<br/>\r\nWorkspharma Support Team.', 'ithtan558@gmail.com', 'ithtan559@gmail.com', '', '', 0, 0),
(21838, 'Workspharma Team: New Password for Login', 'Hi ,\r\n<br/><br/>\r\nWorkspharma recently received a request for a forgotten password.\r\n<br/><br/>\r\nTo change your Workspharma account password, please click the link below: http://workspharma.dev/users/resetPassword/ithtan558/gmail.com/12695847839ce5501dd26a84696b6de0\r\n<br/><br/>\r\nIf you did not request this change, you do not need to do anything.\r\n<br/><br/>\r\nThis link will expire in 24 hour. \r\n\r\n<br/><br/>\r\nThanks,<br/>\r\nWorkspharma Support Team.', 'ithtan558@gmail.com', 'ithtan558@gmail.com', '', '', 0, 0),
(21839, 'Workspharma Team: New Password for Login', 'Hi ,\r\n<br/><br/>\r\nWorkspharma recently received a request for a forgotten password.\r\n<br/><br/>\r\nTo change your Workspharma account password, please click the link below: http://workspharma.dev/users/resetPassword/ithtan558/gmail.com/4ed6c88e07623e3c1a87184f287a6b14\r\n<br/><br/>\r\nIf you did not request this change, you do not need to do anything.\r\n<br/><br/>\r\nThis link will expire in 24 hour. \r\n\r\n<br/><br/>\r\nThanks,<br/>\r\nWorkspharma Support Team.', 'ithtan558@gmail.com', 'ithtan558@gmail.com', '', '', 0, 0),
(21840, 'Workspharma Team: New Password for Login', 'Hi ,\r\n<br/><br/>\r\nWorkspharma recently received a request for a forgotten password.\r\n<br/><br/>\r\nTo change your Workspharma account password, please click the link below: http://workspharma.dev/users/resetPassword/ithtan558/gmail.com/2cc6144a93b9aaf5aaa7b4cd30de4c89\r\n<br/><br/>\r\nIf you did not request this change, you do not need to do anything.\r\n<br/><br/>\r\nThis link will expire in 24 hour. \r\n\r\n<br/><br/>\r\nThanks,<br/>\r\nWorkspharma Support Team.', 'ithtan558@gmail.com', 'ithtan558@gmail.com', '', '', 0, 0),
(21841, 'Workspharma Team: New Password for Login', 'Hi ,\r\n<br/><br/>\r\nWorkspharma recently received a request for a forgotten password.\r\n<br/><br/>\r\nTo change your Workspharma account password, please click the link below: http://workspharma.dev/users/resetPassword/ithtan558/gmail.com/6add6959c45bffad20a88265b56cbd2a\r\n<br/><br/>\r\nIf you did not request this change, you do not need to do anything.\r\n<br/><br/>\r\nThis link will expire in 24 hour. \r\n\r\n<br/><br/>\r\nThanks,<br/>\r\nWorkspharma Support Team.', 'ithtan558@gmail.com', 'ithtan558@gmail.com', '', '', 0, 0),
(21842, 'Workspharma Team: New Password for Login', 'Hi ,\r\n<br/><br/>\r\nWorkspharma recently received a request for a forgotten password.\r\n<br/><br/>\r\nTo change your Workspharma account password, please click the link below: http://workspharma.dev/users/resetPassword/ithtan558/gmail.com/8de40c41642cc16c01f5c8d09315b4a5\r\n<br/><br/>\r\nIf you did not request this change, you do not need to do anything.\r\n<br/><br/>\r\nThis link will expire in 24 hour. \r\n\r\n<br/><br/>\r\nThanks,<br/>\r\nWorkspharma Support Team.', 'ithtan558@gmail.com', 'ithtan558@gmail.com', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `name_percent`
--

CREATE TABLE IF NOT EXISTS `name_percent` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` int(3) NOT NULL DEFAULT '0',
  `key` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `from_id` int(10) NOT NULL DEFAULT '0',
  `to_id` int(10) NOT NULL DEFAULT '0',
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created` int(13) NOT NULL DEFAULT '0',
  `type_id` int(2) NOT NULL DEFAULT '0',
  `job_id` int(10) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1377 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `from_id`, `to_id`, `content`, `created`, `type_id`, `job_id`, `status`) VALUES
(1376, 49694, 14, '', 1434445959, 2, 91, 1),
(1375, 49694, 14, '', 1434443035, 1, 91, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification_setting`
--

CREATE TABLE IF NOT EXISTS `notification_setting` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL DEFAULT '0',
  `setting` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created` int(13) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `notification_type`
--

CREATE TABLE IF NOT EXISTS `notification_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `setting_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(1) DEFAULT '0' COMMENT '0:client,1:dev,2:both',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `notification_type`
--

INSERT INTO `notification_type` (`id`, `type_name`, `setting_name`, `type`) VALUES
(1, 'love_job', '', 2),
(2, 'job_apply', '', 2),
(3, 'accept_cv', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE IF NOT EXISTS `partners` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `slogan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `employees` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `group_id` int(5) NOT NULL DEFAULT '0',
  `group_ids` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `categories` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `country_id`, `name`, `alias`, `description`, `image`, `logo`, `slogan`, `address`, `website`, `twitter`, `facebook`, `employees`, `date_created`, `group_id`, `group_ids`, `categories`, `status`) VALUES
(8, 10, 'Name 2 update', 'Name-2-update', ' Description 2  update', 'LAYOUT_03.png', 'logo-mcafee1.png', 'Slogan 2 update', 'Address 2 update', 'Website 2 update', 'Twitter 2 update', 'Facebook 2 update', '30-40 update', '2015-03-17 07:32:28', 0, '', '', 0),
(10, 4, 'Test partner', 'Test-partner', ' Description', 'BgBanner1.png', 'logo_new.jpg', 'test partner', 'Ho Chi Minh', 'http://applancer.net', 'http://applancer.net', 'http://applancer.net', '30-40', '2015-03-15 12:07:32', 19, '11,23,24,25', '12,13,16,34,37', 0),
(11, 3, 'Company name', 'Company-name', ' Description', 'bg-banner.png', 'logo-microsoft.png', 'Slogan', 'Ho Chi Minh', '', '', '', '', '2015-03-17 07:33:43', 19, '11,23,24', '13,16', 0),
(12, 0, 'Company name', 'Company-name', ' Description', 'BgBanner11.jpg', 'logo-oracle.png', 'Slogan', 'Ho Chi Minh', 'http://applancer.net', 'http://applancer.net', 'http://applancer.net', '30-40', '2015-03-17 08:04:03', 19, '11,24', '12,13', 0),
(13, 10, 'Applancer JSC 2', 'Applancer-JSC2', ' Description', 'bg-banner1.png', 'logo-paypal.png', 'Hire professional, Receive great app', 'Ho Chi Minh', 'http://applancer.net', 'http://applancer.net', 'http://applancer.net', '10-30', '2015-03-18 02:28:14', 19, '11,24', '12,13,17', 0);

-- --------------------------------------------------------

--
-- Table structure for table `partner_client`
--

CREATE TABLE IF NOT EXISTS `partner_client` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `partner_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `partner_id` (`partner_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=39 ;

--
-- Dumping data for table `partner_client`
--

INSERT INTO `partner_client` (`id`, `partner_id`, `title`, `image`, `date_created`) VALUES
(34, 10, NULL, 'a92b3855fa6dd22087678bf00b20e3f5.png', '2015-03-14 02:57:06'),
(35, 10, NULL, 'cb08c5f4189352a0515013d5264a7e12.png', '2015-03-14 02:57:06'),
(36, 10, NULL, '9be6c7fe9d05bdd65f149057ac5248d5.jpg', '2015-03-14 02:57:06'),
(37, 10, NULL, 'e596285ff159538dec39ce13724372e1.png', '2015-03-14 02:57:06'),
(38, 10, NULL, '159e04db01d48a13d3340fd228dacb5e.png', '2015-03-14 02:57:06');

-- --------------------------------------------------------

--
-- Table structure for table `partner_images`
--

CREATE TABLE IF NOT EXISTS `partner_images` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `partner_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `partner_id` (`partner_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Dumping data for table `partner_images`
--

INSERT INTO `partner_images` (`id`, `partner_id`, `title`, `image`, `date_created`) VALUES
(16, 10, NULL, '68a43675943e3fb53751fd6ed30360ad.jpg', '2015-03-14 02:57:06'),
(17, 10, NULL, '63ff3d74a99c6ddac9a153bb33ff334a.jpg', '2015-03-14 02:57:07'),
(18, 10, NULL, 'e58639479f2023bc62e992bfc2efc2f6.jpg', '2015-03-14 02:57:07'),
(19, 10, NULL, 'e22188616fb046f1816fe036debf5562.jpg', '2015-03-14 02:57:07');

-- --------------------------------------------------------

--
-- Table structure for table `partner_portfolio`
--

CREATE TABLE IF NOT EXISTS `partner_portfolio` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `partner_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `key_created` varchar(32) DEFAULT NULL,
  `group_id` int(5) NOT NULL DEFAULT '0',
  `group_ids` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `categories` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `partner_id` (`partner_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

--
-- Dumping data for table `partner_portfolio`
--

INSERT INTO `partner_portfolio` (`id`, `partner_id`, `title`, `image`, `description`, `key_created`, `group_id`, `group_ids`, `categories`, `url`, `date_created`) VALUES
(60, 10, 'Title', '0a35b58d4484636ef5f7c39fd537f4a8.jpg', ' Description', 'e9f52f32c36a9bc47af0413013620fed', 0, '', '', 'http://local.applancer.net/buyer/editProfileUpdate', '2015-03-14 02:51:56'),
(61, 10, 'Title 2', '0b19d315709445c55f597bbe5ad48bfa.jpg', ' Description', 'e9f52f32c36a9bc47af0413013620fed', 0, '', '', 'https://applancer.net/blog/inspiration/what-do-we-need-to-consider-when-applying-new-technology-for-mobile-development.html', '2015-03-14 02:52:14');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio`
--

CREATE TABLE IF NOT EXISTS `portfolio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `main_img` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `group_id` int(5) NOT NULL DEFAULT '0',
  `group_ids` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `categories` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created` int(13) NOT NULL DEFAULT '0',
  `time_completed` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `attachment1` varchar(200) NOT NULL,
  `attachment2` varchar(200) NOT NULL,
  `attachment3` varchar(255) NOT NULL,
  `attachment4` varchar(255) NOT NULL,
  `attachment5` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_files`
--

CREATE TABLE IF NOT EXISTS `portfolio_files` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL DEFAULT '0',
  `created` int(13) NOT NULL DEFAULT '0',
  `file_size` varchar(10) NOT NULL,
  `file_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `original_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `portfolio_id` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pt_adv_right`
--

CREATE TABLE IF NOT EXISTS `pt_adv_right` (
  `idAdvRight` int(11) NOT NULL AUTO_INCREMENT,
  `paramid` int(11) NOT NULL,
  `image_adv_right` varchar(255) NOT NULL,
  `url_adv_right` varchar(255) NOT NULL,
  `text_adv_right` varchar(255) NOT NULL,
  `ordering_adv_right` int(11) NOT NULL,
  `enable_adv_right` int(11) NOT NULL,
  PRIMARY KEY (`idAdvRight`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `pt_adv_right`
--

INSERT INTO `pt_adv_right` (`idAdvRight`, `paramid`, `image_adv_right`, `url_adv_right`, `text_adv_right`, `ordering_adv_right`, `enable_adv_right`) VALUES
(19, 1, '11435069420.jpg', '', '', 2, 1),
(20, 1, '21435069438.jpg', '', '', 1, 1),
(21, 1, '31435069444.jpg', '', '', 3, 1),
(22, 1, '41435069449.jpg', '', '', 4, 1),
(23, 1, '51435069454.jpg', '', '', 5, 1),
(24, 2, '11435070821.jpg', '', '', 7, 1),
(25, 2, '21435070827.jpg', '', '', 9, 1),
(26, 2, '31435070834.jpg', '', '', 10, 1),
(27, 2, '41435070840.jpg', '', '', 6, 1),
(28, 2, '51435070845.jpg', '', '', 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pt_articles`
--

CREATE TABLE IF NOT EXISTS `pt_articles` (
  `idArticles` int(11) NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL DEFAULT '0',
  `related_articles` varchar(255) NOT NULL DEFAULT '0',
  `alias_articles` varchar(255) NOT NULL DEFAULT '0',
  `alias_en_articles` varchar(255) NOT NULL DEFAULT '0',
  `ordering_articles` int(5) NOT NULL DEFAULT '0',
  `title_en_articles` varchar(200) NOT NULL,
  `title_articles` varchar(250) NOT NULL,
  `thumb_articles` varchar(250) NOT NULL DEFAULT '',
  `introtext_articles` text NOT NULL,
  `introtext_en_articles` text NOT NULL,
  `fulltext_en_articles` text NOT NULL,
  `fulltext_articles` text NOT NULL,
  `hits_articles` int(11) NOT NULL DEFAULT '0',
  `is_new_articles` int(11) NOT NULL,
  `is_top_news` int(11) NOT NULL,
  `created_articles` datetime NOT NULL,
  `love` int(11) NOT NULL,
  `created_by_articles` int(11) NOT NULL,
  `meta_title_articles` varchar(255) NOT NULL DEFAULT '',
  `meta_key_articles` varchar(255) NOT NULL DEFAULT '',
  `meta_desc_articles` text NOT NULL,
  `enable_articles` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idArticles`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=94 ;

--
-- Dumping data for table `pt_articles`
--

INSERT INTO `pt_articles` (`idArticles`, `catid`, `related_articles`, `alias_articles`, `alias_en_articles`, `ordering_articles`, `title_en_articles`, `title_articles`, `thumb_articles`, `introtext_articles`, `introtext_en_articles`, `fulltext_en_articles`, `fulltext_articles`, `hits_articles`, `is_new_articles`, `is_top_news`, `created_articles`, `love`, `created_by_articles`, `meta_title_articles`, `meta_key_articles`, `meta_desc_articles`, `enable_articles`) VALUES
(76, 30, '0', 'xu-ly-mot-cuoc-phong-van-ky-quac', '', 6, '', 'Xử Lý Một Cuộc Phỏng Vấn Kỳ Quặc', '08_2015/20560582508-e91444e63a-c5zUxvUT4PA.jpg', 'Nhân viên tuyển dụng là những người có óc phán đoán giỏi vì thường chỉ trong vòng 5 phút đầu tiên của buổi phỏng vấn đã có thể xác định được ứng viên có phù hợp với vị trí và công ty ứng tuyển hay không.\nVì thế, nếu bạn để ý việc gì đó không bình thường về một ứng viên, bạn sẽ chấp nhận mức độ kỳ quặc đến mức nào và xoay chuyển tình thế ra sao?', '', '', '<div class="content_fck" style="margin: 0px; padding: 0px; font-size: 13px; color: rgb(51, 51, 51); font-family: Roboto, Verdana; line-height: 22px !important;">\n	<p style="margin: 0px; padding: 0px 0px 5px; text-align: justify;">\n		Nh&acirc;n vi&ecirc;n tuyển dụng l&agrave; những người c&oacute; &oacute;c ph&aacute;n đo&aacute;n giỏi v&igrave; thường chỉ trong v&ograve;ng 5 ph&uacute;t đầu ti&ecirc;n của buổi phỏng vấn đ&atilde; c&oacute; thể x&aacute;c định được ứng vi&ecirc;n c&oacute; ph&ugrave; hợp với vị tr&iacute; v&agrave; c&ocirc;ng ty ứng tuyển hay kh&ocirc;ng.</p>\n	<p style="margin: 0px; padding: 0px 0px 5px; text-align: justify;">\n		V&igrave; thế, nếu bạn để &yacute; việc g&igrave; đ&oacute; kh&ocirc;ng b&igrave;nh thường về một ứng vi&ecirc;n, bạn sẽ chấp nhận mức độ kỳ quặc đến mức n&agrave;o v&agrave; xoay chuyển t&igrave;nh thế ra sao?</p>\n	<p style="margin: 0px; padding: 0px 0px 5px; text-align: center;">\n		<img id="yui_3_11_0_3_1440125837223_349" src="https://farm6.staticflickr.com/5765/20560582508_e91444e63a_c.jpg" style="margin: 0px; padding: 0px; border: 0px; max-width: 655px;" /></p>\n	<p style="margin: 0px; padding: 0px 0px 5px; text-align: center;">\n		(Nguồn: Hiring Site Careerbuilder)</p>\n	<p style="margin: 0px; padding: 0px 0px 5px; text-align: justify;">\n		<strong style="margin: 0px; padding: 0px;">1. Lưu &yacute; t&acirc;m trạng ứng vi&ecirc;n</strong><br style="margin: 0px; padding: 0px;" />\n		Việc ứng vi&ecirc;n thường căng thẳng v&agrave; lo &acirc;u trong buổi phỏng vấn thường kh&ocirc;ng c&oacute; g&igrave; đ&aacute;ng ngạc nhi&ecirc;n. C&oacute; nhiều khả năng m&agrave; c&ocirc;ng việc họ ứng tuyển sẽ thay đổi nhiều kh&iacute;a cạnh trong cuộc đời họ, v&agrave; tất cả đều t&ugrave;y thuộc v&agrave;o khả năng họ c&oacute; thuyết phục được nh&agrave; tuyển dụng rằng họ đang l&agrave; người đang được t&igrave;m kiếm hay kh&ocirc;ng. Nếu như giọng n&oacute;i ứng vi&ecirc;n bắt đầu c&oacute; vẻ tuyệt vọng hoặc căng thẳng, hoặc những từ ngữ sử dụng dần dần bớt trang trọng, bạn n&ecirc;n hiểu rằng họ đang cố gắng chia sẻ rằng c&ocirc;ng việc n&agrave;y sẽ c&oacute; những ảnh hưởng g&igrave; đến cuộc sống của họ.</p>\n	<p style="margin: 0px; padding: 0px 0px 5px; text-align: justify;">\n		Đối với t&igrave;nh huống n&agrave;y, h&atilde;y khẳng định đam m&ecirc; của ứng vi&ecirc;n v&agrave; cho họ th&ecirc;m thời gian để trấn tĩnh nếu như họ bắt đầu kh&ocirc;ng kiềm chế cảm x&uacute;c được. Bạn chỉ cần n&oacute;i rằng bạn hiểu được cảm gi&aacute;c của họ v&agrave; hỏi xem họ c&oacute; cần v&agrave;i ph&uacute;t để sắp xếp suy nghĩ trước khi tiếp tục cuộc phỏng vấn. Ứng vi&ecirc;n c&oacute; thể kh&ocirc;ng muốn n&oacute;i qu&aacute; nhiều, n&ecirc;n c&aacute;ch &ldquo;tạm ngưng&rdquo; n&agrave;y sẽ gi&uacute;p cho hai b&ecirc;n nhanh ch&oacute;ng bắt nhịp buổi phỏng vấn trở lại.</p>\n	<p style="margin: 0px; padding: 0px 0px 5px; text-align: justify;">\n		<strong style="margin: 0px; padding: 0px;">2. Giữ cho cuộc tr&ograve; chuyện đ&uacute;ng hướng</strong><br style="margin: 0px; padding: 0px;" />\n		Nếu c&oacute; bất kỳ c&acirc;u hỏi n&agrave;o của ứng vi&ecirc;n m&agrave; bạn thấy kh&ocirc;ng ph&ugrave; hợp, hoặc những c&acirc;u trả lời từ họ m&agrave; bạn cảm thấy lạ l&ugrave;ng đều phải được l&agrave;m s&aacute;ng tỏ. Bạn c&oacute; thể hỏi xem v&igrave; sao họ lại c&oacute; mối quan t&acirc;m kh&aacute;c lạ v&agrave; việc n&agrave;y c&oacute; li&ecirc;n quan đến vị tr&iacute; v&agrave; tr&aacute;ch nhiệm trong phạm vi c&ocirc;ng việc tương lai như thế n&agrave;o. L&uacute;c n&agrave;o bạn cũng phải gi&uacute;p ứng vi&ecirc;n &yacute; thức được rằng họ đang tham dự một cuộc phỏng vấn v&agrave;o một vị tr&iacute; chuy&ecirc;n nghiệp, v&agrave; khi bạn li&ecirc;n tục khẳng định những t&iacute;nh c&aacute;ch chuy&ecirc;n nghiệp n&agrave;y th&igrave; ứng vi&ecirc;n c&oacute; thể tự biết được họ đang lan man thế n&agrave;o.</p>\n	<p style="margin: 0px; padding: 0px 0px 5px; text-align: justify;">\n		<strong style="margin: 0px; padding: 0px;">3. D&ugrave;ng những c&acirc;u hỏi thực tế v&agrave; vui tươi l&agrave;m giảm bỡ ngỡ</strong><br style="margin: 0px; padding: 0px;" />\n		Đ&ocirc;i khi một hồ sơ xin việc đầy triển vọng kh&ocirc;ng c&oacute;&nbsp; nghĩa l&agrave; ứng vi&ecirc;n tự tin khi đến cuộc phỏng vấn. T&ugrave;y t&igrave;nh h&igrave;nh nếu như họ đang bị &aacute;p lực hoặc c&oacute; những biểu hiện rất e d&egrave;, bạn n&ecirc;n t&igrave;m c&aacute;ch để kết nối về mặt tinh thần với ứng vi&ecirc;n v&agrave; gi&uacute;p họ c&oacute; cơ hội thể hiện con người thực sự của họ. Những c&acirc;u n&oacute;i đơn giản để gi&uacute;p ứng vi&ecirc;n bớt bỡ ngỡ như &ldquo;Bạn muốn l&agrave;m kh&aacute;ch mời trong chương tr&igrave;nh truyền h&igrave;nh thực tế n&agrave;o nhất?&rdquo; c&oacute; thể gi&uacute;p một ứng vi&ecirc;n nh&uacute;t nh&aacute;t mở lời.</p>\n	<p style="margin: 0px; padding: 0px 0px 5px; text-align: justify;">\n		Nếu như bạn chỉ nhận được c&acirc;u trả lời ngắn gọn từ ứng vi&ecirc;n, v&agrave; thời gian phỏng vấn sắp hết, bạn n&ecirc;n tự điều chỉnh c&acirc;u hỏi th&agrave;nh dạng mở hơn l&agrave; dạng C&oacute;/Kh&ocirc;ng. Bạn cũng c&oacute; thể y&ecirc;u cầu ứng vi&ecirc;n kể về qu&atilde;ng thời gian đi l&agrave;m của họ c&oacute; thể tiết lộ những t&agrave;i năng tiềm ẩn v&agrave; những kỹ năng m&agrave; ứng vi&ecirc;n c&oacute; thể th&agrave;nh c&ocirc;ng tại vị tr&iacute; c&ocirc;ng ty bạn m&agrave; họ chưa c&oacute; cơ hội thể hiện. Điều quan trọng hơn cả l&agrave; phải gi&uacute;p &uacute;ng vi&ecirc;n nh&uacute;t nh&aacute;t n&oacute;i nhiều hơn trong phỏng vấn.</p>\n	<p style="margin: 0px; padding: 0px 0px 5px; text-align: justify;">\n		<strong style="margin: 0px; padding: 0px;">4. Cung cấp th&ocirc;ng tin v&agrave;o cuối buổi phỏng vấn&nbsp;</strong><br style="margin: 0px; padding: 0px;" />\n		Ứng vi&ecirc;n c&oacute; thể kỳ vọng nhiều khi được gọi phỏng vấn &ndash; thư chấp nhận l&agrave;m việc, chế độ đ&atilde;i ngộ hay tiền l&agrave;m việc ngo&agrave;i giờ. Để giảm bớt sự mập mờ, bạn h&atilde;y cố gắng chia sẻ những th&ocirc;ng tin m&agrave; bạn c&oacute; thể - lịch tr&igrave;nh tuyển dụng ứng vi&ecirc;n mới, khi n&agrave;o c&ocirc;ng ty cần ứng vi&ecirc;n bắt đầu c&ocirc;ng việc v&agrave; sẽ c&oacute; bao nhi&ecirc;u v&ograve;ng phỏng vấn diễn ra.</p>\n	<p style="margin: 0px; padding: 0px 0px 5px; text-align: justify;">\n		Bạn cũng phải nắm chắc về tr&aacute;ch nhiệm c&ocirc;ng việc cho từng vị tr&iacute; v&agrave; c&ocirc;ng ty của bạn, v&igrave; rất &iacute;t ứng vi&ecirc;n t&igrave;m hiểu về một c&ocirc;ng ty trước khi họ nộp hồ sơ xin việc. Th&ocirc;ng tin đầy đủ đến ứng vi&ecirc;n sẽ gi&uacute;p r&uacute;t ngắn thời gian tuyển dụng v&agrave; buổi phỏng vấn diễn ra theo tr&igrave;nh tự hơn.</p>\n	<p style="margin: 0px; padding: 0px 0px 5px; text-align: justify;">\n		Nếu trong cuộc phỏng vấn ứng vi&ecirc;n tr&igrave;nh b&agrave;y c&agrave;ng l&uacute;c c&agrave;ng kh&ocirc;ng r&otilde; r&agrave;ng, bạn h&atilde;y hỏi ứng vi&ecirc;n xem họ cần những th&ocirc;ng tin g&igrave; th&ecirc;m để họ x&oacute;a tan sự bối rối hoặc nhầm lẫn từ họ, v&agrave; bạn cũng c&oacute; thể giải th&iacute;ch th&ecirc;m về tr&igrave;nh tự c&aacute;c v&ograve;ng phỏng vấn để ứng vi&ecirc;n c&oacute; thể chuẩn bị tinh thần v&agrave; thể hiện bản th&acirc;n tốt nhất. Nhiều ứng vi&ecirc;n kh&ocirc;ng thay đổi c&ocirc;ng việc thường xuy&ecirc;n sẽ &iacute;t am hiểu về những y&ecirc;u cầu hoặc mong đợi từ một nh&acirc;n vi&ecirc;n tuyển dụng.</p>\n	<p style="margin: 0px; padding: 0px 0px 5px; text-align: justify;">\n		Cuối c&ugrave;ng, khi kết th&uacute;c buổi phỏng vấn bạn phải th&ocirc;ng b&aacute;o r&otilde; r&agrave;ng khi n&agrave;o họ sẽ nhận được phản hồi từ bạn hoặc th&ocirc;ng tin bạn c&oacute; thể cần họ bổ sung. H&atilde;y tạo điều kiện để họ hỏi những thắc mắc v&agrave; cũng để đảm bảo rằng bạn kh&ocirc;ng tự tạo ra th&ecirc;m những điều kỳ quặc n&agrave;o kh&aacute;c.</p>\n</div>\n<div style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Roboto, Verdana; line-height: 16px; text-align: right;">\n	&nbsp; Hiring Site Careerbuilder</div>\n', 1, 0, 0, '2015-08-21 21:50:38', 0, 0, 'Xử Lý Một Cuộc Phỏng Vấn Kỳ Quặc', 'Xử Lý Một Cuộc Phỏng Vấn Kỳ Quặc', 'Xử Lý Một Cuộc Phỏng Vấn Kỳ Quặc', 1),
(77, 30, '0', 'sep-nam-hay-sep-nu-ai-tot-hon-', '', 5, '', 'Sếp Nam Hay Sếp Nữ - Ai Tốt Hơn?', '08_2015/1438831632-cb-web-sepnu-642x347IvWwtyOwsx.jpg', 'Nếu bạn chuẩn bị làm việc tại công ty mới hoặc nếu được lựa chọn, bạn sẽ thích làm việc với sếp nam hay sếp nữ hơn?', '', '', '<div class="content_fck" style="margin: 0px; padding: 0px; font-size: 13px; color: rgb(51, 51, 51); font-family: Roboto, Verdana; line-height: 22px !important;">\n	<p style="margin: 0px; padding: 0px 0px 5px; text-align: justify;">\n		Nếu bạn chuẩn bị l&agrave;m việc tại c&ocirc;ng ty mới hoặc nếu được lựa chọn, bạn sẽ th&iacute;ch l&agrave;m việc với sếp nam hay sếp nữ hơn?</p>\n	<p style="margin: 0px; padding: 0px 0px 5px; text-align: justify;">\n		C&oacute; thể c&acirc;u trả lời thường gặp l&agrave; sếp nam sẽ được ưu &aacute;i hơn.</p>\n	<p style="margin: 0px; padding: 0px 0px 5px; text-align: justify;">\n		Tại Mỹ, khảo s&aacute;t c&aacute;ch đ&acirc;y 62 năm do c&ocirc;ng ty Gallup thực hiện cho thấy 66% th&iacute;ch l&agrave;m việc c&ugrave;ng sếp nam, chỉ 5% chọn sếp nữ v&agrave; 25% cho rằng sếp nam hay nữ kh&ocirc;ng c&oacute; nhiều kh&aacute;c biệt.</p>\n	<p style="margin: 0px; padding: 0px 0px 5px; text-align: justify;">\n		Gần đ&acirc;y, c&ocirc;ng ty sử dụng lại c&acirc;u hỏi cũ để khảo s&aacute;t tr&ecirc;n 11.344 người. Kết quả kh&aacute;c biệt kh&aacute; r&otilde; rệt: chỉ c&ograve;n 33% &nbsp;lượng nh&acirc;n vi&ecirc;n chọn sếp nam, ưu ti&ecirc;n sếp nữ tăng l&ecirc;n 20% v&agrave; 46% c&oacute; &yacute; kiến trung lập rằng sếp n&agrave;o cũng như nhau.</p>\n	<p style="margin: 0px; padding: 0px 0px 5px; text-align: justify;">\n		Nhưng c&oacute; lẽ, ch&uacute;ng ta n&ecirc;n chọn sếp nữ nhiều hơn.</p>\n	<p style="margin: 0px; padding: 0px 0px 5px; text-align: justify;">\n		Tại sao?</p>\n	<p style="margin: 0px; padding: 0px 0px 5px; text-align: justify;">\n		Gallup nhận thấy rằng nữ l&atilde;nh đạo tốt hơn nam. Khảo s&aacute;t cho thấy nh&acirc;n vi&ecirc;n l&agrave;m việc c&ugrave;ng sếp nữ c&oacute; mức độ tương t&aacute;c trung b&igrave;nh cao hơn 6% so với khi l&agrave;m việc c&ugrave;ng sếp nam.</p>\n	<p style="margin: 0px; padding: 0px 0px 5px; text-align: center;">\n		<img id="yui_3_11_0_3_1438742452037_350" src="https://farm1.staticflickr.com/484/20115672768_fe25c0d40f_c.jpg" style="margin: 0px; padding: 0px; border: 0px; max-width: 655px;" /></p>\n	<p style="margin: 0px; padding: 0px 0px 5px; text-align: justify;">\n		Sự tương t&aacute;c giữa sếp nữ - nh&acirc;n vi&ecirc;n nữ chiếm tỉ lệ cao nhất trong bốn nh&oacute;m. Khảo s&aacute;t cũng chỉ ra rằng sếp nữ c&oacute; khuynh hướng gần nh&acirc;n vi&ecirc;n hơn sếp nam (41% so với 35%).</p>\n	<p style="margin: 0px; padding: 0px 0px 5px; text-align: justify;">\n		Theo Gallup, sự quản l&yacute; v&agrave; tương t&aacute;c chặt chẽ c&oacute; thể th&uacute;c đẩy nh&acirc;n vi&ecirc;n l&agrave;m việc hiệu quả cao hơn.<br style="margin: 0px; padding: 0px;" />\n		Một v&agrave;i l&yacute; do m&agrave; sếp nữ sẽ l&agrave; người l&atilde;nh đạo tốt hơn sếp nam:</p>\n	<ul style="margin: 0px; padding-right: 0px; padding-left: 26px !important; list-style: inherit !important;">\n		<li style="margin: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 5px !important; padding-left: 0px; list-style: disc; text-align: justify;">\n			<strong style="margin: 0px; padding: 0px;">Sếp nữ thường xuy&ecirc;n khuyến kh&iacute;ch nh&acirc;n vi&ecirc;n ph&aacute;t triển bản th&acirc;n.</strong></li>\n	</ul>\n	<p style="margin: 0px; padding: 0px 0px 5px; text-align: justify;">\n		Nh&acirc;n vi&ecirc;n l&agrave;m việc c&ugrave;ng sếp nữ đồng t&igrave;nh với nhận x&eacute;t &ldquo;Lu&ocirc;n c&oacute; ai đ&oacute; tại nơi l&agrave;m việc khuyến kh&iacute;ch t&ocirc;i ph&aacute;t triển bản th&acirc;n.&rdquo; hơn nh&acirc;n vi&ecirc;n l&agrave;m việc c&ugrave;ng sếp nam 1,26 lần. Điều n&agrave;y cho thấy rằng sếp nữ c&oacute; khả năng &ldquo;qua mặt&rdquo; c&aacute;c đồng nghiệp nam trong việc khơi dậy tiềm năng v&agrave; định hướng tương lai của nh&acirc;n vi&ecirc;n tốt hơn. Tuy vậy, điều n&agrave;y kh&ocirc;ng c&oacute; nghĩa l&agrave; sếp nữ sẽ dễ d&agrave;ng thăng chức cho nh&acirc;n vi&ecirc;n hơn, m&agrave; sẽ ph&acirc;n c&ocirc;ng những c&ocirc;ng việc th&uacute; vị để thử th&aacute;ch v&agrave; ph&aacute;t huy khả năng nh&acirc;n vi&ecirc;n trong vị tr&iacute; hiện tại c&ugrave;ng với việc chuẩn bị nh&acirc;n vi&ecirc;n th&iacute;ch ứng dần cho những vị tr&iacute; cao hơn sau n&agrave;y.</p>\n	<ul style="margin: 0px; padding-right: 0px; padding-left: 26px !important; list-style: inherit !important;">\n		<li style="margin: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 5px !important; padding-left: 0px; list-style: disc; text-align: justify;">\n			<strong style="margin: 0px; padding: 0px;">Sếp nữ lu&ocirc;n theo s&aacute;t nh&acirc;n vi&ecirc;n trong c&ocirc;ng việc.</strong></li>\n	</ul>\n	<p style="margin: 0px; padding: 0px 0px 5px; text-align: justify;">\n		Nh&acirc;n vi&ecirc;n l&agrave;m việc c&ugrave;ng sếp nữ đồng &yacute; nhiều hơn nh&acirc;n vi&ecirc;n l&agrave;m việc c&ugrave;ng sếp nam gấp 1,29 lần cho nhận định &ldquo;Trong s&aacute;u th&aacute;ng vừa qua, sếp lu&ocirc;n cập nhật t&igrave;nh h&igrave;nh c&ocirc;ng việc của t&ocirc;i.&rdquo;</p>\n	<p style="margin: 0px; padding: 0px 0px 5px; text-align: justify;">\n		Sếp nữ thường đưa ra nhiều nhận x&eacute;t v&agrave; phản hồi thường xuy&ecirc;n để gi&uacute;p nh&acirc;n vi&ecirc;n đạt được mục ti&ecirc;u ph&aacute;t triển bản th&acirc;n &ndash; một trong ba nguyện vọng nh&acirc;n vi&ecirc;n mong muốn nhất từ sếp.</p>\n	<ul style="margin: 0px; padding-right: 0px; padding-left: 26px !important; list-style: inherit !important;">\n		<li style="margin: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 5px !important; padding-left: 0px; list-style: disc; text-align: justify;">\n			<strong style="margin: 0px; padding: 0px;">Sếp nữ khen ngợi nhiều hơn sếp nam.</strong></li>\n	</ul>\n	<p style="margin: 0px; padding: 0px 0px 5px; text-align: justify;">\n		Nh&acirc;n vi&ecirc;n l&agrave;m việc c&ugrave;ng sếp nữ đồng &yacute; nhiều hơn 1,17 lần so với nh&acirc;n vi&ecirc;n l&agrave;m việc c&ugrave;ng sếp nam cho nhận định &ldquo;Trong v&ograve;ng một tuần qua, sếp đ&atilde; ghi nhận v&agrave; khen ngợi t&ocirc;i v&igrave; đ&atilde; ho&agrave;n th&agrave;nh tốt c&ocirc;ng việc.&rdquo;</p>\n	<p style="margin: 0px; padding: 0px 0px 5px; text-align: justify;">\n		Điều n&agrave;y cho thấy rằng sếp nữ c&oacute; thể giỏi hơn sếp nam trong việc đưa ra những nhận x&eacute;t t&iacute;ch cực để nh&acirc;n vi&ecirc;n lu&ocirc;n cảm thấy được tr&acirc;n trọng cho những đ&oacute;ng g&oacute;p của m&igrave;nh đối với c&ocirc;ng ty. Đồng thời, sếp nữ cũng chứng tỏ rằng họ c&oacute; khả năng hỗ trợ nh&acirc;n vi&ecirc;n tiếp thu những phản hồi t&iacute;ch cực trong c&ocirc;ng việc v&agrave; tận dụng th&agrave;nh thế mạnh cho nghề nghiệp.</p>\n	<p style="margin: 0px; padding: 0px 0px 5px; text-align: justify;">\n		Nh&igrave;n chung, nữ giới ở Mỹ đ&atilde; tiến xa hơn nam giới trong việc đ&aacute;p ứng nguyện vọng cần thiết của nh&acirc;n vi&ecirc;n tại nơi l&agrave;m việc. Một trong những l&yacute; giải được đưa ra l&agrave; nữ giới lu&ocirc;n phải cố gắng nhiều hơn nam trong việc quản l&yacute; v&agrave; tương t&aacute;c với nh&acirc;n vi&ecirc;n để vượt th&agrave;nh t&iacute;ch mong đợi v&agrave; tiến xa hơn trong nghề nghiệp, do nữ giới lu&ocirc;n chịu &aacute;p lực về bất b&igrave;nh đẳng giới.<br style="margin: 0px; padding: 0px;" />\n		Tuy nhi&ecirc;n, d&ugrave; l&yacute; do g&igrave; đi nữa, Gallup cũng kết luận rằng c&aacute;c c&ocirc;ng ty n&ecirc;n tập trung v&agrave;o việc tuyển dụng v&agrave; cất nhắc nhiều quản l&yacute; nữ hơn nữa.</p>\n</div>\n<div style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Roboto, Verdana; line-height: 16px; text-align: right;">\n	&nbsp; CareerBuilder.vn</div>\n', 1, 0, 0, '2015-08-21 21:52:41', 0, 0, 'Sếp Nam Hay Sếp Nữ - Ai Tốt Hơn?', 'Sếp Nam Hay Sếp Nữ - Ai Tốt Hơn?', 'Sếp Nam Hay Sếp Nữ - Ai Tốt Hơn?', 1),
(78, 30, '0', 'kham-pha-tinh-nang-moi-voi-talent-solution-v3.0', '', 4, '', 'Khám phá tính năng mới với Talent Solution V3.0', '08_2015/1437475432-2015-07-21-174323i184MSmPnD.png', 'Giải Pháp Nhân Sự phiên bản 3.0 chính thức ra mắt vào ngày 26/06/2015 với các tính năng mới và cải tiến như sau', '', '', '<div class="content_fck" style="margin: 0px; padding: 0px; font-size: 13px; color: rgb(51, 51, 51); font-family: Roboto, Verdana; line-height: 22px !important;">\n	<p style="margin: 0px; padding: 0px 0px 5px;">\n		Giải Ph&aacute;p Nh&acirc;n Sự phi&ecirc;n bản 3.0 ch&iacute;nh thức ra mắt v&agrave;o ng&agrave;y 26/06/2015 với c&aacute;c t&iacute;nh năng mới v&agrave; cải tiến như sau:</p>\n	<p style="margin: 0px; padding: 0px 0px 5px;">\n		<img id="yui_3_11_0_3_1436930400463_349" src="https://farm1.staticflickr.com/422/19699471692_961077d4d1_o.png" style="margin: 0px; padding: 0px; border: 0px; max-width: 655px;" /></p>\n</div>\n<div style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Roboto, Verdana; line-height: 16px; text-align: right;">\n	&nbsp; CareerBuilder.vn</div>\n', 1, 0, 0, '2015-08-21 21:52:34', 0, 0, 'Khám phá tính năng mới với Talent Solution V3.0', 'Khám phá tính năng mới với Talent Solution V3.0', 'Khám phá tính năng mới với Talent Solution V3.0', 1),
(79, 30, '0', '5-ly-do-tai-sao-ban-can-giai-phap-nhan-su-pre-hire', '', 3, '', '5 Lý Do Tại Sao Bạn Cần Giải Pháp Nhân Sự PRE - HIRE', '08_2015/1436930327-ts-v3-avatar4YIWj3mWWZ.jpg', '5 Lý Do Tại Sao Bạn Cần Giải Pháp Nhân Sự PRE - HIRE', '', '', '<div class="content_fck" style="margin: 0px; padding: 0px; font-size: 13px; color: rgb(51, 51, 51); font-family: Roboto, Verdana; line-height: 22px !important;">\n	<p style="margin: 0px; padding: 0px 0px 5px; text-align: center;">\n		<img id="yui_3_11_0_3_1437475234988_350" src="https://farm1.staticflickr.com/304/19856874076_d6d45e157a_o.jpg" style="margin: 0px; padding: 0px; border: 0px; max-width: 655px;" /></p>\n	<h1 class="yt watch-title-container" style="margin: 0px; padding: 0px 0px 10px; line-height: normal; font-size: 25px;">\n		<span style="margin: 0px; padding: 0px; font-size: 14px;">Xem th&ecirc;m về Giải ph&aacute;p Pre-Hire trong video dưới đ&acirc;y</span></h1>\n	<p style="margin: 0px; padding: 0px 0px 5px;">\n		<em style="margin: 0px; padding: 0px;"><span style="margin: 0px; padding: 0px; font-size: 14px;"><span dir="ltr" style="margin: 0px; padding: 0px;">(Để xem tiếng Việt vui l&ograve;ng bật chức năng CC tr&ecirc;n thanh chức năng của Youtube)</span></span></em></p>\n	<p style="margin: 0px; padding: 0px 0px 5px; text-align: center;">\n		<iframe allowfullscreen="" frameborder="0" height="500" src="https://www.youtube.com/embed/4uw90r_TzZM?autoplay=1&amp;rel=0" style="margin: 0px; padding: 0px;" width="650"></iframe></p>\n</div>\n<div style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Roboto, Verdana; line-height: 16px; text-align: right;">\n	&nbsp; CareerBuilder.vn</div>\n', 1, 0, 0, '2015-08-21 21:52:28', 0, 0, '5 Lý Do Tại Sao Bạn Cần Giải Pháp Nhân Sự PRE - HIRE', '5 Lý Do Tại Sao Bạn Cần Giải Pháp Nhân Sự PRE - HIRE', '5 Lý Do Tại Sao Bạn Cần Giải Pháp Nhân Sự PRE - HIRE Xem thêm về Giải pháp Pre-Hire trong video dưới đây (Để xem tiếng Việt vui lòng bật chức năng CC trên thanh chức năng của Youtube)    CareerBuilder.vn', 1),
(80, 31, '0', 've-workspharma', 've-workspharma', 1, 'Về workspharma', 'Về workspharma', '', 'Về workspharma', 'Về workspharma', '<h1>\n	Về CareerLink</h1>\n<h3>\n	1. Lịch sử h&igrave;nh th&agrave;nh</h3>\n<p>\n	Được th&agrave;nh lập v&agrave;o năm 2006,CareerLink.vn đ&atilde; từng bước trở th&agrave;nh cầu nối vững chắc giữa người lao động v&agrave; nh&agrave; tuyển dụng. Ch&uacute;ng t&ocirc;i chuy&ecirc;n cung cấp dịch vụ t&igrave;m kiếm nh&acirc;n sự quản l&yacute; cấp cao, v&agrave; dịch vụ tuyển dụng trực tuyến. Qua đ&oacute;, nh&agrave; tuyển dụng sẽ h&agrave;i l&ograve;ng với việc t&igrave;m được ứng vi&ecirc;n ph&ugrave; hợp nhu cầu, c&ograve;n người t&igrave;m việc sẽ thỏa m&atilde;n với kh&aacute;t vọng vươn tới đỉnh cao sự nghiệp.</p>\n<p>\n	Trong qu&aacute; tr&igrave;nh ph&aacute;t triển, CareerLink.vn đ&atilde; kh&ocirc;ng ngừng nỗ lực cải thiện v&agrave; n&acirc;ng cao chất lượng dịch vụ nhằm tối đa h&oacute;a lợi &iacute;ch của kh&aacute;ch h&agrave;ng. C&ugrave;ng với đ&oacute;, chất lượng đội ngũ nh&acirc;n vi&ecirc;n, chuy&ecirc;n vi&ecirc;n lu&ocirc;n l&agrave; nguồn t&agrave;i sản qu&yacute; gi&aacute; nhất m&agrave; ch&uacute;ng t&ocirc;i rất tr&acirc;n trọng. Họ l&agrave; những chuy&ecirc;n gia trong thị trường nguồn lao động, được đ&agrave;o tạo b&agrave;i bản về chuy&ecirc;n m&ocirc;n, nghiệp vụ, nhiều năm kinh nghiệm, hiểu v&agrave; y&ecirc;u nghề s&acirc;u sắc. Họ đ&atilde; gi&uacute;p ch&uacute;ng t&ocirc;i lu&ocirc;n tự tin cung cấp cho kh&aacute;ch h&agrave;ng sản phẩm tốt nhất. Ch&iacute;nh c&aacute;c yếu tố đ&oacute; đ&atilde; đưa CareerLink.vn trở th&agrave;nh một trong những nh&agrave; tuyển dụng h&agrave;ng đầu của Việt Nam hiện nay.</p>\n', '<p dir="ltr" style="line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt; text-align: justify;">\n	<strong><span id="docs-internal-guid-b9baa371-ce38-399b-64cd-457fc3b24d4d"><span style="font-size: 14.6667px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">WORKSPHARMA.COM</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> l&agrave; website Tuyển Dụng v&agrave; T&igrave;m Việc Y Dược - C&ocirc;ng Nghệ Sinh Học &ndash; H&oacute;a Học ho&agrave;n to&agrave;n miễn ph&iacute;.</span></span></strong></p>\n<p dir="ltr" style="line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt; text-align: justify;">\n	<strong><span id="docs-internal-guid-b9baa371-ce38-399b-64cd-457fc3b24d4d"><span style="font-size: 14.6667px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">WORKSPHARMA.COM</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> được tạo ra để gi&uacute;p c&aacute;c Doanh nghiệp t&igrave;m thấy c&aacute;c cộng sự, đối t&aacute;c ph&ugrave; hợp.</span></span></strong></p>\n<p dir="ltr" style="line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt; text-align: justify;">\n	<strong><span id="docs-internal-guid-b9baa371-ce38-399b-64cd-457fc3b24d4d"><span style="font-size: 14.6667px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">WORKSPHARMA.COM</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> sẽ gi&uacute;p bạn &ndash; những Ứng Vi&ecirc;n chuy&ecirc;n nghiệp - nhanh ch&oacute;ng t&igrave;m thấy v&agrave; lựa chọn cơ hội nghề nghiệp cho Ch&iacute;nh m&igrave;nh.</span></span></strong></p>\n<p dir="ltr" style="line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt; text-align: justify;">\n	&nbsp;</p>\n<p dir="ltr" style="line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt; text-align: justify;">\n	<span id="docs-internal-guid-b9baa371-ce38-399b-64cd-457fc3b24d4d"><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">*</span><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-weight: 700; text-decoration: underline; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Nh&agrave; Tuyển Dụng</span><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> : </span></span></p>\n<p dir="ltr" style="line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt; text-align: justify;">\n	<span id="docs-internal-guid-b9baa371-ce38-399b-64cd-457fc3b24d4d"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Ch&uacute;ng t&ocirc;i ch&agrave;o đ&oacute;n Nh&agrave; tuyển dụng </span></span></p>\n<p dir="ltr" style="line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt; margin-left: 54pt; text-indent: -18pt; text-align: justify;">\n	<span id="docs-internal-guid-b9baa371-ce38-399b-64cd-457fc3b24d4d"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">1. L&agrave; tất cả c&aacute;c Doanh nghiệp, đơn vị, c&aacute; nh&acirc;n cần Đăng tin Tuyển dụng c&oacute; li&ecirc;n quan đến lĩnh vực ng&agrave;nh nghề </span><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Y Dược - C&ocirc;ng Nghệ Sinh Học &ndash; H&oacute;a Học</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">. </span></span></p>\n<p dir="ltr" style="line-height: 1.38; margin-top: 6pt; margin-bottom: 6pt; margin-left: 54pt; text-indent: -18pt; text-align: justify;">\n	<span id="docs-internal-guid-b9baa371-ce38-399b-64cd-457fc3b24d4d"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">2. Ri&ecirc;ng c&aacute;c Doanh nghiệp, c&aacute; nh&acirc;n hoạt động trong lĩnh vực Y Dược - C&ocirc;ng Nghệ Sinh Học &ndash; H&oacute;a Học sẽ đăng tin th&ecirc;m ở </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-style: italic; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Nh&oacute;m</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-style: italic; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">ng&agrave;nh Sản Xuất v&agrave; Khối Hỗ Trợ Gi&aacute;n Tiếp</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">. Việc n&agrave;y nhằm để hỗ trợ cho c&ocirc;ng t&aacute;c tuyển dụng ở c&aacute;c Doanh nghiệp Y Dược - CNSH &ndash; H&oacute;a được hiệu quả hơn v&agrave; đ&acirc;y cũng l&agrave; ti&ecirc;u ch&iacute; hoạt động của ch&uacute;ng t&ocirc;i.</span></span></p>\n<p dir="ltr" style="line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt; text-align: justify;">\n	<span id="docs-internal-guid-b9baa371-ce38-399b-64cd-457fc3b24d4d"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">* Ch&uacute;ng t&ocirc;i từ chối hợp t&aacute;c với c&aacute;c Đơn vị, dịch vụ </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-style: italic; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">c&oacute; thu ph&iacute; của Ứng vi&ecirc;n</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> dưới bất kỳ h&igrave;nh thức n&agrave;o.</span></span></p>\n<p dir="ltr" style="line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt; text-align: justify;">\n	&nbsp;</p>\n<p dir="ltr" style="line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt; text-align: justify;">\n	<span id="docs-internal-guid-b9baa371-ce38-399b-64cd-457fc3b24d4d"><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">* </span><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-weight: 700; text-decoration: underline; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Ứng Vi&ecirc;n</span><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> : </span></span></p>\n<p dir="ltr" style="line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt; text-align: justify;">\n	<span id="docs-internal-guid-b9baa371-ce38-399b-64cd-457fc3b24d4d"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Ch&uacute;ng t&ocirc;i ch&agrave;o đ&oacute;n tất cả Ứng Vi&ecirc;n thuộc lĩnh vực ng&agrave;nh nghề :</span></span></p>\n<p dir="ltr" style="line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt; margin-left: 54pt; text-indent: -18pt; text-align: justify;">\n	<span id="docs-internal-guid-b9baa371-ce38-399b-64cd-457fc3b24d4d"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">1. Y Dược, C&ocirc;ng Nghệ Sinh Học, H&oacute;a Học</span></span></p>\n<p style="text-align: justify;">\n	<span id="docs-internal-guid-b9baa371-ce38-399b-64cd-457fc3b24d4d"><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Sản Xuất v&agrave; Khối Hỗ Trợ Gi&aacute;n Tiếp : R&amp;D, Sản xuất, B&aacute;n h&agrave;ng/ Kinh doanh, Kế to&aacute;n, Nh&acirc;n sự/ Luật, H&agrave;nh ch&iacute;nh/ Thư k&yacute;/ Hồ sơ thầu, Dịch vụ kh&aacute;ch h&agrave;ng/ Sales admin, Marketing/ Digital/ Design/ PR, Quản l&yacute; chất lượng, Quản trị mạng/ Lập tr&igrave;nh vi&ecirc;n, Xuất nhập khẩu/ KD quốc tế, Bi&ecirc;n phi&ecirc;n dịch, Cung ứng/ Mua h&agrave;ng, Bảo tr&igrave;/ Kỹ thuật hạ tầng, T&agrave;i xế/ Giao h&agrave;ng, Kho vận/ Vật tư</span></span></p>\n', 1, 0, 0, '2015-11-04 23:09:26', 0, 0, 'Về workspharma', 'Về workspharma', 'Về workspharma', 1),
(91, 35, '0', 'de-tro-thanh-trinh-duoc-vien-chuyen-nghiep', '', 3, '', 'Để trở thành Trình Dược Viên Chuyên nghiệp', '', 'Thay đổi cách nói chuyện: Họ là những người có nhiều kinh nghiệm nên những cuộc tranh luận chẳng thể mang lại kết quả mong muốn. Nên nhớ rằng mục đích cũng quan trọng như nội dung và điều này cũng giống như giọng điệu và ngôn ngữ cơ thể vậy.', '', '', '<p>\n	Những người c&oacute; 20, 30 năm kinh nghiệm l&agrave;m TDV hoặc những nh&agrave; quản l&yacute; h&agrave;ng đầu thuộc ng&agrave;nh Dược đang phải đối mặt với một viễn cảnh kh&ocirc;ng mấy tốt đẹp</p>\n<p>\n	C&aacute;c h&atilde;ng Dược phẩm Ấn Độ đ&atilde; trở th&agrave;nh một c&ocirc;ng ty to&agrave;n cầu nhờ c&oacute; những nh&acirc;n vi&ecirc;n l&agrave;m việc rất chăm chỉ. Tuy nhi&ecirc;n, những Tr&igrave;nh dược/ NV kinh doanh đ&atilde; đ&oacute;ng g&oacute;p v&agrave;o sự ph&aacute;t triển thần kỳ của c&ocirc;ng ty - Ch&uacute;ng t&ocirc;i xin gọi vui l&agrave; c&aacute;c &ldquo; gi&agrave; l&agrave;ng&rdquo;- giờ đ&acirc;y đang phải đối mặt với cuộc khủng hoảng về nghề nghiệp tồi tệ nhất trong cuộc sống của họ.</p>\n<p>\n	Với t&igrave;nh h&igrave;nh thị trường hiện tại, c&oacute; thể thấy số lượng c&aacute;c l&atilde;nh đạo trẻ đang ng&agrave;y c&agrave;ng tăng (Những người s&aacute;ng tạo v&agrave; tr&igrave;nh độ chuy&ecirc;n m&ocirc;n cao), điều n&agrave;y đẫn đến t&igrave;nh trạng: Liệu những người l&agrave;m việc l&acirc;u năm, nhiều kinh nghiệm hoặc l&agrave; sẽ tự nguyện ra đi hoặc bắt buộc phải ra đi. Những người l&agrave;m trong lĩnh vực Dược (Những người c&oacute; 20, 30 năm kinh nghiệm như TDV hoặc những nh&agrave; quản l&yacute; h&agrave;ng đầu) đang phải đối mặt với một viễn cảnh kh&ocirc;ng mấy tốt đẹp cho lắm. R&otilde; r&agrave;ng c&aacute;c &ldquo;gi&agrave; l&agrave;ng&rdquo; n&agrave;y đang trở th&agrave;nh g&aacute;nh nặng khi c&aacute;c c&ocirc;ng ty phải chi trả cho họ những <span style="color: rgb(0, 51, 204);">khoản lương v&agrave; c&aacute;c g&oacute;i lợi &iacute;ch kh&aacute; cao, </span>trong khi đ&oacute; những c&ocirc;ng việc đấy ho&agrave;n to&agrave;n c&oacute; thể được thực hiện bởi c&aacute;c nh&agrave; l&atilde;nh đạo trẻ với chi ph&iacute; thấp hơn. C&aacute;c h&atilde;ng dược phẩm thường kh&ocirc;ng muốn trả một mức lương cao cho c&aacute;c &ldquo;gi&agrave; l&agrave;ng&rdquo; để l&agrave;m c&aacute;c c&ocirc;ng việc giống nhau đặc biệt khi họ lu&ocirc;n cố chấp, miễn cưỡng trong việc tiếp cận với c&aacute;c c&aacute;ch thức kinh doanh mới.</p>\n<p>\n	Sức &igrave; : vấn đề thường thấy ở c&aacute;c &ldquo;gi&agrave; l&agrave;ng&rdquo;</p>\n<p>\n	Họ thường kh&ocirc;ng muốn hoặc miễn cưỡng khi phải rời c&aacute;i gọi l&agrave; &ldquo;Khu vực đắc đia&rdquo; của họ, tại sao nhỉ ? bởi v&igrave; họ c&oacute; thể dễ d&agrave;ng đạt được doanh thu nhờ những biện ph&aacute;p, c&aacute;ch thức của ri&ecirc;ng họ v&agrave; cứ như vậy họ kh&ocirc;ng phải nhận th&ecirc;m những c&ocirc;ng việc mới v&agrave; kh&oacute; khăn hơn.</p>\n<p>\n	C&aacute;c &ldquo;gi&agrave; l&agrave;ng&rdquo; cũng kh&ocirc;ng muốn tiếp cận những c&aacute;i mới bởi v&igrave; họ r&otilde; r&agrave;ng đang rất h&agrave;i l&ograve;ng với hiệu quả c&ocirc;ng việc hiện tại m&agrave; m&igrave;nh thể hiện, người ta gọi đ&acirc;y l&agrave; sức &igrave; của &ldquo;tuổi gi&agrave;&rdquo;.</p>\n<p>\n	Họ kh&ocirc;ng th&iacute;ch hoặc kh&ocirc;ng muốn tiếp x&uacute;c với những l&atilde;nh đạo trẻ, năng động v&agrave; s&aacute;ng tạo, đ&acirc;y l&agrave; nguy&ecirc;n nh&acirc;n dẫn đến sự mất niềm tin giữa c&aacute;c th&agrave;nh vi&ecirc;n trong nh&oacute;m v&agrave; kết quả l&agrave; g&igrave; chắc hẳn c&aacute;c bạn đều đo&aacute;n được: Một nh&oacute;m l&agrave;m việc k&eacute;m hiệu quả</p>\n<p>\n	=&gt;Giải ph&aacute;p cho vấn đề ?</p>\n<p>\n	C&aacute;c c&ocirc;ng ty cần giải quyết c&aacute;c vấn đề bằng sự cảm th&ocirc;ng v&agrave; thay v&igrave; chờ đợi những thay đổi tức thời th&igrave; c&aacute;c l&atilde;nh đạo C&ocirc;ng ty n&ecirc;n tận dụng sự đ&oacute;ng g&oacute;p của những &ldquo;gi&agrave; l&agrave;ng&ldquo; một c&aacute;ch hợp l&yacute; v&agrave; hiệu quả. Ngo&agrave;i việc can thiệp để thay đổi th&oacute;i quen của họ th&igrave; c&aacute;c biện ph&aacute;p sau đ&acirc;y c&oacute; thể gi&uacute;p c&aacute;c c&ocirc;ng ty &ldquo;thu h&aacute;i &ldquo; được năng suất c&ocirc;ng việc cao hơn từ những nh&acirc;n vi&ecirc;n kinh doanh nhiều kinh nghiệm v&agrave; sự trung th&agrave;n.</p>\n<p>\n	Thay đổi c&aacute;ch n&oacute;i chuyện: Họ l&agrave; những người c&oacute; nhiều kinh nghiệm n&ecirc;n những cuộc tranh luận chẳng thể mang lại kết quả mong muốn. N&ecirc;n nhớ rằng mục đ&iacute;ch cũng quan trọng như nội dung v&agrave; điều n&agrave;y cũng giống như giọng điệu v&agrave; ng&ocirc;n ngữ cơ thể vậy.</p>\n<p>\n	C&aacute;c nh&agrave; quản l&yacute; trẻ c&oacute; thể sử dụng c&aacute;c &ldquo;gi&agrave; l&agrave;ng&rdquo; một c&aacute;ch hiệu quả trước hết bằng sự k&iacute;nh trọng với những g&igrave; họ đ&atilde; đ&oacute;ng g&oacute;p, sau đ&oacute; l&agrave; tận dụng những mối quan hệ tốt của họ với c&aacute;c B&aacute;c sĩ, c&aacute;c Dược sĩ &hellip;. trong quả tr&igrave;nh b&aacute;n h&agrave;ng để đạt được mục đ&iacute;ch cuối c&ugrave;ng l&agrave;:</p>\n<p>\n	Mang lại lợi &iacute;ch cho c&ocirc;ng ty</p>\n<p>\n	Thay đổi vai tr&ograve; v&agrave; tr&aacute;ch nhiệm hiện tại : Những c&ocirc;ng việc, những trải nghiệm mới v&agrave; đặc biệt, c&oacute; thể trở th&agrave;nh một t&aacute;c nh&acirc;n mang t&iacute;nh th&uacute;c đẩy cho c&aacute;c &ldquo;gi&agrave; l&agrave;ng&rdquo;.</p>\n<p>\n	H&atilde;y th&aacute;ch thức họ, h&atilde;y đưa họ ra khỏi kh&ocirc;ng gian chật hẹp của những &ldquo;chiếc hộp tẻ nhạt&ldquo; . Tr&aacute;ch nhiệm c&agrave;ng lớn c&agrave;ng l&agrave;m thỏa m&atilde;n nhu cầu &ldquo; <span style="color: rgb(0, 112, 192);">được c&ocirc;ng nhận</span>&ldquo; v&agrave; ch&iacute;nh điều n&agrave;y sẽ th&uacute;c đẩy họ t&igrave;m ra lời giải cho những b&agrave;i to&aacute;n kh&oacute;.</p>\n<p>\n	Khyến kh&iacute;ch họ &ldquo; kh&aacute;m ph&aacute;&ldquo;: Việc học hỏi những kỹ năng mới c&oacute; thể rất kh&oacute; khăn thậm ch&iacute; c&oacute; thể gọi l&agrave; một th&aacute;ch thức đối với c&aacute;c gi&agrave; l&agrave;ng, tuy nhi&ecirc;n việc tạo ra được động lực ph&ugrave; hợp cũng như m&ocirc;i trường l&agrave;m vi&ecirc;c ch&acirc;n th&agrave;nh c&oacute; thể ph&aacute; vỡ những r&agrave;o cản trong việc tiếp cận những kỹ năng mới v&agrave; h&atilde;y tạo ra những cơ hội để họ c&oacute; thể &aacute;p dụng những kỹ năng đ&oacute;. Một khi thấy được lợi &iacute;ch từ những điều tr&ecirc;n th&igrave; họ sẽ c&agrave;ng được th&uacute;c đẩy để đảm nhận những nhiệm vụ kh&oacute; khăn, th&aacute;ch thức hơn.</p>\n<p>\n	H&atilde;y <span style="color: rgb(0, 112, 192);">tham khảo &yacute; kiến </span>của họ khi đưa ra những quyết định quan trọng: Cần phải coi trọng những đ&oacute;ng g&oacute;p của họ v&agrave; th&uacute;c đẩy họ đưa ra những &yacute; tưởng mới trong c&aacute;c cuộc họp của c&ocirc;ng ty</p>\n<p>\n	Theo d&otilde;i: H&atilde;y theo d&otilde;i thường xuy&ecirc;n v&agrave; <span style="color: rgb(0, 112, 192);">gi&uacute;p đỡ </span>họ trong giai đoạn chuyển đổi n&agrave;y:</p>\n<p style="font-size: 16px; font-family: Arial; color: rgb(0, 176, 80); font-style: italic; vertical-align: baseline; white-space: pre-wrap;">\n	Việc kết hợp kiến thức, sự tận tụy, trung th&agrave;nh của những Tr&igrave;nh dược l&atilde;o l&agrave;ng gi&agrave;u kinh nghiệm với sự quyết t&acirc;m, kh&aacute;t khao của đội ngũ Tr&igrave;nh dược trẻ tuổi c&oacute; thể mạng lại lợi &iacute;ch cho cả đ&ocirc;i b&ecirc;n. Với sự từng trải v&agrave; kinh nghiệm của m&igrave;nh, c&oacute; thể n&oacute;i kh&ocirc;ng ngoa rằng c&aacute;c &ldquo;gi&agrave; l&agrave;ng&rdquo; sẽ l&agrave; những người thầy, những người c&oacute; khả năng th&uacute;c đẩy thế hệ trẻ d&aacute;m đối mặt với những th&aacute;ch thức trong c&ocirc;ng việc.</p>\n', 1, 0, 0, '2015-11-04 23:10:43', 0, 0, 'Để trở thành Trình Dược Viên Chuyên nghiệp', 'Để trở thành Trình Dược Viên Chuyên nghiệp', 'Để trở thành Trình Dược Viên Chuyên nghiệp', 1);
INSERT INTO `pt_articles` (`idArticles`, `catid`, `related_articles`, `alias_articles`, `alias_en_articles`, `ordering_articles`, `title_en_articles`, `title_articles`, `thumb_articles`, `introtext_articles`, `introtext_en_articles`, `fulltext_en_articles`, `fulltext_articles`, `hits_articles`, `is_new_articles`, `is_top_news`, `created_articles`, `love`, `created_by_articles`, `meta_title_articles`, `meta_key_articles`, `meta_desc_articles`, `enable_articles`) VALUES
(93, 35, '0', 'cach-an-mac-phan-anh-con-nguoi-ban', '', 1, '', 'Cách ăn mặc phản ánh con người bạn', '', 'Giống như một đứa bé ở tuổi đến trường ghé thăm bác sĩ – Tôi “sợ hãi” chăm chú nhìn một quý ông ăn mắc rất sang trọng, quý phái – Trình Dược Viên- với khả năng giao tiếp trôi chảy và đầy tự tin.  Tôi tự hỏi mình', '', '', '<p>\n	<span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">&ldquo; Giống như một đứa b&eacute; ở tuổi đến trường gh&eacute; thăm b&aacute;c sĩ &ndash; T&ocirc;i &ldquo;sợ h&atilde;i&rdquo; chăm ch&uacute; nh&igrave;n một qu&yacute; &ocirc;ng ăn mắc rất sang trọng, qu&yacute; ph&aacute;i &ndash; <span style="font-size: 16px; font-family: Arial; color: rgb(68, 114, 196); vertical-align: baseline; white-space: pre-wrap;">Tr&igrave;nh Dược Vi&ecirc;n<span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">- với khả năng giao tiếp tr&ocirc;i chảy v&agrave; đầy tự tin. T&ocirc;i tự hỏi m&igrave;nh &ldquo; Liệu t&ocirc;i c&oacute; thể giống như họ được kh&ocirc;ng nhỉ ? v&agrave; thật t&igrave;nh cờ họ đ&atilde; trở th&agrave;nh &ldquo; h&igrave;nh mẫu &ldquo; m&agrave; t&ocirc;i hằng mong muốn. Thế nhưng, thật đ&aacute;ng buồn khi phải n&oacute;i rằng, hiện nay <span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-style: italic; vertical-align: baseline; white-space: pre-wrap;">điều n&agrave;y đ&atilde; bị thay đổi<span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;"> <span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-style: italic; vertical-align: baseline; white-space: pre-wrap;">ho&agrave;n to&agrave;n<span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">. H&igrave;nh ảnh của Tr&igrave;nh Dược Vi&ecirc;n giờ đ&acirc;y cần phải được ch&uacute; trọng một c&aacute;ch đặc biệt cũng như cần được &ldquo; kh&ocirc;i phục &ldquo; lại</span></span></span></span></span></span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce60-e6ba-4524-6e6f40e0b7c4"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">Tr&igrave;nh Dược Vi&ecirc;n n&ecirc;n học c&aacute;ch &ldquo; Đại diện &ldquo; cho c&ocirc;ng ty một c&aacute;ch thật hiệu quả th&ocirc;ng qua việc ăn mặc ph&ugrave; hợp, khả năng giao tiếp tốt, c&ugrave;ng với một th&aacute;i độ lạc quan. Mục đ&iacute;ch ch&iacute;nh của trang web &ldquo; Linkedln &ldquo; được d&ugrave;ng để đ&aacute;nh gi&aacute; số lần Tr&igrave;nh Dược Vi&ecirc;n nhận được sự &ldquo; cảm k&iacute;ch&rdquo; v&agrave; phản hồi từ b&aacute;c sĩ cũng như từ x&atilde; hội v&agrave; xem x&eacute;t l&agrave;m thế n&agrave;o để duy tr&igrave; &ldquo; t&igrave;nh trạng&rdquo; đ&oacute;. Sau đ&acirc;y l&agrave; một số &yacute; kiến kh&aacute;c nhau về <span style="font-size: 16px; font-family: Arial; color: rgb(68, 114, 196); vertical-align: baseline; white-space: pre-wrap;">Tr&igrave;nh Dược Vi&ecirc;n :</span></span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce60-e6ba-4524-6e6f40e0b7c4"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">&ldquo; T&ocirc;i chuy&ecirc;n về lĩnh vực thực hiện c&aacute;c nghi&ecirc;n cứu về c&aacute;c sản phẩm mới được y&ecirc;u cầu bởi một số kh&aacute;ch h&agrave;ng. T&ocirc;i thật sự rất ngạc nhi&ecirc;n về c&aacute;ch ăn mặc của một số tr&igrave;nh dược vi&ecirc;n. </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce60-e6ba-4524-6e6f40e0b7c4"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">Nhiều người- thậm ch&iacute; họ l&agrave;m việc cho những h&atilde;ng dược phẩm rất nổi tiếng &ndash; mặc những bộ quần &aacute;o &ldquo; nhăn nheo&rdquo;, m&agrave;u sắc th&igrave; phải gọi l&agrave; &ldquo; kinh khủng&ldquo; . Thế nhưng, điều tồi tệ nhất l&agrave; những chiếc balo tr&ocirc;ng thật &ldquo; tồi t&agrave;n &ldquo;. Nhiều Tr&igrave;nh dược Vi&ecirc;n kh&ocirc;ng thể r&uacute;t những &ldquo; phương tiện hỗ trợ&ldquo; ; t&agrave;i liệu, thậm ch&iacute; l&agrave; những mẫu h&agrave;ng một c&aacute;ch dễ d&agrave;ng ra được. Tr&ocirc;ng thật l&agrave; &ldquo;vụng về&rdquo; . R&otilde; r&agrave;ng, những điều tưởng chừng như rất nhỏ nhặt n&agrave;y đ&atilde; bị &ldquo; bỏ qua&rdquo; trong c&aacute;c chương tr&igrave;nh Training. Đ&atilde; qua rồi c&aacute;i thời khi m&agrave; những Tr&igrave;nh Dược Vi&ecirc;n mang những chiếc t&uacute;i &ldquo;l&atilde;nh đạo&rdquo; b&oacute;ng lo&aacute;ng, sang trọng. Như một b&aacute;c sĩ đ&atilde; từng nhận x&eacute;t &ldquo; Họ tr&ocirc;ng giống như những ch&agrave;ng trai &ldquo;giao h&agrave;ng&rdquo; vậy . Họ kh&ocirc;ng cẩn thận cũng như kh&ocirc;ng cung cấp những th&ocirc;ng tin cụ thể g&igrave; cả. Họ đến đ&acirc;y, để lại h&agrave;ng mẫu, những m&oacute;n qu&agrave; hoặc brochure rồi ra đi &ldquo;.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce60-e6ba-4524-6e6f40e0b7c4"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">Sau đ&acirc;y l&agrave; một số phản hồi ( m&agrave;u đỏ) v&agrave; &yacute; kiến của t&aacute;c giả ( m&agrave;u đen)</span></span></p>\n<p>\n	<span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">Shubhro Banerjee<span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); vertical-align: baseline; white-space: pre-wrap;">&ldquo; <span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-style: italic; vertical-align: baseline; white-space: pre-wrap;">Hầu như tất cả c&aacute;c h&atilde;ng Dược phẩm kh&ocirc;ng đầu tư nhiều v&agrave;o training. L&agrave;m thế n&agrave;o để cải thiện được t&igrave;nh trạng n&agrave;y ? v&agrave; ai l&agrave; người chỉ đạo ? t&ocirc;i nghĩ rằng ch&uacute;ng cần phải thực sự hiểu v&agrave; cảm th&ocirc;ng với Tr&igrave;nh Dược Vi&ecirc;n <span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); vertical-align: baseline; white-space: pre-wrap;">&ldquo; <span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;"> Cũng thật kh&oacute; để nghĩ về những điều nhỏ nhặt trước khi nghĩ đến những c&aacute;i g&igrave; đ&oacute; to t&aacute;t hơn như việc tập trung ph&aacute;t triển &ldquo;con người &ldquo; chẳng hạn ( điều n&agrave;y c&oacute; thể gi&uacute;p c&aacute;c tr&igrave;nh dược vi&ecirc;n định hướng nghề nghiệp của họ ). Nếu như vấn đề &ldquo;training&rdquo; v&agrave; &ldquo; ph&aacute;t triển&rdquo; chưa được giải quyết th&igrave; c&oacute; lẽ nhiều tr&igrave;nh dược vi&ecirc;n sẽ c&ograve;n phải t&igrave;m việc li&ecirc;n tục.</span></span></span></span></span></p>\n<p>\n	<span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">Varanasi Ramprasad :<span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); vertical-align: baseline; white-space: pre-wrap;"> &ldquo;<span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-style: italic; vertical-align: baseline; white-space: pre-wrap;">Training thường chỉ diễn ra trong khoảng 3 ng&agrave;y chủ yếu l&agrave; để tr&igrave;nh Dược vi&ecirc;n hiểu về sản phẩm của m&igrave;nh v&agrave; nhiều Cty đ&atilde; qu&ecirc;n mất việc đ&agrave;o tạo những kỹ năng mềm<span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); vertical-align: baseline; white-space: pre-wrap;"> &ldquo;</span></span></span></span></p>\n<p>\n	<span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">Manas Ranjan Dash: &ldquo;<span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); vertical-align: baseline; white-space: pre-wrap;"> <span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-style: italic; vertical-align: baseline; white-space: pre-wrap;">Cần c&oacute; những quy định khắt khe khi muốn trở th&agrave;nh một Tr&igrave;nh Dược Vi&ecirc;n. C&aacute;c Cty Dược phẩm Ấn Độ ( PCD company ) kh&ocirc;ng n&ecirc;n được ph&eacute;p x&acirc;m nhập v&agrave;o những thị trường m&agrave; chắc chắn cần phải n&acirc;ng cao chất lượng của những người đại diện cho Cty<span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); vertical-align: baseline; white-space: pre-wrap;">&rdquo;<span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;"> T&ocirc;i ho&agrave;n to&agrave;n đồng &yacute; với &yacute; kiến n&agrave;y</span></span></span></span></span></p>\n<p>\n	<span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">Manoj Awal:<span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); vertical-align: baseline; white-space: pre-wrap;"> &ldquo;<span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-style: italic; vertical-align: baseline; white-space: pre-wrap;">Thế hệ trẻ b&acirc;y giờ đa phần thường tin v&agrave;o những con đường &ldquo;tắt &ldquo; để dẫn đến th&agrave;nh c&ocirc;ng nhanh ch&oacute;ng hơn. Nếu như ch&uacute;ng ta đ&aacute;nh gi&aacute; cao bản th&acirc;n của m&igrave;nh, đ&aacute;nh gi&aacute; cao nghề nghiệp cũng như l&yacute; do m&agrave; ch&uacute;ng ta c&oacute; mặt ở đ&acirc;y th&igrave; t&ocirc;i tin chắc rằng ch&uacute;ng ta cũng sẽ thay đổi c&aacute;ch nh&igrave;n nhận vấn đề th&ocirc;i<span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); vertical-align: baseline; white-space: pre-wrap;"> &ldquo;<span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;"> </span></span></span></span></span></p>\n<p>\n	<span id="docs-internal-guid-7d99cad2-ce60-e6ba-4524-6e6f40e0b7c4"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">Mọi người thường d&agrave;nh kh&aacute; nhiều thời gian để tập trung ph&aacute;t triển v&agrave; ho&agrave;n thiện bản th&acirc;n bằng c&aacute;ch &ldquo; chủ động &ldquo; hơn. &ldquo;C&ocirc;ng ty kh&ocirc;ng đ&agrave;o tạo t&ocirc;i về điều đấy &rsquo;&rsquo; đ&oacute; r&otilde; r&agrave;ng kh&ocirc;ng phải l&agrave; c&acirc;u trả lời. H&atilde;y t&igrave;m t&ograve;i t&agrave;i liệu, s&aacute;ch b&aacute;o, c&aacute;c diễn đ&agrave;n, kh&oacute;a học&hellip; những nơi m&agrave; bạn c&oacute; thể tự ph&aacute;t triển ch&iacute;nh bản th&acirc;n của m&igrave;nh để cải thiện mọi thứ.</span></span></p>\n<p>\n	<span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">Kumar Ram Mohan:<span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); vertical-align: baseline; white-space: pre-wrap;"> &ldquo;<span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-style: italic; vertical-align: baseline; white-space: pre-wrap;">Trang phục thường &iacute;t li&ecirc;n quan đến tiền lương v&agrave; tiền trợ cấp. Quần &aacute;o c&oacute; thể được mua từ những shop h&agrave;ng hay đơn giản từ những cửa h&agrave;ng b&aacute;n quần &aacute;o nhỏ<span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); vertical-align: baseline; white-space: pre-wrap;"> &ldquo;<span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">. Điều n&agrave;y rất đ&uacute;ng! Một người chẳng cần phải mặc những bộ quần &aacute;o h&agrave;ng hiệu, đắt tiền đơn giản l&agrave; v&igrave; ch&uacute;ng ta đ&acirc;u phải l&agrave; những &ldquo;ng&ocirc;i sao&ldquo; m&agrave;n ảnh. Trang phục gọn g&agrave;ng, sạch sẽ, được l&agrave; ủi cẩn thận v&agrave; tốt nhất l&agrave; c&aacute;c bạn n&ecirc;n mặc một chiếc quần đen với một chiếc &aacute;o sơ mi nhạt m&agrave;u, đ&ocirc;i giầy n&ecirc;n được đ&aacute;nh b&oacute;ng, chiếc ba l&ocirc; s&aacute;ng m&agrave;u c&ugrave;ng với những phương tiện hỗ trợ v&agrave; t&agrave;i liệu quảng c&aacute;o kinh doanh n&ecirc;n được sắp xếp một c&aacute;ch ph&ugrave; hợp. Tất cả những điều n&agrave;y sẽ gi&uacute;p bạn chứng minh được sự hiện diện cũng như x&acirc;y dựng h&igrave;nh ảnh của m&igrave;nh</span></span></span></span></span></p>\n<p>\n	<span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">Rajeev Bahl:<span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-style: italic; vertical-align: baseline; white-space: pre-wrap;"> &ldquo;Thực tế th&igrave;, những nh&agrave; l&atilde;nh đạo thực dụng thường &iacute;t ch&uacute; &yacute; đến trang phục<span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); vertical-align: baseline; white-space: pre-wrap;">&ldquo;<span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">. Trang phục thường phản &aacute;nh &ldquo;suy nghĩ&ldquo; của bạn. Thật đ&aacute;ng tiếc khi m&agrave; ng&agrave;y nay nhiều người l&agrave;m trong nghề kh&ocirc;ng đủ khả năng để thực hiện những nhiệm vụ, bổn phận mang t&iacute;nh chuy&ecirc;n nghiệp - thực sự m&agrave; n&oacute;i th&igrave;, họ l&agrave; những người b&aacute;n h&agrave;ng &ldquo;kh&ocirc;ng c&oacute; kỹ năng&rdquo; v&agrave; dĩ nhi&ecirc;n kh&ocirc;ng phải l&agrave; Tr&igrave;nh Dược Vi&ecirc;n theo đ&uacute;ng nghĩa của n&oacute; bởi v&igrave; bạn chẳng c&oacute; sự &ldquo;h&atilde;nh diện&rdquo; n&agrave;o với c&ocirc;ng việc của bạn cả cũng như trang phục của bạn th&igrave; qu&aacute; &ldquo;kinh khủng&rdquo;. </span></span></span></span></p>\n<p>\n	&ldquo;Cần phải ch&uacute; &yacute; nhiều đến giai đoạn tuyển nh&acirc;n lực. Sau khi được tuyển chọn, việc training, training lại hoặc training li&ecirc;n tục sẽ thổi v&agrave;o mỗi người &ldquo; niềm tự h&agrave;o&ldquo; cũng như &ldquo; l&ograve;ng tự trọng nghề nghiệp&rdquo;</p>\n<p>\n	<span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">Vikram Kumar: <span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-style: italic; vertical-align: baseline; white-space: pre-wrap;"> &ldquo;T&ocirc;i cảm thấy rằng nh&acirc;n phẩm v&agrave; gi&aacute; trị vẫn thường được đ&aacute;nh gi&aacute; th&ocirc;ng qua c&aacute;ch ăn mặc, giao tiếp, v&agrave; những đề nghị đối với kh&aacute;ch h&agrave;ng&ldquo;</span></span></p>\n<p>\n	<span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">Shantanu Chakravarty<span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-style: italic; vertical-align: baseline; white-space: pre-wrap;">: &ldquo; <span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-style: italic; vertical-align: baseline; white-space: pre-wrap;">Theo suy nghĩ của t&ocirc;i th&igrave;, ch&uacute;ng ta ho&agrave;n to&agrave;n c&oacute; thể kh&ocirc;i phục lại niềm tự h&agrave;o nếu như mỗi người trong ch&uacute;ng ta c&oacute; &ldquo;tr&aacute;ch nhiệm&rdquo; n&acirc;ng cao gi&aacute; trị nghề nghiệp của m&igrave;nh&rdquo; </span></span></span></p>\n<p>\n	Để th&agrave;nh c&ocirc;ng v&agrave; tiến bộ trong sự nghiệp của m&igrave;nh, Tr&igrave;nh Dược Vi&ecirc;n cần hiểu ch&iacute;nh m&igrave;nh v&agrave; hiểu kh&aacute;ch h&agrave;ng, đồng nghiệp, cấp tr&ecirc;n v&agrave; suy rộng ra l&agrave; cả x&atilde; hội th&ocirc;ng qua những trang phục, &ldquo;phụ kiện&ldquo; ph&ugrave; hợp c&ugrave;ng với kỹ năng giao tiếp tốt. V&agrave; cuối c&ugrave;ng, c&aacute;c cấp tr&ecirc;n cần phải ch&uacute; &yacute; v&agrave; đầu tư nhiều đến trang phục của c&aacute;c Tr&igrave;nh Dược Vi&ecirc;n.</p>\n<p>\n	Tạp ch&iacute; <span style="text-decoration: underline; font-size: 24px; font-family: Arial; color: rgb(0, 0, 255); font-style: italic; vertical-align: baseline; white-space: pre-wrap;"><a href="http://medicinman.net/2014/01/january-2014-issue/" style="text-decoration:none;">Medicinman.net</a></span></p>\n<p>\n	<span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">&ldquo; Giống như một đứa b&eacute; ở tuổi đến trường gh&eacute; thăm b&aacute;c sĩ &ndash; T&ocirc;i &ldquo;sợ h&atilde;i&rdquo; chăm ch&uacute; nh&igrave;n một qu&yacute; &ocirc;ng ăn mắc rất sang trọng, qu&yacute; ph&aacute;i &ndash; <span style="font-size: 16px; font-family: Arial; color: rgb(68, 114, 196); vertical-align: baseline; white-space: pre-wrap;">Tr&igrave;nh Dược Vi&ecirc;n<span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">- với khả năng giao tiếp tr&ocirc;i chảy v&agrave; đầy tự tin. T&ocirc;i tự hỏi m&igrave;nh &ldquo; Liệu t&ocirc;i c&oacute; thể giống như họ được kh&ocirc;ng nhỉ ? v&agrave; thật t&igrave;nh cờ họ đ&atilde; trở th&agrave;nh &ldquo; h&igrave;nh mẫu &ldquo; m&agrave; t&ocirc;i hằng mong muốn. Thế nhưng, thật đ&aacute;ng buồn khi phải n&oacute;i rằng, hiện nay <span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-style: italic; vertical-align: baseline; white-space: pre-wrap;">điều n&agrave;y đ&atilde; bị thay đổi<span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;"> <span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-style: italic; vertical-align: baseline; white-space: pre-wrap;">ho&agrave;n to&agrave;n<span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">. H&igrave;nh ảnh của Tr&igrave;nh Dược Vi&ecirc;n giờ đ&acirc;y cần phải được ch&uacute; trọng một c&aacute;ch đặc biệt cũng như cần được &ldquo; kh&ocirc;i phục &ldquo; lại</span></span></span></span></span></span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce60-e6ba-4524-6e6f40e0b7c4"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">Tr&igrave;nh Dược Vi&ecirc;n n&ecirc;n học c&aacute;ch &ldquo; Đại diện &ldquo; cho c&ocirc;ng ty một c&aacute;ch thật hiệu quả th&ocirc;ng qua việc ăn mặc ph&ugrave; hợp, khả năng giao tiếp tốt, c&ugrave;ng với một th&aacute;i độ lạc quan. Mục đ&iacute;ch ch&iacute;nh của trang web &ldquo; Linkedln &ldquo; được d&ugrave;ng để đ&aacute;nh gi&aacute; số lần Tr&igrave;nh Dược Vi&ecirc;n nhận được sự &ldquo; cảm k&iacute;ch&rdquo; v&agrave; phản hồi từ b&aacute;c sĩ cũng như từ x&atilde; hội v&agrave; xem x&eacute;t l&agrave;m thế n&agrave;o để duy tr&igrave; &ldquo; t&igrave;nh trạng&rdquo; đ&oacute;. Sau đ&acirc;y l&agrave; một số &yacute; kiến kh&aacute;c nhau về <span style="font-size: 16px; font-family: Arial; color: rgb(68, 114, 196); vertical-align: baseline; white-space: pre-wrap;">Tr&igrave;nh Dược Vi&ecirc;n :</span></span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce60-e6ba-4524-6e6f40e0b7c4"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">&ldquo; T&ocirc;i chuy&ecirc;n về lĩnh vực thực hiện c&aacute;c nghi&ecirc;n cứu về c&aacute;c sản phẩm mới được y&ecirc;u cầu bởi một số kh&aacute;ch h&agrave;ng. T&ocirc;i thật sự rất ngạc nhi&ecirc;n về c&aacute;ch ăn mặc của một số tr&igrave;nh dược vi&ecirc;n. </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce60-e6ba-4524-6e6f40e0b7c4"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">Nhiều người- thậm ch&iacute; họ l&agrave;m việc cho những h&atilde;ng dược phẩm rất nổi tiếng &ndash; mặc những bộ quần &aacute;o &ldquo; nhăn nheo&rdquo;, m&agrave;u sắc th&igrave; phải gọi l&agrave; &ldquo; kinh khủng&ldquo; . Thế nhưng, điều tồi tệ nhất l&agrave; những chiếc balo tr&ocirc;ng thật &ldquo; tồi t&agrave;n &ldquo;. Nhiều Tr&igrave;nh dược Vi&ecirc;n kh&ocirc;ng thể r&uacute;t những &ldquo; phương tiện hỗ trợ&ldquo; ; t&agrave;i liệu, thậm ch&iacute; l&agrave; những mẫu h&agrave;ng một c&aacute;ch dễ d&agrave;ng ra được. Tr&ocirc;ng thật l&agrave; &ldquo;vụng về&rdquo; . R&otilde; r&agrave;ng, những điều tưởng chừng như rất nhỏ nhặt n&agrave;y đ&atilde; bị &ldquo; bỏ qua&rdquo; trong c&aacute;c chương tr&igrave;nh Training. Đ&atilde; qua rồi c&aacute;i thời khi m&agrave; những Tr&igrave;nh Dược Vi&ecirc;n mang những chiếc t&uacute;i &ldquo;l&atilde;nh đạo&rdquo; b&oacute;ng lo&aacute;ng, sang trọng. Như một b&aacute;c sĩ đ&atilde; từng nhận x&eacute;t &ldquo; Họ tr&ocirc;ng giống như những ch&agrave;ng trai &ldquo;giao h&agrave;ng&rdquo; vậy . Họ kh&ocirc;ng cẩn thận cũng như kh&ocirc;ng cung cấp những th&ocirc;ng tin cụ thể g&igrave; cả. Họ đến đ&acirc;y, để lại h&agrave;ng mẫu, những m&oacute;n qu&agrave; hoặc brochure rồi ra đi &ldquo;.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce60-e6ba-4524-6e6f40e0b7c4"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">Sau đ&acirc;y l&agrave; một số phản hồi ( m&agrave;u đỏ) v&agrave; &yacute; kiến của t&aacute;c giả ( m&agrave;u đen)</span></span></p>\n<p>\n	<span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">Shubhro Banerjee<span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); vertical-align: baseline; white-space: pre-wrap;">&ldquo; <span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-style: italic; vertical-align: baseline; white-space: pre-wrap;">Hầu như tất cả c&aacute;c h&atilde;ng Dược phẩm kh&ocirc;ng đầu tư nhiều v&agrave;o training. L&agrave;m thế n&agrave;o để cải thiện được t&igrave;nh trạng n&agrave;y ? v&agrave; ai l&agrave; người chỉ đạo ? t&ocirc;i nghĩ rằng ch&uacute;ng cần phải thực sự hiểu v&agrave; cảm th&ocirc;ng với Tr&igrave;nh Dược Vi&ecirc;n <span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); vertical-align: baseline; white-space: pre-wrap;">&ldquo; <span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;"> Cũng thật kh&oacute; để nghĩ về những điều nhỏ nhặt trước khi nghĩ đến những c&aacute;i g&igrave; đ&oacute; to t&aacute;t hơn như việc tập trung ph&aacute;t triển &ldquo;con người &ldquo; chẳng hạn ( điều n&agrave;y c&oacute; thể gi&uacute;p c&aacute;c tr&igrave;nh dược vi&ecirc;n định hướng nghề nghiệp của họ ). Nếu như vấn đề &ldquo;training&rdquo; v&agrave; &ldquo; ph&aacute;t triển&rdquo; chưa được giải quyết th&igrave; c&oacute; lẽ nhiều tr&igrave;nh dược vi&ecirc;n sẽ c&ograve;n phải t&igrave;m việc li&ecirc;n tục.</span></span></span></span></span></p>\n<p>\n	<span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">Varanasi Ramprasad :<span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); vertical-align: baseline; white-space: pre-wrap;"> &ldquo;<span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-style: italic; vertical-align: baseline; white-space: pre-wrap;">Training thường chỉ diễn ra trong khoảng 3 ng&agrave;y chủ yếu l&agrave; để tr&igrave;nh Dược vi&ecirc;n hiểu về sản phẩm của m&igrave;nh v&agrave; nhiều Cty đ&atilde; qu&ecirc;n mất việc đ&agrave;o tạo những kỹ năng mềm<span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); vertical-align: baseline; white-space: pre-wrap;"> &ldquo;</span></span></span></span></p>\n<p>\n	<span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">Manas Ranjan Dash: &ldquo;<span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); vertical-align: baseline; white-space: pre-wrap;"> <span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-style: italic; vertical-align: baseline; white-space: pre-wrap;">Cần c&oacute; những quy định khắt khe khi muốn trở th&agrave;nh một Tr&igrave;nh Dược Vi&ecirc;n. C&aacute;c Cty Dược phẩm Ấn Độ ( PCD company ) kh&ocirc;ng n&ecirc;n được ph&eacute;p x&acirc;m nhập v&agrave;o những thị trường m&agrave; chắc chắn cần phải n&acirc;ng cao chất lượng của những người đại diện cho Cty<span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); vertical-align: baseline; white-space: pre-wrap;">&rdquo;<span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;"> T&ocirc;i ho&agrave;n to&agrave;n đồng &yacute; với &yacute; kiến n&agrave;y</span></span></span></span></span></p>\n<p>\n	<span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">Manoj Awal:<span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); vertical-align: baseline; white-space: pre-wrap;"> &ldquo;<span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-style: italic; vertical-align: baseline; white-space: pre-wrap;">Thế hệ trẻ b&acirc;y giờ đa phần thường tin v&agrave;o những con đường &ldquo;tắt &ldquo; để dẫn đến th&agrave;nh c&ocirc;ng nhanh ch&oacute;ng hơn. Nếu như ch&uacute;ng ta đ&aacute;nh gi&aacute; cao bản th&acirc;n của m&igrave;nh, đ&aacute;nh gi&aacute; cao nghề nghiệp cũng như l&yacute; do m&agrave; ch&uacute;ng ta c&oacute; mặt ở đ&acirc;y th&igrave; t&ocirc;i tin chắc rằng ch&uacute;ng ta cũng sẽ thay đổi c&aacute;ch nh&igrave;n nhận vấn đề th&ocirc;i<span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); vertical-align: baseline; white-space: pre-wrap;"> &ldquo;<span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;"> </span></span></span></span></span></p>\n<p>\n	<span id="docs-internal-guid-7d99cad2-ce60-e6ba-4524-6e6f40e0b7c4"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">Mọi người thường d&agrave;nh kh&aacute; nhiều thời gian để tập trung ph&aacute;t triển v&agrave; ho&agrave;n thiện bản th&acirc;n bằng c&aacute;ch &ldquo; chủ động &ldquo; hơn. &ldquo;C&ocirc;ng ty kh&ocirc;ng đ&agrave;o tạo t&ocirc;i về điều đấy &rsquo;&rsquo; đ&oacute; r&otilde; r&agrave;ng kh&ocirc;ng phải l&agrave; c&acirc;u trả lời. H&atilde;y t&igrave;m t&ograve;i t&agrave;i liệu, s&aacute;ch b&aacute;o, c&aacute;c diễn đ&agrave;n, kh&oacute;a học&hellip; những nơi m&agrave; bạn c&oacute; thể tự ph&aacute;t triển ch&iacute;nh bản th&acirc;n của m&igrave;nh để cải thiện mọi thứ.</span></span></p>\n<p>\n	<span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">Kumar Ram Mohan:<span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); vertical-align: baseline; white-space: pre-wrap;"> &ldquo;<span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-style: italic; vertical-align: baseline; white-space: pre-wrap;">Trang phục thường &iacute;t li&ecirc;n quan đến tiền lương v&agrave; tiền trợ cấp. Quần &aacute;o c&oacute; thể được mua từ những shop h&agrave;ng hay đơn giản từ những cửa h&agrave;ng b&aacute;n quần &aacute;o nhỏ<span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); vertical-align: baseline; white-space: pre-wrap;"> &ldquo;<span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">. Điều n&agrave;y rất đ&uacute;ng! Một người chẳng cần phải mặc những bộ quần &aacute;o h&agrave;ng hiệu, đắt tiền đơn giản l&agrave; v&igrave; ch&uacute;ng ta đ&acirc;u phải l&agrave; những &ldquo;ng&ocirc;i sao&ldquo; m&agrave;n ảnh. Trang phục gọn g&agrave;ng, sạch sẽ, được l&agrave; ủi cẩn thận v&agrave; tốt nhất l&agrave; c&aacute;c bạn n&ecirc;n mặc một chiếc quần đen với một chiếc &aacute;o sơ mi nhạt m&agrave;u, đ&ocirc;i giầy n&ecirc;n được đ&aacute;nh b&oacute;ng, chiếc ba l&ocirc; s&aacute;ng m&agrave;u c&ugrave;ng với những phương tiện hỗ trợ v&agrave; t&agrave;i liệu quảng c&aacute;o kinh doanh n&ecirc;n được sắp xếp một c&aacute;ch ph&ugrave; hợp. Tất cả những điều n&agrave;y sẽ gi&uacute;p bạn chứng minh được sự hiện diện cũng như x&acirc;y dựng h&igrave;nh ảnh của m&igrave;nh</span></span></span></span></span></p>\n<p>\n	<span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">Rajeev Bahl:<span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-style: italic; vertical-align: baseline; white-space: pre-wrap;"> &ldquo;Thực tế th&igrave;, những nh&agrave; l&atilde;nh đạo thực dụng thường &iacute;t ch&uacute; &yacute; đến trang phục<span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); vertical-align: baseline; white-space: pre-wrap;">&ldquo;<span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">. Trang phục thường phản &aacute;nh &ldquo;suy nghĩ&ldquo; của bạn. Thật đ&aacute;ng tiếc khi m&agrave; ng&agrave;y nay nhiều người l&agrave;m trong nghề kh&ocirc;ng đủ khả năng để thực hiện những nhiệm vụ, bổn phận mang t&iacute;nh chuy&ecirc;n nghiệp - thực sự m&agrave; n&oacute;i th&igrave;, họ l&agrave; những người b&aacute;n h&agrave;ng &ldquo;kh&ocirc;ng c&oacute; kỹ năng&rdquo; v&agrave; dĩ nhi&ecirc;n kh&ocirc;ng phải l&agrave; Tr&igrave;nh Dược Vi&ecirc;n theo đ&uacute;ng nghĩa của n&oacute; bởi v&igrave; bạn chẳng c&oacute; sự &ldquo;h&atilde;nh diện&rdquo; n&agrave;o với c&ocirc;ng việc của bạn cả cũng như trang phục của bạn th&igrave; qu&aacute; &ldquo;kinh khủng&rdquo;. </span></span></span></span></p>\n<p>\n	&ldquo;Cần phải ch&uacute; &yacute; nhiều đến giai đoạn tuyển nh&acirc;n lực. Sau khi được tuyển chọn, việc training, training lại hoặc training li&ecirc;n tục sẽ thổi v&agrave;o mỗi người &ldquo; niềm tự h&agrave;o&ldquo; cũng như &ldquo; l&ograve;ng tự trọng nghề nghiệp&rdquo;</p>\n<p>\n	<span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">Vikram Kumar: <span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-style: italic; vertical-align: baseline; white-space: pre-wrap;"> &ldquo;T&ocirc;i cảm thấy rằng nh&acirc;n phẩm v&agrave; gi&aacute; trị vẫn thường được đ&aacute;nh gi&aacute; th&ocirc;ng qua c&aacute;ch ăn mặc, giao tiếp, v&agrave; những đề nghị đối với kh&aacute;ch h&agrave;ng&ldquo;</span></span></p>\n<p>\n	<span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">Shantanu Chakravarty<span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-style: italic; vertical-align: baseline; white-space: pre-wrap;">: &ldquo; <span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-style: italic; vertical-align: baseline; white-space: pre-wrap;">Theo suy nghĩ của t&ocirc;i th&igrave;, ch&uacute;ng ta ho&agrave;n to&agrave;n c&oacute; thể kh&ocirc;i phục lại niềm tự h&agrave;o nếu như mỗi người trong ch&uacute;ng ta c&oacute; &ldquo;tr&aacute;ch nhiệm&rdquo; n&acirc;ng cao gi&aacute; trị nghề nghiệp của m&igrave;nh&rdquo; </span></span></span></p>\n<p>\n	Để th&agrave;nh c&ocirc;ng v&agrave; tiến bộ trong sự nghiệp của m&igrave;nh, Tr&igrave;nh Dược Vi&ecirc;n cần hiểu ch&iacute;nh m&igrave;nh v&agrave; hiểu kh&aacute;ch h&agrave;ng, đồng nghiệp, cấp tr&ecirc;n v&agrave; suy rộng ra l&agrave; cả x&atilde; hội th&ocirc;ng qua những trang phục, &ldquo;phụ kiện&ldquo; ph&ugrave; hợp c&ugrave;ng với kỹ năng giao tiếp tốt. V&agrave; cuối c&ugrave;ng, c&aacute;c cấp tr&ecirc;n cần phải ch&uacute; &yacute; v&agrave; đầu tư nhiều đến trang phục của c&aacute;c Tr&igrave;nh Dược Vi&ecirc;n.</p>\n<p>\n	Tạp ch&iacute; <span style="text-decoration: underline; font-size: 24px; font-family: Arial; color: rgb(0, 0, 255); font-style: italic; vertical-align: baseline; white-space: pre-wrap;"><a href="http://medicinman.net/2014/01/january-2014-issue/" style="text-decoration:none;">Medicinman.net</a></span></p>\n', 1, 0, 0, '2015-11-04 23:10:12', 0, 0, 'Cách ăn mặc phản ánh con người bạn', 'Cách ăn mặc phản ánh con người bạn', 'Cách ăn mặc phản ánh con người bạn', 1),
(92, 35, '0', 'ban-hang-khong-chi-la-doanh-so', '', 2, '', 'Bán hàng - không chỉ là Doanh số', '', 'Kinh doanh trong lĩnh vực y học không chỉ là thúc đẩy sản phẩm mà mục tiêu chính đó là cung cấp cho bác sĩ các thông tin y học và giúp họ đưa ra những phương án và giải pháp tốt nhất từ sản phẩm để giải quyết các vấn đề của bệnh nhân.', '', '', '<p>\n	Kinh doanh trong lĩnh vực y học kh&ocirc;ng chỉ l&agrave; th&uacute;c đẩy sản phẩm m&agrave; mục ti&ecirc;u ch&iacute;nh đ&oacute; l&agrave; cung cấp cho b&aacute;c sĩ c&aacute;c th&ocirc;ng tin y học v&agrave; gi&uacute;p họ đưa ra những phương &aacute;n v&agrave; giải ph&aacute;p tốt nhất từ sản phẩm để giải quyết c&aacute;c vấn đề của bệnh nh&acirc;n.</p>\n<p>\n	Nhắc đến &ldquo;B&aacute;n h&agrave;ng&ldquo; v&agrave; &ldquo;Marketing&rdquo; chắc hẳn ai cũng đều nghĩ ngay đến những người kho&aacute;c tr&ecirc;n m&igrave;nh bộ trang phục chỉnh chu, gọn g&agrave;ng c&ugrave;ng với khả năng n&oacute;i chuyện &ldquo;kh&eacute;o l&eacute;o&rdquo;, khả năng thuyết phục.</p>\n<p>\n	C&oacute; lẽ hầu hết những người b&aacute;n h&agrave;ng giỏi đều biết đến c&acirc;u ngạn ngữ &ldquo;H&atilde;y t&igrave;m c&aacute;ch b&aacute;n những chiếc tủ lạnh cho người Eskimo&ldquo; Người Eskimo sống trong băng gi&aacute;, liệu họ c&oacute; cần những chiếc tủ lạnh kh&ocirc;ng?</p>\n<p>\n	Việc b&aacute;n h&agrave;ng trong lĩnh vực Dược v&agrave; Thiết bị Y tế cần nhiều <span style="text-decoration: underline;">kỹ năng đặc biệt. Kh&ocirc;ng giống như nh&oacute;m <span style="font-weight: 700;">h&agrave;ng ti&ecirc;u d&ugrave;ng nhanh (Fast moving consumer goods - FMCG ) cần c&aacute;c chiến lược quảng c&aacute;o lớn để gi&uacute;p cho c&ocirc;ng việc b&aacute;n h&agrave;ng trở n&ecirc;n dễ d&agrave;ng hơn. Người KD lĩnh vực dược phẩm v&agrave; c&aacute;c Thiết bị, vật tư Y tế phải dựa v&agrave;o ch&iacute;nh c&aacute;c kỹ năng của họ để th&uacute;c đẩy việc k&ecirc; đơn.</span></span></p>\n<p>\n	Họ cần phải c&oacute; khả năng giao tiếp tốt, thu h&uacute;t sự ch&uacute; &yacute; của kh&aacute;ch h&agrave;ng tiềm năng v&agrave; cuối c&ugrave;ng l&agrave; phải tạo ra được doanh thu.</p>\n<p>\n	Vậy, l&agrave;m thế n&agrave;o để người b&aacute;n h&agrave;ng trong lĩnh vực Chăm s&oacute;c Sức khỏe đạt được mục ti&ecirc;u b&aacute;n h&agrave;ng của họ ?</p>\n<p>\n	<span style="text-decoration: underline; line-height: 1.38; text-align: justify;">Đ&aacute;p &aacute;n l&agrave;: Họ thường sử dụng c&ocirc;ng cụ giao tiếp thay v&igrave; c&aacute;c ấn phẩm quảng c&aacute;o để c&oacute; thể g&acirc;y &ldquo;ảnh hưởng&rdquo; l&ecirc;n c&aacute;c kh&aacute;ch h&agrave;ng. C&aacute;c nh&acirc;n vi&ecirc;n b&aacute;n h&agrave;ng phải c&oacute; khả năng chuyển tải nội dung cũng như th&ecirc;m v&agrave;o đ&oacute; c&aacute;c trường hợp c&oacute; li&ecirc;n quan để cung cấp đến kh&aacute;ch h&agrave;ng những th&ocirc;ng tin thật cụ thể, chi tiết.</span></p>\n<p>\n	C&aacute;c bạn đ&atilde; bao giờ nghe đến MSL chưa nhỉ. Thuật ngữ MSL (Medical Science Liaison) c&ograve;n kh&aacute; mới tại Ấn Độ.</p>\n<p>\n	Một MSL l&agrave; một chuy&ecirc;n gia tư vấn về Chăm s&oacute;c sức khỏe, họ l&agrave;m việc cho c&aacute;c Cty Dược phẩm, C&ocirc;ng nghệ sinh học, Thiết bị y tế, v&agrave; Chăm s&oacute;c sức khỏe. C&ocirc;ng việc của họ c&oacute; thể l&agrave; : Nghi&ecirc;n cứu quan hệ y học, quản l&yacute; khoa học y hoc, v&agrave; c&oacute; thể l&agrave; c&aacute;c nh&agrave; khoa học về y học hoặc Gi&aacute;m đốc y học địa phương.</p>\n<p>\n	Tiến sĩ Samuel Dyer thuộc hiệp hội MSL n&oacute;i &ldquo;Về mặt lịch sử th&igrave; c&aacute;c Cty Dược phẩm v&agrave; Thiết bị Y tế tin rằng : vai tr&ograve; của đội ngũ B&aacute;n h&agrave;ng v&agrave; Maketing đều quan trọng như vai tr&ograve; của c&aacute;c chuy&ecirc;n gia Y khoa đầu ng&agrave;nh - người c&oacute; khả năng tạo ảnh hưởng đến c&aacute;c b&aacute;c sĩ kh&aacute;c - (KOL &ndash; Key opinion leader) v&agrave; non - KOL. Tuy nhi&ecirc;n KOLs ng&agrave;y c&agrave;ng cho rằng họ th&iacute;ch l&agrave;m việc với MSL. Họ đ&aacute;nh gi&aacute; cao những th&ocirc;ng tin được đưa ra từ MSLs, những người c&oacute; nền tảng gi&aacute;o dục v&agrave; kiến thức l&acirc;m s&agrave;ng rất giỏi trong lĩnh vực y học. Sự cần thiết của MSLs kh&ocirc;ng l&agrave;m suy giảm tầm quan trọng của c&aacute;c chuy&ecirc;n gia b&aacute;n h&agrave;ng v&agrave; thực tế th&igrave; họ c&oacute; thể thu được lợi &iacute;ch từ kh&aacute;i niệm mới xuất hiện MSLs</p>\n<p>\n	* Một nh&acirc;n vi&ecirc;n kinh doanh c&oacute; thể khao kh&aacute;t trở th&agrave;nh một MSLs. Sự kết hợp giữa kỹ năng b&aacute;n h&agrave;ng, kiến thức l&acirc;m s&agrave;ng v&agrave; kiến thức chuy&ecirc;n m&ocirc;n c&oacute; thể gi&uacute;p c&aacute;c nh&acirc;n vi&ecirc;n kinh doanh nhảy l&ecirc;n c&aacute;c bậc thang cao hơn v&agrave; trở th&agrave;nh một &ldquo;t&agrave;i sản&ldquo; lớn của Cty</p>\n<p>\n	*C&aacute;c th&agrave;nh vi&ecirc;n trong đội ngũ kiểm định v&agrave; nghi&ecirc;n cứu sản phẩm</p>\n<p>\n	(QA v&agrave; R&amp;D)</p>\n<p>\n	c&oacute; thể đảm nhận vai tr&ograve; của một MSL. Một người l&agrave;m việc nghi&ecirc;n cứu chuy&ecirc;n m&ocirc;n s&acirc;u về sản phẩm khi gặp kh&aacute;ch h&agrave;ng l&agrave; một lợi thế, khi tiếp x&uacute;c họ c&oacute; thể &ldquo;bắt&ldquo; được ngay &ldquo;suy nghĩ&ldquo; của kh&aacute;ch h&agrave;ng v&agrave; chia sẻ kinh nghiệm. Điều n&agrave;y g&oacute;p phần n&acirc;ng cao gi&aacute; trị của sản phẩm cũng như tạo cơ hội để chia sẻ với kh&aacute;ch h&agrave;ng những điểm mạnh về mặt l&acirc;m s&agrave;ng v&agrave; kỹ thuật sản phẩm.</p>\n<p>\n	Vai tr&ograve; B&aacute;n h&agrave;ng trong c&aacute;c CTy Dược v&agrave; Thiết bị Y tế giờ đ&acirc;y đang vượt khỏi kh&aacute;i niệm &ldquo;b&aacute;n h&agrave;ng&rdquo; th&ocirc;ng thường. Đội ngũ b&aacute;n h&agrave;ng Sales n&ecirc;n được gọi l&agrave; &ldquo; Tổng hợp c&aacute;c kỹ năng v&agrave; khả năng &ldquo;. Điều n&agrave;y sẽ l&agrave;m cho vai tr&ograve; B&aacute;n H&agrave;ng trở n&ecirc;n th&uacute; vị hơn rất nhiều v&agrave; c&oacute; lợi cho cả hai : &ldquo;C&aacute;c nh&acirc;n vi&ecirc;n kinh doanh ng&agrave;y c&agrave;ng h&agrave;i l&ograve;ng v&agrave; y&ecirc;u th&iacute;ch c&ocirc;ng việc của họ th&igrave; c&ocirc;ng ty c&agrave;ng thu được nhiều lợi &iacute;ch&ldquo;. V&agrave; kết quả l&agrave; Những điều tốt đẹp nhất sẽ đến với bệnh nh&acirc;n cũng như một niềm tin mới l&acirc;u d&agrave;i, bền vững sẽ được h&igrave;nh th&agrave;nh giữa B&aacute;c sĩ v&agrave; c&aacute;c C&ocirc;ng ty Dược phẩm</p>\n<p>\n	*C&aacute;c bạn đ&atilde; c&oacute; một &ldquo;c&ocirc;ng thức&ldquo; n&agrave;o cho &ldquo;Th&agrave;nh c&ocirc;ng&ldquo; của nghề Tr&igrave;nh Dược chưa nhỉ ? Đ&acirc;y l&agrave; c&ocirc;ng thức &ldquo;th&agrave;nh c&ocirc;ng&rdquo; để c&aacute;c bạn tham khảo</p>\n<p>\n	Sự th&agrave;nh c&ocirc;ng của một Tr&igrave;nh Dược Vi&ecirc;n : l&agrave; KASH</p>\n<p>\n	C&ocirc;ng thức KASH=<span style="color: rgb(0, 0, 0); font-family: Arial; font-size: 16px; font-style: italic; font-weight: 700; white-space: pre-wrap;">Kiến thức về sản phẩm (Knowledge) &ndash; Th&aacute;i độ (Attitude) &ndash; Kỹ năng (Skills) &ndash; Th&oacute;i quen (Habbit)</span></p>\n', 1, 0, 0, '2015-11-04 23:10:25', 0, 0, 'Bán hàng - không chỉ là Doanh số', 'Bán hàng - không chỉ là Doanh số', 'Bán hàng - không chỉ là Doanh số', 1);
INSERT INTO `pt_articles` (`idArticles`, `catid`, `related_articles`, `alias_articles`, `alias_en_articles`, `ordering_articles`, `title_en_articles`, `title_articles`, `thumb_articles`, `introtext_articles`, `introtext_en_articles`, `fulltext_en_articles`, `fulltext_articles`, `hits_articles`, `is_new_articles`, `is_top_news`, `created_articles`, `love`, `created_by_articles`, `meta_title_articles`, `meta_key_articles`, `meta_desc_articles`, `enable_articles`) VALUES
(84, 32, '0', 'tro-giup', 'tro-giup', 1, 'Trợ giúp', 'Trợ giúp', '', 'Bạn hãy gõ những từ khóa có liên quan đến Vị trí công việc, Chức danh hoặc Tiêu đề công việc. \nVí dụ : Bạn đang tìm công việc Trình dược viên thì gõ từ khóa là “Trình dược viên”, “Nhân viên kinh doanh”, “ Medical Rep”', 'Trợ giúp', '<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">D&Agrave;NH CHO ỨNG VI&Ecirc;N</span></span></p>\n<h3 dir="ltr" style="line-height:1.38;margin-top:14pt;margin-bottom:4pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">1/ T&Igrave;M VIỆC</span></span></h3>\n<h3 dir="ltr" style="line-height:1.38;margin-top:14pt;margin-bottom:4pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">C&aacute;ch g&otilde; từ kh&oacute;a để t&igrave;m c&ocirc;ng việc ph&ugrave; hợp</span></span></h3>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Bạn h&atilde;y g&otilde; những từ kh&oacute;a c&oacute; li&ecirc;n quan đến Vị tr&iacute; c&ocirc;ng việc, Chức danh hoặc Ti&ecirc;u đề c&ocirc;ng việc. </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">V&iacute; dụ : Bạn đang t&igrave;m c&ocirc;ng việc Tr&igrave;nh dược vi&ecirc;n th&igrave; g&otilde; từ kh&oacute;a l&agrave; &ldquo;Tr&igrave;nh dược vi&ecirc;n&rdquo;, &ldquo;Nh&acirc;n vi&ecirc;n kinh doanh&rdquo;, &ldquo; Medical Rep&rdquo;</span></span></p>\n<h3 dir="ltr" style="line-height:1.38;margin-top:14pt;margin-bottom:4pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">C&aacute;ch n&agrave;o t&igrave;m việc nhanh hơn : Đăng hồ sơ l&ecirc;n web hay chỉ gửi hồ sơ đến c&aacute;c nh&agrave; tuyển dụng m&agrave; bạn muốn</span></span></h3>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Khi bạn đăng hồ sơ l&ecirc;n web (v&agrave;o mục Ứng vi&ecirc;n đăng hồ sơ) tất cả nh&agrave; tuyển dụng sẽ nhanh ch&oacute;ng t&igrave;m thấy bạn kể cả nh&agrave; tuyển dụng kh&ocirc;ng đăng tin hoặc khi bạn bỏ s&oacute;t tin tuyển dụng th&igrave; nh&agrave; tuyển dụng cũng sẽ chủ động t&igrave;m đến bạn. </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Việc đăng hồ sơ l&ecirc;n web sẽ gi&uacute;p bạn nhanh ch&oacute;ng nắm bắt cơ hội nghề nghiệp của ch&iacute;nh m&igrave;nh hơn.</span></span></p>\n<p>\n	&nbsp;</p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">C&aacute;ch gửi hồ sơ ứng tuyển</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Nếu bạn quan t&acirc;m đến một vị tr&iacute; n&agrave;o đ&oacute;, bạn c&oacute; thể nhấp v&agrave;o chức danh để xem chi tiết. Sau đ&oacute;, nhấp n&uacute;t </span><span style="font-size: 14.6667px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Nộp đơn</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">. Bạn c&oacute; thể nộp hồ sơ bằng 1 trong 2 c&aacute;ch sau:</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 14.6667px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">1. </span><span style="font-size: 14.6667px; font-family: Arial; color: rgb(0, 0, 0); text-decoration: underline; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Nếu </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; text-decoration: underline; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">đ&atilde; c&oacute; hồ sơ tr&ecirc;n Workspharma</span><span style="font-size: 14.6667px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">:</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Bạn nhấp v&agrave;o </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Đăng nhập v&agrave; ứng tuyển ngay</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">,</span><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">click chọn hồ sơ của bạn tr&ecirc;n </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Workspharma. </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Nếu muốn, c&oacute; thể</span><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Sử dụng thư tự giới thiệu</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> v&agrave; cuối c&ugrave;ng click v&agrave;o</span><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span><span style="font-size: 14.6667px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Nộp Ứng Tuyển</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> l&agrave; xong.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">2. </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; text-decoration: underline; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Gửi hồ sơ c&oacute; sẵn từ m&aacute;y t&iacute;nh của bạn</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">: </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Nếu bạn c&oacute; sẵn hồ sơ dạng Ms Word hay PDF, bạn c&oacute; thể sử dụng hồ sơ n&agrave;y để gửi cho nh&agrave; tuyển dụng. Bạn nhấp n&uacute;t </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Nộp đơn</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">, sau đ&oacute; click </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Chọn file từ m&aacute;y t&iacute;nh của bạn,</span><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">c&oacute; thể</span><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Sử dụng thư tự giới thiệu</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 51, 204); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">(nếu muốn), cuối c&ugrave;ng click v&agrave;o</span><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span><span style="font-size: 14.6667px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Nộp Ứng Tuyển</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> l&agrave; xong.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">*</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Nếu bạn chưa c&oacute; hồ sơ</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">, h&atilde;y Tải hồ sơ mẫu, điền th&ocirc;ng tin rồi ứng tuyển</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Hoặc bạn c&oacute; thể tạo hồ sơ mới tr&ecirc;n website ch&uacute;ng t&ocirc;i bằng c&aacute;ch v&agrave;o mục </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Ứng vi&ecirc;n đăng hồ sơ</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> ở trang chủ v&agrave; điền th&ocirc;ng tin v&agrave;o Form c&oacute; sẵn. </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Đăng k&yacute; nhận Th&ocirc;ng Tin Việc L&agrave;m </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Để tr&aacute;nh bỏ s&oacute;t tin tuyển dụng v&agrave; mất cơ hội việc l&agrave;m, bạn n&ecirc;n đăng k&yacute; nhận </span><span style="font-size: 14.6667px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Th&ocirc;ng Tin Việc L&agrave;m</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> ở Trang chủ để được cập nhật tin tuyển dụng mới nhất h&agrave;ng tuần.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Để chỉnh sửa hay tạm thời kh&ocirc;ng nhận Th&ocirc;ng Tin Việc L&agrave;m</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Bạn Đăng nhập t&agrave;i khoản </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Cho người t&igrave;m việc</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">, nhấp chọn </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Tạo th&ocirc;ng b&aacute;o việc l&agrave;m.</span><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Chọn mục</span><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Chỉnh sửa/ ngừng nhận th&ocirc;ng b&aacute;o</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;margin-left: 36pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">+ Nếu muốn chỉnh sửa, bạn chọn lại ng&agrave;nh nghề hoặc địa điểm l&agrave;m việc ph&ugrave; hợp rồi nhấp n&uacute;t </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Cập nhật </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">b&ecirc;n dưới</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;margin-left: 36pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">+ Để tạm thời ngừng nhận </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Th&ocirc;ng B&aacute;o Việc L&agrave;m</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">, bạn click chọn &ocirc; </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Tạm thời ngừng &nbsp;nhận th&ocirc;ng b&aacute;o việc l&agrave;m</span><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">rồi nhấp n&uacute;t </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Cập nhật </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">b&ecirc;n dưới</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;margin-left: 36pt;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">+ Bất cứ khi n&agrave;o bạn muốn nhận lại Th&ocirc;ng B&aacute;o Việc L&agrave;m, bạn chỉ cần nhấp chuột bỏ chọn &ocirc; </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Tạm thời ngừng nhận th&ocirc;ng b&aacute;o việc l&agrave;m</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> v&agrave; nhấp n&uacute;t </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Cập nhật b&ecirc;n </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">dưới l&agrave; xong.</span></span></p>\n<p>\n	&nbsp;</p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">T&ocirc;i muốn biết th&ecirc;m c&aacute;c th&ocirc;ng tin kh&aacute;c ngo&agrave;i th&ocirc;ng tin ghi tr&ecirc;n mẫu Tuyển Dụng, đặc biệt l&agrave; th&ocirc;ng tin li&ecirc;n hệ của nh&agrave; tuyển dụng </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Nh&agrave; tuyển dụng thường chỉ cung cấp những th&ocirc;ng tin họ muốn người t&igrave;m việc cần biết. </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">C&aacute;c th&ocirc;ng tin kh&aacute;c về mức lương, thưởng, ch&iacute;nh s&aacute;ch chế độ&hellip; nếu kh&ocirc;ng được đăng tải tức l&agrave; nh&agrave; tuyển dụng sẽ chỉ trao đổi với ứng vi&ecirc;n khi tiến h&agrave;nh phỏng vấn. &nbsp;</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Nếu ứng vi&ecirc;n muốn hỏi xem với học vấn, kinh nghiệm của m&igrave;nh liệu c&oacute; ph&ugrave; hợp với vị tr&iacute; đăng tuyển kh&ocirc;ng&hellip; th&igrave; ứng vi&ecirc;n vẫn cứ gửi hồ sơ cho nh&agrave; tuyển dụng, họ sẽ xem x&eacute;t nếu kh&ocirc;ng ph&ugrave; hợp vị tr&iacute; n&agrave;y sẽ mời bạn ứng tuyển vị tr&iacute; kh&aacute;c ph&ugrave; hợp với học vấn v&agrave; kinh nghiệm hiện tại của bạn hoặc lưu lại hồ sơ cho đợt tuyển dụng sau. </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Th&ocirc;ng tin li&ecirc;n hệ của nh&agrave; tuyển dụng sẽ kh&ocirc;ng được c&ocirc;ng bố v&igrave; l&yacute; do tr&aacute;nh spam v&agrave; quảng c&aacute;o.</span></span></p>\n<h3 dir="ltr" style="line-height:1.38;margin-top:14pt;margin-bottom:4pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Xem những c&ocirc;ng việc m&agrave; t&ocirc;i đ&atilde; lưu lại hoặc đ&atilde; nộp đơn ứng tuyển</span></span></h3>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Bạn c&oacute; thể xem những c&ocirc;ng việc m&agrave; bạn đ&atilde; lưu lại hoặc đ&atilde; nộp đơn bằng c&aacute;ch đăng nhập v&agrave;o t&agrave;i khoản của bạn v&agrave; nhấp chuột v&agrave;o mục </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Việc l&agrave;m đ&atilde; lưu/ Đ&atilde; ứng tuyển</span></span></p>\n<h3 dir="ltr" style="line-height:1.38;margin-top:14pt;margin-bottom:4pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Nếu thấy nh&agrave; tuyển dụng đăng tin kh&ocirc;ng đ&uacute;ng sự thật v&agrave; thu ph&iacute; của ứng vi&ecirc;n</span></span></h3>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Nếu thấy c&ocirc;ng việc đăng tải kh&ocirc;ng đ&uacute;ng với sự thật hoặc nh&agrave; tuyển dụng y&ecirc;u cầu ứng vi&ecirc;n nộp ph&iacute; giới thiệu việc l&agrave;m. Vui l&ograve;ng b&aacute;o ngay cho ch&uacute;ng t&ocirc;i qua hotline hoặc email để xử l&yacute; một c&aacute;ch triệt để nhằm bảo vệ người t&igrave;m việc. </span></span></p>\n<h3 dir="ltr" style="line-height:1.38;margin-top:14pt;margin-bottom:4pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">2/ T&Agrave;I KHOẢN</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"><span class="Apple-tab-span" style="white-space:pre;"> </span></span></span></h3>\n<h3 dir="ltr" style="line-height:1.38;margin-top:14pt;margin-bottom:4pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Qu&ecirc;n t&ecirc;n đăng nhập (username) v&agrave; mật khẩu (password) </span></span></h3>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Click v&agrave;o mục </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Cho người t&igrave;m việc</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">, v&agrave;o phần </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Đăng nhập</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">, nhấp v&agrave;o &quot;</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Qu&ecirc;n Password</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">&quot; v&agrave; cung cấp cho ch&uacute;ng t&ocirc;i địa chỉ email đ&atilde; đăng k&yacute; trước đ&acirc;y của bạn, ch&uacute;ng t&ocirc;i sẽ gửi t&ecirc;n đăng nhập v&agrave; mật khẩu v&agrave;o địa chỉ email của bạn.</span></span></p>\n<h3 dir="ltr" style="line-height:1.38;margin-top:14pt;margin-bottom:4pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Để thay đổi địa chỉ email đăng nhập hoặc mật khẩu (password) </span></span></h3>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Bạn cần đăng nhập v&agrave;o t&agrave;i khoản </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Cho người t&igrave;m việc</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">, sau đ&oacute; nhấp chuột v&agrave;o mục </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">T&agrave;i Khoản</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">. Bạn click v&agrave;o chỉnh sửa c&aacute;c th&ocirc;ng tin tại đ&acirc;y v&agrave; xuống cuối trang click v&agrave;o </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Cập nhật</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> để x&aacute;c nhận những thay đổi đ&oacute; đồng thời lưu lại th&ocirc;ng tin vừa thay đổi.</span></span></p>\n<h2 dir="ltr" style="line-height:1.38;margin-top:18pt;margin-bottom:4pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">3/ HỒ SƠ &nbsp;T&Igrave;M VIỆC</span></span></h2>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">T&ocirc;i muốn đăng hồ sơ nhưng lại kh&ocirc;ng muốn C&ocirc;ng ty hiện tại nh&igrave;n thấy</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Bạn v&agrave;o mục </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Ứng vi&ecirc;n Đăng hồ sơ</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> ở trang chủ</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 176, 80); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">, </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">nhấp chọn</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 176, 80); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Muốn bảo mật th&ocirc;ng tin c&aacute; nh&acirc;n, đăng k&yacute; hồ sơ tại đ&acirc;y </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Ở mục n&agrave;y bạn c&oacute; thể đăng hồ sơ </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">nhưng c&aacute;c th&ocirc;ng tin về</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> : </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Họ t&ecirc;n, điện thoại, địa chỉ của bạn, t&ecirc;n C&ocirc;ng ty đang l&agrave;m việc sẽ được ẩn, nh&agrave; tuyển dụng chỉ nh&igrave;n thấy v&agrave; li&ecirc;n hệ với bạn qua email. </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Những th&ocirc;ng tin bạn kh&ocirc;ng muốn người đọc nh&igrave;n thấy, h&atilde;y g&otilde; v&agrave;o &quot;BẢO MẬT&quot;. Nhưng bạn phải kiểm tra email thường xuy&ecirc;n để giữ li&ecirc;n lạc với nh&agrave; tuyển dụng.</span></span></p>\n<h3 dir="ltr" style="line-height:1.38;margin-top:14pt;margin-bottom:4pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">T&ocirc;i kh&ocirc;ng muốn nh&agrave; tuyển dụng t&igrave;m thấy hồ sơ của m&igrave;nh</span></span></h3>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">V&agrave;o mục &nbsp;</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Cho</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Người t&igrave;m việc</span><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">ở đầu trang chủ, đăng nhập v&agrave;o t&agrave;i khoản, nhấp chọn </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Đăng hồ sơ. </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Sau khi nhập dữ liệu hồ sơ, bạn chọn</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> Kh&ocirc;ng cho ph&eacute;p t&igrave;m kiếm hồ sơ.</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Tuy nhi&ecirc;n hồ sơ của bạn vẫn được lưu giữ trong dữ liệu của ch&uacute;ng t&ocirc;i v&agrave; bạn c&oacute; thể gửi n&oacute; cho nh&agrave; tuyển dụng khi n&agrave;o bạn nộp tr&ecirc;n mạng.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Nhưng ch&uacute;ng t&ocirc;i khuy&ecirc;n bạn muốn bảo mật n&ecirc;n chọn Kh&ocirc;ng cho ph&eacute;p t&igrave;m kiếm Họ t&ecirc;n, số ĐT, địa chỉ hoặc c&oacute; thể ghi t&ecirc;n </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Cty hiện tại l&agrave; Bảo Mật</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> v&igrave; như vậy bạn sẽ nhận được nhiều cơ hội nghề nghiệp m&agrave; kh&ocirc;ng phải l&uacute;c n&agrave;o cũng c&oacute;.</span></span></p>\n<h3 dir="ltr" style="line-height:1.38;margin-top:14pt;margin-bottom:4pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">T&ocirc;i muốn thay đổi trạng th&aacute;i Bảo Mật hồ sơ </span></span></h3>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Đăng nhập v&agrave;o t&agrave;i khoản của bạn v&agrave; nhấp chuột v&agrave;o </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Chỉnh sửa/ X&oacute;a hồ sơ/ L&agrave;m mới tin</span><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;margin-left: 36pt;text-indent: -18pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">1. Nhấp v&agrave;o </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Chỉnh sửa hồ sơ</span><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">v&agrave; chọn thay đổi t&igrave;nh trạng bảo mật ở ph&iacute;a dưới trang</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;margin-left: 36pt;text-indent: -18pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">2. Nhấp v&agrave;o </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Lưu Hồ Sơ</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">.</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"><span class="Apple-tab-span" style="white-space:pre;"> </span></span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">T&ocirc;i muốn thay đổi số điện thoại ghi trong Hồ sơ</span><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Đăng nhập v&agrave;o t&agrave;i khoản của bạn v&agrave; nhấp chuột v&agrave;o </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Chỉnh sửa/ X&oacute;a hồ sơ/ L&agrave;m mới tin </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;margin-left: 36pt;text-indent: -18pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">1. Nhấp v&agrave;o </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Chỉnh sửa hồ sơ</span><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">v&agrave; thay đổi số điện thoại b&ecirc;n dưới</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;margin-left: 36pt;text-indent: -18pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">2. Nhấp v&agrave;o </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Lưu Hồ Sơ</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> ở cuối trang.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">T&ocirc;i muốn thay đổi ng&agrave;nh nghề mong muốn trong hồ sơ</span><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Đăng nhập v&agrave;o t&agrave;i khoản của bạn v&agrave; nhấp chuột v&agrave;o </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Chỉnh sửa/ X&oacute;a hồ sơ/ L&agrave;m mới tin </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;margin-left: 36pt;text-indent: -18pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">1. Nhấp v&agrave;o </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Chỉnh sửa hồ sơ </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;margin-left: 36pt;text-indent: -18pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">2. Trong </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Ng&agrave;nh Nghề Mong Muốn</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">, x&oacute;a ng&agrave;nh nghề hiện tại bằng c&aacute;ch nhấp chọn ng&agrave;nh nghề hiện tại v&agrave; nhấn n&uacute;t &lt;&lt;, sau đ&oacute; th&ecirc;m lĩnh vực mới bằng c&aacute;ch chọn ng&agrave;nh nghề mới v&agrave; nhấn n&uacute;t &gt;&gt;.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;margin-left: 36pt;text-indent: -18pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">3. Nhấp v&agrave;o Lưu Hồ Sơ ở cuối trang.</span></span></p>\n<h3 dir="ltr" style="line-height:1.38;margin-top:14pt;margin-bottom:4pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Số lượt nh&agrave; tuyển dụng xem Hồ sơ ứng tuyển của t&ocirc;i </span></span></h3>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Bạn c&oacute; thể xem tổng số lượt nh&agrave; tuyển dụng xem Hồ sơ của bạn bằng c&aacute;ch đăng nhập v&agrave;o t&agrave;i khoản của bạn v&agrave; nhấp chuột v&agrave;o mục </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Nh&agrave; tuyển dụng xem hồ sơ</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Tuy nhi&ecirc;n nếu bạn nộp đơn online, nh&agrave; tuyển dụng nhận hồ sơ trực tiếp của bạn qua email v&agrave; trong trường hợp n&agrave;y kh&ocirc;ng thể đếm được. Nhưng chắc chắn l&agrave; hồ sơ của bạn vẫn được đưa đến nh&agrave; tuyển dụng sau khi bạn nhấn n&uacute;t </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Nộp đơn</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">.</span></span></p>\n<h3 dir="ltr" style="line-height:1.38;margin-top:14pt;margin-bottom:4pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">T&ocirc;i kh&ocirc;ng thấy nh&agrave; tuyển dụng xem hồ sơ của t&ocirc;i. T&ocirc;i cần chỉnh sửa g&igrave;</span></span></h3>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">H&atilde;y đảm bảo l&agrave; Hồ sơ của bạn ở trạng th&aacute;i </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Cho ph&eacute;p nh&agrave; tuyển dụng t&igrave;m kiếm,</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> h&atilde;y Đăng nhập v&agrave; v&agrave;o mục </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Chỉnh sửa hồ sơ</span><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">để kiểm tra v&agrave; chỉnh sửa lại trạng th&aacute;i hồ sơ.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Sau đ&oacute; v&agrave;o </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Chỉnh sửa/ X&oacute;a hồ sơ/ L&agrave;m mới tin,</span><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">nhấp chuột v&agrave;o </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">L&agrave;m mới tin</span><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">để l&agrave;m mới HS v&agrave; n&oacute; sẽ được đưa l&ecirc;n trang đầu để nh&agrave; tuyển dụng dễ d&agrave;ng t&igrave;m thấy bạn.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">L&agrave;m thế n&agrave;o để x&oacute;a hồ sơ đ&atilde; đăng</span></span></p>\n<h3 dir="ltr" style="line-height:1.38;margin-top:14pt;margin-bottom:4pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 400; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">X&oacute;a hồ sơ l&agrave; việc kh&ocirc;ng cần thiết, ngay cả khi bạn đ&atilde; t&igrave;m được việc l&agrave;m. Bạn chỉ cần &nbsp;thay đổi trạng th&aacute;i Bảo Mật hồ sơ l&agrave; nh&agrave; tuyển dụng kh&ocirc;ng nh&igrave;n thấy hồ sơ của bạn.</span></span></h3>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Đăng nhập v&agrave;o t&agrave;i khoản của bạn v&agrave; nhấp chuột v&agrave;o </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Chỉnh sửa/ X&oacute;a hồ sơ/ L&agrave;m mới tin </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:6pt;margin-bottom:6pt;margin-left: 36pt;text-indent: -18pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">1. Nhấp v&agrave;o </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Chỉnh sửa hồ sơ</span><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:6pt;margin-bottom:6pt;margin-left: 36pt;text-indent: -18pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">2. Chọn </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Kh&ocirc;ng cho ph&eacute;p t&igrave;m kiếm hồ sơ </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">ở ph&iacute;a dưới trang</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:6pt;margin-left: 36pt;text-indent: -18pt;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">3. Nhấp v&agrave;o </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Lưu Hồ Sơ</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:6pt;margin-left: 36pt;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">* </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Như vậy nh&agrave; tuyển dụng kh&ocirc;ng t&igrave;m thấy hồ sơ của bạn</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:6pt;margin-left: 36pt;">\n	&nbsp;</p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">D&Agrave;NH CHO NH&Agrave; TUYỂN DỤNG</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	&nbsp;</p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">1/ Kh&ocirc;ng đăng tải những c&ocirc;ng việc đ&ograve;i hỏi người t&igrave;m việc phải trả ph&iacute; trước khi l&agrave;m việc.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">2/</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Để mở t&agrave;i khoản sử dụng tr&ecirc;n Workspharma.com</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:6pt;margin-bottom:6pt;margin-left: 40pt;text-indent: -18pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">1. Tr&ecirc;n trang chủ </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Workspharma.com</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">, nhấp v&agrave;o n&uacute;t </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Đăng k&yacute;</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> ở g&oacute;c tr&ecirc;n b&ecirc;n phải.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:6pt;margin-bottom:6pt;margin-left: 40pt;text-indent: -18pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">2. Sau khi điền đầy đủ th&ocirc;ng tin y&ecirc;u cầu, bạn nhấp n&uacute;t </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Đăng k&yacute; ngay.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:6pt;margin-bottom:6pt;margin-left: 40pt;text-indent: -18pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">3. Khi trang x&aacute;c nhận đăng k&yacute; t&agrave;i khoản th&agrave;nh c&ocirc;ng hiện ra, một email hướng dẫn k&iacute;ch hoạt đ&atilde; được gửi v&agrave;o địa chỉ email của bạn.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:6pt;margin-bottom:6pt;margin-left: 40pt;text-indent: -18pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">4. Bạn mở email của ch&uacute;ng t&ocirc;i gửi v&agrave; nhấp v&agrave;o đường link trong email để k&iacute;ch hoạt t&agrave;i khoản sử dụng. (Bạn h&atilde;y kiểm tra cả trong thư mục Junk/Spam/Bulk, nếu vẫn kh&ocirc;ng nhận được email, h&atilde;y li&ecirc;n hệ với ch&uacute;ng t&ocirc;i </span></span></p>\n', '<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">D&Agrave;NH CHO ỨNG VI&Ecirc;N</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;">\n	<strong style="line-height: 1.38; text-align: justify;"><span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">1/ T&Igrave;M VIỆC</span></span></strong></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;">\n	<strong style="line-height: 1.38; text-align: justify;"><span style="color: rgb(0, 0, 0); font-family: Arial; font-size: 17.3333px; white-space: pre-wrap; line-height: 1.38; background-color: transparent;">C&aacute;ch g&otilde; từ kh&oacute;a để t&igrave;m c&ocirc;ng việc ph&ugrave; hợp</span></strong></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Bạn h&atilde;y g&otilde; những từ kh&oacute;a c&oacute; li&ecirc;n quan đến Vị tr&iacute; c&ocirc;ng việc, Chức danh hoặc Ti&ecirc;u đề c&ocirc;ng việc. </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">V&iacute; dụ : Bạn đang t&igrave;m c&ocirc;ng việc Tr&igrave;nh dược vi&ecirc;n th&igrave; g&otilde; từ kh&oacute;a l&agrave; &ldquo;Tr&igrave;nh dược vi&ecirc;n&rdquo;, &ldquo;Nh&acirc;n vi&ecirc;n kinh doanh&rdquo;, &ldquo; Medical Rep&rdquo;</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<strong style="line-height: 1.38;"><span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">C&aacute;ch n&agrave;o t&igrave;m việc nhanh hơn : Đăng hồ sơ l&ecirc;n web hay chỉ gửi hồ sơ đến c&aacute;c nh&agrave; tuyển dụng m&agrave; bạn muốn</span></span></strong></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Khi bạn đăng hồ sơ l&ecirc;n web (v&agrave;o mục Ứng vi&ecirc;n đăng hồ sơ) tất cả nh&agrave; tuyển dụng sẽ nhanh ch&oacute;ng t&igrave;m thấy bạn kể cả nh&agrave; tuyển dụng kh&ocirc;ng đăng tin hoặc khi bạn bỏ s&oacute;t tin tuyển dụng th&igrave; nh&agrave; tuyển dụng cũng sẽ chủ động t&igrave;m đến bạn. </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Việc đăng hồ sơ l&ecirc;n web sẽ gi&uacute;p bạn nhanh ch&oacute;ng nắm bắt cơ hội nghề nghiệp của ch&iacute;nh m&igrave;nh hơn.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">C&aacute;ch gửi hồ sơ ứng tuyển</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Nếu bạn quan t&acirc;m đến một vị tr&iacute; n&agrave;o đ&oacute;, bạn c&oacute; thể nhấp v&agrave;o chức danh để xem chi tiết. Sau đ&oacute;, nhấp n&uacute;t </span><span style="font-size: 14.6667px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Nộp đơn</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">. Bạn c&oacute; thể nộp hồ sơ bằng 1 trong 2 c&aacute;ch sau:</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 14.6667px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">1. </span><span style="font-size: 14.6667px; font-family: Arial; color: rgb(0, 0, 0); text-decoration: underline; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Nếu </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; text-decoration: underline; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">đ&atilde; c&oacute; hồ sơ tr&ecirc;n Workspharma</span><span style="font-size: 14.6667px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">:</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Bạn nhấp v&agrave;o </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Đăng nhập v&agrave; ứng tuyển ngay</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">,</span><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">click chọn hồ sơ của bạn tr&ecirc;n </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Workspharma. </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Nếu muốn, c&oacute; thể</span><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Sử dụng thư tự giới thiệu</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> v&agrave; cuối c&ugrave;ng click v&agrave;o</span><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span><span style="font-size: 14.6667px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Nộp Ứng Tuyển</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> l&agrave; xong.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">2. </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; text-decoration: underline; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Gửi hồ sơ c&oacute; sẵn từ m&aacute;y t&iacute;nh của bạn</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">: </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Nếu bạn c&oacute; sẵn hồ sơ dạng Ms Word hay PDF, bạn c&oacute; thể sử dụng hồ sơ n&agrave;y để gửi cho nh&agrave; tuyển dụng. Bạn nhấp n&uacute;t </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Nộp đơn</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">, sau đ&oacute; click </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Chọn file từ m&aacute;y t&iacute;nh của bạn,</span><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">c&oacute; thể</span><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Sử dụng thư tự giới thiệu</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 51, 204); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">(nếu muốn), cuối c&ugrave;ng click v&agrave;o</span><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span><span style="font-size: 14.6667px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Nộp Ứng Tuyển</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> l&agrave; xong.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">*</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Nếu bạn chưa c&oacute; hồ sơ</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">, h&atilde;y Tải hồ sơ mẫu, điền th&ocirc;ng tin rồi ứng tuyển</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Hoặc bạn c&oacute; thể tạo hồ sơ mới tr&ecirc;n website ch&uacute;ng t&ocirc;i bằng c&aacute;ch v&agrave;o mục </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Ứng vi&ecirc;n đăng hồ sơ</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> ở trang chủ v&agrave; điền th&ocirc;ng tin v&agrave;o Form c&oacute; sẵn. </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Đăng k&yacute; nhận Th&ocirc;ng Tin Việc L&agrave;m </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Để tr&aacute;nh bỏ s&oacute;t tin tuyển dụng v&agrave; mất cơ hội việc l&agrave;m, bạn n&ecirc;n đăng k&yacute; nhận </span><span style="font-size: 14.6667px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Th&ocirc;ng Tin Việc L&agrave;m</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> ở Trang chủ để được cập nhật tin tuyển dụng mới nhất h&agrave;ng tuần.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Để chỉnh sửa hay tạm thời kh&ocirc;ng nhận Th&ocirc;ng Tin Việc L&agrave;m</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Bạn Đăng nhập t&agrave;i khoản </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Cho người t&igrave;m việc</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">, nhấp chọn </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Tạo th&ocirc;ng b&aacute;o việc l&agrave;m.</span><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Chọn mục</span><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Chỉnh sửa/ ngừng nhận th&ocirc;ng b&aacute;o</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;margin-left: 36pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">+ Nếu muốn chỉnh sửa, bạn chọn lại ng&agrave;nh nghề hoặc địa điểm l&agrave;m việc ph&ugrave; hợp rồi nhấp n&uacute;t </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Cập nhật </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">b&ecirc;n dưới</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;margin-left: 36pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">+ Để tạm thời ngừng nhận </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Th&ocirc;ng B&aacute;o Việc L&agrave;m</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">, bạn click chọn &ocirc; </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Tạm thời ngừng nhận th&ocirc;ng b&aacute;o việc l&agrave;m</span><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">rồi nhấp n&uacute;t </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Cập nhật </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">b&ecirc;n dưới</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;margin-left: 36pt;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">+ Bất cứ khi n&agrave;o bạn muốn nhận lại Th&ocirc;ng B&aacute;o Việc L&agrave;m, bạn chỉ cần nhấp chuột bỏ chọn &ocirc; </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Tạm thời ngừng nhận th&ocirc;ng b&aacute;o việc l&agrave;m</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> v&agrave; nhấp n&uacute;t </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Cập nhật b&ecirc;n </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">dưới l&agrave; xong.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">T&ocirc;i muốn biết th&ecirc;m c&aacute;c th&ocirc;ng tin kh&aacute;c ngo&agrave;i th&ocirc;ng tin ghi tr&ecirc;n mẫu Tuyển Dụng, đặc biệt l&agrave; th&ocirc;ng tin li&ecirc;n hệ của nh&agrave; tuyển dụng </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Nh&agrave; tuyển dụng thường chỉ cung cấp những th&ocirc;ng tin họ muốn người t&igrave;m việc cần biết. </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">C&aacute;c th&ocirc;ng tin kh&aacute;c về mức lương, thưởng, ch&iacute;nh s&aacute;ch chế độ&hellip; nếu kh&ocirc;ng được đăng tải tức l&agrave; nh&agrave; tuyển dụng sẽ chỉ trao đổi với ứng vi&ecirc;n khi tiến h&agrave;nh phỏng vấn. </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Nếu ứng vi&ecirc;n muốn hỏi xem với học vấn, kinh nghiệm của m&igrave;nh liệu c&oacute; ph&ugrave; hợp với vị tr&iacute; đăng tuyển kh&ocirc;ng&hellip; th&igrave; ứng vi&ecirc;n vẫn cứ gửi hồ sơ cho nh&agrave; tuyển dụng, họ sẽ xem x&eacute;t nếu kh&ocirc;ng ph&ugrave; hợp vị tr&iacute; n&agrave;y sẽ mời bạn ứng tuyển vị tr&iacute; kh&aacute;c ph&ugrave; hợp với học vấn v&agrave; kinh nghiệm hiện tại của bạn hoặc lưu lại hồ sơ cho đợt tuyển dụng sau. </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Th&ocirc;ng tin li&ecirc;n hệ của nh&agrave; tuyển dụng sẽ kh&ocirc;ng được c&ocirc;ng bố v&igrave; l&yacute; do tr&aacute;nh spam v&agrave; quảng c&aacute;o.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<strong style="line-height: 1.38;"><span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Xem những c&ocirc;ng việc m&agrave; t&ocirc;i đ&atilde; lưu lại hoặc đ&atilde; nộp đơn ứng tuyển</span></span></strong></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Bạn c&oacute; thể xem những c&ocirc;ng việc m&agrave; bạn đ&atilde; lưu lại hoặc đ&atilde; nộp đơn bằng c&aacute;ch đăng nhập v&agrave;o t&agrave;i khoản của bạn v&agrave; nhấp chuột v&agrave;o mục </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Việc l&agrave;m đ&atilde; lưu/ Đ&atilde; ứng tuyển</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<strong style="line-height: 1.38;"><span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Nếu thấy nh&agrave; tuyển dụng đăng tin kh&ocirc;ng đ&uacute;ng sự thật v&agrave; thu ph&iacute; của ứng vi&ecirc;n</span></span></strong></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Nếu thấy c&ocirc;ng việc đăng tải kh&ocirc;ng đ&uacute;ng với sự thật hoặc nh&agrave; tuyển dụng y&ecirc;u cầu ứng vi&ecirc;n nộp ph&iacute; giới thiệu việc l&agrave;m. Vui l&ograve;ng b&aacute;o ngay cho ch&uacute;ng t&ocirc;i qua hotline hoặc email để xử l&yacute; một c&aacute;ch triệt để nhằm bảo vệ người t&igrave;m việc. </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;">\n	<strong><span style="text-align: justify; font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">2/ T&Agrave;I KHOẢN</span><span style="text-align: justify; font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"><span class="Apple-tab-span" style="white-space:pre;"> </span></span></strong></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;">\n	<strong style="line-height: 1.38; text-align: justify;"><span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Qu&ecirc;n t&ecirc;n đăng nhập (username) v&agrave; mật khẩu (password) </span></span></strong></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Click v&agrave;o mục </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Cho người t&igrave;m việc</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">, v&agrave;o phần </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Đăng nhập</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">, nhấp v&agrave;o &quot;</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Qu&ecirc;n Password</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">&quot; v&agrave; cung cấp cho ch&uacute;ng t&ocirc;i địa chỉ email đ&atilde; đăng k&yacute; trước đ&acirc;y của bạn, ch&uacute;ng t&ocirc;i sẽ gửi t&ecirc;n đăng nhập v&agrave; mật khẩu v&agrave;o địa chỉ email của bạn.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<strong style="line-height: 1.38;"><span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Để thay đổi địa chỉ email đăng nhập hoặc mật khẩu (password) </span></span></strong></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Bạn cần đăng nhập v&agrave;o t&agrave;i khoản </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Cho người t&igrave;m việc</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">, sau đ&oacute; nhấp chuột v&agrave;o mục </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">T&agrave;i Khoản</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">. Bạn click v&agrave;o chỉnh sửa c&aacute;c th&ocirc;ng tin tại đ&acirc;y v&agrave; xuống cuối trang click v&agrave;o </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Cập nhật</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> để x&aacute;c nhận những thay đổi đ&oacute; đồng thời lưu lại th&ocirc;ng tin vừa thay đổi.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<strong style="line-height: 1.38;"><span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">3/ HỒ SƠ T&Igrave;M VIỆC</span></span></strong></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">T&ocirc;i muốn đăng hồ sơ nhưng lại kh&ocirc;ng muốn C&ocirc;ng ty hiện tại nh&igrave;n thấy</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Bạn v&agrave;o mục </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Ứng vi&ecirc;n Đăng hồ sơ</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> ở trang chủ</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 176, 80); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">, </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">nhấp chọn</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 176, 80); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Muốn bảo mật th&ocirc;ng tin c&aacute; nh&acirc;n, đăng k&yacute; hồ sơ tại đ&acirc;y </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Ở mục n&agrave;y bạn c&oacute; thể đăng hồ sơ </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">nhưng c&aacute;c th&ocirc;ng tin về</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> : </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Họ t&ecirc;n, điện thoại, địa chỉ của bạn, t&ecirc;n C&ocirc;ng ty đang l&agrave;m việc sẽ được ẩn, nh&agrave; tuyển dụng chỉ nh&igrave;n thấy v&agrave; li&ecirc;n hệ với bạn qua email. </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Những th&ocirc;ng tin bạn kh&ocirc;ng muốn người đọc nh&igrave;n thấy, h&atilde;y g&otilde; v&agrave;o &quot;BẢO MẬT&quot;. Nhưng bạn phải kiểm tra email thường xuy&ecirc;n để giữ li&ecirc;n lạc với nh&agrave; tuyển dụng.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<strong style="line-height: 1.38;"><span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">T&ocirc;i kh&ocirc;ng muốn nh&agrave; tuyển dụng t&igrave;m thấy hồ sơ của m&igrave;nh</span></span></strong></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">V&agrave;o mục </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Cho</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Người t&igrave;m việc</span><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">ở đầu trang chủ, đăng nhập v&agrave;o t&agrave;i khoản, nhấp chọn </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Đăng hồ sơ. </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Sau khi nhập dữ liệu hồ sơ, bạn chọn</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> Kh&ocirc;ng cho ph&eacute;p t&igrave;m kiếm hồ sơ.</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Tuy nhi&ecirc;n hồ sơ của bạn vẫn được lưu giữ trong dữ liệu của ch&uacute;ng t&ocirc;i v&agrave; bạn c&oacute; thể gửi n&oacute; cho nh&agrave; tuyển dụng khi n&agrave;o bạn nộp tr&ecirc;n mạng.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Nhưng ch&uacute;ng t&ocirc;i khuy&ecirc;n bạn muốn bảo mật n&ecirc;n chọn Kh&ocirc;ng cho ph&eacute;p t&igrave;m kiếm Họ t&ecirc;n, số ĐT, địa chỉ hoặc c&oacute; thể ghi t&ecirc;n </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Cty hiện tại l&agrave; Bảo Mật</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> v&igrave; như vậy bạn sẽ nhận được nhiều cơ hội nghề nghiệp m&agrave; kh&ocirc;ng phải l&uacute;c n&agrave;o cũng c&oacute;.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<strong style="line-height: 1.38;"><span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">T&ocirc;i muốn thay đổi trạng th&aacute;i Bảo Mật hồ sơ </span></span></strong></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Đăng nhập v&agrave;o t&agrave;i khoản của bạn v&agrave; nhấp chuột v&agrave;o </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Chỉnh sửa/ X&oacute;a hồ sơ/ L&agrave;m mới tin</span><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;margin-left: 36pt;text-indent: -18pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">1. Nhấp v&agrave;o </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Chỉnh sửa hồ sơ</span><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">v&agrave; chọn thay đổi t&igrave;nh trạng bảo mật ở ph&iacute;a dưới trang</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;margin-left: 36pt;text-indent: -18pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">2. Nhấp v&agrave;o </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Lưu Hồ Sơ</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">.</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"><span class="Apple-tab-span" style="white-space:pre;"> </span></span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">T&ocirc;i muốn thay đổi số điện thoại ghi trong Hồ sơ</span><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Đăng nhập v&agrave;o t&agrave;i khoản của bạn v&agrave; nhấp chuột v&agrave;o </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Chỉnh sửa/ X&oacute;a hồ sơ/ L&agrave;m mới tin </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;margin-left: 36pt;text-indent: -18pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">1. Nhấp v&agrave;o </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Chỉnh sửa hồ sơ</span><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">v&agrave; thay đổi số điện thoại b&ecirc;n dưới</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;margin-left: 36pt;text-indent: -18pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">2. Nhấp v&agrave;o </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Lưu Hồ Sơ</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> ở cuối trang.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">T&ocirc;i muốn thay đổi ng&agrave;nh nghề mong muốn trong hồ sơ</span><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Đăng nhập v&agrave;o t&agrave;i khoản của bạn v&agrave; nhấp chuột v&agrave;o </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Chỉnh sửa/ X&oacute;a hồ sơ/ L&agrave;m mới tin </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;margin-left: 36pt;text-indent: -18pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">1. Nhấp v&agrave;o </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Chỉnh sửa hồ sơ </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;margin-left: 36pt;text-indent: -18pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">2. Trong </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Ng&agrave;nh Nghề Mong Muốn</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">, x&oacute;a ng&agrave;nh nghề hiện tại bằng c&aacute;ch nhấp chọn ng&agrave;nh nghề hiện tại v&agrave; nhấn n&uacute;t &lt;&lt;, sau đ&oacute; th&ecirc;m lĩnh vực mới bằng c&aacute;ch chọn ng&agrave;nh nghề mới v&agrave; nhấn n&uacute;t &gt;&gt;.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;margin-left: 36pt;text-indent: -18pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">3. Nhấp v&agrave;o Lưu Hồ Sơ ở cuối trang.</span></span></p>\n<p dir="ltr" style="line-height: 1.38; margin-top: 14pt; margin-bottom: 4pt; text-align: justify;">\n	<strong><span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Số lượt nh&agrave; tuyển dụng xem Hồ sơ ứng tuyển của t&ocirc;i </span></span></strong></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Bạn c&oacute; thể xem tổng số lượt nh&agrave; tuyển dụng xem Hồ sơ của bạn bằng c&aacute;ch đăng nhập v&agrave;o t&agrave;i khoản của bạn v&agrave; nhấp chuột v&agrave;o mục </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Nh&agrave; tuyển dụng xem hồ sơ</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Tuy nhi&ecirc;n nếu bạn nộp đơn online, nh&agrave; tuyển dụng nhận hồ sơ trực tiếp của bạn qua email v&agrave; trong trường hợp n&agrave;y kh&ocirc;ng thể đếm được. Nhưng chắc chắn l&agrave; hồ sơ của bạn vẫn được đưa đến nh&agrave; tuyển dụng sau khi bạn nhấn n&uacute;t </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Nộp đơn</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<strong style="line-height: 1.38;"><span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">T&ocirc;i kh&ocirc;ng thấy nh&agrave; tuyển dụng xem hồ sơ của t&ocirc;i. T&ocirc;i cần chỉnh sửa g&igrave;</span></span></strong></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">H&atilde;y đảm bảo l&agrave; Hồ sơ của bạn ở trạng th&aacute;i </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Cho ph&eacute;p nh&agrave; tuyển dụng t&igrave;m kiếm,</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> h&atilde;y Đăng nhập v&agrave; v&agrave;o mục </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Chỉnh sửa hồ sơ</span><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">để kiểm tra v&agrave; chỉnh sửa lại trạng th&aacute;i hồ sơ.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Sau đ&oacute; v&agrave;o </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Chỉnh sửa/ X&oacute;a hồ sơ/ L&agrave;m mới tin,</span><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">nhấp chuột v&agrave;o </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">L&agrave;m mới tin</span><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">để l&agrave;m mới HS v&agrave; n&oacute; sẽ được đưa l&ecirc;n trang đầu để nh&agrave; tuyển dụng dễ d&agrave;ng t&igrave;m thấy bạn.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span style="color: rgb(0, 0, 0); font-family: Arial; font-size: 17.3333px; font-weight: 700; white-space: pre-wrap; line-height: 1.38; background-color: transparent;">L&agrave;m thế n&agrave;o để x&oacute;a hồ sơ đ&atilde; đăng</span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span style="color: rgb(0, 0, 0); font-family: Arial; font-size: 16px; white-space: pre-wrap; line-height: 1.38; background-color: transparent;">X&oacute;a hồ sơ l&agrave; việc kh&ocirc;ng cần thiết, ngay cả khi bạn đ&atilde; t&igrave;m được việc l&agrave;m. Bạn chỉ cần thay đổi trạng th&aacute;i Bảo Mật hồ sơ l&agrave; nh&agrave; tuyển dụng kh&ocirc;ng nh&igrave;n thấy hồ sơ của bạn.</span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:5pt;margin-bottom:5pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Đăng nhập v&agrave;o t&agrave;i khoản của bạn v&agrave; nhấp chuột v&agrave;o </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Chỉnh sửa/ X&oacute;a hồ sơ/ L&agrave;m mới tin </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:6pt;margin-bottom:6pt;margin-left: 36pt;text-indent: -18pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">1. Nhấp v&agrave;o </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Chỉnh sửa hồ sơ</span><span style="font-size: 16px; font-family: Arial; color: rgb(255, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:6pt;margin-bottom:6pt;margin-left: 36pt;text-indent: -18pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">2. Chọn </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Kh&ocirc;ng cho ph&eacute;p t&igrave;m kiếm hồ sơ </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">ở ph&iacute;a dưới trang</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:6pt;margin-left: 36pt;text-indent: -18pt;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">3. Nhấp v&agrave;o </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Lưu Hồ Sơ</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:6pt;margin-left: 36pt;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">* </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Như vậy nh&agrave; tuyển dụng kh&ocirc;ng t&igrave;m thấy hồ sơ của bạn</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">D&Agrave;NH CHO NH&Agrave; TUYỂN DỤNG</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">1/ Kh&ocirc;ng đăng tải những c&ocirc;ng việc đ&ograve;i hỏi người t&igrave;m việc phải trả ph&iacute; trước khi l&agrave;m việc.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">2/</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> </span><span style="font-size: 17.3333px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Để mở t&agrave;i khoản sử dụng tr&ecirc;n Workspharma.com</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:6pt;margin-bottom:6pt;margin-left: 40pt;text-indent: -18pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">1. Tr&ecirc;n trang chủ </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Workspharma.com</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">, nhấp v&agrave;o n&uacute;t </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Đăng k&yacute;</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"> ở g&oacute;c tr&ecirc;n b&ecirc;n phải.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:6pt;margin-bottom:6pt;margin-left: 40pt;text-indent: -18pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">2. Sau khi điền đầy đủ th&ocirc;ng tin y&ecirc;u cầu, bạn nhấp n&uacute;t </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); font-weight: 700; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Đăng k&yacute; ngay.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:6pt;margin-bottom:6pt;margin-left: 40pt;text-indent: -18pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">3. Khi trang x&aacute;c nhận đăng k&yacute; t&agrave;i khoản th&agrave;nh c&ocirc;ng hiện ra, một email hướng dẫn k&iacute;ch hoạt đ&atilde; được gửi v&agrave;o địa chỉ email của bạn.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:6pt;margin-bottom:6pt;margin-left: 40pt;text-indent: -18pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce4a-9142-ed70-b9fe81a076db"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">4. Bạn mở email của ch&uacute;ng t&ocirc;i gửi v&agrave; nhấp v&agrave;o đường link trong email để k&iacute;ch hoạt t&agrave;i khoản sử dụng. (Bạn h&atilde;y kiểm tra cả trong thư mục Junk/Spam/Bulk, nếu vẫn kh&ocirc;ng nhận được email, h&atilde;y li&ecirc;n hệ với ch&uacute;ng t&ocirc;i </span></span></p>\n', 1, 0, 0, '2015-11-04 23:09:49', 0, 0, 'Trợ giúp', 'Trợ giúp', 'Trợ giúp', 1);
INSERT INTO `pt_articles` (`idArticles`, `catid`, `related_articles`, `alias_articles`, `alias_en_articles`, `ordering_articles`, `title_en_articles`, `title_articles`, `thumb_articles`, `introtext_articles`, `introtext_en_articles`, `fulltext_en_articles`, `fulltext_articles`, `hits_articles`, `is_new_articles`, `is_top_news`, `created_articles`, `love`, `created_by_articles`, `meta_title_articles`, `meta_key_articles`, `meta_desc_articles`, `enable_articles`) VALUES
(86, 0, '0', '', '', 0, '0', '0', '', '0', '0', '0', '0', 1, 0, 0, '2015-09-10 22:24:20', 0, 0, '0', '0', '0', 0),
(87, 33, '0', 'lien-he', '', 1, '', 'Liên hệ', '', 'Liên hệ', '', '', '<p>\n	<span style="font-size:16px;"><strong>Để biết th&ecirc;m chi tiết xin vui l&ograve;ng li&ecirc;n hệ : </strong></span></p>\n<p>\n	<strong>Email</strong> : contact@workspharma.com</p>\n<p>\n	<strong>ĐT</strong> : 0982 11 83 43</p>\n<p>\n	<strong>ĐC</strong> : 73 Tan Hoa, District 6, HCMC, Vietnam</p>\n', 1, 0, 0, '2015-11-04 22:26:46', 0, 0, 'Liên hệ', 'Liên hệ', 'Liên hệ', 1),
(88, 0, '0', '', '', 0, '0', '0', '', '0', '0', '0', '0', 1, 0, 0, '2015-09-20 11:11:36', 0, 0, '0', '0', '0', 0),
(89, 34, '0', 'dich-vu', '', 1, '', 'Dịch vụ', '', 'Với lượng truy cập và dữ liệu hồ sơ ứng viên phong phú, chúng tôi tin rằng Workspharma.com sẽ kết nối hiệu quả giữa nhu cầu Tuyển dụng của thị trường và Ứng viên.', '', '', '<p>\n	<strong>Workspharma.com</strong> l&agrave; website chuy&ecirc;n tuyển dụng lĩnh vực <span style="color:#ff0000;"><strong>Y Dược - C&ocirc;ng Nghệ Sinh Học &ndash; H&oacute;a Học</strong></span> ho&agrave;n to&agrave;n miễn ph&iacute;</p>\n<p>\n	Với lượng truy cập v&agrave; dữ liệu hồ sơ ứng vi&ecirc;n phong ph&uacute;, ch&uacute;ng t&ocirc;i tin rằng <strong>Workspharma.com sẽ</strong> kết nối hiệu quả giữa nhu cầu Tuyển dụng của thị trường v&agrave; Ứng vi&ecirc;n.</p>\n<p>\n	Đăng tuyển dụng : nhanh ch&oacute;ng v&agrave; dễ d&agrave;ng, sau khi Nh&agrave; tuyển dụng Đăng k&yacute; t&agrave;i khoản, <strong>Workspharma.com</strong> sẽ duyệt v&agrave; k&iacute;chhoạt t&agrave;i khoản trong v&ograve;ng 8h. Ngay lập tức, bạn c&oacute; thể đăng tất cả tin tuyển dụng của m&igrave;nh l&ecirc;n website một c&aacute;ch nhanh ch&oacute;ng v&agrave; thuận tiện nhất.</p>\n<p>\n	T&igrave;m hồ sơ : Nh&agrave; tuyển dụng dễ d&agrave;ng truy cập v&agrave; t&igrave;m thấy Hồ sơ ứng vi&ecirc;n đăng l&ecirc;n mỗi ng&agrave;y v&agrave; lu&ocirc;n được cập nhật thường xuy&ecirc;n.</p>\n<p>\n	Với nguồn dữ liệu ứng vi&ecirc;n sẵn c&oacute;, ch&uacute;ng t&ocirc;i sẽ tận t&acirc;m lựa chọn v&agrave; kết nối Ứng vi&ecirc;n ph&ugrave; hợp với nhu cầu của Nh&agrave; tuyển dụng nhằm gi&uacute;p Doanh nghiệp được vận h&agrave;nh một c&aacute;ch tối ưu nhất.</p>\n<p>\n	Nguồn ứng vi&ecirc;n :</p>\n<p>\n	- Y, Dược, C&ocirc;ng Nghệ Sinh Học, H&oacute;a Học</p>\n<p>\n	- Sản Xuất v&agrave; Khối Hỗ Trợ Gi&aacute;n Tiếp : R&amp;D, Sản xuất, B&aacute;n h&agrave;ng/ Kinh doanh, Kế to&aacute;n, Nh&acirc;n sự/ Luật, H&agrave;nh ch&iacute;nh/ Thư k&yacute;/ Hồ sơ thầu, Dịch vụ kh&aacute;ch h&agrave;ng/ Sales admin, Marketing/ Digital/ Design/ PR, Quản l&yacute; chất lượng, Quản trị mạng/ Lập tr&igrave;nh vi&ecirc;n, Xuất nhập khẩu/ KD quốc tế, Bi&ecirc;n phi&ecirc;n dịch, Cung ứng/ Mua h&agrave;ng, Bảo tr&igrave;/ Kỹ thuật hạ tầng, T&agrave;i xế/ Giao h&agrave;ng, Kho vận/ Vật tư</p>\n', 1, 0, 0, '2015-11-04 23:08:55', 0, 0, 'Dịch vụ', 'Dịch vụ', 'Dịch vụ', 1),
(90, 35, '0', 'the-nao-la-mot-ung-vien-chuyen-nghiep', '', 4, '', 'Thế nào là một Ứng viên chuyên nghiệp', '', 'Nhiều ứng viên thích tạo những email cá nhân theo nick-name kiểu như: hotboydeptrai@gmail..., hay girldethuong@yahoo..., ... và khi gửi hồ sơ cho nhà tuyển dụng, họ cũng gửi từ địa chỉ này. Có thể, bạn nghĩ rằng, địa chỉ đó chỉ toát lên sự thông minh, nhí nhảnh đáng yêu của bạn, cho mọi người dễ nhớ đến bạn.', '', '', '<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce50-8102-9854-59ade5003e57"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">Để được </span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 51, 204); vertical-align: baseline; white-space: pre-wrap;">nh&agrave; tuyển dụng đ&aacute;nh gi&aacute; l&agrave; chuy&ecirc;n nghiệp</span><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">, bạn cần tr&aacute;nh c&aacute;c điều sau :</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce50-8102-9854-59ade5003e57"><span style="font-size: 16px; font-family: Arial; color: rgb(194, 88, 17); vertical-align: baseline; white-space: pre-wrap;">- Sử dụng địa chỉ email kiểu &quot;trẻ con&quot;, kh&ocirc;ng mang t&iacute;nh c&ocirc;ng việc</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span style="color: rgb(0, 0, 0); font-family: Arial; font-size: 16px; white-space: pre-wrap; line-height: 1.38;">Nhiều ứng vi&ecirc;n th&iacute;ch tạo những email c&aacute; nh&acirc;n theo nick-name kiểu như: hotboydeptrai@gmail..., hay girldethuong@yahoo..., ... v&agrave; khi gửi hồ sơ cho nh&agrave; tuyển dụng, họ cũng gửi từ địa chỉ n&agrave;y. C&oacute; thể, bạn nghĩ rằng, địa chỉ đ&oacute; chỉ to&aacute;t l&ecirc;n sự th&ocirc;ng minh, nh&iacute; nhảnh đ&aacute;ng y&ecirc;u của bạn, cho mọi người dễ nhớ đến bạn.</span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce50-8102-9854-59ade5003e57"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">Tuy nhi&ecirc;n, đ&oacute; lại l&agrave; một sai lầm &quot;chết người&quot; khi nh&agrave; tuyển dụng nh&igrave;n đến hồ sơ của bạn. Email đ&oacute; khiến người ta đ&aacute;nh gi&aacute; bạn thiếu chuy&ecirc;n nghiệp trong c&ocirc;ng việc, bởi những email đ&oacute; chỉ n&ecirc;n d&ugrave;ng v&agrave;o c&ocirc;ng việc c&aacute; nh&acirc;n m&agrave; th&ocirc;i. Họ sẽ lo ngại khi bạn về đầu qu&acirc;n cho c&ocirc;ng ty m&agrave; vẫn d&ugrave;ng những email trẻ con đ&oacute; khi l&agrave;m việc với kh&aacute;ch h&agrave;ng, đối t&aacute;c v&agrave; bạn dễ bị đ&aacute;nh trượt khỏi cuộc chơi.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce50-8102-9854-59ade5003e57"><span style="font-size: 16px; font-family: Arial; color: rgb(194, 88, 17); vertical-align: baseline; white-space: pre-wrap;">- Để lại tin nhắn thoại hoặc nhạc chờ kh&ocirc;ng ph&ugrave; hợp </span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce50-8102-9854-59ade5003e57"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">&quot;Hoặc l&agrave; đi uống bia, hoặc đi chơi... n&ecirc;n kh&ocirc;ng trả lời điện thoại. C&oacute; g&igrave; h&atilde;y để lại lời nhắn&quot; hoặc bản nhạc chờ với nội dung kh&ocirc;ng ph&ugrave; hợp khiến nh&agrave; tuyển dụng gọi đến hết muốn phỏng vấn bạn. Nhiều nh&agrave; tuyển dụng đồng &yacute; rằng, họ rất dị ứng với những ứng vi&ecirc;n như vậy v&agrave; tốt nhất l&agrave; n&ecirc;n gạt người n&agrave;y ra khỏi danh s&aacute;ch dự định ban đầu.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce50-8102-9854-59ade5003e57"><span style="font-size: 16px; font-family: Arial; color: rgb(194, 88, 17); vertical-align: baseline; white-space: pre-wrap;">- Kh&ocirc;ng kiểm tra lỗi ch&iacute;nh tả trong Hồ sơ v&agrave; Thư ứng tuyển</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce50-8102-9854-59ade5003e57"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">Nhiều ứng vi&ecirc;n chủ quan sẽ kh&ocirc;ng mắc lỗi ch&iacute;nh tả, đ&aacute;nh m&aacute;y trong hồ sơ, m&agrave; nếu c&oacute; v&agrave;i lỗi cũng kh&ocirc;ng vấn đề g&igrave; bởi ai chẳng c&oacute; l&uacute;c mắc sai lầm, kể cả nh&agrave; tuyển dụng cũng vậy. Hơn nữa, v&agrave;i lỗi ch&iacute;nh tả chỉ l&agrave; chuyện nhỏ, kh&ocirc;ng c&oacute; g&igrave; phải quan trọng h&oacute;a. Nh&agrave; tuyển dụng sẽ kh&ocirc;ng ch&uacute; &yacute; đến điều đ&oacute;.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce50-8102-9854-59ade5003e57"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">Thực tế, đ&oacute; l&agrave; c&aacute;ch nghĩ sai lầm. Tất nhi&ecirc;n, ai cũng c&oacute; l&uacute;c mắc sai lầm, thậm ch&iacute; l&agrave; nh&agrave; tuyển dụng nhưng những sai lầm nhỏ trong CV hay thư xin việc l&agrave; điều kh&ocirc;ng thể chấp nhận được. Điều đ&oacute; chứng tỏ sự cẩu thả, thiếu t&ocirc;n trọng nh&agrave; tuyển dụng của ứng vi&ecirc;n v&agrave; lo lắng của nh&agrave; tuyển dụng l&agrave; ho&agrave;n to&agrave;n c&oacute; l&yacute; &quot;ai biết ứng vi&ecirc;n n&agrave;y c&oacute; mắc sai lầm trong c&aacute;c b&aacute;o c&aacute;o t&agrave;i ch&iacute;nh của c&ocirc;ng ty hay những văn bản, t&agrave;i liệu c&ocirc;ng việc quan trọng. Tốt nhất l&agrave; chọn ứng vi&ecirc;n kh&aacute;c v&igrave; ch&uacute;ng t&ocirc;i cần những người tỉ mỉ, cẩn thận, chu đ&aacute;o&quot;.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce50-8102-9854-59ade5003e57"><span style="font-size: 16px; font-family: Arial; color: rgb(194, 88, 17); vertical-align: baseline; white-space: pre-wrap;">- Kh&ocirc;ng t&igrave;m hiểu kỹ về c&ocirc;ng ty trước khi dự phỏng vấn</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce50-8102-9854-59ade5003e57"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">C&oacute; thể, bạn nghĩ rằng, nh&agrave; tuyển dụng đ&atilde; tường tận về mọi việc của c&ocirc;ng ty, chẳng việc g&igrave; phải hỏi bạn nữa. Thế nhưng, đ&acirc;y cũng l&agrave; những nội dung cơ bản nh&agrave; tuyển dụng sẽ hỏi trong khi phỏng vấn v&agrave; nếu kh&ocirc;ng t&igrave;m hiểu, bạn sẽ chẳng biết trả lời thế n&agrave;o.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce50-8102-9854-59ade5003e57"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">Nh&agrave; tuyển dụng sẽ đ&aacute;nh gi&aacute; bạn chẳng biết g&igrave; về c&ocirc;ng ty, cũng kh&ocirc;ng nỗ lực t&igrave;m hiểu về c&ocirc;ng ty. Điều đ&oacute; chứng tỏ bạn kh&ocirc;ng thực sự quan t&acirc;m đến c&ocirc;ng ty cũng như kh&ocirc;ng thực sự y&ecirc;u th&iacute;ch vị tr&iacute; c&ocirc;ng việc họ đang tuyển v&agrave; sai lầm n&agrave;y ho&agrave;n to&agrave;n bất lợi cho bạn bởi nh&agrave; tuyển dụng bao giờ cũng th&iacute;ch c&oacute; những ứng vi&ecirc;n thực sự quan t&acirc;m đến c&ocirc;ng việc, y&ecirc;u th&iacute;ch c&ocirc;ng việc của họ. Họ sẽ bỏ qua bạn ngay lập tức.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce50-8102-9854-59ade5003e57"><span style="font-size: 16px; font-family: Arial; color: rgb(194, 88, 17); vertical-align: baseline; white-space: pre-wrap;">- Kh&ocirc;ng gửi thư cảm ơn sau khi phỏng vấn</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce50-8102-9854-59ade5003e57"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap;">Sai lầm n&agrave;y khiến nh&agrave; tuyển dụng đ&aacute;nh gi&aacute; bạn thiếu kỹ năng ứng xử v&agrave; ph&eacute;p lịch sự tối thiểu hoặc &iacute;t nhất l&agrave; bạn kh&ocirc;ng mấy quan t&acirc;m đến vị tr&iacute; ứng tuyển. Điều đ&oacute; khiến nh&agrave; tuyển dụng mất thiện cảm với bạn v&agrave; so với những ứng vi&ecirc;n gửi thư cảm ơn sau buổi phỏng vấn, r&otilde; r&agrave;ng, bạn đ&atilde; bị mất điểm đ&aacute;ng kể.</span></span></p>\n<p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;text-align: justify;">\n	<span id="docs-internal-guid-7d99cad2-ce50-8102-9854-59ade5003e57"><span style="font-size: 16px; font-family: Arial; color: rgb(0, 0, 0); vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Theo Hải Như (Bưu Điện Việt Nam) </span></span></p>\n', 1, 0, 0, '2015-11-04 23:11:59', 0, 0, 'Thế nào là một Ứng viên chuyên nghiệp', 'Thế nào là một Ứng viên chuyên nghiệp', 'Thế nào là một Ứng viên chuyên nghiệp', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pt_articles_categories`
--

CREATE TABLE IF NOT EXISTS `pt_articles_categories` (
  `idArticlesCategories` int(11) NOT NULL AUTO_INCREMENT,
  `parentid` int(11) NOT NULL DEFAULT '0',
  `ordering_articles_categories` int(5) NOT NULL DEFAULT '0',
  `name_en_articles_categories` varchar(200) NOT NULL,
  `name_articles_categories` varchar(250) NOT NULL,
  `alias_articles_categories` varchar(255) NOT NULL,
  `alias_en_articles_categories` varchar(255) NOT NULL,
  `description_articles_categories` text NOT NULL,
  `description_en_articles_categories` varchar(50) NOT NULL DEFAULT '',
  `meta_title_articles_categories` varchar(255) NOT NULL,
  `meta_key_articles_categories` varchar(255) NOT NULL DEFAULT '',
  `meta_desc_articles_categories` varchar(255) NOT NULL DEFAULT '',
  `enable_articles_categories` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idArticlesCategories`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `pt_articles_categories`
--

INSERT INTO `pt_articles_categories` (`idArticlesCategories`, `parentid`, `ordering_articles_categories`, `name_en_articles_categories`, `name_articles_categories`, `alias_articles_categories`, `alias_en_articles_categories`, `description_articles_categories`, `description_en_articles_categories`, `meta_title_articles_categories`, `meta_key_articles_categories`, `meta_desc_articles_categories`, `enable_articles_categories`) VALUES
(30, 0, 0, 'Career tool', 'Cẩm nang tuyển dụng', 'cam-nang-tuyen-dung', 'career-tool', 'Cẩm nang tuyển dụng', 'Career tool', 'Cẩm nang tuyển dụng', 'Cẩm nang tuyển dụng', 'Cẩm nang tuyển dụng', 1),
(31, 0, 0, 'About Workspharma', 'Về workspharma', 've-workspharma', 'about-workspharma', 'Về workspharma', 'About Workspharma', 'Về workspharma', 'Về workspharma', 'Về workspharma', 1),
(32, 0, 0, 'Help', 'Trợ giúp', 'tro-giup', 'help', 'Trợ giúp', 'Help', 'Trợ giúp', 'Trợ giúp', 'Trợ giúp', 1),
(33, 0, 0, 'Contact', 'Liên hệ', 'lien-he', 'contact', '', 'Contact', 'Liên hệ', 'Liên hệ', 'Liên hệ', 1),
(34, 0, 0, 'Service', 'Dịch vụ', 'dich-vu', 'service', 'Dịch vụ', 'Service', 'Dịch vụ', 'Dịch vụ', 'Dịch vụ', 1),
(35, 0, 0, 'News', 'Tin tức', 'tin-tuc', 'news', 'Tin tức', 'News', 'Tin tức', 'Tin tức', 'Tin tức', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pt_blocks`
--

CREATE TABLE IF NOT EXISTS `pt_blocks` (
  `idBlocks` int(11) NOT NULL AUTO_INCREMENT,
  `name_blocks` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `title_blocks` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `showtitle_blocks` tinyint(1) NOT NULL,
  `html_content_blocks` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `limit_show` int(11) NOT NULL,
  `enable_blocks` tinyint(1) NOT NULL,
  PRIMARY KEY (`idBlocks`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=55 ;

-- --------------------------------------------------------

--
-- Table structure for table `pt_config`
--

CREATE TABLE IF NOT EXISTS `pt_config` (
  `idConfig` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idConfig`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Dumping data for table `pt_config`
--

INSERT INTO `pt_config` (`idConfig`, `name`, `value`) VALUES
(1, 'site_keyword_description', 'Workspharma - Miễn phí Tuyển dụng & Tìm việc Y Dược – Sinh – Hóa'),
(2, 'site_meta_description', 'Workspharma - Miễn phí Tuyển dụng & Tìm việc Y Dược – Sinh – Hóa'),
(3, 'site_title', 'Workspharma - Miễn phí Tuyển dụng & Tìm việc Y Dược – Sinh – Hóa'),
(9, 'cache', '1'),
(10, 'cache_exp_time', '15'),
(13, 'site_name', 'Workspharma - Miễn phí Tuyển dụng & Tìm việc Y Dược – Sinh – Hóa'),
(14, 'siteoffline', '0'),
(15, 'offlinemsg', 'Website đang tạm ngưng hoạt động để bảo trì, vui lòng truy cập lại sau.'),
(18, 'google analytic', '<script>\n  (function(i,s,o,g,r,a,m){i[''GoogleAnalyticsObject'']=r;i[r]=i[r]||function(){\n  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),\n  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)\n  })(window,document,''script'',''//www.google-analytics.com/analytics.js'',''ga'');\n\n  ga(''create'', ''UA-54128267-1'', ''auto'');\n  ga(''send'', ''pageview'');\n\n</script>'),
(19, 'author', 'http://www.workspharma.vn/'),
(20, 'contact', 'info@workspharma.vn'),
(21, 'copyright', 'workspharma.vn'),
(22, 'keywords', 'Workspharma - Miễn phí Tuyển dụng & Tìm việc Y Dược – Sinh – Hóa'),
(23, 'background', 'rgba(0,0,0,0.3)');

-- --------------------------------------------------------

--
-- Table structure for table `pt_contact`
--

CREATE TABLE IF NOT EXISTS `pt_contact` (
  `idContact` int(11) NOT NULL AUTO_INCREMENT,
  `name_contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_en_contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_en_contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `website_contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telephone_contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobilephone_contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fax_contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `yahoo_contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `skype_contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ordering_contact` int(11) NOT NULL,
  `enable_contact` int(11) NOT NULL,
  PRIMARY KEY (`idContact`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `pt_contact_config`
--

CREATE TABLE IF NOT EXISTS `pt_contact_config` (
  `idContactConfig` int(11) NOT NULL AUTO_INCREMENT,
  `infotext_contact_config` text NOT NULL,
  `infotext_en_contact_config` text NOT NULL,
  `image_contact_config` varchar(255) NOT NULL,
  `gmapcode_contact_config` text NOT NULL,
  `gmapcode1_contact_config` text NOT NULL,
  `sendto_contact_config` varchar(255) NOT NULL,
  `replycontent_contact_config` text NOT NULL,
  PRIMARY KEY (`idContactConfig`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `pt_languages`
--

CREATE TABLE IF NOT EXISTS `pt_languages` (
  `idLanguages` int(11) NOT NULL AUTO_INCREMENT,
  `code_languages` varchar(10) NOT NULL,
  `name_languages` varchar(255) NOT NULL,
  `default_languages` tinyint(1) NOT NULL DEFAULT '0',
  `enable_languages` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idLanguages`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `pt_languages`
--

INSERT INTO `pt_languages` (`idLanguages`, `code_languages`, `name_languages`, `default_languages`, `enable_languages`) VALUES
(6, '', 'Viet Nam', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pt_limitlogin`
--

CREATE TABLE IF NOT EXISTS `pt_limitlogin` (
  `idLimitLogin` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(100) NOT NULL,
  `numberlogin` int(11) NOT NULL,
  `time_first` datetime NOT NULL,
  `time_last` datetime NOT NULL,
  PRIMARY KEY (`idLimitLogin`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=102 ;

-- --------------------------------------------------------

--
-- Table structure for table `pt_logs`
--

CREATE TABLE IF NOT EXISTS `pt_logs` (
  `idLog` int(11) NOT NULL AUTO_INCREMENT,
  `name_log` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_log` datetime NOT NULL,
  `ip_log` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idLog`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=35 ;

--
-- Dumping data for table `pt_logs`
--

INSERT INTO `pt_logs` (`idLog`, `name_log`, `created_log`, `ip_log`) VALUES
(1, 'admin', '2015-06-22 20:08:32', '127.0.0.1'),
(2, 'admin', '2015-06-23 21:11:47', '127.0.0.1'),
(3, 'admin', '2015-08-21 21:13:26', '127.0.0.1'),
(4, 'admin', '2015-09-06 19:46:11', '127.0.0.1'),
(5, 'admin', '2015-09-08 21:20:15', '127.0.0.1'),
(6, 'admin', '2015-09-09 19:11:18', '127.0.0.1'),
(7, 'admin', '2015-09-10 21:41:50', '127.0.0.1'),
(8, 'admin', '2015-09-16 21:08:29', '127.0.0.1'),
(9, 'admin', '2015-09-17 21:21:05', '127.0.0.1'),
(10, 'admin', '2015-09-18 21:36:42', '127.0.0.1'),
(11, 'admin', '2015-09-19 09:58:59', '127.0.0.1'),
(12, 'admin', '2015-09-19 20:43:52', '127.0.0.1'),
(13, 'admin', '2015-09-20 10:34:33', '127.0.0.1'),
(14, 'admin', '2015-09-20 13:56:31', '127.0.0.1'),
(15, 'admin', '2015-09-21 20:57:03', '127.0.0.1'),
(16, 'admin', '2015-09-22 19:45:32', '127.0.0.1'),
(17, 'admin', '2015-09-23 20:34:21', '127.0.0.1'),
(18, 'admin', '2015-09-28 20:53:18', '127.0.0.1'),
(19, 'admin', '2015-09-29 21:25:01', '127.0.0.1'),
(20, 'admin', '2015-09-30 22:14:30', '127.0.0.1'),
(21, 'admin', '2015-10-01 20:39:38', '127.0.0.1'),
(22, 'admin', '2015-10-02 20:52:02', '127.0.0.1'),
(23, 'admin', '2015-10-03 10:39:24', '127.0.0.1'),
(24, 'admin', '2015-10-04 21:33:59', '127.0.0.1'),
(25, 'admin', '2015-10-29 13:27:45', '127.0.0.1'),
(26, 'admin', '2015-10-30 08:35:49', '127.0.0.1'),
(27, 'admin', '2015-10-30 13:09:20', '127.0.0.1'),
(28, 'admin', '2015-11-02 10:26:31', '127.0.0.1'),
(29, 'admin', '2015-11-02 23:54:53', '127.0.0.1'),
(30, 'admin', '2015-11-03 23:37:12', '127.0.0.1'),
(31, 'admin', '2015-11-04 22:12:36', '127.0.0.1'),
(32, 'admin', '2015-11-19 13:57:06', '127.0.0.1'),
(33, 'admin', '2015-11-21 22:19:47', '127.0.0.1'),
(34, 'admin', '2015-11-27 08:23:46', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `pt_products`
--

CREATE TABLE IF NOT EXISTS `pt_products` (
  `idProducts` int(11) NOT NULL AUTO_INCREMENT,
  `code_products` varchar(30) NOT NULL DEFAULT '',
  `catid` int(11) NOT NULL DEFAULT '0',
  `parentid` int(11) NOT NULL DEFAULT '0',
  `ordering_products` int(5) NOT NULL DEFAULT '0',
  `name_en_products` varchar(200) NOT NULL,
  `name_products` varchar(250) NOT NULL,
  `is_new_products` tinyint(1) NOT NULL DEFAULT '0',
  `is_have_price` int(11) NOT NULL,
  `thumb_products` varchar(250) NOT NULL,
  `fullimage1_products` varchar(255) NOT NULL,
  `fullimage2_products` varchar(255) NOT NULL,
  `fullimage3_products` varchar(255) NOT NULL,
  `fullimage4_products` varchar(255) NOT NULL,
  `fullimage5_products` varchar(255) NOT NULL,
  `fullimage6_products` varchar(255) NOT NULL,
  `fullimage7_products` varchar(255) NOT NULL,
  `fullimage8_products` varchar(255) NOT NULL,
  `fullimage9_products` varchar(255) NOT NULL,
  `fullimage10_products` varchar(255) NOT NULL,
  `fullimage11_products` varchar(255) NOT NULL,
  `fullimage12_products` varchar(255) NOT NULL,
  `fullimage13_products` varchar(255) NOT NULL,
  `fullimage14_products` varchar(255) NOT NULL,
  `fullimage15_products` varchar(255) NOT NULL,
  `fullimage16_products` varchar(255) NOT NULL,
  `fullimage17_products` varchar(255) NOT NULL,
  `fullimage18_products` varchar(255) NOT NULL,
  `fullimage19_products` varchar(255) NOT NULL,
  `fullimage20_products` varchar(255) NOT NULL,
  `color_products` varchar(250) NOT NULL,
  `color_en_products` varchar(255) NOT NULL,
  `mid` text NOT NULL,
  `price_products` int(11) NOT NULL DEFAULT '0',
  `price_sale_products` varchar(255) NOT NULL,
  `is_typcial_products` tinyint(4) NOT NULL,
  `quantily_products` int(11) NOT NULL,
  `description_en_products` text NOT NULL,
  `description_products` text NOT NULL,
  `hits_products` int(11) NOT NULL DEFAULT '0',
  `related_products` varchar(255) NOT NULL,
  `alias_products` varchar(255) NOT NULL,
  `alias_en_products` varchar(255) NOT NULL,
  `short_desc_products` varchar(255) NOT NULL,
  `short_desc_en_products` varchar(255) NOT NULL,
  `hover_products` text NOT NULL,
  `hover_en_products` text NOT NULL,
  `fullimage_products` varchar(255) NOT NULL,
  `created_products` date NOT NULL,
  `created_by_products` int(11) NOT NULL,
  `is_sale_products` int(11) NOT NULL,
  `is_empty_products` int(11) NOT NULL,
  `is_default_products` int(11) NOT NULL,
  `meta_title_products` varchar(265) NOT NULL,
  `meta_key_products` varchar(244) NOT NULL,
  `meta_desc_products` text NOT NULL,
  `enable_products` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idProducts`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=333 ;

-- --------------------------------------------------------

--
-- Table structure for table `pt_slideshow`
--

CREATE TABLE IF NOT EXISTS `pt_slideshow` (
  `idSlideshow` int(11) NOT NULL AUTO_INCREMENT,
  `image_slide_show` varchar(255) NOT NULL,
  `url_slide_show` varchar(255) NOT NULL,
  `text_slide_show` text NOT NULL,
  `ordering_slide_show` int(11) NOT NULL,
  `enable_slide_show` int(11) NOT NULL,
  PRIMARY KEY (`idSlideshow`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `pt_slideshow`
--

INSERT INTO `pt_slideshow` (`idSlideshow`, `image_slide_show`, `url_slide_show`, `text_slide_show`, `ordering_slide_show`, `enable_slide_show`) VALUES
(18, '11435068753.png', '', 'Workspharma slider 1', 1, 1),
(19, '21435068756.png', '', 'Workspharma slider 3', 3, 1),
(20, '31435068759.png', '', 'Workspharma slider 2', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pt_support_online`
--

CREATE TABLE IF NOT EXISTS `pt_support_online` (
  `idSupportOnline` int(11) NOT NULL AUTO_INCREMENT,
  `name_support_online` varchar(255) NOT NULL,
  `phone_support_online` varchar(12) NOT NULL,
  `skype_support_online` varchar(255) NOT NULL,
  `email_support_online` varchar(255) NOT NULL,
  `time_support_online` varchar(255) NOT NULL,
  `yahoo_support_online` varchar(255) NOT NULL,
  `ordering_support_online` int(11) NOT NULL,
  `enable_support_online` int(11) NOT NULL,
  PRIMARY KEY (`idSupportOnline`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` int(13) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `value`, `created`) VALUES
(1, 'Your mother''s maiden name', 0),
(2, 'The name of your elementary school', 0),
(3, 'Your first pet''s name', 0),
(4, 'Your elementary school mascot', 0),
(5, 'Your best friend''s nickname', 0),
(6, 'Your favorite sports team', 0),
(7, 'Your favorite writer', 0),
(8, 'Your favorite actor', 0),
(9, 'Your favorite singer', 0),
(10, 'Your favorite song', 0),
(11, 'The name of the street you grew up on', 0),
(12, 'Make and model of your first car', 0),
(13, 'The city where you first met your spouse', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rating_hold`
--

CREATE TABLE IF NOT EXISTS `rating_hold` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `resume`
--

CREATE TABLE IF NOT EXISTS `resume` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `display_name_resume` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `birthday` int(11) NOT NULL,
  `gender` int(11) NOT NULL,
  `marital` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `country` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `district` int(11) NOT NULL,
  `cellPhone` varchar(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `visible_to_employer` int(11) NOT NULL,
  `no_experience` int(11) NOT NULL,
  `yearOfExperience` int(11) NOT NULL,
  `summary_experience` text NOT NULL,
  `newGraduate` int(11) NOT NULL,
  `education` int(11) NOT NULL,
  `major` text NOT NULL,
  `type` int(11) NOT NULL,
  `cv` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `cover_letter` text NOT NULL,
  `recentCompany` varchar(255) NOT NULL,
  `recentPosition` varchar(255) NOT NULL,
  `currentJobLevel` int(11) NOT NULL,
  `expectedPosition` varchar(255) NOT NULL,
  `expectedJobLevel` int(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `job` varchar(255) NOT NULL,
  `job_other` varchar(255) NOT NULL,
  `expectedSalaryRange` varchar(255) NOT NULL,
  `expected_salary` int(11) NOT NULL,
  `profile` text NOT NULL,
  `position_experience` varchar(255) NOT NULL,
  `companyName_experience` varchar(255) NOT NULL,
  `fromDate_experience` int(11) NOT NULL,
  `toDate_experience` int(11) NOT NULL,
  `description_experience` text NOT NULL,
  `subject_education` varchar(255) NOT NULL,
  `school_education` varchar(255) NOT NULL,
  `qualification_education` int(11) NOT NULL,
  `fromDate_education` int(11) NOT NULL,
  `toDate_education` int(11) NOT NULL,
  `description_education` text NOT NULL,
  `name_referencer` varchar(255) NOT NULL,
  `position_referencer` varchar(255) NOT NULL,
  `phone_referencer` varchar(255) NOT NULL,
  `email_referencer` varchar(255) NOT NULL,
  `info_relationship_referencer` text NOT NULL,
  `date_created` int(11) NOT NULL,
  `update_at` int(11) NOT NULL,
  `accept_search` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL,
  `date_updated` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `option` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `resume`
--

INSERT INTO `resume` (`id`, `user_id`, `title`, `display_name_resume`, `fullname`, `birthday`, `gender`, `marital`, `address`, `country`, `city`, `district`, `cellPhone`, `email`, `visible_to_employer`, `no_experience`, `yearOfExperience`, `summary_experience`, `newGraduate`, `education`, `major`, `type`, `cv`, `logo`, `cover_letter`, `recentCompany`, `recentPosition`, `currentJobLevel`, `expectedPosition`, `expectedJobLevel`, `location`, `job`, `job_other`, `expectedSalaryRange`, `expected_salary`, `profile`, `position_experience`, `companyName_experience`, `fromDate_experience`, `toDate_experience`, `description_experience`, `subject_education`, `school_education`, `qualification_education`, `fromDate_education`, `toDate_education`, `description_education`, `name_referencer`, `position_referencer`, `phone_referencer`, `email_referencer`, `info_relationship_referencer`, `date_created`, `update_at`, `accept_search`, `status`, `date_updated`, `views`, `option`, `is_deleted`) VALUES
(4, 51, '', '', '321321', 1428598800, 1, 0, '8B Tan Vien, Tan Binh district, HCM City', 0, '0', 0, '321', 'ithtan558@gmail.com', 0, 0, 0, '', 0, 0, '0', 0, '', '', '', '', '', 0, '', 0, '', '', '', '', 0, '', '', '', 0, 0, '', '', '', 0, 0, 0, '', '', '', '', '', '', 1443928963, 1443928963, 1, 2, 0, 0, 0, 0),
(5, 53, '', '', 'Huynh Thai An', 1428598800, 1, 0, '8B Tan Vien, Tan Binh district, HCM City', 0, '0', 0, '09166240990', 'ithtan558@gmail.com', 0, 0, 0, '', 0, 0, '0', 0, '', '', '', '', '', 0, '', 0, '', '', '', '', 0, '', '', '', 0, 0, '', '', '', 0, 0, 0, '', '', '', '', '', '', 1443930451, 1443930451, 1, 2, 0, 0, 0, 0),
(6, 54, 'DGM Developer Alliances, VSERV', '', 'Huynh Thai An', 1428598800, 1, 1, '8B Tan Vien, Tan Binh district, HCM City', 1, '27,28,30,31', 0, '09166240990', 'ithtan558@gmail.com', 0, 0, 3, '<p>I&#39;ve got experience follow:</p><p>&nbsp; &nbsp; + &nbsp;2 years experience with PHP HTML5 CSS3 BOOTSTRAP</p><p>&nbsp; &nbsp; + &nbsp;1 year with SEO</p><p>&nbsp; &nbsp; + &nbsp;6 month experience with API and NoSql (mongoDb)</p><p>&nbsp; &nbsp; + &nbsp;I&#39;ll training framework [removed] angularJs, nodeJs</p><p>Proactive and high sense of responsibility, self-motivated, willing to learn, hardworking and result oriented. &nbsp;I&#39;m also hard working to finish before of the deadline</p><p>I can read, writing, communication english when need however communication english do not good</p><p>My career objectives is position senior or leader in 1 year next, now i&#39;m training design UX and manage team member</p>', 0, 4, '1', 2, 'public/CV/2015/10/Don_Xin_Nghi_Viec2.doc', 'public/CV/2015/10/1509051_535805526517169_1930585927_n1.jpg', '<p>I&#39;ve got experience follow:</p><p>&nbsp; &nbsp; + &nbsp;2 years experience with PHP HTML5 CSS3 BOOTSTRAP</p><p>&nbsp; &nbsp; + &nbsp;1 year with SEO</p><p>&nbsp; &nbsp; + &nbsp;6 month experience with API and NoSql (mongoDb)</p><p>&nbsp; &nbsp; + &nbsp;I&#39;ll training framework [removed] angularJs, nodeJs</p><p>Proactive and high sense of responsibility, self-motivated, willing to learn, hardworking and result oriented. &nbsp;I&#39;m also hard working to finish before of the deadline</p><p>I can read, writing, communication english when need however communication english do not good</p><p>My career objectives is position senior or leader in 1 year next, now i&#39;m training design UX and manage team member</p>', '', '', 0, '1,21,22,23', 3, '27,28,30,31', '1,21,23', 'Kỹ năng khác', '', 8, '', '', '', 0, 0, '', '', '', 0, 0, 0, '', 'Huynh Thai An', 'Project manager', '0916624099', 'ithtan558@gmail.com', 'I''ve got experience follow:\n\n    +  2 years experience with PHP HTML5 CSS3 BOOTSTRAP\n\n    +  1 year with SEO\n\n    +  6 month experience with API and NoSql (mongoDb)\n\n    +  I''ll training framework [removed] angularJs, nodeJs\n\nProactive and high sense of responsibility, self-motivated, willing to learn, hardworking and result oriented.  I''m also hard working to finish before of the deadline\n\nI can read, writing, communication english when need however communication english do not good\n\nMy career objectives is position senior or leader in 1 year next, now i''m training design UX and manage team member', 1443931420, 1443931420, 1, 2, 0, 0, 2, 0),
(7, 56, 'Nhân Viên Hỗ Trợ Kinh Doanh - Toàn Quốc', '', 'Huynh Thai An', 1443891600, 2, 1, '8B Tan Vien, Tan Binh district, HCM City', 182, '28,30,31', 0, '321', 'ithtan558@gmail.com', 0, 0, 4, '<p>joburljoburljoburljoburljoburljoburljoburl</p>', 0, 3, 'Chuyên môn', 0, '', '', '<p>An Huynh An Huynh Thai</p>', '', '', 0, '10,11,12', 2, '28,30,31', '1,2,3', '1', '', 5, '', '', '', 0, 0, '', '', '', 0, 0, 0, '', 'An Huynh An Huynh Thai', 'An Huynh An Huynh Thai', 'An Huynh An Huynh Thai', 'An Huynh An Huynh Thai', 'An Huynh An Huynh Thai', 1447078129, 1447078129, 1, 2, 0, 0, 1, 0),
(8, 57, 'Nhân Viên Hỗ Trợ Kinh Doanh - Toàn Quốc', '', 'Huynh Thai An', 1443805200, 1, 1, '8B Tan Vien, Tan Binh district, HCM City', 59, '27,28', 0, '321', 'ithtan559@gmail.com', 0, 0, 3, '<p>123123213213&nbsp;</p>', 0, 3, 'Chuyên môn', 1, '', '', '', '', '', 0, '10,11', 1, '27,28', '1,2,3,4', '12321', '', 18, '', '', '', 0, 0, '', '', '', 0, 0, 0, '', '', '', '', '', '', 1448207523, 1448207523, 1, 2, 0, 0, 1, 0),
(9, 58, 'Nhân Viên Hỗ Trợ Kinh Doanh - Toàn Quốc', '', 'Huynh Thai An', 1443805200, 1, 1, '8B Tan Vien, Tan Binh district, HCM City', 182, '27', 0, '321', 'ithtan559@gmail.com', 0, 0, 3, '', 0, 3, 'Chuyên môn', 4, '', '', '', '', '', 0, '10', 2, '27', '1', '', '', 16, '', '', '', 0, 0, '', '', '', 0, 0, 0, '', '', '', '', '', '', 1448208025, 1448208025, 1, 2, 0, 0, 2, 0),
(10, 59, 'Why should we hire you?', '', 'day la dong tin nhan tnh yeu', 1448211600, 3, 1, '164 Cong Quynh , District 1, Ho Chi Minh city', 182, '27,28,30,31,32,34', 0, '1321321321', 'anht@evolableasia.vn', 0, 0, 5, '<p>3213 213213213</p>', 0, 8, 'Chuyên môn ', 5, 'public/CV/2015/11/admin.doc', 'public/CV/2015/11/Christmas-christmas-32534905-1600-1200.jpg', '<p>ds fdsaf d&aacute;f dsa</p>', '', '', 0, '10,11,12', 2, '27,28,30,31,32,34', '2,3,4', '1321', '', 12, '', '', '', 0, 0, '', '', '', 0, 0, 0, '', ' fdsàds', 'f dsaf', 'fds à sdaf ', ' fdsaf ', 'f dsafdsa', 1448270180, 1448270179, 1, 2, 0, 0, 2, 0),
(11, 60, '', '', '', 0, 0, 0, '', 0, '', 0, '', '', 0, 0, 0, '', 0, 0, '', 0, '', '', '', '', '', 0, '', 0, '', '', '', '', 0, '', '', '', 0, 0, '', '', '', 0, 0, 0, '', '', '', '', '', '', 1448273287, 1448273287, 1, 2, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `resume_educations`
--

CREATE TABLE IF NOT EXISTS `resume_educations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resume_id` int(11) NOT NULL,
  `subject_educations` varchar(255) NOT NULL,
  `school_educations` varchar(255) NOT NULL,
  `qualification_educations` int(11) NOT NULL,
  `fromDate_educations` int(11) NOT NULL,
  `toDate_educations` int(11) NOT NULL,
  `description_educations` varchar(255) NOT NULL,
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `resume_experiences`
--

CREATE TABLE IF NOT EXISTS `resume_experiences` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resume_id` int(11) NOT NULL,
  `position_experiences` varchar(255) NOT NULL,
  `companyName_experiences` varchar(255) NOT NULL,
  `fromDate_experiences` int(11) NOT NULL,
  `toDate_experiences` int(11) NOT NULL,
  `description_experiences` varchar(255) NOT NULL,
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `resume_favourites`
--

CREATE TABLE IF NOT EXISTS `resume_favourites` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `resume_id` int(11) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `resume_languages`
--

CREATE TABLE IF NOT EXISTS `resume_languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resume_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `language_level_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `resume_languages`
--

INSERT INTO `resume_languages` (`id`, `resume_id`, `language_id`, `language_level_id`, `status`, `date_created`) VALUES
(8, 6, 4, 6, 0, 0),
(9, 6, 4, 6, 0, 0),
(10, 6, 5, 5, 0, 0),
(14, 7, 17, 7, 0, 0),
(15, 8, 4, 6, 0, 0),
(16, 9, 13, 5, 0, 0),
(32, 10, 3, 6, 0, 0),
(33, 10, 17, 7, 0, 0),
(34, 10, 18, 6, 0, 0),
(36, 11, 18, 5, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `resume_projects`
--

CREATE TABLE IF NOT EXISTS `resume_projects` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `resume_id` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `skills` varchar(255) DEFAULT NULL,
  `role` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `resume_view_employer`
--

CREATE TABLE IF NOT EXISTS `resume_view_employer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resume_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(64) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `refid` varchar(20) NOT NULL DEFAULT '',
  `referral` varchar(128) NOT NULL,
  `account_type` smallint(6) NOT NULL,
  `created_date` date NOT NULL DEFAULT '0000-00-00',
  `signup_date` int(11) NOT NULL,
  `signup_date_format` varchar(50) NOT NULL,
  `created_time` time NOT NULL DEFAULT '00:00:00',
  `browser` varchar(100) NOT NULL DEFAULT '',
  `ipaddress` varchar(20) NOT NULL DEFAULT '',
  `payment` varchar(10) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE IF NOT EXISTS `schedules` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `table_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_schedules` datetime DEFAULT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `send_resume_alert`
--

CREATE TABLE IF NOT EXISTS `send_resume_alert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employer_id` int(11) NOT NULL,
  `jobseeker_id` int(11) NOT NULL,
  `apply_id` int(11) NOT NULL,
  `resume_alert_id` int(11) NOT NULL,
  `title_send_resume_alert` varchar(255) NOT NULL,
  `content_send_resume_alert` text NOT NULL,
  `status_send_resume_alert` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `send_resume_alert`
--

INSERT INTO `send_resume_alert` (`id`, `employer_id`, `jobseeker_id`, `apply_id`, `resume_alert_id`, `title_send_resume_alert`, `content_send_resume_alert`, `status_send_resume_alert`) VALUES
(1, 49932, 1, 8, 3, '3213', '321321', 0),
(2, 49932, 1, 8, 3, '321', '321321', 0),
(3, 49932, 1, 8, 3, 'fdsafdsa', 'fsafdsa', 0),
(4, 49932, 1, 8, 3, 'fdsàdsafdsafdsaf', 'fdsafdsàds', 0),
(5, 49932, 1, 8, 3, 'ithtan558@gmail.com', 'Nội dung thư', 0),
(6, 49932, 1, 8, 3, '123', '321', 0),
(7, 49932, 1, 8, 3, '123123123213', 'dsfdsafdsafdsafds afds àdsa fdsa', 0),
(8, 49932, 1, 8, 3, '213', '123123', 0),
(9, 49932, 1, 8, 3, '123', '1321321', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(50) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(100) CHARACTER SET utf8 NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `setting_type` char(1) CHARACTER SET utf8 NOT NULL,
  `value_type` char(1) CHARACTER SET utf8 NOT NULL,
  `int_value` int(12) DEFAULT NULL,
  `string_value` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `text_value` text CHARACTER SET utf8,
  `created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `code`, `name`, `setting_type`, `value_type`, `int_value`, `string_value`, `text_value`, `created`) VALUES
(1, 'SITE_TITLE', 'Site Title', 'S', 'S', 0, 'Workspharam', 'Workspharam', 1407750613),
(2, 'SITE_SLOGAN', 'Site Slogan', 'S', 'S', 0, 'shake your hands with skilled', NULL, 2009),
(3, 'SITE_STATUS', 'Site status', 'S', 'I', 0, '', NULL, 2009),
(4, 'OFFLINE_MESSAGE', 'Offline Message', 'S', 'T', 0, '', 'Updation is going on...we will run this system very soon', 2009),
(9, 'SITE_ADMIN_MAIL', 'Site Admin Mail', 'S', 'S', NULL, 'ithtan558@gmail.com', NULL, 1407750613),
(11, 'LANGUAGE_CODE', 'Language', 'S', 'S', NULL, 'vietnamese', NULL, 2009),
(22, 'MAIL_LIMIT', 'define the mail limit', 'S', 'I', 10, NULL, NULL, 2009),
(24, 'BASE_URLS', 'site url', 'S', 'S', NULL, 'https://topdev.vn', NULL, 1407750613),
(25, 'UPLOAD_LIMIT', 'Maximum Upload Limit', 'S', 'I', 10, NULL, NULL, 0),
(27, 'HOSTNAME', 'hostname', 'S', 'S', NULL, 'localhost', NULL, 0),
(41, 'FIELD_ERROR_START_TAG', 'field_error_start_tag', 'S', 'T', NULL, 'NULL', '<label class="error">', 0),
(42, 'FIELD_ERROR_END_TAG', 'field_error_end_tag', 'S', 'T', NULL, 'NULL', '</label>', 0),
(43, 'PAYMENT_COMMISSION_AMOUNT', 'Payment commission amount', 'S', 'I', 10, NULL, NULL, 0),
(48, 'WITHDRAW_MIN', 'Withdraw min', 'S', 'I', 30, NULL, NULL, 2014),
(45, 'DEPOSIT_COMMISSION', 'Deposit commission', 'S', 'I', 1, NULL, NULL, 0),
(49, 'WITHDRAW_MAX', 'Withdraw max', 'S', 'I', 100000, NULL, NULL, 2014),
(50, 'BASE_URLS', 'site url', 'S', 'S', NULL, 'https://topdev.vn', NULL, 1407750613),
(51, 'SITE_KEYWORD', 'site keyword', 'S', 'T', NULL, 'Workspharam', 'Workspharam', 2014),
(52, 'SITE_DESCRIPTION', 'site description', 'S', 'T', NULL, 'Workspharam', 'Workspharam', 2014),
(53, 'RATE_USD', 'exchange rate USD', 'S', 'I', 21380, NULL, NULL, 2014),
(54, 'EMAIL_SUPPORT', 'email support', 'S', 'S', NULL, 'support@applancer.net', NULL, 2014),
(55, 'NUM_USER_SCHEDULES', 'Number user on schedules', 'S', 'I', 1, NULL, NULL, 2014);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '1: tăng,2: giảm',
  `card_code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_serial` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_vendor` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `portal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` date NOT NULL,
  `created_time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=627 ;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `type`, `description`, `card_code`, `card_serial`, `card_vendor`, `amount`, `ip_address`, `portal`, `created`, `created_time`) VALUES
(89, 14, 'SMARTLINK', 'Thanh toan qua smartlink', NULL, NULL, NULL, 6811200, '118.69.153.50', 'topdev.vn', '2015-05-18', '17:13:30'),
(90, 14, 'SMARTLINK', 'Thanh toan qua smartlink', NULL, NULL, NULL, 0, '118.69.153.50', 'topdev.vn', '2015-05-18', '17:30:30'),
(91, 14, 'SMARTLINK', 'Thanh toan qua smartlink', NULL, NULL, NULL, 4420400, '118.69.153.50', 'topdev.vn', '2015-05-18', '17:46:30'),
(92, 14, 'SMARTLINK', 'Thanh toan qua smartlink', NULL, NULL, NULL, 0, '118.69.153.50', 'topdev.vn', '2015-05-18', '17:16:35'),
(93, 14, 'SMARTLINK', 'Thanh toan qua smartlink', NULL, NULL, NULL, 0, '118.69.153.50', 'topdev.vn', '2015-05-18', '17:20:35'),
(94, 14, 'SMARTLINK', 'Thanh toan qua smartlink', NULL, NULL, NULL, 0, '118.69.153.50', 'topdev.vn', '2015-05-18', '17:53:36'),
(95, 14, 'SMARTLINK', 'Thanh toan qua smartlink', NULL, NULL, NULL, 4420400, '118.69.153.50', 'topdev.vn', '2015-05-18', '17:55:44'),
(96, 14, 'SMARTLINK', 'Thanh toan qua smartlink', NULL, NULL, NULL, 4420400, '118.69.153.50', 'topdev.vn', '2015-05-18', '17:44:52'),
(97, 14, 'SMARTLINK', 'Thanh toan qua smartlink', NULL, NULL, NULL, 1358800, '118.69.153.50', 'topdev.vn', '2015-05-19', '09:35:59'),
(98, 14, 'SMARTLINK', 'Thanh toan qua smartlink', NULL, NULL, NULL, 1358800, '118.69.153.50', 'topdev.vn', '2015-05-19', '11:34:12'),
(99, 14, 'SMARTLINK', 'Thanh toan qua smartlink', NULL, NULL, NULL, 4420400, '118.69.153.50', 'topdev.vn', '2015-05-19', '11:53:12'),
(100, 14, 'SMARTLINK', 'Thanh toan qua smartlink', NULL, NULL, NULL, 0, '118.69.153.50', 'topdev.vn', '2015-05-20', '16:46:43'),
(101, 14, 'SMARTLINK', 'Thanh toan qua smartlink', NULL, NULL, NULL, 4862440, '118.69.153.50', 'topdev.vn', '2015-05-22', '16:20:32'),
(102, 14, 'SMARTLINK', 'Thanh toan qua smartlink', NULL, NULL, NULL, 2232560, '118.69.153.50', 'topdev.vn', '2015-05-23', '09:21:13'),
(103, 14, 'SMARTLINK', 'Thanh toan qua smartlink', NULL, NULL, NULL, 2232560, '118.69.153.50', 'topdev.vn', '2015-05-23', '10:07:43'),
(104, 14, 'SMARTLINK', 'Thanh toan qua smartlink', NULL, NULL, NULL, 2232560, '118.69.153.50', 'topdev.vn', '2015-05-23', '10:57:44'),
(105, 14, 'SMARTLINK', 'Thanh toan qua smartlink', NULL, NULL, NULL, 14855984, '118.69.153.50', 'topdev.vn', '2015-05-28', '09:48:16'),
(106, 14, 'SMARTLINK', 'Thanh toan qua smartlink', NULL, NULL, NULL, 0, '118.69.153.50', 'topdev.vn', '2015-05-28', '09:01:17'),
(107, 14, 'SMARTLINK', 'Thanh toan qua smartlink', NULL, NULL, NULL, 4124560, '118.69.153.50', 'topdev.vn', '2015-06-04', '17:53:04'),
(108, 14, 'SMARTLINK', 'Thanh toan qua smartlink', NULL, NULL, NULL, 1494680, '118.69.153.50', 'topdev.vn', '2015-06-09', '15:26:29'),
(109, 14, 'SMARTLINK', 'Thanh toan qua smartlink', NULL, NULL, NULL, 1494680, '118.69.153.50', 'topdev.vn', '2015-06-10', '10:53:17'),
(110, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 1494680, '118.69.153.50', 'topdev.vn', '2015-06-10', '14:32:51'),
(111, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 0, '118.69.153.50', 'topdev.vn', '2015-06-10', '14:41:52'),
(112, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 1494680, '118.69.153.50', 'topdev.vn', '2015-06-10', '14:03:53'),
(113, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 2232560, '118.69.153.50', 'topdev.vn', '2015-06-10', '14:38:53'),
(114, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 2232560, '118.69.153.50', 'topdev.vn', '2015-06-10', '14:23:58'),
(115, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 1494680, '118.69.153.50', 'topdev.vn', '2015-06-10', '15:09:03'),
(116, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 1494680, '118.69.153.50', 'topdev.vn', '2015-06-10', '15:51:03'),
(117, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 1494680, '118.69.153.50', 'topdev.vn', '2015-06-10', '15:41:04'),
(118, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 0, '118.69.153.50', 'topdev.vn', '2015-06-10', '15:21:05'),
(119, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 1494680, '118.69.153.50', 'topdev.vn', '2015-06-10', '15:57:05'),
(120, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 1494680, '118.69.153.50', 'topdev.vn', '2015-06-10', '15:46:06'),
(121, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 1494680, '118.69.153.50', 'topdev.vn', '2015-06-10', '15:51:07'),
(122, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 1494680, '118.69.153.50', 'topdev.vn', '2015-06-10', '15:44:09'),
(123, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 2232560, '118.69.153.50', 'topdev.vn', '2015-06-10', '15:23:11'),
(124, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 1494680, '118.69.153.50', 'topdev.vn', '2015-06-10', '15:48:16'),
(125, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 1494680, '118.69.153.50', 'topdev.vn', '2015-06-10', '15:29:22'),
(126, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 1494680, '118.69.153.50', 'topdev.vn', '2015-06-10', '15:24:29'),
(127, 14, 'SMARTLINK', 'Thanh toan qua smartlink', NULL, NULL, NULL, 1494680, '118.69.153.50', 'topdev.vn', '2015-06-10', '15:44:30'),
(128, 14, 'SMARTLINK', 'Thanh toan qua smartlink', NULL, NULL, NULL, 1494680, '118.69.153.50', 'topdev.vn', '2015-06-10', '15:36:31'),
(129, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 1494680, '118.69.153.50', 'topdev.vn', '2015-06-10', '15:15:34'),
(130, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 1494680, '118.69.153.50', 'topdev.vn', '2015-06-10', '15:36:36'),
(131, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 1494680, '118.69.153.50', 'topdev.vn', '2015-06-10', '15:33:44'),
(132, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 1494680, '118.69.153.50', 'topdev.vn', '2015-06-10', '15:16:45'),
(133, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 2232560, '118.69.153.50', 'topdev.vn', '2015-06-10', '15:00:50'),
(134, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 1494680, '118.69.153.50', 'topdev.vn', '2015-06-10', '15:48:50'),
(135, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 1494680, '118.69.153.50', 'topdev.vn', '2015-06-10', '15:42:53'),
(136, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 1494680, '118.69.153.50', 'topdev.vn', '2015-06-10', '15:08:54'),
(600, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 1494680, '118.69.153.50', 'topdev.vn', '2015-06-10', '15:22:57'),
(601, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 1494680, '118.69.153.50', 'topdev.vn', '2015-06-10', '16:16:00'),
(602, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 1494680, '118.69.153.50', 'topdev.vn', '2015-06-10', '16:21:02'),
(603, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 1494680, '118.69.153.50', 'topdev.vn', '2015-06-10', '16:37:02'),
(604, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 1494680, '118.69.153.50', 'topdev.vn', '2015-06-10', '16:15:04'),
(605, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 1494680, '118.69.153.50', 'topdev.vn', '2015-06-10', '16:09:05'),
(606, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 1494680, '118.69.153.50', 'topdev.vn', '2015-06-10', '16:47:05'),
(607, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 1494680, '118.69.153.50', 'topdev.vn', '2015-06-10', '16:45:07'),
(608, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 2232560, '118.69.153.50', 'topdev.vn', '2015-06-10', '16:46:09'),
(609, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 4862440, '118.69.153.50', 'topdev.vn', '2015-06-10', '16:01:10'),
(610, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 9100520, '118.69.153.50', 'topdev.vn', '2015-06-10', '16:16:10'),
(611, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 2232560, '118.69.153.50', 'topdev.vn', '2015-06-10', '16:32:10'),
(612, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 1494680, '118.69.153.50', 'topdev.vn', '2015-06-10', '17:06:05'),
(613, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 1494680, '118.69.153.50', 'topdev.vn', '2015-06-10', '17:16:06'),
(614, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 1494680, '118.69.153.50', 'topdev.vn', '2015-06-10', '17:38:06'),
(615, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 1494680, '118.69.153.50', 'topdev.vn', '2015-06-10', '17:38:08'),
(616, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 1494680, '118.69.153.50', 'topdev.vn', '2015-06-10', '17:50:08'),
(617, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 1494680, '118.69.153.50', 'topdev.vn', '2015-06-10', '17:06:09'),
(618, 14, 'ONEPAY', 'Thanh toan qua onepay', NULL, NULL, NULL, 1494680, '118.69.153.50', 'topdev.vn', '2015-06-10', '17:29:09'),
(619, 14, 'SMARTLINK', 'Thanh toan qua smartlink', NULL, NULL, NULL, 1494680, '118.69.153.50', 'topdev.vn', '2015-06-10', '17:20:14'),
(620, 14, 'SMARTLINK', 'Thanh toan qua smartlink', NULL, NULL, NULL, 2200000, '118.69.153.50', 'topdev.vn', '2015-06-11', '15:26:21'),
(621, 49805, 'SMARTLINK', 'Thanh toan qua smartlink', NULL, NULL, NULL, 2200000, '118.69.153.50', 'topdev.vn', '2015-06-17', '14:39:40'),
(622, 49805, 'SMARTLINK', 'Thanh toan qua smartlink', NULL, NULL, NULL, 0, '118.69.153.50', 'topdev.vn', '2015-06-17', '14:39:40'),
(623, 49805, 'SMARTLINK', 'Thanh toan qua smartlink', NULL, NULL, NULL, 0, '118.69.153.50', 'topdev.vn', '2015-06-17', '14:50:40'),
(624, 49805, 'SMARTLINK', 'Thanh toan qua smartlink', NULL, NULL, NULL, 2200000, '118.69.153.50', 'topdev.vn', '2015-06-17', '14:53:42'),
(625, 49805, 'SMARTLINK', 'Thanh toan qua smartlink', NULL, NULL, NULL, 2200000, '118.69.153.50', 'topdev.vn', '2015-06-17', '14:19:43'),
(626, 14, 'SMARTLINK', 'Thanh toan qua smartlink', NULL, NULL, NULL, 0, '118.69.153.50', 'topdev.vn', '2015-06-17', '17:04:19');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_responses`
--

CREATE TABLE IF NOT EXISTS `transaction_responses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL DEFAULT '0',
  `transaction_partner` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `card_code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_serial` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_vendor` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` double(12,0) NOT NULL,
  `fee` double(12,2) DEFAULT NULL,
  `currency` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_code` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `error_code` tinyint(10) DEFAULT NULL,
  `order_time` datetime DEFAULT NULL,
  `portal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` date NOT NULL,
  `created_time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=99 ;

--
-- Dumping data for table `transaction_responses`
--

INSERT INTO `transaction_responses` (`id`, `user_id`, `transaction_id`, `transaction_partner`, `type`, `card_code`, `card_serial`, `card_vendor`, `amount`, `fee`, `currency`, `country_code`, `status`, `error_code`, `order_time`, `portal`, `created`, `created_time`) VALUES
(15, 14, 96, '715300113', 'SMARTLINK', NULL, NULL, NULL, 4420400, NULL, 'VND', NULL, '0', NULL, '2015-05-19 00:00:00', 'topdev.vn', '2015-05-18', '17:30:53'),
(16, 14, 97, '715400009', 'SMARTLINK', NULL, NULL, NULL, 1358800, NULL, 'VND', NULL, '0', NULL, '2015-05-20 00:00:00', 'topdev.vn', '2015-05-19', '10:08:00'),
(17, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-22', '16:13:33'),
(18, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-22', '16:07:36'),
(19, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-22', '16:23:36'),
(20, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-22', '16:26:36'),
(21, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-22', '16:40:36'),
(22, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-22', '16:57:36'),
(23, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-22', '16:45:37'),
(24, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-22', '16:06:38'),
(25, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-22', '16:08:38'),
(26, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-22', '16:49:39'),
(27, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-22', '16:50:39'),
(28, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-22', '16:50:39'),
(29, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-22', '16:58:54'),
(30, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-22', '16:47:58'),
(31, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-22', '16:19:59'),
(32, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-22', '17:12:01'),
(33, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-22', '17:46:02'),
(34, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-22', '17:47:02'),
(35, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-22', '17:48:02'),
(36, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-22', '17:30:23'),
(37, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-23', '08:14:56'),
(38, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-23', '08:15:56'),
(39, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-23', '08:35:56'),
(40, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-23', '08:35:56'),
(41, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-23', '08:36:56'),
(42, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-23', '08:36:56'),
(43, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-23', '08:06:57'),
(44, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-23', '08:28:57'),
(45, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-23', '08:30:57'),
(46, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-23', '08:46:57'),
(47, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-23', '08:43:58'),
(48, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-23', '08:45:58'),
(49, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-23', '08:09:59'),
(50, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-23', '08:10:59'),
(51, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-23', '08:34:59'),
(52, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-23', '08:46:59'),
(53, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-23', '09:10:00'),
(54, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-23', '09:13:00'),
(55, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-23', '09:14:00'),
(56, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-23', '09:26:00'),
(57, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-23', '09:08:05'),
(58, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-23', '09:54:05'),
(59, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-23', '09:14:08'),
(60, 14, 101, '715700062', 'SMARTLINK', NULL, NULL, NULL, 4862440, NULL, 'VND', NULL, '0', NULL, '2015-05-23 00:00:00', 'topdev.vn', '2015-05-23', '09:14:10'),
(61, 14, 102, '715800001', 'SMARTLINK', NULL, NULL, NULL, 2232560, NULL, 'VND', NULL, '0', NULL, '2015-05-24 00:00:00', 'topdev.vn', '2015-05-23', '09:58:13'),
(62, 14, 103, '715800021', 'SMARTLINK', NULL, NULL, NULL, 2232560, NULL, 'VND', NULL, '0', NULL, '2015-05-24 00:00:00', 'topdev.vn', '2015-05-23', '10:39:43'),
(63, 14, 104, '715800024', 'SMARTLINK', NULL, NULL, NULL, 2232560, NULL, 'VND', NULL, '0', NULL, '2015-05-24 00:00:00', 'topdev.vn', '2015-05-23', '10:30:45'),
(64, 14, 109, '', 'SMARTLINK', NULL, NULL, NULL, 1494680, NULL, 'VND', NULL, '1', 9, '1970-01-01 08:00:00', 'topdev.vn', '2015-06-10', '10:21:18'),
(65, 14, 0, '', 'ONEPAY', NULL, NULL, NULL, 0, NULL, '', NULL, '1', 5, '2015-06-10 14:41:52', 'topdev.vn', '2015-06-10', '14:41:52'),
(66, 14, 0, '', 'ONEPAY', NULL, NULL, NULL, 1494680, NULL, '', NULL, '1', 7, '2015-06-10 14:03:53', 'topdev.vn', '2015-06-10', '14:03:53'),
(67, 14, 0, '', 'ONEPAY', NULL, NULL, NULL, 2232560, NULL, '', NULL, '1', 7, '2015-06-10 14:38:53', 'topdev.vn', '2015-06-10', '14:38:53'),
(68, 14, 0, '', 'ONEPAY', NULL, NULL, NULL, 2232560, NULL, '', NULL, '1', 7, '2015-06-10 14:23:58', 'topdev.vn', '2015-06-10', '14:23:58'),
(69, 14, 0, '', 'ONEPAY', NULL, NULL, NULL, 1494680, NULL, '', NULL, '1', 7, '2015-06-10 15:09:03', 'topdev.vn', '2015-06-10', '15:09:03'),
(70, 14, 0, '', 'ONEPAY', NULL, NULL, NULL, 1494680, NULL, '', NULL, '1', 7, '2015-06-10 15:51:03', 'topdev.vn', '2015-06-10', '15:51:03'),
(71, 14, 0, '', 'ONEPAY', NULL, NULL, NULL, 1494680, NULL, '', NULL, '1', 7, '2015-06-10 15:57:05', 'topdev.vn', '2015-06-10', '15:57:05'),
(72, 14, 0, '', 'ONEPAY', NULL, NULL, NULL, 1494680, NULL, '', NULL, '1', 7, '2015-06-10 15:44:09', 'topdev.vn', '2015-06-10', '15:44:09'),
(73, 14, 0, '', 'ONEPAY', NULL, NULL, NULL, 2232560, NULL, '', NULL, '1', 7, '2015-06-10 15:24:11', 'topdev.vn', '2015-06-10', '15:24:11'),
(74, 14, 0, '', 'ONEPAY', NULL, NULL, NULL, 1494680, NULL, '', NULL, '1', 7, '2015-06-10 15:49:16', 'topdev.vn', '2015-06-10', '15:49:16'),
(75, 14, 0, '', 'ONEPAY', NULL, NULL, NULL, 1494680, NULL, '', NULL, '1', 7, '2015-06-10 15:25:29', 'topdev.vn', '2015-06-10', '15:25:29'),
(76, 14, 127, '717600044', 'SMARTLINK', NULL, NULL, NULL, 1494680, NULL, 'VND', NULL, '0', 0, '2015-06-11 00:00:00', 'topdev.vn', '2015-06-10', '15:18:31'),
(77, 14, 128, '717600045', 'SMARTLINK', NULL, NULL, NULL, 1494680, NULL, 'VND', NULL, '0', 0, '2015-06-11 00:00:00', 'topdev.vn', '2015-06-10', '15:05:32'),
(78, 14, 0, '', 'ONEPAY', NULL, NULL, NULL, 1494680, NULL, '', NULL, '1', 7, '2015-06-10 15:16:34', 'topdev.vn', '2015-06-10', '15:16:34'),
(79, 14, 0, '', 'ONEPAY', NULL, NULL, NULL, 1494680, NULL, '', NULL, '1', 7, '2015-06-10 15:34:44', 'topdev.vn', '2015-06-10', '15:34:44'),
(80, 0, 0, '', 'ONEPAY', NULL, NULL, NULL, 1494680, NULL, '', NULL, '1', 7, '2015-06-10 15:16:45', 'topdev.vn', '2015-06-10', '15:16:45'),
(81, 0, 0, '', 'ONEPAY', NULL, NULL, NULL, 2232560, NULL, '', NULL, '1', 7, '2015-06-10 15:00:50', 'topdev.vn', '2015-06-10', '15:00:50'),
(82, 0, 0, '', 'ONEPAY', NULL, NULL, NULL, 1494680, NULL, '', NULL, '1', 7, '2015-06-10 15:49:50', 'topdev.vn', '2015-06-10', '15:49:50'),
(83, 14, 0, '', 'ONEPAY', NULL, NULL, NULL, 20000, NULL, '', NULL, '1', 7, '2015-06-10 15:09:54', 'topdev.vn', '2015-06-10', '15:09:54'),
(84, 14, 0, '', 'ONEPAY', NULL, NULL, NULL, 1494680, NULL, '', NULL, '1', 7, '2015-06-10 15:23:57', 'topdev.vn', '2015-06-10', '15:23:57'),
(85, 14, 0, '', 'ONEPAY', NULL, NULL, NULL, 1494680, NULL, '', NULL, '1', 7, '2015-06-10 16:16:00', 'topdev.vn', '2015-06-10', '16:16:00'),
(86, 14, 0, '', 'ONEPAY', NULL, NULL, NULL, 1494680, NULL, '', NULL, '1', 7, '2015-06-10 16:21:02', 'topdev.vn', '2015-06-10', '16:21:02'),
(87, 14, 0, '', 'ONEPAY', NULL, NULL, NULL, 1494680, NULL, '', NULL, '1', 7, '2015-06-10 16:37:02', 'topdev.vn', '2015-06-10', '16:37:02'),
(88, 14, 0, '', 'ONEPAY', NULL, NULL, NULL, 1494680, NULL, '', NULL, '1', 7, '2015-06-10 16:16:04', 'topdev.vn', '2015-06-10', '16:16:04'),
(89, 14, 606, '1495654', 'ONEPAY', NULL, NULL, NULL, 1494680, NULL, 'VND', NULL, '0', 0, '2015-06-10 16:39:06', 'topdev.vn', '2015-06-10', '16:39:06'),
(90, 14, 0, '', 'ONEPAY', NULL, NULL, NULL, 1494680, NULL, '', NULL, '1', 7, '2015-06-10 16:45:07', 'topdev.vn', '2015-06-10', '16:45:07'),
(91, 14, 0, '', 'ONEPAY', NULL, NULL, NULL, 4862440, NULL, '', NULL, '1', 7, '2015-06-10 16:02:10', 'topdev.vn', '2015-06-10', '16:02:10'),
(92, 14, 0, '', 'ONEPAY', NULL, NULL, NULL, 1494680, NULL, '', NULL, '1', 7, '2015-06-10 17:07:05', 'topdev.vn', '2015-06-10', '17:07:05'),
(93, 14, 0, '', 'ONEPAY', NULL, NULL, NULL, 1494680, NULL, '', NULL, '1', 7, '2015-06-10 17:17:06', 'topdev.vn', '2015-06-10', '17:17:06'),
(94, 14, 0, '', 'ONEPAY', NULL, NULL, NULL, 1494680, NULL, '', NULL, '1', 7, '2015-06-10 17:39:08', 'topdev.vn', '2015-06-10', '17:39:08'),
(95, 14, 0, '', 'ONEPAY', NULL, NULL, NULL, 1494680, NULL, '', NULL, '1', 7, '2015-06-10 17:51:08', 'topdev.vn', '2015-06-10', '17:51:08'),
(96, 14, 0, '', 'ONEPAY', NULL, NULL, NULL, 1494680, NULL, '', NULL, '1', 7, '2015-06-10 17:07:09', 'topdev.vn', '2015-06-10', '17:07:09'),
(97, 14, 0, '', 'ONEPAY', NULL, NULL, NULL, 1494680, NULL, '', NULL, '1', 7, '2015-06-10 17:29:09', 'topdev.vn', '2015-06-10', '17:29:09'),
(98, 14, 619, '717600057', 'SMARTLINK', NULL, NULL, NULL, 1494680, NULL, 'VND', NULL, '0', 0, '2015-06-11 00:00:00', 'topdev.vn', '2015-06-10', '17:50:14');

-- --------------------------------------------------------

--
-- Table structure for table `unsubscribe`
--

CREATE TABLE IF NOT EXISTS `unsubscribe` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `reason` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `name` varchar(128) CHARACTER SET utf8 NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `role_id` smallint(6) NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(128) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `profile_desc` text CHARACTER SET utf8,
  `user_status` tinyint(4) NOT NULL DEFAULT '0',
  `activation_key` varchar(32) CHARACTER SET utf8 NOT NULL,
  `created` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `key_rand` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `active_email` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `active_time` int(11) NOT NULL,
  `forgot_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `forgot_time` int(11) NOT NULL,
  `ip_address` varchar(15) DEFAULT NULL,
  `is_available` int(11) NOT NULL,
  `logo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`user_name`,`role_id`) USING BTREE,
  KEY `email` (`email`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `name`, `display_name`, `role_id`, `password`, `email`, `phone`, `profile_desc`, `user_status`, `activation_key`, `created`, `is_deleted`, `key_rand`, `active_email`, `active_time`, `forgot_key`, `forgot_time`, `ip_address`, `is_available`, `logo`) VALUES
(54, NULL, '', '', 1, 'f5bb0c8de146c67b44babbf4e6584cc0', 'ithtan558@gmail.com', '', NULL, 1, '', 1443930840, 0, '', '759c0ca83f33b82ef9bb4546f65d30c7', 0, '', 1447080279, '127.0.0.1', 0, '2015/10/04/1509051_535805526517169_1930585927_n95BgVFtBsd.jpg'),
(55, NULL, '', '', 2, 'f5bb0c8de146c67b44babbf4e6584cc0', 'ithtan559@gmail.com', '', NULL, 1, '', 1444053749, 0, '', '0e96fdf21714b4bd3f459e188e907a76', 0, '2e9a0f66dd5352f9e527b1820a0983d3', 1447078807, '127.0.0.1', 0, ''),
(56, NULL, '', '', 1, 'f5bb0c8de146c67b44babbf4e6584cc0', 'anht@evolableasia.vn', '', NULL, 1, '', 1447077905, 0, '', '0', 0, '', 0, '127.0.0.1', 0, ''),
(57, NULL, '', '', 1, '202cb962ac59075b964b07152d234b70', 'ithtan660@gmail.com', '', NULL, 1, '', 1448207522, 0, '', '0', 0, '', 0, '127.0.0.1', 0, ''),
(58, NULL, '', '', 1, '202cb962ac59075b964b07152d234b70', 'ithtan1558@gmail.com', '', NULL, 1, '', 1448208025, 0, '', '0', 0, '', 0, '127.0.0.1', 0, ''),
(59, NULL, '', '', 1, '202cb962ac59075b964b07152d234b70', 'ithtan666@gmail.com', '', NULL, 1, '', 1448269741, 0, '', '0', 0, '', 0, '127.0.0.1', 0, ''),
(60, NULL, '', '', 1, '4297f44b13955235245b2497399d7a93', 'ithtan5591@gmail.com', '', NULL, 1, '', 1448273287, 0, '', '0', 0, '', 0, '127.0.0.1', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_accept_jobs`
--

CREATE TABLE IF NOT EXISTS `user_accept_jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category_ids` varchar(255) NOT NULL,
  `city_ids` varchar(255) NOT NULL,
  `level_ids` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `user_accept_jobs`
--

INSERT INTO `user_accept_jobs` (`id`, `user_id`, `category_ids`, `city_ids`, `level_ids`, `status`, `is_deleted`) VALUES
(28, 1, '10,11', '27,28,30,31', 2, 0, 1),
(29, 45, '1,21', '27,28,30', 3, 0, 0),
(30, 54, '21,22', '27,28,30,31', 6, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_balance`
--

CREATE TABLE IF NOT EXISTS `user_balance` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `amount` double(12,2) unsigned NOT NULL DEFAULT '0.00',
  `frozen` double(12,2) DEFAULT '0.00',
  `experience` double(12,2) NOT NULL,
  `bonus` double(12,2) DEFAULT '0.00',
  `in_review` double(12,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_balance`
--

INSERT INTO `user_balance` (`id`, `user_id`, `amount`, `frozen`, `experience`, `bonus`, `in_review`) VALUES
(1, 49701, 0.00, 0.00, 10.00, 5.00, NULL),
(2, 49712, 0.00, 0.00, 10.00, 5.00, NULL),
(3, 49736, 0.00, 0.00, 10.00, 5.00, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_categories`
--

CREATE TABLE IF NOT EXISTS `user_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_categories` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_email_subscribe`
--

CREATE TABLE IF NOT EXISTS `user_email_subscribe` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `categories_ids` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `city_ids` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `level_id` int(11) NOT NULL,
  `created` int(13) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_email_subscribe`
--

INSERT INTO `user_email_subscribe` (`id`, `email`, `categories_ids`, `city_ids`, `level_id`, `created`, `is_deleted`) VALUES
(1, 'ithtan558@gmail.com', '', '', 2, 1443931481, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_employers`
--

CREATE TABLE IF NOT EXISTS `user_employers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `num_of_staff` int(11) DEFAULT NULL,
  `description` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `website` varchar(255) NOT NULL,
  `linhvuchoatdong` varchar(255) NOT NULL,
  `chinhanh` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `chucvu` varchar(255) NOT NULL,
  `email_contact` varchar(100) NOT NULL,
  `phone_contact` varchar(11) NOT NULL,
  `mobile_contact` varchar(11) NOT NULL,
  `country` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `accept_new` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `user_employers`
--

INSERT INTO `user_employers` (`id`, `user_id`, `logo`, `company`, `address`, `phone`, `contact`, `num_of_staff`, `description`, `created_at`, `updated_at`, `website`, `linhvuchoatdong`, `chinhanh`, `name`, `chucvu`, `email_contact`, `phone_contact`, `mobile_contact`, `country`, `city`, `accept_new`) VALUES
(44, 55, '2015/10/05/1509051_535805526517169_1930585927_n0Q2skatSVL.jpg', 'CÔNG TY TNHH POLVITA SÀI GÒN', '180-192 Nguyễn Công Trứ, Phường Nguyễn Thái Bình , Quận 1 , Lầu 10 Toà Nhà Maritime Bank', NULL, NULL, 5, 'Công ty cổ phần NASIA thành lập năm 2004 tại Hà Nội. \\n     NASIA chuyên nghiên cứu, sản xuất, các sản phẩm điện tử viễn thông, điều khiển tự động và phần mềm ứng dụng, các hệ thống an ninh như thiết bị giám sát hành trình, GPS mini dành cho oto và xe máy, các giải pháp kinh doanh gas, máy trực điện thoại thông minh và hệ thống quản lý và điều hành taxi. Các sản phẩm  đòi hỏi sự chính xác về thông số kỹ thuật và đạt chuẩn với quy định của bộ giao thông vận tại với các thiết bị giám sát hành trình.\\n     Trong suốt chặng đường phát triển vừa quan Nasia không ngừng nỗ lực nghiên cứu các sản phẩm hiện đại và tiên tiến nhất hiện nay để đáp ứng nhu cầu sử dụng cho người dùng với mục tiêu hướng tới đó là “Khách hàng là khởi nguồn của mọi sáng tạo”\\n     Với một đội ngũ Cán bộ là Thạc sĩ, Kỹ sư CNTT, cử nhân, chuyên ngành Công nghệ thông tin, Điện tử, Viễn thông, cử nhân kinh tế, tài chính và nhiều cộng tác viên là các chuyên gia, Giáo sư, Tiến sĩ, kỹ sư  trong các lĩnh vực nói trên.. Đội ngũ nhân viên được đào tạo chính quy, luôn được trang bị thêm kiến thức qua các khoá đào tạo  và  được thử thách qua các dự án thực tế của Công ty,  tiếp cận và đã làm chủ được các công nghệ tiên tiến về Công nghệ thông tin, điện tử Viễn Thông, ứng dụng một cách có hiệu quả các tiến bộ khoa học đó vào phát triển nền kinh tế nước nhà.\\nNASIA xin gửi lời tri ân tới những Quý khách hàng, đối tác đã và đang tạo nên sự thành công của NASIA trong suốt nhiều năm qua và mong muốn luôn tiếp tục nhận được sự quan tâm và ủng hộ của Quý khách hàng và đối tác cùng NASIA xây dựng một cuộc sống tươi đẹp và ngày càng tiện ích hơn', NULL, '2015-10-05 14:02:29', 'http://timnguyenmarketing.com/aboutimms/', 'Technology infomation', '9 Dinh Tien Hoang', 'CÔNG TY TNHH POLVITA SÀI GÒN', 'Director', 'ithtan559@gmail.com', '0916624099', '0916624099', 231, 31, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_employers_resume_alert`
--

CREATE TABLE IF NOT EXISTS `user_employers_resume_alert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `level_resume_find` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `category_ids` varchar(255) NOT NULL,
  `city_ids` varchar(255) NOT NULL,
  `sex` int(11) NOT NULL,
  `marital` int(11) NOT NULL,
  `country` int(11) NOT NULL,
  `language` int(11) NOT NULL,
  `language_level` int(11) NOT NULL,
  `education` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `year_exp` int(11) NOT NULL,
  `salary` int(11) NOT NULL,
  `my_resume_alerts` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_facebook`
--

CREATE TABLE IF NOT EXISTS `user_facebook` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `facebook_id` int(50) NOT NULL DEFAULT '0',
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locale` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `created` int(13) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=228 ;

--
-- Dumping data for table `user_facebook`
--

INSERT INTO `user_facebook` (`id`, `facebook_id`, `link`, `locale`, `name`, `verified`, `created`, `is_deleted`, `user_id`) VALUES
(227, 2147483647, 'https://www.facebook.com/app_scoped_user_id/986748851338103/', 'vi_VN', 'Nguyễn Hoàng Sơn', 1, 1434094118, 0, 49821),
(226, 2147483647, 'https://www.facebook.com/app_scoped_user_id/763709007060152/', 'vi_VN', 'Huynh An', 1, 1433824870, 0, 49792);

-- --------------------------------------------------------

--
-- Table structure for table `user_google`
--

CREATE TABLE IF NOT EXISTS `user_google` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `google_id` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `avartar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `birthday` varchar(255) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `user_google`
--

INSERT INTO `user_google` (`id`, `user_id`, `google_id`, `display_name`, `gender`, `avartar`, `birthday`, `created`, `is_deleted`) VALUES
(35, 49802, 2147483647, 'An Huynh', NULL, 'https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=50', '', 1433908346, 0),
(34, 49793, 2147483647, 'Huynh An', NULL, 'https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=50', '', 1433825177, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_message_default`
--

CREATE TABLE IF NOT EXISTS `user_message_default` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_message_default`
--

INSERT INTO `user_message_default` (`id`, `user_id`, `name`, `title`, `content`, `status`) VALUES
(3, 49932, 'a', 'a', 'a', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_percent`
--

CREATE TABLE IF NOT EXISTS `user_percent` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL DEFAULT '0',
  `percent_id` int(10) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 : chua hoan thanh,1: hoan thanh',
  `key` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_rank`
--

CREATE TABLE IF NOT EXISTS `user_rank` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `min_experience` float DEFAULT NULL,
  `date_created` int(11) NOT NULL,
  `date_modified` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_watchlist`
--

CREATE TABLE IF NOT EXISTS `user_watchlist` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL DEFAULT '0',
  `dev_id` int(10) NOT NULL DEFAULT '0',
  `created` int(13) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_worker`
--

CREATE TABLE IF NOT EXISTS `user_worker` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `logo` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `birthday` varchar(255) DEFAULT NULL,
  `sex` int(11) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `category_ids` varchar(255) NOT NULL,
  `city_ids` varchar(255) NOT NULL,
  `level_ids` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `user_worker`
--

INSERT INTO `user_worker` (`id`, `user_id`, `fullname`, `logo`, `address`, `birthday`, `sex`, `phone`, `category_ids`, `city_ids`, `level_ids`, `created_at`, `updated_at`) VALUES
(8, 54, 'Huynh Thai An', '2015/10/04/1509051_535805526517169_1930585927_n95BgVFtBsd.jpg', '8B Tan Vien, Tan Binh district, HCM City', '1428598800', 1, '09166240990', '1,21,22,23', '27,28,30', '2', NULL, '2015-10-04 03:54:00');

-- --------------------------------------------------------

--
-- Table structure for table `zone`
--

CREATE TABLE IF NOT EXISTS `zone` (
  `zone_id` int(10) NOT NULL AUTO_INCREMENT,
  `country_code` char(2) COLLATE utf8_bin NOT NULL,
  `zone_name` varchar(35) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`zone_id`),
  KEY `idx_zone_name` (`zone_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
