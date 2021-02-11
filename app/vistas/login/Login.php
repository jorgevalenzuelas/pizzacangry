<!DOCTYPE html>
<html>
<head>
  	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<title><?php echo NOMBRE_SITIO; ?> | Log in</title>
  	<!-- Tell the browser to be responsive to screen width -->
  	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  	<link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL; ?>public/css/estilos.css">
  	<!-- Bootstrap 3.3.7 -->
  	<link rel="stylesheet" href="<?php echo RUTA_URL; ?>public/bower_components/bootstrap/dist/css/bootstrap.min.css">
  	<!-- Font Awesome -->
  	<link rel="stylesheet" href="<?php echo RUTA_URL; ?>public/bower_components/font-awesome/css/font-awesome.min.css">
  	<!-- Theme style -->
  	<link rel="stylesheet" href="<?php echo RUTA_URL; ?>public/dist/css/AdminLTE.min.css">
  	<link rel="chortcut icon" type="image/png" href="<?php echo RUTA_URL; ?>public/img/LogoCangry_icon.png" />

  	<!-- Google Font -->
  	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<style>
	.login-page{
  background: #000000;
  }
</style>
<body class="hold-transition login-page">

<div class="login-box">
  	<div class="login-logo">
  		<img src="img/LogoCangry.png" width="140" height="140">
  	</div>
  	<!-- /.login-logo -->
  	<div class="login-box-body">

  		<div id="msgError"></div>

    	<p class="login-box-msg">Iniciar sesión para accesar</p>

	    <form action="login/verificarUsuario" id="login" method="post">
	      	<div class="form-group has-feedback">
	        	<input type="text" id="txt_usr" name="txt_usr" class="form-control" placeholder="Usuario">
	        	<span class="glyphicon glyphicon-user form-control-feedback"></span>
	      	</div>
	      	<div class="form-group has-feedback">
	        	<input type="password" id="txt_pass" name="txt_pass" class="form-control" placeholder="Contraseña">
	        	<span class="glyphicon glyphicon-lock form-control-feedback"></span>
	      	</div>
	      	<div class="row">
	        	<!-- /.col -->
		        <div class="col-xs-12">
		          	<button type="submit" class="btn btn-primary btn-block btn-flat" id="btnEntrar">Entrar</button>
		        </div>
	        	<!-- /.col -->
	      	</div>
	    </form>

  	</div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo RUTA_URL; ?>public/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo RUTA_URL; ?>public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script type="text/javascript">

	$('#login').on('submit',function(e){
	    e.preventDefault();

	    var usr = $('#txt_usr').val(); 
		var pass = $('#txt_pass').val();

	    if (usr == "")
		{
			msgError("Favor de agregar tu usuario.","warning");
		}
		else if (pass == "")
		{
			msgError("Favor de agregar tu contraseña.","warning");
		}
		else
		{
			$("#btnEntrar").prop('disabled', true);

		    $.ajax({
		        type     : "POST",
		        url      : $(this).attr('action'),
		        data     : $(this).serialize(),
		        beforeSend: function() {
			        // setting a timeout
			        msgError("Iniciando...","info");
			        //setTimeout(function() { }, 1500);
			    },
		        success  : function(datos) {
		           	var json = eval("(" + datos + ")");

					if (json.sesion == 1){
						//msgError("Sesion iniciada..!","success");
						location.href='home';
					}
					else
					{
						msgError(json.msg,"danger");
						$("#btnEntrar").prop('disabled', false);
					}
		        }
		    });
		}

	});

	function msgError(msg,tipo)
	{
		$('#msgError').css("display", "block");
		$("#msgError").html("<div class='alert alert-" + tipo + "' role='alert'>" + msg + " <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> </div>");
	}

</script>

</body>
</html>
