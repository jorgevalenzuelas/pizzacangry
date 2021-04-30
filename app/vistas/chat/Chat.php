<html>
    <head>
    <meta charset="UTF-8">
    <title>chat</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function (e){
            var conn = new WebSocket('wss://www.pizzaloscangry.tk/phpchat/');//conectara

            conn.onopen = function(e) {
                console.log("conexion exitosa!");
            };

            conn.onerror = function (e) {
                console.log('WebSocket Error ' + e);
            };
            conn.onmessage = function(e) {
                console.log(e.data);
                var respuesta = JSON.parse(e.data);
                console.log("nombre:" +respuesta.nombre+ " mensaje: "+respuesta.mensaje);
                $('#mensaje-div').append("<p><h3>"+respuesta.nombre+":</h3>"+respuesta.mensaje+"</p>");
            };
            $("#btn").click(function (e){
                var nombre = $('#nombre').val();
                var mensaje = $('#mensaje').val();
                var enviar = {'nombre': nombre, 'mensaje' : mensaje};
                conn.send(JSON.stringify(enviar));
                $('#mensaje-div').append("<p><h3>Tu:</h3>"+mensaje+"</p>");

            });
            //conn.send('Hello World!');
        });

    </script>
    </head>
    <body>
    Instrucciones HTML
    <div class="container">
        <div class="offset-md-3 col-md-4">
            <input type="text" placeholder="nombre" id="nombre" class="form-control">
            <textarea id="mensaje" class="from-control"></textarea>
            <br>
            <button id="btn" class="btn btn-info">enviar</button>
        </div>
        <div class="row">
            <div class="offset-md-3 col-md-6" id="mensaje-div">
            </div>
        </div>
    </div>
    </body>
</html>