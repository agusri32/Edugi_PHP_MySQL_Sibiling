<?php
if($domain!=='admin'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>
<li>
    <a href="?page=user_dashboard"><i class="fa fa-dashboard fa-fw"></i><b><font color="#FFFFFF">&nbsp;DASHBOARD</font></b></a>
</li>
<li>
    <a href="javascript:;"><i class="fa fa-table fa-fw"></i><b><font color="#FFFFFF">&nbsp;DATA INDUK</font></b><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li><a href="?page=data_admin">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Data Admin</a></li>
        <li><a href="?page=data_guru">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Data Guru</a></li>
        <li><a href="?page=data_siswa">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Data Siswa</a></li>
        <li><a href="?page=data_ortu">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Data Orangtua/Wali</a></li>
    </ul>
</li>

<?php 
		if($domain=="superadmin"){
			echo "<li><a href='?page=data_admin'><font color=#FFFF00>Administrator</font></a></li>";
		}
		?>

<li>
    <a href="javascript:;"><i class="fa fa-wrench fa-fw"></i><b><font color="#FFFFFF">&nbsp;SETUP</font></b><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li><a href="?page=setup_kelas">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama Kelas</a></li>
        <li><a href="?page=setup_kelas_siswa">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kelas Siswa</a></li>
        <li><a href="?page=setup_jenis_pelanggaran">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jenis Pelanggaran</a></li>
        <li><a href="?page=setup_jenis_sanksi">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jenis Sanksi</a></li>
        <li><a href="?page=setup_orangtua_siswa">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Orangtua/Wali Siswa</a></li>
        <li><a href="?page=setup_siswa_bimbingan">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Guru Pembimbing</a></li>
        <li><a href="?page=setup_kontak_logo">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kontak & Logo Sekolah</a></li>
        <li><a href="?page=setup_sistem">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Setup Sistem</a></li>
    </ul>
</li>

<li>
    <a href="javascript:;"><i class="fa fa-files-o fa-fw"></i><b><font color="#FFFFFF">&nbsp;LAPORAN</font></b><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li><a href="?page=laporan_ruangkelas_admin">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kelas Siswa</a></li>
        <li><a href="?page=laporan_guru_pembimbing">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Guru Pembimbing</a></li>
        <li><a href="?page=laporan_siswa_pelanggaran">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pelanggaran Siswa</a></li>
        <li><a href="?page=laporan_detail_siswa_pelanggaran">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Detail Pelanggaran Siswa</a></li>
    </ul>
</li>

