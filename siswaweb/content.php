<?php
error_reporting(0);
session_start();
include "../koneksi/koneksi.php";
include "../fungsi/library.php";
include "../fungsi/class_paging.php";
include "../fungsi/fungsi_indotgl.php";
include "../fungsi/fungsi_combobox.php";

if(!isset($_SESSION["login"])){
	echo $_SESSION["login"];
	header("location:../index.php");
	exit;
}

// Bagian Home
if ($_GET['module']=='home'){
	echo " <h3>Selamat Datang</h3>
			<p>Hai <b>$_SESSION[nama_lengkap]</b>, selamat datang di halaman Administrator Sistem Absensi SMKN 1 Banyuwangi.<br> 
			Silahkan klik menu pilihan yang berada di sebelah kiri untuk mengelola website. </p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			
			<p align=right>Login : $hari_ini, ";
			echo tgl_indo(date("Y m d")); 
			echo " | "; 
			echo date("H:i:s");
			echo " WIB</p>";
}

// Bagian Siswa
elseif ($_GET['module']=='siswa'){
	include "modul/mod_siswa/siswa.php";
}

// Bagian kelas
elseif ($_GET['module']=='kelas'){
	include "modul/mod_kelas/kelas.php";
}

// Bagian semester
elseif ($_GET['module']=='semester'){
	include "modul/mod_semester/semester.php";
}

// Bagian absensi
elseif ($_GET['module']=='absen'){
	include "modul/mod_absen/absen.php";
}

// Bagian User
elseif ($_GET['module']=='user'){
	include "modul/mod_user/user.php";
}

// Apabila modul tidak ditemukan
else{
  echo "<p><b>MODUL BELUM ADA ATAU BELUM LENGKAP</b></p>";
}
?>
