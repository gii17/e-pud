<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsers extends Migration
{
    public function up()
    {

        $data  = [
            'user_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unasign' => true,
                'auto_increment' => true
            ],
            'photo' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'nama_lengkap' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'jenis_kelamin' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
            ],
            'nomor_induk' => [
                'type'       => 'VARCHAR',
                'unique' => true,
                'constraint' => 11,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'tempat_lahir' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'tanggal_lahir' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'tahun_masuk' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'id_kelompok' => [ //ONLY STUDENT
                'type'        => 'INT',
                'constraint'  => 5,
                'null' => true,
            ],
            'type_user' => [ //FOR ROLE 
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null' => true,
            ],

            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP'
        ];

        $this->forge->addField($data);

        $this->forge->addKey('user_id', TRUE);

        $this->forge->createTable('users', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
