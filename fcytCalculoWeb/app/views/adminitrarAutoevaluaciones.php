<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Administración de autoevaluaciones</title>
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
	<button name="" id="nuevAutoevaluacionBoton" onclick="mostrarOcultar('nuevAutoevaluacion');">Nueva Autoevaluación</button>
    <section id="nuevAutoevaluacion" class="oculto">
		<div>Nombre
    		<input type="text" id="NuevaAutoevaluacionNombre">
        </div>
        <div>Tema
    		<input class="margen" list="autoevalNuevalistaTemas">
            <datalist id="autoevalNuevalistaTemas">
  				<option value="tema1">---- sin tema ----</option>
              	<option value="tema2">---- tema2 ----</option>
              	<option value="tema3">---- tema3 ----</option>
			</datalist> 
        </div>
        <button name="" id="botonAgregarEjercicioAutoeval" onclick="mostrarOcultar('agregarEjercicioAutoeval');">Agregar ejercicio</button>
        <div id="agregarEjercicioAutoeval" class="oculto">
        <section>
   		    <div class="EjerciciosFiltrosOrden">
  				<div>
                	<span>Filtrar por:</span>
        			<input  list="EjercFiltrarlistaTemas">
        			<datalist id="EjercFiltrarlistaTemas">
        				<option value="tema1">---- tema1 ----</option>
            			<option value="tema2">---- tema2 ----</option>
            			<option value="tema3">---- tema3 ----</option>
        			</datalist>
   				 </div>
				<div>
                	<span>Ordenar por:</span>
                        <select id="EjercOrdenarlistaTemas">
                            <option value="tema">Tema</option>
                            <option value="creacion">Creación</option>
                            <option value="modificacion">Modificación</option>
                        </select>
                </div>
			</div>
    	</section>
        <section class="mostrarEjercAniadir">
        	<div class="ejerAniadir" id="idejerc1">
           		<img class="previsualizarEjercicio" src="../img/ejercicioPrevisualizacion.gif"></br>
                <div>
                	Tema: "tema2"
                </div>
                </br>
                <div>
                	Consigna:
                </div>
                <textarea rows="2" cols="20">Resuelva</textarea> <div class="izq">Soluciones erroneas</div>
                <input type="text" id="" value=""></br>
                <input type="text" id="" value=""></br>
                <input type="text" id="" value=""></br>
                            </br>    
           	<input id="autoevalEliminar" type="image" src="../img/x.png" alt="Eliminar" width="24" height="24">
			<input id="autoevalGuardar" type="image" src="../img/tilde.png" alt="Guardar" width="24" height="24">
 			</div>
        	<div class="ejerAniadir" id="idejerc2">
           		<img class="previsualizarEjercicio" src="../img/ejercicioPrevisualizacion.gif"></br>
                <div>
                	Tema: "tema2"
                </div>
                </br>
               	<div>
                	Consigna:
                </div>
                <textarea rows="2" cols="20">Resuelva</textarea> <div class="izq">Soluciones erroneas</div>
                <input type="text" id="" value=""></br>
                <input type="text" id="" value=""></br>
                <input type="text" id="" value=""></br>
                            </br>    
           	<input id="autoevalEliminar" type="image" src="../img/x.png" alt="Eliminar" width="24" height="24">
			<input id="autoevalGuardar" type="image" src="../img/tilde.png" alt="Guardar" width="24" height="24">
 			</div>
        	<div class="ejerAniadir" id="idejerc3">
           		<img class="previsualizarEjercicio" src="../img/ejercicioPrevisualizacion.gif"></br>
                <div>
                	Tema: "tema2"
                </div>
                </br>
                <div>
                	Consigna:
                </div>
                <textarea rows="2" cols="20">Resuelva</textarea> <div class="izq">Soluciones erroneas</div>
                <input type="text" id="" value=""></br>
                <input type="text" id="" value=""></br>
                <input type="text" id="" value=""></br>
                            </br>    
           	<input id="autoevalEliminar" type="image" src="../img/x.png" alt="Eliminar" width="24" height="24">
			<input id="autoevalGuardar" type="image" src="../img/tilde.png" alt="Guardar" width="24" height="24">
 			</div>           
        	<div class="ejerAniadir" id="idejerc4">
           		<img class="previsualizarEjercicio" src="../img/ejercicioPrevisualizacion.gif"></br>
                <div>
                	Tema: "tema2"
                </div>
                </br>
                <div>
                	Consigna:
                </div>
                <textarea rows="2" cols="20">Resuelva</textarea> <div class="izq">Soluciones erroneas</div>
                <input type="text" id="" value=""></br>
                <input type="text" id="" value=""></br>
                <input type="text" id="" value=""></br>
                            </br>    
           	<input id="autoevalEliminar" type="image" src="../img/x.png" alt="Eliminar" width="24" height="24">
			<input id="autoevalGuardar" type="image" src="../img/tilde.png" alt="Guardar" width="24" height="24">
 			</div>
        	<div class="ejerAniadir" id="idejerc5">
           		<img class="previsualizarEjercicio" src="../img/ejercicioPrevisualizacion.gif"></br>
                <div>
                	Tema: "tema2"
                </div>
                </br>
                <div>
                	Consigna:
                </div>
                <textarea rows="2" cols="20">Resuelva</textarea> <div class="izq">Soluciones erroneas</div>
                <input type="text" id="" value=""></br>
                <input type="text" id="" value=""></br>
                <input type="text" id="" value=""></br>
                            </br>    
           	<input id="autoevalEliminar" type="image" src="../img/x.png" alt="Eliminar" width="24" height="24">
			<input id="autoevalGuardar" type="image" src="../img/tilde.png" alt="Guardar" width="24" height="24">
 			</div>           


		</section>
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
<section class="contenedorAutoevaluaciones">
 	<section id="autoevaluacion1" class="autoevaluacion">
		<div class="autoevaluacionInf">
            <div>Nombre:</br>
                <input type="text" id="Autoevaluacion1Nombre" value="autoevaluacion 1">
            </div>
            <div>Tema: "tema 5"</br>
                <input list="autoevaListaTemas" value="---- tema1 ----" >
                <datalist id="autoevaListaTemas">
                    <option value="tema1">---- sin tema ----</option>
                    <option value="tema2">---- tema2 ----</option>
                    <option value="tema3">---- tema3 ----</option>
                </datalist> 
            </div>
            <button name="" id="autoevalInformacionBoton1" onclick="mostrarOcultar('autoevalInformacion1');">Información</button>
                <div id="autoevalInformacion1" class="oculto">
               		<div class="ejerciciosInformacionEstilo">
                        Creado por: </br>Apellido, Nombre.</br>
                        Fecha creación: </br>hh:mm dd/mm/aaaa.</br>
                        Modificado por: </br>Apellido, Nombre.</br>
                        Fecha modificacion: </br>hh:mm dd/mm/aaaa.</br>
                 	</div>
                </div>
            </br>    
           	<input id="autoevalEliminar" type="image" src="../img/x.png" alt="Eliminar" width="24" height="24">
			<input id="autoevalGuardar" type="image" src="../img/tilde.png" alt="Guardar" width="24" height="24">
        </div>
       <div class="autoevaluacionEjerc">
        	<div id="autoeval1Eejerc1" class="ejerc">
           		<img class="previsualizarEjercicio" src="../img/ejercicioPrevisualizacion.gif"></br>
            	<div>
                	Tema: "tema2"
                </div>
                </br>
                <div>
                	Consigna:
                </div>
                <textarea rows="2" cols="20">Resuelva</textarea> <div class="izq">
                	Soluciones erroneas
                </div>
                <input type="text" id="" value=""></br>
                <input type="text" id="" value=""></br>
                <input type="text" id="" value=""></br>
                            </br>    
           	<input id="autoevalEliminar" type="image" src="../img/x.png" alt="Eliminar" width="24" height="24">
			<input id="autoevalGuardar" type="image" src="../img/tilde.png" alt="Guardar" width="24" height="24">
 			</div>
            <div id="autoeval1Eejerc2" class="ejerc">
           		<img class="previsualizarEjercicio" src="../img/ejercicioPrevisualizacion.gif"></br>
                <div>
                	Tema: "tema2"
                </div>
                </br>
                <div>
                	Consigna:
                </div>
                <textarea rows="2" cols="20">Resuelva</textarea> <div class="izq">
                	Soluciones erroneas
                </div>
                <input type="text" id="" value=""></br>
                <input type="text" id="" value=""></br>
                <input type="text" id="" value=""></br>
                            </br>    
           	<input id="autoevalEliminar" type="image" src="../img/x.png" alt="Eliminar" width="24" height="24">
			<input id="autoevalGuardar" type="image" src="../img/tilde.png" alt="Guardar" width="24" height="24">
 			</div>
            <div id="autoeval1Eejerc3" class="ejerc">
           		<img class="previsualizarEjercicio" src="../img/ejercicioPrevisualizacion.gif"></br>
                <div>
                	Tema: "tema2"
                </div>
                </br>
                <div>
                	Consigna:
                </div>
                <textarea rows="2" cols="20">Resuelva</textarea> <div class="izq">
                	Soluciones erroneas
                </div>
                <input type="text" id="" value=""></br>
                <input type="text" id="" value=""></br>
                <input type="text" id="" value=""></br>
                            </br>    
           	<input id="autoevalEliminar" type="image" src="../img/x.png" alt="Eliminar" width="24" height="24">
			<input id="autoevalGuardar" type="image" src="../img/tilde.png" alt="Guardar" width="24" height="24">
 			</div>
            <div id="autoeval1Eejerc4" class="ejerc">
           		<img class="previsualizarEjercicio" src="../img/ejercicioPrevisualizacion.gif"></br>
                <div>
                	Tema: "tema2"
                </div>
                </br>
                <div>
                	Consigna:
                </div>
                <textarea rows="2" cols="20">Resuelva</textarea> <div class="izq">
                	Soluciones erroneas
                </div>
                <input type="text" id="" value=""></br>
                <input type="text" id="" value=""></br>
                <input type="text" id="" value=""></br>
                            </br>    
           	<input id="autoevalEliminar" type="image" src="../img/x.png" alt="Eliminar" width="24" height="24">
			<input id="autoevalGuardar" type="image" src="../img/tilde.png" alt="Guardar" width="24" height="24">
 			</div>
            <div id="autoeval1Eejerc5" class="ejerc">
           		<img class="previsualizarEjercicio" src="../img/ejercicioPrevisualizacion.gif"></br>
                <div>
                	Tema: "tema2"
                </div>
                </br>
               	<div>
                	Consigna:
                </div>
                <textarea rows="2" cols="20">Resuelva</textarea> <div class="izq">
                	Soluciones erroneas
                </div>
                <input type="text" id="" value=""></br>
                <input type="text" id="" value=""></br>
                <input type="text" id="" value=""></br>
                            </br>    
           	<input id="autoevalEliminar" type="image" src="../img/x.png" alt="Eliminar" width="24" height="24">
			<input id="autoevalGuardar" type="image" src="../img/tilde.png" alt="Guardar" width="24" height="24">
 			</div>
    	</div>
	</section>
 	<section id="autoevaluacion2" class="autoevaluacion">
		<div class="autoevaluacionInf">
            <div>Nombre:</br>
                <input type="text" id="Autoevaluacion1Nombre" value="autoevaluacion 2">
            </div>
            <div>Tema:</br>
                <input list="autoevaListaTemas"  value="sin tema">
                <datalist id="autoevaListaTemas">
                    <option value="tema1">---- sin tema ----</option>
                    <option value="tema2">---- tema2 ----</option>
                    <option value="tema3">---- tema3 ----</option>
                </datalist> 
            </div>
            <button name="" id="autoevalInformacionBoton2" onclick="mostrarOcultar('autoevalInformacion2');">Información</button>
                <div id="autoevalInformacion2" class="oculto">
               		<div class="ejerciciosInformacionEstilo">
                        Creado por: </br>Apellido, Nombre.</br>
                        Fecha creación: </br>hh:mm dd/mm/aaaa.</br>
                        Modificado por: </br>Apellido, Nombre.</br>
                        Fecha modificacion: </br>hh:mm dd/mm/aaaa.</br>
                 	</div>
                </div>
  			 </br>    
           	<input id="autoevalEliminar" type="image" src="../img/x.png" alt="Eliminar" width="24" height="24">
			<input id="autoevalGuardar" type="image" src="../img/tilde.png" alt="Guardar" width="24" height="24">     
        </div>
       <div class="autoevaluacionEjerc">
        	<div id="autoeval1Eejerc1" class="ejerc">
           		<img class="previsualizarEjercicio" src="../img/ejercicioPrevisualizacion.gif"></br>
            	<div>
                	Tema: "tema2"
                </div>
                </br>
                <div>
                	Consigna:
                </div>
                <textarea rows="2" cols="20">Resuelva</textarea> <div class="izq">
                	Soluciones erroneas
                </div>
                <input type="text" id="" value=""></br>
                <input type="text" id="" value=""></br>
                <input type="text" id="" value=""></br>
                            </br>    
           	<input id="autoevalEliminar" type="image" src="../img/x.png" alt="Eliminar" width="24" height="24">
			<input id="autoevalGuardar" type="image" src="../img/tilde.png" alt="Guardar" width="24" height="24">
 			</div>
            <div id="autoeval1Eejerc2" class="ejerc">
           		<img class="previsualizarEjercicio" src="../img/ejercicioPrevisualizacion.gif"></br>
                <div>
                	Tema: "tema2"
                </div>
                </br>
                <div>
                	Consigna:
                </div>
                <textarea rows="2" cols="20">Resuelva</textarea> <div class="izq">
                	Soluciones erroneas
                </div>
                <input type="text" id="" value=""></br>
                <input type="text" id="" value=""></br>
                <input type="text" id="" value=""></br>
                            </br>    
           	<input id="autoevalEliminar" type="image" src="../img/x.png" alt="Eliminar" width="24" height="24">
			<input id="autoevalGuardar" type="image" src="../img/tilde.png" alt="Guardar" width="24" height="24">
 			</div>
            <div id="autoeval1Eejerc3" class="ejerc">
           		<img class="previsualizarEjercicio" src="../img/ejercicioPrevisualizacion.gif"></br>
                <div>
                	Tema: "tema2"
                </div>
                </br>
                <div>
                	Consigna:
                </div>
                <textarea rows="2" cols="20">Resuelva</textarea> <div class="izq">
                	Soluciones erroneas
                </div>
                <input type="text" id="" value=""></br>
                <input type="text" id="" value=""></br>
                <input type="text" id="" value=""></br>
                            </br>    
           	<input id="autoevalEliminar" type="image" src="../img/x.png" alt="Eliminar" width="24" height="24">
			<input id="autoevalGuardar" type="image" src="../img/tilde.png" alt="Guardar" width="24" height="24">
 			</div>
            <div id="autoeval1Eejerc4" class="ejerc">
           		<img class="previsualizarEjercicio" src="../img/ejercicioPrevisualizacion.gif"></br>
                <div>
                	Tema: "tema2"
                </div>
                </br>
                <div>
                	Consigna:
                </div>
                <textarea rows="2" cols="20">Resuelva</textarea> <div class="izq">
                	Soluciones erroneas
                </div>
                <input type="text" id="" value=""></br>
                <input type="text" id="" value=""></br>
                <input type="text" id="" value=""></br>
                            </br>    
           	<input id="autoevalEliminar" type="image" src="../img/x.png" alt="Eliminar" width="24" height="24">
			<input id="autoevalGuardar" type="image" src="../img/tilde.png" alt="Guardar" width="24" height="24">
 			</div>
            <div id="autoeval1Eejerc5" class="ejerc">
           		<img class="previsualizarEjercicio" src="../img/ejercicioPrevisualizacion.gif"></br>
                <div>
                	Tema: "tema2"
                </div>
                </br>
                <div>
                	Consigna:
                </div>
                <textarea rows="2" cols="20">Resuelva</textarea> <div class="izq">
                	Soluciones erroneas
                </div>
                <input type="text" id="" value=""></br>
                <input type="text" id="" value=""></br>
                <input type="text" id="" value=""></br>
                            </br>    
           	<input id="autoevalEliminar" type="image" src="../img/x.png" alt="Eliminar" width="24" height="24">
			<input id="autoevalGuardar" type="image" src="../img/tilde.png" alt="Guardar" width="24" height="24">
 			</div>
            <div id="autoeval1Eejerc5" class="ejerc">
           		<img class="previsualizarEjercicio" src="../img/ejercicioPrevisualizacion.gif"></br>
                <div>
                	Tema: "tema2"
                </div>
                </br>
                <div>
                	Consigna:
                </div>
                <textarea rows="2" cols="20">Resuelva</textarea> <div class="izq">
                	Soluciones erroneas
                </div>
                <input type="text" id="" value=""></br>
                <input type="text" id="" value=""></br>
                <input type="text" id="" value=""></br>
                            </br>    
           	<input id="autoevalEliminar" type="image" src="../img/x.png" alt="Eliminar" width="24" height="24">
			<input id="autoevalGuardar" type="image" src="../img/tilde.png" alt="Guardar" width="24" height="24">
 			</div>
            <div id="autoeval1Eejerc5" class="ejerc">
           		<img class="previsualizarEjercicio" src="../img/ejercicioPrevisualizacion.gif"></br>
                <div>
                	Tema: "tema2"
                </div>
                </br>
                <div>
                	Consigna:
                </div>
                <textarea rows="2" cols="20">Resuelva</textarea> <div class="izq">
                	Soluciones erroneas
                </div>
                <input type="text" id="" value=""></br>
                <input type="text" id="" value=""></br>
                <input type="text" id="" value=""></br>
                            </br>    
           	<input id="autoevalEliminar" type="image" src="../img/x.png" alt="Eliminar" width="24" height="24">
			<input id="autoevalGuardar" type="image" src="../img/tilde.png" alt="Guardar" width="24" height="24">
 			</div>
    	</div>
	</section>
</section>
</body>
</html>
