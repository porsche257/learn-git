<?php
require_once 'config.php';

header('Content-Type: application/json');

// Check if user is admin
if (!isAdmin()) {
    echo json_encode([
        'success' => false,
        'message' => 'Unauthorized access'
    ]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = sanitize($_POST['order_id'] ?? '');
    $newStatus = sanitize($_POST['status'] ?? '');
    
    $allowedStatuses = ['pending', 'processing', 'completed', 'cancelled'];
    
    if (empty($orderId) || !in_array($newStatus, $allowedStatuses)) {
        echo json_encode([
            'success' => false,
            'message' => 'ข้อมูลไม่ถูกต้อง'
        ]);
        exit;
    }
    
    try {
        // Get order details
        $orderSql = "SELECT o.*, u.email, u.name FROM orders o 
                     LEFT JOIN users u ON o.user_id = u.user_id 
                     WHERE o.order_id = :order_id";
        $orderStmt = $conn->prepare($orderSql);
        $orderStmt->execute([':order_id' => $orderId]);
        $order = $orderStmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$order) {
            echo json_encode([
                'success' => false,
                'message' => 'ไม่พบออเดอร์'
            ]);
            exit;
        }
        
        // Update order status
        $updateSql = "UPDATE orders SET status = :status, updated_at = NOW() WHERE order_id = :order_id";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->execute([
            ':status' => $newStatus,
            ':order_id' => $orderId
        ]);
        
        // Update transaction status
        $transStatus = ($newStatus === 'completed') ? 'success' : (($newStatus === 'cancelled') ? 'failed' : 'pending');
        $updateTransSql = "UPDATE transactions SET transaction_status = :status WHERE order_id = :order_id";
        $updateTransStmt = $conn->prepare($updateTransSql);
        $updateTransStmt->execute([
            ':status' => $transStatus,
            ':order_id' => $orderId
        ]);
        
        // Send email notification
        if ($order['email']) {
            $statusTexts = [
                'pending' => 'รอดำเนินการ',
                'processing' => 'กำลังดำเนินการ',
                'completed' => 'เสร็จสิ้น',
                'cancelled' => 'ยกเลิก'
            ];
            
            $emailSubject = "อัปเดตสถานะออเดอร์ #" . $orderId;
            $emailMessage = "
                <h2>อัปเดตสถานะออเดอร์</h2>
                <p>เรียน คุณ{$order['name']}</p>
                <p>สถานะออเดอร์ของคุณได้รับการอัปเดต</p>
                <h3>รายละเอียด:</h3>
                <ul>
                    <li>หมายเลขออเดอร์: {$orderId}</li>
                    <li>สถานะใหม่: <strong>{$statusTexts[$newStatus]}</strong></li>
                    <li>เกม: {$order['game_name']}</li>
                    <li>แพ็กเกจ: {$order['package_name']}</li>
                </ul>
            ";
            
            if ($newStatus === 'completed') {
                $emailMessage .= "<p style='color: #10b981; font-weight: bold;'>✅ ไอเทมของคุณได้ถูกส่งเรียบร้อยแล้ว</p>";
                $emailMessage .= "<p>กรุณาตรวจสอบในเกมของคุณ หากมีปัญหากรุณาติดต่อทีมงาน</p>";
            } elseif ($newStatus === 'cancelled') {
                $emailMessage .= "<p style='color: #ef4444;'>❌ ออเดอร์ของคุณถูกยกเลิก</p>";
                $emailMessage .= "<p>หากมีคำถามกรุณาติดต่อทีมงานของเรา</p>";
            }
            
            $emailMessage .= "<p>ขอบคุณที่ใช้บริการ GameTopUp</p>";
            
            sendEmail($order['email'], $emailSubject, $emailMessage);
        }
        
        // Add points if completed
        if ($newStatus === 'completed' && $order['user_id']) {
            $pointsToAdd = floor($order['price'] * 0.01); // 1% cashback
            $updatePointsSql = "UPDATE users SET points = points + :points WHERE user_id = :user_id";
            $updatePointsStmt = $conn->prepare($updatePointsSql);
            $updatePointsStmt->execute([
                ':points' => $pointsToAdd,
                ':user_id' => $order['user_id']
            ]);
        }
        
        echo json_encode([
            'success' => true,
            'message' => 'อัปเดตสถานะสำเร็จ',
            'new_status' => $newStatus
        ]);
        
    } catch (PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()
        ]);
    }
    
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method'
    ]);
}
?>