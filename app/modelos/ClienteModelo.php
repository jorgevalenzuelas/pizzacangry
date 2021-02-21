<?php

class ClienteModelo
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
        $cve_cliente = (!empty($datosFiltrados['cve_cliente']) || $datosFiltrados['cve_cliente']!=null) ? $datosFiltrados['cve_cliente'] : '0';

        $query = "CALL obtenClientes('$ban','$cve_cliente')";

        $c_cliente = $this->conexion->query($query);
        $r_cliente = $this->conexion->consulta_array($c_cliente);

        return $r_cliente;
    }



    public function guardarCliente($datosCliente)
    {

        $datosFiltrados = $this->filtrarDatos($datosCliente);

        $ban               = $datosFiltrados['ban'];
        $nombreCliente      = $datosFiltrados['nombreCliente'];
        $direccionCliente      = $datosFiltrados['direccionCliente'];
        $cveCliente         = $datosFiltrados['cve_cliente'];
        $cveusuario_accion = $datosFiltrados['cveusuario_accion'];

        $query = "CALL guardarCliente(
                                    '$ban',
                                    '$cveCliente',
                                    '$nombreCliente',
                                    '$direccionCliente',
                                    '$cveusuario_accion'
                                    )";

        $respuesta = $this->conexion->query($query) or die ($this->conexion->error());
        
        $this->conexion->close_conexion();
        
        return $respuesta;

    }



    public function bloquearCliente($datosCliente)
    {
        $datosFiltrados = $this->filtrarDatos($datosCliente);

        $ban               = $datosFiltrados['ban'];
        $cve_cliente        = $datosFiltrados['cve_cliente'];
        $cveusuario_accion = $datosFiltrados['cveusuario_accion'];

        $query = "CALL eliminarCliente('$ban','$cve_cliente','$cveusuario_accion')";

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