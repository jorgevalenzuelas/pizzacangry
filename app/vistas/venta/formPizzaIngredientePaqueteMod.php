<?php
//print_r($_POST);
?>
<div id="msgAlert4"></div>
<div class="box-body">
        <div class="row">
        <?php
        //cantidad de paquetes siempre sera 1
        for($noPaquete = 1; $noPaquete <= $_POST["cantidad_productos"]; $noPaquete++){
        ?>
            <div class="row">
                <div class="form-group col-md-12">
                    <label>PAQUETE <?php echo $i;?>*</label>
                </div>
            </div>
            <?php
            ?>
                
                <?php
                $porciones = explode(",", $_POST["cantidadingrediente_producto"]);
                //estas son las tandas o numeros de pizzas pero agrupados por separar
                foreach ($porciones as $tanda=>$valor) {
                    $porciones2 = explode("|", $valor);
                    for($noPizza = 1; $noPizza <= $porciones2[0]; $noPizza++){
                ?>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label><?php echo $porciones2[2];?>*</label>
                        <div class="form-check pull-right">
                            <input class="form-check-input" type="checkbox" value="" id="_extra_<?php echo $noPaquete;?>_<?php echo $tanda+1;?>_<?php echo $noPizza;?>">
                            <label class="form-check-label" for="flexCheckDefault">
                                QUESO FILADELFIA
                            </label>
                        </div>
                    </div>
                </div>
                <?php
                for($noIngrediente = 1; $noIngrediente <= $porciones2[1]; $noIngrediente++){
                ?>
                    <div class="form-group col-md-4">
                        <label>Ingrediente <?php echo $j;?>*</label>
                        <select id="_<?php echo $noPaquete;?>_<?php echo $tanda+1;?>_<?php echo $noPizza;?>_<?php echo $noIngrediente;?>_<?php echo $porciones2[3];?>" name="<?php echo $porciones2[2];?>_<?php echo $i;?>_<?php echo $key+1;?>_<?php echo $j;?>" class="form-control ns_"></select>
                    </div>
        <?php 
                }
                ?>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Comentarios*</label>
                        <input type="text" class="form-control" id="_desp_<?php echo $noPaquete;?>_<?php echo $tanda+1;?>_<?php echo $noPizza;?>" onkeyup='javascript:this.value=this.value.toUpperCase();'>  
                    </div>
                </div>
                <?php
                }
            }
        }
        ?>
    <div class="box-footer">
                <button type="submit" class="btn btn-primary" id="btnAgregarTablaPaqueteMod">Aceptar</button>
                <button class="btn btn-primary" data-dismiss="modal" data-dismiss="modal" id="btnCancelarPaqueteMod">Cancelar</button>
            </div>
        </div>

    </div>


