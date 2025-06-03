<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-file"></i> Su-Ket Aktif Kuliah</h3>
	</div>
	<form action="?page=cetak-mhs" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Mahasiswa</label>
				<div class="col-sm-6">
					<select name="id_mhs" id="id_mhs" class="form-control select2bs4" required>
						<option selected="selected">- Pilih Data -</option>
						<?php
      // ambil data dari database
      $query = 'select * from mhs';
      $hasil = mysqli_query($koneksi, $query);
      while ($row = mysqli_fetch_array($hasil)) { ?>
						<option value="<?php echo $row['id_mhs']; ?>">
							<?php echo $row['npm']; ?>
							-
							<?php echo $row['nama_mhs']; ?>
						</option>
						<?php }
      ?>
					</select>
				</div>
			</div>

		</div>
		<div class="card-footer">
			<button type="submit" class="btn btn-info" name="btnCetak" target="_blank">Cetak Surat</button>
		</div>
	</form>
</div>