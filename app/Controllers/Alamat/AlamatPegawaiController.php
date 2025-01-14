<?php

namespace App\Controllers\Alamat;

use App\Controllers\BaseController;
use App\Models\Alamat\AlamatPegawaiModel;
use App\Models\User\UserModels;

class AlamatPegawaiController extends BaseController
{
    protected $usersModel;
    protected $identitasModel;
    
        public function __construct()
        {
            $this->usersModel = new UserModels();
            $this->identitasModel = new AlamatPegawaiModel();
    
        }
    
        public function index()
        {
            $data['alamats'] = $this->identitasModel->getAll();
            $data['users'] = $this->usersModel->findAll();
            return view('page/alamat-pegawai/index', $data);
        }
    
        public function form()
        {
            if(is_null($this->request->getPost('id_alamat'))){
                $alamat = new AlamatPegawaiModel();
    
                $alamat->insert([
                    "id_alamat"         => $this->request->getPost('id_alamat'),
                    "nomor_induk"       => $this->request->getPost('nomor_induk'),
                    "alamat_rumah"      => $this->request->getPost('alamat_rumah'),
                    "status_rumah"      => $this->request->getPost('status_rumah'),
                    "nomor_telephone"   => $this->request->getPost('nomor_telephone'),
                    "jarak_kantor"      => $this->request->getPost('jarak_kantor'),
                    "created_at"        => $this->request->getPost('created_at'),
                ]);
    
                return $this->response->setJSON([
                    'status' => true,
                    'message'   => "Identitas berhasil di terdaftar!",
                ]);
            }else{
                    $alamat = new AlamatPegawaiModel();
                    date_default_timezone_set('Asia/Jakarta');
                    
                    $data = [
                        "alamat_rumah"      => $this->request->getPost('alamat_rumah'),
                        "status_rumah"      => $this->request->getPost('status_rumah'),
                        "nomor_telephone"   => $this->request->getPost('nomor_telephone'),
                        "jarak_kantor"      => $this->request->getPost('jarak_kantor'),
                        "updated_at"        => date('Y-m-d H:i:s')
                    ];
    
                    $alamat->where('id_alamat', $this->request->getPost('id_alamat'))->set($data)->update();
    
                    return $this->response->setJSON([
                        'status' => true,
                        'message' => "Alamat berhasil di ubah!",
                    ]);
            }
        }
    
        public function destroy($id_alamat){
            $alamat = new AlamatPegawaiModel();
            date_default_timezone_set('Asia/Jakarta');
    
            $alamat->delete(['id_prestasi' => $id_alamat]);
            
            return $this->response->setJSON([
                'status' => true,
                'message' => "Alamat Berhasil di hapus!",
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
    
            $data = new AlamatPegawaiModel();
            $data->select('*');
            $data->join('users','users.nomor_induk = alamat_pegawai.nomor_induk');
            
            if (!empty($order)) {
                if (!empty($columns[$order['column']]['data'])) $data->orderBy($columns[$order['column']]['data'], $order['dir']);
                else $data->orderBy('alamat_rumah');
            } else {
                $data->orderBy('created_at', 'DESC');
            }
            
            $count = $data->countAllResults(false);
            
            $countFiltered = $count;
            
            
            // Search
            if (!empty($search)) {
                $data->like('alamat_rumah', $search['value']);
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
