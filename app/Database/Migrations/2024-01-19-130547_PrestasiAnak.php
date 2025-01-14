<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PrestasiAnak extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id_prestasi'          => [
				'type'           => 'INT',
				'constraint'     => '5',
				'unsigned'       => true,
				'auto_increment' => true
			],
            'nomor_induk' => [
                'type'       => 'VARCHAR',
                'constraint' => 11,
            ],
			'nama_kegiatan'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '50',
                'null'       	 => true,
			],
            'tanggal_kegiatan' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'lokasi_kegiatan'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '50',
                'null'       	 => true,
			],
			'prestasi'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '50',
                'null'       	 => true,
			],
            'reward'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '50',
                'null'       	 => true,
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
		$this->forge->addKey('id_prestasi', true);
		$this->forge->addForeignKey('nomor_induk', 'users', 'nomor_induk');
		$this->forge->createTable('prestasi_anak', true);
    }

    public function down()
    {
        $this->forge->dropTable('prestasi_anak');
    }
}
