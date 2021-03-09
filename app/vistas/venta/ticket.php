<?php
session_start();
error_reporting(E_ALL);

$model = new VentaModelo();
$response = $model->consultarComandaTiket(1, $_REQUEST["folio"]);
//print_r($response);
?>
<style type="text/css">
.classImprime{
    height: auto;
    width: 400px;
    /*border: 2px solid;
    border-radius: 0px;*/
    margin: 0px;
    padding: 0px;
    float: left;
    font-family:sans-serif;
    font-size: 11pt;
    font-style: normal;
    line-height: normal;
    font-weight: normal;
    font-variant: normal;
    text-transform: none;
    color: #000;
}
td{
	padding: 3px;
	font-family:sans-serif;
	font-size: 11pt;
	font-style: normal;
	line-height: normal;
	font-weight: normal;
	font-variant: normal;
	text-transform: none;
	color: #000;
}
@page{
    size: auto;/* es el valor por defecto */
  margin: 0;
}
</style>

<!--body-->
<body onafterprint="window.close()">
<div align="left" class="classImprime">
	<div align="center">
		<img src="<?php echo RUTA_URL; ?>public/img/LogoCangry.png" id="borde_negro" style="width: 35%;display: block;margin-bottom: 10px;">
    	<b><span style="font-size: 14pt;">PIZZA LOS CANGRY</span><br></b>
    	<div style="font-weight:bold; font-size: 9pt;margin-top: 5px;">
        	AV PRADOS DEL SOL #7623 <BR>
        	PRADOS DEL SOL<BR>
            MAZATL&Aacute;N, SINALOA<BR>
            www.pizzaloscangry.tk<BR>
        </div>
    	-----------------------------------------------------
	</div>
	
    <?php
	//////////////////////////////////////////////////////////////   Detalle de la venta, cantidad, productos y precio
    if ($response[0]["tipo_venta"] === 'Restaurante') {
        $tipo_venta = 'RESTAURANTE';
    }
    else{
        $tipo_venta = 'DOMICILIO';
    }
    
    echo "<table width=\"380\">";
		echo"
			<tr> 
				<td width=\"80\" align=\"left\" cellpadding=\"5\" >FECHA:</td>
				<td width=\"300\" align=\"left\" colspan=\"2\"><b>".$response[0]["fechaalta_deventa"]."</b></td>
				<!--<td width=\"180\" align=\"left\" colspan=\"2\">&nbsp;</td> -->
			 <!-- <td width=\"100\" align=\"right\" ><b>". $_REQUEST["folio"]."</b></td>--> 
			</tr>
            <tr>
				<td align=\"left\" >VENTA:</td>
				<td align=\"left\" colspan='2'>".$tipo_venta."</td>
			</tr>
            <tr>
				<td align=\"left\" >ATENDIO:</td>
				<td align=\"left\" colspan='2'>".$_SESSION["nombreUsuario"]."</td>
			</tr>
		";
	echo "</table>";
    if (count($response)) {
        /*******************PRODUCTOS*************************************/
            echo "<table width=\"380\">";
                echo"
                    <tr><td colspan='4' align=\"center\">****** PRODUCTOS ******</td></tr>
                    <tr> 
                        <td width=\"27\" align=\"left\" cellpadding=\"5\" >CANT</td>
                        <td width=\"200\" align=\"left\" >DESCRIPCI&Oacute;N</td>
                        <td width=\"137\" align=\"left\" >COSTO UNIT.</td>
                        <td width=\"26\" align=\"center\" >MONTO</td> 
                    </tr>";
            $totalServicio = 0;
            $total = 0;
            for($i = 0 ; $i < count($response); $i++) 
            {
                $total = $response[$i]["cantidad_deventa"] * $response[$i]["preciounitario_deventa"];
                echo "<tr> 
                        <td width=\"27\" >";
                            echo $response[$i]["cantidad_deventa"];
                echo "	</td>
                        <td width=\"200\" >";
                            echo htmlspecialchars($response[$i]["nombrecompleto_comanda"]);
                echo "	</td>
                        <td width=\"137\" >";
                            echo htmlspecialchars('$'.$response[$i]["preciounitario_deventa"]);
                echo "	</td>
                        <td width=\"26\" align=\"right\" > $";
                            echo number_format($total, 2, '.', ',');
                echo "</td> 
                    </tr>";		
            }
            echo " <br><tr><td></td><td></td><td align=\"right\" style=\"font-size:13pt;\">TOTAL:</td><td align=\"right\" style=\"font-size:13pt;\">$".number_format($response[0]["total_venta"], 2, '.', ',')."</td></tr>";
            echo "</table>";
        }

        if ($response[0]["tipo_venta"] !== 'Restaurante') {
            echo "<table width=\"380\">";
                echo"
                <tr><td colspan='4' align=\"center\">****** DOMICILIO ******</td></tr>
                    <tr> 
                        <td width=\"80\" align=\"left\" cellpadding=\"5\" >CLIENTE:</td>
                        <td width=\"300\" align=\"left\" colspan=\"2\"><b>".htmlspecialchars($response[0]["nombre_cliente"])."</b></td>
                    </tr>
                    <tr>
                        <td align=\"left\" >DIRECCI&Oacute;N:</td>
                        <td align=\"left\" colspan='2'>".htmlspecialchars($response[0]["domicilio_cliente"])."</td>
                    </tr>
                    <tr>
                        <td align=\"left\" >TEL&Eacute;FONO:</td>
                        <td align=\"left\" colspan='2'>".$response[0]["telefono_cliente"]."</td>
                    </tr>
                ";
            echo "</table>";
        }
        
	?>

	<div align="center">
    -----------------------------------------------------
        <div style="display: block;text-align: center;font-weight: bold;font-size: 9pt;margin-top: 10px;">
        	<img src="<?php echo RUTA_URL; ?>public/img/telefono_negro.png" style="width: 3%;margin-right: 3px;">(669) 990 92 58<br>
        </div>
        <div style="display: block;text-align: center;font-weight: bold;font-size: 9pt;">
        	<img src="<?php echo RUTA_URL; ?>public/img/whatsapp.png" style="width: 4%;margin-right: 3px;">(669) 254 88 68<br>
        </div>
        <div style="display: block;text-align: center;font-weight: bold;font-size: 9pt;">
        	<img src="<?php echo RUTA_URL; ?>public/img/instagram_negro.png" style="width: 4%;margin-right: 3px;">www.facebook.com/pizzaloscangry<br>
        </div>
        <div style="display: block;text-align: center;font-weight: bold;font-size: 9pt;">
        	<img src="<?php echo RUTA_URL; ?>public/img/facebook_negro.png" style="width: 4%;margin-right: 3px;">www.instagram.com/pizzaloscangry<br>
        </div>        
	</div>
</div>
</body>