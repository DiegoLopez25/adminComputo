<?php

namespace App\Controllers;
use App\Models\UsuarioModel;
use App\Models\BitacoraModel;


class Dashboard extends BaseController
{
    protected UsuarioModel $model;
    protected BitacoraModel $modelBitacora;

    function __construct()
    {   
        $this->model = new UsuarioModel();
        $this->modelBitacora = new BitacoraModel();
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
        date_default_timezone_set('America/El_Salvador');
        $session = session();
        $user = $this->request->getVar("username");
        $password = md5($this->request->getVar("password"));

        $data = $this->model->where("usuario",$user)->where("id_estado","1")->first();
        $log = $this->model->select("id,nombre,apellido,usuario,id_rol")->where("usuario",$user)->where("password",$password)->first();
        if($data){
            if($log){

                $ses_data=[
                    "id" =>$data["id"],
                    "nombre" =>$data["nombre"],
                    "apellido" =>$data["apellido"],
                    "usuario" =>$data["usuario"],
                    "rol"=>$data["id_rol"],
                    "sesion" => "TRUE"
                ];

                $this->modelBitacora->save([
                    'accion' =>'Inicio de sesion',
                    'fecha_hora' => date('d-m-Y h:i:sa', time()),
                    'id_usuario' => $ses_data['id']
                ]);

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
        $this->modelBitacora->save([
            'accion' =>'cierre de sesion',
            'fecha_hora' => date('d-m-Y h:i:sa', time()),
            'id_usuario' => session()->id
        ]);
        session()->destroy();
        return redirect()->to('/login');
    }
}
