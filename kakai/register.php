<?php

 session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kakai</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous"></head>
<link rel="stylesheet" href="sign-in.css">
<body>
    <!-- menu -->
<div class="container">

    <?php include 'nav.php'; ?>

</div>
  <!-- menu end -->
   
<main class="form-signin w-100 m-auto"> 
 <form action="register_db.php" method="post"> 
        <h1 class="h3 mb-3 fw-normal">Sign UP</h1> 
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

    <div class="form-floating"> <input type="text" class="form-control my-2" name="username" id="floatingInput" placeholder="name@example.com"> 
        <label for="username">username</label> 
    </div>
    
    <div class="form-floating"> <input type="email" class="form-control my-2" name="email" id="floatingInput" placeholder="name@example.com"> 
        <label for="floatingInput">Email address</label> 
    </div>

    <div class="form-floating"> 
        <input type="password" class="form-control my-2" name="password" id="floatingPassword" placeholder="Password"> 
        <label for="floatingPassword">Password</label> 
    </div>

    <div class="form-floating"> 
        <input type="password" class="form-control my-2" name="confirm_password" id="floatingPassword" placeholder="Confirm Password"> 
        <label for="floatingPassword">Confirm Password</label> 
    </div>


        <button class="btn btn-primary w-100 py-2" name="register" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-body-secondary">Already have an account? Click here to <a href="login.php">sign in</a></p>

 </form>
</main>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>


</body>
</html>