
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo NOMBRE_SITIO; ?> | Tradicionales</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL; ?>public/css/estilos.css">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>public/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>public/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>public/bower_components/Ionicons/css/ionicons.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>public/plugins/iCheck/all.css">
    <!-- DataTables -->
     <link rel="stylesheet" href="<?php echo RUTA_URL; ?>public/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>public/dist/css/AdminLTE.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>public/dist/css/skins/_all-skins.min.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="chortcut icon" type="image/png" href="<?php echo RUTA_URL; ?>public/img/LogoPpaty_icon.png" />

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <?php 
    include RUTA_APP . 'vistas/includes/header.php';

    include RUTA_APP . 'vistas/includes/left_sidebar_menu.php'; 
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Tradicionales
            </h1>

        </section>

        <!-- Main content -->
        <section class="content">

            <div id="msgAlert"></div>

            <button class="btn btn-primary" id="btnMostraModalTradicional">Nueva tradicional</button>
      
            <div class="box" style="margin-top: 20px;">
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="gridTradicional" class="table table-bordered table-striped" style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th>Nombre tradicional</th>
                                <th>Costo</th>
                                <th>Precio publico</th>
                                <th>Editar</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->
    
    <?php 
    //include RUTA_APP . 'vistas/includes/footer.php';

    include RUTA_APP . 'vistas/includes/control_sidebar_right.php';
    ?>

</div>
<!-- ./wrapper -->

<!-- modales -->
<div class="modal fade" id="modal_formTradicional" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" >
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="myModalLabel">Tradicional</h2>
            </div>
            <div class="modal-body" id="muestra_formTradicional">
                <input type="hidden" id="txtcveTradicional" name="txtcveTradicional">
                <div class="row">
                    <div class="form-group col-md-12">
                        <div id="msgAlert2"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Nombre tradicional*</label>
                        <input type="text" class="form-control" id="txtNombreTradicional" name="txtNombreTradicional" onkeyup='javascript:this.value=this.value.toUpperCase();'>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Costo*</label>
                        <input type="number" min='0' class="form-control" id="txtCostoTradicional" name="txtCostoTradicional" onkeyup='javascript:this.value=this.value.toUpperCase();'>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Precio publico*</label>
                        <input type="number" min='0' class="form-control" id="txtPrecioTradicional" name="txtPrecioTradicional" onkeyup='javascript:this.value=this.value.toUpperCase();'>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Tamaño*</label>
                        <select id="cmbTamanoTradicional" name="cmbTamanoTradicional" class="form-control ns_"></select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Cantidad de ingredientes*</label>
                        <input type="number" min='0' class="form-control" id="txtCantidadingredienteTradicional" name="txtCantidadingredienteTradicional" onkeyup='javascript:this.value=this.value.toUpperCase();'>
                    </div>                     
                </div>  
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary" id="btnGuardar">Guardar</button>
                <button class="btn btn-primary" id="btnCancelar">Cancelar</button>
            </div>
        </div>
    </div>
</div>


<!-- jQuery 3 -->
<script src="<?php echo RUTA_URL; ?>public/jquery/jquery-3.4.1.min.js"></script>
<!-- <script src="<?php echo RUTA_URL; ?>public/bower_components/jquery/dist/jquery.min.js"></script> -->
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo RUTA_URL; ?>public/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo RUTA_URL; ?>public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo RUTA_URL; ?>public/plugins/iCheck/icheck.min.js"></script>
<!-- DataTables -->
<script src="<?php echo RUTA_URL; ?>public/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo RUTA_URL; ?>public/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo RUTA_URL; ?>public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo RUTA_URL; ?>public/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo RUTA_URL; ?>public/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo RUTA_URL; ?>public/dist/js/adminlte.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?php echo RUTA_URL; ?>public/dist/js/demo.js"></script>

<script src="<?php echo RUTA_URL; ?>public/librerias/bootbox/bootbox.min.js"></script>

<script src="<?php echo RUTA_URL; ?>public/js/main.js"></script>

