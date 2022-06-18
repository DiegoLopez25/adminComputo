<?php
namespace app\Models;
use CodeIgniter\Model;

class CentroComputoModel extends Model
{
    protected $table      = "tbl_centro_computo";
    protected $primaryKey = "id";

    protected $useAutoIncrement = true;

    protected $returnType     = "array";

    protected $allowedFields = ["nombre", "descripcion", "id_estado"];

    protected $useTimestamps = false;

    protected $validationRules    = [
    ];
    protected $validationMessages = [

    ];
    protected $skipValidation = false;

    public function ListaCentroComputo()
    {   
        return $this->db->query("CALL sp_ListaCentroComputo()")->getResult();;
    }

    public function estado($id){
        return $this->db->query("CALL sp_Estado(".$id.")")->getResult();
    }
}