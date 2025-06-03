<?php
$id_jadwal = $_GET['id'];
$query = mysqli_query($koneksi,"SELECT nama_kelas,matpel FROM jadwal INNER JOIN kelas ON id_kelas=kelas_id INNER JOIN matpel ON id_matpel=matpel_id WHERE id_jadwal = '$id_jadwal'");
$row = mysqli_fetch_assoc($query);
?>
<div class="card card-info">
	<div class="card-header bg-gradient-dark">
		<h3 class="card-title">
		<i class="fa fa-file"></i> Absensi Kelas | <?= $row['nama_kelas'] ?>  
		<i class=""></i> Mata Pelajaran  <?= $row['matpel'] ?></h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
	<form action="" method="post">
		<div class="table-responsive">
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Siswa</th>
						<th>NIS</th>
						<th>Kelas</th>
						<?php
							$sql = "SELECT id_kriteria,kriteria FROM kriteria";
							$result = $koneksi->query($sql);
							$kriteria = [];

							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
									$kriteria[] = $row;
									echo "<th>" . $row["kriteria"] . "</th>";
								}
							}
						?>
					</tr>
				</thead>
				<tbody>

				<?php
					$no = 1;
					$sql = "SELECT id_jadwal,id_siswa,nis,nama_siswa,jenis_kelamin,alamat,nama_kelas FROM jadwal INNER JOIN kelas ON id_kelas=kelas_id INNER JOIN siswa ON siswa.kelas_id=kelas.id_kelas WHERE id_jadwal='$id_jadwal'";
					$result = $koneksi->query($sql);

					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							echo "<tr>";
							echo "<td>" . $no++ . "</td>";
							echo "<td>" . $row["nama_siswa"] . "</td>";
							echo "<td>" . $row["nis"] . "</td>";
							echo "<td>" . $row["nama_kelas"] . "</td>";
							foreach ($kriteria as $k) {
								echo "<td><input type='number' name='nilai[" . $row["nis"] . "][" . $k["id_kriteria"] . "]'class='form-control' required></td>";
							}
							echo "</tr>";
						}
					}
				?>
				</tbody>
				</tfoot>
			</table>
			<div class="card-footer">
				<input type="submit" name="Simpan" value="Simpan" class="btn btn-primary">
				<a href="?page=pilih-penilaian" title="Kembali" class="btn btn-warning text-white">Kembali</a>
			</div>
		</div>
		</form>
	</div>
<?php
	if (isset($_POST['Simpan'])) {
	$nilai = $_POST['nilai'];
// var_dump($nilai);
	foreach ($nilai as $nis => $kriteria_nilai) {
		foreach ($kriteria_nilai as $kriteria_id => $nilai_siswa) {
			$sql = "INSERT INTO penilaian VALUES ('', '$nis','$kriteria_id','$nilai_siswa','$id_jadwal')";
			$query_simpan = mysqli_query($koneksi, $sql);

			if ($query_simpan) {
				echo "<script>
				Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
				}).then((result) => {if (result.value){
					window.location = '?page=pilih-penilaian&kode={$id_jadwal}';
					}
				})</script>";
			} else {
				echo "<script>
				Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
				}).then((result) => {if (result.value){
					window.location = '?page=pilih-penilaian&kode={$id_jadwal}';
					}
				})</script>";
			}
		}
	}
}
die();
?>
<!-- /.card-body -->