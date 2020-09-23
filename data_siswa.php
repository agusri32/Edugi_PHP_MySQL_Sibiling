<?php
if($domain!=='admin'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>
<?php
if($_GET['mode']=='input'){
	
	$nama_siswa=ucwords(htmlentities($_POST['nama_siswa']));
	$nis=htmlentities($_POST['nis']);
	$kelamin=htmlentities($_POST['kelamin']);
	$alamat_siswa=ucwords(htmlentities($_POST['alamat_siswa']));
	$telpon_siswa=strtoupper(htmlentities($_POST['telpon_siswa']));
	$username=htmlentities($_POST['username']);
	$password=md5(htmlentities($_POST['password']));
	$email=$_POST['email'];
	$nama_photo=$_FILES['photo']['name'];
	
	$cek=mysqli_num_rows(mysqli_query($link,"select * from tbl_user_pesan where username='$username'"));
	
	if($cek>0){
		?><script language="javascript">document.location.href="?page=data_siswa&status=5";</script><?php
	}else{
		$uploaddir='./photo_siswa/';
		$rnd=date(His);				
		$nama_file_upload=$rnd.'-'.$nama_photo;
		$alamatfile=$uploaddir.$nama_file_upload;
		
		if (move_uploaded_file($_FILES['photo']['tmp_name'],$alamatfile))
		{
		
			$query=mysqli_query($link,"insert into data_siswa(nama_siswa,nis,kelamin,alamat_siswa,telpon_siswa,username,password,locked,id_periode,photo,email) values('$nama_siswa','$nis','$kelamin','$alamat_siswa','$telpon_siswa','$username','$password','no','$id_periode','$nama_file_upload','$email')");
			
			//user pesan
			insert_user($username,$nama_siswa,'siswa');
			
			if($query){
				?><script language="javascript">document.location.href="?page=data_siswa&status=1";</script><?php
			}
			
		}else{
			?><script language="javascript">document.location.href="?page=data_siswa&status=8";</script><?php
		}
	}
}

if($_GET['mode']=='delete'){
	$username=$_GET['username'];
	$id_siswa=$_GET['id_siswa'];
	
	$data=mysqli_fetch_array(mysqli_query($link,"select photo from data_siswa where id_siswa='$id_siswa'"));
	$photo=$data['photo'];
	
	//user pesan
	delete_user($username);
	unlink("./photo_siswa/".$photo);
	
	$query=mysqli_query($link,"delete from data_siswa where id_siswa='$id_siswa'");
	
	if($query){
		?><script language="javascript">document.location.href="?page=data_siswa&status=2";</script><?php
	}else{
		?><script language="javascript">document.location.href="?page=data_siswa&status=0";</script><?php
	}
}

if($_GET['mode']=='change'){
	
	$locked=$_GET['locked'];
	$id_siswa=$_GET['id_siswa'];
	
	$query=mysqli_query($link,"UPDATE data_siswa SET `locked` = '$locked' WHERE `id_siswa`= '$id_siswa'");
	if($query){
		?><script language="javascript">document.location.href="?page=data_siswa&status=3";</script><?php
	}else{
		?><script language="javascript">document.location.href="?page=data_siswa&status=0";</script><?php
	}
}


if($_GET['mode']=='update'){
	$id_siswa=$_POST['id_siswa'];
	$nama_siswa=$_POST['nama_siswa'];
	$nis=$_POST['nis'];
	$kelamin=$_POST['kelamin'];
	$alamat_siswa=$_POST['alamat_siswa'];
	$telpon_siswa=$_POST['telpon_siswa'];
	$username=$_POST['username'];
	$email=$_POST['email'];
	
	$username_lama=$_POST['username_lama'];
	$password_lama=$_POST['password_lama'];
	
	$photo_lama=$_POST['photo_lama'];
	$nama_photo=$_FILES['photo']['name'];
	
	if(empty($_POST['password'])){
		$password=$password_lama;
	}else{
		$password=md5($_POST['password']);
	}
	
	$cek=mysqli_num_rows(mysqli_query($link,"select * from tbl_user_pesan where username='$username' && username<>'$username_lama'"));
	
	if($cek>0){
		?><script language="javascript">document.location.href="?page=data_siswa&status=5";</script><?php
	}else{
		
		if(empty($_FILES['photo']['name'])){
			$nama_file_upload=$photo_lama;		
			
			//setelah dilakukan pengecekan username
			$query=mysqli_query($link,"update data_siswa set nama_siswa='$nama_siswa',nis='$nis',kelamin='$kelamin',alamat_siswa='$alamat_siswa', telpon_siswa='$telpon_siswa',username='$username',password='$password',photo='$nama_file_upload',email='$email' where id_siswa='$id_siswa'");
			
			update_user($username,$username_lama,$nama_siswa,'siswa');
		}else{
			$uploaddir='./photo_siswa/';
			$rnd=date(His);				
			$nama_file_upload=$rnd.'-'.$nama_photo;
			$alamatfile=$uploaddir.$nama_file_upload;
			
			if (move_uploaded_file($_FILES['photo']['tmp_name'],$alamatfile))
			{
			
				//setelah dilakukan pengecekan username
				$query=mysqli_query($link,"update data_siswa set nama_siswa='$nama_siswa', nis='$nis', kelamin='$kelamin', alamat_siswa='$alamat_siswa', telpon_siswa='$telpon_siswa',username='$username',password='$password',photo='$nama_file_upload',email='$email' where id_siswa='$id_siswa'");
				
				//user pesan
				unlink("./photo_siswa/".$photo_lama);
				update_user($username,$username_lama,$nama_siswa,'siswa');
			}else{
				?><script language="javascript">document.location.href="?page=data_siswa&status=8";</script><?php
			}
		}
		
		if($query){
			?><script language="javascript">document.location.href="?page=data_siswa&status=3";</script><?php
		}else{
			?><script language="javascript">document.location.href="?page=data_siswa&status=0";</script><?php
		}		
	}
}

if($_GET['mode']=='edit'){
	$id_siswa=$_GET['id_siswa'];
	$edit=mysqli_query($link,"select * from data_siswa where id_siswa='$id_siswa'");

	$data=mysqli_fetch_array($edit);
	$nama_siswa=$data['nama_siswa'];
	$nis=$data['nis'];
	$kelamin=$data['kelamin'];
	$alamat_siswa=$data['alamat_siswa'];
	$telpon_siswa=$data['telpon_siswa'];
	$username=$data['username'];
	
	$username_lama=$data['username'];
	$password_lama=$data['password'];
	$email=$data['email'];
	$photo=$data['photo'];
}
?>

<!--  page-wrapper -->
<div class="row">
     <!-- page header -->
    <div class="col-lg-12">
        <h1 class="page-header">Data Induk &raquo; Siswa</h1>
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
                        ?><form action="?page=data_siswa&mode=update" enctype="multipart/form-data" method="post" name="postform"><?php 
                    }else{
                        ?><form action="?page=data_siswa&mode=input" enctype="multipart/form-data" method="post" name="postform"><?php
                    }
                    ?>

                     <div class="form-group">
                          <label>Nama Siswa </label>
                          <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?php echo $nama_siswa; ?>"/>  
                     </div>
                     
                     <div class="form-group">
                          <label>NIS</label><input type="text" class="form-control" id="nis" name="nis" value="<?php echo $nis; ?>"/>  
                     </div>
                     
                     <div class="form-group">
                          <label>Kelamin</label>
                      	<select name="kelamin"  class="form-control">
                          <option value="laki-laki" <?php if($data['kelamin']=='laki-laki'){ echo "selected"; } ?>>Laki-laki</option>
                          <option value="perempuan" <?php if($data['kelamin']=='perempuan'){ echo "selected"; } ?>>Perempuan</option>
                        </select>
                     </div>
                     
                     <div class="form-group">
                          <label>Alamat</label>
                          <textarea id="alamat_siswa" name="alamat_siswa" cols="" rows="" class="form-control"><?php echo $alamat_siswa; ?></textarea>  </div>
                     <div class="form-group">
                          <label>Telpon </label><input type="text" class="form-control" id="telpon_siswa" name="telpon_siswa" value="<?php echo $telpon_siswa; ?>"/>  </div>
                     <div class="form-group">
                          <label>Email </label><input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>"/>
                     </div>
                    
                    <div class="form-group">
                        <?php 
                        if(empty($photo)){
                            $photo_siswa='nopic.jpg';
                        }else{
                            $photo_siswa=$photo;
                        }
                        ?>
                        <img src="./photo_siswa/<?php echo $photo_siswa;?>" height="101" width="83">
                    </div>
                    
                    <div class="form-group">
                      <label>Photo</label>
                      <input type="file" name="photo" size="30"/>
                    </div>
                     
                    <div class="form-group">
                          <label>Username</label>
                          <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>"/>  
                    </div>
                     
                    <div class="form-group">
                          <label>Password</label>
                          <input type="password" class="form-control" id="password" name="password"/> *Kosogkan jika tidak diubah
                    </div>
                    
                    <div class="form-group">
                            <input type="hidden" name="id_siswa" value="<?php echo $_GET['id_siswa'];?>">
                            <input type="hidden" name="password_lama" value="<?php echo $password_lama;?>">
                            <input type="hidden" name="username_lama" value="<?php echo $username_lama;?>">
                            <input type="hidden" name="photo_lama" value="<?php echo $photo;?>">
                            <input type="submit" name="submit" onClick="return cek_siswa()" value="Submit" class="btn btn-primary" />
                            <input type="reset" value="Reset" class="btn btn-success" />
                    </div>
                       
                  </form>
                  
				<!--
                <i>
                <p> * Data induk tidak disarankan untuk dihapus jika sistem sudah berjalan. 
                <br>* Disarankan hanya untuk update atau insert. 
                <br>* Karena Data yang lama akan menjadi history
                </p>
                </i>
                <br>
                -->
				</div>
            </div>
        </div>
        <!--  end  Context Classes  -->
    </div>
