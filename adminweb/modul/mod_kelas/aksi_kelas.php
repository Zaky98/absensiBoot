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
	
	// Hapus kelas
	if ($module=='kelas' AND $act=='hapus'){
		mysqli_query($conn, "DELETE FROM tkelas WHERE id_kelas = '$_GET[id]'");
		header('location:../../main.php?module=kelas');
	}
	
	// Input kelas
	elseif ($module=='kelas' AND $act=='input'){
		mysqli_query($conn, "INSERT INTO tkelas(kelas) VALUES('$_POST[kelas]')");
		header('location:../../main.php?module=kelas');
	}
	
	// Update kelas
	elseif ($module=='kelas' AND $act=='update'){
		mysqli_query($conn, "UPDATE tkelas SET kelas = '$_POST[kelas]' WHERE id_kelas = '$_POST[id]'");
		header('location:../../main.php?module=kelas');
	}
}
?>