<?php

namespace App\Controllers;
use App\Models\UsuarioModel;
use App\Models\EstadoModel;
use App\Models\RolModel;

class UsuarioController extends BaseController
{
    protected UsuarioModel $model; 
    protected RolModel $modelRol;
    protected EstadoModel $modelEstado;

    function __construct()
    {
        $this->model = new UsuarioModel();
        $this->modelEstado = new EstadoModel();
        $this->modelRol = new RolModel();
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
    public function delete(){
        $request = $this->request->getPost();
        $id = $request['id'];

        $usuarios =  $this->model->find($id);

        if(isset($usuarios)):
            if($this->model->delete($id)):
                $alertType = 'alert-danger';
                $alertTitle = 'Usuario Eliminado';
                $alertMessage = 'Los datos del Usuario han sido eliminados exitosamente';
            else:
                $alertType = 'alert-warning';
                $alertTitle = 'El Usuario no fue Eliminado';
                $alertMessage = 'El Usuario no fue eliminado, intente nuevamente';
            endif;
        else: 
            $alertType = 'alert-warning';
            $alertTitle = 'Usuario no valido';
            $alertMessage = 'El Usuario que intenta eliminar no existe';
        endif;

        return redirect()->to('/usuario')
               ->with('alert-type',$alertType)
               ->with('alert-title',$alertTitle)
               ->with('alert-message',$alertMessage);
   }
}
