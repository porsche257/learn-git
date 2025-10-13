<?php
session_start(); // ต้องอยู่บนสุดก่อน <!DOCTYPE html>
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เติม Free Fire | GameTopUp</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/pak.css">
</head>

<body>
    <?php include 'nav.php'; ?>
    <!-- Promo Banner -->
    <div class="promo-banner">
        <div class="promo-text">
            <span>🔥 โปรโมชั่นพิเศษ! เติม 100 แถม 20 | ✨ รับส่วนลด 15% สำหรับสมาชิกใหม่ | 🎁 เติมวันนี้รับโบนัสฟรี!</span>
        </div>
    </div>

    <div class="topup-container">
        <h1 class="page-title">เติม <span>Free Fire</span></h1>
        <div class="form-card">
            <!-- เริ่มฟอร์ม -->
            <form action="save_order.php" method="POST">
                <input type="hidden" name="game_name" value="Free Fire">

                <!-- ข้อมูลเกม -->
                <div class="form-card">
                    <h2 class="section-title">📋 ข้อมูลเกม</h2>
                    <div class="form-group">
                        <label>UID / ไอดีเกม *</label>
                        <input type="text" name="uid" placeholder="กรอก UID ของคุณ" required>
                    </div>

                    <div class="form-group">
                        <label>ชื่อในเกม (ไม่บังคับ)</label>
                        <input type="text" name="username" placeholder="ชื่อในเกมของคุณ">
                    </div>
                </div>

                <!-- เลือกแพ็กเกจ -->
                <div class="form-card">
                    <h2 class="section-title">💎 เลือกแพ็กเกจ</h2>
                    <div class="package-grid">
                        <label class="package-card">
                            <input type="radio" name="package" value="50 เพชร - 20 บาท" required>
                            <h3>50</h3>
                            <p>เพชร</p>
                            <span class="price">฿20</span>
                        </label>

                        <label class="package-card">
                            <input type="radio" name="package" value="100 เพชร - 40 บาท (ลด 10%)">
                            <h3>100</h3>
                            <p>เพชร</p>
                            <span class="price">฿40</span>
                            <span class="discount">-10%</span>
                        </label>

                        <label class="package-card">
                            <input type="radio" name="package" value="310 เพชร - 120 บาท (ลด 15%)">
                            <h3>310</h3>
                            <p>เพชร</p>
                            <span class="price">฿120</span>
                            <span class="discount">-15%</span>
                        </label>

                        <label class="package-card">
                            <input type="radio" name="package" value="520 เพชร - 200 บาท (ลด 20%)">
                            <h3>520</h3>
                            <p>เพชร</p>
                            <span class="price">฿200</span>
                            <span class="discount">-20%</span>
                        </label>
                    </div>
                </div>

                <!-- ช่องทางชำระเงิน -->
                <div class="form-card">
                    <h2 class="section-title">💳 ช่องทางชำระเงิน</h2>
                    <div class="payment-grid">
                        <label class="payment-card">
                            <input type="radio" name="payment" value="truemoney">
                            <p>TrueMoney Wallet</p>
                        </label>

                        <label class="payment-card">
                            <input type="radio" name="payment" value="promptpay">
                            <p>PromptPay</p>
                        </label>
                    </div>

                    <!-- กล่องแสดง QR Code -->
                    <div id="qrDisplay" class="qr-display">
                        <img id="qrImage" src="" alt="QR Code" style="display: none;">
                        <p id="qrText" class="qr-text"></p>
                    </div>
                </div>
                <!-- ปุ่มส่ง -->
                <div class="submit-area">
                    <button type="submit" class="submit-btn">✅ ยืนยันการเติม</button>
                </div>
            </form>
        </div>
        <script src="js/script.js"></script>
        <script src="js/particles.js"></script>
        <script src="js/qr.js"></script>
</body>

</html>