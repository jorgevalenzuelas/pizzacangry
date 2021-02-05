
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo NOMBRE_SITIO; ?> | Categorías</title>
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
                Categorías
            </h1>

        </section>

        <!-- Main content -->
        <section class="content">

            <div id="msgAlert"></div>

            <button class="btn btn-primary" id="btnMostraFormSucursal">Nueva categoría</button>
      
            <div class="box" style="margin-top: 20px;">
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="gridCategoria" class="table table-bordered table-striped" style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th>Nombre categoría</th>
                                <th>Departamento</th>
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
<div class="modal fade" id="modal_formCategoria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Categorías</h5>
            </div>
            <div class="modal-body" id="muestra_formCategoria"> 

                <div id="msgAlert2"></div>

                <form id="formCategoria" action="categoria/guardarCategoria" method="post">

                    <div class="box-body">
                        <div class="row">

                            <div class="form-group col-md-6">
                                <label>Nombre Categoría*</label>
                                <input type="text" class="form-control" id="txtNombreCategoria" name="txtNombreCategoria" onkeyup='javascript:this.value=this.value.toUpperCase();'>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Departamento*</label>
                                <select class="form-control" id="cmbDepartamento" name="cmbDepartamento">
                                </select>
                            </div>

                        </div>

                    </div>

                    

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" id="btnGuardar">Guardar</button>
                        <button class="btn btn-primary" id="btnCancelar">Cancelar</button>
                    </div>

                    <input type="hidden" id="txtcveCategoria" name="txtcveCategoria">
                </form>

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

        tableCategorias = $('#gridCategoria').DataTable( {    
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
        cargarTablaCategoria();

    });

    //Cargamos combo departamento
    $.ajax({
        url      : 'departamento/consultar',
        type     : "POST",
        data    : { ban: 1 },
        beforeSend: function() {
            // setting a timeout

        },
        success  : function(datos) {

            var myJson = JSON.parse(datos);

            //console.log(myJson.arrayDatos[0].cve_perfil);
            
            var select = $("#cmbDepartamento");
            select.find('option').remove();

            if (myJson.arrayDatos.length > 1){
                select.append('<option value="-1">-- Selecciona --</option>');
            }
            
            $(myJson.arrayDatos).each( function(key, val){
                select.append('<option value="' + val.cve_departamento + '">' + val.nombre_departamento + '</option>');
            });

            document.getElementById("cmbDepartamento").selectedIndex = "0";
           
        }
    });

    function cargarTablaCategoria()
    {
        $.ajax({
            url      : 'categoria/consultar',
            type     : "POST",
            data    : { ban: 1 },
            beforeSend: function() {
                // setting a timeout

            },
            success  : function(datos) {

                var myJson = JSON.parse(datos);

                tableCategorias.clear().draw();

                if(myJson.arrayDatos.length > 0)
                {

                    var title;
                    var icon;
                    var color_icon;
                    var accion;

                    $(myJson.arrayDatos).each( function(key, val)
                    {

                        if (parseInt(val.estatus_categoria) == 1)
                        {
                            title = 'Categoría activa';
                            icon = 'fa fa-dot-circle-o';
                            color_icon = "color: #4ad129;"
                            accion = "bloquearCategoria('" + val.cve_categoria + "','0')";
                        }
                        else
                        {
                            title = 'Categoría bloqueada';
                            icon = 'fa fa-circle';
                            color_icon = "color: #f00;"
                            accion = "bloquearCategoria('" + val.cve_categoria + "','1')";
                        }

                        var btn_editar = "<i class='fa fa-edit' style='font-size:18px; cursor: pointer;' title='Editar Categoría' onclick=\"mostrarCategoria('" + val.cve_categoria + "')\"></i>";
                        var btn_status = "<i class='" + icon + "' style='font-size:14px; " + color_icon + " cursor: pointer;' title='" + title + "' onclick=\"" + accion + "\"></i>";

                        tableCategorias.row.add([
                            val.nombre_categoria,
                            val.nombre_departamento,
                            btn_editar,
                            btn_status,
                        ]).draw();
                    })

                }
                else
                {
                    tableCategorias = $('#gridCategoria').DataTable();
                    
                }

            }
        });
    }

    $('#btnMostraFormSucursal').click(function (e) {

        $('#modal_formCategoria').modal({
            keyboard: false
        });

    });

    $('#formCategoria').on('submit',function(e){
        e.preventDefault();

        if ( $('#txtNombreCategoria').val()  == "" )
        {
            msgAlert2("Favor de ingresar el nombre de la categoría.","warning");
            setTimeout(function() { $("#msgAlert2").fadeOut(1500); },3000);
        }
        else if ( $('#cmbDepartamento').val()  == -1 )
        {
            msgAlert2("Favor de seleccionar un departamento.","warning");
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
                        //limpiamos formulario
                        $('#txtNombreCategoria').val('');
                        document.getElementById("cmbDepartamento").selectedIndex = 0;

                        $('#modal_formCategoria').modal('hide');
                        
                        //Reinicializamos tabla
                        cargarTablaCategoria();

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

    function mostrarCategoria(cve_categoria)
    {
        $('#msgAlert').css("display", "none");

        $.ajax({
            url      : 'categoria/consultar',
            type     : "POST",
            data     : { 

                    ban: 2, 
                    cve_categoria: cve_categoria 

            },
            beforeSend: function() {
                // setting a timeout

            },
            success  : function(datos) {

                var myJson = JSON.parse(datos);

                //console.log(myJson);

                $('#modal_formCategoria').modal({
                    keyboard: false
                });
                        
                $('#txtNombreCategoria').val(myJson.arrayDatos[0].nombre_categoria);
                document.getElementById("cmbDepartamento").selectedIndex = myJson.arrayDatos[0].cvedepartamento_categoria;
                $('#txtcveCategoria').val(myJson.arrayDatos[0].cve_categoria);

                $("#btnGuardar").html('Actualizar Categoría');
            }
        });
    }

    function bloquearCategoria(cve_categoria,bloqueo)
    {

        if (bloqueo == 0)
        {
            var msg = "Esta seguro de bloquear esta categoría?";
            var ban = 2;
        }else{
            var msg = "Esta seguro de desbloquear esta categoría?";
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
                        url      : 'categoria/bloquearCategoria',
                        type     : "POST",
                        data     : { 

                                ban: ban, 
                                cve_categoria: cve_categoria 

                        },
                        beforeSend: function() {
                            // setting a timeout

                        },
                        success  : function(datos) {

                            var myJson = JSON.parse(datos);
                    
                            if(myJson.status == "success")
                            {

                                //var table = $('#gridCategoria').DataTable();
                                        
                                //table.clear();
                                //table.destroy();

                                //Reinicializamos tabla
                                cargarTablaCategoria();

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


    $('#btnCancelar').click(function (e) {
    
        $('#modal_formCategoria').modal('hide');

        return false;
    });


    function msgAlert(msg,tipo)
    {
        $('#msgAlert').css("display", "block");
        $("#msgAlert").html("<div class='alert alert-" + tipo + "' role='alert'>" + msg + " <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> </div>");
    }

    function msgAlert2(msg,tipo)
    {
        $('#msgAlert2').css("display", "block");
        $("#msgAlert2").html("<div class='alert alert-" + tipo + "' role='alert'>" + msg + " <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> </div>");
    }

</script>

</body>
</html>
