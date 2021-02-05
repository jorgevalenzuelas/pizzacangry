<?php

class BasesModelo
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
        $cve_base = (!empty($datosFiltrados['cve_base']) || $datosFiltrados['cve_base']!=null) ? $datosFiltrados['cve_base'] : '';

        $query = "CALL obtenBases('$ban','$cve_base')";

        $c_categoria = $this->conexion->query($query);
        $r_categoria = $this->conexion->consulta_array($c_categoria);

        return $r_categoria;
    }



    public function guardarBase($datosBase)
    {

        $datosFiltrados = $this->filtrarDatos($datosBase);

        $ban                = $datosFiltrados['ban'];
        $nombreBase         = $datosFiltrados['nombreBase'];
        $depositoBase       = $datosFiltrados['depositoBase'];
        $existenciaBase     = $datosFiltrados['existenciaBase'];
        $cveBase            = $datosFiltrados['cve_base'];
        $cveusuario_accion  = $datosFiltrados['cveusuario_accion'];

        $query = "CALL guardarBase(
                                        '$ban',
                                        '$cveBase',
                                        '$nombreBase',
                                        '$depositoBase',
                                        '$existenciaBase',
                                        '$cveusuario_accion'
                                        )";

        $respuesta = $this->conexion->query($query) or die ($this->conexion->error());
        
        $this->conexion->close_conexion();
        
        return $respuesta;

    }



    public function bloquearBase($datosBase)
    {
        $datosFiltrados = $this->filtrarDatos($datosBase);

        $ban               = $datosFiltrados['ban'];
        $cve_base          = $datosFiltrados['cve_base'];
        $cveusuario_accion = $datosFiltrados['cveusuario_accion'];

        $query = "CALL eliminarBase('$ban','$cve_base','$cveusuario_accion')";

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