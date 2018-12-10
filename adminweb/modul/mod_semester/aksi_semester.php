<?php
session_start();
if(!isset($_SESSION["login"])){
	echo $_SESSION["login"];
	header("location:../index.php");
	exit;
}
else{
	include "../../../koneksi/koneksi.php";
	$data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tsemester WHERE id_semester = '$_GET[id]'"));
	if ($data[aktif] == 'N'){
		mysqli_query($conn, "UPDATE tsemester SET aktif = 'N'");
		mysqli_query($conn, "UPDATE tsemester SET aktif = 'Y' WHERE id_semester = '$_GET[id]'");
	}
	else{
		mysqli_query($conn, "UPDATE tsemester SET aktif = 'Y'");
		mysqli_query($conn, "UPDATE tsemester SET aktif = 'N' WHERE id_semester = '$_GET[id]'");
	}
	header('location: ../../main.php?module=semester');
}
?>