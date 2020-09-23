<?php
if($domain!=='ortu'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}					  
?>
<script type="text/javascript" src="nicEdit.js"></script>
<script type="text/javascript">
bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>

<!--  page-wrapper -->
<div class="row">
     <!-- page header -->
    <div class="col-lg-12">
        <h1 class="page-header">Detail Pelanggaran Siswa</h1>
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
					if($_GET['id_bimbingan']){
						$id_bimbingan=$_GET['id_bimbingan'];
									
						$rows=mysqli_fetch_array(mysqli_query($link,"select id_bimbingan, siswa.photo as posiswa, nama_siswa, nis, nama_kelas, ortu.photo as portu, nama_orangtua from tbl_siswa_bimbingan bimbingan, tbl_ruangan ruangan, tbl_akses_ortu aksesortu, data_orangtua ortu, data_siswa siswa,data_guru guru, setup_kelas kelas where bimbingan.id_siswa=siswa.id_siswa and bimbingan.id_siswa=ruangan.id_siswa and ruangan.id_kelas=kelas.id_kelas and bimbingan.id_siswa=aksesortu.id_siswa and aksesortu.id_orangtua=ortu.id_orangtua and bimbingan.id_guru=guru.id_guru and bimbingan.id_bimbingan='$id_bimbingan' order by id_bimbingan asc"));					
					
					}else{
						?><script language="javascript">document.location.href="?page=data_siswa_pelanggaran"</script><?php
					}
					?>
                    
                     <div class="form-group">
                        <?php 
						$photo=$rows['posiswa'];
                        if(empty($photo)){
                            $photo_siswa='nopic.jpg';
                        }else{
                            $photo_siswa=$photo;
                        }
                        ?>
                        <img src="./photo_siswa/<?php echo $photo_siswa;?>" height="101" width="83">
                     </div>
                     
					 <?php
					 if($_GET['mode']=='edit'){
					 	?><form role="form" action="?page=data_siswa_pelanggaran_input&mode=update" method="post" name="postform"><?php
                     }else{
					 	?><form role="form" action="?page=data_siswa_pelanggaran_input&mode=input" method="post" name="postform"><?php
					 }?>
                     <div class="form-group">
                          <label>Nama Siswa </label>
                          <input type="text" class="form-control" placeholder="Disabled input" disabled value="<?php echo $rows['nama_siswa']; ?>"/>  
                     </div>
                     
                     <div class="form-group">
                          <label>NIS</label><input type="text" class="form-control" placeholder="Disabled input" disabled value="<?php echo $rows['nis']; ?>"/>  
                     </div>
                     
                     <div class="form-group">
                          <label>Kelas</label><input type="text" class="form-control" placeholder="Disabled input" disabled value="<?php echo $rows['nama_kelas']; ?>"/>
                     </div>
                   	
                    <?php
					$cek_total=mysqli_fetch_array(mysqli_query($link,"select sum(poin) as total_poin from tbl_siswa_pelanggaran where id_bimbingan='$id_bimbingan'"));
					$total=$cek_total['total_poin'];
					?>
                     
                     <div class="form-group">
                          <label>TOTAL POIN SEBELUMNYA</label><input type="text" class="form-control" placeholder="Disabled input" disabled value="<?php echo $total; ?>"/>
                     </div>
                                       
                     </form>
					
					 <a href="?page=home.php"><font color="#FF9900">Kembali ke Halaman Utama</font></a>
                    
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
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Jenis Pelanggaran</a></th>
                    <th class="table-header-repeat line-left minwidth-1"><a href=""><font color="#FF0000">POIN</font></a></th>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Tanggal Kejadian</a></th>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Jenis Sanksi</a></th>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Keterangan</a></th>
                </tr>
                
                
                <?php
                $view=mysqli_query($link,"select pelanggaran.id_pelanggaran, bimbingan.id_bimbingan, jenis.nama_jenis, pelanggaran.poin, pelanggaran.keterangan, waktu_submit, tgl_kejadian, sanksi.nama_sanksi from tbl_siswa_pelanggaran pelanggaran, tbl_siswa_bimbingan bimbingan, setup_jenis_pelanggaran jenis, setup_jenis_sanksi sanksi where pelanggaran.id_bimbingan=bimbingan.id_bimbingan and pelanggaran.id_jenis=jenis.id_jenis and pelanggaran.id_sanksi=sanksi.id_sanksi and pelanggaran.id_bimbingan='$id_bimbingan' order by id_pelanggaran asc");
                
                $no=0;
                while($row=mysqli_fetch_array($view)){
                ?>	
                <tr>
                    <td><?php echo $no=$no+1;?></td>
                    <td><?php echo $row['nama_jenis']; ?></td>
                    <td><?php echo $row['poin'];?></td>
                    <td><?php echo $row['tgl_kejadian'];?></td>
                    <td><?php echo $row['nama_sanksi']; ?></td>
                    <td><?php echo ucwords($row['keterangan']);?></td>
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


<iframe width=174 height=189 name="gToday:normal:calender/normal.js" id="gToday:normal:calender/normal.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>