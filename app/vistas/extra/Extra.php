
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo NOMBRE_SITIO; ?> | Extras</title>
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
                Extras
            </h1>

        </section>

        <!-- Main content -->
        <section class="content">

            <div id="msgAlertExtra2"></div>

            <button class="btn btn-primary" id="btnMostraModalExtra">Nuevo extra</button>
      
            <div class="box" style="margin-top: 20px;">
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="gridExtra" class="table table-bordered table-striped" style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th>Nombre extra</th>
                                <th>Tamaño</th>
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
<div class="modal fade" id="modal_formExtra" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" >
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="myModalLabel">Extra</h2>
            </div>
            <div class="modal-body" id="muestra_formExtra">
                <input type="hidden" id="txtcveExtra" name="txtcveExtra">
                <div class="row">
                    <div class="form-group col-md-12">
                        <div id="msgAlertExtra1"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Nombre del extra*</label>
                        <input type="text" class="form-control" id="txtNombreExtra" name="txtNombreExtra" onkeyup='javascript:this.value=this.value.toUpperCase();'>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Tamaño*</label>
                        <select id="cmbTamanoTradicional" name="cmbTamanoTradicional" class="form-control ns_"></select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Costo*</label>
                        <input type="number" min='0' class="form-control" id="txtCostoExtra" name="txtCostoExtra" onkeyup='javascript:this.value=this.value.toUpperCase();'>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Precio publico*</label>
                        <input type="number" min='0' class="form-control" id="txtPrecioExtra" name="txtPrecioExtra" onkeyup='javascript:this.value=this.value.toUpperCase();'>
                    </div>                    
                </div>  
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary" id="btnGuardarExtra">Guardar</button>
                <button class="btn btn-primary" id="btnCancelarExtra">Cancelar</button>
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
        tableExtra = $('#gridExtra').DataTable( {    
            "responsive": true,
            "searching" : true,
            "paging"    : true,
            "ordering"  : false,
            "info"      : true,
            "bLengthChange": false,
            "columnDefs": [
                {"width": "10%","className": "text-center","targets": 2},
                {"width": "10%","className": "text-center","targets": 3},
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
        cargarTablaExtra();
    });

    function cargarTablaExtra()
    {
        $.ajax({
            url      : 'Extra/consultar',
            type     : "POST",
            data    : { 
                ban: 1 
            },
            beforeSend: function() {
                // setting a timeout

            },
            success  : function(datos) {

                var myJson = JSON.parse(datos);

                tableExtra.clear().draw();

                if(myJson.arrayDatos.length > 0)
                {

                    var title;
                    var icon;
                    var color_icon;
                    var accion;

                    $(myJson.arrayDatos).each( function(key, val)
                    {

                        if (parseInt(val.estatus_extra) == 1)
                        {
                            title = 'Extra activo';
                            icon = 'fa fa-dot-circle-o';
                            color_icon = "color: #4ad129;"
                            accion = "bloquearExtra('" + val.cve_extra + "','0')";
                        }
                        else
                        {
                            title = 'Extra bloqueado';
                            icon = 'fa fa-circle';
                            color_icon = "color: #f00;"
                            accion = "bloquearExtra('" + val.cve_extra + "','1')";
                        }

                        var btn_editar = "<i class='fa fa-edit' style='font-size:18px; cursor: pointer;' title='Editar Extra' onclick=\"mostrarExtra('" + val.cve_extra + "')\"></i>";
                        var btn_status = "<i class='" + icon + "' style='font-size:14px; " + color_icon + " cursor: pointer;' title='" + title + "' onclick=\"" + accion + "\"></i>";

                        tableExtra.row.add([
                            val.nombre_extra,
                            val.nombre_tamano,
                            btn_editar,
                            btn_status,
                        ]).draw();
                    })

                }
                else
                {
                    tableExtra = $('#gridExtra').DataTable();
                    
                }

            }
        });
    }

    $('#btnMostraModalExtra').click(function (e) {
        $('#modal_formExtra').modal({
            keyboard: false
        });
        $('#txtcveExtra').val('');
        $('#txtNombreExtra').val('');
        $('#txtCostoExtra').val('');
        $('#txtPrecioExtra').val('');
        document.getElementById("cmbTamanoTradicional").selectedIndex = "0";
        cargarTamano();
        $("#btnGuardarExtra").html('Guardar');
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

    $('#btnCancelarExtra').click(function (e) {
        $('#modal_formExtra').modal('hide');
        return false;
    });

    $('#btnGuardarExtra').click(function (e) {
        if ( $('#txtNombreExtra').val()  == "" )
        {
            msgAlertExtra1("Favor de ingresar el nombre del extra.","warning");
        }
        else if ( $('#txtCostoExtra').val()  == "" )
        {
            msgAlertExtra1("Favor de ingresar el costo del extra.","warning");
        }
        else if ( $('#txtPrecioExtra').val()  == "" )
        {
            msgAlertExtra1("Favor de ingresar el costo del extra.","warning");
        }
        else if ( $('#cmbTamanoTradicional').val()  == "-1" )
        {
            msgAlert2("Favor de ingresar el tamaño del extra","warning");
        }
        else
        {
            $("#btnGuardarExtra").prop('disabled', true);
            
            $.ajax({
                url      : 'Extra/guardarExtra',
                data     : {
                    cve_extra : $('#txtcveExtra').val() != '' ? $('#txtcveExtra').val() : '0',
                    nombre_extra : $('#txtNombreExtra').val() != '' ? $('#txtNombreExtra').val() : '',
                    costo_extra : $('#txtCostoExtra').val() != '' ? $('#txtCostoExtra').val() : '0',
                    precio_extra : $('#txtCostoExtra').val() != '' ? $('#txtPrecioExtra').val() : '0',
                    cvetamano_extra : $('#cmbTamanoTradicional').val() != '-1' ? $('#cmbTamanoTradicional').val() : '-1'
                },
                type: "POST",
                success: function(datos){
                    var myJson = JSON.parse(datos);
                    if(myJson.status == "success")
                    {
                        $('#modal_formExtra').modal('hide');
                        $('#txtcveExtra').val('');
                        //Reinicializamos tabla
                        cargarTablaExtra();
                        msgAlertExtra2(myJson.msg ,"success");
                        //$('#msgAlertExtra2').css("display", "none");
                        $("#btnGuardarExtra").prop('disabled', false);
                        $("#btnGuardarExtra").html('Guardar');
                    }
                    else
                    {
                        $("#btnGuardarExtra").prop('disabled', false);
                        msgAlertExtra1(myJson.msg ,"danger");
                        
                    }
                }
            }); 
        }
        return false;
    });

    function msgAlertExtra1(msg,tipo)
    {
        $('#msgAlertExtra1').css("display", "block");
        $("#msgAlertExtra1").html("<div class='alert alert-" + tipo + "' role='alert'>" + msg + " <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> </div>");
        setTimeout(function() { $("#msgAlertExtra1").fadeOut(1500); },1500);
    }

    function mostrarExtra(cve_extra)
    {
        $('#msgAlertExtra2').css("display", "none");
        cargarTamano();
        $.ajax({
            url      : 'Extra/consultar',
            type     : "POST",
            data     : { 
                    ban: 2, 
                    cve_extra: cve_extra 
            },
            success  : function(datos) {
                var myJson = JSON.parse(datos);
                //console.log(myJson);
                $('#modal_formExtra').modal({
                    keyboard: false
                });
                $('#txtcveExtra').val(myJson.arrayDatos[0].cve_extra);
                $('#txtNombreExtra').val(myJson.arrayDatos[0].nombre_extra);
                $('#txtCostoExtra').val(myJson.arrayDatos[0].costo_extra);
                $('#txtPrecioExtra').val(myJson.arrayDatos[0].precio_extra);
                $("#cmbTamanoTradicional").val(myJson.arrayDatos[0].cvetamano_extra).change();
                $("#btnGuardarExtra").html('Actualizar Extra');

            }
        });
    }

    function bloquearExtra(cve_extra,bloqueo)
    {
        if (bloqueo == 0)
        {
            var msg = "Esta seguro de bloquear este extra?";
            var ban = 2;
        }else{
            var msg = "Esta seguro de desbloquear este extra?";
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
                        url      : 'Extra/bloquearExtra',
                        type     : "POST",
                        data     : { 

                                ban: ban, 
                                cve_extra: cve_extra 

                        },
                        beforeSend: function() {
                            // setting a timeout

                        },
                        success  : function(datos) {

                            var myJson = JSON.parse(datos);
                    
                            if(myJson.status == "success")
                            {

                                //var table = $('#gridExtra').DataTable();
                                        
                                //table.clear();
                                //table.destroy();

                                //Reinicializamos tabla
                                cargarTablaExtra();

                                msgAlertExtra2(myJson.msg ,"info");

                            }

                        }
                    });

                }else{
                    //No se hace nada...
                }
            }
        });

    }

    function msgAlertExtra2(msg,tipo)
    {
        $('#msgAlertExtra2').css("display", "block");
        $("#msgAlertExtra2").html("<div class='alert alert-" + tipo + "' role='alert'>" + msg + " <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> </div>");
        setTimeout(function() { $("#msgAlertExtra2").fadeOut(1500); },1500);
    }

</script>

</body>
</html>
