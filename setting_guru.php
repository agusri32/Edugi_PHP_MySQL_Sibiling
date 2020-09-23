<?php
if($domain!=='guru'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>


<?php
if($_GET['mode']=='update'){
	$id_guru=$_POST['id_guru'];
	$nama_guru=$_POST['nama_guru'];
	$username=$_POST['username'];
	$email=$_POST['email'];
	
	$username_lama=$_POST['username_lama'];
	$password_lama=$_POST['password_lama'];
	
	if(empty($_POST['password'])){
		$password=$password_lama;
	}else{
		$password=md5($_POST['password']);
	}
	
	$cek=mysqli_num_rows(mysqli_query($link,"select * from tbl_user_pesan where username='$username' && username<>'$username_lama'"));
	
	if($cek>0){
		?><script language="javascript">document.location.href="?page=setting_guru&status=4";</script><?php
	}else{		
		//setelah dilakukan pengecekan username
		$query=mysqli_query($link,"update data_guru set username='$username',nama_guru='$nama_guru',email='$email', password='$password' where id_guru='$id_guru'");
		
		//user pesan
		update_user($username,$username_lama,$nama_guru,'guru');
		
		if($query){
			?><script language="javascript">document.location.href="?page=setting_guru&status=3";</script><?php
		}else{
			?><script language="javascript">document.location.href="?page=setting_guru&status=0";</script><?php
		}
	}
}

$id_guru=$_SESSION['id_guru'];
$edit=mysqli_query($link,"select * from data_guru where id_guru='$id_guru'");

$data=mysqli_fetch_array($edit);
$nama_guru=$data['nama_guru'];
$nip=$data['nip'];
$kelamin=$data['kelamin'];
$alamat_guru=$data['alamat_guru'];
$telpon_guru=$data['telpon_guru'];
$username=$data['username'];
$email=$data['email'];

$username_lama=$data['username'];
$password_lama=$data['password'];
$photo=$data['photo'];
?>

<!--  page-wrapper -->
<div class="row">
     <!-- page header -->
    <div class="col-lg-12">
        <h1 class="page-header">Setup Account</h1>
    </div>
    <!--end page header -->
</div>


<div class="row">
    <div class="col-lg-12">
        <!-- Form Elements -->
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
    		
					<?php
                    include "warning.php";
                    ?>
    
					<form action="?page=setting_guru&mode=update" method="post">
                    <input type="hidden" name="id_guru" value="<?php echo $id_guru;?>">
                    <input type="hidden" name="password_lama" value="<?php echo $password_lama;?>">
                    <input type="hidden" name="username_lama" value="<?php echo $username_lama;?>">
                    
                    <div class="form-group">
                        <label>Nama</label>
                        <input class="form-control" type="text" value="<?php echo $nama_guru; ?>" id="nama_guru" name="nama_guru">
                    </div>
                    
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>"/>
                    </div>
                      
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>"/>
                    </div>
                     
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" value="<?php echo $password; ?>"/> *Kosogkan password jika tidak diubah
                    </div>
                    <input type="submit" class="btn btn-primary" name="submit" onClick="return confirm('Apakah Anda yakin?')" value="Submit" />
               		</form>
			
			
                    </div>
                </div>
            </div>
        </div>
         <!-- End Form Elements -->
    </div>
</div>