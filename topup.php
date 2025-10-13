<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เติมเกม - Game Top-Up</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/topup.css">
</head>

<body>
    <div class="cursor-trail"></div>

    <?php include 'nav.php'; ?>
    <!-- Promo Banner -->
    <div class="promo-banner">
        <div class="promo-text">
            <span>🔥 โปรโมชั่นพิเศษ! เติม 100 แถม 20 | ✨ รับส่วนลด 15% สำหรับสมาชิกใหม่ | 🎁 เติมวันนี้รับโบนัสฟรี!</span>
        </div>
    </div>


    <!-- Top-up Section -->
    <section class="topup-section">
        <div class="container">
            <h1 class="page-title">เลือกเกมที่ต้องการเติม</h1>
            <p class="page-subtitle">เลือกเกมโปรดของคุณ และเติมได้ทันที ภายใน 30 วินาที</p>

            <!-- Games Selection Grid -->
            <div id="gamesGrid" class="games-selection-grid">

                <div class="game-select-card">
                    <div class="game-badge">HOT</div>
                    <img src="im/ff.jpg" width="80" height="80" alt="Free Fire">
                    <h3>Free Fire</h3>
                    <p>เพชร Free Fire</p>
                    <a href="freefire.php" class="price-tag">เริ่มต้น 20 บาท</a>
                </div>

                <div class="game-select-card">
                    <div class="game-badge">POPULAR</div>
                    <img src="im/images.jpg" width="80" height="80" alt="ROV">
                    <h3>ROV</h3>
                    <p>คูปอง ROV</p>
                    <a href="rov.php" class="price-tag">เริ่มต้น 25 บาท</a>
                </div>

                <div class="game-select-card">
                    <img src="im/pubg.jpg" width="80" height="80" alt="PUBG Mobile">
                    <h3>PUBG Mobile</h3>
                    <p>UC PUBG</p>
                    <a href="pubg.php" class="price-tag">เริ่มต้น 30 บาท</a>
                </div>

                <div class="game-select-card">
                    <img src="im/genchin.png" width="80" height="80" alt="Genshin Impact">
                    <h3>Genshin Impact</h3>
                    <p>Genesis Crystal</p>
                    <a href="genchin.php" class="price-tag">เริ่มต้น 35 บาท</a>
                </div>

                <div class="game-select-card">
                    <img src="im/ml.png" width="80" height="80" alt="Mobile Legends">
                    <h3>Mobile Legends</h3>
                    <p>Diamond ML</p>
                    <a href="ml.php" class="price-tag">เริ่มต้น 20 บาท</a>
                </div>

                <div class="game-select-card">
                    <img src="im/rag.webp" width="80" height="80" alt="Ragnarok M">
                    <h3>Ragnarok M</h3>
                    <p>Big Cat Coin</p>
                    <a href="Rak.php" class="price-tag">เริ่มต้น 40 บาท</a>
                </div>

                <div class="game-select-card">
                    <img src="im/call.png" width="80" height="80" alt="Call of Duty Mobile">
                    <h3>Call of Duty Mobile</h3>
                    <p>CP COD Mobile</p>
                    <a href="call.php" class="price-tag">เริ่มต้น 30 บาท</a>
                </div>

                <div class="game-select-card">
                    <img src="im/honkill.png" width="80" height="80" alt="Honkai Star Rail">
                    <h3>Honkai Star Rail</h3>
                    <p>Oneiric Shard</p>
                    <a href="onkaiStarRail.php" class="price-tag">เริ่มต้น 35 บาท</a>
                </div>

                <div class="game-select-card">
                    <img src="im/valo.png" width="80" height="80" alt="Valorant">
                    <h3>Valorant</h3>
                    <p>Valorant Points</p>
                    <a href="Valorant.php" class="price-tag">เริ่มต้น 50 บาท</a>
                </div>

                <div class="game-select-card">
                    <img src="im/golden.png" width="80" height="80" alt="Golden Sapatula">
                    <h3>Golden Sapatula</h3>
                    <p>RP</p>
                    <a href="Golden.php" class="price-tag">เริ่มต้น 5 บาท</a>
                </div>


            </div>

            <footer class="footer">
                <div class="container">
                    <div class="footer-content">
                        <div class="footer-col">
                            <h4>เกี่ยวกับเรา</h4>
                            <p>เว็บไซต์เติมเกมออนไลน์ อันดับ 1<br>บริการรวดเร็ว ปลอดภัย มั่นคง</p>
                        </div>
                        <div class="footer-col">
                            <h4>เมนู</h4>
                            <ul>
                                <li><a href="index.html">หน้าแรก</a></li>
                                <li><a href="topup.html">เติมเกม</a></li>
                                <li><a href="news.html">ข่าวสาร</a></li>
                                <li><a href="contact.html">ติดต่อเรา</a></li>
                            </ul>
                        </div>
                        <div class="footer-col">
                            <h4>ติดต่อ</h4>
                            <p>📞 02-xxx-xxxx<br>📧 support@gametopup.com<br>💬 Line: @gametopup</p>
                        </div>
                        <div class="footer-col">
                            <h4>ช่องทางชำระเงิน</h4>
                            <p>TrueMoney Wallet<br>PromptPay<br>โอนผ่านธนาคาร</p>
                        </div>
                    </div>
                    <div class="footer-bottom">
                        <p>&copy; 2025 GameTopUp. All rights reserved.</p>
                    </div>
                </div>
            </footer>

            <script src="่js/script.js"></script>
            <script src="js/particles.js"></script>
</body>

</html>