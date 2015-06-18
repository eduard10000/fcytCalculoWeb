<?php


class Persona extends Eloquent {
	protected  $table = 'persona'; // espesifica la tabla de la base de datos
	public $timestamps = false;   // obliga a no intuir que existen los 2 campos especiales de laravel

	// setea primaryKey
	protected $primaryKey = 'dni';

	
}
?>
