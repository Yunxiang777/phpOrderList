<?php
declare(strict_types=1);

require_once __DIR__ . '/../../api_guard.php';

use App\Core\Database;

header('Content-Type: application/json; charset=utf-8');

$pdo = Database::getInstance();

// 取得參數（可能不存在）
$startDate = $_POST['startDate'] ?? null;
$endDate   = $_POST['endDate']   ?? null;

/*
 |-------------------------------------------------
 | 基本 SQL
 |-------------------------------------------------
*/
$sql = "
    SELECT 
        o.orderrealID,
        o.orderrealmemberID,
        o.PAY_methods,
        o.Shipping_methods,
        o.receiver,
        o.receiver_phone,
        o.Shipping_address,
        o.Shipping_code,
        o.orderreal_date,
        m.name AS member_name
    FROM orderreal_main o
    LEFT JOIN member m ON o.orderrealmemberID = m.MemberID
";

$params = [];

/*
 |-------------------------------------------------
 | 有日期才加 WHERE
 |-------------------------------------------------
*/
if ($startDate && $endDate) {
    $sql .= " WHERE o.orderreal_date BETWEEN :startDate AND :endDate ";
    $params[':startDate'] = $startDate . ' 00:00:00';
    $params[':endDate']   = $endDate   . ' 23:59:59';
}

$sql .= " ORDER BY o.orderreal_date DESC ";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);

$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($orders, JSON_UNESCAPED_UNICODE);
