<?php
// Pastikan variabel $data_nis sudah ada dan aman (misal dari session)
$query = "SELECT 
            j.id_jadwal, 
            j.hari, 
            j.waktu, 
            m.matpel, 
            g.nama_guru, 
            k.id_kelas
          FROM jadwal j
          JOIN matpel m ON j.matpel_id = m.id_matpel
          JOIN guru g ON j.guru_id = g.id_guru
          JOIN kelas k ON j.kelas_id = k.id_kelas
          JOIN siswa s ON k.id_kelas = s.kelas_id
          WHERE s.nis = '$data_nis'";

$result = mysqli_query($koneksi, $query);

// Kelompokkan hasil query berdasarkan hari
$jadwal_per_hari = [];
while ($row = mysqli_fetch_assoc($result)) {
    $jadwal_per_hari[$row['hari']][] = $row;
}

// (Opsional) Urutkan hari
$urutan_hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
uksort($jadwal_per_hari, function($a, $b) use ($urutan_hari) {
    return array_search($a, $urutan_hari) <=> array_search($b, $urutan_hari);
});
?>

<div class="container-fluid">
    <h3 class="mb-4">Jadwal Pelajaran Anda</h3>

    <?php if (empty($jadwal_per_hari)): ?>
        <div class="alert alert-info">
            Tidak ada jadwal pelajaran yang tersedia untuk Anda saat ini.
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($jadwal_per_hari as $hari => $jadwal_harian): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0 font-weight-bold"><?= htmlspecialchars($hari) ?></h5>
                        </div>
                        <div class="list-group list-group-flush">
                            <?php foreach ($jadwal_harian as $jadwal): ?>
                                <a href="?page=module&kode=<?= $jadwal['id_jadwal'] ?>&kelas=<?= $jadwal['id_kelas'] ?>&matpel=<?= urlencode($jadwal['matpel']) ?>" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1"><?= htmlspecialchars($jadwal['matpel']) ?></h6>
                                        <small class="text-muted"><?= htmlspecialchars($jadwal['waktu']) ?></small>
                                    </div>
                                    <p class="mb-0 text-muted" style="font-size: 0.9em;">
                                        Oleh: <?= htmlspecialchars($jadwal['nama_guru']) ?>
                                    </p>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>