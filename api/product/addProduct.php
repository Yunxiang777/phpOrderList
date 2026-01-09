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
    'name' => '商品名稱',
    'category' => '商品分類',
    'price' => '商品價格',
    'quantity' => '商品數量',
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

// 驗證價格和數量（必須為正數）
if (!is_numeric($_POST['price']) || $_POST['price'] < 0) {
    $response['errorMessage'] = '商品價格必須為正數';
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
}

if (!is_numeric($_POST['quantity']) || $_POST['quantity'] < 0) {
    $response['errorMessage'] = '商品數量必須為正整數';
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
}

// 驗證分類
$validCategories = ['健身器材', '健身配件', '運動服飾'];
if (!in_array($_POST['category'], $validCategories)) {
    $response['errorMessage'] = '商品分類不正確';
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
}

/* |-------------------------------------------------
   | 檔案上傳處理
   |------------------------------------------------- */
$imgFileName = $_POST['imgFileName'] ?? 'default.jpg';

if (isset($_FILES['productImg']) && $_FILES['productImg']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = ROOT_PATH . '/public/img/product/';
    
    // 確保目錄存在
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    
    $tmpName = $_FILES['productImg']['tmp_name'];
    $targetPath = $uploadDir . $imgFileName;
    
    // 驗證檔案類型（只允許圖片）
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $fileType = mime_content_type($tmpName);
    
    if (!in_array($fileType, $allowedTypes)) {
        $response['errorMessage'] = '檔案類型不支援，僅支援 JPG, PNG, GIF, WEBP';
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }
    
    // 檢查檔案大小（5MB）
    if ($_FILES['productImg']['size'] > 5 * 1024 * 1024) {
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
        INSERT INTO productall (
            p_name, 
            p_description, 
            p_specification, 
            p_size, 
            p_category, 
            p_price, 
            p_quantity, 
            p_image
        )
        VALUES (
            :name, 
            :description, 
            :specification, 
            :size, 
            :category, 
            :price, 
            :quantity, 
            :imgFileName
        )
    ";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':name' => $_POST['name'],
        ':description' => $_POST['description'] ?? null,
        ':specification' => $_POST['specification'] ?? null,
        ':size' => $_POST['size'] ?? null,
        ':category' => $_POST['category'],
        ':price' => (int)$_POST['price'],
        ':quantity' => (int)$_POST['quantity'],
        ':imgFileName' => $imgFileName,
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