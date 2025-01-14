<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'nama_lengkap' => 'Administrator',
            'jenis_kelamin'    => 'L',
            'nomor_induk' => 'admin',
            'password' => password_hash('password', PASSWORD_BCRYPT),
            'tempat_lahir' => 'tes',
            'tanggal_lahir' => '03-01-2024',
            'tahun_masuk' => '2024',
            'type_user' => 'is_admin'
        ];

        // Simple Queries
        $this->db->table('users')->insert($data);

    }
}
