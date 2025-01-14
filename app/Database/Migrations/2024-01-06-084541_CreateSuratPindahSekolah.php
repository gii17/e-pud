<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSuratPindahSekolah extends Migration
{
    public function up()
    {

        $data  = [
            'id_surat' => [
                'type' => 'INT',
                'constraint' => 5,
                'unasign' => true,
                'auto_increment' => true
            ],
            'student_id' => [
                'type' => 'INT',
                'constraint' => 5,
            ],
            'nama_orang_tua' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'sekolah_tujuan' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'kecamatan' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'kabupaten' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'provinsi' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'alasan' => [
                'type'       => 'TEXT',
                'constraint' => 100,
            ],
            'pekerjaan' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'alamat' => [
                'type'       => 'TEXT',
                'constraint' => 100,
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null' => true,
            ],

            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP'
        ];

        $this->forge->addField($data);

        $this->forge->addKey('id_surat', TRUE);
        $this->forge->addForeignKey('student_id', 'users', 'user_id');

        $this->forge->createTable('surat_pindah_sekolah', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('surat_pindah_sekolah');
    }
}
