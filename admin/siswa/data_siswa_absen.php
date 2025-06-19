<?php
$id_jadwal=$_GET['kode'];
$kelas=$_GET['kelas'];
$matpel=$_GET['matple'];
$result=mysqli_query($koneksi,"SELECT keterangan, tanggal FROM absensi 
JOIN siswa ON absensi.nis=siswa.nis
JOIN jadwal ON absensi.jadwal_id=jadwal.id_jadwal
WHERE absensi.nis='$data_nis' AND absensi.jadwal_id='$id_jadwal'");

?>

<h2 id="h2-module">Data Absensi Mata Kuliah <?= $matpel ?></h2>
<hr>
<div class="kotak-module">
        
        <h3></h3>
            <?php
            $pertemuan=1;
            while ($row = mysqli_fetch_assoc($result)) : ?>
            <div class="card">
                <h3>Pertemuan ke-<?php echo htmlspecialchars($pertemuan); ?></h3>
                <h3>keterangan : <?php echo htmlspecialchars($row['keterangan']); ?></h3>
                <p class="text-muted text-center"><?php echo htmlspecialchars($row['tanggal']); ?></p>
            </div>
            <?php
        $pertemuan++;
        endwhile; ?>
</div>