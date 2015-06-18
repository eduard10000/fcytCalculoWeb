<?php
use Mailgun\Mailgun; // usa librerias mailgun

class UserNormalController extends BaseController {

public function  generar_home()
{
	return View::make("home",array('layout'=>'layouts.userNormal','seleccionado' => '1'));
}

private function validacion($campo,$tipo) // devuelve 1 si esta bien y -1 si dio error
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
			if($campo['size']>=2500000) //esta en bytes creo aprox 2.5 MB seria
			{
				$extension = array('.gif','.png','.jpg','.jpeg','.bmp');
				for($i=0;$i<strlen($extension);$i++)
				{
					$ext = strstr($campo['name'], '.');
					if($ext ==$extension[i])
						return 1;
					else
						return -1;
				}
			}
			else
				return -1;
		break;
	}
}
	//
	// esta funcion es llamada por validacion
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
	
// ingresar

public function ingresar($usuario,$contrasenia)
{ 	
	if($this->validacion($usuario,'dni')!=1 && $this->validacion($contrasenia,'contrasenia')!=1) 
		return Response::json(array("mensaje" => "usuario o contraseña invalida","recargar" => "false", ));
		
	// llama al modelo y consulta
	$persona=Persona::where('dni','=',$usuario)->where('contrasenia','=',$contrasenia)->first();
		
	if($persona!=NULL)	
	{
		// graba el acceso del usuario 
		$acceso= new Acceso();
		$acceso->dni=$usuario;
		$acceso->fecha=date("Y-m-d H:i:s");
		$acceso->save();
		
		if($persona->idPerfil > 0)
		{
			Session::put('idPerfil', $persona->idPerfil );
			Session::put('dni', $persona->dni );
			return Response::json(array("mensaje" => "el usuario:".$persona->dni." ha accedido satisfactoriamente","recargar" => "true" ));
		}
		else
			return Response::json(array("mensaje" => "el usuario:".$persona->dni." no ha sido habilitado aun","recargar" => "false"));
	}
	else
		return Response::json(array("mensaje" => "usuario o clave incorrecto","recargar" => "false" ));
		
		
		
		/*

	{

		return array($obtener_datos->idPerfil,$obtener_datos->dni);
	}

	*/
}

  	
public function registrarse($usuario,$contrasenia,$correo,$apellido,$nombre,$fechaNac,$imagen)
{
	
	// recontruido en json
	$errores='';
	if($this->validacion($usuario,'dni')!=1)
		$errores.='UsuarioInvalido+';
	if($this->validacion($contrasenia,'contrasenia')!=1)
		$errores.= 'contraseniaInvalida<br />';
	if($this->validacion($correo,'correo')!=1)
		$errores.= 'CorreoInvalido<br />';
	if($this->validacion($nombre,'nombre')!=1)
		$errores.= 'NombreInvalido<br />';
	if($this->validacion($apellido,'nombre')!=1)
		$errores.= 'ApellidoInvalido<br />';
	if($this->validacion($fechaNac,'fecha')!=1)
		$errores.= 'FechaInvalida<br />';
	$fecha_actual=date("Y-m-d H:i:s");	//fecha y hora actual
	
	$consulta=Persona::where('dni','=',$usuario)->first();
	
	if($consulta!=NUll)
	{
		return View::make("registroIncorrrectoUsuario",array('seleccionado' => '3'));
	}	
	
	if($errores!='')
	{
		$Persona= new Persona();
		$Persona->dni=$usuario;
		$Persona->contrasenia=$contrasenia;
		$Persona->apellido=$apellido;
		$Persona->nombre=$nombre;
		$Persona->fechaNacimiento=$fechaNac;
		$Persona->email=$correo;
		$Persona->fechaRegistro=$fecha_actual;
		$Persona->fechaAlta='2000-01-01 01:01:01';
		$Persona->idPerfil='0';
		// mirar lo de la imagen 
		$Persona->imagen='';
		
	
		if($Persona->save()){ 
			
			require 'vendor/autoload.php';
			
			//$destino='eduardo_giorgio59@hotmail.com';
			# Instantiate the client.
			$mgClient = new Mailgun('key-b45d792682643afdd8bd31ad80fb92b8');
			$domain = "sandboxfaee1a05540d4a0c89c7970c76d2a21d.mailgun.org";

			# Make the call to the client.
			$result = $mgClient->sendMessage("$domain",
                  array('from'    => 'Administrador de CDeI <postmaster@sandboxfaee1a05540d4a0c89c7970c76d2a21d.mailgun.org>',
                        'to'      => $correo,
                        'subject' => 'Registro aula virtual ',
                        'text'    => 'Aguarde usuario'.$usuario.' por el confirmacion del encargado'));
						
			return View::make("registroCorrecto",array('seleccionado' => '3'));
		} else{ // el usuario no existe
			return View::make("registroIncorrrectoDatos",array('seleccionado' => '3'));
		}
	}
	else
	{
		// alguno de los campos posee problema de validacion
		return View::make("registroIncorrrectoDatos",array('seleccionado' => '3'));
	}
		
	

	
/*	
	if($error=='')
	{
		$consulta = "INSERT INTO persona (dni ,contrasenia ,apellido ,nombre ,fechaNacimiento ,
		email ,fechaRegistro ,fechaAlta ,idPerfil ,`imagen`) VALUES ('".$usuario."',AES_ENCRYPT('".$contrasenia."', 'pass'),'".$apellido."','".$nombre."','".$fechaNac."',
		'".$correo."','".$aux2."','".'2000-01-01 01:01:01'."','".'0'."','".$ruta_imagen."')";
    	//2000-01-01 01:01:01 es la fecha de alta por defecto 
		$resultado = $conexion->query($consulta);
		if (!$resultado)  // no existe en la db
			{
				$error.='el usuario ya existe';
				$aux_html='html'.DIRECTORY_SEPARATOR.'registro_error_us.html'; //pantalla de error de usuario ya registrado
			}
			
	}
	if($error=='')
	{
		//guardar la imagen en el servidor
		if($imagen['name']!="imagenDefault.jpg")
		{
			$archivosFotos="imagenes".DIRECTORY_SEPARATOR."usuario".DIRECTORY_SEPARATOR;
			$nombre=$ruta_imagen;
			if(!(move_uploaded_file($imagen['tmp_name'],$archivosFotos.$nombre)))
				$error.='el archivo no se ha subido';
		}
	//
		$acceso="INSERT INTO acceso (dni,fecha) VALUES ('".$usuario."','".$aux2."')";
		$resultado = $conexion->query($acceso);
	}
	if($error=='')
		$aux_html='html'.DIRECTORY_SEPARATOR.'registro_correcto.html';
	return $aux_html;
	*/

}


