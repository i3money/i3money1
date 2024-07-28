<?php

namespace App\Controllers;
use App\Models\MoUsuario;
use App\Models\MoSolicitud;

class CoUsuario extends BaseController
{

    public function allUser(){
        $User = new MoUsuario();
        $data= $User->allUser();
        return $this->response->setJSON(['data' => $data]);
    }

    public function allActiveUser(){
        $User = new MoUsuario();
        $data= $User->orderBy('id', 'DESC')->where('in_estatus', 1)->findAll();
        return $this->response->setJSON(['data' => $data]);
    }

    public function index()
    {
        $User = new MoUsuario();
        $id = session('nu_session_user_id');
        $user = $User->where('id', $id)->first();

        if($user['in_tipo_usuario'] === '1')
        {
            return view('CaUsuario/ViUsuario');
        }else{
            return redirect()->to('panel');
        }
    }

    public function addUser()
    {
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
        $this->validate([
            'tx_confirma_clave_usuario'=>[
                'rules'=>'required|matches[tx_clave_usuario]',
                'errors'=>[
                    'required'  =>'Confirmar Contraseña Requerido',
                    'matches' => 'Contraseñas no Coinciden',
                ]
            ]
        ]);
        $this->validate([
            'in_tipo_usuario'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'  =>'Tipo de Usuario Requerido',
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
        'in_tipo_usuario'                        => $this->request->getPost('in_tipo_usuario'),
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

    public function edtUser($id = null)
    {
        $User = new MoUsuario();
	
        $data = $User->where('id', $id)->first();
        
       if($data){
               echo json_encode(array("status" => true , 'data' => $data));
           }else{
               echo json_encode(array("status" => false, 'data' => $data));
           }
    }

    public function updUser($id=null)
    {
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

        if($validation->run() == FALSE){
            $errors = $validation->getErrors();
            echo json_encode(['code'=>0, 'error'=>$errors]);
        }else{

        $User = new MoUsuario();  
        $updUser = $User->where('id', $id)->first(); 

        if($updUser){
  
            $data = [
                'tx_nombre_usuario'                      => $this->request->getPost('tx_nombre_usuario'),
                'tx_apellido_usuario'                    => $this->request->getPost('tx_apellido_usuario'),
            ];

            if($User->update($id, $data))
            {
                echo json_encode(array("status" => true,"msg"=>"Actualizado Exitosamente!"));       
            }else{
                echo json_encode(array("status" => false,"msg"=>"No Guardado!",'errors' => $User->errors()));
            }

        }else{
            echo json_encode(array("status" => false,"msg"=>"id no Encontrado!"));
        }

        }  

    }

    public function estatusUser($id=null){
		$User = new MoUsuario();

        $estatusUser = $User->where('id', $id)->first();

        if($estatusUser['in_estatus'] != 0){

            $data = [
            'in_estatus'                     => 0,
            ];

            if($User->update($id, $data))
            {
                echo json_encode(array("status" => true,"msg"=>"Estatus Actualizado Exitosamente!"));       
            }else{
                echo json_encode(array("status" => false,"msg"=>"Estatus No Actualizado!",'errors' => $User->errors()));
            }

        }else{

            $data = [
            'in_estatus'                     => 1,
            ];

            if($User->update($id, $data))
            {
                echo json_encode(array("status" => true,"msg"=>"Estatus Actualizado Exitosamente!"));       
            }else{
                echo json_encode(array("status" => false,"msg"=>"Estatus No Actualizado!",'errors' => $User->errors()));
            }

        }

    }

    // public function delUser($id=null){

    //     $User = new MoUsuario();
    //     $Module = new MoModulo();
    //     $Permission = new MoPermisoRol();
    //     $idUser = session('nu_session_user_id');
    //     $user = $User->where('id', $idUser)->first();
    //     $idRol = $user['id_rol'];
    //     $idModule = $Module->where('tx_nombre_modulo', "user")->first();
    //     $id_module = $idModule['id'];
    //     $verify = $Permission->where('id_modulo', $id_module)->where('id_rol', $idRol)->first();

    //     if($verify)
    //     {
    //         $User = new MoUsuario();

    //         $delUser = $User->where('id', $id)->first();
    
    //         if($delUser)
    //         {
    //             $delete = $User->where('id', $id)->delete();
    //             if($delete)
    //             {
    //             echo json_encode(array("status" => true,"msg"=>"Usuario Eliminado!"));
    //             }else
    //             {
    //             echo json_encode(array("status" => false,"msg"=>"No Eliminado!"));
    //             }
    
    //         }
    //         else
    //         {
    //             echo json_encode(array("status" => false,"msg"=>"id no encontrado!"));
    //         } 
    //     }else{
    //         return redirect()->to('dashboard');
    //     } 

    // }

    public function userProfile() 
    {
        $User = new MoUsuario(); 
        $id = session('nu_session_user_id');
        $data['user'] = $User->where('id', $id)->first();

        return view('CaUsuario/ViPerfil', $data);
    }

    public function updProfile()
    {
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

        if($validation->run() == FALSE){
            $errors = $validation->getErrors();
            echo json_encode(['code'=>0, 'error'=>$errors]);
        }else{

        $User = new MoUsuario();  
        $id = session('nu_session_user_id');
        $updUser = $User->where('id', $id)->first(); 

        if($updUser){
  
            $data = [
            'tx_nombre_usuario'                      => strtoupper($this->request->getPost('tx_nombre_usuario')),
            'tx_apellido_usuario'                    => strtoupper($this->request->getPost('tx_apellido_usuario')),
            ];

            if($User->update($id, $data))
            {
                echo json_encode(array("status" => true,"msg"=>"Actualizado Exitosamente!", "data" => $data));       
            }else{
                echo json_encode(array("status" => false,"msg"=>"No Actualizado!",'errors' => $User->errors()));
            }

        }else{
            echo json_encode(array("status" => false,"msg"=>"id no Encontrado!"));
        }

        }  

    }

    public function updProfileEmail()
    {
        $validation = \Config\Services::validation();
        $this->validate([
            'tx_correo_usuario'=>[
                'rules'=>'required|valid_email|is_unique[i001t_usuario.tx_correo_usuario]',
                'errors'=>[
                    'required'  =>'Correo del Usuario Requerido',
                    'valid_email' => 'Ingrese una dirección de Correo Valida',
                    'is_unique' => 'Correo ya Registrado'
                ]
            ]
        ]);

        if($validation->run() == FALSE){
            $errors = $validation->getErrors();
            echo json_encode(['code'=>0, 'error'=>$errors]);
        }else{

        $User = new MoUsuario();  
        $id = session('nu_session_user_id');
        $updUser = $User->where('id', $id)->first(); 

        if($updUser){
  
            $data = [
            'tx_correo_usuario'                      => $this->request->getPost('tx_correo_usuario'),
            ];

            if($User->update($id, $data))
            {
                echo json_encode(array("status" => true,"msg"=>"Correo Actualizado Exitosamente!", "data" => $data));       
            }else{
                echo json_encode(array("status" => false,"msg"=>"No Actualizado!",'errors' => $User->errors()));
            }

        }else{
            echo json_encode(array("status" => false,"msg"=>"id no Encontrado!"));
        }

        }  

    }

    public function updProfileAlias()
    {
        $validation = \Config\Services::validation();
        $this->validate([
            'tx_alias_usuario'=>[
                'rules'=>'required|min_length[4]|max_length[50]|is_unique[i001t_usuario.tx_alias_usuario]',
                'errors'=>[
                    'required'  =>'Alias del Usuario Requerido',
                    'min_length' => 'Alias, Minimo Cuatro Dígitos',
                    'max_length' => 'Alias, Maximo Cincuenta Dígitos',
                    'is_unique' => 'Alias ya Registrado'
                ]
            ]
        ]);

        if($validation->run() == FALSE){
            $errors = $validation->getErrors();
            echo json_encode(['code'=>0, 'error'=>$errors]);
        }else{

        $User = new MoUsuario();  
        $id = session('nu_session_user_id');
        $updUser = $User->where('id', $id)->first(); 

        if($updUser){
  
            $data = [
            'tx_alias_usuario'                      => $this->request->getPost('tx_alias_usuario'),
            ];

            if($User->update($id, $data))
            {
                echo json_encode(array("status" => true,"msg"=>"Alias Actualizado Exitosamente!", "data" => $data));       
            }else{
                echo json_encode(array("status" => false,"msg"=>"No Actualizado!",'errors' => $User->errors()));
            }

        }else{
            echo json_encode(array("status" => false,"msg"=>"id no Encontrado!"));
        }

        }  

    }

    public function updProfilePassword()
    {
        $validation = \Config\Services::validation();
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
        $id = session('nu_session_user_id');
        $updUser = $User->where('id', $id)->first(); 

        if($updUser){
  
            $data = [
            'tx_clave_usuario'     => password_hash($this->request->getPost('tx_clave_usuario'), PASSWORD_DEFAULT),
            ];

            if($User->update($id, $data))
            {
                echo json_encode(array("status" => true,"msg"=>"Contraseña Actualizada Exitosamente!", "data" => $data));       
            }else{
                echo json_encode(array("status" => false,"msg"=>"No Actualizada!",'errors' => $User->errors()));
            }

        }else{
            echo json_encode(array("status" => false,"msg"=>"id no Encontrado!"));
        }

        }  

    }

    public function updProfileImage()
    {
        $User = new MoUsuario();  
        $id = session('nu_session_user_id');
        $updUser = $User->where('id', $id)->first(); 

        if($updUser){
  
            $data = [
                'tx_imagen_usuario'                      => $this->uploadImagen($this->request->getFile('tx_imagen_usuario')),
            ];

            if($User->update($id, $data))
            {
                echo json_encode(array("status" => true,"msg"=>"Imagen Actualizada Exitosamente!", "data" => $data));       
            }else{
                echo json_encode(array("status" => false,"msg"=>"No Actualizada!",'errors' => $User->errors()));
            }

        }else{
            echo json_encode(array("status" => false,"msg"=>"id no Encontrado!"));
        }
    }
    
    public function updSignatureImage()
    {
        $validation = \config\Services::validation();
        $this->validate([
            'tx_imagen_firma'=>[
                'rules' => 'uploaded[tx_imagen_firma]',
                'errors' => [
                    'uploaded' => 'Firma Digital Requerida',
                ]
            ]
        ]);

        if($validation->run() == FALSE){
            $errors = $validation->getErrors();
            echo json_encode(['code'=>0, 'error'=>$errors]);
        }else{

        $User = new MoUsuario();  
        $id = session('nu_session_user_id');
        $updUser = $User->where('id', $id)->first(); 

            if($updUser){

                $file = $this->request->getFile('tx_imagen_firma');
        
                $allowedTypes = ['image/png'];
                $msg = "Formato de firma digital debe ser de tipo PNG";
                if (!in_array($file->getClientMimeType(), $allowedTypes)) {
                    echo json_encode(array("status" => false, "msg" => $msg));
                    return;
                }
    
                $data = [
                    'tx_imagen_firma'                      => $this->uploadSignatureImage($this->request->getFile('tx_imagen_firma')),
                ];

                if($User->update($id, $data))
                {
                    echo json_encode(array("status" => true,"msg"=>"Firma Digital Actualizada Exitosamente!", "data" => $data));       
                }else{
                    echo json_encode(array("status" => false,"msg"=>"No Actualizada!",'errors' => $User->errors()));
                }

            }else{
                echo json_encode(array("status" => false,"msg"=>"id no Encontrado!"));
            }

        }
    }

    public function userDocument()
    {
        // $Document = new MoDocumentoUsuario();

        // $data['doc'] = $Document->where('id', 2)->first();
        return view('CaUsuario/ViDocumento');
    }

    public function addDocumentUser()
    {
        $validation = \Config\Services::validation();
        $this->validate([
            'tx_nombre_documento'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'  =>'Asigne un Nombre al Documento',
                ]
            ]
        ]);
        if($validation->run() == FALSE){
            $errors = $validation->getErrors();
            echo json_encode(['code'=>0, 'error'=>$errors]);
        }else{

        $doc = $this->request->getFile('tx_url_documento');
        $allowedTypes = ['application/pdf'];
        if (!in_array($doc->getClientMimeType(), $allowedTypes)) {
            echo json_encode(['code'=>0, 'error'=>"Documento debe ser de tipo PDF."]);
        }        

        $Document = new MoDocumentoUsuario();   
        $idUser = session('nu_session_user_id');
        $data = [
        'id_usuario'                             => $idUser,
        'tx_nombre_documento'                    => strtoupper($this->request->getPost('tx_nombre_documento')),
        'tx_url_documento'                       => $this->uploadDocumento($this->request->getFile('tx_url_documento')),
        'in_estatus_documento'                   => 1,

        ];

        if($Document->insert($data)){
            echo json_encode(array("status" => true,"msg"=>"Guardado Exitosamente!"));       
            }
            else
            {
            echo json_encode(array("status" => false,"msg"=>"No Guardado!",'errors' => $Document->errors()));
            }
        }

    }  

