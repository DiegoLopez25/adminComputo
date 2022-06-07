<?php

namespace App\Controllers;
use App\Models\UserModel;

class UserController extends BaseController
{
    protected UserModel $model;

    function __construct()
    {
        $this->model = new UserModel();
    }

    public function index()
    {
        return view('usuario/index');
    }
}
