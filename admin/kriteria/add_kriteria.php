<div class="card">
	<div class="card-header bg-gradient-success">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Tambah Data</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<div class="form-group row">
                <div class="col-sm-12">
                    <label class=" col-form-label">Kriteria Penilaian</label>
					<input type="text" class="form-control" id="kriteria" name="kriteria" placeholder="Masukkan Kriteria" required>
				</div>
                <div class="col-sm-12">
                    <label class=" col-form-label">Bobot</label>
					<input type="number" class="form-control" id="bobot" name="bobot" placeholder="Masukkan Bobot" required>
				</div>
                <div class="col-sm-12">
                <label class="col-form-label">Atribut</label>
                    <select name="atribut" id="atribut" class="form-control" required>
                    <option value="">-- Pilih atribut --</option>
                        <option>Benefit</option>
                        <option>Cost</option>
                    </select>
                </div>
		    </div>
	    </div>
		<div class="card-footer">
			<input type="submit" name="Simpan" value="Simpan" class="btn bg-gradient-success">
			<a href="?page=data-kriteria" title="Kembali" class="btn bg-gradient-warning">Batal</a>
		</div>
	</form>
</div>

<?php
if (isset($_POST['Simpan'])) {
    global $koneksi;
    $kriteria = htmlspecialchars($_POST['kriteria']);
    $bobot = htmlspecialchars($_POST['bobot']);
    $atribut = htmlspecialchars($_POST['atribut']);
    // $kriteria = $_POST['id_kriteria'];
    $querykriteria = "INSERT INTO kriteria VALUES ('','$kriteria','$bobot','$atribut')";
    // $queryRelasi = "INSERT INTO relasi VALUES ('', '')"
    $query_simpan = mysqli_query($koneksi, $querykriteria);

    if ($query_simpan) {
        echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = '?page=data-kriteria';
          }
      })</script>";
    } else {
        echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = '?page=data-kriteria';
          }
      })</script>";
    }
}

//selesai proses simpan data