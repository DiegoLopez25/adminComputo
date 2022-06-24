<?php
namespace App\Controllers;

use App\Models\TipoIncidenteModel;

class TipoIncidenteController extends BaseController{

    protected TipoIncidenteModel $model;

    function __construct()
    {
        $this->model = new TipoIncidenteModel();
    }

    public function index()
    {
        $tipoIncidente = $this->model->findAll();
        $data=[
            'tipoIncidente'=>$tipoIncidente,
            'title'=>'Tipo de incidente',
        ];
        return view('tipo-incidente/index',$data);
    }
    public function addEdit($id = 0){

        $method = $this->request->getMethod();
        if($id == 0):
            $title = "Tipo incidente";
            $tipoIncidente = ["id" => 0];
            $color ="success";
            $accion = "Guardar";
            $icono = "far fa-save";
        else:
            $title = "Editar Tipo Incidente";
            $tipoIncidente = $this->model->find($id); 
            $color ="warning"; 
            $accion ="Actualizar";  
            $icono = "fa fa-pencil-alt";
        endif;

        switch ($method) :
            case 'get':
                $data=[
                    'tipoIncidente'=>$tipoIncidente,
                    'title'=>$title,
                    'color'=>$color,
                    'accion'=>$accion,
                    'icono'=>$icono,
                    'hasValidationErrors'=>false,
                ];
                return view('tipo-incidente/addEdit',$data);
                break;
            case 'post':
                $request = $this->request->getPost();

                if($id == 0):
                    $tipoIncidente = $request; 
                else:
                    $tipoIncidente['nombre'] = $request['nombre'];
                    $tipoIncidente['descripcion'] = $request['descripcion'];
                endif;

                if($this->model->save($tipoIncidente) === false):
                    $data=[
                        'tipoIncidente'=>$tipoIncidente,
                        'title'=>$title,
                        'errors'=>$this->model->errors(),
                        'hasValidationErrors'=>true,
                        'title'=>$title,
                        'color'=>$color,
                        'accion'=>$accion,
                        'icono'=>$icono
                    ];
                    return view('tipo-incidente/addEdit',$data);
                else:
                    $alertType = $id == 0 ? 'alert-success':'alert-warning';
                    $alertTitle = $id == 0 ? 'Tipo incidente Registrado':'Tipo incidente Actualizado';
                    $alertMessage = $id == 0 ? 'Los datos del tipo incidente han sido registrados exitosamente':'Los datos del tipo incidente han sido actualizados exitosamente';

                     return redirect()->to('/tipo-incidente')
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

        $tipoIncidente =  $this->model->find($id);

        if(isset($tipoIncidente)):
            if($this->model->delete($id)):
                $alertType = 'alert-danger';
                $alertTitle = 'Tipo incidente Eliminado';
                $alertMessage = 'Los datos del Tipo incidente han sido eliminados exitosamente';
            else:
                $alertType = 'alert-warning';
                $alertTitle = 'Tipo incidente no fue Eliminado';
                $alertMessage = 'El Tipo incidente no fue eliminado, intente nuevamente';
            endif;
        else: 
            $alertType = 'alert-warning';
            $alertTitle = 'Tipo incidente no valido';
            $alertMessage = 'El Tipo incidente que intenta eliminar no existe';
        endif;

        return redirect()->to('/tipo-incidente')
               ->with('alert-type',$alertType)
               ->with('alert-title',$alertTitle)
               ->with('alert-message',$alertMessage);
   }
}