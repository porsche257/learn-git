<?php
require_once 'config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Get POST data
    $uid = sanitize($_POST['uid'] ?? '');
    $server = sanitize($_POST['server'] ?? '');
    $username = sanitize($_POST['username'] ?? '');
    $game = sanitize($_POST['game'] ?? '');
    $package = sanitize($_POST['package'] ?? '');
    $price = floatval($_POST['price'] ?? 0);
    $payment = sanitize($_POST['payment'] ?? '');
    
    // Validate required fields
    if (empty($uid) || empty($game) || empty($package) || empty($payment)) {
        echo json_encode([
            'success' => false,
            'message' => 'กรุณากรอกข้อมูลให้ครบถ้วน'
        ]);
        exit;
    }
    
    // Handle file upload (payment slip)
    $slipPath = null;
    if (isset($_FILES['slip']) && $_FILES['slip']['error'] === 0) {
        $uploadDir = 'uploads/slips/';
        
        // Create directory if not exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        $fileExt = pathinfo($_FILES['slip']['name'], PATHINFO_EXTENSION);
        $fileName = uniqid() . '_' . time() . '.' . $fileExt;
        $targetPath = $uploadDir . $fileName;
        
        // Validate file type
        $allowedTypes = ['jpg', 'jpeg', 'png', 'pdf'];
        if (!in_array(strtolower($fileExt), $allowedTypes)) {
            echo json_encode([
                'success' => false,
                'message' => 'รองรับเฉพาะไฟล์ JPG, PNG, PDF เท่านั้น'
            ]);
            exit;
        }
        
        // Validate file size (max 5MB)
        if ($_FILES['slip']['size'] > 5 * 1024 * 1024) {
            echo json_encode([
                'success' => false,
                'message' => 'ไฟล์มีขนาดใหญ่เกิน 5MB'
            ]);
            exit;
        }
        
        if (move_uploaded_file($_FILES['slip']['tmp_name'], $targetPath)) {
            $slipPath = $targetPath;
        }
    }
    
    try {
        // Generate order ID
        $orderId = generateOrderID();
        
        // Get user ID if logged in
        $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
        
        // Insert order into database
        $sql = "INSERT INTO orders (order_id, user_id, game_name, game_uid, server, package_name, package_amount, price, payment_method, payment_slip, status) 
                VALUES (:order_id, :user_id, :game_name, :game_uid, :server, :package_name, :package_amount, :price, :payment_method, :payment_slip, 'pending')";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':order_id' => $orderId,
            ':user_id' => $userId,
            ':game_name' => $game,
            ':game_uid' => $uid,
            ':server' => $server,
            ':package_name' => $package,
            ':package_amount' => $package,
            ':price' => $price,
            ':payment_method' => $payment,
            ':payment_slip' => $slipPath
        ]);
        
        // Insert transaction record
        $sqlTrans = "INSERT INTO transactions (order_id, user_id, amount, payment_method, transaction_status) 
                     VALUES (:order_id, :user_id, :amount, :payment_method, 'pending')";
        
        $stmtTrans = $conn->prepare($sqlTrans);
        $stmtTrans->execute([
            ':order_id' => $orderId,
            ':user_id' => $userId,
            ':amount' => $price,
            ':payment_method' => $payment
        ]);
        
        // Send confirmation email (if user is logged in)
        if ($userId) {
            $userSql = "SELECT email, name FROM users WHERE user_id = :user_id";
            $userStmt = $conn->prepare($userSql);
            $userStmt->execute([':user_id' => $userId]);
            $user = $userStmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user) {
                $emailSubject = "ยืนยันคำสั่งซื้อ #" . $orderId;
                $emailMessage = "
                    <h2>ขอบคุณที่ใช้บริการ GameTopUp</h2>
                    <p>เรียน คุณ{$user['name']}</p>
                    <p>เราได้รับคำสั่งซื้อของคุณเรียบร้อยแล้ว</p>
                    <h3>รายละเอียดคำสั่งซื้อ:</h3>
                    <ul>
                        <li>หมายเลขออเดอร์: {$orderId}</li>
                        <li>เกม: {$game}</li>
                        <li>แพ็กเกจ: {$package}</li>
                        <li>ราคา: {$price} บาท</li>
                        <li>ช่องทางชำระเงิน: {$payment}</li>
                    </ul>
                    <p>ระบบกำลังตรวจสอบการชำระเงิน ไอเทมจะถูกส่งภายใน 5-30 นาที</p>
                    <p>ขอบคุณที่ใช้บริการ</p>
                ";
                sendEmail($user['email'], $emailSubject, $emailMessage);
            }
        }
        
        // Return success response
        echo json_encode([
            'success' => true,
            'message' => 'สั่งซื้อสำเร็จ',
            'order_id' => $orderId,
            'data' => [
                'order_id' => $orderId,
                'game' => $game,
                'package' => $package,
                'price' => $price,
                'status' => 'pending'
            ]
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