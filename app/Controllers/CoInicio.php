<?php

namespace App\Controllers;
use App\Models\MoUsuario;

class CoInicio extends BaseController
{
    public function index(): string
    {
        return view('CaLogin/ViLogin');
    }

    public function register(): string
    {
        return view('CaLogin/ViRegister');
    }

    public function login()
    {
        $session    = session();
        $Usuario    = new MoUsuario();
        $alias      = $this->request->getPost('tx_alias_usuario');
        $clave   = $this->request->getPost('tx_clave_usuario');
        
        if($alias != ''){

            if($clave != ''){

                $data = $Usuario->where('tx_alias_usuario', $alias)->first();
                
                if($data){

                    if($data['in_estatus'] != 0)
                    {

                        $pass = $data['tx_clave_usuario'];
                        $authenticatePassword = password_verify($clave, $pass);
                        if($authenticatePassword){
                            $session_data = [
                                'nu_session_user_id'        => $data['id'],
                                'tx_nombre_usuario'         => $data['tx_nombre_usuario'],
                                'tx_apellido_usuario'       => $data['tx_apellido_usuario'],
                                'tx_alias_usuario'          => $data['tx_alias_usuario'],
                                'isLoggedIn'                => TRUE
                            ];
                            $session->set($session_data);

                            if($data['in_tipo_usuario'] === '1'){
                                echo json_encode(array("status" => true,"msg"=>"Bienvenido de vuelta", "user" => '1'));
                            }else{
                                echo json_encode(array("status" => true,"msg"=>"Bienvenido de vuelta", "user" => '2'));
                            }
                        
                        }else{

                            echo json_encode(array("status" => false,"msg"=>"Contraseña Incorrecta"));
                        }

                    }else{
                        echo json_encode(array("status" => false,"msg"=>"Usuario Inactivo"));
                    }

                }else{

                    echo json_encode(array("status" => false,"msg"=> $alias." Usuario No Registrado"));
                }

            }else{
                echo json_encode(array("status" => false,"msg"=> 'Contraseña Requerida'));
            }

        }else{
            echo json_encode(array("status" => false,"msg"=> 'Usuario Requerido'));
        }

    }

    public function registerValidate(){
        $validation = \Config\Services::validation();
        $this->validate([
            'tx_nombre_usuario'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'  =>'Nombre del Usuario Requerido',
                ]
            ]
        ]);
        $this->validate([
            'tx_apellido_usuario'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'  =>'Apellido del Usuario Requerido',
                ]
            ]
        ]);
        $this->validate([
            'tx_alias_usuario'=>[
                'rules'=>'required|min_length[4]|max_length[50]|is_unique[i001t_usuario.tx_alias_usuario]',
                'errors'=>[
                    'required'  =>'Alias del Usuario Requerido',
                    'min_length' => 'Alias, Minimo Cuatro Dígitos',
                    'max_length' => 'Alias, Maximo Cincuenta Dígitos',
                    'is_unique' => 'Alias no Disponible'
                ]
            ]
        ]);
        $this->validate([
            'tx_clave_usuario'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'  =>'Contraseña del Usuario Requerida',
                ]
            ]
        ]);

        if($validation->run() == FALSE){
            $errors = $validation->getErrors();
            echo json_encode(['code'=>0, 'error'=>$errors]);
        }else{

        $User = new MoUsuario();    
        $data = [
        'tx_nombre_usuario'                      => $this->request->getPost('tx_nombre_usuario'),
        'tx_apellido_usuario'                    => $this->request->getPost('tx_apellido_usuario'),
        'tx_alias_usuario'                       => $this->request->getPost('tx_alias_usuario'),
        'tx_clave_usuario'                       => password_hash($this->request->getPost('tx_clave_usuario'), PASSWORD_DEFAULT),
        'in_tipo_usuario'                        => 2,
        'tx_saldo_usuario'                       => '0.00',
        'in_estatus'                             => 1,

        ];

        if($User->insert($data)){
            echo json_encode(array("status" => true,"msg"=>"Guardado Exitosamente!"));       
            }
            else
            {
            echo json_encode(array("status" => false,"msg"=>"No Guardado!",'errors' => $User->errors()));
            }
        }
    }

    public function Logout()
    {
        $session = session();

        $session->destroy();
        return redirect()->to('login');
    }

}
