<div class="card">
	<div class="card-header bg-gradient-success">
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
		
		// $ket="";
		// if (isset($_POST['jadwal'])) {
		// 	$jadwal = trim($_POST['jadwal']);
		// 	if ($jadwal==$row['id_jadwal'])
		// 	{
		// 		$ket="selected";
		// 	}
		// }
		?>
						<option value="<?php echo $row['id_kelas']; ?>">
							<?= $row['nama_kelas']; ?>
						</option>
						<?php }
      ?>
					</select>
				</div>
				
				<input  type="submit" name="BtnKode" class="btn bg-gradient-success"></input>
			</div>
		</div>
	</form>
</div>

<!-- tabel data siswa -->
<div class="card">
	<div class="card-header bg-gradient-success">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data Siswa</h3>
	</div>
	<!-- /.card-header -->
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
							</tr>
		
							<?php
					}
					?>
				</tbody>
				</tfoot>
			</table>
		</div>
	</div>
	<!-- /.card-body -->