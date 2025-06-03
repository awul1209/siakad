<?php
if (isset($_GET['kode'])) {
    $id_jadwal=$_GET['id_jadwal'];
$kelas=$_GET['kelas'];
    $sql_hapus = "DELETE FROM materi WHERE id_materi='" . $_GET['kode'] . "'";
    $query_hapus = mysqli_query($koneksi, $sql_hapus);

    if ($query_hapus) {
        echo "<script>
                Swal.fire({title: 'Hapus Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        document.location.href='?page=data-materi&kode=$id_jadwal&kelas=$kelas';
                    }
                })</script>";
    } else {
        echo "<script>
                Swal.fire({title: 'Hapus Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        document.location.href='?page=data-materi&kode=$id_jadwal&kelas=$kelas';
                    }
                })</script>";
    }
}