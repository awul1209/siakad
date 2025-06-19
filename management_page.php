<?php

if (isset($_GET['page'])) {
    $hal = $_GET['page'];

    switch ($hal) {
        //guru
    
        case 'data-guru':
            include 'admin/guru/data_guru.php';
            break;
        case 'guru':
            include 'admin/guru/data_guru2.php';
            break;
        case 'add-guru':
            include 'admin/guru/add_guru.php';
            break;
        case 'import-guru':
            include 'admin/guru/add_excel.php';
            break;
        case 'edit-guru':
            include 'admin/guru/edit_guru.php';
            break;
        case 'del-guru':
            include 'admin/guru/del_guru.php';
            break;

        //kelas
       
        case 'data-kelas':
            include 'admin/kelas/data_kelas.php';
            break;
        case 'add-kelas':
            include 'admin/kelas/add_kelas.php';
            break;
        case 'edit-kelas':
            include 'admin/kelas/edit_kelas.php';
            break;
        case 'del-kelas':
            include 'admin/kelas/del_kelas.php';
            break;
        case 'kelas-siswa':
            include 'admin/kelas/kelas_siswa.php';
            break;

        //matpel
       
        case 'data-matpel':
            include 'admin/matpel/data_matpel.php';
            break;
        case 'add-matpel':
            include 'admin/matpel/add_matpel.php';
            break;
        case 'edit-matpel':
            include 'admin/matpel/edit_matpel.php';
            break;
        case 'del-matpel':
            include 'admin/matpel/del_matpel.php';
            break;

            //siswa
       
        case 'data-siswa':
            include 'admin/siswa/data_siswa.php';
            break;
        case 'siswa':
            include 'admin/siswa/data_siswa2.php';
            break;
        case 'add-siswa':
            include 'admin/siswa/add_siswa.php';
            break;
        case 'import-siswa':
            include 'admin/siswa/add_axcel.php';
            break;
        case 'edit-siswa':
            include 'admin/siswa/edit_siswa.php';
            break;
        case 'del-siswa':
            include 'admin/siswa/del_siswa.php';
            break;

            //jadwal
       
        case 'data-jadwal':
            include 'admin/jadwal/data_jadwal.php';
            break;
        case 'data-jadwal-guru':
            include 'admin/jadwal/data_jadwal_guru.php';
            break;
        case 'add-jadwal':
            include 'admin/jadwal/add_jadwal.php';
            break;
        case 'edit-jadwal':
            include 'admin/jadwal/edit_jadwal.php';
            break;
        case 'del-jadwal':
            include 'admin/jadwal/del_jadwal.php';
            break;
        case 'jadwal-kelas':
            include 'admin/jadwal/jadwal_kelas.php';
            break;

            //absensi
            case 'absen-guru':
                include 'admin/absensi/absen_guru.php';
                break;
        case 'pilih-absensi':
            include 'admin/absensi/pilih_absensi.php';
            break;
        case 'absensi-siswa':
            include 'admin/absensi/absensi_siswa.php';
            break;
        case 'edit-absensi':
            include 'admin/absensi/edit_absensi.php';
            break;
        case 'del-absensi':
            include 'admin/absensi/del_absensi.php';
            break;
        case 'rekap-absensi':
            include 'admin/absensi/rekap_absensi.php';
            break;
        case 'edit-absen':
            include 'admin/absensi/edit_absen.php';
            break;

        //Kriteria
       
        case 'data-kriteria':
            include 'admin/kriteria/data_kriteria.php';
            break;
        case 'add-kriteria':
            include 'admin/kriteria/add_kriteria.php';
            break;
        case 'edit-kriteria':
            include 'admin/kriteria/edit_kriteria.php';
            break;
        case 'del-kriteria':
            include 'admin/kriteria/del_kriteria.php';
            break;

        case 'siswa-absen':
            include 'admin/siswa/index_absensi.php';
            break;
        case 'data-siswa-absen':
            include 'admin/siswa/data_siswa_absen.php';
            break;


        //Penilaian
    
        case 'data-nilai':
            include 'admin/nilai/data_nilai.php';
            break;
        case 'input-nilai-guru':
            include 'admin/nilai/input_nilai_guru.php';
            break;
        case 'edit-nilai-guru':
            include 'admin/nilai/edit_nilai.php';
            break;
        case 'pilih-nilai-guru':
            include 'admin/nilai/pilih_nilai_guru.php';
            break;
        case 'nilai-rata-rata':
            include 'admin/nilai/nilai_rata_rata.php';
            break;
        case 'import-nilai':
            include 'admin/nilai/add_axcel.php';
            break;

        //Rangking
       
        case 'pilih-rangking':
            include 'admin/rangking/pilih_rangking.php';
            break;
        case 'proses-hitung':
            include 'admin/rangking/proses_hitung_spk.php';
            break;



            // materi
        case 'materi':
            include 'admin/materi/index.php';
            break;
        case 'data-materi':
            include 'admin/materi/data_materi.php';
            break;
        case 'add-materi':
            include 'admin/materi/add_materi.php';
            break;
        case 'edit-materi':
            include 'admin/materi/edit_materi.php';
            break;
        case 'del-materi':
            include 'admin/materi/del_materi.php';
            break;
        case 'module':
            include 'admin/module/index.php';
            break;

            // cetak
        case 'cetak-absen':
            include 'cetak/cetak_absen.php';
            break;
    

        //default
        default:
            echo '<center><h1> ERROR !</h1></center>';
            break;
    }
} else {
    // Auto Halaman Home Pengguna
    if ($data_level == 'admin') {
        include 'home/admin.php';
    } elseif ($data_level == 'guru') {
        include 'home/guru.php';
    }else {
        include 'home/siswa.php';
    }
}

?>
