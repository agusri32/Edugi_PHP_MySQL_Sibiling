<?php
if($domain!=='siswa'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}					
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <i class="fa fa-bar-chart-o fa-fw"></i> Pelanggaran yang telah dilakukan
    </div>

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
				$id_siswa=$_SESSION['id_siswa'];
								
                $view=mysqli_query($link,"select pelanggaran.id_pelanggaran, bimbingan.id_bimbingan, jenis.nama_jenis, sanksi.nama_sanksi, pelanggaran.poin, pelanggaran.keterangan, waktu_submit, tgl_kejadian from tbl_siswa_pelanggaran pelanggaran, tbl_siswa_bimbingan bimbingan, setup_jenis_pelanggaran jenis, setup_jenis_sanksi sanksi where pelanggaran.id_bimbingan=bimbingan.id_bimbingan and pelanggaran.id_jenis=jenis.id_jenis and pelanggaran.id_sanksi=sanksi.id_sanksi and bimbingan.id_siswa='$id_siswa' order by id_pelanggaran asc");
                
				$tot_data=mysqli_num_rows($view);	
				
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