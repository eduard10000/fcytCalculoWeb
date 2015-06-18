<!DOCTYPE html>
<html>
    <head>
        <title> Subida y precarga ajax </title>
        <script src="js/jquery-2.0.2.js"></script>
        <script src="js/upload.js"></script>
        <script type="text/javascript">
            function subirArchivos() {
                $("#archivo").upload('subir_archivo.php',
                {
                    nombre_archivo: $("#nombre_archivo").val()
                },
                function(respuesta) { //si es 1 el archivo se subio y se movio a una carpeta temporal
                    //Subida finalizada.
                    cambiarImagen(respuesta);
					
                });
            }
            $(document).ready(function() {
                $("#boton_subir").on('click', function() {
                subirArchivos();
                });
            });
			function cambiarImagen(nombre)
			{
				document.getElementById("previsualizar").src="archivos_subidos/"+nombre;
			}
        </script>
    </head>
    <body>
        <div class="container">
            <h1> Subida y precarga ajax  </h1>
            <div id="respuesta" class="alert"></div>
            <form action="javascript:void(0);">
                <div class="row">
                    <div class="col-lg-2"> 
                        <label> Nombre el archivo: </label> 
                    </div>
                    <div class="col-lg-2">
                        <input type="text" name="nombre_archivo" id="nombre_archivo" />
                    </div>
                    <div class="col-lg-2">
                        <input type="file" name="archivo" id="archivo" />
                    </div>                    
                </div>
                <hr />
                <div class="row">
                    <div class="col-lg-2">
                        <input type="submit" id="boton_subir" value="Subir" class="btn btn-success" />
                    </div>

                </div>
            </form>
            <hr />
           
			 <img id="previsualizar" src="prev.png">
        </div>
    </body>
</html>