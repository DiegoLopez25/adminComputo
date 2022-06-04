<?php

namespace App\Controllers;
use App\Models\LoginModel;
use app\Models\UserModel;

class LoginController extends BaseController
{
    public function index()
    {
        return view('login/index');
    }

    public function login(){
        $usuario = $this->request->getPost("username");
        $pass = $this->request->getPost("password");

        $model =model(UserModel::class);
        
        if($this->request->getPost()){
            return view('dashboard/index');
        }
    }
}
