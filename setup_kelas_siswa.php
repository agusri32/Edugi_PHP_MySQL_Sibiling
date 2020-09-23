<?php
if($domain!=='admin'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>
<?php
if($_GET['mode']=='input'){

	$id_siswa=htmlentities($_POST['id_siswa']);
	$id_kelas=htmlentities($_POST['id_kelas']);
	
	$cek_query=mysqli_query($link,"select * from tbl_ruangan where id_siswa='$id_siswa' and id_kelas='$id_kelas'");
	$cek_query2=mysqli_query($link,"select * from tbl_ruangan where id_siswa='$id_siswa'");
	$cek_num=mysqli_num_rows($cek_query);
	$cek_num2=mysqli_num_rows($cek_query2);
	
	if($cek_num!==0 || $cek_num2!==0){	
		?><script language="javascript">document.location.href="?page=setup_kelas_siswa&status=4";</script><?php
	}else{
		$query=mysqli_query($link,"insert into tbl_ruangan values('','$id_siswa','$id_kelas')");
		
		if($query){
			?><script language="javascript">document.location.href="?page=setup_kelas_siswa&status=1";</script><?php
		}
	}
}

if($_GET['mode']=='delete'){
	
	$id_ruangan=$_GET['id_ruangan'];
	$query=mysqli_query($link,"delete from tbl_ruangan where id_ruangan='$id_ruangan'");
	if($query){
		?><script language="javascript">document.location.href="?page=setup_kelas_siswa&status=2";</script><?php
	}
}

if($_GET['mode']=='update'){
	$id_ruangan=$_POST['id_ruangan'];
	
	$id_siswa=$_POST['id_siswa'];
	$id_kelas=$_POST['id_kelas'];
	
	$cek_query=mysqli_query($link,"select * from tbl_ruangan where id_siswa='$id_siswa' and id_kelas='$id_kelas'");
	$cek_num=mysqli_num_rows($cek_query);
	
	if($cek_num!==0){
		?><script language="javascript">document.location.href="?page=setup_kelas_siswa&status=0";</script><?php
	}else{	
	
		$query=mysqli_query($link,"update tbl_ruangan set id_siswa='$id_siswa', id_kelas='$id_kelas' where id_ruangan='$id_ruangan'");
		
		if($query){
			?><script language="javascript">document.location.href="?page=setup_kelas_siswa&status=3";</script><?php
		}else{
			echo mysqli_error();
		}
	}
}

if($_GET['mode']=='edit'){
	$id_ruangan=$_GET['id_ruangan'];
	$edit=mysqli_query($link,"select * from tbl_ruangan where id_ruangan='$id_ruangan'");

	$data=mysqli_fetch_array($edit);
	$id_siswa=$data['id_siswa'];
	$id_kelas=$data['id_kelas'];
}
?>

<!--  page-wrapper -->
<div class="row">
     <!-- page header -->
    <div class="col-lg-12">
        <h1 class="page-header">Setup &raquo; Kelas Siswa</h1>
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
						?><form action="?page=setup_kelas_siswa&mode=update" method="post"><?php 
					}else{
						?><form action="?page=setup_kelas_siswa&mode=input" method="post"><?php
					}
					?>
                    
                  	<div class="form-group">
                      <label>Siswa</label>
                      <select name="id_siswa" class="form-control">
                      <?php
					  $siswa=mysqli_query($link,"select * from data_siswa order by nama_siswa asc");
					  while($row1=mysqli_fetch_array($siswa)){
					  ?>
                          <option value="<?php echo $row1['id_siswa'];?>" <?php if($row1['id_siswa']==$id_siswa){ echo 'selected';}?>><?php echo $row1['nama_siswa'];?> (<?php echo $row1['nis'];?>) </option>
					  <?php
					  }
					  ?>                          
                          
                        </select>
                  	</div>
                    
                    <div class="form-group">
                        <label>Kelas</label>
                      	<select name="id_kelas" class="form-control" >
                          <?php
						  $kelas=mysqli_query($link,"select * from setup_kelas order by nama_kelas asc");
						  while($row2=mysqli_fetch_array($kelas)){
						  ?>
							  <option value="<?php echo $row2['id_kelas'];?>" <?php if($row2['id_kelas']==$id_kelas){ echo 'selected';}?>><?php echo $row2['nama_kelas'];?></option>
						  <?php
						  }
						  ?>    
  
                        </select>
                    </div>
                    
                   	<div class="form-group">
					  		<input type="hidden" name="id_ruangan" value="<?php echo $_GET['id_ruangan'];?>">
					  		<input type="submit" name="submit" onClick="return confirm('Apakah Anda yakin?')" value="Submit" class="btn btn-primary" />
                          	<input type="reset" value="Reset" class="btn btn-success"  />
                     </div>
                    
                    
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
				$query=mysqli_query($link,"select * from tbl_ruangan ruangan, setup_kelas kelas, data_siswa siswa where ruangan.id_kelas=kelas.id_kelas and ruangan.id_siswa=siswa.id_siswa order by id_ruangan asc");
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
					<a href="?page=setup_kelas_siswa&halaman=<?php echo ($pages-1); ?> " style="text-decoration:none"><font size="2" face="verdana" color="#009900"><?php echo $pages; ?></font></a>
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
				$result=mysqli_query($link,"select * from tbl_ruangan ruangan, setup_kelas kelas, data_siswa siswa where ruangan.id_kelas=kelas.id_kelas and ruangan.id_siswa=siswa.id_siswa order by id_ruangan asc limit $offset,$entries"); //output
				?></center>
		
				<table class="table table-striped table-bordered table-hover" border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
					<th width="13%" class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a>	</th>
					<th width="24%" class="table-header-repeat line-left minwidth-1"><a href="">Nama Siswa</a></th>
					<th width="26%" class="table-header-repeat line-left minwidth-1"><a href="">NIS</a></th>
					<th width="24%" class="table-header-repeat line-left minwidth-1"><a href="">Kelas</a></th>
					<th width="13%" class="table-header-options line-left"><a href="">Aksi</a></th>
				</tr>
				
				
				<?php
				$no=0;
				while($row=mysqli_fetch_array($result)){
				?>	
				<tr>
					<td><?php echo $offset=$offset+1;?></td>
					<td><?php echo $row['nama_siswa'];?></td>
					<td><?php echo $row['nis'];?></td>
					<td><?php echo $row['nama_kelas'];?></td>
					<td class="options-width">
					<a href="?page=setup_kelas_siswa&mode=delete&id_ruangan=<?php echo $row['id_ruangan'];?>" onclick="return confirm('Apakah Anda yakin?')" title="Delete" class="icon-2 info-tooltip"><img src="images/delete.png" /></a>
					<a href="?page=setup_kelas_siswa&mode=edit&id_ruangan=<?php echo $row['id_ruangan'];?>" title="Edit" class="icon-5 info-tooltip"><img src="images/edit.png" /></a>                    
					</td>
				</tr>
				<?php
				}
				?>
				</table>
				<center>TOTAL DATA : <?php echo $get_pages;?></center>
				<!--  end product-table................................... --> 

				</div>
        	</div>
        <!--  end  Context Classes  -->
    	</div>
	</div>
</div>
<!-- end page-wrapper -->
