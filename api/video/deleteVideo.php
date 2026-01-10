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
   | 輸入驗證
   |------------------------------------------------- */
$videoId = $_POST['id'] ?? null;

if ($videoId === null || !ctype_digit((string)$videoId)) {
    $response['errorMessage'] = '影片 ID 不正確';
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
}

/* |-------------------------------------------------
   | 刪除影片
   |------------------------------------------------- */
try {
    // 先查詢影片是否存在，並取得縮圖檔名
    $checkSql = "SELECT vidthumbnail FROM fitvideos WHERE VideoID = :id LIMIT 1";
    $checkStmt = $pdo->prepare($checkSql);
    $checkStmt->execute([':id' => $videoId]);
    $video = $checkStmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$video) {
        $response['errorMessage'] = '影片不存在';
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }
    
    // 執行刪除
    $sql = "DELETE FROM fitvideos WHERE VideoID = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $videoId]);
    
    if ($stmt->rowCount() === 1) {
        // 刪除縮圖檔案（如果不是預設縮圖）
        if ($video['vidthumbnail'] && $video['vidthumbnail'] !== 'video.png') {
            $thumbnailPath = ROOT_PATH . '/public/img/video/' . $video['vidthumbnail'];
            if (file_exists($thumbnailPath)) {
                unlink($thumbnailPath);
            }
        }
        
        $response['success'] = true;
        $response['data'] = ['id' => $videoId];
    } else {
        $response['errorMessage'] = '刪除失敗';
    }
    
} catch (Throwable $e) {
    $response['errorMessage'] = '系統錯誤，請稍後再試';
    // error_log($e->getMessage());
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);