</div>
</div>
<!-- end page-wrapper -->


<!--  start product-table ..................................................................................... -->
<div class="row">
    <div class="col-lg-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">   
            <div class="panel-body">
                <div class="table-responsive">

                <center>
                <a href="javascript:;"><img src="./images/excel-icon.jpeg" title="Export Data" width="18" height="18" border="0" onClick="window.open('./excel/export_data_siswa.php','scrollwindow','top=200,left=300,width=800,height=500');"></a>
                </center><br />
                
                
                <center>
                <?php
                //************awal paging************//
                $query=mysqli_query($link,"select * from data_siswa order by nama_siswa asc");
                $get_pages=mysqli_num_rows($query); //dapatkan jumlah semua data
                
                if ($get_pages>$entries)  //jika jumlah semua data lebih banyak dari nilai awal yang diberikan
                {
                    ?>Halaman : <?php
                    $pages=1;
                    while($pages<=ceil($get_pages/$entries))
                    {
                        if ($pages!=1)
                        {
                            echo " | ";
                        }
                    ?>
                    <!--Membuat link sesuai nama halaman-->
                    <a href="?page=data_siswa&halaman=<?php echo ($pages-1); ?> " style="text-decoration:none"><font size="2" face="verdana" color="#009900"><?php echo $pages; ?></font></a>
                    <?php
                    $pages++;
                    }
                    
                }else{
                    $pages=1;
                }
                
                //**************akhir paging*****************//
                ?>
                </font>
                <?php
                $page=(int)$_GET['halaman'];
                $offset=$page*$entries;
                
                //menampilkan data dengan menggunakan limit sesuai parameter paging yang diberikan
                $result=mysqli_query($link,"select * from data_siswa order by nama_siswa asc limit $offset,$entries"); //output
                ?>
                </center>

                
                
                <table class="table table-striped table-bordered table-hover"  border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
                <tr>
                    <th width="4%" class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a></th>
                    <th width="14%" class="table-header-repeat line-left minwidth-1"><a href="">Photo</a></th>
                    <th width="21%" class="table-header-repeat line-left minwidth-1"><a href="">Nama Siswa</a></th>
                    <th width="7%" class="table-header-repeat line-left minwidth-1"><a href="">NIS</a></th>
                    <th width="10%" class="table-header-repeat line-left minwidth-1"><a href="">Kelamin</a></th>
                    <th width="9%" class="table-header-repeat line-left minwidth-1"><a href="">Telpon</a></th>
                    <th width="11%" class="table-header-repeat line-left minwidth-1"><a href="">Email</a></th>
                    <!--
                    <th width="16%" class="table-header-repeat line-left minwidth-1"><a href="">Alamat</a></th>
                    <th width="8%" class="table-header-repeat line-left minwidth-1"><a href="">Username</a></th>
                    <th width="10%" class="table-header-repeat line-left minwidth-1"><a href="">Password</a></th>
                    -->
                    <?php 
                    if($domain=="superadmin"){
                        echo "<th class='table-header-repeat line-left minwidth-1'><a href=''>Status</a></th>";
                    }
                    ?>
                    <th width="8%" class="table-header-options line-left"><a href="">Aksi</a></th>
                </tr>
                
                
                <?php
                $no=0;
                while($row=mysqli_fetch_array($result)){
                ?>	
                <tr>
                    <td><?php echo $offset=$offset+1;?></td>
                    <td>
                    <?php 
                    if(empty($row['photo'])){
                        $photo_siswa='nopic.jpg';
                    }else{
                        $photo_siswa=$row['photo'];
                    }
                    ?>
                    <img src="./photo_siswa/<?php echo $photo_siswa;?>" height="107" width="83">
                    </td>
                    <td><?php echo $row['nama_siswa'];?></td>
                    <td><?php echo $row['nis'];?></td>
                    <td><?php echo ucwords($row['kelamin']);?></td>
                    <td><?php echo $row['telpon_siswa'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <!--
                    <td><?php echo $row['alamat_siswa'];?></td>
                    <td><?php //echo $row['username'];?></td>
                    <td><?php //echo $row['password'];?></td>
                    -->
                    <?php 
                    if($domain=="superadmin"){
                        ?>
                    <td>
                        <?php 
                        
                        if($row['locked']=='no'){
                            ?><a href="?page=data_siswa&mode=change&locked=yes&id_siswa=<?php echo $row['id_siswa'];?>" title="Klik untuk mengubah status" onClick="return confirm('Apakah anda yakin akan ubah menjadi locked')"><font color="#0066FF"><b>Active</b></font></a><?php
                        }else{
                            ?><a href="?page=data_siswa&mode=change&locked=no&id_siswa=<?php echo $row['id_siswa'];?>" title="Klik untuk mengubah status" onClick="return confirm('Apakah anda yakin akan ubah menjadi Active')"><font color="#FF0000"><b>Locked</b></font></a><?php
                        }
                        
                        ?></td><?php
                    }
                    ?>
                    <td width="0%" class="options-width">
                    <a href="?page=data_siswa&mode=delete&id_siswa=<?php echo $row['id_siswa'];?>&username=<?php echo $row['username'];?>" onclick="return confirm('Apakah Anda yakin?')" title="Delete" class="icon-2 info-tooltip"><img src="images/delete.png" /></a>
                    <a href="?page=data_siswa&mode=edit&id_siswa=<?php echo $row['id_siswa'];?>" title="Edit" class="icon-5 info-tooltip"><img src="images/edit.png" /></a>            </td>
                </tr>
                <?php
                }
                ?>
                </table>
                <center>TOTAL DATA : <?php echo $get_pages;?></center>
                <!--  end product-table................................... -->   
            
	 			</div>
            </div>
        </div>
        <!--  end  Context Classes  -->
    </div>
</div>
<!-- end page-wrapper -->
