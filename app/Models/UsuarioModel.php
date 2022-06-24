<?php
namespace app\Models;
use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table      = "tbl_usuario";
    protected $primaryKey = "id";

    protected $useAutoIncrement = true;

    protected $returnType     = "array";

    protected $allowedFields = ["nombre", "apellido", "email", "dui","usuario","password","id_estado","id_rol"];

    protected $useTimestamps = false;

    protected $validationRules    = [
    ];
    protected $validationMessages = [

    ];
    protected $skipValidation = false;

    public function ListaUsuarios(){
        return $this->db->query("CALL sp_ListaUsuarios()")->getResult();
    }
    public function estado($id){
        return $this->db->query("CALL sp_Estado(".$id.")")->getResult();
    }
    public function rol($id){
        return $this->db->query("CALL sp_Rol(".$id.")")->getResult();
    }
}