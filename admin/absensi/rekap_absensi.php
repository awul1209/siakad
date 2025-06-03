<div class="card">
	<div class="card-header bg-gradient-dark">
		<h3 class="card-title">
			<i class="fa fa-file"></i> Cari Absensi</h3>
	</div>

<form action="" method="post" enctype="multipart/form-data">
<div class="card-body">

<div class="form-group row">
<div class="col-sm-4">
<label class="col-sm-4 col-form-label">Pilih Matpel</label>
<select name="jadwal" id="jadwal" class="form-control select2bs4 w-100" required>
<option value="minggu-ke-1">Pilih Matpel</option>
<?php
// ambil data dari database
$query = "SELECT DISTINCT id_jadwal, matpel.matpel,kelas FROM absensi JOIN jadwal ON absensi.jadwal_id=jadwal.id_jadwal JOIN matpel ON jadwal.matpel_id=matpel.id_matpel";
$hasil = mysqli_query($koneksi, $query);
while ($row = mysqli_fetch_assoc($hasil)) { 
?>
<option value="<?php echo $row['id_jadwal']; ?>">
<?= $row['matpel']; ?>
-
<?= $row['kelas'] ?>

</option>
<?php }
?>
</select>
</div>

<div class="col-sm-4">
<label class="col-sm-4 col-form-label">Dari Tanggal</label>
<input type="date" name="dari" id="dari" class="form-control " required>
</div>

<div class="col-sm-4">
<label class="col-form-label">Sampai Tanggal</label>
<input type="date" name="sampai" id="sampai" class="form-control " required>
</div>

<input  type="submit" name="BtnKode" class="btn bg-gradient-primary" style="margin:10px auto;"></input>
</div>
</div>
</form>
</div>


<div class="card">
	<div class="card-header bg-gradient-dark">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data Absen</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
<div class="table-responsive">

<br>
<table id="example1" class="table table-bordered table-striped">
<thead>
<?php
if (isset($_POST['BtnKode'])) {
$id_jadwal = $_POST['jadwal'];
$dari = $_POST['dari'];
$sampai = $_POST['sampai'];

$sql = mysqli_query($koneksi,"SELECT absensi.nis, siswa.nama_siswa, nama_kelas, matpel,tanggal, keterangan FROM absensi 
JOIN jadwal ON id_jadwal=jadwal_id 
JOIN matpel ON id_matpel=matpel_id 
JOIN kelas ON id_kelas=jadwal.kelas_id 
JOIN siswa ON siswa.kelas_id=kelas.id_kelas 
WHERE jadwal_id=$id_jadwal AND tanggal BETWEEN '$dari' AND '$sampai' GROUP BY tanggal");
?> 
<tr>
<th>No </th>
<th>Nis </th>
<th>Nama </th>
<th>Kelas</th>
<th>Matpel</th>
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
$sql = mysqli_query($koneksi,"SELECT * from absensi join jadwal on id_jadwal=jadwal_id join matpel on id_matpel=matpel_id WHERE jadwal_id='$id_jadwal' and tanggal between '$dari' and '$sampai' group by nis");
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
<a href="././cetak/cetak_absen.php?id_jadwal=<?= $id_jadwal ?>&dari=<?= $dari ?>&sampai=<?= $sampai ?>" class="btn btn-primary" target="_blank">Cetak</a>
<?php } ?>
</div>
	</div>
	<!-- /.card-body -->