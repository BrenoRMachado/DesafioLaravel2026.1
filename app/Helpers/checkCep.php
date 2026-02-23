<?php

use Illuminate\Support\Facades\Http;

if(!function_exists("checkCep")){
    function checkCep(string $cep){
        $response = Http::get("viacep.com.br/ws/". $cep ."/json/");
        return $response->json();
    }
}