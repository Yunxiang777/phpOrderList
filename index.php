<?php
require_once __DIR__ . '/bootstrap.php';

// 驗證使用者是否登入
require_once ROOT_PATH . '/app/auth/auth.php';
// 確認使用者已登入，否則重定向到登入頁面

// 側邊攔選單項目
$menuItems = $config['menuItems'];
$userName = $_SESSION["user"] ?? 'Guest';
$userAvatar = $_SESSION["avatar"] ?? 'default.png';
$logoutUrl = $config['routes']['logout'];
?>

<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VENDOR_DASHBOARD | 管理後台</title>
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="dist/css/index.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <aside class="main-sidebar sidebar-dark-warning elevation-4">
            <a href="/" class="brand-link text-center">
                <img src="./pages/tables_7/user_image/logo.png" alt="Logo" style="width: 80%; opacity: .9;">
            </a>

            <div class="sidebar">
                <!-- 登入者 -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
                    <div class="image">
                        <img src="./pages/tables_7/user_image/<?= $userAvatar; ?>"
                            class="img-circle elevation-2" alt="User">
                    </div>
                    <div class="info">
                        <span class="user-name">
                            <a href="#" class="text-white ml-2"><?= $userName; ?></a>
                        </span>
                        <form action="<?= $logoutUrl ?>" method="post" class="d-inline">
                            <button type="submit"
                                    class="btn btn-outline-light logout-btn border-0"
                                    title="登出">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- 側邊攔選單 -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                        <?php
                        foreach ($menuItems as $item): ?>
                            <li class="nav-item">
                                <a href="#" class="nav-link"><i class="nav-icon fas fa-<?= $item['icon'] ?>"></i>
                                    <p><?= $item['label'] ?><i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= $item['link'] ?>" class="nav-link"><i
                                                class="far fa-circle nav-icon"></i>
                                            <p><?= $item['sub'] ?></p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <h1>歡迎回來，<?= $userName; ?>。</h1>
                </div>
            </section>
        </div>
    </div>

    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="dist/js/adminlte.js"></script>
</body>

</html>