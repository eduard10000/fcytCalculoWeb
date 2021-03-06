<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Plataforma virtual de CDeI - Inicio</title>
<link rel="stylesheet" media="screen" href="css/estilos.css">
<link rel="stylesheet" media="screen" href="css/jquery-ui.css" >
</head>
<body>
<div id="headerAdjust"></div>
<header>
</header>

<aside id="menuIzq">
	<div class="menuIzqOpciones">
    	<div>
        	<img src="img/<?php if($seleccionado==1) echo 'circuloverde.png"'; else echo 'circulocolor.png"'; ?>  alt="activado">
        	<a href="inicio"> Inicio</a>
        </div>
    	<div>
        	<img src="img/<?php if($seleccionado==2) echo 'circuloverde.png"'; else echo 'circulocolor.png"'; ?>  alt="activado">
        	<a href="enviarMensaje">Enviar Mensaje</a>
        </div>
    	<div>
        	<img src="img/<?php if($seleccionado==3) echo 'circuloverde.png"'; else echo 'circulocolor.png"'; ?>  alt="activado">
        	<a href="usuariosNuevos">Usuarios Nuevos</a>
        </div>			
    	<div>
        	<img src="img/<?php if($seleccionado==4) echo 'circuloverde.png"'; else echo 'circulocolor.png"'; ?>  alt="activado">
        	<a href="temas"> Temas</a>
        </div>
    	<div>
        	<img src="img/<?php if($seleccionado==5) echo 'circuloverde.png"'; else echo 'circulocolor.png"'; ?>  alt="activado">
        	<a href="ejercicios.html"> Ejercicios</a>
        </div>
    	<div>
        	<img src="img/<?php if($seleccionado==6) echo 'circuloverde.png"'; else echo 'circulocolor.png"'; ?>  alt="activado">
        	<a href="autoevaluaciones.html"> Autoevaluaciones</a>
        </div>
    </div>
	<div class="menuIzqOpcionesAdm">Administración</div>
	<div class="menuIzqOpciones">
    	<div>
        	<img src="img/<?php if($seleccionado==7) echo 'circuloverde.png"'; else echo 'circulocolor.png"'; ?>  alt="activado">
        	<a href="administrarUsuarios">Usuarios</a>
        </div>			
    	<div>
        	<img src="img/<?php if($seleccionado==8) echo 'circuloverde.png"'; else echo 'circulocolor.png"'; ?>  alt="activado">
        	<a href="administrarTemas"> Temas</a>
        </div>
    	<div>
        	<img src="img/<?php if($seleccionado==9) echo 'circuloverde.png"'; else echo 'circulocolor.png"'; ?>  alt="activado">
        	<a href="admEjercicios.html"> Ejercicios</a>
        </div>
    	<div>
        	<img src="img/<?php if($seleccionado==10) echo 'circuloverde.png"'; else echo 'circulocolor.png"'; ?>  alt="activado">
        	<a href="admAutoevaluaciones.html"> Autoevaluaciones</a>
        </div>
    	<div>
        	<img src="img/<?php if($seleccionado==11) echo 'circuloverde.png"'; else echo 'circulocolor.png"'; ?>  alt="activado">
        	<a href="moduloTrabajando"> Eventos</a>
        </div>
		<div>
        	<img src="img/<?php if($seleccionado==12) echo 'circuloverde.png"'; else echo 'circulocolor.png"'; ?>  alt="activado">
        	<a href="moduloTrabajando"> Estadisticas</a>
        </div>
    	<div>
        	<img src="img/<?php if($seleccionado==13) echo 'circuloverde.png"'; else echo 'circulocolor.png"'; ?>  alt="activado">
        	<a href="moduloTrabajando"> Reiniciar Año</a>
        </div>
		<div>
        	<img src="img/<?php if($seleccionado==14) echo 'circuloverde.png"'; else echo 'circulocolor.png"'; ?>  alt="activado">
        	<a href="moduloTrabajando"> BackUp</a>
        </div>
    </div>
</aside>

<section id="central">
	@yield('content')
</section>

<aside id="menuDer">
	<div id="infUsuario">
		<div id="cerrarSesion">
			<form name="input" action="cerrar_session" method="get">
				<button name="cerrar session" type="submit" >Cerrar sesion</button>
			</form>	
		</div>
		<img id="imgPerfil" src="img/imagenDefault.jpg" alt="">
        <div class="apellido">
        	<a id="apeNom" href="perfil">Apellido, Nombre</a>
        </div>
	</div>
	<div>
		<a id="usuariosNuevos" href="usuariosNuevos.html" class="menuusuariosnuevos">Existen usuarios Nuevos</a>
    </div>
	<div id="calendario"></div>
	<div id="infEvento">informacion de evento c</div>
	<div id="ultUsuariosCon">Ultimos usuarios conectados</div>
	<div id="ultUsuariosConLista">
		Apellido,Nombre<br/>
		Apellido,Nombre<br/>
		Apellido,Nombre<br/>
		Apellido,Nombre<br/>
		Apellido,Nombre<br/>
		Apellido,Nombre<br/>
		Apellido,Nombre<br/>
		Apellido,Nombre<br/>
		Apellido,Nombre<br/>
		Apellido,Nombre<br/>
	</div>

</aside>


<footer>
</footer>

</body>

<script type="text/javascript" src="js/efectos.js"></script>
<script type="text/javascript" src="js/jquery-2.0.2.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/ui.datepicker-es.js"></script>
@yield('extra_script')
 <script>
$(function() {
$( "#calendario" ).datepicker();
});
</script>
</html>
