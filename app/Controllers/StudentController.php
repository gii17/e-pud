<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User\UserModels;

class StudentController extends BaseController
{
    public function index()
    {
        
        return view('page/student/index');
    }

    public function form(){

        if(is_null($this->request->getPost('id'))){
            $user = new UserModels();

            $user->insert([
                "nama_lengkap" => $this->request->getPost('nama_lengkap'),
                "nomor_induk" => $this->request->getPost('nomor_induk'),
                "password" => password_hash('epaud2024100%', PASSWORD_BCRYPT),
                "jenis_kelamin" => $this->request->getPost('jenis_kelamin'),
                "tempat_lahir" => $this->request->getPost('tempat_lahir'),
                "tanggal_lahir" => $this->request->getPost('tanggal_lahir'),
                "tahun_masuk" => $this->request->getPost('tahun_masuk'),
                "photo" => base_url('assets/img/avatar.png'),
                "type_user" => "is_student",
            ]);

            return $this->response->setJSON([
                'status' => true,
                'message' => "Siswa berhasil di terdaftar!",
            ]);
        }else{
                $user = new UserModels();
                date_default_timezone_set('Asia/Jakarta');
                
                $data = [
                    "nama_lengkap" => $this->request->getPost('nama_lengkap'),
                    "nomor_induk" => $this->request->getPost('nomor_induk'),
                    "jenis_kelamin" => $this->request->getPost('jenis_kelamin'),
                    "tempat_lahir" => $this->request->getPost('tempat_lahir'),
                    "tanggal_lahir" => $this->request->getPost('tanggal_lahir'),
                    "tahun_masuk" => $this->request->getPost('tahun_masuk'),
                    "updated_at" => date('Y-m-d H:i:s')
                ];

                $user->where('user_id', $this->request->getPost('id'))->set($data)->update();

                return $this->response->setJSON([
                    'status' => true,
                    'message' => "Siswa berhasil di ubah!",
                ]);
        }

    }

    public function getListUser(){

        $length = intval($this->request->getVar('length')) ?? 15;
        $start = intval($this->request->getVar('start')) ?? 0;
        $search = $this->request->getVar('search');
        $columns = $this->request->getVar('columns');
        $status = $this->request->getVar('status');

        $order = $this->request->getVar('order');
        if ($order) $order = $order[0];

        $data = new UserModels();
        $data->where('type_user', 'is_student');
        
        if (!empty($order)) {
            if (!empty($columns[$order['column']]['data'])) $data->orderBy($columns[$order['column']]['data'], $order['dir']);
            else $data->orderBy('nama_lengkap');
        } else {
            $data->orderBy('created_at', 'DESC');
        }
        
        $count = $data->countAllResults(false);
        
        $countFiltered = $count;
        
        
        // Search
        if (!empty($search)) {
            $data->like('nama_lengkap', $search['value']);
            
            // $data->orLike('nomor_induk', $search['value']);
            // $data->orLike('tempat_lahir', $search['value']);
            // $data->orLike('tanggal_lahir', $search['value']);
            
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
