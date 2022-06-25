<?php

namespace App\Controllers;
use App\Models\UsuarioModel;
use App\Models\EstadoModel;
use App\Models\RolModel;
use App\Models\BitacoraModel;

class UsuarioController extends BaseController
{
    protected UsuarioModel $model; 
    protected RolModel $modelRol;
    protected EstadoModel $modelEstado;
    protected BitacoraModel $modelBitacora;

    function __construct()
    {
        $this->model = new UsuarioModel();
        $this->modelEstado = new EstadoModel();
        $this->modelRol = new RolModel();
        $this->modelBitacora = new BitacoraModel();
    }
    public function index()
    {
        $usuarios = $this->model->ListaUsuarios();
        $data=[
            'usuarios'=>$usuarios,
            'title'=>'Usuarios',
        ];
        return view('usuario/index',$data);
    }

    public function addEdit($id = 0){

        $method = $this->request->getMethod();
        if($id == 0):
            $title = "Usuario";
            $usuarios = ["id" => 0];
            $estados = $this->modelEstado->findAll();
            $color ="success";
            $accion = "Guardar";
            $icono = "far fa-save";
            $std = "";
            $roles = $this->modelRol->findAll();
            $rol="";
        else:
            $title = "Editar Usuarios";
            $usuarios = $this->model->find($id); 
            $color ="warning"; 
            $accion ="Actualizar";
            $std = $this->model->estado($usuarios['id_estado']);
            $rol = $this->model->rol($usuarios['id_rol']);
            $estados = $this->modelEstado->findAll();
            $icono = "fa fa-pencil-alt";
            $roles = $this->modelRol->findAll();

        endif;

        switch ($method) :
            case 'get':
                $data=[
                    'usuarios'=>$usuarios,
                    'roles'=>$roles,
                    'title'=>$title,
                    'color'=>$color,
                    'accion'=>$accion,
                    'icono'=>$icono,
                    'estados'=>$estados,
                    'hasValidationErrors'=>false,
                    'std'=> $std,
                    'rol'=> $rol
                ];
                return view('usuario/addEdit',$data);
                break;
            case 'post':
                $request = $this->request->getPost();

                if($id == 0):

                    $this->modelBitacora->save([
                        'accion' =>'Registro un nuevo usuario con nombre "'.$request['nombre'].'" y usuario "'.$request['usuario'].'"',
                        'fecha_hora' => date('d-m-Y h:i:sa', time()),
                        'id_usuario' => session()->id
                    ]);

                    $usuarios = $request;
                    $usuarios['password'] = md5($request['password']);
                    $usuarios['id_estado'] = 1;  
                    
                else:
                    $usuarios['nombre'] = $request['nombre'];
                    $usuarios['apellido'] = $request['apellido'];
                    $usuarios['email'] = $request['email'];
                    $usuarios['dui'] = $request['dui'];
                    $usuarios['usuario'] = $request['usuario'];
                    $usuarios['password'] = md5($request['password']);
                    $usuarios['id_estado'] = $request['id_estado'];
                    $usuarios['id_rol'] = $request['id_rol'];

                    $this->modelBitacora->save([
                        'accion' =>'Edito un usuario con nombre "'.$usuarios['nombre'].'" con id "'.$usuarios['id'].'"',
                        'fecha_hora' => date('d-m-Y h:i:sa', time()),
                        'id_usuario' => session()->id
                    ]);
                endif;

                if($this->model->save($usuarios) === false):
                    $data=[
                        'usuarios'=>$usuarios,
                        'title'=>$title,
                        'errors'=>$this->model->errors(),
                        'hasValidationErrors'=>true,
                        'title'=>$title,
                        'color'=>$color,
                        'accion'=>$accion,
                        'icono'=>$icono
                    ];
                    return view('usuario/addEdit',$data);
                else:
                    $alertType = $id == 0 ? 'alert-success':'alert-warning';
                    $alertTitle = $id == 0 ? 'Usuario Registrado':'Usuario Actualizado';
                    $alertMessage = $id == 0 ? 'Los datos del Usuario han sido registrados exitosamente':'Los datos del Usuario han sido actualizados exitosamente';

                     return redirect()->to('/usuario')
                        ->with('alert-type',$alertType)
                        ->with('alert-title',$alertTitle)
                        ->with('alert-message',$alertMessage);
                endif;
            break;
        endswitch;   
    }
}
