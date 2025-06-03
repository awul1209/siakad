<?php  

	require 'inc/koneksi.php';
	$id_kelas = $_POST['pilihkelas'];
	// proses perhitungan spk
	// menangkap data alternatif
	$sqlAlter = "SELECT * FROM siswa";
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
			nama_siswa, nilai.kriteria_id, kriteria.atribut, kriteria.kriteria, nilai.nilai 
			FROM nilai INNER JOIN kriteria ON nilai.kriteria_id = kriteria.id_kriteria INNER JOIN 
			siswa ON nilai.nis_siswa = siswa.nis WHERE nama_siswa = '$nama[nama_siswa]'");
			
			// perulangan data penilaian awal
			$column = [];
			while ($nilaiAlt = mysqli_fetch_assoc($queryNilai)) {

				// mengecek atribut kriteria benefit / cost
				if ($nilaiAlt['atribut'] == 'benefit') {
					// mengambil nilai tertinggi (max)
					$idkrit = "SELECT MAX(nilai) FROM nilai WHERE kriteria_id = '$nilaiAlt[id_kriteria]'";
					$nilai = mysqli_query($koneksi, $idkrit);
					$nilaiKrit = mysqli_fetch_row($nilai);
				} 
				else if ($nilaiAlt['atribut'] == 'cost') {
					// mengambil nilai terendah (min)
					$idkrit = "SELECT MIN(nilai) FROM nilai WHERE kriteria_id = '$nilaiAlt[id_kriteria]'";
					$nilai = mysqli_query($koneksi, $idkrit);
					$nilaiKrit = mysqli_fetch_row($nilai);
				}

				// nilai dari penilaian awal dibagi nilai max dari masing kriteria 
				$column[] = $nilaiAlt['nilai'] / $nilaiKrit[0];
			}

			// hasil normalisasi masuk ke dalam database (normalisasi)
			for ($i=0; $i < $jumKrit ; $i++) { 
				$insNorm = "INSERT INTO hasil_normalisasi VALUES ('', '$nama[nis_siswa]', '$IDkrit[$i]', '$column[$i]')";
				mysqli_query($koneksi, $insNorm);
			}
		}

		// menangkap data id alternatif 
		$IdAlter = mysqli_query($koneksi, "SELECT nis FROM siswa");

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
			mysqli_query($koneksi, "INSERT INTO hasil_preferensi VALUES ('', '$idAl[nis]', '$hasilNorm')");
		} 

		header('Location: ../../index.php?page=hasil_perhitungan');
		exit;

	} else if ($jmlHasilNorm == 0 && $jmlHasilPref == 0) {

		// perulangan nilai dalam kriteria berdasarkan jumlah data alter
		while ($nama = mysqli_fetch_assoc($alterSiswa)) {

			// menangkap data penilaian dari masing" kriteria berdasarkan nama alternatif
			$queryNilai = mysqli_query($koneksi, "SELECT nilai.id_nilai, nilai.nis_siswa, siswa.
			nama_siswa, nilai.kriteria_id, kriteria.atribut, kriteria.kriteria, nilai.nilai 
			FROM nilai INNER JOIN kriteria ON nilai.kriteria_id = kriteria.id_kriteria INNER JOIN 
			siswa ON nilai.nis_siswa = siswa.nis WHERE nama_siswa = '$nama[nama_siswa]' AND kelas_id='$id_kelas'");
			
			// perulangan data penilaian awal
			$column = [];
			while ($nilaiAlt = mysqli_fetch_assoc($queryNilai)) {

				// mengecek atribut kriteria benefit / cost
				if ($nilaiAlt['atribut'] == 'benefit') {
					// mengambil nilai tertinggi (max)
					$idkrit = "SELECT MAX(nilai) FROM nilai WHERE kriteria_id = '$nilaiAlt[kriteria_id]'";
					$nilai = mysqli_query($koneksi, $idkrit);
					$nilaiKrit = mysqli_fetch_row($nilai);
				} 
				else if ($nilaiAlt['atribut'] == 'cost') {
					// mengambil nilai terendah (min)
					$idkrit = "SELECT MIN(nilai) FROM nilai WHERE kriteria_id = '$nilaiAlt[id_kriteria]'";
					$nilai = mysqli_query($koneksi, $idkrit);
					$nilaiKrit = mysqli_fetch_row($nilai);
				}

				// nilai dari penilaian awal dibagi nilai max dari masing kriteria 
				$column[] = $nilaiAlt['nilai'] / $nilaiKrit[0];
			}

			// hasil normalisasi masuk ke dalam database (normalisasi)
			for ($i=0; $i < $jumKrit ; $i++) { 
				$insNorm = "INSERT INTO hasil_normalisasi VALUES ('', '$nama[nis]', '$IDkrit[$i]', '$column[$i]')";
				mysqli_query($koneksi, $insNorm);
			}
		}

		// menangkap data id alternatif 
		$IdAlter = mysqli_query($koneksi, "SELECT nis FROM siswa");

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
			mysqli_query($koneksi, "INSERT INTO hasil_preferensi VALUES ('', '$idAl[nis]', '$hasilNorm')");
		} 

		header('Location: ../../index.php?page=hasil_perhitungan');
		exit;
	}

?>