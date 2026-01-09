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
    'foodName' => '食物名稱',
    'calorie' => '熱量',
    'fat' => '脂肪',
    'protein' => '蛋白質',
    'carbohydrates' => '碳水化合物',
    'categoryId' => '分類',
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

// 驗證數值欄位
$numericFields = ['calorie', 'fat', 'protein', 'carbohydrates'];
foreach ($numericFields as $field) {
    if (!is_numeric($_POST[$field]) || $_POST[$field] < 0) {
        $response['errorMessage'] = "{$fields[$field]}必須為正數";
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }
}

// 驗證分類 ID
if (!in_array($_POST['categoryId'], ['1', '2', '3', '4', '5', '6'])) {
    $response['errorMessage'] = '分類選擇不正確';
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
}

/* |-------------------------------------------------
   | 檔案上傳處理
   |------------------------------------------------- */
$imgFileName = $_POST['imgFileName'] ?? '';

if (isset($_FILES['foodImg']) && $_FILES['foodImg']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = ROOT_PATH . '/public/img/food/';
    
    // 確保目錄存在
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    
    $tmpName = $_FILES['foodImg']['tmp_name'];
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
    if ($_FILES['foodImg']['size'] > 5 * 1024 * 1024) {
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
        INSERT INTO fooddata (
            FoodName, 
            Calorie, 
            Fat, 
            Protein, 
            Carbohydrates, 
            FoodImgID, 
            Food_categoryID
        )
        VALUES (
            :foodName, 
            :calorie, 
            :fat, 
            :protein, 
            :carbohydrates, 
            :imgFileName, 
            :categoryId
        )
    ";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':foodName' => $_POST['foodName'],
        ':calorie' => (float)$_POST['calorie'],
        ':fat' => (float)$_POST['fat'],
        ':protein' => (float)$_POST['protein'],
        ':carbohydrates' => (float)$_POST['carbohydrates'],
        ':imgFileName' => $imgFileName,
        ':categoryId' => (int)$_POST['categoryId'],
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