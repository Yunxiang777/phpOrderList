-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-06-20 10:28:48
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

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `fitvideos`
--
ALTER TABLE `fitvideos`
  ADD PRIMARY KEY (`VideoID`),
  ADD KEY `VideoID` (`VideoID`),
  ADD KEY `musclegroupID` (`musclegroupID`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `fitvideos`
--
ALTER TABLE `fitvideos`
  MODIFY `VideoID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `fitvideos`
--
ALTER TABLE `fitvideos`
  ADD CONSTRAINT `fitvideos_ibfk_1` FOREIGN KEY (`musclegroupID`) REFERENCES `muscle_group` (`musclegroupID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
