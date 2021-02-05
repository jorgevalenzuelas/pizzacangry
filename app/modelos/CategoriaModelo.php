<?php

class CategoriaModelo
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
        $cve_categoria = (!empty($datosFiltrados['cve_categoria']) || $datosFiltrados['cve_categoria']!=null) ? $datosFiltrados['cve_categoria'] : '';

        $query = "CALL obtenCategoria('$ban','$cve_categoria')";

        $c_categoria = $this->conexion->query($query);
        $r_categoria = $this->conexion->consulta_array($c_categoria);

        return $r_categoria;
    }



    public function guardarCategoria($datosCategoria)
    {

        $datosFiltrados = $this->filtrarDatos($datosCategoria);

        $ban                = $datosFiltrados['ban'];
        $cvedepartamento    = $datosFiltrados['cvedepartamento'];
        $nombreCategoria    = $datosFiltrados['nombreCategoria'];
        $cveCategoria       = $datosFiltrados['cve_categoria'];
        $cveusuario_accion  = $datosFiltrados['cveusuario_accion'];

        $query = "CALL guardarCategoria(
                                        '$ban',
                                        '$cveCategoria',
                                        '$cvedepartamento',
                                        '$nombreCategoria',
                                        '$cveusuario_accion'
                                        )";

        $respuesta = $this->conexion->query($query) or die ($this->conexion->error());
        
        $this->conexion->close_conexion();
        
        return $respuesta;

    }



    public function bloquearCategoria($datosCategoria)
    {
        $datosFiltrados = $this->filtrarDatos($datosCategoria);

        $ban               = $datosFiltrados['ban'];
        $cve_categoria     = $datosFiltrados['cve_categoria'];
        $cveusuario_accion = $datosFiltrados['cveusuario_accion'];

        $query = "CALL eliminarCategoria('$ban','$cve_categoria','$cveusuario_accion')";

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