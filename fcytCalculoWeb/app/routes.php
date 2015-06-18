<?php
use Mailgun\Mailgun;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/




/*
Route::get('prueba', function()
{
	$user = new User;
	$user->email = "prueba@prueba.com";
	$user->real_name = "Cuenta prueba";
	$user->password = "prueba";

	
	$user->save();
return "exito";
});
*/
/*
route::get('login','loginController@action_index');

// route post
route::post('login','loginController@registrarse');
// primer ruta get, controller @ define la funcion
*/

// con parametros
//Route::get('user','user@paramaetros');

/* nuevos routes del proyecto */

// Route::get('home','userNormalController@action_index');

/*
ejemplo para multierutear

Route::get('account', function() {
    if (Session::has('account_id')) {
        $action = 'show';
        return App::make('AccountsController')->$action();  
    }
    else {
        $action = 'index'; 
        return App::make('AccountsController')->$action();
    }
});
*/

$sessionTipo = Session::get('idPerfil');
if(!(isset($sessionTipo)))
	{
	$sessionTipo = 0;
	
	}

	// presenta el controlador que se va a usar
	$controlador="";
				
	switch($sessionTipo){
	case 0:
			$controlador = "UserNormalController";
	break;
	case 1:
			$controlador = "AlumnoController";
	break;	
	case 2:
			$controlador = "ProfesorController";
	break;	
	case 3:
			$controlador = "AdministradorController";
	break;	
	}
		
	

// reenruta si no es un usuario comun
Route::get('/', function()
{
	return Redirect::to('home');
});

// idPerfil 0 1 2 3


Route::get('home', $controlador.'@generar_home');



Route::get('usuariosNuevos',function()
{
// resolver por algo mas elegante como roles ver laravel
	$sessionTipo = Session::get('idPerfil');
	if(!(isset($sessionTipo)))
		$sessionTipo = 0;
	if($sessionTipo==0){return Redirect::to('home');}
		
	switch($sessionTipo){
	case 2:
			$ProfesorController = new ProfesorController();
			return $ProfesorController->usuariosNuevos();
	break;	
	case 3:
			$AdministradorController = new AdministradorController();
			return $AdministradorController->usuariosNuevos();
	break;
	default:
	// retorna 404 not found
	 return "";
	}
	
	
}
);

// idPerfil  2 3
Route::get('administrarUsuarios',function()
{
	// obtiene session creada o no
	$sessionTipo = Session::get('idPerfil');
	
	if(!(isset($sessionTipo)))
		$sessionTipo = 0;
	if($sessionTipo==0){return Redirect::to('home');}	

	
	switch($sessionTipo){
	case 2:
		$ProfesorController = new ProfesorController();
		return $ProfesorController->administrarUsuarios();
		
	break;	
	case 3:
		$AdministradorController = new AdministradorController();
		return $AdministradorController->administrarUsuarios();
	
	break;
	default:
	// retorna 404 not found
	 return "";
	}
	
	
}
);


// 0 1 2
Route::get('perfil',function()
{
// reformular que sigga el patron mvc
//$sessionTipo = Session::get('idPerfil');
$dni = Session::get('dni');
$sessionTipo = Session::get('idPerfil');

	if(!(isset($sessionTipo)))
		{
		$sessionTipo = 0;
		if($idPerfil==0){return Redirect::to('home');}
		break;
		}
		
	$persona=Persona::where('dni','=',$dni)->get(array('dni','apellido','nombre','email','idPerfil','fechaNacimiento','fechaRegistro','fechaAlta','imagen'))->first();

	
	switch($sessionTipo){
	case 1:
		return View::make("perfil",array('layout'=>'layouts.alumno','seleccionado' => '0','persona' => $persona));
	break;	
	case 2:
		return View::make("perfil",array('layout'=>'layouts.profesor','seleccionado' => '0','persona' => $persona));
	break;	
	case 3:
		return View::make("perfil",array('layout'=>'layouts.administrador','seleccionado' => '0','persona' => $persona));
	break;	
	}



 

}
);

