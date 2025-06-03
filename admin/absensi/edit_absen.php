<?php
$id_jadwal = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT nama_kelas, matpel FROM jadwal 
    INNER JOIN kelas ON id_kelas=kelas_id 
    INNER JOIN matpel ON id_matpel=matpel_id 
    WHERE id_jadwal = '$id_jadwal'");
$row = mysqli_fetch_assoc($query);

// Ambil jumlah keterangan per siswa
$jumlah_ket = mysqli_query($koneksi, "SELECT COUNT(*) as jml FROM absensi WHERE jadwal_id='$id_jadwal'");
$total_ket = mysqli_fetch_assoc($jumlah_ket)['jml'];

// Ambil jumlah absensi per siswa (asumsi semua siswa punya jumlah absensi yang sama)
$max_ket_query = mysqli_query($koneksi, "SELECT COUNT(*) as jml FROM absensi WHERE jadwal_id='$id_jadwal' GROUP BY nis ORDER BY jml DESC LIMIT 1");
$max_ket = mysqli_fetch_assoc($max_ket_query)['jml'];
?>

<div class="card">
    <div class="card-header bg-gradient-dark">
        <h3 class="card-title">
            <i class="fa fa-file"></i> Absensi Kelas <?= $row['nama_kelas'] ?> | 
            Mata Pelajaran <?= $row['matpel'] ?>
        </h3>
    </div>

    <form action="" method="post">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>NIS</th>
                            <th>Kelas</th>
                            <?php
                            for ($i = 1; $i <= $max_ket; $i++) {
                                echo "<th>Pertemuan $i</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        // Ambil siswa
                        $siswaQuery = mysqli_query($koneksi, "SELECT DISTINCT nis, nama_siswa, kelas FROM absensi WHERE jadwal_id='$id_jadwal' ORDER BY nama_siswa ASC");
                        while ($siswa = mysqli_fetch_assoc($siswaQuery)) {
                            echo "<tr>";
                            echo "<td>$no</td>";
                            echo "<td>{$siswa['nama_siswa']}</td>";
                            echo "<td>{$siswa['nis']}</td>";
                            echo "<td>{$siswa['kelas']}</td>";

                            // Ambil semua absensi siswa ini
                            $absenQuery = mysqli_query($koneksi, "SELECT id_absensi, keterangan FROM absensi WHERE jadwal_id='$id_jadwal' AND nis='{$siswa['nis']}' ORDER BY id_absensi ASC");
                            $i = 1;
                            while ($absen = mysqli_fetch_assoc($absenQuery)) {
                                echo "<td>
                                    <select class='form-select' name='keterangan[{$absen['id_absensi']}]'>
                                        <option value='Hadir' ".($absen['keterangan']=='Hadir'?'selected':'').">Hadir</option>
                                        <option value='Izin' ".($absen['keterangan']=='Izin'?'selected':'').">Izin</option>
                                        <option value='Sakit' ".($absen['keterangan']=='Sakit'?'selected':'').">Sakit</option>
                                        <option value='Alfa' ".($absen['keterangan']=='Alfa'?'selected':'').">Alfa</option>
                                    </select>
                                </td>";
                                $i++;
                            }

                            // Tambah kolom kosong jika siswa ini absensinya lebih sedikit dari max
                            for (; $i <= $max_ket; $i++) {
                                echo "<td>-</td>";
                            }

                            echo "</tr>";
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer">
            <input type="submit" name="Update" value="Update" class="btn bg-gradient-dark">
            <a href="?page=jadwal-kelas" class="btn bg-gradient-warning">Batal</a>
        </div>
    </form>
</div>

<?php
if (isset($_POST['Update'])) {
    $berhasil = true;
    foreach ($_POST['keterangan'] as $id_absensi => $keterangan) {
        $update_query = "UPDATE absensi SET keterangan='$keterangan' WHERE id_absensi='$id_absensi'";
        if (!mysqli_query($koneksi, $update_query)) {
            $berhasil = false;
            break;
        }
    }

    if ($berhasil) {
        echo "<script>
            Swal.fire({title: 'Update Data Berhasil', icon: 'success'}).then(() => {
                window.location = 'index.php?page=jadwal-kelas&kode=$id_jadwal';
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({title: 'Update Data Gagal', icon: 'error'}).then(() => {
                window.location = 'index.php?page=jadwal-kelas';
            });
        </script>";
    }
}
?>
