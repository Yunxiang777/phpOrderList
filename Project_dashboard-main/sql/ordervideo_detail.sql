-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-06-20 10:29:36
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
-- 資料表結構 `ordervideo_detail`
--

CREATE TABLE `ordervideo_detail` (
  `ordervideoDetail_ID` int(11) NOT NULL COMMENT '影片訂單詳情流水號',
  `ordervideoDetail_ordervideoID` int(11) NOT NULL COMMENT '關於影片的訂單編號',
  `Buysub_ornot` tinyint(1) NOT NULL COMMENT '是買訂閱嗎?',
  `sub_time` int(255) DEFAULT NULL COMMENT '訂閱多久(天)',
  `ordervideoDetail_VideoID` int(11) DEFAULT NULL COMMENT '買斷哪支影片',
  `canview_startTime` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '觀看權限開始',
  `canview_endTime` timestamp NULL DEFAULT NULL COMMENT '訂閱:設時間斷點;\r\n買斷:沒有辦法到達的時間,不是未來,是過去'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `ordervideo_detail`
--

INSERT INTO `ordervideo_detail` (`ordervideoDetail_ID`, `ordervideoDetail_ordervideoID`, `Buysub_ornot`, `sub_time`, `ordervideoDetail_VideoID`, `canview_startTime`, `canview_endTime`) VALUES
(1, 1, 0, NULL, 1, '2023-06-07 19:49:24', '0000-00-00 00:00:00'),
(2, 2, 0, NULL, 9, '2023-06-08 06:12:36', '0000-00-00 00:00:00'),
(3, 2, 1, 365, NULL, '2023-06-08 06:12:36', '2024-06-07 06:12:36'),
(4, 3, 0, NULL, 6, '2023-06-08 11:19:16', '0000-00-00 00:00:00'),
(5, 3, 0, NULL, 7, '2023-06-08 11:19:16', '0000-00-00 00:00:00'),
(6, 4, 1, 90, NULL, '2023-06-08 13:21:54', '2023-09-06 13:21:54'),
(7, 4, 0, NULL, 2, '2023-06-08 13:21:54', '0000-00-00 00:00:00'),
(8, 5, 1, 90, NULL, '2023-06-08 20:23:32', '2023-09-06 20:23:32'),
(9, 5, 0, NULL, 7, '2023-06-08 20:23:32', '0000-00-00 00:00:00'),
(10, 6, 1, 180, NULL, '2023-06-09 21:52:58', '2023-12-06 21:52:58'),
(11, 7, 0, NULL, 8, '2023-06-09 22:00:49', '0000-00-00 00:00:00'),
(12, 7, 0, NULL, 9, '2023-06-09 22:00:49', '0000-00-00 00:00:00'),
(13, 8, 0, NULL, 10, '2023-06-09 23:00:49', '0000-00-00 00:00:00'),
(14, 9, 0, NULL, 10, '2023-06-10 19:12:36', '0000-00-00 00:00:00'),
(15, 10, 1, 90, NULL, '2023-06-11 14:32:42', '2023-09-09 14:32:42'),
(16, 11, 0, NULL, 7, '2023-06-12 05:40:19', '0000-00-00 00:00:00'),
(17, 11, 0, NULL, 11, '2023-06-12 05:40:19', '0000-00-00 00:00:00'),
(18, 11, 0, NULL, 13, '2023-06-12 05:40:19', '0000-00-00 00:00:00'),
(19, 12, 0, NULL, 1, '2023-06-12 09:44:02', '0000-00-00 00:00:00'),
(20, 12, 0, NULL, 2, '2023-06-12 09:44:02', '0000-00-00 00:00:00'),
(21, 13, 0, NULL, 1, '2023-06-13 03:46:27', '0000-00-00 00:00:00'),
(22, 14, 1, 365, NULL, '2023-06-14 14:48:37', '2024-06-13 14:48:37'),
(23, 15, 1, 365, NULL, '2023-06-14 23:50:07', '2024-06-13 23:50:07'),
(24, 16, 0, NULL, 11, '2023-06-14 17:51:45', '0000-00-00 00:00:00'),
(25, 16, 0, NULL, 19, '2023-06-14 17:51:45', '0000-00-00 00:00:00'),
(26, 16, 0, NULL, 20, '2023-06-14 17:51:45', '0000-00-00 00:00:00'),
(27, 17, 0, NULL, 4, '2023-06-15 21:53:59', '0000-00-00 00:00:00'),
(28, 17, 0, NULL, 5, '2023-06-15 21:53:59', '0000-00-00 00:00:00'),
(29, 18, 1, 90, NULL, '2023-06-16 14:55:50', '2023-09-15 14:55:50'),
(30, 19, 1, 180, NULL, '2023-06-17 12:58:20', '2023-12-14 12:58:20'),
(31, 20, 0, NULL, 5, '2023-06-17 14:59:49', '0000-00-00 00:00:00'),
(32, 20, 0, NULL, 6, '2023-06-17 14:59:49', '0000-00-00 00:00:00'),
(33, 20, 0, NULL, 7, '2023-06-17 14:59:49', '0000-00-00 00:00:00');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `ordervideo_detail`
--
ALTER TABLE `ordervideo_detail`
  ADD PRIMARY KEY (`ordervideoDetail_ID`),
  ADD KEY `ordervideoDetail_ID` (`ordervideoDetail_ID`),
  ADD KEY `ordervideoDetail_ordervideoID` (`ordervideoDetail_ordervideoID`),
  ADD KEY `ordervideoDetail_VideoID` (`ordervideoDetail_VideoID`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `ordervideo_detail`
--
ALTER TABLE `ordervideo_detail`
  MODIFY `ordervideoDetail_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '影片訂單詳情流水號', AUTO_INCREMENT=34;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `ordervideo_detail`
--
ALTER TABLE `ordervideo_detail`
  ADD CONSTRAINT `ordervideo_detail_ibfk_1` FOREIGN KEY (`ordervideoDetail_ordervideoID`) REFERENCES `ordervideo_main` (`ordervideoID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ordervideo_detail_ibfk_2` FOREIGN KEY (`ordervideoDetail_VideoID`) REFERENCES `fitvideos` (`VideoID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
