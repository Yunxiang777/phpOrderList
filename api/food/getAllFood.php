<?php
declare(strict_types=1);

require_once __DIR__ . '/../api_guard.php';

use App\Core\Database;

header('Content-Type: application/json; charset=utf-8');

$pdo = Database::getInstance();

/* |-------------------------------------------------
   | 查詢所有食物資料
   |------------------------------------------------- */
$sql = "
    SELECT 
        f.FoodID,
        f.FoodName
    FROM fooddata f
";

$stmt = $pdo->prepare($sql);
$stmt->execute();

$foods = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($foods, JSON_UNESCAPED_UNICODE);