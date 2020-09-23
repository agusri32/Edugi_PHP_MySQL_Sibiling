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
$queabsdetail = "select * from data_guru order by nama_guru asc";
$exequeabsdetail = mysql_query($queabsdetail);
while($res = mysql_fetch_array($exequeabsdetail)){	
	//data
	$data['id_guru'][] 		 = $res['id_guru'];
	$data['nama_guru'][] 	 = $res['nama_guru'];
	$data['nip'][] 			 = $res['nip'];
	$data['kelamin'][] 		 = $res['kelamin'];
	$data['alamat_guru'][] 	 = $res['alamat_guru'];
	$data['telpon_guru'][] 	 = $res['telpon_guru'];
	$data['username'][] 	 = $res['username'];
	$data['password'][] 	 = $res['password'];
	
	$data['gelar'][] 		 = $res['gelar'];
	$data['tempat_lahir'][]  = $res['tempat_lahir'];
	$data['tanggal_lahir'][] = $res['tanggal_lahir'];
	$data['agama'][] 		 = $res['agama'];
	$data['email'][] 		 = $res['email'];
	$data['photos'][]		 = $res['photo'];
} 

$jm = sizeof($data['id_guru']);
header("Pragma: public" );
header("Expires: 0" );
header("Cache-Control: must-revalidate, post-check=0, pre-check=0" );
header("Content-Type: application/force-download" );
header("Content-Type: application/octet-stream" );
header("Content-Type: application/download" );;
header("Content-Disposition: attachment;filename=SINO_Data_guru.xls " );
header("Content-Transfer-Encoding: binary " );
xlsBOF();

xlsWriteLabel(0,3,"Data Guru" );

xlsWriteLabel(2,0,"Nomor" );
xlsWriteLabel(2,1,"Nama_Guru");
xlsWriteLabel(2,2,"NIP");
xlsWriteLabel(2,3,"Kelamin");
xlsWriteLabel(2,4,"Alamat");
xlsWriteLabel(2,5,"Telpon");
xlsWriteLabel(2,6,"Username");
xlsWriteLabel(2,7,"Password");
			
xlsWriteLabel(2,8,"Gelar");
xlsWriteLabel(2,9,"Tempat_Lahir");
xlsWriteLabel(2,10,"Tanggal_Lahir");
xlsWriteLabel(2,11,"Agama");
xlsWriteLabel(2,12,"Email");
xlsWriteLabel(2,13,"Photo");

$xlsRow = 3;

for ($y=0; $y<$jm; $y++) {
	++$i;
	xlsWriteNumber($xlsRow,0,"$i" );
	
	xlsWriteLabel($xlsRow,1,$data['nama_guru'][$y]);
	xlsWriteLabel($xlsRow,2,$data['nip'][$y]);
	xlsWriteLabel($xlsRow,3,$data['kelamin'][$y]);
	xlsWriteLabel($xlsRow,4,$data['alamat_guru'][$y]);
	xlsWriteLabel($xlsRow,5,$data['telpon_guru'][$y]);
	xlsWriteLabel($xlsRow,6,$data['username'][$y]);
	xlsWriteLabel($xlsRow,7,$data['password'][$y]);
	
	xlsWriteLabel($xlsRow,8,$data['gelar'][$y]);
	xlsWriteLabel($xlsRow,9,$data['tempat_lahir'][$y]);
	xlsWriteLabel($xlsRow,10,$data['tanggal_lahir'][$y]);
	xlsWriteLabel($xlsRow,11,$data['agama'][$y]);
	xlsWriteLabel($xlsRow,12,$data['email'][$y]);
	xlsWriteLabel($xlsRow,13,$data['photos'][$y]);
	
	$xlsRow++;
}
xlsEOF();
exit();