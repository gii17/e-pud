<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSuratKeteranganPindahSekolahTable extends Migration
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
            'nama_kb' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'status_sekolah' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'alamat_sekolah' => [
                'type'       => 'text',
                'null' => true,
            ],
            'kelurahan' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'kecamatan' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'kota' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'provinsi' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'tanggal_diterima' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'kelompok_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unasign' => true,
            ],
            'surat_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unasign' => true,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP'
        ];

        $this->forge->addField($data);

        $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('kelompok_id', 'kelompok', 'kelompok_id', '', 'CASCADE');
        $this->forge->addForeignKey('surat_id', 'surat_pindah_sekolah', 'id_surat', '', 'CASCADE');


        $this->forge->createTable('surat_keterangan_pindah_sekolah', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('surat_keterangan_pindah_sekolah');
    }
}
