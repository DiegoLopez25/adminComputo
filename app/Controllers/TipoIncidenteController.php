<?php
namespace App\Controllers;

class TipoIncidenteController extends BaseController{
    public function index(){
        return view('tipo-incidente/index');
    }
}