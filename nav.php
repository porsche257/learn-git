<?php
ob_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<header>
  <nav class="navbar">
    <div class="container">
      <div class="logo">🎮 PickTopUp</div>

      <ul class="nav-menu">
        <li><a href="index.php">หน้าแรก</a></li>
        <li><a href="topup.php">เติมเกม</a></li>
        <li><a href="news.php">ข่าวสาร</a></li>
        <li><a href="contact.php">ติดต่อ</a></li>

        <!-- PHP ปุ่มล็อกอิน/ออก -->
        <li class="auth-buttons">
          <?php if (!isset($_SESSION['user_id'])) { ?>
            
            <a href="login.php" class="btn-login">Login</a>
            <a href="login.php" class="btn btn-outline-primary">Sign-up</a>
          <?php } else { ?>
            <a href="logout.php" class="btn-login">Logout</a>
            <a href="profile.php" class="btn-login">Profile</a>
          <?php } ?>
        </li>
      </ul>
      

      <div class="hamburger">
        <span></span><span></span><span></span>
      </div>
    </div>
  </nav>
</header>
