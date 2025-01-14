<?php

namespace App\Controllers\Buku;

use App\Controllers\BaseController;
use App\Models\Buku\BukuIndukPegawaiModels;
use App\Models\User\UserModels;

class BukuIndukPegawaiController extends BaseController
{

    protected $usersModel;
    protected $bukuIndukPegawai;

    public function __construct()
    {
        $this->bukuIndukPegawai = new BukuIndukPegawaiModels();
        $this->usersModel = new UserModels();
    }

    public function index()
    {
        $data['buku_pegawai'] = $this->bukuIndukPegawai->getAll();
        $data['users'] = $this->usersModel->findAll();
        return view('page/buku-induk-pegawai/index', $data);
    }

    public function form()
    {
        if(is_null($this->request->getPost('id_identitas'))){
            $prestasi = new BukuIndukPegawaiModels();

            $prestasi->insert([
                "id_identitas"              => $this->request->getPost('id_identitas'),
                "nomor_induk"               => $this->request->getPost('nomor_induk'),
                "nama_kegiatan"             => $this->request->getPost('nama_kegiatan'),
                "jenis_kelamin"             => $this->request->getPost('jenis_kelamin'),
                "tempat_lahir"              => $this->request->getPost('tempat_lahir'),
                "tanggal_lahir"             => $this->request->getPost('tanggal_lahir'),
                "status_kepegawaian"        => $this->request->getPost('status_kepegawaian'),
                "nip"                       => $this->request->getPost('nip'),
                "agama"                     => $this->request->getPost('agama'),
                "status_perkawinan"         => $this->request->getPost('status_perkawinan'),
                "tanggal_lahir_pasangan"    => $this->request->getPost('tanggal_lahir_pasangan'),
                "tanggal_perkawinan"        => $this->request->getPost('tanggal_perkawinan'),
                "keterangan_perkawinan"     => $this->request->getPost('keterangan_perkawinan'),
                "anak"                      => $this->request->getPost('anak'),
                "status_anak"               => $this->request->getPost('status_anak'),
                "tempat_lahir_anak"         => $this->request->getPost('tempat_lahir_anak'),
                "tanggal_lahir_anak"        => $this->request->getPost('tanggal_lahir_anak'),
                "alamat_rumah"              => $this->request->getPost('alamat_rumah'),
                "status_rumah"              => $this->request->getPost('status_rumah'),
                "nomor_telp"                => $this->request->getPost('nomor_telp'),
                "jarak_kantor"              => $this->request->getPost('jarak_kantor'),
                "berat_badan"               => $this->request->getPost('berat_badan'),
                "tinggi_badan"              => $this->request->getPost('tinggi_badan'),
                "golongan_darah"            => $this->request->getPost('golongan_darah'),
                "riwayat_penyakit"          => $this->request->getPost('riwayat_penyakit'),
                "jenjang_pendidikan"        => $this->request->getPost('jenjang_pendidikan'),
                "jurusan_pendidikan"        => $this->request->getPost('jurusan_pendidikan'),
                "tamat_tahun_pendidikan"    => $this->request->getPost('tamat_tahun_pendidikan'),
                "jenis_training_pendidikan" => $this->request->getPost('jenis_training_pendidikan'),
                "tempat_training"           => $this->request->getPost('tempat_training'),
                "tahun_training"            => $this->request->getPost('tahun_training'),
                "bulan_training"            => $this->request->getPost('bulan_training'),
                "hari_training"             => $this->request->getPost('hari_training'),
                "tingkat_training"          => $this->request->getPost('tingkat_training'),
                "keterangan_training"       => $this->request->getPost('keterangan_training'),
                "jenis_pekerjaan"           => $this->request->getPost('jenis_pekerjaan'),
                "tahun_pekerjaan"           => $this->request->getPost('tahun_pekerjaan'),
                "keterangan_pekerjaan"      => $this->request->getPost('keterangan_pekerjaan'),
                "mapel"                     => $this->request->getPost('mapel'),
                "kelas"                     => $this->request->getPost('kelas'),
                "tahun_mapel"               => $this->request->getPost('tahun_mapel'),
                "nama_organisasi"           => $this->request->getPost('nama_organisasi'),
                "jabatan_organisasi"        => $this->request->getPost('jabatan_organisasi'),
                "tahun_organisasi"          => $this->request->getPost('tahun_organisasi'),
                "terhitung_mulai_tanggal"   => $this->request->getPost('terhitung_mulai_tanggal'),
                "meninggalkan_sekolah"      => $this->request->getPost('meninggalkan_sekolah'),
                "alasan_meninggalkan"       => $this->request->getPost('alasan_meninggalkan'),
                "created_at"                => $this->request->getPost('created_at'),
            ]);

            return $this->response->setJSON([
                'status' => true,
                'message'   => "Buku Induk Pegawai berhasil di terdaftar!",
            ]);
        }else{
                $bukuIndukPegawai = new BukuIndukPegawaiModels();
                date_default_timezone_set('Asia/Jakarta');
                
                $data = [
                    "id_identitas"              => $this->request->getPost('id_identitas'),
                    "nomor_induk"               => $this->request->getPost('nomor_induk'),
                    "nama_kegiatan"             => $this->request->getPost('nama_kegiatan'),
                    "jenis_kelamin"             => $this->request->getPost('jenis_kelamin'),
                    "tempat_lahir"              => $this->request->getPost('tempat_lahir'),
                    "tanggal_lahir"             => $this->request->getPost('tanggal_lahir'),
                    "status_kepegawaian"        => $this->request->getPost('status_kepegawaian'),
                    "nip"                       => $this->request->getPost('nip'),
                    "agama"                     => $this->request->getPost('agama'),
                    "status_perkawinan"         => $this->request->getPost('status_perkawinan'),
                    "tanggal_lahir_pasangan"    => $this->request->getPost('tanggal_lahir_pasangan'),
                    "tanggal_perkawinan"        => $this->request->getPost('tanggal_perkawinan'),
                    "keterangan_perkawinan"     => $this->request->getPost('keterangan_perkawinan'),
                    "anak"                      => $this->request->getPost('anak'),
                    "status_anak"               => $this->request->getPost('status_anak'),
                    "tempat_lahir_anak"         => $this->request->getPost('tempat_lahir_anak'),
                    "tanggal_lahir_anak"        => $this->request->getPost('tanggal_lahir_anak'),
                    "alamat_rumah"              => $this->request->getPost('alamat_rumah'),
                    "status_rumah"              => $this->request->getPost('status_rumah'),
                    "nomor_telp"                => $this->request->getPost('nomor_telp'),
                    "jarak_kantor"              => $this->request->getPost('jarak_kantor'),
                    "berat_badan"               => $this->request->getPost('berat_badan'),
                    "tinggi_badan"              => $this->request->getPost('tinggi_badan'),
                    "golongan_darah"            => $this->request->getPost('golongan_darah'),
                    "riwayat_penyakit"          => $this->request->getPost('riwayat_penyakit'),
                    "jenjang_pendidikan"        => $this->request->getPost('jenjang_pendidikan'),
                    "jurusan_pendidikan"        => $this->request->getPost('jurusan_pendidikan'),
                    "tamat_tahun_pendidikan"    => $this->request->getPost('tamat_tahun_pendidikan'),
                    "jenis_training_pendidikan" => $this->request->getPost('jenis_training_pendidikan'),
                    "tempat_training"           => $this->request->getPost('tempat_training'),
                    "tahun_training"            => $this->request->getPost('tahun_training'),
                    "bulan_training"            => $this->request->getPost('bulan_training'),
                    "hari_training"             => $this->request->getPost('hari_training'),
                    "tingkat_training"          => $this->request->getPost('tingkat_training'),
                    "keterangan_training"       => $this->request->getPost('keterangan_training'),
                    "jenis_pekerjaan"           => $this->request->getPost('jenis_pekerjaan'),
                    "tahun_pekerjaan"           => $this->request->getPost('tahun_pekerjaan'),
                    "keterangan_pekerjaan"      => $this->request->getPost('keterangan_pekerjaan'),
                    "mapel"                     => $this->request->getPost('mapel'),
                    "kelas"                     => $this->request->getPost('kelas'),
                    "tahun_mapel"               => $this->request->getPost('tahun_mapel'),
                    "nama_organisasi"           => $this->request->getPost('nama_organisasi'),
                    "jabatan_organisasi"        => $this->request->getPost('jabatan_organisasi'),
                    "tahun_organisasi"          => $this->request->getPost('tahun_organisasi'),
                    "terhitung_mulai_tanggal"   => $this->request->getPost('terhitung_mulai_tanggal'),
                    "meninggalkan_sekolah"      => $this->request->getPost('meninggalkan_sekolah'),
                    "alasan_meninggalkan"       => $this->request->getPost('alasan_meninggalkan'),
                    "created_at"                => $this->request->getPost('created_at'),
                    "updated_at" => date('Y-m-d H:i:s')
                ];

                $bukuIndukPegawai->where('id_identitas', $this->request->getPost('id_identitas'))->set($data)->update();

                return $this->response->setJSON([
                    'status' => true,
                    'message' => "Buku Induk Pegawai berhasil di ubah!",
                ]);
        }
    }

