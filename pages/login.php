<?php
require_once __DIR__ . '/../bootstrap.php';

use App\Core\Database;

$error = null;

/*
|--------------------------------------------------------------------------
| 入口：只負責流程控制
|--------------------------------------------------------------------------
*/
if (isLoginRequest()) {
    $error = handleLogin();
}

/*
|--------------------------------------------------------------------------
| 判斷是否為登入請求
|--------------------------------------------------------------------------
*/
function isLoginRequest(): bool
{
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

/*
|--------------------------------------------------------------------------
| 處理登入流程
|--------------------------------------------------------------------------
*/
function handleLogin(): ?string
{
    $email    = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (!$email || !$password) {
        return '請輸入帳號與密碼';
    }

    $user = findUserByEmail($email);

    if (!$user || !verifyPassword($password, $user['password'])) {
        return '帳號或密碼錯誤';
    }

    loginUser($user);

    if (shouldRemember()) {
        rememberUser($user['email']);
    }

    redirectHome();

    return null; // 理論上不會跑到這
}

/*
|--------------------------------------------------------------------------
| 依 Email 查詢使用者
|--------------------------------------------------------------------------
*/
function findUserByEmail(string $email): ?array
{
    $pdo = Database::getInstance();

    $stmt = $pdo->prepare(
        'SELECT name, avatarname, email, password
         FROM employee
         WHERE email = :email
         LIMIT 1'
    );

    $stmt->execute(['email' => $email]);

    $user = $stmt->fetch();

    return $user ?: null;
}

/*
|--------------------------------------------------------------------------
| 驗證密碼（目前為明文）
|--------------------------------------------------------------------------
*/
function verifyPassword(string $input, string $hash): bool
{
    return password_verify($input, $hash);
}


/*
|--------------------------------------------------------------------------
| 建立登入 Session
|--------------------------------------------------------------------------
*/
function loginUser(array $user): void
{
    session_regenerate_id(true);

    $_SESSION['email']  = $user['email'];
    $_SESSION['name']   = $user['name'];
    $_SESSION['avatarname'] = $user['avatarname'];
}

/*
|--------------------------------------------------------------------------
| 是否勾選 Remember Me
|--------------------------------------------------------------------------
*/
function shouldRemember(): bool
{
    return !empty($_POST['remember']);
}

/*
|--------------------------------------------------------------------------
| 建立 Remember Me Token
|--------------------------------------------------------------------------
*/
function rememberUser(string $email): void
{
    $pdo = Database::getInstance();

    // 產生 token
    $token = bin2hex(random_bytes(32));
    $hash  = hash('sha256', $token);

    // 30 天
    $expiresAt = date('Y-m-d H:i:s', time() + 60 * 60 * 24 * 30);

    // 存 DB
    $stmt = $pdo->prepare(
        "INSERT INTO remember_tokens (user_email, token_hash, expires_at)
         VALUES (:email, :hash, :expires)"
    );
    $stmt->execute([
        'email'   => $email,
        'hash'    => $hash,
        'expires' => $expiresAt
    ]);

    // 存 Cookie
    setcookie(
        'remember_token',
        $token,
        [
            'expires'  => time() + 60 * 60 * 24 * 30,
            'path'     => '/',
            'httponly' => true,
            'secure'   => false, // HTTPS 才 true
            'samesite' => 'Lax' // 同站 + 正常導覽
        ]
    );
}

/*
|--------------------------------------------------------------------------
| 導向首頁
|--------------------------------------------------------------------------
*/
function redirectHome(): void
{
    global $config;

    header('Location: ' . $config['routes']['home']);
    exit;
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

    <!-- AdminLTE -->
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

                <form method="post" autocomplete="off">

                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
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
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember" value="1">
                                <label for="remember">記住我</label>
                            </div>
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