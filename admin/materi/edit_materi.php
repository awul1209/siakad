<?php
$id_materi = $_GET['kode'];
$id_jadwal = $_GET['id_jadwal'];
$kelas = $_GET['kelas'];

$result = mysqli_query($koneksi, "SELECT * FROM materi WHERE id_materi='$id_materi'");
$row = mysqli_fetch_assoc($result);
?>
<div class="card card-info mt-3" id="card-add-user">
    <div class="card-header bg-gradient-dark">
        <h5 class="card-title" style="color: #fff;">
            <i class="fa fa-edit"></i> Form Edit Data
        </h5>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_materi" value="<?= $id_materi ?>">
        <input type="hidden" name="file_lama" value="<?= $row['file'] ?>"> <!-- Menyimpan file lama -->
        <div class="card-body">
            <div class="kotak-form-user col-12">
                <div class="mb-2 kotak-input-user">
                    <label for="judul" class="col-form-label">Judul:</label>
                    <input type="text" name="judul" class="form-control" id="judul" value="<?= $row['Judul'] ?>">
                </div>
                <div class="mb-2 kotak-input-user">
                    <label for="deskripsi" class="col-form-label">Keterangan:</label>
                    <input type="text" name="deskripsi" class="form-control" id="deskripsi" value="<?= $row['deskripsi'] ?>">
                </div>
            </div>

            <div class="kotak-form-user col-12">
                <div class="mb-2 kotak-input-user">
                    <label for="file" class="col-form-label">File:</label>
                    <input class="form-control" name="file" id="file" type="file">
                    <p>File saat ini: <a href="./dist/file/<?= $row['file'] ?>" target="_blank"><?= $row['file'] ?></a></p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" type="submit" name="update">Update</button>
            <a href="?page=data-materi&kode=<?= $id_jadwal ?>&kelas=<?= $kelas ?>" title="Kembali" class="btn btn-warning text-white">Batal</a>
        </div>
    </form>
</div>

<?php
if (isset($_POST['update'])) {
    $id = intval($_POST['id_materi']);
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $fileLama = $_POST['file_lama']; // Ambil file lama dari input hidden
    $uploadOk = false;
    $targetDir = "./dist/file/";

    // Jika ada file baru yang diunggah
    if (!empty($_FILES['file']['name'])) {
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = basename($_FILES['file']['name']);
        $targetFilePath = $targetDir . $fileName;

        // Cek apakah file berhasil diunggah
        if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
            $uploadOk = true;

            // Hapus file lama jika ada
            if (!empty($fileLama) && file_exists($targetDir . $fileLama)) {
                unlink($targetDir . $fileLama);
            }
        } else {
            echo "<script>alert('Gagal mengunggah file!');</script>";
            exit();
        }
    } else {
        $fileName = $fileLama; // Jika tidak ada file baru, gunakan file lama
    }

    // Query update ke database
    $stmt = mysqli_query($koneksi, "UPDATE materi SET 
        judul='$judul', 
        deskripsi='$deskripsi',
        file='$fileName'
        WHERE id_materi='$id'");

    if ($stmt) {
        echo "<script>
            Swal.fire({
                title: 'Ubah Data Berhasil',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = '?page=data-materi&kode=$id_jadwal&kelas=$kelas';
                }
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                title: 'Ubah Data Gagal',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = '?page=data-materi&kode=$id_jadwal&kelas=$kelas';
                }
            });
        </script>";
    }
}
?>
