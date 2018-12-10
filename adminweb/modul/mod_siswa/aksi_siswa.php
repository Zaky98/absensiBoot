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
	
	//Hapus Siswa
	if ($module=='siswa' AND $act=='hapus'){
		mysqli_query($conn, "DELETE FROM tsiswa WHERE nis = '$_GET[id]'");
		header('location:../../main.php?module=siswa');
	}
	
	// Input Siswa
	if ($module=='siswa' AND $act=='input'){
		$numrows = mysqli_num_rows(mysqli_query($conn, "SELECT nis FROM tsiswa WHERE nis = '$_POST[nis]'"));
		$tgl_lahir = $_POST[thn_lahir]."-".$_POST[bln_lahir]."-".$_POST[tgl_lahir];
		if ($numrows > 0){
			echo "<script language='javascript'>alert('NIS sudah ada, cek kembali');
					window.location = '../../main.php?module=siswa'</script>";
		}
		else{
			mysqli_query($conn, "INSERT INTO tsiswa(nis,nama,alamat,tempat_lahir,tanggal_lahir,aktif,email,telp,hp,id_kelas)
							VALUES('$_POST[nis]','$_POST[nama]','$_POST[alamat]','$_POST[tmp_lahir]','$tgl_lahir','$_POST[aktif]','$_POST[email]','$_POST[telp]','$_POST[hp]','$_POST[kelas]')");
			header('location:../../main.php?module=siswa');
		}
	}
	
	// Update siswa
	elseif ($module=='siswa' AND $act=='update'){
		$numrows = mysqli_num_rows(mysqli_query($conn, "SELECT nis FROM tsiswa WHERE nis = '$_POST[nis_ubah]'"));
		$tgl_lahir = $_POST[thn_lahir]."-".$_POST[bln_lahir]."-".$_POST[tgl_lahir];
		if ($numrows > 0){
			echo "<script language='javascript'>alert('NIS sudah ada, cek kembali');
					window.location = '../../main.php?module=siswa'</script>";
		}
		else{
			mysqli_query($conn, "UPDATE tsiswa SET 	nama = '$_POST[nama]',
											alamat = '$_POST[alamat]',
											tempat_lahir = '$_POST[tmp_lahir]',
											tanggal_lahir = '$tgl_lahir',
											aktif = '$_POST[aktif]',
											email = '$_POST[email]',
											telp = '$_POST[telp]',
											hp = '$_POST[hp]',
											id_kelas = '$_POST[kelas]'
											WHERE nis = '$_POST[nis]'");
			header('location:../../main.php?module=siswa');
		}
	}
}
?>