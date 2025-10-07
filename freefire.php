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
    <link rel="stylesheet" href="css/topup.css">
    <style>
        /* Container */
        .topup-container {
            width: 90%;
            max-width: 900px;
            margin: 40px auto;
        }

        .page-title {
            font-size: 2rem;
            color: #fff;
            margin-bottom: 25px;
        }

        .page-title span {
            color: #ff92f6;
        }

        /* Card Box */
        .form-card {
            background: rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            padding: 30px 40px;
            margin-bottom: 30px;
            backdrop-filter: blur(12px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .section-title {
            font-size: 1.2rem;
            color: #ff92f6;
            border-left: 4px solid #ff77ff;
            padding-left: 10px;
            margin-bottom: 20px;
        }

        /* Input Fields */
        .form-group {
            margin-bottom: 20px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border-radius: 10px;
            border: none;
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
            font-size: 1rem;
        }

        /* Packages */
        .package-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 15px;
        }

        .package-card {
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 15px;
            text-align: center;
            padding: 15px 0;
            position: relative;
            transition: 0.3s;
        }

        .package-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 15px #b86cff;
        }

        .package-card h3 {
            color: #ff77ff;
            font-size: 1.8rem;
            margin: 0;
        }

        .package-card p {
            color: #d8a9ff;
            margin: 5px 0;
        }

        .price {
            color: #25ff75;
            font-weight: bold;
            display: block;
        }

        .discount {
            position: absolute;
            bottom: 8px;
            right: 10px;
            background: red;
            color: white;
            padding: 3px 8px;
            border-radius: 8px;
            font-size: 0.8rem;
        }

        /* Payment */
        .payment-grid {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        .payment-card {
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 15px;
            width: 180px;
            text-align: center;
            padding: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .payment-card:hover {
            box-shadow: 0 0 15px #b86cff;
            transform: translateY(-5px);
        }

        .payment-card img {
            width: 50px;
            height: 50px;
            margin-bottom: 10px;
        }

        .payment-card p {
            font-weight: bold;
            color: #fff;
        }

        /* ซ่อน radio ปกติ */
        .package-card input[type="radio"],
        .payment-card input[type="radio"] {
            display: none;
        }

        /* เมื่อเลือก package */
        .package-card input[type="radio"]:checked+h3,
        .package-card input[type="radio"]:checked+p,
        .package-card input[type="radio"]:checked~.price {
            color: #00ffb3;
        }

        .package-card input[type="radio"]:checked~.discount {
            background: #00b37a;
        }

        /* เพิ่มขอบเรืองแสงเมื่อเลือก */
        .package-card input[type="radio"]:checked+h3 {
            border: 2px solid #00ffb3;
        }

        /* ปุ่ม Submit */
        .submit-area {
            text-align: center;
            margin: 30px 0 60px;
        }

        .submit-btn {
            background: linear-gradient(90deg, #ff6fff, #9a4cff);
            color: #fff;
            font-size: 1.2rem;
            padding: 15px 40px;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            box-shadow: 0 0 20px rgba(255, 100, 255, 0.5);
            transition: all 0.3s ease;
        }

        .submit-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 0 25px rgba(255, 100, 255, 0.9);
        }

        .qr-display {
            text-align: center;
            margin-top: 20px;
            transition: all 0.4s ease;
            opacity: 0;
            transform: translateY(10px);
        }

        .qr-display img {
            width: 200px;
            height: 200px;
            border-radius: 12px;
            box-shadow: 0 0 25px rgba(255, 100, 255, 0.4);
            margin-bottom: 10px;
        }

        .qr-text {
            color: #fff;
            font-size: 1rem;
        }
    </style>
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
                            <img src="https://cdn-icons-png.flaticon.com/512/2331/2331947.png" alt="">
                            <p>TrueMoney Wallet</p>
                        </label>

                        <label class="payment-card">
                            <input type="radio" name="payment" value="promptpay">
                            <img src="https://cdn-icons-png.flaticon.com/512/2331/2331966.png" alt="">
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
        </div>
        <script src="js/script.js"></script>
        <script src="js/particles.js"></script>
        <script src="js/qr.js"></script>
</body>

</html>