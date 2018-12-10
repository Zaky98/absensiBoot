<?php
session_start();
if(!isset($_SESSION["login"])){
	echo $_SESSION["login"];
	header("location:../index.php");
	exit;
}
else{
?>

<html>
<head>
	<title> Online Attendance SMKN 1 Banyuwangi</title>
	<link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="js/vendor/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

	<script>
		$(document).ready(function () {
		var trigger = $('.hamburger'),
			overlay = $('.overlay'),
			isClosed = false;

			trigger.click(function () {
			hamburger_cross();      
			});

			function hamburger_cross() {

			if (isClosed == true) {          
				overlay.hide();
				trigger.removeClass('is-open');
				trigger.addClass('is-closed');
				isClosed = false;
			} else {   
				overlay.show();
				trigger.removeClass('is-closed');
				trigger.addClass('is-open');
				isClosed = true;
			}
		}
		
		$('[data-toggle="offcanvas"]').click(function () {
				$('#wrapper').toggleClass('toggled');
		});  
		});
	</script>

	<style>

	body {
    position: relative;
    overflow-x: hidden;
	background-image: url('img/bg.jpg');
	}
	body,
	html { height: 100%;}
	.nav .open > a, 
	.nav .open > a:hover, 
	.nav .open > a:focus {background-image: transparent;}

	/*-------------------------------*/
	/*           Wrappers            */
	/*-------------------------------*/

	#wrapper {
		padding-left: 0;
		-webkit-transition: all 0.5s ease;
		-moz-transition: all 0.5s ease;
		-o-transition: all 0.5s ease;
		transition: all 0.5s ease;
	}

	#wrapper.toggled {
		padding-left: 220px;
	}

	#sidebar-wrapper {
		z-index: 1000;
		left: 220px;
		width: 0;
		height: 100%;
		margin-left: -220px;
		overflow-y: auto;
		overflow-x: hidden;
		background: #1a1a1a;
		-webkit-transition: all 0.5s ease;
		-moz-transition: all 0.5s ease;
		-o-transition: all 0.5s ease;
		transition: all 0.5s ease;
	}

	#sidebar-wrapper::-webkit-scrollbar {
	display: none;
	}

	#wrapper.toggled #sidebar-wrapper {
		width: 220px;
	}

	#page-content-wrapper {
		width: 100%;
		padding-top: 70px;
	}

	#wrapper.toggled #page-content-wrapper {
		position: absolute;
		margin-right: -220px;
	}

	/*-------------------------------*/
	/*     Sidebar nav styles        */
	/*-------------------------------*/

	.sidebar-nav {
		position: absolute;
		top: 0;
		width: 220px;
		margin: 0;
		padding: 0;
		list-style: none;
	}

	.sidebar-nav li {
		position: relative; 
		line-height: 20px;
		display: inline-block;
		width: 100%;
	}

	.sidebar-nav li:before {
		content: '';
		position: absolute;
		top: 0;
		left: 0;
		z-index: -1;
		height: 100%;
		width: 3px;
		background-color: #1c1c1c;
		-webkit-transition: width .2s ease-in;
		-moz-transition:  width .2s ease-in;
		-ms-transition:  width .2s ease-in;
		transition: width .2s ease-in;

	}

	.sidebar-nav li:nth-child(6):before {
		background-color: red;   
	}
	.sidebar-nav li:nth-child(7):before {
		background-color: purple;   
	}
	.sidebar-nav li:nth-child(8):before {
		background-color: yellow;   
	}
	.sidebar-nav li:nth-child(9):before {
		background-color: green;   
	}
	.sidebar-nav li:nth-child(10):before {
		background-color: blue;   
	}
	.sidebar-nav li:nth-child(11):before {
		background-color: gold;   
	}
	.sidebar-nav li:nth-child(12):before {
		background-color: orange;   
	}
	

	.sidebar-nav li:hover:before,
	.sidebar-nav li.open:hover:before {
		width: 100%;
		-webkit-transition: width .2s ease-in;
		-moz-transition:  width .2s ease-in;
		-ms-transition:  width .2s ease-in;
				transition: width .2s ease-in;

	}

	.sidebar-nav li a {
		display: block;
		color: #ddd;
		text-decoration: none;
		padding: 10px 15px 10px 30px;    
	}

	.sidebar-nav li a:hover,
	.sidebar-nav li a:active,
	.sidebar-nav li a:focus,
	.sidebar-nav li.open a:hover,
	.sidebar-nav li.open a:active,
	.sidebar-nav li.open a:focus{
		color: #fff;
		text-decoration: none;
		background-color: transparent;
	}

	.sidebar-nav > .sidebar-brand {
		height: 65px;
		font-size: 20px;
		line-height: 44px;
	}
	.sidebar-nav .dropdown-menu {
		position: relative;
		width: 100%;
		padding: 0;
		margin: 0;
		border-radius: 0;
		border: none;
		background-color: #222;
		box-shadow: none;
	}

	/*-------------------------------*/
	/*       Hamburger-Cross         */
	/*-------------------------------*/

	.hamburger {
	position: fixed;
	top: 20px;  
	z-index: 999;
	display: block;
	width: 32px;
	height: 32px;
	margin-left: 15px;
	background: transparent;
	border: none;
	}
	.hamburger:hover,
	.hamburger:focus,
	.hamburger:active {
	outline: none;
	}
	.hamburger.is-closed:before {
	content: '';
	display: block;
	width: 100px;
	font-size: 14px;
	color: #fff;
	line-height: 32px;
	text-align: center;
	opacity: 0;
	-webkit-transform: translate3d(0,0,0);
	-webkit-transition: all .35s ease-in-out;
	}
	.hamburger.is-closed:hover:before {
	opacity: 1;
	display: block;
	-webkit-transform: translate3d(-100px,0,0);
	-webkit-transition: all .35s ease-in-out;
	}

	.hamburger.is-closed .hamb-top,
	.hamburger.is-closed .hamb-middle,
	.hamburger.is-closed .hamb-bottom,
	.hamburger.is-open .hamb-top,
	.hamburger.is-open .hamb-middle,
	.hamburger.is-open .hamb-bottom {
	position: absolute;
	left: 0;
	height: 4px;
	width: 100%;
	}
	.hamburger.is-closed .hamb-top,
	.hamburger.is-closed .hamb-middle,
	.hamburger.is-closed .hamb-bottom {
	background-color: #1a1a1a;
	}
	.hamburger.is-closed .hamb-top { 
	top: 5px; 
	-webkit-transition: all .35s ease-in-out;
	}
	.hamburger.is-closed .hamb-middle {
	top: 50%;
	margin-top: -2px;
	}
	.hamburger.is-closed .hamb-bottom {
	bottom: 5px;  
	-webkit-transition: all .35s ease-in-out;
	}

	.hamburger.is-closed:hover .hamb-top {
	top: 0;
	-webkit-transition: all .35s ease-in-out;
	}
	.hamburger.is-closed:hover .hamb-bottom {
	bottom: 0;
	-webkit-transition: all .35s ease-in-out;
	}
	.hamburger.is-open .hamb-top,
	.hamburger.is-open .hamb-middle,
	.hamburger.is-open .hamb-bottom {
	background-color: #1a1a1a;
	}
	.hamburger.is-open .hamb-top,
	.hamburger.is-open .hamb-bottom {
	top: 50%;
	margin-top: -2px;  
	}
	.hamburger.is-open .hamb-top { 
	-webkit-transform: rotate(45deg);
	-webkit-transition: -webkit-transform .2s cubic-bezier(.73,1,.28,.08);
	}
	.hamburger.is-open .hamb-middle { display: none; }
	.hamburger.is-open .hamb-bottom {
	-webkit-transform: rotate(-45deg);
	-webkit-transition: -webkit-transform .2s cubic-bezier(.73,1,.28,.08);
	}
	.hamburger.is-open:before {
	content: '';
	display: block;
	width: 100px;
	font-size: 14px;
	color: #fff;
	line-height: 32px;
	text-align: center;
	opacity: 0;
	-webkit-transform: translate3d(0,0,0);
	-webkit-transition: all .35s ease-in-out;
	}
	.hamburger.is-open:hover:before {
	opacity: 1;
	display: block;
	-webkit-transform: translate3d(-100px,0,0);
	-webkit-transition: all .35s ease-in-out;
	}

	/*-------------------------------*/
	/*            Overlay            */
	/*-------------------------------*/

	.overlay {
		position: fixed;
		display: none;
		width: 100%;
		height: 100%;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background-color: rgba(250,250,250,.8);
		z-index: 1;
	}
