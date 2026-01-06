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
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <style>
        .preloader {
            background-color: #263038;
        }

        .loader {
            width: 50px;
            height: 50px;
            border: 5px solid #fff;
            border-bottom-color: transparent;
            border-radius: 50%;
            display: inline-block;
            animation: rotation 1s linear infinite;
        }

        @keyframes rotation {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="preloader flex-column justify-content-center align-items-center">
            <span class="loader"></span>
        </div>

        <aside class="main-sidebar sidebar-dark-warning elevation-4">
            <a href="#" class="brand-link text-center">
                <img src="./pages/tables_7/user_image/logo.png" alt="Logo" style="width: 80%; opacity: .9;">
            </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="./pages/tables_7/user_image/<?= $_SESSION["avatar"]; ?>"
                            class="img-circle elevation-2" alt="User">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block ml-3"><?= $_SESSION["user"]; ?></a>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                        <?php
                        $menuItems = [
                            ['icon' => 'user-tie', 'label' => '員工列表', 'link' => './pages/tables_7/employee.php', 'sub' => '員工管理'],
                            ['icon' => 'users', 'label' => '會員列表', 'link' => './pages/tables_7/member.php', 'sub' => '會員管理'],
                            ['icon' => 'utensils', 'label' => '食物管理', 'link' => './pages/table_33/fooddata.php', 'sub' => '食物列表'],
                            ['icon' => 'box', 'label' => '商品管理', 'link' => './pages/table_Tung/product1.php', 'sub' => '商品檢視'],
                            ['icon' => 'video', 'label' => '影音管理', 'link' => './pages/tables_Luna/mainpageajax.php', 'sub' => '影音列表'],
                            ['icon' => 'shopping-cart', 'label' => '訂單管理', 'link' => './pages/table_AYun/realItem_order.php', 'sub' => '商品訂單'],
                        ];
                        foreach ($menuItems as $item): ?>
                            <li class="nav-item">
                                <a href="#" class="nav-link"><i class="nav-icon fas fa-<?= $item['icon'] ?>"></i>
                                    <p><?= $item['label'] ?><i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item"><a href="<?= $item['link'] ?>" class="nav-link"><i
                                                class="far fa-circle nav-icon"></i>
                                            <p><?= $item['sub'] ?></p>
                                        </a></li>
                                </ul>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
                <a href="./pages/login/logOut.php" class="btn btn-danger btn-block mt-4">登出</a>
            </div>
        </aside>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <h1>控制台首頁</h1>
                </div>
            </section>
            <section class="content">
            </section>
        </div>
    </div>

    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="dist/js/adminlte.js"></script>
</body>

</html>