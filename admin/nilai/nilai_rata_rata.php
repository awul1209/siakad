<div class="card">
	<div class="card-header bg-gradient-dark">
		<h3 class="card-title">
			<i class="fa fa-file"></i> Cari Nilai Rata-rata</h3>
	</div>

	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Pilih Kelas</label>
				<div class="col-sm-4">
					<select name="pilihkelas" id="pilihkelas" class="form-control select2bs4" required>
						<option value="minggu-ke-1">Pilih kelas</option>
						<?php
							// ambil data dari database
							$query = "SELECT * FROM kelas";
							$hasil = mysqli_query($koneksi, $query);
							while ($row = mysqli_fetch_assoc($hasil)) { 
								
								// $ket="";
								// if (isset($_POST['jadwal'])) {
								// 	$jadwal = trim($_POST['jadwal']);
								// 	if ($jadwal==$row['id_jadwal'])
								// 	{
								// 		$ket="selected";
								// 	}
								// }
						?>
						<option value="<?php echo $row['id_kelas']; ?>">
							<?= $row['nama_kelas']; ?>
						</option>
						<?php }
      ?>
					</select>
				</div>
				
				<input  type="submit" name="BtnKode" class="btn bg-gradient-dark" id="btn"></input>
			</div>
		</div>
	</form>
</div>

<?php
 if (isset($_POST['BtnKode'])) {
	$id_kelas = $_POST['pilihkelas'];
}
$query = mysqli_query($koneksi,"SELECT * FROM kelas WHERE id_kelas='$id_kelas'");
$row = mysqli_fetch_assoc($query);

// menampilkan seluruh data alternatif (siswa)
$sql = "SELECT * FROM siswa WHERE kelas_id='$id_kelas'";
$datSiswa = mysqli_query($koneksi, $sql);

// menampilkan seluruh data kriteria
$namaKriteria = "SELECT kriteria FROM kriteria";
$datKrit = mysqli_query($koneksi, $namaKriteria);
?>
<div class="tab-content none" id="none">
<!-- DataTales Example -->
<div class="card">
	<div class="card-header bg-gradient-dark">
		<h3 class="card-title">
		<i class="fa fa-file"></i> Data Nilai Rata-rata Kelas | <?= $row['nama_kelas'] ?> 
	</div>
	<!-- /.card-header -->
	<div class="card-body">
	<form action="" method="post">
		<div class="table-responsive">
		<table id="example1" class="table table-bordered table-striped">
			<thead>
				<tr>
				<th class="text-nowrap">Alternatif</th>
				<?php 
						while ($res1 = mysqli_fetch_assoc($datKrit)) :
					?>
					<th class="text-nowrap"><?= $res1['kriteria']; ?></th>
				<?php endwhile; ?>
				</tr>   
			</thead>
			<tbody>
			<?php 
				while ($res2 = mysqli_fetch_assoc($datSiswa)) :
			?>
			<tr>
				<td class="text-nowrap"><?= $res2['nama_siswa']; ?></td>
				<?php
				$nilaiSis = "SELECT nilai_ratarata FROM nilai INNER JOIN siswa ON nis = nis_siswa WHERE nis_siswa = '$res2[nis]' AND kelas_id = '$id_kelas'";
								$hasilSis = mysqli_query($koneksi, $nilaiSis);

					while ($res3 = mysqli_fetch_assoc($hasilSis)) :
				?>
				<td class="text-nowrap"><?= $res3['nilai_ratarata']; ?></td>
				<?php endwhile; ?>
			</tr>
			<?php endwhile; ?>  
			</tbody>
		</table>
		</div>
	</form>
	</div>
</div>
	<!-- /.card-body -->

	<?php
//menghitung nilai rata-rata berdasarkan tiap kriteria
function average_scores($koneksi) {
    $koneksi->query("TRUNCATE TABLE nilai");

    $sql = "
        SELECT siswa.nis, siswa.kelas_id, kriteria.id_kriteria, SUM(nilai_awal.nilai_pertama) / COUNT(DISTINCT nilai_awal.jadwal_id) AS nilai_ratarata 
		FROM nilai_awal INNER JOIN siswa ON nilai_awal.nis_siswa=siswa.nis 
		INNER JOIN kriteria ON nilai_awal.kriteria_id=kriteria.id_kriteria 
		GROUP BY siswa.nis, kriteria.id_kriteria 
		ORDER BY siswa.nis, kriteria.id_kriteria;
    ";

    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        $stmt = $koneksi->prepare("INSERT INTO nilai (nis_siswa, kriteria_id, nilai_ratarata) VALUES (?, ?, ?)");
        $stmt->bind_param("iid", $nis_siswa, $kriteria_id, $rata_rata);

        while($row = $result->fetch_assoc()) {
            $nis_siswa = $row["nis"];
            $kriteria_id = $row["id_kriteria"];
            $rata_rata = $row["nilai_ratarata"];
            $stmt->execute();
        }

        $stmt->close();
        echo "Average scores calculated and stored successfully.";
    } else {
        echo "0 results";
    }
}

average_scores($koneksi);

$koneksi->close();
?>