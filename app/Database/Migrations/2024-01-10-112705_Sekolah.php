<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Sekolah extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id_sekolah'          => [
				'type'           => 'INT',
				'constraint'     => '5',
				'unsigned'       => true,
				'auto_increment' => true
			],
			'nama_sekolah'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '50',
                'null'       	 => true,
			],
            'status_sekolah'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '50',
                'null'       	 => true,
			],
			'nomor_statistik'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '50',
                'null'       	 => true,
			],
			'kelurahan'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '50',
                'null'       	 => true,
			],
            'kecamatan'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '50',
                'null'       	 => true,
			],
            'kota'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '50',
                'null'       	 => true,
			],
            'provinsi'       => [
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
		$this->forge->addKey('id_sekolah', true);
		$this->forge->createTable('sekolah', true);
    }

    public function down()
    {
        $this->forge->dropTable('sekolah');
    }
}
