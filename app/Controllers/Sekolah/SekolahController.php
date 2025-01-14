<?php

namespace App\Controllers\Sekolah;

use App\Controllers\BaseController;
use App\Models\Sekolah\SekolahModels;

class SekolahController extends BaseController
{
    public function index()
    {
        $sekolah = new SekolahModels();
        $data['schools'] = $sekolah->findAll();
        return view('page/sekolah/index', $data);
    }

    public function form()
    {
        if(is_null($this->request->getPost('id_sekolah'))){
            $sekolah = new SekolahModels();

            $sekolah->insert([
                "nama_sekolah"      => $this->request->getPost('nama_sekolah'),
                "status_sekolah"    => $this->request->getPost('status_sekolah'),
                "nomor_statistik"   => $this->request->getPost('nomor_statistik'),
                "kelurahan"         => $this->request->getPost('kelurahan'),
                "kecamatan"         => $this->request->getPost('kecamatan'),
                "kota"              => $this->request->getPost('kota'),
                "provinsi"          => $this->request->getPost('provinsi'),
                "created_at"        => $this->request->getPost('created_at'),
            ]);

            return $this->response->setJSON([
                'status' => true,
                'message'   => "Sekolah berhasil di terdaftar!",
            ]);
        }else{
                $sekolah = new SekolahModels();
                date_default_timezone_set('Asia/Jakarta');
                
                $data = [
                    "nama_sekolah"      => $this->request->getPost('nama_sekolah'),
                    "status_sekolah"    => $this->request->getPost('status_sekolah'),
                    "nomor_statistik"   => $this->request->getPost('nomor_statistik'),
                    "kelurahan"         => $this->request->getPost('kelurahan'),
                    "kecamatan"         => $this->request->getPost('kecamatan'),
                    "kota"              => $this->request->getPost('kota'),
                    "provinsi"          => $this->request->getPost('provinsi'),
                    "updated_at" => date('Y-m-d H:i:s')
                ];

                $sekolah->where('id_sekolah', $this->request->getPost('id_sekolah'))->set($data)->update();

                return $this->response->setJSON([
                    'status' => true,
                    'message' => "Sekolah berhasil di ubah!",
                ]);
        }
    }

    public function destroy($id_sekolah){
        $sekolah = new SekolahModels();
        date_default_timezone_set('Asia/Jakarta');

        $sekolah->delete(['id_prestasi' => $id_sekolah]);
        
        return $this->response->setJSON([
            'status' => true,
            'message' => "Sekolah Berhasil di hapus!",
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

        $data = new SekolahModels();
        $data->select('*');
        
        if (!empty($order)) {
            if (!empty($columns[$order['column']]['data'])) $data->orderBy($columns[$order['column']]['data'], $order['dir']);
            else $data->orderBy('nama_sekolah');
        } else {
            $data->orderBy('created_at', 'DESC');
        }
        
        $count = $data->countAllResults(false);
        
        $countFiltered = $count;
        
        
        // Search
        if (!empty($search)) {
            $data->like('nama_sekolah', $search['value']);
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
