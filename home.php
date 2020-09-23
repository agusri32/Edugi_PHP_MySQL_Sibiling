<?php session_start();

if(isset($_SESSION['domain'])){
	//koneksi terpusat
	include "conn.php";
	$username=$_SESSION['username'];
	$id_user=$_SESSION['id_user'];
	$domain=$_SESSION['domain'];
	
	/*
	if (!login_check()) {
		//jika idle
		?><script language="javascript">document.location.href='logout.php?mode=timeout';</script><?php
		exit(0);
	}
	*/
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <!-- Core CSS - Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <!-- Page-Level CSS -->
    <link href="assets/plugins/morris/morris-0.4.3.min.css" rel="stylesheet" />
   </head>
<body>
    <!--  wrapper -->
    <div id="wrapper">
        <!-- navbar top -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="navbar">
            <!-- navbar-header -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?php
				$data=mysqli_fetch_array(mysqli_query($link,"select * from setup_kontak_kami"));
				$logo=$data['photo'];
				
				if(empty($logo)){
					$logo_img="logo_sekolah.png";
				}else{
					$logo_img=$logo;
				}
				
				$nama_instansi=$data['nama_instansi'];
				?>
				
				<h2><b>
                    &nbsp;<?php echo $nama_instansi;?>
                </h2></b>
            </div>
            <!-- end navbar-header -->

            <!-- navbar-top-links -->
            <ul class="nav navbar-top-links navbar-right">
		    <!-- main dropdown -->
			
            <!---TOP MENU--->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-3x"></i>
                </a>
                <!-- dropdown user-->
                <ul class="dropdown-menu dropdown-user">
                
                    <li>
                    <?php
                    if($domain=='admin'){
                        echo "<a href='?page=setting_admin'><i class='fa fa-gear fa-fw'></i>Setup Account</a>";
                    }
                    
                    if($domain=='guru'){
                        echo "<a href='?page=setting_guru'><i class='fa fa-gear fa-fw'></i>Setup Account</a>";
                    }
                    
                    if($domain=='siswa'){
                        echo "<a href='?page=setting_siswa'><i class='fa fa-gear fa-fw'></i>Setup Account</a>";
                    }
                    
                    if($domain=='ortu'){
                        echo "<a href='?page=setting_ortu'><i class='fa fa-gear fa-fw'></i>Setup Account</a>";
                    }
                    ?>
                    </li>
                    
                    <li class="divider"></li>
                    <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i>Logout</a>
                    </li>
                </ul>
                <!-- end dropdown-user -->
            </li>
            <!-- end main dropdown -->	
                        
            
            </ul>
            <!-- end navbar-top-links -->

        </nav>
        <!-- end navbar top -->

        <!-- navbar side -->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <!-- sidebar-collapse -->
            <div class="sidebar-collapse">
                <!-- side-menu -->
                <ul class="nav" id="side-menu">
                	<!--LOGO-->
                    <li>
                        <!-- user image section-->
                        <div class="user-section">
                            <div class="user-section-inner">
                            
                            <a href="home.php">
                            <img src="./logo/<?php echo $logo_img;?>"/>
                           	</a>
                            
                            </div>
                            
                            <div class="user-info">
                                <div></div>
                                <div class="user-text-online"><?php //echo $data['nama_instansi'];?></div>
                            </div>
                        </div>
                        <!--end user image section-->
                    </li>
                    
					<?php 
					if($domain=='admin'){
						include "menu-admin.php";
					}
					
					if($domain=='guru'){
						include "menu-guru.php";
					}
					
					if($domain=='siswa'){
						include "menu-siswa.php";
					}
					
					if($domain=='ortu'){
						include "menu-ortu.php";
					}
					
					?>                   

                </ul>
                <!-- end side-menu -->
            </div>
            <!-- end sidebar-collapse -->
        </nav>
        <!-- end navbar side -->
        <!--  page-wrapper -->
        <div id="page-wrapper">

		<?php include "content.php"; ?> 

        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->

    <!-- Core Scripts - Include with every page -->
    <script src="assets/plugins/jquery-1.10.2.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="assets/plugins/pace/pace.js"></script>
    <script src="assets/scripts/siminta.js"></script>
    <!-- Page-Level Plugin Scripts-->
    <script src="assets/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/plugins/morris/morris.js"></script>
    <script src="assets/scripts/dashboard-demo.js"></script>
</body>
</html>


<?php
}else{
	session_destroy();
	header('Location:index.php?status=Silahkan Login');
}
?>	