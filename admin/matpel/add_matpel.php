<div class="card">
	<div class="card-header bg-gradient-dark">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Tambah Data</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<div class="form-group row">
                <div class="col-sm-12">
                    <label class=" col-form-label">Mata Pelajaran</label>
					<input type="text" class="form-control" id="matpel" name="matpel" placeholder="Masukkan Mata Pelajaran" required>
				</div>
		    </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <label class=" col-form-label">Kode</label>
					<input type="text" class="form-control" id="kode_matpel" name="kode_matpel" placeholder="Masukkan Kode" required>
				</div>
		    </div>
	    </div>
		<div class="card-footer">
			<input type="submit" name="Simpan" value="Simpan" class="btn bg-gradient-primary">
			<a href="?page=data-matpel" title="Kembali" class="btn bg-gradient-warning text-white">Batal</a>
		</div>
	</form>
</div>

<?php
if (isset($_POST['Simpan'])) {
    global $koneksi;
    $matpel = htmlspecialchars($_POST['matpel']);
    $kode = htmlspecialchars($_POST['kode_matpel']);
    // $matpel = $_POST['id_matpel'];
    $querymatpel = "INSERT INTO matpel VALUES ('','$matpel','$kode')";
    // $queryRelasi = "INSERT INTO relasi VALUES ('', '')"
    $query_simpan = mysqli_query($koneksi, $querymatpel);

    if ($query_simpan) {
        echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = '?page=data-matpel';
          }
      })</script>";
    } else {
        echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = '?page=data-matpel';
          }
      })</script>";
    }
}

//selesai proses simpan data