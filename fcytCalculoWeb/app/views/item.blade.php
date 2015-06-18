@extends($layout)

@section('content')
	

<section id="central">
	<button onclick="fullCentral(this);">Expandir contenido</button>
	<div class="titulo"> 
    	Crear Item
	</div>

<div class="crearTema">

<br/>
<div id="dragandrophandler">Arrastre y suelte su archivo aquí</div>
<br><br>
<div id="status1"></div>

<form id="" method="post" action=""  enctype="multipart/form-data" accept-charset="utf-8">
	<div>Nombre Item</div>
	<input id="nombreItem" value="" type="text" name="nombreItem" required><br/>
	<div>Tema</div>
     <select id="tema" value="tema" type="text" name="tema" required>
  		<option value="tema1">tema 1</option>
  		<option value="tema2">tema 2</option>
  		<option value="nuevoTema">Tema nuevo</option>
	</select> <br/>
    <div class="crearNuevoTema">
    	<div>Nombre de item nuevo</div>
		<input id="nombreNuevoItem" value="nombreNuevoItem" type="text" name="nombreNuevoItem"><br/>
	</div><br/>
    <input id="Aceptar_c" type="submit" name="bt_enviar" value="Crear Item">
</form>






</div>

</section>
@stop

@section('extra_script')



<script type="text/javascript" src="js/efectos.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/ui.datepicker-es.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript" language="javascript" src="js/crearItem.js"></script>
<script>
$(function() {
$( "#calendario" ).datepicker();
});
</script> 
@stop
