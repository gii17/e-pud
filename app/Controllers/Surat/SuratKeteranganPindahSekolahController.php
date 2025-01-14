<?php

namespace App\Controllers\Surat;

use App\Controllers\BaseController;
use App\Models\Kelompok\KelompokModels;
use App\Models\Surat\SuratKeteranganPindahSekolahModel;
use App\Models\Surat\SuratPindahSekolahModels;
use App\Models\User\UserModels;
use PhpOffice\PhpWord\TemplateProcessor;

class SuratKeteranganPindahSekolahController extends BaseController
{

    public function index()
    { // Mendapatkan data dari SuratPindahSekolahModels
        $suratKeteranganModel = new SuratKeteranganPindahSekolahModel();
        $suratPindahSekolahModel = new SuratPindahSekolahModels();
        $data['suratPindah'] = $suratPindahSekolahModel->findAll();

        // Menambahkan field 'status' ke setiap data
        foreach ($data['suratPindah'] as &$item) {
            // Mengecek apakah terdapat relasi di SuratKeteranganPindahSekolahModel
            $suratKeteranganModel = new SuratKeteranganPindahSekolahModel();
            $relasiExists = $suratKeteranganModel
                    ->where('surat_id', $item['id_surat'])
                    ->countAllResults() > 0;
            $item['id_surat_keterangan'] = '';
            if ($relasiExists) {
                $suratKeterangan = $suratKeteranganModel->first($item['id_surat']);
                $item['id_surat_keterangan'] = $suratKeterangan->id;
            }

            // Menambahkan field 'status' ke data
            $item['status'] = $relasiExists ? 1 : 0;
            $studentModel = new UserModels();
            $studentData = $studentModel->find($item['student_id']);

            // Menambahkan field 'nama_student' ke data
            $item['nama_siswa'] = $studentData['nama_lengkap'];

        }
        return view('page/surat-keterangan-pindah-sekolah/index', $data);
    }

    public function getData($suratId)
    {

        $suratPindahSekolahModel = new SuratPindahSekolahModels();
        $suratPindah = $suratPindahSekolahModel->find($suratId);
        $suratKeteranganModel = new SuratKeteranganPindahSekolahModel();
        $relasiExists = $suratKeteranganModel
                ->where('surat_id', $suratPindah['id_surat'])
                ->countAllResults() > 0;

        $suratPindah['status'] = $relasiExists ? 1 : 0;
        $studentModel = new UserModels();
        $studentData = $studentModel->find($suratPindah['student_id']);
        $suratPindah['id_surat_keterangan'] = '';
        if ($relasiExists) {
            $suratKeterangan = $suratKeteranganModel->first($suratPindah['id_surat']);
            $suratPindah['id_surat_keterangan'] = $suratKeterangan->id;
        }

        // Menambahkan field 'nama_student' ke data
        $suratPindah['nama_siswa'] = $studentData['nama_lengkap'];
        $suratPindah['nomor_induk'] = $studentData['nomor_induk'];
        $suratPindah['jenis_kelamin'] = strtolower($studentData['jenis_kelamin']) === 'l' ? 'Laki-laki' : 'Perempuan';
        $suratPindah['tempat_lahir'] = $studentData['tempat_lahir'];
        $suratPindah['tanggal_lahir'] = $studentData['tanggal_lahir'];

        $kelompokModel = new KelompokModels();
        $kelompok = $kelompokModel->first($studentData['id_kelompok']);
        $suratPindah['id_kelompok'] = $kelompok['kelompok_id'];
        $suratPindah['nama_kelompok'] = $kelompok['nama_kelompok'];

        return $this->response->setJSON([
            'message' => 'Get surat pindah sekolah berhasil',
            'data' => $suratPindah
        ]);

    }

