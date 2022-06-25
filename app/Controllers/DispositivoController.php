<?php
namespace App\Controllers;

use App\Models\CentroComputoModel;
use App\Models\EstadoModel;
use App\Models\DispositivoModel;
use App\Models\BitacoraModel;

class DispositivoController extends BaseController
{
    protected DispositivoModel $model; 
    protected CentroComputoModel $modelCentroComputo;
    protected EstadoModel $modelEstado;
    protected BitacoraModel $modelBitacora;
    

    function __construct()
    {
        $this->model = new DispositivoModel ();
        $this->modelEstado = new EstadoModel();
        $this->modelCentroComputo = new CentroComputoModel();
        $this->modelBitacora = new BitacoraModel();
    }
    public function index()
    {
        $dispositivos = $this->model->ListaDispositivos();
        $data=[
            'dispositivos'=>$dispositivos,
            'title'=>'Dispositivo',
        ];
        return view('dispositivo/index',$data);
    }

    public function addEdit($id = 0){

        $method = $this->request->getMethod();
        if($id == 0):
            $title = "Dispositivos";
            $dispositivos = ["id" => 0];
            $estados = $this->modelEstado->findAll();
            $color ="success";
            $accion = "Guardar";
            $icono = "far fa-save";
            $std = "";
            $centroComputo = $this->model->centros();
            $centros = $this->modelCentroComputo->findAll();
        else:
            $title = "Editar Dispositivos";
            $dispositivos = $this->model->find($id); 
            $color ="warning"; 
            $accion ="Actualizar";
            $std = $this->model->estado($dispositivos['id_estado']);
            $centroComputo = $this->model->centroComputo($dispositivos['id_centro_computo']);
            $estados = $this->modelEstado->findAll();
            $icono = "fa fa-pencil-alt";
            $centros = $this->modelCentroComputo->findAll();

        endif;

        switch ($method) :
            case 'get':
                $data=[
                    'dispositivos'=>$dispositivos,
                    'centroComputo'=>$centroComputo,
                    'title'=>$title,
                    'color'=>$color,
                    'accion'=>$accion,
                    'icono'=>$icono,
                    'estados'=>$estados,
                    'hasValidationErrors'=>false,
                    'std'=> $std,
                    'centros'=> $centros
                ];
                return view('dispositivo/addEdit',$data);
                break;
            case 'post':
                $request = $this->request->getPost();

                if($id == 0):
                    $dispositivos = $request;
                    $dispositivos['id_estado'] = 1; 
                    
                    $this->modelBitacora->save([
                        'accion' =>'Registro un nuevo dispositivo con nombre'.$request['nombre'],
                        'fecha_hora' => date('d-m-Y h:i:sa', time()),
                        'id_usuario' => session()->id
                    ]);
                else:
                    $dispositivos['serial'] = $request['serial'];
                    $dispositivos['nombre'] = $request['nombre'];
                    $dispositivos['id_estado'] = $request['id_estado'];
                    $dispositivos['id_centro_computo'] = $request['id_centro_computo'];

                    $this->modelBitacora->save([
                        'accion' =>'Edito el dispositivo con id '.$dispositivos['id'].' de nombre'.$dispositivos['nombre'] ,
                        'fecha_hora' => date('d-m-Y h:i:sa', time()),
                        'id_usuario' => session()->id
                    ]);
                endif;

                if($this->model->save($dispositivos) === false):
                    $data=[
                        'dispositivos'=>$dispositivos,
                        'title'=>$title,
                        'errors'=>$this->model->errors(),
                        'hasValidationErrors'=>true,
                        'title'=>$title,
                        'color'=>$color,
                        'accion'=>$accion,
                        'icono'=>$icono
                    ];
                    return view('dispositivo/addEdit',$data);
                else:
                    $alertType = $id == 0 ? 'alert-success':'alert-warning';
                    $alertTitle = $id == 0 ? 'Dispositivo Registrado':'Dispositivo Actualizado';
                    $alertMessage = $id == 0 ? 'Los datos del Dispositivo han sido registrados exitosamente':'Los datos del dispositivo han sido actualizados exitosamente';

                     return redirect()->to('/dispositivo')
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

        $dispositivos =  $this->model->find($id);

        if(isset($dispositivos)):
            if($this->model->delete($id)):
                $this->modelBitacora->save([
                    'accion' =>'Elimino el dispositivo '.$dispositivos['nombre'].' con id'.$dispositivos['id'],
                    'fecha_hora' => date('d-m-Y h:i:sa', time()),
                    'id_usuario' => session()->id
                ]);
                $alertType = 'alert-danger';
                $alertTitle = 'Dispositivo Eliminado';
                $alertMessage = 'Los datos del dispositivo han sido eliminados exitosamente';
            else:
                $alertType = 'alert-warning';
                $alertTitle = 'El dispositivo no fue Eliminado';
                $alertMessage = 'El dispositivo no fue eliminado, intente nuevamente';
            endif;
        else: 
            $alertType = 'alert-warning';
            $alertTitle = 'Dispositivo no valido';
            $alertMessage = 'El dispositivo que intenta eliminar no existe';
        endif;

        return redirect()->to('/dispositivo')
               ->with('alert-type',$alertType)
               ->with('alert-title',$alertTitle)
               ->with('alert-message',$alertMessage);
   }
}