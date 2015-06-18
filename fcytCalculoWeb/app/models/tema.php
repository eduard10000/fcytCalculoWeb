<?php


class tema extends Eloquent {
	protected  $table = 'tema'; // espesifica la tabla de la base de datos
	public $timestamps = false;   // obliga a no intuir que existen los 2 campos especiales de laravel

	// setea primaryKey
	protected $primaryKey = 'id_tema';

	
	
	
}
?>
