<?php
    if(isset($_GET['id_siswa'])){
        $sql_cek = "SELECT * FROM siswa WHERE id_siswa='".$_GET['id_siswa']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $row = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
?>
<div class="card card-dark">
	<div class="card-header" style="color: #fff;">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Edit Data</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" class="form-control" id="id_siswa" name="id_siswa" value="<?= $row[
        'id_siswa'
    ] ?>" required>
    
		<div class="card-body">

			<div class="form-group row">
                <div class="col-sm-12">
                    <label class="col-form-label">Nama Siswa</label>
					<input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?php echo $row['nama_siswa']; ?>"
					 required>
				</div>

				<div class="col-sm-12">
                    <label class="col-form-label">NIS</label>
					<input type="text" class="form-control" id="nis" name="nis" value="<?php echo $row['nis']; ?>"
					 required>
				</div>

                <div class="col-sm-12">
                    <label class=" col-form-label">Gender</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                        <option value="">-- Pilih gender --</option>
                        <?php
                            //menhecek data yg dipilih sebelumnya
                            if ($row['jenis_kelamin'] == "laki-laki") echo "<option value='laki-laki' selected>laki-laki</option>";
                            else echo "<option value='laki-laki'>laki-laki</option>";

                            if ($row['jenis_kelamin'] == "perempuan") echo "<option value='perempuan' selected>perempuan</option>";
                            else echo "<option value='perempuan'>perempuan</option>";
                        ?>
                    </select>
                </div>

				<div class="col-sm-12">
                    <label class="col-sm-2 col-form-label">Alamat</label>
					<input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $row['alamat']; ?>"
					 required>
				</div>

				<div class="col-sm-12">
                    <label class="col-form-label">Kelas</label>
					<select name="id_kelas" id="id_kelas" class="form-control select2bs4" required>
						<?php
                        // ambil data dari database
                        $query = "SELECT * FROM kelas";
                        $hasil = mysqli_query($koneksi, $query);
                        while ($data = mysqli_fetch_array($hasil)) {
                        ?>
						<option value="<?php echo $data['id_kelas'] ?>" <?=$row[
						 'kelas_id']==$data[ 'id_kelas'] ? "selected" : null ?>>
							<?php echo $data['nama_kelas'] ?>
						</option>
						<?php
                        }
                        ?>
					</select>
				</div>
			</div>

		</div>
		<div class="card-footer">
			<input type="submit" name="Ubah" value="Simpan" class="btn btn-primary">
			<a href="?page=data-siswa" title="Kembali" class="btn btn-warning text-white">Batal</a>
		</div>
	</form>
</div>

<?php
if (isset($_POST['Ubah'])) {
    $id = htmlspecialchars($_POST['id_siswa']);
    $nama_siswa = htmlspecialchars($_POST['nama_siswa']);
    $nis= htmlspecialchars($_POST['nis']);
    $jenis_kelamin= htmlspecialchars($_POST['jenis_kelamin']);
    $alamat= htmlspecialchars($_POST['alamat']);
    $id_kelas= htmlspecialchars($_POST['id_kelas']);
    //mulai proses ubah data
    $sql_ubah = "UPDATE siswa SET
    nama_siswa='$nama_siswa',
    nis='$nis',
    jenis_kelamin='$jenis_kelamin',
    alamat='$alamat',
    kelas_id='$id_kelas'
    WHERE id_siswa='$id'
    ";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
    mysqli_close($koneksi);

    if ($query_ubah) {
        echo "<script>
      Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = '?page=data-siswa';
          }
      })</script>";
    } else {
        echo "<script>
      Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = '?page=data-siswa';
          }
      })</script>";
    }
}
//selesai proses simpan data
