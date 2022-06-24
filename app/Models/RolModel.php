<?php
namespace app\Models;
use CodeIgniter\Model;

class RolModel extends Model
{
    protected $table      = "tbl_rol";
    protected $primaryKey = "id";

    protected $useAutoIncrement = true;

    protected $returnType     = "array";

    protected $allowedFields = ["nombre"];

    protected $useTimestamps = false;

    protected $validationRules    = [
    ];
    protected $validationMessages = [

    ];
    protected $skipValidation = false;
}
