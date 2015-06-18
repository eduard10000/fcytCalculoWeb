<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Administración de ejercicios</title>
<link rel="stylesheet" media="screen" href="../css/estilos2.css">
<script type="text/javascript">
function mostrarOcultar(id)
{
	if(document.getElementById(id).style.display=="block")
		{
			document.getElementById(id).style.display="none";
		}
	else
		{
			document.getElementById(id).style.display="block";
		} 
}
</script>
</head>
<body>
<header>Administraci&oacute;n de ejercicios</header>
	<button name="" id="ejerciciosNuevoEjercicioBoton" onclick="mostrarOcultar('ejerciciosNuevoEjercicio');">Nuevo Ejercicio</button>
    <section id="ejerciciosNuevoEjercicio" class="oculto">
    <div>
    	<div class="nuevoEjercIzq">
            <input name="file" type="file" >
            <img class="previsualizarEjercicio" src="../img/ejercicioPrevisualizacion.gif">
        </div>
      	<div class="nuevoEjercDer">
       		<div class="izq">Solución
    		<input class="margen" type="text" id="NuevoEjercicioSolucion"></div>
            <div class="izq">Tema
    		<input class="margen" list="EjercNuevolistaTemas">
            <datalist id="EjercNuevolistaTemas">
  				<option value="tema1">---- tema1 ----</option>
              	<option value="tema2">---- tema2 ----</option>
              	<option value="tema3">---- tema3 ----</option>
			</datalist> </div>
        </div>
            <input id="EjercNuevoCancelar" type="button" value="Cancelar"> 
            <input id="EjercNuevoGuardar" type="submit" value="Guardar">
    </div>
