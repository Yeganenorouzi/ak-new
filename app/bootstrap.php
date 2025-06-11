<?php
session_start();
require_once "config/config.php";

// اطمینان از اینکه autoload مربوط به Composer به درستی لود شده است
require_once __DIR__ . '/../vendor/autoload.php';

// Check remember me token for auto-login before loading controllers
checkRememberMeToken();

// تابع اتولود برای بارگذاری کلاس‌های داخل `libraries/`
function my__autoload($classes)
{
  $file = __DIR__ . "/libraries/" . $classes . ".php";
  if (file_exists($file)) {
    require_once $file;
  }
}
spl_autoload_register("my__autoload");

/**
 * Check remember me token and auto-login user if valid
 */
function checkRememberMeToken()
{
  // Only check if user is not already logged in and has a remember token
  if (!isset($_SESSION['admin']) && isset($_COOKIE['remember_token'])) {
    try {
      // Create database connection
      $db = new PDO(
        "mysql:host=" . DB__Host . ";dbname=" . DB__NAME . ";charset=utf8mb4",
        DB__USER,
        DB__PASS,
        [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ]
      );

      // Get user by remember token
      $stmt = $db->prepare("SELECT u.* FROM users u 
                           INNER JOIN remember_tokens rt ON u.id = rt.user_id 
                           WHERE rt.token = :token AND rt.expires_at > NOW()");
      $stmt->bindValue(':token', hash('sha256', $_COOKIE['remember_token']));
      $stmt->execute();
      $user = $stmt->fetch();

      if ($user) {
        // Log the user in automatically
        $_SESSION['admin'] = $user->codemelli;
        $_SESSION['user_codemelli'] = $user->codemelli;
        $_SESSION['is_admin'] = $user->admin;
        $_SESSION['name'] = $user->name;
        $_SESSION['id'] = $user->id;

        // Refresh the remember token for security
        $newToken = bin2hex(random_bytes(32));

        // Delete old token
        $stmt = $db->prepare("DELETE FROM remember_tokens WHERE user_id = :user_id");
        $stmt->bindValue(':user_id', $user->id);
        $stmt->execute();

        // Insert new token
        $stmt = $db->prepare("INSERT INTO remember_tokens (user_id, token, expires_at) VALUES (:user_id, :token, :expires_at)");
        $stmt->bindValue(':user_id', $user->id);
        $stmt->bindValue(':token', hash('sha256', $newToken));
        $stmt->bindValue(':expires_at', date('Y-m-d H:i:s', time() + (30 * 24 * 60 * 60)));
        $stmt->execute();

        // Set new cookie
        setcookie('remember_token', $newToken, time() + (30 * 24 * 60 * 60), '/', '', false, true);
      } else {
        // Invalid or expired token, remove it
        setcookie('remember_token', '', time() - 3600, '/', '', false, true);
      }
    } catch (Exception $e) {
      // Log error and continue
      error_log("Remember token check error: " . $e->getMessage());
      // Remove invalid cookie
      setcookie('remember_token', '', time() - 3600, '/', '', false, true);
    }
  }
}