<script type="text/javascript">
var cantidad_productos = '<?php echo $_POST["cantidad_productos"];?>';
var cantidadingrediente_producto = '<?php echo $_POST["cantidadingrediente_producto"]?>';
var pizzas = cantidadingrediente_producto;
var arraypizzas = pizzas.split(",");
$(document).ready(function () {
    cargarIngrediente();
});
function cargarIngrediente(){
        $.ajax({
            url      : 'Ingrediente/consultar',
            type     : "POST",
            data    : { 
                ban: 3
            },
            beforeSend: function() {
                // setting a timeout

            },
            success  : function(datos) {

                var myJson = JSON.parse(datos);
                for(var noPaquete = 1; noPaquete <= cantidad_productos; noPaquete++){
                    for (var tanda = 0; tanda < arraypizzas.length; tanda++) {
                        var arraypizzas2 = arraypizzas[tanda].split("|");
                        for(var noPizza = 1; noPizza <= arraypizzas2[0]; noPizza++){
                            for(var noIngrediente = 1; noIngrediente <= arraypizzas2[1]; noIngrediente++){
                            select = $("#_"+noPaquete+"_"+(tanda+1)+"_"+noPizza+"_"+noIngrediente+"_"+arraypizzas2[3]);
                            select.attr('disabled',false);
                            select.find('option').remove();
                            select.append('<option value="-1">-- Selecciona --</option>');

                            if(myJson.arrayDatos.length > 0)
                            {
                                $(myJson.arrayDatos).each( function(key, val)
                                {
                                    select.append('<option value="' + val.cve_ingrediente + '">' + val.nombre_ingrediente + '</option>');
                                })

                            }
                        }
                    }
                    }
                }
                
                <?php if($_POST["cve_deventa"] != ''){?>
                    consultarIngredientesComandaPaquete(<?php echo $_POST["cve_deventa"];?>, <?php echo $_POST["cantidad_productos"];?>, '<?php echo $_POST["cantidadingrediente_producto"];?>');
                
                <?php }?>
            }
        });
    }

    function consultarIngredientesComandaPaquete(cve_deventa, cantidad_deventa, cantidadingrediente_producto){
        //alert(cantidadingrediente_producto);
        $.ajax({
            url      : 'Venta/consultarComanda',
            type     : "POST",
            data    : { 
                ban: 3 ,
                folio: cve_deventa
            },
            success  : function(datos) {

                var myJson = JSON.parse(datos);


                if(myJson.arrayDatos.length > 0)
                {

                    var aux = 1;
                    var aux2 = 0;
                    var aux3 = 1;
                    var cantidadPizzas = cantidadingrediente_producto.split(",");
                   
                    $(myJson.arrayDatos).each( function(key, val)
                    {

                        //alert("#_"+val.numpaquete_depaqueteingrediente+"_"+val.numtanda_depaqueteingrediente+"_"+val.numpizza_depaqueteingrediente+"_"+val.numingrediente_depaqueteingrediente+"_"+val.cvetradicional_depaqueteingrediente);
                        $("#_"+val.numpaquete_depaqueteingrediente+"_"+val.numtanda_depaqueteingrediente+"_"+val.numpizza_depaqueteingrediente+"_"+val.numingrediente_depaqueteingrediente+"_"+val.cvetradicional_depaqueteingrediente).val(val.cveingrediente_depaqueteingrediente).change();
                        $("#_desp_"+val.numpaquete_depaqueteingrediente+"_"+val.numtanda_depaqueteingrediente+"_"+val.numpizza_depaqueteingrediente).val(val.descripcion_depaqueteingrediente);
                        if(val.extra_depaqueteingrediente == '1'){
                            $("#_extra_"+val.numpaquete_depaqueteingrediente+"_"+val.numtanda_depaqueteingrediente+"_"+val.numpizza_depaqueteingrediente).attr('checked', true);
                        }
                        else{
                            $("#_extra_"+val.numpaquete_depaqueteingrediente+"_"+val.numtanda_depaqueteingrediente+"_"+val.numpizza_depaqueteingredientes).attr('checked', false);
                        }
                    })

                }
                else
                {
                   
                    
                }

            }
        });
    }

    $('#btnAgregarTablaPaqueteMod').click(function (e) {

        var Pizza = '';
        var Valores = [];
        var entro = false;
        
            
        for(var noPaquete = 1; noPaquete <= cantidad_productos; noPaquete++){
            Pizza = '';
            for (var tanda = 0; tanda < arraypizzas.length; tanda++) {
                var arraypizzas2 = arraypizzas[tanda].split("|");
                for(var noPizza = 1; noPizza <= arraypizzas2[0]; noPizza++){
                    if ($("#_extra_"+noPaquete+"_"+(tanda+1)+"_"+noPizza).is(":checked"))
                            {
                                checkbox = 1;
                            }
                            else{
                                checkbox = 0;
                            }
                    Pizza += arraypizzas2[3]+"|"+$("#_desp_"+noPaquete+"_"+(tanda+1)+"_"+noPizza).val()+"|"+checkbox+"|";
                    for(var noIngrediente = 1; noIngrediente <= arraypizzas2[1]; noIngrediente++){

                        Pizza += $("#_"+noPaquete+"_"+(tanda+1)+"_"+noPizza+"_"+noIngrediente+"_"+arraypizzas2[3]).val() + "|";
                        if($("#_"+noPaquete+"_"+(tanda+1)+"_"+noPizza+"_"+noIngrediente+"_"+arraypizzas2[3]).val() == '-1'){
                            entro = true;
                        }
                    }
                    Pizza = Pizza.substring(0, Pizza.length - 1);
                    Pizza += "-";
                }
                Pizza = Pizza.substring(0, Pizza.length - 1)+"+";
            }
            Pizza = Pizza.substring(0, Pizza.length - 1);
            Valores[noPaquete-1] = Pizza;
        }
        Valores = Valores.join('-');
    
       
        if(entro != true){


            $.ajax({
                url      : 'Venta/modificarDetadicionalVenta',
                type     : "POST",
                data     : { 
                    ban: 1,
                    folio_venta : $("#txtFolioVenta").text(),
                    cve_deventa: <?php echo $_POST["cve_deventa"];?>,
                    cveproducto_deventa : 5,
                    cantidad_deventa : cantidad_productos,
                    deingredientes : Valores
                },
                success  : function(datos) {
                    consultarComanda($("#txtFolioVenta").text());
                }
            });

            $('#cmbProductos').val('');
            $('#txtCantidadProductos').val('1');
            $('#cmbProductos').focus();
            $("#modal_formCantidadProductos").modal('hide');//ocultamos el modal
            $("#modal_formIngredientesPaqueteMod").modal('hide');//ocultamos el modal
            $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
            $('.modal-backdrop').remove();
            
        }
        else{
            msgAlert4("Favor de ingresar todos los ingredientes","warning");
        }


    });

    $('#btnCancelarPaqueteMod').click(function (e) {
        $('#cmbProductos').val('');
        $('#txtCantidadProductos').val('1');
        $('#cmbProductos').focus();
        $('#modal_formCantidadProductos').modal('hide');
        $('#modal_formIngredientesPaqueteMod').modal('hide');
        $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
        $('.modal-backdrop').remove();

        return false;
    });

    
    


</script>