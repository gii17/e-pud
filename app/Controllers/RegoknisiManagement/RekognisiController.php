<?php

namespace App\Controllers\RegoknisiManagement;

use App\Controllers\Services\EnvironmentController;
use App\Models\Dosen\Dosen;
use App\Models\Rekognisi\Rekognisi;
use CodeIgniter\HTTP\Request;

class RekognisiController extends EnvironmentController {
    public function __construct()
    {
        parent::__construct(Rekognisi::class);
    }

    public function index() {
        $data = $this->request->getPost();
        return view('page/Rekognisi/index',$this->defaultPayload());
    }

    public function store($datas = null, $action = 'insert') {
        $data = $this->request->getPost();
        return $this->queryBuilder("store", function() use ($data) {
            $data = parent::store($data);   
            return redirect()->to("admin/rekognisi");
        },function(\Exception $e) {
            var_dump($e->getMessage());
        });
    }

    public function update($datas) {
        $data = $this->request->getPost();
        return $this->queryBuilder("update", function() use ($data) {
            return parent::update($data);
        },function(\Exception $e) {
            var_dump($e->getMessage());
        });
    }
}