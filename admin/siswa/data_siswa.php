<div class="card">
	<?php
	if($data_level =='admin'){
	?>
	<div class="card-header bg-gradient-dark">
		<h3 class="card-title">
			<i class="fa fa-file"></i> Cari Siswa</h3>
	</div>

	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Pilih Kelas</label>
				<div class="col-sm-4">
					<select name="pilihkelas" id="pilihkelas" class="form-control select2bs4" required>
						<option value="minggu-ke-1">Pilih kelas</option>
						<?php
      // ambil data dari database
      $query = "SELECT * FROM kelas";
      $hasil = mysqli_query($koneksi, $query);
      while ($row = mysqli_fetch_assoc($hasil)) { 
		?>
						<option value="<?php echo $row['id_kelas']; ?>">
							<?= $row['nama_kelas']; ?>
						</option>
						<?php }
      ?>
					</select>
				</div>
				
				<input  type="submit" name="BtnKode" class="btn bg-gradient-primary"></input>
			</div>
		</div>
	</form>
</div>

<!-- tabel data siswa -->
<div class="card">
	<div class="card-header bg-gradient-dark">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data Siswa</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
				<a href="?page=add-siswa" class="btn bg-gradient-dark">
					<i class="fa fa-plus"></i> Tambah Data
				</a>
				<!-- <a href="?page=import-siswa" class="btn btn-success bg-gradient-success text-white">
					<i class="fa fa-plus"></i> Import
				</a> -->
			</div>
			<br>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Siswa</th>
						<th>NIS</th>
						<th>Gender</th>
						<th>Alamat</th>
						<th>Kelas</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>

					<?php
				if (isset($_POST['BtnKode'])) {
					$id_kelas = $_POST['pilihkelas'];
				}
				$no = 1;
				$sql = $koneksi->query("SELECT siswa.id_siswa, siswa.nama_siswa, siswa.nis, siswa.jenis_kelamin, siswa.alamat, kelas.nama_kelas FROM siswa INNER JOIN kelas ON siswa.kelas_id=kelas.id_kelas WHERE kelas_id='$id_kelas'");
				while ($data= $sql->fetch_assoc()) {
					?>
		
							<tr>
								<td>
									<?php echo $no++; ?>
								</td>
								<td>
									<?php echo $data['nama_siswa']; ?>
								</td>
								<td>
									<?php echo $data['nis']; ?>
								</td>
								<td>
									<?php echo $data['jenis_kelamin']; ?>
								</td>
								<td>
									<?php echo $data['alamat']; ?>
								</td>
								<td>
									<?php echo $data['nama_kelas']; ?>
								</td>
								<td class="display-flex gap-10">
									<a href="?page=edit-siswa&id_siswa=<?php echo $data['id_siswa']; ?>" title="Ubah"
									class="btn bg-gradient-primary btn-sm">
									<i class="fa fa-edit"></i>
								</a>
								<a href="?page=del-siswa&id_siswa=<?php echo $data['id_siswa']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')"
								title="Hapus" class="btn bg-gradient-danger btn-sm">
								<i class="fa fa-trash"></i>
							</td>
						</tr>
						
						<?php
					}
					
				} elseif($data_level == 'guru') { ?>
					<!-- /.card-header -->
					<div class="card-header bg-gradient-dark">
						<h3 class="card-title">
							<i class="fa fa-table"></i> Data Siswa</h3>
					</div>
					<div class="card-body">
						<div class="table-responsive">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Siswa</th>
								<th>NIS</th>
								<th>Gender</th>
								<th>Alamat</th>
								<th>Kelas</th>
							</tr>
						</thead>
						<tbody>
		
						<?php
						$no = 1;
						$sql = $koneksi->query("SELECT DISTINCT siswa.id_siswa, siswa.nama_siswa, siswa.nis, siswa.jenis_kelamin, siswa.alamat, kelas.nama_kelas FROM siswa INNER JOIN kelas ON siswa.kelas_id=kelas.id_kelas JOIN jadwal ON jadwal.kelas_id=kelas.id_kelas JOIN guru ON jadwal.guru_id=guru.id_guru WHERE id_guru='$data_id'");
						while ($data= $sql->fetch_assoc()) {
							?>
				
									<tr>
										<td>
											<?php echo $no++; ?>
										</td>
										<td>
											<?php echo $data['nama_siswa']; ?>
										</td>
										<td>
											<?php echo $data['nis']; ?>
										</td>
										<td>
											<?php echo $data['jenis_kelamin']; ?>
										</td>
										<td>
											<?php echo $data['alamat']; ?>
										</td>
										<td>
											<?php echo $data['nama_kelas']; ?>
										</td>
									</tr>

				<?php } } ?>
				</tbody>
				</tfoot>
			</table>
		</div>
	</div>
	<!-- /.card-body -->