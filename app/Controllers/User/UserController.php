<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

class UserController extends BaseController
{
    public function profile(): string
    {
        return view('page/profile/index');
    }

}