<script type="text/javascript">

    $(document).ready(function () {
        tableTradicional = $('#gridTradicional').DataTable( {    
            "responsive": true,
            "searching" : true,
            "paging"    : true,
            "ordering"  : false,
            "info"      : true,
            "columnDefs": [
                {"width": "10%","className": "text-center","targets": 3},
                {"width": "10%","className": "text-center","targets": 4},
            ],

            "bJQueryUI":true,"oLanguage": {
                "sEmptyTable":     "No hay datos registrados en la Base de Datos.",
                "sInfo":           "Mostrando desde _START_ hasta _END_ de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando desde 0 hasta 0 de 0 registros",
                "sInfoFiltered":   "(filtrado de _MAX_ registros en total)",
                "sInfoPostFix":    "",
                "sInfoThousands":  ",",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sLoadingRecords": "Cargando...",
                "sProcessing":     "Procesando...",
                "sSearch":         "Buscar:",
                "sZeroRecords":    "No se encontraron resultados",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": activar para Ordenar Ascendentemente",
                    "sSortDescending": ": activar para Ordendar Descendentemente"
                }
            }
        });
        //Mandamos llamar la función para mostrar tabla al cargar la página
        cargarTablaTradicional();
    });

    function cargarTablaTradicional()
    {
        $.ajax({
            url      : 'Tradicional/consultar',
            type     : "POST",
            data    : { 
                ban: 1 
            },
            beforeSend: function() {
                // setting a timeout

            },
            success  : function(datos) {

                var myJson = JSON.parse(datos);

                tableTradicional.clear().draw();

                if(myJson.arrayDatos.length > 0)
                {

                    var title;
                    var icon;
                    var color_icon;
                    var accion;

                    $(myJson.arrayDatos).each( function(key, val)
                    {

                        if (parseInt(val.estatus_tradicional) == 1)
                        {
                            title = 'Tradicional activo';
                            icon = 'fa fa-dot-circle-o';
                            color_icon = "color: #4ad129;"
                            accion = "bloquearTradicional ('" + val.cve_tradicional  + "','0')";
                        }
                        else
                        {
                            title = 'Tradicional bloqueado';
                            icon = 'fa fa-circle';
                            color_icon = "color: #f00;"
                            accion = "bloquearTradicional ('" + val.cve_tradicional  + "','1')";
                        }

                        var btn_editar = "<i class='fa fa-edit' style='font-size:18px; cursor: pointer;' title='Editar Especiaidad' onclick=\"mostrarTradicional('" + val.cve_tradicional  + "')\"></i>";
                        var btn_status = "<i class='" + icon + "' style='font-size:14px; " + color_icon + " cursor: pointer;' title='" + title + "' onclick=\"" + accion + "\"></i>";

                        tableTradicional.row.add([
                            val.nombrepizza_tradicional ,
                            val.costo_tradicional ,
                            val.precio_tradicional ,
                            btn_editar,
                            btn_status,
                        ]).draw();
                    })

                }
                else
                {
                    tableTradicional = $('#gridTradicional').DataTable();
                    
                }

            }
        });
    }

    $('#btnMostraModalTradicional').click(function (e) {
        $('#modal_formTradicional').modal({
            keyboard: false
        });
        $('#txtcveTradicional').val('');
        $('#txtNombreTradicional').val('');
        $('#txtCostoTradicional').val('');
        $('#txtPrecioTradicional').val('');
        $('#txtCantidadingredienteTradicional').val('');
        document.getElementById("cmbTamanoTradicional").selectedIndex = "0";
        cargarTamano();
        $("#btnGuardar").html('Guardar');
        return false;
    });

    function cargarTamano(){
        $.ajax({
            url      : 'Tamano/consultar',
            type     : "POST",
            data    : { 
                ban: 3
            },
            beforeSend: function() {
                // setting a timeout

            },
            success  : function(datos) {

                var myJson = JSON.parse(datos);

                select = $("#cmbTamanoTradicional");
                select.attr('disabled',false);
                select.find('option').remove();
                select.append('<option value="-1">-- Selecciona --</option>');

                if(myJson.arrayDatos.length > 0)
                {
                    $(myJson.arrayDatos).each( function(key, val)
                    {
                        select.append('<option value="' + val.cve_tamano + '">' + val.nombre_tamano + '</option>');
                    })

                }
                else
                {
                    document.getElementById("cmbTamanoTradicional").selectedIndex = "0";
                    
                }

            }
        });
    }

    $('#btnCancelar').click(function (e) {
        $('#modal_formTradicional').modal('hide');
        return false;
    });

    $('#btnGuardar').click(function (e) {
        if ( $('#txtNombreTradicional').val()  == "" )
        {
            msgAlert2("Favor de ingresar el nombre de la pizza tradicional.","warning");
        }
        else if ( $('#txtCostoTradicional').val()  == "" )
        {
            msgAlert2("Favor de ingresar el costo de la pizza tradicional.","warning");
        }
        else if ( $('#txtPrecioTradicional').val()  == "" )
        {
            msgAlert2("Favor de ingresar el precio de la pizza tradicional.","warning");
        }
        else if ( $('#txtCantidadingredienteTradicional').val()  == "" )
        {
            msgAlert2("Favor de ingresar la cantidad de la pizza tradicional","warning");
        }
        else if ( $('#cmbTamanoTradicional').val()  == "-1" )
        {
            msgAlert2("Favor de ingresar el tamaño de la pizza tradicional","warning");
        }
        else
        {
            $("#btnGuardar").prop('disabled', true);
            
            $.ajax({
                url      : 'Tradicional/guardarTradicional',
                data     : {
                    cve_tradicional  : $('#txtcveTradicional').val() != '' ? $('#txtcveTradicional').val() : '0',
                    nombre_tradicional  : $('#txtNombreTradicional').val() != '' ? $('#txtNombreTradicional').val() : '',
                    costo_tradicional  : $('#txtCostoTradicional').val() != '' ? $('#txtCostoTradicional').val() : '',
                    precio_tradicional  : $('#txtPrecioTradicional').val() != '' ? $('#txtPrecioTradicional').val() : '',
                    cantidadingrediente_tradicional : $('#txtCantidadingredienteTradicional').val() != '' ? $('#txtCantidadingredienteTradicional').val() : '',
                    cvetamano_tradicional : $('#cmbTamanoTradicional').val() != '-1' ? $('#cmbTamanoTradicional').val() : '-1'
                },
                type: "POST",
                success: function(datos){
                    var myJson = JSON.parse(datos);
                    if(myJson.status == "success")
                    {
                        $('#modal_formTradicional').modal('hide');
                        $('#txtcveTradicional').val('');
                        //Reinicializamos tabla
                        cargarTablaTradicional();
                        msgAlert(myJson.msg ,"success");
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
        return false;
    });

    function msgAlert2(msg,tipo)
    {
        $('#msgAlert2').css("display", "block");
        $("#msgAlert2").html("<div class='alert alert-" + tipo + "' role='alert'>" + msg + " <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> </div>");
        setTimeout(function() { $("#msgAlert2").fadeOut(1500); },1500);
    }

    function mostrarTradicional(cve_tradicional )
    {
        $('#msgAlert').css("display", "none");
        cargarTamano();
        $.ajax({
            url      : 'Tradicional/consultar',
            type     : "POST",
            data     : { 
                    ban: 2, 
                    cve_tradicional : cve_tradicional  
            },
            beforeSend: function() {
                // setting a timeout
            },
            success  : function(datos) {
                var myJson = JSON.parse(datos);
                //console.log(myJson);
                $('#modal_formTradicional').modal({
                    keyboard: false
                });
                $('#txtcveTradicional').val(myJson.arrayDatos[0].cve_tradicional );
                $('#txtNombreTradicional').val(myJson.arrayDatos[0].nombre_tradicional );
                $('#txtCostoTradicional').val(myJson.arrayDatos[0].costo_tradicional );
                $('#txtPrecioTradicional').val(myJson.arrayDatos[0].precio_tradicional );
                $('#txtCantidadingredienteTradicional').val(myJson.arrayDatos[0].cantidadingrediente_tradicional);
                
                $("#cmbTamanoTradicional").val(myJson.arrayDatos[0].cvetamano_tradicional);
                $("#btnGuardar").html('Actualizar tradicional');

            }
        });
    }

    function bloquearTradicional (cve_tradicional ,bloqueo)
    {
        if (bloqueo == 0)
        {
            var msg = "Esta seguro de bloquear esta pizza tradicional?";
            var ban = 2;
        }else{
            var msg = "Esta seguro de desbloquear esta pizza tradicional?";
            var ban = 3;
        }

        bootbox.confirm({
            message: msg,
            buttons: {
                confirm: {
                    label: 'Si'
                },
                cancel: {
                    label: 'No'
                }
            },
            callback: function (result) {
                if (result == true){

                    $.ajax({
                        url      : 'Tradicional/bloquearTradicional ',
                        type     : "POST",
                        data     : { 

                                ban: ban, 
                                cve_tradicional : cve_tradicional  

                        },
                        beforeSend: function() {
                            // setting a timeout

                        },
                        success  : function(datos) {

                            var myJson = JSON.parse(datos);
                    
                            if(myJson.status == "success")
                            {

                                //var table = $('#gridTradicional').DataTable();
                                        
                                //table.clear();
                                //table.destroy();

                                //Reinicializamos tabla
                                cargarTablaTradicional();

                                msgAlert(myJson.msg ,"info");

                            }

                        }
                    });

                }else{
                    //No se hace nada...
                }
            }
        });

    }

    function msgAlert(msg,tipo)
    {
        $('#msgAlert').css("display", "block");
        $("#msgAlert").html("<div class='alert alert-" + tipo + "' role='alert'>" + msg + " <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> </div>");
        setTimeout(function() { $("#msgAlert").fadeOut(1500); },1500);
    }

</script>

</body>
</html>
