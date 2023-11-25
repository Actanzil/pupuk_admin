<?php
session_start();
include 'dbconnect.php';

if (isset($_SESSION['role'])) {
	header("location:stock");
}

if (isset($_GET['pesan'])) {
	if ($_GET['pesan'] == "gagal") {
		echo "Username atau Password salah!";
	} else if ($_GET['pesan'] == "logout") {
		echo "Anda berhasil keluar dari sistem";
	} else if ($_GET['pesan'] == "belum_login") {
		echo "Anda harus Login";
	} else if ($_GET['pesan'] == "noaccess") {
		echo "Akses Ditutup";
	}
}


if (isset($_POST['btn-login'])) {
	$uname = mysqli_real_escape_string($conn, $_POST['username']);
	$upass = mysqli_real_escape_string($conn, md5($_POST['password']));

	// menyeleksi data user dengan username dan password yang sesuai
	$login = mysqli_query($conn, "SELECT * FROM user WHERE username='$uname' and password='$upass';");
	// menghitung jumlah data yang ditemukan
	$cek = mysqli_num_rows($login);

	// cek apakah username dan password di temukan pada database ?
	if ($cek > 0) {

		$data = mysqli_fetch_assoc($login);

		if ($data['level'] == "admin") {
			// buat session login dan username
			$_SESSION['user'] = $data['nickname'];
			$_SESSION['user_login'] = $data['username'];
			$_SESSION['id'] = $data['id_user'];
			$_SESSION['level'] = "admin";
			header("location:stock");
		} else {
			header("location:index.php?pesan=gagal");
		}
	}
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="login.css">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>System Login</title>
	<link rel="stylesheet" type="text/css" href="util.css">
	<link rel="stylesheet" href="login.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-144808195-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'UA-144808195-1');
	</script>
	<script src="jquery.min.js"></script>
	<style>
		body {
			background-image: url("bg.jpg");
		}

		@media screen and (max-width: 600px) {
			h4 {
				font-size: 85%;
			}
		}
	</style>
	<link rel="icon" type="image/png" href="favicon.png">
</head>

<body style="background-color: #666666;">	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="post">
					<span class="login100-form-title p-b-43">
						Login to continue
					</span>
					<img src="Get.png">
					
					
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="username">
						<span class="focus-input100"></span>
						<span class="label-input100">Username</span>
					</div>
					
					
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="password">
						<span class="focus-input100"></span>
						<span class="label-input100">Password</span>
					</div>

					<div class="flex-sb-m w-full p-t-3 p-b-32">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>
					</div>
			

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn"  name="btn-login">
							Login
						</button>
					</div>
					

				</form>

				<div class="login100-more" style="background-image: url('bg-01.jpg');">
				</div>
			</div>
		</div>
	</div>
	<!--===============================================================================================-->
		<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
		<script src="vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
		<script src="vendor/bootstrap/js/popper.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
		<script src="vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
		<script src="vendor/daterangepicker/moment.min.js"></script>
		<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
		<script src="vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
		<script src="js/main.js"></script>
</body>

</html>