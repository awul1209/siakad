<?php
ob_start();

require_once '../vendor/autoload.php';
include '../inc/koneksi.php';
// ob_start(); // Mulai output buffering
// require './vendor/autoload.php';
// require  './inc/koneksi.php';

$id_jadwal = $_GET['id_jadwal'];
$dari = $_GET['dari'];
$sampai = $_GET['sampai'];
// $kelas = $_GET['kelas'];

$kelasss = mysqli_query($koneksi,"SELECT nama_kelas FROM `jadwal` JOIN kelas ON kelas_id=id_kelas WHERE id_jadwal='$id_jadwal'");
$row_kelas=mysqli_fetch_assoc($kelasss);
$kelas=$row_kelas['nama_kelas'];

$sql = mysqli_query($koneksi, "SELECT absensi.nis, siswa.nama_siswa, kelas.nama_kelas, matpel.matpel, tanggal, keterangan FROM absensi 
JOIN jadwal ON absensi.jadwal_id = jadwal.id_jadwal 
JOIN matpel ON jadwal.matpel_id = matpel.id_matpel 
JOIN kelas ON jadwal.kelas_id = kelas.id_kelas 
JOIN siswa ON siswa.kelas_id = kelas.id_kelas 
WHERE jadwal.id_jadwal = '$id_jadwal' AND tanggal BETWEEN '$dari' AND '$sampai' GROUP BY tanggal");

// Buat instance mPDF
$mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);

// Isi konten laporan
$html = '<center><h1 style="text-align:center;">Laporan Absensi Kelas' . $kelas .'<br>
        Periode' .$dari. '-' .$sampai. '</h1></center>';
$html .= '<table border="1" cellpadding="10" cellspacing="0" width="100%">';
$html .= '<tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Mata Pelajaran</th>';

$minggu = 1;
while ($dataku = mysqli_fetch_assoc($sql)) {
    $html .= '<th>' . $dataku['tanggal'] . '<br>(Minggu ' . $minggu . ')</th>';
    $minggu++;
}
$html .= '</tr>';

$no = 1;
$sql = mysqli_query($koneksi, "SELECT * FROM absensi JOIN jadwal ON absensi.jadwal_id = jadwal.id_jadwal JOIN matpel ON jadwal.matpel_id = matpel.id_matpel JOIN kelas ON jadwal.kelas_id=kelas.id_kelas WHERE jadwal.id_jadwal = '$id_jadwal' AND tanggal BETWEEN '$dari' AND '$sampai' GROUP BY nis");
while ($data = mysqli_fetch_assoc($sql)) {
    $nis = $data['nis'];
    $html .= '<tr>';
    $html .= '<td>' . $no++ . '</td>';
    $html .= '<td>' . $data['nis'] . '</td>';
    $html .= '<td>' . $data['nama_siswa'] . '</td>';
    $html .= '<td>' . $data['nama_kelas'] . '</td>';
    $html .= '<td>' . $data['matpel'] . '</td>';
    
    $sqla = "SELECT keterangan FROM absensi WHERE nis = '$nis' AND jadwal_id = '$id_jadwal'";
    $querya = mysqli_query($koneksi, $sqla);
    while ($data2 = mysqli_fetch_assoc($querya)) {
        $html .= '<td>' . $data2['keterangan'] . '</td>';
    }
    $html .= '</tr>';
}
$html .= '</table>';

// Tambahkan konten ke PDF
$mpdf->WriteHTML($html);
ob_end_clean(); // Bersihkan output buffer sebelum mengeluarkan PDF
$mpdf->Output('Laporan Absensi.pdf', 'D'); // 'D' untuk download, 'I' untuk tampilan langsung
exit;
?>
