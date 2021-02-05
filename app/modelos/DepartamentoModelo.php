<?php

class DepartamentoModelo
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
        $cve_departamento = (!empty($datosFiltrados['cve_departamento']) || $datosFiltrados['cve_departamento']!=null) ? $datosFiltrados['cve_departamento'] : '';

        $query = "CALL obtenDepartamentos('$ban','$cve_departamento')";

        $c_departamento = $this->conexion->query($query);
        $r_departamento = $this->conexion->consulta_array($c_departamento);

        return $r_departamento;
    }



    public function guardarDepartamento($datosDepartamento)
    {

        $datosFiltrados = $this->filtrarDatos($datosDepartamento);

        $ban                = $datosFiltrados['ban'];
        $nombreDepartamento = $datosFiltrados['nombreDepartamento'];
        $cveDepartamento    = $datosFiltrados['cve_departamento'];
        $cveusuario_accion  = $datosFiltrados['cveusuario_accion'];

        $query = "CALL guardarDepartamento(
                                            '$ban',
                                            '$cveDepartamento',
                                            '$nombreDepartamento',
                                            '$cveusuario_accion'
                                        )";

        $respuesta = $this->conexion->query($query) or die ($this->conexion->error());
        
        $this->conexion->close_conexion();
        
        return $respuesta;

    }



    public function bloquearDepartamento($datosDepartamento)
    {
        $datosFiltrados = $this->filtrarDatos($datosDepartamento);

        $ban               = $datosFiltrados['ban'];
        $cve_departamento  = $datosFiltrados['cve_departamento'];
        $cveusuario_accion = $datosFiltrados['cveusuario_accion'];

        $query = "CALL eliminarDepartamento('$ban','$cve_departamento','$cveusuario_accion')";

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