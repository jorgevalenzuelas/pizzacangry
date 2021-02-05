
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo NOMBRE_SITIO; ?> | Perfiles</title>
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
                Perfiles
            </h1>

        </section>

        <!-- Main content -->
        <section class="content">

            <div id="msgAlert"></div>

            <button class="btn btn-primary" id="btnMostraFormPerfil">Nuevo Perfil</button>
      
            <div class="box" style="margin-top: 20px;">
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="gridPerfiles" class="table table-bordered table-striped" style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripcion</th>
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
<div class="modal fade" id="modal_formPerfiles" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Perfil</h5>
            </div>
            <div class="modal-body" id="muestra_formPerfil"> 

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

        tablePerfil = $('#gridPerfiles').DataTable( {    
            "responsive": true,
            "searching" : true,
            "paging"    : true,
            "ordering"  : false,
            "info"      : true,
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
        cargarTablaPerfil();

    });


    function cargarTablaPerfil()
    {
        $.ajax({
            url      : 'perfil/consultar',
            type     : "POST",
            data    : { ban: 1 },
            beforeSend: function() {
                // setting a timeout

            },
            success  : function(datos) {

                var myJson = JSON.parse(datos);

                tablePerfil.clear().draw();

                if(myJson.arrayDatos.length > 0)
                {

                    var title;
                    var icon;
                    var color_icon;
                    var accion;

                    $(myJson.arrayDatos).each( function(key, val)
                    {

                        if (parseInt(val.estatus_perfil) == 1)
                        {
                            title = 'Perfil activo';
                            icon = 'fa fa-dot-circle-o';
                            color_icon = "color: #4ad129;"
                            accion = "bloquearPerfil('" + val.cve_perfil + "','0')";
                        }
                        else
                        {
                            title = 'Perfil bloqueado';
                            icon = 'fa fa-circle';
                            color_icon = "color: #f00;"
                            accion = "bloquearPerfil('" + val.cve_perfil + "','1')";
                        }

                        var btn_editar = "<i class='fa fa-edit' style='font-size:18px; cursor: pointer;' title='Editar Perfil' onclick=\"mostrarPerfil('" + val.cve_perfil + "')\"></i>";
                        var btn_status = "<i class='" + icon + "' style='font-size:14px; " + color_icon + " cursor: pointer;' title='" + title + "' onclick=\"" + accion + "\"></i>";

                        tablePerfil.row.add([
                            val.nombre_perfil,
                            val.descripcion_perfil,
                            btn_editar,
                            btn_status,
                        ]).draw();
                    })

                }
                else
                {
                    tablePerfil = $('#gridPerfiles').DataTable();
                    
                }

            }
        });
    }


    $('#btnMostraFormPerfil').click(function (e) {

        $('#modal_formPerfiles').modal({
            backdrop: 'static',
            keyboard: false
        });

        $("#muestra_formPerfil").html('Cargando...');

        $.ajax({
            url: 'perfil/formPerfil',
            success: function(datos){

                $("#muestra_formPerfil").html(datos);

            }
        });
        return false;
    });

    function mostrarPerfil(cve_perfil)
    {
        $('#msgAlert').css("display", "none");

        $.ajax({
            url      : 'perfil/consultar',
            type     : "POST",
            data     : { 

                    ban: 2, 
                    cve_perfil: cve_perfil 

            },
            beforeSend: function() {
                // setting a timeout

            },
            success  : function(datos) {

                var myJson = JSON.parse(datos);

                //console.log(myJson);

                $('#modal_formPerfiles').modal({
                    backdrop: 'static',
                    keyboard: false
                });

                $("#muestra_formPerfil").html('Cargando...');

                $.ajax({
                    url: 'perfil/formPerfil',
                    type     : "POST",
                    data     : { 

                            cve_perfil: cve_perfil 

                    },
                    success: function(datos){

                        $("#muestra_formPerfil").html(datos);

                        $('#txtNombrePerfil').val(myJson.arrayDatos[0].nombre_perfil);
                        $('#txtDescipcionPerfil').val(myJson.arrayDatos[0].descripcion_perfil);
                        $('#txtcvePerfil').val(myJson.arrayDatos[0].cve_perfil);

                        $("#btnGuardar").html('Actualizar usuario');
                    }
                });

                

                //$('#txtAccion').val('M');
                
                //$("#btnCancelar").css("visibility", "visible");

            }
        });
    }

    function bloquearPerfil(cve_perfil,bloqueo)
    {

        if (bloqueo == 0)
        {
            var msg = "Esta seguro de bloquear este Perfil?";
            var ban = 2;
        }else{
            var msg = "Esta seguro de desbloquear este Perfil?";
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
                        url      : 'perfil/bloquearPerfil',
                        type     : "POST",
                        data     : { 

                                ban: ban, 
                                cve_perfil: cve_perfil 

                        },
                        beforeSend: function() {
                            // setting a timeout

                        },
                        success  : function(datos) {

                            var myJson = JSON.parse(datos);
                    
                            if(myJson.status == "success")
                            {

                                //Reinicializamos tabla
                                cargarTablaPerfil();

                                msgAlert(myJson.msg ,"info");
                                setTimeout(function() { $("#msgAlert").fadeOut(1500); },3000);

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
    }

</script>

</body>
</html>
