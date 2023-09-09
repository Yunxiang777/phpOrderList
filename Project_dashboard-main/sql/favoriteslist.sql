-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-06-20 10:28:43
-- 伺服器版本： 10.4.28-MariaDB
-- PHP 版本： 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `project`
--

-- --------------------------------------------------------

--
-- 資料表結構 `favoriteslist`
--

CREATE TABLE `favoriteslist` (
  `favorites_list_id` int(11) NOT NULL COMMENT '收藏清單id',
  `user_id` int(11) NOT NULL COMMENT '會員ID',
  `p_id` int(11) NOT NULL COMMENT '商品ID',
  `video_id` int(11) NOT NULL COMMENT 'videoID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `favoriteslist`
--
ALTER TABLE `favoriteslist`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `video_id` (`video_id`);

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `favoriteslist`
--
ALTER TABLE `favoriteslist`
  ADD CONSTRAINT `favoriteslist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `member` (`MemberID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favoriteslist_ibfk_3` FOREIGN KEY (`video_id`) REFERENCES `fitvideos` (`VideoID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favoriteslist_ibfk_4` FOREIGN KEY (`p_id`) REFERENCES `productall` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
