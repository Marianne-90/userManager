<?php

namespace App\Controllers;

use App\Models\UsuariosModel;
use Config\Services;

class User extends BaseController
{
    private $userModel;
    protected $helpers = ['form', 'date', 'cookie'];


    public function __construct()
    {
        $this->userModel = new UsuariosModel();
    }

    public function login()
    {
        $userName = trim($_POST['user_name']);
        $userPassword = trim($_POST['user_password']);

        $user = $this->userModel->select("user_name, user_password, user_id")->where('user_name', $userName)->findAll();
        if (empty($user) || $user[0]["user_password"] !== $userPassword) {
            $this->session->setFlashdata('error', 'Credenciales incorrectas');
        } else {

            $this->session->set('user_id', $user[0]['user_id']);
            $this->session->set('user_name', $user[0]['user_name']);
            
            $value = 'something from somewhere';    
            setcookie("TestCookie", $value);
            setcookie("TestCookie", $value, time() + 3600);
        }
        return redirect()->to('/');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/');
    }


    public function validator()
    {
        return isset(session()->user_id);
    }


    public function admin()
    {
        $id = session()->user_id;

        $user = $this->userModel->find($id);
        $admin = $user["user_admin"];
        return $admin;
    }
}
