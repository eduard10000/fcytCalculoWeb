<?php

class AdministradorController  extends ProfesorController {
	
	public function __construct()
	{
		$this->layoutPropio = 'layouts.administrador';
	}
	
	
	   
	
		public function get_id()
	{
		return 3;
	}

	
	
}




?>