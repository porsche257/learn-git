<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'gametopup_db');

// Create database connection
try {
    $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("SET NAMES 'utf8'");
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Site Configuration
define('SITE_NAME', 'GameTopUp');
define('SITE_URL', 'http://localhost/gametopup');
define('ADMIN_EMAIL', 'admin@gametopup.com');

// Session Configuration
session_start();

// Timezone
date_default_timezone_set('Asia/Bangkok');

// Function to sanitize input
function sanitize($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Function to generate order ID
function generateOrderID() {
    return 'ORD' . date('Ymd') . rand(1000, 9999);
}

// Function to send email
function sendEmail($to, $subject, $message) {
    $headers = "From: " . ADMIN_EMAIL . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    return mail($to, $subject, $message, $headers);
}

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Check if user is admin
function isAdmin() {
    return isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;
}

// Redirect function
function redirect($url) {
    header("Location: " . $url);
    exit();
}
?>