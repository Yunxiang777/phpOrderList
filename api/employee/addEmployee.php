<?php
// api/employee/createEmployee.php
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
 | 基本輸入驗證
 |-------------------------------------------------
*/
$requiredFields = [
    'name',
    'avatarname',
    'email',
    'password',
    'gender',
    'birthday',
    'role',
];

foreach ($requiredFields as $field) {
    if (empty($_POST[$field])) {
        $output['errorMessage'] = "缺少必要欄位：{$field}";
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
        exit;
    }
}

/*
 |-------------------------------------------------
 | SQL
 |-------------------------------------------------
*/
$sql = "
    INSERT INTO employee
        (name, avatarname, email, password, gender, birthday, role)
    VALUES
        (?, ?, ?, ?, ?, ?, ?)
";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $_POST['name'],
    $_POST['avatarname'],
    $_POST['email'],
    password_hash($_POST['password'], PASSWORD_DEFAULT),
    $_POST['gender'],
    $_POST['birthday'],
    $_POST['role'],
]);

if ($stmt->rowCount() === 1) {
    $output['success'] = true;
    $output['data'] = [
        'id' => $pdo->lastInsertId(),
    ];
} else {
    $output['errorMessage'] = '新增失敗';
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
