<?php

namespace App\Controllers;
use App\Models\MoUsuario;
use App\Models\MoSolicitud;

class CoPanel extends BaseController
{

    public function allMySoli(){
        $Soli = new MoSolicitud();
        $id = session('nu_session_user_id');
        $data = $Soli->where('id_usuario', $id)->where('in_estatus', 1)->findAll();
        return $this->response->setJSON(['data' => $data]);
    }

    public function allMySoliHistory(){
        $Soli = new MoSolicitud();
        $id = session('nu_session_user_id');
        $data = $Soli->where('id_usuario', $id)->where('in_estatus !=', 1)->findAll();
        return $this->response->setJSON(['data' => $data]);
    }

    // public function allRol(){
    //     $Rol = new MoRol();
    //     $data= $Rol->orderBy('id', 'DESC')->findAll();
    //     return $this->response->setJSON(['data' => $data]);
    // }

    public function index()
    {
        $User = new MoUsuario();
        $id = session('nu_session_user_id');
        $usuario = $User->where('id', $id)->first();

        $data['saldo_usuario'] = $usuario['tx_saldo_usuario'];

        if($usuario['in_tipo_usuario'] != '1')
        {
            return view('CaPanel/ViPanel', $data); 
        }else{
            return redirect()->to('panel');
        }
    }

    public function addSolicitudDeposito(){
        $Soli = new MoSolicitud();
        $User = new MoUsuario();  

        $validation = \Config\Services::validation();
        $this->validate([
            'tx_cantidad'=>[
                'rules'=>'required|numeric',
                'errors'=>[
                    'required'  =>'Cantidad Requerida',
                    'numeric' => 'Cantidad debe ser Numerica',
                ]
            ]
        ]);

        if($validation->run() == FALSE){
            $errors = $validation->getErrors();
            echo json_encode(['code'=>0, 'error'=>$errors]);
        }else{

            $idUser = session('nu_session_user_id');
            $existUser = $User->where('id', $idUser)->first(); 

            if($existUser){
    
                $data = [
                    'id_usuario'                      => $idUser,
                    'tx_solicitud'                    => "Deposito",
                    'tx_cantidad'                     => $this->request->getPost('tx_cantidad'),
                    'in_estatus'                      => 1,
                ];

                if($Soli->insert($data)){
                    echo json_encode(array("status" => true,"msg"=>"Guardado Exitosamente!"));       
                    }else{
                    echo json_encode(array("status" => false,"msg"=>"No Guardado!",'errors' => $Soli->errors()));
                }

            }else{
                echo json_encode(array("status" => false,"msg"=>"Id de usuario no encontrado!"));
            }

        }

    }

    public function addSolicitudRetiro(){
        $Soli = new MoSolicitud();
        $User = new MoUsuario();  

        $validation = \Config\Services::validation();
        $this->validate([
            'tx_cantidad'=>[
                'rules'=>'required|numeric',
                'errors'=>[
                    'required'  =>'Cantidad Requerida',
                    'numeric' => 'Cantidad debe ser Numerica',
                ]
            ]
        ]);

        if($validation->run() == FALSE){
            $errors = $validation->getErrors();
            echo json_encode(['code'=>0, 'error'=>$errors]);
        }else{

            $idUser = session('nu_session_user_id');
            $existUser = $User->where('id', $idUser)->first(); 

            if($existUser){
    
                $data = [
                    'id_usuario'                      => $idUser,
                    'tx_solicitud'                    => "Retiro",
                    'tx_cantidad'                     => $this->request->getPost('tx_cantidad'),
                    'in_estatus'                      => 1,
                ];

                if($Soli->insert($data)){
                    echo json_encode(array("status" => true,"msg"=>"Guardado Exitosamente!"));       
                    }else{
                    echo json_encode(array("status" => false,"msg"=>"No Guardado!",'errors' => $Soli->errors()));
                }

            }else{
                echo json_encode(array("status" => false,"msg"=>"Id de usuario no encontrado!"));
            }

        }

    }

    public function delSolicitud($id=null){

        $Soli = new MoSolicitud();

        $delSoli = $Soli->where('id', $id)->first();

        if($delSoli)
        {
            $delete = $Soli->where('id', $id)->delete();
            if($delete)
            {
            echo json_encode(array("status" => true,"msg"=>"Solicitud Eliminada!"));
            }else{
            echo json_encode(array("status" => false,"msg"=>"No Eliminada!"));
            }

        }else{
            echo json_encode(array("status" => false,"msg"=>"id no encontrado!"));
        } 

    }

}