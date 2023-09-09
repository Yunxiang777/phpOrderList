-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-06-20 10:29:14
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

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `muscle_group`
--
ALTER TABLE `muscle_group`
  ADD PRIMARY KEY (`musclegroupID`),
  ADD KEY `musclegroupID` (`musclegroupID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
