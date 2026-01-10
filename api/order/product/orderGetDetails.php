<?php
declare(strict_types=1);

require_once __DIR__ . '/../../api_guard.php';

use App\Core\Database;

header('Content-Type: application/json; charset=utf-8');

$pdo = Database::getInstance();

$output = [
    'success' => false,
    'errorMessage' => '',
    'data' => null,
];

/* |-------------------------------------------------
   | 輸入驗證
   |------------------------------------------------- */
$orderId = $_POST['orderId'] ?? null;

if ($orderId === null || !ctype_digit((string)$orderId)) {
    $output['errorMessage'] = '訂單 ID 不正確';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

/* |-------------------------------------------------
   | 查詢訂單明細（含商品資訊）
   |------------------------------------------------- */
$sql = "
    SELECT 
        od.orderrealdetail_PID,
        od.buynum,
        p.p_name,
        p.p_specification,
        p.p_size,
        p.p_price,
        p.p_image
    FROM orderreal_detail od
    LEFT JOIN productall p ON od.orderrealdetail_PID = p.p_id
    WHERE od.orderrealdetail_orderrealID = :orderId
";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':orderId', (int)$orderId, PDO::PARAM_INT);
$stmt->execute();

$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($items, JSON_UNESCAPED_UNICODE);