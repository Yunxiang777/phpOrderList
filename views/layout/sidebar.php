<?php
/**
 * Sidebar 側邊欄共用元件
 */
?>

<aside class="main-sidebar sidebar-dark-warning elevation-4">
    <a href="/" class="brand-link text-center">
        <img src="./pages/tables_7/user_image/logo.png" alt="Logo" style="width: 80%; opacity: .9;">
    </a>

    <div class="sidebar">
        <!-- 登入者 -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                <img src="./pages/tables_7/user_image/<?= htmlspecialchars($_SESSION['avatarname']) ?>"
                     class="img-circle elevation-2" alt="User">
            </div>
            <div class="info d-flex align-items-center">
                <span class="user-name">
                    <a href="#" class="text-white ml-2">
                        <?= htmlspecialchars($_SESSION["name"]) ?>
                    </a>
                </span>

                <form action="<?= htmlspecialchars($config['routes']['logout']) ?>" method="post" class="ml-2">
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
            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu">

                <?php foreach ($config['menuItems'] as $item): ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-<?= htmlspecialchars($item['icon']) ?>"></i>
                            <p>
                                <?= htmlspecialchars($item['label']) ?>
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= htmlspecialchars($item['link']) ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p><?= htmlspecialchars($item['sub']) ?></p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endforeach; ?>

            </ul>
        </nav>
    </div>
</aside>