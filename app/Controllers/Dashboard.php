<?php

namespace App\Controllers;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    protected UserModel $model;

    public function index()
    {       
        return view('dashboard/index');
    }

    function __construct()
    {
        $this->model = new UserModel();
    }

    public function login()
    {
        return view('login/index');
    }

    public function iniciarSesion(){
        $sesion = session();
        $usuario = $this->request->getVar("username");
        $password = $this->model->where("password",md5($this->request->getVar("password")))->first();

        $data = $this->model->where("usuario",$usuario)->first();
        if($data){
            if($password){
                $ses_data = [
                    "id" => $data["id"],
                    "nombre" => $data["nombre"],
                    "apellido" => $data["apellido"],
                    "email" => $data["email"],
                    "usuario" => $data["usuario"]
                ];
                $sesion->set($ses_data);
                return redirect()->to('dashboard/');   
            }else{
                $msg = "La contraseña que ingreso es incorrecta";
                return redirect()->to('/login')->with('icon','fas fa-exclamation-circle')->with('mensaje',$msg)->with('color','bg-danger');
            }
        }else{
            $msg ="El usuario no existe" ;
            return redirect()->to('/login')->with('icon','fas fa-exclamation-triangle')->with('mensaje',$msg)->with('color','bg-danger');
        }
    }
}
