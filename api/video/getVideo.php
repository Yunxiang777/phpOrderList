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
   | 輸入驗證（POST）
   |------------------------------------------------- */
$videoId = $_POST['id'] ?? null;

if ($videoId === null || !ctype_digit((string)$videoId)) {
    $output['errorMessage'] = '影片 ID 不正確';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

/* |-------------------------------------------------
   | 查詢影片
   |------------------------------------------------- */
$sql = "
    SELECT
        VideoID,
        vidthumbnail,
        Title,
        ReleaseDate,
        Description,
        URL,
        musclegroupID
    FROM fitvideos
    WHERE VideoID = :id
    LIMIT 1
";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', (int)$videoId, PDO::PARAM_INT);
$stmt->execute();

$video = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$video) {
    $output['errorMessage'] = '找不到影片資料';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

/* |-------------------------------------------------
   | 成功回傳
   |------------------------------------------------- */
$output['success'] = true;
$output['data'] = $video;

echo json_encode($output, JSON_UNESCAPED_UNICODE);