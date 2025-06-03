<?php
$hari = hari_ini();
$kelas=mysqli_query($koneksi,"SELECT nama_kelas FROM kelas JOIN siswa ON kelas.id_kelas=siswa.kelas_id WHERE nis='$data_nis'");
$nama_kelas=mysqli_fetch_assoc($kelas);
?>
<div class="kotak-siswa">
    <h2>Welcome, <?= $siswa ?></h2>
    <hr>
    <div class="container d-flex justify-content-center mt-5">
    <div class="card text-center shadow" style="width: 16rem; border-radius:5px;">
        <div class="card-body">
            <img src="./dist/img/userr.png" class="rounded-circle mb-3" width="100" height="100" alt="Foto Siswa">
            <br>
            <h5 class="nama text-center"><?= $siswa ?></h5>
            <p class="nis card-text"> <?= $data_nis ?></p>
            <p class="ma card-text text-muted">Yayasan Kariman MA Al-Karimiyyah</p>
            <p class="kelas card-text text-muted"><?= $nama_kelas['nama_kelas'] ?></p>
        </div>
    </div>
</div>
</div>



