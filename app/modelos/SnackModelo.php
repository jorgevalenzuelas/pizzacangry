<?php

class SnackModelo
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
        $cve_snack = (!empty($datosFiltrados['cve_snack']) || $datosFiltrados['cve_snack']!=null) ? $datosFiltrados['cve_snack'] : '0';

        $query = "CALL obtenSnack('$ban','$cve_snack')";

        $c_departamento = $this->conexion->query($query);
        $r_departamento = $this->conexion->consulta_array($c_departamento);

        return $r_departamento;
    }



    public function guardarSnack($datosSnack)
    {

        $datosFiltrados = $this->filtrarDatos($datosSnack);

        $ban                = $datosFiltrados['ban'];
        $nombre_snack = $datosFiltrados['nombre_snack'];
        $cve_snack    = $datosFiltrados['cve_snack'];
        $cveusuario_accion  = $datosFiltrados['cveusuario_accion'];

        $query = "CALL guardarSnack(
                                            '$ban',
                                            '$cve_snack',
                                            '$nombre_snack',
                                            '$cveusuario_accion'
                                        )";

        $respuesta = $this->conexion->query($query) or die ($this->conexion->error());
        
        $this->conexion->close_conexion();
        
        return $respuesta;

    }



    public function bloquearSnack($datosSnack)
    {
        $datosFiltrados = $this->filtrarDatos($datosSnack);

        $ban               = $datosFiltrados['ban'];
        $cve_snack  = $datosFiltrados['cve_snack'];
        $cveusuario_accion = $datosFiltrados['cveusuario_accion'];

        $query = "CALL eliminarSnack('$ban','$cve_snack','$cveusuario_accion')";

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