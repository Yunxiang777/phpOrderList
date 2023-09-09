-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-06-20 10:30:08
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
-- 資料表結構 `ordervideo_main`
--

CREATE TABLE `ordervideo_main` (
  `ordervideoID` int(11) NOT NULL COMMENT '關於影片的訂單編號',
  `ordervideomemberID` int(11) NOT NULL COMMENT '買家編號',
  `ordervideodDate` date NOT NULL DEFAULT current_timestamp() COMMENT '成立時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `ordervideo_main`
--

INSERT INTO `ordervideo_main` (`ordervideoID`, `ordervideomemberID`, `ordervideodDate`) VALUES
(1, 1, '2023-06-08'),
(2, 6, '2023-06-08'),
(3, 2, '2023-06-08'),
(4, 3, '2023-06-08'),
(5, 3, '2023-06-09'),
(6, 5, '2023-06-10'),
(7, 10, '2023-06-10'),
(8, 10, '2023-06-10'),
(9, 11, '2023-06-11'),
(10, 11, '2023-06-11'),
(11, 18, '2023-06-12'),
(12, 11, '2023-06-12'),
(13, 5, '2023-06-13'),
(14, 14, '2023-06-14'),
(15, 15, '2023-06-15'),
(16, 16, '2023-06-15'),
(17, 15, '2023-06-16'),
(18, 4, '2023-06-16'),
(19, 7, '2023-06-17'),
(20, 1, '2023-06-17');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `ordervideo_main`
--
ALTER TABLE `ordervideo_main`
  ADD PRIMARY KEY (`ordervideoID`),
  ADD KEY `ordervideoID` (`ordervideoID`),
  ADD KEY `ordervideomemberID` (`ordervideomemberID`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `ordervideo_main`
--
ALTER TABLE `ordervideo_main`
  MODIFY `ordervideoID` int(11) NOT NULL AUTO_INCREMENT COMMENT '關於影片的訂單編號', AUTO_INCREMENT=21;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `ordervideo_main`
--
ALTER TABLE `ordervideo_main`
  ADD CONSTRAINT `ordervideo_main_ibfk_1` FOREIGN KEY (`ordervideomemberID`) REFERENCES `member` (`MemberID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
