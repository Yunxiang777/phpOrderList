<?php
declare(strict_types=1);

require_once __DIR__ . '/../api_guard.php';

use App\Core\Database;

header('Content-Type: application/json; charset=utf-8');

$pdo = Database::getInstance();

$response = [
    'success' => false,
    'errorMessage' => '',
    'data' => null,
];

/* |-------------------------------------------------
   | 輸入驗證
   |------------------------------------------------- */
$foodId = $_POST['id'] ?? null;

if ($foodId === null || !ctype_digit((string)$foodId)) {
    $response['errorMessage'] = '食物 ID 不正確';
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
}

/* |-------------------------------------------------
   | 刪除食物
   |------------------------------------------------- */
try {
    // 先查詢食物是否存在，並取得圖片檔名
    $checkSql = "SELECT FoodImgID FROM fooddata WHERE FoodID = :id LIMIT 1";
    $checkStmt = $pdo->prepare($checkSql);
    $checkStmt->execute([':id' => $foodId]);
    $food = $checkStmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$food) {
        $response['errorMessage'] = '食物不存在';
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }
    
    // 執行刪除
    $sql = "DELETE FROM fooddata WHERE FoodID = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $foodId]);
    
    if ($stmt->rowCount() === 1) {
        // 刪除圖片檔案（如果不是預設圖片）
        if ($food['FoodImgID'] && $food['FoodImgID'] !== 'default-food.png') {
            $imgPath = ROOT_PATH . '/public/img/food/' . $food['FoodImgID'];
            if (file_exists($imgPath)) {
                unlink($imgPath);
            }
        }
        
        $response['success'] = true;
        $response['data'] = ['id' => $foodId];
    } else {
        $response['errorMessage'] = '刪除失敗';
    }
    
} catch (Throwable $e) {
    $response['errorMessage'] = '系統錯誤，請稍後再試';
    // error_log($e->getMessage());
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);