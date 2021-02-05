<?php
//print_r($datos);
?>
<div id="msgAlert2"></div>

<form id="formSucursal" action="sucursal/guardarSucursal" method="post">

    <div class="box-body">
        <div class="row">

            <div class="form-group col-md-6">
                <label>Nombre de Sucursal*</label>
                <input type="text" class="form-control" id="txtNombreSucursal" name="txtNombreSucursal" onkeyup='javascript:this.value=this.value.toUpperCase();'>
            </div>

        </div>

        <div class="row">

            <div class="form-group col-md-6">
                <label>Dirección*</label>
                <input type="text" class="form-control" id="txtDireccion" name="txtDireccion" onkeyup='javascript:this.value=this.value.toUpperCase();'>
            </div>

            <div class="form-group col-md-6">
                <label>Colonia*</label>
                <input type="text" class="form-control" id="txtColonia" name="txtColonia" onkeyup='javascript:this.value=this.value.toUpperCase();'>
            </div>

        </div>

        <div class="row">
            
            <div class="form-group col-md-6">
                <label>Telefono</label>
                <input type="text" class="form-control" id="txtTelefono" name="txtTelefono" onKeyPress="return soloNumeros(event);">
            </div>

            <div class="form-group col-md-6">
                <label>Tipo*</label>
                <select class="form-control" id="cmbTipo" name="cmbTipo">
                    <option value="-1">- SELECCIONAR -</option>
                    <option value="1">SUCURSAL</option>
                    <option value="2">ALMACÉN</option>
                </select>
            </div>

        </div>

        <div class="row">
            
            <div class="form-group col-md-6">
                <label>Representante</label>
                <input type="text" class="form-control" id="txtRepresentante" name="txtRepresentante" onkeyup='javascript:this.value=this.value.toUpperCase();'>
            </div>

        </div>

    </div>

    

    <div class="box-footer">
        <button type="submit" class="btn btn-primary" id="btnGuardar">Guardar</button>
        <button class="btn btn-primary" id="btnCancelar">Cancelar</button>
    </div>

    <input type="hidden" id="txtcveSucursal" name="txtcveSucursal">
</form>

<script type="text/javascript">


    $('#formSucursal').on('submit',function(e){
        e.preventDefault();

        if ( $('#txtNombreSucursal').val()  == "" )
        {
            msgAlert2("Favor de ingresar el nombre de la sucursal.","warning");
            setTimeout(function() { $("#msgAlert2").fadeOut(1500); },3000);
        }
        else if ( $('#txtDireccion').val() == "" )
        {
            msgAlert2("Favor de ingresar la dirección de la sucursal.","warning");
            setTimeout(function() { $("#msgAlert2").fadeOut(1500); },3000);
        }
        else if ( $('#txtColonia').val() == "" )
        {
            msgAlert2("Favor de ingresar la colonia de la sucursal.","warning");
            setTimeout(function() { $("#msgAlert2").fadeOut(1500); },3000);
        }
        else if ( $('#cmbTipo').val() == "" )
        {
            msgAlert2("Favor de seleccionar el Tipo.","warning");
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
                        $('#modal_formSucursal').modal('hide');

                        //var table = $('#gridSucursal').DataTable();
                                    
                        //table.clear();
                        //table.destroy();
                        
                        //Reinicializamos tabla
                        cargarTablaSucursal();

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
    
        $('#modal_formSucursal').modal('hide');

        return false;
    });


    function msgAlert2(msg,tipo)
    {
        $('#msgAlert2').css("display", "block");
        $("#msgAlert2").html("<div class='alert alert-" + tipo + "' role='alert'>" + msg + " <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> </div>");
    }

</script>