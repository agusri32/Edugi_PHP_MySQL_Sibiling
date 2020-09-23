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

//parameter
$id_kelas=htmlentities($_GET['id_kelas']);

//filter
if($id_kelas!=="0"){
	$filter_kelas="and ruangan.id_kelas='$id_kelas'";
}else{
	$filter_kelas="";
}

			
//query
$queabsdetail = "select * from tbl_ruangan ruangan, setup_kelas kelas, data_siswa siswa where ruangan.id_kelas=kelas.id_kelas and ruangan.id_siswa=siswa.id_siswa $filter_kelas order by id_ruangan asc";
$exequeabsdetail = mysql_query($queabsdetail);
while($res = mysql_fetch_array($exequeabsdetail)){
	$id_kelas=$res['id_kelas'];
	$kelas=mysql_fetch_array(mysql_query("select * from setup_kelas where id_kelas='$id_kelas'"));
	
	//data
	$data['id_siswa'][] = $res['id_siswa'];
	$data['nama_siswa'][] = $res['nama_siswa'];
	$data['nama_kelas'][] = $kelas['nama_kelas'];
} 

$jm = sizeof($data['id_siswa']);
header("Pragma: public" );
header("Expires: 0" );
header("Cache-Control: must-revalidate, post-check=0, pre-check=0" );
header("Content-Type: application/force-download" );
header("Content-Type: application/octet-stream" );
header("Content-Type: application/download" );;
header("Content-Disposition: attachment;filename=SINO_Ruang_Kelas.xls " );
header("Content-Transfer-Encoding: binary " );
xlsBOF();
xlsWriteLabel(0,3,"Data Kelas Siswa" );
xlsWriteLabel(2,0,"Nomor" );
xlsWriteLabel(2,1,"Nama Siswa" );
xlsWriteLabel(2,2,"Nama kelas" );
$xlsRow = 3;

for ($y=0; $y<$jm; $y++) {
	++$i;
	xlsWriteNumber($xlsRow,0,"$i" );
	xlsWriteLabel($xlsRow,1,$data['nama_siswa'][$y]);
	xlsWriteLabel($xlsRow,2,$data['nama_kelas'][$y]);
	$xlsRow++;
}
xlsEOF();
exit();