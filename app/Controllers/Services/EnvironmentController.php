<?php

namespace App\Controllers\Services;

use App\Controllers\GlobalController;

class EnvironmentController extends ServiceController {
    public function  __construct($classs_path) {
        parent::__construct();
        self::getModel($classs_path);
    }

    public function getModel($model) {
        static::$__model = new $model;
        return __CLASS__;
    }

    public function defaultPayload() {
//        $this->dump([static::$__model->allowedFields,static::$__model->paginate(10)]);
        return [
            'allowedFields' => static::$__model->allowedFields,
            "datas"         => static::$__model->paginate(10),
            "pager"         => static::$__model->pager
        ];
    }
}