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
    'id' => '商品 ID',
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
        $output['errorMessage'] = "缺少必要欄位：{$label}";
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
        exit;
    }
}

// ID 必須是正整數
if (!ctype_digit((string)$_POST['id'])) {
    $output['errorMessage'] = '商品 ID 不合法';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

// 驗證價格和數量（必須為正數）
if (!is_numeric($_POST['price']) || $_POST['price'] < 0) {
    $output['errorMessage'] = '商品價格必須為正數';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

if (!is_numeric($_POST['quantity']) || $_POST['quantity'] < 0) {
    $output['errorMessage'] = '商品數量必須為正整數';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

// 驗證分類
$validCategories = ['健身器材', '健身配件', '運動服飾'];
if (!in_array($_POST['category'], $validCategories)) {
    $output['errorMessage'] = '商品分類不正確';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

/* |-------------------------------------------------
   | 資料庫處理
   |------------------------------------------------- */
try {
    // 確認商品是否存在
    $checkStmt = $pdo->prepare(
        "SELECT p_image FROM productall WHERE p_id = :id"
    );
    $checkStmt->execute([':id' => $_POST['id']]);
    
    $currentProduct = $checkStmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$currentProduct) {
        $output['errorMessage'] = '商品不存在';
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
        exit;
    }
    
    /* |-------------------------------------------------
       | 檔案上傳處理
       |------------------------------------------------- */
    $imgFileName = $_POST['imgFileName'] ?? $currentProduct['p_image'];
    
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
            $output['errorMessage'] = '檔案類型不支援，僅支援 JPG, PNG, GIF, WEBP';
            echo json_encode($output, JSON_UNESCAPED_UNICODE);
            exit;
        }
        
        // 檢查檔案大小（5MB）
        if ($_FILES['productImg']['size'] > 5 * 1024 * 1024) {
            $output['errorMessage'] = '檔案大小不能超過 5MB';
            echo json_encode($output, JSON_UNESCAPED_UNICODE);
            exit;
        }
        
        // 刪除舊檔案（如果存在且不同於新檔名且不是預設圖片）
        $oldImgPath = $uploadDir . $currentProduct['p_image'];
        if ($currentProduct['p_image'] !== $imgFileName 
            && $currentProduct['p_image'] !== 'default.jpg'
            && file_exists($oldImgPath)) {
            unlink($oldImgPath);
        }
        
        // 移動檔案
        if (!move_uploaded_file($tmpName, $targetPath)) {
            $output['errorMessage'] = '檔案上傳失敗';
            echo json_encode($output, JSON_UNESCAPED_UNICODE);
            exit;
        }
    }
    
    /* |-------------------------------------------------
       | 更新資料庫
       |------------------------------------------------- */
    $sql = "
        UPDATE productall
        SET p_name = :name,
            p_description = :description,
            p_specification = :specification,
            p_size = :size,
            p_category = :category,
            p_price = :price,
            p_quantity = :quantity,
            p_image = :imgFileName
        WHERE p_id = :id
    ";
    
    $params = [
        ':name' => $_POST['name'],
        ':description' => $_POST['description'] ?? null,
        ':specification' => $_POST['specification'] ?? null,
        ':size' => $_POST['size'] ?? null,
        ':category' => $_POST['category'],
        ':price' => (int)$_POST['price'],
        ':quantity' => (int)$_POST['quantity'],
        ':imgFileName' => $imgFileName,
        ':id' => $_POST['id'],
    ];
    
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