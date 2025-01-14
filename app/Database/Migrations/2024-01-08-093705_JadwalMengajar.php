<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JadwalMengajar extends Migration
{
    public function up()
    {

        $data  = [
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unasign' => true,
                'auto_increment' => true
            ],
            'hari' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
            ],
            'teacher_id' => [
                'type' => 'INT',
                'constraint' => 5,
            ],
            'jpm' => [
                'type'       => 'VARCHAR',
                'constraint' => 11,
            ],
            'kelompok_id' => [
                'type' => 'INT',
                'constraint' => 5,
            ],
            'kegiatan_awal' => [
                'type'   => 'TEXT',
            ],
            'kegiatan_inti' => [
                'type'    => 'TEXT',
            ],
            'kegiatan_akhir' => [
                'type'   => 'TEXT',
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null' => true,
            ],

            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP'
        ];

        $this->forge->addField($data);

        $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('teacher_id', 'users', 'user_id');
        $this->forge->addForeignKey('kelompok_id', 'kelompok', 'kelompok_id');
        $this->forge->createTable('jadwal_mengajar', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('jadwal_mengajar');
    }
}
