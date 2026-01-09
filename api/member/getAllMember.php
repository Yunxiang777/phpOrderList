<?php
declare(strict_types=1);

require_once __DIR__ . '/../api_guard.php';

use App\Core\Database;

header('Content-Type: application/json; charset=utf-8');

$pdo = Database::getInstance();

/* |-------------------------------------------------
   | 查詢所有會員
   |------------------------------------------------- */
$sql = "
    SELECT 
        MemberID,
        name,
        email,
        phone_number,
        subscribe,
        帳號是否啟動
    FROM member
";

$stmt = $pdo->prepare($sql);
$stmt->execute();

$members = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($members, JSON_UNESCAPED_UNICODE);