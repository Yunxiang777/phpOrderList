-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-06-20 10:31:06
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
-- 資料表結構 `sportdata`
--

CREATE TABLE `sportdata` (
  `SportID` int(10) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `METs` float NOT NULL,
  `Img` varchar(20) NOT NULL,
  `Sport_categoryID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- 傾印資料表的資料 `sportdata`
--

INSERT INTO `sportdata` (`SportID`, `Name`, `METs`, `Img`, `Sport_categoryID`) VALUES
(1, '慢走(4公里/時)', 3.5, '01.png', 1),
(2, '快走、健走(6.0公里/時)', 5.5, '02.png', 1),
(3, '下樓梯', 3.2, '03.png', 2),
(4, '上樓梯', 8.4, '04.png', 2),
(5, '慢跑(8公里/時)', 8.2, '05.png', 3),
(6, '快跑(12公里/時)', 12.7, '06.png', 3),
(7, '快跑(16公里/時)', 16.8, '07.png', 3),
(8, '騎腳踏車(一般速度，10公里/時)', 4, '08.png', 4),
(9, '騎腳踏車(快，20公里/時)', 8.4, '09.png', 4),
(10, '騎腳踏車(很快，30公里/時)', 12.6, '10.png', 4),
(11, '拖地', 3.7, '11.png', 5),
(12, '園藝', 4.2, '12.png', 5),
(13, '使用工具製造或修理(如水電工)', 5.3, '13.png', 6),
(14, '耕種、牧場、漁業、林業', 7.4, '14.png', 6),
(15, '搬運重物', 8.4, '15.png', 6),
(16, '瑜珈', 3, '16.png', 7),
(17, '跳舞(慢)、元極舞', 3.1, '17.png', 7),
(18, '跳舞(快)、國際標準舞', 5.3, '18.png', 7),
(19, '飛盤', 3.2, '19.png', 7),
(20, '排球', 3.6, '20.png', 7),
(21, '保齡球', 3.6, '21.png', 7),
(22, '太極拳', 4.2, '22.png', 7),
(23, '乒乓球', 4.2, '23.png', 7),
(24, '棒壘球', 4.7, '24.png', 7),
(25, '高爾夫', 5, '25.png', 7),
(26, '溜直排輪', 5.1, '26.png', 7),
(27, '羽毛球', 5.1, '27.png', 7),
(28, '游泳(慢)', 6.3, '28.png', 7),
(29, '游泳(較快)', 10, '29.png', 7),
(30, '籃球(半場)', 6.3, '30.png', 7),
(31, '籃球(全場)', 8.3, '31.png', 7),
(32, '有氧舞蹈', 6.8, '32.png', 7),
(33, '網球', 6.6, '33.png', 7),
(34, '足球', 7.7, '34.png', 7),
(35, '跳繩(慢)', 8.4, '35.png', 7),
(36, '跳繩(快)', 12.6, '36.png', 7),
(37, '健康操', 4, '37.png', 7),
(38, '划獨木舟', 3.4, '38.png', 7),
(39, '高爾夫球', 3.7, '39.png', 7),
(40, '騎馬(小跑)', 5.1, '40.png', 7),
(41, '溜冰刀(16公里/時)', 5.9, '41.png', 7),
(42, '爬岩(35公尺/時)', 7, '42.png', 7),
(43, '滑雪(16公里/時)', 7.2, '43.png', 7),
(44, '拳擊', 11.4, '44.png', 7),
(45, '划船比賽', 12.4, '45.png', 7);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `sportdata`
--
ALTER TABLE `sportdata`
  ADD PRIMARY KEY (`SportID`),
  ADD KEY `Sport_categoryID` (`Sport_categoryID`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `sportdata`
--
ALTER TABLE `sportdata`
  MODIFY `SportID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `sportdata`
--
ALTER TABLE `sportdata`
  ADD CONSTRAINT `sportdata_ibfk_1` FOREIGN KEY (`Sport_categoryID`) REFERENCES `sport_categoryid` (`Sport_categoryID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
