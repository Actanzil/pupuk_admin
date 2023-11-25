<?php
	session_start();
	include 'dbconnect.php';

	if (isset($_SESSION['level'])) {
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
				$_SESSION['user'] = $data['username'];
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
		<title>Login</title>
		<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
		<link rel="stylesheet" href="login.css">
	</head>
    <body>
        <div></div>
        <div class="wrapper">
            <form action="" method="POST">
                <h2>Toko Pupuk Sejahtera</h2>
                <h1>Login</h1>
                <div class="input-box">
                    <input type="text" placeholder="Username" name="username" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="text" placeholder="Password" name="password" required>
                    <i class='bx bxs-lock-alt' ></i>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox">Remember Me</label>
                </div>

                <button type="submit" class="btn" name="btn-login">Login</button>
            </form>
        </div>
    </body>
</html>