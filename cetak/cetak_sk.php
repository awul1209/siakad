<?php

if (isset($_POST['btnCetak'])) {
    $dari = $_POST['dari'];
    $sampai = $_POST['sampai'];
}
if ($dari == '' && $sampai == '') {
    $result = mysqli_query($koneksi, 'SELECT * FROM tb_sk ORDER BY id_sk DESC');
} else {
    $result = mysqli_query(
        $koneksi,
        "SELECT * FROM tb_sk WHERE
    tgl_sk >='$dari' AND tgl_sk <= '$sampai'  "
    );
}

$tanggal = date('m/y');
$tgl = date('d/m/y');
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<title>CETAK SURAT</title>
</head>

<body>
<div class="kotak-header" style="display: flex; justify-content: space-around; border-bottom: 1px solid black;">
<div class="logo" style="width: 110px;">
<img src="dist/img/Logofp.jpg" alt="logo" style="width: 100px;;">
</div>

<div class="text" style="text-align: center;">
<h2>UNIVERSITAS WIRARAJA SUMENEP</h2>
		<h3>FAKULTAS PERTANIAN
			<br>LAPORAN DATA SURAT MASUK</h3>
		
</div>

<div class="logo" style="width: 110px;">
<img src="dist/img/unija.png" alt="" style="width: 95px; height: 94px;">
</div>
</div>

		<table class="table table-bordered">
				
                     <tr>
                     <th>No</th>
						<th>No Surat</th>
						<th>Nama Surat</th>
						<th>Tujuan</th>
						<th>Tanggal Surat</th>
						<th>Keterangan</th>
					</tr>
					<?php
     $no = 1;

     while ($data = mysqli_fetch_assoc($result)) { ?>

					<tr>
                    <td>
							<?php echo $no++; ?>
						</td>
						<td>
							<?php echo $data['no_sk']; ?>
						</td>
						<td>
							<?php echo $data['nama_sk']; ?>
						</td>
						<td>
							<?php echo $data['tujuan']; ?>
						</td>
						<td>
							<?php echo $data['tgl_sk']; ?>
						</td>
						<td>
							<?php echo $data['keterangan']; ?>
						</td>
					</tr>

					<?php }
     ?>
			</table>
	<br>
	<br>
	<br>
	<br>
	<br>
        <div class="kotak" style="padding: 10px; box-sizing: border-box; display: flex; justify-content: right;">
        <div class="kanan">
        <p style="text-align: center;">
		Sumenep,
		<?php echo $tgl; ?>
        <br>      Mengetahui,
		<br> Dekan Fakultas Pertanian
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>      Khairil Anwar S.Kom, M.Kom
	</p>
        </div>
        </div>


	<script>
		window.print();
	</script>

</body>

</html>
<?php die(); ?>
