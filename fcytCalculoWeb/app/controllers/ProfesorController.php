<?php
use Mailgun\Mailgun;
class ProfesorController  extends AlumnoController {
	
	
	
// permite usar funciones padres independiente lauyot usado
	public function __construct()
	{
		$this->layoutPropio = 'layouts.profesor';
	}
	
	public function get_id()
	{
		return 2;
	}


	public function usuariosNuevos()
	{
		return View::make("administrarUsuarios",array('layout'=>$this->layoutPropio,'seleccionado' => '1',"request" =>"getUsersNew"));
	}
	
		public function getUsers()
	{
		return View::make("administrarUsuarios",array('layout'=>$this->layoutPropio,'seleccionado' => '1',"request" =>"getUsersNew"));
	}
	
	public function administrarUsuarios(){
	$request= "getUsers";
	return View::make("administrarUsuarios",array('layout'=>$this->layoutPropio,'seleccionado' => '1',"request" =>$request));
	}

	//prueba david
	
	public function administrarTemas(){
	$request= "getTemas";
	return View::make("administrarTemas",array('layout'=>$this->layoutPropio,'seleccionado' => '1',"request" =>$request));
	}
	//fin prueba
	
	public function crearTema($nombreNuevoTema)
	{
		
		$ordenTema=DB::table('tema')->max('orden'); //para que se agrege con el ultimo orden
		$nuevoTema = DB::table('tema')->insertGetId(
			array('contenido' => $nombreNuevoTema, 'dniModificador' => Session::get('dni'),'fechaModificacion' => date("Y-m-d H:i:s"),'idABM' => '0','orden' => ++$ordenTema));
		if($nuevoTema)
			return 'correcto';
		else return 'incorrecto';
	}
	
	public function editarTema($nombreTema,$idTema)
	{
		if(DB::table('tema')->where('idTema',$idTema)->update(array('contenido' =>$nombreTema, 'dniModificador' => Session::get('dni'),'fechaModificacion' => date("Y-m-d H:i:s")))!=0)
		{
			return "correcto";
		}
		else "no se pudo actualizar";
	
	}

	public function eliminarTema($idTemaEliminar)
	{
		$orden = DB::table('tema')->where('idTema', $idTemaEliminar)->pluck('orden');
		$reordenarTemas=DB::table('tema')->where('orden', '>', $orden)->decrement('orden'); //reacomodar orden de los temas
		
		$TemaEliminar=DB::table('tema')->where('idTema', '=', $idTemaEliminar)->delete();
		if($TemaEliminar)
		{
			return 'correcto';
		}
		else  return 'incorrecto';
	}
	
