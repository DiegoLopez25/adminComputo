<?php

namespace App\Controllers;
use App\Models\UserModel;


class Dashboard extends BaseController
{
    protected UserModel $model;

    function __construct()
    {   
        $this->model = new UserModel();
    }

    public function index()
    {     
        return view('dashboard/index');
    }

    public function login()
    {
        return view('login/index');
    }

    public function iniciarSesion(){
        $session = session();
        $user = $this->request->getVar("username");
        $password = md5($this->request->getVar("password"));

        $data = $this->model->where("usuario",$user)->where("id_estado","1")->first();
        $log = $this->model->select("id,nombre,apellido,usuario")->where("usuario",$user)->where("password",$password)->first();
        if($data){
            if($log){
                $ses_data=[
                    "id" =>$data["id"],
                    "nombre" =>$data["nombre"],
                    "apellido" =>$data["apellido"],
                    "usuario" =>$data["usuario"],
                    "sesion" => "TRUE"
                ];
                $session->setTempdata($ses_data,300);
                return redirect()->to('/dashboard');   
            }else{
                $msg = "La contraseña que ingreso es incorrecta";
                return redirect()->to('/login')->with('icon','fas fa-exclamation-circle')->with('mensaje',$msg)->with('color','bg-danger');
            }
        }else{
            $msg ="El usuario no existe o esta inactivo" ;
            return redirect()->to('/login')->with('icon','fas fa-exclamation-triangle')->with('mensaje',$msg)->with('color','bg-danger');
        }
    }

    public function cerrarSesion(){
        session();
        session()->destroy();
        return redirect()->to('/login');
    }
}
