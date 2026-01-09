<?php
declare(strict_types=1);

require_once __DIR__ . '/../api_guard.php';

use App\Core\Database;

header('Content-Type: application/json; charset=utf-8');

$pdo = Database::getInstance();

$output = [
    'success' => false,
    'errorMessage' => '',
    'data' => null,
];

/* |-------------------------------------------------
   | 輸入驗證（POST）
   |------------------------------------------------- */
$foodId = $_POST['id'] ?? null;

if ($foodId === null || !ctype_digit((string)$foodId)) {
    $output['errorMessage'] = '食物 ID 不正確';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

/* |-------------------------------------------------
   | 查詢食物
   |------------------------------------------------- */
$sql = "
    SELECT
        FoodID,
        FoodName,
        Calorie,
        Fat,
        Protein,
        Carbohydrates,
        FoodImgID,
        Food_categoryID
    FROM fooddata
    WHERE FoodID = :id
    LIMIT 1
";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', (int)$foodId, PDO::PARAM_INT);
$stmt->execute();

$food = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$food) {
    $output['errorMessage'] = '找不到食物資料';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

/* |-------------------------------------------------
   | 成功回傳
   |------------------------------------------------- */
$output['success'] = true;
$output['data'] = $food;

echo json_encode($output, JSON_UNESCAPED_UNICODE);