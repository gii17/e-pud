<?php

namespace App\Controllers;

use App\Models\Kelompok\KelompokModels;
use App\Models\Surat\SuratPindahSekolahModels;
use App\Models\User\UserModels;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }

    public function dashboard(): string
    {
        $userModel = new UserModels();
        $kelompokModel = new KelompokModels();
        $suratPindah = new SuratPindahSekolahModels();
        $data['teacherCount'] = $userModel->where('type_user','is_teacher')->countAllResults();
        $data['studentCount'] = $userModel->where('type_user','is_student')->countAllResults();
        $data['kelompokCount'] = $kelompokModel->countAllResults();
        $data['suratPindahCount'] = $suratPindah->countAllResults();

        return view('page/dashboard/index',$data);
    }
    public function tables(): string
    {
        return view('page/tables/index');
    }
}
