<?php


class item extends Eloquent {
	protected  $table = 'item'; // espesifica la tabla de la base de datos
	public $timestamps = false;   // obliga a no intuir que existen los 2 campos especiales de laravel

	// setea primaryKey
	protected $primaryKey = 'idItem';

	
	
	
}
?>
