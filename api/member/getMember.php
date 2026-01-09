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
$memberId = $_POST['id'] ?? null;

if ($memberId === null || !ctype_digit((string)$memberId)) {
    $output['errorMessage'] = '會員 ID 不正確';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

/* |-------------------------------------------------
   | 查詢會員
   |------------------------------------------------- */
$sql = "
    SELECT
        MemberID,
        name,
        avatarname,
        email,
        gender,
        birthday,
        phone_number,
        address,
        subscribe,
        帳號是否啟動
    FROM member
    WHERE MemberID = :id
    LIMIT 1
";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', (int)$memberId, PDO::PARAM_INT);
$stmt->execute();

$member = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$member) {
    $output['errorMessage'] = '找不到會員資料';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

/* |-------------------------------------------------
   | 成功回傳
   |------------------------------------------------- */
$output['success'] = true;
$output['data'] = $member;

echo json_encode($output, JSON_UNESCAPED_UNICODE);