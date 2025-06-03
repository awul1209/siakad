<?php
    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM matpel WHERE id_matpel='".$_GET['kode']."'";
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
    <input type="hidden" class="form-control" id="id_matpel" name="id_matpel" value="<?= $row[
        'id_matpel'
    ] ?>" required>
    
		<div class="card-body">

			<div class="form-group row">
                <div class="col-sm-12">
                    <label class=" col-form-label">Mata Pelajaran</label>
					<input type="text" class="form-control" id="matpel" name="matpel"value="<?= $row['matpel'] ?>" required>
				</div>
			</div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <label class=" col-form-label">Kode</label>
					<input type="text" class="form-control" id="kode_matpel" name="kode_matpel"value="<?= $row['kode_matpel'] ?>" required>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<input type="submit" name="Ubah" value="Ubah" class="btn bg-gradient-primary">
			<a href="?page=data-matpel" title="Kembali" class="btn bg-gradient-warning text-white">Batal</a>
		</div>
	</form>
</div>

<?php
if (isset($_POST['Ubah'])) {
    $id = htmlspecialchars($_POST['id_matpel']);
    $matpel = htmlspecialchars($_POST['matpel']);
    $kode_matpel = htmlspecialchars($_POST['kode_matpel']);
    //mulai proses ubah data
    $sql_ubah = "UPDATE matpel SET matpel='$matpel', kode_matpel='$kode_matpel' WHERE id_matpel='$id'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
    mysqli_close($koneksi);

    if ($query_ubah) {
        echo "<script>
      Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = '?page=data-matpel';
          }
      })</script>";
    } else {
        echo "<script>
      Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = '?page=data-matpel';
          }
      })</script>";
    }
}
//selesai proses simpan data

