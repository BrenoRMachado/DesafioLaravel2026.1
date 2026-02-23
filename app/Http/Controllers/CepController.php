<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CepController extends Controller
{
    public function check ($cep){
        $cep_info = checkCep($cep);

        $status = 200;
        if(isset($cep_info["erro"])){
            $status = 400;
        }
        return response()->json($cep_info , $status);

    }
}
