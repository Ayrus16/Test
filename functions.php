<?php
$conn = mysqli_connect("localhost", "root", "", "db_simpenda");

function query($sql) {
	global $conn;
	$result = mysqli_query($conn,$sql);

	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
	$rows[] = $row;
	}

	return $rows;
}

function tambah($data) {
	global $conn;

	$sumber = htmlspecialchars($data["sumber"]);
	$jumlah = htmlspecialchars($data["jumlah"]);
	$keterangan = htmlspecialchars($data["keterangan"]);
	$tanggal = htmlspecialchars($data["tanggal"]);

	$sql = "INSERT INTO pemasukan VALUES('', '$sumber', '$jumlah', '$tanggal', '$keterangan')";

	mysqli_query($conn, $sql);

	return mysqli_affected_rows($conn);
}

function edit($data) {
	global $conn;

	$kode = $data["kode"];
	$sumber = htmlspecialchars($data["sumber"]);
	$jumlah = htmlspecialchars($data["jumlah"]);
	$keterangan = htmlspecialchars($data["keterangan"]);
	$tanggal = htmlspecialchars($data["tanggal"]);

	$sql = "UPDATE pemasukan SET
				sumber = '$sumber',
				jumlah = '$jumlah',
				keterangan = '$keterangan',
				tanggal = '$tanggal'
			WHERE kode = $kode";
	mysqli_query($conn, $sql);

	return mysqli_affected_rows($conn);
}

function hapus($kode) {
	global $conn;
	mysqli_query($conn, "DELETE FROM pemasukan where kode = $kode");

	return mysqli_affected_rows($conn);
}
function user($data) {
	global $conn;

	$nip = $_POST["nip"];
	$nama = $_POST["nama"];
	$password = $_POST["password"];
	$email = $_POST["email"];

	$cek_email = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");

	if( mysqli_num_rows($cek_email) === 1 ) {
		echo "<script>
				alert('Email sudah terpakai!');
				document.location.href = '';
			  </script>";
		return false;
	}
	$sql = "INSERT INTO user VALUES ('$nip','$nama','$email','$password')";
	mysqli_query($conn,$sql);

	return mysqli_affected_rows($conn);
}

?>