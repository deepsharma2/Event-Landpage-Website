<?php
require_once 'config.php';

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);

    if (empty($username) || empty($password)) {
        header('Location: login.php?error=empty');
        exit;
    }

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Login successful
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['login_time'] = time();

            // Log activity
            $stmt = $pdo->prepare("INSERT INTO activity_log (user_id, action, description) VALUES (?, ?, ?)");
            $stmt->execute([$user['id'], 'login', 'User logged in']);

            // Set remember me cookie
            if ($remember) {
                $token = bin2hex(random_bytes(32));
                setcookie('remember_token', $token, time() + (86400 * 30), '/'); // 30 days
            }

            header('Location: dashboard.php');
            exit;
        } else {
            header('Location: login.php?error=invalid');
            exit;
        }
    } catch (PDOException $e) {
        error_log("Login error: " . $e->getMessage());
        header('Location: login.php?error=system');
        exit;
    }
}

// Handle logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    // Log activity
    if (isset($_SESSION['user_id'])) {
        $stmt = $pdo->prepare("INSERT INTO activity_log (user_id, action, description) VALUES (?, ?, ?)");
        $stmt->execute([$_SESSION['user_id'], 'logout', 'User logged out']);
    }

    session_destroy();
    setcookie('remember_token', '', time() - 3600, '/');
    header('Location: login.php?success=logout');
    exit;
}

// Check if user is logged in
function isLoggedIn() {
    if (!isset($_SESSION['user_id'])) {
        return false;
    }

    // Check session timeout
    if (isset($_SESSION['login_time']) && (time() - $_SESSION['login_time'] > SESSION_LIFETIME)) {
        session_destroy();
        return false;
    }

    // Update last activity time
    $_SESSION['login_time'] = time();
    return true;
}

// Require login for protected pages
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: login.php?error=session');
        exit;
    }
}

// Check if user has specific role
function hasRole($role) {
    return isset($_SESSION['role']) && $_SESSION['role'] === $role;
}

// Redirect if already logged in
if (isLoggedIn() && basename($_SERVER['PHP_SELF']) === 'login.php') {
    header('Location: dashboard.php');
    exit;
}
?>
