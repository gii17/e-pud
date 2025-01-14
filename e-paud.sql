-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Jan 2024 pada 15.13
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-paud`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alamat_pegawai`
--

CREATE TABLE `alamat_pegawai` (
  `id_alamat` int(5) UNSIGNED NOT NULL,
  `nomor_induk` varchar(11) NOT NULL,
  `alamat_rumah` varchar(20) NOT NULL,
  `status_rumah` varchar(20) NOT NULL,
  `nomor_telephone` varchar(20) NOT NULL,
  `jarak_kantor` varchar(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `alamat_pegawai`
--

INSERT INTO `alamat_pegawai` (`id_alamat`, `nomor_induk`, `alamat_rumah`, `status_rumah`, `nomor_telephone`, `jarak_kantor`, `created_at`, `updated_at`) VALUES
(1, '112233', 'Jalan Kebon Sawit', 'Ngontrak', '08122345678910', '100KM', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `anak_pegawai`
--

CREATE TABLE `anak_pegawai` (
  `id_anak` int(5) UNSIGNED NOT NULL,
  `nomor_induk` varchar(11) NOT NULL,
  `nama_anak` varchar(20) NOT NULL,
  `status_anak` varchar(20) NOT NULL,
  `tempat_lahir_anak` varchar(100) NOT NULL,
  `tanggal_lahir_anak` varchar(20) NOT NULL,
  `nama_ortu_anak` varchar(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_induk_pegawai`
--

CREATE TABLE `data_induk_pegawai` (
  `id_identitas` int(5) UNSIGNED NOT NULL,
  `nomor_induk` varchar(11) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` varchar(20) NOT NULL,
  `status_kepegawaian` varchar(20) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `status_perkawinan` varchar(20) NOT NULL,
  `nama_pasangan` varchar(20) NOT NULL,
  `tanggal_lahir_pasangan` varchar(20) NOT NULL,
  `tanggal_perkawinan` varchar(20) NOT NULL,
  `keterangan_perkawinan` varchar(20) NOT NULL,
  `anak` varchar(20) NOT NULL,
  `status_anak` varchar(20) NOT NULL,
  `tempat_lahir_anak` varchar(100) NOT NULL,
  `tanggal_lahir_anak` varchar(20) NOT NULL,
  `nama_ortu_anak` varchar(20) NOT NULL,
  `alamat_rumah` varchar(20) NOT NULL,
  `status_rumah` varchar(20) NOT NULL,
  `nomor_telp` varchar(20) NOT NULL,
  `jarak_kantor` varchar(20) NOT NULL,
  `berat_badan` varchar(20) NOT NULL,
  `tinggi_badan` varchar(20) NOT NULL,
  `golongan_darah` varchar(20) NOT NULL,
  `riwayat_penyakit` varchar(20) NOT NULL,
  `jenjang_pendidikan` varchar(20) NOT NULL,
  `jurusan_pendidikan` varchar(20) NOT NULL,
  `tamat_tahun_pendidikan` varchar(20) NOT NULL,
  `jenis_training_pendidikan` varchar(20) NOT NULL,
  `tempat_training` varchar(20) NOT NULL,
  `tahun_training` varchar(20) NOT NULL,
  `bulan_training` varchar(20) NOT NULL,
  `hari_training` varchar(20) NOT NULL,
  `tingkat_training` varchar(20) NOT NULL,
  `keterangan_training` varchar(20) NOT NULL,
  `jenis_pekerjaan` varchar(20) NOT NULL,
  `tahun_pekerjaan` varchar(20) NOT NULL,
  `keterangan_pekerjaan` varchar(20) NOT NULL,
  `mapel` varchar(20) NOT NULL,
  `jenis_sekolah` varchar(20) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `tahun_mapel` varchar(20) NOT NULL,
  `nama_organisasi` varchar(20) NOT NULL,
  `jabatan_organisasi` varchar(20) NOT NULL,
  `tahun_organisasi` varchar(20) NOT NULL,
  `terhitung_mulai_tanggal` varchar(20) NOT NULL,
  `meninggalkan_sekolah` varchar(20) NOT NULL,
  `alasan_meninggalkan` varchar(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `identitas_pegawai`
--

CREATE TABLE `identitas_pegawai` (
  `id_identitas` int(5) UNSIGNED NOT NULL,
  `nomor_induk` varchar(11) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` varchar(20) NOT NULL,
  `status_kepegawaian` varchar(20) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `identitas_pegawai`
--

INSERT INTO `identitas_pegawai` (`id_identitas`, `nomor_induk`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `status_kepegawaian`, `nip`, `agama`, `created_at`, `updated_at`) VALUES
(1, '56789', '', 'Banten', '1989-09-11', 'Tetap', '123123123132', 'Islam', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_mengajar`
--

CREATE TABLE `jadwal_mengajar` (
  `id` int(5) NOT NULL,
  `hari` varchar(10) NOT NULL,
  `teacher_id` int(5) NOT NULL,
  `jpm` varchar(11) NOT NULL,
  `kelompok_id` int(5) NOT NULL,
  `kegiatan_awal` text NOT NULL,
  `kegiatan_inti` text NOT NULL,
  `kegiatan_akhir` text NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `jadwal_mengajar`
--

INSERT INTO `jadwal_mengajar` (`id`, `hari`, `teacher_id`, `jpm`, `kelompok_id`, `kegiatan_awal`, `kegiatan_inti`, `kegiatan_akhir`, `updated_at`, `created_at`) VALUES
(1, '', 5, '1', 1, '[{\"text\":\"Bahasa Indonesia\"},{\"text\":\"Bahasa Arab\"}]', '[{\"text\":\"Membaca\"},{\"text\":\"Mengaji\"}]', '[{\"text\":\"Pulang\"}]', NULL, '2024-01-15 23:01:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelompok`
--

CREATE TABLE `kelompok` (
  `kelompok_id` int(5) NOT NULL,
  `nama_kelompok` varchar(50) NOT NULL,
  `teacher_id` int(5) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `kelompok`
--

INSERT INTO `kelompok` (`kelompok_id`, `nama_kelompok`, `teacher_id`, `updated_at`, `created_at`) VALUES
(1, 'Kelompok 1234', 5, NULL, '2024-01-14 23:08:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keterangan_jasmani`
--

CREATE TABLE `keterangan_jasmani` (
  `id_jasmani` int(5) UNSIGNED NOT NULL,
  `nomor_induk` varchar(11) NOT NULL,
  `berat_badan` varchar(11) NOT NULL,
  `tinggi_badan` varchar(20) NOT NULL,
  `golongan_darah` varchar(20) NOT NULL,
  `riwayat_penyakit` varchar(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `keterangan_jasmani`
--

INSERT INTO `keterangan_jasmani` (`id_jasmani`, `nomor_induk`, `berat_badan`, `tinggi_badan`, `golongan_darah`, `riwayat_penyakit`, `created_at`, `updated_at`) VALUES
(1, '112233', '80', '170', '', 'Pilek', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2024-01-05-022422', 'App\\Database\\Migrations\\CreateUsers', 'default', 'App', 1704608461, 1),
(2, '2024-01-05-034550', 'App\\Database\\Migrations\\CreateKelompok', 'default', 'App', 1704608461, 1),
(3, '2024-01-06-084541', 'App\\Database\\Migrations\\CreateSuratPindahSekolah', 'default', 'App', 1704608461, 1),
(4, '2024-01-08-093705', 'App\\Database\\Migrations\\JadwalMengajar', 'default', 'App', 1705248558, 2),
(5, '2024-01-15-144327', 'App\\Database\\Migrations\\CreateTataTertib', 'default', 'App', 1705330123, 3),
(6, '2024-01-15-144431', 'App\\Database\\Migrations\\CreateTataTertibItem', 'default', 'App', 1705330124, 3),
(7, '2024-01-15-165304', 'App\\Database\\Migrations\\AlterTableTataTertibItem', 'default', 'App', 1705337667, 4),
(8, '2024-01-16-142006', 'App\\Database\\Migrations\\CreateTataTertib', 'default', 'App', 1705415002, 5),
(9, '2024-01-16-142014', 'App\\Database\\Migrations\\CreateTataTertibItem', 'default', 'App', 1705415002, 5),
(10, '2024-01-17-152050', 'App\\Database\\Migrations\\CreateSuratKeteranganPindahSekolahTable', 'default', 'App', 1705505455, 6),
(11, '2024-01-10-112705', 'App\\Database\\Migrations\\Sekolah', 'default', 'App', 1705673906, 7),
(12, '2024-01-18-160850', 'App\\Database\\Migrations\\DataIndukPegawai', 'default', 'App', 1705673906, 7),
(13, '2024-01-18-163008', 'App\\Database\\Migrations\\IdentitasPribadi', 'default', 'App', 1705673906, 7),
(14, '2024-01-18-163656', 'App\\Database\\Migrations\\PerkawinanPegawai', 'default', 'App', 1705673906, 7),
(15, '2024-01-18-165023', 'App\\Database\\Migrations\\AnakPegawai', 'default', 'App', 1705673906, 7),
(16, '2024-01-18-165455', 'App\\Database\\Migrations\\AlamatPegawai', 'default', 'App', 1705673906, 7),
(17, '2024-01-19-130547', 'App\\Database\\Migrations\\PrestasiAnak', 'default', 'App', 1705673906, 7),
(18, '2024-01-19-152311', 'App\\Database\\Migrations\\KeteranganJasmani', 'default', 'App', 1705741051, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `perkawinan_pergawai`
--

CREATE TABLE `perkawinan_pergawai` (
  `id_perkawinan` int(5) UNSIGNED NOT NULL,
  `nomor_induk` varchar(11) NOT NULL,
  `status_perkawinan` varchar(20) NOT NULL,
  `nama_pasangan` varchar(20) NOT NULL,
  `tanggal_lahir_pasangan` varchar(20) NOT NULL,
  `tanggal_perkawinan` varchar(20) NOT NULL,
  `keterangan_perkawinan` varchar(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `prestasi_anak`
--

CREATE TABLE `prestasi_anak` (
  `id_prestasi` int(5) UNSIGNED NOT NULL,
  `nomor_induk` varchar(11) NOT NULL,
  `nama_kegiatan` varchar(50) DEFAULT NULL,
  `tanggal_kegiatan` varchar(20) NOT NULL,
  `lokasi_kegiatan` varchar(50) DEFAULT NULL,
  `prestasi` varchar(50) DEFAULT NULL,
  `reward` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `prestasi_anak`
--

INSERT INTO `prestasi_anak` (`id_prestasi`, `nomor_induk`, `nama_kegiatan`, `tanggal_kegiatan`, `lokasi_kegiatan`, `prestasi`, `reward`, `created_at`, `updated_at`) VALUES
(1, '123456', 'Bagus', '2024-01-25', 'Bandung', 'Main Kelereng', 'Kelereng Sakebon', NULL, '2024-01-19 14:19:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sekolah`
--

CREATE TABLE `sekolah` (
  `id_sekolah` int(5) UNSIGNED NOT NULL,
  `nama_sekolah` varchar(50) DEFAULT NULL,
  `status_sekolah` varchar(50) DEFAULT NULL,
  `nomor_statistik` varchar(50) DEFAULT NULL,
  `kelurahan` varchar(50) DEFAULT NULL,
  `kecamatan` varchar(50) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `provinsi` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `sekolah`
--

INSERT INTO `sekolah` (`id_sekolah`, `nama_sekolah`, `status_sekolah`, `nomor_statistik`, `kelurahan`, `kecamatan`, `kota`, `provinsi`, `created_at`, `updated_at`) VALUES
(1, 'Paud Tadika Mesra', 'Terdaftar', '123123124', 'Derwati', 'Rancasari', 'Bandung', 'Kalimantan Timur', NULL, '2024-01-22 13:53:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_keterangan_pindah_sekolah`
--

CREATE TABLE `surat_keterangan_pindah_sekolah` (
  `id` int(5) NOT NULL,
  `nama_kb` varchar(255) DEFAULT NULL,
  `status_sekolah` varchar(255) DEFAULT NULL,
  `alamat_sekolah` text DEFAULT NULL,
  `kelurahan` varchar(255) DEFAULT NULL,
  `kecamatan` varchar(255) DEFAULT NULL,
  `kota` varchar(255) DEFAULT NULL,
  `provinsi` varchar(255) DEFAULT NULL,
  `tanggal_diterima` varchar(255) DEFAULT NULL,
  `kelompok_id` int(5) NOT NULL,
  `surat_id` int(5) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `surat_keterangan_pindah_sekolah`
--

INSERT INTO `surat_keterangan_pindah_sekolah` (`id`, `nama_kb`, `status_sekolah`, `alamat_sekolah`, `kelurahan`, `kecamatan`, `kota`, `provinsi`, `tanggal_diterima`, `kelompok_id`, `surat_id`, `created_at`) VALUES
(7, 'KB Baru', 'Status', 'Bandung', 'Sragen', 'Banten Timur', 'Bandung', 'West Java', '2024-01-18', 1, 1, '2024-01-20 15:59:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_pindah_sekolah`
--

CREATE TABLE `surat_pindah_sekolah` (
  `id_surat` int(5) NOT NULL,
  `student_id` int(5) NOT NULL,
  `nama_orang_tua` varchar(100) DEFAULT NULL,
  `sekolah_tujuan` varchar(50) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `kabupaten` varchar(50) NOT NULL,
  `provinsi` varchar(50) NOT NULL,
  `alasan` text NOT NULL,
  `pekerjaan` varchar(100) DEFAULT NULL,
  `alamat` text NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `surat_pindah_sekolah`
--

INSERT INTO `surat_pindah_sekolah` (`id_surat`, `student_id`, `nama_orang_tua`, `sekolah_tujuan`, `kecamatan`, `kabupaten`, `provinsi`, `alasan`, `pekerjaan`, `alamat`, `updated_at`, `created_at`) VALUES
(1, 2, 'Jordan', 'Tadika Mesra', 'Babakan Oray', 'Bandung barat', 'Jawa Barat', 'Anak ku dibully terus', 'Tunawisma', 'Bandung', NULL, '2024-01-17 21:38:21'),
(2, 6, 'Haha', 'Gatau ini juga', 'Wonosari', 'Semanu', 'Yogyakarta', 'Gurunya jelek', 'Gak Punya Kerja', 'Yogya Karta', NULL, '2024-01-18 22:55:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tata_tertib`
--

CREATE TABLE `tata_tertib` (
  `id` int(5) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `tata_tertib`
--

INSERT INTO `tata_tertib` (`id`, `judul`, `created_at`) VALUES
(9, 'Tata Tertib Paud', '2024-01-22 20:58:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tata_tertib_item`
--

CREATE TABLE `tata_tertib_item` (
  `id` int(5) NOT NULL,
  `deskripsi` text NOT NULL,
  `tata_tertib_id` int(5) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `tata_tertib_item`
--

INSERT INTO `tata_tertib_item` (`id`, `deskripsi`, `tata_tertib_id`, `created_at`) VALUES
(18, 'Orang tua dilarang masuk ke kelas', 9, '2024-01-22 20:58:04'),
(19, 'Murid harus dijemput tepat waktu', 9, '2024-01-22 20:58:04'),
(20, 'Orang tua tunggu ditempat yang telah disediakan', 9, '2024-01-22 20:58:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(5) NOT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `nomor_induk` varchar(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` varchar(20) NOT NULL,
  `tahun_masuk` varchar(20) NOT NULL,
  `id_kelompok` int(5) DEFAULT NULL,
  `type_user` varchar(20) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `photo`, `nama_lengkap`, `jenis_kelamin`, `nomor_induk`, `password`, `tempat_lahir`, `tanggal_lahir`, `tahun_masuk`, `id_kelompok`, `type_user`, `updated_at`, `created_at`) VALUES
(1, NULL, 'Administrator', 'L', 'admin', '$2y$10$d2PixSGMOz8dkDULP8X8ZeOxUAX8uvH99bCsWC6m4oohQHRDJoY1C', 'tes', '03-01-2024', '2024', NULL, 'is_admin', NULL, '2024-01-07 13:22:55'),
(2, 'http://localhost:8080/assets/img/avatar.png', 'Viko', 'L', '123456', '$2y$10$4HFC4LobnMIRUjI44JVzpupKRsdz9IAvon60eoklhvYblBoIiswuy', 'Bandung', '2023-07-01', '2023', 1, 'is_student', '2024-01-15 22:31:59', '2024-01-14 22:58:45'),
(5, 'http://localhost:8080/assets/img/avatar.png', 'Yanto', 'L', '112233', '$2y$10$UIDSm7a1kPGMZD8ci2FD4eXEsT4M6Ezz6WZiLOQhVum2guoKeIJjK', 'Jerman', '2024-01-01', '9999', 0, 'is_teacher', NULL, '2024-01-14 23:06:38'),
(6, 'http://localhost:8080/assets/img/avatar.png', 'Jordan', 'L', '123123', '$2y$10$2RajmLlIvdjyx2fIUsbsn.xfw9FpS.qiLkwDjr0UpAfbF.Ek64cNy', 'Yogya', '2024-01-01', '2023', NULL, 'is_student', NULL, '2024-01-18 22:54:12'),
(9, 'http://localhost:8080/assets/img/avatar.png', 'Yanti', 'P', '56789', '$2y$10$5OkdimxwclvT9fpowOWVI.VSS//u9hNlV20OZciQWlhIVYNrwAuDq', 'Bandung', '1995-01-18', '1234', NULL, 'is_teacher', NULL, '2024-01-22 20:52:23');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alamat_pegawai`
--
ALTER TABLE `alamat_pegawai`
  ADD PRIMARY KEY (`id_alamat`),
  ADD KEY `alamat_pegawai_nomor_induk_foreign` (`nomor_induk`);

--
-- Indeks untuk tabel `anak_pegawai`
--
ALTER TABLE `anak_pegawai`
  ADD PRIMARY KEY (`id_anak`),
  ADD KEY `anak_pegawai_nomor_induk_foreign` (`nomor_induk`);

--
-- Indeks untuk tabel `data_induk_pegawai`
--
ALTER TABLE `data_induk_pegawai`
  ADD PRIMARY KEY (`id_identitas`),
  ADD KEY `data_induk_pegawai_nomor_induk_foreign` (`nomor_induk`);

--
-- Indeks untuk tabel `identitas_pegawai`
--
ALTER TABLE `identitas_pegawai`
  ADD PRIMARY KEY (`id_identitas`),
  ADD KEY `identitas_pegawai_nomor_induk_foreign` (`nomor_induk`);

--
-- Indeks untuk tabel `jadwal_mengajar`
--
ALTER TABLE `jadwal_mengajar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_mengajar_teacher_id_foreign` (`teacher_id`),
  ADD KEY `jadwal_mengajar_kelompok_id_foreign` (`kelompok_id`);

--
-- Indeks untuk tabel `kelompok`
--
ALTER TABLE `kelompok`
  ADD PRIMARY KEY (`kelompok_id`),
  ADD KEY `kelompok_teacher_id_foreign` (`teacher_id`);

--
-- Indeks untuk tabel `keterangan_jasmani`
--
ALTER TABLE `keterangan_jasmani`
  ADD PRIMARY KEY (`id_jasmani`),
  ADD KEY `keterangan_jasmani_nomor_induk_foreign` (`nomor_induk`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `perkawinan_pergawai`
--
ALTER TABLE `perkawinan_pergawai`
  ADD PRIMARY KEY (`id_perkawinan`),
  ADD KEY `perkawinan_pergawai_nomor_induk_foreign` (`nomor_induk`);

--
-- Indeks untuk tabel `prestasi_anak`
--
ALTER TABLE `prestasi_anak`
  ADD PRIMARY KEY (`id_prestasi`),
  ADD KEY `prestasi_anak_nomor_induk_foreign` (`nomor_induk`);

--
-- Indeks untuk tabel `sekolah`
--
ALTER TABLE `sekolah`
  ADD PRIMARY KEY (`id_sekolah`);

--
-- Indeks untuk tabel `surat_keterangan_pindah_sekolah`
--
ALTER TABLE `surat_keterangan_pindah_sekolah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `surat_keterangan_pindah_sekolah_kelompok_id_foreign` (`kelompok_id`),
  ADD KEY `surat_keterangan_pindah_sekolah_surat_id_foreign` (`surat_id`);

--
-- Indeks untuk tabel `surat_pindah_sekolah`
--
ALTER TABLE `surat_pindah_sekolah`
  ADD PRIMARY KEY (`id_surat`),
  ADD KEY `surat_pindah_sekolah_student_id_foreign` (`student_id`);

--
-- Indeks untuk tabel `tata_tertib`
--
ALTER TABLE `tata_tertib`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tata_tertib_item`
--
ALTER TABLE `tata_tertib_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tata_tertib_item_tata_tertib_id_foreign` (`tata_tertib_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `nomor_induk` (`nomor_induk`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alamat_pegawai`
--
ALTER TABLE `alamat_pegawai`
  MODIFY `id_alamat` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `anak_pegawai`
--
ALTER TABLE `anak_pegawai`
  MODIFY `id_anak` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `data_induk_pegawai`
--
ALTER TABLE `data_induk_pegawai`
  MODIFY `id_identitas` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `identitas_pegawai`
--
ALTER TABLE `identitas_pegawai`
  MODIFY `id_identitas` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `jadwal_mengajar`
--
ALTER TABLE `jadwal_mengajar`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kelompok`
--
ALTER TABLE `kelompok`
  MODIFY `kelompok_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `keterangan_jasmani`
--
ALTER TABLE `keterangan_jasmani`
  MODIFY `id_jasmani` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `perkawinan_pergawai`
--
ALTER TABLE `perkawinan_pergawai`
  MODIFY `id_perkawinan` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `prestasi_anak`
--
ALTER TABLE `prestasi_anak`
  MODIFY `id_prestasi` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `sekolah`
--
ALTER TABLE `sekolah`
  MODIFY `id_sekolah` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `surat_keterangan_pindah_sekolah`
--
ALTER TABLE `surat_keterangan_pindah_sekolah`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `surat_pindah_sekolah`
--
ALTER TABLE `surat_pindah_sekolah`
  MODIFY `id_surat` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tata_tertib`
--
ALTER TABLE `tata_tertib`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tata_tertib_item`
--
ALTER TABLE `tata_tertib_item`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `alamat_pegawai`
--
ALTER TABLE `alamat_pegawai`
  ADD CONSTRAINT `alamat_pegawai_nomor_induk_foreign` FOREIGN KEY (`nomor_induk`) REFERENCES `users` (`nomor_induk`);

--
-- Ketidakleluasaan untuk tabel `anak_pegawai`
--
ALTER TABLE `anak_pegawai`
  ADD CONSTRAINT `anak_pegawai_nomor_induk_foreign` FOREIGN KEY (`nomor_induk`) REFERENCES `users` (`nomor_induk`);

--
-- Ketidakleluasaan untuk tabel `data_induk_pegawai`
--
ALTER TABLE `data_induk_pegawai`
  ADD CONSTRAINT `data_induk_pegawai_nomor_induk_foreign` FOREIGN KEY (`nomor_induk`) REFERENCES `users` (`nomor_induk`);

--
-- Ketidakleluasaan untuk tabel `identitas_pegawai`
--
ALTER TABLE `identitas_pegawai`
  ADD CONSTRAINT `identitas_pegawai_nomor_induk_foreign` FOREIGN KEY (`nomor_induk`) REFERENCES `users` (`nomor_induk`);

--
-- Ketidakleluasaan untuk tabel `jadwal_mengajar`
--
ALTER TABLE `jadwal_mengajar`
  ADD CONSTRAINT `jadwal_mengajar_kelompok_id_foreign` FOREIGN KEY (`kelompok_id`) REFERENCES `kelompok` (`kelompok_id`),
  ADD CONSTRAINT `jadwal_mengajar_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`user_id`);

--
-- Ketidakleluasaan untuk tabel `kelompok`
--
ALTER TABLE `kelompok`
  ADD CONSTRAINT `kelompok_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`user_id`);

--
-- Ketidakleluasaan untuk tabel `keterangan_jasmani`
--
ALTER TABLE `keterangan_jasmani`
  ADD CONSTRAINT `keterangan_jasmani_nomor_induk_foreign` FOREIGN KEY (`nomor_induk`) REFERENCES `users` (`nomor_induk`);

--
-- Ketidakleluasaan untuk tabel `perkawinan_pergawai`
--
ALTER TABLE `perkawinan_pergawai`
  ADD CONSTRAINT `perkawinan_pergawai_nomor_induk_foreign` FOREIGN KEY (`nomor_induk`) REFERENCES `users` (`nomor_induk`);

--
-- Ketidakleluasaan untuk tabel `prestasi_anak`
--
ALTER TABLE `prestasi_anak`
  ADD CONSTRAINT `prestasi_anak_nomor_induk_foreign` FOREIGN KEY (`nomor_induk`) REFERENCES `users` (`nomor_induk`);

--
-- Ketidakleluasaan untuk tabel `surat_keterangan_pindah_sekolah`
--
ALTER TABLE `surat_keterangan_pindah_sekolah`
  ADD CONSTRAINT `surat_keterangan_pindah_sekolah_kelompok_id_foreign` FOREIGN KEY (`kelompok_id`) REFERENCES `kelompok` (`kelompok_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `surat_keterangan_pindah_sekolah_surat_id_foreign` FOREIGN KEY (`surat_id`) REFERENCES `surat_pindah_sekolah` (`id_surat`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `surat_pindah_sekolah`
--
ALTER TABLE `surat_pindah_sekolah`
  ADD CONSTRAINT `surat_pindah_sekolah_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`user_id`);

--
-- Ketidakleluasaan untuk tabel `tata_tertib_item`
--
ALTER TABLE `tata_tertib_item`
  ADD CONSTRAINT `tata_tertib_item_tata_tertib_id_foreign` FOREIGN KEY (`tata_tertib_id`) REFERENCES `tata_tertib` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
