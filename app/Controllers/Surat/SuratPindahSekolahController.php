<?php

namespace App\Controllers\Surat;

use App\Controllers\BaseController;
use App\Models\Surat\SuratPindahSekolahModels;
use App\Models\User\UserModels;
use App\Models\Kelompok\KelompokModels;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Shared\ZipArchive;

class SuratPindahSekolahController extends BaseController
{
    public function index()
    {
        $surat = new SuratPindahSekolahModels();
        $surat->where('student_id', session()->get('user_id'));
        $data = $surat->get()->getRow();

        return view('page/surat-pindah-sekolah/index', compact('data'));
    }

    public function store(){
        $surat = new SuratPindahSekolahModels();


        $surat->insert([
            "nama_orang_tua" => $this->request->getPost('nama_orang_tua'),
            "pekerjaan" => $this->request->getPost('pekerjaan'),
            "alamat" => $this->request->getPost('alamat'),
            "student_id" => session()->get('user_id'),
            "sekolah_tujuan" => $this->request->getPost('sekolah_tujuan'),
            "kecamatan" => $this->request->getPost('kecamatan'),
            "kabupaten" => $this->request->getPost('kabupaten'),
            "provinsi" => $this->request->getPost('provinsi'),
            "alasan" => $this->request->getPost('alasan'),
        ]);

        return $this->response->setJSON([
            'status' => true,
            'message' => "Surat Berhasil Di Ajukan!",
        ]);
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
