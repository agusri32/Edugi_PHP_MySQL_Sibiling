<?php
if($domain!=='ortu'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}					
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <i class="fa fa-bar-chart-o fa-fw"></i> Laporan Pelanggaran Siswa 
    </div>

	<!--  start product-table ..................................................................................... -->
<div class="row">
    <div class="col-lg-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">   
            <div class="panel-body">
                <div class="table-responsive">
				
                <?php
				$id_ortu=$_SESSION['id_ortu'];
                ?>
                
                <center>
                <?php
                $query=mysqli_query($link,"select id_bimbingan, nama_guru, siswa.photo as posiswa, nama_siswa, nis, nama_kelas, ortu.photo as portu, nama_orangtua from tbl_siswa_bimbingan bimbingan, tbl_ruangan ruangan, tbl_akses_ortu aksesortu, data_orangtua ortu, data_siswa siswa,data_guru guru, setup_kelas kelas where bimbingan.id_siswa=siswa.id_siswa and bimbingan.id_siswa=ruangan.id_siswa and ruangan.id_kelas=kelas.id_kelas and bimbingan.id_siswa=aksesortu.id_siswa and bimbingan.id_guru=guru.id_guru and aksesortu.id_orangtua=ortu.id_orangtua and aksesortu.id_orangtua='$id_ortu' order by siswa.nama_siswa asc");
				
                $get_pages=mysqli_num_rows($query); //dapatkan jumlah semua data
				
                ?>
                </center>
                
                
                <table class="table table-striped table-bordered table-hover" border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
                <tr>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a></th>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Photo Siswa</a></th>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Nama Siswa</a></th>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">NIS</a></th>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Kelas</a></th>
                    <th class="table-header-repeat line-left minwidth-1" align="center"><a href=""><font color="#FF0000">TOTAL POIN</font></a></th>
                    <th class="table-header-options line-left"><a href="">Aksi</a></th>
                </tr>
                
                
                <?php
                $no=0;
                while($row=mysqli_fetch_array($query)){
					$id_bimbingan=$row['id_bimbingan'];
					$guru_bk=$row['nama_guru'];
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
                    
                    <td><?php echo $nama_siswa=$row['nama_siswa'];?></td>
                    <td><?php echo $nis=$row['nis'];?></td>
                    <td><?php echo $nama_kelas=$row['nama_kelas'];?></td>
                    <td><b>
                    <?php
					$cek_total=mysqli_fetch_array(mysqli_query($link,"select sum(poin) as total_poin from tbl_siswa_pelanggaran where id_bimbingan='$id_bimbingan'"));
					echo $total=$cek_total['total_poin'];
					?></b>
                    </td>
                    <td>
                    <a href="?page=data_siswa_pelanggaran_detail&id_bimbingan=<?php echo $id_bimbingan;?>"><img src="images/detail.png" /></a>
                    
                    <a href="javascript:;"  title="Cetak Laporan Pelanggaran ke File PDF"><img src="images/pdf-icon.jpeg" border="0" onClick="window.open('./pdf/export_pdf_pelanggaran.php?id_bimbingan=<?php echo $id_bimbingan;?>&nama_kelas=<?php echo $nama_kelas;?>&nama_siswa=<?php echo $nama_siswa;?>&nis=<?php echo $nis;?>&nama_guru=<?php echo $guru_bk;?>&photo=<?php echo $photo_siswa;?>&logo=<?php echo $photo_siswa;?>','scrollwindow','top=200,left=300,width=800,height=500');"></a>
                            
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

</div>
<!--End simple table example -->