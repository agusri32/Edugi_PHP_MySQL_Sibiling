<?php
if($domain!=='admin'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>
<?php
if($_GET['mode']=='input'){
	
	$nama_kelas=strtoupper(htmlentities($_POST['nama_kelas']));
	$cek=mysqli_num_rows(mysqli_query($link,"select * from setup_kelas where nama_kelas='$nama_kelas'"));
	
	if($cek>0){
		?><script language="javascript">document.location.href="?page=setup_kelas&status=4";</script><?php
	}else{
	
		$query=mysqli_query($link,"insert into setup_kelas(nama_kelas) values('$nama_kelas')");
		
		if($query){
			?><script language="javascript">document.location.href="?page=setup_kelas&status=1";</script><?php
		}
	}	
}

if($_GET['mode']=='delete'){
	
	$id_kelas=$_GET['id_kelas'];
	$query=mysqli_query($link,"delete from setup_kelas where id_kelas='$id_kelas'");
	if($query){
		?><script language="javascript">document.location.href="?page=setup_kelas&status=2";</script><?php
	}
}

if($_GET['mode']=='update'){
	$id_kelas=$_POST['id_kelas'];
	$nama_kelas=strtoupper(htmlentities($_POST['nama_kelas']));
	
	$cek=mysqli_num_rows(mysqli_query($link,"select * from setup_kelas where nama_kelas='$nama_kelas'"));
	
	if($cek>0){
		?><script language="javascript">document.location.href="?page=setup_kelas&status=4";</script><?php
	}else{	
		$query=mysqli_query($link,"update setup_kelas set nama_kelas='$nama_kelas' where id_kelas='$id_kelas'");
		
		if($query){
			?><script language="javascript">document.location.href="?page=setup_kelas&status=3";</script><?php
		}
	}
}

if($_GET['mode']=='edit'){
	$id_kelas=$_GET['id_kelas'];
	$edit=mysqli_query($link,"select * from setup_kelas where id_kelas='$id_kelas'");

	$data=mysqli_fetch_array($edit);
	$nama_kelas=$data['nama_kelas'];
}
?>

<!--  page-wrapper -->
<div class="row">
     <!-- page header -->
    <div class="col-lg-12">
        <h1 class="page-header">Setup &raquo; Nama Kelas</h1>
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
						?><form action="?page=setup_kelas&mode=update" method="post"><?php 
					}else{
						?><form action="?page=setup_kelas&mode=input" method="post"><?php
					}
					?>
                    
                    <div class="form-group">
                        <label>Nama Kelas </label>
                      	<input type="text" class="form-control" id="nama_kelas" name="nama_kelas" value="<?php echo $data['nama_kelas'];?>"/>
                    </div>
                    
                    <div class="form-group">
                            <input type="hidden" name="id_kelas" value="<?php echo $_GET['id_kelas'];?>">
                            <input type="submit" name="submit" onClick="return cek_kelas()" value="Submit" class="btn btn-primary"  />
                            <input type="reset" value="Reset" class="btn btn-success"  />
                    </div>  
                    </form>
                    
                    <!--
                    <i>
                    <p> * Data di setup tidak disarankan untuk dihapus jika sistem sudah berjalan. 
                    <br>* Disarankan hanya untuk update atau insert. 
                    <br>* Karena Data yang lama akan menjadi history
                    </p>
                    </i>
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
                
                
                <?php
				//************awal paging************//
				$query=mysqli_query($link,"select * from setup_kelas order by nama_kelas asc");
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
					<a href="?page=setup_kelas&halaman=<?php echo ($pages-1); ?> " style="text-decoration:none"><font size="2" face="verdana" color="#009900"><?php echo $pages; ?></font></a>
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
				$result=mysqli_query($link,"select * from setup_kelas order by nama_kelas asc limit $offset,$entries"); //output
				?>
				
				<!--  start product-table ..................................................................................... -->
				<table class="table table-striped table-bordered table-hover"  border="0" width="50%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
					<th class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a>	</th>
					<th class="table-header-repeat line-left minwidth-1"><a href="">Nama Kelas </a></th>
					<th class="table-header-options line-left"><a href="">Aksi</a></th>
				</tr>
				
				
				<?php
				$no=0;
				while($row=mysqli_fetch_array($result)){
				?>	
				<tr>
					<td><?php echo $offset=$offset+1;?></td>
					<td><?php echo $row['nama_kelas'];?></td>
					<td class="options-width">
					<a href="?page=setup_kelas&mode=delete&id_kelas=<?php echo $row['id_kelas'];?>" onclick="return confirm('Apakah Anda yakin?')" title="Delete" class="icon-2 info-tooltip"><img src="images/delete.png" /></a>
					<a href="?page=setup_kelas&mode=edit&id_kelas=<?php echo $row['id_kelas'];?>" title="Edit" class="icon-5 info-tooltip"><img src="images/edit.png" /></a>            
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
