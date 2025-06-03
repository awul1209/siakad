<div class="card">

	<div class="card-header bg-gradient-dark">
		<h3 class="card-title">
			<i class="fa fa-file"></i>Materi</h3>
	</div>

	<form action="" method="post" enctype="multipart/form-data">
						<div class="card-body">
							<div class="table-responsive">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>No</th>
											<th>Hari</th>
											<th>Mata Pelajaran</th>
											<th>Kelas</th>
											<!-- <th>Jam</th> -->
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
									$no = 1;
$sql = $koneksi->query("SELECT 
                            MIN(jadwal.id_jadwal) AS id_jadwal,
                            MIN(jadwal.hari) AS hari,
                            MIN(jadwal.waktu) AS waktu,
                            matpel.matpel,
                            kelas.nama_kelas
                        FROM jadwal 
                        INNER JOIN matpel ON jadwal.matpel_id = matpel.id_matpel 
                        INNER JOIN kelas ON jadwal.kelas_id = kelas.id_kelas 
                        WHERE jadwal.guru_id = '$data_id'
                        GROUP BY matpel.matpel, kelas.nama_kelas");


									while ($data= $sql->fetch_assoc()) {
										?>
							
												<tr>
													<td>
														<?php echo $no++; ?>
													</td>
													<td>
														<?php echo $data['hari']; ?>
													</td>
													<td>
														<?php echo $data['matpel']; ?>
													</td>
													<td>
														<?php echo $data['nama_kelas']; ?>
													</td>
													<!-- <td>
														<?php echo $data['waktu']; ?>
													</td> -->
                                                    							<td>
									<a href="?page=data-materi&kode=<?php echo $data['id_jadwal']; ?>&kelas=<?= $data['nama_kelas'] ?>" title="Ubah"
									class="btn btn-primary btn-sm">
									<i class="fa fa-edit"></i>
								</a>
							</td>

					<?php }  ?>
				</tbody>
				</tfoot>
			</table>
		</div>
	</div>
	<!-- /.card-body -->