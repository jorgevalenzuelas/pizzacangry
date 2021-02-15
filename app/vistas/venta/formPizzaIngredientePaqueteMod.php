<?php
//print_r($_POST);
?>
<div id="msgAlert4"></div>
<div class="box-body">
        <div class="row">
        <?php
        for($i = 1; $i <= $_POST["cantidad_productos"]; $i++){
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
                foreach ($porciones as $key=>$valor) {
                    $porciones2 = explode("|", $valor);
                ?>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label><?php echo $porciones2[1];?>*</label>
                    </div>
                </div>
                <?php
                for($j = 1; $j <= $porciones2[0]; $j++){
                ?>
                    <div class="form-group col-md-4">
                        <label>Ingrediente <?php echo $j;?>*</label>
                        <select id="_<?php echo $porciones2[2];?>_<?php echo $i;?>_<?php echo $key+1;?>_<?php echo $j;?>" name="<?php echo $porciones2[2];?>_<?php echo $i;?>_<?php echo $key+1;?>_<?php echo $j;?>" class="form-control ns_"></select>
                    </div>
        <?php 
                }
                ?>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Comentarios*</label>
                        <input type="text" class="form-control" id="desp_<?php echo $porciones2[2];?>_" onkeyup='javascript:this.value=this.value.toUpperCase();'>  
                    </div>
                </div>
                <?php
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
                for(var k = 1; k <= cantidad_productos; k++){
                    for (var index = 1; index <= arraypizzas.length; index++) {
                        var arraypizzas2 = arraypizzas[index-1].split("|");
                        for(var l = 1; l <= arraypizzas2[0]; l++){
                            select = $("#_"+arraypizzas2[2]+"_"+k+"_"+index+"_"+l);
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
                        
                            var cantidadIngreidentes2 = cantidadPizzas[aux2].split("|");
                            if(aux >  cantidadIngreidentes2[0]){
                                aux = 1;
                                aux2++;

                                if(aux2 == cantidadPizzas.length){
                                    aux2 = 0;
                                }
                                
                            }
                           
                        $("#_"+val.numpizza_depaqueteingrediente+"_"+val.numpaquete_depaqueteingrediente+"_"+val.numpizza_depaqueteingrediente+"_"+aux).val(val.cveingrediente_depaqueteingrediente);
                        $("#desp_"+val.numpizza_depaqueteingrediente+"_").val(val.descripcion_depaqueteingrediente);
                        aux++;
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
        
            for(var k = 1; k <= cantidad_productos; k++){
                Pizza = '';
                for (var index = 1; index <= arraypizzas.length; index++) {
                        var arraypizzas2 = arraypizzas[index-1].split("|");
                        Pizza += arraypizzas2[2]+"|"+$("#desp_"+arraypizzas2[2]+"_").val()+"|";
                        for(var l = 1; l <= arraypizzas2[0]; l++){ 
                        Pizza += $("#_"+arraypizzas2[2]+"_"+k+"_"+index+"_"+l).val() + "|";
                        if($("#_"+arraypizzas2[2]+"_"+k+"_"+index+"_"+l).val() == '-1'){
                            entro = true;
                        }
                    }
                    Pizza = Pizza.substring(0, Pizza.length - 1)+"+";
                
                }
                Pizza = Pizza.substring(0, Pizza.length - 1);
                Valores[k-1] = Pizza;
            }
            Valores = Valores.join('-');
    
       
        if(entro != true){


            $.ajax({
                url      : 'Venta/modificarDetadicionalVenta',
                type     : "POST",
                data     : { 
                    ban: 1,
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