Route::post('perfil',function()
{


		$sessionTipo = Session::get('idPerfil');
	if($sessionTipo>0)
	
	{
	$usuario=Input::get("dni"); // para que no pueda actualizar otros
	$contrasenia = Input::get("contrasenia");
	$correo = Input::get("correo");
	$apellido = Input::get("apellido");
	$nombre = Input::get("nombre");
	$fechaNac = Input::get("fecha_nac");
	$imagen = Input::file("imagen");
	
	// resolver por algo mas elegante como roles ver laravel
	switch($sessionTipo){
	case 1:
		$AlumnoController = new AlumnoController();
		return $AlumnoController->actualizar_perfil($usuario,$contrasenia,$correo,$apellido,$nombre,$fechaNac,$imagen);
	break;	
	
	case 2:
			$ProfesorController = new ProfesorController();
			return $ProfesorController->actualizar_perfil($usuario,$contrasenia,$correo,$apellido,$nombre,$fechaNac,$imagen);
	break;	
	case 3:
			$AdministradorController = new AdministradorController();
			return $AdministradorController->actualizar_perfil($usuario,$contrasenia,$correo,$apellido,$nombre,$fechaNac,$imagen);
	break;
	}
	
	}
	
});



// 2 3
Route::get('getUsersNew',function()
{
// reformular que sigga el patron mvc
$idPerfil = Session::get('idPerfil');
if($idPerfil==0){return Redirect::to('home');}

return '{ "data": '.
Persona::where('idPerfil','<',"1")->get(array('dni','apellido','nombre','email','idPerfil','fechaNacimiento','fechaRegistro','fechaAlta','imagen')
 )."}";

}
);


Route::get('administrarTemas',function()
{

// ver lauyots
return View::make("administrarTemas",array('layout'=>'layouts.profesor','seleccionado' => '8'));

// reformular que sigga el patron mvc
$sessionTipo = Session::get('idPerfil');
/*
return '{ "data": '.
Persona::where('idPerfil','<',"1")->get(array('dni','apellido','nombre','email','idPerfil','fechaNacimiento','fechaRegistro','fechaAlta','imagen')
 )."}";
*/

}
);

// 2 3
Route::get('getUsers',function()
{
// reformular que sigga el patron mvc
$sessionTipo = Session::get('idPerfil');
	if(!(isset($sessionTipo)))
		$sessionTipo = 0;
	if($sessionTipo==0){return Redirect::to('home');}	
	
if($sessionTipo==2 or $sessionTipo==3)	
	return '{ "data": '.
	Persona::where('idPerfil','<',$sessionTipo)->get(array('dni','apellido','nombre','email','idPerfil','fechaNacimiento','fechaRegistro','fechaAlta','imagen')
	)."}";

}
);


// 2 3
Route::post('changeUsers',function()
{
	$sessionTipo = Session::get('idPerfil');
	
	$dni=Input::get("dni");
	$idPerfil=Input::get("idPerfil");
	
	if($idPerfil<$sessionTipo && ($sessionTipo==2 or $sessionTipo==3 ))
	{
	
			$affectedRows = Persona::where('dni', '=', $dni)->update(array('idPerfil' => $idPerfil));	 
			if($idPerfil==1)
			{
	
	# Include the Autoloader (see "Libraries" for install instructions)
			require 'vendor/autoload.php';
			//use Mailgun\Mailgun;
			$destino='eduardo_giorgio59@hotmail.com';
			# Instantiate the client.
			$mgClient = new Mailgun('key-b45d792682643afdd8bd31ad80fb92b8');
			$domain = "sandboxfaee1a05540d4a0c89c7970c76d2a21d.mailgun.org";

			# Make the call to the client.
			$result = $mgClient->sendMessage("$domain",
                  array('from'    => 'Administrador de CDeI <postmaster@sandboxfaee1a05540d4a0c89c7970c76d2a21d.mailgun.org>',
                        'to'      => $destino,
                        'subject' => 'Titulo del email',
                        'text'    => 'Felicidades ha sido dado de alta.'));
    
			
			
			/*
			
				$data=[
					'title'=>"bienbenido al sitio",
					'content'=>"se ha confirmado su aceptacion",
				];
				Mail::send('emails.welcome', $data, function($message) // plantilla emails.welcome
				{	$message->from('postmaster@sandboxfaee1a05540d4a0c89c7970c76d2a21d.mailgun.org', 'Laravel');
					$message->to('eduardo_giorgio59@hotmail.com');
					//$message->attach($pathToFile);
				});
			

			
				
					Mail::queue('emails.welcome', $data, function($message) // plantilla emails.welcome
				{	$message->from('postmaster@sandboxfaee1a05540d4a0c89c7970c76d2a21d.mailgun.org', 'Laravel');
					$message->to('eduardo_giorgio59@hotmail.com')->cc('eduardo_giorgio59@hotmail.com');
					//$message->attach($pathToFile);
				});
				*/
			
			}
			
	}
	// not found page and clear session
	// hacer

});


