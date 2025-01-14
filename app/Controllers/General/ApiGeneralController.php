<?php

namespace App\Controllers\General;

use App\Controllers\BaseController;
use App\Models\User\UserModels;
use App\Models\Kelompok\KelompokModels;

class ApiGeneralController extends BaseController
{
    public function getListTeacher(){
        $page = intval($this->request->getVar('page'));
        $search = $this->request->getVar('term');
        $resultCount = 10;
        $offset = ($page - 1) * $resultCount;

        $teacher = new UserModels();
        $teacher->select("user_id as id, nama_lengkap as text")->where('type_user', 'is_teacher');

        // Search
        if (!empty($search)) {
            $teacher->like('nama_lengkap', $search);
        }

        $teacher = $teacher->offset($offset)->limit($resultCount);


        $count = $teacher->countAllResults(false);

        //total data yang sudah di load
        $endCount = $offset + $resultCount;

        //cek apakah masih ada data yang belum di load di db
        $morePages = $endCount < $count;

        $results = array(
        "results" => $teacher->get()->getResult(),
        "pagination" => array(
            "more" => $morePages
        )
        );

        return $this->response->setJSON($results);
    }

    public function getListStudent(){

        $page = intval($this->request->getVar('page'));
        $search = $this->request->getVar('term');
        $resultCount = 10;
        $offset = ($page - 1) * $resultCount;

        $teacher = new UserModels();
        $teacher->select("user_id as id, nama_lengkap as text")->where('type_user', 'is_student');

        // Search
        if (!empty($search)) {
            $teacher->like('nama_lengkap', $search);
        }

        $teacher = $teacher->offset($offset)->limit($resultCount);


        $count = $teacher->countAllResults(false);

        //total data yang sudah di load
        $endCount = $offset + $resultCount;

        //cek apakah masih ada data yang belum di load di db
        $morePages = $endCount < $count;

        $results = array(
        "results" => $teacher->get()->getResult(),
        "pagination" => array(
            "more" => $morePages
        )
        );

        return $this->response->setJSON($results);
    }

    public function getListClass(){

        $page = intval($this->request->getVar('page'));
        $search = $this->request->getVar('term');
        $resultCount = 10;
        $offset = ($page - 1) * $resultCount;

        $class = new KelompokModels();
        $class->select("kelompok_id as id, nama_kelompok as text");

        // Search
        if (!empty($search)) {
            $class->like('nama_kelompok', $search);
        }

        $class = $class->offset($offset)->limit($resultCount);


        $count = $class->countAllResults(false);

        //total data yang sudah di load
        $endCount = $offset + $resultCount;

        //cek apakah masih ada data yang belum di load di db
        $morePages = $endCount < $count;

        $results = array(
        "results" => $class->get()->getResult(),
        "pagination" => array(
            "more" => $morePages
        )
        );

        return $this->response->setJSON($results);
    }
}
