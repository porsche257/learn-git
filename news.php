<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข่าวสาร - Game Top-Up</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/news.css">
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

    <!-- News Section -->
    <section class="news-section">
        <div class="container">
            <h1 class="page-title">ข่าวสารและอัปเดต</h1>
            <p class="page-subtitle">ติดตามข่าวสารล่าสุดจากเกมยอดนิยม และโปรโมชั่นพิเศษ</p>

            <!-- Category Filter -->
            <div class="category-filter">
                <button class="category-btn active" data-category="all">ทั้งหมด</button>
                <button class="category-btn" data-category="news">ข่าวเกม</button>
                <button class="category-btn" data-category="promo">โปรโมชั่น</button>
                <button class="category-btn" data-category="update">อัปเดต</button>
                <button class="category-btn" data-category="guide">คู่มือ</button>
            </div>

            <!-- Featured News (Horizontal Scroll) -->
            <div class="featured-news-section">
                <h2 class="section-title">ข่าวเด่นวันนี้</h2>
                <p class="scroll-hint">← ลากเมาส์หรือเลื่อนเพื่อดูเพิ่มเติม →</p>
                <div class="featured-news-container">
                    <div class="featured-news-card" data-category="news">
                        <div class="featured-badge">🔥 HOT</div>
                        <div class="featured-image">🎮</div>
                        <div class="featured-content">
                            <span class="featured-category">ข่าวเกม</span>
                            <h3>Free Fire เปิดตัวสกินใหม่สุดเจ๋ง!</h3>
                            <p>Free Fire เตรียมเปิดตัวสกินคอลเลกชันใหม่ล่าสุด พร้อมด้วยอาวุธและสกินตัวละครสุดพิเศษ...</p>
                            <div class="featured-meta">
                                <span>📅 1 ต.ค. 2025</span>
                                <a href="#" class="read-more">อ่านเพิ่มเติม →</a>
                            </div>
                        </div>
                    </div>

                    <div class="featured-news-card" data-category="promo">
                        <div class="featured-badge">⚡ NEW</div>
                        <div class="featured-image">💎</div>
                        <div class="featured-content">
                            <span class="featured-category">โปรโมชั่น</span>
                            <h3>โปรพิเศษ! เติม 100 แถม 30</h3>
                            <p>โปรโมชั่นสุดคุ้ม! เติมเงินครบ 100 บาท รับโบนัสเพิ่มทันที 30 บาท มีจำนวนจำกัด...</p>
                            <div class="featured-meta">
                                <span>📅 30 ก.ย. 2025</span>
                                <a href="#" class="read-more">อ่านเพิ่มเติม →</a>
                            </div>
                        </div>
                    </div>

                    <div class="featured-news-card" data-category="update">
                        <div class="featured-badge">✨ UPDATE</div>
                        <div class="featured-image">⚔️</div>
                        <div class="featured-content">
                            <span class="featured-category">อัปเดต</span>
                            <h3>ROV อัปเดตฮีโร่ใหม่และสกินพิเศษ</h3>
                            <p>Garena ROV ปล่อยอัปเดตใหญ่! มาพร้อมฮีโร่ใหม่ 2 ตัว และสกินสุดเท่ที่ไม่ควรพลาด...</p>
                            <div class="featured-meta">
                                <span>📅 29 ก.ย. 2025</span>
                                <a href="#" class="read-more">อ่านเพิ่มเติม →</a>
                            </div>
                        </div>
                    </div>

                    <div class="featured-news-card" data-category="news">
                        <div class="featured-badge">🎯 EVENT</div>
                        <div class="featured-image">🎯</div>
                        <div class="featured-content">
                            <span class="featured-category">ข่าวเกม</span>
                            <h3>PUBG Mobile จัดอีเว้นท์ใหญ่แจกของรางวัลฟรี</h3>
                            <p>PUBG Mobile จัดอีเว้นท์พิเศษ! ลุ้นรับสกินอาวุธและชุดฟรี พร้อมโบนัส UC มากมาย...</p>
                            <div class="featured-meta">
                                <span>📅 28 ก.ย. 2025</span>
                                <a href="#" class="read-more">อ่านเพิ่มเติม →</a>
                            </div>
                        </div>
                    </div>

                    <div class="featured-news-card" data-category="guide">
                        <div class="featured-badge">📚 GUIDE</div>
                        <div class="featured-image">🌟</div>
                        <div class="featured-content">
                            <span class="featured-category">คู่มือ</span>
                            <h3>5 เทคนิคเล่น Genshin Impact ให้เทพ</h3>
                            <p>รวม 5 เทคนิคสุดเจ๋ง ที่จะทำให้คุณเล่น Genshin Impact ได้เก่งขึ้น พร้อมวิธีฟาร์มเพชรฟรี...</p>
                            <div class="featured-meta">
                                <span>📅 27 ก.ย. 2025</span>
                                <a href="#" class="read-more">อ่านเพิ่มเติม →</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- News Grid -->
            <div class="news-grid-section">
                <h2 class="section-title">ข่าวทั้งหมด</h2>
                <p class="scroll-hint">← ลากเมาส์หรือเลื่อนเพื่อดูเพิ่มเติม →</p>
                
                <div class="news-grid">
                    <!-- News Card 1 -->
                    <div class="news-card" data-category="promo">
                        <div class="news-image">
                            <div class="news-icon">💰</div>
                            <span class="news-badge promo">โปรโมชั่น</span>
                        </div>
                        <div class="news-content">
                            <h3>Flash Sale ลดสูงสุด 40% ทุกวันศุกร์!</h3>
                            <p>อย่าพลาด! Flash Sale สุดคุ้ม ทุกวันศุกร์ เวลา 18:00-20:00 น. ลดสูงสุด 40% สำหรับทุกเกม</p>
                            <div class="news-meta">
                                <span>📅 26 ก.ย. 2025</span>
                                <a href="#" class="read-more">อ่านต่อ →</a>
                            </div>
                        </div>
                    </div>

                    <!-- News Card 2 -->
                    <div class="news-card" data-category="news">
                        <div class="news-image">
                            <div class="news-icon">🎮</div>
                            <span class="news-badge news">ข่าวเกม</span>
                        </div>
                        <div class="news-content">
                            <h3>Mobile Legends เพิ่มฮีโร่ใหม่ล่าสุด</h3>
                            <p>Mobile Legends Bang Bang ปล่อยฮีโร่ใหม่ล่าสุด พร้อมสกินสุดพิเศษและอัปเดตระบบเกม</p>
                            <div class="news-meta">
                                <span>📅 25 ก.ย. 2025</span>
                                <a href="#" class="read-more">อ่านต่อ →</a>
                            </div>
                        </div>
                    </div>

                    <!-- News Card 3 -->
                    <div class="news-card" data-category="update">
                        <div class="news-image">
                            <div class="news-icon">⚡</div>
                            <span class="news-badge update">อัปเดต</span>
                        </div>
                        <div class="news-content">
                            <h3>ระบบเติมเงินอัตโนมัติใหม่! เร็วขึ้น 50%</h3>
                            <p>เราได้อัปเกรดระบบเติมเงินให้รวดเร็วยิ่งขึ้น ตอนนี้ใช้เวลาเพียง 15 วินาทีเท่านั้น!</p>
                            <div class="news-meta">
                                <span>📅 24 ก.ย. 2025</span>
                                <a href="#" class="read-more">อ่านต่อ →</a>
                            </div>
                        </div>
                    </div>

                    <!-- News Card 4 -->
                    <div class="news-card" data-category="guide">
                        <div class="news-image">
                            <div class="news-icon">📖</div>
                            <span class="news-badge guide">คู่มือ</span>
                        </div>
                        <div class="news-content">
                            <h3>วิธีเติมเกมที่ถูกต้อง ไม่ให้ผิดพลาด</h3>
                            <p>คู่มือสำหรับมือใหม่! เรียนรู้วิธีการเติมเกมที่ถูกต้อง เช็ค UID และขั้นตอนการชำระเงิน</p>
                            <div class="news-meta">
                                <span>📅 23 ก.ย. 2025</span>
                                <a href="#" class="read-more">อ่านต่อ →</a>
                            </div>
                        </div>
                    </div>

                    <!-- News Card 5 -->
                    <div class="news-card" data-category="news">
                        <div class="news-image">
                            <div class="news-icon">🔥</div>
                            <span class="news-badge news">ข่าวเกม</span>
                        </div>
                        <div class="news-content">
                            <h3>Valorant เปิดตัว Agent ใหม่สุดเจ๋ง!</h3>
                            <p>Riot Games ประกาศเปิดตัว Agent ใหม่ใน Valorant พร้อมสกินอาวุธคอลเลกชันใหม่</p>
                            <div class="news-meta">
                                <span>📅 22 ก.ย. 2025</span>
                                <a href="#" class="read-more">อ่านต่อ →</a>
                            </div>
                        </div>
                    </div>

                    <!-- News Card 6 -->
                    <div class="news-card" data-category="promo">
                        <div class="news-image">
                            <div class="news-icon">🎁</div>
                            <span class="news-badge promo">โปรโมชั่น</span>
                        </div>
                        <div class="news-content">
                            <h3>สมาชิกใหม่รับส่วนลด 20% ทันที!</h3>
                            <p>สมัครสมาชิกวันนี้ รับส่วนลดทันที 20% สำหรับการเติมครั้งแรก ไม่มีขั้นต่ำ!</p>
                            <div class="news-meta">
                                <span>📅 21 ก.ย. 2025</span>
                                <a href="#" class="read-more">อ่านต่อ →</a>
                            </div>
                        </div>
                    </div>

                    <!-- News Card 7 -->
                    <div class="news-card" data-category="update">
                        <div class="news-image">
                            <div class="news-icon">🌟</div>
                            <span class="news-badge update">อัปเดต</span>
                        </div>
                        <div class="news-content">
                            <h3>เพิ่มเกมใหม่! Honkai Star Rail</h3>
                            <p>ตอนนี้เติม Honkai Star Rail ได้แล้ว! รองรับทุกแพ็กเกจ ราคาดีที่สุด</p>
                            <div class="news-meta">
                                <span>📅 20 ก.ย. 2025</span>
                                <a href="#" class="read-more">อ่านต่อ →</a>
                            </div>
                        </div>
                    </div>

                    <!-- News Card 8 -->
                    <div class="news-card" data-category="guide">
                        <div class="news-image">
                            <div class="news-icon">💡</div>
                            <span class="news-badge guide">คู่มือ</span>
                        </div>
                        <div class="news-content">
                            <h3>10 เทคนิคประหยัดเงินเติมเกม</h3>
                            <p>รวม 10 เทคนิคที่จะช่วยให้คุณประหยัดเงินเติมเกม และได้ไอเทมคุ้มค่ามากขึ้น</p>
                            <div class="news-meta">
                                <span>📅 19 ก.ย. 2025</span>
                                <a href="#" class="read-more">อ่านต่อ →</a>
                            </div>
                        </div>
                    </div>

                    <!-- News Card 9 -->
                    <div class="news-card" data-category="news">
                        <div class="news-image">
                            <div class="news-icon">🎯</div>
                            <span class="news-badge news">ข่าวเกม</span>
                        </div>
                        <div class="news-content">
                            <h3>Call of Duty Mobile Season ใหม่มาแล้ว!</h3>
                            <p>COD Mobile เปิด Season ใหม่ พร้อมแมพใหม่ อาวุธใหม่ และโหมดเกมสุดมันส์</p>
                            <div class="news-meta">
                                <span>📅 18 ก.ย. 2025</span>
                                <a href="#" class="read-more">อ่านต่อ →</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Load More Button -->
            <div class="load-more-section">
                <button class="btn-load-more">โหลดข่าวเพิ่มเติม</button>
            </div>
        </div>
    </section>

    <!-- Footer -->
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
                    <p>📞 02-xxx-xxxx<br>📧 support@PickTopUp.com<br>💬 Line: @PickTopUp</p>
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

    <script src="js/script.js"></script>
    <script src="js/news.js"></script>
    <script src="js/particles.js"></script>
</body>
</html>