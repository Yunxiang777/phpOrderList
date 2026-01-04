<?php
require_once __DIR__ . '/../../config/config.php';
// /pages/auth/auth.php

// session_start();

// if (!isset($_SESSION['email'])) {
//     header('Location: /VENDOR_DASHBOARD/pages/login/login.php');
//     exit;
// }


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
header('Location: ' . LOGIN_PATH);
exit;