    public function delDocumentUser($id=null){


        $Document = new MoDocumentoUsuario();

        $delDocument = $Document->where('id', $id)->first();

        if($delDocument)
        {
            $delete = $Document->where('id', $id)->delete();
            if($delete)
            {
            echo json_encode(array("status" => true,"msg"=>"Documento Eliminado!"));
            }else
            {
            echo json_encode(array("status" => false,"msg"=>"No Eliminado!"));
            }

        }
        else
        {
            echo json_encode(array("status" => false,"msg"=>"id no encontrado!"));
        } 

    }

    public function uploadImagen($archivo = null)
    {
        $img = $archivo;
        if ($img != '') {
            $imagen = $img->getName();
            
            $extension = pathinfo($imagen, PATHINFO_EXTENSION);
            
            $nameRandom = uniqid();
            
            $imagenUnica = $nameRandom . '.' . $extension;
            
            $img->move(ROOTPATH . 'public/uploads/usuario_perfil', $imagenUnica);
            return $imagenUnica;
        }

        return "user.jpeg";
    } 

    public function uploadSignatureImage($archivo = null)
    {
        $img = $archivo;
        if ($img != '') {
            $imagen = $img->getName();
            
            $extension = pathinfo($imagen, PATHINFO_EXTENSION);
            
            $nameRandom = uniqid();
            
            $imagenUnica = $nameRandom . '.' . $extension;
            
            $img->move(ROOTPATH . 'public/uploads/usuario_firma', $imagenUnica);
            return $imagenUnica;
        }

        return "firma.png";
    } 
    
    public function uploadDocumento($archivo = null)
    {
        $doc = $archivo;
        if ($doc != '') {
            $documento = $doc->getName();
            
            $extension = pathinfo($documento, PATHINFO_EXTENSION);
            
            $nameRandom = uniqid();
            
            $Documento = $nameRandom . '.' . $extension;
            
            $doc->move(ROOTPATH . 'public/uploads/usuario_documento', $Documento);
            return $Documento;
        }
    } 

}