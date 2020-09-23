<?php
if($domain!=='admin'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}					  
?>
<script type="text/javascript" src="nicEdit.js"></script>
<script type="text/javascript">
bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
<?php $id_guru=$_SESSION['id_guru']; ?>

<!--  page-wrapper -->
<div class="row">
     <!-- page header -->
    <div class="col-lg-12">
        <h1 class="page-header">Laporan &raquo; Detail Pelanggaran</h1>
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
					
                    <form action="?page=laporan_detail_siswa_pelanggaran" method="post">
                    
                    <div class="form-group">
                          <label>Nama Siswa</label>
                          <select name="id_siswa"  class="form-control" name="input">
                          <option value="0">-- Pilih Siswa --</option>
                      <?php
                      $siswa=mysqli_query($link,"select bimbingan.id_bimbingan, siswa.id_siswa, nama_siswa, nis, nama_kelas from tbl_siswa_bimbingan bimbingan, data_siswa siswa, data_guru guru, tbl_ruangan ruangan, setup_kelas kelas where bimbingan.id_siswa=siswa.id_siswa and bimbingan.id_guru=guru.id_guru and ruangan.id_siswa=siswa.id_siswa and ruangan.id_kelas=kelas.id_kelas order by nama_siswa asc");
					  
                      while($row4=mysqli_fetch_array($siswa)){
                      ?>
                          <option value="<?php echo $row4['id_siswa'];?>" <?php if($row4['id_siswa']==$id_siswa){ echo 'selected';}?>><?php echo $row4['nama_siswa'];?> [<?php echo $row4['nis'];?>] [<?php echo $row4['nama_kelas'];?>] </option>
                      <?php
                      }
                      ?>                           
                      </select>
                    </div>
                                   
                    <div class="form-group">
                        <label>Nama Kelas</label>
                      	<select name="id_kelas" class="form-control" >
                        <option value="0">-- Pilih Kelas --</option>
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
                      <label>Nama Guru</label>
                      <select class="form-control" name="id_guru">
                      <option value="0">-- Pilih Guru --</option>
                      <?php
					  $guru=mysqli_query($link,"select * from data_guru");
					  while($row1=mysqli_fetch_array($guru)){
					  ?>
                          <option value="<?php echo $row1['id_guru'];?>" <?php if($row1['id_guru']==$id_guru){ echo 'selected';}?>><?php echo $row1['nama_guru'];?> [<?php echo $row1['nip'];?>] </option>
					  <?php
					  }
					  ?>                          
                      </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Jenis Pelanggaran</label>
                      	<select name="id_jenis" class="form-control" >
                        <option value="0">-- Pilih Jenis Pelanggaran --</option>
                          <?php
						  $jenis=mysqli_query($link,"select * from setup_jenis_pelanggaran order by nama_jenis asc");
						  while($row2=mysqli_fetch_array($jenis)){
						  ?>
							  <option value="<?php echo $row2['id_jenis'];?>" <?php if($row2['id_jenis']==$id_jenis){ echo 'selected';}?>><?php echo $row2['nama_jenis'];?></option>
						  <?php
						  }
						  ?>    
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Jenis Sanksi</label>
                      	<select name="id_sanksi" class="form-control" >
                        <option value="0">-- Pilih Jenis Sanksi --</option>
                          <?php
						  $jenis=mysqli_query($link,"select * from setup_jenis_sanksi order by id_sanksi asc");
						  while($row2=mysqli_fetch_array($jenis)){
						  ?>
							  <option value="<?php echo $row2['id_sanksi'];?>" <?php if($row2['id_sanksi']==$id_jenis){ echo 'selected';}?>><?php echo $row2['nama_sanksi'];?></option>
						  <?php
						  }
						  ?>    
                        </select>
                    </div>
                     
                    <div class="form-group">
                            <input type="submit" name="submit" value="Filter Data" class="btn btn-primary"/>
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
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Nama Siswa</a></th>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Kelas</a></th>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Guru</a></th>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Jenis Pelanggaran</a></th>
                    <th class="table-header-repeat line-left minwidth-1"><a href=""><font color="#FF0000">POIN</font></a></th>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Tanggal Kejadian</a></th>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Jenis Sanksi</a></th>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Keterangan</a></th>
                </tr>
                
                <?php
				if(isset($_POST['submit'])){
					$id_siswa=htmlentities($_POST['id_siswa']);
					$id_guru=htmlentities($_POST['id_guru']);
					$id_kelas=htmlentities($_POST['id_kelas']);
					$id_jenis=htmlentities($_POST['id_jenis']);
					$id_sanksi=htmlentities($_POST['id_sanksi']);
					
					if($id_guru!=="0"){
						$filter_guru="and bimbingan.id_guru='$id_guru'";
					}else{
						$filter_guru="";
					}
					
					if($id_siswa!=="0"){
						$filter_siswa="and bimbingan.id_siswa='$id_siswa'";
					}else{
						$filter_siswa="";
					}
					
					if($id_kelas!=="0"){
						$filter_kelas="and kelas.id_kelas='$id_kelas'";
					}else{
						$filter_kelas="";
					}
					
					if($id_jenis!=="0"){
						$filter_jenis="and jenis.id_jenis='$id_jenis'";
					}else{
						$filter_jenis="";
					}
					
					if($id_sanksi!=="0"){
						$filter_sanksi="and sanksi.id_sanksi='$id_sanksi'";
					}else{
						$filter_sanksi="";
					}
				}else{
					unset($_POST['submit']);
				}
				?>

                
                <?php
                $view=mysqli_query($link,"SELECT pelanggaran.id_pelanggaran, bimbingan.id_bimbingan, siswa.nama_siswa, guru.nama_guru, kelas.nama_kelas, jenis.nama_jenis, sanksi.nama_sanksi, pelanggaran.poin, pelanggaran.keterangan, pelanggaran.tgl_kejadian, pelanggaran.waktu_submit FROM tbl_siswa_pelanggaran pelanggaran, tbl_siswa_bimbingan bimbingan, tbl_ruangan ruangan, setup_jenis_pelanggaran jenis, setup_jenis_sanksi sanksi, setup_kelas kelas, data_siswa siswa, data_guru guru WHERE pelanggaran.id_bimbingan=bimbingan.id_bimbingan and pelanggaran.id_jenis=jenis.id_jenis and pelanggaran.id_sanksi=sanksi.id_sanksi and bimbingan.id_siswa=siswa.id_siswa and bimbingan.id_guru=guru.id_guru and bimbingan.id_siswa=ruangan.id_siswa and ruangan.id_kelas=kelas.id_kelas $filter_guru $filter_siswa $filter_kelas $filter_jenis $filter_sanksi order by id_pelanggaran asc");
				
				$total=mysqli_num_rows($view);
                
                $no=0;
                while($row=mysqli_fetch_array($view)){
                ?>	
                <tr>
                    <td><?php echo $no=$no+1;?></td>
                    <td><?php echo $row['nama_siswa']; ?></td>
                    <td><?php echo $row['nama_kelas']; ?></td>
                    <td><?php echo $row['nama_guru']; ?></td>
                    <td><?php echo $row['nama_jenis']; ?></td>
                    <td><?php echo $row['poin'];?></td>
                    <td><?php echo $row['tgl_kejadian'];?></td>
                    <td><?php echo $row['nama_sanksi'];?></td> 
                    <td><?php echo ucwords($row['keterangan']);?></td>
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


<iframe width=174 height=189 name="gToday:normal:calender/normal.js" id="gToday:normal:calender/normal.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>