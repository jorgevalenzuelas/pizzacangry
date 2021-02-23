<?php
//print_r($datos);
?>
<div id="msgAlert2"></div>

<form id="formSucursal" action="cliente/guardarCliente" method="post">

    <div class="box-body">
        <div class="row">

            <div class="form-group col-md-12">
                <label>Nombre del Cliente*</label>
                <input type="text" class="form-control" id="txtNombreCliente" name="txtNombreCliente" onkeyup='javascript:this.value=this.value.toUpperCase();'>
                <label>Dirección</label>
                <input type="text" class="form-control" id="txtDireccionCliente" name="txtDireccionCliente" onkeyup='javascript:this.value=this.value.toUpperCase();'>
                <label>Teléfono</label>
                <input type="number" class="form-control" id="txtTelefonoCliente" name="txtTelefonoCliente" onkeyup='javascript:this.value=this.value.toUpperCase();'>
            </div>
        </div>
    </div>

    

    <div class="box-footer">
        <button type="submit" class="btn btn-primary" id="btnGuardarCliente">Guardar</button>
        <button class="btn btn-primary" id="btnCancelar">Cancelar</button>
    </div>

    <input type="hidden" id="txtcveCliente" name="txtcveCliente">
</form>

<script type="text/javascript">


    $('#formSucursal').on('submit',function(e){
        e.preventDefault();

        if ( $('#txtNombreCliente').val()  == "" )
        {
            msgAlert2("Favor de ingresar el nombre del cliente.","warning");
            setTimeout(function() { $("#msgAlert2").fadeOut(1500); },3000);
        }
        else if ( $('#txtDireccionCliente').val()  == "" )
        {
            msgAlert2("Favor de ingresar la dirección del cliente.","warning");
            setTimeout(function() { $("#msgAlert2").fadeOut(1500); },3000);
        }
        else if ( $('#txtTelefonoCliente').val()  == "" )
        {
            msgAlert2("Favor de ingresar el telefono del cliente.","warning");
            setTimeout(function() { $("#msgAlert2").fadeOut(1500); },3000);
        }
        else
        {

            $("#btnGuardarCliente").prop('disabled', true);
            
            $.ajax({
                url      : $(this).attr('action'),
                data     : $(this).serialize(),
                type: "POST",
                success: function(datos){

                    var myJson = JSON.parse(datos);
                    
                    if(myJson.status == "success")
                    {
                        $('#modal_formCliente').modal('hide');

                        //var table = $('#gridClientes').DataTable();
                                    
                        //table.clear();
                        //table.destroy();
                        
                        //Reinicializamos tabla
                        cargarTablaCliente();

                        msgAlert(myJson.msg ,"success");
                        setTimeout(function() { $("#msgAlert").fadeOut(1500); },3000);

                        //$('#msgAlert').css("display", "none");
                        $("#btnGuardarCliente").prop('disabled', false);
                        $("#btnGuardarCliente").html('Guardar');

                    }
                    else
                    {
                        $("#btnGuardarCliente").prop('disabled', false);
                        msgAlert2(myJson.msg ,"danger");
                    }
                }
            }); 
        }
    });

    
    $('#btnCancelar').click(function (e) {
    
        $('#modal_formCliente').modal('hide');

        return false;
    });


    function msgAlert2(msg,tipo)
    {
        $('#msgAlert2').css("display", "block");
        $("#msgAlert2").html("<div class='alert alert-" + tipo + "' role='alert'>" + msg + " <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> </div>");
    }

</script>