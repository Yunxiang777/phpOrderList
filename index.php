<?php
require_once __DIR__ . '/bootstrap.php';

// 驗證使用者是否登入
require_once ROOT_PATH . '/app/auth/auth.php';
// 確認使用者已登入，否則重定向到登入頁面
?>

<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VENDOR_DASHBOARD | 管理後台</title>
    <?php include ROOT_PATH . '/views/layout/commonCss.php'; //共用css ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <?php include ROOT_PATH . '/views/layout/sidebar.php'; // 側邊攔選單項目?>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <h1>歡迎回來，<?= $_SESSION["name"]; ?>。</h1>
                </div>
            </section>
        </div>
    </div>
</body>
    <?php include ROOT_PATH . '/views/layout/commonJs.php'; //共用js ?>
</html>