<?php
declare(strict_types=1);

require_once __DIR__ . '/../api_guard.php';

use App\Core\Database;

header('Content-Type: application/json; charset=utf-8');

$pdo = Database::getInstance();

/* |-------------------------------------------------
   | 查詢所有影片資料
   |------------------------------------------------- */
$sql = "
    SELECT 
        VideoID,
        Title,
        ReleaseDate,
        URL
    FROM fitvideos
";

$stmt = $pdo->prepare($sql);
$stmt->execute();

$videos = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($videos, JSON_UNESCAPED_UNICODE);