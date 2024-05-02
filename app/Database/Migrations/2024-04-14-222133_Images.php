<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Images extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'image_id' => [
                'type' => 'INT',
                'constraint' => true,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => true,
                'unsigned' => true,
            ],
            'image_name'=>[
                'type'=>'VARCHAR',
                'constraint' =>50
            ],
            'image_dir'=>[
                'type'=>'VARCHAR',
                'constraint' =>100
            ],

        ]);
        $this->forge->addKey('image_id', true);
        $this->forge->addForeignKey('user_id', 'users', 'user_id' );
        $this->forge->createTable('images');
    }

    public function down()
    {
        $this->forge->dropTable('images');
    }
}
