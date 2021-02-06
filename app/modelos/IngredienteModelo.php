<?php

class IngredienteModelo
{

	//creamos la variable donde se instanciará la clase "conectar"
    public $conexion;

    public function __construct() {

    	//inicializamos la clase para conectarnos a la bd
        $this->conexion = new ConexionBD(); //instanciamos la clase

    }



    public function consultar($datos)
    {
        $datosFiltrados = $this->filtrarDatos($datos);

        $ban  = $datosFiltrados['ban'];
        $cve_ingrediente = (!empty($datosFiltrados['cve_ingrediente']) || $datosFiltrados['cve_ingrediente']!=null) ? $datosFiltrados['cve_ingrediente'] : '0';

        $query = "CALL obtenIngrediente('$ban','$cve_ingrediente')";

        $c_ingrediente = $this->conexion->query($query);
        $r_ingrediente = $this->conexion->consulta_array($c_ingrediente);

        return $r_ingrediente;
    }



    public function guardarIngrediente($datosIngrediente)
    {

        $datosFiltrados = $this->filtrarDatos($datosIngrediente);

        $ban                = $datosFiltrados['ban'];
        $cve_ingrediente    = $datosFiltrados['cve_ingrediente'];
        $nombre_ingrediente = $datosFiltrados['nombre_ingrediente'];

        $query = "CALL guardarIngrediente(
                                            '$ban',
                                            '$cve_ingrediente',
                                            '$nombre_ingrediente'
                                        )";

        $respuesta = $this->conexion->query($query) or die ($this->conexion->error());
        
        $this->conexion->close_conexion();
        
        return $respuesta;

    }



    public function bloquearIngrediente($datosIngrediente)
    {
        $datosFiltrados = $this->filtrarDatos($datosIngrediente);

        $ban               = $datosFiltrados['ban'];
        $cve_ingrediente  = $datosFiltrados['cve_ingrediente'];

        $query = "CALL eliminarIngrediente('$ban','$cve_ingrediente')";

        $respuesta = $this->conexion->query($query);

        return $respuesta;
    }

    

    public function filtrarDatos($datosFiltrar){

        foreach ($datosFiltrar as $indice => $valor) {
            $datosFiltrarr[$indice] = $this->conexion->real_escape_string($valor);
        }

        return $datosFiltrarr;

    }
	
}

?>