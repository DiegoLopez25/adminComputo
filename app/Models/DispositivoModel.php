<?php
namespace app\Models;
use CodeIgniter\Model;

class DispositivoModel extends Model
{
    protected $table      = "tbl_dispositivo";
    protected $primaryKey = "id";

    protected $useAutoIncrement = true;

    protected $returnType     = "array";

    protected $allowedFields = ["serial","nombre","id_estado","id_centro_computo"];

    protected $useTimestamps = false;

    protected $validationRules    = [
    ];
    protected $validationMessages = [

    ];
    protected $skipValidation = false;

    public function ListaDispositivos(){
        return $this->db->query("CALL sp_ListaDispositivos()")->getResult();
    }
    public function estado($id){
        return $this->db->query("CALL sp_Estado(".$id.")")->getResult();
    }

    public function centroComputo($id){
        return $this->db->query("CALL sp_CentroComputo(".$id.")")->getResult();
    }
    public function centros(){
        return $this->db->query("CALL sp_SelectCentroComputos()")->getResult();
    }
}