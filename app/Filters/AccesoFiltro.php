<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AccesoFiltro implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do something here
        if(session()->rol != 1){
            $alertType = "alert-danger";
            $alertTitle = "Acceso Restringido";
            $alertMessage = "No tienes permiso para acceder a este modulo";

            return redirect()->to('/dashboard')->with('alert-type',$alertType)
            ->with('alert-title',$alertTitle)
            ->with('alert-message',$alertMessage);
        }
       
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}