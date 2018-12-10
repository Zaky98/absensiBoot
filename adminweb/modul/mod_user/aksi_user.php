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
	if ($module=='user' AND $act=='hapus'){
		mysqli_query($conn, "DELETE FROM tuser WHERE id_user = '$_GET[id]'");
		header('location:../../main.php?module=user');
	}
	
	// Input user
	elseif ($module=='user' AND $act=='input'){
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$password1 = password_hash($password, PASSWORD_DEFAULT);
		mysqli_query($conn, "INSERT INTO tuser(username,password,nama_lengkap) VALUES('$_POST[username]','$password1','$_POST[nama_lengkap]')");
		header('location:../../main.php?module=user');
	}
	
	// Update user
	elseif ($module=='user' AND $act=='update'){
		if (!empty($_POST['password'])){
			$password = password_hash($POST_['password'], PASSWORD_DEFAULT);
			mysqli_query($conn, "UPDATE tuser SET password = '$password',nama_lengkap='$_POST[nama_lengkap]' WHERE id_user = '$_POST[id]'");
			header('location:../../main.php?module=user');
		}
		else{
			mysqli_query($conn, "UPDATE tuser SET nama_lengkap='$_POST[nama_lengkap]' WHERE id_user = '$_POST[id]'");
			header('location:../../main.php?module=user');
		}
	}
}
?>