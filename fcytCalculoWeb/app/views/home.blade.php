@extends($layout)

@section('content')
	<button onclick="fullCentral(this);">Expandir contenido</button>
	<div class="titulo"> 
    	Inicio
	</div>
    <div class="inicioResenia">
    	<div class="inicioReseniaTexto">
    		Bienvenido a la plataforma virtual de Cálculo Diferencial e Integral, en la cual encontrará material relacionado a la cátedra. 
    	</div>
    	<div class="inicioReseniaImagen"></div>
   	</div>
@stop	

@section('extra_script')
<script type="text/javascript" src="js/jquery-2.0.2.js"></script>
@stop