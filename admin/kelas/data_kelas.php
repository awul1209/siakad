<div class="card">
	<div class="card-header bg-gradient-dark">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data Kelas</h3>
	</div>
	<!-- /.card-header -->
	 <?php
	 if($data_level == 'admin'){
	 ?>
	<div class="card-body">
		<div class="table-responsive">
			<div>
				<a href="?page=add-kelas" class="btn bg-gradient-dark">
					<i class="fa fa-plus"></i> Tambah Data Kelas</a>
			</div>
			<br>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Kelas</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
    $no = 1;
    $sql = $koneksi->query('SELECT * FROM kelas');
    while ($data = $sql->fetch_assoc()) { ?>

					<tr>
						<td>
							<?php echo $no++; ?>
						</td>
						<td>
							<?php echo $data['nama_kelas']; ?>
						</td>
						
						<td>
							<a href="?page=edit-kelas&kode=<?php echo $data['id_kelas']; ?>" title="Ubah"
							class="btn bg-gradient-primary btn-sm">
							<i class="fa fa-edit"></i>
						</a>
						<a href="?page=del-kelas&kode=<?php echo $data['id_kelas']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')"
						title="Hapus" class="btn bg-gradient-danger btn-sm">
						<i class="fa fa-trash"></i>
					</td>
				</tr>
				
				<?php } }
				else if($data_level == 'guru'){ ?>
					<div class="card-body">
						<div class="table-responsive">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama Kelas</th>
									</tr>
								</thead>
								<tbody>
									<?php
					$no = 1;
					$sql = $koneksi->query("SELECT DISTINCT nama_kelas FROM kelas JOIN jadwal ON jadwal.kelas_id=kelas.id_kelas JOIN guru ON jadwal.guru_id=guru.id_guru WHERE id_guru='$data_id'");
					while ($data = $sql->fetch_assoc()) { ?>
				
									<tr>
										<td>
											<?php echo $no++; ?>
										</td>
										<td>
											<?php echo $data['nama_kelas']; ?>
										</td>

				<?php } } ?>
				</tbody>
				</tfoot>
			</table>
		</div>
	</div>
	</div>
	<!-- /.card-body -->