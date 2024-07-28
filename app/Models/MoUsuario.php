<?php

namespace App\Models;

use CodeIgniter\Model;

class MoUsuario extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'i001t_usuario';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
                                    'tx_nombre_usuario',
                                    'tx_apellido_usuario',
                                    'tx_alias_usuario',
                                    'tx_clave_usuario',
                                    'in_tipo_usuario',
                                    'tx_saldo_usuario',
                                    'in_estatus',
                                    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'fecha_add';
    protected $updatedField  = '';
    protected $deletedField  = '';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function allUser()
    {
        $this->select('i001t_usuario.*');
        // $this->join('i002t_rol', 'i001t_usuario.id_rol = i002t_rol.id');
        $this->orderBy('i001t_usuario.id', 'DESC');
        $datos = $this->findAll();
    
        return $datos;
    }    
    

}