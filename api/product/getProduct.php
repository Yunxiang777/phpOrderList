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
$productId = $_POST['id'] ?? null;

if ($productId === null || !ctype_digit((string)$productId)) {
    $output['errorMessage'] = '商品 ID 不正確';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

/* |-------------------------------------------------
   | 查詢商品
   |------------------------------------------------- */
$sql = "
    SELECT
        p_id,
        p_name,
        p_description,
        p_specification,
        p_size,
        p_category,
        p_price,
        p_quantity,
        p_image
    FROM productall
    WHERE p_id = :id
    LIMIT 1
";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', (int)$productId, PDO::PARAM_INT);
$stmt->execute();

$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    $output['errorMessage'] = '找不到商品資料';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

/* |-------------------------------------------------
   | 成功回傳
   |------------------------------------------------- */
$output['success'] = true;
$output['data'] = $product;

echo json_encode($output, JSON_UNESCAPED_UNICODE);