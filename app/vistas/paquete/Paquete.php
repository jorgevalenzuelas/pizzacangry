
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo NOMBRE_SITIO; ?> | Paquetes</title>
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
                Paquetes
            </h1>

        </section>

        <!-- Main content -->
        <section class="content">

            <div id="msgAlert"></div>

            <button class="btn btn-primary" id="btnMostraModalPaquete">Nuevo paquete</button>
      
            <div class="box" style="margin-top: 20px;">
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="gridPaquete" class="table table-bordered table-striped" style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th>Nombre paquete</th>
                                <th>Costo</th>
                                <th>Precio publico</th>
                                <th>Detalle</th>
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
<div class="modal fade" id="modal_formPaquete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" >
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="myModalLabel">Paquete</h2>
            </div>
            <div class="modal-body" id="muestra_formPaquete">
                <input type="hidden" id="txtcvePaquete" name="txtcvePaquete">
                <div class="row">
                    <div class="form-group col-md-12">
                        <div id="msgAlert2"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Nombre del paquete*</label>
                        <input type="text" class="form-control" id="txtNombrePaquete" name="txtNombrePaquete" onkeyup='javascript:this.value=this.value.toUpperCase();'>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Costo*</label>
                        <input type="number" min='0' class="form-control" id="txtCostoPaquete" name="txtCostoPaquete" onkeyup='javascript:this.value=this.value.toUpperCase();'>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Precio publico*</label>
                        <input type="number" min='0' class="form-control" id="txtPrecioPaquete" name="txtPrecioPaquete" onkeyup='javascript:this.value=this.value.toUpperCase();'>
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

