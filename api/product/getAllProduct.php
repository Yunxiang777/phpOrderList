<?php
declare(strict_types=1);

require_once __DIR__ . '/../api_guard.php';

use App\Core\Database;

header('Content-Type: application/json; charset=utf-8');

$pdo = Database::getInstance();

/* |-------------------------------------------------
   | 查詢所有商品資料
   |------------------------------------------------- */
$sql = "
    SELECT 
        p_id,
        p_name,
        p_specification,
        p_size,
        p_price,
        p_quantity
    FROM productall
";

$stmt = $pdo->prepare($sql);
$stmt->execute();

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($products, JSON_UNESCAPED_UNICODE);