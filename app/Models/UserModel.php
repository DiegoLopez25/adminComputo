<?php
namespace app\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = "tbl_usuario";
    protected $primaryKey = "id";

    protected $useAutoIncrement = true;

    protected $returnType     = "array";

    protected $allowedFields = ["nombre", "apellido", "email", "dui","usuario","password"];

    protected $useTimestamps = false;

    protected $validationRules    = [
    ];
    protected $validationMessages = [

    ];
    protected $skipValidation = false;

    public function verificarUsuario($user,$pass){
        $query =$this->db->query("");   
    }
}