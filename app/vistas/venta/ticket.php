<?php
session_start();
error_reporting(E_ALL);

$model = new VentaModelo();
$response = $model->consultarProductos2(1);
print_r($response);
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
   margin: 0;
}
</style>

<!--body-->
<body onload="window.print()" onafterprint="window.close()">
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
	<div align="center">

    	
	</div>

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