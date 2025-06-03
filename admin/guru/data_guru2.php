<div class="card">
	<div class="card-header bg-gradient-success text-white">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data Guru</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Guru</th>
                        <th>NIP</th>
                        <th>Alamat</th>
                        <th>No HP</th>
					</tr>
				</thead>
				<tbody>
					<?php
    $no = 1;
    $sql = $koneksi->query('SELECT * FROM guru WHERE rl="guru"');
    while ($data = $sql->fetch_assoc()) { ?>

					<tr>
						<td>
							<?php echo $no++; ?>
						</td>
						<td>
							<?php echo $data['nama_guru']; ?>
						</td>
						<td>
							<?php echo $data['nip']; ?>
						</td>
						<td>
							<?php echo $data['alamat']; ?>
						</td>
						<td>
							<?php echo $data['nohp']; ?>
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