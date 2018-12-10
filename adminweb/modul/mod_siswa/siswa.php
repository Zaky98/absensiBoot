<?php

session_start();
if(!isset($_SESSION["login"])){
	echo $_SESSION["login"];
	header("location:../index.php");
	exit;
}

$aksi = "modul/mod_siswa/aksi_siswa.php";
switch($_GET[act]){
	default:
	?>
<h3>Manajemen Siswa</h3>
<link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="js/vendor/bootstrap.min.js"></script>
<form method="POST" action="?module=siswa">
<br>
<br>
	<font face=tahoma size=2>Pilih Kelas</font></td><td><font face=tahoma size=2> 
		<select name=kelas>
			<?php
			include "../../../koneksi/koneksi.php";
			$sql = mysqli_query($conn, "SELECT * FROM tkelas ORDER BY kelas ASC");
			echo "<option value='+'>[Pilih Kelas]</option>";
			while ($data = mysqli_fetch_array($sql)){
				echo "<option value='$data[id_kelas]'>$data[kelas]</option>";
			}
			?>
		</select></font>
		<br>
		<br>
<input type="Submit" name="Submit" value="Go" class="btn-primary">
<?php echo "<input type=button value='Tambah Siswa' onclick=\"window.location.href='?module=siswa&act=tambahsiswa';\" class='btn-primary'>"; ?>
<br>
<Br>
</form>

<?php
if(isset($_POST[Submit])){
	$kelas = mysqli_fetch_array(mysqli_query($conn, "SELECT kelas FROM tkelas WHERE id_kelas = '$_POST[kelas]'"));
	$sql = mysqli_query($conn, "SELECT * FROM tsiswa WHERE id_kelas = '$_POST[kelas]' AND aktif = 'Y' ORDER BY nis ASC");
	$numrows = mysqli_num_rows($sql);
	$kategori = mysqli_fetch_array(mysqli_query($conn, "SELECT kelas FROM tkelas WHERE id_kelas = '$_POST[kelas]'"));
	$semester = mysqli_fetch_array(mysqli_query($conn, "SELECT id_semester FROM tsemester WHERE aktif = 'Y'"));
	if ($numrows > 0){
		echo "<h4>Kelas: $kategori[kelas]<br> Semester: $semester[id_semester]</h4>";
		echo "<link href='css/bootstrap.min.css' rel='stylesheet' id='bootstrap-css'>";
		echo "<script src='js/bootstrap.min.js'></script>";
		echo "<table class='table table-striped'>
				<tr>
					<th><font face=tahoma size=2>No</font></th>
					<th><font face=tahoma size=2>NIS</font></th>
					<th><font face=tahoma size=2>Nama Siswa</font></th>
					<th><font face=tahoma size=2>Aktif</font></th>
					<th>Aksi</th>
				</tr>";
		$no = 1;
		while($data = mysqli_fetch_array($sql)){
			echo "<tr>
					<td><font face=tahoma size=2>$no</font></th>
					<td><font face=tahoma size=2>$data[nis]</font></td>
					<td><font face=tahoma size=2>$data[nama]</font></td>
					<td><font face=tahoma size=2>$data[aktif]</font></td>
					<td><font face=tahoma size=2><a href='?module=siswa&act=update&nis=$data[nis]'>Update</a> | <a href='modul/mod_siswa/aksi_siswa.php?module=siswa&act=hapus&id=$data[nis]'>Hapus</a></font></td>
				  </tr>";
			$no++;
		}
		echo "</table>";
	}
	else{
		echo "<h4>Pencarian kelas : $kelas[kelas]<br> Semester: $semester[id_semester]<br>
				Hasil : Data tidak ditemukan</h4>";
	}
}

	break;
	
	case "tambahsiswa":
	echo "<h3>Tambah Siswa</h3>";
	echo "<form method=POST action=$aksi?module=siswa&act=input>
		<table border=1>
			<tr>
			<td><font face=tahoma size=2>NIS</font></td><td><font face=tahoma size=2>:</font></td><td><input type=text name=nis required></td>
			</tr>
			<tr><td><font face=tahoma size=2>Kelas</font></td><td><font face=tahoma size=2>:</font></td><td><select name=kelas>";
			$sql = mysqli_query($conn, "SELECT * FROM tkelas ORDER BY kelas ASC");
			while($data = mysqli_fetch_array($sql)){
				echo "<option value=$data[id_kelas]>$data[kelas]</option>";
			}
	echo "	</select></td></tr><tr>
			<td><font face=tahoma size=2>Nama</font></td><td><font face=tahoma size=2>:</font></td><td><input type=text name=nama required></td>
			</tr>
			<tr valign=top>
			<td><font face=tahoma size=2>Alamat</font></td><td><font face=tahoma size=2>:</font></td><td><textarea name=alamat cols=40 rows=5 required></textarea></td>
			</tr>
			<tr>
			<td><font face=tahoma size=2>Tempat Lahir</font></td><td><font face=tahoma size=2>:</font></td><td><input type=text name=tmp_lahir required></td>
			</tr>
			<tr>
			<td><font face=tahoma size=2>Tgl. Lahir</font></td><td><font face=tahoma size=2 required>:</font></td><td>";
			combotgl(1,31,'tgl_lahir',$tgl_skrg);
			combonamabln(1,12,'bln_lahir',$bln_sekarang);
			combothn($thn_sekarang-20,$thn_sekarang-13,'thn_lahir',$thn_sekarang);
	echo "	</td>
			</tr>
			<tr>
			<td><font face=tahoma size=2>Aktif</font></td><td><font face=tahoma size=2>:</font></td><td><font face=tahoma size=2><input type=radio name=aktif value='Y' required>Y <input type=radio name=aktif value='N' required>N</font></td>
			</tr>
			<tr>
			<td><font face=tahoma size=2>Email</font></td><td><font face=tahoma size=2>:</font></td><td><input type=email name=email required></td>
			</tr>
			<tr>
			<td><font face=tahoma size=2>Telp</font></td><td><font face=tahoma size=2>:</font></td><td><input type=text name=telp required></td>
			</tr>
			<tr>
			<td><font face=tahoma size=2>HP.</font></td><td><font face=tahoma size=2>:</font></td><td><input type=text name=hp required></td>
			</tr>
			<tr>
			<td><input type=submit value=Simpan></td>
			</tr>
		  </table>";
	break;
	
	case "update":
	$data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tsiswa WHERE nis='$_GET[nis]'"));
	if($data[aktif]=='Y'){
		$a = checked;
	}
	elseif($data[aktif]=='N'){
		$b = checked;
	}
	else{
		$a = '';
		$b = '';
	}
	echo "<h3>Edit Siswa</h3>";
	echo "<form method=POST action=$aksi?module=siswa&act=update>
		<table border=1>
			<tr>
			<td><font face=tahoma size=2>NIS</font></td><td><font face=tahoma size=2>:</font></td><td><input type=text name=nis value='$data[nis]' disabled><input type=hidden name=nis value='$data[nis]'></td>
			</tr>
			<tr><td><font face=tahoma size=2>Kelas</font></td><td><font face=tahoma size=2>:</font></td><td><select name=kelas>";
			$sql = mysqli_query($conn, "SELECT * FROM tkelas ORDER BY kelas ASC");
			while($r = mysqli_fetch_array($sql)){
				if($r[id_kelas] == $data[id_kelas]){
					echo "<option value=$r[id_kelas] SELECTED>$r[kelas]</option>";
				}
				else{
					echo "<option value=$r[id_kelas]>$r[kelas]</option>";
				}
			}
	echo "	</select></td></tr><tr>
			<td><font face=tahoma size=2>Nama</font></td><td><font face=tahoma size=2>:</font></td><td><input type=text name=nama value='$data[nama]' required></td>
			</tr>
			<tr valign=top>
			<td><font face=tahoma size=2>Alamat</font></td><td><font face=tahoma size=2>:</font></td><td><textarea name=alamat cols=40 rows=5 required>$data[alamat]</textarea></td>
			</tr>
			<tr>
			<td><font face=tahoma size=2>Tempat Lahir</font></td><td><font face=tahoma size=2>:</font></td><td><input type=text name=tmp_lahir value='$data[tempat_lahir]' required></td>
			</tr>
			<tr>
			<td><font face=tahoma size=2>Tgl. Lahir</font></td><td><font face=tahoma size=2>:</font></td><td>";
			$get_tgl2=substr("$data[tanggal_lahir]",7,2);
			combotgl(1,31,'tgl_lahir',$get_tgl2);
			$get_bln2=substr("$data[tanggal_lahir]",5,2);
			combonamabln(1,12,'bln_lahir',$get_bln2);
			$get_thn2=substr("$data[tanggal_lahir]",0,4);
			combothn($thn_sekarang-20,$thn_sekarang-13,'thn_lahir',$get_thn2);
	echo "	</td>
			</tr>
			<tr>
			<td><font face=tahoma size=2>Aktif</font></td><td><font face=tahoma size=2>:</font></td><td><font face=tahoma size=2><input type=radio name=aktif value='Y' $a required>Y <input type=radio name=aktif value='N' $b required>N</font></td>
			</tr>
			<tr>
			<td><font face=tahoma size=2>Email</font></td><td><font face=tahoma size=2>:</font></td><td><input type=email name=email value='$data[email]' required></td>
			</tr>
			<tr>
			<td><font face=tahoma size=2>Telp</font></td><td><font face=tahoma size=2>:</font></td><td><input type=text name=telp value='$data[telp]' required></td>
			</tr>
			<tr>
			<td><font face=tahoma size=2>HP.</font></td><td><font face=tahoma size=2>:</font></td><td><input type=text name=hp value='$data[hp]' required></td>
			</tr>
			<tr>
			<td><input type=submit value=Simpan></td>
			</tr>
		  </table>";
	break;
}
?>