<?php
declare(strict_types=1);

// -------------------------------------------------
// 基本設定
// -------------------------------------------------
require_once __DIR__ . '/../api_guard.php';

use App\Core\Database;

header('Content-Type: application/json; charset=utf-8');

$pdo = Database::getInstance();

$output = [
    'success' => false,
    'errorMessage' => '',
    'data' => null,
];

// -------------------------------------------------
// 必填欄位定義
// -------------------------------------------------
$fields = [
    'id'         => '員工 ID',
    'name'       => '姓名',
    'avatarname' => '頭像',
    'email'      => '電子郵件',
    'gender'     => '性別',
    'birthday'   => '生日',
    'role'       => '角色',
    'valid'      => '狀態'
];

// -------------------------------------------------
// 輸入驗證
// -------------------------------------------------
foreach ($fields as $key => $label) {
    if (!isset($_POST[$key]) || trim((string)$_POST[$key]) === '') {
        $output['errorMessage'] = "缺少必要欄位：{$label}";
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
        exit;
    }
}

// ID 必須是正整數
if (!ctype_digit((string)$_POST['id'])) {
    $output['errorMessage'] = '員工 ID 不合法';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

// Email 格式驗證
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $output['errorMessage'] = '電子郵件格式不正確';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

// 生日格式驗證（YYYY-MM-DD）
if (!DateTime::createFromFormat('Y-m-d', $_POST['birthday'])) {
    $output['errorMessage'] = '生日格式錯誤，請使用 YYYY-MM-DD';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

// -------------------------------------------------
// 資料庫處理
// -------------------------------------------------
try {

    // 1️⃣ 確認員工是否存在（關鍵）
    $checkStmt = $pdo->prepare(
        "SELECT 1 FROM employee WHERE e_id = :id"
    );
    $checkStmt->execute([
        ':id' => $_POST['id']
    ]);

    if (!$checkStmt->fetchColumn()) {
        $output['errorMessage'] = '員工不存在';
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
        exit;
    }

    // 2️⃣ 組 UPDATE SQL（密碼可選）
    $sql = "
        UPDATE employee SET
            name = :name,
            avatarname = :avatarname,
            email = :email,
            gender = :gender,
            birthday = :birthday,
            role = :role
    ";

    $params = [
        ':name'       => $_POST['name'],
        ':avatarname' => $_POST['avatarname'],
        ':email'      => $_POST['email'],
        ':gender'     => $_POST['gender'],
        ':birthday'   => $_POST['birthday'],
        ':role'       => $_POST['role'],
        ':valid'      => $_POST['valid'],
        ':id'         => $_POST['id'],
    ];

    // 若有傳密碼才更新
    if (!empty($_POST['password'])) {
        $sql .= ", password = :password";
        $params[':password'] = password_hash(
            $_POST['password'],
            PASSWORD_DEFAULT
        );
    }

    $sql .= " WHERE e_id = :id";

    // 3️⃣ 執行 UPDATE（不看 rowCount）
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    // 4️⃣ 只要能執行到這裡，一律成功
    $output['success'] = true;
    $output['data'] = [
        'id' => $_POST['id'],
    ];

} catch (Throwable $e) {
    $output['errorMessage'] = '系統錯誤，請稍後再試';
    // error_log($e->getMessage());
}

// -------------------------------------------------
// 回傳結果
// -------------------------------------------------
echo json_encode($output, JSON_UNESCAPED_UNICODE);
