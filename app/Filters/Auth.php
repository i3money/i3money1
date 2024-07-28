<?php

namespace App\Filters;

use App\Models\MoUsuario;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->has('isLoggedIn')) 
        {
            return redirect()->to('login');
        }

    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // $User = new MoUsuario();
        // $user = $User->where('id', session('nu_session_user_id'))->first();
        // $url = $request->uri->getSegment(1);
        // $userRol = $user['id_rol'];

        // if ($url != 'rol') 
        // {
        //     return redirect()->to('dashboard');
        // }
    }
}
