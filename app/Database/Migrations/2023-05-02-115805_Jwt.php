<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Jwt extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'refresh_token' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'expire' => [
                'type' => 'BIGINT',
                'null' => true,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('token');
    }


    //
    public function down()
    {
        $this->forge->dropTable('token');
    }
}
