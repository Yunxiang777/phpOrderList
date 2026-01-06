<?php
require_once __DIR__ . '/../bootstrap.php';

use App\Core\Database;

// 開啟 Session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($email && $password) {
        $pdo = Database::getInstance();

        $stmt = $pdo->prepare(
            'SELECT name, avatarname, email, password 
             FROM employee 
             WHERE email = :email 
             LIMIT 1'
        );
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        // ⚠️ 若未加密，先用明文（之後我可以幫你升級 password_hash）
        if ($user && $password === $user['password']) {
            session_regenerate_id(true);

            $_SESSION['email']  = $user['email'];
            $_SESSION['user']   = $user['name'];
            $_SESSION['avatar'] = $user['avatarname'];

            header('Location: ' . $config['routes']['home']);
            exit;
        }

        $error = '帳號或密碼錯誤';
    } else {
        $error = '請輸入帳號與密碼';
    }
}
?>
<!DOCTYPE html>
<html lang="zh-Hant">

<head>
    <meta charset="UTF-8">
    <title>員工登入</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">

        <div class="login-logo">
            <b>Vendor</b> Dashboard
        </div>

        <div class="card">
            <div class="card-body login-card-body">

                <p class="login-box-msg">請登入你的帳號</p>

                <?php if ($error): ?>
                    <div class="alert alert-danger text-center">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <form method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="email" class="form-control" placeholder="Email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <!-- 之後可加 remember me -->
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                登入
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>

</html>