    public function getDataDetail($suratId)
    {
        $suratKeteranganModel = new SuratKeteranganPindahSekolahModel();
        $surat = $suratKeteranganModel->where('surat_id', $suratId)->first();

        $suratPindahSekolahModel = new SuratPindahSekolahModels();
        $suratPindah = $suratPindahSekolahModel->first($suratId);


        $relasiExists = $suratKeteranganModel
                ->where('surat_id', $suratPindah['id_surat'])
                ->countAllResults() > 0;

        $suratPindah['status'] = $relasiExists ? 1 : 0;
        $studentModel = new UserModels();
        $studentData = $studentModel->find($suratPindah['student_id']);
        $suratPindah['id_surat_keterangan'] = '';
        if ($relasiExists) {
            $suratKeterangan = $suratKeteranganModel->first($suratPindah['id_surat']);
            $suratPindah['id_surat_keterangan'] = $suratKeterangan->id;
        }

        // Menambahkan field 'nama_student' ke data
        $suratPindah['nama_siswa'] = $studentData['nama_lengkap'];
        $suratPindah['nomor_induk'] = $studentData['nomor_induk'];
        $suratPindah['jenis_kelamin'] = strtolower($studentData['jenis_kelamin']) === 'l' ? 'Laki-laki' : 'Perempuan';
        $suratPindah['tempat_lahir'] = $studentData['tempat_lahir'];
        $suratPindah['tanggal_lahir'] = $studentData['tanggal_lahir'];

        $kelompokModel = new KelompokModels();
        $kelompok = $kelompokModel->first($studentData['id_kelompok']);
        $surat->id_kelompok = $kelompok['kelompok_id'];
        $surat->nama_kelompok = $kelompok['nama_kelompok'];

        $surat->suratPindah = $suratPindah;


        return $this->response->setJSON([
            'message' => 'Get surat pindah sekolah berhasil',
            'data' => $surat
        ]);

    }

    public function store($suratId)
    {
        $nama_kb = $this->request->getPost('nama_kb');
        $status_sekolah = $this->request->getPost('status_sekolah');
        $alamat_sekolah = $this->request->getPost('alamat_sekolah');
        $provinsi = $this->request->getPost('provinsi');
        $kota = $this->request->getPost('kota');
        $kecamatan = $this->request->getPost('kecamatan');
        $kelurahan = $this->request->getPost('kelurahan');
        $tanggal_diterima = $this->request->getPost('tanggal_diterima');
        $kelompokId = $this->request->getPost('kelompok_id');
        $suratKeteranganPindah = new SuratKeteranganPindahSekolahModel();
        $suratKeteranganPindah->insert([
            'nama_kb' => $nama_kb,
            'status_sekolah' => $status_sekolah,
            'alamat_sekolah' => $alamat_sekolah,
            'provinsi' => $provinsi,
            'kota' => $kota,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan,
            'tanggal_diterima' => $tanggal_diterima,
            'kelompok_id' => $kelompokId,
            'surat_id' => $suratId
        ]);


        return $this->response->setJSON([
            'status' => true,
            'message' => "Surat Keterangan Pindah Sekolah Berhasil Di Buat!",
        ]);

    }

    public function update($suratId)
    {

        $nama_kb = $this->request->getPost('nama_kb');
        $status_sekolah = $this->request->getPost('status_sekolah');
        $alamat_sekolah = $this->request->getPost('alamat_sekolah');
        $provinsi = $this->request->getPost('provinsi');
        $kota = $this->request->getPost('kota');
        $kecamatan = $this->request->getPost('kecamatan');
        $kelurahan = $this->request->getPost('kelurahan');
        $tanggal_diterima = $this->request->getPost('tanggal_diterima');
        $kelompokId = $this->request->getPost('kelompok_id');
        $suratKeteranganPindah = new SuratKeteranganPindahSekolahModel();
        $suratKeteranganPindah->update($suratId,[
            'nama_kb' => $nama_kb,
            'status_sekolah' => $status_sekolah,
            'alamat_sekolah' => $alamat_sekolah,
            'provinsi' => $provinsi,
            'kota' => $kota,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan,
            'tanggal_diterima' => $tanggal_diterima,
        ]);


        return $this->response->setJSON([
            'status' => true,
            'message' => "Surat Keterangan Pindah Sekolah Berhasil Di Ubah!",
        ]);

    }

