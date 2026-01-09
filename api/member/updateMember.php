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
   | 必填欄位定義
   |------------------------------------------------- */
$fields = [
    'id' => '會員 ID',
    'name' => '姓名',
    'email' => '電子郵件',
    'gender' => '性別',
];

/* |-------------------------------------------------
   | 輸入驗證
   |------------------------------------------------- */
foreach ($fields as $key => $label) {
    if (!isset($_POST[$key]) || trim((string)$_POST[$key]) === '') {
        $output['errorMessage'] = "缺少必要欄位：{$label}";
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
        exit;
    }
}

// ID 必須是正整數
if (!ctype_digit((string)$_POST['id'])) {
    $output['errorMessage'] = '會員 ID 不合法';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

// Email 格式驗證
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $output['errorMessage'] = '電子郵件格式不正確';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

// 生日格式驗證（若有提供）
if (!empty($_POST['birthday'])) {
    if (!DateTime::createFromFormat('Y-m-d', $_POST['birthday'])) {
        $output['errorMessage'] = '生日格式錯誤，請使用 YYYY-MM-DD';
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
        exit;
    }
}

/* |-------------------------------------------------
   | 資料庫處理
   |------------------------------------------------- */
try {
    // 確認會員是否存在
    $checkStmt = $pdo->prepare(
        "SELECT avatarname FROM member WHERE MemberID = :id"
    );
    $checkStmt->execute([':id' => $_POST['id']]);
    
    $currentMember = $checkStmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$currentMember) {
        $output['errorMessage'] = '會員不存在';
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
        exit;
    }
    
    // 檢查 Email 是否被其他會員使用
    $emailCheckStmt = $pdo->prepare(
        "SELECT MemberID FROM member WHERE email = :email AND MemberID != :id LIMIT 1"
    );
    $emailCheckStmt->execute([
        ':email' => $_POST['email'],
        ':id' => $_POST['id']
    ]);
    
    if ($emailCheckStmt->fetch()) {
        $output['errorMessage'] = '此電子郵件已被其他會員使用';
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
        exit;
    }
    
    /* |-------------------------------------------------
       | 檔案上傳處理
       |------------------------------------------------- */
    $avatarname = $_POST['avatarname'] ?? $currentMember['avatarname'];
    
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
            $output['errorMessage'] = '檔案類型不支援，僅支援 JPG, PNG, GIF, WEBP';
            echo json_encode($output, JSON_UNESCAPED_UNICODE);
            exit;
        }
        
        // 檢查檔案大小（5MB）
        if ($_FILES['avatar']['size'] > 5 * 1024 * 1024) {
            $output['errorMessage'] = '檔案大小不能超過 5MB';
            echo json_encode($output, JSON_UNESCAPED_UNICODE);
            exit;
        }
        
        // 刪除舊檔案（如果存在且不同於新檔名且不是預設頭貼）
        $oldAvatarPath = $uploadDir . $currentMember['avatarname'];
        if ($currentMember['avatarname'] !== $avatarname 
            && $currentMember['avatarname'] !== 'avatar.png'
            && file_exists($oldAvatarPath)) {
            unlink($oldAvatarPath);
        }
        
        // 移動檔案
        if (!move_uploaded_file($tmpName, $targetPath)) {
            $output['errorMessage'] = '檔案上傳失敗';
            echo json_encode($output, JSON_UNESCAPED_UNICODE);
            exit;
        }
    }
    
    /* |-------------------------------------------------
       | 組 UPDATE SQL（密碼可選）
       |------------------------------------------------- */
    $sql = "
        UPDATE member
        SET name = :name,
            avatarname = :avatarname,
            email = :email,
            gender = :gender,
            birthday = :birthday,
            phone_number = :phone_number,
            address = :address,
            subscribe = :subscribe,
            帳號是否啟動 = :active
    ";
    
    $params = [
        ':name' => $_POST['name'],
        ':avatarname' => $avatarname,
        ':email' => $_POST['email'],
        ':gender' => $_POST['gender'],
        ':birthday' => $_POST['birthday'] ?? null,
        ':phone_number' => $_POST['phone_number'] ?? null,
        ':address' => $_POST['address'] ?? null,
        ':subscribe' => $_POST['subscribe'] ?? 0,
        ':active' => $_POST['active'] ?? 1,
        ':id' => $_POST['id'],
    ];
    
    // 若有傳密碼才更新
    if (!empty($_POST['password'])) {
        $sql .= ", password = :password";
        $params[':password'] = password_hash(
            $_POST['password'],
            PASSWORD_DEFAULT
        );
    }
    
    $sql .= " WHERE MemberID = :id";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    
    $output['success'] = true;
    $output['data'] = [
        'id' => $_POST['id'],
    ];
    
} catch (Throwable $e) {
    $output['errorMessage'] = '系統錯誤，請稍後再試';
    // error_log($e->getMessage());
}

/* |-------------------------------------------------
   | 回傳結果
   |------------------------------------------------- */
echo json_encode($output, JSON_UNESCAPED_UNICODE);