<?php
namespace App\Controllers;

class IncidenteController extends BaseController{
    public function index(){
        return view('incidente/index');
    }
}