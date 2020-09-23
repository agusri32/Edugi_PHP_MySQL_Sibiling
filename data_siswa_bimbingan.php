<?php
if($domain!=='guru'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}					  
?>

<?php
$id_guru=$_SESSION['id_guru'];
if($_GET['mode']=='input'){
	$id_guru=htmlentities($_POST['id_guru']);
	$id_siswa=htmlentities($_POST['id_siswa']);
	
	$cek_query=mysqli_query($link,"select * from tbl_siswa_bimbingan where id_siswa='$id_siswa'");
	$cek_num=mysqli_num_rows($cek_query);
	
	if($cek_num!==0){	
		?><script language="javascript">document.location.href="?page=data_siswa_bimbingan&status=4";</script><?php
	}else{
		$query=mysqli_query($link,"insert into tbl_siswa_bimbingan(id_guru,id_siswa) values('$id_guru','$id_siswa')");
		
		if($query){
			?><script language="javascript">document.location.href="?page=data_siswa_bimbingan&status=1";</script><?php
		}
	}
}

if($_GET['mode']=='delete'){

	$id_bimbingan=$_GET['id_bimbingan'];
	
	$cek_query=mysqli_query($link,"select * from tbl_siswa_pelanggaran where id_bimbingan='$id_bimbingan'");
	$cek_data=mysqli_num_rows($cek_query);
	
	if($cek_data>0){
		?><script language="javascript">document.location.href="?page=data_siswa_bimbingan&status=10";</script><?php
	}else{
		$query=mysqli_query($link,"delete from tbl_siswa_bimbingan where id_bimbingan='$id_bimbingan'");
		if($query){
			?><script language="javascript">document.location.href="?page=data_siswa_bimbingan&status=2";</script><?php
		}
	}
}

if($_GET['mode']=='update'){  	
	$id_bimbingan=$_POST['id_bimbingan'];
	
	$id_guru=htmlentities($_POST['id_guru']);
	$id_siswa=htmlentities($_POST['id_siswa']);
	
	$cek_data=mysqli_num_rows(mysqli_query($link,"select * from tbl_siswa_pelanggaran where id_bimbingan='$id_bimbingan'"));
	
	if($cek_data>0){
		?><script language="javascript">document.location.href="?page=data_siswa_bimbingan&status=10";</script><?php
	}else{
		
		$cek_query=mysqli_query($link,"select * from tbl_siswa_bimbingan where id_siswa='$id_siswa'");
		$cek_num=mysqli_num_rows($cek_query);
		
		if($cek_num!==0){
			?><script language="javascript">document.location.href="?page=data_siswa_bimbingan&status=4";</script><?php
		}else{	
		
			$query=mysqli_query($link,"update tbl_siswa_bimbingan set id_guru='$id_guru', id_siswa='$id_siswa' where id_bimbingan='$id_bimbingan'");
			
			if($query){
				?><script language="javascript">document.location.href="?page=data_siswa_bimbingan&status=3";</script><?php
			}else{
				echo mysqli_error();
			}
		}
	}//akhir cek data
}

if($_GET['mode']=='edit'){
	$id_bimbingan=$_GET['id_bimbingan'];
	$edit=mysqli_query($link,"select * from tbl_siswa_bimbingan where id_bimbingan='$id_bimbingan'");

	$data=mysqli_fetch_array($edit);
	$id_guru=$data['id_guru'];
	$id_siswa=$data['id_siswa'];
}
?>

