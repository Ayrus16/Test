<?php 
session_start();
require 'functions.php';
if(!isset($_SESSION['email']) ) {
  header("Location: login.php");
  exit;
}

if( isset($_GET['cari']) ) {
  $keyword = $_GET['keyword'];
  $sql = "SELECT * FROM user
        WHERE
       nip LIKE '%$keyword%' OR
       nama LIKE '%$keyword%' OR
       email LIKE '%$keyword%' ";
  $user = query($sql);
  } else {
    $user = query("SELECT*FROM user");
}

  if( isset($_POST["user"]) ) {
  if( user($_POST) > 0 ) {
    echo "<script>
        alert('User Berhasil Ditambahkan!');
        document.location.href = 'user.php';
        </script>";
  } else {
    echo "<script>
        alert('User Gagal Ditambahkan!');
        document.location.href = 'user.php';
        </script>";
  }}
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
         <a class="nav-link" href="logout.php"><button class="btn btn-dark">Logout</button></a>
      </div>
    </nav>
<!-- x Navbar -->

<!-- table -->
<div class="container">
   <div class="table-wrapper">
     <div class="table-title">
       <div class="row">
          <div class="col-sm-4">
            <h2>Tabel <b>USER</b></h2>
          </div>
          <div class="col-sm-5">
            <form class="form-inline" action="" method="get">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="keyword">
              <button class="btn btn-outline-success" type="submit" name="cari">Search</button>
            </form>
          </div>
          <div class="col-sm-3">
            <a href="#tambahusr" class="btn btn-success" data-toggle="modal"><span>Tambah</span></a>
          </div>
        </div>
      </div>
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>Nip</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if( empty($user) ) : ?>
                  <tr>
                    <td colspan="9" align="center">Data Tidak di temukan</td>
                  </tr>
                <?php endif; ?>
                <?php foreach( $user as $row ) {  ?>
                  <tr>
                    <td><?= $row["nip"]; ?></td>
                    <td><?= $row["nama"]; ?></td>
                    <td><?= $row["email"]; ?></td>
                    <td>
                      <a href="edit-user.php?nip=<?= $row["nip"]; ?>">
                        <button type="button" name="edit" class="btn btn-info">Edit</button>
                      </a>
                      <a href="hapus-user.php?nip=<?= $row["nip"]; ?>" class="delete">
                        <button type="button" name="hapus" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')">Hapus</button>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
  <!-- Tambah Modal HTML -->
  <div id="tambahusr" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
         <form action="" method="post"> 
          <div class="modal-header">            
            <h4 class="modal-title">Tambah</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">          
            <div class="form-group">
              <label>Nip</label>
              <input type="text" id="nip" name="nip" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Nama</label>
              <input type="text" id="nama" name="nama" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" id="password" name="password" class="form-control" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-success" id="user" name="user">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<!-- x table -->

    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>