// ajax respuesta iniciar session
// idPerfil 0
Route::post('ingresar', function(){ //modelo para envio por ajax

	
	
	if(Request::ajax() && Request::isMethod('post'))
	{
	
	// las variables se get los post y get
		$ingresoUsuario = Input::get("ingresoUsuario");
		$ingresocontrasenia = Input::get("ingresocontrasenia");

		$UserNormal = new UserNormalController();
		return $UserNormal->ingresar($ingresoUsuario,$ingresocontrasenia);
	
	
		
		
	
		
	}
	
});

// idPerfil 0
Route::get('registro', function(){
	return View::make("registro",array('seleccionado' => '3'));
});

// idPerfil 0
Route::post('registrarse', function(){


	
	$usuario = Input::get("dni");
	$contrasenia = Input::get("contrasenia");
	$correo = Input::get("correo");
	$apellido = Input::get("apellido");
	$nombre = Input::get("nombre");
	$fechaNac = Input::get("fecha_nac");
	$imagen = Input::file("imagen");
	
	$UserNormal = new UserNormalController();
	return $UserNormal->registrarse($usuario,$contrasenia,$correo,$apellido,$nombre,$fechaNac,$imagen);
	
	
	//Route::get('home','userNormalController@registro');

});

// idPerfil 0
Route::get('recuperarContrasenia', function(){
	
	return View::make("recuperarContrasenia",array('seleccionado' => '4'));
});


// idPerfil 0
Route::post('recuperarContrasenia', function(){

	
	
	// las variables se get los post y get
		$dato = Input::get("dato");
		$UserNormal = new UserNormalController();
		return $UserNormal->recuperarContrasenia($dato);
		//return Response::json($dato);
		
	}
	
);

// idPerfil 1 2 3
Route::get('cerrar_session',function()
{
	
	// se pude poner una imagen temporal y luego en 5 segundos redireccione
	Session::flush();
	return Redirect::to('home');
	}
);


Route::get('getTemas', function(){ //modelo para envio por ajax




	//if(Request::ajax() && Request::isMethod('post') )
	//{
	
	$idPerfil = Session::get('idPerfil');
	
	if(!(isset($idPerfil)))
		$idPerfil = 0;
	if($idPerfil==0){return Redirect::to('home');}	
	
	if($idPerfil==2 or $idPerfil==3 )
	{
	
		$ProfesorController = new ProfesorController();
		

		return $ProfesorController->getTemas();
	}
	
	//}

});

Route::post('crearTema', function(){ //modelo para envio por ajax

//if(Request::ajax() && Request::isMethod('post') )
	//{
	
	$idPerfil = Session::get('idPerfil');
	if($idPerfil==2 or $idPerfil==3 )
	{
		$ProfesorController = new ProfesorController();
		if($ProfesorController->crearTema(Input::get("temaNuevo"))=='correcto')
		{
			return $ProfesorController->getTemas();
		}
		else return "incorrecto";
	}
	
	//}

});

