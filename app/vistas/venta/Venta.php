
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo NOMBRE_SITIO; ?> | Venta</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>public/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>public/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>public/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>public/dist/css/AdminLTE.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>public/dist/css/skins/_all-skins.min.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="chortcut icon" type="image/png" href="<?php echo RUTA_URL; ?>public/img/LogoCangry_icon.png" />

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
        
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="row">
        <div id="msgAlert1"></div>
            <div class="col-md-6">
            <h3>Ordenar&nbsp;</h3>
                        <hr>
                <button type="button" class="btn btn-primary" onclick="GenerarFolio()" id="txtbtnNuevaVenta">Nueva orden</button>
                <div class="form-group">
                    <label for="cmbProductos">Buscar productos</label>
                    <datalist id="cmbContactosListMod">
                        <!--option value="0" selected="selected"> -- Seleccione -- </option-->
                    </datalist>
                    <input list="cmbContactosListMod" id="cmbProductos" name="cmbProductos" type="text" class="form-control" placeholder=" -- Escriba -- " onkeyup="javascript:this.value=this.value.toUpperCase();" onchange="AgregarProductoTabla();">
                </div>
                
                <div class="box" style="margin-top: 20px;">
                    <!-- /.box-header -->
                    <div class="box-body">
                    <label>Folio: &nbsp;</label><label id="txtFolioVenta"></label>
                        <table id="gridComanda" class="table table-bordered table-striped" style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th>Nombre producto</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Detalle</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            
                        </table>
                        <label>Total: &nbsp;</label><label id="txtTotalVenta"></label>
                        <button type="button" class="btn btn-primary pull-right" onclick="pagarComanda()" id="btnPagarComanda">Pagar</button>
                        <div class="form-check" id="divTipoVenta">
                            <div class="form-check-inline">
                                <label class="form-check-label" for="radio1">
                                    <input type="radio" class="form-check-input" id="radio1" name="optradio" onchange="tipoVenta()" value="1">&nbsp; Restaurante
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label" for="radio2">
                                    <input type="radio" class="form-check-input" id="radio2" name="optradio" onchange="tipoVenta()" value="2">&nbsp; Domicilio
                                    <div id="txtbtnVincularCliente">
                                            <button type="button" class="btn btn-primary" onclick="vincularCliente()" id="btnVincularCliente">Vincular cliente</button>
                                        
                                            <button type="button" class="btn btn-success" onclick="nuevoCliente()" id="btnNuevoCliente">
                                                <span class="glyphicon glyphicon-plus"></span>
                                            </button>

                                            <div class="col-md-6">
                                                <h5>Nombre cliente: &nbsp;</labeh5l><label id="txtNombreClienteVenta"></label>
                                                <br>
                                                <h5>Dirección: &nbsp;</h5><label id="txtDireccionClienteVenta"></label>
                                                <br>
                                                <h5>Teléfono: &nbsp;</h5><label id="txtTelefonoClienteVenta"></label>
                                                
                                            </div>
                                        </div>
                                        <br>
                                        <h5>Hora pedido: &nbsp;</h5><label id="txtHoraClienteVenta"></label>
                                </label>
                                
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <h3>En proceso&nbsp;</h3>
                        <hr>
                        <div class="box" style="margin-top: 20px;">
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="gridFolio" class="table table-bordered table-striped" style="font-size: 12px;">
                                    <thead>
                                        <tr>
                                            <th>Folio</th>
                                            <th>Total</th>
                                            <th>Hr. pedido</th>
                                            <th>Tipo</th>
                                            <th>Editar</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h3>Ultimas ventas&nbsp;</h3>
                        <hr>
                        <div class="box" style="margin-top: 20px;">
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="gridFolioEntregado" class="table table-bordered table-striped" style="font-size: 12px;">
                                    <thead>
                                        <tr>
                                            <th>Folio</th>
                                            <th>Total</th>
                                            <th>Hr. pedido</th>
                                            <th>Tipo</th>
                                            <th>Detalle</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        </section>
        <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->
    
    <?php 
    //include RUTA_APP . 'vistas/includes/footer.php';

    include RUTA_APP . 'vistas/includes/control_sidebar_right.php';
    ?>

