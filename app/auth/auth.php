<?php
/* Remember Me Cookie */
if (isset($_COOKIE['remember_token'])) {

    $tokenHash = hash('sha256', $_COOKIE['remember_token']);

    $stmt = $pdo->prepare(
        "SELECT user_email FROM remember_tokens
         WHERE token_hash = ? AND expires_at > NOW()"
    );
    $stmt->execute([$tokenHash]);
    $row = $stmt->fetch();

    if ($row) {
        // 重建 Session
        session_regenerate_id(true);

        $_SESSION['email'] = $row['user_email'];

        return;
    }

    // Token 無效 → 清 Cookie
    setcookie('remember_token', '', time() - 3600, '/');
}

/* 全部失敗 → 去登入頁 */
header('Location: ' . $config['routes']['login']);
exit;
