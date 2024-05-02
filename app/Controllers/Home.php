<?php

namespace App\Controllers;

class Home extends User
{

    protected $helpers = ['form', 'date', 'cookie'];
    public function index(): string
    {
        $data = ['title' => 'Home'];
        if ($this->validator()) {
            return view('plantilla/header', $data) .
                view('home') .
                view('plantilla/footer');
        } else {
            return view('plantilla/header', $data) .
                view('login') .
                view('plantilla/footer');
        }
    }
}
