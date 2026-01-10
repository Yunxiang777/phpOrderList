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
    'id' => '影片 ID',
    'title' => '影片標題',
    'releaseDate' => '上架日期',
    'url' => '影片網址',
    'muscleGroup' => '肌群分類',
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
    $output['errorMessage'] = '影片 ID 不合法';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

// 驗證日期格式
if (!DateTime::createFromFormat('Y-m-d', $_POST['releaseDate'])) {
    $output['errorMessage'] = '上架日期格式錯誤，請使用 YYYY-MM-DD';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

// 驗證 URL 格式
if (!filter_var($_POST['url'], FILTER_VALIDATE_URL)) {
    $output['errorMessage'] = '影片網址格式不正確';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

// 驗證肌群分類
if (!in_array($_POST['muscleGroup'], ['1', '2', '3', '4', '5', '6', '7'])) {
    $output['errorMessage'] = '肌群分類選擇不正確';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

/* |-------------------------------------------------
   | 資料庫處理
   |------------------------------------------------- */
try {
    // 確認影片是否存在
    $checkStmt = $pdo->prepare(
        "SELECT vidthumbnail FROM fitvideos WHERE VideoID = :id"
    );
    $checkStmt->execute([':id' => $_POST['id']]);
    
    $currentVideo = $checkStmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$currentVideo) {
        $output['errorMessage'] = '影片不存在';
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
        exit;
    }
    
    /* |-------------------------------------------------
       | 檔案上傳處理
       |------------------------------------------------- */
    $thumbnailName = $_POST['thumbnailName'] ?? $currentVideo['vidthumbnail'];
    
    if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = ROOT_PATH . '/public/img/video/';
        
        // 確保目錄存在
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        $tmpName = $_FILES['thumbnail']['tmp_name'];
        $targetPath = $uploadDir . $thumbnailName;
        
        // 驗證檔案類型（只允許圖片）
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $fileType = mime_content_type($tmpName);
        
        if (!in_array($fileType, $allowedTypes)) {
            $output['errorMessage'] = '檔案類型不支援，僅支援 JPG, PNG, GIF, WEBP';
            echo json_encode($output, JSON_UNESCAPED_UNICODE);
            exit;
        }
        
        // 檢查檔案大小（5MB）
        if ($_FILES['thumbnail']['size'] > 5 * 1024 * 1024) {
            $output['errorMessage'] = '檔案大小不能超過 5MB';
            echo json_encode($output, JSON_UNESCAPED_UNICODE);
            exit;
        }
        
        // 刪除舊檔案（如果存在且不同於新檔名且不是預設縮圖）
        $oldThumbnailPath = $uploadDir . $currentVideo['vidthumbnail'];
        if ($currentVideo['vidthumbnail'] !== $thumbnailName 
            && $currentVideo['vidthumbnail'] !== 'video.png'
            && file_exists($oldThumbnailPath)) {
            unlink($oldThumbnailPath);
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
        UPDATE fitvideos
        SET vidthumbnail = :thumbnailName,
            Title = :title,
            ReleaseDate = :releaseDate,
            Description = :description,
            URL = :url,
            musclegroupID = :muscleGroup
        WHERE VideoID = :id
    ";
    
    $params = [
        ':thumbnailName' => $thumbnailName,
        ':title' => $_POST['title'],
        ':releaseDate' => $_POST['releaseDate'],
        ':description' => $_POST['description'] ?? null,
        ':url' => $_POST['url'],
        ':muscleGroup' => (int)$_POST['muscleGroup'],
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