Route::post('editarTema', function(){ //modelo para envio por ajax

//if(Request::ajax() && Request::isMethod('post') )
	//{
	
	$idPerfil = Session::get('idPerfil');
	if($idPerfil==2 or $idPerfil==3 )
	{
		$ProfesorController = new ProfesorController();
		if($ProfesorController->editarTema(Input::get("temaNombre"),Input::get("idTema"))=='correcto')
		{
			return $ProfesorController->getTemas();
		}
		else return "incorrecto";
	}
	
	//}

});

Route::post('eliminarTema', function(){
	$idPerfil = Session::get('idPerfil');
	if($idPerfil==2 or $idPerfil==3 )
	{
		$ProfesorController = new ProfesorController();
		if($ProfesorController->eliminarTema(Input::get("temaEliminar"))=='correcto')
		{
			return $ProfesorController->getTemas();
		}
		else return "no se pudo crear el tema";
	}
});

Route::post('ordenTema', function(){ //modelo para envio por ajax

//if(Request::ajax() && Request::isMethod('post') ) 
	//{
	$idPerfil = Session::get('idPerfil');
	if($idPerfil==2 or $idPerfil==3 )
	{
		$ProfesorController = new ProfesorController();
		if($ProfesorController->ordenTema(Input::get("temaCambiarOrden"),Input::get("orden"))=='correcto')
		{
			return $ProfesorController->getTemas();
		}
		else return $ProfesorController->ordenTema(Input::get("temaCambiarOrden"),Input::get("orden"));
	}
	
	//}

});

Route::post('ordenItem', function(){ //modelo para envio por ajax

//if(Request::ajax() && Request::isMethod('post') ) 
	//{
	$idPerfil = Session::get('idPerfil');
	if($idPerfil==2 or $idPerfil==3 )
	{
		$ProfesorController = new ProfesorController();
		if($ProfesorController->ordenItem(Input::get("itemCambiarOrden"),Input::get("orden"))=='correcto')
		{
			return $ProfesorController->getTemas();
		}
		else return $ProfesorController->ordenItem(Input::get("itemCambiarOrden"),Input::get("orden"));
	}
	
	//}

});

Route::post('editarItem', function(){ //modelo para envio por ajax

//if(Request::ajax() && Request::isMethod('post') )
	//{
	
	$idPerfil = Session::get('idPerfil');
	if($idPerfil==2 or $idPerfil==3 )
	{
		$ProfesorController = new ProfesorController();
		if($ProfesorController->editarItem(Input::get("itemNombre"),Input::get("idItem"))=='correcto')
		{
			return $ProfesorController->getTemas();
		}
		else return "incorrecto";
	}
	
	//}

});

Route::post('eliminarItem', function(){
	$idPerfil = Session::get('idPerfil');
	if($idPerfil==2 or $idPerfil==3 )
	{
		$ProfesorController = new ProfesorController();
		if($ProfesorController->eliminarItem(Input::get("itemEliminar"))=='correcto')
		{
			return $ProfesorController->getTemas();
		}
		else return "no se pudo eliminar el item";
	}
});

Route::post('moverItem', function(){
	$idPerfil = Session::get('idPerfil');
	if($idPerfil==2 or $idPerfil==3 )
	{
		$ProfesorController = new ProfesorController();
		if($ProfesorController->moverItem(Input::get("idItem"),Input::get("idTemaDestino"))=='correcto')
		{
			return $ProfesorController->getTemas();
		}
		else return "no se pudo mover el item";
	}
});

// es temporal hasta que este programado  datatables
Route::get('item',function()
{

	
	// obtiene session creada o no
	$sessionTipo = Session::get('idPerfil');
	
	if(!(isset($sessionTipo)))
		$sessionTipo = 0;
			if($sessionTipo==0){return Redirect::to('home');}	

	
	switch($sessionTipo){
	case 2:
		return View::make("item",array('layout'=>'layouts.Profesor','seleccionado' => '0'));
		
	break;	
	case 3:
		return View::make("item",array('layout'=>'layouts.Profesor','seleccionado' => '0'));
	break;
	default:
	// retorna 404 not found
	 return "";
	}
	
	
}
);

