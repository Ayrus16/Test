<?php 
session_start();
require 'functions.php';
if(!isset($_SESSION['email']) ) {
  header("Location: login.php");
  exit;
}

if( isset($_GET['cari']) ) {
  $keyword = $_GET['keyword'];
  $sql = "SELECT * FROM pemasukan
        WHERE
       kode LIKE '%$keyword%' OR
       tanggal LIKE '%$keyword%' OR
       jumlah LIKE '%$keyword%' OR
       sumber LIKE '%$keyword%' OR
       keterangan LIKE '%$keyword%'
       ";
  $pema = query($sql);
} else {
  $pema = query("SELECT*FROM pemasukan");
}
$total = 0;
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
            <a class="nav-link" href="index.php">Dasboard</a>
          </li>
          <li class="nav-item">
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
            <h2>Tabel <b>DATA</b></h2>
          </div>
          <div class="col-sm-5">
            <form class="form-inline" action="" method="get">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="keyword">
              <button class="btn btn-outline-success" type="submit" name="cari">Search</button>
            </form>
          </div>
          <div class="col-sm-3">
            <a href="cetak.php" class="btn btn-secondary"><span ">Cetak</span></a>
            <a href="#tambah" class="btn btn-success" data-toggle="modal"><span ">Tambah</span></a>
          </div>
        </div>
      </div>
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>Kode</th>
                  <th>Kota/Kabupaten</th>
                  <th>Jumlah</th>
                  <th>Tanggal</th>
                  <th>Keterangan</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php if( empty($pema) ) : ?>
                  <tr>
                    <td colspan="9" align="center">Data Tidak di temukan</td>
                  </tr>
                <?php endif; ?>
                <?php foreach( $pema as $row ) {  ?>
                  <tr>
                    <td><?= $row["kode"]; ?></td>
                    <td><?= $row["sumber"]; ?></td>
                    <td>Rp.<?= number_format($row["jumlah"], 0, ',', '.'); ?></td>
                    <td><?= $row["tanggal"]; ?></td>
                    <td><?= $row["keterangan"]; ?></td>
                    <td>
                      <a href="edit.php?kode=<?= $row["kode"]; ?>">
                        <button type="button" name="edit" class="btn btn-info">Edit</button>
                      </a>
                      <a href="hapus.php?kode=<?= $row["kode"]; ?>" class="delete">
                        <button type="button" name="hapus" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')">Hapus</button>
                      </a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
  <!-- Tambah Modal HTML -->
  <div id="tambah" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
         <form action="" method="post" enctype="multipart/form-data"> 
          <?php
            if( isset($_POST["tambah"]) ) {
            if( tambah($_POST) > 0 ) {
              echo "<script>
                  alert('Data Berhasil Ditambahkan!');
                  document.location.href = 'index.php';
                  </script>";
            } else {
              echo "<script>
                  alert('Data Gagal Ditambahkan!');
                  document.location.href = 'index.php';
                  </script>";
            }
            }
            $sql = "SELECT * FROM sumber";
            $sumber = query($sql);
          ?>
          <div class="modal-header">            
            <h4 class="modal-title">Tambah</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">          
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
              <input type="text" id="jumlah" name="jumlah" class="form-control" required>
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
              <input type="date" id="tanggal" name="tanggal" class="form-control" required>
            </div>          
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-success" id="tambah" name="tambah">Tambah</button>
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