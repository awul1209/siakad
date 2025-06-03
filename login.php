<?php
// session_start();
// if (isset($_SESSION["login"])) {
// 	header("location: index.php");
// 	exit;
// }

include 'inc/koneksi.php';
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>login</title>
	<link rel="icon" href="dist/img/logoan.png">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- icheck bootstrap -->
	<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/adminlte.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page" style="background-color:rgb(255, 255, 255);">
	<div class="login-box">
		<div class="login-logo">
		</div>
		<!-- /.login-logo -->
		<div class="card">
		<div class="card-body login-card-body" style="border-radius: 15px; box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.2);">
				<center>
					<img src="dist/img/logoan.png" width=120px />
					<br>
					<h3>
						<b>Yayasan</b>
					</h3>
					<h3>
					<b>AL-KARIMIYYAH</b>
					</h3>
					<h5>
						<b>Login Guru</b>
					</h5>
					<br>
				</center>


				<form action="" method="post">
					<div class="input-group mb-3">
						<input type="text" class="form-control" name="nama" placeholder="Username" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="password" class="form-control" name="password" placeholder="Password" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-12">
							<button type="submit" class="btn bg-gradient-dark btn-block btn-flat mb-1" name="btnLogin" title="Masuk Sistem" style="border-radius: 5px;">
								<b>Login System</b>
							</button>
							<center>
    <a class="btn mt-2 text-decoration-none text-dark" href="login_siswa.php" 
        style="background-color:#ffffff; color: #333; transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;"
        onmouseover="this.style.backgroundColor='rgb(223, 223, 223)'; this.style.color='#ffffff';"
        onmouseout="this.style.backgroundColor='#ffffff'; this.style.color='#333';">
        Login Sebagai Siswa
    </a>
</center>

						</div>
					</div>
					<br>
				</form>
			</div>
		</div>
	</div>
		<!-- /.login-box -->

		<!-- jQuery -->
		<script src="plugins/jquery/jquery.min.js"></script>
		<!-- Bootstrap 4 -->
		<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- AdminLTE App -->
		<script src="dist/js/adminlte.min.js"></script>
		<!-- Alert -->
		<script src="plugins/alert.js"></script>

</body>

</html>

<?php if (isset($_POST['btnLogin'])) {
    //anti inject sql
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    //query login
    $sql_login = "SELECT * FROM guru WHERE BINARY nama_guru='$nama' AND password='$password'";
    $query_login = mysqli_query($koneksi, $sql_login);
    $data_login = mysqli_fetch_array($query_login, MYSQLI_BOTH);
    $jumlah_login = mysqli_num_rows($query_login);

    if ($jumlah_login == 1) {
        session_start();
        $_SESSION['ses_id_guru'] = $data_login['id_guru'];
        $_SESSION['ses_nama_guru'] = $data_login['nama_guru'];
        $_SESSION['ses_password'] = $data_login['password'];
        $_SESSION['ses_rl'] = $data_login['rl'];

		$_SESSION['login'] = true;

        echo "<script>
			Swal.fire({title: 'Login Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
			}).then((result) => {if (result.value)
				{window.location = 'index.php';}
			})</script>";
    } else {
        echo "<script>
			Swal.fire({title: 'Login Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
			}).then((result) => {if (result.value)
				{window.location = 'login.php';}
			})</script>";
    }
}
