<?php
if($domain!=='guru' && $domain!=='admin'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}					  
?>
<script type="text/javascript" src="nicEdit.js"></script>
<script type="text/javascript">
bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
<?php
$id_guru=$_SESSION['id_guru'];

if($_GET['mode']=='input'){
	$id_bimbingan=htmlentities($_POST['id_bimbingan']);
	$id_jenis=htmlentities($_POST['id_jenis']);
	$id_sanksi=htmlentities($_POST['id_sanksi']);
	$poin=htmlentities($_POST['poin']);
	$tgl_kejadian=htmlentities($_POST['tgl_kejadian']);
	$keterangan=htmlentities($_POST['keterangan']);
	$waktu;
	
	$query=mysqli_query($link,"insert into tbl_siswa_pelanggaran(id_bimbingan,id_jenis,id_sanksi,poin,tgl_kejadian,keterangan,waktu_submit) values('$id_bimbingan','$id_jenis','$id_sanksi','$poin','$tgl_kejadian','$keterangan','$waktu')");
	
	if($query){
		?><script language="javascript">document.location.href="?page=data_siswa_pelanggaran_input&id_bimbingan=<?php echo $id_bimbingan; ?>&status=1";</script><?php
	}
}

if($_GET['mode']=='delete'){
	$id_bimbingan=$_GET['id_bimbingan'];
	$id_pelangaran=$_GET['id_pelanggaran'];
	$query=mysqli_query($link,"delete from tbl_siswa_pelanggaran where id_pelanggaran='$id_pelangaran'");
	if($query){
		?><script language="javascript">document.location.href="?page=data_siswa_pelanggaran_input&id_bimbingan=<?php echo $id_bimbingan; ?>&status=2";</script><?php
	}
}

if($_GET['mode']=='update'){  	
	$id_bimbingan=htmlentities($_POST['id_bimbingan']);
	$id_pelanggaran=htmlentities($_POST['id_pelanggaran']);
	$id_jenis=htmlentities($_POST['id_jenis']);
	$id_sanksi=htmlentities($_POST['id_sanksi']);
	$poin=htmlentities($_POST['poin']);
	$tgl_kejadian=htmlentities($_POST['tgl_kejadian']);
	$keterangan=htmlentities($_POST['keterangan']);
	
	$query=mysqli_query($link,"update tbl_siswa_pelanggaran set id_jenis='$id_jenis',id_sanksi='$id_sanksi', poin='$poin', tgl_kejadian='$tgl_kejadian', keterangan='$keterangan' where id_pelanggaran='$id_pelanggaran'");
	
	if($query){
		?><script language="javascript">document.location.href="?page=data_siswa_pelanggaran_input&id_bimbingan=<?php echo $id_bimbingan; ?>&status=3";</script><?php
	}else{
		echo mysqli_error();
	}
}

if($_GET['mode']=='edit'){
	$id_pelanggaran=$_GET['id_pelanggaran'];
	$edit=mysqli_query($link,"select * from tbl_siswa_pelanggaran where id_pelanggaran='$id_pelanggaran'");
	$data=mysqli_fetch_array($edit);
	
	$id_bimbingan=$data['id_bimbingan'];
	$id_jenis=$data['id_jenis'];
	$id_sanksi=$data['id_sanksi'];
	$poin=$data['poin'];
	$tgl_kejadian=$data['tgl_kejadian'];
	$keterangan=$data['keterangan'];
}
?>

