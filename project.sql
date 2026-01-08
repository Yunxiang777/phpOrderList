-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-09-09 14:11:44
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
-- 資料表結構 `body_record`
--

CREATE TABLE `body_record` (
  `RecordID` int(10) NOT NULL,
  `MemberID` int(10) NOT NULL,
  `Height` int(10) NOT NULL,
  `Weight` float NOT NULL,
  `Body_fat_percent` float NOT NULL,
  `Waist` float NOT NULL,
  `Sleev_muscle` float NOT NULL,
  `Activity_coefficient` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
  `role` tinytext NOT NULL,
  `avatarname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- 傾印資料表的資料 `employee`
--

INSERT INTO `employee` (`e_id`, `name`, `password`, `email`, `gender`, `birthday`, `role`, `avatarname`) VALUES
(1, '王韻翔', 'p_01', 'yunxiangwang777@gmail.com', 'M', '1994-01-23', '購物車結帳、管理訂單、金流處理', '1.jpg'),
(2, '張溦珊', 'p_02', 'shiaushen@gmail.com', 'F', '1995-06-09', '管理食物營養數據、身體數據、製作圖表', '2.jpg'),
(3, '曾雅娸', 'p_03', 'yiachi2221@gmail.com', 'F', '1996-10-10', '會員管理、員工管理', '3.jpg'),
(4, '周珈妃', 'p_04', 'imlucky8652@gmail.com', 'F', '1997-07-31', '影片管理，追蹤使用者觀看紀錄，訂閱資訊管理', '4.jpg'),
(5, '沈彤', 'p_05', 'bwya000@gmail.com', 'F', '2000-01-05', '商品管理，收藏管理', '');

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

-- --------------------------------------------------------

--
-- 資料表結構 `fitvideos`
--

CREATE TABLE `fitvideos` (
  `VideoID` int(20) NOT NULL,
  `Title` varchar(20) DEFAULT NULL,
  `ReleaseDate` date DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `URL` varchar(1000) DEFAULT NULL,
  `vidthumbnail` varchar(50) DEFAULT NULL,
  `musclegroupID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `fitvideos`
--

INSERT INTO `fitvideos` (`VideoID`, `Title`, `ReleaseDate`, `Description`, `URL`, `vidthumbnail`, `musclegroupID`) VALUES
(1, '10分鐘腿部訓練【初級版】', '2023-06-08', '訓練的内容一共包含6個訓練動作x2組+30秒組間休息時間', 'https://youtu.be/QflKoDHgVqY', '10分鐘腿部訓練【初級版】.jpeg', 4),
(2, '8分鐘背肌訓練【初級-中級版】', '2023-06-08', '只需 11 個訓練动作，中途給大家留了30秒的喘息時間', 'https://youtu.be/ltDf3HVO6vA', '8分鐘背肌訓練【初級-中級版】.jpeg', 2),
(3, '每日５分鐘 新手在家練胸肌【初級版】', '2023-06-09', '這個影片是居家練胸肌 伏地挺身初階訓練影片\n非常適合剛接觸運動的新手，或是體重比較重的人。 ', 'https://youtu.be/zlkc8fAAijU', '每日５分鐘新手在家練胸肌【初級版】.jpeg', 1),
(4, '10 分鐘居家腹肌訓練【中級版】', '2023-06-10', '有效加强核心的訓練，訓練的内容一共包含14個動作，無重複動作，動作都非常簡單', 'https://youtu.be/uY5tzTGOV9s', '10 分鐘居家腹肌訓練【中級版】.jpeg', 3),
(5, '10分鐘居家手臂啞鈴訓練【中級版】', '2023-06-10', '有效訓練二頭肌和三頭肌，讓你快速增肌減脂', 'https://youtu.be/HsNobB5IZCc', '10分鐘居家手臂啞鈴訓練【中級版】.jpeg', 6),
(6, '10分鐘居家肩部啞鈴訓練【中級版】', '2023-06-10', '有效訓練肩膀，讓你快速增肌減脂', 'https://youtu.be/-4sCm3UswDo', '10分鐘居家肩部啞鈴訓練【中級版】.jpeg', 5),
(7, '15分鐘居家啞鈴胸肌訓練【高級版】', '2023-06-10', '這一集的15分鐘啞鈴訓練的中級版，總共會有8個訓練動作\n每一個動作將會改爲40秒，休息15秒，組間有1次60秒的休息時間。\n完成了一組15分鐘訓練后，也可以再做重複做一組！', 'https://youtu.be/VCWx4eX2QJs', '15分鐘居家啞鈴胸肌訓練【高級版】.jpeg', 1),
(8, '15分鐘居家腿部徒手訓練【中級版】', '2023-06-10', '内容共12個動作（重複兩輪訓練）\n兩輪之間會有60秒的調息時間！大家一起動起來吧~', 'https://youtu.be/gluKcFG6Mnw', '15分鐘居家腿部徒手訓練【中級版】.jpeg', 4),
(9, '10分鐘居家腹肌訓練【高級版】', '2023-06-10', '有效加强核心的訓練，男生和女生都適合的健身訓練', 'https://youtu.be/bvGCgdQ2JHg', '10分鐘居家腹肌訓練【高級版】.jpeg', 3),
(10, '20分鐘居家腿部徒手訓練【高級版】', '2023-06-10', '内容一共 11 個動作（重複兩輪訓練）\n兩輪之間一樣會有 60 秒的調息時間！', 'https://youtu.be/FzWtjpjVpyY', '20分鐘居家腿部徒手訓練【高級版】.jpeg', 4),
(11, '10分鐘背部訓練【高級版】', '2023-06-11', '共有 13個訓練动作，之間也給大家留了60秒的調息時間。一起把背肌力量煉起來～', 'https://youtu.be/Hk24aqjEJgs', '10分鐘背部訓練【高級版】.jpeg', 2),
(12, '15 分鐘居家啞鈴腿部訓練【中-高級版】', '2023-06-11', '\r\n這是一集 15 分鐘的 - 腿部啞鈴訓練，内容會有三組 / 總共 8 個動作，每一組之間都會有 30 秒的調息時間！', 'https://youtu.be/aa8Lv_H2cO0', '15 分鐘居家啞鈴腿部訓練【中-高級版】.jpeg', 4),
(13, '10分鐘居家上半身啞鈴訓練【中級版】', '2023-06-11', '這次分享了 20 分鐘的上半身啞鈴訓練，同樣分成兩組進行（組間有60秒休息時間）整個訓練一共只有 11 個訓練動作。', 'https://youtu.be/ogv9jlzai-g', '10分鐘居家上半身啞鈴訓練【中級版】.jpeg', 6),
(14, '12分鐘居家臀腿訓練【初級版】', '2023-06-11', '訓練的内容一共包含1個熱身動作 +17個訓練動作 ,希望大家一起加油！', 'https://youtu.be/qDCyk7viJ6Q', '12分鐘居家臀腿訓練【初級版】.jpeg', 7),
(15, '5 分鐘居家腹肌訓練【初級版】', '2023-06-11', '共 8 個動作，每一組有 10 秒間隔休息時間，在家依然可以實現 擁有腹肌的心！', 'https://youtu.be/4unok_CQMFU', '5分鐘居家腹肌訓練【初級版】.jpeg', 3),
(16, '4招教你如何有效的趕走拜拜肉【初級版】', '2023-06-11', '讓你的手臂更結實好看！只需要用到彈力帶就可開始訓練了', 'https://youtu.be/4_6Ln7CqBhk', '4招教你如何有效的趕走拜拜肉【初級版】.jpeg', 6),
(17, '10分鐘背部訓練【初級版】', '2023-06-13', '這次訓練只需要一個乾净的地面，一張瑜伽墊就能完成！共有 兩組 / 7 個訓練动作，之間也給大家留了60秒的調息時間', 'https://youtu.be/03Yr_xbXUew', '10分鐘背部訓練【初級版】.jpeg', 2),
(18, '15 分鐘居家腹肌訓練【初級版】', '2023-06-13', '這次的訓練會有11 個動作 x 2組，中間有60秒休息', 'https://youtu.be/hoFhvmJgfYM', '15分鐘居家腹肌訓練【初級版】.jpeg', 3),
(19, '10分鐘居家胸肌徒手訓練【中級版】', '2023-06-13', '這次的訓練會分成兩組，共有7個動作，簡單的跟著做系列。建議想嘗試的新手可以先選擇跪姿的方式開始訓練。', 'https://youtu.be/iTdv74o6GOY', '10分鐘居家胸肌徒手訓練【中級版】.jpeg', 1),
(20, '12分鐘居家啞鈴肩部訓練【中級版】', '2023-06-13', '這次的啞鈴訓練，會分成兩組進行（組間有60秒休息時間）整個訓練共包含了一個熱身和 8 個訓練動作。', 'https://youtu.be/t8qTOd3WfpE', '12分鐘居家啞鈴肩部訓練【中級版】.jpeg', 5),
(21, '5分鐘居家腹肌訓練2【初級版】', '2023-06-14', '【5分鐘的核心訓練】連續 8 個訓練動作，組間60秒休息時間，連續兩組訓練。', 'https://youtu.be/JF0uEQnyseE', '5分鐘居家腹肌訓練2【初級版】.jpeg', 3),
(22, '12分鐘居家徒手腹肌訓練【初級版】無裝備', '2023-06-14', '第二天的訓練，在啓動了全身肌肉之後，我們就先來到大家最感興趣的核心訓練！畢竟，想完成所有的標準訓練動作，都是需要利用/依靠核心力量來支撐和平衡的。', 'https://youtu.be/w0DZRE6NZws', '12分鐘居家徒手腹肌訓練【初級版】無裝備.jpeg', 3),
(23, '12分鐘居家上半身訓練【中級版】', '2023-06-14', '訓練主要訓練 胸，肩膀，二頭肌和三頭肌 這次的訓練會有7個動作，之間有30秒休息，做完一組會有60秒休息', 'https://youtu.be/ERKbepvwO3k', '12分鐘居家上半身訓練【中級版】.jpeg', 1),
(24, '20分鐘腿和腹肌訓練【中級版】', '2023-06-14', '訓練的内容一共包含3個熱身動作 +17個訓練動作', 'https://youtu.be/HILBG-LQ0vU', '20分鐘腿和腹肌訓練【中級版】.jpeg', 3),
(25, '10分鐘上半身徒手訓練 【中級版】', '2023-06-14', '這次的訓練會有15個動作，簡單的跟著做系列\r\n建議大家可以做一到兩組，達到更好效果。', 'https://youtu.be/YvoR6n7XvwQ', '10分鐘上半身徒手訓練 【中級版】.jpeg', 5),
(26, '10分鐘腹肌訓練【中級版】', '2023-06-14', '隨時隨地都能在家做的運動｜有效加强核心的訓練', 'https://youtu.be/BDduWYFejtw', '10分鐘腹肌訓練【中級版】.jpeg', 3),
(27, '15分鐘居家手臂啞鈴訓練【中級版】', '2023-06-14', '這次分享了15分鐘的上半身啞鈴訓練，會分成兩組進行（組間有60秒休息時間）\r\n整個訓練共包含了兩組的 9 個訓練動作。', 'https://youtu.be/FRdwUyS9TFI', '15分鐘居家手臂啞鈴訓練【中級版】.jpeg', 6),
(28, '8 分鐘居家腹肌訓練(襪子版本)', '2023-06-15', '【8分鐘的核心訓練】共10個動作，每一組有10秒間隔休息時間', 'https://youtu.be/XM5ZuUjrCso', '8分鐘居家腹肌訓練(襪子版本).jpeg', 3),
(29, '5分鐘腹肌訓練(續之前腹肌訓練的加强版)', '2023-06-15', '5分鐘帶你一起感受腹肌的燃燒 ！', 'https://youtu.be/dQ_3J0Fgldg', '5分鐘腹肌訓練(續之前腹肌訓練的加强版).jpeg', 3),
(30, '7 分鐘居家徒手腹肌訓練【初級版】無裝備', '2023-06-15', '【7分鐘的站立式核心訓練】分別有：第一組的 5 秒間隔休息時間，和第二組的不間斷無休息。', 'https://youtu.be/83DpxHnRGuA', '7分鐘居家徒手腹肌訓練【初級版】.jpeg', 3);

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

-- --------------------------------------------------------

--
-- 資料表結構 `food_category`
--

CREATE TABLE `food_category` (
  `Food_categoryID` int(11) NOT NULL,
  `Name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- 傾印資料表的資料 `food_category`
--

INSERT INTO `food_category` (`Food_categoryID`, `Name`) VALUES
(1, '飯'),
(2, '麵'),
(3, '早餐'),
(4, '湯'),
(5, '飲料'),
(6, '其他');

-- --------------------------------------------------------

--
-- 資料表結構 `food_record`
--

CREATE TABLE `food_record` (
  `RecordID` int(10) NOT NULL,
  `FoodID` int(10) NOT NULL,
  `MemberID` int(10) NOT NULL,
  `Date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

CREATE TABLE `member` (
  `MemberID` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `avatarname` varchar(255) NOT NULL COMMENT '個人頭像',
  `gender` char(1) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `birthday` date DEFAULT NULL,
  `phone_number` varchar(20) NOT NULL,
  `address` varchar(50) DEFAULT NULL,
  `subscribe` tinyint(1) NOT NULL COMMENT '0=false;1=true',
  `帳號是否啟動` tinyint(1) NOT NULL COMMENT '0=false;1=true	'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `member`
--

INSERT INTO `member` (`MemberID`, `name`, `avatarname`, `gender`, `email`, `password`, `birthday`, `phone_number`, `address`, `subscribe`, `帳號是否啟動`) VALUES
(1, 'Ada', '1.jpg', 'F', 'Ada@test.com', '1231', '1995-10-04', '0991-778-964', '台北市萬華區萬大路531號', 1, 1),
(2, 'Afra', '2.jpg', 'F', 'Afra@test.com', '1232', '1996-07-17', '0991-778-965', '新竹市東區食品路66號', 0, 1),
(3, 'Matty', '3.jpg', 'M', 'Matty@test.com', '1233', '1995-12-31', '0991-778-966', '桃園市大園區航站南路9號', 1, 1),
(4, 'Harry', '4.jpg', 'F', 'Harry@test.com', '1234', '1995-08-08', '0991-778-967', '台南市安平區永華路二段6號', 0, 1),
(5, 'Josh', '2.jpg', 'M', 'Josh@test.com', '1235', '1996-06-10', '0991-778-968', '台北市中正區承德路一段2號', 1, 1),
(6, 'Beverly', '1.jpg', 'F', 'Beverly@test.com', '1236', '1994-02-08', '0991-778-969', '花蓮縣花蓮市府前路17號', 1, 1),
(7, 'Troy', '1.jpg', 'M', 'Troy@test.com', '1237', '1992-04-16', '0991-778-970', '苗栗縣苗栗市縣府路100號', 1, 1),
(8, 'Hugo', '3.jpg', 'M', 'Hugo@test.com', '1238', '1998-01-26', '0991-778-971', '桃園市蘆竹區中正北路117-1號', 0, 0),
(9, 'Caroline', '2.jpg', 'F', 'Caroline@test.com', '1239', '1997-04-06', '0991-778-972', '台中市潭子區中山路二段343號', 0, 0),
(10, 'Denise', '1.jpg', 'F', 'Denise@test.com', '1240', '1998-09-25', '0991-778-973', '彰化縣鹿港鎮埔頭街3號', 0, 1),
(11, 'Kenny', '3.jpg', 'M', 'Kenny@test.com', '1241', '1990-03-05', '0991-778-974', '台中市西屯區台灣大道三段99號', 1, 1),
(12, 'Elva', '3.jpg', 'F', 'Elva@test.com', '1242', '1997-12-18', '0991-778-975', '屏東縣長治鄉園西一路2號', 0, 1),
(13, 'Maggie', '1.jpg', 'F', 'Maggie@test.com', '1243', '1987-05-14', '0991-778-976', '新竹縣竹北市光明六路10號', 1, 1),
(14, 'Nick', '7.jpg', 'M', 'Nick@test.com', '1244', '1985-03-21', '0991-778-977', '苗栗縣三灣鄉中山路43號', 0, 1),
(15, 'Simon', '8.jpg', 'M', 'Simon@test.com', '1245', '1999-01-06', '0991-778-978', '高雄市鹽埕區真愛路1號', 0, 1),
(16, 'Vanessa', '3.jpg', 'F', 'Vanessa@test.com', '1246', '2001-09-18', '0991-778-979', '高雄市三民區綏遠一街167巷34號', 0, 1),
(17, 'Alice', '7.jpg', 'F', 'Alice@test.com', '1247', '2002-08-31', '0991-778-980', '台南市東區前鋒路210號', 0, 1),
(18, 'Huntley', '10.jpg', 'M', 'Huntley@test.com', '1248', '2000-02-26', '0991-778-981', '苗栗縣苗栗市國華路1121號', 1, 1),
(19, 'Charlie', '1.jpg', 'M', 'Charlie@test.com', '1249', '1992-10-28', '0991-778-982', '台東縣台東市文化公園路200號', 1, 1),
(20, 'Sara', '5.jpg', 'F', 'Sara@test.com', '1250', '2003-07-15', '0991-778-983', '新北市鶯歌區館前路300號', 1, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `muscle_group`
--

CREATE TABLE `muscle_group` (
  `musclegroupID` int(10) NOT NULL,
  `muscleName` varchar(20) NOT NULL,
  `muscleDesc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `muscle_group`
--

INSERT INTO `muscle_group` (`musclegroupID`, `muscleName`, `muscleDesc`) VALUES
(1, '胸肌', '胸肌大致分為上胸肌，中胸肌，胸肌,胸肌內側和胸肌外側。不同位置的胸肌需要不同訓練角度去刺激，我們都可以透過調教關節的角度和握法，集中鍛練不同位置的胸肌。'),
(2, '背肌', '背部肌肉有支撐脊椎、維持軀幹穩定的功能，主要分為：背闊肌、菱形肌、斜方肌、豎脊肌和一些深層的小肌群(e.g.大圓肌，小圓肌、網下肌)。'),
(3, '腹肌', '腹肌包括腹直肌、腹外斜肌，腹內斜肌和腹橫肌。當它們收縮時，可以使軀幹彎曲及旋轉，並可以防止骨盆前傾。'),
(4, '腿部肌群', '腿部肌群包括大腿肌群、小腿肌群'),
(5, '肩部肌群', '三角肌分為前中後，位於手臂和軀幹的肩膀連結處'),
(6, '手臂肌群', '手臂肌群粗略可分為4大部分：肱二頭肌、肱三頭肌（上臂肌肉）、前臂肌肉和三角肌'),
(7, '臀肌', '臀肌主要由「臀大肌、臀中肌、臀小肌」組成');

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

-- --------------------------------------------------------

--
-- 資料表結構 `productall`
--

CREATE TABLE `productall` (
  `p_id` int(11) NOT NULL COMMENT '產品流水號',
  `p_name` varchar(50) NOT NULL COMMENT '產品名稱',
  `p_description` text NOT NULL COMMENT '產品描述',
  `p_specification` varchar(511) DEFAULT NULL COMMENT '產品規格',
  `p_size` varchar(511) DEFAULT NULL COMMENT '產品尺寸',
  `p_category` varchar(50) NOT NULL COMMENT '產品類別',
  `p_price` decimal(10,0) NOT NULL COMMENT '產品價格',
  `p_quantity` int(4) NOT NULL COMMENT '產品數量',
  `p_image` varchar(50) NOT NULL COMMENT '產品圖片'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `productall`
--

INSERT INTO `productall` (`p_id`, `p_name`, `p_description`, `p_specification`, `p_size`, `p_category`, `p_price`, `p_quantity`, `p_image`) VALUES
(1, '瑜伽墊', '防滑、環保的瑜伽墊，舒適運動', '粉色', '', '健身器材', 599, 10, 'yoga_mat_pink.jpg'),
(2, '瑜伽墊', '防滑、環保的瑜伽墊，舒適運動', '藍色', '', '健身器材', 599, 5, 'yoga_mat_blue.jpg'),
(3, '瑜伽墊', '防滑、環保的瑜伽墊，舒適運動', '紫色', '', '健身器材', 599, 8, 'yoga_mat_purple.jpg'),
(4, '4kg 壺鈴', '通過健身訓練有效加強全身肌肉的力量', '', '', '健身器材', 699, 4, '4kg_kettlebell.jpg'),
(5, '8kg 壺鈴', '通過健身訓練有效加強全身肌肉的力量', '', '', '健身器材', 1299, 10, '8kg_kettlebell.jpg'),
(6, '1kg PVC啞鈴組', '多種用途，提高你的深蹲、弓步以及二頭肌彎舉強度', '', '', '健身器材', 349, 8, '1kg_dumbbell.jpg'),
(7, '2kgPVC啞鈴組', '多種用途，提高你的深蹲、弓步以及二頭肌彎舉強度', '', '', '健身器材', 449, 15, '2kg_dumbbell.jpg'),
(8, '3kg PVC啞鈴組', '多種用途，提高你的深蹲、弓步以及二頭肌彎舉強度', '', '', '健身器材', 499, 12, '3kg_dumbbell.jpg'),
(9, '5kg PVC啞鈴組', '多種用途，提高你的深蹲、弓步以及二頭肌彎舉強度', '', '', '健身器材', 849, 11, '5kg_dumbbell.jpg'),
(10, '50kg 重訓啞鈴組', '肌肉塑型訓練 槓鈴、啞鈴訓練包括3支槓，16個槓片（4 x 0.5 kg，8 x 2 kg和4 x 5 kg）和6個安全卡扣，你可自行調整啞鈴重量，鍛鍊二頭肌、三頭肌、三角肌和胸肌', '', '', '健身器材', 3999, 20, '50kg_dumbbell_set.jpg'),
(11, '15kg 訓練彈力帶\n', '適合在重訓、交叉訓練及體適能課程使用的彈力帶', '', '', '健身器材', 199, 3, '15kg_resistance_bands.jpg'),
(12, '25kg 訓練彈力帶', '適合在重訓、交叉訓練及體適能課程使用的彈力帶', '', '', '健身器材', 249, 10, '25kg_resistance_bands.jpg'),
(13, '35kg 訓練彈力帶', '適合在重訓、交叉訓練及體適能課程使用的彈力帶', '', '', '健身器材', 299, 8, '35kg_resistance_bands.jpg'),
(14, '4合1伏地挺身握把\n', '4 合 1 伏地挺身及滑行握把可為你的肌力訓練提供各式各樣的鍛鍊方式', '', '', '健身器材', 499, 6, 'push_up_wheel_4in1.jpg'),
(15, '健身背心', '後背寬領剪裁的背心，讓你不管做什麼健身動作都輕鬆自在', '紅色', 'S', '運動服飾', 399, 2, 'vest_red.jpg'),
(16, '健身背心', '後背寬領剪裁的背心，讓你不管做什麼健身動作都輕鬆自在', '紅色', 'M', '運動服飾', 399, 4, 'vest_red.jpg'),
(17, '健身背心', '後背寬領剪裁的背心，讓你不管做什麼健身動作都輕鬆自在', '紅色', 'L', '運動服飾', 399, 5, 'vest_red.jpg'),
(18, '健身背心', '後背寬領剪裁的背心，讓你不管做什麼健身動作都輕鬆自在', '綠色', 'S', '運動服飾', 399, 5, 'vest_green.jpg'),
(19, '健身背心', '後背寬領剪裁的背心，讓你不管做什麼健身動作都輕鬆自在', '綠色', 'M', '運動服飾', 399, 2, 'vest_green.jpg'),
(20, '健身背心', '後背寬領剪裁的背心，讓你不管做什麼健身動作都輕鬆自在', '綠色', 'L', '運動服飾', 399, 0, 'vest_green.jpg'),
(21, '中強度健身運動內衣', '時尚的外型可在你進行中強度運動時提供舒適感和支撐性', '藍色', 'S', '運動服飾', 749, 5, 'sports_bra_blue.jpg'),
(22, '中強度健身運動內衣', '時尚的外型可在你進行中強度運動時提供舒適感和支撐性', '藍色', 'M', '運動服飾', 749, 2, 'sports_bra_blue.jpg'),
(23, '中強度健身運動內衣', '時尚的外型可在你進行中強度運動時提供舒適感和支撐性', '藍色', 'L', '運動服飾', 749, 7, 'sports_bra_blue.jpg'),
(24, '中強度健身運動內衣', '時尚的外型可在你進行中強度運動時提供舒適感和支撐性', '黑色', 'S', '運動服飾', 749, 0, 'sports_bra_black.jpg'),
(25, '中強度健身運動內衣', '時尚的外型可在你進行中強度運動時提供舒適感和支撐性', '黑色', 'M', '運動服飾', 749, 0, 'sports_bra_black.jpg'),
(26, '中強度健身運動內衣', '時尚的外型可在你進行中強度運動時提供舒適感和支撐性', '黑色', 'L', '運動服飾', 749, 2, 'sports_bra_black.jpg'),
(27, '男款運動短褲', '透氣排汗的跑步褲，適合長跑', '灰色', 'S', '運動服飾', 349, 8, 'shorts_grey.jpg'),
(28, '男款運動短褲', '透氣排汗的跑步褲，適合長跑', '灰色', 'M', '運動服飾', 349, 5, 'shorts_grey.jpg'),
(29, '男款運動短褲', '透氣排汗的跑步褲，適合長跑', '灰色', 'L', '運動服飾', 349, 3, 'shorts_grey.jpg'),
(30, '男款運動短褲', '透氣排汗的跑步褲，適合長跑', '黑色', 'S', '運動服飾', 349, 4, 'shorts_black.jpg'),
(31, '男款運動短褲', '透氣排汗的跑步褲，適合長跑', '黑色', 'M', '運動服飾', 349, 3, 'shorts_black.jpg'),
(32, '男款運動短褲', '透氣排汗的跑步褲，適合長跑', '黑色', 'L', '運動服飾', 349, 0, 'shorts_black.jpg'),
(33, '初階健身緊身褲', '為健身運動打造的緊身褲。適合低強度訓練時', '黑色', 'S', '運動服飾', 499, 6, 'leggings.jpg'),
(34, '初階健身緊身褲', '為健身運動打造的緊身褲。適合低強度訓練時', '黑色', 'M', '運動服飾', 499, 1, 'leggings.jpg'),
(35, '初階健身緊身褲', '為健身運動打造的緊身褲。適合低強度訓練時', '黑色', 'L', '運動服飾', 499, 1, 'leggings.jpg'),
(36, '女款運動短褲', '無論是運動、逛街、在海灘或在家放鬆都能穿著', '棕色', 'S', '運動服飾', 399, 0, 'short_brown.jpg'),
(37, '女款運動短褲', '無論是運動、逛街、在海灘或在家放鬆都能穿著', '棕色', 'M', '運動服飾', 399, 0, 'short_brown.jpg'),
(38, '女款運動短褲', '無論是運動、逛街、在海灘或在家放鬆都能穿著', '棕色', 'L', '運動服飾', 399, 0, 'short_brown.jpg'),
(39, '女款運動短褲', '無論是運動、逛街、在海灘或在家放鬆都能穿著', '紫色', 'S', '運動服飾', 399, 1, 'short_purple.jpg'),
(40, '女款運動短褲', '無論是運動、逛街、在海灘或在家放鬆都能穿著', '紫色', 'M', '運動服飾', 399, 1, 'short_purple.jpg'),
(41, '女款運動短褲', '無論是運動、逛街、在海灘或在家放鬆都能穿著', '紫色', 'L', '運動服飾', 399, 2, 'short_purple.jpg'),
(42, '運動壓力襪', '在訓練或比賽後，如果想要讓腳更輕盈，壓力襪是個輕鬆又有效的方式', '', 'S', '運動配件', 399, 4, 'compression_stockings.jpg'),
(43, '運動壓力襪', '在訓練或比賽後，如果想要讓腳更輕盈，壓力襪是個輕鬆又有效的方式', '', 'M', '運動配件', 399, 7, 'compression_stockings.jpg'),
(44, '運動壓力襪', '在訓練或比賽後，如果想要讓腳更輕盈，壓力襪是個輕鬆又有效的方式', '', 'L', '運動配件', 399, 12, 'compression_stockings.jpg'),
(45, '初階重訓手套', '輕量耐用且能有效排汗的手套', '', 'S', '健身配件', 299, 12, 'beginner_training_gloves.jpg'),
(46, '初階重訓手套', '輕量耐用且能有效排汗的手套', '', 'M', '健身配件', 299, 15, 'beginner_training_gloves.jpg'),
(47, '初階重訓手套', '輕量耐用且能有效排汗的手套', '', 'L', '健身配件', 299, 19, 'beginner_training_gloves.jpg'),
(48, '中階重訓手套', '兼具絕佳防滑性和舒適度的手套', '', 'S', '健身配件', 399, 23, 'intermediate_training_gloves.jpg'),
(49, '中階重訓手套', '兼具絕佳防滑性和舒適度的手套', '', 'M', '健身配件', 399, 14, 'intermediate_training_gloves.jpg'),
(50, '中階重訓手套', '兼具絕佳防滑性和舒適度的手套', '', 'L', '健身配件', 399, 17, 'intermediate_training_gloves.jpg');

-- --------------------------------------------------------

--
-- 資料表結構 `productfeedback`
--

CREATE TABLE `productfeedback` (
  `feedback_id` int(11) NOT NULL COMMENT '商品回饋ID',
  `p_id` int(11) NOT NULL COMMENT '商品ID',
  `score` int(2) NOT NULL COMMENT '評分\r\n',
  `feedback_text` text NOT NULL COMMENT '商品回饋內文',
  `user_id` int(11) NOT NULL COMMENT '會員ID',
  `date` date NOT NULL COMMENT '時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- 資料表結構 `sport_categoryid`
--

CREATE TABLE `sport_categoryid` (
  `Sport_categoryID` int(10) NOT NULL,
  `Name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- 傾印資料表的資料 `sport_categoryid`
--

INSERT INTO `sport_categoryid` (`Sport_categoryID`, `Name`) VALUES
(1, '走路'),
(2, '爬樓梯'),
(3, '跑步'),
(4, '騎腳踏車'),
(5, '家事'),
(6, '工作'),
(7, '其他運動');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `body_record`
--
ALTER TABLE `body_record`
  ADD PRIMARY KEY (`RecordID`),
  ADD KEY `RecordID` (`RecordID`),
  ADD KEY `MemberID` (`MemberID`);

--
-- 資料表索引 `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`e_id`),
  ADD KEY `e_id` (`e_id`),
  ADD KEY `e_id_2` (`e_id`);

--
-- 資料表索引 `favoriteslist`
--
ALTER TABLE `favoriteslist`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `video_id` (`video_id`);

--
-- 資料表索引 `fitvideos`
--
ALTER TABLE `fitvideos`
  ADD PRIMARY KEY (`VideoID`),
  ADD KEY `VideoID` (`VideoID`),
  ADD KEY `musclegroupID` (`musclegroupID`);

--
-- 資料表索引 `fooddata`
--
ALTER TABLE `fooddata`
  ADD PRIMARY KEY (`FoodID`),
  ADD KEY `FoodID` (`FoodID`),
  ADD KEY `Food_categoryID` (`Food_categoryID`);

--
-- 資料表索引 `food_category`
--
ALTER TABLE `food_category`
  ADD PRIMARY KEY (`Food_categoryID`),
  ADD KEY `Food_categoryID` (`Food_categoryID`);

--
-- 資料表索引 `food_record`
--
ALTER TABLE `food_record`
  ADD PRIMARY KEY (`RecordID`),
  ADD KEY `RecordID` (`RecordID`),
  ADD KEY `MemberID` (`MemberID`),
  ADD KEY `FoodID` (`FoodID`);

--
-- 資料表索引 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`MemberID`),
  ADD KEY `member_id` (`MemberID`),
  ADD KEY `MemberID` (`MemberID`);

--
-- 資料表索引 `muscle_group`
--
ALTER TABLE `muscle_group`
  ADD PRIMARY KEY (`musclegroupID`),
  ADD KEY `musclegroupID` (`musclegroupID`);

--
-- 資料表索引 `orderreal_detail`
--
ALTER TABLE `orderreal_detail`
  ADD PRIMARY KEY (`orderrealdetailID`),
  ADD KEY `orderrealdetailID` (`orderrealdetailID`),
  ADD KEY `orderrealdetail_orderrealID` (`orderrealdetail_orderrealID`),
  ADD KEY `orderrealdetail_PID` (`orderrealdetail_PID`);

--
-- 資料表索引 `orderreal_main`
--
ALTER TABLE `orderreal_main`
  ADD PRIMARY KEY (`orderrealID`),
  ADD KEY `orderrealID` (`orderrealID`),
  ADD KEY `orderrealmemberID` (`orderrealmemberID`);

--
-- 資料表索引 `ordervideo_detail`
--
ALTER TABLE `ordervideo_detail`
  ADD PRIMARY KEY (`ordervideoDetail_ID`),
  ADD KEY `ordervideoDetail_ID` (`ordervideoDetail_ID`),
  ADD KEY `ordervideoDetail_ordervideoID` (`ordervideoDetail_ordervideoID`),
  ADD KEY `ordervideoDetail_VideoID` (`ordervideoDetail_VideoID`);

--
-- 資料表索引 `ordervideo_main`
--
ALTER TABLE `ordervideo_main`
  ADD PRIMARY KEY (`ordervideoID`),
  ADD KEY `ordervideoID` (`ordervideoID`),
  ADD KEY `ordervideomemberID` (`ordervideomemberID`);

--
-- 資料表索引 `productall`
--
ALTER TABLE `productall`
  ADD PRIMARY KEY (`p_id`);

--
-- 資料表索引 `productfeedback`
--
ALTER TABLE `productfeedback`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `p_id` (`p_id`);

--
-- 資料表索引 `sportdata`
--
ALTER TABLE `sportdata`
  ADD PRIMARY KEY (`SportID`),
  ADD KEY `Sport_categoryID` (`Sport_categoryID`);

--
-- 資料表索引 `sport_categoryid`
--
ALTER TABLE `sport_categoryid`
  ADD PRIMARY KEY (`Sport_categoryID`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `body_record`
--
ALTER TABLE `body_record`
  MODIFY `RecordID` int(10) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `employee`
--
ALTER TABLE `employee`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `fitvideos`
--
ALTER TABLE `fitvideos`
  MODIFY `VideoID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `fooddata`
--
ALTER TABLE `fooddata`
  MODIFY `FoodID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `food_category`
--
ALTER TABLE `food_category`
  MODIFY `Food_categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `food_record`
--
ALTER TABLE `food_record`
  MODIFY `RecordID` int(10) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member`
--
ALTER TABLE `member`
  MODIFY `MemberID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `orderreal_detail`
--
ALTER TABLE `orderreal_detail`
  MODIFY `orderrealdetailID` int(11) NOT NULL AUTO_INCREMENT COMMENT '實體訂單詳情的流水號', AUTO_INCREMENT=39;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `orderreal_main`
--
ALTER TABLE `orderreal_main`
  MODIFY `orderrealID` int(11) NOT NULL AUTO_INCREMENT COMMENT '關於實體的訂單編號', AUTO_INCREMENT=16;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `ordervideo_detail`
--
ALTER TABLE `ordervideo_detail`
  MODIFY `ordervideoDetail_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '影片訂單詳情流水號', AUTO_INCREMENT=34;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `ordervideo_main`
--
ALTER TABLE `ordervideo_main`
  MODIFY `ordervideoID` int(11) NOT NULL AUTO_INCREMENT COMMENT '關於影片的訂單編號', AUTO_INCREMENT=21;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `productall`
--
ALTER TABLE `productall`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '產品流水號', AUTO_INCREMENT=51;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `sportdata`
--
ALTER TABLE `sportdata`
  MODIFY `SportID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `sport_categoryid`
--
ALTER TABLE `sport_categoryid`
  MODIFY `Sport_categoryID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `body_record`
--
ALTER TABLE `body_record`
  ADD CONSTRAINT `body_record_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `favoriteslist`
--
ALTER TABLE `favoriteslist`
  ADD CONSTRAINT `favoriteslist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `member` (`MemberID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favoriteslist_ibfk_3` FOREIGN KEY (`video_id`) REFERENCES `fitvideos` (`VideoID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favoriteslist_ibfk_4` FOREIGN KEY (`p_id`) REFERENCES `productall` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `fitvideos`
--
ALTER TABLE `fitvideos`
  ADD CONSTRAINT `fitvideos_ibfk_1` FOREIGN KEY (`musclegroupID`) REFERENCES `muscle_group` (`musclegroupID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `fooddata`
--
ALTER TABLE `fooddata`
  ADD CONSTRAINT `fooddata_ibfk_1` FOREIGN KEY (`Food_categoryID`) REFERENCES `food_category` (`Food_categoryID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `food_record`
--
ALTER TABLE `food_record`
  ADD CONSTRAINT `food_record_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `food_record_ibfk_2` FOREIGN KEY (`FoodID`) REFERENCES `fooddata` (`FoodID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `orderreal_detail`
--
ALTER TABLE `orderreal_detail`
  ADD CONSTRAINT `orderreal_detail_ibfk_1` FOREIGN KEY (`orderrealdetail_orderrealID`) REFERENCES `orderreal_main` (`orderrealID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderreal_detail_ibfk_2` FOREIGN KEY (`orderrealdetail_PID`) REFERENCES `productall` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `orderreal_main`
--
ALTER TABLE `orderreal_main`
  ADD CONSTRAINT `orderreal_main_ibfk_1` FOREIGN KEY (`orderrealmemberID`) REFERENCES `member` (`MemberID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `ordervideo_detail`
--
ALTER TABLE `ordervideo_detail`
  ADD CONSTRAINT `ordervideo_detail_ibfk_1` FOREIGN KEY (`ordervideoDetail_ordervideoID`) REFERENCES `ordervideo_main` (`ordervideoID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ordervideo_detail_ibfk_2` FOREIGN KEY (`ordervideoDetail_VideoID`) REFERENCES `fitvideos` (`VideoID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `ordervideo_main`
--
ALTER TABLE `ordervideo_main`
  ADD CONSTRAINT `ordervideo_main_ibfk_1` FOREIGN KEY (`ordervideomemberID`) REFERENCES `member` (`MemberID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `productfeedback`
--
ALTER TABLE `productfeedback`
  ADD CONSTRAINT `productfeedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `member` (`MemberID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productfeedback_ibfk_2` FOREIGN KEY (`p_id`) REFERENCES `productall` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `sportdata`
--
ALTER TABLE `sportdata`
  ADD CONSTRAINT `sportdata_ibfk_1` FOREIGN KEY (`Sport_categoryID`) REFERENCES `sport_categoryid` (`Sport_categoryID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

/* 記住我功能的資料表 */
CREATE TABLE remember_tokens (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    user_email VARCHAR(255) NOT NULL,
    token_hash CHAR(64) NOT NULL,
    expires_at DATETIME NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    INDEX (token_hash),
    INDEX (user_email)
);

/-- 在 employee 資料表新增 is_active 欄位
ALTER TABLE employee
ADD COLUMN is_active TINYINT(1) NOT NULL DEFAULT 1
COMMENT '是否啟用：1=啟用，0=停用';