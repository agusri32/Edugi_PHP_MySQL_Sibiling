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

//query
$queabsdetail = "select * from data_siswa order by nama_siswa asc";
$exequeabsdetail = mysql_query($queabsdetail);
while($res = mysql_fetch_array($exequeabsdetail)){
	//data
	$data['id_siswa'][] 	= $res['id_siswa'];
	$data['nama_siswa'][] 	= $res['nama_siswa'];
	$data['nis'][] 			= $res['nis'];
	$data['kelamin'][] 		= $res['kelamin'];
	$data['alamat_siswa'][] = $res['alamat_siswa'];
	$data['telpon_siswa'][] = $res['telpon_siswa'];
	$data['email'][] 		= $res['email'];
	$data['username'][] 	= $res['username'];
	$data['password'][] 	= $res['password'];
	$data['photos'][] 		= $res['photo'];
} 

$jm = sizeof($data['id_siswa']);
header("Pragma: public" );
header("Expires: 0" );
header("Cache-Control: must-revalidate, post-check=0, pre-check=0" );
header("Content-Type: application/force-download" );
header("Content-Type: application/octet-stream" );
header("Content-Type: application/download" );;
header("Content-Disposition: attachment;filename=SINO_Data_Siswa.xls " );
header("Content-Transfer-Encoding: binary " );
xlsBOF();
xlsWriteLabel(0,3,"Data Siswa" );

xlsWriteLabel(2,0,"Nomor" );
xlsWriteLabel(2,1,"Nama_Siswa" );
xlsWriteLabel(2,2,"NIS" );
xlsWriteLabel(2,3,"Kelamin" );
xlsWriteLabel(2,4,"Alamat" );
xlsWriteLabel(2,5,"Telpon" );
xlsWriteLabel(2,6,"Username" );
xlsWriteLabel(2,7,"Password" );
xlsWriteLabel(2,8,"Email" );
xlsWriteLabel(2,9,"Photo" );

$xlsRow = 3;

for ($y=0; $y<$jm; $y++) {
	++$i;
	xlsWriteNumber($xlsRow,0,"$i" );
	
	xlsWriteLabel($xlsRow,1,$data['nama_siswa'][$y]);
	xlsWriteLabel($xlsRow,2,$data['nis'][$y]);
	xlsWriteLabel($xlsRow,3,$data['kelamin'][$y]);
	xlsWriteLabel($xlsRow,4,$data['alamat_siswa'][$y]);
	xlsWriteLabel($xlsRow,5,$data['telpon_siswa'][$y]);
	xlsWriteLabel($xlsRow,6,$data['username'][$y]);
	xlsWriteLabel($xlsRow,7,$data['password'][$y]);
	xlsWriteLabel($xlsRow,8,$data['email'][$y]);
	xlsWriteLabel($xlsRow,9,$data['photos'][$y]);

	$xlsRow++;
}
xlsEOF();
exit();