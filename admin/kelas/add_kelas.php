<div class="card">
	<div class="card-header bg-gradient-dark">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Tambah Data</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<div class="form-group row">
                <div class="col-sm-12">
                    <label class=" col-form-label">Nama Kelas</label>
					<input type="text" class="form-control" id="nama_kelas" name="nama_kelas" placeholder="Masukkan Nama" required>
				</div>
		    </div>
	    </div>
		<div class="card-footer">
			<input type="submit" name="Simpan" value="Simpan" class="btn bg-gradient-primary">
			<a href="?page=data-kelas" title="Kembali" class="btn bg-gradient-warning text-white">Batal</a>
		</div>
	</form>
</div>

<?php
if (isset($_POST['Simpan'])) {
    global $koneksi;
    $nama_kelas = htmlspecialchars($_POST['nama_kelas']);
    // $kelas = $_POST['id_kelas'];
    $queryKelas = "INSERT INTO kelas VALUES ('','$nama_kelas')";
    // $queryRelasi = "INSERT INTO relasi VALUES ('', '')"
    $query_simpan = mysqli_query($koneksi, $queryKelas);

    if ($query_simpan) {
        echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = '?page=data-kelas';
          }
      })</script>";
    } else {
        echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = '?page=data-kelas';
          }
      })</script>";
    }
}

//selesai proses simpan data