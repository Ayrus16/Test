<?php 
session_start();
if(!isset($_SESSION['email']) ) {
  header("Location: login.php");
  exit;
}
require 'functions.php';
$nip = $_GET["nip"];
$user = query("SELECT * FROM user WHERE nip = $nip")[0];

if( isset($_POST["user_edit"]) ) {
    global $conn;

  $nip = $_POST["nip"];
  $nama = $_POST["nama"];
  $password = $_POST["password"];
  $email = $_POST["email"];


  $sql = "UPDATE user
      nama = '$nama',
      email = '$email',
      password = '$password'
      WHERE nip = $nip ";

  mysqli_query($conn, $sql);

  echo "<script>
          alert('User Berhasil Diubah!');
          document.location.href = 'user.php';
        </script>";
    return mysqli_affected_rows($conn);
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>SIMPENDA</title>
  </head>
  <body>
<!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
      <a class="navbar-brand" style="color: #fff">SIMPENDA</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Dasboard</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="user.php">User</a>
          </li>
        </ul>
      </div>
    </nav>
<!-- x Navbar -->

<!-- table -->
<div class="container">
  <div class="table-wrapper">
    <div class="table-title">
      <div class="row">
        <div class="col-sm-4">
            <h2>Ubah <b>DATA</b></h2>
        </div>
      </div>
    </div>
        <form action="" method="post">
          <div class="form-group">
            <input type="hidden" name="nip" value="<?php echo $user["nip"];?>">
          </div>
            <div class="form-group">
              <label for="nama">Nama</label>
              <input type="text" id="nama" name="nama" class="form-control" value="<?= $user["nama"]; ?>" required>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" id="email" name="email" class="form-control" value="<?= $user["email"]; ?>" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" id="password" name="password" class="form-control" value="<?= $user["password"]; ?>" required>
            </div>
          <div style="text-align: right;">
            <a href="user.php">        
              <button type="button" class="btn btn-default">Batal</button>
            </a>
            <button type="submit" class="btn btn-info" name="user_edit">Simpan</button>
          </div>
        </form>
    </div>
  </div>
    </div>            
  </div>
          
    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>