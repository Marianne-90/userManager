<?php

namespace App\Controllers;

use App\Models\ImagesModel;
use App\Models\UsuariosModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Images extends User
{

    private $userModel;
    private $imageModel;
    protected $helpers = ['form', 'file'];

    public function __construct()
    {
        $this->userModel = new UsuariosModel();
        $this->imageModel = new ImagesModel();
    }


    public function index($userId)
    {

        if ($userId == null) {
            return redirect()->back();
        }
        $user = $this->userModel->find($userId);

        if ($user["user_id"] != session()->user_id) {
            $validate = $this->userModel->find(session()->user_id);
            if ($validate["user_admin"] != "1") {
                return redirect()->to("/");
            }
        }

        $resultado = $this->imageModel->select('image_name, user_id, image_id, image_dir')
            ->where('user_id', $userId)
            ->findAll();

        $data = ['title' => 'Galería', 'user' => $user, 'images' => $resultado];

        return view('plantilla/header', $data) .
            view('images/index', $data) .
            view('plantilla/footer');
    }

    public function new($userId)
    {
        $data = ['title' => 'Editar', 'id' => $userId];

        return view('plantilla/header', $data) .
            view('images/new', $data) .
            view('plantilla/footer');
    }


    public function create($userId)
    {
        if ($userId == null) {
            return redirect()->back();
        }
        $user = $this->userModel->find($userId);

        if ($user["user_id"] != session()->user_id) {
            $validate = $this->userModel->find(session()->user_id);
            if ($validate["user_admin"] != "1") {
                return redirect()->to("/");
            }
        }

        $file = $this->request->getFiles();

        if (!$file['image_file']->isValid()) {
            return redirect()->back()->withInput()->with('error', $file['image_file']->getErrorString());
        }

        $reglas = [
            'image_file' => [
                'label' => 'Imagen',
                'rules' => [
                    'is_image[image_file]',
                    'max_size[image_file,1000]',
                    'max_dims[image_file,1024,768]',
                ]
            ]
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        if (!$file['image_file']->hasMoved()) {
            $ruta = ROOTPATH . 'public/images/' . $user['user_login'];
            if (!file_exists($ruta)) {
                mkdir($ruta, 0755, true);
            }
            $letrasAleatorias = substr(md5(uniqid(rand())), 0, 10);
            $originalName = basename($_FILES["image_file"]["name"]);
            $extention = pathinfo($originalName, PATHINFO_EXTENSION);

            $finalName = $letrasAleatorias . '.' . $extention;

            if ($file['image_file']->move($ruta, $finalName, true)) {

                $post = $this->request->getPost(['image_name']);

                $query = [
                    'user_id' => $userId,
                    'image_name' => trim($post['image_name']),
                    'image_dir' => $finalName,
                ];

                if ($this->imageModel->insert($query)) {
                    return redirect()->to('image/' . $userId)->withInput()->with('mensaje', 'imagen añadida');
                }
            }
        }
        return redirect()->back()->withInput()->with('error', 'error al guardar imagen');
    }


    public function show($userId = null, $imageId = null)
    {

        if ($userId == null) {
            return redirect()->back();
        }
        $user = $this->userModel->find($userId);

        if ($user["user_id"] != session()->user_id) {
            $validate = $this->userModel->find(session()->user_id);
            if ($validate["user_admin"] != "1") {
                return redirect()->to("/");
            }
        }

        $img = $this->imageModel->find($imageId);

        $data = ['title' => 'Ver', 'image' => $img, 'user' => $user];

        return view('plantilla/header', $data) .
            view('images/show', $data) .
            view('plantilla/footer');
    }


    public function edit($userId = null, $imageId = null)
    {
        if ($userId == null || $imageId == null) {
            return redirect()->back();
        }
        $user = $this->userModel->find($userId);

        if ($user["user_id"] != session()->user_id) {
            $validate = $this->userModel->find(session()->user_id);
            if ($validate["user_admin"] != "1") {
                return redirect()->to("/");
            }
        }

        $img = $this->imageModel->find($imageId);

        $data = ['title' => 'Ver', 'image' => $img, 'user' => $user];
        return view('plantilla/header', $data) .
            view('images/edit', $data) .
            view('plantilla/footer');
    }


    public function update($userId = null, $imageId = null)
    {
        if ($userId == null || $imageId == null) {
            return redirect()->back();
        }
        $user = $this->userModel->find($userId);

        if ($user["user_id"] != session()->user_id) {
            $validate = $this->userModel->find(session()->user_id);
            if ($validate["user_admin"] != "1") {
                return redirect()->to("/");
            }
        }
        $reglas = [
            'image_name' => 'required',
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        $post = $this->request->getPost(['image_id', 'image_name']);

        $query = [
            'image_name' => trim($post['image_name']),
        ];
        if ($this->imageModel->update($post['image_id'], $query)) {
            return redirect()->to('image/' . $userId)->withInput()->with('mensaje', 'imagen editada correctamente');
        }

        return redirect()->back()->withInput()->with('error', 'error al actualizar imagen');
    }

    public function delete($userId = null, $imageId = null)
    {

        if ($userId == null) {
            return redirect()->back();
        }
        $user = $this->userModel->find($userId);

        if ($user["user_id"] != session()->user_id) {
            $validate = $this->userModel->find(session()->user_id);
            if ($validate["user_admin"] != "1") {
                return redirect()->to("/");
            }
        }

        $img = $this->imageModel->find($imageId);
        $ruta = ROOTPATH . 'public/images/' . $user['user_login'] . '/' . $img['image_dir'];

        if (unlink($ruta)) {
            if ($this->imageModel->delete($imageId)) {
                return redirect()->to('image/' . $userId)->withInput()->with('delete', 'imagen eliminada');
            }
        }
        return redirect()->to('image/' . $userId)->withInput()->with('delete', 'error al eliminar imagen');
    }
}
