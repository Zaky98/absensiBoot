<?php


session_start();
if(!isset($_SESSION["login"])){
	echo $_SESSION["login"];
	header("location:../index.php");
	exit;
}
else{
	include "../../../koneksi/koneksi.php";
	include "../../../fungsi/library.php";
	
	$module=$_GET['module'];
	$act=$_GET['act'];
	
	// Hapus Absen
	if ($module=='absen' AND $act=='hapus'){
		mysqli_query($conn, "DELETE FROM tabsen WHERE id_absen = '$_GET[id]'");
		header('location:../../main.php?module=absen');
	}
	
	// Input Absen
	elseif ($module=='absen' AND $act=='input'){
		$data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tsemester WHERE aktif = 'Y'"));
		$numrows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tabsen WHERE nis = '$_POST[nis]' AND id_semester = '$data[id_semester]' AND tanggal = '$_POST[tanggal]'"));
		$numrowsNis = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tsiswa WHERE nis = '$_POST[nis]'"));
				
		if ($numrows > 0){
			echo "<script language='javascript'>alert('Data Absen sudah dimasukkan sebelumnya.');
						window.location = '../../main.php?module=absen'</script>";
		}
		else{
			if ($numrowsNis > 0){
				mysqli_query($conn, "INSERT INTO tabsen(nis,id_semester,tanggal,keterangan) VALUES('$_POST[nis]','$data[id_semester]','$_POST[tanggal]','$_POST[keterangan]')");
				header('location:../../main.php?module=absen');
			}
			else{
				echo "<script language='javascript'>alert('Data NIS tidak terdaftar.');
						window.location = '../../main.php?module=absen'</script>";
			}
		}
	}
	
	// Update Absen
	elseif ($module=='absen' AND $act=='update'){
		mysqli_query($conn, "UPDATE tabsen SET 	tanggal = '$_POST[tanggal]',
										keterangan = '$_POST[keterangan]'
										WHERE id_absen = '$_POST[id]'");
		header('location:../../main.php?module=absen');
	}
	
	// Update kelas
	elseif ($module=='kelas' AND $act=='update'){
		mysql_query("UPDATE tkelas SET kelas = '$_POST[kelas]' WHERE id_kelas = '$_POST[id]'");
		header('location:../../main.php?module=absen');
	}
}
?>