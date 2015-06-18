<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Plataforma virtual de CDeI - Inicio</title>
<link rel="stylesheet" media="screen" href="../css/estilos.css">
<link rel="stylesheet" media="screen" href="../css/jquery-ui.css" >
</head>
<body>
<div id="headerAdjust"></div>
<header>
</header>

<aside id="menuIzq">
	<div class="menuIzqOpciones">
    	<div>
        	<img src="../img/circuloverde.png" alt="activado">
        	<a href="inicio.html"> Inicio</a>
        </div>
    	<div>
        	<img src="../img/circulocolor.png" alt="desactivado">
        	<a href="temas.html"> Temas</a>
        </div>
    	<div>
        	<img src="../img/circulocolor.png" alt="desactivado">
        	<a href="ejercicios.html"> Ejercicios</a>
        </div>
    	<div>
        	<img src="../img/circulocolor.png" alt="desactivado">
        	<a href="autoevaluaciones.html"> Autoevaluaciones</a>
        </div>
    </div>
</aside>

<section id="central">
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
</section>

<aside id="menuDer">
	<div id="infUsuario">
		<div id="cerrarSesion">
		
		<form name="input" action="cerrar_session" method="get">
			<button name="cerrar session" type="submit" >Cerrar sesion</button>
		</form>	
		</div>
		<img id="imgPerfil" src="../img/imagenDefault.jpg" alt="">
        <div class="apellido">
        	<a id="apeNom" href="perfil.html">Apellido, Nombre</a>
        </div>
	</div>
	<div id="calendario"></div>
	<div id="infEvento">informacion de evento c</div>


</aside>


<footer>
</footer>

</body>
<script type="text/javascript" src="../js/efectos.js"></script>
<script type="text/javascript" src="../js/jquery-2.0.2.js"></script>
<script type="text/javascript" src="../js/jquery-ui.js"></script>
<script type="text/javascript" src="../js/ui.datepicker-es.js"></script>
 <script>
$(function() {
$( "#calendario" ).datepicker();
});
</script>
</html>
