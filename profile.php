<?php
session_start();
require 'config.php';

// ✅ ตรวจสอบว่าผู้ใช้ล็อกอินหรือยัง
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// ✅ ดึงข้อมูลผู้ใช้
$stmt = $pdo->prepare("SELECT username, email FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// ✅ ดึงข้อมูลคำสั่งซื้อ
$stmt_orders = $pdo->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY id DESC");
$stmt_orders->execute([$user_id]);
$orders = $stmt_orders->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>โปรไฟล์ของฉัน | PickTopUp</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>
    <?php include 'nav.php'; ?>

    <div class="profile-container">
        <h1>👤 โปรไฟล์ของฉัน</h1>

        <div class="user-info">
            <p><strong>ชื่อผู้ใช้:</strong> <?= htmlspecialchars($user['username']) ?></p>
            <p><strong>อีเมล:</strong> <?= htmlspecialchars($user['email']) ?></p>
        </div>

        <h2 style="color:#ff8fff;">📜 ประวัติการสั่งซื้อ</h2>

        <?php if (count($orders) > 0): ?>
            <table class="order-table">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>ชื่อเกม</th>
                        <th>UID</th>
                        <th>ชื่อในเกม</th>
                        <th>แพ็กเกจ</th>
                        <th>ช่องทางชำระเงิน</th>
                        <th>วันที่สั่งซื้อ</th>
                        <th>จัดการ</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $index => $order): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($order['game_name']) ?></td>
                            <td><?= htmlspecialchars($order['uid']) ?></td>
                            <td><?= htmlspecialchars($order['username']) ?></td>
                            <td><?= htmlspecialchars($order['package']) ?></td>
                            <td><?= htmlspecialchars($order['payment']) ?></td>
                            <td><?= isset($order['created_at']) ? date("d/m/Y H:i", strtotime($order['created_at'])) : '-' ?></td>
                            <td>
                                <form method="POST" action="delete_order.php" onsubmit="return confirm('ยืนยันการลบรายการนี้หรือไม่?');">
                                    <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                    <button type="submit">ลบ</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-orders">ยังไม่มีประวัติการสั่งซื้อ</p>
        <?php endif; ?>

        <div style="text-align:center;">
            <a href="index.php" class="back-btn">กลับหน้าหลัก</a>
        </div>
    </div>

    <script src="js/script.js"></script>
    <script src="js/particles.js"></script>
</body>
</html>
