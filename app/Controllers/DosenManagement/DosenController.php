<?php

namespace App\Controllers\DosenManagement;

use App\Controllers\Service\EnvironmentController;
use App\Models\Dosen\Dosen;
use CodeIgniter\HTTP\Request;

class DosenController extends EnvironmentController {
    public function __construct()
    {
        parent::__construct(Dosen::class);
    }

    public function index(Request $request) {
        $case = [];
        if($this->validatingParam($request,$case)) {
            $data = $this->validateInput($request);

            return view('page/identitas-pegawai/index', [
                "data"  => static::$__model->paginate->paginate(10),
                "pager" => static::$__model->pager
            ]);
        }
    }

    public function store(Request $request) {
        $data = $this->validateInput($request);
        return $this->queryBuilder("store", function() use ($data) {
            return parent::store($data);
        },function(\Exception $e) {
            var_dump($e->getMessage());
        });
    }

    public function update(Request $request) {
        $data = $this->validateInput($request);
        return $this->queryBuilder("update", function() use ($data) {
            return parent::update($data);
        },function(\Exception $e) {
            var_dump($e->getMessage());
        });
    }
}