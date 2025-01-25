<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('profile', 'User\UserController::profile');

    // student
    $routes->get('student', 'StudentController::index');
    $routes->post('student', 'StudentController::form');

    // teacher
    $routes->get('teacher', 'DosenManagement\DosenController::index');
    $routes->post('teacher/store', 'DosenManagement\DosenController::store');
    $routes->post('teacher/delete', 'DosenManagement\DosenController::delete');

    $routes->get('rekognisi', 'RegoknisiManagement\RekognisiController::index');
    $routes->post('rekognisi/store', 'RegoknisiManagement\RekognisiController::store');
    $routes->post('rekognisi/delete', 'RegoknisiManagement\RekognisiController::delete');

    $routes->get('dtps', 'DtpsManagement\DtpsController::index');
    $routes->post('dtps/store', 'DtpsManagement\DtpsController::store');
    $routes->post('dtps/delete', 'DtpsManagement\DtpsController::delete');

    // kelompok
    $routes->get('kelompok', 'Kelompok\KelompokController::index');
    $routes->post('kelompok', 'Kelompok\KelompokController::form');
    $routes->put('kelompok/remove-student/(:segment)/kelompok/(:segment)', 'Kelompok\KelompokController::removeStudent/$1/$2');
    $routes->delete('kelompok/(:segment)', 'Kelompok\KelompokController::destroy/$1');

    // jadwal mengajar
    $routes->get('jadwal-mengajar', 'Teacher\JadwalMengajarController::index');
    $routes->post('jadwal-mengajar', 'Teacher\JadwalMengajarController::form');
    $routes->delete('jadwal-mengajar/(:segment)', 'Teacher\JadwalMengajarController::destroy/$1');
    $routes->get('jadwal-mengajar/(:segment)', 'Teacher\JadwalMengajarController::show/$1');
    $routes->get('get-list-jadwal', 'Teacher\JadwalMengajarController::getJSON');

    // sekolah
    $routes->get('sekolahView', 'Sekolah\SekolahController::index');
    $routes->post('sekolahForm', 'Sekolah\SekolahController::form');
    $routes->get('get-list-sekolah', 'Sekolah\SekolahController::getJSON');
    $routes->delete('sekolah/(:segment)', 'Sekolah\SekolahController::destroy/$1');

    // prestasi
    $routes->get('prestasi-anak', 'PrestasiAnak\PrestasiAnakController::index');
    $routes->post('prestasiForm', 'PrestasiAnak\PrestasiAnakController::form');
    $routes->get('get-list-prestasi', 'PrestasiAnak\PrestasiAnakController::getJSON');
    $routes->delete('prestasi/(:segment)', 'PrestasiAnak\PrestasiAnakController::destroy/$1');

    // identitas pegawai
    $routes->get('identitas-pegawai', 'Identitas\IdentitasPegawaiController::index');
    $routes->post('identitasForm', 'Identitas\IdentitasPegawaiController::form');
    $routes->get('get-list-identitas', 'Identitas\IdentitasPegawaiController::getJSON');
    $routes->delete('identitas/(:segment)', 'Identitas\IdentitasPegawaiController::destroy/$1');

    // alamat pegawai
    $routes->get('alamat-pegawai', 'Alamat\AlamatPegawaiController::index');
    $routes->post('alamatForm', 'Alamat\AlamatPegawaiController::form');
    $routes->get('get-list-alamat', 'Alamat\AlamatPegawaiController::getJSON');
    $routes->delete('alamat/(:segment)', 'Alamat\AlamatPegawaiController::destroy/$1');

    // Keterangan jasmani pegawai
    $routes->get('jasmani-pegawai', 'Keterangan\KeteranganJasmaniController::index');
    $routes->post('jasmaniForm', 'Keterangan\KeteranganJasmaniController::form');
    $routes->get('get-list-jasmani', 'Keterangan\KeteranganJasmaniController::getJSON');
    $routes->delete('jasmani/(:segment)', 'Keterangan\KeteranganJasmaniController::destroy/$1');
    // Tata Tertib
    $routes->get('tata-tertib', 'TataTertib\TataTertibController::index');
    $routes->get('tata-tertib/(:segment)', 'TataTertib\TataTertibController::detail/$1');
    $routes->post('tata-tertib', 'TataTertib\TataTertibController::store');
    $routes->post('tata-tertib/(:segment)', 'TataTertib\TataTertibController::update/$1');
    $routes->delete('tata-tertib/(:segment)', 'TataTertib\TataTertibController::delete/$1');

    // Surat Keterangan Pindah Sekolah
    $routes->get('surat-keterangan-pindah-sekolah', 'Surat\SuratKeteranganPindahSekolahController::index');
    $routes->get('surat-keterangan-pindah-sekolah/get-data/(:segment)', 'Surat\SuratKeteranganPindahSekolahController::getData/$1');
    $routes->get('surat-keterangan-pindah-sekolah/get-data/detail/(:segment)', 'Surat\SuratKeteranganPindahSekolahController::getDataDetail/$1');
    $routes->post('surat-keterangan-pindah-sekolah/send-data/(:segment)', 'Surat\SuratKeteranganPindahSekolahController::store/$1');
    $routes->post('surat-keterangan-pindah-sekolah/update-data/(:segment)', 'Surat\SuratKeteranganPindahSekolahController::update/$1');
    $routes->delete('surat-keterangan-pindah-sekolah/update-status/(:segment)', 'Surat\SuratKeteranganPindahSekolahController::delete/$1');
    $routes->get('surat-keterangan-pindah-sekolah/download-document/(:segment)', 'Surat\SuratKeteranganPindahSekolahController::download/$1');

    $routes->get('dashboard', 'Home::dashboard');
});

