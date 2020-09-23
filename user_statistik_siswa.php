<?php
if($domain!=='siswa'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}					  
?>
<div class="col-lg-4">
	<!--
    <div class="panel panel-primary text-center no-boder">
        <div class="panel-body blue">
			<img src="./photo_siswa/<?php //echo $_SESSION['photo'];?>" width="300" height="300" />
        </div>
    </div>
	-->
    
    <div class="panel panel-primary text-center no-boder">
        <div class="panel-body red">
            <i class="fa fa-bar-chart-o fa-3x"></i>
            <?php 
			$id_siswa=$_SESSION['id_siswa'];
			$view1=mysqli_num_rows(mysqli_query($link,"select * from tbl_siswa_pelanggaran pelanggaran,tbl_siswa_bimbingan bimbingan where pelanggaran.id_bimbingan=bimbingan.id_bimbingan and bimbingan.id_siswa='$id_siswa'"));
			?>
            <h3><?php echo $view1;?> Pelanggaran</h3>
        </div>
    </div>
    
    <div class="panel panel-primary text-center no-boder">
        <div class="panel-body yellow">
            <i class="fa fa-bar-chart-o fa-3x"></i>
            <?php 
			$id_siswa=$_SESSION['id_siswa'];
			$view2=mysqli_fetch_array(mysqli_query($link,"select sum(pelanggaran.poin) as poin from tbl_siswa_pelanggaran pelanggaran, tbl_siswa_bimbingan bimbingan where pelanggaran.id_bimbingan=bimbingan.id_bimbingan and bimbingan.id_siswa='$id_siswa'"));
			?>
            <h3><?php echo $view2['poin'];?> Poin</h3>
        </div>
    </div>
</div>
