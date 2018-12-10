<h3>Semester</h3>
<form method="POST" action="aksi_semester.php">
<br>
<br>
<table class='table table-striped'>
	
	<tr><th><font face=tahoma size=2>Semester</font></th><th><font face=tahoma size=2>Status</font></th><th><font face=tahoma size=2>AKSI</font></th>
	<?php
	$sql = mysqli_query($conn, "SELECT * FROM tsemester");
	while($data = mysqli_fetch_array($sql)){
		if ($data[aktif]=='Y'){
			$hasil = "Non Aktifkan";
		}
		else{
			$hasil = "Aktifkan";
		}
		echo "<tr><td><font face=tahoma size=2>$data[id_semester]</font></td>
		<td><font face=tahoma size=2>$data[aktif]</font></td>
		<td><font face=tahoma size=2><a href='modul/mod_semester/aksi_semester.php?id=$data[id_semester]'><img src=../images/update.png> $hasil</a></font></td></tr>";
	}
	?>
</table>
</form>

<?php

session_start();
if(!isset($_SESSION["login"])){
	echo $_SESSION["login"];
	header("location:../index.php");
	exit;
}

if(isset($_POST[Submit])){
	$kelas = mysqli_fetch_array(mysqli_query($conn, "SELECT kelas FROM tkelas WHERE id_kelas = '$_POST[kelas]'"));
	$sql = mysqli_query($conn, "SELECT * FROM tsiswa WHERE id_kelas = '$_POST[kelas]' ORDER BY nis ASC");
	$numrows = mysqli_num_rows($sql);
	if ($numrows > 0){
		echo "<table border=1>
				<tr>
					<th>No</th><th>NIS</th><th>Nama Siswa</th><th>Aktif</th><th>Aksi</th>
				</tr>";
		$no = 1;
		while($data = mysqli_fetch_array($sql)){
			echo "<tr>
					<td>$no</th>
					<td>$data[nis]</td>
					<td>$data[nama]</td>
					<td>$data[aktif]</td>
					<td><a href='?module=siswa&act=update&nis=$data[nis]'>Update</a> | <a href='modul/mod_siswa/aksi_siswa.php?module=siswa&act=hapus&nis=$data[nis]'>Hapus</a></td>
				  </tr>";
			$no++;
		}
	}
	else{
		echo "<h4>Pencarian kelas : $kelas[kelas]<br>
				Hasil : Data tidak ditemukan</h4>";
	}
}
?>