public function recuperarContrasenia($dato)
{

	$aux='error';
	if($this->validacion($dato,'correo')==1)	//si encuentro @ lo trato como email sino como dni
		{
			$aux='email';
		}
	else 
		if($this->validacion($dato,'dni')==1)
		{
			$aux='dni';
		}	

		if($aux!='error')
		{           
  	     $consulta = Persona::where($aux,'=',$dato)->first(); // first primero, get todos , si se pasan parametros trae los capos espesificos
		 
		 
		 if(!is_null($consulta))
		 {
			 $datoDevolucion=$consulta->email;
			 
			// genera la cadena aleatoria 
			$caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890"; //posibles caracteres a usar
			$numerodeletras=10; //numero de letras para generar el texto
			$cadena = ""; //variable para almacenar la cadena generada
			for($i=0;$i<$numerodeletras;$i++)
			{
				$cadena .= substr($caracteres,rand(0,strlen($caracteres)),1); /*Extraemos 1 caracter de los caracteres
			entre el rango 0 a Numero de letras que tiene la cadena */
			}


			 $affectedRows = Persona::where('dni', '=', $consulta->dni)->update(array('contrasenia' => $cadena ));
		     
			// cambia la contraseña
			
			
			require 'vendor/autoload.php';
			//$destino='eduardo_giorgio59@hotmail.com';
			# Instantiate the client.
			$mgClient = new Mailgun('key-b45d792682643afdd8bd31ad80fb92b8');
			$domain = "sandboxfaee1a05540d4a0c89c7970c76d2a21d.mailgun.org";

			# Make the call to the client.
			$result = $mgClient->sendMessage("$domain",
                  array('from'    => 'Administrador de CDeI <postmaster@sandboxfaee1a05540d4a0c89c7970c76d2a21d.mailgun.org>',
                        'to'      => $consulta->email,
                        'subject' => 'Registro aula virtual ',
                        'text'    => 'Su contraseña ha sido reestablecida y es'.$cadena));
			}			
		 else
			 $datoDevolucion='<span style="color:#f00;">DNI o correo no encontrados</span>';
	
		}
	else 
		$dato= '<span style="color:#f00;">Los datos ingresados no corresponden a un usuario o direccion de correo valida</span>';
	return Response::json(array('dato' =>  $datoDevolucion));

}
	
	

}

?>