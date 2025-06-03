<?php
$id_jadwal=$_GET['id'];
?>
<div class="card-body">
	<div class="table-responsive">
			
			<br>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
<?php

$sql = mysqli_query($koneksi,"SELECT absensi.nis, siswa.nama_siswa, nama_kelas, matpel,tanggal, keterangan FROM absensi 
JOIN jadwal ON id_jadwal=jadwal_id 
JOIN matpel ON id_matpel=matpel_id 
JOIN kelas ON id_kelas=jadwal.kelas_id 
JOIN siswa ON siswa.kelas_id=kelas.id_kelas 
JOIN guru ON guru.id_guru=jadwal.guru_id
WHERE jadwal_id=$id_jadwal AND id_guru='$data_id' GROUP BY tanggal");
?> 
					<tr>
						<th>No </th>
						<th>Nis </th>
						<th>Nama </th>
						<th>Kelas</th>
						<th>Matpel</th>
						<th>Keterangan</th>
<?php
$minggu=1;
while($dataku=mysqli_fetch_assoc($sql)){ ?>
<th><?= $dataku['tanggal'] ?><br><a href="">(Minggu <?= $minggu ?>)</a></th>
	<?php $minggu++; } ?>
						</tr>
					</thead>
					<tbody>
						<?php
						$no=1;
				$sql = mysqli_query($koneksi,"SELECT * from absensi join jadwal on id_jadwal=jadwal_id join matpel on id_matpel=matpel_id WHERE jadwal_id='$id_jadwal' group by nis");
				while ($data = mysqli_fetch_assoc($sql)) {
					$nis=$data['nis'];
					?> 
					<tr>
						<td>
							<?php echo $no++; ?>
						</td>
						<td>
							<?php echo $data['nis']; ?>
						</td>
						<td>
							<?php echo $data['nama_siswa']; ?>
						</td>
						<td>
							<?php echo $data['kelas']; ?>
						</td>
						<td>
							<?php echo $data['matpel']; ?>
						</td>
						<td>
							<a href="index.php?page=edit-absen&id=<?= $data['id_jadwal'] ?>" class="btn btn-warning">
								Ubah
							</a>
						</td>
					
						<?php
      $sqla = "SELECT  keterangan FROM `absensi` WHERE nis='$nis' AND jadwal_id='$id_jadwal' ";
      $querya = mysqli_query($koneksi, $sqla);
      while ($data2 = mysqli_fetch_assoc($querya)) { ?>			           
                                <td><?php echo $data2['keterangan']; ?></td>
                            <?php } ?>			           
							<?php   }  ?>
					</tr>
				</tbody>
				</tfoot>
			</table>
		</div>
	</div>