</div>
<style>
.center{
width: 150px;
  margin: 40px auto;
  
}
</style>
<div class="modal fade" id="modal_formClienteNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel"></h5>
            </div>
            <div class="modal-body" id="muestra_formClienteNuevo"> 
                
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_formCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-mg modal-dialog-centered" >
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body" id="muestra_formCliente"> 

            <div class="row">
                <div class="form-group col-md-12">
                    <div class="form-group">
                        <label for="cmbCliente">Buscar cliente</label>
                        <datalist id="cmbContactosListCliente">
                            <!--option value="0" selected="selected"> -- Seleccione -- </option-->
                        </datalist>
                        <input list="cmbContactosListCliente" id="cmbCliente" name="cmbCliente" type="text" class="form-control" placeholder=" -- Escriba -- " onkeyup="javascript:this.value=this.value.toUpperCase();" onchange="buscarDireccion();">
                    </div>
                </div>
                <div class="form-group col-md-12" id="divDireccionCliente">
                    <div class="form-group">
                    <h5>Nombre Cliente:&nbsp;</h5><label id="txtNombreClientediv"></label>
                    <br>
                    <h5>Direccion:&nbsp;</h5><label id="txtDireccionClientediv"></label>
                    <br>
                    <h5>Teléfono:&nbsp;</h5><label id="txtTelefonoClientediv"></label>
                    </div>
                </div>                          
            </div>
                <button type="button" class="btn btn-primary pull-right" data-dismiss="modal" onclick="btnGuardarCantidad2()" >Agregar</button>
            </div>
            <br>
            <br>
        </div>
    </div>
</div>
<!-- ./wrapper -->
<div class="modal fade" id="modal_formCantidadProductos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" >
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel">Cantidad de productos</h3>
            </div>
            <div class="modal-body" id="muestra_formSnack">
                <div class="row">
                    <div class="form-group col-md-12">
                        <div id="msgAlert2"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="center">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                                    <span class="glyphicon glyphicon-minus"></span>
                                </button>
                            </span>
                            <input type="text" name="quant[2]" class="form-control input-number" id="txtCantidadProductos" value="1" min="1" max="100">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                                    <span class="glyphicon glyphicon-plus"></span>
                                </button>
                            </span>
                        </div>
                        <p></p>
                    </div>
                </div> 
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary" id="btnGuardarCantidad">Aceptar</button>
                <button class="btn btn-primary" data-dismiss="modal" id="btnCancelarCantidad">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_formIngredientes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" >
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="myModalLabelIngredientes">Ingredientes</h2>
            </div>
            <div class="modal-body" id="muestra_formInputs"> 

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_formIngredientesMod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" >
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="myModalLabelIngredientesMod">Ingredientes</h2>
            </div>
            <div class="modal-body" id="muestra_formInputsMod"> 

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_formIngredientesPaquete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" >
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="myModalLabelIngredientesPaquete">Ingredientes</h2>
            </div>
            <div class="modal-body" id="muestra_formInputsPaquete"> 

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_formIngredientesPaqueteMod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" >
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="myModalLabelIngredientesPaqueteMod">Ingredientes</h2>
            </div>
            <div class="modal-body" id="muestra_formInputsPaqueteMod"> 

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
<!-- jQuery 3 -->

