


function cerrar_sesion()
{
  	bootbox.confirm({
		message: "Esta seguro de Cerrar Sesión?",
		buttons: {
			confirm: {
				label: 'Si'
			},
			cancel: {
				label: 'No'
			}
		},
		callback: function (result) {
			//Nota: Necesito ser mas especifico en las rutas por si meto parametros...
			//alert(RUTA_URL);
			if (result == true){
				$.ajax({
					url: 'login/cerrarSesion',
					success: function(datos){
						var json = eval("(" + datos + ")");

						if (json.sesion == 0)
						{
							location.href = 'login';
						}
						
					}
				});
				return false;
			}else{
				
			}
		}
	});
}


function soloNumeros(e)
{
	var key = window.Event ? e.which : e.keyCode
	return (key >= 45 && key <= 57)
}

