<?php
namespace app\Models;
use CodeIgniter\Model;

class IncidenteModel extends Model
{
    protected $table      = "tbl_incidente";
    protected $primaryKey = "id";

    protected $useAutoIncrement = true;

    protected $returnType     = "array";

    protected $allowedFields = ["descripcion", 
                                "fecha_hora_incidente", 
                                "foto_evidencia", 
                                "mensaje_resolucion",
                                "id_estado_incidente",
                                "id_tipo_incidente",
                                "id_centro_computo",
                                "id_usuario",
                                "id_dispositivo",
                                "foto_resolucion",
                                "fecha_hora_resolucion"];

    protected $useTimestamps = false;

    protected $validationRules    = [
    ];
    protected $validationMessages = [

    ];
    protected $skipValidation = false;

    public function ListaIncidentes(){
        return $this->db->query("CALL sp_ListaIncidentes()")->getResult();
    }

    public function ViewIncidentes(){
        return $this->db->query("CALL sp_ViewIncidentes()")->getResult();
    }
    
}