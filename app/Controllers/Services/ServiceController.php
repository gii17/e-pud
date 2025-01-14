<?php

namespace App\Controllers\Service;

use App\Controllers\GlobalController;

class ServiceController extends GlobalController {
    protected static $__model;
    public function  __construct() {
        parent::__construct();
    }

    public function store($datas,$action = "insert") {
        $payload = [];

        if(isset($datas) && is_array($datas)) {
            $fillable = static::$__model->getAllowedFields();

            foreach ($datas as $key => $data) {
                $column = $fillable->{$key};

                if(in_array($column,$fillable)) {
                    $payload[$key] = $data;
                } else continue;

            }

            if(isset($datas['id'])) {
                unset($payload['id']);

                if(static::$__model->find($datas['id'])) {
                    static::$__model->{$action}($datas['id'],$payload);
                }
            }else static::$__model->{$action}($payload);

            return static::$__model;

        } else throw new \Exception("data must be array !");
    }

    public function update($datas) {
        return self::store($datas,"update");
    }
}