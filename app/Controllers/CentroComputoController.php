<?php
namespace App\Controllers;
use App\Models\CentroComputoModel;
use App\Models\EstadoModel;

class CentroComputoController extends BaseController
{
    protected CentroComputoModel $model;
    protected EstadoModel $modelEstado;
    function __construct()
    {
        $this->model = new CentroComputoModel();
        $this->modelEstado = new EstadoModel();
    }

    public function index()
    {
        $pageSize = $this->request->getVar('pageSize') ?? 5;
        $page = $this->request->getVar('page') ?? 1;

        $centroComputo = $this->model->ListaCentroComputo()/*->paginate($pageSize,'default',$page)*/;
        $data=[
            'centroComputo'=>$centroComputo,
            'title'=>'Centro de computo',
        ];
        return view('centrocomputo/index',$data);
    }

    public function addEdit($id = 0){

        $method = $this->request->getMethod();
        if($id == 0):
            $title = "Nuevo Centro de computo";
            $centroComputo = ["id" => 0];
            $estados = $this->modelEstado->findAll();
            $color ="success";
            $accion = "Guardar";
            $icono = "far fa-save";
            $std = "";
        else:
            $title = "Editar Cliente";
            $centroComputo = $this->model->find($id); 
            $color ="warning"; 
            $accion ="Actualizar";
            $std = $this->model->estado($centroComputo['id_estado']);  
            $estados = $this->modelEstado->findAll();
            $icono = "fa fa-pencil-alt";
        endif;

        switch ($method) :
            case 'get':
                $data=[
                    'centroComputo'=>$centroComputo,
                    'title'=>$title,
                    'color'=>$color,
                    'accion'=>$accion,
                    'icono'=>$icono,
                    'estados'=>$estados,
                    'hasValidationErrors'=>false,
                    'std'=> $std
                ];
                return view('centrocomputo/addEdit',$data);
                break;
            case 'post':
                $request = $this->request->getPost();

                if($id == 0):
                    $centroComputo = $request;
                    $centroComputo['id_estado'] = 1;  
                else:
                    $centroComputo['nombre'] = $request['nombre'];
                    $centroComputo['descripcion'] = $request['descripcion'];
                    $centroComputo['estado'] = $request['estado'];
                endif;

                if($this->model->save($centroComputo) === false):
                    $data=[
                        'centroComputo'=>$centroComputo,
                        'title'=>$title,
                        'errors'=>$this->model->errors(),
                        'hasValidationErrors'=>true,
                        'title'=>$title,
                        'color'=>$color,
                        'accion'=>$accion,
                        'icono'=>$icono
                    ];
                    return view('centrocomputo/addEdit',$data);
                else:
                    $alertType = $id == 0 ? 'alert-success':'alert-warning';
                    $alertTitle = $id == 0 ? 'Centro de computo Registrado':'Cliente Actualizado';
                    $alertMessage = $id == 0 ? 'Los datos del centro de computo han sido registrados exitosamente':'Los datos del centro de computo han sido actualizados exitosamente';

                     return redirect()->to('/centro-computo')
                        ->with('alert-type',$alertType)
                        ->with('alert-title',$alertTitle)
                        ->with('alert-message',$alertMessage);
                endif;
            break;
        endswitch;   
    }

}