<div class="form">
 <form>
 <div class="col-sm-12">
                    <label class=" col-form-label">Nama</label>
					<div class="col-sm-12">
                        <input type="file" class="form-contorl" id="excel" class="excel">
                        <br>
                        <center><input type="submit" name="SimpanExcel" value="Upload" class="btn btn-info"></center>
                    </div>
				</div>
 </form>
</div>
<?php
if (isset($_POST('SimpanExcel'))){
    $err = '';
    $ektensi = '';
    $succes = '';

    $file_name = $_FILES['excel']['name'];
    $file_data = $_FILES['excel']['tmp_name'];

    if (empty($file_name)) {
        $err .= '<li>Silahkan masukkan file</li>'
    } else {
        $ektensi = pathinfo($file_name)['extension'];
    }
    $ektensi_allowed = ['xls','xlsx'];
    if (!in_array($ektensi, $ektensi_allowed)) {
        $err .= "<li>Silahkan masukkan file excel, yang kamu masukkan <b>$file_name</b> punya tipe <b>$ektensi</b></li>";
    }

    if (empty($err)) {
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile(
            $file_data
        );
        $spreedsheet = $reader->load($file_data);
        $sheetData = $spreedsheet->getActiveSheet()->toArray();

        $jumlahData = 0;
        for ($i = 1; $i < count($sheetData); $i++) {
            
        }
    }
}
?>