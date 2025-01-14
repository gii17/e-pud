<?php

namespace App\Controllers\Teacher;

use App\Controllers\BaseController;
use App\Models\Jadwal\JadwalMengajarModels;

class JadwalMengajarController extends BaseController
{
    public function index()
    {
        return view('page/jadwal-mengajar/index');
    }

    public function form(){
        $hari = $this->request->getPost('hari');
        $teacher_id = $this->request->getPost('teacher_id');
        $jpm = $this->request->getPost('jpm');
        $kelompok_id = $this->request->getPost('kelompok_id');
        $kegiatan_awal = json_encode($this->request->getPost('kegiatan_awal'));
        $kegiatan_inti = json_encode($this->request->getPost('kegiatan_inti'));
        $kegiatan_akhir = json_encode($this->request->getPost('kegiatan_akhir'));

        if(is_null($this->request->getPost('id'))){
            $jadwal = new JadwalMengajarModels();

            $jadwal->insert([
                "hari" => $hari,
                "teacher_id" => $teacher_id,
                "jpm" => $jpm,
                "kelompok_id" => $kelompok_id,
                "kegiatan_awal" => $kegiatan_awal,
                "kegiatan_inti" => $kegiatan_inti,
                "kegiatan_akhir" => $kegiatan_akhir,
            ]);

            return $this->response->setJSON([
                'status' => true,
                'message' => "Jadwal berhasil di buat!",
            ]);
        }else{
                $jadwal = new JadwalMengajarModels();
                date_default_timezone_set('Asia/Jakarta');
                
                $data = [
                    "hari" => $hari,
                    "teacher_id" => $teacher_id,
                    "jpm" => $jpm,
                    "kelompok_id" => $kelompok_id,
                    "kegiatan_awal" => $kegiatan_awal,
                    "kegiatan_inti" => $kegiatan_inti,
                    "kegiatan_akhir" => $kegiatan_akhir,
                    "updated_at" => date('Y-m-d H:i:s')
                ];

                $jadwal->where('id', $this->request->getPost('id'))->set($data)->update();

                return $this->response->setJSON([
                    'status' => true,
                    'message' => "Jadwal berhasil di ubah!",
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

        $model = new JadwalMengajarModels();
        $model->select('hari, users.nama_lengkap AS nama_guru, jadwal_mengajar.teacher_id, users.nomor_induk, kegiatan_awal, jpm, kegiatan_inti, kegiatan_akhir, jadwal_mengajar.kelompok_id, jadwal_mengajar.created_at, nama_kelompok, jadwal_mengajar.id');
        $model->join('users', 'users.user_id = jadwal_mengajar.teacher_id');
        $model->join('kelompok', 'kelompok.kelompok_id = jadwal_mengajar.kelompok_id');
        
        if (!empty($order)) {
            if (!empty($columns[$order['column']]['data'])) $model->orderBy($columns[$order['column']]['data'], $order['dir']);
            else $model->orderBy('hari');
        } else {
            $model->orderBy('created_at', 'DESC');
        }
        
        $count = $model->countAllResults(false);
        
        $countFiltered = $count;
        
        
        // Search
        if (!empty($search)) {
            $model->like('hari', $search['value']);
            $countFiltered = $model->countAllResults(false);
        }

        $model = $model->offset($length)->limit($start);

        $data = $model->get()->getResult();
        
        $result = [];
        foreach ($data as $row) {
            $response_builder = [
                "hari" => $row->hari,
                "nama_guru" => $row->nama_guru,
                "teacher_id" => $row->teacher_id,
                "nomor_induk" => $row->nomor_induk,
                "jpm" => $row->jpm,
                "kegiatan_awal" => json_decode($row->kegiatan_awal),
                "kegiatan_inti" => json_decode($row->kegiatan_inti),
                "kegiatan_akhir" => json_decode($row->kegiatan_akhir),
                "kelompok_id" => $row->kelompok_id,
                "created_at" => $row->created_at,
                "nama_kelompok" => $row->nama_kelompok,
                "id" => $row->id
            ];

            $result[] = $response_builder;
        }
        
        $response = [
            "draw" => intval($this->request->getVar('draw')),
            "recordsTotal" => $count,
            "recordsFiltered" => $countFiltered,
            "limit" => $length,
            "data" => $result
        ];

        return $this->response->setJSON($response);
    }

    public function destroy($id){
        $model = new JadwalMengajarModels();

        date_default_timezone_set('Asia/Jakarta');

        $model->delete(['id' => $id]);

        return $this->response->setJSON([
            'status' => true,
            'message' => "Jadwal Berhasil di hapus!",
        ]);
    }
    public function show($id){
        $model = new JadwalMengajarModels();

        date_default_timezone_set('Asia/Jakarta');

        $model->select("id, hari, jpm, kegiatan_awal, kegiatan_akhir, 
        kegiatan_inti, jadwal_mengajar.teacher_id, 
        jadwal_mengajar.kelompok_id, kelompok.kelompok_id, nama_kelompok, users.user_id, users.nama_lengkap as nama_guru");
        $model->join("kelompok", "kelompok.kelompok_id = jadwal_mengajar.teacher_id");
        $model->join("users", "users.user_id = jadwal_mengajar.teacher_id");
        $model->where("id", $id);
        $data = $model->get()->getRow();

        
        $response = [
            "hari" => $data->hari,
            "id" => $data->id,
            "jpm" => $data->jpm,
            "kegiatan_akhir" => json_decode($data->kegiatan_akhir),
            "kegiatan_awal" => json_decode($data->kegiatan_awal),
            "kegiatan_inti" => json_decode($data->kegiatan_inti),
            "kelompok_id" => $data->kelompok_id,
            "teacher_id" => $data->teacher_id,
            "nama_guru" => $data->nama_guru,
            "nama_kelompok" => $data->nama_kelompok,
        ];

        return $this->response->setJSON([
            'status' => true,
            'message' => "Jadwal Berhasil di hapus!",
            'data' => $response
        ]);
    }
}
