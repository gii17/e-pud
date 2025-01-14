<?php

namespace App\Controllers\Service;

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
}