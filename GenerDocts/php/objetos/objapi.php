<?php

class toApi
{
    // attributes
    public $ipremota;
    public $api;
    public $controlador;
    public $funcion;

    function __construct($ipremota,$api,$controlador,$funcion){
        
        $this->ipremota = $ipremota;
        $this->api  =   $api;
        $this->controlador  =   $controlador;
        $this->funcion  =   $funcion;
    } 

    public function ToController()
    {   
        $parametrosConfiguracion    =   array($this->ipremota,$this->api,$this->controlador,$this->funcion);
        return  $parametrosConfiguracion;

    }


}

// $ip = $_SERVER['HTTP_HOST'];
// $apirest = 'libradoAPi';
// $controladorapi = 'controladorapi';
// $metodo = 'consulta';

// $obj    = new  toApi($ip,$apirest,$controladorapi,$metodo);


// print_r($obj->toController());
// echo($_SERVER['SERVER_ADDR']);