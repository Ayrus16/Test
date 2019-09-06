<?php
// Koneksi library FPDF
require 'functions.php';
require 'asset/fpdf/fpdf.php';
$sql = "SELECT * FROM pemasukan";
$pema = query($sql);
// Setting halaman PDF
$pdf = new FPDF('l','mm','A5');
// Menambah halaman baru
$pdf->AddPage();
// Setting jenis font
$pdf->SetFont('Arial','B',16);
// Membuat string
$pdf->Cell(190,7,'Laporan Pendapatan Daerah Provinsi Jawa Barat',0,1,'C');
$pdf->SetFont('Arial','B',9);
$pdf->ln(3);
$pdf->Cell(190,0.6,'',0,1,'C',true);
// Setting spasi kebawah supaya tidak rapat
$pdf->ln(5);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(15,7,'Kode',1,0);
$pdf->Cell(50,7,'Sumber',1,0);
$pdf->Cell(25,7,'Tanggal',1,0);
$pdf->Cell(60,7,'Keterangan',1,0);
$pdf->Cell(40,7,'Jumlah',1,1);

foreach( $pema as $row ) {
    $pdf->Cell(15,6,$row['kode'],1,0);
    $pdf->Cell(50,6,$row['sumber'],1,0);
    $pdf->Cell(25,6,$row['tanggal'],1,0);
    $pdf->Cell(60,6,$row['keterangan'],1,0);
    $pdf->Cell(40,6,$row['jumlah'],1,1);
}

$pdf->Output('pemasukan.pdf','D' ,array("Attachment"=>0));
?>