    public function generateWord($id){
        helper('text');
        $filepath = WRITEPATH . 'uploads/template/template_surat_permohonan_pindah_sekolah.docx';

        $user = new UserModels();
        $user->select('nama_lengkap AS nama_siswa, tempat_lahir, tanggal_lahir, nomor_induk, jenis_kelamin, id_kelompok')
        ->where('user_id', session()->get('user_id'));
        $student = $user->get()->getRow();

        $jenis_kelamin = "";

        if($student->jenis_kelamin == 'L') $jenis_kelamin = "Laki-laki";
        else $jenis_kelamin = "Perempuan";

        $nama_kelompok = null;

        if(!is_null($student->id_kelompok)){
            $kelompok = new KelompokModels();
            $kelompok->select('nama_kelompok')
            ->where('kelompok_id', $student->id_kelompok);
            $nama_kelompok = $kelompok->get()->getRow()->nama_kelompok ?? '-';
        }

        $model = new SuratPindahSekolahModels();
        $model->where('id_surat', $id);
        $surat = $model->get()->getRow();

        $timestamp = strtotime(date('Y-m-d H:i:s'));
        $now = date('d-m-Y', $timestamp);

        $templateProcessor = new TemplateProcessor($filepath);

        $templateProcessor->setValue('nama_orang_tua', $surat->nama_orang_tua);
        $templateProcessor->setValue('pekerjaan', $surat->pekerjaan);
        $templateProcessor->setValue('alamat', $surat->alamat);
        $templateProcessor->setValue('nama_siswa', $student->nama_siswa);
        $templateProcessor->setValue('tempat_lahir', $student->tempat_lahir);
        $templateProcessor->setValue('tanggal_lahir', $student->tanggal_lahir);
        $templateProcessor->setValue('nomor_induk', $student->nomor_induk);
        $templateProcessor->setValue('jenis_kelamin', $jenis_kelamin);
        $templateProcessor->setValue('nama_kelompok', $nama_kelompok);
        $templateProcessor->setValue('sekolah_tujuan', $surat->sekolah_tujuan);
        $templateProcessor->setValue('kecamatan', $surat->kecamatan);
        $templateProcessor->setValue('kabupaten', $surat->kabupaten);
        $templateProcessor->setValue('provinsi', $surat->provinsi);
        $templateProcessor->setValue('alasan', $surat->alasan);
        $templateProcessor->setValue('created_at', $now);
        $filename = 'Surat-Pindah-Sekolah.docx';

        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $filename);
        header('Content-Length: ' . filesize($filepath));

        flush();

        $templateProcessor->saveAs('php://output');
    }
}
