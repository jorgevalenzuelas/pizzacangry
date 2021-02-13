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
                        <select id="<?php echo $porciones2[2];?>_<?php echo $i;?>_<?php echo $key+1;?>_<?php echo $j;?>" name="<?php echo $porciones2[2];?>_<?php echo $i;?>_<?php echo $key+1;?>_<?php echo $j;?>" class="form-control ns_"></select>
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
                for(var k = 1; k <= cantidad_productos; k++){
                    for (var index = 1; index <= arraypizzas.length; index++) {
                        var arraypizzas2 = arraypizzas[index-1].split("|");
                        for(var l = 1; l <= arraypizzas2[0]; l++){
                            select = $("#"+arraypizzas2[2]+"_"+k+"_"+index+"_"+l);
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
            for(var k = 1; k <= cantidad_productos; k++){
                Pizza = '';
                for (var index = 1; index <= arraypizzas.length; index++) {
                        var arraypizzas2 = arraypizzas[index-1].split("|");
                        Pizza += arraypizzas2[2]+"|";
                        for(var l = 1; l <= arraypizzas2[0]; l++){ 
                        Pizza += $("#"+arraypizzas2[2]+"_"+k+"_"+index+"_"+l).val() + "|";
                        if($("#"+arraypizzas2[2]+"_"+k+"_"+index+"_"+l).val() == '-1'){
                            entro = true;
                        }
                    }
                    Pizza = Pizza.substring(0, Pizza.length - 1)+"+";
                   
                }
                Pizza = Pizza.substring(0, Pizza.length - 1);
                Valores[k-1] = Pizza;
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
            var title = 'Tradicional bloqueado';
        var icon = 'fa fa-minus-circle';
        var color_icon = "color: #d12929;"
        var accion = "eliminarProductoTabla(this,'1')";
        

        var btn_eliminar = "<i class='" + icon + "' style='font-size:14px; " + color_icon + " cursor: pointer;' title='" + title + "' onclick=\"" + accion + "\"></i>";
        var myNumeroAleatorio = Math.floor(Math.random()*10001);
        tableProductos.row.add([
                valueCombo.nombrecompleto_producto ,
                valueCombo.precio_producto ,
                cantidad_productos ,
                btn_eliminar
            ]).node().id = valueCombo.cvema_producto+","+valueCombo.cveproducto_producto+","+Valores+","+myNumeroAleatorio;
            tableProductos.draw( false );
            $('#cmbProductos').val('');
            $('#txtCantidadProductos').val('1');
            $('#cmbProductos').focus();
            $("#modal_formCantidadProductos").modal('hide');//ocultamos el modal
            $("#modal_formIngredientesPaquete").modal('hide');//ocultamos el modal
            $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
            $('.modal-backdrop').remove();
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