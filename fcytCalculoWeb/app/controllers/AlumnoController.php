<?php

class AlumnoController extends BaseController {
	
	protected $layoutPropio= null;
	
	private  $dni = null;
	private  $contrasenia = null;
	private  $correo = null;
	private  $rutaImg = null;
	private  $apellido = null;
	private  $nombre = null;
	
	public function __construct()
	{
		$this->layoutPropio = 'layouts.alumno';
	}

public function get_id()
{
	return 1;
}

	
public function  generar_home()
{
	//echo $this->layoutPropio;
	return View::make("home",array('layout'=>$this->layoutPropio,'seleccionado' => '1'));
}
	
//---------------------------- validaciones --------------------------------------------//
public function validacion($campo,$tipo) // devuelve 1 si esta bien y -1 si dio error
{
	switch($tipo)
	{
		case "dni":
			if( $this->validar($campo,'0123456789') && strlen($campo)== 8 )
  				return 1;
			else
				return -1;
		break;
		case "contrasenia":
			if(($this->validar($campo,'abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ-_0123456789.') and strlen($campo)>=6 ) )
  				return 1;
			else
				return -1;
		break;
		case "correo":
			if($this->validar($campo,'abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ-_@0123456789.')and strlen($campo)>=6 and $this->validar('@',$campo) and $this->validar('.',$campo))
  				return 1;
			else
				return -1;
		break;
		case "descripcion":
			if($this->validar($campo,'abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ-_@0123456789. ') and strlen($campo)>=5)
  				return 1;
			else
				return -1;
		break;
		case "nombre":
			if($this->validar($campo,'abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ ')and strlen($campo)>=3)
  				return 1;
			else
				return -1;
		break;
		case "fecha":		
			list($anyo,$mes,$dia) = explode("/",$campo);
			if(checkdate($mes,$dia,$anyo) and strlen($campo)==10)
  				return 1;
			else
				return -1;
		break;
		case "imagen":
			if($campo['size']<=2500000) //esta en bytes creo aprox 2.5 MB seria
			{
				$extension = array('.gif','.png','.jpg','.jpeg','.bmp');
				$extArchivo = strstr($campo['name'], '.');
				foreach ($extension as $ext)
				{	
					if($extArchivo == $ext)
					{
						return 1;
					}
				}
				return -1;
			}
			else
				return -1;
		break;
	}
}

private function validar($campo,$caracteresPermitidos)
{
	for ($i=0;$i<strlen($campo);$i++)
	{
		if(!(strstr($caracteresPermitidos,$campo[$i])))
		{
		return false;
		}	
	}
	return true;
}

public function actualizar_perfil($usuario,$contrasenia,$correo,$apellido,$nombre,$fechaNac,$imagen)
{

	// recontruido en json
	$errores='';
	if($this->validacion($usuario,'dni')!=1)
		$errores.='UsuarioInvalido+';
	if($contrasenia!="" && $this->validacion($contrasenia,'contrasenia')!=-1)	// significa que no va a cambiar
	{
		$errores.= 'contraseniaInvalida<br />';
	}
	if($this->validacion($correo,'correo')!=1)
		$errores.= 'CorreoInvalido<br />';
	if($this->validacion($nombre,'nombre')!=1)
		$errores.= 'NombreInvalido<br />';
	if($this->validacion($apellido,'nombre')!=1)
		$errores.= 'ApellidoInvalido<br />';
	if($this->validacion($fechaNac,'fecha')!=1)
		$errores.= 'FechaInvalida<br />';
	$fecha_actual=date("Y-m-d H:i:s");	//fecha y hora actual
	
	$persona=Persona::where('dni','=',$usuario)->first();
	

	
	if($persona==NUll)
	{
	//	return View::make("registroIncorrrectoUsuario",array('seleccionado' => '3'));
	return "el ".$usuario." no existe";
	}	
	
	if($persona!='')
	{
	

	
	// save to our database
		//$Persona->dni=$usuario;
		$persona->contrasenia=$contrasenia;
		$persona->apellido=$apellido;
		$persona->nombre=$nombre;
		$persona->fechaNacimiento=$fechaNac;
		$persona->email=$correo;
		$persona->fechaRegistro=$fecha_actual;
		//$Persona->fechaAlta='2000-01-01 01:01:01';
		$persona->idPerfil='0';
		// mirar lo de la imagen 
		$persona->imagen='';
		
	
		if($persona->save()){ 
			return "actualizacion completa";
		} else{ // el usuario no existe
			return "error en la actualizacion";
		}
		
	}
	else
	{
		// alguno de los campos posee problema de validacion
			return "errores en los datos no validos";
	}
}

//temas
public function getListaTemasItems()
{
	//consulto por una lista de temas
	$listaTemasC=DB::table('tema')->select('idTema','contenido')->where('idTema','>',0)->orderBy('orden', 'asc')->get();
	//armo un array de la lista de temas
	for ($i=0;$i<count($listaTemasC); $i++)
	{
		$temas[]=array(
						"idTema" => $listaTemasC[$i]->idTema,
						"contenido" => $listaTemasC[$i]->contenido
					);
	}
	//hago una consulta de los items
	$itemsC=DB::table('item')->select('idItem','idTema','nombreItem')->where('idTema','>',0)->where('idABM','>',0)->orderBy('orden', 'asc')->get();
	for ($i=0;$i<count($itemsC); $i++)
	{
		$items[]=array(
						"idItem" => $itemsC[$i]->idItem,
						"idTema"=>$itemsC[$i]->idTema,
						"nombreItem" => $itemsC[$i]->nombreItem,
					);
	}
	//asignar items a temas
	for ($i=0;$i<count($items); $i++)
	{
		for ($j=1;$j<count($temas); $j++) 
		{
			if 	($items[$i]['idTema'] == $temas[$j]['idTema'])
			{
				$temas[$j]['items'][]=$items[$i];
			}
		}
	}//fin de ciclo iterativo	for ($i=0;$i<count($items); $i++)
	
	return $temas;	

}

public function getContentItem($idItem)
{
	//consulto por una lista si el item existe
	// consulta
	// sino devolver que no existe
	// si hay error en el archivo surgio un problema en el sistema reliacionado con el archivo
	// devolver resultado satisfactorio
	// devolver la partes del descartes importante
	
	
	
	$ConsultaItems=DB::table('item')->select("idItem","rutaItem")->where('idItem','=',$idItem)->orderBy('orden', 'asc')->get();
	
	if(isset($ConsultaItems) && $ConsultaItems!=NULL)
	{
		$archivo=$ConsultaItems[0]->rutaItem; // primer elemento la ruta
		$ruta="items".DIRECTORY_SEPARATOR.$archivo; 
		if(file_exists($ruta)) // si el archivo existe
		{
			
			// posiblemente halla que pasarlo a la base de datos
			
			$archivo=fopen($ruta,"r");	
			$mostrar='';
			 while(!feof($archivo)) {
				$linea = fgets($archivo);
				$mostrar.=$linea;
				
				}
			fclose($archivo);
	
		return $mostrar;
			
		}
		else
		{
			return "el archivo no pudo ser encontrado";
		}
		
		
	}
	else 
	{
			Return "error no existe en la base de datos";
	}
	

	return $item;
	

}

}
?>