	public function ordenTema($idTemaCambiarOrden,$orden)
	{
		if($orden=='antes')
		{
			$ordenTema=DB::table('tema')->where('idTema', $idTemaCambiarOrden)->pluck('orden');
			if($ordenTema>1) //el id 0 es tema sin asignar siempre queda primero. el id 1 no puede ocupar su lugar
			{
				$ordenPrev=$ordenTema-1;
				DB::table('tema')->where('orden', $ordenPrev)->increment('orden');
				DB::table('tema')->where('idTema', $idTemaCambiarOrden)->decrement('orden');
				return "correcto";
			}
			else return "no se puede cambiar el orden del tema";
		}
		if($orden=='despues')
		{
			$ordenTema=DB::table('tema')->where('idTema', $idTemaCambiarOrden)->pluck('orden');
			$ordenTemaMax=DB::table('tema')->max('orden');
			if($ordenTema<$ordenTemaMax && $ordenTema>0) //el id 0 es tema sin asignar siempre queda primero. el id 1 no puede ocupar su lugar
			{
				$ordenSig=$ordenTema+1;
				DB::table('tema')->where('orden', $ordenSig)->decrement('orden');
				DB::table('tema')->where('idTema', $idTemaCambiarOrden)->increment('orden');
				return "correcto";

			}
			else return "no se puede cambiar el orden del tema";
		}
	}
	
public function getTemas()
{
//primero defino como $temas[0] contenedor para los items en la papelera
	$temas[0] = array(
    					"DT_RowId" => "itemPapelera",
						"contenido" => "Items eliminados",
						"dniModificador" => "",
						"fechaModificacion" => "",
						"orden"=>""
					);
//consulta para reemplazar dni por nombre y apellido y guardarlo en un array, solo traigo profesores y administradores que son los que necesito
	$nombreDni=DB::table('persona')->where('idPerfil', '>', 1)->get();
	foreach($nombreDni as $dni)
	{
		$dniToNyA[$dni->dni]=$dni->apellido.", ".$dni->nombre;	
	}
//hago la consulta de todos los temas, incluido el tema para items no asignados
	$temasC=DB::table('tema')->select('idTema as DT_RowId','contenido','dniModificador','fechaModificacion','orden')->orderBy('orden', 'asc')->get();
//agrego el resultado de la anterior consulta al array
	for ($i=0;$i<count($temasC); $i++)
	{
		$temas[]=array(
						"DT_RowId" => $temasC[$i]->DT_RowId,
						"contenido" => $temasC[$i]->contenido,
						"dniModificador" => $dniToNyA[$temasC[$i]->dniModificador],
						"fechaModificacion" =>$temasC[$i]->fechaModificacion,
						"orden"=>$temasC[$i]->orden,
						"DT_RowClass"=>""
					);			
	}	
//hago la consulta de todos los items
	$itemsC=DB::table('item')->select('idItem as DT_RowId','idTema','dniModificador','nombreItem','rutaItem','fechaModificacion','idABM','orden')->orderBy('orden', 'asc')->get();
	for ($i=0;$i<count($itemsC); $i++)
	{
		$items[]=array(
						"DT_RowId" => $itemsC[$i]->DT_RowId,
						"DT_RowClass" => "drag",  //al tener esta clase los items se les asocia el evento drop
						"idTema"=>$itemsC[$i]->idTema,
						"modificadoPor" => $dniToNyA[$itemsC[$i]->dniModificador],
						"nombreItem" => $itemsC[$i]->nombreItem,
						"rutaItem" => $itemsC[$i]->rutaItem,
						"fechaModificacion" =>$itemsC[$i]->fechaModificacion,
						"idABM" =>$itemsC[$i]->idABM,
						"ordenItem"=>$itemsC[$i]->orden
					);
	}
//banderas para identificar primer tema y ultimo tema
	if(count($temas)>=2) // quita el orden de items sin tema
	{
		$temas[1]['orden']="";
	}
	if(count($temas)==3) //si hay un solo tema este tiene que ser tanto primero como ultimo
	{
		$temas[2]['DT_RowClass']="primerTema ultimoTema";
	}
	if(count($temas)>3)
	{
		$temas[2]['DT_RowClass']="primerTema";	//primer tema
		$temas[count($temas)-1]['DT_RowClass']="ultimoTema";	//ultimo tema tema	
	}
	
	if(!isset($items)) // si no existen items para evitar un error
		$items= array();
	
	
	
//asignar items a temas
	for ($i=0;$i<count($items); $i++)
	{
		if($items[$i]["idABM"]==0) //si es verdadero asignar items a papelera
		{
			$items[$i]["ordenItem"]="";
			$items[$i]['DT_RowClass'].=" sinOrden";
			$temas[0]['items'][]=$items[$i];		
		}
		else 
		{
			for ($j=1;$j<count($temas); $j++) //el resto de los items se asigna a sus respectivos temas
			{
				if 	($items[$i]['idTema'] == $temas[$j]['DT_RowId'])
				{
					if($j==1)
					{
						$items[$i]['DT_RowClass'].=" sinOrden";
						$items[$i]["ordenItem"]="";
					}
					$temas[$j]['items'][]=$items[$i];
				}
			}
		}
	}//fin de ciclo iterativo	for ($i=0;$i<count($items); $i++)
//banderas para identificar contenedor de items sin temas
	$temas[1]['DT_RowId']='nT'; // id=0 da problemas items sin temas
//por ultimo se agregan las clases primeritem y ultimoitem por cada conjunto de items pertenecientes a un tema y la clase drop para que en el tema se puedan soltar items
	for ($i=2;$i<count($temas); $i++) //comienzo desde el primer tema, indice 3 del array
	{
		$temas[$i]['DT_RowClass'].=" drop";
		if(isset($temas[$i]['items']))//si no esta seteada no tiene items
		{
			if(count($temas[$i]['items'])==1) //si hay un solo tema este tiene que ser tanto primero como ultimo
			{
				$temas[$i]['items'][0]['DT_RowClass'].=" primerItem ultimoItem";
			}
			if(count($temas[$i]['items'])>=2)
			{
				$temas[$i]['items'][0]['DT_RowClass'].=" primerItem";
				$temas[$i]['items'][count($temas[$i]['items'])-1]['DT_RowClass'].=" ultimoItem";	
			}
		}
	}
	return '{ "data": '. json_encode($temas)."}";
} 


