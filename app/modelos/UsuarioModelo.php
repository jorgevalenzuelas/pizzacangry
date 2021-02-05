<?php

class UsuarioModelo
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
        $cve_usuario = (!empty($datosFiltrados['cve_usuario']) || $datosFiltrados['cve_usuario']!=null) ? $datosFiltrados['cve_usuario'] : '0';

        $query = "CALL obtenUsuarios('$ban','$cve_usuario')";

        $c_usuario = $this->conexion->query($query);
        $r_usuario = $this->conexion->consulta_array($c_usuario);

        return $r_usuario;
    }



    public function registrarUsuario($datosUsuario)
    {

        $datosFiltrados = $this->filtrarDatos($datosUsuario);

        $ban               = $datosFiltrados['ban'];
        $cve_usuario       = $datosFiltrados['cve_usuario'];
        $nombre_usuario    = $datosFiltrados['nombre_usuario'];
        $apellidop_usuario = $datosFiltrados['apellidop_usuario'];
        $apellidom_usuario = $datosFiltrados['apellidom_usuario'];
        $login_usuario     = $datosFiltrados['login_usuario'];
        $password_usuario  = $datosFiltrados['password_usuario'];
        $password_usuario = (empty($password_usuario)) ? '' : md5($password_usuario) ;
        //$password_usuario  = md5($password_usuario);
        $perfil_usuario    = $datosFiltrados['perfil_usuario'];
        $sucursal          = $datosFiltrados['sucursal'];
        $puesto            = $datosFiltrados['puesto'];
        $cveusuario_accion = $datosFiltrados['cveusuario_accion'];

        $query = "CALL guardarUsuario(
                                    '$ban',
                                    '$cve_usuario',
                                    '$nombre_usuario',
                                    '$apellidop_usuario',
                                    '$apellidom_usuario',
                                    '$login_usuario',
                                    '$password_usuario',
                                    '$perfil_usuario',
                                    '$sucursal',
                                    '$puesto',
                                    '$cveusuario_accion'
                                )";

        $respuesta = $this->conexion->query($query);

        return $respuesta;
    }



    public function bloquearUsuario($datosUsuario)
    {
        $datosFiltrados = $this->filtrarDatos($datosUsuario);

        $ban               = $datosFiltrados['ban'];
        $cve_usuario       = $datosFiltrados['cve_usuario'];
        $cveusuario_accion = $datosFiltrados['cveusuario_accion'];

        $query = "CALL eliminarUsuario('$ban','$cve_usuario','$cveusuario_accion')";

        $respuesta = $this->conexion->query($query);

        return $respuesta;
    }

    

    public function filtrarDatos($datosFiltrar){

        foreach ($datosFiltrar as $indice => $valor) {
            $datosFiltrar[$indice] = $this->conexion->real_escape_string($valor);
        }

        return $datosFiltrar;

    }
	
}

?>