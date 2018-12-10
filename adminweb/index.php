<?php
session_start();
if(!isset($_SESSION["login"])){
	echo $_SESSION["login"];
	header("location: ../index.php");
	exit;
}
else{
	header('location: main.php?module=home');
}
?>