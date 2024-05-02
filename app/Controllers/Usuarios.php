<?php

namespace App\Controllers;

use App\Models\UsuariosModel;
use App\Models\ImagesModel;

use function PHPUnit\Framework\isEmpty;

class Usuarios extends User
{
    private $userModel;
    private $imageModel;
    protected $helpers = ['form'];

    public function __construct()
    {
        $this->userModel = new UsuariosModel();
        $this->imageModel = new ImagesModel();
    }
    public function index()
    {
        $id = session()->user_id;

        $user = $this->userModel->find($id);
        $admin = $user["user_admin"];

        if (!$admin) {
            return redirect()->to('/');
        }

        $resultado = $this->userModel->findAll();
        $data = ['title' => 'Lista de usuarios', 'users' => $resultado];

        return view('plantilla/header', $data) .
            view('usuarios/index', $data) .
            view('plantilla/footer');
    }

    public function new()
    {
        $id = session()->user_id;

        $user = $this->userModel->find($id);
        $admin = $user["user_admin"];

        if (!$admin) {
            return redirect()->to('/');
        }

        $data = ['title' => 'Nuevo usuario'];
        return view('plantilla/header', $data) .
            view("usuarios/nuevo") .
            view('plantilla/footer');
    }


    public function create()
    {
        $id = session()->user_id;

        $user = $this->userModel->find($id);
        $admin = $user["user_admin"];

        if (!$admin) {
            return redirect()->to('/');
        }

        $reglas = [
            'user_password' => 'required|min_length[5]|max_length[10]',
            'user_name' => 'required',
            'user_login' => 'required|is_unique[users.user_login]',
            'user_admin' => 'required|in_list[0,1]',
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        $post = $this->request->getPost(['user_password', 'user_name', 'user_login', 'user_admin']);

        $query = [
            'user_password' => trim($post['user_password']),
            'user_name' => trim($post['user_name']),
            'user_login' => trim($post['user_login']),
            'user_admin' => $post['user_admin'],
        ];

        $this->userModel->insert($query);

        $this->session->setFlashdata('mensaje', 'Registro Agregado.');

        return redirect()->to('usuarios');
    }

    public function edit($id = null)
    {

        if ($id == null) {
            return redirect()->back();
        }
        $user = $this->userModel->find($id);

        if ($user["user_id"] != session()->user_id) {
            $validate = $this->userModel->find(session()->user_id);
            if ($validate["user_admin"] != "1") {
                return redirect()->to("/");
            }
        }

        $data = ['title' => 'Editar', 'user' => $user];
        return view('plantilla/header', $data) .
            view("usuarios/editar", $data) .
            view('plantilla/footer');
    }


    public function update($id = null)
    {
        if ($id == null) {
            return redirect()->back();
        }

        $reglas = [
            'user_password' => 'required|min_length[5]|max_length[10]',
            'user_name' => 'required',
            'user_login' => "required|is_unique[users.user_login,user_id,{$id}]",
            'user_admin' => 'required|in_list[0,1]',
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        $post = $this->request->getPost(['user_password', 'user_name', 'user_login', 'user_admin']);

        $query = [
            'user_password' => trim($post['user_password']),
            'user_name' => trim($post['user_name']),
            'user_login' => trim($post['user_login']),
            'user_admin' => $post['user_admin'],
        ];

        $this->userModel->update($id, $query);

        return redirect()->to('usuarios');
    }


    public function delete($id = null)
    {
        if ($id == null) {
            return redirect()->back();
        }


        $images = $this->imageModel->select('image_name, user_id, image_id, image_dir')
            ->where('user_id', $id)
            ->findAll();
        if (!empty($images)) {
            return redirect()->back()->withInput()->with('error', 'El usuario tiene imágenes guardadas favor de eliminar');
        }
        $this->userModel->delete($id);
        return redirect()->back()->withInput()->with('mensaje', 'Usuario Eliminado');
    }
}
