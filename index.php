<?php  session_start();

//koneksi terpusat
include "conn.php";

?>
<!--
<script language="javascript">document.location.href='maintenance.php';</script>
-->
<?php
if(isset($_SESSION['username'])){
	?><script language="javascript">document.location.href='home.php';</script><?php
}

if (isset($_POST['login'])){
	$username=$_POST['username'];
	$password=md5($_POST['password']);
	$domain=$_POST['domain'];
	
	//dapatkan id user pesan
	$row=mysqli_fetch_array(mysqli_query($link,"select id_user from tbl_user_pesan where username='$username'"));
	$id_user=$row['id_user'];
		
	if($domain=="admin"){
		$query=mysqli_query($link,"select * from user_admin where username='$username' and password='$password' and `locked`='no'");
		
		$data=mysqli_fetch_array(mysqli_query($link,"select * from user_admin where username='$username' and password='$password'"));
		$locked=$data['locked'];
		
		if($locked=='yes'){
			$ket=" - Locked";
		}else{
			$ket="";
		}
				
		$cek=mysqli_num_rows($query);
		$row=mysqli_fetch_array($query);
		$id_admin=$row['id_admin'];
		$nama_admin=$row['nama_admin'];
		$locked=$row['locked'];
		
		if($cek){
			$_SESSION['id_user']=$id_user;
			$_SESSION['username']=$username;
			$_SESSION['id_admin']=$id_admin;
			$_SESSION['domain']=$domain;
			$_SESSION['status']="Admin";
			$_SESSION['nama_account']=$nama_admin;
			$_SESSION['waktu']=date("Y-m-d H:i:s");
			login_validate();
			user_online($username);
			
			?><script language="javascript">document.location.href="home.php";</script><?php
			
		}else{
			?><script language="javascript">document.location.href="index.php?status=Gagal Login <?php echo $ket;?>";</script><?php
		}	
	}
	
	if($domain=="guru"){
		$query=mysqli_query($link,"select * from data_guru where username='$username' and password='$password' and `locked`='no'");
		
		$data=mysqli_fetch_array(mysqli_query($link,"select * from data_guru where username='$username' and password='$password'"));
		$locked=$data['locked'];
		
		if($locked=='yes'){
			$ket=" - Locked";
		}else{
			$ket="";
		}
		
		$cek=mysqli_num_rows($query);
		$row=mysqli_fetch_array($query);
		$id_guru=$row['id_guru'];
		$nama_guru=$row['nama_guru'];
		$photo=$row['photo'];
		
		if($cek){
			$_SESSION['id_user']=$id_user;
			$_SESSION['username']=$username;
			$_SESSION['id_guru']=$id_guru;
			$_SESSION['domain']=$domain;
			$_SESSION['status']="Guru";
			$_SESSION['nama_account']=$nama_guru;
			$_SESSION['waktu']=date("Y-m-d H:i:s");
			$_SESSION['photo']=$photo;
			
			login_validate();
			user_online($username);
			
			?><script language="javascript">document.location.href="home.php";</script><?php
			
		}else{
			?><script language="javascript">document.location.href="index.php?status=Gagal Login <?php echo $ket;?>";</script><?php
		}
	}
	
	if($domain=="siswa"){
		$query=mysqli_query($link,"select * from data_siswa where username='$username' and password='$password' and `locked`='no'");
		
		$data=mysqli_fetch_array(mysqli_query($link,"select * from data_siswa where username='$username' and password='$password'"));
		$locked=$data['locked'];
		
		if($locked=='yes'){
			$ket=" - Locked";
		}else{
			$ket="";
		}
		
		$cek=mysqli_num_rows($query);
		$row=mysqli_fetch_array($query);
		$id_siswa=$row['id_siswa'];
		$nama_siswa=$row['nama_siswa'];
		$nama_siswa=$row['nama_siswa'];
		$photo=$row['photo'];
		
		
		$siswa=mysqli_fetch_array(mysqli_query($link,"select siswa.nama_siswa, siswa.nis, kelas.nama_kelas, kelas.id_kelas from tbl_ruangan ruangan, data_siswa siswa, setup_kelas kelas where ruangan.id_siswa=siswa.id_siswa and ruangan.id_siswa='$id_siswa' and ruangan.id_kelas=kelas.id_kelas"));
		$nis=$siswa['nis'];
		$nama_kelas=$siswa['nama_kelas'];
		$id_kelas=$siswa['id_kelas'];
		
		if($cek){
			$_SESSION['id_user']=$id_user;
			$_SESSION['username']=$username;
			$_SESSION['id_siswa']=$id_siswa;
			$_SESSION['domain']=$domain;
			$_SESSION['status']="Siswa";
			$_SESSION['nama_account']=$nama_siswa;
			
			$_SESSION['id_kelas']=$id_kelas;
			$_SESSION['nama_kelas']=$nama_kelas;
			$_SESSION['nis']=$nis;
			$_SESSION['waktu']=date("Y-m-d H:i:s");
			$_SESSION['photo']=$photo;
			
			login_validate();
			user_online($username);
			
			?><script language="javascript">document.location.href="home.php";</script><?php
			
		}else{
			?><script language="javascript">document.location.href="index.php?status=Gagal Login <?php echo $ket;?>";</script><?php
		}
	}
	
	
	if($domain=="ortu"){
		$query=mysqli_query($link,"select * from data_orangtua where username='$username' and password='$password'");
		
		$cek=mysqli_num_rows($query);
		$row=mysqli_fetch_array($query);
		$id_ortu=$row['id_orangtua'];
		$nama_orangtua=$row['nama_orangtua'];
		$photo=$row['photo'];
		
		if($cek){
			$_SESSION['id_user']=$id_user;
			$_SESSION['username']=$username;
			$_SESSION['id_ortu']=$id_ortu;
			$_SESSION['domain']=$domain;
			$_SESSION['status']="Orangtua/Wali";
			$_SESSION['nama_account']=$nama_orangtua;
			$_SESSION['waktu']=date("Y-m-d H:i:s");
			$_SESSION['photo']=$photo;
			login_validate();
			user_online($username);
			
			?><script language="javascript">document.location.href="home.php";</script><?php
			
		}else{
			?><script language="javascript">document.location.href="index.php?status=Gagal Login";</script><?php
		}
	}
}else{
	unset($_POST['login']);
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Bimbingan Konseling (SIBILING)</title>
    <!-- Core CSS - Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
   	<link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>

<body class="body-Login-back">

    <div class="container">
       
        <div class="row">
            <div class="col-md-4 col-md-offset-4 text-center logo-margin ">
              <a href="index.php"><img src="assets/img/logo.png" alt=""/></a>
                </div>
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">                  
                    <div class="panel-heading">
                        <h3 class="panel-title" align="center">
                        <?php 
						if($link){
							
						}else{
							echo "<font face='Courier New, Courier, mono' color=yellow>Gagal Koneksi Database!</font> <br><br>";
						}
						?>
					
						<?php  if(isset($_GET['status'])){ echo "&laquo;".$_GET['status']."&raquo;"; }?>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <form action="index.php" method="post" name="postform">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" name="username" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <div class="form-group">
                                    <select name="domain" class="form-control">
                                        <option value="admin"> ADMIN </option>
                                        <option value="guru"> GURU </option>
                                        <option value="siswa"> SISWA </option>
                                        <option value="ortu"> ORANGTUA / WALI</option>
                                    </select>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" value="Login" name="login" class="btn btn-lg btn-success btn-block">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- Core Scripts - Include with every page -->
    <script src="assets/plugins/jquery-1.10.2.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>

</body>

</html>
