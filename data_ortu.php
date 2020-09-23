<?php
if($domain!=='admin'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>
<?php
if($_GET['mode']=='input'){	
	$nama_orangtua=ucwords(htmlentities($_POST['nama_orangtua']));
	$kelamin=htmlentities($_POST['kelamin']);
	$status_keluarga=htmlentities($_POST['status_keluarga']);
	$pekerjaan=htmlentities($_POST['pekerjaan']);
	$alamat_orangtua=ucwords(htmlentities($_POST['alamat_orangtua']));
	$telpon_orangtua=strtoupper(htmlentities($_POST['telpon_orangtua']));
	$username=htmlentities($_POST['username']);
	$password=md5(htmlentities($_POST['password']));
	$email=htmlentities($_POST['email']);
	$nama_photo=$_FILES['photo']['name'];
		
	$cek=mysqli_num_rows(mysqli_query($link,"select * from tbl_user_pesan where username='$username'"));
	
	if($cek>0){
		?><script language="javascript">document.location.href="?page=data_ortu&status=4";</script><?php
	}else{
		$uploaddir='./photo_ortu/';
		$rnd=date(His);				
		$nama_file_upload=$rnd.'-'.$nama_photo;
		$alamatfile=$uploaddir.$nama_file_upload;
		
		if (move_uploaded_file($_FILES['photo']['tmp_name'],$alamatfile))
		{
			$query=mysqli_query($link,"insert into data_orangtua(nama_orangtua,kelamin,status_keluarga,pekerjaan,alamat_orangtua,telpon_orangtua,username,password,photo,email) values('$nama_orangtua','$kelamin','$status_keluarga','$pekerjaan','$alamat_orangtua','$telpon_orangtua','$username','$password','$nama_file_upload','$email')");
			insert_user($username,$nama_orangtua,'orangtua');
			
			if($query){
				?><script language="javascript">document.location.href="?page=data_ortu&status=1";</script><?php
			}else{
				?><script language="javascript">document.location.href="?page=data_ortu&status=0";</script><?php
			}
			
		}else{
			?><script language="javascript">document.location.href="?page=data_ortu&status=8";</script><?php
		}
	}
}

if($_GET['mode']=='delete'){
	$username=$_GET['username'];
	$id_orangtua=$_GET['id_orangtua'];
	
	$data=mysqli_fetch_array(mysqli_query($link,"select photo from data_guru where id_guru='$id_guru'"));
	$photo=$data['photo'];
	
	delete_user($username);
	unlink("./photo_ortu/".$photo);
	
	$query=mysqli_query($link,"delete from data_orangtua where id_orangtua='$id_orangtua'");
	if($query){
		?><script language="javascript">document.location.href="?page=data_ortu&status=2";</script><?php
	}else{
		?><script language="javascript">document.location.href="?page=data_ortu&status=1";</script><?php
	}
}

if($_GET['mode']=='update'){
	$id_orangtua=$_POST['id_orangtua'];
	$nama_orangtua=$_POST['nama_orangtua'];
	$kelamin=$_POST['kelamin'];
	$status_keluarga=$_POST['status_keluarga'];
	$pekerjaan=$_POST['pekerjaan'];
	$alamat_orangtua=$_POST['alamat_orangtua'];
	$telpon_orangtua=$_POST['telpon_orangtua'];
	$username=$_POST['username'];
	$email=htmlentities($_POST['email']);
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
		?><script language="javascript">document.location.href="?page=data_ortu&status=4";</script><?php
	}else{
		
		if(empty($_FILES['photo']['name'])){
			$nama_file_upload=$photo_lama;
			$query=mysqli_query($link,"update data_orangtua set nama_orangtua='$nama_orangtua', status_keluarga='$status_keluarga', kelamin='$kelamin', alamat_orangtua='$alamat_orangtua', telpon_orangtua='$telpon_orangtua', username='$username', password='$password',photo='$nama_file_upload',pekerjaan='$pekerjaan',email='$email' where id_orangtua='$id_orangtua'");
			
			update_user($username,$username_lama,$nama_orangtua,'orangtua');
		}else{
			$uploaddir='./photo_ortu/';
			$rnd=date(His);				
			$nama_file_upload=$rnd.'-'.$nama_photo;
			$alamatfile=$uploaddir.$nama_file_upload;
			
			if (move_uploaded_file($_FILES['photo']['tmp_name'],$alamatfile))
			{
				$query=mysqli_query($link,"update data_orangtua set nama_orangtua='$nama_orangtua', status_keluarga='$status_keluarga', kelamin='$kelamin', alamat_orangtua='$alamat_orangtua', telpon_orangtua='$telpon_orangtua', username='$username', password='$password',photo='$nama_file_upload',pekerjaan='$pekerjaan',email='$email' where id_orangtua='$id_orangtua'");
								
				update_user($username,$username_lama,$nama_orangtua,'orangtua');
			}else{
				?><script language="javascript">document.location.href="?page=data_ortu&status=8";</script><?php
			}
		}
			
		if($query){
			?><script language="javascript">document.location.href="?page=data_ortu&status=3";</script><?php
		}else{
			?><script language="javascript">document.location.href="?page=data_ortu&status=0";</script><?php
		}			
	}
}

