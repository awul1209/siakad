<?php
$id_jadwal=$_GET['kode'];
$kelas=$_GET['kelas'];
$matpel=$_GET['matple'];
$result=mysqli_query($koneksi,"SELECT id_materi,id_jadwal,judul,deskripsi,matpel,nama_kelas,waktu,file FROM `materi` JOIN jadwal ON jadwal_id=id_jadwal JOIN matpel ON id_matpel=matpel_id JOIN kelas ON id_kelas=kelas_id JOIN guru ON id_guru=guru_id WHERE id_jadwal = '$id_jadwal' AND id_kelas='$kelas'");

?>

<h2 id="h2-module">Dashboard Module</h2>
<hr>
<div class="kotak-module">
        
        <h3>Materi <?= $matpel ?></h3>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <div class="card">
                <h3><?php echo htmlspecialchars($row['judul']); ?></h3>
                <p><?php echo htmlspecialchars($row['deskripsi']); ?></p>
                <?php if (!empty($row['file'])) : ?>
                    <a class="download-link text-center" href="././dist/file/<?php echo $row['file']; ?>" download>Download</a>
                <?php else : ?>
                    <p><i>Tidak ada file</i></p>
                <?php endif; ?>
            </div>
            <?php endwhile; ?>
</div>