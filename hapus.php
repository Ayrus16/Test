<?php
session_start();
if(!isset($_SESSION['email']) ) {
  header("Location: login.php");
  exit;
}
require 'functions.php';
$kode = $_GET["kode"];

if( hapus($kode) > 0 ) {
	echo "<script>
			alert('Data berhasil dihapus!');
			document.location.href = 'index.php';
		</script>";
} else {
	echo "<script>
			alert('Data gagal dihapus!');
			document.location.href = 'index.php';
		</script>";
}

?>