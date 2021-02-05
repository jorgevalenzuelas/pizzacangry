
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo NOMBRE_SITIO; ?> | Punto de Venta</title>
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
                Punto de Venta
            </h1>

        </section>

        <!-- Main content -->
        <section class="content">
      
            <div class="box">
                <div class="box-body">
                    
                    <div class="form-group col-md-3">
                        <label>Tipo de Venta</label>
                        <select class="form-control">
                            <option value="1">VENTA DE CAJA</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Forma de Pago</label>
                        <select class="form-control">
                            <option value="1">EFECTIVO</option>
                            <option value="2">TARJETA</option>
                            <option value="3">CORTESÍA</option>
                            <option value="4">DINERO ELECTRÓNICO</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Cliente</label>
                        <div class="input-group input-group">
                            <input type="text" class="form-control" placeholder="PÚBLICO GENERAL" readonly>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-info btn-flat"><i class="fa fa-plus"></i> </button>
                            </span>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="box">
                <div class="box-body">
                    
                    <div class="form-group col-md-2">
                        <label>Código</label>
                        <input type="text" class="form-control" id="exampleInputEmail1">
                    </div>

                    <div class="form-group col-md-7">
                        <label>Descripción</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" readonly>
                    </div>

                    <div class="form-group col-md-2">
                        <label>Precio de Venta</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" readonly>
                    </div>

                    <div class="form-group col-md-1">
                        <label>Cantidad</label>
                        <input type="text" class="form-control" id="exampleInputEmail1">
                    </div>

                    
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 75px">Cantidad</th>
                            <th>Descripción</th>
                            <th style="width: 120px">Precio</th>
                            <th style="width: 150px">Oferta</th>
                            <th style="width: 120px">SubTotal</th>
                            <th style="width: 50px">FN</th>
                        </tr>

                        <tr>
                            <td align="center">1</td>
                            <td>MINI CARLOS V</td>
                            <td>60.00</td>
                            <td></td>
                            <td>60.00</td>
                            <td align="center">
                                <i class="fa fa-minus-circle"></i>
                            </td>
                        </tr>
                        <tr>
                            <td align="center">1</td>
                            <td>MINI CARLOS V</td>
                            <td>60.00</td>
                            <td></td>
                            <td>60.00</td>
                            <td align="center">
                                <i class="fa fa-minus-circle"></i>
                            </td>
                        </tr>
                       
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <div class="form-group col-md-8 no-margin pull-left" style="padding-left: 0px;">
                        <button type="button" class="btn btn-primary btn-lg">COBRAR</button>
                        <button type="button" class="btn btn-success btn-lg">CATÁLOGO</button>
                        <button type="button" class="btn btn-danger btn-lg">CANCELAR</button>
                    </div>
                    <div class="form-group col-md-4 no-margin pull-right">
                        <label>Total</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" style="font-size: 60px; height: 70px;" readonly>
                    </div>
                </div>
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

<script src="<?php echo RUTA_URL; ?>public/js/main.js"></script>
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

<script type="text/javascript">

    $(document).ready(function () {
        
        $.ajax({
            url     : "opcion/crear_menu",
            //type    : "POST",
            //data    : "id_menu="+0+"&bandera="+1+"&origen=''",
            //dataType: 'html',

            success : function(response)
            {
                console.log (response);
                //crear_menu(response,0,2);
                
                //$('#menu').html(barraMenu);
            }
        });

    });

    $(document).keypress(function(e){
       if(e.charCode == 113){
          alert("a");
          return false;
      }
     })
</script>

</body>
</html>
