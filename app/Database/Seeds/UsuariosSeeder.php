<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsuariosSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'user_name' => 'Julio',
                'user_login' => 'julio',
                'user_password' => '123456',
                'user_admin'=>false,
            ],
            [
                'user_name' => 'Marianne',
                'user_login' => 'marianne',
                'user_password' => '123456',
                'user_admin'=>true,
            ],
            [
                'user_name' => 'Max',
                'user_login' => 'max',
                'user_password' => '123456',
                'user_admin'=>false,
            ],
        ];
        $this->db->table('users')->insertBatch($data);
    }
}
