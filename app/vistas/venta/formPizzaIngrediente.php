<?php
//print_r($_POST);
?>
<div id="msgAlert3"></div>
    <div class="box-body">
        <div class="row">
            <?php
            for($i = 1; $i <= $_POST["cantidad_productos"]; $i++){
            ?>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Pizza <?php echo $i;?>*</label>
                    </div>
                </div>
                <?php
                for($j = 1; $j <= $_POST["cantidadingrediente_producto"]; $j++){
                ?>
                    <div class="form-group col-md-4">
                        <label>Ingrediente <?php echo $j;?>*</label>

                        <select id="<?php echo $i;?>_<?php echo $j;?>" name="<?php echo $i;?>_<?php echo $j;?>" class="form-control ns_"></select>
                    </div>
            <?php 
                } ?>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Comentarios*</label>
                        <input type="text" class="form-control" id="des_<?php echo $i;?>" name="des_<?php echo $i;?>" onkeyup='javascript:this.value=this.value.toUpperCase();'>  
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    <div class="box-footer">
                <button type="submit" class="btn btn-primary" id="btnAgregarTablaPizza">Agregar</button>
                <button class="btn btn-primary" data-dismiss="modal" data-dismiss="modal" id="btnCancelarPizza">Cancelar</button>
            </div>
        </div>

    </div>

<script type="text/javascript">
var cantidad_productos = '<?php echo $_POST["cantidad_productos"];?>'
var cantidadingrediente_producto = '<?php echo $_POST["cantidadingrediente_producto"]?>';
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
                for(var k = 1; k <= cantidad_productos; k++){
                    for(var l = 1; l <= cantidadingrediente_producto; l++){
                        select = $("#"+k+"_"+l);
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
        });
    }

    $('#btnCancelarPizza').click(function (e) {
        $('#cmbProductos').val('');
        $('#txtCantidadProductos').val('1');
        $('#cmbProductos').focus();
        $('#modal_formCantidadProductos').modal('hide');
        $('#modal_formIngredientes').modal('hide');
        $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
        $('.modal-backdrop').remove();

        return false;
    });

    $('#btnAgregarTablaPizza').click(function (e) {


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

        if(valueCombo.cveproducto_producto == 1){
            Pizza = '';
            Valores = [];
            for(var k = cantidad_productos; k >= 1; k--){
                Pizza = '';
                for(var l = 1; l <= cantidadingrediente_producto; l++){ 
                    Pizza += $("#"+k+"_"+l).val() + "|";
                    if ($("#"+k+"_"+l).val() == '-1'){
                        entro = true;
                    }
                }
                Pizza = Pizza.substring(0, Pizza.length - 1);
                Valores[k-1] = k+"|"+$("#des_"+k).val()+"|"+Pizza;
            }
            Valores = Valores.join('-');
        }
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
                        cveproducto_deventa :   '1',
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
            $("#modal_formIngredientes").modal('hide');//ocultamos el modal
            $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
            $('.modal-backdrop').remove();
        }
        else{
            msgAlert3("Favor de ingresar todos los ingredientes","warning");
        }
        
        
    });
    


    function msgAlert3(msg,tipo)
    {
        $('#msgAlert3').css("display", "block");
        $("#msgAlert3").html("<div class='alert alert-" + tipo + "' role='alert'>" + msg + " <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> </div>");
        setTimeout(function() { $("#msgAlert3").fadeOut(1500); },1500);
    }

</script>