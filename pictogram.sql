-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 26, 2022 lúc 03:27 PM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `pictogram`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `full_name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `full_name`, `email`, `password`) VALUES
(1, 'Nguyễn Admin', 'admin@gmail.com', 'e99a18c428cb38d5f260853678922e03');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `block_list`
--

DROP TABLE IF EXISTS `block_list`;
CREATE TABLE `block_list` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `blocked_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `block_list`
--

INSERT INTO `block_list` (`id`, `user_id`, `blocked_user_id`) VALUES
(5, 8, 9),
(24, 0, 0),
(25, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `collections`
--

DROP TABLE IF EXISTS `collections`;
CREATE TABLE `collections` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `file_name` text NOT NULL,
  `type` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `collections`
--

INSERT INTO `collections` (`id`, `post_id`, `file_name`, `type`) VALUES
(1, 14, '90769688271755102_480068890156758_5925141254368890403_n.jpg', 1),
(2, 14, '28868021272613539_488541079309539_8168521742465843460_n.jpg', 1),
(3, 15, '50047124Dốc Cơ Bến Tre.mp4', 0),
(4, 16, '678457509de1672b3376f828a167.jpg', 1),
(5, 17, '99335089Hayd - Head In The Clouds (Official Video).mp4', 0),
(6, 17, '31443491pexels-sharmaine-monticalbo-4659978.jpg', 1),
(7, 19, '40741129Không thuộc về _ Minh Lý ( Music Past live )- Đúng vậy , em đẹp nhất trên thế gian này....mp4', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `comment`, `created_at`) VALUES
(3, 5, 8, 'this is awesome guys', '2021-12-02 17:44:26'),
(4, 5, 8, 'dfg', '2021-12-02 17:46:43'),
(5, 5, 8, 'ok just testing', '2021-12-02 17:51:50'),
(6, 5, 8, 'nice', '2021-12-02 17:52:00'),
(7, 5, 8, 'sdfdsf', '2021-12-02 17:52:26'),
(8, 5, 8, 'sdfsdf', '2021-12-02 17:52:27'),
(9, 5, 8, 'sdfsdf', '2021-12-02 17:52:28'),
(10, 5, 8, 'sdfsdf', '2021-12-02 17:52:29'),
(11, 5, 8, 'sdfsdf', '2021-12-02 17:52:31'),
(12, 5, 8, 'sdfsdf', '2021-12-02 17:52:32'),
(13, 7, 8, 'this is awesome game', '2021-12-02 18:04:36'),
(14, 3, 8, 'this is aweosme project', '2021-12-02 18:05:49'),
(15, 7, 10, 'wowo, just super cool', '2021-12-02 18:07:31'),
(16, 8, 10, 'nice and funny', '2021-12-02 18:09:17'),
(17, 6, 10, 'awesome', '2021-12-02 18:12:01'),
(18, 5, 10, 'nice pic', '2021-12-02 18:15:12'),
(19, 4, 10, 'super cool man congrats', '2021-12-02 18:15:34'),
(21, 1, 10, 'super cool', '2021-12-02 18:22:24'),
(22, 5, 10, 'super nice', '2021-12-02 18:23:18'),
(23, 9, 10, 'super cool', '2021-12-02 18:24:44'),
(24, 4, 10, 'thanks bro', '2021-12-02 18:26:02'),
(25, 2, 8, 'looking awesome bro', '2021-12-04 10:55:57'),
(27, 8, 10, 'this is my fav image', '2021-12-04 11:18:13'),
(28, 4, 10, 'congrats guys', '2021-12-04 11:37:42'),
(29, 9, 8, 'nice pic brother ', '2021-12-04 12:09:12'),
(30, 9, 10, 'thanks brother', '2021-12-04 12:09:36'),
(32, 10, 8, 'super cool', '2021-12-04 12:24:06'),
(34, 5, 8, 'aweomse', '2021-12-04 12:45:09'),
(38, 10, 8, 'ok bye then', '2021-12-04 16:40:00'),
(39, 10, 8, 'cool', '2021-12-04 16:44:10'),
(40, 9, 8, 'ok nice', '2021-12-04 16:50:21'),
(41, 10, 8, 'good', '2021-12-04 16:51:22'),
(42, 1, 8, 'Nice pic', '2021-12-05 05:44:25'),
(43, 9, 11, 'Hii bro', '2021-12-05 06:52:16'),
(44, 12, 10, 'awesome pic bro', '2021-12-06 08:17:41'),
(45, 5, 10, 'nice girls', '2021-12-06 08:19:08'),
(46, 5, 8, 'Thanks', '2021-12-06 08:25:30'),
(47, 6, 11, 'Awesosm', '2021-12-07 10:24:33'),
(51, 14, 13, 'Yes', '2022-09-12 08:47:11'),
(59, 16, 19, 'Bạn mặc áo bò đẹp zai quá <3', '2022-09-12 16:01:26'),
(108, 16, 3, 'Haha công nhận đấy', '2022-09-13 03:56:03'),
(111, 14, 3, 'Uwow', '2022-09-13 04:00:32'),
(112, 18, 3, 'Really???', '2022-09-13 04:00:56'),
(123, 18, 13, 'Mé giờ mới có 3 like', '2022-09-13 17:16:54'),
(124, 19, 13, 'Ad từ mai viết rõ tên bài hát đi ạ', '2022-09-13 17:37:19'),
(125, 19, 20, 'a', '2022-09-13 17:43:24'),
(139, 18, 19, 'ukm', '2022-09-19 06:49:09'),
(140, 17, 20, 'Bài viết này hay quá!', '2022-09-27 07:06:18'),
(141, 17, 13, 'a', '2022-09-27 14:01:56'),
(142, 19, 19, 'thôi kệ đi bạn', '2022-09-27 14:06:25'),
(143, 15, 13, 'a', '2022-09-27 17:28:11'),
(144, 18, 13, '4 like rồi ae', '2022-09-27 17:46:44'),
(146, 19, 13, 'Nhạc hay quá', '2022-10-24 15:14:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `follow_list`
--

DROP TABLE IF EXISTS `follow_list`;
CREATE TABLE `follow_list` (
  `id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `follow_list`
--

INSERT INTO `follow_list` (`id`, `follower_id`, `user_id`) VALUES
(13, 9, 3),
(15, 9, 6),
(38, 10, 3),
(42, 10, 7),
(43, 10, 9),
(57, 8, 4),
(58, 8, 5),
(66, 10, 11),
(68, 11, 10),
(69, 11, 7),
(70, 11, 9),
(71, 11, 3),
(78, 3, 13),
(84, 13, 3),
(92, 13, 19),
(94, 20, 19),
(97, 19, 20),
(99, 13, 5),
(100, 13, 20),
(101, 19, 13),
(102, 20, 13);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `likes`
--

INSERT INTO `likes` (`id`, `post_id`, `user_id`) VALUES
(17, 3, 8),
(30, 7, 9),
(31, 5, 9),
(45, 7, 8),
(49, 3, 10),
(56, 9, 10),
(57, 5, 10),
(67, 1, 8),
(69, 6, 10),
(74, 10, 8),
(79, 9, 11),
(88, 12, 10),
(89, 5, 8),
(90, 2, 8),
(100, 17, 13),
(101, 17, 19),
(108, 15, 13),
(110, 16, 19),
(111, 18, 3),
(119, 14, 3),
(167, 17, 3),
(202, 16, 3),
(218, 14, 13),
(220, 18, 13),
(221, 18, 20),
(222, 17, 20),
(225, 18, 19),
(226, 19, 20),
(227, 19, 13),
(228, 19, 19),
(229, 15, 19),
(230, 15, 20),
(231, 16, 13);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `msg` text NOT NULL,
  `read_status` int(11) NOT NULL DEFAULT 0,
  `request` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `messages`
--

INSERT INTO `messages` (`id`, `from_user_id`, `to_user_id`, `msg`, `read_status`, `request`, `created_at`) VALUES
(27, 8, 10, 'hii amit', 1, 0, '2021-12-07 10:47:18'),
(28, 8, 11, 'hii pankaj', 1, 0, '2021-12-07 10:47:44'),
(29, 11, 8, 'Hii monu bro', 1, 0, '2021-12-07 10:48:03'),
(30, 8, 11, 'ok get it', 1, 0, '2021-12-07 10:48:15'),
(31, 11, 8, 'Thanks for unblocking me', 1, 0, '2021-12-07 11:05:27'),
(32, 11, 8, 'No I am going to block you', 1, 0, '2021-12-07 11:05:52'),
(33, 10, 8, 'Hii bro', 1, 0, '2021-12-07 11:10:12'),
(34, 8, 10, 'hii man', 1, 0, '2021-12-07 11:10:26'),
(35, 10, 8, 'So what are you doing', 1, 0, '2021-12-07 11:10:39'),
(36, 8, 10, 'nothing big you tell', 1, 0, '2021-12-07 11:11:00'),
(37, 10, 8, 'Ohh same here', 1, 0, '2021-12-07 11:11:08'),
(38, 8, 10, 'lets go for party then', 1, 0, '2021-12-07 11:11:30'),
(39, 10, 8, 'Ya sure', 1, 0, '2021-12-07 11:11:37'),
(40, 8, 10, 'ok bye', 1, 0, '2021-12-07 11:11:53'),
(41, 20, 13, 'hello', 1, 0, '2022-09-21 16:51:25'),
(42, 20, 13, 'How are you', 1, 0, '2022-09-21 16:54:39'),
(43, 13, 20, 'ai vậy?', 1, 0, '2022-10-03 03:17:43'),
(44, 20, 13, 'Tôi là chill nhạc hây', 1, 0, '2022-10-03 03:17:43'),
(45, 13, 20, 'Thì kệ ông chứ', 1, 0, '2022-10-03 18:01:49'),
(46, 20, 13, 'Ông chưa ngủ à', 1, 0, '2022-10-03 18:07:38'),
(47, 13, 20, 'Tôi chưa, đang làm nốt mấy bài này đã', 1, 0, '2022-10-03 18:08:20'),
(48, 20, 13, 'Làm cái gì đấy', 1, 0, '2022-10-03 18:08:54'),
(49, 20, 13, 'Bài tập về nhà á', 1, 0, '2022-10-03 18:09:14'),
(50, 20, 13, 'Ông vẫn chưa làm xong à', 1, 0, '2022-10-03 18:09:27'),
(51, 13, 20, 'a', 1, 0, '2022-10-04 10:36:46'),
(52, 13, 20, 'Chưa', 1, 0, '2022-10-04 10:50:38'),
(53, 13, 20, 'Thế ông làm chưa?', 1, 0, '2022-10-04 10:59:15'),
(54, 20, 13, 'Tôi còn 2 bài cuối', 1, 0, '2022-10-05 03:00:04'),
(55, 20, 13, 'Ông làm được tý gì chưa?', 1, 0, '2022-10-05 03:00:54'),
(56, 13, 20, 'Mé còn chưa động đây này :v', 1, 0, '2022-10-05 03:02:11'),
(57, 13, 20, 'Lười vc haha', 1, 0, '2022-10-05 03:02:37'),
(58, 20, 13, 'Lười cc làm 2 bài cuối đi bạn', 1, 0, '2022-10-05 03:03:06'),
(59, 13, 20, 'Để tôi ngủ suy nghĩ đã', 1, 0, '2022-10-05 03:04:52'),
(60, 20, 13, 'Ngủ cc', 1, 0, '2022-10-05 03:05:35'),
(61, 13, 20, 'Chúc ngủ ngon mơ đẹp', 1, 0, '2022-10-05 03:06:44'),
(62, 13, 20, 'Mà ông ngủ đi', 1, 0, '2022-10-05 03:07:45'),
(63, 20, 13, 'Đcm m không nấu cơm à vklcc', 1, 0, '2022-10-05 03:08:23'),
(64, 13, 20, 'Ukm', 1, 0, '2022-10-05 14:32:03'),
(65, 13, 20, 'Ông là cái gì mà ra lệnh', 1, 0, '2022-10-05 14:34:36'),
(66, 13, 20, 'Ông chỉ là cái thằng', 1, 0, '2022-10-05 14:44:11'),
(67, 20, 13, 'Thằng gì bạn?', 1, 0, '2022-10-05 14:46:39'),
(68, 20, 13, 'Nói rõ ra được không?', 1, 0, '2022-10-05 14:48:36'),
(69, 13, 20, 'Ấy ý', 1, 0, '2022-10-05 14:49:34'),
(70, 20, 13, 'Ukm', 1, 0, '2022-10-05 15:20:43'),
(71, 13, 20, 'Hello', 1, 0, '2022-10-08 07:12:18'),
(72, 13, 20, 'Đang làm gì đấy', 1, 0, '2022-10-08 07:12:52'),
(73, 20, 13, 'Đang học bạn ạ', 1, 0, '2022-10-08 07:13:06'),
(75, 13, 19, 'Xin chào bạn', 1, 0, '2022-10-08 17:18:26'),
(76, 13, 20, 'Ukm', 1, 0, '2022-10-09 14:11:55'),
(77, 13, 19, 'Mình tên là Đức', 1, 0, '2022-10-09 14:33:25'),
(78, 13, 20, 'Ngày hôm đấy bạn học à', 1, 0, '2022-10-09 14:36:04'),
(79, 13, 19, 'Mong bạn rep nhanh', 1, 0, '2022-10-09 15:12:18'),
(80, 20, 13, 't đi mà m', 1, 0, '2022-10-09 15:24:16'),
(81, 19, 13, 'Ai vậy tar???', 1, 0, '2022-10-09 15:25:42'),
(82, 19, 13, 'Tôi không quen', 1, 0, '2022-10-09 15:26:26'),
(83, 13, 20, 'Ngủ ngon nhé bạn', 1, 0, '2022-10-10 18:14:43'),
(84, 20, 13, 'Bạn cũng vậy nhé!', 1, 0, '2022-10-10 18:15:11'),
(97, 21, 13, 'Hi', 1, 0, '2022-10-13 16:57:19'),
(98, 21, 13, 'Chào bạn', 1, 0, '2022-10-13 16:57:55'),
(99, 13, 21, 'Ai vậy?', 1, 0, '2022-10-13 16:59:30'),
(100, 21, 13, 'Tôi Triết đây', 1, 0, '2022-10-13 16:59:48'),
(101, 13, 20, 'Dạo này đăng tý ca hát đi bạn', 1, 0, '2022-10-13 17:01:07'),
(102, 13, 20, 'Hello', 1, 0, '2022-10-15 03:00:32'),
(103, 20, 13, 'Nay đi học không?', 1, 0, '2022-10-15 03:01:50'),
(104, 13, 20, 'Có', 1, 0, '2022-10-15 03:02:01'),
(105, 13, 20, 'Hôm nay đi học không vậy?', 1, 0, '2022-10-25 03:11:54'),
(106, 22, 13, 'Xin chào', 1, 0, '2022-10-25 03:28:19'),
(107, 13, 22, 'Ai vậy', 0, 0, '2022-10-25 03:29:39');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `read_status` int(11) NOT NULL DEFAULT 0,
  `url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `notifications`
--

INSERT INTO `notifications` (`id`, `from_user_id`, `to_user_id`, `message`, `created_at`, `read_status`, `url`) VALUES
(101, 13, 20, 'commented on your post.', '2022-09-18 17:14:24', 1, '/pictogram/post?post_id=19&comment_id=138'),
(102, 13, 19, 'followed you.', '2022-09-19 06:44:00', 0, '/pictogram/account?user=ducnguyen'),
(103, 19, 13, 'liked your post.', '2022-09-19 06:47:32', 1, '/pictogram/post?post_id=18'),
(104, 19, 13, 'commented on your post.', '2022-09-19 06:49:09', 1, '/pictogram/post?post_id=18&comment_id=139'),
(106, 20, 19, 'followed you.', '2022-09-27 07:05:10', 1, '/pictogram/account?user=musicchill'),
(108, 20, 13, 'commented on your post.', '2022-09-27 07:06:18', 1, '/pictogram/post?post_id=17&comment_id=140'),
(109, 13, 20, 'liked your post.', '2022-09-27 07:15:17', 1, '/pictogram/post?post_id=19'),
(110, 13, 20, 'followed you.', '2022-09-27 14:03:41', 1, '/pictogram/account?user=ducnguyen'),
(111, 19, 20, 'liked your post.', '2022-09-27 14:06:10', 1, '/pictogram/post?post_id=19'),
(112, 19, 20, 'commented on your post.', '2022-09-27 14:06:25', 1, '/pictogram/post?post_id=19&comment_id=142'),
(113, 13, 19, 'commented on your post.', '2022-09-27 17:28:11', 1, '/pictogram/post?post_id=15&comment_id=143'),
(114, 19, 20, 'followed you.', '2022-09-27 17:45:05', 0, '/pictogram/account?user=minhnghia'),
(115, 19, 20, 'commented on your post.', '2022-09-27 17:49:36', 1, '/pictogram/post?post_id=19&comment_id=145'),
(116, 20, 19, 'liked your post.', '2022-09-27 17:51:20', 0, '/pictogram/post?post_id=15'),
(118, 13, 5, 'followed you.', '2022-10-05 15:17:39', 0, '/pictogram/account?user=ducnguyen'),
(119, 13, 20, 'followed you.', '2022-10-10 18:14:21', 0, '/pictogram/account?user=ducnguyen'),
(120, 19, 13, 'followed you.', '2022-10-12 14:55:17', 1, '/pictogram/account?user=minhnghia'),
(121, 20, 13, 'followed you.', '2022-10-12 14:55:51', 0, '/pictogram/account?user=musicchill'),
(122, 13, 21, 'followed you.', '2022-10-13 03:20:19', 1, '/pictogram/account?user=ducnguyen'),
(123, 13, 20, 'commented on your post.', '2022-10-24 15:14:09', 0, '/pictogram/post?post_id=19&comment_id=146'),
(125, -1, 21, 'Your post has been hidden because it contains sensitive words. After 24 hours waiting for admin approval.', '2022-10-25 00:53:51', 1, '/pictogram/post?post_id=30'),
(126, -1, 22, 'Your post has been hidden because it contains sensitive words. After 24 hours waiting for admin approval.', '2022-10-25 03:31:42', 1, '/pictogram/post?post_id=31'),
(127, 22, 13, 'commented on your post.', '2022-10-26 03:36:04', 1, '/pictogram/post?post_id=18&comment_id=147');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `hidden` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `post_text`, `created_at`, `hidden`) VALUES
(1, 8, 'this is my first image post', '2021-11-27 18:54:22', 0),
(2, 8, '', '2021-11-27 19:07:49', 0),
(3, 6, 'my fisrt web app', '2021-11-27 19:15:08', 0),
(5, 8, 'say hii to everyone', '2021-11-27 19:19:34', 0),
(7, 6, '', '2021-11-30 03:44:23', 0),
(9, 10, '', '2021-12-02 18:19:59', 0),
(14, 13, 'Cute girl!!!', '2022-08-31 09:41:50', 0),
(15, 19, 'Joker 97 :)))', '2022-08-31 09:47:38', 0),
(16, 13, 'My friend <3', '2022-09-03 09:43:38', 0),
(17, 13, 'Hi ', '2022-09-06 03:36:56', 0),
(18, 13, 'If this post reaches 100 likes, I promise to flirt with my crush <3', '2022-09-11 09:06:52', 0),
(19, 20, 'Có lẽ trái tim em, anh không thể hack được :((', '2022-09-13 17:27:56', 0),
(31, 22, 'ĐCM thằng chó. Vãi lồn', '2022-10-25 03:31:42', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `report_list`
--

DROP TABLE IF EXISTS `report_list`;
CREATE TABLE `report_list` (
  `id` int(11) NOT NULL,
  `reporter_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` tinyint(6) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `report_list`
--

INSERT INTO `report_list` (`id`, `reporter_id`, `user_id`, `type`, `type_id`) VALUES
(1, 13, 22, 0, 0),
(2, 13, 19, 2, 142),
(3, 13, 20, 1, 19),
(4, 13, 20, 0, 0),
(5, 19, 20, 1, 19),
(6, 19, 13, 1, 17),
(7, 19, 13, 1, 18),
(8, 22, 19, 0, 0),
(9, 22, 20, 0, 0),
(10, 22, 5, 0, 0),
(12, -1, 21, 3, 30),
(13, -1, 22, 3, 31);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `profile_pic` text NOT NULL DEFAULT 'default_profile.jpg',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ac_status` int(11) NOT NULL COMMENT '0=not verified,1=active,2=blocked'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `gender`, `email`, `username`, `password`, `profile_pic`, `created_at`, `updated_at`, `ac_status`) VALUES
(3, 'Mohans', 'Giri', 0, 'whomonugiri2@gmail.com', 'whomonugiri', 'e99a18c428cb38d5f260853678922e03', '2907633520210615_224200.jpg', '2021-11-19 08:54:47', '2022-09-06 14:15:08', 1),
(4, 'Mohans', 'Giri', 0, 'whomonugirdfgfi@gmail.com', 'asdsd', 'c68710d3fe56fc88f7905cb15f06cf5c', 'default_profile.jpg', '2021-11-22 02:34:06', '2022-09-06 14:02:52', 1),
(5, 'Mohans', 'Giri', 1, 'workwithmohan@gmail.com', 'oyeitsmgasdasd', 'c68710d3fe56fc88f7905cb15f06cf5c', 'default_profile.jpg', '2021-11-23 12:00:13', '2022-10-18 08:05:00', 0),
(6, 'Mohans', 'Giri', 1, 'mailtomonugiri@gmail.com', 'oyeitsmgasd', '970af30e481057c48f87e101b61e6994', 'default_profile.jpg', '2021-11-23 13:24:40', '2022-10-18 08:05:07', 2),
(7, 'Monu', 'Giri', 1, 'officialmohankumar@gmail.com', 'iamtheking', 'e10adc3949ba59abbe56e057f20f883e', '1637830104profile7.jpg', '2021-11-25 08:45:24', '2021-11-25 08:49:44', 1),
(8, 'Monu', 'Giri', 1, 'whomonugiri@gmail.com', 'devninja', '970af30e481057c48f87e101b61e6994', '1638035490IMG_20210217_172513 (1).jpg', '2021-11-26 16:53:17', '2021-11-27 17:51:30', 1),
(9, 'Test', 'Kumar', 1, 'test@gmail.com', 'testman', 'e10adc3949ba59abbe56e057f20f883e', '1638244233bot.png', '2021-11-30 03:45:35', '2021-11-30 03:50:33', 1),
(10, 'Amit', 'Sharma', 1, 'amith@gmail.com', 'amithero', 'e10adc3949ba59abbe56e057f20f883e', '1638468543profile8.jpg', '2021-12-02 18:06:37', '2021-12-02 18:09:03', 1),
(11, 'Pankaj', 'Mishra', 1, 'officialmohankumar12@gmail.com', 'pankaj1427', 'e10adc3949ba59abbe56e057f20f883e', '1638686483IMG-20211130-WA0023.jpg', '2021-12-05 06:36:14', '2021-12-05 07:16:41', 1),
(13, 'Nguyễn', 'Đức', 1, 'tivinha0944256436@gmail.com', 'ducnguyen', 'e99a18c428cb38d5f260853678922e03', '54060602z3067859906632_f24450fa8306da101b4ea424feffd74f.jpg', '2022-08-22 14:54:20', '2022-10-25 03:37:28', 1),
(19, 'Trần Minh', 'Nghĩa', 1, 'domtranminhnghia@gmail.com', 'minhnghia', 'e99a18c428cb38d5f260853678922e03', 'default_profile.jpg', '2022-08-30 13:22:32', '2022-08-30 13:22:32', 1),
(20, 'Music', 'Chill', 1, 'ros094425643@gmail.com', 'musicchill', 'e99a18c428cb38d5f260853678922e03', '57576221unnamed.jpg', '2022-09-13 17:24:27', '2022-09-13 17:40:31', 1),
(21, 'Phạm Minh', 'Triết', 0, 'phamtriet@gmail.com', 'phamtriet', 'e99a18c428cb38d5f260853678922e03', 'default_profile.jpg', '2022-10-12 15:46:25', '2022-10-12 15:46:25', 1),
(22, 'Nguyễn', 'Gia Huy', 1, 'giahuy@gmail.com', 'giahuy', 'e99a18c428cb38d5f260853678922e03', 'default_profile.jpg', '2022-10-25 03:27:19', '2022-10-25 03:27:19', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `block_list`
--
ALTER TABLE `block_list`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `collections`
--
ALTER TABLE `collections`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `follow_list`
--
ALTER TABLE `follow_list`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `report_list`
--
ALTER TABLE `report_list`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `block_list`
--
ALTER TABLE `block_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `collections`
--
ALTER TABLE `collections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT cho bảng `follow_list`
--
ALTER TABLE `follow_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT cho bảng `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;

--
-- AUTO_INCREMENT cho bảng `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT cho bảng `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `report_list`
--
ALTER TABLE `report_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
