<?php
if($domain!=='admin'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>

<script type="text/javascript" src="nicEdit.js"></script>
<script type="text/javascript">
bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>


<?php
if(isset($_POST['submit'])){
	$id_kontak=$_POST['id_kontak'];
	$nama_instansi=$_POST['nama_instansi'];
	$nss=$_POST['nss'];
	$kepsek=$_POST['kepsek'];
	$kepsek_nip=$_POST['kepsek_nip'];
	$alamat=$_POST['alamat'];
	$email=$_POST['email'];
	$website=$_POST['website'];
	$telpon=$_POST['telpon'];
	
	$visi=$_POST['visi'];
	$misi=$_POST['misi'];
	
	$photo_lama=$_POST['photo_lama'];
	$nama_photo=$_FILES['photo']['name'];
	
	if(empty($_FILES['photo']['name'])){
		$nama_file_upload=$photo_lama;
		$query=mysqli_query($link,"update setup_kontak_kami set nama_instansi='$nama_instansi',alamat='$alamat',email='$email',telpon='$telpon',misi='$misi',visi='$visi',photo='$nama_file_upload',nss='$nss',website='$website',kepsek='$kepsek',kepsek_nip='$kepsek_nip'  where id_kontak='$id_kontak'");
		
		if($query){
			?><script language="javascript">document.location.href="?page=setup_kontak_logo&status=3";</script><?php
		}else{
			echo  mysqli_error();
		}
	}else{	
		$uploaddir='./logo/';
		$rnd=date(His);				
		$nama_file_upload=$rnd.'-'.$nama_photo;
		$alamatfile=$uploaddir.$nama_file_upload;
		
		if (move_uploaded_file($_FILES['photo']['tmp_name'],$alamatfile))
		{
			$query=mysqli_query($link,"update setup_kontak_kami set nama_instansi='$nama_instansi',alamat='$alamat',email='$email',telpon='$telpon',misi='$misi',visi='$visi',photo='$nama_file_upload',nss='$nss',website='$website',kepsek='$kepsek',kepsek_nip='$kepsek_nip'  where id_kontak='$id_kontak'");
			
			unlink("./logo/".$photo_lama);
				
			if($query){
				?><script language="javascript">document.location.href="?page=setup_kontak_logo&status=3";</script><?php
			}else{
				echo  mysqli_error();	
			}
			
		}else{
			?><script language="javascript">document.location.href="?page=setup_kontak_logo&status=8";</script><?php
		}
	}
}
?>


<!--  page-wrapper -->
<div class="row">
     <!-- page header -->
    <div class="col-lg-12">
        <h1 class="page-header">Setup &raquo; Kontak & Logo Sekolah</h1>
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
					$data=mysqli_fetch_array(mysqli_query($link,"select * from setup_kontak_kami"));
						$id_kontak=$data['id_kontak'];
						$nama_instansi=$data['nama_instansi'];
						$nss=$data['nss'];
						$kepsek=$data['kepsek'];
						$kepsek_nip=$data['kepsek_nip'];
						$alamat=$data['alamat'];
						$email=$data['email'];
						$website=$data['website'];
						$telpon=$data['telpon'];
				
						$visi=$data['visi'];
						$misi=$data['misi'];
						
						$photo=$data['photo'];
		
					?>
					<?php include "warning.php"; ?>    
                    
                    <form action="?page=setup_kontak_logo" enctype="multipart/form-data" method="post" name="postform">
                   	
                     <div class="form-group">
                        <label>Nama Sekolah </label>
                      	<input type="text" class="form-control" name="nama_instansi" size="45" value="<?php echo $nama_instansi;?>">
                        </div>
                    <div class="form-group">
                        <label>NSS</label>
                      	<input type="text" class="form-control" name="nss" size="45" title="Nomor Statistik Sekolah(NSS)" value="<?php echo $nss;?>">
                      	</div>
                     <div class="form-group">
                        <label>Kepala Sekolah</label>
                      	<input type="text" class="form-control" name="kepsek" size="45" value="<?php echo $kepsek;?>">
                        </div>
                     <div class="form-group">
                        <label>NIP Kep.Sekolah</label>
                      	<input type="text" class="form-control" name="kepsek_nip" size="45" value="<?php echo $kepsek_nip;?>"></div>
					<div class="form-group">
                       	<label>Alamat </label>
                        <textarea class="form-control" name="alamat" style="width: 300px; height: 100px;">
                        <?php echo $alamat;?>
                        </textarea>
                        </div>
                     <div class="form-group">
                        <label>Email</label>
                     	<input type="text" class="form-control" name="email" value="<?php echo $email;?>">
                        </div>
                     <div class="form-group">
                        <label>Website</label>
                      	<input type="text" class="form-control"  name="website" value="<?php echo $website;?>">
                        </div>
                    <div class="form-group">
                        <label>Telpon</label>
                      	<input type="text" class="form-control" name="telpon" value="<?php echo $telpon;?>">
                        </div>
					<div class="form-group">
                        <label>Visi</label>
                          <textarea name="visi" class="form-control" style="width: 300px; height: 100px;">
                          <?php echo $visi;?>
                          </textarea>
                        </div>
					<div class="form-group">
                        <label>Misi</label>
					  <textarea name="misi" class="form-control" style="width: 300px; height: 100px;">
					  <?php echo $misi;?>
					  </textarea>					  
					</div>
					<div class="form-group">
						<?php 
						if(empty($photo)){
							$logo='';
						}else{
							$logo=$photo;
							?><img src="./logo/<?php echo $logo;?>" width="100" height="100"><?php
						}
						?>
					  </div>
					<div class="form-group">
                    	<label>LOGO INSTANSI</label>
					  	<input type="file" class="form-control" name="photo" size="30"/>
                    </div>
					<div class="form-group">                         
					  <input type="hidden" name="id_kontak" value="<?php echo $id_kontak;?>">
					  <input type="hidden" name="photo_lama" value="<?php echo $photo;?>">
					  <input type="submit" name="submit" value="Update" onClick="return confirm('Apakah Anda yakin?');" class="btn btn-primary">
                    </div>

                  	</form>
                  
                    
 					 </div>
                </div>
            </div>
        </div>
         <!-- End Form Elements -->
    </div>
</div>