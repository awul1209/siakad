<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-file"></i>Laporan Surat Masuk</h3>
	</div>
	<form action="?page=cetak-sm" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<div class="form-group row">
                <div class="col-sm-6">
                <label class="col-sm-4 col-form-label">Dari Tanggal</label>
                <input type="date" class="form-control" id="dari" name="dari">	
				</div>
                <div class="col-sm-6">
                <label class="col-sm-4 col-form-label">Sampai Tanggal</label>
                <input type="date" class="form-control" id="sampai" name="sampai">	
				</div>
			</div>

		</div>
		<div class="card-footer">
			<button type="submit" class="btn btn-info" name="btnCetak" target="_blank">Cetak Surat</button>
		</div>
	</form>
</div>