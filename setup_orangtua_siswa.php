<?php
if($domain!=='admin'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>
<?php
if($_GET['mode']=='input'){
	$id_ortu=htmlentities($_POST['id_ortu']);
	$id_siswa=htmlentities($_POST['id_siswa']);
	
	$cek_query=mysqli_query($link,"select * from tbl_akses_ortu where id_orangtua='$id_ortu' and id_siswa='$id_siswa'");
	$cek_num=mysqli_num_rows($cek_query);
	
	if($cek_num!==0){	
		?><script language="javascript">document.location.href="?page=setup_orangtua_siswa&status=4";</script><?php
	}else{
		$query=mysqli_query($link,"insert into tbl_akses_ortu values('','$id_ortu','$id_siswa')");
		
		if($query){
			?><script language="javascript">document.location.href="?page=setup_orangtua_siswa&status=1";</script><?php
		}
	}
}

if($_GET['mode']=='delete'){

	$id_akses=$_GET['id_akses'];
	$query=mysqli_query($link,"delete from tbl_akses_ortu where id_akses='$id_akses'");
	if($query){
		?><script language="javascript">document.location.href="?page=setup_orangtua_siswa&status=2";</script><?php
	}
}

if($_GET['mode']=='update'){
	$id_akses=$_POST['id_akses'];
	
	$id_ortu=htmlentities($_POST['id_ortu']);
	$id_siswa=htmlentities($_POST['id_siswa']);
	
	$cek_query=mysqli_query($link,"select * from tbl_akses_ortu where id_orangtua='$id_ortu' and id_siswa='$id_siswa'");
	$cek_num=mysqli_num_rows($cek_query);
	
	if($cek_num!==0){
		?><script language="javascript">document.location.href="?page=setup_orangtua_siswa&status=0";</script><?php
	}else{	
	
		$query=mysqli_query($link,"update tbl_akses_ortu set id_orangtua='$id_ortu', id_siswa='$id_siswa' where id_akses='$id_akses'");
		
		if($query){
			?><script language="javascript">document.location.href="?page=setup_orangtua_siswa&status=3";</script><?php
		}else{
			echo mysqli_error();
		}
	}
}

if($_GET['mode']=='edit'){
	$id_akses=$_GET['id_akses'];
	$edit=mysqli_query($link,"select * from tbl_akses_ortu where id_akses='$id_akses'");

	$data=mysqli_fetch_array($edit);
	$id_ortu=$data['id_orangtua'];
	$id_siswa=$data['id_siswa'];
}
?>

<!--  page-wrapper -->
<div class="row">
     <!-- page header -->
    <div class="col-lg-12">
        <h1 class="page-header">Setup &raquo; Orangtua/Wali Siswa</h1>
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
						?><form action="?page=setup_orangtua_siswa&mode=update" method="post"><?php 
					}else{
						?><form action="?page=setup_orangtua_siswa&mode=input" method="post"><?php
					}
					?>
										
                    <div class="form-group">
                          <label>Nama Orangtua</label>
                          <select name="id_ortu"  class="form-control">
                      <?php
                      $ortu=mysqli_query($link,"select * from data_orangtua order by nama_orangtua asc");
                      while($row=mysqli_fetch_array($ortu)){
                      ?>
                          <option value="<?php echo $row['id_orangtua'];?>" <?php if($row['id_orangtua']==$id_ortu){ echo 'selected';}?>><?php echo $row['nama_orangtua'];?></option>
                      <?php
                      }
                      ?>                          
                      </select>
                      </div>
                    
                    
                    <div class="form-group">
                          <label>Nama Siswa</label>
                          <select name="id_siswa"  class="form-control">
                      <?php
                      $siswa=mysqli_query($link,"select * from data_siswa siswa, tbl_ruangan ruangan, setup_kelas kelas where ruangan.id_siswa=siswa.id_siswa and ruangan.id_kelas=kelas.id_kelas order by nama_siswa asc");
                      while($row4=mysqli_fetch_array($siswa)){
                      ?>
                          <option value="<?php echo $row4['id_siswa'];?>" <?php if($row4['id_siswa']==$id_siswa){ echo 'selected';}?>><?php echo $row4['nama_siswa'];?> [<?php echo $row4['nis'];?>] [<?php echo $row4['nama_kelas'];?>] </option>
                      <?php
                      }
                      ?>                          
                          
                        </select>
                      </div>
                    
                    

                    <div class="form-group">
                            <input type="hidden" name="id_akses" value="<?php echo $_GET['id_akses'];?>">
                            <input type="submit" name="submit" onClick="return confirm('Apakah Anda yakin?')" value="Submit" class="btn btn-primary"/>
                            <input type="reset" value="Reset"  class="btn btn-success"   />
                    </div>   
					</form>
                    
                    
                    
                    
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
                
                
                <table class="table table-striped table-bordered table-hover" border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
                <tr>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a></th>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Photo Ortu</a></th>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Nama Ortu</a></th>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Status</a></th>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Telpon</a></th>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Photo Siswa</a></th>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Nama siswa</a></th>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">NIS</a></th>
                    <th class="table-header-options line-left"><a href="">Aksi</a></th>
                </tr>
                
                
                <?php
                $view=mysqli_query($link,"select orangtua.photo as portu,siswa.photo as posiswa,telpon_orangtua,nis,nama_orangtua,nama_siswa,status_keluarga,id_akses from tbl_akses_ortu akses, data_orangtua orangtua, data_siswa siswa where akses.id_siswa=siswa.id_siswa and akses.id_orangtua=orangtua.id_orangtua order by id_akses asc");
                
                $no=0;
                while($row=mysqli_fetch_array($view)){
                ?>	
                <tr>
                    <td><?php echo $no=$no+1;?></td>
                    <td>
                        <?php 
                        $portu=$row['portu'];
                        if(empty($portu)){
                            $photo_ortu='nopic.jpg';
                        }else{
                            $photo_ortu=$portu;
                        }
                        ?>
                        <div align="center"><img src="./photo_ortu/<?php echo $photo_ortu;?>" height="101" width="83">
                          </div></td>
                    <td><?php echo $row['nama_orangtua'];?></td>
                    <td align="center"><?php echo ucwords($row['status_keluarga']);?></td>
                    <td><?php echo $row['telpon_orangtua'];?></td>
                    <td>
                        <?php 
                        $posiswa=$row['posiswa'];
                        if(empty($posiswa)){
                            $photo_siswa='nopic.jpg';
                        }else{
                            $photo_siswa=$posiswa;
                        }
                        ?>
                        <div align="center"><img src="./photo_siswa/<?php echo $photo_siswa;?>" height="101" width="83">
                          </div></td>
                    <td><?php echo $row['nama_siswa'];?></td>
                    <td><?php echo $row['nis'];?></td>
                    <td class="options-width">
                    <a href="?page=setup_orangtua_siswa&mode=delete&id_akses=<?php echo $row['id_akses'];?>" onclick="return confirm('Apakah Anda yakin?')" title="Delete" class="icon-2 info-tooltip"><img src="images/delete.png" /></a>
                    <a href="?page=setup_orangtua_siswa&mode=edit&id_akses=<?php echo $row['id_akses'];?>" title="Edit" class="icon-5 info-tooltip"><img src="images/edit.png" /></a>            
                    </td>
                </tr>
                <?php
                }
                ?>
                </table>
                
                
                </div>
        	</div>
        <!--  end  Context Classes  -->
    	</div>
	</div>
</div>
<!-- end page-wrapper -->