	public function eliminarItem($idItemEliminar) //el item se envia a la papelera si tiene un idabm!=0 si este es =0 se elimina directamente
	{
		$orden = DB::table('item')->where('idItem',$idItemEliminar)->pluck('orden');
		$reordenarTemas=DB::table('item')->where('orden', '>', $orden)->decrement('orden'); //reacomodar orden de los temas
		$estado = DB::table('item')->where('idItem', $idItemEliminar)->pluck('idABM');
		if($estado==1 or $estado==2)
		{
			$ItemEliminar=DB::table('item')->where('idItem',$idItemEliminar)->update(array('idTema' =>'0', 'dniModificador' => Session::get('dni'),'fechaModificacion' => date("Y-m-d H:i:s"),'idABM' => '0'));
			return 'correcto';
		}
		else if($estado==0)
		{
			$ItemEliminar=DB::table('item')->where('idItem', $idItemEliminar)->delete();
			return 'correcto';
		}
 		return 'incorrecto';
	}

///ordenar item 
	public function ordenItem($idItemCambiarOrden,$orden)
	{
		if($orden=='antes')
		{
			$ordenItem=DB::table('item')->where('idItem', $idItemCambiarOrden)->pluck('orden');
			if($ordenItem>1) 
			{
				$ordenPrev=$ordenItem-1;
				$idTema=DB::table('item')->where('idItem', $idItemCambiarOrden)->pluck('idTema');
				DB::table('item')->where('idTema',$idTema)->where('orden', $ordenPrev)->increment('orden');
				DB::table('item')->where('idItem', $idItemCambiarOrden)->decrement('orden');
				return "correcto";
			}
			else 
			{
				return "no se puede cambiar el orden del item";
			}
		}
		if($orden=='despues')// ver da errores
		{
			$ordenItem=DB::table('item')->where('idItem', $idItemCambiarOrden)->pluck('orden');
			$idTema=DB::table('item')->where('idItem', $idItemCambiarOrden)->pluck('idTema');
			$ordenItemTemaMax=DB::table('item')->where('idTema', $idTema)->max('orden');
			if($ordenItem<$ordenItemTemaMax && $ordenItem>0) 
			{
				$ordenSig=$ordenItem+1;
				DB::table('item')->where('idTema', $idTema)->where('orden', $ordenSig)->decrement('orden');
				DB::table('item')->where('idItem', $idItemCambiarOrden)->increment('orden');
				return "correcto";
			}
			else return "no se puede cambiar el orden del tema";
		}
	}

public function moverItem($idItem,$idTemaDestino)
{
	$ordenItemOld=DB::table('item')->where('idItem', $idItem)->pluck('orden');//orden del item dentro del tema viejo
	$idTemaOld=DB::table('item')->where('idItem', $idItem)->pluck('idTema');
	$reordenarTema=DB::table('item')->where('orden', '>', $ordenItemOld)->where('idTema',$idTemaOld)->decrement('orden'); //reacomodar orden de los items del tema que lo contenia
	$ordenTemaDestinoMax=DB::table('item')->where('idTema', $idTemaDestino)->max('orden');
	if(count($ordenTemaDestinoMax)<1) //si el tema destino no tiene items devuelve NULL el orden
		$ordenTemaDestinoMax=0;
	$nuevoOrden=++$ordenTemaDestinoMax;
	DB::table('item')->where('idItem',$idItem)->update(array('orden'=>$nuevoOrden,'idTema'=>$idTemaDestino,'dniModificador' => Session::get('dni'),'fechaModificacion' => date("Y-m-d H:i:s")));
return "correcto";
}


//editar item
public function editarItem($nombreItem,$idItem)
{
	if(DB::table('item')->where('idItem',$idItem)->update(array('nombreItem' =>$nombreItem, 'dniModificador' => Session::get('dni'),'fechaModificacion' => date("Y-m-d H:i:s")))!=0)
	{
		return "correcto";
	}
	else "no se pudo actualizar";

}

public function getListaTemas()
{
	$listaTemasC=DB::table('tema')->select('idTema','contenido')->where('idTema','>',0)->orderBy('orden', 'asc')->get();
	for ($i=0;$i<count($listaTemasC); $i++)
	{
		$listaTemas[]=array(
						"idTema" => $listaTemasC[$i]->idTema,
						"contenido" => $listaTemasC[$i]->contenido
					);
	}
	return $listaTemas;
}

	
public function crearItem($file,$idTema,$nombreNuevoItem){


echo "nombre del archivo".$file."</br>";
// protege que tenan la extencion que corresponda
	$archivo_temporal="upload_temp".DIRECTORY_SEPARATOR.$file;

	$output_dir = "Items";

	if(isset($archivo_temporal) )
	{
		
		$fechaItem = date("Y-m-d H-i-s").".html";
		$directorio_destino= $output_dir.DIRECTORY_SEPARATOR.$fechaItem;	
		

		
		rename($archivo_temporal,$directorio_destino);
		
		$ordenItem=DB::table('item')->max('orden'); //para que se agrege con el ultimo orden
		$nuevoItem = DB::table('item')->insertGetId(
			array('rutaItem' => $fechaItem  /* fecha de creacion para evitar repeticiones*/ ,'nombreItem'=> $nombreNuevoItem,'idTema' => $idTema, 'dniModificador' => Session::get('dni'),'fechaModificacion' => date("Y-m-d H:i:s"),'idABM' => '1','orden' => ++$ordenItem));
			
			
			
			echo "archivo temporal:".$archivo_temporal;
			echo "Uploaded File :".$directorio_destino;
		
	}
	
}

public function crearRecursos($rutas){


echo "nombre del archivos".$rutas."</br>";

	// eliminar el mas mejorar este modulo y no enviar con mas las cosas
	$recursos= explode("+",$rutas);
	unset($recursos[0]);
	
	foreach ($recursos as $recurso)
	{
		echo "nombre del archivos:*".$recurso."*";

		
		
		// protege que tenan la extencion que corresponda
		$archivo_temporal="upload_temp".DIRECTORY_SEPARATOR.$recurso;
		$output_dir = "recursos";
	
		if(isset($archivo_temporal) )
		{
			$directorio_destino= $output_dir.DIRECTORY_SEPARATOR.$recurso;	
			// mueve el archivo temporal a permanente
			
			//echo archivo_temporal."       ".$directorio_destino;
			
			rename($archivo_temporal,$directorio_destino);
			
			
			// recurso para poder eliminarlo se creo una tabla
			// por ahora simplemente vacio
		
			
		}
	}
	
}


public function enviarMensajeAlumnos($titulo,$contenido)
{
	# Include the Autoloader (see "Libraries" for install instructions)
	require '../vendor/autoload.php';
	//use Mailgun\Mailgun;
	
	# Instantiate the client.
	$mgClient = new Mailgun('key-b45d792682643afdd8bd31ad80fb92b8');
	$domain = "sandboxfaee1a05540d4a0c89c7970c76d2a21d.mailgun.org";
	
	//
	
	$personas=Persona::where('idPerfil','=',"1")->get(array('email'));
	
	foreach ($personas as $persona)
{
	// echo mail

    //var_dump($user->name);

	// el desino cambia en los datos
	$destino=$persona->email;
	//
	echo   "mail:".$destino."</br>";
	
	# Make the call to the client.
	$result = $mgClient->sendMessage("$domain",
                  array('from'    => 'Administrador de CDeI <postmaster@sandboxfaee1a05540d4a0c89c7970c76d2a21d.mailgun.org>',
                        'to'      => $destino,
                        'subject' => $titulo,
                        'text'    => $contenido));
    
}

}	
	

}

?>