<?php
namespace app\Models;
use CodeIgniter\Model;

class EstadoModel extends Model
{
    protected $table      = "tbl_estado";
    protected $primaryKey = "id";

    protected $useAutoIncrement = true;

    protected $returnType     = "array";

    protected $allowedFields = ["estado"];

    protected $useTimestamps = false;

    protected $validationRules    = [
    ];
    protected $validationMessages = [

    ];
    protected $skipValidation = false;
}