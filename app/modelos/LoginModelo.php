<?php

class LoginModelo
{

	//creamos la variable donde se instanciará la clase "conectar"
    public $conexion;

    public function __construct() {

    	//inicializamos la clase para conectarnos a la bd
        $this->conexion = new ConexionBD(); //instanciamos la clase

    }

    public function obtenerUsuario($post)
    {
        $datosFiltrados = $this->filtrarDatos($post);

        //print_r($datosFiltrados);
        $usr  = $datosFiltrados['txt_usr'];
        $pass = $datosFiltrados['txt_pass'];
		$pass = md5($pass);

        $query = "CALL loginUsuario('$usr','$pass')";

    	$c_usuario = $this->conexion->query($query) or die ($this->conexion->error());
    	$r_usuario = $this->conexion->consulta_array($c_usuario);

        $this->conexion->next_result();

		return $r_usuario;
    }

    public function crear_menu($datos)
    {
        $datosFiltrados = $this->filtrarDatos($datos);

        $ban  = $datosFiltrados['ban'];
        $cveperfil_usuario = $datosFiltrados['cveperfil_usuario'];
        $origen = $datosFiltrados['origen'];

        $query = "CALL obten_opcionesperfil('$ban','$cveperfil_usuario','$origen')";
        //echo $query;

        $c_opcionPadre = $this->conexion->query($query) or die ($this->conexion->error());
        $r_opcionPadre = $this->conexion->consulta_array($c_opcionPadre);

        //Esta opcion me permite hacer dos peticiones de procedimientos almacenados
        //Se corta la primera para inicializar la siguiente
        $this->conexion->next_result();

        $menu = array();

        foreach ($r_opcionPadre as $opcion)
        {
            $cve_opcion = $opcion[cve_opcion];
            $query2 = "CALL obten_opcionesperfil('2','$cveperfil_usuario','$cve_opcion')";

            $c_opcionHijo = $this->conexion->query($query2) or die ($this->conexion->error());
            $r_opcionHijo = $this->conexion->consulta_array($c_opcionHijo);

            //De igual manera se corta la primera para inicializar la siguiente ya que estan dentro de un loop
            $this->conexion->next_result();

            $opcionesHijo = array (
                                text   => $opcion[nombre_opcion],
                                tipo   => $opcion[render_opcion],
                                icono  => $opcion[icono],
                                opcion => $r_opcionHijo
                            );

            $menu[] = $opcionesHijo;

        }

        //$this->conexion->free_result($r_perfil);
        $this->conexion->close_conexion();
        $this->conexion->next_result();


        return $menu;
    }

    public function filtrarDatos($datosUsuario){

        foreach ($datosUsuario as $indice => $valor) {
            $datosUsuario[$indice] = $this->conexion->real_escape_string($valor);
        }

        return $datosUsuario;

    }
	
}

?>