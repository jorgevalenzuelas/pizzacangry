<?php
//print_r($_POST);
?>
<div id="msgAlert2"></div>
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
            }
        }
        ?>
    <div class="box-footer">
                <button type="submit" class="btn btn-primary" id="btnAgregarTabla">Aceptar</button>
                <button class="btn btn-primary" data-dismiss="modal" data-dismiss="modal" id="btnCancelar2">Cancelar</button>
            </div>
        </div>

    </div>


    <input type="hidden" id="txtcvePuesto" name="txtcvePuesto">


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
                        else
                        {
                            document.getElementById("cmbIngredienteTradicional_1_1").selectedIndex = "0";
                            
                        }
                    }
                }
                

            }
        });
    }

    $('#btnCancelar2').click(function (e) {
    
        $('#modal_formSnack').modal('hide');
        $('#modal_formIngredientes').modal('hide');
        $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
        $('.modal-backdrop').remove();

        return false;
    });


    function msgAlert2(msg,tipo)
    {
        $('#msgAlert2').css("display", "block");
        $("#msgAlert2").html("<div class='alert alert-" + tipo + "' role='alert'>" + msg + " <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> </div>");
    }

</script>