</section>
<section>
   
    <div class="EjerciciosFiltrosOrden">
    <div><span>Filtrar por:</span>
        <input  list="EjercFiltrarlistaTemas">
        <datalist id="EjercFiltrarlistaTemas">
        	<option value="tema1">---- tema1 ----</option>
            <option value="tema2">---- tema2 ----</option>
            <option value="tema3">---- tema3 ----</option>
        </datalist>
    </div>
	<div><span>Ordenar por:</span>
        <select id="EjercOrdenarlistaTemas">
        	<option value="tema">Tema</option>
            <option value="creacion">Creación</option>
            <option value="modificacion">Modificación</option>
        </select></div>
	</div>
    </section>

        <section class="contenedorEjercicios">
        <div class="mostrarEjercicio" id="idejerc1">
           		<img class="previsualizarEjercicio" src="../img/ejercicioPrevisualizacion.gif"></br>
            	<button name="" id="ejerciciosInformacionBoton" onclick="mostrarOcultar('ejerciciosInformacionidejerc1');">Información</button>
                <div id="ejerciciosInformacionidejerc1" class="oculto">
               		<div class="ejerciciosInformacionEstilo">
                        Creado por: Apellido, Nombre.</br>
                        Fecha creación: hh:mm dd/mm/aaaa.</br>
                        Modificado por: Apellido, Nombre.</br>
                        Fecha modificacion: hh:mm dd/mm/aaaa.</br>
                 	</div>
                </div>
                <div class="izq">Solución</div>
                <input class="margen" type="text" id="NuevoEjercicioSolucion" value="40">
                <div class="izq">Tema</div>
                <input class="margen" list="EjercNuevolistaTemas" value="---- tema1 ----">
                <datalist id="EjercNuevolistaTemas">
                    <option value="tema1">---- tema1 ----</option>
                    <option value="tema2">---- tema2 ----</option>
                    <option value="tema3">---- tema3 ----</option>
                </datalist>
                </br> 
                <input id="ejercicioEliminar" type="image" src="../img/x.png" alt="Eliminar" width="24" height="24">
				<input id="ejercicioGuardar" type="image" src="../img/tilde.png" alt="Guardar" width="24" height="24">
        </div>

             <div class="mostrarEjercicio" id="idejerc2">
           		<img class="previsualizarEjercicio" src="../img/ejercicioPrevisualizacion.gif"></br>
            	<button name="" id="ejerciciosInformacionBoton" onclick="mostrarOcultar('ejerciciosInformacionidejerc2');">Información</button>
                <div id="ejerciciosInformacionidejerc2" class="oculto">
               		<div class="ejerciciosInformacionEstilo">
                        Creado por: Apellido, Nombre.</br>
                        Fecha creación: hh:mm dd/mm/aaaa.</br>
                        Modificado por: Apellido, Nombre.</br>
                        Fecha modificacion: hh:mm dd/mm/aaaa.</br>
                 	</div>
                </div>
                <div class="izq">Solución</div>
                <input class="margen" type="text" id="NuevoEjercicioSolucion" value="40">
                <div class="izq">Tema</div>
                <input class="margen" list="EjercNuevolistaTemas" value="---- tema1 ----">
                <datalist id="EjercNuevolistaTemas">
                    <option value="tema1">---- tema1 ----</option>
                    <option value="tema2">---- tema2 ----</option>
                    <option value="tema3">---- tema3 ----</option>
                </datalist>
                </br> 
                <input id="ejercicioEliminar" type="image" src="../img/x.png" alt="Eliminar" width="24" height="24">
				<input id="ejercicioGuardar" type="image" src="../img/tilde.png" alt="Guardar" width="24" height="24">
        </div>
        
                <div class="mostrarEjercicio" id="idejerc3">
           		<img class="previsualizarEjercicio" src="../img/ejercicioPrevisualizacion.gif"></br>
            	<button name="" id="ejerciciosInformacionBoton" onclick="mostrarOcultar('ejerciciosInformacionidejerc3');">Información</button>
                <div id="ejerciciosInformacionidejerc3" class="oculto">
               		<div class="ejerciciosInformacionEstilo">
                        Creado por: Apellido, Nombre.</br>
                        Fecha creación: hh:mm dd/mm/aaaa.</br>
                        Modificado por: Apellido, Nombre.</br>
                        Fecha modificacion: hh:mm dd/mm/aaaa.</br>
                 	</div>
                </div>
                <div class="izq">Solución</div>
                <input class="margen" type="text" id="NuevoEjercicioSolucion" value="40">
                <div class="izq">Tema</div>
                <input class="margen" list="EjercNuevolistaTemas" value="---- tema1 ----">
                <datalist id="EjercNuevolistaTemas">
                    <option value="tema1">---- tema1 ----</option>
                    <option value="tema2">---- tema2 ----</option>
                    <option value="tema3">---- tema3 ----</option>
                </datalist>
                </br> 
                <input id="ejercicioEliminar" type="image" src="../img/x.png" alt="Eliminar" width="24" height="24">
				<input id="ejercicioGuardar" type="image" src="../img/tilde.png" alt="Guardar" width="24" height="24">
        </div>
        
                <div class="mostrarEjercicio" id="idejerc4">
           		<img class="previsualizarEjercicio" src="../img/ejercicioPrevisualizacion.gif"></br>
            	<button name="" id="ejerciciosInformacionBoton" onclick="mostrarOcultar('ejerciciosInformacionidejerc4');">Información</button>
                <div id="ejerciciosInformacionidejerc4" class="oculto">
               		<div class="ejerciciosInformacionEstilo">
                        Creado por: Apellido, Nombre.</br>
                        Fecha creación: hh:mm dd/mm/aaaa.</br>
                        Modificado por: Apellido, Nombre.</br>
                        Fecha modificacion: hh:mm dd/mm/aaaa.</br>
                 	</div>
                </div>
                <div class="izq">Solución</div>
                <input class="margen" type="text" id="NuevoEjercicioSolucion" value="40">
                <div class="izq">Tema</div>
                <input class="margen" list="EjercNuevolistaTemas" value="---- tema1 ----">
                <datalist id="EjercNuevolistaTemas">
                    <option value="tema1">---- tema1 ----</option>
                    <option value="tema2">---- tema2 ----</option>
                    <option value="tema3">---- tema3 ----</option>
                </datalist>
                </br> 
                <input id="ejercicioEliminar" type="image" src="../img/x.png" alt="Eliminar" width="24" height="24">
				<input id="ejercicioGuardar" type="image" src="../img/tilde.png" alt="Guardar" width="24" height="24">
        </div>
        
                <div class="mostrarEjercicio" id="idejerc5">
           		<img class="previsualizarEjercicio" src="../img/ejercicioPrevisualizacion.gif"></br>
            	<button name="" id="ejerciciosInformacionBoton" onclick="mostrarOcultar('ejerciciosInformacionidejerc5');">Información</button>
                <div id="ejerciciosInformacionidejerc5" class="oculto">
               		<div class="ejerciciosInformacionEstilo">
                        Creado por: Apellido, Nombre.</br>
                        Fecha creación: hh:mm dd/mm/aaaa.</br>
                        Modificado por: Apellido, Nombre.</br>
                        Fecha modificacion: hh:mm dd/mm/aaaa.</br>
                 	</div>
                </div>
                <div class="izq">Solución</div>
                <input class="margen" type="text" id="NuevoEjercicioSolucion" value="40">
                <div class="izq">Tema</div>
                <input class="margen" list="EjercNuevolistaTemas" value="---- tema1 ----">
                <datalist id="EjercNuevolistaTemas">
                    <option value="tema1">---- tema1 ----</option>
                    <option value="tema2">---- tema2 ----</option>
                    <option value="tema3">---- tema3 ----</option>
                </datalist>
                </br> 
                <input id="ejercicioEliminar" type="image" src="../img/x.png" alt="Eliminar" width="24" height="24">
				<input id="ejercicioGuardar" type="image" src="../img/tilde.png" alt="Guardar" width="24" height="24">
        </div>
        
                <div class="mostrarEjercicio" id="idejerc6">
           		<img class="previsualizarEjercicio" src="../img/ejercicioPrevisualizacion.gif"></br>
            	<button name="" id="ejerciciosInformacionBoton" onclick="mostrarOcultar('ejerciciosInformacionidejerc6');">Información</button>
                <div id="ejerciciosInformacionidejerc6" class="oculto">
               		<div class="ejerciciosInformacionEstilo">
                        Creado por: Apellido, Nombre.</br>
                        Fecha creación: hh:mm dd/mm/aaaa.</br>
                        Modificado por: Apellido, Nombre.</br>
                        Fecha modificacion: hh:mm dd/mm/aaaa.</br>
                 	</div>
                </div>
                <div class="izq">Solución</div>
                <input class="margen" type="text" id="NuevoEjercicioSolucion" value="40">
                <div class="izq">Tema</div>
                <input class="margen" list="EjercNuevolistaTemas" value="---- tema1 ----">
                <datalist id="EjercNuevolistaTemas">
                    <option value="tema1">---- tema1 ----</option>
                    <option value="tema2">---- tema2 ----</option>
                    <option value="tema3">---- tema3 ----</option>
                </datalist>
                </br> 
                <input id="ejercicioEliminar" type="image" src="../img/x.png" alt="Eliminar" width="24" height="24">
				<input id="ejercicioGuardar" type="image" src="../img/tilde.png" alt="Guardar" width="24" height="24">
        </div>

        
    </div> 	
</section>
</body>
</html>
