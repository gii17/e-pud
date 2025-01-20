<?php

namespace App\Controllers\Services;

use App\Controllers\GlobalController;

class ServiceController extends GlobalController {
    protected static $__model;
    public function  __construct() {
        parent::__construct();
    }

    public function store($datas = null,$action = "insert") {
        $payload = [];

        if(isset($datas) && is_array($datas)) {
            $fillables = static::$__model->allowedFields;

            foreach ($fillables as $fillable) {
                $column = $datas[$fillable];
                if(isset($column)) {
                    $payload[$fillable] = $column;
                }else continue;
            }

            if(isset($datas['id']) && $datas['id'] != null) {
                unset($payload['id']);
                $action = "update";
                if(static::$__model->find($datas['id'])) {
                    static::$__model->{$action}($datas['id'],$payload);
                }
            }else {
                static::$__model->{$action}($payload);
            }

            return static::$__model;

        } else throw new \Exception("data must be array !");
    }

    public function update($datas) {
        return self::store($datas,"update");
    }

    public function delete() {
        $data  = $this->request->getJSON();
        if (static::$__model->where("id",$data->id)->first()) {
            static::$__model->delete($data->id);

            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Guru tidak ditemukan'], 404);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'ID tidak ditemukan'], 400);
    }
}