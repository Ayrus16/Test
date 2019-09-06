<?php 
 require_once("asset/dompdf/autoload.inc.php");
 require 'functions.php';

 $sql = "SELECT * FROM pemasukan";
 $pema = query($sql);
 use Dompdf\Dompdf;
$html="
<!DOCTYPE html>
<html>
<head>
<style>
table {
  border-collapse: collapse;
}

table, td, th {
  border: 1px solid black;

}
tr{
	text-align: center;
}
</style>

</head>
<body>";

$html .="<div class='text-center'>
			<h1>Laporan Pendapatan Daerah Provinsi Jawa Barat</h1>
		 </div>";
$html .="<table>
			<tr>
				<th>No</th>
				<th style='width:50px'>Kode</th>
				<th style='width:180px'>Sumber</th>
				<th style='width:100px'>Tanggal</th>
				<th style='width:120px'>Jumlah</th>
				<th style='width:200px'>Keterangan</th>
			</tr>";
$i=1;
foreach ($pema as $row) {
$html .="<tr>
			<td>".$i."</td>
			<td>".$row['kode']."</td>
			<td>".$row['sumber']."</td>
			<td>".$row['tanggal']."</td>
			<td style='text-align: left;'> Rp.".number_format($row["jumlah"], 0, ',', '.')."</td>
			<td>".$row['keterangan']."</td>
		</tr>";
$i++;
}

$html .="</table></body>
</html>";

$file = 'Laporan-Pendapatan';
$dompdf = new DOMPDF();
$dompdf->set_paper('A4', 'potrait');
$dompdf->load_html($html);
$dompdf->render();

$dompdf->stream(''.$file, array('Attachment'=>0));
$output = $dompdf->output();
?>