<?php
session_start();
require 'config.php';

$minLength = 6;

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validation
    if (empty($username)) {
        $_SESSION['error'] = "กรุณากรอกชื่อผู้ใช้งาน";
        header("Location: login.php");
        exit;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "กรุณากรอกอีเมลให้ถูกต้อง";
        header("Location: login.php");
        exit;
    } else if (strlen($password) < $minLength) {
        $_SESSION['error'] = "รหัสผ่านต้องมีอย่างน้อย 6 ตัวอักษร";
        header("Location: login.php");
        exit;
    } else if ($password !== $confirmPassword) {
        $_SESSION['error'] = "รหัสผ่านไม่ตรงกัน";
        header("Location: login.php");
        exit;
    }

    // Check duplicate
    $checkUsername = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
    $checkUsername->execute([$username]);
    $userNameExists = $checkUsername->fetchColumn();

    $checkEmail = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    $checkEmail->execute([$email]);
    $userEmailExists = $checkEmail->fetchColumn();

    if ($userNameExists) {
        $_SESSION['error'] = "ชื่อผู้ใช้งานนี้มีอยู่แล้ว";
        header("Location: login.php");
        exit;
    } else if ($userEmailExists) {
        $_SESSION['error'] = "อีเมลนี้มีอยู่แล้ว";
        header("Location: login.php");
        exit;
    }

    // Insert user
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $hashedPassword]);

        $_SESSION['success'] = "สมัครสมาชิกสำเร็จ!";
        header("Location: login.php");
        exit;
    } catch (PDOException $e) {
        $_SESSION['error'] = "เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง";
        header("Location: login.php");
        exit;
    }
}
?>
