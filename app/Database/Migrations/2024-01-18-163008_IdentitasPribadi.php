<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class IdentitasPribadi extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id_identitas'          => [
				'type'           => 'INT',
				'constraint'     => '5',
				'unsigned'       => true,
				'auto_increment' => true
			],
            'nomor_induk' => [
                'type'       => 'VARCHAR',
                'constraint' => 11,
            ],
            'jenis_kelamin' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
            ],
            'tempat_lahir' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'tanggal_lahir' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'status_kepegawaian' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'nip' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'agama' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'status_perkawinan' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'nama_pasangan' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
			'created_at' => [
				'type'           => 'DATETIME',
				'null'       	 => true,
			],
			'updated_at' => [
				'type'           => 'DATETIME',
				'null'       	 => true,
			]

		]);
		$this->forge->addKey('id_identitas', true);
		$this->forge->addForeignKey('nomor_induk', 'users', 'nomor_induk');
		$this->forge->createTable('identitas_pegawai', true);
    }

    public function down()
    {
        $this->forge->dropTable('identitas_pegawai');
    }
}
