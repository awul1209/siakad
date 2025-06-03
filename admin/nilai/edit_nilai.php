<?php
$id_jadwal = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT jadwal.id_jadwal, matpel.matpel, kelas.nama_kelas 
FROM jadwal 
INNER JOIN matpel ON jadwal.matpel_id=matpel.id_matpel 
INNER JOIN kelas ON jadwal.kelas_id=kelas.id_kelas 
WHERE id_jadwal = '$id_jadwal'");
$row = mysqli_fetch_assoc($query);
?>

<div class="card card-info">
    <div class="card-header bg-gradient-dark">
        <h3 class="card-title">
        <i class="fa fa-file"></i> Edit Nilai Kelas <?= $row['nama_kelas'] ?> |
        <i class="fa"></i> Mata Pelajaran <?= $row['matpel'] ?>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
    <form action="" method="post">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>NIS</th>
                        <th>Kelas</th>
                        <?php
                            $sql = "SELECT id_kriteria, kriteria FROM kriteria";
                            $result = $koneksi->query($sql);
                            $kriteria = [];

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $kriteria[] = $row;
                                    echo "<th>" . $row["kriteria"] . "</th>";
                                }
                            }
                        ?>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $no = 1;
                    $sql = "SELECT id_jadwal, id_siswa, nis, nama_siswa, nama_kelas 
                            FROM jadwal 
                            INNER JOIN kelas ON id_kelas = kelas_id 
                            INNER JOIN siswa ON siswa.kelas_id = kelas.id_kelas 
                            WHERE id_jadwal = '$id_jadwal'";
                    $result = $koneksi->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . $row["nama_siswa"] . "</td>";
                            echo "<td>" . $row["nis"] . "</td>";
                            echo "<td>" . $row["nama_kelas"] . "</td>";
                            foreach ($kriteria as $k) {
                                $id_kriteria = $k["id_kriteria"];
                                $nis = $row["nis"];
                                $sql_nilai = "SELECT nilai_pertama FROM nilai_awal WHERE jadwal_id = '$id_jadwal' AND nis_siswa = '$nis' AND kriteria_id = '$id_kriteria'";
                                $result_nilai = $koneksi->query($sql_nilai);
                                $nilai = $result_nilai->fetch_assoc();
                                echo "<td><input type='number' name='nilai_awal[$nis][$id_kriteria]' value='" . $nilai['nilai_pertama'] . "' class='form-control' required></td>";
                            }
                            echo "</tr>";
                        }
                    }
                ?>
                </tbody>
            </table>
            <div class="card-footer">
                <input type="submit" name="Update" value="Update" class="btn bg-gradient-primary">
                <a href="?page=pilih-nilai-guru" title="Kembali" class="btn bg-gradient-warning text-white">Kembali</a>
            </div>
        </div>
    </form>
    </div>

<?php
if (isset($_POST['Update'])) {
    $nilai = $_POST['nilai_awal'];

    foreach ($nilai as $nis => $kriteria_nilai) {
        foreach ($kriteria_nilai as $kriteria_id => $nilai_siswa) {
            $sql = "UPDATE nilai_awal 
                    SET nilai_pertama = '$nilai_siswa' 
                    WHERE jadwal_id = '$id_jadwal' AND nis_siswa = '$nis' AND kriteria_id = '$kriteria_id'";
            $query_update = mysqli_query($koneksi, $sql);

            if ($query_update) {
                echo "<script>
                Swal.fire({title: 'Update Data Berhasil', text: '', icon: 'success', confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = '?page=pilih-nilai-guru&kode={$id_jadwal}';
                    }
                })</script>";
            } else {
                echo "<script>
                Swal.fire({title: 'Update Data Gagal', text: '', icon: 'error', confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = '?page=pilih-nilai-guru&kode={$id_jadwal}';
                    }
                })</script>";
            }
        }
    }
}
?>
<!-- /.card-body -->