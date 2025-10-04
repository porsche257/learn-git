<?php
require_once 'config.php';

// Check if user is admin
if (!isAdmin()) {
    redirect('login.html');
    exit;
}

// Get statistics
$stats = [];

// Total orders
$orderSql = "SELECT COUNT(*) as total FROM orders";
$orderStmt = $conn->query($orderSql);
$stats['total_orders'] = $orderStmt->fetch(PDO::FETCH_ASSOC)['total'];

// Total revenue
$revenueSql = "SELECT SUM(price) as total FROM orders WHERE status = 'completed'";
$revenueStmt = $conn->query($revenueSql);
$stats['total_revenue'] = $revenueStmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

// Total users
$userSql = "SELECT COUNT(*) as total FROM users";
$userStmt = $conn->query($userSql);
$stats['total_users'] = $userStmt->fetch(PDO::FETCH_ASSOC)['total'];

// Pending orders
$pendingSql = "SELECT COUNT(*) as total FROM orders WHERE status = 'pending'";
$pendingStmt = $conn->query($pendingSql);
$stats['pending_orders'] = $pendingStmt->fetch(PDO::FETCH_ASSOC)['total'];

// Today's orders
$todaySql = "SELECT COUNT(*) as total FROM orders WHERE DATE(created_at) = CURDATE()";
$todayStmt = $conn->query($todaySql);
$stats['today_orders'] = $todayStmt->fetch(PDO::FETCH_ASSOC)['total'];

