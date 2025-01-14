<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KeteranganJasmani extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id_jasmani'          => [
				'type'           => 'INT',
				'constraint'     => '5',
				'unsigned'       => true,
				'auto_increment' => true
			],
            'nomor_induk' => [
                'type'       => 'VARCHAR',
                'constraint' => 11,
            ],
            'berat_badan' => [
                'type'       => 'VARCHAR',
                'constraint' => 11,
            ],
            'tinggi_badan' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'golongan_darah' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'riwayat_penyakit' => [
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
		$this->forge->addKey('id_jasmani', true);
		$this->forge->addForeignKey('nomor_induk', 'users', 'nomor_induk');
		$this->forge->createTable('keterangan_jasmani', true);
    }

    public function down()
    {
        $this->forge->dropTable('keterangan_jasmani');
    }
}
