<?php
if(!isset($_SESSION['domain'])){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>
<?php
if(isset($_GET['page'])){
	$page=$_GET['page'];	
	$file="$page.php";
	
	if (!file_exists($file)){
		include ("user_dashboard.php");
	}else{
		include ("$page.php");
	}
}else{
	include ("user_dashboard.php");
}
?>