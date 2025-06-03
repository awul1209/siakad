<div class="card">
<div class="form">
 <form>
 <div class="col-sm-12">
                    <label class=" col-form-label">Nama</label>
					<div class="col-sm-8">
                        <input type="file" class="form-contorl" id="excel" class="excel">
                        <br>
                        <br>
                        <center><input type="submit" name="SimpanExcel" value="Upload" class="btn btn-info"></center>
                    </div>
				</div>
 </form>
</div>
</div>
<?php
if (isset($_POST['SimpanExcel'])){
    $err = '';
    $ektensi = '';
    $succes = '';

    $file_name = $_FILES['excel']['name'];
    $file_data = $_FILES['excel']['tmp_name'];

    if (empty($file_name)) {
        $err .= '<li>Silahkan masukkan file</li>';
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
            $alamat = htmlspecialchars($_POST['alamat']);
            $id_kelas = htmlspecialchars($_POST['id_kelas']);
            // $kelas = $_POST['id_kelas'];
            $querysiswa = "INSERT INTO siswa VALUES ('', '$nis', '$nama_siswa', '$jenis_kelamin', '$alamat', '$id_kelas')";
            // $queryRelasi = "INSERT INTO relasi VALUES ('', '')"
            $query_simpan = mysqli_query($koneksi, $querysiswa);
            
            if ($query_simpan) {
                echo "<script>
            Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
            }).then((result) => {if (result.value){
                window.location = '?page=data-siswa';
                }
            })</script>";
            } else {
                echo "<script>
            Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
            }).then((result) => {if (result.value){
                window.location = '?page=data-siswa';
                }
            })</script>";
            }
        }
    }
}
?>