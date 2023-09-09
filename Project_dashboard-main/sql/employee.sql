-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-06-20 10:28:38
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
-- 資料表結構 `employee`
--

CREATE TABLE `employee` (
  `e_id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL,
  `password` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `gender` char(1) NOT NULL COMMENT 'M-男性;F-女性',
  `birthday` date NOT NULL,
  `role` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- 傾印資料表的資料 `employee`
--

INSERT INTO `employee` (`e_id`, `name`, `password`, `email`, `gender`, `birthday`, `role`) VALUES
(1, '王韻翔', 'p_01', 'yunxiangwang777@gmail.com', 'M', '1994-01-23', '購物車結帳、管理訂單、金流處理'),
(2, '張溦珊', 'p_02', 'shiaushen@gmail.com', 'F', '1995-06-09', '管理食物營養數據、身體數據、製作圖表'),
(3, '曾雅娸', 'p_03', 'yiachi2221@gmail.com', 'F', '1996-10-10', '會員管理、員工管理'),
(4, '周珈妃', 'p_04', 'imlucky8652@gmail.com', 'F', '1997-07-31', '影片管理，追蹤使用者觀看紀錄，訂閱資訊管理'),
(5, '沈彤', 'p_05', 'bwya000@gmail.com', 'F', '2000-01-05', '商品管理，收藏管理');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`e_id`),
  ADD KEY `e_id` (`e_id`),
  ADD KEY `e_id_2` (`e_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `employee`
--
ALTER TABLE `employee`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
