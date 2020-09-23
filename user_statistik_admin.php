<?php
if(!isset($_SESSION['domain'])){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>
<div class="col-lg-4">
    <div class="panel panel-primary text-center no-boder">
        <div class="panel-body yellow">
            <i class="fa fa-bar-chart-o fa-3x"></i>
            <?php 
			$view1=mysqli_num_rows(mysqli_query($link,"select * from user_admin"));
			?>
            <h3><?php echo $view1;?> Orang</h3>
        </div>
        <div class="panel-footer">
            <span class="panel-eyecandy-title"><a href="?page=data_admin">All Data Admin</a>
            </span>
        </div>
    </div>
    
    <div class="panel panel-primary text-center no-boder">
        <div class="panel-body blue">
            <i class="fa fa-bar-chart-o fa-3x"></i>
            <?php 
			$view2=mysqli_num_rows(mysqli_query($link,"select * from data_guru"));
			?>
            <h3><?php echo $view2;?> Orang</h3>
        </div>
        <div class="panel-footer">
            <span class="panel-eyecandy-title"><a href="?page=data_guru">All Data Guru</a>
            </span>
        </div>
    </div>
    
    <div class="panel panel-primary text-center no-boder">
        <div class="panel-body green">
            <i class="fa fa-bar-chart-o fa-3x"></i>
            <?php 
			$view3=mysqli_num_rows(mysqli_query($link,"select * from data_siswa"));
			?>
            <h3><?php echo $view3;?> Orang</h3>
        </div>
        <div class="panel-footer">
            <span class="panel-eyecandy-title"><a href="?page=data_siswa">All Data Siswa</a>
            </span>
        </div>
    </div>
    
    <div class="panel panel-primary text-center no-boder">
        <div class="panel-body red">
            <i class="fa fa-bar-chart-o fa-3x"></i>
            <?php 
			$view4=mysqli_num_rows(mysqli_query($link,"select * from data_orangtua"));
			?>
            <h3><?php echo $view4;?> Orang</h3>
        </div>
        <div class="panel-footer">
            <span class="panel-eyecandy-title"><a href="?page=data_ortu">All Data Orangtua</a>
            </span>
        </div>
    </div>

</div>