Route::post('getListaTemas', function(){ //modelo para envio por ajax

	//if(Request::ajax() && Request::isMethod('post') )
	//{
	
	$idPerfil = Session::get('idPerfil');
	if($idPerfil==2 or $idPerfil==3 )
	{
	
		$ProfesorController = new ProfesorController();
		

		return $ProfesorController->getListaTemas();
	}
	
	//}

});

Route::post('crearItem',function(){

$idPerfil = Session::get('idPerfil');


	if(!(isset($sessionTipo)))
		$sessionTipo = 0;
		
// datos

$ruta = Input::get("ruta");
$idTema=Input::get("idTema");
$nombreNuevoItem=Input::get("nombreItem");

//EDUARDO YO TE ENVIO EL NOMBRE DEL ITEM, EL ID DEL TEMA Y LA NOMBRE DEL ARCHIVO TEMPORAL, LOS ARCHIVOS TEMPORALES SE GUARDAN EN PUBLIC/upload_temp
	
	if($idPerfil==2 or $idPerfil==3 )
	{
	$ProfesorController = new ProfesorController();
	$ProfesorController->crearItem($ruta,$idTema,$nombreNuevoItem);
	
	}
	


});

Route::post('crearRecursos',function(){

$idPerfil = Session::get('idPerfil');


	if(!(isset($sessionTipo)))
		$sessionTipo = 0;
		
	
// datos

$rutas = Input::get("rutas");
	
	if($idPerfil==2 or $idPerfil==3 )
	{
	$ProfesorController = new ProfesorController();
	$ProfesorController->crearRecursos($rutas);
	
	}
	


});

// funcion que llama  blade

Route::get('enviarMensaje',function(){

$idPerfil = Session::get('idPerfil');


	if(!(isset($idPerfil)))
		$idPerfil = 0;
	
	if($idPerfil==0){return Redirect::to('home');}
	

	if($idPerfil==2 or $idPerfil==3 )
	{
		return View::make("enviarMensaje",array('layout'=>'layouts.Profesor','seleccionado' => '1'));
	}
	


});

// funcion que llama  blade

Route::get('temas',function(){

$idPerfil = Session::get('idPerfil');


	if(!(isset($idPerfil)))
		$idPerfil = 0;
	
	if($idPerfil==0){return Redirect::to('home');}
	
	if($idPerfil==1 )
	{
		return View::make("temas",array('layout'=>'layouts.Alumno','seleccionado' => '2'));
	}
	
	
	if($idPerfil==2 or $idPerfil==3 )
	{
		return View::make("temas",array('layout'=>'layouts.Profesor','seleccionado' => '2'));
	}
	


});

Route::post('getListaTemasItems',function(){

$idPerfil = Session::get('idPerfil');

	if(!(isset($sessionTipo)))
		$sessionTipo = 0;
	
	if($idPerfil>=1 )
	{
			$AlumnoController = new AlumnoController();
			return $AlumnoController->getListaTemasItems();
	}
	

	


});




// funcion que envia datos

Route::post('enviarMensajeAlumnos',function(){

$idPerfil = Session::get('idPerfil');




	if(!(isset($sessionTipo)))
		$sessionTipo = 0;
		
// datos

$titulo = Input::get("titulo");
$contenido=Input::get("contenido");

// enrute al comienzo

	

	
	if($idPerfil==2 or $idPerfil==3 )
	{
	$ProfesorController = new ProfesorController();
	$ProfesorController->enviarMensajeAlumnos($titulo,$contenido);
	
	}
	


});

Route::get('getContentItem', function(){ //modelo para envio por ajax

	$idPerfil = Session::get('idPerfil');
	if(!(isset($idPerfil)))
		$idPerfil = 0;
	if($idPerfil==0){return Redirect::to('home');}
	

	
	// las variables se get los post y get
		$idItem = Input::get("idItem");
	// hacer revicion si son alumnos o otros usuarios je
		$ProfesorController = new ProfesorController();
		return $ProfesorController->getContentItem($idItem);
	
	
		
		
	
		
	
});

