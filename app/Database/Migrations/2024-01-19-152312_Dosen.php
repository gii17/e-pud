<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Dosen extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'                   => ['type' => 'VARCHAR', 'constraint' => 255],
            'nidn_nidk'              => ['type' => 'VARCHAR', 'constraint' => 255],
            'postgraduate_degree'    => ['type' => 'VARCHAR', 'constraint' => 255],
            'expertise_area'         => ['type' => 'VARCHAR', 'constraint' => 255],
            'academic_position'      => ['type' => 'VARCHAR', 'constraint' => 255],
            'teaching_certificate'   => ['type' => 'BOOLEAN', 'default' => 0], // assuming a boolean value (0 = no, 1 = yes)
            'competency_certificate' => ['type' => 'BOOLEAN', 'default' => 0], // assuming a boolean value (0 = no, 1 = yes)
            'courses_taught'         => ['type' => 'TEXT', 'null' => true],
            'expertise_fit'          => ['type' => 'TEXT', 'null' => true],
            'created_at'             => ['type' => 'DATETIME', 'null' => true],
            'updated_at'             => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('dosens');
    }

    public function down()
    {
        $this->forge->dropTable('dosens');
    }
}
