
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
            <div class="col-md-4">
                <div class="form-group">
                    <div id="msgAlert2"></div>
                    <label for="CMBCONTACTOS">Buscar contactos</label>
                    <datalist id="cmbContactosListMod">
                        <!--option value="0" selected="selected"> -- Seleccione -- </option-->
                    </datalist>
                    <input list="cmbContactosListMod" id="CMBCONTACTOS" name="CMBCONTACTOS" type="text" class="form-control" placeholder=" -- Escriba -- " onkeyup="javascript:this.value=this.value.toUpperCase();" onchange="AgregarProductoTabla();">
                </div>
                <div id="msgAlert"></div>
                <div class="box" style="margin-top: 20px;">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="gridTradicional" class="table table-bordered table-striped" style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th>Nombre produco</th>
                                    <th>precio</th>
                                    <th>cantidad</th>
                                    <th>Eliminar</th>
                                    <th>cvema_producto</th>
                                    <th>cveproducto_producto</th>
                                    <th>cantidadingrediente_producto</th>
                                </tr>
                            </thead>
                            
                        </table>
                        <button type="button" class="btn btn-primary" onclick="guardarProductos()">Guardar</button>
                    </div>
                    <!-- /.box-body -->
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
<!-- ./wrapper -->
<div class="modal fade" id="modal_formSnack" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" >
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="myModalLabel">Snack</h2>
            </div>
            <div class="modal-body" id="muestra_formSnack">
                <div class="row">
                    <div class="form-group col-md-12">
                        <div id="msgAlert2"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Cantidad*</label>
                        <input type="text" class="form-control" id="txtNombreSnack" name="txtNombreSnack" onkeyup='javascript:this.value=this.value.toUpperCase();'>
                    </div>
                </div> 
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary" id="btnGuardar">Aceptar</button>
                <button class="btn btn-primary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_formIngredientes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" >
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="myModalLabel">Ingredientes</h2>
            </div>
            <div class="modal-body" id="muestra_formInputs"> 

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
    var cantidad_ingredientes = 0;
    var cantidad_productos = 0;
    $(document).ready(function () {

        tableTradicional = $('#gridTradicional').DataTable( {    
            "responsive": true,
            "searching" : false,
            "paging"    : false,
            "ordering"  : false,
            "info"      : false,
            "columnDefs": [
                {"width": "10%","className": "text-center","targets": 3},
                { "targets" : [4], "visible": false},
                { "targets" : [5], "visible": false},
                { "targets" : [6], "visible": false},
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
    });

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
                        value = '{"cvema_producto":"'+val.cvema_producto+'","nombre_producto":"'+val.nombre_producto.replace(/"/g, "\\&#x22;").replace(/'/g, "&#x27;")+'","precio_producto":"'+val.precio_producto.replace(/"/g, "\\&#x22;").replace(/'/g, "&#x27;")+'","cveproducto_producto":"'+val.cveproducto_producto+'","cantidadingrediente_producto":"'+val.cantidadingrediente_producto+'"}';
							select.append("<option data-value='"+value+"' value='"+val.nombre_producto.replace(/'/g, "&#x27;")+"'>");
                    })

                }
                else
                {
                    document.getElementById("cmbTamanoTradicional").selectedIndex = "0";
                    
                }

            }
        });
    }

    function AgregarProductoTabla(){

        $('#modal_formSnack').modal({
            keyboard: false
        });
    }

    $('#btnGuardar').click(function (e) {

        var val = $('#CMBCONTACTOS').val() ? $('#CMBCONTACTOS').val() : '';
        // se agrego indexOf para saber si el string val viene con comillas o apostrofe y formar bien la cadena
        if(val.indexOf("\"") !== -1){
            var valueCombo = $("#cmbContactosListMod").find("option[value='"+val+"']").data("value") ? $("#cmbContactosListMod").find("option[value='"+val+"']").data("value") : "";
        }
        else{
        var valueCombo = $("#cmbContactosListMod").find("option[value=\""+val+"\"]").data("value") ? $("#cmbContactosListMod").find("option[value=\""+val+"\"]").data("value") : "";
        }
        
        cantidad_productos = $('#txtNombreSnack').val();
        //$("#modal_formSnack").modal('hide');//ocultamos el modal
        //$('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
        //$('.modal-backdrop').remove();
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

                    $("#muestra_formInputs").html(datos);

                }
            });

        }
        else if(valueCombo.cveproducto_producto == '5'){
            //el paquete piiede tener varias pizzas tradicionales con diferentes ingredientes

        }else{

        }
        
        

    });

    function eliminarProductoTabla(thiss, valor){
        tableTradicional.row( $(thiss).parents('tr') ).remove().draw();
    }

    function guardarProductos(){
        table = $('#gridTradicional').DataTable();
        var estrenos = [];
        var count = 0;
        $('#gridTradicional tbody tr').each(function() {

            ids = this.id;
            res = ids.split(",");

            cvema_producto = res[0];
            cveproducto_producto = res[1];

            estrenos[count] = {
                "cvema_producto": res[0],
                "cveproducto_producto": res[1],
                "cantidad_productos": $('#txtCantidadProductos').val(),
                "cve_ingredientes": "1,2|3,3"
            };
            alert(JSON.stringify(estrenos[count]));
            count = count + 1;        
        })
    }


</script>
</body>
</html>