<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Genre extends Migration
{
    public function up()
    { 
        $this->forge->addField([
            'id' => [
                'type' => 'int',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'genre' => [
                'type' => 'varchar',
                'constraint' => 50,
                'null' => false,
            ]
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->createTable('genres');
        
    }

    public function down()
    {
        //
        $this->forge->dropTable('genre');
    }
}
