-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Jun 2025 pada 09.23
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siakad`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` int(10) NOT NULL,
  `jadwal_id` int(10) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` enum('Hadir','Izin','Sakit','Alfa') NOT NULL,
  `nis` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `jadwal_id`, `nama_siswa`, `kelas`, `tanggal`, `keterangan`, `nis`, `created_at`, `updated_at`) VALUES
(9, 6, 'awul', 'Kelas 10 A', '2025-02-25', 'Hadir', '720520012', '2025-02-25 23:30:31', '2025-02-25 23:30:31'),
(10, 6, 'wulan', 'Kelas 10 A', '2025-02-25', 'Hadir', '720520013', '2025-02-25 23:30:31', '2025-02-25 23:30:31'),
(11, 6, 'Sriwulan', 'Kelas 10 A', '2025-02-25', 'Hadir', '720520014', '2025-02-25 23:30:31', '2025-02-25 23:30:31'),
(12, 6, 'awul', 'Kelas 10 A', '2025-02-26', 'Hadir', '720520012', '2025-02-26 00:12:35', '2025-02-26 00:12:35'),
(13, 6, 'wulan', 'Kelas 10 A', '2025-02-26', 'Hadir', '720520013', '2025-02-26 00:12:35', '2025-02-26 00:12:35'),
(14, 6, 'Sriwulan', 'Kelas 10 A', '2025-02-26', 'Hadir', '720520014', '2025-02-26 00:12:35', '2025-02-26 00:12:35'),
(15, 7, 'tolak', 'Kelas 10 B', '2025-02-26', 'Hadir', '12341', '2025-02-26 00:12:50', '2025-02-26 00:12:50'),
(16, 7, 'Fery', 'Kelas 10 B', '2025-02-26', 'Izin', '12342', '2025-02-26 00:12:50', '2025-02-26 00:12:50'),
(17, 7, 'Amel', 'Kelas 10 B', '2025-02-26', 'Hadir', '12343', '2025-02-26 00:12:50', '2025-02-26 00:12:50'),
(18, 11, 'AMELIA WULANDARI', 'Kelas 11 A', '2025-04-24', 'Izin', '884', '2025-04-24 03:51:34', '2025-04-24 03:51:34'),
(19, 11, 'BELVA YURDIANA', 'Kelas 11 A', '2025-04-24', 'Sakit', '885', '2025-04-24 03:51:34', '2025-04-24 03:51:34'),
(20, 11, 'DZIHNI AULIA', 'Kelas 11 A', '2025-04-24', 'Izin', '886', '2025-04-24 03:51:34', '2025-04-24 03:51:34'),
(21, 11, 'IRVAN BAIHAKI', 'Kelas 11 A', '2025-04-24', 'Izin', '887', '2025-04-24 03:51:34', '2025-04-24 03:51:34'),
(22, 11, 'KASYIFA NURIL IZZY', 'Kelas 11 A', '2025-04-24', 'Hadir', '888', '2025-04-24 03:51:34', '2025-04-24 03:51:34'),
(23, 11, 'MOH. ALFIN AL-KAROMI', 'Kelas 11 A', '2025-04-24', 'Hadir', '889', '2025-04-24 03:51:34', '2025-04-24 03:51:34'),
(24, 11, 'MOH. AZKA ALFARIZKI', 'Kelas 11 A', '2025-04-24', 'Hadir', '890', '2025-04-24 03:51:34', '2025-04-24 03:51:34'),
(25, 11, 'MOH. THORIKURRAHMAN', 'Kelas 11 A', '2025-04-24', 'Hadir', '891', '2025-04-24 03:51:34', '2025-04-24 03:51:34'),
(26, 11, 'NADA INDI SILMIYAH', 'Kelas 11 A', '2025-04-24', 'Hadir', '892', '2025-04-24 03:51:34', '2025-04-24 03:51:34'),
(27, 11, 'NAILIA IZZI KAMILA', 'Kelas 11 A', '2025-04-24', 'Hadir', '893', '2025-04-24 03:51:34', '2025-04-24 03:51:34'),
(28, 11, 'NAILUR RIZQI', 'Kelas 11 A', '2025-04-24', 'Hadir', '894', '2025-04-24 03:51:34', '2025-04-24 03:51:34'),
(29, 11, 'NANDA ROMADHONI', 'Kelas 11 A', '2025-04-24', 'Hadir', '895', '2025-04-24 03:51:35', '2025-04-24 03:51:35'),
(30, 11, 'SAYYIDAH ITTAQILLAH', 'Kelas 11 A', '2025-04-24', 'Hadir', '896', '2025-04-24 03:51:35', '2025-04-24 03:51:35'),
(31, 11, 'SYAFIQAH AL-NABILA', 'Kelas 11 A', '2025-04-24', 'Hadir', '897', '2025-04-24 03:51:35', '2025-04-24 03:51:35'),
(32, 11, 'WIDIA NUR AVILLA PUTRI', 'Kelas 11 A', '2025-04-24', 'Hadir', '898', '2025-04-24 03:51:35', '2025-04-24 03:51:35'),
(33, 11, 'ZIFIANA EL RISBIYA', 'Kelas 11 A', '2025-04-24', 'Hadir', '899', '2025-04-24 03:51:35', '2025-04-24 03:51:35'),
(34, 4, 'tolak', 'Kelas 10 B', '2025-06-03', 'Hadir', '12341', '2025-06-03 07:20:25', '2025-06-03 07:20:25'),
(35, 4, 'Suprayitno', 'Kelas 10 B', '2025-06-03', 'Hadir', '721530003', '2025-06-03 07:20:25', '2025-06-03 07:20:25'),
(36, 4, 'Amel', 'Kelas 10 B', '2025-06-03', 'Izin', '12343', '2025-06-03 07:20:25', '2025-06-03 07:20:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `id_guru` int(10) NOT NULL,
  `nama_guru` varchar(50) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `nohp` varchar(12) NOT NULL,
  `rl` enum('guru','admin') NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`id_guru`, `nama_guru`, `nip`, `alamat`, `nohp`, `rl`, `password`) VALUES
(1, 'admin', '720520002', 'Sera timur', '08788867009', 'admin', 'admin'),
(2, 'guru', '3529050211660003', 'Dusun Mandaya, RT.1 RW.5, Serabarat Bluto', '0', 'guru', 'guru'),
(3, 'A. Mundzir', '3529060607710001', 'Dusun Sumber Agung Ares Tengah, RT 6.RW 6 Talang Saronggi', '0', 'guru', 'guru'),
(4, 'Azizah', '3529056512700001', 'Dusun Sumber langon, RT.7 RW.3 Seratengah Bluto', '0', 'guru', 'guru'),
(5, 'Insiyah', '197705172005012010', 'Dusun Daja Lorong RT.15, RW.1, Tanah Merah Saronggi', '0', 'guru', 'guru'),
(6, 'Mubdi', '3529051603710001', 'Dusun Kebunan, RT.3 RW.2 Seratimur Bluto', '0', 'guru', 'guru'),
(7, 'Baidlawi', '3529052812460002', 'Dusun Sumber langon, RT.7 RW.9 Seratengah Bluto', '0', 'guru', 'guru'),
(9, 'Unimatuz Zuhriyah', '3529055507860003', 'Dusun Sumber langon, RT.9 RW.4 Seratengah Bluto', '0', 'guru', 'guru'),
(10, 'Moh. Amin', '3529050505660001', 'Dusun Mandaya, RT.1 RW.5, Serabarat Bluto', '0', 'guru', 'guru'),
(11, 'Aisyah', '3529055210790002', 'Dusun Sumber Langon RT.7. RW.  3 Seratengah Bluto', '0', 'guru', 'guru'),
(12, 'Khoirur Razi', '3529050608800003', 'Dusun Aengbaja Raja RT.5.RW.3, Aengbaja Raja Bluto', '0', 'guru', 'guru'),
(13, 'Al Hidayat', '3529050403870003', 'Dusun Pandeman, RT.4 RW.2 Serabarat Bluto', '0', 'guru', 'guru'),
(14, 'Drs. Abd. Muqit Kamaluddin ', '3529050603660002', 'Dusun Sumber langon, RT.7 RW.3 Seratengah Bluto', '0', 'guru', 'guru'),
(15, 'Habir', '3529050606600003', 'Dusun Paninggin RT.2, RW.3 Ging-Ging Bluto', '0', 'guru', 'guru'),
(16, 'Drs. Hisyamuddin', '196512172005011001', 'Dusun Galis RT.3 RW.7 Karduluk Pragaan', '0', 'guru', 'guru'),
(17, 'Badrus Syamsi', '3529180307780002', 'Dusun So\'ongan RT.4 RW.2, Dungkek, Kec. Dungkek\r\n', '0', 'guru', 'guru'),
(18, 'Ika Wandari', '3529055505860003', 'Dusun Aengbaja Raja RT.5.RW.3, Aengbaja Raja Bluto', '0', 'guru', 'guru'),
(19, 'Nur Kholish', '3529050105720002', 'Dusun Gendis Rt.9, Rw.3, Aeng Tongtong, Saronggi', '0', 'guru', 'guru'),
(20, 'Moh. Zamroni', '3529051808860001', 'Dusun Kebunan, RT.3 RW.2 Seratimur Bluto', '0', 'guru', 'guru'),
(21, 'Muthi`atun', '3529055609870001', 'Dusun Air Mata Rt.2, RW.1 Seratimur Bluto', '0', 'guru', 'guru'),
(22, 'Badrut Tamam', '3529050202910004', 'Dusun Sumber langon, RT.9 RW.4 Seratengah Bluto', '0', 'guru', 'guru'),
(23, 'Ulfatul Ummamiyah', '3529076808990006', '-', '0', 'guru', 'guru'),
(24, 'Khoirur Rosyid', '3529052704970006', 'Dusun Tegal, RT 04 RW 02, Pakandangan Barat Bluto  ', '0', 'guru', 'guru'),
(25, 'Moh. Jayyit', '3529050202930002', 'Dusun Air Mata, RT 2 RW.1, Sera Timur Bluto', '0', 'guru', 'guru'),
(26, 'Fairuzah', '3529054202810005', 'Dusun Sumber langon, RT.6 RW.3 Seratengah Bluto', '0', 'guru', 'guru');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(10) NOT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu') NOT NULL,
  `matpel_id` int(10) NOT NULL,
  `kelas_id` int(10) NOT NULL,
  `guru_id` int(10) NOT NULL,
  `waktu` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `hari`, `matpel_id`, `kelas_id`, `guru_id`, `waktu`) VALUES
