<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlamatPegawai extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id_alamat'          => [
				'type'           => 'INT',
				'constraint'     => '5',
				'unsigned'       => true,
				'auto_increment' => true
			],
            'nomor_induk' => [
                'type'       => 'VARCHAR',
                'constraint' => 11,
            ],
            'alamat_rumah' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'status_rumah' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'nomor_telephone' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'jarak_kantor' => [
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
		$this->forge->addKey('id_alamat', true);
		$this->forge->addForeignKey('nomor_induk', 'users', 'nomor_induk');
		$this->forge->createTable('alamat_pegawai', true);
    }

    public function down()
    {
        $this->forge->dropTable('alamat_pegawai');
    }
}
