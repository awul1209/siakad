<?php

include 'vendor/autoload.php';
// Mulai Sesion
session_start();
error_reporting(0);
if (isset($_SESSION['ses_nama_guru']) == '' && isset($_SESSION['ses_siswa']) == '') {
    header('location: login.php');
} else {
    $data_id = $_SESSION['ses_id_guru'];
    $data_nama = $_SESSION['ses_nama_guru'];
    $data_level = $_SESSION['ses_rl'];
	$data_nis = $_SESSION['ses_nis'];
    $siswa = $_SESSION['ses_siswa'];
}



//KONEKSI DB
include 'inc/koneksi.php';


$page = $_GET['page'];

$tanggal = date('d - F - Y');
function hari_ini()
{
    $hari = date('D');

    switch ($hari) {
        case 'Sun':
            $hari_ini = 'Minggu';
            break;

        case 'Mon':
            $hari_ini = 'Senin';
            break;

        case 'Tue':
            $hari_ini = 'Selasa';
            break;

        case 'Wed':
            $hari_ini = 'Rabu';
            break;

        case 'Thu':
            $hari_ini = 'Kamis';
            break;

        case 'Fri':
            $hari_ini = 'Jumat';
            break;

        case 'Sat':
            $hari_ini = 'Sabtu';
            break;

        default:
            $hari_ini = 'Tidak di ketahui';
            break;
    }

    return $hari_ini;
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>
		<?php if ($page == '') {
			echo 'Dashboard';
		} else {
			echo $page;
		} ?>
	</title>

	<link rel="stylesheet" href="dist/img/logoan.png">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- mycss assets -->
	  <!-- Template Main CSS File -->
	  <!-- <link href="assets/css/style.css" rel="stylesheet"> -->
	  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

	  <!-- mycss -->
	   <link rel="stylesheet" href="dist/css/style.css">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- icon bootstrap -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="dist/css/adminlte.min.css">
	<!-- Select2 -->
	<link rel="stylesheet" href="plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="dist/css/module.css">
	  
	<!-- Alert -->
	<script src="plugins/alert.js"></script>


</head>

<body class="hold-transition sidebar-mini" id="body">
	<!-- Site wrapper -->
	<div class="wrapper">
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark" >
<!-- Left navbar links -->
<ul class="navbar-nav">
<li class="nav-item">
<a class="nav-link" data-widget="pushmenu" href="#">
<i class="fas fa-bars text-white"></i>
</a>
</li>

</ul>

<!-- SEARCH FORM -->
<ul class="navbar-nav ml-auto">

<li class="nav-item d-none d-sm-inline-block">
<a href="index.php" class="nav-link">
<font color="white">
<b><?= hari_ini() ?>, <?= $tanggal ?></b>
</font>
</a>
</li>
<li class="nav-item">
<a onclick="return confirm('Apakah anda yakin akan keluar ?')" href="logout.php" class="nav-link">
<i class="nav-icon fas fa-sign-out-alt text-white" title="logout"> 
</i>
</a>
</li>
</ul>

</nav>
<!-- /.navbar -->
		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-danger elevation-4 position-fixed">
			<!-- Brand Logo -->
			<a href="index.php" class="brand-link">
				<img src="dist/img/logoan.png" class="brand-image">
				<span class="brand-text" style="color: #fff;"> Al-Karimiyyah</span>
				
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user (optional) -->
				<div class="user-panel mt-2 pb-2 mb-2 d-flex">
					<div class="image">
						<img src="dist/img/admin.ico">
					</div>
					<?php if ($data_level == 'admin' || $data_level == 'guru') { ?>
					<div class="info">
						<a href="index.php" class="d-block"  style="color: #fff;">
							<?php echo $data_nama; ?>
						</a>
						<span class="badge bg-primary" style="padding: 5px;">
							<?php echo $data_level; ?>
						</span>
					</div>
					<?php } else { ?>
						<div class="info">
						<a href="index.php" class="d-block"  style="color: #fff;">
							<?php echo $siswa; ?>
						</a>
						<span class="badge bg-primary" style="padding: 5px;">
							<?php echo $data_nis; ?>
						</span>
					</div>
					<?php } ?>
				</div>

				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

						<!-- Level  -->
						<?php if ($data_level == 'admin') { ?>
                        <li class="nav-item">
							<a href="index.php" class="nav-link ">
							<img src="dist/img/iconsidebar/home.png" alt="" style="width: 23px;margin-left: 0px; margin-right: 4px;">
								<p  style="color: #fff;">
									Dashboard
								</p>
							</a>
						</li>

						<li class="nav-item has-treeview">
							<a href="#" class="nav-link">
							<img src="dist/img/iconsidebar/data.png" alt="" style="width: 23px;margin-left: 0px; margin-right: 4px;">
								<p  style="color: #fff;">
									Data Master
									<i class="fas fa-angle-left right"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="?page=data-guru" class="nav-link">
										<i class="nav-icon far fa-circle text-white"></i>
										<p  style="color: #fff;">Data Guru</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="?page=data-siswa" class="nav-link">
										<i class="nav-icon far fa-circle text-white"></i>
										<p  style="color: #fff;">Data Siswa</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="?page=data-kelas" class="nav-link">
										<i class="nav-icon far fa-circle text-white"></i>
										<p  style="color: #fff;">Data Kelas</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="?page=data-matpel" class="nav-link">
										<i class="nav-icon far fa-circle text-white"></i>
										<p  style="color: #fff;">Data Mata Pelajaran</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="?page=data-jadwal" class="nav-link">
										<i class="nav-icon far fa-circle text-white"></i>
										<p  style="color: #fff;">Jadwal</p>
									</a>
								</li>
								<!-- <li class="nav-item">
									<a href="?page=data-kriteria" class="nav-link">
										<i class="nav-icon far fa-circle text-white"></i>
										<p  style="color: #fff;">Data Kriteria Penilian</p>
									</a>
								</li> -->
							</ul>
						</li>
						<li class="nav-item has-treeview">
							<a href="?page=rekap-absensi" class="nav-link">
								<img src="dist/img/rekapabsen.png" alt="" style="width: 23px;margin-left: 0px; margin-right: 4px;">
								<p  style="color: #fff;">
									Rekap Absensi
								</p>
							</a>
						</li>
						
						<li class="nav-item has-treeview">
							<a href="?page=nilai-rata-rata" class="nav-link">
								<img src="dist/img/pn.png" alt="" style="width: 23px;margin-left: 0px; margin-right: 4px;">
								<p  style="color: #fff;">
									Nilai
								</p>
							</a>
						</li>
						<!-- <li class="nav-item has-treeview">
							<a href="?page=pilih-rangking" class="nav-link">
								<img src="dist/img/rangking.png" alt="" style="width: 23px;margin-left: 0px; margin-right: 4px;">
								<p  style="color: #fff;">
									Rangking
								</p>
							</a>
						</li> -->
						
                        <?php } elseif ($data_level == 'guru') { ?>
							<li class="nav-item">
								<a href="index.php" class="nav-link ">
									<img src="dist/img/iconsidebar/home.png" alt="" style="width: 23px;margin-left: 0px; margin-right: 4px;">
									<p  style="color: #fff;">
										Dashboard
									</p>
								</a>
							</li>
							
							<li class="nav-item has-treeview">
								<a href="#" class="nav-link">
									<img src="dist/img/iconsidebar/data.png" alt="" style="width: 23px;margin-left: 0px; margin-right: 4px;">
									<p  style="color: #fff;">
										Data Master
										<i class="fas fa-angle-left right"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item ">
										<a href="?page=data-siswa" class="nav-link">
											<i class="nav-icon far fa-circle text-white"></i>
											<p  style="color: #fff;">Data Siswa</p>
										</a>
									</li>
									<li class="nav-item ">
										<a href="?page=data-kelas" class="nav-link">
											<i class="nav-icon far fa-circle text-white"></i>
											<p  style="color: #fff;">Data Kelas</p>
										</a>
									</li>
									<li class="nav-item ">
										<a href="?page=data-jadwal-guru" class="nav-link">
											<i class="nav-icon far fa-circle text-white"></i>
											<p  style="color: #fff;">Data Jadwal</p>
										</a>
									</li>
								</ul>
							</li>

						<li class="nav-item has-treeview">
							<a href="?page=materi" class="nav-link">
							<img src="dist/img/kelas.png" alt="" style="width: 23px;margin-left: 0px; margin-right: 4px;">
								<p  style="color: #fff;">
									Materi
								</p>
							</a>
						</li>
						<li class="nav-item has-treeview">
							<a href="?page=jadwal-kelas" class="nav-link">
							<img src="dist/img/abs.png" alt="" style="width: 23px;margin-left: 0px; margin-right: 4px;">
								<p  style="color: #fff;">
									Absensi
								</p>
							</a>
						</li>

						<li class="nav-item has-treeview">
							<a href="?page=pilih-nilai-guru" class="nav-link">
							<img src="dist/img/pn.png" alt="" style="width: 23px;margin-left: 0px; margin-right: 4px;">
								<p  style="color: #fff;">
									Penilaian
								</p>
							</a>
						</li>

                        <?php } else{ ?>
							<li class="nav-item">
							<a href="index.php" class="nav-link ">
							<img src="dist/img/iconsidebar/home.png" alt="" style="width: 23px;margin-left: 0px; margin-right: 4px;">
								<p  style="color: #fff;">
									Dashboard
								</p>
							</a>
						</li>
						<li class="nav-item has-treeview">
							<a href="?page=kelas-siswa" class="nav-link">
								<img src="dist/img/kelas.png" alt="" style="width: 23px;margin-left: 0px; margin-right: 4px;">
								<p  style="color: #fff;">
									Kelas
								</p>
							</a>
						</li>
						<li class="nav-item has-treeview">
							<a href="?page=siswa-absen" class="nav-link">
								<img src="dist/img/abs.png" alt="" style="width: 23px;margin-left: 0px; margin-right: 4px;">
								<p  style="color: #fff;">
									Absensi
								</p>
							</a>
						</li>
						<!-- <li class="nav-item has-treeview">
							<a href="?page=nilai-rata-rata" class="nav-link">
								<img src="dist/img/module.png" alt="" style="width: 23px;margin-left: 0px; margin-right: 4px;">
								<p  style="color: #fff;">
									Module
								</p>
							</a>
						</li> -->
							<?php } ?>
                        
						<li class="nav-header"  style="color: #fff;">Setting</li>

						<li class="nav-item">
							<a onclick="return confirm('Apakah anda yakin akan keluar ?')" href="logout.php" class="nav-link">
								<i class="nav-icon fas fa-sign-out-alt text-white"></i>
								<p style="color: #fff;">
									Logout
								</p>
							</a>
						</li>
				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
			</section>

			<!-- Main content -->
			<section class="content">
				<!-- /. WEB DINAMIS DISINI ############################################################################### -->
				<div class="container-fluid">

					<?php include 'management_page.php'; ?>

				</div>
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<footer class="main-footer">
			<!-- <div class="float-right d-none d-sm-block">
				Copyright &copy;
				<a target="_blank" href="https://www.youtube.com/channel/UCDxjOzW7F0JOkltlXT6g7AQ">
					<strong> Unija</strong>
				</a>
				All rights reserved.
			</div>
			<b>FP-2023</b> -->
			<b>YAYASAN Al-Karimiyyah</b>
			<div class="float-right d-none d-sm-block">
				<a target="_blank" href="http://www.youtube.com/@An_Nawari">
					<img src="dist/img/youtube.png" alt="" style="width: 23px;margin-left: 0px; margin-right: 4px;">
					<strong> Al-Karimiyyah Channel</strong>
				</a>
				Jl. Raya Gapura Beraji
			</div>
		</footer>

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->
	</div>
	<!-- ./wrapper -->

	<!-- jQuery -->
	<script src="plugins/jquery/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- Select2 -->
	<script src="plugins/select2/js/select2.full.min.js"></script>
	<!-- DataTables -->
	<script src="plugins/datatables/jquery.dataTables.js"></script>
	<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
	<!-- AdminLTE App -->
	<script src="dist/js/adminlte.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="dist/js/demo.js"></script>
	<!-- page script -->
	<script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

	

	<script>
		$(function() {
			$("#example1").DataTable();
			$('#example2').DataTable({
				"paging": true,
				"lengthChange": false,
				"searching": false,
				"ordering": true,
				"info": true,
				"autoWidth": false,
			});
		});
	</script>

	<script>
		$(function() {
			//Initialize Select2 Elements
			$('.select2').select2()

			//Initialize Select2 Elements
			$('.select2bs4').select2({
				theme: 'bootstrap4'
			})
		})
	</script>


  <!-- aos -->
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>

<script>
    $("#berat").change(function(){
        let a= parseFloat($("#harga").val());
        let b= parseFloat($("#berat").val());
        let c = a * b;
        $("#total").val(c);
    });
</script>

<script type="text/javascript">   
            <?php echo $a; ?>  
                function changePosyandu(nib){  
                document.getElementById('tgl_lahir').value = tgl_lahir[nib].tgl_lahir;
                document.getElementById('jekel').value = jekel[nib].jekel;
                document.getElementById('nama_ibu').value = nama_ibu[nib].nama_ibu;
            };  
        </script>

<script type="text/javascript">   
            <?php echo $b; ?>  
                function changeNasabah(id_pend){  
                document.getElementById('jekel').value = jekel[id_pend].jekel;
                document.getElementById('desa').value = desa[id_pend].desa;
            };  
        </script>

<script type="text/javascript">   
            <?php echo $b; ?>  
                function changeTransaksi(id_nasabah){  
                document.getElementById('desa').value = desa[id_nasabah].desa;
            };  
        </script>

<script type="text/javascript">   
            <?php echo $a; ?>  
                function changeSampah(id_sampah){  
                document.getElementById('jenis').value = jenis[id_sampah].jenis;
                document.getElementById('harga').value = harga[id_sampah].harga;
            };  
        </script>
<script type="text/javascript">   
            <?php echo $tarik; ?>  
                function changeTarik(id_transaksi){  
                document.getElementById('saldo').value = saldo[id_transaksi].saldo;
            };  
        </script>

<script type="text/javascript">

let btn=document.getElementById("btn");
let none=document.getElementById("none");
btn.addEventListener("click",function(){
	none.classList.toggle('none');
});
</script>
</body>

</html>