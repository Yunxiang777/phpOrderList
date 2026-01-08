<?php
// api/employee/getEmployee.php
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

/*
 |-------------------------------------------------
 | 輸入驗證（POST）
 |-------------------------------------------------
*/
$eId = $_POST['id'] ?? null;

if ($eId === null || !ctype_digit((string)$eId)) {
    $output['errorMessage'] = '員工 ID 不正確';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

/*
 |-------------------------------------------------
 | 查詢員工
 |-------------------------------------------------
*/
$sql = "
    SELECT
        e_id,
        name,
        email,
        gender,
        birthday,
        role, 
        avatarname,
        is_active,
        password
    FROM employee
    WHERE e_id = :id
    LIMIT 1
";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', (int)$eId, PDO::PARAM_INT);
$stmt->execute();

$employee = $stmt->fetch();

if (!$employee) {
    $output['errorMessage'] = '找不到員工資料';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

/*
 |-------------------------------------------------
 | 成功回傳
 |-------------------------------------------------
*/
$output['success'] = true;
$output['data'] = $employee;

echo json_encode($output, JSON_UNESCAPED_UNICODE);
