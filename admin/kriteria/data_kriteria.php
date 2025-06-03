<div class="card">
	<div class="card-header bg-gradient-success">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data Kriteria</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
				<a href="?page=add-kriteria" class="btn bg-gradient-success">
					<i class="fa fa-plus"></i> Tambah Data Kriteria</a>
			</div>
			<br>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Kriteria Penilaian</th>
						<th>Bobot</th>
						<th>Atribut</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
    $no = 1;
    $sql = $koneksi->query('SELECT * FROM kriteria');
    while ($data = $sql->fetch_assoc()) { ?>

					<tr>
						<td>
							<?php echo $no++; ?>
						</td>
						<td>
							<?php echo $data['kriteria']; ?>
						</td>
						<td>
							<?php echo $data['bobot']; ?>
						</td>
						<td>
							<?php echo $data['atribut']; ?>
						</td>

						<td>
							<a href="?page=edit-kriteria&kode=<?php echo $data['id_kriteria']; ?>" title="Ubah"
							class="btn bg-gradient-success btn-sm">
								<i class="fa fa-edit"></i>
							</a>
							<a href="?page=del-kriteria&kode=<?php echo $data['id_kriteria']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')"
							title="Hapus" class="btn bg-gradient-danger btn-sm">
								<i class="fa fa-trash"></i>
								</>
						</td>
					</tr>

					<?php }
					?>
				</tbody>
				</tfoot>
			</table>
		</div>
	</div>
	</div>
	<!-- /.card-body -->