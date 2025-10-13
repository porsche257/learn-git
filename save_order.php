<?php
session_start();
require 'config.php';
$conn = new mysqli("localhost", "root", "", "kakai_db");

// ตรวจสอบการล็อกอิน
if (!isset($_SESSION['user_id'])) {
    echo "
    <script>
        alert('กรุณาเข้าสู่ระบบก่อนทำรายการเติมเกม');
        window.location.href = 'login.php';
    </script>
    ";
    exit();
}


if ($conn->connect_error) {
    die("เชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
}

// รับค่าจากฟอร์ม
$user_id = $_SESSION['user_id'];
$game_name = $_POST['game_name']; // 👈 เพิ่มบรรทัดนี้
$uid = $_POST['uid'];
$username = $_POST['username'];
$package = $_POST['package'];
$payment = $_POST['payment'];

// ป้องกัน SQL Injection
$game_name = $conn->real_escape_string($game_name);
$uid = $conn->real_escape_string($uid);
$username = $conn->real_escape_string($username);
$package = $conn->real_escape_string($package);
$payment = $conn->real_escape_string($payment);

// บันทึกข้อมูลลงฐานข้อมูล
$sql = "INSERT INTO orders (user_id, game_name, uid, username, package, payment)
        VALUES ('$user_id', '$game_name', '$uid', '$username', '$package', '$payment')";

if ($conn->query($sql) === TRUE) {
    echo "
    <script>
        alert('✅ บันทึกคำสั่งซื้อเรียบร้อยแล้ว!');
        window.location.href = 'index.php';
    </script>
    ";
} else {
    echo 'เกิดข้อผิดพลาด: ' . $conn->error;
}

$conn->close();
?>
