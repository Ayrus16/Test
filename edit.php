<?php 
session_start();
if(!isset($_SESSION['email']) ) {
  header("Location: login.php");
  exit;
}
require 'functions.php';
$kode = $_GET["kode"];
$pema = query("SELECT * FROM pemasukan WHERE kode = $kode")[0];

if( isset($_POST["edit"]) ) {
  if( edit($_POST) > 0 ) {
    echo "<script>
        alert('Data berhasil diubah!');
        document.location.href = 'index.php';
        </script>";
  } else {
    echo "<script>
        alert('Data gagal diubah!');
        document.location.href = 'index.php';
        </script>";
  }
}
$sql = "SELECT * FROM sumber";
$sumber = query($sql);
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
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Dasboard<span class="sr-only">(current)</span></a>
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
            <input type="hidden" name="kode" value="<?php echo $pema["kode"];?>">
          </div>
          <div class="form-group">
            <label>Sumber</label>
            <select name="sumber" class="form-control">
              <?php foreach( $sumber as $row ) { ?>
                  <option value="<?= $row["sumber"]; ?>"><?= $row["sumber"]; ?></option>
                <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label>Jumlah</label>
            <input type="text" id="jumlah" name="jumlah" class="form-control" value="<?= $pema["jumlah"]; ?>" required>
          </div>
          <div class="form-group">
            <?php
                $sql = "SELECT * FROM ket";
                $ket = query($sql);
              ?>
            <label>Keterangan</label>
            <select name="keterangan" class="form-control">
                <?php foreach( $ket as $row ) { ?>
                  <option value="<?= $row["ket"]; ?>"><?= $row["ket"]; ?></option>
                <?php } ?>
              </select>
          </div>
          <div class="form-group">
            <label>Tanggal</label>
            <input type="date" id="tanggal" name="tanggal" class="form-control" value="<?= $pema["tanggal"]; ?>" required>
          </div>
          <div style="text-align: right;">
            <a href="index.php">        
              <button type="button" class="btn btn-default">Batal</button>
            </a>
            <button type="submit" class="btn btn-info" name="edit">Simpan</button>
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