    public function delete($suratId)
    {
        $suratKeteranganPindahModel = new SuratKeteranganPindahSekolahModel();
        $suratKeteranganPindahModel->delete($suratId);
        return $this->response->setJSON([
            'status' => true,
            'message' => "Status Surat Permohonan Pindah Sekolah Berhasil Di Ubah!",
        ]);
    }


    public function download($suratId)
    {
        helper('text');
        $suratKeteranganModel = new SuratKeteranganPindahSekolahModel();
        $surat = $suratKeteranganModel->first($suratId);

        $suratPindahSekolahModel = new SuratPindahSekolahModels();
        $suratPindah = $suratPindahSekolahModel->first($suratId);

        $studentModel = new UserModels();
        $studentData = $studentModel->where('user_id',$suratPindah['student_id'])->first();
        $suratPindah['jenis_kelamin'] = strtolower($studentData['jenis_kelamin']) === 'l' ? 'Laki-laki' : 'Perempuan';
        // Menambahkan field 'nama_student' ke data
//        $suratPindah['nama_siswa'] = $studentData['nama_lengkap'];
//        $suratPindah['nomor_induk'] = $studentData['nomor_induk'];
//        $suratPindah['jenis_kelamin'] = strtolower($studentData['jenis_kelamin']) === 'l' ? 'Laki-laki' : 'Perempuan';
//        $suratPindah['tempat_lahir'] = $studentData['tempat_lahir'];
//        $suratPindah['tanggal_lahir'] = $studentData['tanggal_lahir'];

        $kelompokModel = new KelompokModels();
        $kelompok = $kelompokModel->first($studentData['id_kelompok']);
//        $surat->id_kelompok = $kelompok['kelompok_id'];
//        $surat->nama_kelompok = $kelompok['nama_kelompok'];

//        $surat->suratPindah = $suratPindah;
//        dd($surat,$kelompok,$studentData,$suratPindah);
        $filepath = WRITEPATH . 'uploads/template/template_surat_keterangan_pindah_sekolah.docx';


        $timestamp = strtotime(date('Y-m-d H:i:s'));
        $now = date('d M Y', $timestamp);


        $templateProcessor = new TemplateProcessor($filepath);

        $templateProcessor->setValue('nama_orang_tua', $suratPindah['nama_orang_tua']);
        $templateProcessor->setValue('tempat_tanggal_lahir', $studentData['tempat_lahir'] . ', ' . date("d M Y", strtotime($studentData['tanggal_lahir'])));
        $templateProcessor->setValue('pekerjaan', $suratPindah['pekerjaan']);
        $templateProcessor->setValue('alamat', $suratPindah['alamat']);
        $templateProcessor->setValue('nama_siswa', $studentData['nama_lengkap']);
        $templateProcessor->setValue('nomor_induk', $studentData['nomor_induk']);
        $templateProcessor->setValue('jenis_kelamin', $suratPindah['jenis_kelamin']);
        $templateProcessor->setValue('alasan', $suratPindah['alasan']);
        $templateProcessor->setValue('nama_kelompok', $kelompok['nama_kelompok']);
        $templateProcessor->setValue('created_at_surat_pindah', date("d M Y", strtotime($suratPindah['created_at'])));
        $templateProcessor->setValue('kota', $surat->kota);
        $templateProcessor->setValue('date_now', $now);
        $templateProcessor->setValue('nama_kb', $surat->nama_kb);
        $templateProcessor->setValue('status_sekolah', $surat->status_sekolah);
        $templateProcessor->setValue('alamat_sekolah', $surat->alamat_sekolah);
        $templateProcessor->setValue('kelurahan', $surat->kelurahan);
        $templateProcessor->setValue('kecamatan', $surat->kecamatan);
        $templateProcessor->setValue('provinsi', $surat->provinsi);
        $templateProcessor->setValue('tanggal_diterima',date("d M Y", strtotime($surat->tanggal_diterima)));

        $filename = 'Surat-Keterangan-Pindah-Sekolah.docx';

        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $filename);
        header('Content-Length: ' . filesize($filepath));

        flush();

        $templateProcessor->saveAs('php://output');
    }
}