
<?php
$id_jadwal=$_GET['id_jadwal'];
$kelas=$_GET['kelas'];
?>
<div class="card card-info mt-3" id="card-add-user">
    <div class="card-header bg-gradient-dark">
        <h5 class="card-title" style="color: #fff;">
            <i class="fa fa-edit"></i> Form Tambah Data
        </h5>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_jadwal" value="<?= $id_jadwal ?>">
        <div class="card-body">

           
<div class="kotak-form-user col-12">
<div class="mb-2 kotak-input-user">
              <label for="judul" class="col-form-label">Judul:</label>
              <input type="text" name="judul" class="form-control" id="judul">
            </div>
            <div class="mb-2 kotak-input-user">
              <label for="deskripsi" class="col-form-label">Keterangan:</label>
              <input type="text" name="deskripsi" class="form-control" id="deskripsi">
            </div>
</div>


<div class="kotak-form-user col-12">
<div class="mb-2 kotak-input-user">
              <label for="file" class="col-form-label">File:</label>
            <input class="form-control" name="file" id="file" type="file">
            <!-- <img class="foto-preview-tambah1" src="" alt="" width="80"> -->
            </div>
</div>

           



        </div>
        <div class="card-footer">
            <button class="btn btn-primary" type="submit" name="simpan">Simpan</button>
            <a href="?page=data-materi&kode=<?= $id_jadwal ?>&kelas=<?= $kelas ?>" title="Kembali" class="btn btn-warning text-white">Batal</a>
        </div>
    </form>
</div>

<?php
if (isset($_POST['simpan'])) {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];


    // Menangani gambar
    $file = ($_FILES['file']['error'] === 4) ? NULL : upload1();

    // Query untuk insert data ke tabel
    $query = "INSERT INTO materi (judul, deskripsi, file, jadwal_id) 
              VALUES ('$judul', '$deskripsi', '$file', '$id_jadwal')";

    $simpan = mysqli_query($koneksi, $query);
    if ($simpan) {
        echo "<script>
        Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
        }).then((result) => {if (result.value){
            document.location.href='?page=data-materi&kode=$id_jadwal&kelas=$kelas';
            }
        })</script>";
    } else {
        echo "<script>
        Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
        }).then((result) => {if (result.value){
            document.location.href='?page=data-materi';
            }
        })</script>";
    }
}

function upload1()
{
    $namafile = $_FILES['file']['name'];
    $ukuranfile = $_FILES['file']['size'];
    $error = $_FILES['file']['error'];
    $tmpname = $_FILES['file']['tmp_name'];

    // cek gambar tidak diupload
    if ($error === 4) {
        echo "
        <script>
        alert('pilih file');
        </script>
        
        ";
        return false;
    }
    // cek yang di uplod gambar atau tidak
    $ektensigambarvalid = ['jpg', 'jpeg', 'png', 'webp','jfif','word','pdf','xlsx','csv'];

    $ektensigambar = explode('.', $namafile);
    $ektensigambar = strtolower(end($ektensigambar));
    // cek adakah string didalam array
    if (!in_array($ektensigambar, $ektensigambarvalid)) {
        echo "
        <script>
        alert('yang anda upload bukan file/gambar');
        </script>
        ";

        return false;
    }
    // cek jika ukuran terlalu besar
    if ($ukuranfile > 90000000) {
        echo "
        <script>
        alert('ukuran gambar terlalu besar');
        </script>
        
        ";
        return false;
    }

    // lolos pengecekan , gambar siap di upload
    // generete nama gambar baru
    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $ektensigambar;

    move_uploaded_file($tmpname, '././dist/file/' . $namafilebaru);

    return $namafilebaru;
}


die();
?>