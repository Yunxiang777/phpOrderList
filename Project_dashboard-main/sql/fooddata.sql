-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-06-20 10:28:53
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
-- 資料表結構 `fooddata`
--

CREATE TABLE `fooddata` (
  `FoodID` int(10) NOT NULL,
  `FoodName` varchar(30) NOT NULL,
  `Calorie` int(10) NOT NULL,
  `Fat` int(10) NOT NULL,
  `Protein` int(10) NOT NULL,
  `Carbohydrates` int(10) NOT NULL,
  `FoodImgID` varchar(20) NOT NULL,
  `Food_categoryID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- 傾印資料表的資料 `fooddata`
--

INSERT INTO `fooddata` (`FoodID`, `FoodName`, `Calorie`, `Fat`, `Protein`, `Carbohydrates`, `FoodImgID`, `Food_categoryID`) VALUES
(1, '蛋炒飯', 300, 10, 40, 12, '01.jpg', 1),
(2, '香腸炒飯', 350, 15, 45, 14, '02.jpg', 1),
(3, '鮮蝦炒麵', 280, 10, 35, 12, '03.jpg', 2),
(4, '牛肉炒飯', 400, 18, 40, 20, '04.jpg', 1),
(5, '鍋燒麵', 450, 12, 70, 13, '05.jpg', 2),
(6, '番茄義大利麵', 350, 8, 55, 12, '06.jpg', 2),
(7, '豬肉燴飯', 450, 13, 65, 17, '07.jpg', 1),
(8, '鴨肉飯', 450, 17, 45, 23, '08.jpg', 1),
(9, '陽春麵', 350, 8, 55, 12, '09.jpg', 2),
(10, '紅燒牛肉麵', 450, 12, 65, 18, '10.jpg', 2),
(11, '鮪魚三明治', 300, 12, 30, 20, '11.jpg', 3),
(12, '燕麥粥', 150, 3, 27, 5, '12.jpg', 4),
(13, '草莓吐司', 200, 3, 38, 6, '13.jpg', 3),
(14, '肉鬆三明治', 350, 18, 35, 13, '14.jpg', 3),
(15, '豬肉總匯', 450, 23, 35, 17, '15.jpg', 3),
(16, '培根蛋餅', 350, 17, 25, 18, '16.jpg', 3),
(17, '火腿蛋吐司', 300, 17, 25, 12, '17.jpg', 3),
(18, '牛排', 300, 18, 3, 27, '18.jpg', 6),
(19, '餛飩麵', 350, 8, 55, 17, '19.jpg', 2),
(20, '豬肉滿福堡', 450, 23, 35, 17, '20.jpg', 3),
(21, '豬舌冬粉', 350, 12, 35, 17, '21.jpg', 2),
(22, '什錦炒麵', 450, 17, 55, 18, '22.jpg', 2),
(23, '鐵板炒麵', 450, 18, 55, 17, '23.jpg', 2),
(24, '海產粥', 250, 8, 35, 17, '24.jpg', 1),
(25, '皮蛋瘦肉粥', 250, 8, 35, 17, '25.jpg', 1),
(26, '燒肉飯', 450, 18, 45, 23, '26.jpg', 1),
(27, '素食沙拉', 150, 7, 15, 7, '27.jpg', 6),
(28, '海鮮燉飯', 350, 15, 50, 20, '28.jpg', 1),
(29, '炸雞', 350, 20, 15, 25, '29.jpg', 6),
(30, '水餃(10顆)', 350, 7, 35, 13, '30.jpg', 6),
(31, '蘑菇燉飯', 350, 7, 55, 13, '31.jpg', 1),
(32, '蛤蜊義大利麵', 500, 15, 70, 20, '32.jpg', 2),
(33, '酸辣湯', 125, 5, 13, 7, '33.jpg', 4),
(34, '肉燥飯', 500, 15, 70, 20, '34.jpg', 1),
(35, '魯肉飯', 500, 15, 70, 20, '35.jpg', 1),
(36, '炒青菜', 50, 1, 8, 3, '36.jpg', 6),
(37, '炸雞腿便當', 700, 35, 60, 35, '37.jpg', 1),
(38, '炸排骨便當', 800, 55, 60, 35, '38.jpg', 1),
(39, '排骨麵', 600, 20, 70, 25, '39.jpg', 2),
(40, '三寶飯', 600, 25, 70, 25, '40.jpg', 1),
(41, '土魠魚羹', 200, 7, 13, 18, '41.jpg', 4),
(42, '豆花', 125, 0, 23, 4, '42.jpg', 6),
(43, '原味蛋餅', 350, 13, 25, 7, '43.jpg', 3),
(44, '燒餅油條', 350, 18, 35, 7, '44.jpg', 3),
(45, '泡麵', 375, 18, 55, 10, '45.jpg', 2),
(46, '炒烏龍', 350, 13, 55, 10, '46.jpg', 2),
(47, '韓式泡菜豆腐鍋', 450, 18, 55, 18, '47.jpg', 6),
(48, '咖哩飯', 550, 18, 65, 13, '48.jpg', 1),
(49, '叉燒拉麵', 550, 18, 65, 18, '49.jpg', 2),
(50, '奶茶', 125, 4, 18, 2, '50.jpg', 5),
(51, '紅茶', 50, 0, 13, 0, '51.jpg', 5),
(52, '豆漿', 130, 7, 18, 6, '52.jpg', 5),
(53, '可樂', 145, 0, 40, 0, '53.jpg', 5),
(54, '拿鐵', 150, 6, 14, 9, '54.jpg', 5),
(55, '柳橙汁', 125, 1, 27, 2, '55.jpg', 5),
(56, '红酒', 135, 0, 3, 0, '56.jpg', 5),
(57, '牛奶', 135, 6, 14, 9, '57.jpg', 5),
(58, '貢丸湯', 125, 4, 13, 7, '58.jpg', 4),
(59, '榨菜肉絲湯', 125, 4, 13, 7, '59.jpg', 4),
(60, '豬排蓋飯', 450, 20, 55, 25, '60.jpg', 1);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `fooddata`
--
ALTER TABLE `fooddata`
  ADD PRIMARY KEY (`FoodID`),
  ADD KEY `FoodID` (`FoodID`),
  ADD KEY `Food_categoryID` (`Food_categoryID`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `fooddata`
--
ALTER TABLE `fooddata`
  MODIFY `FoodID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `fooddata`
--
ALTER TABLE `fooddata`
  ADD CONSTRAINT `fooddata_ibfk_1` FOREIGN KEY (`Food_categoryID`) REFERENCES `food_category` (`Food_categoryID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
