<?php  
	// koneksi db  
	require 'connect_db.php';

	if (isset($_GET['hasil'])) {
		$admin = $_GET['hasil'];

		if ($pages === 'normalisasi') {
			include 'admin/hasil_perhitungan/hasil_normalisasi.php';
		}
		else if ($admin === 'preferensi') {
			include 'admin/hasil_perhitungan/hasil_preferensi.php';
		}
		else if ($admin === 'perankingan') {
			include 'admin/hasil_perhitungan/perankingan.php';
		}
	}
	else {
		include 'admin/hasil_perhitungan/hasil_normalisasi.php';
	}

?>