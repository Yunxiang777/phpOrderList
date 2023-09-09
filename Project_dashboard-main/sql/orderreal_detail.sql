-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-06-20 10:29:23
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
-- 資料表結構 `orderreal_detail`
--

CREATE TABLE `orderreal_detail` (
  `orderrealdetailID` int(11) NOT NULL COMMENT '實體訂單詳情的流水號',
  `orderrealdetail_orderrealID` int(11) NOT NULL COMMENT '是哪個實體訂單的細項',
  `orderrealdetail_PID` int(11) NOT NULL COMMENT '貨號[抓skuID]',
  `buynum` int(255) NOT NULL COMMENT '買幾個'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `orderreal_detail`
--

INSERT INTO `orderreal_detail` (`orderrealdetailID`, `orderrealdetail_orderrealID`, `orderrealdetail_PID`, `buynum`) VALUES
(1, 1, 2, 3),
(2, 1, 10, 1),
(3, 2, 14, 1),
(4, 3, 4, 2),
(5, 4, 20, 3),
(6, 4, 22, 5),
(7, 4, 23, 1),
(8, 5, 11, 1),
(9, 5, 14, 1),
(10, 6, 15, 2),
(11, 6, 18, 2),
(12, 6, 20, 1),
(13, 6, 21, 3),
(14, 7, 10, 1),
(15, 7, 11, 1),
(16, 8, 11, 5),
(17, 8, 12, 7),
(18, 9, 3, 1),
(19, 10, 4, 1),
(20, 10, 5, 1),
(21, 11, 15, 2),
(22, 11, 19, 3),
(23, 11, 20, 1),
(24, 12, 6, 2),
(25, 12, 4, 1),
(26, 12, 7, 1),
(27, 12, 25, 3),
(28, 13, 15, 1),
(29, 13, 16, 1),
(30, 13, 17, 1),
(31, 13, 18, 1),
(32, 14, 16, 2),
(33, 14, 17, 3),
(34, 14, 18, 4),
(35, 14, 19, 6),
(36, 14, 20, 1),
(37, 15, 5, 1),
(38, 15, 6, 1);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `orderreal_detail`
--
ALTER TABLE `orderreal_detail`
  ADD PRIMARY KEY (`orderrealdetailID`),
  ADD KEY `orderrealdetailID` (`orderrealdetailID`),
  ADD KEY `orderrealdetail_orderrealID` (`orderrealdetail_orderrealID`),
  ADD KEY `orderrealdetail_PID` (`orderrealdetail_PID`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `orderreal_detail`
--
ALTER TABLE `orderreal_detail`
  MODIFY `orderrealdetailID` int(11) NOT NULL AUTO_INCREMENT COMMENT '實體訂單詳情的流水號', AUTO_INCREMENT=39;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `orderreal_detail`
--
ALTER TABLE `orderreal_detail`
  ADD CONSTRAINT `orderreal_detail_ibfk_1` FOREIGN KEY (`orderrealdetail_orderrealID`) REFERENCES `orderreal_main` (`orderrealID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderreal_detail_ibfk_2` FOREIGN KEY (`orderrealdetail_PID`) REFERENCES `productall` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
