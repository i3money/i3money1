<?php

namespace App\Controllers;
use App\Models\MoUsuario;

class CoBase extends BaseController
{

    public function index(){}

    public function verifyPermissions($module = null){
        $User = new MoUsuario();

        $id = session('nu_session_user_id');
        $user = $User->where('id', $id)->first();

        if($user['in_tipo_usuario'] === '1' && $module === 'panel')
        {
            echo json_encode(array("status" => false));
        }else if($user['in_tipo_usuario'] === '1'){
            
            echo json_encode(array("status" => true));
               
        }else{
            echo json_encode(array("status" => false));
        }

    }

}