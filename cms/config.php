<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'csa_xcon_cms');
define('DB_USER', 'root');
define('DB_PASS', '');

// Site Configuration
define('SITE_URL', 'http://localhost/csa-xcon');
define('CMS_URL', SITE_URL . '/cms');
define('UPLOAD_DIR', __DIR__ . '/uploads/');
define('UPLOAD_URL', CMS_URL . '/uploads/');

// Security
define('SECRET_KEY', 'your-secret-key-change-this-in-production');
define('SESSION_LIFETIME', 3600); // 1 hour

// Timezone
date_default_timezone_set('UTC');

// Error Reporting (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database Connection
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
