<?php 
session_start();
require 'functions.php';

// cek session
if( isset($_SESSION['email']) ) {
  header("Location: index.php");
  exit;
}

// jika tombol login ditekan
if( isset($_POST['login']) ) {

  // cek login
  // cek usernamenya dulu
  global $conn;
  $email = $_POST['email'];
  $password = $_POST['password'];
  $cek_email = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");

  if( mysqli_num_rows($cek_email) === 1 ) {
    $row = mysqli_fetch_assoc($cek_email);
    // cek password
    if($password == $row['password']) {
      // jika berhasil login
      $_SESSION['email'] = true ;

      header('Location: index.php');
      exit;
    }
  }
  $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Login</h5>
            <form class="form-signin" action="" method="post">
              <div class="form-label-group">
                <input type="email" id="email" name="email" class="form-control" placeholder="enail" required autofocus>
                <label for="email">Email</label>  
            </div>
              <div class="form-label-group">
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                <label for="password">Password</label>  
            </div>
              <button class="btn btn-lg btn-success btn-block text-uppercase" name="login" type="submit" style="background-color: #435d7d">Login</button>
              <?php if( isset($error) ) : ?>
    <p style="color: red; font-style: italic;">username / password salah!</p>
  <?php endif; ?>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-3.3.1.slim.min.js"></script>
</body>
</html>