$routes->group('teacher', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'Home::dashboard');
    $routes->get('jadwal-mengajar', 'Teacher\JadwalMengajarController::index');
    $routes->get('profile', 'User\UserController::profile');
});

$routes->group('student', ['filter' => 'auth'], function ($routes) {
    $routes->get('profile', 'User\UserController::profile');
    $routes->get('surat-pindah-sekolah', 'Surat\SuratPindahSekolahController::index');
    $routes->post('permohonan-pindah-sekolah', 'Surat\SuratPindahSekolahController::store');
    $routes->get('surat-pindah-sekolah/download/(:segment)', 'Surat\SuratPindahSekolahController::generateWord/$1');
});

//API GET LIST
$routes->get('student/get-data', 'StudentController::getListUser', ['filter' => 'admin']);
$routes->get('teacher/get-data', 'Teacher\TeacherController::getListUser', ['filter' => 'admin']);
$routes->get('jadwal/get-data', 'Teacher\JadwalMengajarController::getJSON');
$routes->get('sekolah/get-data', 'Sekolah\SekolahController::getJSON');
$routes->get('prestasi/get-data', 'PrestasiAnak\PrestasiAnakController::getJSON');
$routes->get('identitas-pegawai/get-data', 'Identitas\IdentitasPegawaiController::getJSON');
$routes->get('jasmani-pegawai/get-data', 'Keterangan\KeteranganJasmaniController::getJSON');
$routes->get('alamat-pegawai/get-data', 'Alamat\AlamatPegawaiController::getJSON');


//API GENERAL
$routes->get('api/get-data-teacher', 'General\ApiGeneralController::getListTeacher');
$routes->get('api/get-data-student', 'General\ApiGeneralController::getListStudent');
$routes->get('api/get-data-kelompok', 'General\ApiGeneralController::getListClass');


// ROUTES -> Auth
$routes->get('/login', 'AuthController::signin');
$routes->post('/login/process', 'AuthController::process');
$routes->get('/daftar', 'AuthController::register');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/', 'Home::dashboard', ['filter' => 'auth']);
