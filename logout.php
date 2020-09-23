<?php  session_start();
include "conn.php";

$mode=$_GET['mode'];
if($mode=='timeout'){
	$str="Anda sudah Keluar - Waktu Timeout";
}else{
	$str="Anda sudah Keluar";
}

$username=$_SESSION['username'];
user_offline($username);

if(isset($_SESSION['username']))
{
	session_destroy();
	?><script language="javascript">document.location.href='index.php?status=<?php echo $str;?>';</script><?php
}else{
	session_destroy();
	?><script language="javascript">document.location.href='index.php?status=Silahkan Login!';</script><?php
}
?>