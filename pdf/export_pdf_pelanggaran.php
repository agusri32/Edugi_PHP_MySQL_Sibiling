<?php
include "fpdf.php";
include "../conn.php";

$pdf = new FPDF();
$pdf->AddPage();

//untuk judul
$pdf->setFont('Arial','B',12); 
$pdf->setXY(75,3);
$pdf->cell(30,6,'Laporan Pelanggaran Siswa'); 

//untuk data pendukung
$id_bimbingan=$_GET['id_bimbingan'];
$semester=$_GET['semester'];
$nama_siswa=$_GET['nama_siswa'];
$nama_kelas=$_GET['nama_kelas'];
$nama_guru=$_GET['nama_guru'];
$nis=$_GET['nis'];
$tanggal=date('D,d-M-Y');

$cek_total=mysqli_fetch_array(mysqli_query($link,"select sum(poin) as total_poin from tbl_siswa_pelanggaran where id_bimbingan='$id_bimbingan'"));
$total=$cek_total['total_poin'];

//untuk data siswa
$pdf->setFont('Arial','B',8);
$pdf->setXY(24,20);$pdf->cell(24,6,'Nama Siswa : '.$nama_siswa);
$pdf->setXY(24,25);$pdf->cell(24,6,'NIS : '.$nis);
$pdf->setXY(24,30);$pdf->cell(24,6,'Kelas : '.$nama_kelas);
$pdf->setXY(24,35);$pdf->cell(24,6,'Guru BK : '.$nama_guru);
$pdf->setXY(24,40);$pdf->cell(24,6,'TOTAL POIN : '.$total);

$pdf->setFont('Arial','I',8);
$pdf->setXY(140,40);$pdf->cell(24,6,'Tanggal Cetak : '.$tanggal);

//untuk header
$pdf->setFont('Arial','',8);
$pdf->setFillColor(233,233,233);
$y_axis1 = 50;
$pdf->setY($y_axis1);

//untuk ontaint
$y_initial = 56; //untuk setting row mulai data
$pdf->setX(25);

//header
$pdf->cell(10,6,'No',1,0,'C',1); 
$pdf->cell(30,6,'Jenis Pelanggaran',1,0,'C',1); 
$pdf->cell(20,6,'Poin',1,0,'C',1);
$pdf->cell(25,6,'Tanggal Kejadian',1,0,'C',1); 
$pdf->cell(30,6,'Jenis Sanksi',1,0,'C',1); 
$pdf->cell(55,6,'Keterangan',1,0,'C',1);
$y = $y_initial + $row;

$id_siswa=$_GET['id_siswa'];

$view=mysqli_query($link,"select pelanggaran.id_pelanggaran, bimbingan.id_bimbingan, jenis.nama_jenis, sanksi.nama_sanksi, pelanggaran.poin, pelanggaran.keterangan, waktu_submit, tgl_kejadian from tbl_siswa_pelanggaran pelanggaran, tbl_siswa_bimbingan bimbingan, setup_jenis_pelanggaran jenis, setup_jenis_sanksi sanksi where pelanggaran.id_bimbingan=bimbingan.id_bimbingan and pelanggaran.id_jenis=jenis.id_jenis and pelanggaran.id_sanksi=sanksi.id_sanksi and pelanggaran.id_bimbingan='$id_bimbingan' order by id_pelanggaran asc");

$no = 0;
$row = 6;
while ($data = mysqli_fetch_array($view)){
	
	$nama_jenis=$data['nama_jenis'];
	$nama_sanksi=$data['nama_sanksi'];
	$poin=$data['poin'];
	$tgl_kejadian=$data['tgl_kejadian'];
	$keterangan=$data['keterangan'];
	
	$no++;
	$pdf->setY($y);
	$pdf->setX(25);
	$pdf->cell(10,6,$no,1,0,'C');
	$pdf->cell(30,6,$nama_jenis,1,0,'L');
	$pdf->cell(20,6,$poin,1,0,'C');
	$pdf->cell(25,6,$tgl_kejadian,1,0,'C');
	$pdf->cell(30,6,$nama_sanksi,1,0,'L');
    $pdf->cell(55,6,$keterangan,1,0,'L');
	$y = $y + $row;
}


$pdf->Output();
?>