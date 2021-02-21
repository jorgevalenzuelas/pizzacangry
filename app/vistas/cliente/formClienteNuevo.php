<?php
//print_r($datos);
?>
<div id="msgAlert2Nuevo"></div>

<form id="formSucursal" action="cliente/guardarClienteNuevo" method="post">

    <div class="box-body">
        <div class="row">

            <div class="form-group col-md-12">
                <label>Nombre del Cliente*</label>
                <input type="text" class="form-control" id="txtNombreClienteNuevo" name="txtNombreClienteNuevo" onkeyup='javascript:this.value=this.value.toUpperCase();'>
                <label>Dirección</label>
                <input type="text" class="form-control" id="txtDireccionClienteNuevo" name="txtDireccionClienteNuevo" onkeyup='javascript:this.value=this.value.toUpperCase();'>
            </div>
        </div>
    </div>

    

    <div class="box-footer">
        <button type="submit" class="btn btn-primary" id="btnGuardar">Guardar</button>
        <button class="btn btn-primary" id="btnCancelar">Cancelar</button>
    </div>

    <input type="hidden" id="txtcveClienteNuevo" name="txtcveClienteNuevo">
</form>

<script type="text/javascript">


    $('#formSucursal').on('submit',function(e){
        e.preventDefault();

        if ( $('#txtNombreClienteNuevo').val()  == "" )
        {
            msgAlert2Nuevo("Favor de ingresar el nombre del cliente.","warning");
            setTimeout(function() { $("#msgAlert2Nuevo").fadeOut(1500); },3000);
        }
        else if ( $('#txtDireccionClienteNuevo').val()  == "" )
        {
            msgAlert2Nuevo("Favor de ingresar la dirección del cliente.","warning");
            setTimeout(function() { $("#msgAlert2Nuevo").fadeOut(1500); },3000);
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
                        

                        //var table = $('#gridClienteNuevos').DataTable();
                                    
                        //table.clear();
                        //table.destroy();
                        
                        //Reinicializamos tabla

                        msgAlert2Nuevo(myJson.msg ,"success");
                        setTimeout(function() { $("#msgAlert").fadeOut(1500); },3000);
                        $('#modal_formClienteNuevo').modal('hide');
                        //$('#msgAlert').css("display", "none");
                        $("#btnGuardar").prop('disabled', false);
                        $("#btnGuardar").html('Guardar');

                    }
                    else
                    {
                        $("#btnGuardar").prop('disabled', false);
                        msgAlert2Nuevo(myJson.msg ,"danger");
                    }
                }
            }); 
        }
    });

    
    $('#btnCancelar').click(function (e) {
    
        $('#modal_formClienteNuevo').modal('hide');

        return false;
    });


    function msgAlert2Nuevo(msg,tipo)
    {
        $('#msgAlert2Nuevo').css("display", "block");
        $("#msgAlert2Nuevo").html("<div class='alert alert-" + tipo + "' role='alert'>" + msg + " <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> </div>");
    }

</script>