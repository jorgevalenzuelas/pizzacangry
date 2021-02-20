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
                            <input class="form-check-input" type="checkbox" value="" id="extra_<?php echo $noPaquete;?>_<?php echo $tanda+1;?>_<?php echo $noPizza;?>">
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
                        <select id="<?php echo $noPaquete;?>_<?php echo $tanda+1;?>_<?php echo $noPizza;?>_<?php echo $noIngrediente;?>_<?php echo $porciones2[3];?>" name="<?php echo $porciones2[2];?>_<?php echo $i;?>_<?php echo $key+1;?>_<?php echo $j;?>" class="form-control ns_"></select>
                    </div>
        <?php 
                }
                ?>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Comentarios*</label>
                        <input type="text" class="form-control" id="desp_<?php echo $noPaquete;?>_<?php echo $tanda+1;?>_<?php echo $noPizza;?>" onkeyup='javascript:this.value=this.value.toUpperCase();'>  
                    </div>
                </div>
                <?php
                }
            }
        }
        ?>
    <div class="box-footer">
                <button type="submit" class="btn btn-primary" id="btnAgregarTablaPaquete">Aceptar</button>
                <button class="btn btn-primary" data-dismiss="modal" data-dismiss="modal" id="btnCancelarPaquete">Cancelar</button>
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
                            select = $("#"+noPaquete+"_"+(tanda+1)+"_"+noPizza+"_"+noIngrediente+"_"+arraypizzas2[3]);
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
                

            }
        });
    }

    $('#btnCancelarPaquete').click(function (e) {
        $('#cmbProductos').val('');
        $('#txtCantidadProductos').val('1');
        $('#cmbProductos').focus();
        $('#modal_formCantidadProductos').modal('hide');
        $('#modal_formIngredientesPaquete').modal('hide');
        $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
        $('.modal-backdrop').remove();

        return false;
    });

    $('#btnAgregarTablaPaquete').click(function (e) {


        var val = $('#cmbProductos').val() ? $('#cmbProductos').val() : '';
        // se agrego indexOf para saber si el string val viene con comillas o apostrofe y formar bien la cadena
        if(val.indexOf("\"") !== -1){
            var valueCombo = $("#cmbContactosListMod").find("option[value='"+val+"']").data("value") ? $("#cmbContactosListMod").find("option[value='"+val+"']").data("value") : "";
        }
        else{
        var valueCombo = $("#cmbContactosListMod").find("option[value=\""+val+"\"]").data("value") ? $("#cmbContactosListMod").find("option[value=\""+val+"\"]").data("value") : "";
        }

        var Pizza = '';
        var Valores = [];
        var entro = false;
        if(valueCombo.cveproducto_producto == 5){
            Pizza = '';
            Valores = [];

            for(var noPaquete = 1; noPaquete <= cantidad_productos; noPaquete++){
                Pizza = '';
                for (var tanda = 0; tanda < arraypizzas.length; tanda++) {
                    var arraypizzas2 = arraypizzas[tanda].split("|");
                    for(var noPizza = 1; noPizza <= arraypizzas2[0]; noPizza++){
                        if ($("#extra_"+noPaquete+"_"+(tanda+1)+"_"+noPizza).is(":checked"))
                            {
                                checkbox = 1;
                            }
                            else{
                                checkbox = 0;
                            }
                        Pizza += arraypizzas2[3]+"|"+$("#desp_"+noPaquete+"_"+(tanda+1)+"_"+noPizza).val()+"|"+checkbox+"|";
                        for(var noIngrediente = 1; noIngrediente <= arraypizzas2[1]; noIngrediente++){

                            Pizza += $("#"+noPaquete+"_"+(tanda+1)+"_"+noPizza+"_"+noIngrediente+"_"+arraypizzas2[3]).val() + "|";
                            if($("#"+noPaquete+"_"+(tanda+1)+"_"+noPizza+"_"+noIngrediente+"_"+arraypizzas2[3]).val() == '-1'){
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
        }

        //tradicional es : 1|3-1|2
            //paquete es : 1[1|2-2|3]
        else {
            //el paquete piiede tener varias pizzas tradicionales con diferentes ingredientes
            Valores = 0;
        }
        if(entro != true){


            $.ajax({
                url      : 'Venta/GuardarVenta',
                type     : "POST",
                data     : { 
                        ban: 1,
                        cve_deventa: 0,
                        folioventa_deventa : $("#txtFolioVenta").text(),
                        cvema_deventa : valueCombo.cvema_producto,
                        cantidad_deventa : cantidad_productos,
                        preciounitario_deventa : valueCombo.precio_producto,
                        cveproducto_deventa :   5,
                        deingredientes : Valores
                },
                success  : function(datos) {
                    $('#cmbProductos').val('');
                    $('#txtCantidadProductos').val('1');
                    $('#cmbProductos').focus();
                    $("#modal_formCantidadProductos").modal('hide');//ocultamos el modal
                    $("#modal_formIngredientesPaquete").modal('hide');//ocultamos el modal
                    $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
                    $('.modal-backdrop').remove();
                    consultarComanda($("#txtFolioVenta").text());
                }
            });
            
        }
        else{
            msgAlert4("Favor de ingresar todos los ingredientes","warning");
        }
        
        
    });
    


    function msgAlert4(msg,tipo)
    {
        $('#msgAlert4').css("display", "block");
        $("#msgAlert4").html("<div class='alert alert-" + tipo + "' role='alert'>" + msg + " <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> </div>");
        setTimeout(function() { $("#msgAlert4").fadeOut(1500); },1500);
    }

</script>