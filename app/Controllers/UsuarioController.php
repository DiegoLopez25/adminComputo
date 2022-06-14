<?php

namespace App\Controllers;
use App\Models\UsuarioModel;

class UsuarioController extends BaseController
{
    protected UsuarioModel $model;

    function __construct()
    {
        $this->model = new UsuarioModel();
    }

    public function index()
    {
        return view('usuario/index');
    }
}