// Today's revenue
$todayRevenueSql = "SELECT SUM(price) as total FROM orders WHERE DATE(created_at) = CURDATE() AND status = 'completed'";
$todayRevenueStmt = $conn->query($todayRevenueSql);
$stats['today_revenue'] = $todayRevenueStmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - GameTopUp</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .admin-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 80px 20px 20px;
        }
        
        .admin-header {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 2px solid rgba(255, 255, 255, 0.1);
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 1.5rem;
            border: 2px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            border-color: rgba(236, 72, 153, 0.5);
        }
        
        .stat-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        
        .stat-value {
            font-size: 2rem;
            font-weight: bold;
            color: #10b981;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            opacity: 0.8;
        }
        
        .admin-section {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 2px solid rgba(255, 255, 255, 0.1);
        }
        
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .data-table th,
        .data-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .data-table th {
            background: rgba(236, 72, 153, 0.2);
            font-weight: bold;
        }
        
        .data-table tr:hover {
            background: rgba(255, 255, 255, 0.05);
        }
        
        .status-badge {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-size: 0.85rem;
            font-weight: bold;
        }
        
        .status-pending {
            background: #f59e0b;
        }
        
        .status-processing {
            background: #3b82f6;
        }
        
        .status-completed {
            background: #10b981;
        }
        
        .status-cancelled {
            background: #ef4444;
        }
        
        .action-btn {
            background: linear-gradient(135deg, #8b5cf6, #3b82f6);
            color: #fff;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.9rem;
            margin-right: 0.5rem;
            transition: all 0.3s;
        }
        
        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(139, 92, 246, 0.4);
        }
        
        .action-btn.danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="logo">🎮 GameTopUp Admin</div>
            <ul class="nav-menu">
                <li><a href="admin.php" class="active">Dashboard</a></li>
                <li><a href="admin_orders.php">จัดการออเดอร์</a></li>
                <li><a href="admin_users.php">จัดการผู้ใช้</a></li>
                <li><a href="index.html">กลับหน้าหลัก</a></li>
                <li><a href="logout.php" class="btn-login">ออกจากระบบ</a></li>
            </ul>
        </div>
    </nav>

    <div class="admin-container">
        <div class="admin-header">
            <h1>🎯 Admin Dashboard</h1>
            <p>ยินดีต้อนรับ, <?php echo $_SESSION['user_name']; ?></p>
        </div>

        <!-- Statistics -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">📦</div>
                <div class="stat-value"><?php echo number_format($stats['total_orders']); ?></div>
                <div class="stat-label">ออเดอร์ทั้งหมด</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">💰</div>
                <div class="stat-value">฿<?php echo number_format($stats['total_revenue'], 2); ?></div>
                <div class="stat-label">รายได้ทั้งหมด</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">👥</div>
                <div class="stat-value"><?php echo number_format($stats['total_users']); ?></div>
                <div class="stat-label">สมาชิกทั้งหมด</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">⏳</div>
                <div class="stat-value"><?php echo number_format($stats['pending_orders']); ?></div>
                <div class="stat-label">ออเดอร์รอดำเนินการ</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">📅</div>
                <div class="stat-value"><?php echo number_format($stats['today_orders']); ?></div>
                <div class="stat-label">ออเดอร์วันนี้</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">💵</div>
                <div class="stat-value">฿<?php echo number_format($stats['today_revenue'], 2); ?></div>
                <div class="stat-label">รายได้วันนี้</div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="admin-section">
            <div class="section-header">
                <h2>📋 ออเดอร์ล่าสุด</h2>
                <a href="admin_orders.php" class="action-btn">ดูทั้งหมด</a>
            </div>

            <div style="overflow-x: auto;">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>หมายเลขออเดอร์</th>
                            <th>เกม</th>
                            <th>แพ็กเกจ</th>
                            <th>ราคา</th>
                            <th>ช่องทางชำระเงิน</th>
                            <th>สถานะ</th>
                            <th>วันที่</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $recentSql = "SELECT * FROM orders ORDER BY created_at DESC LIMIT 10";
                        $recentStmt = $conn->query($recentSql);
                        
                        while ($order = $recentStmt->fetch(PDO::FETCH_ASSOC)) {
                            $statusClass = 'status-' . $order['status'];
                            $statusText = [
                                'pending' => 'รอดำเนินการ',
                                'processing' => 'กำลังดำเนินการ',
                                'completed' => 'เสร็จสิ้น',
                                'cancelled' => 'ยกเลิก'
                            ][$order['status']];
                            
                            echo "<tr>
                                <td>{$order['order_id']}</td>
                                <td>{$order['game_name']}</td>
                                <td>{$order['package_name']}</td>
                                <td>฿" . number_format($order['price'], 2) . "</td>
                                <td>{$order['payment_method']}</td>
                                <td><span class='status-badge {$statusClass}'>{$statusText}</span></td>
                                <td>" . date('d/m/Y H:i', strtotime($order['created_at'])) . "</td>
                                <td>
                                    <button class='action-btn' onclick=\"viewOrder('{$order['order_id']}')\">ดู</button>
                                    <button class='action-btn' onclick=\"updateStatus('{$order['order_id']}')\">อัปเดต</button>
                                </td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="admin-section">
            <h2>⚡ การดำเนินการด่วน</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-top: 1rem;">
                <button class="action-btn" onclick="location.href='admin_orders.php?status=pending'">
                    ตรวจสอบออเดอร์รอดำเนินการ
                </button>
                <button class="action-btn" onclick="location.href='admin_users.php'">
                    จัดการผู้ใช้
                </button>
                <button class="action-btn" onclick="location.href='admin_reports.php'">
                    ดูรายงาน
                </button>
                <button class="action-btn" onclick="location.href='admin_settings.php'">
                    ตั้งค่าระบบ
                </button>
            </div>
        </div>
    </div>

    <script>
        function viewOrder(orderId) {
            window.location.href = 'admin_order_detail.php?id=' + orderId;
        }

        function updateStatus(orderId) {
            const newStatus = prompt('เลือกสถานะใหม่:\npending - รอดำเนินการ\nprocessing - กำลังดำเนินการ\ncompleted - เสร็จสิ้น\ncancelled - ยกเลิก');
            
            if (newStatus && ['pending', 'processing', 'completed', 'cancelled'].includes(newStatus)) {
                fetch('update_order_status.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'order_id=' + orderId + '&status=' + newStatus
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('อัปเดตสถานะสำเร็จ');
                        location.reload();
                    } else {
                        alert('เกิดข้อผิดพลาด: ' + data.message);
                    }
                });
            }
        }
    </script>
</body>
</html>