</style>
</head>
<body>

    <div id="wrapper">
		<div class="overlay"></div>
		
        <!-- Sidebar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
            <ul class="nav sidebar-nav">
                <li class="sidebar-brand">
                    <a href="?module=home">
                       SMKN 1 BANYWUWANGI
                    </a>
				</li>
				<br>
				<br>
				<br>
				<br>
                <li>
                    <a href="?module=user">Manajemen user Admin</a>
                </li>
                <li>
                    <a href="?module=usersiswa">Manajemen user Siswa</a>
                </li>
                <li>
                    <a href="?module=siswa">Manajemen Siswa</a>
                </li>
                <li>
                    <a href="?module=semester">Manajemen Semester</a>
				</li>
				<li>
                    <a href="?module=kelas">Manajemen Kelas</a>
				</li>
				<li>
                    <a href="?module=absen">Manajemen Absen</a>
                </li>
                <li>
                    <a href="../logout.php">Logout</a>
                </li>
            </ul>
        </nav>
        <!-- /#sidebar-wrapper -->

		<!-- Page Content -->
		<div style="background-image: url('img/bg.jpg');">
        <div id="page-content-wrapper">
            <button type="button" class="hamburger is-closed" data-toggle="offcanvas">
                <span class="hamb-top"></span>
    			<span class="hamb-middle"></span>
				<span class="hamb-bottom"></span>
            </button>
            <div class="container">
                <div class="row"  style="background-color:white; position: fixed; height: 700; width: 900; border-style: solid; border-color: blue;">
                    <div class="col-lg-11 col-lg-offset-1">
						<?php include "content.php"; ?>	
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

</body>
</html>
<?php
}
?>

