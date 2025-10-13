<?php
session_start();
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ล็อคอิน - PickTopUp</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <?php include 'nav.php'; ?>

    <div class="login-card form-signin shadow">
        <span class="icon-login"><i class="bi bi-person-circle"></i></span>

        <!-- แสดง error จาก session -->
        <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?= $_SESSION['error'];
                unset($_SESSION['error']); ?>
            </div>
        <?php } ?>

        <!-- Login Section -->
        <section class="login-section">
            <div class="login-container">
                <div class="login-box">

                    <!-- Tab Switcher -->
                    <div class="tab-switcher">
                        <button class="tab-btn active" data-tab="login">ล็อคอิน</button>
                        <button class="tab-btn" data-tab="register">สมัครสมาชิก</button>
                        <button class="tab-btn" data-tab="forgot">ลืมรหัสผ่าน</button> <!-- ✅ เพิ่ม -->
                    </div>

                    <!-- ✅ Login Form -->
                    <div id="loginForm" class="form-content active">
                        <form class="auth-form" action="login_db.php" method="POST">
                            <div class="form-group">
                                <label for="login-email">อีเมล หรือ เบอร์โทรศัพท์</label>
                                <input type="text" name="email" id="login-email" placeholder="your@email.com หรือ 0XX-XXX-XXXX" required>
                            </div>

                            <div class="form-group">
                                <label for="login-password">รหัสผ่าน</label>
                                <div class="password-input">
                                    <input type="password" name="password" id="login-password" placeholder="••••••••" required>
                                    <span class="toggle-password" onclick="togglePassword('login-password')">👁️</span>
                                </div>
                            </div>

                            <div class="form-options">
                                <label class="remember-me">
                                    <input type="checkbox" id="remember">
                                    <span>จดจำฉันไว้</span>
                                </label>
                               
                            </div>

                            <button type="submit" name="login" class="btn-auth">เข้าสู่ระบบ</button>

                            <div class="divider">
                                <span>หรือเข้าสู่ระบบด้วย</span>
                            </div>

                            <div class="social-login">
                                <button type="button" class="social-login-btn google">
                                    <span>🔴</span> Google
                                </button>
                                <button type="button" class="social-login-btn facebook">
                                    <span>📘</span> Facebook
                                </button>
                                <button type="button" class="social-login-btn line">
                                    <span>💚</span> Line
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- ✅ Register Form -->
                    <div id="registerForm" class="form-content">
                        <form class="auth-form" action="register_db.php" method="POST">
                            <div class="form-group">
                                <label for="register-name">ชื่อ-นามสกุล</label>
                                <input type="text" name="username" id="register-name" placeholder="กรอกชื่อของคุณ" required>
                            </div>

                            <div class="form-group">
                                <label for="register-email">อีเมล</label>
                                <input type="email" name="email" id="register-email" placeholder="your@email.com" required>
                            </div>

                            <div class="form-group">
                                <label for="register-password">รหัสผ่าน</label>
                                <div class="password-input">
                                    <input type="password" name="password" id="register-password" placeholder="อย่างน้อย 6 ตัวอักษร" required>
                                    <span class="toggle-password" onclick="togglePassword('register-password')">👁️</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="register-confirm-password">ยืนยันรหัสผ่าน</label>
                                <div class="password-input">
                                    <input type="password" name="confirm_password" id="register-confirm-password" placeholder="กรอกรหัสผ่านอีกครั้ง" required>
                                    <span class="toggle-password" onclick="togglePassword('register-confirm-password')">👁️</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="checkbox-label">
                                    <input type="checkbox" required>
                                    <span>ฉันยอมรับ <a href="#" class="link">เงื่อนไขการใช้บริการ</a> และ <a href="#" class="link">นโยบายความเป็นส่วนตัว</a></span>
                                </label>
                            </div>

                            <button type="submit" name="register" class="btn-auth">สมัครสมาชิก</button>
                        </form>
                    </div>

                    <!-- ✅ Forgot Password Form -->
                    <div id="forgotForm" class="form-content">
                        <form class="auth-form" action="reset_password_db.php" method="POST">
                            <div class="form-group">
                                <label for="forgot-email">อีเมลของคุณ</label>
                                <input type="email" name="email" id="forgot-email" placeholder="กรอกอีเมลที่ลงทะเบียนไว้" required>
                            </div>

                            <div class="form-group">
                                <label for="new-pass">รหัสผ่านใหม่</label>
                                <input type="password" name="new_password" id="new-pass" placeholder="••••••••" required>
                            </div>

                            <div class="form-group">
                                <label for="confirm-pass">ยืนยันรหัสผ่านใหม่</label>
                                <input type="password" name="confirm_password" id="confirm-pass" placeholder="••••••••" required>
                            </div>

                            <button type="submit" class="btn-auth">บันทึกรหัสผ่านใหม่</button>
                        </form>
                    </div>

                </div>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <script src="js/script.js"></script>
    <script src="js/login.js"></script>

    <script>
        // ✅ สลับแท็บ (รวม forgot password)
        const tabButtons = document.querySelectorAll(".tab-btn, .forgot-password-btn");
        const forms = document.querySelectorAll(".form-content");

        tabButtons.forEach(btn => {
            btn.addEventListener("click", () => {
                const target = btn.dataset.tab;
                forms.forEach(f => f.classList.remove("active"));
                document.getElementById(target + "Form").classList.add("active");

                // ปรับปุ่ม active
                document.querySelectorAll(".tab-btn").forEach(t => t.classList.remove("active"));
                const tab = document.querySelector(`.tab-btn[data-tab="${target}"]`);
                if (tab) tab.classList.add("active");
            });
        });
    </script>
</body>
</html>
