<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTataTertibItem extends Migration
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
            'deskripsi' => [
                'type'       => 'text',
            ],
            'tata_tertib_id' => [
                'type' => 'int',
                'constraint' => 5,
                'unasign' => true,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP'
        ];

        $this->forge->addField($data);

        $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('tata_tertib_id', 'tata_tertib', 'id', '', 'CASCADE');


        $this->forge->createTable('tata_tertib_item', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('tata_tertib_item');
    }
}
