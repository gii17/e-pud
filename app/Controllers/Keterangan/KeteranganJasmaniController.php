<?php

namespace App\Controllers\Keterangan;

use App\Controllers\BaseController;
use App\Models\Keterangan\KeteranganJasmaniModel;
use App\Models\User\UserModels;

class KeteranganJasmaniController extends BaseController
{
    protected $usersModel;
    protected $jasmaniModel;

    public function __construct()
    {
        $this->usersModel = new UserModels();
        $this->jasmaniModel = new KeteranganJasmaniModel();

    }

    public function index()
    {
        $data['jasmanis'] = $this->jasmaniModel->getAll();
        $data['users'] = $this->usersModel->findAll();
        return view('page/jasmani-pegawai/index', $data);
    }

    public function form()
    {
        if(is_null($this->request->getPost('id_jasmani'))){
            $jasmani = new KeteranganJasmaniModel();

            $jasmani->insert([
                "id_jasmani"          => $this->request->getPost('id_jasmani'),
                "nomor_induk"         => $this->request->getPost('nomor_induk'),
                "berat_badan"         => $this->request->getPost('berat_badan'),
                "tinggi_badan"        => $this->request->getPost('tinggi_badan'),
                "golongan_darah"      => $this->request->getPost('golongan_darah'),
                "riwayat_penyakit"    => $this->request->getPost('riwayat_penyakit'),
                "created_at"          => $this->request->getPost('created_at'),
            ]);

            return $this->response->setJSON([
                'status' => true,
                'message'   => "Jasmani berhasil di terdaftar!",
            ]);
        }else{
                $jasmani = new KeteranganJasmaniModel();
                date_default_timezone_set('Asia/Jakarta');
                
                $data = [
                    "id_jasmani"          => $this->request->getPost('id_jasmani'),
                    "nomor_induk"         => $this->request->getPost('nomor_induk'),
                    "berat_badan"         => $this->request->getPost('berat_badan'),
                    "tinggi_badan"        => $this->request->getPost('tinggi_badan'),
                    "golongan_darah"      => $this->request->getPost('golongan_darah'),
                    "riwayat_penyakit"    => $this->request->getPost('riwayat_penyakit'),
                    "created_at"          => $this->request->getPost('created_at'),
                    "updated_at" => date('Y-m-d H:i:s')
                ];

                $jasmani->where('id_jasmani', $this->request->getPost('id_jasmani'))->set($data)->update();

                return $this->response->setJSON([
                    'status' => true,
                    'message' => "Jasmani berhasil di ubah!",
                ]);
        }
    }

    public function destroy($id_jasmani){
        $jasmani = new KeteranganJasmaniModel();
        date_default_timezone_set('Asia/Jakarta');

        $jasmani->delete(['id_jasmani' => $id_jasmani]);
        
        return $this->response->setJSON([
            'status' => true,
            'message' => "Jasmani Berhasil di hapus!",
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

        $data = new KeteranganJasmaniModel();
        $data->select('*');
        $data->join('users','users.nomor_induk = keterangan_jasmani.nomor_induk');
        
        if (!empty($order)) {
            if (!empty($columns[$order['column']]['data'])) $data->orderBy($columns[$order['column']]['data'], $order['dir']);
        } else {
            $data->orderBy('created_at', 'DESC');
        }
        
        $count = $data->countAllResults(false);
        
        $countFiltered = $count;
        
        
        // Search
        if (!empty($search)) {
            $data->like('riwayat_penyakit', $search['value']);
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
