<?php
require_once 'config.php';

header('Content-Type: application/json');

$action = $_POST['action'] ?? '';

// LOGIN
if ($action === 'login') {
    $email = sanitize($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);
    
    if (empty($email) || empty($password)) {
        echo json_encode([
            'success' => false,
            'message' => 'กรุณากรอกอีเมลและรหัสผ่าน'
        ]);
        exit;
    }
    
    try {
        $sql = "SELECT * FROM users WHERE email = :email OR phone = :phone";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':email' => $email,
            ':phone' => $email
        ]);
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['password'])) {
            // Set session
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['is_admin'] = $user['is_admin'];
            
            // Set cookie if remember me
            if ($remember) {
                $token = bin2hex(random_bytes(32));
                setcookie('remember_token', $token, time() + (86400 * 30), '/');
                
                // Save token to database
                $updateSql = "UPDATE users SET remember_token = :token WHERE user_id = :user_id";
                $updateStmt = $conn->prepare($updateSql);
                $updateStmt->execute([
                    ':token' => password_hash($token, PASSWORD_DEFAULT),
                    ':user_id' => $user['user_id']
                ]);
            }
            
            echo json_encode([
                'success' => true,
                'message' => 'เข้าสู่ระบบสำเร็จ',
                'user' => [
                    'id' => $user['user_id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'is_admin' => $user['is_admin']
                ]
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'อีเมลหรือรหัสผ่านไม่ถูกต้อง'
            ]);
        }
        
    } catch (PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()
        ]);
    }
}

// REGISTER
elseif ($action === 'register') {
    $name = sanitize($_POST['name'] ?? '');
    $email = sanitize($_POST['email'] ?? '');
    $phone = sanitize($_POST['phone'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    
    // Validation
    if (empty($name) || empty($email) || empty($phone) || empty($password)) {
        echo json_encode([
            'success' => false,
            'message' => 'กรุณากรอกข้อมูลให้ครบถ้วน'
        ]);
        exit;
    }
    
    if ($password !== $confirmPassword) {
        echo json_encode([
            'success' => false,
            'message' => 'รหัสผ่านไม่ตรงกัน'
        ]);
        exit;
    }
    
    if (strlen($password) < 8) {
        echo json_encode([
            'success' => false,
            'message' => 'รหัสผ่านต้องมีอย่างน้อย 8 ตัวอักษร'
        ]);
        exit;
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode([
            'success' => false,
            'message' => 'รูปแบบอีเมลไม่ถูกต้อง'
        ]);
        exit;
    }
    
    try {
        // Check if email already exists
        $checkSql = "SELECT user_id FROM users WHERE email = :email";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->execute([':email' => $email]);
        
        if ($checkStmt->fetch()) {
            echo json_encode([
                'success' => false,
                'message' => 'อีเมลนี้มีผู้ใช้งานแล้ว'
            ]);
            exit;
        }
        
        // Check if phone already exists
        $checkPhoneSql = "SELECT user_id FROM users WHERE phone = :phone";
        $checkPhoneStmt = $conn->prepare($checkPhoneSql);
        $checkPhoneStmt->execute([':phone' => $phone]);
        
        if ($checkPhoneStmt->fetch()) {
            echo json_encode([
                'success' => false,
                'message' => 'เบอร์โทรศัพท์นี้มีผู้ใช้งานแล้ว'
            ]);
            exit;
        }
        
        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // Insert new user
        $sql = "INSERT INTO users (name, email, phone, password, points) VALUES (:name, :email, :phone, :password, 100)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':phone' => $phone,
            ':password' => $hashedPassword
        ]);
        
        $userId = $conn->lastInsertId();
        
        // Auto login after registration
        $_SESSION['user_id'] = $userId;
        $_SESSION['user_name'] = $name;
        $_SESSION['user_email'] = $email;
        $_SESSION['is_admin'] = 0;
        
        // Send welcome email
        $emailSubject = "ยินดีต้อนรับสู่ GameTopUp";
        $emailMessage = "
            <h2>ยินดีต้อนรับ {$name}!</h2>
            <p>ขอบคุณที่สมัครสมาชิกกับ GameTopUp</p>
            <p>คุณได้รับโบนัสต้อนรับ 100 แต้ม</p>
            <p>พิเศษ! รับส่วนลด 15% สำหรับการเติมครั้งแรก</p>
            <p><a href='" . SITE_URL . "/topup.html'>เริ่มเติมเกมเลย</a></p>
        ";
        sendEmail($email, $emailSubject, $emailMessage);
        
        echo json_encode([
            'success' => true,
            'message' => 'สมัครสมาชิกสำเร็จ',
            'user' => [
                'id' => $userId,
                'name' => $name,
                'email' => $email,
                'points' => 100
            ]
        ]);
        
    } catch (PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()
        ]);
    }
}

// LOGOUT
elseif ($action === 'logout') {
    session_destroy();
    setcookie('remember_token', '', time() - 3600, '/');
    
    echo json_encode([
        'success' => true,
        'message' => 'ออกจากระบบสำเร็จ'
    ]);
}

// CHECK SESSION
elseif ($action === 'check_session') {
    if (isLoggedIn()) {
        $userId = $_SESSION['user_id'];
        
        $sql = "SELECT user_id, name, email, phone, points, is_admin FROM users WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':user_id' => $userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        echo json_encode([
            'success' => true,
            'logged_in' => true,
            'user' => $user
        ]);
    } else {
        echo json_encode([
            'success' => true,
            'logged_in' => false
        ]);
    }
}

else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid action'
    ]);
}
?>