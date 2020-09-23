<?php
if($domain!=='admin'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>

<!--  page-wrapper -->
<div class="row">
     <!-- page header -->
    <div class="col-lg-12">
        <h1 class="page-header">Laporan &raquo; Kelas Siswa</h1>
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



                    <form action="?page=laporan_ruangkelas_admin" method="post">                                      
                    <div class="form-group">
                        <label>Kelas</label>
                      	<select name="id_kelas"  class="form-control">
                          <option value="0">-- Pilih Kelas --</option>
                          <?php
                          $kelas=mysqli_query($link,"select * from setup_kelas order by nama_kelas asc");
                          while($row2=mysqli_fetch_array($kelas)){
                          ?>
                              <option value="<?php echo $row2['id_kelas'];?>" <?php if($row2['id_kelas']==$id_kelas){ echo 'selected';}?>><?php echo $row2['nama_kelas'];?></option>
                          <?php
                          }
                          ?>    
                        </select>
                    </div>
                    
                    <div class="form-group">
                    	<input type="submit" name="submit" value="Filter Data" value="Filter"  class="btn btn-primary" />
                    </div>
                    </form>




  					</div>
                </div>
            </div>
        </div>
         <!-- End Form Elements -->
    </div>
</div>



<div class="row">
    <div class="col-lg-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">   
            <div class="panel-body">
                <div class="table-responsive">


                <p>
                <?php
                if(isset($_POST['submit'])){
                    $id_kelas=htmlentities($_POST['id_kelas']);
                    
                    if($id_kelas!=="0"){
                        $filter_kelas="and ruangan.id_kelas='$id_kelas'";
                    }else{
                        $filter_kelas="";
                    }
                }else{
                    unset($_POST['submit']);
                }
                ?>
                </p>
                <p><em>*Sebelum export data ke file excel, silahkan tekan tombol Filter Data    </em></p>
        <center>
                    <a href="javascript:;"><img src="./images/excel-icon.jpeg" title="Export Data" width="18" height="18" border="0" onClick="window.open('./excel/export_ruangkelas.php?id_kelas=<?php echo $id_kelas;?>','scrollwindow','top=200,left=300,width=800,height=500');"></a>
                </center><br />
                    
                <form id="mainform" action="">
                <table class="table table-striped table-bordered table-hover" border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
                <tr>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a>	</th>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Nama Siswa</a></th>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">NIS</a></th>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Kelas</a></th>
                    <th class="table-header-options line-left"><a href="">Aksi</a></th>
                </tr>
                
                
                <?php
                $view=mysqli_query($link,"select * from tbl_ruangan ruangan, setup_kelas kelas, data_siswa siswa where ruangan.id_kelas=kelas.id_kelas and ruangan.id_siswa=siswa.id_siswa $filter_kelas order by id_ruangan asc");
        
                $no=0;
                while($row=mysqli_fetch_array($view)){
                ?>	
                <tr>
                    <td><?php echo $no=$no+1;?></td>
                    <td><?php echo $row['nama_siswa'];?></td>
                    <td><?php echo $row['nis'];?></td>
                    <td><?php echo $row['nama_kelas'];?></td>
                    <td class="options-width">
                    <a href="?page=setup_kelas_siswa&mode=delete&id_ruangan=<?php echo $row['id_ruangan'];?>" onclick="return confirm('Apakah Anda yakin?')" title="Delete" class="icon-2 info-tooltip"><img src="images/delete.png" /></a>
                    <a href="?page=setup_kelas_siswa&mode=edit&id_ruangan=<?php echo $row['id_ruangan'];?>" title="Edit" class="icon-5 info-tooltip"><img src="images/edit.png" /></a>                    
                    </td>
                </tr>
                <?php
                }
                ?>
                </table>
                <!--  end product-table................................... --> 
                

 				</div>
            </div>
        </div>
        <!--  end  Context Classes  -->
    </div>
</div>
<!-- end page-wrapper -->