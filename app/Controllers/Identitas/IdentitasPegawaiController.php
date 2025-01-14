<?php

namespace App\Controllers\Identitas;

use App\Controllers\BaseController;
use App\Models\Identitas\IdentitasPegawaiModel;
use App\Models\User\UserModels;

class IdentitasPegawaiController extends BaseController
{
    protected $usersModel;
    protected $identitasModel;

    public function __construct()
    {
        $this->usersModel = new UserModels();
        $this->identitasModel = new IdentitasPegawaiModel();

    }

    public function index()
    {
        $data['identity'] = $this->identitasModel->getAll();
        $data['users'] = $this->usersModel->findAll();
        return view('page/identitas-pegawai/index', $data);
    }

    public function form()
    {
        if(is_null($this->request->getPost('id_identitas'))){
            $identitas = new IdentitasPegawaiModel();

            $identitas->insert([
                "id_identitas"          => $this->request->getPost('id_identitas'),
                "nomor_induk"           => $this->request->getPost('nomor_induk'),
                "jenis_kelamin"         => $this->request->getPost('jenis_kelamin'),
                "tempat_lahir"          => $this->request->getPost('tempat_lahir'),
                "tanggal_lahir"         => $this->request->getPost('tanggal_lahir'),
                "status_kepegawaian"    => $this->request->getPost('status_kepegawaian'),
                "agama"                 => $this->request->getPost('agama'),
                "nip"                   => $this->request->getPost('nip'),
                "created_at"            => $this->request->getPost('created_at'),
            ]);

            return $this->response->setJSON([
                'status' => true,
                'message'   => "Identitas berhasil di terdaftar!",
            ]);
        }else{
                $identitas = new IdentitasPegawaiModel();
                date_default_timezone_set('Asia/Jakarta');
                
                $data = [
                    "id_identitas"          => $this->request->getPost('id_identitas'),
                    "nomor_induk"           => $this->request->getPost('nomor_induk'),
                    "jenis_kelamin"         => $this->request->getPost('jenis_kelamin'),
                    "tempat_lahir"          => $this->request->getPost('tempat_lahir'),
                    "tanggal_lahir"         => $this->request->getPost('tanggal_lahir'),
                    "status_kepegawaian"    => $this->request->getPost('status_kepegawaian'),
                    "agama"                 => $this->request->getPost('agama'),
                    "nip"                   => $this->request->getPost('nip'),
                    "provinsi"              => $this->request->getPost('provinsi'),
                    "updated_at" => date('Y-m-d H:i:s')
                ];

                $identitas->where('id_identitas', $this->request->getPost('id_identitas'))->set($data)->update();

                return $this->response->setJSON([
                    'status' => true,
                    'message' => "Identitas berhasil di ubah!",
                ]);
        }
    }

    public function destroy($id_identitas){
        $identitas = new IdentitasPegawaiModel();
        date_default_timezone_set('Asia/Jakarta');

        $identitas->delete(['id_prestasi' => $id_identitas]);
        
        return $this->response->setJSON([
            'status' => true,
            'message' => "Identitas Berhasil di hapus!",
        ]);
    }

    public function getJSON(){

        $length = intval($this->request->getVar('length')) ?? 15;
        $start = intval($this->request->getVar('start')) ?? 0;
        $search = $this->request->getVar('search');
        $columns = $this->request->getVar('columns');
        $status = $this->request->getVar('status');

        $order = $this->request->getVar('order');
        if ($order) $order = $order[0];

        $data = new IdentitasPegawaiModel();
        $data->select('*');
        $data->join('users','users.nomor_induk = identitas_pegawai.nomor_induk');
        
        if (!empty($order)) {
            if (!empty($columns[$order['column']]['data'])) $data->orderBy($columns[$order['column']]['data'], $order['dir']);
            else $data->orderBy('status_kepegawaian');
        } else {
            $data->orderBy('created_at', 'DESC');
        }
        
        $count = $data->countAllResults(false);
        
        $countFiltered = $count;
        
        
        // Search
        if (!empty($search)) {
            $data->like('status_kepegawaian', $search['value']);
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
}
