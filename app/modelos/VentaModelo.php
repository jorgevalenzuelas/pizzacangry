<?php

class VentaModelo
{

	//creamos la variable donde se instanciará la clase "conectar"
    public $conexion;

    public function __construct() {

    	//inicializamos la clase para conectarnos a la bd
        $this->conexion = new ConexionBD(); //instanciamos la clase

    }



    public function consultarProductos($datos)
    {
        $datosFiltrados = $this->filtrarDatos($datos);

        $ban  = $datosFiltrados['ban'];
        $query = "CALL obtenProductos('$ban')";
        $c_productos = $this->conexion->query($query);
        $r_productos = $this->conexion->consulta_array($c_productos);

        return $r_productos;
    }
    
    public function consultarComanda($datos)
    {
        $datosFiltrados = $this->filtrarDatos($datos);

        $ban  = $datosFiltrados['ban'];
        $folio  = $datosFiltrados['folio'];
        $query = "CALL obtenComanda('$ban','$folio')";
        $c_productos = $this->conexion->query($query);
        $r_productos = $this->conexion->consulta_array($c_productos);

        return $r_productos;
    }


    public function generarFolio($datosFolio)
    {

        $datosFiltrados = $this->filtrarDatos($datosFolio);

        $ban                = $datosFiltrados['ban'];
        $folo_venta    = $datosFiltrados['folo_venta'];
        $cveusuario_accion  = $datosFiltrados['cveusuario_accion'];

        $query = "CALL generarFolio(
                                            '$ban',
                                            '$folo_venta',
                                            '$cveusuario_accion'
                                        )";

        $c_folio = $this->conexion->query($query);
        $r_folio = $this->conexion->consulta_array($c_folio);

