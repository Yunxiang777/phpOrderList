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

/* |-------------------------------------------------
   | 必填欄位定義
   |------------------------------------------------- */
$fields = [
    'name' => '姓名',
    'email' => '電子郵件',
    'password' => '密碼',
];

/* |-------------------------------------------------
   | 輸入驗證
   |------------------------------------------------- */
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

// 生日格式驗證（若有提供）
if (!empty($_POST['birthday'])) {
    if (!DateTime::createFromFormat('Y-m-d', $_POST['birthday'])) {
        $response['errorMessage'] = '生日格式錯誤，請使用 YYYY-MM-DD';
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }
}

// 檢查 Email 是否已存在
try {
    $checkSql = "SELECT MemberID FROM member WHERE email = :email LIMIT 1";
    $checkStmt = $pdo->prepare($checkSql);
    $checkStmt->execute([':email' => $_POST['email']]);
    
    if ($checkStmt->fetch()) {
        $response['errorMessage'] = '此電子郵件已被註冊';
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }
} catch (Throwable $e) {
    $response['errorMessage'] = '系統錯誤，請稍後再試';
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
}

/* |-------------------------------------------------
   | 檔案上傳處理
   |------------------------------------------------- */
$avatarname = $_POST['avatarname'] ?? '';

if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = ROOT_PATH . '/public/img/member/avatar/';
    
    // 確保目錄存在
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    
    $tmpName = $_FILES['avatar']['tmp_name'];
    $targetPath = $uploadDir . $avatarname;
    
    // 驗證檔案類型（只允許圖片）
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $fileType = mime_content_type($tmpName);
    
    if (!in_array($fileType, $allowedTypes)) {
        $response['errorMessage'] = '檔案類型不支援，僅支援 JPG, PNG, GIF, WEBP';
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }
    
    // 檢查檔案大小（5MB）
    if ($_FILES['avatar']['size'] > 5 * 1024 * 1024) {
        $response['errorMessage'] = '檔案大小不能超過 5MB';
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }
    
    // 移動檔案
    if (!move_uploaded_file($tmpName, $targetPath)) {
        $response['errorMessage'] = '檔案上傳失敗';
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }
}

/* |-------------------------------------------------
   | 寫入資料庫
   |------------------------------------------------- */
try {
    $sql = "
        INSERT INTO member (
            name, 
            avatarname, 
            email, 
            password, 
            gender, 
            birthday, 
            phone_number, 
            address, 
            subscribe, 
            帳號是否啟動
        )
        VALUES (
            :name, 
            :avatarname, 
            :email, 
            :password, 
            :gender, 
            :birthday, 
            :phone_number, 
            :address, 
            :subscribe, 
            :active
        )
    ";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':name' => $_POST['name'],
        ':avatarname' => $avatarname,
        ':email' => $_POST['email'],
        ':password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
        ':gender' => $_POST['gender'] ?? '男',
        ':birthday' => $_POST['birthday'] ?? null,
        ':phone_number' => $_POST['phone_number'] ?? null,
        ':address' => $_POST['address'] ?? null,
        ':subscribe' => $_POST['subscribe'] ?? 0,
        ':active' => $_POST['active'] ?? 1,
    ]);
    
    $id = $pdo->lastInsertId();
    
    if ($id) {
        $response['success'] = true;
        $response['data'] = ['id' => $id];
    } else {
        $response['errorMessage'] = '新增失敗';
    }
} catch (Throwable $e) {
    $response['errorMessage'] = '系統錯誤，請稍後再試';
    // error_log($e->getMessage());
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);