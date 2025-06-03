<div class="card">
	<div class="card-header bg-gradient-success">
		<h3 class="card-title">
			<i class="fa fa-file"></i> Cari Kelas</h3>
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
				
				<input  type="submit" name="BtnKode" class="btn bg-gradient-success"></input>
			</div>
		</div>
	</form>
</div>

<?php
 if (isset($_POST['BtnKode'])) {
	$id_kelas = $_POST['pilihkelas'];
}
$query = mysqli_query($koneksi,"SELECT id_nilai,id_kelas,nama_kelas,id_siswa,nis,id_kriteria,kriteria,nilai FROM nilai INNER JOIN kelas ON id_kelas=kelas_id INNER JOIN siswa ON siswa.nis=nilai.nis_siswa INNER JOIN kriteria ON id_kriteria=kriteria_id WHERE id_kelas = '$id_kelas'");
$row = mysqli_fetch_assoc($query);

// menampilkan seluruh data alternatif (siswa)
$sql = "SELECT * FROM siswa WHERE kelas_id='$id_kelas'";
$datSiswa = mysqli_query($koneksi, $sql);

// menampilkan seluruh data kriteria
$namaKriteria = "SELECT kriteria FROM kriteria";
$datKrit = mysqli_query($koneksi, $namaKriteria);
?>

<!-- DataTales Example -->
<div class="card">
	<div class="card-header bg-gradient-warning">
		<h3 class="card-title">
		<i class="fa fa-file"></i> Data Nilai Kelas | <?= $row['nama_kelas'] ?> 
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
				$nilaiSis = "SELECT nilai FROM nilai WHERE nis_siswa = '$res2[nis]' AND kelas_id = '$id_kelas'";
								$hasilSis = mysqli_query($koneksi, $nilaiSis);

					while ($res3 = mysqli_fetch_assoc($hasilSis)) :
				?>
				<td class="text-nowrap"><?= $res3['nilai']; ?></td>
				<?php endwhile; ?>
			</tr>
			<?php endwhile; ?>  
			</tbody>
		</table>
		</div>
	</form>
	</div>
</div>
<!-- <div class="card-footer">
  <a href="?page=proses-hitung" title="hitung" class="btn btn-success fa-calculator ">Hitung</a>
