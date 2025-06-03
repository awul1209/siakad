<?php
?>
<div class="card">
	<div class="card-header bg-gradient-dark">
		<h3 class="card-title">
			<i class="fa fa-file"></i> Cari Kelas</h3>
	</div>

	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Pilih Matpel</label>
				<div class="col-sm-4">
					<select name="kode" id="kode" class="form-control select2bs4" required>
						<option value="minggu-ke-1">Pilih Matpel</option>
						<?php
      // ambil data dari database
      $query = "SELECT id_jadwal,matpel,nama_kelas FROM `jadwal` LEFT JOIN matpel ON id_matpel=matpel_id LEFT JOIN kelas ON id_kelas=kelas_id";
      $hasil = mysqli_query($koneksi, $query);
      while ($row = mysqli_fetch_array($hasil)) { ?>
						<option value="<?php echo $row['id_jadwal']; ?>">
							<?php echo $row['matpel']; ?>
							-
							<?= $row['nama_kelas'] ?>
						</option>
						<?php }
      ?>
					</select>
				</div>

	
			</div>
		</div>
		<div class="card-footer">

			<input  type="submit" name="BtnKode" class="btn btn-info">
				<a href="index.php?page=rekap-absensi&kode=<?= $row['id_jadwal'] ?>" title="User"
					class="btn bg-gradient-success btn-sm">
						<i class="fa fa-users"></i>
				</a>
		</div>
	</form>
</div>