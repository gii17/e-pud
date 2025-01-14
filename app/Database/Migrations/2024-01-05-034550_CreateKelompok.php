<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKelompok extends Migration
{
    public function up()
    {

        $data  = [
            'kelompok_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unasign' => true,
                'auto_increment' => true
            ],
            'nama_kelompok' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'teacher_id' => [
                'type' => 'INT',
                'constraint' => 5,
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null' => true,
            ],

            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP'
        ];

        $this->forge->addField($data);

        $this->forge->addKey('kelompok_id', TRUE);
        $this->forge->addForeignKey('teacher_id', 'users', 'user_id');

        $this->forge->createTable('kelompok', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('kelompok');
    }
}