<script type="text/javascript">

    var cantidad_ingredientes = 0;
    var cantidad_productos = 0;
    $(document).ready(function () {

        $("#divTipoVenta").hide();
        $("#txtbtnVincularCliente").hide();
        $("#btnPagarComanda").hide();
        

        tableFolio = $('#gridFolio').DataTable( {    
            "responsive": true,
            "searching" : true,
            "paging"    : true,
            "ordering"  : false,
            "info"      : true,
            "bLengthChange": false,
            "columnDefs": [
                {"width": "20%","className": "text-center","targets": 0},
                {"width": "20%","className": "text-center","targets": 1},
                {"width": "20%","className": "text-center","targets": 2},
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

        tableFolioEntregado = $('#gridFolioEntregado').DataTable( {    
            "responsive": true,
            "searching" : true,
            "paging"    : true,
            "ordering"  : false,
            "info"      : true,
            "bLengthChange": false,
            "columnDefs": [
                {"width": "20%","className": "text-center","targets": 0},
                {"width": "20%","className": "text-center","targets": 1},
                {"width": "20%","className": "text-center","targets": 2},
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
        
        tableComanda = $('#gridComanda').DataTable( {    
            "responsive": true,
            "searching" : false,
            "paging"    : false,
            "ordering"  : false,
            "info"      : false,
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
        
        cargarProductos();
        cargarTablaFolio();
        cargarTablaFolioEntregado();
        $('#cmbProductos').focus();
    });

    function buscarDireccion(){
        var val = $('#cmbCliente').val() ? $('#cmbCliente').val() : '';
            // se agrego indexOf para saber si el string val viene con comillas o apostrofe y formar bien la cadena
            if(val.indexOf("\"") !== -1){
                var valueCombo = $("#cmbContactosListCliente").find("option[value='"+val+"']").data("value") ? $("#cmbContactosListCliente").find("option[value='"+val+"']").data("value") : "";
            }
            else{
            var valueCombo = $("#cmbContactosListCliente").find("option[value=\""+val+"\"]").data("value") ? $("#cmbContactosListCliente").find("option[value=\""+val+"\"]").data("value") : "";
            }

            if(valueCombo.cve_cliente != null){
                $("#txtNombreClientediv").text(valueCombo.nombre_cliente != 'null' ? valueCombo.nombre_cliente : '');
                $("#txtDireccionClientediv").text(valueCombo.domicilio_cliente != 'null' ? valueCombo.domicilio_cliente : '');
                $("#txtTelefonoClientediv").text(valueCombo.telefono_cliente != 'null' ? valueCombo.telefono_cliente : '');
                

            }


    }

    function cargarTablaFolio()
    {
        $.ajax({
            url      : 'Venta/consultarFolios',
            type     : "POST",
            data    : { 
                ban: 1,
                folio_venta : 0
            },
            success  : function(datos) {

                var myJson = JSON.parse(datos);

                tableFolio.clear().draw();

                if(myJson.arrayDatos.length > 0)
                {

                    var title;
                    var icon;
                    var color_icon;
                    var accion;

                    $(myJson.arrayDatos).each( function(key, val)
                    {
                        if(val.estatus_venta == 1){
                            title = 'En proceso';
                            icon = 'fa fa-dot-circle-o';
                            color_icon = "color: #4ad129;"
                            accion = "cambiarEstatusVenta('" + val.cve_venta  + "','2')";
                        }
                            
                        

                        var btn_editar = "<i class='fa fa-edit' style='font-size:18px; cursor: pointer;' title='Editar comanda' onclick=\"consultarComanda('" + val.folio_venta  + "')\"></i>";
                        var btn_status = "<i class='" + icon + "' style='font-size:14px; " + color_icon + " cursor: pointer;' title='" + title + "' onclick=\"" + accion + "\"></i>";

                        tableFolio.row.add([
                            val.folio_venta ,
                            val.total_venta ,
                            val.fechaalta_deventa ,
                            val.tipo_venta ,
                            btn_editar,
                            btn_status,
                        ]).draw();
                    })

                }
                else
                {
                    tableFolio = $('#gridFolio').DataTable();
                    
                }

            }
        });
    }

    function cargarTablaFolioEntregado()
    {
        $.ajax({
            url      : 'Venta/consultarFolios',
            type     : "POST",
            data    : { 
                ban: 3,
                folio_venta : 0
            },
            success  : function(datos) {

                var myJson = JSON.parse(datos);

                tableFolioEntregado.clear().draw();

                if(myJson.arrayDatos.length > 0)
                {

                    var title;
                    var icon;
                    var color_icon;
                    var accion;

                    $(myJson.arrayDatos).each( function(key, val)
                    {
                        if(val.estatus_venta == 2){
                            title = 'En proceso';
                            icon = 'fa fa-dot-circle-o';
                            color_icon = "color: #4ad129;"
                            accion = "cambiarEstatusVenta('" + val.cve_venta  + "','2')";
                        }
                            
                        

                        var btn_editar = "<i class='fa fa-edit' style='font-size:18px; cursor: pointer;' title='Editar comanda' onclick=\"consultarComanda('" + val.folio_venta  + "')\"></i>";
                        var btn_status = "<i class='" + icon + "' style='font-size:14px; " + color_icon + " cursor: pointer;' title='" + title + "' onclick=\"" + accion + "\"></i>";

                        tableFolioEntregado.row.add([
                            val.folio_venta ,
                            val.total_venta ,
                            val.fechaalta_deventa ,
                            val.tipo_venta ,
                            btn_editar,
                            btn_status,
                        ]).draw();
                    })

                }
                else
                {
                    tableFolioEntregado = $('#gridFolioEntregado').DataTable();
                    
                }

            }
        });
    }

    function cambiarEstatusVenta(cve_venta, estatus){
        $.ajax({
            url      : 'Venta/cambiarEstatusVenta',
            type     : "POST",
            data    : { 
                ban: 1,
                cve_venta: cve_venta,
                estatus : estatus
            },
            success  : function(datos) {
                
                cargarTablaFolio();
                cargarTablaFolioEntregado();

                $("#btncancelarFolioVenta").prop( "disabled", false );
                $("#radio1").prop('checked', true);
                $("#txtNombreClienteVenta").text('');
                $("#txtDireccionClienteVenta").text('');
                $("#txtTelefonoClienteVenta").text('');
                $("#txtbtnVincularCliente").hide();
                $("#txtHoraClienteVenta").text('');
                $("#txtTotalVenta").text('');
                $("#divTipoVenta").hide();
                $("#txtFolioVenta").text('');
                tableComanda.clear().draw();

            }
        });
    }

    function  nuevoCliente(){

        $('#modal_formClienteNuevo').modal({
            keyboard: false
        });

        $("#muestra_formClienteNuevo").html('Cargando...');

        $.ajax({
            url: 'venta/formClienteNuevo',
            success: function(datos){

                $("#muestra_formClienteNuevo").html(datos);

            }
        });
        
    }

    function vincularCliente(){
        $('#modal_formCliente').modal({
            keyboard: false
        });

        $.ajax({
            url      : 'Cliente/consultar',
            type     : "POST",
            data    : { 
                ban: 1
            },
            beforeSend: function() {
                // setting a timeout

            },
            success  : function(datos) {

                var myJson = JSON.parse(datos);

                select = $("#cmbContactosListCliente");
                select.attr('disabled',false);
                select.find('option').remove();

                if(myJson.arrayDatos.length > 0)
                {
                    
                    $(myJson.arrayDatos).each( function(key, val)
                    {
                        if(val.cve_cliente != null){
                        
                            value = '{"cve_cliente":"'+val.cve_cliente+'","nombre_cliente":"'+val.nombre_cliente+'","domicilio_cliente":"'+val.domicilio_cliente+'","telefono_cliente":"'+val.telefono_cliente+'"}';
							select.append("<option data-value='"+value+"' value='"+val.nombre_cliente.replace(/'/g, "&#x27;")+"'>");
                        }
                    })

                }

            }
        });
    }

    function tipoVenta(){
        var myRadio = $("input[name=optradio]");
        var checkedValue = myRadio.filter(":checked").val();
        // 1 = restaurante
        // 2 = domicilio
        if(checkedValue == 1){
            $("#txtbtnVincularCliente").hide();
            $.ajax({
                url      : 'Venta/actualizaTipoVenta',
                type     : "POST",
                data    : { 
                    ban: checkedValue,
                    cve_cliente_venta: 0,
                    folio_venta: $("#txtFolioVenta").text()
                },
                success  : function(datos) {

                }
            });
        }
        else{

            $("#txtbtnVincularCliente").show();
            $("#btnVincularCliente").show();
            $("#btnNuevoCliente").show();

            $.ajax({
                url      : 'Venta/actualizaTipoVenta',
                type     : "POST",
                data    : { 
                    ban: checkedValue,
                    cve_cliente_venta: 0,
                    folio_venta: $("#txtFolioVenta").text()
                },
                success  : function(datos) {

                }
            });
            
        }
        
    }
    function GenerarFolio(){
        cargarTablaFolio();
        table = $('#gridComanda').DataTable();
        var entro = false;
        $('#gridComanda tbody tr').each(function(index, tr) {

            if($(this).find('td').eq(2).text() != ''){
                entro = true;
            }
        });
        if(entro == false && $("#txtFolioVenta").text().length == 0  || entro == true && $("#txtFolioVenta").text().length > 0){
            $.ajax({
                url      : 'Venta/generarFolio',
                type     : "POST",
                data    : { 
                    ban: 1,
                    folo_venta: ''
                },
                success  : function(datos) {

                    var myJson = JSON.parse(datos);

                    if(myJson.arrayDatos.length > 0)
                    {
                        $("#txtFolioVenta").text(myJson.arrayDatos[0].folio_venta);
                        $("#btncancelarFolioVenta").prop( "disabled", false );
                        $("#radio1").prop('checked', true);
                        $("#txtNombreClienteVenta").text('');
                        $("#txtDireccionClienteVenta").text('');
                        $("#txtTelefonoClienteVenta").text('');
                        $("#txtbtnVincularCliente").hide();
                        $("#txtHoraClienteVenta").text('');
                        $("#txtTotalVenta").text('');
                        $("#divTipoVenta").hide();
                        $("#btnPagarComanda").hide();
                        
                    }

                }
            });

            table.clear().draw();
            
        }
        else{
            msgAlert1("Comanda en proceso","warning");
        }


        
    }

    function cargarProductos(){
        $.ajax({
            url      : 'Venta/consultarProductos',
            type     : "POST",
            data    : { 
                ban: 1
            },
            beforeSend: function() {
                // setting a timeout

            },
            success  : function(datos) {

                var myJson = JSON.parse(datos);

                select = $("#cmbContactosListMod");
                select.attr('disabled',false);
                select.find('option').remove();

                if(myJson.arrayDatos.length > 0)
                {
                    
                    $(myJson.arrayDatos).each( function(key, val)
                    {
                        if(val.cvema_producto != null){
                        
                            value = '{"cvema_producto":"'+val.cvema_producto+'","nombrecompleto_producto":"'+val.nombrecompleto_producto.replace(/"/g, "\\&#x22;").replace(/'/g, "&#x27;")+'","precio_producto":"'+val.precio_producto.replace(/"/g, "\\&#x22;").replace(/'/g, "&#x27;")+'","cveproducto_producto":"'+val.cveproducto_producto+'","cantidadingrediente_producto":"'+val.cantidadingrediente_producto+'"}';
							select.append("<option data-value='"+value+"' value='"+val.nombrecompleto_producto.replace(/'/g, "&#x27;")+"'>");
                        }
                    })

                }

            }
        });
    }

    function AgregarProductoTabla(){
        if($("#txtFolioVenta").text().length !== 0){

            var val = $('#cmbProductos').val() ? $('#cmbProductos').val() : '';
            // se agrego indexOf para saber si el string val viene con comillas o apostrofe y formar bien la cadena
            if(val.indexOf("\"") !== -1){
                var valueCombo = $("#cmbContactosListMod").find("option[value='"+val+"']").data("value") ? $("#cmbContactosListMod").find("option[value='"+val+"']").data("value") : "";
            }
            else{
            var valueCombo = $("#cmbContactosListMod").find("option[value=\""+val+"\"]").data("value") ? $("#cmbContactosListMod").find("option[value=\""+val+"\"]").data("value") : "";
            }
            if(valueCombo.cvema_producto != null){
                if(valueCombo.cveproducto_producto == '5'){
                    //el paquete piiede tener varias pizzas tradicionales con diferentes ingredientes
                    $('#modal_formIngredientesPaquete').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    $("#muestra_formInputsPaquete").html('Cargando...');
                    var pizzas = valueCombo.cantidadingrediente_producto;
                    var arraypizzas = pizzas.split(",");
                    $.ajax({
                        url: 'Venta/formPizzaIngredientePaquete',
                        type     : "POST",
                            data     : { 
                                cantidad_productos : 1 ,
                                cantidad_pizzas : arraypizzas.length,
                                cantidadingrediente_producto : valueCombo.cantidadingrediente_producto 
                            },
                        success: function(datos){
                            $("#myModalLabelIngredientesPaquete").text(valueCombo.nombrecompleto_producto);
                            $("#muestra_formInputsPaquete").html(datos);
                        }
                    });

                }
                else{
                    $('#modal_formCantidadProductos').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    $('#modal_formCantidadProductos').on('shown.bs.modal', function () {
                        $('#txtCantidadProductos').focus();
                    });
                }
                
            }
            else{
                msgAlert1("El producto no existe.","warning");
            }
        }
        else{
            $('#cmbProductos').val('');
            msgAlert1("No existe folio para generar orden","warning");
        }
        
    }

    $('#btnGuardarCantidad').click(function (e) {

        var val = $('#cmbProductos').val() ? $('#cmbProductos').val() : '';
        // se agrego indexOf para saber si el string val viene con comillas o apostrofe y formar bien la cadena
        if(val.indexOf("\"") !== -1){
            var valueCombo = $("#cmbContactosListMod").find("option[value='"+val+"']").data("value") ? $("#cmbContactosListMod").find("option[value='"+val+"']").data("value") : "";
        }
        else{
        var valueCombo = $("#cmbContactosListMod").find("option[value=\""+val+"\"]").data("value") ? $("#cmbContactosListMod").find("option[value=\""+val+"\"]").data("value") : "";
        }

        title = 'Eliminar productos de la comanda';
        icon = 'fa fa-minus-circle';
        color_icon = "color: #d12929;"
        accion = "eliminarProductoTabla(this,'1')";
        

        var btn_eliminar = "<i class='" + icon + "' style='font-size:14px; " + color_icon + " cursor: pointer;' title='" + title + "' onclick=\"" + accion + "\"></i>";
        var myNumeroAleatorio = Math.floor(Math.random()*10001);
        cantidad_productos = $('#txtCantidadProductos').val();;

        if(valueCombo.cveproducto_producto == '1'){
            //pizza tradicional tiene ingredientes por elegir
            $('#modal_formIngredientes').modal({
                backdrop: 'static',
                keyboard: false
            });
            $("#muestra_formInputs").html('Cargando...');
            $.ajax({
                url: 'Venta/formPizzaIngrediente',
                type     : "POST",
                    data     : { 
                        cantidad_productos: cantidad_productos ,
                        cantidadingrediente_producto : valueCombo.cantidadingrediente_producto
                    },
                success: function(datos){
                    $("#myModalLabelIngredientes").text(valueCombo.nombrecompleto_producto);
                    $("#muestra_formInputs").html(datos);

                }
            });
        }
        else if(valueCombo.cveproducto_producto == '5'){
            //el paquete piiede tener varias pizzas tradicionales con diferentes ingredientes
            $('#modal_formIngredientesPaquete').modal({
                backdrop: 'static',
                keyboard: false
            });
            $("#muestra_formInputsPaquete").html('Cargando...');
            var pizzas = valueCombo.cantidadingrediente_producto;
            var arraypizzas = pizzas.split(",");
            $.ajax({
                url: 'Venta/formPizzaIngredientePaquete',
                type     : "POST",
                    data     : { 
                        cantidad_productos : cantidad_productos ,
                        cantidad_pizzas : arraypizzas.length,
                        cantidadingrediente_producto : valueCombo.cantidadingrediente_producto 
                    },
                success: function(datos){
                    $("#myModalLabelIngredientesPaquete").text(valueCombo.nombrecompleto_producto);
                    $("#muestra_formInputsPaquete").html(datos);
                }
            });

        }else{


            $.ajax({
                url      : 'Venta/GuardarVenta',
                type     : "POST",
                data     : { 
                        ban: 1,
                        cve_deventa: 0,
                        folioventa_deventa : $("#txtFolioVenta").text(),
                        cvema_deventa : valueCombo.cvema_producto,
                        cantidad_deventa : cantidad_productos,
                        preciounitario_deventa : valueCombo.precio_producto,
                        cveproducto_deventa :   valueCombo.cveproducto_producto,
                        deingredientes : '0'
                },
                success  : function(datos) {
                    consultarComanda($("#txtFolioVenta").text());
                }
            });


            $('#txtCantidadProductos').val('1');
            $('#cmbProductos').val('');

            $("#modal_formCantidadProductos").modal('hide');//ocultamos el modal
            $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
            $('.modal-backdrop').remove();

        }
        
        
    
    });

    function btnGuardarCantidad2(){

        var val = $('#cmbCliente').val() ? $('#cmbCliente').val() : '';
        // se agrego indexOf para saber si el string val viene con comillas o apostrofe y formar bien la cadena
        if(val.indexOf("\"") !== -1){
            var valueCombo = $("#cmbContactosListCliente").find("option[value='"+val+"']").data("value") ? $("#cmbContactosListCliente").find("option[value='"+val+"']").data("value") : "";
        }
        else{
        var valueCombo = $("#cmbContactosListCliente").find("option[value=\""+val+"\"]").data("value") ? $("#cmbContactosListCliente").find("option[value=\""+val+"\"]").data("value") : "";
        }

        $.ajax({
            url      : 'Venta/actualizaTipoVenta',
            type     : "POST",
            data    : { 
                ban: 2,
                cve_cliente_venta: valueCombo.cve_cliente,
                folio_venta: $("#txtFolioVenta").text()
            },
            success  : function(datos) {
                consultarComanda($("#txtFolioVenta").text());
                cargarTablaFolio();
            }
        });
    };

    function consultarComanda(folioComanda){
        $("#txtFolioVenta").text(folioComanda);
        $("#divTipoVenta").show();
        
        
        
        $.ajax({
            url      : 'Venta/actualizarTotalVenta',
            type     : "POST",
            data    : { 
                ban: 1 ,
                folo_venta: folioComanda
            },
            success  : function(datos) {
            }
        });
        $.ajax({
            url      : 'Venta/consultarComanda',
            type     : "POST",
            data    : { 
                ban: 1 ,
                folio: folioComanda
            },
            success  : function(datos) {

                var myJson = JSON.parse(datos);

                tableComanda.clear().draw();

                if(myJson.arrayDatos.length > 0)
                {

                    var title;
                    var icon;
                    var color_icon;
                    var accion;

                    $(myJson.arrayDatos).each( function(key, val)
                    {
                        title = 'Eliminar producto';
                        icon = 'fa fa-minus-circle';
                        color_icon = "color: #d12929;"
                        accion = "eliminarProductoComanda('" + val.folioventa_deventa + "','"+ val.cve_deventa + "','"+val.cveproducto_deventa+"')";

                        if(val.cveproducto_deventa == '1'){
                            
                            var btn_editar = "<i class='fa fa-edit' style='font-size:18px; cursor: pointer;' title='Detalle producto' onclick=\"mostrarSubProductosComanda('" + val.cve_deventa  +"','"+val.cveproducto_deventa +"','"+val.cantidad_deventa+"','"+val.cantidadingrediente_producto+"','"+val.nombrecompleto_comanda+"')\"></i>";
                            var btnCantidad = val.cantidad_deventa;
                        }
                        else if(val.cveproducto_deventa == '5'){
                            
                            var btn_editar = "<i class='fa fa-edit' style='font-size:18px; cursor: pointer;' title='Detalle producto' onclick=\"mostrarSubProductosComanda('" + val.cve_deventa  +"','"+val.cveproducto_deventa +"','"+val.cantidad_deventa+"','"+val.cantidadingrediente_producto+"','"+val.nombrecompleto_comanda+"')\"></i>";
                            var btnCantidad = val.cantidad_deventa;
                        }
                        else{
                            if(val.estatus_venta == 1){
                                var btn_editar = "";
                                var btnCantidad = '<div class="input-group"> <span class="input-group-btn"> <button type="button" class="btn btn-danger btn-number" onclick="modCantidad('+0+','+val.cantidad_deventa+','+val.cve_deventa+')"><span class="glyphicon glyphicon-minus"></span></button></span><input type="text" class="form-control input-number" value="'+val.cantidad_deventa+'" min="1" max="100"><span class="input-group-btn"><button type="button" onclick="modCantidad('+1+','+val.cantidad_deventa+','+val.cve_deventa+')" class="btn btn-success btn-number"><span class="glyphicon glyphicon-plus"></span></button></span></div>';
                            }
                            else{
                                var btn_editar = "";
                                var btnCantidad = val.cantidad_deventa;
                            }
                        }
                        if(val.estatus_venta == 1){
                            var btn_status = "<i class='" + icon + "' style='font-size:14px; " + color_icon + " cursor: pointer;' title='" + title + "' onclick=\"" + accion + "\"></i>";
                        }
                        else{
                            var btn_status = '';
                        }
                        

                        tableComanda.row.add([
                            val.nombrecompleto_comanda ,
                            val.preciounitario_deventa ,
                            btnCantidad,
                            btn_editar,
                            btn_status,
                        ]).draw();

                        $("#txtTotalVenta").text(val.total_venta);
                        if(val.tipo_venta == 'Restaurante'){
                            $("#radio1").prop('checked', true);
                            $("#radio2").prop('checked', false);
                            $("#radio1").prop('disabled', false);
                            $("#radio2").prop('disabled', false);
                            $("#txtNombreClienteVenta").text('');
                            $("#txtDireccionClienteVenta").text('');
                            $("#txtTelefonoClienteVenta").text('');
                            $("#txtbtnVincularCliente").hide();
                            $("#btnPagarComanda").show();
                            
                            if(val.estatus_venta == 2){
                                $("#radio1").prop('disabled', true);
                                $("#radio2").prop('disabled', true);
                                $("#btnPagarComanda").hide();
                            }
                        }
                        else if(val.tipo_venta == 'Domicilio'){
                            $("#radio2").prop('checked', true);
                            $("#radio1").prop('checked', false);
                            $("#radio1").prop('disabled', false);
                            $("#radio2").prop('disabled', false);
                            $("#txtbtnVincularCliente").show();
                            $("#btnVincularCliente").show();
                            $("#btnNuevoCliente").show();
                            $("#txtNombreClienteVenta").text(val.nombre_cliente);
                            $("#txtDireccionClienteVenta").text(val.domicilio_cliente);
                            $("#txtTelefonoClienteVenta").text(val.telefono_cliente);
                            $("#btnPagarComanda").show();
                            
                            if(val.estatus_venta == 2){
                                $("#btnVincularCliente").hide();
                                $("#btnNuevoCliente").hide();
                                $("#radio1").prop('disabled', true);
                                $("#radio2").prop('disabled', true);
                                $("#btnPagarComanda").hide();
                            }
                        }
                        if(key == 0){
                            $("#txtHoraClienteVenta").text(val.fechaalta_deventa);
                        }
                        
                        
                        
                        
                    });
                    cargarTablaFolio();
                cargarTablaFolioEntregado();

                }
                else
                {
                    tableComanda = $('#gridComanda').DataTable();
                    $("#txtTotalVenta").text('');
                    $("#btncancelarFolioVenta").prop( "disabled", false );
                    $("#radio1").prop('checked', true);
                    $("#txtNombreClienteVenta").text('');
                    $("#txtDireccionClienteVenta").text('');
                    $("#txtTelefonoClienteVenta").text('');
                    $("#txtbtnVincularCliente").hide();
                    $("#txtHoraClienteVenta").text('');
                    $("#txtTotalVenta").text('');
                    $("#divTipoVenta").hide();
                    $("#btnPagarComanda").hide();
                    
                }

            }
        });

    }

    function eliminarProductoComanda(folio_venta, cve_deventa,cveproducto_deventa){
        $.ajax({
                url      : 'Venta/eliminarProductoVenta',
                type     : "POST",
                data     : { 
                        folio_venta : $("#txtFolioVenta").text(),
                        cve_deventa:cve_deventa,
                        cantidad_deventa : cveproducto_deventa
                },
                success  : function(datos) {
                    consultarComanda($("#txtFolioVenta").text());
                    
                }
            });
    }

    function modCantidad(ban,cantidad_deventa,cve_deventa){
        var aux = cantidad_deventa;
        if(ban == '1'){
            aux++;
        }
        else if(ban == '0'){
            aux--;
        }

        if(aux != 0){
            $.ajax({
                url      : 'Venta/modificarCantidadVenta',
                type     : "POST",
                data     : { 
                        ban: 2,
                        folio_venta : $("#txtFolioVenta").text(),
                        cve_deventa:cve_deventa,
                        cantidad_deventa : aux
                },
                success  : function(datos) {
                    consultarComanda($("#txtFolioVenta").text());
                }
            });
        }
    }


    function mostrarSubProductosComanda(cve_deventa, cveproducto_deventa, cantidad_deventa, cantidadingrediente_producto, nombrecompleto_comanda){
        if(cveproducto_deventa == '1'){
            //pizza tradicional tiene ingredientes por elegir
            $('#modal_formIngredientesMod').modal({
                backdrop: 'static',
                keyboard: false
            });
            $("#muestra_formInputsMod").html('Cargando...');
            $.ajax({
                url: 'Venta/formPizzaIngredienteMod',
                type     : "POST",
                    data     : { 
                        cve_deventa : cve_deventa,
                        cveproducto_deventa : cveproducto_deventa,
                        nombrecompleto_comanda : nombrecompleto_comanda,
                        cantidad_productos: cantidad_deventa ,
                        cantidadingrediente_producto : cantidadingrediente_producto
                    },
                success: function(datos){
                    $("#myModalLabelIngredientesMod").text(nombrecompleto_comanda);
                    $("#muestra_formInputsMod").html(datos);

                    
                }
            });
        }
        else if(cveproducto_deventa == '5'){
            //el paquete piiede tener varias pizzas tradicionales con diferentes ingredientes
            $('#modal_formIngredientesPaqueteMod').modal({
                backdrop: 'static',
                keyboard: false
            });
            $("#muestra_formInputsPaqueteMod").html('Cargando...');
            var pizzas = cantidadingrediente_producto;
            var arraypizzas = pizzas.split(",");
            $.ajax({
                url: 'Venta/formPizzaIngredientePaqueteMod',
                type     : "POST",
                    data     : { 
                        cve_deventa : cve_deventa,
                        cantidad_productos : cantidad_deventa ,
                        cantidad_pizzas : arraypizzas.length,
                        cantidadingrediente_producto : cantidadingrediente_producto 
                    },
                success: function(datos){
                    $("#myModalLabelIngredientesPaqueteMod").text(nombrecompleto_comanda);
                    $("#muestra_formInputsPaqueteMod").html(datos);
                }
            });
        }
    }

    

    function eliminarProductoTabla(thiss, valor){
        tableProductos.row( $(thiss).parents('tr') ).remove().draw();
    }

    function guardarProductos(){
        table = $('#gridProductos').DataTable();
        var estrenos = [];
        var count = 0;
        $('#gridProductos tbody tr').each(function(index, tr) {

            ids = this.id;
            res = ids.split(",");

            $.ajax({
                url      : 'Venta/GuardarVenta',
                type     : "POST",
                data     : { 
                        ban: 1,
                        cve_deventa: 0,
                        folioventa_deventa : $("#txtFolioVenta").text(),
                        cvema_deventa : res[0],
                        cantidad_deventa : $(this).find('td').eq(2).text(),
                        preciounitario_deventa : $(this).find('td').eq(1).text(),
                        cveproducto_deventa :   res[1],
                        deingredientes : res[2]
                },
                success  : function(datos) {
                }
            });     
        });
        //Clave del producto+","+Tipo del producto+","+Ingreintes+","+numero aleatorios
    }

    function cancelarVenta(){

        $.ajax({
            url      : 'Venta/generarFolio',
            type     : "POST",
            data    : { 
                ban: 1,
                folo_venta: $("#txtFolioVenta").text()
            },
            success  : function(datos) {

                $("#cmbProductos").prop( "disabled", true );
                $("#txtbtnNuevaVenta").prop( "disabled", false );
                $("#txtFolioVenta").text('');
                $("#btncancelarFolioVenta").prop( "disabled", true );
                tableProductos.clear().draw();

            }
        });

    }

    function msgAlert1(msg,tipo)
    {
        $('#msgAlert1').css("display", "block");
        $("#msgAlert1").html("<div class='alert alert-" + tipo + "' role='alert'>" + msg + " <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> </div>");
        setTimeout(function() { $("#msgAlert1").fadeOut(1500); },1500);
    }

    function msgAlert2(msg,tipo)
    {
        $('#msgAlert2').css("display", "block");
        $("#msgAlert2").html("<div class='alert alert-" + tipo + "' role='alert'>" + msg + " <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> </div>");
        setTimeout(function() { $("#msgAlert2").fadeOut(1500); },1500);
    }

    $('#btnCancelarCantidad').click(function (e) {
        $('#cmbProductos').val('');
        $('#txtCantidadProductos').val('1');
        $('#modal_formCantidadProductos').modal('hide');
        $('#modal_formIngredientes').modal('hide');
        $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
        $('.modal-backdrop').remove();

        return false;
    });

//configuracion para el snippe los numeros 
    $('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        msgAlert2("Favor de ingresar un numero mayor a 0","warning");
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        //alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    
    
});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });


</script>
</body>
</html>
