<?php
if(!isset($_SESSION['domain'])){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>
<div class="row">
    <!-- Page Header -->
    <div class="col-lg-12">
        <h3 class="page-header">
            <?php
			if($_SESSION['domain']=='guru'){
				$id_guru=$_SESSION['id_guru'];
				$username=ucwords($_SESSION['username']);
				
				$data=mysqli_fetch_array(mysqli_query($link,"select * from data_guru where id_guru='$id_guru'"));
			
				$kelamin=$data['kelamin'];
				
				if($kelamin=='laki-laki'){
					$sapaan='Pak ';
				}else{
					$sapaan='Ibu ';
				}
				
				$pengguna=$sapaan.$username;
				
			}else{
			
				if($_SESSION['domain']=='ortu'){
					$id_ortu=$_SESSION['id_ortu'];
					$username=ucwords($_SESSION['username']);
					
					$data=mysqli_fetch_array(mysqli_query($link,"select * from data_orangtua where id_orangtua='$id_ortu'"));
				
					$kelamin=$data['kelamin'];
					
					if($kelamin=='laki-laki'){
						$sapaan='Pak ';
					}else{
						$sapaan='Ibu ';
					}
					
					$pengguna=$sapaan.$username;
				}else{
					$pengguna=ucwords($_SESSION['nama_account']);
				}
			}
			?>
			<?php echo $pengguna;?> &raquo; <?php echo ucwords($_SESSION['status']); ?>
        </h3>
    </div>
    <!--End Page Header -->
</div>

<div class="row">
    <!-- Welcome -->
    <div class="col-lg-12">
        <div class="alert alert-info">
            <i class="fa fa-folder-open"></i> Selamat Datang di Aplikasi SIBILING (Sistem Informasi Bimbingan & Konseling) 
        </div>
    </div>
    <!--end  Welcome -->
</div>

<div class="row">
    <div class="col-lg-8">

		<!--area chart example -->
		<?php //include "user_chart.php";?>
        
        <!--Simple table example -->
		<?php 
		if($_SESSION['domain']=='admin'){
			include "user_table_admin.php";
		}
		
		if($_SESSION['domain']=='guru'){	
			include "user_table_guru.php";
		}
		
		if($_SESSION['domain']=='siswa'){	
			include "user_table_siswa.php";
		}
		
		if($_SESSION['domain']=='ortu'){	
			include "user_table_ortu.php";
		}
		?>

    </div>

        <!--Area Stat example -->
        <?php 
        if($_SESSION['domain']=='admin'){
            include "user_statistik_admin.php";
        }
        
        if($_SESSION['domain']=='guru'){	
            include "user_statistik_guru.php";
        }
		
		if($_SESSION['domain']=='siswa'){	
            include "user_statistik_siswa.php";
        }

        if($_SESSION['domain']=='ortu'){	
            include "user_statistik_ortu.php";
        }
        ?>
        
</div>