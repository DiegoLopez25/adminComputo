<?php
namespace App\Controllers;

use App\Models\TipoIncidenteModel;
use App\Models\CentroComputoModel;
use App\Models\UsuarioModel;
use App\Models\DispositivoModel;
use App\Models\IncidenteModel;
use App\Models\BitacoraModel;

class IncidenteController extends BaseController{

    protected IncidenteModel $model; 
    protected CentroComputoModel $modelCentroComputo;
    protected TipoIncidenteModel $modelTipoIncidente;
    protected UsuarioModel $modelUsuario;
    protected DispositivoModel $modelDispositivo;
    protected BitacoraModel $modelBitacora;
    

    function __construct()
    {
        $this->model = new IncidenteModel();
        $this->modelCentroComputo = new CentroComputoModel();
        $this->modelTipoIncidente = new TipoIncidenteModel();
        $this->modelUsuario = new UsuarioModel();
        $this->modelDispositivo = new DispositivoModel();
        $this->modelBitacora = new BitacoraModel();
    }

    public function index(){
        $incidentes = $this->model->ListaIncidentes();
        $tipoIncidentes=$this->modelTipoIncidente->findAll();
        $centroComputo=$this->modelCentroComputo->findAll();
        $dispositivo=$this->modelDispositivo->findAll();
        $resol = $this->model->ViewIncidentes();
        $data=[
            'incidentes'=>$incidentes,
            'title'=>'Incidente',
            'tipoIncidentes' => $tipoIncidentes,
            'centroComputo' => $centroComputo,
            'dispositivo'=>$dispositivo,
            'inc'=> ['id'=>0],
            'resolucion' => $resol
        ];
        return view('incidente/index',$data);
    }
    public function addEdit($id = 0){

        $method = $this->request->getMethod();
        if($id == 0):
            $incidentes = ["id" => 0];
        endif;
        switch ($method) :
            case 'get':
                $data=[
                    'incidentes'=>$incidentes,
                    'hasValidationErrors'=>false,
                ];
                return view('incidente/index',$data);
                break;
            case 'post':
                $request = $this->request->getPost();
                session();
                if($id == 0):
                    date_default_timezone_set('America/El_Salvador');

                    $this->modelBitacora->save([
                        'accion' =>'Registro un nuevo incidente con descripcion "'.$request['descripcion'].'"',
                        'fecha_hora' => date('d-m-Y h:i:sa', time()),
                        'id_usuario' => session()->id
                    ]);


                    $incidentes = $request;

                    $imgNombre = $_FILES["imagen"]["name"];
                    $temp = $_FILES['imagen']['tmp_name'];
                    $url = "/img/foto-incidentes/".$imgNombre;
                    move_uploaded_file($temp,"../public/img/foto-incidentes/".$imgNombre);
                    $incidentes['foto_evidencia'] = $url ;

                    $incidentes['id_estado_incidente'] = 1;  
                    $incidentes['fecha_hora_incidente']= date('d-m-Y h:i:sa', time());
                    /*
                    -filtrar
                    -generar reporte
                    */
                    
                else:
                    $incidentes['id']= $request['id'];
                    $imgNombre_resolucion = $_FILES["imagen_resolucion"]["name"];
                    $temp_resolucion = $_FILES['imagen_resolucion']['tmp_name'];
                    $url_resolucion = "/img/foto-resolucion/".$imgNombre_resolucion;
                    move_uploaded_file($temp_resolucion,"../public/img/foto-resolucion/".$imgNombre_resolucion);
                    $incidentes['id_estado_incidente']=2;
                    $incidentes['foto_resolucion']=$url_resolucion;
                    $incidentes['mensaje_resolucion']=$request['mensaje_resolucion'];
                    if($this->request->getPost('mensaje_resolucion')){
                        $incidentes['fecha_hora_resolucion']= date('d-m-Y h:i:sa', time());
                    }

                    $this->modelBitacora->save([
                        'accion' =>'Dio resolucion a un incidente con mensaje de resolucion "'.$request['mesaje_resolucion'].'"',
                        'fecha_hora' => date('d-m-Y h:i:sa', time()),
                        'id_usuario' => session()->id
                    ]);
                endif;

                if($this->model->save($incidentes) === false):
                    $data=[
                        'incidentes'=>$incidentes,
                        'errors'=>$this->model->errors(),
                        'hasValidationErrors'=>true,
                    ];
                    return view('incidente/index',$data);
                else:
                    $alertType = $id == 0 ? 'alert-success':'alert-warning';
                    $alertTitle = $id == 0 ? 'Incidente Registrado':'Incidente Resuelto';
                    $alertMessage = $id == 0 ? 'Los datos del incidente han sido registrados exitosamente':'El incidente ha sido resuelto';

                     return redirect()->to('/incidente')
                        ->with('alert-type',$alertType)
                        ->with('alert-title',$alertTitle)
                        ->with('alert-message',$alertMessage);
                endif;
            break;
        endswitch;   
    }

    function action()
	{
		if($this->request->getVar('action'))
		{
			$action = $this->request->getVar('action');

			if($action == 'obtener_dispositivo')
			{
				$dispositivo = new DispositivoModel();

				$dispositivoData = $dispositivo->where('id_centro_computo', $this->request->getVar('id_centro_computo'))->findAll();

				echo json_encode($dispositivoData);
			}
		}
	}
}