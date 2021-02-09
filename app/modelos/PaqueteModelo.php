<?php

class PaqueteModelo
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
        $cve_paquete = (!empty($datosFiltrados['cve_paquete']) || $datosFiltrados['cve_paquete']!=null) ? $datosFiltrados['cve_paquete'] : '0';

        $query = "CALL obtenPaquete('$ban','$cve_paquete')";

        $c_departamento = $this->conexion->query($query);
        $r_departamento = $this->conexion->consulta_array($c_departamento);

        return $r_departamento;
    }

    public function consultarDetallePaquete($datos)
    {
        $datosFiltrados = $this->filtrarDatos($datos);

        $ban  = $datosFiltrados['ban'];
        $cve_paquete = (!empty($datosFiltrados['cve_paquete']) || $datosFiltrados['cve_paquete']!=null) ? $datosFiltrados['cve_paquete'] : '0';

        $query = "CALL obtenDetallePaquete('$ban','$cve_paquete')";

        $c_depaquete = $this->conexion->query($query);
        $r_depaquete = $this->conexion->consulta_array($c_depaquete);

        return $r_depaquete;
    }

    public function guardarPaquete($datosPaquete)
    {

        $datosFiltrados = $this->filtrarDatos($datosPaquete);

        $ban                = $datosFiltrados['ban'];
        $cve_paquete    = $datosFiltrados['cve_paquete'];
        $nombre_paquete = $datosFiltrados['nombre_paquete'];
        $costo_paquete = $datosFiltrados['costo_paquete'];
        $precio_paquete = $datosFiltrados['precio_paquete'];
        $cveusuario_accion  = $datosFiltrados['cveusuario_accion'];

        $query = "CALL guardarPaquete(
                                            '$ban',
                                            '$cve_paquete',
                                            '$nombre_paquete',
                                            '$costo_paquete',
                                            '$precio_paquete',
                                            '$cveusuario_accion'
                                        )";

        $respuesta = $this->conexion->query($query) or die ($this->conexion->error());
        
        $this->conexion->close_conexion();
        
        return $respuesta;

    }

    public function guardarDetallePaquete($datosDetallePaquete)
    {

        $datosFiltrados = $this->filtrarDatos($datosDetallePaquete);

        $ban                = $datosFiltrados['ban'];
        $cve_paquete    = $datosFiltrados['cve_paquete'];
        $cvepaquete_depaquete = $datosFiltrados['cvepaquete_depaquete'];
        $cvema_depaquete = $datosFiltrados['cvema_depaquete'];
        $cantidad_depaquete = $datosFiltrados['cantidad_depaquete'];
        $cveproducto_depaquete = $datosFiltrados['cveproducto_depaquete'];
        $cveusuario_accion  = $datosFiltrados['cveusuario_accion'];

        $query = "CALL guardarDetallePaquete(
                                            '$ban',
                                            '$cve_paquete',
                                            '$cvepaquete_depaquete',
                                            '$cvema_depaquete',
                                            '$cantidad_depaquete',
                                            '$cveproducto_depaquete',
                                            '$cveusuario_accion'
                                        )";

        $respuesta = $this->conexion->query($query) or die ($this->conexion->error());
        
        $this->conexion->close_conexion();
        
        return $respuesta;

    }

    public function bloquearPaquete($datosPaquete)
    {
        $datosFiltrados = $this->filtrarDatos($datosPaquete);

        $ban               = $datosFiltrados['ban'];
        $cve_paquete  = $datosFiltrados['cve_paquete'];
        $cveusuario_accion = $datosFiltrados['cveusuario_accion'];

        $query = "CALL eliminarPaquete('$ban','$cve_paquete','$cveusuario_accion')";

        $respuesta = $this->conexion->query($query);

        return $respuesta;
    }

    public function eliminarDetallePaquete($datosDetallePaquete)
    {
        $datosFiltrados = $this->filtrarDatos($datosDetallePaquete);

        $ban               = $datosFiltrados['ban'];
        $cve_depaquete  = $datosFiltrados['cve_depaquete'];

        $query = "CALL eliminarDetallePaquete('$ban','$cve_depaquete')";

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