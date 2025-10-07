<?php
session_start();
require 'config.php'; // เชื่อมต่อฐานข้อมูล PDO

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับค่าจากฟอร์มและ sanitize
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone'] ?? '');
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    // ตรวจสอบค่าที่จำเป็น
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $_SESSION['error'] = "กรุณากรอกข้อมูลให้ครบถ้วน!";
        header("Location: contact.php");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "กรุณากรอกอีเมลให้ถูกต้อง!";
        header("Location: contact.php");
        exit();
    }

    try {
        // Prepare statement
        $stmt = $pdo->prepare("INSERT INTO contact (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $phone, $subject, $message]);

        $_SESSION['success'] = "ส่งข้อความเรียบร้อยแล้ว ทีมงานจะติดต่อกลับเร็วที่สุด!";
        header("Location: contact.php");
        exit();

    } catch (PDOException $e) {
        $_SESSION['error'] = "เกิดข้อผิดพลาด: " . $e->getMessage();
        header("Location: index.php");
        exit();
    }

} else {
    // หากเข้าหน้านี้โดยตรง
    header("Location: contact.php");
    exit();
}
