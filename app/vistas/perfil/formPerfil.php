<?php
//print_r($datos);
?>
<div id="msgAlert2"></div>

<form id="formPerfil" action="perfil/guardarPerfil" method="post">

    <div class="box-body">
        <div class="form-group">
            <div class="form-group col-md-6">
                <label>Nombre del Perfil*</label>
                <input type="text" class="form-control" id="txtNombrePerfil" name="txtNombrePerfil" onkeyup='javascript:this.value=this.value.toUpperCase();'>
            </div>

            <div class="form-group col-md-6">
                <label>Descipción del Perfil*</label>
                <input type="text" class="form-control" id="txtDescipcionPerfil" name="txtDescipcionPerfil" onkeyup='javascript:this.value=this.value.toUpperCase();'>
            </div>

        </div>

    </div>

    <hr style="border-top: 1px solid #d2d6de; margin-top: 5px; margin-bottom: 5px;">

    <div class="box-body">
        <div class="form-group">

            <h5>Accesos</h5>

            <div class="form-group col-md-12" style="height: 300px; overflow-y: scroll;">
                
                <ul id="treeview">

                    <?php
                    foreach ($datos as $valor1)
                    {
                        $existe = 0;
                        foreach ($valor1[subopcion] as $val_chk){ if ($val_chk[chk] == 1){ $existe = $existe + 1; } }
                        if ($existe >= 1){ $checked = "checked"; }else{ $checked = ""; } 

                    ?>

                    <li style="margin-top: 20px;">

                        <input type="checkbox" name="<?php echo 'chk1_' . $valor1['nombre_opcion']; ?>" id="<?php echo "chk1_" . $valor1["nombre_opcion"]; ?>" value="" <?php echo $checked; ?>>
                        <label for="<?php echo $valor1["nombre_opcion"]; ?>"><?php echo $valor1["nombre_opcion"]; ?></label>

                        <ul id="treeview">

                            <?php
                            foreach ($valor1["subopcion"] as $valor2)
                            {
                                if ($valor2["chk"] == 1){ $checked = "checked"; }else{ $checked = "";} 
                            ?>
                            <li>
                                <input type="checkbox" name="<?php echo "chk2_" . $valor2["metodo_opcion"]; ?>" id="<?php echo "chk2_" . $valor2["metodo_opcion"]; ?>" value="<?php echo $valor2["cve_opcion"]; ?>" <?php echo $checked; ?> >
                                <label for="<?php echo "chk2_" . $valor2["metodo_opcion"]; ?>" style=" font-weight: normal;"><?php echo $valor2["nombre_opcion"]; ?></label>
                            </li>
                            <?php
                            }
                            ?>

                        </ul>

                    </li>

                    <?php
                    }
                    ?>

                </ul>

            </div>

        </div>

    </div>

    <div class="box-footer">
        <button type="submit" class="btn btn-primary" id="btnGuardar">Guardar</button>
        <button class="btn btn-primary" id="btnCancelar">Cancelar</button>
    </div>

    <input type="hidden" id="txtcvePerfil" name="txtcvePerfil">
</form>

<script type="text/javascript">

    $('input[type="checkbox"]').change(function(e) {

        var checked = $(this).prop("checked"),
            container = $(this).parent(),
            siblings = container.siblings();

            //console.log (siblings);
            //alert ($(this).parent().siblings().children(":checkbox:checked").length);

        container.find('input[type="checkbox"]').prop({
            indeterminate: false,
            checked: checked
        });

        function checkSiblings(el) {

            var parent = el.parent().parent(),
                all = true;

            el.siblings().each(function() {
                return all = ($(this).children('input[type="checkbox"]').prop("checked") === checked);
            });

            if (all && checked) {

                parent.children('input[type="checkbox"]').prop({
                  indeterminate: false,
                  checked: checked
                });

                checkSiblings(parent);

            } else if (all && !checked) {

                parent.children('input[type="checkbox"]').prop("checked", checked);
                parent.children('input[type="checkbox"]').prop("checked", (parent.find('input[type="checkbox"]:checked').length > 0));
                checkSiblings(parent);

            } else {

                el.parents("li").children('input[type="checkbox"]').prop({
                  //indeterminate: true,
                  checked: true
                });

            }

        }

        checkSiblings(container);
    });


    $('#formPerfil').on('submit',function(e){
        e.preventDefault();

        if ( $('#txtNombrePerfil').val()  == "" )
        {
            msgAlert2("Favor de ingresar el nombre del perfil.","warning");
            setTimeout(function() { $("#msgAlert2").fadeOut(1500); },3000);
        }
        else if ( $('#txtDescipcionPerfil').val() == "" )
        {
            msgAlert2("Favor de ingresar la descripción del perfil.","warning");
            setTimeout(function() { $("#msgAlert2").fadeOut(1500); },3000);
        }
        else
        {

            $("#btnGuardar").prop('disabled', true);
            
            $.ajax({
                url      : $(this).attr('action'),
                data     : $(this).serialize(),
                type: "POST",
                success: function(datos){

                    var myJson = JSON.parse(datos);
                    
                    if(myJson.status == "success")
                    {
                        $('#modal_formPerfiles').modal('hide');

                        //var table = $('#gridPerfiles').DataTable();
                                    
                        //table.clear();
                        //table.destroy();
                        
                        //Reinicializamos tabla
                        cargarTablaPerfil();

                        msgAlert(myJson.msg ,"success");
                        setTimeout(function() { $("#msgAlert").fadeOut(1500); },3000);

                        //$('#msgAlert').css("display", "none");
                        $("#btnGuardar").prop('disabled', false);
                        $("#btnGuardar").html('Guardar');

                    }
                    else
                    {
                        $("#btnGuardar").prop('disabled', false);
                        msgAlert2(myJson.msg ,"danger");
                    }
                }
            }); 
        }
    });

    
    $('#btnCancelar').click(function (e) {
    
        $('#modal_formPerfiles').modal('hide');

        return false;
    });


    function msgAlert2(msg,tipo)
    {
        $('#msgAlert2').css("display", "block");
        $("#msgAlert2").html("<div class='alert alert-" + tipo + "' role='alert'>" + msg + " <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> </div>");
    }

</script>