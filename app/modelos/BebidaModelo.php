<?php

class BebidaModelo
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
        $cve_bebida = (!empty($datosFiltrados['cve_bebida']) || $datosFiltrados['cve_bebida']!=null) ? $datosFiltrados['cve_bebida'] : '0';

        $query = "CALL obtenBebida('$ban','$cve_bebida')";

        $c_departamento = $this->conexion->query($query);
        $r_departamento = $this->conexion->consulta_array($c_departamento);

        return $r_departamento;
    }



    public function guardarBebida($datosBebida)
    {

        $datosFiltrados = $this->filtrarDatos($datosBebida);

        $ban                = $datosFiltrados['ban'];
        $cve_bebida    = $datosFiltrados['cve_bebida'];
        $nombre_bebida = $datosFiltrados['nombre_bebida'];
        $costo_bebida = $datosFiltrados['costo_bebida'];
        $precio_bebida = $datosFiltrados['precio_bebida'];
        $stock_bebida = $datosFiltrados['stock_bebida'];
        $cveunidadmedia_bebida = $datosFiltrados['cveunidadmedia_bebida'];
        $cveusuario_accion  = $datosFiltrados['cveusuario_accion'];

        $query = "CALL guardarBebida(
                                            '$ban',
                                            '$cve_bebida',
                                            '$nombre_bebida',
                                            '$costo_bebida',
                                            '$precio_bebida',
                                            '$stock_bebida',
                                            '$cveunidadmedia_bebida',
                                            '$cveusuario_accion'
                                        )";

        $respuesta = $this->conexion->query($query) or die ($this->conexion->error());
        
        $this->conexion->close_conexion();
        
        return $respuesta;

    }



    public function bloquearBebida($datosBebida)
    {
        $datosFiltrados = $this->filtrarDatos($datosBebida);

        $ban               = $datosFiltrados['ban'];
        $cve_bebida  = $datosFiltrados['cve_bebida'];
        $cveusuario_accion = $datosFiltrados['cveusuario_accion'];

        $query = "CALL eliminarBebida('$ban','$cve_bebida','$cveusuario_accion')";

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