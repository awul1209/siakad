<?php
$id_jadwal = $_GET['kode'];
$query = mysqli_query($koneksi,"SELECT nama_kelas,matpel FROM jadwal INNER JOIN kelas ON id_kelas=kelas_id INNER JOIN matpel ON id_matpel=matpel_id WHERE id_jadwal = '$id_jadwal'");
$row = mysqli_fetch_assoc($query);
?>
<div class="card">
	<div class="card-header bg-gradient-dark">
		<h3 class="card-title">
		<i class="fa fa-file"></i> Absensi Kelas <?= $row['nama_kelas'] ?> | 
		<i class=""></i> Mata Pelajaran  <?= $row['matpel'] ?></h3>
	</div>
	<!-- /.card-header -->
	<form action="" method="post" enctype="multipart/form-data">
	<div class="card-body">
		<div class="table-responsive">
		<table class="table table-bordered" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Siswa</th>
						<th>NIS</th>
						<th>Kelas</th>
						<th>Keterangan</th>
					</tr>
				</thead>
				<tbody>

				<?php
				$no = 1;
				$sql = $koneksi->query("SELECT id_jadwal,id_siswa,nis,nama_siswa,jenis_kelamin,alamat,nama_kelas FROM jadwal INNER JOIN kelas ON id_kelas=kelas_id INNER JOIN siswa ON siswa.kelas_id=kelas.id_kelas WHERE id_jadwal='$id_jadwal'");
				while ($data= $sql->fetch_assoc()) {
					$id_siswa = $data['id_siswa']
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
									<?php echo $data['nama_kelas']; ?>
								</td>
								<td>
								<div class="">
									<select class="form-control" name="<?php echo 'keterangan' .$data['id_siswa']?>">
										<option value="Hadir">Hadir</option>
										<option value="Izin">Izin</option>
										<option value="Sakit">Sakit</option>
										<option value="Alfa">Alfa</option>
									</select>
								</div>
								</td>
							</tr>
		
							<?php
					}
					?>
				</tbody>
				<!-- </tfoot> -->
			</table>
			<div class="card-footer">
				<input type="submit" name="Simpan" value="Simpan" class="btn bg-gradient-dark">
				<a href="?page=jadwal-kelas" title="Kembali" class="btn bg-gradient-warning">Batal</a>
			</div>
		</div>
	</div>
	</form>
</div>

<?php
if (isset($_POST['Simpan'])) {
   
// $id_jadwal = $_GET['id'];
$query = "SELECT id_jadwal,nama_kelas,matpel, id_siswa, nis, siswa.nama_siswa, hari FROM jadwal JOIN matpel on id_matpel=matpel_id JOIN kelas ON id_kelas=kelas_id JOIN siswa ON kelas.id_kelas=siswa.kelas_id WHERE id_jadwal='$id_jadwal'";

$res_siswa = mysqli_query($koneksi, $query);
$berhasil = true;
while ($data = mysqli_fetch_array($res_siswa)) {
    $id_siswa = $data['id_siswa'];
    $nama_siswa = $data['nama_siswa'];
	$nis = $data['nis'];
    $kelas = $data['nama_kelas'];
    $tgl = date('Y-m-d');
    $id_post = 'keterangan' . $id_siswa;
    $ket = $_POST[$id_post];
    if (
        $sql_absen = mysqli_query(
            $koneksi,
            "INSERT INTO absensi (jadwal_id, nama_siswa, kelas, tanggal, keterangan, nis) VALUES ('$id_jadwal','$nama_siswa','$kelas','$tgl','$ket','$nis')"
        )
    ) {
        if ($sql_absen) {
            echo "<script>
                    Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
                    }).then((result) => {if (result.value){
                        window.location = 'index.php?page=jadwal-kelas&kode={$id_jadwal}';
                        }
                    })</script>";
        } else {
            echo "<script>
                    Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
                    }).then((result) => {if (result.value){
                        window.location = 'index.php?page=jadwal-kelas';
                        }
                    })</script>";
        }
    } else {
        echo $koneksi->error;
    }
}
}
?>


