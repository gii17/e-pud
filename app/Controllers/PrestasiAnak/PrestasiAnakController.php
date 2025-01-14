<?php

namespace App\Controllers\PrestasiAnak;

use App\Controllers\BaseController;
use App\Database\Migrations\CreateUsers;
use App\Database\Migrations\PrestasiAnak;
use App\Models\PrestasiAnak\PrestasiAnakModels;
use App\Models\Sekolah\SekolahModels;
use App\Models\User\UserModels;

class PrestasiAnakController extends BaseController
{

    protected $usersModel;
    protected $prestasiModel;

    public function __construct()
    {
        $this->prestasiModel = new PrestasiAnakModels();
        $this->usersModel = new UserModels();
    }

    public function index()
    {
        $data['prestasis'] = $this->prestasiModel->getAll();
        $data['users'] = $this->usersModel->findAll();
        return view('page/prestasi-anak/index', $data);
    }

    public function form()
    {
        if(is_null($this->request->getPost('id_prestasi'))){
            $prestasi = new PrestasiAnakModels();

            $prestasi->insert([
                "id_prestasi"       => $this->request->getPost('id_prestasi'),
                "nomor_induk"       => $this->request->getPost('nomor_induk'),
                "nama_kegiatan"     => $this->request->getPost('nama_kegiatan'),
                "tanggal_kegiatan"  => $this->request->getPost('tanggal_kegiatan'),
                "lokasi_kegiatan"   => $this->request->getPost('lokasi_kegiatan'),
                "prestasi"          => $this->request->getPost('prestasi'),
                "reward"            => $this->request->getPost('reward'),
                "created_at"        => $this->request->getPost('created_at'),
            ]);

            return $this->response->setJSON([
                'status' => true,
                'message'   => "Prestasi berhasil di terdaftar!",
            ]);
        }else{
                $prestasi = new PrestasiAnakModels();
                date_default_timezone_set('Asia/Jakarta');
                
                $data = [
                    "nomor_induk"       => $this->request->getPost('nomor_induk'),
                    "nama_kegiatan"     => $this->request->getPost('nama_kegiatan'),
                    "tanggal_kegiatan"  => $this->request->getPost('tanggal_kegiatan'),
                    "lokasi_kegiatan"   => $this->request->getPost('lokasi_kegiatan'),
                    "prestasi"          => $this->request->getPost('prestasi'),
                    "reward"            => $this->request->getPost('reward'),
                    "updated_at" => date('Y-m-d H:i:s')
                ];

                $prestasi->where('id_prestasi', $this->request->getPost('id_prestasi'))->set($data)->update();

                return $this->response->setJSON([
                    'status' => true,
                    'message' => "Prestasi berhasil di ubah!",
                ]);
        }
    }

    public function getJSON(){

        $length = intval($this->request->getVar('length')) ?? 15;
        $start = intval($this->request->getVar('start')) ?? 0;
        $search = $this->request->getVar('search');
        $columns = $this->request->getVar('columns');
        $status = $this->request->getVar('status');

        $order = $this->request->getVar('order');
        if ($order) $order = $order[0];

        $data = new PrestasiAnakModels();
        $data->select('*');
        $data->join('users','users.nomor_induk = prestasi_anak.nomor_induk');
        
        if (!empty($order)) {
            if (!empty($columns[$order['column']]['data'])) $data->orderBy($columns[$order['column']]['data'], $order['dir']);
            else $data->orderBy('nama_kegiatan');
        } else {
            $data->orderBy('created_at', 'DESC');
        }
        
        // foreach($data as $item)
        // {
        //     $item['user']= $this->usersModel->where('nomor_induk',$item['nomor_induk'])->first();
        // }
        $count = $data->countAllResults(false);
        
        $countFiltered = $count;
        
        
        // Search
        if (!empty($search)) {
            $data->like('nama_kegiatan', $search['value']);
            $countFiltered = $data->countAllResults(false);
        }


        $data = $data->offset($length)->limit($start);
        
        $response = [
            "draw" => intval($this->request->getVar('draw')),
            "recordsTotal" => $count,
            "recordsFiltered" => $countFiltered,
            "limit" => $length,
            "data" => $data->get()->getResult()
        ];

        return $this->response->setJSON($response);
    }

    public function destroy($id_prestasi){
        $prestasi = new PrestasiAnakModels();
        date_default_timezone_set('Asia/Jakarta');

        $prestasi->delete(['id_prestasi' => $id_prestasi]);
        
        return $this->response->setJSON([
            'status' => true,
            'message' => "Kelompok Berhasil di hapus!",
        ]);
    }

    public function generateWord($id){
        helper('text');
        $filepath = WRITEPATH . 'uploads/template/template_surat_permohonan_pindah_sekolah.docx';

        $prestasi = new PrestasiAnakModels();
        $prestasi->select('*')->where('id_prestasi', session()->get('id_prestasi'));
        $prestasi = $prestasi->get()->getRow();

        if(!is_null($prestasi->id_prestasi)){
            $kelompok = new CreateUsers();
            $kelompok->select('nama_lengkap')
            ->where('kelompok_id', $sekolah->id_student);
            $nama_kelompok = $kelompok->get()->getRow()->nama_kelompok ?? '-';
        }

        $model = new PrestasiAnakModels();
        $model->where('PrestasiAnakModels', $id);
        $catatan = $model->get()->getRow();

        $timestamp = strtotime(date('Y-m-d H:i:s'));
        $now = date('d-m-Y', $timestamp);

        $templateProcessor = new TemplateProcessor($filepath);

        $templateProcessor->setValue('nama_orang_tua', $catatan->nama_orang_tua);
        $templateProcessor->setValue('pekerjaan', $catatan->pekerjaan);
        $templateProcessor->setValue('alamat', $catatan->alamat);
        $templateProcessor->setValue('nama_siswa', $student->nama_siswa);
        $templateProcessor->setValue('tempat_lahir', $student->tempat_lahir);
        $templateProcessor->setValue('tanggal_lahir', $student->tanggal_lahir);
        $templateProcessor->setValue('nomor_induk', $student->nomor_induk);
        $templateProcessor->setValue('jenis_kelamin', $jenis_kelamin);
        $templateProcessor->setValue('nama_kelompok', $nama_kelompok);
        $templateProcessor->setValue('sekolah_tujuan', $catatan->sekolah_tujuan);
        $templateProcessor->setValue('kecamatan', $catatan->kecamatan);
        $templateProcessor->setValue('kabupaten', $catatan->kabupaten);
        $templateProcessor->setValue('provinsi', $catatan->provinsi);
        $templateProcessor->setValue('alasan', $catatan->alasan);
        $templateProcessor->setValue('created_at', $now);
        $filename = 'Surat-Pindah-Sekolah.docx';

        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $filename);
        header('Content-Length: ' . filesize($filepath));

        flush();

        $templateProcessor->saveAs('php://output');
    }
}
