<?php

use App\Core\Database;

/*
|--------------------------------------------------------------------------
| 若已經有登入 Session，直接放行
|--------------------------------------------------------------------------
*/

if (!empty($_SESSION['email'])) {
    return;
}

/*
|--------------------------------------------------------------------------
| 未登入 → 嘗試 Remember Me 自動登入
|--------------------------------------------------------------------------
*/
if (! empty($_COOKIE['remember_token'])) {

    $email = validateRememberToken();

    if ($email !== null) {
        loginByRememberToken($email);
        return;
    }

    // Token 無效 → 清除 Cookie
    clearRememberCookie();
}

/* 失敗 → 去登入頁 */
header('Location: ' . $config['routes']['login']);
exit;

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
*/

/**
 * 驗證 Remember Token 是否有效
 * 有效 → 回傳 email
 * 無效 → 回傳 null
 */
function validateRememberToken(): ?string
{
    $token = $_COOKIE['remember_token'];
    $tokenHash = hash('sha256', $token);

    $pdo = Database::getInstance();
    $stmt = $pdo->prepare(
        "SELECT user_email
         FROM remember_tokens
         WHERE token_hash = :hash
           AND expires_at > NOW()
         LIMIT 1"
    );
    $stmt->execute([
        'hash' => $tokenHash
    ]);

    $row = $stmt->fetch();

    return $row['user_email'] ?? null;
}

/**
 * 使用 Remember Token 登入
 * - 重建 Session
 * - 設定登入狀態
 * - Token Rotation
 */
function loginByRememberToken(string $email): void
{
    // 防 Session Fixation
    session_regenerate_id(true);

    // 建立登入狀態
    $_SESSION['email'] = $email;

    // Token Rotation（重要）
    rotateRememberToken();
}

/**
 * Remember Token Rotation
 * - 更新資料庫 token_hash
 * - 更新 Cookie
 */
function rotateRememberToken(): void
{
    $oldToken = $_COOKIE['remember_token'];
    $oldHash  = hash('sha256', $oldToken);

    $newToken = bin2hex(random_bytes(32));
    $newHash  = hash('sha256', $newToken);

    $pdo = Database::getInstance();
    $stmt = $pdo->prepare(
        "UPDATE remember_tokens
         SET token_hash = :new_hash,
             expires_at = DATE_ADD(NOW(), INTERVAL 30 DAY)
         WHERE token_hash = :old_hash"
    );
    $stmt->execute([
        'new_hash' => $newHash,
        'old_hash' => $oldHash
    ]);

    setcookie(
        'remember_token',
        $newToken,
        [
            'expires'  => time() + 60 * 60 * 24 * 30, // 30 天
            'path'     => '/',
            'httponly' => true,   // 防 XSS
            'secure'   => false,  // HTTPS 才設 true
            'samesite' => 'Lax'
        ]
    );
}

/**
 * 清除 Remember Me Cookie
 */
function clearRememberCookie(): void
{
    setcookie('remember_token', '', time() - 3600, '/');
}
