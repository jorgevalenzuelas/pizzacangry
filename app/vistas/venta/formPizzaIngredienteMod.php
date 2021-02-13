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

                        <select id="_<?php echo $i;?>_<?php echo $j;?>" name="_<?php echo $i;?>_<?php echo $j;?>" class="form-control ns_"></select>
                    </div>
            <?php 
                }
            }
            ?>
        </div>
    <div class="box-footer">
                <button type="submit" class="btn btn-primary" id="btnAgregarTablaPizzaMod">Modificar</button>
                <button class="btn btn-primary" data-dismiss="modal" data-dismiss="modal" id="btnCancelarPizzaMod">Cancelar</button>
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
                        select = $("#_"+k+"_"+l);
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

                <?php if($_POST["cve_deventa"] != ''){?>
                consultarIngredientesComandaTradicional(<?php echo $_POST["cve_deventa"];?>, <?php echo $_POST["cantidad_productos"];?>, <?php echo $_POST["cantidadingrediente_producto"];?>);
                
                <?php }?>
            }
        });
    }

    function consultarIngredientesComandaTradicional(cve_deventa, cantidad_deventa, cantidadingrediente_producto){
        $.ajax({
            url      : 'Venta/consultarComanda',
            type     : "POST",
            data    : { 
                ban: 2 ,
                folio: cve_deventa
            },
            success  : function(datos) {

                var myJson = JSON.parse(datos);


                if(myJson.arrayDatos.length > 0)
                {

                    var aux = 1;
                    $(myJson.arrayDatos).each( function(key, val)
                    {
                        if(aux > cantidadingrediente_producto){
                            aux = 1;
                        }
                        
                        $("#_"+val.numpizza_detradicionalingrediente+"_"+aux).val(val.cveingrediente_detradicionalingrediente);
                        
                        aux++;
                    })

                }
                else
                {
                   
                    
                }

            }
        });
    }

    $('#btnAgregarTablaPizzaMod').click(function (e) {

        var Pizza = '';
        var Valores = [];
        var entro = false;

            Pizza = '';
            Valores = [];
            for(var k = cantidad_productos; k >= 1; k--){
                Pizza = '';
                for(var l = 1; l <= cantidadingrediente_producto; l++){ 
                    Pizza += $("#_"+k+"_"+l).val() + "|";
                    if ($("#_"+k+"_"+l).val() == '-1'){
                        entro = true;
                    }
                }
                Pizza = Pizza.substring(0, Pizza.length - 1);
                Valores[k-1] = k+"|"+Pizza;
            }
            Valores = Valores.join('-');
      

        if(entro != true){



            $.ajax({
                url      : 'Venta/modificarDetadicionalVenta',
                type     : "POST",
                data     : { 
                        ban: 1,
                        cve_deventa: <?php echo $_POST["cve_deventa"];?>,
                        cveproducto_deventa : 1,
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
            $("#modal_formIngredientesMod").modal('hide');//ocultamos el modal
            $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
            $('.modal-backdrop').remove();
        }
        else{
            msgAlert3("Favor de ingresar todos los ingredientes","warning");
        }


        });

</script>