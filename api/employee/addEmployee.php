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

/*
 |-------------------------------------------------
 | 必填欄位定義
 |-------------------------------------------------
*/
$fields = [
    'name'       => '姓名',
    'avatarname' => '頭像',
    'email'      => '電子郵件',
    'password'   => '密碼',
    'gender'     => '性別',
    'birthday'   => '生日',
    'role'       => '角色',
];

/*
 |-------------------------------------------------
 | 輸入驗證
 |-------------------------------------------------
*/
foreach ($fields as $key => $label) {
    if (!isset($_POST[$key]) || trim((string)$_POST[$key]) === '') {
        $response['errorMessage'] = "缺少必要欄位：{$label}";
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }
}

// Email 格式驗證
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $response['errorMessage'] = '電子郵件格式不正確';
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
}

// 生日格式驗證（YYYY-MM-DD）
if (!DateTime::createFromFormat('Y-m-d', $_POST['birthday'])) {
    $response['errorMessage'] = '生日格式錯誤，請使用 YYYY-MM-DD';
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
}

/*
 |-------------------------------------------------
 | 寫入資料庫
 |-------------------------------------------------
*/
try {
    $sql = "
        INSERT INTO employee
            (name, avatarname, email, password, gender, birthday, role)
        VALUES
            (:name, :avatarname, :email, :password, :gender, :birthday, :role)
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':name'       => $_POST['name'],
        ':avatarname' => $_POST['avatarname'],
        ':email'      => $_POST['email'],
        ':password'   => password_hash($_POST['password'], PASSWORD_DEFAULT),
        ':gender'     => $_POST['gender'],
        ':birthday'   => $_POST['birthday'],
        ':role'       => $_POST['role'],
    ]);

    $id = $pdo->lastInsertId();
    if ($id) {
        $response['success'] = true;
        $response['data'] = ['id' => $id];
    } else {
        $response['errorMessage'] = '新增失敗';
    }

} catch (Throwable $e) {
    // production 只回通用錯誤訊息
    $response['errorMessage'] = '系統錯誤，請稍後再試';
    // error_log($e->getMessage());
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
