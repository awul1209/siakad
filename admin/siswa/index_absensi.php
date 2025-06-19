<?php

$result=mysqli_query($koneksi,"SELECT id_kelas,id_jadwal,hari,matpel,nama_guru,waktu FROM `jadwal` JOIN matpel ON id_matpel=matpel_id JOIN guru ON id_guru=guru_id JOIN kelas ON id_kelas=kelas_id JOIN siswa ON id_kelas=siswa.kelas_id WHERE nis='$data_nis'");
?>
<div class="kotak-kelas-siswa">
<?php while($row=mysqli_fetch_assoc($result)){ ?>
<div class="card">
  <a href="?page=data-siswa-absen&kode=<?= $row['id_jadwal'] ?>&kelas=<?= $row['id_kelas'] ?>&matple=
  <?= $row['matpel']?>" style="color:black;">
  <div class="card-body">
    <center>
    <h5 class=""><?= $row['matpel'] ?></h5>
    <br>
    <h6 class="mb-2 text-muted"><?= $row['nama_guru'] ?></h6>
    <p class="card-text text-muted" style="font-size:14px;"><?= $row['hari'] ?> <?= $row['waktu'] ?></p>
    </center>
  </div>
  </a>
</div>
<?php } ?>
</div>