


<header>
  <h1>Test shop</h1>
  <nav>
    <ul>
      <li><a href="index.php" class="active">หน้าแรก</a></li>
      <li><a href="topup.html">เติมเกม</a></li>
      <li><a href="new.">ข่าวสาร</a></li>
      <li><a href="contact.html">ติดต่อเรา</a></li>
    </ul>
  </nav>


             <!--ห้ามขยับ-->
               <div class="col-md-3 text-end">
                <?php if (!isset($_SESSION['user_id'])) { ?>
                     <a href="login.php" class="btn btn-outline-primary me-2">Login</a> 
                     <a href="register.php" class="btn btn-outline-primary">Sign-up</a> 

                 <?php } else { ?>
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                    <?php } ?>
            <!--ห้ามขยับ-->
                </div> 
            </header>
            
            