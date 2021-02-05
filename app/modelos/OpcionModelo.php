<?php

class OpcionModelo
{

    //creamos la variable donde se instanciará la clase "conectar"
    public $conexion;

    public function __construct() {

        //inicializamos la clase para conectarnos a la bd
        $this->conexion = new ConexionBD(); //instanciamos la clase

    }

    public function filtrarDatos($datosFiltrar){

        foreach ($datosFiltrar as $indice => $valor) {
            $datosFiltrar[$indice] = $this->conexion->real_escape_string($valor);
        }

        return $datosFiltrar;

    }
    
}

?>