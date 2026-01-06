<?php
declare(strict_types=1);

// 共用資料
require_once dirname(__DIR__) . '/bootstrap.php';

// 回傳 JSON
header('Content-Type: application/json; charset=utf-8');

// 只允許 POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
    exit;
}

// 是否登入
if (empty($_SESSION['user'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

// CSRF 驗證
$csrf = $_POST['csrf'] ?? '';
if (
    empty($csrf) ||
    empty($_SESSION['csrf']) ||
    !hash_equals($_SESSION['csrf'], $csrf)
) {
    http_response_code(403);
    echo json_encode(['error' => 'CSRF validation failed']);
    exit;
}