</div> -->
<?php 

    $normali = mysqli_query($koneksi, "SELECT kriteria FROM kriteria");
    $siswa = mysqli_query($koneksi, "SELECT nis, nama_siswa FROM siswa WHERE kelas_id='$id_kelas'");

	// proses perhitungan spk
	// menangkap data siswa
	$sqlAlter = "SELECT * FROM siswa WHERE kelas_id='$id_kelas'";
	$alterSiswa = mysqli_query($koneksi, $sqlAlter);

	// menangkap jumlah baris data kriteria berdasarkan id kriteria
	$sqlKrit = mysqli_query($koneksi, "SELECT COUNT(id_kriteria) FROM kriteria");
	$resRow = mysqli_fetch_row($sqlKrit);
	$jumKrit = $resRow[0];

	// menangkap ID kriteria
	$sqlIDKrit = mysqli_query($koneksi, "SELECT id_kriteria FROM kriteria");
	$IDkrit = [];
	while ($resKrit = mysqli_fetch_assoc($sqlIDKrit)) {
		$IDkrit[] = $resKrit['id_kriteria'];
	}

	// jumlah data hasil normalisasi dan preferensi
	$datNorm = mysqli_query($koneksi, "SELECT * FROM hasil_normalisasi");
	$datPref = mysqli_query($koneksi, "SELECT * FROM hasil_preferensi");
	$jmlHasilNorm = mysqli_num_rows($datNorm);
	$jmlHasilPref = mysqli_num_rows($datPref);

	// fungsi perhitungan spk
	if ($jmlHasilNorm && $jmlHasilPref) {
		// query mereset ulang isi data tabel
		$tabNorm = mysqli_query($koneksi, "TRUNCATE TABLE hasil_normalisasi");
		$tabPref = mysqli_query($koneksi, "TRUNCATE TABLE hasil_preferensi");

		// perulangan nilai dalam kriteria berdasarkan jumlah data alter
		while ($nama = mysqli_fetch_assoc($alterSiswa)) {

			// menangkap data penilaian dari masing" kriteria berdasarkan nama alternatif
			$queryNilai = mysqli_query($koneksi, "SELECT nilai.id_nilai, nilai.nis_siswa, siswa.
			nama_siswa, kelas.id_kelas, kelas.nama_kelas, nilai.kriteria_id, kriteria.atribut, kriteria.kriteria, nilai.nilai 
			FROM nilai INNER JOIN kriteria ON nilai.kriteria_id = kriteria.id_kriteria INNER JOIN 
			siswa ON nilai.nis_siswa = siswa.nis INNER JOIN kelas ON nilai.kelas_id = kelas.id_kelas WHERE nama_siswa = '$nama[nama_siswa]' AND id_kelas='$id_kelas'");
			
			// perulangan data penilaian awal
			$column = [];
			while ($nilaiAlt = mysqli_fetch_assoc($queryNilai)) {

				// mengecek atribut kriteria benefit / cost
				if ($nilaiAlt['atribut'] == 'benefit') {
					// mengambil nilai tertinggi (max)
					$idkrit = "SELECT MAX(nilai) FROM nilai WHERE kriteria_id = '$nilaiAlt[kriteria_id]' AND Kelas_id='$id_kelas'";
					$nilai = mysqli_query($koneksi, $idkrit);
					$nilaiKritmax = mysqli_fetch_row($nilai);
				} 
				else if ($nilaiAlt['atribut'] == 'cost') {
					// mengambil nilai terendah (min)
					$idkrit = "SELECT MIN(niali) FROM nilai WHERE kriteria_id = '$nilaiAlt[kriteria_id]' AND Kelas_id='$id_kelas'";
					$nilai = mysqli_query($koneksi, $idkrit);
					$nilaiKritmin = mysqli_fetch_row($nilai);
				}
				if($nilaiAlt['atribut'] == 'benefit'){
					// nilai dari penilaian awal dibagi nilai max dari masing kriteria 
					$column[] = $nilaiAlt['nilai'] / $nilaiKritmax[0];
				}else if($nilaiAlt['atribut'] == 'cost'){
					$column[] = $nilaiKritmin[0] / $nilaiAlt['nilai'];
				}
			}

			// hasil normalisasi masuk ke dalam database (normalisasi)
			for ($i=0; $i < $jumKrit ; $i++) { 
				$insNorm = "INSERT INTO hasil_normalisasi VALUES ('', '$nama[nis]', '$IDkrit[$i]', '$id_kelas', '$column[$i]')";
				mysqli_query($koneksi, $insNorm);
			}
		}

		// menghitung hasil nilai preferensi
		// menangkap data id alternatif 
		$IdAlter = mysqli_query($koneksi, "SELECT nis FROM siswa WHERE kelas_id='$id_kelas'");

		// menangkap nilai bobot
		$nilBobot = mysqli_query($koneksi, "SELECT bobot FROM kriteria");
		$bo = [];
		while ($bobot = mysqli_fetch_assoc($nilBobot)) {
			$bo[] = $bobot;
		}
		
		// perhitungan hasil normaliasasi dikalikan dengan nilai bobot (preferensi)
		while ($idAl = mysqli_fetch_assoc($IdAlter)) {
			$hasilNorm = "SELECT hasil_normalisasi.nis_siswa, kriteria.id_kriteria, kriteria.kriteria, 
			kriteria.bobot, hasil_normalisasi.nilai_normalisasi FROM hasil_normalisasi INNER JOIN kriteria 
			ON hasil_normalisasi.kriteria_id = kriteria.id_kriteria WHERE nis_siswa = '$idAl[nis]'";
			
			$query = mysqli_query($koneksi, $hasilNorm);

			$tamp = [];
			while ($has = mysqli_fetch_assoc($query)) {
				$tamp[] = $has['bobot'] * $has['nilai_normalisasi'];
			}

			$hasilNorm = array_sum($tamp);
			mysqli_query($koneksi, "INSERT INTO hasil_preferensi VALUES ('', '$idAl[nis]', '$hasilNorm', '$id_kelas')");
		} 

//jika normalisasi dan preferensi tidak ada
	} else if ($jmlHasilNorm == 0 && $jmlHasilPref == 0) {

		// perulangan nilai dalam kriteria berdasarkan jumlah data siswa
		while ($nama = mysqli_fetch_assoc($alterSiswa)) {

			// menangkap data penilaian dari masing" kriteria berdasarkan nama siswa
			$queryNilai = mysqli_query($koneksi, "SELECT nilai.id_nilai, nilai.nis_siswa, siswa.
			nama_siswa, kelas.id_kelas, kelas.nama_kelas, nilai.kriteria_id, kriteria.atribut, kriteria.kriteria, nilai.nilai FROM 
			nilai INNER JOIN kriteria ON nilai.kriteria_id = kriteria.id_kriteria INNER JOIN
			siswa ON nilai.nis_siswa = siswa.nis INNER JOIN kelas ON nilai.kelas_id = kelas.id_kelas WHERE nama_siswa = '$nama[nama_siswa]' AND id_kelas='$id_kelas'");
			
			// perulangan data penilaian awal
			$column = [];
			while ($nilaiAlt = mysqli_fetch_assoc($queryNilai)) {

				// mengecek atribut kriteria benefit / cost
				if ($nilaiAlt['atribut'] == 'benefit') {
					// mengambil nilai tertinggi (max)
					$idkrit = "SELECT MAX(nilai) FROM nilai WHERE kriteria_id = '$nilaiAlt[kriteria_id]' AND Kelas_id='$id_kelas'";
					$nilai = mysqli_query($koneksi, $idkrit);
					$nilaiKritmax = mysqli_fetch_row($nilai);
				} 
				else if ($nilaiAlt['atribut'] == 'cost') {
					// mengambil nilai terendah (min)
					$idkrit = "SELECT MIN(nilai) FROM nilai WHERE kriteria_id = '$nilaiAlt[kriteria_id]' AND Kelas_id='$id_kelas'";
					$nilai = mysqli_query($koneksi, $idkrit);
					$nilaiKritmin = mysqli_fetch_row($nilai);
				}

				if($nilaiAlt['atribut'] == 'benefit'){
					// nilai dari penilaian awal dibagi nilai max dari masing kriteria 
					$column[] = $nilaiAlt['nilai'] / $nilaiKritmax[0];
				}else if($nilaiAlt['atribut'] == 'cost'){
					$column[] = $nilaiKritmin[0] / $nilaiAlt['nilai'];
				}
			}

			// hasil normalisasi masuk ke dalam database (normalisasi)
			for ($i=0; $i < $jumKrit ; $i++) { 
				$insNorm = "INSERT INTO hasil_normalisasi VALUES ('', '$nama[nis]', '$IDkrit[$i]', '$id_kelas', '$column[$i]')";
				mysqli_query($koneksi, $insNorm);
			}
		}

		// menangkap data id alternatif 
		$IdAlter = mysqli_query($koneksi, "SELECT nis FROM siswa WHERE kelas_id='$id_kelas'");

		// menangkap nilai bobot
		$nilBobot = mysqli_query($koneksi, "SELECT bobot FROM kriteria");
		$bo = [];
		while ($bobot = mysqli_fetch_assoc($nilBobot)) {
			$bo[] = $bobot;
		}
		
		// perhitungan hasil normaliasasi dikalikan dengan nilai bobot (preferensi)
		while ($idAl = mysqli_fetch_assoc($IdAlter)) {
			$hasilNorm = "SELECT hasil_normalisasi.nis_siswa, kriteria.id_kriteria, kriteria.kriteria, 
			kriteria.bobot, hasil_normalisasi.nilai_normalisasi FROM hasil_normalisasi INNER JOIN kriteria 
			ON hasil_normalisasi.kriteria_id = kriteria.id_kriteria WHERE nis_siswa = '$idAl[nis]'";
			
			$query = mysqli_query($koneksi, $hasilNorm);

			$tamp = [];
			while ($has = mysqli_fetch_assoc($query)) {
				$tamp[] = $has['bobot'] * $has['nilai_normalisasi'];
			}

			$hasilNorm = array_sum($tamp);
			mysqli_query($koneksi, "INSERT INTO hasil_preferensi VALUES ('', '$idAl[nis]', '$hasilNorm', '$id_kelas')");
		} 

		// header('Location: ../../index.php?page=hasil_perhitungan');
		// exit;
	}
?>
<div class="card">
    <div class="card-header bg-gradient-blue">
		<h3 class="card-title">
		<i class="fa fa-file"></i> Hasil Normalisasi
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th class="text-nowrap">No</th>
						<th class="text-nowrap">Nama Siswa</th>
						<?php  
							while ($krit = mysqli_fetch_assoc($normali)) :
						?>
							<th class="text-nowrap"><?= $krit['kriteria']; ?></th>
						<?php endwhile; ?>
					</tr>
				</thead>
				<tbody>
					<?php
						$no = 0;   
						while ($sis = mysqli_fetch_assoc($siswa)) :
						$no++;
					?>
					<tr>
						<td class="text-nowrap"><?= $no; ?></td>
						<td class="text-nowrap"><?= $sis['nama_siswa']; ?></td>
						<?php  
							$hasil = mysqli_query($koneksi, "SELECT nilai_normalisasi FROM hasil_normalisasi 
							WHERE nis_siswa = '$sis[nis]'");

							while ($nilai = mysqli_fetch_assoc($hasil)) :
						?>
							<td class="text-nowrap"><?= $nilai['nilai_normalisasi']; ?></td>
						<?php endwhile; ?>
					</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>   


<?php
	$pref = mysqli_query($koneksi, "SELECT hasil_preferensi.id_pref, hasil_preferensi.nis_siswa, hasil_preferensi.kelas_id, siswa.nama_siswa, hasil_preferensi.nilai_preferensi FROM hasil_preferensi 
	INNER JOIN siswa ON hasil_preferensi.nis_siswa = siswa.nis 
	INNER JOIN kelas ON hasil_preferensi.kelas_id = kelas.id_kelas 
	WHERE id_kelas='$id_kelas' ORDER BY nilai_preferensi DESC");
?>

<div class="card">
    <div class="card-header bg-gradient-purple">
		<h3 class="card-title">
		<i class="fa fa-file"></i> Hasil Akhir (RANGKING)
	</div>
	<div class="card-body">
		<div class="table-responsive">
		<table class="table table-bordered" width="100%" cellspacing="0">
			<thead>
			<tr>
				<th class="text-nowrap">Nama Siswa</th>
				<th class="text-nowrap">Nilai Akhir</th>
				<th class="text-nowrap">Peringkat</th>
			</tr>
			</thead>
			<tbody>
				<?php
					$no = 0;  
					while ($res = mysqli_fetch_assoc($pref)) :
					$no++;	
				?>
				<tr>
				<td class="text-nowrap"><?= $res['nama_siswa']; ?></td>
				<td class="text-nowrap"><?= $res['nilai_preferensi']; ?></td>
				<td class="text-nowrap"><?= $no; ?></td>  
				</tr>
			<?php endwhile; ?>
			</tbody>
		</table>
		</div>
	</div>
</div>   
