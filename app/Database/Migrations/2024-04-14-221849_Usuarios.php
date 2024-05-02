<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Usuarios extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id' => [
                'type' => 'INT',
                'constraint' => true,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'user_name'=>[
                'type'=>'VARCHAR',
                'constraint' => 50
            ],
            'user_login'=>[
                'type'=>'VARCHAR',
                'constraint' => 50,
                'unique'=> true
            ],
            'user_password'=>[
                'type'=>'VARCHAR',
                'constraint' =>50
            ],
            'user_admin'=>[
                'type'=>'BOOLEAN',
            ],

        ]);
        
        $this->forge->addKey('user_id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
