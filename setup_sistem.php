<?php
if($domain!=='admin'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>


<?php
if($_GET['mode']=='update'){
	$paging_halaman=$_POST['paging_halaman'];
	$pesan_siswa=$_POST['pesan_siswa'];
	$pesan_ortu=$_POST['pesan_ortu'];
	$logout_otomatis=$_POST['logout_otomatis'];
	$title_web=$_POST['title_web'];
	
	$query1=mysqli_query($link,"update setup_sistem set nilai_setup='$paging_halaman' where nama_setup='paging_halaman'");
	$query2=mysqli_query($link,"update setup_sistem set nilai_setup='$pesan_siswa' where nama_setup='pesan_siswa'");
	$query3=mysqli_query($link,"update setup_sistem set nilai_setup='$logout_otomatis' where nama_setup='logout_otomatis'");
	$query4=mysqli_query($link,"update setup_sistem set nilai_setup='$title_web' where nama_setup='title_web'");
	$query5=mysqli_query($link,"update setup_sistem set nilai_setup='$pesan_ortu' where nama_setup='pesan_ortu'");
	
	if($query1){
		?><script language="javascript">document.location.href="?page=setup_sistem&status=3";</script><?php
	}else{
		?><script language="javascript">document.location.href="?page=setup_sistem&status=0";</script><?php
	}
}


//setting sistem
$setup1=mysqli_fetch_array(mysqli_query($link,"select nilai_setup from setup_sistem where nama_setup='paging_halaman'"));
$setup2=mysqli_fetch_array(mysqli_query($link,"select nilai_setup from setup_sistem where nama_setup='pesan_siswa'"));
$setup3=mysqli_fetch_array(mysqli_query($link,"select nilai_setup from setup_sistem where nama_setup='logout_otomatis'"));
$setup4=mysqli_fetch_array(mysqli_query($link,"select nilai_setup from setup_sistem where nama_setup='title_web'"));
$setup5=mysqli_fetch_array(mysqli_query($link,"select nilai_setup from setup_sistem where nama_setup='pesan_ortu'"));

$paging_halaman=$setup1['nilai_setup'];
$pesan_siswa=$setup2['nilai_setup'];
$logout_otomatis=$setup3['nilai_setup'];
$title_web=$setup4['nilai_setup'];
$pesan_ortu=$setup5['nilai_setup'];
?>

<!--  page-wrapper -->
<div class="row">
     <!-- page header -->
    <div class="col-lg-12">
        <h1 class="page-header">Setup &raquo; Sistem</h1>
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


    
				<form action="?page=setup_sistem&mode=update" method="post">
 	              	<div class="form-group">
                      <label>Title Web </label>
					  <input type="text" class="form-control" id="title_web" name="title_web" value="<?php echo $title_web;?>"/>
                      <img src="./images/informasi.jpg" title="Mengatur Nama Judul Website">
				  	</div>
					
				  	<div class="form-group">
                      <label>Paging Halaman </label>
					  <input type="text" class="form-control" id="paging_halaman" name="paging_halaman" value="<?php echo $paging_halaman; ?>"/>
                      <img src="./images/informasi.jpg" title="Mengatur banyaknya data yang tampil dalam satu halaman">
					</div>

					<div class="form-group">
                      <label>Logout Otomatis</label>
					  <input type="text" title="Isi berapa detik" class="form-control" id="logout_otomatis" name="logout_otomatis" value="<?php echo $logout_otomatis; ?>"/>
                      <img src="./images/informasi.jpg" title="Mengatur waktu logout otomatis dalam satuan detik">
					</div>
                    <div class="form-group">
					  		<input type="submit" name="submit" value="Submit" onClick="return confirm('Apakah Anda yakin?')" value="" class="btn btn-primary" />
                    </div>
                  </table>
      			</form>     
            
                </div>
        	</div>
        <!--  end  Context Classes  -->
    	</div>
	</div>
</div>
<!-- end page-wrapper -->