<div class="modal fade" id="modal_formDetallePaquete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" >
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabelDetalle">Paquete</h3>
            </div>
            <div class="modal-body" id="muestra_formDetallePaquete">
                <input type="hidden" id="txtcvePaquete" name="txtcvePaquete">
                <input type="hidden" id="txtcveDetallePaquete" name="txtcveDetallePaquete">
                <div class="row">
                    <div class="form-group col-md-12">
                        <div id="msgAlert3"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tabTradicional">Tradicional</a></li>
                            <li><a data-toggle="tab" href="#tabEspecialidad">Especialidad</a></li>
                            <li><a data-toggle="tab" href="#tabBebida">Bebida</a></li>
                            <li><a data-toggle="tab" href="#tabSnack">Snack</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="tabTradicional" class="tab-pane fade in active">
                                <br>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Pizza tradicional*</label>
                                        <select id="cmbPizzaTradicional" name="cmbPizzaTradicional" class="form-control ns_"></select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Cantidad de pizzas*</label>
                                        <input type="number" min='0' class="form-control" id="txtCantidadPizzaTradicional" name="txtCantidadPizzaTradicional" onkeyup='javascript:this.value=this.value.toUpperCase();'>
                                    </div>                     
                                </div>
                                <div class="box-footer">
                                    <div class="clearfix">
					                    <div class="form-group pull-right">
                                            <button type="submit" class="btn btn-primary" onclick="GuardarPizzaDetalleTradicional()">Guardar</button>
                                            <button class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                            <div id="tabEspecialidad" class="tab-pane fade">
                                <br>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Pizza especial*</label>
                                        <select id="cmbPizzaEspecialidad" name="cmbPizzaEspecialidad" class="form-control ns_"></select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Cantidad de pizzas*</label>
                                        <input type="number" min='0' class="form-control" id="txtCantidadPizzaEspecialidad" name="txtCantidadPizzaEspecialidad" onkeyup='javascript:this.value=this.value.toUpperCase();'>
                                    </div>                     
                                </div>
                                <div class="box-footer">
                                    <div class="clearfix">
                                        <div class="form-group pull-right">
                                            <button type="submit" class="btn btn-primary" onclick="GuardarPizzaDetalleEspecial()">Guardar</button>
                                            <button class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tabBebida" class="tab-pane fade">
                                <br>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Bebida*</label>
                                        <select id="cmbBebida" name="cmbBebida" class="form-control ns_"></select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Cantidad de bebidas*</label>
                                        <input type="number" min='0' class="form-control" id="txtCantidadBebida" name="txtCantidadBebida" onkeyup='javascript:this.value=this.value.toUpperCase();'>
                                    </div>                     
                                </div>
                                <div class="box-footer">
                                    <div class="clearfix">
                                        <div class="form-group pull-right">
                                            <button type="submit" class="btn btn-primary" onclick="GuardarDetalleBebida()">Guardar</button>
                                            <button class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tabSnack" class="tab-pane fade">
                                <br>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Snack*</label>
                                        <select id="cmbSnack" name="cmbSnack" class="form-control ns_"></select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Cantidad de bebidas*</label>
                                        <input type="number" min='0' class="form-control" id="txtCantidadSnack" name="txtCantidadSnack" onkeyup='javascript:this.value=this.value.toUpperCase();'>
                                    </div>                     
                                </div>
                                <div class="box-footer">
                                    <div class="clearfix">
                                        <div class="form-group pull-right">
                                            <button type="submit" class="btn btn-primary" onclick="GuardarDetalleSnack()">Guardar</button>
                                            <button class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row table-resposive">
                    <div class="form-group col-md-12">
                        <table width="100%" id="gridDetallePaquete" class="table table-bordered table-striped" style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th>Nombre producto</th>
                                    <th>Cantidad</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            
                        </table>
                    </div>
                </div>
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
        tablePaquete = $('#gridPaquete').DataTable( {    
            "responsive": true,
            "searching" : true,
            "paging"    : true,
            "ordering"  : false,
            "info"      : true,
            "columnDefs": [
                {"width": "10%","className": "text-center","targets": 4},
                {"width": "10%","className": "text-center","targets": 5},
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

        tableDetallePaquete = $('#gridDetallePaquete').DataTable( {    
            "responsive": true,
            "searching" : true,
            "paging"    : true,
            "ordering"  : false,
            "info"      : true,
            "columnDefs": [
                {"width": "10%","className": "text-center","targets": 2}
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
        cargarTablaPaquete();
        cargarTradicional();
        cargarEspecialidad();
        cargarBebida();
        cargarSnack();
    });

    function cargarTablaPaquete()
    {
        $.ajax({
            url      : 'Paquete/consultar',
            type     : "POST",
            data    : { 
                ban: 1 
            },
            beforeSend: function() {
                // setting a timeout

            },
            success  : function(datos) {

                var myJson = JSON.parse(datos);

                tablePaquete.clear().draw();

                if(myJson.arrayDatos.length > 0)
                {

                    var title;
                    var icon;
                    var color_icon;
                    var accion;

                    $(myJson.arrayDatos).each( function(key, val)
                    {

                        if (parseInt(val.estatus_paquete) == 1)
                        {
                            title = 'Paquete activo';
                            icon = 'fa fa-dot-circle-o';
                            color_icon = "color: #4ad129;"
                            accion = "bloquearPaquete('" + val.cve_paquete + "','0')";
                        }
                        else
                        {
                            title = 'Paquete bloqueado';
                            icon = 'fa fa-circle';
                            color_icon = "color: #f00;"
                            accion = "bloquearPaquete('" + val.cve_paquete + "','1')";
                        }

                        var btn_editar = "<i class='fa fa-edit' style='font-size:18px; cursor: pointer;' title='Editar Paquete' onclick=\"mostrarPaquete('" + val.cve_paquete + "')\"></i>";
                        var btn_status = "<i class='" + icon + "' style='font-size:14px; " + color_icon + " cursor: pointer;' title='" + title + "' onclick=\"" + accion + "\"></i>";
                        var btn_detalle = '<button type="button" class="btn btn-primary" onclick="btnMostraModalDetallePaquete(\''+val.nombre_paquete+'\',\''+val.cve_paquete+'\')">Detalle</button>';
                        tablePaquete.row.add([
                            val.nombre_paquete,
                            val.costo_paquete,
                            val.precio_paquete,
                            btn_detalle,
                            btn_editar,
                            btn_status,
                        ]).draw();
                    })

                }
                else
                {
                    tablePaquete = $('#gridPaquete').DataTable();
                    
                }

            }
        });
    }

    function cargarTablaDetallePaquete(cve_paquete)
    {
        $.ajax({
            url      : 'Paquete/consultarDetallePaquete',
            type     : "POST",
            data    : { 
                ban: 2,
                cve_paquete : cve_paquete
            },
            beforeSend: function() {
                // setting a timeout

            },
            success  : function(datos) {

                var myJson = JSON.parse(datos);

                tableDetallePaquete.clear().draw();

                if(myJson.arrayDatos.length > 0)
                {

                    var title;
                    var icon;
                    var color_icon;
                    var accion;

                    $(myJson.arrayDatos).each( function(key, val)
                    {

                       
                            title = 'Producto activo';
                            icon = 'fa fa-minus-circle';
                            color_icon = "color: #d12929;"
                            accion = "eliminarDetallePaquete('" + val.cve_depaquete + "','0')";
                        

                        var btn_eliminar = "<i class='" + icon + "' style='font-size:14px; " + color_icon + " cursor: pointer;' title='" + title + "' onclick=\"" + accion + "\"></i>";
                        tableDetallePaquete.row.add([
                            val.nombre_depaquete,
                            val.cantidad_depaquete,
                            btn_eliminar,
                        ]).draw();
                    })

                }
                else
                {
                    tableDetallePaquete = $('#gridDetallePaquete').DataTable();
                    
                }

            }
        });
    }

    function btnMostraModalDetallePaquete(nombre_paquete,cve_paquete){
        cargarTablaDetallePaquete(cve_paquete);
        
        $("#myModalLabelDetalle").text(nombre_paquete);
        $('#modal_formDetallePaquete').modal({
            keyboard: false
        });
        
        $('#txtcveDetallePaquete').val(cve_paquete);
        $("#btnGuardar").html('Guardar');
    }

    function cargarTradicional(){
        $.ajax({
            url      : 'Tradicional/consultar',
            type     : "POST",
            data    : { 
                ban: 3
            },
            beforeSend: function() {
                // setting a timeout

            },
            success  : function(datos) {

                var myJson = JSON.parse(datos);

                if(myJson.arrayDatos.length > 0)
                {

                    var title;
                    var icon;
                    var color_icon;
                    var accion;

                    select = $("#cmbPizzaTradicional");
                    select.attr('disabled',false);
                    select.find('option').remove();
                    select.append('<option value="-1">-- Selecciona --</option>');

                    $(myJson.arrayDatos).each( function(key, val)
                    {
                        select.append('<option value="' + val.cve_tradicional + '">' + val.nombrepizza_tradicional + '</option>');
                    })

                }
                else
                {
                    document.getElementById("cmbPizzaTradicional").selectedIndex = "0";
                    
                }

            }
        });
    }

    function GuardarPizzaDetalleTradicional(){
        if ( $('#cmbPizzaTradicional').val()  == "-1" )
        {
            msgAlert3("Favor de seleccionar el nombre de la pizza tradicional.","warning");
        }
        else if ( $('#txtCantidadPizzaTradicional').val()  == "" || $('#txtCantidadPizzaTradicional').val()  == "0" )
        {
            msgAlert3("Favor de ingresar la cantidad de pizzas tradicionales.","warning");
        }
        else
        {
            $.ajax({
                url      : 'Paquete/guardarDetallePaquete',
                data     : {
                    cve_depaquete : $('#txtcvePaquete').val() != '' ? $('#txtcvePaquete').val() : '0',
                    cvepaquete_depaquete  : $('#txtcveDetallePaquete').val() != '' ? $('#txtcveDetallePaquete').val() : '0',
                    cvema_depaquete : $('#cmbPizzaTradicional').val() != -1 ? $('#cmbPizzaTradicional').val() : '-1',
                    cantidad_depaquete  : $('#txtCantidadPizzaTradicional').val() != '' ? $('#txtCantidadPizzaTradicional').val() : '',
                    cveproducto_depaquete : '1'
                },
                type: "POST",
                success: function(datos){
                    var myJson = JSON.parse(datos);
                    if(myJson.status == "success")
                    {
                        $('#txtCantidadPizzaTradicional').val('');
                        document.getElementById("cmbPizzaTradicional").selectedIndex = "0";
                        cargarTablaDetallePaquete($('#txtcveDetallePaquete').val());
                        //Reinicializamos tabla
                        //cargarTablaTradicional();
                        msgAlert3(myJson.msg ,"success");
                        //$('#msgAlert').css("display", "none");
                    }
                    else
                    {
                        $("#btnGuardar").prop('disabled', false);
                        msgAlert3(myJson.msg ,"danger");
                        
                    }
                }
            }); 
        }
    }

    function cargarEspecialidad(){
        $.ajax({
            url      : 'Especialidad/consultar',
            type     : "POST",
            data    : { 
                ban: 3
            },
            beforeSend: function() {
                // setting a timeout

            },
            success  : function(datos) {

                var myJson = JSON.parse(datos);

                if(myJson.arrayDatos.length > 0)
                {

                    var title;
                    var icon;
                    var color_icon;
                    var accion;

                    select = $("#cmbPizzaEspecialidad");
                    select.attr('disabled',false);
                    select.find('option').remove();
                    select.append('<option value="-1">-- Selecciona --</option>');

                    $(myJson.arrayDatos).each( function(key, val)
                    {
                        select.append('<option value="' + val.cve_especialidad + '">' + val.nombrepizza_especialidad + '</option>');
                    })

                }
                else
                {
                    document.getElementById("cmbPizzaEspecialidad").selectedIndex = "0";
                    
                }

            }
        });
    }

    function GuardarPizzaDetalleEspecial(){
        if ( $('#cmbPizzaEspecialidad').val()  == "-1" )
        {
            msgAlert3("Favor de seleccionar el nombre de la pizza especial.","warning");
        }
        else if ( $('#txtCantidadPizzaEspecialidad').val()  == "" || $('#txtCantidadPizzaEspecialidad').val()  == "0" )
        {
            msgAlert3("Favor de ingresar la cantidad de pizzas especiales.","warning");
        }
        else
        {
            $.ajax({
                url      : 'Paquete/guardarDetallePaquete',
                data     : {
                    cve_depaquete : $('#txtcvePaquete').val() != '' ? $('#txtcvePaquete').val() : '0',
                    cvepaquete_depaquete  : $('#txtcveDetallePaquete').val() != '' ? $('#txtcveDetallePaquete').val() : '0',
                    cvema_depaquete : $('#cmbPizzaEspecialidad').val() != -1 ? $('#cmbPizzaEspecialidad').val() : '-1',
                    cantidad_depaquete  : $('#txtCantidadPizzaEspecialidad').val() != '' ? $('#txtCantidadPizzaEspecialidad').val() : '',
                    cveproducto_depaquete : '2'
                },
                type: "POST",
                success: function(datos){
                    var myJson = JSON.parse(datos);
                    if(myJson.status == "success")
                    {
                        $('#txtCantidadPizzaEspecialidad').val('');
                        document.getElementById("cmbPizzaEspecialidad").selectedIndex = "0";
                        cargarTablaDetallePaquete($('#txtcveDetallePaquete').val());
                        //Reinicializamos tabla
                        //cargarTablaTradicional();
                        msgAlert3(myJson.msg ,"success");
                        //$('#msgAlert').css("display", "none");
                    }
                    else
                    {
                        $("#btnGuardar").prop('disabled', false);
                        msgAlert3(myJson.msg ,"danger");
                        
                    }
                }
            }); 
        }
    }

    function cargarBebida(){
        $.ajax({
            url      : 'Bebida/consultar',
            type     : "POST",
            data    : { 
                ban: 3
            },
            beforeSend: function() {
                // setting a timeout

            },
            success  : function(datos) {

                var myJson = JSON.parse(datos);

                if(myJson.arrayDatos.length > 0)
                {

                    var title;
                    var icon;
                    var color_icon;
                    var accion;

                    select = $("#cmbBebida");
                    select.attr('disabled',false);
                    select.find('option').remove();
                    select.append('<option value="-1">-- Selecciona --</option>');

                    $(myJson.arrayDatos).each( function(key, val)
                    {
                        select.append('<option value="' + val.cve_bebida + '">' + val.nombrecompleto_bebida + '</option>');
                    })

                }
                else
                {
                    document.getElementById("cmbBebida").selectedIndex = "0";
                    
                }

            }
        });
    }

    function GuardarDetalleBebida(){
        if ( $('#cmbBebida').val()  == "-1" )
        {
            msgAlert3("Favor de seleccionar el nombre de la bebida.","warning");
        }
        else if ( $('#txtCantidadBebida').val()  == "" || $('#txtCantidadBebida').val()  == "0" )
        {
            msgAlert3("Favor de ingresar la cantidad de bebidas.","warning");
        }
        else
        {
            $.ajax({
                url      : 'Paquete/guardarDetallePaquete',
                data     : {
                    cve_depaquete : $('#txtcvePaquete').val() != '' ? $('#txtcvePaquete').val() : '0',
                    cvepaquete_depaquete  : $('#txtcveDetallePaquete').val() != '' ? $('#txtcveDetallePaquete').val() : '0',
                    cvema_depaquete : $('#cmbBebida').val() != -1 ? $('#cmbBebida').val() : '-1',
                    cantidad_depaquete  : $('#txtCantidadBebida').val() != '' ? $('#txtCantidadBebida').val() : '',
                    cveproducto_depaquete : '3'
                },
                type: "POST",
                success: function(datos){
                    var myJson = JSON.parse(datos);
                    if(myJson.status == "success")
                    {
                        cargarTablaDetallePaquete($('#txtcveDetallePaquete').val());
                        $('#txtCantidadBebida').val('');
                        document.getElementById("cmbBebida").selectedIndex = "0";
                        //Reinicializamos tabla
                        //cargarTablaTradicional();
                        msgAlert3(myJson.msg ,"success");
                        //$('#msgAlert').css("display", "none");
                    }
                    else
                    {
                        $("#btnGuardar").prop('disabled', false);
                        msgAlert3(myJson.msg ,"danger");
                        
                    }
                }
            }); 
        }
    }

    function cargarSnack(){
        $.ajax({
            url      : 'Snack/consultar',
            type     : "POST",
            data    : { 
                ban: 3
            },
            beforeSend: function() {
                // setting a timeout

            },
            success  : function(datos) {

                var myJson = JSON.parse(datos);

                if(myJson.arrayDatos.length > 0)
                {

                    var title;
                    var icon;
                    var color_icon;
                    var accion;

                    select = $("#cmbSnack");
                    select.attr('disabled',false);
                    select.find('option').remove();
                    select.append('<option value="-1">-- Selecciona --</option>');

                    $(myJson.arrayDatos).each( function(key, val)
                    {
                        select.append('<option value="' + val.cve_snack + '">' + val.nombre_snack+ '</option>');
                    })

                }
                else
                {
                    document.getElementById("cmbSnack").selectedIndex = "0";
                    
                }

            }
        });
    }

    function GuardarDetalleSnack(){
        if ( $('#cmbSnack').val()  == "-1" )
        {
            msgAlert3("Favor de seleccionar el nombre del snack.","warning");
        }
        else if ( $('#txtCantidadSnack').val()  == "" || $('#txtCantidadSnack').val()  == "0" )
        {
            msgAlert3("Favor de ingresar la cantidad de snack's.","warning");
        }
        else
        {
            $.ajax({
                url      : 'Paquete/guardarDetallePaquete',
                data     : {
                    cve_depaquete : $('#txtcvePaquete').val() != '' ? $('#txtcvePaquete').val() : '0',
                    cvepaquete_depaquete  : $('#txtcveDetallePaquete').val() != '' ? $('#txtcveDetallePaquete').val() : '0',
                    cvema_depaquete : $('#cmbSnack').val() != -1 ? $('#cmbSnack').val() : '-1',
                    cantidad_depaquete  : $('#txtCantidadSnack').val() != '' ? $('#txtCantidadSnack').val() : '',
                    cveproducto_depaquete : '4'
                },
                type: "POST",
                success: function(datos){
                    var myJson = JSON.parse(datos);
                    if(myJson.status == "success")
                    {
                        cargarTablaDetallePaquete($('#txtcveDetallePaquete').val());
                        $('#txtCantidadSnack').val('');
                        document.getElementById("cmbSnack").selectedIndex = "0";
                        //Reinicializamos tabla
                        //cargarTablaTradicional();
                        msgAlert3(myJson.msg ,"success");
                        //$('#msgAlert').css("display", "none");
                    }
                    else
                    {
                        $("#btnGuardar").prop('disabled', false);
                        msgAlert3(myJson.msg ,"danger");
                        
                    }
                }
            }); 
        }
    }

    $('#btnMostraModalPaquete').click(function (e) {
        $('#modal_formPaquete').modal({
            keyboard: false
        });
        $('#txtcvePaquete').val('');
        $('#txtNombrePaquete').val('');
        $('#txtCostoPaquete').val('');
        $('#txtPrecioPaquete').val('');
        $("#btnGuardar").html('Guardar');
        return false;
    });

    $('#btnCancelar').click(function (e) {
        $('#modal_formPaquete').modal('hide');
        return false;
    });

    $('#btnGuardar').click(function (e) {
        if ( $('#txtNombrePaquete').val()  == "" )
        {
            msgAlert2("Favor de ingresar el nombre del paquete.","warning");
        }
        else if ( $('#txtCostoPaquete').val()  == "" )
        {
            msgAlert2("Favor de ingresar el costo del paquete.","warning");
        }
        else if ( $('#txtPrecioPaquete').val()  == "" )
        {
            msgAlert2("Favor de ingresar el precio del paquete.","warning");
        }
        else
        {
            $("#btnGuardar").prop('disabled', true);
            
            $.ajax({
                url      : 'Paquete/guardarPaquete',
                data     : {
                    cve_paquete : $('#txtcvePaquete').val() != '' ? $('#txtcvePaquete').val() : '0',
                    nombre_paquete : $('#txtNombrePaquete').val() != '' ? $('#txtNombrePaquete').val() : '',
                    costo_paquete : $('#txtCostoPaquete').val() != '' ? $('#txtCostoPaquete').val() : '',
                    precio_paquete : $('#txtPrecioPaquete').val() != '' ? $('#txtPrecioPaquete').val() : ''
                },
                type: "POST",
                success: function(datos){
                    var myJson = JSON.parse(datos);
                    if(myJson.status == "success")
                    {
                        $('#modal_formPaquete').modal('hide');
                        $('#txtcvePaquete').val('');
                        //Reinicializamos tabla
                        cargarTablaPaquete();
                        msgAlert3(myJson.msg ,"success");
                        //$('#msgAlert').css("display", "none");
                        $("#btnGuardar").prop('disabled', false);
                        $("#btnGuardar").html('Guardar');
                    }
                    else
                    {
                        $("#btnGuardar").prop('disabled', false);
                        msgAlert3(myJson.msg ,"danger");
                        
                    }
                }
            }); 
        }
        return false;
    });

    function mostrarPaquete(cve_paquete)
    {
        $('#msgAlert').css("display", "none");

        $.ajax({
            url      : 'Paquete/consultar',
            type     : "POST",
            data     : { 
                    ban: 2, 
                    cve_paquete: cve_paquete 
            },
            beforeSend: function() {
                // setting a timeout
            },
            success  : function(datos) {
                var myJson = JSON.parse(datos);
                //console.log(myJson);
                $('#modal_formPaquete').modal({
                    keyboard: false
                });
                $('#txtcvePaquete').val(myJson.arrayDatos[0].cve_paquete);
                $('#txtNombrePaquete').val(myJson.arrayDatos[0].nombre_paquete);
                $('#txtCostoPaquete').val(myJson.arrayDatos[0].costo_paquete);
                $('#txtPrecioPaquete').val(myJson.arrayDatos[0].precio_paquete);
                $("#btnGuardar").html('Actualizar Paquete');

            }
        });
    }

    function bloquearPaquete(cve_paquete,bloqueo)
    {
        if (bloqueo == 0)
        {
            var msg = "Esta seguro de bloquear este paquete?";
            var ban = 2;
        }else{
            var msg = "Esta seguro de desbloquear este paquete?";
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
                        url      : 'Paquete/bloquearPaquete',
                        type     : "POST",
                        data     : { 

                                ban: ban, 
                                cve_paquete: cve_paquete 

                        },
                        beforeSend: function() {
                            // setting a timeout

                        },
                        success  : function(datos) {

                            var myJson = JSON.parse(datos);
                    
                            if(myJson.status == "success")
                            {

                                //var table = $('#gridPaquete').DataTable();
                                        
                                //table.clear();
                                //table.destroy();

                                //Reinicializamos tabla
                                cargarTablaPaquete();

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

    function msgAlert2(msg,tipo)
    {
        $('#msgAlert2').css("display", "block");
        $("#msgAlert2").html("<div class='alert alert-" + tipo + "' role='alert'>" + msg + " <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> </div>");
        setTimeout(function() { $("#msgAlert2").fadeOut(1500); },1500);
    }

    function msgAlert3(msg,tipo)
    {
        $('#msgAlert3').css("display", "block");
        $("#msgAlert3").html("<div class='alert alert-" + tipo + "' role='alert'>" + msg + " <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> </div>");
        setTimeout(function() { $("#msgAlert3").fadeOut(1500); },1500);
    }

</script>

</body>
</html>
