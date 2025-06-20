<?php
// LANGKAH 1: QUERY ANDA TETAP SAMA, TIDAK DIUBAH
// Query ini mengambil semua jadwal per sesi untuk siswa yang login.
$result = mysqli_query($koneksi, "SELECT id_kelas, id_jadwal, hari, matpel, nama_guru, waktu FROM `jadwal` JOIN matpel ON id_matpel=matpel_id JOIN guru ON id_guru=guru_id JOIN kelas ON id_kelas=kelas_id JOIN siswa ON id_kelas=siswa.kelas_id WHERE nis='$data_nis'");

// LANGKAH 2: KELOMPOKKAN DATA BERDASARKAN HARI
// Sama seperti yang kita lakukan untuk halaman jadwal pelajaran.
$jadwal_per_hari_absen = [];
while ($row = mysqli_fetch_assoc($result)) {
    $jadwal_per_hari_absen[$row['hari']][] = $row;
}

// (Sangat direkomendasikan) Urutkan hari agar tampil berurutan
$urutan_hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
uksort($jadwal_per_hari_absen, function($a, $b) use ($urutan_hari) {
    return array_search($a, $urutan_hari) <=> array_search($b, $urutan_hari);
});
?>

<div class="container-fluid">
    <h3 class="mb-4"><i class="fas fa-calendar-check"></i> Halaman Absensi</h3>
    <p class="text-muted">Pilih mata pelajaran di bawah untuk melihat atau mengisi absensi.</p>

    <?php if (empty($jadwal_per_hari_absen)): ?>
        <div class="alert alert-info mt-4">
            Tidak ada jadwal pelajaran yang tersedia untuk absensi.
        </div>
    <?php else: ?>
        <div class="row mt-4">
            <?php foreach ($jadwal_per_hari_absen as $hari => $jadwal_harian): ?>
                <div class="col-12 col-md-6 col-lg-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0 font-weight-bold"><?= htmlspecialchars($hari) ?></h5>
                        </div>
                        <div class="list-group list-group-flush">
                            <?php foreach ($jadwal_harian as $jadwal): ?>
                                <a href="?page=data-siswa-absen&kode=<?= $jadwal['id_jadwal'] ?>&kelas=<?= $jadwal['id_kelas'] ?>&matple=<?= urlencode($jadwal['matpel']) ?>" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1"><?= htmlspecialchars($jadwal['matpel']) ?></h6>
                                            <p class="mb-0 text-muted" style="font-size: 0.9em;">
                                                <i class="fas fa-user-tie fa-fw"></i> <?= htmlspecialchars($jadwal['nama_guru']) ?>
                                            </p>
                                        </div>
                                        <div class="text-end">
                                            <small class="text-muted d-block">
                                                <i class="fas fa-clock fa-fw"></i> <?= htmlspecialchars($jadwal['waktu']) ?>
                                            </small>
                                            <span class="badge bg-primary rounded-pill mt-1">Lihat Absen</span>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>