        return $r_folio;
    }

    public function actualizarTotalVenta($datosFolio)
    {

        $datosFiltrados = $this->filtrarDatos($datosFolio);

        $ban                = $datosFiltrados['ban'];
        $folo_venta    = $datosFiltrados['folo_venta'];
        $cveusuario_accion  = $datosFiltrados['cveusuario_accion'];

        $query = "CALL actualizarTotalVenta(
                                            '$folo_venta',
                                            '$cveusuario_accion'
                                        )";

        $c_folio = $this->conexion->query($query);
    }

    public function guardarVenta($datosVenta)
    {

        $datosFiltrados = $this->filtrarDatos($datosVenta);

        $ban = $datosFiltrados['ban'];
        $cve_deventa = $datosFiltrados['cve_deventa'];
        $folioventa_deventa = $datosFiltrados['folioventa_deventa'];
        $cvema_deventa = $datosFiltrados['cvema_deventa'];
        $cantidad_deventa = $datosFiltrados['cantidad_deventa'];
        $preciounitario_deventa = $datosFiltrados['preciounitario_deventa'];
        $cveproducto_deventa = $datosFiltrados['cveproducto_deventa'];
        $deingredientes = $datosFiltrados['deingredientes'];
        $cveusuario_accion  = $datosFiltrados['cveusuario_accion'];

        $query = "CALL guardarVenta(
                                    '$ban',
                                    '$cve_deventa',
                                    '$folioventa_deventa',
                                    '$cvema_deventa',
                                    '$cantidad_deventa',
                                    '$preciounitario_deventa',
                                    '$cveproducto_deventa',
                                    '$cveusuario_accion'
                                )";

        $c_perfil = $this->conexion->query($query) or die ($this->conexion->error());
        $r_perfil = $this->conexion->consulta_assoc($c_perfil);

        $ultima_cve = $r_perfil['cve_deventa'];

        //cortamos conexion de procedimientos
        

                                        
        if($cveproducto_deventa == '1'){
            $this->conexion->next_result();
            $ingredentes  = $deingredientes;
            $pizzas = explode("-", $ingredentes);

            for($i = 0; $i < $cantidad_deventa; $i++){
                file_put_contents('cantidad_deventa.txt',print_r( array($i),true)."\r\n", FILE_APPEND | LOCK_EX);
                        
                $ingredentes2  = $pizzas[$i];
                $pizzas2 = explode("|", $ingredentes2);
                for($j = 3; $j < count($pizzas2); $j++){
                    $numeroPizza = $pizzas2[0];
                    $descripcionPizza = $pizzas2[1];
                    $extraPizza = $pizzas2[2];
                    $cveIngredente = $pizzas2[$j];
                    if (!empty($ultima_cve)){
                        $query = "CALL guardarDeTradicionalIngrediente('1','0','$ultima_cve','$numeroPizza','$descripcionPizza','$extraPizza','$cveIngredente')";
                        file_put_contents('guardarDeTradicionalIngrediente.txt',print_r( array($query),true)."\r\n", FILE_APPEND | LOCK_EX);
                        $respuesta = $this->conexion->query($query) or die ($this->conexion->error());
                    }
        
                    $this->conexion->next_result();
                }
            }

            $this->conexion->close_conexion();

            return $respuesta;
            
         
        }
        else if($cveproducto_deventa == '5'){
            $this->conexion->next_result();
            $ingredentes  = $deingredientes;
            $paquetes = explode("-", $ingredentes);
            
            for($i = 0; $i < $cantidad_deventa; $i++){
                $numPizza = 1;
                $pizzas = explode("+", $paquetes[$i]);
                for($j = 0; $j < count($pizzas); $j++){
                    $desglose = explode("|", $pizzas[$j]);
                    for($k = 2; $k < count($desglose); $k++){

                    $numeroPaquete = $i + 1;
                    $cvePizza = $desglose[0];
                    $descripcionPizza = $desglose[1];
                    $cveIngredente = $desglose[$k];

                    if (!empty($ultima_cve)){
                        $query = "CALL guardarDePaqueteIngrediente('1','0','$ultima_cve','$numeroPaquete','$numPizza','$cvePizza','$descripcionPizza','$cveIngredente')";
                        file_put_contents('guardarDePaqueteIngrediente.txt',print_r( array($query),true)."\r\n", FILE_APPEND | LOCK_EX);
                        $respuesta = $this->conexion->query($query) or die ($this->conexion->error());
                    }
        
                    $this->conexion->next_result();
                }
                $numPizza++;
            }
            }

            $this->conexion->close_conexion();

            return $respuesta;
            
            
        }
        else{
            return $c_perfil;
        }

        
        
    }

    public function modificarDetadicionalVenta($datosVenta)
    {

        $datosFiltrados = $this->filtrarDatos($datosVenta);

        $ban = $datosFiltrados['ban'];
        $folio_venta = $datosFiltrados['folio_venta'];
        $cve_deventa = $datosFiltrados['cve_deventa'];
        $deingredientes = $datosFiltrados['deingredientes'];
        $cveproducto_deventa = $datosFiltrados['cveproducto_deventa'];
        $cantidad_deventa = $datosFiltrados['cantidad_deventa'];

      

        $ultima_cve = $cve_deventa;
        
                                        
        if($cveproducto_deventa == '1'){

            $query = "CALL eliminardeTradicionalIngrediente('$ban','$ultima_cve')";

            $respuesta = $this->conexion->query($query) or die ($this->conexion->error());
            if($cantidad_deventa == '0'){
                $this->conexion->next_result();
                $query = "CALL eliminarPaqueteVenta('1','$ultima_cve','$cantidad_deventa','$folio_venta')";

                $respuesta = $this->conexion->query($query) or die ($this->conexion->error());
            }
            else{
                $this->conexion->next_result();
                $query = "CALL eliminarPaqueteVenta('2','$ultima_cve','$cantidad_deventa', '$folio_venta')";

                $respuesta = $this->conexion->query($query) or die ($this->conexion->error());

                $this->conexion->next_result();
                $ingredentes  = $deingredientes;
                $pizzas = explode("-", $ingredentes);

                for($i = 0; $i < $cantidad_deventa; $i++){
                    file_put_contents('cantidad_deventa.txt',print_r( array($i),true)."\r\n", FILE_APPEND | LOCK_EX);
                            
                    $ingredentes2  = $pizzas[$i];
                    $pizzas2 = explode("|", $ingredentes2);
                    for($j = 3; $j < count($pizzas2); $j++){
                        $numeroPizza = $pizzas2[0];
                        $descripcionPizza = $pizzas2[1];
                        $extraPizza = $pizzas2[2];
                        $cveIngredente = $pizzas2[$j];
                        if (!empty($ultima_cve)){
                            $query = "CALL guardarDeTradicionalIngrediente('1','0','$ultima_cve','$numeroPizza','$descripcionPizza','$extraPizza','$cveIngredente')";
                            file_put_contents('guardarDeTradicionalIngrediente.txt',print_r( array($query),true)."\r\n", FILE_APPEND | LOCK_EX);
                            $respuesta = $this->conexion->query($query) or die ($this->conexion->error());
                        }
            
                        $this->conexion->next_result();
                    }
                }

                $this->conexion->close_conexion();

                return $respuesta;
            }
            
         
        }
        else if($cveproducto_deventa == '5'){

            $query = "CALL eliminardePaqueteIngrediente('$ban','$ultima_cve')";

            $respuesta = $this->conexion->query($query) or die ($this->conexion->error());

            if(cantidad_deventa == '0'){
                $this->conexion->next_result();
                $query = "CALL eliminarPaqueteVenta('1','$ultima_cve','$cantidad_deventa','$folio_venta')";

                $respuesta = $this->conexion->query($query) or die ($this->conexion->error());
            }
            else{
                $this->conexion->next_result();
                $query = "CALL eliminarPaqueteVenta('2','$ultima_cve','$cantidad_deventa','$folio_venta')";

                $respuesta = $this->conexion->query($query) or die ($this->conexion->error());

                $this->conexion->next_result();
                $ingredentes  = $deingredientes;
                $paquetes = explode("-", $ingredentes);
                
                for($i = 0; $i < $cantidad_deventa; $i++){
                    $numPizza = 1;
                    $pizzas = explode("+", $paquetes[$i]);
                    for($j = 0; $j < count($pizzas); $j++){
                        $desglose = explode("|", $pizzas[$j]);
                        for($k = 2; $k < count($desglose); $k++){

                        $numeroPaquete = $i + 1;
                        $cvePizza = $desglose[0];
                        $descripcionPizza = $desglose[1];
                        $cveIngredente = $desglose[$k];

                        if (!empty($ultima_cve) || !empty($cvePizza)){
                            $query = "CALL guardarDePaqueteIngrediente('1','0','$ultima_cve','$numeroPaquete','$numPizza','$cvePizza','$descripcionPizza','$cveIngredente')";
                            file_put_contents('guardarDePaqueteIngrediente.txt',print_r( array($query),true)."\r\n", FILE_APPEND | LOCK_EX);
                            $respuesta = $this->conexion->query($query) or die ($this->conexion->error());
                        }
            
                        $this->conexion->next_result();
                    }
                    $numPizza++;
                }
                }

                $this->conexion->close_conexion();

                return $respuesta;
            }

        }
        else{
            return $c_perfil;
        }

        
        
    }

    public function eliminarProductoVenta($datosVenta)
    {

        $datosFiltrados = $this->filtrarDatos($datosVenta);
        $folio_venta = $datosFiltrados["folio_venta"];
        $cve_deventa = $datosFiltrados['cve_deventa'];
        $cveproducto_deventa = $datosFiltrados['cveproducto_deventa'];

      

        $ultima_cve = $cve_deventa;
        
                                        
        if($cveproducto_deventa == '1'){

            $query = "CALL eliminardeTradicionalIngrediente('1','$ultima_cve')";

            return $respuesta = $this->conexion->query($query) or die ($this->conexion->error());
            $this->conexion->next_result();
        
        }
        else if($cveproducto_deventa == '5'){

            $query = "CALL eliminardePaqueteIngrediente('1','$ultima_cve')";

            return $respuesta = $this->conexion->query($query) or die ($this->conexion->error());

            $this->conexion->next_result();
        }

                
                $query = "CALL eliminarPaqueteVenta('1','$ultima_cve','0','$folio_venta')";

               return $respuesta = $this->conexion->query($query) or die ($this->conexion->error());

        
        
    }

    public function modificarCantidadVenta($datosVenta)
    {

        $datosFiltrados = $this->filtrarDatos($datosVenta);

        $ban = $datosFiltrados['ban'];
        $folio_venta   = $datosFiltrados["folio_venta"];
        $cve_deventa = $datosFiltrados['cve_deventa'];
        $cantidad_deventa = $datosFiltrados['cantidad_deventa'];

      

        $ultima_cve = $cve_deventa;
        
                   
                $query = "CALL eliminarPaqueteVenta('$ban','$ultima_cve','$cantidad_deventa','$folio_venta')";

                return $respuesta = $this->conexion->query($query) or die ($this->conexion->error());
            
            
            
         

        
        
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