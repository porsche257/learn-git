<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | kakai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="sign-in.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body>
    <?php include 'nav.php'; ?>

    <div class="login-card form-signin shadow">
        <span class="icon-login"><i class="bi bi-person-plus"></i></span>
        <h1 class="login-title">Sign Up</h1>
        <p class="text-center text-secondary mb-4">สมัครสมาชิกเพื่อรับสิทธิพิเศษและโปรโมชั่นเติมเกมสุดคุ้ม</p>

        <?php if (isset($_SESSION['success'])) { ?> 
            <div class="alert alert-success" role="alert">
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </div>
        <?php } ?>

        <?php if (isset($_SESSION['error'])) { ?> 
            <div class="alert alert-danger" role="alert">
                <?php
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php } ?>

        <form action="register_db.php" method="post">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="username" id="floatingUsername" placeholder="Username" required>
                <label for="floatingUsername"><i class="bi bi-person"></i> Username</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" name="email" id="floatingEmail" placeholder="Email address" required>
                <label for="floatingEmail"><i class="bi bi-envelope"></i> Email address</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password" required>
                <label for="floatingPassword"><i class="bi bi-lock"></i> Password</label>
            </div>
            <div class="form-floating mb-4">
                <input type="password" class="form-control" name="confirm_password" id="floatingConfirmPassword" placeholder="Confirm Password" required>
                <label for="floatingConfirmPassword"><i class="bi bi-lock-fill"></i> Confirm Password</label>
            </div>
            <button class="btn btn-primary w-100 py-2 mb-2" name="register" type="submit">
                <i class="bi bi-person-plus"></i> Sign up
            </button>
            <div class="text-center mt-3">
                <span class="text-body-secondary">Already have an account?</span>
                <a href="login.php" class="text-decoration-none text-primary fw-bold">Sign in</a>
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