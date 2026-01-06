<?php

// 確保 Session 已啟動
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 專案根目錄（ for require ）
define('ROOT_PATH', dirname(__DIR__) . '/VENDOR_DASHBOARD');

// 設定
$config = require ROOT_PATH . '/config/app.php';

// 載入資料庫 Singleton
require_once ROOT_PATH . '/app/core/Database.php';

// URL 根路徑（ for redirect / link ）
define('BASE_URL', rtrim($config['app']['base_url'], '/'));
