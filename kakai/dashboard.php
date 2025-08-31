<?php
   session_start();
   require 'config.php';
   if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
   }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous"></head>
<body>

<div class="container">
     <?php include 'nav.php'; ?>
<!-- hero -->
              <div class="px-4 py-5 my-5 text-center"> 
                <?php
                if (isset($_SESSION['user_id'])) {
                    $user_id = $_SESSION['user_id'];
                }

                try {

                    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
                    $stmt->execute([$user_id]);
                    $user = $stmt->fetch();

                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();

                }
                ?>
                  <h1 class="display-5 fw-bold text-body-emphasis">Welcome, <?php echo $user['username']; ?></h1> 
                  <div class="col-lg-6 mx-auto"> 
                      <p class="lead mb-4">Email : <?php echo $user['email']; ?></p> 
                 
              </div>
        </div>

<!-- foter -->
 <footer class="py-3 my-4"> <ul class="nav justify-content-center border-bottom pb-3 mb-3"> <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Home</a></li> <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Features</a></li> <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Pricing</a></li> <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">FAQs</a></li> <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">About</a></li> </ul> <p class="text-center text-body-secondary">© 2025 Company, Inc</p> </footer>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>


</body>
</html>