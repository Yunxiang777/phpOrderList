<?php
// api/employee/getAllEmployee.php
declare(strict_types=1);

require_once __DIR__ . '/../api_guard.php';

use App\Core\Database;

$pdo = Database::getInstance();

$sql = "SELECT e_id, name, email, is_active FROM employee";
$stmt = $pdo->prepare($sql);
$stmt->execute();

echo json_encode(
    $stmt->fetchAll(),
    JSON_UNESCAPED_UNICODE
);
