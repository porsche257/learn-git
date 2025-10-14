<?php
session_start();
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        $_SESSION['error'] = "รหัสผ่านใหม่ไม่ตรงกัน";
        header("Location: login.php");
        exit();
    }

    if (strlen($new_password) < 6) {
        $_SESSION['error'] = "รหัสผ่านใหม่ต้องมีอย่างน้อย 6 ตัวอักษร";
        header("Location: login.php");
        exit();
    }

    // ตรวจสอบว่าอีเมลมีอยู่ในระบบไหม
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        $_SESSION['error'] = "ไม่พบอีเมลนี้ในระบบ";
        header("Location: login.php");
        exit();
    }

    // ✅ อัปเดตรหัสผ่านใหม่
    $hashed = password_hash($new_password, PASSWORD_DEFAULT);
    $update = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
    $update->execute([$hashed, $email]);

    $_SESSION['error'] = "เปลี่ยนรหัสผ่านเรียบร้อย ✅ กรุณาเข้าสู่ระบบอีกครั้ง";
    header("Location: login.php");
    exit();
}
?>
