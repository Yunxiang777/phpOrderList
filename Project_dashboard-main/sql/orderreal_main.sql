-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-06-20 10:29:28
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
-- 資料表結構 `orderreal_main`
--

CREATE TABLE `orderreal_main` (
  `orderrealID` int(11) NOT NULL COMMENT '關於實體的訂單編號',
  `orderrealmemberID` int(11) NOT NULL COMMENT '下訂單買家編號',
  `PAY_methods` varchar(255) NOT NULL COMMENT '付款方式',
  `Shipping_methods` varchar(255) NOT NULL COMMENT '物流方式',
  `receiver` varchar(255) NOT NULL COMMENT '收件人',
  `receiver_phone` varchar(255) NOT NULL,
  `Shipping_address` varchar(255) NOT NULL COMMENT '收件地址',
  `Shipping_code` varchar(255) NOT NULL COMMENT '配送物流條碼',
  `orderreal_date` date NOT NULL DEFAULT current_timestamp() COMMENT '訂單成立日期'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `orderreal_main`
--

INSERT INTO `orderreal_main` (`orderrealID`, `orderrealmemberID`, `PAY_methods`, `Shipping_methods`, `receiver`, `receiver_phone`, `Shipping_address`, `Shipping_code`, `orderreal_date`) VALUES
(1, 1, '信用卡付款', '7-11超商取貨', 'Ada', '0991-778-964', '門市名稱：7-ELEVEN 台北忠孝東路店\r\n地址：台北市大安區忠孝東路四段172號', '71120230611002', '2023-06-02'),
(2, 4, '信用卡付款', '7-11超商取貨', '葉大雄', '0953-557-123', '門市名稱：7-ELEVEN 台中建國北路店\r\n地址：台中市北區建國北路二段76號', '81121230617002', '2023-06-03'),
(3, 6, '信用卡付款', '黑貓宅配', 'Beverly', '0991-778-969', '新北市板橋區中山路一段123號', 'SF20230611001', '2023-06-04'),
(4, 12, 'ATM轉帳', '7-11超商取貨', 'Elva', '0991-778-975', '門市名稱：7-ELEVEN 台南永康中正店\r\n地址：台南市永康區中正北路100號', '11120770633002', '2023-06-12'),
(5, 8, 'ATM轉帳', '黑貓宅配', '王宇軒', '0933-577-623', '高雄市三民區建國二路100號', 'SF85102037450', '2023-06-13'),
(6, 19, '信用卡付款', '黑貓宅配', 'Charlie', '0991-778-982', '台東縣台東市文化公園路200號', 'SF71264385192', '2023-06-14'),
(7, 20, '信用卡付款', '黑貓宅配', 'Sara', '0991-778-983', '新北市鶯歌區館前路300號', 'SF39657201936', '2023-06-14'),
(8, 9, 'ATM轉帳', '7-11超商取貨', 'Caroline', '0991-778-972', '門市名稱：7-ELEVEN新北市中和中和店\r\n地址：新北市中和區中山路一段100號', '71192810643101', '2023-06-15'),
(9, 14, '信用卡付款', '黑貓宅配', 'Nick', '0991-778-977', '彰化縣彰化市中正路二段180號', 'SF30471965843', '2023-06-15'),
(10, 16, '信用卡付款', '黑貓宅配', 'Vanessa', '0991-778-979', '苗栗縣苗栗市中正路一段68號', 'SF29163047215', '2023-06-15'),
(11, 17, '信用卡付款', '黑貓宅配', 'Alice', '0991-778-980', '花蓮縣花蓮市中山路二段80號', 'SF73928106431', '2023-06-15'),
(12, 8, 'ATM轉帳', '7-11超商取貨', '陳雅辰', '0989-333-564', '門市名稱：台中市西屯區高美店\r\n地址：台中市西屯區台中港路十段1000號', '72320770633002', '2023-06-16'),
(13, 9, 'ATM轉帳', '7-11超商取貨', '王浩然', '0955-764-336', '門市名稱：台北市松山區南京店\r\n地址：台北市松山區南京東路九段900號', '99125770633002', '2023-06-16'),
(14, 13, '信用卡付款', '黑貓宅配', 'Maggie', '0991-778-976', '新竹縣竹北市光明六路10號', 'SF29713047895', '2023-06-17'),
(15, 15, '信用卡付款', '黑貓宅配', 'Simon', '0991-778-978', '高雄市鹽埕區真愛路1號', 'SF54774047877', '2023-06-17');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `orderreal_main`
--
ALTER TABLE `orderreal_main`
  ADD PRIMARY KEY (`orderrealID`),
  ADD KEY `orderrealID` (`orderrealID`),
  ADD KEY `orderrealmemberID` (`orderrealmemberID`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `orderreal_main`
--
ALTER TABLE `orderreal_main`
  MODIFY `orderrealID` int(11) NOT NULL AUTO_INCREMENT COMMENT '關於實體的訂單編號', AUTO_INCREMENT=16;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `orderreal_main`
--
ALTER TABLE `orderreal_main`
  ADD CONSTRAINT `orderreal_main_ibfk_1` FOREIGN KEY (`orderrealmemberID`) REFERENCES `member` (`MemberID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
