<?php

namespace App\Filters;

use App\Models\MoUsuario;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class CheckPermissions implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $User = new MoUsuario();
        $user = $User->where('id', session('nu_session_user_id'))->first();
        $userActive = $user['in_estatus_usuario'];
        if ($userActive != 0) 
        {
            return redirect()->to('dashboard');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}