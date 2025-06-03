<div class="card">
	<div class="card-header bg-gradient-dark">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data Mata Pelajaran</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
				<a href="?page=add-matpel" class="btn bg-gradient-dark">
					<i class="fa fa-plus"></i> Tambah Data</a>
			</div>
			<br>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Mata Pelajaran</th>
						<th>Kode</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>

					<?php
				$no = 1;
				$sql = $koneksi->query("SELECT * FROM matpel");
				while ($data= $sql->fetch_assoc()) {
					?>
		
							<tr>
								<td>
									<?php echo $no++; ?>
								</td>
								<td>
									<?php echo $data['matpel']; ?>
								</td>
								<td>
									<?php echo $data['kode_matpel']; ?>
								</td>
								<td>
									<a href="?page=edit-matpel&kode=<?php echo $data['id_matpel']; ?>" title="Ubah"
									class="btn bg-gradient-primary btn-sm">
										<i class="fa fa-edit"></i>
									</a>
									<a href="?page=del-matpel&kode=<?php echo $data['id_matpel']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')"
									title="Hapus" class="btn bg-gradient-danger btn-sm">
										<i class="fa fa-trash"></i>
										</>
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