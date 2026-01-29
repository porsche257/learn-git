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

                <a href="freefire.php" class="game-select-card">
                    <div class="game-badge">HOT</div>
                    <img src="im/ff.jpg" class="game-select-icon" alt="Free Fire Logo" width="80" height="80">
                    <h3>Free Fire</h3>
                    <p>เพชร Free Fire</p>
                    <span class="price-tag">เริ่มต้น 20 บาท</span>
                </a>


                <a href="rov.php" class="game-select-card" data-game="rov">
                    <div class="game-badge">POPULAR</div>
                    <img src="im/images.jpg" class="game-select-icon" alt="Free Fire Logo" width="80" height="80">
                    <h3>ROV</h3>
                    <p>คูปอง ROV</p>
                    <span class="price-tag">เริ่มต้น 25 บาท</span>
                </a>

                <a href="pubg.php" class="game-select-card" data-game="pubg">
                    <img src="im/pubg.jpg" class="game-select-icon" alt="Free Fire Logo" width="80" height="80">
                    <h3>PUBG Mobile</h3>
                    <p>UC PUBG</p>
                    <span class="price-tag">เริ่มต้น 30 บาท</span>
                </a>

                <a href="genchin.php" class="game-select-card" data-game="genshin">
                    <img src="im/genchin.png" class="game-select-icon" alt="Free Fire Logo" width="80" height="80">
                    <h3>Genshin Impact</h3>
                    <p>Genesis Crystal</p>
                    <span class="price-tag">เริ่มต้น 35 บาท</span>
                </a>

                <a href="ml.php" class="game-select-card" data-game="mobilelegends">
                    <img src="im/ml.png" class="game-select-icon" alt="Free Fire Logo" width="80" height="80">
                    <h3>Mobile Legends</h3>
                    <p>Diamond ML</p>
                    <span class="price-tag">เริ่มต้น 20 บาท</span>
                </a>

                <a href="Rak.php" class="game-select-card" data-game="ragnarok">
                    <img src="im/rag.webp" class="game-select-icon" alt="Free Fire Logo" width="80" height="80">
                    <h3>Ragnarok M</h3>
                    <p>Big Cat Coin</p>
                    <span class="price-tag">เริ่มต้น 40 บาท</span>
                </a>

                <a href="call.php" class="game-select-card" data-game="codm">
                    <img src="im/call.png" class="game-select-icon" alt="Free Fire Logo" width="80" height="80">
                    <h3>Call of Duty Mobile</h3>
                    <p>CP COD Mobile</p>
                    <span class="price-tag">เริ่มต้น 30 บาท</span>
                </a>

                <a href="onkaiStarRail.php" class="game-select-card" data-game="honkai">
                    <img src="im/honkill.png" class="game-select-icon" alt="Free Fire Logo" width="80" height="80">
                    <h3>Honkai Star Rail</h3>
                    <p>Oneiric Shard</p>
                    <span class="price-tag">เริ่มต้น 35 บาท</span>
                </a>

                <a href="Valorant.php" class="game-select-card" data-game="valorant">
                    <img src="im/valo.png" class="game-select-icon" alt="Free Fire Logo" width="80" height="80">
                    <h3>Valorant</h3>
                    <p>Valorant Points</p>
                    <span class="price-tag">เริ่มต้น 50 บาท</span>
                </a>

                <a href="Golden.php" class="game-select-card" data-game="lineagem">
                    <img src="im/golden.png" class="game-select-icon" alt="Free Fire Logo" width="80" height="80">
                    <h3>Golden Sapatula</h3>
                    <p>RP</p>
                    <span class="price-tag">เริ่มต้น 5 บาท</span>
                </a>

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