<?php
//print_r($datos);
?>
<div id="msgAlert2"></div>

<form id="formSucursal" action="puesto/guardarPuesto" method="post">

    <div class="box-body">
        <div class="row">

            <div class="form-group col-md-6">
                <label>Nombre del Puesto*</label>
                <input type="text" class="form-control" id="txtNombrePuesto" name="txtNombrePuesto" onkeyup='javascript:this.value=this.value.toUpperCase();'>
            </div>

        </div>

    </div>

    

    <div class="box-footer">
        <button type="submit" class="btn btn-primary" id="btnGuardar">Guardar</button>
        <button class="btn btn-primary" id="btnCancelar">Cancelar</button>
    </div>

    <input type="hidden" id="txtcvePuesto" name="txtcvePuesto">
</form>

<script type="text/javascript">


    $('#formSucursal').on('submit',function(e){
        e.preventDefault();

        if ( $('#txtNombrePuesto').val()  == "" )
        {
            msgAlert2("Favor de ingresar el nombre del puesto.","warning");
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
                        $('#modal_formPuesto').modal('hide');

                        //var table = $('#gridPuestos').DataTable();
                                    
                        //table.clear();
                        //table.destroy();
                        
                        //Reinicializamos tabla
                        cargarTablaPuesto();

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
    
        $('#modal_formPuesto').modal('hide');

        return false;
    });


    function msgAlert2(msg,tipo)
    {
        $('#msgAlert2').css("display", "block");
        $("#msgAlert2").html("<div class='alert alert-" + tipo + "' role='alert'>" + msg + " <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> </div>");
    }

</script>