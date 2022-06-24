<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class PruebaFiltro implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do something here
        
        if(!session()->get('sesion')){
            $alertTitle = "Tiempo de Sesion expirada";
            $alertType = "alert-danger";
            $alertMessage = "Su sesión ha excedido el tiempo límite. Por favor, entre de nuevo.";
            return redirect()->to('/login')->with('alert-type',$alertType)
            ->with('alert-title',$alertTitle)
            ->with('alert-message',$alertMessage);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
        
    }
}