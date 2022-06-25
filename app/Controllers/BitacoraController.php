<?php
namespace App\Controllers;

use App\Models\BitacoraModel;

class BitacoraController extends BaseController
{
    protected BitacoraModel $model;
    function __construct()
    {
        $this->model = new BitacoraModel();
    }

    public function index()
    {
        $bitacora = $this->model->ListaBitacora();
        $data=[
            'bitacora'=>$bitacora,
            'title'=>'Bitacora',
        ];
        return view('bitacora/index',$data);
    }
}