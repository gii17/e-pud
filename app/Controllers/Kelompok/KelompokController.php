<?php

namespace App\Controllers\Kelompok;

use App\Controllers\BaseController;
use App\Models\User\UserModels;
use App\Models\Kelompok\KelompokModels;

class KelompokController extends BaseController
{
    public function index()
    {

        $kelompok = new KelompokModels();
        $kelompok->select('users.nama_lengkap AS nama_guru, teacher_id, users.nomor_induk, nama_kelompok, kelompok_id');
        $kelompok->join('users', 'users.user_id = kelompok.teacher_id');
        $result = $kelompok->get()->getResult();

        $response = [];
        foreach ($result as $row) {
            $kelompokData = [
                'kelompok_id' => $row->kelompok_id,
                'nama_kelompok' => $row->nama_kelompok,
                'nama_guru' => $row->nama_guru,
                'nomor_induk' => $row->nomor_induk,
                'teacher_id' => $row->teacher_id,
                'list_student' => [],
            ];
            
            $students = $kelompok->select('user_id, nama_lengkap, jenis_kelamin, photo, nomor_induk, tempat_lahir, tanggal_lahir, tahun_masuk')
                ->join('users', 'users.id_kelompok = kelompok.kelompok_id')
                ->where('kelompok.kelompok_id', $row->kelompok_id)
                ->get()
                ->getResult();

            foreach ($students as $student) {
                $kelompokData['list_student'][] = [
                    'user_id' => $student->user_id,
                    'nama_lengkap' => $student->nama_lengkap,
                    'jenis_kelamin' => $student->jenis_kelamin,
                    'nomor_induk' => $student->nomor_induk,
                    'tempat_lahir' => $student->tempat_lahir,
                    'photo' => $student->photo,
                    'tanggal_lahir' => $student->tanggal_lahir,
                    'tahun_masuk' => $student->tahun_masuk,
                ];
            }

            $response[] = $kelompokData;
        }

        return view('page/kelompok/index', ['list_kelompok' => $response]);
        // return $this->response->setJSON($response);
    }

    public function removeStudent($student_id, $kelompok_id){
        $kelompok = new KelompokModels();
        date_default_timezone_set('Asia/Jakarta');

        $student = new UserModels();

        $student->where('user_id', $student_id)->set([
            "id_kelompok" => null,
            "updated_at" => date('Y-m-d H:i:s')
        ])->update();


        $kelompok->where('kelompok_id', $kelompok_id)->set([
            "updated_at" => date('Y-m-d H:i:s')
        ])->update();

        return $this->response->setJSON([
            'status' => true,
            'message' => "Siswa berhasil di keluarkan dari kelompok!",
        ]);
    }

    public function destroy($kelompok_id){
        $kelompok = new KelompokModels();

        date_default_timezone_set('Asia/Jakarta');

        $student = new UserModels();

        //remove all student from the class
        $student->where('id_kelompok', $kelompok_id)->set([
            "id_kelompok" => null,
            "updated_at" => date('Y-m-d H:i:s')
        ])->update();

        $kelompok->delete(['kelompok_id' => $kelompok_id]);

        return $this->response->setJSON([
            'status' => true,
            'message' => "Kelompok Berhasil di hapus!",
        ]);
    }


    public function form(){

        if(is_null($this->request->getPost('id'))){
            $kelompok = new KelompokModels();

            $kelompok->insert([
                "nama_kelompok" => $this->request->getPost('nama_kelompok'),
                "teacher_id" => $this->request->getPost('teacher_id'),
            ]);

            return $this->response->setJSON([
                'status' => true,
                'message' => "Kelompok Baru berhasil di buat!",
            ]);
        }else{
                $kelompok = new KelompokModels();
                date_default_timezone_set('Asia/Jakarta');

                $student_id = $this->request->getPost('student_id');
                $kelompok_id = $this->request->getPost('id');

                if(!is_null($student_id)){


                    $student = new UserModels();

                    $student->where('user_id', $student_id)->set([
                        "id_kelompok" => $kelompok_id,
                        "updated_at" => date('Y-m-d H:i:s')
                    ])->update();
                    
                }
                
                $data = [
                    "nama_kelompok" => $this->request->getPost('nama_kelompok'),
                    "teacher_id" => $this->request->getPost('teacher_id'),
                    "updated_at" => date('Y-m-d H:i:s')
                ];

                $kelompok->where('kelompok_id', $kelompok_id)->set($data)->update();
                
                return $this->response->setJSON([
                    'status' => true,
                    'message' => "Kelompok berhasil di ubah!",
                ]);
        }

    }
}
