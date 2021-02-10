
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo NOMBRE_SITIO; ?> | Especialidades</title>
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
                Especialidades
            </h1>

        </section>

        <!-- Main content -->
        <section class="content">

            <div id="msgAlert"></div>

            <button class="btn btn-primary" id="btnMostraModalEspecialidad">Nueva especialidad</button>
      
            <div class="box" style="margin-top: 20px;">
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="gridEspecialidad" class="table table-bordered table-striped" style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th>Nombre especialidad</th>
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
<div class="modal fade" id="modal_formEspecialidad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" >
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="myModalLabel">Especialidad</h2>
            </div>
            <div class="modal-body" id="muestra_formEspecialidad">
                <input type="hidden" id="txtcveEspecialidad" name="txtcveEspecialidad">
                <div class="row">
                    <div class="form-group col-md-12">
                        <div id="msgAlert2"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Nombre especialidad*</label>
                        <input type="text" class="form-control" id="txtNombreEspecialidad" name="txtNombreEspecialidad" onkeyup='javascript:this.value=this.value.toUpperCase();'>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Costo*</label>
                        <input type="number" min='0' class="form-control" id="txtCostoEspecialidad" name="txtCostoEspecialidad" onkeyup='javascript:this.value=this.value.toUpperCase();'>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Precio publico*</label>
                        <input type="number" min='0' class="form-control" id="txtPrecioEspecialidad" name="txtPrecioEspecialidad" onkeyup='javascript:this.value=this.value.toUpperCase();'>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Tamaño*</label>
                        <select id="cmbTamanoEspecialidad" name="cmbTamanoEspecialidad" class="form-control ns_"></select>
                    </div>                    
                </div> 
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Descripción*</label>
                        <textarea class="form-control" id="txtDescripcionEspecialidad" name="txtDescripcionEspecialidad" onkeyup='javascript:this.value=this.value.toUpperCase();' rows="3"></textarea>
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
        tableEspecialidad = $('#gridEspecialidad').DataTable( {    
            "responsive": true,
            "searching" : true,
            "paging"    : true,
            "ordering"  : false,
            "info"      : true,
            "bLengthChange": false,
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
        cargarTablaEspecialidad();
    });

    function cargarTablaEspecialidad()
    {
        $.ajax({
            url      : 'Especialidad/consultar',
            type     : "POST",
            data    : { 
                ban: 1 
            },
            beforeSend: function() {
                // setting a timeout

            },
            success  : function(datos) {

                var myJson = JSON.parse(datos);

                tableEspecialidad.clear().draw();

                if(myJson.arrayDatos.length > 0)
                {

                    var title;
                    var icon;
                    var color_icon;
                    var accion;

                    $(myJson.arrayDatos).each( function(key, val)
                    {

                        if (parseInt(val.estatus_especialidad) == 1)
                        {
                            title = 'Especialidad activo';
                            icon = 'fa fa-dot-circle-o';
                            color_icon = "color: #4ad129;"
                            accion = "bloquearEspecialidad('" + val.cve_especialidad + "','0')";
                        }
                        else
                        {
                            title = 'Especialidad bloqueado';
                            icon = 'fa fa-circle';
                            color_icon = "color: #f00;"
                            accion = "bloquearEspecialidad('" + val.cve_especialidad + "','1')";
                        }

                        var btn_editar = "<i class='fa fa-edit' style='font-size:18px; cursor: pointer;' title='Editar Especiaidad' onclick=\"mostrarEspecialidad('" + val.cve_especialidad + "')\"></i>";
                        var btn_status = "<i class='" + icon + "' style='font-size:14px; " + color_icon + " cursor: pointer;' title='" + title + "' onclick=\"" + accion + "\"></i>";

                        tableEspecialidad.row.add([
                            val.nombre_especialidad,
                            val.costo_especialidad,
                            val.precio_especialidad,
                            btn_editar,
                            btn_status,
                        ]).draw();
                    })

                }
                else
                {
                    tableEspecialidad = $('#gridEspecialidad').DataTable();
                    
                }

            }
        });
    }

    $('#btnMostraModalEspecialidad').click(function (e) {
        $('#modal_formEspecialidad').modal({
            keyboard: false
        });
        $('#txtcveEspecialidad').val('');
        $('#txtNombreEspecialidad').val('');
        $('#txtCostoEspecialidad').val('');
        $('#txtPrecioEspecialidad').val('');
        $('#txtDescripcionEspecialidad').val('');
        document.getElementById("cmbTamanoEspecialidad").selectedIndex = "0";
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

                select = $("#cmbTamanoEspecialidad");
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
                    document.getElementById("cmbTamanoEspecialidad").selectedIndex = "0";
                    
                }

            }
        });
    }

    $('#btnCancelar').click(function (e) {
        $('#modal_formEspecialidad').modal('hide');
        return false;
    });

    $('#btnGuardar').click(function (e) {
        if ( $('#txtNombreEspecialidad').val()  == "" )
        {
            msgAlert2("Favor de ingresar el nombre de la especialidad.","warning");
        }
        else if ( $('#txtCostoEspecialidad').val()  == "" )
        {
            msgAlert2("Favor de ingresar el costo de la especialidad.","warning");
        }
        else if ( $('#txtPrecioEspecialidad').val()  == "" )
        {
            msgAlert2("Favor de ingresar el precio de la especialidad.","warning");
        }
        else if ( $('#txtDescripcionEspecialidad').val()  == "" )
        {
            msgAlert2("Favor de ingresar la descripción de la especialidad","warning");
        }
        else if ( $('#cmbTamanoEspecialidad').val()  == "-1" )
        {
            msgAlert2("Favor de ingresar el tamaño de la especialidad","warning");
        }
        else
        {
            $("#btnGuardar").prop('disabled', true);
            
            $.ajax({
                url      : 'Especialidad/guardarEspecialidad',
                data     : {
                    cve_especialidad : $('#txtcveEspecialidad').val() != '' ? $('#txtcveEspecialidad').val() : '0',
                    nombre_especialidad : $('#txtNombreEspecialidad').val() != '' ? $('#txtNombreEspecialidad').val() : '',
                    costo_especialidad : $('#txtCostoEspecialidad').val() != '' ? $('#txtCostoEspecialidad').val() : '',
                    precio_especialidad : $('#txtPrecioEspecialidad').val() != '' ? $('#txtPrecioEspecialidad').val() : '',
                    descripcion_especialidad : $('#txtDescripcionEspecialidad').val() != '' ? $('#txtDescripcionEspecialidad').val() : '',
                    cvetamano_especialidad : $('#cmbTamanoEspecialidad').val() != -1 ? $('#cmbTamanoEspecialidad').val() : '-1'
                },
                type: "POST",
                success: function(datos){
                    var myJson = JSON.parse(datos);
                    if(myJson.status == "success")
                    {
                        $('#modal_formEspecialidad').modal('hide');
                        $('#txtcveEspecialidad').val('');
                        //Reinicializamos tabla
                        cargarTablaEspecialidad();
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

    function mostrarEspecialidad(cve_especialidad)
    {
        $('#msgAlert').css("display", "none");
        cargarTamano();
        $.ajax({
            url      : 'Especialidad/consultar',
            type     : "POST",
            data     : { 
                    ban: 2, 
                    cve_especialidad: cve_especialidad 
            },
            beforeSend: function() {
                // setting a timeout
            },
            success  : function(datos) {
                var myJson = JSON.parse(datos);
                //console.log(myJson);
                $('#modal_formEspecialidad').modal({
                    keyboard: false
                });
                $('#txtcveEspecialidad').val(myJson.arrayDatos[0].cve_especialidad);
                $('#txtNombreEspecialidad').val(myJson.arrayDatos[0].nombre_especialidad);
                $('#txtCostoEspecialidad').val(myJson.arrayDatos[0].costo_especialidad);
                $('#txtPrecioEspecialidad').val(myJson.arrayDatos[0].precio_especialidad);
                $('#txtDescripcionEspecialidad').val(myJson.arrayDatos[0].descripcion_especialidad);
                
                $("#cmbTamanoEspecialidad").val(myJson.arrayDatos[0].cvetamano_especialidad);
                $("#btnGuardar").html('Actualizar Especialidad');

            }
        });
    }

    function bloquearEspecialidad(cve_especialidad,bloqueo)
    {
        if (bloqueo == 0)
        {
            var msg = "Esta seguro de bloquear esta especialidad?";
            var ban = 2;
        }else{
            var msg = "Esta seguro de desbloquear esta especialidad?";
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
                        url      : 'Especialidad/bloquearEspecialidad',
                        type     : "POST",
                        data     : { 

                                ban: ban, 
                                cve_especialidad: cve_especialidad 

                        },
                        beforeSend: function() {
                            // setting a timeout

                        },
                        success  : function(datos) {

                            var myJson = JSON.parse(datos);
                    
                            if(myJson.status == "success")
                            {

                                //var table = $('#gridEspecialidad').DataTable();
                                        
                                //table.clear();
                                //table.destroy();

                                //Reinicializamos tabla
                                cargarTablaEspecialidad();

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
