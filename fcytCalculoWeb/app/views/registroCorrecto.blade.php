@extends('layouts.userNormal')

@section('content')
	<button onclick="fullCentral(this);">Expandir contenido</button>
	<div class="titulo"> 
    	Registro Correcto
	</div>
	<div class="registroCorrecto">
    	<div class="texto">
        Su registro se ha procesado satisfactoriamente, en breve el administrador lo dará de alta en el sistema.
        </div>
        <div class="imagen">
        	<img src="img/registroCorrecto.png" alt="registro correcto">
        </div>
    </div>
@stop
@section('extra_script')
<script type="text/javascript" src="js/jquery-2.0.2.js"></script>
@stop