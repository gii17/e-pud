<?php

namespace App\Controllers\DtpsManagement;

use App\Controllers\Services\EnvironmentController;
use App\Models\Dosen\Dosen;
use App\Models\DTPS\Dtps;
use CodeIgniter\HTTP\Request;

class DtpsController extends EnvironmentController {
    public function __construct()
    {
        parent::__construct(Dtps::class);
    }

    public function index() {
        $data = $this->request->getGet();
        return view('page/Dtps/index',
            array_merge($this->defaultPayload(),[
                "flag"  => $data['flag'],
                "datas" => static::$__model->where("flag",(strtoupper($data['flag']) == "PKM") ? 1 : 0 )->paginate(10)
            ])
        );
    }

    public function store($datas = null, $action = 'insert') {
        $data = $this->request->getPost();
        return $this->queryBuilder("store", function() use ($data) {
            $model = parent::store($data);
            $url   = ($data['flag'] == 1) ? "admin/dtps?flag=pkm" : "admin/dtps?flag=Penelitian";
            return redirect()->to($url);
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