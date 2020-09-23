<?php
if($domain!=='ortu'){
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
        <div class="panel-body yellow">
            <i class="fa fa-bar-chart-o fa-3x"></i>
            <?php 
			$id_ortu=$_SESSION['id_ortu'];
			$tot_anak=mysqli_num_rows(mysqli_query($link,"select * from tbl_akses_ortu where id_orangtua='$id_ortu'"));
			?>
            <h3><?php echo $tot_anak;?> Anak</h3>
        </div>
    </div>
</div>