<!--  page-wrapper -->
<div class="row">
     <!-- page header -->
    <div class="col-lg-12">
        <h1 class="page-header">Input Pelanggaran Siswa</h1>
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
                    
                    <?php
					include "warning.php";
					?>
					
                    <?php
					if($_GET['id_bimbingan']){
						$id_bimbingan=$_GET['id_bimbingan'];
									
						$rows=mysqli_fetch_array(mysqli_query($link,"select id_bimbingan, siswa.photo as posiswa, nama_siswa, nis, nama_kelas, ortu.photo as portu, nama_orangtua from tbl_siswa_bimbingan bimbingan, tbl_ruangan ruangan, tbl_akses_ortu aksesortu, data_orangtua ortu, data_siswa siswa,data_guru guru, setup_kelas kelas where bimbingan.id_siswa=siswa.id_siswa and bimbingan.id_siswa=ruangan.id_siswa and ruangan.id_kelas=kelas.id_kelas and bimbingan.id_siswa=aksesortu.id_siswa and aksesortu.id_orangtua=ortu.id_orangtua and bimbingan.id_guru=guru.id_guru and bimbingan.id_bimbingan='$id_bimbingan' order by id_bimbingan asc"));					
					
					}else{
						?><script language="javascript">document.location.href="?page=data_siswa_pelanggaran"</script><?php
					}
					?>
                    
                     <div class="form-group">
                        <?php 
						$photo=$rows['posiswa'];
                        if(empty($photo)){
                            $photo_siswa='nopic.jpg';
                        }else{
                            $photo_siswa=$photo;
                        }
                        ?>
                        <img src="./photo_siswa/<?php echo $photo_siswa;?>" height="101" width="83">
                     </div>
                     
					 <?php
					 if($_GET['mode']=='edit'){
					 	?><form role="form" action="?page=data_siswa_pelanggaran_input&mode=update" method="post" name="postform"><?php
                     }else{
					 	?><form role="form" action="?page=data_siswa_pelanggaran_input&mode=input" method="post" name="postform"><?php
					 }?>
                     <div class="form-group">
                          <label>Nama Siswa </label>
                          <input type="text" class="form-control" placeholder="Disabled input" disabled value="<?php echo $rows['nama_siswa']; ?>"/>  
                     </div>
                     
                     <div class="form-group">
                          <label>NIS</label><input type="text" class="form-control" placeholder="Disabled input" disabled value="<?php echo $rows['nis']; ?>"/>  
                     </div>
                     
                     <div class="form-group">
                          <label>Kelas</label><input type="text" class="form-control" placeholder="Disabled input" disabled value="<?php echo $rows['nama_kelas']; ?>"/>
                     </div>
                   	
                    <?php
					$cek_total=mysqli_fetch_array(mysqli_query($link,"select sum(poin) as total_poin from tbl_siswa_pelanggaran where id_bimbingan='$id_bimbingan'"));
					$total=$cek_total['total_poin'];
					?>
                     
                     <div class="form-group">
                          <label>TOTAL POIN SEBELUMNYA</label><input type="text" class="form-control" placeholder="Disabled input" disabled value="<?php echo $total; ?>"/>
                     </div>
                                       
                     <div class="form-group">
                          <label>POIN PELANGGARAN</label><input type="text" class="form-control" name="poin" value="<?php echo $poin; ?>"/>
                     </div>
                   		
                     <div class="form-group">
                        <label>Jenis Pelanggaran</label>
                      	<select name="id_jenis" class="form-control" >
                          <?php
						  $jenis=mysqli_query($link,"select * from setup_jenis_pelanggaran order by nama_jenis asc");
						  while($row2=mysqli_fetch_array($jenis)){
						  ?>
							  <option value="<?php echo $row2['id_jenis'];?>" <?php if($row2['id_jenis']==$id_jenis){ echo 'selected';}?>><?php echo $row2['nama_jenis'];?></option>
						  <?php
						  }
						  ?>    
                        </select>
                     </div>
 
                     <div class="form-group">
                      <label>Tanggal Kejadian </label>
                      <input type="text" name="tgl_kejadian" class="form-control" value="<?php echo $tgl_kejadian; ?>">
                      <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.postform.tgl_kejadian);return false;" ><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" border="0" align="absmiddle" id="popcal" /></a>		              
                     </div>
                     
                     <div class="form-group">
                        <label>Jenis Sanksi</label>
                      	<select name="id_sanksi" class="form-control" >
                          <?php
						  $sanksi=mysqli_query($link,"select * from setup_jenis_sanksi order by id_sanksi asc");
						  while($row2=mysqli_fetch_array($sanksi)){
						  ?>
							  <option value="<?php echo $row2['id_sanksi'];?>" <?php if($row2['id_sanksi']==$id_sanksi){ echo 'selected';}?>><?php echo $row2['nama_sanksi'];?></option>
						  <?php
						  }
						  ?>    
                        </select>
                     </div>
                    
                     <div class="form-group"> 
                         <label>Keterangan</label>
                         <textarea class="form-control" name="keterangan" style="width: 450px; height: 100px;">
                            <?php echo $keterangan;?>
                         </textarea>
                     </div>
					 <input type="hidden" name="id_bimbingan" value="<?php echo $id_bimbingan; ?>" />
					 <input type="hidden" name="id_pelanggaran" value="<?php echo $_GET['id_pelanggaran']; ?>" />
                     <div class="form-group">
                     <input type="submit" name="submit" onClick="return confirm('Apakah Anda yakin?')" value="Submit" class="btn btn-primary"/>
                     <input type="reset" value="Reset"  class="btn btn-success"   />
                     </div>
                     </form>
					
                     <?php 
					 if($domain=='admin'){                     
					 	?><a href="?page=laporan_siswa_pelanggaran"><font color="#FF9900">Kembali ke Menu Pelanggaran</font></a><?php
					 }else{
					 	?><a href="?page=data_siswa_pelanggaran"><font color="#FF9900">Kembali ke Menu Pelanggaran</font></a><?php
					 }
					 ?>
                    
                    </div>
            	</div>
        	</div>
        <!--  end  Context Classes  -->
    	</div>
	</div>
</div>
<!-- end page-wrapper -->


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
                    <th class="table-header-options line-left"><a href="">Aksi</a></th>
                </tr>
                
                
                <?php
                $view=mysqli_query($link,"select pelanggaran.id_pelanggaran, bimbingan.id_bimbingan, jenis.nama_jenis, pelanggaran.poin, pelanggaran.keterangan, waktu_submit, tgl_kejadian, sanksi.nama_sanksi from tbl_siswa_pelanggaran pelanggaran, tbl_siswa_bimbingan bimbingan, setup_jenis_pelanggaran jenis, setup_jenis_sanksi sanksi where pelanggaran.id_bimbingan=bimbingan.id_bimbingan and pelanggaran.id_jenis=jenis.id_jenis and pelanggaran.id_sanksi=sanksi.id_sanksi and pelanggaran.id_bimbingan='$id_bimbingan' order by id_pelanggaran asc");
                
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
                    <td class="options-width">
                    <a href="?page=data_siswa_pelanggaran_input&mode=delete&id_bimbingan=<?php echo $row['id_bimbingan'];?>&id_pelanggaran=<?php echo $row['id_pelanggaran'];?>" onclick="return confirm('Apakah Anda yakin?')" title="Delete" class="icon-2 info-tooltip"><img src="images/delete.png" /></a>
                    <a href="?page=data_siswa_pelanggaran_input&mode=edit&id_bimbingan=<?php echo $row['id_bimbingan'];?>&id_pelanggaran=<?php echo $row['id_pelanggaran'];?>" title="Edit" class="icon-5 info-tooltip"><img src="images/edit.png" /></a>            
                    </td>
                </tr>
                <?php
                }
                ?>
                </table>
                
                
                </div>
        	</div>
        <!--  end  Context Classes  -->
    	</div>
	</div>
</div>
<!-- end page-wrapper -->


<iframe width=174 height=189 name="gToday:normal:calender/normal.js" id="gToday:normal:calender/normal.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>