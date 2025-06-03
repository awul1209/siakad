<?php
    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM kelas WHERE id_kelas='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $row = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
?>
<div class="card">
	<div class="card-header bg-gradient-dark">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Edit Data</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" class="form-control" id="id_kelas" name="id_kelas" value="<?= $row[
        'id_kelas'
    ] ?>" required>
    
		<div class="card-body">

			<div class="form-group row">
                <div class="col-sm-12">
                    <label class=" col-form-label">Nama Kelas</label>
					<input type="text" class="form-control" id="nama_kelas" name="nama_kelas"value="<?= $row['nama_kelas'] ?>" required>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<input type="submit" name="Ubah" value="Ubah" class="btn bg-gradient-primary">
			<a href="?page=data-kelas" title="Kembali" class="btn bg-gradient-warning text-white">Batal</a>
		</div>
	</form>
</div>

<?php
if (isset($_POST['Ubah'])) {
    $id = htmlspecialchars($_POST['id_kelas']);
    $nama_kelas = htmlspecialchars($_POST['nama_kelas']);
    //mulai proses ubah data
    $sql_ubah = "UPDATE kelas SET nama_kelas='$nama_kelas' WHERE id_kelas='$id'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
    mysqli_close($koneksi);

    if ($query_ubah) {
        echo "<script>
      Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = '?page=data-kelas';
          }
      })</script>";
    } else {
        echo "<script>
      Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = '?page=data-kelas';
          }
      })</script>";
    }
}
//selesai proses simpan data

