-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2020 at 03:23 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flipkoti_beta`
--

-- --------------------------------------------------------

--
-- Table structure for table `email_content`
--

CREATE TABLE `email_content` (
  `id` bigint(20) NOT NULL,
  `email_for` varchar(255) DEFAULT NULL,
  `subject` text DEFAULT NULL,
  `language` text DEFAULT NULL,
  `intro` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `email_content`
--

INSERT INTO `email_content` (`id`, `email_for`, `subject`, `language`, `intro`, `created_at`, `updated_at`, `deleted_at`) VALUES
(41, 'signup', 'test', NULL, '<div style=\"background:#f5f5f5; font-family:arial; padding:80px 0; width:100%\">\r\n<div style=\"margin-bottom:0px; margin-left:0px; margin-right:0px; margin-top:0px; max-width:640px\">\r\n<div style=\"display:inline-block; margin-bottom:30px; margin-left:30px; margin-right:30px; margin-top:30px; text-align:center; width:100%\">\r\n<div><img alt=\"logo\" src=\"https://i.ibb.co/QmY2GXM/logo.png\" /></div>\r\n</div>\r\n\r\n<div style=\"background:#111111 url(images/email-header-bg.jpg); color:#ffffff; padding:80px 0; text-align:center\">\r\n<p style=\"margin-left:0px; margin-right:0px\">Welcome</p>\r\n</div>\r\n\r\n<div style=\"background:#ffffff; box-sizing:border-box; display:inline-block; padding:50px 50px; width:100%\">\r\n<h1 style=\"margin-left:10px; margin-right:10px\">Dearest,</h1>\r\n\r\n<p style=\"margin-left:15px; margin-right:15px\"><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum..</p>\r\n\r\n<p style=\"margin-left:30px; margin-right:30px\"><!--?= htmlspecialchars_decode($intro) ?--></p>\r\n\r\n<p style=\"margin-left:30px; margin-right:30px\"><!--?= htmlspecialchars_decode($body) ?--></p>\r\n\r\n<p style=\"margin-left:30px; margin-right:30px\"><!--?= htmlspecialchars_decode($end) ?--></p>\r\n<a href=\"{{ route(\'admin.auth.prouser.IsConfirmed\', $user) }}\" style=\"background: #2a72cc; color: #fff; text-decoration: none; padding: 15px 30px; display: inline-block; border-radius: 7px; font-weight: 600; margin-top: 20px;\">Confirm your account</a><br />\r\n&nbsp;\r\n<h2 style=\"margin-left:20px; margin-right:20px\">Do check our other services</h2>\r\n\r\n<div style=\"display:inline-block; width:100%\">\r\n<div style=\"border:1px solid #e8e9e9; box-sizing:border-box; float:left; padding:22px 37px; width:46%\"><img alt=\"icon-sale\" src=\"https://i.ibb.co/SnSFJhC/icon-sale.png\" style=\"float:left; margin-right:17px\" />\r\n<p style=\"margin-left:4px; margin-right:4px\"><a href=\"#\" style=\"color:#2a5adc;\">Find</a> near by apartments</p>\r\n</div>\r\n\r\n<div style=\"border:1px solid #e8e9e9; box-sizing:border-box; float:right; padding:22px 37px; width:46%\"><img alt=\"icon-home\" src=\"https://i.ibb.co/5WfDr9V/icon-home.png\" style=\"float:left; margin:-4px 17px -4px 0\" />\r\n<p style=\"margin-left:4px; margin-right:4px\"><a href=\"#\" style=\"color:#2a5adc;\">Sell</a> your apartment</p>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div style=\"color:#777777; font-size:13px; margin-top:30px; text-align:center\">\r\n<p style=\"margin-left:7px; margin-right:7px\">write your query at: info@flipkoti.fi</p>\r\n\r\n<p style=\"margin-left:7px; margin-right:7px\">Follow us on social media</p>\r\n\r\n<div style=\"margin-top:15px\">&nbsp;</div>\r\n</div>\r\n</div>\r\n</div>', '2020-06-01 06:05:28', '2020-06-01 06:05:28', NULL),
(112, 'template test en', 'test en', 'en', '<div style=\"background:#f5f5f5; font-family:arial; padding:80px 0; width:100%\">\r\n<div style=\"margin-bottom:0px; margin-left:0px; margin-right:0px; margin-top:0px; max-width:640px\">\r\n<div style=\"display:inline-block; margin-bottom:30px; margin-left:30px; margin-right:30px; margin-top:30px; text-align:center; width:100%\">\r\n<div><img alt=\"logo\" src=\"https://i.ibb.co/QmY2GXM/logo.png\" /></div>\r\n</div>\r\n\r\n<div style=\"background:#111111 url(images/email-header-bg.jpg); color:#ffffff; padding:80px 0; text-align:center\">\r\n<p style=\"margin-left:0px; margin-right:0px\">Welcome</p>\r\n</div>\r\n\r\n<div style=\"background:#ffffff; box-sizing:border-box; display:inline-block; padding:50px 50px; width:100%\">\r\n<h1 style=\"margin-left:10px; margin-right:10px\">Dearest,</h1>\r\n\r\n<p style=\"margin-left:15px; margin-right:15px\"><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum..</p>\r\n\r\n<p style=\"margin-left:30px; margin-right:30px\"><!--?= htmlspecialchars_decode($intro) ?--></p>\r\n\r\n<p style=\"margin-left:30px; margin-right:30px\"><!--?= htmlspecialchars_decode($body) ?--></p>\r\n\r\n<p style=\"margin-left:30px; margin-right:30px\"><!--?= htmlspecialchars_decode($end) ?--></p>\r\n<a href=\"{{ route(\'admin.auth.prouser.IsConfirmed\', $user) }}\" style=\"background: #2a72cc; color: #fff; text-decoration: none; padding: 15px 30px; display: inline-block; border-radius: 7px; font-weight: 600; margin-top: 20px;\">Confirm your account</a><br />\r\n&nbsp;\r\n<h2 style=\"margin-left:20px; margin-right:20px\">Do check our other services</h2>\r\n\r\n<div style=\"display:inline-block; width:100%\">\r\n<div style=\"border:1px solid #e8e9e9; box-sizing:border-box; float:left; padding:22px 37px; width:46%\"><img alt=\"icon-sale\" src=\"https://i.ibb.co/SnSFJhC/icon-sale.png\" style=\"float:left; margin-right:17px\" />\r\n<p style=\"margin-left:4px; margin-right:4px\"><a href=\"#\" style=\"color:#2a5adc;\">Find</a> near by apartments</p>\r\n</div>\r\n\r\n<div style=\"border:1px solid #e8e9e9; box-sizing:border-box; float:right; padding:22px 37px; width:46%\"><img alt=\"icon-home\" src=\"https://i.ibb.co/5WfDr9V/icon-home.png\" style=\"float:left; margin:-4px 17px -4px 0\" />\r\n<p style=\"margin-left:4px; margin-right:4px\"><a href=\"#\" style=\"color:#2a5adc;\">Sell</a> your apartment</p>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div style=\"color:#777777; font-size:13px; margin-top:30px; text-align:center\">\r\n<p style=\"margin-left:7px; margin-right:7px\">write your query at: info@flipkoti.fi</p>\r\n\r\n<p style=\"margin-left:7px; margin-right:7px\">Follow us on social media</p>\r\n\r\n<div style=\"margin-top:15px\">&nbsp;</div>\r\n</div>\r\n</div>\r\n</div>', '2020-06-03 08:02:54', '2020-06-03 08:02:54', NULL),
(113, 'template test fi', 'test fi', 'fi', '<div style=\"background:#f5f5f5; font-family:arial; padding:80px 0; width:100%\">\r\n<div style=\"margin-bottom:0px; margin-left:0px; margin-right:0px; margin-top:0px; max-width:640px\">\r\n<div style=\"display:inline-block; margin-bottom:30px; margin-left:30px; margin-right:30px; margin-top:30px; text-align:center; width:100%\">\r\n<div><img alt=\"logo\" src=\"https://i.ibb.co/QmY2GXM/logo.png\" /></div>\r\n</div>\r\n\r\n<div style=\"background:#111111 url(images/email-header-bg.jpg); color:#ffffff; padding:80px 0; text-align:center\">\r\n<p style=\"margin-left:0px; margin-right:0px\">Tervetuloa</p>\r\n</div>\r\n\r\n<div style=\"background:#ffffff; box-sizing:border-box; display:inline-block; padding:50px 50px; width:100%\">\r\n<h1 style=\"margin-left:10px; margin-right:10px\">Dearest,</h1>\r\n\r\n<p style=\"margin-left:15px; margin-right:15px\"><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum..</p>\r\n\r\n<p style=\"margin-left:30px; margin-right:30px\"><!--?= htmlspecialchars_decode($intro) ?--></p>\r\n\r\n<p style=\"margin-left:30px; margin-right:30px\"><!--?= htmlspecialchars_decode($body) ?--></p>\r\n\r\n<p style=\"margin-left:30px; margin-right:30px\"><!--?= htmlspecialchars_decode($end) ?--></p>\r\n<a href=\"{{ route(\'admin.auth.prouser.IsConfirmed\', $user) }}\" style=\"background: #2a72cc; color: #fff; text-decoration: none; padding: 15px 30px; display: inline-block; border-radius: 7px; font-weight: 600; margin-top: 20px;\">Confirm your account</a><br />\r\n&nbsp;\r\n<h2 style=\"margin-left:20px; margin-right:20px\">Do check our other services</h2>\r\n\r\n<div style=\"display:inline-block; width:100%\">\r\n<div style=\"border:1px solid #e8e9e9; box-sizing:border-box; float:left; padding:22px 37px; width:46%\"><img alt=\"icon-sale\" src=\"https://i.ibb.co/SnSFJhC/icon-sale.png\" style=\"float:left; margin-right:17px\" />\r\n<p style=\"margin-left:4px; margin-right:4px\"><a href=\"#\" style=\"color:#2a5adc;\">Find</a> near by apartments</p>\r\n</div>\r\n\r\n<div style=\"border:1px solid #e8e9e9; box-sizing:border-box; float:right; padding:22px 37px; width:46%\"><img alt=\"icon-home\" src=\"https://i.ibb.co/5WfDr9V/icon-home.png\" style=\"float:left; margin:-4px 17px -4px 0\" />\r\n<p style=\"margin-left:4px; margin-right:4px\"><a href=\"#\" style=\"color:#2a5adc;\">Sell</a> your apartment</p>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div style=\"color:#777777; font-size:13px; margin-top:30px; text-align:center\">\r\n<p style=\"margin-left:7px; margin-right:7px\">write your query at: info@flipkoti.fi</p>\r\n\r\n<p style=\"margin-left:7px; margin-right:7px\">Follow us on social media</p>\r\n\r\n<div style=\"margin-top:15px\">&nbsp;</div>\r\n</div>\r\n</div>\r\n</div>', '2020-06-03 08:04:05', '2020-06-03 08:04:05', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `email_content`
--
ALTER TABLE `email_content`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `email_content`
--
ALTER TABLE `email_content`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
