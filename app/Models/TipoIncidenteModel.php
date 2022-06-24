<?php
namespace app\Models;
use CodeIgniter\Model;

class TipoIncidenteModel extends Model
{
    protected $table      = "tbl_tipo_incidente";
    protected $primaryKey = "id";

    protected $useAutoIncrement = true;

    protected $returnType     = "array";

    protected $allowedFields = ["nombre","descripcion"];

    protected $useTimestamps = false;

    protected $validationRules    = [
    ];
    protected $validationMessages = [

    ];
    protected $skipValidation = false;
}