<?php
    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM kriteria WHERE id_kriteria='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $row = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
?>
<div class="card">
	<div class="card-header bg-gradient-success">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Edit Data</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" class="form-control" id="id_kriteria" name="id_kriteria" value="<?= $row[
        'id_kriteria'
    ] ?>" required>
    
		<div class="card-body">

			<div class="form-group row">
                <div class="col-sm-12">
                    <label class=" col-form-label">Kriteria Penilaian</label>
					<input type="text" class="form-control" id="kriteria" name="kriteria"value="<?= $row['kriteria'] ?>" required>
				</div>
                <div class="col-sm-12">
                    <label class=" col-form-label">Bobot</label>
					<input type="number" class="form-control" id="bobot" name="bobot"value="<?= $row['bobot'] ?>" required>
				</div>
                <div class="col-sm-12">
                    <label class="col-form-label">Atribut</label>
                    <select name="atribut" id="atribut" class="form-control" required>
                        <option value="">-- Pilih atribut --</option>
                        <?php
                            //menhecek data yg dipilih sebelumnya
                            if ($row['atribut'] == "benefit") echo "<option value='benefit' selected>benefit</option>";
                            else echo "<option value='benefit'>benefit</option>";

                            if ($row['atribut'] == "cost") echo "<option value='cost' selected>cost</option>";
                            else echo "<option value='cost'>cost</option>";
                        ?>
                    </select>
                </div>
			</div>
		</div>
		<div class="card-footer">
			<input type="submit" name="Ubah" value="Ubah" class="btn bg-gradient-success">
			<a href="?page=data-kriteria" title="Kembali" class="btn bg-gradient-warning">Batal</a>
		</div>
	</form>
</div>

<?php
if (isset($_POST['Ubah'])) {
    $id = htmlspecialchars($_POST['id_kriteria']);
    $kriteria = htmlspecialchars($_POST['kriteria']);
    $bobot = htmlspecialchars($_POST['bobot']);
    $atribut = htmlspecialchars($_POST['atribut']);
    //mulai proses ubah data
    $sql_ubah = "UPDATE kriteria SET kriteria='$kriteria', bobot='$bobot', atribut='$atribut' WHERE id_kriteria='$id'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
    mysqli_close($koneksi);

    if ($query_ubah) {
        echo "<script>
      Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = '?page=data-kriteria';
          }
      })</script>";
    } else {
        echo "<script>
      Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = '?page=data-kriteria';
          }
      })</script>";
    }
}
//selesai proses simpan data