(4, 'Selasa', 1, 5, 2, '07:00'),
(5, 'Rabu', 4, 5, 4, '09:30'),
(6, 'Rabu', 2, 4, 8, '07:00 - 08:30'),
(7, 'Rabu', 2, 5, 8, '09:00 - 11:00'),
(8, 'Kamis', 3, 5, 2, '07:30'),
(9, 'Senin', 4, 4, 8, '07:00 - 08:30'),
(10, 'Selasa', 6, 4, 8, '09:00 - 11:00'),
(11, 'Kamis', 2, 1, 8, '12:00 - 13:00'),
(12, 'Jumat', 5, 5, 11, '10:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(10) NOT NULL,
  `nama_kelas` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`) VALUES
(1, 'Kelas 11 A'),
(2, 'Kelas 11 B'),
(3, 'Kelas 12 A'),
(4, 'Kelas 10 A'),
(5, 'Kelas 10 B');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(10) NOT NULL,
  `kriteria` varchar(50) NOT NULL,
  `bobot` float NOT NULL,
  `atribut` enum('benefit','cost') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kriteria`, `bobot`, `atribut`) VALUES
(1, 'Nilai Harian', 25, 'benefit'),
(2, 'Nilai Tugas', 25, 'benefit'),
(3, 'Nilai Praktikum', 25, 'benefit'),
(4, 'Nilai Semester', 25, 'benefit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `materi`
--

CREATE TABLE `materi` (
  `id_materi` int(11) NOT NULL,
  `jadwal_id` int(11) NOT NULL,
  `Judul` text NOT NULL,
  `deskripsi` text NOT NULL,
  `file` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `materi`
--

INSERT INTO `materi` (`id_materi`, `jadwal_id`, `Judul`, `deskripsi`, `file`, `created_at`, `updated_at`) VALUES
(1, 1, 'Algoritma dan Struktur Data diubah', 'Mahasiswa Diharap Mempelajari materi ini sebelum nantinya dimulai pembelajaran', 'j1.pdf', '2025-02-25 08:22:50', '2025-02-25 08:22:50'),
(2, 3, 'Pengertian Bahasa Pemrograman ', 'Mahasiswa Diharap bisa memhami konsep apa itu bahasa pemrograman', 'otitoju2024-MOOC-UTAUT.pdf', '2025-02-25 08:22:50', '2025-02-25 08:22:50'),
(3, 2, 'coba diubah', 'coba', '67bd84de838f1.pdf', '2025-02-25 08:52:46', '2025-02-25 08:52:46'),
(5, 4, 'Hadist tentang Sabar', 'SIswa Diharap untuk memahami arti hadist tersebut tentang  kesabaran, dan bisa diaplikasikan dalam kehidupan sehari hari', '67be50fa35a9f.pdf', '2025-02-25 23:23:38', '2025-02-25 23:23:38'),
(6, 5, 'Terjemahan hadist tentang kesabaran', 'Siswa diharap mempelajari hadist tersebut dan dapat megaplikasikannya dalam kehidupan sehari-hari', '67be51476f19b.pdf', '2025-02-25 23:24:55', '2025-02-25 23:24:55'),
(7, 8, 'Pngertian dan arti istilah', 'Mahasiswa Diharap Mempelajari materi ini sebelum nantinya dimulai pembelajaran, diharap nanti bisa maju untuk mempresentasikan materi tersebut', '67be52051ecd3.pdf', '2025-02-25 23:28:05', '2025-02-25 23:28:05'),
(8, 5, 'Fungsi dan Kedudukan Al-Qur’an dan Hadis', 'Pelajari, nanatinya siswa Mempresentasikan dan Menjelaskan akidah (keimanan) ', '67c3a92db4306.png', '2025-03-02 00:41:17', '2025-03-02 00:41:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `matpel`
--

CREATE TABLE `matpel` (
  `id_matpel` int(10) NOT NULL,
  `matpel` varchar(50) NOT NULL,
  `kode_matpel` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `matpel`
--

INSERT INTO `matpel` (`id_matpel`, `matpel`, `kode_matpel`) VALUES
(1, 'Quran Hadits', 'P01'),
(2, 'Aqidah Akhlak', 'P02'),
(3, 'Fiqih', 'P03'),
(4, 'SKI', 'P04'),
(5, 'PKN', 'P05'),
(6, 'Bahasa Indonesia', 'P06'),
(7, 'Bahasa Arab', 'P07'),
(8, 'Bahasa Inggris', 'P08'),
(9, 'Matematika', 'P09'),
(10, 'IPA', 'P10'),
(11, 'IPS', 'P11'),
(12, 'Seni Budaya', 'P12'),
(13, 'Penjaskes', 'P13'),
(14, 'TIK', 'P14'),
(15, 'Bahasa Daerah', 'P15'),
(16, 'Nahwu', 'P16'),
(17, 'Sharraf', 'P17'),
(18, 'Qawaid Fiq', 'P18'),
(19, 'Hadits', 'P19'),
(20, 'Tauhid', 'P20'),
(21, 'Tahfidh', 'P21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(10) NOT NULL,
  `nis_siswa` varchar(20) NOT NULL,
  `kriteria_id` int(10) NOT NULL,
  `nilai_ratarata` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `nis_siswa`, `kriteria_id`, `nilai_ratarata`) VALUES
(1, '720520012', 1, 90.00),
(2, '720520012', 2, 80.00),
(3, '720520012', 3, 65.00),
(4, '720520012', 4, 70.00),
(5, '720520013', 1, 90.00),
(6, '720520013', 2, 65.00),
(7, '720520013', 3, 75.00),
(8, '720520013', 4, 55.00),
(9, '720520014', 1, 90.00),
(10, '720520014', 2, 80.00),
(11, '720520014', 3, 60.00),
(12, '720520014', 4, 70.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_awal`
--

CREATE TABLE `nilai_awal` (
  `id_nilai_awal` int(10) NOT NULL,
  `jadwal_id` int(10) NOT NULL,
  `nis_siswa` varchar(20) NOT NULL,
  `kriteria_id` int(10) NOT NULL,
  `nilai_pertama` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `nilai_awal`
--

INSERT INTO `nilai_awal` (`id_nilai_awal`, `jadwal_id`, `nis_siswa`, `kriteria_id`, `nilai_pertama`) VALUES
(21, 4, '12341', 1, 90.00),
(22, 4, '12341', 2, 0.00),
(23, 4, '12341', 3, 0.00),
(24, 4, '12341', 4, 0.00),
(25, 4, '721530003', 1, 80.00),
(26, 4, '721530003', 2, 0.00),
(27, 4, '721530003', 3, 0.00),
(28, 4, '721530003', 4, 0.00),
(29, 4, '12343', 1, 70.00),
(30, 4, '12343', 2, 0.00),
(31, 4, '12343', 3, 0.00),
(32, 4, '12343', 4, 0.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(10) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `alamat` text NOT NULL,
  `kelas_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nis`, `nama_siswa`, `jenis_kelamin`, `alamat`, `kelas_id`) VALUES
(1, '884', 'AMELIA WULANDARI', 'perempuan', 'Sera Timur', 1),
(2, '885', 'BELVA YURDIANA', 'perempuan', 'Sera Barat', 1),
(3, '886', 'DZIHNI AULIA', 'perempuan', 'Sera Barat', 1),
(4, '887', 'IRVAN BAIHAKI', 'laki-laki', 'Talang', 1),
(5, '888', 'KASYIFA NURIL IZZY', 'perempuan', 'Sera Barat', 1),
(6, '889', 'MOH. ALFIN AL-KAROMI', 'laki-laki', 'Sera Barat', 1),
(7, '890', 'MOH. AZKA ALFARIZKI', 'laki-laki', 'Sera Timur', 1),
(8, '891', 'MOH. THORIKURRAHMAN', 'laki-laki', 'Sera Tengah', 1),
(9, '892', 'NADA INDI SILMIYAH', 'laki-laki', 'Sera Tengah', 1),
(10, '893', 'NAILIA IZZI KAMILA', 'perempuan', 'Sera Timur', 1),
(11, '894', 'NAILUR RIZQI', 'laki-laki', 'Sera Barat', 1),
(12, '895', 'NANDA ROMADHONI', 'perempuan', 'Sera Tengah', 1),
(13, '896', 'SAYYIDAH ITTAQILLAH', 'perempuan', 'Sera Timur', 1),
(14, '897', 'SYAFIQAH AL-NABILA', 'perempuan', 'Sera Timur', 1),
(15, '898', 'WIDIA NUR AVILLA PUTRI', 'perempuan', 'Sera Barat', 1),
(16, '899', 'ZIFIANA EL RISBIYA', 'perempuan', 'Sera Barat', 1),
(17, '868', 'AFRA ELYANA DITA', 'perempuan', 'Sera Timur', 2),
(18, '869', 'AGUNG PURNOMO', 'laki-laki', 'Talang', 2),
(19, '870', 'AHMAD TANZIL AL AZIZ', 'laki-laki', 'Sera Timur', 2),
(20, '871', 'DODIK SAHRULLAH', 'laki-laki', 'Talang', 2),
(21, '872', 'HAFIZATUS SHOLIHAH', 'perempuan', 'Sera Timur', 2),
(22, '873', 'HILMAN ARRABBANI', 'laki-laki', 'Sera Timur', 2),
(23, '874', 'IMAMUL ADIL', 'laki-laki', 'Sera Timur', 2),
(24, '875', 'MUZAYYANATUL KAMILA', 'perempuan', 'Sera Tengah', 2),
(25, '876', 'NABILUL IHSAN', 'laki-laki', 'Sera Timur', 2),
(26, '877', 'NASIKAH RIFLAH', 'perempuan', 'Sera Tengah', 2),
(27, '878', 'NAZILA NISFIL LAIL', 'perempuan', 'Sera Barat', 2),
(28, '879', 'RADEN AINUR RAHMAN', 'laki-laki', 'Talang', 2),
(29, '880', 'FATHOR ROSIK', 'laki-laki', '-', 2),
(30, '883', 'QURROTUL AINI', 'perempuan', 'Sera Timur', 2),
(31, '854', 'AFIFATUL AULIYA', 'perempuan', 'Aeng Tong-Tong', 3),
(32, '855', 'AHMAD GUNAWAN', 'laki-laki', 'Sera Timur', 3),
(33, '856', 'DIMAS AS SILMI', 'laki-laki', 'Sera Timur', 3),
(34, '857', 'FAZA AULIA RAMADHANI', 'perempuan', 'Sera Tengah', 3),
(35, '858', 'ILHAM ISYRAQI', 'laki-laki', 'Sera Barat', 3),
(36, '859', 'M. ADIB ALFARIZI', 'laki-laki', 'Sera Tengah', 3),
(37, '860', 'M.S. ZABAD', 'laki-laki', 'Sera Timur', 3),
(38, '861', 'MOH. FARIS', 'laki-laki', 'Sera Timur', 3),
(39, '862', 'NABILI MILKI KHAIRIN', 'laki-laki', 'Sera Tengah', 3),
(40, '863', 'NAFIDHATUL ELMI WAROHMAH', 'perempuan', 'Sera Timur', 3),
(41, '864', 'NUR KANZA EILMAH', 'perempuan', 'Sera Tengah', 3),
(42, '865', 'SYAIFUL RAHMAN', 'laki-laki', 'Karangharjo', 3),
(43, '866', 'TSINTAINI NURONI', 'perempuan', 'Sera Timur', 3),
(44, '867', 'WARDA AL FAFA', 'perempuan', 'Sera Timur', 3),
(45, '881', 'ZAINAL ARIF', 'laki-laki', 'Talang', 3),
(46, '882', 'MEYSHA CINDY AFRIDA', 'perempuan', 'Gung-Gung Timur', 3),
(47, '720520012', 'awul', 'laki-laki', 'Paberasan', 4),
(48, '720520013', 'wulan', 'perempuan', 'Parsanga', 4),
(49, '12341', 'tolak', 'perempuan', 'kalianget', 5),
(50, '721530003', 'Suprayitno', 'laki-laki', 'saronggi', 5),
(51, '720520014', 'Sriwulan', 'perempuan', 'Saronggi', 4),
(52, '12343', 'Amel', 'perempuan', 'batuputih', 5);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`),
  ADD KEY `id_jadwal` (`jadwal_id`);

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_matpel` (`matpel_id`,`kelas_id`,`guru_id`),
  ADD KEY `id_guru` (`guru_id`),
  ADD KEY `id_kelas` (`kelas_id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id_materi`);

--
-- Indeks untuk tabel `matpel`
--
ALTER TABLE `matpel`
  ADD PRIMARY KEY (`id_matpel`);

--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indeks untuk tabel `nilai_awal`
--
ALTER TABLE `nilai_awal`
  ADD PRIMARY KEY (`id_nilai_awal`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `kelas_id` (`kelas_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `materi`
--
ALTER TABLE `materi`
  MODIFY `id_materi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `matpel`
--
ALTER TABLE `matpel`
  MODIFY `id_matpel` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `nilai_awal`
--
ALTER TABLE `nilai_awal`
  MODIFY `id_nilai_awal` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
