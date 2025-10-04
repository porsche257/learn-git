<?php
require_once 'config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $orderId = sanitize($_GET['order_id'] ?? '');
    
    if (empty($orderId)) {
        echo json_encode([
            'success' => false,
            'message' => 'กรุณาระบุหมายเลขออเดอร์'
        ]);
        exit;
    }
    
    try {
        $sql = "SELECT * FROM orders WHERE order_id = :order_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':order_id' => $orderId]);
        
        $order = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($order) {
            echo json_encode([
                'success' => true,
                'order' => $order
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'ไม่พบหมายเลขออเดอร์นี้'
            ]);
        }
        
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