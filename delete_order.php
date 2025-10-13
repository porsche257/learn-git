<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];

    // ✅ ตรวจสอบว่ารายการนี้เป็นของผู้ใช้จริงๆ
    $stmt = $pdo->prepare("DELETE FROM orders WHERE id = ? AND user_id = ?");
    $stmt->execute([$order_id, $user_id]);
}

header("Location: profile.php");
exit();
?>
