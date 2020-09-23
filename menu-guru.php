<?php
if($domain!=='guru'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>
<li>
    <a href="home.php"><i class="fa fa-dashboard fa-fw"></i>&nbsp;DASHBOARD</a>
</li>
<li>
    <a href="javascript:;"><i class="fa fa-edit fa-fw"></i>&nbsp;KEGIATAN<span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li><a href="?page=data_siswa_bimbingan">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Siswa Bimbingan</a></li>
        <li><a href="?page=data_siswa_pelanggaran">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Input Pelanggaran Siswa</a></li>
    </ul>
</li>