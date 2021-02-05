<?php

class PerfilModelo
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
        $cve_perfil = (!empty($datosFiltrados['cve_perfil']) || $datosFiltrados['cve_perfil']!=null) ? $datosFiltrados['cve_perfil'] : '';

        $query = "CALL obtenPerfiles('$ban','$cve_perfil')";

        $c_peril = $this->conexion->query($query);
        $r_perfil = $this->conexion->consulta_array($c_peril);

        return $r_perfil;
    }



    public function obtenerOpcionesMenu($datosPerfil)
    {

        $datosFiltrados = $this->filtrarDatos($datosPerfil);
        $cvePerfil = $datosFiltrados['cvePerfil'];

        $query = "CALL obten_opcionesperfil('3','','')";

        $c_opcionMenu = $this->conexion->query($query);
        $r_opcionMenu = $this->conexion->consulta_array($c_opcionMenu);

        $this->conexion->next_result();

        $array_opcionesMenu = array();
        
        foreach ($r_opcionMenu as $opcion)
        {
            $cve_opcion = $opcion[cve_opcion];
            $query2 = "CALL obten_opcionesperfil('5','$cvePerfil','$cve_opcion')";
            //echo $query2;
            $c_opcionHijo = $this->conexion->query($query2) or die ($this->conexion->error());
            $r_opcionHijo = $this->conexion->consulta_array($c_opcionHijo);

            //De igual manera se corta la primera para inicializar la siguiente ya que estan dentro de un loop
            $this->conexion->next_result();

            $opcionesMenu = array (
                                nombre_opcion   => $opcion['nombre_opcion'],
                                tipo   => $opcion['render_opcion'],
                                subopcion => $r_opcionHijo
                            );

            $array_opcionesMenu[] = $opcionesMenu;

        }
        

        $this->conexion->close_conexion();
        $this->conexion->next_result();


        return $array_opcionesMenu;

    }



    public function guardarPerfil($datosPerfil)
    {

        $datosFiltrados = $this->filtrarDatos($datosPerfil[0]);

        $ban                       = $datosFiltrados['ban'];
        $nombrePerfil              = $datosFiltrados['nombrePerfil'];
        $descipcionPerfil          = $datosFiltrados['descipcionPerfil'];
        //$cvePerfil                 = $datosFiltrados['cvePerfil'];
        $cvePerfil = (!empty($datosFiltrados['cvePerfil']) || $datosFiltrados['cvePerfil']!=null) ? $datosFiltrados['cvePerfil'] : 0;
        $cveusuario_accion         = $datosFiltrados['cveusuario_accion'];

        $query = "CALL guardarPerfil('$ban','$cvePerfil','$nombrePerfil','$descipcionPerfil','','$cveusuario_accion')";

        $c_perfil = $this->conexion->query($query) or die ($this->conexion->error());
        $r_perfil = $this->conexion->consulta_assoc($c_perfil);

        $ultima_cve = $r_perfil['cve'];

        //cortamos conexion de procedimientos
        $this->conexion->next_result();

        $datosFiltrados = $this->filtrarDatos($datosPerfil[1]);

        if ($cvePerfil >= 1)
        {
            $query = "CALL borrarOpcionPerfil('1','$cvePerfil')";
            $this->conexion->query($query) or die ($this->conexion->error());

            $this->conexion->next_result();

            $ultima_cve = $cvePerfil;
        }

        foreach ($datosFiltrados as $valor) 
        {

            if (!empty($valor)){
                $query = "CALL guardarPerfil('2','$ultima_cve','','','$valor','')";
                $respuesta = $this->conexion->query($query) or die ($this->conexion->error());
            }

            $this->conexion->next_result();

        }
        
        $this->conexion->close_conexion();
        $this->conexion->next_result();
        
        return $respuesta;

    }



    public function bloquearPerfil($datosPerfil)
    {
        $datosFiltrados = $this->filtrarDatos($datosPerfil);

        $ban               = $datosFiltrados['ban'];
        $cve_perfil        = $datosFiltrados['cve_perfil'];
        $cveusuario_accion = $datosFiltrados['cveusuario_accion'];

        $query = "CALL eliminarPerfil('$ban','$cve_perfil','$cveusuario_accion')";

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