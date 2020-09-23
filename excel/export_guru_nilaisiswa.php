<?php 
function xlsBOF() {
echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
return;
}

function xlsEOF() {
echo pack("ss", 0x0A, 0x00);
return;
}

function xlsWriteNumber($Row, $Col, $Value) {
echo pack("sssss", 0x203, 14, $Row, $Col, 0x0);
echo pack("d", $Value);
return;
}

function xlsWriteLabel($Row, $Col, $Value ) {
$L = strlen($Value);
echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
echo $Value;
return;
}

include "../conn.php";

$id_guru=$_GET['id_guru'];
$id_periode=$_GET['id_periode'];
$id_matapelajaran=htmlentities($_GET['id_matapelajaran']);
$id_kelas=htmlentities($_GET['id_kelas']);

if($id_matapelajaran!=="0"){
	$filter_matapelajaran="and nilai.id_matapelajaran='$id_matapelajaran'";
}else{
	$filter_matapelajaran="";
}

if($id_kelas!=="0"){
	$filter_kelas="and ruangan.id_kelas='$id_kelas'";
}else{
	$filter_kelas="";
}

			

$queabsdetail = "SELECT nama_siswa, nis,id_kelas,nama_matapelajaran, nilai_tugas, nilai_uts, nilai_uas FROM tbl_nilai nilai, data_siswa siswa, setup_matapelajaran matapelajaran, tbl_ruangan ruangan WHERE nilai.id_siswa=ruangan.id_siswa and nilai.id_siswa=siswa.id_siswa and nilai.id_matapelajaran=matapelajaran.id_matapelajaran and nilai.id_guru='$id_guru' and nilai.id_periode='$id_periode' $filter_matapelajaran $filter_kelas order by siswa.nama_siswa asc";
$exequeabsdetail = mysql_query($queabsdetail);
while($res = mysql_fetch_array($exequeabsdetail)){
	$id_kelas=$res['id_kelas'];
	$kelas=mysql_fetch_array(mysql_query("select * from setup_kelas where id_kelas='$id_kelas'"));
	
	$data['id_siswa'][] = $res['id_siswa'];
	$data['nama_siswa'][] = $res['nama_siswa'];
	$data['nama_kelas'][] = $kelas['nama_kelas'];
	$data['nama_pelajaran'][] = $res['nama_matapelajaran'];
	$data['nilai_tugas'][] = $res['nilai_tugas'];
	$data['nilai_uts'][] = $res['nilai_uts'];
	$data['nilai_uas'][] = $res['nilai_uas'];
} 

$jm = sizeof($data['id_siswa']);
header("Pragma: public" );
header("Expires: 0" );
header("Cache-Control: must-revalidate, post-check=0, pre-check=0" );
header("Content-Type: application/force-download" );
header("Content-Type: application/octet-stream" );
header("Content-Type: application/download" );;
header("Content-Disposition: attachment;filename=SINO_Guru_Nilai_Siswa.xls " );
header("Content-Transfer-Encoding: binary " );
xlsBOF();
xlsWriteLabel(0,3,"Data Nilai Siswa" );
xlsWriteLabel(2,0,"Nomor" );
xlsWriteLabel(2,1,"Nama Siswa" );
xlsWriteLabel(2,2,"Nama kelas" );
xlsWriteLabel(2,3,"Nama Pelajaran" );
xlsWriteLabel(2,4,"Nilai Tugas" );
xlsWriteLabel(2,5,"Nilai UTS" );
xlsWriteLabel(2,6,"Nilai UAS" );
$xlsRow = 3;

for ($y=0; $y<$jm; $y++) {
	++$i;
	xlsWriteNumber($xlsRow,0,"$i" );
	xlsWriteLabel($xlsRow,1,$data['nama_siswa'][$y]);
	xlsWriteLabel($xlsRow,2,$data['nama_kelas'][$y]);
	xlsWriteLabel($xlsRow,3,$data['nama_pelajaran'][$y]);
	xlsWriteLabel($xlsRow,4,$data['nilai_tugas'][$y]);
	xlsWriteLabel($xlsRow,5,$data['nilai_uts'][$y]);
	xlsWriteLabel($xlsRow,6,$data['nilai_uas'][$y]);
	$xlsRow++;
}
xlsEOF();
exit();