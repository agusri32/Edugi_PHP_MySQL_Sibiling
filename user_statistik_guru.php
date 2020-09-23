<?php
if($domain!=='guru'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}					  
?>
<div class="col-lg-4">
    <div class="panel panel-primary text-center no-boder">
        <div class="panel-body yellow">
            <i class="fa fa-bar-chart-o fa-3x"></i>
            <?php 
			$id_guru=$_SESSION['id_guru'];
			$view1=mysqli_num_rows(mysqli_query($link,"select * from tbl_siswa_bimbingan where id_guru='$id_guru'"));
			?>
            <h3><?php echo $view1;?> Orang</h3>
        </div>
        <div class="panel-footer">
            <span class="panel-eyecandy-title"><a href="?page=data_siswa_bimbingan">All Data Siswa Bimbingan</a>
            </span>
        </div>
    </div>
</div>
