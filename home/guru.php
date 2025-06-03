<?php
$hari = hari_ini();
$jumlahsiswa = mysqli_query($koneksi, "SELECT DISTINCT nis as  nama_kelas  FROM siswa JOIN kelas ON siswa.kelas_id=kelas.id_kelas JOIN jadwal ON kelas.id_kelas=jadwal.kelas_id JOIN guru ON jadwal.guru_id=guru.id_guru WHERE id_guru='$data_id'");
$siswa = mysqli_num_rows($jumlahsiswa);


$jumlahjadwal = mysqli_query($koneksi, "SELECT COUNT(id_jadwal) as jml_kelas FROM `jadwal` WHERE guru_id='$data_id' AND hari ='$hari'");
$jadwal = mysqli_fetch_assoc($jumlahjadwal);

$jumlahmatpel = mysqli_query($koneksi, "SELECT COUNT(id_jadwal) as jml_jadwal FROM jadwal WHERE guru_id='$data_id'");
$absensi = mysqli_fetch_assoc($jumlahmatpel);


?>

<!-- <h3>Jadwal Kelas </h3> -->
<div class="row kotak-guru">
    <!-- ./col -->
    <div class="card-guru">
        <!-- small box -->
        <div class="small-box" style="background-color: #fff; color:#222;">
            <div class="inner">
                <h3 style="color:rgb(46, 46, 46);">
                    <?= $siswa; ?>
                </h3>
                <p style="color: rgb(46,46,46); font-weight: bold; font-size: 22px;">Siswa</p>
            </div>
            <div class="icon">
                <i style="display: flex; justify-content: flex-start;"><img src="dist/img/students.png" alt="" style="width: 80px;"></i>
            </div>
            <a href="?page=data-siswa" class="small-box-footer" style="background-color: rgb(46,46,46);">Selengkapnya
                <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <!-- ./col -->
    <div class="card-guru">
        <!-- small box -->
        <div class="small-box" style="background-color: #fff; color:#222;">
            <div class="inner">
                <h3 style="color: rgb(46,46,46);">
                    <?= $jadwal['jml_kelas']; ?>
                </h3>
                <p style="color: rgb(46,46,46); font-weight: bold; font-size: 22px;">Kelas Hari ini</p>
            </div>
            <div class="icon">
                <i style="display: flex; justify-content: flex-start;"><img src="dist/img/jadwal.png" alt="" style="width: 80px;"></i>
            </div>
            <a href="?page=data-jadwal-guru&hari=<?= $hari ?>" class="small-box-footer" style="background-color: rgb(46,46,46);">Selengkapnya
                <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <!-- ./col -->
    <div class="card-guru">
        <!-- small box -->
        <div class="small-box" style="background-color: #fff; color:#222;">
            <div class="inner">
                <h3 style="color: rgb(46,46,46);">
                    <?= $absensi['jml_jadwal']; ?>
                </h3>
                <p style="color: rgb(46,46,46); font-weight: bold; font-size: 22px;">Jadwal</p>
            </div>
            <div class="icon">
                <i style="display: flex; justify-content: flex-start;"><img src="dist/img/absen.png" alt="" style="width: 60px;"></i>
            </div>
            <a href="?page=data-jadwal-guru" class="small-box-footer" style="background-color: rgb(46,46,46);">Selengkapnya
                <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <!-- ./col -->
</div>
<div class="card-body">
	
	</div>
	</div>
	<!-- /.card-body -->
