<?php
class Login extends Eloquent {
protected $table = 'persona'; // espesifica la tabla de la base de datos
	public $timestamps = false;   // obliga a no intuir que existen los 2 campos especiales de laravel
	
	  public function verificar_usuario($DNI,$password)
    {
		
		$user = this::where('dni', $DNI)->where('contrasenia', $password)->
		first();
		if(($user)== NULL)
			return false;
		else 
			return true;
   
    }

}
?>