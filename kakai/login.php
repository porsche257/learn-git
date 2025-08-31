<?php
session_start();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | kakai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="sign-in.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        .btn-primary {
          background: linear-gradient(90deg, #6366f1 60%, #4f46e5 100%);
          color: #fff;
          border: none;
        }
    </style>
</head>
<body>
    <?php include 'nav.php'; ?>

    <div class="login-card form-signin shadow">
        <span class="icon-login"><i class="bi bi-person-circle"></i></span>
        <h1 class="login-title">Sign In</h1>
        <p class="text-center text-secondary mb-4">เข้าสู่ระบบเพื่อใช้งานเว็บไซต์ เติมเกมและรับโปรโมชั่นสุดคุ้ม</p>
        <?php if (isset($_SESSION['error'])) { ?> 
            <div class="alert alert-danger" role="alert">
                <?php
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php } ?>

        <form action="login_db.php" method="post">
            <div class="form-floating mb-3">
                <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com" required>
                <label for="floatingInput"><i class="bi bi-envelope"></i> Email address</label>
            </div>
            <div class="form-floating mb-4">
                <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password" required>
                <label for="floatingPassword"><i class="bi bi-lock"></i> Password</label>
            </div>
            <button class="btn-primary w-100 py-2 mb-2" name="login" type="submit">
                <i class="bi bi-box-arrow-in-right"></i> Sign in
            </button>
            <div class="text-center mt-3">
                <span class="text-body-secondary">ยังไม่มีบัญชี?</span>
                <a href="register.php" class="text-decoration-none text-primary fw-bold">Sign up</a>
            </div>
        </form>
    </div>

    <?php if (isset($_SESSION['error'])): ?>
    <script>window.hasFormError = true;</script>
    <?php endif; ?>
    <script src="form-effects.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>