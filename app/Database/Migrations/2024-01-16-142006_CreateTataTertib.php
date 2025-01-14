<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTataTertib extends Migration
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
            'judul' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP'
        ];

        $this->forge->addField($data);

        $this->forge->addKey('id', TRUE);

        $this->forge->createTable('tata_tertib', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('tata_tertib');
    }
}
