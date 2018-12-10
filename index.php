<?php
session_start();
require "koneksi/koneksi.php";

    if(isset($_COOKIE["login"])){
        if($_COOKIE["login"] == 'true'){
            $_SESSION['login'] = true;
        }
    }
	
	//remember me
	if(isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
        $id = $_COOKIE['id'];
		$key = $_COOKIE['key'];

        $result = mysqli_query($conn, "SELECT username FROM tuser WHERE id_user = '$id'");
		$row = mysqli_fetch_assoc($result);
		$result = mysqli_query($conn, "SELECT username FROM tusersiswa WHERE id_user = '$id'");
		$rows = mysqli_fetch_assoc($result);
		

        if($key === $row['username']){
			$_SESSION['login'] = true;
			header("location: adminweb/main.php?module=home");
        	exit;
    	    } elseif ($key === $rows['username']){
			$_SESSION['login'] = true;
			header("location: siswaweb/main.php?module=home");
        	exit;
		}
	}

	if(isset($_POST['login'])){
		$ea = $_POST['admin'];

		if($ea == "admin"){
		$username = $_POST['username'];
		$pass     = $_POST['password'];
	
		$login  = mysqli_query($conn, "SELECT * FROM tuser WHERE username = '$username'");
		$ketemu = mysqli_num_rows($login);
		$r		= mysqli_fetch_array($login);

		if ($ketemu > 0){

			if(password_verify($pass, $r['password'])){

			$_SESSION["login"] = true;
			
			$_SESSION["nama_lengkap"] = $r["nama_lengkap"];

            if(isset($_POST['remember'])){
                setcookie('id', $r['id_user'], time()+60);
                setcookie('key', $r['username'], time()+60);
            }

			$date = date('Y-m-d H:i:s');
			mysqli_query($conn, "UPDATE tuser SET last_login = '$date' WHERE username = '$r[username]'");
			header('location:adminweb/main.php?module=home');
            exit;

			} else{
			echo "<link href=css/login.css rel=stylesheet type=text/css>";
			echo "<center>LOGIN GAGAL! <br> 
					Username atau Password Anda tidak benar.<br>
					Atau account Anda sedang diblokir.<br>";
					echo "<a href><b></b></a></center>";
	}
	}else{
		echo "<link href=css/login.css rel=stylesheet type=text/css>";
			echo "<center>LOGIN GAGAL! <br> 
					Username atau Password Anda tidak benar.<br>
					Atau account Anda sedang diblokir.<br>";
					echo "<a href><b></b></a></center>";
	} 
	}elseif($ea == "siswa"){
		$username = $_POST['username'];
		$pass     = $_POST['password'];
	
		$login  = mysqli_query($conn, "SELECT * FROM tusersiswa WHERE username = '$username'");
		$ketemu = mysqli_num_rows($login);
		$r		= mysqli_fetch_assoc($login);

		var_dump($username);
		var_dump($pass);
		var_dump($r);

		if ($ketemu > 0){
			
			if(password_verify($pass, $r['password'])){

			$_SESSION["login"] = true;
			
			$_SESSION["nama_lengkap"] = $r["nama_lengkap"];

            if(isset($_POST['remember'])){
                setcookie('id', $r['id_user'], time()+60);
                setcookie('key', $r['username'], time()+60);
            }

			header('location:siswaweb/main.php?module=home');
			exit;
			
			}

		} else{
			echo "<link href=css/login.css rel=stylesheet type=text/css>";
			echo "<center>LOGIN GAGAL! <br> 
					Username atau Password Anda tidak benar.<br>
					Atau account Anda sedang diblokir.<br>";
					echo "<a href><b></b></a></center>";
		}
	}else{
		echo "<link href=css/login.css rel=stylesheet type=text/css>";
			echo "<center>LOGIN GAGAL! <br> 
					Username atau Password Anda tidak benar.<br>
					Atau account Anda sedang diblokir.<br>";
	}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Online Attendance SMKN 1 Banyuwangi</title>
<link rel="stylesheet" href="adminweb/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="adminweb/js/bootstrap.min.js"></script> 
<style type="text/css">

	body {
		margin: 0;
		background-image: url("adminweb/img/bg.jpg");
		background-repeat: no-repeat;
	}

	.login-form {
		position: absolute;
		width: 300px;
		height: 200px;
		z-index: 15;
		top: 50%;
		left: 50%;
		margin: -190px 0 0 -150px;
	}
    .login-form form {
    	margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {        
        font-size: 15px;
        font-weight: bold;
    }
</style>
</head>
<body>
	<div class="login-form">
		<form action="" method="post">
			<h2 class="text-center">Log in</h2>       
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Username" required="required" name="username">
			</div>
			<div class="form-group">
				<input type="password" class="form-control" placeholder="Password" required="required" name="password">
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-block" name="login">Log in</button>
			</div> 
			<div class="form-group">
				<label> Login as : ‏‏‎ </label>
                <input type="radio" id="as" name="admin" value="admin" required="required">
				<label for="as"> Admin ‏‏‎ </label>
				<label> / ‏‏‎ </label>
				<input type="radio" id="as" name="admin" value="siswa" required="required">
				<label for="as"> Siswa </label>
				<br>
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember me</label>
            </div>   
			<p class="text-center"><a href="call.html">Create an Account</a></p>  
		</form>
	</div>
</body>
</html>                                		                            