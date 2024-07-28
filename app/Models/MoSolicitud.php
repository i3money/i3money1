<?php

namespace App\Models;

use CodeIgniter\Model;

class MoSolicitud extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'i002t_solicitud';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
                                    'id_usuario',
                                    'tx_solicitud',
                                    'tx_cantidad',
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

    // public function allUser()
    // {
    //     $this->select('i001t_usuario.*');
    //     // $this->join('i002t_rol', 'i001t_usuario.id_rol = i002t_rol.id');
    //     $this->orderBy('i001t_usuario.id', 'DESC');
    //     $datos = $this->findAll();
    
    //     return $datos;
    // }    
    
    public function allSoliForAdmin()
    {
        $this->select('i002t_solicitud.*, i001t_usuario.tx_nombre_usuario AS tx_nombre_usuario, i001t_usuario.tx_apellido_usuario AS tx_apellido_usuario, i001t_usuario.tx_alias_usuario AS tx_alias_usuario');
        $this->join('i001t_usuario', 'i002t_solicitud.id_usuario = i001t_usuario.id');
        $this->where('i002t_solicitud.in_estatus',  '1');
        $this->orderBy('i002t_solicitud.id', 'DESC');
        $datos = $this->findAll();
    
        return $datos;
    } 

    public function allHistoryForAdmin()
    {
        $this->select('i002t_solicitud.*, i001t_usuario.tx_nombre_usuario AS tx_nombre_usuario, i001t_usuario.tx_apellido_usuario AS tx_apellido_usuario, i001t_usuario.tx_alias_usuario AS tx_alias_usuario');
        $this->join('i001t_usuario', 'i002t_solicitud.id_usuario = i001t_usuario.id');
        $this->whereIn('i002t_solicitud.in_estatus',  ['0', '2']);
        $this->orderBy('i002t_solicitud.id', 'DESC');
        $datos = $this->findAll();
    
        return $datos;
    } 

}