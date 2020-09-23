<?php
if(!isset($_SESSION['domain'])){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>

<?php
/*
green > input
yellow > delete
blue > edit
red > error
*/

if($_GET['status']=='0'){
?>
<div class="alert alert-danger">
<table border="0" width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td class="red-left">Terdapat Kesalahan! <?php echo mysqli_error();?></td>
</tr>
</table>
</div>
<?php
}

if($_GET['status']=='1'){
?>
<div class="alert alert-success">
<table border="0" width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td class="green-left">Data berhasil disimpan</td>
</tr>
</table>
</div> 
<?php
}

if($_GET['status']=='2'){
?>
<div class="alert alert-success">
<table border="0" width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td class="yellow-left">Data berhasil dihapus</td>
</tr>
</table>
</div> 
<?php
}

if($_GET['status']=='3'){
?>
<div class="alert alert-success">
<table border="0" width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td class="blue-left">Data berhasil diupdate</td>
</tr>
</table>
</div> 
<?php
}

if($_GET['status']=='4'){
?>
<div class="alert alert-warning">
<table border="0" width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td class="red-left">Data yang Anda masukan sudah ada! <?php echo mysqli_error();?></td>
</tr>
</table>
</div>
<?php
}

if($_GET['status']=='5'){
?>
<div class="alert alert-warning">
<table border="0" width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td class="red-left">Username sudah terpakai!<?php echo mysqli_error();?></td>
</tr>
</table>
</div>
<?php
}

if($_GET['status']=='6'){
?>
<div class="alert alert-success">
<table border="0" width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td class="green-left">File Berhasil diupload</td>
</tr>
</table>
</div>
<?php
}

if($_GET['status']=='7'){
?>
<div class="alert alert-success">
<table border="0" width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td class="green-left">Pesan Berhasil dikirim</td>
</tr>
</table>
</div>
<?php
}

if($_GET['status']=='8'){
?>
<div class="alert alert-warning">
<table border="0" width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td class="red-left">Photo Belum diisi</td>
</tr>
</table>
</div>
<?php
}

if($_GET['status']=='9'){
?>
<div class="alert alert-info">
<table border="0" width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td class="green-left">Terimakasih telah mengisi kuesioner.</td>
</tr>
</table>
</div>
<?php
}


if($_GET['status']=='10'){
?>
<div class="alert alert-warning">
<table border="0" width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td class="red-left">Maaf, Tidak dapat melakukan Update atau Delete, karena data pelanggaran Siswa sudah diisi.</td>
</tr>
</table>
</div>
<?php
}

?>