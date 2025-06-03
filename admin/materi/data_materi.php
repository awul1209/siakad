<?php
$id_jadwal=$_GET['kode'];
$kelas=$_GET['kelas'];
$result=mysqli_query($koneksi,"SELECT id_materi,id_jadwal,judul,matpel,nama_kelas,waktu,file FROM `materi` JOIN jadwal ON jadwal_id=id_jadwal JOIN matpel ON id_matpel=matpel_id JOIN kelas ON id_kelas=kelas_id JOIN guru ON id_guru=guru_id WHERE id_jadwal = '$id_jadwal' AND id_guru='$data_id'");
?>
<div class="card">

	<div class="card-header bg-gradient-dark">
		<h3 class="card-title">
			<i class="fa fa-file"></i> Materi Kelas <?= $kelas ?></h3>
	</div>

	<form action="" method="post" enctype="multipart/form-data">
						<div class="card-body">
							<div class="table-responsive">
                            <div>
				<a href="?page=add-materi&id_jadwal=<?= $id_jadwal ?>&kelas=<?= $kelas ?>" class="btn bg-gradient-dark">
					<i class="fa fa-plus"></i> Tambah Data Materi</a>
			</div>
			<br>
								<table id="example1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>No</th>
											<th>Judul Materi</th>
											<th>Matpel</th>
											<th>Kelas</th>
											<th>Jam</th>
											<th>file</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
									$no = 1;
									while ($data= $result->fetch_assoc()) {
										?>
							
												<tr>
													<td>
														<?php echo $no++; ?>
													</td>
													<td>
														<?php echo $data['judul']; ?>
													</td>
													<td>
														<?php echo $data['matpel']; ?>
													</td>
													<td>
														<?php echo $data['nama_kelas']; ?>
													</td>
													<td>
														<?php echo $data['waktu']; ?>
													</td>
													<td>
                                                        <a href="././dist/file/<?= $data[
                                                        'file'
                                                        ] ?>" download><i style="font-size:1.8rem" class="bi bi-cloud-arrow-down"></i></a>
													</td>
                                                    							<td>
									<a href="?page=edit-materi&kode=<?= $data['id_materi']; ?>&id_jadwal=<?= $id_jadwal ?>&kelas=<?= $kelas ?>" title="Ubah"
									class="btn btn-primary btn-sm">
									<i class="fa fa-edit"></i>
								</a>
                                <a href="?page=del-materi&kode=<?php echo $data['id_materi']; ?>&id_jadwal=<?= $id_jadwal ?>&kelas=<?= $kelas ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')"
									title="Hapus" class="btn bg-gradient-danger btn-sm">
										<i class="fa fa-trash"></i>
				</a>
							</td>

					<?php }  ?>
				</tbody>
				</tfoot>
			</table>
		</div>
	</div>
	<!-- /.card-body -->