<!--  page-wrapper -->
<div class="row">
     <!-- page header -->
    <div class="col-lg-12">
        <h1 class="page-header">Siswa Bimbingan</h1>
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
						?><form action="?page=data_siswa_bimbingan&mode=update" method="post"><?php 
					}else{
						?><form action="?page=data_siswa_bimbingan&mode=input" method="post"><?php
					}
					?>
					
                    <div class="form-group">
                      <label>Nama Guru</label>
                      <select class="form-control" placeholder="Disabled input" disabled>
                      <?php
					  $guru=mysqli_query($link,"select * from data_guru where id_guru='$id_guru'");
					  while($row1=mysqli_fetch_array($guru)){
					  ?>
                          <option value="<?php echo $row1['id_guru'];?>" <?php if($row1['id_guru']==$id_guru){ echo 'selected';}?>><?php echo $row1['nama_guru'];?> [<?php echo $row1['nip'];?>] </option>
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
                            <input type="hidden" name="id_guru"  value="<?php echo $id_guru;?>">
                            <input type="hidden" name="id_bimbingan" value="<?php echo $_GET['id_bimbingan'];?>">
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
				
                <center>
                <?php
                //************awal paging************//
                $query=mysqli_query($link,"select siswa.photo as posiswa, nama_siswa, nis, nama_kelas, ortu.photo as portu, nama_orangtua from tbl_siswa_bimbingan bimbingan, tbl_ruangan ruangan, tbl_akses_ortu aksesortu, data_orangtua ortu, data_siswa siswa,data_guru guru, setup_kelas kelas where bimbingan.id_siswa=siswa.id_siswa and bimbingan.id_siswa=ruangan.id_siswa and ruangan.id_kelas=kelas.id_kelas and bimbingan.id_siswa=aksesortu.id_siswa and aksesortu.id_orangtua=ortu.id_orangtua and bimbingan.id_guru=guru.id_guru  and bimbingan.id_guru='$id_guru' order by siswa.nama_siswa asc");
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
                    <a href="?page=data_siswa_bimbingan&halaman=<?php echo ($pages-1); ?> " style="text-decoration:none"><font size="2" face="verdana" color="#009900"><?php echo $pages; ?></font></a>
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
                $result=mysqli_query($link,"select id_bimbingan, siswa.photo as posiswa, nama_siswa, nis, nama_kelas, ortu.photo as portu, nama_orangtua from tbl_siswa_bimbingan bimbingan, tbl_ruangan ruangan, tbl_akses_ortu aksesortu, data_orangtua ortu, data_siswa siswa,data_guru guru, setup_kelas kelas where bimbingan.id_siswa=siswa.id_siswa and bimbingan.id_siswa=ruangan.id_siswa and ruangan.id_kelas=kelas.id_kelas and bimbingan.id_siswa=aksesortu.id_siswa and aksesortu.id_orangtua=ortu.id_orangtua and bimbingan.id_guru=guru.id_guru  and bimbingan.id_guru='$id_guru' order by siswa.nama_siswa asc limit $offset,$entries"); //output
                ?>
                </center>
                
                
                <table class="table table-striped table-bordered table-hover" border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
                <tr>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a></th>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Photo Siswa</a></th>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Nama Siswa</a></th>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">NIS</a></th>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Kelas</a></th>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Photo Wali</a></th>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Nama Wali</a></th>
                    <th class="table-header-options line-left"><a href="">Aksi</a></th>
                </tr>
                
                
                <?php
                $no=0;
                while($row=mysqli_fetch_array($result)){
                ?>	
                <tr>
                    <td><?php echo $offset=$offset+1;?></td>
                    
                    <td>
                        <?php 
                        $posiswa=$row['posiswa'];
                        if(empty($posiswa)){
                            $photo_siswa='nopic.jpg';
                        }else{
                            $photo_siswa=$posiswa;
                        }
                        ?>
                        <div align="center"><img src="./photo_siswa/<?php echo $photo_siswa;?>" height="101" width="83"></div>
                    </td>
                    
                    <td><?php echo $row['nama_siswa'];?></td>
                    <td><?php echo $row['nis'];?></td>
                    <td><?php echo $row['nama_kelas'];?></td>
                    
                    <td>
                        <?php 
                        $portu=$row['portu'];
                        if(empty($portu)){
                            $photo_ortu='nopic.jpg';
                        }else{
                            $photo_ortu=$portu;
                        }
                        ?>
                        <div align="center"><img src="./photo_ortu/<?php echo $photo_ortu;?>" height="101" width="83"></div>
                    </td>                    
                    <td><?php echo $row['nama_orangtua'];?></td>

                    <td class="options-width">
                    <a href="?page=data_siswa_bimbingan&mode=delete&id_bimbingan=<?php echo $row['id_bimbingan'];?>" onclick="return confirm('Apakah Anda yakin?')" title="Delete" class="icon-2 info-tooltip"><img src="images/delete.png" /></a>
                    <a href="?page=data_siswa_bimbingan&mode=edit&id_bimbingan=<?php echo $row['id_bimbingan'];?>" title="Edit" class="icon-5 info-tooltip"><img src="images/edit.png" /></a>            
                    </td>
                </tr>
                <?php
                }
                ?>
                </table>
                
                <center>TOTAL DATA : <?php echo $get_pages;?></center>
                
                </div>
        	</div>
        <!--  end  Context Classes  -->
    	</div>
	</div>
</div>
<!-- end page-wrapper -->
