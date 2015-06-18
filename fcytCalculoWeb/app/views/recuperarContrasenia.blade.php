@extends('layouts.userNormal')

@section('content')
	<button onclick="fullCentral(this);">Expandir contenido</button>
	<div class="titulo"> 
    	Recuperar contraseña
	</div>
    <div class="recuperarContrasenia">
    	<div class="texto">
        	Ingrese su DNI o email con el que se registro
        </div>
        <div class="formulario">
            <form id="formularioRecuperarContrasenia" name="formularioRecuperarContrasenia" accept-charset="UTF-8" onsubmit="return false" action="#" method="POST" >
                <input type="text" name="dato" id="dato" /><br/>
                <button name="aceptarRecuperarCont" id="aceptarRecuperarCont">Enviar</button>
            </form>
			
		</div>
	
		<div id="respuesta" name="respuesta">
		
		</div>
    </div>
@stop

@section('extra_script')
<script type="text/javascript" src="js/efectos.js"></script>
<script type="text/javascript" src="js/jquery-2.0.2.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>

 <script type="text/javascript">
       (function() {
          $("#formularioRecuperarContrasenia").submit(function() {
             $.ajax({
                url: 'recuperarContrasenia',
                type: 'POST',
                data: {dato: $("#dato").val()},
                dataType: 'JSON',
                beforeSend: function() {
                   $("#respuesta").html('verificando usuario');
                },
                error: function() {
                   $("#respuesta").html('ha ocurrido un error intente nuevamente');
                },
                success: function(respuesta) {
                   if (respuesta) {
				      var html = respuesta.dato;
                      $("#respuesta").html(html);
                   } else {
                      $("#respuesta").html('no hubo respuesta servidor');
                   }
                }
             });
             $("#dato").val('');
          });
       }).call(this);
    </script>

@stop
