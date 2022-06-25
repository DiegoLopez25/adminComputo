<?php
namespace app\Models;
use CodeIgniter\Model;

class BitacoraModel extends Model
{
    protected $table      = "tbl_bitacora";
    protected $primaryKey = "id";

    protected $useAutoIncrement = true;

    protected $returnType     = "array";

    protected $allowedFields = ["accion","fecha_hora","id_usuario"];

    protected $useTimestamps = false;

    protected $validationRules    = [
    ];
    protected $validationMessages = [

    ];
    protected $skipValidation = false;

    public function ListaBitacora(){
        return $this->db->query("CALL sp_ListaBitacora()")->getResult();
    }
}