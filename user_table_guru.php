<?php
if($domain!=='guru'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}					
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <i class="fa fa-bar-chart-o fa-fw"></i> 10 Siswa yang memiliki Poin Pelanggaran Terbanyak
    </div>

	<!--  start product-table ..................................................................................... -->
<div class="row">
    <div class="col-lg-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">   
            <div class="panel-body">
                <div class="table-responsive">
				
                <?php
                //menampilkan data dengan menggunakan limit sesuai parameter paging yang diberikan
                $result=mysqli_query($link,"select distinct nama_siswa, nis, sum(poin) as tot_poin, bimbingan.id_bimbingan,siswa.photo, nama_guru, nama_kelas from tbl_siswa_pelanggaran pelanggaran, tbl_siswa_bimbingan bimbingan, tbl_ruangan ruangan, setup_jenis_pelanggaran jenis, setup_kelas kelas, data_siswa siswa, data_guru guru where pelanggaran.id_bimbingan=bimbingan.id_bimbingan and pelanggaran.id_jenis=jenis.id_jenis and bimbingan.id_siswa=siswa.id_siswa and bimbingan.id_guru=guru.id_guru and bimbingan.id_siswa=ruangan.id_siswa and ruangan.id_kelas=kelas.id_kelas and bimbingan.id_guru='$id_guru' group by nama_siswa order by poin desc limit 10"); //output
				
				$tot_data=mysqli_num_rows($result);
                ?>
                </center>
                
                
                <table class="table table-striped table-bordered table-hover" border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
                <tr>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a></th>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Photo Siswa</a></th>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Nama Siswa</a></th>
                    <!--
                    <th class="table-header-repeat line-left minwidth-1"><a href="">NIS</a></th>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Guru</a></th>
                    -->
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Kelas</a></th>
                    
                    <th class="table-header-repeat line-left minwidth-1" align="center"><a href="" title="TOTAL POIN"><font color="#FF0000">TOTAL POIN</a></th>
                    <th class="table-header-repeat line-left minwidth-1" align="center"><a href="" title="Cetak Pelanggaran Siswa">Aksi</a></th>
                </tr>
                
                
                <?php
                $no=0;
                while($row=mysqli_fetch_array($result)){
					$id_bimbingan=$row['id_bimbingan'];
					$guru_bk=$row['nama_guru'];
                ?>	
                <tr>
                    <td><?php echo $offset=$offset+1;?></td>
                    
                    <td>
                        <?php 
                        $posiswa=$row['photo'];
                        if(empty($posiswa)){
                            $photo_siswa='nopic.jpg';
                        }else{
                            $photo_siswa=$posiswa;
                        }
                        ?>
                        <div align="center"><img src="./photo_siswa/<?php echo $photo_siswa;?>" height="101" width="83"></div>
                    </td>
                    
                    <?php $nis=$row['nis'];?>
                    <td><?php echo $nama_siswa=$row['nama_siswa'];?></td>
                    <td><?php echo $nama_kelas=$row['nama_kelas'];?></td>
                    <td><b><?php echo $poin=$row['tot_poin'];?></b>
                    </td>
                    <td>
                     <a href="?page=data_siswa_pelanggaran_input&id_bimbingan=<?php echo $id_bimbingan;?>" class="icon-5 info-tooltip" title="Input Pelanggaran Siswa"><img src="images/warning.png" /></a>
                     
                    <a href="javascript:;"  title="Cetak Laporan Pelanggaran ke File PDF"><img src="images/pdf-icon.jpeg" border="0" onClick="window.open('./pdf/export_pdf_pelanggaran.php?id_bimbingan=<?php echo $id_bimbingan;?>&nama_kelas=<?php echo $nama_kelas;?>&nama_siswa=<?php echo $nama_siswa;?>&nis=<?php echo $nis;?>&nama_guru=<?php echo $guru_bk;?>&photo=<?php echo $photo_siswa;?>&logo=<?php echo $photo_siswa;?>','scrollwindow','top=200,left=300,width=800,height=500');"></a>
            
                    </td>
                </tr>
                <?php
                }
                ?>
                </table>
                
                <center>TOTAL DATA : <?php echo $tot_data;?></center>
                
                </div>
        	</div>
        <!--  end  Context Classes  -->
    	</div>
	</div>
</div>
<!-- end page-wrapper -->

</div>
<!--End simple table example -->