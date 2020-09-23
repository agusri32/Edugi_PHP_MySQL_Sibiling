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

$id_guru=htmlentities($_GET['id_guru']);
$id_matapelajaran=htmlentities($_GET['id_matapelajaran']);
$id_kelas=htmlentities($_GET['id_kelas']);

if($id_guru!=="0"){
	$filter_guru="and jadwal.id_guru='$id_guru'";
}else{
	$filter_guru="";
}

if($id_matapelajaran!=="0"){
	$filter_matapelajaran="and jadwal.id_matapelajaran='$id_matapelajaran'";
}else{
	$filter_matapelajaran="";
}

if($id_kelas!=="0"){
	$filter_kelas="and jadwal.id_kelas='$id_kelas'";
}else{
	$filter_kelas="";
}

			
//query
$queabsdetail = "select nama_guru,nip,nama_matapelajaran,nama_kelas,tahun_ajaran, periode.semester as periode from tbl_jadwal_mengajar jadwal, setup_kelas kelas, setup_periode periode, setup_matapelajaran matapelajaran, data_guru guru where jadwal.id_kelas=kelas.id_kelas and jadwal.id_matapelajaran=matapelajaran.id_matapelajaran and jadwal.id_guru=guru.id_guru and jadwal.id_periode=periode.id_periode $filter_guru $filter_siswa $filter_matapelajaran $filter_kelas order by id_jadwal asc";
$exequeabsdetail = mysql_query($queabsdetail);
while($res = mysql_fetch_array($exequeabsdetail)){
	//data
	$data['id_guru'][] = $res['id_guru'];
	$data['nama_guru'][] = $res['nama_guru'];
	$data['nip'][] = $res['nip'];
	$data['nama_matapelajaran'][] = $res['nama_matapelajaran'];
	$data['nama_kelas'][] = $res['nama_kelas'];
	$data['tahun_ajaran'][] = $res['tahun_ajaran'];
	$data['periode'][] = $res['periode'];
} 

$jm = sizeof($data['id_guru']);
header("Pragma: public" );
header("Expires: 0" );
header("Cache-Control: must-revalidate, post-check=0, pre-check=0" );
header("Content-Type: application/force-download" );
header("Content-Type: application/octet-stream" );
header("Content-Type: application/download" );;
header("Content-Disposition: attachment;filename=SINO_Jadwal_Mengajar.xls " );
header("Content-Transfer-Encoding: binary " );
xlsBOF();
xlsWriteLabel(0,3,"Data Jadwal Mengajar" );
xlsWriteLabel(2,0,"Nomor" );
xlsWriteLabel(2,1,"Nama Guru" );
xlsWriteLabel(2,2,"NIP" );
xlsWriteLabel(2,3,"Mata Pelajaran" );
xlsWriteLabel(2,4,"Kelas" );
xlsWriteLabel(2,5,"Tahun Ajaran" );
xlsWriteLabel(2,6,"Periode" );
$xlsRow = 3;

for ($y=0; $y<$jm; $y++) {
	++$i;
	xlsWriteNumber($xlsRow,0,"$i" );
	xlsWriteLabel($xlsRow,1,$data['nama_guru'][$y]);
	xlsWriteLabel($xlsRow,2,$data['nip'][$y]);
	xlsWriteLabel($xlsRow,3,$data['nama_matapelajaran'][$y]);
	xlsWriteLabel($xlsRow,4,$data['nama_kelas'][$y]);
	xlsWriteLabel($xlsRow,5,$data['tahun_ajaran'][$y]);
	xlsWriteLabel($xlsRow,6,$data['periode'][$y]);
	$xlsRow++;
}
xlsEOF();
exit();