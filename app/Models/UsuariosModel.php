<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'user_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = ['user_name', 'user_login', 'user_password', 'user_admin'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
}
