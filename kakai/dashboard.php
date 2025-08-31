<?php
   session_start();
   require 'config.php';
   if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | kakai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="sign-in.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        .profile-card {
            max-width: 400px;
            margin: 48px auto;
            padding: 2.5rem 2rem 2rem 2rem;
            background: rgba(255,255,255,0.95);
            border-radius: 1.5rem;
            box-shadow: 0 8px 32px rgba(60,72,88,0.18);
            text-align: center;
            position: relative;
        }
        .profile-icon {
            font-size: 3.5rem;
            color: #6366f1;
            margin-bottom: 1rem;
            filter: drop-shadow(0 2px 8px #6366f155);
        }
        .profile-card h1 {
            font-weight: 700;
            color: #6366f1;
            margin-bottom: 0.5rem;
            letter-spacing: 1px;
        }
        .profile-card p.lead {
            font-size: 1.1rem;
            color: #4f46e5;
            margin-bottom: 0.5rem;
        }
        .profile-card .btn-home {
            background: linear-gradient(90deg, #6366f1 60%, #4f46e5 100%);
            color: #fff;
            border: none;
            border-radius: 0.75rem;
            font-weight: 600;
            font-size: 1.1rem;
            transition: background 0.2s, box-shadow 0.2s;
            box-shadow: 0 2px 8px rgba(99,102,241,0.12);
        }
        .profile-card .btn-home:hover {
            background: linear-gradient(90deg, #4f46e5 60%, #6366f1 100%);
            color: #fff;
            box-shadow: 0 4px 16px rgba(99,102,241,0.18);
        }
        .profile-card hr {
            margin: 1.5rem 0;
            border-top: 1px solid #e0e7ff;
        }
        .profile-card .desc {
            color: #6b7280;
            font-size: 1rem;
            margin-bottom: 1.2rem;
        }
        @media (max-width: 500px) {
            .profile-card {
                padding: 1rem 0.5rem;
                max-width: 98vw;
            }
            .profile-card h1 {
                font-size: 1.3rem;
            }
        }
    </style>
</head>
<body>
    <div class="background-bubbles">
        <span></span><span></span><span></span><span></span><span></span>
    </div>
    <?php include 'nav.php'; ?>

    <?php
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    }
    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch();
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
    }
    ?>

    <div class="d-flex justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="profile-card shadow">
            <span class="profile-icon"><i class="bi bi-person-circle"></i></span>
            <h1>Welcome,<br> <?php echo htmlspecialchars($user['username']); ?></h1>
            <p class="lead"><i class="bi bi-envelope"></i> <?php echo htmlspecialchars($user['email']); ?></p>
            <hr>
            <p class="desc">ขอบคุณที่เป็นสมาชิกกับเรา! คุณสามารถกลับไปหน้าแรกหรือเลือกเมนูอื่นได้จากด้านบน</p>
            <a href="index.php" class="btn btn-home mt-2"><i class="bi bi-house"></i> กลับหน้าแรก</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>