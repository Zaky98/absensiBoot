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
	
	// Hapus user
	if ($module=='usersiswa' AND $act=='hapus'){
		mysqli_query($conn, "DELETE FROM tusersiswa WHERE id_user = '$_GET[id]'");
		header('location:../../main.php?module=usersiswa');
	}
	
	// Input user
	elseif ($module=='usersiswa' AND $act=='input'){
		$password = $_POST['password'];
		
		$password1 = password_hash($password, PASSWORD_DEFAULT);
		mysqli_query($conn, "INSERT INTO tusersiswa(username,password,nama_lengkap) VALUES('$_POST[username]','$password1','$_POST[nama_lengkap]')");
		header('location:../../main.php?module=usersiswa');
	}
	
	// Update user
	elseif ($module=='usersiswa' AND $act=='update'){
		if (!empty($_POST['password'])){
			$password = password_hash($POST_['password'], PASSWORD_DEFAULT);
			mysqli_query($conn, "UPDATE tusersiswa SET password = '$password',nama_lengkap='$_POST[nama_lengkap]' WHERE id_user = '$_POST[id]'");
			header('location:../../main.php?module=usersiswa');
		}
		else{
			mysqli_query($conn, "UPDATE tusersiswa SET nama_lengkap='$_POST[nama_lengkap]' WHERE id_user = '$_POST[id]'");
			header('location:../../main.php?module=usersiswa');
		}
	}
}
?>