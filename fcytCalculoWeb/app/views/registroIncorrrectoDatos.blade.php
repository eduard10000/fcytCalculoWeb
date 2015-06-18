@extends('layouts.userNormal')

@section('content')
	<button onclick="fullCentral(this);">Expandir contenido</button>
	<div class="titulo"> 
    	Registro Correcto
	</div>
	<div class="registroCorrecto">
    	<div class="texto">
        Los datos no parecen ser los correctos <span style="color:#F00"> esta seguro usted lo que esta haciendo</span>
        </div>
        <div class="imagen">
        	<img src="img/registroCorrecto.png" alt="registro correcto">
        </div>
    </div>
@stop
@section('extra_script')
<script type="text/javascript" src="js/jquery-2.0.2.js"></script>
@stop