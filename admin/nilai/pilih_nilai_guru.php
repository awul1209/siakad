<div class="card">
	<div class="card-header bg-gradient-dark">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Pilih Kelas</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Matpel</th>
						<th>Kelas</th>
						<th class="col-sm-3">Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$no = 1;
				$sql = $koneksi->query("SELECT DISTINCT jadwal.id_jadwal, matpel.matpel, kelas.nama_kelas FROM jadwal INNER JOIN matpel ON jadwal.matpel_id=matpel.id_matpel INNER JOIN kelas ON jadwal.kelas_id=kelas.id_kelas WHERE guru_id='$data_id'");
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
									<?php echo $data['nama_kelas']; ?>
								</td>
								<td>
								<?php 
									$id_jadwal = $data['id_jadwal']; 
              						$jmlData = mysqli_query($koneksi, "SELECT nilai_pertama FROM `nilai_awal` JOIN jadwal ON id_jadwal=jadwal_id WHERE jadwal_id='$id_jadwal'");
              						$jml = mysqli_num_rows($jmlData);
									if ($jml == 0) {
								?>
									<a href="index.php?page=input-nilai-guru&id=<?= $data['id_jadwal'] ?>" title="nilai"
									class="btn bg-gradient-warning btn-sm text-white">
									<h3 class="card-title">
										<i class="fa fa-edit"></i> Input Nilai</h3>
									</a>
								<?php } else if ($jml > 0){ ?>
									<a title="absensi selesai"
									class="btn bg-gradient-success btn-sm text-light">
									<h3 class="card-title">
										<i class="fa fa-check"></i> Selesai</h3>
									</a>
									<a href="index.php?page=edit-nilai-guru&id=<?= $data['id_jadwal'] ?>" title="nilai"
									class="btn bg-gradient-primary  btn-sm">
									<h3 class="card-title">
										<i class="fa fa-edit"></i> Edit</h3>
									</a>
               					 <?php } ?>  
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