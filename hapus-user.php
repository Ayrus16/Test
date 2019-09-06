<?php
session_start();
if(!isset($_SESSION['email']) ) {
  header("Location: login.php");
  exit;
}
require 'functions.php';
$nip = $_GET["nip"];

	global $conn;
	mysqli_query($conn, "DELETE FROM user WHERE nip = $nip ");
	echo "<script>
			alert('User berhasil dihapus!');
			document.location.href = 'user.php';
		</script>";

?>