if($_GET['mode']=='edit'){
	$id_orangtua=$_GET['id_orangtua'];
	$edit=mysqli_query($link,"select * from data_orangtua where id_orangtua='$id_orangtua'");

	$data=mysqli_fetch_array($edit);
	$nama_orangtua=$data['nama_orangtua'];
	$kelamin=$data['kelamin'];
	$status_keluarga=$data['status_keluarga'];
	$pekerjaan=$data['pekerjaan'];
	$alamat_orangtua=$data['alamat_orangtua'];
	$telpon_orangtua=$data['telpon_orangtua'];
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
        <h1 class="page-header">Data Induk &raquo; Orangtua/Wali</h1>
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
                            ?><form action="?page=data_ortu&mode=update" enctype="multipart/form-data" method="post" name="postform"><?php 
                        }else{
                            ?><form action="?page=data_ortu&mode=input" enctype="multipart/form-data" method="post" name="postform"><?php
                        }
                        ?>
                        
                        <div class="form-group">
                          <label>Nama Orang Tua </label>
                          <input type="text" class="form-control" id="nama_orangtua" name="nama_orangtua" value="<?php echo $nama_orangtua; ?>"/>
                        </div>
                        
                        <div class="form-group">
                          <label>Kelamin</label>
                          <select name="kelamin"  class="form-control">
                              <option value="laki-laki" <?php if($kelamin=='laki-laki'){ echo "selected"; } ?>>Laki-laki</option>
                              <option value="perempuan" <?php if($kelamin=='perempuan'){ echo "selected"; } ?>>Perempuan</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                          <label>Status Keluarga</label>
                          <select name="status_keluarga"  class="form-control">
                              <option value="bapak" <?php if($status_keluarga=='bapak'){ echo "selected"; } ?>>Bapak</option>
                              <option value="ibu" <?php if($status_keluarga=='ibu'){ echo "selected"; } ?>>Ibu</option>
                              <option value="wali" <?php if($status_keluarga=='wali'){ echo "selected"; } ?>>Wali</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                          <label>Pekerjaan</label>
                          <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="<?php echo $pekerjaan; ?>"/>
                        </div>
                        
                        <div class="form-group">
                          <label>Alamat</label>
                          <textarea id="alamat_orangtua" name="alamat_orangtua" cols="" rows="" class="form-control"><?php echo $alamat_orangtua; ?></textarea>
                        </div>
						
                        <div class="form-group">
                          <label>Telpon </label>
                          <input type="text" class="form-control" id="telpon_orangtua" name="telpon_orangtua" value="<?php echo $telpon_orangtua; ?>"/>
                        </div>

                        <div class="form-group">
                          <label>Email </label>
                          <input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>"/>
                        </div>
                        <div class="form-group">
                            <?php 
                            if(empty($photo)){
                                $photo_ortu='nopic.jpg';
                            }else{
                                $photo_ortu=$photo;
                            }
                            ?>
                            <img src="./photo_ortu/<?php echo $photo_ortu;?>" height="101" width="83">
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
                                <input type="hidden" name="id_orangtua" value="<?php echo $_GET['id_orangtua'];?>">
                                <input type="hidden" name="password_lama" value="<?php echo $password_lama;?>">
                                <input type="hidden" name="username_lama" value="<?php echo $username_lama;?>">
                                <input type="hidden" name="photo_lama" value="<?php echo $photo;?>">
                                <input type="submit" name="submit" onClick="return cek_ortu()" value="Submit" class="btn btn-primary" />
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
                    <a href="javascript:;"><img src="./images/excel-icon.jpeg" title="Export Data" width="18" height="18" border="0" onClick="window.open('./excel/export_data_orang_tua.php','scrollwindow','top=200,left=300,width=800,height=500');"></a>
                    </center><br />
                    
                    <center>
					<?php
                    //************awal paging************//
                    $query=mysqli_query($link,"select * from data_orangtua order by nama_orangtua asc");
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
                        <a href="?page=data_ortu&halaman=<?php echo ($pages-1); ?> " style="text-decoration:none"><font size="2" face="verdana" color="#009900"><?php echo $pages; ?></font></a>
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
                    $result=mysqli_query($link,"select * from data_orangtua order by nama_orangtua asc limit $offset,$entries"); //output
                    ?>
                    </center>

            
                    <table class="table table-striped table-bordered table-hover" border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
                    <tr>
                        <th class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a></th>
                        <th class="table-header-repeat line-left minwidth-1"><a href="">Photo</a></th>
                        <th class="table-header-repeat line-left minwidth-1"><a href="">Nama_Orangtua</a></th>
                        <th class="table-header-repeat line-left minwidth-1"><a href="">Status</a></th>
                        <th class="table-header-repeat line-left minwidth-1"><a href="">Pekerjaan</a></th> 
                        <th class="table-header-repeat line-left minwidth-1"><a href="">Telpon</a></th>
                        <th class="table-header-repeat line-left minwidth-1"><a href="">Email</a></th>
                        <!--
                        <th width="11%" class="table-header-repeat line-left minwidth-1"><a href="">Kelamin</a></th>
                        <th width="23%" class="table-header-repeat line-left minwidth-1"><a href="">Alamat</a></th>
                        <th width="9%" class="table-header-repeat line-left minwidth-1"><a href="">Username</a></th>
                        <th width="9%" class="table-header-repeat line-left minwidth-1"><a href="">Password</a></th>
                        -->
                        <th class="table-header-options line-left"><a href="">Aksi</a></th>
                    </tr>
                    
                    
                    <?php                    
                    $no=0;
                    while($row=mysqli_fetch_array($result)){
                    ?>	
                    <tr>
                        <td><?php echo $no=$no+1;?></td>
                        <td>
                        <?php 
                        if(empty($row['photo'])){
                            $photo_ortu='nopic.jpg';
                        }else{
                            $photo_ortu=$row['photo'];
                        }
                        ?>
                        <img src="./photo_ortu/<?php echo $photo_ortu;?>" height="107" width="83" align="middle">
                        </td>
                        <td><?php echo $row['nama_orangtua'];?></td>
                        <td><?php echo ucwords($row['status_keluarga']);?></td>
                        <td><?php echo ucwords($row['pekerjaan']);?></td>
                        <td><?php echo $row['telpon_orangtua'];?></td>
                        <td><?php echo $row['email'];?></td>
                        <!--
                        <td><?php //echo ucwords($row['kelamin']);?></td>
                        <td><?php //echo $row['alamat_orangtua'];?></td>
                        <td><?php //echo $row['username'];?></td>
                        <td><?php //echo $row['password'];?></td>
                        -->
                        <td class="options-width">
                        <a href="?page=data_ortu&mode=delete&id_orangtua=<?php echo $row['id_orangtua'];?>&username=<?php echo $row['username'];?>" onclick="return confirm('Apakah Anda yakin?')" title="Delete" class="icon-2 info-tooltip"><img src="images/delete.png" /></a>
                        <a href="?page=data_ortu&mode=edit&id_orangtua=<?php echo $row['id_orangtua'];?>" title="Edit" class="icon-5 info-tooltip"><img src="images/edit.png" /></a>        
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                    </table>
                    <!--  end product-table................................... --> 
                    <center>TOTAL DATA : <?php echo $get_pages;?></center>
            
            	</div>
        	</div>
        <!--  end  Context Classes  -->
    	</div>
	</div>
</div>
<!-- end page-wrapper -->
