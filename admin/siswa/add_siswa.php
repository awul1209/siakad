<?php 
$querykelas = mysqli_query($koneksi, "SELECT * FROM kelas");
?>
<div class="card">
	<div class="card-header bg-gradient-dark">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Tambah Data</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<div class="form-group row">
                <div class="col-sm-12">
                    <label class=" col-form-label">Nama Siswa</label>
					<input type="text" class="form-control" id="nama_siswa" name="nama_siswa" placeholder="Masukkan Nama" required>
				</div>
                <div class="col-sm-12">
                    <label class=" col-form-label">NIS</label>
					<input type="text" class="form-control" id="nis" name="nis" placeholder="Masukkan NIS" required>
				</div>
                <div class="col-sm-12">
                <label class="col-form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                    <option value="">-- Pilih gender --</option>
                        <option>Laki-laki</option>
                        <option>Perempuan</option>
                    </select>
                </div>
                <div class="col-sm-12">
                    <label class=" col-form-label">Alamat</label>
					<input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat" required>
				</div>
                <div class="col-sm-12">
                    <label for="id_kelas" class="form-label">Kelas</label>
                    <select name="id_kelas" id="id_kelas" class="form-control" required>
                        <option value="">Pilih kelas</option>
                        <?php while ($kelas = mysqli_fetch_assoc($querykelas)) { ?>
                            <option value="<?= $kelas["id_kelas"]; ?>"><?= $kelas["nama_kelas"]; ?></option>
                        <?php } ?>
                    </select>
                </div>
		    </div>
            </div>
	    </div>
		<div class="card-footer">
			<input type="submit" name="Simpan" value="Simpan" class="btn bg-gradient-primary">
			<a href="?page=data-siswa" title="Kembali" class="btn bg-gradient-warning text-white">Batal</a>
		</div>
	</form>
</div>

<?php
if (isset($_POST['Simpan'])) {
   
    //mulai proses simpan data
    global $koneksi;
    $nama_siswa = htmlspecialchars($_POST['nama_siswa']);
    $nis = htmlspecialchars($_POST['nis']);
    $jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $id_kelas = htmlspecialchars($_POST['id_kelas']);
    // $kelas = $_POST['id_kelas'];
    $querysiswa = "INSERT INTO siswa VALUES ('', '$nis', '$nama_siswa', '$jenis_kelamin', '$alamat', '$id_kelas')";
    // $queryRelasi = "INSERT INTO relasi VALUES ('', '')"
    $query_simpan = mysqli_query($koneksi, $querysiswa);
    
    if ($query_simpan) {
        echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = '?page=data-siswa';
          }
      })</script>";
    } else {
        echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = '?page=data-siswa';
          }
      })</script>";
    }
}

//selesai proses simpan data

