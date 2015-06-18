@extends('layouts.Profesor')

@section('content')
	<button onclick="fullCentral(this);">Expandir contenido</button>
	<div class="titulo"> 
    	Enciar un mensaje
	</div>
    <div class="registro">
        <div class="formularioRegistro">
            <form id="EnviarMensaje" method="post" action="enviarMensajeAlumnos"  enctype="multipart/form-data" accept-charset="utf-8">
                <div>Titulo</div>
                <input id="titulo" value="" name="titulo" title="titulo"><br/>
                <div>Contenido</div>
                <input id="contenido" value="" name="contenido" title="contenido"><br/>
                <input id="Aceptar_r" type="submit" name="bt_enviar" value="Registrarse">
            </form>
        </div>
	</div>

@stop

@section('extra_script')
<script type="text/javascript" src="js/efectos.js"></script>
<script type="text/javascript" src="js/upload.js"></script>
<script type="text/javascript" src="js/jquery-2.0.2.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>

<!--script para la fecha de nacimiento -->
<script src="js/ui.datepicker-es.js"></script>

@stop
