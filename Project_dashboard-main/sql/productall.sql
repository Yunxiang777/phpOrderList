-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-06-20 10:30:18
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

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `productall`
--
ALTER TABLE `productall`
  ADD PRIMARY KEY (`p_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `productall`
--
ALTER TABLE `productall`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '產品流水號', AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
