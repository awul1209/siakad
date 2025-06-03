<div class="card">
	<div class="card-header bg-gradient-dark text-white">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data Guru</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
				<a href="?page=add-guru" class="btn btn-dark bg-gradient-dark text-white">
					<i class="fa fa-plus"></i> Tambah Data Guru</a>

					<!-- <a href="?page=import-guru" class="btn btn-success bg-gradient-success text-white">
					<i class="fa fa-plus"></i> Import</a> -->
			</div>
			<br>
<table id="example1" class="table table-bordered table-striped">
<thead>
<tr>
<th>No</th>
<th>Nama Guru</th>
<th>NIP</th>
<th>Alamat</th>
<th>No HP</th>
<th>Aksi</th>
</tr>
</thead>
<tbody>
<?php
$no = 1;
$sql = $koneksi->query('SELECT * FROM guru WHERE rl="guru"');
while ($data = $sql->fetch_assoc()) { ?>

<tr>
<td>
<?php echo $no++; ?>
</td>
<td>
<?php echo $data['nama_guru']; ?>
</td>
<td>
<?php echo $data['nip']; ?>
</td>
<td>
<?php echo $data['alamat']; ?>
</td>
<td>
<?php echo $data['nohp']; ?>
</td>


<td class="d-flex">
<a href="?page=edit-guru&kode=<?php echo $data['id_guru']; ?>" title="Ubah"
class="btn btn-primary btn-sm bg-gradient-primary">
<i class="fa fa-edit"></i>
</a>
<a href="?page=del-guru&kode=<?php echo $data['id_guru']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')"
title="Hapus" class="btn btn-danger btn-sm bg-gradient-danger" style="margin-left:5px">
<i class="fa fa-trash"></i>
</>
</td>
</tr>

<?php }
?>
</tbody>
</tfoot>
</table>
		</div>
	</div>
	</div>
	<!-- /.card-body -->