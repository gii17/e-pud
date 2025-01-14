<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User\UserModels;

class AuthController extends BaseController
{
    public function signin(): string
    {
        return view('page/auth/signin');
    }
    public function register(): string
    {
        return view('page/auth/signup');
    }

    function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }

    public function process()
    {

        $users = new UserModels();
        $nomor_induk = $this->request->getVar('nomor_induk');
        $password = $this->request->getVar('password');
        $dataUser = $users->where([
            'nomor_induk' => $nomor_induk,
        ])->first();

        if ($dataUser) {
            if (password_verify($password, $dataUser['password'])) {
                session()->set([
                    'nomor_induk' => $dataUser['nomor_induk'],
                    'nama_lengkap' => $dataUser['nama_lengkap'],
                    'user_id' => $dataUser['user_id'],
                    'role' => $dataUser['type_user'],
                    'logged_in' => TRUE
                ]);

                if($dataUser['type_user'] == 'is_admin'){
                    return redirect()->to(base_url('admin/dashboard'));
                }else if($dataUser['type_user'] == 'is_student'){
                    return redirect()->to(base_url('student/surat-pindah-sekolah'));
                }else if($dataUser['type_user'] == 'is_teacher'){
                    return redirect()->to(base_url('teacher/jadwal-mengajar'));
                }

            } else {
                session()->setFlashdata('error', 'Nomor Induk & Password Salah');
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('error', 'Nomor Induk & Password Salah');
            return redirect()->back();
        }
    }
}
