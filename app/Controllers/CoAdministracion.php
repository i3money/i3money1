<?php

namespace App\Controllers;
use App\Models\MoUsuario;
use App\Models\MoSolicitud;

class CoAdministracion extends BaseController
{

    public function allSoliForAdmin(){
        $Soli = new MoSolicitud();

        $data = $Soli->allSoliForAdmin();
        return $this->response->setJSON(['data' => $data]);
    }

    public function allHistoryForAdmin(){
        $Soli = new MoSolicitud();
        
        $data = $Soli->allHistoryForAdmin();
        return $this->response->setJSON(['data' => $data]);
    }

    public function index()
    {
        $User = new MoUsuario();
        $id = session('nu_session_user_id');
        $user = $User->where('id', $id)->first();

        if($user['in_tipo_usuario'] === '1')
        {
            return view('CaAdministracion/ViAdministracion');
        }else{
            return redirect()->to('panel');
        }
    }

    public function aceptarSolicitud($id=null){

        $Soli = new MoSolicitud();
        $User = new MoUsuario();

        $aceptSoli = $Soli->where('id', $id)->first();

        if($aceptSoli)
        {

            $usuario = $User->where('id', $aceptSoli['id_usuario'])->first();

            if($usuario){

                if($aceptSoli['tx_solicitud'] === "Deposito"){
                    $monto = $usuario['tx_saldo_usuario'] + $aceptSoli['tx_cantidad'];

                    $UserData = [
                        'tx_saldo_usuario' => $monto,
                    ];

                    if($User->update($usuario['id'], $UserData))
                    {
                        $data = [
                            'in_estatus' => 2,
                        ];
                        $Soli->update($id, $data);

                        echo json_encode(array("status" => true,"msg"=>"Aceptada Exitosamente!"));       
                    }else{
                        echo json_encode(array("status" => false,"msg"=>"No Aceptada!",'errors' => $Soli->errors()));
                    }

                }else if($aceptSoli['tx_solicitud'] === "Retiro"){
                    $monto = $usuario['tx_saldo_usuario'] - $aceptSoli['tx_cantidad'];

                    $UserData = [
                        'tx_saldo_usuario' => $monto,
                    ];

                    if($User->update($usuario['id'], $UserData))
                    {
                        $data = [
                            'in_estatus' => 2,
                        ];
                        $Soli->update($id, $data);

                        echo json_encode(array("status" => true,"msg"=>"Aceptada Exitosamente!"));       
                    }else{
                        echo json_encode(array("status" => false,"msg"=>"No Aceptada!",'errors' => $Soli->errors()));
                    }

                }else{
                    echo json_encode(array("status" => false,"msg"=>"Ha ocurrido un Error"));
                }

            }else{
            echo json_encode(array("status" => false,"msg"=>"Usuario no encontrado!"));
            }

        }else{
            echo json_encode(array("status" => false,"msg"=>"id no encontrado!"));
        } 

    }

    public function rechazarSolicitud($id=null){

        $Soli = new MoSolicitud();

        $delSoli = $Soli->where('id', $id)->first();

        if($delSoli)
        {
            $data = [
                'in_estatus' => 0,
            ];

            if($Soli->update($id, $data))
            {
                echo json_encode(array("status" => true,"msg"=>"Rechazada Exitosamente!"));       
            }else{
                echo json_encode(array("status" => false,"msg"=>"No Rechazada!",'errors' => $Soli->errors()));
            }

        }else{
            echo json_encode(array("status" => false,"msg"=>"id no encontrado!"));
        } 

    }
}