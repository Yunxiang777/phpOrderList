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
$productId = $_POST['id'] ?? null;

if ($productId === null || !ctype_digit((string)$productId)) {
    $response['errorMessage'] = '商品 ID 不正確';
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
}

/* |-------------------------------------------------
   | 刪除商品
   |------------------------------------------------- */
try {
    // 先查詢商品是否存在，並取得圖片檔名
    $checkSql = "SELECT p_image FROM productall WHERE p_id = :id LIMIT 1";
    $checkStmt = $pdo->prepare($checkSql);
    $checkStmt->execute([':id' => $productId]);
    $product = $checkStmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$product) {
        $response['errorMessage'] = '商品不存在';
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }
    
    // 執行刪除
    $sql = "DELETE FROM productall WHERE p_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $productId]);
    
    if ($stmt->rowCount() === 1) {
        // 刪除圖片檔案（如果不是預設圖片）
        if ($product['p_image'] && $product['p_image'] !== 'default.jpg') {
            $imgPath = ROOT_PATH . '/public/img/product/' . $product['p_image'];
            if (file_exists($imgPath)) {
                unlink($imgPath);
            }
        }
        
        $response['success'] = true;
        $response['data'] = ['id' => $productId];
    } else {
        $response['errorMessage'] = '刪除失敗';
    }
    
} catch (Throwable $e) {
    $response['errorMessage'] = '系統錯誤，請稍後再試';
    // error_log($e->getMessage());
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);