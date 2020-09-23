<?php
if($domain!=='admin'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>

<?php
if($_GET['mode']=='input'){
	
	$nama_admin=ucwords(htmlentities($_POST['nama_admin']));
	$email=htmlentities($_POST['email']);
	$username=htmlentities($_POST['username']);
	$password=md5(htmlentities($_POST['password']));
	
	
	$cek=mysqli_num_rows(mysqli_query($link,"select * from tbl_user_pesan where username='$username'"));
	
	if($cek>0){
		?><script language="javascript">document.location.href="?page=data_admin&status=5";</script><?php
	}else{
			
		$query=mysqli_query($link,"insert into user_admin(nama_admin,username,password,locked,email) values('$nama_admin','$username','$password','no','$email')");
		
		//user pesan
		insert_user($username,$nama_admin,'admin');
		
		if($query){
			?><script language="javascript">document.location.href="?page=data_admin&status=1";</script><?php
		}else{
			?><script language="javascript">document.location.href="?page=data_admin&status=0";</script><?php
		}
		
	}
}


if($_GET['mode']=='delete'){
	$username=$_GET['username'];
	$id_admin=$_GET['id_admin'];
	$query=mysqli_query($link,"delete from user_admin where id_admin='$id_admin'");
	
	//user pesan
	delete_user($username);
	
	if($query){
		?><script language="javascript">document.location.href="?page=data_admin&status=2";</script><?php
	}else{
		?><script language="javascript">document.location.href="?page=data_admin&status=0";</script><?php
	}
}

if($_GET['mode']=='change'){
	
	$locked=$_GET['locked'];
	$id_admin=$_GET['id_admin'];
	
	$query=mysqli_query($link,"UPDATE user_admin SET `locked` = '$locked' WHERE `id_admin`= '$id_admin'");
	if($query){
		?><script language="javascript">document.location.href="?page=data_admin&status=3";</script><?php
	}else{
		?><script language="javascript">document.location.href="?page=data_admin&status=0";</script><?php
	}
}


if($_GET['mode']=='update'){
	$id_admin=$_POST['id_admin'];
	$nama_admin=$_POST['nama_admin'];
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
		?><script language="javascript">document.location.href="?page=data_admin&status=4";</script><?php
	}else{
		
		$query=mysqli_query($link,"update user_admin set nama_admin='$nama_admin',username='$username',password='$password',email='$email' where id_admin='$id_admin'");
	
		//user pesan
		update_user($username,$username_lama,$nama_admin,'admin');
		
		if($query){
			?><script language="javascript">document.location.href="?page=data_admin&status=3";</script><?php
		}else{
			?><script language="javascript">document.location.href="?page=data_admin&status=0";</script><?php
		}	
	}
}

if($_GET['mode']=='edit'){
	$id_admin=$_GET['id_admin'];
	$edit=mysqli_query($link,"select * from user_admin where id_admin='$id_admin'");
	$data=mysqli_fetch_array($edit);
	$nama_admin=$data['nama_admin'];
	$username=$data['username'];
	$email=$data['email'];
	
	$username_lama=$data['username'];
	$password_lama=$data['password'];
}
?>


<!--  page-wrapper -->
<div class="row">
     <!-- page header -->
    <div class="col-lg-12">
        <h1 class="page-header">Data Induk &raquo; Admin</h1>
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
			
					<?php
					if($_GET['mode']=='edit'){
						?><form role="form" action="?page=data_admin&mode=update" method="post"><?php 
					}else{
						?><form role="form" action="?page=data_admin&mode=input" method="post"><?php
					}
					?>

					<div class="form-group">
                      <label>Nama Admin</label>
                      <input type="text" class="form-control" id="nama_admin" name="nama_admin" value="<?php echo $nama_admin; ?>"/>
                    </div>
                    
                    <div class="form-group">
                      <label>Username</label>
                      <input type="text"  class="form-control" id="username" name="username" value="<?php echo $username; ?>"/>
                    </div>
                    
                    <div class="form-group">
                      <label>Email</label>
                      <input type="text"  class="form-control" id="email" name="email" value="<?php echo $email; ?>"/>
                    </div>
                    
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" class="form-control" id="password" name="password" value="<?php echo $password; ?>"/> *Kosogkan jika tidak diubah
                    </div>
                    
                    <div class="form-group">
					  		<input type="hidden" name="id_admin" value="<?php echo $_GET['id_admin'];?>">
							<input type="hidden" name="password_lama" value="<?php echo $password_lama;?>">
							<input type="hidden" name="username_lama" value="<?php echo $username_lama;?>">
					  		<input type="submit" class="btn btn-primary" name="submit" onClick="return cek_admin()" value="Submit" />
                          	<input type="reset" class="btn btn-success" value="Reset" class="form-reset"  />
                    </div>


      
                    </div>
                </div>
            </div>
        </div>
         <!-- End Form Elements -->
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">   
            <div class="panel-body">
                <div class="table-responsive">
                
                <table class="table table-striped table-bordered table-hover" border="0" width="80%" cellpadding="0" cellspacing="0" id="product-table">
                <tr>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a>	</th>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Nama Admin</a></th>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Email</a></th>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Username</a></th>
                    <!--<th class="table-header-repeat line-left minwidth-1"><a href="">Password</a></th>-->
                    <?php 
                    if($domain=="superadmin"){
                        echo "<th class='table-header-repeat line-left minwidth-1'><a href=''>Status</a></th>";
                    }
                    ?>
                    <th class="table-header-options line-left"><a href="">Aksi</a></th>
                </tr>        
                
                <?php
                $view=mysqli_query($link,"select * from user_admin order by nama_admin asc");
                $total=mysqli_num_rows($view);
				
                $no=0;
                while($row=mysqli_fetch_array($view)){
                ?>	
                <tr>
                    <td><?php echo $no=$no+1;?></td>
                    <td><?php echo $row['nama_admin'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $row['username'];?></td>
                    <!--
                    <td><?php //echo $row['password'];?></td>
                    -->
                    <?php 
                    if($domain=="superadmin"){
                        ?>
                    <td>
                        <?php 
                        
                        if($row['locked']=='no'){
                            ?><a href="?page=data_admin&mode=change&locked=yes&id_admin=<?php echo $row['id_admin'];?>" title="Klik untuk mengubah status" onClick="return confirm('Apakah anda yakin akan ubah menjadi locked')"><font color="#0066FF"><b>Active</b></font></a><?php
                        }else{
                            ?><a href="?page=data_admin&mode=change&locked=no&id_admin=<?php echo $row['id_admin'];?>" title="Klik untuk mengubah status" onClick="return confirm('Apakah anda yakin akan ubah menjadi Active')"><font color="#FF0000"><b>Locked</b></font></a><?php
                        }
                        
                        ?></td><?php
                    }
                    ?>
                    <td class="options-width">
                    <a href="?page=data_admin&mode=delete&id_admin=<?php echo $row['id_admin'];?>&username=<?php echo $row['username'];?>" onclick="return confirm('Apakah Anda yakin?')" title="Delete"><img src="images/delete.png" /></a>
                    <a href="?page=data_admin&mode=edit&id_admin=<?php echo $row['id_admin'];?>" title="Edit"><img src="images/edit.png" /></a>        
                    </td>
                </tr>
                <?php
                }
                ?>
                </table>
            	
                <center>TOTAL DATA : <?php echo $total;?></center>

           		</div>
        	</div>
        <!--  end  Context Classes  -->
    	</div>
	</div>
</div>
<!-- end page-wrapper -->
