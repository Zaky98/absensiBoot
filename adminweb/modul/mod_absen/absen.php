<script type="text/javascript"> 
      $(document).ready(function(){
        $("#tanggal").datepicker({
					dateFormat  : "yy-mm-dd",        
          changeMonth : true,
          changeYear  : true,
        });
      });
</script>

<?php

session_start();
if(!isset($_SESSION["login"])){
	echo $_SESSION["login"];
	header("location:../index.php");
	exit;
}

$aksi = "modul/mod_absen/aksi_absen.php";
switch($_GET[act]){
	default:
	echo "<h3>Manajemen Absensi</h3>";
	echo "<br>";
	echo "<br>";
	echo "<br>";
	echo "<body style='font-size:65%;'><form method=POST action='?module=absen'>
			<font face=tahoma size=2>Pilih Kelas
			<font face=tahoma size=2>:</font>
			<select name=kelas>";
				$sql = mysqli_query($conn, "SELECT * FROM tkelas ORDER BY id_kelas ASC");
				while ($data = mysqli_fetch_array($sql)){
					echo "<option value=$data[id_kelas]>$data[kelas]</option>";
				}
	echo 	"</select>";
	echo    "<br>";
	echo "<br>";
	echo	"<font face=tahoma size=2>Tanggal</font>
		 	<font face=tahoma size=2> :</font>
		 	<input id='tanggal' type='text' name='tanggal' required>
			<input type=submit value=Go name=Go class='btn-primary'>
			</form></body>";
	
	echo "<p>&nbsp;</p>";
	if(isset($_POST['Go'])){

			$numrows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tabsen,tsiswa WHERE id_kelas = '$_POST[kelas]' AND tanggal = '$_POST[tanggal]'"));		
			$kelas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tkelas WHERE id_kelas = '$_POST[kelas]'"));
			$semester = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tsemester WHERE aktif = 'Y'"));
			$tanggal = tgl_indo($_POST[tanggal]);
			echo 	"<b>Kelas : $kelas[kelas]</b> <br> 
					Semester : $semester[id_semester] <br>
					Tanggal : $tanggal";
			echo 	"<table class='table table-striped'>
					<tr>
						<th><font face=tahoma size=2>No</font></th>
						<th><font face=tahoma size=2>NIS</font></th>
						<th><font face=tahoma size=2>Nama Siswa</font></th>
						<th><font face=tahoma size=2>Keterangan</font></th>
						<th><font face=tahoma size=2>Aksi</font></th>
					</tr>";		

			$sql = mysqli_query($conn, "SELECT tsiswa.nis, tsiswa.nama, tabsen.keterangan, tabsen.id_absen FROM tsiswa LEFT JOIN tabsen ON tsiswa.nis = tabsen.nis AND tanggal='$_POST[tanggal]' AND id_semester = '$semester[id_semester]'");
			$no = 1;
			while ($data = mysqli_fetch_array($sql)){
				if($data[keterangan] != null){
					echo "<tr>
						<td><font face=tahoma size=2>$no</font></td>
						<td><font face=tahoma size=2>$data[nis]</font>
						</td><td><font face=tahoma size=2>$data[nama]</font>
						</td><td align=center><font face=tahoma size=2>$data[keterangan]</font></td>
						<td><font face=tahoma size=2><a href='?module=absen&act=editabsen&id=$data[id_absen]'><img src='../images/update.png'> Update</a> | <a href='$aksi?module=absen&act=hapus&id=$data[id_absen]'><img src='../images/hapus.png'> Hapus</a> </font></td>
						</tr>";
					$no++;
				}
			}
			echo "</table>";
		
	}
			
	break;
	
	case "tambahabsen":
	echo "<h3>Tambah Absen</h3>";
	echo "	<body style='font-size:65%;'><form method=POST action=$aksi?module=absen&act=input>
			<table border=1>
				<tr><td><font face=tahoma size=2>NIS</font></td><td><font face=tahoma size=2>:</font></td><td><input type='text' name='nis' size=32></td></tr>
				<tr><td><font face=tahoma size=2>Tanggal</font></td><td><font face=tahoma size=2>:</font></td><td><input id='tanggal' type='text' name='tanggal' size=32> </td></tr>
				<tr><td><font face=tahoma size=2>Keterangan</font></td><td><font face=tahoma size=2>:</font></td>
				<td><font face=tahoma size=2><input type='radio' name='keterangan' value='H'> Hadir 
				<input type='radio' name='keterangan' value='S'> Sakit 
				<input type='radio' name='keterangan' value='I'> Izin
				<input type='radio' name='keterangan' value='A'> Alpha 
				</font></td></tr>
				<tr><td><input type=submit value=Simpan></td></tr>
			</table>
			</form></body>";
	break;
	
	case "editabsen":
	$data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tabsen, tsiswa WHERE id_absen = '$_GET[id]' AND tabsen.nis = tsiswa.nis"));
	if($data[keterangan]=='H'){
		$h = checked;
	}
	elseif($data[keterangan]=='I'){
		$i = checked;
	}
	elseif($data[keterangan]=='S'){
		$s = checked;
	}
	elseif($data[keterangan]=='A'){
		$a = checked;
	}
	else{
		$h = '';
		$i = '';
		$s = '';
		$a = '';
	}
	
	echo "<h3>Edit Absen</h3>";
	echo "	<body style='font-size:65%;'><form method=POST action=$aksi?module=absen&act=update>
			<input type=hidden name=id value='$data[id_absen]'>
			<table border=1>
				<tr><td><font face=tahoma size=2>NIS</font></td><td><font face=tahoma size=2>:</font></td><td><input type='text' name='nis' size=32 value='$data[nis]' disabled></td></tr>
				<tr><td><font face=tahoma size=2>Nama</font></td><td><font face=tahoma size=2>:</font></td><td><input type='text' name='nama' size=32 value='$data[nama]' disabled></td></tr>
				<tr><td><font face=tahoma size=2>Tanggal</font></td><td><font face=tahoma size=2>:</font></td><td><input id='tanggal' type='text' name='tanggal' size=32 value='$data[tanggal]'> </td></tr>
				<tr><td><font face=tahoma size=2>Keterangan</font></td><td><font face=tahoma size=2>:</font></td>
				<td><font face=tahoma size=2><input type='radio' name='keterangan' value='H' $h> Hadir 
				<input type='radio' name='keterangan' value='S' $s> Sakit 
				<input type='radio' name='keterangan' value='I' $i> Izin
				<input type='radio' name='keterangan' value='A' $a> Alpha 
				</font></td></tr>
				<tr><td><input type=submit value=Simpan></td></tr>
			</table>
			</form></body>";
	break;
	
	case "updatekelas":
	$data = mysqli_fetch_array(mysqli_query("SELECT * FROM tkelas WHERE id_kelas = '$_GET[id]'"));
	echo "<h3>Ubah Kelas</h3>";
	echo "	<form method=POST action=$aksi?module=kelas&act=update>
			<input type=hidden name=id value=$data[id_kelas]>
			<table border=1>
				<tr><td><font face=tahoma size=2>ID Kelas</font></td><td><font face=tahoma size=2>:</font></td><td><input type='text' name='kelas' value='$data[id_kelas]' disabled></td></tr>
				<tr><td><font face=tahoma size=2>Nama Kelas</font></td><td><font face=tahoma size=2>:</font></td><td><input type='text' name='kelas' value='$data[kelas]'></td></tr>
				<tr><td><input type=submit value=Update></td></tr>
			</table>
			</form>";
	break;
}
?>